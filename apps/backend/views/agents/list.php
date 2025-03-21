<?php defined('MW_PATH') || exit('No direct script access allowed');


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


?>
    <div>
        <!-- header  -->
        <div class="profile-navbar">
            <div>
                <!-- <h3 class="textprimary">Agents List</h3> -->
                <span class="textprimary fontMd sizeSm">Agents Management</span>
                <span>/</span>
                <span class="textgray sizeSm">Agents List</span>
            </div>
            <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id . '/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new'))); ?>
        </div>

        <!-- profile card container   -->
        <div class="card-container">
            <?php foreach ($users->getData() as $user) {
                $firstNameInitial = strtoupper(substr(htmlspecialchars($user->first_name), 0, 1));
                $lastNameInitial = strtoupper(substr(htmlspecialchars($user->last_name), 0, 1));

                // Designation name
                // $serviceName = isset($user->services) ? CHtml::encode($user->services->service_name) : 'Unknown';
                // Country name 
                // $countryName = isset($user->countries) ? CHtml::encode($user->countries->country_name) : 'Unknown';
            ?>
                <div class="profile-card">
                    <div class="image-container padding">
                        <div class="imageContent">
                            <?php if (!empty($user->profile_image)): ?>
                                <img src="<?php echo Yii::app()->baseUrl . '/uploads/profile_images/' . $user->profile_image; ?>"
                                    alt="Profile Image" />
                            <?php else: ?>
                                <h1><?php echo $firstNameInitial . $lastNameInitial ?></h1>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h2 style="margin-bottom: 0; font-weight:700; margin-left: 8px; font-size:1rem;">
                                <?php echo CHtml::encode($user->first_name) . ' ' . CHtml::encode($user->last_name); ?></h2>
                            <p style="margin-bottom: 0;" class="trdRole"><?php echo $serviceName; ?></p>
                        </div>
                    </div>
                    <div class="profile-content">
                        <!-- <div class="px">
                            <p class="twobio"><?php echo CHtml::encode($user->description); ?></p>
                        </div> -->

                        <!-- Display user's email -->
                        <p class="info">Email: <span><?php echo CHtml::encode($user->email); ?></span></p>
                        <hr class="hr">

                        <!-- Display user's phone -->
                        <p class="info">Phone: <span><?php echo CHtml::encode($user->phone_number); ?></span></p>
                        <hr class="hr">

                        <!-- Display user's location -->
                        <p class="info">Location: <span><?php echo $countryName; ?></span></p>
                        <hr class="hr">

                        <div class="px">
                            <?php echo CHtml::link(Yii::t('app', 'Details'), array($this->id . '/view', 'id' => $user->user_id), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Details'))); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="pagination-container">
            <?php
            $this->widget('CLinkPager', array(
                'pages' => $users->pagination, // Using pagination from data provider
                'cssFile' => false, // Disable default CSS
                'header' => '', // Remove header
                'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>', // Custom icon
                'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>', // Custom icon
                'prevPageLabel' => '<i class="fa fa-chevron-left"></i>', // Custom icon
                'nextPageLabel' => '<i class="fa fa-chevron-right"></i>', // Custom icon
                'htmlOptions' => array('class' => 'pagination'), // Custom CSS class
                'selectedPageCssClass' => 'active', // Highlight active page
                'hiddenPageCssClass' => 'hidden', // Hide unnecessary links
            ));
            ?>
        </div>

        <style>
            /* custom pagination css  */
            .pagination-container {
                text-align: center;
                margin-top: 20px;
            }

            .pagination li.hidden,
            .pagination li.disabled {
                display: none;
            }

            .pagination {
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
                padding: 10px 20px;
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


            /* card section start */

            .card-container {
                /* padding: 20px; */
                font-family: 'Roboto', 'Open Sans', sans-serif;
            }

            .profile-card {
                display: flex;
                width: 18rem;
                flex-direction: column;
                background-color: white;
                border-radius: 10px;
                padding: 20px 0 0;
                max-width: 300px;
                box-shadow: rgba(245, 246, 247, 0.2) 0px 8px 24px;
            }

            .padding {
                padding: 0px 20px 0 20px;

            }

            .image-container {
                display: flex;
                align-items: center;
                gap: 4px;
                margin-bottom: 15px;
            }

            .imageContent {
                background: white;
                height: 50px;
                width: 55px;
                display: flex;
                align-items: start;
                justify-content: center;
                border: 3px solid white;
                border-radius: 10px;
                /* padding: 3px; */
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
                overflow: hidden;
            }

            .imageContent img {
                height: 100%;
            }

            .imageContent h1 {
                margin: 0 !important;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #4B19B4;
                color: white;
                /* padding: 5px; */
                border-radius: 10px;
                font-size: 1.5rem;
            }

            .secContent {
                background: white;
                height: 65px;
                width: 65px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 100%;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            }

            .forthContent {
                background: white;
                height: 65px;
                width: 65px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 100%;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            }

            .forthContent h1 {
                margin: 0 !important;
                color: white;
                background-color: #03DD59;
                height: 60px;
                width: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 100%;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);

            }

            .card-container {
                display: flex;
                align-items: start;
                flex-wrap: wrap;
                gap: 1.4rem;
            }

            @media (min-width: 768px) {
                .card-container {}
            }

            @media (min-width: 992px) {
                .card-container {
                    /* grid-template-columns: repeat(4, 1fr); */
                }
            }

            hr {
                /* background-color: #e6e6e6; */
                /* border: 1px solid #eeee; */
                margin: 0.4rem 0;
            }

            .imageContent img {
                width: 55px;
                height: 60px;
                object-fit: cover;
                border-radius: 10px;
                margin: 0;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            }

            .secContent img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 100%;
                margin: 0;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            }

            .container h2 {
                font-size: 18px;
                margin-bottom: 0 !important;
            }

            .userName {
                color: #D2FBFF;
            }

            .profile-content h2 {
                /* font-size: 0.87rem !important; */
                color: #333;
                margin: 0 !important;
                margin-bottom: 0 !important;
            }

            .px {
                padding: 10px 20px 18px;
            }

            .role {
                font-size: 15px;
                color: #4B19B4;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .secrole {
                font-size: 15px;
                color: #7fb8c5;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .trdRole {
                font-size: 15px;
                /* line-height: 25px; */
                color: #C901DC;
                font-weight: 500;
                margin-bottom: 10px;
                margin-left: 8px;
            }

            .fourthBio {
                font-size: 15px;
                color: #F0C0C1;
                font-weight: 500;
                margin-bottom: 10px;
            }

            .profile-content .bio {
                font-size: 14px;
                color: white;
                display: inline;
                background-color: #4B19B4;
                margin-bottom: 20px;
            }

            .profile-content .twobio {
                font-size: 0.93rem;
                line-height: 1rem;
                color: rgb(175, 175, 175);
                display: inline;
                margin-top: 20px;
                margin-bottom: 35px;
            }

            .contact-btn {
                background-color: #03DD59;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                margin: 10px 0;
            }

            .thredbtn {
                background-color: #C901DC;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                margin: 5px 0;
            }

            .forth-btn {
                background-color: #0783C7;
                color: white;
                border: none;
                padding: 8px 18px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                margin: 10px 0;
            }

            .secBtn {
                background-color: #4B19B4;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                margin: 10px 0;
            }

            .profile-content span {
                color: gray;
                margin-right: 4px;
            }

            .info {
                margin: 0;
                font-weight: 600;
                padding: 0 20px;
                font-size: 0.93rem;
                font-family: 'Roboto', 'Open Sans', sans-serif;
            }

            .contact-btn:hover {
                background-color: #0056b3;
            }

            /* card section end */
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