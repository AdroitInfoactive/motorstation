<?php
	  include_once '../includes/inc_nocache.php';          //Clearing the cache information
	  include_once "../includes/inc_adm_session.php";      //checking for session
	  include_once "../includes/inc_connection.php";       //Making database Connection
	  include_once '../includes/inc_usr_functions.php';    //Use function for validation and more	
	  include_once '../includes/inc_paging_functions.php'; //Making paging validation
	  include_once '../includes/inc_config.php';           //Making paging validation
	  include_once '../includes/inc_folder_path.php';      //Floder Path
	  
	  
	  $del=mysqli_query($conn,"delete from product_wheels where id='".@$_GET['id']."'");
	  if($del){
		$msg="Record Deleted";
		  }
		   @$sts=$_GET['sts'];
		  @$bid=$_GET['bid'];
		if($sts == 'Active')  
{
    $sact = mysqli_query($conn,"UPDATE product_wheels SET  whls_sts = 'Inactive' where id='".$bid."' ");
	$resact="Record Inactivated";
}
if($sts == 'Inactive')
{
    $sinact = mysqli_query($conn,"UPDATE product_wheels SET  whls_sts = 'Active' where id='".$bid."' ");
	$resinact="Record Activated";
}
		  
		  
		  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Motor Station</title>
<?php include_once  'script.php'; ?>
	
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
</script>
</head>
<body onLoad="onload()">
<?php include_once ('../includes/inc_adm_header.php');
	  include_once('../includes/inc_adm_leftlinks.php');
?>

    
             <?php if(@$_GET['id']){ ?>
            <p style="color:red; margin-left:200px;"><?php echo $msg; ?></p>
              <?php } ?>
              
              <?php if(@$sact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resact; ?></div>
<?php }?>
<?php if(@$sinact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resinact; ?></div>
<?php }?>
     
                 <div style="width:200px; float:right;"> <input type="button"  name="btnBack" value="&laquo;   Add" class="textfeild" onclick="location.href='add_product_wheels.php'"></div>
            <table width="80%"  border="0" cellspacing="0" cellpadding="5" style="margin-left:100px; font-size:15px;" bgcolor="#D8D7D7">
           
          
            
              <tr class="white">
                <td class="greenbg"><strong>S.No.</strong></td>
                <td  class="greenbg"><strong>Product Type</strong></td>
                <td  class="greenbg"><strong>Status</strong></td>
                <td  class="greenbg"><strong>Edit</strong></td>
                 <td  class="greenbg"><strong>Delete</strong></td>
                </tr>
              
				  
            
				       
               
				
                <?php  $sql= mysqli_query($conn,"select * from product_wheels");
				$a=0;
				          while($res=mysqli_fetch_object($sql)){
				    $a++;
				?>
                <tr>
                <td><?php echo $a; ?></td>
                <td><a href="vw_wheels_details.php?id=<?php echo $res->id;?>" style="text-decoration:none;">
				<?php echo $res->pr_whnam;?></td>
                 <td>
	<a href="vw_product_wheels.php?bid=<?php echo $res->id; ?>&sts=<?php echo $res->whls_sts;?>">
   <input type="checkbox" value="<?php echo $res->whls_sts; ?>" 
   onClick="return confirm('you want to Update Status')"
    <?php if($res->whls_sts == "Active"){ echo "checked"; } else { echo "unchecked"; }  ?> >
  </a>
   </td>
   <td><a href="edit_product_wheels.php?id=<?php echo $res->id;?>"  style="text-decoration:none;">
 <img src="http://www.iconhot.com/icon/png/bunch-cool-bluish-icons/256/edit-29.png"  width="20px" height="20px">
   
   </a></td>
   
 <td>  <a href="vw_product_wheels.php?id=<?php echo $res->id;?>" onclick="return confirm('Are you sure to delete')" style="text-decoration:none;"> 
 <img src=" http://www.iconarchive.com/download/i51281/awicons/vista-artistic/delete.ico" width="15px" height="15px"> 
 </a></td>
                
                </tr>
           <?php } ?>
          							
              </table>
			   
        
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>