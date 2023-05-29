<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once "../includes/inc_folder_path.php";	
	if(isset($_POST['btnesizesbmt']) && (trim($_POST['btnesizesbmt']) != "") && 
	   isset($_POST['lsttrtyp']) && (trim($_POST['lsttrtyp']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['vw']) && (trim($_POST['vw']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	
		$id 	  		= glb_func_chkvl($_POST['vw']);
		$trtyp  		= glb_func_chkvl($_POST['lsttrtyp']);
		$name     		= glb_func_chkvl($_POST['txtname']);
		$prior    		= glb_func_chkvl($_POST['txtprior']);
		$desc     		= addslashes(trim($_POST['txtdesc']));
		$title    		= glb_func_chkvl($_POST['txtseotitle']);
		$seodesc  		= glb_func_chkvl($_POST['txtseodesc']);
		$kywrd      	= glb_func_chkvl($_POST['txtkywrd']);
		$seoh1ttl   	= glb_func_chkvl($_POST['txtseoh1ttl']);		
		$seoh1desc  	= glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl   	= glb_func_chkvl($_POST['txtseoh2ttl']);
		$seoh2desc  	= glb_func_chkvl($_POST['txtseoh2desc']);	
		$frmdate    	= glb_func_chkvl($_POST['txtfrmdt']);
		$todate     	= glb_func_chkvl($_POST['txttodt']);
	    $pg 	  		= glb_func_chkvl($_REQUEST['pg']);
		$cntstart 		= glb_func_chkvl($_REQUEST['countstart']);
		$lstcatid 		= glb_func_chkvl($_REQUEST['lstcatid']);
		$val  	  		= glb_func_chkvl($_REQUEST['txtsrchval']); 
		$txttofrmdt		= glb_func_chkvl($_REQUEST['txttofrmdt']);	 
		$chk  	  		= glb_func_chkvl($_REQUEST['chkexact']); 
		if($val !=""){
		$srchval ="&txtsrchval=".$val;	
		}
		if($chk == "y"){
		$srchval .="&chkexact=".$chk;
		}
		if($lstcatid !=""){
		$srchval .="&lstcatid=".$lstcatid;	
		}
		if($txttofrmdt !=""){
		$srchval .="&txttofrmdt=".$txttofrmdt;	
		}
		$sts            = glb_func_chkvl($_POST['lststs']);
		$hdnszchrt 		= glb_func_chkvl($_REQUEST['hdnszimg']);
		$curdt          = date('Y-m-d h:i:s');
		
		/*$frmdt = 'NULL';	 	
		if(isset($_POST['txtfrmdt']) && $_POST['txtfrmdt'] !=''){
			$frmdt  		= "'".date('Y-m-d', strtotime($frmdate))."'";
	 	}
		
	 	$todt = 'NULL';	 	
		if(isset($_POST['txttodt']) && $_POST['txttodt'] !=''){
			$todt  		= "'".date('Y-m-d', strtotime($todate))."'";
	 	}	*/   
		
	    if(isset($_REQUEST['chk']) && trim($_REQUEST['chk'])=='y'){
		  $ck="&chk=y";
		}
		
		if(($val != "") && (optn !="")){
			 $srchval= "&optn=".$optn."&val=".$val.$ck;
		}
		$sqrysize_mst =  "select 
								sizem_name 
							  from 
									size_mst
							  where 
									sizem_name='$name' and
									sizem_trtypm_id='$trtyp' and 
									sizem_id != $id" ;
		$srssize_mst = mysqli_query($conn,$sqrysize_mst);
		$cntscatm    = mysqli_num_rows($srssize_mst);
		if($cntscatm < 1){
			$uqrysize_mst="update size_mst set 
								sizem_name='$name',
								sizem_desc='$desc',
								sizem_trtypm_id='$trtyp',
								sizem_seotitle='$title',
								sizem_seodesc='$seodesc',
								sizem_seokywrd='$kywrd',
								sizem_seohonettl='$seoh1ttl',
								sizem_seohonedesc='$seoh1desc',
								sizem_seohtwottl='$seoh2ttl',
								sizem_seohtwodesc='$seoh2desc',
								sizem_sts='$sts',								
								sizem_prty ='$prior',
								sizem_mdfdon ='$curdt',
								sizem_mdfdby='$ses_admin'";	
			/*if(isset($_FILES['flebgimg']['tmp_name']) && ($_FILES['flebgimg']['tmp_name'] != "")){							
				$bimgval = funcUpldImg('flebgimg','bimg');
				if($bimgval != ""){
					$bimgary    = explode(":",$bimgval,2);
					$bdest 		= $bimgary[0];					
					$bsource 	= $bimgary[1];					
				}								
			
				if(($bsource!='none') && ($bsource!='') && ($bdest != ""))
				{ 
					$bgimgpth      = $gicnimg_upldpth.$hdnbgimg;
					if(($hdnsmlimg != '') && file_exists($bgimgpth))
					{
						unlink($bgimgpth);
					}
					move_uploaded_file($bsource,$gicnimg_upldpth.$bdest);						
					//$uqrysize_mst .= ",sizem_icnimg='$bdest'";
				 }
			}	
			if(isset($_FILES['fleszchrtimg']['tmp_name']) && ($_FILES['fleszchrtimg']['tmp_name']!="")){
				$simgval = funcUpldImg('fleszchrtimg','cimg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
					$sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}							
				$uqrysize_mst .= ",sizem_szchrtimg='$sdest'";
				
		 	}	*/
					  
			$uqrysize_mst .= " where sizem_id='$id'";
			$urssize_mst = mysqli_query($conn,$uqrysize_mst);
			if($urssize_mst==true){
				/*if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
					$smlimgpth      = $gszchrt_upldpth.$hdnszchrt;
					if(($hdnszchrt != '') && file_exists($smlimgpth)){
						unlink($smlimgpth);
					}
					move_uploaded_file($ssource,$gszchrt_upldpth.$sdest);	
					$wtrmrkimgnm = funcWtrMrkSml($gszchrt_upldpth,$sdest,$gicnimg_upldpth,$bdest);	
					if($bdest !='' && file_exists($gicnimg_upldpth.$bdest)){
						unlink($gicnimg_upldpth.$bdest);
					}
				 }*/
			?>
				<script>location.href="view_detail_product_size.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
			<?php
			}
			else{
			?>
				<script>location.href="view_detail_product_size.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";
				</script>			
		 <?php 
			}
		}
		else{
		?>
			<script>location.href="view_detail_product_size.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";
			</script>
		<?php
		}
	}
?>