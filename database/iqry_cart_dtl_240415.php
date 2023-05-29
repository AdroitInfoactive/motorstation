<?php	
	include_once "includes/inc_usr_sessions.php";	 //Including user session value
	include_once "includes/inc_membr_session.php";//checking for session
	include_once "includes/inc_connection.php";
	include_once "includes/inc_usr_functions.php";
	include_once "includes/inc_config.php";
?>
	<style type="text/css">
<!--
body {
	background-color: #000000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<?php		
	if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != ""))
	{
		include_once "includes/inc_membr_session.php";//checking for session				
		$usrmsg = "<table width=\"1003\" height=\"100%\" border=\"0\" align=\"center\" cellpadding=\"20\" cellspacing=\"1\" bgcolor=\"#000000\">
		  <tr>
			<td><table border=\"0\" align=\"center\" cellpadding=\"14\" cellspacing=\"0\">
			  <tr>
				<td valign=\"middle\"><img src=\"images/loading.gif\" width=\"32\" height=\"32\" /></td>
				<td align=\"center\" valign=\"middle\" bgcolor=\"#F7F7F7\" class=\"confirmtitles\">Order is in process, please wait... </td>
			  </tr>
			</table></td>
		  </tr>
		</table>";		
		
	//	echo $usrmsg;		
		
		$crtsesval 	= session_id();	
		$dt         = date('Y-m-d h:i:s');			
		$newdate	= date("d-m-Y h:i:s");
		$rmrks		= htmlentities($_POST['txtmsg'],ENT_QUOTES);
		
		$paysts		= "n";
		$cartsts	= "r";	
		$paymode	= $_POST['chkpaymentMode'];	
		
		$ccrdid 	= 'NULL';
		$rdflag		= 0;
		
		if($paymode == "b")
		{
			$rdflag		= 2; // Redirection to payment gateway
		}
		else{
			$rdflag		= 1; // Redirection to payment gateway
		}
		$xlcrdtflag = 1; // Xl Credit Insertion
		$crncyid	= $_SESSION['sescrncy'];
		$shpchrgprc	  =  $gselshpchrg;		
		$shipprc = 0;		
/*		if(isset($_SESSION['sesdlvrychrg']) && (trim($_SESSION['sesdlvrychrg']) != ""))
		{
			$shpchrgtyp	  	 = $_SESSION['sesdlvrychrg'];				
			$sqryshpchrg_mst = "select 
									shpchrgm_name,shpchrgm_prc,shpchrgm_desc 
								from 
									shpchrg_mst 
								where 
									shpchrgm_id='$shpchrgtyp'";							
			$srsshpchrg_mst  =  mysqli_query($conn,$sqryshpchrg_mst);
			$srowshpchrg_mst =  mysqli_fetch_array($srsshpchrg_mst);		
			$shipprc         = $srowshpchrg_mst['shpchrgm_prc'];
	   }
	   	if(isset($_SESSION['ses_crt_cpnid']) && (trim($_SESSION['ses_crt_cpnid']) != ""))
		{
				$cpnid		= $_SESSION['ses_crt_cpnid']; // Couopon id
				$sqrycpn_mst  =  "select 
										cpnm_id,cpnm_code,
										cpnm_typ,cpnm_val
								  from 
										 cpn_mst 
								  where 
										cpnm_id 	= '$cpnid' and
										cpnm_sts  	= 'a'";
																										  
				$srscpn_mst   = mysqli_query($conn,$sqrycpn_mst);
				$cntrec_cpn   = mysqli_num_rows($srscpn_mst);
				$srowcpnmst   = mysqli_fetch_assoc($srscpn_mst);
				$usrcpntyp    = $srowcpnmst['cpnm_typ'];
				$usrcpnval    = $srowcpnmst['cpnm_val'];
				$usrcpncode   = $srowcpnmst['cpnm_id'];
		}
		else
		{
			$cpnid		= 'NULL'; // Couoponid
		
		}*/
		 $sqrycrtmbr_dtl_adrs  = "select * from 
									vw_mbr_mst_dtl_bil 
								 where 
									mbrm_id = '$membrid' 
									and (mbrd_dfltbil='y' or 
									mbrd_dfltshp='y') limit 2";
						
		$srscrtmbr_dtl   = mysqli_query($conn,$sqrycrtmbr_dtl_adrs);
		while($srowscrtmbr_dtl = mysqli_fetch_assoc($srscrtmbr_dtl)){
			if($srowscrtmbr_dtl['mbrd_dfltbil'] == 'y'){
				$bfname 	  = $srowscrtmbr_dtl['mbrd_fstname'];
				$blname		  = $srowscrtmbr_dtl['mbrd_lstname'];								
				$badrs	 	  = $srowscrtmbr_dtl['mbrd_badrs'];
				$badrs2   	  = $srowscrtmbr_dtl['mbrd_badrs2'];
				$bcty	 	  = $srowscrtmbr_dtl['mbrd_bcty_id'];								
				$bcounty  	  = $srowscrtmbr_dtl['mbrd_bmbrcntym_id'];
				$bzip	 	  = $srowscrtmbr_dtl['mbrd_bzip'];								
				$bcountry 	  = $srowscrtmbr_dtl['mbrd_bmbrcntrym_id'];
				$bemail	 	  = $srowscrtmbr_dtl['mbrm_emailid'];
				$bph		  = $srowscrtmbr_dtl['mbrd_bdayphone'];	
				$bctyname	  = $srowscrtmbr_dtl['ctym_name'];	
				$bcntyname	  = $srowscrtmbr_dtl['cntym_name'];	
				$bcntryname	  = $srowscrtmbr_dtl['cntrym_iso'];
			}
			if($srowscrtmbr_dtl['mbrd_dfltshp'] == 'y'){
				$sfname 	  = $srowscrtmbr_dtl['mbrd_fstname'];
				$slname		  = $srowscrtmbr_dtl['mbrd_lstname'];	 
				$sadrs	  	  = $srowscrtmbr_dtl['mbrd_badrs'];
				$sadrs2   	  = $srowscrtmbr_dtl['mbrd_badrs2'];
				$scty	  	  = $srowscrtmbr_dtl['mbrd_bcty_id'];								
				$scounty  	  = $srowscrtmbr_dtl['mbrd_bmbrcntym_id'];
				$szip	  	  = $srowscrtmbr_dtl['mbrd_bzip'];								
				$scountry 	  = $srowscrtmbr_dtl['mbrd_bmbrcntrym_id'];
				$semail	  	  = $srowscrtmbr_dtl['mbrm_emailid'];
				$sph	  	  = $srowscrtmbr_dtl['mbrd_bdayphone'];	
				$sctyname	  = $srowscrtmbr_dtl['ctym_name'];	
				$scntyname	  = $srowscrtmbr_dtl['cntym_name'];	
				$scntryname	  = $srowscrtmbr_dtl['cntrym_iso'];	
			}	
		}	
		$crtwt		= "";
		$totqty		= $_SESSION['totqty'];	
		$totamt     = $_POST['hdngnetcartprc'];
		$shipprc     = $_POST['hdnshpprc'];
		//$totamt		= $_SESSION['totamt'];	
		//$grsamt		= $totamt + $shipprc;
		$paygrsamt		= $totamt+$shipprc;		
		/*if(isset($_SESSION['ses_usdxlcrdt']) && (trim($_SESSION['ses_usdxlcrdt']) != ""))
		{
			$xlcrdtflag 	= 2;	
			$usdxlcrdt		= $_SESSION['ses_usdxlcrdt'];					
			$usdxlcrdtval	= 0;
			if($grsamt > $usdxlcrdt)
			{
				$grsamt 	 -= $usdxlcrdt; 
				$usdxlcrdtval = $usdxlcrdt;				
			}
			elseif($usdxlcrdt >= $grsamt)
			{
				$usdxlcrdtval = $grsamt;
				$grsamt  = 0;
				$rdflag  = 2; //Redirection to thank you page			
				$paymode = 'x';
				$paysts  = 'y';
			}
		}
		else
		{
			$usdxlcrdt		= '0.00';
		}*/
					
/*		if(isset($_POST['rdocrdtyp']) && (trim($_POST['rdocrdtyp']) != ""))
		{
			$ccrdid     = $_POST['rdocrdtyp'];
		}	
*/		$ccrdid     = "e";				
		//$paygrsamt 	  = ($grsamt * 100);		
		
		$sqrycrtord_mst = "select 
								max(crtordm_id)  as crtordm_id
						   from 
								crtord_mst";
		$srscrtord_mst  = mysqli_query($conn,$sqrycrtord_mst);
		$cntord_code	= mysqli_num_rows($srscrtord_mst);
		if($cntord_code > 0){
			$srowcrtord_mst = mysqli_fetch_assoc($srscrtord_mst);
			$oldcrtord_code = $srowcrtord_mst['crtordm_id'];	
			$newcrtord_code = $oldcrtord_code + 1;
		}
		else{
			$newcrtord_code = 1;
		}
		$shpchrgtyp = 0;
		$usrcpnval = 0;		
		$iqrycrtordmst = "insert into crtord_mst(
							   crtordm_code,crtordm_sesid,crtordm_fstname,crtordm_lstname,
							   crtordm_badrs,crtordm_badrs2,crtordm_bmbrctym_id,crtordm_bmbrcntym_id,
							   crtordm_bzip,crtordm_bmbrcntrym_id,crtordm_bdayphone,crtordm_emailid,
							   crtordm_sfstname,crtordm_slstname,crtordm_sadrs,crtordm_sadrs2,
							   crtordm_smbrctym_id,crtordm_smbrcntym_id,crtordm_szip,crtordm_smbrcntrym_id,
							   crtordm_sdayphone,crtordm_semailid,crtordm_qty,crtordm_amt,		   
							   crtordm_prcssts,crtordm_cartsts,crtordm_pmode,
							   crtordm_paysts,crtordm_rmks,crtordm_mbrm_id,
							   crtordm_shpchrgm_id,crtordm_shpchrgamt,
							   crtordm_cpnm_id,crtordm_cpnm_typ,crtordm_cpnm_val,
							   crtordm_crtdon,crtordm_crtdby) values(						
						 	   '$newcrtord_code','$crtsesval','$bfname','$blname',
							   '$badrs','$badrs2','$bcty', '$bcounty',
							   '$bzip','$bcountry','$bph','$bemail',
							   '$sfname','$slname','$sadrs','$sadrs2',
							   '$scty','$scounty','$szip','$scountry',
							   '$sph','$semail','$totqty','$paygrsamt',
							   'r','$cartsts','$paymode',
							   '$paysts','$rmrks','$membrid','$shpchrgtyp','$shipprc',
							   '$usrcpncode','$usrcpntyp','$usrcpnval',
							   '$dt','$membremail')";												  
		  $irscrtordmst		= mysqli_query($conn,$iqrycrtordmst) or die(mysql_error());		
		  if($irscrtordmst == true){
			 $ordmstid 		= mysql_insert_id();	 
			 $cartval    	= $_SESSION['cartcode'];
			 $prodidval  	= $_SESSION['prodid'];			 
			 $prodqtyval 	= $_SESSION['prodqty'];
			 $ses_crncynm	= $_SESSION['sescrncy'];					
		 
			 if(($cartval != "") && ($prodidval != "") && ($prodqtyval != "")){
			 
				$codearr	=	explode(",",$prodidval);
				$qtyarr		=	explode(",",$prodqtyval);	
				$newArray	=	$codearr;
		
				$items = explode(',',$cartval);				
				$totqty    = 0;
				$totxlcredits = 0;
				$totcartprc = 0;
				foreach ($items as $items_id=>$items_val){					
					$totuntprc = 0;
					$totbilprc = 0;											
					
					$cartcodeid  = ""; //For Storing the cart value id
					$cartcodeval = ""; //For Storing the cart code value
		
					$cartcodeid  = $items_id;
					$cartcodeval = $items_val; //  Stores the cart detail value
					
					$arr_cartcodeval  = explode("-",$cartcodeval);
					$cart_prodid	  = $arr_cartcodeval[0]; // Stores the product id 
					$cart_prodprc	  = $arr_cartcodeval[1]; // Stores the product colour
					$cart_prodsbnm	  = $arr_cartcodeval[2]; // Stores the submenu
					$cart_prodsz	  = $arr_cartcodeval[3]; // Stores the product size
					$cart_prodshirt	  = $arr_cartcodeval[4]; // Stores the product shirt lenght
					$cartcurprodslv   = $arr_cartcodeval[5]; // Stores the product sleeve Length
					$cartcurprodsztyp = $arr_cartcodeval[6]; // Stores the product sleeve Length
					$untqty 		  = $qtyarr[$cartcodeid]; // Stores the unit quantities
					$cart_ordsts	  = "a";
					$sqryprod_dtl1 = "select 
											prodm_id,prodm_code,prodprcd_prc,prodprcd_ofrprc
										 from 
											vw_prod_size_dtl 										 
										 where 
											prodm_id='$cart_prodid' and
											sizem_id ='$cart_prodprc'";
					$srsprod_dtl1  = mysqli_query($conn,$sqryprod_dtl1);				
					$srowprod_dtl1 = mysqli_fetch_assoc($srsprod_dtl1);
					if($srowprod_dtl1['prodprcd_ofrprc'] > 0){					
						$produntprc = $srowprod_dtl1['prodprcd_ofrprc'];
					}
					else{
						$produntprc = $srowprod_dtl1['prodprcd_prc'];
					}										
					//$totuntprc    = ($untqty * $produntprc); 
										
					$iqrycrtord_dtl  ="insert into crtord_dtl(
									   crtordd_sesid,crtordd_prodm_id,crtordd_prc,crtordd_qty,
									   crtordd_sizem_id,crtordd_sts,crtordd_crtordm_id,crtordd_crtdon,
									   crtordd_crtdby)values(
									   '$crtsesval','$cart_prodid','$produntprc','$untqty',
									   '$cart_prodprc','$cart_ordsts','$ordmstid','$dt',
									   '$membremail')";
					$irscrtord_dtl	= mysqli_query($conn,$iqrycrtord_dtl)  or die(mysql_error());
				}// End of For each		
			}					
			if($irscrtord_dtl==true){
				
				$sqryordsts_mst="select ordstsm_id from ordsts_mst where ordstsm_sts='a' order by ordstsm_prty desc limit 1";
				$irsordsts_mst  = mysqli_query($conn,$sqryordsts_mst);
				$srowordsts_mst = mysqli_fetch_assoc($irsordsts_mst);
				$newid=$srowordsts_mst['ordstsm_id'];
				
				$iqryordsts_dtl="insert into ordsts_dtl(
								 ordstsd_ordstsm_id,ordstsd_crtordm_id,ordstsd_dttm,
								 ordstsd_crtdon,ordstsd_crtdby) values(
								'$newid','$ordmstid','$dt',
								'$dt','$membremail')";
				$irsordsts_dtl		  = mysqli_query($conn,$iqryordsts_dtl);
				
				 
				 unset($_SESSION['cartcode']);
				 unset($_SESSION['prodid']);
				 unset($_SESSION['prodqty']);
				 unset($_SESSION['cart']);
				 unset($_SESSION['sescrncy']);
				 $_SESSION['cartcode']	= '';
				 $_SESSION['prodid']	= '';
				 $_SESSION['prodqty']	= '';	
				 $_SESSION['prodprc']	= '';	
				 $_SESSION['cart']		= '';	
				// session_destroy();
				 
				 $sqrycrtord_mst = "select
									crtordm_id,crtordm_code,crtordm_fstname,crtordm_lstname, 
									crtordm_badrs,crtordm_badrs2,blcty.ctym_name as bctynm,blcnty.cntym_name as bcntynm,
									crtordm_bzip,blcntry.cntrym_name as bcntrynm,crtordm_bdayphone,
									crtordm_emailid,crtordm_sfstname,crtordm_slstname,crtordm_sadrs,
									crtordm_sadrs2,shpcty.ctym_name as sctynm, shpcnty.cntym_name as scntynm,
									crtordm_szip,shpcntry.cntrym_name as scntrynm,
									crtordm_sdayphone,crtordm_semailid,crtordm_qty,crtordm_amt,crtordm_wt,
									crtordm_pmode,crtordm_prcssts,crtordm_cartsts,crtordm_paysts,crtordm_rmks,
									crtordm_shpchrgm_id,crtordm_shpchrgamt,crtordm_cpnm_val,crtordm_mbrm_id,
									crtordm_ordtyp,date_format(crtordm_crtdon,'%d-%m-%Y') as crtordm_crtdon_dt,
									date_format(crtordm_crtdon,'%h:%i:%s') as crtordm_crtdon_tm									
							  from
									crtord_mst crtord 
									left join cty_mst blcty on blcty.ctym_id = crtord.crtordm_bmbrctym_id
									left join cty_mst shpcty on shpcty.ctym_id = crtord.crtordm_smbrctym_id 
									
									left join cnty_mst blcnty on blcnty.cntym_id = blcty.ctym_cntym_id 
									left join cnty_mst shpcnty on shpcnty.cntym_id = shpcty.ctym_cntym_id
									
									inner join cntry_mst blcntry on blcntry.cntrym_id= blcnty.cntym_cntrym_id 
									left join cntry_mst shpcntry on shpcntry.cntrym_id= shpcnty.cntym_cntrym_id										
								where 
									crtordm_id = '$ordmstid'";
								
		$srscrtord_mst = mysqli_query($conn,$sqrycrtord_mst);
		$cntord_rec	   = mysqli_num_rows($srscrtord_mst);
	
		if($cntord_rec > 0){			
			$srowcrtord_mst = mysqli_fetch_assoc($srscrtord_mst);
			
			$crtord_id		= $srowcrtord_mst['crtordm_id'];											
					$bfname  = $srowcrtord_mst['crtordm_fstname'];
					$blname	  = $srowcrtord_mst['crtordm_lstname'];	
					$bemail  = $srowcrtord_mst['crtordm_emailid'];
					$ordcode = $srowcrtord_mst['crtordm_code'];
					$ordmid	 =  base64_encode($srowcrtord_mst['crtordm_id']);
					$orddate = $srowcrtord_mst['crtordm_crtdon_dt']." ".$srowcrtord_mst['crtordm_crtdon_tm'];	 
					$shipname = $srowcrtord_mst['shpchrgm_name'];	 
					$shpprc  = $srowcrtord_mst['crtordm_shpchrgamt'];
					$sfname   = $srowcrtord_mst['crtordm_sfstname'];	 
					$slname	  = $srowcrtord_mst['crtordm_slstname'];	 			   
					$sadrs	  = $srowcrtord_mst['crtordm_sadrs'];
					$sadrs2   = $srowcrtord_mst['crtordm_sadrs2'];
					$scty 	  = $srowcrtord_mst['sctynm'];
					$scounty  = $srowcrtord_mst['scntynm'];
					$scountry = $srowcrtord_mst['scntrynm'];
					$badrs	  = $srowcrtord_mst['crtordm_badrs'];
					$badrs2   = $srowcrtord_mst['crtordm_badrs2'];
					$bcty 	  = $srowcrtord_mst['bctynm'];
					$bcounty  = $srowcrtord_mst['bcntynm'];
					$bcountry = $srowcrtord_mst['bcntrynm'];
					$bzip	  = $srowcrtord_mst['crtordm_bzip'];		
					$bemail	  = $srowcrtord_mst['crtordm_emailid'];
					$bphno	  = $srowcrtord_mst['crtordm_bdayphone'];
					$szip	  = $srowcrtord_mst['crtordm_szip'];		
					$semail	  = $srowcrtord_mst['crtordm_semailid'];	
					$sphno	  = $srowcrtord_mst['crtordm_sdayphone'];
					$ordamt	  = $srowcrtord_mst['crtordm_amt'];
					$shpamt	  = $srowcrtord_mst['crtordm_shpchrgamt'];
					$crtwt	  = $srowcrtord_mst['crtordm_wt'];
					$totcrtprc = $ordamt + $shipprc;
					$db_pmode = funcPayMod($srowcrtord_mst['crtordm_pmode']);
					$dispsy = funcDispCrnt($srowcrtord_mst['crtordm_paysts']);
					$db_ordqty	  = $srowcrtord_mst['crtordm_qty'];
					$db_ordamt	  = $srowcrtord_mst['crtordm_amt'];
					$db_ordrmks	  = $srowcrtord_mst['crtordm_rmks'];
					
					//$dispsy    ="No";
					$shpcmpltadrs ="";
					if($bemail != ''){
						$shpcmpltadrs = $bemail;	
					}
					if($sfname != ''){
						$shpcmpltadrs .= "<br/>".$sfname;	
					}						 
					if($slname != ''){
						$shpcmpltadrs .= "&nbsp;".$slname;	
					}
					if($sadrs != ''){
						$shpcmpltadrs .= "<br>".$sadrs;	
					}						 
					if($sadrs2 != ''){
						$shpcmpltadrs .= ",&nbsp;".$sadrs2;	
					}						 
					if($scty != ''){
						$shpcmpltadrs .= "<br>".$scty;	
					}						 
					if($scounty != ''){
						$shpcmpltadrs .= ",&nbsp;".$scounty;	
					}						 
					if($scountry != ''){
						$shpcmpltadrs .= "<br>".$scountry;	
					}						 
					if($szip != ''){
						$shpcmpltadrs .= ",&nbsp;Zip Code :&nbsp;".$szip;	
					}
					if($sphno != ''){
						$shpcmpltadrs .= "<br>Mobile No :&nbsp;".$sphno;	
					}	
					
					$blngcmpltadrs ="";
					if($bemail != ''){
						$blngcmpltadrs = $bemail;	
					}
					if($bfname != ''){
						$blngcmpltadrs .= "<br/>".$bfname;	
					}						 
					if($blname != ''){
						$blngcmpltadrs .= "&nbsp;".$blname;	
					}						 
					if($badrs != ''){
						$blngcmpltadrs .= "<br>".$badrs;	
					}						 
					if($badrs2 != ''){
						$blngcmpltadrs .= ",&nbsp;".$badrs2;	
					}						 
					if($bcty != ''){
						$blngcmpltadrs .= "<br>".$bcty;	
					}						 
					if($bcounty != ''){
						$blngcmpltadrs .= ",&nbsp;".$bcounty;	
					}						 
					if($bcountry != ''){
						$blngcmpltadrs .= "<br>".$bcountry;	
					}						 
					if($bzip != ''){
						$blngcmpltadrs .= ",&nbsp;Zip Code :&nbsp;".$bzip;	
					}
					if($bphno != ''){
						$blngcmpltadrs .= "<br>Mobile No :&nbsp;".$bphno;	
					}	   
					$hdimg    = "http://".$u_prjct_mnurl."/images/jain-logo.png";//Return the URL	
					$orddate	= date('l jS F Y',strtotime($orddate));															
			$msgbody="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
					<html>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					<title>$usr_cmpny | Order Information</title>
					<style type='text/css'>
					#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}
					</style>
					</head>
					<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
					<div style='background-color:#fff;'>
					  <table style='background-color: #ffffff;' width='100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
						  <td><table style=' background-color:#ffffff' background='#ffffff' width='605' border='0' align='center' cellpadding='20' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><table width='181' border='0' align='left' cellpadding='0' cellspacing='0'>
									<tr>
									  <td valign='top' align='center' bgcolor='#FFFFFF'><a href='".$rtpth."home' ><img src='".$hdimg."' alt='$usr_cmpny'  border='0'></a></td>
									</tr>
								  </table></td>
							  </tr>
							</table>
							<table style='background-color:#ffffff;padding:0' background='#ffffff' width='605' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><h1 style='margin-top:5px; margin-bottom:5px; font-family: Georgia, 'Times New Roman', Times, serif; font-size:30px'>$usr_cmpny</h1>
								  <h2 style='margin-top:5px; margin-bottom:5px; font-family:Arial, Helvetica, sans-serif;font-size:25px'>Order Information</h2></td>
							  </tr>
							  <tr>
								<td height='4' valign='top' bgcolor='#cccccc' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
							  <tr>
								<td height='10' valign='top' bgcolor='#fff' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
							  <tr>
								<td valign='top' bgcolor='#ffffff'><p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Dear $bfname,</p>
								 <p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Thank you for your order. Expected date of dispatch of your order is $orddate. </p>
								  <p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Order will be Under Process.<br></p></td>
							  </tr>
							</table>
							<table width='605' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='background-color:#ffffff'>
							  
							  <tr>
								<td  bgcolor='#ffffff' ><p style='color:#ff6600; font-family:Arial, Helvetica, sans-serif; margin-top:5px; margin-bottom:5px'>Address Details:</p></td>
							  </tr>
							  <tr>
								<td ><table width='605' border='1' cellspacing='0' cellpadding='5' bordercolor='#dfdfdf' style='border:1px solid #dfdfdf'>
									<tr>
									  <td align='center'><p style='color:#ff6600'>Billing Address</p></td>
									  <td align='center'><p style='color:#ff6600'>Shipping Address</p></td>
									</tr>
									<tr>
									  <td>$blngcmpltadrs</td>
									  <td>$shpcmpltadrs</td>
									</tr>
								  </table></td>
							  </tr>
							  <tr>
								<td height='10'  bgcolor='#ffffff' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
							</table>
							<table width='605' border='1' align='center' cellpadding='5' cellspacing='0' bordercolor='#dfdfdf' style='border:1px solid #dfdfdf' >
							  <tr valign='top'>
								<td align='center' ><p style='color:#ff6600'>Order No</p></td>
								<td align='center'><p style='color:#ff6600'>Order Date</p></td>
								<td align='center'><p style='color:#ff6600'>Payment Type
</p></td>
							  </tr>
							  <tr valign='top'>
								<td align='center'  >$ordcode</td>
								<td align='center' >$orddate</td>
								<td align='center' >$db_pmode</td>
							  </tr>
							</table>
							<table align='center' width='605' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='background-color:#ffffff'>
							  <tr>
								<td><p style='color:#ff6600;font-family:Arial, Helvetica, sans-serif;margin-top:5px; margin-bottom:5px'>Your Recent Order:</p></td>
							  </tr>
							  <tr>
								<td><table width='100%' cellpadding='5' cellspacing='0' border='1' bordercolor='#dfdfdf' style='border:1px solid #dfdfdf'>
									<tr>
									  <td  valign='middle'><p style='color:#ff6600'>Product</p></td>
									  <td  valign='middle'><p style='color:#ff6600'>Price</p></td>
									  <td  valign='middle'><p style='color:#ff6600'>Qty</p></td>
									  <td align='right' valign='middle'><p style='color:#ff6600'>Total Price</p></td>
									</tr>";
													 $sqrycrtord_dtl ="select 
																			prodm_code,crtordd_id,crtordd_qty,
																			crtordd_prc,prodm_name,sizem_name
																	  from 
																			crtord_dtl 
																	  inner join 
																			vw_prod_size_dtl 
																	  on 
																			(crtordd_sizem_id=sizem_id  and crtordd_prodm_id=prodm_id)
																	  where 
																			crtordd_crtordm_id=$ordmstid
																	  group by prodm_id,sizem_id order by sizem_prty desc";
													$srscrtord_dtl = mysqli_query($conn,$sqrycrtord_dtl);
													$cnttorec      = mysqli_num_rows($srscrtord_dtl);
													
													if($cnttorec > 0)
													{	
														$totcrtprc = "";						
														while($rowspo_mst=mysqli_fetch_assoc($srscrtord_dtl))
														{
															$msgbody.="<tr>
															  <td>Name: $rowspo_mst[prodm_code]<br/>Code: $rowspo_mst[prodm_name] <br/>Size: $rowspo_mst[sizem_name]</td>
															  <td>$rowspo_mst[crtordd_prc]</td>
															  <td>$rowspo_mst[crtordd_qty]</td>
															  <td align='right' valign='middle'>";
															$totitmprc = ($rowspo_mst['crtordd_qty']*$rowspo_mst['crtordd_prc']);
															$totcrtprc +=  $totitmprc;
															$msgbody.=   number_format($totitmprc,2,".",",")."</td>
															</tr>";							
														}
													}		
													$grscrtprc = $totcrtprc + $shipprc;
													
												$msgbody.="<tr>
                  <td  colspan='3' align='right'>Product Cost: <br/>Ship Cost:</td>
                  <td align='right' valign='middle'>".number_format($grscrtprc,2,'.',',')."<br/>".number_format($shipprc,2,'.',',')."</td>
                </tr>";
												/*  $msgbody.="<tr>
                  <td  colspan='3' align='right'><strong class='right'>Shipping Amount: </strong></td>
                  <td align='right' valign='middle'>".number_format($shipprc,2,'.',',')."</td>
                </tr>";*/
												$msgbody.="<tr>
                  <td  colspan='3' align='right'>Order Amount: </td>
                  <td align='right' valign='middle'>".number_format($grscrtprc,2,'.',',')."</td>
                </tr>";
				$msgbody.="<tr>
                  <td  colspan='3' align='right'>Payment ($db_pmode): </td>
                  <td align='right' valign='middle'>".number_format($grscrtprc,2,'.',',')."</td>
                </tr>";
							$msgbody .=	"</table></td>
							  </tr>
							</table>
							<table width='605' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <tr>
								<td height='10'  bgcolor='#ffffff' class='spacer'    style='margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:left;-webkit-text-size-adjust:none;font-size:0;line-height:0;'>&nbsp;</td>
							  </tr>
								<td><p>For suggestions / support please feel free to email us at <a href='mailto:support@$u_prjct_url' style='color:#ff6600; text-decoration:none'>support@$u_prjct_url</a>.</p>
								  <p>Sincerely, <br>
									Customer Service,<br>
									$usr_cmpny<br>
									<a href='http://$u_prjct_mnurl' style='color:#ff6600; text-decoration:none'>$u_prjct_mnurl</a><br>
								  </p></td>
							  </tr>
							</table></td>
						</tr>
					  </table>
					</div>
					</body>
					</html>";
									
									
										$to       = $bemail;
										$from     = $u_prjct_email;
										$subject  = "Your $usr_cmpny order " .$ordcode." has been Placed";
										$headers  = "From: " . $from . "\r\n";
										$headers .= "CC: ".$from ."\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
										mail($to,$subject,$msgbody,$headers);	
							}	
				 
				// exit();
				
				if($paymode =='a'){
					?>
						<form name="frmpayment" id="frmpayment" method="post">
						<input type="hidden"  name="orderref" value="<?php echo $ordmstid;?>" />	
						<input type="hidden" name="hdnpaymode" value="<?php echo $paymode;?>"> 		
					</form>
					<script language="javascript" type="text/javascript">
						document.getElementById('frmpayment').action = "<?php echo "http://".$u_prjct_mnurl;?>/successtran";
						<?php /*?>document.getElementById('frmpayment').action = "<?php echo "http://192.168.100.200/wip/J/jainayurvedic.com/programmers/V4/successtran";?>";<?php */?>
						document.getElementById('frmpayment').submit();
					</script>
				<?php	
					
				}else{ 			 
					$action = './atpg-submit.php';				 
				?>
					<form action="<?php echo $action;?>" method="post" name="frmpymntatom" id="frmpymntatom">   
					  <input type="hidden" name="clientcode"  value="123" /> 
					  <input type="hidden" name="IFSCCode" value="F123" />
					  <input type="hidden" name="ClientName" value="client1" />
					  <input type="hidden" name="AccountNo"  value="1234567890"  />
					  <input type="hidden" name="BankName"  value="bank1" />
					  <input type="hidden" name="TType"  value="NBFundTransfer" />
					  <input type="hidden" name="txnid" value="<?php echo $ordmstid;?>" />
					  <input type="hidden" name="amount" value="<?php echo $paygrsamt;?>" />
					  <input type="hidden" name="product" value="NSE"/>
					  <input type="hidden" name="ru" value="<?php echo $base_name;?>/successtran">  
                      <input type="hidden" name="udf1" value="<?php echo $_SESSION['sesmbremail'];?>">  
                      <input type="hidden" name="udf2" value="<?php echo $_SESSION['sesmbrid'];?>">  
                      <input type="hidden" name="udf3" value="<?php echo session_id();?>">
					  <input type="hidden" name="hdnpaymode" value="<?php echo $paymode;?>"> 		                      
					</form>          				 
					<script language="javascript" type="text/javascript">
						document.getElementById('frmpymntatom').action = "<?php echo $action;?>";
						document.getElementById('frmpymntatom').submit();
					</script>
					<?php 
					}
					exit();
			}
		}
		else{
			$msg = "Some error in your cart. Please contact customer care";
		}
	}
	else{
	?>
			<script language="javascript" type="text/javascript">
				location.href = '<?php echo $_SERVER['HTTP_HOST'];?>';
			</script>	
	<?php
	}
	?>		