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
      //  $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus) , 'htmlOptions' => array('enctype' => 'multipart/form-data'),)); 
        ?>
        <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'miscellaneous-pages-form',
        'enableAjaxValidation'=>false,
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
				 
					<div class="form-group col-lg-6">
						 
					<?php echo $form->labelEx($model, 'property');?> 
					<?php $dropdwn =   array_merge( $model->getHtmlOptions('property'),array('empty'=>'Select  Property ',"style"=>"1",
					'ajax' =>
					array('type'=>'POST',
					'url'=>Yii::app()->createUrl('floor_plan/loadCategories'), //url to call.
					'update'=>'#FloorPlanFile_project_id', //selector to update
					'data'=>array('section_id'=>'js:this.value'),
					'beforeSend' => 'function(){
					$("#myDiv").addClass("grid-view-loading");}',
					'complete' => 'function(){
					$("#myDiv").removeClass("grid-view-loading");
					}',
					)
					)
					)

					;  ?> 
					<span id="myDiv" style="padding-left:20px;"></span>
					<?php echo $form->dropDownList($model,'property',CHtml::listData(Property::model()->listData(),"id" ,"name"), $dropdwn  ); ?>
					<?php echo $form->error($model, 'property');?>
					</div>           
					<div class="clearfix"><!-- --></div>
				 
					<div class="form-group col-lg-6">
						 
					<?php echo $form->labelEx($model, 'project_id');?> 
					<?php $dropdwn =   array_merge( $model->getHtmlOptions('project_id'),array('empty'=>'Select Project ',"style"=>"1",
					
							'ajax' =>
					array('type'=>'POST',
					'url'=>Yii::app()->createUrl('floor_plan/floorlist'), //url to call.
					'update'=>'#FloorPlanFile_floor_plan_id', //selector to update
					'data'=>array('section_id'=>'js:this.value'),
					'beforeSend' => 'function(){
					$("#myDiv2").addClass("grid-view-loading");}',
					'complete' => 'function(){
					$("#myDiv2").removeClass("grid-view-loading");
					}',
					)
					)) ;  ?> 
					<?php echo $form->dropDownList($model,'project_id',CHtml::listData(Project::model()->ListDataWithProperty($model->property),"project_id" ,"project_name"), $dropdwn  ); ?>
					<span id="myDiv2" style="padding-left:20px;"></span>
				 <?php echo $form->error($model, 'project_id');?>
					</div>  
						<div class="clearfix"><!-- --></div>
					         
					<div class="form-group col-lg-6">
						 
					<?php echo $form->labelEx($model, 'floor_plan_id');?> 
					<?php $dropdwn =   array_merge( $model->getHtmlOptions('floor_plan_id'),array('empty'=>'Select Floor Plan ',"style"=>"1",)) ;  ?> 
					<?php echo $form->dropDownList($model,'floor_plan_id',CHtml::listData(FloorPlan::model()->ListDataWithproject($model->project_id),'floor_plan_id','floor_plan_name'), $dropdwn  ); ?>
					<?php echo $form->error($model, 'floor_plan_id');?>
					</div>           
					<div class="clearfix"><!-- --></div>        
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'title');?>
						<?php echo $form->textField($model, 'title',$model->getHtmlOptions('title')); ?>
						<?php echo $form->error($model, 'title');?>
					</div>   
				   
					<div class="clearfix"><!-- --></div>   
					
					
					 <div class="clearfix"><!-- --></div> 
									 
								 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'file');?>
										<?php echo $form->error($model, 'file');?>
									</div> 
									 <div class="clearfix"><!-- --></div>
									 <?php 
								   if(!empty($image_array) )
								   {
									   
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image = "";
											foreach($image_array as $k=>$v)
											{
												$image .= ",".$v;
												$userfile_extn = substr($v, strrpos($v, '.')+1);
												if($userfile_extn=='pdf')
												{
														 $file = 'pdf.jpg';
												}
												else
												 {
													  $file =$v; 
												 }
											
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo Yii::app()->apps->getBaseUrl("uploads/floor_plan/".@$file) ?>" style="width:140px;">
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
											</a>
											<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this);">
											<span class="isw-delete2" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?
											}
									   ?>
										</div>
										<?php
										$model->file = $image;
								   }
								   ?>
									<?php echo $form->hiddenField($model, 'file', $model->getHtmlOptions('file')); ?>
									<?php // echo $form->textField($model, 'file_caption', $model->getHtmlOptions('file_caption')); ?>
									
									 <div class="clearfix"><!-- --></div>
									<div style="height:20px;color:#4E4E4E;font-size:16px;background:#EAEAEA;padding:15px 0px 35px 15px;">Drag and drop Photos here or click below to select photos from your computer </div> 
									<div  style="height:15px;color:#4E4E4E;font-size:12px; ;padding:12px 0px 25px 7px;">Hint: File types allowed:  .pdf,.doc,.docx,.odt,.jpg,.jpeg  Max  file size 1MB</div>
									<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>
									<script type="text/javascript">
									var accept = ".pdf,.doc,.docx,.odt,.jpg,.jpeg";
									var myAnswer;
									var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->createUrl('upload'); ?>",addRemoveLinks: true, maxFilesize: 1024,   acceptedFiles: accept, }) //according to your forms action
									 myDropzone.on("removedfile", function(file, serverFileName) {
									 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:file.serverId,inp:$("#FloorPlanFile_file").val()},function(data){  $("#FloorPlanFile_file").val(data) ; } );
									
									});
									myDropzone.on("success", function(file,serverFileName) {
										 
										 file.serverId =serverFileName;
										 
										 var vals  = $("#FloorPlanFile_file").val();
										 vals += ","+serverFileName;
										 $("#FloorPlanFile_file").val(vals) ;
										 
										 /*
										 var caps  = $("#FloorPlanFile_file_caption").val();
										 caps += ","+myAnswer;
										 $("#FloorPlanFile_file_caption").val(caps) ;
										 */
										 
									});
									/*
									myDropzone.on("sending", function(file, xhr, formData) {
								     myAnswer = prompt("Please Enter File Caption");
								 
									});
									*/
									var imgs = $("#FloorPlanFile_file").val(); 
									function delete_property_image(img, val,k)
									{
										 
										 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:img,inp:val},function(data){  $("#FloorPlanFile_file").val(data) ;imgs = data; } );
										 $(k).parent().parent().remove();
									}
									function delete_property_image2(val,k)
									{
					                      
										 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:val,inp:imgs},function(data){  $("#FloorPlanFile_file").val(data) ;imgs=data; } );
										 $(k).parent().parent().remove();
									}
									</script>
									
									<div class="clearfix"><!-- --></div> 
									 
                 
                 
                 <div class="clearfix"><!-- --></div>      
				 
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
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
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
