<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//checking for session
	include_once '../includes/inc_config.php';       //Making paging validation
	include_once '../includes/inc_folder_path.php';//Floder Path	
	/***************************************************************/
	//Programm 	  		: edit_brand.php	
	//Purpose 	  			: Updating new brand
	//Created By  		: Mallikarjuna
	//Created On  		:	16/04/2013
	//Modified By 		: Aradhana
	//Modified On   	: 07-06-2014
	//Company 	  		: Adroit
	/************************************************************/
	global $id,$pg,$countstart,$fldnm;
	$fldnm=$gvehtyp_upldpth;
	if(isset($_POST['btnedtvehtyp']) && ($_POST['btnedtvehtyp'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['hdnvehtypid']) && ($_POST['hdnvehtypid'] != "") &&
	   isset($_POST['txtprior']) && ($_POST['txtprior'] != "")){
	       include_once "../includes/inc_fnct_fleupld.php"; // For uploading files		
		   include_once "../database/uqry_vehtyp_mst.php";
	   }
	if(isset($_REQUEST['edit']) && $_REQUEST['edit']!="" && 
	   isset($_REQUEST['pg']) && $_REQUEST['pg']!="" && 
	   isset($_REQUEST['countstart']) && $_REQUEST['countstart']!=""){
		$id         = $_REQUEST['edit'];
		$pg         = $_REQUEST['pg'];
		$countstart = $_REQUEST['countstart'];
	}
	else if(isset($_REQUEST['hdnvehtypid']) && $_REQUEST['hdnvehtypid']!="" && 
		    isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!="" && 
			isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!=""){
			$id         = $_REQUEST['hdnvehtypid'];
			$pg         = $_REQUEST['hdnpage'];
			$countstart = $_REQUEST['hdncnt'];
	}
	$sqryvehtyp_mst="select
	                   vehtypm_id,vehtypm_name,vehtypm_desc,vehtypm_img,
					   vehtypm_zmimg,vehtypm_sts,vehtypm_prty,vehtypm_seotitle,vehtypm_seodesc,
					   vehtypm_seokywrd,vehtypm_seohonetitle,vehtypm_seohonedesc,vehtypm_seohtwotitle,
					   vehtypm_seohtwodesc
	               from
				       vehtyp_mst
                   where
				       vehtypm_id=$id";
	$srsvehtyp_mst  = mysqli_query($conn,$sqryvehtyp_mst);
	$cntvehtyp_mst  = mysqli_num_rows($srsvehtyp_mst);
	if($cntvehtyp_mst > 0){
	  $rowsvehtyp_mst = mysqli_fetch_assoc($srsvehtyp_mst);
	}
	else{
	  header('Location: view_all_vehicle_type.php');
	  exit;
	}	
	$val  	  = glb_func_chkvl($_REQUEST['txtsrchval']);
		$chk  	  = glb_func_chkvl($_REQUEST['chkexact']); 
		if($val !=""){
			$loc ="&txtsrchval=".$val;	
		}
		if($chk == "y"){
			$loc .="&chkexact=".$chk;
		}
		if($lstcatid !=""){
			$loc .="&lstcatid=".$lstcatid;	
		}
		if($lsttypid !=""){
			$loc .="&lsttypid=".$lsttypid;	
		}
	
	
	/*$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary) || ($rqst_stp_attn[1]=='1') || ($rqst_stp_attn[1]=='2')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
	$rqst_stp      	= $rqst_arymdl[1];
	$rqst_stp_attn     = explode("::",$rqst_stp);
	$rqst_stp_chk      	= $rqst_arymdl[0];
	$rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
	if($rqst_stp_attn_chk[0] =='2'){
		$rqst_stp      	= $rqst_arymdl[0];
		$rqst_stp_attn     = explode("::",$rqst_stp);
	}
	
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(2,$sesvalary) || ($rqst_stp_attn[1]=='1') || ($rqst_stp_attn[1]=='2')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}*/	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
<?php include_once 'script.php';?>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';
	
		function setfocus()
		{
			document.getElementById('txtname').focus();
		}
	</script>
<?php 
	
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName()
	{
		var name;
		id 	 = <?php echo $id;?>;
		name = document.getElementById('txtname').value;		
		if((name != "") && (id != ""))
		{
			var url = "chkvalidname.php?vehtypname="+name+"&vehtypid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChanged() 
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtname').focus();
			}		
		}
	}	
	</script>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
</head>
<body onLoad="setfocus()">
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="admcnt_bdr">
      <tr>
        <td width="7" height="30" valign="top"></td>
        <td width="700" height="325" rowspan="2" valign="top"  bgcolor="#FFFFFF" class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
		  <table width="95%"  border="0" cellspacing="1" cellpadding="3">
            <form name="frmedtvehtyp" id="frmedtvehtyp" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmedtvehtyp', rules, 'inline');" enctype="multipart/form-data">
              <input type="hidden" name="hdnvehtypid" value="<?php echo $id;?>">
              <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
              <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
			  <input type="hidden" name="hdnloc" value="<?php echo $loc;?>">
              <input type="hidden" name="hdnsimgnm" value="<?php echo $rowsvehtyp_mst['vehtypm_img'];?>">
              <input type="hidden" name="hdnzmimgnm" value="<?php echo $rowsvehtyp_mst['vehtypm_zmimg'];?>">	  		
             <tr align="left" bgcolor="#333333">
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>Edit Vehical Type </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>	
			  <tr>
			  <tr bgcolor="#f9f8f8">
                <td width="26%" height="19" valign="middle" ><strong> Name</strong> * </td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle" >
                  <input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" value="<?php echo $rowsvehtyp_mst['vehtypm_name'];?>" onBlur="funcChkDupName()"></td>
                <td width="32%" ><span id="errorsDiv_txtname" style="color:#FF0000"></span></td>
                </tr>
               <tr bgcolor="#F2F1F1">
                <td  align="left" valign="top" colspan="4"><strong>Description</strong></td>
			  </tr>
			  <tr bgcolor="#f9f8f8">
                <td align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" cols="60" rows="15" id="txtdesc"><?php echo $rowsvehtyp_mst['vehtypm_desc'];?></textarea>
                  </td>
                </tr>
              <tr bgcolor="#F2F1F1">
                <td align="left"><strong>Brand Logo(Brand)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="middle" ><strong>:</strong></td>
                <td align="left" ><input name="flesmlimg" type="file" class="input" id="flesmlimg"></td>
                <td >
                  <?php				   
				   $imgnm = $rowsvehtyp_mst['vehtypm_img'];
				   $imgpath = $fldnm.$imgnm;
     			  if(($imgnm !="") && file_exists($imgpath))
				  {
					 echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
				  }
				  else
				  {
					 echo "Image not available";
				  }
					?></td>
                </tr>
              <!-- <tr bgcolor="#f9f8f8">
                <td align="left"><strong>Brand Logo(Zoom)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="middle" ><strong>:</strong></td>
                <td align="left" ><input name="flezmimg" type="file" class="input" id="flezmimg"></td>
                <td >
                  <?php				   
				   $imgnm = $rowsvehtyp_mst['vehtypm_zmimg'];
				   $imgpath = $fldnm.$imgnm;
     			  if(($imgnm !="") && file_exists($imgpath))
				  {
					 echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
				  }
				  else
				  {
					 echo "Image not available";
				  }
					?></td>
                </tr>
             <tr bgcolor="#F2F1F1">
				   <td width="18%"  align="left" valign="top" ><strong>SEO Title</strong></td>
					<td width="2%"  align="left" valign="top">:</td>
					<td width="80%"  colspan="2">
					 <input name="txtseotitle" type="text" class="select" id="txtseotitle" size="30" maxlength="50" value="<?php echo  $rowsvehtyp_mst['vehtypm_seotitle'];?>">
					</td>														
				 </tr>
				  <tr bgcolor="#f9f8f8">
					<td width="18%"  align="left" valign="top"><strong>SEO Description</strong></td>
					<td width="2%"  align="left" valign="top">:</td>
					<td width="80%"  colspan="2">
					<textarea name="txtseodesc" cols="33" rows="4" id="txtseodesc"><?php echo $rowsvehtyp_mst['vehtypm_seodesc'];?></textarea></td>														
				 </tr>
				  <tr bgcolor="#F2F1F1">
					<td width="18%"  align="left" valign="top"><strong>SEO Keyword</strong></td>
					<td width="2%"  align="left" valign="top">:</td>
					<td width="80%"  colspan="2">
					<textarea name="txtseokywrd" type="text" id="txtseokywrd" cols="33" rows="4"><?php echo $rowsvehtyp_mst['vehtypm_seokywrd'];?></textarea>
					</td>														
				 </tr>
				 <tr bgcolor="#f9f8f8"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H1-Title</strong></td>
					<td width="2%" align="center" valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" >
					<input name="txtseoh1ttl" type="text" class="select" id="txtseoh1ttl" size="30" maxlength="50" value="<?php echo $rowsvehtyp_mst['vehtypm_seohonetitle'];?>"></td>
				</tr>
				 <tr bgcolor="#F2F1F1"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H1-Description</strong></td>
					<td width="2%" align="center" valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" >
					<textarea name="txtseoh1desc" id="txtseoh1desc" cols="33" rows="4" class="select"><?php echo $rowsvehtyp_mst['vehtypm_seohonedesc'];?></textarea>			
					</td>
				  </tr>
				  <tr bgcolor="#f9f8f8"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H2-Title</strong></td>
					<td width="2%" align="center" valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" >
					<input name="txtseoh2ttl" type="text" class="select" id="txtseoh2ttl" size="30" maxlength="50" value="<?php echo $rowsvehtyp_mst['vehtypm_seohtwotitle'];?>"></td>
				</tr>
				  <tr bgcolor="#F2F1F1"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H2-Description</strong></td>
					<td width="2%" align="center" valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" >
					<textarea name="txtseoh2desc" id="txtseoh2desc" cols="33" rows="4" class="select"><?php echo $rowsvehtyp_mst['vehtypm_seohtwodesc'];?></textarea>			
					</td>
			  </tr> -->
			  <tr bgcolor="#f9f8f8">
                <td > <strong>Rank</strong> * </td>
                <td ><strong>:</strong></td>
                <td ><input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3" value="<?php echo $rowsvehtyp_mst['vehtypm_prty'];?>"></td>
                <td ><span id="errorsDiv_txtprior" style="color:#FF0000"></span></td>
                </tr>
              <tr bgcolor="#F2F1F1">
                <td width="26%" height="19" valign="middle" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="40%" align="left" valign="middle" >
                  <select name="lststs" id="lststs">
                    <option value="a"<?php if($rowsvehtyp_mst['vehtypm_sts']=='a') echo 'selected';?>>Active</option>
                    <option value="i"<?php if($rowsvehtyp_mst['vehtypm_sts']=='i') echo 'selected';?>>Inactive</option>
                    </select>					</td>
                <td ></td>
                </tr>
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnedtvehtyp" id="btnedtvehtyp" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btneprodcatrst" value="Reset" id="btneprodcatrst">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='view_all_vehicle_type.php?pg=<?php echo $pg."&countstart=".$countstart.$loc;?>'"></td>
                </tr>
              </form>
            </table>
          </td>
        <td width="6" valign="top" ></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>