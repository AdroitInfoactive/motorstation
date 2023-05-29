<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//include functions	
	include_once '../includes/inc_config.php'; 
	/***************************************************************/
	//Programm 	  : edit_country.php
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
	if(isset($_POST['btnecnty']) && ($_POST['btnecnty'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "")&& 	
	   isset($_POST['txtisothr']) && ($_POST['txtisothr'] != "") && 
	   isset($_POST['lstcntnt']) && ($_POST['lstcntnt'] != "") && 	
	   isset($_POST['txtprty']) && ($_POST['txtprty'] != "")){	
		include_once "../database/uqry_cntry_mst.php";
	}
	if(isset($_REQUEST['hdncntyid']) && $_REQUEST['hdncntyid']!=""){
	$hdncntyid=glb_func_chkvl($_POST['hdncntyid']);
	}
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!=""){
		$id           = glb_func_chkvl($_REQUEST['vw']);
		$pg           = glb_func_chkvl($_REQUEST['pg']);
		$countstart   = glb_func_chkvl($_REQUEST['countstart']);
		$optn         = glb_func_chkvl($_REQUEST['optn']);
		$lstsrchcntnt = glb_func_chkvl($_REQUEST['lstsrchcntnt']);
		$txtsrchval   = glb_func_chkvl($_REQUEST['txtsrchval']);
		$chkexact 	  = glb_func_chkvl($_REQUEST['chkexact']);
        $sqrycntry_mst="select 
							cntrym_id,cntrym_cntntm_id,cntrym_name,cntrym_isotwo,
							cntrym_isothr,cntrym_isonum,cntrym_sts,cntrym_prty
					    from 
					   		vw_cntry_cntnt_mst
	                    where 
					   		cntrym_id=$id";
		
	    $srscntry_mst  = mysqli_query($conn,$sqrycntry_mst) or die(mysql_error());
		$cntrec_cntry= mysqli_num_rows($srscntry_mst);
		if($cntrec_cntry > 0){
	    $rowscntry_mst = mysqli_fetch_assoc($srscntry_mst);
		}
		else{
			header("Location:vw_all_country.php");
			exit();	
		}
	}
	else{
		header("Location:vw_all_country.php");
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
	   	rules[0]='lstcntnt:Continent Name|required|Select Continent Name';
    	rules[1]='txtname:Name|required|Enter Name';
    	rules[2]='txtisothr:Country Iso Code|required|Enter Country ISO-3 Code';
		rules[3]='txtprty:Rank|required|Enter Rank';
		rules[4]='txtprty:Rank|numeric|Enter Only Numbers';	
	 </script>
	 <script language="javascript">	
		function setfocus(){
			document.getElementById('txtname').focus();
		}
	 </script>
<?php include_once ('../includes/inc_fnct_ajax_validation.php');?>
<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name,cntntidval,id;
		id 	 = <?php echo $id;?>;
		name = document.getElementById('txtname').value;	
		cntntidval 	= document.getElementById('lstcntnt').value;		
		if((name != "") && (id != "") && (cntntidval != "")){
			var url = "chkvalidname.php?cntryname="+name+"&cntryid="+id+"&cntntid="+cntntidval;
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
<body onLoad="setfocus()">
<?php include_once ('../includes/inc_adm_header.php');?>
<?php include_once ('../includes/inc_adm_leftlinks.php'); ?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
  <tr valign="top"> 
	<td height="400"><br>
	    <table width="95%" align="center"  border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
		  <form name="frmeprodtypdtl" id="frmeprodtypdtl" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmeprodtypdtl', rules, 'inline');">
		  <input type="hidden" name="hdncntyid" id="hdncntyid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		  <input type="hidden" name="hdnoptn" id="hdnoptn" value="<?php echo $optn;?>">
		  <input type="hidden" name="lstsrchcntnt" id="lstsrchcntnt" value="<?php echo $lstsrchcntnt?>">	  	
		  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $txtsrchval?>">	
		   <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chkexact?>">	
		       <tr bgcolor="#333333">
				<td height="26" colspan="4" class='white'  bgcolor="#FF543A">
					<span class="heading"><strong> ::Edit Country </strong></span>&nbsp;&nbsp;&nbsp;</td>
			  </tr>	 		
		  	  <tr bgcolor="#f0f0f0">
                <td width="24%" height="19" valign="middle"><strong>Continent Name * </strong></td> 
				<td width="2%"><strong>:</strong></td> 
                 <td width="40%" align="left" valign="middle">
				 <select name="lstcntnt" id="lstcntnt" >
                   <option value="">Select</option>
                   <?php
					 $sqrycntnt_mst ="select 
										cntntm_id,cntntm_name
								      from 
										cntnt_mst
								      where 
										cntntm_sts='a'
								    order by cntntm_name asc";								
					$srscntnt_mst = mysqli_query($conn,$sqrycntnt_mst) or die(mysql_error());
					$cnt_cntnt	  = mysqli_num_rows($srscntnt_mst);
					if($cnt_cntnt > 0){
						while($srowcntnt_mst = mysqli_fetch_assoc($srscntnt_mst)){
						?>
					   <option value="<?php echo $srowcntnt_mst['cntntm_id']?>"
							<?php if($srowcntnt_mst['cntntm_id'] ==  $rowscntry_mst['cntrym_cntntm_id']){
									echo 'selected';							  
								  }					
							?>> <?php echo $srowcntnt_mst['cntntm_name']?></option>
					   <?php
						}
					}
					?>
                 </select></td>
                 <td width="41%"><span id="errorsDiv_lstcntnt"></span></td>
			  </tr>
  		  	  <tr bgcolor="#f0f0f0">
                <td width="24%" valign="middle"><strong>Country Name * </strong></td> 
				<td width="2%"><strong>:</strong></td> 
                 <td width="40%" align="left" valign="middle">
				 <input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" value="<?php echo $rowscntry_mst['cntrym_name'];?>" onBlur="funcChkDupName()"></td>
                 <td width="41%" align="left" valign="middle"><span id="errorsDiv_txtname"></span></td>
			   </tr>
			   <tr bgcolor="#f0f0f0">
					<td width="24%" valign="middle"><strong>ISO-2 Code * </strong></td>
					<td width="2%"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle" colspan="2">
					<input name="txtisotwo" type="text" class="select" id="txtisotwo" size="2" maxlength="5" value="<?php echo $rowscntry_mst['cntrym_isotwo'];?>">				  </td>
					
			  	</tr>
				<tr bgcolor="#f0f0f0">
					<td width="24%" height="19" valign="middle"><strong> ISO-3 Code * </strong></td>
					<td width="2%"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle">
					<input name="txtisothr" type="text" class="select" id="txtisothr" size="3" maxlength="5" value="<?php echo $rowscntry_mst['cntrym_isothr'];?>">				
				  </td>
				  	<td width="35%" align="left" valign="middle"><span id="errorsDiv_txtisothr"></span></td>
				</tr>
				<tr bgcolor="#f0f0f0">
					<td width="24%" valign="middle"><strong> ISO-Num Code * </strong></td>
					<td width="2%"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle" colspan="2">
					<input name="txtisonum" type="text" class="select" id="txtisonum" size="5" maxlength="5" value="<?php echo $rowscntry_mst['cntrym_isonum'];?>">				
				  </td>
				</tr>
				<tr bgcolor="#f0f0f0">
					<td width="24%" valign="middle"><strong>Rank * </strong></td>
					<td width="2%"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle">
				  <input name="txtprty" type="text" class="select" id="txtprty" size="3" maxlength="3" value="<?php echo $rowscntry_mst['cntrym_prty'];?>">				  </td>
					<td width="41%" align="left" valign="middle" bgcolor="f0f0f0"><span id="errorsDiv_txtprty"></span></td>
			  	</tr>
				  <tr bgcolor="#f0f0f0">
					<td width="24%" height="19" valign="middle"><strong>Status</strong></td>
					<td><strong>:</strong></td>
					<td width="40%" align="left" valign="middle">
					<select name="lststs" id="lststs">
						<option value="a"<?php if($rowscntry_mst['cntrym_sts']=='a') echo 'selected';?>>Active</option>
						<option value="i"<?php if($rowscntry_mst['cntrym_sts']=='i') echo 'selected';?>>Inactive</option>
				    </select>					</td>
					<td bgcolor="f0f0f0"></td>
				  </tr>
					  <tr valign="middle" bgcolor="#FFFFFF">
						<td colspan="4" align="center" bgcolor="f0f0f0">
						<input type="Submit" class=""  name="btnecnty" id="btnecnty" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class=""  name="btnecntyrst" value="Reset" id="btnecntyrst" >
						&nbsp;&nbsp;&nbsp;
					    <input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_country.php?pg=<?php echo $pg."&countstart=".$countstart;?>&optn=<?php echo $optn;?>&lstsrchcntnt=<?php echo $lstsrchcntnt;?>&txtsrchval=<?php echo $txtsrchval;?>&chkexact=<?php echo $chkexact;?>'">						</td>
					  </tr>
				  </form>
      </table>
    </td>
      </tr></table>
	</td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>