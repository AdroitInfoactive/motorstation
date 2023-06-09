<?php
$page_title = "Error | Motor Station";
$page_seo_title = "Error | Motor Station";
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
                            <li><span>Error</span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20">Error</h3>
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
                <div class="text-center py-4 px-2" style="background-color: rgba(226, 76, 75, 0.18);">
                    <img src="assets/img/icon/error.png" width="60px" class="mb-2" alt="">
                    <div class="section__wrapper mb-2">
                        <h4 class="section__title ms-0">Oops !</h4>
                    </div>
                    <p>An error occurred during your submission.</p>

                    <div class="ab-button mb-0">
                        <a href="<?php echo $rtpth; ?>home" class="tp-btn">Try once again</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- about__area end -->






<?php include_once('footer.php'); ?>