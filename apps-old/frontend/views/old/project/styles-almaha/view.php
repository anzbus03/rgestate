<?php
					 
					preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $article->description, $image);
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
	if(!empty( $imageExist)){ ?> 
	<div role="main" class="unitpage_imageGallerySlider" id="imageGallerySlider" style="height:auto;">
    <section class="slider">
        <div class="loadingFlexslider1"> </div>
                 <div class="flexslider" style="display:none">
                <ul class="slides">
					 
						<li class="img-unit-li" style="width: 965px; float: left; display: block;"> <img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php echo   $imageExist;?>&w=965&zc=1"   class="img-vert-align" style="width:965px;"></li>
						 
                  
                </ul>
        </div>
    </section>
	</div>
	<?php }
	?>
<div class="bluestrip-unitpage">
                <div class="back-search right-tab-div right20padd"><a href="<?php echo Yii::app()->createUrl('project');?>">Back to new Development</a></div>
              
            </div>
            
           <div class="agent-unit-pro-details-div">
    <div class="left-div-cntrol-unit">
        <div class="pro-price-unit1" style="font-size: 16px;">
            <?php echo $article->name;?>  
        </div>
         
      
    </div>
    
    <div class="unit_lower">
      
    <div class="div-hr1-unit"></div>
    <div class="overview-control-div"><span class="ovr-vw-txt"><?php echo $article->name;?> Overview</span>
        <div class="stagc-loc-txt"> 
        <span class="stagc-loc-txt-span2"><?php
        $content = preg_replace("/<img[^>]+\>/i", "",  $article->description ,1 ); 
         echo $content;?></span>
        </div>
    </div>
     <?php
							if($relatedProject)
							{
							  ?><div class="stagc-loc-txt-span2" >
								  <div>
							    <h3>List of projects in  <?php echo  $article->name;?></h3>
							    <div style="clear:both"></div>
							    </div>
							  <div style="width:100%;margin-bottom:10px;clear:both">
								
							  <?php
							  foreach($relatedProject as $k=>$v)
							  {
								  ?>
								  <li><a target="_blank" href="<?php echo Yii::app()->createUrl($v->slug.'/floorPlan');?>"><?php echo $v->project_name;?></a></li>
							
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
 

.stagc-loc-txt-span2   li {
    float: left;
    margin-right: 20px;
     list-style:disc;
    width: 100%;
    margin-left:10px;
    line-height:25px;
    
}
.stagc-loc-txt-span2   li a {
    
    color:#002d72;
}
 
 
 </style>
