<?php 
	include_once '../includes/inc_nocache.php';        // Clearing the cache information
    include_once '../includes/inc_adm_session.php'; //Check whether the session is created or not
    include_once '../includes/inc_connection.php';     //Make connection with the database
	include_once '../includes/inc_usr_functions.php';  //Use function for validation and more
	include_once '../includes/inc_config.php';  	

	global $msg;
	if(isset($_POST['btnsubmit']) && (trim($_POST['btnsubmit']) !="") &&
	   isset($_POST['txtopwd']) && (trim($_POST['txtopwd']) != "") &&
	   isset($_POST['txtnpwd']) && (trim($_POST['txtnpwd']) != "") && 
	   isset($_POST['txtcpwd']) && (trim($_POST['txtcpwd']) != "") && 
	   (trim($_POST['txtnpwd']) == trim($_POST['txtcpwd']))){
	   
		 $lgnm_opwd = md5(trim($_POST['txtopwd']));
	     $lgnm_npwd = md5(trim($_POST['txtnpwd']));
		 $lgnm_cpwd = md5(trim($_POST['txtcpwd']));
		 
		if($lgnm_npwd == $lgnm_cpwd){			
			$curdt			= date('Y-m-d h:i:s');
			$uqrylgn_mst 	= "update 
									lgn_mst 
							   set
									lgnm_pwd='$lgnm_npwd', 
									lgnm_mdfdon = '$curdt',
									lgnm_mdfdby = '$ses_admin'
								where 
									lgnm_pwd='$lgnm_opwd' and 
									lgnm_typ='$ses_admtyp' and 
									lgnm_sts = 'a' and
									lgnm_uid='$ses_admin'";
			$urslgn_mst  = mysqli_query($conn,$uqrylgn_mst);
			$cntrec		 = mysql_affected_rows();								
			if($cntrec == 1){		
				$sid             =  session_id();
				$uqrylgntrck_mst =  "update 
										lgntrck_mst 
									set
										lgntrckm_mdfdon = '$curdt',
										lgntrckm_mdfdby = '$ses_admin'
									where 
										lgntrckm_id ='$ses_lgntrckid' and
										lgntrckm_lgnm_id ='$ses_adminid' and
										lgntrckm_sesid = '$sid'";
				mysqli_query($conn,$uqrylgntrck_mst);
				?>
					 <script language="javascript">
					  	location.href="index.php?cp=1"
					 </script>
				 <?php			
			}
			else{
				$msg="Please Enter the Correct Current Password";
			}
		}
		else{
			  $msg = "New Password and Confirm Password are not matched";
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<?php include_once ('script.php');?>	
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>	
<script language="javascript" type="text/javascript">
	var rules=new Array();
	rules[0]='txtopwd:Old Password |required|Enter Old Password';
	rules[1]='txtnpwd:New Password|required|Enter New Password';
	rules[2]='txtcpwd:Confirm password|equal|$txtnpwd|Mis Match Password';
	rules[3]='txtcpwd:Confirm password|required|Enter Confirm Password';
</script>
<script language="javascript" type="text/javascript">
	function setfocus(){
		document.frmchngpwd.txtopwd.focus();
	}
</script>
</head>
<body onLoad="setfocus();"> 
<?php 
	include_once ('../includes/inc_adm_header.php');
	include_once ('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr valign="top">
	<td height="400"><br>
	<table width="60%" border="0" cellpadding="8" cellspacing="1" align="center" class="loginbox">
	<form name="frmchngpwd" method="post" action="change_password.php" onSubmit="return performCheck('frmchngpwd', rules, 'inline');">
	  <tr >
	    <td height="26" colspan="4"><span class="heading2">Change Password </span></td>
	  </tr>
	  <tr >
	    <td align="right" >Current Password </td>
		<td width="2%" align="center">:</td>
	    <td><input name="txtopwd"  id="txtopwd" type="password" class="select" size="20"></td>
		<td width="39%"><span id="errorsDiv_txtopwd" ></span></td>
	  </tr>
	  <tr >
	    <td align="right">New Password</td>
		<td width="2%" align="center">:</td>
	    <td><input name="txtnpwd" type="password" id="txtnpwd" class="select" size="20"></td>
		<td><span id="errorsDiv_txtnpwd" ></span></td>
	  </tr>
	  <tr >
	    <td width="37%" align="right">Confirm Password</td>
		<td width="2%" align="center">:</td>
	    <td width="22%"><input name="txtcpwd" id="txtcpwd" type="password" class="select" size="20"></td>
		<td><span id="errorsDiv_txtcpwd" ></span></td>
	 </tr>
	 <tr >
	   <td colspan="4" align="center">
	     <input name="btnsubmit" type="submit" class="" value="Submit">
		 <input name="btnreset" type="reset" class="" value="Reset">
		 <input name="button" type="button" class="" onClick="location.href='main.php'" value="Back"></td>
	   </tr>	 
	 <tr>
	   <td colspan="4" align="center"><font color="#fda33a"><b><?php echo $msg;?></b></font></td>
	 </tr>
	</form>
	</table>
	<br>
	<br></td>
  </tr>
</table>	
<?php include_once('../includes/inc_adm_footer.php');?>
</body>
</html>