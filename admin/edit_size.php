<?php
	include_once '../includes/inc_nocache.php';        //Clearing the cache information
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_usr_functions.php";  //Making database Connection
	include_once "../includes/inc_folder_path.php";	
	include_once "../includes/inc_config.php";	
	/***************************************************************/
	//Programm 	  		: edit_size.php		
	//Purpose 	  			:	 Updating new size
	//Created By  		: Mallikarjuna
	//Created On  		:	16/04/2013
	//Modified By 		:  Aradhana
	//Modified On   	: 07-06-2014
	//Company 	  		:	 Adroit
	/************************************************************/
	global $id,$pg,$countstart,$gsz_smlpht,$gsz_bgpht;
	if(isset($_POST['btnesize']) && ($_POST['btnesize'] != "") && 	
	   isset($_POST['txtsize']) &&  (trim($_POST['txtsize'])!= "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior'])!= "")){
	     	  include_once "../database/uqry_size_mst.php";
	   }
	if(isset($_REQUEST['edit']) && (trim($_REQUEST['edit'])!="") && 
	   isset($_REQUEST['pg']) &&   (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id         = glb_func_chkvl($_REQUEST['edit']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);
	}
	elseif(isset($_REQUEST['hdnsizeid']) && (trim($_REQUEST['hdnsizeid'])!="") &&
	 	   isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") &&
	 	   isset($_REQUEST['hdncnt'])   && (trim($_REQUEST['hdncnt'])!="")){
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
	$val = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
    $loc = "&val=".$val;
	if($chk !=""){
		$loc = "&val=".$val."&chk=".$chk."";
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
	*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
<?php include_once  ('script.php'); ?>
	<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtsize:Name|required|Enter Name';
		rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';	
	</script>
	<script language="javascript">	
		function setfocus()
		{
			document.getElementById('txtsize').focus();
		}
	</script>
<?php 
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name;
		id 	 = <?php echo $id;?>;
		name = document.getElementById('txtsize').value;		
		if((name != "") && (id != "")){
			var url = "chkvalidname.php?sizename="+name+"&sizeid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtsize').innerHTML = "";
		}	
	}
	function stateChanged(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtsize").innerHTML = temp;
			if(temp!=0){
				document.getElementById('txtsize').focus();
			}		
		}
	}	
	</script></head>
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
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" bgcolor="#FFFFFF" align='center'>
            <form name="frmesize" id="frmesize" method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" onSubmit="return performCheck('frmesize', rules, 'inline');" enctype="multipart/form-data">
              <input type="hidden" name="hdnsizeid" value="<?php echo $id;?>">
              <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
			  <input type="hidden" name="hdnloc" value="<?php echo $loc;?>">
              <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
              <tr align="left" class='white'>
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>:: Edit Vehicle Type </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="22%" align="left" valign="top" ><strong>Name * </strong></td> 
                <td width="2%"  align="center" valign="top"><strong>:</strong></td> 
                <td width="40%" align="left" valign="top" >
                  <input name="txtsize" type="text" class="select" id="txtsize" size="45" maxlength="40" value="<?php echo $rowstrtyp_mst['trtypm_name'];?>" onBlur="funcChkDupName()"></td>
                <td width="36%"  align="left" valign="top"><span id="errorsDiv_txtsize" style="color:#FF0000"></span></td>
                </tr>			  
              <tr bgcolor="#f9f8f8">
                <td align="left"  colspan="4"><strong>Description :</strong></td>
			  </tr>
			  <tr>
                <td align="left"  colspan="4">
                  <textarea name="txtdesc" cols="60" rows="15"  id="txtdesc"><?php echo $rowstrtyp_mst['trtypm_desc'];?></textarea>				
                  </td>				  
                </tr>			
              <tr bgcolor="#f9f8f8">
                <td  align="left" valign="top"><strong>Rank </strong>* </td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td  align="left" valign="top"><input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3" value="<?php echo $rowstrtyp_mst['trtypm_prty'];?>"></td>
                <td ><span id="errorsDiv_txtprior" style="color:#FF0000"></span></td>
                </tr>		
              <tr bgcolor="#FFFFFF">
                <td width="22%" align="left" valign="top" ><strong>Status</strong></td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td width="40%" align="left" valign="top" >
                  <select name="lststs" id="lststs">
                    <option value="a" <?php if($rowstrtyp_mst['trtypm_sts']=='a') echo 'selected'; ?>>Active</option>
                    <option value="i" <?php if($rowstrtyp_mst['trtypm_sts']=='i') echo 'selected'; ?>>Inactive</option>
                    </select>					</td>
                <td ></td>
                </tr>
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnesize" id="btnesize" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnesizerst" value="Reset" id="btnesizerst">
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
	CKEDITOR.replace('txtdesc');
</script>