<?php
	include_once "../includes/inc_nocache.php";          //Clearing the cache information
	include_once "../includes/inc_adm_session.php";      //checking for session
	include_once "../includes/inc_connection.php";       //Making database Connection
	include_once "../includes/inc_usr_functions.php";    //Use function for validation and more	
	include_once '../includes/inc_paging_functions.php';//Making paging validation
	include_once "../includes/inc_folder_path.php";
	include_once "../includes/inc_config.php";			
	/***************************************************************/
	//Programm 	  : vw_all_continent.php	
	//Purpose 	  : For Viewing continent Details
	//Created By  : 
	//Created On  :	
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
	
	if(($_POST['hdnchksts']!="") && isset($_REQUEST['hdnchksts'])){
		$dchkval = substr($_POST['hdnchksts'],1);
		$id  	 = glb_func_chkvl($dchkval);		
		$updtsts = funcUpdtAllRecSts('cntnt_mst','cntntm_id',$id,'cntntm_sts');			
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
		$delsts = funcDelAllRec('cntnt_mst','cntntm_id',$did);	
		if($delsts == 'y'){
			$msg = "<font color='#fda33a'>Record deleted successfully</font>";
		}
		elseif($delsts == 'n'){
			$msg = "<font color='#fda33a'>Record can't be deleted(child records exist)</font>";
		}
	}		
	if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] == 'y')){
	    $msg = "<font color='#fda33a'>Record updated successfully</font>";
	}
	if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] == 'n')){
			$msg = "<font color='#fda33a'>Record not updated</font>";
	}
    if(isset($_REQUEST['sts']) && ($_REQUEST['sts'] =='d')){
	    $msg = "<font color='#fda33a'>Duplicate Record Name Exists & Record Not updated</font>";
	}		
    $rowsprpg  = 20;//maximum rows per page
	include_once "../includes/inc_paging1.php";//Includes pagination	
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
		document.frmcntnt.action="add_continent.php";
		document.frmcntnt.submit();
	}
	function validate(){
		if(document.frmcntnt.txtsrchval.value==""){
			alert("Enter Name");
			document.frmcntnt.txtsrchval.focus();
			return false;
		}
		var val = document.frmcntnt.txtsrchval.value;
		if(document.frmcntnt.chkexact.checked==true){
			document.frmcntnt.action="vw_all_continent.php?val="+val+"&chk=y";
			document.frmcntnt.submit();
		}
		else{
			document.frmcntnt.action="vw_all_continent.php?val="+val;
			document.frmcntnt.submit();
		}
		return true;
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body>
<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr valign="top"> 
	<td height="400px" valign="top">
	   <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmcntnt" id="frmcntnt">
			 <input type="hidden" name="hdnchkval" id="hdnchkval">
            <input type="hidden" name="hdnchksts" id="hdnchksts">
		     <table  width="95%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
               <tr align="left" class='white'>
                  <td height="26" colspan="7" bgcolor="#FF543A">
				  <span class="heading"><strong> :: Continent </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
			  <tr bgcolor="#f0f0f0">
			  	<td  colspan="6">
					<table width="100%">
						<tr>
							<td width="35%" align="center"><strong>Search By Name </strong></td>
						    <td width="33%">
							  <div id="div1" style="display:block">
							  <input type="text" name="txtsrchval" id="txtsrchval" value="<?php 
							  if(isset($_POST['txtsrchval']) && (trim($_POST['txtsrchval'])!="")){
								echo $_POST['txtsrchval'];
							  }
							  elseif(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
								 echo $_REQUEST['val'];
							  }
							?>">
							  Exact
							  <input type="checkbox" name="chkexact" value="1"<?php 						  
								if(isset($_POST['chkexact']) && (trim($_POST['chkexact'])==1)){
									echo 'checked';
								}
								elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
									echo 'checked';							
								}						  						  
							  ?>>
						  </div>	 </td>
						  <td width="32%">
						    <input name="button" type="button" class="textfeild" onClick="validate()" value="Search">
			      		  <a href="vw_all_continent.php" class="leftlinks"><strong>Refresh</strong></a>						                           </td>
						</tr>
					</table> 
				</td>
                <td width="9%" align="right">					
					<input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">														
				</td>
              </tr>
			   <tr bgcolor="#f0f0f0">
                <td  colspan="5">&nbsp;</td>                
                <td width="5%" align="center" valign="bottom" >
                  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hdnchksts','frmcntnt','chksts')">
                </td>                
                <td width="7%" align="center" valign="bottom">
                  <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmcntnt','chkdlt');">
                </td>                
                </tr>
			  <?php
			  if($msg != ""){
					$dispmsg = "<tr><td colspan='7' align='center' bgcolor='#f0f0f0'>$msg</td></tr>";
					echo $dispmsg;				
				}
			  ?>
			  <tr class="white">
                  <td width="7%" align="left" bgcolor="#FF543A"><strong>SL. No</strong></td>
                  <td width="54%" align="left" bgcolor="#FF543A"><strong>Name</strong></td>
				  <td width="9%" align="left" bgcolor="#FF543A"><strong>Iso Code</strong></td>
				  <td width="7%" align="left" bgcolor="#FF543A"><strong>Rank</strong></td>
				  <td width="8%" align="center" bgcolor="#FF543A"><strong>Edit</strong></td>
                  <td width="6%"  align="center" bgcolor="#FF543A"><input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes" onClick="Check(document.frmcntnt.chksts,'Check_ctr')"></td>
                  <td width="9%"  align="center" bgcolor="#FF543A"><input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmcntnt.chkdlt,'Check_dctr')"></td>
                </tr>             		 
			  <?php
				$sqrycntnt_mst1="select 
									cntntm_id,cntntm_name,cntntm_iso,cntntm_prty,
									cntntm_sts
				             	 from 
							   		cntnt_mst";
				if(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
					$val = glb_func_chkvl($_REQUEST['val']);
					if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$loc = "&val=".$val."&chk=y";
						$sqrycntnt_mst1.=" where cntntm_name='$val'";
					}
					else{
						$loc = "&val=".$val;
						$sqrycntnt_mst1.=" where cntntm_name like '%$val%'";
					}
				}				
				$sqrycntnt_mst=$sqrycntnt_mst1." order by cntntm_name asc limit $offset,$rowsprpg";
				$srscntnt_mst = mysqli_query($conn,$sqrycntnt_mst);
			  	$cnt = $offset;
				$serchres=mysqli_num_rows($srscntnt_mst);
				if($serchres=='0'){
			       echo $msg = "<tr  bgcolor='#f0f0f0'><td colspan='11' align='center'><font color=#FF6600>No Record Avaiable</font></td></tr>";
				}
				else{
					while($srowcntnt_mst=mysqli_fetch_assoc($srscntnt_mst)){
						$cnt+=1;
						$dbcntnt_id		=	$srowcntnt_mst['cntntm_id'];
						$dbcntnt_name		= 	$srowcntnt_mst['cntntm_name'];
						$dbcntnt_iso	    =	$srowcntnt_mst['cntntm_iso']; 
						$dbprty_val		= 	$srowcntnt_mst['cntntm_prty'];
						$dbsts_val		= 	$srowcntnt_mst['cntntm_sts'];
			  	?>
					  <tr <?php if($cnt%2==0){echo "bgcolor='#f0f0f0'";}else{echo "bgcolor='#f0f0f0'";}?>>
						<td align="left"><?php echo $cnt;?></td>
						<td align="left">
						<a href="view_continent_dtl.php?vw=<?php echo $dbcntnt_id;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $dbcntnt_name;?></a>
						</td>
						<td align="left"><?php echo $dbcntnt_iso;?></td>
						<td align="right"><?php echo $dbprty_val;?></td>
						<td align="center">
							<a href="edit_continent.php?vw=<?php echo $dbcntnt_id;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks">Edit</a></td>						
						<td align="center">
                  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo $dbcntnt_id;?>" <?php if($dbsts_val =='a') { echo "checked";}?> onClick="addchkval(<?php echo $dbcntnt_id;?>,'hdnchksts','frmcntnt','chksts');"></td>
                <td align="center">
                  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $dbcntnt_id;?>"></td>
					  </tr>
			  <?php
			  		}
			  	}
				?>
			 <tr bgcolor="#f0f0f0">
                <td  colspan="5">&nbsp;</td>                
                <td width="5%" align="center" valign="bottom" >
                  <input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hdnchksts','frmcntnt','chksts')">
                </td>                
                <td width="7%" align="center" valign="bottom">
                  <input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmcntnt','chkdlt');">
                </td>                
                </tr>
				<?php
				$disppg = funcDispPag('paging',$loc,$sqrycntnt_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
				$colspanval = '7';				
																
				if($disppg != ""){	
					$disppg = "<br><tr><td colspan='$colspanval' align='center' bgcolor='#f0f0f0'>$disppg</td></tr>";
					echo $disppg;
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