<style>
  #detail .topBSafe .listing-item {
    height: 190px;
  }

  #detail .topBSafe .slick-prev,
  #detail .topBSafe .slick-next {
    top: 128px !important;
  }

  #detail .topBSafe button.saveHome {
    right: 20px;
    top: 20px;
  }

  #detail .topBSafeer .listing-item {
    height: 257px;
  }

  #detail .topBSafeer .slick-prev,
  #detail .topBSafe .slick-next {
    top: 128px !important;
  }

  #detail .topBSafeer button.saveHome {
    right: 20px;
    top: 20px;
  }

  .m16mar {
    margin-left: -8px;
    margin-right: -8px;
  }

  @media only screen and (max-width: 600px) {
    .m16mar {
      margin-left: 0px;
      margin-right: 0px;
      margin-bottom: 16px !important;
    }
  }
</style>

<?php
$order = '';
if (!empty($model->city)) {
  $order .= 't.city = "' . $model->city . '" DESC, ';
}
$order .= 't.state = "' . $model->state . '" DESC, ';
$order .= 't.category_id = "' . $model->category_id . '" DESC';
$apps = Yii::app()->apps;
$crit = BusinessForSale::model()->findAds(
  array('sort' => 'custom', 'custom_order' => $order),
  false,
  1,
  false,
  false
);
$crit->order = $order;
$crit->condition .= ' AND t.id != :thisid AND t.section_id = :thissectionid';
$crit->params[':thisid'] = $model->id;
$crit->params[':thissectionid'] = $model->section_id;
$crit->limit = 6;
$neighbours = BusinessForSale::model()->findAll($crit);

if (!empty($neighbours)) {
?>

<div class="row topBSafe">
  <div class="col-sm-12">
    <div class="row">
      <h3 class="margin-top-0 headline sec-head1 text-center" style="margin-bottom: 5px !important;">
        <?php echo $this->tag->gettag('more_avaliable_in_the_same_are', 'More available in the same area'); ?>
      </h3>
      <h5 class="text-center" style="margin-top: 0px;"><?php echo $model->LocationTitle; ?></h5>
      <div class="dots-nav spandots m16mar margin-top-25 safe-neibor grid" id="site" style="margin-bottom: 0px;">

        <?php
         foreach ($neighbours as $k => $v) {
            $img_link = $v->getAd_image_singlenew("293");
            $s_id = "sale_item" . $v->id;
            $company_image = $v->CompanyImage2;
            $imagePath  = str_replace('/uploads/files/', '', $img_link);
            $adImage    = AdImage::model()->findByAttributes(['ad_id' => $v->id]);
            $titleAltText   = $adImage->image_alt;
            $titleText      = $adImage->image_title;
        ?>
        <div class="col-sm-4 lst-prop propli mul_sliderh smsec_<?php echo $v->section_id; ?>" id="<?php echo $s_id; ?>" data-price="<?php echo $v->price; ?>">
          <div class="arws"></div>
          <div class="listing-item">
            <div class="tagsListContainer">
              <ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $v->getTagList('F'); ?></ul>
            </div>
            <div class="single-item-hover"></div>
            <div class="single-item" href="<?php echo $v->detailUrl; ?>" onclick="easyload2(this, event, 'mainContainerClass')">
              <?php if (!empty($img_link)) { echo '<img src="' . $img_link . '">'; } ?>
            </div>
            <div class="list-36view">
              <?php if ($v->view_360) { ?><span class="spn-r-round view-360"></span><?php } ?>
              <?php if ($v->view_video) { ?><span class="spn-r-round view-vid"></span><?php } ?>
              <?php if ($v->view_floor) { ?><span class="spn-r-round view-floor"></span><?php } ?>
            </div>
            <span class="pull-right sm-d-date2 margin-left-5"><?php echo $v->ShowDateFrontend; ?></span>
            <?php if ($v->property_status == '1') { echo '<span class="p_staus">' . $v->SoldStatus . '</span>'; } ?>
          </div>

          <div class="wrapper" style="position:relative;">
            <a href="<?php echo $v->detailUrl; ?>" onclick="easyload2(this, event, 'details-page-container')" class="lsproplink"></a>
            <div class="price"><?php echo $v->listRowPrice(); ?><span class="forgrid pull-right"><?php echo $v->SectionCategoryFullTitle; ?></span></div>
            <div class="smartad_infoarea <?php echo !empty($company_image) ? 'has-cm-image pull-left' : ''; ?>">
              <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v->detailUrl; ?>"><?php echo $v->AdTitle2; ?></a></h2>
              <div class="smartad_detail"><?php echo $v->listRowFeatures(); ?></div>
              <div class="smartad_location-area">
                <div class="smartad_location">
                  <span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                  </span>
                  <span class="smartad_locationtext"><?php echo $v->listRowLocation(); ?></span>
                </div>
              </div>
            </div>
            <?php if (!empty($company_image)) { ?>
              <div class="company_image_li pull-right"><img src="<?php echo $company_image; ?>" /></div>
            <?php } ?>
            <div class="clearfix"></div>
          </div>
          <?php echo $v->footerLinkNew(); ?>
          <div class="clearfix"></div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</div>

<?php
}
if (Yii::app()->request->isAjaxRequest) {
?>
  <script>$(function() { slickopenDetail(); })</script>
<?php
}
?>
