<?php
	include_once '../includes/inc_nocache.php';     //Clearing the cache information
    include_once '../includes/inc_adm_session.php'; //Check the session is created or not	
	include_once '../includes/inc_folder_path.php';
	
		if(isset($_POST['btnedteventsbmt']) && (trim($_POST['btnedteventsbmt']) != "") && 
		   isset($_POST['txtname']) && (trim($_POST['txtname']) != "")               &&	
		   //isset($_POST['txtfrmdate']) && (trim($_POST['txtfrmdate']) != "")         &&	
		   //isset($_POST['txttodate']) && (trim($_POST['txttodate']) != "")          &&	
		   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")   &&
		   isset($_POST['hdneventid']) && (trim($_POST['hdneventid']) != "")){	     
	  
		 $id 	  	    = glb_func_chkvl($_REQUEST['hdneventid']);
		 $desc          = addslashes($_POST['txtdesc']);
		 $code     		= glb_func_chkvl($_POST['txtcode']);		 	
		 $name       	= glb_func_chkvl($_POST['txtname']);
		 $frmdt       	= glb_func_chkvl($_POST['txtfrmdate']);
		 $todt       	= glb_func_chkvl($_POST['txttodate']);
		// $ofrfrmdt  	= date('Y-m-d', strtotime($frmdt));
		// $ofrtodt	  	= date('Y-m-d', strtotime($todt));
		 $lnknm       	= glb_func_chkvl($_POST['txtlnk']);
		
		
		/* $typ       	= glb_func_chkvl($_POST['lsttyp']);
		 
		    $ofrval			= "NULL";
			if(isset($_POST['txtoprc']) && (trim($_POST['txtoprc'])!='')){
				$ofrval 		=  glb_func_chkvl($_POST['txtval']);
			}
			$catid			= 0;
			if(isset($_POST['lstcat1']) && (trim($_POST['lstcat1'])!='')){
			   $catid         = glb_func_chkvl($_POST['lstcat1']);
			}
			 $scatid			= 0;
			if(isset($_POST['lstcat2']) && (trim($_POST['lstcat2'])!='')){
			   $scatid         = glb_func_chkvl($_POST['lstcat2']);
			}
			 $prod			= 0;
			if(isset($_POST['lstprod']) && (trim($_POST['lstprod'])!='')){
			   $prod         = glb_func_chkvl($_POST['lstprod']);
			}*/
			 $prior       	= glb_func_chkvl($_POST['txtprty']);
			 $sts         	= glb_func_chkvl($_POST['lststs']);		
			 $curdt         = date('Y-m-d h:i:s');
			 $pg          	= glb_func_chkvl($_REQUEST['hdnpage']);
			 $cntstart  	= glb_func_chkvl($_REQUEST['hdncount']);
			 $optn        	= glb_func_chkvl($_REQUEST['hdnoptn']);
			 $val         	= glb_func_chkvl($_REQUEST['hdnval']);
		 
			if(isset($_REQUEST['hdnchk']) && $_REQUEST['hdnchk']=='y'){
				$ck="&chk=y";
			 }
			 if($val != ""){
				$srchval= "&optn=".$optn."&val=".$val.$ck;
			 }		
				$sqryofr_mst	="select 
									ofrm_code
							  from
									ofr_mst
							  where
									ofrm_code='$code' and								
									ofrm_id != '$id'";
			$srsofr_mst    = mysqli_query($conn,$sqryofr_mst) or die (mysql_error());
			$cnt_rec       = mysqli_num_rows($srsofr_mst);
			if($cnt_rec  > 0){
			?>
				<script>location.href="view_ofr_details.php?sts=d&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
			<?php
			}
			else
			{
			$uqryoffr_mst="update  ofr_mst set 
								   ofrm_code='$code',	
								   ofrm_name='$name',
								   ofrm_desc='$desc'";
			if($frmdt !=''){
				 $frmdate      	= date('Y-m-d',strtotime(glb_func_chkvl($_POST['txtfrmdate'])));
				 $uqryoffr_mst.= ",ofrm_frm= '$frmdate'";
			 }
			 if($todt !=''){
			  	$todate       	= date('Y-m-d',strtotime(glb_func_chkvl($_POST['txttodate'])));	
				$uqryoffr_mst    .= " ,ofrm_to='$todate'";
			 }	
			  $uqryoffr_mst.= " ,ofrm_lnknm='$lnknm',								   
								   ofrm_sts='$sts',
								   ofrm_prty='$prior',
								   ofrm_mdfdon='$curdt',
								   ofrm_mdfdby='$cur_sesadmin'";
									   
				/*------------------------------------Update small image----------------------------*/	
				
				if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
					$simgval = funcUpldImg('flesmlimg','smlimg');
					if($simgval != ""){
						$simgary    = explode(":",$simgval,2);
						$sdest 		= $simgary[0];					
						$ssource 	= $simgary[1];					
					}
						$uqryoffr_mst .= ",ofrm_smlimg='$sdest'";
					
				}	
			/*------------------------------------Update Big image----------------------------*/					
				
				$uqryoffr_mst .= " where ofrm_id ='$id'";	
				 
				$ursoffr_mst= mysqli_query($conn,$uqryoffr_mst) or die (mysql_error());						
				if($ursoffr_mst==true){
						if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
							$simgnm   = glb_func_chkvl($_REQUEST['hdnsimgnm']);
							$simgpth      = $gsmlofr_fldnm.$simgnm;
							if(($simgnm != '') && file_exists($simgpth)){
								unlink($simgpth);
							}
							move_uploaded_file($ssource,$gsmlofr_fldnm.$sdest);
						}
								
				 ?>
					<script>location.href="view_ofr_details.php?sts=y&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>"; </script>
				<?php
				}
				else{
				?>
					<script>location.href="view_ofr_details.php?sts=n&vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$srchval;?>";</script>
				<?php 
				}		
			}
		}
?>