<?php	
	include_once "includes/inc_usr_functions.php";//Including user session value		  	
	if(isset($_POST['txtemail']) && (trim($_POST['txtemail']) != "") && 	
	   isset($_POST['txtpwd']) && (trim($_POST['txtpwd']) != "") &&
	   isset($_POST['txtcpwd']) && (trim($_POST['txtcpwd']) != "") && 
	   (trim($_POST['txtpwd']) == trim($_POST['txtcpwd']))){			   
		$email     	  = glb_func_chkvl($_POST['txtemail']);
		if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
/*	 if(isset($_POST['btnsbmtvl']) && (trim($_POST['btnsbmtvl']) != "") &&
	   isset($_SESSION['sesemlid']) && (trim($_SESSION['sesemlid']) != "") && 
	   isset($_SESSION['sespwdvl']) && (trim($_SESSION['sespwdvl']) != "") &&
	   isset($_SESSION['sescnpwdvl']) && (trim($_SESSION['sescnpwdvl']) != "") && 
	   (trim($_SESSION['sespwdvl']) == trim($_SESSION['sescnpwdvl']))){		
		$email     	  = glb_func_chkvl($_SESSION['sesemlid']);
		if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){	*/
			$ipadrs		  = $_SERVER['REMOTE_ADDR'];
			$pwd      	  = md5($_SESSION['sespwdvl']);
			$dt        	  = date('Y-m-d h:i:s');
			$sts       	  = 'a';
	
			$sqrymbr_mst = "select 
								mbrm_emailid
						     from 
								mbr_mst
						     where  
						   		mbrm_emailid = '$email'";
			$srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
			$cntmbr_mst = mysqli_num_rows($srsmbr_mst);
			
			if($cntmbr_mst > 0){
				$greg_msg = "Duplicate email id, account not created";
			}
			else{
			 	$iqrymbr_mst="insert into mbr_mst(
							  mbrm_emailid,mbrm_pwd,mbrm_ipadrs,mbrm_rgsttyp,
							  mbrm_sts,mbrm_crtdon,mbrm_crtdby)values(
							  '$email','$pwd','$ipadrs','s',
							  '$sts','$dt','$email')";						 
				$irsmbr_mst = mysqli_query($conn,$iqrymbr_mst);				
				if($irsmbr_mst==true){				
					$filepath =  explode("register.php",$_SERVER['PHP_SELF']);  //Stores the file path
					$hdimg    = $u_prjct_dspmnurl.$site_logo;//Return the URL
					
					$subject = "Account Information from $usr_cmpny";
					$body ="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
								<html>
								<head>
								<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
								<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
								<title>$usr_cmpny | Order Information</title>
								<style type='text/css'>
								#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}
								</style>
								</head>
								<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
								<div style='background-color:#fff;'><table width='600'  border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
						<td colspan='2'>
						<a href='$u_prjct_dspmnurl'><img src='$hdimg' alt='$usr_cmpny'  border='0'></a>
						</td>
						
					  </tr>
					</table>
					<table width='600'  border='0' align='center' cellpadding='6' cellspacing='0'>
					  <tr>
						<td><p>
							Dear $email,<br/><br/>

Welcome to Gitsngreets.com; <span style='font-family:Bradley Hand ITC,Arial; font-style:italic'>Gift Wrapped Emotions. </span>.<br/><br/>

Your personal account details are:<br/>
Login ID: $email<br/>
Password: $_SESSION[sespwdvl]<br/><br/>

Please keep this email safely as it contains your login credentials; using which you shop at Gitsngreets.com for an effortless shopping experience.<br/><br/>

With your account, you can now make the best of various services we have to offer you.  Some of the services include:<br/><br/>

-> Wish List <br/>
-> View Old Orders<br/>
-> Reward Loyalty Program <br/>
-> Midnight Delivery <br/>
-> Same Day Delivery <br/>
-> Set up personal Gifts/Events calender (upcoming)<br/>
-> Set up reminders for personal occasions (upcoming)<br/>
-> Send personalized Video Greetings (Upcoming)<br/>
-> International deliveries (upcoming)<br/><br/><br/>
							
							
							For help with any of our online services, please call at  +91 91 33 33 44 44 <b>(Between 8:00 am to 20:00 pm IST; Monday to Saturday)</b> or you can email us at core@giftsngreets.com.<br/><br/>
							Please click here to Chat Live <b>(Between 8:00 am to 20:00 pm IST; Monday to Saturday)</b> with our web agent.<br/><br/><br/><br/>
							We look forward to serve you again. <br/>
							Happy Gifting!<br/>
							$usr_cmpny

						</p>
						  </td>
					  </tr>
					</table>
					
					<table width='600'  border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
						<td height='1' bgcolor='#CCCCCC'></td>
					  </tr>
					  <tr>
						<td align='right'>&nbsp;</td>
					  </tr>
					</table>
					</div>
					</body></html>";

		$to  = $fromemail;
		$fromemail = $u_prjct_rgstrnemail;			
		$headers 	 = 'MIME-Version: 1.0' . "\r\n";
		$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers 	.= "From: $fromemail" . "\r\n";
		//$headers 	.= "Cc: $email" . "\r\n";												

		mail($to,$subject,$body,$headers);
		
					$id = mysql_insert_id();
					//session_register("sesmbremail");
					//session_register("sesmbrid");					
					$_SESSION['sesmbremail']   = $email;//assing value of user id to admin session
					$_SESSION['sesmbrid']      = $id;//assing value of user id to admin session										
				
					if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != "")){
						header("Location: ".$rtpth."add-profile");
					}
					elseif(isset($_SESSION['pgname']) && ($_SESSION['pgname'] == "y") )
					{
						$_SESSION['sesmbrmenu'] = "wshlst";
						?>
							<script type="text/javascript">
							location.href = "<?php echo $rtpth;?>wishlist";
							</script>
						<?php
								exit();	
					}			
					else
					{
					?>
						<script language="javascript" type="text/javascript">
						alert("Congratulations \n Your account has been created successfully");
						location.href = "<?php echo $rtpth.'add-profile'?>";
						</script>						
					<?php					
					}
					exit();								
					$greg_msg = "Congratulations <br> Your account has been created successfully";
				}
				else
				{
					$greg_msg = "Your account hasn't been created";
				}
			}
		}
		else
		{
			$greg_msg =  "Invalid email id. Record not saved";
		}
	}
?>