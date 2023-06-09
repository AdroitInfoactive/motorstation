<?php
error_reporting(0);
session_start();
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
$brand = $_REQUEST['vehbrnd'];
$veh_typ = $_REQUEST['type'];
$prd_code = $_REQUEST['prd_code'];
$prd_name = $_REQUEST['prd_name'];
$prd_id = $_REQUEST['prd_id'];
include_once ('includes/inc_fnct_ajax_validation.php');
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
						<?php
							if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {?>
							<li><a href="<?php echo $rtpth; ?>tyres.php?type=<?php echo $veh_typ;?>"><span><?php echo $veh_typ;?></span></a></li>
							<?php } ?>
							<li><a href="<?php echo $rtpth; ?>products.php?type=<?php echo $veh_typ;?>&vehbrnd=<?php echo $brand;?>"><span><?php echo $brand;?></span></a></li>
							<!-- <li><a href="brands.php"><span>Brands</span></a></li> -->
							<!-- <li><span><?php echo $brand; ?></span></li> -->
							<li><span><?php echo $prd_name; ?></span></li>
						</ul>
					</div>
					<h3 class="page__title mt-20"><?php echo $prd_name; ?></h3>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- slider-area-end -->


<?php
$sqlprod_mst = "SELECT prodm_vehtypm_id,prodm_id,prodm_name,prodm_brndm_id,prodm_code,prodm_sts,vehtypm_id,vehtypm_name,brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts,vehtypm_sts,prodimgd_prodm_id,prodimgd_id,prodimgd_sts,prodimgd_simg,prodimgd_bimg,prodm_descone,prodm_desctwo from prod_mst
	 LEFT join vehtyp_mst on vehtyp_mst.vehtypm_id=	prod_mst.prodm_vehtypm_id
	LEFT join brnd_mst on brnd_mst.brndm_id=prod_mst.prodm_brndm_id
	LEFT join  prodimg_dtl on  prodimg_dtl.prodimgd_prodm_id=prod_mst.prodm_id
  where 
		prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and brndm_sts='a' ";
		// and vehtypm_name='$veh_typ' and brndm_name='$brand' and prodm_code='$prd_code' and prodm_name='$prd_name' group by  prodm_id ";


		if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
			$brand = glb_func_chkvl($_REQUEST['vehbrnd']);
			$sqlprod_mst .= " and brndm_name='$brand' ";
		}
		if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
			$veh_typ = glb_func_chkvl($_REQUEST['type']);
			$sqlprod_mst .= " and vehtypm_name='$veh_typ' ";
		}
		if (isset($_REQUEST['prd_code']) && (trim($_REQUEST['prd_code']) != "") || isset($_REQUEST['prd_name']) && (trim($_REQUEST['prd_name']) != "") ) {
			$prd_code = glb_func_chkvl($_REQUEST['prd_code']);
			$prd_name = glb_func_chkvl($_REQUEST['prd_name']);
			$prd_id = glb_func_chkvl($_REQUEST['prd_id']);
			$sqlprod_mst .= " and prodm_code='$prd_code' and prodm_name='$prd_name' ";
		}
		$sqlprod_mst.=" group by prodm_id" ;

$rwsprod_mst = mysqli_query($conn, $sqlprod_mst);
$prdcnt = mysqli_num_rows($rwsprod_mst);
if ($prdcnt > 0) { ?>
	<!-- blog__area start -->
	<section class="blog__area pt-90 pb-90 prdt-list">
		<div class="container">
			<div class="row justify-content-center">
				<?php
				while ($rowsprods_mst = mysqli_fetch_assoc($rwsprod_mst)) {
					$prod_nm = $rowsprods_mst['prodm_name'];
					$prod_id = $rowsprods_mst['prodm_id'];
					$prod_code = $rowsprods_mst['prodm_code'];
					$vehname = $rowsprods_mst['vehtypm_name'];
					$prod_desc1 = $rowsprods_mst['prodm_descone'];
					$prod_desc2 = $rowsprods_mst['prodm_desctwo'];
					// $_SESSION["prod_id"] =$prod_id;
					// $_SESSION["prod_code"] =$prod_code;
				?>
					<div class="col-xl-5 col-lg-5 col-md-5 col-12">
						<?php
						$sqlbimgdtl = "SELECT prodimgd_bimg from prodimg_dtl where prodimgd_prodm_id = $prd_id order by prodimgd_prty desc";
						$resbimgdtl = mysqli_query($conn, $sqlbimgdtl);
						 $cntbgimg = mysqli_num_rows($resbimgdtl);
						if ($cntbgimg > 0) { ?>
							<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 prdt-main-display wd-100-over-hdn">
								<div class="swiper-wrapper" id="lightgallery-prdt">
									<?php
									while ($rwsimgdtl = mysqli_fetch_array($resbimgdtl)) {
										
										$bgImgNm = $rwsimgdtl['prodimgd_bimg'];
										if ($bgImgNm != "") {
											$bgImgPth = $u_gbg_fldnm . $bgImgNm;
											if (file_exists($bgImgPth)) {
												$bgImgPth = $rtpth . $u_gbg_fldnm . $bgImgNm;
											} else {
												$bgImgPth = $rtpth .'products/no-img.png';
											}
										} else {
											$bgImgPth = $rtpth .'products/no-img.png';
										}
									?>
										<!-- loop big img -->
										<div class="swiper-slide" data-src="<?php echo $bgImgPth; ?>">
											<a href="">
												<img class="img-responsive w-100" src="<?php echo $bgImgPth; ?>">
											</a>
										</div>
									<?php
									}
									?>
									<!-- loop big img end -->
								</div>
								<!-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
							</div>
						<?php
						}
						else{
							?>
							<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 prdt-main-display wd-100-over-hdn">
								<div class="swiper-wrapper" id="lightgallery-prdt">
								<div class="swiper-slide" data-src="<?php echo $rtpth .'products/no-img.png'; ?>">
											<a href="">
												<img class="img-responsive w-100" src="<?php echo $rtpth .'products/no-img.png'; ?>">
											</a>
										</div>
								</div>
							</div>
									<?php

						}
						$sqlsimgdtl = "SELECT prodimgd_simg from prodimg_dtl where prodimgd_prodm_id = $prd_id order by prodimgd_prty desc";
						$resimgdtl = mysqli_query($conn, $sqlsimgdtl);
						$cntsimg = mysqli_num_rows($resimgdtl);
						if ($cntsimg > 0 ) { ?>
							<div thumbsSlider="" class="swiper mySwiper wd-100-over-hdn">
								<div class="swiper-wrapper swiper-thum-custom">
									<?php
									while ($rwsimgdtl = mysqli_fetch_array($resimgdtl)) {
										$smlImgNm = $rwsimgdtl['prodimgd_simg'];
										if ($smlImgNm != "") {
											$smlImgPth = $u_gsml_fldnm . $smlImgNm;
											if (file_exists($smlImgPth)) {
												$smlImgPth = $rtpth . $u_gsml_fldnm . $smlImgNm;
											} else {
												$smlImgPth = $rtpth . 'products/no-img.png';
											}
										} else {
											$smlImgPth = $rtpth . 'products/no-img.png';
										}
									?>
										<div class="swiper-slide ">
											<img src="<?php echo $smlImgPth; ?>" class="w-100" />
										</div>
									<?php } ?>

								</div>
							</div>
						<?php }
						else{
							?>
							<div thumbsSlider="" class="swiper mySwiper wd-100-over-hdn">
								<div class="swiper-wrapper swiper-thum-custom">
								<div class="swiper-slide ">
											<img src="<?php echo $rtpth . 'products/no-img.png' ?>" class="w-100" />
								</div>
							</div>
							</div>
									<?php

						}
						?>

					</div>

					<div class="col-xl-5 col-lg-5 col-md-5 col-11">
						<div class="prdt-desc">
							<h2><?php echo $prod_nm; ?></h2>

							<p><?php echo $prod_desc1; ?></p>
							<h5>Specification</h5>
							<p><?php echo $prod_desc2; ?></p>
							<!-- <table class="table table-striped">
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
							</table> -->

							<div class="ab-button mb-30">
								<button class="tp-btn" onclick="add_to_crt('<?php echo $prod_id; ?>');">Add To Enquiry</button>
								<!-- <a href="view_cart.php" class="tp-btn">Add To Enquiry</a> -->
							</div>
						</div>
					</div>



				<?php } ?>

			</div>
		</div>
	</section>
<?php } ?>
<!-- blog__area end -->


<?php include_once('footer.php'); ?>
<script type="text/javascript">
	function add_to_crt(prodid)
	{				
		if(prodid!="")
		{
			// debugger;
			var url = "add_crt.php?prodid="+prodid+"&typ=a";
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
	}
	function stateChanged() 
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 	
			var temp=xmlHttp.responseText;
			// document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!="")
			{
				if(temp == 'y')
				{
					location.href = "view_cart.php";
				}
				else
				{
					alert("Cannot Enquire this product. Please try again later.");
					location.reload();
				}
				// document.getElementById('txtname').focus();
				// add redirect here
			}		
		}
	}
</script>