<section>
    <div class="mainDiv" style="margin-top:60px;">
        <div style="margin-top: 10px;" class="container" id="pageContainer">
            <div class="contentdiv searchPage">
                <div class="left_area"> </div>
                <div class="Full-width" id="right_area_div">
                    <h3>
                    <div class="crumbarnewSearch"><span class="headerTextCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>" class="moreu2">Home</a> &gt;   </span>New <?php echo Yii::t('app',FloorPlan::AlternateFloorPlanText);?></div>
                </h3>
                    <div class="bluestrip-div">
                        <div class="MapList_views">

                            <div style="display: none" class="prop-heading-new"></div>
                            <div class="prop-found">
                                <h1><span class="prop-found-txt2" id="PropHeadingText">      New <?php echo Yii::t('app',FloorPlan::AlternateFloorPlanText);?> </span> </h1>
                            </div>
                        </div>
                    </div>
                    
                    <div class="save-search-div" style="height:20px;width:100%;clear:both"> </div>
                    <div id="mainContentsPlaceHolder_UnitSearchRepeaterControl_adbanner">
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
                    <div id="ListViewDetail"> </div>

 

 <div class="span8">
              <?php
              if($article)
              {
				  foreach($article as $k=>$v)
				  {
					   if(!empty($v->project))
					  {
					  ?>
					  <div style="width:49.5%;float:left;padding-right:10px;">
					  <div  class="prop-found-new"  style="width:auto;" >  <span class="prop-found-txt3"><?php echo    $v->name;  ?></span></div>
					  <div>
					 
						  <ul>
							  <?php
							  foreach($v->project as $k2=>$v2)
							  {
								  ?>
								   <li><a href="<?php echo Yii::app()->createUrl($v2->slug.'/floorPlan');?>"><?php echo $v2->project_name;?></a></li>
								  <?
							  }
							  ?>
						 
						  </ul>
						 
					  </div>
					  </div>
					  <?php
				  }
				  }
			  }
			  ?>
			  <div style="clear:both"></div>
            </div>

					 
					 
					<div class="page-ination">
					<div class="page-in">
					 
					 
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
 
<style>
			table
			{
			border:0px !important;
			}
			table tr th {
			background: #967930 none repeat scroll 0 0;
			color: #fff;
			padding: 10px 0;
			font-size: 16px;
			font-weight: 400;




			}
			td:nth-child(2) {  text-align:center;  }
			td 
			{
			padding: 10px 0;
			border:0px;
			}
			tr
			{
			background: #fff none repeat scroll 0 0;
			border-bottom: 1px solid #dddddd;

			text-indent: 20px;
			font-size: 14px;

			}
			tr:nth-child(even) {
			background: #fff5db none repeat scroll 0 0;
			margin: 0;
			}


.span8 ul {
    
    list-style:   disc;
    margin: 10px 0 10px  0px;
}

.span8 ul  li {
    
    margin-left:4px;
}
 
 
 
.span8  {
    
 padding:0px 10px;
}

.span8 ul li::before {
    clear: both;
    color: #d30e7d;
    content: "•";
    float: left;
    font-family: FontAwesome;
    font-size: 14px;
    margin-right: 4px;
   
}
.span8 ul li a {
    color: #842a8b;
    display: block;
    font-size: 12px;
   
    margin: 5px 0 0;
    text-align: justify;
}
			</style>
