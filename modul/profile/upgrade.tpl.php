<?php 
$plan = checkplan(); 
$current_plan = $plan[0]['product_id'];
$firstblock = $secondblock = $thirdblock = $fourthblock = "";	
$status1 = $status2 = $status3 = $status4 = "Upgrade Now";
if($current_plan == "27"){
	$firstblock = "disabled";
}
if($current_plan == "28"){
	$firstblock = "disabled";
	$secondblock = "disabled";
}
if($current_plan == "29"){
	$firstblock = "disabled";
	$secondblock = "disabled";
	$thirdblock = "disabled";
}
if($current_plan == "30"){
	$firstblock = "disabled";
	$secondblock = "disabled";
	$thirdblock = "disabled";
	$fourthblock = "disabled";
}
?>

<div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Upgrade Package
                        </header>
                        <div class="panel-body">
						<?php if($current_plan == "30"){  ?>
							<div id='suksesupdate' class="alert alert-success alert-block fade in">
                               <h4>
                                    <i class="icon-ok-sign"></i>
                                    Sorry!
                                </h4>
                                <p>You Cannot Upgrade</p>
                            </div>
						<?php  }  ?>	
                            <div id='suksesupdate' class="alert alert-success alert-block fade in" style='display:none;'>
                               <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Yehaa.. Your PIN has been updated. Reload page in few seconds..</p>
                            </div>
                            <div id='gagalupdate' class="alert alert-danger alert-block fade in" style='display:none;'>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Whoops!
                                </h4>
                                <p>Cant update your PIN, please make sure that you enter correct PIN & Token</p>
                            </div>
                            
                            <div class="row">
                                <!-- item -->
                                <div class="col-md-3 col-sm-4 col-xs-12 text-center">
                                    <div class="panel panel-pricing">
                                        <div class="panel-heading">
                                            <img src="http://mysaiworld.org/wp-content/uploads/2017/06/favicon.png" style="filter: brightness(0) invert(1);">
                                            <h3>USD 100</h3>
                                        </div><!--panel-heading close-->
                                        <div class="panel-body text-center" style="display:none">
                                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                                            <p class="p-time">2 days - 30 Mins</p><!--p-time close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-body text-center">
                                            <p class="p-price">$ 100.00 </p><!--p-price close-->
                                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-footer">
						<?php if($current_plan == "27"){ $status1 = "Current Plan"; } ?>
                                            <a class="btn sub-btn upgrade" data-toggle="modal" product="27" amount="100" data-target="#upgrade" <?php echo $firstblock; ?> href="#"><?php echo $status1; ?></a>
                                        </div>
                                    </div><!--panel panel-pricing close-->
                                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->
                                <!-- item -->
                                <div class="col-md-3 col-sm-4 col-xs-12 text-center">
                                    <div class="panel panel-pricing">
                                        <div class="panel-heading">
                                            <img src="http://mysaiworld.org/wp-content/uploads/2017/06/favicon.png" style="filter: brightness(0) invert(1);">
                                            <h3>USD500</h3>
                                        </div><!--panel-heading close-->
                                        <div class="panel-body text-center" style="display:none">
                                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                                            <p class="p-time">2 days - 30 Mins</p><!--p-time close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-body text-center">
                                            <p class="p-price">$ 500.00 </p><!--p-price close-->
                                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-footer">
					    <?php if($current_plan == "28"){ $status2 = "Current Plan"; } ?>
                                            <a class="btn sub-btn upgrade" data-toggle="modal" product="28" amount="500" data-target="#upgrade" <?php echo $secondblock; ?> href="#"><?php echo $status2; ?></a>
                                        </div>
                                    </div><!--panel panel-pricing close-->
                                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->


                                <div class="col-md-3 col-sm-4 col-xs-12 text-center">
                                    <div class="panel panel-pricing">
                                        <div class="panel-heading">
                                            <img src="http://mysaiworld.org/wp-content/uploads/2017/06/favicon.png" style="filter: brightness(0) invert(1);">
                                            <h3>USD 1000</h3>
                                        </div><!--panel-heading close-->
                                        <div class="panel-body text-center" style="display:none">
                                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                                            <p class="p-time">7 days - 90 Mins</p><!--p-time close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-body text-center">
                                            <p class="p-price">$ 1000.00 </p><!--p-price close-->
                                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-footer">
					   <?php if($current_plan == "29"){ $status3 = "Current Plan"; } ?>
                                            <a class="btn sub-btn upgrade" data-toggle="modal" product="29" amount="1000" data-target="#upgrade" <?php echo $thirdblock; ?> href="#"><?php echo $status3; ?></a>
                                        </div>
                                    </div><!--panel panel-pricing close-->
                                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->



                                <div class="col-md-3 col-sm-4 col-xs-12 text-center">
                                    <div class="panel panel-pricing">
                                        <div class="panel-heading">
                                             <img src="http://mysaiworld.org/wp-content/uploads/2017/06/favicon.png" style="filter: brightness(0) invert(1);">
                                            <h3>USD 1500</h3>
                                        </div><!--panel-heading close-->
                                        <div class="panel-body text-center" style="display:none">
                                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                                            <p class="p-time">30 days - 250 Mins</p><!--p-time close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-body text-center">
                                            <p class="p-price">$ 1500.00 </p><!--p-price close-->
                                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                                        </div><!--panel-body text-center close-->
                                        <div class="panel-footer">
                                            <?php if($current_plan == "30"){ $status4 = "Current Plan"; } ?>
                                            <a class="btn sub-btn upgrade" data-toggle="modal" amount="1500" product="30" data-target="#upgrade" <?php echo $fourthblock; ?> href="#"><?php echo $status4; ?></a>
                                        </div>
                                    </div><!--panel panel-pricing close-->
                                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->

                            </div><!--row close-->
                            
                        </div>
                    </section>
                </div>
            </div>
<!-- Modal -->
  <div class="modal fade" id="upgrade" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upgrade Package</h4>
        </div>
        <div class="modal-body">
            <div id='successupgrade' class="alert alert-success alert-block fade in" style='display:none;'>
			   <h4>
					<i class="icon-ok-sign"></i>
					Success!
				</h4>
				<p>User Upgrade Successful</p>
			</div>
			<div id='failureupgrade' class="alert alert-danger alert-block fade in" style='display:none;'>
			   <h4>
					<i class="icon-ok-sign"></i>
					Failure!
				</h4>
				<p>User Upgrade Failure Please Check Your Pin and Ensure You have Sufficient Funds</p>
			</div>
              
			<div id="payment-div">
            <div class="col-md-6">
                <input id="pay1" name="question" type="radio" checked="checked" class=" radio with-font" onclick="paymentmsghide();"/>
                <label for="pay1">Full Payment</label>
            </div>
            <div>
                <input id="pay2" name="question" type="radio" class="with-font" onclick="paymentmsg();"/>
                <label for="pay2">Partial Payment</label>
                </div>
			
                            <div id="paymentmsg" style="display:none;" class="alert alert-success">
                                <strong>50%</strong> of the amount will be Deducted From Register Wallet <br/>
                                <strong>50%</strong> From the E-Wallet if E-wallet balance is less than E-wallet blance will be go under minus values.
                            </div>
                <div><hr /></div></div>
    
            <div>
                <lable>Enter your 6 Digit Secure Pin Number</lable>
                <input class="form-control " id="pinverify" name="pinverify" type="password" required="">
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" name="btn" value="Submit" id="submit-upgrade" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" />
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
