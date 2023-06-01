<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_config.php';
	include_once '../includes/inc_folder_path.php';	
	/**************************************/
	//Programm 	  : add_product.php	
	//Company 	  : Adroit
	/**************************************/
	global $gmsg;	
	if(isset($_POST['btnadprodsbmt']) && (trim($_POST['btnadprodsbmt']) != "") && 
	   isset($_POST['lstcat']) && (trim($_POST['lstcat']) != "") &&	
	   //isset($_POST['lstscat']) && (trim($_POST['lstscat']) != "") &&	
	   isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") &&	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&	
	   //isset($_SESSION['sesprc'])    && (trim($_SESSION['sesprc'])!="")	&&    
	  // isset($_POST['txtprc']) && (trim($_POST['txtprc']) != "") &&	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){
		 include_once '../includes/inc_fnct_fleupld.php'; // For uploading files	
		 include_once '../database/iqry_prod_mst.php';
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>...:: <?php echo $pgtl; ?> ::...</title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
		rules[0]='lstcat:Material Type|required|Select Category';
		rules[1]='lstscat:Jewellery Type|required|Select Subcategory';
		rules[2]='txtcode:Code|required|Enter Code';
		rules[3]='txtname:Name|required|Enter Name';
		//rules[4]='txtprc:Price|required|Enter Price';
		//rules[5]='txtprc:Price|double|Enter Numeric Values';
		//rules[6]='txtoprc:Price|double|Enter Numeric Values';		
		rules[7]='txtprty:Rank|required|Enter Rank';
		rules[8]='txtprty:Rank|numeric|Enter Only Numbers';
		rules[9]='hidprc:Name|required|Enter Price Details';
		rules[10]='lstcattyp:Vehicle Type|required|Select Category';
	</script>
	<script language="javascript">	
	function setfocus(){
			document.getElementById('txtcode').focus();		
	}
	// function funcChkDupProdCode(){
	// 	var prodcodeval;
	// 	prodcodeval = document.getElementById('txtcode').value;	
	// 	if(prodcodeval != ""){
	// 		var url = "chkvalidname.php?prodcode="+prodcodeval;
	// 		xmlHttp	= GetXmlHttpObject(scProdCode);
	// 		xmlHttp.open("GET", url , true);
	// 		xmlHttp.send(null);
	// 	}
	// 	else{
	// 		document.getElementById('errorsDiv_txtcode').innerHTML = "";
	// 	}	
	// }
	
	// function scProdCode(){ 
	// 	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
	// 		var temp=xmlHttp.responseText;
	// 		document.getElementById("errorsDiv_txtcode").innerHTML = temp;
	// 		if(temp!=0){
	// 			document.getElementById('txtcode').focus();
	// 		}		
	// 	}
	// }
	function funcChkDupProdCode()
	{ 
		var name = document.getElementById('txtcode').value;
		var prodmncatid = document.getElementById('lstcat').value;
		var prodcatid = document.getElementById('lstcattyp').value;
		if(prodmncatid != "" && prodcatid != "" && name != "")
		{
			var url = "chkvalidname.php?prodcode="+name+"&prodmncatid="+prodmncatid+"&prodcatid="+prodcatid;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstcat').innerHTML="";
			document.getElementById('errorsDiv_lstcattyp').innerHTML="";
			document.getElementById('errorsDiv_txtcode').innerHTML = "";
		}	
	}
	function stateChanged()
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;
			//alert (temp)
			document.getElementById("errorsDiv_txtcode").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtcode').focus();
			}
		}
	}
	
	function funcDspScat(){       
		var catid;
		catid = document.getElementById('lstcat').value;			
		if(catid!=""){
			var url = "../includes/inc_getScat.php?selcatid="+catid;
			xmlHttp	=  GetXmlHttpObject(funscatval);
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
		}
		else{
			funcRmvOptn('lstscat');				
		}
	}	
	function funcDspScattyp(){       
		var catid;
		catid = document.getElementById('lstcattyp').value;			
		if(catid!=""){
			var url = "../includes/inc_getScat.php?selcatid="+catid;
			xmlHttp	=  GetXmlHttpObject(funscatval);
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
		}
		else{
			funcRmvOptn('lstscattyp');				
		}
	}	
	function funscatval(){ 	
		if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 									
			funcRmvOptn('lstscat');							
			var temp = xmlHttp.responseText;
			if(temp != ""){
				funcAddOptn('lstscat',temp);																														
			}			
		}
	}
	function funcRmvOptn(prmtrCntrlnm){			
			if(prmtrCntrlnm!= ''){			
				var lstCntrlNm, optnLngth;
				lstCntrlNm = prmtrCntrlnm;
				optnLngth = document.getElementById(lstCntrlNm).options.length;
				for(incrmnt = optnLngth-1; incrmnt > 0; incrmnt--){
					document.getElementById(lstCntrlNm).options.remove(incrmnt);
				}
			}
		}
	//**************************************************
	//Function for adding options from select control
	//**************************************************			
	function funcAddOptn(prmtrCntrlnm,prmtrOptn){
		tempary 	= Array();
		tempary	 	= prmtrOptn.split(",");						
		cntrlary  	= 0;
		var id 	  	= "";
		var name  	= "";
		var selstr 	= "";
		var optn   	= "";	
		for(var inc = 0; inc < (tempary.length); inc++){
			cntryary 	= tempary[inc].split(":");
			id 		 	= cntryary[0];
			name 	 	= cntryary[1];
			optn 	 	= document.createElement("OPTION");					
			optn.value 	= id;					
			optn.text 	= name;
			var newopt	= new Option(name,id);
			document.getElementById(prmtrCntrlnm).options[inc+1] = newopt;
		}		
	}
	
	

	
		
	
	/********************Multiple Image Upload********************************/
	var nfiles=1;
	 function expand () {
			nfiles ++;
            var htmlTxt = '<?php
					echo "<table border=0 cellpadding=3 cellspacing=1 width=100%>"; 
					echo "<tr >";
					echo "<td colspan=3 height=2 bgcolor=#f0f0f0 valign=middle></td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td colspan=3 height=4 valign=middle></td>";
					echo "</tr>";
									
					echo "</table><br>"; 
					echo "<table border=0 cellpadding=0 cellspacing=1 width=100%>"; 
					echo "<tr>";
					echo "<td align=center width=5%> ' + nfiles + '</td>";
					
					echo "<td align=center width=10%>";
					echo "<input type=text name=txtphtname' + nfiles + ' id=txtphtname' + nfiles + ' class=select size=15>";
					echo "</td>"; 
					
					echo "<td align=center width=10%>";
					echo "<input type=text name=txtphtlnk' + nfiles + ' id=txtphtlnk' + nfiles + ' class=select size=15>";
					echo "</td>"; 
					
					echo "<td align=center width=35%>";
					echo "<input type=file name=flesimg' + nfiles + ' id=flesimg' + nfiles + ' class=select><br>";
					echo "</td>";
					
					echo "<td align=center width=35%>";
					echo "<input type=file name=flebimg' + nfiles + ' id=flebimg' + nfiles + ' class=select><br>";
					echo "</td>";
					
				
					echo "<td align=center width=10%>";
					echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=select size=5 maxlength=3>";
					echo "</td>"; 
					
					echo "<td align=center width=10%>";
					echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=select>";
					echo "<option value=a>Active</option>";
					echo "<option value=i>Inactive</option>";
					echo "</select>";
					echo "</td></tr></table><br>";			
				?>';
			
           	 var Cntnt = document.getElementById ("myDiv");         
		 	 							 
			 if (document.createRange) {//all browsers, except IE before version 9 
					
				 var rangeObj = document.createRange ();
					Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);					
					document.frmaddprod.hdntotcntrl.value = nfiles;	
				   if (rangeObj.createContextualFragment) { // all browsers, except IE	
							//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
							//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla											
					}
					else{//Internet Explorer from version 9
						Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
					}
				}			
				else{//Internet Explorer before version 9
					Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
				}
				document.getElementById('hdntotcntrl').value = nfiles;						
				document.frmaddprod.hdntotcntrl.value = nfiles;
			}	
	</script>
	<style>
	#container{
		width:1000px;
		margin:0 auto;
	}
</style>
</head>
<body onLoad="setfocus()">
<?php 
	include_once ('../includes/inc_adm_header.php');
	include_once ('../includes/inc_adm_leftlinks.php'); 
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1" >
    <tr>
      <td height="400" valign="top"><br>
		<form name="frmaddprod" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post" onSubmit="return performCheck('frmaddprod', rules, 'inline');" enctype="multipart/form-data">		 
				<input type="hidden" name="hdnlstszid" id="hdnlstszid">				
		   <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#fff">
		   <tr class='white'>
		   	<td height="26" colspan="4" bgcolor="#FF543A">
				<span class="heading"><strong>::Add Product </strong></span></td>
	      </tr>
		   <tr bgcolor="#f0f0f0">
		   	<td colspan="4" align="center">&nbsp;
				<strong><font color="#fda33a">
				<?php
					if(isset($gmsg) && $gmsg!=""){
						echo $gmsg;
					}
				  ?>
				  </font></strong></td>
	      </tr>
          <?php /*?><tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Category*</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<select name="lstcat1"  id="lstcat1" style="width:197px" >
              <option value="">Select</option>
              <?php 
				  $sqrycat_mst = "select 
				  					prodcatm_id,prodcatm_name 
							      from 
								  	prodcat_mst
								  where 
								  	prodcatm_sts='a'
									order by prodcatm_name";
				  $srcat_mst   = mysqli_query($conn,$sqrycat_mst) or die(mysql_error());
				  while($srowcat_mst = mysqli_fetch_assoc($srcat_mst)){
					 echo "<option value='$srowcat_mst[prodcatm_id]'>$srowcat_mst[prodcatm_name]</option>";
				  }
				  ?>
            </select>
			<td width="32%"><span id="errorsDiv_lstcat1"></span></td>												
		 </tr>
		   <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Jewellery Type*</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<select name="lstcat2"  id="lstcat2" style="width:197px" >
              <option value="">Select</option>
              <?php 
				  $sqrycat_mst = "select 
				  					cattwom_id,cattwom_name 
							      from 
								  	cattwo_mst
								  where 
								  	cattwom_sts='a'
									order by cattwom_name";
				  $srcat_mst   = mysqli_query($conn,$sqrycat_mst) or die(mysql_error());
				  while($srowcat_mst = mysqli_fetch_assoc($srcat_mst)){
					 echo "<option value='$srowcat_mst[cattwom_id]'>$srowcat_mst[cattwom_name]</option>";
				  }
				  ?>
            </select>
			<td width="32%"><span id="errorsDiv_lstcat2"></span></td>												
		 </tr>
          <?php */?>
							 <tr bgcolor="#FFFFFF">
			<td align="left" bgcolor="#F3F3F3">Vehicle Type *</td>
			<td width="2%" align="center" bgcolor="#F3F3F3"><strong>:</strong></td>
			<td align="left" bgcolor="#F3F3F3">
			  <select name="lstcattyp"  id="lstcattyp" style="width:197px" >
				<option value="">--Select--</option>
				<?php 
			  $sqryvehtyp_mst ="select 
									vehtypm_id,vehtypm_name 
								 from 
									vehtyp_mst
								 where 
									vehtypm_sts='a' 
								 group by 
								   vehtypm_id
								 order by vehtypm_name";
			  $srvehtyp_mst   = mysqli_query($conn,$sqryvehtyp_mst) or die(mysql_error());
			  while($srowvehtyp_mst = mysqli_fetch_assoc($srvehtyp_mst))
			  {
				 echo "<option value='$srowvehtyp_mst[vehtypm_id]'>$srowvehtyp_mst[vehtypm_name]</option>";
			  }
			  ?>
			  </select>				 </td>
			<td align="left" bgcolor="#F3F3F3"><span id="errorsDiv_lstcattyp" ></span></td>
			</tr>
		 <tr bgcolor="#FFFFFF">
			<td align="left" bgcolor="#F3F3F3">Brand *</td>
			<td width="2%" align="center" bgcolor="#F3F3F3"><strong>:</strong></td>
			<td align="left" bgcolor="#F3F3F3">
			  <select name="lstcat"  id="lstcat" style="width:197px" >
				<option value="">--Select--</option>
				<?php 
			  $sqrybrnd_mst ="select 
									brndm_id,brndm_name 
								 from 
									brnd_mst
								 where 
									brndm_sts='a' 
								 group by 
								   brndm_id
								 order by brndm_name";
			  $srbrnd_mst   = mysqli_query($conn,$sqrybrnd_mst) or die(mysql_error());
			  while($srowbrnd_mst = mysqli_fetch_assoc($srbrnd_mst))
			  {
				 echo "<option value='$srowbrnd_mst[brndm_id]'>$srowbrnd_mst[brndm_name]</option>";
			  }
			  ?>
			  </select>				 </td>
			<td align="left" bgcolor="#F3F3F3"><span id="errorsDiv_lstcat" ></span></td>
			</tr>
		 <?php /*?> <tr bgcolor="#FFFFFF">
			<td align="left" bgcolor="#F3F3F3">SubCategory *</td>
			<td align="center" bgcolor="#F3F3F3"><strong>:</strong></td>
			<td align="left" bgcolor="#F3F3F3">
			  <select name="lstscat"  id="lstscat" style="width:197px" onChange="funcPopSize()">
				<option value="">--Select--</option>
			  </select></td>
			<td align="left" bgcolor="#F3F3F3"><span id="errorsDiv_lstscat"></span></td>
			</tr><?php */?>	
		<tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Code*</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtcode" type="text" class="select" id="txtcode" size="30" maxlength="50" onBlur="funcChkDupProdCode()">			</td>
			<td width="32%"><span id="errorsDiv_txtcode"></span></td>												
		 </tr>
		   <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Name*</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50" >			</td>
			<td width="32%"><span id="errorsDiv_txtname"></span></td>												
		 </tr>	
         <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="4">Admin Description :</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="4" align="left" valign="middle">
			<textarea name="txtadmndescone" id="txtadmndescone" cols="45" rows="7" class="select"></textarea>			
			</td>
		 </tr>
         <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="4">Product Description :</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="4" align="left" valign="middle">
			<textarea name="txtadmndesctwo" id="txtadmndesctwo" cols="45" rows="7" class="select"></textarea>			
			</td>
		 </tr>		 	  
		 <?php /*?><tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Price</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtprc" type="text" class="select" id="txtprc" size="30" maxlength="50" >			</td>
			<td width="32%"><span id="errorsDiv_txtprc"></span></td>												
		 </tr>	
		 <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Offer Price</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtoprc" type="text" class="select" id="txtoprc" size="30" maxlength="50" >			</td>
			<td width="32%"><span id="errorsDiv_txtoprc"></span></td>												
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="middle">Weight (Gms)</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtwght" type="text" class="select" id="txtwght" size="30" maxlength="50" ></td>
			<td width="32%"></td>												
		 </tr>		<?php */?>
	  	 <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top">Type</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<select name="lsttyp" id="lsttyp">
			  <option value="1" selected>General</option>
			  <option value="2">New Arrival </option>
			  <option value="3">Best Sellers</option>
			 <!-- <option value="4">New Arrival & Best Sellers</option>
			  <option value="5">All</option>-->
			  <option value="6">Monthly Special</option>	
			</select></td>
			<td width="32%"></td>												
		 </tr>	
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Title</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2">
			 <input name="txtseotitle" type="text" class="select" id="txtseotitle" size="30" maxlength="50" >
			</td>														
		 </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Description</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2">
				<textarea name="txtseodesc" type="text" class="select" id="txtseodesc" rows="5" cols="40"></textarea>
			</td>														
		 </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Keyword</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2">
			 <textarea name="txtseokywrd" type="text" class="select" id="txtseokywrd" rows="5" cols="40"></textarea>
			</td>														
		 </tr>
		<tr bgcolor="#f0f0f0"> 
            <td width="19%" align="left" valign="top">SEO H1-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<input name="txtseoh1ttl" type="text" class="select" id="txtseoh1ttl" size="30" maxlength="50"></td>
		</tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="19%" align="left" valign="top">SEO H1-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<textarea name="txtseoh1desc" id="txtseoh1desc" rows="5" cols="40" class="select"></textarea>			
			</td>
		  </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="19%" align="left" valign="top">SEO H2-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<input name="txtseoh2ttl" type="text" class="select" id="txtseoh2ttl" size="30" maxlength="50"></td>
		</tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="19%" align="left" valign="top">SEO H2-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<textarea name="txtseoh2desc" id="txtseoh2desc" rows="5" cols="40" class="select"></textarea>			
			</td>
		  </tr>	
		  <!--<tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top">New Arrival</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<select name="lstnwarvl" id="lstnwarvl">
			  <option value="n" selected>No</option>
			  <option value="y">Yes</option>
			</select></td>
			<td width="32%"></td>												
		 </tr>	
		  <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top">Best Seller</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<select name="lstbstslr" id="lstbstslr">
			  <option value="n" selected>No</option>
			  <option value="y">Yes</option>
			</select></td>
			<td width="32%"></td>												
		 </tr>		
          <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top"><p>Small Image</p>
            <p>(200 px X 200 px)</p></td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="flesmlimg" type="file" class="select" id="flesmlimg"></td>
			<td width="32%"></td>												
		 </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top">Big Image<br>
            (400 px X 400 px)</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="flebigimg" type="file" class="select" id="flebigimg"></td>
			<td width="32%"></td>												
		 </tr>
		   <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top"><p>Zoom Image (MAX W X H) <br>
              (1000 px X 1000 px)  </p>
             </td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="flezmimg" type="file" class="select" id="flezmimg"></td>
			<td width="32%"></td>												
		 </tr> -->
		  <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top">Rank *</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="42%" align="left" valign="middle">
			<input name="txtprty" type="text" class="select" id="txtprty" size="3" maxlength="4"></td>
			<td width="32%"><span id="errorsDiv_txtprty"></span></td>												
		 </tr>      
		 <tr bgcolor="#f0f0f0">
		  	<td width="24%" align="left" valign="middle">Status</td>
			<td width="2%" align="center">:</td>
            <td width="42%" align="left" valign="middle">
				<select name="lststs" id="lststs">
					<option value="a" selected>Active</option>
					<option value="i">Inactive</option>	
				</select>
			</td>
			<td width="32%"></td>	
		  </tr>
		 
		 <!--Size Session    -->
		 	<?php /*?><tr bgcolor="#FFFFFF">
                <td align="left" colspan='4' bgcolor="#F3F3F3">
				<div  id="divaddsrvc">
			 <table width="100%" border='0' cellspacing='2' cellpadding='3' bgcolor='#F8FBFC'>
			   <tr>
				 <td bgcolor="#F3F3F3" width="10%" align="center"></td>
				 
				<td bgcolor="#F3F3F3" width="20%" align="center">
				    <select name="lstsize"  id="lstsize" style="width:120px" >
                    <option value="">--Select--</option>
            <?php 
				$sqrysize_mst ="select 
													sizem_id,sizem_name 
												from 
													size_mst
												where 
													sizem_sts='a' 
												group by 
													sizem_id
												order by sizem_name asc";
				  $srsize_mst   = mysqli_query($conn,$sqrysize_mst) or die(mysql_error());
				  while($srowsize_mst = mysqli_fetch_assoc($srsize_mst))
				  {
					 echo "<option value='$srowsize_mst[sizem_id]'>$srowsize_mst[sizem_name]</option>";
				  }
				  ?>
                  </select>   				 </td>
				  	
				 <td bgcolor="#F3F3F3" width="20%" align="center">
				    <input name="txtprc" type="text" class="select" id="txtprc" size="10" >				 </td>
				 <td bgcolor="#F3F3F3" width="20%" align="center">
					 <input name="txtofrprc" type="text" class="select" id="txtofrprc" size="10">				 </td>
					 
				 <td bgcolor="#F3F3F3"  width="30%" align="center"><input name="btnadsrvc"  id="btnadsrvc" type="button"  value="ADD" onClick="funcAddprcMenu('add')"></td>	
			
			   </tr>														
			</table>
			</div>
			<div  id="divedtsrvc"  style="display:none">
			     <input type="hidden" name="hdnprcid" id="hdnprcid">	   			
               	   <table width="100%"  border="0" cellspacing="0" cellpadding="0">
					 <tr>
					     <td bgcolor="#F3F3F3" width="10%" align="center"></td>
					     					
						<td bgcolor="#F3F3F3" width="20%"  align="center">
						       <!--<input name="lstedtsize" type="text" class="select" id="lstedtsize" size="20" maxlength="250"> -->  	
						 	    <select name="lstedtsize"  id="lstedtsize" style="width:120px" >
                    <option value="">--Select--</option>
            <?php 
				$sqrysize_mst ="select 
													sizem_id,sizem_name 
												from 
													size_mst
												where 
													sizem_sts='a' 
												group by 
													sizem_id
												order by sizem_name asc";
				  $srsize_mst   = mysqli_query($conn,$sqrysize_mst) or die(mysql_error());
				  while($srowsize_mst = mysqli_fetch_assoc($srsize_mst))
				  {
					 echo "<option value='$srowsize_mst[sizem_id]'>$srowsize_mst[sizem_name]</option>";
				  }
				  ?>
                  </select> 
						 </td>
						 
				         <td bgcolor="#F3F3F3"  width="20%" align="center"><input name="txtedtprc" type="text"  size="10" class="select" id="txtedtprc"  >
				         </td>
				         <td bgcolor="#F3F3F3" width="20%" align="center">
						         <input name="txtedtofrprc" type="text" class="select" id="txtedtofrprc"  size="10" >		             
				         </td>						
						 <td bgcolor="#F3F3F3" width="30%" align="center">				  				
							 <input type="button" class="" name="btnedtcancel" 
								 value="CANCEL" onClick="funcditalscancel()">			
							 <input type="button" class="" name="btnedtupdate" 
								 value="UPDATE" onClick="updatesrvc('edit')">
						 </td>								
				   </tr>														
			    </table>					
			</div>			
			<table width="100%"  border="0" cellspacing="2" cellpadding="2" >
			  <tr>
				<td bgcolor="#F3F3F3"  width="10%" align="center"><strong>SL.No</strong></td>
				<td bgcolor="#F3F3F3"  width="20%" align="center"><strong>Size</strong></td>				
				<td bgcolor="#F3F3F3"  width="20%" align="center"><strong>Price</strong></td>
				<td bgcolor="#F3F3F3"  width="20%" align="center"><strong>Offer Prcice</strong></td>
				<td bgcolor="#F3F3F3"  width="30%" align="center"><strong>Manage</strong></td>
            </tr>
			<tr align="center">  
					<td  colspan="8">		 
					   <div id="divprc">
                           <?php
						      	funcprc();
								if($gprc!="")					
								{							
								  echo $gprc;
								}
						   ?>
                       </div>
					   <span id="errorsDiv_hidprc" style="color:#FF0000"></span>
				     </td>
				</tr>	
				</table>
			</td>
			</tr>
			<?php */?>	
				
		 <!---------------- Close size session ------------------>
		 
		  <tr bgcolor="#f0f0f0">
				<td colspan="4" align="center" >
					<table width="100%" border="0" cellspacing="1" cellpadding="1">								
						<tr bgcolor="#f0f0f0">
							<td width="10%"  align="left"><strong>SL.No.</strong></td>
							<td width="10%" align="left" ><strong>Name</strong></td>
							<td width="10%" align="left" ><strong>Link</strong></td>
							<td width="30%"  align="center"><strong>Small Image</strong></td>
							<td width="30%" align="center"><strong>Big Image</strong></td>
							<td width="10%" align="right" ><strong>Rank</strong></td>
							<td width="10%" align="center" ><strong>Status</strong></td>
						</tr>
					</table>
				</td>
			</tr>	
						
			
			<tr bgcolor="#f0f0f0">
				<td colspan="4" align="center" >
					<table width="100%" border="0" cellspacing="3" cellpadding="3">
					<tr bgcolor="#f0f0f0">
						<td width="10%" align="center">1</td>
						<td width="10%"  align="center">
						   <input type="text" name="txtphtname1" id="txtphtname1" class="select" size="15"><br>
						   <span id="errorsDiv_txtphtname1" style="color:#FF0000"></span>
						</td>
						<td width="10%"  align="center">
						   <input type="text" name="txtphtlnk1" id="txtphtlnk1" class="select" size="15"><br>
						   <span id="errorsDiv_txtphtlnk1" style="color:#FF0000"></span>
						</td>
						<td width="30%"  align="center">
							<input type="file" name="flesimg1" class="select" id="flesimg1" ><br/>
							<span id="errorsDiv_flesimg1" style="color:#FF0000" ></span>
						</td>
						<td width="30%"  align="center">
							<input type="file" name="flebimg1" class="select" id="flebimg1" ><br/>
							<span id="errorsDiv_flebimg1" style="color:#FF0000"></span>
						</td>
						<td width="10%"  align="center">
						   <input type="text" name="txtphtprior1" id="txtphtprior1" class="select" size="5" maxlength="3"><br>
						   <span id="errorsDiv_txtphtprior1" style="color:#FF0000"></span>
						</td>
						<td width="10%" align="center" >					
							<select name="lstphtsts1" id="lstphtsts1">
								<option value="a" selected>Active</option>
								<option value="i">Inactive</option>
							</select>
						</td>										
					</tr>
					</table>
				</td>			
			</tr>
			<input type="hidden" name="hdntotcntrl" value="1">
            
			
			
			<tr bgcolor="#f0f0f0">
				<td colspan="4" align="center" >
					<div id="myDiv">
						<table width="100%" cellspacing='2' cellpadding='3'>
							<tr>
								<td align="center">
								<input name="btnadd" type="button" onClick="expand()" value="Add Another Image" class="subtitles">
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			
			
			
			
          <tr bgcolor="#f0f0f0"> 
            <td colspan="4"  align="right" valign="middle">&nbsp;</td>
          </tr>
          <tr valign="middle" bgcolor="#f0f0f0"> 
            <td colspan="4" align="center">
				<input type="Submit" class=""  name="btnadprodsbmt" value="Submit">&nbsp;&nbsp;&nbsp;
				<input type="Reset" class=""  name="btnReset" value="Reset">&nbsp;&nbsp;&nbsp;
           		<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_products.php'"></td>            
          </tr>	
		  </table>   	        
		  </form>
		</td>
	</tr>  
</table>
<?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtadmndescone');
	CKEDITOR.replace('txtadmndesctwo');
</script>