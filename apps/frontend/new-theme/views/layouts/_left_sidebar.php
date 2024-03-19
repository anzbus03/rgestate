<?php $apps = Yii::app()->apps; $member = $this->member ; ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar"  >
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link avatarHover">
              <div class="profile-image"> <a href="<?php echo Yii::App()->createUrl('member/dashboard',array('slug'=>$member->slug));?>"><img src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" style="width:124px;" alt="image"/></a>
             <a href="<?php echo Yii::app()->createUrl('member/my_avatar',array('slug'=>$member->slug));?>" class="  actra" style="padding:1px;position:absolute;top:70px;left: 15px;right: 0;font-size:10px;font-weight:normal;">Change</a> </div>
              <div class="profile-name">
                <p class="name"><?php echo $member->fullName;?></p>
                <p class="designation"><?php echo $member->TypeTile;?></p>
                
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="<?php echo Yii::app()->createUrl('member/dashboard');?>"><img class="menu-icon" src="<?php echo $apps->getBaseUrl('frontend/img/menu_icons/01.png');?>" alt="menu icon"><span class="menu-title">Dashboard</span></a></li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="<?php echo $apps->getBaseUrl('frontend/img/menu_icons/08.png');?>" alt="menu icon"> <span class="menu-title">My   Listings</span><i class="menu-arrow fa fa-angle-down"></i></a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/W');?>">Waiting Approval</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/R');?>">Rejections</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/A');?>">Published</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/I');?>">Inactive</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item"  ><a class="nav-link" href="<?php echo Yii::app()->createUrl('member/favourite');?>"><img class="menu-icon" src="<?php echo $apps->getBaseUrl('frontend/img/menu_icons/download.png');?>" alt="menu icon"> <span class="menu-title">My Favoutrite</span></a></li>
          <li class="nav-item"  ><a class="nav-link" href="<?php echo Yii::app()->createUrl('member/searches');?>"><img class="menu-icon" src="https://png.icons8.com/color/50/000000/search.png" alt="menu icon"> <span class="menu-title">My Searches</span></a></li>
        
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="<?php echo $apps->getBaseUrl('frontend/img/menu_icons/settings.png');?>" alt="menu icon"> <span class="menu-title">Settings</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="settings">
              <ul class="nav flex-column sub-menu">
				<?php
				if($member->FillPersonalInformation){ ?>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/profile_settings',array('slug'=>$member->slug));?>">Personal Information</a></li>
				<?php } ?> 
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/my_avatar',array('slug'=>$member->slug));?>">Change avatar</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/account_settings',array('slug'=>$member->slug));?>">Account Settings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo Yii::app()->createUrl('user/logout',array('slug'=>$member->slug));?>">Logout</a></li>
              </ul>
            </div>
          </li>
          <?php
          /*
          <li class="nav-item"  ><a class="nav-link" href="<?php echo Yii::app()->createUrl('members/profile',array('slug'=>$member->slug));?>"><img class="menu-icon" src="<?php echo $apps->getBaseUrl('frontend/img/menu_icons/03.png');?>" alt="menu icon"> <span class="menu-title">My Page</span></a></li>
          */
          ?>
          <li class="nav-item purchase-button"><a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>"  >List Property</a></li>
        </ul>
      </nav>
     
<style> .actra{ display:none; }.avatarHover:hover .actra{ display:block; }</style>
