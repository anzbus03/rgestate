<!-- Start RG Estate Categories -->
<section class="rg-categories position-relative">
    <div class="container">
        <ul class="rg-categories-list text-center bg-white rg-br-8 mx-auto d-flex flex-wrap">
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'warehouse'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-warehouse"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('warehouse','Warehouse')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'retail'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-retail"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('retail','Retail')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'labor-camp'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-accomodation"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark" style="margin: 10px 10px 0;"><?php echo Yii::app()->tags->getTag('accommodation','Accommodation')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'land'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-land"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('land','Land')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'hospital'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-hospitals"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('hospitals','Hospitals')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'schools'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-schools"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('schools','Schools')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'building'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-buildings"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('full_buildings','Full Buildings')?></p>
            </a>
            </li>
            <li>
            <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'hotel-apartment'));?>">
                <div class="rg-bg-blue rg-wh-37 rounded-circle position-relative mx-auto">
                    <svg width="19" height="19" class="position-absolute top-50 start-50 translate-middle">
                        <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-hotels"></use>
                    </svg>
                </div>
                <p class="rg-fs-12 rg-fw-400 rg-text-dark mt-3"><?php echo Yii::app()->tags->getTag('hotels','Hotels')?></p>
            </a>
            </li>
        </ul>
    </div>
</section>
<!-- End RG Estate Categories -->
