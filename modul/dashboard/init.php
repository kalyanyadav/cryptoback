<?php
global $hooks;
$hooks->add_action('silex_action','the_dashboard'); // Tancapkan fungsi dashboard ke Trigger Silex
$hooks->add_action('all_menu','menu_dashboard');
function dashboard_title(){
    echo "Welcome ";
}
function menu_dashboard(){
    global $menu_array;
    $dashboardmenu = array(
        "label" => "Dashboard",
        "url" => "/dashboard",
        "icon" => "fa fa-home"
    );
    $menu_array[0]=$dashboardmenu;
}
function the_dashboard(){
global $app;global $csrf;  

$app->get('/dashboard', function() use($csrf) { 
    global $hooks;
    global $app;
    $hooks->add_action('the_title',"dashboard_title");
    the_head();
    include 'dashboard.tpl.php';
    the_footer();
    // SEND EMAIL
    
    return "";
}); 
}