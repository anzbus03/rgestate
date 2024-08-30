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
          $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal','enctype' => 'multipart/form-data'),'focus'=>array($model,'category_name'))); 
      
        ?>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
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
               
                 <div id="header" class="hide">
					<ul>
				    <li  id="selected"><a href="<?php if($model->category_id) { echo $this->createUrl(Yii::app()->controller->id.'/update',array("id" => $model->category_id )) ; } else { echo "#"; } ?>">Category Details</a></li>
				    
				    <li><a href="<?php if($model->category_id) { echo $this->createUrl(Yii::app()->controller->id.'/fields',array("id" => $model->category_id )) ; } else { echo "#"; } ?>">Fields Mamanger</a></li>
				    <li   ><a href="<?php if($model->category_id) { echo $this->createUrl(Yii::app()->controller->id.'/mandatory',array("id" => $model->category_id )) ; } else { echo "#"; } ?>">Mandatory Manager</a></li>
				
					</ul>
				</div>
				   <div class="row">
                        <div class="col-lg-6">
                           <?php echo $form->labelEx($model, 'category_name');?>
                           <?php echo $form->textField($model, 'category_name',$model->getHtmlOptions('category_name')); ?>
                           <?php echo $form->error($model, 'category_name');?>
                        </div> 
                        <div class="col-lg-6">
                           <?php echo $form->labelEx($model, 'plural');?>
                           <?php echo $form->textField($model, 'plural',$model->getHtmlOptions('plural')); ?>
                           <?php echo $form->error($model, 'plural');?>
                        </div> 
                        <div class="col-lg-6">
                            <?php 
                            if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
                                $model->used_in = CHtml::listData($model->listTypes,'listing_type','listing_type');
                                 
                            }
                            ;?>
                            <?php echo $form->labelEx($model, 'used_in');?>
                            <?php echo $form->dropDownList($model, 'used_in',CHtml::listData(MainCategory::model()->ListData(),'category_id','category_name'),$model->getHtmlOptions('used_in',array('empty'=>'Select','multiple'=>true))); ?>
                            <?php echo $form->error($model, 'used_in');?>
                        </div>  
                        <div class="col-lg-6 ">
                            <?php echo $form->labelEx($model, 'image');?>
                            <?php echo $form->fileField($model, 'image',$model->getHtmlOptions('image')); ?>
                            <?php echo $form->error($model, 'image');?>
                            <div class="col-lg-2  " style="width:100px;height:100px;background-color:#eee; background-image:url('<?php echo Yii::App()->apps->getBaseUrl('uploads/category/'.$model->image);?>');background-size:contain;background-position:center;background-repeat:no-repeat;"></div>	 	
                        </div>   
                        
                        <div class="col-lg-6 ">
                            <?php echo $form->labelEx($model, 'active_image');?>
                            <?php echo $form->fileField($model, 'active_image',$model->getHtmlOptions('active_image')); ?>
                            <?php echo $form->error($model, 'active_image');?>
                            <div class="col-lg-2  " style="width:100px;height:100px;background-color:#eee; background-image:url('<?php echo Yii::App()->apps->getBaseUrl('uploads/category/'.$model->active_image);?>');background-size:contain;background-position:center;background-repeat:no-repeat;"></div>	 	
                        </div>   
                   </div> 
                            
                <div class="form-group col-lg-12 hide">
                    <?php echo $form->labelEx($model, 'search_keyword');?>
                    <?php echo $form->textArea($model, 'search_keyword',$model->getHtmlOptions('search_keyword')); ?>
                    <?php echo $form->error($model, 'search_keyword');?>
                </div>    
                <div class="row">

                    <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'use_dev');?>
                       <?php echo $form->checkbox($model, 'use_dev',$model->getHtmlOptions('use_dev',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'use_dev');?>
                   </div>
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_bd');?>
                       <?php echo $form->checkbox($model, 'h_bd',$model->getHtmlOptions('h_bd',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_bd');?>
                   </div>   
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_bth');?>
                       <?php echo $form->checkbox($model, 'h_bth',$model->getHtmlOptions('h_bth',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_bth');?>
                   </div>   
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_in');?>
                       <?php echo $form->checkbox($model, 'h_in',$model->getHtmlOptions('h_in',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_in');?>
                   </div>     
                   <div class="form-group col-lg-6 hide">
                       <?php echo $form->labelEx($model, 'h_is_mor');?>
                       <?php echo $form->checkbox($model, 'h_is_mor',$model->getHtmlOptions('h_is_mor',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_is_mor');?>
                   </div>   
                   <div class="form-group col-lg-6 hide">
                       <?php echo $form->labelEx($model, 'h_r_facade');?>
                       <?php echo $form->checkbox($model, 'h_r_facade',$model->getHtmlOptions('h_r_facade',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_r_facade');?>
                   </div>   
                   <div class="form-group col-lg-6 hide">
                       <?php echo $form->labelEx($model, 'h_rights');?>
                       <?php echo $form->checkbox($model, 'h_rights',$model->getHtmlOptions('h_rights',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_rights');?>
                   </div>   
                   <div class="form-group col-lg-6 hide">
                       <?php echo $form->labelEx($model, 'h_may_affect');?>
                       <?php echo $form->checkbox($model, 'h_may_affect',$model->getHtmlOptions('h_may_affect',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_may_affect');?>
                   </div>  
                   <div class=" col-lg-6">
                       <?php echo $form->labelEx($model, 'h_disputes');?>
                       <?php echo $form->checkbox($model, 'h_disputes',$model->getHtmlOptions('h_disputes',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_disputes');?>
                   </div>   
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_expiry_date');?>
                       <?php echo $form->checkbox($model, 'h_expiry_date',$model->getHtmlOptions('h_expiry_date',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_expiry_date');?>
                   </div>      
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_l_no');?>
                       <?php echo $form->checkbox($model, 'h_l_no',$model->getHtmlOptions('h_l_no',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_l_no');?>
                   </div>   
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_plan_no');?>
                       <?php echo $form->checkbox($model, 'h_plan_no',$model->getHtmlOptions('h_plan_no',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_plan_no');?>
                   </div>    
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_no_of_u');?>
                       <?php echo $form->checkbox($model, 'h_no_of_u',$model->getHtmlOptions('h_no_of_u',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_no_of_u');?>
                   </div>   
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_floor_no');?>
                       <?php echo $form->checkbox($model, 'h_floor_no',$model->getHtmlOptions('h_floor_no',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_floor_no');?>
                   </div>   
                   <div class="clearfix"><!-- --></div>     
                   <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_unit_no');?>
                       <?php echo $form->checkbox($model, 'h_unit_no',$model->getHtmlOptions('h_unit_no',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_unit_no');?>
                   </div>   
                         <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_selling_price');?>
                       <?php echo $form->checkbox($model, 'h_selling_price',$model->getHtmlOptions('h_selling_price',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_selling_price');?>
                   </div>   
                   <div class="clearfix"><!-- --></div>  
                            <div class="form-group col-lg-6">
                       <?php echo $form->labelEx($model, 'h_p_limits');?>
                       <?php echo $form->checkbox($model, 'h_p_limits',$model->getHtmlOptions('h_p_limits',array('style'=>'width:auto', "class" => ""))); ?>
                       <?php echo $form->error($model, 'h_p_limits');?>
                   </div>
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

$(function(){
	$('select').select2();
	
})

</script>
