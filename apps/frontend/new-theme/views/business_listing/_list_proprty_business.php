<!-- Listing Items -->
<?php
$links_open_in = $this->options->get('system.common.link_open_in', 'S');  
$apps = $this->app->apps;
$s_class_n = 'col-sm-4';
$bg = true;

foreach ($works as $k => $v) { 
    $s_id = "sale_item" . $v->id;
  $company_image = $v->CompanyImage2;
  $img_link = $v->getAd_image_singlenew("293");
  $imagePath  = str_replace('/uploads/files/', '', $img_link);
  $adImage    = AdImage::model()->findByAttributes(['image_name' => $imagePath]);
  $titleAltText   = $adImage->image_alt;
  $titleText      = $adImage->image_title;

  $watermarkImage = ImageWatermark::model()->findByPk(1);
  $watermarkSrc = '/uploads/files/' . $watermarkImage->watermark_image;
?>
    <div class="col-md-12 col-lg-12 lst-prop list-items prop-status-<?php echo $v->property_status; ?>" id="<?php echo $s_id; ?>" data-price="<?php echo $v->price; ?>">
        <!-- Overlay link -->
        <a href="<?php echo $v->detailUrl; ?>" style="position:absolute; left:0; top:0; bottom:0; right:0; z-index:1"></a>
        
        <div class="feat_property home7 style4 list">
            <!-- Thumbnail Section -->
            <div class="thumb">
                <?php if (!empty($img_link)) { ?> 
                    <img class="img-whp watermarked-img"
                        data-placeholder-background="#eee"
                        alt="<?php echo $titleAltText; ?>"
                        title="<?php echo $titleText; ?>"
                        data-src="<?php echo $v->getAd_image_singlenew("293"); ?>"
                        data-watermark-src="<?php echo $watermarkSrc; ?>"
                        data-opacity="<?php echo $watermarkImage->opacity / 100; ?>"
                        data-x="<?php echo $watermarkImage->position_x; ?>"
                        data-y="<?php echo $watermarkImage->position_y; ?>"
                        data-wm-width="<?php echo $watermarkImage->watermark_width; ?>"
                        data-wm-height="<?php echo $watermarkImage->watermark_height; ?>">
                    <!-- <img class="img-whp" src="<?php echo $img_link; ?>" alt="<?php echo $titleAltText; ?>" title="<?php echo $titleText; ?>"> -->
                <?php } ?>
                
                <div class="thmb_cntnt">
                    <?php echo $v->getTagList('F'); ?>
                    <ul class="icon mb0">
                        <li class="list-inline-item">
                            <?php 
                            echo '<a type="button" id="fav_button_' . $v->id . '" class="'; 
                            echo !empty($v->fav) ? 'active' : ''; 
                            echo ' false favbtn lastref" onclick="OpenFavouriteNew(this)" data-function="save_favourite" data-id="' . $v->id . '" data-after="saved_fave">';
                            ?>
                            <i class="fa fa-heart-o"></i>  
                            <span class="text-not-mob">Save</span></a>
                        </li>
                    </ul>
                    
                    <?php if ($v->IsPreleased) { echo '<span class="p_staus">' . $v->SoldStatus . '</span>'; } ?>
                </div>
            </div>
            
            <!-- Details Section -->
            <div class="details">
                <div class="tc_content">   
                    <h2 class="prce"><?php echo $v->AdTitle2; ?></h2>
                    <p class="add"><span class="flaticon-placeholder"></span><?php echo $v->listRowLocation(); ?></p>

                    <ul class="spl-leased row margin-top-15 margin-bottom-0">
                        <?php
                        if ($v->category_id == '194') {
                            $f_fee = $v->getPriceTitleSpanLNee('category_id', $v->f_fee, '');
                            if (!empty($f_fee)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('f_fee') . '</label><span>' . $f_fee . '</span></li>';
                            }

                            $asking_price = $v->getPriceTitleSpanLNee('p_o_r', $v->price, $v->price_to);
                            if (!empty($asking_price)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('investment') . '</label><span>' . $asking_price . '</span></li>';
                            }
                        } else {
                            // Display asking price
                            $asking_price = $v->getPriceTitleSpanLNee('p_o_r', $v->price, $v->price_to);
                            if (!empty($asking_price)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('price') . '</label><span>' . $asking_price . '</span></li>';
                            }

                            // Display additional details if available
                            $revenue = $v->getPriceTitleSpanLNee('request_r', $v->price_false, $v->price_to_false);
                            if (!empty($revenue)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('price_false') . '</label><span>' . $revenue . '</span></li>';
                            }

                            $b1 = $v->getPriceTitleSpanLNee('p_b_r', $v->price_b, $v->price_b_to);
                            if (!empty($b1)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('price_b') . '</label><span>' . $b1 . '</span></li>';
                            }

                            $valuation = $v->getPriceTitleSpanLNee('p_v_r', $v->price_v, $v->price_v_to);
                            if (!empty($valuation)) {
                                echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('price_v') . '</label><span>' . $valuation . '</span></li>';
                            }
                        }
                        ?>
                    </ul>

                    <!-- Footer Section -->
                    <div class="ftr-cls">
                        <div class="margin-top-5 shobile-only-show"></div>
                        <span class="frch-btn margin-right-5"><?php echo $v->category_name; ?></span>
                        <div class="margin-bottom-5 shobile-only-show"></div>
                        <?php echo $v->footerLinkNew2(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Helper function to load an image with a Promise.
    function loadImage(src) {
      return new Promise((resolve, reject) => {
        const img = new Image();
        img.crossOrigin = "anonymous";
        img.onload = () => resolve(img);
        img.onerror = () => reject(new Error("Failed to load image: " + src));
        img.src = src;
      });
    }

    // Main function to apply watermarks to all images with the class "watermarked-img".
    function applyWatermarks() {
      // Define your base image dimensions (the reference dimensions).
      const baseWidth = 800;
      const baseHeight = 600;

      const watermarkedImages = document.querySelectorAll("img.watermarked-img");

      watermarkedImages.forEach(img => {
        // Prevent processing the same image twice.
        if (img.dataset.processed === "1") return;
        img.dataset.processed = "1";

        // Extract image and watermark settings from data attributes.
        // In this version, data-x and data-y represent the absolute coordinates in the base image.
        const mainSrc = img.getAttribute("data-src");
        const watermarkSrc = img.getAttribute("data-watermark-src");
        const opacity = parseFloat(img.getAttribute("data-opacity") || "0.5");
        
        // These values (e.g. 250 and 284) are the positions in the base image (800x600).
        const baseX = parseFloat(img.getAttribute("data-x") || "0");
        const baseY = parseFloat(img.getAttribute("data-y") || "0");
        
        // Watermark size (could be set as fixed dimensions in the base image).
        const wmWidth = parseInt(img.getAttribute("data-wm-width") || "100", 10);
        const wmHeight = parseInt(img.getAttribute("data-wm-height") || "100", 10);

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        // Wait for both the main image and watermark image to load.
        Promise.all([loadImage(mainSrc), loadImage(watermarkSrc)])
          .then(([mainImg, watermarkImg]) => {
            // Use natural dimensions (original size) of the main image.
            const mainWidth = mainImg.naturalWidth;
            const mainHeight = mainImg.naturalHeight;

            // Set canvas dimensions to the main image's natural dimensions.
            canvas.width = mainWidth;
            canvas.height = mainHeight;

            // Draw the main image onto the canvas.
            ctx.drawImage(mainImg, 0, 0);

            // Compute scaling factors relative to the base dimensions.
            const factorX = mainWidth / baseWidth;
            const factorY = mainHeight / baseHeight;

            // Calculate new watermark coordinates based on the base position and scaling factors.
            const x = baseX * factorX;
            const y = baseY * factorY;

            // Optionally scale the watermark dimensions as well.
            const scaledWmWidth = wmWidth * factorX;
            const scaledWmHeight = wmHeight * factorY;

            // Apply the watermark with the designated opacity and scaled size.
            ctx.globalAlpha = opacity;
            ctx.drawImage(watermarkImg, x, y, scaledWmWidth, scaledWmHeight);
            ctx.globalAlpha = 1;

            // Set canvas display style to match the original image element size.
            canvas.style.width = img.width + "px";
            canvas.style.height = img.height + "px";

            // Copy over any class names and attributes.
            canvas.className = img.className;
            canvas.alt = img.alt;
            canvas.title = img.title;

            // Replace the original image element with the canvas.
            img.parentNode.replaceChild(canvas, img);
          })
          .catch(err => {
            console.error("Failed to load image for watermarking:", err);
          });
      });
    }

    // Execute the function once the DOM is fully loaded.
    document.addEventListener("DOMContentLoaded", applyWatermarks);
    applyWatermarks();
    </script>
<?php } ?>
