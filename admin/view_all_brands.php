<?php
error_reporting(0);
include_once '../includes/inc_nocache.php'; //Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once '../includes/inc_paging_functions.php'; //Making paging validation
include_once '../includes/inc_config.php'; //Making paging validation
include_once '../includes/inc_folder_path.php'; //Floder Path
/***************************************************************/
//Programe 	  	: view_all_brands.php
//Created By    	: Mallikarjuna
//Created On    	:	16/04/2013
//Modified By   	: Aradhana
//Modified On   	: 07-06-2014
//Company 	  	: Adroit
/***************************************************************/
global $fldnm,$loc;

$fldnm = $gbrnd_upldpth;
if (
	($_POST['hidchksts'] != "") && isset($_REQUEST['hidchksts']) ||
	isset($_REQUEST['hdnallval']) && (trim($_REQUEST['hdnallval']) != "")
) {
	$dchkval = substr($_POST['hidchksts'], 1);
	$id = glb_func_chkvl($dchkval);
	$chkallval = $_REQUEST['hdnallval'];
	$updtsts = funcUpdtAllRecSts($conn,'brnd_mst', 'brndm_id', $id, 'brndm_sts', $chkallval);
	if ($updtsts == 'y') {
		$msg = "<font color=red>Record updated successfully</font>";
	} elseif ($updtsts == 'n') {
		$msg = "<font color=red>Record not updated</font>";
	}
}
if (($_POST['hidchkval'] != "") && isset($_REQUEST['hidchkval'])) {
	$dchkval = substr($_POST['hidchkval'], 1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',', $did);
	$count = sizeof($del);
	$img = array();
	$imgpth = array();
	$zimg = array();
	$zimgpth = array();
	for ($i = 0; $i < $count; $i++) {
		$sqrybrnd_mst = "select 
			                       brndm_img,brndm_zmimg
							    from 
					               brnd_mst
					            where
					                brndm_id=$del[$i]";
		$srsbrnd_mst = mysqli_query($conn, $sqrybrnd_mst);
		$srowbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst);
		$img[$i] = glb_func_chkvl($srowbrnd_mst['brndm_img']);
		$imgpth[$i] = $fldnm . $img[$i];
		$zimg[$i] = glb_func_chkvl($srowbrnd_mst['brndm_zmimg']);
		$zimgpth[$i] = $fldnm . $zimg[$i];
	}
	$delsts = funcDelAllRec($conn,'brnd_mst', 'brndm_id', $did);
	if ($delsts == 'y') {
		for ($i = 0; $i < $count; $i++) {
			if (($img[$i] != "") && file_exists($imgpth[$i])) {
				unlink($imgpth[$i]);
			}
			if (($zimg[$i] != "") && file_exists($zimgpth[$i])) {
				unlink($zimgpth[$i]);
			}
		}
		$msg = "<font color=red>Record deleted successfully</font>";
	} elseif ($delsts == 'n') {
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
	$msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
	$msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20; //maximum rows per page
include_once '../includes/inc_paging1.php'; //Includes pagination	
$rqst_stp = $rqst_arymdl[0];
$rqst_stp_attn = explode("::", $rqst_stp);
$sesvalary = explode(",", $_SESSION['sesmod']);
if (!in_array(1, $sesvalary)) {
	if ($ses_admtyp != 'a') {
		header("Location:main.php");
		exit();
	}
}
/*$rqst_stp      	= $rqst_arymdl[1];
 $rqst_stp_attn     = explode("::",$rqst_stp);
 $rqst_stp_chk      	= $rqst_arymdl[0];
 $rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
 if($rqst_stp_attn_chk[0] =='2'){
	 $rqst_stp      	= $rqst_arymdl[0];
	 $rqst_stp_attn     = explode("::",$rqst_stp);
 }
 $sesvalary = explode(",",$_SESSION['sesmod']);
 if(!in_array(2,$sesvalary)){
	 if($ses_admtyp !='a'){
		 header("Location:main.php");
		 exit();
	 }
 }*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>
		<?php echo $pgtl; ?>
	</title>
	<?php include_once 'script.php'; ?>
	<script language="javascript">
		function addnew() {
			document.frmbrnd.action = "add_brand.php";
			document.frmbrnd.submit();
		}
	</script>
	<script language="javascript">
		function validate() {
			//alert("");  
			var urlval = "";
			if ((document.frmbrnd.txtsrchval.value == "")) {
				alert("Select Search Criteria");
				document.frmproductcat.txtsrchval.focus();
				return false;
			}
			var txtsrchval = document.frmbrnd.txtsrchval.value;
			//var lstcatid   = document.frmproductcat.lstcatid.value;
			//var lsttypid   = document.frmproductcat.lstsrchdlvrtyp.value;
			if (txtsrchval != '') {
				urlval += "txtsrchval=" + txtsrchval;
			}
			if (document.frmbrnd.chkexact.checked == true) {
				document.frmbrnd.action = "view_all_brands.php?" + urlval + "&chkexact=y";
				document.frmbrnd.submit();
			}
			else {
				document.frmbrnd.action = "view_all_brands.php?" + urlval;
				document.frmbrnd.submit();
			}
			return true;
		}
	</script>
	<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
	</script>
</head>

<body onLoad="onload()">
	<?php include_once('../includes/inc_adm_header.php');
	include_once('../includes/inc_adm_leftlinks.php');
	?>
	<table width="977" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admcnt_bdr">
					<tr>
						<td width="7" height="30" valign="top"></td>
						<td width="700" height="325" rowspan="2" valign="top" bgcolor="#FFFFFF" class="contentpadding"
							style="background-position:top; background-repeat:repeat-x; ">
							<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" name="frmbrnd" id="frmbrnd">
								<input type="hidden" name="hidchkval" id="hidchkval">
								<input type="hidden" name="hidchksts" id="hidchksts">
								<input type="hidden" name="hdnallval" id="hdnallval">
								<table width="100%" border="0" cellspacing="0" cellpadding="5">
									<tr align="left" class='white'>
										<td height="30" colspan="5" bgcolor="#FA6138">
											<span class="heading"><strong>Brands </strong></span>&nbsp;&nbsp;&nbsp;
										</td>
									</tr>
									<tr>
									<tr>
										<td width="91%">
											<table width="100%">
												<td width="91%">
													<table width="100%">
														<tr>
															<td width='20%'><strong> Name</strong></td>
															<td width="40%">
																<input type="text" name="txtsrchval"
																	value="<?php if (isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval'] != "") {
																		echo $_REQUEST['txtsrchval'];
																	} ?>"
																	id="txtsrchval">
															</td>
															<td colspan='2' align="center">
																Exact
																<input type="checkbox" name="chkexact" value="y" <?php
																if (isset($_REQUEST['chkexact']) && (glb_func_chkvl($_REQUEST['chkexact']) == 'y')) {
																	echo 'checked';
																}
																?> id="chkexact">
																<input type="submit" value="Search" name="btnsbmt" onClick="validate();">
																<a href="view_all_brands.php" class="leftlinks"><strong>Refresh</strong></a>
															</td>
														</tr>
													</table>
												</td>
											</table>
										</td>
										<td width="9%" align="left">
											<?php
											 //if(($rqst_stp_attn[1]=='2') || ($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
											 //f(($rqst_stp_attn[1]=='2') || ($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
												?>
											<input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">
											<?php
											//}
											?>
										</td>
									</tr>
								</table>
								<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
									<tr>
										<td bgcolor="#FFFFFF" colspan="5">&nbsp;</td>
										<?php
										//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
										?>
										<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
											<div align="right">
												<input name="btnsts" id="btnsts" type="button" value="Status"
													onClick="updatests('hidchksts','frmbrnd','chksts','hdnallval')">
											</div>
										</td>
										<?php
										//}
										//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
										?>
										<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
											<div align="right">
												<input name="btndel" id="btndel" type="button" value="Delete"
													onClick="deleteall('hidchkval','frmbrnd','chkdlt');">
											</div>
										</td>
										<?php
										//}
										?>
									</tr>
									<tr class='white'>
										<td width="11%" bgcolor="#FF543A"><strong>S.No.</strong></td>
										<td width="33%" bgcolor="#FF543A"><strong>Name</strong></td>
										<td width="25%" bgcolor="#FF543A" align="center"><strong>Logo</strong></td>
										<td width="10%" bgcolor="#FF543A" align="center"><strong>Rank</strong></td>
										<?php
										//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
										?>
										<td width="7%" bgcolor="#FF543A" align="center"><strong>Edit</strong></td>
										<td width="7%" bgcolor="#FF543A" align="center"><strong>
												<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"
													onClick="Check(document.frmbrnd.chksts,'Check_ctr','hdnallval')"></strong></td>
										<?php
										//}
										//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
										?>
										<td width="7%" bgcolor="#FF543A" align="center"><strong>
												<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes"
													onClick="Check(document.frmbrnd.chkdlt,'Check_dctr')"><b></b>
											</strong></td>
										<?php
										//}
										?>
									</tr>
									<?php
									$sqrybrnd_mst1 = "select
				                   brndm_id,brndm_name,brndm_img,brndm_sts,
				                   brndm_prty 
								from
								   brnd_mst";
									if (isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) != '') {
										$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
										$loc .= "&txtsrchval=" . $txtsrchval;
										$fldnm = " where brndm_name";
										if (isset($_REQUEST['chkexact']) && $_REQUEST['chkexact'] == 'y') {
											$loc .= "&chkexact=y";
											$sqrybrnd_mst1 .= " $fldnm ='$txtsrchval'";
										} else {
											$sqrybrnd_mst1 .= " $fldnm like '%$txtsrchval%'";
										}
									}
									$sqrybrnd_mst = $sqrybrnd_mst1 . " order by brndm_name
							                         limit $offset,$rowsprpg";
									$srsbrnd_mst = mysqli_query($conn, $sqrybrnd_mst);
									$cnt = $offset;
									$serchres = mysqli_num_rows($srsbrnd_mst);
									if ($serchres == '0') {
										$msg = "<font color=red>Record  Not  Found </font>";
									}
									while ($srowbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst)) {
										$cnt += 1;
										?>
										<tr <?php if ($cnt % 2 == 0) {
											echo "bgcolor='f9f8f8'";
										} else {
											echo "bgcolor='#F2F1F1'";
										} ?>>
											<td align="left" valign="top">
												<?php echo $cnt; ?>
											</td>
											<td align="left" valign="top">
												<a href="view_brands_detail.php?vw=<?php echo $srowbrnd_mst['brndm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
													class="leftlinks"><?php echo $srowbrnd_mst['brndm_name']; ?></a>
											</td>
											<td align="center" valign="top">
												<?php
												$imgnm = $srowbrnd_mst['brndm_img'];
												$imgpath = $fldnm . $imgnm;
												if (($imgnm != "") && file_exists($imgpath)) {
													echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
												} else {
													echo "Image not available";
												}
												?>
											</td>
											<td align="right" valign="top">
												<?php echo $srowbrnd_mst['brndm_prty']; ?>
											</td>
											<?php
											//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
											?>
											<td align="center" valign="top">
												<a href="edit_brand.php?edit=<?php echo $srowbrnd_mst['brndm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
													class="leftlinks">Edit</a>
											</td>
											<td align="center">
												<input type="checkbox" name="chksts" id="chksts" value="<?php echo $srowbrnd_mst['brndm_id']; ?>"
													<?php if ($srowbrnd_mst['brndm_sts'] == 'a') {
														echo "checked";
													} ?>
													onClick="addchkval(<?php echo $srowbrnd_mst['brndm_id']; ?>,'hidchksts','frmbrnd','chksts');">
											</td>
											<?php
											//}
											//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
											?>
											<td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $srowbrnd_mst['brndm_id']; ?>">
											</td>
											<?php
											//}
											?>
										</tr>
										<?php
									}
									?>
									<tr>
										<td bgcolor="#FFFFFF" colspan="5">&nbsp;</td>
										<?php
										//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
										?>
										<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
											<div align="right">
												<input name="btnsts" id="btnsts" type="button" value="Status"
													onClick="updatests('hidchksts','frmbrnd','chksts','hdnallval')">
											</div>
										</td>
										<?php
										//}
										//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
										?>
										<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF">
											<div align="right">
												<input name="btndel" id="btndel" type="button" value="Delete"
													onClick="deleteall('hidchkval','frmbrnd','chkdlt');">
											</div>
										</td>
										<?php
										//}
										?>
									</tr>
									<?php
									$disppg = funcDispPag('links', $loc, $sqrybrnd_mst1, $rowsprpg, $cntstart, $pgnum, $conn);
									$colspanval = '7';
									if ($disppg != "") {
										$disppg = "<br><tr><td colspan='$colspanval' align='center' bgcolor='#F2F1F1'>$disppg</td></tr>";
										echo $disppg;
									}
									if ($msg != "") {
										$dispmsg = "<tr><td colspan='$colspanval' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
										echo $dispmsg;
									}
									?>
								</table>
							</form><br>
						</td>
					</tr>
					<tr>
						<td align="right" background="images/content_footer_bg.gif"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?php include_once "../includes/inc_adm_footer.php"; ?>
</body>

</html>