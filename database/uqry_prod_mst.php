<?php
	include_once '../includes/inc_nocache.php';     //Clearing the cache information
    include_once '../includes/inc_adm_session.php'; //Check the session is created or not	
	include_once '../includes/inc_folder_path.php'; 		
	if(isset($_POST['btnedtprodsbmt']) && (trim($_POST['btnedtprodsbmt']) != "") && 
	 isset($_POST['lstcat']) && (trim($_POST['lstcat']) != "") &&	
	  // isset($_POST['lstscat']) && (trim($_POST['lstscat']) != "") &&	
	   isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") &&	
	   //isset($_SESSION['sesedtprc'])   && (trim($_SESSION['sesedtprc'])!="") &&	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&	
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")   &&
		isset($_POST['hdnprodid']) && (trim($_POST['hdnprodid'])!= "")){
	   	 
		 $id 	  	    = glb_func_chkvl($_POST['hdnprodid']);
		 $cat1      	= glb_func_chkvl($_POST['lstcat']);
		 $lstcattyp    = glb_func_chkvl($_POST['lstcattyp']);
		 $cat2        	= glb_func_chkvl($_POST['lstscat']);
		 $code     		= glb_func_chkvl($_POST['txtcode']);		 	
		 $name       	= glb_func_chkvl($_POST['txtname']);		 
		 $prior       	= glb_func_chkvl($_POST['txtprty']);
		 $descone    	= addslashes(trim($_POST['txtadmndescone']));
		 $desctwo    	= addslashes(trim($_POST['txtadmndesctwo']));
		 $seotitle      = glb_func_chkvl($_POST['txtseotitle']);
		 $seodesc       = glb_func_chkvl($_POST['txtseodesc']);
		 $seokywrd      = glb_func_chkvl($_POST['txtseokywrd']);
		 $seoh1ttl  	= glb_func_chkvl($_POST['txtseoh1ttl']);
		 $seoh1desc 	= glb_func_chkvl($_POST['txtseoh1desc']);
		 $seoh2ttl   	= glb_func_chkvl($_POST['txtseoh2ttl']); 
		 $seoh2desc 	= glb_func_chkvl($_POST['txtseoh2desc']);
		 $typ			= glb_func_chkvl($_POST['lsttyp']);			 
		 $sts         	= glb_func_chkvl($_POST['lststs']);
		/* $wt  			="NULL";
		 if(isset($_POST['txtwght']) && (trim($_POST['txtwght'])!='')){
		 	$wt       		= glb_func_chkvl($_POST['txtwght']);	
		 }*/
		 /*$prc			= "NULL";
		 if(isset($_POST['txtprc']) && (trim($_POST['txtprc'])!='')){
		   $prc 		=  glb_func_chkvl($_POST['txtprc']);
		}
		 $oprc			= "NULL";
		 if(isset($_POST['txtoprc']) && (trim($_POST['txtoprc'])!='')){
		   $oprc 		=  glb_func_chkvl($_POST['txtoprc']);
		}*/
		 $dt          	= date('Y-m-d h:i:s');
		 $pg          	= glb_func_chkvl($_REQUEST['hdnpage']);
		 $cntstart  	= glb_func_chkvl($_REQUEST['hdncnt']);
		 $loc    		= addslashes(trim($_POST['hdnloc']));
		// $optn        = glb_func_chkvl($_REQUEST['hdnoptn']);
		// $val        	= glb_func_chkvl($_REQUEST['hdnval']);
		// $hdnzimg		= glb_func_chkvl($_POST['hdnzimgnm']);
		 $cntcntrl    	= glb_func_chkvl($_POST['hdntotcntrl']);
		/* if(isset($_REQUEST['hdnchk']) && $_REQUEST['hdnchk']=='y'){
		  	$ck="&chk=y";
		 }
		 if($val != ""){
			$srchval= "&optn=".$optn."&val=".$val.$ck;
		 }*/		
		 $prcids 				= explode("<->",$_SESSION['sesedtprc']);
		 $sqryprod_mst	="select 
								prodm_code
					  	  from
					  	   		prod_mst
					  	  where
					     		prodm_code='$code' and 					   
					     		prodm_id !=$id";
		$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
		$rows       = mysqli_num_rows($srsprod_mst);
		if($rows > 0){
		?>
			<script>location.href="vw_all_products_detail.php?sts=d&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>";</script>
		<?php
		}
		else{
			echo $uqryprod_mst="update prod_mst set 
								   prodm_code='$code',	
								   prodm_name='$name',			
								   prodm_brndm_id='$cat1',
									 prodm_vehtypm_id='$lstcattyp',		
								   prodm_descone='$descone',
								   prodm_desctwo='$desctwo',
								   prodm_seotitle='$seotitle',
								   prodm_seodesc='$seodesc',
								   prodm_seokywrd='$seokywrd',
								   prodm_seohonetitle = '$seoh1ttl',
						  	       prodm_seohonedesc = '$seoh1desc',
						      	   prodm_seohtwotitle = '$seoh2ttl',
						      	   prodm_seohtwodesc = '$seoh2desc',		
								   prodm_typ='$typ',								 							   							   	   prodm_sts='$sts',
								   prodm_prty='$prior',
								   prodm_mdfdon='$dt',
								   prodm_mdfdby='$ses_admin'";								   
			$uqryprod_mst .= " where prodm_id ='$id'";							   
			$ursprod_mst= mysqli_query($conn,$uqryprod_mst) or die(mysql_error());	
			if($ursprod_mst==true){
			   
			   
				/* if($id!="" && $prcids !="" ){
						$dqryprodprc_dtl = "delete from 
									 prodprc_dtl
								 where 
									prodprcd_prodm_id = $id";
						$drsprodprc_dtl=mysqli_query($conn,$dqryprodprc_dtl);
						if($drsprodprc_dtl=='true'){
							for($inc = 0;$inc<count($prcids);$inc++){
									  $prcarrys   	= explode("--",$prcids[$inc]);
									  $size    		= $prcarrys[0];
									  $prc   			= $prcarrys[1];
									  $ofrprc    	= $prcarrys[2];
									  $sqryprodprc_dtl = "select 
																	   prodprcd_id
																	from 
																	   prodprc_dtl
																	where 
																	   prodprcd_sizem_id = '$size' and
																	  	prodprcd_prodm_id ='$id'";				   
									$srspckpnts_mst   = mysqli_query($conn,$sqryprodprc_dtl);
									$rowsprodprc_dtl  = mysqli_num_rows($srspckpnts_mst);
									if($rowsprodprc_dtl < 1){
										$iqryprodprc_dtl="insert into  prodprc_dtl(
											  prodprcd_prodm_id,prodprcd_sizem_id,prodprcd_prc,prodprcd_ofrprc,
											  prodprcd_sts,prodprcd_prty,prodprcd_crtdon,prodprcd_crtdby)
											  values(
											  '$id','$size','$prc','$ofrprc',
											  '$sts','$prior','$dt','$admin')";
											$irsprodprc_dtl = mysqli_query($conn,$iqryprodprc_dtl) or die(mysql_error());
											
									}
									else{
										header("Location:view_all_products.php?sts=d&vw=$id&pg=$pgval&countstart=$cntstval$loc");
									}
							 }
						}	 
				 }*/
			   
			   
			   
			   
			   
			   if($id != "" && $cntcntrl != "" ){
				for($i=1;$i<=$cntcntrl;$i++){
					$cntrlid  = glb_func_chkvl("hdnproddid".$i);
					$prodid  = glb_func_chkvl($_POST[$cntrlid]);
					$cntsmlimg= glb_func_chkvl("hdnsmlimg".$i);
					$hdnsmlimg= glb_func_chkvl($_POST[$cntsmlimg]);
					$cntbgimg= glb_func_chkvl("hdnbgimg".$i);
					$hdnbgimg= glb_func_chkvl($_POST[$cntbgimg]);
					//$phtname   = glb_func_chkvl("txtphtname1".$i);
					//$phtname   = glb_func_chkvl($_POST[$phtname]);
					//$prty   = glb_func_chkvl("txtphtprior".$i);
					//$prty   = glb_func_chkvl($_POST[$prty]);
					$phtcntrl_nm= glb_func_chkvl("txtphtname".$i);
					$phtval	    = glb_func_chkvl($_POST[$phtcntrl_nm]);
					$phtname    = $i."-". $phtval;
					if($phtval ==""){
						$phtname    =  $i."-".$code;
					}							
					$prtycntrl_nm= glb_func_chkvl("txtphtprior".$i);
					$prtyval   	= glb_func_chkvl($_POST[$prtycntrl_nm]);
					if(($prtyval == '') || ($prtyval < 1)){
						$prtyval = $i;
					}
					$phtsts  = "lstphtsts".$i;
					$sts     = $_POST[$phtsts];		
				    $lnkcntrl_nm  = glb_func_chkvl("txtphtlnk".$i);
					$lnkval	      = glb_func_chkvl($_POST[$lnkcntrl_nm]);
					$simg='flesmlimg'.$i;
					$bimg='flebgimg'.$i;
						//if($phtname !="" && $prty  !=""){ 
							if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!="")){	
								$himgval = funcUpldImg($hdnsmlimg,'himg');
								$simgval = funcUpldImg($simg,'simg');
								if($simgval != ""){
									$simgary    = explode(":",$simgval,2);
									$sdest 		= $simgary[0];					
									$ssource 	= $simgary[1];	
								}	
							 }
							 if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
								$bimgval = funcUpldImg($bimg,'bimg');
								if($bimgval != ""){
									$bimgary    = explode(":",$bimgval,2);
									$bdest 		= $bimgary[0];					
									$bsource 	= $bimgary[1];					
								}								
							 } 							
							 if($prodid != ''){							  
							   $uqryprodimgd_dtl = "update prodimg_dtl set
													  prodimgd_title = '$phtname', 
													  prodimgd_sts = '$sts',
													  prodimgd_lnk = '$lnkval',
													  prodimgd_prty = '$prtyval',										  	  
													  prodimgd_mdfdon= '$dt',
													  prodimgd_mdfdby = '$ses_admin'";
								if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
									if(isset($_FILES[$simg]['tmp_name']) && ($_FILES[$simg]['tmp_name']!="")){	
										$smlimgpth      = $gsml_fldnm.$hdnsmlimg;
										if(($hdnsmlimg != '') && file_exists($smlimgpth)){
											unlink($smlimgpth);
										}
										$uqryprodimgd_dtl .= ",prodimgd_simg = '$sdest'";
									}
									move_uploaded_file($ssource,$gsml_fldnm.$sdest);						
									
								 }
								if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
									if(isset($_FILES[$bimg]['tmp_name']) && ($_FILES[$bimg]['tmp_name']!="")){
										$bgimgpth      = $gbg_fldnm.$hdnbgimg;
										if(($hdnbgimg != '') && file_exists($bgimgpth)){
											unlink($bgimgpth);
										}
										$uqryprodimgd_dtl .= ",prodimgd_bimg='$bdest'";
									}
									move_uploaded_file($bsource,$gbg_fldnm.$bdest);						
									
								 }
								$uqryprodimgd_dtl .= " where 
													  prodimgd_prodm_id = '$id' and 
													  prodimgd_id='$prodid'";
								$srprodimgd_dtl = mysqli_query($conn,$uqryprodimgd_dtl);																	
							}
							else{								
								 $iqryprod_dtl ="insert into prodimg_dtl(
													 prodimgd_title,prodimgd_simg,prodimgd_bimg,prodimgd_sts,
													 prodimgd_lnk,prodimgd_prty,prodimgd_prodm_id,prodimgd_crtdon,
													 prodimgd_crtdby) values(
													 '$phtname','$sdest','$bdest','$sts',
													 '$lnkval','$prtyval',$id,'$dt',
													 '$ses_admin')";  
									$srprodimgd_dtl = mysqli_query($conn,$iqryprod_dtl) or die(mysql_error());
							}
							//}
							if($srprodimgd_dtl){
								if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
									move_uploaded_file($ssource,$gsml_fldnm.$sdest);
									//$wtrmrkimgnm = funcWtrMrkSml($gsml_fldnm,$sdest);				
								}
								if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
									move_uploaded_file($bsource,$gbg_fldnm.$bdest);
									//$wtrmrkimgnm = funcWtrMrkBg($gbg_fldnm,$bdest);					
								}
							}	
					}//End of For Loop							
					//}																	
				}
				$_SESSION['sesedtprc']="";		
			// } 					
			//if($ursprod_mst==true){											 
			 ?>
				<script>location.href="vw_all_products_detail.php?sts=y&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>"; </script>
			<?php 
			}
			else{
				
			?>
				<script>location.href="vw_all_products_detail.php?sts=n&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>";</script>			
			<?php 
			}		
		}
	}
?>