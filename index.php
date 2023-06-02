<?php

error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Home | Motor Station";
$page_seo_title = "Home | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
if (isset($_POST['btnsertyre']) && ($_POST['btnsertyre'] != "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") &&
	isset($_POST['txtemailid']) && ($_POST['txtemailid'] != "")
) {

	 include_once "database/iqry_enqtyre_mst.php";
}
?>
<script language="javascript" src="includes/yav.js"></script>
<script language="javascript" src="includes/yav-config.js"></script>
<script language="javascript" type="text/javascript">
	var rules_1 = new Array();

	rules_1[0] = 'txtname:Name|required|Enter Name';
	rules_1[1] = 'txtemailid:Email|required|Enter email id';
	rules_1[2] = 'txtphone:Phone|required|Enter Phone Number';
	rules_1[3] = 'txtphone:Phone|numeric|Enter Only Numbers';
	rules_1[4] = 'txtvehicle:vehicle|required|Enter Vehicle Name';
	rules_1[5] = 'txtemailid:Email|email|Enter  valid email id';

	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>

<?php
$sqrybnr_mst1 = "SELECT bnrm_desc, bnrm_name, bnrm_lnk, bnrm_imgnm, bnrm_sts from bnr_mst where bnrm_sts='a'";
$srsbnr_mst = mysqli_query($conn, $sqrybnr_mst1);
$cnt_recs1 = mysqli_num_rows($srsbnr_mst);
if ($cnt_recs1 > 0) { ?>
	<section class="slider-area fix">
		<div class="swiper main-slider swiper-container swiper-container-fade">
			<div class="swiper-wrapper p-relative">


				<!-- slider-area-start  -->

				<?php

				while ($srowbnr_mst = mysqli_fetch_assoc($srsbnr_mst)) {
					$db_desc = $srowbnr_mst['bnrm_desc'];
					$db_subname = $srowbnr_mst['bnrm_name'];
					$db_sts  = $srowbnr_mst['bnrm_sts'];
					$db_szchrt = $srowbnr_mst['bnrm_imgnm'];
					$imgnm = $db_szchrt;
					$imgpath = $gusrbnr_fldnm1 . $imgnm;
					if (($imgnm != "") && file_exists($imgpath)) {
						//echo "<img src='$imgpath' width='50pixel' height='50pixel'>"; 
						$baner =$rtpth.$imgpath;
					} else {
						echo "NA";
					}
				?>

					?>

					<div class="item-slider sliderm-height p-relative swiper-slide">
						<div class="slide-bg" data-background="<?php echo $baner; ?>"></div>
						<div class="container">
							<div class="row ">
								<div class="col-lg-12">
									<div class="slider-contant mt-25">
										<h2 class="slider-title" data-animation="fadeInUp" data-delay=".6s"><?php echo 	$db_subname; ?>
											<br><?php echo $db_desc; ?>
										</h2>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev ms-button"><i class="far fa-long-arrow-left"></i></div>
			<div class="swiper-button-next ms-button"><i class="far fa-long-arrow-right"></i></div>

		</div>
	</section>
<?php } ?>
<!-- slider-area-end -->

<!-- Swiper Dot start -->
<section class="main-slider-dot">
	<div class="container">
		<div class="swiper main-slider-nav">
			<div class="swiper-wrapper">
				<!-- <div class="swiper-slide">
                     <div class="sm-button">
                        <div class="sm-services__icon">
                           <i class="flaticon-industrial-robot"></i>
                        </div>
                        <div class="sm-services__text">
                           <span>Service 01</span>
                           <h4>Industrial Business</h4>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="sm-button">
                        <div class="sm-services__icon">
                           <i class="flaticon-industrial"></i>
                        </div>
                        <div class="sm-services__text">
                              <span>Service 02</span>
                           <h4>Manufacture Factory</h4>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="sm-button">
                        <div class="sm-services__icon">
                           <i class="flaticon-manufacturing"></i>
                        </div>
                        <div class="sm-services__text">
                              <span>Service 03</span>
                           <h4>Scientific Laboratories</h4>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="sm-button">
                        <div class="sm-services__icon">
                           <i class="flaticon-helmet"></i>
                        </div>
                        <div class="sm-services__text">
                              <span>Service 04</span>
                           <h4>Financial Corporates</h4>
                        </div>
                     </div>
                  </div> -->

			</div>
		</div>
	</div>
</section>
<!-- Swiper Dot end -->

<!-- about__area start -->
<section class="about__area pt-90 pb-90">
	<div class="container">

		<div class="row align-items-center">


			<div class="col-xl-6 col-lg-6">
				<div class="ab-tab-info mb-30">
					<div class="ab-image w-img">
						<img src="assets/img/about/about-1.jpg" class="rounded" alt="">
					</div>
					<!-- <div class="absp-text absp-text-1">
                        <i class="flaticon-windmill"></i>
                        <div class="absp-info">
                           <h5><span class="counter">5000</span>+</h5>
                           <span class="absm-title">Projects Done</span>
                        </div>
                     </div> -->
					<div class="absp-text absp-text-2">
						<i class="flaticon-container-1"></i>
						<div class="absp-info">
							<h5><span class="counter">3300</span>+</h5>
							<span class="absm-title">Happy Customer</span>
						</div>
					</div>
				</div>
			</div>


			<div class="col-xl-6 col-lg-6">
				<div class="ab-left-content">
					<div class="section__wrapper mb-30">
						<h4 class="section__title">Make your car feel like a brand new one </h4>
						<div class="r-text">
							<span>about us</span>
						</div>
					</div>

					<p class="">A business entity started with the orientation of Tyres & Tubes dealership since 1955,
						counting to 60 years of vast experience at Siddiamber Bazaar by our forefathers. MOTOR STATION
						is incorporated after gaining 10 years of technical experience in Wheel Alignment & Balancing. A
						one stop shop to get all major brands, sizes of tyres for any kind of vehicle both Tubeless &
						Tube Type.</p>
					<p>Latest Machinery for Alignment & Balancing being used by us which is a Self Calibrated machine.
						Specialized in repairing the tyres by Radial Patches. Our motto is to get maximum service of the
						tyres (in form of running kms)</p>
					<div class="ab-button mb-30">
						<a href="<?php echo $rtpth; ?>about" class="tp-btn">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- about__area end -->

<section class="blog__area grey-bg-8 black-bg-3 pt-90 pb-90">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="section__wrapper section__wrapper-2 mb-30 text-center">
					<h4 class="section__title text-white">Services</h4>
				</div>
			</div>
		</div>
		<div class="row mt-25">


			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-40">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/multi-brand-tyre-tubes-sales.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">Multi Brand Tyre & Tubes Sales</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>


			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-40">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/3D-alignment-checking.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">3D Alignment & Checking</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>

			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-40">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/wheel-balancing.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">Wheel Balancing</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>

			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-lg-0 mb-md-0 mb-3">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/nitrogen-air.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">Nitrogen Air</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>


			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-lg-0 mb-md-0 mb-3">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/general-service.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">General Service</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>

			<div class="col-xl-4 col-lg-4 col-md-6">
				<div class="blog__item-2 blog__item-2-df mb-0">
					<div class="blog__item-2-image">
						<div class="blog__item-2-image-inner w-img">
							<a href="<?php echo $rtpth; ?>services"><img src="assets/img/services/personalised-services.jpg" alt=""></a>
						</div>
					</div>
					<div class="blog__item-2-content">
						<h5 class="blog__sm-title m-0"><a href="<?php echo $rtpth; ?>services">Personalised Services</a></h5>
					</div>
					<div class="blog__btn-2">
						<a href="<?php echo $rtpth; ?>services" class="link-btn"> Read more <i class="fal fa-long-arrow-right"></i></a>
					</div>
				</div>
			</div>



		</div>
	</div>
</section>

<section class="testimonial__area pt-90 pb-90  fix">
	<div class="container">

		<div class="row align-items-center">
			<div class="col-xl-6">
				<div class="testimonial__side-image w-img">
					<img src="assets/img/testimonial/ts-image-2.jpg" alt="testimonial-img">
				</div>
			</div>

			<div class="col-xl-6">
				<div class="testimonial__left-info-2">
					<div class="section__wrapper section__wrapper-2 mb-40">

						<h4 class="sm-title-d text-dark">Our Happy Clients</h4>
					</div>
					<div class="testimonial__slider-2 swiper-container">
						<div class="testimonial__slider-2-wrapper swiper-wrapper">

							<div class="testimonial__item testimonial__item-3 swiper-slide">
								<p class="review__text">“ Latest Machinery for Alignment & Balancing being used by us
									which is a Self
									Calibrated machine. Specialized in repairing the tyres by Radial Patches. Our
									motto is to get maximum service of the tyres (in form of running kms). ”</p>
								<div class="review__info mt-30">
									<a href="#"><img src="assets/img/author/01.png" alt=""></a>
									<div class="client__content">
										<h5 class="client__name"><a href="#">Name</a></h5>
										<div class="client__designation">
											<p>Hyderabad</p>
										</div>
									</div>
								</div>

								<div class="testimonial__icon-3">
									<img src="assets/img/icon/quote-3.png" class="w-100" alt="quote-icon">
								</div>
							</div>


							<div class="testimonial__item testimonial__item-3 swiper-slide">
								<p class="review__text">“ Latest Machinery for Alignment & Balancing being used by us
									which is a Self
									Calibrated machine. Specialized in repairing the tyres by Radial Patches. Our
									motto is to get maximum service of the tyres (in form of running kms). ”</p>
								<div class="review__info mt-30">
									<a href="#"><img src="assets/img/author/01.png" alt=""></a>
									<div class="client__content">
										<h5 class="client__name"><a href="#">Name</a></h5>
										<div class="client__designation">
											<p>Secunderabad</p>
										</div>
									</div>
								</div>

								<div class="testimonial__icon-3">
									<img src="assets/img/icon/quote-3.png" class="w-100" alt="quote-icon">
								</div>
							</div>



							<div class="testimonial__item testimonial__item-3 swiper-slide">
								<p class="review__text">“ Latest Machinery for Alignment & Balancing being used by us
									which is a Self
									Calibrated machine. Specialized in repairing the tyres by Radial Patches. Our
									motto is to get maximum service of the tyres (in form of running kms). ”</p>
								<div class="review__info mt-30">
									<a href="#"><img src="assets/img/author/01.png" alt=""></a>
									<div class="client__content">
										<h5 class="client__name"><a href="#">Name</a></h5>
										<div class="client__designation">
											<p>Rangareddy</p>
										</div>
									</div>
								</div>

								<div class="testimonial__icon-3">
									<img src="assets/img/icon/quote-3.png" class="w-100" alt="quote-icon">
								</div>
							</div>




						</div>
						<div class="ts-pagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>


</section>





<!-- sd-banner-area start -->
<section class="sd-banner-area enq-form pb-90">
	<div class="banner__slider swiper-container">
		<div class="banner__wrapper swiper-wrapper">
			<div class="sd-banner__item swiper-slide" data-background="assets/img/banner/banner-01.jpg">
				<div class="container-0">
					<div class="row g-0">



						<div class="col-xl-6 col-lg-6 col-md-8 banner-slide-height">


							<div class="slide-border"></div>
							<div class="sd-content">
							<form name="frmenqtyre" id="frmenqtyre" method="post" action="" onSubmit="return performCheck('frmenqtyre', rules_1, 'inline');">
								<div class="contact__form">
									<div class="container">
										<div class="row">
											<div class="col-12">
												<div class="section__wrapper mb-20">
													<h3 class=" m-0 p-0 text-white">Quick Enquiry</h3>
												</div>
											</div>

										
												<div class="col-xl-6 col-lg-6 col-md-6">

											
													<div class="row">
														<div class="col-12">
															<div class="contact-filed mb-20">
																<input type="text" id="txtname" name="txtname" placeholder="Your name" >
																<span id="errorsDiv_txtname" style="color:red"></span>
															</div>
														
														</div>
													
														<div class="col-12">
															<div class="contact-filed contact-icon-mail mb-20">
																<input email="text" name="txtemailid" id="txtemailid" placeholder="Email Id" >
																<span id="errorsDiv_txtemailid" style="color:red"></span>
															</div>
														
														</div>
													
														<div class="col-12">
															<div class="contact-filed phone-icon mb-20">
																<input type="text" id="txtphone" name="txtphone" placeholder="Phone Number" >
																<span id="errorsDiv_txtphone" style="color:red"></span>
															</div>
														</div>
														<div class="col-12">
															<div class="contact-filed car-icon mb-20">
																<input type="text" name="txtvehicle" id="txtvehicle" placeholder="Vehicle Name" >
																<span id="errorsDiv_txtvehicle" style="color:red"></span>
															</div>
														</div>
													</div>





												</div>

												<div class="col-lg-6 col-md-6 frm-22-hm">
													<p class="text-uppercase mb-0 text-white"><strong>Tyre Requirement</strong></p>


													<div class="d-flex">
														<div class="form-check mb-0 d-flex">
															<input class="form-check-input" type="radio" name="lstvchltyp" id="lstvchltyp" value="y" checked>
															<label class="form-check-label" for="flexRadioDefault1">
																Yes
															</label>
														</div>
														<div class="form-check mb-0 d-flex ms-3">
															<input class="form-check-input" type="radio" name="lstvchltyp" id="lstvchltyp"  value="n">
															<label class="form-check-label" for="flexRadioDefault2">
																No
															</label>
														</div>
													</div>


													<div class="row">
														<div class="col-12 mb-0">
															<p class="text-uppercase mb-0 mt-2 text-white"><strong>Services</strong></p>


															<div class="row">

																<div class="col-xxl-12 col-lg-12 mb-0">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="0" id="0" name="srvctyp[]" checked>
																		<label class="form-check-label" for="0">
																			Multi Brand Tyre & Tubes Sales
																		</label>
																	</div>

																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="1" name="srvctyp[]" id="1">
																		<label class="form-check-label" for="1">
																			3D Alignment & Checking
																		</label>
																	</div>
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="2" id="2" name="srvctyp[]">
																		<label class="form-check-label" for="2">
																			Wheel Balancing
																		</label>
																	</div>
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="3" id="3" name="srvctyp[]">
																		<label class="form-check-label" for="3">
																			Car Wash
																		</label>
																	</div>
																</div>

																<div class="col-xxl-12 col-lg-12 mb-0">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="4" id="4" name="srvctyp[]">
																		<label class="form-check-label" for="4">
																			Nitrogen Air
																		</label>
																	</div>
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="5" id="5" name="srvctyp[]">
																		<label class="form-check-label" for="5">
																			General Service
																		</label>
																	</div>
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="6" id="6" name="srvctyp[]">
																		<label class="form-check-label" for="6">
																			Personalised Services
																		</label>
																	</div>
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" value="7" id="7" name="srvctyp[]">
																		<label class="form-check-label" for="7">
																			General Check-Up
																		</label>
																	</div>
																</div>

															</div>



														</div>


													</div>

												</div>


												<div class="ab-button col-12">
												
													<input type="submit" class="tp-btn-3 w-100 text-center" name="btnsertyre" id="btnsertyre" value="submit">
												</div>

											</form>



										</div>
									</div>
								</div>



								<div class="sd-bg-icon">
									<i class="flaticon-industrial"></i>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-4 banner-slide-height d-none d-xl-block">
							<div class="slide-border"></div>
						</div>

					</div>
				</div>
			</div>




		</div>
	</div>
</section>
<!-- sd-banner-area end -->

<!-- brand__area start -->

<?php
$sqlvehbrnd_mst = "SELECT brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts from brnd_mst where 
 brndm_sts='a'  order by brndm_name asc";
//and prodm_brndm_id='$id'
$rwsvehbrnd_mst = mysqli_query($conn, $sqlvehbrnd_mst);
$carbrndcnt = mysqli_num_rows($rwsvehbrnd_mst);
if ($carbrndcnt > 0) { ?>
	<section class="brand__area pb-90">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="brand__title text-center">
						<span>Brands We Have</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="brand__slider swiper-container">
						<div class="swiper-wrapper">
							<?php

							while ($rowsvehbrnd_mst = mysqli_fetch_assoc($rwsvehbrnd_mst)) {
								$brnd_id = $rowsvehbrnd_mst['brndm_id'];
								$brnd_name = $rowsvehbrnd_mst['brndm_name'];
								$vehbrndimgnm = $rowsvehbrnd_mst['brndm_img'];

								$vehbrndimgpth = $gusrbrnd_upldpth . $vehbrndimgnm;
								if ($vehbrndimgnm != '' && file_exists($vehbrndimgpth)) {
									$vehbrndimgpth = $rtpth . $gusrbrnd_upldpth . $vehbrndimgnm;
								} else {
									$vehbrndimgpth = "images/no-image.png";
								}

							?>

								<div class="brand__slider-item swiper-slide">
									<a href="#"><img src="<?php echo 	$vehbrndimgpth; ?> " class="w-100" alt=""></a>
								</div>

							<?php } ?>



						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>
<!-- brand__area end -->

<?php include_once('footer.php'); ?>