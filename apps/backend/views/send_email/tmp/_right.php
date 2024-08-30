  <!-- /.col -->
        <div class="col-md-9">
			<?php
			  $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus)	,
        
        'action' => ($model->status=='S')? Yii::app()->createUrl('send_email/create'):'',
         'enableClientValidation' => true,
					'clientOptions' => array(
					'validateOnSubmit' => true,
					
					'afterValidate' => 'js:function(form, data, hasError) { 
					if(hasError) {
						 form.find("button.btn-submit").button("reset");
						var focus = false;
						for(var i in data){ if(!focus){$("#"+i).focus() ; focus =true; }  $("#"+i).addClass("error") } ;
					 
						return false;			
					}
					else{
					form.find("button.btn-submit").button("reset");
					form.submit();
					return true; 
				}
					
					}'
					 )));  ?> 
          <div class="box box-primary">
            <div class="box-header with-border">
				 <div class="pull-left">
					<h3 class="box-title">
						<span class="glyphicon glyphicon-text-width"></span> <?php echo $pageHeading;?>
					</h3>
				</div>
				<div class="pull-right">
					<?php echo CHtml::link(Yii::t('app', 'Compose Mail'), array('send_email/mail'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Compose New Email')));?>
				</div>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            
							<?php  $this->renderPartial('_form',compact('form','model'));?>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
				<?php
				if($model->isNewRecord){ ?> 
				<button type="submit" class="btn btn-default  btn-submit" name="draft" onClick="$('#Email_status').val('D')" ><i class="fa fa-pencil"></i> Draft</button>
				<?php } ?> 
                <button type="submit" class="btn btn-primary btn-submit" name="send" onClick="$('#Email_status').val('Q')"><i class="fa fa-envelope-o"></i> <?php echo ($model->status=='S')? 'Resend' : 'Add to Mail Queue' ;?></button>
              </div>
              <div class="clearfix"><!-- --></div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
          <?php $this->ebdWidget();?>
        </div>
       <script> 
       function ChangeContent(k){
				 
					$.get('<?php echo Yii::app()->createUrl('send_email/template');?>/template_id/'+$(k).val(),function(data){ CKEDITOR.instances.Email_message.setData(  data ) })
					}  
       </script>
        <!-- /.col -->
      
