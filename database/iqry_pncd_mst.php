<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection

	if(isset($_POST['btnaddpncd']) && ($_POST['btnaddpncd'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['lstcty']) && (trim($_POST['lstcty']) != "") &&
	   isset($_SESSION['sesarea']) && (trim($_SESSION['sesarea'])!="") &&  
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
		$name     = glb_func_chkvl($_POST['txtname']);
		$lstcty  = glb_func_chkvl($_POST['lstcty']);
		$iso  	  = glb_func_chkvl($_POST['txtiso']);
		$prty     = glb_func_chkvl($_POST['txtprior']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$dt       = date('Y-m-d');
		$dlvr_typ  = glb_func_chkvl($_POST['lstdlvrtyp']);	
		$sqrypncd_mst="select 
						 pncdm_id
					  from 
					  	 pncd_mst
					  where 
					  	 pncdm_code='$name'";
		 $srspncd_mst = mysqli_query($conn,$sqrypncd_mst) ;
		 $rows = mysqli_num_rows($srspncd_mst);
		if($rows > 0)
		{
			$gmsg = "Duplicate city name. Record not saved";
		}
		else
		{
			$iqrycnty_mst="insert into pncd_mst(
			               pncdm_code,pncdm_ctym_id,pncdm_dlvrtyp,pncdm_prty,
						   pncdm_sts,pncdm_crtdon,pncdm_crtdby)values(
						   '$name','$lstcty','$dlvr_typ','$prty',
						   '$sts','$dt','$ses_admin')";
			$irspncd_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
			if($irspncd_mst==true){
				$pncdid	= mysql_insert_id();
				/* -----------  Sizes ----------------------*/
			    $secprc 		= explode("<->",$_SESSION['sesarea']);	
				if($secprc !="" && $pncdid!=""){
					$prty = 0;
						for($inc = 0; $inc < count($secprc);$inc++){
							$prty ++;
							$prcs   = explode("--",$secprc[$inc]);
							$areanm    = $prcs[0];
							$stsval     = $prcs[1]; 
						   $sqryprodprc_dtl = "select 
													   pncdd_id
													from 
													   pncd_dtl
													where 
													   pncdd_name = '$areanm' and
													   pncdd_pncdm_id = '$pncdid'";				   
							$srspckpnts_mst   = mysqli_query($conn,$sqryprodprc_dtl);
							$rowsprodprc_dtl  = mysqli_num_rows($srspckpnts_mst);
							if($rowsprodprc_dtl < 1){
								$iqryprodprc_dtl="insert into  pncd_dtl(
												  pncdd_name,pncdd_sts,pncdd_prty,
												  pncdd_pncdm_id,pncdd_crtdon,pncdd_crtdby)
												  values(
												  '$areanm','$stsval','$inc',
												  '$pncdid','$dt','$admin')";
								$irsprodprc_dtl = mysqli_query($conn,$iqryprodprc_dtl) or die(mysql_error());
								
							}
							else{
							  $gmsg= "Duplicate Subcategory";				  
							}
						}		
					}	
					$_SESSION['sesarea'] = ''; 
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
	}
?>