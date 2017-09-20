<div class="row">
    <div class="col-md-12">
        Here you can view all of your genealogy network tree, you can view your downline network also.<br>
        If you want to view your downline's network, just click on their box and you will get the information about their networking
    </div>
    <div class="col-md-12">
        <div class="pan-container">
            <div id='treeview-pan' class='pan-wrap'>
               <div class="tree">
                    <ul style='min-width:2000px;'>
                        <li data-id='<?php echo $_SESSION['uid']; ?>'>
                            <a href="#">
                                <div>
                                    <h3><i class='fa fa-star'></i> <?php echo strtoupper($_SESSION["uname"]); ?></h3>
                                    <?php if($_SESSION["role"]=="1"){ ?>
                                    <p>
                                        Donations : $<?php echo theInvest($_SESSION["uid"]); ?>
                                    </p>
                                    <div class='col-md-12 nodes-info'>
                                        <div class='col-md-3'>
                                          <?php echo countNodes($_SESSION["uid"],"left"); ?>
                                        </div>
                                        <div class='col-md-6 midx'>
                                            Downlines
                                        </div>
                                        <div class='col-md-3'>
                                             <?php echo countNodes($_SESSION["uid"],"right"); ?>
                                        </div>
                                        <div class='clearfix'></div>
                                    </div>  
                                    <div class='col-md-12 invest-info'>
                                        <div class='col-md-6 linfest'>
                                            <strong>Left Donation</strong><br>
                                          $<?php echo countInvest($_SESSION["uid"],"left"); ?>
                                        </div>
                                        <div class='col-md-6 rinfest'>
                                            <strong>Right Donation</strong><br>
                                             $<?php echo countInvest($_SESSION["uid"],"right"); ?>
                                        </div>
                                        <div class='clearfix'></div>
                                    </div> 
                                    <?php } ?>
                                </div>
                            </a>
                                <?php echo theTree(firstDownline($_SESSION["uid"])); ?>




                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id='tree-loading'>
            <h2 style="text-align: center;padding-top: 40px;">LOADING YOUR NETWORK TREE</h2>
        </div>
    </div>
</div>
<div class='row' style='margin-top:20px;'>
    <div class='col-md-6'>
        <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">How to use ?</h3>
                        </div>
                        <div class="panel-body">
                            <p>On this feature you can see all of the members listed on your network, ranging from the sponsored person and existing members under you.</p>
                            <p>
                                1. Hover Your mouse into the tree chart</br>
                                2. You can drag the chart so you can extend your diagram view</br>
                                3. If you want to see your downline's network, just click on their box and you will get the information
                            </p>
                        </div>
                    </div>
    </div>
</div>