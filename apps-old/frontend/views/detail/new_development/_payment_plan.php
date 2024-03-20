<div id="payment-plan">

    <!-- blog section start --->
    <div id="_floor_plans" class="mid-level-padding" style="background:#eee;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 wow slideInLeft animated" style="visibility: visible; animation-name: slideInLeft;">
                    <div class="left-section">
                        <div class="row">
                            <div class="col-xs-12  ">
                                <div class="section-top-heading" style="margin-bottom: 20px">
                                    <h5 style="margin-bottom:0px;"> <?php echo $model->adTitle;?>  </h5>
                                    <h2>Floor Plan</h2>
                                </div>
                            </div>

                        </div>
                        

                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9">
					 
                    <div class="row wow fadeInUp animated" data-wow-duration="3s" style="visibility: visible; animation-duration: 3s;">
						<?php
						foreach($floor as $k=>$v){ ?> 
                        <div class="col-sm-12 ">
                            <div class="middle-section blog-section wow animated" style="visibility: visible;">
								<?php
								$file = $this->app->apps->getBaseUrl('uploads/floor_plan/'.$v->floor_file);
								?>
                                <h4><div style="width:calc(100%- 100px);float:left"></div><?php echo $v->floor_title;?><div style="width:100px;float:right"><a href="<?php echo $file;?>" target="_blank">View</a></a></div></h4>
                            </div>
                        </div> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog section end --->

  

</div>
