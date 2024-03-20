<header id="header-container">
   <!-- Header -->
   <div id="<?php echo  $conntroller->header_class;?>" class="sub" >
      <div class="container-fluid">
         <!-- Left Side Content -->
         <div class="left-side">
            <!-- Logo -->
            
				<div id="logo"> 
					<a href="<?php echo Yii::app()->createUrl('advertisement/details',array('slug'=>'home'));?>"><img src="http://www.rsworkspace.com/workspace/html/askaan/13/images/logo-2-slick.png" style="width:90px;" alt=""></a> 
					<a href="" style="display:block;line-height: 5px;font-size: 10px;letter-spacing: 3px;margin-left: 8px;">Advertising</a>
				</div>
           
			 
             <div class="mmenu-trigger">
               <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
            </div>
            <!-- Main Navigation / End --> 
         </div>
         <style>
         #navigation ul ul li { text-align:left; } 
         #navigation ul ul   { margin-top:0px; } 
         #navigation ul ul li {  width: 210px; }
         </style>
         <!-- Left Side Content / End --> 
         <!-- Right Side Content / End -->
         <div class="right-side">
            <!-- Mobile Navigation -->
            <!-- Main Navigation -->
            <div class="header-widget">
               <nav id="navigation" class="style-1">
                  <ul id="responsive">
				 
					<?php
					if(!empty($spec)){ ?>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Ad Specs<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 
						foreach($spec as $k=>$v){
							echo '<li><a href="'.Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'">'.$v->title.'</a></li>';
						} 
						?>
					</ul>
					</li>
					<?php } ?> 
				
					<?php
					if(!empty($solutions)){ ?>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Solutions<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 
						foreach($solutions as $k=>$v){
							echo '<li><a href="'.Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'">'.$v->title.'</a></li>';
						} 
						?>
					</ul>
					</li>
					<?php } ?> 
						<?php
					if(!empty($guide)){ ?>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Guidelines<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php 
						foreach($guide as $k=>$v){
							echo '<li><a href="'.Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'">'.$v->title.'</a></li>';
						} 
						?>
					</ul>
					</li>
					<?php } ?> 
                     <li><a href="<?php echo Yii::app()->createUrl('advertisement/contact');?>">Conact Us </a></li>
                  </ul>
               </nav>
               
            </div>
         </div>
         <!-- Right Side Content / End --> 
         <!-- Sign In Popup -->
         <!-- Sign In Popup / End --> 
      </div>
   </div>
   <!-- Header / End --> 
</header>


