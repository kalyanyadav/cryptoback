<div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Follow wizard below to register new Account / Downline
                        </header>
                        <div class="panel-body">
                        <div id='suksesupdate' class="alert alert-success alert-block fade in" style='display:none;'>
                               <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Yehaa.. New user has been created.. Reloading page.</p>
                            </div>
                            <div id='gagalupdate' class="alert alert-danger alert-block fade in" style='display:none;'>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Whoops!
                                </h4>
                                <p>Cannot register member, make sure your PIN is correct, also make sure you have sufficient register balance. 
                                    </p>
                            </div>    
                    <div class="box-widget">
                        <div class="widget-head clearfix">
                            <div id="top_tabby" class="block-tabby pull-left">
                            </div>
                        </div>
                        <div class="widget-container">
                            <div class="widget-block">
                                <div class="widget-content box-padding">
                                    <form id="stepy_form" class=" form-horizontal left-align form-well" method="POST">
									
                                        <fieldset title="Step 1">
                                            <legend>user credential</legend>
											<div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Username</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="uname" id="uname" type="text"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Email Address</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="email" id="email" type="email"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Password</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="pass" id="pass" type="password"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Confirm Password</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control" name="pass_conf" id="pass_conf" type="password"/>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset title="Step 2">
                                            <legend>user information</legend>
                                           <div class="form-group">
                                        <label for="fname" class="control-label col-lg-2">First Name (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="fname" name="fname" minlength="2" type="text" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname" class="control-label col-lg-2">Last Name (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="lname" name="lname" minlength="2" type="text" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="control-label col-lg-2">Gender</label>
                                        <div class="col-lg-10">
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="MALE" >Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Relation</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="relation" name="relation" placeholder="" class="form-control" >
                                        <span class="help-inline">Friend, Brother, Sisters, Etc</span>
                                    </div>
                                    </div>  
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Beneficiary</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="beneficiary" name="beneficiary" placeholder="" class="form-control" >
                                        <span class="help-inline"></span>
                                    </div>
                                    </div>      
									<div class="form-group">
                                    <label class="col-sm-2 control-label">Country (required)</label>
                                    <div class="col-sm-10">
                                        <!--select class="form-control" id="prefix" name="prefix" required>
												 <option></option>
											   <option value="60">Malaysia</option>
                                                <option value="91">India</option>
                                            </select-->
					<input type="text" id="prefix" name="prefix" placeholder="" class="form-control" >

                                        
                                    </div>
                                    </div>									
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-10">
										<span class="help-inline">Please enter your mobile number with country code example : +60, +91</span>
										<input type="text" id="mobile" name="mobile" placeholder="+60123456789" class="form-control" >
                                        
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="phone" name="phone" placeholder="" class="form-control" >
                                        
                                    </div>
                                    </div>
                                        </fieldset>
                                        <fieldset title="Step 3">
                                            <legend>address information</legend>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-2">Address (required)</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control " id="address" name="address" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="control-label col-lg-2">City (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="city" name="city" minlength="2" type="text" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip" class="control-label col-lg-2">Zip (required)</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="zip" name="zip" minlength="2" type="text" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="control-label col-lg-2">State</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="state" name="state" minlength="2" type="text" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="control-label col-lg-2">Country</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="country" name="country" minlength="2" type="text" required />
                                        </div>
                                    </div>
                                        </fieldset>
                                        <fieldset title="Step 4">
                                            <legend>bank information</legend>
                                             <div class="form-group ">
                                        <label for="bank_name" class="control-label col-lg-2">Bank Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " name="bank_name" id="bank_name" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="branchname" class="control-label col-lg-2">Branch Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " name="branchname" id="branchname" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="holder" class="control-label col-lg-2">Holder Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " name="holder" id="holder" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="acnumber" class="control-label col-lg-2">Account Number</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " name="acnumber" id="acnumber" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="swiftcode" class="control-label col-lg-2">Swift Code</label>
                                        <div class="col-lg-10">
                                            <input class="form-control " name="swiftcode" id="swiftcode" type="text"/>
                                        </div>
                                    </div>
                                        </fieldset>
                                        <fieldset title="Step 5">
                                            <legend>package & sponsor</legend>
                                            <?php if(have2Leg($_SESSION["uid"])){ ?>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Join Value</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select id='product' name='product' class="form-control">
                                                        <?php echo thePackage(); ?>
                                                    </select>
                                                </div>
                                            </div>
											<div style="display:none;" id="payment-div">							
												<div class="col-md-2"></div>
												<div class="col-md-4">
													<input id="pay1" name="question" type="radio" checked="checked" class=" radio with-font full" onclick="paymentmsghide();">
													<label for="pay1">Full Payment</label>
												</div>
												<div>
												<input id="pay2" name="question" type="radio" class="with-font partial" onclick="paymentmsg();">
												<label for="pay2">Partial Payment</label>
												</div>
												<input type="hidden" value="full" name="paytype" id="paytype"> 
															<div id="paymentmsg" style="display:none;" class="alert alert-success">
																<strong>50%</strong> of the amount will be Deducted From Register Wallet <br>
																<strong>50%</strong> From the E-Wallet if E-wallet balance is less than E-wallet blance will be go under minus values.
															</div>
												<div><hr></div>
											</div>
                                           <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Sponsor Username</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control " name="sponsor" id="sponsor" type="text" value="<?php echo strtoupper($_SESSION["uname"]); ?>" required/>
                                                </div>
                                            </div>
                                            <!--div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Upline / Placement</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select id='position' name='position' class="form-control">
                                                        <?php echo ($_SESSION["role"]=="0"?"<option value='0'>ADMIN ( NEW NETWORK )</option>":""); ?>
                                                        <?php echo availPosition(); ?>
                                                    </select>
                                                    <span class="help-inline">Please make sure your decide first by looking your genealogy tree for help. Click <a href="/genealogy/tree" target="_blank">here</a></span>
                                                </div>
                                            </div-->
                                           
                                            <?php }else{ ?>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Select Package</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <select id='product' name='product' class="form-control">
                                                        <?php echo thePackage(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Sponsor Username</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input class="form-control " name="sponsor" id="sponsor" type="text" value="<?php echo strtoupper($_SESSION["uname"]); ?>" required/>
                                                    <span class="help-inline">You can change the username to another username, please make user that the username is exist</span>
                                                </div>
                                            </div>
                                            
                                            <input type='hidden' id='position' name='position' val="1">
                                            <?php } ?>
                                            
                                        </fieldset>
                                        <fieldset title="Step 6">
                                            <legend>security confirmation</legend>
                                            <div class="form-group">
                                                <label class="col-md-2 col-sm-2 control-label">Transaction PIN</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="password" id="pin" name="pin" class="form-control">
                                                    <div>
                                                         You need to verify your account ownership, please fill the PIN above to verify.
                                                    </div>       
                                                </div>
                                            </div>
                                            
                                        </fieldset>
                                        <button type="submit" class="finish btn btn-info btn-extend" id="finish"> Finish!</button>
                                        <button type="submit" class="finish btn btn-info btn-extend" id="wait" style="display:none;" disabled>Registering User.. Please Wait</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </section>
                </div>
            </div>
