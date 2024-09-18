<!-- Hero Section -->
<style>
.blog-hero h1,
.blog-hero p {
    font-family: 'Roboto', 'Open Sans', sans-serif;
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
</style>

<!-- hero section  -->
<section class="blog-hero">
    <div class="container mx-auto">
        <div class="position-relative text-white d-flex align-items-center justify-content-center bg-cover custom-rounded"
            style="height: 416px; background-image: url(<?php echo $this->app->apps->getBaseUrl('assets/img/blog/hero.jpeg'); ?>); background-position: center;">
            <div style="background-color: rgba(0, 0, 0, 0.5); width:100%; height:100%;"
                class="position-absolute w-100 h-100 custom-rounded"></div>
            <div class="position-absolute text-white z-10 text-left"
                style="left: 1rem; left: 4rem; /* Adjust left padding */">
                <!-- Dynamic content from Yii -->
                <h1 class="display-4 text-white font-weight-bold">
                    <?php echo $this->project_name; ?> <?php echo $this->tag->getTag('blog', 'Blog'); ?>
                </h1>
                <p class="lead mt-4 text-white">
                    Find the latest real estate news and market trend insights from around UAE, as well as access the
                    latest updates and media releases from <?php echo $this->project_name; ?>.
                </p>
                <nav class="mt-4 small">
                    <a href="#" class="text-white text-decoration-none hover-underline">Home</a>
                    <span class="mx-2">&gt;&gt;</span>
                    <a href="#" class="text-warning text-decoration-none hover-underline">Blog</a> &gt;
                </nav>
            </div>
        </div>
    </div>
</section>



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
</style>
<section class="category-section">
    <div class="container">
        <div class="bg-white">
            <div style="justify-content: space-between;"
                class="category-menu pb-2 d-flex justify-content-between w-100 border-bottom border-secondary">
                <ul style="margin: 0;" class="mb-0 d-flex align-items-center list-unstyled">
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

                <div class="d-flex align-items-center sub-container category-search" style="flex-wrap: nowrap">
                    <div class="custom-rotate-divider"></div>
                    <input type="text" class="border-0 form-control " placeholder="Enter the Keywords here" />
                    <div class="search-icon-wrapper">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- main content  -->
<div class="expertSection">
    <img src="./img/expert.png" class="w-100" style="object-fit: cover;" alt="">
    <div class="container dtlText">
        <h3 class="text-primary mtb50">“Touch Design For Mobile Interfaces” A News Smashing BookCreate An
            Information Wayaea Architecture Easy
        </h3>
        <p class="dtlParagrap">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
            doloremque laudantium, totam
            rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
            explicabo. Nemo enim epsam voluptatem quia voluptas sit aspernatur aut odit aut fugiconse quuntur
            magni
            dolores qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit
            voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim epsam voluptatem quia
            voluptas sit aspernatur aut odit aut fugiconse quuntur magni dolores qui ratione voluptatem sequi
            nesciunt.</p>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="d-flex align-items-center">
                    <span class="dtlIcon m-2"><i class="fa-solid fa-check"></i></span>
                    <span>Best Business Agency</span>
                </div>
            </div>
        </div>

        <p class="dtlParagrap">Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae abillo
            inventore veritatis et quasi
            architecto beatae vitae dicta sunt explicabo. Nemo enim epsam voluptatem quia voluptas sit
            aspernature
        </p>
        <div class="d-flex flex-column flex-lg-row justify-content-between">

            <div class="d-flex flex-wrap flex-md-row gap-1 align-items-start align-items-md-center mb-2 mb-md-0">
                <h4 class="mb-1">Tags:</h4>
                <span class="border border-bordersec text-fontColor px-2">Business</span>
                <span class="border border-bordersec text-fontColor px-2">Consulting</span>
                <span class="border border-bordersec text-fontColor px-2">Management</span>
            </div>


            <div class="d-flex gap-2 my-5">
                <span class="h-5 textPrimary fw-bolder">Posted In</span>
                <span class="text-white postsIn px-2 py-1 rounded">Business Relator Work</span>
                <span class="text-white postsIn px-2 py-1 rounded">Investment Work</span>
            </div>
        </div>

        <div class="d-flex gap-2 mb-4">
            <span>Share This:</span>
            <a href="#" class="btn icon-button rounded-circle p-2">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn icon-button rounded-circle p-2">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn icon-button rounded-circle p-2">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="btn icon-button rounded-circle p-2">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <div class="d-flex gap-3 revies">
            <img class="manImage" src="./img/images 3.png" alt="">
            <div class="d-flex flex-column gap-1">
                <h5>Bradley R Grady</h5>
                <p>Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae abillo inventore
                    veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim epsam voluptatem
                    quia voluptas sit aspernature</p>
                <div class="d-flex flex-column flex-md-row align-items-md-center">
                    <button class="customPost">Read all Post</button>
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <a href="#" class="btn readIcon rounded-circle p-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn readIcon rounded-circle p-2">
                            <i class="fab redIcon fa-twitter"></i>
                        </a>
                        <a href="#" class="btn readIcon rounded-circle p-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn readIcon rounded-circle p-2">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>


            </div>
        </div>
        <hr class="my-4 mx-auto custom-hr">
        <div class="container mt-5">

            <div class="row row-cols-1 row-cols-md-2 g-4">

                <div class="col">
                    <div class="d-flex align-items-start">
                        <img src="./img/istockphoto-1373247868-612x612 1.png" alt="" class="me-3">
                        <div>
                            <h6>Former insures only the marine perils</h6>
                            <span class="text-muted fs-6 d-flex align-items-center">
                                <i class="fa-solid fa-calendar-days me-2"></i>
                                Jan 3, 2024
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex flex-row-reverse align-items-start">
                        <img src="./img/istockphoto-1373247868-612x612 1.png" alt="" class="me-3">
                        <div>
                            <h6>Former insures only the marine perils</h6>
                            <span class="text-muted fs-6 d-flex align-items-center">
                                <i class="fa-solid fa-calendar-days me-2"></i>
                                Jan 3, 2024
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="extraMargin background-image">
    <div class="row">

        <div class="col-12 col-md-6 col-lg-5 d-none getTouch d-lg-block">
            <h2>GET IN TOUCH</h2>
            <h1>Need Any Help? Or Looking For an Agent</h1>
            <p>
                Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                quia voluptas sit aspernatur.
            </p>
            <div class="d-flex gap-2 social-icons">
                <a href="#" class="socalForm btn rounded-circle p-2">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="socalForm btn rounded-circle p-2">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="socalForm btn rounded-circle p-2">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="socalForm btn rounded-circle p-2">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>


        <div class="col-12 col-lg-6 col-lg-7 form-section">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="position-relative">
                            <i class="formIcon fa-regular fa-user"></i>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="position-relative">
                            <i class="formIcon fa-regular fa-envelope"></i>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="position-relative">
                            <i class="formIcon fa-solid fa-phone"></i>
                            <input type="tel" class="form-control" id="contact1"
                                placeholder="Enter your contact number">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="position-relative">
                            <i class="formIcon fa-solid fa-phone-flip"></i>
                            <input type="tel" class="form-control" id="contact2" placeholder="Select your service">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <textarea class="form-control" id="message" rows="3" style="height: 250px;"
                            placeholder="Enter your message"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn bg-Color text-white">SEND INQUIRY</button>
            </form>
        </div>

    </div>
</div>