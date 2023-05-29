<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more
	if(isset($_POST['btnaddbnr']) && (trim($_POST['btnaddbnr']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
		$name     = glb_func_chkvl($_POST['txtname']);
		$lnk      = glb_func_chkvl($_POST['txtlnk']);
		$prior    = glb_func_chkvl($_POST['txtprior']);
		$desc     =  addslashes(trim($_POST['txtdesc']));
		$sts      =  glb_func_chkvl($_POST['lststs']);
		$curdt    =  date('Y-m-d h:i:s');
		
		$sqrybnr_mst = "select 
							bnrm_name
						from 
							bnr_mst
						where 
							bnrm_name='$name'";
		 $srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
		 $cnt_bnrm   = mysqli_num_rows($srsbnr_mst);
		 if($cnt_bnrm < 1 ){
		 	if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}
			}
			$iqrybnr_mst="insert into bnr_mst(
						  bnrm_name,bnrm_desc,bnrm_imgnm,bnrm_lnk,
						  bnrm_prty,bnrm_sts,bnrm_crtdon,bnrm_crtdby)values(
						  '$name','$desc','$sdest','$lnk',
						  '$prior','$sts','$curdt','$ses_admin')";
			$irsbnr_mst = mysqli_query($conn,$iqrybnr_mst);
			if($irsbnr_mst==true){
				if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 					
					move_uploaded_file($ssource,$gbnr_fldnm.$sdest);					
				}
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
		else{
			$gmsg = "Duplicate Record. Record not saved";
		}
	}
?>
