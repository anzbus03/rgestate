<div id="fieldset_" class="wrapper_sec_">
<div id="twelve">
      
        <h3 class="span_blog">ALL BLOGS</h3>
			
			 
   
    
    
    
        <ul class="span_sec_blog">
			<li><a href="<?php echo Yii::app()->createUrl('rs-blog/blog/list');?>" class="<?php if($slug=='blog'){ echo 'active_blog'; }?>">All</a></li>
			<?php 
			if($category):
			foreach($category as $k=>$v):
			?>
			<li><a href="<?php echo Yii::app()->createUrl('rs-blog/'.$v->slug.'/list');?>" class="<?php if( $v->slug==$slug){ echo 'active_blog'; }?>"><?php echo $v->name ;?> (<?php echo $v->blogCount;?>)</a></li>
			<?
			endforeach;
			endif;
			?>

		</ul> 
		
      
    </div>
    <div id="listing-results" class="group-set">
		
		
	<?php
	if($model){
	foreach($model as $k=>$v):
	?>
			<article class="post artPost">
				<div class="meta">
				<p class="day">  <?php echo date('d',strtotime($v->date_added));?> </p>
				<p class="month"> <?php echo date('M',strtotime($v->date_added));?>   </p>
				<p class="month"> <?php echo date('Y',strtotime($v->date_added));?> </p>
				</div>
				<div class="post-content blogPost">
				<h1 class="entry-title">
					<a rel="bookmark" title="" href="<?php echo Yii::app()->createUrl('rs-blog/'.$v->slug.'/details');?>"> <?php echo $v->title; ?>      </a></h1>
					<p>
						<?php 
						$string = strip_tags($v->content);
						echo  (strlen($string)>250) ? substr($string,0,250).'...':$string;?>

					</p>
				<p class="bot-control">  <a class="readmore" href="<?php echo Yii::app()->createUrl('rs-blog/'.$v->slug.'/details');?>">Read more</a> </p>
				</div>
			</article>

	<?
	endforeach;
	}
	else
	{
		?>
						<h1 class="entry-title">No Records found..</h1>
		
		<?php
	}
	?>	
		
      <style>
      
      
		.paging_back_inactive {
			background-color: #eeeeee !important;
			border-color: #d8d9da !important;
			border-radius: 0.166667em !important;
			border-style: solid !important;
			border-width: 1px 1px 3px;
			color: #989898 !important;
			display: inline-block !important;
			padding: 0.833333em 1.16667em!important;
			text-decoration: none !important;


		}
      </style>
      
     
     	<div class="pagingarea">
		<div class="actions">
		<?php 
		//if($pages->itemCount>3){
		$this->widget('frontend.components.web.widgets.SimplaPager', array(
		'pages'=>$pages,
		));  
		//}
		?>
		</div></div> </div>           
                
    
     <?php   $this->widget('frontend.components.web.widgets.recentposts.RecentPostWidget');?> 
