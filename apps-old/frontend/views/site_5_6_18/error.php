<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 <div class="main-content" style="margin-top:100px;">
  <div class="properties" style="top:0;">
    <div class="container" style="padding:10px;">
      <div class="grid_full_width">
       <!-- Error 404 -->
       <div class="error404">
        <h1><?php echo Yii::t('app',@$error['code']);?></h1>
        <p><?php echo Yii::t('app',@$error['message']);?>.</p>
        <a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Return to the home page</a>
      </div>
      <!-- End Error 404 -->
      
    </div>
  </div>
</div>
</div>
 
