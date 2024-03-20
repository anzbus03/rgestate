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
#contact input {
    margin-bottom: 10px;
}
.errorMessage {   color:#e13009!important;}
	  </style>
<div class="clearfix"></div>
 <section id="fpContainer">
      <div class="auth-wrap module <?php echo empty($show) ? '' : 'hide';?>">
         <div class="zm-user-account zt-user-account stickfigure-form">
            <div class="module-wrap">
               <div class="premier-agent-image"></div>
               <div class="module-head padding-top-40">
                  <h2>Advertise With Us</h2>
               </div>
               <div class="module-body">
                  <section id="contact">
				 
				<div id="contact-message"></div> 

					<?php
					$form = $this->beginWidget('CActiveForm', array(
					'enableAjaxValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,
					),
					));
					?>
					<div class="row">
						<div class="col-md-12">
							<div>
								<?php echo $form->labelEx($model, 'name');?>
								<?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
								<?php echo $form->error($model, 'name');?>
							</div>
						</div>

						<div class="col-md-12">
							<div>
							<?php echo $form->labelEx($model, 'phone');?>
							<?php echo $form->textField($model, 'phone',$model->getHtmlOptions('phone')); ?>
							<?php echo $form->error($model, 'phone');?>
							</div>
						</div>
						<div class="col-md-12">
							<div>
							<?php echo $form->labelEx($model, 'email');?>
							<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
							<?php echo $form->error($model, 'email');?>
							</div>
						</div>
					</div>

				  

					 
<style>
								form label { margin-bottom:5px;}
							  span.required{ color:red !important;}
								</style>	
								<div>
					<input type="submit" class="submit button" id="submit" value="<?php echo  'Send' ;?>" style="min-width:100%;" />
</div> 
					<?php $this->endWidget();?>
			</section>
			<section>
			<div class="txtC mvm privacyStatement">
            <p class="h6 typeReversed typeWeightNormal" data-optly-b618d01ef36940728bd34997f396fde4="">or call <?php echo $this->options->get('system.common.contact_phone');?></p>
            <p class="h7 typeReversed typeWeightNormal">We respect your privacy. See our <a href="<?php echo $this->app->createUrl('policies');?>" target="_blank" class="privacy-link">privacy policy</a>.</p><p>
        </p></div>
 
			</section>
	 
               </div>
            </div>
         </div>
      </div>
      <div id="fastpass-result" class="fastpass-box <?php echo !empty($show) ? '' : 'hide';?>">
         <div class="heading"><span class="fastpass-registered-name"></span>Congrats! Your interest is on its way.</div>
         <div class="description">
            <div class="zsg-content-item">We are excited to support your advertisement interest with our unique premium advertising platform. We will get back to you within one working day. </div>
			<div class=""></div>
			<div class="margin-top-20"></div>
			<a id="agent-hub-next" class="button pull-right" target="_parent" href="<?php echo $this->app->createUrl('site/index');?>">Go Back</a>
			<div class="clearfix"></div>
         </div>
      </div>
   </section>
  
 
			









































