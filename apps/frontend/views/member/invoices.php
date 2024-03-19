<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                         <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span>  Invoices
                </h3>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
			 
            <div class="table-responsive">
            <?php 
            
            
            // and render if allowed
    
                $this->widget('zii.widgets.grid.CGridView' , array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $order->modelName.'-grid',
                    'dataProvider'      => $order->search(),
                    'filter'            => $order,
                    'filterPosition'    => '',
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
                    'columns' => array(
                      
                      
                        array(
                            'name'  => 'Commission',
                            'value' => '$data->getformattedTotal($data->amount)',
                              'filter' => false,
                        ),
                        array(
                            'name'  => 'how',
                            'value' => '$data->HowCalculate',
                            'filter' => false,
                        ),
                       
                        array(
                            'name'  => 'period',
                            'value' => '$data->generatedPeriod2',
                            'filter' => false,
                        ),
                       
                       
                        array(
                            'name'  => 'status',
                            'value' => '$data->StatusesTitle',
                            'filter'=> false,
                        ),
                        array(
                            'name'  => 'date_added',
                            'value' => '$data->dateAdded',
                            'filter'=> false,
                        ),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $order->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'view' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-eye"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("member/payment_view", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => ''),
                                ),
                           
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => '{view}  '
                        ),
                    ) ,
                ) );  
             
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
        </div>
    </div>
    

                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            </div>
         
