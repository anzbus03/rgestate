<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
     .col-sm-5 label { text-align:left;float: left; } .nolabel label { display:none; }
     .collapse:not(.in) {
    display: none;
}
.main-panel { margin-left:0px; }.myaccount-menu.is-ended{ display: none; }
#ListingUsers_password input { max-width:100%;}
 </style>
 	 <style>.pwdstrength { position:absolute; } #ListingUsers_password{position:relative; } .pwdstrengthstr{position: absolute;top: -19px;right: 3px;} </style>
						
						 
<style>
    .card-1 .subheading_font { display:block; }
    ul.account_details li { line-height:1.5; }
</style>
<div class="container">

	<div class=" ">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div>
           
             <h4 class="subheading_font row bold-style">Top Up Account - <?php echo $method;?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
			   <div style="margin:auto;line-height:1;text-align: center;position: absolute;right: 10px;/*! top: 50px; */">
				   <?php
				   
				   switch($payment){
					   case 'e':
						echo ' <img src="'.Yii::app()->apps->getBaseUrl('assets/img/easypiasa_logo.png').'" style="max-width:100px;">';
						break;
					   case 'b':
						echo ' <img src="'.Yii::app()->apps->getBaseUrl('assets/img/bankt.png').'" style="max-width:100px;">';
						break;
					}
					?>
			</div>
			<Style>
			.headbd { font-weight:600;}
			</Style>
			 
		 	<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-12 headbd">Account Details - <?php echo $method;?></div>
					<div class="col-sm-12">
						<?php $lines = explode("\n", $account_details); ?> 
					<ul style="padding:0px;" class="account_details">
						<?php
						foreach($lines as $det){ 
							?>
					<li><?php echo $det;?></li>
					 <?php } ?> 
					</ul>
					
					</div>
				</div>
			</div>
			
			
			
			<?php
			
			 $form = $this->beginWidget('CActiveForm'); 
			 if($order->isNewRecord and !Yii::app()->request->isPostRequest){$order->total = '';  }
			 ?>
			
			           <div class="">
                  
                <div class="">
                   
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($order, 'total');?>
                            <?php echo $form->textField($order, 'total', $order->getHtmlOptions('total',array('placeholder'=>'','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ))); ?>
                            <?php echo $form->error($order, 'total');?>
                        </div>
                    </div>
                </div>      
                 <div class="">
                 
                </div>
               
                <div class="">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo $form->textArea($note, 'note', $note->getHtmlOptions('note')); ?>
                            <?php echo $form->error($note, 'note');?>
                        </div>
                    </div>
                </div>
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
              
                ?>
             </div>
             <div class="clearfix"></div>
      		<div class="form-group col-sm-12   margin-bottom-10 ">

						    <div class="row">

						 
							<div class="col-sm-8">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"  style="display:inline;min-width: 100px !important;width: 150px !important;margin-right: 20px;"    />Finish</button>
							<a href="<?php echo Yii::app()->createUrl('member/topup_options');?>">Cancel</a>
							</div>
		</div> 
						
			
			<?php $this->endWidget();  ?>
			 
			<div class="clearfix"></div>
			 
            <!-- Login -->		 
		</div>
					 
					 
				</div>
				</div>
				</div>

			 
			  
     	 
			<!-- Register -->
		 
           
            
              <h4 class="subheading_font row bold-style">For Assitance</h4>
                  <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab2" style="border-top: 0px solid #e0e0e0;">
				<p class="text-center">For any asistance call us at</p>
				<p class="numdet text-center"><a href="tel:<?php echo Yii::app()->options->get('system.common.assistance_nmber','+92 300 7322294');?>" style="font-size: 23px;line-height: 25px;" target="_blank"><?php echo Yii::app()->options->get('system.common.assistance_nmber','+92 300 7322294');?>  (FEETA)</a></p>
              <div class="clearfix"></div>
              </div>
              </div>
              
         	</div>

			<!-- Register -->
		 
            </div>
         
  
        
          </div>
       
		

		</div>
		 
		
	 </div>

</div> 
