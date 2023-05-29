<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
    include_once '../includes/inc_adm_session.php';//Check the session is created or not
    include_once '../includes/inc_connection.php';//making the connection with database table	
	if(isset($_POST['btnedtcat']) && (trim($_POST['btnedtcat']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "") &&
	   isset($_POST['hdncatid']) && (trim($_POST['hdncatid']) != "")){	   
		$id 	    = glb_func_chkvl($_POST['hdncatid']);		
		$name       = glb_func_chkvl($_POST['txtname']);
		$desc       = glb_func_chkvl($_POST['txtdesc']);
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
		//$emp        = $_SESSION['sesadmin'];
		if(isset($_REQUEST['hdnchk']) && $_REQUEST['hdnchk']=='y')
		{
		  $ck="&chk=y";
		}
		if($val != "")
		{
			$srchval= "&val=".$val.$ck;
		}
		$sqrycatone_mst="select 
						 	catonem_name
						 from 
						 	catone_mst
						 where 
						 	catonem_name='$name' and 
							catonem_id!=$id";
		$srscatone_mst = mysqli_query($conn,$sqrycatone_mst);
		$rows       = mysqli_num_rows($srscatone_mst);
		if($rows > 0)
		{
		?>
			<script>location.href="vw_all_categoryone.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			$uqrycatone_mst="update catone_mst set 
							  catonem_name='$name',							 
							  catonem_desc='$desc',
							  catonem_seotitle='$seotitle',
							  catonem_seodesc='$seodesc',
							  catonem_seokywrd='$seokywrd',
							  catonem_seohonetitle='$seoh1ttl',
							  catonem_seohonedesc='$seoh1desc',
							  catonem_seohtwotitle='$seoh2ttl',
							  catonem_seohtwodesc='$seoh2desc',	
							  catonem_prty='$prty',
							  catonem_sts='$sts',					  
							  catonem_mdfdon='$dt',
							  catonem_mdfdby='$ses_admin'";
			$uqrycatone_mst .= "  where catonem_id=$id";	
			$urscatone_mst = mysqli_query($conn,$uqrycatone_mst);
			if($urscatone_mst==true){
			?>
				<script>location.href="vw_all_categoryone.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";                </script>
			<?php
			}
			else{
			?>
				<script>location.href="vw_all_categoryone.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";         </script>			
<?php 
			}
		}
	}
?>