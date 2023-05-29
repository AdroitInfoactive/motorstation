<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once '../includes/inc_config.php';
	/***************************************************************/
	//Programm 	  : view_vrfycounty_dtl.php	
	//Purpose 	  : Updating County
	//Created By  : Aradhana
	//Created On  : 05/05/2014
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id         = $_REQUEST['vw'];
		$pg         = $_REQUEST['pg'];
		$countstart = $_REQUEST['countstart'];
	}
	 $sqrycnty_mst="select 
						cntym_id,cntym_name,cntym_iso,cntym_sts,
						cntrym_id,cntrym_name,cntym_crtdby
				    from 
					   cnty_mst,cntry_mst
				    where 
					   cntym_cntrym_id=cntrym_id  and 
				  	   cntym_id=$id";
	$srscnty_mst  = mysqli_query($conn,$sqrycnty_mst) or die(mysql_error());
	$cntrec =mysqli_num_rows($srscnty_mst);
	if($cntrec > 0){
		$rowscnty_mst = mysqli_fetch_assoc($srscnty_mst);
	}
	else{
		header("location:view_all_verifycounty.php");
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
<?php include_once ('script.php');?>
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
	  <form name="frmedtcnty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post"  onSubmit="return performCheck('frmedtcnty', rules, 'inline');">		 
		  <tr bgcolor="" class="white">
			<td height="26" colspan="4" bgcolor="#FF543A" ><span class="heading white" ><strong> ::View Verified County </strong></span></td>
		  </tr>		  		  
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="left"  class="heading">&nbsp;</td>
		  </tr>		
		 <?php /*?><tr bgcolor="#f0f0f0">
            <td width="24%" height="19" valign="middle"><strong>Created By </strong></td> 
			<td width="2%" align="center"><strong>:</strong></td> 
            <td width="42%" align="left" valign="middle"><?php echo $rowscnty_mst['cntym_crtdby']?></td>
		 </tr><?php */?>
		 <tr bgcolor="#f0f0f0">
			<td width="123"> Country</td>
			<td width="5" align="center">:</td>
			<td width="214"><?php echo $rowscnty_mst['cntrym_name'];?></td>
		 </tr>
		 <tr bgcolor="#f0f0f0">
			<td width="123"> Name</td>
			<td width="5" align="center">:</td>
			<td width="214"><?php echo $rowscnty_mst['cntym_name'];?></td>
		</tr>
		  <tr bgcolor="#f0f0f0">
			<td align="left">Rank</td>
			<td width="5" align="center">:</td>
			<td><?php echo $rowscnty_mst['cntym_prty'];?></td>
		</tr>		
		<tr bgcolor="#f0f0f0">
			<td align="left">Status</td>
			<td width="5" align="center">:</td>
			<td><?php echo funcDispSts($rowscnty_mst['cntym_sts']);?></td>
		</tr>		
        <tr bgcolor="#f0f0f0">
			<td colspan="4" align="center">
           	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_verifycounty.php?pg=<?php echo $pg."&countstart=".$countstart.$loc;?>'">			                     
		  </tr>
	    </form>
		</table></td>
    </tr>  
</table>
  <?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>