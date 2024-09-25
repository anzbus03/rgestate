<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- PAGE TITLE HERE -->
    <title><?php echo ucfirst($this->getUniqueId());?>&nbsp;| <?php echo   Yii::app()->options->get('system.common.site_name');?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

  
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/images/favicon.png') ?>">

    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/nouislider/nouislider.min.css');?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/jquery-nice-select/css/nice-select.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/css/style.css');?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/datatables/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/lib/slick/slick.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/swiper/css/swiper-bundle.min.css');?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/js/build/css/intlTelInput.min.css" />
    <?php
    if($this->id=='place_property' or $this->id=='listingusers'){ ?> 
    <script>  function iniFrame() { if(window.self !== window.top) {   $('html').addClass("isOnFram");   }  }  iniFrame();</script>
    <style>html.isOnFram ul.breadcrumb {display:none; } html.isOnFram .closepopu {display:block !important; position: fixed;top: 0px;z-index: 1;right: 0;display: block;background: #fafafa;padding: 5px;text-align: center;} html.isOnFram aside.left-side,html.isOnFram header{display:none}html.isOnFram aside.right-side{width:100%;margin-left:0}html.isOnFram textarea.form-control{height:400px}html.isOnFram .col-sm-5{width:41.66666667%;float:left}html.isOnFram .col-sm-7{width:58.33333333%;float:left}html.isOnFram .box-header{display:none}html.isOnFram .box-footer{border:0;padding-top:0;position:fixed;z-index:11111;bottom:0;width:100%;left:0;padding:10px!important;background:#eee}html.isOnFram .col-sm-2{width:16.66666667%;float:left}html.isOnFram .col-lg-9{width:75%;float:left}html.isOnFram .col-lg-3{width:25%;float:left}html.isOnFram .col-sm-6{width:50%;float:left}html.isOnFram .box-danger .col-sm-2{width:25%;float:left}html.isOnFram .col-sm-3{width:25%;float:left} </style>
	<?php } ?>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">L</span>
            <span style="--i:2">o</span>
            <span style="--i:3">a</span>
            <span style="--i:4">d</span>
            <span style="--i:5">i</span>
            <span style="--i:6">n</span>
            <span style="--i:7">g</span>
            <span style="--i:8">.</span>
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="<?php echo $this->createUrl('dashboard/index');?>" class="brand-logo">
            <svg width="130" height="32" viewBox="0 0 130 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_93_518)">
                    <path d="M16.8799 23.1141L12.0783 15.9696L7.00835 15.9997L7.09782 23.024L2.83308 23.1141L2.74361 15.9096L0.119156 15.9997L0.029686 11.9771L2.83308 11.8871L2.74361 0.509978L13.6291 0.419922C18.5798 0.419922 21.8902 3.54187 21.8902 8.2248C21.8902 11.3768 19.7727 14.0785 16.522 15.0691L22.3376 23.1141H16.8799ZM7.09782 11.9771L13.3011 11.8871C16.4027 11.8871 17.5062 9.99591 17.5062 8.19478C17.5062 6.42367 16.4027 4.50247 13.3011 4.50247H7.09782V11.9771Z" fill="#00699E"/>
                    <path d="M34.774 23.4444C28.0936 23.4444 22.8745 18.4312 22.8745 12.0072C22.8745 5.58319 28.0936 0.540039 34.774 0.540039C38.5318 0.540039 41.9018 2.16105 44.228 5.07287L40.858 7.6845C39.337 5.64323 37.2195 4.53253 34.774 4.53253C30.7479 4.53253 27.3182 7.95467 27.3182 12.0072C27.3182 16.0597 30.7181 19.4819 34.774 19.4819C38.4721 19.4819 41.3053 17.2305 42.1702 13.6282L34.7442 13.7183L34.6547 9.81584L46.5841 9.72578L46.6735 12.6976C46.6437 16.42 43.1544 23.4444 34.774 23.4444Z" fill="#00699E"/>
                    <path d="M77.8091 0.330078H81.9844V6.51394H84.4597V10.1462H82.0142V23.2944H77.839V10.1162H75.6917V6.51394H77.839V0.330078H77.8091Z" fill="#231F20"/>
                    <path d="M105.783 0.330078H109.959V6.51394H112.434V10.1462H109.959V23.2944H105.783V10.1162H103.636V6.51394H105.783V0.330078Z" fill="#231F20"/>
                    <path d="M125.914 17.2609C125.049 19.002 123.26 20.2028 121.172 20.2028C118.637 20.2028 116.52 18.4017 116.013 16.0002H121.321H126.362H129.94C130 15.6399 130.03 15.2497 130.03 14.8895C130.03 9.9964 126.093 6.00391 121.202 6.00391C116.341 6.00391 112.374 9.96638 112.374 14.8895C112.374 19.8125 116.311 23.775 121.202 23.775C125.258 23.775 128.658 21.0133 129.702 17.2609H125.914ZM121.172 9.57614C123.349 9.57614 125.198 10.897 126.033 12.7881H116.341C117.146 10.897 119.025 9.57614 121.172 9.57614Z" fill="#231F20"/>
                    <path d="M48.8208 0.600586H61.108V4.83323H53.0557V8.9458H61.108V13.0884H53.0557V19.0621H61.108V23.2948H48.8208V0.600586Z" fill="#231F20"/>
                    <path d="M74.29 8.85573L71.6953 11.4674C70.6515 10.4167 69.6972 9.90639 68.8323 9.90639C68.3551 9.90639 67.9973 9.99644 67.7288 10.2066C67.4604 10.4167 67.3411 10.6569 67.3411 10.957C67.3411 11.1972 67.4306 11.3773 67.5797 11.5874C67.7587 11.7676 68.1762 12.0377 68.8323 12.3679L70.3533 13.1484C71.9638 13.9589 73.0672 14.7694 73.6637 15.61C74.2602 16.4505 74.5584 17.4111 74.5584 18.5518C74.5584 20.0527 74.0216 21.2835 72.9181 22.2741C71.8445 23.2647 70.3831 23.7751 68.5341 23.7751C66.0886 23.7751 64.15 22.8145 62.7185 20.8933L65.2833 18.0715C65.7605 18.6418 66.357 19.1221 67.0131 19.4524C67.6692 19.8126 68.2657 19.9927 68.7727 19.9927C69.3095 19.9927 69.7568 19.8726 70.1147 19.6024C70.4428 19.3323 70.6217 19.0321 70.6217 18.6719C70.6217 18.0115 70.0252 17.3811 68.8025 16.7807L67.4008 16.0602C64.7167 14.6794 63.3448 12.9683 63.3448 10.927C63.3448 9.6062 63.8518 8.46549 64.8658 7.53491C65.8798 6.60432 67.192 6.12402 68.7727 6.12402C69.8463 6.12402 70.8603 6.36417 71.8146 6.84447C72.8286 7.26474 73.6339 7.95517 74.29 8.85573Z" fill="#231F20"/>
                    <path d="M98.4469 6.48348H102.682V23.264H98.4469V21.4929C97.6118 22.2734 96.8066 22.8437 95.9715 23.1739C95.1365 23.5041 94.2418 23.6842 93.2576 23.6842C91.0805 23.6842 89.2016 22.8437 87.621 21.1627C86.0404 19.4816 85.2351 17.3803 85.2351 14.8887C85.2351 12.3071 86.0105 10.1758 87.5315 8.52476C89.0824 6.87373 90.9314 6.0332 93.1383 6.0332C94.1523 6.0332 95.1067 6.21332 95.9715 6.60356C96.8662 6.9938 97.6715 7.56416 98.4171 8.31463V6.48348H98.4469ZM94.0032 9.93564C92.691 9.93564 91.6173 10.3859 90.7525 11.3165C89.8876 12.2471 89.4701 13.4178 89.4701 14.8587C89.4701 16.2996 89.9174 17.5004 90.7823 18.431C91.677 19.3615 92.7506 19.8418 94.033 19.8418C95.3751 19.8418 96.4487 19.3916 97.3434 18.461C98.2083 17.5304 98.6556 16.3296 98.6556 14.8287C98.6556 13.3578 98.2083 12.187 97.3434 11.2865C96.4487 10.3859 95.3154 9.93564 94.0032 9.93564Z" fill="#231F20"/>
                    <path d="M3.28057 30.3786V25.3955H4.05598C4.50333 25.3955 4.83139 25.4255 5.04015 25.4856C5.33838 25.5756 5.57697 25.7257 5.75591 25.9358C5.93485 26.146 6.02432 26.4161 6.02432 26.6863C6.02432 26.8664 5.9945 27.0465 5.90503 27.1966C5.81556 27.3467 5.69626 27.4968 5.51732 27.6469C5.81556 27.797 6.02432 27.9771 6.17344 28.1873C6.32255 28.3974 6.3822 28.6676 6.3822 28.9377C6.3822 29.2079 6.32255 29.4781 6.17344 29.7182C6.02432 29.9584 5.84538 30.1085 5.60679 30.2285C5.36821 30.3486 5.06997 30.4086 4.65245 30.4086H3.28057V30.3786ZM4.23492 26.2961V27.3467H4.44368C4.68227 27.3467 4.83139 27.2867 4.95068 27.1966C5.06997 27.1066 5.12962 26.9565 5.12962 26.8064C5.12962 26.6563 5.06997 26.5362 4.9805 26.4462C4.86121 26.3561 4.71209 26.2961 4.50333 26.2961H4.23492ZM4.23492 28.1873V29.4781H4.47351C4.86121 29.4781 5.12962 29.418 5.27874 29.328C5.42785 29.2379 5.4875 29.0878 5.4875 28.9077C5.4875 28.6976 5.39803 28.5175 5.24891 28.3974C5.0998 28.2773 4.83139 28.2173 4.44368 28.2173H4.23492V28.1873Z" fill="#231F20"/>
                    <path d="M8.79789 26.6865H9.75224L10.7066 28.998L11.7504 26.6865H12.7047L10.4084 31.7297H9.454L10.1996 30.1087L8.79789 26.6865Z" fill="#231F20"/>
                    <path d="M19.3554 25.3955H20.3395C20.8764 25.3955 21.2641 25.4555 21.5026 25.5456C21.7412 25.6357 21.9202 25.8158 22.0693 26.0259C22.2184 26.2661 22.278 26.5362 22.278 26.8364C22.278 27.1666 22.1886 27.4368 22.0395 27.6469C21.8903 27.857 21.6518 28.0372 21.3237 28.1572L22.4868 30.3786H21.443L20.3395 28.2773H20.2799V30.3786H19.3255V25.3955H19.3554ZM20.2799 27.3467H20.5781C20.8764 27.3467 21.0851 27.3167 21.2044 27.2267C21.3237 27.1366 21.3833 27.0165 21.3833 26.8364C21.3833 26.7163 21.3535 26.6263 21.2939 26.5662C21.2342 26.4762 21.1746 26.4161 21.0553 26.3861C20.9658 26.3561 20.7869 26.3261 20.5483 26.3261H20.2799V27.3467Z" fill="#231F20"/>
                    <path d="M25.5586 25.1855C25.7077 25.1855 25.8568 25.2456 25.9761 25.3657C26.0954 25.4857 26.1551 25.6358 26.1551 25.7859C26.1551 25.936 26.0954 26.0861 25.9761 26.2062C25.8568 26.3263 25.7376 26.3863 25.5586 26.3863C25.4095 26.3863 25.2604 26.3263 25.1411 26.2062C25.0218 26.0861 24.9621 25.936 24.9621 25.7859C24.9621 25.6358 25.0218 25.4857 25.1411 25.3657C25.2604 25.2456 25.4095 25.1855 25.5586 25.1855ZM25.1113 26.6865H26.0358V30.3788H25.1113V26.6865Z" fill="#231F20"/>
                    <path d="M28.4813 26.6865H29.4058L30.3304 28.8479L31.2549 26.6865H32.1794L30.6286 30.3788H30.0321L28.4813 26.6865Z" fill="#231F20"/>
                    <path d="M38.4423 28.8181H35.4898C35.5196 29.0882 35.6389 29.2984 35.8179 29.4485C35.9968 29.5986 36.2354 29.6886 36.5336 29.6886C36.8915 29.6886 37.1599 29.5685 37.4283 29.3284L38.2037 29.6886C38.0248 29.9588 37.7862 30.1689 37.5178 30.289C37.2494 30.4091 36.9213 30.4991 36.5634 30.4991C35.9968 30.4991 35.5196 30.319 35.1617 29.9588C34.8039 29.5986 34.6249 29.1483 34.6249 28.5779C34.6249 28.0076 34.8039 27.5573 35.1617 27.167C35.5196 26.8068 35.967 26.5967 36.5038 26.5967C37.0704 26.5967 37.5476 26.7768 37.9055 27.167C38.2634 27.5273 38.4423 28.0376 38.4423 28.638V28.8181ZM37.5178 28.0676C37.4581 27.8575 37.3388 27.7074 37.1599 27.5573C36.981 27.4372 36.7722 27.3772 36.5336 27.3772C36.2652 27.3772 36.0564 27.4372 35.8477 27.5873C35.7284 27.6774 35.6091 27.8274 35.5196 28.0676H37.5178Z" fill="#231F20"/>
                    <path d="M40.9773 26.6865H41.7527V27.1368C41.8422 26.9567 41.9615 26.8066 42.0808 26.7165C42.2299 26.6264 42.379 26.5664 42.5579 26.5664C42.6772 26.5664 42.7965 26.5964 42.9456 26.6565L42.6474 27.467C42.5281 27.4069 42.4386 27.3769 42.379 27.3769C42.2299 27.3769 42.1106 27.467 42.0211 27.6471C41.9316 27.8272 41.872 28.1574 41.872 28.6977V28.8779V30.3788H40.9475V26.6865H40.9773Z" fill="#231F20"/>
                    <path d="M45.7789 25.1855C45.928 25.1855 46.0771 25.2456 46.1964 25.3657C46.3157 25.4857 46.3753 25.6358 46.3753 25.7859C46.3753 25.936 46.3157 26.0861 46.1964 26.2062C46.0771 26.3263 45.9578 26.3863 45.7789 26.3863C45.6297 26.3863 45.4806 26.3263 45.3613 26.2062C45.242 26.0861 45.1824 25.936 45.1824 25.7859C45.1824 25.6358 45.242 25.4857 45.3613 25.3657C45.4806 25.2456 45.6297 25.1855 45.7789 25.1855ZM45.3315 26.6865H46.256V30.3788H45.3315V26.6865Z" fill="#231F20"/>
                    <path d="M51.8032 26.6867H52.7277V30.379H51.8032V29.9888C51.6242 30.1689 51.4453 30.289 51.2664 30.349C51.0874 30.4391 50.8786 30.4691 50.6699 30.4691C50.1927 30.4691 49.7752 30.289 49.4471 29.9288C49.0892 29.5685 48.9401 29.0882 48.9401 28.5479C48.9401 27.9775 49.1191 27.4972 49.4471 27.137C49.7752 26.7768 50.1927 26.5967 50.6699 26.5967C50.8786 26.5967 51.0874 26.6267 51.2962 26.7168C51.4751 26.8068 51.6541 26.9269 51.833 27.107V26.6867H51.8032ZM50.819 27.4672C50.5208 27.4672 50.312 27.5573 50.1032 27.7674C49.9243 27.9775 49.8348 28.2177 49.8348 28.5479C49.8348 28.8781 49.9243 29.1183 50.1331 29.3284C50.312 29.5385 50.5506 29.6286 50.8488 29.6286C51.1471 29.6286 51.3856 29.5385 51.5646 29.3284C51.7435 29.1183 51.8628 28.8481 51.8628 28.5479C51.8628 28.2177 51.7733 27.9775 51.5646 27.7674C51.3558 27.5573 51.1172 27.4672 50.819 27.4672Z" fill="#231F20"/>
                    <path d="M64.2992 26.206L63.643 26.8664C63.2255 26.4161 62.7185 26.206 62.1817 26.206C61.7045 26.206 61.287 26.3561 60.9589 26.6863C60.6309 27.0165 60.4519 27.4067 60.4519 27.887C60.4519 28.3673 60.6309 28.7876 60.9589 29.1178C61.287 29.448 61.7343 29.6281 62.2115 29.6281C62.5396 29.6281 62.808 29.5681 63.0466 29.418C63.2553 29.2679 63.4641 29.0578 63.5834 28.7576H62.1519V27.857H64.657V28.0671C64.657 28.5174 64.5377 28.9077 64.329 29.2979C64.1202 29.6881 63.822 29.9883 63.4641 30.1985C63.1062 30.4086 62.6887 30.4987 62.2115 30.4987C61.7045 30.4987 61.2273 30.3786 60.8396 30.1684C60.4221 29.9583 60.1239 29.6281 59.8853 29.2078C59.6467 28.7876 59.5274 28.3373 59.5274 27.857C59.5274 27.1966 59.7362 26.6262 60.1835 26.1459C60.6905 25.5756 61.3765 25.2754 62.1817 25.2754C62.5992 25.2754 63.0168 25.3654 63.4045 25.5155C63.6729 25.6356 64.0009 25.8758 64.2992 26.206Z" fill="#231F20"/>
                    <path d="M67.3411 25.2754H68.2657V30.3786H67.3411V25.2754Z" fill="#231F20"/>
                    <path d="M72.8286 26.5967C73.1865 26.5967 73.4847 26.6867 73.8128 26.8668C74.111 27.047 74.3496 27.2871 74.5286 27.5873C74.7075 27.8875 74.797 28.2177 74.797 28.5479C74.797 28.9081 74.7075 29.2083 74.5286 29.5385C74.3496 29.8387 74.111 30.0789 73.8128 30.259C73.5146 30.4391 73.1865 30.5291 72.8286 30.5291C72.2918 30.5291 71.8445 30.349 71.4866 29.9588C71.1287 29.5685 70.9199 29.1183 70.9199 28.5779C70.9199 28.0076 71.1287 27.5273 71.5462 27.137C71.9339 26.7768 72.3515 26.5967 72.8286 26.5967ZM72.8286 27.4672C72.5304 27.4672 72.2918 27.5573 72.1129 27.7674C71.9339 27.9775 71.8146 28.2177 71.8146 28.5479C71.8146 28.8781 71.9041 29.1183 72.083 29.3284C72.262 29.5385 72.5006 29.6286 72.7988 29.6286C73.097 29.6286 73.3356 29.5385 73.5146 29.3284C73.6935 29.1183 73.8128 28.8781 73.8128 28.5479C73.8128 28.2177 73.7233 27.9775 73.5444 27.7674C73.3655 27.5573 73.1269 27.4672 72.8286 27.4672Z" fill="#231F20"/>
                    <path d="M78.4652 25.2754V27.1065C78.6442 26.9264 78.8231 26.8063 79.0021 26.7163C79.181 26.6262 79.3898 26.5962 79.6284 26.5962C80.1055 26.5962 80.5231 26.7763 80.8511 27.1366C81.1792 27.4968 81.3581 27.9771 81.3581 28.5474C81.3581 29.0878 81.1792 29.5681 80.8511 29.9283C80.4932 30.2885 80.1055 30.4686 79.6284 30.4686C79.4196 30.4686 79.2108 30.4386 79.0319 30.3486C78.8529 30.2585 78.674 30.1384 78.4951 29.9883V30.3786H77.5407V25.2754H78.4652ZM79.4196 27.4668C79.1214 27.4668 78.8828 27.5568 78.7038 27.7669C78.5249 27.9771 78.4056 28.2172 78.4056 28.5474C78.4056 28.8776 78.4951 29.1478 78.7038 29.3279C78.8828 29.5381 79.1214 29.6281 79.4196 29.6281C79.688 29.6281 79.9266 29.5381 80.1354 29.3279C80.3143 29.1178 80.4336 28.8476 80.4336 28.5474C80.4336 28.2172 80.3441 27.9771 80.1652 27.7669C79.9564 27.5568 79.7178 27.4668 79.4196 27.4668Z" fill="#231F20"/>
                    <path d="M86.8158 26.6867H87.7403V30.379H86.8158V29.9888C86.6368 30.1689 86.4579 30.289 86.279 30.349C86.1 30.4391 85.8913 30.4691 85.6825 30.4691C85.2053 30.4691 84.7878 30.289 84.4597 29.9288C84.1019 29.5685 83.9527 29.0882 83.9527 28.5479C83.9527 27.9775 84.1317 27.4972 84.4597 27.137C84.7878 26.7768 85.2053 26.5967 85.6825 26.5967C85.8913 26.5967 86.1 26.6267 86.3088 26.7168C86.4877 26.8068 86.6667 26.9269 86.8456 27.107V26.6867H86.8158ZM85.8614 27.4672C85.5632 27.4672 85.3544 27.5573 85.1457 27.7674C84.9667 27.9775 84.8773 28.2177 84.8773 28.5479C84.8773 28.8781 84.9667 29.1183 85.1755 29.3284C85.3544 29.5385 85.593 29.6286 85.8913 29.6286C86.1895 29.6286 86.4281 29.5385 86.607 29.3284C86.786 29.1183 86.9053 28.8481 86.9053 28.5479C86.9053 28.2177 86.8158 27.9775 86.607 27.7674C86.3684 27.5573 86.1298 27.4672 85.8614 27.4672Z" fill="#231F20"/>
                    <path d="M90.5735 25.2754H91.498V30.3786H90.5735V25.2754Z" fill="#231F20"/>
                    <path d="M102.98 26.206L102.324 26.8664C101.906 26.4161 101.399 26.206 100.863 26.206C100.385 26.206 99.9679 26.3561 99.6398 26.6863C99.3118 27.0165 99.1328 27.4067 99.1328 27.887C99.1328 28.3673 99.3118 28.7876 99.6398 29.1178C99.9679 29.448 100.415 29.6281 100.892 29.6281C101.22 29.6281 101.489 29.5681 101.727 29.418C101.936 29.2679 102.145 29.0578 102.264 28.7576H100.833V27.857H103.338V28.0671C103.338 28.5174 103.219 28.9077 103.01 29.2979C102.801 29.6881 102.503 29.9883 102.145 30.1985C101.787 30.4086 101.37 30.4987 100.892 30.4987C100.385 30.4987 99.9083 30.3786 99.5205 30.1684C99.103 29.9583 98.8048 29.6281 98.5662 29.2078C98.3276 28.7876 98.2083 28.3373 98.2083 27.857C98.2083 27.1966 98.4171 26.6262 98.8644 26.1459C99.3714 25.5756 100.057 25.2754 100.863 25.2754C101.28 25.2754 101.698 25.3654 102.085 25.5155C102.384 25.6356 102.682 25.8758 102.98 26.206Z" fill="#231F20"/>
                    <path d="M105.903 26.6865H106.678V27.1368C106.768 26.9567 106.887 26.8066 107.006 26.7165C107.155 26.6264 107.304 26.5664 107.483 26.5664C107.603 26.5664 107.722 26.5964 107.871 26.6565L107.573 27.467C107.454 27.4069 107.364 27.3769 107.304 27.3769C107.155 27.3769 107.036 27.467 106.947 27.6471C106.857 27.8272 106.797 28.1574 106.797 28.6977V28.8779V30.3788H105.873V26.6865H105.903Z" fill="#231F20"/>
                    <path d="M112.076 26.5967C112.434 26.5967 112.732 26.6867 113.06 26.8668C113.359 27.047 113.597 27.2871 113.776 27.5873C113.955 27.8875 114.045 28.2177 114.045 28.5479C114.045 28.9081 113.955 29.2083 113.776 29.5385C113.597 29.8387 113.359 30.0789 113.06 30.259C112.762 30.4391 112.434 30.5291 112.076 30.5291C111.539 30.5291 111.092 30.349 110.734 29.9588C110.376 29.5685 110.167 29.1183 110.167 28.5779C110.167 28.0076 110.376 27.5273 110.794 27.137C111.181 26.7768 111.599 26.5967 112.076 26.5967ZM112.076 27.4672C111.778 27.4672 111.539 27.5573 111.36 27.7674C111.181 27.9775 111.062 28.2177 111.062 28.5479C111.062 28.8781 111.152 29.1183 111.331 29.3284C111.51 29.5385 111.748 29.6286 112.046 29.6286C112.345 29.6286 112.583 29.5385 112.762 29.3284C112.941 29.1183 113.06 28.8781 113.06 28.5479C113.06 28.2177 112.971 27.9775 112.792 27.7674C112.613 27.5573 112.374 27.4672 112.076 27.4672Z" fill="#231F20"/>
                    <path d="M116.788 26.6863H117.713V28.4574C117.713 28.8176 117.743 29.0577 117.772 29.1778C117.832 29.2979 117.892 29.418 118.011 29.478C118.13 29.538 118.25 29.5981 118.399 29.5981C118.548 29.5981 118.667 29.5681 118.786 29.478C118.906 29.418 118.965 29.2979 119.025 29.1478C119.055 29.0277 119.085 28.8176 119.085 28.4574V26.6562H120.009V28.2172C120.009 28.8476 119.95 29.2979 119.86 29.5381C119.741 29.8382 119.562 30.0484 119.323 30.1985C119.085 30.3486 118.786 30.4386 118.399 30.4386C118.011 30.4386 117.683 30.3486 117.415 30.1684C117.176 29.9883 116.997 29.7482 116.878 29.418C116.818 29.2078 116.758 28.7876 116.758 28.1872V26.6863H116.788Z" fill="#231F20"/>
                    <path d="M123.856 26.6867V27.107C124.035 26.9269 124.214 26.8068 124.393 26.7168C124.572 26.6267 124.781 26.5967 125.02 26.5967C125.497 26.5967 125.914 26.7768 126.242 27.137C126.57 27.4972 126.749 27.9775 126.749 28.5479C126.749 29.0882 126.57 29.5685 126.242 29.9288C125.884 30.289 125.497 30.4691 125.02 30.4691C124.811 30.4691 124.602 30.4391 124.423 30.349C124.244 30.259 124.065 30.1389 123.886 29.9888V31.7299H122.962V26.6867H123.856ZM124.811 27.4672C124.513 27.4672 124.274 27.5573 124.095 27.7674C123.916 27.9775 123.797 28.2177 123.797 28.5479C123.797 28.8781 123.886 29.1483 124.095 29.3284C124.274 29.5385 124.513 29.6286 124.811 29.6286C125.079 29.6286 125.318 29.5385 125.527 29.3284C125.705 29.1183 125.825 28.8481 125.825 28.5479C125.825 28.2177 125.735 27.9775 125.556 27.7674C125.348 27.5573 125.109 27.4672 124.811 27.4672Z" fill="#231F20"/>
                </g>
                <defs>
                    <clipPath id="clip0_93_518">
                        <rect width="130" height="32" fill="white"/>
                    </clipPath>
                </defs>
            </svg>

            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

       
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                            <?php echo !empty($pageHeading) ? $pageHeading : '&nbsp;';?> </div>
                        </div>
                        <ul class="navbar-nav header-right">
                         
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dz-theme-mode p-0" href="javascript:void(0);">
                                    <i id="icon-light" class="fas fa-sun"></i>
                                    <i id="icon-dark" class="fas fa-moon"></i>

                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <img src="<?php echo Yii::app()->user->getModel()->getGravatarUrl(90);?>" width="20" alt="">
                            <div class="header-info ms-3">
                                <span class="font-w600 ">
                                    <?php echo ($fullName = Yii::app()->user->getModel()->getFullName()) ? "Hi, <b>" . CHtml::encode($fullName) . "</b>" : Yii::t('app', 'Welcome');?>
                                </span>

                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="<?php echo $this->createUrl('account/index');?>" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">Profile </span>
                            </a>
                            <a href="<?php echo $this->createUrl('account/logout');?>" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ms-2">Logout </span>
                            </a>
                        </div>
                    </li>
                    <?php
                        // Get the menu items
                        // $leftSideNavigationWidget = new LeftSideNavigationWidget();
                        $leftSideNavigationWidget = Yii::app()->getController()->createWidget('backend.components.web.widgets.LeftSideNavigationWidget');
                        $menuItems = $leftSideNavigationWidget->getMenuItems();    
                    ?>
                    <?php foreach ($menuItems as $item): ?>
                        <li>
                            <a class="<?php echo isset($item['items']) ? 'has-arrow' : 'ai-icon'; ?>" aria-expanded="false" href="<?php echo isset($item['route']) ? Yii::app()->createUrl($item['route'][0]) : 'javascript:void(0)'; ?>">
                                <i class="<?php echo $item['icon']; ?>"></i> 
                                <span class="nav-text"><?php echo $item['name']; ?> </span>
                            </a>
                            <?php if (isset($item['items']) && is_array($item['items'])): ?>
                                <ul aria-expanded="false">
                                    <?php foreach ($item['items'] as $subItem): ?>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl($subItem['url'][0]); ?>">
                                                <?php echo $subItem['label']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                  
                </ul>
                <div class="copyright">
                    <p><strong>RGEstate Admin Dashboard</strong> © <?php echo date("Y") ?> All Rights Reserved</p>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
            <section class="content" id="<?php echo $this->id=='place_property' ? 'place_an_ad' : '';?>">
                <div id="notify-container">
                    <?php echo Yii::app()->notify->show();?>
                </div>
                <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/global/global.min.js');?>" type="text/javascript"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/jquery-nice-select/js/jquery.nice-select.min.js');?>" type="text/javascript"></script>

                <?php echo $content;?>
            </section>
            
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
         
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

   

    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/chart-js/chart.bundle.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/apexchart/apexchart.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/nouislider/nouislider.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/wnumb/wNumb.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dashboard/dashboard-1.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/custom.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dlabnav-init.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/demo.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/styleSwitcher.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dashboard/cms.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/datatables/js/jquery.dataTables.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/plugins-init/datatables.init.js');?>" type="text/javascript"></script>
   
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/swiper/js/swiper-bundle.min.js');?>" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 5,
            spaceBetween: 30,
            
            breakpoints: {
                360: {
                slidesPerView: 1,
                spaceBetween: 30,
                },
                600: {
                slidesPerView: 2,
                spaceBetween: 30,
                },
                1024: {
                slidesPerView: 2,
                spaceBetween: 30,
                },
                1200: {
                slidesPerView: 3,
                spaceBetween: 30,
                },
                1600: {
                slidesPerView: 4,
                spaceBetween: 30,
                },
                1920: {
                slidesPerView: 5,
                spaceBetween: 30,
                },
            }
            });
        
    </script>
</body>
</html>