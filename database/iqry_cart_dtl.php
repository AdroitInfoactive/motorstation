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
	if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != "")){
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
		if($paymode == "b"){
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
				$bcntryname	  = $srowscrtmbr_dtl['cntrym_name'];
				$bcntryiso	  = $srowscrtmbr_dtl['cntrym_iso'];
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
				$scntryname	  = $srowscrtmbr_dtl['cntrym_name'];	
				$scntryiso	  = $srowscrtmbr_dtl['cntrym_iso'];	
			}	
		}	
		$crtwt		= "";
		$totqty		= $_SESSION['totqty'];	
		$totamt     = $_POST['hdngnetcartprc'];
		$shipprc     = $_POST['hdnshpprc'];
		$crncyprc     = $_POST['hdncrncyprc'];
		//$totamt		= $_SESSION['totamt'];	
		//$grsamt		= $totamt + $shipprc;
		$paygrsamt		= $totamt+$shipprc;		
		$crncynm    	= $_SESSION['sescrncy'];
		$cnvtrval   	= $_SESSION['sescnvtrval'];
		$cnvtrchrg   	= $_SESSION['sescnvr_chrg'];
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
							   crtordm_crncynm,crtordm_crncyval,crtordm_cnvrsnchrg,crtordm_cnvrsnamt,
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
							   '$crncynm','$cnvtrval','$cnvtrchrg','$crncyprc',
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
					$cart_dlvrdt	  = $arr_cartcodeval[3]; // Stores the product size
					$cart_prodshirt	  = $arr_cartcodeval[4]; // Stores the product shirt lenght
					$cartcurprodslv   = $arr_cartcodeval[5]; // Stores the product sleeve Length
					$cartcurprodsztyp = $arr_cartcodeval[6]; // Stores the product sleeve Length
					$untqty 		  = $qtyarr[$cartcodeid]; // Stores the unit quantities
					$cart_ordsts	  = "a";
					$sqryprod_dtl1 = "select 
											prodm_id,prodm_code,prodcatm_dlvrtyp,taxm_prscntg,
											(prodprcd_prc+((prodprcd_prc*$cnvtrchrg)/100)) as prodprcd_prc,
											if(prodprcd_ofrprc > 0,((prodprcd_ofrprc+(prodprcd_ofrprc*$cnvtrchrg)/100)),prodprcd_ofrprc) as prodprcd_ofrprc,
											((prodprcd_prc+((prodprcd_prc*$cnvtrchrg)/100)) * $cnvtrval) as prodprcd_crncyprc,
											if(prodprcd_ofrprc > 0,((prodprcd_ofrprc+(prodprcd_ofrprc*$cnvtrchrg)/100)) * $cnvtrval,prodprcd_ofrprc) as prodprcd_crncyofrprc
										 from 
											vw_prod_size_dtl 										 
										 where 
											prodm_id='$cart_prodid' and
											sizem_id ='$cart_prodprc'";
					$srsprod_dtl1  = mysqli_query($conn,$sqryprod_dtl1);				
					$srowprod_dtl1 = mysqli_fetch_assoc($srsprod_dtl1);
					$prod_dlvrtyp = $srowprod_dtl1['prodcatm_dlvrtyp'];
					$prod_prsntg = $srowprod_dtl1['taxm_prscntg'];
					if($prod_prsntg == ''){
						$prod_prsntg ='NULL';
					}
					if($srowprod_dtl1['prodprcd_ofrprc'] > 0){					
						$produntprc = $srowprod_dtl1['prodprcd_ofrprc'];
					}
					else{
						$produntprc = $srowprod_dtl1['prodprcd_prc'];
					}
					if($srowprod_dtl1['prodprcd_crncyofrprc'] > 0){					
						$prodcrncy_untprc = $srowprod_dtl1['prodprcd_crncyofrprc'];
					}
					else{
						$prodcrncy_untprc = $srowprod_dtl1['prodprcd_crncyprc'];
					}										
					//$totuntprc    = ($untqty * $produntprc); 
					$iqrycrtord_dtl  ="insert into crtord_dtl(
									   crtordd_sesid,crtordd_prodm_id,crtordd_prc,crtordd_qty,
									   crtordd_cnvrprc,crtordd_dlvrdt,crtordd_dlvrtyp,crtordd_taxprsntg,
									   crtordd_sizem_id,crtordd_sts,crtordd_crtordm_id,crtordd_crtdon,
									   crtordd_crtdby)values(
									   '$crtsesval','$cart_prodid','$produntprc','$untqty',
									   '$prodcrncy_untprc','$cart_dlvrdt','$prod_dlvrtyp',$prod_prsntg,
									   '$cart_prodprc','$cart_ordsts','$ordmstid','$dt',
									   '$membremail')";
					$irscrtord_dtl	= mysqli_query($conn,$iqrycrtord_dtl)  or die(mysql_error());
				}// End of For each		
			}					
			if($irscrtord_dtl==true){
				$sqryordsts_mst="select 
									ordstsm_id 
								 from 
								 	ordsts_mst 
								 where 
								 	ordstsm_sts='a' 
								 order by 
								 	ordstsm_prty asc limit 1";
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
				$_SESSION['sescnvtrval']='';
				$_SESSION['sescnvr_chrg']='';
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
									date_format(crtordm_crtdon,'%h:%i:%s') as crtordm_crtdon_tm,
									crtordm_crncynm,crtordm_crncyval,crtordm_cnvrsnchrg,
									crtordm_cnvrsnamt									
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
					$crtord_id	= $srowcrtord_mst['crtordm_id'];											
					$bfname  	= $srowcrtord_mst['crtordm_fstname'];
					$blname	  	= $srowcrtord_mst['crtordm_lstname'];	
					$bemail 	= $srowcrtord_mst['crtordm_emailid'];
					$ordcode 	= $srowcrtord_mst['crtordm_code'];
					$ordmid	 	= base64_encode($srowcrtord_mst['crtordm_id']);
					$orddate 	= $srowcrtord_mst['crtordm_crtdon_dt']." ".$srowcrtord_mst['crtordm_crtdon_tm'];
					$shipname 	= $srowcrtord_mst['shpchrgm_name'];	 
					$shpprc  	= $srowcrtord_mst['crtordm_shpchrgamt'];
					$sfname   	= $srowcrtord_mst['crtordm_sfstname'];	 
					$slname	  	= $srowcrtord_mst['crtordm_slstname'];	 			   
					$sadrs	  	= $srowcrtord_mst['crtordm_sadrs'];
					$sadrs2   	= $srowcrtord_mst['crtordm_sadrs2'];
					$scty 	  	= $srowcrtord_mst['sctynm'];
					$scounty  	= $srowcrtord_mst['scntynm'];
					$scountry 	= $srowcrtord_mst['scntrynm'];
					$badrs	  	= $srowcrtord_mst['crtordm_badrs'];
					$badrs2   	= $srowcrtord_mst['crtordm_badrs2'];
					$bcty 	  	= $srowcrtord_mst['bctynm'];
					$bcounty  	= $srowcrtord_mst['bcntynm'];
					$bcountry 	= $srowcrtord_mst['bcntrynm'];
					$bzip	  	= $srowcrtord_mst['crtordm_bzip'];		
					$bemail	  	= $srowcrtord_mst['crtordm_emailid'];
					$bphno	  	= $srowcrtord_mst['crtordm_bdayphone'];
					$szip	  	= $srowcrtord_mst['crtordm_szip'];		
					$semail	  	= $srowcrtord_mst['crtordm_semailid'];	
					$sphno	  	= $srowcrtord_mst['crtordm_sdayphone'];
					$ordamt	  	= $srowcrtord_mst['crtordm_amt'];
					$shpamt	  	= $srowcrtord_mst['crtordm_shpchrgamt'];
					$crtwt	  	= $srowcrtord_mst['crtordm_wt'];
					$totcrtprc 	= $ordamt + $shipprc;
					$db_pmode 	= funcPayMod($srowcrtord_mst['crtordm_pmode']);
					$dispsy 	= funcDispCrnt($srowcrtord_mst['crtordm_paysts']);
					$db_ordqty	= $srowcrtord_mst['crtordm_qty'];
					$db_ordamt	= $srowcrtord_mst['crtordm_amt'];
					$db_ordrmks	= $srowcrtord_mst['crtordm_rmks'];
					$db_crncynm	= $srowcrtord_mst['crtordm_crncynm'];
					$db_crnvrtval =$srowcrtord_mst['crtordm_crncyval'];
					//$dispsy    ="No";
					$shpcmpltadrs ="";					
					if($sfname != ''){
						$shpcmpltadrs = $sfname;	
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
					if($bemail != ''){
						$shpcmpltadrs .= "<br>".$bemail;	
					}
					$blngcmpltadrs ="";					
					if($bfname != ''){
						$blngcmpltadrs = $bfname;	
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
					if($bemail != ''){
						$blngcmpltadrs .= "<br>".$bemail;	
					}	   
					$hdimg    = $u_prjct_dspmnurl.$site_logo;//Return the URL
					$orddate	= date('l jS F Y',strtotime($orddate));															
/*<h1 style='margin-top:5px; margin-bottom:5px; font-family: Georgia, 'Times New Roman', Times, serif; font-size:30px'>$usr_cmpny</h1>*/
			$msgbody="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
					<html>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
					<title>$usr_cmpny | Order has been logged, payment is pending</title>
					<style type='text/css'>
					#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block} a{color:#109547; text-decoration:none;} a:hover{color:#ea7724; text-decoration:none;}
					</style>
					</head>
					<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
					<div style='background-color:#fff;'>
					  <table style='background-color: #ffffff;' width='100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
						  <td><table style=' background-color:#ffffff' background='#ffffff' width='605' border='0' align='center' cellpadding='20' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'>
								<table width='181' border='0' align='left' cellpadding='0' cellspacing='0'>
									<tr>
									  <td valign='top' align='center' bgcolor='#FFFFFF'><a href='".$u_prjct_dspmnurl."home'><img src='".$hdimg."' alt='".$usr_cmpny."' border='0'></a></td>
									</tr>
								  </table></td>
							  </tr>
							</table>
							<table style='background-color:#ffffff;padding:0' background='#ffffff' width='605' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
								<td valign='top' bgcolor='#ffffff'>
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
								 <p style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Thank you for your order. Your order has been logged and we are waiting for the payment. </p>
								  </td>
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
								<td align='center'><p style='color:#ff6600'>Payment Type</p></td>
								<td align='center'><p style='color:#ff6600'>Payment Status</p></td>
							  </tr>
							  <tr valign='top'>
								<td align='center'  >$ordcode</td>
								<td align='center' >$orddate</td>
								<td align='center' >$db_pmode</td>
								<td align='center' >$dispsy</td>
							  </tr>
							</table>
							<table align='center' width='605' cellpadding='0' cellspacing='0' bgcolor='#ffffff' style='background-color:#ffffff'>
							  <tr>
								<td><p style='color:#ff6600;font-family:Arial, Helvetica, sans-serif;margin-top:5px; margin-bottom:5px'>Your Recent Order:</p></td>
							  </tr>
							  <tr>
								<td><table width='100%' cellpadding='5' cellspacing='0' border='1' bordercolor='#dfdfdf' style='border:1px solid #dfdfdf'>
									<tr>
										<td colspan=7 align='right'>All price(s) are in ($db_crncynm) only</td>
									</tr>
									<tr>
									  <td  valign='middle'><p style='color:#ff6600'>Details</p></td>
									  <td><p style='color:#ff6600'>Tax Type</p></th>
									  <td><p style='color:#ff6600'>Tax Rate</p></th>
								      <td><p style='color:#ff6600'>Tax Amount</p></th>
									  <td  valign='middle'><p style='color:#ff6600'>Unit Price</p></td>
									  <td  valign='middle'><p style='color:#ff6600'>Qty</p></td>
									  <td align='right' valign='middle'><p style='color:#ff6600'>Total Price</p></td>
									</tr>";
													 $sqrycrtord_dtl ="select 
																			prodm_code,crtordd_id,crtordd_qty,crtordd_cnvrprc,																			
																			crtordd_prc,prodm_name,sizem_name,crtordd_dlvrdt,
																			crtordd_dlvrtyp,crtordd_taxprsntg,taxm_name
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
															//$prcval = $rowspo_mst['crtordd_prc'];
															$prcval = ($rowspo_mst['crtordd_prc'] * $db_crnvrtval);
															if($prcval <=0){
																$prcval = 'N.A';
															}
															$tx_txtyp    = $rowspo_mst['taxm_name'];
															 $db_dlvr_typ = funcDsplyDlvrtyp($rowspo_mst['crtordd_dlvrtyp']);	
															 $cart_dlvrdt = $rowspo_mst['crtordd_dlvrdt'];
															 $cart_dlvrdt    	= date('d-m-Y h:i A', strtotime($cart_dlvrdt));
															$prduntprc = $prcval;
															$tx_prscntg = '-';
															$tx_prc     = '';
															if($rowspo_mst['crtordd_taxprsntg'] > 0){
																$tx_prscntg 	= $rowspo_mst['crtordd_taxprsntg'] ."%";
																//$tx_prc = number_format((($prcval * $tx_prscntg)/100),2,".",",");
																//$prduntprc = number_format(($prcval - $tx_prc),2,".",",");
																$txprsnt_val = (100 + $tx_prscntg);
								                                $single_tax  = ($prcval/$txprsnt_val);
																$prduntprc = number_format((100 * $single_tax),2,".",",");
																$tx_prc    = number_format(($tx_prscntg * $single_tax),2,".",",");
																$tottaxprc += ($tx_prscntg * $single_tax);
															}	 			
															$msgbody.="<tr>
															  <td
															  <b>Code: </b>$rowspo_mst[prodm_code]<br/><b>Name: </b> $rowspo_mst[prodm_name]<br/><b>Delivery Type : </b>$db_dlvr_typ<br/><b>Delivery Date : </b>$cart_dlvrdt
															  </td>
															  <td align='center' >$tx_txtyp</td>
															  <td align='center' >$tx_prscntg</td>
															  <td align='center'>$tx_prc</td>
															  <td>$prduntprc</td>
															  <td>$rowspo_mst[crtordd_qty]</td>
															  <td align='right' valign='middle'>";
															  $totitmprc = ($rowspo_mst['crtordd_qty']*$prcval);
															$totprdqty +=  $rowspo_mst['crtordd_qty'];	
															//$tottaxprc +=  $tx_prc;
															$totcrtprc +=  $totitmprc;
															if($totcrtprc <= 0){
																$msgbody.= 'N.A';
															}else{
																$msgbody.= number_format($totitmprc,2,".",",");
															}
															$msgbody.= "</td>
															</tr>";							
														}
													}		
													$grscrtprc = $totcrtprc + $shipprc;
													/*if($grscrtprc <= 0){
														$msgbody.='N.A';
													}else{
														$msgbody.=number_format($grscrtprc,2,'.',',');
													}*/
						$msgbody.="<tr><td  colspan='3' align='right'>Total</td>
							<td align='right'>".number_format($tottaxprc,2,'.',',')."</td>
							<td>&nbsp;</td><td align='right'>$totprdqty</td>
							<td align='right'>".number_format($totcrtprc,2,'.',',')."</td>
				</tr>";							
										/*		$msgbody.="<tr>
                  <td  colspan='6' align='right'>Product Cost:";
				   if($shipprc > 0){
				   		$msgbody.="<br/>Ship Cost:";
				   }
				   $totgrntprcval = number_format($totcrtprc,2,'.',',');
				   if($totcrtprc <=0){
				   		$totgrntprcval ='N.A';
				   }
				   $msgbody.="</td>
					<td align='right' valign='middle'>$totgrntprcval";
					if($shipprc > 0){
						$msgbody.="<br/>".number_format($shipprc,2,'.',',');
					}
					$msgbody.="</td>
                </tr>";*/
				$msgbody.="<tr>
                  <td  colspan='6' align='right'>Order Amount: </td>
                  <td align='right' valign='middle'>".number_format($grscrtprc,2,'.',',')."</td>
                </tr>";
				/*$msgbody.="<tr>
                  <td  colspan='6' align='right'>Payment ($db_pmode): </td>
                  <td align='right' valign='middle'>".number_format($grscrtprc,2,'.',',')."</td>
                </tr>";*/
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
									Customer Service,<br><br>
									Support &amp; Answer Center<br>
						 $usr_pgtl<br>
						  <a href='http://$u_prjct_mnurl'>$u_prjct_mnurl</a><br>
								  </p></td>
							  </tr>
							</table></td>
						</tr>
					  </table>
					</div>
					</body>
					</html>";
				    $to       = $bemail;
					$from     = $u_prjct_ordemail;
					$subject  = "Your $usr_cmpny order " .$ordcode." has been Placed";
					$headers  = "From: " . $from . "\r\n";
					$headers .= "CC: ".$from ."\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$msgbody,$headers);	
							}	
				 //exit();
				if($paymode =='a'){
					?>
						<form name="frmpayment" id="frmpayment" method="post">
						<input type="hidden"  name="orderref" value="<?php echo $ordmstid;?>" />	
						<input type="hidden" name="hdnpaymode" value="<?php echo $paymode;?>"> 		
					</form>
					<script language="javascript" type="text/javascript">
						<?php /*document.getElementById('frmpayment').action = "<?php echo "http://".$u_prjct_mnurl;?>/successtran";*/ ?>
						document.getElementById('frmpayment').action = "<?php echo $u_prjct_dspmnurl;?>successtran";
						document.getElementById('frmpayment').submit();
					</script>
				<?php	
				}elseif($paymode =='c' || $paymode =='b' || $paymode =='d'){ 			 
					$action = '../new/ccavRequestHandler.php';			 
				?>
<form action="<?php echo $action;?>" method="post" name="frmpymntccav" id="frmpymntccav">   
					  <input type="hidden" name="tid"  value="<?php echo $ordmstid;?>" /> 
					  <input type="hidden" name="merchant_id" value="10001" />
					  <input type="hidden" name="order_id" value="<?php echo $ordmstid;?>"/>
					  <input type="hidden" name="amount"  value="<?php echo $paygrsamt;?>"/>
					  <input type="hidden" name="currency"  value="INR" />
					  <input type="hidden" name="redirect_url"  value="http://<?php echo $u_prjct_mnurl;?>/successtran" />
					  <input type="hidden" name="cancel_url" value="http://<?php echo $u_prjct_mnurl;?>/ccavResponseHandler.php" />
					  <input type="hidden" name="language" value="EN" />
					  <input type="hidden" name="billing_name" value="<?php echo $bfname." ".$blname;?>"/>
					  <input type="hidden" name="billing_address" value="<?php echo $badrs." ".$badrs2;?>">  
                      <input type="hidden" name="billing_city" value="<?php echo $bctyname;?>">  
                      <input type="hidden" name="billing_state" value="<?php echo $bcntyname;?>">  
                      <input type="hidden" name="billing_zip" value="<?php echo $bzip;?>">
					  <input type="hidden" name="billing_country" value="<?php echo $bcntryname;?>"> 	
                      <input type="hidden" name="billing_tel" value="<?php echo $bph;?>"> 	
                      <input type="hidden" name="billing_email" value="<?php echo $bemail;?>"> 	
                      <input type="hidden" name="delivery_name" value="<?php echo $sfname." ".$slname;?>"> 
                      <input type="hidden" name="delivery_address" value="<?php echo $sadrs." ".$sadrs2;?>"> 
                      <input type="hidden" name="delivery_city" value="<?php echo $sctyname;?>"> 
                      <input type="hidden" name="delivery_state" value="<?php echo $scntyname;?>"> 
                      <input type="hidden" name="delivery_zip" value="<?php echo $szip;?>"> 
                      <input type="hidden" name="delivery_country" value="<?php echo $scntryname;?>"> 
                      <input type="hidden" name="delivery_tel" value="<?php echo $sph;?>"> 
                      <input type="hidden" name="merchant_param1" value=""> 
                      <input type="hidden" name="merchant_param2" value=""> 
                      <input type="hidden" name="merchant_param3" value=""> 
                      <input type="hidden" name="merchant_param4" value=""> 
                      <input type="hidden" name="merchant_param5" value=""> 
					</form>          				 
					<script language="javascript" type="text/javascript">
						document.getElementById('frmpymntccav').action = "<?php echo $action;?>";
						document.getElementById('frmpymntccav').submit();
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