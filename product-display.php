<?php
error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Product Display | Motor Station";
$page_seo_title = "Product Display | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
$brand=$_REQUEST['vehbrnd'];
$veh_typ=$_REQUEST['type'];
$prd_code=$_REQUEST['prd_code'];
$prd_name=$_REQUEST['prd_name'];


?>


<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/inner-banner/about-us2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                            <li><a href="brands.php"><span>Brands</span></a></li>
                            <li><span><?php echo $brand;?></span></li>
                            <li><span><?php echo $veh_typ;?></span></li>

                            <li><span><?php echo $prd_name;?></span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20"><?php echo $prd_name;?></h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->




<!-- blog__area start -->
<section class="blog__area pt-90 pb-90 prdt-list">
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-5 col-md-5 col-12">

                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 prdt-main-display wd-100-over-hdn">
                    <div class="swiper-wrapper" id="lightgallery-prdt">



                        <div class="swiper-slide" data-src="assets/img/brand/products/prdt-display/1.jpg">
                            <a href="">
                                <img class="img-responsive w-100" src="assets/img/brand/products/prdt-display/1.jpg" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide" data-src="assets/img/brand/products/prdt-display/2.jpg">
                            <a href="">
                                <img class="img-responsive w-100" src="assets/img/brand/products/prdt-display/2.jpg" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide" data-src="assets/img/brand/products/prdt-display/1.jpg">
                            <a href="">
                                <img class="img-responsive w-100" src="assets/img/brand/products/prdt-display/1.jpg" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide" data-src="assets/img/brand/products/prdt-display/1.jpg">
                            <a href="">
                                <img class="img-responsive w-100" src="assets/img/brand/products/prdt-display/1.jpg" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide" data-src="assets/img/brand/products/prdt-display/1.jpg">
                            <a href="">
                                <img class="img-responsive w-100" src="assets/img/brand/products/prdt-display/1.jpg" alt="">
                            </a>
                        </div>



                    </div>
                    <!-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
                </div>
                <div thumbsSlider="" class="swiper mySwiper wd-100-over-hdn">
                    <div class="swiper-wrapper swiper-thum-custom">

                        <div class="swiper-slide ">
                            <img src="assets/img/brand/products/prdt-display/1.jpg" class="w-100" />
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/img/brand/products/prdt-display/2.jpg" class="w-100" />
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/img/brand/products/prdt-display/1.jpg" class="w-100" />
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/img/brand/products/prdt-display/1.jpg" class="w-100" />
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/img/brand/products/prdt-display/1.jpg" class="w-100" />
                        </div>




                    </div>
                </div>





            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-11">
                <div class="prdt-desc">
                    <h2>Product title</h2>
                    <p>A business entity started with the orientation of Tyres & Tubes dealership since 1955, counting to 60 years of vast experience at Siddiamber Bazaar by our forefathers. MOTOR STATION is incorporated after gaining 10 years of technical experience in Wheel Alignment & Balancing.</p>
                    <h5>Specification</h5>
                    <table class="table table-striped">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>Section Width</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>Apect Ratio</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>Rim Diameter</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <td>Load Index</td>
                                <td>105</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <td>Speed Index</td>
                                <td>N</td>
                            </tr>
                
                        </tbody>
                    </table>

                    <div class="ab-button mb-30">
                        <a href="#" class="tp-btn">Add To Enquiry</a>
                    </div>
                </div>
            </div>





        </div>
    </div>
</section>
<!-- blog__area end -->


<?php include_once('footer.php'); ?>