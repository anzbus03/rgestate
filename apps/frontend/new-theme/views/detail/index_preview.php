<style>
.facts_heading svg {
    color: var(--black-color);
    font-weight: bold;
    width: 20px !important;
    height: 20px !important;
}
#detail .facts_heading {
    font-size: 23px;
}
html  .user_details.only-mob  { display:none !important; }
html #share_widget {  top: 35px; } 
html[dir="rtl"] #share_widget {    left: -10px;border:1px solid #eee;}html[dir="ltr"] #share_widget {    right: -13px;border:1px solid #eee;}
</style>

<script>
function openThisPopupImg(k){
	 $('body').addClass("openimage");
	var moveid = $(k).attr('data-moveto');
	  $('#details-page-container').animate({
        scrollTop: $("#"+moveid).offset().top
    }, 2000);
	
	 } 
function closeThisPopupImg(){ $('body').removeClass("openimage");$('body').removeClass("openamenity"); }
</script>
  <style> body.openimage,body.openamenity{ overflow-y:hidden !important;}
   body.openimage .openimagediv{  display:block;height:100vh;overflow-y:scroll; width:100%;position:fixed;z-index:99999;left:0;right:0;top:0;bottom:0;background:#fff;} 
   .openimagediv { display:none;} 
   </style>
 <?php 
if($hasedit){
?>	
<div id="myModalAdmin" class="modal bd-example-modal-lg fade" data-backdrop="static"  role="dialog" aria-labelledby="myModalAdminLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body" id="myModalAdmin_prop">
       <div class=" " id="myModalAdmin_prop_html" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>  
<?php } ?><?php
if (Yii::app()->request->isAjaxRequest) {
	?><script>$('body').attr("id","detail");$('body').attr("id","detail");$('#pageHeader').removeClass('boxshdw');   document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0;</script>
  
  

  
	<title><?php  echo  $pageTitle ;  ?></title>
	  	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
	<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
      <meta property="fb:app_id" content="<?php echo $this->options->get('system.common.facebook_app_id');?>">
      <meta property="og:site_name" content="<?php echo $this->options->get('system.common.site_name');?>">
      <meta property="og:title" content="<?php echo $title;?>">
      <meta property="og:description" content="<?php echo $description;?>">
      <meta property="og:type" content="article">
      <meta property="og:url" content="<?php echo  $shareUrl;?>">
      
		<meta property="og:image" content="<?php echo 'https://www.rgestate.com/theme/assets/images/logo.svg'; ?>"/>
		<meta property="og:image:secure_url" content="<?php echo 'https://www.rgestate.com/theme/assets/images/logo.svg'; ?>"/>
		<meta property="og:image:width" content="1200">
		<meta property="og:image:height" content="420">
		<meta property="og:locale" content="en_US">
      
        <meta name="twitter:widgets:csp" content="on">
        <meta name="twitter:card" content="photo">
        <meta name="twitter:url" content="<?php echo  $shareUrl;?>">
        <meta name="twitter:image" content="<?php echo $image;?>">
        <meta name="twitter:title" content="<?php echo $title;?>">
        <meta name="twitter:description" content="<?php echo $description;?>">
        <meta name="twitter:site" content="<?php echo $this->options->get('system.common.site_name');?>">
	<?php 
}
 
       $showTrash = Yii::app()->request->getQuery('showTrash','0')  ;
       $admin     = Yii::app()->request->getQuery('admin','0')  ;
	   $referer = $this->app->request->urlReferrer ;
	   if( strpos( $referer, '/properties' ) !== false ) {
			$return_url = $_SERVER['HTTP_REFERER'];
		} 
		else{
		    $return_url =   $this->app->createUrl('listing/index',array('sec'=>$model->sec_slug));
		    /*
			 if(in_array($model->section_id,array('new-development','property-for-sale','property-for-rent'))){
				  $return_url = Yii::App()->createUrl('listing/index',array('sec'=>$model->sec_slug)); 
			 }
			 else{
				  $return_url =   Yii::App()->createUrl('listing/index',array('sec'=>$model->sec_slug,'state'=>$model->state_slug)); 
			 }
			 */
		}
		 $images = $image_array;
		 
		
?>
<style>
#PDPShareButton.sdshre { color:var(--secondary-color);width:22px;height:22px;}
.favbtn.mdetidnn.lastref {width:22px;height:22px;  }
.favbtn.mdetidnn.lastref i {font-size:22px !important;   }
</style>
 
<div style="position:relative;" id="its_detail_page" class="<?php echo $model->section_id == '2' ? 'rentSEct' : '';?>">
 
<script>
//var timer_ajax; 
//var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index');?>/';
//var autoCompleteUrl = '<?php echo Yii::app()->createUrl('detail/autocomplete');?>';

 
</script>


 
<div class="detail_container sec_type_<?php echo $model->section_id;?>">
<div class="col-sm-12">
	<?php // $this->renderPartial('_top_bar_when_scroll'); ;?>
<!-- NAV End -->
<div class="clearfix"></div>
	<div class="row">
    <div class="col-sm-12" id="wrapper3">
            <!-- Slider -->
           <?php 
           $location_image = false;
         
            if($images){ ?>
            <div class="property-slider2 default  "  style="position:relative;">
				<span class="seec_b rfr"> 
									
					 <div class="tagsListContainer "  >
										<ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $model->getTagList('F');?></ul>
										</div> 
				</span>
				<style>
				.det-ne { right:15px !important; }
				.det-ne #PDPShareButton { position: relative;  right: 0px;   top: -3px;}
				html .det-ne #share_widget {    top: 31px;       right: 0px;}
				.mdetidnn.favbtn{   margin-right:10px;  visibility: visible !important;    background: #fff;   border: 1px solid #e8e1e0 !important; color: var(--logo-color);    width: 40px;    height: 40px;    display: inline-block;    text-align: center;    font-size: 20px;    border-radius: 5px;border:0px;    /* margin-top: 10px; */ }
				html #PDPShareButton img {    margin-top: 0px;    width: 20px; }
				
				.mdetidnn.favbtn{margin-right:1px;visibility:visible!important;background:#fff;color:var(--logo-color);width:37px;height:32px;display:inline-block;text-align:center;font-size:20px;border-radius:5px;border:0; line-height:32px;vertical-align:middle;text-align:center}
				html .det-ne #share_widget {    top: 35px;    right: -4px;}
				#PDPShareButton{z-index:1;background:#fff;border: 1px solid #e8e1e0 !important;width:37px;height:32px;border-radius:4px;line-height:1;top:unset!important;vertical-align:middle;margin:0}
				@media only screen and (max-width: 600px) {
				.det-ne .mainBtn-share {    position: INITIAL !important;    right: unset !important;    top: unset !important; }
				.det-ne {  position: absolute;  top: unset  !important;  bottom:252px;   width:80px !important; ; } 
				html .det-ne #share_widget {
    top: 40px;
				}
				.mdetidnn.favbtn {    }
				.det-ne #PDPShareButton {
 
    top: 0px;padding: 0px 5px 0px 5px !important;  margin-left:2px; 
}
				.mdetidnn.favbtn { margin-right:0px;font-size: 22px;}
				}
				</style>
			
					   <script>
        
            $(function(){
				
                const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();
   nslider2();
		   fancyclgroup();
		    
                
            })
            </script>
                <div class="nslider" style="position:relative;">
				<?php 
				 if(!empty($location_image)){
				     	$image_url =  $this->app->apps->getBaseUrl('uploads/map/'.$model->location_image)  ;
				        ?>
				           <a href="<?php echo $image_url;?>"    class="item   spch">
				               <img src="<?php echo $image_url;?>" style="height:450px;">
				               
				           </a> 
            
				        <?
				        $images =array(); 
				 }
				 else{
					 $c = '1';$html_c ='';$sizeOf1 = sizeOf($images);
				foreach($images as $image){
				//	$image_url =  $this->app->apps->getBaseUrl('uploads/images/'.$image->image_name)  ;
			    	$status =   'A'  ; 
		        	$image_url =   $model->getdetailImages($image,$status )  ;
		        	$image_url2 =  $this->app->apps->getBaseUrl('uploads/files/'.$image)  ;
				
					$html_c .= '<div class="prp_img" id="prop_img'.$c.'"><img data-src="'.$image_url2.'" class="lozad" > <div><span class="imgc">'.$c.'/'.$sizeOf1.'</span></div><div class="clearfix"></div></div>';
					
				?>
               <a href="javscript:void(0)" data-moveto="prop_img<?php echo $c;?>"     class="item   spch"><img data-src="<?php echo $image_url2;?>" class="lozad"  ></a> 
               
               <?php  $c++; }
               
				 }
               ?>
               </div>
                      <div class="HomeDetailsHero__HeroFooter-hubkl0-5 hIfUYc sizi-<?php echo sizeOf($images);?>"><button type="button" data-testid="hdp-hero-photo-count"   class="Button__ButtonBase-sc-1ea9wz-0 Button-sc-1ea9wz-1 HomeDetailsHeroCta__HeroCta-sc-35yfrg-0 jQnIeH"><div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe"><div class="ui__SvgContainer-sc-1z03173-0 dlXmJI"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><g fill="#ffffff" fill-rule="nonzero"><path d="M2.5 2.5V13H13V2.5H2.5zm-.5-1h11.5a.5.5 0 0 1 .5.5v11.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V2a.5.5 0 0 1 .5-.5z"></path><path d="M13.5 10a.5.5 0 1 1 0 1H2a.5.5 0 1 1 0-1h11.5zm-7-7a1.75 1.75 0 1 1 0 3.5H5a1.25 1.25 0 0 1-.078-2.498A1.746 1.746 0 0 1 6.5 3zm0 1a.747.747 0 0 0-.736.63.5.5 0 0 1-.673.389.248.248 0 0 0-.341.231c0 .138.112.25.25.25h1.5a.75.75 0 1 0 0-1.5z"></path><path d="M9.076 6.664c.536-.919 1.88-.874 2.353.076l1.768 3.536a.5.5 0 1 1-.894.448l-1.77-3.537a.339.339 0 0 0-.594-.019L8.432 9.752a.5.5 0 0 1-.848.025 3.957 3.957 0 0 0-.58-.66C6.58 8.726 6.149 8.5 5.75 8.5c-.324 0-.752.372-1.175 1.022a7.385 7.385 0 0 0-.61 1.164.5.5 0 0 1-.93-.372 8.366 8.366 0 0 1 .701-1.337C4.331 8.066 4.981 7.5 5.751 7.5c.696 0 1.341.337 1.933.883.089.082.171.163.248.243l1.145-1.962z"></path></g></svg></div><div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE" style="margin-left:2px !important;"><span color="inverse" data-testid="photo-count" class="Text__TextBase-sc-1cait9d-0 bqfOkU"><?php echo sizeOf($images);?></span></div></div></button></div>
                <div style=""   class="detailAbs">
            <?php
            if(!empty($video_list)){ ?> 
			<?php  if($model->view_360){  ?>
			 <span class="spn-r-round view-360"   onclick="openVideoFram()" ></span> 
			 <?php } ?>  
			 <?php  if($model->view_video){  ?>
			 <span class="spn-r-round view-vid"   onclick="openVideoFram2()" ></span>  
			 <?php } ?> 							
			<?php
			foreach($video_list as $itm){
				?>
				<a href="<?php echo $itm->video;?>&autoplay=0" data-caption="<?php echo $itm->title;?>" data-fancybox="<?php echo $itm->video_type=='1'? 'vl-group' : 'vl-normal';?>" id="<?php echo $itm->video_type=='1'? 'vl-group' : 'vl-normal';?>" ></a>
				<?
			}
			?>
            <script>var falncyObj;var falncyObj1; $(function(){ fancyvlgroup() ; fancyvlgroup2()   })</script>
            <?php } ?> 
          
			<?php  if($model->view_floor){  ?><span class="spn-r-round view-floor"></span><?php } ?> 
           </div>
     
            </div>
            <?php } ?> 
          
          <style>
			.property-slider-nav .slick-next  {
    right: 49px !important;
}
			.property-slider-nav .slick-prev  {
    left: 49px !important;
}
			 .property-slider-nav  { height:60px; overflow:hidden;}
        .property-slider-nav .slick-slide   img {
 
     
    cursor:pointer;
   
}
          </style>
             <!-- Slider Thumbs -->
         
			 	 <?php 
			 
			if(!empty($images) and sizeOf($images)>=1 ){   ?>
			<div class="property-slider-nav margin-top-10 "  >
			<?php 
			foreach($images as $image){
				$status = 	 'A'  ; 
				$image_url =    $model->getdetailImages($image,$status , '90' )  ; ;	
			?>
			 <div class="item" style="height:60px;width:60px;padding-right:5px;"><div style="background-image:url('<?php echo $image_url;?>');background-size:cover;background-repeat:no-repeat;background-position:center;width:100%;height:100%"></div></div>   
		  
			   
		 
			<?php } ?>
			</div>
			
			
			 <div class="openimagediv">
  <div class="container">
	  
	 <div id="main-header-top" style="position:fixed;top:0px;/* width:100%; */left: 0px;right: 0px;width: 90%;margin: auto;max-width: 1100px;z-index:11;background:#fff;">
   <div data-testid="home-details-summary" class="Grid__GridContainer-sc-144isrp-1 lputZN">

	<div width="0.8,1,0.5,0.5" order="1,1,1,1"  style="order:1" class="Grid__CellBox-sc-144isrp-0 glKGZj  col-sm-5 padding-left-0">
		<h1 data-testid="home-details-summary-address" class="HomeSummaryShared__AddressH1-vqaylf-1 cmjCIx"><span data-testid="home-details-summary-headline" class="Text__TextBase-sc-1cait9d-0 dhOdUy titinc smsec_<?php echo $model->section_id;?>"><?php echo $model->adTitle;?><span class="small-lc-h"> <a href="javascript:void(0)" onclick="closeThisPopupImg()">
				<div class="BackToSearchLink__ArrowIconContainer-sc-1cnrjeu-2 cWgQaj">
					<div class="ui__SvgContainer-sc-1z03173-0 dnmcZc">
						<svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path fill="#474E52" d="M5.563 11.236l-1.28 1.28v-1.06l4.5 4.5c.707.707-.354 1.768-1.061 1.06l-4.5-4.5a.737.737 0 0 1-.218-.454.75.75 0 0 1 .218-.606l.037-.037a.736.736 0 0 1 .493-.183h1.81zm2.159-4.28a.75.75 0 0 1 1.06 1.06l-3.22 3.22h15.44a.75.75 0 1 1 0 1.5H3.752l.53-1.28 4.5 4.5-1.06 1.06-4.5-4.5a.747.747 0 0 1-.215-.442.766.766 0 0 1 .252-.655l4.463-4.463z"></path>
						</svg>
					</div>
				</div><span class="BackToSearchLink__LinkText-sc-1cnrjeu-1 fzdoeg Text__TextBase-sc-1cait9d-0 eZuzxa"><?php echo $this->tag->getTag('back', 'Back') ;?></span>
			</a> <?php if(!empty($model->area_location)){ echo '<div class="margin-bottom-5">'.$model->area_location;echo '</div>'; };?><?php echo $model->LocationTitle;?></span></span></h1> 
		
 	</div>
	<div width="0.6,0.7,0.34,0.323" order="3,2,2,2" style="order:2"   class="Grid__CellBox-sc-144isrp-0 edBXrN col-sm-4 padding-left-0 padding-right-0 pull-right">
		<h3 style="margin: 0px;" data-testid="on-market-price-details"><div class="Text__TextBase-sc-1cait9d-0-div Text__TextContainerBase-sc-1cait9d-1 hlvKRM"><?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2' and empty($model->p_o_r)){ ?><span class="dura">/<?php echo $model->getRentPaidL(1); ?> </span> <?php } ?></div></h3>
		<?php
		if(empty($model->category_id)){?>
		<div data-testid="summary-mortgage-estimate" class="Text__TextBase-sc-1cait9d-0-div SummaryMortgageInfo__EstimatedMortgageText-djttxd-0 hwlyuJ Text__TextContainerBase-sc-1cait9d-1 gniUbj"><?php echo $model->SectionListingFullTitle;?></div> 
		<?php } else { ?> 
		<div data-testid="summary-mortgage-estimate" class="Text__TextBase-sc-1cait9d-0-div SummaryMortgageInfo__EstimatedMortgageText-djttxd-0 hwlyuJ Text__TextContainerBase-sc-1cait9d-1 gniUbj"><?php echo $model->SectionCategoryFullTitle;?></div> 
		<?php } ?> 
		<div class="clearfix"></div>
	</div>
		   <div class="col-sm-3 padding-right-0 call-btn-div  pull-right mbtn-div margin-top-35 padding-left-15" style="padding:0px;order:3;  ">
       <button type="button" onclick="OpenFormClickNew(this)" data-reactid="<?php echo $model->id;?>" data-testid="lead-form-submit" style="margin-bottom:8px;float:right !important;width:48%" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA  " ><i class="fa fa-envelope"  style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('email','Email') ;?></button>
  
    <a type="button"   style="color:#fff;padding-left: 2px;padding-right: 2px;!important;float:right !important;width:48%;" onclick="OpenCallNew(this)"  data-prop="<?php echo  $model->id ;?>" data-phone="<?php echo base64_encode($model->mobile_number);?>"   data-testid="lead-form-submit"  class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA  margin-right-10"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('call','Call') ;?></a>
    
    </div>
 
 </div>
		<hr />
		</div>
	
 
	<div class="  img-cntai">
	
	<?php echo $html_c;?>
	</div>
  
  </div>
  
  </div>

			<?php  } ?> 
			<div class="clearfix"></div>
			
			
			
		
			
         </div>
 	</div>
	
	
	
		<div class="row">
<div class="col-sm-12 no-padding margin-top-15">

 <div data-testid="home-details-summary" class="Grid__GridContainer-sc-144isrp-1 lputZN">
	<div width="0.8,1,0.5,0.5" order="1,1,1,1" class="Grid__CellBox-sc-144isrp-0 glKGZj  col-sm-8 padding-left-0">
		<h1 data-testid="home-details-summary-address" class="HomeSummaryShared__AddressH1-vqaylf-1 cmjCIx"><span data-testid="home-details-summary-headline" class="Text__TextBase-sc-1cait9d-0 dhOdUy titinc smsec_<?php echo $model->section_id;?>"><?php echo $model->adTitle;?><span class="small-lc-h"><?php if(!empty($model->area_location)){ echo '<div class="margin-bottom-5">'.$model->area_location;echo '</div>'; };?><?php echo $model->LocationTitle;?></span></span></h1> 
		<div class="Box-sc-1f5rw0h-0 dNvZdu" hidden="">
			<div class="Padding-sc-1tki7vp-0 eCVEOn">
			    
			</div>
		</div>
 	</div>
	<div width="0.6,0.7,0.34,0.323" order="3,2,2,2" class="Grid__CellBox-sc-144isrp-0 edBXrN col-sm-4 padding-left-0 padding-right-0 pull-right">
		<h3 style="margin: 0px;" data-testid="on-market-price-details"><div class="Text__TextBase-sc-1cait9d-0-div Text__TextContainerBase-sc-1cait9d-1 hlvKRM"><?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2' and empty($model->p_o_r)){ ?><span class="dura">/<?php echo $model->getRentPaidL(1); ?> </span> <?php } ?></div></h3>
		<?php
		if(empty($model->category_id)){?>
		<div data-testid="summary-mortgage-estimate" class="Text__TextBase-sc-1cait9d-0-div SummaryMortgageInfo__EstimatedMortgageText-djttxd-0 hwlyuJ Text__TextContainerBase-sc-1cait9d-1 gniUbj"><?php echo $model->SectionListingFullTitle;?></div> 
		<?php } else { ?> 
		<div data-testid="summary-mortgage-estimate" class="Text__TextBase-sc-1cait9d-0-div SummaryMortgageInfo__EstimatedMortgageText-djttxd-0 hwlyuJ Text__TextContainerBase-sc-1cait9d-1 gniUbj"><?php echo $model->SectionCategoryFullTitle;?></div> 
		<?php } ?> 
		<div class="clearfix"></div>
	</div>
 </div>
	 <div class="clearfix"></div>
	    <div class="   margin-top-25 sec-head1" style="margin-top:15px !important; ">
					 
					<div class="clearfix"></div>
				 
						 <div class="flexsection"  >
					 <div class="detail_section">
					<div class="clearfix"></div>
					<?php $this->renderPartial('_detail_preview_ameniti');?>
					
						<div class="clearfix"></div>
					 
					<div class="clearfix"></div>
			
							</div>
					
						  <?php  if($b_1){ echo ' <div class="ad_section"><div class="" style="margin-bottom: 20px;margin-top:20px;">'. $b_1.'<div class="clearfix"></div></div></div>';; } ?>
                    	</div>
                    	 <div class="margin-bottom-0">
				 	</div>
					 
						
					 </div> <div class="clearfix"></div>
	
	 <div class="clearfix"></div>
				
</div>

<div class="col-sm-3 no-padding-left">
	<div class="  ">
	<?php /* <div style="height:16px" class="mb-hide-m"></div>*/ ?>
	<div class="m-mob-dip d-none-sp">
	    <style>
	  
	         
	        .br-black-1-dot { border-right:1px dotted #000 !important;margin-right: 1px;}
	        .b-r-r-m{border-top-right-radius: 3px !important; }
	         .b-l-l-m{border-top-left-radius: 3px !important; }
	    </style>
 
 
</div>
<div class="clearfix"></div>
 <div class="clearfix"></div>
  
	<div class="clearfix"></div>
	
	<?php
	if(!empty($model->location_latitude) and !empty($model->location_longitude)) { ?> 
	<div class=""  id="wrapper2" >
					<div class="right-map slimb">
                        <div class="   margin-top-0">
                        <h3 class="facts_heading" id="to_map"    ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><path d="m408.547 242.699c-3.198 6.512-6.618 12.926-10.2 19.214-1.449 2.544-.387 5.777 2.274 6.999 49.432 22.689 79.412 56.041 79.412 91.088 0 14.198-4.844 26.807-11.667 37.528-1.407 2.211-.847 5.14 1.273 6.68 5.67 4.12 10.633 9.151 14.68 14.877 1.995 2.822 6.199 2.816 8.173-.022 40.548-58.296 19.268-133.687-77.351-178.666-2.457-1.143-5.399-.131-6.594 2.302z" fill="currentColor" data-original="#000000" style=""/><path d="m432.033 424c-16.306 0-29.754 12.2-31.738 27.968-1.482.187-2.963.575-4.402 1.202-89.498 39.042-219.515 35.622-301.68-10.92-93.119-52.783-76.922-130.164 17.224-173.336 2.665-1.222 3.732-4.456 2.281-7.003-3.581-6.287-7-12.699-10.198-19.21-1.196-2.435-4.141-3.446-6.6-2.3-119.836 55.882-131.446 165.687-18.477 229.689 92 52.125 232.927 54.887 330.25 12.42 1.104-.482 2.118-1.083 3.051-1.766 20.6 16.911 52.289 2.461 52.289-24.745 0-17.672-14.327-31.999-32-31.999z" fill="currentColor" data-original="#000000" style=""/><path d="m152.453 336.01c1.271-.489 2.584-.974 3.938-1.453 3.246-1.149 4.358-5.173 2.188-7.847-4.66-5.741-9.354-11.749-14.01-17.997-1.356-1.819-3.765-2.513-5.873-1.675-63.706 25.323-62.029 68.332-24.793 93.232 1.95 1.3 4.08 2.12 6.25 2.48 1.413 16.65 15.597 29.674 32.711 29.239 19.196-.487 33.695-18.109 30.785-37.089-3.587-23.398-31.545-35.064-50.886-20.45-.86-.708-12.73-8.068-12.73-14.45 0-5.55 9.96-15.41 32.42-23.99z" fill="currentColor" data-original="#000000" style=""/><path d="m424.033 360c0-26.222-25.887-43.109-50.658-52.959-2.113-.84-4.52-.149-5.878 1.674-4.651 6.241-9.348 12.252-14.013 17.993-2.187 2.692-1.027 6.712 2.244 7.868 25.199 8.903 36.305 19.561 36.305 25.424 0 5.8-10.66 15.97-34.05 24.59-39.728 14.627-93.558 17.76-136.606 13.877-2.831-.255-5.286 1.897-5.426 4.736-.346 6.981-1.796 13.73-4.291 20.1-1.205 3.075.885 6.453 4.172 6.772 93.06 9.013 208.201-14.575 208.201-70.075z" fill="currentColor" data-original="#000000" style=""/><circle cx="256.033" cy="144" r="48" fill="currentColor" data-original="#000000" style=""/><path d="m245.443 372c6.011 5.297 15.086 5.37 21.18 0 5.52-4.88 135.37-120.66 135.37-226.04 0-80.48-65.48-145.96-145.96-145.96s-145.96 65.48-145.96 145.96c0 105.38 129.851 221.16 135.37 226.04zm-69.41-228c0-44.11 35.89-80 80-80s80 35.89 80 80-35.89 80-80 80-80-35.89-80-80z" fill="currentColor" data-original="#000000" style=""/></g></g></svg>  <?php echo  $this->tag->getTag('location_&_nearby','Location & Nearby') ;?></h3>
                        
                        </div>
						<div class="clearfix"></div>
						<div   class="" style="margin-bottom: 0px;width:100%;">
							 <?php $this->renderPartial('_new_map_loc_detail');?>
						</div>
						</div>
						</div>
	<?php } ?>
	 
</div>

	<div class="clearfix"></div>
	
</div>
<div class="clearfix"></div>

<!-- Details End End -->
 </div>			 	
     
			
	
	
	
<!-- Slider End -->
<div class="clearfix"></div>  
<div id="sec_content"></div>

 <div class="clearfix"></div>
<!-- Details2 End End -->   
</div>
<div class="clearfix"></div>
 
  <div class="clearfix"></div>
   
 
<div class="clearfix"></div>
</div>
 
         <style> @media only screen and (max-width: 1024px){ html .for-mobile-menu {        display: none !important;}}      </style>
       
 <div class="clearfix"></div>
 </div>
<div class="clearfix"></div>
