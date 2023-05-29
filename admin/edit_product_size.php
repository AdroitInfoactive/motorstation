<?php
    include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	include_once "../includes/inc_config.php";
	//include_once 'searchpopcalendar.php'; 
	include_once "../includes/inc_folder_path.php";	
	/***************************************************************
	Programm 	  : edit_product_subcategory.php	
	Purpose 	  : For Edit Product SubCategory Details
	Company 	  : Adroit
	************************************************************/
	global $id,$pg,$countstart;		
	if(isset($_POST['btnesizesbmt']) && (trim($_POST['btnesizesbmt']) != "") && 
	   isset($_POST['lsttrtyp']) && (trim($_POST['lsttrtyp']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['vw']) && (trim($_POST['vw']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	
	    include_once "../includes/inc_fnct_fleupld.php"; // For uploading files  
		include_once "../database/uqry_prodsize_mst.php";
	}
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") &&
	   isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id 	  = glb_func_chkvl($_REQUEST['vw']);
		$pg 	  = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
		$lstcatid = glb_func_chkvl($_REQUEST['lstcatid']);
		$val  	  = glb_func_chkvl($_REQUEST['txtsrchval']); 
		$txttofrmdt	= glb_func_chkvl($_REQUEST['txttofrmdt']);	 
		$chk  	  = glb_func_chkvl($_REQUEST['chkexact']); 
		if($val !=""){
		$loc ="&txtsrchval=".$val;	
		}
		if($chk == "y"){
		$loc .="&chkexact=".$chk;
		}
		if($lstcatid !=""){
		$loc .="&lstcatid=".$lstcatid;	
		}
		if($txttofrmdt !=""){
		$loc .="&txttofrmdt=".$txttofrmdt;	
		}
		$sqrysize_mst="select 
								sizem_name,sizem_desc,sizem_trtypm_id,sizem_sts,
								sizem_prty,sizem_seotitle,sizem_seodesc,sizem_seokywrd,
								sizem_szchrtimg,sizem_seohonettl,sizem_seohtwottl,
								sizem_seohonedesc,sizem_seohtwodesc,sizem_icnimg							
						   from 
								size_mst
						   where 
								sizem_id=$id";
		$srssize_mst  	= mysqli_query($conn,$sqrysize_mst) or die (mysql_error());
		$cntrec 			= mysqli_num_rows($srssize_mst);
		if($cntrec > 0){
			$rowssize_mst = mysqli_fetch_assoc($srssize_mst);
		}else{
			?>
			<script>
				location.href = "view_product_size.php";
			</script>
			<?php
			exit();
		}
  }else{
 	?>
		<script>
			location.href = "view_product_size.php";
		</script>
	<?php
	exit();
 } 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<title><?php echo $pgtl; ?> </title>
	<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
    	//var todtval = document.getElementById('txttodt').value;
		var rules=new Array();
		rules[0]='lsttrtyp:Name|required|Select Vehicle Type';
    	rules[1]='txtname:Name|required|Enter Name';
    	rules[2]='txtprior:Rank|required|Enter Rank';
		rules[3]='txtprior:Rank|numeric|Enter Only Numbers';
		//rules[4]='txtfrmdt:Valid From|date';
		//rules[5]='txttodt:Valid To|date';
    	//rules[6]='txtfrmdt:Valid From|date_le|$txttodt:Valid To';
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
		var name = document.getElementById('txtname').value;
		var trtypid  = document.getElementById('lsttrtyp').value;
		id 	 = <?php echo $id;?>;		
		if(trtypid!="" && name != ""){
			var url = "chkvalidname.php?szname="+name+"&trtypid="+trtypid+"&subdid="+id;
				xmlHttp	= GetXmlHttpObject(stateChanged);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);
			}
			else{
				document.getElementById('errorsDiv_txtname').innerHTML = "";
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
<body onLoad="setfocus(),init()">
<?php include_once  '../includes/inc_adm_header.php'; 
	  include_once '../includes/inc_adm_leftlinks.php';?>
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
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#FFFFFF">
		   <form name="frmedttrtypid" id="frmedttrtypid" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		   onSubmit="return performCheck('frmedttrtypid', rules, 'inline');" enctype="multipart/form-data">
               <input type="hidden" name="vw" id="vw" value="<?php echo $id;?>">
              <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
              <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
			  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
			  <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">  
			  <input type="hidden" name="hdnszimg" id="hdnszimg" value="<?php echo $rowssize_mst['sizem_szchrtimg'];?>"> 
			   <input type="hidden" name="hdnbgimg"    value="<?php echo $rowssize_mst['sizem_icnimg'];?>"> 
              <tr class='white'>
				<td colspan='4' bgcolor="#FF543A"><span class="heading">Edit Tyre Size </span></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
                <td width="24%" height="19" valign="middle" ><strong>Vehicle Type  * </strong></td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle" >	
                  <select name="lsttrtyp" id="lsttrtyp">
                    <option value="">--Select--</option>
                    <?php
					  $sqrytrtyp_mst= "select 
								   		 	trtypm_id,trtypm_name						
			              		   	   from 
						               		trtyp_mst
										order by trtypm_name";
                     $rstrtyp_mst  =  mysqli_query($conn,$sqrytrtyp_mst);
					 $cnt_trtyp    =  mysqli_num_rows($rstrtyp_mst);
					        while($rowstrtyp_mst=mysqli_fetch_assoc($rstrtyp_mst)){	  
							 $catid   =$rowstrtyp_mst['trtypm_id'];	  
							 $name    =$rowstrtyp_mst['trtypm_name'];
					 ?>
                    <option value="<?php echo $catid;?>"<?php if($rowssize_mst['sizem_trtypm_id']=="$catid") echo 'selected';?>>                             <?php echo $name;?></option>
                   <?php 
				   							 }	 
					?></select></td>
                <td width="34%"  style="color:#FF0000"><span id="errorsDiv_lsttrtyp"></span></td></tr>
              <tr bgcolor="#f9f8f8">
                <td width="24%" height="19" valign="middle" ><strong> Name * </strong></td> 
                <td width="2%" ><strong>:</strong></td> 
                <td width="40%" align="left" valign="middle" >
                  <input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" 
					  value="<?php echo $rowssize_mst['sizem_name'];?>"   onBlur="funcChkDupName()">	</td>
                <td width="34%"  style="color:#FF0000"><span id="errorsDiv_txtname"></span></td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="23%" height="19" valign="top"  colspan="4"><strong>Description :</strong>   </td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td width="40%" align="left" valign="middle"  colspan="4">
                  <textarea name="txtdesc" rows="12" cols="60" class="" id="txtdesc">
						<?php echo stripslashes($rowssize_mst['sizem_desc']);?></textarea>     </td>
                </tr>
			<?php /*?><tr>			  
				<td ><strong>Image</strong></td>
				<td ><strong>:</strong></td>
				<td >
					<input type="file" class="select" id="fleszchrtimg" name="fleszchrtimg"><br/><strong>(SIZES: H 400 X W 300) </strong>
				</td>	
				<td >
					<?php
					   $szimgnm    = $rowssize_mst['sizem_szchrtimg'];
					   $szimgpath  = $gszchrt_upldpth.$szimgnm;
					   if(($szimgnm !="") && file_exists($szimgpath)){
						  echo "<img src='$szimgpath' width='50pixel' height='50pixel'>";					 
					   }
					   else{
						  echo "Image not available";						 				  
					   }
					?>			
				</td>			 	
			</tr>
			 <tr>
				<td width="25%" height="19" valign="top" >
                	<strong>Icon Image</strong>
                </td>
                <td align="center"  valign="top"><strong>:</strong></td>
				<td  valign="top">
				  <input type="file" class="select" id="flebgimg" name="flebgimg"><br><strong>(SIZES: H 100 X W 100) </strong>  </td>	
				<td >
				             
               </td>			 	
		  	  </tr><?php */?>
              <tr bgcolor="#FFFFFF">
                <td > <strong>SEO Title</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                  <input type="text" name="txtseotitle" id="txtseotitle" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowssize_mst['sizem_seotitle'];?>">				  </td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td > <strong>SEO Description</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
					 <textarea name="txtseodesc" rows="5" cols="40" class="" id="txtseodesc"><?php echo stripslashes($rowssize_mst['sizem_seodesc']);?></textarea>				  </td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td > <strong>SEO Keyword</strong>  </td>
                <td ><strong>:</strong></td>
                <td  colspan="2">
                <textarea name="txtkywrd" rows="5" cols="40" class="" id="txtkywrd"><?php echo stripslashes($rowssize_mst['sizem_seokywrd']);?></textarea></td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H1-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh1ttl" id="txtseoh1ttl" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowssize_mst['sizem_seohonettl'];?>">				  </td>
                </tr>
				<tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H1-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                <textarea name="txtseoh1desc" rows="5" cols="40" class="" id="txtseoh1desc"><?php echo stripslashes($rowssize_mst['sizem_seohonedesc']);?></textarea></td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H2-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh2ttl" id="txtseoh2ttl" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowssize_mst['sizem_seohtwottl'];?>">				  </td>
                </tr>
				<tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H2-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                <textarea name="txtseoh2desc" rows="5" cols="40" class="" id="txtseoh2desc"><?php echo stripslashes($rowssize_mst['sizem_seohtwodesc']);?></textarea></td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td > <strong>Rank</strong> * </td>
                <td ><strong>:</strong></td>
                <td >
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" 
					  maxlength="3" value="<?php echo $rowssize_mst['sizem_prty'];?>">				  </td>
                <td  style="color:#FF0000"><span id="errorsDiv_txtprior"></span></td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td width="24%" height="19" valign="middle" ><strong>Status</strong></td>
                <td ><strong>:</strong></td>
                <td width="40%" align="left" valign="middle" >
                  <select name="lststs" id="lststs">
                    <option value="a"<?php if($rowssize_mst['sizem_sts']=='a') echo 'selected';?>>Active</option>
                    <option value="i"<?php if($rowssize_mst['sizem_sts']=='i') echo 'selected';?>>Inactive</option>
                    </select>					</td>
                <td ></td>
                </tr>
              <tr valign="middle" bgcolor="#f9f8f8">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btnesizesbmt" id="btnesizesbmt" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btntrtypreset" value="Reset" id="btntrtypreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" 
					  onclick="location.href='view_detail_product_size.php?vw=<?php echo $id;?>&pg=<?php echo $pg."&countstart=".$cntstart.$loc;?>'">						</td>

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