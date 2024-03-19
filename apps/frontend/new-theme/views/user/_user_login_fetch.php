<?php 
$conntroller = $this;  ?> 
<div class="newheader_dropdown_action" data-tr-event-name="header_user_account" data-header-id="profile">
						<a href="javascript:void(0)" class="newheader_dropdown_action_item header_link" data-ui-id="user-account"><img src="<?php echo $conntroller->mem->getAvatarUrl( 124, '',  true); ?>" class="newheader_useravatar_letter"><span class="newheader_useravatar_name"><?php echo $conntroller->mem->fullName;?></span><div class="newheader_dropdown_action_item_after"></div></a>
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="newheader_dropdown_arrow">
						<path fill="currentColor" d="M6 5.869l1.634-1.635a.8.8 0 1 1 1.132 1.132l-2.2 2.2a.8.8 0 0 1-1.132 0l-2.2-2.2a.8.8 0 1 1 1.132-1.132L6 5.87z"></path>
						</svg>
						<div class="newheader_dropdown_container newheader_dropdown">
						<ul class="newheader_dropdown_items">
							<?php
							if(Yii::app()->user->getState('user_type','') != 'U'){ ?> 
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
<?php
