<?php
session_start();
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once '../includes/inc_connection.php'; //Make connection with the database
include_once '../includes/inc_config.php'; //Make connection with the database
include_once '../includes/inc_usr_functions.php'; //Make connection with the database
$_SESSION['sesadminid'] = ""; //define the session admin
$_SESSION['sesadmin'] = ""; //define the session admin
$_SESSION['sesadmtyp'] = ""; //define the session type
$_SESSION['seslgntrckid'] = "";
global $gmsg; //message for Invalid User Id or Password	
if (isset($_REQUEST['cp']) && (trim($_REQUEST['cp']) != "")) {
	$gmsg = "<font color='red'><b>Password Changed. <br>  Please enter new password for login.</b></font>";
} //check whether variable is set or not 
if (
	isset($_POST['txtuid']) && (trim($_POST['txtuid']) != "") &&
	isset($_POST['txtpwd']) && (trim($_POST['txtpwd']) != "")
) {
	$uid = glb_func_chkvl($_POST['txtuid']);
	$pwd = md5(trim($_POST['txtpwd']));
	$sqrylgn_mst = "select 
							lgnm_id,lgnm_uid,lgnm_typ 
						from 
							lgn_mst 
						where							
							lgnm_uid=binary('" . $uid . "') and
							lgnm_pwd=binary('" . $pwd . "') and							
							lgnm_typ = 'a' and 
							lgnm_sts = 'a'"; //select record from database.
	$srslgn_mst = mysqli_query($conn, $sqrylgn_mst);
	$cntrec = mysqli_num_rows($srslgn_mst);
	if ($cntrec == 0) {
		//if record is equal to zero
		$gmsg = "<font color=red><b>Invalid User Id or Password</b></font>";
	} elseif ($cntrec == 1) {
		//if record is equal to one			
		$srowlgn_mst = mysqli_fetch_assoc($srslgn_mst);
		$db_lgnm_id = $srowlgn_mst['lgnm_id'];
		$db_lgnm_uid = $srowlgn_mst['lgnm_uid'];
		$db_lgnm_typ = $srowlgn_mst['lgnm_typ'];
		$_SESSION['sesadminid'] = $db_lgnm_id; //assign value of user id to admin session
		$_SESSION['sesadmin'] = $db_lgnm_uid; //assign value of user name to admin session
		$_SESSION['sesadmtyp'] = $db_lgnm_typ; //assign value of user type to typ session
		$curdt = date('Y-m-d h:i:s');
		$sid = session_id();
		$ipadrs = $_SERVER['REMOTE_ADDR'];
		$iqrylgntrck_mst = "insert into lgntrck_mst(lgntrckm_sesid,lgntrckm_ipadrs,
								  		lgntrckm_lgnm_id,lgntrckm_crtdon,lgntrckm_crtdby)
								  		values('$sid','$ipadrs',$db_lgnm_id,'$curdt','$db_lgnm_uid')";
		$srslgntrck_mst = mysqli_query($conn, $iqrylgntrck_mst);
		$cntrec_lgntrck = mysqli_affected_rows($conn);
		if ($cntrec_lgntrck == 1) {
			$db_lgntrck_id = mysqli_insert_id($conn);
			$_SESSION['seslgntrckid'] = $db_lgntrck_id;
		}
		header("Location: main.php");
		exit();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>
		<?php echo $pgtl; ?>
	</title>
	<?php include_once('script.php'); ?>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>
	<script language="javascript" type="text/javascript">
		var rules = new Array();
		rules[0] = 'txtuid:User Name|required|Enter User name';
		rules[1] = 'txtpwd:Password|required|Enter Password';
	</script>
	<script language="javascript">
		function setfocus() {
			document.getElementById('txtuid').focus();
		}
	</script>
</head>

<body onLoad="setfocus()">
	<?php include_once('../includes/inc_adm_header.php') ?>
	<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="350" valign="top"><br><br><br><br>
				<table width="431" border="0" align="center" cellpadding="8" cellspacing="1" class="loginbox">
					<form name="frmlgn" action="index.php" method="post"
						onSubmit="return performCheck('frmlgn', rules, 'inline');">
						<tr>
							<td height="25" align="center" colspan="4"><strong><span class="heading green-txt">Login</span></strong>
							</td>
						</tr>
						<tr bgcolor="">
							<td width="86" class="content">Login Name </td>
							<td width="5" align="center">:</td>
							<td width="120"><input name="txtuid" id="txtuid" type="text" class="form" size="20"></td>
							<td width="151"><span id="errorsDiv_txtuid"></span></td>
						</tr>
						<tr bgcolor="">
							<td class="content" width="86">Password</td>
							<td width="5" align="center">:</td>
							<td width="120"><input name="txtpwd" id="txtpwd" type="password" class="form" size="20"></td>
							<td width="151"><span id="errorsDiv_txtpwd"></span> </td>
						</tr>
						<tr align="center" bgcolor="">
							<td colspan="4"><input name="btnsubmit" type="submit" value="Submit" class="updates_button">
								<input name="btnreset" type="reset" value="Clear" class="updates_button">
							</td>
						</tr>
						<?php
						if ($gmsg != "") {
							?>
							<tr align="center" valign="middle">
								<td height="30" colspan="4">
									<?php echo $gmsg; ?>
								</td>
							</tr>
						<?php
						}
						?>
					</form>
				</table>
			</td>
		</tr>
	</table>
	<?php include_once('../includes/inc_adm_footer.php'); ?>
</body>

</html>