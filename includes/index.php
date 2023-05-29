<?php
	session_start();
	include_once "includes/inc_connection.php";
	include_once "includes/inc_usr_functions.php";	
	include_once "includes/inc_folder_path.php";	
	include_once "includes/inc_fnct_img_resize.php";	
	include_once "includes/inc_img_size.php";
	
	global $msg,$cart,$prodid,$title,$loc,$smlimgfldnm; //Stores the message	
	global $scat_id,$arr,$opt;
		
	$sqryprod_mst1 = "select 
							prodcatm_id,prodcatm_name,prodm_id,prodm_code,prodm_name
							prodscatm_id,prodscatm_name,prodm_descone,prodm_desctwo,
							prodcatm_desc,prodimgd_simg,count(prodm_id) as totprod,
							prodm_mrp,prodm_op							
					  from 
					  	vw_cat_prod_mst
						left join prodimg_dtl on prodm_id=prodimgd_prodm_id
					  where
			  			  prodcatm_sts='a' and
						  prodscatm_sts='a' and
						  prodm_sts='a'"; 
						
	$title 		   = "";
	$page_title = "Home";
	$current_page = "home";
	include_once('header.php'); 
?>

  <section class="page">
<div class="container">


 <div class="bannerContainer">
      <ul class="rslides" id="bannerSlides">
        
        <li> <img src="images/ashwagandha-tablets-banner.jpg" alt="ashwagandha">
          <div class="bnrcaption">
            <h3>Ashwagandha Tablets </h3>
            <p class="smtxt">(WITHANIA SOMNIFERA)</p>
             <h4>A Stress Reliever</h4>
            <p>It relieves stress &amp; promotes sound sleep Supports a healthy immune system<br />
Ashwagandha tablet gives power to the nervous system and Controls minor hypertension.</p>
            <p><a href="#" class="btn btn-warning btn-xs">Read More...</a></p>
          </div>
        </li>
        <li> <img src="images/neem-banner.jpg" alt="neem">
          <div class="bnrcaption">
           <h3>Neem </h3>
           <p class="smtxt">(AZADIRACTA INDICA)</p>
           <h4>Healthy, Glowing Complexion</h4>
            <p>It has anti-bacterial &amp; anti-fungal properties.<br />
It supports the circulatory, digestive, respiratory and urinary systems</p>
            <p><a href="#" class="btn btn-warning btn-xs">Read More...</a></p>
          </div>
        </li>
            
        
        
      </ul>
    </div>
    <div class="clearfix"></div>

    
    <div class="clearfix"></div>
    <div class="col-md-12">
<div class="row"> 
<h3 class="title"><span>Sri Jain Ayurvedic Pharmacy</span></h3>
<p>We, at Sri Jain Ayurvedic Pharmacy are committed towards spreading the advantages of the time tested and proven science of Ayurveda to the masses. We have been incapacitated with a well organized infrastructure, a state-of-the-art GMP Certified Manufacturing facility for manufacturing and exporting over 160 Herbal Formulations, Nutraceuticals and Cosmetics backed by well qualified and highly experienced research team to offer you the best quality and service always.</p></div>
    </div>

        <div class="clearfix col-md-12 show-grid">
    <div class="row">
<section class="productList">
  <h3 class="title"><span>Our Collection</span></h3>
  <div class="clearfix productListWrapper">
  
		  <?php
			$sqryprod_mst2 = " group by prodcatm_id order by prodcatm_prty desc";   				  	  

			$sqryprod_mst  = $sqryprod_mst1.$sqryprod_mst2;
		
			$srsprod_mst   = mysqli_query($conn,$sqryprod_mst);
			$cntrec_prod   = mysqli_num_rows($srsprod_mst);

			$cntscrl = 0 ;
			$prod_cnts = "<ul id='prodSlides'>";	
			while($srowsprod_mst=mysqli_fetch_assoc($srsprod_mst)){
				$prodcat_id	  = $srowsprod_mst['prodcatm_id'];														
				$prodcat_name  = $srowsprod_mst['prodcatm_name'];					
				$uprodcat_name = funcStrRplc($prodcat_name);
				$tp_totprod	   = $srowsprod_mst['totprod'];								
				$prodscat_id	= $srowsprod_mst['prodscatm_id'];	
				$prodscat_name  = $srowsprod_mst['prodscatm_name'];				
				$uprodscat_name = funcStrRplc($prodscat_name);
				
				
				$prodname     = $srowprodcat_mst_tp['prodm_name'];	
				$uprodname	  = funcStrRplc($tp_prodname);
				$prod_mrp		= $srowsprod_mst['prodm_mrp'];	
			    $prod_ofr		= $srowsprod_mst['prodm_op'];
				if(($prod_ofr > 0) && ($prod_mrp > $prod_ofr)){
					 $prcvql =  "<strike>$crncynm&nbsp;$prod_mrp</strike>
					$crncynm&nbsp;$prod_ofr";			
				}
				else{
					if($prod_mrp > 0){
						 $prcvql = "$crncynm&nbsp;$prod_mrp";
					}
				}				
				
				$totprod  	 = $srowsprod_mst['totprod']; 
				$prodid	  	 = funcStrRplc($srowsprod_mst['prodm_code']);					
									
				$desc	      = substr(html_entity_decode($srowsprod_mst['prodm_descone']),0,120);	

					/*if(($cntscrl != 0) && ($cntscrl % 3 == 0)){			
					$prod_cnts .= "</ul><ul id='prodSlides'>";
				}	 */

				$imgnm = $srowsprod_mst['prodimgd_simg'];
				$imgpath = $u_gsml_fldnm.$imgnm;
				
				//if($tp_totprod > 1){
					$lnknm = "$rtpth$uprodcat_name";
				//}							
				/*else{
					$lnknm = "$uprodcat_name/$uprodscat_name/$uprodname/$prodid";
					//$tp_lnknm = "product-display.php?prodid=$tp_prodid";
				}*/						
				
				
					 
				$prod_cnts .= "<li><a href='$lnknm' class='thumbnail'>";
			 
				if(($imgnm !="") && file_exists($imgpath)){
					$prod_cnts .=  "<img src='$imgpath' alt='$prodcat_name' ><span class='scrollName'>$prodcat_name</span><span class='scrollName'></a>";								  
				}
				else{
					$prod_cnts .=  "<img src='images/noimage.jpp' alt='$prodcat_name'><span class='scrollName'>$prodcat_name</span><span class='scrollName'></a>";								  
				}				 
				$prod_cnts .= "</li>";
				$cntscrl += 1;		
			}

		$prod_cnts .= "</ul>";
		echo $prod_cnts;
	?>
    

  <span class="carPrev"></span><span class="carNext"></span>
  
  </div>
  
  
</section>
</div>
</div>
    
    
    
    <div class="row">
    <div class="col-md-4 welcome">
<h3 class="title"><span>Updates</span></h3>



<div class="updatesblock">
<article id="updatesticker">
<ul class="updatelist">
<li><a href="news-details.php">Sri Jain Ayurvedic Pharmacy are committed towards spreading the advantages of the time tested and proven science of Ayurveda to the masses</a></li>
<li><a href="news-details.php">Sri Jain Ayurvedic Pharmacy are committed towards spreading the advantages of the time tested and proven science of Ayurveda to the masses</a></li>

</ul>
<div class="clearfix"></div>
 </article>
 <div class="iconbox">
  <a id="newprev" href="javascript:;"><i class="icon-chevron-sign-up"></i></a>
  <a id="newnxt" href="javascript:;" ><i class="icon-chevron-sign-down"></i></a>
   <a id="newnxt" href="news-all.php" class="btn btn-warning btn-xs"><strong class="whitetxt">View All</strong></a>
</div>
</div>


       
       

    
    </div>
    <div class="col-md-8">     
     <section class="bestsel_List">
  <h3 class="title"><span>Best Sellers</span></h3>
  <div class="clearfix bestseller_ListWrapper">
  
           <?php
			$sqryprod_mst2 = " and prodm_typ = '3' 
								group by prodm_id order by prodm_prty desc";   				  	  

			$sqryprod_mst  = $sqryprod_mst1.$sqryprod_mst2;
		
			$srsprod_mst   = mysqli_query($conn,$sqryprod_mst);
			$cntrec_prod   = mysqli_num_rows($srsprod_mst);
			$prod_cnts ="";
			$cntscrl = 0 ;
			if($cntrec_prod > 0){
				$prod_cnts = "<ul id='bestsellerslides'>";	
				$lnknm= "";
				while($srowsprod_mst=mysqli_fetch_assoc($srsprod_mst)){
					$prodcat_id	  = $srowsprod_mst['prodcatm_id'];														
					$prodcat_name  = $srowsprod_mst['prodcatm_name'];					
					$uprodcat_name = funcStrRplc($prodcat_name);
										
					$prodscat_id	  = $srowsprod_mst['prodscatm_id'];	
					$prodscat_name  = $srowsprod_mst['prodscatm_name'];				
					$uprodscat_name = funcStrRplc($prodscat_name);
					$tp_totprod	   = $srowsprod_mst['totprod'];
					
					$prodname     = $srowprodcat_mst_tp['prodm_name'];	
					$uprodname	  = funcStrRplc($tp_prodname);
									
					
					$totprod  	 = $srowsprod_mst['totprod']; 
					$prodid	  	 = funcStrRplc($srowsprod_mst['prodm_code']);					
					if(($prod_ofr > 0) && ($prod_mrp > $prod_ofr)){
						 $prcvql =  "<strike>$crncynm&nbsp;$prod_mrp</strike>
						$crncynm&nbsp;$prod_ofr";			
					}
					else{
						if($prod_mrp > 0){
							 $prcvql = "$crncynm&nbsp;$prod_mrp";
						}
					}	
										
					$desc	      = substr(html_entity_decode($srowsprod_mst['prodm_descone']),0,120);	
	
						/*if(($cntscrl != 0) && ($cntscrl % 3 == 0)){			
						$prod_cnts .= "</ul><ul id='prodSlides'>";
					}	 */
	
					$imgnm = $srowsprod_mst['prodimgd_simg'];
					$imgpath = $u_gsml_fldnm.$imgnm;
					
					if($tp_totprod > 1){
						$lnknm = "$rtpth/best-seller";
					}							
					else{
						$lnknm = "$rtpth$uprodcat_name/$uprodscat_name/$uprodname/$prodid?bstslr=y";
						//$tp_lnknm = "product-display.php?prodid=$tp_prodid";
					}						
					
					
						 
					$prod_cnts .= "<li ><a href='$lnknm' >";
				 
					if(($imgnm !="") && file_exists($imgpath)){
						$prod_cnts .=  "<img src='$imgpath' alt='$prodcat_name' >
									 <div class='newArrivalName'>
					   <p class='seller_pr_name'> $prodcat_name</p>
					   <p class='seller_pr_name'><i class='icon-inr'></i>$prcvql</p>
					   </div>
					   </a>";								  
								}
								else{
									$prod_cnts .=  "<img src='images/noimage.jpg' alt='$prodcat_name'>
									<div class='newArrivalName'>
					   <p class='seller_pr_name'> $prodcat_name</p>
					   <p class='seller_pr_name'><i class='icon-inr'></i>$prcvql</p>
					   </div>
						
									
									</a>";								  
								}				 
					$prod_cnts .= "</li>";
					$cntscrl += 1;		
				}
			}
			else{
				echo "Will be updated soon";
			}

		$prod_cnts .= "</ul>";
		echo $prod_cnts;
	?>
    

  <span class="bs_carPrev"></span><span class="bs_carNext"></span>
  
  </div>
  
  
</section>
    </div>
    </div>
    
    
    
    <div class="row bottomservice_block">
    <ul class="bottomservicelist">
        <li class="col-md-3 col-sm-6">
        <span><i class="flaticon-protected9"></i></span>
        <p class="bottomservice_title">100% Secure Payments</p>
        <p class="bottomservice_title">All major credit &amp; debit cards  accepted</p>
        </li>
        
        <li class="col-md-3 col-sm-6">
        <span><i class="flaticon-time5"></i></span>
        <p class="bottomservice_title">Dispatched in 1 - 2 working days</p>
        </li>

        <li class="col-md-3 col-sm-6">
        <span><i class="flaticon-delivery13" style="font-size:40px;"></i></span>
        <p class="bottomservice_title">Free Shipping for orders above Rs.299/-</p>
        <p class="bottomservice_title">Cash on Delivery on orders above Rs.499/-</p>
        </li>


        <li class="col-md-3">
        <span><i class="flaticon-black24" style="font-size:40px;"></i></span>
        <p class="bottomservice_title"> International Shipping </p>
        </li>

    </ul>
 
    </div>
    
    
    <div class="clearfix"></div>
    
    

  </div>
  </section>

<?php include_once('footer.php');?>