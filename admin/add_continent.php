<?php
	include_once '../includes/inc_nocache.php';    // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_config.php';       //Making paging validation	
	/***************************************************************/
	//Programm 	  : add_continent.php	
	//Purpose 	  : For adding new zone
	//Created By  : Aradhana
	//Created On  :	21-01-2014
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnacntntsbmt']) && (trim($_POST['btnacntntsbmt'])!= "") &&
	  isset($_POST['txtname']) && (trim($_POST['txtname'])!= "") && 	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty'])!= "")){
		include_once "../database/iqry_cntnt_mst.php";
	}
?>
<html>
<head>
<title>...:: <?php echo $pgtl; ?> ::...</title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<title><?php echo $pgtl;?></title>
	<title><?php echo $pgtl;?></title>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
		rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprty:Rank|required|Enter Rank';
		rules[2]='txtprty:Rank|numeric|Enter Only Numbers';	
	function setfocus(){
			document.getElementById('txtcode').focus();
		}
	</script>
<?php 
	include_once ('script.php');
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function setfocus(){
			document.getElementById('txtname').focus();
	}
	function funcChkDupName(){
		var cntntnm;
		cntntnm  = document.getElementById('txtname').value;				
		if(cntntnm!= ""){
			var url = "chkvalidname.php?cntntnm="+cntntnm;
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
<link href="yav-style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body onLoad="setfocus()">
<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="1" >
    <tr>
      <td height="400" valign="top"><br>
	    <table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">     
		  <form name="frmacntnt" id="frmacntnt" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmacntnt', rules, 'inline');">		  	 
		  		<tr align="left" class='white'  bgcolor="#FF543A">
                   <td height="26" colspan="4">
				  <span class="heading"><strong> :: Add Continent </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
				<?php
					if($gmsg != ""){
						echo "<tr bgcolor='#FFFFFF'>
								<td align='center' valign='middle' bgcolor='#f0f0f0' colspan='4'>
									<font face='Arial' size='2' color='#fda33a'>
										$gmsg
									</font>							
								</td>
							</tr>";
					}	
				  ?>				
				<tr bgcolor="#FFFFFF">
				 <td bgcolor="#f0f0f0"><strong>Name * </strong></td>
				 <td bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td bgcolor="#f0f0f0"><input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40"  onBlur="funcChkDupName()"></td>
				 <td bgcolor="#f0f0f0"><div id="errorsDiv_txtname"></div></td>
				</tr>	
				<tr bgcolor="#FFFFFF">
				 <td bgcolor="#f0f0f0"><strong>Iso Code  </strong></td>
				 <td bgcolor="#f0f0f0"><strong>:</strong></td>
				 <td bgcolor="#f0f0f0"><input name="txtisocd" type="text" class="select" id="txtisocd" size="4" maxlength="4"></td>
				 <td bgcolor="#f0f0f0"><div id="errorsDiv_txtisocd"></div></td>
				</tr>		  	
				<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Rank *</strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtprty" type="text" class="select" id="txtprty" size="3" maxlength="3">				
				  </td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtprty"></span></td>
			  	</tr>				
			  	<tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0"><strong>Status</strong></td>
					<td bgcolor="#f0f0f0"><strong>:</strong></td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0" colspan="2">					
					<select name="lststs" id="lststs">
						<option value="a" selected>Active</option>
						<option value="i">Inactive</option>
				  </select></td>
				</tr>			  
			  <tr valign="middle" bgcolor="#FFFFFF">
				<td colspan="4" align="center" bgcolor="#f0f0f0">
				<input type="Submit" class="textfeild"  name="btnacntntsbmt" id="btnacntntsbmt" value="Submit">
				&nbsp;&nbsp;&nbsp;
				<input type="reset" class="textfeild"  name="btncntyreset" value="Reset" id="btncntyreset">
				&nbsp;&nbsp;&nbsp;
				<input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='vw_all_continent.php'">				                 </td>
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