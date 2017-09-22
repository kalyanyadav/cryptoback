<?php
global $hooks;
global $menu_array;
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="keywords" content="MYSAI WORLD">
        <meta name="description" content="mysaiworld.org">
        <meta name="author" content="mysaiworld">
        <link rel="shortcut icon" href="#" type="image/png">
        <title><?php $hooks->do_action("the_title"); ?> - Crypto 2 Bank </title>
        
        	<link rel="shortcut icon" href="../favicon.png" />

        <!--icheck-->
        <link href="/assets/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
        <link href="/assets/js/iCheck/skins/square/square.css" rel="stylesheet">
        <link href="/assets/js/iCheck/skins/square/red.css" rel="stylesheet">
        <link href="/assets/js/iCheck/skins/square/blue.css" rel="stylesheet">

        <!--dashboard calendar-->
        <link href="/assets/css/clndr.css" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/assets/js/morris-chart/morris.css">

        <!--common-->
        <link href="/assets/css/style.css" rel="stylesheet">
        <link href="/assets/css/style-responsive.css" rel="stylesheet">
        <link href="/assets/css/responsivetabel.css" rel="stylesheet">
<?php $hooks->do_action("global_css"); ?>



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="sticky-header">
        <section>
            <!-- left side start-->
            <div class="left-side sticky-left-side">

                <!--logo and iconic logo start-->
                <div class="logo">
                    <a href="/dashboard"><img src="/assets/logo.png" alt="mysaiworld"></a>
                </div>
                <!--logo and iconic logo end-->

                <div class="left-side-inner">

                    <!--sidebar nav start-->
<?php menu_render($menu_array); ?>
                    <!--sidebar nav end-->

                </div>
            </div>
            <div class="main-content" >
                <div class="header-section">
                    <a class="toggle-btn"><i class="fa fa-bars"></i></a>
                    <div class="menu-right">
                        <ul class="notification-menu">
                            <li>
<?php if (isset($_SESSION["godmode"]["status"])) { ?>
                                    <a href="/godmode-off" class="btn btn-default dropdown-toggle">
                                        <i class="fa fa-lock"></i> Back as Admin
                                    </a>
<?php } else { ?>
                                    <a href="/logout" class="btn btn-default dropdown-toggle">
                                        <i class="fa fa-lock"></i> Secure Logout
                                    </a>
<?php } ?>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="page-heading">
                    <h3>
<?php $hooks->do_action("the_title"); ?>
                    </h3>
                    <div class="state-info">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="summary">
                                    <span>Hello, Welcome</span>
                                    <h3><?php echo strtoupper($_SESSION["uname"]); ?></h3>
                                </div>

                            </div>
                        </section>
						<?php
						if($_SESSION["uid"] == 1){
						?>
						<section class="panel">
                            <div class="panel-body">
                                <div class="summary">
                                    <span>Daily Bonus</span>
									<form method="POST" action="/transaction/dailybonus">
									<input type="submit" value="Beginner" class="btn btn-info">
									</form>
									<form method="POST" action="/transaction/dailybonusc">
									<input type="submit" value="Crypto" class="btn btn-info">
									</form>
                                </div>
                            </div>
                        </section>
						<?php
						}
						?>
                        <section class="panel">
                            <div class="panel-body">
                                <div class="summary">
                                    <span>Register Wallet</span>
                                    <h3 class="red-txt"><?php echo ($_SESSION["role"] == "1" ? "$" . current_register_fund() : "UNLIMITED"); ?></h3>
                                </div>
                                <div id="income" class="chart-bar"></div>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <div class="summary">
                                    <span>E Wallet</span>
                                    <h3 class="green-txt"><?php echo ($_SESSION["role"] == "1" ? "$" . current_fund() : "UNLIMITED"); ?></h3>
                                </div>
                                <div id="expense" class="chart-bar"></div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="wrapper">