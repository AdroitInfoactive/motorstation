<?php	
	include_once '../includes/inc_nocache.php';      //Clearing the cache information
	include_once "../includes/inc_adm_session.php";  //checking for session
	include_once "../includes/inc_connection.php";   //Making database Connection
	if(isset($_POST['btnadeventsbmt']) && (trim($_POST['btnadeventsbmt']) != "") && 
	  isset($_POST['txtcode'])    && (trim($_POST['txtcode']) != "") &&	
	   isset($_POST['txtname'])    && (trim($_POST['txtname']) != "") &&	
	   //isset($_POST['txtfrmdate']) && (trim($_POST['txtfrmdate']) != "") &&	
	   //isset($_POST['txttodate'])  && (trim($_POST['txttodate']) != "") &&	
	   //(strtotime($_POST['txtfrmdate']) <= strtotime($_POST['txttodate'])) && 
	   //isset($_POST['txtval'])   && (trim($_POST['txtval']) != "") &&	
	   isset($_POST['txtprty'])  && (trim($_POST['txtprty']) != "")){
	   	 $code       	= glb_func_chkvl($_POST['txtcode']);
		 $name       	= glb_func_chkvl($_POST['txtname']);
		 $frmdate      	= glb_func_chkvl($_POST['txtfrmdate']);
		 $todate      	= glb_func_chkvl($_POST['txttodate']);
		 $qryfrm_val ="";
		 $qryfrm_cntrl ="";
		 if($frmdate !=''){
			 $frmdate      	= date('Y-m-d',strtotime(glb_func_chkvl($_POST['txtfrmdate'])));
			 $qryfrm_cntrl    = ",ofrm_frm";
			 $qryfrm_val    = ",'$frmdate'";
			 
		 }
		 $qryto_val ="";
		 $qryto_cntrl ="";
		 if($todate !=''){
		  $todate       	= date('Y-m-d',strtotime(glb_func_chkvl($_POST['txttodate'])));	
		 	$qryto_cntrl    = ",ofrm_to";
			 $qryto_val    = ",'$todate'";
		 }
		 $frmdate =(NULL);
		 $desc          = addslashes(trim($_POST['txtdesc']));
		 $lnknm       	= glb_func_chkvl($_POST['txtlnk']);
		 $val		 	= glb_func_chkvl($_POST['txtval']);
		/* $cat1			= 0;
		if(isset($_POST['lstcat1']) && (trim($_POST['lstcat1'])!='')){
		   $cat1         = glb_func_chkvl($_POST['lstcat1']);
		}
		 $cat2			= 0;
		if(isset($_POST['lstcat2']) && (trim($_POST['lstcat2'])!='')){
		   $cat2         = glb_func_chkvl($_POST['lstcat2']);
		}
		 $prod			= 0;
		if(isset($_POST['lstprod']) && (trim($_POST['lstprod'])!='')){
		   $prod         = glb_func_chkvl($_POST['lstprod']);
		}
		
		 $val			= "NULL";
		 if(isset($_POST['txtoprc']) && (trim($_POST['txtoprc'])!='')){
		   $val 		=  glb_func_chkvl($_POST['txtval']);
		 }
		 
		  $typ         = glb_func_chkvl($_POST['lsttyp']); 
		 */
		 $adrs1         = glb_func_chkvl($_POST['txtadrs1']);
		
		 //$val          = glb_func_chkvl($_POST['txtval']);
		 
		 $prior       	= glb_func_chkvl($_POST['txtprty']);
		 $sts         	= glb_func_chkvl($_POST['lststs']);
		 $dt          	= date('Y-m-d h:i:s');			 	 
		 $sqryofr_mst	=	"select 
								ofrm_name
							 from
								ofr_mst
							 where
								ofrm_code='$code'";
		 $srsofr_mst  = mysqli_query($conn,$sqryofr_mst);
		 $rowsofr_mst = mysqli_num_rows($srsofr_mst);
		 if($rowsofr_mst > 0){
			$gmsg = "Duplicate Combination Of Name and Date";
		 }
		 else{		
			//**********************IMAGE UPLOADING START*******************************//
			/*------------------------------------Update Smaill image----------------------------*/	

		  if(isset($_FILES['flesmlimg']['tmp_name']) && ($_FILES['flesmlimg']['tmp_name']!="")){
				$simgval = funcUpldImg('flesmlimg','simg');
				if($simgval != ""){
					$simgary    = explode(":",$simgval,2);
				    $sdest 		= $simgary[0];					
					$ssource 	= $simgary[1];	
				}
		  }
		  //*****************IMAGE UPLAODING END************************************//
		/* $iqryofr_mst="insert into ofr_mst(
						ofrm_code,ofrm_name,ofrm_frm,ofrm_to,
						ofrm_desc,ofrm_lnknm,ofrm_typ,ofrm_val,
						ofrm_catonem_id,ofrm_cattwom_id,ofrm_prodm_id,ofrm_smlimg,
						ofrm_sts,ofrm_prty,ofrm_crtdon,ofrm_crtdby)values(						
						'$code','$name','$frmdate','$todate',
						'$desc','$lnknm','$typ',$val,
						'$cat1','$cat2','$prod','$sdest',
						'$sts','$prior','$dt','$s_admn')";*/
			$iqryofr_mst="insert into ofr_mst(
						ofrm_code,ofrm_name$qryfrm_cntrl$qryto_cntrl,
						ofrm_desc,ofrm_lnknm,ofrm_smlimg,ofrm_sts,
						ofrm_prty,ofrm_crtdon,ofrm_crtdby)values(						
						'$code','$name'$qryfrm_val$qryto_val,
						'$desc','$lnknm','$sdest','$sts',
						'$prior','$dt','$s_admn')";
									
		  $irsofr_mst = mysqli_query($conn,$iqryofr_mst) or die(mysql_error());			
		  if($irsofr_mst==true){	
				if(($ssource!='none') && ($ssource!='') && ($sdest != "")){ 
					move_uploaded_file($ssource,$gsmlofr_fldnm.$sdest);
				}			
				$gmsg = "Record saved successfully";
		   }
		   else{
				$gmsg = "Record not saved";
			}					
		}
	}
?>