<?php
	include_once "../includes/inc_nocache.php";          //Clearing the cache information
	include_once "../includes/inc_adm_session.php";      //checking for session
	include_once "../includes/inc_connection.php";       //Making database Connection
	include_once "../includes/inc_usr_functions.php";    //Use function for validation and more	
	include_once "../includes/inc_paging_functions.php"; //Making paging validation
	include_once "../includes/inc_folder_path.php";
	include_once "../includes/inc_config.php";	
	/***************************************************************/
	//Programm 	  		: view_all_size.php	
	//Purpose 	  			: For Viewing Sizes
	//Created By  		: Mallikarjuna
	//Created On  		:	16/04/2013
	//Modified By 		:  Aradhana
	//Modified On   	: 07-06-2014
	//Company 	  		: Adroit
	/************************************************************/	
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg;	
	if(($_POST['hdnchksts']!="") && isset($_REQUEST['hdnchksts']) ||
	   isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!="")){
			$dchkval = substr($_POST['hdnchksts'],1);
			$id  	 = glb_func_chkvl($dchkval);	
			$chkallval	=  glb_func_chkvl($_POST['hdnallval']);	
			$updtsts = funcUpdtAllRecSts('trtyp_mst','trtypm_id',$id,'trtypm_sts',$chkallval);		
			if($updtsts == 'y'){
				$msg = "<font color=#fda33a>Record updated successfully</font>";
			}
			elseif($updtsts == 'n'){
				$msg = "<font color=#fda33a>Record not updated</font>";
			}
	}
	if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval'])){
			$dchkval = substr($_POST['hdnchkval'],1);
			$did 	= glb_func_chkvl($dchkval);			
			$delsts = funcDelAllRec('trtyp_mst','trtypm_id',$did);	
			if($delsts == 'y'){
				$msg = "<font color=#fda33a>Record deleted successfully</font>";
			}
			elseif($delsts == 'n'){
				$msg = "<font color=#fda33a>Record can't be deleted(child records exist)</font>";
			}
    }			
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='y')){
	    $msg = "<font color=#fda33a>Record updated successfully</font>";
	}
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == 'n')){
			$msg = "<font color=#fda33a>Record not updated</font>";
	}
    if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='d')){
	    $msg = "<font color=#fda33a>Duplicate Recored Name Exists ,Record Not updated</font>";
	}		
	$rowsprpg  = 20;//maximum rows per page	
	include_once "../includes/inc_paging1.php";//Includes pagination

	/*$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);	
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary)){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
	*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<?php include_once ('script.php');?>
	<script language="javascript">
		function addnew()
		{
			document.frmsize.action="add_size.php";
			document.frmsize.submit();
		}
	</script>
	<script language="javascript">	
       function onload()
		{
		    document.getElementById('txtsrchval').focus();
		}
		function srch()
		{
			if(document.frmsize.txtsrchval.value=="")
			{
				alert("Please Enter Size");
				document.frmsize.txtsrchval.focus();
				return false;
			}
			var val=document.frmsize.txtsrchval.value;
			if(document.frmsize.chkexact.checked==true)
			{
				document.frmsize.action="view_all_size.php?val="+val+"&chk=y";
				document.frmsize.submit();
			}
			else
			{
				document.frmsize.action="view_all_size.php?val="+val;
				document.frmsize.submit();
			}
		}
</script>
<link href="docstyle.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body onLoad="onload()">
<?php include_once ('../includes/inc_adm_header.php');
	  include_once('../includes/inc_adm_leftlinks.php');
?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
     <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="admcnt_bdr">
      <tr>
        <td width="7" height="30" valign="top"></td>
        <td width="700" height="325" rowspan="2" valign="top" bgcolor="#FFFFFF" class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
			
          <form method="post" action="<?php $_SERVER['SCRIPT_FILENAME']; ?>" name="frmsize" id="frmsize">
            <input type="hidden" name="hdnchkval" id="hdnchkval">
            <input type="hidden" name="hdnchksts" id="hdnchksts">
			<input type="hidden" name="hdnallval" id="hdnallval">
            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
               <tr align="left" class='white'>
                  <td height="30" colspan="5" bgcolor="#FF543A">
				 <span class="heading"><strong>:: Vehicle Type </strong></span>&nbsp;&nbsp;&nbsp;</td>
                </tr>	
			  <tr>
                <td width="91%">
                  <table width="100%">
                    <tr>
                      <td width="20%"><strong>Name </strong></td>
                      <td width="37%">
                        <div id="div1" style="display:block">
                          <input type="text" name="txtsrchval" value="<?php 
						  if(isset($_POST['txtsrchval']) && (trim($_POST['txtsrchval'])!="") )
						  {
						  	echo $_POST['txtsrchval'];
						  }
						  elseif(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="") ) 
						  {
						     echo $_REQUEST['val'];
						  }
						?>">
                          Exact
                          <input type="checkbox" name="chkexact" value="1"<?php 						  
						  	if(isset($_POST['chkexact'])  &&   (trim($_POST['chkexact'])==1) ) 
							{
								echo 'checked';
							}
							elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y') )
							{
								echo 'checked';							
							}						  						  
						  ?>>
                        </div>	 </td>
                      <td width="43%"><input name="button" type="button" class="" onClick="srch()" value="Search" $>
                        <a href="view_all_size.php" class="leftlinks"><strong>Refresh</strong></a>						                           </td>
                      </tr>
                    </table> 
                  </td>
                <td width="9%" align="right">
                  <?php						
					//if(($rqst_stp_attn[1]=='2') || ($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
						echo '<input name="btn" type="button" class="" value="&laquo; Add" onClick="addnew()">';		
					//}				
					?>										
                  </td>
                </tr>
              </table>
            <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
              <tr>
                <td bgcolor="#FFFFFF" colspan="3">&nbsp;</td>
                <?php
					//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
				?>
				<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF"><div align="right">
                  <input name="btnsts" id="btnsts" type="button"  class="" value="Status" onClick="updatests('hdnchksts','frmsize','chksts')">
                  </div></td>
                 <?php
					//}
					//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
				?>
				<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF" ><div align="right">
                  <input name="btndel" id="btndel" type="button"  class="" value="Delete" onClick="deleteall('hdnchkval','frmsize','chkdlt');" >
                  </div></td>
                <?php
				//}
				?>
				</tr>
				<?php
					if($msg != ""){
					$dispmsg = "<tr bgcolor='#f0f0f0'><td colspan='5' align='center' bgcolor='#f0f0f0'>$msg</td></tr>";
					echo $dispmsg;				
				}
				?>
              <tr class="white">
                <td  width="6%" bgcolor="#FF543A" align="left"><strong>SL.No</strong></td>
                <td  width="60%" bgcolor="#FF543A" align="left"><strong>Name</strong></td>
                <td  width="20%" bgcolor="#FF543A" align="center"><strong>Rank</strong></td>				
                <?php
					//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
				?>
				<td  width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmsize.chksts,'Check_ctr','hdnallval')"></strong></td>
                <?php
					//}
					//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
				?>
				<td width="7%" bgcolor="#FF543A" align="center"><strong>
                  <input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmsize.chkdlt,'Check_dctr')"><b></b> 
                  </strong></td>				
                <?php
				//}
				?>
				</tr>
			  <?php
				
				$sqrytrtyp_mstt="select
				                   trtypm_id,trtypm_name,trtypm_sts,trtypm_prty								  		    
							    from 
								   trtyp_mst";
				if(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="")){
					$val = glb_func_chkvl($_REQUEST['val']);
					if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y')){
						$loc = "&opt=n&val=".$val."&chk=y";
						$sqrytrtyp_mstt.=" where trtypm_name='$val'";
					}
					else{
						$loc = "&opt=n&val=".$val;
						$sqrytrtyp_mstt.=" where trtypm_name like '%$val%'";
					}
				}
				$sqrytrtyp_mst=$sqrytrtyp_mstt." order by trtypm_name
							                   limit $offset,$rowsprpg";
				$srstrtyp_mst = mysqli_query($conn,$sqrytrtyp_mst);
			  	$cnt = $offset;
				$serchres=mysqli_num_rows($srstrtyp_mst);
				if($serchres=='0'){
			       $msg = "<font color=#fda33a>Record  Not  Found </font>";
				}
				while($srowtrtyp_mst=mysqli_fetch_assoc($srstrtyp_mst)){
					$cnt+=1;
					$sizeid    =$srowtrtyp_mst['trtypm_id'];
					$sizename  =$srowtrtyp_mst['trtypm_name'];
					$sizests   =$srowtrtyp_mst['trtypm_sts'];	
					$sizeprty  =$srowtrtyp_mst['trtypm_prty'];				
			  ?>
              <tr <?php if($cnt%2==0){echo "bgcolor='f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
                <td><?php echo $cnt;?></td>
                <td>
                  <a href="view_size_detail.php?edit=<?php echo $sizeid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks"><?php echo $sizename; ?>
                    </a>
                  </td>							
                <td align="right"><?php echo $sizeprty;?></td>				
                <?php
					//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
				?>
				<td align="center">
                  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo $sizeid;?>" <?php if($sizests=='a') { echo "checked";}?> onClick="addchkval(<?php echo $sizeid;?>,'hdnchksts','frmsize','chksts');">				</td>
                <?php
					//}
					//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
				?>
				<td align="center">
                  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $sizeid;?>"></td>			
                <?php
				//}
				?>
				</tr>
              <?php
			  	}	
				?>
				  <tr>
                <td bgcolor="#FFFFFF" colspan="3">&nbsp;</td>
                <?php
					//if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
				?>
				<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF"><div align="right">
                  <input name="btnsts" id="btnsts" type="button"  class="" value="Status" onClick="updatests('hdnchksts','frmsize','chksts')">
                  </div></td>
                <?php
					//}
					//if(($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){	
				?>
				<td width="7%" align="right" valign="bottom" bgcolor="#FFFFFF" ><div align="right">
                  <input name="btndel" id="btndel" class="" type="button"  value="Delete" onClick="deleteall('hdnchkval','frmsize','chkdlt');" >                 </div></td>
                <?php
				//}
				?>
				</tr>
				<?php				
				$disppg = funcDispPag('paging',$loc,$sqrytrtyp_mstt,$rowsprpg,$cntstart, $pgnum, $conn);				
				$colspanval = '5';
				if($disppg != ""){	
					$disppg = "<br><tr bgcolor='#f0f0f0'><td colspan='$colspanval' align='center'>$disppg</td></tr>";
					echo $disppg;
				}				
								
			  ?>
            			  
              </table>
            </form><br>
        </td>
      </tr>
      <tr>
        <td align="right" background="images/content_footer_bg.gif"></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>