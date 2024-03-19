<?php $city = CHtml::listData(States::model()->AllListingStatesOfCountry((int) $this->project_country_id),'slug' , 'state_name');  ?> 
<form method="get" action ="<?php echo Yii::App()->createUrl('user_listing/index');?>" id="for_sale">
                        <div class="row no-gutters" data-select2-id="13">
                         
                           <div class="col-md-3" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                  <?php echo  CHtml::dropDownList('regn','',$city,array('class'=>'form-control select2 no-radius select2-hidden-accessible','empty'=>'City')); ?> 
                              </div>
                           </div>
                            <div class="col-md-3" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                 <?php echo  CHtml::textField('company_name','',array('class'=>'form-control   no-radius  ','placeholder'=>'Company Name')); ?> 
                              </div>
                           </div>
                             <div class="col-md-4" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-map"></i></div>
                                	<?php echo  CHtml::dropDownList('service_offerng_detail','', CHtml::listData(Category::model()->listData(),'category_id','category_name')  ,  array( 'empty'=>'Select Service', 'class'=>'select2 form-control' ,'style'=>'width:100%;'	 	 			)); ?>
				
                              </div>
                           </div>
                             
                            <div class="col-md-2">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold">Search</button>
                           </div>
                        </div>
						</form>
