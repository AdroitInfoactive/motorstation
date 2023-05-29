<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once "../includes/inc_usr_functions.php";//checking for session
	
	if(isset($_POST['btnecnty']) && ($_POST['btnecnty'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "")&& 	
	   isset($_POST['txtisothr']) && ($_POST['txtisothr'] != "") && 
	   isset($_POST['lstcntnt']) && trim($_POST['lstcntnt'] != "") && 	
	   isset($_POST['txtprty']) && ($_POST['txtprty'] != "")){	
	   
		$id 	      = glb_func_chkvl($_POST['hdncntyid']);
		$lstcntnt     = glb_func_chkvl($_POST['lstcntnt']);
		$name         = glb_func_chkvl($_POST['txtname']);
		$prty         = glb_func_chkvl($_POST['txtprty']);
		$isotwo       = glb_func_chkvl($_POST['txtisotwo']);
		$isothr       = glb_func_chkvl($_POST['txtisothr']);
		$isonum       = glb_func_chkvl($_POST['txtisonum']);
		$sts          = glb_func_chkvl($_POST['lststs']);
		$dt           = date('Y-m-d');;
		//$emp          = $_SESSION['sesadmin'];
		$pg           = glb_func_chkvl($_REQUEST['pg']);
		$countstart   = glb_func_chkvl($_REQUEST['countstart']);
		$optn         = glb_func_chkvl($_REQUEST['optn']);
		$txtsrchval   = glb_func_chkvl($_REQUEST['txtsrchval']);
		$chkexact     = glb_func_chkvl($_REQUEST['chkexact']);
		$lstsrchcntnt = glb_func_chkvl($_REQUEST['lstsrchcntnt']);
		
		 $sqrycnty_mst="select 
							cntrym_name
		                from 
					   		cntry_mst
					    where 
					   		cntrym_name='$name' and
							cntrym_cntntm_id ='$lstcntnt' and	 
					  	 	cntrym_id!=$id";
		$srscnty_mst = mysqli_query($conn,$sqrycnty_mst);
	    /*if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y'){
		  $ck="&chk=y";
		}
		if(($val != "") && (optn !="")){
			$srchval= "&val=".$val.$ck;
		}*/
		$rows        = mysqli_num_rows($srscnty_mst);
		if($rows > 0){
		?>
			<script>location.href="vw_all_country.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>&optn=<?php echo $optn;?>&lstsrchcntnt=<?php echo $lstsrchcntnt;?>&txtsrchval=<?php echo $txtsrchval;?>&chkexact=<?php echo $chkexact;?>";</script>
		<?php
		}
		else{
			 $uqrycntry_mst="update cntry_mst set 
							   cntrym_name='$name',
							   cntrym_cntntm_id='$lstcntnt',
							   cntrym_isotwo='$isotwo',
							   cntrym_isothr='$isothr',
							   cntrym_isonum='$isonum',
							   cntrym_prty='$prty',
							   cntrym_sts='$sts',
							   cntrym_mdfdon='$dt',
							   cntrym_mdfdby='$ses_admin'
							   where cntrym_id=$id";
			$urscntry_mst = mysqli_query($conn,$uqrycntry_mst);
			if($urscntry_mst==true){
			?>
				<script>location.href="vw_all_country.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>&optn=<?php echo $optn;?>&lstsrchcntnt=<?php echo $lstsrchcntnt;?>&txtsrchval=<?php echo $txtsrchval;?>&chkexact=<?php echo $chkexact;?>";                </script>
			<?php
			}
			else{
			?>
				<script>location.href="vw_all_country.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>&optn=<?php echo $optn;?>&lstsrchcntnt=<?php echo $lstsrchcntnt;?>&txtsrchval=<?php echo $txtsrchval;?>&chkexact=<?php echo $chkexact;?>";                </script>			
<?php 
			}
		}
	}
?>