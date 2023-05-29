<?php
   	include_once "../includes/inc_adm_session.php";//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	
	if(isset($_POST['btnecntnt']) && (trim($_POST['btnecntnt'])!="") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname'])!="") && 	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty'])!="") &&
	   isset($_POST['hdnid']) && (trim($_POST['hdnid'])!="")){	
		
		$id  		  = glb_func_chkvl($_POST['hdnid']);		
		$name         = glb_func_chkvl($_POST['txtname']);
		$iso          = glb_func_chkvl($_POST['txtisocd']);
		$sts		  = glb_func_chkvl($_POST['lststs']);
		$prty         = glb_func_chkvl($_POST['txtprty']);
		$curdt        = date('Y-m-d h:i:s');
		$pg           = glb_func_chkvl($_REQUEST['pg']);
		$cntstart     = glb_func_chkvl($_REQUEST['countstart']);
		$val          = glb_func_chkvl($_REQUEST['val']);
		$optn         = glb_func_chkvl($_REQUEST['optn']);
		$chk 	 	  = glb_func_chkvl($_REQUEST['chk']);		
			
		$sqrycntnt_mst="select 
							 cntntm_name
						 from
							 cntnt_mst
						 where
							 cntntm_name='$name' and
							 cntntm_id!='$id'";
		$srscntnt_mst = mysqli_query($conn,$sqrycntnt_mst)or die(mysql_error());	    
		$rowscntnt_mst        = mysqli_num_rows($srscntnt_mst);
		if($rowscntnt_mst == 0){		
		    $uqrycntnt_mst="update cntnt_mst set 							   
							   cntntm_name='$name',
							   cntntm_iso='$iso',
							   cntntm_sts='$sts',
							   cntntm_prty='$prty',
							   cntntm_mdfdon='$curdt',
							   cntntm_mdfdby='$ses_admin'
						   where 
						       cntntm_id=$id";
			$urscntnt_mst = mysqli_query($conn,$uqrycntnt_mst);
			if($urscntnt_mst==true){ 
				?>
				<script>location.href="view_continent_dtl.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?>&val=<?php echo $val;?>&chk=<?php echo $chk;?>"; 	
				</script>
			<?php
			}
			else{
			?>
				<script>location.href="view_continent_dtl.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?>&val=<?php echo $val;?>&chk=<?php echo $chk;?>"; 	
				</script>
			<?php	
			}
		}
		else{
			   ?>
				<script>location.href="view_continent_dtl.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?>&val=<?php echo $val;?>&chk=<?php echo $chk;?>"; 	
				</script>
			<?php		
		}
	}
?>