<!-- Listing Item -->
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
?>
  <div class="col-md-12 col-lg-12 list-items lst-prop prop-status-<?php echo $v->property_status; ?>1" id="<?php echo $s_id; ?>" data-price="<?php echo $v->price; ?>">
    <div class="feat_property home7 style4 list">
      <a href="<?php echo $v->detailUrl; ?>" style="position:absolute;left:0;top:0;bottom:0px;right:0px;z-index:1"></a>

      <div class="thumb">
        <img class="img-whp lozad" data-placeholder-background="#eee" alt="<?php echo $titleAltText; ?>" title="<?php echo $titleText; ?>" data-src="<?php echo $v->getAd_image_singlenew("293"); ?>">
        <div class="thmb_cntnt">
          <?php echo $v->getTagList('F'); ?>

          <?php if ($v->IsPreleased) { ?>
            <span class="p_staus"><?php echo $v->SoldStatus; ?></span>
          <?php } ?>
        </div>
      </div>

      <div class="details">
        <div class="tc_content">
          <span class="fp_price"><?php echo $v->listRowPriceNew(); ?></span>
          <p class="add"><span class="flaticon-placeholder"></span><?php echo $v->listRowLocation(); ?></p>
          <h2 class="prce"><?php echo $v->AdTitle2; ?></h2>
          
          <ul class="prop_detailss">
            <?php if ($v->IsPreleased) { ?>
              <ul class="prop_detailss row margin-bottom-20 margin-top-20">
                <li class="list-inline-item col-sm-12">
                  <div class="margin-bottom-10"><?php echo $v->genLabelRoi2(); ?></div>
                  <b><?php echo $v->roi . '% P.A'; ?></b>
                </li>
                <li class="list-inline-item col-sm-12">
                  <div class="margin-bottom-10"><?php echo $v->genLabelIncome(); ?></div>
                  <b><?php echo $v->IncomePrice; ?> P.A</b>
                </li>
              </ul>
            <?php } else { 
              echo $v->listRowFeaturesNew();
            } ?>
          </ul>

          <?php /* Uncomment to display additional lease details for preleased items
          if($v->IsPreleased){   
            echo '<ul class="spl-leased row margin-top-15 margin-bottom-0">';
              echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('sale_price') . '</label><span>' . $v->listRowPriceNew() . '</span></li>';
              echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->getAttributeLabel('lease_status') . '</label><span>' . $v->SoldStatus . '</span></li>';
              echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->genLabelIncome() . '</label><span>' . $v->IncomePrice . '</span></li>';
              echo '<li class="col-sm-6 margin-bottom-15"><label>' . $v->genLabelRoi() . '</label><span>' . $v->roi . '</span></li>';
            echo '</ul>';
          }
          */ ?>

          <div class="ftr-cls">
            <?php echo $v->footerLinkNew2(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
