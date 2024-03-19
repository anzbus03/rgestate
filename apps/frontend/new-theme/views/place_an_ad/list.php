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
    
 @media only screen and (max-width: 600px) {
.savedUrl .table:not(.personal-task) tbody tr td:nth-child(3) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(4) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(5) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(6){
	width:100% !important; float:left !important;
} 
 }
</style>
    <div class="box box-primary savedUrl">
        <div class="box-header">
            <div class="row">
            <div class="col-sm-12">
                <h3 class="pageHeading"><?php echo $title;?>
                </h3>
            </div>
            <div class="col-sm-12">
                
                				<div class="sidebar-wrapper  margin-bottom-20">
<div class="search-container" id="search-options"> 
<div class="search-filters">

<script> 
	
	 
	function setValueSection(k){
		$('#PlaceAnAd_section_id').val($(k).val()).change();
	}
	 
function setValueKeyword(k){
		$('#PlaceAnAd_keyword').val($(k).val()).change();
	}
    function por(k){
        if($(k).is(':checked')){
        $('#PlaceAnAd_p_o_r').val('1').change();
        }
        else{
        $('#PlaceAnAd_p_o_r').val('').change();
        }
    }
    function featured(k){
        if($(k).is(':checked')){
        $('#PlaceAnAd_featured').val('1').change();
        }
        else{
        $('#PlaceAnAd_featured').val('').change();
        }
    }
</script>
<style>
									 #ck-button{margin:0;background-color:#fff;border-radius:0px;border:1px solid #dfe0e3;overflow:auto;float:left;color:var(--black-color)}#ck-button:hover{background:var(--secondary-color);color:#fff}#ck-button:hover span{background:var(--secondary-color);color:#fff}#ck-button label{float:left;width:100%;margin-bottom:0}#ck-button label span{text-align:center;padding:3px 0;display:block;line-height:25px;line-height:34px;padding:0 10px!important;color:var(--black-color);cursor:pointer}#ck-button label input{position:absolute;top:-20px;display:none}#ck-button input:checked+span{background-color:var(--secondary-color);color:#fff}
								#spl-id .col-sm-2{ padding-right:0px!important;}
								#ck-button{ width:100%;}
								@media only screen and (max-width: 600px) {
  #spl-id .col-sm-2 {
    flex: 1;
    max-width: unset !important;
    min-width: calc(50% - 8px);
    margin-bottom: 15px;
}#spl-id  select{ max-width:100%;width:100% !imprtant; }
html[dir="ltr"]  #spl-id{margin-right: 0px !important;}
html[dir="rtl"]  #spl-id{margin-right: 0px !important;}
}
									</style>
<div class="row" id="spl-id">
 <div class="col-sm-2 " style="max-width:151px" >
 	<div id="ck-button">
									<label>
									    <input type="checkbox" name="por" class="form-control" onchange="por(this)">
									 
									<span><?php echo $this->tag->getTag('price_on_request','Price on Request');?></span>
									</label>
									</div>
 	</div>
 	 <div class="col-sm-2 " style="max-width:151px" >
  
									 
									    <input type="text" name="price" class="form-control"   oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $model->custom_price;?>"  onchange="setPrice(this)" placeholder="<?php echo $this->tag->getTag('price','Price');?>">
									 
								 
								 
								 
 	</div>
 	 <div class="col-sm-2  "   style="max-width:100px">
 	<div id="ck-button">
									<label>
									    <input type="checkbox" name="featured" class="form-control"  onchange="featured(this)">
									 
									<span><?php echo $this->tag->getTag('featured','Featured');?></span>
									</label>
									</div>
 	</div>
<div class="col-sm-2  "  >
 <select name="status" onchange="setValueStatus(this)" class="form-control input-text">
					<option  value=""><?php echo  $this->tag->gettag('all_status','All Status');?></option>
					<?php
					$sectors  = PlaceAnAd::model()->statusArray();
					foreach($sectors as $k=>$v){ ?>

					<option  value="<?php echo $k;?>"> <?php echo $v ;?>  </option>

					<?php } ?> 
					</select>
</div>
<div class="col-sm-2    " >
 <select name="sec" onchange="setValueSection(this)" class="form-control input-text">
					<option  value=""><?php echo   $this->tag->gettag('all_sector','All Sector')  ;?></option>
					<?php
					$sectors  = array('1'=>$this->tag->gettag('for_sale','For Sale'),'2'=>$this->tag->gettag('for_rent','For Rent'));
					foreach($sectors as $k=>$v){ ?>

					<option  value="<?php echo $k;?>"> <?php echo $v;?>  </option>

					<?php } ?> 
					</select>
</div>
<div class="col-sm-2" style="width:auto;">
 <input type="text" name="q" id="search-box" onchange="setValueKeyword(this)" placeholder="<?php echo  $this->tag->gettag('title,description_etc.','Title,description etc.')   ;?>" class="form-control input-text" autocapitalize="off" autocomplete="off" autocorrect="off" role="textbox" spellcheck="false" value=""> 
</div> 
 
</div>
<style>select.form-control {
    width: 100% !important;max-width: unset !important;
}
input.form-control {
    width: 100% !important;
max-width: unset !important;
line-height: 31px !important;
height: auto;
text-indent: 10px;
}#member .select2-container--default .select2-selection--single, #place_an_ad .select2-container--default .select2-selection--single {
    border: 1px solid #dfe0e3;
}
</style>
<script> 
	
	 
	function setValueSection(k){
		$('#PlaceAnAd_section_id').val($(k).val()).change();
	}
	 
	function setValueStatus(k){
		$('#PlaceAnAd_status').val($(k).val()).change();
	}
	 function setPrice(k){
		$('#PlaceAnAd_custom_price').val($(k).val()).change();
	}
	 
</script>
<style>
.grid-filter-cell {  display: none; }
</style>


 




<div class="clearfix"></div>

<div class="reveal-modal small" data-reveal="" id="filterModal"></div>
</div>

</div>
</div>
        
                
            </div>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        	<script>
function termicateProperty(k){
 
	 
    $.jAlert({
        'type': 'confirm',
                'confirmQuestion': '<?php echo $this->tag->getTag('are_you_sure_to_do_this_action','Are you sure to do this action?');?>',
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
			 <style>
                .sml-header{ font-size:14px; margin-top:0px;margin-bottom:5px;font-weight:600;}
                .ordr-det p{ margin-bottom:5px;}
                span.pricecls { margin-left: 0px; font-weight:500;  margin-left:5px; }
                span.pricecls1 {width:100px;display:inline-block;  }
                .package-detail-ul { margin-left:0px; padding:0px;}
                .opts a {white-space:nowrap; line-height:30px;}
                a.cls-danger{ color:red; }
                a.cls-succes{ color:green; }
                a.cls-history{ color:orange; }
                .pricecls.failed { color:red; }
                .pricecls.terminate { color:red; }
                .pricecls.due { color:red; }
                .pricecls.trash { color:red; }
                .pricecls.pending { color:red; }
                .pricecls.refunded { color:green; }
                .pricecls.complete { color:green; }
                </style>
        <div class="box-body">
		    
            <div class="table-responsive" style="overflow-x: initial !important;">
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
           
            $ListingUserAgent =	new ListingUserAgent();
			$criteria=new CDbCriteria;
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.parent_user',(int) Yii::App()->user->getId());
			$child_user = $ListingUserAgent->findAll($criteria);
			
             $this->widget('common.components.web.widgets.GridViewBulkActionFront', array(
			'model'      => $model,		
			'tag'=>$this->tag,	
			'child_user'=>$child_user,
			'formAction' => $this->createUrl('member/bulk_action_exchange'),
			));
            // and render if allowed
            if ($collection->renderGrid) {
                 $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl('place_an_ad/index') ,
                       'ajaxUpdate'        =>false,
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                     'afterAjaxUpdate' => "function(id,data){ selectmenu()}",
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                    'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered',
                    'selectableRows'    => 0,
                      'pagerCssClass'     => 'pagination pull-right',
                    'pager'             => array(
                        'class'         => 'CLinkPager',
                        'cssFile'       => false,
                        'header'        => false,
                        'htmlOptions'   => array('class' => 'pagination')
                    ),
                    'enableSorting'     => false,
                     'template'=>'{items}{summary}{pager}',
                    'cssFile'           => false,
                     
                   // 'rowCssClassExpression' => ' $data->FrontClassA ',
                    'columns' =>  array(
					 array(
                            'class'               => 'CCheckBoxColumn',
                            'name'                => 'id',
                            'selectableRows'      => 100,  
                            'checkBoxHtmlOptions' => array('name' => 'bulk_item[]'),
                            'visible'   => empty($child_user) ? false : true ,
                        ),
                        array(
                            'name'  => 'date',
                            'value' => '@$data->ListingLi' ,
                            'filter'=>false,
                             'type'  => 'raw',
                            'htmlOptions'=>array('style'=>'width:120px;')
                        ),
                       
                        array(
                            'name'  => 'property',
                            'value' => '@$data->ListingLiTitle' ,
                            'filter'=>   CHtml::activeHiddenField($model, 'status' ) . CHtml::activeHiddenField($model, 'section_id' )  . CHtml::activeHiddenField($model, 'p_o_r' )  . CHtml::activeHiddenField($model, 'custom_price' ) . CHtml::activeHiddenField($model, 'featured' ) . CHtml::activeHiddenField($model, 'keyword' )    ,
                            'type'  => 'raw',
                        ),
                         
                         
                    
                        
                       
                        array(
                            'name'  => 'Q_score',
                            'value' => '$data->q_scoreTitle',
                               'filter'=>  false  ,
                            'htmlOptions'=>array("width"=>"160px","style"=>"position:relative;vertical-align:middle;" ,'class'=>"overld"),
                            'type'  => 'raw',
                        ),
                            array(
                            'name'  => 'statistics',
                            'value' => '$data->statisticsCls',
                               'filter'=>  false  ,
                            'htmlOptions'=>array("width"=>"160px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                        array(
                            'name'  => 'options',
                            'value' => '$data->OptionCls',
                               'filter'=>  false  ,
                            'htmlOptions'=>array("width"=>"160px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                       
                              
                      
                       
                       
                    ),  
                ) ); 
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
  <script type="text/javascript">
			 function selectmenu(){
				 
			var guageObj = $('.gauge'); 
			var gaugenumbers =   guageObj.length;
			if(gaugenumbers>0){
				$.each(guageObj,function(){
		    
		     $(this).dynameter({
		    	width: 50,
		    	label: '',
		    	value:  $(this).attr('data-mark'),
		    	min: 0,
		    	max: 100,
		    	unit: '%',
		    	regions: {
		    		 
		    		50: 'success',
		    		30: 'warning',
		    		0: 'danger',
		    	}
				})
		    
		    
				});
		    }
			 }
	 
		$(function(){
			selectmenu();
			$('select').select2({ minimumResultsForSearch: -1});
		    });
          </script>
