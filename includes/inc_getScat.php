<?php
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Making database Connection
	
	if(isset($_REQUEST['selcatid']) && (trim($_REQUEST['selcatid']) != "")){
		// creating Drop Down for County
		$result = "";		
		$catid = glb_func_chkvl($_REQUEST['selcatid']);
		$sqryprodscat_mst =  "select 
							   		prodscatm_id,prodscatm_name
							  from 
									prodscat_mst
							  where 
									prodscatm_sts='a' and 
									prodscatm_prodcatm_id = $catid
							  order by 
									prodscatm_prty";								
		$srsprodscat_mst	  = mysqli_query($conn,$sqryprodscat_mst) or die(mysql_error());
		$cntprodscat_inc	  = mysqli_num_rows($srsprodscat_mst);		  
		$dispstr		  	  = "";		
		if($cntprodscat_inc > 0){
			while($srowprodscat_mst = mysqli_fetch_assoc($srsprodscat_mst)){
				$scatid  = $srowprodscat_mst['prodscatm_id'];
				$scatnm  = $srowprodscat_mst['prodscatm_name'];			
				$dispstr .= ","."$scatid:$scatnm";			
			}
			$result = substr($dispstr,1);		
		}
		echo $result;
	}
	
	if(isset($_REQUEST['selslngcatid']) && (trim($_REQUEST['selslngcatid']) != "")){
		// creating Drop Down for County
		$result = "";		
		$catid = glb_func_chkvl($_REQUEST['selslngcatid']);
		$sqryprodscat_mst =  "select 
							   		prodscatm_id,prodscatm_name
							  from 
									vw_cat_prod_mst
							  where 
									prodscatm_sts='a' and 
									prodcatm_id = $catid
							  group by prodscatm_id order by prodscatm_prty";								
		$srsprodscat_mst	  = mysqli_query($conn,$sqryprodscat_mst) or die(mysql_error());
		$cntprodscat_inc	  = mysqli_num_rows($srsprodscat_mst);		  
		$dispstr		  	  = "";		
		if($cntprodscat_inc > 0){
			while($srowprodscat_mst = mysqli_fetch_assoc($srsprodscat_mst)){
				$scatid  = $srowprodscat_mst['prodscatm_id'];
				$scatnm  = $srowprodscat_mst['prodscatm_name'];			
				$dispstr .= ","."$scatid:$scatnm";			
			}
			$result = substr($dispstr,1);		
		}
		echo $result;
	}
	
	if(isset($_REQUEST['selrslngcatid']) && (trim($_REQUEST['selrslngcatid']) != "")){
		// creating Drop Down for County
		$result = "";		
		$catid = glb_func_chkvl($_REQUEST['selrslngcatid']);
		$scatid = glb_func_chkvl($_REQUEST['selrslngscatid']);
		$sqryprodscat_mst =  "select 
							   		prodscatm_id,prodscatm_name
							  from 
									vw_cat_prod_mst
							  where 
									prodscatm_sts='a' and 
									prodcatm_id = $catid
							  group by prodscatm_id order by prodscatm_prty";								
		$srsprodscat_mst	  = mysqli_query($conn,$sqryprodscat_mst) or die(mysql_error());
		$cntprodscat_inc	  = mysqli_num_rows($srsprodscat_mst);		  
		$dispstr		  	  = "";		
		if($cntprodscat_inc > 0){
			while($srowprodscat_mst = mysqli_fetch_assoc($srsprodscat_mst)){
				$scatid  = $srowprodscat_mst['prodscatm_id'];
				$scatnm  = $srowprodscat_mst['prodscatm_name'];			
				$dispstr .= ","."$scatid:$scatnm";			
			}
			$result = substr($dispstr,1);		
		}
		echo $result;
	}
?>