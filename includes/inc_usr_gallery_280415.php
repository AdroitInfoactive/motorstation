<?php
		$sqryphtcat_mst="select 
							 phtm_id,phtm_name,phtimgd_bimg
					   from 
							vw_pht_phtimg_dtl
						where
							phtm_sts = 'a' and
							phtimgd_sts ='a'";
								
		if(isset($_REQUEST['phtcat']) && trim($_REQUEST['phtcat']!="")){
		  $ary_phtcat= explode('_',glb_func_chkvl($_REQUEST['phtcat']));
			$pht_id	   = $ary_phtcat[1];
		  //$pht_id 		= glb_func_chkvl($_REQUEST['phtcat']);	
		  $sqryphtimg_mst =$sqryphtcat_mst ."and
								phtm_id='$pht_id'
			     				group by phtimgd_id
						order by phtimgd_prty desc";
			$srsphtcat_dtl = mysqli_query($conn,$sqryphtimg_mst);
			$cntrec_phtcat = mysqli_num_rows($srsphtcat_dtl);
			if($cntrec_phtcat > 0){
			$srsphtcat_mst1 = mysqli_fetch_assoc($srsphtcat_dtl);
				$pht_nm    = $srsphtcat_mst1['phtm_name'];	
			}
			else{
			   echo "<script>location.href='cat-photogallery.php'</script>";
			 //  header("Location:cat-photogallery.php");
			   exit();	
			}	
			if($cntrec_phtcat > 0){	
			mysql_data_seek($srsphtcat_dtl,0);
			$img_cnts = " <div class='col-md-9 col-sm-9'><div class='page-header'> <h1 class='pageTitle'><span>$pht_nm</span></h1>
						  <ul class='breadcrumb hidden-xs'>
							<li><a href='".$rtpth."home'>Home</a></li>
							<li><a href='".$rtpth."cat-gallery'>Photo Gallery</a></li><li class='active'>$pht_nm</li>
						  </ul></div><ul class='thumbnails' id='list-gallery'>";
			 while($srowsphtcat_dtl = mysqli_fetch_assoc($srsphtcat_dtl)){
			 $phtid         = $srowsphtcat_dtl['phtm_id'];
			 $pht_name      = $srowsphtcat_dtl['phtm_name'];
			 $pht_title      = $srowsphtcat_dtl['phtimgd_title'];
			 $ary_phttle=  explode("-",$pht_title);
			 $phtimgd_title  =$ary_phttle[1]; 
			 $bphtimgnm     = $srowsphtcat_dtl['phtimgd_bimg'];
			 $bimgpath      = $u_phtbimg_fldnm.$bphtimgnm;	
			 if(($bphtimgnm == '') || !(file_exists($bimgpath))){
				$bimgpath	 = $simgpath;		 
			 }		
					if(($bphtimgnm != '') && file_exists($bimgpath)){
					 $img_cnts .="<li class='col-md-4'><a  class='thumbnail fancybox' href='$rtpth$bimgpath' rel='fancygall' title='$phtimgd_title'><img src='$rtpth$bimgpath'/></a></li>";  
					}
					
					
			}	$img_cnts .= "</div>
            </div></div>";
			
			echo $img_cnts;
		}
	}
	else{
		
		$sqryphtcat_mst1 = $sqryphtcat_mst." group by phtm_id
						order by phtm_prty desc";
		$srsphtcat_dtl = mysqli_query($conn,$sqryphtcat_mst1);
		$cntrec_phtcat = mysqli_num_rows($srsphtcat_dtl);
		if($cntrec_phtcat > 0){	
		$img_cnts = " <div class='page-header'> <h1 class='pageTitle'><span>Photo Gallery</span></h1>
						  <ul class='breadcrumb hidden-xs'>
							<li><a href='".$rtpth."home'>Home</a></li>
							<li class='active'>Photo Gallery</li>
						  </ul></div><ul class='cat-gallery' >";
			
			while($srowsphtcat_dtl = mysqli_fetch_assoc($srsphtcat_dtl)){
			 $phtid         = $srowsphtcat_dtl['phtm_id'];
			 $pht_name      = $srowsphtcat_dtl['phtm_name'];
			 $tp_pht_name 	= funcStrRplc($pht_name);
			 $sqryphtimg_mst  = $sqryphtcat_mst." and phtm_id = $phtid order by phtimgd_prty desc limit 1";
			 $srsphtimg_dtl = mysqli_query($conn,$sqryphtimg_mst);
		     $cntrec_phtcat = mysqli_num_rows($srsphtimg_dtl);
			 	if($cntrec_phtcat > 0){
					$img_cnts .="<li class='col-md-4'><div class='thumbnail'><a href='$rtpth"."gallery-details/$tp_pht_name"._."$phtid'>";
					 $srowphtimg_dtl = mysqli_fetch_assoc($srsphtimg_dtl);
					 $phtimgnm      = $srowphtimg_dtl['phtimgd_bimg'];
					  $imgpath   	= $u_phtbimg_fldnm.$phtimgnm;
						if(($phtimgnm != '') && file_exists($imgpath)){
						 $img_cnts .="<img src='$imgpath'/>";  
						}else{
							$img_cnts .="<img src='$images/noimage.jpg' />";
						}
					
						$img_cnts .="<div>$pht_name</div></a>
				</div></li>";
				}
			}	echo $img_cnts;
			$img_cnts .="</ul>";	
			
		}
		else{
			echo "<li class='span3'>Will be updated soon</li>";
		}
		
	}
?>