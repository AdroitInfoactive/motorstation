<?php
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Making database Connection
	include_once '../includes/inc_config.php';
	include_once "../includes/inc_folder_path.php";
	/***************************************************************
	Programm 	  : edit_product_category.php	
	Purpose 	  : For Edit Product Category Details
	Created By    : Mallikarjuna
	Created On    :	29/10/2012
	Modified By   : 
	Modified On   :
	Purpose 	  : 
	Company 	  : Adroit
	************************************************************/
	global $id,$pg,$countstart;
	
	if(isset($_POST['btneprodcatsbmt']) && (trim($_POST['btneprodcatsbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "") && 
	   //isset($_POST['txthmprior']) && (trim($_POST['txthmprior']) != "") && 
	   isset($_POST['vw']) && (trim($_POST['vw']) != "")){	
		include_once "../includes/inc_fnct_fleupld.php"; //For uploading files		
		include_once "../database/uqry_prodcat_mst.php";
	}
	
	if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") &&
	   isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") &&
	   isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!="")){
		$id			= glb_func_chkvl($_REQUEST['vw']);
		$pg 		= glb_func_chkvl($_REQUEST['pg']);
		$cntstart	= glb_func_chkvl($_REQUEST['countstart']);
	    $lstcatid = glb_func_chkvl($_REQUEST['lstcatid']);
		$lsttypid = glb_func_chkvl($_REQUEST['lsttypid']);
		$val  	  = glb_func_chkvl($_REQUEST['txtsrchval']);
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
		if($lsttypid !=""){
			$loc .="&lsttypid=".$lsttypid;	
		}	
		$sqryprodcat_mst="select 
								prodcatm_name,prodcatm_desc,prodcatm_seotitle,prodcatm_seodesc,
								prodcatm_smlimg,prodcatm_bnrimg,prodcatm_seokywrd,prodcatm_hmprty,										
								prodcatm_sts,prodcatm_prty,prodcatm_seohonettl,prodcatm_seohtwottl,							
								prodcatm_seohonedesc,prodcatm_seohtwodesc
							from 
							   prodcat_mst
							where 
							   prodcatm_id=$id";
		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrec =mysqli_num_rows($srsprodcat_mst);
		if($cntrec > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
		}else{
			header("Location:view_product_category.php");
			exit();
		}
	}
	else{
		header("Location:view_product_category.php");
		exit();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<link href="style_admin.css" rel="stylesheet" type="text/css">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
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
			id 	 = <?php echo $id;?>;		
			if((name != "") && (id != "")){
				var url = "chkvalidname.php?prodcatname="+name+"&prodid="+id;
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
<?php 
	  include_once  '../includes/inc_adm_header.php'; 
	  include_once '../includes/inc_adm_leftlinks.php';
?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="admcnt_bdr">
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif" 
		 class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
          <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center' bgcolor="#FFFFFF">
            <form name="frmedtprodcatid" id="frmedtprodcatid" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" enctype="multipart/form-data" 
             onSubmit="return performCheck('frmedtprodcatid', rules, 'inline');">             
             <input type="hidden" name="vw" id="vw" value="<?php echo $id;?>">
              <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
              <input type="hidden" name="countstart" id="countstart" value="<?php echo $cntstart?>">
			  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
			  <input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">  		  		
              <input type="hidden" name="hdnsmlimg"   value="<?php echo $rowsprodcat_mst['prodcatm_smlimg'];?>">
	          <input type="hidden" name="hdnbgimg"    value="<?php echo $rowsprodcat_mst['prodcatm_bnrimg'];?>"> 
			  <tr class='white'>
				<td colspan='4' bgcolor="#FF543A"><span class="heading">Edit Vehicle Brand </span></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
                <td width="25%" height="19" valign="top" ><strong> Name * </strong></td> 
                <td width="1%" ><strong>:</strong></td> 
                <td width="43%" align="left" valign="top" >
                  <input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="40" 
					  value="<?php echo $rowsprodcat_mst['prodcatm_name'];?>"   onBlur="funcChkDupName()">	</td>
                <td width="31%"  style="color:#FF0000"><span id="errorsDiv_txtname"></span></td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td width="25%" height="19" valign="top"  colspan="4">
                	<strong>Description</strong>   
                </td>
			   </tr>
              <tr bgcolor="#FFFFFF">                
                <td align="left" valign="top"  colspan="4">
                  <textarea name="txtdesc" rows="12" cols="60" class="" id="txtdesc">
						<?php echo stripslashes($rowsprodcat_mst['prodcatm_desc']);?>
                  </textarea>
                 </td>
                </tr>
				 
				<?php /*?><tr>
				<td width="25%" height="19" valign="top" >
                	<strong>Small Image</strong>                    
                </td>
				<td align="center"  valign="top"><strong>:</strong></td>
				<td  valign="top">
					<input type="file" class="select" id="flesmlimg" name="flesmlimg">  <br/><strong>(SIZES: H 400 X W 300) </strong>	
				</td>	
				<td >
				<?php
				   $imgnm   = $rowsprodcat_mst['prodcatm_smlimg'];
				   $imgpath = $gadmcatsml_upldpth.$imgnm;
					if(($imgnm !="") && file_exists($imgpath)){
					  echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
				   	}else{
					  echo "No Image";						 				  
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
				  <input type="file" class="select" id="flebgimg" name="flebgimg"><br><strong>(SIZES: H 100 X W 100) </strong>   	</td>	
				<td >
				<?php
				   $imgnm   = $rowsprodcat_mst['prodcatm_bnrimg'];
				   $imgpath = $gadmcatbnr_upldpth.$imgnm;
				if(($imgnm !="") && file_exists($imgpath))
				   {
					  echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
				   }
				   else
				   {
					  echo "No Image";						 				  
				   }
				?>	                
               </td>			 	
		  	  </tr><?php */?>
              <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseotitle" id="txtseotitle" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowsprodcat_mst['prodcatm_seotitle'];?>">				  </td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
					 <textarea name="txtseodesc" rows="5" cols="40" class="" id="txtseodesc"><?php echo stripslashes($rowsprodcat_mst['prodcatm_seodesc']);?></textarea>				  </td>
                </tr>
              <tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO Keyword</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                <textarea name="txtkywrd" rows="5" cols="40" class="" id="txtkywrd"><?php echo stripslashes($rowsprodcat_mst['prodcatm_seokywrd']);?></textarea></td>
                </tr>
				<tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H1-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh1ttl" id="txtseoh1ttl" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowsprodcat_mst['prodcatm_seohonettl'];?>">				  </td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H1-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                <textarea name="txtseoh1desc" rows="5" cols="40" class="" id="txtseoh1desc"><?php echo stripslashes($rowsprodcat_mst['prodcatm_seohonedesc']);?></textarea></td>
                </tr>
				<tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>SEO H2-Title</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                  <input type="text" name="txtseoh2ttl" id="txtseoh2ttl" class="select" size="45" 
					  maxlength="250" value="<?php echo $rowsprodcat_mst['prodcatm_seohtwottl'];?>">				  </td>
                </tr>
				<tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>SEO H2-Description</strong>  </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top" colspan="2">
                <textarea name="txtseoh2desc" rows="5" cols="40" class="" id="txtseoh2desc"><?php echo stripslashes($rowsprodcat_mst['prodcatm_seohtwodesc']);?></textarea></td>
                </tr>
              <tr bgcolor="#FFFFFF">
                <td  valign="top"> <strong>Rank</strong> * </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top">
                  <input type="text" name="txtprior" id="txtprior" class="select" size="4" 
					  maxlength="3" value="<?php echo $rowsprodcat_mst['prodcatm_prty'];?>">				  </td>
                <td  style="color:#FF0000"><span id="errorsDiv_txtprior"></span></td>
                </tr>
				<?php /*?><tr bgcolor="#f9f8f8">
                <td  valign="top"> <strong>Home Rank</strong> * </td>
                <td  valign="top"><strong>:</strong></td>
                <td  valign="top">
                  <input type="text" name="txthmprior" id="txthmprior" class="select" size="4" 
					  maxlength="3" value="<?php echo $rowsprodcat_mst['prodcatm_hmprty'];?>"></td>
				  <td  style="color:#FF0000"><span id="errorsDiv_txthmprior"></span></td>
                </tr><?php */?>
              <tr bgcolor="#f9f8f8">
                <td width="25%" height="19" valign="top" ><strong>Status</strong></td>
                <td  valign="top"><strong>:</strong></td>
                <td width="43%" align="left" valign="top" >
                  <select name="lststs" id="lststs">
                    <option value="a"<?php if($rowsprodcat_mst['prodcatm_sts']=='a') echo 'selected';?>>Active</option>
                    <option value="i"<?php if($rowsprodcat_mst['prodcatm_sts']=='i') echo 'selected';?>>Inactive</option>
                    </select>					</td>
                <td ></td>
                </tr>
              <tr valign="middle" bgcolor="#FFFFFF">
                <td colspan="4" align="center" >
                  <input type="Submit" class="textfeild"  name="btneprodcatsbmt" id="btneprodcatsbmt" value="Submit">
                  &nbsp;&nbsp;&nbsp;
                  <input type="reset" class="textfeild"  name="btnprodcatreset" value="Reset" id="btnprodcatreset">
                  &nbsp;&nbsp;&nbsp;
                  <input type="button"  name="btnBack" value="Back" class="textfeild" 
					  onclick="location.href='view_detail_product_category.php?vw=<?php echo $id;?>&pg=<?php echo $pg."&countstart=".$cntstart.$loc;?>'">						</td>
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