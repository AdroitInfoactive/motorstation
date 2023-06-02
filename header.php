<?php 
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
?>
<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <!-- Page Title -->
    <title><?php if (isset($page_seo_title) && !empty($page_seo_title)) echo $page_seo_title; ?></title>

    <?php if (isset($db_seodesc) && isset($db_seokywrd)) { ?>
        <meta name="description" content="<?php echo $db_seodesc; ?>">
        <meta name="keywords" content="<?php echo $db_seokywrd; ?>">

    <?php } ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="assets/css/backtotop.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/font-awesome-pro.css">
    <link rel="stylesheet" href="assets/css/spacing.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.14/css/lightgallery.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <!-- Preloader -->
    <!-- <div class="preloader"></div> -->
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <!-- header-area-start -->
    <header id="header-sticky" class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                    <div class="logo-area">
                        <div class="logo">
                            <a href="<?php echo $rtpth; ?>home"><img src="assets/img/logo/motor-station-logo-1.png" class="w-100" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-6 col-6">
                    <div class="menu-area menu-padding">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                                    <li><a href="<?php echo $rtpth; ?>about">About Us</a></li>
                                    <!-- <li><a href="<?php echo $rtpth; ?>brands">Products</a></li> -->
                                    <li class="has-dropdown"><a href="#">Tyres</a>
                                        <ul class="sub-menu">
                                            <?php 
                                           	$sqryvehtyp_mst = "SELECT vehtypm_id,vehtypm_name,vehtypm_img,vehtypm_sts, vehtypm_prty  from vehtyp_mst";
                                               $srsvehtyp_mst = mysqli_query($conn, $sqryvehtyp_mst);
                                            while ($srowvehtyp_mst = mysqli_fetch_assoc($srsvehtyp_mst)) {
                                               $veh_name= $srowvehtyp_mst['vehtypm_name'];
                                               $veh_id= $srowvehtyp_mst['vehtypm_id'];

                                           ?>
                                           
                                            <li><a href="<?php echo $rtpth;?>tyres.php?type=<?php echo $veh_name;?>&id=<?php echo $veh_id;?>"><?php echo $veh_name;?></a></li>
                                         
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo $rtpth; ?>services">Services</a></li>
                                    <li><a href="<?php echo $rtpth; ?>feedback">Feedback</a></li>
                                    <li><a href="<?php echo $rtpth; ?>contact">Contact Us</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="side-menu-icon d-lg-none text-end">
                        <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="header-info f-right">
                        <div class="info-item info-item-right">
                            <span>Call Us</span>
                            <h5><a href="tel:">+91 04 6455 1506</a></h5>
                        </div>
                        <div class="info-item">
                            <span>Mail Us</span>
                            <h5><a href="#"><span>motorstation81@yahoo.in</span></a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->

    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="sidebar__logo mb-40">
                    <a href="index.html">
                        <img src="assets/img/logo/motor-station-logo-1.png" alt="logo">
                    </a>
                </div>

                <div class="mobile-menu fix"></div>
                <div class="sidebar__contact mt-30 mb-20">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a target="_blank" href="#">Opp. to Piller no 112 Express Flyover, Attapur, Telangana 500048</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a href="tel:">+91 04 6455 1506, +91 04 6581 3670</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="sidebar__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="sidebar__contact-text">
                                <a href="#"><span>motorstation81@yahoo.in</span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="sidebar__social">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->

    <!-- <main> -->