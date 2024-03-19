<section>
    <div class="mainDiv" style="margin-top:60px;">
        <div style="margin-top: 10px;" class="container" id="pageContainer">
            <div class="contentdiv searchPage">
                <div class="left_area"> </div>
                <div class="Full-width" id="right_area_div">
                    <h3>
                    <div class="crumbarnewSearch"><span class="headerTextCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>" class="moreu2">Home</a> &gt;   </span>International Properties</div>
                </h3>
                    <div class="bluestrip-div">
                        <div class="MapList_views">

                            <div style="display: none" class="prop-heading-new"></div>
                            <div class="prop-found">
                                <h1><span class="prop-found-txt2" id="PropHeadingText">      International Properties  </span> <span class="prop-found-txt1" id="TotalRecords2" style="float:right"> Showing <?php echo $pages->currentPage*$pages->pageSize+1 ;?> -  <?php echo $pages->currentPage*$pages->pageSize+sizeOf($articles) ;?>  Of  <?php echo $pages->itemCount;?> Results </span></h1>
                            </div>
                           

                     

                        </div>

                    </div>




                    
                    <div class="save-search-div" style="height:20px;width:100%;clear:both"> </div>
                     
                    <div id="ListViewDetail"> </div>

<?php


 if($articles){
	 foreach( $articles as $k=>$v){
		 $this->renderPartial('listing',array('v'=>$v));
	 }
 }
?>



					 
					 
					<div class="page-ination">
					<div class="page-in">
					<ul class="clearfix">
					<?php 
					//if($pages->itemCount>3){
					$this->widget('frontend.components.web.widgets.SimplaPager', array(
					'pages'=>$pages,'maxButtonCount'=>7,
					));  
					//}
					?>
					</ul>
					 
					</div>
					</div>
				 

                </div>

            </div>


            <div class="footerbarline">
                <div class="colorline-1"></div>
                <div class="colorline-2"></div>
            </div>

        </div>

    </div>
 
</section>
 
