<?php	
    include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	include_once "../includes/inc_folder_path.php";
	
	if(isset($_POST['btnsizesbmt']) && (trim($_POST['btnsizesbmt']) != "") &&
	   isset($_POST['lsttrtyp']) && (trim($_POST['lsttrtyp']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	   
		$name         	= glb_func_chkvl($_POST['txtname']);
		$trtyp      	= glb_func_chkvl($_POST['lsttrtyp']);
		$desc         	= addslashes(trim($_POST['txtdesc']));
		$prior    	 	= glb_func_chkvl($_POST['txtprior']);
		$szchrt    	 	= glb_func_chkvl($_POST['txtszchrt']);
		$title    	  	= glb_func_chkvl($_POST['txtseotitle']);
		$seodesc  		= glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd 		= glb_func_chkvl($_POST['txtkywrd']);
		$seoh1ttl  		= glb_func_chkvl($_POST['txtseoh1ttl']);		
		$seoh1desc 		= glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl  		= glb_func_chkvl($_POST['txtseoh2ttl']);
		$seoh2desc 		= glb_func_chkvl($_POST['txtseoh2desc']);
		$frmdate    	= glb_func_chkvl($_POST['txtfrmdt']);
		$todate     	= glb_func_chkvl($_POST['txttodt']);
		
		$sts          = glb_func_chkvl($_POST['lststs']);
		$curdt        = date('Y-m-d h-i-s');
		//$emp          = $_SESSION['sesadmin'];
        $sqryprodsubcat_mst="select 
								sizem_name 
					      	from 
						    	 size_mst								 
					      	where 
						  		  sizem_name ='$name' and
								  sizem_trtypm_id='$trtyp'";
		$srsprodsubcat_mst = mysqli_query($conn,$sqryprodsubcat_mst);
		$rows           = mysqli_num_rows($srsprodsubcat_mst);
		if($rows < 1){
			/*if(isset($_FILES['fleszchrtimg']['tmp_name']) && ($_FILES['fleszchrtimg']['tmp_name']!="")){
				$szimgval = funcUpldImg('fleszchrtimg','cimg');
				if($szimgval != ""){
					$szimgary   = explode(":",$szimgval,2);
					$szdest 	= $szimgary[0];					
					$szsource 	= $szimgary[1];	
				}
			}
			if(isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name'] != "")){					
				$bimgval = funcUpldImg('flebnrimg','bimg');
				if($bimgval != ""){
					$bimgary    = explode(":",$bimgval,2);
					$bdest 		= $bimgary[0];					
					$bsource 	= $bimgary[1];					
				}						
			}*/
			$iqryprodsubcat_mst="insert into size_mst(
								  sizem_name,sizem_desc,sizem_trtypm_id,sizem_seotitle,
							 	  sizem_seodesc,sizem_seokywrd,sizem_seohonettl,sizem_seohtwottl,
								  sizem_seohonedesc,sizem_seohtwodesc,sizem_prty,sizem_sts,
								  sizem_crtdon,sizem_crtdby)values(
								  '$name','$desc','$trtyp','$title',
							 	  '$seodesc','$seokywrd','$seoh1ttl','$seoh1desc',
								  '$seoh2ttl','$seoh2desc','$prior','$sts',
								  '$curdt','$ses_admin')";							  
			$irsprodsubcat_mst= mysqli_query($conn,$iqryprodsubcat_mst) or die(mysql_error());
			if($irsprodsubcat_mst==true){
				/*if(($lsource!='none') && ($bsource!='') && ($bdest != "")){ 
					move_uploaded_file($bsource,$gicnimg_upldpth.$bdest);
				}
				if(($szsource!='none') && ($szsource!='') && ($szdest != "")){ 					
					move_uploaded_file($szsource,$gszchrt_upldpth.$szdest);
					$wtrmrkimgnm = funcWtrMrkSml($gszchrt_upldpth,$szdest,$gicnimg_upldpth,$bdest);					
				}*/
				if($bdest !='' && file_exists($gicnimg_upldpth.$bdest)){
					unlink($gicnimg_upldpth.$bdest);
				}
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
		else{		
			$gmsg = "Duplicate name. Record not saved";
		}
	}
?>