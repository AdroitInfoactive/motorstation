<?php
	if(isset($_POST['btnedtcty']) && ($_POST['btnedtcty'] != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcnty']) && (trim($_POST['lstcnty']) != "") &&
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
	{
	   	$id 	 	  = glb_func_chkvl($_POST['hdnctyid']);
		$name    	  = glb_func_chkvl($_POST['txtname']);
		$prty         = glb_func_chkvl($_POST['txtprior']);
		$cntyid       = glb_func_chkvl($_POST['lstcnty']);
		$iso  	  	  = glb_func_chkvl($_POST['txtiso']);
		$sts     	  = glb_func_chkvl($_POST['lststs']);
		$pg           = glb_func_chkvl($_REQUEST['hdnpage']);
		$countstart   = glb_func_chkvl($_REQUEST['hdncnt']);
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
		$sqrycty_mst="select ctym_name
		              from cty_mst
					  where ctym_name='$name'
					  and ctym_id!=$id";
		$srscty_mst = mysqli_query($conn,$sqrycty_mst);
		$rows       = mysqli_num_rows($srscty_mst);
		if($rows > 0)
		{
		?>
			<script>location.href="vw_all_city.php?sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>
	<?php
		}
		else
		{
			 $uqrycty_mst="update cty_mst set 
						   ctym_name='$name',
						   ctym_cntym_id='$cntyid',
						   ctym_iso='$iso',
						   ctym_prty='$prty',
						   ctym_sts='$sts',
						   ctym_mdfdon='$dt',
						   ctym_mdfdby='$ses_admin'
						   where ctym_id=$id";
			$urscty_mst = mysqli_query($conn,$uqrycty_mst);
			if($urscty_mst==true)
			{
			?>
				<script>location.href="vw_all_city.php?sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>
			<?php
			}
			else
			{
			?>
				<script>location.href="vw_all_city.php?sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval?>";</script>			
<?php 
			}
		}
	}
?>	