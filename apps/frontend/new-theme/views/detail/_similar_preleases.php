 <style>
     #detail .topBSafe .listing-item { height:190px;}
      #detail .topBSafe  .slick-prev,   #detail .topBSafe   .slick-next { top :128px !important ;}
   #detail .topBSafe     button.saveHome { 
    right: 20px;
    top: 20px; 
}
    #detail .topBSafeer .listing-item { height:257px;}
      #detail .topBSafeer  .slick-prev,   #detail .topBSafe   .slick-next { top :128px !important ;}
   #detail .topBSafeer     button.saveHome { 
    right: 20px;
    top: 20px; 
}
.m16mar { margin-left:-8px; margin-right:-8px;}
@media only screen and (max-width: 600px) {
.m16mar {
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 16px !important;
}
}

 </style>
 <?php 
  $order = '';
    $order .= '  t.category_id  = "'.$model->category_id.'" desc' ;
    if(!empty($model->city)){
      $order .= ',  t.city = "'.$model->city.'" desc  ' ; 
    }
    $order .= ' , t.state = "'.$model->state.'" desc' ;

 $apps= Yii::app()->apps;
 $crit = PlaceAnAd::model()->findAds(array('sort'=>'custom','custom_order'=>$order),false,1,false,false);
   $crit->order = $order; $crit->condition .= ' and property_status="1" and t.id  != :thisid and t.section_id = :thissectionid    ';$crit->params[':thisid'] = $model->id;  $crit->params[':thissectionid'] = $model->section_id;  
  
 
    $crit->limit  = 6;  
 $neighbours =PlaceAnAd::model()->findAll($crit);
 if(!empty($neighbours)){ 
	 
	 
	 
	 
	 ?> 
 
 <div class="row  topBSafe " style="" >
         <div class="  col-sm-12 ">
            <div class="row">
               <h3 class="margin-top-0 headline sec-head1 text-center" style="margin-bottom: 5px !important;     "><?php echo $this->tag->gettag('similar_preleased_properties_','Similar Preleased Properties ');?><?php echo  '' ;?> </h3>
                <div class="  dots-nav spandots  m16mar margin-top-25 safe-neibor grid" id="site" style="margin-bottom: 0px; ">
				 
                  <?php 
                  
                  foreach($neighbours  as $k=>$v){ 
								 $s_id ="sale_item".$v->id ;
							$company_image = $v->CompanyImage2;
							?>
							    	<div class="col-sm-4 lst-prop  propli  mul_sliderh smsec_<?php echo $v->section_id;?>" id="<?php echo $s_id;?>"  data-price="<?php echo $v->price;?>">
							<div class="arws"></div> 
							 <div class="listing-item" > 
										
										<div class="tagsListContainer"  >
										<ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $v->getTagList('F');?></ul>
										</div>
                                     
                                    	<div class="single-item-hover"></div>
										<div class='single-item' >
										    <a  href="<?php echo $v->detailUrl;?>" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;z-index: 1;"></a>
											<?php  echo $v->generateImage2($apps,$h=390,$w=585,$s_id,$bg);?> 
										</div>
										<?php
										if(!empty($v->ad_images_g)){
												//echo "<script>$(document).ready(function(){ caroselSingle2('".$s_id."',{$bg});});</script>";
										}
									  ?> 
										  <div    class="list-36view">
                                        <?php  if($v->view_360){  ?><span class="spn-r-round view-360"></span><?php } ?> 
                                        <?php  if($v->view_video){  ?><span class="spn-r-round view-vid"></span><?php } ?> 
                                        <?php  if($v->view_floor){  ?><span class="spn-r-round view-floor"></span><?php } ?> 
										</div>
										<span class="pull-right sm-d-date2 margin-left-5"><?php echo $v->ShowDateFrontend;?></span>
										<?php
										if($v->property_status=='1'){  echo '<span class="p_staus">'.$v->SoldStatus.'</span>';} ?>
                                 </div>
                            
                                 	
            <div class="wrapper" style="position:relative;">
                	<a href="<?php echo $v->detailUrl;?>"  class="lsproplink"> </a> 
						
				<div class="price"><?php echo $v->listRowPrice();?><span class="forgrid pull-right"><?php echo  $v->SectionCategoryFullTitle;?></span></div>
              <div class="smartad_infoarea   <?php echo  !empty($company_image) ? 'has-cm-image pull-left' : '';?>">
                <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v->detailUrl;?>" ><?php echo  $v->AdTitle2;?></a></h2>
                
                <div class="smartad_detail">
                   
                    <?php echo $v->listRowFeatures();?>
                    </div>
                <div class="smartad_location-area">
                  <div class="smartad_location"><span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                    </span><span class="smartad_locationtext"><?php echo $v->listRowLocation();?> </span>
                        
                    </div>
                </div>
                
              </div>
           <?php
               if(!empty($company_image)){
				   ?>
				   <div class="company_image_li pull-right"><img src="<?php echo $company_image;?>" /></div>
				   <?
			   }
			   ?>
             <div class="clearfix"></div>
            </div>
               <?php echo $v->footerLinkNew();?>
          
          <div class="clearfix"></div>
          </div>
           
                         
							<? }  ?>
                  <!-- Listing Item / End --> 
                  
               </div>
            </div>
         </div>
      </div>
     
<?php } 
if(Yii::app()->request->isAjaxRequest){
	?>
	<script>	$(function(){		 slickopenDetail()		})</script>
	<?
}

?> 

