<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	 
		<?php
		if($model->slug=='home') {
		    ?>
		    <section class="archive-head" style="background:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/default/ad-ban.jpg');?>') no-repeat center top">

<div class="container">
<div class="row">
<div class="neat-col col-md-12 content-area">
<div class="entry-content maina">
<h2>Advertise With Us</h2>
<div class="text-align-center panel-widget-style panel-widget-style-for-32-0-0-1" id="ws-6"><div id="widget_headline_8" class="inbound-headline headline-no-decoration"><h3 class="regular-sub-title">Advertising on Askaan is a unique opportunity to reach a huge <br />global audience in a creative and compelling way. We present your brand’s  <br /> message in a bigger, bolder and more beautiful way than any other online platform</h3></div></div>
<p></p>
</div>
<div class="text-align-center panel-widget-style panel-widget-style-for-32-0-0-2"><div class="split-button split-button-separate pull-right"><a href="<?php echo Yii::app()->createUrl('advertisement/contact');?>" target="_self"><div class="split-left button-style-599989cb3b6a3 inbound-solid inbound-solid">Get a Quote</div></a></div></div>
<style>
	h2.regular-title  {
    margin-top:20px  !important;
    font-size: 38px !important;
    font-weight: normal;
    font-style: normal;
    color:  #dce8f2 !important;
    padding-bottom: 14px;
}
h3.regular-sub-title {
    font-size: 20px !important;
    font-weight: normal !important;
    font-style: normal !important;
    color: #dce8f2 !important;
    line-height :28px;
}
.button_cta a, .split-button a div, .cta-link a {
    display: inline-block;
    -webkit-transition: all .3s linear;
    -moz-transition: all .3s linear;
    transition: all .3s linear;
}
.split-button div {
    padding: 14px 16px;
}
.button-style-599989cb3b6a3 {
   
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    background: #81d34a;
    border-color: rgba(129,211,74,1) !important;
    color: #fff !important;
    -webkit-box-shadow: 0 1px 13px rgba(0,0,0,.3);
    -moz-box-shadow: 0 1px 13px rgba(0,0,0,.3);
    box-shadow: 0 1px 13px rgba(0,0,0,.3);
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
}
 .button_type_single a {
    margin-bottom: 3px;
    border-style: solid;
    border-width: 2px;
}
</style>
<!-- .entry-content --></div>
<!-- #primary --></div>
</div>
</section>
<div style="height:5px;"></div>
<?php
			$spec_str = '';
			$sol_str = '';
			$spec = AdvArticle::model()->getArticles(AdvCategory::ADV_SPEC);
			foreach($spec as $k=>$v){
			$spec_str .= '<li class="col-sm-4">
			<div class="box"><a href="'. Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'"><span><img alt="'. $v->title.'" src="'.Yii::app()->apps->getBaseUrl('uploads/default/blocks/'.$v->slug.'.png').'" /> '. $v->title.' › </span> </a></div>
			</li>';
			}
			$solution = AdvArticle::model()->getArticles(AdvCategory::ADV_SOLUTION,1);
			
			foreach($solution as $k=>$v){
			preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $Imagesresource); 
			$sol_str .= '<li class="col-sm-4">
			<div class="box">
			<a href="'. Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'">
			<span>
			<img src="'.@$Imagesresource['1'].'" alt="'. $v->title.'">
			 '. $v->title.' › 
			</span>
			</a>
			</div></li>';
			}
			echo Yii::t('app',$model->content,array('[AD_SPEC_REPLACE]'=>$spec_str,'[AD_SOLUTION_REPLACE]'=>$sol_str,'[spec]'=>Yii::app()->createUrl('advertisement/list',array('category'=>AdvCategory::ADV_SPEC)),'[sol]'=>Yii::app()->createUrl('advertisement/list',array('category'=>AdvCategory::ADV_SOLUTION))));
		}else{  ?>  
			
			<div class="container-wrapper">
	<div class="center">
			<div class="clear"></div>
			
				<div class="row adv_sec" data-layer-category="breadcrumbs">
					<ul class="large-9 columns breadcrumbs">
					   <li class="angleright"><a href="<?php echo  Yii::app()->createUrl('advertisement/details',array('slug'=>'home'));?>">Home</a></li>
					  <li  class="current">   <a href="javascript:void(0)"><?php echo $model->title  ; ?></a> </li>
					</ul>
				</div>
				
				
				<div id="container"> <!-- start container -->
						
					<div class="main-left adv_sec">	
					<?php
					if($model){
						?>
			 		
											<div id="post-968" class="post-968 post type-post status-publish format-image has-post-thumbnail hentry category-news category-reviews">
						   <div class="post-showing-type1-wrapper">
							  <div class="post-showing-type1">
								 <div class="post-categories">
					 	 
						 
						 
						 		 </div>
								 <div class="clear"></div>
								 <div class="post-title">
									<h1> <?php echo $model->title  ; ?> </h1>
								 </div>
								 <div style="margin-bottom:20px;"></div>
								 <div>
								 
								 
								 </div>
								 
								 
								 <div class="post_content">
									 
								<?php 
								echo $model->content ;
								?>
								
								 </div>
								 <div style="clear:both;"></div>
								 
								 </div>
								  <div style="clear:both;"></div>
							  </div>
						 
							  <div class="clear"></div>
							   
								 
							  <div class="clear"></div>
						   </div>
					 	
								
								<?php
							 
							}
						?>
							<div class="clearfix"></div>		
		 		</div>
		 		
				<div class="sidebar sidebar-right">
					<?php $this->renderPartial('_left');?>
						
							<div class="clearfix"></div>
				</div>
					
	
						<div class="clear"></div>	
						
			<!-- end container -->		
</div> <!-- end center -->
<div class="clear"></div>
 </div>

<?php } ?> 
