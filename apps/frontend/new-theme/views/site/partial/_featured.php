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
<section class="rg-featured">
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
                        aria-selected="true"><?php echo $category->category_name; ?></button>
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
                        // echo '<pre>'; print_r($add); echo '</pre>'; 
                    ?>
                    <?php $add->ad_images_g = $add->cron_images; ?>
                    <li>
                        <div class="rg-featured-card rg-br-16">
                            <div class="rg-featured-img position-relative">
                                <div
                                class="rg-badges text-uppercase d-flex align-items-center justify-content-between position-absolute w-100">
                                    <?php if($add->featured == "Y"){ ?>
                                        <span class="badge rg-bg-orange">FEATURED</span>
                                    <?php }if($add->super_hot){ ?>
                                        <span class="badge rg-bg-black-rgb">SUPER HOT</span>
                                    <?php }else if($add->hot){ ?>
                                        <span class="badge rg-bg-black-rgb">HOT</span>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo $add->detailUrl;?>">
                                <img class="d-block w-100 h-100 object-fit-cover" src="<?php echo $add->getAd_image_singlenew("293");?>"
                                    alt="Stylish downtown apartment">
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
                                        <a type="button" class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center" onclick="OpenCallNewlatest(this)" data-prop="<?php echo  $add->id ;?>" data-agent="<?php echo $add->OwnerName;?>"  data-ref="<?php echo $add->ReferenceNumberTitle;?>" data-phone="<?php echo $add->mobile_number ;?>" >
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
<!-- End RG Estate Featured -->

