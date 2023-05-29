<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_config.php";
	include_once "../includes/inc_folder_path.php";	
	/**********************************************************
	Programm 	  : add_product_subcategory.php	
	Purpose 	  : For add Product SubCategory  Details
	Company 	  : Adroit
	************************************************************/	
	global $gmsg;	
	if(isset($_POST['btnprodscatsbmt']) && (trim($_POST['btnprodscatsbmt']) != "") &&
	   isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	 
	    //include_once "../includes/inc_fnct_fleupld.php"; // For uploading files  
		include_once "../database/iqry_prodsubcat_mst.php";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl; ?></title>
	<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	var rules=new Array();
    	rules[0]='txtname:Name|required|Enter Name';
		//rules[1]='txtname:Name|alphaspace|Name only characters and numbers';
		rules[2]='lstprodcat:Category|required|Select Vehicle Brand';
    	rules[3]='txtprior:Rank|required|Enter Rank';
		rules[4]='txtprior:Rank|numeric|Enter Only Numbers';
		//rules[5]='txtfrmdt:Valid From|date';
		//rules[6]='txttodt:Valid To|date';
    	//rules[7]='txtfrmdt:Valid From|date_le|$txttodt:Valid To';		
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
		var name = document.getElementById('txtname').value;
		var prodcatid  = document.getElementById('lstprodcat').value;		
		if(prodcatid!="" && name != ""){
			var url = "chkvalidname.php?prodscatname="+name+"&prodcatid="+prodcatid;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
		    document.getElementById('errorsDiv_lstprodcat').innerHTML="";
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
    <td valign="top" class="admcnt_bdr"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif" 
		class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
              
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center' bgcolor="#FFFFFF" >
             <tr class='white'>
				<td colspan='4' bgcolor="#FF543A"><span class="heading">Add Vehicle Model </span></td>
			</tr>
		    <form name="frmaddprodcat" id="frmaddprodcat" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		  		onSubmit="return performCheck('frmaddprodcat', rules, 'inline');" enctype="multipart/form-data">
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
                <td width="23%" height="19" valign="top" ><strong>Vehicle Brand </strong> * </td>
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="top" >
                  <?php
		             $sqryprodcat_mst= "select 
					 					prodcatm_id,prodcatm_name						
			              		 	from 
						            	 prodcat_mst
									order by prodcatm_name";
                     $rsprodcat_mst  =  mysqli_query($conn,$sqryprodcat_mst);
					 $cnt_prodcat	 =  mysqli_num_rows($rsprodcat_mst);	
                ?>	
                  <select name="lstprodcat" id="lstprodcat" onBlur="funcChkDupName()">
                    <option value="">--Select--</option>
                    <?php
					  if( $cnt_prodcat > 0){
				        while($rowsprodcat_mst=mysqli_fetch_assoc($rsprodcat_mst)){	  
							 $catid   =$rowsprodcat_mst['prodcatm_id'];	  
							 $catname =$rowsprodcat_mst['prodcatm_name'];
					 ?>
                    <option value="<?php echo $catid;?>"><?php echo $catname;?></option>
                    <?php 
				   		} 
					}	
				   ?>
                  </select></td>
                <td width="35%" align="left" valign="top" >
                  <span id="errorsDiv_lstprodcat" style="color:#FF0000"></span></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td width="23%" height="19" valign="top" ><strong>Name</strong> * </td>
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="top" >
                  <input name="txtname" type="text" class="select" id="txtname" 
						size="45" maxlength="40" onBlur="funcChkDupName()">
                  </td>
                <td width="35%" align="left" valign="top" >
                  <span id="errorsDiv_txtname" style="color:#FF0000"></span>					</td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="23%" height="19" valign="top"  colspan="4"><strong>Description :</strong> 
				</td>
              </tr>
			  <tr bgcolor="#f9f8f8"> 
                <td width="40%" align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" rows="12" cols="60" class="" id="txtdesc"></textarea>
                  </td>
                </tr>
		<?php /*?>   <tr>			  
				<td  valign="top"><strong> Image</strong></td>
				<td  valign="top"><strong>:</strong></td>
				<td  valign="top" colspan="2">
					<input type="file" class="select" id="fleszchrtimg" name="fleszchrtimg">								
				<br/><strong>(SIZES: H 400 X W 300) </strong></td>	
			</tr>
			<tr>
                 <td width="27%" height="19" valign="middle" >
                	<strong>Icon Image</strong>
                 </td>
                 <td align="center" ><strong>:</strong></td>
                 <td >
                  <input type="file" class="select" id="flebnrimg" name="flebnrimg"><br/><strong>(SIZES: H 100 X W 100) </strong>				
                 </td>	
                 <td ></td>			 	
           </tr><?php */?>
            <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseotitle" id="txtseotitle" class="select" size="45" maxlength="250">	</td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
				<textarea name="txtseodesc" rows="5" cols="40" class="" id="txtseodesc"></textarea>	</td>
                </tr>
				<tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO Keyword</strong> </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <textarea name="txtkywrd" rows="5" cols="40" class="" id="txtkywrd"></textarea></td>
              </tr>
			  <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H1-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh1ttl" id="txtseoh1ttl" class="select" size="45" maxlength="250">	</td>
              </tr>
			  <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H1-Description</strong> </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <textarea name="txtseoh1desc" rows="5" cols="40" class="" id="txtseoh1desc"></textarea></td>
              </tr>
			  <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H2-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh2ttl" id="txtseoh2ttl" class="select" size="45" maxlength="250">	</td>
                </tr>
			  <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H2-Description</strong> </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <textarea name="txtseoh2desc" rows="5" cols="40" class="" id="txtseoh2desc"></textarea></td>
              </tr>		  
              <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>Rank</strong> * </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top">
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" maxlength="3">	</td>
                <td  style="color:#FF0000"><span id="errorsDiv_txtprior"></span></td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="23%" height="19" valign="top" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="40%" align="left" valign="top"  colspan="2">					
                  <select name="lststs" id="lststs">
                    <option value="a" selected>Active</option>
                    <option value="i">Inactive</option>
                  </select></td>
             </tr>             
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnprodscatsbmt" id="btnprodscatsbmt" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnprodcatreset" value="Reset" id="btnprodcatreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" onClick="location.href='view_product_subcategory.php'"></td>
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