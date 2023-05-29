<?php
	include_once '../includes/inc_nocache.php';       //Includes no data cache
   	include_once '../includes/inc_connection.php';    //Making database Connection
	include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
	if(isset($_REQUEST['selcntryid']) && (trim($_REQUEST['selcntryid'])!= "")){
		 //creating Drop Down for County
		 $rslt_cnty= "";		 					
		 $cntryid = strip_tags(trim($_REQUEST['selcntryid']));
		 $sqrycnty_mst = "select
					        cntym_id,cntym_name
					      from 
							vw_cntry_cnty_cty_mst
						  where 
						    cntym_sts='a' and
						    cntrym_id = $cntryid
						    group by cntym_id";				
		 $srscnty_mst = mysqli_query($conn,$sqrycnty_mst) or die(mysql_error());
		 $cntrec_cnty = mysqli_num_rows($srscnty_mst);
		 if($cntrec_cnty > 0){
			 while($srowcnty_mst = mysqli_fetch_assoc($srscnty_mst)){		 
				$cntyid   	= $srowcnty_mst['cntym_id'];
				$cntynm   	= $srowcnty_mst['cntym_name'];			
				$rslt_cnty .= ","."$cntyid:$cntynm";				
			 }
			 $rslt_cnty = substr($rslt_cnty,1);				 	
		 }		 
		 echo $rslt_cnty;
	}	
	if(isset($_REQUEST['selcntyid']) && (trim($_REQUEST['selcntyid']) != "")){
		//creating Drop Down for City
		$rslt_cty 	 = "";					
		$cndstr 	 = "";		
		$cntyid 	 = strip_tags(trim($_REQUEST['selcntyid']));	
		$sqrycty_mst = "select
		                   ctym_id,ctym_name
						from 
						   vw_cntry_cnty_cty_mst
						where 
						   ctym_sts='a' and
						   cntym_id =$cntyid
						   group by ctym_id";	
						   							
		$srscty_mst	  = mysqli_query($conn,$sqrycty_mst) or die(mysql_error());
		while($srowcty_mst  = mysqli_fetch_assoc($srscty_mst)){
			$ctyid   	= $srowcty_mst['ctym_id'];
			$ctynm   	= $srowcty_mst['ctym_name'];			
			$rslt_cty  .= ","."$ctyid:$ctynm";				
		}
		$rslt_cty = substr($rslt_cty,1);		
		echo $rslt_cty;		
	}	
	
?>