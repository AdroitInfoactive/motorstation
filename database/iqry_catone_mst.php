<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	if(isset($_POST['btnaddcat']) && (trim($_POST['btnaddcat']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
	   
		 $name      =  glb_func_chkvl($_POST['txtname']);		 
		 $desc      =  addslashes(trim($_POST['txtdesc']));
		 $seotitle  =  glb_func_chkvl($_POST['txtseotitle']);
		 $seodesc   =  glb_func_chkvl($_POST['txtseodesc']);
		 $seokywrd  =  glb_func_chkvl($_POST['txtseokywrd']);
		 $seoh1ttl  =  glb_func_chkvl($_POST['txtseoh1ttl']);
		 $seoh1desc =  glb_func_chkvl($_POST['txtseoh1desc']);
		 $seoh2ttl  =  glb_func_chkvl($_POST['txtseoh2ttl']); 
		 $seoh2desc =  glb_func_chkvl($_POST['txtseoh2desc']); 
		 $prty      =  glb_func_chkvl($_POST['txtprior']);
		 $sts       =  glb_func_chkvl($_POST['lststs']);
		 $dt        =  date('Y-m-d h:i:s');
		 $sqrycatone_mst="select 
		 						catonem_name
					   	  from 
								catone_mst
					   	  where 
								catonem_name='$name'";
		 $srscatone_mst = mysqli_query($conn,$sqrycatone_mst);
		 $rows         = mysqli_num_rows($srscatone_mst);
		 if($rows < 1){		 	
		    $iqrycatone_mst="insert into catone_mst(
						     catonem_name,catonem_desc,catonem_seotitle,catonem_seodesc,
						     catonem_seokywrd,catonem_seohonetitle,catonem_seohonedesc,catonem_seohtwotitle,
							 catonem_seohtwodesc,catonem_prty,catonem_sts,catonem_crtdon,
							 catonem_crtdby)values(
						     '$name','$desc','$seotitle',' $seodesc',
						     '$seokywrd','$seoh1ttl','$seoh1desc','$seoh2ttl',
							 '$seoh2desc','$prty','$sts','$dt',
							 '$ses_admin')";						     
			$irscatone_mst = mysqli_query($conn,$iqrycatone_mst);
			if($irscatone_mst==true){				
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
			
		 }
		 else{			
			$gmsg = "Duplicate category name. Record not saved";
		 }
	  }
?>