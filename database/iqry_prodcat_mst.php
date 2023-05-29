<?php	
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection	
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	if(isset($_POST['btnprodcatsbmt']) && (trim($_POST['btnprodcatsbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	   
	   
		$name      = glb_func_chkvl($_POST['txtname']);
		$desc      = addslashes(trim($_POST['txtdesc']));
		$prior     = glb_func_chkvl($_POST['txtprior']);
		$hmprior   = glb_func_chkvl($_POST['txthmprior']);
		$title     = glb_func_chkvl($_POST['txtseotitle']);
		$seodesc   = glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd  = glb_func_chkvl($_POST['txtkywrd']);
		$seoh1ttl  = glb_func_chkvl($_POST['txtseoh1ttl']);		
		$seoh1desc = glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl  = glb_func_chkvl($_POST['txtseoh2ttl']);
		$seoh2desc = glb_func_chkvl($_POST['txtseoh2desc']);
		$sts       = glb_func_chkvl($_POST['lststs']);
		$dlvr_typ  = glb_func_chkvl($_POST['lstdlvrtyp']);	
		$taxval			= 'NULL';	
		 if(isset($_POST['lsttax']) && (trim($_POST['lsttax'])!='')){
		 	$taxval       		= glb_func_chkvl($_POST['lsttax']);	
		 }
		 
		$cur_dt    = date('Y-m-d h:i:s');
        $sqryprodcat_mst="select 
								prodcatm_name 
					      from 
						    	prodcat_mst
					      where 
						  		prodcatm_name ='$name'";
		$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
		$rows           = mysqli_num_rows($srsprodcat_mst);
		if($rows < 1){
		/*	if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
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
			$iqryprodcat_mst="insert into prodcat_mst(
							  prodcatm_name,prodcatm_sts,prodcatm_desc,prodcatm_seotitle,
							  prodcatm_seodesc,prodcatm_seokywrd,prodcatm_seohonettl,prodcatm_seohonedesc,
							  prodcatm_seohtwottl,prodcatm_seohtwodesc,prodcatm_prty,prodcatm_crtdon,
							  prodcatm_crtdby)values(
							  '$name','$sts','$desc','$title',
							  '$seodesc','$seokywrd','$seoh1ttl','$seoh1desc',
							  '$seoh2ttl','$seoh2desc','$prior','$cur_dt',
							  '$ses_admin')";				
			$irsprodcat_mst= mysqli_query($conn,$iqryprodcat_mst) or die (mysql_error());
			if($irsprodcat_mst==true){
				/*if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 													
					move_uploaded_file($ssource,$gadmcatsml_upldpth.$sdest);					
				}
				if(($lsource!='none') && ($bsource!='') && ($bdest != "")){ 
					move_uploaded_file($bsource,$gadmcatbnr_upldpth.$bdest);
				}
				*/
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