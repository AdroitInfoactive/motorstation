<?php
$page_title = "Feedback | Motor Station";
$page_seo_title = "Feedback | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>


<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/inner-banner/feedback.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                            <li><span>Feedback</span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20">Feedback</h3>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- contact__area-2 start -->
<section class="contact__area-2 pt-90 pb-90">
    <div class="container">

        <div class="contact__form grey-bg-8 black-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section__wrapper mb-45">
                            <h3 class="text-white">Kindly fill the below form.</h3>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <form id="contact-form" action="" method="POST">

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed mb-20">
                                        <input type="text" name="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed contact-icon-mail mb-20">
                                        <input email="text" name="email" placeholder="Your Email Id">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed contact-icon-call mb-20">
                                        <input type="text" name="name" placeholder="Your Phone Number">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed cpname mb-20">
                                        <input type="text" name="name" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="contact-filed locate mb-20">
                                        <input type="text" name="name" placeholder="Location">
                                    </div>
                                </div>

                            </div>


                            <div class="contact-filed contact-icon-message mb-20">
                                <textarea placeholder="Enter message here" name="Message/Enquiry"></textarea>
                            </div>



                            <div class="form-submit d-flex justify-content-end align-items-center">
                                <button class="tp-btn" type="submit">Submit</button>
                                <button href="#" class="tp-btn-d ms-3">Reset</button>
                            </div>
      

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact__area-2 end -->






<?php include_once('footer.php'); ?>