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
	$fldnm=$gbrnd_upldpth;
	if(isset($_REQUEST['edit']) && $_REQUEST['edit']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id         = $_REQUEST['edit'];
		$pg         = $_REQUEST['pg'];
		$countstart = $_REQUEST['countstart'];
	}
	
	$sqryfdbck_mst="select
	                   fdbckm_emailid,fdbckm_name,fdbckm_phno,fdbckm_addr,
					   trtypm_name,prodcatm_name,prodscatm_name,brndm_name,
					   fdbckm_trpstn,fdbckm_trtyp,date_format(fdbckm_crtdon,'%d-%m-%Y %h:%i:%s') as fdbckm_crtdon,
					   sizem_name
	               from
				       vw_fdbck_all
                   where
				       fdbckm_id=$id";
	$srsfdbck_mst  = mysqli_query($conn,$sqryfdbck_mst);
	$cntfdbck_mst  = mysqli_num_rows($srsfdbck_mst);
	if($cntfdbck_mst > 0)
	{
	  $rowsfdbck_mst = mysqli_fetch_assoc($srsfdbck_mst);
	}
	else
	{
	  header('Location: vw_all_feedback.php');
	  exit;
	}	
	
	$val = glb_func_chkvl($_REQUEST['val']);
	$optn = glb_func_chkvl($_REQUEST['optn']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
    $loc = "&optn=".$optn."&val=".$val;
	if($chk !=""){
		$loc = "&optn=".$optn."&val=".$val."&chk=".$chk."";
	}
	
	
	$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);
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
            <form name="frmedtfdbck" id="frmedtfdbck" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmedtfdbck', rules, 'inline');" enctype="multipart/form-data">
              <input type="hidden" name="hdnfdbckid" value="<?php echo $id;?>">
              <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
              <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">	  		
        	  <tr align="left" class='white'>
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>View Product Enquiry </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>	
			  <tr>
		      <tr align="left" >
					<td colspan="4">
						<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" >
							<tr class='white'>
								  <td colspan="4"  align='left' bgcolor="#FF543A"><strong>
									Vehicle Information &nbsp;&nbsp;&nbsp;</strong>
								 </td>
							 </tr>
							 	<tr >			  
								  <td width="30%" align="left" ><strong>Vehicle Type</strong></td>
								  <td align="left"><?php echo $rowsfdbck_mst['trtypm_name'];?></td>
									<td width="30%" align="left" ><strong>Vehicle Brand</strong></td>
									<td align="left" ><?php echo $rowsfdbck_mst['prodcatm_name'];?></td>
								</tr>
							 	<tr bgcolor='#F2F1F1'>		
                                  
								  <td width="30%" align="left" ><strong>Vehicle Model</strong></td>
								  <td align="left" ><?php echo $rowsfdbck_mst['prodscatm_name'];?></td>
                                  
								  <td width="30%" align="left" ><strong>Brand</strong></td>
								  <td align="left" ><?php echo $rowsfdbck_mst['brndm_name'];?></td>                                                                      
								</tr>
                                <tr >	
								<td width="30%" align="left" ><strong>Tyre Position</strong></td>
								<td align="left"><?php 
									echo  functyrpstn($rowsfdbck_mst['fdbckm_trpstn']);
									
								
								?></td>
								<td  align="left" ><strong>Tyre Size</strong></td>
						   		<td align="left" ><?php echo  $rowsfdbck_mst['sizem_name'];?></td>
                               	</tr>
								<tr bgcolor='#F2F1F1'>	
								<td  align="left" ><strong>Tyre Type</strong></td>
						   		<td align="left" ><?php echo  functyrTyp($rowsfdbck_mst['fdbckm_trtyp']);?></td>	
                                  <td width="22%" align="left"><strong>Date And Time </strong></td>
                                  <td align="left"><?php echo $rowsfdbck_mst['fdbckm_crtdon'];?></td>
                                                                   
                            </tr> 
						</table>
					</td>
				</tr>
				
				
				
				
				
				<tr align="left" >
					<td colspan="4">
						<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" >
							<tr align="left" class='white'>
								  <td colspan="4"  align='left' bgcolor="#FF543A"><strong>
									Personal Information &nbsp;&nbsp;&nbsp;</strong>
								 </td>
							 </tr>
							 	<tr bgcolor='#F2F1F1'>			  
								  <td width="30%" align="left" ><strong>Email Id</strong></td>
								  <td align="left"><?php echo $rowsfdbck_mst['fdbckm_emailid'];?></td>
									<td width="30%" align="left" ><strong>Name</strong></td>
									<td align="left" ><?php echo $rowsfdbck_mst['fdbckm_name'];?></td>
								</tr>
							 	<tr >		
                                  
								  <td width="30%" align="left" ><strong>Phone Number</strong></td>
								  <td align="left" colspan='3'><?php echo $rowsfdbck_mst['fdbckm_phno'];?></td>                                                                      
								</tr>
                               <tr bgcolor='#F2F1F1'>
									<td width="30%" align="left" ><strong>Address</strong></td>
									<td align="left"  colspan='3'><?php echo $rowsfdbck_mst['fdbckm_addr'];?></td>	
								</tr>	
						</table>
					</td>
				</tr>
			  
              <tr valign="middle" bgcolor="#FFFFFF">
                <td colspan="3" align="center" bgcolor="#fff">
                  
				  &nbsp;&nbsp;&nbsp;
               <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='vw_all_feedback.php?pg=<?php echo $pg."&countstart=".$countstart.$loc;?>'"></td>
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