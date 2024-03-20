<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container-wrapper">
	<div class="center">
			<div class="clear"></div>
			
				<div class="row adv_sec" data-layer-category="breadcrumbs">
					<ul class="large-9 columns breadcrumbs">
					   <li class="angleright"><a href="<?php echo Yii::app()->createUrl('advertisement/details',array('slug'=>'home'));?>">Home</a></li>
					 
						<li  class="current">   <a href="javascript:void(0)">Contact Us</a> </li>
					</ul>
				</div>
				
				
				<div id="container"> <!-- start container -->
						
					<div class="main-left adv_sec">	
				 
			 		
											<div id="post-968" class="post-968 post type-post status-publish format-image has-post-thumbnail hentry category-news category-reviews">
						   <div class="post-showing-type1-wrapper">
							  <div class="post-showing-type1">
								 <div class="post-categories">
					 	 
						 
						 
						 		 </div>
								 <div class="clear"></div>
								 <div class="post-title">
									
									 
								 	 
				<h4 class="headline margin-bottom-35">Contact Form</h4>
<p>
    If you have questions regarding advertising on Askaan, please use this form to get in touch.
    
</p>
				<div id="contact-message"></div> 

					<?php
					$form = $this->beginWidget('CActiveForm', array(
				//	'action'=>Yii::app()->createUrl('contact#contact-form'),
					'enableAjaxValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,
					),
					));
					?>
					<div class="row">
						<div class="col-md-6">
							<div>
								<?php echo $form->labelEx($model, 'name');?>
								<?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
								<?php echo $form->error($model, 'name');?>
							</div>
						</div>

						<div class="col-md-6">
							<div>
							<?php echo $form->labelEx($model, 'email');?>
							<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
							<?php echo $form->error($model, 'email');?>
							</div>
						</div>
					</div>

					<div>
							<?php echo $form->labelEx($model, 'city');?>
							<?php echo $form->textField($model, 'city',$model->getHtmlOptions('city')); ?>
							<?php echo $form->error($model, 'city');?>
					</div>

					<div>
					<?php echo $form->labelEx($model, 'meassage');?>
					<?php echo $form->textArea($model, 'meassage',$model->getHtmlOptions('meassage',array('cols'=>'40','rows'=>'3'))); ?>
					<?php echo $form->error($model, 'meassage');?>
					</div>

					<input type="submit" class="submit button" id="submit" value="Send" />

					<?php $this->endWidget();?>
			 
	<style>
	  input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {
    	height: 51px;
            line-height: 51px;
            padding: 0 20px;
            outline: 0;
            font-size: 15px;
            color: gray;
            margin: 0 0 16px;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);
            font-weight: 500;
            opacity: 1;
            border-radius: 3px;
    margin-left: 0 !important;
}
.errorMessage {   color: #e13009 !important;
font-size: 13px;
top: -9px;
position: relative;}
	  </style>
								
								 
								 </div>
								 <div style="margin-bottom:20px;"></div>
								 <div>
								 
								 
								 </div>
								 
								 
								 <div class="post_content">
									 
							 
								
								 </div>
								 <div style="clear:both;"></div>
								 
								 </div>
								  <div style="clear:both;"></div>
							  </div>
						 
							  <div class="clear"></div>
							   
								 
							  <div class="clear"></div>
						   </div>
					 	
								
							 
							<div class="clearfix"></div>		
		 		</div>
		 		
				<div class="sidebar sidebar-right">
					<?php $this->renderPartial('_left');?>
						
							<div class="clearfix"></div>
				</div>
					
	
						<div class="clear"></div>	
						
			<!-- end container -->		
</div> <!-- end center -->
<div class="clear"></div>
 </div>

 
