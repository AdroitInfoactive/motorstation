<?php
    include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_usr_functions.php"; //Making database Connection		
	
	if(isset($_POST['btnaddsize']) && ($_POST['btnaddsize']!= "")  && 	
	   isset($_POST['txtsize'])    && trim($_POST['txtsize']!= "") && 
	   isset($_POST['txtprior'])   && trim($_POST['txtprior']!= "")){
	     $size        = glb_func_chkvl($_POST['txtsize']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));		
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $dt          = date('Y-m-d h:i:s');		 	
		 $sqrytrtyp_mst="select 
		                  trtypm_name
					   from
					      trtyp_mst
					   where
					      trtypm_name='$size'";
		$srstrtyp_mst   = mysqli_query($conn,$sqrytrtyp_mst);
		$rowstrtyp_mst  = mysqli_num_rows($srstrtyp_mst);
		if($rowstrtyp_mst < 1){
		   $iqrytrtyp_mst  ="insert into trtyp_mst
		                    (trtypm_name,trtypm_desc,trtypm_sts,trtypm_prty,
							trtypm_crtdon,trtypm_crtdby)
							values(
						    '$size','$desc','$sts','$prior',
							'$dt','$admin')";					   
			$irstrtyp_mst   = mysqli_query($conn,$iqrytrtyp_mst);
			if($irstrtyp_mst==true){			
											
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