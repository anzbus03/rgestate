  <div class="clearfix"></div>
  <form id="frmId" method="get" class=" margin-top-15" onSubmit="return false;" name="rwe"  >
  <style>#filterBarContainer span.miniHidden{position:relative;}
  .itmSelected i , .itmSelected input {     color: var(--logo-color) !important; }
  
  </style>
  <script>
  $(function(){
	  
	  	 $('.slider-form').find("select").on("change", function() {   if($(this).val()==''){ $(this).closest('div').removeClass('itmSelected') }else{  $(this).closest('div').addClass('itmSelected') }    });
	  	 $('.slider-form').find("input").on("change", function() {   if($(this).val()==''){ $(this).closest('div').removeClass('itmSelected') }else{  $(this).closest('div').addClass('itmSelected') }    });
		
	  })
  </script>
  <?php /* 
  <input type="hidden" name="country"  id="country" value="<?php echo $country;?>">
  * */
  $city = '';
  ?>
  <input type="hidden" name="city"  id="city" value="<?php echo $city;?>">
  <input type="hidden" id="user_type" value="<?php echo @$filterModel->user_type ;?>" name="user_type" />
  <input type="hidden" id="sort_val" value="<?php echo @$filterModel->sort ;?>" name="sort" />
  <input type="hidden" id="order_val" value="<?php echo @$formData['order'] ;?>" name="order" />
  <input type="hidden" id="keyword_val" value="<?php echo @$formData['keywords'] ;?>" name="keywords" />
   <div  class="top_search-mob" >
	 <div style="display:flex">
 <div class="flx1 agentbr"> <div class="mldifil"><label for="srchkeywrod" class="dispinl"><i class="fa fa-search"></i></label><input type="text" id="srchkeywrod" class="serchmob-input" placeholder="<?php echo $this->tag->getTag('search_by_keywords..','Search by keywords..');?>" value="<?php echo @$formData['mkeyword'] ;?>" onclick="showfrm(this)" name="mkeyword" /></div></div>
 <div class="flx1 mxwidth-150" style="padding-left:15px; ">
	 <button type="button" onclick="showfrm(this)"  class="btn btn-secondary btn-block rnded font-weight-bold opener">Filter</button>
	 <button type="button" onclick="closerfrm(this)"  class="btn btn-black btn-block  rnded font-weight-bold closer">Cancel</button>
	 </div>
 </div>
 </div>
 
   <div id="filterBarContainer" style="  order: 2;">
               <div class="slider-form advamced " style="background:#fff;">
            <div class="container">
               
				     
                  <div class="tab-content hom-content" data-select2-id="14"  >
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
                        <div class="row  " data-select2-id="13" style="background:#fff">
                         
                           <div class="col-sm-2 padding-right-0" data-select2-id="12">
                              <div class="input-group  <?php echo (isset($formData['regn']) and  !empty($formData['regn'])) ? 'itmSelected' : '';?>" data-select2-id="11">
                                
                                 <?php $city = CHtml::listData(States::model()->AllListingStatesOfCountry(COUNTRY_ID),'slug' , 'state_name');  ?> 
                                 <?php echo  CHtml::dropDownList('regn',@$formData['regn'],$city,array('class'=>'form-control select2 js-example-placeholder-single no-radius select2-hidden-accessible','data-placeholder'=>$this->tag->getTag('select_city','Select City') ,'empty'=>'')); ?> 
                              </div>
                           </div>
                          
                           <div class="col-sm-4 padding-right-0" data-select2-id="12">
                              <div class="input-group <?php echo (isset($formData['dkeyword']) and  !empty($formData['dkeyword'])) ? 'itmSelected' : '';?>" data-select2-id="11">
                                
                                 <?php echo  CHtml::textField('dkeyword',@$formData['dkeyword'],array('class'=>'form-controln   no-radius  ','style'=>'border-radius:5px !important;text-indent:15px;','placeholder'=>  $this->tag->getTag('search_by_keywords..','Search by keywords..') )); ?> 
                              </div>
                           </div>
                           <div class="col-md-2 hide" data-select2-id="12">
                              <div class="input-group <?php echo (isset($formData['service_offerng_detail']) and  !empty($formData['service_offerng_detail'])) ? 'itmSelected' : '';?>" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-newspaper-o"></i></div>
                                	<?php echo  CHtml::dropDownList('service_offerng_detail', @$formData['service_offerng_detail'], CHtml::listData(Category::model()->listData(),'category_id','category_name')  ,  array( 'empty'=>'Select Service', 'class'=>'select2 form-control' ,'style'=>'width:100%;'	 	 			)); ?>
				
                              </div>
                           </div>
                           <div class="col-md-2 hide" data-select2-id="12">
                              <div class="input-group <?php echo (isset($formData['service_offerng']) and  !empty($formData['service_offerng'])) ? 'itmSelected' : '';?>" data-select2-id="11">
                                 <div class="input-group-addon"><i class="fa fa-object-group"></i></div>
                                	<?php echo  CHtml::dropDownList('service_offerng',@$formData['service_offerng'] , array('1'=>'For Sale','2'=>'For Rent')  ,  array( 'empty'=>'Select Section', 'class'=>'select2 form-control' ,'style'=>'width:100%;'	 	 			)); ?>
				
                              </div>
                           </div>
                          
                           <div class="col-sm-2" id="mob-search-btndiv2">  
                              <button type="submit"  onclick="search_byAjax_agent()" class="btn btn-secondary btn-block rnded font-weight-bold first-searc" style="margin-top:0px !important;; padding:6px 0px !important;width: auto;float: none;min-width: 100px;    line-height: 30px !important;"><?php echo  $this->tag->getTag('search','SEARCH');?></button>
                           </div>
                        </div>
                     </div>
                  </div>
              </div>
         </div>
			   <div class="clearfix"></div>
            </div>
</form>
  
<style>
    .form .fieldGroupInline .fieldItem, .form .fieldGroupInline label{ display:inline; }
    #homeTypeToggleDiv .pbs input[type="checkbox"] { vertical-align: middle !important;}
</style>
<script>
var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
$(function(){	eventScript(); })
</script>
