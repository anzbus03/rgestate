<div class="container">
<?php
if (Yii::app()->request->isAjaxRequest) {
	?><script>$('body').attr("id","detail");</script>
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
	   $referer = $this->app->request->urlReferrer ;
	   if( strpos( $referer, '/properties' ) !== false ) {
			$return_url = $_SERVER['HTTP_REFERER'];
		} 
		else{
		    $return_url =   $this->app->createUrl('listing/index',array('sec'=>$model->sec_slug));
		 
		}
?>
<style>
html .fRPqyQ {
 
    flex-wrap: nowrap; 
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
html h2.headline {
    font-size: 26px!important;
    font-weight: 600!important;
}
html .sec_type_3 h2.headline {
    color: var(--secondary-color)!important;
}@media only screen and (max-width: 720px){
.for-mob-descrid .headline {
    font-size: 20px!important;
}
}
</style>
 
<div class="HomeDetailsBackToSearch__FlexContainer-kqo6lf-0 bnKQbF">
	<div style="width:100%;padding-top:1px" class="FlexContainers__Columns-zvngfq-2 iaArEw" align="start">
		<div data-testid="back-to-search-link-container" class="BackToSearchLink__LinkContainer-sc-1cnrjeu-0 cEHbph">
			<a href="<?php echo  $return_url; ?>" onclick="easyload(this,event,'mainContainerClass')">
				<div class="BackToSearchLink__ArrowIconContainer-sc-1cnrjeu-2 cWgQaj">
					<div class="ui__SvgContainer-sc-1z03173-0 dnmcZc">
						<svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path fill="#474E52" d="M5.563 11.236l-1.28 1.28v-1.06l4.5 4.5c.707.707-.354 1.768-1.061 1.06l-4.5-4.5a.737.737 0 0 1-.218-.454.75.75 0 0 1 .218-.606l.037-.037a.736.736 0 0 1 .493-.183h1.81zm2.159-4.28a.75.75 0 0 1 1.06 1.06l-3.22 3.22h15.44a.75.75 0 1 1 0 1.5H3.752l.53-1.28 4.5 4.5-1.06 1.06-4.5-4.5a.747.747 0 0 1-.215-.442.766.766 0 0 1 .252-.655l4.463-4.463z"></path>
						</svg>
					</div>
				</div><span class="BackToSearchLink__LinkText-sc-1cnrjeu-1 fzdoeg Text__TextBase-sc-1cait9d-0 eZuzxa"><?php echo $this->tag->getTag('back_to_search', 'Back to Search') ;?></span>
			</a>
		</div>
		<nav data-testid="bread-crumb-container" class="BackToSearchBreadcrumbs__BreadcrumbsContainer-sc-1psjy3f-0 eLjaXW Breadcrumb__BreadcrumbContainer-sc-9uq83w-0 fRPqyQ">
			<div r="xxs" class="Padding-sc-1tki7vp-0 lhidDf">
				<div class="MediaBlock__MediaContainer-skmvlj-0 cBzaHP">
					<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><span class="Text__TextBase-sc-1cait9d-0 jLQBVG"><span class="Text__TextBase-sc-1cait9d-0 dqIHyb"><a href="<?php echo Yii::App()->createUrl('listing/index',array('sec'=>$model->sec_slug));?>" onclick="easyload(this,event,'mainContainerClass')"><?php echo $this->tag->getTag('new_developments', 'New Developments') ;?></a></span></span>
					</div>
					<div class="ui__SvgContainer-sc-1z03173-0 jbEOdO">
						<svg width="8" height="8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path fill="#474E52" d="M4.7 2.4a.5.5 0 0 1 .6-.8l8 6a.5.5 0 0 1 0 .8l-8 6a.5.5 0 0 1-.6-.8L12.167 8 4.7 2.4z"></path>
						</svg>
					</div>
				</div>
			</div>
			<div r="xxs" class="Padding-sc-1tki7vp-0 lhidDf">
				<div class="MediaBlock__MediaContainer-skmvlj-0 cBzaHP">
					<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><span class="Text__TextBase-sc-1cait9d-0 jLQBVG"><a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>$model->sec_slug,'state'=>$model->state_slug));?>" onclick="easyload(this,event,'mainContainerClass')"><?php echo $model->state_name;?></a></span>
					</div>
					<div class="ui__SvgContainer-sc-1z03173-0 jbEOdO">
						<svg width="8" height="8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path fill="#474E52" d="M4.7 2.4a.5.5 0 0 1 .6-.8l8 6a.5.5 0 0 1 0 .8l-8 6a.5.5 0 0 1-.6-.8L12.167 8 4.7 2.4z"></path>
						</svg>
					</div>
				</div>
			</div>
			 
			<?php 
            if(!empty($model->category_id )){   ?>
			<div r="xxs" class="Padding-sc-1tki7vp-0 lhidDf">
				<div class="MediaBlock__MediaContainer-skmvlj-0 cBzaHP">
					<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><span class="Text__TextBase-sc-1cait9d-0 jLQBVG"><a href="<?php echo $this->app->createUrl('listing/index',array('sec'=>$model->sec_slug,'type_of'=>$model->category_slug));?>" onclick="easyload(this,event,'mainContainerClass')"><?php echo $model->category_name;?></a></span>
					</div>
					<div class="ui__SvgContainer-sc-1z03173-0 jbEOdO">
						<svg width="8" height="8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path fill="#474E52" d="M4.7 2.4a.5.5 0 0 1 .6-.8l8 6a.5.5 0 0 1 0 .8l-8 6a.5.5 0 0 1-.6-.8L12.167 8 4.7 2.4z"></path>
						</svg>
					</div>
				</div>
			</div>
			<?php } ?> 
			<div r="xxs" class="Padding-sc-1tki7vp-0 lhidDf">
				<div class="MediaBlock__MediaContainer-skmvlj-0 cBzaHP">
					<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><span class="Text__TextBase-sc-1cait9d-0 jLQBVG"><span class="Text__TextBase-sc-1cait9d-0 dqIHyb"><?php echo $model->adTitle2;?></span></span>
					</div>
				</div>
			</div>
		</nav>
	</div>
</div>

 
<?php ini_set("memory_limit", "-1"); ?> 
<script>
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index');?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('detail/autocomplete');?>';
function setEmptyval(k){ $(k).val('');$('#frm_sec').val('');
						$('#frm_type').val('');
						$('#frm_cat').val(''); }
						function submitFrmTop(){
							$('#detail_form').submit();
							}
 
</script>


 
<div class="home_container sec_type_<?php echo $model->section_id;?>">
 
<!-- NAV End -->
<div class="clearfix"></div>
    <div class="" id="wrapper3">
            <!-- Slider -->
           <?php 
            $images = $model->all_images();
            
            
            if($images){
				
             $image_size = sizeOf($images);
            ?>
            	  <style>
					  .image_sec_1 { width:66.66666666666667%;float:left}
					  html[dir="rtl"] .image_sec_1{float:right;}
					  .image_sec_2 { width:33.33333333333333%;padding-left:10px;float:right; }
					   html[dir="rtl"] .image_sec_2{padding-left: 0px;padding-right:10px;}
					  .image_sec_1 img { border-radius:0px;    width: 100%; }
					  .image_sec_2 .image_sec_2_sec_1 {   margin-bottom:10px   }
					  .image_sec_2 .image_sec_2_sec_2 {  ;  }
					   .image_sec_2 .image_sec_2_sec_1 img { max-height:100%;      object-fit: cover;
    object-position: center;}
					   .image_sec_2 .image_sec_2_sec_2 img { max-height:100%;     object-fit: cover;
    object-position: center;}
     html[dir="rtl"]  .seec_b_2 {
   
    float: right;
} html[dir="rtl"] #share_widget {left:unset;    right: 5px; }
html[dir="rtl"] .hIfUYc {    right: 20px;    left: unset !important;}
html[dir="rtl"] #detail .headline {    margin-right: 0;    margin-left: 0px; }
html[dir="rtl"] #detail			.button.orangeb {     float: left;    margin-right: 15px;    margin-left: 0px;}	
			
				  </style>
					 <div style="width:100%;position: relative;" class="new_project">
						 	<div class="seec_b_2">
			 
            <span data-role="coShoppingContainer" class="coShoppingContainer" style="width:auto;">
               <span data-reactroot="">
                  <span class="mrxs hide">
                     <div style="display: inherit;"><button data-test-id="PDPSaveButton" id="fav_button_<?php echo $model->id;?>"  class="phl btn btnSml btnDefault phmXxsVisible <?php echo !empty($model->fav) ?  'active' : '';?> "  onclick="<?php if($this->app->user->getId()){ echo 'savetofavourite(this)'; }else{ echo 'OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $model->primaryKey;?>"  data-after="saved_fave"  ><?php if(!empty($model->fav) ){ echo '<i class="iconHeart" ></i>'; } else{ echo '<i class="iconHeartEmpty" ></i>';} ?><span class=""><?php echo 'Save' ;?></span>   </button>
                     </div>
                  </span>
                  <span> 
					  <!-- <span style="position:relative;z-index:1;display:inline-block" class="mainBtn-share">
					<button id="PDPShareButton" class="   " onclick="$('#share_widget').toggle();" ><span class=""><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/shapes.png');?>" /></span> -->
					  
					  </button>
                  	<div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" id="share_widget" style="">

					<a class="a2a_button_facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug)));?>&quote=" rel="nofollow noopener"><span class="a2a_svg a2a_s__default a2a_s_facebook" style="background-color: rgb(59, 89, 152);"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#FFF" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"></path></svg></span><span class="a2a_label">Facebook</span></a>
					<a class="a2a_button_whatsapp" target="_blank" href="<?php echo Yii::t('app','https://api.whatsapp.com/send?text={text}',array('{text}'=> $pageTitle . ' ' .   urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug)))  ));?>" rel="nofollow noopener"><span class="a2a_svg a2a_s__default a2a_s_whatsapp" style="background-color: rgb(18, 175, 10);"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF" d="M16.21 4.41C9.973 4.41 4.917 9.465 4.917 15.7c0 2.134.592 4.13 1.62 5.832L4.5 27.59l6.25-2.002a11.241 11.241 0 0 0 5.46 1.404c6.234 0 11.29-5.055 11.29-11.29 0-6.237-5.056-11.292-11.29-11.292zm0 20.69c-1.91 0-3.69-.57-5.173-1.553l-3.61 1.156 1.173-3.49a9.345 9.345 0 0 1-1.79-5.512c0-5.18 4.217-9.4 9.4-9.4 5.183 0 9.397 4.22 9.397 9.4 0 5.188-4.214 9.4-9.398 9.4zm5.293-6.832c-.284-.155-1.673-.906-1.934-1.012-.265-.106-.455-.16-.658.12s-.78.91-.954 1.096c-.176.186-.345.203-.628.048-.282-.154-1.2-.494-2.264-1.517-.83-.795-1.373-1.76-1.53-2.055-.158-.295 0-.445.15-.584.134-.124.3-.326.45-.488.15-.163.203-.28.306-.47.104-.19.06-.36-.005-.506-.066-.147-.59-1.587-.81-2.173-.218-.586-.46-.498-.63-.505-.168-.007-.358-.038-.55-.045-.19-.007-.51.054-.78.332-.277.274-1.05.943-1.1 2.362-.055 1.418.926 2.826 1.064 3.023.137.2 1.874 3.272 4.76 4.537 2.888 1.264 2.9.878 3.43.85.53-.027 1.734-.633 2-1.297.266-.664.287-1.24.22-1.363-.07-.123-.26-.203-.54-.357z"></path></svg></span><span class="a2a_label">WhatsApp</span></a>
 
					</div>

 
                  </span>
            

 
                  </span>
               </span>
            </span>
           <script>
            $(function() {
				// nslider();
				fancyclgroup()
            });
			window.addEventListener('load', function () {
				const sec1 = document.querySelector('.image_sec_1');
				const sec2 = document.querySelector('.image_sec_2');

				if (sec1 && sec2) {
					const height = sec1.offsetHeight;
					sec2.style.height = height + 'px';
				}
			});
            </script>
					  </div>
					  <style>
						.image-gallery-container {
							display: flex;
							gap: 10px; /* optional spacing between sections */
						}

						.image_sec_1, .image_sec_2 {
							flex: 1;
							position: relative;
						}

						/* Split image_sec_2 vertically */
						.image_sec_2 {
							display: flex;
							flex-direction: column;
							justify-content: space-between;
						}

						.image_sec_2_sec_1,
						.image_sec_2_sec_2 {
							flex: 1;
							overflow: hidden;
						}

						.image_sec_2_sec_1 img,
						.image_sec_2_sec_2 img {
							height: 100%;
							width: 100%;
							object-fit: cover;
						}

					  </style>
					  <?php
							$hasVideo = false;
							$youtube_id = '';
							if (!empty($model->video)) {
								preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->video, $match);
								$youtube_id = @$match[1];
								$hasVideo = !empty($youtube_id);
							}
						?>

					  <div class="image_sec_1">
						<?php if ($hasVideo): ?>
							<div class="video-container3">
								<iframe width="853" height="480"
										src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>"
										frameborder="0"
										allowfullscreen></iframe>
							</div>
							<style>
								.video-container3 {
									position: relative;
									padding-bottom: 56.25%;
									margin-top: 15px;
									padding-top: 30px;
									height: 0;
									overflow: hidden;
								}

								.video-container3 iframe {
									position: absolute;
									top: 0;
									left: 0;
									width: 100%;
									height: 100%;
								}
							</style>
							<?php unset($images[0]); // Skip first image if video is shown ?>
						<?php else: ?>
							<?php if (!empty($images[0])): ?>
								<?php
								$image_url = $model->getdetailImages($images[0]->image_name, $images[0]->status, '856');
								?>
								<a href="<?php echo $image_url; ?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url; ?>" data-background-image="<?php echo $image_url; ?>">
									<img src="<?php echo $image_url; ?>" alt="<?php echo $pageTitle; ?>" title="<?php echo $model->ad_title; ?>">
								</a>
								<?php unset($images[0]); ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					 <div class="image_sec_2">
						 <div class="image_sec_2_sec_1">
						 <?php
 
						 if(isset($images[1])){ ?>
						 <?php $image_url =   $model->getdetailImages($images[1]->image_name,$images[1]->status,'856')  ; unset($images[1]); ?>
						 <?php }?> 
						  <a href="<?php echo $image_url;?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url;?>"   data-background-image="<?php echo $image_url;?>"    > <img src="<?php echo $image_url;?>" alt="<?php echo $pageTitle;?>" title="<?php echo $model->ad_title;?>"></a>
						 
						 </div>
						 <div class="image_sec_2_sec_2">
						<?php
						 if(isset($images[2])){ ?>
						 <?php $image_url =   $model->getdetailImages($images[2]->image_name,$images[2]->status,'856')  ;  unset($images[1]);?>
						 <?php } ?>
						  <a href="<?php echo $image_url;?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url;?>"   data-background-image="<?php echo $image_url;?>"  > <img src="<?php echo $image_url;?>" alt="<?php echo $pageTitle;?>" title="<?php echo $model->ad_title;?>"></a>
						 
						 </div>
					 </div>
					 <?php
					 if(!empty($images)){
					     foreach($images as $image){
					           $image_url2 =   $model->getdetailImages($image->image_name,$image->status,'856')  ; ?>
						 
						  <a href="<?php echo $image_url2;?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url2;?>"   data-background-image="<?php echo $image_url2;?>"  style="display:none;" >  </a>
					<?php
					     }
					 }
					 ?>
					    <div class="HomeDetailsHero__HeroFooter-hubkl0-5 hIfUYc">  <a href="<?php echo $image_url1;?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url1;?>"   data-background-image="<?php echo $image_url1;?>"   > <button type="button" data-testid="hdp-hero-photo-count"   aria-label="View 14 photos" class="Button__ButtonBase-sc-1ea9wz-0 Button-sc-1ea9wz-1 HomeDetailsHeroCta__HeroCta-sc-35yfrg-0 jQnIeH"><div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe"><div class="ui__SvgContainer-sc-1z03173-0 dlXmJI"><svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><g fill="#ffffff" fill-rule="nonzero"><path d="M2.5 2.5V13H13V2.5H2.5zm-.5-1h11.5a.5.5 0 0 1 .5.5v11.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V2a.5.5 0 0 1 .5-.5z"></path><path d="M13.5 10a.5.5 0 1 1 0 1H2a.5.5 0 1 1 0-1h11.5zm-7-7a1.75 1.75 0 1 1 0 3.5H5a1.25 1.25 0 0 1-.078-2.498A1.746 1.746 0 0 1 6.5 3zm0 1a.747.747 0 0 0-.736.63.5.5 0 0 1-.673.389.248.248 0 0 0-.341.231c0 .138.112.25.25.25h1.5a.75.75 0 1 0 0-1.5z"></path><path d="M9.076 6.664c.536-.919 1.88-.874 2.353.076l1.768 3.536a.5.5 0 1 1-.894.448l-1.77-3.537a.339.339 0 0 0-.594-.019L8.432 9.752a.5.5 0 0 1-.848.025 3.957 3.957 0 0 0-.58-.66C6.58 8.726 6.149 8.5 5.75 8.5c-.324 0-.752.372-1.175 1.022a7.385 7.385 0 0 0-.61 1.164.5.5 0 0 1-.93-.372 8.366 8.366 0 0 1 .701-1.337C4.331 8.066 4.981 7.5 5.751 7.5c.696 0 1.341.337 1.933.883.089.082.171.163.248.243l1.145-1.962z"></path></g></svg></div><div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE" style="margin-left:2px !important;"><span color="inverse" data-testid="photo-count" class="Text__TextBase-sc-1cait9d-0 bqfOkU"><?php echo Yii::t('app',$this->tag->getTag('show_{n}_photos','Show {n} Photos'),array('{n}'=> $image_size  ));?></span></div></div></button></a></div>
         
					 <div class="clearfix"></div>
					 </div>
            <?php
            /*
            <div class="property-slider default  " >
				<span class="seec_b"> <span><?php echo $model->sectionBanner;?></span></span>
				<div class="seec_b_2">
			 
            <span data-role="coShoppingContainer" class="coShoppingContainer" style="width:auto;">
               <span data-reactroot="">
                  <span class="mrxs hide">
                     <div style="display: inherit;"><button data-test-id="PDPSaveButton" id="fav_button_<?php echo $model->id;?>"  class="phl btn btnSml btnDefault phmXxsVisible <?php echo !empty($model->fav) ?  'active' : '';?> "  onclick="<?php if($this->app->user->getId()){ echo 'savetofavourite(this)'; }else{ echo 'OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $model->primaryKey;?>"  data-after="saved_fave"  ><?php if(!empty($model->fav) ){ echo '<i class="iconHeart" ></i>'; } else{ echo '<i class="iconHeartEmpty" ></i>';} ?><span class=""><?php echo 'Save' ;?></span>   </button>
                     </div>
                  </span>
                  <span> 
					  
					    <span style="position:relative;z-index:1;display:inline-block" class="mainBtn-share">
                      <button id="PDPShareButton" class="   " onclick="$('#share_widget').toggle();" ><span class=""><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/shapes.png');?>" /></span>
                  </button>
                  	<div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" id="share_widget" style="">

					<a class="a2a_button_facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug)));?>&quote=" rel="nofollow noopener"><span class="a2a_svg a2a_s__default a2a_s_facebook" style="background-color: rgb(59, 89, 152);"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#FFF" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"></path></svg></span><span class="a2a_label">Facebook</span></a>
					<a class="a2a_button_whatsapp" target="_blank" href="<?php echo Yii::t('app','https://api.whatsapp.com/send?text={text}',array('{text}'=> $pageTitle . ' ' .   urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug)))  ));?>" rel="nofollow noopener"><span class="a2a_svg a2a_s__default a2a_s_whatsapp" style="background-color: rgb(18, 175, 10);"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF" d="M16.21 4.41C9.973 4.41 4.917 9.465 4.917 15.7c0 2.134.592 4.13 1.62 5.832L4.5 27.59l6.25-2.002a11.241 11.241 0 0 0 5.46 1.404c6.234 0 11.29-5.055 11.29-11.29 0-6.237-5.056-11.292-11.29-11.292zm0 20.69c-1.91 0-3.69-.57-5.173-1.553l-3.61 1.156 1.173-3.49a9.345 9.345 0 0 1-1.79-5.512c0-5.18 4.217-9.4 9.4-9.4 5.183 0 9.397 4.22 9.397 9.4 0 5.188-4.214 9.4-9.398 9.4zm5.293-6.832c-.284-.155-1.673-.906-1.934-1.012-.265-.106-.455-.16-.658.12s-.78.91-.954 1.096c-.176.186-.345.203-.628.048-.282-.154-1.2-.494-2.264-1.517-.83-.795-1.373-1.76-1.53-2.055-.158-.295 0-.445.15-.584.134-.124.3-.326.45-.488.15-.163.203-.28.306-.47.104-.19.06-.36-.005-.506-.066-.147-.59-1.587-.81-2.173-.218-.586-.46-.498-.63-.505-.168-.007-.358-.038-.55-.045-.19-.007-.51.054-.78.332-.277.274-1.05.943-1.1 2.362-.055 1.418.926 2.826 1.064 3.023.137.2 1.874 3.272 4.76 4.537 2.888 1.264 2.9.878 3.43.85.53-.027 1.734-.633 2-1.297.266-.664.287-1.24.22-1.363-.07-.123-.26-.203-.54-.357z"></path></svg></span><span class="a2a_label">WhatsApp</span></a>
 
					</div>

 
                  </span>
            

 
                  </span>
               </span>
            </span>
           <script>
            $(function() {
 nslider();
 fancyclgroup()
            });
            </script>
					  </div>
					   <div class="nslider" style="">
				<?php 
				foreach($images as $image){
				//	$image_url =  $this->app->apps->getBaseUrl('uploads/images/'.$image->image_name)  ;	
				$image_url =   $model->getdetailImages($image->image_name,$image->status,'1204')  ;
				
	 
				
	 
				?>
			 
               <a href="<?php echo $image_url;?>" data-fancybox="cl-group" data-thumb="<?php echo $image_url;?>"   data-background-image="<?php echo $image_url;?>" data-im-name="<?php echo $image->image_name;?>"   class="item  spch">  <img src="<?php echo $image_url;?>" style="height:450px;"></a> 
               <?php } ?>
               </div>
               
            </div>
            */
            ?>
            
            
            <?php } ?> 
          
             <!-- Slider Thumbs -->
			 	 <?php 
			 ;
			if(!empty($images) and sizeOf($images)>1 ){ /* ?>
			<div class="property-slider-nav hide"  >
			<?php 
			foreach($images as $image){
				$image_url = $this->app->apps->getBaseUrl('timthumb.php').'?src='.$this->app->apps->getBaseUrl('uploads/images/'.$image->image_name).'&h=122&w=184&zc=1' ;	
			?>
			 <div class="item"><img src="<?php echo $image_url;?>" alt=""></div>   
			<?php } ?>
			</div>
			<?php */ } ?> 
			<div class="clearfix"></div>
         </div>
<!-- Slider End -->
<div class="clearfix"></div>
<div class="container" id="sec_filter">
	<script>
		var sec_filter;
		var t_features;
		var to_map;
		var prop_type;
		var to_florr;
		var to_developer;
		var payment_plan;
		function checkandassin(k){
			if($('#'+k).length=='1'){
				window[k]  = $('#'+k).offset().top-154;
			}
			else{
				$('#'+k+'_a').addClass('disabled');
				$('#'+k+'_a').find('a').removeAttr('onclick');
			}
		}
	$(function(){ 
		  sec_filter = $('#sec_filter').offset().top;
		  checkandassin('t_features');
		  checkandassin('prop_type');
		  checkandassin('to_map');
		  checkandassin('to_florr');
		  checkandassin('to_developer');
		  checkandassin('payment_plan');
		 checkandassin('available_type');
		  /*
		  t_features = $('#t_features').offset().top-154;
		  prop_type = $('#prop_type').offset().top-154;
		  to_map = $('#to_map').offset().top-154;
		  to_florr = $('#to_florr').offset().top-154;
		  to_developer = $('#to_developer').offset().top-154;
		  */
	 if(screen.width > 720){ 
	// 	activatePropertyDetail();
	 }
		
	    
	    
	})
	</script>
    </div>
     <div class="clearfix"></div>  
<div id="sec_content"></div>
<div class="">
<div class="col-sm-8 for-mb-sm8nopad no-padding-right no-padding-left">

 <div data-testid="home-details-summary" class="Grid__GridContainer-sc-144isrp-1 lputZN">
		<div width="0.8,1,0.5,0.5" order="1,1,1,1" class="Grid__CellBox-sc-144isrp-0 glKGZj  col-sm-7 padding-left-0">
		<h1 data-testid="home-details-summary-address" class="HomeSummaryShared__AddressH1-vqaylf-1 cmjCIx"><span data-testid="home-details-summary-headline" class="Text__TextBase-sc-1cait9d-0 dhOdUy titinc smsec_<?php echo $model->section_id;?>"><?php echo $model->adTitle2;?><span class="small-lc-h"><?php echo $model->LocationTitle;?></span></span></h1> 
		<div class="Box-sc-1f5rw0h-0 dNvZdu" hidden="">
			<div class="Padding-sc-1tki7vp-0 eCVEOn">
			    
			</div>
		</div>
 	</div>
	<div width="0.6,0.7,0.34,0.323" order="3,2,2,2" class="Grid__CellBox-sc-144isrp-0 edBXrN col-sm-5 padding-left-0 padding-right-0">
		<h2 style="margin: 0px;" data-testid="on-market-price-details"><div class="Text__TextBase-sc-1cait9d-0-div Text__TextContainerBase-sc-1cait9d-1 hlvKRM"><?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2'){ ?>/<span class="dura"><?php echo $model->getRentPaidL(1); ?> </span> <?php } ?></div></h2>
	 
	</div>
 </div>
	 <div class="clearfix"></div>
				
</div>
<div class="col-sm-4 thirdBtn no-padding-right">
 
			<div class="m-mob-dip">
 
<div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;width:100% !important">
    <a type="button"    style="color:#fff;padding-left: 2px;padding-right: 2px; " onclick="OpenCallNew(this)" data-prop="<?php echo $model->id;?>" data-phone="<?php echo base64_encode($model->mobile_number);?>"   data-testid="lead-form-submit" style="margin-bottom:8px" class="b-l-l-m    Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA" dir="ltr"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('call','Call')  ;?></a>
    <?php $w_share_url = Yii::t('app','https://wa.me/{number}?text={text}',array('{number}'=>Yii::t('app',!empty($model->whatsapp) ? $model->whatsapp : $model->mobile_number,array('+'=>'',' '=>'')) ,'{text}'=>  'I would like to inquire about your property Feeta - '.$model->ReferenceNumberTitle.'. Please contact me at your earliest convenience. %0aProperty Link %0a' .   urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug))) ));?>
 
    <a type="button"    target="_blank" style="color:#fff; "  onclick="OpenWhatsappNew(this)" data-href="<?php echo  $w_share_url;?>"    data-testid="lead-form-submit" style="margin-bottom:8px" class="   Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp"><i class="fa fa-whatsapp" style="font-size: 20px;margin-right: 3px;"></i> </a>
    <button type="button" onclick="OpenFormClickNew(this)" data-reactid="<?php echo $model->id;?>" data-testid="lead-form-submit" style=" " class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope"  style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('email','Email') ;?></button>
    
    </div>
 
</div>
<div class="clearfix"></div>
<div data-testid="summary-mortgage-estimate" id="span_mob"class="hide Text__TextBase-sc-1cait9d-0-div SummaryMortgageInfo__EstimatedMortgageText-djttxd-0 hwlyuJ Text__TextContainerBase-sc-1cait9d-1 gniUbj flaticon-phone">&nbsp;&nbsp;<?php echo $model->mobile_number;?></div>
</div>
<div class="clearfix"></div>
</div>

 <div class="clearfix"></div>
  <div class="clearfix"></div>
  <div class="sticky1">
      <div class=" container  padding-left-0 padding-right-0">
     <div class="  margin-top-15  margin-bottom-0 ">
		 <div class="content-block-section "  id="content-blgsection">
     <div class="b-complex-menu-slider__item  swiper-slide active "  id="to_description_a" >
  <a     href="#m_about">
   <div class="b-complex-menu-slider__icon-wrapper">
 
<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="30px" class="b-complex-menu-slider__icon" enable-background="new 0 0 511.999 511.999"   viewBox="0 0 511.999 511.999" ><g><g><path d="m476 120.004h-190v-110.004c0-5.522-4.477-10-10-10h-240c-5.523 0-10 4.478-10 10v491.999c0 5.522 4.477 10 10 10h240 200c5.523 0 10-4.478 10-10v-371.995c0-5.523-4.478-10-10-10zm-190 20h180v251.995h-180zm-160 351.995v-80h60v80zm70-100h-80c-5.523 0-10 4.478-10 10v90h-60v-471.999h220v471.999h-60v-90c0-5.522-4.478-10-10-10zm89.999 100v-80h180v80z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m145.999 80.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m145.999 150.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m145.999 220.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m145.999 290h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m145.999 360h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m76.001 80.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m76.001 150.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m76.001 220.001h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m76.001 290h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m76.001 360h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m235.998 40.001h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m235.998 110h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.477-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m235.998 180h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.477-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m235.998 250h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.477-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m235.998 320h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.477-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m420.997 180h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m420.997 250h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m420.997 320h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m350.999 180h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m350.999 250h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.522-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/><path d="m350.999 320h-19.997c-5.523 0-10 4.477-10 10v20c0 5.523 4.477 10 10 10h19.997c5.523 0 10-4.477 10-10v-20c0-5.523-4.478-10-10-10z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#3E3E3E"/></g></g> </svg>

   </div>
   <div class="b-complex-menu-slider__title">
      <?php echo $this->tag->getTag('about_the_project','About the project');?>
   </div>
   </a>
</div>
     
     <div class="b-complex-menu-slider__item swiper-slide "    id="t_features_a" >
		 <a    href="#m_features">
   <div class="b-complex-menu-slider__icon-wrapper">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 343.5 343.5" class="b-complex-menu-slider__icon" width="30px" style="enable-background:new 0 0 343.5 343.5;" xml:space="preserve" width="512px" height="512px"><g><g><g><path d="M322.05,161.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,166.3,327.65,161.8,322.05,161.8 z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M57.95,125.3c-25.7,0-46.5,20.8-46.5,46.5s20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5S83.65,125.3,57.95,125.3z M57.95,198.3c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5c14.6,0,26.5,11.9,26.5,26.5S72.55,198.3,57.95,198.3z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M322.05,36.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,41.3,327.65,36.8,322.05,36.8z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M57.95,0c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5C104.45,20.9,83.65,0.1,57.95,0z M57.95,73.1c-14.7,0-26.5-11.9-26.5-26.5c0-14.6,11.9-26.5,26.5-26.5c14.7,0,26.5,11.9,26.5,26.5 C84.45,61.2,72.55,73.1,57.95,73.1z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M322.05,286.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10S327.65,286.8,322.05,286.8z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M57.95,250.5c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5 C104.45,271.4,83.65,250.5,57.95,250.5z M57.95,323.6c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5 c14.7,0,26.5,11.9,26.5,26.5S72.55,323.6,57.95,323.6z" data-original="#000000" class="active-path" fill="#000000"/></g></g></g> </svg>
   </div>
   <div class="b-complex-menu-slider__title">
     <?php echo $this->tag->getTag('features','Features');?>
   </div>
   </a>
</div>
     
     <div class="b-complex-menu-slider__item swiper-slide " id="to_map_a"     >
		 <a    href="#m_map" >
   <div class="b-complex-menu-slider__icon-wrapper">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" class="b-complex-menu-slider__icon" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px"><g><g><g><path d="M256,0C156.748,0,76,80.748,76,180c0,33.534,9.289,66.26,26.869,94.652l142.885,230.257 c2.737,4.411,7.559,7.091,12.745,7.091c0.04,0,0.079,0,0.119,0c5.231-0.041,10.063-2.804,12.75-7.292L410.611,272.22 C427.221,244.428,436,212.539,436,180C436,80.748,355.252,0,256,0z M384.866,256.818L258.272,468.186l-129.905-209.34 C113.734,235.214,105.8,207.95,105.8,180c0-82.71,67.49-150.2,150.2-150.2S406.1,97.29,406.1,180 C406.1,207.121,398.689,233.688,384.866,256.818z" data-original="#000000" class="active-path" fill="#000000"/></g></g><g><g><path d="M256,90c-49.626,0-90,40.374-90,90c0,49.309,39.717,90,90,90c50.903,0,90-41.233,90-90C346,130.374,305.626,90,256,90z M256,240.2c-33.257,0-60.2-27.033-60.2-60.2c0-33.084,27.116-60.2,60.2-60.2s60.1,27.116,60.1,60.2 C316.1,212.683,289.784,240.2,256,240.2z" data-original="#000000" class="active-path" fill="#000000"/></g></g></g> </svg>

   </div>
   <div class="b-complex-menu-slider__title">
      <?php echo $this->tag->getTag('map','Map');?>
   </div>
   </a>
</div>


     <div class="b-complex-menu-slider__item swiper-slide " id="payment_plan_a" onclick="moveTo3('payment_plan','54')" href="#payment_plan"    >
		 <a id="payment_plan_a"   href="#m_payment_plan"    >
   <div class="b-complex-menu-slider__icon-wrapper">
    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="-16 0 480 480.00319"   width="30px" class="b-complex-menu-slider__icon"  ><g><path d="m16 88.003906c0-13.253906 10.746094-24 24-24h64.210938c-3.636719 4.710938-6.167969 10.179688-7.402344 16h-48.808594c-8.835938 0-16 7.164063-16 16v200h16v-200h48v8c0 4.417969 3.582031 8 8 8h144c4.417969 0 8-3.582031 8-8v-8h48v128h16v-128c0-8.835937-7.160156-16-16-16h-48.796875c-1.234375-5.820312-3.765625-11.289062-7.402344-16h64.199219c13.257812 0 24 10.746094 24 24v136h16v-136c-.023438-22.082031-17.917969-39.972656-40-40h-104v-14.640625c.367188-17.390625-12.9375-32.027343-30.285156-33.3124998-8.785156-.5000002-17.378906 2.6718748-23.738282 8.7539068-6.351562 6.046874-9.957031 14.425781-9.976562 23.199218v16h-104c-22.078125.027344-39.9726562 17.917969-40 40v208h16zm136-24c4.417969 0 8-3.582031 8-8v-24c-.003906-4.398437 1.800781-8.605468 4.988281-11.632812 3.191407-3.023438 7.484375-4.605469 11.878907-4.367188 8.804687.945313 15.398437 8.507813 15.132812 17.359375v22.640625c0 4.417969 3.582031 8 8 8h16c13.257812 0 24 10.746094 24 24v8h-128v-8c0-13.253906 10.746094-24 24-24zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m336 440.003906c0 13.253906-10.742188 24-24 24h-272c-13.253906 0-24-10.746094-24-24v-96h-16v96c.0273438 22.078125 17.921875 39.972656 40 40h272c22.082031-.027344 39.976562-17.921875 40-40v-8h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m168 32.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m80 160.003906v64c0 4.417969 3.582031 8 8 8h64c4.417969 0 8-3.582031 8-8v-24h-16v16h-48v-48h40v-16h-48c-4.417969 0-8 3.582032-8 8zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m80 296.003906h16v-16h48v16h16v-24c0-4.417968-3.582031-8-8-8h-64c-4.417969 0-8 3.582032-8 8zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m109.65625 170.347656-11.3125 11.3125 24 24c3.125 3.121094 8.191406 3.121094 11.3125 0l40-40-11.3125-11.3125-34.34375 34.34375zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m48 448.003906h256c8.839844 0 16-7.164062 16-16h-272v-88h-16v88c0 8.835938 7.164062 16 16 16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m200 160.003906h48v16h-48zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m200 192.003906h80v16h-80zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m424 240.003906h-208c-13.253906 0-24 10.746094-24 24v128c0 13.253906 10.746094 24 24 24h208c13.257812 0 24-10.746094 24-24v-128c0-13.253906-10.742188-24-24-24zm8 152c0 4.417969-3.582031 8-8 8h-208c-4.417969 0-8-3.582031-8-8v-128c0-4.417968 3.582031-8 8-8h208c4.417969 0 8 3.582032 8 8zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m392 336.003906c-4.207031.039063-8.332031 1.203125-11.941406 3.367188-3.644532-2.183594-7.808594-3.34375-12.058594-3.367188-13.253906 0-24 10.746094-24 24s10.746094 24 24 24c4.25-.023437 8.414062-1.1875 12.058594-3.367187 3.609375 2.164062 7.734375 3.324219 11.941406 3.367187 13.257812 0 24-10.746094 24-24s-10.742188-24-24-24zm-24 32c-4.417969 0-8-3.582031-8-8 0-4.417968 3.582031-8 8-8s8 3.582032 8 8c0 4.417969-3.582031 8-8 8zm24 0c-.464844-.058594-.925781-.160156-1.375-.304687 1.835938-4.964844 1.835938-10.425781 0-15.390625.449219-.144532.910156-.246094 1.375-.304688 4.417969 0 8 3.582032 8 8 0 4.417969-3.582031 8-8 8zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m232 320.003906h48c4.417969 0 8-3.582031 8-8v-32c0-4.417968-3.582031-8-8-8h-48c-4.417969 0-8 3.582032-8 8v32c0 4.417969 3.582031 8 8 8zm8-32h32v16h-32zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m400 280.003906h16v32h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m368 280.003906h16v32h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m336 280.003906h16v32h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m224 368.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m256 368.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m288 368.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m224 336.003906h80v16h-80zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m48 312.003906h112v16h-112zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m16 312.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m112 344.003906h64v16h-64zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m80 344.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m96 376.003906h64v16h-64zm0 0" data-original="#000000" class="active-path" fill="#000000"/><path d="m64 376.003906h16v16h-16zm0 0" data-original="#000000" class="active-path" fill="#000000"/></g> </svg>

   </div>
   <div class="b-complex-menu-slider__title">
      <?php echo $this->tag->getTag('property_types','Payment Plan');?>
   </div>
   </a>
</div>

     <div class="b-complex-menu-slider__item swiper-slide "  id="to_florr_a"   >
		 <a    href="#m_floor_plan" >
   <div class="b-complex-menu-slider__icon-wrapper">
    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1_1_" enable-background="new 0 0 64 64"   viewBox="0 0 64 64"  width="30px" class="b-complex-menu-slider__icon" ><g><path d="m61 12h-51v-1c0-.552-.448-1-1-1h-2c-2.757 0-5 2.243-5 5v35c0 2.206 1.794 4 4 4h30v7c0 .552.448 1 1 1h16c.552 0 1-.448 1-1v-7h7c.552 0 1-.448 1-1v-40c0-.552-.448-1-1-1zm-57 3c0-1.654 1.346-3 3-3h1v34h-2c-.728 0-1.411.195-2 .537zm42 45h-2v-4h2zm6 0h-4v-5c0-.552-.448-1-1-1h-4c-.552 0-1 .448-1 1v5h-4v-8.446l7-4.375 7 4.375zm8-8h-6v-1c0-.345-.178-.665-.47-.848l-8-5c-.324-.202-.735-.202-1.06 0l-8 5c-.292.183-.47.503-.47.848v1h-30c-1.103 0-2-.897-2-2s.897-2 2-2h3c.552 0 1-.448 1-1v-33h50z" data-original="#000000" class="active-path" fill="#000000"/><path d="m50 42v1.903l-4.476-2.755c-.321-.198-.727-.198-1.048 0l-13 8 1.048 1.703 12.476-7.677 12.476 7.677 1.048-1.703-6.524-4.014v-3.134z" data-original="#000000" class="active-path" fill="#000000"/><path d="m13 8h40c.197 0 .391-.059.555-.168l3-2c.278-.186.445-.498.445-.832s-.167-.646-.445-.832l-3-2c-.164-.109-.358-.168-.555-.168h-40-3c-1.654 0-3 1.346-3 3s1.346 3 3 3zm1-4h38.697l1.5 1-1.5 1h-38.697zm-5 1c0-.551.449-1 1-1h2v2h-2c-.551 0-1-.449-1-1z" data-original="#000000" class="active-path" fill="#000000"/><path d="m13 44h25v-2h-12v-7h12v-2h-12v-8h-2v9 8h-10v-24h10v3h2v-3h22v15h-6v2h6v5h2v-23c0-.552-.448-1-1-1h-36c-.552 0-1 .448-1 1v26c0 .552.448 1 1 1z" data-original="#000000" class="active-path" fill="#000000"/></g> </svg>

   </div>
   <div class="b-complex-menu-slider__title">
     <?php echo $this->tag->getTag('floor_plan','Floor Plan');?> 
   </div>
   </a>
</div>
     <div class="b-complex-menu-slider__item swiper-slide " id="to_developer_a"     >
		  <a   href="#m_developer"  >
   <div class="b-complex-menu-slider__icon-wrapper">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"    width="30px" class="b-complex-menu-slider__icon" ><g><g id="outline"><path d="M488,176H424a8,8,0,0,0-7.155,4.422L403.056,208H400V24a8,8,0,0,0-8-8H120a8,8,0,0,0-8,8V56H88a8,8,0,0,0-8,8V80H56a8,8,0,0,0-8,8V208H24a8,8,0,0,0-8,8V456a40.045,40.045,0,0,0,40,40H488a8,8,0,0,0,8-8V184A8,8,0,0,0,488,176ZM80,456a24.039,24.039,0,0,1-16,22.624V376a8,8,0,0,0-16,0V478.624A24.039,24.039,0,0,1,32,456V224H80Zm0-248H64V96H80ZM128,32H384V352H128ZM96,72h16V208H96ZM480,480H87.978A39.788,39.788,0,0,0,96,456V224h16V360a8,8,0,0,0,8,8H392a8,8,0,0,0,8-8V224h8a8,8,0,0,0,7.155-4.422L428.944,192H480Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M256,200a72,72,0,1,0-72-72A72.081,72.081,0,0,0,256,200Zm0-16a55.674,55.674,0,0,1-31.917-10.024,25.125,25.125,0,0,1,13.057-20.147,31.906,31.906,0,0,0,37.719,0,25.144,25.144,0,0,1,13.058,20.146A55.674,55.674,0,0,1,256,184Zm-16-56a16,16,0,1,1,16,16A16.019,16.019,0,0,1,240,128Zm16-56a55.961,55.961,0,0,1,45.207,89,41.043,41.043,0,0,0-16.108-19.71,32,32,0,1,0-58.2,0A40.989,40.989,0,0,0,210.792,161,55.96,55.96,0,0,1,256,72Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M224,216a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M312,256a8,8,0,0,0-8-8H208a8,8,0,0,0,0,16h96A8,8,0,0,0,312,256Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M344,288H296a8,8,0,0,0,0,16h48a8,8,0,0,0,0-16Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M264,320H248a8,8,0,0,0,0,16h16a8,8,0,0,0,0-16Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M56,320a8,8,0,0,0-8,8v16a8,8,0,0,0,16,0V328A8,8,0,0,0,56,320Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M48,264v32a8,8,0,0,0,16,0V264a8,8,0,0,0-16,0Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M368,408v48a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V408a8,8,0,0,0-8-8H376A8,8,0,0,0,368,408Zm16,8h64v32H384Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M128,432h40a8,8,0,0,0,0-16H128a8,8,0,0,0,0,16Z" data-original="#000000" class="active-path" fill="#000000"/><path d="M184,448H128a8,8,0,0,0,0,16h56a8,8,0,0,0,0-16Z" data-original="#000000" class="active-path" fill="#000000"/></g></g> </svg>

   </div>
   <div class="b-complex-menu-slider__title">
      <?php echo $this->tag->getTag('contact','Contact');?>  
   </div>
   </a>
</div>




     </div>
  <div class="clearfix"></div>  
</div>  
</div>
</div>
<script>
    jQuery(document).ready(function(e) {
   jQuery("#content-blgsection a").bind('click', function(e){
		e.preventDefault();
		jQuery(".navigation > li").removeClass("current");
		var target = this.hash;
			jQuery("e").closest('li').addClass("current");
		var tops = jQuery(target).offset().top - 130;
		jQuery('html, body').animate({
			scrollTop: parseInt(tops)
		}, 1000);
	});
});

</script>

<div class="clearfix"></div>

<!-- Details End End -->
 <div class="" id="rmsrd">
   <div class="row">
       <div style="position:relative" class="">
          
           <div style="position:relative" id="wrapper2" class="for-mob-descrid">
				<div class="col-lg-12 reco_drop_down" style="padding-left: 6px;padding-right:6px; margin: auto;float: none;" id="right">
					 <div class="miniCol24 xsCol24 smlCol24 mhn phn ">
					 
					<div class="clearfix"></div>
					<?php $this->renderPartial('_details_with_amenities_project');?>
					
					<div class="clearfix"></div>
				 		
					
					 
					 
				<?php
	 $list = ''; 			
	if(!empty($model->payment_plan))	{
		 $list =  unserialize($model->payment_plan);
			 
	}		
				 
	$active_c = ''; $image_o = '';$floor_o ='';$payment_plan_o ='';
	if(!empty($images ) and sizeOf($images) > 1){ 
		 $active_c = 'image';
		 $image_o = '1';
		
	}
	else if(!empty($floor)){
		$active_c = 'floor';
		$floor_o  = '1';
	}
	else if(!empty($model->payment_plan) and is_array($list)){
		$active_c = 'payment_plan'; 
		$payment_plan_o ='1';
	}
	if(!empty($floor)){
		$floor_o  = '1';
	}
	if(!empty($model->payment_plan) and is_array($list)){
		$payment_plan_o ='1'; 
	}
	?>		
	<?php
	if(!empty($model->youtube_url)){
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->youtube_url, $match);
	$youtube_id = @$match[1];

	echo '<div class="clearfix"></div>';
	echo '   <div class="homeDetailsHeading margin-top-40"> <span class="h5 prm backgroundBasic">Video</span> </div>';
	echo '<div style="position:relative"><div class="video-container2"><iframe class="video"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div> ';
	echo '<div class="clearfix"></div></div>';
	echo '<div class="clearfix"></div>';
	?>

	<?
	}
	?>
						
					 
						
	</div>

	<div class="clearfix"></div>
	</div>
     
			   
      </div>
      <div class="clearfix"></div>
      
      </div>
   
       <div id="finish_ad_content"></div>
      <div id="map_locator">
      </div>
  </div>
  
</div>
 		 	
      <div class="clearfix"></div>
<!-- Details2 End End -->   
</div>
<div id="myModal" class="modal fade" role="dialog" style="margin-top:0px !important; margin-bottom:0px !important;max-height: unset;;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo  'Send Email' ;?></h4>
      </div>
      <div class="modal-body">
        <?php $this->renderPartial('_right_contact_form');?>
      </div>
    
    </div>

  </div>
</div>
 
  <div class="clearfix"></div>
	<style>  #top_scroller { display:none; }  </style>
  
 
<script>
    $(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
    
</script>
</div>
	<style>
	    .sticky1 {
  transition: ease .3s;
  
    padding-bottom: 15px !important;
}  .sticky1 ul{ background: #fff; }
.sticky-pin .container { padding-left:15px!important;; padding-right:15px!important;; }
.sticky-pin {
    position: fixed;
    top: 0;
    z-index:111111111;
    background: #fff;
    width: 100%;
        left: 0;
    right: 0;
   
}
	</style>
<script> 
 
$(document).ready(function(){

  var stickyElement = $(".sticky1"),
      stickyClass = "sticky-pin",
      stickyPos = stickyElement.offset().top, //Distance from the top of the window.
      stickyHeight;

  //Create a negative margin to prevent content 'jumps':
  stickyElement.after('<div class="jumps-prevent"></div>');
  function jumpsPrevent() {
    stickyHeight = stickyElement.innerHeight();
    stickyElement.css({"margin-bottom":"-" + stickyHeight + "px"});
    stickyElement.next().css({"padding-top": + stickyHeight + "px"}); 
  };
  jumpsPrevent(); //Run.

  //Function trigger:
  $(window).resize(function(){
    jumpsPrevent();
  });

  //Sticker function:
  function stickerFn() {
    var winTop = $(this).scrollTop();
    //Check element position:
    winTop >= stickyPos ?
      stickyElement.addClass(stickyClass):
      stickyElement.removeClass(stickyClass) //Boolean class switcher.
  };
  stickerFn(); //Run.

  //Function trigger:
  $(window).scroll(function(){
    stickerFn();
  }); 
});
</script>