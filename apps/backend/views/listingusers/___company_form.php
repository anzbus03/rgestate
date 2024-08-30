 <?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($user,'hotel_name'))); 
        ?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array('listingusers/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('listingusers/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="card-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                 <div id="header">
					<ul>
				    <li id="selected"><a href="<?php if($user->user_id) { echo $this->createUrl(Yii::app()->controller->id.'/update',array("id" => $user->user_id )) ; } else { echo "#"; } ?>">Edit Details</a></li>
				    <?php
				    if($user->user_type==4)
				    {
						?>
						<li><a href="<?php   echo $this->createUrl(Yii::app()->controller->id.'/dealer_info',array("id" => $user->user_id )) ;   ?>">Dealer Details</a></li>
				        <?php
					}
					?>
                    
			 
					</ul>
				</div>
				 
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'first_name');?>
							<?php echo $form->textField($user, 'first_name', $user->getHtmlOptions('first_name')); ?>
							<?php echo $form->error($user, 'first_name');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'last_name');?>
							<?php echo $form->textField($user, 'last_name', $user->getHtmlOptions('last_name')); ?>
							<?php echo $form->error($user, 'last_name');?>
							</div> 
							<div class="clearfix"><!-- --></div>
							<div class="form-group col-lg-12">
						<?php echo $form->labelEx($user, 'user_type');?> 
						<?php $dropdwn =   array_merge( $user->getHtmlOptions('user_type'),array('empty'=>'Select Type ',"style"=>"1")) ;  ?> 
						<?php echo $form->dropDownList($user,'user_type',CHtml::listData(UserType::model()->ListData(),"type_id" ,"type_name"), $dropdwn  ); ?>
						<?php echo $form->error($user, 'user_type');?>
						</div>
							<div class="clearfix"><!-- --></div>
							
							<div class="form-group col-lg-12">
							<?php echo $form->labelEx($user, 'address');?>
							<?php echo $form->textArea($user, 'address', $user->getHtmlOptions('address')); ?>
							<?php echo $form->error($user, 'address');?>
							</div> 
						 
						    
						    <div class="clearfix"><!-- --></div>
						    
							<?php
							if($user->user_type!=4){
								?>
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'country');?>
							<?php 
							 
							$mer =  array(
									'empty'=>'Select Nationality',
									"class"=>"form-control" ,  
									'ajax' =>
											array('type'=>'GET',
											'url'=>$this->createUrl('loadCategories'), //url to call.
											'update'=>'#ListingUsers_state', //selector to update
											'data'=>array('country_id'=>'js:this.value'),
											'beforeSend' => 'function(){
											$("#myDiv").addClass("grid-view-loading");}',
											'complete' => 'function(){
											$("#myDiv").removeClass("grid-view-loading");
											}',
											)
										)
                       ; ?>  
							<span id="myDiv" style="padding-left:20px;"></span>
                             <?php echo $form->dropDownList($user, 'country', CHtml::listData(Countrieslist::model()->listData(),'id','name'), $mer); ?>
							<?php echo $form->error($user, 'country');?>
							</div> 
								<?php
							}else{
								?>
								
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($user, 'country_id');?>
							<?php 
							$mer =  array(
									'empty'=>'Select Country',
									"class"=>"form-control" ,  
									'ajax' =>
											array('type'=>'GET',
											'url'=>$this->createUrl('loadCategories'), //url to call.
											'update'=>'#ListingUsers_state', //selector to update
											'data'=>array('country_id'=>'js:this.value'),
											'beforeSend' => 'function(){
											$("#myDiv").addClass("grid-view-loading");}',
											'complete' => 'function(){
											$("#myDiv").removeClass("grid-view-loading");
											}',
											)
										)
                       ; ?>
							<span id="myDiv" style="padding-left:20px;"></span>
                             <?php echo $form->dropDownList($user, 'country_id', CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name'), $mer); ?>
							<?php echo $form->error($user, 'country_id');?>
							</div> 
													<div class="form-group col-lg-3">
						<?php echo $form->labelEx($user, 'state');?> 
						<?php $dropdwn =   array_merge( $user->getHtmlOptions('state'),array('empty'=>'Select state ',"style"=>"1")) ;  ?> 
						<?php echo $form->dropDownList($user,'state',CHtml::listData(States::model()->ListDataWithCountry($user->country_id),"state_id" ,"state_name"), $dropdwn  ); ?>
						<?php echo $form->error($user, 'state');?>
						</div>
								<?
							}
							/*
						<div class="form-group col-lg-6">
						
						<?php echo $form->labelEx($user, 'state');?> 
						<?php $dropdwn =   array_merge( $user->getHtmlOptions('state'),array('empty'=>'Select state ',"style"=>"1")) ;  ?> 
						<?php echo $form->dropDownList($user,'state',CHtml::listData(States::model()->ListDataWithCountry($user->country),"state_id" ,"state_name"), $dropdwn  ); ?>
						<?php echo $form->error($user, 'state');?>
					
						
							</div>	 
							* * */
						?>
						 
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($user, 'zip');?>
							<?php echo $form->textField($user, 'zip', $user->getHtmlOptions('zip')); ?>
							<?php echo $form->error($user, 'zip');?>
							</div> 
							<div class="form-group col-lg-3">
							 <?php echo $form->labelEx($user, 'phone');?>
							<?php echo $form->textField($user, 'phone', $user->getHtmlOptions('phone')); ?>
							<?php echo $form->error($user, 'phone');?>
							</div> 
						    <div class="clearfix"><!-- --></div>
						   
						    <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'fax');?>
							<?php echo $form->textField($user, 'fax', $user->getHtmlOptions('fax')); ?>
							<?php echo $form->error($user, 'fax');?>
							</div> 
							<div class="form-group col-lg-6">
							 <?php echo $form->labelEx($user, 'email');?>
							<?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
							<?php echo $form->error($user, 'email');?>
							</div> 
						    
						   <div class="clearfix"><!-- --></div> 
                     
						    
						    <div class="clearfix"><!-- --></div>
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'password');?>
							<?php echo $form->passwordField($user, 'password', $user->getHtmlOptions('password')); ?>
							<?php echo $form->error($user, 'password');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'con_password');?>
							<?php echo $form->passwordField($user, 'con_password', $user->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($user, 'con_password');?>
							</div> 
                <div class="clearfix"><!-- --></div>  
				<div class="form-group col-lg-6">
				<?php echo $form->labelEx($user, 'package_id');
				$user->package_id = (empty($user->package_id)) ? PricePlanOrder::DEFAULT_PLAN  : $user->package_id ;
				?>
				<?php $dropdwn =   array_merge( $user->getHtmlOptions('user_type'),array("style"=>"1")) ;  ?> 
				<?php echo $form->dropDownList($user,'package_id',CHtml::listData(PricePlan::model()->findAllByAttributes(array( 'status' => PricePlan::STATUS_ACTIVE),array('order'=>'t.price asc')),"plan_id" ,"name"), $dropdwn  ); ?>
				<?php echo $form->error($user, 'package_id');?>
				</div> 
				
				  <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($user, 'package_expiry_date');?>
                    <?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$user,
						'attribute' => 'package_expiry_date',
						// additional javascript options for the date picker plugin
				 
						// additional javascript options for the date picker plugin
						'options'=>array(
						'dateFormat' => 'yy-mm-dd',
						'showAnim'=>'fold',
						),
						'htmlOptions'=>array(
						'class'=>'form-control',
						'readonly'=>'true',
						),
						));
                    ?>
                     <?php echo $form->error($user, 'package_expiry_date');?>
                </div>        
				
				<div class="form-group col-lg-6">
				<?php echo $form->labelEx($user, 'email_verified');?>
				<?php echo $form->checkbox($user, 'email_verified', array_replace($user->getHtmlOptions('email_verified'),array('style'=>'width:auto;'))); ?>
				<?php echo $form->error($user, 'email_verified');?>
				</div> 

                <div class="clearfix"><!-- --></div>  
                
                  <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($user, 'Avatar');?>
                    <?php echo $form->hiddenField($user, 'image');?>
                    
					<div style="" id="loger">

					<img src="<?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/avatar/'.$user->image ); ;?>" id="imageupload" width="128" alt="">
					</div>
                    <? 
                    
                    
					$this->widget('root.apps.extensions.EAjaxUpload.EAjaxUpload',
					array(
					'id'=>'uploadFile',
					'config'=>array(
					'action'=>Yii::app()->createUrl('listingusers/upload'),
					'template'=>'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload</span></div><div class="qq-upload-button">Upload a file</div><ul class="qq-upload-list"></ul></div>',
					'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
					'sizeLimit'=>10*1024*1024,// maximum file size in bytes
					//  'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
					'onSubmit' => "js:function(){
					$('#uploadFile .qq-upload-list').html(''); // This will empty list
					}",
					'onComplete'=>"js:function(id, fileName, responseJSON){   $('#uploadFile .qq-upload-list').html(''); Fsuccess(fileName) }",
					//'messages'=>array(
					//                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
					//                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
					//                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
					//                  'emptyError'=>"{file} is empty, please select files again without it.",
					//                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
					//                 ),
					//'showMessage'=>"js:function(message){ alert(message); }"
					)
					)); ?>
                    <?php echo $form->error($user, 'image');?>
                </div>   
                
                
                
                
                  
                <div class="clearfix"><!-- --></div>
                   <div class="clearfix"><!-- --></div>
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'status');?>
							<?php echo $form->dropDownList($user, 'status', array('A'=>'Active','I'=>'Inactive'), $user->getHtmlOptions('status')); ?>
							<?php echo $form->error($user, 'status');?>
							</div>  
                <div class="clearfix"><!-- --></div>
                
                <div class="clearfix"><!-- --></div>     
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?> 
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary " data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
 <script>
	baseU = '<?php echo Yii::app()->apps->getBaseUrl('uploads/avatar')?>/';
	
	function Fsuccess(fileName)
	{  
		 $("#ListingUsers_image").val(fileName)
		 $("#imageupload").attr('src',baseU+fileName)
		 
	}
	$("#loger").click(function(){  $('input:file').click()})
</script>
<style>
.qq-upload-button
{
	width:100% !important;
}
.qq-upload-button
{
	background:#c0c0c0 !important;
}
#loger
{
	width:100%;height:140px;background:#eee;text-align:center;padding:10px;cursor:pointer;
}
</style>
