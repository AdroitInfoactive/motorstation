<?php
      include_once '../includes/inc_nocache.php'; // Clearing the cache information
	  include_once "../includes/inc_adm_session.php";//checking for session
	  include_once "../includes/inc_connection.php";//Making database Connection
	  include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	  include_once '../includes/inc_paging_functions.php';//Making paging validation
	  include_once '../includes/inc_config.php'; 
	  /***************************************************************/
	  //Programe 	  : view_all_city.php
	  //Company 	  : Adroit
	  /***************************************************************/
	
		if(($_POST['hidchksts']!="") && isset($_REQUEST['hidchksts'])){
			$dchkval = substr($_POST['hidchksts'],1);
			$id  	 = glb_func_chkvl($dchkval);		
			$updtsts = funcUpdtAllRecSts('pncd_mst','fdbckm_id',$id,'pncdm_sts');		
			if($updtsts == 'y'){
				$msg = "<font color='#fda33a'>Record updated successfully</font>";
			}
			elseif($updtsts == 'n'){
				$msg = "<font color='#fda33a'>Record not updated</font>";
			}
		}
		if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval'])){
			$dchkval = substr($_POST['hidchkval'],1);
			$did 	= glb_func_chkvl($dchkval);			
			$delsts = funcDelAllRec('fdbck_mst','fdbckm_id',$did);	
			if($delsts == 'y'){
				$msg = "<font color='#fda33a'>Record deleted successfully</font>";
			}
			elseif($delsts == 'n'){
				$msg = "<font color='#fda33a'>Record can't be deleted(child records exist)</font>";
			}
		}
		if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
				$msg = "<font color='#fda33a'>Record updated successfully</font>";
		}
		elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
				$msg = "<font color='#fda33a'>Record not updated</font>";
		}
		elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
				$msg = "<font color='#fda33a'>Duplicate Record Exists & Record Not updated</font>";
		}
   		$rowsprpg  = 20;//maximum rows per page
		include_once '../includes/inc_paging1.php';//Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $pgtl;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="style_admin.css" rel="stylesheet" type="text/css">
	<script language="javascript">
		function addnew(){
			document.getElementById('frmtsk').action="add_pincode.php";
			document.getElementById('frmtsk').submit();
		}
	function exprt(){ 
		var urlval 		= ""; 
		var txtsrchcd	= document.frmtsk.txtsrchcd.value;		
		//var txtsrchnm 	= document.frmtsk.txtsrchnm.value;		
		var lstsrchcnty 		= document.frmtsk.lstsrchcnty.value;  
		var lstsrchcntry 		= document.frmtsk.lstsrchcntry.value; 
		var lstsrchcty 	= document.frmtsk.lstsrchcty.value; 
		var lstprdsts 	= document.frmtsk.lstprdsts.value;
		if((txtsrchcd=="")  && (lstsrchcnty=="") && (lstsrchcntry=="") && (lstsrchcty=="") && (lstprdsts=="")){ 
			document.frmtsk.action="export_pincodes.php";
			document.frmtsk.submit();
		}else{
			if(txtsrchcd !=''){
				urlval +="&txtsrchcd="+txtsrchcd;
			}
			//if(txtsrchnm !=''){
				//urlval +="&txtsrchnm="+txtsrchnm;
			//}
			if(lstsrchcntry !=''){
				urlval +="&lstsrchcntry="+lstsrchcntry;
			}		
			if(lstsrchcnty !=''){
				urlval +="&lstsrchcnty="+lstsrchcnty;
			}
			if(lstsrchcty !=''){
				urlval +="&lstsrchcty="+lstsrchcty;
			}
			if(lstprdsts !=''){
				urlval +="&lstprdsts="+lstprdsts;
			}		
			if(document.frmtsk.chkexact.checked==true){
				document.frmtsk.action="export_pincodes.php?"+urlval+"&chk=y";
				document.frmtsk.submit();
			}
			else{ 
				document.frmtsk.action="export_pincodes.php?"+urlval;
				document.frmtsk.submit();
			}
		}
		
		/*var optn=document.frmsrch.lstsrchby.value;
		if(optn !=''){
			if(optn == 'p'){
				var val = document.frmsrch.txtsrchval.value;
				if(document.frmsrch.chkexact.checked==true){
					document.frmsrch.action="export_pincodes.php?optn=p&val="+val+"&chk=y";
					document.frmsrch.submit();
				}
				else{
					document.frmsrch.action="export_pincodes.php?optn=p&val="+val;
					document.frmsrch.submit();
				}
			}		
			else if(optn == 'c'){
					var val = document.frmsrch.lstcnty.value;
					document.frmsrch.action="export_pincodes.php?optn=c&val="+val;
					document.frmsrch.submit();
			}
			else if(optn == 't'){
					var val = document.frmsrch.lstcty.value;
					document.frmsrch.action="export_pincodes.php?optn=t&val="+val;
					document.frmsrch.submit();
			}
			else if(optn == 'y'){
					var val = document.frmsrch.lstcntry.value;
					document.frmsrch.action="export_pincodes.php?optn=y&val="+val;
					document.frmsrch.submit();
			}
		}else{
			document.frmsrch.action="export_pincodes.php";
			document.frmsrch.submit();
		}*/
	}
	function validate(){ 
		var urlval 		= ""; 
		var txtsrchcd	= document.frmtsk.txtsrchcd.value;		
		var	txtsrchnm	= document.frmtsk.txtsrchnm.value;		
			
		/*var lstsrchcnty 		= document.frmtsk.lstsrchcnty.value;  
		var lstsrchcntry 		= document.frmtsk.lstsrchcntry.value; 
		var lstsrchcty 	= document.frmtsk.lstsrchcty.value; 
		var lstprdsts 	= document.frmtsk.lstprdsts.value;*/
		//if((txtsrchcd=="")  && (lstsrchcnty=="") && (lstsrchcntry=="") && (lstsrchcty=="") && (lstprdsts=="")){
		if((txtsrchcd=="")  && (txtsrchnm=="")){
			alert("Select Search Criteria");
			document.frmtsk.txtsrchcd.focus();
			return false;
		}
		if(txtsrchcd !=''){
			urlval +="&txtsrchcd="+txtsrchcd;
		}
		if(txtsrchnm !=''){
			urlval +="&txtsrchnm="+txtsrchnm;
		}
		
		/*
		if(lstsrchcntry !=''){
			urlval +="&lstsrchcntry="+lstsrchcntry;
		}		
		if(lstsrchcnty !=''){
			urlval +="&lstsrchcnty="+lstsrchcnty;
		}
		if(lstsrchcty !=''){
			urlval +="&lstsrchcty="+lstsrchcty;
		}
		if(lstprdsts !=''){
			urlval +="&lstprdsts="+lstprdsts;
		}	*/	
		if(document.frmtsk.chkexact.checked==true){
			document.frmtsk.action="vw_all_feedback.php?"+urlval+"&chk=y";
			document.frmtsk.submit();
		}
		else{ 
			document.frmtsk.action="vw_all_feedback.php?"+urlval;
			document.frmtsk.submit();
		}
		return true;
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
</script>
</head>
<body onLoad="onLoad();chng()">
<?php include_once ('../includes/inc_adm_header.php');?>
<?php include_once ('../includes/inc_adm_leftlinks.php'); ?>
<table width="1000px"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
		<table width="1000px"  border="0" cellspacing="5" cellpadding="1">
      <tr>
	  	<td height="400" valign="top">
			  <form method="POST" action="" name="frmtsk" id="frmtsk" bgcolor="#f0f0f0">
			<input type="hidden" name="hidchkval" id="hidchkval">
			<input type="hidden" name="hidchksts" id="hidchksts">	
			  <table  width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
				 <tr class='white'>
					<td height="26" colspan="4" bgcolor="#FF543A"><span class="heading"><strong>:: Product Enquiries</strong></span><br>
				   </td>
				</tr>
				<tr valign="top">
				 <td colspan="12" bgcolor="#fff">
				 	<table border="0" width="100%" height="100%" align="center" cellpadding="3" valign="top" cellspacing="3" >
						<tr bgcolor="#fff">
							<td width='5%' align='left'><strong>Email Id</strong></td>
							<td width='15%' align='left'><input type="text" name="txtsrchcd" id="txtsrchcd" style="width:130px" value="<?php if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!="")){echo $_REQUEST['txtsrchcd'];}else{echo "";}?>">	
							</td>
							<td width='5%' align='left'><strong>Name</strong></td>
							<td width='15%' align='left'><input type="text" name="txtsrchnm" id="txtsrchnm" style="width:130px" value="<?php if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){echo $_REQUEST['txtsrchnm'];}else{echo "";}?>">	
							</td>
							<?php /*?><td width='15%' align='left'><strong>Country</strong></td>
							<td width='10%' align='left'>
							   <select name="lstsrchcntry" id="lstsrchcntry" style="width:130px">
								  <option value="">--Select--</option>
							 <?php
							 $sqrycntry_mst="select 
												cntrym_id,cntrym_name
											 from 
												vw_pncd_all
											 where
												pncdm_sts != 'u'
											 group by 
												cntrym_id
											 order by 
												cntrym_name";
							 $stscntry_mst = mysqli_query($conn,$sqrycntry_mst);
							 while($rowscntry_mst=mysqli_fetch_assoc($stscntry_mst)) {
							 ?>
							 <option value="<?php echo $rowscntry_mst['cntrym_id'];?>"<?php if(isset($_REQUEST['lstsrchcntry']) && $_REQUEST['lstsrchcntry']==$rowscntry_mst['cntrym_id']){echo 'selected';}?>><?php echo $rowscntry_mst['cntrym_name'];?></option>
							 <?php
							 }
							 ?>
							 </select>
							</td>															
							<td width='10%' align='left'><strong>County</strong></td>
							<td width='15%' align='left'>
								<select name="lstsrchcnty" id="lstsrchcnty" style="width:130px"> 
									<option value="">--Select--</option>
							 <?php
							 $sqrypncd_mst="select 
												cntym_id,cntym_name
										   from 
												vw_pncd_all
										   where
												pncdm_sts != 'u'
										   group by 
												cntym_id
										   order by 
												cntym_name";
							 $stspncd_mst = mysqli_query($conn,$sqrypncd_mst);
							 while($rowspncd_mst=mysqli_fetch_assoc($stspncd_mst)){
							 ?>
							 <option value="<?php echo $rowspncd_mst['cntym_id'];?>"<?php if(isset($_REQUEST['lstsrchcnty']) && $_REQUEST['lstsrchcnty']==$rowspncd_mst['cntym_id']){echo 'selected';}?>><?php echo $rowspncd_mst['cntym_name'];?></option>
							 <?php
							 }
							 ?>
                          </select>
							</td>
												
			  </tr>
						<tr bgcolor="#f0f0f0">						
						<td align='left'><strong>City</strong></td>
					        <td align='left'>
							 <select name="lstsrchcty" id="lstsrchcty" style="width:130px">
							<option value="">--Select--</option>
							 <?php
							 $sqrypncd_mst="select 
												ctym_id,ctym_name
										   from 
												vw_pncd_all
										   where
												pncdm_sts != 'u'
										   group by 
												ctym_id
										   order by 
												ctym_name";
							 $stspncd_mst = mysqli_query($conn,$sqrypncd_mst);
							 while($rowspncd_mst=mysqli_fetch_assoc($stspncd_mst)){
							 ?>
							 <option value="<?php echo $rowspncd_mst['ctym_id'];?>"<?php if(isset($_REQUEST['lstsrchcty']) && $_REQUEST['lstsrchcty']==$rowspncd_mst['ctym_id']){echo 'selected';}?>><?php echo $rowspncd_mst['ctym_name'];?></option>
							 <?php
							 }
							 ?>
							 </select>
						</td>
						<td  align='left'><strong>Delivery Type</strong></td>
						<td align='left'>
							 <select name="lstprdsts" id="lstprdsts" style="width:100px">
								<option value="">--Select--</option>
								<option value="1"<?php if(isset($_REQUEST['lstprdsts']) && $_REQUEST['lstprdsts']=="1"){echo 'selected';}?>>General</option>
								<option value="2"<?php if(isset($_REQUEST['lstprdsts']) && $_REQUEST['lstprdsts']=="2"){echo 'selected';}?>>Midnight</option>	
								<option value="3"<?php if(isset($_REQUEST['lstprdsts']) && $_REQUEST['lstprdsts']=="3"){echo 'selected';}?>>Courierable</option>					
						 </select>
						</td><?php */?>
						<td width="25%" align="left">
						<strong>Exact</strong>
							<input type="checkbox" name="chkexact" value="1"<?php if(isset($_POST['chkexact']) && (trim($_POST['chkexact'])==1)){ echo 'checked';}elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){echo 'checked';}?>>
						<input name="button" type="button" class="textfeild" onClick="validate()" value="Search">
                        	<a href="vw_all_feedback.php" class="leftlinks"><strong>Refresh</strong></a>						                        </td>	
							
						</tr>
				   </table>
				  </td></tr>
			</table>
					
              <table width="95%" align='center' border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
			 <tr  bgcolor="#fff">
                <td bgcolor="#fff" colspan="4">&nbsp;</td>
				<?php
					/*if($gedtflg == 1)
					{*/
					?>
               <?php /*?> <td width="7%" align="center" valign="bottom" bgcolor="#f0f0f0">
                  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmtsk','chksts')"class="">
                </td><?php */?>
					<?php
				/*	}
					if($gdelflg == 1)
					{*/
				?>
                <td width="7%" align="center" valign="bottom" >
			      <input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmtsk','chkdlt');" class="" ></td>
				<?php
				//	}
				?>
              </tr>
			  <?php
			  	if($msg != ""){
					$dispmsg = "<tr  bgcolor='#f0f0f0'><td colspan='9' align='center'>$msg</td></tr>";
					echo $dispmsg;				
				}
			  ?>
              <tr class="white" >
               <td width="10%" align="left" bgcolor="#FF543A"><strong>Sl.No.</strong></td>
              	<td width="40%" bgcolor="#FF543A" align="left"><strong>Email Id</strong></td>
				 <td width="20%" bgcolor="#FF543A" align="left"><strong>Name</strong></td>    
				<?php /*?><td width="16%" bgcolor="#FF543A" align="left"><strong>City</strong></td>
				<td width="20%" bgcolor="#FF543A" align="left"><strong>County</strong></td>
                <td width="16%" bgcolor="#FF543A" align="left"><strong>Country</strong></td>
                <td width="15%" bgcolor="#FF543A" align="left"><strong>Delivery Type</strong></td> <?php */?>  
				<td width="30%" bgcolor="#FF543A" align="left"><strong>Date & Time</strong> 
			   
				   <?php
					/*if($gedtflg == 1)
					{*/
					?>
                
				<?php /*?><td width="7%" align="center" bgcolor="#FF543A"><strong>
				  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmtsk.chksts,'Check_ctr')"></strong></td><?php */?>
				    <?php
				 /* }
				  if($gdelflg == 1)
					{*/?>
                <td width="7%" align="center" bgcolor="#FF543A"><strong>
				<input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmtsk.chkdlt,'Check_dctr')"></strong></td>
				<?php
					//}
					?>
              </tr>
	        <?php
			$sqrypncd_mst1="select 
								fdbckm_id,fdbckm_name,fdbckm_emailid, date_format(fdbckm_crtdon,'%d-%m-%Y %h:%i:%s') as fdbckm_crtdon
						   from 
								vw_fdbck_all
						   where
								fdbckm_id != '' ";
			  if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!="")){
				  $txtsrchcd = glb_func_chkvl($_REQUEST['txtsrchcd']);	
				  $loc .= "&txtsrchcd=".$txtsrchcd;
				  if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$sqrypncd_mst1.=" and fdbckm_emailid='$txtsrchcd'";
					}
					else{
						$sqrypncd_mst1.=" and fdbckm_emailid like '%$txtsrchcd%'";
					}		
				}
				 if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){
				  $txtsrchnm = glb_func_chkvl($_REQUEST['txtsrchnm']);	
				  $loc .= "&txtsrchnm=".$txtsrchnm;
				  if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$sqrypncd_mst1.=" and fdbckm_name='$txtsrchnm'";
					}
					else{
						$sqrypncd_mst1.=" and fdbckm_name like '%$txtsrchnm%'";
					}		
				}
				/*if(isset($_REQUEST['lstsrchcty']) && trim($_REQUEST['lstsrchcty'])!=""){
					  $lstsrchcty = glb_func_chkvl($_REQUEST['lstsrchcty']);
					  $loc .= "&lstsrchcty=".$lstsrchcty;
					  $sqrypncd_mst1.=" and ctym_id = '$lstsrchcty'";				
				 }			
				if(isset($_REQUEST['lstsrchcntry']) && trim($_REQUEST['lstsrchcntry'])!=""){
					  $lstsrchcntry = glb_func_chkvl($_REQUEST['lstsrchcntry']);
					  $loc .= "&lstsrchcntry=".$lstsrchcntry;
					  $sqrypncd_mst1.=" and cntrym_id = '$lstsrchcntry'";				
				 }
				 if(isset($_REQUEST['lstsrchcnty']) && trim($_REQUEST['lstsrchcnty'])!=""){
					  $lstsrchcnty = glb_func_chkvl($_REQUEST['lstsrchcnty']);
					  $loc .= "&lstsrchcnty=".$lstsrchcnty;
					  $sqrypncd_mst1.=" and cntym_id = '$lstsrchcnty'";				
				 }	
				 if(isset($_REQUEST['lstprdsts']) && trim($_REQUEST['lstprdsts'])!=""){
					  $lstprdsts = glb_func_chkvl($_REQUEST['lstprdsts']);
					  $loc .= "&lstprdsts=".$lstprdsts;
					  $sqrypncd_mst1.=" and pncdm_dlvrtyp = '$lstprdsts'";				
				 }*/
				 if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$loc .= "&chk=y";
				 }	
			$sqrypncd_mst = $sqrypncd_mst1." order by brndm_crtdon limit $offset,$rowsprpg";
			$srspncd_mst  = mysqli_query($conn,$sqrypncd_mst);
			$serchres=mysqli_num_rows($srspncd_mst);
			/*if($serchres=='0')
			{
			   $msg = "<font color=red>Record  Not  Found </font>";
			}*/
			if($serchres > 0){
				$cnt = $offset;
				while($rowspncd_mst=mysqli_fetch_assoc($srspncd_mst)){ 
				$cnt+=1;						
			?>
			<tr <?php if($cnt%2==0){echo "bgcolor='#f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
				<td  align="left"><?php echo $cnt;?></td>
				<td  align="left"><a href="view_feedback_detail.php?edit=<?php echo $rowspncd_mst['fdbckm_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $rowspncd_mst['fdbckm_emailid'];?></a></td>
              	<td align="left"><?php echo $rowspncd_mst['fdbckm_name'];?></td>
				<td  align="left"><?php echo $rowspncd_mst['fdbckm_crtdon'];?></td>
				<?php /*?><td bgcolor="#f0f0f0" align="left"><?php echo $rowspncd_mst['cntym_name'];?></td>
				<td bgcolor="#f0f0f0" align="left"><?php echo $rowspncd_mst['cntrym_name'];?></td>
				<td bgcolor="f0f0f0" align="left"><?php echo funcDsplyDlvrtyp($rowspncd_mst['pncdm_dlvrtyp']);?></td>
				<td bgcolor="f0f0f0" align="right"><?php echo $rowspncd_mst['pncdm_prty'];?></td>	<?php */?>
				
					
				<?php /*?>	<td align="center" bgcolor="#f0f0f0">
					<input type="checkbox" name="chksts"  id="chksts" value="<?php echo $rowspncd_mst['fdbckm_id'];?>" <?php if($rowspncd_mst['pncdm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $rowspncd_mst['fdbckm_id'];?>,'hidchksts','frmtsk','chksts');">				</td><?php */?>
					<?php
					/*}
					if($gdelflg == 1)
					{*/
					?>
					<td align="center">
					<input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $rowspncd_mst['fdbckm_id'];?>"></td>
					<?php
					//}
					?>
				  </tr>
				  <?php
					}
					?>
					<tr>
                  <td bgcolor="#fff" colspan="4">&nbsp;</td>
               
                 <?php /*?> <td width="8" align="center" valign="bottom" bgcolor="f0f0f0">
                      <input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hidchksts','frmtsk','chksts')" class="">
                  </td><?php */?>
             
                  <td width="9%" align="center" valign="bottom" bgcolor="#fff" >
                      <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hidchkval','frmtsk','chkdlt');" class="">
                  </td>
                  <?php
				//}
				?>
                </tr>
				<?php
				$disppg = funcDispPag('paging',$loc,$sqrypncd_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
					if($disppg != ""){	
						$disppg = "<tr  bgcolor='#f0f0f0'><td colspan='9' align='center'>$disppg</td></tr>";
						echo $disppg;
					}
				}
				else{
					echo "<tr bgcolor><td colspan='9' align='center' bgcolor='#f0f0f0' >
					<font color='#fda33a'><b>Record not found</b></font></td></tr>";
				}				
			  ?>			   		  
            </table>	
          </form> 
		  </td>
       </tr>     
    </table></td>
  </tr>
</table>
<?php include_once '../includes/inc_adm_footer.php';?>
</body>
</html>