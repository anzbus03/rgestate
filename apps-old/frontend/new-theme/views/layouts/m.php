<!DOCTYPE html>
<html  lang="<?php echo $this->language;?>" dir="<?php echo $this->direction;?>" class="absolutehtml <?php echo $this->secure_header == '1' ? 'secure' : '';?> <?php echo defined('HIDEATIPHONE') ? 'hidemenuiphone' : '';?>  <?php echo defined('APLEDEVICE') ? 'appled' : '';?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php  echo  $pageTitle ;  ?></title>
<style>
    html{
    max-width: 600px;
    margin: auto;
    background: rgba(0,0,0,0.1);
}.pagination ul li {
    
    position: unset !important;
}
.pagination ul li a {
    border-radius: 0;
    width: auto;
    height: auto;
    padding: 5px;
    line-height: 1;
}         .closer1 {      background: transparent;
    width: 58px;
    height: 54px;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1113;
    border: 0px;
 
    text-align: center;cursor:pointer;
    padding: 10px;}
    html[dir="rtl"] .closer1{ right:unset; left:0px;}
ul.pagination{ position:relative; }a{ color:var(--link-color);}.width-140{ width:150px;}
</style>
<script>var baseid = '<?php echo ASKAAN_PATH_BASE;?>';$(function(){iniFrame()}); 
var CALLING_title =  '<?php echo Yii::t('app',$this->tag->getTag('please_quote_property_referenc','Please quote property reference{}when calling us'),array('{}'=>'<div dir="ltr" class="phone-div-tedifgar">[REFERENCENUMBER]</div>'));?>';
var Phone_title 	= '<?php echo $this->tag->getTag('phone','Phone');?>';
var Agent_title 	= '<?php echo $this->tag->getTag('agent','Agent');?>';
var Close_title 	= '<?php echo $this->tag->getTag('close','Close');?>';
var call_statistics = '<?php echo $this->app->createUrl('articles/statistics/case/C');?>/';

var Contact_title 	= '<?php echo $this->tag->getTag('contact_us','Contact Us');?>';
</script>
</head>
<body>
    <div class="closer1" onclick="parent.closeopenStatistcis(this)"><img src="/assets/img/cancel.png"></div>
<div style="max-width:600px;padding:15px;margin:auto; min-height: 100vh;"><?php echo $content;?></div>
</body>
</html>
