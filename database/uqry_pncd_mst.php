<?php
	if(isset($_POST['btnedtcty']) && ($_POST['btnedtcty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcty']) && (trim($_POST['lstcty']) != "") &&
	   isset($_SESSION['sesedtarea']) && (trim($_SESSION['sesedtarea'])!="") &&  
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	
	   
	   	$id 	 	  = glb_func_chkvl($_POST['hdnpncdid']);
		$name    	  = glb_func_chkvl($_POST['txtname']);
		$prty         = glb_func_chkvl($_POST['txtprior']);
		$ctyid       = glb_func_chkvl($_POST['lstcty']);
		$sts     	  = glb_func_chkvl($_POST['lststs']);
		$pg           = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart   = glb_func_chkvl($_REQUEST['hdncnt']);
		$dlvr_typ  = glb_func_chkvl($_POST['lstdlvrtyp']);	
		$val          = glb_func_chkvl($_REQUEST['val']);
		$optn         = glb_func_chkvl($_REQUEST['optn']);		
		$dt      	  = date('Y-m-d');
		
		if(isset($_POST['lstcnty']) && $_POST['lstcnty']!="")
		{
		     $cntyid=$_POST['lstcnty'];
		}
		else
		{
		    $cntyid=$_POST['hdncnty'];
		}
	    if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y')
		{
		  $ck="&chk=y";
		}
		if(($val != "") && (optn !=""))
		{
			 $srchval= "&optn=".$optn."&val=".$val.$ck;
		}
		$sqrypncd_mst="select pncdm_code
		              from pncd_mst
					  where pncdm_code='$name'
					  and pncdm_id!=$id";
		$srspncd_mst = mysqli_query($conn,$sqrypncd_mst);
		$rows       = mysqli_num_rows($srspncd_mst);
		if($rows > 0)
		{
		?>
			<script>location.href="view_pincode_detail.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>
	<?php
		}
		else
		{
			 $uqrypncd_mst="update pncd_mst set 
						   pncdm_code='$name',
						   pncdm_ctym_id='$ctyid',
						   pncdm_dlvrtyp='$dlvr_typ',
						   pncdm_prty='$prty',
						   pncdm_sts='$sts',
						   pncdm_mdfdon='$dt',
						   pncdm_mdfdby='$ses_admin'
						   where pncdm_id=$id";
			$urspncd_mst = mysqli_query($conn,$uqrypncd_mst);
			if($urspncd_mst==true){
				
				/* -----------  Sizes ----------------------*/
			    $secprc 		= explode("<->",$_SESSION['sesedtarea']);	
				$dqrypncd_dtl = "delete from 
									 pncd_dtl
								 where 
									pncdd_pncdm_id = $id";
					$drspncd_dtl=mysqli_query($conn,$dqrypncd_dtl);
					if($drspncd_dtl=='true'){
						if($secprc !="" && $id!=""){
							$prty = 0;
								for($inc = 0; $inc < count($secprc);$inc++){
									$prty ++;
									$prcs   = explode("--",$secprc[$inc]);
									$areanm    = $prcs[0];
									$stsval     = $prcs[1]; 
								   $sqrypncd_dtl = "select 
															   pncdd_id
															from 
															   pncd_dtl
															where 
															   pncdd_name = '$areanm' and
															   pncdd_pncdm_id = '$id'";				   
									$srspnts_dtl   = mysqli_query($conn,$sqrypncd_dtl);
									$rowspncd_dtl  = mysqli_num_rows($srspnts_dtl);
									if($rowspncd_dtl < 1){
										$iqrypncd_dtl="insert into  pncd_dtl(
																  pncdd_name,pncdd_sts,pncdd_prty,
																  pncdd_pncdm_id,pncdd_crtdon,pncdd_crtdby)
																  values(
																  '$areanm','$stsval','$inc',
																  '$id','$dt','$admin')";
										$irspncd_dtl = mysqli_query($conn,$iqrypncd_dtl) or die(mysql_error());
										
									}
									else{
									  $gmsg= "Duplicate Subcategory";				  
									}
								}		
							}
						}	
					$_SESSION['sesedtarea'] = '';  
				
			?>
				<script>location.href="view_pincode_detail.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>
			<?php
			}
			else
			{
			?>
				<script>location.href="view_pincode_detail.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>			
<?php 
			}
		}
	}
?>	