<div class="home-banner-outer">
                         
         <div class="main-search-container dark-overlay home" >
            <div class="main-search-inner">
            <div class="slider-form">
            <div class="container">
               <h2 class="text-left mb-5" id="nban_tit"><?php echo $this->options->get('system.common.agent_banner_title','');?></h2>
            
                   
                   <div class="tab-content hom-content" data-select2-id="14">
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
					 
					 <?php $this->renderPartial('_home_agent_search');?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     </div>
                   
                  </div>
             
             
            </div>
         </div>
         <style>
			.main-search-inner { top:40%; }
			.slider-form {
			left: 15%;
			position: absolute;
			right: 15%;
			top:27%;
			} 
         </style>
            
             </div>
            <!-- Video -->
            <div class="video-container">
              <?php 
              
              $banners =   $this->banners;
               if( $banners){
				 ?>
				<div class="row fullwidth">
				<div class="columns small-12 slider">
					<?php 
					foreach($banners as $k=>$v){
					?>
					<div class="text-center slide" style="  background-image: url('<?php echo $v->BannerLink;?>'); "></div>
					<?php } ?> 
		 
				</div>
				</div>
					   <?
				   
				}; ?>

     <style>
 .video-container .slider { border-radius:  0px; background:#000;} 
  </style>
  <script>
  
  $(function(){
	  $('.slider').slick({
      dots: false,
        autoplay: true,
        autoplaySpeed: 7000,
     
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        lazyLoad: 'ondemand',
        lazyLoadBuffer: 0,
      mobileFirst: true,
       prevArrow: false,
    nextArrow: false
    });
	  
	  })
  
  
  </script>
            </div>
		
         </div>
         <script>
			 var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
         $(function(){ $('select.select2').select2();    })
			  
			  $(function(){
				  closeOpendDiv()
				  
				  })
         </script>
         
         <div class="clearfix"></div>
</div>

<script>var is_home=true; </script>
<div class ="container home_container">

<!-- Content
            ================================================== -->
         <!-- Category Boxes -->
         
         
       <style>  .item_ko:nth-child(4n+1){ clear:both; }  .developer_logo { position: absolute;right: 7px;bottom: 57px;z-index: 1111;}
       </style>
       <div class="home_section">
		   <div class="clearfix"></div>
        	<?php $this->renderPartial('//site/_featured_developers');?> 
        	 <div class="clearfix"></div>
         
		<div class="clearfix"></div>
		</div>
       
<div class="clearfix"></div>
</div>
	 
