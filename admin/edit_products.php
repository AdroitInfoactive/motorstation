<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_folder_path.php'; 		
	include_once '../includes/inc_config.php';
	/**************************************/
	//Programm 	  : edit_products.php	
	//Company 	  : Adroit
	/**************************************/
	global $id,$pg,$countstart;
	
	/*$smlimgfldnm = "../".$gsml_fldnm;
	$bgimgfldnm  = "../".$gbg_fldnm;
	$zmimgfldnm  = "../".$gzm_fldnm;*/
	
	if(isset($_POST['btnedtprodsbmt']) && (trim($_POST['btnedtprodsbmt']) != "") && 
	   isset($_POST['lstcat']) && (trim($_POST['lstcat']) != "") &&	
	   //isset($_POST['lstscat']) && (trim($_POST['lstscat']) != "") &&	
	   isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") &&	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	  //isset($_SESSION['sesedtprc'])   && (trim($_SESSION['sesedtprc'])!="") &&	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")   &&
		isset($_POST['hdnprodid']) && (trim($_POST['hdnprodid'])!= "")){   
		 include_once '../includes/inc_fnct_fleupld.php'; // For uploading files	
		 include_once '../database/uqry_prod_mst.php';
	}
	if(isset($_REQUEST['vw'])      && (trim($_REQUEST['vw'])!="") && 
	   isset($_REQUEST['pg'])      && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id         = glb_func_chkvl($_REQUEST['vw']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
	}
	elseif(isset($_REQUEST['hdnprodid']) && (trim($_REQUEST['hdnprodid'])!="") &&
	 	   isset($_REQUEST['hdnpage'])   && (trim($_REQUEST['hdnpage'])!="") &&
	 	   isset($_REQUEST['hdncnt'])    && (trim($_REQUEST['hdncnt'])!="")){
		   $id         = glb_func_chkvl($_REQUEST['hdnprodid']);
		   $pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		   $cntstart = glb_func_chkvl($_REQUEST['hdncnt']);
	}
	
	/*if(isset($_POST['hdnoptn']) && (trim($_POST['hdnoptn'])!="") && 
	   isset($_POST['hdnval']) &&  (trim($_POST['hdnval'])!="")){
		$optn = glb_func_chkvl($_POST['hdnoptn']);
		$val  = glb_func_chkvl($_POST['hdnval']);
	}
	elseif(isset($_POST['optn']) && (trim($_POST['optn'])!="") && 
		   isset($_POST['val']) && (trim($_POST['val'])!="")){
	    $countstart = glb_func_chkvl($_REQUEST['countstart']);
		$optn = glb_func_chkvl($_POST['optn']);
		$val  = glb_func_chkvl($_POST['val']);
	}	*/
	  $sqryprod_mst =   "select 
							prodm_id,prodm_code,prodm_name,prodm_descone,
							prodm_desctwo,prodm_mrp,prodm_op,prodm_typ,
							prodm_prty,prodm_sts,brndm_id,prodm_seotitle,
							prodm_seodesc,prodm_seokywrd,prodm_wt,vehtypm_name,prodm_vehtypm_id,
							prodm_seohonetitle,prodm_seohonedesc,prodm_seohtwotitle,prodm_seohtwodesc
						from  
							vw_prod_mst
						where 
							prodm_id='$id'";
	$srsprod_mst    = mysqli_query($conn,$sqryprod_mst);
	$cntrec 		= mysqli_num_rows($srsprod_mst);
	if($cntrec > 0){
		$srowsprod_mst = mysqli_fetch_assoc($srsprod_mst);		
	}
	else{
	 	header("Location:vw_all_products.php");
		exit();
	}
	
	if(isset($_REQUEST['imgid']) && (trim($_REQUEST['imgid']) != "") && 	
	   isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "")){	   
		$imgid      = glb_func_chkvl($_REQUEST['imgid']);
		$prodid     = glb_func_chkvl($_REQUEST['edit']);	   
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$countstart = glb_func_chkvl($_REQUEST['countstart']);		
	    $sqryprodimgd_dtl="select 
							   prodimgd_simg,prodimgd_bimg
						   from 
							   prodimg_dtl
						   where
								prodimgd_id = '$imgid'";				 				 				 				 			
		 $srsprodimgd_dtl     	= mysqli_query($conn,$sqryprodimgd_dtl);
		 $srowprodimgd_dtl    	= mysqli_fetch_assoc($srsprodimgd_dtl);		     			   				
		 $smlimg      			= glb_func_chkvl($srowprodimgd_dtl['prodimgd_simg']);
		 $smlimgpth   			= $gsml_fldnm.$smlimg;
		 $bimg      			= glb_func_chkvl($srowprodimgd_dtl['prodimgd_bimg']);
		 $bimgpth   			= $gbg_fldnm.bimg;
		 $delimgsts 				= funcDelAllRec('prodimg_dtl','prodimgd_id',$imgid);
		 if($delimgsts == 'y'  ){
			 if(($smlimg != "") && file_exists($smlimgpth)) {
					unlink($smlimgpth);
			 }
			 if(($bimg != "") && file_exists($bimgpth)) {
					unlink($bimgpth);
			 }				
	     }
  	}
	$loc 				= "";
	$txtsrchcd  		=  glb_func_chkvl($_REQUEST['txtsrchcd']); 
	$txtsrchnm  		=  glb_func_chkvl($_REQUEST['txtsrchnm']); 
	$lsttyp  			=  glb_func_chkvl($_REQUEST['lsttyp']); 
	$lstcat     		=  glb_func_chkvl($_REQUEST['lstcat']); 
	$lstscat  			=  glb_func_chkvl($_REQUEST['lstscat']); 
	$lstprdsts 			=  glb_func_chkvl($_REQUEST['lstprdsts']); 
	if($txtsrchcd !=''){
		$loc .= "&txtsrchcd=$txtsrchcd";
	}
	if($txtsrchnm !=''){
		$loc .= "&txtsrchnm=$txtsrchnm";
	}
	if($lsttyp !=''){
		$loc .= "&lsttyp=$lsttyp";
	}	
	if($lstcat !=''){
		$loc .= "&lstcat=$lstcat";
	}
	if($lstscat !=''){
		$loc .= "&lstscat=$lstscat";
	}
	if($lstprdsts !=''){
		$loc .= "&lstprdsts=$lstprdsts";
	}	
	$chk  	=  glb_func_chkvl($_REQUEST['chk']); 
	if(chk!= ""){
		$loc .= "&chk=$chk";
	}
	
	/*$sqryprc_dtl="select 
							prodprcd_id,prodprcd_prodm_id,prodprcd_prc,prodprcd_ofrprc,
							sizem_name,sizem_id
						from 
							 vw_prod_size_dtl
						where 
							 prodprcd_sts='a'  and
							 prodprcd_prodm_id ='$id'  											 
						 order by 
							 sizem_name";
	   $srsprc_dtl	= mysqli_query($conn,$sqryprc_dtl);		
	   $cntprc_dtl  = mysqli_num_rows($srsprc_dtl);
	$cnt = $offset;
	while($rowprodprc_dtl=mysqli_fetch_assoc($srsprc_dtl))
	{
		$prcid	= $rowprodprc_dtl['prodprcd_id']; 
		$size	=$rowprodprc_dtl['sizem_id'];
		$prc	=$rowprodprc_dtl['prodprcd_prc'];
		$ofrprc	=$rowprodprc_dtl['prodprcd_ofrprc']; 
	  $val 	   .="<->".$size."--".$prc."--".$ofrprc;	
	}
	$val 	=  substr($val,3);
 	$_SESSION['sesedtprc'] = $val;	*/
	
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
		rules[10]='lstcattyp:Material Type|required|Select Category';
	</script>
   <script language="javascript" type="text/javascript">
	// function funcChkDupProdCode(){
	// 	var id 	 = <?php echo $id;?>;		
	// 	var prodcodeval;
	// 	prodcodeval = document.getElementById('txtcode').value;					
	// 	if((prodcodeval != "") && (id != "")){
	// 		var url = "chkvalidname.php?prodcode="+prodcodeval+"&prodid="+id;		
	// 		xmlHttp	= GetXmlHttpObject(scProdCode);
	// 		xmlHttp.open("GET", url , true);
	// 		xmlHttp.send(null);
	// 	}
	// 	else{
	// 		document.getElementById('errorsDiv_txtcode').innerHTML = "";
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

	function scProdCode(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtcode").innerHTML = temp;
			if(temp!=0){
				document.getElementById('lstclr').focus();
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
			//optn 	 	= document.createElement("OPTION");					
			//optn.value 	= id;					
			//optn.text 	= name;
			//var newopt	= new Option(name,id);
			hdnprodscatid  = document.getElementById('hdnprodscatid').value;
			var newopt=new Option(name,id);
			if(id==hdnprodscatid)
		    {
			  newopt.selected="selected";
			}
			document.getElementById(prmtrCntrlnm).options[inc+1] = newopt;
		}		
	}	
	
	function funcShowDiv(val){
		var cntrlnm,cntrlnm_nr;
		cntrlnm    = document.getElementById('divavlsz');
		cntrlnm_nr = document.getElementById('divavlsz_nr'); 
		if(val == 'y'){
			cntrlnm.style.display = 'block';
			divavlsz_nr.style.display = 'none';			
		}
		else{
			cntrlnm.style.display = 'none';
			divavlsz_nr.style.display = 'block';
		}	
	}
	function rmvimg(imgid){
			var img_id;
			img_id = imgid;
			if(img_id !=''){
				var r=window.confirm("Do You Want to Remove Image");
				if (r==true){						
					 x="You pressed OK!";
				  }
				else{
					  return false;
				}	
        	}
			document.frmedtclr.action="edit_products.php?edit=<?php echo $id;?>&imgid="+img_id+"&pg=<?php echo $pg;?>&countstart=				<?php echo $countstart.$loc;?>" 
			document.frmedtclr.submit();	
	}	
	
	
	
	/*-----------------    Size Open Hear   -------------------------------------*/
	function funcAddprcMenu(mod){       			
			var opr;
			opr=mod;						
			var flg;
			flg = 1;		
			if(opr=='add'){			
			if(document.getElementById('lstsize').value == "")
			{
				flg = 0;
				alert("Please Select Size");
				document.getElementById('lstsize').focus();
				return false;
			}		
			if(document.getElementById('txtprc').value == ""){
				flg = 0;
				alert("Please Enter Price");
				document.getElementById('txtprc').focus();
				return false;
			}
			
			if (! (/^\d*(?:\.\d{0,2})?$/.test(document.getElementById('txtprc').value))) {
					alert("Please enter a valid price");
					document.getElementById('txtprc').focus();
					return false;
				}
			if(document.getElementById('txtofrprc').value != ""){
				if (! (/^\d*(?:\.\d{0,2})?$/.test(document.getElementById('txtofrprc').value))) {
					alert("Please enter a valid Offer price");
					document.getElementById('txtofrprc').focus();
					return false;
				}
			}			
			if(flg == 1)
			{ 
			
			   var name,prty,sts;
				var typ='a';	
				size        = document.getElementById('lstsize').value;
				prc  	    = document.getElementById('txtprc').value;
				ofrprc         = document.getElementById('txtofrprc').value;
				var prcparams ="size="+size+"&prc="+prc+"&actntyp="+typ+"&ofrprc="+ofrprc;
				var prcurl ="getedt_details.php";
				xmlHttp=GetXmlHttpObject(stchngprc_additem);
				xmlHttp.open("POST",prcurl,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.setRequestHeader("Content-length",prcparams.length);
				xmlHttp.setRequestHeader("Connection", "close");		
				xmlHttp.send(prcparams);	
			}
		}
	}
	function stchngprc_additem()
	{ 
		if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 
			var temp	= xmlHttp.responseText;
			document.getElementById("divprc").innerHTML = temp;				
		}
	}
	function funcrmvprc(prcid)		
	{	   
		if(confirm("Do you want to remove this Code from the list?")== true)
		{
			var prcidval;
			prcidval = prcid;
			if((prcidval != "") || (prcid == "0"))
			{
				var url="sesrmvdetailsedt.php?prcid="+prcidval;
				xmlHttp=GetXmlHttpObject(stchngprc_rmv);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);
			}		
		}
	}
	function stchngprc_rmv()
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 
			var temp	= xmlHttp.responseText;		
			document.getElementById("divprc").innerHTML = temp;
		   				
		}
	}
function funcedtprc(itmid,sesval)
{
	var itmidval = itmid;		
	var divaddsrvc = document.getElementById('divaddsrvc');
	var divedtsrvc = document.getElementById('divedtsrvc');		
	divaddsrvc.style.display ="none";
	divedtsrvc.style.display="block";		
	document.getElementById('hdnprcid').value = itmidval;
	var sessrvc= sesval;
	var newvalarr=sessrvc.split("--");
	document.getElementById('lstedtsize').value = newvalarr[0];
	document.getElementById('txtedtprc').value = newvalarr[1];
	document.getElementById('txtedtofrprc').value  = newvalarr[2];
}	
function funcditalscancel()
{			
	var divaddsrvc  = document.getElementById('divaddsrvc');
	var divedtsrvc = document.getElementById('divedtsrvc');		
	divaddsrvc.style.display  ="block";
	divedtsrvc.style.display ="none";	
}
function updatesrvc(modval){
	        var hdnprcid	= parseInt(document.getElementById('hdnprcid').value) + 1;		
			typ='e';
			if(hdnprcid != "")
			{ 
			size        = document.getElementById('lstedtsize').value;
			prc  	  = document.getElementById('txtedtprc').value;
			ofrprc         = document.getElementById('txtedtofrprc').value;
			prcid      = hdnprcid -1;			
			  var prcparams ="size="+size+"&prc="+prc+"&actntyp="+typ+"&prcid="+prcid+"&ofrprc="+ofrprc;
			  var expurl 	 = "getedt_details.php";
			  xmlHttp=GetXmlHttpObject(stchngexp_edititem);
			  xmlHttp.open("POST", expurl , true);
			  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xmlHttp.setRequestHeader("Content-length",prcparams.length);
			  xmlHttp.setRequestHeader("Connection", "close");		
			  xmlHttp.send(prcparams);	
			}
			else
			{
			   alert("Enter Values");
			}
			
}
function stchngexp_edititem(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
			var temp		= xmlHttp.responseText;
			document.getElementById("divprc").innerHTML = temp;
		}
		funcprccancel()
}
			
	</script>
<style>
	#container{
		width:1000px;
		margin:0 auto;
	}
</style>
</head>
<body onLoad="funcDspScat()">
<!--<div id="container">-->
<?php 
 include_once ('../includes/inc_adm_header.php');
 include_once ('../includes/inc_adm_leftlinks.php');
 include_once ('../includes/inc_fnct_ajax_validation.php');	
 ?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
		<td height="400" valign="top"><br>
	  <form name="frmedtclr" id="frmedtclr" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" method="post"  onSubmit="return performCheck('frmedtclr', rules, 'inline');" enctype="multipart/form-data">
	  <table width="95%"  border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#fff">
		  <input type="hidden" name="hdnprodid" id="hdnprodid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage"  id="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" id="hdncnt" value="<?php echo $cntstart;?>">
		  <input type="hidden" name="hdnloc" id="hdnloc" value="<?php echo $loc;?>">
		   <input type="hidden" name="hdnprodscatid" id="hdnprodscatid" value="<?php echo $srowsprod_mst['prodm_prodscatm_id']; ?>">
		   <?php /*?><input type="hidden" name="hdnoptn" value="<?php echo $optn;?>">
		   <input type="hidden" name="hdnval" value="<?php echo $val;?>">
		   <input type="hidden" name="hdnchk" value="<?php echo $chk;?>"><?php */?>

		  <tr class='white'>
			<td height="26" colspan="4" bgcolor="#FF543A"><strong >::Edit Product </strong>	</td>
		  </tr>		  		  
		  <tr bgcolor="#f0f0f0">
			<td colspan="4" align="left"  class="heading">&nbsp;</td>
		  </tr>
			<tr bgcolor="#FFFFFF">
				  <td align="left" bgcolor="#F3F3F3">Vehicle Type * </td>
				  <td align="center" bgcolor="#F3F3F3"><strong>:</strong></td>
				  <td align="left" bgcolor="#F3F3F3">
				  <select name="lstcattyp" id="lstcattyp" style="width:200px" onChange="funcDspScat()">
                  <option value="">-- Category --</option>
                   <?php
					  $sqryvehtyp_mst ="select
					                        vehtypm_id,vehtypm_name
										 from 
										    vehtyp_mst
										 where
										    vehtypm_sts='a'
										 group by vehtypm_id
										 order by vehtypm_name";								
					 $srsvehtyp_mst   = mysqli_query($conn,$sqryvehtyp_mst);
					 
					 while($srowvehtyp_mst = mysqli_fetch_assoc($srsvehtyp_mst))
					 { 
					    $slctd="";
					    if($srowvehtyp_mst['vehtypm_id']==$srowsvehtyp_mst['vehtypm_id'])
						{
						   $slctd="selected";
						}
					    
					?>
         <option value="<?php echo $srowvehtyp_mst['vehtypm_id']; ?>" <?php echo $slctd;  ?>><?php echo $srowvehtyp_mst['vehtypm_name']; ?></option>
                    <?php
					 }
					 ?>
                  </select>
				  </td>
				  <td align="left" bgcolor="#F3F3F3"><span id="errorsDiv_lstcattyp"></span></td>
			  </tr>	
		  <tr bgcolor="#FFFFFF">
				  <td align="left" bgcolor="#F3F3F3">Brand * </td>
				  <td align="center" bgcolor="#F3F3F3"><strong>:</strong></td>
				  <td align="left" bgcolor="#F3F3F3">
				  <select name="lstcat" id="lstcat" style="width:200px" onChange="funcDspScat()">
                  <option value="">-- Category --</option>
                   <?php
					  $sqrybrnd_mst ="select
					                        brndm_id,brndm_name
										 from 
										    brnd_mst
										 where
										    brndm_sts='a'
										 group by brndm_id
										 order by brndm_name";								
					 $srsbrnd_mst   = mysqli_query($conn,$sqrybrnd_mst);
					 
					 while($srowbrnd_mst = mysqli_fetch_assoc($srsbrnd_mst))
					 { 
					    $slctd="";
					    if($srowbrnd_mst['brndm_id']==$srowsprod_mst['brndm_id'])
						{
						   $slctd="selected";
						}
					    
					?>
         <option value="<?php echo $srowbrnd_mst['brndm_id']; ?>" <?php echo $slctd;  ?>><?php echo $srowbrnd_mst['brndm_name']; ?></option>
                    <?php
					 }
					 ?>
                  </select>
				  </td>
				  <td align="left" bgcolor="#F3F3F3"><span id="errorsDiv_lstcat"></span></td>
			  </tr>	
			  	
		  <?php /*?><tr bgcolor="#f0f0f0">
<td width="20%" align="left" valign="middle">Material Type*</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<select name="lstcat1"  id="lstcat1" style="width:197px" onChange="funcScat()">
              <option value="">Select</option>
              
				  <?php 
				  $sqrycat_mst = "select 
				  					brndm_id,brndm_name 
							      from 
								  	brnd_mst
								  where 
								  	brndm_sts='a'
									order by brndm_name";
				  $srcat_mst   = mysqli_query($conn,$sqrycat_mst) or die(mysql_error());
				  while($srowcat_mst = mysqli_fetch_assoc($srcat_mst)){
					  $catnm = '';
					  if($srowcat_mst['brndm_id']==$srowsprod_mst['prodm_brndm_id']){
							$catnm ='selected';
					  }
					 echo "<option value='$srowcat_mst[brndm_id]' $catnm>$srowcat_mst[brndm_name]</option>";
				  }
				  ?>
            </select>
			<td width="41%"><span id="errorsDiv_lstcat1"></span></td>												
		 </tr>
		  <tr bgcolor="#f0f0f0">
<td width="20%" align="left" valign="middle">Jewellery Type*</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<select name="lstcat2"  id="lstcat2" style="width:197px" onChange="funcScat()">
              <option value="">Select</option>
			  <?php 
				  $sqrycat_mst = "select 
				  					prodscatm_id,prodscatm_name 
							      from 
								  	prodscat_mst
								  where 
								  	prodscatm_sts='a'
									order by prodscatm_name";
				  $srcat_mst   = mysqli_query($conn,$sqrycat_mst) or die(mysql_error());
				  while($srowcat_mst = mysqli_fetch_assoc($srcat_mst)){
				   $catnm2 ='';
				   if($srowcat_mst['prodscatm_id']==$srowsprod_mst['prodm_prodscatm_id']){
					 	$catnm2 ='selected';
					 }
					 echo "<option value='$srowcat_mst[prodscatm_id]' $catnm2>$srowcat_mst[prodscatm_name]</option>";
				  }
				  ?>
            </select>
			<td width="41%"><span id="errorsDiv_lstcat2"></span></td>												
		 </tr><?php */?>
          <tr bgcolor="#f0f0f0"> 
            <td width="20%" align="left" valign="middle">Code*</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<input name="txtcode" type="text" class="select" id="txtcode" size="30" maxlength="50" onBlur="funcChkDupProdCode()" value="<?php echo $srowsprod_mst['prodm_code']; ?>">	</td>
			<td width="41%"><span id="errorsDiv_txtcode"></span></td>												
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="20%" align="left" valign="middle">Name*</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<input name="txtname" type="text" class="select" id="txtname" size="30" maxlength="50"  value="<?php echo $srowsprod_mst['prodm_name']; ?>">	</td>
			<td width="41%"><span id="errorsDiv_txtname"></span></td>												
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="4">Admin Description:</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="4" align="left" valign="middle">
			<textarea name="txtadmndescone" id="txtadmndescone" cols="45" rows="7" class="select"><?php echo $srowsprod_mst['prodm_descone'];?></textarea>			
			</td>
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="4">User Description:</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="4" align="left" valign="middle">
			<textarea name="txtadmndesctwo" id="txtadmndesctwo" cols="45" rows="7" class="select"><?php echo $srowsprod_mst['prodm_desctwo'];?></textarea>			
			</td>
		 </tr>		
       <?php /*?> <tr bgcolor="#f0f0f0"> 
            <td width="20%" align="left" valign="middle">Price</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<input name="txtprc" type="text" class="select" id="txtprc" size="30" maxlength="50"  value="<?php echo $srowsprod_mst['prodm_mrp']; ?>">	</td>
			<td width="41%"><span id="errorsDiv_txtprc"></span></td>												
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="20%" align="left" valign="middle">Offer Price</td>
			<td width="2%" align="center">:</td>
            <td width="37%" align="left" valign="middle">
			<input name="txtoprc" type="text" class="select" id="txtoprc" size="30" maxlength="50"  value="<?php echo $srowsprod_mst['prodm_op']; ?>">	</td>
			<td width="41%"><span id="errorsDiv_txtoprc"></span></td>												
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle"> Weight (Gms)</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle">
				<input name="txtwght" type="text" class="select" id="txtwght" size="30" maxlength="50"  value="<?php echo $srowsprod_mst['prodm_wt']; ?>">
			</td><td width="41%"><span id="errorsDiv_txtoprc"></span></td>	
		 </tr><?php */?>
         <tr bgcolor="#f0f0f0"> 
            <td width="20%" align="left" valign="top">Type</td>
			<td width="2%" align="center" valign="top">:</td>
            <td width="37%" align="left" valign="middle">
				<select name="lsttyp" id="lsttyp">
					<option value="1"<?php if($srowsprod_mst['prodm_typ']=='1') echo 'selected';?>>General</option>
					<option value="2"<?php if($srowsprod_mst['prodm_typ']=='2') echo 'selected';?>>New Arrivals</option>
					<option value="3"<?php if($srowsprod_mst['prodm_typ']=='3') echo 'selected';?>>Best Sellers</option>
					<?php /*?><option value="4"<?php if($srowsprod_mst['prodm_typ']=='4') echo 'selected';?>>New Arrivals & Best Sellers</option>
					<option value="5"<?php if($srowsprod_mst['prodm_typ']=='5') echo 'selected';?>>All</option><?php */?>
					<option value="6"<?php if($srowsprod_mst['prodm_typ']=='6') echo 'selected';?>>Monthly Special</option>
				</select>			</td>
			<td width="41%"></td>												
		  </tr>
		   <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Title</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2">
			 <input name="txtseotitle" type="text" class="select" id="txtseotitle" size="30" maxlength="50" value="<?php echo $srowsprod_mst['prodm_seotitle'];?>">
			</td>														
		 </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Description</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2"><textarea name="txtseodesc" type="text" class="select" id="txtseodesc" rows="5" cols="40"><?php echo $srowsprod_mst['prodm_seodesc'];?></textarea>
			</td>														
		 </tr>
		  <tr bgcolor="#f0f0f0">
		  	<td width="18%" align="left" valign="top">SEO Keyword</td>
			<td width="2%" align="center">:</td>
			<td width="80%" colspan="2"><textarea name="txtseokywrd" type="text" class="select" id="txtseokywrd" rows="5" cols="40"><?php echo $srowsprod_mst['prodm_seokywrd'];?></textarea>
			</td>														
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H1-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<input name="txtseoh1ttl" type="text" class="select" id="txtseoh1ttl" size="30" maxlength="50" value="<?php echo $srowsprod_mst['prodm_seohonetitle'];?>"></td>
		</tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H1-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<textarea name="txtseoh1desc" id="txtseoh1desc" rows="5" cols="40" class="select"><?php echo $srowsprod_mst['prodm_seohonedesc'];?></textarea>			
			</td>
		  </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H2-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<input name="txtseoh2ttl" type="text" class="select" id="txtseoh2ttl" size="30" maxlength="50" value="<?php echo $srowsprod_mst['prodm_seohtwotitle'];?>"></td>
		</tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H2-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td colspan="2" align="left" valign="middle">
			<textarea name="txtseoh2desc" id="txtseoh2desc" rows="5" cols="40" class="select"><?php echo $srowsprod_mst['prodm_seohtwodesc'];?></textarea>			
			</td>
		  </tr>
		 <tr bgcolor="#f0f0f0">
		  	<td width="20%" align="left">Rank * </td>
				<td width="2%" align="center">:</td>
			<td width="37%">
		    <input type="text" name="txtprty" id="txtprty" class="select" size="4" maxlength="3" value="<?php echo $srowsprod_mst['prodm_prty'];?>"></td>
			<td width="41%"><span id="errorsDiv_txtprty"></span></td>												
		  </tr>												
		  <tr bgcolor="#f0f0f0">
		  	<td width="20%" align="left" valign="middle">Status</td>
			<td width="2%">:</td>
            <td width="37%" align="left" valign="middle">
				<select name="lststs" id="lststs">
				<option value="a"<?php if($srowsprod_mst['prodm_sts']=='a') echo 'selected';?>>Active</option>
				<option value="i"<?php if($srowsprod_mst['prodm_sts']=='i') echo 'selected';?>>Inactive</option>
		    </select>			  </td>
			<td width="41%"></td>
		  </tr>		 
			
			<?php /*?><tr bgcolor="#FFFFFF">
				<td colspan="4">
				<div  id="divaddsrvc">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			   	<tr>
				 <td bgcolor="#F3F3F3" width="10%" align="center"></td>
				 <td bgcolor="#F3F3F3" width="20%" align="left">				 
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
					 <input name="txtofrprc" type="text" class="select" id="txtofrprc" size="10" >				 </td>
					  
				    <td bgcolor="#F3F3F3" width="30%" align="center">				  				
				      <input name="btnadsrvc"  id="btnadsrvc" type="button"  value="ADD" onClick="funcAddprcMenu('add')">
				    </td>								
				</tr>														
		  </table>
		  </div>
		  <div  id="divedtsrvc"  style="display:none">		 
		    <input type="hidden" name="hdnprcid" id="hdnprcid">	   			
            <table width="100%"  border="0" cellspacing="1" cellpadding="1">
					 <tr>
					      <td bgcolor="#F3F3F3" width="10%" align="center"></td>
						  <td bgcolor="#F3F3F3" width="20%"  align="left">
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
				<td bgcolor="#F3F3F3"  width="20%" align="center"><strong>Ofrprc</strong></td>
				<td bgcolor="#F3F3F3"  width="30%" align="center"><strong>Manage</strong></td>
             </tr>
			 <tr align="center">  
				<td  colspan="8">		 
					   <div id="divprc">
                           <?php
						      	funcprcedt();
								if($gprcedt!="")					
								{							
								  echo $gprcedt;
								}
						   ?>
                       </div>
					   <span id="errorsDiv_hidprc" style="color:#FF0000"></span>
				 </td>
			 </tr>	 
			</table>
				</td>
				
				</tr><?php */?>
			
			
			
			
			
			
			<tr bgcolor="#f0f0f0">
				<td colspan="4">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
				<tr>
                <td width="5%"><strong>SL.No.</strong></td>
                <td width="10%"><strong>Name</strong></td>
				<td width="10%"><strong>Link</strong></td>
				<td width="25%" align='center' colspan='2'><strong>Small Image</strong></td>
				<td width="20%" align='center' colspan='2'><strong>Big Image</strong></td>
				<td width="20%" align='right'><strong>Rank</strong></td>
				<td width="10%"><strong>Status</strong></td>
				
                <td width="10%"><strong>Remove</strong></td>
			  </tr>
				<?php
			  	$sqryimg_dtl="select 
								  prodimgd_id,prodimgd_title,prodimgd_simg,prodimgd_bimg,prodimgd_prty ,
								  prodimgd_sts,prodimgd_lnk
							  from 
								  prodimg_dtl
							  where 
								  prodimgd_prodm_id  ='$id' 
							  order by 
								  prodimgd_id";
	            $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);		
		        $cntprodimg_dtl  = mysqli_num_rows($srsimg_dtl);
			  	$nfiles = "";
				if($cntprodimg_dtl > 0){								
			  	while($rowsprodimgd_mdtl=mysqli_fetch_assoc($srsimg_dtl)){
					$prodimgdid = $rowsprodimgd_mdtl['prodimgd_id'];
					$db_prdimg  = $rowsprodimgd_mdtl['prodimgd_title'];
					$arytitle   = explode("-",$db_prdimg);
					$nfiles +=1;
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#f0f0f0'";
					}
					else{
						$clrnm = "bgcolor='#f0f0f0'";
					}
			  ?>
			  <tr bgcolor="#f0f0f0">
                <td colspan="8" align="center"  >
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">								
                    <input type="hidden" name="hdnsmlimg<?php echo $nfiles?>" class="select" value="<?php echo $rowsprodimgd_mdtl['prodimgd_simg'];?>">
                    <input type="hidden" name="hdnbgimg<?php echo $nfiles?>" class="select" value="<?php echo $rowsprodimgd_mdtl['prodimgd_bimg'];?>">
                    <input type="hidden" name="hdnproddid<?php echo $nfiles?>" class="select" value="<?php echo $prodimgdid;?>">
                        <tr bgcolor="#f0f0f0">
                        <td width='5%'><?php echo  $nfiles;?></td>
                        <td width='10%' align='center'>
                        <input type="text" name="txtphtname<?php echo $nfiles?>" id="txtphtname<?php echo $nfiles;?>" value='<?php echo $arytitle[1];?>' class="select" size="10"></td>
						
						   <td width='10%' align='center'>
                        <input type="text" name="txtphtlnk<?php echo $nfiles?>" id="txtphtlnk<?php echo $nfiles;?>" value='<?php echo $rowsprodimgd_mdtl['prodimgd_lnk'];?>' class="select" size="10"></td>
                        <td align="right" width='15%'><input type="file" name="flesmlimg<?php echo $nfiles;?>"  id="flesmlimg" class="select" size="5">
                        </td>
                        <td align="left" width='10%'>
                        <?php
                              $imgnm = $rowsprodimgd_mdtl['prodimgd_simg'];
                              $imgpath = $gsml_fldnm.$imgnm;						   
                              if(($imgnm !="") && file_exists($imgpath)){
                                     echo "<img src='$imgpath' width='30pixel' height='30pixel'>";
                              }
                              else{
                                 echo "No Image";
                              }
                          ?>
                        
                        <span id="errorsDiv_flesmlimg1"></span></td>
                        <td width='10%' >
                        <td align="right" width='20%'><input type="file" name="flebgimg<?php echo $nfiles?>" class="select" id="flebgimg" size="5" >
                        </td>
                        <td align="left" width='10%'>
                        <?php
                              $bgimgnm = $rowsprodimgd_mdtl['prodimgd_bimg'];
                              $bgimgpath = $gbg_fldnm.$bgimgnm;								   
                              if(($bgimgnm !="") && file_exists($bgimgpath)){
                                     echo "<img src='$bgimgpath' width='30pixel' height='30pixel'>";
                              }
                              else{
                                 echo "No Image";
                              }
                          ?>
                        
                        <span id="errorsDiv_flesmlimg1"></span></td>
                        <td width='20%' >
                       <input type="text" name="txtphtprior<?php echo $nfiles?>" id="txtphtprior1" class="select" value="<?php echo $rowsprodimgd_mdtl['prodimgd_prty'];?>" size="4" maxlength="3"><span id="errorsDiv_txtphtprior1"></span></td>						
                        <td valign="middle"   width='10%' >					
                        <select name="lstphtsts<?php echo $nfiles?>" id="lstphtsts<?php echo $nfiles?>" >
                            <option value="a" <?php if($rowsprodimgd_mdtl['prodimgd_sts']=='a') echo 'selected'; ?>>Active</option>
                            <option value="i" <?php if($rowsprodimgd_mdtl['prodimgd_sts']=='i') echo 'selected'; ?>>Inactive</option>
                        </select></td>
                    </table>
                </td>						
						<td width='10%'><input type="button"  name="btnrmv" 
						 value="REMOVE"  onClick="rmvimg('<?php echo $prodimgdid; ?>')"></td>			
					</tr>
			  <?php
			  	}
				}
				else{
					$nfiles = 1
				?>
<tr bgcolor="#f0f0f0">
				<td colspan="8" align="center" >
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
						<td width="30%"  align="center" colspan='2'>
							<input type="file" name="flesmlimg1" class="select" id="flesmlimg1" ><br/>
							<span id="errorsDiv_flesmlimg1" style="color:#FF0000" ></span>
						</td>
						<td width="30%"  align="center" colspan='2'>
							<input type="file" name="flebgimg1" class="select" id="flebgimg1" ><br/>
							<span id="errorsDiv_flebgimg1" style="color:#FF0000"></span>
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
            <?php				
				//	echo "<tr bgcolor='#f0f0f0'><td colspan='4' align='center' >Image not available</td></tr>";
				}
				
				?>
					<tr bgcolor="#f0f0f0">
					<td colspan="8" align='center'>
						<div id="myDiv">				
						  <table width="100%">						  			  
							<tr>
								<td align="center">
								<input name="btnadd" type="button" onClick="expand()" value="Add Another Image" class="subtitles">												                                </td>
							</tr>
							<tr>
								<td align="center">
								<span id="errorsDiv_hdntotcntrl"></span></td>
							</tr>
						</table>
						</div>
					</td>
					<td align="center"  ></td>
				</tr>
				</table>
				</td>
				</tr>
				          <tr bgcolor="#f0f0f0"> 
            <td colspan="8" align="right" valign="middle">&nbsp;</td>
          </tr>

                
                <input type="hidden" name="hdntotcntrl" id="hdntotcntrl" value="<?php echo $nfiles;?>">				
		  <tr bgcolor="#f0f0f0">
			<td colspan="8" align="center">
			  <input name="btnedtprodsbmt" id="btnedtprodsbmt" type="submit" class="" value="Save">
			  <input type="Reset" class=""  name="btnReset" value="Reset"  onClick="funcScat()">
       	     	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_products_detail.php?vw=<?php echo $id;?>&pg=<?php echo $pg."&countstart=".$cntstart.$loc;?>'"> </tr>
	   </table> 
	   </form>
	   </td>
    </tr>  
</table>
  <?php include_once ('../includes/inc_adm_footer.php');?>
<!--</div>-->
</body>
</html>

   <script language="javascript" type="text/javascript">
function funcScat(){
		var catid;
		catid = document.getElementById('lstcat').value;	
		for(i=document.getElementById('lstscat').length-1;i>=1; i--){
			document.getElementById('lstscat').options[i] = null;
		}							
		if(catid != ""){
			var url = "chkvalidname.php?selcat="+catid;
			xmlHttp	= GetXmlHttpObject(funcScatval);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			//document.getElementById("divlstCntry").innerHTML = "";
		}
	}
	function funcScatval(){ 
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
					hdnscatid=document.getElementById('hdnscatid').value;
					var newopt=new Option(name,id);
					if(id==hdnscatid){
						newopt.selected="selected";
					}
					document.getElementById('lstscat').options[i+1] = newopt;
				}
			}
		}
	}	
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtadmndescone');
	CKEDITOR.replace('txtadmndesctwo');
</script>
  <script language="javascript" type="text/javascript">
/********************Multiple Image Upload********************************/
	  var nfiles ="<?php echo $nfiles;?>";
	   function expand () {	   		
			nfiles ++;
            var htmlTxt = '<?php
					echo "<table width=100%  border=0 cellspacing=1 cellpadding=1 >"; 
					echo "<tr>";
					echo "<td align=left width=5%>";
					echo "<span class=buylinks> ' + nfiles + '</span></td>";
					echo "<td  width=10% >";
					echo "<input type=text name=txtphtname1' + nfiles + ' id=txtphtname1' + nfiles + ' class=select size=10></td>";
					echo "<td  width=10% >";
					echo "<input type=text name=txtphtlnk1' + nfiles + ' id=txtphtlnk1' + nfiles + ' class=select size=10></td>";

					echo "<td align=left width=50 colspan=2>";
					echo "<input type=file name=flesmlimg' + nfiles + ' id=flesmlimg' + nfiles + ' class=select size=10></td>";
					echo "<td align=left width=50 colspan=2 >";
					echo "<input type=file name=flebgimg' + nfiles + ' id=flebgimg' + nfiles + ' class=select size=10></td>";
					echo "<td align=right width=20% align=right>";
					echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=select size=4 maxlength=3>";
					echo "</td>"; 
					echo "<td  width=20% align=right colspan=2>";
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
				document.frmedtclr.hdntotcntrl.value = nfiles;	
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
			document.frmedtclr.hdntotcntrl.value = nfiles;
			
        }		
</script>