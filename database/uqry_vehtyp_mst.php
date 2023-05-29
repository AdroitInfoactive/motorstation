<?php
 	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_usr_functions.php";  //checking for session
	include_once '../includes/inc_folder_path.php';//Floder Path
		
	if(isset($_POST['btnedtvehtyp']) && ($_POST['btnedtvehtyp'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") &&
	   isset($_POST['hdnvehtypid']) && ($_POST['hdnvehtypid'] != "") && 
	   isset($_POST['txtprior']) && ($_POST['txtprior'] != "")){		
		$id 	    		= glb_func_chkvl(trim($_POST['hdnvehtypid']));
		$name       	= glb_func_chkvl($_POST['txtname']);
		$desc       	= addslashes(trim($_POST['txtdesc']));
		$simgnm		= glb_func_chkvl($_POST['hdnsimgnm']);
		$zimgnm		= glb_func_chkvl($_POST['hdnzmimgnm']);
		$prior      		= glb_func_chkvl($_POST['txtprior']);
		$sts        		= glb_func_chkvl($_POST['lststs']);
		$loc    			= addslashes(trim($_POST['hdnloc']));
		
		$seotitle   = glb_func_chkvl($_POST['txtseotitle']);
		$seodesc    = glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd   = glb_func_chkvl($_POST['txtseokywrd']);
		$seoh1ttl  	= glb_func_chkvl($_POST['txtseoh1ttl']);
		$seoh1desc	= glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl 	= glb_func_chkvl($_POST['txtseoh2ttl']); 
		$seoh2desc 	= glb_func_chkvl($_POST['txtseoh2desc']);
		
		$val        		= $_REQUEST['val'];
		$dt         		= date('Y-m-d h:i:s');
		$pg         		= $_REQUEST['pg'];
		$countstart 	= $_REQUEST['countstart'];
		/*if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y')
		{
		  $ck="&chk=y";
		}
		if($val != "")
		{
			$srchval= "&val=".$val.$ck;
		}*/
		$sqryvehtyp_mst="select vehtypm_name
					   from vehtyp_mst
					   where vehtypm_name='$name' and
					   vehtypm_id!=$id";
		$srsvehtyp_mst = mysqli_query($conn,$sqryvehtyp_mst);
		$rowsvehtyp_mst= mysqli_num_rows($srsvehtyp_mst);
		if($rowsvehtyp_mst > 0)
		{
		?>
			<script>location.href="view_all_vehicle_type.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
		<?php
		}
		else
		{
		
			$uqryvehtyp_mst="update vehtyp_mst set 
							   vehtypm_name='$name',
							   vehtypm_desc='$desc',
							   vehtypm_seotitle='$seotitle',
							   vehtypm_seodesc='$seodesc',
							   vehtypm_seokywrd='$seokywrd',
							   vehtypm_seohonetitle='$seoh1ttl',
							   vehtypm_seohonedesc='$seoh1desc',	
							   vehtypm_seohtwotitle='$seoh2ttl',
							   vehtypm_seohtwodesc='$seoh2desc',
							   vehtypm_sts='$sts',
							   vehtypm_prty=$prior,
							   vehtypm_mdfdon='$dt',
							   vehtypm_mdfdby='$sesadmin' ";
			/*------------------------------------Update small image----------------------------*/	
				
				if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!=""))
				{
					$simgval = funcUpldImg('flesmlimg','vehtypimg');
					if($simgval != "")
					{
						$simgary    = explode(":",$simgval,2);
						$sdest 		= $simgary[0];					
						$ssource 	= $simgary[1];					
					}
					if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
					{ 
						$simgpth      = $gvehtyp_upldpth.$simgnm;
						
						if(($simgnm != '') && file_exists($simgpth))
						{
							unlink($simgpth);
						}
						move_uploaded_file($ssource,$gvehtyp_upldpth.$sdest);					
						$uqryvehtyp_mst .= ",vehtypm_img='$sdest'";
					}
				}
				if(isset($_FILES['flezmimg']['tmp_name']) && ($_FILES['flezmimg']['tmp_name']!=""))
				{
					$zimgval = funcUpldImg('flezmimg','zmimg');
					if($zimgval != "")
					{
						$zimgary    = explode(":",$zimgval,2);
						$zdest 		= $zimgary[0];					
						$zsource 	= $zimgary[1];					
					}
					if(($zsource!='none') && ($zsource!='') && ($zdest != ""))
					{ 
						$zimgpth      = $gvehtyp_upldpth.$zimgnm;
						
						if(($zimgnm != '') && file_exists($zimgpth))
						{
							unlink($zimgpth);
						}
						move_uploaded_file($zsource,$gvehtyp_upldpth.$zdest);					
						$uqryvehtyp_mst .= ",vehtypm_zmimg='$zdest'";
					}
				}								  
			$uqryvehtyp_mst.="  where vehtypm_id=$id";
			$ursvehtyp_mst = mysqli_query($conn,$uqryvehtyp_mst);
			if($ursvehtyp_mst==true)
			{
			?>
				<script>location.href="view_all_vehicle_type.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			<?php
			}
			else
			{
			?>
				<script>location.href="view_all_vehicle_type.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>"; </script>			
<?php 
			}
		}
	}
?>