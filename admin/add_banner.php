<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";
	/***************************************************************/
	//Programm 	  : add_banner.php
	//Company 	  : Adroit
	/************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnaddbnr']) && (trim($_POST['btnaddbnr']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
			include_once "../includes/inc_fnct_fleupld.php"; // For uploading files
			include_once "../database/iqry_bnr_mst.php";
	}
	$rd_crntpgnm = "vw_all_banners.php";
	$clspn_val   = "4";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>
<link href="yav-style.css" type="text/css" rel="stylesheet">
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	  <script language="JavaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';
		//yav.addHelp('txtname','Enter Product Name');
    	//yav.addHelp('txtprty','Enter your Rank');
	</script>
	<?php
		include_once '../includes/inc_fnct_ajax_validation.php'; //Includes ajax validations	
		include_once 'script.php';			
	?>	
	<script language="javascript">	
		function setfocus(){
			document.getElementById('txtname').focus();
		}
		function funcChkDupName(){
			var bnrname;
			bnrname = document.getElementById('txtname').value;		
			if(bnrname != ""){
				var url = "chkvalidname.php?bnrname="+bnrname;
				xmlHttp	= GetXmlHttpObject(funccatonestatChanged);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);			
			}
			else{
				document.getElementById('errorsDiv_txtname').innerHTML = "";
			}				
		}
		function funccatonestatChanged(){ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
				var temp=xmlHttp.responseText;
				document.getElementById("errorsDiv_txtname").innerHTML = temp;
				//document.getElementById("spndplct").innerHTML = temp;
				if(temp!=0){
					document.getElementById('txtname').focus();
				}		
			}
		}					
	</script>
</head>
<body>
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';
?>
<table width="1004"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
      <td height="350" valign="top"><br>
        <table width="95%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#fff">
		  <form name="frmaddbnr" id="frmaddbnr" method="post" enctype="multipart/form-data" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmaddbnr', rules, 'inline');" >
               <tr class='white'>
				<td height="26" colspan="4" bgcolor="#FF543A">
					<span class="heading">Add Banner</td>
			  </tr>
			   <?php
			  	if($gmsg != ""){
					echo "<tr >
							<td align='center' valign='middle' colspan='$clspn_val' >
								<font face='Arial' size='2' color = 'FF6600'>
									$gmsg
								</font>							
							</td>
			  			</tr>";
				}	
			  ?>
			   <tr>
                	<td width="13%" height="19" valign="middle" ><strong>Name *</strong> </td>
					<td width="2%" ><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle" >
						<input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="240" onBlur="funcChkDupName();">
					</td>
                 	<td width="43%" align="left" valign="middle"  >
						<div id="errorsDiv_txtname" style="color:#FF0000"></div>					
					</td>
				</tr>
				<tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle"  colspan="<?php echo $clspn_val;?>">
					<strong>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> </td>
				</tr>
				<tr>
					<td align="left" valign="middle"   colspan="<?php echo $clspn_val;?>">
						<textarea name="txtdesc" id="txtdesc" rows="6" cols="80"></textarea>
					</td>
                </tr>
				<tr>			  
                	<td width="27%" height="19" valign="middle" ><strong>Image</strong>
                  	<td align="center" ><strong>:</strong></td>
                	<td ><input type="file" class="select" id="flesmlimg" name="flesmlimg"><br/></span><strong>(SIZES: H 500 X W 1000) </strong></td>	
                	<td ><span id="errorsDiv_flesmlimg" ></td>			 	
                </tr>
				<tr bgcolor="#f9f8f8">
                	<td width="13%" height="19" valign="middle" ><strong>Link</strong> </td>
					<td width="2%" ><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle" ><input name="txtlnk" type="text" class="select" id="txtlnk" size="45" maxlength="240"></td>
                 	<td width="43%" align="left" valign="middle"  >				
					</td>
				</tr>
				<tr>
					<td  > <strong>Rank</strong>*</td>
					<td ><strong>:</strong></td>
					<td ><input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3">	</td>
					<td  ><span id="errorsDiv_txtprior" style="color:#FF0000"></span></td>
				</tr>
			  	<tr bgcolor="#f9f8f8">
					<td width="13%" height="19" valign="middle" ><strong>Status</strong></td>
					<td ><strong>:</strong></td>
					<td width="42%" align="left" valign="middle"  colspan="<?php echo $clspn_val-2;?>">					
						<select name="lststs" id="lststs" >
							<option value="a" selected>Active</option>
							<option value="i">Inactive</option>
					    </select>
				    </td>
				</tr>
			
			  <tr valign="middle">
				<td colspan="<?php echo $clspn_val;?>" align="center" >
				<input type="Submit" class="textfeild"  name="btnaddbnr" id="btnaddbnr" value="Submit" >
				&nbsp;&nbsp;&nbsp;
				<input type="reset" class="textfeild"  name="btnaddreset" value="Reset" id="btnaddreset">
				&nbsp;&nbsp;&nbsp;
				<input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='<?php echo $rd_crntpgnm;?>'">			
				</td>
			  </tr>
			  </form>
          </table>
          </td>
	</tr>  
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>