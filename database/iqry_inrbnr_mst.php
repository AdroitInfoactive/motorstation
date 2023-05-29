<?php
    include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_usr_functions.php"; //Making database Connection		
	
	if(isset($_POST['btnaddinrbnr']) && ($_POST['btnaddinrbnr']!= "")  && 	
	   isset($_POST['txtinrbnr'])    && trim($_POST['txtinrbnr']!= "") && 
	   isset($_POST['txtprior'])   && trim($_POST['txtprior']!= "")){
	     $inrbnr        = glb_func_chkvl($_POST['txtinrbnr']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));		
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $dt          = date('Y-m-d h:i:s');		 	
		 $sqryinrbnr_mst="select 
		                  inrbnrm_name
					   from
					      inrbnr_mst
					   where
					      inrbnrm_name='$inrbnr'";
		$srsinrbnr_mst   = mysqli_query($conn,$sqryinrbnr_mst);
		$rowsinrbnr_mst  = mysqli_num_rows($srsinrbnr_mst);
		if($rowsinrbnr_mst < 1){
		   $iqryinrbnr_mst  ="insert into inrbnr_mst
		                    (inrbnrm_name,inrbnrm_desc,inrbnrm_sts,inrbnrm_prty,
							inrbnrm_crtdon,inrbnrm_crtdby)
							values(
						    '$inrbnr','$desc','$sts','$prior',
							'$dt','$admin')";					   
			$irsinrbnr_mst   = mysqli_query($conn,$iqryinrbnr_mst);
			if($irsinrbnr_mst==true){			
											
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}			
		}
		else{
		   $gmsg = "Duplicate Record not saved";			
		}
	}
?>