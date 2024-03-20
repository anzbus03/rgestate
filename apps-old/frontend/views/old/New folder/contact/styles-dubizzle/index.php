  <style>
  #report-help .wide span {
    float: none !important;
}
  </style>
  <?php
   if(Yii::app()->user->hasFlash('error'))
   {?>
   <div class="error1"><?php echo Yii::app()->user->getFlash('error');?>.</div>
   <?php
   }
   ?>
  <?php
   if(Yii::app()->user->hasFlash('success'))
   {?>
   <div class="confirmation"><?php echo Yii::app()->user->getFlash('success');?>.</div>
   <?php
   }
   ?>
  <fieldset id="report-help">
            <legend>Contact Us</legend>
             
                <?php
              $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,'type') , 'htmlOptions' => array('id' => 'contact-us-form'),)); 
       
             ?>
                <input type="hidden" name="back" value='http://alain.dubizzle.com/'/>
                <div class="row">
                    <div class="col wide">
                        
						<?php echo $form->labelEx($model, 'type');?>
						<?php $dropdwn =   array_merge( $model->getHtmlOptions('type'),array('empty'=>'Please choose a subject ',"id"=>"id_subject")) ;  ?> 
						<?php echo $form->dropDownList($model,'type',$model->Model_type(), $dropdwn  ); ?>
						<?php echo $form->error($model, 'type');?>
               
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col wide">
						<?php echo $form->labelEx($model, 'name');?>
						<?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
						<?php echo $form->error($model, 'name');?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col wide">
						<?php echo $form->labelEx($model, 'email');?>
						<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
						<?php echo $form->error($model, 'email');?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col wide">
						<?php echo $form->labelEx($model, 'phone');?>
						<?php echo $form->textField($model, 'phone',$model->getHtmlOptions('phone')); ?>
						<?php echo $form->error($model, 'phone');?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col wide">
						<?php echo $form->labelEx($model, 'city');?>
						<?php echo $form->textField($model, 'city',$model->getHtmlOptions('city')); ?>
						<?php echo $form->error($model, 'city');?>
                        
                    </div>
                </div>
				<div class="row">
				<div class="col wide">
				<?php echo $form->labelEx($model, 'meassage');?>
				<?php echo $form->textArea($model, 'meassage',$model->getHtmlOptions('meassage')); ?>
				<?php echo $form->error($model, 'meassage');?>
				</div>   
				<div class="row">
				<div class="col wide">
				 
                        <div id="captcha">
                            <span class="captcha-box">
                                 
							<?php if(CCaptcha::checkRequirements()): ?>
							<?php $this->widget('CCaptcha',
							array('captchaAction'=>'site/captcha','showRefreshButton'=>false,
							'buttonType'=>'button',
							'buttonOptions'=>
							array('type'=>'image',
							'src'=> AssetsUrl::img('refresh.png')  ,
							'style'=>"width:18px;height:18px;",
							),                                                            
							'buttonLabel'=>'Refrescar imagen'),
							false); ?> 
							<?php   echo $form->textField($model, 'verifyCode', array_merge($model->getHtmlOptions('verifyCode'),array("placeholder"=>"" ,"class"=>"captcha-input","id"=>"id_captcha_1","style"=>" font-size: 30px;height: 42px;vertical-align: top;width: 97px;","maxlength"=>5)));  
		?>
							<?php endif; ?>
							
                            </span>
                            	<br />
                            <span class="captcha-hint">
							
                                Please enter the 5 letters as they appear in the image on the left.
                                
                            </span>
                               <div class="clear"> </div>
                         <?php echo $form->error($model , 'verifyCode');?>
                         <div class="clear"> </div>
                        </div>
				</div>   
                 

                <div class="row wide" >
                    <span class="send-button">
    <input class="awesome red large" type="submit" name="submit" alt="Send" title="Send" value="Send" style="margin-top:2px" />

</span>
                </div>
                <input type="hidden" name="screen_size" value="" id="screen_size"/>
                <input type="hidden" name="cookies_enabled" value="0" id="cookies_enabled"/>

                <noscript>
                  <input type="hidden" name="javascript_disabled" value="1"/>
                </noscript>
          <?php $this->endWidget(); ?>
        </fieldset>
