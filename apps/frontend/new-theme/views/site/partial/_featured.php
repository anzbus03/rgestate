<style>
    .success-modal{
        display:none;
    }
    .leadContact .btn.btn-primary {
        background-color: var(--bs-blue) !important;
    }
    .residential-card__address-heading span {
        color: #869099!important;
        font-size: 14px!important;
        line-height: 22.5px!important;
    }
    .pri.sec_1 {
        color: var(--bs-blue)!important;
    }
    span.sec_divdr {
        color: rgba(0,0,0,.8)!important;
        line-height: 1!important;
        display: inline-block;
        margin: 0 5px;
    }
    html textarea.input-text.form-control {
        border: 1px solid #dfe0e3;
        line-height: 1.4;
        padding: 10px 8px;
        color: #72727d;
        font: 13px arial;
    }
</style>
<!-- Start RG Estate Featured -->
<section class="rg-featured" dir="ltr">
    <div class="container">
        <div class="rg-section-header text-center mx-auto">
            <h3 class="rg-fs-16 rg-text-dark rg-fw-400 text-uppercase"><?php echo Yii::app()->tags->getTag('latest_listings','Latest Listings')?></h3>
            <h2 class="rg-fs-30 rg-text-blue rg-fw-600 text-capitalize rg-mt-20"><?php echo Yii::app()->tags->getTag('latest_properties','Our Latest Properties For Sale And Rent in UAE')?></h2>
            <p class="rg-fs-18 rg-sm-fs-14 rg-text-gray-600 rg-fw-400 rg-mt-20"><?php echo Yii::app()->tags->getTag('new_properties','Explore our new properties available for sale and rent in the UAE. From lucrative investment opportunities to comfortable living spaces, find your next venture or investment opportunity in our carefully curated listings.')?></p>
        </div>
        
        <ul class="nav nav-underline justify-content-center rg-underline-tabs border-bottom rg-mt-40" id="myTab"
            role="tablist">
            <?php foreach($featured as $key =>  $featured_list){ ?>
            <?php $category = $featured_list['category']; ?>
            <?php if($category) { ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo ($key == 0) ? 'active' : ''; ?>" id="cat-<?php echo $category->category_id; ?>-tab" data-bs-toggle="tab"
                        data-bs-target="#cat-<?php echo $category->category_id; ?>-tab-pane" type="button" role="tab" aria-controls="cat-<?php echo $category->category_id; ?>-tab-pane"
                        aria-selected="true"><?php echo Yii::app()->tags->getTag($category->slug,$category->category_name); ?></button>
                </li>
            <?php } ?>
            <?php } ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php  foreach($featured as $key =>  $featured_list){  //print_r($featured_list);?>
            <?php $category = $featured_list['category']; ?>
            <?php $listings = $featured_list['listings']; ?>
          
            <div class="tab-pane fade <?php echo ($key == 0) ? 'show active' : ''; ?>" id="cat-<?php echo $category->category_id; ?>-tab-pane" role="tabpanel"
                aria-labelledby="warehouse-tab" tabindex="0">
                <ul class="rg-featured-slider rg-arrow-wh">
                    <?php foreach( $listings as $add){ 
                        $category = Category::model()->findByPk($add->category_id);
                        // echo '<pre>'; print_r($add->category_id . " ASD"); echo '</pre>'; 
                        
                    ?>
                    <li>
                        <div class="rg-featured-card rg-br-16">
                            <div class="rg-featured-img position-relative">
                                <div
                                class="rg-badges text-uppercase d-flex align-items-center justify-content-between position-absolute w-100">
                                    <?php if($add->featured == "Y"){ ?>
                                        <span class="badge rg-bg-orange"><?php  echo Yii::app()->tags->getTag('featured','FEATURED'); ?></span>
                                    <?php }if($add->super_hot){ ?>
                                        <span class="badge rg-bg-black-rgb">SUPER HOT</span>
                                    <?php }else if($add->hot){ ?>
                                        <span class="badge rg-bg-black-rgb">HOT</span>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo $add->detailUrl;?>">
                                <?php
                                    $imagePath  = $add->getAd_image_singlenew("293");
                                    // $imagePath  = str_replace('/uploads/files/', '', $imagePath);
                                    $adImage    = AdImage::model()->findByAttributes(['ad_id' => $add->id]);
                                    $titleAltText   = $adImage->image_alt;
                                    $titleText      = $adImage->image_title;
                                    if ($adImage){
                                        $imagePath = ('/uploads/files/'. $adImage->image_name);
                                    }
                                    $watermarkImage = ImageWatermark::model()->findByPk(1);
                                    $watermarkSrc = '/uploads/files/' . $watermarkImage->watermark_image;
                                ?>
                                    
                                    <img class="d-block w-100 h-100 object-fit-cover watermarked-img"
                                        data-placeholder-background="#eee"
                                        alt="<?php echo $titleAltText; ?>"
                                        title="<?php echo $titleText; ?>"
                                        data-src="<?php echo $imagePath;?>"
                                        data-watermark-src="<?php echo $watermarkSrc; ?>"
                                        data-opacity="<?php echo $watermarkImage->opacity / 100; ?>"
                                        data-x="<?php echo $watermarkImage->position_x; ?>"
                                        data-y="<?php echo $watermarkImage->position_y; ?>"
                                        data-wm-width="<?php echo $watermarkImage->watermark_width; ?>"
                                        data-wm-height="<?php echo $watermarkImage->watermark_height; ?>">
                                </a>
                            </div>
                            <div class="rg-featured-body">
                                <div class="rg-featured-body-top">
                                    <h4 class="rg-fs-12 rg-fw-400 rg-text-dark text-uppercase"><?php echo $category->category_name; ?></h4>
                                    <h3 class="rg-fs-16 rg-fw-500 rg-text-dark mt-3"><?php echo $add->listRowPriceNew(); ?></h3>
                                    <h2 class="rg-fs-16 rg-fw-500 mt-4">
                                        <a href="<?php echo $add->detailUrl;?>" class="rg-text-blue"><?php echo substr($add->AdTitle2,0,55) ; ?></a>
                                    </h2>
                                    <p
                                        class="rg-fs-12 rg-fw-500 rg-text-gray-600 text-capitalize d-flex align-items-center mt-4">
                                        <svg width="8" height="14" class="me-2">
                                            <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-map"></use>
                                        </svg>
                                        <span><?php echo $add->listRowLocation();?></span>
                                    </p>
                                    <ul class="rg-featured-list d-flex flex-wrap">
                                        
                                        <li
                                            class="rg-fs-12 rg-fw-400 rg-text-gray-600 text-capitalize d-flex align-items-center w-50 mt-3">
                                            <svg width="13" height="13" class="me-3">
                                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-feet"></use>
                                            </svg>
                                            <span><?php echo $add->BuiltUpArea; ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <ul
                                    class="rg-featured-footer d-flex align-items-center justify-content-between border-top">
                                    <li>
                                        <a type="button" class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center" 
                                            onclick="OpenCallNewlatest(this)" 
                                            data-prop="<?php echo  $add->id ;?>" 
                                            data-agent="<?php echo $add->getAgencyName($add->user_id);?>" 
                                            data-ref="<?php echo $add->ReferenceNumberTitle;?>" 
                                            data-phone="<?php echo $add->getMobileNumber($add->user_id);?>" >
                                            <svg width="9" height="9" class="me-2">
                                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-call"></use>
                                            </svg>
                                            <span>Call</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center" onclick="OpenFormClickNew(this)" data-reactid="<?php echo $add->id;?>">
                                            <svg width="15" height="10" class="me-2">
                                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-envelop"></use>
                                            </svg>
                                            <span>Mail</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" data-function="save_favourite" data-id="<?php echo $add->id ?>" data-after="saved_fave" onclick="OpenFavouriteNew(this)" id="fav_button_<?php echo $add->id ?>"
                                            class="btn favbtn lastref btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center <?php echo $add->fav == 1 ? "active" : '' ?>">
                                            <svg width="14" height="12" class="me-2">
                                                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-heart"></use>
                                            </svg>
                                            <span>Save</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>                    
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>

</section>
<script>
    // Helper function to load an image with a Promise.
    // function loadImage(src) {
    //   return new Promise((resolve, reject) => {
    //     const img = new Image();
    //     img.crossOrigin = "anonymous";
    //     img.onload = () => resolve(img);
    //     img.onerror = () => reject(new Error("Failed to load image: " + src));
    //     img.src = src;
    //   });
    // }

    // // Main function to apply watermarks to all images with the class "watermarked-img".
    // function applyWatermarks() {
    //   // Define your base image dimensions (the reference dimensions).
    //   const baseWidth = 800;
    //   const baseHeight = 600;

    //   const watermarkedImages = document.querySelectorAll("img.watermarked-img");

    //   watermarkedImages.forEach(img => {
    //     // Prevent processing the same image twice.
    //     if (img.dataset.processed === "1") return;
    //     img.dataset.processed = "1";

    //     // Extract image and watermark settings from data attributes.
    //     // In this version, data-x and data-y represent the absolute coordinates in the base image.
    //     const mainSrc = img.getAttribute("data-src");
    //     const watermarkSrc = img.getAttribute("data-watermark-src");


    //     const opacity = parseFloat(img.getAttribute("data-opacity") || "0.5");
        
    //     // These values (e.g. 250 and 284) are the positions in the base image (800x600).
    //     const baseX = parseFloat(img.getAttribute("data-x") || "0");
    //     const baseY = parseFloat(img.getAttribute("data-y") || "0");
        
    //     // Watermark size (could be set as fixed dimensions in the base image).
    //     const wmWidth = parseInt(img.getAttribute("data-wm-width") || "100", 10);
    //     const wmHeight = parseInt(img.getAttribute("data-wm-height") || "100", 10);

    //     const canvas = document.createElement("canvas");
    //     const ctx = canvas.getContext("2d");

    //     // Wait for both the main image and watermark image to load.
    //     Promise.all([loadImage(mainSrc), loadImage(watermarkSrc)])
    //       .then(([mainImg, watermarkImg]) => {
    //         // Use natural dimensions (original size) of the main image.
    //         const mainWidth = mainImg.naturalWidth;
    //         const mainHeight = mainImg.naturalHeight;

    //         // Set canvas dimensions to the main image's natural dimensions.
    //         canvas.width = mainWidth;
    //         canvas.height = mainHeight;

    //         // Draw the main image onto the canvas.
    //         ctx.drawImage(mainImg, 0, 0);

    //         // Compute scaling factors relative to the base dimensions.
    //         const factorX = mainWidth / baseWidth;
    //         const factorY = mainHeight / baseHeight;

    //         // Calculate new watermark coordinates based on the base position and scaling factors.
    //         const x = baseX * factorX;
    //         const y = baseY * factorY;

    //         // Optionally scale the watermark dimensions as well.
    //         const scaledWmWidth = wmWidth * factorX;
    //         const scaledWmHeight = wmHeight * factorY;

    //         // Apply the watermark with the designated opacity and scaled size.
    //         ctx.globalAlpha = opacity;
    //         ctx.drawImage(watermarkImg, x, y, scaledWmWidth, scaledWmHeight);
    //         ctx.globalAlpha = 1;

    //         // Set canvas display style to match the original image element size.
    //         canvas.style.width = img.width + "px";
    //         canvas.style.height = img.height + "px";

    //         // Copy over any class names and attributes.
    //         canvas.className = img.className;
    //         canvas.alt = img.alt;
    //         canvas.title = img.title;

    //         // Replace the original image element with the canvas.
    //         img.parentNode.replaceChild(canvas, img);
    //       })
    //       .catch(err => {
    //         console.error("Failed to load image for watermarking:", err);
    //       });
    //   });
    // }

    // // Execute the function once the DOM is fully loaded.
    // document.addEventListener("DOMContentLoaded", applyWatermarks);
    // applyWatermarks();
    </script>
<!-- End RG Estate Featured -->

