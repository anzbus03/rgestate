
		 	<div class="for-mobile-menu" style="display:none">
		 	
		 	<div class="language-convertor sect-mob-top">
			<?php
			$ret = defined('RETURN_URL')?     RETURN_URL   : '' ;
			foreach($languages as $k=>$v){
				if($conntroller->language==$k){ continue; } 
				echo '<a href="'.$app->createUrl('site/changeLanguage',array('val'=>$k,'ret'=>$ret)).'"   class="lng-convertor change-language" style="font-weight: 600;font-size: 17px;" class="color-grey"    >'.$v.'</a>';
			}					 
			?>	
		 	</div>
		 	<div class="logo-placer sect-mob-top">
		 	<a href="<?php echo $app->createUrl('site/index');?>"  onclick="easyload(this,event,'mainContainerClass')" style="display:block;position:relative;padding: 0px !important;width:100%;" id="arablogo">
				 
				<img src="<?php echo $app->apps->getBaseUrl($conntroller->logo_path);?>"   class="black_logo" alt="<?php echo $conntroller->project_name;?>">
		         
			</a>
	 
		 	</div>
		 	<div class="icon-placer sect-mob-top"></div>
		 	<div style="display:none" class="m-clo-di closero" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  onclick="toggleBody()">
					<img src="<?php echo $app->apps->getBaseUrl('assets/img/closen.png');?>" class=" "  >
				</div>
		 
					<div class="navbar-header opener" style="display:none;">
			    	<img src="<?php echo $app->apps->getBaseUrl('assets/img/menu-of-three-lines.png');?>" class="navbar-toggle collapsed openObject" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  onclick="toggleBody()">
	            	<img src="<?php echo $app->apps->getBaseUrl('assets/img/user121.png');?>" class="navbar-toggle collapsed openObject for-iphone-only" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  onclick="toggleBody()">
		 
		 	</div>
		 	</div>
		 	
<header id="pageHeader" class="headerAbsolute <?php echo  empty($conntroller->white_header) ? 'blackheader' : '';?> <?php echo  !empty($conntroller->boxshdw) ? 'boxshdw' : '';?>">
 		<div class="headerAbsoluteHolder clearfix">
		    <div class="header-top">
                <div class="container" style="padding-left:0px;">
                    <div class="top-info hidden-sm-down">
                        <!--<div class="call-header">
                            <p><i class="fa fa-heart-o" aria-hidden="true"></i> Favourite properties</p>
                        </div>-->
         
                    </div>
                    <div class="top-social hidden-sm-down">
						
                            <div class="call-header">
							 <a class="nav-link count-indicator"  id="messageDropdown" href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;">
                            <p class="color-grey"><i class="fa fa-heart" aria-hidden="true"></i> (<span class="  dataCounter-fav" id="dataCounter" ><?php echo $conntroller->fav_count;?></span>)</p>
							</a>
                        </div>
                      
						<div class="mail-header">
                            <p> 
						    <?php					 
							foreach($languages as $k=>$v){
							if($conntroller->language==$k){ continue; } 
								echo '<a href="'.$app->createUrl('site/changeLanguage',array('val'=>$k,'ret'=>$ret)).'"  class="ch-language change-language"  style="font-weight: 600;font-size: 17px;"     >'.$v.'</a>';
							}					 
							?>	 
							</p>
                        </div>
                       
                     <div class="login-wrap">
                       	<li id="footer-selector" class="nborder">

								<?php 		
								$listCountry = $conntroller->country_list; 
								$currentCountry = $listCountry[COUNTRY_ID]; 
								?>  
								<a title="<?php echo $currentCountry['country_name'];?>" class=""   ><span class="spantopee"><img src="<?php echo $conntroller->app->apps->getBaseUrl('assets/flags/'.strtolower($currentCountry['code']).'.svg');?>"></span> <?php echo $currentCountry['country_name'];?> <span class="_56540a28 spantitl"><span class="fa fa-angle-down"></span></a>
								<ul class="  ">
								<?php ;
								foreach($listCountry as $k=>$vs){
								echo '<li class="_4eec698b undefined" id="ch-cn-'.$k.'"><a href="'.ASKAAN_PATH_BASE.LANGUAGE.'/'.$vs['slug'].'"><span class="_577b9776 a0c5abbd"><img src="'.$conntroller->app->apps->getBaseUrl('assets/flags/'.strtolower($vs['code'])).'.svg"></span><span><!-- -->'.$vs['country_name'].'<!-- --></span></a></li>';
								}

								?>

								</ul>


								</li>
								<style>
								   
								      #ch-cn-66047::after ,#ch-cn-65893::after ,#ch-cn-65948::after,#ch-cn-65888::after ,#ch-cn-66038::after,#ch-cn-66015::after{          content:''; }
							    
								     
								</style>
         </div>
                        
                    </div>
                </div>
            </div>

		    <div class="m-m-container">
		<!-- logo -->
 
		<!-- pageNav -->
		<nav id="pageNav" class="navbar navbar-default navTransparent pageNav2 menu-active container">
		<!-- navbar collapse -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	
			<div class="navigation-wrapper" style="height: 18px;">
			<?php $app =  $app;$options= $app->options;?>
			<strong class="h elemenBlock h4 textWhite text-center menuTitle fontNeuron hidden-wiii hidden-wiv" id="menu-title">Properties </strong>
			<!-- pageMainNav -->
			<ul class="nav navbar-nav pageMainNav transparentWhite pageMainNav2" id="hmmenu"  >
			<!-- remove dropdownFull class when its just regular dropdown -->
			<li class="portion-left">
				<ul class="nav navbar-nav pageMainNav transparentWhite pageMainNav2 dspflxi">
					 
						<li class="<?php echo ( $conntroller->sec_id == SALE_SLUG  ) ? 'active' : '' ;?>  " id="hl_buy">
						<a href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>" onclick="easyload(this,event,'mainContainerClass')"  ><?php echo $conntroller->tag->getTag('buy','Buy');?></a>
						</li>
					 
						<li class="<?php echo $conntroller->sec_id == RENT_SLUG ? 'active' : '' ;?> borderh" id="hl_rent">
						<a href="<?php echo $app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo $conntroller->tag->getTag('rent','Rent');?></a>
						</li>

						<li class="<?php echo $conntroller->sec_id == 'commercial' ? 'active' : '' ;?>" id="hl_commercial">
						<a href="<?php echo $app->createUrl('listing/index',array('type_of'=>'commercial'));?>"  onclick="easyload(this,event,'mainContainerClass')"  ><?php echo $conntroller->tag->getTag('commercial','Commercial');?></a>
						</li>

					  	<li class="<?php echo $conntroller->sec_id == 'residential' ? 'active' : '' ;?> borderh" id="hl_residential">
						<a href="<?php echo $app->createUrl('listing/index',array('type_of'=>'residential'));?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo $conntroller->tag->getTag('residential','Residential');?></a>
						</li>
					
					 <li class="<?php echo $conntroller->sec_id == 'agents' ? 'active' : '' ;?> borderh" id="hl_agents">
			<a href="<?php echo $app->createUrl('user_listing/index');?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo $conntroller->tag->getTag('find_an_agency','Find an Agency');?></a>
			</li>
			<li class="<?php echo $conntroller->sec_id == 'agents2' ? 'active' : '' ;?> borderh no-m-m-mobile-oonly" id="hl_agents">
			<a href="<?php echo $app->createUrl('user_listing/agents');?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo $conntroller->tag->getTag('find_an_agent','Find an Agent');?></a>
			</li>
	 <li class=" borderh no-m-m-mobile-oonly"><a href="<?php echo $app->createUrl('article/careers-arabavenue');?>"   ><?php echo $conntroller->tag->getTag('career','Career');?></a></li>
					<li class="<?php echo $conntroller->sec_id == 'Home_Insurance' ? 'active' : '' ;?>  borderh no-m-m-mobile-oonly" id="hl_Home_Insurance"><a href="<?php echo $app->createUrl('forms/insurance');?>"   ><?php echo $conntroller->tag->getTag('home_insurance','Home Insurance');?></a></li>
						<li class="<?php echo $conntroller->sec_id == 'mortgage' ? 'active' : '' ;?>  borderh no-m-m-mobile-oonly" id="hl_Mortgage"><a href="<?php echo $app->createUrl('forms/mortgage');?>"   ><?php echo $conntroller->tag->getTag('mortgage','Mortgage');?></a></li>
						<li class="<?php echo $conntroller->sec_id == 'Property_Valuation' ? 'active' : '' ;?>  borderh no-m-m-mobile-oonly" id="hl_Property_Valuation"><a href="<?php echo $app->createUrl('forms/property_valuation');?>"   ><?php echo $conntroller->tag->getTag('valuation','Valuation');?></a></li>
					 
				
			<li id="footer-selector" class="for-mobile-only" onclick="toggleClsth(this)" onmouseleave="closetoggleClsth(this)">
						<a title="<?php echo $currentCountry['country_name'];?>" class=""   ><span class="spantopee"><img src="<?php echo $conntroller->app->apps->getBaseUrl('assets/flags/'.strtolower($currentCountry['code']).'.svg');?>"></span> <?php echo $currentCountry['country_name'];?> <span class="_56540a28 spantitl"><span class="fa fa-angle-down"></span></a>
								<ul class="  ">
								<?php ;
								foreach($listCountry as $k=>$vs){
								echo '<li class="_4eec698b undefined"><a href="'.ASKAAN_PATH_BASE.LANGUAGE.'/'.$vs['slug'].'"><span class="_577b9776 a0c5abbd"><img src="'.$conntroller->app->apps->getBaseUrl('assets/flags/'.strtolower($vs['code'])).'.svg"></span><span><!-- -->'.$vs['country_name'].'<!-- --></span></a></li>';
								}

								?>

								</ul>
						</li>
						<li class="for-mob fix-mob" style="border:0px; ">
						<div class="zsg-footer-nav zsg-separator zsg-separator_narrow">
						<nav class="zsg-footer-row zsg-footer-linklist-container">
						<ul class="zsg-list_inline zsg-footer-linklist zsg-fineprint-header" style="margin-bottom:0px;" data-za-category="Navigation" data-za-action="Footer">
						<li><a href="<?php echo $app->createUrl('about-us');?>"  ><?php echo $conntroller->tag->getTag('about_us','About Us');?></a></li><li><a href="<?php echo $app->createUrl('contact/index');?>"  ><?php echo $conntroller->tag->getTag('contact_us','Contact Us');?></a></li><li><a href="<?php echo $app->createUrl('privacy');?>" ><?php echo $conntroller->tag->getTag('legal_privacy','Legal Privacy');?></a></li><li><a href="<?php echo $app->createUrl('terms');?>" ><?php echo $conntroller->tag->getTag('terms','Terms');?></a></li><li><a href="<?php echo $options->get('system.common.blog_link','#nogo');?>" target="_blank"   ><?php echo $conntroller->tag->getTag('blog','Blog');?></a></li></li>
						</ul>
						</nav>
						</div>
						<div class="zsg-footer-follow"  ><a href="<?php echo $options->get('system.common.facebook_url','#');?>" rel="nofollow noopener noreferrer" target="_blank" class=""   ><img src="<?php echo $app->apps->getBaseUrl('assets/img/facebook.png');?>"></a>
						<a href="<?php echo $options->get('system.common.twitter_url','#');?>" rel="nofollow noopener noreferrer" target="_blank" class=""  ><img src="<?php echo $app->apps->getBaseUrl('assets/img/twitter.png');?>"></a>
						<a href="<?php echo $options->get('system.common.pinterest_url','#');?>" rel="nofollow noopener noreferrer" target="_blank" class=""  ><img src="<?php echo $app->apps->getBaseUrl('assets/img/instagram.png');?>"></a>
						</div>
						</li>
 
					</li>


				</ul>
			</li>
			<li class="portion-center  nborder" id="hl_development11"  style="margin-left:0px;margin-right:0px;">
			 
			<a href="<?php echo $app->createUrl('site/index');?>"  onclick="easyload(this,event,'mainContainerClass')" style="display:block;position:relative;padding: 0px !important;height:100%;" id="arablogo">
			 
				<img src="<?php echo $app->apps->getBaseUrl($conntroller->logo_path);?>"  class="black_logo" alt="<?php echo $conntroller->project_name;?>">
			 
			</a>
	 
			</li>
			<li class="portion-right dspflxi">
			<ul class="nav navbar-nav pageMainNav transparentWhite pageMainNav2">
					<li class="useropbt" id="useropbt">
					<div class="userOptions userOptions2 align-center">
			<!-- headerSearchForm -->
		 
			<!-- UserLinksList -->
						<ul class="list-unstyled UserLinksList UserLinksListSingle ">
						<?php
						if(!$app->user->getId()){ ?> 
						<li class="" id="no_userli"  >
							<div class="newheader_dropdown_action not-signed-in no-m-m-mobile" data-tr-event-name="header_user_account" data-header-id="profile">
							<a href="javascript:void(0)" class="newheader_dropdown_action_item header_link" data-ui-id="user-account">
									<span class="newheader_useravatar_name">
									<?php echo $conntroller->tag->getTag('log_in','Log in');?>
									</span>
									<div class="newheader_dropdown_action_item_after"></div>
							</a>
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="newheader_dropdown_arrow">
							<path fill="currentColor" d="M6 5.869l1.634-1.635a.8.8 0 1 1 1.132 1.132l-2.2 2.2a.8.8 0 0 1-1.132 0l-2.2-2.2a.8.8 0 1 1 1.132-1.132L6 5.87z"></path>
							</svg>
							<div class="newheader_dropdown_container newheader_dropdown">
								<ul class="newheader_dropdown_items">
								<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link no-padding-left" style="padding-bottom: 2px;" href="<?php echo  $conntroller->app->createUrl('user/signin');?>" onclick="OpenPopupthis(this,event)">
								<?php echo $conntroller->tag->getTag('log_in2','Log in');?>
								</a></li>
								<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link no-padding-left" href="<?php echo  $conntroller->app->createUrl('user/signup');?>" onclick="OpenPopupthis(this,event)">
								<?php echo $conntroller->tag->getTag('create_your_account','Create your account');?>
								</a></li>
								<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link sbmitLin " onclick="OpenSubmitNew(this,event)"   href="<?php echo  $conntroller->app->createUrl('place_an_ad/create');?>">
								<?php echo $conntroller->tag->getTag('sell_/_rent_your_property','Sell / Rent your property');?>
								</a></li>
								</ul>
							</div>
							</div>
								<a class="no-m-m-mobile-oonly login-btn-mb"  href="<?php echo  $conntroller->app->createUrl('user/signin');?>" onclick="OpenPopupthis(this,event)">
								<?php echo $conntroller->tag->getTag('log_in','Log in');?>
								</a>
						</li>
						<?php } else {
						?>
						<li class="" id="yes_userli"  >
							<div class="newheader_dropdown_action" data-tr-event-name="header_user_account" data-header-id="profile">
									<a href="javascript:void(0)" class="newheader_dropdown_action_item header_link" data-ui-id="user-account"><img src="<?php echo $conntroller->mem->getAvatarUrl( 124, '',  true); ?>" class="newheader_useravatar_letter"><span class="newheader_useravatar_name" dir="auto"><?php echo $conntroller->mem->FirstNameN;?></span><div class="newheader_dropdown_action_item_after"></div></a>
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="newheader_dropdown_arrow">
									<path fill="currentColor" d="M6 5.869l1.634-1.635a.8.8 0 1 1 1.132 1.132l-2.2 2.2a.8.8 0 0 1-1.132 0l-2.2-2.2a.8.8 0 1 1 1.132-1.132L6 5.87z"></path>
									</svg>
									<div class="newheader_dropdown_container newheader_dropdown">
									<ul class="newheader_dropdown_items">
										<?php
										if($app->user->getState('user_type','') != 'U'){ ?> 
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('member/dashboard');?>"><?php echo $conntroller->tag->getTag('dashboard','Dashboard');?></a></li>
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('place_an_ad/index');?>"><?php echo $conntroller->tag->getTag('my_properties','My Properties');?></a></li>
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('place_an_ad/create');?>"><?php echo $conntroller->tag->getTag('post_property','Post Property');?></a></li>
										<?php }
										else{  ?>
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('member/dashboard');?>"><?php echo $conntroller->tag->getTag('guest_dashboard','Guest Dashboard');?></a></li>
										<? 	} ?> 
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('member/favourite');?>"><?php echo $conntroller->tag->getTag('my_favorites','My Favorites');?></a></li>
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('user/update_profile');?>"><?php echo $conntroller->tag->getTag('account_settings','Account Settings');?></a></li>
										<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" href="<?php echo  $conntroller->app->createUrl('user/logout');?>"><?php echo $conntroller->tag->getTag('sign_out','Sign out');?></a></li>

									</ul>
									</div>
							</div>
						</li>
						<?
						}
						?>
						</ul>
						</div>
						</li>		
						<li class="<?php echo $conntroller->sec_id == 'Home_Insurance' ? 'active' : '' ;?>  borderh no-m-m-mobile" id="hl_Home_Insurance"><a href="<?php echo $app->createUrl('forms/insurance');?>"   ><?php echo $conntroller->tag->getTag('home_insurance','Home Insurance');?></a></li>
						<li class="<?php echo $conntroller->sec_id == 'mortgage' ? 'active' : '' ;?>  borderh no-m-m-mobile" id="hl_Mortgage"><a href="<?php echo $app->createUrl('forms/mortgage');?>"   ><?php echo $conntroller->tag->getTag('mortgage','Mortgage');?></a></li>
						<li class="<?php echo $conntroller->sec_id == 'Property_Valuation' ? 'active' : '' ;?>  borderh no-m-m-mobile" id="hl_Property_Valuation"><a href="<?php echo $app->createUrl('forms/property_valuation');?>"   ><?php echo $conntroller->tag->getTag('valuation','Valuation');?></a></li>
					 
						</ul>
</li>

			</ul>
			</div>
			</div>
			<!-- userOptions -->
		</div>
		</div>
		</header>
 
<div class="myaccount-menu is-ended container for-mobile">
		<nav class="clearfix margin-bottom-15">
		<ul class="list-unstyled myaccount-menu-navigation bttom-menu have-padding">
		<li class="widht-40"><a   onclick="openListing(this,event)" href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>" style="color:var(--secondary-color) !important" ><svg enable-background="new 0 0 26 26" id="Слой_1" version="1.1" viewBox="0 0 26 26" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="position: relative;    top: 6px;" width="25" height="25"  xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M1.75,7.75h6.6803589c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891   S13.9000854,9.0452271,14.2356567,7.75H24.25C24.6640625,7.75,25,7.4140625,25,7s-0.3359375-0.75-0.75-0.75H14.2356567   c-0.3355713-1.2952271-1.5039063-2.2587891-2.9026489-2.2587891S8.7659302,4.9547729,8.4303589,6.25H1.75   C1.3359375,6.25,1,6.5859375,1,7S1.3359375,7.75,1.75,7.75z M11.3330078,5.4912109   c0.8320313,0,1.5087891,0.6767578,1.5087891,1.5087891s-0.6767578,1.5087891-1.5087891,1.5087891S9.8242188,7.8320313,9.8242188,7   S10.5009766,5.4912109,11.3330078,5.4912109z" fill="currentColor"/><path d="M24.25,12.25h-1.6061401c-0.3355713-1.2952271-1.5039063-2.2587891-2.9026489-2.2587891   S17.1741333,10.9547729,16.838562,12.25H1.75C1.3359375,12.25,1,12.5859375,1,13s0.3359375,0.75,0.75,0.75h15.088562   c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891s2.5670776-0.963562,2.9026489-2.2587891H24.25   c0.4140625,0,0.75-0.3359375,0.75-0.75S24.6640625,12.25,24.25,12.25z M19.7412109,14.5087891   c-0.8320313,0-1.5087891-0.6767578-1.5087891-1.5087891s0.6767578-1.5087891,1.5087891-1.5087891S21.25,12.1679688,21.25,13   S20.5732422,14.5087891,19.7412109,14.5087891z" fill="currentColor"/><path d="M24.25,18.25H9.7181396c-0.3355103-1.2952271-1.5037842-2.2587891-2.9017334-2.2587891   c-1.3987427,0-2.5670776,0.963562-2.9026489,2.2587891H1.75C1.3359375,18.25,1,18.5859375,1,19s0.3359375,0.75,0.75,0.75h2.1637573   c0.3355713,1.2952271,1.5039063,2.2587891,2.9026489,2.2587891c1.3979492,0,2.5662231-0.963562,2.9017334-2.2587891H24.25   c0.4140625,0,0.75-0.3359375,0.75-0.75S24.6640625,18.25,24.25,18.25z M6.8164063,20.5087891   c-0.8320313,0-1.5087891-0.6767578-1.5087891-1.5087891s0.6767578-1.5087891,1.5087891-1.5087891   c0.8310547,0,1.5078125,0.6767578,1.5078125,1.5087891S7.6474609,20.5087891,6.8164063,20.5087891z" fill="currentColor"/></g></svg> <?php echo $conntroller->tag->getTag('filters','Filters');?> </a></li>
		<li class="widht-40"><a href="<?php echo $app->createUrl('place_an_ad/create');?>" class=""  style="color:var(--secondary-color) !important"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="14" height="14" x="0" y="0" viewBox="0 0 448 448" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0" fill="currentColor" data-original="#000000" style=""/></g></svg> <?php echo $conntroller->tag->getTag('property','Property');?></a></li>
		<li class="widht-20"><a class="nav-link count-indicator"   id="messageDropdown" style="color:var(--secondary-color) !important;position:relative;display: block;max-width:31px;margin:auto; " href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="vertical-align:middle;position: relative;top: -2px;" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M469.585,80.732c-55.679-52.984-146.306-52.984-202.003-0.012l-11.581,11l-11.569-10.995 c-55.703-52.979-146.318-52.973-202.021,0C15.061,106.739,0,141.244,0,177.874c0,36.642,15.061,71.141,42.415,97.166 l201.219,191.033c3.461,3.294,7.917,4.934,12.366,4.934c4.449,0,8.899-1.647,12.366-4.94l201.219-191.027 C496.933,249.021,512,214.517,512,177.88C512,141.244,496.933,106.745,469.585,80.732z M444.829,248.991L256,428.269 L67.177,248.997C47.026,229.835,35.93,204.576,35.93,177.88s11.096-51.955,31.247-71.117 c21.019-20.001,48.625-29.995,76.237-29.995c27.618,0,55.236,10.006,76.255,30.007l23.953,22.75c6.934,6.593,17.815,6.593,24.75,0 l23.959-22.762c42.044-39.996,110.448-39.996,152.492,0c20.145,19.163,31.247,44.421,31.247,71.117 S464.968,229.829,444.829,248.991z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg><span class="badge header-saved-properties__counter dataCounter-fav" style="bottom:unset;top:15px;" id="dataCounter" ><?php echo $conntroller->fav_count;?></span></a></li>
		</ul>
		</nav>
		<div class="clearfix"></div>
</div>
<link href="<?php echo $conntroller->assetsUrl.'/css/minified_new.min.css' ;?>" rel="stylesheet">
<style>

 
@media only screen and (max-width: 720px){
#pageNav .pageMainNav>.active>a, #pageNav .pageMainNav>.active>a:focus, #pageNav .pageMainNav>.active>a:hover,   .pageMainNav.nav.pageMainNav2>li.active>a, .pageMainNav.nav.pageMainNav2>li>a:active, .pageMainNav.nav.pageMainNav2>li>a:focus, .pageMainNav.navbar-default.pageMainNav2>li>a:active, .pageMainNav.navbar-default.pageMainNav2>li>a:focus, .pageMainNav.navbar-default.pageMainNav2>li>a:hover, .pageMainNav.pageMainNav2>li>a:active, .pageMainNav.pageMainNav2>li>a:hover {
    
    color: var(--secondary-color)!important;
   
    background-color: #fff1dc!important;
 
}.menuIsActive #pageNav .pageMainNav {
    
    overflow: hidden;
}
}
</style>
<div class="mobile_bottom_filter">
   <div class="mobile_bottom_shortlisted_container">
      <div class="desktop-title"> <?php echo $conntroller->tag->getTag('my_favorite_properties','My Favorite Properties');?> <span class="fa fa-close srtbtn pull-right" onclick="closeShortlistPop(this)"></span> </div>
      <div class="hide" id="emptyResults" ><img src="<?php echo $app->apps->getBaseUrl('assets/img/love2.png');?>" class="nofav-img"><span class="nofav-text"><?php echo $conntroller->tag->getTag('no_favorite_properties','No Favorite Properties');?></span></div>
      <div class="list" style="display: block;">
		  <div id="lodivScro"></div>
         <ul id="shortlist_items" class="listings drawer-items" style="max-height:calc(100vh - 65px);">
         </ul>
      </div>
      <div id="ldmore"></div>
   </div>
   <div class="clear"></div>
</div>
<script>
	var stopPaginationFav;
	var loadingHtmlFav    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div></div></div>';
	var	loadMoreHtmlFav 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   onclick="checkScrollFav();"  ><?php echo $conntroller->tag->getTag('load_more','Load More') ;?></a>';  
	var afterFinishHtmlFav = '';   
	var scrollFav=true;
	var limitFav='20';
	var offsetFav ='0';
	var stopPaginationFav;
	var checkFutureFav = true ;
	var loadingDivFav ;
	$(document).ready(function () {
	loadingDivFav  =  $('#lodivScro');
	});
	var currentPageFav = 1;
	var slugFav ='<?php echo $app->createUrl('listing/fav_properties');?>';
	var deleteFav ='<?php echo $app->createUrl('user/remove_properties');?>';
</script>
