                <?php $this->renderPartial('//detail/_success_html'); ?>

                <style>
                	#cn_property {
                		padding: 0 !important;
                		overflow: hidden
                	}

                	html input.input-text.form-control,
                	html select.input-text.form-control,
                	input.pwdfield {
                		border: 1px solid #dfe0e3;
                		border-radius: 3px;
                		color: #72727d;
                		;
                		height: 24px;
                		padding: 1px 0;
                		width: 100%;
                	}

                	html textarea.input-text.form-control {
                		border: 1px solid #dfe0e3;
                		line-height: 1.4;
                		padding: 10px 8px;
                		color: #72727d;
                	}

                	.sign-in-form label {
                		margin-bottom: 0
                	}

                	.sign-in-form .btn.btn-primary {
                		background-color: var(--secondary-color);
                		box-shadow: unset;
                		border: 0;
                		font-size: 14px;
                		color: #fff;
                		line-height: 40px;
                		border-radius: 5px
                	}

                	.btn-sm-s {
                		max-width: 100% !important;
                		line-height: 35px !important;
                		padding: 0
                	}

                	.col-sm-5 label {
                		color: #72727d !important;
                		line-height: 1;
                		text-align: right
                	}

                	html .container_check input:checked~.checkmark {
                		background-color: #90ee90;
                		border: 1px solid transparent
                	}

                	.container_check input:checked~.checkmark {
                		background-color: #dc143c;
                		border: 1px solid transparent
                	}

                	.container_check .checkmark {
                		position: absolute;
                		top: 0;
                		left: 0;
                		height: 20px;
                		width: 20px;
                		-webkit-border-radius: 3px;
                		-moz-border-radius: 3px;
                		-ms-border-radius: 3px;
                		border-radius: 3px;
                		-moz-transition: all .3s ease-in-out;
                		-o-transition: all .3s ease-in-out;
                		-webkit-transition: all .3s ease-in-out;
                		-ms-transition: all .3s ease-in-out;
                		transition: all .3s ease-in-out
                	}

                	.container_check input:checked~.checkmark::after {
                		display: block
                	}

                	.container_check .checkmark::after {
                		content: "";
                		position: absolute;
                		display: none;
                		left: 7px;
                		top: 3px;
                		width: 5px;
                		height: 10px;
                		border: solid #fff;
                		border-top-width: medium;
                		border-right-width: medium;
                		border-bottom-width: medium;
                		border-left-width: medium;
                		border-top-width: medium;
                		border-right-width: medium;
                		border-bottom-width: medium;
                		border-left-width: medium;
                		border-width: 0 2px 2px 0;
                		-webkit-transform: rotate(45deg);
                		-ms-transform: rotate(45deg);
                		transform: rotate(45deg)
                	}

                	#frm_ctnt .errorMessage {
                		font-size: 12px;
                		color: #e13009 !important;
                		padding: 2px 0 0;
                		top: unset !important
                	}

                	.grecaptcha-badge {
                		z-index: 999911119999 !important
                	}

                	.success-modal .info .title {
                		font-weight: var(--weight-800);
                		margin: 0;
                		line-height: 1.42857143;
                		color: #333;
                		font-weight: 600 !important;
                		font-size: 18px;
                	}

                	#topThirdPlacementLeadFormContainer input[type="text"] {
                		margin-left: 0px !important;
                		margin-right: 0px !important;
                	}
                </style>

                <div id="topThirdPlacementLeadFormContainer" class="pan plm rms-data-h">
                	<div class="backgroundBasic sign-in-form   " id="topPanelLeadFormContainer">
                		<div data-reactroot="" class="pvn clearfix">
                			<div class="false padding-left-0 padding-right-0 padding-bottom-15">
                				<?php
								$mainTex =    $this->tag->getTag('send_email', 'Send Email');
								$Validating = $this->tag->getTag('validating', 'Validating..');
								$please_wait =  $this->tag->getTag('please_wait', 'Please wait..');
								$contact = new SendEnquiry2();
								$contact->ad_id = $model->id;
								$form = $this->beginWidget('CActiveForm', array(
									'id' => 'frm_ctnt1',
									'action' => Yii::app()->createUrl('detail/validateEnquiry2'),
									'enableAjaxValidation' => true,
									'clientOptions' => array(
										'validateOnSubmit' => true, 'validateOnChange' => false,
										'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("' . $Validating . '");
							return true;
							}',
										'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("' . $mainTex . '");
							return false;
							}
							else
							{
							form.find("#bb2").html("' . $please_wait . '"); 
				
							ajaxSubmitHappenlistConta(form, data, hasError,"' . Yii::app()->createUrl('detail/SendEnquiry2') . '"); 
							}
							}',
									),
									'htmlOptions' => array('class' => 'form leadContact right_leadContact ns1 phs', 'style' => 'margin-top: 5px;'),
								));
								?>
                				<style>
                					img.ag {
                						max-width: 110px !important;
                						max-height: 50px !important;
                						margin-bottom: 0;
                						margin-left: auto;
                						text-align: center;
                						margin-right: auto;
                						display: block
                					}

                					.ptn.man.kw-agent-info__agentItem___2iGT_.h7 {
                						font-weight: 700;
                						line-height: 20px;
                						display: flex
                					}

                					.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span {
                						margin-right: 10px;
                						font-weight: 400;
                						display: inline-block;
                						max-width: 90px;
                						overflow: hidden;
                						white-space: nowrap;
                						min-width: 90px;
                						font-size: 11px
                					}

                					.ptn.man.kw-agent-info__agentItem___2iGT_.h7 {
                						line-height: 25px;
                					}

                					.cctnct-txt {
                						font-size: 14px;
                						font-weight: 600;
                						margin-bottom: 10px;
                						margin-top: 10px;
                						text-align: center;
                					}

                					.ctin hr {
                						margin-top: 5px !important;
                						margin-bottom: 5px !important;
                					}

                					.ctin #SendEnquiry_meassage {
                						resize: none;
                						height: 100px !important;
                						min-height: unset;
                					}
                				</style>

                				<div class="cols24">


                					<div class="clearfix"></div>
                					<hr />
                					<h1 class="cctnct-txt"><?php echo $this->tag->getTag('contact_for_more_information', 'Contact for more information'); ?></h1>
                				</div>
                				<?php
								if (!Yii::app()->request->isPostRequest and !empty($this->mem)) {
									$contact->name = $this->mem->first_name;
									$contact->phone_false = $this->mem->full_number;
									$contact->email = $this->mem->email;
								}
								?>
                				<div class="form-group  ">

                					<div class="row">

                						<div class="col-sm-12">

                							<?php echo $form->textField($contact, 'name',  $contact->getHtmlOptions('name', array('class' => 'input-text form-control', 'placeholder' => $contact->getAttributeLabel('name') . ' *')));  ?>

                							<?php echo $form->error($contact, 'name'); ?>
                							<?php echo $form->hiddenField($contact, 'ad_id'); ?>
                							<?php echo $form->error($contact, 'ad_id'); ?>

                						</div>

                					</div>
                				</div>
                				<div class="clearfix"></div>
                				<div class="form-group  ">

                					<div class="row">


                						<div class="col-sm-12">

                							<?php echo $form->textField($contact, 'email',  $contact->getHtmlOptions('email', array('class' => 'input-text form-control', 'placeholder' => $this->tag->getTag('your_e-mail_account', 'Your e-mail account') . ' *')));  ?>

                							<?php echo $form->error($contact, 'email'); ?>


                						</div>

                					</div>
                				</div>
                				<div class="clearfix"></div>

                				<div class="clearfix"></div>
                				<div class="form-group  ">

                					<div class="row">


                						<div class="col-sm-12" dir="ltr">
                							<style>
                								.iti.iti--allow-dropdown input {
                									margin-right: 0px !important;
                								}

                								.iti {
                									width: 100%;
                								}
                							</style>
                							<?php echo $form->textField($contact, 'phone_false',  $contact->getHtmlOptions('phone_false', array('class' => 'input-text form-control', 'placeholder' => '', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")));  ?>

                							<?php echo $form->error($contact, 'phone_false'); ?>


                						</div>

                					</div>
                				</div>
                				<div class="clearfix"></div>
                				<div class="form-group  margin-bottom-0 ">

                					<div class="row">


                						<div class="col-sm-12">

                							<?php
											//if($model->section_id=='2'){
											// $contact->meassage = Yii::t('tran',$this->tag->gettag('i_am_interested_in_this_rental', 'I am interested in this rental and would like to schedule a viewing. Please let me know when this would be possible.') ,array('{ad}'=>$model->AdTitle) ); 
											// }
											// else{
											$contact->meassage = Yii::t('tran', $this->tag->getTag('i_would_like_to_inquire_about_', 'Hello, I am interested in this property and would like to make an appointment for a visit. Please contact me as soon as possible.{b}Thank you so much - [PROPERTY]'), array('[PROPERTY]' => $model->DetailUrlAbs, '{REF}' => $model->ReferenceNumberTitle, '{site}' => $this->project_name, '{b}' => "\r\n"));

											// }
											echo $form->textArea($contact, 'meassage',  $contact->getHtmlOptions('meassage', array('class' => 'input-text form-control', 'placeholder' => '', 'style' => 'max-width:100%;min-height:148px;')));  ?>

                							<?php echo $form->error($contact, 'meassage'); ?>


                						</div>

                					</div>
                				</div>
                				<div class="clearfix"></div>

                				<div class="cols24">


                					<div id="msg_alert"></div>



                					<div class="clearfix"></div>

                					<div class="clear"></div>
                					<div class="form-group  ">

                						<div class="row">

                							<div class="col-sm-12">
                								<div class="checkboxes">
                									<label class="container_check ar" for="<?php echo $contact->modelName; ?>_agree"><?php echo Yii::t('app', $this->tag->getTag('agree_to_the_{link1}_and_the_{', 'I Agree to the {link1} and the {link2}'), array('{link1}' => '<a href="' . Yii::app()->createUrl('terms') . '" target="_blank" class="link_color">  ' . $this->tag->getTag('terms_and_conditions', 'Terms and Conditions') . '</a>', '{link2}' => '<a href="' . Yii::app()->createUrl('privacy') . '" target="_blank" class="link_color"> ' . $this->tag->getTag('privacy_policy', 'Privacy Policy') . '</a>')); ?>
                										<?php echo $form->checkBox($contact, 'agree',  $contact->getHtmlOptions('agree', array('uncheckValue' => '', 'value' => '1')));  ?>
                										<span class="checkmark"></span>
                									</label>
                									<?php echo $form->error($contact, 'agree'); ?>
                								</div>
												<div class="checkbox mb-3 mt-3">
													<div class="cf-turnstile" data-sitekey="0x4AAAAAABaczT6sNg53sDRh" data-theme="light"></div>
												</div>

                							</div>
                						</div>
                					</div>

                					<div class="clear"></div>

                					<div class="clear"></div>
                					<div class="form-group  margin-bottom-5">

                						<div class="row">

                							<div class="col-sm-12">

                								<div class="form-group  ">

                									<div class="row" style="display: flex;">
                										<div class="col-sm-12" style="display: flex;align-items: center;">

                											<a type="button" class="btn btn-primary btn-block headfont btn-sm-s  text-center margin-right-10 margin-bottom-0" onclick="OpenCallNewlatest(this)" data-prop="<?php echo  $model->id; ?>" data-agent="<?php echo $model->OwnerName; ?>" data-ref="<?php echo $model->ReferenceNumberTitle; ?>" data-phone="<?php echo $model->mobile_number; ?>" data-testid="lead-form-submit" style="margin-bottom:8px;flex:1" class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-phone margin-right-3" style="font-size: 20px; "></i> <?php echo  $this->tag->getTag('call', 'Call'); ?></a>
                											<button type="button" onclick="OpenSignupRequiredNewEmail(this)" data-reactid="<?php echo $model->id; ?>" class="btn btn-primary btn-block headfont btn-sm-s  text-center" style=" padding: 0px 10px;height: 36px;flex:1;margin-top:0px;"><i class="fa fa-envelope margin-right-3" style="font-size:20px; flex:1"></i> <span id="bb2" data-html="<?php echo $mainTex; ?>"><?php echo $mainTex; ?></span></button>

                											<button type="button" onclick="OpenEmailNew(this)" data-email="<?php echo  $model->user_email; ?>" data-reactid="<?php echo $model->id; ?>" class="btn btn-primary btn-block headfont btn-sm-s  text-center hide" style=" padding: 0px 10px;height: 36px;flex:1;overflow: hidden;text-overflow: ellipsis; flex:1;margin-top:0px;"><i class="fa fa-envelope margin-right-3" style="font-size:20px;"></i> <span id="bb3"><?php echo  $this->tag->getTag('email', 'Email'); ?></span></button>

                										</div>

                									</div>
                								</div><!-- end #signin-form -->


                							</div>
                						</div>

                						<div class="clear"></div>
                						<div class="clear"></div>


                						<div class="clearfix"></div>
                					</div>


                				</div>
                				<?php $this->endWidget(); ?>
                			</div>
                		</div>
                	</div>
                </div>
                <div class="clearfx"></div>





                <script>
                	$(function() {
						$(function() {
							var input = document.querySelector("#<?php echo $contact->modelName; ?>_phone_false");
							const iti = window.intlTelInput(input, {
								initialCountry: "<?php echo COUNTRY_CODE; ?>",
								separateDialCode: true,
								hiddenInput: "phone",
								placeholderNumberType: "MOBILE",
								utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js'); ?>"
							});

							// Update the hidden phone field on form submit
							$('#frm_ctnt1').on('submit', function(e) {
								const fullPhoneNumber = iti.getNumber(); // Get the full phone number
								$('<input>').attr({
									type: 'hidden',
									name: '<?php echo $contact->modelName; ?>[phone]', // Match your model attribute
									value: fullPhoneNumber
								}).appendTo(this);
							});
						});
                	})
                </script>
                <style>
                	.pwdopsdiv {
                		display: none;
                	}

                	.pwdstrengthstr,
                	.pwdstrength {
                		height: auto;
                	}
                </style>

                <?php
				if (Yii::app()->request->isAjaxRequest) {
				?>
                	<script type="text/javascript">
                		/*<![CDATA[*/
                		jQuery('#frm_ctnt1').yiiactiveform({
                			'validateOnSubmit': true,
                			'validateOnChange': false,
                			'beforeValidate': function(form) {
							
                				form.find("#bb2").html("<?php echo $Validating; ?>");
                				return true;
                			},
                			'afterValidate': function(form, data, hasError) {
                				if (hasError) {
                					form.find("#bb2").html("<?php echo $mainTex; ?>");
                					return false;
                				} else {
                					form.find("#bb2").html("<?php echo $please_wait; ?>");
                					ajaxSubmitHappenlistConta(form, data, hasError, "<?php echo Yii::app()->createUrl('detail/SendEnquiry2'); ?>");
                				}
                			},
                			'attributes': [{
                				'class': 'iti__selected-dial-code',
                				'inputID': 'iti__selected-dial-code',
                				'errorID': 'iti__selected-dial-code_em_',
                				'model': 'SendEnquiry2',
                				'name': 'iti__selected-dial-code',
                				'enableAjaxValidation': true
                			},{
                				'id': 'SendEnquiry2_name',
                				'inputID': 'SendEnquiry2_name',
                				'errorID': 'SendEnquiry2_name_em_',
                				'model': 'SendEnquiry2',
                				'name': 'name',
                				'enableAjaxValidation': true
                			}, {
                				'id': 'SendEnquiry2_ad_id',
                				'inputID': 'SendEnquiry2_ad_id',
                				'errorID': 'SendEnquiry2_ad_id_em_',
                				'model': 'SendEnquiry2',
                				'name': 'ad_id',
                				'enableAjaxValidation': true
                			}, {
                				'id': 'SendEnquiry2_email',
                				'inputID': 'SendEnquiry2_email',
                				'errorID': 'SendEnquiry2_email_em_',
                				'model': 'SendEnquiry2',
                				'name': 'email',
                				'enableAjaxValidation': true
                			}, {
                				'id': 'SendEnquiry2_phone_false',
                				'inputID': 'SendEnquiry2_phone_false',
                				'errorID': 'SendEnquiry2_phone_false_em_',
                				'model': 'SendEnquiry2',
                				'name': 'phone_false',
                				'enableAjaxValidation': true
                			}, {
                				'id': 'SendEnquiry2_meassage',
                				'inputID': 'SendEnquiry2_meassage',
                				'errorID': 'SendEnquiry2_meassage_em_',
                				'model': 'SendEnquiry2',
                				'name': 'meassage',
                				'enableAjaxValidation': true
                			}, {
                				'id': 'SendEnquiry2_agree',
                				'inputID': 'SendEnquiry2_agree',
                				'errorID': 'SendEnquiry2_agree_em_',
                				'model': 'SendEnquiry2',
                				'name': 'agree',
                				'enableAjaxValidation': true
                			}],
                			'errorCss': 'error'
                		});
                		/*]]>*/
                	</script>
                <?php
				}
				?>
                <div class="modal modal-new fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">

                			<div class="modal-body">
                				<div class="success-modal " style="display:block;    margin: auto;">
			
                					<div class="anim" style="background:#fff;height:auto; margin:60px 0px 25px;display: block;;">
                						<div class="contaiwerwner22">
                							<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDE1Ljg2OSA0MTUuODY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MTUuODY5IDQxNS44Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzRBODUzIiBkPSJNMTI1LjkxLDE3MC44NDFjLTUuNzQ3LTYuMjY5LTE1LjY3My02Ljc5Mi0yMS45NDMtMS4wNDVjLTYuMjY5LDUuNzQ3LTYuNzkyLDE1LjY3My0xLjA0NSwyMS45NDMgICBsNzguODksODUuNjgyYzMuMTM1LDMuMTM1LDYuNzkyLDUuMjI0LDEwLjk3MSw1LjIyNGMwLDAsMCwwLDAuNTIyLDBjNC4xOCwwLDguMzU5LTEuNTY3LDEwLjk3MS00LjcwMkw0MDMuODUzLDc4Ljg5ICAgYzYuMjY5LTYuMjY5LDYuMjY5LTE2LjE5NiwwLTIxLjk0M2MtNi4yNjktNi4yNjktMTYuMTk2LTYuMjY5LTIxLjk0MywwTDE5My44MjksMjQ0LjUwNkwxMjUuOTEsMTcwLjg0MXoiIGRhdGEtb3JpZ2luYWw9IiM0RENGRTAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiM0RENGRTAiPjwvcGF0aD4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzNEE4NTMiIGQ9Ik00MDAuMTk2LDE5Mi4yNjFjLTguODgyLDAtMTUuNjczLDYuNzkyLTE1LjY3MywxNS42NzNjMCw5Ny4xNzUtNzkuNDEyLDE3Ni41ODgtMTc2LjU4OCwxNzYuNTg4ICAgUzMxLjM0NywzMDUuMTEsMzEuMzQ3LDIwNy45MzVTMTEwLjc1OSwzMS4zNDcsMjA3LjkzNSwzMS4zNDdjOC44ODIsMCwxNS42NzMtNi43OTIsMTUuNjczLTE1LjY3M1MyMTYuODE2LDAsMjA3LjkzNSwwICAgQzkzLjUxOCwwLDAsOTMuNTE4LDAsMjA3LjkzNXM5My41MTgsMjA3LjkzNSwyMDcuOTM1LDIwNy45MzVzMjA3LjkzNS05My41MTgsMjA3LjkzNS0yMDcuOTM1ICAgQzQxNS44NjksMTk5LjA1Myw0MDkuMDc4LDE5Mi4yNjEsNDAwLjE5NiwxOTIuMjYxeiIgZGF0YS1vcmlnaW5hbD0iIzREQ0ZFMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzREQ0ZFMCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" style="width: 50px;">
                							<div class="clearfix"></div>
                						</div>
                						<div class="clearfix"></div>
                					</div>
                					<div class="info">
                						<div class="title"></div>
                						
										<div class="text"><?php echo $this->tag->getTag('we_will_get_back_to_you_soon.', 'We will get back to you soon.'); ?></div>
                						<button class="continue" data-dismiss="modal" style="   display: flex!important;   margin: 30px auto; "><?php echo  $this->tag->gettag('continue', 'Continue'); ?></button>
                					</div>
                				</div>

                			</div>

                		</div>
                	</div>
                </div>