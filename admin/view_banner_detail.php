<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection 
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";
	/***************************************************************/
	//Programm 	  : view_banner_detail.php
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$cntstart,$msg;
	$rd_crntpgnm = "vw_all_banners.php";
	$rd_edtpgnm  = "edit_banner.php";
	$clspn_val   = "3";
	$msg ="";
	if(isset($_REQUEST['edit']) && trim($_REQUEST['edit'])!="" &&
	   isset($_REQUEST['pg']) && trim($_REQUEST['pg'])!="" &&
	   isset($_REQUEST['countstart']) && trim($_REQUEST['countstart'])!=""){
		$id 	  = glb_func_chkvl($_REQUEST['edit']);
		$pg 	  = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);	
		$loc 	  = "";
		$val	  = "";
		$chk 	  = "";	
		if(isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval'])!=""){
			$val  		= glb_func_chkvl($_REQUEST['txtsrchval']); 		
			$loc = "&txtsrchval=$val";			 
		    if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact'] !=''){
				$chk  		=  glb_func_chkvl($_REQUEST['chkexact']); 		
				$loc .= "&chkexact=$chk";
			}	
		}
	/*}
	elseif(isset($_REQUEST['hdnbnrid']) && trim($_REQUEST['hdnbnrid'])!="" && 
		   isset($_REQUEST['hdnpage']) && trim($_REQUEST['hdnpage'])!="" && 
		   isset($_REQUEST['hdncnt']) && trim($_REQUEST['hdncnt'])!=""){
		$id = glb_func_chkvl($_REQUEST['hdnbnrid']);
		$pg = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
		$val  = glb_func_chkvl($_REQUEST['hdnval']); 
		//$optn =  glb_func_chkvl($_REQUEST['hdnoptn']); 
		$chk  =  glb_func_chkvl($_REQUEST['hdnchk']); 
	}*/
		 $sqrybnr_mst="select 
						  bnrm_id,bnrm_name,bnrm_desc,bnrm_imgnm,
						  bnrm_lnk,bnrm_prty,if(bnrm_sts = 'a', 'Active','Inactive') as bnrm_sts
					  from 
						 bnr_mst
					  where 
						 bnrm_id=$id";
		$srsbnr_mst  = mysqli_query($conn,$sqrybnr_mst);
		$cnt_rec=mysqli_num_rows($srsbnr_mst);
		if($cnt_rec > 0){
			$rowsbnr_mst = mysqli_fetch_assoc($srsbnr_mst);
		}else{
			header("Location:$rd_crntpgnm");
			exit();
		}
	}
	else{
		header("Location:$rd_crntpgnm");
		exit();
	}
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
		$msg = "<font color=FF6600>Record updated successfully</font>";
	}
	else if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
		$msg = "<font color=FF6600>Record not updated</font>";
	}
	else if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
	    $msg = "<font color=FF6600>Duplicate Recored Name Exists & Record Not updated</font>";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>	
<?php include_once 'script.php';?>		
<script language="javascript" type="text/javascript">
	function update(){
		document.frmedtbnr.action="<?php echo $rd_edtpgnm;?>?edit=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>";
		document.frmedtbnr.submit();
	}	
</script>
</head>
<body>
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';
?>
<table width="1004"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
      <td height="350" valign="top"><br><br>
        <table width="95%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
		  <form name="frmedtbnr" id="frmedtbnr" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmedtbnr', rules, 'inline');">
		  <input type="hidden" name="edit" id="edit" value="<?php echo $id;?>">
		  <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
		  <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
		  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
          <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">			
		   <tr align="left" class='white'>
			  <td height="30" colspan="5" bgcolor="#FF543A">
			 <span class="heading"><strong>:: View Banner </strong></span>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<?php
				if($msg !=""){
					echo " <tr bgcolor='#F3F3F3'>
					<td align='center'  colspan='$clspn_val'><font>$msg</font></td></tr>";
				} 
			 ?>	
			<tr bgcolor="#F3F3F3">
                <td width="13%" height="19" valign="middle" ><strong>Name * </strong></td> 
				<td width="2%"  align="center"><strong>:</strong></td> 
                 <td width="42%" align="left" valign="middle" >
				 <?php echo $rowsbnr_mst['bnrm_name'];?></td>
				
			    </tr>
				
				<tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle"  colspan="<?php echo $clspn_val;?>">
					<strong>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> </td>
				</tr>
				<tr bgcolor="#F3F3F3">
					<td align="left" valign="middle"   colspan="<?php echo $clspn_val;?>">
						<?php echo $rowsbnr_mst['bnrm_desc'];?>
					</td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td width="27%" height="19" valign="middle" ><strong>Image</strong>
                  <td align="center" ><strong>:</strong></td>
                  <td >
                  <?php
					   $imgnm   = $rowsbnr_mst['bnrm_imgnm'];
					   $imgpath = $gbnr_fldnm.$imgnm;
					   if(($imgnm !="") && file_exists($imgpath)){
						  echo "<img src='$imgpath' width='80pixel' height='80pixel'>";					 
					   }
					   else{
						  echo "Image not available";						 			  
					   }
				 ?><br/><strong>(SIZES: H 500 X W 1000) </strong>                  
					</td>				 	
                </tr>
				<tr bgcolor="#F3F3F3">
				  <td width="27%" height="19" valign="middle" ><strong>Link</strong>
                  <td align="center" ><strong>:</strong></td>
                  <td ><?php echo $rowsbnr_mst['bnrm_lnk'];?></td>	
                </tr>
				<tr bgcolor="#f9f8f8">
                   <td > <strong>Rank</strong> * </td>
				   <td  align="center"><strong>:</strong></td>
                  <td ><?php echo $rowsbnr_mst['bnrm_prty'];?></td>							
                </tr>
				<tr bgcolor="#F3F3F3">
					<td width="12%" height="19" valign="middle" ><strong>Status</strong></td>
					<td width="2%"  align="center"><strong>:</strong></td>
					<td width="44%" align="left" valign="middle" ><?php echo $rowsbnr_mst['bnrm_sts'];?></td>
				</tr>
				 
			    <tr valign="middle" bgcolor="#f9f8f8">
					<td colspan="<?php echo $clspn_val;?>" align="center" >
					  <input type="Submit" class="textfeild"  name="btnedtbnr" id="btnedtbnr" value="Edit" onClick="update();">
					   &nbsp;&nbsp;&nbsp;					
					  <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='<?php echo $rd_crntpgnm;?>?pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>'">
					</td>					
				</tr>
			  </form>
          </table> </td>
	</tr>  
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>