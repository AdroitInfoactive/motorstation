<?php
error_reporting(0);
include_once "includes/inc_nocache.php";// Includes no data cache
include_once "includes/inc_usr_session.php";//checking for session
include_once "includes/inc_connection.php";//Making database Connection
include_once "includes/inc_usr_functions.php";//Making database Connection	
if(isset($_REQUEST['prodid']) && (trim($_REQUEST['prodid']) != "") && isset($_REQUEST['typ']) && (trim($_REQUEST['typ']) == "a"))	// checking Duplicate name for Brand name
{
  $prodid = glb_func_chkvl($_REQUEST['prodid']);
  if(!isset($_SESSION['prodid']) && $_SESSION['prodid'] == "")
  {
    $_SESSION['prodid'] = $prodid;
  }
  else
  {
    $ses_prd_id = explode(",",$_SESSION['prodid']);
    if(!in_array($prodid, $ses_prd_id))
    {
      $_SESSION['prodid'] .= ",".$prodid;
    }
  }
  echo "y";
}
if(isset($_REQUEST['prodid']) && (trim($_REQUEST['prodid']) != "") && isset($_REQUEST['typ']) && (trim($_REQUEST['typ']) == "d"))	// checking Duplicate name for Brand name
{
  $prodid = glb_func_chkvl($_REQUEST['prodid']);
  $ses_prd_id = explode(",",$_SESSION['prodid']);
  // if(($key = array_search($prodid, $ses_prd_id)) !== false) {
  //   unset($_SESSION[$key]);
  // }
  $nw_crtcode_val = "";
  if ($prodid != "")
  {
    for ($cnt_cartval = 0; $cnt_cartval < count($ses_prd_id); $cnt_cartval++)
    {
      if ($prodid != $cnt_cartval) {
        $nw_crtcode_val .= ",".$ses_prd_id[$cnt_cartval];
      }
    }
    $nw_crtcode_val = substr($nw_crtcode_val, 1);
    $_SESSION['prodid'] = $nw_crtcode_val;
  }
  echo "y";
}