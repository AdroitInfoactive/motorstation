<?php
    
   	include_once "../includes/inc_adm_session.php";//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
		
	if(isset($_POST['btnacntntsbmt']) && (trim($_POST['btnacntntsbmt'])!= "") &&
	   isset($_POST['txtname']) && (trim($_POST['txtname'])!= "") && 	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty'])!= "")){
		
		$name     = glb_func_chkvl($_POST['txtname']);
		$iso      = glb_func_chkvl($_POST['txtisocd']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$prty     = glb_func_chkvl($_POST['txtprty']);		
		$curdt    = date('Y-m-d h:i:s');;
		
		$sqrycntnt_mst="select 
		                 cntntm_name
		               from
					     cntnt_mst
					   where
					     cntntm_name='$name'";
		$srscntnt_mst = mysqli_query($conn,$sqrycntnt_mst);
		$rowscntnt_mst = mysqli_num_rows($srscntnt_mst);
		if($rowscntnt_mst < 1){
		    $iqrycntnt_mst="insert into cntnt_mst(
			             cntntm_name,cntntm_iso,cntntm_sts,cntntm_prty,
						 cntntm_crtdon,cntntm_crtdby)values(						   
						 '$name','$iso','$sts','$prty',
						 '$curdt','$ses_admin')";						  
			$irscntnt_mst = mysqli_query($conn,$iqrycntnt_mst) or die(mysql_error());
			if($irscntnt_mst==true){
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}			
		}
		else{		 
		  $gmsg = "Duplicate Record name. Record not saved";			
		}
	}
?>