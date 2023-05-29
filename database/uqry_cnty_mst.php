<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	
	if(isset($_POST['btnedtcntry']) && ($_POST['btnedtcntry'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcntry']) && (trim($_POST['lstcntry']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
		$id 	      = glb_func_chkvl($_POST['hdncntyid']);
		$name         = glb_func_chkvl($_POST['txtname']);
		$cntryid      = glb_func_chkvl($_POST['lstcntry']);
		$iso  	      = glb_func_chkvl($_POST['txtiso']);
		$prty         = glb_func_chkvl($_POST['txtprior']);
		$sts          = glb_func_chkvl($_POST['lststs']);
		$pg           = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart   = glb_func_chkvl($_REQUEST['hdncnt']);
		$val          = glb_func_chkvl($_REQUEST['val']);
		$optn         = glb_func_chkvl($_REQUEST['optn']);
		$dt           = date('Y-m-d');
		
		$sqrycnty_mst="select 
							cntym_name
		               from 
					   		cnty_mst
					   where 
					   		cntym_name='$name'
					   and 
					   	  cntym_id!=$id";
		$srscnty_mst = mysqli_query($conn,$sqrycnty_mst);
	    if(isset($_REQUEST['chk']) && $_REQUEST['chk']=='y'){
		  $ck="&chk=y";
		}
		if(($val != "") && (optn !="")){
			 $srchval= "&optn=".$optn."&val=".$val.$ck;
		}
		$rows        = mysqli_num_rows($srscnty_mst);
		if($rows > 0){
		?>
			<script>location.href="vw_all_county.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			$uqrycnty_mst="update cnty_mst set 
						   cntym_name='$name',
						   cntym_cntrym_id='$cntryid',
						   cntym_iso='$iso',
						   cntym_prty='$prty',
						   cntym_sts='$sts',
						   cntym_mdfdon='$dt',
						   cntym_mdfdby='$ses_admin'
						   where cntym_id=$id";
			$urscnty_mst = mysqli_query($conn,$uqrycnty_mst);
			if($urscnty_mst==true){
			?>
			 <script>location.href="vw_all_county.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?><?php echo $srchval;?>";</script>
			<?php
			}
			else{
			?>
			 <script>location.href="vw_all_county.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?> <?php echo $srchval;?>";</script>			
<?php 
			}
		}
	}
?>