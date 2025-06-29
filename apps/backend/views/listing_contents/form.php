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
        $form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('class'=>'form-horizontal','enctype' => 'multipart/form-data')));
        ?>
        <style>
            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
            }

            .card-header-left {
                flex: 1;
            }

            .card-header-right {
                display: flex;
                gap: 10px;
            }

            .card-header-right .btn {
                margin-left: 5px;
            }
            .hide{
                display: none;
            }
        </style>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-book"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$areaguides->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                <div class="row">

                    <div class="form-group col-lg-4">
                        <?php 
                        if(!Yii::app()->request->isPostRequest   and empty($areaguides->area) and $areaguides->isNewRecord){
                            $areaguides->area ='19';
                        }
                        echo $form->labelEx($areaguides, 'area');  ?> 
                        <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('area'),array('empty'=>'Select Region ',"style"=>"1",
                           'ajax' =>
                           array('type'=>'GET',
                           'url'=>$this->createUrl('LoadCities'), //url to call.
                           'update'=>'#ListingContents_city', //selector to update
                            'data'=>array('area'=>'js:this.value'),
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
                        <?php echo $form->dropDownList($areaguides,'area',CHtml::listData(MainRegion::model()->getStateWithCountry_2(66124),"region_id" ,"name"), $dropdwn); ?>
                        <?php echo $form->error($areaguides, 'area');?>
                    </div>
                    <div class="form-group col-lg-4">
                        <?php echo $form->labelEx($areaguides, 'city');?> 
                        <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('city'),array('empty'=>'Select Community ',"style"=>"1")) ;  ?> 
                        <?php echo $form->dropDownList($areaguides,'city',CHtml::listData(States::model()->getStateWithCountry_2(66124),"state_id" ,"state_name"), $dropdwn  ); ?>
                        <?php echo $form->error($areaguides, 'city');?>
                    </div>
                   <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($areaguides, 'section_id'); ?> 
                            <?php 
                                // “Module” dropdown stays the same as before:
                                echo $form->dropDownList(
                                    $areaguides,
                                    'section_id',
                                    [ '1' => 'For Sale', '2' => 'For Rent', '6' => 'Business Opportunities' ],
                                    array_merge(
                                        $areaguides->getHtmlOptions('section_id'),
                                        [
                                            'empty' => 'Select Module',
                                            'ajax'  => [
                                                'type'    => 'POST',
                                                'url'     => $this->createUrl('place_property/dynamicPropertyTypes'),
                                                'update'  => '#ListingContents_p_type',
                                                'data'    => ['section_id' => 'js:this.value'],
                                                'beforeSend' => 'function(){
                                                $("#pTypeLoader").addClass("grid-view-loading");
                                                }',
                                                'complete' => 'function(){
                                                $("#pTypeLoader").removeClass("grid-view-loading");
                                                }',
                                            ],
                                        ]
                                    )
                                );
                            ?>
                            <span id="pTypeLoader" style="padding-left: 10px;"></span>
                            <?php echo $form->error($areaguides, 'section_id'); ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($areaguides, 'p_type'); ?> 
                            <?php 
                                // Instead of array(), use $categories that we passed from controller
                                echo $form->dropDownList(
                                    $areaguides,
                                    'p_type',
                                    $categories,  // <<--- pre‐populated if $areaguides->section_id was set
                                    array_merge(
                                        $areaguides->getHtmlOptions('p_type'),
                                        [
                                            'empty' => 'Select Category',
                                            'ajax'  => [
                                                'type'   => 'POST',
                                                'url'    => $this->createUrl('place_property/dynamicSubCategories'),
                                                'update' => '#ListingContents_sub_category',
                                                'data'   => ['category_id' => 'js:this.value'],
                                                'beforeSend' => 'function(){
                                                $("#subCategoryLoader").addClass("grid-view-loading");
                                                }',
                                                'complete' => 'function(){
                                                $("#subCategoryLoader").removeClass("grid-view-loading");
                                                }',
                                            ],
                                        ]
                                    )
                                );
                            ?>
                            <span id="subCategoryLoader" style="padding-left: 10px;"></span>
                            <?php echo $form->error($areaguides, 'p_type'); ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($areaguides, 'sub_category'); ?> 
                            <?php 
                                // Instead of array(), use $subCategories
                                echo $form->dropDownList(
                                    $areaguides,
                                    'sub_category',
                                    $subCategories,  // <<--- pre‐populated if $areaguides->p_type was set
                                    array_merge(
                                        $areaguides->getHtmlOptions('sub_category'),
                                        [
                                            'empty' => 'Select Sub Category',
                                            'ajax'  => [
                                                'type'   => 'POST',
                                                'url'    => $this->createUrl('place_property/dynamicNestedSubcategories'),
                                                'update' => '#ListingContents_nested_sub_category',
                                                'data'   => ['sub_category_id' => 'js:this.value'],
                                                'beforeSend' => 'function(){
                                                $("#nestedSubCategoryLoader").addClass("grid-view-loading");
                                                }',
                                                'complete' => 'function(){
                                                $("#nestedSubCategoryLoader").removeClass("grid-view-loading");
                                                }',
                                            ],
                                        ]
                                    )
                                );
                            ?>
                            <span id="nestedSubCategoryLoader" style="padding-left: 10px;"></span>
                        </div>
                    </div>

                    <div class="form-group col-lg-3">
                        <?php echo $form->labelEx($areaguides, 'nested_sub_category'); ?> 
                        <?php 
                            // Instead of array(), use $nestedSubCategories
                            echo $form->dropDownList(
                                $areaguides,
                                'nested_sub_category',
                                $nestedSubCategories, // <<--- pre‐populated if $areaguides->sub_category was set
                                array_merge(
                                    $areaguides->getHtmlOptions('nested_sub_category'),
                                    ['empty' => 'Select Nested Sub Category']
                                )
                            );
                        ?>
                        <?php echo $form->error($areaguides, 'nested_sub_category'); ?>
                    </div>

                    <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-12">
                        <?php echo $form->labelEx($areaguides, 'meta_title');?><?php echo $areaguides->getTranslateHtml('meta_title');?>
                        <?php echo $form->textField($areaguides, 'meta_title', $areaguides->getHtmlOptions('meta_title')); ?>
                        <?php echo $form->error($areaguides, 'meta_title');?>
                    </div>
                    
                    <div class="form-group col-lg-12 mt-4">
                        <?php echo $form->labelEx($areaguides, 'meta_description');?><?php echo $areaguides->getTranslateHtml('meta_description');?>
                        <?php echo $form->textArea($areaguides, 'meta_description', $areaguides->getHtmlOptions('meta_description', array('rows' => 4))); ?>
                        <?php echo $form->error($areaguides, 'meta_description');?>
                    </div>
                    <div class="clearfix"><!-- --></div>
                 
                    <div class="form-group col-lg-12 mt-4">
                        <?php echo $form->labelEx($areaguides, 'highlights');?><?php echo $areaguides->getTranslateHtml('highlights','ar',false,'1200px');?>
                        <?php echo $form->textArea($areaguides, 'highlights', $areaguides->getHtmlOptions('highlights', array('rows' => 15,'id' => 'highlights'))); ?>
                        <?php echo $form->error($areaguides, 'highlights');?>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>

                    <script>
                        // Wait for DOM to be fully loaded
                        $(document).ready(function() {
                            // Initialize first CKEditor
                            CKEDITOR.replace('highlights', {
                                height: 250,
                                toolbar: [
                                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                                    { name: 'styles', items: ['Format'] },
                                    { name: 'insert', items: ['Image', 'Link', 'Unlink'] },
                                    { name: 'tools', items: ['Maximize'] },
                                    { name: 'document', items: ['Source'] }
                                ],
                                format_tags: 'p;h1;h2;h3'
                            });
                        });
                    </script>
                    <style>
                        .form-control{
                            height: auto !important;
                        }
                    </style>
                    <div class="form-group col-lg-12 mt-4">
                        <?php echo $form->labelEx($areaguides, 'neighborhood');?> 
                        <?php echo $form->textArea($areaguides, 'neighborhood', $areaguides->getHtmlOptions('neighborhood', array('rows' => 15,'id' => 'neighborhood'))); ?>
                        <?php echo $form->error($areaguides, 'neighborhood');?>
                    </div>
                
                    <div class="col-lg-4">
                        <div class="form-group slug-wrapper"<?php if (empty($areaguides->slug)){ echo ' style="display:none"';}?>>
                            <?php echo $form->labelEx($areaguides, 'slug');?>
                            <?php echo $form->textField($areaguides, 'slug', $areaguides->getHtmlOptions('slug')); ?>
                            <?php echo $form->error($areaguides, 'slug');?>
                        </div>
                  
                    </div>
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
                
            </div>
            <div class="box-footer">
                <div class="pull-right" style="margin: 20px;">
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
