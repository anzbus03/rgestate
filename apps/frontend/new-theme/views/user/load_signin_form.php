	 
<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
         
          <div class="tabs-container alt" id="tabs-container" style="border-top:0px solid #eee;"> 

            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top:0px solid #eee;">
			<?php $this->renderPartial('_login_partial_ajax',array('short'=>'1'));?>
			
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;border-top:0px solid #eee;">
				
			 
			<?php   $this->renderPartial('_register_partial_ajax',array('short'=>'1'));?>
			
			</div>
            </div>
          </div>
       

		

		</div>
	 
