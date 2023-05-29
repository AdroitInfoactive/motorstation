<?php
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_usr_functions.php";  //Making database Connection		
    if(isset($_POST['btneinrbnr']) && ($_POST['btneinrbnr'] != "") && 	
	   isset($_POST['txtinrbnr'])  &&  (trim($_POST['txtinrbnr'])!= "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior'])!= "")){
	     $id 	  	  = glb_func_chkvl($_POST['hdninrbnrid']); 		 
		 $inrbnr        = glb_func_chkvl($_POST['txtinrbnr']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $loc    	  = glb_func_chkvl($_POST['hdnloc']);
		 $dt          = date('Y-m-d h:i:s');
		 $pg          = glb_func_chkvl($_REQUEST['hdnpage']);
		 $countstart  = glb_func_chkvl($_REQUEST['hdncnt']);
		 $sqryinrbnr_mst="select
		                    inrbnrm_name
		                from
						    inrbnr_mst
					    where
						    inrbnrm_name='$inrbnr' and
					        inrbnrm_id!=$id";				 
		 $srsinrbnr_mst  = mysqli_query($conn,$sqryinrbnr_mst);
		 $rowsinrbnr_mst = mysqli_num_rows($srsinrbnr_mst);
		 if($rowsinrbnr_mst < 1){		
			 $uqryinrbnr_mst  ="update inrbnr_mst set 
							  inrbnrm_name='$inrbnr',
							  inrbnrm_desc='$desc',								
							  inrbnrm_sts='$sts',
							  inrbnrm_prty='$prior',
							  inrbnrm_mdfdon='$dt',
							  inrbnrm_mdfdby='$admin' ";			
			$uqryinrbnr_mst .=" where inrbnrm_id=$id";
			   $ursinrbnr_mst = mysqli_query($conn,$uqryinrbnr_mst);
			   if($ursinrbnr_mst==true)
			   {				 			   
			   ?>
					<script>location.href="view_innerbanner_detail.php?edit=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			   <?php
			    }
				else
				{
				?>
	<script>location.href="view_innerbanner_detail.php?edit=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>								
<?php 
				}
	     }
		 else
		 {
?>		
  <script>location.href="view_size_detail.php?edit=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
<?php				
		 }
	}
?>
	