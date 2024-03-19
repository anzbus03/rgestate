<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
     .col-sm-5 label { text-align:left;float: left; } .nolabel label { display:none; }
     .collapse:not(.in) {
    display: none;
}
.main-panel { margin-left:0px; }.myaccount-menu.is-ended{ display: none; }
#ListingUsers_password input { max-width:100%;}.package-detail-ul   { list-style-type:none; margin:0px; padding:0px;}.package-detail-ul li.title  { font-weight:600; }
 
 </style>
 	 <style>.pwdstrength { position:absolute; } #ListingUsers_password{position:relative; } .pwdstrengthstr{position: absolute;top: -19px;right: 3px;} </style>
						
						 
<style>
    .card-1 .subheading_font { display:block; }
    ul.account_details li { line-height:1.5; }
    .p-img-payment { margin:auto;line-height:1;text-align: center;position: absolute;right: 10px;/*! top: 50px; */}
    html[dir='rtl'] .p-img-payment{ right:unset; left:10px; }
</style>
<div class="container">

	<div class=" ">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div>
           
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('subscribe','Subscribe');?> - <?php echo $packageModel->package_name;?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
			   <div class="p-img-payment">
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
					<div class="col-sm-12 headbd"><?php echo $this->tag->getTag('payment_method','Payment Method');?> - <?php echo $method;?></div>
						<?php $lines = explode("\n", $account_details); 
						if(!empty($account_details)){ 
						?> 
					<div class="col-sm-12 headbd"><?php echo $this->tag->getTag('account_detail','Account Detail');?></div>
					<div class="col-sm-12">
					
					<ul style="padding:0px;" class="account_details">
						<?php
						foreach($lines as $det){ 
							?>
					<li><?php echo $det;?></li>
					 <?php } ?> 
					</ul>
					
					</div>
					<?php } 
					if($payment=='m'){
					    ?><div class="col-sm-12"><img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/mada.png?q=1');?>" alt="MADA Card"> <img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/mastercard.png?q=1');?>" alt="mastercard Card"> <img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/visa.png?q=1');?>" alt="visa"></div><?php
					}
					
					?> 
				</div>
			</div>
			
			<div class="col-sm-12 headbd"><?php echo $this->tag->getTag('package_details','Package Details');?></div>
			<div class="col-sm-12"><?php echo $packageModel->PackageDetails;?></div>
					
			
			<?php
			
			 $form = $this->beginWidget('CActiveForm'); 
			 if($order->isNewRecord and !Yii::app()->request->isPostRequest){
				 
				 
        
				 //$order->total = $packageModel->price_per_month; 
				 }
			   
				
			 ?>
			
			           <div class="">
                  
                <div class="">
                   
                    <div class="col-lg-12">
                            <table class="table margin-top-20">
                    <tr>
                        <th style="width:50%"><?php echo Yii::t('orders', $order->getAttributeLabel('subtotal'))?>:</th>
                        <td><?php echo $order->formattedSubtotal;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('tax_value'))?>:</th>
                        <td><?php echo $order->formattedTaxValue;?></td>
                    </tr>
                    <?php
                    if(!empty($order->discount)   ){ ?> 
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('discount'))?>:</th>
                        <td><?php echo $order->formattedDiscount;?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('total'))?>:</th>
                        <td><span style="font-size:30px;font-weight:600;"> <?php echo $order->FormattedTotal;?></span></td>
                    </tr>
                     
                </table>
                         
                        <div class="form-group">
                             <?php echo $form->hiddenField($order, 'total', $order->getHtmlOptions('total',array('placeholder'=>'','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ))); ?>
                            <?php echo $form->error($order, 'total');?>
                            <?php $order->plan_id = $packageModel->package_id; $order->currency_id = $packageModel->currency_id; ?>
                            <?php echo $form->hiddenField($order, 'plan_id'); ?>
                            <?php echo $form->error($order, 'plan_id');?>
                            <?php echo $form->hiddenField($order, 'currency_id'); ?>
                            <?php echo $form->error($order, 'currency_id');?>
                         
                            
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

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s margin-right-20"   id="bb"  style="display:inline;min-width: 100px !important;width: 150px !important;"    /><?php if($payment=='m') { echo $this->tag->getTag('process_payment','Process Payment');  }else { echo    $this->tag->getTag('finish','Finish');  } ;?></button>
							<a href="<?php echo Yii::app()->createUrl('member/addons');?>"><?php echo $this->tag->getTag('cancel','Cancel');?></a>
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
		 
           
            
              <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('for_assitance','For Assitance');?></h4>
                  <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab2" style="border-top: 0px solid #e0e0e0;">
				<p class="text-center"><?php echo $this->tag->getTag('for_any_asistance_call_us_at','For any asistance call us at');?></p>
				<p class="numdet text-center"><a href="tel:<?php echo Yii::app()->options->get('system.common.support_phone','+92 300 7322294');?>" dir="ltr" style="font-size: 23px;line-height: 25px;" target="_blank"><?php echo Yii::app()->options->get('system.common.support_phone','+92 300 7322294');?>  (<?php echo $this->project_name;?>)</a></p>
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
