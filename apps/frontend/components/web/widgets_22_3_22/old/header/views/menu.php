<header id="header-container">
   <!-- Header -->
   <div id="<?php echo  $conntroller->header_class;?>" class="sub" >
      <div class="container-fluid">
         <!-- Left Side Content -->
         <div class="left-side">
            <!-- Logo -->
            <?php
            if($conntroller->header_class=='header'){
				?>
				<div id="logo"> <a href="<?php echo Yii::app()->createUrl('site/index');?>"><img src="<?php echo $conntroller->app->apps->getBaseUrl('uploads/default/logo-2-slick.png');?>" alt=""></a> </div>
           
				<?php
			}else{ ?>
            <div id="logo"> <a href="<?php echo Yii::app()->createUrl('site/index');?>"><img src="<?php echo $conntroller->appAssetUrl('images/logo.png');?>" alt=""></a> </div>
            <?php } ?> 
             <div class="mmenu-trigger">
               <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
            </div>
            <!-- Main Navigation / End --> 
         </div>
         <!-- Left Side Content / End --> 
         <!-- Right Side Content / End -->
         <div class="right-side">
            <!-- Mobile Navigation -->
            <!-- Main Navigation -->
            <div class="header-widget">
               <nav id="navigation" class="style-1">
                  <ul id="responsive">
					 <?php $link_url  = '/state/dubai';?>
                     <li><a href="<?php echo Yii::app()->createUrl('property-for-sale').$link_url;?>">Buy</a></li>
                     <li><a href="<?php echo Yii::app()->createUrl('property-for-rent').$link_url;?>">Rent</a></li>
                     <li><a href="<?php echo Yii::app()->createUrl('user_listing/find');?>">Agents</a></li>
                     <li><a href="<?php echo Yii::app()->createUrl('user_listing_developers/find');?>">Developers </a></li>
                     <li><a href="<?php echo Yii::app()->createUrl('new-development');?>">New Developments</a></li>
                     <li><a href="<?php echo Yii::app()->createUrl('listing/index',array('listing_type'=>'C'));?>">Commercial</a></li>
                     
                     <li><a href="<?php echo Yii::app()->createUrl('advertise_interest/index');?>">Advertise</a></li>
                    <?php
                    if(!Yii::app()->user->getId()){ ?> 
                    <li style="width:auto;"><a href="<?php echo Yii::app()->createUrl('user/signin');?>"  class="sign-in when_show_no_login ms"><?php echo 'Sign in' ;?></a><span class="ms3">/</span> <a href="<?php echo Yii::app()->createUrl('user/signup');?>"      class="sign-in when_show_no_login ms2"><?php echo 'Join' ;?></a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('user/logout');?>" class="sign-in when_show_show_login hidden"><i class="sl sl-icon-login"></i> Sign Out</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('member/dashboard');?>" class="sign-in when_show_show_login hidden"><i class="sl sl-icon-user"></i> My Profile</a></li>
                    
                    <?php 
                    }
                    else{
                    ?>
                    <li><a href="<?php echo Yii::app()->createUrl('user/logout');?>" class="sign-in"><i class="sl sl-icon-login"></i> Sign Out</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('member/dashboard');?>" class="sign-in"><i class="sl sl-icon-user"></i> My Profile</a></li>
                    <?php
                    }
                    ?>
                  </ul>
               </nav>
               
               
                <a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>"   class="button border with-icon">List your property <span class="bg-red">Free</span> </a> 
            </div>
         </div>
         <!-- Right Side Content / End --> 
         <!-- Sign In Popup -->
         <!-- Sign In Popup / End --> 
      </div>
   </div>
   <!-- Header / End --> 
</header>


