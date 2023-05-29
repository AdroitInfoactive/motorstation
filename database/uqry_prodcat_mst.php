<?php
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	
	if(isset($_POST['btneprodcatsbmt']) && (trim($_POST['btneprodcatsbmt']) != "") && 	
	   isset($_POST['txtname'])  &&  (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")&& 
	  // isset($_POST['txthmprior']) && (trim($_POST['txthmprior']) != "") && 
	   isset($_POST['vw']) && (trim($_POST['vw']) != "")){
	   
		$id 	  	= glb_func_chkvl($_POST['vw']);
		$name     	= glb_func_chkvl($_POST['txtname']);
		$prior    	= glb_func_chkvl($_POST['txtprior']);
		$hmprior  	= glb_func_chkvl($_POST['txthmprior']);
		$desc     	= addslashes(trim($_POST['txtdesc']));
		$title    	= glb_func_chkvl($_POST['txtseotitle']);
		$seodesc  	= glb_func_chkvl($_POST['txtseodesc']);
		$kywrd      = glb_func_chkvl($_POST['txtkywrd']);
		$seoh1ttl   = glb_func_chkvl($_POST['txtseoh1ttl']);		
		$seoh1desc  = glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl   = glb_func_chkvl($_POST['txtseoh2ttl']);
		$seoh2desc  = glb_func_chkvl($_POST['txtseoh2desc']);	    
		$hdnsmlimg	=  glb_func_chkvl($_POST['hdnsmlimg']);
		$hdnbgimg	=  glb_func_chkvl($_POST['hdnbgimg']);	
		$sts      	= glb_func_chkvl($_POST['lststs']);
		$pg        	= glb_func_chkvl($_REQUEST['pg']);
		$cntstart 	= glb_func_chkvl($_REQUEST['countstart']);
		$val        = glb_func_chkvl($_REQUEST['txtsrchval']);
		$taxval			= 'NULL';	
		 if(isset($_POST['lsttax']) && (trim($_POST['lsttax'])!='')){
		 	$taxval       		= glb_func_chkvl($_POST['lsttax']);	
		 }
		$dlvrtyp			= glb_func_chkvl($_POST['lstdlvrtyp']);		
		$cur_dt     = date('Y-m-d H:i:s');
		if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
		  $chk="&chkexact=y";
		 }
		 if($val != ""){
			$srchval= "&txtsrchval=".$val.$chk;
		 }
		$sqryprodcat_mst="select 
								prodcatm_name 
		                  from 
						  		prodcat_mst
					      where 
						  		prodcatm_name='$name' and 
						   		prodcatm_id != $id";
		$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
		$rows_cnt       = mysqli_num_rows($srsprodcat_mst);
		if($rows_cnt > 0){
		?>
		    <script type="text/javascript">
			location.href="view_detail_product_category.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			$uqryprodcat_mst= "update prodcat_mst set 
								prodcatm_name='$name',
								prodcatm_sts='$sts',
								prodcatm_desc='$desc',
								prodcatm_seotitle='$title',
								prodcatm_taxm_id =$taxval,
								prodcatm_dlvrtyp ='$dlvrtyp',
								prodcatm_seodesc='$seodesc',
								prodcatm_seokywrd='$kywrd',
								prodcatm_seohonettl='$seoh1ttl',
								prodcatm_seohonedesc='$seoh1desc',
								prodcatm_seohtwottl='$seoh2ttl',
								prodcatm_seohtwodesc='$seoh2desc',
								prodcatm_prty ='$prior',
								prodcatm_mdfdon ='$cur_dt',
								prodcatm_mdfdby='$ses_admin'";
			/*if(isset($_FILES['flebgimg']['tmp_name']) && ($_FILES['flebgimg']['tmp_name'] != "")){							
				$bimgval = funcUpldImg('flebgimg','bimg');
				if($bimgval != ""){
					$bimgary    = explode(":",$bimgval,2);
					$bdest 		= $bimgary[0];					
					$bsource 	= $bimgary[1];					
				}								
			
				if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
				{ 
					$bgimgpth      = $gadmcatbnr_upldpth.$hdnbgimg;
					if(($hdnbgimg != '') && file_exists($bgimgpth))
					{
						unlink($bgimgpth);
					}
					move_uploaded_file($bsource,$gadmcatbnr_upldpth.$bdest);						
					$uqryprodcat_mst .= ",prodcatm_bnrimg='$bdest'";
				 }
			}
			if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				
				$himgval = funcUpldImg($himg,'himg');
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}							
			
				if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
				{ 
					$smlimgpth      = $gadmcatsml_upldpth.$hdnsmlimg;
					if(($hdnsmlimg != '') && file_exists($smlimgpth))
					{
						unlink($smlimgpth);
					}
					move_uploaded_file($ssource,$gadmcatsml_upldpth.$sdest);
					$wtrmrkimgnm = funcWtrMrkSml($gadmcatsml_upldpth,$sdest,$gadmcatbnr_upldpth,$bdest);						
					$uqryprodcat_mst .= ",prodcatm_smlimg='$sdest'";
				 }
				 if($bdest !='' && file_exists($gadmcatbnr_upldpth.$bdest)){
				 	unlink($gadmcatbnr_upldpth.$bdest);
				 }
		  }*/
		  if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				
				$himgval = funcUpldImg($himg,'himg');
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}							
			
				if(($ssource!='none') && ($ssource!='') && ($sdest != ""))
				{ 
					$smlimgpth      = $gadmcatsml_upldpth.$hdnsmlimg;
					if(($hdnsmlimg != '') && file_exists($smlimgpth))
					{
						unlink($smlimgpth);
					}
					move_uploaded_file($ssource,$gadmcatsml_upldpth.$sdest);						
					$uqryprodcat_mst .= ",prodcatm_smlimg='$sdest'";
				 }
		  }
	  	if(isset($_FILES['flebgimg']['tmp_name']) && ($_FILES['flebgimg']['tmp_name'] != "")){							
				$bimgval = funcUpldImg('flebgimg','bimg');
				if($bimgval != ""){
					$bimgary    = explode(":",$bimgval,2);
					$bdest 		= $bimgary[0];					
					$bsource 	= $bimgary[1];					
				}								
			
				if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
				{ 
					$bgimgpth      = $gadmcatbnr_upldpth.$hdnbgimg;
					if(($hdnsmlimg != '') && file_exists($bgimgpth))
					{
						unlink($bgimgpth);
					}
					move_uploaded_file($bsource,$gadmcatbnr_upldpth.$bdest);						
					$uqryprodcat_mst .= ",prodcatm_bnrimg='$bdest'";
				 }
			}
	  	
			$uqryprodcat_mst .= " where prodcatm_id=$id";
			$ursprodmncat_mst = mysqli_query($conn,$uqryprodcat_mst);
			if($ursprodmncat_mst==true){
			?>
			  <script type="text/javascript">
				location.href="view_detail_product_category.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
			<?php
			}
			else{
			?>
			  <script type="text/javascript">
			  location.href="view_detail_product_category.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>		
		<?php
			}
		}
	}
?>