<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//Making database Connection		
	
	if(isset($_POST['btnatckrsbmt']) && (trim($_POST['btnatckrsbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){
	   
		$name     = glb_func_chkvl($_POST['txtname']);
		$desc	  = addslashes(trim($_POST['txtdesc']));	
		$prior    = glb_func_chkvl($_POST['txtprty']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$curdt    = date('Y-m-d h:i:s');
			
		$sqrytckr_dtl ="select 
							tckrm_name
					    from 
					   		tckr_mst
					    where 
					   		tckrm_name='$name'";
		$srstckr_dtl  = mysqli_query($conn,$sqrytckr_dtl);
		$cnt_tckrrows = mysqli_num_rows($srstckr_dtl);
		if($cnt_tckrrows > 0){
			$gmsg = "Duplicate name. Record not saved";
		}
		else{
		   $iqrytckr_dtl="insert into tckr_mst(
			              tckrm_name,tckrm_desc,tckrm_prty,tckrm_sts,						  
						  tckrm_crtdon,tckrm_crtdby)values(
						  '$name','$desc',$prior,'$sts',						  
						  '$curdt','$ses_admin')";
			$irstckr_dtl = mysqli_query($conn,$iqrytckr_dtl);
			if($irstckr_dtl==true){
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
	}
?>