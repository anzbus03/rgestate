<?php
					 
					preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $plan->description, $image);
					if(!empty($image[1])){
					$file =  Yii::app()->apps->getBaseUrlNew('/' , true, true ).$image[1];
					if(@file_get_contents( $file)){
					 $imageExist = $file;
					}

				 }
					  
					  
					 	 ?>
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>

<div id="pageContainer" class="container" style="margin-top: 54px;">
	<?php
	if(!empty($imageExist)){ ?> 
 <div role="main" class="unitpage_imageGallerySlider" id="imageGallerySlider" style="height:auto !important;">
    <section class="slider">
        <div class="loadingFlexslider1"> </div>
                 <div class="flexslider" style="display:none">
                <ul class="slides">
					 
						<li class="img-unit-li" style="width: 965px; float: left; display: block;"> <img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $imageExist   ;?>&w=965&zc=1"   class="img-vert-align" style=" width:965px;"></li>
						 
                  
                </ul>
        </div>
    </section>
</div>
<?php
}
?>
<div class="bluestrip-unitpage">
                <div class="back-search right-tab-div right20padd"><a href="<?php echo Yii::app()->createUrl('floor-plan');?>">Back to floor plans</a></div>
              
            </div>
            
           <div class="agent-unit-pro-details-div">
    <div class="left-div-cntrol-unit">
        <div class="pro-price-unit1" style="font-size: 16px;">
            <?php      if(sizeOf($list)==1) { echo $plan->project1->project_name ;  } else { echo  $plan->project1->project_name.'- '.$plan->floor_plan_name; }  ?>   
        </div>
         
      
    </div>
    
    <div class="unit_lower">
      
    <div class="div-hr1-unit"></div>
    <div class="overview-control-div"> 
        <div class="stagc-loc-txt"> 
        <span class="stagc-loc-txt-span2"><?php  
        $content = preg_replace("/<img[^>]+\>/i", "",  $plan->description ,1 ); 
         echo    $content ;?></span>
        </div>
    </div>
     <?php
							if($list)
							{
							  ?><div class="stagc-loc-txt-span2" >
								  <div>
							    <h3>Floor Palns</h3>
							    <div style="clear:both"></div>
							    </div>
							  <div style="width:100%;margin-bottom:10px;clear:both">
								
							  <?php
							  foreach($list as $k=>$v)
							  {
								  ?>
								   <li>
						 <a href="<?php echo Yii::app()->createUrl($v->slug.'/floorPlan');?>">
							<?php
							if(sizeOf($list)==1)
							{ echo  $v->project1->project_name;  } 
							else { echo  $v->project1->project_name.'- '.$v->floor_plan_name; } 
							?>
						  </a></li>
								 	  <?
							  }
							  ?>
							  <div style="clear:both"></div>
							  </div>
							  </div>
							  <?
							}
							?>
			 
</div>
</div>
</div>
</div>
    <style>

.image-row ul li {
    display: inline;
    list-style: outside none none;
    text-align: center;
}
.image-row li {
    display: inline !important;
    float: left;
    margin: 0 0 15px;
    width: 220px;
}

.image-row .image-row-holder {
    display: inline;
    height: auto;
    width: auto;
}

#floorplans a, #amenities a {
    color: #44484b;
    font-size: 13px;
    font-weight: bold;
}
    </style>
 <style>
	 /*----- Tabs -----*/
.tabs {
    width:100%;
    display:inline-block;
}
 
    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }
 
    .tab-links li {
        margin:0px 5px;
        float:left;
        list-style:none;
        width:auto;
    }
 
        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:#7FB5DA;
            font-size:16px;
            font-weight:600;
            color:#4c4c4c;
            transition:all linear 0.15s;
        }
 
        .tab-links a:hover {
            background:#a7cce5;
            text-decoration:none;
        }
 
    li.active a, li.active a:hover {
        background:#fff;
        color:#4c4c4c;
    }
 
    /*----- Content of Tabs -----*/
    .tab-content {
        padding:15px;
        border-radius:3px;
        box-shadow:-1px 1px 1px rgba(0,0,0,0.15);
        background:#fff;
        border:0px;
        overflow:auto;
    }
 
        .tab {
            display:none;
        }
 
        .tab.active {
            display:block;
        }
        .textct img
        {
			width:100% !important;
		}
		.image-row-holder img
		{
			width:180px !important;
		}
       .pcaption{
		   padding:0px;
	   }
 </style>
			<script>
			jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
			</script>	
