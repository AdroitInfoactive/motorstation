<?php
    include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_usr_functions.php"; //Making database Connection		
	
	if(isset($_POST['btnaddtax']) && ($_POST['btnaddtax']!= "")  && 	
	   isset($_POST['txttax'])    && trim($_POST['txttax']!= "") && 
	   isset($_POST['txtprior'])   && trim($_POST['txtprior']!= "")){
	     $tax        = glb_func_chkvl($_POST['txttax']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));		
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $prcntg      = glb_func_chkvl($_POST['txtprcntg']);
		 $dt          = date('Y-m-d h:i:s');		 	
		 $sqrytax_mst="select 
		                  taxm_name
					   from
					      tax_mst
					   where
					      taxm_name='$tax'";
		$srstax_mst   = mysqli_query($conn,$sqrytax_mst);
		$rowstax_mst  = mysqli_num_rows($srstax_mst);
		if($rowstax_mst < 1){
		   $iqrytax_mst  ="insert into tax_mst
		                    (taxm_name,taxm_desc,taxm_sts,taxm_prty,
							taxm_prscntg,taxm_crtdon,taxm_crtdby)
							values(
						    '$tax','$desc','$sts','$prior',
							'$prcntg','$dt','$admin')";					   
			$irstax_mst   = mysqli_query($conn,$iqrytax_mst);
			if($irstax_mst==true){			
											
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