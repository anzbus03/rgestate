<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta name="robots" content="index, follow" />
<link rel="image_src" href="" />
<meta name="keywords" content="<?php echo   $pageMetaDescription ;?>" />
<meta name="description" content="<?php echo    $pageMetaDescription ;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl.'/uploads/';?><?php echo   Yii::app()->options->get('system.common.fav_ico');?>">
<title>
	<?php echo $pages->itemCount;?> ads <?php if(!empty($subcategory)) { echo " for  "; echo $subcategory->sub_category_name; }else if(!empty($category)) { echo " for "; echo $category->category_name; } ?><?php if(Yii::app()->request->cookies['state']->value) { $state_id =   Yii::app()->request->cookies['state']->value; echo " in ";echo Yii::app()->request->cookies['state_name']->value; }else{ $state_id = ""; } ?>,<?php echo Yii::app()->request->cookies['country_name'];?>
</title>
 
	
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/base_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/legacy_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/main_5572020.css" rel="stylesheet" type="text/css" media="screen,projection" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/reports_5572020.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/en/print_5572020.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
        

	<script type="text/javascript" charset="utf-8">
	//<![CDATA[
	var JS_TOOLS = [];
	//]]>
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
        
	<script type='text/javascript'>
	<?php echo Yii::app()->options->get('system.common.google_analytics_code');?>
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
        id="classified-listing-body"
        style="
            
            
        "
        class="
            country-uae
            site-dubai
            classified-listing-p
            logged-out
            lang-en
        ">



<div id="page-wrapper"  >
<div id="span_sec" class="span7">
<div id="span_sec02" class="container" >
  <!-- Country Container --> 
</div>
</div>
  <div id="help-slider" style="display:none"></div>
  <div id="signin" style="display:none">
    <div id="signin-content">
      <div class="group" id="signin-text">
        <h2>Sign In</h2>
        <a class="close">&nbsp;</a>
        <p><a href="<?php echo Yii::app()->createUrl("user/signup");?>">or Register</a></p>
      </div>
      <div class="group" id="fbconnect-signin"> <a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>" ></a> </div>
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
       <div id="logo"> <a href="<?php echo Yii::app()->createUrl("") ; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/classifieds-logo.png" alt="rsclassifieds" /></a> </div>
      
      <div class="span_sec_ads_top" id="google-ads-1">
          <?php   $this->widget('frontend.components.web.widgets.country.CountryWidget');?>
       </div>
      <div id="header-links">
        
        <div id="parent-user-control">
           <?php   $this->widget('frontend.components.web.widgets.login.LoginformWidget');?> 
          <!-- end user-controls --> 
          
          <!-- for client side ajax rendering --> 
          
        </div>
        <div id="callouts">
          <ul>
            <li id="place-an-ad"> <a id="place_an_ad_callout_en" href="<?php echo $place_url ; ?>" class="awesome red">  Place Your Ad </a> </li>
          </ul>
        </div>
      </div>
	  </div>
      <!-- end header-links -->
       <?php   $this->widget('frontend.components.web.widgets.megamenu.MegamenuWidget');?> 
      <!-- end nav--> 
      
    </div>
                
                

                
<div id="container" class="container">
<div id="content-wrapper" class="row">
                    
 
<div id="top-bar-branding-wrapper"></div>
<div id="search-widget-wrapper" class="span2">
    
   <?php 
  $this->widget('frontend.components.web.widgets.searchhome.SearchhomeWidget',array('attribute'=>(object)$attributes));
  ?>


</div>


<div id="loading_layer"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/loading.gif" /></div>

<div id="content" class="span10">
    

    

    

    <div id="watchlist-modal-wrapper" style="display:none">
        <div id="watchlist-modal-content">
            <div id="watchlist-modal-checkmark"><img src="http://m.dbzstatic.com/assets/images/detailspage/watchlist-added-en.png"></div>
            <div id="watchlist-modal-text">
                You can save your favorite ads to your Watchlist for easy access.
                
                    <ol>
                        <li>Sign in.</li>
                        <li>Click on <a href="/profile/">Account</a> link on the top right of rsClassifieds.</li>
                        <li>Select <a href="/watchlist/">My Watchlist.</a></li>
                    </ol>
                
            </div>
            <div id="watchlist-modal-preview"><img src="http://m.dbzstatic.com/assets/images/detailspage/watchlist-preview-en.jpg"></div>
        </div>
    </div>

   <?php echo $content;?>
    </div>
</div>


    


<!--  start time: 1416510371.13, time delta: 0.31311583519 -->


                    
                </div>
            </div>
</div>
      <?php   $this->widget('frontend.components.web.widgets.footer.FooterWidget');?> 
    </body>
</html>

