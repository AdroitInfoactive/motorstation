<?php
error_reporting(0);

include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php';//checking for session
include_once '../includes/inc_connection.php';//Making database Connection
include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
include_once '../includes/inc_config.php';
include_once "../includes/inc_folder_path.php";	

$page_seo_title = "Product Display | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";

$prd_code = $_REQUEST['prod_code_val'];

 $sqlprod_mst = "SELECT prodm_vehtypm_id,prodm_id,prodm_name,prodm_brndm_id,prodm_code,prodm_sts,vehtypm_id,vehtypm_name,brndm_id,brndm_name,brndm_img,brndm_zmimg,brndm_sts,vehtypm_sts,prodimgd_prodm_id,prodimgd_id,prodimgd_sts,prodimgd_simg,prodimgd_bimg,prodm_descone,prodm_desctwo from prod_mst
	 LEFT join vehtyp_mst on vehtyp_mst.vehtypm_id=	prod_mst.prodm_vehtypm_id
	LEFT join brnd_mst on brnd_mst.brndm_id=prod_mst.prodm_brndm_id
	LEFT join  prodimg_dtl on  prodimg_dtl.prodimgd_prodm_id=prod_mst.prodm_id
  where 
		prodm_id =$prd_code and prodm_sts ='a' and vehtypm_sts='a' and brndm_sts='a'  and prodm_code!=''   group by  prodm_id ";

$rwsprod_mst = mysqli_query($conn, $sqlprod_mst);
$prdcnt = mysqli_num_rows($rwsprod_mst);
$rowsprods_mst = mysqli_fetch_assoc($rwsprod_mst);
$prod_nm = $rowsprods_mst['prodm_name'];
					$prod_id = $rowsprods_mst['prodm_id'];
					$prod_code = $rowsprods_mst['prodm_code'];
					$vehname = $rowsprods_mst['vehtypm_name'];
					$prod_desc1 = $rowsprods_mst['prodm_descone'];
					$prod_desc2 = $rowsprods_mst['prodm_desctwo'];
                    $smlImgNm = $rowsprods_mst['prodimgd_simg'];
                    $prod_brnd = $rowsprods_mst['brndm_name'];
                    if ($smlImgNm != "") {
                        $smlImgPth = $u_gsml_fldnm1 . $smlImgNm;
                        if (file_exists($smlImgPth)) {
                            $smlImgPth =$u_gsml_fldnm1 . $smlImgNm;
                        } else {
                            $smlImgPth = '../products/no-img.png';
                        }
                    } else {
                        $smlImgPth = '../products/no-img.png';
                    }
?>
<link rel="stylesheet" href="css/prod_img.css">	
<h2 style="text-align:center">Product Image Description</h2>
<!-- <div style="text-align:center"> -->
<div class="card">
  <img src="<?php echo $smlImgPth;?>" alt="Denim Jeans" style="width:100%">
  <h1><?php echo $prod_nm;?></h1>

  <p class="price"><b> Product Code: </b><?php echo $prod_code;?></p>
   <p class="price"><b> Product Brand: </b><?php echo $prod_brnd;?></p>
   <p class="price"><b> Vehicle Type: </b><?php echo $vehname;?></p>
  <p  class="price"><b> Product Description: </b><?php echo $prod_desc1;?></p>
  <p  class="price"><b> Product Specifications:</b> <?php echo $prod_desc2;?></p>

<!-- </div> -->
</div>



				
		
					
