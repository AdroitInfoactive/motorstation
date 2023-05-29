<?php
	include_once '../includes/inc_nocache.php';       //Clearing the cache information
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_usr_functions.php"; //Making database Connection
	include_once "../includes/inc_folder_path.php";
	include_once "../includes/inc_config.php";		
	/***************************************************************/
	//Programm 	  		: add_size.php	
	//Purpose 	  		: For adding size
	//Created By  		: Mallikarjuna
	//Created On  		:16/04/2013
	//Modified By 		:  Aradhana
	//Modified On   	: 07-06-2014	
	//Company 	  		: Adroit
	/************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnaddsize']) && ($_POST['btnaddsize']!= "")  && 	
	   isset($_POST['txtsize'])    && (trim($_POST['txtsize'])!= "") && 
	   isset($_POST['txtprior'])   && (trim($_POST['txtprior'])!= "")){
	         include_once "../database/iqry_size_mst.php";
	   }
	   
	/*$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary) || ($rqst_stp_attn[1]=='1')){
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
<?php include_once  ('script.php'); ?>
   <script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtsize:Name|required|Enter Name';
    	rules[1]='txtprior:Rank|required|Enter Rank';
		rules[2]='txtprior:Rank|numeric|Enter Only Numbers';	
		function setfocus(){
			document.getElementById('txtsize').focus();
		}
	</script>
<?php 
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
   <script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name;
		name = document.getElementById('txtsize').value;		
		if(name != ""){  
			var url = "chkvalidname.php?sizename="+name;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
			document.getElementById('errorsDiv_txtsize').innerHTML = "";
		}	
	}
	function stateChanged() 
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtsize").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtsize').focus();
			}		
		}
	}	
	</script></head>
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
        <td width="700" height="325" rowspan="2" valign="top"   class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
		
          <br>
          <table width="95%"  align='center' border="0" cellspacing="1" cellpadding="3" bgcolor="#FFFFFF">
            <form name="frmasize" id="frmasize" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		  		onSubmit="return performCheck('frmasize', rules, 'inline');" enctype="multipart/form-data">
              <tr align="left" class='white'>
                  <td height="30" colspan="4" bgcolor="#FF543A">
			 	<span class="heading"><strong>:: Add Vehicle type </strong></span>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			  <?php
			  	if($gmsg != "")
				{
					echo "<tr bgcolor='#FFFFFF'>
							<td align='center' valign='middle' bgcolor='#F3F3F3' colspan='4' >
								<font face='Arial' size='2' color = '#fda33a'>
									$gmsg
								</font>							
							</td>
			  			</tr>";
				}	
			  ?>
			  <tr bgcolor="#FFFFFF">
                <td width="23%" align="left" valign="top" ><strong>Name </strong> * </td>
                <td width="2%"  align="center" valign="top"><strong>:</strong></td> 
                <td width="41%" align="left" valign="top" >
                  <input name="txtsize" type="text" class="select" id="txtsize" size="45" maxlength="40" onBlur="funcChkDupName()">
                  </td>
                <td width="34%" align="left" valign="top" >
                  <span id="errorsDiv_txtsize" style="color:#FF0000"></span>
                  </td>
                </tr>
              
              <tr bgcolor="#f9f8f8">
                <td align="left" valign="top"  colspan="4"><strong>Description :</strong></td>
			 </tr>
			 <tr>
                <td align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" cols="60" rows="15"  id="txtdesc"></textarea>				
                </td>				  
             </tr>              
              <tr bgcolor="#FFFFFF">
                <td  align="left" valign="top"><strong>Rank</strong>* </td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td  align="left" valign="top">
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3">	</td>
                <td  align="left" valign="top"><span id="errorsDiv_txtprior" style="color:#FF0000"></span></td>
                </tr>				
              <tr bgcolor="#f9f8f8">
                <td width="23%" align="left" valign="top" ><strong>Status</strong></td>
                <td  align="center" valign="top"><strong>:</strong></td>
                <td width="41%" align="left" valign="top"  colspan="2">					
                  <select name="lststs" id="lststs">
                    <option value="a" selected>Active</option>
                    <option value="i">Inactive</option>
                  </select></td>
                </tr>
              
              <tr valign="middle" bgcolor="#FFFFFF">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnaddsize" id="btnaddsize" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnsizereset" value="Reset" id="btnsizereset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='view_all_size.php'">				                 </td>
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
	CKEDITOR.replace('txtdesc');
</script>