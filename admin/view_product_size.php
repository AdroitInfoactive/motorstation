<?php
	include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once  "../includes/inc_adm_session.php";//checking for session
	include_once  "../includes/inc_connection.php";//Making database Connection
	include_once  "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once  "../includes/inc_paging_functions.php";//Making paging validation
	include_once  "../includes/inc_config.php";	
	include_once "../includes/inc_folder_path.php";	
	//include_once 'searchpopcalendar.php';	
	/***************************************************************
	Programm 	  : view_product_size.php	
	Purpose 	  : For Viewing product SubCategory  Details
	Created By    : Mallikarjuna
	Created On    :	30/10/2013
	Modified By   : Aradhana
	Modified On   : 20-01-2014
	Purpose 	  : 
	Company 	  : Adroit
	************************************************************/
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
	$loc = "";
	if(isset($_REQUEST['hidchksts']) && (trim($_POST['hidchksts']) !="") ||
	   isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!="")){
		 $dchkval = substr($_POST['hidchksts'],1);
		 $id  	 = glb_func_chkvl($dchkval);	
		 $chkallval	=  glb_func_chkvl($_POST['hdnallval']);			
		 $updtsts = funcUpdtAllRecSts('size_mst','sizem_id',$id,'sizem_sts',$chkallval);	
		 if($updtsts == 'y'){
			$msg = "<font color=#fda33a>Record updated successfully</font>";
		 }
		 elseif($updtsts == 'n'){
			$msg = "<font color=#fda33a>Record not updated</font>";
		 }
	}	
	if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval'])){
			$dchkval    =  substr($_POST['hidchkval'],1);
			$did 	    =  glb_func_chkvl($dchkval);
			$del        =  explode(',',$did);
			$count      =  sizeof($del);
			$simg        =  array();
			$simgpth     =  array();
			$bimg        =  array();
			$bimgpth     =  array();
			for($i=0;$i<$count;$i++){	
			    $sqryscat_mst="select 
			                       sizem_szchrtimg,sizem_icnimg
							    from 
					               size_mst
					            where
					                sizem_id=$del[$i]";				 				 				 				 			
			     $srsscat_mst     = mysqli_query($conn,$sqryscat_mst);
			     $srowscat_mst    = mysqli_fetch_assoc($srsscat_mst);		     			   				
		         $simg[$i]        = glb_func_chkvl($srowscat_mst['sizem_szchrtimg']);
		         $simgpth[$i]     = $gszchrt_upldpth.$simg[$i];
				 $bimg[$i]        = glb_func_chkvl($srowscat_mst['sizem_icnimg']);
		         $bimgpth[$i]     = $gicnimg_upldpth.$simg[$i];
			}						
			$delsts   =   funcDelAllRec('size_mst','sizem_id',$did);
			if($delsts == 'y'){
			     for($i=0;$i<$count;$i++){				     	         
					 if(($simg[$i] != "") && file_exists($simgpth[$i])){
						unlink($simgpth[$i]);
					 }
					  if(($bimg[$i] != "") && file_exists($bimgpth[$i])){
						unlink($bimgpth[$i]);
					 }					
				 } 
				 $msg   = "<font color=#fda33a>Record deleted successfully</font>";
			}
			elseif($delsts == 'n'){
				$msg  = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
			}
    	}
	/*if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval']))
		{
			$dchkval    =  substr($_POST['hidchkval'],1);
			$did 	    =  glb_func_chkvl($dchkval);
			$delsts   =   funcDelAllRec('size_mst','sizem_id',$did);
			if($delsts == 'y')
			{
				 $msg   = "<font color=#fda33a>Record deleted successfully</font>";
			}
			elseif($delsts == 'n')
			{
				$msg  = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
			}
    	}*/
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
	{
			$msg = "<font color=#fda33a>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
	{
			$msg = "<font color=#fda33a>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
	{
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
		document.frmprodsubcat.action="add_product_size.php";
		document.frmprodsubcat.submit();
	}
	function validate(){	
		//alert("");  
	  var urlval="";
		if((document.frmprodsubcat.txtsrchval.value=="") && (document.frmprodsubcat.lstcatid.value=="")){
			alert("Select Search Criteria");
			document.frmprodsubcat.txtsrchval.focus();
			return false;
		}
		var txtsrchval = document.frmprodsubcat.txtsrchval.value;
		var lstcatid   = document.frmprodsubcat.lstcatid.value;
		if(lstcatid !=''){
			urlval="lstcatid="+lstcatid;
		}
		if(txtsrchval !=''){			
			urlval +="txtsrchval="+txtsrchval;
		}
		
		if(document.frmprodsubcat.chkexact.checked==true){
			document.frmprodsubcat.action="view_product_size.php?"+urlval+"&chkexact=y";
			document.frmprodsubcat.submit();
		}
		else{ 
			document.frmprodsubcat.action="view_product_size.php?"+urlval;
			document.frmprodsubcat.submit();
		}
		return true;
	}	
 </script>
 <script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body>
<?php include_once '../includes/inc_adm_header.php';	
	include_once  '../includes/inc_adm_leftlinks.php'; ?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" background="images/content_topbg.gif" bgcolor="#FFFFFF" 
		 style="background-position:top; background-repeat:repeat-x; ">
          
          <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmprodsubcat" id="frmprodsubcat">
            <input type="hidden" name="hidchkval" id="hidchkval">
            <input type="hidden" name="hidchksts" id="hidchksts">
			<input type="hidden" name="hdnallval" id="hdnallval">
            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
               <tr align="left" class="white">
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>::  Tyre Size </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>
			  <tr>
                <td width="91%">
                  <table width="100%">
						<tr>
						  	<td width='15%'><strong>Vehicle Type </strong></td>
							<td width='10%'>
								<?php
								 $sqrytrtyp_mst= "select 
														trtypm_id,trtypm_name						
													from 
														vw_trtyp_size_mst
													group by
														trtypm_id
													order by 
														trtypm_name";
								 $rstrtyp_mst  =  mysqli_query($conn,$sqrytrtyp_mst);
								 $cnt_trtyp    =  mysqli_num_rows($rstrtyp_mst);					
							   ?>
								  <select name="lstcatid" id="lstcatid">
									<option value="">--Select--</option>
									  <?php
									   if($cnt_trtyp > 0){
										 while($rowstrtyp_mst=mysqli_fetch_assoc($rstrtyp_mst)){	  
											 $catid   =$rowstrtyp_mst['trtypm_id'];	  
											 $catname =$rowstrtyp_mst['trtypm_name'];
									   ?>
									<option value="<?php echo $catid;?>"<?php if(isset($_REQUEST['lstcatid']) && trim($_REQUEST['lstcatid'])==$catid){echo 'selected';}?>><?php echo $catname;?></option>
									<?php }}?>
								</select>
							</td>
							 <td width='8%'><strong> Name</strong></td>
							<td width="10%">
				  				<input type="text" name="txtsrchval" value="<?php if(isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval']!=""){echo $_REQUEST['txtsrchval'];}?>" id="txtsrchval">
						</td>
						<td colspan='2' align="right"> 
						Exact
								<input type="checkbox" name="chkexact" value="y"<?php 						  
								if(isset($_REQUEST['chkexact']) && (glb_func_chkvl($_REQUEST['chkexact'])=='y')){
									echo 'checked';
								}																  						  
								?> id="chkexact">	 
				   			<input type="submit" value="Search"  name="btnsbmt" onClick="validate();">
					      	<a href="view_product_size.php" class="leftlinks"><strong>Refresh</strong></a>
							<input name="btn" type="button" class="" value="&laquo; Add" onClick="addnew()">		
						</td>
					  </tr>
				</table>				
				</td>                
              </tr>
            </table>                   
            <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
              <tr>
                <td bgcolor="#FFFFFF" colspan="5">&nbsp;</td>                
                <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF">
                  <input name="btnsts" id="btnsts" class='' type="button"  value="Status" onClick="updatests('hidchksts','frmprodsubcat','chksts','hdnallval')">
                 </td>                
                <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF" >
                  <input name="btndel" id="btndel" class=''  type="button"  value="Delete" onClick="deleteall('hidchkval','frmprodsubcat','chkdlt');">
				  </td>                
              </tr>
				<?php
				  if($msg != ""){
					$dispmsg = "<tr><td colspan='9' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
					echo $dispmsg;				
				  }	
				?>
              <tr class="white">
                <td width="8%" bgcolor="#FF543A" align="left"><strong>SL.No.</strong></td>				
                <td width="28%" bgcolor="#FF543A" align="left"><strong>Name</strong></td>
                <td width="24%" bgcolor="#FF543A" align="left"><strong>Vehicle Type </strong></td>
				 <?php /*?><td width="10%" bgcolor="#FF543A" align="left"><strong>Image</strong></td><?php */?>
				<td width="6%" align="center" bgcolor="#FF543A"><strong>Rank</strong></td>
                <td width="7%" align="center" bgcolor="#FF543A"><strong>Edit</strong></td>
                <td width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmprodsubcat.chksts,'Check_ctr','hdnallval')"></strong></td>
                <td width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmprodsubcat.chkdlt,'Check_dctr')"><b></b> 
                  </strong></td>			
                </tr>
              <?php
				$sqrysize_mst1="select 
									sizem_id,sizem_name,sizem_sts,sizem_prty,									
									sizem_szchrtimg,sizem_trtypm_id,trtypm_name,trtypm_id
								from 
									size_mst inner join trtyp_mst 
									on sizem_trtypm_id= trtypm_id
								where
									sizem_id !=''";											
				if(isset($_REQUEST['lstcatid']) && (trim($_REQUEST['lstcatid']) != '')){
					$lstcatid = glb_func_chkvl($_REQUEST['lstcatid']);
					$loc = "&lstcatid=".$lstcatid;
					$sqrysize_mst1.=" and sizem_trtypm_id = '$lstcatid'";
				}			
				if(isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) !=''){
					$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
					$loc .= "&txtsrchval=".$txtsrchval;
					$fldnm =" and sizem_name";
					if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
						  $loc  .="&chkexact=y";
						  $sqrysize_mst1 .= " $fldnm ='$txtsrchval'";
					}
					else{
						  $sqrysize_mst1 .= " $fldnm like '%$txtsrchval%'";
					}
				}
				/*if(trim($_REQUEST['txttofrmdt']) != ''){
					$txttofrmdt	= glb_func_chkvl(trim($_REQUEST['txttofrmdt']));												
					if(isset($_REQUEST['txttotodt']) && (trim($_REQUEST['txttotodt']) != '')){
						$txttotodt = glb_func_chkvl(trim($_REQUEST['txttotodt']));
						$sqrysize_mst1.="  and date(sizem_todt) between '$txttofrmdt' and '$txttotodt'";
						$loc .= "&txttofrmdt=$txttofrmdt&txttotodt=$txttotodt";
					}
					else{
						$sqrysize_mst1.="  and date(sizem_todt) = '$txttofrmdt'";	
						$loc .= "&txttofrmdt=$txttofrmdt";																		
					}
				 }*/		
				//$sqrysize_mst1 = $sqrysize_mst1.$sqrysize_mst2;
				$sqrysize_mst=$sqrysize_mst1."  order by trtypm_name,sizem_name limit $offset,$rowsprpg";
				$srssize_mst = mysqli_query($conn,$sqrysize_mst);
				$cnt_recs          = mysqli_num_rows($srssize_mst);
				$cnt = $offset;
				if($cnt_recs > 0){
				while($srowsize_mst=mysqli_fetch_assoc($srssize_mst)){
					$cnt+=1;
					$pgval_srch	= $pgnum.$loc;
					$db_subid	= $srowsize_mst['sizem_id'];
					$db_subname	= $srowsize_mst['sizem_name'];
					$db_catname	= $srowsize_mst['trtypm_name'];
					$db_prty	= $srowsize_mst['sizem_prty'];
					$db_sts		= $srowsize_mst['sizem_sts'];
					$db_szchrt	= $srowsize_mst['sizem_szchrtimg'];
					//$db_todt	= $srowsize_mst['sizem_todt'];				
			  ?>
              <tr <?php if($cnt%2==0){echo "bgcolor='f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
                <td align="left"><?php echo $cnt;?></td>
                <td align="left">
                  <a href="view_detail_product_size.php?vw=<?php echo $db_subid;?>&pg=<?php 
					echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $db_subname;?></a></td>
                <td align="left"><?php echo $db_catname;?></td>
				<?php /*?><td align="left">
				<?php 
				   $imgnm   = $db_szchrt;
				   $imgpath = $gszchrt_upldpth.$imgnm;
				   if(($imgnm !="") && file_exists($imgpath)){
					  echo "<img src='$imgpath' width='50pixel' height='50pixel'>";					
				   }
				   else{
					  echo "NA";						 				  
				   }
				?>
				</td><?php */?>
			    <td align="right"><?php echo $db_prty;?></td>	
                <td align="center">
                  <a href="edit_product_size.php?vw=<?php echo $db_subid;?>&pg=<?php 
					echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks">Edit</a></td>
                
                <td align="center">
                  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo $srowsize_mst['sizem_id'];?>" <?php if($srowsize_mst['sizem_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowsize_mst['sizem_id'];?>,'hidchksts','frmprodsubcat','chksts');">				</td>
                <td align="center">
                  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $srowsize_mst['sizem_id'];?>">
				</td>                
              </tr>
              <?php
			  	  }	
				}				
				else{
					echo $msg="<tr bgcolor='#F2F1F1'><td colspan='9' align='center'>
									<font color='#fda33a'>No Records Found</font>
							   </td></tr>";
				}
				?>
			  <tr>
				 <td bgcolor="#FFFFFF" colspan="5">&nbsp;</td>                
				 <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF">
				  <input name="btnsts" id="btnsts" class='' type="button"  value="Status" onClick="updatests('hidchksts','frmprodsubcat','chksts','hdnallval')">
				 </td>                
				 <td width="7%" align="center" valign="bottom" bgcolor="#FFFFFF">
				  <input name="btndel" id="btndel" class='' type="button"  value="Delete" onClick="deleteall('hidchkval','frmprodsubcat','chkdlt');">                  
                 </td>                
               </tr>
				<?php				
				$disppg = funcDispPag('links',$loc,$sqrysize_mst1,$rowsprpg,$cntstart, $pgnum, $conn);					
				$colspanval = '9';												
				if($disppg != ""){	
					$disppg = "<br><tr><td colspan='$colspanval' align='center' bgcolor='#F2F1F1'>$disppg</td></tr>";
					echo $disppg;
				}							
			  ?>			  
              </table></form><br>
        </td>
      </tr>     
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php"; ?>
</body>
</html>