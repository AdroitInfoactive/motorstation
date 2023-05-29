<?php	
	include_once "includes/inc_nocache.php"; 		 // Clearing the cache information
	include_once "includes/inc_membr_session.php";	 // checking for session
	include_once "includes/inc_usr_sessions.php";	 // Including user session value
	include_once "includes/inc_usr_functions.php";	 // Including user function value
			
	if(isset($_POST['btnsbmt']) && (trim($_POST['btnsbmt']) != "") &&
	   isset($_POST['txtfname']) && (trim($_POST['txtfname']) != "") && 
	   isset($_POST['lstcntnt']) && (trim($_POST['lstcntnt']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   (isset($_POST['lstbcnty']) && (trim($_POST['lstbcnty']) != "") or
	   isset($_POST['txtbcnty']) && (trim($_POST['txtbcnty']) != "")) &&
	   (isset($_POST['lstbcty']) && (trim($_POST['lstbcty']) != "") or
	   isset($_POST['txtbcty']) && (trim($_POST['txtbcty']) != "")) &&
	   isset($_POST['txtbadrs']) && (trim($_POST['txtbadrs']) != "")&&
	   isset($_POST['txtbzpcod']) && (trim($_POST['txtbzpcod']) != "") && 
	   isset($_POST['txtbphno']) && (trim($_POST['txtbphno']) != "") && 
	   isset($_POST['hdnmbmid']) && (trim($_POST['hdnmbmid']) != "")){  
	   
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
	   	$biladrs   = glb_func_chkvl($_POST['chkbiladrs']);
       	$shpadrs   = glb_func_chkvl($_POST['chkshpadrs']);
		$mbmid     = glb_func_chkvl($_POST['hdnmbmid']);
		
		$dt        = date('Y-m-d');
		$emp       = $_SESSION['sesusr'];
		$membrid   = $_SESSION['sesmbrid'];
		$othrbcntry= "";
		$othrbcnty = "";	
		$othrbcty  = "";	
		$bcntry    = glb_func_chkvl($_POST['lstcntry']);
		$bcnty     = glb_func_chkvl($_POST['lstbcnty']);	
		$bcty      = glb_func_chkvl($_POST['lstbcty']);
		$dt        = date('Y-m-d');
		if(($bcnty == "so") || ($bcnty == '')){
			$othrbcnty = glb_func_chkvl($_POST['txtbcnty']);	
			//$othrbcty  = glb_func_chkvl($_POST['txtbcty']);	
			//$bcntry	   = "NULL";
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
							   cntym_sts,cntym_crtdon,cntym_crtdby)values(							   
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
						  from 
							  cty_mst
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
		$biladrs   = 'n';		
		$shpadrs   = 'n';
		
		if(isset($_POST['chkbiladrs']) && trim($_POST['chkbiladrs'])){
			$biladrs   = trim($_POST['chkbiladrs']);		
		}
		if(isset($_POST['chkshpadrs']) && trim($_POST['chkshpadrs'])){
			$shpadrs   = trim($_POST['chkshpadrs']);	
		}
		 $uqrycnty_mst="update mbr_dtl set 
		 					  mbrd_fstname='$fname',
							  mbrd_lstname='$lname',
							  mbrd_badrs='$baddrs1',
							  mbrd_badrs2='$baddrs2',
							  mbrd_bmbrcntrym_id='$bcntry',
							  mbrd_bcty_id='$bcty',
							  mbrd_bmbrcntym_id='$bcnty',
							  mbrd_bzip='$bzpcode',
							  mbrd_bdayphone='$bphno',
							  mbrd_mbrm_id='$membrid',
							  mbrd_mdfdon='$dt',
							  mbrd_mdfdby='$emp' 
						where 
							  mbrd_id=$mbmid";
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
		
		if($biladrs=='y')
		{
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
		if($shpadrs=='y')
		{			
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
						
		$irsmbr_dtl = mysqli_query($conn,$uqrycnty_mst) or die(mysql_error());
		if($irsmbr_dtl==true)
		{
			$gmsg="Record Updated successfully ";
			?>
				<script language="javascript">
					window.location="<?php echo $rtpth;?>my-account";
				</script>
			<?php
			
		}
		else
		{
			$gmsg="Record Not Updated ";
		}
	}//close end if
?>