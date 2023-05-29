<?php
	include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once  "../includes/inc_adm_session.php";//checking for session
	include_once  "../includes/inc_connection.php";//Making database Connection
	include_once  "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once  "../includes/inc_paging_functions.php";//Making paging validation
	include_once '../includes/inc_config.php';	
	include_once "../includes/inc_folder_path.php";
	/***************************************************************
	Programm 	  	: view_product_category.php	
	Purpose 	  		: For Viewing product Category  Details
	Created By    	: Mallikarjuna
	Created On    	:	29/10/2013
	Modified By   	: 
	Modified On   	: 
	Purpose 	  		: 
	Company 	  		: Adroit
	************************************************************/
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg;	
	$loc = "";
	if(isset($_REQUEST['hidchksts']) && (trim($_POST['hidchksts']) !="") ||
	   isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!="")){
		$dchkval = substr($_POST['hidchksts'],1);
		$id  	 = glb_func_chkvl($dchkval);
		$chkallval	=  glb_func_chkvl($_POST['hdnallval']);					
		$updtsts = funcUpdtAllRecSts('prodcat_mst','prodcatm_id',$id,'prodcatm_sts',$chkallval);			
		if($updtsts == 'y'){
			$msg = "<font color=#fda33a>Record updated successfully</font>";
		}
		elseif($updtsts == 'n'){
			$msg = "<font color=#fda33a>Record not updated</font>";
		}
	}	
	if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval']))
		{
		$dchkval    =  substr($_POST['hidchkval'],1);
		$did 	    =  glb_func_chkvl($dchkval);
		$del        =  explode(',',$did);
		$count      =  sizeof($del);
		$smlimg     =  array();
		$smlimgpth  =  array();
		$bnrimg      =  array();
		$bnrimgpth   =  array();
		for($i=0;$i<$count;$i++){	
		 $sqryprodcat_mst="select 
							   prodcatm_smlimg,prodcatm_bnrimg
						   from 
							   prodcat_mst
						   where
							   prodcatm_id=$del[$i]";				 				 				 				 			
		 $srsprodcat_mst     = mysqli_query($conn,$sqryprodcat_mst);
		 $srowprodcat_mst    = mysqli_fetch_assoc($srsprodcat_mst);		     			   				
	     $smlimg[$i]      = glb_func_chkvl($srowprodcat_mst['prodcatm_smlimg']);
	     $smlimgpth[$i]   = $gadmcatsml_upldpth.$smlimg[$i];
		 $bnrimg[$i]       = glb_func_chkvl($srowprodcat_mst['prodcatm_bnrimg']);
	     $bnrimgpth[$i]    = $gadmcatbnr_upldpth.$bnrimg[$i];			 
	    }						
		$delsts = funcDelAllRec('prodcat_mst','prodcatm_id',$did);
		if($delsts == 'y'){
		     for($i=0;$i<$count;$i++){				     	         
				 if(($smlimg[$i] != "") && file_exists($smlimgpth[$i])){
					unlink($smlimgpth[$i]);
				 }
				 if(($bnrimg[$i] != "") && file_exists($bnrimgpth[$i])){
					unlink($bnrimgpth[$i]);
				 }
			 } 
			 $msg   = "<font color=#fda33a>Record deleted successfully</font>";
		}
		elseif($delsts == 'n'){
			$msg  = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
		}
    }
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
		$msg = "<font color=#fda33a>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
		$msg = "<font color=#fda33a>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
	    $msg = "<font color=#fda33a>Duplicate Recored Name Exists & Record Not updated</font>";
	}		
    $rowsprpg  = 20;//maximum rows per page
	include_once  "../includes/inc_paging1.php";//Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<?php include_once  'script.php'; ?>
	<script language="javascript">
	function addnew(){
		document.frmproductcat.action="add_product_category.php";
		document.frmproductcat.submit();
	}	
	function validate(){	
		//alert("");  
	  var urlval="";
		if((document.frmproductcat.txtsrchval.value=="")){
			alert("Select Search Criteria");
			document.frmproductcat.txtsrchval.focus();
			return false;
		}
		var txtsrchval = document.frmproductcat.txtsrchval.value;
		//var lstcatid   = document.frmproductcat.lstcatid.value;
		//var lsttypid   = document.frmproductcat.lstsrchdlvrtyp.value;
		if(txtsrchval !=''){			
			urlval +="txtsrchval="+txtsrchval;
		}
		if(document.frmproductcat.chkexact.checked==true){
			document.frmproductcat.action="view_product_category.php?"+urlval+"&chkexact=y";
			document.frmproductcat.submit();
		}
		else{ 
			document.frmproductcat.action="view_product_category.php?"+urlval;
			document.frmproductcat.submit();
		}
		return true;
	}	
  </script>
  <script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body onLoad="onload()">

<?php 
	 include_once('../includes/inc_adm_header.php');
	 include_once('../includes/inc_adm_leftlinks.php');
?>

<div class="clearfix"></div>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" ><table width="100%"  border="0" cellspacing="0" align='center' cellpadding="0" bgcolor="#FFFFFF">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif"  
		style="background-position:top; background-repeat:repeat-x; ">
          <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmproductcat" id="frmproductcat">
            <input type="hidden" name="hidchkval" id="hidchkval">
            <input type="hidden" name="hidchksts" id="hidchksts">
			<input type="hidden" name="hdnallval" id="hdnallval">
            <?php /*?><table width="100%"  border="0" cellspacing="0" cellpadding="3" align='center' >
               <tr align="left" bgcolor="#333333">
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>:: Product Category </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
			  <tr>
                <td width="91%">
                  <table width="100%">
                    <tr>
                      <td width="20%"><strong>Search By Name</strong></td>
                      <td width="37%">
                        <div id="div1" style="display:block">
                          <input type="text" name="txtsrchval" value="<?php 
							  if(isset($_REQUEST['txtsrchval']) && ($_REQUEST['txtsrchval']!="")){
								 echo $_REQUEST['txtsrchval'];
							  }
							 
							   ?>">
                          Exact
                          <input type="checkbox" name="chkexact" value="y"<?php 						  
								if(isset($_REQUEST['chkexact']) && ($_REQUEST['chkexact']=='y')){
									echo 'checked';
								}														  						  
							  ?>>
                        </div></td>
                      <td width="43%">
					  	<input name="button" type="button"  class='' onClick="srch()" value="Search" >
                        <a href="view_product_category.php" class="leftlinks"><strong>Refresh</strong></a>						                          </td>
                      </tr>
                    </table> 
                  </td>
                <td width="9%" align="right">
                  <input name="btn" type="button" class="" value="&laquo; Add" onClick="addnew()">						
                  </td>
                </tr>
              </table><?php */?>
			  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
               <tr align="left" class="white">
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>:: Vehicle Brand </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
			  <tr>
                <td width="91%">
                  <table width="100%">
						<tr>
						 	 <td width='20%'><strong> Name</strong></td>
							<td width="40%">
				  				<input type="text" name="txtsrchval" value="<?php if(isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval']!=""){echo $_REQUEST['txtsrchval'];}?>" id="txtsrchval">
						</td>
						<td colspan='2' align="center"> 
						Exact
								<input type="checkbox" name="chkexact" value="y"<?php 						  
								if(isset($_REQUEST['chkexact']) && (glb_func_chkvl($_REQUEST['chkexact'])=='y')){
									echo 'checked';
								}																  						  
								?> id="chkexact">	 
				   			<input type="submit" value="Search"  name="btnsbmt" onClick="validate();">
					      	<a href="view_product_category.php" class="leftlinks"><strong>Refresh</strong></a>
							<input name="btn" type="button" class="" value="&laquo; Add" onClick="addnew()">		
						</td>
					  </tr>
				</table>				
				</td>                
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7" align="center">
              <tr>
                <td bgcolor="#FFFFFF" colspan="4">&nbsp;</td>                
                <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF">
                  <input name="btnsts" id="btnsts" class="" type="button"  value="Status" onClick="updatests('hidchksts','frmproductcat','chksts')">
				</td>                
                <td width="7%" align="center"   valign="bottom" bgcolor="#FFFFFF" >
                  <input name="btndel" id="btndel" type="button" class="" value="Delete" onClick="deleteall('hidchkval','frmproductcat','chkdlt');" >
				</td>                
              </tr>
			  <?php
			  	if($msg != ""){
					$dispmsg = "<tr><td colspan='9' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
					echo $dispmsg;				
				}	
			  ?>
              <tr class="white">
                <td width="7%" bgcolor="#FF543A" align="left"><strong>SL.No.</strong></td>
                <td width="21%" bgcolor="#FF543A" align="left"><strong>Name</strong></td>
				<?php /*?><td width="16%" bgcolor="#FF543A" align="left"><strong>Home Image</strong></td>
                <td width="16%" bgcolor="#FF543A" align="left"><strong>Icon Image</strong></td><?php */?>
				<td width="9%" align="center" bgcolor="#FF543A"><strong>Rank</strong></td>
				             
                <td width="6%" bgcolor="#FF543A" align="center"><strong>Edit</strong></td>
                <td width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmproductcat.chksts,'Check_ctr','hdnallval')"></strong></td>
                <td width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmproductcat.chkdlt,'Check_dctr')"><b></b> 
                  </strong></td> 
                </tr>
              <?php
				$sqryprodcat_mst1="select 
									  	prodcatm_id,prodcatm_name,prodcatm_sts,prodcatm_smlimg,
										prodcatm_bnrimg,prodcatm_prty,prodcatm_hmprty
							       from 
								   		prodcat_mst
									where
										prodcatm_id !=''";										
				if(isset($_REQUEST['lstcatid']) && (trim($_REQUEST['lstcatid']) != '')){
					$lstcatid = glb_func_chkvl($_REQUEST['lstcatid']);
					$loc = "&lstcatid=".$lstcatid;
					$sqryprodcat_mst1.=" and taxm_id = '$lstcatid'";
				}	
				if(isset($_REQUEST['lsttypid']) && (trim($_REQUEST['lsttypid']) != '')){
					$lsttypid = glb_func_chkvl($_REQUEST['lsttypid']);
					$loc .= "&lsttypid=".$lsttypid;
					$sqryprodcat_mst1.=" and prodcatm_dlvrtyp = '$lsttypid'";
				}			
				if(isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) !=''){
					$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
					$loc .= "&txtsrchval=".$txtsrchval;
					$fldnm =" and prodcatm_name";
					if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
						  $loc  .="&chkexact=y";
						  $sqryprodcat_mst1 .= " $fldnm ='$txtsrchval'";
					}
					else{
						  $sqryprodcat_mst1 .= " $fldnm like '%$txtsrchval%'";
					}
				}
				$sqryprodcat_mst=$sqryprodcat_mst1." order by prodcatm_name asc limit $offset,$rowsprpg";
				$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
				$cnt_recs          = mysqli_num_rows($srsprodcat_mst);
				$cnt = $offset;
				if($cnt_recs > 0){
				while($srowprodcat_mst=mysqli_fetch_assoc($srsprodcat_mst)){
					$cnt+=1;
					$pgval_srch	= $pgnum.$loc;
					$db_catid	= $srowprodcat_mst['prodcatm_id'];
					$db_catname	= $srowprodcat_mst['prodcatm_name'];
					$db_prty	= $srowprodcat_mst['prodcatm_prty'];
					$db_sts		= $srowprodcat_mst['prodcatm_sts'];
			  ?>
              <tr <?php if($cnt%2==0){echo "bgcolor='f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
                <td align="left" valign="top"><?php echo $cnt;?></td>
                <td align="left" valign="top">
                  <a href="view_detail_product_category.php?vw=<?php echo $db_catid;?>&pg=<?php 
					echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $db_catname;?></a></td>
                <?php /*?> <td align="center" valign="top"><?php
			   		$imgnm   = $srowprodcat_mst['prodcatm_smlimg'];
			  		$imgpath = $gadmcatsml_upldpth.$imgnm;
     			    if(($imgnm !="") && file_exists($imgpath))	{
				  		echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
			   		}
			   		else{
				  		echo "Image not available";						 			  
			   		}
				?>				
				</td>	                
               <td align="center" valign="top"><?php
					$imgnm   = $srowprodcat_mst['prodcatm_bnrimg'];
					$imgpath = $gadmcatbnr_upldpth.$imgnm;
					if(($imgnm !="") && file_exists($imgpath)){
						echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					 
					}
					else{
						echo "Image not available";						 			  
					}
				?>		
				</td><?php */?>
				<td align="right" valign="top"><?php echo $db_prty;?></td>	
			    <td align="center" valign="top">
                  <a href="edit_product_category.php?vw=<?php echo $db_catid;?>&pg=<?php 
					echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks">Edit</a></td>
                <td align="center" valign="top">
                  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo $srowprodcat_mst['prodcatm_id'];?>" <?php if($srowprodcat_mst['prodcatm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowprodcat_mst['prodcatm_id'];?>,'hidchksts','frmproductcat','chksts');">				</td>
                <td align="center" valign="top">
                  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $srowprodcat_mst['prodcatm_id'];?>"></td>
                </tr>              
              <?php
			  	  }
			   }else{
			   		echo $msg="<tr bgcolor='#F2F1F1'><td colspan='9' align='center'>
									<font color='#fda33a'>No Records Found</font>
							   </td></tr>";
			   }					
				?>
				<tr>
                 <td bgcolor="#FFFFFF" colspan="4">&nbsp;</td>                
                 <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF">
                  <input name="btnsts" id="btnsts"  class="" type="button"  value="Status" onClick="updatests('hidchksts','frmproductcat','chksts')">
                 </td>                
                 <td width="7%" align="center"   valign="bottom" bgcolor="#FFFFFF">
                  <input name="btndel" id="btndel" type="button" class="" value="Delete" onClick="deleteall('hidchkval','frmproductcat','chkdlt');">                  
                  </td>                
                </tr>
				<?php
				$disppg = funcDispPag('links',$loc,$sqryprodcat_mst1,$rowsprpg,$cntstart, $pgnum, $conn);					
				$colspanval = '9';	
				if($disppg != ""){	
					$disppg = "<br><tr><td colspan='$colspanval' align='center' bgcolor='#F2F1F1'>$disppg</td></tr>";
					echo $disppg;
				}		
			  ?>			  
              </table>            
            </form><br>
        </td>
      </tr>      
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php"; ?>
</body>
</html>