<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="center" style="padding-top:0px;">
    <?php
  if ($slug != "blog") {


  ?>
    <div class="page-title-wrapper">
        <div class="page-title">
            <div class="left-side">
                <h1><?php echo ucfirst(!empty($articleCategoryFromSlug->name_other) ? $articleCategoryFromSlug->name_other : $articleCategoryFromSlug->name); ?>
                </h1>
                <div class="breads">
                    <div class="page-breadcrumbs">
                        <div class="breadcrumbs-content"> <?php echo $this->tag->getTag('you-are-at', 'You are at'); ?>:
                            <a
                                href="<?php echo Yii::app()->createUrl('site/index'); ?>"><?php echo $this->tag->getTag('home', 'Home'); ?></a>
                            \ <a
                                href="<?php echo Yii::app()->createUrl('blogs'); ?>"><?php echo $this->tag->getTag('blog', 'Blog'); ?></a>
                            \ <span
                                class="current"><?php echo !empty($articleCategoryFromSlug->name_other) ? $articleCategoryFromSlug->name_other : $articleCategoryFromSlug->name; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
  } else {
  ?>
    <div class="wpb_wrapper">
        <div class="post-section-wrapper post-section-height wpb_content_element1" style="  height: 400px;  ">
            <div class="post-section-single post-section-hover fullheight post-section-width6 pr20">
                <?php
          if ($resource1) {


          ?>
                <div class="post-section-inner"> <a class="entire-post" title="<?php echo $resource1->title; ?>"
                        href="<?php echo Yii::app()->createUrl($resource1->slug . '/blog'); ?>">
                        <?php
                preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $resource1->content, $Imagesresource);

                ?>
                        <div class="post-thumb-class"
                            style="background-image: url(<?php echo  @$Imagesresource['1']; ?>); "></div>
                    </a>
                    <div class="post-tags big-tags"><a title="<?php echo $resource1->title; ?>"
                            href="<?php echo Yii::app()->createUrl($resource1->slug . '/blog'); ?>"
                            class="url-wrapper-absolute"></a>
                        <?php
                if ($resource1->categories):
                  foreach ($resource1->categories as $k => $v):
                ?>
                        <a href="<?php echo Yii::app()->createUrl('bloglist/index', array('slug' => $v->slug)); ?>"
                            class="cat-url post_cat_tag fl category-bg-color-1"><?php echo ucfirst($v->fieldName); ?>
                        </a>
                        <?php
                  endforeach;
                endif;
                ?>
                    </div>
                    <a class="post-section-title post-secton-post-title-big"
                        href="<?php echo Yii::app()->createUrl($resource1->slug . '/blog'); ?>"
                        title="<?php echo $resource1->title; ?>">
                        <h1><?php echo $resource1->title; ?></h1>
                    </a>
                </div>
            </div>
            <?php
          }
      ?>
            <?php
      if ($news1) {


        //print_r($news1);exit;
      ?>
            <?php
        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $news1->content, $Imagenews);



        ?>
            <div class="post-section-width4 fullheight fullheight1">
                <div class="small1 post-section-single halfheight post-section-hover pb10 pr20">
                    <div class="post-section-inner"> <a class="entire-post" title="<?php echo $news1->title; ?>"
                            href="<?php echo Yii::app()->createUrl($news1->slug . '/blog'); ?>">
                            <div class="post-thumb-class"
                                style="background-image: url(<?php echo  @$Imagenews['1']; ?>); "></div>
                        </a>
                        <div class="post-tags big-tags"><a title="<?php echo $news1->title; ?>"
                                href="<?php echo Yii::app()->createUrl($news1->slug . '/blog'); ?>"
                                class="url-wrapper-absolute"></a>
                            <?php
                if ($news1->categories):
                  foreach ($news1->categories as $k => $v):
                ?>
                            <a href="<?php echo Yii::app()->createUrl('bloglist/index', array('slug' => $v->slug)); ?>"
                                class="cat-url post_cat_tag fl category-bg-color-2"><?php echo ucfirst($v->fieldName); ?>
                            </a>
                            <?php
                  endforeach;
                endif;
                ?>
                        </div>
                        <a class="post-section-title post-secton-post-title-small"
                            href="<?php echo Yii::app()->createUrl($news1->slug . '/blog'); ?>"
                            title="<?php echo $news1->title; ?>">
                            <h1><?php echo $news1->title; ?></h1>
                        </a>
                    </div>
                </div>
                <?php
      }
        ?>
                <?php
        if ($tips1) {

        ?>
                <div class="small1 post-section-single halfheight post-section-hover pr20 pt10">
                    <div class="post-section-inner"> <a class="entire-post" title="<?php echo $tips1->title; ?>"
                            href="<?php echo Yii::app()->createUrl($tips1->slug . '/blog'); ?>">
                            <?php
                preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $tips1->content, $Imagetips);

                ?>
                            <div class="post-thumb-class"
                                style="background-image: url(<?php echo  @$Imagetips['1']; ?>); "></div>
                        </a>
                        <div class="post-tags big-tags"><a title="<?php echo $tips1->title; ?>"
                                href="<?php echo Yii::app()->createUrl($tips1->slug . '/blog'); ?>"
                                class="url-wrapper-absolute"></a>
                            <?php
                if ($tips1->categories):
                  foreach ($tips1->categories as $k => $v):
                ?>
                            <a href="<?php echo Yii::app()->createUrl('bloglist/' . $v->slug . ''); ?>"
                                class="cat-url post_cat_tag fl category-bg-color-2"><?php echo ucfirst($v->fieldName); ?>
                            </a>
                            <?php
                  endforeach;
                endif;
                ?>
                        </div>
                        <a class="post-section-title post-secton-post-title-small"
                            href="<?php echo Yii::app()->createUrl($tips1->slug . '/blog'); ?>"
                            title="<?php echo $tips1->title; ?>">
                            <h1><?php echo $tips1->title; ?></h1>
                        </a>
                    </div>
                </div>
            </div>
            <?
        }
      ?>
            <?php
      if ($reviews1) {
      ?>
            <div class="post-section-single post-section-hover fullheight post-section-width2">
                <div class="post-section-inner"> <a class="entire-post" title="<?php echo $reviews1->title; ?>"
                        href="<?php echo Yii::app()->createUrl($reviews1->slug . '/blog'); ?>">
                        <?php
              preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $reviews1->content, $Imagereviews);

              ?>
                        <div class="post-thumb-class"
                            style="background-image: url(<?php echo  @$Imagereviews['1']; ?>); "></div>
                    </a>
                    <div class="post-tags big-tags"><a title="<?php echo $reviews1->title; ?>"
                            href="<?php echo Yii::app()->createUrl($reviews1->slug . '/blog'); ?>"
                            class="url-wrapper-absolute"></a>
                        <?php
              if ($reviews1->categories):
                foreach ($reviews1->categories as $k => $v):
              ?>
                        <a href="<?php echo Yii::app()->createUrl('bloglist/' . $v->slug . ''); ?>"
                            class="cat-url post_cat_tag fl category-bg-color-2"><?php echo ucfirst($v->fieldName); ?>
                        </a>
                        <?php
                endforeach;
              endif;
              ?>
                    </div>
                    <a class="post-section-title post-secton-post-title-small"
                        href="<?php echo Yii::app()->createUrl($reviews1->slug . '/blog'); ?>"
                        title="<?php echo $reviews1->title; ?>">
                        <h1><?php echo $reviews1->title; ?></h1>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
            <?php
      }
      ?>
        </div>
    </div>
    <?php
  }
  ?>
    <div class="clear"></div>

    <div id="container" class="container">

        <div id="content-wrapper" class="">
            <div id="container">
                <div class="width-thousand">

                    <div class="newslist">
                        <ul id="newsSection">
                            <?php
              if ($model) {
                foreach ($model as $k => $v) {


              ?>
                            <li class="nsdd <?php if ((int)($k + 1) % 3 == 0  and $k != 0) {
                                    echo 'last';
                                  }; ?>">
                                <div class="mainnewscol radius3">
                                    <div class="newscontnt">
                                        <div> <a title="<?php echo $v->title; ?>"
                                                href="<?php echo Yii::app()->createUrl($v->slug . '/blog'); ?>"
                                                rel="nofollow">
                                                <?php
                            preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);

                            ?>
                                                <img alt="<?php echo $v->title; ?>"
                                                    data-original="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php'); ?>?src=<?php echo  @$imges['1']; ?>&h=202&w=317&zc=1"
                                                    src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php'); ?>?src=<?php echo  @$imges['1']; ?>&h=202&w=317&zc=1"
                                                    class="PaddingTwo jqlazy" style="display: block;"></a> </div>
                                        <div class="titlebox titlelength">
                                            <h3><a title="<?php echo $v->title; ?>"
                                                    href="<?php echo Yii::app()->createUrl($v->slug . '/blog'); ?>"
                                                    class="LHight16"
                                                    style="float: none; position: static;"><?php echo (strlen($v->title) > 100) ? substr($v->title, 0, 100) . '...' : $v->title; ?></a>
                                            </h3>
                                            <div class="newsdatetime">
                                                <?php echo date('M d , Y h:i A', strtotime($v->date_added)); ?></div>
                                            <p>
                                                <?php
                            $string = strip_tags($v->content);
                            echo (strlen($string) > 150) ? substr($string, 0, 150) . '...' : $string;
                            ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="newsdetailbg clearfix">
                                        <ul>
                                            <li class="first">
                                                <div class="newsview"> <span class="viewico2 sprite"></span>
                                                    <?php echo $v->viewCount; ?> <span class="text12">Views</span></div>
                                            </li>
                                            <li class="last">
                                                <div class="newsview"> <a
                                                        href="<?php echo Yii::app()->createUrl($v->slug . '/blog'); ?>"
                                                        title="Read More"><span class="redmorico2 sprite"></span>Read
                                                        More</a></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <?php
                }
              }
              ?>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
                </li>
                </ul>
            </div>
            <style>

            </style>
            <div style="clear:both"></div>
        </div>
        <div class="container-wrapper">

        </div>
        <div style="height:50px"></div>
    </div>
    <!-- end container -->
</div>
<!-- end center -->
<div class="clear"></div>
</div>
</div>
</div>
<script>
jQuery(document).ready(function($) {


    $('#container').scrollPagination({
        nop: <?php echo $limit; ?>,
        offset: 0,
        error: 'You have reached the end of the post.',
        delay: 500,
        slug: '<?php echo @$articleCategoryFromSlug->slug; ?>',
        scroll: true
    });

});



(function($) {
    $.fn.scrollPagination = function(options) {
        var settings = {
            nop: 10, // The number of posts per scroll to be loaded
            offset: 0, // Initial offset, begins at 0 in this case
            error: 'No More Posts!',
            delay: 500,
            slug: 'blog',
            scroll: true
        }

        if (options) {
            $.extend(settings, options);
        }

        return this.each(function() {
            $this = $(this);
            $settings = settings;
            var offset = $settings.offset;
            var busy = false;
            if ($settings.scroll == true) $initmessage = '';
            else $initmessage = 'Click for more';
            $this.append('<div class="content"></div><div class="loading-bar">' + $initmessage +
                '</div>');

            $('.animation_images').show();

            function getData() {

                $.get('<?php echo Yii::app()->createUrl('blogruntimeloader'); ?>', {

                    number: $settings.nop,
                    offset: offset,
                    slug: $settings.slug,
                }, function(data) {
                    $this.find('.loading-bar').html($initmessage);
                    $('.animation_images').hide();

                    if (data == "1") {

                        $this.find('.loading-bar').hide();
                    } else {

                        offset = offset + $settings.nop;
                        $this.find('#newsSection').append(data);
                        busy = false;
                    }
                });
            }

            getData();

            if ($settings.scroll == true) {
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
                        busy = true;
                        $('.animation_images').hide();
                        $this.find('.loading-bar').html('Loading...');

                        setTimeout(function() {
                            getData();
                        }, $settings.delay);
                    }
                });
            }

            $this.find('.loading-bar').click(function() {
                if (busy == false) {
                    busy = true;
                    getData();
                }
            });
        });
    }
})(jQuery);
</script>