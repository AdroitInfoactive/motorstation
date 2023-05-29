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
		 //$emp       =  $_SESSION['sesadmin'];
		 $sqrycattwo_mst="select 
		 					   cattwom_name
					   	  from 
						  	   cattwo_mst
					   	  where 
						  	   cattwom_name='$name'";
		 $srscattwo_mst = mysqli_query($conn,$sqrycattwo_mst);
		 $rows         = mysqli_num_rows($srscattwo_mst);
		 if($rows < 1){		 	
		   	$iqrycattwo_mst="insert into cattwo_mst(
							 cattwom_name,cattwom_desc,cattwom_seotitle,cattwom_seodesc,
							 cattwom_seokywrd,cattwom_seohonetitle,cattwom_seohonedesc,cattwom_seohtwotitle,
							 cattwom_seohtwodesc,cattwom_prty,cattwom_sts,cattwom_crtdon,
							 cattwom_crtdby)values(
							 '$name','$desc','$seotitle',' $seodesc',
							 '$seokywrd','$seoh1ttl','$seoh1desc','$seoh2ttl',
							 '$seoh2desc','$prty','$sts','$dt',
							 '$ses_admin')";
			$irscattwo_mst = mysqli_query($conn,$iqrycattwo_mst);
			if($irscattwo_mst==true){				
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