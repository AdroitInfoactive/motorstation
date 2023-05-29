<?php
	include_once "../includes/inc_connection.php";     //Making database Connection
	include_once "../includes/inc_adm_session.php";    //checking for session
	include_once "../includes/inc_usr_functions.php";  //Making database Connection		
    if(isset($_POST['btnesize']) && ($_POST['btnesize'] != "") && 	
	   isset($_POST['txtsize'])  &&  (trim($_POST['txtsize'])!= "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior'])!= "")){
	     $id 	  	  = glb_func_chkvl($_POST['hdnsizeid']); 		 
		 $size        = glb_func_chkvl($_POST['txtsize']);
		 $prior       = glb_func_chkvl($_POST['txtprior']);
		 $desc        = addslashes(trim($_POST['txtdesc']));
		 $sts         = glb_func_chkvl($_POST['lststs']);
		 $loc    	  = glb_func_chkvl($_POST['hdnloc']);
		 $dt          = date('Y-m-d h:i:s');
		 $pg          = glb_func_chkvl($_REQUEST['hdnpage']);
		 $countstart  = glb_func_chkvl($_REQUEST['hdncnt']);
		 $sqrytrtyp_mst="select
		                    trtypm_name
		                from
						    trtyp_mst
					    where
						    trtypm_name='$size' and
					        trtypm_id!=$id";				 
		 $srstrtyp_mst  = mysqli_query($conn,$sqrytrtyp_mst);
		 $rowstrtyp_mst = mysqli_num_rows($srstrtyp_mst);
		 if($rowstrtyp_mst < 1){		
			 $uqrytrtyp_mst  ="update trtyp_mst set 
							  trtypm_name='$size',
							  trtypm_desc='$desc',								
							  trtypm_sts='$sts',
							  trtypm_prty='$prior',
							  trtypm_mdfdon='$dt',
							  trtypm_mdfdby='$admin' ";			
			$uqrytrtyp_mst .=" where trtypm_id=$id";
			   $urstrtyp_mst = mysqli_query($conn,$uqrytrtyp_mst);
			   if($urstrtyp_mst==true)
			   {				 			   
			   ?>
					<script>location.href="view_size_detail.php?edit=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>
			   <?php
			    }
				else
				{
				?>
	<script>location.href="view_size_detail.php?edit=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";</script>								
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
	