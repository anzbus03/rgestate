<?php defined('MW_PATH') || exit('No direct script access allowed');
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
?>
    <style>
        .filter-container {
            display: flex;
            flex-wrap: nowrap;
            gap: 16px;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 16px;
        }

        .filter-item {
            flex: 0 0 auto;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            flex: 0 0 auto;
        }

    </style>
    <form id="filterForm" class="mb-4" method="GET" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/index'); ?>">
        <div class="filter-container">
            <?php
            $locations = States::model()->AllListingStatesOfCountry(66124);
            $categories = Category::model()->findAll();
            ?>
            <div class="filter-item">
                <select class="form-control" name="location" id="locationSelect">
                    <option value="">Select Location</option>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->state_id; ?>"><?php echo CHtml::encode($location->state_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <select class="form-control" name="property_type" id="propertyTypeSelect">
                    <option value="">Select Property Type</option>
                    <option value="1">For Sale</option>
                    <option value="2">For Rent</option>
                    <option value="3">Business Opportunities</option>
                </select>
            </div>
            <div class="filter-item">
                <select class="form-control" name="property_category" id="propertyCategorySelect">
                    <option value="">Select Property Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->category_id; ?>"><?php echo ($category->category_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <select class="form-control" name="property_status" id="propertyStatusSelect">
                    <option value="">Select Property Status</option>
                    <option value="S">Sold</option>
                    <option value="A">Active</option>
                    <option value="I">Inactive</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary btn-sm">Apply Filter</button>
                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
            </div>
        </div>

    </form>
    <div class="row invoice-card-row" data-source="<?php echo $this->createUrl('dashboard/glance'); ?>">

        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <a href="#" class="card bg-secondary invoice-card text-white">
                <div class="card-body d-flex">
                    <div class="icon me-3">
                        <svg width="33px" height="32px">
                            <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white invoice-num"><?php echo $salesTotal; ?></h2>
                        <span class="text-white fs-18">Total Properties Sold</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <a href="#" class="card-link">
                <div class="card bg-info invoice-card">
                    <div class="card-body d-flex">
                        <div class="icon me-3">
                            <svg width="35px" height="34px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                    d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                    d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-white invoice-num">
                                <?php echo $salesThisMonth; ?>
                            </h2>
                            <span class="text-white fs-18">Total Sales this Month</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <!-- <a href="<?php echo Yii::app()->createUrl('place_property/index', array('PlaceAnAd[status]' => 'A', 'PlaceAnAd[preleased]' => '1')); ?>"
        style="color: inherit; text-decoration: none;"> -->
            <a href="#" style="color: inherit; text-decoration: none;">
                <div class="card bg-success invoice-card">
                    <div class="card-body d-flex">
                        <div class="icon me-3">
                            <svg width="33px" height="32px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                    d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-white invoice-num"><?php echo $numberOfAgents; ?></h2>
                            <span class="text-white fs-18">Total Number of Agents</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

      
      


        <div class="row">
            <div class="col-xl-9 col-xxl-8">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0  flex-wrap">
                                <h4 class="card-title">Total Revenue</h4>
                                <div class="d-flex">
                                    <div class="card-action card-tabs mt-3 mt-sm-0">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#Yearly" role="tab">This Year</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="tab" href="#Monthly" role="tab" >This Month</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#Weekly" role="tab" >This Week</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Yearly">
                                        <div class="flex-wrap mb-sm-4 mb-2 align-items-center">
                                            <div class="d-flex align-items-center">
                                                <span class="text-num text-black fs-36 font-w500 me-2">
                                                    <?php echo $totalPropertiesSoldYear ?? 0 . " AED"; ?>
                                                </span>
                                                <div class="d-flex align-items-center">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.9999 3.44C10.1548 3.44 4.94004 7.64128 3.71732 13.3622C3.10644 16.2208 3.51796 19.2605 4.88084 21.847C6.19252 24.3363 8.34292 26.3482 10.9157 27.4883C13.5919 28.6746 16.6642 28.8813 19.477 28.0723C22.1906 27.2922 24.5967 25.5798 26.2348 23.2813C29.6597 18.4758 29.2018 11.7261 25.1724 7.41984C22.8111 4.89632 19.4565 3.44 15.9999 3.44ZM16.6783 9.98272L20.1855 13.4902C21.061 14.3658 19.7032 15.7235 18.8277 14.8477L17.0661 13.0858V21.2323C17.0661 21.8134 16.5807 22.2986 15.9996 22.2986C15.4184 22.2986 14.933 21.8134 14.933 21.2323V13.0451L13.1637 14.7725C12.2799 15.6362 10.9346 14.2659 11.8226 13.3987L15.3292 9.97472C15.7048 9.60736 16.3064 9.61088 16.6783 9.98272Z" fill="#32D16D"/>
                                                    </svg>
                                                    <div class="ms-3">
                                                        <span class="revenue-1 font-w500 <?php echo $percentageChangeYear >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                            <?php echo number_format($percentageChangeYear, 1) . '%'; ?>
                                                        </span>
                                                        <p class="mb-0">than last year</p>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                        <div id="chartTimeline" class="timeline-chart"></div>
                                    </div>	
                                    <div class="tab-pane fade " id="Monthly">
                                        <div class="flex-wrap mb-sm-4 mb-2 align-items-center">
                                            <div class="d-flex align-items-center">
                                                <span class="text-num text-black fs-36 font-w500 me-2">
                                                    <?php echo $totalPropertiesSoldMonth??0 . " AED"; ?>
                                                </span>
                                                <div class="d-flex align-items-center">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.9999 3.44C10.1548 3.44 4.94004 7.64128 3.71732 13.3622C3.10644 16.2208 3.51796 19.2605 4.88084 21.847C6.19252 24.3363 8.34292 26.3482 10.9157 27.4883C13.5919 28.6746 16.6642 28.8813 19.477 28.0723C22.1906 27.2922 24.5967 25.5798 26.2348 23.2813C29.6597 18.4758 29.2018 11.7261 25.1724 7.41984C22.8111 4.89632 19.4565 3.44 15.9999 3.44ZM16.6783 9.98272L20.1855 13.4902C21.061 14.3658 19.7032 15.7235 18.8277 14.8477L17.0661 13.0858V21.2323C17.0661 21.8134 16.5807 22.2986 15.9996 22.2986C15.4184 22.2986 14.933 21.8134 14.933 21.2323V13.0451L13.1637 14.7725C12.2799 15.6362 10.9346 14.2659 11.8226 13.3987L15.3292 9.97472C15.7048 9.60736 16.3064 9.61088 16.6783 9.98272Z" fill="#32D16D"/>
                                                    </svg>
                                                    <div class="ms-3">
                                                        <span class="revenue-1 font-w500 <?php echo $percentageChangeMonth >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                            <?php echo number_format($percentageChangeMonth, 1) . '%'; ?>
                                                        </span>
                                                        <p class="mb-0">than last month</p>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>

                                        <div id="chartTimeline1" class="timeline-chart"></div>
                                    </div>	
                                    <div class="tab-pane fade" id="Weekly">
                                        <div class="flex-wrap mb-sm-4 mb-2 align-items-center">
                                            <div class="d-flex align-items-center">
                                                <span class="text-num text-black fs-36 font-w500 me-2">
                                                    <?php echo $totalPropertiesSoldWeek??0 . " AED"; ?>
                                                </span>
                                                <div class="d-flex align-items-center">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.9999 3.44C10.1548 3.44 4.94004 7.64128 3.71732 13.3622C3.10644 16.2208 3.51796 19.2605 4.88084 21.847C6.19252 24.3363 8.34292 26.3482 10.9157 27.4883C13.5919 28.6746 16.6642 28.8813 19.477 28.0723C22.1906 27.2922 24.5967 25.5798 26.2348 23.2813C29.6597 18.4758 29.2018 11.7261 25.1724 7.41984C22.8111 4.89632 19.4565 3.44 15.9999 3.44ZM16.6783 9.98272L20.1855 13.4902C21.061 14.3658 19.7032 15.7235 18.8277 14.8477L17.0661 13.0858V21.2323C17.0661 21.8134 16.5807 22.2986 15.9996 22.2986C15.4184 22.2986 14.933 21.8134 14.933 21.2323V13.0451L13.1637 14.7725C12.2799 15.6362 10.9346 14.2659 11.8226 13.3987L15.3292 9.97472C15.7048 9.60736 16.3064 9.61088 16.6783 9.98272Z" fill="#32D16D"/>
                                                    </svg>
                                                    <div class="ms-3">
                                                        <span class="revenue-1 font-w500 <?php echo $percentageChangeWeek >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                            <?php echo number_format($percentageChangeWeek, 1) . '%'; ?>
                                                        </span>
                                                        <p class="mb-0">than last week</p>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>

                                        <div id="chartTimeline2" class="timeline-chart"></div>
                                    </div>	
                                </div>	
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-3 col-xxl-4 col-lg-5" >
                <div class="card border-0 pb-0">
                    <div class="card-header flex-wrap border-0 pb-0">
                        <h3 class="card-title">Top 5 Active Agents</h3>
                        <a href="<?php echo Yii::app()->apps->getBaseUrl('backend/index.php/agents/list'); ?>"
                            class="text-primary font-w500">All Agents</a>
                    </div>
                    <div class="card-body recent-patient px-0" style="height:325px;">
                        <div id="DZ_W_Todo2" class="widget-media dlab-scroll px-4 height320">
                            <ul class="timeline">
                                <?php

                                foreach ($topAgents as $agent) {
                                ?>
                                
                                    <li>
                                        <div class="timeline-panel flex-wrap">
                                            <div class="media-body">
                                                <h5 class="fs-16 font-w600 mb-0"><a
                                                        class="text-black"><?php echo $agent['full_name']; ?></a></h5>
                                                <span class="fs-12"><?php echo $agent['email']; ?></span>
                                            </div>
                                            <div class="links-container">
                                                <a href="javascript:void(0);" class="text-warning mt-2">
                                                    <?php echo $agent['property_count'] . " Properties"; ?>
                                                </a>
                                                <a href="javascript:void(0);" class="text-success mt-2">
                                                    <?php echo $agent['totalPrice']??0 . " AED"; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                    </li>
                                <?php
                                    

                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.5s">
                <!--card-->
                <div class="card statistic">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-header border-0 flex-wrap pb-2">
                                <h2 class="card-title text-white">Agents Properties / Sales Statistic</h2>
                                <div class="d-flex">
                                    <div class="card-action card-tabs mt-3 mt-sm-0">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item agent-properties">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#sale" role="tab">For Sale</a>
                                            </li>
                                            <li class="nav-item agent-properties">
                                                <a class="nav-link " data-bs-toggle="tab" href="#rent" role="tab" >For Rent</a>
                                            </li>
                                            <li class="nav-item agent-properties">
                                                <a class="nav-link" data-bs-toggle="tab" href="#business" role="tab" >Business Opportiunities</a>
                                            </li>
                                            <li class="nav-item agent-properties">
                                                <a class="nav-link" data-bs-toggle="tab" href="#projects" role="tab" >Projects</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0 custome-tooltip pe-0">

                                <div class="tab-content">
                                    <div class="tab-pane active show fade" id="sale">
                                        <div id="chartBarRunning"></div>	
                                    </div>	
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="rent">
                                        <div id="chartBarRunningRent"></div>	
                                    </div>	
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="business">
                                        <div id="chartBarRunningBusiness"></div>	
                                    </div>	
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="projects">
                                        <div id="chartBarRunningProjects"></div>	
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/card-->
            </div>
            <!--column-->
            
            <!--/column-->
        </div>
    </div>
    <style>
       
        .agent-properties .active{
            color: #ffd700 !important;
        }
        .nav-tabs .agent-properties .nav-link:after{
            background: #ffd700 !important;
        }
        .card-tabs .agent-properties .nav-link:not(.active) {
            color: white !important;
        }

        .links-container a {
            display: block; 
            margin-top: 5px; 
        }
        /* Select2 Container Styles */
        .select2-selection--single {
            background-color: #ffffff !important;  /* White background */
            border: 1px solid #ced4da !important; /* Light border color */
            border-radius: 4px !important; /* Rounded corners */
            height: 40px !important; /* Height of the select box */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important; /* Subtle shadow */
            transition: border-color 0.2s !important; 
        }

        /* Focus and Hover Styles */
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single:hover {
            border-color: #007bff; /* Border color on focus/hover */
        }

        /* Selected Item Styles */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057; /* Text color */
            line-height: 38px; /* Vertically center the text */
        }

        /* Placeholder Styles */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d; /* Placeholder color */
            line-height: 38px; /* Vertically center the placeholder */
        }

        /* Dropdown Arrow Styles */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px; /* Adjust height of arrow */
        }

        /* Dropdown Menu Styles */
        .select2-container--default .select2-results__option {
            color: #495057; /* Text color for dropdown options */
            padding: 10px 15px; /* Padding for options */
            cursor: pointer; /* Pointer cursor on options */
        }

        /* Hover Effect on Dropdown Options */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff; /* Highlight background color */
            color: #ffffff; /* Highlight text color */
        }

        /* Disabled State Styles */
        .select2-container--default .select2-selection--single .select2-selection__clear {
            display: none; /* Hide clear option for single selection */
        }
    </style>
        <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/apexchart/apexchart.js');?>" type="text/javascript"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            var chartBarRunning = function(){
                var options  = {
                    series: [
                        {
                            name: 'No. of Properties',
                            data: <?php echo json_encode($agentProperties); ?>
                        }, 
                        
                    ],
                    chart: {
                    type: 'bar',
                    height: 350,
                    
                    
                    toolbar: {
                        show: false,
                    },
                    
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape:'rounded',
                    columnWidth: '45%',
                    borderRadius: 5,
                    
                },
                },
                colors:['#', '#77248B'],
                dataLabels: {
                enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: '12px',
                    labels: {
                        colors: '#000000',
                        
                        },
                    markers: {
                    width: 30,
                    height: 30,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 35,	
                    }
                },
                stroke: {
                show: true,
                width: 6,
                colors: ['transparent']
                },
                grid: {
                    borderColor: 'rgba(252, 252, 252,0.2)',
                },
                xaxis: {
                categories: <?php echo json_encode($agents); ?>,
                labels: {
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },		
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#78909C',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                crosshairs: {
                show: false,
                }
                },
                yaxis: {
                    labels: {
                        offsetX:-16,
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                },
                fill: {
                opacity: 1,
                colors:['#ffffff', '#FFD125'],
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + ""
                    }
                }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        plotOptions: {
                        bar: {
                            columnWidth: '1%',
                            borderRadius: -1,
                        },
                        },
                        chart:{
                            height:250,
                        },
                        series: [
                            {
                                name: 'Number Of Properties',
                                data: <?php echo json_encode($agentProperties); ?>
                            }, 
                            
                        ],
                    }
                }]
                };

                if(jQuery("#chartBarRunning").length > 0){

                    var chart = new ApexCharts(document.querySelector("#chartBarRunning"), options);
                    chart.render();
                    
                    jQuery('#dzIncomeSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Income');
                    });
                    
                    jQuery('#dzExpenseSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Expense');
                    });
                    
                }
                    
            }
            chartBarRunning()
            
            var chartBarRunningRent = function(){
                var options  = {
                    series: [
                        {
                            name: 'No. of Properties',
                            data: <?php echo json_encode($agentPropertiesRent); ?>
                        }, 
                        
                    ],
                    chart: {
                    type: 'bar',
                    height: 350,
                    
                    
                    toolbar: {
                        show: false,
                    },
                    
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape:'rounded',
                    columnWidth: '45%',
                    borderRadius: 5,
                    
                },
                },
                colors:['#', '#77248B'],
                dataLabels: {
                enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: '12px',
                    labels: {
                        colors: '#000000',
                        
                        },
                    markers: {
                    width: 30,
                    height: 30,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 35,	
                    }
                },
                stroke: {
                show: true,
                width: 6,
                colors: ['transparent']
                },
                grid: {
                    borderColor: 'rgba(252, 252, 252,0.2)',
                },
                xaxis: {
                categories: <?php echo json_encode($agents); ?>,
                labels: {
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },		
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#78909C',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                crosshairs: {
                show: false,
                }
                },
                yaxis: {
                    labels: {
                        offsetX:-16,
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                },
                fill: {
                opacity: 1,
                colors:['#ffffff', '#FFD125'],
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + ""
                    }
                }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        plotOptions: {
                        bar: {
                            columnWidth: '1%',
                            borderRadius: -1,
                        },
                        },
                        chart:{
                            height:250,
                        },
                        series: [
                            {
                                name: 'Number Of Properties',
                                data: <?php echo json_encode($agentPropertiesRent); ?>
                            }, 
                            
                        ],
                    }
                }]
                };

                if(jQuery("#chartBarRunningRent").length > 0){

                    var chart = new ApexCharts(document.querySelector("#chartBarRunningRent"), options);
                    chart.render();
                    
                    jQuery('#dzIncomeSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Income');
                    });
                    
                    jQuery('#dzExpenseSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Expense');
                    });
                    
                }
                    
            }
            chartBarRunningRent()
            var chartBarRunningBusiness = function(){
                var options  = {
                    series: [
                        {
                            name: 'No. of Properties',
                            data: <?php echo json_encode($agentPropertiesBusiness); ?>
                        }, 
                        
                    ],
                    chart: {
                    type: 'bar',
                    height: 350,
                    
                    
                    toolbar: {
                        show: false,
                    },
                    
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape:'rounded',
                    columnWidth: '45%',
                    borderRadius: 5,
                    
                },
                },
                colors:['#', '#77248B'],
                dataLabels: {
                enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: '12px',
                    labels: {
                        colors: '#000000',
                        
                        },
                    markers: {
                    width: 30,
                    height: 30,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 35,	
                    }
                },
                stroke: {
                show: true,
                width: 6,
                colors: ['transparent']
                },
                grid: {
                    borderColor: 'rgba(252, 252, 252,0.2)',
                },
                xaxis: {
                categories: <?php echo json_encode($agents); ?>,
                labels: {
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },		
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#78909C',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                crosshairs: {
                show: false,
                }
                },
                yaxis: {
                    labels: {
                        offsetX:-16,
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                },
                fill: {
                opacity: 1,
                colors:['#ffffff', '#FFD125'],
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + ""
                    }
                }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        plotOptions: {
                        bar: {
                            columnWidth: '1%',
                            borderRadius: -1,
                        },
                        },
                        chart:{
                            height:250,
                        },
                        series: [
                            {
                                name: 'Number Of Properties',
                                data: <?php echo json_encode($agentPropertiesBusiness); ?>
                            }, 
                            
                        ],
                    }
                }]
                };

                if(jQuery("#chartBarRunningBusiness").length > 0){

                    var chart = new ApexCharts(document.querySelector("#chartBarRunningBusiness"), options);
                    chart.render();
                    
                    jQuery('#dzIncomeSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Income');
                    });
                    
                    jQuery('#dzExpenseSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Expense');
                    });
                    
                }
                    
            }
            chartBarRunningBusiness()
            var chartBarRunningProjects = function(){
                var options  = {
                    series: [
                        {
                            name: 'No. of Properties',
                            data: <?php echo json_encode($agentPropertiesProjects); ?>
                        }, 
                        
                    ],
                    chart: {
                    type: 'bar',
                    height: 350,
                    
                    
                    toolbar: {
                        show: false,
                    },
                    
                },
                plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape:'rounded',
                    columnWidth: '45%',
                    borderRadius: 5,
                    
                },
                },
                colors:['#', '#77248B'],
                dataLabels: {
                enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: '12px',
                    labels: {
                        colors: '#000000',
                        
                        },
                    markers: {
                    width: 30,
                    height: 30,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 35,	
                    }
                },
                stroke: {
                show: true,
                width: 6,
                colors: ['transparent']
                },
                grid: {
                    borderColor: 'rgba(252, 252, 252,0.2)',
                },
                xaxis: {
                categories: <?php echo json_encode($agents); ?>,
                labels: {
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },		
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                    borderType: 'solid',
                    color: '#78909C',
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                crosshairs: {
                show: false,
                }
                },
                yaxis: {
                    labels: {
                        offsetX:-16,
                    style: {
                        colors: '#ffffff',
                        fontSize: '13px',
                        fontFamily: 'poppins',
                        fontWeight: 100,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                },
                fill: {
                opacity: 1,
                colors:['#ffffff', '#FFD125'],
                },
                tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + ""
                    }
                }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        plotOptions: {
                        bar: {
                            columnWidth: '1%',
                            borderRadius: -1,
                        },
                        },
                        chart:{
                            height:250,
                        },
                        series: [
                            {
                                name: 'Number Of Properties',
                                data: <?php echo json_encode($agentPropertiesProjects); ?>
                            }, 
                            
                        ],
                    }
                }]
                };

                if(jQuery("#chartBarRunningProjects").length > 0){

                    var chart = new ApexCharts(document.querySelector("#chartBarRunningProjects"), options);
                    chart.render();
                    
                    jQuery('#dzIncomeSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Income');
                    });
                    
                    jQuery('#dzExpenseSeries').on('change',function(){
                        jQuery(this).toggleClass('disabled');
                        chart.toggleSeries('Expense');
                    });
                    
                }
                    
            }
            chartBarRunningProjects()
            $(document).ready(function() {
                $('#locationSelect').select2({
                    placeholder: 'Select Location',
                    allowClear: true
                });
                $('#propertyTypeSelect').select2({
                    placeholder: 'Select Property Type',
                    allowClear: true
                });
                $('#propertyCategorySelect').select2({
                    placeholder: 'Select Property Category',
                    allowClear: true
                });
                $('#propertyStatusSelect').select2({
                    placeholder: 'Select Property Status',
                    allowClear: true
                });

            });
        </script>
    <script>
        var chartTimeline = function(){
            
            var monthlySalesData = <?php echo json_encode($monthlySalesData); ?>;
            var categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var optionsTimeline = {
                chart: {
                    type: "bar",
                    height: 200,
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    offsetX: -10,
                },
                series: [{
                    name: "Sales",
                    data: Object.values(monthlySalesData) // Use monthly sales data
                }],
                plotOptions: {
                    bar: {
                        columnWidth: "28%",
                        borderRadius: 6,
                    },
                    distributed: true
                },
                colors: ['var(--primary)'],
                xaxis: {
                    categories: categories, // Month names
                    labels: {
                        style: {
                            colors: '#808080',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(y) {
                            return y.toFixed(0) + " AED";
                        }
                    },
                },
                tooltip: {
                    x: {
                        show: true
                    }
                }
            };

            var chartTimelineRender = new ApexCharts(document.querySelector("#chartTimeline"), optionsTimeline);
            chartTimelineRender.render();
        }
        var chartTimeline1 = function(){
            
            var weeklySalesData = <?php echo json_encode($weeklySalesData); ?>;
            console.log(weeklySalesData)
            var categories = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];

            var optionsTimeline = {
                chart: {
                    type: "bar",
                    height: 200,
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    offsetX: -10,
                },
                series: [{
                    name: "Sales",
                    data: Object.values(weeklySalesData) // Use weekly sales data
                }],
                plotOptions: {
                    bar: {
                        columnWidth: "28%",
                        borderRadius: 6,
                    },
                    distributed: true
                },
                colors: ['var(--primary)'],
                xaxis: {
                    categories: categories, // Week labels
                    labels: {
                        style: {
                            colors: '#808080',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(y) {
                            return y.toFixed(0) + " AED";
                        }
                    },
                },
                tooltip: {
                    x: {
                        show: true
                    }
                }
            };

            var chartTimelineRender = new ApexCharts(document.querySelector("#chartTimeline1"), optionsTimeline);
            chartTimelineRender.render();
        }
        var dailySalesData = <?php echo json_encode($dailySalesData); ?>;
        
        var dailySalesData = <?php echo json_encode($dailySalesData); ?>;
    
        var salesData = Object.values(dailySalesData); // Extract sales data values for the chart
        var categories = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        var chartTimeline2 = function(){
            var optionsTimeline = {
                chart: {
                    type: "bar",
                    height: 200,
                    stacked: true,
                    toolbar: {
                        show: false
                    },
                    offsetX: -10,
                },
                series: [{
                    name: "Sales",
                    data: salesData // Use dynamic sales data
                }],
                plotOptions: {
                    bar: {
                        columnWidth: "28%",
                        borderRadius: 6,
                        colors: {
                            backgroundBarColors: ['#E9E9E9'],
                            backgroundBarOpacity: 1,
                            backgroundBarRadius: 5,
                        },
                    },
                    distributed: true
                },
                colors: ['var(--primary)'],
                grid: {
                    show: false,
                },
                legend: {
                    show: false
                },
                fill: {
                    opacity: 1
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    lineCap: 'rounded',
                },
                xaxis: {
                    categories: categories, // Days of the week
                    labels: {
                        style: {
                            colors: '#808080',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                            fontWeight: 100,
                        },
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#808080',
                            fontSize: '14px',
                            fontFamily: 'Poppins',
                            fontWeight: 100,
                        },
                        formatter: function (y) {
                            return y.toFixed(0) + " AED";
                        }
                    },
                },
                tooltip: {
                    x: {
                        show: true
                    }
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        chart: {
                            height: 250,
                        },
                        xaxis: {
                            categories: categories.slice(0, 5) // Show fewer days on small screens
                        }
                    }
                }]
            };

            var chartTimelineRender = new ApexCharts(document.querySelector("#chartTimeline2"), optionsTimeline);
            chartTimelineRender.render();
        }

        chartTimeline();
        chartTimeline1();
        chartTimeline2();
    </script>
<?php
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>