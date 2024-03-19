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
    <div class="box box-primary savedUrl">
        
                  <ul class="tabs-submenu list-unstyled clearfix  " style="margin-bottom: 15px;">
                <li class="active"> <a href="#current"><?php echo $this->tag->getTag('property_inquiries','Property Inquiries');?></a></li>
                
            	  <li class=""><a href="<?php echo Yii::app()->createUrl('member/agent_enquiry');?>"><?php echo $this->tag->getTag('agent_inquiries','Agent Inquiries');?></a></li>
              
				 
            </ul>
         <div class="clearfix"><!-- --></div>
	 
		 <div class="clearfix"><!-- --></div>
        <div class="box-body padding-bottom-50">
            <div class="table-responsive">
            <?php 
      
     $name =  $model->getAttributeLabel('name');$ad_title =  $model->getAttributeLabel('ad_title');
            $email =  $model->getAttributeLabel('email');
            $phone =  $model->getAttributeLabel('phone');
           $date = $model->getAttributeLabel('date');
                
              $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                     'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => '',
                       'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
                 
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered border mb-0 align-items-center',
                    'selectableRows'    => 0,
                     'summaryText' => '',
                      'emptyText' =>$this->tag->getTag('no_results_found!','No results found.') ,
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
                            'value' => '@$data->name' ,
                            'htmlOptions'=>array('data-title'=> $name),
                        ),
                        array(
                            'name'  => 'ad_title',
                            'value' => '$data->AdTitleDetails' ,
                            'type'=>'raw',
                             'htmlOptions'=>array('data-title'=> $ad_title),
                           
                        ),
                         array(
                            'name'  => 'date',
                            'value' => '"<span dir=auto>".@$data->DateAddedLong."</span>"' ,
                             'htmlOptions'=>array('data-title'=> $date),
                               'type'=>'raw',
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email' ,
                             'htmlOptions'=>array('data-title'=> $email),
                            
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '"<span dir=ltr>".@$data->phone."</span>"' ,
                             'htmlOptions'=>array('data-title'=> $phone),
                             'type'=>'raw'
                            
                        ),
                         
                       
                        
                          
                       
                        array(
                            'class'     => 'CButtonColumn',
                             'header'    =>  $this->tag->getTag('options','options') ,
                             
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/enq_view", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                   'options'   => array('title' => Yii::t('app', 'View'), 'id' => 'iframe', 'class' => 'iframe1'),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete_enq", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => ' {update}{delete}'
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
         
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
             <div class="clearfix"><!-- --></div>
		 </div>
       
<?php 
 
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
 
?>
 
 <script>
 $(function(){
 $(".iframe1").fancybox({
    'width'         : '600px',
    'title'			:"View",
    'autoScale'     : false,
    'transitionIn'  : 'none',
    'transitionOut' : 'none',
    'type'          : 'iframe',
    'titleShow'		: false,
});})
 </script>
 <style>
 .fancybox-overlay { z-index:9999999999999 !important; }
 .fancybox-skin { background :#fff; }
 ::after, ::before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
} 
.fancybox-slide--iframe .fancybox-content {
    background: #fff;
    max-width: 500px;
    overflow: hidden;
    max-height: 81vh;
}.sml-header.owner{ display:none; }
 </style>
