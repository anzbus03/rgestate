<div class="col-sm-7">
         <div class="box box-success">
            <div class="card-header">
              <h3 class="card-title">Agent Review -  <?php echo $model->review_id;?></h3>
            </div>
            <div class="card-body">
              <!-- Minimal style -->

              <!-- checkbox -->
               <div class="clearfix"></div>
         
             <table class="table table-bordered table-hover table-striped" style="font-size:18px;line-height:25px;">
<thead>
 
<th  colspan="2">Agent -  <?php echo $model->agent_name;?>  ( <?php echo $model->company_name;?> )  </th>
</tr>
</thead>

<tbody>
<tr class="odd">
<td colspan="2">Reviewer Details</td>
</tr>
<tr class="odd">
<td  colspan="2"><?php echo @$model->name;?><br /><?php echo @$model->email;?><br /><?php echo @$model->phone;?><br /><hr  style="margin: 5px 0px;"/><b>Details</b><hr style="margin: 5px 0px;"/></td>
</tr>
 
 <tr class="odd">
<td style="width:170px;">Review Date</td>
<td><?php echo date('d-m-Y',strtotime(@$model->dateAdded));?></td>
</tr>
  <tr class="odd">
<td  colspan="2"><?php echo $model->getAttributeLabel('rating');?> : <strong> <?php $model->rating ;?></strong><br /><?php echo $model->getAttributeLabel('review');?> : <?php echo nl2br($model->review);?><br /><?php echo $model->getAttributeLabel('sect');?> : <?php echo @$model->SectTitle;?><?php if(!empty($model->property_link)){ ?> <br /> <?php echo $model->getAttributeLabel('property_link');?> : <?php echo @$model->property_link;?><?php } ?><br /> <?php echo $model->getAttributeLabel('location');?> : <?php echo @$model->location;?><br /><?php echo $model->getAttributeLabel('when_interact');?> : <?php echo @$model->when_interactTitle;?><br /><br /> <br />   </td>
</tr>
 
</tbody>
 
</table> 
                 <div class="clearfix"></div>
           
              <!-- radio -->
            </div>
            <!-- /.box-body -->
            
          </div>
   </div> 
  
   <div class="col-sm-5">
	   <?php 
if($this->action->id=='view'){
	$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));
	if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm');
	 ?>
	 
	 <div class="row">
         <!-- /.col (left) -->
        <div class="col-md-12">
           <!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="card-header">
              <h3 class="card-title">Change Review Status</h3>
            </div>
            <div class="card-body">
              <!-- Minimal style -->

              <!-- checkbox -->
               <div class="clearfix"></div>
           
                <div class="">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->label($model, 'status');?>
                            <?php echo $form->dropDownList($model, 'status', $model->status_array(),$model->getHtmlOptions('status',array( ))); ?>
                            <?php echo $form->error($model, 'status');?>
                        </div>
                    </div>
                </div>
              
                 <div class="clearfix"></div>
           
              <!-- radio -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat"><?php echo   Yii::t('app', 'Save changes');?></button>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
	 
	 
	 
       
	 <?
	 
	 
	 $this->endWidget(); 
 }
}

	?>
	       
          
	<?
}
?>
	   </div>

