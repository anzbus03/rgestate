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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
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
                  <div class="clearfix"><!-- --></div>
			       <div class="clearfix"><!-- --></div>
					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'receipeints');?>
					<?php
					Yii::import('common.extensions.yii-select2-master.Select2');
					echo Select2::multiSelect("receipeints", $model->receipeints,CHtml::listData(Leads::model()->findAll(),'lead_id','emailFullName') , array(
					'placeholder' => 'Recipeints',
					'style'=>'width:100%;',
					'select2Options' => array(
					//'maximumSelectionSize' => 2,
					),
					));
					?>
					 <?php echo $form->error($model, 'receipeints');?>
				</div>       
			     

				<div class="clearfix"><!-- --></div>
					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'subject');?>
					<?php echo $form->textField($model, 'subject',$model->getHtmlOptions('subject')); ?>
					<?php echo $form->error($model, 'subject');?>
					</div>  
						
				<div class="clearfix"><!-- --></div>  
			    <div class="form-group" id="message">
                    <?php echo $form->labelEx($model, 'message');?>
                    <div class="pull-right">
                      <?php echo CHtml::activeDropDownList($model, 'email_template', CHtml::listData(CustomerEmailTemplate::model()->findAll(array('select'=>'template_id,name')),'template_id','name'), $model->getHtmlOptions('email_template',array('empty'=>'Default Template','onchange'=>'return ChangeContent(this)'))); ?>
					
                    </div>
                    <div class="clearfix"><!-- --></div>
                    <?php echo $form->textArea($model, 'message', $model->getHtmlOptions('message', array('rows' => 15))); ?>
                    <?php echo $form->error($model, 'message');?>
                </div>
				<div class="pull-left"><a href="javascript:void(0);" onClick="$('.VissibleHiiden').css('display','block');$(this).hide(); "><i class="glyphicon glyphicon-paperclip" ></i> Add Attachment</a></div>
                <div class="clearfix"><!-- --></div>
                <?php 
								   if(!empty($model->imageArray))
								   {
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image = "";
											foreach($model->imageArray as $k=>$v)
											{
										 
												$image .= ",".$v;
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo Email::model()->getImageThumb($v);?>"  >
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
											</a>
											<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this,'<?php echo $model->id;?>');">
											<span class="isw-delete2" style="margin-right: 0px;"><i class="glyphicon glyphicon-trash"></i></span>
											</a>
											</div>
											</div>
											<?
											}
									   ?>
										</div>
										<?php
										$model->image = $image;
								   }
								   ?>
                <div class="VissibleHiiden" style="display:none;">
                <?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
				<div class="clearfix"><!-- --></div>
				<div style="height:20px;color:#4E4E4E;font-size:16px;background:#EAEAEA;padding:15px 0px 35px 15px;">Drag and drop Photos here or click below to select photos from your computer </div> 
				<div  style="height:15px;color:#4E4E4E;font-size:12px; ;padding:12px 0px 25px 7px;">Hint: <font color="#cc0001">File types allowed</font>: <?php echo OptionCommon::ExtensionArray() ;?> <font color="#cc0001"> Max Fiie size </font> <?php echo  Yii::app()->options->get('system.common.document_maximum_file_size_in_MB',2);?>  MB</div>
				<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>
				
				<script type="text/javascript">
				 
				var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->createUrl('send_email/upload'); ?>",addRemoveLinks: true, maxFilesize: <?php echo  Yii::app()->options->get('system.common.document_maximum_file_size_in_MB',2);?> , acceptedMimeTypes: '<?php echo OptionCommon::MimeTypesList() ;?>',}) //according to your forms action
				 myDropzone.on("removedfile", function(file, serverFileName) {
				 $.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_image").val()},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ; } );
				});
				myDropzone.on("error", function(file, message) { 
				alert(message);
				this.removeFile(file); 
				});
				myDropzone.on("success", function(file,serverFileName) {
					 file.serverId =serverFileName;
					 var vals  = $("#<?php echo $model->modelName;?>_image").val();
					 vals += ","+serverFileName;
					 $("#<?php echo $model->modelName;?>_image").val(vals) ;
					 
				});
				var imgs = $("#<?php echo $model->modelName;?>_image").val(); 
				function delete_property_image(img, val,k)
				{
					 $.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:img,inp:val},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs = data; } );
					 $(k).parent().parent().remove();
				}
				function delete_property_image2(val,k,leadid)
				{

					 $.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:val,inp:imgs,lead:leadid},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs=data; } );
					 $(k).parent().parent().remove();
				}
				 function ChangeContent(k){
				 
					$.get('<?php echo Yii::app()->createUrl('send_email/template');?>/template_id/'+$(k).val(),function(data){ CKEDITOR.instances.Email_message.setData(  data ) })
					} 
				
				</script>
				</div>
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
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app',  ($model->isNewRecord) ? 'Send' : 'Resend' );?></button>
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
 
