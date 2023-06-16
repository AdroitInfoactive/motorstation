<?php
	//Function for checking the valid values
	function glb_func_chkvl($cntrlval){
		$crntval = $cntrlval;
		$newval =  htmlspecialchars(trim($cntrlval),ENT_QUOTES);
		return $newval;		
	}

	function funcUpdtRecSts($conn,$tblnm,$idfldnm,$idval,$ufldnm,$curval){
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value
		$updtfldnm  = $ufldnm; // Stores the update field name
		$curfldval	= $curval; // Stores the current field value
		$updtval 	= "";
		
		if($curfldval == 'a'){
			$updtval = 'i';
		}
		elseif($curfldval == 'i'){
			$updtval = 'a';
		}
		elseif($curfldval == 'd'){
			$updtval = 'd';
		}				
		$funcuqry = "UPDATE $tblname
				 	 set $updtfldnm = '$updtval'
				 	 where $idfldname = $recid";
					 
		$srs_funcqry = mysqli_query($conn,$funcuqry);	
		if($srs_funcqry == true){
			return  "y";
		}
		else{
			return "n";
		}		
		$funcuqry = "";
	}
	function funcDelRec($conn,$tblnm,$idfldnm,$idval){
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value		
		$funcdqry = "delete from $tblname
				 	 where $idfldname = $recid";
		if(mysqli_query($conn,$funcdqry)){
			return  "y";
		}
		else{
			return "n";
		}	
		$funcdqry = "";
	}	
	// function funcUpdtAllRecSts($conn,$tblnm,$idfldnm,$idval,$ufldnm)
	// {
	// 	$tblname 	= $tblnm;    // Stores the table name
	// 	$idfldname  = $idfldnm;  //Stores the id field name
	// 	$recid	 	= $idval;    // Stores the id value
	// 	$updtfldnm  = $ufldnm;   // Stores the update field name
	// 	$updtval 	= "";
			
	// 	$funcuqry = "UPDATE $tblname
	// 			 	 	  set 
	// 				      $updtfldnm =if($updtfldnm='a','i','a') 
	// 			 	      where $idfldname in($recid)";		
	// 	if(mysqli_query($conn,$funcuqry))
	// 	{
	// 		return  "y";
	// 	}
	// 	else
	// 	{
	// 		return "n";
	// 	}		
	// 	$funcuqry = "";
	// }
	function funcUpdtAllRecSts($conn,$tblnm,$idfldnm,$idval,$ufldnm,$chkval)
	{	
		$tblname 	= $tblnm;    // Stores the table name
		$idfldname  = $idfldnm;  //Stores the id field name
		$recid	 	= $idval;    // Stores the id value
		$updtfldnm  = $ufldnm;   // Stores the update field name
		$updtchkval = $chkval;   //Chkbox Value
		$updtval 	= "";		
		$funcuqry = "update $tblname set";
		
		if($updtchkval =='n'){
			$funcuqry .= " $updtfldnm='i'";
		}
		elseif($updtchkval =='y'){
			$funcuqry .= " $updtfldnm='a'";
		}		
		if($updtchkval == ''){	
		$funcuqry .= " $updtfldnm =if($updtfldnm='a','i','a') 
				 	      where $idfldname in($recid)";		
								
							
		}
		if(mysqli_query($conn,$funcuqry)){
			return  "y";
		}
		else{
			return "n";
		}		
		$funcuqry = "";
	}
	function funcDelAllRec($conn,$tblnm,$idfldnm,$idval)
	{
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value		
		$funcdqry = "DELETE from $tblname
				 	 where $idfldname in($recid)";		
		if(mysqli_query($conn,$funcdqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}	
		$funcdqry = "";
	}	
	function funcRmvFle($conn,$tblnm,$updtfldnm,$updtfldval,$idfldnm,$idval)
	{
		$tblname 	 = $tblnm; // Stores the table name
		$ufldname 	 = $updtfldnm; //Stores the update field name
		$ufldval  	 = $updtfldval; //Stores the update field name
		$idfldname   = $idfldnm; //Stores the id field name
		$recid	 	 = $idval; // Stores the id value
				
		$funcuqry = "update $tblnm
					 set $ufldname = '$ufldval'
					 where $idfldnm = '$recid'";	
					 					 
		if(mysqli_query($conn,$funcuqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}	
		$funcuqry = "";
	}
	
	/***************************************************/
	/********Function for displaying the status*********/
	/***************************************************/
	
	function funcDispSts($cursts)
	{			
		$recsts = $cursts;		
		if($recsts == 'a')
		{
			return 'Active';			
		}
		elseif($recsts == 'i')
		{
			return 'Inactive';			
		}
		elseif($recsts == 'u')
		{
			return 'Under Process';			
		}
		elseif($recsts == 'c')
		{
			return 'Completed';			
		}		
	}	
	
	/******************************************************/	
	
	/***************************************************/
	/********Function for displaying the current********/
	/***************************************************/
	
	function funcDispCrnt($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'y')
		{
			return 'Yes';
		}
		elseif($recsts == 'n')
		{
			return 'No';
		}
		elseif($recsts == 'c')
		{
			return 'Check before Dispatch';
		}
	}		
	function funcDispPos($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'l')
		{
			return 'Left';
		}
		elseif($recsts == 'r')
		{
			return 'Right';
		}
		elseif($recsts == 'c')
		{
			return 'Center';
		}
	}	
	function funcXpryTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'General';
		}
		elseif($recsts == '2')
		{
			return 'Stock Last';
		}
		elseif($recsts == '3')
		{
			return 'Date';
		}
	}
	function funcOfrFor($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'All';
		}
		elseif($recsts == '2')
		{
			return 'Specific';
		}
	}
	function funcUsrInpt($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Yes';
		}
		elseif($recsts == '0')
		{
			return 'No';
		}
	}
	
	function funcDiscTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Amount';
		}
		elseif($recsts == '2')
		{
			return 'Percentage';
		}
	}	
	function funcConDiscTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'a')
		{
			return 'Amount';
		}
		elseif($recsts == 'd')
		{
			return 'Discount';
		}
	}	
	function funcAplTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Cart';
		}
		elseif($recsts == '2')
		{
			return 'Customer Account';
		}
	}	
	
	function funcMbrTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'All';
		}
		elseif($recsts == '2')
		{
			return 'New';
		}
		elseif($recsts == '3')
		{
			return 'Old';
		}
	}
		
	function funcCmpnTyp($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'General';
		}
		elseif($recsts == '2')
		{
			return 'Exclusive';
		}
	}

	function funcCrtSts($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'r')
		{
			return 'Received';
		}
		elseif($recsts == 'u')
		{
			return 'Under Process';
		}
		elseif($recsts == 'c')
		{
			return 'Completed';
		}
		elseif($recsts == 'q')
		{
			return 'Return';
		}	
		elseif($recsts == 'l')
		{
			return 'Canceled';
		}	
		elseif($recsts == 't')
		{
			return 'Return Update';
		}	
		elseif($recsts == 'd')
		{
			return 'Dispatched';
		}	
	}
	
	function funcRtnForSts($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'r')
		{
			return 'Return';
		}
		elseif($recsts == 'e')
		{
			return 'Exchange';
		}
	}	
	
	function funcRtnRsn($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Too Big';
		}
		elseif($recsts == '2')
		{
			return 'Too Short';
		}
		elseif($recsts == '3')
		{
			return 'Too Long';
		}
		elseif($recsts == '4')
		{
			return 'Poor Quality';
		}
		elseif($recsts == '5')
		{
			return 'Arrive Late';
		}
		elseif($recsts == '6')
		{
			return 'Not As Expected';
		}
		elseif($recsts == '7')
		{
			return 'Unwanted Gift';
		}
		elseif($recsts == '8')
		{
			return 'Item Faulty';
		}
		elseif($recsts == '9')
		{
			return 'Style Doesn\'t Suit';
		}		
	}
	
	function funcPayMod($cursts)
	{
		if($cursts == 'c')
		{
			return 'Credit Card';		
		}
		elseif($cursts == 'g')
		{
			return 'Gift Voucher';		
		}
		elseif($cursts == 'x')
		{
			return 'Xl Credit';		
		}
	}
	function funcXlCrdtTyp($cursts)
	{
		if($cursts == 's')
		{
			return 'SHOPPING';
		}
		elseif($cursts == 'c')
		{
			return 'COUPOUN';
		}		
	}
	function funcAvlTyp($cursts)
	{
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Mass';
		}
		elseif($recsts == '2')
		{
			return 'Specific';
		}	
	}
	function functyrpstn($cursts)
	{
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Front Tyre';
		}
		elseif($recsts == '2')
		{
			return 'Back Tyre';
		}	
	}
	function functyrTyp($cursts)
	{
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Tube Less';
		}
		elseif($recsts == '2')
		{
			return 'Tube';
		}	
	}
	function funcDsplyTyp($cursts){
		if($cursts == '1'){
			return 'General';
		}
		elseif($cursts == '2'){
			return 'New Arrivals';
		}
		elseif($cursts == '3'){
			return 'Best Sellers';
		}
		elseif($cursts == '4'){
			return 'New Arrivals & Best Sellers';
		}
		elseif($cursts == '5'){
			return 'All';
		}	
	}

	function funcStrRplc($prmstr)
{
	$gnrtstr = strtolower(str_replace(' ', '-', $prmstr));
	$gnrtstr = strtolower(str_replace('.', '-', $gnrtstr));
	$gnrtstr = strtolower(str_replace(':', '-', $gnrtstr));
	$gnrtstr = strtolower(str_replace(',', '-', $gnrtstr));
	return $gnrtstr;
}
function funcStrUnRplc($prmstr)
{
	$gnrtstr = ucwords(str_replace('-', ' ', $prmstr));
	return $gnrtstr;
}
?>