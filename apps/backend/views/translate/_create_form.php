					<?php 
					 
					$form = $this->beginWidget('CActiveForm',array( 
					 'id'=>'ewrwerwer',
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
					else
					{ 
					if (!allowSubmit) return false;
						allowSubmit = false;
						setTimeout(function(){  allowSubmit = true; }, 5000);  
						saveFormFunction_grid_update(form, data, hasError);

					}
					}'
				
				))); 
				?>
				<div class="messageDiv"></div>
				<div class="box-body"> 
				
				 
				<?php echo $form->hiddenField($model, 'lan' ); ?>
				<?php echo $form->hiddenField($model, 'source_tag' ); ?>
				<?php echo $form->error($model, 'lan');?>
				<?php echo $form->error($model, 'source_tag');?>
                <div class="clearfix"><!-- --></div>  
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'translation');?>
                    <?php echo $form->textArea($model, 'translation', $model->getHtmlOptions('translation',array('dir'=>in_array(Yii::app()->request->getQuery('lan','ar'),OptionCommon::rtlLanguages()) ? 'rtl' : 'ltr' ,'style'=>(Yii::app()->request->getQuery('disableEditer','0') =='1')? '' : 'color:#fff;border:0px;'))); ?>
                    <?php echo $form->error($model, 'translation');?>
                </div>  
				<div class="clearfix"><!-- --></div> 
				</div>
				<div class="box-footer " style="display:none;">
				<div class="pull-right">
				<button type="submit" id="SubmitClick" class="btn btn-primary btn-submit"   data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" ><?php echo Yii::t('app', 'Save changes');?></button>
				</div>
				<div class="clearfix"><!-- --></div>
				</div>
				<?php $this->endWidget();?> 
 
