<?php
					$art = new Article();
					 
					$formData = array_filter((array)$_GET);
		 
		$formData['parent_id'] =  '20';
		 
		 
	 
        $modelCritera=Article::model()->findPosts($formData,$count_future=false,1,$calculate=false);
        $modelCritera->limit = 6 ; 
        $result = Article::model()->findAll($modelCritera);
   	
					
					?>
<style>
#main-content .widget-title h4 {
    font-size: 23px !important;
    padding-left: 10px;
    border-left: 3px solid var(--secondary-color);
    padding-top: 0px;
    padding-bottom: 0px;
    line-height: 1;
    margin-bottom: 25px;
}.detail img {
  
    margin-bottom: 15px;
}
    #main-content .detail p {
    font-size: 15px;
    line-height: 28px;
    font-weight: 300;
    color: #32313a !important;
    font-weight: normal;
}
 
article.hentry header.heading {
    padding: 40px 5% 0 5%;
}article.hentry .detail {
    padding: 30px 5% 0 5%;
    margin: 0;
}
#main-content h1.article-title {
    font-size: 24px !important;
    line-height: 36px;
     
    font-family: var(--main-font);
}

@media only screen and (max-width: 1024px) {
  #blogheader nav#main-menu {
    position: relative;
     
    top: unset ;
   
}
}
 html[dir="ltr"] .detail ul li:before {
     
    padding-left: -20px !important;
   
    margin: 0 !important;
}
 html[dir="rtl"] .detail ul li:before {
     
    padding-right: -20px !important;
   
    margin: 0 !important;
}
html .detail ul li { width: 100% !important;
    background: #fff !important;
    line-height: 1.4 !important;
    height: auto !important;
    margin: 0 !important;
    padding: 0px !important;;}
    #main-content {
    padding: 70px 0;
    background: #fff;
}
.box { background:transparent;}#main-content {
   
    background: #fff;
}
 
.f-ull-height a { position:absolute;left:0;right:0;top:0;bottom:0;z-index:111;}
.blog-text{
    font-weight: 600;
    font-size: 15px;
}
#bloglist li.brkr:nth-child(6n+1) {
	clear: both;
}#main-content{ padding-top:0px !important;}
#blogheader #main-menu {
  
    box-shadow: unset; 
}nav#main-menu ul#menu-main-menu li a {
    color: #484848;
    text-transform: none;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    letter-spacing: .1px;
    padding: 10px 20px;
    font-size: 16px;
    color: #222;
    transition: all ease-in-out .1s;
    margin: 0;
    border: 1px solid #e9ecf1;
    border-radius: 22px; margin-right:15px; 
}nav#main-menu ul.j-main-menu {
   
    justify-content: flex-start; 
}nav#main-menu ul#menu-main-menu li a:hover, nav#main-menu ul#menu-main-menu li.active a {
  
    background: #fafafa;
}.banner{
        margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);position: relative;
    height: 20.56vw;
    background-color:rgba(0,0,0,0.8);background-size:cover;background-repeat:no-repeat;    background-position: center;
}#mainContainerClass, #pageContainer {
    max-width: 100%;
    width: 100%;
}
.abs-banner::before{content:'';left:0px;right:0px;top:0px;bottom:0px;position:absolute;background:rgba(0,0,0,0.2); }
.bloghead {
    align-items:center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;display:flex;z-index: 1;
    position: relative;
}.bloghead {
    
}.bloghead h1, .bloghead p {
    background-color: transparent !important;
    color: #fff !important; 
}.bloghead   h1 {
    margin-bottom: 19px;
}.bloghead p {
    font-weight: 300;
    font-size: 16px;
}
.abs-banner{
   
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: '';
 
}.bloghead p {
    font-weight: 300;
    font-size: 18px;
    font-weight: 400;
    max-width: 650px;
    text-align: center;
    line-height: 1.3;
}
.box {
   
    padding-left: 0px;
    padding-right: 0px;
    margin-top: 10px;
}article.hentry .detail {
    padding: 0px 0 0 0 !important; 
}
#main-content article.hentry {
  
    box-shadow: unset;
}article.hentry .detail {
    padding: 30px 0 0 0;
    margin: 0;
}article.hentry header.heading,#main-content h1.article-title {
    
    text-align: initial !important;    padding: 0px !important;
}.share-buttons a .fa {
    width: 38px;
    height: 38px;
    line-height: 38px;
    background: #f4f5f7;
    border-radius: 50%;
    color: var(--secondary-color);
    transition: all .2s ease-out;
}
.addthis_toolbox {
    display: flex;
    justify-content: center;
    margin: 40px 0px 0px;
}.main {
    background: transparent;
    display: flex;
    padding: 10px 0px;
}
@media only screen and (max-width: 768px) {
  html #main-content .detail h2 {
    font-size: 28px !important;
    line-height:  1.2; 
}
 html #main-content .detail h3 {
    font-size: 24px !important;
    line-height: 1.2; 
}
 html #main-content .detail h1 {
    font-size: 32px !important;
    line-height:  1.2; 
}
.sb-btn {
 
    position: fixed;
    bottom: 36px; 
    left: 0;
    right: 0;
    border-radius: 0px !important;
}
}
.breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 10px;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    padding: 0 5px;
    color: #6c757d;
}

.publish-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.publish-date {
    color: #6c757d;
    font-size: 0.9em;
    margin-bottom: 20px;
}

</style>  
<style>#mainContainerClass{max-width:100%; }</style>

<section id="main-content" class="clearfix">
	<div class="container">
	    <div class="row margin-top-40">
		<div class="col-sm-9  ">
		 
				 <article   class="post type-post status-publish format-standard has-post-thumbnail hentry category-rental-basics category-tips-advice">
				     <header class="heading">
                         <!-- Breadcrumbs -->
                         <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo Yii::app()->getBaseUrl('/'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo Yii::app()->createUrl('bloglist/index'); ?>">Blog</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $model->title;?></li>
                            </ol>
                        </nav>
					<h1 class="article-title"><?php echo $model->title;?></h1>
                    <div class="publish-info">
                        <p class="publish-date">Last Updated - <?php echo date('F j, Y', strtotime($model->last_updated)); ?></p>
                        <div class="share-buttons">
                            <a title="Facebook Share" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>"> 
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a title="Twitter Share" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>&amp;url=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>&amp;text=<?php echo urlencode($model->title);?>">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </div>
                    </div>
        
			</header>
			      <div id="blogheader" class="padding-bottom-25">
	<nav id="main-menu" class="default" style="position:relative;top: 6px;">
		<ul id="menu-main-menu" class="main j-main-menu sf-js-enabled">
		    <li   class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4252 <?php echo $slug=='blog' ? 'active':'';?>"><a href="<?php echo Yii::app()->createUrl('bloglist/index');?>"><?php echo $this->tag->getTag('blog','Blog')  ;?> </a>
			</li> 
			<?php
			foreach($category as $k=>$v){ ?> 
			<li   class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-4252 <?php echo $slug==$v->slug ? 'active':'';?>"><a href="<?php echo Yii::app()->createUrl('bloglist/index',array('category'=>$v->slug));?>"><?php echo ucfirst($v->name)  ;?> </a>
			</li> 
			<?php } ?> 
		</ul>
	</nav>
</div>
	
				<?php
				if(isset($imageUrl)){
					$timthumb =  Yii::app()->apps->getBaseUrl('timthumb.php');
					 ?> 
				<div class="thumbnail">
					 
						<img style="object-fit: contain;margin-top:10px;display:block;" src="<?php echo @$imageUrl;?>" class="attachment-blog-image size-blog-image wp-post-image" alt="<?php echo $model->title;?>" srcset="<?php echo $imageUrl;?> 2200w,<?php echo $timthumb.'?src='.@$imageUrl.'&h=167&w=300&zc=1';?> 300w,<?php echo $timthumb.'?src='.@$imageUrl.'&h=427&w=768&zc=1';?> 768w,<?php echo $timthumb.'?src='.@$imageUrl.'&h=569&w=1024&zc=1';?> 1024w" sizes="(max-width: 2200px) 100vw, 2200px" width="2200" height="1222">
					 
				</div>
				<?php } ?> 
 
				<div class="detail">
					<p><?php  echo $model->content ; 	?></p>
                    <hr>
                    <?php
                        // Assuming $model is the current article model
                        $author_id = $model->author_id;

                        // Find the author by author_id
                        $author = BlogAuthors::model()->findByPk($author_id);

                        if ($author !== null) {
                            $imagePath = Yii::app()->baseUrl . '/uploads/images/' . $author->image;
                            ?>
                            <div class="author-details">
                                <img src="<?php echo $imagePath; ?>" style="width: 25% !important;" alt="Author Image" class="author-image">
                                <div class="author-info">
                                    <h5 class="author-name"><?php echo htmlspecialchars($author->name); ?></h5>
                                    <p class="author-description"><?php echo htmlspecialchars($author->description); ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    ?>

                    <?php
                        // Assuming $model->tags contains a comma-separated list of tags
                        $tags = isset($model->tags) ? explode(',', $model->tags) : [];

                        // Check if there are any tags
                        if (!empty($tags)) {
                            echo '<div class="tags">';
                            foreach ($tags as $tag) {
                                // Trim any extra whitespace and encode the tag for safe output
                                $tag = trim(htmlspecialchars($tag));
                                echo '<span class="tag">' . $tag . '</span>';
                            }
                            echo '</div>';
                        }
                    ?>

                   
                    <?php
    // Assuming $current_slug is the slug of the current blog post
    $current_slug = $model->slug;

    // Placeholder variables for previous and next posts
    $previous_post = null;
    $next_post = null;

    // Find the current post index
    $current_index = -1;
    foreach ($result as $index => $post) {
        if ($post->slug == $current_slug) {
            $current_index = $index;
            break;
        }
    }

    // Determine previous and next posts if the current post is found
    if ($current_index != -1) {
        if ($current_index > 0) {
            $previous_post = $result[$current_index - 1];
        }
        if ($current_index < count($result) - 1) {
            $next_post = $result[$current_index + 1];
        }
    }
    // Navigation links for previous and next posts
    echo '<div class="navigation">';

    if ($previous_post) {
        echo '<a href="' . Yii::app()->createUrl('bloglist/details', array('slug' => $previous_post->slug)) . '" class="previous-post">
            &larr; Previous: ' . htmlspecialchars(mb_strimwidth($previous_post->title, 0, 30, '...')) . '
        </a>';
    }

    if ($next_post) {
        echo '<a href="' . Yii::app()->createUrl('bloglist/details', array('slug' => $next_post->slug)) . '" class="next-post">
            Next: ' . htmlspecialchars(mb_strimwidth($next_post->title, 0, 30, '...')) . ' &rarr;
        </a>';
    }

    echo '</div>';
?>

                    <style>
                        .navigation {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 30px;
                        }

                        .previous-post, .next-post {
                            background-color: #f1f1f1;
                            color: #333;
                            border-radius: 3px;
                            padding: 10px 15px;
                            text-decoration: none;
                            font-size: 1em;
                        }

                        .previous-post:hover, .next-post:hover {
                            background-color: #ddd;
                        }

                        .author-details {
                            display: flex;
                            align-items: center;
                            margin-top: 30px;
                        }

                        .author-image {
                            border-radius: 50%;
                            width: 50px;
                            height: 100px;
                            margin-right: 20px;
                        }

                        .author-info {
                            display: flex;
                            flex-direction: column;
                        }

                        .author-name {
                            font-size: 1.5em;
                            margin: 0;
                        }

                        .author-description {
                            font-size: 1em;
                            color: #666;
                        }

                        .tags {
                            margin-top: 10px;
                        }

                        .tag {
                            display: inline-block;
                            background-color: #f1f1f1;
                            color: #333;
                            border-radius: 3px;
                            padding: 5px 10px;
                            margin-right: 5px;
                            margin-top: 5px;
                            font-size: 0.9em;
                        }

                    </style>
				 
					<!-- <div class="share-buttons">
						<div class="addthis_toolbox addthis_default_style">
							<a title="Facebook Share" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>"> <span class="fa fa-facebook"></span>
							</a>	<a title="Twitter Share" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>&amp;url=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug.'/blog'));?>&amp;text=<?php echo urlencode($model->title);?>"><span class="fa fa-twitter"></span></a>
						</div>
					</div> -->
									 
				</div>
				 <div class="clearfix"></div>
							   
							 
							  <div class="clear"></div>
			</article>
			<div class="wpwp-banners"></div>
		
		
		</div>
		<div class="col-sm-3"  id="stky_w" >
		    <div  id="stky" style="width:100%;">
		     <div>
		      <script src="<?php echo $this->app->apps->getBaseUrl('assets/js/sticky.js');?>"></script> 
                    <script>
                    var widowwidth = screen.width; 
                    $(function(){
                    
                                if(widowwidth > 786){ 
                                    
                                    
                                       
                    		     setTimeout(function(){
                                    	var footer_height  = $("footer ").height()+ parseInt(50); 
                                        var tpheight = 0;
                                    	$("#stky").sticky({ topSpacing:90,getWidthFrom: '#stky_w',bottomSpacing:footer_height});
                                }, 5000);
                    		
                    			}
                    			});
                                     
                    </script>
		    
		    
		    	<style>
				.comments-list {
    padding: 0;
    list-style: none;
}.comments-list li {
    margin-bottom: 10px;
    display: table;
    width: 100%;
}.comments-list li .alignleft {
    float: left;
    margin: 0 15px 10px 0;
    width: 80px;
    height: 50px;
    overflow: hidden;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    position: relative;
}.comments-list small {
    font-size: 80%;
    font-weight: 400;
}.comments-list h3 {
    font-size: 14px;
    padding: 0 0 0;
    margin-bottom: 0;
    margin-top: 0px;
    letter-spacing: 0;
}
			.comments-list h3 a {
    color: #555;
}	.comments-list li a {
    padding: 5px 0 5px 0px
}.search_blog .form-group input[type="submit"] {
    border: 0;
    position: absolute;
    top: 12px;
    right: 5px;
    background-color:#550a12;
    color: #fff;
    font-weight: 500;
    height: 32px;
    padding: 0 10px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    border-radius: 3px;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}.share-buttons a .fa {
    width: 38px;
    height: 38px;
    line-height: 38px;
    background: #f4f5f7;
    border-radius: 50%;
    color: var(--secondary-color);
    transition: all .2s ease-out;align-items: center;
    justify-content: center;
    display: inline-flex;
    margin: 0px 10px;
}.share-buttons a:hover .fa {background: var(--secondary-color);color:#fff ;
}
				</style>
				
								 
					<!-- /widget -->
					 <button type="button" class="btn btn-primary sb-btn  " data-toggle="modal" data-target="#exampleModal"><?php echo  $this->tag->getTag('subscribe_to_our_free_newslett','Subscribe to our free newsletter');?></button>

				<!-- /widget -->
					
					<?php
					if(!empty($result)){ ?> 
					<div class="widget">
						<div class="widget-title">
							<h4>Latest Updates</h4>
						</div>
						<ul class="comments-list">
							<?php
							foreach($result as $k2=>$v2){
								preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $v2->content, $image);
	 
							$img = @$image['1'] ;
							?> 
							<li>
								<div class="alignleft">
									<a href="<?php echo Yii::app()->createUrl('bloglist/details', array('slug' => $v2->slug));?>"><img src="<?php echo $img;?>" alt=""></a>
								</div>
								<h3><a href="<?php echo Yii::app()->createUrl('bloglist/details', array('slug' => $v2->slug));?>" title=""><?php echo $v2->title;?></a></h3>
							</li> 
							<?php } ?> 				 
						</ul>
					</div>
					<?php } ?>  
                    <hr>
                        <h4 class="text-center">Subscribe To Our Free Newsletter</h4>
                        <div class="form-container">
                            <script data-b24-form="inline/34/btf76q" data-skip-moving="true">
                                (function(w,d,u){
                                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
                                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
                                })(window,document,'https://cdn.bitrix24.in/b25292121/crm/form/loader_34.js');
                            </script>
                        </div>
           </div>
			</div>
		</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section> 
<style>
    .detail img { width:100% !important;height:auto !important;  }
    #main-content .detail h1 {   font-size: 48px !important;line-height: 48px;color: #32313A !important;font-weight: bold !important;}
     #main-content .detail h2 {   font-size: 38px !important;line-height: 38px;color: #32313A !important;font-weight: bold !important;}
    #main-content .detail h3 {   font-size: 28px !important;line-height: 28px;color: #32313A !important;font-weight: bold !important;}
     #main-content .detail h4 {   font-size: 18px !important;line-height: 18px;color: #32313A !important;font-weight: bold !important;}
</style>
