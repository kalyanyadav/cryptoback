<?php
global $hooks;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$hooks->add_action('silex_action', 'downline_registration');
$hooks->add_action('all_menu', 'menu_register');

// Set the Menu
function menu_register() {
    global $menu_array;
    $accountmenu = array(
        "label" => "Register Downline",
        "url" => "/register-account",
        "icon" => "fa fa-bullhorn"
    );
    $menu_array[10] = $accountmenu;
}

// Define Page Title & Heading Text
function dreg_title() {
    echo "DOWNLINE REGISTRATION";
}

// Define the CSS 
function dreg_css() {
    ?>
    <link href="/assets/css/jquery.stepy.css" rel="stylesheet">
    <?php
}

// Define The JS
function dreg_js() {
    ?>
    <script type="text/javascript" src="/assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
    <script src="/assets/js/jquery.stepy.js"></script>
    <script type="text/javascript" src="/assets/modul-js/registration/dreg.js"></script>
    <?php
}

function step_js() {
    ?>

    <?php
}

// Declare & SET the URL handler
function downline_registration() {
    global $app;
    // Check Username Handler
    $app->post('/register-account/check', function(Request $request) {
        global $db;
        $uname = $request->get('uname');
        $db->bind('uname', $uname);
        $row = $db->query("SELECT uid FROM user_id WHERE uname = :uname");
        if (count($row) > 0) {
            $status = 'false';
        } else {
            $status = 'true';
        }
        echo $status;
        return '';
    });

    $app->post('/register-account/valuecheck', function(Request $request) {
        global $db;
        $pid = $request->get('product');
		$paytype = $request->get('paytype');
		//echo $paytype;die;
		if($paytype == "partial"){
			$initial = packagePrice($pid);
			$price = $initial/2;
			echo (productExist($pid) && is_numeric($pid) && current_register_fund() >= $price ? "true" : "false");
		}
		else{
			echo (productExist($pid) && is_numeric($pid) && current_register_fund() >= packagePrice($pid) ? "true" : "false");
        }
		return "";
    });
    // Handler New Registration 
    $app->post('/register-account/submit', function(Request $request) {
        global $db;
        // Catch the GET
        $uname = $request->get('uname');
        $bene = $request->get('beneficiary');
        $email = $request->get('email');
        $pass = $request->get('pass');
        $fname = $request->get('fname');
        $lname = $request->get('lname');
        $gender = $request->get('gender');
        $prefix = $request->get('prefix');
        $mobile = $request->get('mobile');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $city = $request->get('city');
        $zip = $request->get('zip');
        $state = $request->get('state');
        $country = $request->get('country');
        $bankname = $request->get('bank_name');
        $branch = $request->get('branch_name');
        $holder = $request->get('holder');
        $acnumber = $request->get('acnumber');
        $swiftcode = $request->get('swiftcode');
        $pid = $request->get('product');
        $relation = $request->get('relation');
        $position = (have2Leg($_SESSION["uid"]) ? $request->get('position') : $_SESSION["uid"]);
        $pin = $request->get('pin');
		$paytype = $request->get('paytype');
        // END
		if($paytype == "partial"){
			$packagePrice = packagePrice($pid);
			$packagePrice = $packagePrice/2;
		}
		else{
			$packagePrice = packagePrice($pid);
		}
        // Check if the request match the conditional
        if (pinCorrect($pin) && !userExist($uname) && productExist($pid) && is_numeric($pid) && current_register_fund() >= $packagePrice && userExist(getUname($position))) {
            // PREPARE
            $db->bind("uname", $uname);
            $db->bind("pass", md5($pass));
            $db->bind("product", $pid);
            // Record to user_id to get the user id
            $userReg = $db->query("INSERT INTO user_id(uname,password,register_date,role,product) VALUES(:uname,:pass,CURDATE(),'1',:product)");
            $uid = $db->lastInsertId();
            if ($userReg && $uid) {
                // Record User Detail
                // PREPARE
                $db->bind("uid", $uid);
                $db->bind("fname", $fname);
                $db->bind("lname", $lname);
                $db->bind("gender", $gender);
                $db->bind("email", $email);
                $db->bind("mobile", $mobile);
                $db->bind("phone", $phone);
                $db->bind("state", $state);
                $db->bind("city", $city);
                $db->bind("zip", $zip);
                $db->bind("address", $address);
                $db->bind("rel", $relation);
                $db->bind("country", $country);
                $db->bind("bene", strtoupper($bene));
                // EXECUTE
                $userDetRec = $db->query("INSERT INTO user_detail(uid,first_name,last_name,gender,email,mobile,phone,state,city,zip,address,relation,country,beneficiary) VALUES(:uid,:fname,:lname,:gender,:email,:mobile,:phone,:state,:city,:zip,:address,:rel,:country,:bene)");
                // Record User Bank Info
                // PREPARE
                $db->bind("bname", $bankname);
                $db->bind("brname", $branch);
                $db->bind("acnum", $acnumber);
                $db->bind("holder", $holder);
                $db->bind("swift", $swiftcode);
                $db->bind("uid", $uid);
                // EXECUTE
                $userBankRec = $db->query("INSERT INTO user_bank(bank_name,branch_name,acnumber,bankholder,swiftcode,uid) VALUES(:bname,:brname,:acnum,:holder,:swift,:uid)");
                // sponsor level bonus
		$levelBonus = getLevelBonus($pid);
		$harga = packagePrice($pid);
                $lbonus = ($levelBonus * $harga) / 100;
		// Record to genealogy
		$parentId = getSponserId($_SESSION["uid"]);
		$levelbonus = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'6',:bonus,:fromx,:infox,:tox)", array("bonus" => $lbonus, "fromx" => "0", "infox" => "SPONSOR LEVEL BONUS", "tox" => $parentId));
                $userGenRec = $db->query("INSERT INTO genealogy(uid,parentid,sponsorid) VALUES(:uid,:parent,:sponsor)", array("uid" => $uid, "parent" => $parentId, "sponsor" => $_SESSION["uid"]));
                // Record to transaction
                // Record member registration fee
				if($paytype == "partial"){
					$packagePrice = packagePrice($pid);
					$cal = $packagePrice/2;
					$userFeeRec = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'9',:nom,:from,:notes,:to)", array("nom" => $cal, "from" => $_SESSION["uid"], "notes" => "REGISTRATION FOR USERNAME :" . strtoupper($uname), "to" => "0"));
				}
				else{
					$userFeeRec = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'9',:nom,:from,:notes,:to)", array("nom" => packagePrice($pid), "from" => $_SESSION["uid"], "notes" => "REGISTRATION FOR USERNAME :" . strtoupper($uname), "to" => "0"));
                }
				// Initial Point to new member
                //$userInitRec = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'1',:val,:dari,:info,:ke)", array("val" => packagePrice($pid), "dari" => "0", "info" => "SPONSOR BONUS FOR USERNAME :" . strtoupper($uname), "ke" => $_SESSION["uid"]));
                // Bonus Sponsor
                $persen = ($_SESSION["role"]!="0"?getActiveProduct($_SESSION["uid"], "referral_rate"):"0");
                $harga = packagePrice($pid);
                $bonus = ($persen * $harga) / 100;
		// Record the bonus to db
		$tembakbonus = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'6',:bonus,:fromx,:infox,:tox)", array("bonus" => $bonus, "fromx" => "0", "infox" => "SPONSOR BONUS FOR USERNAME <b>" . strtoupper($uname), "tox" => $_SESSION["uid"]));
				if($paytype == "partial"){
					$packagePrice = packagePrice($pid);
					$cal = "-" . $packagePrice/2; 
					//$userInitRec = $db->query("INSERT INTO fund_transaction(date,type,nominal,from_id,details,to_id) VALUES(NOW(),'1',:val,:dari,:info,:ke)", array("val" => $cal, "dari" => "0", "info" => "SPONSOR BONUS FOR USERNAME :" . strtoupper($uname), "ke" => $_SESSION["uid"]));
					
                }
				if ($userDetRec && $userBankRec && $userGenRec) {
                    // Email
                    // Konfigurasi Pesan Email
                    $pesan = "Thankyou for your registration to us. </br></br>";
                    $pesan .= "We've just noticed that you've just registered to our system, <br>Here is your user detail, please save this data to somewhere safe.";
                    $pesan .= "<br><br> USERNAME : <strong>" . $uname . "</strong></br>";
                    $pesan .= "<br>PASSWORD : <strong>" . $pass . "</strong></br>";
                    $pesan .= "<br>JOIN VALUE : <strong>" . packageName($pid) . " - $" . packagePrice($pid) . "</strong></br>";
                    $pesan .= "<br>SPONSORED BY : <strong>" . strtoupper(getUname($_SESSION["uid"])) . "</strong></br>";
                    $pesan .= "<br>UPLINE : <strong>" . strtoupper(getUname($position)) . "</strong></br>"; 
					//Send Message
					$message = "Thank you for registering with mysaiworld.org, Your Registration is successful.\n Username: ".$uname."\n Password : ".$pass."\n Login to mysaiworld.org";
					$message = urlencode($message);
					/*
					if($prefix == '91')
					sendMessage($mobile,$message);
					else
					sendMessageI($mobile,$message);
				        */
					// Kirim Email
                    sendMail($email, $pesan, "WELCOME TO Crypto 2 Bank");
                    return new Response("SUCCESS", 200);
                } else {
                    return new Response('FAILED', 200);
                }
            }
        }
    });
    // End Handler
    $app->get('/register-account', function() {
       
        global $hooks;
        $hooks->add_action('global_css', "dreg_css");
		$hooks->add_action('global_js', 'editprofile_js');
        $hooks->add_action('global_js', "dreg_js");
        $hooks->add_action('global_js', "step_js");
        $hooks->add_action('the_title', "dreg_title");
        the_head();
        include 'dreg.tpl.php';
        the_footer();
        return "";
    });
}



include 'dreg.func.php';
