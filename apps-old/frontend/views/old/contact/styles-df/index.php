<div class="main-content">
  <div class="properties"  style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
        <div class="row">
         <!-- Main content -->
         <div class="span12">
			<h3 style="text-align:left; padding:20px 0px;">Contact Us</h3>
			</div>
         <div class="span8">
          <!-- Contact -->
          <div class="contact">
         
            <div class="contact-bor">
              <div class="infotext"  id="map-location2">
				  Thank you for your interest in <?php  echo  Yii::app()->options->get('system.common.site_name') ;?> services. Please provide the following information about your business needs to help us serve you better. This information will enable us to route your request to the appropriate person. You should receive a response within 48 hours.
               </div>
              <div class="map"  > <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2978.853416734672!2d-71.429788!3d41.70210000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e44db354f21b5f%3A0x5436ffbcb4f83e2a!2sZen+Real+Estate+Group!5e0!3m2!1sen!2sin!4v1433491574311" width="580" height="285" frameborder="0" style="border:0"></iframe></div>
              <div class="add-contact" id="add-contact">
                <div class="row">
                  <div class="span280px">
                    <h6>Contact address</h6>
                   <?php  echo  nl2br(Yii::app()->options->get('system.common.contact_address'));?>
                  </div>
                  <div class="span280px pull-right">
                    <strong>Phone</strong><?php  echo  Yii::app()->options->get('system.common.contact_phone') ;?> <br/>
                    <strong>Fax.</strong><?php  echo  Yii::app()->options->get('system.common.contact_fax') ;?> <br/>
                    <strong>Email.</strong> <a href="mailto:<?php  echo  Yii::app()->options->get('system.common.contact_email') ;?>?subject=SweetWords &body=Please send me a copy of your new program!"><?php  echo  Yii::app()->options->get('system.common.contact_email') ;?></a> <br/>
                  </div>
                </div>
              </div>
            </div>
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
					echo '<div><p style="color:green;text-indent:20px"><b>'.Yii::app()->user->getFlash('success').'</b></p></div>';
				}
				?>
				</div>
                <div class="row">
                  <div class="span280px">
                    <?php echo $form->labelEx($model, 'name');?>
                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
					<?php echo $form->error($model, 'name');?>
                    <?php echo $form->labelEx($model, 'email');?>
                   <?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
						<?php echo $form->error($model, 'email');?>
                  </div>
                  <div class="span280px pull-right">
                    <?php echo $form->labelEx($model, 'phone');?>
                    <?php echo $form->textField($model, 'phone',$model->getHtmlOptions('phone')); ?>
						<?php echo $form->error($model, 'phone');?>
                    <?php echo $form->labelEx($model, 'city');?>
                   <?php echo $form->textField($model, 'city',$model->getHtmlOptions('city')); ?>
						<?php echo $form->error($model, 'city');?>
                  </div>
                </div>
                <?php echo $form->labelEx($model, 'meassage');?>
                <?php echo $form->textArea($model, 'meassage',$model->getHtmlOptions('meassage')); ?>
				<?php echo $form->error($model, 'meassage');?>
                <button class="button-send" type="submit">Submit</button>
             <?php $this->endWidget(); ?>
            </div>
          </div>
          <!-- End contact -->
        </div>
        
        
         <div class="span4">
          <div class="box-siderbar-container">
            <!-- sidebar-box map-box -->
             
                  <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>""));?>
            
             
              </div>
              
              
               
            </div>
        
           <div class="sidebar-box">
                                       <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>array(),'section_id'=>""));?>
 
            </div>
            <!-- End sidebar-box product_list_wg -->
            
            <!-- sidebar-box searchbox -->
            
            <!-- End sidebar-box searchbox -->
            
          </div>
        </div>
                </div>
              </div>
        <!-- End Main content -->
        
        <!-- Sidebar left  -->
        
      <!-- End Sidebar left  -->
    </div>
  </div>
</div>
</div>
</div>
     
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
