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
if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, "Image Management");?>
                </h3>
            </div>
            <style>
             .property_img_box1 { height:34px ;}
            </style>
            <div class="pull-right">
				<select id="page_size" style="vertical-align:-2px;" name="page_size" onchange="$.fn.yiiGridView.update('PlaceAnAd-grid',{ data:{page_size: $(this).val() }})">
				<option value="20" selected="selected">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="60">60</option>
				<option value="70">70</option>
				<option value="80">80</option>
				<option value="90">90</option>
				<option  value="100">100</option>
				</select>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php 
            /**
             * This hook gives a chance to prepend content or to replace the default grid view content with a custom content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderGrid} to false 
             * in order to stop rendering the default content.
             * @since 1.3.3.1
             */
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));
           
             $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
			 
			
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search_2(),
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-hover table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                    'pagerCssClass'     => 'pagination pull-right',
                    'pager'             => array(
                        'class'         => 'CLinkPager',
                        'cssFile'       => false,
                        'header'        => false,
                        'htmlOptions'   => array('class' => 'pagination')
                    ),
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                    
                        array(
                            'name'  => 'ad_title',
                            'value' => '@$data->ad_title' ,
                             'htmlOptions'=>array("width"=>"250px"),
                        ),
                       
                         
                        array(
                            'name'  => 'status',
                            
                           
						
						 
					
                            'value' => function($data){
								         echo "<div class='property_img_box1'>";
								         foreach($data->adImagesOnView3 as $k=>$v)
								         {
				                             	?>
				                             		<div id="property_img_<?php echo $k;?>" class="property_img <?php if($v->status=='A') { echo "divborder_approve"; } else{ echo "divborder_disapprove"; } ?>" style="line-height:40px;width:70px;" >
														 <?php echo Yii::app()->easyImage->thumbOf(Yii::app()->basePath . '/../../uploads/ads_thumb/'.$v->image_name,
				array(
				'resize' => array('width' => 50, 'height' =>50,"master"=>EasyImage::RESIZE_AUTO),
				'sharpen' => 20,
				'quality' => 100,)
				)  ?>
														 
															<div class="property_img_overlay">
															    <?php if($v->status=='A') {
																	?>
																<a class="btn btn-danger btn-small" onclick="approve('<?php echo $v->id;?>','<?php echo $v->status;?>',this);">
																<span class="isw-disapprove" style="margin-right: 0px;"></span>
																</a>
																<? }
																else
																{
																	?>
																	<a class="btn btn-success btn-small" onclick="approve('<?php echo $v->id;?>','<?php echo $v->status;?>',this);">
																	<span class="isw-approve" style="margin-right: 0px;"></span>
																	</a>
																	<?
																} 
																?>
														</div>
													</div>
				                             	<?									
										 }
										 echo "</div>";
											 
										},
                            'filter'=>false,
                            
                            
                        ),
              
                      
                       
    
                    ), $this),
                ), $this)); 
            }
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
            $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                'controller'    => $this,
                'renderedGrid'  => $collection->renderGrid,
            )));
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
            
			<div class="box-footer">
			<div class="pull-right">
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
			</div>
          <?php $this->endWidget(); ?>
        </div>
    </div>
<?php 
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

function approve(id,status,k)
{
	  var obj =	  $(k).parent().parent();
      obj.addClass("grid-view-loading2") ;

	  
	 
	  
	  $.post("<?php echo Yii::app()->createUrl("place_an_ad/image_approve_manage");?>",{id:id},function(data){ 
		 
		   if(status=="I")
	       {
				obj.removeClass("divborder_disapprove") ;
				obj.addClass("divborder_approve") ;
				obj.find(".btn").removeAttr("onclick");
				obj.find(".btn").attr("onclick","approve('"+id+"','A',this)");
				obj.find(".btn").removeClass("btn-success");
				obj.find(".btn").addClass("btn-danger");
				obj.find("span").removeClass("isw-approve");
				obj.find("span").addClass("isw-disapprove");
			
				
				
				 
		   }
		   else
		   {
				
				obj.removeClass("divborder_approve") ;
				obj.addClass("divborder_disapprove") ;
				obj.find(".btn").removeClass("btn-danger");
				obj.find(".btn").addClass("btn-success");
				obj.find("span").removeClass("isw-disapprove");
				obj.find("span").addClass("isw-approve");
				 obj.find(".btn").removeAttr("onclick");
				obj.find(".btn").attr("onclick","approve('"+id+"','I',this)");
				 
				 
				
		   }
			  obj.removeClass("grid-view-loading2") ;	
			  obj.removeClass("grid-view-loading2") ;	
		  
		   });
}
</script>

