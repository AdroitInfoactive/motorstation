<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_config.php'; 
	/***************************************************************/
	//Programm 	  : add_country.php	
	//Company 	  : Adroit
	/************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnacntysbmt']) && ($_POST['btnacntysbmt'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "")&& 	
	   isset($_POST['txtisothr']) && ($_POST['txtisothr'] != "")&& 	
	   isset($_POST['txtprty']) && ($_POST['txtprty'] != "") && 
	   isset($_POST['lstcntntnm']) && (trim($_POST['lstcntntnm']) != "")){
		include_once "../database/iqry_cntry_mst.php";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<title><?php echo $pgtl;?></title>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
		rules[0]='lstcntntnm:Continent Name|required|Select Continent Name';
	   	rules[1]='txtname:Name|required|Enter Name';
		rules[2]='txtisothr:Country Iso Code|required|Enter Country ISO-3 Code';
		rules[3]='txtprty:Rank|required|Enter Rank ';
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
		var name;
		name = document.getElementById('txtname').value;
		var cntntidval 	= document.getElementById('lstcntntnm').value;		
		if((name != "") && (cntntidval != "")){
			var url = "chkvalidname.php?cntryname="+name+"&cntntid="+cntntidval;
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
<?php 
	  include_once ('../includes/inc_adm_header.php');
      include_once ('../includes/inc_adm_leftlinks.php'); 
?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
      <td height="400" valign="top"><br>
        <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
        <form name="frmacnty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post" onSubmit="return performCheck('frmacnty', rules, 'inline');">			
		   <tr bgcolor="#333333">
		   	<td height="26" colspan="4"  class='white' bgcolor="#FF543A">
				<span class="heading"><strong> ::Add Country </strong></span>&nbsp;&nbsp;&nbsp;</td>
	      </tr>		  
		   <tr bgcolor="#f0f0f0">
		   	<td colspan="4" align="center">&nbsp;
				<strong><font color="#fda33a">
				<?php
					if(isset($gmsg) && $gmsg!=""){
						echo "<font face='Arial' size='2' color = '#fda33a'>$gmsg</font>";
					}
				  ?>
				  </font></strong></td>
			  </tr>
			  <tr bgcolor="#f0f0f0">
                <td width="24%" height="19" valign="middle"><strong>Continent Name * </strong></td> 
				<td width="2%"><strong>:</strong></td> 
                 <td width="40%" align="left" valign="middle">
				 	<select name="lstcntntnm" id="lstcntntnm" >
						<option value="">Select</option>
						<?php
						$sqrycntnt_mst ="select 
											cntntm_id,cntntm_name 
									     from 
											cntnt_mst
									     where 
											cntntm_sts='a'
									     order by cntntm_name asc";
						$srscntnt_mst = mysqli_query($conn,$sqrycntnt_mst);
						$cnt_cntnt	  = mysqli_num_rows($srscntnt_mst);
						if($cnt_cntnt > 0){							
							while($srowcntnt_mst = mysqli_fetch_assoc($srscntnt_mst)){			
					    ?>
								<option value="<?php echo $srowcntnt_mst['cntntm_id'];?>"><?php echo $srowcntnt_mst['cntntm_name'];?> </option>
					     <?php	
							}
						}
					    ?>
						</select>
				  </td>
                 	<td width="41%"><span id="errorsDiv_lstcntntnm"></span></td>
				</tr>
				<tr>
				 <td bgcolor="#f0f0f0"><strong>Name * </strong></td>
				 <td bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td bgcolor="#f0f0f0"><input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()"></td>
				 <td bgcolor="#f0f0f0"><span id="errorsDiv_txtname"></span></td>
				</tr>
			  	<tr bgcolor="#FFFFFF">
					<td width="23%" height="19" valign="middle" bgcolor="#f0f0f0"><strong> ISO-2 Code </strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle" bgcolor="#f0f0f0" colspan="2">
					<input name="txtisotwo" type="text" class="select" id="txtisotwo" size="2" maxlength="3">				
				  </td>					
			  	</tr>
				<tr bgcolor="#FFFFFF">
					<td width="23%" height="19" valign="middle" bgcolor="#f0f0f0"><strong> ISO-3 Code * </strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtisothr" type="text" class="select" id="txtisothr" size="3" maxlength="5">				
				  </td>
				  	<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtisothr"></span></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="23%" height="19" valign="middle" bgcolor="#f0f0f0"><strong> ISO-Num Code</strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="40%" align="left" valign="middle" bgcolor="#f0f0f0" colspan="2">
					<input name="txtisonum" type="text" class="select" id="txtisonum" size="5" maxlength="5">				
				  </td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Rank * </strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtprty" type="text" class="select" id="txtprty" size="3" maxlength="3">				
				    </td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0">
					<span id="errorsDiv_txtprty"></span></td>
			  	</tr>
			  	<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Status</strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">					
					<select name="lststs" id="lststs">
						<option value="a" selected>Active</option>
						<option value="i">Inactive</option>
				    </select></td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_lststs"></span></td>
			  	</tr>			  
			  <tr valign="middle" bgcolor="#f0f0f0">
				<td colspan="4" align="center" bgcolor="#f0f0f0">
				<INPUT type="Submit" class=""  name="btnacntysbmt" id="btnacntysbmt" value="Submit">
				&nbsp;&nbsp;&nbsp;
				<INPUT type="reset" class=""  name="btncntyreset" value="Reset" id="btncntyreset">
				&nbsp;&nbsp;&nbsp;
				<INPUT type="button"  name="btnBack" value="Back" class="" onClick="location.href='vw_all_country.php'">				                 </td>
			  </tr>
			  </form>
      </table>
    </td>
      </tr></table>
	</td>
  </tr>
</table>
<?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>