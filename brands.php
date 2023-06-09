<?php
error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Brand of Tyres | Motor Station";
$page_seo_title = "Brand of Tyres | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>


<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/inner-banner/products.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                            <li><span>Brand of Tyres</span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20">Brand of Tyres</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->

<?php
$sqlvehbrnd_mst = "SELECT brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts,prodm_brndm_id,prodm_sts,prodm_id from brnd_mst
left join prod_mst on prodm_brndm_id = brndm_id
 where 
 brndm_sts='a' and prodm_sts='a' group by prodm_brndm_id order by brndm_name asc";
//and prodm_brndm_id='$id'
$rwsvehbrnd_mst = mysqli_query($conn, $sqlvehbrnd_mst);
$carbrndcnt = mysqli_num_rows($rwsvehbrnd_mst);
if ($carbrndcnt > 0) { ?>

<!-- services__area start -->
<section class="services__area-2 pt-90 pb-90 brnds-22">
    <div class="container">
        <div class="row">
					<?php
				while ($rowsvehbrnd_mst = mysqli_fetch_assoc($rwsvehbrnd_mst)) {
								$brnd_id = $rowsvehbrnd_mst['brndm_id'];
								$brnd_name = $rowsvehbrnd_mst['brndm_name'];
								$vehbrndimgnm = $rowsvehbrnd_mst['brndm_img'];

								$vehbrndimgpth = $gusrbrnd_upldpth . $vehbrndimgnm;
								if ($vehbrndimgnm != '' && file_exists($vehbrndimgpth)) {
									$vehbrndimgpth = $rtpth . $gusrbrnd_upldpth . $vehbrndimgnm;
								} else {
									$vehbrndimgpth = "products/no-img.png";
								}

							?>

            <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                <div class="services__item services__item-grid text-center mb-lg-0 mb-md-0 mb-3">
                    <div class="services__item-content">
                        <div class="ser__icon mb-30">
                           <img src="<?php echo $vehbrndimgpth;?>" class="w-100" alt="">
                        </div>
                        <!-- <h5 class="ser__title mb-10"><a href="#">Yokohama</a></h5> -->
                        <div class="ser__more-option mt-15">
                            <a href="<?php echo $rtpth;?>products.php?vehbrnd=<?php echo $brnd_name; ?>">Products <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<?php } ?>
            


        </div>
    </div>
</section>
<?php } ?>

<!-- services__area end -->



<?php include_once('footer.php'); ?>