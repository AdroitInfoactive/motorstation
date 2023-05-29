<?php
      include_once '../includes/inc_nocache.php'; // Clearing the cache information
	  include_once "../includes/inc_adm_session.php";//checking for session
	  include_once "../includes/inc_connection.php";//Making database Connection
	  include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	  include_once '../includes/inc_paging_functions.php';//Making paging validation
	  include_once '../includes/inc_config.php'; 
	  /***************************************************************/
	  //Programe 	  : view_all_county.php
	  //Company 	  : Adroit
	  /***************************************************************/	
		if(($_POST['hidchksts']!="") && isset($_REQUEST['hidchksts'])){
			$dchkval = substr($_POST['hidchksts'],1);
			$id  	 = glb_func_chkvl($dchkval);		
			$updtsts = funcUpdtAllRecSts('cnty_mst','cntym_id',$id,'cntym_sts');		
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
			$delsts = funcDelAllRec('cnty_mst','cntym_id',$did);	
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
		document.frmsrch.action="add_county.php";
		document.frmsrch.submit();
	}
	function chng(){
		var div1=document.getElementById("div1");
		var div2=document.getElementById("div2");
		if(document.frmsrch.lstsrchby.value=='p'){
			div1.style.display="block";
			div2.style.display="none";
		}
		else if(document.frmsrch.lstsrchby.value=='c'){
			div1.style.display="none";
			div2.style.display="block";
		}
	}
	function validate(){
		if(document.frmsrch.lstsrchby.value==""){
			alert("Please Select Search Criteria");
			document.frmsrch.lstsrchby.focus();
			return false;
		}
		if(document.frmsrch.lstsrchby.value=="p"){
			if(document.frmsrch.txtsrchval.value==""){
				alert("Please Enter County Name");
				document.frmsrch.txtsrchval.focus();
				return false;
			}
		}
		if(document.frmsrch.lstsrchby.value=="c"){
			if(document.frmsrch.cntry.value==""){
				alert("Please Select Country");
				document.frmsrch.cntry.focus();
				return false;
			}
		}
		var optn = document.frmsrch.lstsrchby.value;
		if(optn == 'p'){
			var val = document.frmsrch.txtsrchval.value;
			if(document.frmsrch.chkexact.checked==true){
				document.frmsrch.action="vw_all_county.php?optn=p&val="+val+"&chk=y";
				document.frmsrch.submit();
			}
			else{
				document.frmsrch.action="vw_all_county.php?optn=p&val="+val;
				document.frmsrch.submit();
			}
		}
		else if(optn == 'c'){
			var val = document.frmsrch.cntry.value;
			document.frmsrch.action="vw_all_county.php?optn=c&val="+val;
			document.frmsrch.submit();
		}
		return true;
	}	
	function onLoad(){
		 <?php
		 if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='p'){
		 ?>
				div1.style.display="block";
				div2.style.display="none";
		 <?php
		 }
		 elseif(isset($_POST['optn']) && $_POST['optn'] =='c'){
		 ?>
				div1.style.display="none";
				div2.style.display="block";
		 <?php
		 }
		 ?>
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
</script>
</head>
<body onLoad="onLoad();chng()">
<?php include_once ('../includes/inc_adm_header.php');?>
<?php include_once ('../includes/inc_adm_leftlinks.php'); ?>
<table width="1000px" border="0" align="center" cellpadding="0" cellspacing="0" >
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td height="400" align="center" valign="top">
			<table width="1000px"  border="0" cellspacing="3" cellpadding="1" >
		  <tr>
			<td height="400" align="center" valign="top">
				  <table  width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">				 
					   <form method="POST" action="<?php echo $_SERVER['SCRIPT_FILENAME'];?>" name="frmsrch" id="frmsrch" onSubmit="return validate()">
					   <tr align="left" class='white'>
						  <td height="26" colspan="5" bgcolor="#FF543A">
						 <span class="heading"><strong>:: County </strong></span><br>
							</td>
						</tr>
					  <tr bgcolor="#f0f0f0">
						<td colspan="5" border="0" cellspacing="1" cellpadding="5">
						  <table width="100%" >
								<tr bgcolor="#f0f0f0">
							  <td width="18%" align="right"><strong>Search By:</strong></td>
							  <td width="21%" valign="top">
							<select name="lstsrchby" id="lstsrchby" onChange="chng()" style="width:140px">
							  <option value="">--Select--</option>
							  <option value="p"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='p'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='p'){echo 'selected';}?>>County</option>
							  <option value="c"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='c'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='c'){echo 'selected';}?>>Country</option>
							</select>
						</td>
						<td width="40%">
						 <div id="div1" style="display:block">
						   <input type="text" name="txtsrchval" class="" value="<?php if(isset($_POST['txtsrchval']) && $_POST['txtsrchval']!=""){echo $_POST['txtsrchval'];}else if(isset($_REQUEST['val']) && $_REQUEST['val']!=""){echo $_REQUEST['val'];}?>">
						   <strong>Exact</strong>
							<input type="checkbox" name="chkexact" value="1"<?php 						  
								if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){
									echo 'checked';
								}
								elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){
									echo 'checked';							
								}						  						  
							  ?>>
						 </div>
						 <div id="div2" style="display:none">
						 <select name="cntry" id="cntry">
							 <option value="">--Select--</option>
							 <?php
							 $sqrycnty_mst =  "select 
												  cntrym_id,cntrym_name
											   from 
												  vw_cntry_cnty_mst
											   where
												  cntym_sts != 'u'
											   group by 
												  cntrym_id
											   order by 
												  cntrym_name";
							 $stscnty_mst = mysqli_query($conn,$sqrycnty_mst);
							 while($rowscnty_mst=mysqli_fetch_assoc($stscnty_mst)){
							 ?>
							 <option value="<?php echo $rowscnty_mst['cntrym_id'];?>"<?php if(isset($_POST['cntry']) && $_POST['cntry']==$rowscnty_mst['cntrym_id']){echo 'selected';}else if(isset($_REQUEST['val']) && $_REQUEST['val']==$rowscnty_mst['cntrym_id']){echo 'selected';}?>><?php echo $rowscnty_mst['cntrym_name'];?></option>
							 <?php
							 }
							 ?>
						 </select>
						 </div></td>
						<td width="22%">
						 <input type="submit" value="Search" name="btnsbmt">
						 <a href="vw_all_county.php" class="leftlinks">Refresh</a></td>
						 <td width="8%" align="right">
						 <input name="Submit" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">
						</td>
							</tr>
						</table>
						</td>
					</tr>	
					  </form>
				</table>
			<form method="POST" action="" name="frmtsk" id="frmtsk" bgcolor="#f0f0f0">
				<input type="hidden" name="hidchkval" id="hidchkval">
				<input type="hidden" name="hidchksts" id="hidchksts">			
				  <table width="95%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
				 <tr  bgcolor="#f0f0f0">
					<td bgcolor="#f0f0f0" colspan="6">&nbsp;</td>
					<?php
						/*if($gedtflg == 1)
						{*/
						?>
					<td width="59" align="right" valign="bottom" bgcolor="#f0f0f0"><div align="right">
					  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmtsk','chksts')"class="">
					</div></td>
						<?php
					/*	}
						if($gdelflg == 1)
						{*/
					?>
					<td width="60" align="right" valign="bottom" ><div align="right">
					  <input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmtsk','chkdlt');" class="" >
					 
					</div></td>
					<?php
					//	}
					?>
				  </tr>
					  <?php
						if($msg != ""){
								$dispmsg = "<tr><td colspan='8' align='center' bgcolor='#f0f0f0'>$msg</td></tr>";
								echo $dispmsg;				
						}
					  ?>
					<tr class="white">
					  <td width="39" align="left" class="greenbg"><strong>S.No.</strong></td>
					  <td width="282" align="left" class="greenbg"><strong> Name</strong></td>
					  <td width="229" align="left" class="greenbg"><strong>Country</strong></td>
					  <td width="68" align="left" class="greenbg"><strong>Iso Code </strong></td>
					  <td width="43" align="center" class="greenbg"><strong>Rank</strong></td>
					  <?php
						/*if($gedtflg == 1)
						{*/
						?>
					  <td width="51" align="center" class="greenbg"><strong>Edit</strong></td>
					  <td width="59" align="center" class="greenbg"><strong>
						<input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmtsk.chksts,'Check_ctr')">
					  </strong></td>
					  <?php
					 /* }
					  if($gdelflg == 1)
						{*/?>
					  <td width="60" align="center" class="greenbg"><strong>
						<input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmtsk.chkdlt,'Check_dctr')">
					  <b></b> </strong></td>
					  <?php
						//}
						?>
					</tr>
					<?php
					   $sqrycnty_mst1="select 
											cntym_id,cntym_name,cntym_iso,
											cntym_sts,cntrym_id,cntrym_name,cntym_prty
									   from 
											vw_cntry_cnty_mst
									   where 
											cntym_sts != 'u' and
											cntym_id!=''";
						if(isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 'p') &&
						   isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){	   
							$val = glb_func_chkvl($_REQUEST['val']);
							if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
							  $loc = "&optn=p&val=".$val."&chk=y";
							  $sqrycnty_mst1.=" and cntym_name='$val'";
							}
							elseif(!isset($_REQUEST['chk']) || $_REQUEST['chk']!='y'){
								$loc = "&optn=p&val=".$val;
								$sqrycnty_mst1.=" and cntym_name like '%$val%'";
							}
						}
						elseif(isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 'c') && 
							   isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
							$val = glb_func_chkvl($_REQUEST['val']);
							$loc = "&optn=c&val=".$val;
							$sqrycnty_mst1.=" and cntym_cntrym_id = '$val'";
						}
						$sqrycnty_mst = $sqrycnty_mst1." order by cntrym_name,cntym_name asc limit $offset,$rowsprpg";
						$srscnty_mst  = mysqli_query($conn,$sqrycnty_mst);
						$serchres=mysqli_num_rows($srscnty_mst);
						/*if($serchres=='0'){
						   $msg = "<font color=red>Record  Not  Found </font>";
						}*/
						if($serchres > 0){
							 $cnt = $offset;
							 while($rowscnty_mst=mysqli_fetch_assoc($srscnty_mst)){
							  $cnt+=1;						
					 ?>
					<tr >
					  <td bgcolor="f0f0f0" align="left"><?php echo $cnt;?></td>
					  <td bgcolor="f0f0f0" align="left"><a href="edit_county.php?vw=<?php echo $rowscnty_mst['cntym_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $rowscnty_mst['cntym_name'];?></a></td>
					  <td bgcolor="f0f0f0" align="left"><?php echo $rowscnty_mst['cntrym_name'];?></td>
					  <td bgcolor="f0f0f0" align="left"><?php echo $rowscnty_mst['cntym_iso'];?></td>
					  <td bgcolor="f0f0f0" align="right"><?php echo $rowscnty_mst['cntym_prty'];?></td>
					  <?php
						/*if($gedtflg == 1)
						{*/
						?>
					  <td align="center" bgcolor="f0f0f0" ><a href="edit_county.php?vw=<?php echo $rowscnty_mst['cntym_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks">Edit</a></td>
					  <td align="center" bgcolor="f0f0f0"><input type="checkbox" name="chksts"  id="chksts" value="<?php echo $rowscnty_mst['cntym_id'];?>" <?php if($rowscnty_mst['cntym_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $rowscnty_mst['cntym_id'];?>,'hidchksts','frmtsk','chksts');">                  </td>
					  <?php
						/*}
						if($gdelflg == 1)
						{*/
						?>
					  <td align="center" bgcolor="f0f0f0"><input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $rowscnty_mst['cntym_id'];?>"></td>
					  <?php
						//}
						?>
					</tr>
					<?php
						}
						?>
					<tr>
					  <td bgcolor="f0f0f0" colspan="6">&nbsp;</td>
					  <?php
					/*	if($gedtflg == 1)
						{*/
						?>
					  <td width="59" align="center" valign="bottom" bgcolor="f0f0f0">
						  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmtsk','chksts')"  class="">
					  </td>
					  <?php
					/*	}
					if($gdelflg == 1)
					{*/
					?>
					  <td width="60" align="center" valign="bottom" bgcolor="f0f0f0" >
						  <input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmtsk','chkdlt');"  class="" >
					  </td>
					  <?php
					//}
					?>
					</tr>
					<?php						
						$disppg = funcDispPag('paging',$loc,$sqrycnty_mst1,$rowsprpg,$cntstart, $pgnum, $conn);						
						/*if(($gedtflg == 1) && ($gdelflg == 1)){
							$colspanval = '7';
						}
						elseif(($gedtflg == 1) || ($gdelflg == 1)){
							$colspanval = '6';
						}
						else
						{*/
							 $colspanval = '9';				
						//}						
						if($disppg != ""){	
							$disppg = "<tr><td colspan='$colspanval' align='center' bgcolor='#f0f0f0'>$disppg</td></tr>";
							echo $disppg;
						}					
					}
					else{
						echo "<tr><td colspan='9' align='center' bgcolor='#f0f0f0' >
						<font color='#fda33a'>Record not found</font></td></tr>";
					}				
				  ?>             			  
				</table>	
			  </form> 
		</td>
	   </tr>     
    </table>
</td>
  </tr>
</table>
<?php include_once '../includes/inc_adm_footer.php';?>
</body>
</html>