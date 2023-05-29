<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once "../includes/inc_config.php";	
	include_once "../includes/inc_folder_path.php";
	/***************************************************************
	Programm 	  : view_detail_product_category.php	
	Purpose 	  : For Viewing Product Category Details
	Created By    : Aradhana
	Created On    :	15-10-2014
	Modified By   : 
	Modified On   :
	Purpose 	  : 
	Company 	  : Adroit
	************************************************************/
	global $id,$pg,$countstart;
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") &&
	   isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id 	  = glb_func_chkvl($_REQUEST['vw']);
		$pg 	  = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
		$lstcatid = glb_func_chkvl($_REQUEST['lstcatid']);
		$lsttypid = glb_func_chkvl($_REQUEST['lsttypid']);
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
			
		$sqryprodcat_mst="select 
								prodcatm_name,prodcatm_desc,prodcatm_seotitle,prodcatm_seodesc,
								prodcatm_smlimg,prodcatm_bnrimg,prodcatm_seokywrd,prodcatm_hmprty,
								if(prodcatm_sts = 'a', 'Active','Inactive') as prodcatm_sts,prodcatm_prty,
								prodcatm_seohonettl,prodcatm_seohtwottl,prodcatm_seohonedesc,prodcatm_seohtwodesc
						  from 
								prodcat_mst
						  where 
								prodcatm_id=$id";
		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrec =mysqli_num_rows($srsprodcat_mst);
		if($cntrec > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
		}else{
			header("Location:view_product_category.php");
			exit();
		}
	}
	else{
		header("Location:view_product_category.php");
		exit();
	}
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != '')){
		if($_REQUEST['sts'] == 'y'){
			$msg = "<font color=#fda33a>Record updated successfully</font>";
		}
		elseif($_REQUEST['sts'] == 'n'){
			$msg = "<font color=#fda33a>Record not updated</font>";
		}
		elseif($_REQUEST['sts'] =='d'){
			$msg = "<font color=#fda33a>Duplicate Record Exists & Record Not updated</font>";
		}
	}	
?>
<script language="javascript">	
function update1()  //for update download details
{
 document.frmedtprodcatid.action="edit_product_category.php?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>";  
 document.frmedtprodcatid.submit();
}
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="admcnt_bdr"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif" 
		  style="background-position:top; background-repeat:repeat-x; ">
          
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center' bgcolor="#FFFFFF">
            <form name="frmedtprodcatid" id="frmedtprodcatid" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		   onSubmit="return performCheck('frmedtprodcatid', rules, 'inline');">
              <input type="hidden" name="vw" id="vw" value="<?php echo $id;?>">
              <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
              <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
			  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
			  <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">  		
              <tr class='white'>
				<td bgcolor='#FF543A' colspan='4' >
					<span class="heading">View Vehicle Brand </span>		
				</td>
			</tr>
			  <?php
			  	if($msg != ""){
					echo "<tr bgcolor='#FFFFFF'>
							<td align='center' valign='middle' bgcolor='#F3F3F3' colspan='4' >
								<font face='Arial' size='2' color = '#fda33a'>
									$msg
								</font>							
							</td>
			  			</tr>";
				}	
			  ?>	
			  <tr bgcolor="#FFFFFF">
					<td width="22%" height="19" valign="top" ><strong> Name  </strong></td> 
					<td width="3%"  valign="top"><strong>:</strong></td> 
					<td align="left" valign="top"  colspan="2">
					  <?php echo $rowsprodcat_mst['prodcatm_name'];?> </td>
              </tr>
              <tr bgcolor="#f9f8f8">
					<td  colspan="4" valign="top"> <strong>Description :</strong>  </td>
				</tr>
              <tr bgcolor="#FFFFFF">
					<td  colspan="4" valign="top"> <?php echo stripslashes($rowsprodcat_mst['prodcatm_desc']);?>	  </td>
              </tr>
             <?php /*?> <tr>
					<td width="22%" height="19" valign="top" ><strong>Small Image</strong>
					<td  valign="top"><strong>:</strong></td>
					<td width="58%" valign="top"  colspan="2">
                  <?php
					   $imgnm   = $rowsprodcat_mst['prodcatm_smlimg'];
					   $imgpath = $gadmcatsml_upldpth.$imgnm;
						   if(($imgnm !="") && file_exists($imgpath)){
						  echo "<img src='$imgpath' width='80pixel' height='80pixel'>";					 
					   }
					   else{
						  echo "Image not available";						 			  
					   }
				  ?>
				<br/><strong>(SIZES: H 400 X W 300) </strong></td>	 	
              </tr>				  
              <tr>
                  <td width="22%" height="19" valign="top" ><strong>Icon Image</strong>
                  <td ><strong>:</strong></td>
                  <td  colspan="2">
                  <?php
					   $imgnm   = $rowsprodcat_mst['prodcatm_bnrimg'];
					   $imgpath = $gadmcatbnr_upldpth.$imgnm;
					   if(($imgnm !="") && file_exists($imgpath)){
						  echo "<img src='$imgpath' width='80pixel' height='80pixel'>";					 
					   }
					   else{
						  echo "Image not available";						 				  
					   }
				  ?>	<br><strong>(SIZES: H 100 X W 100) </strong>	
                  </td>	                  		 	
              </tr><?php */?>
			  <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seotitle'];?></td>
              </tr>
              <tr bgcolor="#FFFFFF">
				<td  valign="top"> <strong>SEO Keyword</strong>  </td>
				<td  valign="top"><strong>:</strong></td>
				<td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seokywrd'];?></td>
              </tr>
              <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seodesc'];?>	  </td>
              </tr>
			  <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H1-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seohonettl'];?>	  </td>
             </tr>
			 <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H1-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seohonedesc'];?>	  </td>
             </tr>	
			 <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H2-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seohtwottl'];?>	  </td>
             </tr>	
			 <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H2-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowsprodcat_mst['prodcatm_seohtwodesc'];?>	  </td>
             </tr>			 		 		 
              <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>Rank</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <?php echo $rowsprodcat_mst['prodcatm_prty'];?>	  </td>
              </tr>	
			  <tr bgcolor="#f9f8f8">
                <td width="22%" valign="top" ><strong>Status</strong></td>
                <td  valign="top"><strong>:</strong></td>
                <td align="left" valign="top"  colspan="2">
                  <?php echo $rowsprodcat_mst['prodcatm_sts'];?>                  </td>
              </tr>
              <tr valign="middle" bgcolor="#FFFFFF">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="frmedtprodcatid" id="frmedtprodcatid" value="Edit" 
						  onclick="update1()">
                  &nbsp;&nbsp;&nbsp;                  
                  <input type="button"  name="btnBack" value="Back" class="textfeild" 
					  onclick="location.href='view_product_category.php?pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>'">							</td>
                </tr>
              </form>
            </table>
        </td>
      </tr>     
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>