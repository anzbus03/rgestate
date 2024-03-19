<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<style>
    .alert.alert-warning li{ color:red; }
    
</style>
<div class="navigate_link" style="background: #eee;padding: 10px 0px;"><div class="container"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->createUrl('site/index');?>" style="color:var(--secondary-color);"><?php echo $this->tag->getTag('home','Home');?></a> <span><span> &gt; <?php echo $this->tag->getTag('error','Error');?></span></span></div></div>
	
 <div class="main-content" style="padding:100px 15px 100px 15px;">
  <div class="properties" style="top:0;">
    <div class="container" style="padding:10px;">
      <div class="grid_full_width text-center">
       <!-- Error 404 -->
       <div class="error404" style="max-width:500px;margin:auto;">
           <div class="pull-left" style="width:120px;text-align:center;color:var(--secondary-color);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="100" height="100" x="0" y="0" viewBox="0 0 510.045 510.045" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m501.499 374.087c-191.626-320.923-182.524-305.679-182.87-306.258-12.801-23.802-36.55-37.999-63.608-37.999s-50.808 14.197-63.608 37.999c-.339.568 9.121-15.275-182.87 306.257-25.553 48.1 9.289 106.127 63.794 106.127h365.369c54.465.001 89.365-57.992 63.793-106.126zm-63.793 76.127h-365.37c-31.721 0-52.104-33.646-37.463-61.744.335-.56-9.067 15.185 182.848-306.219 15.906-29.943 58.7-29.929 74.6 0 191.627 320.922 182.501 305.639 182.847 306.219 14.653 28.119-5.766 61.744-37.462 61.744z" fill="currentColor" data-original="currentColor" style=""/><path d="m240.021 150.214h30v195h-30z" fill="currentColor" data-original="currentColor" style=""/><path d="m240.021 375.214h30v30h-30z" fill="currentColor" data-original="currentColor" style=""/></g></g></svg>
</div>
<div class="pull-left" style="width:calc(100% - 120px);">
        <h1 style="font-size:24px;color:Red;" class="margin-top-0"><?php echo Yii::t('app',@$error['code']);?></h1>
        <p style="font-size:20px"><?php echo Yii::t('app',@$error['message']);?>.</p>
        <a class="button  btn-primary" href="<?php echo Yii::app()->createUrl('site/index');?>" style="border-radius:4px;"><?php echo $this->tag->getTag('return_to_the_home_page','Return to the home page');?></a>
      </div>
      </div>
      <!-- End Error 404 -->
      
    </div>
  </div>
</div>
</div>
 
