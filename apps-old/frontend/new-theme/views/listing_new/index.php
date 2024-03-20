<?php $this->renderPartial('partial/_search' ); ?>

    <!-- Start RG Estate Breadcrumb -->
    <section class="rg-breadcrumb rg-mt-70">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb rg-fs-16 rg-fw-400">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Commerical</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- End RG Estate Breadcrumb -->

    <!-- Start RG Estate Main Content -->
    <div class="rg-properties-grid">
        <div class="container">
            <div class="rg-properties-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mt-2">
                <h1 class="rg-fs-30 rg-sm-fs-24 rg-fw-700 rg-text-blue"><?php echo $m_title; ?></h1>
                <div class="rg-filter-by d-flex align-items-center">
                    <label class="rg-fs-14 rg-text-gray-700">Sort by:</label>
                    <div class="dropdown rg-fs-14 ms-2 dropup-start">
                        <a class="dropdown-toggle rg-text-gray-700" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Default Order
                        </a>
                        <ul class="dropdown-menu rg-fs-14 rg-br-10">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach($ads as $add){ ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="rg-featured-card rg-br-16 mt-5">
                            <div class="rg-featured-img position-relative">
                                <div
                                    class="rg-badges text-uppercase d-flex align-items-center justify-content-between position-absolute w-100">
                                    <?php if ($add->featured == "Y" or  $add->featured2 == 'Y') { ?>
                                        <span class="badge rg-bg-orange">FEATURED</span>
                                    <?php } ?>
                                    <?php if ($add->hot == "1") { ?>
                                    <span class="badge rg-bg-black-rgb">FOR SALE</span>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo $add->detailUrl;?>">
                                    <img src="<?php echo $add->getAd_image_singlenew("293");?>" class="d-block w-100 h-100 object-fit-cover" alt="Stylish downtown apartment">
                                </a>
                            </div>
                            <div class="rg-featured-body">
                                <div class="rg-featured-body-top">
                                    <h4 class="rg-fs-12 rg-fw-400 rg-text-dark text-uppercase">APARTMENT</h4>
                                    <h3 class="rg-fs-14 rg-fw-500 rg-text-dark mt-3"><?php echo $add->listRowPriceNew(); ?></h3>
                                    <h2 class="rg-fs-16 rg-fw-500 mt-4">
                                        <a href="<?php echo $add->detailUrl;?>" class="rg-text-blue"><?php echo  $add->AdTitle2;?></a>
                                    </h2>
                                    <p
                                        class="rg-fs-12 rg-fw-500 rg-text-gray-600 text-capitalize d-flex align-items-center mt-4">
                                        <svg width="8" height="14" class="me-2">
                                            <use xlink:href="./assets/images/icons.svg#rg-map"></use>
                                        </svg>
                                        <span><?php echo $add->listRowLocation();?></span>
                                    </p>
                                    <ul class="rg-featured-list d-flex flex-wrap">
                                        <li
                                            class="rg-fs-12 rg-fw-400 rg-text-gray-600 text-capitalize d-flex align-items-center w-50 mt-3">
                                            <svg width="17" height="12" class="me-3">
                                                <use xlink:href="./assets/images/icons.svg#rg-bed"></use>
                                            </svg>
                                            <span><?php echo $add->bedrooms; ?> bedroom</span>
                                        </li>
                                        <li
                                            class="rg-fs-12 rg-fw-400 rg-text-gray-600 text-capitalize d-flex align-items-center w-50 mt-3">
                                            <svg width="10" height="12" class="me-3">
                                                <use xlink:href="./assets/images/icons.svg#rg-bathroom"></use>
                                            </svg>
                                            <span><?php echo $add->bathrooms; ?> Bathroom</span>
                                        </li>
                                        <li
                                            class="rg-fs-12 rg-fw-400 rg-text-gray-600 text-capitalize d-flex align-items-center w-50 mt-3">
                                            <svg width="17" height="12" class="me-3">
                                                <use xlink:href="./assets/images/icons.svg#rg-car"></use>
                                            </svg>
                                            <span>2 parking space</span>
                                        </li>
                                        <li
                                            class="rg-fs-12 rg-fw-400 rg-text-gray-600 text-capitalize d-flex align-items-center w-50 mt-3">
                                            <svg width="13" height="13" class="me-3">
                                                <use xlink:href="./assets/images/icons.svg#rg-feet"></use>
                                            </svg>
                                            <span><?php echo $add->BuiltUpArea; ?> sq ft</span>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="rg-featured-footer d-flex align-items-center justify-content-between border-top">
                                    <li>
                                        <a href="#"
                                            class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center">
                                            <svg width="9" height="9" class="me-2">
                                                <use xlink:href="./assets/images/icons.svg#rg-call"></use>
                                            </svg>
                                            <span>Call</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center">
                                            <svg width="15" height="10" class="me-2">
                                                <use xlink:href="./assets/images/icons.svg#rg-envelop"></use>
                                            </svg>
                                            <span>Mail</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="btn btn-outline-primary rg-fs-12 rg-fw-500 rg-br-4 d-flex align-items-center">
                                            <svg width="14" height="12" class="me-2">
                                                <use xlink:href="./assets/images/icons.svg#rg-heart"></use>
                                            </svg>
                                            <span>Save</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
    <!-- End RG Estate Main Content -->
