<?php
	
		$sqrynws_mst ="select 
						   nwsm_id,nwsm_name,nwsm_desc,nwsm_sts,
						   nwsm_dwnfl,nwsm_prty
					   from 
						   nws_mst
					   where 
						   nwsm_sts ='a'";
	
			if(isset($_REQUEST['nwsid']) && trim($_REQUEST['nwsid']!="")){
			$ary_nwsid_val= explode('_',glb_func_chkvl($_REQUEST['nwsid']));
			 $nwsid	   = $ary_nwsid_val[1];
			 //$nwsid 	  = glb_func_chkvl($_REQUEST['nwsid']);	
			 $sqrynws_mst1 = $sqrynws_mst." and  nwsm_id = $nwsid";
			 $srsnws_mst = mysqli_query($conn,$sqrynws_mst1);
			 $serchres=mysqli_num_rows($srsnws_mst);
			 if($serchres == 0){
			 	 echo "<script>location.href='".$rtpth."news-all.php'</script>";
				 exit();	
			 }
			 else{
				$srownws_mst = mysqli_fetch_assoc($srsnws_mst);
				$news_name   = $srownws_mst['nwsm_name'];	
				$news_desc   = html_entity_decode(stripslashes($srownws_mst['nwsm_desc']));	
			
			  	$dsply_nws ="";	    
			   $dsply_nws .="<div class='page-header'> <h1 class='pageTitle'><span>$news_name </span></h1>
			  	<ul class='breadcrumb'>
				<li><a href='".$rtpth."home'>Home</a></li>
				<li ><a href='".$rtpth."news-all'>News</a></li><li class='active'>$news_name </li>
      			</ul></div>";
				if($news_desc != ''){
					$dsply_nws .="<p>$news_desc</p>";
				}else{
					$dsply_nws .="";
				}
				$db_catlogflenm  	= trim($srownws_mst['nwsm_dwnfl']);
				$flepth		   		= $u_dwnfl_upldpth.$nwsid."-".$db_catlogflenm;
				if(($db_catlogflenm != "") && file_exists($flepth)){
				
					$dsply_nws .="<a href='$flepth' class='btn btn-success btn-xs pull-left' target='_blank'>Download</a>";
				
				}
				
			$dsply_nws .="<p><a href='".$rtpth."news-all' class='btn btn-success btn-xs pull-right'><i class='icon-arrow-left'></i> Go Back</a></p></div>";
		    echo $dsply_nws ;
		}
	}
	else{
		$sqrynws_mstall = $sqrynws_mst." order by nwsm_prty desc limit $offset,$rowsprpg ";
		$srsnws_mst = mysqli_query($conn,$sqrynws_mstall);
		$serchres=mysqli_num_rows($srsnws_mst);
		if($serchres > 0){
		$dsply_news = "<div class='col-md-9 col-sm-9'><div class='page-header'> <h1 class='pageTitle'><span>News</span></h1>
						  <ul class='breadcrumb'>
							<li><a href='".$rtpth."home'>Home</a></li>
							<li class='active'>News</li>
						  </ul></div><ul class='list'>";
			while($srownws_mst = mysqli_fetch_assoc($srsnws_mst)){
					  $nwsid   = $srownws_mst['nwsm_id'];
					   $newsname = $srownws_mst['nwsm_name'];
					   $tp_unewsname = funcStrRplc($newsname);
				$dsply_news .="<li><a href='$rtpth"."news-details/$tp_unewsname"._."$nwsid '>$newsname</a></li>";
			}
			$dsply_news .="</ul></div>";		
			
			$dsply_news .="<div class='pgnum'>";   

				$rdval   =  $loc;			
				$disppg  =  funcDispPagTxt('',$rdval,$sqrynws_mst,$rowsprpg,$cntstart,$pgnum,'y','nwsm_ID');
				$dsply_news .= $disppg;		
			
			$dsply_news .= "</div>";
		}
		else{
			$dsply_news .= "<ul class='aboutpage'><font color='red'>Will be updated soon</font></ul>";		
		}	
		
	    echo $dsply_news;
	}
?>