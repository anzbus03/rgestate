<?php defined('MW_PATH') || exit('No direct script access allowed');

 
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
<style>
a.text-warning:hover, a.text-warning:focus,a.text-warning {
    color:var(--secondary-color) !important;
}
 @media only screen and (max-width: 600px) {
.savedUrl .table:not(.personal-task) tbody tr td:nth-child(3) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(4) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(5) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(6){
	 float:left !important;
} .savedUrl .table:not(.personal-task) tbody tr td { padding-left:0px ; padding-right:0px;} 
html[dir="rtl"] .savedUrl .table:not(.personal-task) tbody tr td {   text-align: right; }
 }
</style>
<?php $this->renderPartial('_upload_pdf') ;?> 
<script>
    var loadDiv = ''; 
    var loadDivuid = ''; 
    var update_pdf = '<?php echo $this->app->createUrl('member/update_pdf');?>'; 
    var remove_pdf = '<?php echo $this->app->createUrl('member/remove_pdf');?>'; 
    var successUpload = '<a href="javascript:void(0)" class="cls-succes text-warning"><?php echo  $this->tag->getTag('uploaded','Uploaded');?></a><a href="[ULINK]" target="_blank"   class="cls-succes text-warning margin-left-5"><i class="fa fa-eye"></i></a> <a href="[UDLINK2]" target="_blank"   class="cls-succes text-warning margin-left-5"><i class="fa fa-download"></i></a> <a href="javascript:void(0)" data-uid="[DUID]" class="text-danger margin-left-5" onclick="removePdf(this)" ><i class="fa fa-remove"></i></a>';
    var successUpload2 = '<a href="javascript:void(0)" onclick="uploadFile2(this)" data-uid="[DUID]" class="cls-succes text-warning"><i class="fa fa-plus"></i> <?php echo $this->tag->getTag('upload_pdf_contract','Upload PDF contract');?></a>';
    var ldHtml = '<a href="javscript:void(0)"    class="cls-succes text-warning"><i class="fa fa-plus"></i> <?php echo $this->tag->getTag('loading','Loading..');?></a>'
	function uploadFile2(k){
		loadDiv = $(k).closest('.upparent');
		loadDivuid = $(k).attr('data-uid');
		uploadFile()
	}
	function removePdf(k){
		loadDiv = $(k).closest('.upparent');
		loadDivuid = $(k).attr('data-uid');
		 $.jAlert({
        'type': 'confirm',
        'confirmQuestion': '<?php echo $this->tag->getTag('are_you_sure_to_continue','Are you sure to continue?');?>',
         'confirmBtnText':'<?php echo $this->tag->getTag('yes','Yes');?>',
        'denyBtnText':'<?php echo $this->tag->getTag('no','No');?>',
        'onConfirm': function(e, btn) { 
			loadDiv.html(ldHtml)
			$.get(remove_pdf,{'uid':loadDivuid},function(data){
				var dat = JSON.parse(data);if(dat.status=='1'){ 
					successUpload3 = successUpload2;
					successUpload3 = successUpload3.replace("[DUID]", loadDivuid);
					loadDiv.html(successUpload3); }
				})
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });
	}
function termicatePackage(k){
 
	 
    $.jAlert({
        'type': 'confirm',
        'confirmQuestion': '<?php echo $this->tag->getTag('are_you_sure_to_terminate_this','Are you sure to terminate this package?');?>',
         'confirmBtnText':'<?php echo $this->tag->getTag('yes','Yes');?>',
        'denyBtnText':'<?php echo $this->tag->getTag('no','No');?>',
        'onConfirm': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            var url_load = $(k).attr('data-href');
            if (url_load !== undefined) {
                $('.loader').html('<div class="cntr"><div class="loaderspin"></div></div><div class="bg"></div>');
                $('.loader').addClass('loading');
                $.get(url_load, function(data) {

                    var data = JSON.parse(data);
                    if(data.status=='1'){
						successAlert('Sucees',data.message);
						window.location.href=data.href;
					}

                })
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });

 
}
</script>
    <div class="box box-primary savedUrl">
        <div class="box-header">
            <div class="row">
            <div class="col-sm-12">
                <h3 class="pageHeading"><?php echo $this->tag->getTag('order_history','Order History');?> <a href="<?php echo $this->app->createUrl('member/dashboard');?>" class="pull-right margin-right-10" style="font-weight: normal;font-size: 16px; line-height: 1;"><?php echo $this->tag->getTag('back','Back');?></a></h3>
                <style>
                .sml-header{ font-size:14px; margin-top:0px;margin-bottom:5px;font-weight:600;}
                .ordr-det p{ margin-bottom:5px;}
                span.pricecls { margin-left: 0px; font-weight:500;  margin-left:5px; }
                span.pricecls1 {width:100px;display:inline-block;  }
                .package-detail-ul { margin-left:0px; padding:0px;}
                .opts a {white-space:nowrap; line-height:30px;}
                a.cls-danger{ color:red; }
                a.cls-succes{ color:green; }
                .pricecls.failed { color:red; }
                .pricecls.terminate { color:red; }
                .pricecls.due { color:red; }
                .pricecls.trash { color:red; }
                .pricecls.pending { color:red; }
                .pricecls.refunded { color:green; }
                .pricecls.complete { color:green; }
                </style>
            </div>
          </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
		    
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
                    'id'                => $order->modelName.'-grid',
                    'dataProvider'      => $order->search(),
                    'filter'            => $order,
                    'filterPosition'    => '',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-hover',
                    'selectableRows'    => 0,
                        'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
                 
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
                            'name'  => 'order_id',
                            'value' => '$data->OrderStatusLi',
                            'type'  => 'raw',
                            'filter'=>false,
                        ),
                   
                        array(
                            'name'  => 'date',
                            'value' => '$data->OrderLi',
                            'type'  => 'raw',
                            'filter'=>false,
                        ),
                   
                     
                        array(
                            'name'  => 'pricing',
                            'value' => '$data->PricingLi',
                            'type'  => 'raw',
                             'filter'=>false
                        ), 
                        array(
                            'name'  => 'details',
                            'value' => '$data->PackageDetails',
                            'filter'=>false,
                            'type'=>'raw',
                        ),
                         
                        array(
                            'name'  => 'option',
                            'value' => '$data->OptionCls',
                            'filter'=> false,'type'=>'raw',
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
             <div class="clearfix"><!-- --></div>
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
 

