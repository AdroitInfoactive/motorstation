<?php
	  include_once '../includes/inc_nocache.php';          //Clearing the cache information
	  include_once "../includes/inc_adm_session.php";      //checking for session
	  include_once "../includes/inc_connection.php";       //Making database Connection
	  include_once '../includes/inc_usr_functions.php';    //Use function for validation and more	
	  include_once '../includes/inc_paging_functions.php'; //Making paging validation
	  include_once '../includes/inc_config.php';           //Making paging validation
	  include_once '../includes/inc_folder_path.php';      //Floder Path
	  
	  
	  $del=mysqli_query($conn,"delete from motor_products where mspr_id='".@$_GET['id']."'");
	  if($del){
		$msg="Record Deleted ";
		  }
		
		  @$sts=$_GET['sts'];
		  @$bid=$_GET['bid'];
		 
		if($sts == 'Active')  
{
    $sact = mysqli_query($conn,"UPDATE motor_products SET  mspr_sts = 'Inactive' where mspr_id='".$bid."' ");
	$resact="Record Inactivated";
}
if($sts == 'Inactive')
{
    $sinact = mysqli_query($conn,"UPDATE motor_products SET  mspr_sts = 'Active' where mspr_id='".$bid."' ");
	$resinact="Record Activated";
}
		  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Motor Station</title>
<style>
.pagination {
    display: inline-block;
	
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<?php include_once  'script.php'; ?>
	
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js">
</script>
</head>
<body onLoad="onload()">
<?php include_once ('../includes/inc_adm_header.php');
	  include_once('../includes/inc_adm_leftlinks.php');
	  
	  

?>
<?php if(@$_GET['id']){?>
<p style="margin-left:200px; color:red;"><?php echo $msg; ?></p>
<?php } ?>
<?php if(@$sact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resact; ?></div>
<?php }?>
<?php if(@$sinact){ ?>
<div style="color:red; margin-left:200px;"><?php echo @$resinact; ?></div>
<?php }?>
<form method="post">
<table width="90%" bgcolor="#CCCCCC" style="margin-left:50px; padding:10px;">
    <tr>
 <!--  <td><select name="brd"><option><--select Brand--><!--</option>-->
                  <?php  
				/* $l=mysqli_query($conn,"select * from brnd_mst");
				   while($loc=mysqli_fetch_object($l)){*/
				  ?>
                  <option><?php // echo $loc->brndm_name; ?></option>
                  <?php // } ?>
    
   <!-- </select></td>-->
   <td><select name="pcat"><option><-- product --></option>
      <?php  
				  $pc=mysqli_query($conn,"select * from product_category");
				   while($pcat=mysqli_fetch_object($pc)){
				  ?>
                  <option value="<?php echo $pcat->msc_id;?>"><?php echo $pcat->msc_type; ?></option>
                   <?php } ?>
    
    </select></td>
    <td><select name="ptype"><option><-- Type --></option>
        <?php  
				  $pt=mysqli_query($conn,"select * from product_type");
				   while($ptype=mysqli_fetch_object($pt)){
				  ?>
                  <option value="<?php echo $ptype->ms_id;?>"><?php echo $ptype->ms_typ; ?></option>
                <?php } ?>
    </select></td>
    <td><input type="submit" name="sub" value="Search"></td>
    
    </tr>
  
    
    </table>
    
    


                 <div style="width:200px; float:right;"> <input type="button"  name="btnBack" value="&laquo;   Add" class="textfeild" onclick="location.href='add_main_product.php'"></div>
            <table width="95%"  border="0" cellspacing="0" cellpadding="5" style="margin-left:25px;">
        
              <tr class="white">
                <td class="greenbg"><strong>S.No.</strong></td>
                <td  class="greenbg"><strong>Code</strong></td>
                <td  class="greenbg"><strong>Name</strong></td>
                <td  class="greenbg"><strong>Brand</strong></td>
                <td  class="greenbg"><strong>Location</strong></td>
               
                <td  class="greenbg"><strong>Category</strong></td>
               <td  class="greenbg"><strong>Type</strong></td>
               <td  class="greenbg"><strong>Status</strong></td>
                <td  class="greenbg"><strong>Edit</strong></td>
                <td  class="greenbg"><strong>Delete</strong></td>
                </tr>
                
	
				
                <?php
				  
				  if(isset($_POST['sub'])) {
		   @$a=0;
      $sql = mysqli_query($conn,"SELECT * FROM motor_products  where 
	  mspr_ctgy ='".$_POST['pcat']."' or mspr_typ='".$_POST['ptype']."'   ");  
	  while($res=mysqli_fetch_object($sql)){
				    @$a++;
	  
	  ?>
       <tr>
                <td><?php echo $a; ?></td>
      <td><a href="vw_main_product_details.php?id=<?php echo $res->mspr_id;?>"style="text-decoration:none;">
				 <?php echo $res->mspr_code; ?></a>
                <td>
         <a href="vw_main_product_details.php?id=<?php echo $res->mspr_id;?>" style="text-decoration:none;">
				<?php echo $res->mspr_nm; ?></a></td>
                 <td><?php  
			 $brdsql=mysqli_query($conn,"select brndm_id,brndm_name from  brnd_mst");
			  while($brd=mysqli_fetch_object($brdsql)){
			 ?>
			 <?php
		 
			 if($brd->brndm_id == $res->mspr_brnd){
			 echo $brd->brndm_name; ?>
             <?php } }?>
             </td>
               
                 <td><?php echo $res->mspr_lctn; ?></td>
               
             <td>
			 <?php  
			 $catgry=mysqli_query($conn,"select  msc_id,msc_type from  product_category");
			  while($cat=mysqli_fetch_object($catgry)){
			 ?>
			 <?php
			 
			 if($cat->msc_id == $res->mspr_ctgy){
			 echo $cat->msc_type; ?>
             <?php } }?>
             </td>
             
             
             
             
             <td><?php  
			 $prtype=mysqli_query($conn,"select ms_id,ms_typ from  product_type");
			  while($typ=mysqli_fetch_object($prtype)){
			 ?>
			 <?php
		 
			 if($typ->ms_id == $res->mspr_typ){
			 echo $typ->ms_typ; ?>
             <?php } }?>
             </td>
                  <td>
          <a href="vw_all_main_products.php?bid=<?php echo $res->mspr_id; ?>&sts=<?php echo $res->mspr_sts;?>">
   <input type="checkbox" value="<?php echo $res->mspr_sts; ?>" 
   onClick="return confirm('you want to Update Status')"
    <?php if($res->mspr_sts == "Active"){ echo "checked"; } else { echo "unchecked"; }  ?> >
       </a>
                  
                  </td> 
               
                <td>
           <a href="edit_main_product.php?id=<?php echo $res->mspr_id;?>" style="text-decoration:none;">
 <img src="http://www.iconhot.com/icon/png/bunch-cool-bluish-icons/256/edit-29.png"  width="20px" height="20px">          
           
           </a> </td><td> <a href="vw_all_main_products.php?id=<?php echo $res->mspr_id;?>" 
           onclick="return confirm('Are you sure to delete')" style="text-decoration:none;"> 

 <img src=" http://www.iconarchive.com/download/i51281/awicons/vista-artistic/delete.ico" width="15px" height="15px"> 
           </a></td>
                
                </tr>
      
				  <?php } } else { 
				  //pagination code start
				  
				  
				
		
	$sql= mysqli_query($conn,"select * from motor_products order by mspr_id desc limit 0,20");
	
				
				 @$a=0;
				while($res=mysqli_fetch_object($sql)){
				    @$a++;
				?>
                <tr>
                
                <td><?php echo $a; ?></td>
                <td><a href="vw_main_product_details.php?id=<?php echo $res->mspr_id;?>">
				<?php echo $res->mspr_code; ?></td>
                <td><a href="vw_main_product_details.php?id=<?php echo $res->mspr_id;?>">
				<?php echo $res->mspr_nm; ?></a></td>
                <td>
				<?php  
			 $brdsql=mysqli_query($conn,"select brndm_id,brndm_name from  brnd_mst");
			  while($brd=mysqli_fetch_object($brdsql)){
			 ?>
			 <?php
		 
			 if($brd->brndm_id == $res->mspr_brnd){
			 echo $brd->brndm_name; ?>
             <?php } }?>
			</td>
                 <td><?php echo $res->mspr_lctn; ?></td>
                  
                  
                 
             <td> 
			 <?php  
			 $catgry=mysqli_query($conn,"select msc_id,msc_type from  product_category");
			  while($cat=mysqli_fetch_object($catgry)){
			 ?>
			 <?php
		 
			 if($cat->msc_id == $res->mspr_ctgy){
			 echo $cat->msc_type; ?>
             <?php } }?>
             </td>
             
             
                   <td>
				    <?php  
			 $prtype=mysqli_query($conn,"select ms_id,ms_typ from  product_type");
			  while($typ=mysqli_fetch_object($prtype)){
			 ?>
			 <?php
		 
			 if($typ->ms_id == $res->mspr_typ){
			 echo $typ->ms_typ; ?>
             <?php } }?>
                   </td>
 
                <td>
                
          <a href="vw_all_main_products.php?bid=<?php echo $res->mspr_id; ?>&sts=<?php echo $res->mspr_sts;?>">
   <input type="checkbox" value="<?php echo $res->mspr_sts; ?>" 
   onClick="return confirm('you want to Update Status')"
    <?php if($res->mspr_sts == "Active"){ echo "checked"; } else { echo "unchecked"; }  ?> >
  </a>
                
                </td>
                <td> <a href="edit_main_product.php?id=<?php echo $res->mspr_id;?>">
<img src="http://www.iconhot.com/icon/png/bunch-cool-bluish-icons/256/edit-29.png"  width="20px" height="20px">              </a>   
                </td>
                <td>
                 <a href="vw_all_main_products.php?id=<?php echo $res->mspr_id;?>" 
                 onclick="return confirm('Are you sure to delete')">
<img src=" http://www.iconarchive.com/download/i51281/awicons/vista-artistic/delete.ico" width="15px" height="15px">        
                 </a>
                 </td>
                
                </tr>
                
           <?php  } } ?>
          				
              </table>
              
        
               
    </form>    
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>