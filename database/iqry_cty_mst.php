<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection

	if(isset($_POST['btnaddcty']) && ($_POST['btnaddcty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
	{
		$name     = glb_func_chkvl($_POST['txtname']);
		$lstcnty  = glb_func_chkvl($_POST['lstcnty']);
		$iso  	  = glb_func_chkvl($_POST['txtiso']);
		$prty     = glb_func_chkvl($_POST['txtprior']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$dt       = date('Y-m-d');
		
		$sqrycty_mst="select 
						 ctym_name
					  from 
					  	 cty_mst
					  where 
					  	 ctym_name='$name'";
		 $srscty_mst = mysqli_query($conn,$sqrycty_mst) ;
		 $rows = mysqli_num_rows($srscty_mst);
		if($rows > 0)
		{
			$gmsg = "Duplicate city name. Record not saved";
		}
		else
		{
			$iqrycnty_mst="insert into cty_mst(
			               ctym_name,ctym_cntym_id,ctym_iso,ctym_prty,
						   ctym_sts,ctym_crtdon,ctym_crtdby)values(
						   '$name','$lstcnty','$iso','$prty',
						   '$sts','$dt','$ses_admin')";
			$irscty_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
			if($irscty_mst==true)
			{
				$gmsg = "Record saved successfully";
			}
			else
			{
				$gmsg = "Record not saved";
			}
		}
	}
?>