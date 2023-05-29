<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_paging_functions.php';//Making paging validation
	include_once '../includes/inc_config.php'; 
	/***************************************************************/
	 //Programe 	  : view_all_country.php
	 //Company 	  : Adroit
	/**************************************/
	if(($_POST['hdnchksts']!="") && isset($_REQUEST['hdnchksts'])){
		$dchkval = substr($_POST['hdnchksts'],1);
		$id  	 = glb_func_chkvl($dchkval);		
		$updtsts = funcUpdtAllRecSts('cntry_mst','cntrym_id',$id,'cntrym_sts');		
		if($updtsts == 'y'){
			$gmsg = "<font color='#fda33a'>Record updated successfully</font>";
		}
		elseif($updtsts == 'n'){
			$gmsg = "<font color='#fda33a'>Record not updated</font>";
		}
	 }	
	 if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval'])){
		$dchkval = substr($_POST['hdnchkval'],1);
		$did 	= glb_func_chkvl($dchkval);			
		$delsts = funcDelAllRec('cntry_mst','cntrym_id',$did);	
		if($delsts == 'y'){
			$gmsg = "<font color='#fda33a'>Record deleted successfully</font>";
		}
		elseif($delsts == 'n'){
			$gmsg = "<font color='#fda33a'>Record can't be deleted(child records exist)</font>";
		}
	 }
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
			$gmsg = "<font color='#fda33a'>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
			$gmsg = "<font color='#fda33a'>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
			$gmsg = "<font color='#fda33a'>Duplicate Record Name Exists & Record Not updated</font>";
	}
	$rowsprpg  = 20;//maximum rows per page
	include_once '../includes/inc_paging1.php';//Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
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
<script language="javascript">
	function addnew(){
			document.frmcntry.action="add_country.php";
			document.frmcntry.submit();
		}		
		function chng(){
			var div1=document.getElementById("div1");
			var div2=document.getElementById("div2");
			if(document.frmcntry.lstsrchby.value=='c'){
				div1.style.display="block";
				div2.style.display="none";
			}
			else if(document.frmcntry.lstsrchby.value=='t'){
				div1.style.display="none";
				div2.style.display="block";
			}
		}
	   function validate(){
		if(document.frmcntry.lstsrchby.value==""){
			alert("Select Search Criteria");
			document.frmcntry.lstsrchby.focus();
			return false;
		}
		if(document.frmcntry.lstsrchby.value=="c"){
			if(document.frmcntry.txtsrchval.value==""){
				alert("Enter Country Name");
				document.frmcntry.txtsrchval.focus();
				return false;
			}
		}
		if(document.frmcntry.lstsrchby.value=="t"){
			if(document.frmcntry.lstsrchcntnt.value==""){
				alert("Select Continent");
				document.frmcntry.lstsrchcntnt.focus();
				return false;
			}
		}
		var optn = document.frmcntry.lstsrchby.value;
		if(optn == 'c'){
			var txtsrchval = document.frmcntry.txtsrchval.value;
			if(document.frmcntry.chkexact.checked==true){
				document.frmcntry.action="vw_all_country.php?optn=c&txtsrchval="+txtsrchval+"&chkexact=y";
				document.frmcntry.submit();
			}
			else{
				document.frmcntry.action="vw_all_country.php?optn=c&txtsrchval="+txtsrchval;
				document.frmcntry.submit();
			}
		}
		else if(optn == 't'){
			var lstsrchcntnt = document.frmcntry.lstsrchcntnt.value;
			document.frmcntry.action="vw_all_country.php?optn=t&lstsrchcntnt="+lstsrchcntnt;
			document.frmcntry.submit();
		}
		return true;
	}	
	function onLoad(){
		 <?php
		 if(isset($_POST['optn']) && $_POST['optn']=='c'){
		 ?>
				div1.style.display="block";
				div2.style.display="none";
		 <?php
		 }
		 elseif(isset($_POST['optn']) && $_POST['optn'] =='t'){
		 ?>
				div1.style.display="none";
				div2.style.display="block";
		 <?php
		 }
		 ?>
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body onLoad="onLoad(),chng();">
<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr valign="top"> 
	<td height="400" valign="top">
	 <form name="frmcntry" id="frmcntry" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return validate()">
			 <input type="hidden" name="hdnchkval" id="hdnchkval">
            <input type="hidden" name="hdnchksts" id="hdnchksts">
		     <table  width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
               <tr align="left" class='white'>
                  <td height="26" colspan="9" bgcolor="#FF543A">
				  <span class="heading"><strong> :: Country </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
			  <tr bgcolor="#f0f0f0">
			  	<td  colspan="9">
					<table width="100%">
						<tr>
							 <td width="18%" align="right"><strong>Search By:</strong></td>
							 <td width="21%" valign="top">
							<select name="lstsrchby" id="lstsrchby" onChange="chng()" style="width:140px">
							  <option value="">--Select--</option>
							  <option value="c"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='c'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='c'){echo 'selected';}?>>Country</option>
							  <option value="t"<?php if(isset($_REQUEST['lstsrchby']) && $_REQUEST['lstsrchby']=='t'){echo 'selected';}else if(isset($_REQUEST['optn']) && $_REQUEST['optn']=='t'){echo 'selected';}?>>Continent</option>
							</select>
						</td>
						<td width="40%">
						 <div id="div1" style="display:block">
						   <input type="text" name="txtsrchval" class="" value="<?php if(isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval']!=""){echo $_REQUEST['txtsrchval'];}?>">
						   <strong>Exact</strong>
							<input type="checkbox" name="chkexact" value="y"<?php 						  
								if(isset($_REQUEST['chkexact']) && ($_REQUEST['chkexact']=='y')){
									echo 'checked';
								}														  						  
							  ?>>
						 </div>
						 <div id="div2" style="display:none">							
							<select name="lstsrchcntnt" id="lstsrchcntnt">
								 <option value="">--Select--</option>
									 <?php
									 $sqrycntnt_mst = "select 
														  cntntm_id,cntntm_name
													   from 
														  vw_cntry_cntnt_mst
													   where
														  cntntm_id !=''
													   group by 
														  cntntm_id
													   order by 
														  cntntm_name asc";
									 $stscntnt_mst = mysqli_query($conn,$sqrycntnt_mst);
									 while($rowscntnt_mst=mysqli_fetch_assoc($stscntnt_mst)){
									 ?>
									 <option value="<?php echo $rowscntnt_mst['cntntm_id'];?>"<?php if(isset($_REQUEST['lstsrchcntnt']) && $_REQUEST['lstsrchcntnt']==$rowscntnt_mst['cntntm_id']){echo 'selected';}?>><?php echo $rowscntnt_mst['cntntm_name'];?></option>
									 <?php
									}
								 ?>
						 </select>
					 </div>
					</td>
                    <td width="32%">
						<input name="button" type="button" class="textfeild" onClick="validate()" value="Search">
			      		<a href="vw_all_country.php" class="leftlinks"><strong>Refresh</strong></a>						                    </td>
					 <td width="9%" align="right">					
						<input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">														
					</td>
						</tr>
					</table> 
				</td>
              </tr>
			   <tr bgcolor="#f0f0f0">
                <td  colspan="7">&nbsp;</td>                
                <td width="5%" align="center" valign="bottom" >
                  <input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmcntry','chksts')">
                </td>                
                <td width="7%" align="center" valign="bottom">
                  <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmcntry','chkdlt');">
                </td>                
                </tr>
			  <?php
			  if($gmsg != ""){
					$dispmsg = "<tr><td colspan='9' align='center' bgcolor='#f0f0f0'>$gmsg</td></tr>";
					echo $dispmsg;				
				}
			  ?>
			  <tr bgcolor="#" class="white">
                  <td width="7%" align="left" rowspan="2" bgcolor="#FF543A"><strong>SL. No.</strong></td>
                   <td width="41%" align="left" rowspan="2" bgcolor="#FF543A"><strong>Name</strong></td>
				   <td width="16%" align="left" rowspan="2" bgcolor="#FF543A"><strong>Continent</strong></td>  
				   <td colspan='3' align='center' bgcolor="#FF543A"><strong>Codes</strong></td>                             			
			  	   <td width="5%" align="center" rowspan="2" bgcolor="#FF543A"><strong>Rank</strong></td>                       
                   <td width="8%"  align="center" rowspan="2" bgcolor="#FF543A"><strong>
                    <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmcntry.chksts,'Check_ctr')">
                  </strong></td>
                  <td width="8%"  align="center" rowspan="2" bgcolor="#FF543A"><strong>
                    <input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmcntry.chkdlt,'Check_dctr')">
                    <b></b> </strong></td>
                </tr>
				<tr class="white">
              		<td width="5%" align="center" bgcolor="#FF543A"><strong>Iso-2</strong></td>
					<td width="5%" align="center" bgcolor="#FF543A"><strong>Iso-3</strong></td>
					<td width="5%" align="center" bgcolor="#FF543A"><strong>Num</strong></td>
                </tr>	        		 
			  <?php
				$sqrycntry_mst1="select 
									 cntrym_id,cntrym_name,cntrym_sts,cntrym_isotwo,
									 cntrym_isothr,cntrym_isonum,cntrym_prty,cntntm_name,
									 cntrym_cntntm_id
	                			 from 
									 vw_cntry_cntnt_mst
				    			 where 
									 cntrym_id!=''";
				if(isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 'c') &&
				   isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval'])!="")){	   
					$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
					if(isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact'])=='y')){
					    $loc = "&optn=c&txtsrchval=".$txtsrchval."&chkexact=y";
					    $sqrycntry_mst1.=" and cntrym_name='$txtsrchval'";
					}
					else{
						$loc = "&optn=c&txtsrchval=".$txtsrchval;
						$sqrycntry_mst1.=" and cntrym_name like '%$txtsrchval%'";
					}
				}
				elseif(isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == 't') && 
					   isset($_REQUEST['lstsrchcntnt']) && (trim($_REQUEST['lstsrchcntnt'])!="")){
						$lstsrchcntnt = glb_func_chkvl($_REQUEST['lstsrchcntnt']);
						$loc = "&optn=t&lstsrchcntnt=".$lstsrchcntnt;
						$sqrycntry_mst1.=" and cntrym_cntntm_id = '$lstsrchcntnt'";
				}				
				$sqrycntry_mst = $sqrycntry_mst1." order by cntntm_name,cntrym_name asc limit $offset,$rowsprpg";
				$srscntry_mst  = mysqli_query($conn,$sqrycntry_mst);
				$serchres=mysqli_num_rows($srscntry_mst);
				/*if($serchres=='0'){
				   $gmsg = "<font color=red>Record  Not  Found </font>";
				}*/
				 if($serchres > 0){
					 $cnt = $offset;
					 while($rowscntry_mst=mysqli_fetch_assoc($srscntry_mst)){
						  $cnt+=1;
			  	?>
					 <tr bgcolor="#f0f0f0">
                  <td><?php echo $cnt;?></td>
                  <td><a href="edit_country.php?vw=<?php echo $rowscntry_mst['cntrym_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $rowscntry_mst['cntrym_name'];?></a></td>
				  <td align="left"><?php echo $rowscntry_mst['cntntm_name'];?></td>	
				  <td align="right"><?php echo $rowscntry_mst['cntrym_isotwo'];?></td>	
				  <td align="right"><?php echo $rowscntry_mst['cntrym_isothr'];?></td>	
				  <td align="right"><?php echo $rowscntry_mst['cntrym_isonum'];?></td>    
				  <td align="right"><?php echo $rowscntry_mst['cntrym_prty'];?></td>	            
                  <td align="center"><input type="checkbox" name="chksts"  id="chksts" value="<?php echo $rowscntry_mst['cntrym_id'];?>" <?php if($rowscntry_mst['cntrym_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $rowscntry_mst['cntrym_id'];?>,'hdnchksts','frmcntry','chksts');">                  </td>
                  <td align="center"><input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $rowscntry_mst['cntrym_id'];?>"></td>
                </tr>
			  <?php
			  		}
			  //	}
				?>
			 <tr bgcolor="#f0f0f0" class="black" >
                <td  colspan="7">&nbsp;</td>                
                <td width="5%" align="center" valign="bottom" >
                  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hdnchksts','frmcntry','chksts')">
                </td>                
                <td width="7%" align="center" valign="bottom">
                  <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmcntry','chkdlt');">
                </td>                
                </tr>
				<?php
				$disppg = funcDispPag('paging',$loc,$sqrycntry_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
				$colspanval = '9';							
				if($disppg != ""){	
					$disppg = "<br><tr><td colspan='$colspanval' align='center' bgcolor='#f0f0f0'>$disppg</td></tr>";
					echo $disppg;
				}	
				}
				else{
				echo "<tr><td colspan='9' align='center' bgcolor='#f0f0f0' >
					<font color='#fda33a'><b>Record not found</b></font></td></tr>";
				}					
			   ?>			  
            </table>
			</form>
	</td>
  </tr>
</table>
<?php include_once('../includes/inc_adm_footer.php');?>
</body>
</html>