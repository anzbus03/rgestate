<header id="pageHeader" class="headerAbsolute <?php echo  empty($conntroller->white_header) ? 'blackheader' : '';?> <?php echo  !empty($conntroller->boxshdw) ? 'boxshdw' : '';?>">
					<!-- headerAbsoluteHolder -->
					<div class="headerAbsoluteHolder clearfix">
						<!-- logo -->
						<div class="logo"><a href="<?php echo Yii::app()->createUrl('site/index');?>">
					 
						<img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/logo-white.jpg');?>" style="height:37px" class="black_logo" alt="<?php echo $conntroller->project_name;?>">
						
						</a></div>
						<!-- pageNav -->
						<nav id="pageNav" class="navbar navbar-default navTransparent pageNav2 menu-active">
							<!-- navbar collapse -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<div class="navigation-wrapper" style="height: 18px;">
									<strong class="h elemenBlock h4 textWhite text-center menuTitle fontNeuron hidden-wiii hidden-wiv" id="menu-title">Properties </strong>
									<!-- pageMainNav -->
									<ul class="nav navbar-nav pageMainNav transparentWhite pageMainNav2"  >
										<?php if(!empty($conntroller->boxshdw)){ ?> <script>$(function(){ activateVoxShadow(); })  </script> <?} ?> 
										<!-- remove dropdownFull class when its just regular dropdown -->
									 	<li class="<?php echo ( $conntroller->sec_id == 'property-for-sale'  ) ? 'active' : '' ;?> byc">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale');?>"  >Buy
											<svg xmlns="http://www.w3.org/2000/svg" class="_21d113e1" style="width:8px;height:8px;" viewBox="0 0 32 32"><path d="M7.55 3.36c-.8-.8-.7-2.1.1-2.8.8-.7 2-.7 2.7 0l14 14c.8.8.8 2 0 2.8l-14 14c-.8.8-2 .8-2.8.1-.8-.8-.8-2-.1-2.8l.1-.1 12.6-12.5-12.6-12.7z"></path></svg>
											</a>
										</li>
											<li class="<?php echo ( $conntroller->sec_id == 'homes'  ) ? 'active' : '' ;?> mainme">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale/listing_type/H');?>">Homes</a>
										</li>
									 		<li class="<?php echo ( $conntroller->sec_id == 'plots'  ) ? 'active' : '' ;?> mainme">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale/listing_type/P');?>">Plots</a>
										</li>
									 		<li class="<?php echo ( $conntroller->sec_id == 'commercial'   ) ? 'active' : '' ;?> mainme">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale/listing_type/C');?>">Commercial</a>
										</li>
									 	
									 	
									 	<li class="<?php echo $conntroller->sec_id == 'property-for-rent' ? 'active' : '' ;?> borderh">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-rent');?>">Rent</a>
										</li>
									 	<li class="<?php echo $conntroller->sec_id == 'wanted' ? 'active' : '' ;?> borderh">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/wanted');?> borderh">Wanted</a>
										</li>
									 	<li class="<?php echo $conntroller->sec_id == 'agents' ? 'active' : '' ;?> borderh">
											<a href="<?php echo Yii::App()->createUrl('user_listing/index');?>">Agents</a>
										</li>
									 	<li class="<?php echo $conntroller->sec_id == 'new-development' ? 'active' : '' ;?> borderh">
											<a href="<?php echo Yii::App()->createUrl('listing/index/sec/new-development');?>">New Projects</a>
										</li>
									</ul>
								</div>
							</div>
							<!-- userOptions -->
							<div class="userOptions userOptions2 align-center">
								<!-- headerSearchForm -->
								
								<!-- UserLinksList -->
								<ul class="list-unstyled UserLinksList UserLinksListSingle ">
									<?php
									if(!Yii::app()->user->getId()){ ?> 
									<li class="hidden-xs-ph hidden-ph">
										<a href="<?php echo  Yii::App()->createUrl('user/signin');?>" class="lightbox">Login</a> / <a href="<?php echo Yii::App()->createUrl('user/signup');?>" class="lightbox">Register</a>
									</li>
									<li class="hd-up-phone hidden-sm hidden-md hidden-lg">
										<a href="#"><i class="fi flaticon-social icn"></i></a>
									</li>
									<?php } else {
										?>
										<li class=" " style="margin-right:15px;">
										<a href="<?php echo  Yii::App()->createUrl('member/dashboard');?>" class="lightbox logo_img_main"><img src="<?php echo $conntroller->mem->getAvatarUrl( 124, '',  true); ?>" class="logo_img" /></a> 
									</li>
										<li class="hidden-xs-ph hidden-ph">
										<a href="<?php echo  Yii::App()->createUrl('user/logout');?>" class="lightbox">Logout</a> 
									</li>
										<?
									}
									?>
								</ul>
								<!-- headerModalOpener -->
								<a href="<?php echo Yii::App()->createUrl('place_an_ad/create');?>" class="headerModalOpener transparentWhite text-uppercase  fwBold noShrink hidden-xs"><i class="openerIcon"></i> <span class="headfont">Submit Property</span></a>
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  onclick="toggleBody()">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
							</div>
						</nav>
					</div>
				</header>
			 <?php /* 
		<script src="http://htmlbeans.com/html/lemanhouse/js/plugins.js"></script>
 <script> 
function initTouchNav() {

		"use strict";

		jQuery('.pageMainNav').each(function() {
			new TouchNav({
				navBlock: this,
				menuDrop: '.frame-wrap'
			});
		});
	}

initTouchNav();

 </script>
*/
?>
