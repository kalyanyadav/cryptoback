<?php
global $hooks;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$hooks->add_action('admin_action', 'the_usrmgmt');
$hooks->add_action('silex_action', 'godmode');

function usrmgmt_title() {
    echo "USER MANAGEMENT ";
}

function usrmgmt_css() {
    ?>
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datepicker/css/datepicker-custom.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
    <link href="/assets/css/footable/footable.core.css" rel="stylesheet">
<?php }

function usrmgmt_js() {
    ?>
    <script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/js/footable/footable.js"></script>
    <script type="text/javascript" src="/assets/modul-js/admin/usrmgmt.js"></script>
<?php
}
function godmode(){
    global $app;
    $app->get('/godmode-off', function(Request $request) {
        global $db;
        global $app;
        if ($_SESSION["godmode"]["status"] == "1") {
            // SET SESSION
            $_SESSION["uname"] = $_SESSION["godmode"]["uname"];
            $_SESSION["uid"] = $_SESSION["godmode"]["uid"];
            $_SESSION["role"] = $_SESSION["godmode"]["role"];
            unset($_SESSION["godmode"]);
            // RETURN
        }
        return $app->redirect('/dashboard');
    });
}
function the_usrmgmt() {
    global $app;
    
    $app->post('/user-management/list', function(Request $request)  {
        $curpage = $request->get('page');
        include 'usr.list.php';
        return '';
    });
    $app->post('/user-management/block', function(Request $request) {
        global $db;
        $uid = $request->get('id');
        $db->bind("usrid", $uid);
        $block = $db->query("UPDATE user_id SET banned = '1' WHERE uid = :usrid");
        if ($block) {
            return new Response('Success', 200);
        } else {
            return new Response('FAIL', 201);
        }
    });
    $app->post('/user-management/unblock', function(Request $request)  {
        global $db;
        $uid = $request->get('id');
        $db->bind("usrid", $uid);
        $block = $db->query("UPDATE user_id SET banned = '0' WHERE uid = :usrid");
        if ($block) {
            return new Response('Success', 200);
        } else {
            return new Response('FAIL', 201);
        }
    });
    $app->post('/user-management/filter', function(Request $request) {
        $_SESSION["filterusr"]["date"] = $request->get('date');
        $_SESSION["filterusr"]["uname"] = $request->get('uname');
        return new Response('Success', 200);
    });
    $app->post('/user-management/clearfilter', function(Request $request){
        $_SESSION["filterusr"] = "";
        return new Response('Success', 200);
    });
    $app->post('/user-management/godmode', function(Request $request)  {
        global $db;
        $uid = $request->get('id');
        $db->bind("userrid", $uid);
        $usr = $db->query("SELECT * FROM user_id WHERE uid = :userrid");
        if ($usr && $_SESSION["role"] == "0") {
            // SET SESSION
            $_SESSION["godmode"]["status"] = "1";
            $_SESSION["godmode"]["uname"] = $_SESSION["uname"];
            $_SESSION["godmode"]["uid"] = $_SESSION["uid"];
            $_SESSION["godmode"]["role"] = $_SESSION["role"];
            $_SESSION["uname"] = $usr[0]["uname"];
            $_SESSION["uid"] = $usr[0]["uid"];
            $_SESSION["role"] = $usr[0]["role"];
            // RETURN
            return new Response('Success', 200);
        } else {
            return new Response('FAIL', 201);
        }
    });
    $app->get('/user-management', function() {
        global $hooks;
        $_SESSION["filterusr"] = "";
        $hooks->add_action('global_css', "usrmgmt_css");
        $hooks->add_action('global_js', "usrmgmt_js");
        $hooks->add_action('the_title', "usrmgmt_title");
        the_head();
        include 'usr.tpl.php';
        the_footer();
        return "";
    });
}
