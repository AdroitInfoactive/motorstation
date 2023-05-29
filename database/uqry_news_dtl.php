<?php
	include_once '../includes/inc_config.php';	
	include_once $inc_nocache;        //Clearing the cache information
	include_once $adm_session;    //checking for session
	include_once $inc_cnctn;     //Making database Connection
	include_once $inc_usr_fnctn;  //checking for session 
	include_once $inc_fldr_pth;//Floder Path		
	if(isset($_POST['btnenewssbmt']) && (trim($_POST['btnenewssbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "") &&
	   isset($_POST['edtnw']) && (trim($_POST['edtnw'])!="")){
	  
		 $id 	    = glb_func_chkvl($_POST['edtnw']);
		 $name      = glb_func_chkvl($_POST['txtname']);		 
		 $desc    	= addslashes(trim($_POST['txtdesc']));
		 $prty     	= glb_func_chkvl($_POST['txtprty']);		
		 $sts      	= glb_func_chkvl($_POST['lststs']);	
		 $hdndwnfle = $id."-".glb_func_chkvl($_POST['hdndwnfle']);				 
		 $curdt     = date('Y-m-d h:i:s');
		 $pg       	= glb_func_chkvl($_REQUEST['pg']);
		 $cntstart  = glb_func_chkvl($_REQUEST['countstart']);
		 $val      	= glb_func_chkvl($_REQUEST['txtsrchval']);
		 if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
		  $chk="&chkexact=y";
		 }		 
		 if($val !=''){
			$srchval .= "&txtsrchval=".$val.$chk;
		 }	
		 $sqrynws_dtl= "select 
							nwsm_name
					   	from 
					   		nws_mst
					   	where 
					   		nwsm_name='$name' and
							nwsm_id!='$id'";
		$srsnws_dtl = mysqli_query($conn,$sqrynws_dtl);
		$cnt_rows   = mysqli_num_rows($srsnws_dtl);
		if($cnt_rows > 0){
		?>
		<script>location.href="<?php echo $rd_vwpgnm;?>?edtnw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
		<?php
		}
		else{
			$uqrynws_mst = "update nws_mst set 
							nwsm_name='$name',								   
						    nwsm_desc='$desc',							
						    nwsm_sts='$sts',
						    nwsm_prty='$prty',
						    nwsm_mdfdon='$curdt',
						    nwsm_mdfdby='$ses_admin'";
			$fsource = "";
			$fdest   = "";
			$fle_down = 'fledwnld';
			if(isset($_FILES[$fle_down]['tmp_name']) && ($_FILES[$fle_down]['tmp_name']!="")){
				$dwnldfleval = funcUpldFle($fle_down,'fle');						
				if($dwnldfleval != ""){
					$dwnldfleval = explode(":",$dwnldfleval,2);
					$fdest 		= $dwnldfleval[0];					
					$fsource 	= $dwnldfleval[1];							
				}
				$uqrynws_mst .= ",nwsm_dwnfl='$fdest'";
			}								
			$uqrynws_mst .= "where nwsm_id ='$id'";
			$ursnws_mst= mysqli_query($conn,$uqrynws_mst);						
			if($ursnws_mst==true){		   
				if(($fsource!='none') && ($fsource!='') && ($fdest!= "")){ 
					$flepth      = $dwnfl_upldpth.$hdndwnfle;	
					if(($hdndwnfle != '') && file_exists($flepth)){							   
					unlink($flepth);
					}
				   move_uploaded_file($fsource,$dwnfl_upldpth.$id."-".$fdest);
				}
			 ?>
				<script>location.href="<?php echo $rd_vwpgnm;?>?edtnw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
			<?php
			}
			else{
			?>
				<script>location.href="<?php echo $rd_vwpgnm;?>?edtnw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
			<?php 
			}		
		}
	}
?>