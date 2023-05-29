<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";	
	/***************************************************************/
	//Programm 	  : edit_banner.php
	//Purpose 	  : Updating banner
	//Created By  : Aradhana
	//Created On  :	
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
	$rd_crntpgnm = "vw_all_banners.php";
	$rd_vwpgnm   = "view_banner_detail.php";
	$clspn_val   = "4";
	if(isset($_POST['btnedtbnr']) && (trim($_POST['btnedtbnr']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['edit']) && (trim($_POST['edit']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
		include_once "../includes/inc_fnct_fleupld.php";
		include_once "../database/uqry_bnr_mst.php";
	}
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
						  bnrm_lnk,bnrm_prty,bnrm_sts
					  from 
						 bnr_mst
					  where 
						 bnrm_id='$id'";
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
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
	<script language="javascript" src="../includes/yav.js"></script>
	 <script language="JavaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';
	</script>
	<?php
		include_once "../includes/inc_fnct_ajax_validation.php"; //Includes ajax validations
		include_once 'script.php';				
	?>		
	<script language="javascript" type="text/javascript">
	function setfocus(){
		document.getElementById('txtname').focus();
	}
	function funcChkDupName(){
		var bnrname;
		bnrid 	 = <?php echo $id;?>;
		bnrname = document.getElementById('txtname').value;
		//prty = document.getElementById('txtprior').value;				
		if((bnrname != "")  && (bnrid != "")){
			var url = "chkvalidname.php?bnrname="+bnrname+"&bnrid="+bnrid;
			xmlHttp	= GetXmlHttpObject(funcbnrstatChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
			/*if((prty != "")  && (bnrid != "")){
				var url = "chkvalidname.php?bnrprty="+prty+"&bnrid="+bnrid;
				xmlHttp	= GetXmlHttpObject(funcbnrstatChangedprty);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);
			}
			else{
				document.getElementById('errorsDiv_txtprior').value = "";
			}	*/	
	}
	function funcbnrstatChanged(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0){
				document.getElementById('txtname').focus();
			}		
		}
	}
		/*function funcbnrstatChangedprty(){ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
				var temp=xmlHttp.responseText;
				document.getElementById("errorsDiv_txtprior").innerHTML = temp;
				if(temp!=0){
					document.getElementById('txtprior').focus();
				}		
			}
		}	*/				
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
		  <form name="frmedtbnr" id="frmedtbnr" method="post" enctype="multipart/form-data" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return yav.performCheck('frmedtbnr', rules, 'inline');">
		  <input type="hidden" name="edit" id="edit" value="<?php echo $id;?>">
		  <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
		  <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
		  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
          <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">
		 <?php /*?> <input type="hidden" name="hdnoptn" value="<?php echo $optn;?>"><?php */?>
		  <input type="hidden" name="hdnchk" value="<?php echo $chk;?>">
		  <input type="hidden" name="hdnsmlimg"   value="<?php echo $rowsbnr_mst['bnrm_imgnm']; ?>">
                 <tr align="left" class='white'>
			  <td height="30" colspan="5" bgcolor="#FF543A">
			 <span class="heading"><strong>:: Edit Banner </strong></span>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			   <tr bgcolor="#F3F3F3">
                <td width="12%" height="19" valign="middle" ><strong>Name</strong></td> 
				<td width="2%" ><strong>:</strong></td> 
                 <td width="44%" align="left" valign="middle" >
				 <input name="txtname" type="text" class="select" id="txtname" onBlur="funcChkDupName();" size="45" maxlength="240" value="<?php echo $rowsbnr_mst['bnrm_name'];?>"></td>
				 <td width="42%"  style="color:#FF0000"><span id="errorsDiv_txtname"></span></td>
			    </tr>
				<tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle"  colspan="<?php echo $clspn_val;?>">
					<strong>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> </td>
				</tr>
				<tr bgcolor="#F3F3F3">
					<td align="left" valign="middle"   colspan="<?php echo $clspn_val;?>">
						<textarea name="txtdesc" id="txtdesc" rows="6" cols="80"><?php echo $rowsbnr_mst['bnrm_desc'];?></textarea>
					</td>
                </tr>
				
				<tr bgcolor="#f9f8f8">
					<td width="27%" height="19" valign="middle" ><strong>Image</strong>
					<td align="center" ><strong>:</strong></td>
					<td ><input type="file" class="select" id="flesmlimg" name="flesmlimg"><br/><strong>(SIZES: H 500 X W 1000) </strong></td>	
					<td >
					<?php
					   $imgnm   = $rowsbnr_mst['bnrm_imgnm'];
					   $imgpath = $gbnr_fldnm.$imgnm;
					   if(($imgnm !="") && file_exists($imgpath)){
						  echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
					   }
					   else{
						  echo "No Image";						 				  
					   }
					?></td>			 	
			    </tr>
				<tr bgcolor="#F3F3F3">
                <td width="12%" height="19" valign="middle" ><strong>Link</strong></td> 
				<td width="2%" ><strong>:</strong></td> 
                 <td width="44%" align="left" valign="middle" >
				 <input name="txtlnk" type="text" class="select" id="txtlnk" size="45" maxlength="240" value="<?php echo $rowsbnr_mst['bnrm_lnk'];?>" ></td>
				 <td width="42%"  style="color:#FF0000"></td>
			    </tr>	
				 <tr bgcolor="#f9f8f8">
                   <td > <strong>Rank</strong> </td>
				   <td ><strong>:</strong></td>
                   <td >
				  <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3" value="<?php echo $rowsbnr_mst['bnrm_prty'];?>" onBlur="funcChkDupName()"></td>
					<td  style="color:#FF0000"><span id="errorsDiv_txtprior"></span></td>
                </tr>
				<tr bgcolor="#F3F3F3">
					<td width="12%" height="19" valign="middle" ><strong>Status</strong></td>
					<td ><strong>:</strong></td>
					<td width="44%" align="left" valign="middle"  colspan="<?php echo $clspn_val-2;?>">
					<select name="lststs" id="lststs">
						<option value="a"<?php if($rowsbnr_mst['bnrm_sts']=='a') echo 'selected';?>>Active</option>
						<option value="i"<?php if($rowsbnr_mst['bnrm_sts']=='i') echo 'selected';?>>Inactive</option>
					  </select>
					</td>
				</tr>
				<tr valign="middle" bgcolor="#f9f8f8">
						<td colspan="<?php echo $clspn_val;?>" align="center" >
						<input type="Submit" class="textfeild"  name="btnedtbnr" id="btnedtbnr" value="Update">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="textfeild"  name="btnecatrst1" value="Reset" id="btnecatrstone">
						&nbsp;&nbsp;&nbsp;
						  <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='<?php echo $rd_vwpgnm;?>?edit=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>'">
						</td>
				</tr>
			  </form>
          </table>   </td>
	</tr>  
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>