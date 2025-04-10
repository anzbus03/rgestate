<!-- Hero Section -->
<style>
.blog-hero h1,
.blog-hero p {
    font-family: 'Roboto', 'Open Sans', sans-serif;
}
@media (max-width: 800px) {
    .blog-detials{
        padding: 15px;
    }    
    .blog-sidebar{
        padding: 15px;
        
    }
    .subscription-section{
        padding: 15px;
    }
}

.blog-hero h1 {
    font-family: Poppins;
    font-size: 40px;
    font-weight: 600;
    line-height: 25px;
    text-align: left;
}

.blog-hero p {
    font-family: Poppins;
    font-size: 16px;
    font-weight: 300;
    line-height: 25px;
    text-align: left;
    max-width: 35rem;
}

.bg-black {
    background-color: rgba(0, 0, 0, .5);
}

.bg-cover {
    background-size: cover;
}

.opacity-50 {
    opacity: 0.5;
}

.custom-rounded {
    border-radius: 30px !important;
}

.hover-underline:hover {
    text-decoration: underline;
}

.text-warning {
    color: #EF7D28 !important;
}

/* Category menu container spacing */
.custom-category-menu {
    margin-left: 100px;
    margin-right: 100px;
}

/* Responsive margin adjustments */
@media (max-width: 992px) {
    .custom-category-menu {
        margin-left: 30px;
        margin-right: 30px;
    }
}

@media (max-width: 768px) {
    .custom-category-menu {
        margin-left: 15px;
        margin-right: 15px;
    }
}

/* Custom link styles matching Tailwind */
.custom-link {
    position: relative;
    padding-bottom: 0.7rem;
    margin-right: 50px;
    text-decoration: none;
    font-size: 1.125rem;
    /* Text size equivalent to text-lg */
    color: inherit;
    border-bottom: 2px solid transparent;
}

.custom-link:hover {
    border-bottom: 2px solid #EF7D28;
    color: #00699E;
}

/* Divider for search input */
.custom-rotate-divider {
    border-top: 2px solid #A3ABA3;
    width: 25px;
    transform: rotate(-90deg);
    background-color: #A3ABA3;
}

/* Custom input styles */
.custom-input {
    padding: 0.375rem 0;
    border: none;
    outline: none;
}

.custom-input::placeholder {
    color: #A3ABA3;
}

/* Search icon styles */
.search-icon-wrapper {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    border: 1px solid #00699E;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    color: #00699E;
    transform: rotate(90deg);
}

.form-control:focus {
    outline: none !important;
}

.category-menu {
    border-bottom: 1px solid #A6A6A633;
}

.btn:hover {
    color: #FFF;
}
</style>



<!-- Category Menu -->
<style>
.category-section {
    padding-top: 20px;
}

.sub-container {
    cursor: pointer;
}

.sub-container input:focus {
    border: none;
    box-shadow: none;
}

@media (max-width: 768px) {
    .category-section div div div {
        gap: 20px;
    }

    .category-section ul {
        flex-direction: row;
        justify-content: center;
    }

    .category-search {
        flex-direction: row !important;
    }
}

@media (max-width: 640px) {
    .category-section ul {
        flex-direction: column;
        justify-content: center;
    }

    .category-section ul li {
        margin-bottom: 15px;
    }
}

.active {
    border-bottom: 2px solid #EF7D28;
    color: #00699E;
}

.mb-4 {
    margin-bottom: 10px;
}
</style>
<section class="category-section">
    <div class="container">
        <div class="bg-white">
            <div
                style="justify-content: space-between;"
                class="category-menu pb-2 d-flex justify-content-between w-100 border-bottom border-secondary"
            >
                <ul class="mb-0 d-flex align-items-center list-unstyled category-list">
                    <!-- Static Blog Link -->
                    <li class="mr-4">
                        <a href="<?php echo Yii::app()->createUrl('bloglist/index'); ?>"
                            class="custom-link <?php echo $slug == 'blog' ? 'active' : ''; ?>">
                            <?php echo $this->tag->getTag('blog', 'Blog'); ?>
                        </a>
                    </li>

                    <!-- Dynamic Category Links -->
                    <?php foreach ($category as $k => $v) { ?>
                    <li class="mr-4">
                        <a href="<?php echo Yii::app()->createUrl('bloglist/index', array('category' => $v->slug)); ?>"
                            class="custom-link <?php echo $slug == $v->slug ? 'active' : ''; ?>">
                            <?php echo ucfirst($v->name); ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
.recent-posts {
    max-width: 360px;
    margin-top: 50px;
}

.business-card {
    position: relative;
    width: 100%;
    height: 310px;
    background-color: #175e7e;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: left;
    color: white;
    overflow: hidden;
}

.card-content {
    z-index: 2;
    position: relative;
    width: 100%;
    /* Content should be centered */
}

.card-title {
    font-size: 1.5rem;
    /* Adjust font size for prominence */
    font-weight: 600;
    color: white;
    height: 6.2rem;
    width: 71%;
    margin-bottom: 20px;
}

.contact-button {
    display: inline-block;
    background-color: #2ca9e0;
    /* Light blue button */
    padding: 10px 20px;
    border-radius: 5px;
    color: white !important;
    text-decoration: none;
    font-weight: bold;
    font-size: 0.875rem;
    margin-top: 10px;
    display: inline-flex;
    align-items: center;
}

.contact-button i {
    margin-left: 10px;
}

.image-container {
    width: 50%;
    position: absolute;
    bottom: 9px;
    right: -1px;
    z-index: 2;
}

.image-container img {
    width: 100%;
    position: relative;
    border-radius: 10px;
}

.water-bubble {
    position: absolute;
    right: 100px;
    /* Adjust based on bubble positioning */
    top: 50px;
    /* Adjust based on bubble positioning */
    width: 200px;
    height: 200px;
    background-color: #87CEEB;
    /* Light blue bubble color */
    border-radius: 50%;
    z-index: 1;
    opacity: 0.4;
    /* Semi-transparent bubble */
}


.recent-post-item {
    margin-bottom: 20px;
}

.recent-post-img {
    width: 75px;
    height: 75px;
    margin-right: 15px;
}

.recent-post-content {
    margin-left: 15px;
}

.recent-post-title {
    font-size: 12px;
    font-weight: 600;
    color: #000;
    text-decoration: none;
    margin-bottom: 5px;
}

.recent-post-title:hover {
    text-decoration: underline;
}

.recent-post-date {
    font-size: 12px;
    display: flex;
    align-items: center;
}

.custom-spacing-t-2 {
    margin-top: 10px;
}

.recent-posts-title {
    font-size: 12px;
    /* text-lg */
    font-weight: 600;
    /* font-semibold */
    margin-top: 1.25rem;
    /* mt-5 */
}

.recent-posts-underline {
    width: 63px;
    border-bottom: 2px solid #070707;
}

.post-categories {
    display: flex;
    flex-wrap: wrap;
    font-size: 12px;
    gap: 10px;
}


.category {
    width: 30%;
    height: 30px;
    /* margin-top: 1rem; */
    border-radius: 3px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid rgba(166, 166, 166, 0.3);
    /* border-[#A6A6A64D] */
    /* margin-right: 5px; */
}

/* Dropdown styling */
#search-results {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    background-color: #fff;
    border: 1px solid #ddd;
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
}

#search-results li {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

#search-results li:hover {
    background-color: #f0f0f0;
}

.business-platform {
    width: 100%;
    max-width: 295px;
    height: auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #0E4F70;
    margin-top: 2rem;
    /* mt-8 */
    color: white;
    padding: 1rem;
}

.business-text {
    font-weight: 400;
    margin-bottom: 1.25rem;
    /* mb-5 */
    text-align: center;
    font-size: 18px;
    line-height: 1.75rem;
    /* leading-7 */
}

.contact-us-button {
    width: 100%;
    max-width: 121px;
    height: 43px;
    background-color: #39A0D4;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    text-align: center;
}

@media (max-width: 768px) {
    .recent-posts {
        top: auto;
        right: auto;
        position: relative;
        margin: 1rem 0;
    }

    .business-platform {
        max-width: 100%;
        padding: 2rem;
    }

    .category {
        width: 45%;
        margin-bottom: 0.5rem;
    }
}

@media (max-width: 480px) {
    .business-text {
        font-size: 16px;
        line-height: 1.5rem;
    }

    .category {
        width: 100%;
    }

    .recent-posts-title {
        font-size: 1rem;
        /* text-lg */
    }

    .contact-us-button {
        width: 100%;
    }
}

.w-3-4 {
    /* width: 75%; */
}

.bog-content {
    display: flex
}

.space-y-8>*+* {
    margin-top: 32px;

}

.space-x-10>*+* {
    margin-left: 60px;

}

.custom-rounded-lg {
    border-radius: 0.5rem;
}

.custom-bg-blue {
    background-color: #00699E;
}

.custom-text-blue {
    color: #00699E;
}

.custom-border-gray {
    border-color: #A6A6A633;
}

.custom-underline {
    text-decoration: underline;
    text-decoration-thickness: 2px;
    text-underline-offset: 10px;
}

.custom-rotate-90 {
    transform: rotate(90deg);
}
/* Category menu container */
.category-list {
    display: flex;
    flex-wrap: nowrap; /* Prevent wrapping */
    overflow-y: auto; /* Allow horizontal scrolling */
    overflow-x: none;
    padding: 0;
    margin: 0;
    list-style: none;
    gap: 20px; /* Add spacing between items */
}

/* Ensure no wrapping of list items */
.category-list li {
    white-space: nowrap;
}

/* Remove conflicting styles on smaller screens */
@media (max-width: 800px) {
    .category-section ul {
        flex-direction: row !important; /* Ensure items remain inline */
        justify-content: flex-start; /* Align to the left */
    }

    .category-list {
        gap: 10px; /* Adjust spacing for smaller screens */
    }
}

@media (max-width: 640px) {
    .category-section ul {
        flex-direction: row !important; /* Force inline layout */
    }

    .category-section ul li {
        margin-bottom: 0 !important; /* Remove vertical spacing */
    }
}

.custom-spacing-y-4 {
    margin-top: 16px;
    /* Assuming 4 spacing units = 16px */
}

.custom-spacing-t-2 {
    border-top: 2px solid #A6A6A633;
    margin: 10px 0;
}

.custom-bg-dark-blue {
    background-color: #0E4F70;
}

.custom-bg-light-blue {
    background-color: #39A0D4;
}

.custom-rounded-small {
    border-radius: 3px;
}

.custom-rounded-md {
    border-radius: 6px;
}

.custom-rounded-btn {
    border-radius: 10px;
}


/* sidebar  */
.blog-detials {
    width: 70%;
}

.blog-sidebar {
    width: 30%;
}

.blog-sidebar a {
    font-family: 'Inter';
    font-size: 16px;
    font-weight: 600;
    line-height: 20px;
    text-align: left;
    color: #231F20;
}

.blog-sidebar .recent-post-date {
    font-family: 'Poppins';
    font-size: 14px;
    font-weight: 400;
    line-height: 26px;
    text-align: left;
    color: #656865;
    /* margin-top: 15px; */
    display: flex;
    align-items: center;
    gap: 15px;
}

.blog-sidebar .flex-column {
    flex-direction: column;
}

.sidebar-title {
    /* font-family: Inter; */
    font-size: 18px;
    font-weight: 600;
    line-height: 32px;
    text-align: left;
    color: #00699E;
}

.sidebar-search {
    height: 52px;
    margin-bottom: 20px;
    border: 1px solid #A6A6A633
}

.sidebar-search input {
    padding-left: 15px;
    border-radius: 6px;
}

.sidebar-search input:focus {
    outline: none;
    border: none;
    box-shadow: none;
}

.sidebar-search .sidebar-search-icon {
    width: 60px;
    height: 50px;
    font-size: 17px;
    text-align: center;
}

.form-control:focus {
    outline: none;
    box-shadow: none;
    border-color: #007bff;
}


@media (max-width: 768px) {
    .blog-container {
        gap: 50px;
    }

    .expertSection {
        flex-direction: column;
        gap: 40px;
    }

    .blog-detials {
        width: 100%;
    }

    /* blog content  */
    .blog-content {
        width: 100%;
    }

    /* sidebar  */
    .blog-sidebar {
        width: 100%;
        margin-left: 0px;
    }

    .sidebar-search {
        flex-direction: row !important;
    }

    .recent-post div {
        /* align-items: start; */
    }
}
/* Target the content section where lists should have list styles */
.tlText ul, 
.tlText ol {
    list-style: disc; /* For <ul> (you can change to square or circle if needed) */
    list-style-position: inside; /* Ensure that the bullets/numbers are inside the list item */
    padding-left: 20px; /* Add padding for better visibility */
}

.tlText ol {
    list-style: decimal; /* For <ol>, using default decimal style */
}

</style>

    <?php
    if (!empty($model->featured_image) && !is_null($model->featured_image)) {
        $featuredImageUrl = Yii::app()->baseUrl . '/uploads/images/' . $model->featured_image;
    } else {
        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $model->content, $featuredImageUrl);
    }
    $cleanedContent = preg_replace('/<img[^>]+>/i', '', $model->content);
    // echo ;
    // exit; 
      
   
    ?>
    <head>

    </head>
<!-- <pre><?php print_r($model) ?></pre> -->
<!-- main content  -->
<div class="d-flex justify-content-between align-items-start space-x-10 expertSection">

    <div class="blog-detials pa-2">
        <?php
        if (isset($model)) {
            $timthumb =  Yii::app()->apps->getBaseUrl('timthumb.php');
        ?>
        <!-- <img style="object-fit: contain;margin-top:10px;display:block;" src="<?php echo @$imageUrl; ?>"
        class="attachment-blog-image size-blog-image wp-post-image" alt="<?php echo $model->title; ?>"
        srcset="<?php echo $imageUrl; ?> 2200w,<?php echo $timthumb . '?src=' . @$imageUrl . '&h=167&w=300&zc=1'; ?> 300w,<?php echo $timthumb . '?src=' . @$imageUrl . '&h=427&w=768&zc=1'; ?> 768w,<?php echo $timthumb . '?src=' . @$imageUrl . '&h=569&w=1024&zc=1'; ?> 1024w"
        sizes="(max-width: 2200px) 100vw, 2200px" width="2200" height="1222"> -->
        <?php } ?>

        <h3 class="mb-5" style="color: #00699E;font-size: 28px;font:Poppins;font-weight:600;">
            <?php echo $model->title ?>
        </h3>

        <img style="width: 100%;"
            src="<?php echo is_array($featuredImageUrl) ? @$featuredImageUrl['1'] : $featuredImageUrl; ?>"
            class="img-fluid" style="object-fit: cover;" alt="<?php echo $model->title ?>">
        <div class="tlText" style="margin-top: 40px;">
            <p class="dtlParagrap">
                <?php echo $cleanedContent ?>
            </p>
            <!-- <div class="row blog-service-list">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 m-4">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.9495 1.74348L4.99621 9.69182C4.90299 9.78924 4.79101 9.86677 4.66702 9.91973C4.54303 9.97269 4.4096 10 4.27477 10C4.13994 10 4.00651 9.97269 3.88251 9.91973C3.75852 9.86677 3.64654 9.78924 3.55333 9.69182L0.298101 6.45657C0.20336 6.3615 0.128272 6.2487 0.077124 6.12461C0.0259759 6.00052 -0.000230282 5.86758 1.52447e-06 5.73336C0.000469679 5.4623 0.108597 5.20253 0.300598 5.01119C0.492598 4.81985 0.752743 4.71262 1.0238 4.71309C1.29487 4.71356 1.55464 4.82168 1.74598 5.01369L4.27727 7.53998L11.5017 0.300598C11.693 0.108597 11.9528 0.000469681 12.2238 1.52652e-06C12.4949 -0.000466628 12.755 0.106763 12.947 0.298101C13.139 0.48944 13.2472 0.749213 13.2476 1.02027C13.2481 1.29134 13.1409 1.55148 12.9495 1.74348Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Best Business Agency</span>
                </div>
            </div>
        </div> -->


            <!-- <p class="dtlParagrap">Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae abillo
            inventore veritatis et quasi
            architecto beatae vitae dicta sunt explicabo. Nemo enim epsam voluptatem quia voluptas sit aspernature
        </p> -->
            <div class="d-flex align-items-center tag-and-postin"
                style="justify-content: space-between; margin-top:33px; margin-bottom:27px;">
                <div class="d-flex">
                    <?php
                    if (!empty($model->tags)) {
                        echo '
                    <h4 class="mb-1" style="font-size: 18px;font-weight: 600;line-height: 32px;text-align: left;">
                        <span >Tags:<span>
                    </h4>';
                        $tagdata = $model->tags;
                        $tags = explode(',', $tagdata);
                    } else {
                        $tags = [];
                    }
                    ?>
                    <?php foreach ($tags as $tag) { ?>
                    <span class="border border-secondary text-muted px-2" style="border-color: #A6A6A64D;">
                        TEST
                        <?php echo htmlspecialchars(trim($tag)); ?>
                    </span>
                    <?php } ?>
                </div>
                <!-- <div class="d-flex" style="font-size: 18px;font-weight: 600;line-height: 32px;text-align: left;">
                <span class="h5 fw-bold">Posted In</span>
                <span class="text-white postsIn rounded">Business Relator Work</span>
                <span class="text-white postsIn rounded">Investment Work</span>
            </div> -->
            </div>

            <div class="share-this">
                <span>Share This:</span>
                <div>
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>"
                        class="share-icon rounded-circle p-2">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 9.05025C0 13.5247 3.24975 17.2455 7.5 18V11.4998H5.25V9H7.5V6.99975C7.5 4.74975 8.94975 3.50025 11.0002 3.50025C11.6497 3.50025 12.3503 3.6 12.9998 3.69975V6H11.85C10.7498 6 10.5 6.54975 10.5 7.25025V9H12.9L12.5002 11.4998H10.5V18C14.7502 17.2455 18 13.5255 18 9.05025C18 4.0725 13.95 0 9 0C4.05 0 0 4.0725 0 9.05025Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>&amp;url=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>&amp;text=<?php echo urlencode($model->title); ?>"
                        class="share-icon rounded-circle p-2">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 0C4.02991 0 0 4.02991 0 9C0 13.9701 4.02991 18 9 18C13.9701 18 18 13.9701 18 9C18 4.02991 13.9701 0 9 0ZM13.3252 6.78415C13.3312 6.87857 13.3312 6.97701 13.3312 7.07344C13.3312 10.0225 11.0853 13.4196 6.98103 13.4196C5.7154 13.4196 4.54219 13.052 3.55379 12.4192C3.7346 12.4393 3.90737 12.4473 4.09219 12.4473C5.13683 12.4473 6.0971 12.0938 6.8625 11.4951C5.88214 11.475 5.05848 10.8321 4.77723 9.94821C5.12076 9.99844 5.43013 9.99844 5.78371 9.90804C5.27891 9.80548 4.8252 9.53133 4.49963 9.13215C4.17407 8.73298 3.99674 8.23341 3.99777 7.7183V7.69018C4.29308 7.85692 4.64062 7.95937 5.00424 7.97344C4.69857 7.76972 4.44788 7.49373 4.27442 7.16993C4.10096 6.84613 4.01007 6.48452 4.00982 6.11719C4.00982 5.70134 4.1183 5.32165 4.31317 4.99219C4.87347 5.68193 5.57263 6.24604 6.36522 6.64788C7.15781 7.04971 8.02609 7.28026 8.91362 7.32455C8.59821 5.80781 9.73125 4.58036 11.0933 4.58036C11.7362 4.58036 12.3147 4.84955 12.7225 5.28348C13.2268 5.18906 13.7089 5.00022 14.1388 4.7471C13.9721 5.26339 13.6225 5.69933 13.1585 5.97455C13.6085 5.92634 14.0424 5.80179 14.4442 5.62701C14.1408 6.07299 13.7612 6.46875 13.3252 6.78415Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="#" class="share-icon rounded-circle p-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.99998 1.44147C10.1361 1.44147 10.3891 1.4496 11.2327 1.48809C12.0126 1.52369 12.4362 1.65401 12.7182 1.76354C13.0916 1.90867 13.3581 2.08205 13.638 2.36198C13.9179 2.64191 14.0913 2.90844 14.2364 3.28183C14.346 3.56376 14.4763 3.98735 14.5119 4.76731C14.5504 5.61091 14.5585 5.86391 14.5585 8.00002C14.5585 10.1361 14.5504 10.3891 14.5119 11.2327C14.4763 12.0127 14.346 12.4363 14.2364 12.7182C14.0913 13.0916 13.9179 13.3581 13.638 13.638C13.3581 13.918 13.0916 14.0914 12.7182 14.2365C12.4362 14.346 12.0126 14.4763 11.2327 14.5119C10.3892 14.5504 10.1362 14.5586 7.99998 14.5586C5.86375 14.5586 5.61075 14.5504 4.76731 14.5119C3.98732 14.4763 3.56373 14.346 3.28183 14.2365C2.90841 14.0914 2.64188 13.918 2.36195 13.638C2.08202 13.3581 1.90863 13.0916 1.76354 12.7182C1.65398 12.4363 1.52366 12.0127 1.48806 11.2327C1.44957 10.3891 1.44144 10.1361 1.44144 8.00002C1.44144 5.86391 1.44957 5.61091 1.48806 4.76735C1.52366 3.98735 1.65398 3.56376 1.76354 3.28183C1.90863 2.90844 2.08202 2.64191 2.36195 2.36198C2.64188 2.08205 2.90841 1.90867 3.28183 1.76354C3.56373 1.65401 3.98732 1.52369 4.76728 1.48809C5.61088 1.4496 5.86388 1.44147 7.99998 1.44147ZM7.99998 0C5.8273 0 5.55489 0.00920926 4.70161 0.0481422C3.85007 0.0870116 3.26855 0.222229 2.75966 0.420006C2.23359 0.624451 1.78745 0.897998 1.34271 1.34274C0.897966 1.78748 0.624419 2.23363 0.419974 2.7597C0.222197 3.26859 0.0869798 3.8501 0.0481104 4.70164C0.0091775 5.5549 0 5.82733 0 8.00002C0 10.1727 0.0091775 10.4451 0.0481104 11.2984C0.0869798 12.1499 0.222197 12.7314 0.419974 13.2403C0.624419 13.7664 0.897966 14.2125 1.34271 14.6573C1.78745 15.102 2.23359 15.3756 2.75966 15.58C3.26855 15.7778 3.85007 15.913 4.70161 15.9519C5.55489 15.9908 5.8273 16 7.99998 16C10.1727 16 10.4451 15.9908 11.2984 15.9519C12.1499 15.913 12.7314 15.7778 13.2403 15.58C13.7664 15.3756 14.2125 15.102 14.6573 14.6573C15.102 14.2125 15.3755 13.7664 15.58 13.2403C15.7778 12.7314 15.913 12.1499 15.9519 11.2984C15.9908 10.4451 16 10.1727 16 8.00002C16 5.82733 15.9908 5.5549 15.9519 4.70164C15.913 3.8501 15.7778 3.26859 15.58 2.7597C15.3755 2.23363 15.102 1.78748 14.6573 1.34274C14.2125 0.897998 13.7664 0.624451 13.2403 0.420006C12.7314 0.222229 12.1499 0.0870116 11.2984 0.0481422C10.4451 0.00920926 10.1727 0 7.99998 0ZM7.99998 3.89189C5.73114 3.89189 3.89186 5.73117 3.89186 8.00002C3.89186 10.2689 5.73114 12.1081 7.99998 12.1081C10.2688 12.1081 12.1081 10.2689 12.1081 8.00002C12.1081 5.73117 10.2688 3.89189 7.99998 3.89189ZM7.99998 10.6667C6.52723 10.6667 5.3333 9.47277 5.3333 8.00002C5.3333 6.52727 6.52723 5.33333 7.99998 5.33333C9.47273 5.33333 10.6667 6.52727 10.6667 8.00002C10.6667 9.47277 9.47273 10.6667 7.99998 10.6667ZM13.2304 3.72959C13.2304 4.25979 12.8006 4.68961 12.2704 4.68961C11.7402 4.68961 11.3104 4.25979 11.3104 3.72959C11.3104 3.19939 11.7402 2.7696 12.2704 2.7696C12.8006 2.7696 13.2304 3.19939 13.2304 3.72959Z"
                                fill="white" />
                        </svg>

                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>"
                        class="share-icon rounded-circle p-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.63223 15V4.87902H0.20274V14.9999H3.63223V15ZM1.91784 3.49769C3.1134 3.49769 3.85814 2.71986 3.85814 1.74866C3.83553 0.755866 3.1134 0 1.94026 0C0.766937 3.071e-05 0 0.755896 0 1.74869C0 2.71989 0.74433 3.49772 1.89527 3.49772L1.91784 3.49769ZM5.53031 15C5.53031 15 5.57531 5.82864 5.53031 4.87905H8.96033V6.34681H8.93757C9.38857 5.65614 10.2011 4.64139 12.0512 4.64139C14.3082 4.64139 16 6.08792 16 9.1967V15H12.5705V9.58558C12.5705 8.22509 12.0743 7.29673 10.8329 7.29673C9.88558 7.29673 9.32104 7.9226 9.07311 8.52759C8.98241 8.74293 8.96033 9.04539 8.96033 9.34788V15H5.53031Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>

            </div>
            <!-- <hr class="my-4 mx-auto custom-hr" style="color: #A6A6A633;"> -->
            <!-- <div class="d-flex gap-3 revies">
            <!-- <img class="manImage" src="./img/images 3.png" alt=""> 
            <?php if (!empty($model->author->image)) { ?>
            <img src="<?php echo Yii::app()->apps->getBaseUrl() . "uploads/images/" . $model->author->image ?>"
                class="manImage" alt="<?php echo $model->author->name ?>">
            <?php } ?>
            <div class="">
                <h5><?php echo $model->author->name ?></h5>
                <p><?php echo $model->author->description ?></p>
                <div class="user" style="margin-top:20px;">
                    <button class="customPost">Read all Post</button>
                    <div class="d-flex">
                        <a href="#" class="share-icon rounded-circle p-2">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 9.05025C0 13.5247 3.24975 17.2455 7.5 18V11.4998H5.25V9H7.5V6.99975C7.5 4.74975 8.94975 3.50025 11.0002 3.50025C11.6497 3.50025 12.3503 3.6 12.9998 3.69975V6H11.85C10.7498 6 10.5 6.54975 10.5 7.25025V9H12.9L12.5002 11.4998H10.5V18C14.7502 17.2455 18 13.5255 18 9.05025C18 4.0725 13.95 0 9 0C4.05 0 0 4.0725 0 9.05025Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="#" class="share-icon rounded-circle p-2">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 0C4.02991 0 0 4.02991 0 9C0 13.9701 4.02991 18 9 18C13.9701 18 18 13.9701 18 9C18 4.02991 13.9701 0 9 0ZM13.3252 6.78415C13.3312 6.87857 13.3312 6.97701 13.3312 7.07344C13.3312 10.0225 11.0853 13.4196 6.98103 13.4196C5.7154 13.4196 4.54219 13.052 3.55379 12.4192C3.7346 12.4393 3.90737 12.4473 4.09219 12.4473C5.13683 12.4473 6.0971 12.0938 6.8625 11.4951C5.88214 11.475 5.05848 10.8321 4.77723 9.94821C5.12076 9.99844 5.43013 9.99844 5.78371 9.90804C5.27891 9.80548 4.8252 9.53133 4.49963 9.13215C4.17407 8.73298 3.99674 8.23341 3.99777 7.7183V7.69018C4.29308 7.85692 4.64062 7.95937 5.00424 7.97344C4.69857 7.76972 4.44788 7.49373 4.27442 7.16993C4.10096 6.84613 4.01007 6.48452 4.00982 6.11719C4.00982 5.70134 4.1183 5.32165 4.31317 4.99219C4.87347 5.68193 5.57263 6.24604 6.36522 6.64788C7.15781 7.04971 8.02609 7.28026 8.91362 7.32455C8.59821 5.80781 9.73125 4.58036 11.0933 4.58036C11.7362 4.58036 12.3147 4.84955 12.7225 5.28348C13.2268 5.18906 13.7089 5.00022 14.1388 4.7471C13.9721 5.26339 13.6225 5.69933 13.1585 5.97455C13.6085 5.92634 14.0424 5.80179 14.4442 5.62701C14.1408 6.07299 13.7612 6.46875 13.3252 6.78415Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="#" class="share-icon rounded-circle p-2">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.99998 1.44147C10.1361 1.44147 10.3891 1.4496 11.2327 1.48809C12.0126 1.52369 12.4362 1.65401 12.7182 1.76354C13.0916 1.90867 13.3581 2.08205 13.638 2.36198C13.9179 2.64191 14.0913 2.90844 14.2364 3.28183C14.346 3.56376 14.4763 3.98735 14.5119 4.76731C14.5504 5.61091 14.5585 5.86391 14.5585 8.00002C14.5585 10.1361 14.5504 10.3891 14.5119 11.2327C14.4763 12.0127 14.346 12.4363 14.2364 12.7182C14.0913 13.0916 13.9179 13.3581 13.638 13.638C13.3581 13.918 13.0916 14.0914 12.7182 14.2365C12.4362 14.346 12.0126 14.4763 11.2327 14.5119C10.3892 14.5504 10.1362 14.5586 7.99998 14.5586C5.86375 14.5586 5.61075 14.5504 4.76731 14.5119C3.98732 14.4763 3.56373 14.346 3.28183 14.2365C2.90841 14.0914 2.64188 13.918 2.36195 13.638C2.08202 13.3581 1.90863 13.0916 1.76354 12.7182C1.65398 12.4363 1.52366 12.0127 1.48806 11.2327C1.44957 10.3891 1.44144 10.1361 1.44144 8.00002C1.44144 5.86391 1.44957 5.61091 1.48806 4.76735C1.52366 3.98735 1.65398 3.56376 1.76354 3.28183C1.90863 2.90844 2.08202 2.64191 2.36195 2.36198C2.64188 2.08205 2.90841 1.90867 3.28183 1.76354C3.56373 1.65401 3.98732 1.52369 4.76728 1.48809C5.61088 1.4496 5.86388 1.44147 7.99998 1.44147ZM7.99998 0C5.8273 0 5.55489 0.00920926 4.70161 0.0481422C3.85007 0.0870116 3.26855 0.222229 2.75966 0.420006C2.23359 0.624451 1.78745 0.897998 1.34271 1.34274C0.897966 1.78748 0.624419 2.23363 0.419974 2.7597C0.222197 3.26859 0.0869798 3.8501 0.0481104 4.70164C0.0091775 5.5549 0 5.82733 0 8.00002C0 10.1727 0.0091775 10.4451 0.0481104 11.2984C0.0869798 12.1499 0.222197 12.7314 0.419974 13.2403C0.624419 13.7664 0.897966 14.2125 1.34271 14.6573C1.78745 15.102 2.23359 15.3756 2.75966 15.58C3.26855 15.7778 3.85007 15.913 4.70161 15.9519C5.55489 15.9908 5.8273 16 7.99998 16C10.1727 16 10.4451 15.9908 11.2984 15.9519C12.1499 15.913 12.7314 15.7778 13.2403 15.58C13.7664 15.3756 14.2125 15.102 14.6573 14.6573C15.102 14.2125 15.3755 13.7664 15.58 13.2403C15.7778 12.7314 15.913 12.1499 15.9519 11.2984C15.9908 10.4451 16 10.1727 16 8.00002C16 5.82733 15.9908 5.5549 15.9519 4.70164C15.913 3.8501 15.7778 3.26859 15.58 2.7597C15.3755 2.23363 15.102 1.78748 14.6573 1.34274C14.2125 0.897998 13.7664 0.624451 13.2403 0.420006C12.7314 0.222229 12.1499 0.0870116 11.2984 0.0481422C10.4451 0.00920926 10.1727 0 7.99998 0ZM7.99998 3.89189C5.73114 3.89189 3.89186 5.73117 3.89186 8.00002C3.89186 10.2689 5.73114 12.1081 7.99998 12.1081C10.2688 12.1081 12.1081 10.2689 12.1081 8.00002C12.1081 5.73117 10.2688 3.89189 7.99998 3.89189ZM7.99998 10.6667C6.52723 10.6667 5.3333 9.47277 5.3333 8.00002C5.3333 6.52727 6.52723 5.33333 7.99998 5.33333C9.47273 5.33333 10.6667 6.52727 10.6667 8.00002C10.6667 9.47277 9.47273 10.6667 7.99998 10.6667ZM13.2304 3.72959C13.2304 4.25979 12.8006 4.68961 12.2704 4.68961C11.7402 4.68961 11.3104 4.25979 11.3104 3.72959C11.3104 3.19939 11.7402 2.7696 12.2704 2.7696C12.8006 2.7696 13.2304 3.19939 13.2304 3.72959Z"
                                    fill="white" />
                            </svg>

                        </a>
                        <a href="#" class="share-icon rounded-circle p-2">
                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.63223 15V4.87902H0.20274V14.9999H3.63223V15ZM1.91784 3.49769C3.1134 3.49769 3.85814 2.71986 3.85814 1.74866C3.83553 0.755866 3.1134 0 1.94026 0C0.766937 3.071e-05 0 0.755896 0 1.74869C0 2.71989 0.74433 3.49772 1.89527 3.49772L1.91784 3.49769ZM5.53031 15C5.53031 15 5.57531 5.82864 5.53031 4.87905H8.96033V6.34681H8.93757C9.38857 5.65614 10.2011 4.64139 12.0512 4.64139C14.3082 4.64139 16 6.08792 16 9.1967V15H12.5705V9.58558C12.5705 8.22509 12.0743 7.29673 10.8329 7.29673C9.88558 7.29673 9.32104 7.9226 9.07311 8.52759C8.98241 8.74293 8.96033 9.04539 8.96033 9.34788V15H5.53031Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div> -->

            <hr class="my-4 mx-auto custom-hr" style="color: #A6A6A633;">
            <?php
            $modelCritera = Article::model()->findPosts($formData, $count_future = false, 1, $calculate = false);
            // $modelCritera->limit = 6; 
            $result = Article::model()->findAll($modelCritera);

            // Assuming $current_slug is the slug of the current blog post
            $current_slug = $model->slug;

            // Placeholder variables for previous and next posts
            $previous_post = null;
            $next_post = null;

            // Find the current post index
            $current_index = -1;
            foreach ($result as $index => $post) {
                if ($post->slug == $current_slug) {
                    $current_index = $index;
                    break;
                }
            }

            // Determine previous and next posts if the current post is found
            if ($current_index != -1) {
                if ($current_index > 0) {
                    $previous_post = $result[$current_index - 1];
                }
                if ($current_index < count($result) - 1) {
                    $next_post = $result[$current_index + 1];
                }
            }
            // Navigation links for previous and next posts
            echo '<div class="insures-section">';

            if ($previous_post) {
                echo '
                <div class="left">
                    <div>
                        <a href="' . Yii::app()->createUrl('bloglist/details', array('slug' => $previous_post->slug)) . '" class="previous-post">
                            <h6>' . htmlspecialchars(mb_strimwidth($previous_post->title, 0, 40, '...')) . '</h6>
                            <span class="text-muted d-flex align-items-center">
                                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.00039 2.575H12.8504C13.1004 2.575 13.3254 2.375 13.3254 2.1C13.3254 1.825 13.1254 1.625 12.8504 1.625H6.00039C5.75039 1.625 5.52539 1.825 5.52539 2.1C5.52539 2.375 5.75039 2.575 6.00039 2.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M16.9 1.625H15.425C15.175 1.625 14.95 1.825 14.95 2.1C14.95 2.375 15.15 2.575 15.425 2.575H16.9C17.45 2.575 17.9 3.025 17.9 3.575V5.4H0.95V3.575C0.95 3.025 1.4 2.575 1.95 2.575H3.425C3.675 2.575 3.9 2.375 3.9 2.1C3.9 1.825 3.7 1.625 3.425 1.625H1.95C0.875 1.625 0 2.5 0 3.575V18.05C0 19.125 0.875 20 1.95 20H16.9C17.975 20 18.85 19.125 18.85 18.05V3.575C18.85 2.5 17.975 1.625 16.9 1.625ZM17.9 18.05C17.9 18.6 17.45 19.05 16.9 19.05H1.95C1.4 19.05 0.95 18.6 0.95 18.05V6.35H17.9V18.05Z"
                                        fill="#656865" />
                                    <path
                                        d="M4.72578 4.425C5.22578 4.425 5.65078 4.025 5.65078 3.5C5.65078 3.175 5.47578 2.875 5.20078 2.725V0.475C5.20078 0.225 5.00078 0 4.72578 0C4.45078 0 4.25078 0.2 4.25078 0.475V2.725C3.97578 2.875 3.80078 3.175 3.80078 3.5C3.80078 4.025 4.20078 4.425 4.72578 4.425Z"
                                        fill="#656865" />
                                    <path
                                        d="M14.1255 4.425C14.6255 4.425 15.0505 4.025 15.0505 3.5C15.0505 3.175 14.8755 2.875 14.6005 2.725V0.475C14.6005 0.225 14.4005 0 14.1255 0C13.8505 0 13.6755 0.2 13.6755 0.475V2.725C13.4005 2.875 13.2255 3.175 13.2255 3.5C13.2255 4.025 13.6255 4.425 14.1255 4.425Z"
                                        fill="#656865" />
                                    <path
                                        d="M3.475 12.1H6C6.25 12.1 6.475 11.9 6.475 11.625V9.1C6.475 8.85 6.275 8.625 6 8.625H3.475C3.225 8.625 3 8.825 3 9.1V11.625C3 11.875 3.225 12.1 3.475 12.1ZM3.95 9.575H5.55V11.175H3.95V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M8.15078 12.1H10.6758C10.9258 12.1 11.1508 11.9 11.1508 11.625V9.1C11.1508 8.85 10.9508 8.625 10.6758 8.625H8.15078C7.90078 8.625 7.67578 8.825 7.67578 9.1V11.625C7.70078 11.875 7.90078 12.1 8.15078 12.1ZM8.62578 9.575H10.2258V11.175H8.62578V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M12.849 12.1H15.374C15.624 12.1 15.849 11.9 15.849 11.625V9.1C15.849 8.85 15.649 8.625 15.374 8.625H12.849C12.599 8.625 12.374 8.825 12.374 9.1V11.625C12.374 11.875 12.574 12.1 12.849 12.1ZM13.299 9.575H14.899V11.175H13.299V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M3.475 16.725H6C6.25 16.725 6.475 16.525 6.475 16.25V13.725C6.475 13.475 6.275 13.25 6 13.25H3.475C3.225 13.25 3 13.45 3 13.725V16.25C3 16.5 3.225 16.725 3.475 16.725ZM3.95 14.175H5.55V15.775H3.95V14.175Z"
                                        fill="#656865" />
                                    <path
                                        d="M8.15078 16.725H10.6758C10.9258 16.725 11.1508 16.525 11.1508 16.25V13.725C11.1508 13.475 10.9508 13.25 10.6758 13.25H8.15078C7.90078 13.25 7.67578 13.45 7.67578 13.725V16.25C7.70078 16.5 7.90078 16.725 8.15078 16.725ZM8.62578 14.175H10.2258V15.775H8.62578V14.175Z"
                                        fill="#656865" />
                                    <path
                                        d="M12.849 16.725H15.374C15.624 16.725 15.849 16.525 15.849 16.25V13.725C15.849 13.475 15.649 13.25 15.374 13.25H12.849C12.599 13.25 12.374 13.45 12.374 13.725V16.25C12.374 16.5 12.574 16.725 12.849 16.725ZM13.299 14.175H14.899V15.775H13.299V14.175Z"
                                        fill="#656865" />
                                </svg>
                                ' . date('M d, Y', strtotime(!empty($previous_post->publish_date) && $previous_post->publish_date != "0000-00-00" ? $previous_post->publish_date : $previous_post->date_added)) . '
                            </span>
                        </a>
                    </div>
                </div>
                
                ';
            }

            if ($next_post) {
                echo '
                <div class="right">
                    <div>
                        <a href="' . Yii::app()->createUrl('bloglist/details', array('slug' => $next_post->slug)) . '" class="next-post">
                            <h6>' . htmlspecialchars(mb_strimwidth($next_post->title, 0, 30, '...')) . '</h6>
                            <span class="text-muted d-flex align-items-center">
                                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.00039 2.575H12.8504C13.1004 2.575 13.3254 2.375 13.3254 2.1C13.3254 1.825 13.1254 1.625 12.8504 1.625H6.00039C5.75039 1.625 5.52539 1.825 5.52539 2.1C5.52539 2.375 5.75039 2.575 6.00039 2.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M16.9 1.625H15.425C15.175 1.625 14.95 1.825 14.95 2.1C14.95 2.375 15.15 2.575 15.425 2.575H16.9C17.45 2.575 17.9 3.025 17.9 3.575V5.4H0.95V3.575C0.95 3.025 1.4 2.575 1.95 2.575H3.425C3.675 2.575 3.9 2.375 3.9 2.1C3.9 1.825 3.7 1.625 3.425 1.625H1.95C0.875 1.625 0 2.5 0 3.575V18.05C0 19.125 0.875 20 1.95 20H16.9C17.975 20 18.85 19.125 18.85 18.05V3.575C18.85 2.5 17.975 1.625 16.9 1.625ZM17.9 18.05C17.9 18.6 17.45 19.05 16.9 19.05H1.95C1.4 19.05 0.95 18.6 0.95 18.05V6.35H17.9V18.05Z"
                                        fill="#656865" />
                                    <path
                                        d="M4.72578 4.425C5.22578 4.425 5.65078 4.025 5.65078 3.5C5.65078 3.175 5.47578 2.875 5.20078 2.725V0.475C5.20078 0.225 5.00078 0 4.72578 0C4.45078 0 4.25078 0.2 4.25078 0.475V2.725C3.97578 2.875 3.80078 3.175 3.80078 3.5C3.80078 4.025 4.20078 4.425 4.72578 4.425Z"
                                        fill="#656865" />
                                    <path
                                        d="M14.1255 4.425C14.6255 4.425 15.0505 4.025 15.0505 3.5C15.0505 3.175 14.8755 2.875 14.6005 2.725V0.475C14.6005 0.225 14.4005 0 14.1255 0C13.8505 0 13.6755 0.2 13.6755 0.475V2.725C13.4005 2.875 13.2255 3.175 13.2255 3.5C13.2255 4.025 13.6255 4.425 14.1255 4.425Z"
                                        fill="#656865" />
                                    <path
                                        d="M3.475 12.1H6C6.25 12.1 6.475 11.9 6.475 11.625V9.1C6.475 8.85 6.275 8.625 6 8.625H3.475C3.225 8.625 3 8.825 3 9.1V11.625C3 11.875 3.225 12.1 3.475 12.1ZM3.95 9.575H5.55V11.175H3.95V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M8.15078 12.1H10.6758C10.9258 12.1 11.1508 11.9 11.1508 11.625V9.1C11.1508 8.85 10.9508 8.625 10.6758 8.625H8.15078C7.90078 8.625 7.67578 8.825 7.67578 9.1V11.625C7.70078 11.875 7.90078 12.1 8.15078 12.1ZM8.62578 9.575H10.2258V11.175H8.62578V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M12.849 12.1H15.374C15.624 12.1 15.849 11.9 15.849 11.625V9.1C15.849 8.85 15.649 8.625 15.374 8.625H12.849C12.599 8.625 12.374 8.825 12.374 9.1V11.625C12.374 11.875 12.574 12.1 12.849 12.1ZM13.299 9.575H14.899V11.175H13.299V9.575Z"
                                        fill="#656865" />
                                    <path
                                        d="M3.475 16.725H6C6.25 16.725 6.475 16.525 6.475 16.25V13.725C6.475 13.475 6.275 13.25 6 13.25H3.475C3.225 13.25 3 13.45 3 13.725V16.25C3 16.5 3.225 16.725 3.475 16.725ZM3.95 14.175H5.55V15.775H3.95V14.175Z"
                                        fill="#656865" />
                                    <path
                                        d="M8.15078 16.725H10.6758C10.9258 16.725 11.1508 16.525 11.1508 16.25V13.725C11.1508 13.475 10.9508 13.25 10.6758 13.25H8.15078C7.90078 13.25 7.67578 13.45 7.67578 13.725V16.25C7.70078 16.5 7.90078 16.725 8.15078 16.725ZM8.62578 14.175H10.2258V15.775H8.62578V14.175Z"
                                        fill="#656865" />
                                    <path
                                        d="M12.849 16.725H15.374C15.624 16.725 15.849 16.525 15.849 16.25V13.725C15.849 13.475 15.649 13.25 15.374 13.25H12.849C12.599 13.25 12.374 13.45 12.374 13.725V16.25C12.374 16.5 12.574 16.725 12.849 16.725ZM13.299 14.175H14.899V15.775H13.299V14.175Z"
                                        fill="#656865" />
                                </svg>
                                ' . date('M d, Y', strtotime(!empty($next_post->publish_date) && $next_post->publish_date != "0000-00-00" ? $next_post->publish_date : $next_post->date_added)) . '
                            </span>
                        </a>
                    </div>
                </div>    
                ';
            }

            echo '</div>';
            ?>

        </div>
    </div>

    <!-- sidebar  -->
    <div class="blog-sidebar bg-white custom-rounded-lg">
        <div
            class="d-flex align-items-center custom-border-gray custom-rounded-md mb-3 sidebar-search position-relative">
            <input type="text" id="blog-search-input" placeholder="Enter the keywords here..." class="form-control"
                autocomplete="off">
            <div
                class="d-flex justify-content-center align-items-center custom-bg-blue text-white custom-rounded-md custom-rotate-90 sidebar-search-icon">
                <i class="fa fa-search"></i>
            </div>

            <!-- Dropdown for search results -->
            <ul class="dropdown-menu w-100" id="search-results" style="display: none;"></ul>
        </div>

        <!-- recent posts -->
        <h3 class="sidebar-title mt-4" style="margin-bottom: 25px;"><span
                class="sidebar-title custom-underline">Recent</span> Posts</h3>
        <div class="mt-3 recent-post">
            <?php foreach ($ads as $d => $ad): ?>
            <?php
                if ($d >= 5) {
                    break;
                }
                preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ad->content, $imges);
                $imageSrc = !empty($imges[1]) ? $imges[1] : '/assets/img/blog/default.png';

                ?>
            <div class="d-flex align-items-center custom-spacing-y-4">
                <!-- Dynamic Image -->
                <img src="<?php echo !empty($ad->featured_image) ? Yii::app()->apps->getBaseUrl() . "uploads/images/" . $ad->featured_image : $imageSrc; ?>"
                    alt="Recent Post Image" class="rounded-circle"
                    style="width: 75px;  object-fit: cover; height: 75px; margin-right:15px; margin-bottom: 8px;">


                <div class="d-flex flex-column ml-4">
                    <!-- Dynamic Title -->
                    <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $ad->slug)); ?>"
                        class="text-dark" style="font-size: 14px;">
                        <?php echo $ad->title; ?>
                    </a>
                    <!-- Dynamic Date -->
                    <span class="text-muted recent-post-date" style="font-size: 12px;">
                        <?php echo date('M j, Y', strtotime($ad->date_added)); ?>
                    </span>
                </div>
            </div>
            <div class="custom-spacing-t-2"></div>
            <?php endforeach; ?>
        </div>


        <!-- recent category -->
        <!-- <div class="business-card">
            <div class="water-bubble"></div>
            <div class="card-content">
                <h2 class="card-title" style="height: 4rem;">Contact The Best Business Platform</h2>
                <a href="/contact-us" class="contact-button">
                    Contact Us <i class="fa fa-arrow-right"></i>
                </a>
            </div>
            <div class="image-container">
                <img src="<?php echo $this->app->apps->getBaseUrl('assets/img/blog/image.png'); ?>"
                    alt="Business Person" />
            </div>
        </div> -->

        <!-- get in touch  -->
        <section class="background-image contact-box">
            <div class="contact-overlay"></div>

            <div class="getTouch">
                <h2>GET IN TOUCH</h2>
                <h1>Need Any Help? Or Looking For an Agent</h1>
                <!-- <p>
                    Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                    veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                    quia voluptas sit aspernatur.
                </p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>"
                        class="share-icon rounded-circle p-2">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 9.05025C0 13.5247 3.24975 17.2455 7.5 18V11.4998H5.25V9H7.5V6.99975C7.5 4.74975 8.94975 3.50025 11.0002 3.50025C11.6497 3.50025 12.3503 3.6 12.9998 3.69975V6H11.85C10.7498 6 10.5 6.54975 10.5 7.25025V9H12.9L12.5002 11.4998H10.5V18C14.7502 17.2455 18 13.5255 18 9.05025C18 4.0725 13.95 0 9 0C4.05 0 0 4.0725 0 9.05025Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>&amp;url=<?php echo urlencode(Yii::app()->createAbsoluteUrl($model->slug . '/blog')); ?>&amp;text=<?php echo urlencode($model->title); ?>"
                        class="share-icon rounded-circle p-2">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 0C4.02991 0 0 4.02991 0 9C0 13.9701 4.02991 18 9 18C13.9701 18 18 13.9701 18 9C18 4.02991 13.9701 0 9 0ZM13.3252 6.78415C13.3312 6.87857 13.3312 6.97701 13.3312 7.07344C13.3312 10.0225 11.0853 13.4196 6.98103 13.4196C5.7154 13.4196 4.54219 13.052 3.55379 12.4192C3.7346 12.4393 3.90737 12.4473 4.09219 12.4473C5.13683 12.4473 6.0971 12.0938 6.8625 11.4951C5.88214 11.475 5.05848 10.8321 4.77723 9.94821C5.12076 9.99844 5.43013 9.99844 5.78371 9.90804C5.27891 9.80548 4.8252 9.53133 4.49963 9.13215C4.17407 8.73298 3.99674 8.23341 3.99777 7.7183V7.69018C4.29308 7.85692 4.64062 7.95937 5.00424 7.97344C4.69857 7.76972 4.44788 7.49373 4.27442 7.16993C4.10096 6.84613 4.01007 6.48452 4.00982 6.11719C4.00982 5.70134 4.1183 5.32165 4.31317 4.99219C4.87347 5.68193 5.57263 6.24604 6.36522 6.64788C7.15781 7.04971 8.02609 7.28026 8.91362 7.32455C8.59821 5.80781 9.73125 4.58036 11.0933 4.58036C11.7362 4.58036 12.3147 4.84955 12.7225 5.28348C13.2268 5.18906 13.7089 5.00022 14.1388 4.7471C13.9721 5.26339 13.6225 5.69933 13.1585 5.97455C13.6085 5.92634 14.0424 5.80179 14.4442 5.62701C14.1408 6.07299 13.7612 6.46875 13.3252 6.78415Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="#" class="share-icon rounded-circle p-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.99998 1.44147C10.1361 1.44147 10.3891 1.4496 11.2327 1.48809C12.0126 1.52369 12.4362 1.65401 12.7182 1.76354C13.0916 1.90867 13.3581 2.08205 13.638 2.36198C13.9179 2.64191 14.0913 2.90844 14.2364 3.28183C14.346 3.56376 14.4763 3.98735 14.5119 4.76731C14.5504 5.61091 14.5585 5.86391 14.5585 8.00002C14.5585 10.1361 14.5504 10.3891 14.5119 11.2327C14.4763 12.0127 14.346 12.4363 14.2364 12.7182C14.0913 13.0916 13.9179 13.3581 13.638 13.638C13.3581 13.918 13.0916 14.0914 12.7182 14.2365C12.4362 14.346 12.0126 14.4763 11.2327 14.5119C10.3892 14.5504 10.1362 14.5586 7.99998 14.5586C5.86375 14.5586 5.61075 14.5504 4.76731 14.5119C3.98732 14.4763 3.56373 14.346 3.28183 14.2365C2.90841 14.0914 2.64188 13.918 2.36195 13.638C2.08202 13.3581 1.90863 13.0916 1.76354 12.7182C1.65398 12.4363 1.52366 12.0127 1.48806 11.2327C1.44957 10.3891 1.44144 10.1361 1.44144 8.00002C1.44144 5.86391 1.44957 5.61091 1.48806 4.76735C1.52366 3.98735 1.65398 3.56376 1.76354 3.28183C1.90863 2.90844 2.08202 2.64191 2.36195 2.36198C2.64188 2.08205 2.90841 1.90867 3.28183 1.76354C3.56373 1.65401 3.98732 1.52369 4.76728 1.48809C5.61088 1.4496 5.86388 1.44147 7.99998 1.44147ZM7.99998 0C5.8273 0 5.55489 0.00920926 4.70161 0.0481422C3.85007 0.0870116 3.26855 0.222229 2.75966 0.420006C2.23359 0.624451 1.78745 0.897998 1.34271 1.34274C0.897966 1.78748 0.624419 2.23363 0.419974 2.7597C0.222197 3.26859 0.0869798 3.8501 0.0481104 4.70164C0.0091775 5.5549 0 5.82733 0 8.00002C0 10.1727 0.0091775 10.4451 0.0481104 11.2984C0.0869798 12.1499 0.222197 12.7314 0.419974 13.2403C0.624419 13.7664 0.897966 14.2125 1.34271 14.6573C1.78745 15.102 2.23359 15.3756 2.75966 15.58C3.26855 15.7778 3.85007 15.913 4.70161 15.9519C5.55489 15.9908 5.8273 16 7.99998 16C10.1727 16 10.4451 15.9908 11.2984 15.9519C12.1499 15.913 12.7314 15.7778 13.2403 15.58C13.7664 15.3756 14.2125 15.102 14.6573 14.6573C15.102 14.2125 15.3755 13.7664 15.58 13.2403C15.7778 12.7314 15.913 12.1499 15.9519 11.2984C15.9908 10.4451 16 10.1727 16 8.00002C16 5.82733 15.9908 5.5549 15.9519 4.70164C15.913 3.8501 15.7778 3.26859 15.58 2.7597C15.3755 2.23363 15.102 1.78748 14.6573 1.34274C14.2125 0.897998 13.7664 0.624451 13.2403 0.420006C12.7314 0.222229 12.1499 0.0870116 11.2984 0.0481422C10.4451 0.00920926 10.1727 0 7.99998 0ZM7.99998 3.89189C5.73114 3.89189 3.89186 5.73117 3.89186 8.00002C3.89186 10.2689 5.73114 12.1081 7.99998 12.1081C10.2688 12.1081 12.1081 10.2689 12.1081 8.00002C12.1081 5.73117 10.2688 3.89189 7.99998 3.89189ZM7.99998 10.6667C6.52723 10.6667 5.3333 9.47277 5.3333 8.00002C5.3333 6.52727 6.52723 5.33333 7.99998 5.33333C9.47273 5.33333 10.6667 6.52727 10.6667 8.00002C10.6667 9.47277 9.47273 10.6667 7.99998 10.6667ZM13.2304 3.72959C13.2304 4.25979 12.8006 4.68961 12.2704 4.68961C11.7402 4.68961 11.3104 4.25979 11.3104 3.72959C11.3104 3.19939 11.7402 2.7696 12.2704 2.7696C12.8006 2.7696 13.2304 3.19939 13.2304 3.72959Z"
                                fill="white" />
                        </svg>

                    </a>
                    <a href="#" class="share-icon rounded-circle p-2">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.63223 15V4.87902H0.20274V14.9999H3.63223V15ZM1.91784 3.49769C3.1134 3.49769 3.85814 2.71986 3.85814 1.74866C3.83553 0.755866 3.1134 0 1.94026 0C0.766937 3.071e-05 0 0.755896 0 1.74869C0 2.71989 0.74433 3.49772 1.89527 3.49772L1.91784 3.49769ZM5.53031 15C5.53031 15 5.57531 5.82864 5.53031 4.87905H8.96033V6.34681H8.93757C9.38857 5.65614 10.2011 4.64139 12.0512 4.64139C14.3082 4.64139 16 6.08792 16 9.1967V15H12.5705V9.58558C12.5705 8.22509 12.0743 7.29673 10.8329 7.29673C9.88558 7.29673 9.32104 7.9226 9.07311 8.52759C8.98241 8.74293 8.96033 9.04539 8.96033 9.34788V15H5.53031Z"
                                fill="white" />
                        </svg>
                    </a>
                </div> -->
            </div>


            <div class="form-section">
                <form method="POST" id="contactForm">
                    <!-- CSRF Protection -->
                    <!-- <?php if (Yii::app()->request->enableCsrfValidation) { ?> -->
                    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                    <!-- <?php } ?> -->

                    <div class="">
                        <div class="form-fiels">
                            <div class="contact-input">
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.8075 9.60118C12.3022 8.57974 11.7103 7.68212 10.6998 7.14045C10.2812 6.90831 9.77592 6.97021 9.40059 7.27974C8.59218 7.94522 7.58166 8.3476 6.49897 8.3476C5.41627 8.3476 4.40576 7.94522 3.59734 7.27974C3.22201 6.97021 2.71675 6.90831 2.29811 7.14045C1.30203 7.68212 0.666848 8.57974 0.16159 9.60118C-0.401411 10.7309 0.594668 12 1.79285 12H11.4361C12.6342 12 13.3705 10.7309 12.8075 9.60118Z"
                                        fill="#A9A9A9" />
                                    <path
                                        d="M6.5 7C8.425 7 10 5.30891 10 3.53465C10 1.7604 8.425 0 6.5 0C4.575 0 3 1.74654 3 3.53465C3 5.32277 4.575 7 6.5 7Z"
                                        fill="#A9A9A9" />
                                </svg>
                                <input type="text" name="name" id="name" placeholder="Enter your name">
                            </div>
                            <div class="contact-input">
                                <svg width="15" height="12" viewBox="0 0 15 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.9032 6.23165C7.78316 6.31964 7.64157 6.3636 7.50002 6.3636C7.35839 6.3636 7.21684 6.31964 7.0968 6.23165L1.36363 2.02734L4.54544e-05 1.02739L0 10.6818C4.54544e-05 11.0584 0.305272 11.3636 0.681816 11.3636L14.3182 11.3636C14.6948 11.3636 15 11.0583 15 10.6818V1.02734L13.6363 2.02734L7.9032 6.23165Z"
                                        fill="#A9A9A9" />
                                    <path d="M7.50025 4.83635L14.0951 4.54294e-05L0.905273 0L7.50025 4.83635Z"
                                        fill="#A9A9A9" />
                                </svg>

                                <input type="email" name="email" id="email" placeholder="Enter your email address">
                            </div>
                            <div class="contact-input-phone col-12 col-md-12">
                               
                                <input type="tel" name="contact" id="popup-phone" placeholder="Enter your contact number">
                            </div>
                            <div class="contact-input-select">
                               
                                <select name="service" id="service" class="form-control">
                                    <option value="">Select your service</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Project Funding">Project Funding</option>
                                    <option value="Retail Investments">Retail Investments</option>
                                    <option value="Business Funding">Business Funding</option>
                                    <option value="Project Development">Project Development</option>
                                    <option value="Project Contracting">Project Contracting</option>
                                    <option value="Interior Fitouts">Interior Fitouts</option>
                                    <option value="Building Maintenance">Building Maintenance</option>
                                    <option value="Buy/Sell Business">Buy/Sell Business</option>
                                </select>
                            </div>

                        </div>
                     
                        <!-- <div class="row"> -->
                        <div class="w-full contact-textarea">
                            <div style="position: relative;">
                                <textarea id="message" rows="3" name="message"
                                    style="height: 250px;resize: none; width: 100%;"
                                    placeholder="Enter your message"></textarea>
                                <p id="wordCount"
                                    style="position: absolute; bottom: 5px; right: 10px; margin: 0; font-size: 12px; color: #555;">
                                    0 / 50 words</p>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>


                    <button type="btn" id="submitFormContact" class="btn bg-Color text-white inquiry-btn">SEND INQUIRY</button>
                    <!-- Success message placeholder -->
                    <div id="successMessage" style="display: none; color: green; margin-top: 10px;">
                        Your message has been sent successfully!
                    </div>

                    <!-- Error message placeholder -->
                    <div id="errorMessage" style="display: none; color: red; margin-top: 10px;">
                        There was an error sending your message.
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>

<section class="newsletter-section">
    <div class="newsletter-bg">
        <div class="newsletter-overlay"></div>
        <div class="newsletter-content">
            <!-- Text Content -->
            <div class="newsletter-text">
                <h2>Get The Latest News & Offers</h2>
                <p>We'll send you a nice letter once per week. No Spam.</p>
            </div>

            <!-- Subscription Form -->
            <form class="newsletter-form">
                <div class="newsletter-input-container">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" class="newsletter-input" />
                </div>
                <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<style>
        /* General Section Styles */
    .newsletter-section {
        width: 100%;
        padding: 50px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .newsletter-bg {
        position: relative;
        background-image: url('<?php echo $this->app->apps->getBaseUrl('assets/img/blog/subscription.jpeg'); ?>');
        background-size: cover;
        background-position: center;
        width: 100%;
        max-width: 1200px;
        height: 300px;
        border-radius: 10px;
        overflow: hidden;
    }

    .newsletter-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    /* Content Wrapper */
    .newsletter-content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        height: 100%;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Text Content */
    .newsletter-text {
        color: white;
        max-width: 50%;
    }

    .newsletter-text h2 {
        font-size: 2.2rem;
        color: white;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .newsletter-text p {
        color: white;
        font-size: 1.1rem;
        margin-bottom: 0;
        font-weight: 600;
        line-height: 1.5;
    }

    /* Subscription Form */
    .newsletter-form {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 50%;
        width: 100%;
    }

    .newsletter-input-container {
        position: relative;
        flex-grow: 1;
    }

    .newsletter-input {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border: none;
        border-radius: 5px 0 0 5px;
        font-size: 1rem;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .newsletter-input-container i.fa-envelope {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #00699E;
        font-size: 1.2rem;
    }

    .newsletter-button {
        padding: 12px 20px;
        background-color: #EF7D28;
        color: white;
        border: none;
        border-radius: 0 5px 5px 0;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .newsletter-button:hover {
        background-color: #e69500;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .newsletter-content {
            flex-direction: column;
            text-align: center;
            height: 80%;
            padding-top: 30px;
            gap: 20px;
        }

        .newsletter-text {
            max-width: 100%;
        }

        .newsletter-form {
            max-width: 100%;
        }

        .newsletter-input {
            border-radius: 5px;
        }

        .newsletter-button {
            border-radius: 5px;
        }
    }

</style>

<!-- <section class="subscription-section">
    <div class="position-relative subscription-bg">
        <div class="overlay"></div>

        <div class="content-wrapper">
            <div class="text-content">
                <h2>Get The Latest News & Offers</h2>
                <p>We'll send you a nice letter once per week. No Spam.</p>
            </div>

            <form class="subscription-form">
                <i class="fa fa-envelope"></i>
                <input type="email" placeholder="Email Address" />
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section> -->

<script>
    
const message = document.getElementById('message');
const wordCount = document.getElementById('wordCount');
const maxWords = 50;

message.addEventListener('input', function() {
    const words = this.value.match(/\b[-?(\w+)?]+\b/gi) || [];
    if (words.length >= maxWords) {
        // Prevent typing if the word limit is reached
        this.value = words.slice(0, maxWords).join(" ");
        // Optionally, you can prevent further input
        this.setAttribute("maxlength", this.value.length); // Optional: limit input length to the current value
    } else {
        this.removeAttribute("maxlength"); // Remove limit if under max
    }
    // wordCount.textContent = `${words.length}/${maxWords} words`;
});
</script>


<!-- Include intlTelInput initialization -->
<script>
  // Declare iti globally so it can be used in the submit handler.
  var iti;
  $(document).ready(function() {
      var popup = document.querySelector("#popup-phone");
      iti = window.intlTelInput(popup, {
          hiddenInput: "phone",
          initialCountry: "<?php echo COUNTRY_CODE;?>",
          placeholderNumberType: "MOBILE",
          separateDialCode: true,
          utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
      });
  
      // Submit form handler
      $('#submitFormContact').click(function(e) {
          e.preventDefault(); // Prevent default form submission
  
          // Get the selected country code (dial code) from intlTelInput instance
          var dialCode = iti.getSelectedCountryData().dialCode;
          
          // Retrieve other form values
          let name       = $("#name").val();
          let email      = $("#email").val();
          let contact    = $("#popup-phone").val();
          let service    = $("#service").val();
          let message    = $("#message").val();
          let csrf_token = $("#csrf_token").val();
  
          // Logging for debug
          console.log("Dial Code:", dialCode);
          console.log("Name:", name);
          console.log("Email:", email);
          console.log("Contact:", contact);
          console.log("Service:", service);
          console.log("Message:", message);
          return;
          // Now send the data via AJAX, including the dial code
          $.ajax({
              url: "<?php echo Yii::app()->createAbsoluteUrl('site/submit'); ?>",
              type: 'POST',
              data: {
                  name: name,
                  email: email,
                  contact: contact,
                  dialCode: dialCode, // pass the selected country dial code here
                  service: service,
                  message: message,
                  csrf_token: csrf_token,
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      $('#successMessage').show().html(response.message);
                      $('#contactForm')[0].reset();
                      $('#errorMessage').hide();
                  } else {
                      $('#errorMessage').html(response.message).show();
                      $('#successMessage').hide();
                  }
              }
          });
      });
  });
</script>


<!-- search result  -->
<script>
var ads = <?php echo json_encode(array_map(function ($ad) {
                    return ['title' => $ad->title, 'slug' => $ad->slug];
                }, $ads)); ?>;
document.getElementById('blog-search-input').addEventListener('input', function() {
    const query = this.value.trim().toLowerCase();
    const dropdown = document.getElementById('search-results');

    // Clear previous results
    dropdown.innerHTML = '';

    if (query.length > 2) {
        let hasResults = false;

        // Iterate over PHP $ads variable (available via inline JavaScript below)
        ads.forEach(function(ad) {
            if (ad.title.toLowerCase().includes(query)) {
                const li = document.createElement('li');
                li.textContent = ad.title;
                li.addEventListener('click', function() {
                    window.location.href = `/blog/${ad.slug}`;
                });
                dropdown.appendChild(li);
                hasResults = true;
            }
        });

        // Show the dropdown if there are matching results
        dropdown.style.display = hasResults ? 'block' : 'none';
    } else {
        dropdown.style.display = 'none';
    }
});
</script>

<style>
:root {
    --blog-font-color: #656865;
    --custom-gray: #f5f5f5;
    --blog-primary: #00699E;
    --blog-secondary-font: #A3ABA3;
    --background1: #333333;
    --bordersec: #A6A6A6;
}

/* subscription-form */
.subscription-section {
    width: 100%;
    padding: 70px 0 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.position-relative {
    position: relative;
}

.subscription-bg {
    background-image: url('<?php echo $this->app->apps->getBaseUrl('assets/img/blog/subscription.jpeg'); ?>');
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 400px;
    border-radius: 10px;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(6, 54, 78, 0.5);
    border-radius: 10px;
}

.content-wrapper {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
    padding: 0 60px;
    width: 100%;
    z-index: 2;
}

.text-content {
    color: white;
    max-width: 60%;
}

.text-content h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.text-content p {
    font-size: 1.2rem;
    margin-bottom: 0;
    color: white;
    line-height: 0px;
}

/* Subscription Form */

.subscription-form {
    position: relative;
    display: flex;
    align-items: center;
    max-width: 40%;
    width: 100%;
}

.subscription-form input[type="email"] {
    width: 100%;
    padding: 15px 20px 15px 65px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    outline: none;
}

.subscription-form button {
    padding: 15px 20px;
    /* margin-left: 10px; */
    background-color: #00699E;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
}

.subscription-form i.fa-envelope {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #00699E;
    font-size: 1.2rem;
}

/* subscription-form */



.subscription-section div {
    height: 275px;
    width: 100%;
}

.bg-black {
    background-color: #06364E80;
    border-radius: 10px;
}

.subscription-form {
    position: relative;
    display: flex;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.subscription-form input[type="email"] {
    border: none;
    padding: 14px 15px 10px 50px;
    width: 100%;
    border-radius: 4px 0 0 4px;
}

.subscription-form button {
    border: none;
    background-color: #EF7D28;
    color: black;
    font-weight: 500;
    padding: 12px 20px;
    cursor: pointer;
    border-radius: 0 4px 4px 0;
    transition: background-color 0.3s;
}

.subscription-form button:hover {
    background-color: #e69500;
    /* Darker orange on hover */
}

.share-this {
    display: flex;
    align-items: center;
    gap: 10px;

}

.share-this span {
    font-size: 18px;
    font-weight: 600;
    line-height: 32px;
    text-align: left;
    color: #313131;
}

.share-this div {
    display: flex;
    justify-content: start;
    align-items: center;
    gap: 20px;
}

.social-icons {
    display: flex;
    justify-content: start;
    align-items: center;
    gap: 15px;
}

.share-this div .share-icon,
.social-icons .share-icon {
    background-color: #00699E;
    border-radius: 100% !important;
    height: 32px;
    width: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user {
    display: flex;
    justify-content: start;
    align-items: center;
}

.user div {
    gap: 12px;
}

.user .share-icon {
    background-color: #7B7B7B80;
    border-radius: 100% !important;
    height: 32px;
    width: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.insures-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

h2 {
    font-size: 20px;
}

.insures-section h6 {
    font-size: 18px;
    font-weight: 600;
    line-height: 20px;
    text-align: left;
    color: #231F20;
    margin-bottom: 10px;
}

.insures-section span {
    font-size: 14px;
    font-weight: 400;
    line-height: 26px;
    text-align: left;
    color: #656865;
}

.insures-section span svg {
    margin-right: 6.15px;
}


.insures-section .right div {
    display: flex;
    flex-direction: column;
    align-items: end;

}

.get-touch {
    position: relative;
}

.form-section {
    background-color: transparent !important;
    width: 100%;
    position: relative;
}

.form-fiels {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
    margin-bottom: 20px;
}

.form-section .border-secondary {
    border-color: #A6A6A64D
}

.contact-input {
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 10px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 2px 2px 29px 0 #00000014;
    padding: 10px 20px;
    width: 100%;
    /* margin: 0 20px 20px 0; */
}
.contact-input-select {
    display: flex;
    align-items: center;
    justify-content: start;
    /* gap: 10px; */
    background-color: white;
    border-radius: 8px;
    box-shadow: 2px 2px 29px 0 #00000014;
    /* padding: 10px 20px; */
    width: 100%;
    /* margin: 0 20px 20px 0; */
}

.contact-input-phone {
    display: flex;
    align-items: center;
    justify-content: start;
    /* gap: 10px; */
    background-color: white;
    border-radius: 8px;
    box-shadow: 2px 2px 29px 0 #00000014;
    padding: 10px 13px;
    /* width: 100%; */
    /* margin: 0 20px 20px 0; */
}

.contact-textarea {
    background-color: white;
    border-radius: 8px;
    resize: none;
    box-shadow: 2px 2px 29px 0 #00000014;
    margin-bottom: 25px;
}

.contact-input input,
.contact-input-phone input {
    border: none;
}

.contact-input input:focus,
.contact-input-phone input:focus {
    border: none;
    outline: none;
    box-shadow: none;
}

a {
    color: #00699E;
}

.form-section textarea {
    border: none !important;
    outline: none !important;
    border-radius: 8px;
}

.form-section textarea:focus {
    border: none;
    outline: none;
    box-shadow: none;
}

.inquiry-btn {
    font-size: 16px;
    font-weight: 600;
    line-height: 35px;
    text-align: left;
    padding: 22px;
    border-radius: 86px;
    display: flex;
    justify-content: center;
    align-items: center;

}

.text-muted {
    color: #6c757d !important;
}

.postsIn {
    background-color: #00699E;
    padding: 10px 19px;
    border-radius: 0.25rem;
    color: white;
    font-size: 14px;
    font-weight: 500;
    line-height: 20px;
    text-align: left;
    margin-left: 7px;

}

.flex-column.flex-lg-row {
    display: flex;
    flex-direction: column;
}

@media (min-width: 992px) {
    .flex-column.flex-lg-row {
        flex-direction: row;
        justify-content: space-between;
    }
}

.flex-wrap.flex-md-row {
    display: flex;
    flex-wrap: wrap;
}

@media (min-width: 768px) {
    .flex-wrap.flex-md-row {
        flex-wrap: nowrap;
    }
}

.gap-1 {
    margin-right: 0.25rem;
    margin-bottom: 0.25rem;
}

.gap-2 {
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.mb-1 {
    margin-bottom: 0.25rem;
    color: var(--blog-primary);
    margin-right: 10px;
}

.mb-2 {
    margin-bottom: 0.5rem;
}

@media (max-width: 576px) {
    .mb-md-0 {
        margin-bottom: 0;
    }
}

.my-5 {
    margin-top: 3rem;
    margin-bottom: 3rem;
}



.text-primary {
    color: #007bff !important;
}

.fw-bold {
    font-weight: bold;
}

.h5 {
    font-size: 18px;
    font-weight: 500;
    color: var(--blog-primary);
    margin-right: 3px;
}

@media (max-width: 992px) {
    .h5 {
        font-size: 1.1rem;
    }
}

.border {
    border: 1px solid;
    border-radius: 3px;
    padding: 2px 9px;
    margin-right: 10px;
}


.blog-service-list {
    margin-top: 30px;
    margin-top: 30px;
}

.blog-service-list span {
    font-size: 16px;
    font-weight: 400;
    line-height: 26px;
    text-align: left;

}

.blog-service-list>div {
    margin-bottom: 20px;
}

.background {
    background-color: #F5F5F5;
}

.customNavbar {
    padding: 40px 100px;
}

.textPrimary {
    color: #00699E;
}

.text-primary {
    font-size: 28px;
}

.txt .postsIn {
    background-color: #00699E;
    padding: 20px 10px;
}

.margin {
    margin: 0 100px;
}

.customButton {
    background-color: #333333;
}

.banner-image {
    height: 450px;
}

.bannerOverFlow {
    height: 450px;
}

.fontSize {
    font-size: 40px;
}

.userNav {
    margin: 70px 0;
}

.iconSize {
    height: 36px;
    width: 36px;
}

.custom-input {
    background-color: transparent;
    border-left: 1px solid #656865;
    border-radius: 0;
}

.custom-input::placeholder {
    color: #656865;
}

.custom-input:focus {
    outline: none;
}

.custom-overlay {
    background-color: #06364E;
    opacity: 0.8;
}

.custom-input {
    padding-left: 2.5rem;
}

.custom-button {
    background-color: #EF7D28;
    color: white;
}

.custom-button:hover {
    background-color: #005ea1;
}

.custom-icon {
    position: absolute;
    left: 0.75rem;
    color: #00699E;
}

.icon-button {
    background-color: var(--blog-primary);
    height: 36px;
    width: 36px;
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.link {
    text-decoration: none;
    color: var(--blog-font-color);
    margin-top: 10px;
}

.custom-hr {
    background-color: #A6A6A633;
    border: none;
    height: 1px;
}

.custom-bg {
    background-color: #ffffff;
}

.custom-text-blog-primary {
    color: #00699E;
}

.custom-text-fontColor {
    color: #656865;
}

.custom-button:hover {
    background-color: #005ea1;
}

.custom-divider {
    background-color: #656865;
}

.emailInput {
    width: 50%;
}

.textContent {
    width: 50%;
}

.dtlText {
    padding: 0 40px;
}

.dtlParagrap {
    font-size: 16px;
    line-height: 26px;
}

.dtlIcon {
    background: #005ea1;
    border-radius: 100%;
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 13px;
    padding: 4px;
}


.customPost {
    background: var(--blog-primary);
    padding: 8px 20px;
    color: white;
    border-radius: 30px;
    border: none;
    margin-right: 20px;
}

.readIcon {
    height: 32px;
    width: 32px;
    background-color: #7B7B7B;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.manImage {
    height: 85px;
    width: 85px;
}

.revies {
    margin-top: 40px;
    gap: 17px;
}

.revies h5 {
    font-size: 20px;
    font-weight: 600;
    line-height: 26px;
    text-align: left;
    color: #00699E;
    margin-bottom: 10px;
}

.col-lg-40 {
    flex: 0 0 auto;
    width: 40%;
}

.col-lg-60 {
    flex: 0 0 auto;
    width: 60%;
}

.input-group-icon {
    position: relative;
}

.input-group-icon .fa {
    position: absolute;
    left: 10px;
    top: 0;
    transform: translateY(-50%);
    color: #999;
}

.formIcon {
    position: absolute;
    left: 10px;
    top: 16px;
    transform: translateY(-50%);
    color: #999;
}

.input-group-icon input {
    padding-left: 35px;
}

.socalForm {
    height: 36px;
    width: 36px;
    border-radius: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #00699E;
    color: white;
}

.bg-Color {
    background-color: #00699E;
}

.background-image {
    background-image: url('<?php echo $this->app->apps->getBaseUrl('assets/img/blog/bg-waves.png'); ?>');
    /* background-size: 55%; */
    background-size: 95%;
    background-position: bottom left;
    background-repeat: no-repeat;
    /* padding: 20px; */
    /* background: #00699E0D; */
}

.magIcon {
    transform: rotate(90deg);
}

.mtb50 {
    margin: 50px 0;
}

.extraMargin {
    padding: 70px 100px;
    margin: 70px 0;
}

.position-relative {
    position: relative;
}

.formIcon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #555;
}

.form-control {
    padding: 10px 0px 10px 30px;
    background-color: transparent !important;

}

.form-control::placeholder {
    color: #888;
}

.contact-box {
    display: flex;
    flex-direction: column;
    gap: 15px;
    /* position: absolute; */
    width: 100%;
    position: relative;
    margin-top: 40px;
    padding: 40px 20px;
}

.contact-box .contact-overlay {
    background-color: rgba(0, 105, 158, 0.05);
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    border-radius: 8px;
}

.getTouch {
    /* padding: 0 50px; */
    width: 100%;
}

.getTouch h2 {
    font-size: 18px;
    font-weight: 400;
    line-height: 20px;
    text-align: left;
    color: #00699E;
}

.getTouch h1 {
    font-size: 30px;
    font-weight: 600;
    line-height: 40px;
    text-align: left;
    color: #383939;
}

.getTouch p {
    font-size: 16px;
    font-weight: 400;
    line-height: 26px;
    text-align: left;
    color: #656865;
}

.expertSection {
    margin: 0 57px;
}

.subBtn {
    border: none;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}

.subInput {
    border: none;
    width: 100%;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

/* Media queries */
@media only screen and (max-width: 1200px) {
    body {
        .nav-link {
            font-size: 12px;
        }

        .dtlText {
            padding: 0 50px;
        }

        .customButton {
            font-size: 13px;
        }

        .margin {
            margin: 0 50px;
        }

        .customNavbar {
            padding: 20px 50px;
        }

        .subBtn {
            border: none;
        }

        .subInput {
            border: none;
            width: 100%;
        }
    }
}

@media only screen and (max-width: 600px) {
    body {
        .customNavbar {
            padding: 10px 0px;
        }

        .subBtn {
            border: none;
        }

        .subInput {
            border: none;
            width: 100%;
        }

        .dtlText {
            padding: 0 40px;
        }

        .textContent {
            width: 100%;
        }

        .margin {
            margin: 0 20px;
        }

        .banner-image {
            height: 350px;
        }

        .bannerOverFlow {
            height: 350px;
        }

        .user-li {
            font-size: 13px;
        }
    }
}

@media only screen and (max-width: 576px) {
    body {
        .dtlText {
            padding: 0 30px;
        }

        .margin {
            margin: 0 5px;
        }

        .expertSection {
            margin: 0 0px;
        }

        .extraMargin {
            padding: 0px 10px;
            margin: 30px 0;
        }

        .subBtn {
            border: none;
        }

        .subInput {
            border: none;
            width: 100%;
        }
    }
}

@media only screen and (max-width: 768px) {
    body {
        .dtlText {
            padding: 0 0;
        }

        .postsIn {
            font-size: 11px;
        }

        .subBtn {
            border: none;
        }

        .subInput {
            border: none;
            width: 100%;
        }

        .tag-and-postin {
            flex-direction: column;
            gap: 10px;
            align-items: start;
        }
    }
}
</style>