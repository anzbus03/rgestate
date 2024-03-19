  <!-- Start RG Estate Get the Latest News & Offers -->
  <section class="rg-news rg-mt-70">
      <div class="container">
          <div class="rg-news-bg rg-br-10 position-relative overflow-hidden">
              <div class="row align-items-center position-relative">
                  <div class="col-lg-7">
                      <h2 class="rg-fs-32 rg-sm-fs-24 rg-fw-700 text-white"><?php echo $this->tag->getTag('stay_informed','Stay Informed with Our Newsletters');?></h2>
                      <p class="rg-fs-16 rg-sm-fs-14 rg-fw-400 text-white mt-3">
                          <?php echo $this->tag->getTag('informative_newsletters','Explore our informative newsletters to stay updated on the latest developments in the real estate industry. From market trends to investment opportunities and insights, our newsletters are your key to making informed decisions.');?>
                      </p>
                  </div>
                  <div class="col-lg-5">
                      <form action="" class="rg-subscribe d-flex justify-content-start justify-content-sm-end w-100">
                          <div class="form-group position-relative w-100 d-flex align-items-center">
                              <!--<svg width="15" height="11" class="rg-fill-blue">-->
                              <!--    <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-email1"></use>-->
                              <!--</svg>-->
                              <!--<input type="text" class="form-input w-100 border-0" placeholder="Email Address">-->
                              <button id="subscribe_modal" data-toggle="modal" data-target="#exampleModal" type="button" class="btn"><?php echo $this->tag->getTag('subscribe_now','Subscribe Now');?>!</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End RG Estate Get the Latest News & Offers -->