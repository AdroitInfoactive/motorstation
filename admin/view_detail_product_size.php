<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once "../includes/inc_config.php";	
	include_once "../includes/inc_folder_path.php";	
	/***************************************************************
	Programm 	  : view_detail_product_subcategory.php	
	Purpose 	  : For Viewing Product SubCategory Details
	Created By    : Mallikarjuna
	Created On    :	31/10/2013
	Modified By   : Aradhana
	Modified On   :20-01-2014
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
		$val  	  = glb_func_chkvl($_REQUEST['txtsrchval']);
		$txttofrmdt	= glb_func_chkvl($_REQUEST['txttofrmdt']);	 
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
		if($txttofrmdt !=""){
		$loc .="&txttofrmdt=".$txttofrmdt;	
		}
		$sqrysize_mst="select 
							sizem_name,sizem_desc,sizem_trtypm_id,sizem_seotitle,
							if(sizem_sts = 'a', 'Active','Inactive') as sizem_sts,
							trtypm_prty,sizem_prty,trtypm_name,sizem_seodesc,
							sizem_seokywrd,sizem_szchrtimg,sizem_seohonettl,sizem_seohtwottl,
							sizem_seohonedesc,sizem_seohtwodesc,sizem_icnimg
						  from 
								size_mst inner join trtyp_mst on trtypm_id = sizem_trtypm_id
						  where 
								sizem_id=$id";
		$srssize_mst  = mysqli_query($conn,$sqrysize_mst);
		$cntrec =mysqli_num_rows($srssize_mst);
		if($cntrec > 0){
		$rowssize_mst = mysqli_fetch_assoc($srssize_mst);
		}else{
			header("Location:view_product_size.php");
			exit();
		}
	}
	else{
		header("Location:view_product_size.php");
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
 document.frmedtsizeid.action="edit_product_size.php?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>";  
 document.frmedtsizeid.submit();
}
</script>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>
</head>
<body>
<?php include_once  '../includes/inc_adm_header.php';
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
		 class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#FFFFFF">
            <form name="frmedtsizeid" id="frmedtsizeid" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		   onSubmit="return performCheck('frmedtsizeid', rules, 'inline');" enctype="multipart/form-data">
              <input type="hidden" name="vw" id="vw" value="<?php echo $id;?>">
              <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
              <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
			  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
			  <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">  
              <tr class='white'>
				<td bgcolor='#FF543A' colspan='4' >
					<span class="heading">View Tyre Size </span>		
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
			  <tr bgcolor="#f9f8f8">
                <td width="24%" height="19" valign="middle" ><strong>Vehicle Type </strong></td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle"  colspan="2">
                  <?php echo $rowssize_mst['trtypm_name'];?> </td>
                </tr>	  		
              <tr bgcolor="#FFFFFF">
                <td width="24%" height="19" valign="middle" ><strong> Name  </strong></td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle"  colspan="2">
                  <?php echo $rowssize_mst['sizem_name'];?> </td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td > <strong>Description</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2"> <?php echo stripslashes($rowssize_mst['sizem_desc']);?>	  </td>
                </tr>
            
			<?php /*?> <tr>			  
				<td ><strong> Image</strong></td>
				<td ><strong>:</strong></td>
				<td  colspan="2">
					<?php
					   $imgnm   = $rowssize_mst['sizem_szchrtimg'];
					   $imgpath = $gszchrt_upldpth.$imgnm;
						if(($imgnm !="") && file_exists($imgpath)){
							  echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
						   }
						   else{
							  echo "Image not available";						 				  
						}
					?>		
				 &nbsp;&nbsp;<strong>(SIZES: H 400 X W 300) </strong></td>	
			</tr><?php */?>
				<tr bgcolor="#FFFFFF">
                <td > <strong>SEO Title</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2"><?php echo $rowssize_mst['sizem_seotitle'];?></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td > <strong>SEO Keyword</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2"><?php echo $rowssize_mst['sizem_seokywrd'];?></td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td > <strong>SEO Description</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2"><?php echo $rowssize_mst['sizem_seodesc'];?>	  </td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H1-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowssize_mst['sizem_seohonettl'];?>	  </td>
             </tr>
			 <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H1-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowssize_mst['sizem_seohonedesc'];?>	  </td>
             </tr>	
			 <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H2-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowssize_mst['sizem_seohtwottl'];?>	  </td>
             </tr>	
			 <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H2-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2"><?php echo $rowssize_mst['sizem_seohtwodesc'];?>	  </td>
             </tr>			 
                <tr bgcolor="#f9f8f8">
                <td > <strong>Priority</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <?php echo $rowssize_mst['sizem_prty'];?>	  </td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="24%" height="19" valign="middle" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="40%" align="left" valign="middle"  colspan="2">
                  <?php echo $rowssize_mst['sizem_sts'];?>
                  </td>
                </tr>
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="frmedtsizeid" id="frmedtsizeid" value="Edit" 
						  onclick="update1()">
                  &nbsp;&nbsp;&nbsp;                 
                  <input type="button"  name="btnBack" value="Back" class="textfeild" 
					  onclick="location.href='view_product_size.php?pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>'">	</td>
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