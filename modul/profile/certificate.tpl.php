<?php
$userId = getuserId();
$availableFunds = current_fund();
?>
<div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <a href="" class="btn btn-success"  onclick='printDiv();'>Print Certificate</a>
                        </header>
                        <div class="panel-body" id="print-view">
						<?php if($availableFunds<0){ ?>
						<div class="alert alert-danger">Please pay full amount to download or print the certificate</div>
						<?php } ?>
						<?php if($availableFunds>=0){ ?>
						<div id="certificate">
						<div><img src=".\..\assets\images\certificate.jpg" width="1000px"></div>
						<!-- Serial No -->
						<div class="cert-serial">
						Serial No : <strong><?php echo sprintf('%08d', $userId[0]['uid']); ?></strong>
						</div>
						
						<!-- Full name -->
						<div class="cert-content">
	This is to certify that <b>&nbsp;<?php echo $userId[0]['first_name'] . " " . $userId[0]['last_name']; ?> &nbsp;</b> has donated one Shirdi Sai
	Baba Statue succeeding the emplacement related services to </br>
MYSAIWORLD PARK </br>
subject to terms and conditions stipulated to this certificate,  </br>
for the amount of $ <strong>&nbsp;<?php echo $userId["product"][0]["value"];?> &nbsp;</strong> on <b>&nbsp;<?php 
						$yrdata= strtotime($userId["user"][0]["register_date"]);
						echo date('d M Y', $yrdata);
						?>&nbsp;</b>.
						</div>
						</div>
						<?php } ?>
                        </div>
						
						<div style="display:none;">
						
						<div  id="print-cert" style="margin:0px;">
						<div><img src=".\..\assets\images\certificate.jpg" width="1000px"></div>
						<!-- Serial No -->
						<div style="position: absolute; top: 600px; left: 660px; font-size: 20px; text-align: center; display: block; font-weight: bold; width: 300px; font-family:serif; color: #333;">
						Serial No : <strong style="color:red;"> <?php echo sprintf('%08d', $userId[0]['uid']); ?></strong>
						</div>
						
						<!-- Full name -->
						<div style="position: absolute; top: 650px; font-size:24px; text-align: center; display: block; font-weight: bold; width:80%; padding:0px 100px; margin:0 auto; color: #333; font-family: serif;	line-height:60px;">
	This is to certify that <strong style="color:#333; text-decoration:underline;"> &nbsp; <?php echo $userId[0]['first_name'] . " " . $userId[0]['last_name']; ?> &nbsp;</strong> has donated one Shirdi Sai
	Baba Statue succeeding the emplacement related services to </br>
MYSAIWORLD PARK </br>
subject to terms and conditions stipulated to this certificate,  </br>
for the amount of $ <strong style="color:red; text-decoration:underline;"> &nbsp; <?php echo $userId["product"][0]["value"];?> &nbsp;</strong> on 
<strong style="color:#333; text-decoration:underline;"> &nbsp; <?php 
						$yrdata= strtotime($userId["user"][0]["register_date"]);
						echo date('d M Y', $yrdata);
						?>&nbsp;</strong>.
						</div>
                        </div>
						</div>
                    </section>
                </div>
            </div>
