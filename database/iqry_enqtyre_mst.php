<?php	
error_reporting(0);
	include_once 'includes/inc_nocache.php'; // Clearing the cache information
	//include_once 'includes/inc_usr_functions.php';//Use function for validation and more
	include_once "includes/inc_connection.php";  
	include_once 'includes/inc_config.php'; 
	if(isset($_POST['btnsertyre']) && ($_POST['btnsertyre'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['txtemailid']) && ($_POST['txtemailid']) != ""){
		$name     = glb_func_chkvl($_POST['txtname']);
		$email     = glb_func_chkvl($_POST['txtemailid']);
		$phone    = glb_func_chkvl($_POST['txtphone']);
		$vehicle    =  $_POST['txtvehicle'];
		$veh_tyre      =  glb_func_chkvl($_POST['lstvchltyp']);
		$service = implode(',', $_POST['srvctyp']);
		$srvctyp = explode(",",$service);
		if($srvctyp[0] !=''){
			$dspval ="3D Alignment And checking";
		}
		if($srvctyp[1] !=''){
			$dspval .="<br/>Wheel Balancing";
		}
		if($srvctyp[2] !=''){
			$dspval .="<br/>Car Wash";
		}
		if($srvctyp[3] !=''){
			$dspval .="<br/>Nitrogen Air";
		}
		if($srvctyp[4] !=''){
			$dspval .="<br/>General Service";
		}
		if($srvctyp[5] !=''){
			$dspval .="<br/>Personalised Services";
		}
		if($srvctyp[6] !=''){
			$dspval .="<br/>General Check-Up";
		}
	

		$curdt    =  date('Y-m-d h:i:s');
		$dsptyp = 'No';
			if($veh_tyre == 'y'){
				$dsptyp = 'Yes';
			}
		$iqryenq_mst="INSERT into gnrlenqry_mst( gnrlenqrym_emailid,gnrlenqrym_name,gnrlenqrym_phno,gnrlenqrym_vchl,
	 gnrlenqrym_typ,gnrlenqrym_srvs,gnrlenqrym_addr,gnrlenqrym_prty,gnrlenqrym_sts,gnrlenqrym_crtdon,gnrlenqrym_crtdby)values(
						  '$email','$name','$phone','$vehicle',
						  '$veh_tyre','$service','',1,'a','$curdt','$email')";
			$irsenq_mst = mysqli_query($conn,$iqryenq_mst);
			if($irsenq_mst==true)
			{
				
				$message = "<table width='60%' border='0' align='center' cellpadding='3' cellspacing='2'>
								<tr>	
								<td colspan='3' align='center'><h1>Motorstation  - General Enquiry Form</h1></td>
								</tr>	
								<tr>	
								<td  bgcolor='#F0F0F0'>Name*</td>
								<td  bgcolor='#F0F0F0'>:</td>				
								<td  bgcolor='#F0F0F0'>".$name."</td>
								</tr>				  	
								<tr>
								<td bgcolor='#F5F5F5'>Email*</td>
								<td bgcolor='#F5F5F5'>:</td>
								<td bgcolor='#F5F5F5'>".$email."</td>
								</tr>	
								<tr>
								<td bgcolor='#F0F0F0'>Phone*</td>
								<td bgcolor='#F0F0F0'>:</td>						
								<td bgcolor='#F0F0F0'>".$phone."</td>
								</tr>
								<tr>
								<td bgcolor='#F0F0F0'>Vehicle Name*</td>
								<td bgcolor='#F0F0F0'>&nbsp;</td>
								<td bgcolor='#F0F0F0'>".$vehicle."</td>
								</tr>
								<tr>
								<td bgcolor='#F0F0F0'>Tyre Requirement*</td>
								<td bgcolor='#F0F0F0'>&nbsp;</td>
								<td bgcolor='#F0F0F0'>$dsptyp</td>
								</tr>
								<tr>
								<td bgcolor='#F0F0F0'>Services</td>
								<td bgcolor='#F0F0F0'>&nbsp;</td>
								<td bgcolor='#F0F0F0'>$dspval</td>
								</tr>	
								</table>";
								//echo $message;exit;
								$u_prjct_email_info='motorstation81@yahoo.in';
							$fromemail = $u_prjct_email_info;
							$to = $u_prjct_email_info;
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= "From: $fromemail" . "\r\n";
							$subject = "General Enquiry Form";
							if (mail($to, $subject, $message, $headers))
							{
								?>
						
								<script>
								location.href='thankyou.php';
							</script>
							
							<?php
							}
							else
							{
								?>
						
								<script>
								location.href='error.php';
							</script>
							
							<?php
							}
							$gmsg = "Record saved successfully";
							}
			
			}
			else{
				$gmsg = "Record not saved";
			}
		
	
?>
