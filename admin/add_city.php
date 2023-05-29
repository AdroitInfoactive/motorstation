<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once '../includes/inc_config.php';	
	/**************************************/
	//Programm 	  : add_city.php	
	//Company 	  : Adroit
	/**************************************/
	global $gmsg;	
	if(isset($_POST['btnaddcty']) && ($_POST['btnaddcty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
	{
		include_once "../database/iqry_cty_mst.php";
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
    	rules[1]='lstcnty:County Name|required|Select County Name'; 
		rules[2]='txtname:City Name|required|Enter City Name';
		rules[3]='txtiso:City Iso|required|Enter Iso Code';
   		rules[4]='txtprior:Rank|required|Enter Rank';
		rules[5]='txtprior:Rank|numeric|Enter Only Numbers';
	</script>
	<script language="javascript">	
	function setfocus(){
		document.getElementById('txtname').focus();
	}
	function funcChkDupName(){
		var name;
		var catid;
		name = document.getElementById('txtname').value;	
		catid = document.getElementById('lstcnty').value;		
		if((name != "") && (catid != "")){
			var url = "chkvalidname.php?ctyname="+name+"&cntyid="+catid;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChanged() { 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0){
				document.getElementById('txtname').focus();
			}		
		}
	}	
	function funcPopCnty(){
		var cntryid;
		cntryid = document.getElementById('lstcntry').value;	
		for(i=document.getElementById('lstcnty').length-1;i>=1; i--){
			document.getElementById('lstcnty').options[i] = null;
		}							
		if(cntryid != ""){
			var url = "chkvalidname.php?selcntryid="+cntryid;			
			xmlHttp	= GetXmlHttpObject(funcCnty);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			//document.getElementById("divlstCntry").innerHTML = "";
		}
	}
	function funcCnty(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			if(temp != ""){
				tempary   	= Array();
				tempary   	= temp.split(",");				
				cntrlary  	= 0;
				var id 	  	= "";
				var name  	= "";
				var selstr 	= "";
				var optn   	= "";				
				for(var i = 0; i < (tempary.length); i++){
					cntryary = tempary[i].split(":");
					id 		 = cntryary[0];
					name 	 = cntryary[1];
					optn 	 = document.createElement("OPTION");					
					optn.value = id;					
					optn.text = name;
					document.getElementById('lstcnty').add(optn);
				}
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
        <form name="frmaddcty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post" onSubmit="return performCheck('frmaddcty', rules, 'inline');">
		   <tr class='white' bgcolor="#FF543A">
		   	<td height="26" colspan="4">
				<span class="heading"><strong>::Add City </strong></span></td>
	      </tr>
		   <tr bgcolor="#f0f0f0">
		   	<td colspan="4" align="center">&nbsp;
				<strong><font color="#fda33a">
				<?php
					if(isset($gmsg) && $gmsg!="")
					{
						echo $gmsg;
					}
				  ?>
				  </font></strong> </td>
	      </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="18%" align="left" valign="middle">Country*</td>
			<td width="2%" align="center">:</td>
            <td width="29%" align="left" valign="middle">
				  <select name="lstcntry" id="lstcntry" onChange="funcPopCnty()">
					<option value="">--Select--</option>
					<?php
					 $sqrycntry_mst = "select cntrym_id,cntrym_name
									   from vw_cnty_mst
									   where cntym_sts='a'
									   and cntrym_sts='a'
									   group by cntrym_id
									   order by cntrym_prty";								
					$srscntry_mst	  = mysqli_query($conn,$sqrycntry_mst) or die(mysql_error());
					while($srowcntry_mst = mysqli_fetch_assoc($srscntry_mst))
					{
					?>
					<option value="<?php echo $srowcntry_mst['cntrym_id']?>"><?php echo $srowcntry_mst['cntrym_name']?></option>
					<?php
					}
					?>
				  </select>	</td>
			<td width="51%"><span id="errorsDiv_lstcntry" ></span></td>												
		 </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="18%" align="left" valign="middle">County*</td>
			<td width="2%" align="center">:</td>
            <td width="29%" align="left" valign="middle">
			<select name="lstcnty" id="lstcnty">
			<option value="">--Select--</option>
			</select>			</td>
			<td width="51%"><span id="errorsDiv_lstcnty" ></span></td>												
		 </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="18%" align="left" valign="middle">Name*</td>
			<td width="2%" align="center">:</td>
            <td width="29%" align="left" valign="middle">
			  <input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50"   onBlur="funcChkDupName()" >			</td>
			<td width="51%"><span id="errorsDiv_txtname" ></span></td>												
		 </tr>
		 <tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0">ISO Code *</td>
					<td bgcolor="#f0f0f0">:</td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtiso" type="text" class="select" id="txtiso" size="3" maxlength="3">				
				  </td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0"><span id="errorsDiv_txtiso" ></span></td>
			  	</tr>
 		<tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" >Rank *</td>
				<td width="2%">:</td>
			<td width="29%">
			   <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3"></td>
			<td width="51%"><span id="errorsDiv_txtprior" ></span></td>												
		  </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="middle">Status</td>
			<td width="2%" align="center">:</td>
            <td width="29%" align="left" valign="middle">
				<select name="lststs">
					<option value="a" selected>Active</option>
					<option value="i">Inactive</option>	
			   </select>			</td>
			<td width="51%"></td>												
		  </tr>
          <tr bgcolor="#f0f0f0"> 
            <td colspan="4"  align="right" valign="middle">&nbsp;</td>
          </tr>
          <tr valign="middle" bgcolor="#f0f0f0"> 
            <td colspan="4" align="center">
				<input type="Submit" class=""  name="btnaddcty" value="Submit">&nbsp;&nbsp;&nbsp;
				<input type="Reset" class=""  name="btnReset" value="Reset">&nbsp;&nbsp;&nbsp;
           	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_city.php'">         </td>            
          </tr>          
        </form>
      </table>
	  </td>
	</tr>  
</table>
<?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>