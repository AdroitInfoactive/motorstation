<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection

	if(isset($_POST['btnaddcnty']) && ($_POST['btnaddcnty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
	{
		$name     = glb_func_chkvl($_POST['txtname']);
		$cntryid  = glb_func_chkvl($_POST['lstcntry']);
		$prty     = glb_func_chkvl($_POST['txtprior']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$iso  	  = glb_func_chkvl($_POST['txtiso']);
		$dt       = date('Y-m-d');
		
		$sqrycnty_mst="select
							 cntym_name
					   from 
					   		cnty_mst
					   where 
					   		cntym_name='$name'";
		$srscnty_mst = mysqli_query($conn,$sqrycnty_mst);
		$rows = mysqli_num_rows($srscnty_mst);
		if($rows > 0)
		{
			$gmsg = "Duplicate county name. Record not saved";
		}
		else
		{
			$iqrycnty_mst="insert into cnty_mst(
						   cntym_name,cntym_cntrym_id,cntym_prty,cntym_sts,
						   cntym_iso,cntym_crtdon,cntym_crtdby)values(
						   '$name','$cntryid','$prty','$sts',
						   '$iso','$dt','$ses_admin')";
						  
			$irscnty_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
			if($irscnty_mst==true)
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