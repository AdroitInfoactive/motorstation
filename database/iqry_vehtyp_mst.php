<?php
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_usr_functions.php";  //checking for session
	include_once '../includes/inc_folder_path.php';//Floder Path	
	if(isset($_POST['btnaddvehtyp']) && ($_POST['btnaddvehtyp']!= "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['txtprior']) && ($_POST['txtprior'] != "")){
	   
		$name     = glb_func_chkvl($_POST['txtname']);
		$desc     = addslashes(trim($_POST['txtdesc']));
		$prior    = glb_func_chkvl($_POST['txtprior']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$dt       = date('Y-m-d h:i:s');
		
		$seotitle  =  glb_func_chkvl($_POST['txtseotitle']);
		$seodesc   =  glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd  =  glb_func_chkvl($_POST['txtseokywrd']);
		$seoh1ttl  =  glb_func_chkvl($_POST['txtseoh1ttl']);
		$seoh1desc =  glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl  =  glb_func_chkvl($_POST['txtseoh2ttl']); 
		$seoh2desc =  glb_func_chkvl($_POST['txtseoh2desc']);
		
		$sqryvehtyp_mst="select vehtypm_name
					   from vehtyp_mst
					   where vehtypm_name='$name'";
		$srsvehtyp_mst = mysqli_query($conn,$sqryvehtyp_mst);
		$rowsvehtyp_mst         = mysqli_num_rows($srsvehtyp_mst);
		if($rowsvehtyp_mst > 0)
		{
			$gmsg = "Duplicate  name. Record not saved";
		}
		else
		{
		   //**********************IMAGE UPLOADING START*******************************//
			
		   /*------------------------------------Update Brand image----------------------------*/	
			if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!=""))
			{
				$simgval = funcUpldImg('flesmlimg','vehtypimg');
				if($simgval != "")
				{
					$simgary    = explode(":",$simgval,2);
				    $sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}						
			}
			/*-----------------------------------------------------------------------------------*/	
					
			/*------------------------------------Update Zoom image------------------------------*/								
			if(isset($_FILES['flezmimg']['tmp_name']) && ($_FILES['flezmimg']['tmp_name']!=""))
			{
				$zmimgval = funcUpldImg('flezmimg','zmimg');
				if($zmimgval != "")
				{
					$zimgary    = explode(":",$zmimgval,2);
				    $zdest 		= $zimgary[0];					
					$zsource 	= $zimgary[1];	
				}		
			}			
			/*-----------------------------------------------------------------------------------*/
		
			$iqryvehtyp_mst="insert into vehtyp_mst
						  (vehtypm_name,vehtypm_desc,vehtypm_img,vehtypm_zmimg,
						   vehtypm_seotitle,vehtypm_seodesc,vehtypm_seokywrd,vehtypm_seohonetitle,
						   vehtypm_seohonedesc, vehtypm_seohtwotitle,vehtypm_seohtwodesc,vehtypm_sts,
						   vehtypm_prty,vehtypm_crtdon,vehtypm_crtdby)values(
						   '$name','$desc','$sdest','$zdest',
						   '$seotitle','$seodesc','$seokywrd','$seoh1ttl',
							'$seoh1desc','$seoh2ttl','$seoh2desc','$sts',
						   '$prior','$dt','$sesadmin')";
			$rsvehtyp_mst = mysqli_query($conn,$iqryvehtyp_mst) or die(mysql_error());
			if($rsvehtyp_mst==true)
			{
			    if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
				{ 
					move_uploaded_file($ssource,$gvehtyp_upldpth.$sdest);
				}	
				if(($zsource!='none') && ($zsource!='') && ($zdest != ""))
				{ 
					move_uploaded_file($zsource,$gvehtyp_upldpth.$zdest);
				}			
				$gmsg = "Record saved successfully";
			}
			else
			{
				$gmsg = "Record not saved";
			}
		}
	}
?>