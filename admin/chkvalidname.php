<?php
	include_once "../includes/inc_nocache.php";// Includes no data cache
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Making database Connection	
	
	if(isset($_REQUEST['brndname']) && (trim($_REQUEST['brndname']) != ""))	// checking Duplicate name for Brand name
		{
		$result 	  = "";
		$name 		  = glb_func_chkvl($_REQUEST['brndname']);
		$sqrybrnd_mst = "select 	
							 brndm_name 
						 from 
						 	brnd_mst
						 where 
						 	brndm_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['brndid']) && (trim($_REQUEST['brndid']) != ""))
		{
			$brndid = $_REQUEST['brndid'];
		    $sqrybrnd_mst .= " and brndm_id != $brndid";	
		}	
		$srsbrnd_mst  = mysqli_query($conn,$sqrybrnd_mst);
		$reccnt		   = mysqli_num_rows($srsbrnd_mst);
		
		if($reccnt > 0)
		{
			$result = "<font color ='red'><b>Duplicate name</b></font>";
		}
		echo $result;
		}
	if(isset($_REQUEST['pincode']) && (trim($_REQUEST['pincode']) != ""))	 //checking Duplicate name for category 
	{
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['pincode']),0,249));
		$sqryprd_mst = "select pncdm_code from pncd_mst
						where pncdm_code = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['pncdid']) && (trim($_REQUEST['pncdid']) != "")){
			$prdid = glb_func_chkvl($_REQUEST['pncdid']);
			$sqryprd_mst .=" and pncdm_id != $prdid";	
		}	
		$srsprd_mst  = mysqli_query($conn,$sqryprd_mst);
		$reccnt		 = mysqli_num_rows($srsprd_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate code</b></font>";
		}
		echo $result;
	}

	if(isset($_REQUEST['vehtypname']) && (trim($_REQUEST['vehtypname']) != ""))	 //checking Duplicate name for vehicle type 
	{
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['vehtypname']),0,249));
	  $sqryvehty_mst = "select vehtypm_name from vehtyp_mst
						where vehtypm_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['vehtypmid']) && (trim($_REQUEST['vehtypmid']) != "")){
			$prdid = glb_func_chkvl($_REQUEST['vehtypmid']);
			$sqryvehty_mst .=" and vehtypm_id != $prdid";	
		}	
		$srsvehty_mst  = mysqli_query($conn,$sqryvehty_mst);
		$reccnt		 = mysqli_num_rows($srsvehty_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate code</b></font>";
		}
		echo $result;
	}
	// if(isset($_REQUEST['prodcode']) && (trim($_REQUEST['prodcode']) != ""))	 //checking Duplicate name for category 
	// {
	// 	$result = "";
	// 	$name = strip_tags(substr(trim($_REQUEST['prodcode']),0,249));
	// 	$sqryprd_mst = "select prodm_code from prod_mst
	// 					where prodm_code = '".mysqli_real_escape_string($conn,$name)."'";
	// 	if(isset($_REQUEST['prodid']) && (trim($_REQUEST['prodid']) != "")){
	// 		$prdid = glb_func_chkvl($_REQUEST['prodid']);
	// 		$sqryprd_mst .=" and prodm_id != $prdid";	
	// 	}	
	// 	$srsprd_mst  = mysqli_query($conn,$sqryprd_mst);
	// 	$reccnt		 = mysqli_num_rows($srsprd_mst);
		
	// 	if($reccnt > 0){
	// 		$result = "<font color ='#fda33a'><b>Duplicate code</b></font>";
	// 	}
	// 	echo $result;
	// }
// -----------------------------------------------Products duplicate checkvalidation-------------------------------------------------------
	if(isset($_REQUEST['prodcode']) && (trim($_REQUEST['prodcode']) != "") && isset($_REQUEST['prodmncatid']) && (trim($_REQUEST['prodmncatid']) != "") && isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != ""))
{
  $name = glb_func_chkvl($_REQUEST['prodcode'],0,249);
  $prodmncat = glb_func_chkvl($_REQUEST['prodmncatid']);
  $prodcat = glb_func_chkvl($_REQUEST['prodcatid']);
  $sqryprod_mst = "SELECT prodm_code from prod_mst where prodm_brndm_id='$prodmncat' and prodm_vehtypm_id='$prodcat' and prodm_code='$name'";
  if(isset($_REQUEST['subcatid']) && ($_REQUEST['subcatid']!= ""))
  {
    $id =glb_func_chkvl($_REQUEST['subcatid']);
    $sqryprod_mst .= " and prodm_id!=$id";
  }
 // echo  $sqryprod_mst; exit;
	$srsprodscat_mst = mysqli_query($conn,$sqryprod_mst);
  $cnt = mysqli_num_rows($srsprodscat_mst);
  if($cnt > 0)
  {
     echo "<font color=red><strong>Duplicate code</strong></font>";
  }
}
	// ---------------------------------------------------------------------------------------------------------------
	if(isset($_REQUEST['inrbnrname']) && (trim($_REQUEST['inrbnrname']) != "")){
		// checking Duplicate name for inrbnr 
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['inrbnrname']),0,249));
		$sqryinrbnr_mst = "select 
						 	inrbnrm_name 
						 from 
						 	inrbnr_mst
					     where 
						 	inrbnrm_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['inrbnrid']) && (trim($_REQUEST['inrbnrid']) != ""))
		{
			$inrbnrid = $_REQUEST['inrbnrid'];
		    $sqryinrbnr_mst .= " and inrbnrm_id != $inrbnrid";	
		}	
		$srsinrbnr_mst  = mysqli_query($conn,$sqryinrbnr_mst) or die(mysql_error());
		$reccnt		= mysqli_num_rows($srsinrbnr_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}	
	
	if(isset($_REQUEST['sizename']) && (trim($_REQUEST['sizename']) != "")){
		// checking Duplicate name for Size 
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['sizename']),0,249));
		$sqrytrtyp_mst = "select 
						 	trtypm_name 
						 from 
						 	trtyp_mst
					     where 
						 	trtypm_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['sizeid']) && (trim($_REQUEST['sizeid']) != ""))
		{
			$sizeid = $_REQUEST['sizeid'];
		    $sqrytrtyp_mst .= " and trtypm_id != $sizeid";	
		}	
		$srstrtyp_mst  = mysqli_query($conn,$sqrytrtyp_mst) or die(mysql_error());
		$reccnt		= mysqli_num_rows($srstrtyp_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}
	
	if(isset($_REQUEST['taxname']) && (trim($_REQUEST['taxname']) != "")){
		// checking Duplicate name for Size 
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['taxname']),0,249));
		$sqrytax_mst = "select 
						 	taxm_name 
						 from 
						 	tax_mst
					     where 
						 	taxm_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['taxid']) && (trim($_REQUEST['taxid']) != ""))
		{
			$taxid = $_REQUEST['taxid'];
		    $sqrytax_mst .= " and taxm_id != $taxid";	
		}	
		$srstax_mst  = mysqli_query($conn,$sqrytax_mst) or die(mysql_error());
		$reccnt		= mysqli_num_rows($srstax_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}
	if(isset($_REQUEST['cnvrsnname']) && (trim($_REQUEST['cnvrsnname']) != "")){
		// checking Duplicate name for Size 
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['cnvrsnname']),0,249));
		$sqrycnvrsn_mst = "select 
						 	cnvrsnm_name 
						 from 
						 	cnvrsn_mst
					     where 
						 	cnvrsnm_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['cnvrsnid']) && (trim($_REQUEST['cnvrsnid']) != ""))
		{
			$cnvrsnid = $_REQUEST['cnvrsnid'];
		    $sqrycnvrsn_mst .= " and cnvrsnm_id != $cnvrsnid";	
		}	
		$srscnvrsn_mst  = mysqli_query($conn,$sqrycnvrsn_mst) or die(mysql_error());
		$reccnt		= mysqli_num_rows($srscnvrsn_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}			
	
	if(isset($_REQUEST['catonename']) && (trim($_REQUEST['catonename']) != "")){
		// checking Duplicate name for category
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['catonename']),0,249));
		$sqrycatone_mst = "select catonem_name from catone_mst
						where catonem_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['catoneid']) && (trim($_REQUEST['catoneid']) != "")){
			$catid = glb_func_chkvl($_REQUEST['catoneid']);
			$sqrycatone_mst .=" and catonem_id != $catid";	
		}	
		$srscatone_mst  = mysqli_query($conn,$sqrycatone_mst);
		$reccnt		 = mysqli_num_rows($srscatone_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}	
	if(isset($_REQUEST['cattwoname']) && (trim($_REQUEST['cattwoname']) != "")){
		// checking Duplicate name for category
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['cattwoname']),0,249));
		$sqrycattwo_mst = "select 
						   		cattwom_name 
						   from 
						   		cattwo_mst
						   where 
						   		cattwom_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['cattwoid']) && (trim($_REQUEST['cattwoid']) != "")){
			$catid = glb_func_chkvl($_REQUEST['cattwoid']);
			$sqrycattwo_mst .=" and cattwom_id != $catid";	
		}	
		$srscattwo_mst  = mysqli_query($conn,$sqrycattwo_mst);
		$reccnt		 	= mysqli_num_rows($srscattwo_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}
	if(isset($_REQUEST['catthrname']) && (trim($_REQUEST['catthrname']) != "")){
		// checking Duplicate name for category
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['catthrname']),0,249));
		$sqrycatthr_mst = "select 
								catthrm_name 
						   from 
						   		catthr_mst
						   where 
						   		catthrm_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['catthrid']) && (trim($_REQUEST['catthrid']) != "")){
			$catid = glb_func_chkvl($_REQUEST['catthrid']);
			$sqrycatthr_mst .= " and catthrm_id != $catid";	
		}	
		$srscatthr_mst  = mysqli_query($conn,$sqrycatthr_mst);
		$reccnt		 	= mysqli_num_rows($srscatthr_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}		
	/*if(isset($_REQUEST['cntryname']) && (trim($_REQUEST['cntryname']) != ""))	// checking Duplicate name for Link
	{
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['cntryname']),0,249));
		$sqrycntry_mst = "select cntrym_name from cntry_mst
						where cntrym_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['cntryid']) && (trim($_REQUEST['cntryid']) != ""))
		{
			$mid = glb_func_chkvl($_REQUEST['cntryid']);
			$sqrycntry_mst .= " and cntrym_id != $mid ";	
		}	
		$srscntry_mst  = mysqli_query($conn,$sqrycntry_mst);
		$reccnt		   = mysqli_num_rows($srscntry_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}*/
	if(isset($_REQUEST['cntyname']) && (trim($_REQUEST['cntyname']) != ""))	// checking Duplicate name for Country name
	{
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['cntyname']),0,249));
		$sqrycnty_mst = "select 
							   cntym_name 
					  	 from 
						 	  cnty_mst
						  where 
						      cntym_name = '".mysqli_real_escape_string($conn,$name)."'";
						
		if(isset($_REQUEST['cntyid']) && (trim($_REQUEST['cntyid']) != ""))
		{
			$cntyid = glb_func_chkvl($_REQUEST['cntyid']);
			$sqrycnty_mst .= " and cntym_id != $cntyid";	
		}	
		$srscnty_mst  = mysqli_query($conn,$sqrycnty_mst);
		$reccnt		   = mysqli_num_rows($srscnty_mst);
		
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}
	if(isset($_REQUEST['selcntryid']) && (trim($_REQUEST['selcntryid']) != "")){
		// creating Drop Down for County
		$result = "";		
		$cntryid = addslashes(trim($_REQUEST['selcntryid']));
		$sqrycnty_mst =  "select cntym_id,cntym_name
						  from cnty_mst,cntry_mst
						  where cntym_cntrym_id = cntrym_id
						  and cntym_sts='a'
						  and cntrym_id = $cntryid
						  order by cntym_prty";								
		$srscnty_mst	  = mysqli_query($conn,$sqrycnty_mst) or die(mysql_error());
		$dispstr		  = "";
		while($srowcnty_mst = mysqli_fetch_assoc($srscnty_mst))
		{
			$cntymid  = $srowcnty_mst['cntym_id'];
			$cntymnm  = $srowcnty_mst['cntym_name'];			
			$dispstr .= ","."$cntymid:$cntymnm";			
		}
		$result = substr($dispstr,1);		
		echo $result;
	}
	if(isset($_REQUEST['ctyname']) && (trim($_REQUEST['ctyname']) != "") &&
	   isset($_REQUEST['cntyid']) && (trim($_REQUEST['cntyid']) != "")){
	   // checking Duplicate name for City name
	   
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['ctyname']),0,249));
		$cnty = strip_tags(substr(trim($_REQUEST['cntyid']),0,249));
		
		$sqrycty_mst = "select ctym_name from cty_mst
						where ctym_name = '".mysqli_real_escape_string($coon,$name)."' and
						      ctym_cntym_id = '".mysqli_real_escape_string($conn,$cnty)."'";
		if(isset($_REQUEST['ctyid']) && (trim($_REQUEST['ctyid']) != "")){
			$ctyid = glb_func_chkvl($_REQUEST['ctyid']);
			$sqrycty_mst .= " and ctym_id != $ctyid";	
		}	
		$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
		$reccnt		   = mysqli_num_rows($srscty_mst);
		
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}


	if(isset($_REQUEST['lstctyval']) && (trim($_REQUEST['lstctyval']) != "") &&
	   isset($_REQUEST['stornmval']) && (trim($_REQUEST['stornmval']) != "")){
	   // checking Duplicate name for Store name	   
		$result 	= "";
		$ctyid 		= strip_tags(substr(trim($_REQUEST['lstctyval']),0,249));
		$storname 	= strip_tags(substr(trim($_REQUEST['stornmval']),0,249));
		
		$sqrystor_dtl = "select 
							stord_name 
						from 
							vw_stor_dtl							
						where 
							stord_ctym_id = '".mysqli_real_escape_string($conn,$ctyid)."' and
							stord_name = '".mysqli_real_escape_string($conn,$storname)."'";
														
		if(isset($_REQUEST['storidval']) && (trim($_REQUEST['storidval']) != "")){
			$storid 	  = glb_func_chkvl($_REQUEST['storidval']);
			$sqrystor_dtl .= " and ctym_id != $ctyid";	
		}	
		$srsstor_dtl  	= mysqli_query($conn,$sqrystor_dtl);
		$cnt_stor	   	= mysqli_num_rows($srsstor_dtl);		
		if($cnt_stor > 0){
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}	
	
	if(isset($_REQUEST['mbrid']) && (trim($_REQUEST['mbrid']) != "")){
	   // checking Duplicate name for Store name	   
		$result 			= "";
		$mbrid_val 			= strip_tags(substr(trim($_REQUEST['mbrid']),0,249));		
		$sqryprodprvlg_dtl 	= "select 
									prodprvlgd_id
								from 
									vw_prodprvlg_dtl							
								where 
									prodprvlgd_mbrm_id = '".mysqli_real_escape_string($conn,$mbrid_val)."'";
														
		if(isset($_REQUEST['prvlgid']) && (trim($_REQUEST['prvlgid']) != "")){
			$prvlgid 	  = glb_func_chkvl($_REQUEST['prvlgid']);
			$sqryprodprvlg_dtl .= " and prodprvlgd_id != $prvlgid";	
		}	
		$srsprodprvlg_dtl = mysqli_query($conn,$sqryprodprvlg_dtl);
		$cnt_prod	   	  = mysqli_num_rows($srsprodprvlg_dtl);		
		if($cnt_prod > 0){
			$result = "<font color ='#fda33a'><b>Product Already Alloted for this member</b></font>";
		}
		echo $result;
	}	
	if(isset($_REQUEST['eventname']) && (trim($_REQUEST['eventname']) != "") &&
	   isset($_REQUEST['eventdate']) && (trim($_REQUEST['eventdate']) != "")){	    
		$result 	= "";
		$name 		= strip_tags(substr(trim($_REQUEST['eventname']),0,249));
		$date 	    = date('Y-m-d',strtotime(strip_tags(substr(trim($_REQUEST['eventdate']),0,249))));
		$sqryevnt_mst = "select 
							evntm_name 
						 from 
							evnt_mst							
						 where 
							evntm_name = '".mysqli_real_escape_string($conn,$name)."' and
						    evntm_date = '".mysqli_real_escape_string($conn,$date)."'";														
		if(isset($_REQUEST['evntid']) && (trim($_REQUEST['evntid']) != "")){
			$evntid 	  = glb_func_chkvl($_REQUEST['evntid']);
			$sqryevnt_mst .= " and evntm_id!=$evntid ";	
		}
		$srsevnt_mst  = mysqli_query($conn,$sqryevnt_mst);
		$evnt_mst	  = mysqli_num_rows($srsevnt_mst);		
		if($evnt_mst > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Combination Of Name and Date</b></font>";
		}
		echo $result;
	}		
	 if(isset($_REQUEST['cntryname']) && (trim($_REQUEST['cntryname']) != "") && 
   		isset($_REQUEST['cntntid']) && (trim($_REQUEST['cntntid']) != "")){
		$result        = "";
		$name          = strip_tags(substr(trim($_REQUEST['cntryname']),0,249));
		$cntntidval 	   = strip_tags(substr(trim($_REQUEST['cntntid']),0,249));
		$sqrycntry_mst = "select 
							   cntrym_name 
						  from 
						       vw_cntry_cntnt_mst
						  where 
						       cntrym_name = '".mysqli_real_escape_string($conn,$name)."' and 
							   cntrym_cntntm_id = '".mysqli_real_escape_string($conn,$cntntidval)."'";
		if(isset($_REQUEST['cntryid']) && (trim($_REQUEST['cntryid']) != ""))
		{
			$cntryid = glb_func_chkvl($_REQUEST['cntryid']);
			$sqrycntry_mst .= " and cntrym_id != $cntryid";	
		}	
		$srscntry_mst  = mysqli_query($conn,$sqrycntry_mst);
		$reccnt		   = mysqli_num_rows($srscntry_mst);
		
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}
	if(isset($_REQUEST['cntntnm']) && (trim($_REQUEST['cntntnm']) != "")){
		$result = "";
		$cntntnm = strip_tags(substr(trim($_REQUEST['cntntnm']),0,249));
		$sqrycntnt_mst ="select 
		                   cntntm_name
						 from
						   cntnt_mst
						 where
						   cntntm_name ='".mysqli_real_escape_string($conn,$cntntnm)."'";						
		if(isset($_REQUEST['cntntid']) && (trim($_REQUEST['cntntid']) != "")){
			$cntntid = glb_func_chkvl($_REQUEST['cntntid']);
			$sqrycntnt_mst .= " and cntntm_id != $cntntid";	
		}	
		$srscntnt_mst  = mysqli_query($conn,$sqrycntnt_mst)or die(mysql_error());
		$reccnt		   = mysqli_num_rows($srscntnt_mst);		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}
	
		if(isset($_REQUEST['ofrcode']) && (trim($_REQUEST['ofrcode']) != ""))	//checking Duplicate name for Country name
	{
		$result = "";
		$ofrcode = strip_tags(substr(trim($_REQUEST['ofrcode']),0,249));
		$sqryofr_mst = "select 
								 ofrm_code 
						 from 
								 ofr_mst 
						 where 
						 		 ofrm_code  = '".mysqli_real_escape_string($conn,$ofrcode)."'";
						
		if(isset($_REQUEST['ofrid']) && (trim($_REQUEST['ofrid']) != ""))
		{
			$ofrid = glb_func_chkvl($_REQUEST['ofrid']);
			$sqryofr_mst .= " and ofrm_id != $ofrid";	
		}	
		$srsofr_mst  = mysqli_query($conn,$sqryofr_mst);
		$reccnt		   = mysqli_num_rows($srsofr_mst);
		
		if($reccnt > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
	}	
	
	
	if(isset($_REQUEST['prodcatname']) && (trim($_REQUEST['prodcatname']) != "")){
			$name	     	= glb_func_chkvl($_REQUEST['prodcatname']);
				 
			$sqryprodcat_mst	= "select prodcatm_name
							       from 
								   		  prodcat_mst
							       where 
								   		  prodcatm_name='$name'";
			if(isset($_REQUEST['prodid']) && ($_REQUEST['prodid']!= "")){
			
				$id =glb_func_chkvl($_REQUEST['prodid']);
				$sqryprodcat_mst .= " and prodcatm_id!=$id";
			}				   
							   
			$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
			$cnt           = mysqli_num_rows($srsprodcat_mst);
			if($cnt > 0){
			
				echo "<font color=#fda33a><strong>Duplicate Name</strong></font>";
			}               
		}	
		
		if(isset($_REQUEST['szname']) && (trim($_REQUEST['szname']) != "") &&
		   isset($_REQUEST['trtypid']) && (trim($_REQUEST['trtypid']) != "")){
		   
			$name	     	= glb_func_chkvl($_REQUEST['szname']);
			$prodcat	   	= glb_func_chkvl($_REQUEST['trtypid']);
				 
			$sqrysize_mst	= "select sizem_name
							       from 
								   		  size_mst
							       where 
										  sizem_trtypm_id='$prodcat' and							   
								   		  sizem_name='$name'";
			if(isset($_REQUEST['subdid']) && ($_REQUEST['subdid']!= "")){
			
				$id =glb_func_chkvl($_REQUEST['subdid']);
				$sqrysize_mst .= " and sizem_id!=$id";
			}			   
							   
			$srssize_mst = mysqli_query($conn,$sqrysize_mst);
			$cnt           = mysqli_num_rows($srssize_mst);
			if($cnt > 0){
			
				echo "<font color=#fda33a><strong>Duplicate Combination Of Vehicle Type&Name</strong></font>";
			}               
		}
		
		
		if(isset($_REQUEST['prodscatname']) && (trim($_REQUEST['prodscatname']) != "") &&
		   isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != "")){
		   
			$name	     	= glb_func_chkvl($_REQUEST['prodscatname']);
			$prodcat	   	= glb_func_chkvl($_REQUEST['prodcatid']);
				 
			$sqryprodscat_mst	= "select prodscatm_name
							       from 
								   		  prodscat_mst
							       where 
										  prodscatm_prodcatm_id='$prodcat' and							   
								   		  prodscatm_name='$name'";
			if(isset($_REQUEST['subdid']) && ($_REQUEST['subdid']!= "")){
			
				$id =glb_func_chkvl($_REQUEST['subdid']);
				$sqryprodscat_mst .= " and prodscatm_id!=$id";
			}			   
							   
			$srsprodscat_mst = mysqli_query($conn,$sqryprodscat_mst);
			$cnt           = mysqli_num_rows($srsprodscat_mst);
			if($cnt > 0){
			
				echo "<font color=#fda33a><strong>Duplicate Combination Of Vehicle Brand&Name</strong></font>";
			}               
		}
		
		if(isset($_REQUEST['newsname']) && (trim($_REQUEST['newsname']) != "")){
		$result ="";
		$newsname = glb_func_chkvl($_REQUEST['newsname']);			 
			$sqrynew_mst ="select 	
								nwsm_name 
						   from 
								nws_mst
						   where 
								nwsm_name = '".mysqli_real_escape_string($conn,$newsname)."'";
		if(isset($_REQUEST['newsid']) && (trim($_REQUEST['newsid']) != "")){
			$newsid = glb_func_chkvl($_REQUEST['newsid']);
			$sqrynew_mst .= " and nwsm_id != $newsid";	
		}	
		$srsnew_mst  = mysqli_query($conn,$sqrynew_mst);
		$reccnt		   = mysqli_num_rows($srsnew_mst);		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate name</b></font>";
		}
		echo $result;
    }  	
	if(isset($_REQUEST['vdoname']) && (trim($_REQUEST['vdoname']) != "") &&
	  isset($_REQUEST['typval']) && (trim($_REQUEST['typval']) != "")){
		$result ="";
		$vdoname = glb_func_chkvl($_REQUEST['vdoname']);	
		$typval	     	= glb_func_chkvl($_REQUEST['typval']);				 
			$sqryvdo_mst ="select 	
								vdom_name 
						   from 
								vdo_mst
						   where 
								vdom_name = '".mysqli_real_escape_string($conn,$vdoname)."' and
								vdom_typ = '".mysqli_real_escape_string($conn,$typval)."'";
		if(isset($_REQUEST['vdoid']) && (trim($_REQUEST['vdoid']) != "")){
			$vdoid = glb_func_chkvl($_REQUEST['vdoid']);
			$sqryvdo_mst .= " and vdom_id != $vdoid";	
		}	
		$srsvdo_mst  = mysqli_query($conn,$sqryvdo_mst);
		$reccnt		   = mysqli_num_rows($srsvdo_mst);		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Type & name</b></font>";
		}
		echo $result;
    } 
	if(isset($_REQUEST['phtname']) && (trim($_REQUEST['phtname']) != "") &&
	  isset($_REQUEST['typval']) && (trim($_REQUEST['typval']) != "")){
		$result ="";
		$phtname = glb_func_chkvl($_REQUEST['phtname']);	
		$typval	     	= glb_func_chkvl($_REQUEST['typval']);				 
			$sqrypht_mst ="select 	
								phtm_name 
						   from 
								pht_mst
						   where 
								phtm_name = '".mysqli_real_escape_string($conn,$phtname)."' and
								phtm_typ = '".mysqli_real_escape_string($conn,$typval)."'";
		if(isset($_REQUEST['phtid']) && (trim($_REQUEST['phtid']) != "")){
			$phtid = glb_func_chkvl($_REQUEST['phtid']);
			$sqrypht_mst .= " and phtm_id != $phtid";	
		}	
		$srspht_mst  = mysqli_query($conn,$sqrypht_mst);
		$reccnt		   = mysqli_num_rows($srspht_mst);		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Type & name</b></font>";
		}
		echo $result;
    } 
	
	
		if(isset($_REQUEST['ordsts']) && (trim($_REQUEST['ordsts']) != "") &&
			isset($_REQUEST['ordid']) && (trim($_REQUEST['ordid']) != "") &&
			isset($_REQUEST['stsdt']) && (trim($_REQUEST['stsdt']) != "")
			){
			$ordsts	     	= glb_func_chkvl($_REQUEST['ordsts']);			
			$ordid	     	= glb_func_chkvl($_REQUEST['ordid']);
		    $stsdt	     	= glb_func_chkvl($_REQUEST['stsdt']);
			//$newordts = date("d-m-Y", strtotime($stsdt)); 
			$sqryprod_mst	= "SELECT 
									ordstsd_id,ordstsd_ordstsm_id,ordstsd_dttm,
									ordstsd_desc,ordstsd_crtordm_id,ordstsm_name
								FROM 
									ordsts_mst,ordsts_dtl,(SELECT MAX(ordstsd_id) AS oid FROM ordsts_dtl
								WHERE ordstsd_crtordm_id='$ordid' GROUP BY ordstsd_ordstsm_id) AS o_dtl
									WHERE ordstsd_crtordm_id='$ordid'
									AND ordstsm_id=ordstsd_ordstsm_id
									AND ordstsd_id=oid
									GROUP BY ordstsm_name
									order by ordstsm_id desc limit 0,1";						   
			$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
			$cnt        = mysqli_num_rows($srsprod_mst);
			$srsprod_mst = mysqli_fetch_assoc($srsprod_mst);
			$orddates = $srsprod_mst['ordstsd_dttm'];
			 //$date1 = new DateTime($stsdt);
			 //$date2 = new DateTime($orddates);
			//var_dump($date1 >= $date2);	
			if((strtotime($stsdt) >= strtotime($orddates))!= true){			
				echo "Date Should Be After Order Date";
			}
			/* if(($date1 >= $date2)!= true){			
				echo "Date Should Be After Order Date";
			} */
			/*else{
				echo "1";
			}*/			
		}
		
		
	if(isset($_REQUEST['ordstsid']) && (trim($_REQUEST['ordstsid']) != "") ){
		//checking Duplicate name for Size
		$result = "";
		$ordstsid = strip_tags(substr(trim($_REQUEST['ordstsid']),0,249));
		$sqryordsts_mst = "select 
								ordstsm_desc 
						  from 
						  		ordsts_mst
						  where 
						  		ordstsm_id = '".mysqli_real_escape_string($conn,$ordstsid)."'";
								
		
		$srsordsts_mst  = mysqli_query($conn,$sqryordsts_mst);
		$reccnt		  = mysqli_num_rows($srsordsts_mst);
		if($reccnt > 0){
			$srowordsrs_mst = mysqli_fetch_assoc($srsordsts_mst);
			//$result =html_entity_decode(stripslashes($srowordsrs_mst['ordstsm_desc']));
			$result = strip_tags($srowordsrs_mst['ordstsm_desc']);
		}
		echo $result;
	}
	
	if(isset($_REQUEST['stsname']) && (trim($_REQUEST['stsname']) != "")){
		// checking Duplicate name for Categoryone
		$result = "";
		$stsname = glb_func_chkvl($_REQUEST['stsname']);
		$sqrybnr_mst = "select 
							ordstsm_name 
						from 
							ordsts_mst
						where 
							ordstsm_name = '".mysqli_real_escape_string($conn,$stsname)."'";
		if(isset($_REQUEST['ordstsid']) && (trim($_REQUEST['ordstsid']) != "")){
			$bnrid = glb_func_chkvl($_REQUEST['ordstsid']);
			$sqrybnr_mst .= " and ordstsm_id != $ordstsid";	
		}	
		$srsbnr_mst  = mysqli_query($conn,$sqrybnr_mst);
		$reccnt_bnr  = mysqli_num_rows($srsbnr_mst);
		if($reccnt_bnr > 0){			
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	} 
	if(isset($_REQUEST['tckrname']) && (trim($_REQUEST['tckrname']) != "")){
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['tckrname']),0,249));
		$sqrytckr_mst = "select 
								tckrm_name
					   		from 
					   			tckr_mst
						    where 
							    tckrm_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['tckrmid']) && (trim($_REQUEST['tckrmid']) != ""))
		{
			$tckrid = addslashes(trim($_REQUEST['tckrmid']));
			$sqrytckr_mst .= " and tckrm_id != $tckrid ";	
		}	
		$srstckr_mst  = mysqli_query($conn,$sqrytckr_mst);
		$reccnt		   = mysqli_num_rows($srstckr_mst);
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}	
	
	if(isset($_REQUEST['bnrname']) && (trim($_REQUEST['bnrname']) != "")){
		// checking Duplicate name for Categoryone
		$result = "";
		$bnrname = glb_func_chkvl($_REQUEST['bnrname']);
		$sqrybnr_mst = "select 
								bnrm_name 
							from 
								bnr_mst
						   	where 
						   		bnrm_name = '".mysqli_real_escape_string($conn,$bnrname)."'";
		if(isset($_REQUEST['bnrid']) && (trim($_REQUEST['bnrid']) != "")){
			$bnrid = glb_func_chkvl($_REQUEST['bnrid']);
			$sqrybnr_mst .= " and bnrm_id != $bnrid";	
		}	
		$srsbnr_mst  = mysqli_query($conn,$sqrybnr_mst);
		$reccnt_bnr  = mysqli_num_rows($srsbnr_mst);
		if($reccnt_bnr > 0)
		{
			$result = "<font color ='#fda33a'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}
	
	if(isset($_REQUEST['catdval']) && (trim($_REQUEST['catdval']) != "") && 
	   isset($_REQUEST['scatidval']) && (trim($_REQUEST['scatidval']) != "")){
	   //checking Duplicate name for category 
		$result = "";
		$catdval 	= strip_tags(substr(trim($_REQUEST['catdval']),0,249));
		$scatidval 	= strip_tags(substr(trim($_REQUEST['scatidval']),0,249));
		$sqryprd_mst = "select crsslngm_id from crsslng_mst
						where crsslngm_prodscatm_id = '".mysqli_real_escape_string($conn,$scatidval)."'";
			
		$srsprd_mst  = mysqli_query($conn,$sqryprd_mst);
		$reccnt		 = mysqli_num_rows($srsprd_mst);
		
		if($reccnt > 0){
			$result = "<font color ='#fda33a'><b>Duplicate Details</b></font>";
		}
		echo $result;
	}
?>