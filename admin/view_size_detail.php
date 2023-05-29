<?php
	include_once '../includes/inc_nocache.php';        //Clearing the cache information
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_usr_functions.php";  //Making database Connection
	include_once "../includes/inc_folder_path.php";
	include_once "../includes/inc_config.php";		
	/***************************************************************/
	//Programm 	  		: view_size_detail.php		
	//Purpose 	  			: View Size Detail
	//Created By  		: Mallikarjuna
	//Created On 	 	:	16/04/2013
	//Modified By 		:  Aradhana
	//Modified On   	: 07-06-2014
	//Company 	  		: Adroit
	/************************************************************/
	global $id,$pg,$countstart,$gsz_smlpht,$gsz_bgpht;
	if(isset($_REQUEST['edit'])       && (trim($_REQUEST['edit'])!="")
	&& isset($_REQUEST['pg'])         &&   (trim($_REQUEST['pg'])!="")
	&& isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="") )
	{
		$id         = glb_func_chkvl($_REQUEST['edit']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);
	}
	else if(isset($_REQUEST['hdnsizeid']) && (trim($_REQUEST['hdnsizeid'])!="")
	&& isset($_REQUEST['hdnpage'])        && (trim($_REQUEST['hdnpage'])!="")
	&& isset($_REQUEST['hdncnt'])         && (trim($_REQUEST['hdncnt'])!=""))
	{
		$id         = glb_func_chkvl($_REQUEST['hdnsizeid']);
		$pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	}
	$sqrytrtyp_mst  ="select 
	                   trtypm_id,trtypm_name,trtypm_sts,trtypm_prty,
					   trtypm_desc				   
				     from 
				       trtyp_mst
                     where 
				       trtypm_id=$id";
	$srstrtyp_mst   = mysqli_query($conn,$sqrytrtyp_mst);
	$cntrectrtyp_mst= mysqli_num_rows($srstrtyp_mst);
	if($cntrectrtyp_mst > 0)
	{
		$rowstrtyp_mst = mysqli_fetch_assoc($srstrtyp_mst);
	}
	else
	{
		header("Location:view_all_size.php");
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
	<script language="javascript">	
		function setfocus()
		{
			document.getElementById('txtsize').focus();
		}
		function update1()//for update product details
		{
document.frmesize.action="edit_size.php?update=1&edit=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>" 
				document.frmesize.submit();
		}
	</script>
<?php 
	include_once ('script.php');
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
        <td width="700" height="325" rowspan="2" valign="top"   class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
		  <br>
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center' bgcolor="#FFFFFF">
            <form name="frmesize" id="frmesize" method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" onSubmit="return performCheck('frmesize',rules,'inline');" enctype="multipart/form-data">
              <input type="hidden" name="hdnsizeid" value="<?php echo $id;?>">
              <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
              <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
              <tr align="left" class='white'>
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>:: View Vehicle Type </strong></span>&nbsp;&nbsp;&nbsp;</td>
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
                <td width="34%" height="19" valign="middle" ><strong>Name </strong></td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="64%" align="left" valign="middle" >
                  <?php echo $rowstrtyp_mst['trtypm_name'];?></td>
                </tr>
              
              <tr bgcolor="#f9f8f8">
                <td align="left"  colspan="3"><strong>Description </strong></td>
			 </tr>
			 <tr>
                <td align="left"  colspan="3">
                  <?php echo $rowstrtyp_mst['trtypm_desc'];?>				
                  </td>				  
                </tr>				
              <tr bgcolor="#f9f8f8">
                <td > <strong>Rank </strong>  </td>
                <td ><strong>:</strong></td>
                <td ><?php echo $rowstrtyp_mst['trtypm_prty'];?></td>
                 </tr>		
              <tr bgcolor="#FFFFFF">
                <td width="34%" height="19" valign="middle" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="64%" align="left" valign="middle" >
                  <?php echo funcDispSts($rowstrtyp_mst['trtypm_sts']); ?>                  </td>
               </tr>
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="3" align="center" >
                   <?php
						//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
					?>
				  <input type="Submit" class="textfeild"  name="btnesize" id="btnesize" value="Edit" onclick="update1()">
                  <?php
				//  }
				  ?>
				  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='view_all_size.php?pg=<?php echo $pg."&countstart=".$countstart.$loc;?>'"></td>
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
