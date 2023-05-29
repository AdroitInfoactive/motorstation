<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more
	include_once '../includes/inc_folder_path.php'; 	
	include_once '../includes/inc_config.php'; 			
	/***************************************************************/
	//Programm 	  : view_all_products_detail.php
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$cntst,$optn,$val,$fldnm,$gmsg;
	
	if(isset($_REQUEST['vw']) && trim($_REQUEST['vw'])!=""
	&& isset($_REQUEST['pg']) && trim($_REQUEST['pg'])!=""
	&& isset($_REQUEST['countstart']) && trim($_REQUEST['countstart'])!="")
	{
		$id    = glb_func_chkvl($_REQUEST['vw']);
		$pg    = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
	}
	elseif(isset($_REQUEST['hdnprodid']) && (trim($_REQUEST['hdnprodid'])!="") &&
	 	   isset($_REQUEST['hdnpage'])   && (trim($_REQUEST['hdnpage'])!="") &&
	 	   isset($_REQUEST['hdncnt'])    && (trim($_REQUEST['hdncnt'])!="")){
		   $id         = glb_func_chkvl($_REQUEST['hdnprodid']);
		   $pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		   $cntstart = glb_func_chkvl($_REQUEST['hdncnt']);
	}
	/*if(isset($_REQUEST['optn']) && trim($_REQUEST['optn'])!=""
	&& isset($_REQUEST['val']) && trim($_REQUEST['val'])!="")
	{
		$optn = glb_func_chkvl($_REQUEST['optn']);
		$val  = glb_func_chkvl($_REQUEST['val']);
		$chk  = glb_func_chkvl($_REQUEST['chk']);
	}
	elseif(isset($_POST['hdnoptn']) && trim($_POST['hdnoptn'])!=""
	&& isset($_POST['hdnval']) && trim($_POST['hdnval'])!="")
	{
		$optn = glb_func_chkvl($_POST['hdnoptn']);
		$val  = glb_func_chkvl($_POST['hdnval']);
		$chk  = glb_func_chkvl($_REQUEST['hdnchk']);

	}*/
     $sqryprod_mst= "select 
						prodm_id,prodm_code,prodm_name,prodm_descone,
						prodm_desctwo,prodm_mrp,prodm_op,prodm_prty,
						prodm_sts,brndm_name,prodm_typ,prodm_seotitle,
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
	if(isset($_REQUEST['sts']) && trim($_REQUEST['sts'])=='d'){
		$gmsg="<font color=#fda33a>Duplicate Record(Record Not Updated)</font>";
	}
	elseif(isset($_REQUEST['sts']) && trim($_REQUEST['sts'])=='n'){
		$gmsg="<font color=#fda33a>Record Not Updated(Try Again)</font>";
	}
	elseif(isset($_REQUEST['sts']) && trim($_REQUEST['sts'])=='y'){
		$gmsg="<font color=#fda33a>Record Updated Successfully</font>";
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
	$chk  		=  glb_func_chkvl($_REQUEST['chk']); 
	if($chk!= ""){
		$loc .= "&chk=$chk";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="style_admin.css" rel="stylesheet" type="text/css">
		<title><?php echo $pgtl;?></title>
		<script language="javascript">
		function update(){
			document.frmproddtl.action="edit_products.php?<?php echo $loc;?>";
			document.frmproddtl.submit();
		}
	
	
/*	function open_win(pid){
	if(pid != ""){
		var url = "getproduct_details.php?pid="+pid;
		xmlHttp	= GetXmlHttpObject(funccatonestatChanged);
		xmlHttp.open("GET", url , true);
		xmlHttp.send(null); 
	}
	
} 
function funccatonestatChanged(){
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
		var temp=xmlHttp.responseText;
		var tmpval = document.getElementById('divprod').innerHTML=temp					
		if(tmpval!=0){
				$(function() {
				$( "#divprod" ).dialog({width: 800,
				modal: true,
				title: "Product Details",
				//close: function( event, ui ) {window.location.reload()},
				zIndex: 9999});
			});	
		}
	}
}*/


</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> 
<link rel="stylesheet" href="../ui-lightness/jquery-ui-1.10.3.custom.css">
<link href="docstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
	include_once ('../includes/inc_fnct_ajax_validation.php');	
	 include_once ('../includes/inc_adm_header.php');
	 include_once ('../includes/inc_adm_leftlinks.php'); 
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr valign="top"> 
	<td height="400" valign="top"><br>
	    <form name="frmproddtl" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" method="post">
		  <input type="hidden" name="hdnprodid" id="hdnprodid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage"  id="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" id="hdncnt" value="<?php echo $cntstart;?>">
		  <input type="hidden" name="hdnloc" id="hdnloc" value="<?php echo $loc;?>">
			<table width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#fff">
				<tr class='white'>
		   	<td height="26" colspan="3" bgcolor="#FF543A">
				<span class="heading"><strong>::Product Detail</strong> </span></td>
	      </tr>
		   <tr bgcolor="#f0f0f0">
		   	<td colspan="3" align="center">&nbsp;
				<strong><font color="#fda33a">
				<?php
					if(isset($gmsg) && $gmsg!=""){
						echo $gmsg;
					}
				  ?>
				  </font></strong>
			</td>
	      </tr>
				<tr bgcolor="#f0f0f0"> 
            <td width="25%" align="left" valign="middle" >Vehicle Type</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['vehtypm_name'];?></td>
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="25%" align="left" valign="middle" >Brand</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['brndm_name'];?></td>
		 </tr>
		
          <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle" >Code</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_code'];?></td>
		 </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle" >Name</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_name'];?></td>
		 </tr>
         <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="3">Admin Description :</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="3" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_descone'];?></td>
		 </tr>
          <tr bgcolor="#f0f0f0"> 
            <td width="24%" align="left" valign="top" colspan="3">Product Description :</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td colspan="3" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_desctwo'];?></td>
		 </tr> 		 
		  <?php /*?> <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle"> Price</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle">
				<?php echo number_format($srowsprod_mst['prodm_mrp'],'2','.',',');?>
			</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle">Offer Price</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle">
				<?php echo number_format($srowsprod_mst['prodm_op'],'2','.',',');?>
			</td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle"> Weight (Gms)</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle">
				<?php echo $srowsprod_mst['prodm_wt'];?>
			</td>
		 </tr><?php */?>
        <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle">Type</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo funcDsplyTyp($srowsprod_mst['prodm_typ']);?></td>
		</tr>
		<tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle">SEO Title</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seotitle'];?></td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle">SEO Description</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seodesc'];?></td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="middle">SEO Keyword</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seokywrd'];?></td>
		 </tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H1-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seohonetitle'];?></td>
		</tr>
		 <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H1-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seohonedesc'];?>	
			</td>
		  </tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H2-Title</td>
			<td width="2%" align="center" valign="top">:</td>
            <td align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seohtwotitle'];?></td>
		</tr>
		  <tr bgcolor="#f0f0f0"> 
            <td width="16%" align="left" valign="top">SEO H2-Description</td>
			<td width="2%" align="center" valign="top">:</td>
            <td align="left" valign="middle"><?php echo $srowsprod_mst['prodm_seohtwodesc'];?></td>
		  </tr>
		<tr bgcolor="#f0f0f0">
		  	<td width="16%" align="left">Rank</td>
			<td width="2%">:</td>
			<td width="82%"><?php echo $srowsprod_mst['prodm_prty'];?></td>
		</tr>
		<tr bgcolor="#f0f0f0">
		  	<td width="16%" align="left" valign="middle">Status</td>
			<td width="2%">:</td>
            <td width="82%" align="left" valign="middle"><?php echo funcDispSts($srowsprod_mst['prodm_sts']);?></td>
		</tr>
		
		<?php /*?><tr bgcolor="#FFFFFF">
				<td colspan="4">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
				<tr>
                <td width="10%"  bgcolor="#F3F3F3">
				<strong>SL.No.</strong></td>
				<td width="30%" bgcolor="#F3F3F3"><strong>Size</strong></td>
				<td width="30%"  bgcolor="#F3F3F3"><strong>Price</strong></td>
				<td width="30%"  bgcolor="#F3F3F3"><strong>Offer Price</strong></td>
			  </tr>
			  <?php
				$sqryprc_dtl="select 
								prodprcd_id,prodprcd_prc,prodprcd_ofrprc,sizem_name
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
			  	if($cntprc_dtl > 0){
					while($rowprodprc_dtl=mysqli_fetch_assoc($srsprc_dtl)){
						
						$cnt+=1;
						$clrnm = "";
						if($cnt%2==0){
							$clrnm = "bgcolor='#F3F3F3'";
						}
						else{
							$clrnm = "bgcolor='#F3F3F3'";
						}
				  ?>
				   <tr>
					<td bgcolor="#F3F3F3">
				
					
					
					<?php echo $cnt; ?></td>				
					<td bgcolor="#F3F3F3"><?php echo $rowprodprc_dtl['sizem_name']; ?></td>				
					<td bgcolor="#F3F3F3"><?php echo $rowprodprc_dtl['prodprcd_prc']; ?></td>
					<td bgcolor="#F3F3F3"><?php echo $rowprodprc_dtl['prodprcd_ofrprc']; ?></td>
				  </tr>
				  <?php
					}
				}
			  ?>
			  </table>
				</td>
					
				</tr><?php */?>
		
		<tr bgcolor="#f0f0f0">
		  <td colspan="3">
				<table width="95%" border="0" cellspacing="1" cellpadding="3">
				<tr>
                <td width="5%"><strong>SL.No.</strong></td>
                <td width="20%"><strong>Name</strong></td>
				<td width="20%"><strong>Link</strong></td>
				<td width="20%" align='center'><strong>Small Image</strong></td>
				<td width="20%" align='center'><strong>Big Image</strong></td>
				<td width="5%"><strong>Rank</strong></td>
				<td width="10%"><strong>Status</strong></td>
			  </tr>
			<?php
			   $sqryimg_dtl="select 
								  prodimgd_title,prodimgd_simg,prodimgd_bimg,prodimgd_prty ,
								  if(prodimgd_sts = 'a', 'Active','Inactive') as prodimgd_sts,
								  prodimgd_lnk
							 from 
								  prodimg_dtl
							 where 
								 prodimgd_sts='a'  and
								 prodimgd_prodm_id  ='$id' 
							 order by 
								 prodimgd_id";
	               $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);		
		           $cntprodimg_dtl  = mysqli_num_rows($srsimg_dtl);
			  	$cnt = $offset;
				if($cntprodimg_dtl> 0 ){				
			  	while($rowprodimg_dtl= mysqli_fetch_assoc($srsimg_dtl)){	
					$prdimg_ttl 	 = $rowprodimg_dtl['prodimgd_title'];
					$prdimgaryttl    = explode("-",$prdimg_ttl);				
					$cnt+=1;
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#E7F3F7'";
					}
					else{
						$clrnm = "bgcolor='#E7F3F7'";
					}
			  ?>
               <tr>
                <td><?php echo $cnt; ?></td>				
				<td><?php echo  $prdimgaryttl[1];?></td>
				<td><?php echo  $rowprodimg_dtl['prodimgd_lnk'];;?></td>
                <td   align='center'>
				<?php
					$imgnm   = $rowprodimg_dtl['prodimgd_simg'];
					$imgpath = $gsml_fldnm.$imgnm;					
				  if(($imgnm !="") && file_exists($imgpath)){
					 echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
				  }
				  else{
					 echo "Image not available";
				  }
				?>
				<td   align='center'>
				<?php
					$bgimgnm   = $rowprodimg_dtl['prodimgd_bimg'];
					$bgimgpath = $gbg_fldnm.$bgimgnm;					
				  if(($bgimgnm !="") && file_exists($bgimgpath)){
					 echo "<img src='$bgimgpath' width='80pixel' height='80pixel'>";
				  }
				  else{
					 echo "Image not available";
				  }
				?>
				</td>
				<td  ><?php echo $rowprodimg_dtl['prodimgd_prty']; ?></td>				
				<td  ><?php echo $rowprodimg_dtl['prodimgd_sts'];					
				?>
				</td>
			  </tr>
			  <?php
			  	}
			}
			else{
				echo "<tr bgcolor='#f0f0f0'>
							<td colspan='6' align='center'>Image not available</td>
						</tr>";
			}
			  ?>
			  </table>
		  </td>		
		</tr>
        <tr bgcolor="#f0f0f0"> 
            <td colspan="3"  align="right" valign="middle">&nbsp;</td>
        </tr>
        <tr valign="middle" bgcolor="#f0f0f0">
            <td colspan="3" align="center">
				
				<input type="Submit" class=""  name="btnadprodsbmt" value="Edit" onClick="update();">
				&nbsp;&nbsp;&nbsp;
         	<input type="button"  name="btnBack" value="Back" class="" onclick="location.href='vw_all_products.php?pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>'">			           
       </td>   
		  </tr>  
          </table>
      </form>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 

include "../includes/inc_adm_footer.php";?>
</body>
</html>