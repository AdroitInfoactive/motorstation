<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once '../includes/inc_config.php';	
	/***************************************************************/
	//Programm 	  : edit_city.php	
	//Purpose 	  : Updating cities
	//Created By  :  Aradhana
	//Created On  : 05/05/2014
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;	
	if(isset($_REQUEST['hdnctyid']) && $_REQUEST['hdnctyid']!="")
	{
		$hdnctyid=$_POST['hdnctyid'];
	}
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id         = $_REQUEST['vw'];
		$pg         = $_REQUEST['pg'];
		$countstart = $_REQUEST['countstart'];
	}
	else if(isset($_REQUEST['hdnctyid']) && $_REQUEST['hdnctyid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!="")
	{
		$id         = $_REQUEST['hdnctyid'];
		$pg         = $_REQUEST['hdnpage'];
		$countstart = $_REQUEST['hdncnt'];
	}
	$sqrycty_mst="select 
					  ctym_id,ctym_name,ctym_sts,cntym_id,
	               	  ctym_iso,cntym_name,cntrym_name,cntrym_id,
					  ctym_crtdby	
				  from 
				  	   vw_cntry_cnty_cty_mst
				  where 
				       ctym_cntym_id=cntym_id
				  and 
				      cntym_cntrym_id=cntrym_id
				  and 
				     ctym_id=$id";
	$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
	$cntrec =mysqli_num_rows($srscty_mst);
	if($cntrec > 0)
	{
		$rowscty_mst = mysqli_fetch_assoc($srscty_mst);
	}
	else
	{
		header("location:vw_all_verifycity.php");
	}
	$val = glb_func_chkvl($_REQUEST['val']);
	$optn = glb_func_chkvl($_REQUEST['optn']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
    $loc = "&optn=".$optn."&val=".$val;
	if($chk !=""){
		$loc = "&optn=".$optn."&val=".$val."&chk=".$chk."";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $pgtl;?></title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php 
 include_once ('../includes/inc_adm_header.php');
 include_once ('../includes/inc_adm_leftlinks.php');
 ?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
		<td height="400" valign="top"><br>
		  <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
	  <form name="frmedtcty" id="frmedtcty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post">
		  <tr class='white'>
			<td height="26" colspan="4" bgcolor="#FF543A"><span class="heading"><strong> ::View Verified City </strong></span></td>
		  </tr>		  		  
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="left"  class="heading">&nbsp;</td>
		  </tr>			 
		  <tr bgcolor="#f0f0f0">
			<td width="315" valign="top"> Country</td>
			<td width="10" align="center" valign="top">:</td>
			<td width="571"><?php echo $rowscty_mst['cntrym_name'];?>			 </td>
		</tr>
		  <tr bgcolor="#f0f0f0">
			<td width="315" valign="top"> County</td>
			<td width="10" align="center">:</td>
			<td width="571"><?php echo $rowscty_mst['cntym_name'];?>			</td>
		</tr>
		  <tr bgcolor="#f0f0f0">
			<td width="315"> Name</td>
			<td width="10" align="center">:</td>
			<td width="571"><?php echo $rowscty_mst['ctym_name'];?></td>
		 </tr>		
		<tr bgcolor="#f0f0f0">
			<td align="left">Rank</td>
			<td width="10" align="center">:</td>
			<td><?php echo $rowscty_mst['ctym_prty'];?></td>
		</tr>		
		<tr bgcolor="#f0f0f0">
			<td align="left">Status</td>
			<td width="10" align="center">:</td>
			<td><?php echo funcDispSts($rowscty_mst['ctym_sts']);?></td>
		</tr>         
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="center">
			<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_verifycity.php?pg=<?php echo $pg."&countstart=".$countstart.$loc;?>'">			                     
	    </form>
		</table> 
		</td>
    </tr>  
</table>
  <?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>