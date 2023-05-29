<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//Check whether the session is created or not
	include_once '../includes/inc_connection.php';//Make connection with the database
	include_once '../includes/inc_config.php';//Make connection with the database	

	$sid             =  session_id();
	$curdt              = date('Y-m-d h:i:s');	
	$uqrylgntrck_mst   =   "update 
								lgntrck_mst 
							set
								lgntrckm_mdfdon = '$curdt',
								lgntrckm_mdfdby = '$ses_admin'
							where 
								lgntrckm_id = $ses_lgntrckid and
								lgntrckm_sesid = '$sid' and
								lgntrckm_lgnm_id = $ses_adminid";
	mysqli_query($conn,$uqrylgntrck_mst);
	//session_unregister('sesadmin');
	//session_unregister('sesadmtyp');
	//session_unregister('sesadminid');
	//session_unregister('seslgntrckid');
	
	session_unset();
	session_destroy();
?>
<html>
<head>
<title>...:: <?php echo $pgtl; ?> ::...</title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<!--<style type="text/css">
<!--
.style1 {color: #3300FF}

</style>-->
</head>
<body>
<?php include_once ('../includes/inc_adm_header.php')?>
<table width="1000px"  border="0" align="center" cellpadding="0" cellspacing="0"> 
  <tr>
	<td height="350" valign="top"><br><br><br><br>
	  
      <table width="431" border="0" align="center" cellpadding="8" cellspacing="1" class="loginbox">
        <form name="frmlgn" action="index.php" method="post"  onSubmit="return performCheck('frmlgn', rules, 'inline');">
          <tr >
            <td height="25" align="center"  colspan="4" ><strong><span class="heading green-txt">Logout</span></strong> </td>
          </tr>
	  <tr>
		<td width="100%" colspan="2" align="center"> 
		  You have been logged out successfully. <br><br>
		  For Return to the <br><br>
		  <b>Admin Section </b> <a href="index.php" class="heading" style="font-size:12px;"><b>Click here</b></a>. <br>
		  <br>
		  <b>User Section </b> <a href="<?php echo $rtpth;?>home" class="heading" style="font-size:12px;"><b>Click here</b></a>.					
		</td>
	  </tr>
	 </form>
    </table></td>
  </tr>
</table>
<?php include_once('../includes/inc_adm_footer.php');?>
</body>
</html>