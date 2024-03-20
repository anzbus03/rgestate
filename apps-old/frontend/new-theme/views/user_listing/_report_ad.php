                <?php $this->renderPartial('//detail/_success_html');?>
                 
                
               <div id="topThirdPlacementLeadFormContainer" class="miniHidden xxsHidden xsHidden smlHidden pan plm sign-in-form .">
                
                  <div class="backgroundBasic    " id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false" style="padding: 10px;">
							      
						   <?php
						   $mainTex =  'Report AD' ; 
						    $contact = new ReportAd();
							$contact->user_id =Yii::app()->user->getId();
							$contact->ad_id = $model->id;
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt',
							'action'=>Yii::app()->createUrl('user_listing/validateReport'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'. 'Validating...' .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb2").val("'. 'Please wait..' .'"); 
				
							ajaxSubmitHappenlist(form, data, hasError,"'.Yii::app()->createUrl('user_listing/reportAd').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							?>
                            <style>
                            img.ag{max-width:110px!important;max-height:50px!important;margin-bottom:0;margin-left:auto;text-align:center;margin-right:auto;display:block}.ptn.man.kw-agent-info__agentItem___2iGT_.h7{font-weight:700;line-height:20px;display:flex}.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span{margin-right:10px;font-weight:400;display:inline-block;max-width:90px;overflow:hidden;white-space:nowrap;min-width:90px;font-size:11px}
                            .ptn.man.kw-agent-info__agentItem___2iGT_.h7 { line-height:25px;}
                         
                    
@media only screen and (max-width: 500px) {
.mob-l-hide label{ display:none;}.mob-l-hide { height: 35px !important; }
}
                            </style>
                            
                           <div class="clear-fix"></div>
                           <div class="  ">
   <div class=" ">
      <div class="col-sm-12">
        <?php echo $form->hiddenField($contact, 'user_id',$contact->getHtmlOptions('user_id',array('class'=>'form-control'))); ?>
        <?php echo $form->hiddenField($contact, 'ad_id',$contact->getHtmlOptions('ad_id',array('class'=>'form-control'))); ?>
			<?php echo $form->error($contact, 'ad_id');?>		
      </div>
   </div>
</div>
                           
       
            
                      <style>
                      #ReportAd_master_id input {
    width: auto;
    float: left;
    display: inline-block;
    line-height: 6;
    margin-right: 10px;
    vertical-align: baseline;
    height: auto;
    margin-top: 7px;
}
.wewLabel label{ margin-bottom:2px; }
                      </style> 
             <div class="form-group  ">
   <div class="row">
	   <div class="col-sm-12 wewLabel">
	     <?php echo $form->labelEx($contact,'master_id'); ?>

          	<?php echo $form->dropDownList($contact, 'master_id',CHtml::listData(Master::model()->listData(3),'master_id','master_name'),$contact->getHtmlOptions('master_id',array('class'=>'input-text form-control','empty'=>'Please Select',"style"=>"
    height: 40px;
    text-indent: 15px;
    line-height: 1;
"  ))); ?>

        <?php echo $form->error($contact,'master_id'); ?>
        
   
   </div>
   </div>
</div>
      <div class="form-group  ">
   <div class="row">
      
      <div class="col-sm-12">
		   <?php echo $form->labelEx($contact,'name'); ?>
             	<?php echo $form->textField($contact, 'name',$contact->getHtmlOptions('name',array('class'=>'input-text form-control',"style"=>"
    height: 40px;
    text-indent: 15px;
    line-height: 1;
"   ))); ?>
			<?php echo $form->error($contact, 'name');?>
         		
      </div>
   </div>
</div>
     
       <div class="form-group  ">
   <div class="row">
      
      <div class="col-sm-12">
		   <?php echo $form->labelEx($contact,'email'); ?>
             	<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'input-text form-control' ,"style"=>"
    height: 40px;
    text-indent: 15px;
    line-height: 1;
"  ))); ?>
			<?php echo $form->error($contact, 'email');?>
         		
      </div>
   </div>
</div>
                       
           <div class="form-group  ">
   <div class="row">
      
      <div class="col-sm-12">
		   <?php echo $form->labelEx($contact,'comment'); ?>
             	<?php echo $form->textarea($contact, 'comment',$contact->getHtmlOptions('comment',array('class'=>'input-text form-control','style'=>'min-height:80px;'))); ?>
			<?php echo $form->error($contact, 'comment');?>
         		
      </div>
   </div>
</div>
          
  <div class="clearfix"></div>
      <div class="form-group margin-top-10">
          <div class="row">
        <div class="form-check col-sm-12">
   
         <button type="submit" class="btn btn-primary btn-block headfont btn-sm-s" style="background: var(--secondary-color);color:#fff;min-width: 200px;" data-html="Send" data-auto-test-id="submitButton" id="bb2"><?php echo  $mainTex ;?></button>
          <div id="msg_alert"></div>
        
        </div>
           </div>
      </div>
                           <?php $this->endWidget(); ?>
                        </div>
                     </div>
                  </div>
               </div>
			   <div class="clearfx"></div>
         
 
