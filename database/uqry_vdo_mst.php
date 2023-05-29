<?php
	include_once '../includes/inc_config.php';       //Making paging validation	
	  include_once $inc_nocache;        //Clearing the cache information
	  include_once $adm_session;    //checking for session
	  include_once $inc_cnctn;     //Making database Connection
	  include_once $inc_usr_fnctn;  //checking for session	
	  include_once $inc_fldr_pth;//Floder Path	
	if(isset($_POST['btnedtvdo']) && (trim($_POST['btnedtvdo']) != "") && 
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "") &&
	   isset($_POST['vw']) && (trim($_POST['vw'])!="")){
		$id 	    = glb_func_chkvl($_POST['vw']);
		$prty       = glb_func_chkvl($_POST['txtprty']);		
		$name       = glb_func_chkvl($_POST['txtname']);
		$lnknm       = glb_func_chkvl($_POST['txtlnk']);
		$desc       = addslashes(trim($_POST['txtdesc']));
		$sts        = glb_func_chkvl($_POST['lststs']);
		$hmpgtyp    = glb_func_chkvl($_POST['lsthmpg']);
		$typval    = glb_func_chkvl($_POST['lsttyp']);
		$cntcntrl   = glb_func_chkvl($_POST['hdntotcntrl']);
		$curdt      = date('Y-m-d h:i:s');
		$pg       	= glb_func_chkvl($_REQUEST['pg']);
		$cntstart   = glb_func_chkvl($_REQUEST['countstart']);
		$val      	= glb_func_chkvl($_REQUEST['txtsrchval']);
		
		if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
		  $chk="&chkexact=y";
		}		 
		if($val !=''){
			$srchval .= "&txtsrchval=".$val.$chk;
		}	
		$sqryvdocat_mst="select
							 vdom_name
		              	 from 
					  		 vdo_mst
					  	 where 
					 		vdom_name='$name'  and
							vdom_typ='$typval' and
					 		vdom_id!=$id";
		$srsvdocat_mst = mysqli_query($conn,$sqryvdocat_mst);
		$rows          = mysqli_num_rows($srsvdocat_mst);
		if($rows > 0){
		?>
			<script>location.href="view_videos.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			 $uqryvdocat_mst="update vdo_mst set 
							  vdom_name='$name',
							  vdom_typ='$typval',
							  vdom_hmpgtyp='$hmpgtyp',
							  vdom_lnk='$lnknm',
							  vdom_prty='$prty',
							  vdom_sts='$sts',
							  vdom_desc='$desc',						  
							  vdom_mdfdon='$curdt',
							  vdom_mdfdby='$ses_admin'";
			$uqryvdocat_mst .= "  where vdom_id=$id";	
			$ursvdocat_mst = mysqli_query($conn,$uqryvdocat_mst);
			if($ursvdocat_mst==true){
			  if($id!="" && $cntcntrl !="" ){
				for($i=1;$i<=$cntcntrl;$i++){
					$cntrlid  = glb_func_chkvl("hdnproddid".$i);
					$pgdtlid  = glb_func_chkvl($_POST[$cntrlid]);
					$cntbgimg	= glb_func_chkvl("hdnbgimg".$i);
					$db_hdnimg  = glb_func_chkvl($_POST[$cntbgimg]);
					$vdoname   = glb_func_chkvl("txtvdoname1".$i);
					$validname  = glb_func_chkvl($_POST[$vdoname]);
					$vdoname    =  $i."-".glb_func_chkvl($_POST[$vdoname]);
					if($validname ==""){
						$vdoname    =  $i."-".$name;
					}
					$prty   = glb_func_chkvl("txtvdoprior".$i);
					$prty   = glb_func_chkvl($_POST[$prty]);
					$vdosts  = "lstvdosts".$i;
					$sts     = $_POST[$vdosts];		
					if($prty ==""){
						$prty 	= $i;
					}
					$vdolnk    = glb_func_chkvl("txtvdo".$i);
					$vdolnknm  = glb_func_chkvl($_POST[$vdolnk]);
					    if($pgdtlid != ''){						
							 $uqryvdoimgd_dtl = "update vdoimg_dtl set
												  vdoimgd_title = '$vdoname',
												  vdoimgd_lnk='$vdolnknm',
												  vdoimgd_sts='$sts',
												  vdoimgd_prty='$prty',	
												  vdoimgd_mdfdon='$curdt',
												  vdoimgd_mdfdby='$ses_admin'";
							$uqryvdoimgd_dtl .= " where 
													  vdoimgd_vdom_id = '$id' and 
													  vdoimgd_id='$pgdtlid'";
							$srvdoimgd_dtl1 = mysqli_query($conn,$uqryvdoimgd_dtl);																	
					  	}
					 	else{						
							$iqryprod_dtl ="insert into vdoimg_dtl(
											vdoimgd_title,vdoimgd_lnk,vdoimgd_sts,vdoimgd_prty,
											vdoimgd_vdom_id,vdoimgd_crtdon,vdoimgd_crtdby)values(
											'$vdoname','$vdolnknm','$sts','$prty',
											'$id','$curdt','$ses_admin')";  
							$srvdoimgd_dtl = mysqli_query($conn,$iqryprod_dtl) or die (mysql_error());
						 
						}
					}
					
				}
			?>
				<script>location.href="view_videos.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";                </script>
			<?php
			}
			else
			{
			?>
				<script>location.href="view_videos.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";         </script>			
<?php 
			}
		}
	}
?>