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
	
		if(($_POST['hdnchksts']!="") && isset($_REQUEST['hdnchksts'])){
			$dchkval = substr($_POST['hdnchksts'],1);
			$id  	 = glb_func_chkvl($dchkval);		
			$updtsts = funcUpdtAllRecSts('cty_mst','ctym_id',$id,'ctym_sts');		
			if($updtsts == 'y'){
				$msg = "<font color='#fda33a'>Record updated successfully</font>";
			}
			elseif($updtsts == 'n'){
				$msg = "<font color='#fda33a'>Record not updated</font>";
			}
		}
		if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval'])){
			$dchkval = substr($_POST['hdnchkval'],1);
			$did 	= glb_func_chkvl($dchkval);			
			$delsts = funcDelAllRec('cty_mst','ctym_id',$did);	
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
			document.getElementById('frmtsk').action="add_city.php";
			document.getElementById('frmtsk').submit();
		}
	function chng(){
		var div1=document.getElementById("div1");
		var div2=document.getElementById("div2");
		var div3=document.getElementById("div3");
		if(document.frmsrch.lstsrchby.value=='p'){
			div1.style.display="block";
			div2.style.display="none";
			div3.style.display="none";
		}
		else if(document.frmsrch.lstsrchby.value=='c'){
			div1.style.display="none";
			div2.style.display="block";
			div3.style.display="none";
		}
		else if(document.frmsrch.lstsrchby.value=='y'){
			div1.style.display="none";
			div2.style.display="none";
			div3.style.display="block";
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
				alert("Please Enter City Name");
				document.frmsrch.txtsrchval.focus();
				return false;
			}
		}		
		if(document.frmsrch.lstsrchby.value=="c"){
			if(document.frmsrch.lstcnty.value==""){
				alert("Please Select County");
				document.frmsrch.lstcnty.focus();
				return false;
			}
		}
		if(document.frmsrch.lstsrchby.value=="y"){
			if(document.frmsrch.lstcntry.value==""){
				alert("Please Select Country");
				document.frmsrch.lstcntry.focus();
				return false;
			}
		}
		var optn = document.frmsrch.lstsrchby.value;
		if(optn == 'p'){
			var val = document.frmsrch.txtsrchval.value;
			if(document.frmsrch.chkexact.checked==true){
				document.frmsrch.action="vw_all_verifycity.php?optn=p&val="+val+"&chk=y";
				document.frmsrch.submit();
			}
			else{
				document.frmsrch.action="vw_all_verifycity.php?optn=p&val="+val;
				document.frmsrch.submit();
			}
		}		
		else if(optn == 'c'){
			    var val = document.frmsrch.lstcnty.value;
				document.frmsrch.action="vw_all_verifycity.php?optn=c&val="+val;
				document.frmsrch.submit();
		}
		else if(optn == 'y'){
			    var val = document.frmsrch.lstcntry.value;
				document.frmsrch.action="vw_all_verifycity.php?optn=y&val="+val;
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
			div3.style.display="none";
		 <?php
		 }		
		 else if(isset($_POST['optn']) && $_POST['optn']=='c'){
		 ?>
			div1.style.display="none";
			div2.style.display="block";
			div3.style.display="none";
		<?php
		 }
		  else if(isset($_POST['optn']) && $_POST['optn']=='y'){
		 ?>
			div1.style.display="none";
			div2.style.display="none";
			div3.style.display="block";
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
<table width="1000px"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
		<table width="100%"  border="0" cellspacing="3" cellpadding="1" >
      <tr>
	  	 <td height="400" valign="top">
			  <table  width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
				<tr class='white'>
					<td height="26" colspan="4" bgcolor="#FF543A"><span class="heading"><strong> ::Verified City </strong></span><br>
					</td>
				</tr>
              <tr bgcolor="#f0f0f0">
			  	<td colspan="5" border="0" cellspacing="1" cellpadding="5">
				   <form method="POST" action="" name="frmsrch" id="frmsrch" onSubmit="return validate()">
					<table width="100%" >
						<tr bgcolor="#f0f0f0">
						   <td width="18%" align="right"><strong>Search By:</strong></td>
						  <td width="21%" valign="top">
						 <select name="lstsrchby" id="lstsrchby" onChange="chng()" style="width:140px">
						  <option value="">--Select--</option>
							  <option value="p"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='p'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='p'){echo 'selected';}?>>City Name</option>
							 <option value="c"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='c'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='c'){echo 'selected';}?>>County / State</option>
							   <option value="y"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='y'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='y'){echo 'selected';}?>>Country</option>					   
                   	 </select>
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
						 <select name="lstcnty" id="lstcnty">
						 <option value="">--Select--</option>
						 <?php
						 $sqrycty_mst="select 
											cntym_id,cntym_name
									   from 
											vw_cntry_cnty_cty_mst
									   where
											ctym_sts = 'u'
									   group by 
											cntym_id
									   order by 
											cntym_name";
						 $stscty_mst = mysqli_query($conn,$sqrycty_mst);
						 while($rowscty_mst=mysqli_fetch_assoc($stscty_mst)){
						 ?>
						 <option value="<?php echo $rowscty_mst['cntym_id'];?>"<?php if(isset($_POST['lstcnty']) && $_POST['lstcnty']==$rowscty_mst['cntym_id']){echo 'selected';}else if(isset($_REQUEST['val']) && $_REQUEST['val']==$rowscty_mst['cntym_id']){echo 'selected';}?>><?php echo $rowscty_mst['cntym_name'];?></option>
						 <?php
						 }
						 ?>
						 </select>
					 </div>
				   	<div id="div3" style="display:none">
						 <select name="lstcntry" id="lstcntry">
						 <option value="">--Select--</option>
						 <?php
						 $sqrycntry_mst="select 
											cntrym_id,cntrym_name
										 from 
											vw_cntry_cnty_cty_mst
										  where
											ctym_sts = 'u'
										 group by 
											cntrym_id
										 order by 
											cntrym_name";
						 $stscntry_mst = mysqli_query($conn,$sqrycntry_mst);
						 while($rowscntry_mst=mysqli_fetch_assoc($stscntry_mst)) {
						 ?>
						 <option value="<?php echo $rowscntry_mst['cntrym_id'];?>"<?php if(isset($_POST['lstcntry']) && $_POST['lstcntry']==$rowscntry_mst['cntrym_id']){echo 'selected';}else if(isset($_REQUEST['val']) && $_REQUEST['val']==$rowscntry_mst['cntrym_id']){echo 'selected';}?>><?php echo $rowscntry_mst['cntrym_name'];?></option>
						 <?php
						 }
						 ?>
						 </select>
						  </div></td>
						  <td width="28%">
							 <input type="submit" value="Search" name="btnsbmt">
							 <a href="vw_all_verifycity.php" class="leftlinks">Refresh</a></td>
						</tr>
					</table>	
				  </form>			</td>
                </tr>
            </table>
			<form method="POST" action="" name="frmtsk" id="frmtsk" bgcolor="#f0f0f0">
			<input type="hidden" name="hdnchkval" id="hdnchkval">
			<input type="hidden" name="hdnchksts" id="hdnchksts">			
              <table width="95%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
			 <tr  bgcolor="#f0f0f0">
                <td bgcolor="#f0f0f0" colspan="6">&nbsp;</td>
				<?php
					/*if($gedtflg == 1)
					{*/
					?>
                <td width="7%" align="center" valign="bottom" bgcolor="#f0f0f0">
                  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hdnchksts','frmtsk','chksts')"class="">
                 </td>
					<?php
				/*	}
					if($gdelflg == 1)
					{*/
				?>
                <td width="7%" align="center" valign="bottom" >
			      <input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hdnchkval','frmtsk','chkdlt');" class="" >
                 </td>
				<?php
				//	}
				?>
              </tr>
			  <?php
			  	if($gmsg != ""){
						$dispmsg = "<tr  bgcolor='#f0f0f0'><td colspan='8' align='center'>$msg</td></tr>";
						echo $dispmsg;				
				}
			  ?>
              <tr class="white">
                <td width="6%" bgcolor="#FF543A" align="left"><strong>S.No.</strong></td>
              	<td width="19%" bgcolor="#FF543A" align="left"><strong>City Name</strong></td>
				<td width="18%" bgcolor="#FF543A" align="left"><strong>County</strong></td>
				<td width="20%" bgcolor="#FF543A" align="left"><strong>Country</strong></td>
                <td width="16%" bgcolor="#FF543A" align="left"><strong>Iso Code </strong></td>
                <td width="7%" bgcolor="#FF543A" align="left"><strong>Rank</strong></td>                
				   <?php
					/*if($gedtflg == 1)
					{*/
					?>
                <td width="7%" align="center" bgcolor="#FF543A"><strong>
				  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmtsk.chksts,'Check_ctr')"></strong></td>
				    <?php
				 /* }
				  if($gdelflg == 1)
					{*/?>
                <td width="7%" align="center" bgcolor="#FF543A"><strong>
				<input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmtsk.chkdlt,'Check_dctr')"><b></b> 
</strong></td>
			<?php
					//}
					?>
              </tr>
	        <?php
				$sqrycty_mst1="select 
									ctym_id,ctym_name,ctym_sts,cntym_id,
							  	    ctym_iso,cntym_name,cntrym_name,cntrym_id,
									ctym_prty
							   from 
							   		vw_cntry_cnty_cty_mst
							   where
									ctym_sts = 'u' and
									ctym_id != '' ";
				if(isset($_REQUEST['optn']) && (trim($_REQUEST['optn'])=='p') && 
				   isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
				   
					$val = glb_func_chkvl($_REQUEST['val']);
					if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y'){
					  $loc = "&optn=p&val=".$val."&chk=y";
					  $sqrycty_mst1.=" and ctym_name='$val'";
					}
					elseif(!isset($_REQUEST['chk']) || $_REQUEST['chk']!='y'){
					  $loc = "&optn=p&val=".$val;
					  $sqrycty_mst1.=" and ctym_name like '%$val%'";
					}
				}			
				elseif(isset($_REQUEST['optn']) && (trim($_REQUEST['optn'])=='c') && 
					   isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
						$val = glb_func_chkvl($_REQUEST['val']);
						$loc = "&optn=c&val=".$val;
						$sqrycty_mst1.=" and ctym_cntym_id = '$val'";
				}
				elseif(isset($_REQUEST['optn']) && (trim($_REQUEST['optn'])=='y') && 
					   isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
					   
					$val = glb_func_chkvl($_REQUEST['val']);
					$loc = "&optn=y&val=".$val;
					$sqrycty_mst1.=" and cntym_cntrym_id = '$val'";
				}
			$sqrycty_mst = $sqrycty_mst1." order by cntrym_name,cntym_name,ctym_name asc limit $offset,$rowsprpg";
				$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
				$serchres=mysqli_num_rows($srscty_mst);
				/*if($serchres=='0')
				{
				   $msg = "<font color=#fda33a>Record  Not  Found </font>";
				}*/
				 if($serchres > 0)
				 {
					 $cnt = $offset;
					while($rowscty_mst=mysqli_fetch_assoc($srscty_mst))
					{ 
					   $cnt+=1;
									
				 ?>
				  <tr <?php if($cnt%2==0){echo "bgcolor='f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
					<td bgcolor="#f0f0f0"><?php echo $cnt;?></td>
					<td bgcolor="#f0f0f0"><a href="view_verifycity_dtl.php?vw=<?php echo $rowscty_mst['ctym_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $rowscty_mst['ctym_name'];?></a></td>
					<td bgcolor="#f0f0f0"><?php echo $rowscty_mst['cntym_name'];?></td>
					<td bgcolor="#f0f0f0" ><?php echo $rowscty_mst['cntrym_name'];?></td>
					<td bgcolor="#f0f0f0" ><?php echo $rowscty_mst['ctym_iso'];?></td>
					<td bgcolor="#f0f0f0" ><?php echo $rowscty_mst['ctym_prty'];?></td>
					 <?php
					/*if($gedtflg == 1)
					{*/
					?>					
					<td align="center" bgcolor="#f0f0f0">
					<input type="checkbox" name="chksts"  id="chksts" value="<?php echo $rowscty_mst['ctym_id'];?>" <?php if($rowscty_mst['ctym_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $rowscty_mst['ctym_id'];?>,'hdnchksts','frmtsk','chksts');">				</td>
					<?php
					/*}
					if($gdelflg == 1)
					{*/
					?>
					<td align="center" bgcolor="#f0f0f0">
					<input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $rowscty_mst['ctym_id'];?>"></td>
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
                  <td width="8" align="center" valign="bottom" bgcolor="f0f0f0">
                      <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hdnchksts','frmtsk','chksts')"  class="">
                  </td>
                  <?php
				/*	}
				if($gdelflg == 1)
				{*/
				?>
                  <td width="9%" align="center" valign="bottom" bgcolor="f0f0f0">
                      <input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hdnchkval','frmtsk','chkdlt');"  class="" >
                  </td>
                  <?php
				//}
				?>
                </tr>
				<?php
					$disppg = funcDispPag('links',$loc,$sqrycty_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
					if($disppg != ""){	
						$disppg = "<tr  bgcolor='#f0f0f0'><td colspan='8' align='center'>$disppg</td></tr>";
						echo $disppg;
					}
				}
				else{
					echo "<tr bgcolor><td colspan='8' align='center' bgcolor='#f0f0f0' >
					<font color='#fda33a'><b>Record not found</b></font></td></tr>";
				}				
			  ?>			   			  
            </table>	
          </form> </td>
      </tr>     
    </table></td>
  </tr>
</table>
<?php include_once '../includes/inc_adm_footer.php';?>
</body>
</html>