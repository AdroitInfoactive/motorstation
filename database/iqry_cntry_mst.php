<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//checking for session
	
	if(isset($_POST['btnacntysbmt']) && ($_POST['btnacntysbmt'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "")&& 	
	   isset($_POST['txtisothr']) && ($_POST['txtisothr'] != "")&& 	
	   isset($_POST['txtprty']) && ($_POST['txtprty'] != "") && 
	   isset($_POST['lstcntntnm']) && (trim($_POST['lstcntntnm']) != "")){
	   
	    $lstcntnt = glb_func_chkvl($_POST['lstcntntnm']);
		$name     = glb_func_chkvl($_POST['txtname']);
		$prty     = glb_func_chkvl($_POST['txtprty']);
		$isotwo   = glb_func_chkvl($_POST['txtisotwo']);
		$isothr   = glb_func_chkvl($_POST['txtisothr']);
		$isonum   = glb_func_chkvl($_POST['txtisonum']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$curdt    = date('Y-m-d');;
		
		$sqrycntry_mst="select 
							cntrym_name
					    from 
					   		cntry_mst
					    where 
					   		cntrym_name='$name' and
							cntrym_cntntm_id = '$lstcntnt'";
		$srscntry_mst = mysqli_query($conn,$sqrycntry_mst);
		$rows = mysqli_num_rows($srscntry_mst);
		if($rows < 1){
			$iqrycntry_mst="insert into cntry_mst(
			                cntrym_cntntm_id,cntrym_name,cntrym_isotwo,cntrym_isothr,
						    cntrym_isonum,cntrym_sts,cntrym_prty,
							cntrym_crtdon,cntrym_crtdby)values(						    
						    '$lstcntnt','$name','$isotwo','$isothr',
							'$isonum','$sts','$prty',
							'$curdt','$ses_admin')";
			$irscntry_mst = mysqli_query($conn,$iqrycntry_mst);
			if($irscntry_mst==true){
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
		else{
			$gmsg = "Duplicate country name. Record not saved";
		}
	}
?>