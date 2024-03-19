<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 <div class="main-content" style="margin-top:100px;">
  <div class="properties" style="top:0;">
    <div class="container" style="padding:10px;">
      <div class="grid_full_width text-center">
       <!-- Error 404 -->
       <div class="error404">
        <h1 style="font-size:48px;color:Red;"><?php echo Yii::t('app',@$error['code']);?></h1>
        <p><?php echo Yii::t('app',@$error['message']);?>.</p>
        <a class="button  btn-primary" href="<?php echo Yii::app()->createUrl('site/index');?>">Return to the home page</a>
      </div>
      <!-- End Error 404 -->
      
    </div>
  </div>
</div>
</div>
 