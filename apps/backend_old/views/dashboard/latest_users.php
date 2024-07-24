<div class=" ">
            <div class="col-12 grid-margin">
              <div class="">
                <div class="">
                 
                   <div class="table-responsive">
					   
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
                    'ajaxUrl'           => $this->createUrl('dashboard/latestCustomer') ,
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->latestFiles(10),
                    'filter'            => $model,
                    'summaryText'=>'',
                    'filterPosition'    =>  'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                     
                   // 'rowCssClassExpression' => ' $data->FrontClassA ',
                    'columns' =>  array(
					 
                        array(
                            'name'  => 'first_name',
                            'value' => '@$data->first_nameD' ,
                            'filter'=>false,
                            'type'=>'raw',
                            //'htmlOptions'=>array('style'=>'width:120px;')
                        ),
                       
                          array(
                            'name'  => 'email','filter'=> false,
                            'value' => '@$data->CheckEmailVerified." ".@$data->CheckMobileVerified',
                             'type'=>'raw'
                        ),
                      
                              array(
                            'name'  => 'status',
                              'value' => '$data->MemebrApproved',
                             'filter'=> false,
                             'type'=>'raw',
                            // 'htmlOptions'=>array('style'=>'width:50px;')
                            
                        ),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', '-'),
                           // 'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                              
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-trash-o"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("listingusers/delete", array("id"=>$data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            
                                
                             
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:50px;',
                            ),
                            'template' => ' {delete}     '
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
