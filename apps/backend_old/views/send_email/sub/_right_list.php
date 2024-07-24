     <div class="col-md-12 no-padding-left">
		 	  <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
					<?php
					if(Yii::app()->request->getQuery('draft','0')=='1'){
						echo '<span class="fa fa-file-text-o"></span> Mail Draft';
					}
					else{
						echo '<span class="fa fa-inbox "></span> Mail Queue';
					}
                    ?>
                </h3>
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
           
		 	$this->widget('common.components.web.widgets.GridViewBulkAction', array(
			'model'      => $model,
			'formAction' => $this->createUrl('send_email/bulk_action'),
			));
             
            // and render if allowed
            if ($collection->renderGrid) {
				if(Yii::app()->request->getQuery('draft','0')=='1'){
					$returnUrl = $this->createUrl($this->route,array('draft'=>'1'));
				}
				else{
					$returnUrl = $this->createUrl($this->route);
				}
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $returnUrl,
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
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
                            'class'               => 'CCheckBoxColumn',
                            'name'                => 'id',
                            'selectableRows'      => 100,  
                            'checkBoxHtmlOptions' => array('name' => 'bulk_item[]'),
                             
                        ),
				 
                        array(
                            'name'  => 'subject',
                            'value' => '@$data->subject',
						    'type'=>'raw',
					 
                        ),
                          array(
                        'name'  => 'receipeints',
                        'value' => '@$data->ReceipeintsTilte',
                        'type'=>'raw',
                         
                        ),
                        array(
                            'name'  => 'sent_on',
                            'value' => '@$data->sent_on',
						    'type'=>'raw',
						    'visible'=> $model->getCheckVisible()  , 
					 
                        ),
                        array(
                            'name'  => 'status',
                            'value' => '@$data->StatusTitle',
						    'type'=>'raw',
						    'visible'=>  $model->getCheckVisible()  , 
						    'filter'=>array(''=>'Choose','S'=>'Sent','Q'=>'On Queue')
					 
                        ),
               
                         
                      
                          
                     
                                     array(
                                'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                 
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'view' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp; ', 
                                    
                                   
                                    'url'       => 'Yii::app()->createUrl("send_email/preview", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Preview'), 'class' => 'Preview','onClick'=>'windowOpen(this,event)'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'status' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("send_email/view_status", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => '' ,'target'=>'_blank'),
                                     'visible'   => '$data->status === "S"',
                                ),     
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:120px;',
                            ),
                            'template' => ' {delete} {view}  '
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
            
		 <div class="clearfix"><!-- --></div>
