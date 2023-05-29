<?php	
	include_once "includes/inc_connection.php";   //Making database Connection
	include_once "includes/inc_usr_functions.php";
	include_once "includes/inc_config.php";
		
	if(isset($_POST['btnsubmit']) && (trim($_POST['btnsubmit'])!="") && 
       isset($_POST['txtlftname']) && (trim($_POST['txtlftname']) != "")   && 
       isset($_POST['txtlftemail']) && (trim($_POST['txtlftemail']) != "")){
		$lftemail     	  = glb_func_chkvl($_POST['txtlftemail']);
		if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $lftemail)){	
		 	$lftname	= glb_func_chkvl($_POST['txtlftname']);
			$lftprior	= "1";
			$lftsts		= "i";
			$lftdt		= date('Y-m-d h:i:s');			 	 
			 $sqrynwsltr_dtl	= "select 
									nwsltrd_emailid
								from
									nwsltr_dtl
								where
									nwsltrd_emailid='$lftemail' ";
			$srsnwsltr_dtl  = mysqli_query($conn,$sqrynwsltr_dtl);
		   $cnt_nwsltrd = mysqli_num_rows($srsnwsltr_dtl);
			if($cnt_nwsltrd>0){
				$lftmsg = "Duplicate Email";
			}
			else{
				$nwgnrtecd	=	substr(md5(rand()),0,4);	
				$iqrynwsltr_dtl=" insert into 
									nwsltr_dtl(
									nwsltrd_emailid,nwsltrd_name,nwsltrd_sts,nwsltrd_prty,
									nwsltrd_code,nwsltrd_crtdon,nwsltrd_crtdby
								)values(
									'$lftemail','$lftname','$lftsts','$lftprior',
									'$nwgnrtecd','$lftdt','$lftname')";				
				$irsnwsltr_dtl  = mysqli_query($conn,$iqrynwsltr_dtl);			
				if($irsnwsltr_dtl==true){
						$idval = mysql_insert_id();
						global $flgval;
						$flgval = 0;						
						$to		  	=  $lftemail;			
						$frmemailid	= $u_prjct_email;//Client emailid;	
						/********************************************************/		
					
						$hdimg    = $u_prjct_dspmnurl.$site_logo;//Return the URL
						$subject = "Newsletter Subscription Confirmation";
						
						$body = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
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
							Dear $lftname,<br/><br/>
							We thank you for subscribing to our monthly newsletter!<br/><br/>
							To get started, please confirm your subscription by <a href='".$u_prjct_dspmnurl."confirm-newsletter?nwsltrcd=$idval-$nwgnrtecd' target='_blank'>clicking here.</a><br/><br/>
							Please allow upto 3 business days to process your profile update.<br/><br/>
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
						/*$body    ="<table width='600' border='0' align='center' cellpadding='0' cellspacing='3' bgcolor='#CECECE'>
							  <tr>
								<td><table width='100%' border= '0' align='center' cellpadding= '5 ' cellspacing= '0' bgcolor='#F5F5F5' bordercolor='#4A2E2D'>
								  <tr>
									<td width= '153' >Name</td>
									<td width= '10' >:</td>
									<td width= '364' >$lftname</td>
								  </tr>
								  <tr>
									<td >Email</td>
									<td >:</td>
									<td >$lftemail</td>
								  </tr>									
								   <tr>
									<td valign= 'top ' colspan='3' align='center'>Thank You, we received your Request For News Letter.We will get back to you soon.</td>
								  </tr>						  
								</table></td>
							  </tr>
							</table>";*/
					$headers 	 = 'MIME-Version: 1.0' . "\r\n";
					$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers 	.= "From: $frmemailid" . "\r\n";
					$headers 	.= "Cc: $frmemailid" . "\r\n";	
					if(mail($to,$subject,$body,$headers)){					
						?>
							<script>location.href="<?php echo $rtpth;?>thankyou";</script>
						<?php
					}
					else{
					?>
						<script>location.href="<?php echo $rtpth;?>error";</script>
					<?php
					}
				}
				else{
					$lftmsg = "Not Saved Try Again";
				}					
		    }
			
		}
	}
?>