<?php	
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection	
	if(isset($_POST['btnadprodsbmt']) && (trim($_POST['btnadprodsbmt']) != "") && 
	   isset($_POST['lstcat']) && (trim($_POST['lstcat']) != "") &&	
	   isset($_POST['lstcattyp']) && (trim($_POST['lstcattyp']) != "") &&	
	   isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") &&	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	  // isset($_SESSION['sesprc'])    && (trim($_SESSION['sesprc'])!="")	&&    	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){	   	   
		 $cat1      	= glb_func_chkvl($_POST['lstcat']);
		 $lstcattyp      	= glb_func_chkvl($_POST['lstcattyp']);
		 $cat2        	= glb_func_chkvl($_POST['lstscat']);
		 $code     		= glb_func_chkvl($_POST['txtcode']);		 	
		 $name       	= glb_func_chkvl($_POST['txtname']);
		 $prior       	= glb_func_chkvl($_POST['txtprty']);
		 $descone 		= addslashes(trim($_POST['txtadmndescone']));
		 $desctwo  		= addslashes(trim($_POST['txtadmndesctwo']));
		 $seotitle 		= glb_func_chkvl($_POST['txtseotitle']);
		 $seodesc  		= glb_func_chkvl($_POST['txtseodesc']);
		 $seokywrd 		= glb_func_chkvl($_POST['txtseokywrd']);
		 $seoh1ttl  	= glb_func_chkvl($_POST['txtseoh1ttl']);
		 $seoh1desc	 	= glb_func_chkvl($_POST['txtseoh1desc']);
		 $seoh2ttl  	= glb_func_chkvl($_POST['txtseoh2ttl']); 
		 $seoh2desc 	= glb_func_chkvl($_POST['txtseoh2desc']);	 
		 $sts         	= glb_func_chkvl($_POST['lststs']);
		 $secprc 			= explode("<->",$_SESSION['sesprc']);	
		/* $prc			= "NULL";
		 if(isset($_POST['txtprc']) && (trim($_POST['txtprc'])!='')){
		   $prc 		=  glb_func_chkvl($_POST['txtprc']);
		 }		
		 $oprc			= "NULL";
		 if(isset($_POST['txtoprc']) && (trim($_POST['txtoprc'])!='')){
		   $oprc 		=  glb_func_chkvl($_POST['txtoprc']);
		 }
		 // $wt       	= glb_func_chkvl($_POST['txtwght']);
		 $wt			= "NULL";	
		 if(isset($_POST['txtwght']) && (trim($_POST['txtwght'])!='')){
		 $wt       		= glb_func_chkvl($_POST['txtwght']);	
		 }*/
		 $dt          	= date('Y-m-d h:i:s');
		 $typ			= glb_func_chkvl($_POST['lsttyp']);		 
		 $cntcntrl    	= glb_func_chkvl($_POST['hdntotcntrl']);
		 $sqryprod_mst	= "select 
								prodm_code
						   from
								prod_mst
						   where
								prodm_code='$code'";
		 $srsprod_mst = mysqli_query($conn,$sqryprod_mst);
		 $rows       = mysqli_num_rows($srsprod_mst);
		 if($rows > 0){
			$gmsg = "Duplicate product code. Record not saved";
		 }
		 else{	
		 $iqryprod_mst="insert into prod_mst(
						   prodm_code,prodm_name,prodm_descone,prodm_desctwo,
						   prodm_brndm_id,prodm_vehtypm_id,prodm_typ,prodm_seotitle,
						   prodm_seodesc,prodm_seokywrd,prodm_seohonetitle,prodm_seohonedesc,
						   prodm_seohtwotitle,prodm_seohtwodesc,prodm_prty,prodm_sts,
						   prodm_crtdon,prodm_crtdby)values(
						   '$code','$name','$descone','$desctwo',
						   '$cat1','$lstcattyp','$typ','$seotitle',
						   '$seodesc','$seokywrd','$seoh1ttl','$seoh1desc',
						   '$seoh2ttl','$seoh2desc','$prior','$sts',
						   '$dt','$ses_admin')";		
			$irsprod_mst = mysqli_query($conn,$iqryprod_mst) or die(mysql_error());		
			$prodid	= mysqli_insert_id($conn);	
			if($irsprod_mst==true){	
			
				
				/* -----------  Sizes ----------------------*/
				
					/*if($secprc !="" && $prodid!=""){
						$prty = 0;
							for($inc = 0; $inc < count($secprc);$inc++){
								$prty ++;
								$prcs   = explode("--",$secprc[$inc]);
								$size    = $prcs[0];
								$prc   = $prcs[1];
								$ofrprc     = $prcs[2]; 
							   $sqryprodprc_dtl = "select 
														   prodprcd_id
														from 
														   prodprc_dtl
														where 
														   prodprcd_sizem_id = '$size' and
														   prodprcd_prodm_id ='$prodid'";				   
								$srspckpnts_mst   = mysqli_query($conn,$sqryprodprc_dtl);
								$rowsprodprc_dtl  = mysqli_num_rows($srspckpnts_mst);
								if($rowsprodprc_dtl < 1){
									$iqryprodprc_dtl="insert into  prodprc_dtl(
													  prodprcd_prodm_id,prodprcd_sizem_id,prodprcd_prc,prodprcd_ofrprc,
													  prodprcd_sts,prodprcd_prty,prodprcd_crtdon,prodprcd_crtdby)
													  values(
													  '$prodid','$size','$prc','$ofrprc',
													  '$sts','$prty','$dt','$admin')";
									$irsprodprc_dtl = mysqli_query($conn,$iqryprodprc_dtl) or die(mysql_error());
									  
								}
								else{
								  $gmsg= "Duplicate Size";				  
								}
							}		
						}*/		
				
				
				/*----MULTIPLE IMAGE OPEN HEAR	------*/
				if($prodid != "" && $cntcntrl!=""){
					for($i=1;$i <= $cntcntrl;$i++){
						$prtycntrl_nm = glb_func_chkvl("txtphtprior".$i);
						$prtyval      = glb_func_chkvl($_POST[$prtycntrl_nm]);
						$phtcntrl_nm  = glb_func_chkvl("txtphtname".$i);
						$phtval	      = glb_func_chkvl($_POST[$phtcntrl_nm]);
						$phtname      = $i."-".$phtval;
						if($phtval == ""){
							$phtname    =  $i."-".$code;
						}				
						if(($prtyval == '') || ($prtyval < 1)){
							$prtyval = $i;
						}
						$phtsts     = glb_func_chkvl("lstphtsts".$i);
						$sts    	= glb_func_chkvl($_POST[$phtsts]);
						
						
						$lnkcntrl_nm  = glb_func_chkvl("txtphtlnk".$i);
						$lnkval	      = glb_func_chkvl($_POST[$lnkcntrl_nm]);
						
						//if($phtname != "" && $prior!=""){
						//**********IMAGE UPLOADING START*************//						
						//FOLDER THAT WILL CONTAIN THE IMAGES		
						$simg='flesimg'.$i;
						$bimg='flebimg'.$i;
						if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!="") ||
						   isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
						
							/*------------------Update small image----------------------*/	
							if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!="")){
								$simgval = funcUpldImg($simg,'simg');
								if($simgval != ""){
									$simgary = explode(":",$simgval,2);
									$sdest 		= $simgary[0];
									$ssource 	= $simgary[1];
								}		
							}								
							if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
								$bimgval = funcUpldImg($bimg,'bimg');
								if($bimgval != ""){
									$bimgary = explode(":",$bimgval,2);
									$bdest 	 = $bimgary[0];
									$bsource = $bimgary[1];
								}		
							}
							if($sdest !='' || $bdest !=''){
								 $iqryprodimg_dtl ="insert into prodimg_dtl(
												   prodimgd_title,prodimgd_simg,prodimgd_bimg,prodimgd_sts,
												   prodimgd_lnk,prodimgd_prty,prodimgd_prodm_id,prodimgd_crtdon,
												   prodimgd_crtdby)values(											
												   '$phtname','$sdest','$bdest','$sts',
												   '$lnkval	','$prtyval','$prodid','$dt',
												   '$ses_admin')";
												
								$rsprod_dtl   = mysqli_query($conn,$iqryprodimg_dtl);
								if($rsprod_dtl == true){
									if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
										move_uploaded_file($ssource,$gsml_fldnm.$sdest);	
									}
									if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
										move_uploaded_file($bsource,$gbg_fldnm.$bdest);	
										//$wtrmrkimgnm = funcWtrMrkBg($gbg_fldnm,$bdest);
									}
								}
							}
						}
					}
					
				}
				$gmsg = "Record saved successfully";
				$_SESSION['sesprc'] = "";	
			}
			else{
				$gmsg = "Record not saved";
			}
		}
	}
?>