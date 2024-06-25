<?php
$banners =   $this->banners;
//print_r($banners);			 
?>

<!-- Start RG Estate Hero -->
<style>
.rg-hero-bg,
.rg-hero-bg:after {
    border-radius: 0;
}
    .select2-selection.select2-selection--multiple{
        background: var(--bs-white);
        height: 4.6rem;
        border-radius: 3rem;
        padding: .5rem .5rem .5rem 1.6rem;
    }
    /*.select2-search{*/
        
    /*    margin-top: 6px;*/
    /*    margin-left: 19px;*/
    /*    display:block;*/

    /*}*/
    .select2-search textarea{
        /*font-weight: bold;*/
        font-size: 1.5rem !important;
    }
    .button-container .active{
        background: var(--bs-blue);border: none;
    }
    .button-container button{
        background:none;border: none;
    }
    .rg-categories{
        z-index:1;
    }
    
    /*.select2-container--default .select2-search--inline .select2-search__field {*/
    /*    padding-left: 1.6rem;*/
    /*    margin-top: 1rem;*/
    /*}*/
</style>
<section class="rg-hero mt-0">
    <div class="rg-hero-bg position-relative d-flex flex-column align-items-center justify-content-center" id="backgroundImage">
        <div class="container">
            <ul class="rg-hero-stats w-100 position-absolute z-1 d-flex flex-row flex-xl-column justify-content-between justify-content-xl-center text-white">
                <li class="d-flex flex-column flex-xl-row">
                    <div class="rg-counter rg-fs-26 rg-fw-700" data-stop="1000+">1000+</div>
                    <div class="rg-text rg-fs-14 rg-fw-500 text-center"><?php echo Yii::app()->tags->getTag('active','Active')?> <br> <?php echo Yii::app()->tags->getTag('listings','Listings')?></div>
                </li>
                <li class="d-flex flex-column flex-xl-row">
                    <div class="rg-counter rg-fs-26 rg-fw-700" data-stop="900+">900+</div>
                    <div class="rg-text rg-fs-14 rg-fw-500 text-center"><?php echo Yii::app()->tags->getTag('happy','Happy')?> <br> <?php echo Yii::app()->tags->getTag('clients','Clients')?></div>
                </li>
                <li class="d-flex flex-column flex-xl-row">
                    <div class="rg-counter rg-fs-26 rg-fw-700" data-stop="18+">18+</div>
                    <div class="rg-text rg-fs-14 rg-fw-500 text-center"><?php echo Yii::app()->tags->getTag('years_of','Years Of')?> <br> <?php echo Yii::app()->tags->getTag('industry_experience','Industry Experience')?></div>
                </li>
            </ul>
            <div class="rg-hero-content position-relative w-100 z-1 mx-auto">
                <h2 class="rg-fs-55 rg-fw-700 text-white text-center text-capitalize mx-auto"><?php echo Yii::app()->tags->getTag('think_search','Think Investments Think RGEstate')?></h2>
                <p class="rg-fs-18 rg-fw-500 rg-text-gray-300 mx-auto text-center mt-2"><?php echo Yii::app()->tags->getTag('experience_search','Experience future investments with RGEstate, your UAE trusted partner. Our visionary approach to real estate leads to unmatched gains.')?>.</p>
                <ul class="rg-home-btn-group d-flex align-items-center justify-content-center flex-wrap">
                    <li>
                        <a href="javascript::void(0)" class="btn btn-secondary rg-active"><?php echo Yii::app()->tags->getTag('property','Property')?></a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('new-development'); ?>" class="btn btn-secondary"><?php echo Yii::app()->tags->getTag('new_project','New Project')?></a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('business-opportunities'); ?>" class="btn btn-secondary"><?php echo Yii::app()->tags->getTag('businesses_for_sale','Business Opportunities')?></a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('preleased'); ?>" class="btn btn-secondary"><?php echo Yii::app()->tags->getTag('preleased','Preleased')?></a>
                    </li>
                </ul>
                <div class="rg-hero-form rg-br-20 rg-mt-25" style="display:none">
                    <div class="d-flex align-items-center justify-content-center button-container mb-0 mb-md-4 mb-lg-5">
                        <button id="commercial" class="rounded-5 px-4 py-3 text-white active"><?php echo Yii::app()->tags->getTag('commercial','Commercial')?></button>
                        <button id="residential" class="rounded-5 px-4 py-3 text-white" ><?php echo Yii::app()->tags->getTag('residential','Residential')?></button>
                    </div>
                    <form onsubmit="createSearchUrl(event,this);" id="rg-search-form">
                        <div class="row">
                                    <input type="hidden" id="search_type" value="commercial">
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3 mt-lg-0">
                                        <select id="property_purpose" name="purpose" data-placeholder="<?php echo Yii::app()->tags->getTag('purpose','Purpose')?>" class="search-select-2">
                                            <option></option>
                                            <option value="sale"><?php echo Yii::app()->tags->getTag('buy','Buy')?></option>
                                            <option value="rent"><?php echo Yii::app()->tags->getTag('rent','Rent')?></option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 col-md-5 mt-4 mt-md-3 mt-lg-0">
                                        <select id="rg_where" class="search-select-2" name="state[]" multiple data-placeholder="<?php echo Yii::app()->tags->getTag('locations','Locations')?>">
                                            <option></option>
                                        <?php
                                        // Group the data by groupName
                                        $groupedData = [];
                                        foreach ($areaData as $item) {
                                            if (isset($item['groupName'])) {
                                                $groupName = $item['groupName'];
                                                $groupedData[$groupName][] = $item;
                                            } else {
                                                $groupedData['default'][] = $item;
                                            }
                                        }
                                            //foreach($areaData as $area){
                                        ?>
                                            <?php foreach ($groupedData as $groupName => $groupItems) : ?>
                                                <?php if ($groupName !== 'default') : ?>
                                                    <optgroup label="<?php echo $groupName; ?>">
                                                <?php endif; ?>
                                                
                                                <?php foreach ($groupItems as $item) : ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                                <?php endforeach; ?>
                                                
                                                <?php if ($groupName !== 'default') : ?>
                                                    </optgroup>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-4 mt-md-3 mt-lg-0" id="com-type">
                                        <select id="rg_type2" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('property_type','Property Type');?>">
                                            <option></option>
                                        <?php 
                                            $ids = 1; 
                                            $categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlugCacheNew($ids );
                                            foreach ($categories as $k2 => $v2) {
                                        ?>
                                                
                                                <?php
                                                    if (is_array($v2) && $k2 === "Commercial") {

                                                        foreach ($v2 as $k => $v) {
                                                ?>
                                                            <option data-type="<?php echo $k2 ?>" value="<?php echo $k ?>"><?php echo $v ?></option>
                                                <?php
                                                        }
                                                    }
                                            }
                                            ?>
                                        </select>    
                                    </div>
                                <div class="col-lg-4 col-md-4 mt-4 mt-md-3 mt-lg-0 d-none" id="red-type">
                                        <select id="rg_type" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('property_type','Property Type');?>">
                                            <option></option>
                                        <?php 
                                            $ids = 1; 
                                            $categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlugCacheNew($ids );
                                            foreach ($categories as $k2 => $v2) {
                                        ?>
                                                
                                                    <?php
                                                        if (is_array($v2) && $k2 === "Residential") {

                                                            foreach ($v2 as $k => $v) {
                                                    ?>
                                                                <option data-type="<?php echo $k2 ?>" value="<?php echo $k ?>"><?php echo $v ?></option>
                                                    <?php
                                                            }
                                                        }
                                                
                                            }

                                            ?>
                                        </select>    

                                    </div>
                                    
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3" id="minsqft-container">
                                        <?php $area_aray_sec = $filterModel->getSqft_aray(); ?>
                                        <select id="mobile-minsqft" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('min_sqft','Min');?>(<?php echo AREANAME;?>)">
                                            <option></option>
                                            <?php
                                            foreach($area_aray_sec as $k=>$v){ 
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3" id="maxsqft-container">
                                        <select  id="mobile-maxsqft" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('max_sqft','Max');?>(<?php echo AREANAME;?>)">
                                            <option></option>
                                            <?php
                                            foreach($area_aray_sec as $k=>$v){ 
                                                echo '<option value="'.$k.'">'.$v.'</option>';
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3 d-none" id="beds-container">
                                        <select id="rg_bed" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('property_type','Beds');?>">
                                            <option></option>
                                            <?php for($i=1;$i<=7;$i++){ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                            <option value="8+">8+</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3 d-none" id="bathrooms-container">
                                        <select id="rg_bath" name="bathrooms" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('property_type','Bathrooms');?>">
                                            <option></option>
                                            <?php
                                                $bath_rooms = $filterModel->bathroomSearchIndex();
                                                foreach($bath_rooms  as $k=>$v){
                                            ?>
                                                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3">
                                        <select id="rg_min_price" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('min_price','Min Price');?>">
                                            <option></option>
                                            
                                            <?php 
                                                $price_sec = $filterModel->getPriceArrayFrom();
                                                $price_sec2 = $filterModel->getPriceArrayTo(); 
                                                foreach($price_sec as $k=>$v){ 

                                                    echo '<option value="'.$k.'">'.$v.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div> 
                                    <div class="col-lg-3 col-md-3 mt-4 mt-md-3">
                                        <select id="rg_max_price" class="search-select-2" data-placeholder="<?php echo $this->tag->getTag('max_price','Max Price');?>">
                                            <option></option>
                                            <?php 
                                                foreach($price_sec2 as $k=>$v){ 
                                                    echo '<option value="'.$k.'">'.$v.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 mt-4 mt-md-3">
                                <input type="submit" class="btn btn-primary w-100" value="<?php echo Yii::app()->tags->getTag('search','Search')?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End RG Estate Hero -->
<script>
    var banners =   <?php echo json_encode($banners);?>
</script>
