<?php	
	include_once  "../includes/inc_nocache.php";     //Clearing the cache information
	include_once "../includes/inc_adm_session.php";  //checking for session
	include_once "../includes/inc_connection.php";   //Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	
	if(isset($_POST['btnupd']) && 
		isset($_POST['hdnordsts']) && (trim($_POST['hdnordsts']) != "") &&
		isset($_POST['hdnord']) && (trim($_POST['hdnord']) != "") &&
		isset($_POST['txtdt']) && (trim($_POST['txtdt']) != "")){
		$orderid    = glb_func_chkvl($_POST['hdnord']);
		$desc       = addslashes(trim($_POST['txtdesc']));
		$stsdt      = glb_func_chkvl($_POST['txtdt']);
		//echo  $stsdt    	= dateFormat('Y-m-d h:i:s', strtotime($sdate));
		
		$stsid		= glb_func_chkvl($_POST['ordsts']);
		$crnt_dt         = date('Y-m-d h:i:s');		
		$cstsprty   = glb_func_chkvl($_POST['hdnordsts']);
        $sqryordsts_mst  ="SELECT 
			                  ordstsd_id,ordstsd_dttm 
						   FROM 
						  	  ordsts_dtl
					       WHERE 
							  ordstsd_ordstsm_id='$stsid' AND
							  ordstsd_crtordm_id='$orderid' AND
							  ordstsd_dttm='$stsdt'
						   ORDER BY
						   	  ordstsd_id desc limit 0,1";						  
		$srsordsts_mst   = mysqli_query($conn,$sqryordsts_mst);
		$rowsordsts_mst  = mysqli_num_rows($srsordsts_mst);		
		if($rowsordsts_mst < 1){
			$uqryordsts_dtl= "UPDATE 
								ordsts_dtl 
							  SET 
								ordstsd_sts = 'd',	
								ordstsd_crtdon	= '$crnt_dt',
								ordstsd_crtdby	= '$s_admin'						  								
							  WHERE 
								ordstsd_ordstsm_id='$stsid' AND 
							  	ordstsd_crtordm_id='$orderid'";
			 $srsordsts_dtl	= 	mysqli_query($conn,$uqryordsts_dtl);	
			 		
			 $iqryordsts_mst="INSERT INTO ordsts_dtl(
							  ordstsd_ordstsm_id,ordstsd_crtordm_id,
							  ordstsd_dttm,ordstsd_desc,
							  ordstsd_crtdon,ordstsd_crtdby)VALUES(
							  '$stsid','$orderid','$stsdt','$desc',
							  '$crnt_dt','$s_admin')";
			 $irsordsts_mst= mysqli_query($conn,$iqryordsts_mst);
			 if($irsordsts_mst==true){							
				$sqryordsts_mst  ="SELECT 
								  ordstsm_name,ordstsm_desc
							   FROM 
								  ordsts_mst
							   WHERE 
								  ordstsm_id='$stsid'";
				$srsordsts_mst   = mysqli_query($conn,$sqryordsts_mst);
				$srowordsts_mst   = mysqli_fetch_assoc($srsordsts_mst);
				$db_ordstsnm = $srowordsts_mst['ordstsm_name'];
				$db_ordstsdesc = $desc;
				$hdimg    = "http://".$u_prjct_mnurl."/images/gifts-n-greets-logo.png";//Return the URL	
				$sqrycrtord_mst = "select
									crtordm_id,crtordm_code,crtordm_fstname,crtordm_lstname, 
									crtordm_badrs,crtordm_badrs2,blcty.ctym_name as bctynm,blcnty.cntym_name as bcntynm,
									crtordm_bzip,blcntry.cntrym_name as bcntrynm,crtordm_bdayphone,
									crtordm_emailid,crtordm_sfstname,crtordm_slstname,crtordm_sadrs,
									crtordm_sadrs2,shpcty.ctym_name as sctynm, shpcnty.cntym_name as scntynm,
									crtordm_szip,shpcntry.cntrym_name as scntrynm,
									crtordm_sdayphone,crtordm_semailid,crtordm_qty,crtordm_amt,crtordm_wt,
									crtordm_pmode,crtordm_prcssts,crtordm_cartsts,crtordm_paysts,crtordm_rmks,
									crtordm_shpchrgm_id,crtordm_shpchrgamt,crtordm_cpnm_val,crtordm_mbrm_id,
									crtordm_ordtyp,date_format(crtordm_crtdon,'%d-%m-%Y') as crtordm_crtdon_dt,
									date_format(crtordm_crtdon,'%h:%i:%s') as crtordm_crtdon_tm									
							  from
									crtord_mst crtord 
									left join cty_mst blcty on blcty.ctym_id = crtord.crtordm_bmbrctym_id
									left join cty_mst shpcty on shpcty.ctym_id = crtord.crtordm_smbrctym_id 
									
									left join cnty_mst blcnty on blcnty.cntym_id = blcty.ctym_cntym_id 
									left join cnty_mst shpcnty on shpcnty.cntym_id = shpcty.ctym_cntym_id
									
									inner join cntry_mst blcntry on blcntry.cntrym_id= blcnty.cntym_cntrym_id 
									left join cntry_mst shpcntry on shpcntry.cntrym_id= shpcnty.cntym_cntrym_id										
								where 
									crtordm_id = '$orderid'";
								
					$srscrtord_mst = mysqli_query($conn,$sqrycrtord_mst);
					$cntord_rec	   = mysqli_num_rows($srscrtord_mst);
				
					if($cntord_rec > 0){			
						$srowcrtord_mst = mysqli_fetch_assoc($srscrtord_mst);
						
						$crtord_id		= $srowcrtord_mst['crtordm_id'];											
								$bfname  = $srowcrtord_mst['crtordm_fstname'];
								$blname	  = $srowcrtord_mst['crtordm_lstname'];	
								$bemail  = $srowcrtord_mst['crtordm_emailid'];
								$ordcode = $srowcrtord_mst['crtordm_code'];
								$ordmid	 =  base64_encode($srowcrtord_mst['crtordm_id']);
								$orddate = $srowcrtord_mst['crtordm_crtdon_dt']." ".$srowcrtord_mst['crtordm_crtdon_tm'];	 
								$shipname = $srowcrtord_mst['shpchrgm_name'];	 
								$shpprc  = $srowcrtord_mst['crtordm_shpchrgamt'];
								$sfname   = $srowcrtord_mst['crtordm_sfstname'];	 
								$slname	  = $srowcrtord_mst['crtordm_slstname'];	 			   
								$sadrs	  = $srowcrtord_mst['crtordm_sadrs'];
								$sadrs2   = $srowcrtord_mst['crtordm_sadrs2'];
								$scty 	  = $srowcrtord_mst['sctynm'];
								$scounty  = $srowcrtord_mst['scntynm'];
								$scountry = $srowcrtord_mst['scntrynm'];
								$badrs	  = $srowcrtord_mst['crtordm_badrs'];
								$badrs2   = $srowcrtord_mst['crtordm_badrs2'];
								$bcty 	  = $srowcrtord_mst['bctynm'];
								$bcounty  = $srowcrtord_mst['bcntynm'];
								$bcountry = $srowcrtord_mst['bcntrynm'];
								$bzip	  = $srowcrtord_mst['crtordm_bzip'];		
								$bemail	  = $srowcrtord_mst['crtordm_emailid'];
								$bphno	  = $srowcrtord_mst['crtordm_bdayphone'];
								$szip	  = $srowcrtord_mst['crtordm_szip'];		
								$semail	  = $srowcrtord_mst['crtordm_semailid'];	
								$sphno	  = $srowcrtord_mst['crtordm_sdayphone'];
								$ordamt	  = $srowcrtord_mst['crtordm_amt'];
								$shipprc	  = $srowcrtord_mst['crtordm_shpchrgamt'];
								$crtwt	  = $srowcrtord_mst['crtordm_wt'];
								$totcrtprc = $ordamt + $shipprc;
								$db_pmode = funcPayMod($srowcrtord_mst['crtordm_pmode']);
								$db_psts = funcDispCrnt($srowcrtord_mst['crtordm_paysts']);
								$db_ordqty	  = $srowcrtord_mst['crtordm_qty'];
								$db_ordamt	  = $srowcrtord_mst['crtordm_amt'];
								$db_ordrmks	  = $srowcrtord_mst['crtordm_rmks'];
								
								$dispsy    =db_psts;
								$shpcmpltadrs ="";
								if($bemail != ''){
									$shpcmpltadrs = $bemail;	
								}
								if($sfname != ''){
									$shpcmpltadrs .= "<br/>".$sfname;	
								}						 
								if($slname != ''){
									$shpcmpltadrs .= "&nbsp;".$slname;	
								}
								if($sadrs != ''){
									$shpcmpltadrs .= "<br>".$sadrs;	
								}						 
								if($sadrs2 != ''){
									$shpcmpltadrs .= ",&nbsp;".$sadrs2;	
								}						 
								if($scty != ''){
									$shpcmpltadrs .= "<br>".$scty;	
								}						 
								if($scounty != ''){
									$shpcmpltadrs .= ",&nbsp;".$scounty;	
								}						 
								if($scountry != ''){
									$shpcmpltadrs .= "<br>".$scountry;	
								}						 
								if($szip != ''){
									$shpcmpltadrs .= ",&nbsp;Zip Code :&nbsp;".$szip;	
								}
								if($sphno != ''){
									$shpcmpltadrs .= "<br>Mobile No :&nbsp;".$sphno;	
								}	
								
								$blngcmpltadrs ="";
								if($bemail != ''){
									$blngcmpltadrs = $bemail;	
								}
								if($bfname != ''){
									$blngcmpltadrs .= "<br/>".$bfname;	
								}						 
								if($blname != ''){
									$blngcmpltadrs .= "&nbsp;".$blname;	
								}						 
								if($badrs != ''){
									$blngcmpltadrs .= "<br>".$badrs;	
								}						 
								if($badrs2 != ''){
									$blngcmpltadrs .= ",&nbsp;".$badrs2;	
								}						 
								if($bcty != ''){
									$blngcmpltadrs .= "<br>".$bcty;	
								}						 
								if($bcounty != ''){
									$blngcmpltadrs .= ",&nbsp;".$bcounty;	
								}						 
								if($bcountry != ''){
									$blngcmpltadrs .= "<br>".$bcountry;	
								}						 
								if($bzip != ''){
									$blngcmpltadrs .= ",&nbsp;Zip Code :&nbsp;".$bzip;	
								}
								if($bphno != ''){
									$blngcmpltadrs .= "<br>Mobile No :&nbsp;".$bphno;	
								}	   
								$orddate	= date('l jS F Y',strtotime($orddate));												
							    $stsdate	= date('l jS F Y',strtotime($stsdt));	
						
						$msgbody="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
					<html>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					<title>$usr_cmpny | Order Information</title>
					<style type='text/css'>
					#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}
					</style>
					</head>
					<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
					<div style='background-color:#fff;'>
					  <table style='background-color: #ffffff;' width='100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
						  <td><table style=' background-color:#ffffff' background='#ffffff' width='605' border='0' align='center' cellpadding='20' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><table width='181' border='0' align='left' cellpadding='0' cellspacing='0'>
									<tr>
									  <td valign='top' align='center' bgcolor='#FFFFFF'><a href='".$rtpth."home' ><img src='".$hdimg."' alt='$usr_cmpny'  border='0'></a></td>
									</tr>
								  </table></td>
							  </tr>
							</table>
							<table style='background-color:#ffffff;padding:0' background='#ffffff' width='605' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><h1 style='margin-top:5px; margin-bottom:5px; font-family: Georgia, 'Times New Roman', Times, serif; font-size:30px'>$usr_cmpny</h1>
								  <h2 style='margin-top:5px; margin-bottom:5px; font-family:Arial, Helvetica, sans-serif;font-size:25px'>Order Information</h2></td>
							  </tr>
							  <tr>
								<td height='4' valign='top' bgcolor='#cccccc' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
							  <tr>
								<td height='10' valign='top' bgcolor='#fff' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Dear $bfname,</p>
								  <p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Thank you for your order $db_ordstsnm: on " .$stsdate. ".</p>
								  <p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>
									If   you have any queries about your order, kindly contact our <a href='".$rtpth."contact-us' target='_blank' style='color:#ff6600; text-decoration:none'>Customer Care</a></p></td>
							  </tr>
							</table>
					  <table align='center' width='605' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='background-color:#ffffff'>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>$desc</td>
								</tr>
									
							</table>
						</div>
						</body>
						</html>";
						
						$to       = $bemail;
						$from     =  $u_prjct_email;
						$subject  = "Your $usr_cmpny Order " .$ordcode." has been Placed";
						$headers  = "From: " . $from . "\r\n";
						$headers .= "CC: ".$from ."\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						mail($to,$subject,$msgbody,$headers);
						//echo $msgbody;
					}	
				$gmsg = "Record Updated successfully";
			 }
       }
	   else{		
			$gmsg = "Duplicate name. Record not updated";
	   }
   }
?>