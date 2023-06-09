<?php
$page_title = "Thankyou | Motor Station";
$page_seo_title = "Thankyou | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>


<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
    data-background="assets/img/inner-banner/about-us2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                            <li><span>Thankyou</span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20">Thankyou</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->

<!-- about__area start -->
<section class="about__area-2 pt-90 pb-90">
    <div class="container">
        <div class="row align-items-center justify-content-center">



            <div class="col-xl-6 col-lg-6 col-md-6 col-11">
                <div class="text-center py-4 px-2" style="background-color: rgba(62, 182, 85, 0.18);">
                    <img src="assets/img/icon/thankyou.png" width="60px" class="mb-2" alt="">
                    <div class="section__wrapper mb-2">
                        <h4 class="section__title ms-0">Thankyou for Feedback</h4>
                    </div>
                    <p>We’re glad that you loved our Products and Services. We are always trying our best to make your experience memorable, and we’re glad that we’ve achieved it!</p>

                    <div class="ab-button mb-0">
                        <a href="<?php echo $rtpth; ?>home" class="tp-btn">Go to Homepage</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- about__area end -->






<?php include_once('footer.php'); ?>