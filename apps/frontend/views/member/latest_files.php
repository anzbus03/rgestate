<div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Latest Listings</h5>
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
            
            // and render if allowed
         
                $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl($this->route) ,
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->latestFiles(10),
                    'filter'            => $model,
                    'summaryText'=>'',
                    'filterPosition'    =>  '',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table  table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                     
                   // 'rowCssClassExpression' => ' $data->FrontClassA ',
                    'columns' =>  array(
					 
                        array(
                            'name'  => 'date',
                            'value' => '@$data->dateAdded' ,
                            'filter'=>false,
                            'htmlOptions'=>array('style'=>'text-align:center;width:120px;')
                        ),
                       
                        array(
                            'name'  => 'ad_title',
                            'value' => 'CHtml::link($data->ad_title,$data->PreviewUrlTrash)' ,
                            
                            'type'  => 'raw',
                        ),
                         
                        
                        array(
                            'name'  => 'category_id',
                            'value' => '@$data->category->category_name' ,
                            'htmlOptions'=>array("style"=>"width:150px"),
                            //'filter'=>Category::model()->getCategory(),
                             'filter'=>Category::model()->getCategory()
                        ),
                        
                         
                        array(
                            'name'  => 'status',
                            'value' => '$data->StatusLinkFront',
                            'filter'=>$model->statusArray(),
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                       
                              
                         
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                           // 'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-edit"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("place_an_update/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'view' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-eye"></span> &nbsp;', 
                                    'url'       =>'$data->PreviewUrlTrash',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => ''    ),
                                   
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-trash-o"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id"=>$data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            
                                
                             
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:120px;',
                            ),
                            'template' => ' {update}  {view}    '
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
        
