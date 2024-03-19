<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
 
	 
		
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class=" ">
                    <div class="">
                        <div class="form-group col-lg-12 padding-left-0"><h4 class="card-title mb-4"><?php echo $this->member->TypeTile;?> Profile Information</h4></div>
                   
                      <?php $common_name = Yii::app()->options->get('system.free_bites.site_name') ; ?> 
                      <?php $this->renderPartial('_personal_information',array('model'=>$model,'common_name'=>$common_name ));?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
       
                

 
