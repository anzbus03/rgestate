<style>
    table.projects-tbl {
    border: none;
}
    .projects-tbl {
    border-collapse: collapse;
    border-spacing: 0;
}table.projects-tbl > thead > tr > th {
    font-size: 14px;
    color: #313131;
    font-weight: 700;
    padding-bottom: 0px;background: #fafafa;
}table.projects-tbl tr {
    margin-bottom: 15px;
    background: #fff;
    border-bottom: #f8f8f8 10px solid;
}table.projects-tbl tr td {
    vertical-align: middle;
}
.status-A { border:2px solid green !important;;border-radius: 2px !important;}
.status-I { border:2px solid red !important;;border-radius: 2px !important;}
.margin-top-10 { margin-top:10px; }
</style>
   <style>
		   
		        .preview-img { width: 200px; float:left;border:1px solid #eee;overflow: hidden;height: 150px;margin-right:5px; background:#fff; }
		        .img-thumbnail-b { width: 100%;max-height:100px;height: 100%;}
		        .img-thumbnail-b img { object-fit : contain; width:100%;height: 100%; }
		    </style>
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
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
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
                  <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/ad_image'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
            <div class="  col-sm-12">
                <script>
                    function setthisValm(k){
                     $('#PlaceAnAd_image_status').val($(k).val()).change(); 
                    }
                </script>
               <label  style="color:green;"><input type="radio" name="change_Adstatus" <?php echo $model->image_status=='A' ? 'checked=true' : ''; ?>   onchange="setthisValm(this)" value="A" id="name1">Ad with active Images</label> 
               <label style="margin-left:15px;color:red" ><input type="radio" name="change_Adstatus" <?php echo $model->image_status=='I' ? 'checked=true' : ''; ?>  onchange="setthisValm(this)"  value="I" id="name2">Ad with inactive Images</label> 
                <label style="margin-left:15px;"><input type="radio" name="change_Adstatus" value=""  <?php echo $model->image_status=='' ? 'checked=true' : ''; ?>  onchange="setthisValm(this)" id="name3">Ad with   Images</label> 
            </div>
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
                    'itemsCssClass'     => 'table projects-tbl',
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
                            'value' => '@$data->GridViewImageManagement' ,
                             'filter'=>CHtml::activeTextField($model, 'ad_title').CHtml::activeHiddenField($model, 'image_status'),
                            'type'=>'raw'
                              
                        ),
                       
                       /*
                         
                        array(
                            'name'  => 'status',
                            
                           
						
						 
					
                            'value' => function($data){
								         echo "<div class='property_img_box1'>";
								         foreach($data->adImagesOnView3 as $k=>$v)
								         {
				                             	?>
				                             		<div id="property_img_<?php echo $k;?>" class="property_img <?php if($v->status=='A') { echo "divborder_approve"; } else{ echo "divborder_disapprove"; } ?>" style="line-height:40px;width:70px;" >
								 
														 <img src="<?php echo $v->getdetailImages($v->image_name);?>" style="max-width:60px;max-height:50px;    object-fit: contain;">
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
              
                       */ 
                       
    
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

  <script>
		         var updateUrl = '<?php echo $model->StatusUrlBack;?>'
	 
		          var deleteUrl = '<?php echo $model->StatusUrlDeleteBack;?>'
		        function UpdateStatus(k){
		            var updateUrl2 = updateUrl+'/id/'+$(k).attr('data-id')+'/status/'+$(k).val();
		             
		            $.get(updateUrl2,function(data){ if(data=='1'){ alert('Successfully changed status') ; } });
		            //$.get(updateUrl,{st});
		        }
		         function deleteImage(k){
		             var conf  = confirm('Are you sure to remove image ?');
		             if(conf){
		            var deleteUrl2 = deleteUrl+'/id/'+$(k).attr('data-id') ;
		             var thiiddel = $(k);
		            $.get(deleteUrl2,function(data){ if(data=='1'){ alert('Successfully deleted') ; thiiddel.closest('.preview-img').remove();  } });
		             }
		        }
		         function updateStatus(k){
		             
		            var updateUrlm =  $(k).attr('data-url') ;
		             
		            $.get(updateUrlm,function(data){ if(data=='1'){ $('.buttons-list').find('.btn').removeClass('btn-secondary');  alert('Successfully updated AD status') ; $(k).addClass('btn-secondary')  } });
		              
		        }
		    </script>