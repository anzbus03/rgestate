<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=7" />

<!--Favicon-->
<link rel="shortcut Icon" href="<?php echo Yii::app()->request->baseUrl.'/uploads/';?><?php echo   Yii::app()->options->get('system.common.fav_ico');?>">
<link rel="icon" href="<?php echo Yii::app()->request->baseUrl.'/uploads/';?><?php echo   Yii::app()->options->get('system.common.fav_ico');?>" type="image/x-icon">

<!--Apple Touch Icons-->
<link rel="apple-touch-icon" href="favicons/apple-touch-icon.png">
<link rel="apple-touch-icon-precomposed" href="favicons/apple-touch-icon-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="favicons/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="favicons/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="favicons/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="favicons/apple-touch-icon-144x144-precomposed.png">
<meta name="robots" content="index, follow" />
<link rel="image_src" href="" />
<meta name="keywords" content="<?php echo   Yii::app()->options->get('system.common.home_meta_keywords');?>" />
<meta name="description" content="<?php echo   Yii::app()->options->get('system.common.home_meta_description');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo  (Yii::app()->options->get('system.common.home_meta_title'))? Yii::app()->options->get('system.common.home_meta_title') :     Yii::app()->options->get('system.common.site_name');?></title>
<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->

<!-- Media Queries Script for IE8 and Older -->
<!--[if lt IE 9]>
		<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/base_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/legacy_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/main_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/reports_5572020.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/print_5572020.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/blogs.css" rel="stylesheet" type="text/css" media="all" />
<!--<link href="css/en/top.css" rel="stylesheet" type="text/css" media="all" />-->

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/flexslider.css" type="text/css" media="screen" />
<script type="text/javascript" charset="utf-8">
            //<![CDATA[
            var JS_TOOLS = [];
            //]]>
        </script>
<script type='text/javascript'>
<?php echo Yii::app()->options->get('system.common.google_analytics_code');?>
</script>
<script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') + 
    '';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
    })();
</script>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
    var IE6BROWSER;
	var START = (new Date).getTime();
	var MEDIA_URL = "";
	var DEBUG = false;
	var GOOGLE_API_KEY = "";
    var MAP_LISTINGS_PAGE = false;
    var DETAIL_PAGE = false
    var LISTINGS_PAGE = false
    var PAA_PREVIEW_PAGE = false
    var GOOGLE_ASYNC_ADS = false;
	var SITE_ID = 2;
	var SITE_IS_MAPPABLE = true;
	var IS_AUTHENTICATED = 'False';
	var DBZGLOBAL_CB_CHAIN = [];
	var LANGUAGE_CODE = "en";
        var BASE_DOMAIN = ".rsclassifieds.com";
	var dbzglobal_attach_cb = function (cb){
		DBZGLOBAL_CB_CHAIN.push(cb);
	};
	var EVENTS_INITIALIZED = false;
    var CV_TIMEOUT = 5000;

    

    var dbzglobal_event_adapter = function(el, waiting_for_library){
	    waiting_for_library = waiting_for_library || false;
		if (!EVENTS_INITIALIZED){
			if(document.getElementById('event-lib-loading') === null){
				var body = document.getElementsByTagName('body')[0],
				p = findPosition(el),
				_x = p[0] + el.parentNode.offsetWidth/2,
				_y = p[1] - el.parentNode.offsetHeight/2,
				loading_div = document.createElement('div');
				loading_div.id = "event-lib-loading";
				loading_div.style.top = _y + 'px';
				loading_div.style.left = _x + 'px';
				body.appendChild(loading_div);
			}
			dbzglobal_attach_cb(function(){ DbzGlobal.eventAdapter(el); loading_div.style.display = 'None'; })
		}
		return false;
	}
	
    var PHOTO_UPLOAD_OPTIONS = {
    	max_photos: 10, // max number of photos
    	max_size: 4 // max size per photo in mb
    }
//]]>
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->theme->baseUrl;?>/js/loader.js">
</script><script type="text/javascript" charset="utf-8">
//<![CDATA[

	// on load fixes:
	function fix_search_tabs_menu() {
		if(typeof window['jQuery'] != 'function') {
			return setTimeout(fix_search_tabs_menu,300); // wait for jquery
		}
		$("#menu-tabs option#tab-DZ")[0].selected = true;
	}
    function wait_for_dbzglobal() {
        if(typeof window['DbzGlobal'] != 'object') {
            return setTimeout(wait_for_dbzglobal,300);
        }

        
        try{ (function(){ var ratings = [],pricings=[];
ratings.push('not rated yet');
ratings.push('Awesome');
ratings.push('Great');
ratings.push('Good');
ratings.push('Ok');
ratings.push('Blah');
pricings.push('High end');
pricings.push('Expensive');
pricings.push('Moderate');
pricings.push('Affordable');
pricings.push('Budget');
DbzGlobal.setVerbalRating(ratings);
DbzGlobal.setVerbalPricing(pricings);})();

        }catch(e){}
        
        try{ DbzGlobal.setGlobal("searchForms",["END"]);
        }catch(e){}
        DbzGlobal.initialize_site();
    }
	//     start init-site
	var init_site = function () {

        wait_for_dbzglobal();

	} // end init-site    

    function googleSectionalElementInit() {
        new google.translate.SectionalElement({
          sectionalNodeClassName: 'trans_toggle_text',
          controlNodeClassName: 'title',
          background: '#f4fa58'
        }, 'gtrans_placeholder');
    }

//]]>
</script>
<script type="text/javascript" charset="utf-8">
//<![CDATA[



var JS_LIB = [
    
        '<?php echo Yii::app()->theme->baseUrl;?>/js/jsi18nen0011.js',
        "<?php echo Yii::app()->theme->baseUrl;?>/js/top_1416336495.js",
       
    
    
        "http://platform.twitter.com/widgets.js"
        ];
	JS_LIB = JS_LIB.concat(JS_TOOLS);
	L.Script.loadScripts(JS_LIB, init_site);
//]]>
</script>

<!--[if IE 6]>
<script type="text/javascript" charset="utf-8">
//<![CDATA[
	try {document.execCommand("BackgroundImageCache", false, true);} catch(err) {}; // fixing background flicker in ie6
//]]>
</script>
<script type="text/javascript" src="http://m.dbzstatic.com/assets/js/tools/DD_belatedPNG_0.0.7a-min.js"></script>
<script type="text/javascript" charset="utf-8">//<![CDATA[ DD_belatedPNG.fix("#container"); //]]></script>
<![endif]-->

<script>
jQuery(document).ready(function(){
  jQuery(".show_mobile").click(function(){
    jQuery("#navbar-id").toggle("slow");
  });
});
</script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.js" type="text/javascript">
</script>
</head>
<body
        id="index-body"
        style="
            
            
        "
        class="
            country-uae
            site-dubai
            index-p
            logged-out
            lang-en
        ">
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5507b1026ebc1f78" async="async"></script>

<div id="page-wrapper" class="page-wrapper_onhome"  >
  <div id="span_sec" class="span7  span_sec_onhomepage">
    <div id="span_sec023" class="container" >
   Advertise With Us
    </div>
  </div>
  <div id="help-slider"  style="display:none"></div>
  <div id="signin" style="display:none">
    <div id="signin-content">
      <div class="group" id="signin-text">
        <h2>Sign In</h2>
        <a class="close">&nbsp;</a>
        <p><a href="<?php echo Yii::app()->createUrl("user/signup");?>">or Register</a></p>
      </div>
      <div class="group" id="fbconnect-signin"> <a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>"></a> </div>
      <img class="sep-img" src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideDown_separator.jpg" />
      <div class="group" id="signin-form">
           <?php $form=$this->beginWidget('CActiveForm', array(
							'method'=>'post',
							'focus'=>"first_name",
							  'action'=>Yii::app()->createUrl("user/login")
							)); ?>
                            <div><label for="email">Email Address:</label><input id="email" type="email" name="username" /></div>
                            <div>
                                <label for="password">Password:</label>
                                <input id="password" type="password" name="password" />
                                <a id="forgot-password" href="<?php echo Yii::app()->createUrl("user/forgot_password");?>">Forgot Password?</a>
                            </div>
                            <input type="hidden" name="next" value=""/>
                            <input id="signin-button" type="submit" value="Sign In" alt="Sign In" title="Sign In" />
           <?php $this->endWidget();?>
      </div>
    </div>
  </div>
  <div id="container" class="container">
    <div id="header">
      <div class="clears">
        <div id="logo"> <a href="<?php echo Yii::app()->createUrl("");?>/"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/classifieds-logo.png" alt="qwe" /></a> </div>
        <div class="span_sec_ads_top"> <?php   $this->widget('frontend.components.web.widgets.country.CountryWidget');?> </div>
        <div id="header-links">
          <div id="parent-user-control">
              <?php   $this->widget('frontend.components.web.widgets.login.LoginformWidget');?> 
            <!-- end user-controls --> 
            
            <!-- for client side ajax rendering --> 
            
          </div>
          <div id="callouts">
            <ul>
              <li id="place-an-ad"> <a id="place_an_ad_callout_en" href="<?php echo Yii::app()->createUrl("place_an_ad/create") ; ?>" class="awesome red"> Place Your Ad </a> </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- end header-links -->
      
        <?php   $this->widget('frontend.components.web.widgets.megamenu.MegamenuWidget');?>
      <!-- end nav--> 
      
    </div>
  </div>
  <div id="span_sec_banner" class="span7">
    <div id="span_sec_banner_mid" class="wrapper_sec_ " style="position:relative">
		
		<div style="position:absolute;right:0px;bottom:0px;;"> <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/place.png" /> </div>
      <div id="span_sec_0034" style="margin:0 auto;" >
        <div class="span_sec_001">
          <div class="span_sec002"> 
            
            <?php
            /*
            <div class="span_sec_icon_directory"> <a href="#"> <span class="span_sec_directory"></span> DIRECTORY </a> </div>
            <div class="span_sec_icon_jobs"> <a href="#"> <span class="span_sec_jobs"></span> JOBS </a> </div>
            <div class="span_sec_icon_classifieds"> <a href="#"> <span class="span_sec_home_classifieds"></span> CLASSIFIEDS </a> </div>
            <div class="span_sec_icon_real"> <a href="#"> <span class="span_sec_home_real"></span> REAL ESTATE </a> </div>
            <div class="span_sec_icon_events"> <a href="#"> <span class="span_sec_home_events"></span> EVENTS </a> </div>
            <div class="span_sec_icon_autos"> <a href="#"> <span class="span_sec_home_autos"></span> AUTOS </a> </div>
            <div class="span_sec_icon_travel"> <a href="#"> <span class="span_sec_home_travel"></span> TRAVEL </a> </div>
            *             <div class="span_sec_icon_deals _last"> <a href="#"> <span class="span_sec_home_deals"></span> DEALS </a> </div>
            *  * 
            * */?>

           
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div id="container" class="container">
    <div id="content-wrapper" class="row">
      <div id="index-content">
        <div id="block1" class="span2">
          <?php $this->widget('frontend.components.web.widgets.searchhome.SearchhomeWidget')?>
          <div class="section" id="quick-links">
            <div class="section-header">Quick Links</div>
            <ul>
              <li><a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>">Sell / Place an Ad</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('user/signup');?>">Register</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('article/how');?>">How to</a></li>
              <li><a href="<?php echo Yii::app()->createUrl('article/help');?>">Help</a></li>
            </ul>
          </div>
          <div class="section" style="display:none;" id="testimonial"> <span>I listed my car and sold it the same day, and found a new one very easy through rsClassifieds. </span> <em>Branislav Stupar</em> </div>
           
           <div class="span_sec_ads" id="google-ads-2">
           <?php 
          
          $banner = Banner::model()->findByAttributes(array('position_id'=>'6','status'=>'A','isTrash'=>'0'));
          
          if($banner)
          {
			   
			  switch($banner->ad_type)
			  {
				  case  "adSense" :
				 
				  echo $banner->script;
				  break;
				  case  "adImage" :
				  echo '<img src="'. Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/banner//'.$banner->image, array('scaleAndCrop' => array('width' => 200, 'height' => 600))).'">';
				  break;
			  }
		  }
          ?>
          </div>
        </div>
        
        <!-- end block1 -->
        
         <?php echo $content; ?>
        <!-- end content--> 
        <!--<div id="wrap_sec" class="wrapper_sec_">
          <h1 class="hdg_">Industry News</h1>
          
          <div id="_blog_feed" >
            <div class="col "><a target="_blank" title="" href="#"><b>Designer Interview </b> TechVector otherwise known as Reggie Gilbert, otherwise known as the man that works non-stop and still finds time to snowboard mo...</a>
              
            </div>
            <div class="col "><a target="_blank" title="" href="#"><b>Designer Interview </b>We um’ed and we ar’ed, and we considered some fruitful questions to ask Jeremy in this interview!
              But as usual we chose to keep ou...</a>
              
            </div>
            <div class="col last"><a target="_blank" title="" href="#"><b>Designer Interview</b> We um’ed and we ar’ed, and we considered some fruitful questions to ask Jeremy in this interview!
              But as usual we chose to keep ou...</a>
              
            </div>
          </div>
          <div id="span_sec_vist">
          <a class="vist_"    href="#"> Visit blog </a> </div></div>--> 
      </div>
    </div>
  </div>
    <?php   $this->widget('frontend.components.web.widgets.footer.FooterWidget');?> 


<!-- jQuery --> 
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 

<!-- FlexSlider --> 
<!--
<script defer src="js/jquery.flexslider.js"></script> 
<script type="text/javascript">
    $(function(){
     // SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 210,
        itemMargin: 5,
        minItems: 1,
        maxItems: 1,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script> 
  -->
<!--[if IE 6]><div id="browser" class="ie6">&nbsp;</div><![endif]--> 
<!--[if IE 7]><div id="browser" class="ie7">&nbsp;</div><![endif]--> 
<!--[if IE 8]><div id="browser" class="ie8">&nbsp;</div><![endif]--> 
<!--[if IE 9]><div id="browser" class="ie9">&nbsp;</div><![endif]-->

</body>
</html>
