<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
    include_once '../includes/inc_config.php'; 
	/**************************************/
	//Programm 	  : add_county.php	
	//Company 	  : Adroit
	/**************************************/
	global $gmsg;	
	if(isset($_POST['btnaddcnty']) && ($_POST['btnaddcnty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
		include_once "../database/iqry_cnty_mst.php";
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
    	rules[1]='txtname:County Name|required|Enter County Name';
		rules[2]='txtiso:County Iso|required|Enter Iso Code';
    	rules[3]='txtprior:Rank|required|Enter Rank';
		rules[4]='txtprior:Rank|numeric|Enter Only Numbers';		
	</script>
	<script language="javascript">	
	function setfocus(){
		document.getElementById('txtname').focus();
	}
	function funcChkDupName(){
		var name;
		var catid;
		name    = document.getElementById('txtname').value;	
		if(name != ""){
			var url = "chkvalidname.php?cntyname="+name;
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
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
      <td height="400" valign="top"><br>
        <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
        <form name="frmaddscat" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post" onSubmit="return performCheck('frmaddscat', rules, 'inline');">
		 <tr class='white'>
		   	<td height="26" colspan="4" bgcolor="#FF543A">
				<span class="heading"><strong>::Add County </strong></span>&nbsp;&nbsp;&nbsp;</td>
	      </tr>
		   <tr bgcolor="#f0f0f0">
		   	<td colspan="5" align="center">&nbsp;
				<strong><font color="#fda33a">
				<?php
					if(isset($gmsg) && $gmsg!=""){
						echo $gmsg;
					}
				  ?>
				  </font></strong> </td>
	      </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="18%" align="left" valign="middle">Country*</td>
			<td width="2%" align="center">:</td>
            <td width="28%" align="left" valign="middle">
				  <select name="lstcntry" id="lstcntry" >
                    <option  value="">--Select--</option>
                    <?php
							$sqrycntry_mst = "select 
												   cntrym_id,cntrym_name 
							                  from 
											       cntry_mst
											  where 
											      cntrym_sts='a'
											  order by cntrym_name";
						    $srscntry_mst = mysqli_query($conn,$sqrycntry_mst);							
							while($srowcntry_mst = mysqli_fetch_assoc($srscntry_mst))
							{			
						?>
                    <option value="<?php echo $srowcntry_mst['cntrym_id'];?>"><?php echo $srowcntry_mst['cntrym_name'];?> </option>
                    <?php	
							}
						?>
                  </select>			</td>
			<td width="52%"><span id="errorsDiv_lstcntry" ></span></td>												
		 </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="18%" align="left" valign="middle">Name*</td>
			<td width="2%" align="center">:</td>
            <td width="28%" align="left" valign="middle">
			  <input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50"   onBlur="funcChkDupName()" >			</td>
			<td width="52%"><span id="errorsDiv_txtname" ></span></td>												
		 </tr>
		 <tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0">ISO Code *</td>
					<td bgcolor="#f0f0f0">:</td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtiso" type="text" class="select" id="txtiso" size="3" maxlength="3">				
				  </td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0">
						<span id="errorsDiv_txtiso" ></span></td>
	  	  </tr>
 		<tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" >Rank *</td>
				<td width="2%" align="center">:</td>
			<td width="28%">
			   <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3"></td>
			<td width="52%"><span id="errorsDiv_txtprior" ></span></td>												
		  </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="middle">Status</td>
			<td width="2%" align="center">:</td>
            <td width="28%" align="left" valign="middle">
				<select name="lststs">
					<option value="a" selected>Active</option>
					<option value="i">Inactive</option>	
			   </select>			</td>
			<td width="52%"></td>												
		  </tr>
          <tr bgcolor="#f0f0f0"> 
            <td colspan="4"  align="right" valign="middle">&nbsp;</td>
          </tr>
          <tr valign="middle" bgcolor="#f0f0f0"> 
            <td colspan="4" align="center">
				<input type="Submit" class=""  name="btnaddcnty" value="Submit">&nbsp;&nbsp;&nbsp;
				<input type="Reset" class=""  name="btnReset" value="Reset">&nbsp;&nbsp;&nbsp;
           	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_county.php'">         </td>            
          </tr>          
        </form>
      </table>
	  </td>
	</tr>  
</table>
<?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>