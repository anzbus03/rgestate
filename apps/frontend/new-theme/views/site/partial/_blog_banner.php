  <style>
      .rg-blogs h2 a {
          color: var(--bs-blue);
      }
  </style>
  <!-- Start RG Estate Blogs -->
  <section class="rg-blogs">
      <div class="container">
          <div class="rg-section-header text-center mx-auto">
              <h3 class="rg-fs-16 rg-text-dark rg-fw-400 text-uppercase"><?php echo Yii::app()->tags->getTag('blog','Blogs')?></h3>
              <h2 class="rg-fs-30 rg-sm-fs-24 rg-text-blue rg-fw-600 text-capitalize rg-mt-20">
                  <a href="https://www.rgestate.com/blog/">
                      <?php echo Yii::app()->tags->getTag('latest_blog','Explore Our Latest Blog Posts')?>
                  </a>
              </h2>
              <p class="rg-fs-18 rg-sm-fs-14 rg-text-gray-600 rg-fw-400 rg-mt-20">
                    <?php echo Yii::app()->tags->getTag('blog_articles','Immerse in insightful blog articles exploring real estate\'s evolution. From investment tips to market trends, it\'s your source for empowering property decisions. Stay ahead in real estate with our thought-provoking blogs.')?>
              </p>
              <a href="https://www.rgestate.com/blog/" class="btn btn-primary d-inline-flex align-items-center rg-mt-30">
                <?php echo Yii::app()->tags->getTag('latest_blog','Explore Our Blog')?>
                </a>
          </div>
          <?php if (!empty($latest)) { ?>            
                <div class="row">
                <?php foreach ($latest as $blog) { ?>
                <?php preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $blog->content, $imges); ?>
                <?php 
                    $text =  strip_tags($blog->content);  
                    $text = substr($text,0,230);
                ?>
                    <!--<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">-->
                    <!--    <div class="rg-blog-card">-->
                    <!--        <div class="rg-blog-img overflow-hidden">-->
                    <!--            <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $blog->slug)); ?>">-->
                    <!--            <img class="d-block w-100 h-100 object-fit-cover" src="<?php echo $blog->generateImage(@$imges['1']); ?>" alt="Skills That You Can Learn In The Real Estate Market">-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--        <div class="rg-blog-card-body pt-4">-->
                    <!--            <ul class="rg-blog-list d-flex align-items-center">-->
                    <!--                <li class="d-flex align-items-center">-->
                    <!--                    <svg width="15" height="14" class="me-3">-->
                    <!--                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-calendar"></use>-->
                    <!--                    </svg>-->
                    <!--                    <span class="rg-fs-12 rg-fw-400 rg-text-gray-600"><?php echo date('F d,Y',strtotime($blog->last_updated)); ?></span>-->
                    <!--                </li>-->
                    <!--                <li class="d-flex align-items-center ms-4">-->
                    <!--                    <svg width="14" height="14" class="me-3">-->
                    <!--                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-tag"></use>-->
                    <!--                    </svg>-->
                    <!--                    <span class="rg-fs-12 rg-fw-400 rg-text-gray-600">Business</span>-->
                    <!--                </li>-->
                    <!--            </ul>-->
                    <!--        </div>-->
                    <!--        <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $blog->slug)); ?>" class="rg-fs-15 rg-fw-500 rg-text-dark mt-3 d-inline-block"><?php echo substr($blog->title,0,70); ?></a>-->
                    <!--        <p class="rg-fs-12 rg-fw-400 rg-text-gray-600 mt-4"><?php echo $text.' ...'; ?></p>-->
                    <!--        <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $blog->slug)); ?>" class="btn btn-outline-secondary mt-4">Read More</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <?php } ?>
                </div>
          <?php } ?>
      </div>
  </section>
  <!-- End RG Estate Blog -->