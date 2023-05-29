<?php
	include_once '../includes/inc_nocache.php';         //Clearing the cache information
	include_once '../includes/inc_adm_session.php';     //checking for session
	include_once '../includes/inc_connection.php';      //Making database Connection
	include_once '../includes/inc_usr_functions.php';   //Use function for validation and more	
	include_once '../includes/inc_config.php';          //Making paging validation	
	/***************************************************************/ 
	//Programm 	  : vw_all_continent.php	
	//Package 	  : 
	//Purpose 	  : To View Details of a Continent
	//Created By  : 
	//Created On  :
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$cntstart;		
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="")
	&& isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="")
	&& isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){	    
		$id   		=  glb_func_chkvl($_REQUEST['vw']);
		$pg   		=  glb_func_chkvl($_REQUEST['pg']);
		$cntstart 	=  glb_func_chkvl($_REQUEST['countstart']);
		$loc  		=  "vw=$id&pg=$pg&countstart=$cntstart"; 
		$val  		=  glb_func_chkvl($_REQUEST['val']); 
		$chk  		=  glb_func_chkvl($_REQUEST['chk']); 
		if($val != ""){
			$loc .= "&val=$val&chk=$chk";
		}
	 }	
	$sqrycntnt_mst="select 
		              cntntm_id,cntntm_iso,cntntm_name,cntntm_prty,
					  cntntm_sts
				   from
					  cntnt_mst
	               where 
					  cntntm_id=$id";
	$srscntnt_mst  = mysqli_query($conn,$sqrycntnt_mst) or die(mysql_error());		
	$cntrec_cntnt = mysqli_num_rows($srscntnt_mst);
	if($cntrec_cntnt > 0){
	  $rowscntnt_mst = mysqli_fetch_assoc($srscntnt_mst);
	}
	else{
			header("Location:vw_all_continent.php");
			exit();	
	}
	if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] == 'y')){
	    $msg = "<font color='#fda33a'>Record updated successfully</font>";
	}
	if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] == 'n')){
			$msg = "<font color='#fda33a'>Record not updated</font>";
	}
    if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] =='d')){
	    $msg = "<font color='#fda33a'>Duplicate Record Name Exists & Record Not updated</font>";
	}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<link href="style_admin.css" rel="stylesheet" type="text/css">
	<title><?php echo $pgtl;?></title>
	<script language="javascript" type="text/javascript">
	function doEdit(){
		document.frmedtcntnt.action="edit_continent.php?<?php echo $loc;?>";
		document.frmedtcntnt.submit();
	}
</script> 
</head>
<body onLoad="setfocus()">
<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr valign="top"> 
	<td height="400" valign="top"><br>
	   <table width="95%" align="center" border="0" cellspacing="1" cellpadding="5" bgcolor="#FFFFFF">
			  <form name="frmedtcntnt" id="frmedtcntnt" method="POST" action="<?php $_SERVER['SCRIPT_FILENAME']?>">
			  <input type="hidden" name="hdnid" value="<?php echo $id;?>">
			  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
			  <input type="hidden" name="hdncnt" value="<?php echo $cntstart;?>">
			  <input type="hidden" name="hdnval" value="<?php echo $val;?>">
			  <input type="hidden" name="hdnchk" value="<?php echo $chk;?>">
				<tr align="left" class='white'>
                  <td height="26" colspan="3" bgcolor="#FF543A">
				  <span class="heading"><strong>:: View Continent </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
				<?php
					if($msg!=""){
						echo "<tr bgcolor='#f0f0f0'>
								<td colspan='5' align='center'>&nbsp;
									<strong><font color='#fda33a'>$msg</font></strong>
								</td>
							  </tr>";
					}
				  ?>			  		
				<tr bgcolor="#FFFFFF">
				 <td bgcolor="#f0f0f0"><strong>Name </strong></td>
				 <td bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td bgcolor="#f0f0f0"><?php echo $rowscntnt_mst['cntntm_name'];?></td>
				</tr>	
				<tr bgcolor="#FFFFFF">
				 <td bgcolor="#f0f0f0"><strong>Iso Code</strong></td>
				 <td width="2%" bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td bgcolor="#f0f0f0"><?php echo $rowscntnt_mst['cntntm_iso'];?></td>
				</tr>					  	
				<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Rank </strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="77%" align="left" valign="middle" bgcolor="#f0f0f0">
					<?php echo $rowscntnt_mst['cntntm_prty'];?>				  </td>
				</tr>				
			  	<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Status</strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="77%" align="left" valign="middle" bgcolor="#f0f0f0" colspan="2">					
						<?php echo funcDispSts($rowscntnt_mst['cntntm_sts']);?>				   
					 </td>
				</tr>			 
			    <tr valign="middle" bgcolor="#FFFFFF">
				<td colspan="3" align="center" bgcolor="#f0f0f0">
				<input type="Submit" class="textfeild"  name="btnedtcntnt" id="btnedtcntnt" value="Edit" onClick="doEdit()">&nbsp;&nbsp;&nbsp;
			  	<input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='vw_all_continent.php?<?php echo $loc?>'">				                 
			   </td>
			  </tr>
			  </form>
           </table>
          </td>
      </tr></table>
	</td>
  </tr>
</table>
<?php include_once('../includes/inc_adm_footer.php');?>
</body>
</html>