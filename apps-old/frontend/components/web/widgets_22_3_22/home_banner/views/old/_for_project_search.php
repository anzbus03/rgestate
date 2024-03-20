<form method="get" action ="<?php echo Yii::App()->createUrl('listing/index/sec/new-development');?>" id="for_sale">
                        <div class="row no-gutters" data-select2-id="13">
                         
                           <div class="col-md-3 not-at-mobile" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                 <div class="input-group-addon"><i class="iconsrch citysScpe"></i></div>
                                  <?php echo  CHtml::dropDownList('state','',$city,array('class'=>'form-control select2 no-radius select2-hidden-accessible','empty'=>'City')); ?> 
                              </div>
                           </div>
                            <div class="col-md-4 show-at-mobile" data-select2-id="12">
                              <div class="input-group" data-select2-id="11">
                                  <button type="submit"><i class="fa fa-search"></i></button>
                                 <div class="input-group-addon"><i class="fa fa-quote-left"></i></div>
                                 <input class="form-control   no-radius  blackcolorplaceholder"  style="line-height:1;" value="<?php echo @$formData['project_title'];?>"  placeholder="Project Title" type="text" name="project_title" id="project_title">
                              </div>
                           </div>
                           <div class="col-md-3 not-at-mobile home-home-type miniHidden project_cat" data-select2-id="73">
                              <div class="input-group" data-select2-id="72">
                                 <div class="input-group-addon"><i class="iconsrch typeScpe"></i></div>
                                 <button id="homeTypeToggle"  type="button" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="categoryTypeToggleDiv" style="width: 100% !important;border-radius: 0px;background-color: #fff;border: 0px;"  onclick="openDivThislatest(this)" >
                                                                        <!-- react-text: 501 -->Property Type<!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php 
                                                                     
                                                                     $conntroller->renderPartial('//listing/_category_type_home',array('sec'=>'3'));?>
                                  
                              </div>
                           </div>
                            
                           
                            <div class="col-md-2 not-at-mobile">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold">SEARCH</button>
                           </div>
                        </div>
						</form>
