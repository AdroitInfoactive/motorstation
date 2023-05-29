<?php	
	include_once '../includes/inc_config.php';	
	include_once $inc_nocache;        //Clearing the cache information
	include_once $adm_session;    //checking for session
	include_once $inc_cnctn;     //Making database Connection
	include_once $inc_usr_fnctn;  //checking for session 
	include_once $inc_fldr_pth;//Floder Path		
	if(isset($_POST['btnanewssbmt']) && (trim($_POST['btnanewssbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){
		$name     = glb_func_chkvl($_POST['txtname']);
		$desc     = addslashes(trim($_POST['txtdesc']));
		$bnrdesc  = addslashes(trim($_POST['txtbnrdesc']));
		$prty     = glb_func_chkvl($_POST['txtprty']);
		$sts      = glb_func_chkvl($_POST['lststs']);
		$curdt    = date('Y-m-d h:i:s');
		
		$sqrynews_dtl="select 
							nwsm_name
					   from 
					   		nws_mst
					   where 
					   		nwsm_name='$name'";
		$srsnews_dtl = mysqli_query($conn,$sqrynews_dtl) or die(mysql_error());
		$cnt_rec     = mysqli_num_rows($srsnews_dtl);
		if($cnt_rec < 1){
			$fle_dwnld     = 'fledwnld';		
			if(isset($_FILES[$fle_dwnld]['tmp_name']) && ($_FILES[$fle_dwnld]['tmp_name']!="")){
				$upld_flenm  = '';	
				$dwnldfleval = funcUpldFle($fle_dwnld,$upld_flenm);
				if($dwnldfleval!=""){ 
					$dwnldfleval = explode(":",$dwnldfleval,2);								
					$fdest 	 	 = $dwnldfleval[0];					
					$fsource	 = $dwnldfleval[1];										
				}				
			}		  	   
		    $iqrynews_dtl="insert into nws_mst(
		   				   nwsm_name,nwsm_desc,nwsm_dwnfl,nwsm_prty,
						   nwsm_sts,nwsm_crtdon,nwsm_crtdby)values(						   
						   '$name','$desc','$fdest','$prty',
						   '$sts','$curdt','$ses_admin')";
			$irsnews_dtl = mysqli_query($conn,$iqrynews_dtl) or die (mysql_error());
			if($irsnews_dtl==true){	
			$prodid	= mysql_insert_id();	
				if(($fsource!='none') && ($fsource!='') && ($fdest != "")){ 
					$fdest = $prodid."-".$fdest;					
					move_uploaded_file($fsource,$dwnfl_upldpth.$fdest);					
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