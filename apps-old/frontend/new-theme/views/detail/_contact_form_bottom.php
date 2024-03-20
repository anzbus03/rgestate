 <div id="bottomPlacementLeadFormContainer" class="col-sm-12" style="padding-left: 0px;padding-right: 0px;" >
    
         <h3 class="amenities_heading" style="font-weight:600;">Make an Enquiry</h3>
                 
         <div id="bottomLeadFormContainer">
            <div data-reactroot="" class="false" style="padding: 0px;">
				<?php
				$contact = new SendEnquiry2();
				$contact->ad_id = $model->id ;
				$form = $this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl('detail/validateEnquiry2'),
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				'afterValidate' => 'js:function(form, data, hasError) { 
				if(hasError) {
				return false;
				}
				else
				{

				ajaxSubmitHappen2(form, data, hasError,"'.Yii::app()->createUrl('detail/SendEnquiry2').'"); 
				}
				}',
				),
				'htmlOptions'=>array('class'=>'form bottom_leadContact leadContact  ','style'=>'margin-top: 5px;padding:0px;' ),
				));
				?>
                    <div>
                     <span></span>
                     <div class="h6 kw-agent-info__header___3AaPr">Contact Premier Agent</div>
                  </div>
                  <div id="msg_alert2"></div>
                  <div class="formContain">
					  
					  <div class="row" style="margin-left:-15px;margin-right:-15px;">
					  <div class="col-sm-6">
                     <div class="field mtn"><span class="fieldItem text ">
										<?php echo $form->textField($contact, 'name',$model->getHtmlOptions('name',array('class'=>'fieldSml'))); ?>
										<?php echo $form->error($contact, 'name');?>
										<?php echo $form->hiddenField($contact, 'ad_id'); ?>
										<?php echo $form->error($contact, 'name');?>
						 </span></div>
                     <div class="field mtn"><span class="fieldItem text ">
						<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'fieldSml'))); ?>
						<?php echo $form->error($contact, 'email');?>
					 </span></div>
                     <div class="field mtn"><span class="fieldItem text ">
						<?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'fieldSml'))); ?>
						<?php echo $form->error($contact, 'phone');?>
					 </span>
					 </div>
					   <div class="field h7 mvs hide"><span class="fieldItem checkbox"><label style="padding: 0px;">
						<?php echo $form->checkBox($contact, 'w_talk',$contact->getHtmlOptions('w_talk',array('class'=>'mrs'))); ?>
						<?php echo $form->error($contact, 'w_talk');?>
						 <span class="mtxs floatLeft" data-auto-test-id="mortgageCheckBoxText" for="<?php echo $contact->modelName;?>_w_talk">I want to talk about financing</span></label></span></div>
                    
					 </div>
					  <div class="col-sm-6">
                     <div class="field"><span class="fieldItem text">
						  <?php
										  $contact->meassage = Yii::t('tran',' I am interested in {ad} ',array('{ad}'=>$model->AdTitle) ); 
										  echo $form->textArea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'"msg fieldSml contact-fields__defaultTextarea___zR91Z','rows'=>'3'))); ?>
										 <?php echo $form->error($contact, 'meassage');?>
						 </span></div>
						    <button type="submit" class="btn btnFullWidth requestBtn btnPrimary pvxs mbm mts btnLrg btnDefault" data-auto-test-id="submitButton">Request Info</button>
         
						 </div>
					           
                 </div>
                    <p class="formLegalDisclaimer positionRelative h8 typeLowlight mtn">
                     <div class="pvm">
                        <div>
                           <span style="font-size: 12px;">
                              <!-- react-text: 29 -->By pressing Request Info, you agree that Askaan and real estate professionals may contact you via phone/text about your inquiry, which may involve the use of automated means. You are not required to consent as a condition of purchasing any property, goods or services. Message/data rates may apply. You also agree to our <!-- /react-text --><a target="_blank" href="#">Terms of Use</a>
                           </span>
                           <span>.</span>
                        </div>
                     </div>
                     <br></p>
                  </div>
              <?php $this->endWidget();?>
            </div>
         </div>
      </div>
      
            
<div class="clearfix"></div>
