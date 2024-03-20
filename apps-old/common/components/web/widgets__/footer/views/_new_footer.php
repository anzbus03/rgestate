<footer class="site-footer zsg-footer zsg-footer_react">
   <div class="zsg-footer-nav zsg-separator zsg-separator_narrow">
      <nav class="zsg-footer-row zsg-footer-linklist-container">
         <ul class="zsg-list_inline zsg-footer-linklist zsg-fineprint-header" style="margin-bottom:0px;" data-za-category="Navigation" data-za-action="Footer">
            <li><a href="#comming"  >About Us</a></li>
            <li><a href="<?php echo $app->createUrl('contact/index');?>"  >Contact Us</a></li>
        
            <li><a href="<?php echo $app->createUrl('legal');?>"  >Legal</a></li>
            <li><a href="<?php echo $app->createUrl('policies');?>" >Privacy Policy</a></li>
            <li><a href="<?php echo $app->createUrl('help');?>" >Help</a></li>
            <li><a href="<?php echo $app->createUrl('bloglist/index');?>"   >Blog</a></li>
          </ul>
      </nav>
   </div>
   <div class="zsg-footer-copyright zsg-footer-row">
      <div class="accessibility-disclaimer"> <?php echo Yii::t('app',$options->get('system.common.home_page_about_us'),array('[PROJECT_NAME]'=> $conntroller->project_name ,'[CONTACT_LINK]'=>'<a href="'.$app->createUrl('contact/index').'" rel="nofollow">contact us</a>'));?>.</div>
      <ul class="zsg-list_inline">
         <li>
            <a href="<?php echo $app->createUrl('site/index');?>" class="zfoot-footer-logo">
                <img src="<?php echo $app->apps->getBaseUrl('assets/img/transparent.png');?>" style="height:40px;">
            </a>
         </li>
         <li>
            <div class="zsg-footer-follow"  ><span>Follow us:</span><a href="<?php echo $options->get('system.common.facebook_url','#');?>" rel="nofollow noopener noreferrer" target="_blank" class=""   ><img src="<?php echo $app->apps->getBaseUrl('assets/img/facebook.png');?>"></a><a href="<?php echo $options->get('system.common.twitter_url','#');?>" rel="nofollow noopener noreferrer" target="_blank" class=""  ><img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/twitter.png');?>"></a></div>
         </li>
         <li> <?php echo Yii::t('app',$options->get('system.common.copywrite_name'),array('[YEAR]'=> date('Y')));?></li>
         <li><span class="zsg-icon-eho"></span></li>
      </ul>
   </div>
 </footer>
<style>
	.zsg-footer-follow a { display:inline-block;margin-left:15px; }
.site-footer {
    background: 
    #fff;
        background-color: var(--footer-bg-color);
 
    margin: auto;
    margin-top: 50px;
}.zsg-footer {
    background-color:   var(--footer-bg-color) !important;
color:   var(--footer-color);
    text-align: center;display: block;
}.site-footer .zsg-footer-nav {
    border: 0;
}
.zsg-footer .zsg-separator_narrow {
    padding: 0;margin-bottom: 5px;
}
.zsg-footer-linklist-container {
    height: auto;
    overflow: visible;
    padding-right: 0;
}.zsg-footer-row {
    margin: auto;
    padding: 24px 0;
        padding-right: 0px;
}.zsg-footer-linklist-container {
    border-top: 1px solid 
#d8d8d8;
border-bottom: 1px solid
    #d8d8d8;
}.zsg-footer-row {
    text-align: center;
}.zsg-footer-linklist-container, .zsg-toolbar-menu {
    position: relative;
}.zsg-footer-linklist {
    -moz-columns: 1;
    columns: 1;
    line-height: 30px;
}.zsg-footer-linklist {
    font-size: 13px;font-weight:400;
}.zsg-footer-linklist li {
    margin: 0 10px;
    display: inline-block;
    padding-top: 0;
    text-align: center;vertical-align: top;line-height: 30px;font-size: 13px;list-style: none;
}.zsg-footer-linklist a {   color:var(--footer-color);}
.accessibility-disclaimer a{ color :var(--link-color);;font-size:13px; border-bottom:1px dotted var(--link-color);;  } 
.accessibility-disclaimer {
    max-width: 720px;
    font-size: 10px;
    margin: auto auto 24px;
    color:var(--footer-color);
    font-weight: 400;
    line-height: 15px;
    letter-spacing: 0;
    text-transform: none;
}
.zsg-footer-copyright li:first-child {

    display: inline-block;

}.zsg-footer-copyright li {

    margin: 0 20px;
        margin-right: 20px;
        margin-left: 20px;
    vertical-align: middle;

}.zsg-list_inline > li, .zsg-pagination > li, .zsg-steps > li {

    display: inline-block;
}
.zsg-footer .zsg-icon-facebook {

    color: 

    #3b5998;

}
.zsg-footer .zsg-icon-facebook::before {

    content: "\f106";
font-family: fontawesome;
    font-style: normal !important;
    font-weight: 400 !important;
    font-variant: normal !important;
    text-transform: none !important;
    speak: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    display: inline-block;font-size: 30px;

}
</style>
