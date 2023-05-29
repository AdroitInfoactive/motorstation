<?php
global $pgtl, $usr_pgtl;
$pgtl = "Motor Station";
$usr_pgtl = "Motor Station";
$prefix_tl = "Motor Station";
date_default_timezone_set('UTC');
$crntyr = date('Y');
if ($crntyr != 2015) {
	$prd = "2015" . '--' . $crntyr;
} else {
	$prd = 2015;
}
$pgftr = "$prd, $pgtl Designed &amp; Developed By";
$usr_cmpny = "motor station";
$u_prjct_url = "https://www.motorstation.in";
$u_prjct_mnurl = "https://www.motorstation.in/";
$prjct_dmn = "motorstation.in/";
$u_prjct_email = "info" . "@$prjct_dmn";
$u_prjct_email_info = "info" . "@$prjct_dmn";
$rtpth = "/projects/praveen/m/motorstation/";
$site_logo = '/assets/img/logo/motor-station-logo-1.png';
?>