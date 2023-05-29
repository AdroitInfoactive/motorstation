<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more	
	include_once "../includes/inc_paging_functions.php";//Making paging validation
	include_once  "../includes/inc_config.php";		
	/**********************************************************
	Programm 	  : order_detail.php	
	Company 	  : Adroit
	************************************************************/
	global $msg,$loc,$disppg,$dispmsg;
	global $gdispallshp,$gselcrncynm,$gselshpchrg,$gselshpchrgdesc,$ggrscartprc,$gnetcartprc;

	if(isset($_REQUEST['oid']) && (trim($_REQUEST['oid']) != "")){
		$cid = addslashes(trim($_REQUEST['oid']));
		$loc 		= "";
		$txtsrchnm  = "";
		$lstprodid	= "";
		$txtemailid = "";
		$txtphno 	= "";
		$txtfrmdt 	= "";
		$txttodt	= "";
		if(isset($_REQUEST['txtsrchnm']) && (trim($_REQUEST['txtsrchnm'])!="")){
			$txtsrchnm  = glb_func_chkvl($_REQUEST['txtsrchnm']);
			$loc .= "&txtsrchnm=$txtsrchnm";
		}
		if(isset($_REQUEST['lstprodid']) && (trim($_REQUEST['lstprodid'])!="")){
			$lstprodid = glb_func_chkvl($_REQUEST['lstprodid']);
			$loc .= "&lstprodid=$lstprodid";
		}
		if(isset($_REQUEST['txtemailid']) && (trim($_REQUEST['txtemailid'])!="")){
			$txtemailid = glb_func_chkvl($_REQUEST['txtemailid']);
			$loc .= "&txtemailid=$txtemailid";
		}
		if(isset($_REQUEST['txtphno']) && (trim($_REQUEST['txtphno'])!="")){
			$txtphno	= glb_func_chkvl($_REQUEST['txtphno']);	 
			$loc .= "&txtphno=$txtphno";		
		}
		if(isset($_REQUEST['txtfrmdt']) && trim($_REQUEST['txtfrmdt']) != ''){
			$txtfrmdt	= glb_func_chkvl($_REQUEST['txtfrmdt']);
			$loc .= "&txtfrmdt=$txtfrmdt";		
		}
		if(isset($_REQUEST['txttodt']) && trim($_REQUEST['txttodt']) != ''){
			$txttodt	= glb_func_chkvl($_REQUEST['txttodt']);
			$loc .= "&txttodt=$txttodt";		
		}
		if(isset($_REQUEST['chkexact']) && trim($_REQUEST['chkexact']) != ''){					
			$chkexact  		=  glb_func_chkvl($_REQUEST['chkexact']); 		
			$loc .= "&chkexact=$chkexact";
		}		
		$sqrycrtord_mst	= "select 								
								crtordm_id,crtordm_name,crtordm_adrs,crtordm_phno,
								crtordm_email,crtordm_cmpnynm,crtordm_dsgn,crtordm_fxno,						
								crtordm_zpcode,crtordm_orgqtn,crtordm_qry,
								date_format(crtordm_crtdon,'%d-%m-%Y') as crtordm_crtdon_dt,
								date_format(crtordm_crtdon,'%h:%i:%s') as crtordm_crtdon_tm,
						   		cntrym_name,cntym_name,ctym_name
						   from 
								crtord_mst  
								inner join vw_cntnt_cntry_cnty_cty_mst on ctym_id = crtordm_ctym_id								
						   where
								crtordm_id='$cid'";
		$srscrtord_mst = mysqli_query($conn,$sqrycrtord_mst);
		$cntrec		   = mysqli_num_rows($srscrtord_mst);
		if($cntrec > 0){
			$srowcrtord_mst=mysqli_fetch_array($srscrtord_mst);							
		}
		else{
			header('location:vw_all_orders.php');
			exit();
		}
	}	
	else{
		header('location:vw_all_orders.php');
		exit();
	}
	if(isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "")){
		$pg = trim($_REQUEST['pg']);	
	}
	else{
		$pg = 1;
	}
	if(isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")){
		$cntstart = trim($_REQUEST['countstart']);	
	}	
	else{
		$cntstart = 1;
	}		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
<?php include_once ('script.php');?>
<script language="javascript">
	<!--
	function funcSbmtShp(x){
		pg = <?php echo $pg;?>;
		cntstart = <?php echo $cntstart;?>;			
		document.frmsplradd.action ="order_detail.php?oid=<?php echo $cid;?>&pg="+pg+"&countstart="+cntstart;
		document.frmsplradd.submit();
	}		
	function submitForm(){     
	   var r = confirm('Are You Sure you want to Delete?'); 	
	   if(r == true){
		 location.href = "order_detail.php?hdnord=<?php echo $cid;?>&rqsttyp=d";
	   }   
	}	
	function open_win(prod_code){
		if(prod_code != ''){
			lnkname = "order_product_photo.php?prod_code_val="+prod_code; 
			window.open(lnkname,'welcome','width=800,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');
		}
   	}	
	/*function funcOrdSts(){
		document.getElementById('frmsplradd').action = "update_order_status.php";
		document.getElementById('frmsplradd').submit();			
	}		
	function funcEdtFrm(){
		document.getElementById('frmsplradd').action = "edit_order_detail.php";
		document.getElementById('frmsplradd').submit();			
	}*/
	
	function funcBck(val)
	{			
		var pg,cntstart;
		pg = <?php echo $pg;?>;
		cntstart = <?php echo $cntstart;?>;		
		//location.href = "view_all_orders.php?oid="+val+"&pg="+pg+"&countstart="+cntstart;
		//history.back();
	}	
				
	-->
 	</script>
</head>
<body>
<?php 
	 include_once ('../includes/inc_adm_header.php');
	 include_once ('../includes/inc_adm_leftlinks.php'); 
?>
<table width="1000px" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr valign="top"> 
	<td height="400" valign="top"><br>
            <form  method="post" enctype="multipart/form-data" name="frmsplradd" id="frmsplradd">			
			<input type="hidden" name="hdnord" id="hdnord" value="<?php echo $cid;?>">
			<input type="hidden" name="hdnordcode" id="hdnordcode" value="<?php echo $srowcrtord_mst['crtordm_code'];?>">									
             <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
				<tr align="left" class='white'>
				  <td bgcolor="#FF543A" height="26" colspan="6">
					<span class="heading"><strong>:: ENQUIRY DETAIL </strong></span>&nbsp;&nbsp;&nbsp;
					  </td>
				  </tr>		
				  <tr>
						<td width="15%" align="left" ><strong>ENQUIRY NO</strong></td>
						<td width="2%" align="left" ><strong>:</strong></td>
						<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_id'];?></td>
						<td width="15%"  align="left" ><strong> DATE &amp; TIME</strong></td>
						<td width="2%" align="left" ><strong>:</strong></td>
						<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_crtdon_dt'];?> <?php echo $srowcrtord_mst['crtordm_crtdon_tm'];?></td>
				  </tr>	
				  <tr >
					<td width="15%" align="left"><strong>NAME</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left"><?php echo $srowcrtord_mst['crtordm_name'];?></td>
				     <td width="15%" align="left" ><strong>EMAIL ID</strong></td>
					 <td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_email'];?></td>
				  </tr>	  			  		  
				  <tr>
					<td width="15%" align="left" ><strong>COMPANY</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_cmpnynm'];?></td>		 
					<td width="15%" align="left" ><strong>DESIGNATION</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_dsgn'];?></td>
				  </tr>			
				  <tr>
					<td width="15%" align="left" ><strong>CONTACT NO</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_phno'];?></td>		 
					<td width="15%" align="left" ><strong>FAX NO</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_fxno'];?></td>
				  </tr>		
<?php /*?> <tr>
					<td width="15%" align="left" ><strong>PRICE REQUEST</strong></td>
					<td width="2%" align="left" ><strong>:</strong></td>
					<td width="33%" align="left" ><?php echo $srowcrtord_mst['crtordm_orgqtn'];?></td>		 
					<td width="15%" align="left"  colspan="3"></td>
				  </tr>	<?php */?>                  			  
				  <tr>
					<td width="15%" align="left" ><strong>CUSTOMER MESSAGE</strong></td>
					<td width="5%" align="left" ><strong>:</strong></td>				  
					<td align="left"  colspan="4"><?php echo $srowcrtord_mst['crtordm_qry'];?></td>
				  </tr>
			  <tr >
				<td colspan="6">
					<table width="100%" border="0">
						<tr>
							<td height="150px"> 
							   <table width="100%" border="0" cellpadding="3" cellspacing="1" >					
                                <tr class='white'>
                                  <td bgcolor="#FF543A" colspan="6"><strong>ADDRESS</strong></td>
                                </tr>
                                <tr >			  
                                  <td>Address</td>
                                  <td>:</td>                                      
                                  <td align="left"><?php echo $srowcrtord_mst['crtordm_adrs'];?></td>
                              	</tr>
                                <tr>
                                  <td width="25%">City</td>
                                  <td width="5%">:</td>                                    
                                  <td  width="70%"><?php echo $srowcrtord_mst['ctym_name'];?></td>
                                </tr>
                                <tr>
                                  <td>County</td>
                                  <td>:</td>
                                  <td><?php echo $srowcrtord_mst['cntym_name'];?></td>
                                </tr>
								 <tr>
                                  <td>Country</td>
                                  <td>:</td>
                                  <td><?php echo $srowcrtord_mst['cntrym_name'];?></td>
                                </tr>
                                <tr>
                                  <td>Zip Code</td>
                                  <td>:</td>
                                  <td><?php echo $srowcrtord_mst['crtordm_zpcode'];?></td>
                                </tr>                                    
                                    <?php
									
									/*
                                    <tr>
									  <td> <?php echo $srowcrtord_mst['bctynm'];?></td>
									  <td><font color='red'><?php if($srowcrtord_mst['bctysts'] =='u'){echo funcDispSts($srowcrtord_mst['bctysts']);}?></font></td>
									</tr>
									<tr>
									  <td><?php echo $srowcrtord_mst['bcntynm'];?></td>
									  <td><font color='red'><?php if($srowcrtord_mst['bcntysts'] =='u'){ echo funcDispSts($srowcrtord_mst['bcntysts']);}?></font></td>
									</tr>
									<tr>
									  <td><?php echo $srowcrtord_mst['bcntrynm'];?></td>
									</tr>
									<tr>
									  <td><?php echo $srowcrtord_mst['bcntntm_name'];?></td>
									</tr>
									<tr>
									  <td><?php echo $srowcrtord_mst['crtordm_bzip'];?></td>
									</tr>
									<tr>
									  <td>Phone No :<?php echo $srowcrtord_mst['crtordm_bdayphone'];?></td>
									</tr>									
									*/
									?>
									
                                    
							  </table>			  		
						  </td>										  	  
		  	    		</tr>
				  </table>	
				</td>
			  </tr>
			  <tr class='white' bgcolor="#FF543A">	
				<td colspan="6"><strong> Enquiry DETAIL </strong></td>
			  </tr>
			  <tr >
			  		<td colspan="6">
						<table width="100%" border="0" cellpadding="3" cellspacing="1" >
							<tr >
								<td width="6%"><strong>Sl No.</strong></td>
							  	<td width="20%"><strong>Product Code </strong></td>								
								<td width="34%"><strong>Product Name</strong></td>
                                <?php /*
								<td width="10%" align="center"><strong>Unit Price</strong></td>					
								
					          	<td width="10%" align="center"><strong>Qty</strong></td>
								<td width="10%" align="center"><strong>Total Price</strong></td>
								*/
								?>													
					      	</tr>		
						  <?php
						  	//$pototqty  = $srowcrtord_mst['crtordm_qty'];
							//$pototprc  = $srowcrtord_mst['crtordm_amt'];	
							$sqrycrtord_dtl =	"select 
													crtordd_id,prodm_id,prodm_code,prodm_name,
													crtordd_qty,crtordd_prc
												 from 
													 crtord_dtl 
												 inner join 
													 (prod_mst)
												 on 
													crtordd_prodm_id=prodm_id 
												where 
													crtordd_crtordm_id=$cid";
																										
							$srscrtord_dtl = mysqli_query($conn,$sqrycrtord_dtl);
							$cnttorec      = mysqli_num_rows($srscrtord_dtl);
							$totqty		   = "";
							$totlprc	   = "";							
							$cntord		   = 0;						 
							if($cnttorec > 0){						
								while($rowspo_mst=mysqli_fetch_assoc($srscrtord_dtl)){
									 $cntord += 1; 
									 //$db_qty = 	$rowspo_mst['crtordd_qty'];
									 //$db_prc = 	$rowspo_mst['crtordd_prc'];								
									 //$totprc = ($db_qty * $db_prc); 						
							  ?>
                              <tr>
                                <td align="left" ><?php echo $cntord;?></td>
                                <td align="left" >
                                    <a href="#" onClick="open_win(<?php echo $rowspo_mst['prodm_id'];?>)" class="leftlinks">
                                        <?php echo $rowspo_mst['prodm_code'];?>
                                    </a>
                                </td>
                                <td align="left" ><?php echo $rowspo_mst['prodm_name'];?></td>                                
                              </tr>
							  <?php					
									}
								}	
/*		
<td align="right" ><?php echo $db_prc;?></td>
                                <td align="center" >
                                    <?php 
                                        echo $db_qty;
                                        $totqty	=	$totqty + $db_qty;
                                    ?>											
                                </td>
                                <td align="right" >
                                    <?php 
                                        echo number_format($totprc,2,".",",");
                                        $totlprc = $totlprc+$totprc;
                                    ?>											
                                </td>
						if($srowcrtord_mst['crtordm_cpnm_typ'] == "d"){
									$discamt 	 = $totlprc * ($srowcrtord_mst['crtordm_cpnm_val']/100);
									$gtotdiscamt = $discamt; 															
								}
								else{
									$discamt = $srowcrtord_mst['crtordm_cpnm_val'];
									$gtotdiscamt = $discamt; 
								}	
								$totlprc -= $gtotdiscamt;	*/				
						   	 ?>
			   			 <?php
						 /*
                         <tr>
							<td colspan="2"></td>
							<td><b>TOTAL QUANTITY : <?php echo $totqty;?></b></td>
							<td colspan="3" align="right">
								<?php
								/*								
									<b>SHIPPING CHARGES : <?php echo $shpprc;?></b><br>
									<b>DISCOUNT  AMOUNT : <?php echo $gtotdiscamt;?><br>
								   <strong>TOTAL PRICE : <?php echo number_format($totlprc+$shpprc,2,'.',',');?>								</strong></b>							</td>								   
						</tr>*/
                        ?>
					  </table>				   
                  </td>
			  </tr>				 
			  <tr>
			    <td colspan="6" align="right" >&nbsp;&nbsp;
					<input type="button" name="btnbck" id="btnbck" value="BACK" onClick="location.href='vw_all_orders.php?oid=<?php echo $id;?><?php echo $loc;?>'" class="updates_button" >				
				</td>
			  </tr>				   
            </table>
            </FORM><br>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>