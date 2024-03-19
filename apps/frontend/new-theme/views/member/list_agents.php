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
$AgentsCreated =  $this->member->AgentsCreated;
$max_no_users  = $this->member->max_no_users;
$remaining_users = $max_no_users - $AgentsCreated ;
// and render if allowed
if ($viewCollection->renderContent) { 

     $date_added =  $model->getAttributeLabel('date_added');
            $ad_title =  $model->getAttributeLabel('ad_title');
            $category_id =  $model->getAttributeLabel('category_id');
              $status =  $model->getAttributeLabel('status');
                $section_id =  $model->getAttributeLabel('section_id');
?>
<script>
function termicateUser(k){
 
	 
    $.jAlert({
        'type': 'confirm',
        'confirmQuestion': 'Are you sure to do this action?',
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
    select[name="ListingUserAgent[role_id]"] { padding: 5px 0px!important;height:26px; }
</style>
    <div class="box box-primary">
        <div class="box-header">
       
            <div class="page-header bx" style="margin-top:0px;"> <h4 class="page-title" style="min-width:100%;"><?php echo $title;?>
          
            <a href="<?php echo Yii::app()->createUrl('member/add_agent');?>" class="btn btn-secondary pull-right"><i class="fa fa-plus"></i> <?php echo $this->tag->getTag('add_user','Add User');?></a>
             
		</h4> 
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
			   <div class="clearfix"><!-- --></div>
			   <br />
			   <div class="row">
			   <div class=" col-md-12 grid-margin stretch-card">
                    <div class="card" style="background:#fff">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="d-flex align-items-center pb-2">
                              
                              <p class="mb-0"><h4 class="font-weight-semibold"><span style="font-weight:normal; font-size: 17px;"><?php echo $this->tag->getTag('total_listing_quota','Total Listing Quota');?> - </span><?php echo (int)$max_no_users;?></h4> </p>
                            </div>
                            
                            <div class="progress progress-md">
                              <div class="progress-bar bg-info " role="progressbar" style="width: 100%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                            </div>
                          </div>
                            <?php $pecentage_used =   (($AgentsCreated/$max_no_users)*100);  $pecentage_remaining =   100-$pecentage_used; 
                            
                            if($pecentage_used <=50){
                             $pecentage_used_class = 'bg-success';
                            }
                            else{
                                $pecentage_used_class = 'bg-danger';
                            }
                           if($pecentage_remaining <=50){
                             $pecentage_remaining_class = 'bg-success';
                            }
                            else{
                                $pecentage_remaining_class = 'bg-danger';
                            }
                            
                            ?>
                          <div class="col-md-4 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                             
                                <p class="mb-0"><h4 class="font-weight-semibold"><span style="font-weight:normal; font-size: 17px;"><?php echo $this->tag->getTag('total_used','Total Used');?> - </span><?php echo (int)$AgentsCreated;?></h4> </p>
                            </div>
                          
                            <div class="progress progress-md">
                              <div class="progress-bar <?php echo $pecentage_used_class ;?>" role="progressbar" style="width: <?php echo $pecentage_used;?>%" aria-valuenow=" <?php echo $pecentage_used;?>" aria-valuemin="0" aria-valuemax=" <?php echo $pecentage_used;?>"></div>
                            </div>
                          </div>
                           <div class="col-md-4 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                                        <p class="mb-0"><h4 class="font-weight-semibold"><span style="font-weight:normal; font-size: 17px;"><?php echo $this->tag->getTag('total_remaining','Total Remaining');?> - </span><?php echo (int)$remaining_users;?></h4> </p>
                    
                             
                            </div>
                           
                            <div class="progress progress-md">
                              <div class="progress-bar <?php echo $pecentage_remaining_class;?>" role="progressbar" style="width: <?php echo  $pecentage_remaining;?>%" aria-valuenow=" <?php echo  $pecentage_remaining;?>" aria-valuemin="0" aria-valuemax=" <?php echo  $pecentage_remaining;?>"></div>
                            </div>
                          </div>
                     
                        </div>
                      </div>
                    </div>
                  </div>
			   </div>
			   <div class="clearfix"><!-- --></div>
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
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    
                    'itemsCssClass'     => 'table table-bordered border mb-0 align-items-center',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                       'summaryText' => '',
                      'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),

                    'pagerCssClass'     => 'pagination pull-right',
                    'pager'             => array(
                        'class'         => 'CLinkPager',
                        'cssFile'       => false,
                        'header'        => false,
                        'htmlOptions'   => array('class' => 'pagination')
                    ),
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                    	 array(
                            'name'  => 'date_added',
                            'value' => '@$data->DateAddedLong' ,
                            'htmlOptions'=>array("width"=>"120px","style"=>"text-align:center;",'dir'=>'auto','data-title'=> $date_added),
                            'filter'=>false,
                        ),
                        array(
                            'name'  => 'first_name',
                            'value' => '$data->FirstNameN' ,
                            'type' => 'raw' ,
                            'htmlOptions'=>array("width"=>"300px",'data-title'=> 'Agent Name' ),
                                
                        ),
                            array(
                            'name'  => 'role_id',
                            'value' => '$data->RoleTitle' ,
                             'filter' =>$model->findRoles()  ,
                            'type' => 'raw' ,
                            'htmlOptions'=>array("width"=>"150px",'data-title'=> 'Role' ),
                                
                        ),
                        
                        
                        array(
                            
                            'name'  => 'email',
                            'value' => '@$data->email' ,
                            'htmlOptions'=>array("width"=>"150px",'data-title'=> 'Email'),
                            'filter'=>false,
                        ),
                   
                   array(
                            'name'  => 'user_status',
                            'value' => '$data->StatusTitleU',
                            'filter'=>false,
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;",'data-title'=>'Status'),
                            'type'  => 'raw',
                        ),
                   array(
                            'name'  => 'options',
                            'value' => '$data->OptionCls',
                            'filter'=>false,
                            'htmlOptions'=>array("width"=>"140px","style"=>"text-align:center;",'data-title'=>'Status'),
                            'type'  => 'raw',
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
 
