<?php

error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";  //path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Product List | Motor Station";
$page_seo_title = "Product List | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
$brand = $_REQUEST['vehbrnd'];
$veh_typ = $_REQUEST['type'];
// echo "<pre>";
// var_dump($_REQUEST);
// echo "</pre>";
?>
<?php
$sqlprod_mst = "SELECT prodm_vehtypm_id,prodm_id,prodm_name,prodm_brndm_id,prodm_code,prodm_sts,vehtypm_id,vehtypm_name,brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts,vehtypm_sts,prodimgd_prodm_id,prodimgd_id,prodimgd_sts,prodimgd_simg,prodimgd_bimg from prod_mst
	 LEFT join vehtyp_mst on vehtyp_mst.vehtypm_id=	prod_mst.prodm_vehtypm_id
	LEFT join brnd_mst on brnd_mst.brndm_id=prod_mst.prodm_brndm_id
	LEFT join  prodimg_dtl on  prodimg_dtl.prodimgd_prodm_id=prod_mst.prodm_id
where  prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and brndm_sts='a' ";

if (isset($_REQUEST['vehbrnd']) && (trim($_REQUEST['vehbrnd']) != "")) {
  $brand = glb_func_chkvl($_REQUEST['vehbrnd']);
  $brand1 = funcStrUnRplc($brand);
  $sqlprod_mst .= " and brndm_name='$brand1'";
}
if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) {
  $veh_typ = glb_func_chkvl($_REQUEST['type']);
  $veh_typ1 = funcStrUnRplc($veh_typ);
  $sqlprod_mst .= " and vehtypm_name='$veh_typ1' ";
}
$sqlprod_mst .= " group by prodm_id";
// where  prodm_id !='' and prodm_sts ='a' and vehtypm_sts='a' and brndm_sts='a' and vehtypm_name='$veh_typ' and brndm_name='$brand'
$rwsprod_mst = mysqli_query($conn, $sqlprod_mst);
$prdcnt = mysqli_num_rows($rwsprod_mst);
?>

<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?php echo $rtpth; ?>assets/img/inner-banner/products.jpg">
  <div class="container">
    <div class="row">
      <div class="col-xxl-12">
        <div class="page__title-wrapper mt-100">
          <div class="breadcrumb-menu">
            <ul>
              <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
              <?php if (isset($_REQUEST['type']) && (trim($_REQUEST['type']) != "")) { ?>
                <li><a href="<?php echo $rtpth.$veh_typ1; ?>"><span><?php echo $veh_typ; ?> Tyres</span></a></li>
              <?php } ?>

              <!-- <li><a href="<?php echo $rtpth; ?>brands"><span>Brands</span></a></li> -->
              <li><span><?php echo $brand1; ?></span></li>
            </ul>
          </div>
          <h3 class="page__title mt-20"><?php echo $brand1; ?></h3>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- slider-area-end -->

<?php
//echo  $sqlprod_mst;
if ($prdcnt > 0) { ?>
  <!-- blog__area start -->
  <section class="blog__area pt-90 pb-90 prdt-list">
    <div class="container">
      <div class="row ">
        <?php
        while ($rowsprods_mst = mysqli_fetch_assoc($rwsprod_mst)) {
          $prod_nm1 = $rowsprods_mst['prodm_name'];
          $prod_nm = funcStrRplc($prod_nm1);
          $prod_nm2 = funcStrUnRplc($prod_nm);
          $prod_code1 = $rowsprods_mst['prodm_code'];
          $prod_code = funcStrRplc($prod_code1);
          $vehname = $rowsprods_mst['vehtypm_name'];
          $vehname = funcStrRplc($vehname);
          $prod_id = $rowsprods_mst['prodm_id'];
          $prod_img = $rowsprods_mst['prodimgd_simg'];

          $vehprodimgpth = $u_gsml_fldnm . $prod_img;
          if ($prod_img != '' && file_exists($vehprodimgpth)) {
            $vehprodimgpth = $rtpth . $u_gsml_fldnm . $prod_img;
          } else {
            $vehprodimgpth = $rtpth . "products/no-img.png";
          }
          ?>
          
          <div class="col-xl-3 col-lg-3 col-md-4 col-6">
            <div class="blog__item-2 blog__item-2-df mb-lg-0 mb-md-0 mb-3">
              <div class="blog__item-2-image">
                <div class="blog__item-2-image-inner w-img pt-2">
                  <!-- <a href="<?php echo $rtpth; ?>product-display.php?type=<?php echo $veh_typ; ?>&vehbrnd=<?php echo $brand; ?>&prd_code=<?php echo $prod_code; ?>&prd_name=<?php echo $prod_nm; ?>&prd_id=<?php echo $prod_id; ?>"><img src="<?php echo $vehprodimgpth; ?>" alt=""></a> -->

                  <a href="<?php echo $rtpth . $vehname . "/" . $brand . "/" . $prod_code . "/" . $prod_nm . "/" . $prod_id; ?>"><img src="<?php echo $vehprodimgpth; ?>" alt=""></a>
                </div>
              </div>
              <div class="blog__item-2-content">
                <h5 class="blog__sm-title text-center"><a href="<?php echo $rtpth . $vehname . "/" . $brand . "/" . $prod_code . "/" . $prod_nm . "/" . $prod_id; ?>"><?php echo $prod_nm2; ?></a></h5>

                <div class="blog__meta">
                  <div class="blog__author">
                    <span>Code:</span>
                  </div>
                  <div class="blog__catagory">
                    <span><?php echo $prod_code1; ?></span>
                  </div>

                </div>
                <div class="blog__meta">
                  <div class="blog__author">
                    <span>Vehicle Type:</span>
                  </div>
                  <div class="blog__catagory">
                    <span><?php echo $vehname; ?></span>
                  </div>

                </div>
              </div>

              <div class="blog__btn-2">
                <a href="<?php echo $rtpth . $vehname . "/" . $brand . "/" . $prod_code . "/" . $prod_nm . "/" . $prod_id; ?>" class="link-btn"> Details <i class="fal fa-long-arrow-right"></i></a>

              </div>
            </div>
          </div>


        <?php }  ?>

      </div>
    </div>
  </section>
<?php } else {
  echo "No Products Found.";
}
?>
<!-- blog__area end -->


<?php include_once('footer.php'); ?>