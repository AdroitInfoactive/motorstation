<?php
	session_start();
	if((!isset($_SESSION['sesmbrid'])) || ($_SESSION['sesmbrid']=="") || (!isset($_SESSION['sesmbremail'])) || ($_SESSION['sesmbremail']==""))
	{
	?>
		<script type="text/javascript">
			location.href = "signin.php";
		</script>
	<?php	
		exit();
	}
	else
	{
		$membremail     = $_SESSION['sesmbremail'];
		$membrid   	    = $_SESSION['sesmbrid'];
	}	
?>