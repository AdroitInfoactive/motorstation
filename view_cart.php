<?php
error_reporting(0);
session_start();
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Feedback | Motor Station";
$page_seo_title = "Feedback | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
if (isset($_POST['btnfedenq']) && ($_POST['btnfedenq'] != "") && isset($_POST['txtname']) && ($_POST['txtname'] != "") &&
	isset($_POST['txtemailid']) && ($_POST['txtemailid'] != "")
) {

	 include_once "database/iqr_prod_enqry.php";
}

include_once('includes/inc_fnct_ajax_validation.php');
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
 //unset($_SESSION['prodid']);
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
							<li><span>Enquiry Products</span></li>
						</ul>
					</div>
					<h3 class="page__title mt-20">Enquiry Products</h3>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
if (isset($_SESSION['prodid']) && $_SESSION['prodid'] != "") {
	$prodids = $_SESSION['prodid'];
	$prod_ids = explode(",", $prodids);
	$u_prd = array_unique($prod_ids);
?>
	<section class="contact__area-2 pt-90 pb-90">
		<div class="container">
		<form name="frmenqprod" id="frmenqprod" method="post" action="" onSubmit="return performCheck('frmenqprod', rules_1, 'inline');">
				<div class="contact__form grey-bg-8 black-bg-3">
					<div class="container">
						<div class="row">

							<div class="col-xl-12">

								<div class='table-responsive'>
									<table border='0' cellpadding='0' cellspacing='0' class='table table table-condensed table-bordered'>
										<thead>
											<tr bgcolor="#f1f1f1">
												<?php /*?> <th width='6%'  >SL.No.</th><?php */ ?>
												<th width='10%'>Product Image</th>
												<th width='10%'>Product Code</th>
												<?php /*?> <th width='15%'  >Product Name</th>	<?php */ ?>
												<th width='10%'>Remove</th>
											</tr>
										</thead>
										<?php
										$i = 0;
										while ($i < sizeof($u_prd)) {
											$sqlprod_mst = "SELECT prodm_vehtypm_id,prodm_id,prodm_name,prodm_brndm_id,prodm_code,prodm_sts,vehtypm_id,vehtypm_name,brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts,vehtypm_sts,prodimgd_prodm_id,prodimgd_id,prodimgd_sts,prodimgd_simg,prodimgd_bimg,prodm_descone,prodm_desctwo from prod_mst
					LEFT join vehtyp_mst on vehtyp_mst.vehtypm_id=	prod_mst.prodm_vehtypm_id
					LEFT join brnd_mst on brnd_mst.brndm_id=prod_mst.prodm_brndm_id
					LEFT join  prodimg_dtl on  prodimg_dtl.prodimgd_prodm_id=prod_mst.prodm_id
				where prodm_sts ='a' and prodm_id='$u_prd[$i]' group by prodm_id";
											$rwsprod_mst = mysqli_query($conn, $sqlprod_mst);
											$prdcnt = mysqli_num_rows($rwsprod_mst);
											$rowsprods_mst = mysqli_fetch_assoc($rwsprod_mst);
											$prod_nm = $rowsprods_mst['prodm_name'];
											$prod_id = $rowsprods_mst['prodm_id'];
											$prod_code = $rowsprods_mst['prodm_code'];
											$smlImgNm = $rowsprods_mst['prodimgd_simg'];
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
											<tr>
												<?php /*?> <th width='6%'  ><?php echo $i;?></th><?php */ ?>
												<td width='10%'><img src='<?php echo $smlImgPth; ?>' width="78" height="78" border="0" alt="" /></td>
												<td width='10%'>Name: <b><?php echo $prod_nm . "</b><br>Code: <b>" . $prod_code; ?></b></td>
												<?php /*?> <th width='15%'  ><?php echo $items['name'];?></th>		<?php */ ?>
												<td width='10%'><a href='' onclick="del_crt_prdt(<?php echo $prod_id; ?>)"><i class="fa fa-remove"></i></a></td>
											</tr>
										<?php
											$i++;
										}
										?>
									</table>
									<div class='clearfix'></div>
									<ul class='list-inline text-right'>
										<li>
										<li><a href='<?php echo $rtpth; ?>home' class='tp-btn'>Add Product</a></li>
									</ul>
								</div>


								<div class="row">
									<div class="col-lg-4 col-md-4">
										<div class="contact-filed mb-20">
										<input type="text" name="txtname" id="txtname" placeholder="Your Name">
                                        <span id="errorsDiv_txtname" style="color:red"></span>
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="contact-filed contact-icon-mail mb-20">
										<input email="text" name="txtemailid"  id="txtemailid" placeholder="Your Email Id">
                                        <span id="errorsDiv_txtemailid" style="color:red"></span>
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="contact-filed contact-icon-call mb-20">
										<input type="text" name="txtphone" id="txtphone" placeholder="Your Phone Number">
                                        <span id="errorsDiv_txtphone" style="color:red"></span>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-lg-4 col-md-4">
										<div class="contact-filed cpname mb-20">
										<input type="text" name="txtcmpny" id="txtcmpny" placeholder="Company Name">
                                        <span id="errorsDiv_txtcmpny" style="color:red"></span>
										</div>
									</div>
									<div class="col-lg-8 col-md-8">
										<div class="contact-filed locate mb-20">
										<input type="text" name="txtloc" id="txtloc" placeholder="Location">
                                        <span id="errorsDiv_txtloc" style="color:red"></span>
										</div>
									</div>

								</div>


								<div class="contact-filed contact-icon-message mb-20">
                                <textarea placeholder="Enter message here" name="txtdesc" id="txtdesc"></textarea>
                            </div>


								<div class="form-submit d-flex justify-content-end align-items-center">
							
									<input type="submit" class="tp-btn" name="btnfedenq" id="btnfedenq" value="Submit">
                                <input type="reset" class="tp-btn-d ms-3" value="Reset">
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>
		</div>
		
	</section>


<?php
} else { ?>
	<script>
		location.href = "<?php echo $rtpth; ?>home";
	</script>
<?php
} ?>


<!-- contact__area-2 end -->
<?php include_once('footer.php'); ?>
<script type="text/javascript">
	function del_crt_prdt(prodid) {
		if (prodid != "") {
			var url = "add_crt.php?prodid=" + prodid + "&typ=d";
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
	}

	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			// document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != "") {
				alert(temp);
				if (temp == 'y') {
					location.reload();
				} else {
					alert("Cannot Enquire this product. Please try again later.");
					location.reload();
				}
				// document.getElementById('txtname').focus();
				// add redirect here
			}
		}
	}
</script>
<script language="javascript" src="includes/yav.js"></script>
<script language="javascript" src="includes/yav-config.js"></script>
<script language="javascript" type="text/javascript">
	var rules_1 = new Array();

	rules_1[0] = 'txtname:Name|required|Enter Name';
	rules_1[1] = 'txtemailid:Email|required|Enter email id';
	rules_1[2] = 'txtphone:Phone|required|Enter Phone Number';
	rules_1[3] = 'txtphone:Phone|numeric|Enter Only Numbers';
	rules_1[4] = 'txtcmpny:company|required|Enter Company Name';
  rules_1[5] = 'txtloc:location|required|Enter Your Location';
	rules_1[6] = 'txtemailid:Email|email|Enter  valid email id';
	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>