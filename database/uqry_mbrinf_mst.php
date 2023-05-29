<?php	
	include_once "includes/inc_nocache.php"; 		 // Clearing the cache information
	include_once "includes/inc_membr_session.php";	 // checking for session
	include_once "includes/inc_usr_sessions.php";	 // Including user session value
	include_once "includes/inc_usr_functions.php";	 // Including user function value
		
	if(isset($_POST['btnsbmt']) && (trim($_POST['btnsbmt']) == "Update") 
	 /*&&	
	  isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   (isset($_POST['lstbcnty']) && (trim($_POST['lstbcnty']) != "") or
	   isset($_POST['txtbcnty']) && (trim($_POST['txtbcnty']) != "")) &&
	   (isset($_POST['lstbcty']) && (trim($_POST['lstbcty']) != "") or
	   isset($_POST['txtbcty']) && (trim($_POST['txtbcty']) != "")) &&
	   isset($_POST['txtbadrs']) && (trim($_POST['txtbadrs']) != "")&&
	   isset($_POST['txtbzpcod']) && (trim($_POST['txtbzpcod']) != "") && 
	   isset($_POST['lstmrtlsts']) && (trim($_POST['lstmrtlsts']) != "") &&
	   isset($_POST['lstdnd']) && (trim($_POST['lstdnd']) != "")   */
	   ){
		
		//$name     = glb_func_chkvl($_POST['txtname']);		
		$cmpny    = glb_func_chkvl($_POST['txtcmpny']);
		//$wbst     = glb_func_chkvl($_POST['txtwbst']);
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
		 $annvsrydy   = date('Y-m-d',strtotime($annvsrydy));
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
		$dt       = date('Y-m-d');
		$emp      = $_SESSION['sesmbremail'];
		//$_SESSION['sesmbrdcity']   = $_POST['lstbcty'];
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
			if($rows == 0 && $othrbcnty !=''){
				$iqrycnty_mst="insert into cnty_mst(
							    cntym_name,cntym_cntrym_id,cntym_iso,cntym_sts,
							    cntym_crtdon,cntym_crtdby)values(							   
							    '$othrbcnty','$bcntry','$iso','u',
							    '$dt','$emp')";
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
								   'u','$dt','$emp')";
					$irscty_mst = mysqli_query($conn,$iqrycnty_mst) or die(mysql_error());
					$bcty 	 =mysql_insert_id();
				}
				else{
					$srowcty_mst = mysqli_fetch_assoc($srscty_mst);
					$bcty 	     = $srowcty_mst['ctym_id'];
				}
		}	
		
		   $uqrymbrinf_mst="update mbrinf_mst set 
							  mbrinfm_cmpnynm='$cmpny',
							  mbrinfm_phno='$phno',
							  mbrinfm_mobno='$mobno',
							  mbrinfm_brthdy='$brthdy',
							  mbrinfm_rlgn= '$lstrlgn',
							  mbrinfm_spbrthdy='$spbrthdy',
							  mbrinfm_annvsrydy='$annvsrydy',
							  mbrinfm_mrtsts='$mrtlsts',
							  mbrinfm_cntrym_id='$bcntry',
					  	      mbrinfm_cntym_id='$bcnty',
							  mbrinfm_ctym_id='$bcty',
							  mbrinfm_sts='a',
					   		  mbrinfm_zpcode=$bzpcode,
							  mbrinfm_dnd='$dnd',
							  mbrinfm_adrs='$baddrs1',
							  mbrinfm_adrs2='$baddrs2',						 
							  mbrinfm_mdfdon='$dt',
							  mbrinfm_mdfdby='$emp'
							  where 
							  mbrinfm_mbrm_id=$membrid";
			$ursmbrinf_mst = mysqli_query($conn,$uqrymbrinf_mst) or die (mysql_error());
			if($ursmbrinf_mst==true){
			?>
				<script>location.href="<?php echo $rtpth;?>view-profile?mbrinfid=<?php echo $membrid;?>&sts=y";</script>
			<?php
			}
			else{
			?>
				<script>location.href="<?php echo $rtpth;?>view-profile?mbrinfid=<?php echo $membrid;?>&sts=n";</script>			
<?php 
			}		
		//}
	}	
	else{	
	?>
			<script>location.href="<?php echo $rtpth;?>view-profile?mbrinfid=<?php echo $membrid;?>&sts=d";</script>
	<?php	
		}	
?>