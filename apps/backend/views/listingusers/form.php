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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($user,'hotel_name'))); 
        ?>
        <style>label{ display:block; }</style>
                  <link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.css');?>">
                          <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js');?>"></script>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), Yii::app()->createUrl($this->id.'/create/type/'.$user->user_type), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), Yii::app()->createUrl($this->id.'/'.$index.'/type/'.$user->user_type), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                <div class="clearfix"><!-- --></div>
                
                <?php  if(AccessHelper::hasRouteAccess ('listingusers/settings_panel')){ ?> 
                <div class="col-sm-12">
                <div class="box box-danger">
           
            <div class="box-body">
              <div class="row">
                    <div class="form-group col-sm-2 hide">
							<?php echo $form->labelEx($user, 'super_user');?>
							<?php echo $form->dropDownList($user, 'super_user', array(''=>'No','1'=>'Yes'), $user->getHtmlOptions('super_user')); ?>
							<?php echo $form->error($user, 'super_user');?>
							</div> 
							<div class="form-group col-sm-2 hide">
							<?php echo $form->labelEx($user, 'premium');?>
							<?php echo $form->dropDownList($user, 'premium',array('0'=>'No','1'=>'Yes'), $user->getHtmlOptions('premium')); ?>
							<?php echo $form->error($user, 'premium');?>
							</div> 
                <div class="form-group col-sm-2">
							<?php echo $form->labelEx($user, 'status');?>
							<?php echo $form->dropDownList($user, 'status', $user->activeArray(), $user->getHtmlOptions('status')); ?>
							<?php echo $form->error($user, 'status');?>
							</div> 
							
								<div class="form-group col-sm-2">
							<?php echo $form->labelEx($user, 'email_verified');?> 
							<?php echo $form->dropDownList($user, 'email_verified', array('0'=>'No','1'=>'Yes'), $user->getHtmlOptions('email_verified')); ?>
						
							<?php echo $form->error($user, 'email_verified');?>
							</div>
							
							<div class="form-group col-sm-2">
							<?php echo $form->labelEx($user, 'is_verified');?>
							<?php echo $form->dropDownList($user, 'is_verified',array(''=>'No','1'=>'Yes'), $user->getHtmlOptions('is_verified')); ?>
							<?php echo $form->error($user, 'is_verified');?>
							</div> 
							<div class="form-group col-sm-2">
							<?php echo $form->labelEx($user, 'featured');?>
							<?php echo $form->dropDownList($user, 'featured', $user->featuredArray(), $user->getHtmlOptions('featured')); ?>
							<?php echo $form->error($user, 'featured');?>
							</div> 
							<div class="form-group col-sm-2 hide">
							<?php echo $form->labelEx($user, 'o_verified');?>
							<?php echo $form->dropDownList($user, 'o_verified', array('0'=>'No','1'=>'Yes'), $user->getHtmlOptions('o_verified')); ?>
							<?php echo $form->error($user, 'o_verified');?>
							</div>
							<div class="form-group col-sm-3">
							<?php echo $form->labelEx($user, 'enable_l_f');?>
							<?php echo $form->dropDownList($user, 'enable_l_f', array('0'=>'No','1'=>'Yes'), $user->getHtmlOptions('enable_l_f')); ?>
							<?php echo $form->error($user, 'enable_l_f');?>
							</div>
                            <?php
                            if(Yii::app()->user->getModel()->removable=='no'){ 
                            $criteria=new CDbCriteria;
                            $criteria->compare('t.group_id', User::SALES_TEAM);
                            $sales_team = User::model()->findAll($criteria);
                            
                            ?> 
							<div class="form-group col-sm-3">
							<?php echo $form->labelEx($user, 'created_by');?>
							<?php echo $form->dropDownList($user, 'created_by', CHtml::listData($sales_team,'user_id','fullName'), $user->getHtmlOptions('created_by',array('empty'=>'Please Select'))); ?>
							<?php echo $form->error($user, 'created_by');?>
							</div>
							
							<div class="form-group col-sm-3">
							<?php echo $form->labelEx($user, 'pf_id');?>
							<?php echo $form->textField($user, 'pf_id' , $user->getHtmlOptions('pf_id')); ?>
							<?php echo $form->error($user, 'pf_id');?>
							</div>
								<div class="form-group col-sm-2">
							<?php echo $form->labelEx($user, 'by_id');?>
							<?php echo $form->textField($user, 'by_id' , $user->getHtmlOptions('by_id')); ?>
							<?php echo $form->error($user, 'by_id');?>
							</div>
							<?php } ?>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
					</div>	    
			  <?php } ?> 
                <script>
                function hideloginIf(k){
					if($(k).is(':checked')){
						$('.loginf').addClass('hide');
						$('.loginf').find('input').val('');
					}
					else{
						$('.loginf').removeClass('hide');
					}
				}
                </script>
                <div class="form-group col-lg-9">
                  <div class="clearfix"></div>
                  	<div class="form-group col-sm-6" hint="">
		 
		 
			<?php echo $form->labelEx($user, 'user_type');
			$user_type_array = $user->getUserType();
			if(!Yii::App()->request->isPostRequest and empty($user->user_type)){$user->user_type = 'U';}
			echo $form->dropDownList($user , 'user_type',$user_type_array ,  array_merge($user->getHtmlOptions('user_type'),array("empty"=>"Signing up as*" ,'class'=>'select2','onchange'=>'selectDetailFields(this)'))); 
			?>
			
			<?php echo $form->error($user, 'user_type');?>
			<div class="clear"></div>
	</div>
	
                   <div class="clearfix"><!-- --></div>
						    
							<?php
							/*
							if(  $user->user_type != 'U') { ?> 
							<div class="form-group col-sm-6">
							 <?php echo $form->labelEx($user, 'log_not');?>
							<?php echo $form->checkbox($user, 'log_not', $user->getHtmlOptions('log_not',array('value'=>'1','uncheckvalue'=>'','style'=>'width:auto;',  'onchange'=>'hideloginIf(this)' ))); ?>
							<?php echo $form->error($user, 'log_not');?>
							</div> 
							<?php 
							    
							    
							} */ ?> 
						    <div class="clearfix"><!-- --></div>
	    			    
						    
						    
							<div class="loginf <?php echo  $user->log_not=="1" ? 'hide' : '';?>">
							<div class="form-group col-sm-6">
							 <?php echo CHtml::activeLabel($user, 'email', array('required' => true));?>
							<?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
							<?php echo $form->error($user, 'email');?>
							</div> 
						    
						 
							<div class="form-group col-sm-3">
							 <?php if($user->isNewRecord){ echo CHtml::activeLabel($user, 'password', array('required' => true)); }else{ echo $form->labelEx($user, 'password'); }  ?> 
							<?php echo $form->passwordField($user, 'password', $user->getHtmlOptions('password')); ?>
							<?php echo $form->error($user, 'password');?>
							</div> 
							<div class="form-group col-sm-3">
						    <?php if($user->isNewRecord){ echo CHtml::activeLabel($user, 'con_password', array('required' => true)); }else{ echo $form->labelEx($user, 'con_password'); }  ?>
							<?php echo $form->passwordField($user, 'con_password', $user->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($user, 'con_password');?>
							</div> 
							</div>
					<div class="clearfix"><!-- --></div>  
				 
                  <div class="clearfix"></div>
	<div class="clearfix"></div>
		<div class="form-group col-sm-6 spllabel" hint="">
		<?php echo $form->labelEx($user, 'first_name');?>(English)
		<?php 
		echo $form->textField($user , 'first_name', array_merge($user->getHtmlOptions('first_name'),array("placeholder"=>"First Name*" ,'class'=>'form-control'))); 
		?>
		 
		<?php echo $form->error($user, 'first_name');?>
		<div class="clearfix"></div>
		</div>			
         	
         		<div class="form-group col-sm-6 spllabel" hint="">
		<?php echo $form->labelEx($user, 'first_name_ar');?>(Arabic)
		  <div class="clearfix"></div>
		<?php 
		echo $form->textField($user , 'first_name_ar', array_merge($user->getHtmlOptions('first_name_ar'),array("placeholder"=>"First Name*" ,'class'=>'form-control'))); 
		?>
		 
		<?php echo $form->error($user, 'first_name_ar');?>
		<div class="clearfix"></div>
		</div>			
         
         	 <div class="clearfix"></div>
	 <div class="openWhenUserType <?php if(!in_array($user->user_type,array('A','C','D','M'))){ echo 'hide';  };?>">
					<div class="form-group col-sm-6 spllabel" hint="">
			 <style>.spllabel label{ display:inline-block; } </style>
			 <?php echo $form->labelEx($user, 'company_name');  ?>(English)
			<div class="clearfix"></div>
			<? echo $form->textField($user, 'company_name', $user->getHtmlOptions('company_name')); ?>
			 
			<?php echo $form->error($user, 'company_name');?>
			</div> 
			
			<div class="form-group col-sm-6 spllabel" hint="">
			 <style>.spllabel label{ display:inline-block; } </style>
			 <?php echo $form->labelEx($user, 'company_name_ar');  ?>(Arabic)
			<div class="clearfix"></div>
			<? echo $form->textField($user, 'company_name_ar', $user->getHtmlOptions('company_name_ar',array('dir'=>'auto'))); ?>
			 
			<?php echo $form->error($user, 'company_name_ar');?>
			</div> 
			
				  
					<div class="form-group  col-sm-6 spllabel">
					<?php echo $form->labelEx($user, 'address');  ?>(English)
					<div class="clearfix"></div>
					<? echo $form->textField($user, 'address', $user->getHtmlOptions('address' )); ?>

					<?php echo $form->error($user, 'address');?>
					</div> 
					<div class="form-group  col-sm-6 spllabel">
					<?php echo $form->labelEx($user, 'address_ar');  ?>(Arabic)
					<div class="clearfix"></div>
					<? echo $form->textField($user, 'address_ar', $user->getHtmlOptions('address_ar',array('dir'=>'auto') )); ?>

					<?php echo $form->error($user, 'address_ar');?>
					</div> 
					
					
				 		<div class="clearfix"></div>
		 	<div class="clearfix"></div> 
	 
		<div class="form-group col-sm-6 spllabel" hint="">
		    
		    <?php
		    if(!Yii::app()->request->isPostRequest){
		        $user->phone = !empty($user->full_number) ? $user->full_number : $user->phone ; 
		    } ?> 
			<?php echo $form->labelEx($user, 'phone');?><div class="pull-right"><?php echo $form->checkbox($user, 's_w',array('onchange'=>'hidewhtsapp(this)','style'=>'width:auto;'));?> <?php echo $form->labelEx($user, 's_w');?></div>
			<div class="clearfix"></div>
			<?php 
			echo $form->textField($user , 'phone', array_merge($user->getHtmlOptions('phone'),array("placeholder"=>"" ,'class'=>'form-control', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); 
			?>
			 
			<?php echo $form->error($user, 'phone');?>
			<div class="clear"></div>
	</div>
	
	 	<div class="clearfix"></div> 
								<div class="form-group  col-sm-6  <?php echo !empty($user->s_w) ? 'hide' : '';?> " id="hdwtsapp">

						   <?php
		    if(!Yii::app()->request->isPostRequest){
		        $user->whatsapp_false = !empty($user->whatsapp) ? $user->whatsapp : $user->whatsapp_false ; 
		    } ?> 

							<?php echo $form->labelEx($user, 'whatsapp');?>

							<?php  	echo $form->textField($user , 'whatsapp_false' ,  $user->getHtmlOptions('whatsapp_false',array('class'=>'input-text form-control form_have_placeholder','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php echo $form->error($user, 'whatsapp');?>

							 
		</div> 
	<div class="clearfix"></div> 

		
		<div class="clearfix"></div>	
	 
	  			<div class="form-group col-sm-12 spllabel" hint="">
			 
			<?php
		  	 echo $form->labelEx($user, 'description');  
			?><div class="clearfix"></div><?
			 echo $form->textArea($user, 'description', $user->getHtmlOptions('description',array('class'=>'form-control', ))); ?>
			 
			<?php echo $form->error($user, 'description');?>
			</div> 
			 
					
					<div class="form-group col-sm-12 spllabel" hint="">
			 
			<?php  echo $form->labelEx($user, 'description_ar');   ?>(Arabic)<div class="clearfix"></div><?
			 echo $form->textArea($user, 'description_ar', $user->getHtmlOptions('description_ar',array('class'=>'form-control', ))); ?>
			 
			<?php echo $form->error($user, 'description_ar');?>
			</div> 
			
	  	</div>	
					<div class="clearfix"></div>
				
				 
				 <div class="clearfix"></div>
			<div class="form-group  col-sm-6">
							 
							<?php
							 echo $form->labelEx($user, 'contact_person');   
							 echo $form->textField($user, 'contact_person', $user->getHtmlOptions('form-control',array())); ?>
							 
							<?php echo $form->error($user, 'contact_person');?>
							</div> 
			<div class="form-group  col-sm-6">
							 
							<?php
							 echo $form->labelEx($user, 'contact_email');   
							 echo $form->textField($user, 'contact_email', $user->getHtmlOptions('form-control',array())); ?>
							 
							<?php echo $form->error($user, 'contact_email');?>
							</div> 
				 <div class="clearfix"></div>
		
							<div class="clearfix">
								<div class="form-group col-sm-3">
							<?php echo $form->labelEx($user, 'zip');?>
							<?php echo $form->textField($user, 'zip', $user->getHtmlOptions('zip')); ?>
							<?php echo $form->error($user, 'zip');?>
							</div> 
							<div class="form-group col-sm-3">
							<?php echo $form->labelEx($user, 'fax');?>
							<?php echo $form->textField($user, 'fax', $user->getHtmlOptions('fax')); ?>
							<?php echo $form->error($user, 'fax');?>
							</div> 
							<div class="form-group col-sm-3">
								<?php echo $form->labelEx($user, 'webstie');?>
								<?php echo $form->textField($user, 'website', $user->getHtmlOptions('webiste')); ?>
								<?php echo $form->error($user, 'website');?>
								</div> 
									<div class="form-group col-sm-3" hint="">
			<?php echo $form->labelEx($user, 'mobile');?>
			<?php 
			echo $form->textField($user , 'mobile', array_merge($user->getHtmlOptions('mobile'),array("placeholder"=>"" ,'class'=>'form-control'))); 
			?>
			 
			<?php echo $form->error($user, 'mobile');?>
			<div class="clear"></div>
	</div>
							</div>
							

							<div class="clearfix"></div>
							
		<div class="">
		<?php
		if(!Yii::App()->request->isPostRequest and empty($user->country_id) ){ }?> 
		<div class="form-group  col-sm-6    " hint="">
		<?php echo $form->labelEx($user, 'country_id');?>
		<?php
		echo $form->dropDownList($user,'country_id',Countries::model()->ListData(),array("class"=>"select2", "empty"=>"Select County*",'data-url'=>Yii::App()->createUrl('place_property/select_city_new'),'onchange'=>'load_via_ajax2(this,"state_id")')); 
		?>
		 
		<?php echo $form->error($user, 'country_id');?>
		<div class="clear"></div>
		</div>
		<?php
		       $cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $user->country_id) ,'state_id' , 'state_name') ;
             ?>
		<div class="form-group  col-sm-6  " hint="">
		<?php echo $form->labelEx($user, 'state_id'); 
		 
		echo $form->dropDownList($user,'state_id',   $cities ,array("class"=>"select2", "empty"=>"Select Region*","style"=>";")); 
		?>
		 
		<?php echo $form->error($user, 'state_id');?>
		<div class="clear"></div>
		</div>
</div>
	<div class="clearfix"></div>

					<div class="form-group col-sm-12 service_offerng <?php echo $user->user_type=='D' ? 'hidden' : '';?> ">
					<?php    echo $form->labelEx($user, 'service_offerng');?> 
					<?php
					if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->service_offerng = CHtml::listData($user->moreSection,'section_id','section_id');
						 
					}
					$datas = CHtml::listData(Section::model()->listData(),'section_id','section_name') ;
					unset($datas['3']);
					unset($datas['4']);
					?>
					<?php echo $form->dropDownList($user, 'service_offerng', $datas , $user->getHtmlOptions('service_offerng',array( 'data-placeholder'=>'Choose services', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
					<?php echo $form->error($user, 'service_offerng');?>
					</div>
					
					
				<div class="form-group  col-sm-6" hint="">
					 
					<?php
					if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->service_offerng_detail = CHtml::listData($user->moreCategory,'category_id','category_id');
						//print_r(	$user->service_offerng_detail);
						 
					}
					$datas = CHtml::listData(Category::model()->listData(),'category_id','category_name') ;
					?>
					 
					<?php
					 echo $form->labelEx($user, 'service_offerng_detail');
					 echo $form->dropDownList($user, 'service_offerng_detail', $datas , $user->getHtmlOptions('service_offerng_detail',array( 'data-placeholder'=>'Select your Service Categories', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
				 
					<?php echo $form->error($user, 'service_offerng_detail');?>
					</div>
					
					 
					      <div class="form-group  col-sm-6"> 
				 
					 
						<?php 
						if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->mul_state_id = CHtml::listData($user->moreState,'state_id','state_id');
						 
					}
						 echo $form->labelEx($user, 'mul_state_id');
						echo $form->dropDownList($user, 'mul_state_id', CHtml::listData(States::model()->AllListingStatesOfCountry($user->country_id),'state_id' , 'state_name') , $user->getHtmlOptions('mul_state_id',array(  'class'=>'select2' ,'style'=>'width:100%;'	,'multiple'=>true	,'data-placeholder'=>'Select Service Areas'	)			)); ?>
				
				 
					
					<?php echo $form->error($user, 'mul_state_id');?>
					</div>
					<div class="clearfix"></div>
						<div class="clearfix"></div>
						<div class="col-sm-12">
		<h3 style="margin-top:0px;font-size:16px;font-weight:bold;">Reference</h3>
		<hr style="margin-top:5px;margin-bottom:10px;"/>
		<div class="clearfix"></div>
		<div class="row">
		   <div class="form-group col-sm-4">
							<?php echo $form->labelEx($user, 's_channel');?>
							<?php echo $form->dropDownList($user, 's_channel', CHtml::listData(Master::model()->listData(Master::SALES_CHANNEL),'master_id','master_name'), $user->getHtmlOptions('s_channel',array('empty'=>'Please Select'))); ?>
							<?php echo $form->error($user, 's_channel');?>
							</div> 
		<link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css');?>" />
		   <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($user, 'refered_by');?>
                            <?php echo $form->hiddenField($user, 'refered_by', $user->getHtmlOptions('refered_by')); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                                'name'          => 'customer',
                                'value'         => !empty($user->refered_by) ? $user->referer->getFullName() : '',
                                'source'        => $this->createUrl('listingusers/autocomplete',array('onlybroker'=>'1')),
                                'cssFile'       => false,
                                'options'       => array(
                                    'minLength' => '2',
                                    'select'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($user, 'refered_by').'").val(ui.item.customer_id);
                            }',
                                    'search'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($user, 'refered_by').'").val("");
                            }',
                                    'change'    => 'js:function(event, ui) {
                                if (!ui.item) {
                                    $("#'.CHtml::activeId($user, 'refered_by').'").val("");
                                }
                            }',
                                ),
                                'htmlOptions'   => $user->getHtmlOptions('refered_by'),
                            ));
                            ?>
                            <?php echo $form->error($user, 'refered_by');?>
                        </div>
                    </div>
                 
		
		</div>					
		<div class="clearfix"></div>
		</div>
					<div class="clearfix"></div>
					<?php
					   
					if(!$user->isNewRecord and in_array($user->user_type,array('C','D','M')) and AccessHelper::hasRouteAccess ('listingusers/settings_panel')) { ?> 
									<div class="col-sm-12">
		<h3 style="margin-top:0px;font-size:16px;font-weight:bold;">How many agents can add maximum ?</h3>
		<hr style="margin-top:5px;margin-bottom:10px;"/>
		<div class="clearfix"></div>
		<div class="row">
		   <div class="form-group col-sm-4">
							<?php echo $form->labelEx($user, 'max_no_users');?>
							<?php echo $form->textField($user, 'max_no_users'  , $user->getHtmlOptions('max_no_users' )); ?>
							<?php echo $form->error($user, 'max_no_users');?>
							</div> 
							</div> </div> 
				
				   <?php } ?> 
					<div class="clearfix"></div>
					<?php
					if(AccessHelper::hasRouteAccess ('listingusers/settings_panel')){ ?> 
							<div class="col-sm-12 ">
								 
		<h3 style="margin-top:0px;font-size:16px;font-weight:bold;">Verification Code</h3>
		<hr style="margin-top:5px;margin-bottom:10px;"/>
								<div class="row">
							    <div class="form-group col-sm-4">
                                    <label>(Email - Latest)</label>
                                    <?php echo $form->textField($user, 'verification_code', $user->getHtmlOptions('verification_code')); ?>
							       </div>
							        <div class="form-group col-sm-4">
                                   <label> (Phone - Latest)</label>
                                    <?php echo $form->textField($user, 'otp', $user->getHtmlOptions('otp')); ?>
							       </div>
							       </div>   
							</div>
					 		
					 		<?php } ?> 
					 		<div class="clearfix"></div>
					<?php
					if(AccessHelper::hasRouteAccess ('listingusers/settings_panel')){ ?> 
							<div class="col-sm-12 ">
								 
		<h3 style="margin-top:0px;font-size:16px;font-weight:bold;">Sub User</h3>
		<hr style="margin-top:5px;margin-bottom:10px;"/>
								<div class="row">
							 
							 	<div class="form-group col-sm-3">
										<?php 
									 
										echo $form->labelEx($user, 'user_status');?>
										<?php echo $form->dropDownList($user, 'user_status', $user->user_status(),$user->getHtmlOptions('user_status',array('empty'=>'Please Select'))); ?>
										<?php echo $form->error($user, 'user_status');?>
										</div> 
										  <div class="form-group col-sm-6">
												 
										<?php echo $form->labelEx($user, 'parent_user');?>
 
										<?php echo $form->dropDownList($user, 'parent_user', CHtml::listData(ListingUsers::model()->findAllByPk($user->parent_user),'user_id','fullName') , $user->getHtmlOptions('parent_user') ); ?>
										<?php echo $form->error($user, 'parent_user');?>
									</div>
							 
							   </div>   
							</div>
					 		
					 		<?php } ?> 
					 		<div class="clearfix"></div>
					 		<?php
					 		if($user->premium=='1') { ?> 
				 <div class="form-group  col-md-12 col-sm-12">
					
					<h3 class="page-heading">Premium User Page Details</h3>
					</div>
						<style>
						#div_view_company_profile img ,#div_view_banner_image img , #div_view_banner_image_mobile img { width:100px !important; height:100px !important; }
	 
						</style>
						<?php 
						if(!$model->isNewRecord){ ?> 
					<div class="col-sm-12 form-group">
						<a href="<?php echo Yii::app()->createUrl('developer_gallery/create',array('user_id'=>$user->user_id));?>" class="btn btn-warning">Create Gallery</a>
						<a href="<?php echo Yii::app()->createUrl('developer_gallery/index',array('user_id'=>$user->user_id));?>" class="btn btn-warning">List Gallery</a>
						</div>
						<?php } ?> 
					 <div class="form-group  col-md-4 col-sm-4">
							 <?php  
							 $fileField = 'banner_image';
							 $types = '.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							 $model = $user;
							  $this->renderPartial('_file_field_browse2',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
						</div>
					 <div class="form-group  col-md-4 col-sm-4">
							 <?php  
							 $fileField = 'banner_image_mobile';
							 $types = '.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							 $model = $user;
							  $this->renderPartial('_file_field_browse3',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
						</div>
						 <div class="form-group  col-md-4 col-sm-4">
							 <?php  
							 $fileField = 'company_profile';
							 $types = '.pdf';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							 $model = $user;
							  $this->renderPartial('_file_field_browse4',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
						</div>
							<div class="form-group col-sm-12" hint="">
			 
			<?php
		  	 echo $form->labelEx($user, 'iframe_map'); 
			 echo $form->textArea($user, 'iframe_map', $user->getHtmlOptions('iframe_map',array('class'=>'form-control','rows'=>'6' ))); ?>
			 
			<?php echo $form->error($user, 'iframe_map');?>
			</div> 
		
						
							<div class="form-group col-sm-12" hint="">
			 
			<?php
		  	 echo $form->labelEx($user, 'cover_letter'); 
			 echo $form->textArea($user, 'cover_letter', $user->getHtmlOptions('cover_letter',array('class'=>'form-control','rows'=>'6' ))); ?>
			 
			<?php echo $form->error($user, 'cover_letter');?>
			</div> 
				<div class="form-group col-sm-12">
							 <?php echo $form->labelEx($user, 'e_h_t');?>
							<?php echo $form->textField($user, 'e_h_t', $user->getHtmlOptions('e_h_t',array('placeholder'=>'Default - Explore {b} Our Projects'))); ?>
							<?php echo $form->error($user, 'e_h_t');?>
							</div>
		<div class="form-group col-sm-12">
							 <?php echo $form->labelEx($user, 'explore_title');?>
							<?php echo $form->textArea($user, 'explore_title', $user->getHtmlOptions('explore_title')); ?>
							<?php echo $form->error($user, 'explore_title');?>
							</div> 
								<div class="form-group col-sm-12">
							 <?php echo $form->labelEx($user, 'v_a_ti');?>
							<?php echo $form->textField($user, 'v_a_ti', $user->getHtmlOptions('v_a_ti',array('placeholder'=>'Default - View All Projects'))); ?>
							<?php echo $form->error($user, 'v_a_ti');?>
							</div>
							<div class="form-group col-sm-12">
							<?php echo $form->labelEx($user, 'l_h_t');?>
							<?php echo $form->textField($user, 'l_h_t', $user->getHtmlOptions('l_h_t',array('placeholder'=>'Default - Latest Projects'))); ?>
							<?php echo $form->error($user, 'l_h_t');?>
							</div>
								<div class="form-group col-sm-12">
							<?php echo $form->labelEx($user, 'p_he');?>
							<?php echo $form->textField($user, 'p_he', $user->getHtmlOptions('p_he',array('placeholder'=>'Default -  Projects'))); ?>
							<?php echo $form->error($user, 'p_he');?>
							</div>
							<div class="form-group col-sm-12">
							 <?php echo $form->labelEx($user, 'youtube');?>
							<?php echo $form->textField($user, 'youtube', $user->getHtmlOptions('youtube')); ?>
							<?php echo $form->error($user, 'youtube');?>
							</div> 
							<hr>
							<h4>Whatsapp Contact</h4>
							<hr>
							<div class="form-group col-sm-6">
							 <?php echo $form->labelEx($user, 'whatsapp_c_name');?>
							<?php echo $form->textField($user, 'whatsapp_c_name', $user->getHtmlOptions('whatsapp_c_name')); ?>
							<?php echo $form->error($user, 'whatsapp_c_name');?>
							</div> 
							<div class="form-group col-sm-6">
								<style>
								#div_view_whatsapp_c_image img { width:100px !important; }
								</style>
							 <?php  
							 $fileField = 'whatsapp_c_image';
							 $types = '.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							 $model = $user;
							  $this->renderPartial('_file_field_browse3',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
							</div> 
		
			<div class="form-group col-sm-6">
							 <?php echo $form->labelEx($user, 'whatsapp_c_text');?>
							<?php echo $form->textField($user, 'whatsapp_c_text', $user->getHtmlOptions('whatsapp_c_text',array('placeholder'=>'Project? Let\'s discuss!'))); ?>
							<?php echo $form->error($user, 'whatsapp_c_text');?>
							</div> 
								<div class="form-group col-sm-6">
							 <?php echo $form->labelEx($user, 'whatsapp_c_link');?>
							<?php echo $form->textField($user, 'whatsapp_c_link', $user->getHtmlOptions('whatsapp_c_link')); ?>
							<?php echo $form->error($user, 'whatsapp_c_link');?>
							</div> 
							<?php } ?> 
		
		
	
		
		</div>	
		 <div class="form-group col-lg-3 spl-right-side">
			 	<style>
					.spl-right-side .col-sm-5,	.spl-right-side .col-sm-7{ width:100% !important}
					 .spl-right-side .col-sm-7  label{ display:none; }
					 .spl-right-side .col-sm-5  .bg-warning {background-color: #ddd; margin-bottom:5px;; }
								 .browse_type   .upload-btn-wrapper .btn {   height: 62px !important; width:150px !important; background: #fff;color: var(--logo-color);border-color: var(--logo-color);}
								 .browse_type  .upload-btn-wrapper .btn i  { margin-bottom:5px !important;}
								 .browse_type    .property_img_overlay {     top: 15px;    width: 100%;    z-index: 111;    left: 0px;    right: 0px;}
								 .browse_type    .property_img_overlay  .btn{    padding: 5px;    width: 87%; }
								 .browse_type .dropzone { width:150px !important; }
								 .browse_type .dropzone .dz-message .upload-btn-wrapper {   max-width: unset; }
								.property_img_box {    width: 57px !important;    height: 57px !important;    display: inline-block;    overflow: hidden; float:left !important;}
								html  div.property_img_box div.property_img{    width: 100% !important;    height: 100% !important; display: flex; line-height: 1 !important;   }
								html .property_img_box .property_img img{    width: 100% !important;   }
								</style>
				 <div class="form-group margin-bottom-0 ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'image';
										$title_text = 'Add / Change  Photo';
										$types = '.png,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_image"><?php echo $user->getAttributeLabel('image');?>  </label>
							<div class="clearfix"></div>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;">Allowed:<br /><?php echo $types;?></div>
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
							?>
						 

							</div>

							</div>
			 	<div class="clearfix"><!-- --></div>	
			 	</div>	
			 	<?php
							if($user->user_type == 'P'){ ?> 
							
						 <div class="clearfix"></div>
							<div class="form-group margin-bottom-0 ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'property_t';
										$title_text = 'Upload';
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_property_t" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('property_t');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;">Allowed:<br /><?php echo $types;?></div>
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
							?>
						 

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
						 <div class="clearfix"></div>
							<div class="form-group margin-bottom-0 ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'property_a';
										$title_text = 'Upload';
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_property_a" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('property_a');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;">Allowed:<br /><?php echo $types;?></div>
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
							?>
						 

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
							<?php } ?> 
							
							
			 	<?php
							if(in_array($user->user_type,array('A','C','D','M')) and empty($user->parent_user)){ ?> 
									<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_a_chara_ar" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('a_chara_ar');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">
							 
							<?php  	echo $form->dropdownList($user , 'a_chara_ar' , $user->arabic_characters_array(), $user->getHtmlOptions('a_chara_ar',array('class'=>'input-text form-control','empty'=>'Please Select' )));  ?>
 
 
							<?php echo $form->error($user, 'a_chara_ar');?>
							 

							</div>

							</div>
		</div> 
		
								 <div class="clearfix"></div>
								 	<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_a_number" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('a_number');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($user , 'a_number' ,  $user->getHtmlOptions('a_number',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'a_number');?>
							 

							</div>

							</div>
		</div> 
		
								 <div class="clearfix"></div>
						 			<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_licence_no" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('licence_no');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($user , 'licence_no' ,  $user->getHtmlOptions('licence_no',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'licence_no');?>
							 

							</div>

							</div>
		</div> 
		
						 <div class="clearfix"></div>
						 <div class="clearfix"></div>
						 			<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_cr_number" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('cr_number');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($user , 'cr_number' ,  $user->getHtmlOptions('cr_number',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'cr_number');?>
							 

							</div>

							</div>
		</div> 
		
						 <div class="clearfix"></div>
							<div class="form-group margin-bottom-0 ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'u_crdoc';
										$title_text = 'Upload';
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_u_crdoc" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('u_crdoc');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;">Allowed:<br /><?php echo $types;?></div>
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
							?>
						 

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
					 		<div class="clearfix"></div>
							<?php } ?> 
				
			 	<div class="col-md-12 col-sm-12">
							 <?php  
							 $fileField = 'cover_image';
							 $types = '.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							 $model = $user;
					 	  $this->renderPartial('_file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
						</div>
					
		</div>		 				
	
						
						    
						  
						  
						   
					<div class="clearfix"><!-- --></div>
                
                <div class="clearfix"><!-- --></div>     
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
                <div class="clearfix"><!-- --></div>
            </div>
         <div class="clearfix"></div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" style="color:#fff !important"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
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
<script>
	 
	var cityBaseUrl  = '<?php echo Yii::app()->createUrl('agents/loadCity');?>';
	var areaBaseUrl  = '<?php echo Yii::app()->createUrl('agents/loadArea');?>';
	var modelName = '<?php echo $user->modelName;?>';
$(function(){
		 $('#'+modelName+'_mul_country_id').select2();
		 $('#'+modelName+'_service_offerng').select2();
		 $('#'+modelName+'_service_offerng_detail').select2();
		 $('#'+modelName+'_mul_country_id').select2();
		 $('#'+modelName+'_languages_known').select2();
		 $('#'+modelName+'_country_id').select2();
		 $('#'+modelName+'_designation_id').select2();
		 $('#'+modelName+'_state_id').select2();
		 $('#'+modelName+'_user_type').select2();
		 //$('#'+modelName+'_mul_state_id').select2();
	 	 
		 
	})
	var countryVal = $('#'+modelName+'_mul_country_id').val();
	var countryVal2 = $('#'+modelName+'_country_id').val();
	var cityInput =  modelName+'_mul_state_id';
	var cityVal = $('#'+modelName+'_mul_state_id').val();	 
	var  cityAjaxUrl = cityBaseUrl+'/country_id/'+countryVal+'city_id/'+cityVal;
	
	var  stateAjaxUrl = areaBaseUrl+'/country_id/'+countryVal2 ;
	
	var cityInput;
	var newCropUrl = '<?php echo Yii::app()->createUrl('developers/image_crop');?>'
	function cityData(){
  
		    $("#"+cityInput).select2({
			    multiple: true,
			  ajax: {
		url: function () {

									return changeAllNameRelated();
								},
				
			  dataType: 'json',
			  delay: 250,
			  data: function (params) {
			  return {
				q: params.term, // search term
				page: params.page
			  };
			},
			processResults: function (data, params) {
			  // parse the results into the format expected by Select2
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data, except to indicate that infinite
			  // scrolling can be used
			  params.page = params.page || 1;
			  return {
				results: data.items,
				pagination: {
				  more: (params.page * 30) < data.total_count
				}
			  };
			},
			cache: true
		  },
		  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  minimumInputLength: 0,
		  //templateResult: formatRepo, // omitted for brevity, see the source of this page
		  //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
		});
	}
	function regionData(){
  
		    $('#'+modelName+'_mul_state_id').select2({
			    multiple: true,
			  ajax: {
		url: function () {

									return changeAllNameRelated2();
								},
				
			  dataType: 'json',
			  delay: 250,
			  data: function (params) {
			  return {
				q: params.term, // search term
				page: params.page
			  };
			},
			processResults: function (data, params) {
			  // parse the results into the format expected by Select2
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data, except to indicate that infinite
			  // scrolling can be used
			  params.page = params.page || 1;
			  return {
				results: data.items,
				pagination: {
				  more: (params.page * 30) < data.total_count
				}
			  };
			},
			cache: true
		  },
		  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  minimumInputLength: 0,
		  //templateResult: formatRepo, // omitted for brevity, see the source of this page
		  //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
		});
	}
	$(function(){
		//  $('#'+modelName+'_mul_country_id').select2();
	 	// cityData();
		 regionData()
	})
	function loadCities(k){
			var Cit = $('#'+modelName+'_mul_state_id').val() ;
			cityAjaxUrl = cityBaseUrl+'/country_id/'+$(k).val()+'/city_id/'+Cit;
			
		}
function changeAllNameRelated(){
	 
	return  cityAjaxUrl;
}
function changeAllNameRelated2(){
	 
	return  stateAjaxUrl;
}
function selectDetailFields(k){
	if($(k).val()=='U' || $(k).val()=='' ){
		$('.openWhenUserType').addClass('hide');
	}
	else{
		$('.openWhenUserType').removeClass('hide');
	}
	
	if($(k).val()=='D'){
		$('.service_offerng').addClass('hidden');
	}
	else{
		$('.service_offerng').removeClass('hidden');
	}
	
	
}
function load_via_ajax2(k,id){
    if(id=='state_id'){
        // $("#ListingUsers_mul_state_id option:selected").prop("selected", false);
        stateAjaxUrl  = areaBaseUrl + '/country_id/'+$('#ListingUsers_country_id').val();
    }
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName+'_'+id).val('');
		 $('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2();  })
	}
}

	</script>

 <div class="modal fade" id="modal_cropper" style="width:90%;margin:auto;" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
      <div class="modal-dialog" role="document" style="width:100%;">
        <div class="modal-content">
          <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="modalLabel">Crop the image</h4>
            
            
            <div class="clearfix"></div>
          </div>
          <div class="modal-body no-padding-left" style="padding-left:10px !important;">
        <form id="cropImage"> 
           
      <div class="  docs-buttons" style="width:110px;float:left">
        <!-- <h3>Toolbar:</h3> -->
		<div class="btn-group">
          <button type="button" class="btn btn-primary fullWidth main" data-method="crop" title="Crop" onclick="SaveCropedImage()">
            Crop & Save
          </button>
         
        </div>

		<div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="crop" title="Crop" onclick="$('#crp_image').cropper('crop')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;crop&quot;)">
              <span class="fa fa-check"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="clear" title="Clear" onclick="$('#crp_image').cropper('clear')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;clear&quot;)">
              <span class="fa fa-remove"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In" onclick="$('#crp_image').cropper('zoom', 0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', 0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out"  onclick="$('#crp_image').cropper('zoom', -0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', -0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" onclick="$(#crp_image).cropper('move', -10, 0)" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$(#crp_image).cropper('move', -10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right" onclick="$('#crp_image').cropper('move', 10, 0)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
        
        </div>

        <div class="btn-group">
			  <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up"  onclick="$('#crp_image').cropper('move', 0, -10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down"  onclick="$('#crp_image').cropper('move', 0, 10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
           </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left"  onclick="$('#crp_image').cropper('rotate', -45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', -45)">
              <span class="fa fa-rotate-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right"  onclick="$('#crp_image').cropper('rotate', 45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', 45)">
              <span class="fa fa-rotate-right"></span>
            </span>
          </button>
        </div>




        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal"  onclick="$('#crp_image').cropper('scaleX', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleX', -1)">
              <span class="fa fa-arrows-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical" onclick="$('#crp_image').cropper('scaleY', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleY', -1)">
              <span class="fa fa-arrows-v"></span>
            </span>
          </button>
        </div>

     
  
 
		<div class="btn-group">
				<button type="button" class="btn btn-primary fullWidth" data-method="moveTo" data-option="0"  onclick="$('#crp_image').cropper('move',0)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper.moveTo(0)">
				Move   [0,0]
				</span>
				</button>
	    </div>
	 
		<div class="btn-group">
				<button type="button" class="btn btn-primary fullWidth" data-method="rotateTo" data-option="180"  onclick="$('#crp_image').cropper('rotate',180)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate',180)">
				Rotate 180°
				</span>
				</button>
	    </div>
        
       
       
       
        
      </div><!-- /.docs-buttons -->

      <div class="col-md-10" style=" width: calc(100% - 120px) ! important;float:left">
              <img id="crp_image" src="" alt="Picture">
            </div>
            
            <div class="clearfix"></div>
            
            </form> 
          </div>
         
        </div>
      </div>
    </div>
<style>
.select2  { width:100% !important; }
</style>
 
		<script>
		 var input2 = document.querySelector("#ListingUsers_whatsapp_false");
    window.intlTelInput(input2, {
       hiddenInput: "whatsapp",
       
       initialCountry: "sa",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      onlyCountries: ['sa', 'ae' ],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
    
    var input = document.querySelector("#ListingUsers_phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
        hiddenInput: "full_number",
       initialCountry: "sa",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
        onlyCountries: ['sa', 'ae' ],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
     function openUpdatorN(id){
					// $('#imgd').addClass('hidden');
					 $('#abc_'+id).removeClass('hidden');
					 $('#div_view_'+id).addClass('hidden');
				 }
				 function hidewhtsapp(k){
				  if($(k).is(':checked')){
				    $('#hdwtsapp').addClass('hide');
				  }
				  else{
				       $('#hdwtsapp').removeClass('hide');
				  }
				 }
  </script>
   <style>
     .pwdopsdiv { display:none ; } .pwdstrengthstr , .pwdstrength { height:auto; }
       .iti {   width: 100% !important; }
   </style>
