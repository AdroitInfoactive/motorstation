<?php	
	include_once "includes/inc_nocache.php"; 		 // Clearing the cache information
	//include_once "includes/inc_membr_session.php";	 // checking for session
	include_once "includes/inc_usr_sessions.php";	 // Including user session value
	include_once "includes/inc_usr_functions.php";	 // Including user function value
	include_once "includes/inc_config.php";	 // Including user function value
		
	if(isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtbrthdy']) && (trim($_POST['txtbrthdy']) != "") && 
	    /* isset($_SESSION['sesemlid']) && (trim($_SESSION['sesemlid']) != "") && 
	   isset($_SESSION['sespwdvl']) && (trim($_SESSION['sespwdvl']) != "") &&
	   isset($_SESSION['sespwdvl']) && (trim($_SESSION['sespwdvl']) != "") &&
	   isset($_SESSION['sescnpwdvl']) && (trim($_SESSION['sescnpwdvl']) != "") && 
	   (trim($_SESSION['sespwdvl']) == trim($_SESSION['sescnpwdvl'])) && */
	   isset($_POST['lstgender']) && (trim($_POST['lstgender']) != "")){
	    
	 /* isset($_POST['lstcntnt']) && (trim($_POST['lstcntnt']) != "") && 
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   (isset($_POST['lstbcnty']) && (trim($_POST['lstbcnty']) != "") or
	   isset($_POST['txtbcnty']) && (trim($_POST['txtbcnty']) != "")) &&
	   (isset($_POST['lstbcty']) && (trim($_POST['lstbcty']) != "") or
	   isset($_POST['txtbcty']) && (trim($_POST['txtbcty']) != "")) &&
	   isset($_POST['txtbadrs']) && (trim($_POST['txtbadrs']) != "")&&
	   isset($_POST['txtbzpcod']) && (trim($_POST['txtbzpcod']) != "") && 
	 //  isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "") && 
	   isset($_POST['lstgender']) && (trim($_POST['lstgender']) != "") && 
	   isset($_POST['lstmrtlsts']) && (trim($_POST['lstmrtlsts']) != "") &&
	   isset($_POST['lstdnd']) && (trim($_POST['lstdnd']) != "")){*/
	  
		$email    = glb_func_chkvl($_POST['txtemail']);
		$name     = glb_func_chkvl($_POST['txtname']);
		$lname     = glb_func_chkvl($_POST['txtlname']);
		$cmpny    = glb_func_chkvl($_POST['txtcmpny']);
		$phno     = glb_func_chkvl($_POST['txtphno']);
		$mobno    = glb_func_chkvl($_POST['txtmbno']);
		$gndr     = glb_func_chkvl($_POST['lstgender']);
		$baddrs1  = glb_func_chkvl($_POST['txtbadrs']);
		$baddrs2  = glb_func_chkvl($_POST['txtbadrs2']);
		$brthdy = "0000-00-00";
		if(isset($_REQUEST['txtbrthdy']) && $_REQUEST['txtbrthdy'] !=""){
		$brthdy   = glb_func_chkvl($_POST['txtbrthdy']);
		$brthdy   = date('Y-m-d',strtotime($brthdy));
		}
		$spbrthdy = "0000-00-00";
		if(isset($_REQUEST['txtspbrthdy']) && $_REQUEST['txtspbrthdy'] !=""){
		$spbrthdy = glb_func_chkvl($_POST['txtspbrthdy']);
		 $spbrthdy   = date('Y-m-d',strtotime($spbrthdy));
		}
		$annvsrydy = "0000-00-00";
		if(isset($_REQUEST['txtannvsry']) && $_REQUEST['txtannvsry'] !=""){
		$annvsrydy = glb_func_chkvl($_POST['txtannvsry']);
		 $annvsrydy = date('Y-m-d',strtotime($annvsrydy));
		}
		//$bcntry   = glb_func_chkvl($_POST['lstcntry']);
		//$bcnty    = glb_func_chkvl($_POST['lstbcnty']);	
	//	$bcty  	  = glb_func_chkvl($_POST['lstbcty']);
		
		$lstrlgn  = glb_func_chkvl($_POST['lstrlgn']);
		$bzpcode  = 'NULL';
		if(isset($_REQUEST['txtbzpcod']) && $_REQUEST['txtbzpcod'] !=""){
		$bzpcode  = glb_func_chkvl($_POST['txtbzpcod']);
		}
		$dnd      = glb_func_chkvl($_POST['lstdnd']);		
		$mrtlsts  = glb_func_chkvl($_POST['lstmrtlsts']);
											
		//$biladrs  = glb_func_chkvl($_POST['chkbiladrs']);
		//$shpadrs  = glb_func_chkvl($_POST['chkshpadrs']);		
		$dt       = date('Y-m-d');
		
		/*$sqrymbr_mst = "select 
							mbrm_emailid
						 from 
							mbr_mst
						 where  
							mbrm_emailid = '$sesemail'";
		$srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
		$cntmbr_mst = mysqli_num_rows($srsmbr_mst);
		
		if($cntmbr_mst > 0){
			$gmsg = "Duplicate email id, account not created";
		}
		else{
			$iqrymbr_mst="insert into mbr_mst(
						  mbrm_emailid,mbrm_pwd,mbrm_ipadrs,
						  mbrm_sts,mbrm_crtdon,mbrm_crtdby)values(
						  '$sesemail','$pwd','$ipadrs',
						  '$sts','$dt','$sesemail')";						 
		 	$irsmbr_mst = mysqli_query($conn,$iqrymbr_mst);				
			if($irsmbr_mst==true){*/
		 		
				$othrbcntry= "";
				$othrbcnty = "";	
				$othrbcty  = "";
				$bcntry	   = "0";
				if(isset($_REQUEST['lstcntry']) && $_REQUEST['lstcntry'] !=""){
				$bcntry    = glb_func_chkvl($_POST['lstcntry']);
				}
				$bcnty	   = "0";
				if(isset($_REQUEST['lstbcnty']) && $_REQUEST['lstbcnty'] !=""){
				$bcnty     = glb_func_chkvl($_POST['lstbcnty']);	
				}
				$bcty	   = "0";
				if(isset($_REQUEST['lstbcty']) && $_REQUEST['lstbcty'] !=""){
				$bcty      = glb_func_chkvl($_POST['lstbcty']);
				}
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
										cntym_name,cntym_cntrym_id,cntym_iso,cntym_sts,
										cntym_crtdon,cntym_crtdby)values(							   
										'$othrbcnty','$bcntry','$iso','u',
										'$dt','$email')";
						$irscnty_mst = mysqli_query($conn,$iqrycnty_mst);
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
								  from 
									  cty_mst
								  where 
									  ctym_name='$othrbcty' and
									  ctym_cntym_id ='$bcnty'";
						 $srscty_mst = mysqli_query($conn,$sqrycty_mst) ;
						 $rows = mysqli_num_rows($srscty_mst);
						if($rows == 0){
							$iqrycnty_mst="insert into cty_mst(
										   ctym_name,ctym_cntym_id,ctym_iso,ctym_typ,
										   ctym_sts,ctym_crtdon,ctym_crtdby)values(
										   '$othrbcty','$bcnty','$iso','r',
										   'u','$dt','$email')";
							$irscty_mst = mysqli_query($conn,$iqrycnty_mst);
							$bcty 	 =mysql_insert_id();
						}
						else{
							$srowcty_mst = mysqli_fetch_assoc($srscty_mst);
							$bcty 	     = $srowcty_mst['ctym_id'];
						}
				}	
				$sqrymbrinf_mst="select 
										mbrinfm_name
								 from 
										mbrinf_mst
								 where 
										mbrinfm_name='$name' and
										mbrinfm_mbrm_id = '$membrid'";
				$srsmbrinf_mst = mysqli_query($conn,$sqrymbrinf_mst) or die(mysql_error());
				$rows_mbrinf = mysqli_num_rows($srsmbrinf_mst);
				if($rows_mbrinf > 0){
					$gmsg = "Duplicate name. Record not saved";
				}
				else{
				  $iqrymbr_dtl="insert into mbrinf_mst(
								mbrinfm_email,mbrinfm_name,mbrinfm_lname,mbrinfm_mbrm_id,
								mbrinfm_cmpnynm,mbrinfm_phno,mbrinfm_mobno,mbrinfm_gndr,mbrinfm_adrs,
								mbrinfm_adrs2,mbrinfm_brthdy,mbrinfm_spbrthdy,mbrinfm_cntrym_id,
								mbrinfm_cntym_id,mbrinfm_ctym_id,mbrinfm_rlgn,mbrinfm_sts,
								mbrinfm_zpcode,mbrinfm_dnd,mbrinfm_mrtsts,mbrinfm_annvsrydy,
								mbrinfm_crtdon,mbrinfm_crtdby)values(
								'$email','$name','$lname','$membrid',
								'$cmpny','$phno','$mobno','$gndr','$baddrs1',
								'$baddrs2','$brthdy','$spbrthdy','$bcntry',
								'$bcnty','$bcty','$lstrlgn','a',
								 $bzpcode,'$dnd','$mrtlsts','$annvsrydy',
								'$dt','$email')";				
				$irsmbr_dtl = mysqli_query($conn,$iqrymbr_dtl) or die(mysql_error());
					if($irsmbr_dtl==true){
						//$gmsg = "Record saved successfully";
					?>
						<script>location.href="<?php echo $rtpth;?>view-profile?mbrinfid=<?php echo $membrid;?>";</script>
					<?php
					}
					else{
						$gmsg = "Record not saved";
					}
				}
			//}
		//}
	}
?>