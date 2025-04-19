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
 if(!empty($model->city)){
	 $order .= '  t.city = "'.$model->city.'" desc  , ' ; 
 }
 $order .= 't.state = "'.$model->state.'" desc' ;
  $order .= ' , t.category_id  = "'.$model->category_id.'" desc' ;
 $apps= Yii::app()->apps;
 $crit = PlaceAnAd::model()->findAds(array('sort'=>'custom','custom_order'=>$order),false,1,false,false);
   $crit->order = $order; $crit->condition .= ' and t.id  != :thisid and t.section_id = :thissectionid    ';$crit->params[':thisid'] = $model->id;  $crit->params[':thissectionid'] = $model->section_id;  
  
 
    $crit->limit  = 6;  
 $neighbours =PlaceAnAd::model()->findAll($crit);
 if(!empty($neighbours)){ 
	 
	 
	 
	 
	 ?> 
 
 <div class="row  topBSafe " style="" >
         <div class="  col-sm-12 ">
            <div class="row">
               <h3 class="margin-top-0 headline sec-head1 text-center" style="margin-bottom: 5px !important;     "><?php echo $this->tag->gettag('more_avaliable_in_the_same_are','More avaliable in the same area');?><?php echo  '' ;?> </h3>
               <h5 style="margin-top: 0px;" class=" text-center"><?php echo $model->LocationTitle;?> </h5>
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
      <script>
    // Helper function to load an image with a Promise.
    // function loadImage(src) {
    //   return new Promise((resolve, reject) => {
    //     const img = new Image();
    //     img.crossOrigin = "anonymous";
    //     img.onload = () => resolve(img);
    //     img.onerror = () => reject(new Error("Failed to load image: " + src));
    //     img.src = src;
    //   });
    // }

    // // Main function to apply watermarks to all images with the class "watermarked-img".
    // function applyWatermarks() {
    //   // Define your base image dimensions (the reference dimensions).
    //   const baseWidth = 800;
    //   const baseHeight = 600;

    //   const watermarkedImages = document.querySelectorAll("img.watermarked-img");
    //   watermarkedImages.forEach(img => {
    //     // Prevent processing the same image twice.
    //     if (img.dataset.processed === "1") return;
    //     img.dataset.processed = "1";

    //     // Extract image and watermark settings from data attributes.
    //     // In this version, data-x and data-y represent the absolute coordinates in the base image.
    //     const mainSrc = img.getAttribute("data-src");
    //     const watermarkSrc = img.getAttribute("data-watermark-src");


    //     const opacity = parseFloat(img.getAttribute("data-opacity") || "0.5");
        
    //     // These values (e.g. 250 and 284) are the positions in the base image (800x600).
    //     const baseX = parseFloat(img.getAttribute("data-x") || "0");
    //     const baseY = parseFloat(img.getAttribute("data-y") || "0");
        
    //     // Watermark size (could be set as fixed dimensions in the base image).
    //     const wmWidth = parseInt(img.getAttribute("data-wm-width") || "100", 10);
    //     const wmHeight = parseInt(img.getAttribute("data-wm-height") || "100", 10);

    //     const canvas = document.createElement("canvas");
    //     const ctx = canvas.getContext("2d");

    //     // Wait for both the main image and watermark image to load.
    //     Promise.all([loadImage(mainSrc), loadImage(watermarkSrc)])
    //       .then(([mainImg, watermarkImg]) => {
    //         // Use natural dimensions (original size) of the main image.
    //         const mainWidth = mainImg.naturalWidth;
    //         const mainHeight = mainImg.naturalHeight;

    //         // Set canvas dimensions to the main image's natural dimensions.
    //         canvas.width = mainWidth;
    //         canvas.height = mainHeight;

    //         // Draw the main image onto the canvas.
    //         ctx.drawImage(mainImg, 0, 0);

    //         // Compute scaling factors relative to the base dimensions.
    //         const factorX = mainWidth / baseWidth;
    //         const factorY = mainHeight / baseHeight;

    //         // Calculate new watermark coordinates based on the base position and scaling factors.
    //         const x = baseX * factorX;
    //         const y = baseY * factorY;

    //         // Optionally scale the watermark dimensions as well.
    //         const scaledWmWidth = wmWidth * factorX;
    //         const scaledWmHeight = wmHeight * factorY;

    //         // Apply the watermark with the designated opacity and scaled size.
    //         ctx.globalAlpha = opacity;
    //         ctx.drawImage(watermarkImg, x, y, scaledWmWidth, scaledWmHeight);
    //         ctx.globalAlpha = 1;

    //         // Set canvas display style to match the original image element size.
    //         canvas.style.width = img.width + "px";
    //         canvas.style.height = img.height + "px";

    //         // Copy over any class names and attributes.
    //         canvas.className = img.className;
    //         canvas.alt = img.alt;
    //         canvas.title = img.title;

    //         // Replace the original image element with the canvas.
    //         img.parentNode.replaceChild(canvas, img);
    //       })
    //       .catch(err => {
    //         console.error("Failed to load image for watermarking:", err);
    //       });
    //   });
    // }

    // // Execute the function once the DOM is fully loaded.
    // document.addEventListener("DOMContentLoaded", applyWatermarks);
    // applyWatermarks();
    </script>
<!-- End RG Estate Featured -->


<?php } 
if(Yii::app()->request->isAjaxRequest){
	?>
	<script>	$(function(){		 slickopenDetail()		})</script>
	<?
}

?> 

