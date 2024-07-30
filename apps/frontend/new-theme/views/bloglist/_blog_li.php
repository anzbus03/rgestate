<?php
$timthumb = Yii::app()->apps->getBaseUrl('timthumb.php');
$read_more = 'Read more';
$last_updated_on = 'Last updated on';
$language = 'en';  // Fixed typo in variable name
$commonModel = new OptionCommon();
?>
<div class="container">
    <div class="row">
        <!-- Blog Posts Section -->
        <div class="col-md-8">
            <div class="row">
                <?php foreach ($ads as $k => $v): ?>
                    <?php
                    if (!empty($v->featured_image) && !is_null($v->featured_image)){
                        $featuredImageUrl = Yii::app()->baseUrl . '/uploads/images/' . $v->featured_image;
                    } else {
                        preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $featuredImageUrl);
                    }
                    ?>
                    <div class="col-md-6 mb-4 d-flex">
                        <div class="card w-100">
                            <div class="card-content d-flex flex-column">
                                <div class="blog-img">
                                    <img class="lozad card-img-top" style="object-fit: cover;" alt="<?php echo $v->title; ?>" decoding="async" src="<?php echo is_array($featuredImageUrl) ? @$featuredImageUrl['1'] : $featuredImageUrl; ?>">
                                    <div class="overlay">
                                        <button class="preview-button" onclick="showPreview('<?php echo is_array($featuredImageUrl) ? @$featuredImageUrl['1'] : $featuredImageUrl; ?>')">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <a href="<?php echo $this->app->createUrl('bloglist/details', array('slug' => $v->slug)); ?>" class="blog-link">
                                            <i class="fa fa-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="blog-text">
                                    <?php echo $v->title; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

        <!-- Form Section -->
        <div class="col-md-4">
            <h4 class="text-center">Subscribe To Our Free Newsletter</h4>
            <div class="form-container">
                <script data-b24-form="inline/34/btf76q" data-skip-moving="true">
                    (function(w,d,u){
                    var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
                    var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
                    })(window,document,'https://cdn.bitrix24.in/b25292121/crm/form/loader_34.js');
                </script>
            </div>
        </div>
    </div>
</div>


<style>
.card {
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 350px; /* Set a fixed height for the card */
}

.card-content {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 75%;
}

.blog-img {
    position: relative;
    padding: 10px;
    flex: 1; /* Allow the image section to grow */
}

.blog-img img {
    display: block;
    width: 100%;
    height: auto;
}


.overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.card:hover .overlay {
    opacity: 1;
}

.preview-button, .blog-link {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    margin: 0 10px;
}

.blog-text {
    padding: 15px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin-top: auto;
    /* overflow: hidden; */
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit to 2 lines */
    -webkit-box-orient: vertical;
    height: 50px; /* Set a fixed height for the text section */
}

</style>

<script>
function showPreview(imageSrc) {
    var modal = document.getElementById("previewModal");
    var modalImg = document.getElementById("modalImage");
    var span = document.getElementsByClassName("close")[0];

    $(modal).modal("show");
    modalImg.src = imageSrc;
    span.onclick = function() {
        $(modal).modal("hide");
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            $(modal).modal("hide");
        }
    }
}
</script>

<div class="modal modal-new fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content position-relative rounded-0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="modal-content" id="modalImage">
            </div>
        </div>
    </div>
</div>
