<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection	
	if(isset($_POST['btnedtprodsbmt']) && (trim($_POST['btnedtprodsbmt']) != "") && 
	  //isset($_POST['lstcat']) && (trim($_POST['lstcat']) != "") &&	
	  //isset($_POST['lstscat']) && (trim($_POST['lstscat']) != "") &&	
	  //isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") &&	
	  //isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	  isset($_SESSION['sesedtcross'])   && (trim($_SESSION['sesedtcross'])!="") &&	
	  //isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")   &&
	  isset($_POST['hdnprodid']) && (trim($_POST['hdnprodid'])!= "")){	   	   
		 $prior       	= glb_func_chkvl($_POST['txtprty']);
		 $sts         	= glb_func_chkvl($_POST['lststs']);
		 $dt          	= date('Y-m-d h:i:s');
		 $id         	= glb_func_chkvl($_POST['hdnprodid']);
		 $pg          	= glb_func_chkvl($_REQUEST['hdnpage']);
		 $cntstart  	= glb_func_chkvl($_REQUEST['hdncnt']);
		 $loc    		= addslashes(trim($_POST['hdnloc']));
		/* $sqryprod_mst	= "select 
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
		 }*/
		 //else{	
		 $uqryprod_mst="update crsslng_mst set 
		  				 		crsslngm_prty='$prior',
								crsslngm_sts='$sts',
								crsslngm_crtdon='$dt',
								crsslngm_crtdby='$ses_admin'
							where
								crsslngm_id = '$id'";		
			$ursprod_mst = mysqli_query($conn,$uqryprod_mst) or die(mysql_error());			
			if($ursprod_mst == true){	
			/* -----------  Sizes ----------------------*/
			    $secprc 		= explode("<->",$_SESSION['sesedtcross']);	
				$dqryprodprc_dtl = "delete from 
									 crsslng_dtl
								 where 
									crsslngd_crsslngm_id = $id";
					$drsprodprc_dtl=mysqli_query($conn,$dqryprodprc_dtl);
					if($drsprodprc_dtl=='true'){
						if($secprc !="" && $id!=""){
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
															   crsslngd_crsslngm_id = '$id'";				   
									$srspckpnts_mst   = mysqli_query($conn,$sqryprodprc_dtl);
									$rowsprodprc_dtl  = mysqli_num_rows($srspckpnts_mst);
									if($rowsprodprc_dtl < 1){
										$iqryprodprc_dtl="insert into  crsslng_dtl(
														  crsslngd_prodscatm_id,crsslngd_sts,crsslngd_prty,crsslngd_crsslngm_id,
														  crsslngd_crtdon,crsslngd_crtdby)
														  values(
														  '$scatid','$stsval','$inc','$id',
														  '$dt','$admin')";
										$irsprodprc_dtl = mysqli_query($conn,$iqryprodprc_dtl) or die(mysql_error());
										
									}
									else{
									  $gmsg= "Duplicate Subcategory";				  
									}
								}		
							}
						}	
					$_SESSION['sesedtcross'] = '';  
					?>
					<script>location.href="vw_all_selling_detail.php?sts=y&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>"; </script>
				<?php
				exit;
			}
			else{
				 $gmsg = "Record not saved";			
			}	
				
				
		 // }
	}
?>