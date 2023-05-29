<?php
	if(!isset($_SESSION)){
		 session_start();
	}
	if(!isset($_SESSION['sespgval'])){
		$_SESSION['sespgval']=18;  
	}	
/*	ob_start("ob_gzhandler");
	if(!isset($_SESSION['sescrncy']) || (trim($_SESSION['sescrncy'])=="")){
		session_register("sescrncy");		
		$_SESSION['sescrncy'] = "INR";
	}
	if(!isset($_SESSION['seslstpgval'])){
		session_register('seslstpgval');	
	}						
	if(!isset($_SESSION['sesrqsttyp'])){
		session_register("sesrqsttyp");	
	}	
	if(!isset($_SESSION['sespgval'])){
		session_register("sespgval");	
		$_SESSION['sespgval']=8;  
	}		
	if(!isset($_SESSION['sesordrval'])){
		session_register("sesordrval");	
		$_SESSION['sesordrval']='asc';  
	}		*/	
	include_once 'includes/inc_connection.php';//Make connection with the database	
	
	/*if(!isset($_SESSION['sescrncy']) || (trim($_SESSION['sescrncy']) == "") || 
	   !isset($_SESSION['sescnvtrval']) || (trim($_SESSION['sescnvtrval']) == "")){	   
		//session_register("sescrncy");
		//session_register("sescnvtrval");				
		$_SESSION['sescrncy'] = 1;
		$_SESSION['sescnvtrval'] = 1;		
	}
	elseif(isset($_POST['lstcnvr']) && (trim($_POST['lstcnvr']) != "")){
		$_SESSION['sescrncy'] = $_POST['lstcnvr'];				
		$from   = 'INR'; 
		$to     = funcCrncyNm($_SESSION['sescrncy']);	
		$url 	= 'http://www.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, '$url');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
 
    	$handle = curl_exec($ch);	
		curl_close($ch);
		$handle = fopen($url, 'r');
		if ($handle) {
			$result = fgets($handle, 4096);
			fclose($handle);
			$allData = explode(',',$result);  //Get all the contents to an array 
			$_SESSION['sescnvtrval'] = $allData[1];								
		}
	}	*/
	
	/*if(!isset($_SESSION['sescrncy']) || (trim($_SESSION['sescrncy']) == "") || 
	   !isset($_SESSION['sescnvtrval']) || (trim($_SESSION['sescnvtrval']) == "")){	   
		//session_register("sescrncy");
		//session_register("sescnvtrval");				
		$_SESSION['sescrncy'] = 1;
		$_SESSION['sescnvtrval'] = 1;		
	}
	else */
	/*if(!isset($_SESSION['sescrncy']) || (trim($_SESSION['sescrncy']) == "") || 
	   !isset($_SESSION['sescnvtrval']) || (trim($_SESSION['sescnvtrval']) == "")){	   
		//session_register("sescrncy");
		//session_register("sescnvtrval");				
		$_SESSION['sescnvr_chrg'] = 1;
		$_SESSION['sescrncy'] = 1;
	}
	else*/ 
	
	
	if(isset($_POST['lstcrncy']) && (trim($_POST['lstcrncy']) != "")){
		$_SESSION['sescnvr_id'] = $_POST['lstcrncy'];				
		$from   = 'INR'; 
		//$to     = funcCrncyNm($_SESSION['sescrncy']);	
		$sqrycnvrsn_mst = "select 
								cnvrsnm_id,cnvrsnm_name,cnvrsnm_val
							from
								cnvrsn_mst
							where
								cnvrsnm_sts='a' and
							cnvrsnm_id = '$_POST[lstcrncy]'";
		 $srscnvrsn_mst = mysqli_query($conn,$sqrycnvrsn_mst);
		 $cntcnvrsn_mst = mysqli_num_rows($srscnvrsn_mst);
		 if($cntcnvrsn_mst > 0){
		 	$srowcnvrsn_mst = mysqli_fetch_assoc($srscnvrsn_mst);
			$cnvrnm = $srowcnvrsn_mst['cnvrsnm_name'];	
			$cnvrval = $srowcnvrsn_mst['cnvrsnm_val'];
			$cnvrid = $srowcnvrsn_mst['cnvrsnm_id'];	
			$_SESSION['sescnvr_chrg'] = $cnvrval;
			$_SESSION['sescrncy'] = $cnvrnm;
			$_SESSION['sescnvr_id'] = $cnvrid;
			$to     =  $srowcnvrsn_mst['cnvrsnm_name'];
			
		}
		$url 	= 'http://www.finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, '$url');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
 
    	$handle = curl_exec($ch);	
		curl_close($ch);
		$handle = fopen($url, 'r');
		if ($handle) {
			$result = fgets($handle, 4096);
			fclose($handle);
			$allData = explode(',',$result);  //Get all the contents to an array 
			$_SESSION['sescnvtrval'] = $allData[1];								
		}
	}
	
	/*
	if(isset($_POST['lstcrncy']) && (trim($_POST['lstcrncy']) != "")){
		$_SESSION['sescnvr_id'] = $_POST['lstcrncy'];				
		$from   = 'INR'; 
		//$to     = funcCrncyNm($_SESSION['sescrncy']);	
		$sqrycnvrsn_mst = "select 
								cnvrsnm_id,cnvrsnm_name,cnvrsnm_val
							from
								cnvrsn_mst
							where
								cnvrsnm_sts='a' and
							cnvrsnm_id = '$_POST[lstcrncy]'";
		 $srscnvrsn_mst = mysqli_query($conn,$sqrycnvrsn_mst);
		 $cntcnvrsn_mst = mysqli_num_rows($srscnvrsn_mst);
		 if($cntcnvrsn_mst > 0){
		 	$srowcnvrsn_mst = mysqli_fetch_assoc($srscnvrsn_mst);
			$cnvrnm = $srowcnvrsn_mst['cnvrsnm_name'];	
			$cnvrval = $srowcnvrsn_mst['cnvrsnm_val'];
			$cnvrid = $srowcnvrsn_mst['cnvrsnm_id'];	
			$_SESSION['sescnvr_chrg'] = $cnvrval;
			$_SESSION['sescrncy'] = $cnvrnm;
			$_SESSION['sescnvr_id'] = $cnvrid;
			$_SESSION['sescnvtrval'] = 1;
			
		}
	}*/
	
	/*if(!isset($_SESSION['lstcnvr']) || (trim($_SESSION['lstcnvr']) == "") || 
	   !isset($_SESSION['sescnvtrval']) || (trim($_SESSION['sescnvtrval']) == "")){	   
		//$_SESSION['sescrncy'] = 1;
		$_SESSION['sescnvtrval'] = 1;		
	}
	else if(isset($_REQUEST['lstcnvr']) && (trim($_REQUEST['lstcnvr']) != "")){
	//if(isset($_REQUEST['lstcnvr']) && (trim($_REQUEST['lstcnvr']) != "")){
		$_SESSION['sescnvr_id'] = $_REQUEST['lstcnvr'];				
		
		if($_SESSION['sescnvr_id'] == '1'){
			$_SESSION['sescnvtrval'] = '1';
		}
		elseif($_SESSION['sescnvr_id'] == '2'){
			$_SESSION['sescnvtrval'] = '0.016';
		}
		elseif($_SESSION['sescnvr_id'] == '3'){
			$_SESSION['sescnvtrval'] = '0.012';
		}
		elseif($_SESSION['sescnvr_id'] == '4'){
			$_SESSION['sescnvtrval'] = '0.011';
		}
	}	*/
?>
