<?php	
    error_reporting(0);
	include_once 'includes/inc_nocache.php'; // Clearing the cache information
	//include_once 'includes/inc_usr_functions.php';//Use function for validation and more
	include_once "includes/inc_connection.php";  
	include_once "includes/inc_folder_path.php"; //Including user session value
	include_once 'includes/inc_config.php'; 
	if(isset($_POST['btnfedenq']) && ($_POST['btnfedenq'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['txtemailid']) && ($_POST['txtemailid']) != ""){
	$name     = glb_func_chkvl($_POST['txtname']);
	$email     = glb_func_chkvl($_POST['txtemailid']);
	$phone    = glb_func_chkvl($_POST['txtphone']);
	$company    =  $_POST['txtcmpny'];
	$location      =  glb_func_chkvl($_POST['txtloc']);
   $desc   =  $_POST['txtdesc'];
		$curdt    =  date('Y-m-d h:i:s');
		$iqrycrtordmst = "INSERT into crtord_mst(crtordm_name,crtordm_adrs,crtordm_phno,crtordm_email,crtordm_cmpnynm,crtordm_qry,crtordm_sts,crtordm_prty,crtordm_crtdon,crtordm_crtdby) values('$name','$location','$phone','$email','$company','$desc','a',1,'$curdt','$email')";												  
		$irscrtordmst = mysqli_query($conn,$iqrycrtordmst) or die(mysqli_error($conn));	
		$cart_id=mysqli_insert_id($conn);
		//	$irsenq_mst = mysqli_query($conn,$iqryenq_mst);
		if($irscrtordmst == true)
		{
			if (isset($_SESSION['prodid']) && $_SESSION['prodid'] != "") 
			{
				$prodids = $_SESSION['prodid'];
				$prod_ids = explode(",",$prodids);
				$u_prd = array_unique($prod_ids);
				$i = 0;
				$message= "<table width='60%' border='0' align='center' cellpadding='3' cellspacing='2'>
								<tr>	
								<td colspan='3' align='center'><h1>Motorstation  -Product Enquiry Form</h1></td>
								</tr>				
									<tr>	
								<th bgcolor='#F5F5F5'>Product Image</th>
								<th  bgcolor='#F5F5F5'>Product code</th>
								<th  bgcolor='#F5F5F5'>Product Name</th>
								</tr>
								";
				while ($i < sizeof($u_prd)) 
				{
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
					}
					 else 
					 {
						$smlImgPth = $rtpth . 'products/no-img.png';
					}
					$crtsesval=md5($email);
		 	 $iqrycrtord_dtl  ="INSERT into crtord_dtl(crtordd_sesid,crtordd_prodm_id,crtordd_qty,crtordd_sts,crtordd_crtordm_id,crtordd_crtdon,crtordd_crtdby)values('$crtsesval','$prod_id',1,'a','	$cart_id','$curdt','$email')";
				$irscrtord	= mysqli_query($conn,$iqrycrtord_dtl) or die(mysqli_error($conn));	
						$message.="<tr>
						<td  bgcolor='#F0F0F0' ><img src=' $smlImgPth' width='100px' height='100px' /></td>
						<td  bgcolor='#F0F0F0' >Code: <b> $prod_code </b></td>
						<td  bgcolor='#F0F0F0' >Name: <b> $prod_nm </b></td>
					</tr>";
					
					$i++;
				}
				$message.= "<tr></tr>
									
								<tr>	
								<td  bgcolor='#F0F0F0'>Name</td>
								<td  bgcolor='#F0F0F0'>:</td>				
								<td  bgcolor='#F0F0F0'>".$name."</td>
								</tr>				  	
								<tr>
								<td bgcolor='#F0F0F0'>Email</td>
								<td bgcolor='#F0F0F0'>:</td>
								<td bgcolor='#F0F0F0'>".$email."</td>
								</tr>	
								<tr>
								<td bgcolor='#F0F0F0'>Phone</td>
								<td bgcolor='#F0F0F0'>:</td>						
								<td bgcolor='#F0F0F0'>".$phone."</td>
								</tr>
								<tr>
								<td bgcolor='#F0F0F0'>Company Name</td>
								<td bgcolor='#F0F0F0'>:</td>	
								<td bgcolor='#F0F0F0'>".$company."</td>
								</tr>
								<tr>
								<td bgcolor='#F0F0F0'>Location*</td>
								<td bgcolor='#F0F0F0'>:</td>	
								<td bgcolor='#F0F0F0'>$location</td>
								</tr>
								
								</table>";
								//echo $message;exit;
								$u_prjct_email_info='motorstation81@yahoo.in';
							$fromemail = $u_prjct_email_info;
							$to = $u_prjct_email_info;
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= "From: $fromemail" . "\r\n";
							$subject = "Product Enquiry Form";
							if (mail($to, $subject, $message, $headers))
							{
								?>
								<script>
								location.href='thankyou.php';
							</script>
							<?php
							}
							else
							{
								?>
								<script>
								location.href='error.php';
							</script>
							<?php
							}
							$gmsg = "Record saved successfully";
							}
						
							unset($_SESSION['prodid']);
						}
			}

			else{
				$gmsg = "Record not saved";
			}
?>
