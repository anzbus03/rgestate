<style>.stagc-loc-txt-span2 ol li { list-style: number; }.stagc-loc-txt-span2 ol   { padding-left: 0px;font-weight: bold; } 
h1.main_gh {    font-size: 30px !important; font-weight: 800;   }.stagc-loc-txt-span2 h1 {    font-size: 21px; font-weight: 800;   }.stagc-loc-txt-span2 h2 {    font-size: 18px; font-weight: 600;  }</style>
 <section style="margin:50px 0px;">
		<div id="headerNewplaceNew">
		<div  class="newsearch-main-div-2 cf shrink_control" style="top:48px;">

		</div>
		</div>
  </section>
<?php
					 
					preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $article->content, $image);
					if(!empty($image[1])){
					$file =  Yii::app()->apps->getBaseUrlNew('/' , true, true ).$image[1];
					if(@file_get_contents( $file)){
					 $imageExist = $file;
					}

				 }
					  
					  
					 	 ?>
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container margin-top-240">
	<div class="container_content">
	<div class="navigate_link"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Home</a> <span><span> &gt; <?php echo $article->title;?></span></span></div>
	<div class="bottom_line_2 crmbrimg">
	<span></span>
	<span></span>
	</div>
	<h1 class="crumbarHeadingCms"> <span class="bluecolor"> <h1 class="main_gh"><?php echo $article->title;?>  </h1></span>  </h1>
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
        $content = preg_replace("/<img[^>]+\>/i", "",  $article->content ,1 ); 
         echo   $content  ;?></span>
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
