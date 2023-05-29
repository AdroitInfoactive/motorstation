<?php	
 	include_once '../includes/inc_config.php';       //Making paging validation	
	  include_once $inc_nocache;        //Clearing the cache information
	  include_once $adm_session;    //checking for session
	  include_once $inc_cnctn;     //Making database Connection
	  include_once $inc_usr_fnctn;  //checking for session	
	  include_once $inc_fldr_pth;//Floder Path
	if(isset($_POST['btnavdosbmt']) && (trim($_POST['btnavdosbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){
		 $name     =  glb_func_chkvl($_POST['txtname']);
		 $prty     =  glb_func_chkvl($_POST['txtprty']);
		 $desc     =  addslashes(trim($_POST['txtdesc']));
		 $sts      =  glb_func_chkvl($_POST['lststs']);
		 $lnknm     =  glb_func_chkvl($_POST['txtlnk']);
		 $hmpgtyp  =  glb_func_chkvl($_POST['lsthmpg']);
		 $typval  =  glb_func_chkvl($_POST['lsttyp']);
		 $cntcntrl =  glb_func_chkvl($_POST['hdntotcntrl']);
		 $curdt       =  date('Y-m-d');
		 $sqryvdo_mst="select 
		 					vdom_name
					   from 
					   		vdo_mst
					   where 
					   		vdom_name='$name' and
							vdom_typ='$typval'";
		 $srsvdo_mst = mysqli_query($conn,$sqryvdo_mst);
		$rows         = mysqli_num_rows($srsvdo_mst);
		 if($rows < 1){		 	
		   $iqryvdo_mst="insert into vdo_mst(
						  vdom_name,vdom_desc,vdom_prty,vdom_sts,
						  vdom_typ,vdom_hmpgtyp,vdom_lnk,vdom_crtdon,vdom_crtdby) values(
						  '$name','$desc','$prty','$sts',
						  '$typval','$hmpgtyp','$lnknm','$curdt','$ses_admin')";						     
			$irsvdo_mst = mysqli_query($conn,$iqryvdo_mst) or die(mysql_error());
			if($irsvdo_mst==true){
				$prodid = mysql_insert_id();
				if($prodid != "" && $cntcntrl!=""){
					for($i=1;$i <= $cntcntrl;$i++){
						$prior    = glb_func_chkvl("txtvdoprior".$i);
						$prior    = glb_func_chkvl($_POST[$prior]);
						$vdoname  = glb_func_chkvl("txtvdoname".$i);
						$vdoname  = glb_func_chkvl($_POST[$vdoname]);
						if($vdoname == ''){
							$vdoname = $i."-".$name; 	
						}
						else{
							$vdoname = $i."-".$vdoname;
						}
						if($prior == ''){
							$prior = $i; 	
						}
						$vdosts     = "lstvdosts".$i;
						$sts    	= glb_func_chkvl($_POST[$vdosts]);
						$vdolnk  = glb_func_chkvl("txtvdo".$i);
						$vdolnk  = glb_func_chkvl($_POST[$vdolnk]);
						//**********************IMAGE UPLOADING START*******************************//						
						 //FOLDER THAT WILL CONTAIN THE IMAGES		
						$bimg='flebimg'.$i;
						/*------------------------------------Update small image----------------------------*/															
						$sqrypgvdo_dtl="select 
											   vdoimgd_title
											from
											   vdoimg_dtl
											where 
											   vdoimgd_title='$vdoname' and
											   vdoimgd_vdom_id ='$prodid'";
							$srspgvdo_dtl = mysqli_query($conn,$sqrypgvdo_dtl);
							$cntpgvdo_dtl       = mysqli_num_rows($srspgvdo_dtl);
							if($cntpgvdo_dtl < 1){
								if($vdolnk !=""){					
									$iqryvdoimg_dtl ="insert into vdoimg_dtl(
													  vdoimgd_title,vdoimgd_lnk,vdoimgd_sts,vdoimgd_prty,
													  vdoimgd_vdom_id,vdoimgd_crtdon,vdoimgd_crtdby)values(											
													  '$vdoname','$vdolnk','$sts','$prior',
													  '$prodid','$curdt','$ses_admin')";
									$rsprod_dtl   = mysqli_query($conn,$iqryvdoimg_dtl);
									if($rsprod_dtl == true){								
											$gmsg = "Record saved successfully";		
									}
								}
							}	
					}
				}				
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}			
		 }
		 else{			
			$gmsg = "Duplicate Record. Record not saved";
		 }
	  }
?>