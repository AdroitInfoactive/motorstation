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
																	
			$msgbody="<style type='text/css'>
							<!--
												html {
							background: #f9f9f9;
							font-family:Arial,sans-serif;
							font-size:10px;
						}
						 body {
								max-width: 650px;
								_width: 650px;
					
								margin:30px auto;
								background:#fff;
							}
						table{max-width:100%;background-color:transparent;border-collapse:collapse;border-spacing:0;}
							.table{width:100%;margin-bottom:20px;}.table th,.table td{padding:6px;line-height:20px;text-align:left;vertical-align:top;border-top:1px solid #dddddd;}
							.table th{font-weight:bold;}
							.table thead th{vertical-align:bottom;}
							.table caption+thead tr:first-child th,.table caption+thead tr:first-child td,.table colgroup+thead tr:first-child th,.table colgroup+thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td{border-top:0;}
							.table tbody+tbody{border-top:2px solid #dddddd;}
							.table .table{background-color:#ffffff;}
							.table-condensed th,.table-condensed td{padding:4px 5px;}
							.table-bordered{border:1px solid #dddddd;border-collapse:separate;*border-collapse:collapse;border-left:0;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}.table-bordered th,.table-bordered td{border-left:1px solid #dddddd;}
							.table-bordered caption+thead tr:first-child th,.table-bordered caption+tbody tr:first-child th,.table-bordered caption+tbody tr:first-child td,.table-bordered colgroup+thead tr:first-child th,.table-bordered colgroup+tbody tr:first-child th,.table-bordered colgroup+tbody tr:first-child td,.table-bordered thead:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child td{border-top:0;}
							.table-bordered thead:first-child tr:first-child>th:first-child,.table-bordered tbody:first-child tr:first-child>td:first-child,.table-bordered tbody:first-child tr:first-child>th:first-child{-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px;}
							.table-bordered thead:first-child tr:first-child>th:last-child,.table-bordered tbody:first-child tr:first-child>td:last-child,.table-bordered tbody:first-child tr:first-child>th:last-child{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;}
							.table-bordered thead:last-child tr:last-child>th:first-child,.table-bordered tbody:last-child tr:last-child>td:first-child,.table-bordered tbody:last-child tr:last-child>th:first-child,.table-bordered tfoot:last-child tr:last-child>td:first-child,.table-bordered tfoot:last-child tr:last-child>th:first-child{-webkit-border-bottom-left-radius:4px;-moz-border-radius-bottomleft:4px;border-bottom-left-radius:4px;}
							.table-bordered thead:last-child tr:last-child>th:last-child,.table-bordered tbody:last-child tr:last-child>td:last-child,.table-bordered tbody:last-child tr:last-child>th:last-child,.table-bordered tfoot:last-child tr:last-child>td:last-child,.table-bordered tfoot:last-child tr:last-child>th:last-child{-webkit-border-bottom-right-radius:4px;-moz-border-radius-bottomright:4px;border-bottom-right-radius:4px;}
							.table-bordered tfoot+tbody:last-child tr:last-child td:first-child{-webkit-border-bottom-left-radius:0;-moz-border-radius-bottomleft:0;border-bottom-left-radius:0;}
							.table-bordered tfoot+tbody:last-child tr:last-child td:last-child{-webkit-border-bottom-right-radius:0;-moz-border-radius-bottomright:0;border-bottom-right-radius:0;}
							.table-bordered caption+thead tr:first-child th:first-child,.table-bordered caption+tbody tr:first-child td:first-child,.table-bordered colgroup+thead tr:first-child th:first-child,.table-bordered colgroup+tbody tr:first-child td:first-child{-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px;}
							.table-bordered caption+thead tr:first-child th:last-child,.table-bordered caption+tbody tr:first-child td:last-child,.table-bordered colgroup+thead tr:first-child th:last-child,.table-bordered colgroup+tbody tr:first-child td:last-child{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;}
							.table-striped tbody>tr:nth-child(odd)>td,.table-striped tbody>tr:nth-child(odd)>th{background-color:#f9f9f9;}
							.table-hover tbody tr:hover>td,.table-hover tbody tr:hover>th{background-color:#f5f5f5;}
						.body {
							background: #fff;
							color: #333;
							font-family: sans-serif;
							margin: 2em auto;
							padding: 1em 2em;
							-webkit-border-radius: 3px;
							border-radius: 3px;
							border: 1px solid #dfdfdf;
							max-width:600px;
							
						}
						h1 {
					
							font:bold 24px sans-serif;
							margin:0;
							padding: 0;
							text-align:center
						}
						
						
						
						a {
							color: #1C5A95;
							text-decoration: none;
							font:bold 14px Arial, Helvetica, sans-serif;
						}
						a:hover {
							color:#F00;
							text-decoration:underline;
						}
						
						
						
												-->
												</style>
												
												<table  border='0' width='650' align='center' cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-hover table-condensed'>
												<thead><tr><th><p style='text-align:center'><a href='$pth' ><img src='$hdimg' alt='$usr_cmpny'  border='0'></a></p>
													<h1>$usr_cmpny -  Order Information</h1></th></tr></thead>
												  <tr>
													<td align='left'>
													
						<p>Dear ".$bfname.",</p>
						Thank you for your order placed on " .$orddate. ".<br /><br />
						Order will be Under Process.<br />
						
						<p>If   you have any queries about your enquiry, kindly contact our <a href='/contact-us' target='_blank' rel='nofollow'>
						Customer Care</a></p>
						<table width='100%' border='0' cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-hover table-condensed'>
						<tbody>
													<tr valign='top'>
													  <td ><strong>Enquiry No</strong></td>
													  <td >".$ordcode."</td>
													</tr>
													<tr valign='top'>
													  <td  ><strong>Shipping details</strong></td>
													  
													  <td >".
													   $sfname.",". $slname.",".$sadrs.",".$sadrs2 .",". $scty .",". $scounty.",".$szip."," .$scountry ."
													  </td>
													</tr>
													<tr valign='top'>
													  <td ><strong>Contact email</strong></td>
													  <td >".$semail."</td>
													</tr>
						</tbody>
												</table>
											
											<table  border='0' width='100%' align='center' cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-hover table-condensed'>
											
											
											<thead><tr><th colspan='4'>Order Details</th></tr></thead>
													
												<tr>
													<td ><strong>Order No</strong></td>
													<td >$ordcode</td>
													<td > <strong>Order Date & Time</strong></td>
													<td >$orddate</td>
												</tr>
												<tr>
													<td ><strong>Total Qty</strong></td>
													<td >$db_ordqty</td>
													<td ><strong>Total Amount</strong></td>
													<td >$ordamt</td>
												</tr>
												<tr>
													<td ><strong>Payment Status</strong></td>
													<td >$dispsy</td>
													<td><strong>Payment Mode</strong></td>
													<td>$db_pmode</td>
												</tr>
												<tr>
													<td ><strong>Messages</strong></td>
													<td   colspan='3'>$db_ordrmks &nbsp;</td>
													
												</tr>	
											</table>
											
											
											<table border='0'  align='center' cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-hover table-condensed'>
											<thead><tr><th colspan='4'>Address Details:</th></tr></thead>
											  <tbody>
												<tr>
													<td width=50%>
													<b>Billing Address</b><br/>
													$blngcmpltadrs
													</td>
													
													<td width=50%>
													<b>Shipping Address</b><br/>
													$shpcmpltadrs
													</td>
													
												</tr>
											  </tbody>
											</table>
											
												<table cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-hover table-condensed' >
													<thead><tr><th colspan='5'>Cart Details:</th></tr></thead>
												  
													<tr>
													  <td height='25' valign='middle'  ><b>Code/Name</b></td>
													  <td height='25' valign='middle'  ><b>Size Name</b></td>
													  <td height='25' valign='middle'  ><b>Price</b></td>
													  <td height='25' valign='middle'  ><b>Qty</b></td>
													  <td align='right' valign='middle'   ><b>Total Price</b></td>
													</tr>";
													 $sqrycrtord_dtl ="select 
																			prodm_code,crtordd_id,crtordd_qty,
																			crtordd_prc,prodm_name,sizem_name
																	  from 
																			crtord_dtl 
																	  inner join 
																			vw_prod_size_dtl 
																	  on 
																			crtordd_sizem_id=sizem_id
																	  where 
																			crtordd_crtordm_id=$ordmstid";
													$srscrtord_dtl = mysqli_query($conn,$sqrycrtord_dtl);
													$cnttorec      = mysqli_num_rows($srscrtord_dtl);
													
													if($cnttorec > 0)
													{	
														$totcrtprc = "";						
														while($rowspo_mst=mysqli_fetch_assoc($srscrtord_dtl))
														{
															$msgbody.="<tr>
															  <td   >$rowspo_mst[prodm_code]<br/>$rowspo_mst[prodm_name]</td>
															  <td   >$rowspo_mst[sizem_name]</td>
															  <td   >$rowspo_mst[crtordd_prc]</td>
															  <td   >$rowspo_mst[crtordd_qty]</td>
															  <td align='right' valign='middle'  >";
															$totitmprc = ($rowspo_mst['crtordd_qty']*$rowspo_mst['crtordd_prc']);
															$totcrtprc +=  $totitmprc;
															$msgbody.=   number_format($totitmprc,2,".",",")."</td>
															</tr>";							
														}
													}		
													$grscrtprc = $totcrtprc + $shipprc;
													
												$msgbody.=" 
												<tr>
												  <td height='25' colspan='4'   ><strong class='right'>Total Amount </strong></td>
												  <td align='right' valign='middle' >".number_format($totitmprc,2,".",",")."</td>
												  </tr>";
												  $msgbody.=" 
												<tr>
												  <td height='25' colspan='4'   ><strong class='right'>Shopping Amount </strong></td>
												  <td align='right' valign='middle' >".number_format($shipprc,2,".",",")."</td>
												  </tr>";
												$msgbody.=" 
												<tr>
												  <td height='25' colspan='4'   ><strong class='right'>Grand Total </strong></td>
												  <td align='right' valign='middle' >".number_format($grscrtprc,2,".",",")."</td>
												  </tr>";
																$msgbody .=	"</table>
																		
												</td>
												</tr>
												</table>";
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
					</form>
					<script language="javascript" type="text/javascript">
						document.getElementById('frmpayment').action = "<?php echo $u_prjct_mnurl;?>/successtran";
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
					  <input type="hidden" name="ru" value="<?php echo $u_prjct_mnurl;?>/successtran">  
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