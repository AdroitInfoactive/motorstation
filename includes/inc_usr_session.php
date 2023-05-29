<?php
/* session_start();
if((!isset($_SESSION['sesadmin'])) || ($_SESSION['sesadmin']=="") || (!isset($_SESSION['sestyp'])) || $_SESSION['sestyp'] != 'm') 
{
?>
	<script language="javascript">
		location.href = "../admin/index.php";
	</script>
<?php	
}
else
{
	$admin = $_SESSION['sesadmin'];
	$typ   = $_SESSION['sestyp'];
} */
?>
<?php
	if(!isset($_SESSION)){
		 session_start();
	}
	ob_start("ob_gzhandler");
	$_SESSION['sespgval'] = 20;//maximum rows per page
	if(!isset($_SESSION['sescrncy']) || (trim($_SESSION['sescrncy']) == "")){
		//session_register("sescrncy");		
		$_SESSION['sescrncy'] = "1";
	}
	if(!isset($_SESSION['seslstpgval'])){
		//session_register('seslstpgval');	
	}						
	if(!isset($_SESSION['sesrqsttyp'])){
		//session_register("sesrqsttyp");	
	}	
	if(!isset($_SESSION['sespgval'])){
		//session_register("sespgval");	
		$_SESSION['sespgval'] = 8;  
	}		
	if(!isset($_SESSION['sesordrval'])){
		//session_register("sesordrval");	
		$_SESSION['sesordrval'] = 'asc';  
	}			
	include_once 'includes/inc_connection.php';//Make connection with the database		
?>
