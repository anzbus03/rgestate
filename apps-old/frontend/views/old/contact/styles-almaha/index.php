  <section>
		<div id="headerNewplaceNew">
		<div  class="newsearch-main-div-2 cf shrink_control" style="top:48px;">
			<?php   $this->widget('frontend.components.web.widgets.searchHeader.searchHeaderWidget');?>

		</div>
		</div>
  </section>
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container margin-top-240">
<div class="container_content">	 
 
            
    <div class="agent-unit-pro-details-div">
 	<div class="navigate_link"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Home</a> <span>&gt;  <?php echo  Countries::model()->getDefaultCountry();?> </span><span> &gt; Contact</span></span></div>
	<div class="bottom_line_2 crmbrimg">
	<span></span>
	<span></span>
	</div>
	<h1 class="crumbarHeadingCms"> <span class="bluecolor"> Contact Us</span>  </h1>
    
    <div class="">
      
    
    <div class="overview-control-div"> 
		<div class="row">
				 
				</div>
        <div class="stagc-loc-txt"> 
			<span class="ovr-vw-txt width100 font12">  Thank you for your interest in <?php  echo  Yii::app()->options->get('system.common.site_name') ;?> services. Please provide the following information about your business needs to help us serve you better. This information will enable us to route your request to the appropriate person. You should receive a response within 48 hours.</span>
		 
          
        </div>
    </div>
	<div style="clear:both"></div>
	<div class="map"  > 
	<iframe src="https://www.google.com/maps/embed/v1/place?q=Al+Maha+Real+Estate+-+Sheikh+Zayed+Road+-+Dubai+-+United+Arab+Emirates&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU" width="100%" height="285" frameborder="0" style="border:0"></iframe>
	<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
          <div class="add-contact  stagc-loc-txt-span1" id="add-contact">
                <div class="row">
                  <div class="span280px pull-left addressForm">
                    <div class="ovr-vw-txt" style="color:#333;">Contact address</div>
                   <?php  echo  nl2br(Yii::app()->options->get('system.common.contact_address'));?>
                  </div>
                  <div class="span280px pull-left addressForm">
					  <br />
					  <br />
					  <br />
                    <strong>Phone</strong><?php  echo  Yii::app()->options->get('system.common.contact_phone') ;?> <br/>
                    <strong>Fax.</strong><?php  echo  Yii::app()->options->get('system.common.contact_fax') ;?> <br/>
                    <strong>Email.</strong> <a href="mailto:<?php  echo  Yii::app()->options->get('system.common.contact_email') ;?>?subject=SweetWords &body=Please send me a copy of your new program!"><?php  echo  Yii::app()->options->get('system.common.contact_email') ;?></a> <br/>
                  </div>
                </div>
              </div>
               
		<div style="clear:both"></div>
		<div class="div-hr4-unit"></div>
		<div class="overview-control-div">
		<h1 class="crumbarHeadingCms">
		<span class="bluecolor" style="font-size:16px;"> Send Enquiry</span>
		</h1>
		</div>
		 
		<div style="height:20px;clear:both;"></div>
		  <div class="contact-form" id="contact-form">
				<?php
				$form = $this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl('contact#contact-form'),
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
				));
				?>
				<div class="row">
				<?php
				if(Yii::app()->user->hasFlash('success'))
				{
					echo '<div><p class="sucessClass"><b>'.Yii::app()->user->getFlash('success').'</b></p></div>';
				}
				?>
				</div>
                
                  <div class="span280px">
                    <?php echo $form->labelEx($model, 'name');?>
                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
					<?php echo $form->error($model, 'name');?>
                  </div>
                  <div class="span280px pull-right">
					<?php echo $form->labelEx($model, 'email');?>
					<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
					<?php echo $form->error($model, 'email');?>
                  </div>
                  <div style="clear:both" class="height10"></div>
                  <div class="span280px">
                    <?php echo $form->labelEx($model, 'phone');?>
					<?php echo $form->textField($model, 'phone',$model->getHtmlOptions('phone')); ?>
					<?php echo $form->error($model, 'phone');?>
                  </div>
                  <div class="span280px pull-right">
					
					
					<?php echo $form->labelEx($model, 'city');?>
					<?php echo $form->textField($model, 'city',$model->getHtmlOptions('city')); ?>
					<?php echo $form->error($model, 'city');?>
                  </div>
                 <div style="clear:both" class="height10"></div>
                <?php echo $form->labelEx($model, 'meassage');?>
                <?php echo $form->textArea($model, 'meassage',$model->getHtmlOptions('meassage')); ?>
				<?php echo $form->error($model, 'meassage');?>
				<div style="height:20px"  ></div>
                <button class="button-send back-searchbutton" type="submit"  >Submit</button>
                <div style="height:20px;clear:both;"></div>
             <?php $this->endWidget(); ?>
            </div>	 
		<div style="clear:both"></div>	 
</div>
</div>
<div style="clear:both"></div>	
</div>
</div>
</div>
 <style>
 

.stagc-loc-txt-span2   li {
    float: left;
    margin-right: 20px;
     list-style:disc;
    width: 100%;
    margin-left:10px;
    line-height:25px;
    
}
.stagc-loc-txt-span2   li a {
    
    color:#002d72;
}
 .map {
    border  : 1px solid  #eee ;
    margin-bottom:20px;
    padding: 10px ;
}
.height10{
	height:10px;
}

.addressForm{  
color : #6a6c6b ; 
font-size:13px;
}
p.sucessClass{
	color:green;text-indent:0px;font-size:13px
}
 </style>
