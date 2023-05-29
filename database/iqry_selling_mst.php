<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection	
	if(isset($_POST['btnadprodsbmt']) && (trim($_POST['btnadprodsbmt']) != "") && 
	   isset($_POST['hdnlstcatid']) && (trim($_POST['hdnlstcatid']) != "") &&	
	   isset($_POST['hdnlstscatid']) && (trim($_POST['hdnlstscatid']) != "") &&	
	   isset($_SESSION['sescrossr'])    && (trim($_SESSION['sescrossr'])!="")	&&    
	   isset($_POST['hdntxtprty']) && (trim($_POST['hdntxtprty']) != "")){	   	   
		 $cat1      	= glb_func_chkvl($_POST['hdnlstcatid']);
		 $cat2        	= glb_func_chkvl($_POST['hdnlstscatid']);
		 $prior       	= glb_func_chkvl($_POST['hdntxtprty']);
		 $sts         	= glb_func_chkvl($_POST['hdnlststs']);
		 $dt          	= date('Y-m-d h:i:s');
		 $sqryprod_mst	= "select 
								crsslngm_id
						   from
								crsslng_mst
						   where
								crsslngm_prodcatm_id='$cat1' and
								crsslngm_prodscatm_id='$cat2'";
		 $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
		 $rows       = mysqli_num_rows($srsprod_mst);
		 if($rows > 0){
			$gmsg = "Duplicate product code. Record not saved";
		 }
		 else{	
		  $iqryprod_mst="insert into crsslng_mst(
						   crsslngm_prodscatm_id,crsslngm_prty,crsslngm_sts,
						   crsslngm_crtdon,crsslngm_crtdby)values(
						   '$cat2','$prior','$sts',
						   '$dt','$ses_admin')";		
			$irsprod_mst = mysqli_query($conn,$iqryprod_mst) or die(mysql_error());			
			if($irsprod_mst==true){	
				$prodid	= mysql_insert_id();
				
			/* -----------  Sizes ----------------------*/
			    $secprc 		= explode("<->",$_SESSION['sescrossr']);	
				if($secprc !="" && $prodid!=""){
					$prty = 0;
						for($inc = 0; $inc < count($secprc);$inc++){
							$prty ++;
							$prcs   = explode("--",$secprc[$inc]);
							$catid    = $prcs[0];
							$scatid   = $prcs[1];
							$stsval     = $prcs[2]; 
						   $sqryprodprc_dtl = "select 
													   crsslngd_prodscatm_id
													from 
													   crsslng_dtl
													where 
													   crsslngd_prodscatm_id = '$scatid' and
													   crsslngd_crsslngm_id = '$prodid'";				   
							$srspckpnts_mst   = mysqli_query($conn,$sqryprodprc_dtl);
							$rowsprodprc_dtl  = mysqli_num_rows($srspckpnts_mst);
							if($rowsprodprc_dtl < 1){
								$iqryprodprc_dtl="insert into  crsslng_dtl(
												  crsslngd_prodscatm_id,crsslngd_sts,crsslngd_prty,
												  crsslngd_crsslngm_id,crsslngd_crtdon,crsslngd_crtdby)
												  values(
												  '$scatid','$stsval','$inc',
												  '$prodid','$dt','$admin')";
								$irsprodprc_dtl = mysqli_query($conn,$iqryprodprc_dtl) or die(mysql_error());
								
							}
							else{
							  $gmsg= "Duplicate Subcategory";				  
							}
						}		
					}	
					$_SESSION['sescrossr'] = '';  
					$gmsg = "Record saved successfully";
			}
			else{
				 $gmsg = "Record not saved";			
			}	
				
				
		  }
	}
?>