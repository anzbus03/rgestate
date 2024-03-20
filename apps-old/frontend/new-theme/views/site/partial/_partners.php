  <!-- Start RG Estate Partners -->
  <section class="rg-partners">
      <div class="rg-section-header text-center mx-auto">
          <h2 class="rg-fs-30 rg-sm-fs-24 rg-text-blue rg-fw-600 text-capitalize rg-mt-20">Our Clients and Partners</h2>
          <p class="rg-fs-18 rg-sm-fs-14 rg-text-gray-600 rg-fw-400 rg-mt-20">We are proud to work with these companies</p>
      </div>
      <div class="rg-partners-bg bg-white d-flex align-items-center flex-column justify-content-center rg-mt-40">
          <div class="container">
              <ul class="rg-partners-list d-flex align-items-center justify-content-between flex-wrap">
                  <?php 
                  
            		foreach ($partners as $partner) {
            	?>
                  <li>
                      <img class="img-fluid w-100 d-block" src="<?php echo Yii::App()->apps->getBaseUrl('uploads/partners/'.$partner["image"]) ?>" alt="<?php echo $partner["image"] ?>">
                  </li>
                  <?php } ?>
                  
              </ul>
          </div>
      </div>
  </section>
  <!-- End RG Estate Partners -->
