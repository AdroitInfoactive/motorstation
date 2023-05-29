<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once '../includes/inc_config.php';	
	/***************************************************************/
	//Programm 	  : edit_city.php	
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
	if(isset($_POST['btnedtcty']) && ($_POST['btnedtcty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
	{	
		include_once "../database/uqry_cty_mst.php";
	}
	if(isset($_REQUEST['hdnctyid']) && $_REQUEST['hdnctyid']!="")
	{
		$hdnctyid=$_POST['hdnctyid'];
	}
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id         = glb_func_chkvl($_REQUEST['vw']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);
		$optn       = glb_func_chkvl($_REQUEST['optn']);
		$val        = glb_func_chkvl($_REQUEST['val']);
		$chk        = glb_func_chkvl($_REQUEST['chk']);
	}
	else if(isset($_REQUEST['hdnctyid']) && $_REQUEST['hdnctyid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!="")
	{
		$id         = glb_func_chkvl($_REQUEST['hdnctyid']);
		$pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
		$optn       = glb_func_chkvl($_REQUEST['hdnoptn']);
		$val        = glb_func_chkvl($_REQUEST['hdnval']);
		$chk        = glb_func_chkvl($_REQUEST['hdnchk']);
	}
	$sqrycty_mst="select 
					  ctym_id,ctym_name,ctym_prty,ctym_cntym_id,
					  cntym_cntrym_id,ctym_sts,cntrym_id,cntrym_name,					  
					  cntym_id,cntym_name,ctym_iso
				  from 
				  	   cty_mst,cnty_mst,cntry_mst
				  where 
				       ctym_cntym_id=cntym_id  and 			
				       cntym_cntrym_id=cntrym_id  and 				
				       ctym_id=$id";
	$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
	$cntrec =mysqli_num_rows($srscty_mst);
	if($cntrec > 0){
		$rowscty_mst = mysqli_fetch_assoc($srscty_mst);
	}
	else{
		header("location:vw_all_city.php");
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
		//rules[0]='lstcnty:County|required|Select County';
 		rules[0]='lstcntry:Country Name|required|Select Country Name';
    	rules[1]='lstcnty:County Name|required|Select County Name'; 
		rules[2]='txtname:City Name|required|Enter City Name';
		rules[3]='txtiso:City Iso|required|Enter Iso Code';
   		rules[4]='txtprior:Rank|required|Enter Rank';
		rules[5]='txtprior:Rank|numeric|Enter Only Numbers';
	</script>
   <script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name;
		id 	 = <?php echo $id;?>;
		catid = document.getElementById('lstcnty').value;		
		name = document.getElementById('txtname').value;		
		if((name != "") && (id != "")){
			var url = "chkvalidname.php?ctyname="+name+"&ctyid="+id+"&cntyid="+catid;
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
					hdncntyid=document.getElementById('hdncnty').value;
					if(id==hdncntyid){
						optn.selected="selected";
					}									
					optn.value = id;					
					optn.text = name;
					document.getElementById('lstcnty').add(optn);
				}
			}
		}
	}	
</script>
</head>
<body onLoad="funcPopCnty()">
<?php 
 include_once ('../includes/inc_adm_header.php');
 include_once ('../includes/inc_adm_leftlinks.php');
 include_once ('../includes/inc_fnct_ajax_validation.php');	
 ?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
		<td height="400" valign="top"><br>
		  <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
	  <form name="frmedtcty" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post"  onSubmit="return performCheck('frmedtcty', rules, 'inline');">
		  <input type="hidden" name="hdnctyid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">	
		   <input type="hidden" name="hdncnty" id="hdncnty" value="<?php echo $rowscty_mst['ctym_cntym_id']?>">
		  <tr class='white'>
			<td height="26" colspan="4" bgcolor="#FF543A"><span class="heading"><strong> ::Edit City </strong></span></td>
		  </tr>	
		  <tr bgcolor="#f0f0f0">
			<td width="123" valign="top"> Country*</td>
			<td width="5" align="center">:</td>
			<td width="221">
			  <select name="lstcntry" id="lstcntry" onChange="funcPopCnty()">
				 <option value="">--Select--</option>
				 <?php 
				 $sqrycnty_mst = "select cntrym_id,cntrym_name
								   from cnty_mst,cntry_mst
								   where cntym_cntrym_id=cntrym_id
								   and cntym_sts='a'
								   and cntrym_sts='a'
								   group by cntrym_id
								   order by cntrym_prty";								
				$srscnty_mst= mysqli_query($conn,$sqrycnty_mst) or die(mysql_error());
				while($srowcnty_mst = mysqli_fetch_assoc($srscnty_mst))
				{
				
				?>
				 <option value="<?php echo $srowcnty_mst['cntrym_id']?>" 
				 <?php if(isset($_POST['lstcntry']) && (trim($_POST['lstcntry'])!="")) 
							  {
								echo 'selected';
							  }
							  elseif($srowcnty_mst['cntrym_id'] ==  $rowscty_mst['cntym_cntrym_id'])
							  {
							  	echo 'selected';							  
							  }					
						?>> 
				   <?php echo $srowcnty_mst['cntrym_name']?></option>
				 <?php
				}
				?>
		    </select></td>
			<td width="369"><span id="errorsDiv_lstcntry" ></span></td>
		  </tr>
		  <tr bgcolor="#f0f0f0">
			<td width="123" valign="top"> County*</td>
			<td width="5" align="center">:</td>
			<td width="221">
			<select name="lstcnty" id="lstcnty">
			<option value="">--Select--</option>
			</select>
			</td>
			<td width="369"><span id="errorsDiv_lstcnty" ></span></td>
		  </tr>
		  <tr bgcolor="#f0f0f0">
			<td width="123"> Name*</td>
			<td width="5" align="center">:</td>
			<td width="221"><input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50"   onBlur="funcChkDupName()"  value="<?php echo $rowscty_mst['ctym_name'];?>"></td>
			<td width="369"><span id="errorsDiv_txtname" ></span></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
					<td width="21%" height="19" valign="middle" bgcolor="#f0f0f0">ISO Code *</td>
					<td bgcolor="#f0f0f0">:</td>
					<td width="42%" align="left" valign="middle" bgcolor="#f0f0f0">
					<input name="txtiso" type="text" class="select" id="txtiso" size="3" maxlength="3" value="<?php echo $rowscty_mst['ctym_iso'];?>">			
				  </td>
					<td width="35%" align="left" valign="middle" bgcolor="#f0f0f0">
						<span id="errorsDiv_txtiso" ></span></td>
			  	</tr>
		  <tr bgcolor="#f0f0f0">
			<td align="left"> Rank *</td>
			<td width="5" align="center">:</td>
			<td><input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3" value="<?php echo $rowscty_mst['ctym_prty'];?>"></td>
				<td><span id="errorsDiv_txtprior" ></span></td>
		  </tr>		
		<tr bgcolor="#f0f0f0">
			<td align="left">Status</td>
			<td width="5" align="center">:</td>
			<td>
			<select name="lststs" id="lststs">
				<option value="a"<?php if($rowscty_mst['ctym_sts']=='a') echo 'selected';?>>Active</option>
				<option value="i"<?php if($rowscty_mst['ctym_sts']=='i') echo 'selected';?>>Inactive</option>
			  </select>	</td>
			<td>&nbsp;</td>
		  </tr>		
          <tr bgcolor="#f0f0f0"> 
            <td colspan="4"  align="right" valign="middle">&nbsp;</td>
          </tr>
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="center">
			  <input name="btnedtcty" type="submit" class="" value="Save">
				<input type="Reset" class=""  name="btnReset" value="Reset">
           	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_city.php?pg=<?php echo $pg."&countstart=".$countstart;?>&optn=<?php echo $optn;?>&val=<?php echo $val;?>&chk=<?php echo $chk;?>'">			                     
		  </tr>
	    </form>
		</table>
		</td>
    </tr>  
</table>
  <?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>