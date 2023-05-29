<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more		
	if(isset($_POST['btnedttstmnls']) && (trim($_POST['btnedttstmnls']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['edit']) && (trim($_POST['edit']) != "") &&
	   isset($_POST['txtphno']) && (trim($_POST['txtphno']) != "")){		
		$id 	    = glb_func_chkvl($_POST['edit']);
		$name       = glb_func_chkvl($_POST['txtname']);
		$email       	= glb_func_chkvl($_POST['txtemail']);
		$phno      = glb_func_chkvl($_POST['txtphno']);
		$desc       = addslashes(trim($_POST['txtdesc']));
		$sts        = glb_func_chkvl($_POST['lststs']);
		$curdt      = date('Y-m-d h:i:s');
		$himg     	= glb_func_chkvl($_POST['hdnsmlimg']);
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$cntstart   = glb_func_chkvl($_REQUEST['countstart']);		
		$srchval	= "";		
		if(isset($_REQUEST['txtsrchval']) && trim($_REQUEST['txtsrchval']) !=''){			
			$val     = addslashes(trim($_REQUEST['txtsrchval']));
			$srchval = "&txtsrchval=".$val;			
			if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
			  $srchval .= "&chkexact=y";
			}		
		}	
		/*$sqrytstmnls_mst = "select 
							tstmnlsm_name
						from 
							tstmnls_mst
						where 
							tstmnlsm_id != $id and
							tstmnlsm_name='$name'";
		$srststmnls_mst = mysqli_query($conn,$sqrytstmnls_mst);
		$cnttstmnlsm    = mysqli_num_rows($srststmnls_mst);
		if($cnttstmnlsm < 1){*/
			$uqrytstmnls_mst="update tstmnls_mst set 
						  tstmnlsm_name='$name',
						  tstmnlsm_rmrks='$desc',
						  tstmnlsm_email='$email',
						  tstmnlsm_phno='$phno',
						  tstmnlsm_sts='$sts',
						  tstmnlsm_mdfdon='$curdt',
						  tstmnlsm_mdfdby='$ses_admin'";			  
			$ssource	= "";
			$sdest		="";
			if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}							
				$uqrytstmnls_mst .= ",tstmnlsm_img='$sdest'";
		 	 }				  
			 $uqrytstmnls_mst .=" where tstmnlsm_id='$id'";
			
			$urststmnls_mst = mysqli_query($conn,$uqrytstmnls_mst) or die(mysql_error());
			if($urststmnls_mst==true){
				if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
					$smlimgpth      = $g_tstmnls_fldnm.$himg;
					if(($himg != '') && file_exists($smlimgpth)){
						unlink($smlimgpth);
					}
					move_uploaded_file($ssource,$g_tstmnls_fldnm.$sdest);	
				 }
			?>
				<script>location.href="<?php echo $rd_vwpgnm;?>?edit=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
			<?php
			}
			else{
			?>
				<script>location.href="<?php echo $rd_vwpgnm;?>?edit=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";
				</script>			
		 <?php 
			}
		/*}
		else{
		?>
			<script>location.href="<?php echo $rd_vwpgnm;?>?edit=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";
			</script>
		<?php
		}*/
	}
	?>