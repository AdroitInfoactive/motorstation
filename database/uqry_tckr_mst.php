<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//Making database Connection		

	if(isset($_POST['btnedtcksbmt']) && (trim($_POST['btnedtcksbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "") && 
	   isset($_POST['hdntckrid']) && (trim($_POST['hdntckrid']) != "")){	
	   
		$id 	    = glb_func_chkvl($_POST['hdntckrid']);
		$name       = glb_func_chkvl($_POST['txtname']);
		$desc	    = addslashes(trim($_POST['txtdesc']));	
		$prior      = glb_func_chkvl($_POST['txtprty']);
		$sts        = glb_func_chkvl($_POST['lststs']); 
		$val        = glb_func_chkvl($_REQUEST['val']);                            
		$curdt      = date('Y-m-d h:i:s');
			
		$pg         = glb_func_chkvl($_REQUEST['pg']);
		$cntstart   = glb_func_chkvl($_REQUEST['countstart']);
		
		if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y'){
		  $chk="&chk=y";
		}
		if($val != ""){
			$srchval= "&val=".$val.$chk;
		}
		$sqrytckr_dtl="select 
							tckrm_name
					   from 
					   		tckr_mst
					   where 
					   		tckrm_name='$name' and 
					  		tckrm_id != '$id'";
		$srstckr_dtl = mysqli_query($conn,$sqrytckr_dtl);
		$cnt_recs    = mysqli_num_rows($srstckr_dtl);
		if($cnt_recs > 0){
		?>
			<script>location.href="view_ticker_detail.php?edit=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			$uqrytckr_mst="update tckr_mst set 
						   tckrm_name='$name',
						   tckrm_desc='$desc',
						   tckrm_prty=$prior,
						   tckrm_sts='$sts',
						   tckrm_mdfdon='$curdt',
						   tckrm_mdfdby='$ses_admin'
						   where tckrm_id=$id";
			$urstckr_mst= mysqli_query($conn,$uqrytckr_mst);
			if($urstckr_mst==true)
			{
			?>
				<script>location.href="view_ticker_detail.php?edit=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";                </script>
			<?php
			}
			else{
			?>
				<script>location.href="view_ticker_detail.php?edit=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";                </script>		
<?php 
			}
		}
	}
?>