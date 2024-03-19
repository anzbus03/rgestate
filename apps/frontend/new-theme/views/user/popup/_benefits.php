<div class="lastrow   margin-top-5"><span class="pull-left bg-warning"><i class="fa fa-info-circle"></i> We won't share your personal details with anyone</span><div class="clearfix"></div></div>
<div class="clearfix"></div>
<?php
$benefits = Yii::app()->options->get('system.common.benefites_of_register'); ?>
<?php
if(!empty($benefits)){ ?>
<div class="benefit_login">
<div class="col-md-12 bck-header-1">
              
                <div class="pentagon-icon-div">
                    <h5>
                        <i class="fa fa-users header-icon"  ></i> 
                        <span class="headeri"  >Benefits of Login / Register</span>
                    </h5>
                </div>
                <div class="clearfix"></div>
            </div>
             
<div class="col-md-12 content-pad-0" style="overflow-y:auto;text-align:justify;" id="memberAlert">
                    <ul class="content-ul">  
						<?php 
						$your_array = explode("\n", $benefits); 
						foreach($your_array as $line){
							echo Yii::t('app','<li><i class="fa fa-caret-right icon-brown"></i><span>{line}</span></li>',array('{line}'=>$line));
						}
						?> 
                    </ul>
                </div> 
 <div class="clearfix"></div>
 </div>
 <?php } ?> 
 <div class="clearfix"></div>
