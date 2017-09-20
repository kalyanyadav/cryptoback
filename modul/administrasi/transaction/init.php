<?php
global $hooks;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$hooks->add_action('admin_action', 'the_trx'); // Tancapkan fungsi dashboard ke Trigger Silex
// Define Heading masing2 page

function trx_title() {
    echo "Transaction Lists";
}

function withdrawal_title() {
    echo "Withdrawal Demand";
}
function invoice_title() {
    echo "Purchase History";
}

// Define CSS
function trx_css() {
    ?>
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datepicker/css/datepicker-custom.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/bootstrap-datetimepicker/css/datetimepicker-custom.css" />
    <link href="/assets/css/footable/footable.core.css" rel="stylesheet">
    <?php
}

// Define JS
function withdrawal_js() {
    ?>
    <script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/js/footable/footable.js"></script>
    <script type="text/javascript" src="/assets/modul-js/admin/withdrawal.js"></script>
    <script type="text/javascript" src="/assets/modul-js/admin/withdrawal-list.js"></script>
    <?php
}
function invoice_js() {
    ?>
    <script src="/assets/js/footable/footable.js"></script>
    <script type="text/javascript" src="/assets/modul-js/admin/invoice-list.js"></script>
    <?php
}

function trx_js() {
    ?>
    <script type="text/javascript" src="/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="/assets/js/footable/footable.js"></script>
    <script type="text/javascript" src="/assets/modul-js/admin/summary.js"></script>
    <?php
}

function the_trx() {
    global $app;
    // Fund Balance
    $app->post('/transaction/list', function(Request $request) {
        $curpage = $request->get('page');
        include 'fund.list.php';
        return '';
    });
    $app->post('/transaction/filter', function(Request $request) {
        $_SESSION["filtersum"]["transid"] = $request->get('transid');
        $_SESSION["filtersum"]["date"] = $request->get('date');
        $_SESSION["filtersum"]["type"] = $request->get('type');
        $_SESSION["filtersum"]["flow"] = $request->get('flow');
        $_SESSION["filtersum"]["model"] = $request->get('model');
        $_SESSION["filtersum"]["uname"] = $request->get('uname');
        return new Response('Success', 200);
    });
    $app->post('/transaction/clearfilter', function(Request $request) {
        $_SESSION["filtersum"] = "";
        return new Response('Success', 200);
    });
    $app->get('/transaction', function() {
        global $hooks;
        $_SESSION["filtersum"] = "";
        $hooks->add_action('global_css', "trx_css");
        $hooks->add_action('global_js', "trx_js");
        $hooks->add_action('the_title', "trx_title");
        the_head();
        include 'fund.tpl.php';
        the_footer();
        return "";
    });
    // Withdraw Lists
    $app->post('/withdrawal/clearfilter', function(Request $request) {
        $_SESSION["filterwithdraw"] = "";
        return new Response('Success', 200);
    });
    $app->post('/withdrawal/filter', function(Request $request) {
        $_SESSION["filterwithdraw"]["status"] = $request->get('status');
        $_SESSION["filterwithdraw"]["wdid"] = $request->get('wdid');
        $_SESSION["filterwithdraw"]["uname"] = $request->get('uname');
        $_SESSION["filterwithdraw"]["from"] = $request->get('from');
        $_SESSION["filterwithdraw"]["to"] = $request->get('to');
        return new Response('Success', 200);
    });
    $app->post('/withdrawal/pay', function(Request $request) {
        global $db;
        $id = $request->get('id');
        if ($id) {
            $idWithdraw = $id;
            $owner = wdOwner($id);
            $pending = pendingWdReg($id);
            $db->bind('id', $id);
            $tgl = date('Y-m-d H:i:s');
            $db->bind('tgl', $tgl);
            $update = $db->query("UPDATE withdrawal SET status = 'PAID', paid_date = :tgl WHERE id = :id");
            if ($update) {
                // If Update Success, insert it into transaction
                // PREPARE THE DATA
                $db->bind("takenregister", $pending);
                $db->bind("owner", $owner);
                $db->bind("notes", "WITHDRAW # " . $idWithdraw);
                // Execute
                $deduct2 = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),10, :takenregister, 0,:notes,:owner)");
                if ($deduct2) {
                    return new Response('SUCCESS', 200);
                } else {
                    return new Response('FAILED', 201);
                }
            } else {
                return new Response('FAILED', 201);
            }
        }
    });
    $app->post('/withdrawal/list', function(Request $request) {
        $curpage = $request->get('page');
        include 'withdraw.list.php';
        return '';
    });
// Smarty untuk menu register balance
    $app->get('/withdrawal', function() {
        global $hooks;
        $_SESSION["filterwithdraw"] = "";
        $hooks->add_action('global_css', 'bank_css');
        $hooks->add_action('global_js', 'withdrawal_js');
        $hooks->add_action('the_title', "withdrawal_title");
        the_head();

        include 'withdraw.tpl.php';
        the_footer();
        return "";
    });
    // Invoiceing Lists
    $app->post('/invoice/clearfilter', function(Request $request) {
        $_SESSION["filterinvoice"] = "";
        return new Response('Success', 200);
    });
    $app->post('/invoice/filter', function(Request $request) {
        $_SESSION["filterinvoice"]["status"] = $request->get('status');
        $_SESSION["filterinvoice"]["wdid"] = $request->get('wdid');
        return new Response('Success', 200);
    });
    $app->post('/invoice/pay', function(Request $request) {
        global $db;
        $id = $request->get('id');
        if ($id) {
            $idWithdraw = $id;
            $owner = InvBuyer($id);
            $amount = InvAmount($id);
            $db->bind('id', $id);
            $update = $db->query("UPDATE invoice SET status = '1' WHERE id = :id");
            if ($update) {
                // If Update Success, insert it into transaction
                // PREPARE THE DATA
                $x = $db->query("INSERT INTO fund_transaction(type,nominal,details,from_id,to_id,date) VALUES(:tipe,:nominal,:notes,:from,:to,NOW())", 
                        array("tipe" => "1", "nominal" => $amount, "notes" => "PURCHASE POINT", "from" => "0", "to" => $owner));
                if ($x) {
                    return new Response('SUCCESS', 200);
                } else {
                    return new Response('FAILED', 201);
                }
            } else {
                return new Response('FAILED', 201);
            }
        }
    });
    $app->post('/invoice/list', function(Request $request) {
        $curpage = $request->get('page');
        include 'invoice.list.php';
        return '';
    });
// Smarty untuk menu register balance
    $app->get('/invoice', function() {
        global $hooks;
        $_SESSION["filterwithdraw"] = "";
        $hooks->add_action('global_css', 'bank_css');
        $hooks->add_action('global_js', 'invoice_js');
        $hooks->add_action('the_title', "invoice_title");
        the_head();

        include 'invoice.tpl.php';
        the_footer();
        return "";
    });
}

function InvBuyer($id) {
    global $db;
    $db->bind("id", $id);
    $owner = $db->query("SELECT buyer FROM invoice WHERE id = :id");
    return $owner[0]["buyer"];
}

function InvAmount($id) {
    global $db;
    $db->bind("id", $id);
    $owner = $db->query("SELECT amount FROM invoice WHERE id = :id");
    return $owner[0]["amount"];
}
