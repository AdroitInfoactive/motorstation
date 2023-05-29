<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_config.php';//Making paging validation	
	include_once "../includes/inc_usr_functions.php"; //Use function for validation and more	
	/***************************************************************/
	//Programm 	  : edit_continent.php	
	//Package 	  : 
	//Purpose 	  : To Edit continent Record
	//Created By  : 
	//Created On  :	
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/	
	global $id,$pg,$cntstrt;
	if(isset($_POST['btnecntnt']) && (trim($_POST['btnecntnt'])!="") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname'])!="") && 	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty'])!="") &&
	   isset($_POST['hdnid']) && (trim($_POST['hdnid'])!="")){	
	   		include_once "../database/uqry_cntnt_mst.php";
	}
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") &&
	   isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id 		= glb_func_chkvl($_REQUEST['vw']);
		$pg 		= glb_func_chkvl($_REQUEST['pg']);
		$cntstart 	= glb_func_chkvl($_REQUEST['countstart']);
		$loc		= "vw=$id&pg=$pg&countstart=$cntstart";
		$val 		= glb_func_chkvl($_REQUEST['val']);
		$chk 		= glb_func_chkvl($_REQUEST['chk']);
		
		if($val!=""){
			$loc .= "&val=$val&chk=$chk";
		}
	}
	elseif(isset($_POST['hdnid']) && (trim($_POST['hdnid'])!="") &&
		isset($_POST['hdnpage']) && (trim($_POST['hdnpage'])!="") &&
		isset($_POST['hdncnt']) && (trim($_POST['hdncnt'])!="")){
	  	   
		$id  	 = glb_func_chkvl($_POST['hdnid']);
		$pg  	 = glb_func_chkvl($_POST['hdnpage']);
		$cntstrt = glb_func_chkvl($_POST['hdncnt']);
		$loc 	 = "vw=$id&pg=$pg&countstart=$cntstrt";
		$srchval = glb_func_chkvl($_POST['hdnval']);
		$chk	 = glb_func_chkvl($_POST['hdnchk']);		 
		 if($srchval != ""){
			$loc .= "&val=$srchval&chk=$chk";
		}
	}
	else{
		header("Location:vw_all_continent.php");
		exit();	
	}
	$sqrycntnt_mst="select 
					  cntntm_name,cntntm_iso,cntntm_prty,cntntm_sts					  
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<link href="style_admin.css" rel="stylesheet" type="text/css">
<title><?php echo $pgtl;?></title>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
		rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprty:Rank|required|Enter Rank';
		rules[2]='txtprty:Rank|numeric|Enter Only Numbers';	 
	 function setfocus(){
			document.getElementById('txtname').focus();
	 }
	 </script>
<?php 
	include_once ('script.php');
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var cntntnm,cntntid;
		cntntid  = <?php echo $id;?>;		
		cntntnm  = document.getElementById('txtname').value;				
		if(cntntnm!= "" && cntntid!=""){
			var url = "chkvalidname.php?cntntnm="+cntntnm+"&cntntid="+cntntid;
			xmlHttp	= GetXmlHttpObject(stateChangedZn);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChangedZn(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0){
				document.getElementById('txtname').focus();
			}		
		}
	}	
	</script> 
</head>
<body onLoad="setfocus()">
<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
  <tr valign="top"> 
	<td height="400" valign="top"><br>
	    <table width="95%" align="center"  border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
			  <form name="frmecntntdtl" id="frmecntntdtl" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmecntntdtl', rules, 'inline');">
				  <input type="hidden" name="hdnid" id="hdnid" value="<?php echo $id;?>">
				  <input type="hidden" name="hdnpage" id="hdnpage" value="<?php echo $pg;?>">
				  <input type="hidden" name="hdncnt" id="hdncnt" value="<?php echo $cntstrt;?>">
				  <input type="hidden" name="hdnval" id="hdnval" value="<?php echo $srchval;?>">
				  <input type="hidden" name="hdnchk" id="hdnchk" value="<?php echo $chk;?>">
				<tr align="left" class='white'>
                   <td height="26" colspan="4" bgcolor="#FF543A">
				  <span class="heading"><strong> :: Edit Continent </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>				
				<tr bgcolor="#FFFFFF">
				 <td width="24%" bgcolor="#f0f0f0"><strong>Name * </strong></td>
				 <td width="2%" bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td width="30%" bgcolor="#f0f0f0"><input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" value="<?php echo $rowscntnt_mst['cntntm_name'];?>"></td>
				 <td width="34%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtname"></span></td>
				</tr>	
				<tr bgcolor="#FFFFFF">
				 <td width="24%" bgcolor="#f0f0f0"><strong>Iso Code </strong></td>
				 <td width="2%" bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td width="30%" bgcolor="#f0f0f0"><input name="txtisocd" type="text" class="select" id="txtisocd" size="4" maxlength="5" value="<?php echo $rowscntnt_mst['cntntm_iso'];?>"></td>
				 <td width="34%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtisocd"></span></td>
				</tr>					  	
				<tr bgcolor="#FFFFFF">
					<td width="24%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Rank *</strong></td>
					<td width="2%" bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="30%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtprty" type="text" class="select" id="txtprty" size="3" maxlength="3" value="<?php echo $rowscntnt_mst['cntntm_prty'];?>"></td>
					<td width="34%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtprty"></span></td>
				</tr>				
			  	<tr bgcolor="#FFFFFF">
					<td width="24%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Status</strong></td>
					<td width="2%" bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="74%" align="left" valign="middle" bgcolor="#f0f0f0" colspan="2">					
						<select name="lststs" id="lststs">
							<option value="a"<?php if($rowscntnt_mst['cntntm_sts'] =='a') echo 'selected';?>>Active</option>
							<option value="i"<?php if($rowscntnt_mst['cntntm_sts'] =='i') echo 'selected';?>>Inactive</option>							
					 	</select>	
					</td>
				</tr>			 
			    <tr valign="middle" bgcolor="#FFFFFF">
				<td colspan="4" align="center" bgcolor="#f0f0f0">
				<input type="Submit" class="textfeild"  name="btnecntnt" id="btnecntnt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="textfeild"  name="btnecntntrst" value="Reset" id="btnecntntrst">
						&nbsp;&nbsp;&nbsp;
						  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='vw_all_continent.php?<?php echo $loc;?>'">			                 
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