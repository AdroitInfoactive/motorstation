<?php	
 	include_once '../includes/inc_config.php';       //Making paging validation	
	  include_once $inc_nocache;        //Clearing the cache information
	  include_once $adm_session;    //checking for session
	  include_once $inc_cnctn;     //Making database Connection
	  include_once $inc_usr_fnctn;  //checking for session	
	  include_once $inc_fldr_pth;//Floder Path
	if(isset($_POST['btnaphtsbmt']) && (trim($_POST['btnaphtsbmt']) != "") && 	
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
		 $sqrypht_mst="select 
		 					phtm_name
					   from 
					   		pht_mst
					   where 
					   		phtm_name='$name' and
							phtm_typ='$typval'";
		 $srspht_mst = mysqli_query($conn,$sqrypht_mst);
		$rows         = mysqli_num_rows($srspht_mst);
		 if($rows < 1){		 	
		   $iqrypht_mst="insert into pht_mst(
						  phtm_name,phtm_desc,phtm_prty,phtm_sts,
						  phtm_typ,phtm_hmpgtyp,phtm_lnk,phtm_crtdon,phtm_crtdby) values(
						  '$name','$desc','$prty','$sts',
						  '$typval','$hmpgtyp','$lnknm','$curdt','$ses_admin')";						     
			$irspht_mst = mysqli_query($conn,$iqrypht_mst) or die(mysql_error());
			if($irspht_mst==true){
				$prodid = mysql_insert_id();
				if($prodid != "" && $cntcntrl!=""){
					for($i=1;$i <= $cntcntrl;$i++){
						$prior    = glb_func_chkvl("txtphtprior".$i);
						$prior    = glb_func_chkvl($_POST[$prior]);
						$phtname  = glb_func_chkvl("txtphtname".$i);
						$phtname  = glb_func_chkvl($_POST[$phtname]);
						if($phtname == ''){
							$phtname = $i."-".$name; 	
						}
						else{
							$phtname = $i."-".$phtname;
						}
						if($prior == ''){
							$prior = $i; 	
						}
						$phtsts     = "lstphtsts".$i;
						$sts    	= glb_func_chkvl($_POST[$phtsts]);
						//**********************IMAGE UPLOADING START*******************************//						
						 //FOLDER THAT WILL CONTAIN THE IMAGES		
						$bimg='flebimg'.$i;
						/*------------------------------------Update small image----------------------------*/															
						if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
							if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
								$bimgval = funcUpldImg($bimg,'bimg');
								if($bimgval != ""){
									$bimgary = explode(":",$bimgval,2);
									$bdest 		= $bimgary[0];
									$bsource 	= $bimgary[1];
								}		
							}								
							if($bdest != ''){						
								$iqryphtimg_dtl ="insert into phtimg_dtl(
												  phtimgd_title,phtimgd_bimg,phtimgd_sts,phtimgd_prty,
												  phtimgd_phtm_id,phtimgd_crtdon,phtimgd_crtdby)values(											
												  '$phtname','$bdest','$sts','$prior',
												  '$prodid','$curdt','$ses_admin')";
								$rsprod_dtl   = mysqli_query($conn,$iqryphtimg_dtl);
								if($rsprod_dtl == true){
									if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
										move_uploaded_file($bsource,$g_phtbimg_fldnm.$bdest);			
									}
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