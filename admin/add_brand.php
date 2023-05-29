<?php
	include_once '../includes/inc_nocache.php';        //Clearing the cache information
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_usr_functions.php";  //checking for session
	include_once '../includes/inc_config.php';        //Making paging validation
	include_once '../includes/inc_folder_path.php';//Floder Path	
	/***************************************************************/
	//Programm 	  		: add_brand.php	
	//Purpose 	  		: for adding new ProductCategory
	//Created By  		: Mallikarjuna
	//Created On  		:	16/04/2013
	//Modified By 		: Aradhana
	//Modified On   	: 07-06-2014	
	//Company 	  		: Adroit
	/************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnaddbrnd']) && ($_POST['btnaddbrnd']!= "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['txtprior']) && ($_POST['txtprior'] != "")){
	     include_once "../includes/inc_fnct_fleupld.php"; // For uploading files	
		 include_once "../database/iqry_brnd_mst.php";
	   }
	   
	$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary) || ($rqst_stp_attn[1]=='1')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
	/*$rqst_stp      	= $rqst_arymdl[1];
	$rqst_stp_attn     = explode("::",$rqst_stp);
	$rqst_stp_chk      	= $rqst_arymdl[0];
	$rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
	if($rqst_stp_attn_chk[0] =='2'){
		$rqst_stp      	= $rqst_arymdl[0];
		$rqst_stp_attn     = explode("::",$rqst_stp);
	}
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(2,$sesvalary) || ($rqst_stp_attn[1]=='1')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?> </title>
<?php include_once 'script.php';?>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
		rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';
	
	function setfocus()
		{
			document.getElementById('txtname').focus();
		}
	</script>
<?php 
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
   <script language="javascript" type="text/javascript">
	function funcChkDupName()
	{
		var name;
		name = document.getElementById('txtname').value;
		name = document.getElementById('txtname').value;				
		if(name!="")
		{
			var url = "chkvalidname.php?brndname="+name;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChanged() 
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtname').focus();
			}		
		}
	}	
	</script>
 <script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
</head>
<body onLoad="setfocus()">
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="admcnt_bdr">
      <tr>
        <td width="7" height="30" valign="top"></td>
        <td width="700" height="325" rowspan="2" valign="top"  bgcolor="#FFFFFF" class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
	      <br>
          <table width="95%"  border="0" cellspacing="1" cellpadding="3">
            <form name="frmabrndcat" id="frmabrndcat" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		  		onSubmit="return performCheck('frmabrndcat', rules, 'inline');" enctype="multipart/form-data">
             <tr class='white'>
		   	<td height="26" colspan="4" bgcolor="#FF543A">
				<span class="heading"><strong>::Add Brand </strong></span></td>
	      </tr>
			  <tr bgcolor="#F2F1F1">
                <td width="26%" align="left" valign="top" ><strong>Name</strong> * </td>
                <td width="2%"  align="center" valign="top"><strong>:</strong></td> 
                <td width="41%" align="left" valign="top" >
                  <input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()"></td>
                <td width="31%" align="left" valign="top" >
                  <span id="errorsDiv_txtname" style="color:#FF0000"></span></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td  align="left" valign="top" colspan="4"><strong>Description</strong></td>
			  </tr>
			  <tr bgcolor="#F2F1F1">
                <td align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" cols="60" rows="15" id="txtdesc"></textarea>
                  </td>
                </tr>
              <tr >
                <td align="left" valign="top"><strong>Brand Logo(Brand)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="top" ><strong>:</strong></td>
                <td align="left" valign="top"><input name="flesmlimg" type="file" class="input" id="flesmlimg"></td>
                <td  align="left" valign="top"><span id="errorsDiv_flesmlimg"></span></td>
                </tr>
              <tr bgcolor="#F2F1F1">
                <td align="left" valign="top"><strong>Brand Logo(Zoom)</strong><cite style="color:#666666; font-size:9px;"><br>
                  </cite></td>
                <td align="center" valign="top" ><strong>:</strong></td>
                <td align="left" valign="top"><input name="flezmimg" type="file" class="input" id="flezmimg"></td>
                <td ><span id="errorsDiv_flezmimg"></span></td>
                </tr>
               <tr bgcolor="#f9f8f8">
			<td width="18%" align="left" valign="top" > <strong>SEO Title </strong></td>
			<td width="2%" align="center" valign="top" >:</td> 
			<td width="40%" align="left" valign="middle" colspan="2" >
				<input name="txtseotitle" type="text" class="select" id="txtseotitle" size="30" maxsize="250" >
			</td>
		 </tr>
		  <tr bgcolor="#F2F1F1">
			<td width="18%" align="left" valign="top" > <strong>SEO Description </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
			<td width="40%" align="left" valign="top" colspan="2" >
			  <textarea name="txtseodesc" cols="33" rows="4" id="txtseodesc"></textarea>
			  </td>
		  </tr>
		  <tr bgcolor="#f9f8f8">
			<td width="18%" align="left" valign="top" > <strong>SEO Keyword </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
			<td width="40%" align="left" valign="top"  colspan="2">
			  <textarea name="txtseokywrd" cols="33" rows="4" id="txtseokywrd"></textarea>
			</td>
		  </tr>
		  <tr bgcolor="#F2F1F1"> 
            <td width="16%" align="left" valign="top" > <strong>SEO H1-Title </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
            <td colspan="2" align="left" valign="middle" >
			<input name="txtseoh1ttl" type="text" class="select" id="txtseoh1ttl" size="30" maxlength="50"></td>
		</tr>
		 <tr bgcolor="#f9f8f8"> 
            <td width="16%" align="left" valign="top" > <strong>SEO H1-Description </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
            <td colspan="2" align="left" valign="middle" >
			<textarea name="txtseoh1desc" id="txtseoh1desc" cols="33" rows="4" class="select"></textarea>			
			</td>
		  </tr>
		  <tr bgcolor="#F2F1F1"> 
            <td width="16%" align="left" valign="top" > <strong>SEO H2-Title </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
            <td colspan="2" align="left" valign="middle" >
			<input name="txtseoh2ttl" type="text" class="select" id="txtseoh2ttl" size="30" maxlength="50"></td>
		</tr>
		  <tr bgcolor="#f9f8f8"> 
            <td width="16%" align="left" valign="top" > <strong>SEO H2-Description </strong></td>
			<td width="2%" align="center" valign="top" >:</td>
            <td colspan="2" align="left" valign="middle" >
			<textarea name="txtseoh2desc" id="txtseoh2desc" cols="33" rows="4" class="select"></textarea>			
			</td>
		  </tr>
			  <tr bgcolor="#F2F1F1">
                <td  align="left" valign="top"> <strong>Rank</strong> * </td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td  align="left" valign="top">
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3">	</td>
                <td  align="left" valign="top"><span id="errorsDiv_txtprior" style="color:#FF0000"></span></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td width="26%" align="left" valign="top" ><strong>Status</strong></td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td width="41%" align="left" valign="top" >					
                  <select name="lststs" id="lststs">
                    <option value="a" selected>Active</option>
                    <option value="i">Inactive</option>
                  </select></td>
                <td width="31%" align="left" valign="top" >&nbsp;</td>
                </tr>
              <?php
			  	if($gmsg != "")
				{
					echo "<tr bgcolor='#f9f8f8'>
							<td align='center' valign='middle' bgcolor='#F3F3F3' colspan='4' >
								<font face='Arial' size='2' color = 'red'>
									$gmsg
								</font>							
							</td>
			  			</tr>";
				}	
			  ?>
              <tr valign="middle" bgcolor="#F2F1F1">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnaddbrnd" id="btnaddbrnd" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnprdctcatreset" value="Reset" id="btnprdctcatreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='view_all_brands.php'">				                </td>
                </tr>
              </form>
            </table>
          </td>
        <td width="6" valign="top" ></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
<script language="javascript" type="text/javascript">
	//generate_wysiwyg('txtdesc');
	CKEDITOR.replace('txtdesc');
</script>

