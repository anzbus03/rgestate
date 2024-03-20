<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container" style="margin-top: 100px;">
<div class="container_content">	
		<div class="navigate_link"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Home</a> <span>&gt;  <?php echo  Countries::model()->getDefaultCountry();?> </span><span> &gt; List Your Ad</span></span></div>
		<div class="bottom_line_2 crmbrimg">
		<span></span>
		<span></span>
		</div>
		<h1 class="crumbarHeadingCms"> <span class="bluecolor"> List Your Ad  </span>  </h1>
	 <?php $this->renderPartial('place_ad');?>
<div style="clear:both;"></div>
</div>
</div></div>
