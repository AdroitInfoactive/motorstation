<?php
	  include_once '../includes/inc_nocache.php';          //Clearing the cache information
	  include_once "../includes/inc_adm_session.php";      //checking for session
	  include_once "../includes/inc_connection.php";       //Making database Connection
	  include_once '../includes/inc_usr_functions.php';    //Use function for validation and more	
	  include_once '../includes/inc_paging_functions.php'; //Making paging validation
	  include_once '../includes/inc_config.php';           //Making paging validation
	  include_once '../includes/inc_folder_path.php';      //Floder Path
	  
	  
	  $del=mysqli_query($conn,"delete from product_location where mspr_lid='".@$_GET['id']."'");
	 if($del){
		 @$rd="Record Deleted";
		 }
		 
		 
		 @$sts=$_GET['sts'];
		  @$bid=$_GET['bid'];
		if($sts == 'Active')  
{
    $sact = mysqli_query($conn,"UPDATE product_location SET mspr_sts = 'Inactive' where mspr_lid='".$bid."' ");
	$resact="Record Inactivated";
}
if($sts == 'Inactive')
{
    $sinact = mysqli_query($conn,"UPDATE product_location SET mspr_sts = 'Active' where mspr_lid='".$bid."' ");
	$resinact="Record Activated";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Motor Station</title>
<?php //include_once  'script.php'; ?>
	
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
</script>
</head>
<body onLoad="onload()">
<?php include_once ('../includes/inc_adm_header.php');
	  include_once('../includes/inc_adm_leftlinks.php');
?>
<?php if(@$_GET['id']){ ?>
<div style="color:red; margin-left:200px;"><?php echo $rd ?></div>
<?php } ?>

<?php if(@$sact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resact; ?></div>
<?php }?>
<?php if(@$sinact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resinact; ?></div>
<?php }?>
                 <div style="width:200px; float:right;"> <input type="button"  name="btnBack" value="&laquo;   Add" class="textfeild" onclick="location.href='add_location.php'"></div>
            <table width="90%"  border="0" cellspacing="0" cellpadding="5" style="margin-left:50px; font-size:15px;" bgcolor="#D8D7D7">
           
            
            
              <tr style="background-color:#004991;">
                <td style="color:#fff;"><strong>S.No.</strong></td>
                <td style="color:#fff;"><strong> Code</strong></td>
                <td style="color:#fff;"><strong>Location</strong></td>
                <td style="color:#fff;"> <strong>Status</strong></td>
                <td style="color:#fff;"><strong>Edit</strong></td>
                <td style="color:#fff;"><strong>Delete</strong></td>
                </tr>
          
                <?php  
				$qry= mysqli_query($conn,"select * from product_location ");
				$a=0;
				          while($res=mysqli_fetch_object($qry)){
				    $a++;
				?>
                <tr>
                <td><?php echo $a; ?></td>
       <td><a href="vw_location_details.php?id=<?php echo $res->mspr_lid;?>" style="text-decoration:none">
				 <?php echo $res->mspr_lcode; ?></a></td>
       <td><a href="vw_location_details.php?id=<?php echo $res->mspr_lid;?>"  style="text-decoration:none">
				<?php echo $res->mspr_lnm;?></a></td>
                 <td>
			
  
    <a href="view_location.php?bid=<?php echo $res->mspr_lid; ?>&sts=<?php echo $res->mspr_sts;?>">
   <input type="checkbox" value="<?php echo $res->mspr_sts; ?>" 
   onClick="return confirm(' you want to Update Status')"
    <?php if($res->mspr_sts == "Active"){ echo "checked"; } else { echo "unchecked"; }  ?> >
  </a>
    

   </td>
    <td>
    <a href="edit_location.php?id=<?php echo $res->mspr_lid;?>"  style="text-decoration:none">
 <img src="http://www.iconhot.com/icon/png/bunch-cool-bluish-icons/256/edit-29.png"  width="20px" height="20px">
    </a> 
    </td>
    <td>
    <a href="view_location.php?id=<?php echo $res->mspr_lid;?>" onclick="return confirm('Are you sure to delete')" style="text-decoration:none"> 
<img src=" http://www.iconarchive.com/download/i51281/awicons/vista-artistic/delete.ico" width="15px" height="15px">
    </a>
    </td>
                
                </tr>
           <?php } ?>
          							
              </table>
			   
        
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>