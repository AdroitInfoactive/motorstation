<?php
    include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_usr_functions.php"; //Making database Connection		
	
	if(isset($_POST['btnaddcnvrsn']) && ($_POST['btnaddcnvrsn']!= "")  && 	
	   isset($_POST['txtcnvrsn'])    && trim($_POST['txtcnvrsn']!= "") && 
	   isset($_POST['txtprior'])   && trim($_POST['txtprior']!= "")){
	     $cnvrsn        = glb_func_chkvl($_POST['txtcnvrsn']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));		
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $prcntg      = glb_func_chkvl($_POST['txtprcntg']);
		 $dt          = date('Y-m-d h:i:s');		 	
		 $sqrycnvrsn_mst="select 
		                  cnvrsnm_name
					   from
					      cnvrsn_mst
					   where
					      cnvrsnm_name='$cnvrsn'";
		$srscnvrsn_mst   = mysqli_query($conn,$sqrycnvrsn_mst);
		$rowscnvrsn_mst  = mysqli_num_rows($srscnvrsn_mst);
		if($rowscnvrsn_mst < 1){
		   $iqrycnvrsn_mst  ="insert into cnvrsn_mst
		                    (cnvrsnm_name,cnvrsnm_desc,cnvrsnm_sts,cnvrsnm_prty,
							cnvrsnm_val,cnvrsnm_crtdon,cnvrsnm_crtdby)
							values(
						    '$cnvrsn','$desc','$sts','$prior',
							'$prcntg','$dt','$admin')";					   
			$irscnvrsn_mst   = mysqli_query($conn,$iqrycnvrsn_mst);
			if($irscnvrsn_mst==true){			
											
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}			
		}
		else{
		   $gmsg = "Duplicate Size. Record not saved";			
		}
	}
?>