<?php 
$meta_description =     !empty($pageMetaDescription) ? Yii::t('app',$pageMetaDescription,array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name)) :  Yii::t('app',$this->generateCommon('home_meta_description'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name));
$meta_keyword =     Yii::t('app',$this->generateCommon('home_meta_keywords'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name));?>
?>
<link rel="alternate" hreflang="en-AE" href="<?php echo CURRENT_URL;?>" />
<link rel="alternate" hreflang="en-gb" href="<?php echo CURRENT_URL;?>" />
<link rel="alternate" hreflang="en-us" href="<?php echo CURRENT_URL;?>" />
<link rel="alternate" hreflang="ar" href="https://rgestate.rsworkspace.net/ar/preleased/warehouse/" />
<link rel="canonical" href="<?php echo CURRENT_URL;?>" />
<link rel="icon" href="<?php echo  $this->app->apps->getBaseUrl('new_assets/images/favicon.png');?>" type="image/png" sizes="32x32">
<title><?php  echo  $pageTitle ;  ?></title>
<meta name="title" content="<?php  echo  $pageTitle ;  ?>"/>
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="<?php echo $meta_keyword;?>" /> 
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php  echo  $pageTitle ;  ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="og:url" content="<?php echo CURRENT_URL;?>" />
<meta property="og:site_name" content="<?php echo $this->project_name;?>"/>
<meta property="og:email" content="sales@rgestate.com"/>
<meta property="og:phone_number" content="+971552792403"/>
<meta property="og:site_name" content="RGEstate.Com By Riveria Global Group" />
<meta property="article:publisher" content="https://www.facebook.com/RGEstateUAE"/>
<meta property="article:modified_time" content="2022-03-28T19:39:09+00:00" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@RGEstateUAE" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="4 minutes" />
<meta name="Revisit-After" content="1 Days" />
<meta name="Language" content="<?php echo $this->language=='ar' ? 'Arabic':'English';?>" />
<meta name="distribution" content="Global" />
<meta name="geo.region" content="AE-DU" />
<meta name="geo.placename" content="Dubai" />
<meta name="geo.position" content="25.192529490878545, 55.26743257129561" />
<meta name="allow-search" content="yes" />
<meta name="expires" content="never" />
<meta name="YahooSeeker" content="INDEX, FOLLOW" />
<meta name="msnbot" content="INDEX, FOLLOW" />
<meta name="googlebot" content="index,follow" />
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta http-equiv="Content-Language" content="en" />