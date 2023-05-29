<?php	
    include_once "../includes/inc_connection.php";    //Making database Connection
	include_once "../includes/inc_adm_session.php";   //checking for session
	include_once "../includes/inc_usr_functions.php"; //Making database Connection	
	
	if(isset($_POST['btnedtordsts']) && (trim($_POST['btnedtordsts']) != "") && 
	    isset($_POST['txtprior']) && (trim($_POST['txtprior'])!= "") && 
	   isset($_POST['hdnordstsid']) && (trim($_POST['hdnordstsid'])!= "")){		
		$name     				= glb_func_chkvl($_POST['txtname']);
		$desc     		 		= addslashes(trim($_POST['txtdesc']));
		$prc 			 		= 0;	
		$sts     		 		= glb_func_chkvl($_POST['lststs']);
		$prty            		= glb_func_chkvl($_POST['txtprior']);
		$id        	   	 		= glb_func_chkvl($_POST['hdnordstsid']); 
		$dt      		 		= date('Y-m-d h:i:s');		
		$pgval        	   	 		= glb_func_chkvl($_POST['hdnpage']); 
		$cntstval        	   	 		= glb_func_chkvl($_POST['hdncnt']); 
		/*$sqryshpchrg_mst	= "select 
									 shpchrgm_name
							    from 
							   		  shpchrg_mst
							    where 
							   		 shpchrgm_name='$name' and
									 shpchrgm_id != '$id'	";
		    $srsshpchrg_mst    	= mysqli_query($conn,$sqryshpchrg_mst);
		    $cntrec       		= mysqli_num_rows($srsshpchrg_mst); 
			if($cntrec > 0)
			{		
				header("Location:view_all_ordsts.php?sts=d&vw=$id&pg=$pgval&countstart=$cntstval$admloc");
	     	}

		   else{*/

				 $uqryordsts_mst ="update ordsts_mst set 
								   ordstsm_desc			='$desc',
								   ordstsm_sts			='$sts',
								   ordstsm_prty			='$prty',								   
								   ordstsm_mdfdon		='$dt',
								   ordstsm_mdfdby		='$s_admin'";
				 $uqryordsts_mst .= " where ordstsm_id 	= '$id'";								  						
				$ursordsts_mst = mysqli_query($conn,$uqryordsts_mst) or die(mysql_error());
				if($ursordsts_mst==true){
				
				?>		
					<script>
						location.href="view_ordsts_details.php?sts=y&edit=<?php echo $id;?>&pg=<?php echo $pgval;?>&countstart=<?php echo $cntstval.$admloc;?>";
					</script>			
					<?php	
					}			
					else{
						 ?>
			 			<script>			 
			 			location.href="view_ordsts_details.php?sts=n&edit=<?php echo $id;?>&pg=<?php echo $pgval;?>&countstart=<?php echo $cntstval.$admloc;?>";
					</script>
			<?php 
					}	
			
		//	}
					
	}
?>



