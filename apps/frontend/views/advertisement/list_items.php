<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
												<div class="entry-content">
												<?php 
												$items = AdvArticle::model()->getArticles($model->primaryKey,1);

												if($items){
													foreach($items as $k=>$v){
														echo '<p><a href="'. Yii::app()->createUrl('advertisement/details',array('slug'=>$v->slug)).'">'.$v->title.'</a></p>';
														}
												}

												?>
												<p>&nbsp;</p>

												</div>
								
								
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

 
