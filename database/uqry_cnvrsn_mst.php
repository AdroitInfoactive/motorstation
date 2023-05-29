<?php
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_usr_functions.php";  //Making database Connection		
    if(isset($_POST['btnecnvrsn']) && ($_POST['btnecnvrsn'] != "") && 	
	   isset($_POST['txtcnvrsn'])  &&  (trim($_POST['txtcnvrsn'])!= "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior'])!= "")){
	     $id 	  	  = glb_func_chkvl($_POST['hdncnvrsnid']); 		 
		 $cnvrsn        = glb_func_chkvl($_POST['txtcnvrsn']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $loc    	  = glb_func_chkvl($_POST['hdnloc']);
		 $dt          = date('Y-m-d h:i:s');
		 $pg          = glb_func_chkvl($_REQUEST['hdnpage']);
		 $countstart  = glb_func_chkvl($_REQUEST['hdncnt']);
		 $prcntg      = glb_func_chkvl($_POST['txtprcntg']);
		 $sqrycnvrsn_mst="select
		                    cnvrsnm_name
		                from
						    cnvrsn_mst
					    where
						    cnvrsnm_name='$cnvrsn' and
					        cnvrsnm_id!=$id";				 
		 $srscnvrsn_mst  = mysqli_query($conn,$sqrycnvrsn_mst);
		 $rowscnvrsn_mst = mysqli_num_rows($srscnvrsn_mst);
		 if($rowscnvrsn_mst < 1){		
			 $uqrycnvrsn_mst  ="update cnvrsn_mst set 
							  cnvrsnm_name='$cnvrsn',
							  cnvrsnm_desc='$desc',								
							  cnvrsnm_val='$prcntg',
							  cnvrsnm_sts='$sts',
							  cnvrsnm_prty='$prior',
							  cnvrsnm_mdfdon='$dt',
							  cnvrsnm_mdfdby='$admin' ";			
			$uqrycnvrsn_mst .=" where cnvrsnm_id=$id";
			   $urscnvrsn_mst = mysqli_query($conn,$uqrycnvrsn_mst);
			   if($urscnvrsn_mst==true)
			   {				 			   
			   ?>
					<script>location.href="view_conversion_detail.php?edit=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			   <?php
			    }
				else
				{
				?>
	<script>location.href="view_conversion_detail.php?edit=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>								
<?php 
				}
	     }
		 else
		 {
?>		
  <script>location.href="view_conversion_detail.php?edit=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
<?php				
		 }
	}
?>
	