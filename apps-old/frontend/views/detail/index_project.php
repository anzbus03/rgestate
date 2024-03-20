<style>
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-group {
    margin-bottom: 15px;
}
.swiper-slide  h2{
    font-size:30px;
    color: #ffffff;
    text-shadow:1px 1px 1px #000; 
}
.a-Button:focus::after, .t-Button:focus::after, .a-Button:not(.t-Button--link):hover::after, .t-Button:not(.t-Button--link):hover::after {
    opacity: 1;
    transform: translateY(0);
}
.a-Button::after, .t-Button::after {
    z-index: -1;
    box-shadow: 0 2px 1px rgba(0,0,0,0.075);
    transform: translateY(-2px);
}
a.t-Button { background: #eee;
padding: 10px !important;
line-height: 23px;
margin-left: 2px;
font-size: 12px !important; }
a.t-Button  .fa { font-size:12px !important;}
 h5 {
    color: #F15B61;
}
</style>
<style>
			.optionGallery {font-size:18px;position:absolute;top:100vh;z-index:100 !important;left: 50px;}
			.optionGallery2 {font-size:18px;position:absolute;top:73px;z-index:100 !important;right: 10px;}
		</style>
<div style="width:100%;overflow-x:hidden;">
<!--Home start-->
<section id="home" style="clear: both;">
   <!-- slider start -->
    <div id="slider" >
		<?php $this->renderPartial('new_development/project_top_form');?>
		<?php
		if(Yii::app()->request->urlReferrer){ ?>
			 <?php
	   $referer = $_SERVER['HTTP_REFERER'] ;
	  
	   if( strpos( $referer, '/properties' ) !== false ) {
			$return_url = $_SERVER['HTTP_REFERER'];
		} 
		else{
			 if(in_array($model->section_id,array('new-development','property-for-sale','property-for-rent'))){
				  $return_url =  $this->app->createUrl($model->sec_slug).'/state/'.$model->state_slug;;
			 }
			 else{
				  $return_url =  $this->app->createUrl('listing/index').'/sec/'.$model->sec_slug.'/state/'.$model->state_slug;
			 }
		}
	  ?>
		 <a href="<?php echo $return_url;?>" style="position:absolute;left:50px;top:73px;z-index:1010;color:#fff">
                                             &lt;&lt; back 
                                             </a> 
		<?php } ?>
		<div  class="optionGallery">  
                                             <a class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" href="#_details">
                                             <span aria-hidden="true" class="fa fa-info-circle" style="font-size: 19px;"></span> <span class="icon_title">Details</span>
                                             </a>    
                                             <a href="#_map" title="Map" class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" style="font-size:12px;">
                                             <span aria-hidden="true" class="fa fa-map-marker"></span> <span class="icon_title">Map</span> </a>
                                             <a href="#_gallery" title="Floor Plans" class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" style="font-size:12px;">
                                             <span aria-hidden="true" class="fa fa-photo"></span> <span class="icon_title">Gallery</span> </a>
                                             <?php
                                             if(!empty($floor)){ ?>
                                             <a href="#_floor_plans" title="Floor Plans" class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" style="font-size:12px;">
                                             <span aria-hidden="true" class="fa fa-fit-to-size"></span> <span class="icon_title">Floor Plans</span> </a>
                                             <?php } ?>
                                             	<div class="clearfix"></div>

                                          <div class="clearfix"></div>
                                          </div>
       												 <div class="miniCol14 smlCol8 lrgCol5 pan optionGallery2" >
												<div class="floatRight pvxs">
												<span data-role="coShoppingContainer">
												<span data-reactroot="">
												<span class="mrxs">
												<div style="display: inherit;"><button data-test-id="PDPSaveButton" id="fav_button_<?php echo $model->id;?>"  class="phl btn btnSml btnDefault phmXxsVisible <?php echo !empty($model->fav) ?  'active' : '';?> "  onclick="<?php if($this->app->user->getId()){ echo 'savetofavourite(this)'; }else{ echo 'OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $model->primaryKey;?>"  data-after="saved_fave"  ><?php if(!empty($model->fav) ){ echo '<i class="iconHeart" ></i>'; } else{ echo '<i class="iconHeartEmpty" ></i>';} ?><span class=""><?php  if(!empty($model->fav) ){ echo 'Saved';} else { echo 'Save'; } ?></span>   </button>
												</div>
												</span>
												<span><button id="PDPShareButton" class="iconMail phl btn btnSml btnDefault phmXxsVisible" onclick="$('#share_widget').toggle();" ><span class="">Share</span>
												</button>
												<div style="position:relative;">
												<div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style"  id="share_widget" style="right: 0px; top: 0px; line-height: 32px; position: absolute; background: #fff; text-align: center; margin: auto; box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16),0 0 0 1px rgba(0,0,0,0.08);;display:none;">
												<a class="a2a_button_google_plus"></a>
												<a class="a2a_button_facebook"></a>
												<a class="a2a_button_twitter"></a>
												 
												</div>
												</div>
												<script async src="https://static.addtoany.com/menu/page.js"></script>


												</span>
												</span>
												</span>
												</div>
												</div>
											
        <div class="swiper-container main-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background: url('https://www.askaan.com/uploads/images/<?php echo $image;?>');background-repeat:no-repeat;height:100vh; " >
                    <div class="container">
                        <div class="slider-content left">
							<h2><?php echo $model->ConstructionTitle;?> <span><?php echo $model->category_name;?>   <br>  </span> Starting from <br><span><?php echo $model->priceTitle;?>*</span></h2>
                            <!--<div class="buttons-group" >
                                <a href="#" class="btn button  normal">Learn More</a>
                                <a href="#work" class="scroll btn button special">Getting Started</a>
                            </div>-->
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                  <div style="clear:both"></div>

            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div class="swiper-button-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
               <div style="clear:both"></div>
        </div>
           <div style="clear:both"></div>
        
    </div>
   <!-- slider end -->
</section>   <div style="clear:both"></div>
<!--Home end-->

<!-- About us Section start -->
<div id="overview">

    <!--about-us-1 start-->
    <div  class="about-us-1 " style="padding-top:50px;padding-bottom:50px;" id="_details">
        <div class="container">
         
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="section-top-heading" style="margin-bottom:0px;">
                        
                        <h2 class=" text-center">Overview</h2>
                          <div class="col-lg-12" style="padding-left: 0px;">
         <div class="miniCol24 xsCol24 smlCol24 mhn phn spantopmar50">
            <div class="bbs mbl homeDetailsHeading">
               <span class="h5 prm backgroundBasic">Overview</span>
            </div>
        <?php $this->renderPartial('_common_details');?>
         </div>
      </div>
     
     <div class="clearfix"></div>
                    </div>
                </div>

            </div>
            
         </div>
    </div>
    <!--about-us-1 end-->




</div>
<!-- About us Section end -->

<?php $this->renderPartial('new_development/_map'); ?>
<?php $this->renderPartial('new_development/_gallery'); ?>


<!--pricing table end -->
<?php // $this->renderPartial('new_development/floor_background');?>
<?php 
if(!empty($floor)){  
$this->renderPartial('new_development/_payment_plan');
}
?>
<?php $this->renderPartial('new_development/_bottom_contanct_form');?>
<div class="clearfix"></div>
</div>
 <div class="clearfix"></div>

 
