<div class=" ">
            <div class="col-12 grid-margin">
              <div class="">
                <div class="">
                  
                   <div class="table-responsive">
					   <script>
			function setTagThis(k,id){
				 
				$('#<?php echo $model->modelName;?>_'+id).val($(k).val()).change(); 
				 
			}
			</script>
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
         
                $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl('dashboard/LatestAdsByManager',array('user_id'=>$user_id)) ,
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->latestFiles2(10),
                    'filter'            => $model,
                    //'summaryText'=>'',
                    'filterPosition'    =>  'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                     
                   // 'rowCssClassExpression' => ' $data->FrontClassA ',
                    'columns' =>  array(
					 
                        array(
                            'name'  => 'date',
                            'value' => '@$data->TitleSectD2'  ,
                            'filter'=>false,
                            'type'=>'raw',
                            'htmlOptions'=>array('style'=>'width:120px;')
                        ),
                       
                        array(
                            'name'  => 'ad_title',
                                   'value' => 'CHtml::Link(@$data->AdTitleWithIcons,"javascript:void(0)",array("onclick"=>"openUrlFUll(this)","data-url"=>$data->PreviewUrlTrash))' ,
                     
                            
                            'type'  => 'raw',
                        ),
                           array(
                            'name'  => 'status',
                            'value' => '$data->statusLink',
                            'filter'=>$model->statusArray(),
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                              
                       array(
                            'name'  => 'company_name',
                                   'value' => '@$data->company_name' ,
                      
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
