<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_paging_functions_dist.php';//Making paging validation
	include_once '../includes/inc_folder_path.php'; 
	include_once '../includes/inc_config.php'; 
	/***************************************************************/
	//Programm 	  : vw_all_products.php	
	//Company 	  : Adroit
	/**************************************/
	global $gmsg,$loc,$rowsprpg,$dispmsg,$disppg;
	
	if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval']) != "")){
		    //alert('Inside hiddensts'); 
			   
			$dchkval = substr($_POST['hdnchksts'],1);
			
			$id  = glb_func_chkvl($dchkval);
			$chkallval	= glb_func_chkvl($_POST['hdnallval']);		
			$updtsts = funcUpdtAllRecSts($conn,'prod_mst','prodm_id',$id,'prodm_sts',$chkallval);		
			if($updtsts == 'y'){
				$gmsg = "<font color='#fda33a'>Record updated successfully</font>";
			}
			elseif($updtsts == 'n'){
				$gmsg = "<font color='#fda33a'>Record not updated</font>";
			}
	  }	
	if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval'])){
		    $dchkval    =  substr($_POST['hdnchkval'],1);
			$did 	    =  glb_func_chkvl($dchkval);
			$del        =  explode(',',$did);
			$count      =  sizeof($del);
			$simg       =  array();
			$simgpth    =  array();
			$bimg       =  array();
			$bimgpth    =  array();
			for($i=0;$i<$count;$i++){	
				$sqryprod_mst="SELECT 
							  prodimgd_simg,prodimgd_bimg,
								from 
								 prodimg_dtl
								where
								   prodimgd_prodm_id=$del[$i]"; 			
				$srsprod_mst=mysqli_query($conn,$sqryprod_mst);
				while($srowprod_mst=mysqli_fetch_assoc($srsprod_mst)){		     			   				
					 $simg[$i]    = glb_func_chkvl($srowprod_mst['prodimgd_simg']);
					 $bimg[$i]    = glb_func_chkvl($srowprod_mst['prodimgd_bimg']);			
					 $simgpth[$i] = $gsml_fldnm.$simg[$i];
					 $bimgpth[$i] = $gbg_fldnm.$bimg[$i];					
					 if(($simg[$i] != "") && file_exists($simgpth[$i])){
						unlink($simgpth[$i]);
					 }
					 if(($bimg[$i] != "") && file_exists($bimgpth[$i])){
						unlink($bimgpth[$i]);
					 }
				 }
			}
			//$delsts1 = funcDelAllRec('prodimg_dtl','prodimgd_prodm_id',$did);	
			//$delsts3 = funcDelAllRec('prodprc_dtl','prodprcd_prodm_id',$did);
			//$delsts2 = funcDelAllRec('invntry_dtl','invntryd_prodm_id',$did);
			$delsts = funcDelAllRec($conn,'prod_mst','prodm_id',$did);	
			// echo"here";		
			if($delsts == 'y' && $delsts1 == 'y'){
			     $msg   = "<font color=#fda33a>Record deleted successfully</font>";
			}
			elseif($delsts == 'n'){
				$msg  = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
			}
    	}		
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != 'Y')){
		$sts = glb_func_chkvl($_REQUEST['sts']);
		if($sts =='y'){
			$gmsg = "<font color='#fda33a'>Record updated successfully</font>";
		}
	    elseif($sts =='d'){
			$gmsg = "<font color='#fda33a'>Duplicate Record. Record not saved</font>";
		}
	    elseif($sts =='n'){
			$gmsg = "<font color='#fda33a'>Record not saved</font>";
		}
	}	
    $rowsprpg  = 20;//maximum rows per page
	include_once "../includes/inc_paging1.php";//Includes pagination	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="style_admin.css" rel="stylesheet" type="text/css">
		<link href="yav-style.css" type="text/css" rel="stylesheet">
		<title>...::  <?php echo $pgtl; ?> ::...</title>
		<?php /*?><style type="text/css">
  		  <!--
	  	body {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
		}
		    -->
		</style><?php */?>
	<?php include_once ('script.php');?>
	<title>...::  <?php echo $pgtl; ?> ::...</title>
	<script language="javascript">
	function addprod(){//for adding new products
		document.frmvwprods.action="add_product.php";
		document.frmvwprods.submit()
	}
	function validate(){ 
		var urlval 		= "";
		var txtsrchcd	= document.frmvwprods.txtsrchcd.value;	
		var txtsrchnm 	= document.frmvwprods.txtsrchnm.value		
		var lsttyp 		= document.frmvwprods.lsttyp.value;    
		var lstcat 		= document.frmvwprods.lstcat.value;    
		//var lstscat 	= document.frmvwprods.lstscat.value; 
		var lstprdsts 	= document.frmvwprods.lstprdsts.value;
		if((txtsrchcd=="") && (txtsrchnm=="") && (lsttyp=="") && (lstcat=="") && (lstprdsts=="")){
			alert("Select Search Criteria");
			document.frmvwprods.txtsrchcd.focus();
			return false;
		}
		if(txtsrchcd !=''){
			urlval +="&txtsrchcd="+txtsrchcd;
		}
		if(txtsrchnm !=''){
			urlval +="&txtsrchnm="+txtsrchnm;
		}
		if(lstcat !=''){
			urlval +="&lstcat="+lstcat;
		}		
		if(lsttyp !=''){
			urlval +="&lsttyp="+lsttyp;
		}
		//if(lstscat !=''){
			//urlval +="&lstscat="+lstscat;
		//}
		if(lstprdsts !=''){
			urlval +="&lstprdsts="+lstprdsts;
		}		
		if(document.frmvwprods.chkexact.checked==true){
			document.frmvwprods.action="vw_all_products.php?"+urlval+"&chk=y";
			document.frmvwprods.submit();
		}
		else{ 
			document.frmvwprods.action="vw_all_products.php?"+urlval;
			document.frmvwprods.submit();
		}
		return true;
	}
	
	function open_win(prod_id,stktyp){ 
		//document.getElementById("divordflw").style.display = 'block';
		lnkname = "add_stock.php?prod_id_val="+prod_id+"&stktyp="+stktyp; 
		window.open(lnkname,'welcome','width=800,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');
	}
	function numOnly(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 &&(charCode < 48 || charCode > 57))
		return false;		
		return true;
	}
	function funcstkAdd(prodid,szid,totqtyval){
		var qtyval = document.getElementById('txtqtyval'+szid+prodid).value;
		//var totqtyval = totqtyval;
		var hdnqtyval = document.getElementById('hdnqtyval').value;
		if((qtyval < 0)){
			var arytxtval =qtyval.split('-'); 
			if(hdnqtyval !=''){
				tot_qtyval =(hdnqtyval-arytxtval[1]);
			}else{
				tot_qtyval =(totqtyval-arytxtval[1]);
			}
			if(tot_qtyval < 0){
				alert("Please Enter Valid Quantity");
				return false;
			}
		}
		if(szid ==''){
			alert('Please Enter Sizes');
			return false;
		}
		
		if(qtyval ==''){
			alert('Please Enter Quantity');
			document.getElementById('txtqtyval'+szid+prodid).focus();
			return false;
		}
		var url = "add_qty.php?stkqty="+qtyval+"&szprcid="+szid+"&totqtyval="+totqtyval+"&prodidval="+prodid;
		xmlHttp	= GetXmlHttpObject(stateChangedStkAdd);
		xmlHttp.open("GET", url , true);
		xmlHttp.send(null);
		
		
	}
	function stateChangedStkAdd(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			var crtval = new Array();
			crtval = temp.split('<->');
			var addprd  		= crtval[0];
			var addsts  		= crtval[1];
			var dispval 		= crtval[2];
			if(dispval!=''){
				document.getElementById('divstkqty'+addsts+addprd).innerHTML=dispval;
				document.getElementById('txtqtyval'+addsts+addprd).value="";
				document.getElementById('hdnqtyval').value=dispval;
			}	
		}
	}	
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script></head>
<body onLoad="onload()">
<?php 
include_once ('../includes/inc_fnct_ajax_validation.php');	
 include_once ('../includes/inc_adm_header.php');
 include_once ('../includes/inc_adm_leftlinks.php'); 
?>
	 <table width="1000px" border="0" align="center" cellpadding="3" cellspacing="1" >
       <tr>
        <td height="400" valign="top">
		 <table  width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#fff"> 
             <form name="frmvwprods" id="frmvwprods" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return validate()">
			  <input type="hidden" name="hdnchkval" id="hdnchkval">
			  <input type="hidden" name="hdnallval" id="hdnallval">
			  <input type="hidden" name="hdnchksts" id="hdnchksts">
			  <input type="hidden" name="hdnqtyval" id="hdnqtyval">
                <tr align="left" class='white'>
                  <td height="30" colspan="12" bgcolor="#FF543A">
				 <span class="heading"><strong>:: Products </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr valign="top">
				 <td colspan="12" bgcolor="#fff">
				 	<table border="0" width="100%" height="100%" align="center" cellpadding="3" valign="top" cellspacing="3" >
						<tr align="right" bgcolor="#f0f0f0">
						  <td colspan="7"  align="left" bgcolor=""><strong>Search By</strong></td>
						</tr>						
						<tr bgcolor="#f0f0f0">
							<td width='7%' align='left'><strong>Code</strong></td>
							<td width='14%' align='left'><input type="text" name="txtsrchcd" id="txtsrchcd" style="width:130px" value="<?php if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!="")){echo $_REQUEST['txtsrchcd'];}else{echo "";}?>">	
							</td>
							<td width='12%' align='left'><strong>Brand</strong></td>
							<td width='18%' align='left'>
							   <select name="lstcat" id="lstcat" style="width:153px">
								 <option value="">--Select--</option>
								 <?php
								 $sqrycat_mst = "select 
														brndm_id,brndm_name
													from  
														vw_prod_mst
													 where
														brndm_sts='a'
														group by brndm_id
														order by brndm_name";
								 $stscat_mst = mysqli_query($conn,$sqrycat_mst);
								 while($rowscat_mst=mysqli_fetch_assoc($stscat_mst))
								 {
								 ?>
								 <option value="<?php echo $rowscat_mst['brndm_id'];?>"<?php if(isset($_REQUEST['lstcat']) && $_REQUEST['lstcat']==$rowscat_mst['brndm_id']){echo 'selected';}?>><?php echo $rowscat_mst['brndm_name'];?></option>
								 <?php
								 }
								 ?>
							 </select>
							</td>															
							<td width='7%' align='left'><strong>Type</strong></td>
							<td width='15%' align='left'>
								<select name="lsttyp" id="lsttyp" style="width:158px"> 
									<option value="">--Select--</option>
									<option value="1"<?php if(isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp']=="1"){echo 'selected';}?>>General</option>
									<option value="2"<?php if(isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp']=="2"){echo 'selected';}?>>New Arrival</option>
									<option value="3"<?php if(isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp']=="3"){echo 'selected';}?>>Best Sellers</option>
									<!--<option value="4"<?php if(isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp']=="4"){echo 'selected';}?>>New Arrival & Best Sellers</option>
									<option value="5"<?php if(isset($_REQUEST['lsttyp']) && $_REQUEST['lsttyp']=="5"){echo 'selected';}?>>All</option>-->
                          </select>
							</td>
							<td width="27%" align="left">
						<strong>Exact</strong>
							<input type="checkbox" name="chkexact" value="1"<?php if(isset($_POST['chkexact']) && (trim($_POST['chkexact'])==1)){ echo 'checked';}elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){echo 'checked';}?>>
						<input name="button" type="button" class="textfeild" onClick="validate()" value="Search">
                        	<a href="vw_all_products.php" class="leftlinks"><strong>Refresh</strong></a>						                        </td>						
			  </tr>
						<tr bgcolor="#f0f0f0">						
						<td width='7%' height="30" align='left'><strong>Name</strong></td>
						<td width='14%' align='left'><input type="text" name="txtsrchnm" id="txtsrchnm" style="width:130px" value="<?php if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){echo $_REQUEST['txtsrchnm'];}else{echo "";}?>">						
						</td>
							<?php /*?><td width='12%' align='left'><strong>Subcategory</strong></td>
					        <td width='18%' align='left'>
							 <select name="lstscat" id="lstscat" style="width:153px">
							 <option value="">--Select--</option>
								 <?php
									 $sqryscat_mst="select 
														prodscatm_id,prodscatm_name
													 from 
														vw_prod_mst
													where 
														prodscatm_sts ='a'
														group by prodscatm_id
														order by prodscatm_name";
									 $stsscat_mst = mysqli_query($conn,$sqryscat_mst);
									 while($rowsscat_mst=mysqli_fetch_assoc($stsscat_mst))
									 {
									 ?>
									  <option value="<?php echo $rowsscat_mst['prodscatm_id'];?>"<?php if(isset($_REQUEST['lstscat']) && $_REQUEST['lstscat']==$rowsscat_mst['prodscatm_id']){echo 'selected';}?>><?php echo $rowsscat_mst['prodscatm_name'];?></option>
								<?php
									 }
								 ?>
							 </select>
						</td><?php */?>
						<td width='7%' align='left'><strong>Status</strong></td>
						<td width='15%' align='left'>
							 <select name="lstprdsts" id="lstprdsts" style="width:100px">
								<option value="">--Select--</option>
								<option value="a"<?php if(isset($_REQUEST['lstprdsts']) && $_REQUEST['lstprdsts']=="a"){echo 'selected';}?>>Active</option>
								<option value="i"<?php if(isset($_REQUEST['lstprdsts']) && $_REQUEST['lstprdsts']=="i"){echo 'selected';}?>>Inactive</option>					
						 </select>
						</td>
							<td colspan="3" align="right" width="27%">
					<input name="Button" type="button" class="" value="&laquo; Add" 
						onClick="javascript:addprod()">				  
				 		</td>
						</tr>
				   </table>
				  </td></tr>				
			  	<tr align="right" bgcolor="#f0f0f0">
                 <td colspan="6">&nbsp;</td>
				 <td width="6%" align="center" valign="bottom"><input name="btnsts2" id="btnsts2" type="button"  value="Status" 
				  	onClick="updatests('hdnchksts','frmvwprods','chksts')" class=""></td>
			     <td width="6%" align="center" valign="bottom">		      
		  	 	  <input name="btndel" id="btndel" type="button"  value="Delete" 
					 onClick="deleteall('hdnchkval','frmvwprods','chkdlt');" class="" >			  
					 	 </td>
              	</tr>	
				<?php
				if($gmsg != ""){
					$dispmsg = "<tr bgcolor='#f0f0f0'><td colspan='10' align='center'>$gmsg</td></tr>";
					echo $dispmsg;				
				}	
				?>		  
                <tr class="white">
                  	<td width="5%" align="left" title="Serial Number" bgcolor="#FF543A"><strong>SL. No</strong></td>
				    <td width="25%" align="left" bgcolor="#FF543A"><strong>Code / Name</strong></td>		
						<td width="25%" align="left" bgcolor="#FF543A"><strong>Vehicle Type</strong></td>	
				    <td width="20%" align="left" bgcolor="#FF543A"><strong>Brand</strong></td>
					<td width="8%" align="left" title="New Arrival" bgcolor="#FF543A"><strong>Type</strong></td>	
					<td width="3%" align="center" bgcolor="#FF543A"><strong>Rank</strong></td>			   				   
                   	<td width="6%"  align="center" bgcolor="#FF543A"><input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes" onClick="Check(document.frmvwprods.chksts,'Check_ctr','hdnallval')"></td>
                <td width="6%"  align="center" bgcolor="#FF543A"><input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmvwprods.chkdlt,'Check_dctr')"></td>
                </tr>
                <?php
				//prodprcd_id,prodprcd_prc,prodprcd_ofrprc,
			/*	$sqryprod_mst1  =  "select 
										 prodm_id,prodm_code,prodm_name,brndm_name,
										 prodscatm_name,prodm_mrp,prodm_op,prodm_typ,
										 prodm_sts,prodm_prty,brndm_id,prodscatm_id
									from  
									     vw_prod_mst
										 left join prodprc_dtl on prodm_id = prodprcd_prodm_id
										 left join size_mst on sizem_id = prodprcd_sizem_id
										 left join invntry_dtl on invntryd_sizem_id = sizem_id
									where 
									     prodm_sts != ''";		*/
					$sqryprod_mst1  =  "select 
										 prodm_id,prodm_code,prodm_name,brndm_name,
										 prodm_mrp,prodm_op,prodm_typ,prodm_sts,
										 prodm_prty,brndm_id,vehtypm_name,prodm_vehtypm_id
									from  
									     vw_prod_mst
									where 
									     prodm_sts != ''";	
			    if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!="")){
				  $txtsrchcd = glb_func_chkvl($_REQUEST['txtsrchcd']);	
				  $loc .= "&txtsrchcd=".$txtsrchcd;
				  if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$sqryprod_mst1.=" and prodm_code='$txtsrchcd'";
					}
					else{
						$sqryprod_mst1.=" and prodm_code like '%$txtsrchcd%'";
					}		
				}
				if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){
					  $txtsrchnm = glb_func_chkvl($_REQUEST['txtsrchnm']);	
					  $loc .= "&txtsrchnm=".$txtsrchnm;
					  if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
							$sqryprod_mst1.=" and prodm_name ='$txtsrchnm'";
					  }
					  else{
							$sqryprod_mst1.=" and prodm_name like '%$txtsrchnm%'";
					  }		
				}
				if(isset($_REQUEST['lsttyp']) && trim($_REQUEST['lsttyp'])!=""){
					  $lsttyp = glb_func_chkvl($_REQUEST['lsttyp']);
					  $loc .= "&lsttyp=".$lsttyp;
					  $sqryprod_mst1.=" and prodm_typ = '$lsttyp'";				
				 }			
				if(isset($_REQUEST['lstcat']) && trim($_REQUEST['lstcat'])!=""){
					  $lstcat = glb_func_chkvl($_REQUEST['lstcat']);
					  $loc .= "&lstcat=".$lstcat;
					  $sqryprod_mst1.=" and brndm_id = '$lstcat'";				
				 }
				 if(isset($_REQUEST['lstscat']) && trim($_REQUEST['lstscat'])!=""){
					  $lstscat = glb_func_chkvl($_REQUEST['lstscat']);
					  $loc .= "&lstscat=".$lstscat;
					  $sqryprod_mst1.=" and prodscatm_id = '$lstscat'";				
				 }	
				 if(isset($_REQUEST['lstprdsts']) && trim($_REQUEST['lstprdsts'])!=""){
					  $lstprdsts = glb_func_chkvl($_REQUEST['lstprdsts']);
					  $loc .= "&lstprdsts=".$lstprdsts;
					  $sqryprod_mst1.=" and prodm_sts = '$lstprdsts'";				
				 }
				 if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$loc .= "&chk=y";
				 }			
				 $sqryprod_mst=$sqryprod_mst1." group by prodm_id order by brndm_name,prodm_name limit $offset,$rowsprpg";								   				 $srsprod_mst =  mysqli_query($conn,$sqryprod_mst);
				 $serchres    =  mysqli_num_rows($srsprod_mst);
					if($serchres == 0){
					   echo $gmsg = "<tr><td colspan='10' align='center' bgcolor='#f0f0f0' >
						<font color='#fda33a'><b>Record not found</b></font></td></tr>";
					}
					$cnt = $offset;
					while($srowprod_mst=mysqli_fetch_assoc($srsprod_mst)) {
						$cnt+=1;
						$prod_id 	= $srowprod_mst['prodm_id'];
						$prod_id  =$srowprod_mst['prodm_id'];
						
				 ?>
               <tr bgcolor="#f0f0f0">
				<td align="left" valign="top"><?php echo $cnt;?></td>
				<td align="left" valign="top" >
				<a href="vw_all_products_detail.php?vw=<?php echo $srowprod_mst['prodm_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $srowprod_mst['prodm_code'];?></a><br><?php echo $srowprod_mst['prodm_name'];?></td>	
				<td align="left" valign="top"><?php echo $srowprod_mst['vehtypm_name'];?></td>	
				<td align="left" valign="top"><?php echo $srowprod_mst['brndm_name'];?></td>	
				<?php /*?><td align="left" colspan='2' valign="top">
				<table border="0" width="100%" height="100%" align="center" cellpadding="3" valign="top" cellspacing="3">
					<?php
					 $sqrymbr_mst = "select 
							prodprcd_prc,prodprcd_ofrprc,sizem_name
						 from 
							 vw_prod_size_dtl 
						  where 
							 prodprcd_sts='a'  and
							 prodm_id = '$prod_id'
						  group by sizem_id order by sizem_name";
						  $srsmbr_mst  = mysqli_query($conn,$sqrymbr_mst);
						  $reccnt		 = mysqli_num_rows($srsmbr_mst);
						  if($reccnt > 0){
							 while($srowsprodprc_dtl = mysqli_fetch_assoc($srsmbr_mst)){
								$prc 		= $srowsprodprc_dtl['prodprcd_prc'];
								$ofrprc 	= $srowsprodprc_dtl['prodprcd_ofrprc'];
								$prodsz_id 	= $srowsprodprc_dtl['sizem_id'];
								//$prodprc_id 	= $srowsprodprc_dtl['prodprcd_id'];
								if(($ofrprc > 0) && ($prc > $ofrprc)){
									$prc_dsply = "<strike>$prc</strike><br>$ofrprc";
								}
								else{
									$prc_dsply = "$prc";
								}	
							
					
					?>
					<tr>
					<td width='23%' align="left" valign="top"><?php echo $prc_dsply;?></td>
					<td width='23%' align="left" valign="top"><?php echo $srowsprodprc_dtl['sizem_name'];?></td>
				</tr>
				<tr>
				<?php
					}
				}
				?>
				</table>
				</td><?php */?>	
					<td align="left" valign="top"><?php echo funcDsplyTyp($srowprod_mst['prodm_typ'])?></td>
					<td align="right" valign="top"><?php echo $srowprod_mst['prodm_prty'];?></td>			
					 <td align="center" valign="top">
				  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo  $srowprod_mst['prodm_id'];?>" <?php if( $srowprod_mst['prodm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo  $srowprod_mst['prodm_id'];?>,'hdnchksts','frmvwprods','chksts');"></td>				
					<td align="center" valign="top">
				  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo  $srowprod_mst['prodm_id'];?>"></td>
			  </tr>
			  <?php
			  	}
				?>			 
			   <tr align="right" bgcolor="#f0f0f0">
				  <td  colspan="6">&nbsp;</td>
				  <td width="6%" align="center" valign="bottom">
					<input name="btnsts" id="btnsts" type="button"  value="Status" 
					onClick="updatests('hdnchksts','frmvwprods','chksts','hdnallval')" class="">
				  </td>
				  <td width="6%" align="center" valign="bottom"  >
			 		<input name="btndel" id="btndel" type="button"  value="Delete" 
					 onClick="deleteall('hdnchkval','frmvwprods','chkdlt');" class="" >
				  </td>
			  </tr>			
			<?php						
				//$disppg = funcDispPag('paging',$loc,$sqryprod_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
				$disppg = funcDispPag($conn,'paging',$loc,$sqryprod_mst1,$rowsprpg,$cntstart,$pgnum,'y','prodm_id');	
				if($disppg != ""){	
					$disppg = "<br><tr  bgcolor='#f0f0f0'><td colspan='12' align='center'>$disppg</td></tr>";
					echo $disppg;
				}			
			  ?>			   
              </form>
			  </table>	
			</td>			
          </tr >
         </table>
	   	<?php include_once ('../includes/inc_adm_footer.php');?>
</body>
</html>