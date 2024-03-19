<?php
// $banners = HomeBanner::model()->fetchBanners($this->default_country_id,$this->default_country_id,'D1D');
  $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  if(!empty($banners)){
   $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['image']): $img; 
   $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['mobile']): $img_mobile; 
  }
  ?>
     <style>
			 #articles .container_content  .category-main a {
    color: var(--block-color);
}
			 .category-main { position:relative; }
         .category-main::after { clear:both; content:'';display:block;}
         .category-main::before {content: '';
    position: absolute;
    left: 0px;
    top: 0px;
    bottom: 0px;
    width: 50px;
    background: #c3e0db; }
     .category-main h1 { padding-top:  0px; }
   .category-main {
    padding-left: 86px;
    padding-bottom: 10px;
    margin-bottom: 30px;
}
.category-main h1 {
    padding-top: 0px;
    margin-top: 0px;
    margin-left: -50px;
    /* z-index: 1111; */
    position: relative;
    letter-spacing: 1.5px;    margin-bottom: 5px;
    letter-spacing: 1.1px;
    margin-bottom: 10px;
    font-weight: 400;
}
.category-main.yellow-bg::before{ background: #fdc178; }
.navigate_link.site-map-1 , .navigate_link.site-map { display:none; }
.container_content.site-map-1 , .container_content.site-map{ max-width:950px;margin:auto;  }
.category-main ul	 { overflow:hidden;     margin: 0px;    margin-left: -18px; margin-bottom:15px; }
.category-main ul	li   { list-style-type:none; }
.category-main ul	li a:hover { text-decoration:underline; color: var(--link-color) !important;}
.category-main  { padding-top:  25px;}


.category-main ul li:before {
  content:"\f0da"; /* FontAwesome Unicode */
  font-family: FontAwesome;
  display: inline-block;
  font-weight:normal;
  margin-left: -10px; /* same as padding-left set on li */
  width: 10px; /* same as padding-left set on li */
}
.category-main ul li:hover:before {color: var(--link-color) !important;} 
         </style>
<style>.stagc-loc-txt-span2 ol li { list-style: number; }.stagc-loc-txt-span2 ol   { padding-left: 0px;  } 
h1.main_gh {    font-size: 30px !important; font-weight: 600;   }.stagc-loc-txt-span2 h1 {    font-size: 21px; font-weight: 600;   }.stagc-loc-txt-span2 h2 {    font-size: 18px; font-weight: 400;  }
ol.alphabet {
    counter-reset: my-badass-counter;
    padding: 0 80px;
} .stagc-loc-txt-span2 li {
    margin-left: 0px !important;
    margin-right: 0px !important;
}
#mainContainerClass{
    max-width:100% !important;
}#pageContainer{ max-width:100% !important; width:100% !important;}
	.banner {
    height: auto;min-height:170px;
}.abs-banner::before{content:'';left:0px;right:0px;top:0px;bottom:0px;position:absolute;background:rgba(0,0,0,0.2); }
.bloghead {
    align-items:center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;display:flex;z-index: 1;
    position: relative;
}.bloghead {
    
}.bloghead h1, .bloghead p {
    background-color: transparent !important;
    color: #fff !important; 
}.bloghead   h1 {
    margin-bottom: 19px;
}.bloghead p {
    font-weight: 300;
    font-size: 16px;
}
.abs-banner{
   
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: '';
 
} .fancy-title {
   
    color: #fff;
}
		.box-inner h1 {
    font-size: 28px;
margin-bottom: 50px;
}
	 
	} 
	#mainContainerClass,#pageContainer{ max-width:100%;width:100%; }
	.main-title h2 {
    color: #333;
    font-family: var(--main-font);
    line-height: 1.2;
    margin-bottom: 10px;
    margin-top: 0;    font-size: 30px;font-weight: 500;
}
.banner{
        margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);
}
</style>
 

<?php
					 
					preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $article->content, $image);
					if(!empty($image[1])){
					$file =  Yii::app()->apps->getBaseUrlNew('/' , true, true ).$image[1];
					if(@file_get_contents( $file)){
					 $imageExist = $file;
					}

				 }
					  
					  
					 	 ?>
 <style>
  .crumbarHeadingCms {
    background: var(--secondary-color);
    padding: 20px 0px 25px;
}
     .crumbarHeadingCms h1{ font-size:30px; color: #fff;
    margin-bottom: 0px;
    line-height: 1;}h3, .h3 {
    font-size: 18px;
    margin-top: 15px;
    margin-bottom: 15px;
} 
 </style>
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
	<?php
	if(!in_array($article->primaryKey,array('9','12'))){ ?> 
<section class="panel panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    <div class="abs-banner">
        
          
            <div class="bloghead container">
           
              <div class="fancy-title-hold text-initial clearfix">
<h3 class="fancy-title animate animated"><?php echo $article->title;?></span>  </h3>
</div>   
             
            </div>
            
        
    </div>
    
    
    
</section>
<?php } ?>
<div id="pageContainer" class="container margin-top-240">
	<div class="container_content <?php echo $article->slug;?>">
	<div class="bottom_line_2 crmbrimg">
	<span></span>
	<span></span>
	</div>
 
	
	<div class="padding-top-0 padding-bottom-50">
	<?php
	if(!empty( $imageExist)){ ?> 
	<div role="main" class="unitpage_imageGallerySlider" id="imageGallerySlider" style="height:auto;">
    <section class="slider">
        <div class="loadingFlexslider1"> </div>
                 <div class="flexslider" style="display:none">
                <ul class="slides">
					 
						<li class="img-unit-li" style="width: 965px; float: left; display: block;"> <img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php echo   $imageExist;?>&w=965&zc=1"   class="img-vert-align" style="width:965px;"></li>
						 
                  
                </ul>
        </div>
    </section>
	</div>
	<?php }
	?>
 
            
         
         
      
    
    
    <div class="unit_lowerer">
      
     
    <div class="overview-control-div"> 
        <div class="stagc-loc-txt"> 
        <span class="stagc-loc-txt-span2"><?php
        
          
        if($article->primaryKey =='9'){
         $this->renderPartial('about');
        }
        else if($article->primaryKey =='12'){
         $this->renderPartial('career');
        }
        else{
        $content = preg_replace("/<img[^>]+\>/i", "",  $article->content ,1 ); 
        echo '<div class="container" style="
    max-width: 1024px;
    padding: 50px 0px;
">';
         echo   $content  ;
         echo '</div>';
        }
         ?></span>
        </div>
    </div>
    
			 
</div>

</div>
 
<!-- End Content -->
<div style="clear:both;"></div>
	</div>
</div>
</div>
 <style>
 

.stagc-loc-txt-span2   li {
    float: left;
    margin-right: 20px;
     list-style:disc;
    width: 100%;
    margin-left:10px;
    line-height:25px;
    
}
.stagc-loc-txt-span2   li a {
    
    color:#002d72;
}
 
 

 </style>
 
<script>		$('a.anchorslide').click(function () { $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top - 195 }, 1000); return false; }); $("#pms_div .vertical ul li label").click(function () { if ($(this).next(".content").is(":visible")) { $(".content").slideUp("slow"); $(this).next(".content").slideUp("slow"); $(this).find("img").show("fast"); } else { $("img").show("fast"); $(".content").slideUp("slow"); $(this).next(".content").slideDown("slow"); $(this).find("img").hide("fast"); } $(".pm_img_down").click(function () { $(this).parent(".content").slideUp("slow"); $("#pms_div img.pm_img").show("fast"); }); });</script>
