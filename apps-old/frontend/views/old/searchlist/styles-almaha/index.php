<section>
    <div class="mainDiv margin-top-240">
        <div style="margin-top: 10px;" class="container" id="pageContainer">
            <div class="contentdiv searchPage">
                <div class="left_area"> </div>
                <div class="Full-width" id="right_area_div">
                    <h3>
                    <div class="crumbarnewSearch"><span class="headerTextCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>" class="moreu2">Home</a> &gt; <a href="/" class="moreu2"> <?php echo Countries::model()->getDefaultCountry();?></a> &gt; </span>Property search</div>
                    <div class="ListingRightAnchor"><span class="headerTextCrumbar"><a href="<?php echo Yii::app()->createUrl('floor-plan');?>" class="moreu2 moreBoldlink"><?php echo Yii::t('app',FloorPlan::AlternateFloorPlanText);?></a></span></div>
                    </h3>
                    <div class="bluestrip-div">
                        <div class="MapList_views">

                            <div style="display: none" class="prop-heading-new"></div>
                            <div class="prop-found">
                                <h1><span class="prop-found-txt2" id="PropHeadingText"><?php   if(!empty($propertytitle)) { echo $propertytitle;  } else { echo 'Property Listing'; } ?> </span><?php if(!empty($models)){ ?> <span class="prop-found-txt1" id="TotalRecords2" style="float:right"> Showing <?php echo $pages->currentPage*$pages->pageSize+1 ;?> -  <?php echo $pages->currentPage*$pages->pageSize+sizeOf($models) ;?>  Of  <?php echo $pages->itemCount;?> Results </span><?php } ?></h1>
                            </div>
                        

                        </div>

                    </div>




                    <div clientidmode="static" runat="server" id="dvSubNaviInner" class="Sort_by">
                        <div class="Sort-txt">Sort by:</div>
                        <ul>
							<?php 
							$sectionId = '';
							if(Yii::app()->request->getQuery('slug') == 'property-for-sale'){
								$sectionId=PlaceAnAd::SALE_ID;
							}
							if(Yii::app()->request->getQuery('slug') == 'property-for-rent'){
								$sectionId=PlaceAnAd::RENT_ID;
							}
							?>
                            <li class="Sort_by-li3"><a <?php echo  (Yii::app()->request->getQuery("order")=="newest"  )? "class=Highlighted" : ""; ?>   id="HighPriceClick" onclick="submitAs('newest',<?php echo $sectionId;?>)" href="javascript:void(0);">Newest</a><span></span>
                            </li>
                            <li class="Sort_by-li2"><a <?php echo  (Yii::app()->request->getQuery("order")=="low-to-high" )? "class=Highlighted" : ""; ?>   id="LowestPriceClick" onclick="submitAs('low-to-high',<?php echo $sectionId;?>)" href="javascript:void(0);">Lowest</a><span></span>
                            </li>
                            <li class="Sort_by-li4"><a <?php echo  (Yii::app()->request->getQuery("order")=="high-to-low" )? "class=Highlighted" : ""; ?>   id="NewestListings" onclick="submitAs('high-to-low',<?php echo $sectionId;?>)" href="javascript:void(0);">Highest</a><span></span>
                            </li>
                            <li class="Sort_by-li5"><a <?php echo  (Yii::app()->request->getQuery("order")=="featured" or Yii::app()->request->getQuery("order")=="" )? "class=Highlighted" : ""; ?>   id="MostViewdClick" onclick="submitAs('featured',<?php echo $sectionId;?>)" href="javascript:void(0);">Featured</a>
                            </li>
                        </ul>
                    </div>
                   <?php /*
                    <div id="mainContentsPlaceHolder_UnitSearchRepeaterControl_adbanner" >
                        <div class="sidebar-banner">
                            <div class="homepage-banner">
                                <!-- START Ad Peeps Ad Code -->
                                <p align="center" class="down_para_home">
                                    <a target="_blank" href="http://ads.bhomes.com/adpeeps.php?bf=go&amp;uid=100000&amp;bzone=728x90-ads_rotation&amp;bsize=728x90&amp;bmode=order&amp;btype=1&amp;bpos=default">
                                        <img width="728" height="90" border="0" title="Click Here!" alt="Click Here!" src="http://ads.bhomes.com/adpeeps.php?bf=showad&amp;uid=100000&amp;bzone=728x90-ads_rotation&amp;bsize=728x90&amp;bmode=order&amp;btype=1&amp;bpos=default">
                                    </a>
                                </p>
                                <!-- END Ad Peeps Ad Code -->
                            </div>
                        </div>

                    </div>
                    * */ ?>




                    <div id="ListViewDetail"> </div>

<?php


 if($models){
	 foreach( $models as $k=>$v){
		 $this->renderPartial('listing',array('property'=>$v));
	 }
 }
 else{
	 ?>
	 <div class="icon-main-div">
                    <div class="icon-div"></div>
                    <span class="icon-div-txt">Sorry it didn't find any property at this time.</span> 

<style>
  
 
.icon-main-div {
    height: 64px;
    margin: 21px 0 0 150px;
    padding-top: 0;
    width: 380px;
}
   
.icon-div-txt {
    color: #d4117e;
    display: block;
    float: left;
    font-size: 14px;
    font-weight: normal;
    margin:53px 0 0;
    width: 280px;
}
  
  </style>
</div>
	 <?
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
<script>
	function submitAs(order,section){
		$('#section').val(section);
		$('#order').val(order);
		$('#formId').submit();
	}
</script>
