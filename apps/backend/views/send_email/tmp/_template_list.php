     <div class="col-md-9">
		  <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-text-width"></span> <?php echo $pageHeading;?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('send_email/email_template_create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'New')));?>
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
                            'name'  => 'name',
                            'value' => '@$data->name',
						    'type'=>'raw',
					 
                        ),
               
                      
                      
                            array(
                            'name'  => 'date_added',
                            'value' => '$data->date_added',
                            'filter'=> false,
                             'footer'    => $model->paginationOptions->getGridFooterPagination(),
                        ),
                     
                                     array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/templateUpdate", array("template_uid" => $data->template_uid))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("templates/delete", array("template_uid" => $data->template_uid))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'view' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-eye-open"></span> &nbsp; ', 
                                    
                                   
                                    'url'       => 'Yii::app()->createUrl("templates/preview", array("template_uid" => $data->template_uid))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Preview'), 'class' => 'Preview','onClick'=>'windowOpen(this,event)'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => '{update} {delete} {view}'
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
           
            
		 
