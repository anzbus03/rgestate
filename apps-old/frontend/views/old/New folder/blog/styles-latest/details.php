<div id="fieldset_" class="wrapper_sec_">
<div id="twelve">
      
        <h3 class="span_blog">ALL BLOGS</h3>
			
			 
   
    
    
    
        <ul class="span_sec_blog">
			<li><a href="<?php echo Yii::app()->createUrl('rs-blog/blog/list');?>" class="">All</a></li>
			<?php 
			if($category):
			foreach($category as $k=>$v):
			?>
			<li><a href="<?php echo Yii::app()->createUrl('rs-blog/'.$v->slug.'/list');?>" class=""><?php echo $v->name ;?> (<?php echo $v->blogCount;?>)</a></li>
			<?
			endforeach;
			endif;
			?>

		</ul> 
		
      
    </div>
      <div id="listing-results" class="group-set">
			<article class="post artPost">
			<!--<figure>
			</figure>-->
			<div class="meta">
			<p class="day">  <?php echo date('d',strtotime($model->date_added));?> </p>
			<p class="month"> <?php echo date('M',strtotime($model->date_added));?>   </p>
			<p class="month"> <?php echo date('Y',strtotime($model->date_added));?> </p>
			</div>
			<div class="post-content blogPost">


			<!--<h4><a href="#"></a></h4>-->
			<h1 class="entry-title"><a rel="bookmark" title="" href="#"><?php echo $model->title;?>           </a></h1>
			 <?php echo nl2br($model->content);?>
			</div>
			</article>
    </div>
    
    
    
	 <?php   $this->widget('frontend.components.web.widgets.recentposts.RecentPostWidget');?> 
