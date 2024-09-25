<!-- <?php
        // $timthumb =  Yii::app()->apps->getBaseUrl('timthumb.php');
        // $read_more =  'Read more';
        // $last_updated_on = 'Last updated on';
        // $langaugae = 'en';
        // $commonModel = new OptionCommon();

        // foreach ($ads as $k => $v) {
        // 	preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);


        // 
        ?>
		<li aria-hidden="false" class="mb-15 col-sm-4 brkr "  >
		    <div class="f-ull-height">
		        <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>"     class="_xvt7x" aria-busy="false"></a>
		        <div class="blog-img">
		            	<img class=" lozad" style="object-fit: cover;" alt="<?php echo $v->title; ?>" decoding="async" data-src="<?php echo @$imges['1']; ?>">
		        </div>
		         <div class="blog-text">
		             <?php echo $v->title; ?>
		         </div>
		    </div>
		 
		</li>  -->
<?php
// } 
?>




<!-- new design  -->
<?php foreach ($ads as $k => $v): ?>
<?php
    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);
    $imageSrc = !empty($imges[1]) ? $imges[1] : '/assets/img/blog/default.png';
    $postDate = !is_null($v->publish_date) && $v->publish_date != "0000-00-00" ? date('M j, Y', strtotime($v->publish_date)) : date('M j, Y', strtotime($v->date_added));
    $excerpt = strip_tags($v->content);
    ?>
<div class="card mb-4">

    <div class="no-gutters">
        <div class="card-img">
            <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" class="_xvt7x"
            aria-busy="false">
                <?php if (!empty($v->featured_image)) { ?>
                    <img src="<?php echo Yii::app()->apps->getBaseUrl() . "uploads/images/" . $v->featured_image ?>"
                        class="custom-rounded-img" alt="<?php echo CHtml::encode($v->title); ?>">
                <?php } else { ?>
                    <img src="<?php echo $imageSrc; ?>" class="custom-rounded-img"
                        alt="<?php echo CHtml::encode($v->title); ?>">
                <?php } ?>
            </a>
        </div>


        <div class="card-body">
            <div style="justify-content: space-between;"
                class="d-flex justify-content-between align-items-center card-header">
                <div class="d-flex align-items-center">
                    <div class="custom-text-gray blog-date">
                        <svg style="margin-right: 10px;margin-top: 2px;" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                d="M14.1253 4.425C14.6253 4.425 15.0503 4.025 15.0503 3.5C15.0503 3.175 14.8753 2.875 14.6003 2.725V0.475C14.6003 0.225 14.4003 0 14.1253 0C13.8503 0 13.6753 0.2 13.6753 0.475V2.725C13.4003 2.875 13.2253 3.175 13.2253 3.5C13.2253 4.025 13.6253 4.425 14.1253 4.425Z"
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

                        <div style="margin-bottom: 10px;display: inline-block;"><?php echo $postDate; ?></div>
                    </div>
                </div>
                <div class="share-icon-container">
                    <div class="rounded-circle custom-shadow p-2 d-flex justify-content-center align-items-center text-align-center"
                        style="width: 36px;cursor: pointer; height: 36px; background-color: white;" onclick="toggleShareMenu(<?php echo $v->article_id; ?>)">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.9504 9.71901C11.2562 9.71901 10.6364 9.99173 10.1653 10.438L5.23141 8.03306C5.2562 7.8595 5.28099 7.68595 5.28099 7.4876C5.28099 7.28926 5.2562 7.1157 5.23141 6.94215L10.1653 4.53719C10.6364 4.98347 11.2562 5.2562 11.9504 5.2562C13.4132 5.2562 14.5785 4.06612 14.5785 2.6281C14.5785 1.16529 13.3884 0 11.9504 0C10.4876 0 9.32232 1.19008 9.32232 2.6281C9.32232 2.77686 9.32231 2.90083 9.34711 3.04959L4.31405 5.47934C3.86777 5.08264 3.27273 4.8595 2.6281 4.8595C1.16529 4.8595 0 6.04959 0 7.4876C0 8.92562 1.19008 10.1157 2.6281 10.1157C3.27273 10.1157 3.86777 9.89256 4.31405 9.49587L9.34711 11.9504C9.32231 12.0744 9.32232 12.2231 9.32232 12.3719C9.32232 13.8347 10.5124 15 11.9504 15C13.4132 15 14.5785 13.8099 14.5785 12.3719C14.5785 10.9091 13.4132 9.71901 11.9504 9.71901Z"
                                fill="#00699E" />
                        </svg>
                    </div>

                    <!-- Popup menu for sharing options -->
                    <div id="shareMenu<?php echo $v->article_id; ?>" class="share-popup" style="width: 50%;">
                        <ul>
                            <li onclick="copyLink('<?php echo 'https:\/\/rgestate.com/'.$this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>')">
                                <i class="fa fa-link"></i>&nbsp;
                                Copy Link
                            </li>
                            <li>
                                <i class="fa fa-facebook"></i>&nbsp;
                                <a href="https://www.facebook.com/share.php?u=<?php echo 'https://rgestate.com/'.$this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" target="_blank">Facebook</a>
                            </li>
                            <li>
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>&nbsp;
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo 'https://rgestate.com/'.$this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" target="_blank">
                                    Share on LinkedIn
                                </a>
                            </li>
                            <li>
                                <i class="fa fa-twitter-square" aria-hidden="true"></i>&nbsp;
                                <a href="https://twitter.com/intent/tweet?url=<?php echo 'https://rgestate.com/'.$this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" target="_blank">
                                    Share on Twitter
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h5 class="card-title custom-text-blue" style="">
                <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>"
                    class="_xvt7x" aria-busy="false"><?php echo CHtml::encode($v->title); ?></a>
            </h5>
            <hr>
                <p class="card-description"><?php echo CHtml::encode(strlen($excerpt) > 120 ? substr($excerpt, 0, 120) . '...' : $excerpt); ?></p>
            <div style="justify-content: space-between;"
                class="d-flex justify-content-between align-items-center mt-auto card-footer">
                <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>"
                    class="custom-text-blue text-decoration-none">Read more <svg width="14" height="11"
                        viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.9892 5.14489L12.9886 5.14527C13.0539 5.25536 13.097 5.36646 13.0999 5.4872C13.1027 5.60869 13.0645 5.72814 12.9882 5.85465L12.9822 5.86455L12.9817 5.86415L9.87072 9.89117L9.87057 9.89136C9.68898 10.1252 9.33072 10.1795 9.09608 9.96713L9.09606 9.96711C8.98529 9.8668 8.92435 9.72234 8.91135 9.5785C8.89836 9.43465 8.9324 9.28116 9.02508 9.16186C9.02511 9.16182 9.02514 9.16178 9.02517 9.16174L11.4075 6.07337H1.4444C1.1379 6.07337 0.9 5.81051 0.9 5.49964C0.9 5.18899 1.13769 4.92591 1.4444 4.92591H11.4075L9.02514 1.8375C9.02511 1.83746 9.02508 1.83742 9.02505 1.83738C8.93257 1.71821 8.898 1.56428 8.91069 1.42013C8.92339 1.27599 8.98433 1.13085 9.09698 1.03134L12.9892 5.14489ZM12.9892 5.14489L12.9817 5.13513M12.9892 5.14489L12.9817 5.13513M12.9817 5.13513L9.87072 1.10811L9.87075 1.10809M12.9817 5.13513L9.87075 1.10809M9.87075 1.10809L9.86922 1.10622M9.87075 1.10809L9.86922 1.10622M9.86922 1.10622C9.66856 0.859064 9.32041 0.833985 9.09698 1.03134L9.86922 1.10622Z"
                            fill="#00699E" stroke="white" stroke-width="0.2" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>

<style>
    /* Popup style */
.share-popup {
    display: none;
    position: absolute;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 10px;
    border-radius: 8px;
    z-index: 1000;
}

.share-popup ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.share-popup ul li {
    margin: 8px 0;
    cursor: pointer;
}

.share-popup ul li a {
    text-decoration: none;
    color: #00699E;
}

.share-popup ul li:hover {
    font-weight: bold;
}

.card {
    width: 21rem;
}

.card-header {
    margin: 10px 0;
}

.card-header div>span {
    padding: 5px 15px;
    margin-right: 21px;
    border-radius: 10px
}

.card-title {
    font-size: 1.25rem; /* Adjust as needed */
    line-height: 1.4; /* Adjust the line height */
    height: 5.2rem; /* Fixed height for 3 lines, adjust accordingly */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Number of lines you want */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal; /* Allows multiple lines before truncating */
    word-wrap: break-word; /* Ensures words wrap correctly */
}
hr {
    border-color: #e2e2e2;
    margin-top: 20px;
    margin-bottom: 20px;
}
.card-description {
    font-size: 1rem; /* Adjust as needed */
    line-height: 1.5; /* Adjust the line height */
    height: 4.5rem; /* Fixed height for description */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Number of lines you want */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    word-wrap: break-word;
}

.card-text {
    font-family: Inter;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    text-align: left;
    margin-bottom: 40px;
}
.card-img {
    width: 100%;
    height: 200px; /* Adjust the height as per your design */
    position: relative;
    overflow: hidden; /* Ensure the image doesn't overflow */
}

.card-img img {
    width: 100%;
    height: 200px;
    object-fit: cover; /* Ensures the image fits the container without stretching */
    object-position: center; /* Aligns the image properly within the container */
    display: block; /* Remove any inline space or gap from the image */
}

/* Custom Styles */
.custom-rounded-img {
    border-radius: 14px;
}

.custom-shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.custom-bg-blue {
    background-color: #00699E;
    /* Blue */
}

.custom-text-blue {
    color: #00699E;
}

.custom-text-gray {
    color: #656865;
}

.custom-text-light-gray {
    color: #A3ABA3;
}

@media (max-width: 768px) {
    .card-header {
        flex-direction: row !important;
        align-items: center;
    }

    .card-header div {
        flex-direction: row;
        align-items: center;
    }

    .card-header div>span {
        margin-right: 10px;
    }

    .card-footer a {
        display: block;
    }

    .card-footer {
        flex-direction: row !important;
        align-items: center;
    }
}

@media (max-width: 640px) {
    .card {
        width: 100%;
    }
}
</style>
<script>
    // Function to toggle the share menu visibility
function toggleShareMenu(id) {
    var shareMenu = document.getElementById("shareMenu"+id);
    if (shareMenu.style.display === "block") {
        shareMenu.style.display = "none";
    } else {
        shareMenu.style.display = "block";
    }
}

// Function to copy the link
function copyLink(url) {
    const tempInput = document.createElement('input');
    document.body.appendChild(tempInput);
    tempInput.value = url;
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    alert('Link copied to clipboard!');
}

</script>