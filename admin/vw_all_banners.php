<?php
include_once '../includes/inc_config.php';
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_adm_session.php'; //checking for session
include_once '../includes/inc_connection.php'; //Making database Connection
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more 
include_once '../includes/inc_paging_functions.php'; //Making paging validation
include_once "../includes/inc_folder_path.php";
/***************************************************************/
//Programm 	  : vw_all_banners.php
//Purpose 	  : Viewing Banner 
//Created On  :	
//Modified By : 
//Modified On : 
//Company 	  : Adroit
/************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg, $rd_edtpgnm, $clspn_val, $rd_adpgnm, $rd_vwpgnm;
$clspn_val = "7";
$rd_adpgnm = "add_banner.php";
$rd_edtpgnm = "edit_banner.php";
$rd_crntpgnm = "vw_all_banners.php";
$rd_vwpgnm = "view_banner_detail.php";
$msg = "";
if (
	isset($_REQUEST['hidchksts']) && (trim($_POST['hidchksts']) != "") ||
	isset($_POST['hdnallval']) && (trim($_POST['hdnallval']) != "")
) {
	$dchkval = substr($_POST['hidchksts'], 1);
	$id = glb_func_chkvl($dchkval);
	$chkallval = glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts('bnr_mst', 'bnrm_id', $id, 'bnrm_sts', $chkallval);
	if ($updtsts) {
		$msg = "<font color=FF6600>Record updated successfully</font>";
	} else {
		$msg = "<font color=FF6600>Record not updated</font>";
	}
}
if (isset($_POST['hidchkval']) && trim($_POST['hidchkval']) != "") {
	/*$dchkval   =  substr($_POST['hidchkval'],1);
		$did 	   =  glb_func_chkvl($dchkval);
		
		$delsts = funcDelAllRec('bnr_mst','bnrm_id',$did);										
		if($delsts == 'y'){
			$msg   = "<font color=#fda33a>Record deleted successfully</font>";
		}
		elseif($delsts == 'n'){
			$msg  = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
		}*/
	$dchkval = substr($_POST['hidchkval'], 1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',', $did);
	$count = sizeof($del);
	$delsts = "";
	$smlimg = array();
	$smlimgpth = array();
	$bgimg = array();
	$bgimgpth = array();
	for ($i = 0; $i < $count; $i++) {
		$sqryprodimgd_dtl = "select 
								  bnrm_imgnm
							   from 
								   bnr_mst
							   where
								   bnrm_id=$del[$i]";
		$srsprodimgd_dtl = mysqli_query($conn, $sqryprodimgd_dtl);
		$srowprodimgd_dtl = mysqli_fetch_assoc($srsprodimgd_dtl);
		$smlimg[$i] = glb_func_chkvl($srowprodimgd_dtl['bnrm_imgnm']);
		$smlimgpth[$i] = $gbnr_fldnm . $smlimg[$i];
	}
	$delsts = funcDelAllRec('bnr_mst', 'bnrm_id', $did);
	if ($delsts == 'y') {
		for ($i = 0; $i < $count; $i++) {
			if (($smlimg[$i] != "") && file_exists($smlimgpth[$i])) {
				unlink($smlimgpth[$i]);
			}
		}
		$msg = "<font color=#fda33a>Record deleted successfully</font>";
	} elseif ($delsts == 'n') {
		$msg = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
	}
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
	$msg = "<font color=#fda33a>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
	$msg = "<font color=#fda33a>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
	$msg = "<font color=#fda33a>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20; //maximum rows per page
include_once '../includes/inc_paging1.php'; //Includes pagination	
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
			document.frmbnr.action = "<?php echo $rd_adpgnm; ?>";
			document.frmbnr.submit();
		}
		function srch() {
			var urlval = "";
			if ((document.frmbnr.txtsrchval.value == "")) {
				alert("Select Search Criteria");
				document.frmbnr.txtsrchval.focus();
				return false;
			}
			var val = document.frmbnr.txtsrchval.value;
			if (val != '') {
				urlval += "txtsrchval=" + val;
			}
			if (document.frmbnr.chkexact.checked == true) {
				document.frmbnr.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chkexact=y";
				document.frmbnr.submit();
			}
			else {
				document.frmbnr.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
				document.frmbnr.submit();
			}
			return true;
		}
	/*function srch(){
			if(document.frmbnr.txtsrchval.value==""){
				alert("Enter categoryone Name");
				document.frmbnr.txtsrchval.focus();
				return false;
			}
			var val=document.frmbnr.txtsrchval.value;
			if(document.frmbnr.chkexact.checked==true){
				document.frmbnr.action="vw_all_banners.php?val="+val+"&chk=y";
				document.frmbnr.submit();
			}
			else{
				document.frmbnr.action="vw_all_banners.php?val="+val;
				document.frmbnr.submit();
			}
		}*/
	</script>
	<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>

<body>
	<div id="container">
		<?php include_once '../includes/inc_adm_header.php';
		include_once '../includes/inc_adm_leftlinks.php'; ?>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td height="350" valign="top" bgcolor="" class="incellpad3030">
					<FORM method="POST" action="" name="frmbnr" id="frmbnr">
						<input type="hidden" name="hidchkval" id="hidchkval">
						<input type="hidden" name="hidchksts" id="hidchksts">
						<input type="hidden" name="hdnallval" id="hdnallval">
						<table width="90%" align="center" border="0" cellspacing="0" cellpadding="5" bgcolor="#fff">
							<tr align="left" class='white'>
								<td height="30" colspan="5" bgcolor="#FF543A">
									<span class="heading"><strong>Banner </strong></span>&nbsp;&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td width="91%">
									<table width="100%">
										<tr>
											<td width="20%"><strong>Name</strong></td>
											<td width="37%">
												<input type="text" name="txtsrchval" value="<?php
												if (isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval']) != "")) {
													echo $_REQUEST['txtsrchval'];
												}
												/*elseif(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
																 echo $_REQUEST['val'];
															}*/
												?>">
												Exact
												<input type="checkbox" name="chkexact" value="y" <?php
												if (isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact']) == 'y')) {
													echo 'checked';
												}
												/*elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
																 echo 'checked';							
															 }*/
												?>>
	</div>
	</td>
	<td width="43%"><input name="button" type="button" class="textfeild" onClick="srch()" value="Search">
		<a href="<?php echo $rd_crntpgnm; ?>" class="leftlinks"><strong>Refresh</strong></a>
	</td>
	</tr>
	</table>
	</td>
	<td width="9%" align="right"><input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">
	</td>
	</tr>
	</table>
	<table width="90%" border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7" align="center">

		<tr bgcolor="#FFFFFF">
			<td colspan="<?php echo $clspn_val - 2; ?>" align="center"></td>
			<td width="10%" align="center" valign="bottom">
				<input name="btnsts" class="" id="btnsts" type="button" value="Status"
					onClick="updatests('hidchksts','frmbnr','chksts')">
			</td>
			<td width="10%" align="center" valign="bottom">
				<input name="btndel" id="btndel" class="" type="button" value="Delete"
					onClick="deleteall('hidchkval','frmbnr','chkdlt');">
			</td>
		</tr>
		<?php
		if ($msg != "") {
			$dispmsg = "<tr><td colspan='$clspn_val' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
			echo $dispmsg;
		}
		?>
		<tr class="white">
			<td width="6%" align='left' bgcolor="#FF543A"><strong>Sl.No.</strong></td>
			<td width="50%" align='left' bgcolor="#FF543A"><strong>Name</strong></td>
			<td width="10%" align='left' bgcolor="#FF543A"><strong>Image</strong></td>
			<td width="8%" align="center" bgcolor="#FF543A"><strong>Rank</strong></td>
			<td width="8%" align="center" bgcolor="#FF543A"><strong>Edit</strong></td>
			<td width="9%" align="center" bgcolor="#FF543A"><strong>
					<input type="checkbox" class="" name="Check_ctr" id="Check_ctr" value="yes"
						onClick="Check(document.frmbnr.chksts,'Check_ctr','hdnallval')"></strong></td>
			<td width="9%" align="center" bgcolor="#FF543A"><strong>
					<input type="checkbox" name="Check_dctr" class="" id="Check_dctr" value="yes"
						onClick="Check(document.frmbnr.chkdlt,'Check_dctr')"><b></b>
				</strong>
			</td>
		</tr>
		<?php
		$sqrybnr_mst1 = "select 
								   bnrm_id,bnrm_name,bnrm_desc,bnrm_imgnm,
								   bnrm_prty,bnrm_sts
							   from 
								   bnr_mst";
		if (isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) != "") {
			$val = glb_func_chkvl($_REQUEST['txtsrchval']);
			$loc = "&txtsrchval=" . $val;
			if (isset($_REQUEST['chkexact']) && trim($_REQUEST['chkexact']) == 'y') {
				$loc .= "&chkexact=y";
				$sqrybnr_mst1 .= " where bnrm_name='$val'";
			} else {
				$sqrybnr_mst1 .= " where bnrm_name like '%$val%'";
			}
		}
		$sqrybnr_mst = $sqrybnr_mst1 . " order by bnrm_name asc limit $offset,$rowsprpg";
		$srsbnr_mst = mysqli_query($conn, $sqrybnr_mst) or die(mysql_error());
		$cnt = $offset;
		$cnt_rec = mysqli_num_rows($srsbnr_mst);
		if ($cnt_rec == 0) {
			?>
			<tr>
				<td colspan='8' align='center'>
					<font color='#fda33a'>No Records Found</font>
				</td>
			</tr>
			<?php
		}
		while ($srowbnr_mst = mysqli_fetch_assoc($srsbnr_mst)) {
			$cnt += 1;
			$db_bnrmid = $srowbnr_mst['bnrm_id'];
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
					<a href="<?php echo $rd_vwpgnm; ?>?edit=<?php echo $srowbnr_mst['bnrm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
						class="leftlinks"><?php echo $srowbnr_mst['bnrm_name']; ?></a>
				</td>
				<td align='center' valign="top">
					<?php $imgnm = $srowbnr_mst['bnrm_imgnm'];
					$imgpath = $gbnr_fldnm . $imgnm;
					if (($imgnm != "") && file_exists($imgpath)) {
						echo "<img src='$imgpath' width='50pixel' height='50pixel'>";
					} else {
						echo "No Image";
					}
					?>
				</td>
				<td align="right" valign="top">
					<?php echo $srowbnr_mst['bnrm_prty']; ?>
				</td>
				<td align="center" valign="top">
					<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $srowbnr_mst['bnrm_id']; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
						class="leftlinks">Edit</a>
				</td>
				<td align="center" valign="top">
					<input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_bnrmid; ?>" <?php if ($srowbnr_mst['bnrm_sts'] == 'a') {
							echo "checked";
						} ?>
						onClick="addchkval(<?php echo $db_bnrmid; ?>,'hidchksts','frmbnr','chksts');">
				</td>
				<td align="center" valign="top">
					<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_bnrmid; ?>">
				</td>
			</tr>
			<?php
		}
		?>
		<tr bgcolor="#FFFFFF">
			<td colspan="<?php echo $clspn_val - 2; ?>" align="center"></td>
			<td width="10%" align="center" valign="bottom">
				<input name="btnsts" id="btnsts" class="" type="button" value="Status"
					onClick="updatests('hidchksts','frmbnr','chksts')">
			</td>
			<td width="10%" align="center" valign="bottom">
				<input name="btndel" id="btndel" class="" type="button" value="Delete"
					onClick="deleteall('hidchkval','frmbnr','chkdlt');">
			</td>
		</tr>
		<?php
		$disppg = funcDispPag('links', $loc, $sqrybnr_mst1, $rowsprpg, $cntstart, $pgnum, $conn);
		if ($disppg != "") {
			$disppg = "<tr><td colspan='$clspn_val' align='center' bgcolor='#fff'>$disppg</td></tr>";
			echo $disppg;
		}

		?>
	</table>
	</FORM>
	</td>
	</tr>
	</table>
	<?php include_once "../includes/inc_adm_footer.php"; ?>
</body>

</html>