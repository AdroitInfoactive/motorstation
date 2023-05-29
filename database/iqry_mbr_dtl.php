<?php	
	include_once "includes/inc_nocache.php"; 		 // Clearing the cache information
	include_once "includes/inc_membr_session.php";	 // checking for session
	include_once "includes/inc_usr_sessions.php";	 // Including user session value
	include_once "includes/inc_usr_functions.php";	 // Including user function value
		
	if(isset($_POST['txtfname']) && (trim($_POST['txtfname']) != "") && 
	   isset($_POST['txtemail']) && (trim($_POST['txtemail']) != "") && 
	   isset($_POST['lstcntnt']) && (trim($_POST['lstcntnt']) != "") && 
		isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	  	(isset($_POST['lstbcnty']) && (trim($_POST['lstbcnty']) != "") or
	  	isset($_POST['txtbcnty']) && (trim($_POST['txtbcnty']) != "")) &&
	  	(isset($_POST['lstbcty']) && (trim($_POST['lstbcty']) != "") or
	  	isset($_POST['txtbcty']) && (trim($_POST['txtbcty']) != "")) &&
	   isset($_POST['txtbadrs']) && (trim($_POST['txtbadrs']) != "") &&
	   isset($_POST['txtbzpcod']) && (trim($_POST['txtbzpcod']) != "") && 
	   isset($_POST['txtbphno']) && (trim($_POST['txtbphno']) != "")){   
	   
		$email     = glb_func_chkvl($_POST['txtemail']);
		$fname     = glb_func_chkvl($_POST['txtfname']);
		$lname     = glb_func_chkvl($_POST['txtlname']);
		$baddrs1   = glb_func_chkvl($_POST['txtbadrs']);
		$baddrs2   = glb_func_chkvl($_POST['txtbadrs2']);
		//$bcty  	   = glb_func_chkvl($_POST['lstbcty']);
		$bzpcode   = glb_func_chkvl($_POST['txtbzpcod']);
		$bphno	   = glb_func_chkvl($_POST['txtbphno']);
		//$bcntry    = glb_func_chkvl($_POST['lstcntry']);
		//$bcnty     = glb_func_chkvl($_POST['lstbcnty']);					
		
		$othrbcntry= "";
		$othrbcnty = "";	
		$othrbcty  = "";	
		$bcntry    = glb_func_chkvl($_POST['lstcntry']);
		$bcnty     = glb_func_chkvl($_POST['lstbcnty']);	
		$bcty      = glb_func_chkvl($_POST['lstbcty']);
		$dt        = date('Y-m-d');
		if(($bcnty == "so") || ($bcnty == '')){
			$othrbcnty = glb_func_chkvl($_POST['txtbcnty']);	
			$bcnty     = "NULL";	
		    //$bcty      = "NULL";
			$sqrycnty_mst="select
							 cntym_id,cntym_name
					   from 
					   		cnty_mst
					   where 
					   		cntym_name='$othrbcnty' and
							cntym_cntrym_id = '$bcntry'";
			$srscnty_mst = mysqli_query($conn,$sqrycnty_mst);
			$rows = mysqli_num_rows($srscnty_mst);
			if($rows == 0){
				 $iqrycnty_mst="insert into cnty_mst(
							   cntym_name,cntym_cntrym_id,cntym_iso,
							   cntym_sts,cntym_crtdon,cntym_crtdby)
							   values(
							   '$othrbcnty','$bcntry','$iso',
							   'u','$dt','$membremail')";
				$irscnty_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
				$bcnty = mysql_insert_id();
			}
			else{
				$srowcnty_mst = mysqli_fetch_assoc($srscnty_mst);
				$bcnty 	      =$srowcnty_mst['cntym_id'];
			}	
		}
		if(($bcty == "co") || ($bcty == '')){
			$othrbcty  = glb_func_chkvl($_POST['txtbcty']);	
			$bcty      = "NULL";
			$sqrycty_mst="select 
								ctym_id,ctym_name
							  from cty_mst
							  where 
							  	ctym_name='$othrbcty' and
								ctym_cntym_id ='$bcnty'";
				 $srscty_mst = mysqli_query($conn,$sqrycty_mst) ;
				 $rows = mysqli_num_rows($srscty_mst);
				if($rows == 0){
					$iqrycnty_mst="insert into cty_mst(
								   ctym_name,ctym_cntym_id,ctym_iso,
								   ctym_sts,ctym_crtdon,ctym_crtdby)values(
								   '$othrbcty','$bcnty','$iso',
								   'u','$dt','$membremail')";
					$irscty_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
					$bcty 	 =mysql_insert_id();
				}
				else{
					$srowcty_mst = mysqli_fetch_assoc($srscty_mst);
					$bcty 	     =$srowcty_mst['ctym_id'];
				}
		}	
		$biladrs   = $_POST['chkbiladrs'];
		$shpadrs   = $_POST['chkshpadrs'];		
		$dt        = date('Y-m-d');
		$membrid   = $_SESSION['sesmbrid'];
		$_SESSION['sesmbrdcity']   = $_POST['lstbcty'];
		
		$biladrs   = 'n';		
		$shpadrs   = 'n';
		
		if(isset($_POST['chkbiladrs']) && trim($_POST['chkbiladrs'])){
			$biladrs   = trim($_POST['chkbiladrs']);		
		}
		if(isset($_POST['chkshpadrs']) && trim($_POST['chkshpadrs'])){
			$shpadrs   = trim($_POST['chkshpadrs']);	
		}
		
		$iqrymbr_dtl="insert into mbr_dtl(
						mbrd_emailid,mbrd_fstname,mbrd_lstname,mbrd_badrs,
						mbrd_badrs2,mbrd_bmbrcntrym_id,mbrd_bcty_id,mbrd_bmbrcntym_id,
						mbrd_dfltbil,mbrd_dfltshp,mbrd_bzip,mbrd_bdayphone,
						mbrd_mbrm_id,mbrd_crtdon,mbrd_crtdby) values(
						'$email','$fname','$lname','$baddrs1',
						'$baddrs2','$bcntry','$bcty','$bcnty',
						'$biladrs','$shpadrs','$bzpcode','$bphno',
						'$membrid','$dt','$membremail')";
			$irsmbr_dtl = mysqli_query($conn,$iqrymbr_dtl) or die(mysql_error());
		if($irsmbr_dtl==true){			
			$mbmid = mysql_insert_id();					
			if(($biladrs == 'y') && ($shpadrs == 'y')){				
				$uqrymbr_dtl = "update mbr_dtl set
									mbrd_dfltbil='n',mbrd_dfltshp='n'
								 where 
									mbrd_mbrm_id='$membrid' and 
									mbrd_id !='$mbmid'";
				$ursmbr_dtl  = mysqli_query($conn,$uqrymbr_dtl) or die(mysql_error());
			}		
			else{							
				$sqrymbr_mst_bil ="select 
										mbrd_id
									from
										mbr_dtl
									where
										mbrd_dfltbil ='y' and 
										mbrd_mbrm_id ='$membrid'";
				$srsmbr_mst_bil = mysqli_query($conn,$sqrymbr_mst_bil) or die(mysql_error());
				$cntrecmbr_mst_bil = mysqli_num_rows($srsmbr_mst_bil);
				if($cntrecmbr_mst_bil ==0){
					$biladrs='y';
				}
				if($biladrs=='y'){
					$uqrymbr_dtl="update 
									mbr_dtl set mbrd_dfltbil='y' 
								  where 
										mbrd_mbrm_id=$membrid and 
										mbrd_id=$mbmid";
					$ursmbr_dtl = mysqli_query($conn,$uqrymbr_dtl) or die(mysql_error());
					
					$uqrymbr_dtl1="update 
										mbr_dtl set mbrd_dfltbil='n' 
								  where 
										mbrd_mbrm_id='$membrid' and 
										mbrd_id !='$mbmid'";
					$ursmbr_dtl1 = mysqli_query($conn,$uqrymbr_dtl1) or die(mysql_error());
				}
				$sqrymbr_mst_shp ="select 
										mbrd_id
									from
										mbr_dtl
									where
										mbrd_dfltshp ='y' and 
										mbrd_mbrm_id ='$membrid'";
				$srsmbr_mst_shp = mysqli_query($conn,$sqrymbr_mst_shp) or die(mysql_error());
				$cntrecmbr_mst_shp = mysqli_num_rows($srsmbr_mst_shp);
				if($cntrecmbr_mst_shp ==0){
					$shpadrs='y';
				}
				if($shpadrs=='y'){			
					$uqrymbr_dtl="update 
									mbr_dtl set mbrd_dfltshp='y' 
							  where 
									mbrd_mbrm_id=$membrid and 
									mbrd_id=$mbmid";
					$ursmbr_dtl = mysqli_query($conn,$uqrymbr_dtl) or die(mysql_error());
					$uqrymbr_dtl1="update 
										mbr_dtl set mbrd_dfltshp='n' 
								  where 
										mbrd_mbrm_id=$membrid and 
										mbrd_id!=$mbmid";
					$ursmbr_dtl1 = mysqli_query($conn,$uqrymbr_dtl1) or die(mysql_error());
				}
				
			}
			$gmsg="Record saved successfully ";
		}
		else{
			$gmsg="Record Not Saved ";
		}
	}//close end if		
?>