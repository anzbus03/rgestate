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
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                   
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
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
                	<div class=""></div>
					<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Contact Details</th>
</thead>
 
<tbody>
<tr class="odd">
<td>Contact Person</td>
<td  style="width:70px;"><?php echo @$model->name;?></td>
</tr>
 
<tr class="even">
<td style="width:70px;">Email</td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="odd">
<td style="width:70px;"><?php echo $model->getAttributeLabel('phone');?></td>
<td><?php echo @$model->phone;?></td>
</tr> 
</tbody>
 
</table>  
                <div class="clearfix"><!-- --></div>   

				<div class="form-group col-lg-6 hidden">
				<?php echo $form->labelEx($model,'ad_type'); ?>
				<br />
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adSense','uncheckValue'=>null, 'onClick'=> "$('.forImage').hide();$('.forScript').show();")) . ' Script'; ?>
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adImage','uncheckValue'=>null, 'onClick'=> "$('.forScript').hide();$('.forImage').show();")) . ' Image'; ?>
				<?php echo $form->error($model,'ad_type'); ?>
				</div>     
				
				<?php /*
                <div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'title');?>
				<?php echo $form->textField($model, 'title',$model->getHtmlOptions('title')); ?>
				<?php echo $form->error($model, 'title');?>
				</div>  
                <div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'description');?>
				<?php echo $form->textArea($model, 'description',$model->getHtmlOptions('description',array('rows'=>'4'))); ?>
				<?php echo $form->error($model, 'description');?>
				</div>  
				* */
				?>
				<script>
				function findSize(k){
					$.get('<?php echo Yii::app()->createUrl('banner/banner_size');?>/id/'+$(k).val(),function(data){ $('#banner_size').html(data); })
				}
				</script>
                <div class="clearfix"><!-- --></div>
                  <div class="clearfix"><!-- --></div>   

				<div class="form-group col-lg-6 hide">
				<?php echo $form->labelEx($model,'ad_type'); ?>
				<br />
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adSense','uncheckValue'=>null, 'onClick'=> "$('.forImage').hide();$('.forScript').show();")) . ' Script'; ?>
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adImage','uncheckValue'=>null, 'onClick'=> "$('.forScript').hide();$('.forImage').show();")) . ' Image'; ?>
				<?php echo $form->error($model,'ad_type'); ?>
				</div>        
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'position_id');?> <span id="banner_size" class="pull-right text-green">
                    <?php
                    if($model->position_id){
						$banner = BannerPosition::model()->findByPk($model->position_id);
						if (!empty($banner)) {
						   echo 'Width '.$banner->banner_width.'px <span class="text-red">X</span> Height  '.$banner->banner_height.'px';
						}
					}
					?>
                    </span>
                    <div class="clearfix"></div>
                      <?php $dropdwn =    $model->getHtmlOptions('position_id' ,array('empty'=>'Select Position ',"style"=>"1",'onchange'=>'findSize(this)' )) ;  ?> 
                    <?php echo $form->dropDownList($model,'position_id',CHtml::listData(BannerPosition::model()->listData(),"position_id" ,"position_name"), $dropdwn  ); ?>
                   
                             <?php echo $form->error($model, 'position_id');?>
                </div>   
                    <div class="clearfix"><!-- --></div>
                <div class="forImage" style="<?php echo  ($model->ad_type=='adImage') ? '' : 'display:none;' ;  ?>" >    
					<div class="clearfix"><!-- --></div>
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'image');?>
						<?php echo $form->fileField($model, 'image',$model->getHtmlOptions('image')); ?>
						<?php echo $form->error($model, 'image');?>
					</div>   
					<?php
					if(!Yii::App()->request->isPostRequest and !empty($model->image)){ ?>
					<div class="form-group col-lg-2">
						<img src="<?php echo Yii::App()->apps->getBaseUrl('uploads/banner/'.$model->image);?>" alt="image" style="width:100%;"/>
					</div>   
					<?php } 
					?>
				   
					<div class="clearfix"><!-- --></div>        
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'link_url');?>
						<?php echo $form->textField($model, 'link_url',$model->getHtmlOptions('link_url')); ?>
						<?php echo $form->error($model, 'link_url');?>
					</div>   
				   
					<div class="clearfix"><!-- --></div>     
                </div>   
                <div class="forScript"  style="<?php echo   ($model->ad_type=='adSense') ? '' : 'display:none;' ;  ?>">    
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'script');?>
                    <?php echo $form->textArea($model, 'script',array_merge($model->getHtmlOptions('script'),array("rows"=>"6"))); ?>
                    <?php echo $form->error($model, 'script');?>
                </div>   
               
                <div class="clearfix"><!-- --></div>   
					
					<div class="clearfix"><!-- --></div>   
               </div>
                <div class="clearfix"><!-- --></div>        
                
                <div class="clearfix"><!-- --></div>
                <div class="clearfix"><!-- --></div>
					<div class="form-group col-lg-3">
					<?php echo $form->labelEx($model, 'status');?>
					<?php echo $form->dropDownList($model, 'status',$model->statusArray(),$model->getHtmlOptions('status')); ?>
					<?php echo $form->error($model, 'status');?>
					</div>     
                <div class="clearfix"><!-- --></div>
                <?php
					$model->_unlimited_from =   empty($model->from_date) ? '1': '';
					$model->_unlimited_to =   empty($model->to_date) ? '1' : '';
					?>
					<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'from_date');?><span class="pull-right">Click for unlimited from date <?php echo $form->checkbox($model, '_unlimited_from',$model->getHtmlOptions('_unlimited_from',array('class'=>'','onchange'=>'makeNull(this,"from_date")'))); ?></span>
					<div class="clearfix"></div>
					<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'     => $model,
                                'attribute' => 'from_date',
                                'cssFile'   => null,
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => $model->getDatePickerFormat(),
                                ),
                                'htmlOptions' => array('class' => 'form-control','placeholder'=>'Unlimited from date', 'onChange'=>'uncheckDate(this,"_unlimited_from")'),
                            ));
					
					 ?>
					<?php echo $form->error($model, 'from_date');?>
					</div>     
					<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'to_date');?><span class="pull-right">Click for unlimited to date <?php echo $form->checkbox($model, '_unlimited_to',$model->getHtmlOptions('_unlimited_to',array('class'=>'','onchange'=>'makeNull(this,"to_date")'))); ?></span>
					<div class="clearfix"></div>
					<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'     => $model,
                                'attribute' => 'to_date',
                                'cssFile'   => null,
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => $model->getDatePickerFormat(),
                                ),
                                'htmlOptions' => array('class' => 'form-control','placeholder'=>'Unlimited to date', 'onChange'=>'uncheckDate(this,"_unlimited_to")'),
                            ));
					
					 ?>
					<?php echo $form->error($model, 'to_date');?>
					</div>     
					
				
					<div class=""></div>
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
?>
<script>
function makeNull(k,id){
	if($(k).is(':checked')){
		$('#Banner_'+id).val('');
	}
}
function uncheckDate(k,id){
 
		$('#Banner_'+id).prop('checked',false).val('').change();
	 
}
</script>
