<div id="map_locator">
<?php $this->renderPartial('_filter_html');?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page',array('full_width'=>true)); 
}
else{   
	?>
<div class="container margin-top-40" id="">
           
            <div class="row hFrwo margin-0">
                <div class="col-md-6 padding-0 the-head-sorter">
                  <h3 class="headline  margin-bottom-0 margin-left-0"><?php echo $title ;?> Real Estate Agencies</h3>
                </div>
            </div>
            <div class="clearfix"></div>
             <div class="row hFrwo margin-0  " >
                <div class="col-sm-4 padding-0 margin-0">
                    <span class="  margin-0" id="loader_againn">
                      
                               <?php 
                                if(!empty($title)){
    									    	echo Yii::t('trans', '{c} agencies  available on {t} ' ,array('{c}'=>$adsCount ,'{t}'=> $title ))  ;
    										}else{
    										    echo Yii::t('trans', '{c} agencies  available' ,array('{c}'=>$adsCount ))  ;
    							}
                                ?> 
                                  
                    </span>
                </div>
            </div>
          
        </div>
        	<?php
        	 $countries =   Countries::model()->listingCountries();
		 if(!empty($countries)){ ?> 
		<div class="container margin-top-40">
			 <div class="col-md-12  padding-0">
						  <h3 class="headline  margin-bottom-20   padding-left-0   col-md-12 no-margin-left  ">Browse Countries</h3> 
			  </div>
			  <div class="clearfix"></div>
		<div class="_ba2wq3" id="ids">
                                     <?php
										foreach($countries as $k=>$v){ ?>
  <a href="<?php echo Yii::app()->createUrl('user_listing/index',array('country'=>$v->slug,'user_type'=>'C'));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;width:80px;"><img src="<?php echo $this->appAssetUrl('images/Villas.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3><?php echo $v->country_name;?></h3>
                            <p>
                           </p>
                        </div>
                     </div>
                  </div>   </a>
                                                        <?php } ?>
									
									<div class="clearfix"></div></div>
									<div class="clearfix"></div>
		</div>
		  
         <script> $(function(){ generateLinksSlider2(); })
         </script>
		<?php }  
		?> 
         
	<div class="container margin-top-20">
			<?php // echo $this->renderPartial('_ad_section_listing');?>
			 <style>
	.listing-item-content.absC { position:absolute;z-index:11111;}
	html .listing-item-container .listing-item-content.absC h3.white {  color:#fff !important; text-shadow: 2px 2px 3px #666;}
	._add_row_5 .listing-item{ height:242px;  }
	._add_row_3 .listing-item{ height:208px;  }
	 
	._add_row_1 .simple-slick-carousel .slick-slide{ padding:10px;  }
	.slick-prev, .slick-next { z-index:1; border-radius: 50% !important;padding: 10px 10px;}
	.slick-prev::before, .slick-next::before { font-size:18px;}
	.slick-prev {    left: 46px; } 
	.home_section .seperate_mar { padding:0px !important; }
  ._ba2wq3 {
    margin-left: -8px !important;
    margin-right: -8px !important;
}

.listing_page ._add_row_3  .col-sm-4.mul_sliderh { padding-right:0px;  }
.listing_page ._add_row_3  ._ba2wq3.rrf {
    margin-left: -15px !important;
    margin-right: 0px !important;
} 
html .listing_page #map_locator ._add_row_3 .listing-item-content.spanfont  {
    padding-top: 6px;
}
html .listing_page #map_locator ._add_row_3 .listing-item-content.spanfont h3  {
    margin: 0 !important;
}
.listing_page #slideSheet.mrsNN  {
    margin-left: -8px !important;
    margin-right: -8px !important;
}
.listing_page ._add_row_3 .block_tag.for_sale_tag {
    background: #006800;
    color: #fff;
}
  .listing_page ._add_row_3  .col-sm-4:nth-child(3n+1) {
    clear: both;
}
.margin-0{ margin:0px; } .padding-0{ padding:0px !important; }
	 </style>
			  <div class="ad_row_1 margin-top-30">
				 <?php
				 
				$secModel = !empty($sectionModel) ?  $sectionModel->section_name : '' ;
				 foreach($tags as $k=>$v){
						 $criteria =  Agents::model()->findAgents($formData,false,$user_type,1);
						 $criteria->join  .= ' INNER  JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tag_id'  ;
						// $criteria->select  .= ' ,cat.category_name, (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0"  limit 1  )   as ad_image '  ;
						 $order = '';
						
						 
						 if(!empty($countryModel->country_id)){
							 $order .= ' t.country_id = "'.(int) $countryModel->country_id.'" desc , ';
						 }
						 $criteria->order = $order.'-t.priority  desc , t.user_id desc'; 
						 $criteria->limit =   $v->limit_p;
						$criteria->params[':tag_id'] = $v->tag_id;
						$field = Agents::model()->findAll($criteria);
						
				 
						 if(!empty($field)){
						   $head_section_title = '' ; 
						   $prop_title = '' ; 
						   $prop_title = 'property';
					       if(!empty($categoryModelm)){
							   $head_section_title = $categoryModelm->category_name;
							   $prop_title = ''; 
						   }
						   else if(!empty($listingTypeModelTitle)){
							   $head_section_title = $listingTypeModelTitle; 
							   $prop_title = 'property';
						   }
						 $header = Yii::t('app',$v->tag_name,array('{t}'=>$head_section_title,'{p}'=>$prop_title)) ;
						 $sub_header =   '' ;
						 $rw_ids = 'row_ids_'.$v->now_of_rows.'_'.$v->tag_id;
						 $tag = $v; 
						 $this->renderPartial('ad/_ad_row'.$v->now_of_rows,compact('tag','field','header','sub_header','rw_ids','secModel'));
						 }

				 } 
				 ?>	 
				 </div> 
				
				 <div class="clearfix"></div>
		</div>
		<div class="container margin-top-20 ">
			<?php      echo $this->renderPartial('_ad_section_listing');?>
			</div>
			
<div class="container margin-top-20">
		   <h3 class="headline  margin-bottom-20 margin-left-0"> <?php echo $title ;?> Real Estate Agencies</h3>
		<div id="slideSheet" class="mrsNN" >
		<ul class="list-group  no-margin no-padding listing_pageStyleN" id="suggestionList">
		<?php
		$works = $ads ; 
		 $this->renderPartial('_list_proprty',compact('works','checkIcon','property_of_featured_developers' )); 

		?>		
		<li id="suggest_friends_last_id" style="display:none;"></li>
		</ul>
	

		<div style="clear:both"></div>
		<div class="bar-results bottom">
		<div class="paging-holder">
		<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
		</div>
		</div>
		
		
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		</div>
<?php } ?> 
<div class="clearfix"></div>
</div>
                       
