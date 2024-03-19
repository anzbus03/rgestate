<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Billing Information</h4>
                    
                      <?php $common_name = Yii::app()->options->get('system.free_bites.site_name') ; ?> 
                      <?php   $this->renderPartial('_billing_information',array('model'=>$model,'common_name'=>$common_name ));?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>

</div> 
    
                

 
