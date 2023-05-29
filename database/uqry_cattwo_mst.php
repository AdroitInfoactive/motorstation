<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table
	
	if(isset($_POST['btnedtcat']) && (trim($_POST['btnedtcat']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "") &&
	   isset($_POST['hdncatid']) && (trim($_POST['hdncatid']) != ""))
	{
		$id 	    = glb_func_chkvl($_POST['hdncatid']);
		$name       = glb_func_chkvl($_POST['txtname']);
		$desc       = addslashes(trim($_POST['txtdesc']));
		$seotitle   = glb_func_chkvl($_POST['txtseotitle']);
		$seodesc    = glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd   = glb_func_chkvl($_POST['txtseokywrd']);
		$seoh1ttl   = glb_func_chkvl($_POST['txtseoh1ttl']);
		$seoh1desc  = glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2ttl   = glb_func_chkvl($_POST['txtseoh2ttl']); 
		$seoh2desc  = glb_func_chkvl($_POST['txtseoh2desc']);
		$prty       = glb_func_chkvl($_POST['txtprior']);
		$sts        = glb_func_chkvl($_POST['lststs']);
		$pg         = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
		$val        = glb_func_chkvl($_REQUEST['hdnval']);
		$dt         = date('Y-m-d h:i:s');
		if(isset($_REQUEST['hdnchk']) && $_REQUEST['hdnchk']=='y'){
		  $ck="&chk=y";
		}
		if($val != ""){
			$srchval= "&val=".$val.$ck;
		}
		$sqrycattwo_mst="select 
							cattwom_name
		              	 from 
					  		cattwo_mst
					  	 where 
					  		cattwom_name='$name' and 
					 		cattwom_id!=$id";
		$srscattwo_mst = mysqli_query($conn,$sqrycattwo_mst);
		$rows       = mysqli_num_rows($srscattwo_mst);
		if($rows > 0){
		?>
			<script>location.href="vw_all_categorytwo.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			$uqrycattwo_mst="update cattwo_mst set 
							  cattwom_name='$name',							  
							  cattwom_desc='$desc',
							  cattwom_seotitle='$seotitle',
							  cattwom_seodesc='$seodesc',
							  cattwom_seokywrd='$seokywrd',
							  cattwom_seohonetitle='$seoh1ttl',
						  	  cattwom_seohonedesc='$seoh1desc',
						      cattwom_seohtwotitle='$seoh2ttl',
						      cattwom_seohtwodesc='$seoh2desc',	
							  cattwom_prty='$prty',
							  cattwom_sts='$sts',						  
							  cattwom_mdfdon='$dt',
							  cattwom_mdfdby='$ses_admin'";						
			$uqrycattwo_mst .= "  where cattwom_id=$id";	
			$urscattwo_mst = mysqli_query($conn,$uqrycattwo_mst);
			if($urscattwo_mst==true)
			{
			?>
				<script>location.href="vw_all_categorytwo.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";                </script>
			<?php
			}
			else
			{
			?>
				<script>location.href="vw_all_categorytwo.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";                </script>			
<?php 
			}
		}
	}
?>