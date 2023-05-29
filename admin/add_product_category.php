<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";
	/**********************************************************
	Programm 	  : add_product_category.php	
	Package 	  : 
	Purpose 	  : For add Product Category  Details
	Created By    : Aradhana
	Created On    :	15-10-2014
	Modified By   : 
	Modified On   : 
	Purpose 	  : 
	Company 	  : Adroit
	************************************************************/	
	global $gmsg;	
	
	if(isset($_POST['btnprodcatsbmt']) && (trim($_POST['btnprodcatsbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
	  // include_once "../includes/inc_fnct_fleupld.php"; // For uploading files
		include_once "../database/iqry_prodcat_mst.php";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
	<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
		<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
    	//rules[1]='flesmlimg:Rank|required|Select Image';
		//rules[2]='flebnrimg:Rank|required|Select Icon Image';
		rules[3]='txtprior:Rank|required|Enter Rank';
		rules[4]='txtprior:Rank|numeric|Enter Only Numbers';
		//rules[5]='txthmprior:Home Rank|required|Enter Home Rank';
		//rules[6]='txthmprior:Home Rank|numeric|Enter Only Numbers';
	</script>
	<script language="javascript">	
		function setfocus(){
			document.getElementById('txtname').focus();
		}
	</script>
	<?php 
	include_once ('script.php');
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
	<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name;
		name = document.getElementById('txtname').value;		
		if(name != ""){
			var url = "chkvalidname.php?prodcatname="+name;
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
<body>
	<?php include_once '../includes/inc_adm_header.php';
		  include_once '../includes/inc_adm_leftlinks.php'; ?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif"  
		style="background-position:top; background-repeat:repeat-x; ">
         
         
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center' bgcolor="#FFFFFF">
            <form name="frmaddprodcat" id="frmaddprodcat" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		  		enctype="multipart/form-data" onSubmit="return performCheck('frmaddprodcat', rules, 'inline');" >
              <tr class='white'>
				<td colspan='4' bgcolor="#FF543A"><span class="heading">Add Vehicle Brand </span></td>
			</tr>
			  <?php
			  	if($gmsg != ""){
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
                <td width="23%" height="19" valign="middle" ><strong>Name</strong> * </td>
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle" >
                  <input name="txtname" type="text" class="select" id="txtname" 
						size="45" maxlength="40" onBlur="funcChkDupName()">
                  </td>
                <td width="35%" align="left" valign="middle" >
                  <span id="errorsDiv_txtname" ></span>					</td>
                </tr>
            
			  <tr bgcolor="#f9f8f8">
                <td width="23%" height="19" valign="top"  colspan="4"><strong>Description :</strong> </td>
			  </tr>
              <tr bgcolor="#FFFFFF">
                <td width="40%" align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" rows="12" cols="60" class="" id="txtdesc"></textarea>
                  </td>
             </tr>
			  	
			 <?php /*?><tr>			  
					<td width="27%" height="19" valign="middle" ><p><strong>Small Image</strong></p>
				    <td align="center" ><strong>:</strong></td>
					<td >
					  <input type="file" class="select" id="flesmlimg" name="flesmlimg"><br/><strong>(SIZES: H 400 X W 300) </strong> 				
					</td>	
					<td >
						
				  <span id="errorsDiv_flesmlimg" ></span>	</td>			 	
               </tr>
              <tr>
                 <td width="27%" height="19" valign="middle" >
                	<strong>Icon Image</strong>
                 </td>
                 <td align="center" ><strong>:</strong></td>
                 <td >
                  <input type="file" class="select" id="flebnrimg" name="flebnrimg"><br/><strong>(SIZES: H 100 X W 100) </strong>				
                 </td>	
                 <td ><span id="errorsDiv_flebnrimg" ></span></td>			 	
                </tr><?php */?> 
              <tr bgcolor="#f9f8f8">
                <td > <strong>SEO Title</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <input type="text" name="txtseotitle" id="txtseotitle" class="select" size="45" maxlength="250">	</td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td > <strong>SEO Description</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
				<textarea name="txtseodesc" rows="5" cols="40" class="" id="txtseodesc"></textarea>	</td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td > <strong>SEO Keyword</strong> </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <textarea name="txtkywrd" rows="5" cols="40" class="" id="txtkywrd"></textarea></td>
                </tr>
			  <tr bgcolor="#FFFFFF">
                <td > <strong>SEO H1-Title</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <input type="text" name="txtseoh1ttl" id="txtseoh1ttl" class="select" size="45" maxlength="250">	</td>
              </tr>
			  <tr bgcolor="#f9f8f8">
                <td > <strong>SEO H1-Description</strong> </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <textarea name="txtseoh1desc" rows="5" cols="40" class="" id="txtseoh1desc"></textarea></td>
              </tr>
			  <tr bgcolor="#FFFFFF">
                <td > <strong>SEO H2-Title</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <input type="text" name="txtseoh2ttl" id="txtseoh2ttl" class="select" size="45" maxlength="250">	</td>
                </tr>
			  <tr bgcolor="#f9f8f8">
                <td > <strong>SEO H2-Description</strong> </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <textarea name="txtseoh2desc" rows="5" cols="40" class="" id="txtseoh2desc"></textarea></td>
              </tr>		  
              <tr bgcolor="#FFFFFF">
                <td > <strong>Rank</strong> * </td>
                <td ><strong>:</strong></td>
                <td >
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3">	</td>
                <td ><span id="errorsDiv_txtprior"></span></td>
                </tr>
				<?php /*?><tr bgcolor="#FFFFFF">
                <td > <strong>Home Rank</strong> * </td>
                <td ><strong>:</strong></td>
                <td >
                  <input type="text" name="txthmprior" id="txthmprior" class="select" size="4" maxlength="3">	</td>
				  <td ><span id="errorsDiv_txthmprior"></span></td>
                </tr><?php */?>
              <tr bgcolor="#f9f8f8">
                <td width="23%" height="19" valign="middle" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="40%" align="left" valign="middle" >					
                  <select name="lststs" id="lststs">
                    <option value="a" selected>Active</option>
                    <option value="i">Inactive</option>
                  </select></td>
                <td width="35%" align="left" valign="middle" >&nbsp;</td>
                </tr>             
              <tr valign="middle" bgcolor="#FFFFFF">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnprodcatsbmt" id="btnprodcatsbmt" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnprodcatreset" value="Reset" id="btnprodcatreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='view_product_category.php'"></td>
                </tr>
              </form>
            </table>
        </td>
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