<?php

//error_reporting(0);
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once 'includes/inc_connection.php'; //Make connection with the database  	
include_once "includes/inc_config.php";	//path config file
include_once "includes/inc_usr_functions.php"; //Including user session value
include_once "includes/inc_folder_path.php"; //Including user session value
$page_title = "Feedback | Motor Station";
$page_seo_title = "Feedback | Motor Station";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>
<script language="javascript" src="includes/yav.js"></script>
<script language="javascript" src="includes/yav-config.js"></script>
<script language="javascript" type="text/javascript">
	var rules_1 = new Array();

	rules_1[0] = 'txtname:Name|required|Enter Name';
	rules_1[1] = 'txtemailid:Email|required|Enter email id';
	rules_1[2] = 'txtphone:Phone|required|Enter Phone Number';
	rules_1[3] = 'txtphone:Phone|numeric|Enter Only Numbers';
	rules_1[4] = 'txtcmpny:company|required|Enter Company Name';
    rules_1[5] = 'txtloc:location|required|Enter Your Location';


	// function setfocus() {
	// 	document.getElementById('txtname').focus();
	// }
</script>

<!-- slider-area-start  -->
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="assets/img/inner-banner/feedback.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
                            <li><span>Feedback</span></li>
                        </ul>
                    </div>
                    <h3 class="page__title mt-20">Feedback</h3>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- contact__area-2 start -->
<section class="contact__area-2 pt-90 pb-90">
    <div class="container">

        <div class="contact__form grey-bg-8 black-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section__wrapper mb-45">
                            <h3 class="text-white">Kindly fill the below form.</h3>
                        </div>
                    </div>
                    <div class="col-xl-12">
                    <form name="frmfeedenq" id="frmfeedenq" method="post" action="" onSubmit="return performCheck('frmfeedenq', rules_1, 'inline');">
                        <!-- <form id="contact-form" action="" method="POST"> -->

                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed mb-20">
                                        <input type="text" name="txtname" id="txtname" placeholder="Your Name">
                                        <span id="errorsDiv_txtname" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed contact-icon-mail mb-20">
                                        <input email="text" name="txtemailid"  id="txtemailid" placeholder="Your Email Id">
                                        <span id="errorsDiv_txtemailid" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed contact-icon-call mb-20">
                                        <input type="text" name="txtphone" id="txtphone" placeholder="Your Phone Number">
                                        <span id="errorsDiv_txtphone" style="color:red"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="contact-filed cpname mb-20">
                                        <input type="text" name="txtcmpny" id="txtcmpny" placeholder="Company Name">
                                        <span id="errorsDiv_txtcmpny" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="contact-filed locate mb-20">
                                        <input type="text" name="txtloc" id="txtloc" placeholder="Location">
                                        <span id="errorsDiv_txtloc" style="color:red"></span>
                                    </div>
                                </div>

                            </div>


                            <div class="contact-filed contact-icon-message mb-20">
                                <textarea placeholder="Enter message here" name="txtdesc" id="txtdesc"></textarea>
                            </div>



                            <div class="form-submit d-flex justify-content-end align-items-center">
                                <!-- <button class="tp-btn" type="submit">Submit</button>
                                <button href="#" class="tp-btn-d ms-3">Reset</button> -->
                                <input type="submit" class="tp-btn" name="btnfedenq" id="btnfedenq" value="Submit">
                                <input type="reset" class="tp-btn-d ms-3" value="Reset">
                            </div>
      

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact__area-2 end -->
<?php
if(isset($_POST['btnfedenq']) && ($_POST['btnfedenq'] != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
	   isset($_POST['txtemailid']) && ($_POST['txtemailid']) != "")
       {
			$name     = glb_func_chkvl($_POST['txtname']);
			$email     = glb_func_chkvl($_POST['txtemailid']);
			$phone    = glb_func_chkvl($_POST['txtphone']);
            $company    = glb_func_chkvl($_POST['txtcmpny']);
        $location    = glb_func_chkvl($_POST['txtloc']);
        $msg    = glb_func_chkvl($_POST['txtdesc']);
       
			
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
       <td bgcolor='#F0F0F0'>Company Name*</td>
       <td bgcolor='#F0F0F0'>&nbsp;</td>
       <td bgcolor='#F0F0F0'>". $company."</td>
       </tr>
       <tr>
       <td bgcolor='#F0F0F0'>Location*</td>
       <td bgcolor='#F0F0F0'>&nbsp;</td>
       <td bgcolor='#F0F0F0'> $location</td>
       </tr>
       <tr>
       <td bgcolor='#F0F0F0'>Message</td>
       <td bgcolor='#F0F0F0'>&nbsp;</td>
       <td bgcolor='#F0F0F0'>$msg</td>
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
							{?>
						
								<script>
								location.href='thankyou.php';
							</script>
							
							<?php 	}
							else
							{?>
						
								<script>
								location.href='error.php';
							</script>
							
							<?php
                          
							}
      }    
      
?>



<?php include_once('footer.php'); ?>