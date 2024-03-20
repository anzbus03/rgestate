  <div class="spanwth_right">
			    <?php $this->renderPartial('//detail/_success_html');?>
               <div id="topThirdPlacementLeadFormContainer" class="miniHidden xxsHidden xsHidden smlHidden pan plm">
                  <div class="backgroundBasic bhs bbs" id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false" style="padding: 10px;">
						   <?php
						    $contact = new SendEnquiry();
							$contact->ad_id = $model->id ;
							 $mainTex =  'Request Info' ;
							$form = $this->beginWidget('CActiveForm', array(
							'action'=>Yii::app()->createUrl('detail/validateEnquiry'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'. 'Validating...' .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("'.$mainTex.'");
							return false;
							}
							else
							{
								form.find("#bb2").val("'. 'Please wait..' .'"); 
				
							ajaxSubmitHappenlist(form, data, hasError,"'.Yii::app()->createUrl('detail/SendEnquiry').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							?>
                              <div>
                                 <div>
                                    <div class="ptn pbm h6 mvn kw-agent-info__header___3AaPr">Contact Listing Agent</div>
                                    <div>
                                       <img class="floatLeft mrm" src="<?php $img =   !empty($model->user_image) ? ENABLED_AWS_PATH.$model->user_image :  $this->app->apps->getBaseUrl('assets/img/user_m_00_m.gif'); echo $img; ?>" alt="" width="45" height="45">
                                       <div class="kw-agent-info__agentInfo___3abZH">
                                          <div class="pbn man h7 kw-agent-info__agentItem___2iGT_"><a href="<?php echo $model->userProfile;?>" target="_blank"><?php echo $model->UserName;?></a></div>
                                          <?php /* <div class="pbn man h7 kw-agent-info__agentItem___2iGT_">A.N. Shell Realty</div> */ ?> 
                                          <div class="ptn man h7 kw-agent-info__agentItem___2iGT_"><?php echo $model->user_number;?></div>
                                       </div>
                                    </div>
                                    <div class="mvm kw-agent-info__separator___b14qX"></div>
                                 </div>
                                 <div class="h6 kw-agent-info__header___3AaPr">Contact Premier Agent</div>
                              </div>
							 <div id="msg_alert"></div>

                              <div class="cols24">
                                 <div class="cols24 fieldGroup fieldGroupInline" style="display: inline-block;">
                                    <div class="cols12 mbn prxs txtT" style="display: inline-block;width:48%!important;">
                                       <div class="field mtn">
										   <span class="fieldItem text cols24">
										   <?php echo $form->textField($contact, 'name',$model->getHtmlOptions('name',array('class'=>'fieldSml'))); ?>
										   <?php echo $form->error($contact, 'name');?>
										   	<?php echo $form->hiddenField($contact, 'ad_id'); ?>
											 <?php echo $form->error($contact, 'name');?>
										   </span></div>
                                    </div>
                                    <div class="cols12 mbn plxs txtT" style="display: inline-block;49%!important;">
                                       <div class="field mtn">
										   <span class="fieldItem text cols24">
												<?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'fieldSml'))); ?>
												<?php echo $form->error($contact, 'phone');?>
										   </span>
										   </div>
                                    </div>
                                 </div>
                                 <div class="field mtn">
									 <span class="fieldItem text ">
										 <?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'fieldSml'))); ?>
										 <?php echo $form->error($contact, 'email');?>
										 </span></div>
                                 <div class="field">
									 <span class="fieldItem text">
										 <?php
										  $contact->meassage = Yii::t('tran',' I am interested in {ad} ',array('{ad}'=>$model->AdTitle) ); 
										  echo $form->textArea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'msg fieldSml contact-fields__defaultTextarea___zR91Z','rows'=>'2'))); ?>
										 <?php echo $form->error($contact, 'meassage');?>
									 </span>
								 </div>
                                 <div class="field h7 mvs hide"><span class="fieldItem checkbox"><label style="padding: 0px;">
									  <?php echo $form->checkBox($contact, 'w_talk',$contact->getHtmlOptions('w_talk',array('class'=>'mrs'))); ?>
										 <?php echo $form->error($contact, 'w_talk');?>
									 <span class="mtxs floatLeft" data-auto-test-id="mortgageCheckBoxText">I want to talk about financing</span></label>
									 </span></div>
                                 <button type="submit" class="btn btnFullWidth requestBtn btnPrimary pvxs mbm mts btnLrg btnDefault" data-auto-test-id="submitButton" id="bb2">Request Info</button>
                                 <p class="formLegalDisclaimer positionRelative h8 typeLowlight mtn">
                                    <!-- react-text: 52 -->By pressing request info, you agree that Askaan and real estate professionals may contact you via phone/text about your inquiry, which may involve the use of automated means. You are not required to consent as a condition of purchasing any property, goods or services. Message/data rates may apply. You also agree to our<!-- /react-text --><!-- react-text: 53 --> <!-- /react-text --><a class="linkUnderline linkLowlight" href="#" target="_blank">Terms of Use</a><!-- react-text: 55 -->.<!-- /react-text --><br><br><!-- react-text: 58 -->Askaan does not endorse any<!-- /react-text --><!-- react-text: 59 --> <!-- /react-text -->
                                    <span class="clickable legal-disclaimer-tooltip__linkDottedUnderline___P_A_L">
                                       <!-- react-text: 61 -->real estate professionals.<!-- /react-text --><!-- react-text: 62 --> <!-- /react-text -->
                                    </span>
                                    <span class="man tooltip tooltipStemBottom tooltipLight boxHighlight legal-disclaimer-tooltip__legal-disclaimer-tooltip___7DKZU" style="display: none;">Real estate professionals includes the real estate agents and brokers, mortgage lenders and loan officers, property managers, and other professionals you interact with through Askaan.</span>
                                 </p>
                              </div>
                          <?php $this->endWidget(); ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         
<input id="interest" type="hidden" / >
   <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/moveit.js');?>"></script>
