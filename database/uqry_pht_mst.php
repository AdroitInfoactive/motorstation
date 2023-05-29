<?php
	include_once '../includes/inc_config.php';       //Making paging validation	
	  include_once $inc_nocache;        //Clearing the cache information
	  include_once $adm_session;    //checking for session
	  include_once $inc_cnctn;     //Making database Connection
	  include_once $inc_usr_fnctn;  //checking for session	
	  include_once $inc_fldr_pth;//Floder Path	
	if(isset($_POST['btnedtpht']) && (trim($_POST['btnedtpht']) != "") && 
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
		$sqryphtcat_mst="select
							 phtm_name
		              	 from 
					  		 pht_mst
					  	 where 
					 		phtm_name='$name'  and
							phtm_typ='$typval' and
					 		phtm_id!=$id";
		$srsphtcat_mst = mysqli_query($conn,$sqryphtcat_mst);
		$rows          = mysqli_num_rows($srsphtcat_mst);
		if($rows > 0){
		?>
			<script>location.href="view_photos.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			 $uqryphtcat_mst="update pht_mst set 
							  phtm_name='$name',
							  phtm_typ='$typval',
							  phtm_hmpgtyp='$hmpgtyp',
							  phtm_lnk='$lnknm',
							  phtm_prty='$prty',
							  phtm_sts='$sts',
							  phtm_desc='$desc',						  
							  phtm_mdfdon='$curdt',
							  phtm_mdfdby='$ses_admin'";
			$uqryphtcat_mst .= "  where phtm_id=$id";	
			$ursphtcat_mst = mysqli_query($conn,$uqryphtcat_mst);
			if($ursphtcat_mst==true){
			  if($id!="" && $cntcntrl !="" ){
				for($i=1;$i<=$cntcntrl;$i++){
					$cntrlid  = glb_func_chkvl("hdnproddid".$i);
					$pgdtlid  = glb_func_chkvl($_POST[$cntrlid]);
					$cntbgimg	= glb_func_chkvl("hdnbgimg".$i);
					$db_hdnimg  = glb_func_chkvl($_POST[$cntbgimg]);
					$phtname   = glb_func_chkvl("txtphtname1".$i);
					$validname  = glb_func_chkvl($_POST[$phtname]);
					$phtname    =  $i."-".glb_func_chkvl($_POST[$phtname]);
					if($validname ==""){
						$phtname    =  $i."-".$name;
					}
					$prty   = glb_func_chkvl("txtphtprior".$i);
					$prty   = glb_func_chkvl($_POST[$prty]);
					$phtsts  = "lstphtsts".$i;
					$sts     = $_POST[$phtsts];		
					if($prty ==""){
						$prty 	= $i;
					}
					$bimg='flebgimg'.$i; 
					if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="") || $db_hdnimg !=''){
						$bimgval = funcUpldImg($bimg,'bimg');
						if($bimgval != ""){
							$bimgary    = explode(":",$bimgval,2);
							$bdest 		= $bimgary[0];					
							$bsource 	= $bimgary[1];					
						}	
					}							
					    if($pgdtlid != ''){						
						 $uqryphtimgd_dtl = "update phtimg_dtl set
											  phtimgd_title = '$phtname',
											  phtimgd_sts='$sts',
											  phtimgd_prty='$prty',	
											  phtimgd_mdfdon='$curdt',
											  phtimgd_mdfdby='$ses_admin'";
						if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
							if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){	
								$bgimgpth      = $g_phtbimg_fldnm.$db_hdnimg;
								if(($db_hdnimg != '') && file_exists($bgimgpth))
								{
									unlink($bgimgpth);
								}
								$uqryphtimgd_dtl .= ",phtimgd_bimg='$bdest'";
							}
							move_uploaded_file($bsource,$g_phtbimg_fldnm.$bdest);				
							
						 }
						$uqryphtimgd_dtl .= " where 
												  phtimgd_phtm_id = '$id' and 
												  phtimgd_id='$pgdtlid'";
						$srphtimgd_dtl1 = mysqli_query($conn,$uqryphtimgd_dtl);																	
					  }
					 else{						
						$iqryprod_dtl ="insert into phtimg_dtl(
										phtimgd_title,phtimgd_bimg,phtimgd_sts,phtimgd_prty,
										phtimgd_phtm_id,phtimgd_crtdon,phtimgd_crtdby)values(
										'$phtname','$bdest','$sts','$prty',
										'$id','$curdt','$ses_admin')";  
						$srphtimgd_dtl = mysqli_query($conn,$iqryprod_dtl) or die (mysql_error());
						 if($srphtimgd_dtl){
							if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 							
								move_uploaded_file($bsource,$g_phtbimg_fldnm.$bdest);			
							}
				  		}	
						}
					}
					
				}
			?>
				<script>location.href="view_photos.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";                </script>
			<?php
			}
			else
			{
			?>
				<script>location.href="view_photos.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";         </script>			
<?php 
			}
		}
	}
?>