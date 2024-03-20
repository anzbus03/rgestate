<footer class="site-footer zsg-footer zsg-footer_react">
   <style>
      span.contact-nms span a i {
         margin-right: .125rem;
      }

      span.contact-nms span a {
         display: block;
         line-height: 1.4;
         font-size: .75rem;
         color: var(--link-color);
         font-weight: 800;
      }

      span.contact-nms span a:hover {
         text-decoration: underline;
         color: var(--link-color);
      }
   </style>
   <div class="zsg-footer-nav zsg-separator zsg-separator_narrow">
      <nav class="zsg-footer-row zsg-footer-linklist-container">
         <ul class="zsg-list_inline zsg-footer-linklist zsg-fineprint-header" style="margin-bottom:0rem;" data-za-category="Navigation" data-za-action="Footer">
            <li><a href="<?php echo $app->createUrl('about-us'); ?>" onclick="easyload(this,event,'mainContainerClass')">About<span class="m-mob"> Us</span></a></li>
            <li><a href="<?php echo $app->createUrl('contact/index'); ?>">Contact<span class="m-mob"> Us</span></a></li>
            <li><a href="<?php echo $app->createUrl('privacy'); ?>" onclick="easyload(this,event,'mainContainerClass')">Legal Privacy</a></li>
            <li><a href="<?php echo $app->createUrl('terms'); ?>" onclick="easyload(this,event,'mainContainerClass')">Terms<span class="m-mob"> Of Use</span></a></li>
            <li><a href="<?php echo $options->get('system.common.blog_link', '#nogo'); ?>" target="_blank">Blog</a></li>
            <li><a href="<?php echo $app->createUrl('sitemap'); ?>">Sitemap</a></li>
            <li><span class="contact-nms"><span><a href="tel:<?php echo $options->get('system.common.contact_fax', ''); ?>"><i class="fa fa-phone"></i> <?php echo $options->get('system.common.contact_phone_hide_with', ''); ?></a></span><span><a href="tel:<?php echo $options->get('system.common.contact_phone', ''); ?>"><i class="fa fa-phone"></i> <?php echo $options->get('system.common.contact_phone', ''); ?></a></span></span></li>
         </ul>

      </nav>
   </div>

   <div class="zsg-footer-copyright zsg-footer-row">
      <div class="accessibility-disclaimer"> <?php echo Yii::t('app', $options->get('system.common.home_page_about_us'), array('[PROJECT_NAME]' => $conntroller->project_name, '[CONTACT_LINK]' => '<a href="' . $app->createUrl('contact/index') . '" rel="nofollow">contact us</a>')); ?>.</div>
      <ul class="zsg-list_inline">
         <li class="no-m-mob-h">
            <a href="<?php echo $app->createUrl('site/index'); ?>" class="zfoot-footer-logo">
               <img src="<?php echo $app->apps->getBaseUrl('assets/img/feetapk2.svg'); ?>" style="height:2.5rem;">
               <?php //  echo CHtml::link('lahore',Yii::app()->createUrl('properties/sec/property-for-sale/type_of[]/114/state/Lahore')); 
               ?>
            </a>


         </li>
         <li class="mobhdd">
            <div class="zsg-footer-follow"><span>Follow us:</span><a href="<?php echo $options->get('system.common.facebook_url', '#'); ?>" rel="nofollow noopener noreferrer" target="_blank" class=""><img src="<?php echo $app->apps->getBaseUrl('assets/img/facebook.png'); ?>"></a>
               <a href="<?php echo $options->get('system.common.twitter_url', '#'); ?>" rel="nofollow noopener noreferrer" target="_blank" class=""><img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/twitter.png'); ?>"></a>
               <a href="<?php echo $options->get('system.common.pinterest_url', '#'); ?>" rel="nofollow noopener noreferrer" target="_blank" class=""><img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/instagram.png'); ?>"></a>

               <a href="<?php echo $options->get('system.common.google_plus_url', '#'); ?>" rel="nofollow noopener noreferrer" target="_blank" class=""><img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/youtuber.png'); ?>"></a>
            </div>
         </li>
         <?php
         $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
         if (stripos($ua, 'android') !== false) {
         } else { ?>
            <li class="" style="margin: auto;"><a href="<?php echo  $options->get('system.common.iphone_app', 'https://apps.apple.com/ae/app/feeta-pk/id1523096134'); ?>" target="_blank" title="Open App Store to Download and Install this App">
                  <div class="d5b6dcc2 en ap"></div>
               </a></li>
         <?php } ?>
         <li class="<?php echo stristr($_SERVER['HTTP_USER_AGENT'], 'iphone') ? 'hide' : ''; ?> "><a href="<?php echo  $options->get('system.common.android_app', 'https://play.google.com/store/apps/details?id=com.propertyapp.feeta'); ?>" target="_blank" title="Open Google Play to Download and Install this App">
               <div class="d5b6dcc2 en"></div>
            </a></li>

      </ul>
      <div class="no-m-mob-h"><?php echo Yii::t('app', $options->get('system.common.copywrite_name'), array('[YEAR]' => date('Y'))); ?></div>
   </div>
</footer>
<script>
   user_login_url = '<?php echo Yii::app()->createUrl('user/load_signin_form'); ?>';
   add_to_fav = '<?php echo Yii::app()->createUrl('user/add_to_fav'); ?>';
</script>
<link href="<?php echo $conntroller->assetsUrl . '/css/minified_footer.min.css'; ?>" rel="stylesheet">