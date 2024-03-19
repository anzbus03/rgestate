<form method="get" action ="<?php echo Yii::App()->createUrl('listing/index/sec/wanted');?>" id="for_sale">
                        <div class="row no-gutters" data-select2-id="13">
                         
                           <div class="col-md-3" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="iconsrch citysScpe"></i></div>
                                  <?php echo  CHtml::dropDownList('state','',$city,array('class'=>'form-control select2 no-radius select2-hidden-accessible','empty'=>'City')); ?> 
                              </div>
                           </div>
                              <div class="col-md-4" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="iconsrch locationScpe"></i></div>
								      <input class="form-control   no-radius blackcolorplaceholder"  style="line-height:1;" value="<?php echo @$formData['loc'];?>"  placeholder="Enter Location" type="text" name="loc" id="loc">
                            
                              </div>
                           </div>
                           <?php /*
                           <div class="col-md-2" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                 <?php echo  CHtml::dropDownList('locations','',$city_array ,array('id'=>'','class'=>'form-control dynamicCities   no-radius select2-hidden-accessible','empty'=>'Locations','multiple'=>"multiple")); ?> 
                              </div>
                           </div>
                           */
                           ?>
                           <div class="col-md-3 home-home-type miniHidden" data-select2-id="73">
                              <div class="input-group" data-select2-id="72">
                                 <div class="input-group-addon"><i class="iconsrch typeScpe"></i></div>
                                 <button id="homeTypeToggle"  type="button" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="categoryTypeToggleDiv" style="width: 100% !important;border-radius: 0px;background-color: #fff;border: 0px;"  onclick="openDivThislatest(this)" >
                                                                        <!-- react-text: 501 -->Property Type<!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $conntroller->renderPartial('//listing/_category_type_home');?>
                                  
                              </div>
                           </div>
                           
                            <div class="col-md-2">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
                           </div>
                        </div>
						</form>
