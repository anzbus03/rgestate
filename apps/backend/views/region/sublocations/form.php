<?php defined('MW_PATH') || exit('No direct script access allowed');

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
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'miscellaneous-pages-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
			)); 
		?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create_sublocation'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/sub_locations'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                
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
                <div class="row">
                    
                    <div class="col-lg-6 mt-2">
                        <?php 
                        if($model->isNewRecord and !Yii::app()->request->isPostRequest){
                                //$model->country_id ='66099';
                        }
                        if(empty( $model->country_id) and !empty($model->state_id)){
                            $model->country_id = $model->state->country_id;
                        }
                        
                        echo $form->labelEx($model, 'country_id');?> 
                        <?php $dropdwn =   array_merge( $model->getHtmlOptions('country_id'),array('empty'=>'Select Country ',"style"=>"1",
                           'ajax' =>
                           array('type'=>'GET',
                           'url'=>$this->createUrl('main_region/LoadStates'), //url to call.
                           'update'=>'#'.$model->modelName.'_region_id', //selector to update
                            'data'=>array('country_id'=>'js:this.value'),
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
                        <?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"), $dropdwn  ); ?> 
                        <?php echo $form->error($model, 'country_id');?>
                    </div>
                    
                    <div class="col-lg-6 mt-2">
                        <?php echo $form->labelEx($model, 'region_id');?> 
                        <?php $dropdwn =   array_merge( $model->getHtmlOptions('region_id'),array('empty'=>'Select Region ',"style"=>"1")) ;  ?> 
                        <?php echo $form->dropDownList($model,'region_id',CHtml::listData(MainRegion::model()->getStateWithCountry_2($model->country_id),"region_id" ,"name"), $dropdwn  ); ?>
                        <?php echo $form->error($model, 'region_id');?>
                    </div>      
                    <div class="col-lg-6 mt-2">
                        <?php echo $form->labelEx($model, 'parent_id'); ?>
                        <?php
                            // only top-level states (where parent_id IS NULL)
                            $mainStates = States::model()
                                ->findAll('parent_id IS NULL AND isTrash=0'); 
                            $listData   = CHtml::listData(
                                $mainStates, 'state_id', 'state_name'
                            );
                            echo $form->dropDownList(
                                $model,
                                'parent_id',
                                $listData,
                                array_merge(
                                    $model->getHtmlOptions('parent_id'),
                                    ['empty' => 'Select Main State']
                                )
                            );
                        ?>
                        <?php echo $form->error($model, 'parent_id'); ?>
                    </div>

                    <div class="col-lg-6 mt-2">
                        <?php echo $form->labelEx($model, 'Name');?>
                        <?php echo $form->textField($model, 'state_name', $model->getHtmlOptions('State Name')); ?>
                        <?php echo $form->error($model, 'state_name');?>
                    </div>        
<!--                     
                     <div class="col-lg-6 mt-2">
                        <?php echo $form->labelEx($model, 'p_name');?>
                        <?php echo $form->textField($model, 'p_name', $model->getHtmlOptions('p_name')); ?>
                        <?php echo $form->error($model, 'p_name');?>
                    </div>   -->
                     
                      <?php
                    if($model->isNewRecord){ ?> 
                    <!-- <div class="col-lg-6 mt-2">
                        <?php echo $form->labelEx($model, 'mul_city');?>
                        <?php echo $form->textArea($model, 'mul_city',$model->getHtmlOptions('mul_city')); ?>
                        <?php echo $form->error($model, 'mul_city');?>
                    </div>   -->
                    <?php } ?> 
                    
                        <!-- <div class="col-lg-6 mt-2">
                            <div class="col-lg-6 no-margin no-padding" style="width:50%;float:left;">
                            <?php echo $form->labelEx($model, 'icon');?>
                            </div>
                            <div class="col-lg-6  no-margin no-padding text-right" style="width:50%;float:left;">
                            <span id="widthDiv">
                            <span id="imageWidth">Width : 100px </span>   <span id="imageHeight">Height :100px</span>
                            </span>
                            </div>
                            
                            <?php echo $form->fileField($model, 'icon',$model->getHtmlOptions('icon')); ?>
                            <?php echo $form->error($model, 'icon');?>
                        </div>   
                        <div class="col-lg-2" style="width:100px;height:100px; background-image:url('<?php echo Yii::App()->apps->getBaseUrl('uploads/default/'.$model->icon);?>');background-size:cover;background-repeat:no-repeat:"></div>	 	 -->
                              
                </div>
           
                     
                <?php 
           
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?> 
                
            </div>
            <div class="box-footer">
                <div class="pull-right m-4">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                
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
<script type="text/javascript">

function sun(lat,lan)
{
	 
$("#States_location_latitude").val(lat);
$("#States_location_longitude").val(lan);
}
</script>
