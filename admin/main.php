<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //Check the session is created or not
include_once '../includes/inc_config.php';
include_once "../includes/inc_connection.php"; //Making database Connection
/**************************************/
//Programm 	  : main.php	
//Company 	  : Adroit
/**************************************/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
		<?php echo $pgtl; ?> - Dashboard
	</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="ui-lightness/jquery-ui.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset for responsive tabbed -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style responsive tabbed -->
	<link rel="stylesheet" href="css/meanmenu.css" media="all" />
	<link rel="stylesheet" href="ui-lightness/jquery-ui-1.10.3.custom.css">
	<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<link href="admin_menu.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!--[if lt IE 7]>
						<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
				<![endif]-->
	<div class="container">
		<div class="row">
			<?php
			include_once('../includes/inc_adm_header.php');
			include_once('../includes/inc_adm_leftlinks_home.php');
			?>
			<div class="clearfix">
				<!--close of span 3 -->
				<div class="col-md-4">
					<div class="order lorangebg">
						<h2 class="order-heading">Set Up<span> Active / In Active</span></h2>
						<ul class="liboxes">
							<?php
							$sqrybnr_mst = "select 
									count(bnrm_id) as bnrm_id,bnrm_sts
								from
									bnr_mst 
								where
									bnrm_name !=''	
								group by bnrm_sts";
							$srsbnr_mst = mysqli_query($conn, $sqrybnr_mst);
							$cntrec_bnr = mysqli_num_rows($srsbnr_mst);
							$bnractive = 0;
							$bnrinactive = 0;
							if ($cntrec_bnr > 0) {
								while ($srowsbnr_mst = mysqli_fetch_assoc($srsbnr_mst)) {
									$db_bnrsts = $srowsbnr_mst['bnrm_sts'];
									if ($db_bnrsts == 'a') {
										$bnractive = $srowsbnr_mst['bnrm_id'];
									}
									if ($db_bnrsts == 'i') {
										$bnrinactive = $srowsbnr_mst['bnrm_id'];
									}
									$cntrec_bnr = $bnractive + $bnrinactive;
								}
							}
							echo "<li><a href='vw_all_banners.php'>$cntrec_bnr - Banner </a><span>$bnractive / $bnrinactive</span> </li>";
							?>
						</ul>
					</div>
				</div> <!--close of span 4 -->
				<div class="col-md-4">
					<div class="order lgreenbg">
						<h2 class="order-heading">Vehicle<span> Active / In Active</span></h2>
						<ul class="liboxes">
							<?php
							/* ---------------------- Photo Gallery --------------------------*/
							$sqrybrnd_mst = "select 
									count(brndm_id) as brndm_id,brndm_sts
								from
									brnd_mst
								where
									brndm_name !=''	
								group by brndm_sts";
							$srsbrnd_mst = mysqli_query($conn, $sqrybrnd_mst);
							$cntrec_brnd = mysqli_num_rows($srsbrnd_mst);
							$brndactive = 0;
							$brndinactive = 0;
							if ($cntrec_brnd > 0) {
								while ($srowsbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst)) {
									$db_brndsts = $srowsbrnd_mst['brndm_sts'];
									if ($db_brndsts == 'a') {
										$brndactive = $srowsbrnd_mst['brndm_id'];
									}
									if ($db_brndsts == 'i') {
										$brndinactive = $srowsbrnd_mst['brndm_id'];
									}
									$cntrec_brnd = $brndactive + $brndinactive;
								}
							}
							echo "<li><a href='view_all_brands.php'>$cntrec_brnd - Brand </a><span>$brndactive / $brndinactive</span> </li>";
							$sqryprod_mst = "select 
										count(prodm_id) as prodm_id,prodm_sts
									from
										vw_prod_mst
									group by prodm_sts";
							$srsprod_mst = mysqli_query($conn, $sqryprod_mst);
							$cntrec_prod = mysqli_num_rows($srsprod_mst);
							$prodactive = 0;
							$prodinactive = 0;
							if ($cntrec_prod > 0) {
								while ($srowsprod_mst = mysqli_fetch_assoc($srsprod_mst)) {
									$db_prodsts = $srowsprod_mst['prodm_sts'];
									if ($db_prodsts == 'a') {
										$prodactive = $srowsprod_mst['prodm_id'];
									}
									if ($db_prodsts == 'i') {
										$prodinactive = $srowsprod_mst['prodm_id'];
									}
									$cntrec_prod = $prodactive + $prodinactive;
								}
							}
							echo "<li><a href='vw_all_products.php'>$cntrec_prod - Products </a><span>$prodactive / $prodinactive</span> </li>";
							?>
						</ul>
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="order lgreenbg">
						<h2 class="order-heading">Locations<span> Active / In Active</span></h2>
						<ul class="liboxes">
							<?php
							$sqrycntnt_mst = "select 
										count(cntntm_id) as cntntm_id,cntntm_sts
									from
										cntnt_mst
									group by cntntm_sts";
							$srscntnt_mst = mysqli_query($conn, $sqrycntnt_mst);
							$cntrec_cntnt = mysqli_num_rows($srscntnt_mst);
							$cntntactive = 0;
							$cntntinactive = 0;
							if ($cntrec_cntnt > 0) {
								while ($srowscntnt_mst = mysqli_fetch_assoc($srscntnt_mst)) {
									$db_cntntsts = $srowscntnt_mst['cntntm_sts'];
									if ($db_cntntsts == 'a') {
										$cntntactive = $srowscntnt_mst['cntntm_id'];
									}
									if ($db_cntntsts == 'i') {
										$cntntinactive = $srowscntnt_mst['cntntm_id'];
									}
									$cntrec_cntnt = $cntntactive + $cntntinactive;
								}
							}
							echo "<li><a href='vw_all_continent.php'>$cntrec_cntnt - Continent </a><span>$cntntactive / $cntntinactive</span> </li>";
							$sqrycntry_mst = "select 
										count(cntrym_id) as cntrym_id,cntrym_sts
									from
										cntry_mst
									group by cntrym_sts";
							$srscntry_mst = mysqli_query($conn, $sqrycntry_mst);
							$cntrec_cntry = mysqli_num_rows($srscntry_mst);
							$cntryactive = 0;
							$cntryinactive = 0;
							if ($cntrec_cntry > 0) {
								while ($srowscntry_mst = mysqli_fetch_assoc($srscntry_mst)) {
									$db_cntrysts = $srowscntry_mst['cntrym_sts'];
									if ($db_cntrysts == 'a') {
										$cntryactive = $srowscntry_mst['cntrym_id'];
									}
									if ($db_cntrysts == 'i') {
										$cntryinactive = $srowscntry_mst['cntrym_id'];
									}
									$cntrec_cntry = $cntryactive + $cntryinactive;
								}
							}
							echo "<li><a href='vw_all_country.php'>$cntrec_cntry - Country </a><span>$cntryactive / $cntryinactive</span> </li>";
							$sqrycnty_mst = "select 
									count(cntym_id) as cntym_id,cntym_sts
								from
									cnty_mst 
								where
									cntym_name !=''	
								group by cntym_sts";
							$srscnty_mst = mysqli_query($conn, $sqrycnty_mst);
							$cntrec_cnty = mysqli_num_rows($srscnty_mst);
							$cntyactive = 0;
							$cntyinactive = 0;
							if ($cntrec_cnty > 0) {
								while ($srowscnty_mst = mysqli_fetch_assoc($srscnty_mst)) {
									$db_cntysts = $srowscnty_mst['cntym_sts'];
									if ($db_cntysts == 'a') {
										$cntyactive = $srowscnty_mst['cntym_id'];
									}
									if ($db_cntysts == 'i') {
										$cntyinactive = $srowscnty_mst['cntym_id'];
									}
									if ($db_cntysts == 'u') {
										$cntyntverfy = $srowscnty_mst['cntym_id'];
									}
									$cntrec_cnty = $cntyactive + $cntyinactive + $cntyntverfy;
								}
							}
							echo "<li><a href='vw_all_county.php'>$cntrec_cnty - County </a><span>$cntyactive / $cntyinactive / $cntyntverfy</span> </li>";
							$sqrycty_mst = "select 
									count(ctym_id) as ctym_id,ctym_sts
								from
									cty_mst
								where
									ctym_name !=''	
								group by ctym_sts";
							$srscty_mst = mysqli_query($conn, $sqrycty_mst);
							$cntrec_cty = mysqli_num_rows($srscty_mst);
							$ctyactive = 0;
							$ctyinactive = 0;
							if ($cntrec_cty > 0) {
								while ($srowscty_mst = mysqli_fetch_assoc($srscty_mst)) {
									$db_ctysts = $srowscty_mst['ctym_sts'];
									if ($db_ctysts == 'a') {
										$ctyactive = $srowscty_mst['ctym_id'];
									}
									if ($db_ctysts == 'i') {
										$ctyinactive = $srowscty_mst['ctym_id'];
									}
									if ($db_ctysts == 'u') {
										$ctyntverfy = $srowscty_mst['ctym_id'];
									}
									$cntrec_cty = $ctyactive + $ctyinactive + $ctyntverfy;
								}
							}
							echo "<li><a href='vw_all_city.php'>$cntrec_cty - City </a><span>$ctyactive / $ctyinactive / $ctyntverfy</span> </li>";
							?>
						</ul>
					</div>
				</div> -->
				<div class="col-md-4">
					<div class="order lorangebg">
						<h2 class="order-heading">Enquiries<span></span></h2>
						<ul class="liboxes">
							<?php
							$sqrycrtord_mst = "select 
									count(crtordm_id) as crtordm_id
								from
									crtord_mst 
									inner join crtord_dtl on crtordd_crtordm_id = crtordm_id
								where
									crtordm_id !=''	
									group by crtordm_id";
							$srscrtord_mst = mysqli_query($conn, $sqrycrtord_mst);
							$cntrec_crtord = mysqli_num_rows($srscrtord_mst);
							echo "<li><a href='vw_all_orders.php'>$cntrec_crtord - Product Enquiries </a></li>";
							$sqrygnrlenqry_mst = "select 
									count(gnrlenqrym_id) as gnrlenqrym_id
								from
									gnrlenqry_mst 
								where
									gnrlenqrym_name !=''";
							$srsgnrlenqry_mst = mysqli_query($conn, $sqrygnrlenqry_mst);
							$cntrec_gnrlenqry = mysqli_num_rows($srsgnrlenqry_mst);
							$gnrlenqryactive = 0;
							$gnrlenqryinactive = 0;
							if ($cntrec_gnrlenqry > 0) {
								while ($srowsgnrlenqry_mst = mysqli_fetch_assoc($srsgnrlenqry_mst)) {
									$cntrec_gnrlenqry = $srowsgnrlenqry_mst['gnrlenqrym_id'];
									//$cntrec_gnrlenqry = $gnrlenqryactive + $gnrlenqryinactive;
								}
							}
							echo "<li><a href='vw_all_enquiry.php'>$cntrec_gnrlenqry - General Enquiries </a></li>";
							?>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div><!--close of row  -->
			<div class="footer black-txt">
				<?php include_once('../includes/inc_adm_footer.php'); ?>
			</div>
		</div> <!--close of container  -->
</body>

</html>