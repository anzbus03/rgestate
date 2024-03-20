 <style>
 @media only screen and (max-width: 600px) {
     .savedUrl .table:not(.personal-task) tbody tr td:nth-child(3) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(4) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(5) , .savedUrl .table:not(.personal-task) tbody tr td:nth-child(6){
	width:100% !important; float:left !important;
} 
 }
 </style>
<div class="savedUrl">
            <div class="  grid-margin">
              <div class="">
                <div class="">
                  <h3 class="pageHeading"><?php echo $this->tag->getTag('my_properties','My Properties');?></h3>
                   <div class="table-responsive" style="overflow-x: initial !important;">
					   <script>
			function setTagThis(k,id){
				 
				$('#<?php echo $model->modelName;?>_'+id).val($(k).val()).change(); 
				 
			}
			</script>
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
			<Style>.grid-filter-cell{ display:none;}</Style>
            <?php 
            /**
             * This hook gives a chance to prepend content or to replace the default grid view content with a custom content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderGrid} to false 
             * in order to stop rendering the default content.
             * @since 1.3.3.1
             */
            
            // and render if allowed
               $ListingUserAgent =	new ListingUserAgent();
			$criteria=new CDbCriteria;
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.parent_user',(int) Yii::App()->user->getId());
			$child_user = $ListingUserAgent->findAll($criteria);
			$this->widget('common.components.web.widgets.GridViewBulkActionFront', array(
			'model'      => $model,			
			'child_user'=>$child_user,
			'tag'=>$this->tag,
			'formAction' => $this->createUrl('member/bulk_action_exchange'),
			));
                $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl('place_an_ad/index') ,
                       'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                     'afterAjaxUpdate' => "function(id,data){ selectmenu()}",
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
                            'filter'=>   CHtml::activeHiddenField($model, 'status' )    ,
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
            
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
           
            ?>
               <div class="clearfix"><!-- --></div>
            </div>  
                </div>
              </div>
            </div>
          </div> 
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