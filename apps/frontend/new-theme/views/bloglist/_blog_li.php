<?php
$timthumb =  Yii::app()->apps->getBaseUrl('timthumb.php');
$read_more =  'Read more'  ;
$last_updated_on = 'Last updated on' ;
 $langaugae = 'en';
$commonModel = new OptionCommon();
?>
<div class="container">
    <div class="row">
        <!-- Blog Posts Section -->
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($ads as $k => $v): ?>
                    <?php
                    if (!empty($v->featured_image) && !is_null($v->featured_image)){
                        $featuredImageUrl = Yii::app()->baseUrl . '/uploads/images/' . $v->featured_image;
                    } else {
                        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $featuredImageUrl);
                    }
                    ?>
                    <div class="col-md-4 mb-4 d-flex">
                        <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" class="blog-link">
                            <div class="card w-100">
                                <div class="card-content d-flex flex-column">
                                    <div class="blog-img">
                                        <img class="lozad card-img-top" style="object-fit: cover;" alt="<?php echo $v->title; ?>" decoding="async" src="<?php echo is_array($featuredImageUrl) ? @$featuredImageUrl['1'] : $featuredImageUrl; ?>">
                                    </div>
                                    <div class="blog-text">
                                        <?php echo $v->title; ?>
                                    </div>
                                    <div class="blog-meta">
                                        <?php 
                                        echo date('F j, Y', strtotime($v->date_added)); 
                                            $author_id = $v->author_id;
                                            // Find the author by author_id
                                            $author = BlogAuthors::model()->findByPk($author_id);
                                        ?> 
                                        <?php if ($author && !empty($author->name)): ?>
                                            <span class="dot">•</span> <?php echo $author->name; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<style>
    .card {
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 350px; /* Set a fixed height for the card */
}

.card-content {
    position: relative;
    display: flex;
    padding: 0px;
    height: 100%;
    flex-direction: column;
}

.blog-img {
    flex: 1;
    overflow: hidden; /* Ensures the image doesn't overflow the card */
}

.blog-img img {
    display: block;
    width: 100%;
    height: auto;
}

.blog-text {
    padding: 15px;
    font-size: 16px;
    color: #333;
    font-weight: bold;
    text-align: left;
    margin-top: auto;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit to 2 lines */
    -webkit-box-orient: vertical;
    height: 50px; /* Set a fixed height for the text section */
}
.blog-meta {
    font-size: 14px;
    color: #777;
    margin-top: 15%;
    padding-left: 10px;
    padding-top: 10px;
    border-top: 1px solid #7777778a;
}

@media only screen and (max-width: 1024px) {
 
    .blog-meta {
        margin-top: 6% !important;
    }
}
</style>
