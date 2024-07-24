            <div class="col-md-9  no-padding-left">
		 	  <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                  <span class="fa fa-trash-o"></span> <?php  echo  'Mail Trash'  ; ?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Compose Mail'), array('send_email/mail'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Compose New Email')));?>
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
			'formAction' => $this->createUrl('send_email/bulk_action_trash'),
			));
             
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
                            'name'  => 'sent_on',
                            'value' => '@$data->sent_on',
						    'type'=>'raw',
					 
                        ),
                        array(
                            'name'  => 'status',
                            'value' => '@$data->StatusTitle',
						    'type'=>'raw',
						    'filter'=>array(''=>'Choose','S'=>'Sent','Q'=>'On Queue')
					 
                        ),
               
                       
               
                      
                      
                            array(
                            'name'  => 'date_added',
                            'value' => '$data->dateAdded',
                            'filter'=> false,
                             'footer'    => $model->paginationOptions->getGridFooterPagination(),
                        ),
                     
                                     array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:70px;',
                            ),
                            'template' => ' '
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
                <div class="clearfix"><!-- --></div>
            </div>
            
		 
