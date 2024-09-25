<?php
 $banners = HomeBanner::model()->fetchBanners($this->default_country_id,$this->default_country_id,'PP');
  $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  if(!empty($banners)){
   $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['image']): $img; 
   $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['mobile']): $img_mobile; 
  }
  ?>
<style>

#mainContainerClass{max-width:100%; }
@media only screen and (max-width: 1024px) {
  #blogheader nav#main-menu {
    position: relative;
     
    top: unset ;
   
}
}
@media only screen and (min-width: 768px) {
#bloglist li._1w7e1y2:nth-child(6n+1){
    clear:both
}
}

#main-content {
   
    background: #fff;
}
.f-ull-height { height:100%;position:relative;}
.f-ull-height .blog-img { height:250px; margin-bottom:15px;}
.f-ull-height .blog-img img {
    object-fit: cover !important;
    height: 100%;
    width: 100%;
    border-radius: 10px;
    background: #eee;
    min-height: 100%;
}
.mb-15 {margin-bottom:25px; }
.f-ull-height a { position:absolute;left:0;right:0;top:0;bottom:0;z-index:111;}
.blog-text{
    font-weight: 600;
    font-size: 15px;
}
#bloglist li.brkr:nth-child(6n+1) {
	clear: both;
}#main-content{ padding-top:0px !important;}
#blogheader #main-menu {
  
    box-shadow: unset; 
}nav#main-menu ul#menu-main-menu li a {
    color: #484848;
    text-transform: none;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    letter-spacing: .1px;
    padding: 10px 20px;
    font-size: 16px;
    color: #222;
    transition: all ease-in-out .1s;
    margin: 0;
    border: 1px solid #e9ecf1;
    border-radius: 22px; margin-right:15px; 
}nav#main-menu ul.j-main-menu {
   
    justify-content: flex-start; 
}nav#main-menu ul#menu-main-menu li a:hover, nav#main-menu ul#menu-main-menu li.active a {
  
    background: #fafafa;
}.

banner{
    margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);
	position: relative;
    height: 20.56vw;
    background-color:rgba(0,0,0,0.8);
	background-size:cover;background-repeat:no-repeat;    
	background-position: center;
}
#mainContainerClass, #pageContainer {
    max-width: 100%;
    width: 100%;
}
.abs-banner::before{content:'';left:0px;right:0px;top:0px;bottom:0px;position:absolute;background:rgba(0,0,0,0.2); }
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
 
}
.bloghead p {
    font-weight: 300;
    font-size: 18px;
    font-weight: 400;
    max-width: 650px;
    text-align: center;
    line-height: 1.3;
}

.main {
    background: transparent;
    display: flex;
    padding: 10px 0px;
}


/* Other */
.block-head {
  margin-bottom: 35px;
  border-bottom: 1px solid #e7e7e7;
}
.post-category-title {
  display: inline-block;
  margin-bottom: -1px;
  padding: 0 1px;
  padding-bottom: 8px;
  border-bottom: 1px solid #318892;
  font-size: 30px;
  font-weight: 700;
  text-transform: uppercase;
  line-height: 1.2;
}
.main-search-container form {
  padding: 10px 10px 2px;
  background: rgba(0, 0, 0, 0.5);
  width: 670px;
  display: inline-block;
}
.main-search-container:before{
	background: transparent;
	display:none;
}
.main-search-container form .alia-fieldid-container {
  width: calc(100% - 100px);
  float: left;
}
.main-search-container form input[type="text"] {
  width: 100%;
  height: 40px;
  margin-right: 10px;
  border-radius: 4px;
  margin-bottom: 10px;
    max-width: 100%;
    padding: 10px 12px;
    font-size: 13px;
    color: #666;
    height: 36px;
    line-height: 1.6em;
    font-family: inherit;
    background-color: #fff;
    border: 2px solid #ececec;
}
.main-search-container form a {
  padding: 7px 18px;
  width: 90px;
  background: #00699e;
  color: #ffffff;
  font-weight: bold;
  display: inline-block;
  border-radius: 4px;
  float: right;
  text-transform: uppercase;
  font-size: 14px;
}
ul.homepage-main-post {
  margin: 0;
  list-style: none;
  overflow: auto;
}

ul.homepage-main-post li {
  width: calc(33.3% - 20px);
  float: left;
  margin-right: 30px;
}

ul.homepage-main-post li:nth-child(4n + 3) {
  margin-right: 0;
}

ul.homepage-main-post li .post-title {
  font-size: 23px;
  font-weight: 500;
  text-transform: uppercase;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 2em;
}

.block-head {
  margin-bottom: 35px;
  border-bottom: 1px solid #e7e7e7;
}

.post-category-title {
  display: inline-block;
  margin-bottom: -1px;
  padding: 0 1px;
  padding-bottom: 8px;
  border-bottom: 1px solid #318892;
  font-size: 30px;
  font-weight: 700;
  text-transform: uppercase;
  line-height: 1.2;
}

.post-category-title a {
  color: #161616;
}

.post-category-link {
  text-align: center;
}

.post-category-link a {
  bottom: 20px;
  border: 1px solid;
  padding: 0 20px;
  color: #222222;
  border-radius: 2px;
  font-size: 11px;
  text-transform: uppercase;
  line-height: 28px;
  margin-top: 2px;
  display: inline-block;
}
ul.homepage-main-post li .post-title {
  font-size: 23px;
  font-weight: 500;
  text-transform: uppercase;
  text-align: center;
  margin-top: 10px;
}
.banner{
  margin-left: -15px;
  margin-right: -15px;
  width: calc(100% + 30px);
  position: relative;
  height: 18vw;
  background-color:rgba(0,0,0,0.8);
  background-size:cover;background-repeat:no-repeat;    
  background-position: center;
  }
@media only screen and (max-device-width: 480px) {
	 .section_title {
		font-size: 32px;
		text-align:center;
	}
	.main-search-container form {
		width: 90%;
	}
	.banner {
		min-height: 250px;
	}
	.entry-content img {
		width: 100%;
	}
	ul.homepage-main-post li {
		width: 100%;
		margin-right: 0;
	}
}
</style>
	     
<!-- Content
================================================== -->

<section class="panel panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    <div class="abs-banner">
            <div class="bloghead container main-search-container">
               <h1 class="mt-1 section_title"><?php echo $this->tag->getTag('our_clients_&_partners','Our Clients & Partners');?></h1>
            </div>
    </div>
</section>

<style>

// Partner Logos
.partner-logos {
  background-color: #eeeeee;
  padding: 12px;
}

.partner-logos__title {
  color: blue;
}

.partner-logos__body {
  
}

.partner-logo {
  max-width: 218px;
  height: auto;
    padding: 3px;
}

.partner-logo{
  margin-left: 10px;
}




// Generic Objects

.box{
  padding: 10px 0px !important;
    background: #f4f4f4 !important;
    border: 1px solid transparent !important;
    margin-bottom: 30px !important;
    position: relative !important;
padding-left: 8px !important;
    padding-right: 8px !important;
}

// Utility classes

.cf:before,
.cf:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

.cf:after {
    clear: both;
}

.float--left {
  float: left;
}

.float--right {
  float: right;
}.box {
   
    background: #fff; 
}
.partner-logos__body .img-sc { height:116px;}.partner-logos__body .img-sc img { width:100%;height:100%;object-fit:contain;object-psition:center; }
</style>
<div class="container">
	<section class="partner-logos cf customer-logos">
		  <div class="partner-logos__body row ">
			<?php 
			foreach ($partners as $partner) {
			?>
			<div class="col-sm-2" style="border: 1px solid #2222;margin: 10px 10px 10px 0;">
			    <div class="img-sc">
			<img class="box partner-logo float--left" src="<?php echo Yii::App()->apps->getBaseUrl('uploads/partners/'.$partner["image"]) ?>">
			</div>
			</div>
			<?php } ?>
		  </div>
	  </section>
     
</div>