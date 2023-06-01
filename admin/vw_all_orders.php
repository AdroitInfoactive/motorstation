<?php
	include_once "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once "../includes/inc_paging_functions.php";//Making paging validation
	include_once  "../includes/inc_config.php";		
	include_once 'searchpopcalendar.php';	
	/**********************************************************
	Programm 	  : vw_all_orders.php	
	Company 	  : Adroit
	************************************************************/
	
	global $msg,$loc,$disppg,$dispmsg;
	// if(isset($_REQUEST["sts"]) && (trim($_REQUEST["sts"]) != "") &&
	//    isset($_REQUEST["ordid"]) && (trim($_REQUEST["ordid"]) != "")){	   
	// 	$ordsts = glb_func_chkvl($_REQUEST["sts"]);
	// 	$id  	= glb_func_chkvl($_REQUEST["ordid"]);				
	// 	$updtsts = funcUpdtRecSts($conn,"crtord_mst","crtordm_id",$id,"crtordm_cartsts",$ordsts);		
	// 	if($updtsts == "y"){
	// 		$msg = "<font color='#fda33a'>Enquiry deleted successfully</font>";
	// 	}
	// 	elseif($updtsts == "n"){
	// 		$msg = "<font color='#fda33a'>Enquiry not deleted</font>";
	// 	}		
	// }

	if(isset($_REQUEST["sts"]) && ($_REQUEST["sts"] != "")){	
		$did 		= glb_func_chkvl($_REQUEST["ordid"]);
		$mstdelsts	= funcDelRec($conn,"crtord_mst","crtordm_id",$did);
		//$dtldelsts 	= funcDelRec("crtord_dtl","crtordd_crtordm_id",$did);		
		if($mstdelsts == "y"){
			// &&($dtldelsts))
			$msg = "<font color=red>Record deleted successfully</font>";
		}
		elseif($delsts == "n"){
			$msg = "<font color=red>Record not deleted successfully</font>";
		}
	}
    $rowsprpg  = 20;//maximum rows per page
	include_once "../includes/inc_paging1.php";//Includes pagination		
	$sqrycrtord_mst1	= "select 
							   crtordm_id,date_format(crtordm_crtdon,'%d-%m-%Y %h:%i:%s') as crtordm_crtdon,
							   crtordm_email,crtordm_amt,crtordm_qty,crtordm_name
						   from 
							   crtord_mst 
						   where 
						   	   crtordm_cartsts !='d'";
	if(isset($_REQUEST['txtsrchno']) && (trim($_REQUEST['txtsrchno'])!="")){
	  $txtsrchno = glb_func_chkvl($_REQUEST['txtsrchno']);	
	  $loc .= "&txtsrchno=".$txtsrchno;
	  if(isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact'])=='y')){
			$sqrycrtord_mst1.=" and crtordm_id ='$txtsrchno'";
	  }
	  else{
			$sqrycrtord_mst1.=" and crtordm_id like '%$txtsrchno%'";
	  }		
	}
	if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){
	  $txtsrchnm = glb_func_chkvl($_REQUEST['txtsrchnm']);	
	  $loc .= "&txtsrchnm=".$txtsrchnm;
	  if(isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact'])=='y')){
			$sqrycrtord_mst1.=" and crtordm_name ='$txtsrchnm'";
	  }
	  else{
			$sqrycrtord_mst1.=" and crtordm_name like '%$txtsrchnm%'";
	  }		
	}				
	if(isset($_REQUEST['txtemailid']) && (trim($_REQUEST['txtemailid'])!="")){
	  $txtemailid = glb_func_chkvl($_REQUEST['txtemailid']);	
	  $loc .= "&txtemailid=".$txtemailid;
	  if(isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact'])=='y')){		  		 
			$sqrycrtord_mst1.=" and crtordm_email ='$txtemailid'";
	  }
	  else{
			$sqrycrtord_mst1.=" and crtordm_email like '%$txtemailid%'";
	  }		
	}		
	if(isset($_REQUEST['txtfrmdt']) && trim($_REQUEST['txtfrmdt']) != ''){
		$txtfrmdt	= glb_func_chkvl(trim($_REQUEST['txtfrmdt']));												
		if(isset($_REQUEST['txttodt']) && (trim($_REQUEST['txttodt']) != '')){
			$txttodt = glb_func_chkvl(trim($_REQUEST['txttodt']));				
			$sqrycrtord_mst1.="  and date(crtordm_crtdon) between '$txtfrmdt' and '$txttodt'";
			$loc .= "&txtfrmdt=$txtfrmdt&txttodt=$txttodt";
		}
		else{
			$sqrycrtord_mst1.="  and date(crtordm_crtdon) = '$txtfrmdt'";	
			$loc .= "&txtfrmdt=$txtfrmdt";																		
		}
	}	
	if(isset($_REQUEST['chkexact']) && (trim($_REQUEST['chkexact'])!="")){
		$chkexact = glb_func_chkvl($_REQUEST['chkexact']);
		$loc .= "&chkexact=".$chkexact;
	}
    $sqrycrtord_mst = $sqrycrtord_mst1." group by crtordm_id order by crtordm_id desc limit $offset,$rowsprpg";
	$srscrtord_mst= mysqli_query($conn,$sqrycrtord_mst);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<?php include_once ("script.php");?>
<script language="javascript">
	function validate(){	  
		  var urlval="";
		  var txtsrchno	  = document.frmsplradd.txtsrchno.value;		
		  var txtsrchnm   = document.frmsplradd.txtsrchnm.value;	
		  var txtemailid  = document.frmsplradd.txtemailid.value;		  	
		  var txtfrmdt 	  = document.frmsplradd.txtfrmdt.value; 
		  var txttodt  	  = document.frmsplradd.txttodt.value;
		  if((txtsrchno=="") && (txtsrchnm=="") && (txtemailid=="") && (txtfrmdt=="") && (txttodt=="")){
			alert("Select Search Criteria");
			document.frmsplradd.txtsrchno.focus();
			return false;
		  }	
		  if(txtsrchno !=''){
			urlval +="&txtsrchno="+txtsrchno;
		  }  
		  if(txtsrchnm !=''){
			urlval +="&txtsrchnm="+txtsrchnm;
		  }		 
		  if(txtemailid	!=''){
			urlval +="&txtemailid="+txtemailid;
		  }	
		  if(txtfrmdt !=''){
			urlval +="&txtfrmdt="+txtfrmdt;
		  }
		  if(txttodt !=''){
			urlval +="&txttodt="+txttodt;
		  }		
		  if(document.frmsplradd.chkexact.checked==true){
			document.frmsplradd.action="vw_all_orders.php?"+urlval+"&chkexact=y";
			document.frmsplradd.submit();
		  }
		  else{ 
			document.frmsplradd.action="vw_all_orders.php?"+urlval;
			document.frmsplradd.submit();
		  }
			return true;
	  }	
</script>
</head>
<body>
<?php 
	 include_once ("../includes/inc_adm_header.php");
	 include_once ("../includes/inc_adm_leftlinks.php"); 
?>
<table width="1000px"  border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td valign="top" height="400" align="center"><br>
            <form  method="post" enctype="multipart/form-data" name="frmsplradd" id="frmsplradd" onSubmit="return validate()">
			<table width="95%"  border="0" cellspacing="1" cellpadding="5">
				<tr align="left" >
				  	<td height="26" colspan="4" >
						<table width="95%" border="0">
                    <tr>	
					 <td width="11%" align="left"><strong>Enquiry No</strong></td>
					 <td width="22%" align="left"><input type="text" name="txtsrchno" value="<?php if(isset($_REQUEST["txtsrchno"]) && ($_REQUEST["txtsrchno"]!="")){echo $_REQUEST["txtsrchno"];}?>" id="txtsrchno" size="25"></td>
					 <td width="15%" align="left"><strong>Enquiry Name</strong></td>
					<td width="20%" align="left"><input type="text" name="txtsrchnm" value="<?php if(isset($_REQUEST["txtsrchnm"]) && ($_REQUEST["txtsrchnm"]!="")){echo $_REQUEST["txtsrchnm"];}?>" id="txtsrchnm" size="25"></td>
					 <td width="9%"><strong>Email Id</strong></td>
					 <td width="23%"><input type="text" name="txtemailid" value="<?php if(isset($_REQUEST["txtemailid"]) && ($_REQUEST["txtemailid"]!="")){echo $_REQUEST["txtemailid"];}?>" id="txtemailid" size="25"></td>	
					 </tr>
					 <tr>						
					 <td width="11%"><strong>Date</strong></td>
					 <td align="left" colspan="3">
						<input type="text" name="txtfrmdt" id="txtfrmdt" size="12" maxlength="12" readonly value="<?php if(isset($_REQUEST['txtfrmdt']) && (trim($_REQUEST['txtfrmdt']) != '')) { echo $_REQUEST['txtfrmdt'];}?>">
						<script language='javascript'>
						if(!document.layers){	
							document.write("<img src='images/calendar.gif' onclick='popUpCalendar(this,frmsplradd.txtfrmdt, \"yyyy-mm-dd\")' style='font-size:11px' style='cursor:pointer'>")
						}
						</script>	
						<input type="text" name="txttodt"  id="txttodt" size="12" maxlength="12" readonly value="<?php if(isset($_REQUEST['txttodt']) && (trim($_REQUEST['txttodt']) != '')) { echo $_REQUEST['txttodt'];}?>">
						<script language='javascript'>
						if(!document.layers){	
							document.write("<img src='images/calendar.gif' onclick='popUpCalendar(this,frmsplradd.txttodt, \"yyyy-mm-dd\")'  style='font-size:11px' style='cursor:pointer'>")
						}
						</script>
					  </td>
					  <td colspan="2" align="right">
					  Exact
					  <input type="checkbox" name="chkexact" value="y" <?php 						  
						if(isset($_REQUEST["chkexact"]) && ($_REQUEST["chkexact"]=="y")){
							echo "checked";
						}					  						  
					  ?>>					
					  	<input name="button" type="button" class="textfeild" onClick="validate()" value="Search">
					  		<a href="vw_all_orders.php" class="leftlinks"><strong>Refresh</strong></a>
					 </td>
					</tr>
				</table>   
              <table width="95%" border="0" cellpadding="3" cellspacing="1">
			  <?php
			  	if($msg != ""){
					$dispmsg = "<tr><td colspan='9' align='center' bgcolor='#595959'>$msg</td></tr>";
					echo $dispmsg;				
				}
			  ?>
				  <tr class='white'>
						<td width="6%" align="left" bgcolor="#FF543A"><strong>SL. No.</strong></td>
						<td width="8%" align="center" bgcolor="#FF543A"><strong>Enquiry No</strong></td>						
						<td width="20%" align="left" bgcolor="#FF543A"><strong>Name</strong></td>
						<td width="20%" align="left" bgcolor="#FF543A"><strong>Email</strong></td>
						<td width="14%" align="left" bgcolor="#FF543A"><strong>Enquiry Date/Time</strong></td>
					<?php
					/*
						<td width="6%" align="center" ><strong>Qty</strong></td>
						<td width="8%" align="center" ><strong>Amount</strong></td>
						<td width="7%" align="center" ><strong>Status</strong></td>
					*/?>
						<td width="7%" align="center" bgcolor="#FF543A"><strong>Delete</strong></td>				
				  </tr>
			  <?php
			  	$cnt = $offset;
			 	while($rowcrtord_mst=mysqli_fetch_assoc($srscrtord_mst)){
					$cnt += 1;
					$db_ordid	= $rowcrtord_mst["crtordm_id"];
					$db_ordcode	= $rowcrtord_mst["crtordm_code"];
					$db_crtdon	= $rowcrtord_mst["crtordm_crtdon"];
					$db_fstname	= $rowcrtord_mst["crtordm_name"];
					$db_lstname	= $rowcrtord_mst["crtordm_lstname"];
					$db_name	= $db_fstname." ".$db_lstname;					
					$db_emailid	= $rowcrtord_mst["crtordm_email"];
					//$db_qty		= $rowcrtord_mst["crtordm_qty"];
					//$db_prc		= $rowcrtord_mst["crtordm_amt"];
					$db_paysts	= funcDispCrnt($rowcrtord_mst["crtordm_paysts"]);															
			  ?>
				  <tr bgcolor="#f0f0f0">
					<td align="left"><?php echo $cnt;?></td>
					<td align="right">
						<a href="order_detail.php?oid=<?php echo $db_ordid;?>&pg=<?php 
						echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="leftlinks">   
					    <?php echo $db_ordid;?></a></td>						
					<td align="left"><?php echo $db_name;?></td>																	
					<td align="left"><?php echo $db_emailid;?></td>
					<td align="left"><?php echo $db_crtdon;?></td>	
					<?php
					/*
                    <td align="right"><?php echo $db_qty;?></td>
					<td align="right"><?php echo $db_prc;?></td>					
					<td align="center"><?php echo $db_paysts;?></td>
					*/?>
                	<td align="center">
						<a href="vw_all_orders.php?ordid=<?php echo $db_ordid;?>&sts=d" class="leftlinks" 
							onClick="return confirm('Are You Sure you want to Delete?')">Delete</a>					
					</td>
              	</tr>
			  <?php
			  	}
				$disppg = funcDispPag("paging",$loc,$sqrycrtord_mst1,$rowsprpg,$cntstart, $pgnum, $conn);	
				if($disppg != ""){	
					$disppg = "<tr><td colspan='9' align='center' bgcolor='#f0f0f0'>$disppg</td></tr>";
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
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>	