<?php
	include_once '../includes/inc_nocache.php';      //Clearing the cache information
	include_once "../includes/inc_adm_session.php";  //checking for session
	include_once "../includes/inc_connection.php";   //Making database Connection
	include_once "../includes/inc_usr_functions.php";//checking for session
	include_once '../includes/inc_config.php';       //Making paging validation
	include_once '../includes/inc_folder_path.php';//Floder Path
	/***************************************************************/
	//Programm 	  		: view_brand_detail.php	
	//Created By  		: Mallikarjuna
	//Created On  		:	16/04/2013
	//Modified By 		: Aradhana
	//Modified On   	: 07-06-2014
	//Company 	  		: Adroit
	/************************************************************/
	global $id,$pg,$countstart,$fldnm;
	$fldnm=$gvehtyp_upldpth;
	if(isset($_REQUEST['edit']) && $_REQUEST['edit']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id         = $_REQUEST['edit'];
		$pg         = $_REQUEST['pg'];
		$countstart = $_REQUEST['countstart'];
	}
	else if(isset($_REQUEST['hdnvehtypid']) && $_REQUEST['hdnvehtypid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!="")
	{
		$id         = $_REQUEST['hdnvehtypid'];
		$pg         = $_REQUEST['hdnpage'];
		$countstart = $_REQUEST['hdncnt'];
	}
	$sqryvehtyp_mst="select
	                   vehtypm_id,vehtypm_name,vehtypm_desc,vehtypm_img,
					   vehtypm_zmimg,vehtypm_sts,vehtypm_prty,vehtypm_seotitle,
					   vehtypm_seodesc,vehtypm_seokywrd,vehtypm_seohonetitle,vehtypm_seohonedesc, 					
					   vehtypm_seohtwotitle,vehtypm_seohtwodesc
	               from
				       vehtyp_mst
                   where
				       vehtypm_id=$id";
	$srsvehtyp_mst  = mysqli_query($conn,$sqryvehtyp_mst);
	$cntvehtyp_mst  = mysqli_num_rows($srsvehtyp_mst);
	if($cntvehtyp_mst > 0)
	{
	  $rowsvehtyp_mst = mysqli_fetch_assoc($srsvehtyp_mst);
	}
	else
	{
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
	
	
	
	/*$rqst_stp      	= $rqst_arymdl[1];
	$rqst_stp_attn     = explode("::",$rqst_stp);
	$rqst_stp_chk      	= $rqst_arymdl[0];
	$rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
	if($rqst_stp_attn_chk[0] =='2'){
		$rqst_stp      	= $rqst_arymdl[0];
		$rqst_stp_attn     = explode("::",$rqst_stp);
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
<?php include_once 'script.php';?>	
<?php 
	
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript">	
      function update1()//for update product details
	  {
      document.frmproddtl.action="edit_vehicle_type.php?<?php echo $loc;?>";
			document.frmproddtl.submit();
	  }
</script>
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
			document.getElementById('errorsDiv_txtname').value = "";
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
  function update(){
			document.frmproddtl.action="edit_products.php?<?php echo $loc;?>";
			document.frmproddtl.submit();
		}
	</script>
	<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
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
              <input type="hidden" name="hdnsimgnm" value="<?php echo $rowsvehtyp_mst['vehtypm_img'];?>">
              <input type="hidden" name="hdnzmimgnm" value="<?php echo $rowsvehtyp_mst['vehtypm_zmimg'];?>">	  		
        	  <tr align="left" class='white'>
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>View Vehicle Type </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>	
			  <tr>
		      
			  <tr bgcolor="#F2F1F1">
                <td width="37%" align="left" valign="top" ><strong> Name</strong> * </td> 
                <td width="3%" align="left" valign="top" ><strong>:</strong></td> 
                <td width="60%" align="left" valign="top" >
                  <?php echo $rowsvehtyp_mst['vehtypm_name'];?></td>
              </tr>
              <tr bgcolor="#f9f8f8">
                <td align="left" valign="top"  colspan="3"><strong>Description</strong></td>
			  </tr>
			  <tr bgcolor="#F2F1F1">
                 <td align="left" valign="top"  colspan="3">
                  <?php echo $rowsvehtyp_mst['vehtypm_desc'];?>
                  </td>
                </tr>
              <!-- <tr bgcolor="#f9f8f8">
                <td align="left" valign="top"><strong>Brand Logo(Brand)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="top" ><strong>:</strong></td>
                <td align="left" valign="top">
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
					?> -->
                  <!-- </td>
               </tr>
              <tr bgcolor="#F2F1F1">
                <td align="left" valign="top"><strong>Brand Logo(Zoom)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="top" ><strong>:</strong></td>
                <td align="left" valign="top">
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
				  ?>
                  </td>
                </tr>
             <tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle" ><strong>SEO Title</strong> </td>
					<td width="2%"  ><strong> :</strong></td> 
                 	<td width="42%" align="left" valign="middle"  colspan="2">
						<?php echo $rowsvehtyp_mst['vehtypm_seotitle'];?>
					</td>
                 	
				</tr>
				<tr bgcolor="#F2F1F1">
                	<td width="13%" height="19" valign="middle" ><strong>SEO Description</strong> </td>
					<td width="2%"  ><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle"  colspan="2">
						<?php echo $rowsvehtyp_mst['vehtypm_seodesc'];?>
					</td>
                 	
				</tr>
				<tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle" ><strong>SEO Keyword</strong> </td>
					<td width="2%"  ><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle"  colspan="2">
						<?php echo $rowsvehtyp_mst['vehtypm_seokywrd'];?>
					</td>
                 	
				</tr>
				<tr bgcolor="#F2F1F1"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H1-Title</strong></td>
					<td width="2%"  valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" ><?php echo $rowsvehtyp_mst['vehtypm_seohonetitle'];?></td>
				</tr>
				 <tr bgcolor="#f9f8f8"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H1-Description</strong></td>
					<td width="2%"  valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" ><?php echo $rowsvehtyp_mst['vehtypm_seohonedesc'];?></td>
				  </tr>
				  <tr bgcolor="#F2F1F1"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H2-Title</strong></td>
					<td width="2%"  valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" ><?php echo $rowsvehtyp_mst['vehtypm_seohtwotitle'];?></td>
				</tr>
				  <tr bgcolor="#f9f8f8"> 
					<td width="16%" align="left" valign="top" ><strong>SEO H2-Description</strong></td>
					<td width="2%"  valign="top" >:</td>
					<td colspan="2" align="left" valign="middle" ><?php echo $rowsvehtyp_mst['vehtypm_seohtwodesc'];?></td>
				  </tr> -->
			  <tr bgcolor="#F2F1F1">
                <td  align="left" valign="top"> <strong>Rank</strong> * </td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td  align="left" valign="top"><?php echo $rowsvehtyp_mst['vehtypm_prty'];?></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td width="37%" align="left" valign="top" ><strong>Status</strong></td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td align="left" valign="top"  colspan="2">
                  <?php echo funcDispSts($rowsvehtyp_mst['vehtypm_sts']);?>                  </td>
               </tr>
              <tr valign="middle" bgcolor="#F2F1F1">
                <td colspan="3" align="center" >
                  <?php
					//	if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
					?>
				  <input type="Submit" class="textfeild"  name="btnedtvehtyp"  value="Edit" onClick="update1()">
                  <?php
				  //}
				  ?>
				  &nbsp;&nbsp;&nbsp;
               <!--   <input type="reset" class="textfeild"  name="btneprodcatrst" value="Clear" id="btneprodcatrst">
                  &nbsp;&nbsp;&nbsp;-->
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
	generate_wysiwyg('txtdesc');
</script>