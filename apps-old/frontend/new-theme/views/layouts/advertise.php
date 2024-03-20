<!DOCTYPE html>
<head>
   <meta charset="utf-8">
   <title><?php echo $pageTitle ;?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
	<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
	<meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
   <!-- CSS
      ================================================== -->
   <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png?q=1');?>" />
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js?q=13');?>"></script> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
</head>
<body  id="<?php echo $this->id;?>" class="apollo-agent-ads  tengage wide yui3-app">
<?php $options = $this->options;?>
<div id="base-container">
	 
<div id="wrapper" class="main-wrapper">
	<?php   $this->widget('frontend.components.web.widgets.header_new.HeaderWidget'); ?>
   <div class="zsg-modal-mask"></div>
   <div class="desktop-adjust"></div>
   <?php echo $content;?>
   <footer id="footer" class="zsg-footer">
      <div class="zsg-footer-copyright zsg-footer-row">
         <ul class="zsg-list_inline">
            <li><span class="zsg-icon-eho"></span></li>
            <li>© <?php echo $options->get('system.common.copywrite_name','');?></li>
            <li>
               <div class="zsg-footer-follow" data-za-category="Homepage" data-za-action="Social Icon"><span>Follow us</span>
               
               
                                    <span class="_1oznos1">
                                       <a href="<?php echo $options->get('system.common.facebook_url','#');?>" target="_blank" rel="noopener noreferrer" class="_1rp5252" style="padding: 0px; margin: 0px;" aria-busy="false" itemprop="sameAs">
                                          <svg viewBox="0 0 32 32" role="img" aria-label="Facebook" focusable="false" style="height: 18px; width: 18px; display: block; fill: rgb(118, 118, 118);">
                                             <path d="m8 14.41v-4.17c0-.42.35-.81.77-.81h2.52v-2.08c0-4.84 2.48-7.31 7.42-7.35 1.65 0 3.22.21 4.69.64.46.14.63.42.6.88l-.56 4.06c-.04.18-.14.35-.32.53-.21.11-.42.18-.63.14-.88-.25-1.78-.35-2.8-.35-1.4 0-1.61.28-1.61 1.73v1.8h4.52c.42 0 .81.42.81.88l-.35 4.17c0 .42-.35.71-.77.71h-4.21v16c0 .42-.35.81-.77.81h-5.21c-.42 0-.8-.39-.8-.81v-16h-2.52a.78.78 0 0 1 -.78-.78" fill-rule="evenodd"></path>
                                          </svg>
                                       </a>
                                    </span>
                                    <span class="_1oznos1">
                                       <a href="<?php echo $options->get('system.common.twitter_url','#');?>" target="_blank" rel="noopener noreferrer" class="_1rp5252" style="padding: 0px; margin: 0px;" aria-busy="false" itemprop="sameAs">
                                          <svg viewBox="0 0 32 32" role="img" aria-label="Twitter" focusable="false" style="height: 18px; width: 18px; display: block; fill: rgb(118, 118, 118);">
                                             <path d="m31 6.36c-1.16.49-2.32.82-3.55.95 1.29-.76 2.22-1.87 2.72-3.38a13.05 13.05 0 0 1 -3.91 1.51c-1.23-1.28-2.75-1.94-4.51-1.94-3.41 0-6.17 2.73-6.17 6.12 0 .49.07.95.17 1.38-4.94-.23-9.51-2.6-12.66-6.38-.56.95-.86 1.97-.86 3.09 0 2.07 1.03 3.91 2.75 5.06-1-.03-1.92-.3-2.82-.76v.07c0 2.89 2.12 5.42 4.94 5.98-.63.17-1.16.23-1.62.23-.3 0-.7-.03-1.13-.13a6.07 6.07 0 0 0 5.74 4.24c-2.22 1.74-4.78 2.63-7.66 2.63-.56 0-1.06-.03-1.43-.1 2.85 1.84 6 2.76 9.41 2.76 7.29 0 12.83-4.01 15.51-9.3 1.36-2.66 2.02-5.36 2.02-8.09v-.46c-.03-.17-.03-.3-.03-.33a12.66 12.66 0 0 0 3.09-3.16" fill-rule="evenodd"></path>
                                          </svg>
                                       </a>
                                    </span>
                                    <span class="_1oznos1">
                                       <a href="<?php echo $options->get('system.common.pinterest_url','#');?>" target="_blank" rel="noopener noreferrer" class="_1rp5252" style="padding: 0px; margin: 0px;" aria-busy="false" itemprop="sameAs">
                                          <svg viewBox="0 0 24 24" role="img" aria-label="Instagram" focusable="false" style="height: 18px; width: 18px; display: block; fill: rgb(118, 118, 118);">
                                             <path d="m23.09.91c-.61-.61-1.33-.91-2.17-.91h-17.84c-.85 0-1.57.3-2.17.91s-.91 1.33-.91 2.17v17.84c0 .85.3 1.57.91 2.17s1.33.91 2.17.91h17.84c.85 0 1.57-.3 2.17-.91s.91-1.33.91-2.17v-17.84c0-.85-.3-1.57-.91-2.17zm-14.48 7.74c.94-.91 2.08-1.37 3.4-1.37 1.33 0 2.47.46 3.41 1.37s1.41 2.01 1.41 3.3-.47 2.39-1.41 3.3-2.08 1.37-3.41 1.37c-1.32 0-2.46-.46-3.4-1.37s-1.41-2.01-1.41-3.3.47-2.39 1.41-3.3zm12.66 11.63c0 .27-.09.5-.28.68a.92.92 0 0 1 -.67.28h-16.7a.93.93 0 0 1 -.68-.28.92.92 0 0 1 -.27-.68v-10.13h2.2a6.74 6.74 0 0 0 -.31 2.05c0 2 .73 3.71 2.19 5.12s3.21 2.12 5.27 2.12a7.5 7.5 0 0 0 3.75-.97 7.29 7.29 0 0 0 2.72-2.63 6.93 6.93 0 0 0 1-3.63c0-.71-.11-1.39-.31-2.05h2.11v10.12zm0-13.95c0 .3-.11.56-.31.77a1.05 1.05 0 0 1 -.77.31h-2.72c-.3 0-.56-.11-.77-.31a1.05 1.05 0 0 1 -.31-.77v-2.58c0-.29.11-.54.31-.76s.47-.32.77-.32h2.72c.3 0 .56.11.77.32s.31.47.31.76z" fill-rule="evenodd"></path>
                                          </svg>
                                       </a>
                                    </span>
                          
               
               </div>
            </li>
         </ul>
      </div>
   </footer>
</div>
</div>
<style>
.zsg-modal-mask {
    display: none;
    z-index: 1002;
    background-color: #fff;
    opacity: .9;
    filter: alpha(opacity=90);
}
.zsg-modal-mask {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}
 
body:not(.zsg-layout_full) .zsg-layout-width.layout-width_marginless {
    padding: 0 calc((100% - 1240px)/ 2);
}
body:not(.zsg-layout_full) .zsg-layout-width.layout-width_marginless {
    width: 100%;
    max-width: none;
    margin-left: auto;
    margin-right: auto;
}
@media screen and (min-width: 769px)
.zss-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: -ms-flex;
    display: flex;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -ms-flex-flow: row nowrap;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    flex-flow: row nowrap;
    position: relative;
    width: 100%;
    height: 50px;
    z-index: 1000;
    margin-bottom: 49px;
    background: #fff;
    border-bottom: 1px solid #ccc;
    box-shadow: 0 1px 4px rgba(0,0,0,.15);
}
#wrapper section#fpContainer {
    background-image: url(https://www.zillowstatic.com/static-user-account/4faeb77/static-user-account/images/Registration_Page_Desktop.jpg);
    min-height: 736px;
    max-width: 1280px;
    margin-left: auto;
    margin-right: auto;
    background-size: 100 100%;
    width: 100%;
    padding-top: 100px;
    margin-top: -50px;
}
#wrapper .auth-wrap {
    max-width: 460px;
    margin: auto;
}
.auth-wrap .zm-user-account.fastpassContact, .auth-wrap .zm-user-account.stickfigure-form {
    width: 460px;
    background-color: #fff;
}
.auth-wrap .zm-user-account.fastpassContact .module-wrap .module-head, .auth-wrap .zm-user-account.stickfigure-form .module-wrap .module-head {
    text-align: center;
    padding: 20px 40px 10px;
}
.auth-wrap .zm-user-account.fastpassContact .module-wrap .module-head h2, .auth-wrap .zm-user-account.stickfigure-form .module-wrap .module-head h2 {
    color: #333;
    font-size: 28px;
    white-space: normal;
    line-height: 32px;
    font-weight: 700;
}
.auth-wrap .zm-user-account.fastpassContact .module-wrap .module-body, .auth-wrap .zm-user-account.stickfigure-form .module-wrap .module-body {
    padding: 0 40px 30px;
    margin: 0;
}
#wrapper .fastpass-box {
    background-color: #fff;
    max-width: 460px;
    margin: 100px auto 0;
}
.zsg-footer {
    background-color: #000;
    color: #666;
    text-align: center;
}
.zsg-footer-row {
    text-align: center;
    margin: auto;
    padding-bottom: 10px;
}
.zsg-form-group, .zsg-form-group li, ol, ul {
    list-style: none;
}
.zsg-h2.zsg-separator, body, dd, dl, dt, fieldset, h1, h2, h2.zsg-separator, h3, h4, h5, h6, ol, p, ul {
    margin: 0;
}
.zsg-footer-copyright li {
    margin: 0 20px;
    vertical-align: middle;
}
.zsg-footer-copyright li {
    margin: 0 20px;
    vertical-align: middle;
}
 
.zss-header {
    padding: 0 calc((100% - 1240px)/ 2);
}
.zss-header {
    width: 100%;
    max-width: none;
    margin-left: auto;
    margin-right: auto;
}
.zss-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: -ms-flex;
    display: flex;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -ms-flex-flow: row nowrap;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    flex-flow: row nowrap;
    position: relative;
    width: 100%;
    height: 50px;
    z-index: 1000;
    margin-bottom: 49px;
    background: #fff;
    border-bottom: 1px solid #ccc;
    box-shadow: 0 1px 4px rgba(0,0,0,.15);
}
.zsg-footer {
    background-color: #000 !important;
    color: #666;
    text-align: center;
}
.zsg-footer-copyright, .zsg-footer-nav li {
    padding-top: 10px!important;
    color: #aaa!important;
}
.zsg-footer-copyright li {
    margin: 0 20px;
    vertical-align: middle;
        display: inline-block;
}
.mvm {
    margin-top: 10px !important;
    margin-bottom: 10px !important;
}
.txtC, table .txtC, table tr .txtC {
    text-align: center;
}
.typeWeightNormal {
    font-weight: normal !important;
    line-height: 18px;
font-size: 12px;
}
.typeReversed {
    color: #000;
    font-weight: bold;
    -webkit-font-smoothing: subpixel-rendering !important;
}
h6, .h6 {
    font-size: 15px;
    line-height: 1.5;
    margin: 5px 0;
    font-weight: initial;
}
#wrapper .fastpass-box .heading {
    color: #333;
    font-size: 28px;
    white-space: normal;
    line-height: 32px;
    text-align: center;
    padding: 40px 40px 17px;
}
#wrapper .fastpass-box .description {
    padding-left: 40px;
    padding-right: 40px;
    padding-bottom: 40px;
    text-align: center;
    color: #333;
}
</style>
     <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/mmenu.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/chosen.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/slick.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/rangeslider.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/magnific-popup.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/waypoints.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/counterup.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/jquery-ui.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/tooltips.min.js');?>"></script> 
</body>
</html>

