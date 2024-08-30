 <?php $country = $model->country;    ?> 
 <?php $currency = $country->currency; ?> 
 <?php $bank = $model->bank; ?>  
 <?php $ad = $model->ad; ?>  
 <script>
function changeVal(k){
	 
 
	if($(k).val()=='A'){ $('#Ac').removeClass('hide'); }else{ $('#Ac').addClass('hide');$('#MortgageFollowup_proposed_price').val('').change(); } 
}
</script> 
<div class="col-sm-7">
         <div class="box box-success">
            <div class="card-header">
              <h3 class="card-title">Mortgage Application -  <?php echo $model->reference;?></h3>
            </div>
            <div class="card-body">
              <!-- Minimal style -->

              <!-- checkbox -->
               <div class="clearfix"></div>
         
          
          <table class="table table-bordered table-hover table-striped">
<thead>
 
<tr>
<th  colspan="2">Company -  <?php echo $bank->bank_name;?>  </th>
</tr>
</thead>

<tbody>
<tr class="odd">
<td colspan="2">Applicant Details</td>
</tr>
<tr class="odd">
<td  colspan="2"><?php echo @$model->name;?><br /><?php echo @$model->email;?><br /><?php echo @$model->phone;?><br /><hr  style="margin: 5px 0px;"/><b>Details</b><hr style="margin: 5px 0px;"/><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
 <tr class="odd">
<td style="width:170px;">Applied Date</td>
<td><?php echo date('d-m-Y',strtotime(@$model->dateAdded));?></td>
</tr>
<tr class="odd">
<td colspan="2">Other Details</td>
</tr>
 
 <tr class="odd">
<td  colspan="2">Monthly income : <?php echo @$model->monthly_income; echo  ' '.$currency->code;?><br />Requested Loan Amount : <?php echo @$model->total_loan;echo  ' '.$currency->code;?><br />Loan period : <?php echo @$model->loan_period;?> yrs <br />Interest rate : <?php echo @$model->interest_rate;?>%<br /><br /><?php if(!empty($ad)){ ?>  <b>Property Details</b><br /> <?php echo $ad->ad_title;?> <?php echo $ad->JavascriptPreview;?><?php } ?></td>
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
              <h3 class="card-title">Update Feedback</h3>
            </div>
            <div class="card-body">
              <!-- Minimal style -->

              <!-- checkbox -->
               <div class="clearfix"></div>
           
                <div class="">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo $form->label($note, 'status');?>
                            <?php echo $form->dropDownList($note, 'status', $note->status_array(),$note->getHtmlOptions('status',array('onchange'=>'changeVal(this)'))); ?>
                            <?php echo $form->error($note, 'status');?>
                        </div>
                    </div>
                    <div class="col-lg-6 <?php echo $note->status=='A' ?'' :'hide';?>" id="Ac">
                        <div class="form-group ">
                            <?php echo $form->label($note, 'proposed_price');?><span class="pull-right"><?php echo $currency->code;?></span>
                            <?php echo $form->textField($note, 'proposed_price',  $note->getHtmlOptions('proposed_price')); ?>
                            <?php echo $form->error($note, 'proposed_price');?>
                        </div>
                    </div>
                </div>
                 <div class="clearfix"></div>
           
                <div class="">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo $form->label($note, 'details');?>
                            <?php echo $form->textArea($note, 'details', $note->getHtmlOptions('details')); ?>
                            <?php echo $form->error($note, 'details');?>
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
	       <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                      <div class="box box-success">
            <div class="card-header">
              <h3 class="card-title">Followup</h3>
            </div>
            <div class="card-body">
              <!-- Minimal style -->

              <!-- checkbox -->
               <div class="clearfix"></div>
           
                   <div class=" ">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <?php
                            $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                                'ajaxUrl'           => $this->createUrl($this->route, array('id' => (int)$model->primaryKey)),
                                'id'                => $note2->modelName.'-grid',
                                'dataProvider'      => $note2->search(),
                                'filter'            => null,
                                'filterPosition'    => 'body',
                                'filterCssClass'    => 'grid-filter-cell',
                                'itemsCssClass'     => 'table table-hover',
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
                                        'name'  => 'id',
                                        'value' => '$data->id',
                                    ),
                                    array(
                                        'name'  => 'details',
                                        'value' => '$data->feedbackDetails',
                                        'type'=>'raw',
                                    ),
                                    
                                    array(
                                        'class'     => 'CButtonColumn',
                                        'header'    => Yii::t('app', 'Options'),
                                        'footer'    => $note2->paginationOptions->getGridFooterPagination(),
                                        'buttons'   => array(
                                            'delete' => array(
                                                 'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp;', 
                                                'url'       => 'Yii::app()->createUrl("loan_application/delete_followup", array("id" => $data->primaryKey))',
                                                'imageUrl'  => null,
                                                'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'btn btn-danger btn-flat delete'),
                                            ),
                                        ),
                                        'headerHtmlOptions' => array('style' => 'text-align:right'),
                                        'footerHtmlOptions' => array('align' => 'right'),
                                        'htmlOptions'       => array('align' => 'right', 'class' => 'options'),
                                        'template'          => '{delete}'
                                    ),
                                ), $this),
                            ), $this));
                            ?>
                        </div>
                    </div>
                </div> 
              
                 <div class="clearfix"></div>
           
              <!-- radio -->
            </div>
            <!-- /.box-body -->
            
          </div>
    
                <div class="clearfix"></div>
          
	<?
}
?>
	   </div>

