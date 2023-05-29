<?php
	session_start();
	if((isset($_SESSION['sesmbrid'])) && ($_SESSION['sesmbrid']!="") &&  
	   (isset($_SESSION['sesmbremail'])) && ($_SESSION['sesmbremail']!="")){
	?>
		<script type="text/javascript">
			location.href = "add_member_address.php";
		</script>
	<?php	
		exit();
	}
?>