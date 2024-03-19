<div id="contact">
    <div id="contact-us2" class="mid-level-padding">
        <div class="container">

            <div class="row main-contact">
               <div class="" style="margin:auto;max-width:700px;width:100%">
                    <div class="right-section" id="form-elements">
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
				'htmlOptions'=>array('class'=>'form bottom_leadContact leadContact phs','style'=>'margin-top: 5px;' ),
				));
				?>		
				
				<style>
				.main-contact	.col-fs-8 {  width: 66.66666667% !important; }
				.main-contact	.col-fs-4 {  width: 33.33333333% !important;;}
				p.lbl {    font-size: 13px;    font-weight: 800;    line-height: 13px; margin-bottom: 5px !important; white-space:nowrap;overflow:hidden;text-overflow:elipsis;}
				 p.descLis {    margin-bottom: 15px;}p.descLis {    line-height: 18px;    font-size: 13px;margin-bottom: 15px !important;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
				</style>
					<div class="row ">
							<div class="col-sm-12 margin-bottom-20">
                           <div class="pull-left">
                            <h4>Leave Message</h4>
                            </div>
                            <div class="pull-right">
										<a href="<?php echo $model->userProfile;?>" rel="nofollow" target="_blank" title="Compass" class="floatRight">
										<?php 
										if(!empty($model->user_image)){ 
										$image = $this->app->apps->getBaseUrl('uploads/images/'.$model->user_image); ?>
										<div id="" class="man ptm" style="background-image:url('<?php echo $image;?>');;width:50px;height:50px;background-size:contain;background-repeat:no-repeat;background-position:center;border:1px solid #eee; border-radius:50%;"> </div>

										<?php } ?>
										</a>
                            </div>
                            </div>
                            </div>
                            <!--<p>Lorem ipsum is simply dummy text of the printing and typesetting industry.</p>-->
                           <div class="col-fs-8 padding-left-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        	<?php echo $form->textField($contact, 'name',$model->getHtmlOptions('name',array('class'=>'form-control'))); ?>
										<?php echo $form->error($contact, 'name');?>
										<?php echo $form->hiddenField($contact, 'ad_id'); ?>
										<?php echo $form->error($contact, 'name');?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
									<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'form-control'))); ?>
									<?php echo $form->error($contact, 'email');?>
                                    </div>
                                </div>
								<div class="clearfix"></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'form-control'))); ?>
						<?php echo $form->error($contact, 'phone');?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                               <?php echo $form->textField($contact, 'city',$contact->getHtmlOptions('city',array('class'=>'form-control'))); ?>
						<?php echo $form->error($contact, 'city');?>
                                    </div>
                                </div>
							<div class="clearfix"></div>
                           
<div class="col-sm-12">
                            <div class="form-group">
                                <?php
										  $contact->meassage = Yii::t('tran',' I am interested in {ad} ',array('{ad}'=>$model->AdTitle) ); 
										  echo $form->textArea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'form-control  margin-top-0'))); ?>
										 <?php echo $form->error($contact, 'meassage');?>
                            </div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div id="msg_alert2"></div><div class="clearfix"></div>
                            <div class="row">
							<div class="col-sm-12">
                            <button type="submit" class="btn button" id="submit_btn">Submit</button>
                            </div>
                            </div>
                       <?php $this->endWidget();?>
                    </div>
							<div class="clearfix"></div>
							</div>
							
							 <div class="col-fs-4">
								
								
								 
                   
                
                     <?php
                     if(!empty($model->company_name)){ ?>
						 <p class="lbl">Company</p>
						 <p class="descLis"><?php echo $model->company_name;?> </p>
                     <?php } ?> 
                     <?php
                     if(!empty($model->user_address)){ ?>
						 <p class="lbl">Contact Address</p>
						 <p class="descLis"><?php echo $model->user_address;?> </p>
                     <?php } ?> 
                   
                     <?php
											 	if(!empty( $model->user_email)) { 
													?>
													<p class="lbl">Email</p>
													<p class="descLis"><?php echo  $model->user_email ;?></p>
													<?
												}
											 	if(!empty( $model->user_number)) { 
													?>
													<p class="lbl">Contact Number</p>
													<p class="descLis"><?php echo  $model->user_number ;?>  </p>
													<?
												}
											 	if(!empty( $model->user_website)) { 
													?>
													<p class="lbl">Website</p>
													<p class="descLis"><?php echo  $model->user_website ;?> </p>
													 
													<?
												}
											  
											   ?>
								
								
								
								
                            <div class="clearfix"></div>
                            </div>
                            
							<div class="clearfix"></div>
                </div>
            </div>
        </div>



    </div>
    <!--/g-map-->
 
    <!--/g-map-->
</div>

