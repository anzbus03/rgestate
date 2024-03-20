<!DOCTYPE html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Dubizzle payment gateway</title>

        
        <!-- Please don't add "maximum-scale=1" here. It's bad for accessibility. -->
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1"/>
		<link rel="icon" href="<?php echo Yii::app()->request->baseUrl.'/uploads/';?><?php echo   Yii::app()->options->get('system.common.fav_ico');?>" type="image/x-icon">
		<script src="//cdn.optimizely.com/js/174286067.js"></script>
		<link rel="stylesheet" type="text/css" href="//secure.dubizzle.com/media/dist___ff335d5e443d58c5/css/all.min.css" />
		<script type="text/javascript" src="//secure.dubizzle.com/media/dist___ff335d5e443d58c5/js/dist.min.js"></script>
    </head>

    <body lang="en" id="base" class="base">
        <header class="">
            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/classifieds-logo.png"   alt="dubizzle" height="56">
        </header>
        <div>
		<?php echo $content;?>
         </div>

         <img width="0" height="0" style="position: absolute;" alt="" src="https://logs1270.xiti.com/hit.xiti?na=1666204314&s=509193&stc=%7B%22section%22%3A%22products%22%2C%22listing_section%22%3A%22AU%22%2C%22page_name%22%3A%22payment_step1%22%2C%22new_card%22%3A0%7D&ref=http%253A%252F%252Fabudhabi.dubizzle.com%252Fplace-an-ad%252Fpackages%252Fautos-upgrade-package%252F"/>

        
        <div class="overlay-fullscreen"></div>
    </body>
</html>
