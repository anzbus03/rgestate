<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>

<div id="" class="innnerpage margin_60_35">
	<div class="wrapper">
		<div class="container">
			<div class="row  ">
				<div class="col-xl-12 col-lg-12">
					<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>


					<style>
						.confirm-page {

							margin: 25px 0 60px;

							position: relative;


						}

						.text-left00 {
							text-align: left;
						}
					</style>

					<div class="panel-wrapper">
						<div class="clearfix"></div>
						<div class="onlyforpoupuplog">
							<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without); ?>"></div>
						</div>
						<div class="onlyforpoupuplogrelative"></div>
						<div class="clearfix"></div>

						<div class="  content-container    ">
							<?php
							if ($view == 'verify') { ?>
								<h4 class="subheading_font row bold-style text-center mt-5"><?php echo $this->tag->getTag('we_sent_you_a_code.', 'We sent you a code.'); ?></h4>
								<div class="confirm-page1">



									<div class="false" style="padding: 10px;position:relative;">

										<style>
											.r-1upvrn0 {
												box-shadow: rgba(101, 119, 134, 0.2) 0px 0px 15px, rgba(101, 119, 134, 0.15) 0px 0px 3px 1px;
											}

											.r-1ekmkwe {
												max-width: calc(295px);
											}

											.resedV {
												position: absolute !important;
												z-index: 1 !important;
												right: 0 !important;
											}

											.r-u8s1d {
												position: absolute;
											}

											.r-ipm5af {
												top: 0px;
											}

											.css-1dbjc4n {
												-moz-box-align: stretch;
												-moz-box-direction: normal;
												-moz-box-orient: vertical;
												align-items: stretch;
												border: 0px solid black;
												box-sizing: border-box;
												display: flex;
												flex-basis: auto;
												flex-direction: column;
												flex-shrink: 0;
												margin: 0px;
												min-height: 0px;
												min-width: 0px;
												padding: 0px;
												position: relative;
												z-index: 0;
											}

											.r-my5ep6 {
												border-bottom-color: rgb(230, 236, 240);
											}

											.r-16dba41 {
												font-weight: 400;
											}

											.r-1re7ezh {
												color: rgb(101, 119, 134);
											}

											.r-d9fdf6 {
												padding-left: 20px;
												padding-right: 20px;
											}

											.r-9qu9m4 {
												padding-bottom: 15px;
												padding-top: 15px;
											}

											.r-my5ep6 {
												border-bottom-color: rgb(230, 236, 240);
											}

											.r-qklmqi {
												border-bottom-width: 1px;
											}

											.r-rull8r {
												border-bottom-style: solid;
											}

											.r-14lw9ot {
												background-color: rgb(255, 255, 255);
											}

											.r-6416eg {
												transition-property: background-color, box-shadow;
											}

											.r-1loqt21 {
												cursor: pointer;
											}

											.r-18u37iz {
												-moz-box-direction: normal;
												-moz-box-orient: horizontal;
												flex-direction: row;
											}

											.r-o7ynqc {
												transition-duration: 0.2s;
											}

											.r-13qz1uu {
												width: 100%;
											}

											.r-9qu9m4 {
												padding-bottom: 7px;
												padding-top: 7px;
											}

											.r-1j3t67a {
												padding-left: 15px;
												padding-right: 15px;
											}

											.mhvrme:hover {
												background: #F5F8FA;
											}

											span.lnk,
											span.lnk a {
												color: var(--linkcolor);
											}
										</style>
<!-- 
										<div role="menu" class="css-1dbjc4n r-14lw9ot r-1f0042m r-1upvrn0 r-1ekmkwe r-1udh08x r-u8s1d r-ipm5af resedV hide" id="resedV">
											<div style="">
												<div class="css-1dbjc4n">
													<div class="css-1dbjc4n">
														<div class="css-1dbjc4n r-14lw9ot r-my5ep6 r-rull8r r-qklmqi r-d9fdf6 r-9qu9m4" style=" background: #eee;">
															<div dir="auto" class="css-901oao r-1re7ezh r-1qd0xha r-a023e6 r-16dba41 r-ad9z0x r-bcqeeo r-qvutc0"><span class="css-901oao css-16my406 r-1qd0xha r-ad9z0x r-bcqeeo r-qvutc0"><span class="css-901oao css-16my406 r-1qd0xha r-ad9z0x r-bcqeeo r-qvutc0"><?php echo $this->tag->getTag('didnt_receive_email?', 'Didn’t receive email?'); ?></span></span><span class="pull-right" style="display: inline-block;margin-left: 5px;color: red;float: right !important;font-weight: 400;font-size: 17px;line-height: 1;position: relative;right: -10px;cursor:pointer;" onclick="closereserve()"><i class="fa fa-close"></i></span></div>
														</div>
														<div aria-haspopup="false" role="menuitem" data-focusable="true" tabindex="0" style=" border-bottom: 1px solid rgb(230, 236, 240);" class="mhvrme css-1dbjc4n r-1loqt21 r-18u37iz r-1j3t67a r-9qu9m4 r-o7ynqc r-6416eg r-13qz1uu">
															<div class="css-1dbjc4n r-16y2uox r-1wbh5a2">
																<div dir="auto" class="css-901oao r-hkyrab r-1qd0xha r-a023e6 r-16dba41 r-ad9z0x r-bcqeeo r-qvutc0"><span class="css-901oao css-16my406 lnk r-1qd0xha r-ad9z0x r-bcqeeo r-qvutc0" onclick="resendEmail(this)"><?php echo $this->tag->getTag('resend_email', 'Resend email'); ?> <span id="total_send"></span></span></div>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div> -->





										<?php // ajaxSubmitHappenlist2(form, data, hasError,"'.Yii::app()->createUrl('member/submitDetails').'");
											$mainTex =  $this->tag->getTag('verify', 'Verify');
											$Validating = $this->tag->getTag('validating', 'Validating..');
											$please_wait = $this->tag->getTag('please_wait', 'Please wait..');
											$action = !empty($email) ? Yii::app()->createUrl('user/EmailVerification', array('email' => $email)) : Yii::app()->createUrl('user/EmailVerification');

											$form = $this->beginWidget('CActiveForm', array(
												'id' => 'frm_ctnt',
												'action' => $action,
												'enableAjaxValidation' => true,
												'clientOptions' => array(
													'validateOnSubmit' => true,
													'validateOnChange' => false,
													'beforeValidate' => 'js:function(form) {

													form.find("#bb3").html("' . $Validating . '");
													return true;
													}',
																		'afterValidate' => 'js:function(form, data, hasError) { 
													if(hasError) {
													form.find("#bb3").html("' . $mainTex . '");
													return false;
													}
													else
													{
													form.find("#bb3").val("' . $please_wait . '"); 
												return true;
													
													}
													}',
												),
												'htmlOptions' => array('class' => 'sign-in-form', 'style' => 'margin-top: 5px;max-width:95%;width:340px;margin:auto;'),
											));
										?>
										<div class="form-group  ">

											<div class="row">
												<p class="col-sm-12 col-sm-12 text-center">
													<font style="vertical-align: inherit;">
														<font style="vertical-align: inherit;font-size:14px;font-weight:400;color: #727272;"><?php echo  Yii::t('app', $this->tag->getTag('enter_it_below_to_verify_your_', 'Enter it below to verify your email account {e}'), array('{e}' => '<br /><span style="white-space: nowrap;"> (' . $model->email . ')</span>')); ?></font>
													</font><span style="display:block;">
														<?php
														if (Yii::app()->user->getId()) { ?>
															<a href="<?php echo Yii::app()->createUrl('user/change_email'); ?>" style="    font-size: 13px;    color: orange !important;" class="bld-link2"><?php echo $this->tag->getTag('click_here_to_change_email', 'Click here to change email'); ?></a>
														<?php } ?>
													</span>
												</p>

											</div>
										</div>
										<div class="cols24">

										</div>
										<div class="form-group  ">

											<div class="row">

												<div class="col-sm-12">
													<style>
														form-control.LJB {
															border-color: #ddd;
															appearance: none;
															border-radius: 16px;
															border-style: solid;
															border-width: 2px;
															line-height: 36px;
															min-height: 48px;
															width: 100%;
															text-indent: 18px;
															font-size: 16px !important;
														}
													</style>
													<?php echo $form->textField($model, 'v_false',  $model->getHtmlOptions('v_false', array('style' => 'border-color: #ddd;
															appearance: none;
															border-radius: 16px;
															border-style: solid;
															border-width: 2px;
															line-height: 36px;
															min-height: 48px;
															width: 100%;
															text-indent: 18px;
															font-size: 16px !important;text-align:center;', 'class' => 'input-text LJB smllinput form-control', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")));  ?>

													<?php echo $form->error($model, 'v_false'); ?>
													<div class="resend-container text-left">
														<p class="resend-text">
															<?php echo $this->tag->getTag('didnt_receive_email?', 'Didn’t receive the email?'); ?>
														</p>
														<button class="btn btn-link resend-link" type="button" onclick="resendEmail(this)">
															<i class="fa fa-envelope"></i> <?php echo $this->tag->getTag('resend_email', 'Resend email'); ?>
															<span id="total_send" style="margin-left: 5px;"></span>
														</button>
														</div>
													<script>
														function openDivResend() {
															$('#resedV').removeClass('hide');
														}

														function closereserve() {
															$('#resedV').addClass('hide');
														}
													</script>

												</div>

											</div>
										</div>


										<div id="msg_alert"></div>
										<div class="clearfix"></div>
										<div class="form-group  ">

											<div class="row">

												<div class="col-sm-12">

													<div class="form-group  ">

														<div class="row">


															<div class="col-sm-12">
																<input type="hidden" name="next" value="" />

																<button type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-nwe" data-html="<?php echo $mainTex; ?>" data-auto-test-id="submitButton" id="bb3" style=" clear: both;border: 0 none;
    height: 40px;
    display: inline-block;
    border-radius: 20px;
    padding: 0 18px;
    font-size: 15px;
    font-weight: 700;
    outline: currentcolor none medium;
    box-shadow: none;
    cursor: pointer;
    margin-top: 10px;
    vertical-align: middle;
    text-align: center;
    background-color: var(--secondary-color);
    color: #fff;
    width: 100%;max-width: unset !important;" /><?php echo $mainTex; ?></button>

															</div>
														</div>
													</div><!-- end #signin-form -->


												</div>
											</div>

											<div class="clear"></div>
											<div class="clear"></div>


											<div class="clearfix"></div>
										</div>

										<?php $this->endWidget(); ?>
									</div>
									<?php /* 
                 	<div class="m_head_title_button" style="text-align: left;margin-bottom: 10px;"><a href="javascript:void(0)" onclick="resendEmail(this)" style="color: var(--link-color);font-weight: 700;text-decoration: underline;" class="">Not received? Click here to resend <span id="total_send">(2)</span></a></div>
                    */
									?>
									<div class="row hide">
										<div class="col-sm-12">
											<div><img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDE1Ljg2OSA0MTUuODY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MTUuODY5IDQxNS44Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzRBODUzIiBkPSJNMTI1LjkxLDE3MC44NDFjLTUuNzQ3LTYuMjY5LTE1LjY3My02Ljc5Mi0yMS45NDMtMS4wNDVjLTYuMjY5LDUuNzQ3LTYuNzkyLDE1LjY3My0xLjA0NSwyMS45NDMgICBsNzguODksODUuNjgyYzMuMTM1LDMuMTM1LDYuNzkyLDUuMjI0LDEwLjk3MSw1LjIyNGMwLDAsMCwwLDAuNTIyLDBjNC4xOCwwLDguMzU5LTEuNTY3LDEwLjk3MS00LjcwMkw0MDMuODUzLDc4Ljg5ICAgYzYuMjY5LTYuMjY5LDYuMjY5LTE2LjE5NiwwLTIxLjk0M2MtNi4yNjktNi4yNjktMTYuMTk2LTYuMjY5LTIxLjk0MywwTDE5My44MjksMjQ0LjUwNkwxMjUuOTEsMTcwLjg0MXoiIGRhdGEtb3JpZ2luYWw9IiM0RENGRTAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiM0RENGRTAiPjwvcGF0aD4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzNEE4NTMiIGQ9Ik00MDAuMTk2LDE5Mi4yNjFjLTguODgyLDAtMTUuNjczLDYuNzkyLTE1LjY3MywxNS42NzNjMCw5Ny4xNzUtNzkuNDEyLDE3Ni41ODgtMTc2LjU4OCwxNzYuNTg4ICAgUzMxLjM0NywzMDUuMTEsMzEuMzQ3LDIwNy45MzVTMTEwLjc1OSwzMS4zNDcsMjA3LjkzNSwzMS4zNDdjOC44ODIsMCwxNS42NzMtNi43OTIsMTUuNjczLTE1LjY3M1MyMTYuODE2LDAsMjA3LjkzNSwwICAgQzkzLjUxOCwwLDAsOTMuNTE4LDAsMjA3LjkzNXM5My41MTgsMjA3LjkzNSwyMDcuOTM1LDIwNy45MzVzMjA3LjkzNS05My41MTgsMjA3LjkzNS0yMDcuOTM1ICAgQzQxNS44NjksMTk5LjA1Myw0MDkuMDc4LDE5Mi4yNjEsNDAwLjE5NiwxOTIuMjYxeiIgZGF0YS1vcmlnaW5hbD0iIzREQ0ZFMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzREQ0ZFMCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" style=" width:50px;  margin: 0 auto 0px;"></div>

											<h3>
												<font style="vertical-align: inherit;">
													<font style="vertical-align: inherit;"><?php echo  'Verify your email address and activate your account.'; ?></font>
												</font>
											</h3>
											<div class="text-left00">
												<p>
													<font style="vertical-align: inherit;">
														<font style="vertical-align: inherit;"><?php echo  'We have sent you a link in your email to confirm your account. <br />
Just click the link to complete the sign-up process. 
'; ?></font>
													</font>
												</p>
											</div>
											<?php
											if (!empty($model)) { ?>
												<div class="m_head_mediator"></div>
												<div class="m_head_title_button" style="text-align: left;margin-bottom: 10px;"><a href="javascript:void(0)" onclick="resendEmail(this)" style="color: var(--link-color);font-weight: 700;text-decoration: underline;" class="">Not received? Click here to resend <span id="total_send">(2)</span></a></div>
												<script>
													var total_send = 2;

													function resendEmail(k) {
														if (total_send > 0) {
															$('#total_send').html('<i class="fa fa-refresh fa-spin"></i>');


															$.get('<?php echo Yii::app()->createUrl('user/resendEmail'); ?>', {
																email: '<?php echo base64_encode($model->email); ?>'
															}, function(data) {
																var data = JSON.parse(data);
																if (data.status == '1') {
																	total_send = parseInt(total_send) - 1;
																	$('#total_send').html('(' + total_send + ')');

																} else {
																	$('#total_send').html('(' + total_send + ')');
																	alert(data.message)
																}



															})
														} else {
															alert('Your resend limit exceeded');
														}
													}
												</script>
											<?php } ?>
											<div class="text-left00">
												<div class="bold-style">Haven’t received an email?</div>
												<p>Please check your spam or junk folder to make sure it’s not there.</p>
												<p style="margin-top:10px;">If still you have not received email, then please contact on <a href="<?php echo Yii::app()->options->get('system.common.whatsappcontact', '#comming'); ?>"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/wt2.png'); ?>" style="height:22px; "></a></p>

											</div>


											<p> <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="btn btn-primary btn-block headfont" style="font-size: 14px;">Go to the home page</a> </p>

										</div>
									</div>
								</div>
							<?php
							} else {
							?>

								<div class="row  signup-container margin-top-50">

									<div class="col-md-8" style="margin:auto;float:none;max-width:448px;">
										<div class="module-head" id="yui_3_18_1_1_1536724890525_310">
											<h2 id="yui_3_18_1_1_1536724890525_309"><?php echo $heading; ?></h2>
										</div>
										<div class="sign-in-form style-1">

											<div class="tabs-container alt">
												<p class="special"><?php echo $this->tag->getTag('enter_your_new_email_address_a', 'Enter your new email address and we\'ll send you a link to verify your account.'); ?></p>

												<!-- Login -->
												<div class="tab-content padding-top-0" id="tab1" style="border-top:0px;">
													<div class="tab_container no-margin no-padding">

														<div id="tab1" class="tab_content active_content" id="fbsignin-form">
															<div class="form">

																<div id="right-col">

																	<style>
																		#fbsignin-form #right-col .error {
																			width: auto !important;
																		}
																	</style>
																	<div id="signin-form">

																		<div class="form-row nomargin">
																			<?php
																			$form = $this->beginWidget('CActiveForm', array(
																				'enableAjaxValidation' => true,
																				'htmlOptions' => array('id' => 'form-account-loginasd', 'data-abide' => '', 'style' => ''),
																				'clientOptions' => array(
																					'validateOnSubmit' => true,
																				),
																			));; ?>
																			<?php
																			if (!Yii::app()->request->isPostRequest) {
																				$model->email = '';
																			}
																			echo $form->textField($model, 'email', array_merge($model->getHtmlOptions('email'), array("class" => "user-email")));
																			?>
																			<?php echo $form->error($model, 'email'); ?>
																			<div class="clear"></div>
																		</div>

																		<div class="fbsignin-button-block" style="width:100%;">
																			<button type="submit" class="btn awesome fbsignin-button frebites_button" value="" style="width:100%;"><i class="fa fa-envelope"></i> <?php echo $this->tag->getTag('change-email', 'Change Email'); ?></button>
																			<span class="forgotpassword pull-left margin-left-0 nomarginwe"><?php echo Yii::t('app', $this->tag->getTag('dont_receivie_verification_ema', 'Dont receive verification email? {l}'), array('{l}' => '<a href="' . $this->app->createUrl('user/emailVerification', array('email' => $model->email)) . '"   class="redbold">' . $this->tag->getTag('send-it-again', 'Send it again') . '</a>')); ?></span>

																			<div class="clearfix"></div>
																		</div>
																		<?php $this->endWidget(); ?>
																	</div><!-- end #signin-form -->
																</div><!-- end #right-col -->

																<div class="clearfix"></div>
															</div><!-- end #tab1 -->


														</div><!-- end .tab_container -->

													</div>

													<!-- Register -->

												</div>
											</div>




										</div>

									</div>

								</div>

							<?
							}
							?>
						</div>

						<div class="clearfix"></div>
					</div>

				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /wrapper -->
</div>
<!-- /error_page -->