<?php
		if(isset($_REQUEST['typ']) && trim($_REQUEST['typ']!="")){
			$vdotyp= glb_func_chkvl($_REQUEST['typ']);
			
			$sqryvdocat_mst="select 
								 vdom_id,vdom_name,vdoimgd_lnk
						   from 
								vw_vdo_vdoimg_dtl
							where
								vdom_sts = 'a' and
								vdom_typ = '$vdotyp' and
								vdoimgd_sts ='a'";
									
			if(isset($_REQUEST['vdocat']) && trim($_REQUEST['vdocat']!="")){
			  $ary_vdocat= explode('_',glb_func_chkvl($_REQUEST['vdocat']));
				$vdo_id	   = $ary_vdocat[1];
			  //$vdo_id 		= glb_func_chkvl($_REQUEST['vdocat']);	
			  $sqryvdoimg_mst =$sqryvdocat_mst ."and
									vdom_id='$vdo_id'
									group by vdoimgd_id
							order by vdoimgd_prty desc";
				$srsvdocat_dtl = mysqli_query($conn,$sqryvdoimg_mst);
				$cntrec_vdocat = mysqli_num_rows($srsvdocat_dtl);
				if($cntrec_vdocat > 0){
				$srsvdocat_mst1 = mysqli_fetch_assoc($srsvdocat_dtl);
					$vdo_nm    = $srsvdocat_mst1['vdom_name'];	
				}
				else{
				   echo "<script>location.href='video-gallery?typ=$vdotyp'</script>";
				 //  header("Location:cat-photogallery.php");
				   exit();	
				}	
				if($cntrec_vdocat > 0){	
				mysql_data_seek($srsvdocat_dtl,0);
				$img_cnts = "<div class='page-header'><div class='container'>
				<ul class='breadcrumb'>
								<li><a href='".$rtpth."home'>Home</a></li>
								<li><a href='".$rtpth."video-gallery?typ=$vdotyp'>$page_title</a></li><li class='active'>$vdo_nm</li>
							  </ul>
							  <h1 class='pageTitle'>$vdo_nm</h1>
							  </div></div><div class='container'><div class='row'><ul class='clearfix thumbnails'>";
				 while($srowsvdocat_dtl = mysqli_fetch_assoc($srsvdocat_dtl)){
				 $vdoid         = $srowsvdocat_dtl['vdom_id'];
				 $vdo_name      = $srowsvdocat_dtl['vdom_name'];
				 $vdo_title      = $srowsvdocat_dtl['vdoimgd_title'];
				 $ary_vdotle=  explode("-",$vdo_title);
				 $vdoimgd_title  =$ary_vdotle[1]; 
				// $bvdoimgnm     = $srowsvdocat_dtl['vdoimgd_lnk'];
				 //$bimgpath      = $u_vdobimg_fldnm.$bvdoimgnm;	
				 $vdoimgnm      = $srowsvdocat_dtl['vdoimgd_lnk'];
				$img_cnts .="<li class='col-md-6'><div class='embed-responsive embed-responsive-16by9'><iframe  src='$vdoimgnm' class='embed-responsive-item' frameborder='0' allowfullscreen></iframe></a></div></li>";  
						
						
				}	$img_cnts .= "</ul>
				</div></div>";
				
				echo $img_cnts;
			}
		}
		else{
			
			$sqryvdocat_mst1 = $sqryvdocat_mst." group by vdom_id
							order by vdom_prty desc";
			$srsvdocat_dtl = mysqli_query($conn,$sqryvdocat_mst1);
			$cntrec_vdocat = mysqli_num_rows($srsvdocat_dtl);
			if($cntrec_vdocat > 0){	
			$img_cnts = " <div class='page-header'><div class='container'><ul class='breadcrumb'>
								<li><a href='".$rtpth."home'>Home</a></li>
								<li class='active'>$page_title</li>
							  </ul>
							  <h1 class='pageTitle'>$page_title</h1>
							  </div></div><div class='container'><div class='row'><ul class='thumbnails clearfix' id='gallList'>";
				$imginc ="";
				while($srowsvdocat_dtl = mysqli_fetch_assoc($srsvdocat_dtl)){
				 $imginc ++;
				 $vdoid         = $srowsvdocat_dtl['vdom_id'];
				 $vdo_name      = $srowsvdocat_dtl['vdom_name'];
				 $tp_vdo_name 	= funcStrRplc($vdo_name);
				 $sqryvdoimg_mst= $sqryvdocat_mst." and vdom_id = $vdoid order by vdoimgd_prty desc limit 1";
				 $srsvdoimg_dtl = mysqli_query($conn,$sqryvdoimg_mst);
				 $cntrec_vdocat = mysqli_num_rows($srsvdoimg_dtl);
					if($cntrec_vdocat > 0){
						$img_cnts .="<li class='col-md-3 col-sm-4'><a class='thumbnail' href='$rtpth"."video-details/$vdotyp/$tp_vdo_name"._."$vdoid'>";
						 $srowvdoimg_dtl = mysqli_fetch_assoc($srsvdoimg_dtl);
						 $vdoimgnm      = $srowvdoimg_dtl['vdoimgd_lnk'];
						  $ary_vdonm 		= explode('embed/',$vdoimgnm);
						  $imgpath 		= "http://img.youtube.com/vi/$ary_vdonm[1]/hqdefault.jpg";
						   $img_cnts .="<img src='$imgpath'/>";  
						  
						
							$img_cnts .="<span class='desc'>$vdo_name</span></a></li>";
					}
				}	echo $img_cnts;
				$img_cnts .="</ul></div></div>";	
				
			}
			else{
				echo "<div class='container'><div class='well show-grid'><h3>Will be updated soon.</h3></div></div>";
			}
			
		}
	}
	else{
		echo "<div class='container'><div class='well show-grid'><h3>Will be updated soon.</h3></div></div>";
	}
?>