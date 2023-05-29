<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once '../includes/inc_config.php';
	/***************************************************************/
	//Programm 	  : edit_county.php	
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
	if(isset($_POST['btnedtcntry']) && ($_POST['btnedtcntry'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	
		include_once "../database/uqry_cnty_mst.php";
	}
	if(isset($_REQUEST['hdncntyid']) && $_REQUEST['hdncntyid']!=""){
		$hdncntyid=$_POST['hdncntyid'];
	}
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!=""){
		$id         = glb_func_chkvl($_REQUEST['vw']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);
		$optn       = glb_func_chkvl($_REQUEST['optn']);
		$val        = glb_func_chkvl($_REQUEST['val']);
		$chk        = glb_func_chkvl($_REQUEST['chk']);
	}
	else if(isset($_REQUEST['hdncntyid']) && $_REQUEST['hdncntyid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!=""){
		$id         = glb_func_chkvl($_REQUEST['hdncntyid']);
		$pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
		$optn       = glb_func_chkvl($_REQUEST['hdnoptn']);
		$val        = glb_func_chkvl($_REQUEST['hdnval']);
		$chk        = glb_func_chkvl($_REQUEST['hdnchk']);
	}
	 $sqrycnty_mst="select 
						cntym_id,cntym_cntrym_id,cntym_name,cntym_prty,
						cntym_cntrym_id,cntym_sts,cntrym_prty,
						cntym_iso						
				    from 
					    cnty_mst,cntry_mst
				    where 
						cntym_cntrym_id=cntrym_id  and 				 
				  	    cntym_id=$id";
	$srscnty_mst  = mysqli_query($conn,$sqrycnty_mst) or die(mysql_error());
	$cntrec =mysqli_num_rows($srscnty_mst);
	if($cntrec > 0){
		$rowscnty_mst = mysqli_fetch_assoc($srscnty_mst);
	}
	else{
		header("location:vw_all_county.php");
		exit();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $pgtl;?></title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
		rules[0]='lstcntry:Country Name|required|Select Country Name';
    	rules[1]='txtname:Name|required|Enter Name';
		rules[2]='txtiso:Iso|required|Enter Iso Code';
    	rules[3]='txtprior:Rank|required|Enter Rank';
		rules[4]='txtprior:Rank|numeric|Enter Only Numbers';
	</script>
   <script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name;
		id 	 = <?php echo $id;?>;		
		name = document.getElementById('txtname').value;		
		if((name != "") && (id != "")){
			var url = "chkvalidname.php?cntyname="+name+"&cntyid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChanged(){ 
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
<body>
<?php 
 include_once ('../includes/inc_adm_header.php');
 include_once ('../includes/inc_adm_leftlinks.php');
 include_once ('../includes/inc_fnct_ajax_validation.php');	
 ?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
		<td height="400" valign="top"><br>
		  <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
	  <form name="frmedtcnty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post"  onSubmit="return performCheck('frmedtcnty', rules, 'inline');">
		  <input type="hidden" name="hdncntyid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		  <input type="hidden" name="hdnoptn" value="<?php echo $optn?>">	 
		  <input type="hidden" name="hdnval" value="<?php echo $val?>">	  	
		  <input type="hidden" name="hdnchk" value="<?php echo $chk?>">	  	
		  <tr class='white'>
			<td height="26" colspan="4" bgcolor="#FF543A"><span class="heading"><strong> ::Edit County </strong></span></td>
		  </tr>		  		  
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="left"  class="heading">&nbsp;</td>
		  </tr>	
		  <tr bgcolor="#f0f0f0">
			<td width="123"> Country*</td>
			<td width="5" align="center">:</td>
			<td width="214">
				 <select name="lstcntry" id="lstcntry">
                   <option value="">--Select--</option>
                   <?php
					 $sqrycntry_mst = "select cntrym_id,cntrym_name
									   from cntry_mst
									   where cntrym_sts='a'";								
					$srscntry_mst= mysqli_query($conn,$sqrycntry_mst) or die(mysql_error());
					while($srowcntry_mst = mysqli_fetch_assoc($srscntry_mst))
					{
					?>
                   <option value="<?php echo $srowcntry_mst['cntrym_id']?>"
					<?php if(isset($_POST['lstcntry']) && (trim($_POST['lstcntry'])!="")){
								echo 'selected';
							  }
							  elseif($srowcntry_mst['cntrym_id'] ==  $rowscnty_mst['cntym_cntrym_id']){
							  	echo 'selected';							  
							  }					
					?>><?php echo $srowcntry_mst['cntrym_name']?></option>
                   <?php
					}
					?>
            </select></td>
			<td width="376"><span id="errorsDiv_lstcntry" ></span></td>
		  </tr>
		  <tr bgcolor="#f0f0f0">
			<td width="123"> Name*</td>
			<td width="5" align="center">:</td>
			<td width="214"><input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50"   onBlur="funcChkDupName()"  value="<?php echo $rowscnty_mst['cntym_name'];?>"></td>
			<td width="376"><span id="errorsDiv_txtname" ></span></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
				<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0">ISO Code *</td>
				<td bgcolor="#f0f0f0">:</td>
				<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
				<input name="txtiso" type="text" class="select" id="txtiso" size="3" maxlength="3" value="<?php echo $rowscnty_mst['cntym_iso'];?>">				
			    </td>
				<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0">
						<span id="errorsDiv_txtiso"></span></td>
		  </tr>
		  <tr bgcolor="#f0f0f0">
			<td align="left">Rank *</td>
			<td width="5" align="center">:</td>
			<td><input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3" value="<?php echo $rowscnty_mst['cntym_prty'];?>"></td>
				<td><span id="errorsDiv_txtprior" ></span></td>
		  </tr>		
		<tr bgcolor="#f0f0f0">
			<td align="left">Status</td>
			<td width="5" align="center">:</td>
			<td>
			<select name="lststs" id="lststs">
				<option value="a"<?php if($rowscnty_mst['cntym_sts']=='a') echo 'selected';?>>Active</option>
				<option value="i"<?php if($rowscnty_mst['cntym_sts']=='i') echo 'selected';?>>Inactive</option>
			  </select>	</td>
			<td>&nbsp;</td>
		  </tr>		
          <tr bgcolor="#f0f0f0"> 
            <td colspan="4"  align="right" valign="middle">&nbsp;</td>
          </tr>
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="center">
			  <input name="btnedtcntry" type="submit" class="" value="Save">
				<input type="Reset" class=""  name="btnReset" value="Reset">
           	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_county.php?pg=<?php echo $pg."&countstart=".$countstart;?>&optn=<?php echo $optn;?>&val=<?php echo $val;?>&chk=<?php echo $chk;?>'">			                     
		  </tr>
	    </form>
		</table> 
		</td>
    </tr>  
</table>
  <?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>