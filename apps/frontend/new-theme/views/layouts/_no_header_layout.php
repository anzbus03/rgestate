<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/new_secure_style.css?q=25');?>" />
<style>
 #signin-form input[type="password"].form-control.LJB { padding :0px 18px; text-indent:0px; }
.bg-bk{max-width:100%; width:485px;  margin:0px auto 15px;      border-radius: 5px; }
 @media only screen and (max-width: 768px) {
     .myaccount-menu.is-ended.for-mobile{    z-index: 11;}
     .for-mobile.myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation{padding:5px 0px;}
     .for-mobile.myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation li .myaccount-menu__label {  color: var(--secondary-color) !important; }
     .list-unstyled.myaccount-menu-navigation li a {  color: var(--secondary-color); }
  .col-sm-5 {
    width: 41.66666667%;
    }
    .col-sm-7 {
    width: 58.33333333%;
}
 .col-sm-7 {
    width: 50%;
}
 .col-sm-12 {
    width: 100%;
}
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    float: left;
}
 
html[dir="rtl"] .col-sm-1,html[dir="rtl"] .col-sm-2,html[dir="rtl"] .col-sm-3,html[dir="rtl"] .col-sm-4,html[dir="rtl"] .col-sm-5,html[dir="rtl"] .col-sm-6,html[dir="rtl"] .col-sm-7,html[dir="rtl"] .col-sm-8,html[dir="rtl"] .col-sm-9,html[dir="rtl"] .col-sm-10,html[dir="rtl"] .col-sm-11,html[dir="rtl"] .col-sm-12 {
    float: right;
}
html[dir="rtl"] .card-1 h3 { 
    text-align: right !important;
}
.bg-bk{max-width:100%; width:100%;  margin:0px auto 15px;      border-radius: 5px; }
#PlaceAnAd_category_id_main_div .subHeadh2 { padding-top:0px; }
.amlabel .form-check {
    width: 50% !important;
   
}
}
 @media only screen and (max-width: 400px) {
._1SuBk{
    max-width: 30%;
}
._1mplE{ max-width: 30%;}
}
html[dir="rtl"] body#place_an_ad { overflow-x: hidden; }
</style>
<div class=" container bg-bk   card-1" style="">
		 
 <div class=" " style="padding:15px 0px;" id="magnificathead" data-test="1">
					<div class="col-sm-12 destination-sr-header__col destination-sr-header__content text-center">
					 <div class="pull-left" style="width:calc(50% - 50px)">&nbsp;</div> 
					 <div class="pull-left" style="width:100px">
					<a href="<?php echo Yii::App()->createUrl('site/index');?>"><img src="<?php echo Yii::app()->apps->getBaseUrl($this->logo_path);?>" alt="<?php echo $this->project_name;?>" style="height:75px;margin-top:-15px;margin-bottom:-15px;     max-width: 100%"></a>
					</div>
					 <div class="pull-left" style="width:calc(50% - 50px)">
					<?php
				 
				
					if(!empty($member)){  
					    ?>
					    <style>.ml-auto { display:none;}
					    
                            .destination-sr-header__content.text-center { text-align:left !important; margin-left:10px; }
                            .destination-sr-header__content.text-center a {     display: block;    float: left;    max-width: 140px;width: 100%;}
                          
                            .open .dropdown-menu { display:block !important;}
                             .navbar.default-layout .navbar-menu-wrapper .navbar-nav {
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.ml-auto, .mx-auto {
    margin-left: auto !important;
}
.navbar-nav {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}.nav .nav-item.dropdown .navbar-dropdown .dropdown-item, .navbar-nav .nav-item.dropdown .navbar-dropdown .dropdown-item{
    padding: 10px 15px;
}
.ml-auto { display:initital;}
                            @media only screen and (max-width: 600px) {
.dropdown-menu.dropdown-menu-right {
    left: 0 !important;right: 0 !important;float: none;
}
}

</style>

   
					    <script>
					        function toglleCl(k,e){ e.stopPropagation(); e.preventDefault(); $(k).closest('.user-dropdown').toggleClass('open'); }
					    </script>
					     <ul class="navbar-nav ml-auto  pull-right margin-right-15" style="">
			  
		 
            <li class="nav-item dropdown  user-dropdown ">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"  onclick="toglleCl(this,event)"  aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown" >
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $member->fullName;?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $member->TypeTile;?></p>
                </div>
                    <a class="dropdown-item"    href="<?php echo Yii::app()->createUrl('member/dashboard');?>"><?php echo $this->tag->getTag('dashboard','Dashboard');?><i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item"    href="<?php echo Yii::app()->createUrl('member/update_profile');?>"><?php echo $this->tag->getTag('account_settings','Account Settings');?><i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('user/logout',array('slug'=>$member->slug));?>"><?php echo $this->tag->getTag('sign_out','Sign Out');?><i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
					    <?
					    
					}
					?>
						</div>
					 
					</div>
				 
					 <div class="clear"></div>
					</div>
                <div id="loader_againn load" style="position: relative;"><div class="spinner rmsdf">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
                </div></div>
				<div id="pajax">
			
				<?php echo $content;?> 
				</div>
				
					</div> 
 <Style>
 .load ..rmsdf.spinner{ display:block; }
     .bold-style { font-size:16px; line-height:22px; font-weight:700; color:#222;}
     
 </Style>
 <script>
 $(function(){
     $('form :input').on('focus',function(){  $(this).parent().parent().find('.errorMessage').hide();  })
     $('form :input').on('change',function(){  $(this).parent().parent().find('.errorMessage').hide();  })
      
     
     
 })
     function loadUrl(k){ 
			var containerID =  document.getElementById('pajax');
			 
			mainListUrl1 = $(k).attr('data-url') ;	   
			 
			$('#loader_againn').html('<div class="prtent-ldr"></div><div class="loadingio-spinner-ellipsis-n4kzvqdhng"><div class="ldio-jcf5iatyj88"><div></div><div></div><div></div><div></div><div></div></div>')
			  
			$.pjax({url: mainListUrl1 , container:containerID,  timeout: 110000 ,cache:false   }).complete(function(){		});
			 
			
			
			}
     
 </script>
