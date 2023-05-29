<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more		
	if(isset($_POST['btnedtbnr']) && (trim($_POST['btnedtbnr']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['edit']) && (trim($_POST['edit']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){		
		$id 	    = glb_func_chkvl($_POST['edit']);
		$name       = glb_func_chkvl($_POST['txtname']);
		$lnk       	= glb_func_chkvl($_POST['txtlnk']);
		$prior      = glb_func_chkvl($_POST['txtprior']);
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
		$sqrybnr_mst = "select 
							bnrm_name
						from 
							bnr_mst
						where 
							bnrm_id != $id and
							bnrm_name='$name'";
		$srsbnr_mst = mysqli_query($conn,$sqrybnr_mst);
		$cntbnrm    = mysqli_num_rows($srsbnr_mst);
		if($cntbnrm < 1){
			$uqrybnr_mst="update bnr_mst set 
						  bnrm_name='$name',
						  bnrm_desc='$desc',
						  bnrm_lnk='$lnk',
						  bnrm_prty='$prior',
						  bnrm_sts='$sts',
						  bnrm_mdfdon='$curdt',
						  bnrm_mdfdby='$ses_admin'";			  
			$ssource	= "";
			$sdest		="";
			if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}							
				$uqrybnr_mst .= ",bnrm_imgnm='$sdest'";
		 	 }				  
			 $uqrybnr_mst .=" where bnrm_id='$id'";
			$ursbnr_mst = mysqli_query($conn,$uqrybnr_mst);
			if($ursbnr_mst==true){
				if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
					$smlimgpth      = $gbnr_fldnm.$himg;
					if(($himg != '') && file_exists($smlimgpth)){
						unlink($smlimgpth);
					}
					move_uploaded_file($ssource,$gbnr_fldnm.$sdest);	
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
		}
		else{
		?>
			<script>location.href="<?php echo $rd_vwpgnm;?>?edit=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";
			</script>
		<?php
		}
	}
	?>