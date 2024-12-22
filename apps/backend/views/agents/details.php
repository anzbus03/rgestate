<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {

    $profileImageUrl = !empty($user->profile_image)
        ? $user->profile_image
        : Yii::app()->baseUrl . '/assets/img/defaul_user.png';
?>
    <div>
        <div class="agent-details">
            <!-- header  -->
            <div class="profile-navbar">
                <div>
                    <span class="textgray fontMd sizeSm">Agents</span>
                    <span>/</span>
                    <span class="textprimary  sizeSm">Profile</span>
                </div>
                <!-- <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id . '/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new'))); ?> -->
            </div>

            <div class="dashboard-row">
                <!-- User Profile Section -->
                <div class="user-profile">
                    <div class="profile-header">
                        <div class="banner-overlay"></div>
                        <div class="profile-img">
                            <?php if (!empty($user->profile_image)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/profile_images/' . $user->profile_image; ?>"
                                    alt="Profile Image" />
                            <?php else: ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/profile_images/defaul_user.png'; ?>"
                                    alt="Default Profile Image" />
                            <?php endif; ?>
                        </div>
                        <h3><?php echo $user->getFullName() ?></h3>
                    </div>

                    <div class="profile-details">
                        <p><span>Age :</span> <strong><?php echo $user->age ?></strong></p>
                        <hr>
                        <p><span>Gender :</span> <strong><?php echo $user->gender ?></strong></p>
                        <hr>
                        <p><span>City :</span> <strong><?php echo $user->city ?></strong> </p>
                        <hr>
                        <p><span>Country :</span> <strong><?php echo $user->countries->country_name ?></strong></p>
                        <hr>
                        <!-- <p><span>Postcode :</span> <strong>10001</strong></p> -->
                        <!-- <hr> -->
                        <p><span>Email :</span> <strong><?php echo $user->email ?></strong>
                        </p>
                    </div>
                    <hr>
                    <!-- <div class="icon-section">
                        <div class="icon">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="icon">
                            <i class="fa-brands fa-facebook-f"></i>
                        </div>
                        <div class="icon">
                            <i class="fa-brands fa-twitter"></i>
                        </div>
                    </div> -->
                </div>



                <!-- Dashboard Detail Section -->
                <div class="dashboard-detail">
                    <div class="headerTitle">
                        <h4>Agent Detail</h4>
                    </div>
                    <hr>

                    <div class="container">
                        <p><?php echo $user->description ?></p>
                        <table class="agent-table">
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fa-regular fa-circle-check"></i>Agent Name:
                                    </td>
                                    <td class="agentName"><?php echo $user->first_name . " " . $user->last_name  ?></td>
                                </tr>
                               
                                <tr>
                                    <td>
                                        <i class="fa-regular fa-circle-check"></i>Agent License
                                    </td>
                                    <td class="agentName"><?php echo $user->licence_no  ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fa-regular fa-circle-check"></i> Agent City
                                    </td>
                                    <td class="agentName"><?php echo $user->city  ?></td>
                                </tr>
                                <!-- <tr>
                                <td>
                                    <i class="fa-regular fa-circle-check"></i> Agent Name:
                                </td>
                                <td class="agentName">John Doe</td>
                            </tr> -->
                            </tbody>
                        </table>

                        <hr>
                        <div>
                            <h4 class="property-title">Closed Deals</h4>
                            <div class="progress-section">
                                <div class="card">
                                    <div class="card-info">
                                        <div class="card-detail">
                                            <h3><?php echo $revenueForSale ?></h3>
                                            <p>For Sale</p>
                                            <p><?php echo 'Target: ' . $user->target_for_sale . '/' . $user->target_period ?>
                                            </p>
                                        </div>
                                        <div class="progress-container">
                                            <div class="progress-ring" id="progress1">
                                                <svg class="progress-ring__svg" width="100" height="100">
                                                    <circle class="progress-ring__background" stroke="#e0e0e0"
                                                        stroke-width="10" fill="transparent" r="40" cx="50" cy="50">
                                                    </circle>
                                                    <circle class="progress-ring__circle" stroke="#4e73df" stroke-width="10"
                                                        fill="transparent" r="40" cx="50" cy="50"
                                                        style="stroke-dasharray: 251.2; stroke-dashoffset: <?php echo 251.2 - (251.2 * $completionPercentage / 100); ?>;">
                                                    </circle>
                                                </svg>
                                                <div class="progress-text">
                                                    <?php echo round($completionPercentage) . '%' ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                <div class="card-info">
                                    <div class="card-detail">
                                        <h3><?php echo $revenueForRent ?></h3>
                                        <p>For Rent</p>
                                        <p><?php echo 'Target: ' . $user->target_for_rent . '/' . $user->target_period ?>
                                        </p>
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-ring green" id="progress2">
                                            <svg class="progress-ring__svg" width="100" height="100">
                                                <circle class="progress-ring__background" stroke="#e0e0e0"
                                                    stroke-width="10" fill="transparent" r="40" cx="50" cy="50">
                                                </circle>
                                                <circle class="progress-ring__circle" stroke="#28a745" stroke-width="10"
                                                    fill="transparent" r="40" cx="50" cy="50"
                                                    style="stroke-dasharray: 251.2; stroke-dashoffset: <?php echo 251.2 - (251.2 * $completionPercentageForRent / 100); ?>;">
                                                </circle>
                                            </svg>
                                            <div class="progress-text-green">
                                                <?php echo round($completionPercentageRent) . '%' ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Files Section -->


                <!-- house rent start -->
                
            </div>
            <div class="mt-4" style="margin-bottom: 20px;">
                           
            <form id="filterForm" method="GET" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/view', array('id' => $user->user_id)); ?>">
                <div class="row">
                    <div class="col-md-2 mt-2">
                        <h3>Agent Properties (<?php echo count($userProperties); ?>)</h3>
                    </div>
                    <div class="col-md-2">
                        <?php
                        $locations = States::model()->AllListingStatesOfCountry(66124);
                        $categories = Category::model()->findAll();
                        ?>
                        <select class="form-control" name="location" id="locationSelect">
                            <option value="">Select Location</option>
                            <?php foreach ($locations as $location): ?>
                                <option value="<?php echo $location->state_id; ?>"><?php echo CHtml::encode($location->state_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="property_type" id="propertyTypeSelect">
                            <option value="">Select Property Type</option>
                            <option value="1">For Sale</option>
                            <option value="2">For Rent</option>
                            <option value="3">Business Opportiunities</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="property_category" id="propertyCategorySelect">
                            <option value="">Select Property Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->category_id; ?>"><?php echo ($category->category_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="property_status" id="propertyStatusSelect">
                            <option value="">Select Property Status</option>
                            <option value="S">Sold</option>
                            <option value="A">Active</option>
                            <option value="I">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filter</button>
                        <button type="submit" class="btn btn-secondary btn-sm">Reset</button>
                    </div>
                </div>
            </form>
           
                <div class="shouseRent mt-4" id="propertyList">
                    <?php if (!empty($userProperties)): ?>
                        <div class="row" id="propertiesContainer">
                            <?php foreach ($userProperties as $property): ?>
                                <div class="col-md-4 property-item" data-category-id="<?php echo $property->category_id; ?>">
                                    <div class="card">
                                        <!-- Image Section -->
                                        <div class="house-img mb-5">
                                            <div class="imgInfo">
                                                <span class="rent" style="width: 65%;">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <?php echo implode(', ', array_filter(array(
                                                        CHtml::encode($property->city),
                                                        CHtml::encode($property->stateLocation->state_name),
                                                        CHtml::encode($property->country0->country_name)
                                                    ))); ?>
                                                </span>
                                                <span class="location">For <?php echo $property->section_id == 1 ? 'Sale' : 'Rent'; ?></span>
                                                <span class="location"><?php echo $property->status; ?></span>
                                            </div>
                                        </div>

                                        <!-- Details Section -->
                                        <div class="card-body">
                                            <h3 class="price">AED <?php echo CHtml::encode($property->price); ?></h3>
                                            <div class="iconContainer">
                                                <div class="me-3">
                                                    <i class="fa-solid fa-bed"></i> 
                                                    <span class="fac"><?php echo CHtml::encode($property->bedrooms); ?> Beds</span>
                                                </div>
                                                <div class="me-3">
                                                    <i class="fa-solid fa-bath"></i>
                                                    <span class="fac"><?php echo CHtml::encode($property->bathrooms); ?> Baths</span>
                                                </div>
                                                <div>
                                                    <i class="fa-regular fa-square"></i>
                                                    <span class="fac"><?php echo CHtml::encode($property->area_unit_1); ?> sqft</span>
                                                </div>
                                            </div>
                                            <p class="description"><?php echo CHtml::encode($property->ad_title); ?></p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No properties listed by this user.</p>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>
    <style>
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
        

        hr {
            margin: 0;
        }

        p {
            margin-bottom: 0;
        }

        /* custom pagination css  */
        .pagination li.hidden,
        .pagination li.disabled {
            display: none;
        }

        .pagination {
            text-align: center;
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a {
            display: inline-block;
            padding: 8px;
            margin: 5px;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #e0e0e0;
        }

        .pagination .active a {
            background-color: #4285F4;
            color: white;
        }

        /* custom pagination css end */

        /* navbar section start  */
        .profile-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 20px;
            background-color: white;
            box-shadow: rgba(245, 246, 247, 0.2) 0px 8px 24px;
            margin: 20px 0px;
            border-radius: 10px;
            font-family: 'Roboto', 'Open Sans', sans-serif;
        }

        .textprimary {
            color: #1991eb;
        }

        .addButton {
            color: white;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        .sizeSm {
            font-size: 14px;
        }

        .textgray {
            color: gray;
        }

        .fontMd {
            font-weight: 600;
        }

        /* navbar section end */

        /* dashbord start */

        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            /* margin: 10px; */
            gap: 1.3rem;
            font-family: 'Roboto', 'Open Sans', sans-serif;
        }

        .user-profile {
            width: 40%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding-bottom: 10px;
        }

        .profile-header {
            position: relative;
            width: 100%;
            padding: 1rem;
            background-image: url('./img/img1.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            border-radius: 12px 12px 0 0;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .profile-header .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #3B4CB8;
            opacity: 0.85;
            z-index: 1;
        }

        .profile-header .profile-img {
            position: relative;
            z-index: 2;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .profile-header .profile-img img {
            height: 100%;
            border-radius: 50%;
        }

        .profile-header h3 {
            position: relative;
            margin-top: 1rem;
            z-index: 2;
            color: white;
            font-family: 'Roboto', 'Open Sans', sans-serif;
        }

        .profile-header p {
            position: relative;
            z-index: 2;
            font-style: 12px;
            font-family: 'Roboto', 'Open Sans', sans-serif;
        }

        .user-profile {
            width: 35%;
            box-sizing: border-box;
            border-radius: 12px;
            /* margin: 10px; */
        }

        .user-profile .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .user-profile .profile-details p {
            padding: 14px 21px;
            font-size: 16px;
        }

        .icon-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .icon-section .icon {
            height: 40px;
            width: 40px;
            border-radius: 100%;
            background-color: #D9D1F2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-section .icon i {
            color: #1991eb;
        }

        .container {
            padding: 1.8rem;
            margin-top: 0 !important;
        }

        .headerTitle {
            padding: 1.5rem 1.875rem 1.25rem;
        }

        .dashboard-detail {
            background-color: #fff;
            width: 62%;
            box-sizing: border-box;
            border-radius: 8px;
            /* margin: 10px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-detail h4 {
            font-weight: 500;
            font-size: 20px;
            color: black;
            text-transform: capitalize;
        }

        .dashboard-detail p {
            font-size: 16px;
            margin-bottom: 10px;

            color: gray;

        }

        .profile-details p {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .profile-details p span {
            color: gray;
        }


        .card {
            display: flex;
            width: 400px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-info {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .card-detail {
            padding: 20px;
            width: 50%;
        }

        .card-detail h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .card-detail p {
            margin: 5px 0;
            color: #666;
        }

        .card {
            display: flex;
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-info {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .card-detail {
            padding: 20px;
            width: 50%;
        }

        .card-detail h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .card-detail p {
            margin: 5px 0;
            color: #666;
        }

        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding: 20px;
        }

        .progress-ring {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .progress-ring__svg {
            transform: rotate(-90deg);
        }

        .progress-ring__background {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 0;
        }

        .progress-ring__circle {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 251.2;
            /* Start from 0% */
            transition: stroke-dashoffset 0.35s;
        }

        .progress-text,
        .progress-text-green {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
            height: 60px;
            width: 60px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress-text {
            color: #5D5399;
            background-color: #DCDBF1;
        }

        .progress-text-green {
            color: #58E893;
            background-color: #C2F7DB;
        }

        .progress-section {
            display: flex;
            gap: 10px;
        }

        .progress-ring.green .progress-ring__circle {
            stroke: #28a745;
        }


        td i {
            color: #3B4CB8;
        }

        .property-title {
            margin: 1rem 0;
        }

        .agent-table {
            width: 100%;
            border-collapse: collapse;
            color: #7e7e7e7e;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .agent-table th,
        .agent-table td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }

        .agent-table th {
            background-color: #f2f2f2;
        }

        .agent-table td i {
            margin-right: 10px;
        }

        .myfile-button {
            background-color: #1991eb;
            color: white;
            border: none;
            padding: 0.579rem 1rem;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .my-files {
            width: 100%;
            background-color: #fff;
            box-sizing: border-box;
            border-radius: 8px;
            /* margin: 10px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .fileCard {
            display: flex;
            align-items: center;
            margin: 10px 0;
            justify-content: space-between;
            border: 1px solid rgb(226, 226, 226);
            padding: 14px;
            width: 23%;
            border-radius: 10px;
        }

        .billIcon {
            height: 60px;
            background-color: #FDEDCA;
            margin: 0 10px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            font-size: 25px;
        }

        .fileIcon {
            height: 60px;
            background-color: #5D5399;
            margin: 0 10px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            font-size: 25px;
        }

        .dollerIcon {
            height: 60px;
            background-color: #DE957C;
            margin: 0 10px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            font-size: 25px;
        }

        .dataIcon {
            height: 60px;
            background-color: #C6F9DB;
            margin: 0 10px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            font-size: 25px;
        }

        .align {
            display: flex;
        }

        .fileIcon i {
            color: #c5beec;
        }

        .billIcon i {
            color: #E8B541;
        }

        .dataIcon i {
            color: #4BD18A;
        }

        .dollerIcon i {
            color: #FA492E;
        }

        .a {
            color: gray;
        }

        .parsent {
            background: #1991eb;
            color: white;
            padding: 0 10px;
            border-radius: 10px;
        }

        .dollerparsent {
            background: #FA492E;
            color: white;
            padding: 0 10px;
            border-radius: 10px;
        }

        .billparsent {
            background: #FD9801;
            color: white;
            padding: 0 10px;
            border-radius: 10px;
        }

        .dataparsent {
            background: #03DF61;
            color: white;
            padding: 0 10px;
            border-radius: 10px;
        }

        .fileCards {
            width: 100%;
            padding: 1.875rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1.8rem;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 1.875rem 1.25rem;
        }

        .header-container h4 {
            font-size: 20px;
            font-weight: 500;
        }

        .progress-ring__circle {
            stroke-dasharray: 251.2;
            /* This should match the circumference */
            stroke-dashoffset: 251.2;
            /* Start from full circumference (0%) */
            transition: stroke-dashoffset 1s ease;
        }

        .progress-text,
        .progress-text-green {
            font-size: 1.2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
        }

        .progress-text {
            color: #4e73df;
        }

        .progress-text-green {
            color: #28a745;
        }


        @media (max-width: 520px) {
            .fileCards {
                display: flex;
                flex-direction: column;
            }

            .fileCard {
                width: 100%;
            }
        }

        @media (max-width: 992px) {
            .card-info {
                flex-direction: column;
            }

            .card-detail,
            .progress-container {
                width: 100%;
            }
        }



        @media (max-width: 768px) {
            .card {
                width: 100%;
            }

            .fileCards {
                display: flex;
                flex-direction: column;
            }

            .fileCard {
                width: 48%;
            }

            .progress-section {
                display: flex;
                flex-direction: column;
                justify-content: center;
                text-align: center;
            }
        }


        @media (max-width: 768px) {

            .user-profile,
            .dashboard-detail,
            .my-files {
                width: 100%;
            }
        }

        @media (max-width: 1024px) {

            .user-profile,
            .dashboard-detail,
            .my-files {
                width: 100%;
            }
        }

        /* dashbord end */


        /* house rent start */

        .house-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .house-img img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 300px;
            width: 100%;
            object-fit: cover;
        }

        .rent {
            background-color: #cfd4f0;
            color: #3B4CB8;
            padding: 0.3125rem 0.5rem;
            border-radius: 5px;
            font-size: 14px;
        }

        .location {
            background-color: #4B19B4;
            color: white;
            padding: 0.3125rem 0.5rem;
            border-radius: 10px;
            font-size: 0.6875rem;
        }

        .imgInfo {
            position: absolute;
            top: 10px;
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;

        }

        .fac {
            font-size: 12px;
        }

        .price {
            color: rgb(26, 25, 25);
        }

        .user-Container {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .description {
            font-size: 0.9rem;
            color: #76828f;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .userIcon {
            font-size: 20px;
        }

        .userIcon i {
            margin: 0 5px;
        }

        .userInfo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .userInfo h6 {
            font-size: 13px;
            font-weight: 600;
        }

        .user-img {
            width: 40px;
            height: 40px;
            border-radius: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
            width: 100%;
        }

        .bi-heart,
        .bi-share,
        .bi-plus-circle {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5rem;
        }

        .iconContainer {
            display: flex;
            gap: 30px;
        }

        .iconContainer i {
            color: #1991eb;
        }

        .houses-container {
            margin-bottom: 50px;
        }

        .houseRent {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 20px;
            /* padding: 0 20px; */
            /* margin: 40px 0; */
        }

        @media (min-width: 768px) {
            .houseRent {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .houseRent {
                grid-template-columns: repeat(3, 1fr);
            }
        }


        /* house rent end */
    </style>
    </div>

<?php
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
     function filterProperties(categoryId) {
        const properties = document.querySelectorAll('.property-item');
        
        properties.forEach(property => {
            if (categoryId === 'all' || property.dataset.categoryId == categoryId) {
                property.style.display = 'block';
            } else {
                property.style.display = 'none';
            }
        });
        
        // Activate the clicked tab
        const tabs = document.querySelectorAll('#propertyTabs .nav-link');
        tabs.forEach(tab => tab.classList.remove('active'));
        
        const clickedTab = Array.from(tabs).find(tab => tab.innerText.includes(categoryId));
        if (clickedTab) {
            clickedTab.classList.add('active');
        }
    }

    function resetFilters() {
        document.getElementById('filterForm').reset();
        filterProperties('all'); // Show all properties again
    }
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

        const $progress1 = $('#progress1');
        const $progress2 = $('#progress2');

        function setProgress($element, percent) {
            const radius = 40; // Adjust based on your SVG
            const circumference = 2 * Math.PI * radius;
            const offset = circumference - (percent / 100) * circumference;
            const $circle = $element.find('.progress-ring__circle');

            // Set stroke-dasharray and stroke-dashoffset using jQuery
            $circle.css({
                'stroke-dasharray': circumference,
                'stroke-dashoffset': offset
            });

            const $text = $element.find('.progress-text').length ? $element.find('.progress-text') : $element.find('.progress-text-green');
            $text.text(Math.round(percent) + '%'); // Update the percentage text
        }

        function animateProgress($element, percent) {
            const duration = 1000; // animation duration in milliseconds
            const stepCount = 100; // Number of steps for smooth animation
            const increment = percent / stepCount;
            let currentPercent = 0;

            function step() {
                if (currentPercent < percent) {
                    currentPercent += increment;
                    setProgress($element, Math.min(currentPercent, percent));
                    requestAnimationFrame(step); // Smooth animation with recursion
                } else {
                    setProgress($element, percent);
                }
            }

            step();
        }

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const $element = $(entry.target);
                    const percent = $element.attr('id') === 'progress1' ?
                        <?php echo isset($completionPercentage) ? $completionPercentage : 0; ?> :
                        <?php echo isset($completionPercentageForRent) ? $completionPercentageForRent : 0; ?>;

                    animateProgress($element, percent);
                    observer.unobserve(entry.target); // Stop observing once the animation starts
                }
            });
        });

        // Observe both progress1 and progress2 using jQuery's `get` method to retrieve DOM elements
        observer.observe($progress1.get(0));
        observer.observe($progress2.get(0));
    });
</script>
