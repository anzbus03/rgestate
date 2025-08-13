<?php 

$heading = Yii::t('app',$this->generateCommonHeading('about_banner_heading_h1',''));  
$sub_heading = Yii::t('app',$this->generateCommonHeading('about_banner_heading_h2',''));                       
$banner_heading_p = Yii::t('app',$this->generateCommonHeading('about_banner_heading_p',''));    


  $widget = ContentPages::model()->pageContentList(1); 
  $banners = HomeBanner::model()->fetchBanners($this->default_country_id,$this->default_country_id,'JJ');
  $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  if(!empty($banners)){
   $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['image']): $img; 
   $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['mobile']): $img_mobile; 
  }
  ?> 
  <style>
.home_headings{ text-align: center;margin-bottom: 0px; position:relative;z-index:111;}
.home_headings h1 {     font-size: 32px;    color: #fff;    font-weight: 700;    margin-bottom: 25px;    margin-top: 25px;}
.home_headings h2 {     font-size: 19px;    margin-bottom: 10px;   color: #fff;    font-weight: 500 !important;}
.home_headings p {    font-size: 17px;    color: #fff !important;    margin-bottom: 0px;}
@media only screen and (min-width: 1024px){ html .main-search-container.home {   min-height: 500px!important; } } 
@media only screen and (max-width: 768px){ 
.home_headings h1 {    font-size: 20px; }
html #site .main-search-container.dark-overlay h2 {        font-size: 16px !important;    margin-bottom: 10px !important;    line-height: 1;    font-weight: 400 !important;}
.home_headings p {    font-size: 14px;    color: #fff;    margin-bottom: 0px;    line-height: 1;}
}
</style>
<style>
	/*@import url('https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900');
@import url('https://fonts.googleapis.com/css?family=Merienda:400,700');
@import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700');*/
	
	@import url('https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700');
	.box-inner h1 {
	 
		text-align: center;
		padding: 0;
		margin: 0;
		margin-bottom:15px !important;
	}
	.box-inner{
	 margin-top:-100px !important; padding-top : 25px 1important;
	}
	.banner {
		height: 36.45vw;
	}
	
	.banner {
		position: relative;
		height: 20.56vw;
		box-shadow: inset 0 200px 200px -200px #000, inset 0 -400px 400px -400px #000;
		background-position: center center !important;
	}
	
	.banner::before {
		content: '';
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		z-index: 1;
		background: rgba(0, 0, 0, 0.3);
		position: absolute;
	}
	
	section.content {
		z-index: 3;
		position: relative;
	}
	
	.panel-white:first-child {
		padding-bottom: 0;
	}
	
	.panel-white {
		padding: 4.68vw 0;
		padding-bottom: 4.68vw;
	}
	
	.container {
		width: 1170px;
		padding: 0 .78vw;
		position: relative;
		margin: 0 auto;
	}
	
	.animate.begin-animate {
		opacity: 1;
		transform: translate(0, 0px);
		transition: all ease 1s;
	}
	
	.animate {
		opacity: 0;
		transform: translate(0, 100px);
		transition: all ease 1s;
	}
	

	.box-inner {
		width: 50.96vw;
		margin: 0 auto 0px;
		margin-top: 0px;
		padding: 4.68vw 3.12vw 3.12vw;
		border: 13px solid rgba(238,238,238, 0.5);
		position: relative;
		z-index: 1;
	 
	}
	
	.text-center {
		text-align: center;
	}
	
	.box-inner h1 {
 
		text-align: center;
		padding: 0;
		margin: 0;font-size: 42px;
	}
	
	h1 {
		font-size: 2.5em;
		line-height: 1.2em;
	}
	
 
	
	.box-inner h1::after {
		height:50px;
		position: relative;
		display: block;
		width: 1px;
		margin: 1.71vw auto;
		background: transparent;
	}
	
	h3 {
		font-size: 1.88em;
		line-height: 1.2em;
		margin-bottom: 1.04vw;
		color: #262626;
	}
	
	.navigate_link {
		display: none !important;
	}
	.panel {
    /*height: 100vh;*/
    width: 100%;
    border: 0;
    margin: 0;
    box-shadow: none;
    border-radius: 0;
}

	
	.panel-bg {
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
}
	@media (max-width:1280px) {
		.box-inner {
		
		margin-top: -25%;
	}
		
		
	}
	@media(max-width:991px) {
		.box-inner {
    margin: -159px auto 30px;width: 100%;
}
		.banner {
    height: 300px;
}
		.box-inner h1 {
    font-size: 28px;
margin-bottom: 50px;
}
		.container {
    width: 100%;
    padding: 0 15px;
   
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
 
<section class="panel panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    
    <div class="container" style="height: 100% !important;display: flex;align-items: center;justify-content: center;flex-direction: column;">
       <div class="home_headings" >
          
          <h2 class="" ><?php echo $heading;?></h2>
          <h1 class="" id="nban_tit"><?php echo $sub_heading;?></h1>
          <h2 class=""  ><?php echo $banner_heading_p;?></h2>
          </div>
          </div>
    
</section>
<style>
    @media only screen and (max-width: 600px) {
 #articles section.content {
    padding-left: 0px;
    padding-right: 0px;
}.box-inner {
    margin: 0px !important;
    width: 100%;border:0px !important; 
}#articles section.content .container{ padding:0px;}
.home_headings h1 {
    font-size: 17px;
}
}
</style>
<section class="content">
	<div class="panel-white">
		<div class="container">
			<div class="box-inner text-center animate begin-animate">
			    <?php 
			    echo $article->content;?>
			    <?php /* 
				<h1>About Feeta.pk - Pakistan’s Best Property Website</h1>
				<h3>With Us, Experience Pakistan like never before</h3>
				<p>Feeta.PK is a complete real estate platform that providing a wide range of real estate properties investments opportunities in residential and commercial areas including houses, apartments, villas, ban glows, farm houses, residential plots, commercial plots, shops in markets and plazas in Lahore, Karachi, Islamabad and many other cities of Pakistan. Our services are beyond the selling and buying properties in Pakistan. We developed our website as first smarter property search engine, where visitors can not only search latest properties for buying and selling but also search for favored online estate agents, letting agents, property developers, societies and towns in Lahore, Karachi and Islamabad.</p>
			    */
			    ?>
				<span id="tve_leads_end_content" style="display: block; visibility: hidden; border: 1px solid transparent;"></span>
			</div>

		</div>
	</div>







</section>

<!--- qwreqwr-->
    <style>
                .sec-items-2 .brddr{
                    border: 1px solid #eee;height: 100%;display: flex;align-items: center;justify-content: center;border-radius:12px;
                }
                .sec-items-2.brddr :hover {
                     border: 1px solid var(--secondary-color);
                }
                 .sec-items-2 .brddr h4
                {
                    color: #333;font-weight: 600;margin-bottom: 5px;font-size: 16px;
                }.sec-items-2 .brddr:hover h4{
                     color:var(--secondary-color);
                }
                .full-vuew{ position:absolute;left:0px;right:0px;top:0px;bottom:0px;}
            </style>
<div class="section page-section section-no-padding">
      <section id="property-city" class="property-city pb0 pt0">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 offset-lg-12">
              <div class="main-title text-center mb30">
                <?php echo $widget['108'];?>
              </div>
            </div>
          </div>
            
          
          
          <div class="row features_row">
            <div class="col-sm-6 col-lg-3 col-xl-3 p0">
              <div class="why_chose_us home6">
                  <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>" class="full-vuew"></a>
                <div class="icon"> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/icon1.png');?>"> </div>
                <div class="details">
                   <?php echo $widget['104'];?>
                   <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>" class="sc-1oeu0fy-0"><?php echo $this->tag->getTag('view_all_properties_for_sale','View all properties for sale');?> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/arrow.png');?>"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 p0">
              <div class="why_chose_us home6">
                  <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>" class="full-vuew"></a>
                <div class="icon"> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/icon2.png');?>"> </div>
                <div class="details">
                   <?php echo $widget['105'];?>
                  <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>" class="sc-1oeu0fy-0"><?php echo $this->tag->getTag('view_all_rental_properties','View all rental properties');?> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/arrow.png');?>"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 p0">
              <div class="why_chose_us home6">
                  <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>'investments'));?>" class="full-vuew"></a>
                <div class="icon"> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/icon3.png');?>"> </div>
                <div class="details">
                   <?php echo $widget['113'];?>
                  <a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>'investments'));?>" class="sc-1oeu0fy-0"><?php echo $widget['114'];?> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/arrow.png');?>"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 p0">
              <div class="why_chose_us home6">
                  <a href="<?php echo $this->app->createUrl('business_listing/index',array('sec'=>'business-for-sale'));?>" class="full-vuew"></a>
                <div class="icon"> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/icon41.png');?>"> </div>
                <div class="details">
                   <?php echo $widget['115'];?>
                  <a href="<?php echo $this->app->createUrl('business_listing/index',array('sec'=>'business-for-sale'));?>" class="sc-1oeu0fy-0"><?php echo $widget['116'];?> <img src="<?php echo $this->app->apps->getBaseUrl('new_assets/images/arrow.png');?>"> </a> </div>
              </div>
            </div>
        </div>
        
        </div>
      </section>
 
    
      </div>
     
    <!--ebd--> 
        
 
     
    
      </div>
    