<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
 
		<?php
		if($this->member->filled_info != '1'){ ?>
		<div class="row purchace-popup">
		<div class="col-12">
		<div class="alert alert-warning">
		<strong>Info!</strong> Please fill Personal information .  
		</div> </div>
		</div>
		<?php }?>
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="form-group col-lg-12"><h4 class="card-title">Personal Information</h4></div>
                   
                      <?php $common_name = Yii::app()->options->get('system.free_bites.site_name') ; ?> 
                      <?php $this->renderPartial('_personal_information',array('model'=>$model,'common_name'=>$common_name ));?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
       
                

 
