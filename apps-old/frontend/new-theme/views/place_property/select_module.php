<style>
#mainContainerClass {width:100%; max-width:100%;}
.tp_banner {height:300px;background-color:var(--secondary-color);color:#fff;display: flex;align-items: center;justify-content: center;}
.tp_banner .h2{ color:#fff}
.site-block {
	background: #fafafa;
	height: 100px;
	border: 1px solid #EEE;
	border-radius: 6px;
	color: #2B2D2E;
	display: -ms-flexbox;
	-js-display: flex;
	display: flex;
	-ms-flex-align: center;
	align-items: center;
	-ms-flex-pack: center;
	justify-content: center;
}.site-block h1 {
	margin: 0;
	font-weight: 600;
	font-size: 16px;
	line-height: 20px;
}.site-block:hover {
	border: 1px solid var(--secondary-color);
	color:var(--secondary-color);
	box-shadow: 0 20px 40px 0 rgba(0,0,0,.1);
}
.site-block:hover h1 {
 
	color:var(--secondary-color) !important;
	 
}
.site-blocks-wrapper > li {
  padding: 8px;
}
.site-blocks-wrapper {
    max-width: 800px;
    margin: auto;
    position: relative;
    top: -110px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.banner {
    margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);
    position: relative;
    height: 20.56vw;
    background-color: rgba(0,0,0,0.8);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;    margin-bottom: 0px;
}.abs-banner {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: ''; background: rgba(0,0,0,0.2);
}.bloghead {
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;
    display: flex;
    z-index: 1;
    position: relative;
} .fancy-title {
    color: #fff;
    font-size: 33px;
    font-weight: 900;
    text-shadow: 1px 1px #000;margin-bottom:0px;padding:0px;
}.site-blocks-wrapper {
 
    box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%) !important;
    border-radius: 10px;
    margin-bottom: 50px;
    padding:15px 50px;position: relative;
    z-index: 1;
    background: #fff;
}
</style>

<section class="panel panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    <div class="abs-banner"> 
            <div class="bloghead container"> 
                <div class="fancy-title-hold text-initial clearfix">
                   <h3 class="fancy-title animate animated"><span class="title"><?php echo $this->tag->getTag('which_category_would_you_like_','Which category would you like to submit?');?></span></h3>
                </div>
            </div> 
    </div> 
</section>

 
<div class="container">
<div class=" margin-top-50 margin-bottom-50">
<div class="">
	
	<ul class="row site-blocks-wrapper">
		<li class="col-xs-6 col-sm-4"><a href="<?php echo Yii::app()->createUrl('place_an_ad_no_login/create',array('type'=>'property'));?>" class="site-block"><h1><?php echo $this->tag->getTag('property','Property');?></h1></a></li>
		<li class="col-xs-6 col-sm-4"><a href="<?php echo Yii::app()->createUrl('submited_preq/index');?>" class="site-block"><h1><?php echo $this->tag->getTag('submit_your_requirements','Submit Your Requirements');?></h1></a></li>
		<li class="col-xs-6 col-sm-4"><a href="<?php echo Yii::app()->createUrl('place_an_ad_no_login/create',array('type'=>'business'));?>" class="site-block"><h1><?php echo $this->tag->getTag('business_for_sale','Business for sale');?></h1></a></li>
		<li class="col-xs-6 col-sm-4"><a href="<?php echo Yii::app()->createUrl('new_projects/create');?>" class="site-block"><h1><?php echo $this->tag->getTag('new_project','New Project');?></h1></a></li>
		<li class="col-xs-6 col-sm-4"><a href="<?php echo Yii::app()->createUrl('submited_jvproposal/index');?>" class="site-block"><h1><?php echo $this->tag->getTag('jv_proposal','JV Proposal');?></h1></a></li>
		</ul>
 


</div>

</div>

</div>
 
