<style>
  .main-search-container:before {
  background: transparent;
  }
  div#d_column {
  width: 1000px;
  }
  .section_title {
  font-size: 45px;
  text-transform: uppercase;
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
  .banner{
  margin-left: -15px;
  margin-right: -15px;
  width: calc(100% + 30px);
  position: relative;
  height: 25vw;
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
  /**Arear Headings ***/
  .area-heading {
  background: #9ecde4;
      width: 28%;
  margin-top: 0;
  padding: 5px 0;
  }
  .area-heading::before {
  content: "";
  display: block;
  float: left;
  width: 24px;
  height: 24px;
  margin: 4px 10px 0 10px;
  }
  .area-heading.area-overview::before {
  background: url(../../new_assets/images/icons/area-overview-selected.png) no-repeat;
  background-size: auto 100%;
  }
  .area-heading.area-neighborhood::before {
  background: url(../../new_assets/images/icons/neighborhood-icon-selected.png) no-repeat;
  background-size: auto 100%;
  }
  .area-heading.area-lifestyle::before {
  background: url(../../new_assets/images/icons/lifestyle-icon-selected.png) no-repeat;
  background-size: auto 100%;
  }
  .area-heading.area-location::before {
  background: url(../../new_assets/images/icons/location-icon-selected.png) no-repeat;
  background-size: auto 100%;
  }
  .entry-content {
  font-size: 0.94rem;
  line-height: 1.9rem;
  }
  .entry-content p {
  margin-top: 0;
  }
  .entry-content a {
  color: #0592e9;
  }
  .entry-content h2 {
  color: #121212;
  font-weight: 600;
  font-size: 1.5rem;
  }
  .entry-content h3 {
  font-size: 1.3rem;
  }
  .entry-content h4 {
  font-size: 1.12rem;
  }
  .entry-content h1,
  .entry-content h2,
  .entry-content h3,
  .entry-content h4,
  .entry-content h5,
  .entry-content h6 {
  margin-top: 1.2em;
  margin-bottom: 1em;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: normal;
  line-height: 1.5;
  -webkit-font-smoothing: initial;
  }
  .entry-content figure {
  text-align: center;
  }
  .single-post .entry-content ul,
  .single-post .entry-content ol {
  padding-left: 40px;
  margin-left: initial;
  }
  .single-post .main_content_area {
  margin-top: 0;
  }
  .single-post .single-post-button-heading {
  text-align: center;
  font-size: 1.6em;
  }
  .single-post .single_post_body .post_title {
  font-size: 46px;
  line-height: 1.1;
  font-weight: normal;
  color: #ffffff;
  text-transform: uppercase;
  }
  .single-post .single_post_body .post_title:before,
  .single-post .single_post_body .post_title:after {
  content: none !important;
  }
  .single-post .full_width_post_single .post_banner:before {
  content: "";
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  background: rgba(15, 15, 15, 0.3);
  pointer-events: none;
  }
  .single-post .full_width_post_single .post_banner {
  position: relative;
  }
  .single-post .full_width_post_single>div>.blog_post_container .post_title {
  margin: 0;
  padding: 0;
  }
  .single-post .blog_post_container .single_post_body {
  position: absolute;
  top: 0;
  margin: 193px 0 0;
  width: 100%;
  text-align: center;
  z-index: 3;
  }
  .single-post .blog_post_container.tag-video-post .single_post_body {
  margin-top: 125px;
  }
  .single-post .blog_post_container.tag-video-post .featured-video-plus iframe {
  height: 320px;
  display: block;
  }
  .single-post .entry-content ul,
  .single-post .entry-content ol {
  padding-left: 40px;
  margin-left: initial;
  list-style-type: disc;
  }
  .so-widget-sow-button-atom-0322fe281c30 .ow-button-base a.areaguide-listing-button {
  background: #0592e9;
  border: 0;
  font-size: 1.12rem;
  }
  .single-post nav {
  width: 100%;
  background: #ffffff;
  }
  .single-post nav.fixed {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 6;
  animation: smoothScroll 1s forwards;
  }
  .single-post nav.fixed .subpostnav li:nth-child(1),
  .single-post nav.fixed .subpostnav li:nth-child(2) {
  display: block;
  }
  .single-post .full_width_post_single .post_banner:before {
  content: "";
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  background: rgba(15, 15, 15, 0.3);
  pointer-events: none;
  }
  .single-post .full_width_post_single .post_banner {
  position: relative;
  }
  /***Sub Navigation *************/
  .subpostnav {
  z-index: 2 !important;
  list-style: none;
  text-align: center;
  margin: 0;
  background: #ffffff;
  box-shadow: 5px 15px 10px -15px #dddddd;
  }
  .subpostnav ul {}
  .subpostnav li {
  display: inline-block;
  padding: 20px 20px;
  margin: 0;
  color: #515151;
  font-size: 12px;
  font-weight: bold;
  }
  .subpostnav li a {
  color: #515151;
  display: block;
  }
  .subpostnav li a.active {
  color: #00699e;
  }
  .subpostnav li a:before {
  content: "";
  display: block;
  width: 100%;
  height: 36px;
  margin: 0 0 5px;
  min-width: 36px;
  }
  .subpostnav {
  position: relative;
  }
  .subpostnav li:nth-child(1),
  .subpostnav li:nth-child(2) {
  position: absolute;
  display: none;
  }
  .subpostnav li:nth-child(1) {
  left: 0;
  }
  .subpostnav li:nth-child(1) a {
  background: url(assets/images/rgestate-logo-icon.png) no-repeat #00699e;
  background-position: 40% 50%;
  padding: 0 18px 0 10px;
  color: #00699e;
  }
  .subpostnav li:nth-child(2) {
  left: 70px;
  }
  .subpostnav li:nth-child(2) a {
  color: #4a606a;
  font-size: 24px;
  margin-top: -30px;
  font-weight: normal;
  }
  .subpostnav li:nth-child(3) a:before {
  background: url(../../new_assets/images/icons/area-overview.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(3) a.active:before {
  background: url(../../new_assets/images/icons/area-overview-selected.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(4) a:before {
  background: url(../../new_assets/images/icons/neighborhood-icon.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(4) a.active:before {
  background: url(../../new_assets/images/icons/neighborhood-icon-selected.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(5) a:before {
  background: url(../../new_assets/images/icons/lifestyle-icon.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(5) a.active:before {
  background: url(../../new_assets/images/icons/lifestyle-icon-selected.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(6) a:before {
  background: url(../../new_assets/images/icons/location-icon.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  .subpostnav li:nth-child(6) a.active:before {
  background: url(../../new_assets/images/icons/location-icon-selected.png) no-repeat 50% 50%;
  background-size: auto 100%;
  }
  
 
  
  section#highlights, section#neighborhood, section#location, section#lifestyle{
	 padding: 10px 0px 0px 0px !important;
  }
</style>
<section class="panel panel-bg banner" style="background-image:url(<?php echo Yii::App()->apps->getBaseUrl('uploads/category/'.$areaguides["image"]) ?>);">
  <div class="abs-banner">
    <div class="bloghead main-search-container">
      <h1 class="mt-1 section_title"><?php echo $this->getCityText($areaguides['city']); ?></h1>
    </div>
  </div>
</section>
<section id="main-content" class="clearfix" style="padding:0px;">
  <div class="container" id="d_column">
    <div class="row full_width_post_single no_sidebar_post_single single-post">
      <div class="col12">
        <article id="post-216" class="blog_post_container customhentry post-216 post type-post status-publish format-standard has-post-thumbnail hentry category-dubai tag-dubai tag-dubai-are-guide tag-dubai-marina tag-dubai-marina-area-guide tag-dubai-marina-community-guide tag-dubai-marina-local-guide tag-dubai-marina-neighborhood-guide tag-homepage-gatsby-dubai-en tag-homepage-post tag-living-in-dubai-marina tag-moving-to-dubai-marina">
          <nav class="">
            <ul class="subpostnav">
              <li class="item"></li>
              <li class="item d-none hide">
                <?php echo CHtml::link('Back to AreaGuides', Yii::app()->createUrl('area-guides') ); ?>
              </li>
              <li class="item">
                <a href="#highlights" class="title ps2id active" data-scroll="highlights">HIGHLIGHTS</a>
              </li>
              <li class="item">
                <a href="#neighborhood" class="title ps2id" data-scroll="neighborhood">NEIGHBOURHOOD</a>
              </li>
              <li class="item">
                <a href="#lifestyle" class="title ps2id" data-scroll="lifestyle">LIFESTYLE</a>
              </li>
              <li class="item">
                <a href="#location" class="title ps2id" data-scroll="location">LOCATION</a>
              </li>
            </ul>
          </nav>
          
		  <div class="post_body has_post_banner">
            <div class="post_info_wrapper">
              <div class="entry-content blog_post_text blog_post_description clearfix">
                <section id="highlights" data-anchor="highlights">
                  <h2 class="area-heading area-overview">Highlights</h2>
                  <?php echo $areaguides['highlights']; ?>
                </section>
                <section id="neighborhood" data-anchor="neighborhood">
                  <h2 class="area-heading area-neighborhood">NEIGHBOURHOOD</h2>
                  <?php echo $areaguides['neighborhood']; ?>
                </section>
                <section id="lifestyle" data-anchor="lifestyle">
                  <h2 class="area-heading area-lifestyle">Lifestyle</h2>
                  <?php echo $areaguides['lifestyle']; ?>
                </section>
                <section id="location" data-anchor="location">
                  <h2 class="area-heading area-location">Location</h2>
                  <?php echo $areaguides['location_detail']; ?>
                </section>
              </div>
            </div>
            <!-- end post_info_wrapper -->
          </div>
          <!-- end post_body -->
		  
        </article>
      </div>
      <!-- close col12 just inside .full_width_list -->
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function () {
    
  var $root = $('html, body');
  
  $('a[href^="#"]').click(function () {
  	$root.animate({
  		scrollTop: ($( $.attr(this, 'href') ).offset().top - 50)
  	}, 2000);
  
  	return false;
  });
  
  $(window).scroll(function(){
    var sticky = $('nav'),
  	  scroll = $(window).scrollTop();
  
    if (scroll >= 100) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
  });
  
  
  var addClassOnScroll = function () {
            var windowTop = $(window).scrollTop();
            $('section[id]').each(function (index, elem) {
                var offsetTop = $(elem).offset().top;
                var outerHeight = $(this).outerHeight(true);

                if( windowTop > (offsetTop - 50) && windowTop < ( offsetTop + outerHeight)) {
                    var elemId = $(elem).attr('id');
                    $("nav ul li a.active").removeClass('active');
                    $("nav ul li a[href='#" + elemId + "']").addClass('active');
                }
            });
        };

        $(function () {
            $(window).on('scroll', function () {
                addClassOnScroll();
            });
        });
  
});
</script>