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
.errorMessage {   color:#e13009!important;}
	  </style>
<div class="clearfix"></div>
  <!-- Header Container / End --> 

<!-- Content
================================================== -->

<!-- Map Container -->
<div class="contact-map margin-bottom-60">

	<!-- Google Maps -->
	<div id="singleListingMap-container">
		<div id="singleListingMap" ><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.1745884095476!2d55.446469615533246!3d25.398965883802703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5812173ad763%3A0x1bd3368e65e48968!2sAl+Farooq+Real+Estate+%26+Investment+LLC!5e0!3m2!1sen!2s!4v1524844097576" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe></div>
		<a href="#" id="streetView">Street View</a>
	</div>
	<!-- Google Maps / End -->

	<!-- Office -->
	<div class="address-box-container">
		<div class="address-container" data-background-image="<?php echo $this->appAssetUrl('images/our-office.jpg');?>">
			<div class="office-address">
				<h3>Our Office</h3>
				<ul>
					<li>Al Farooq Real Estate & Investment LLC</li>
					<li>United Arab Emirates </li>
					<li>Phone (+971) 1234-456 255 </li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Office / End -->

</div>
<div class="clearfix"></div>
<!-- Map Container / End -->


<!-- Container / Start -->
<div class="container">

	<div class="row">

		<!-- Contact Details -->
		<div class="col-md-4">

			<h4 class="headline margin-bottom-30">Find Us There</h4>

			<!-- Contact Details -->
			<div class="sidebar-textbox">
				<p><b>Al Farooq Real Estate & Investment LLC</b> <br>110, First Floor, Falcon Tower, Al Rashidiya 2 - Ajman - United Arab Emirates </p>

				<ul class="contact-details">
					<li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong> <span><?php echo $this->options->get('system.common.contact_phone');?></span></li>
					<li><i class="im im-icon-Fax"></i> <strong>Fax:</strong> <span><?php echo $this->options->get('system.common.contact_fax');?> </span></li>
		
					<li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="#"><span class="__cf_email__" ><?php echo $this->options->get('system.common.contact_email');?></span></a></span></li>
				</ul>
			</div>

		</div>

		<!-- Contact Form -->
		<div class="col-md-8">

			<section id="contact">
				<h4 class="headline margin-bottom-35">Contact Form</h4>

				<div id="contact-message"></div> 

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

					<input type="submit" class="submit button" id="submit" value="Submit Message" />

					<?php $this->endWidget();?>
			</section>
		</div>
		<!-- Contact Form / End -->

	</div>

</div>
<!-- Container / End -->























