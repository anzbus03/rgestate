<div id="map_locator">
<?php $this->renderPartial('_filter_html_top_map');?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page'); 
}
else{ ?> 
          <div class="columns">
                <div id="leftColumn" class="leftColumn">
                    <div id="scrollContent">
                        <div id="srpHeaderLeftColumn" class="plm">
                            <div data-reactroot="" data-reactid="1" data-react-checksum="-652063423">
                                <div data-reactid="2">
                                    <div data-reactid="3">
                                        <h2 class="h3" data-reactid="4"><?php echo Yii::t('trans','{location} for {section} ',array('{location}'=>$title, '{section}'=>$filterModel->SectionViewTitle));?></h2>
                                        <h2 class="h6 typeLowlight pbs" data-reactid="5" id="loader_againn"><?php echo $adsCount;?> properties  available on <?php echo $title;?></h2>
                                    </div>
                                    <!-- react-empty: 6 -->
                                </div>
                                <div class="miniHidden xxsHidden" data-reactid="7">
                                    <div class="form mtn horizontalContainer mrm" data-reactid="8">
                                        <div class="field mtn" style="flex:1;" data-reactid="9">
                                            

                                            


                                            <div class="fieldGroup fieldGroupInline" data-reactid="10">
                                            

                                                <div class="col-sm-6" style="padding-left:0px;">
                                                <span id="sortFieldItem" class="fieldItem fieldItemFixedWidth select" data-reactid="11">
                                                    <div class="selectPretty" data-reactid="12">
                                                        <select id="sortingOptions" data-reactid="13" name="sort"  onchange="alertthisVal(this);setThisValueSort(this)">
														<?php 
														$sortArray = $filterModel->sortArray();
														foreach($sortArray as $k=>$v){
														echo '<option value="'.$k.'">'.$v.'</option>';
														} 
														?>
                                                        </select>
                                                        <div class="selectDisplay btn btnDefault" data-reactid="23"><span class="selectLabel" data-reactid="24"><?php echo $filterModel->sortHTml;?></span><span class="selectTrigger" data-reactid="25"><i class="fa fa-chevron-down" data-reactid="26"></i></span></div>
                                                    </div>
                                                </span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="map_btns text-right miniHidden xxsHidden">
														<?php $get =$_GET ; $get['view'] ='list'?> 
                                                        <a href="<?php echo  Yii::app()->createUrl('listing/index', array_filter($get) );?>" class="th_icon disabled gridIcon"  title="Grid View" ><i class="fa fa-th"></i></a>
                                                        <a href="javacript:void(0)"  title="Map View" class="map_icon gridIcon">
                                                            <i class="fa fa-map"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-reactid="27">
                                    <!-- react-empty: 28 --><!-- react-empty: 29 -->
                                </div>
                            </div>
                        </div>
                        <div id="resultsColumn">
                            <div class="resultsColumn" style="overflow:hidden;" data-reactroot="" data-reactid="1" data-react-checksum="1963441139">
                                <div id="openHouseData" data-reactid="2"></div>
                                <!-- react-empty: 17 --><!-- react-empty: 18 --><!-- react-empty: 19 -->
                                <div class="backgroundControls" data-reactid="20">
                                    <div data-reactid="21">
                                        <!-- react-empty: 22 -->
                                        <div class="containerFluid" data-reactid="23">
                                            <ul class="mvn row" data-reactid="24">
												<?php
												foreach($ads as $k=>$v){ ?> 
                                                <li class="xsCol12Landscape smlCol12 lrgCol8" data-reactid="<?php echo $v->id;?>">
                                                    <div class="ptm cardContainer positionRelative clickable" data-reactid="<?php echo $v->id;?>">
                                                        <div class="card backgroundBasic" data-reactid="<?php echo $v->id;?>">
                                                            <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed" aria-label="Save Home" data-reactid="<?php echo $v->id;?>"><span><i class="" data-reactid="30"></i><i class="iconHeartEmpty typeReversed iconOnly" data-reactid="31"></i></span></button>
                                                            <div itemscope="" itemtype="http://schema.org/SingleFamilyResidence" data-reactid="32">
                                                                <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" class="hideVisually" data-reactid="33">
                                                                    <span itemprop="streetAddress" data-reactid="34"><?php echo $v->AdTitle;?></span>
                                                                    <span itemprop="addressLocality" data-reactid="35">
                                                                        <?php echo $v->state_name;?>
                                                                    </span>
                                                                    <span itemprop="addressRegion" data-reactid="39">
                                                                        <!-- react-text: 40 -->NY<!-- /react-text --><!-- react-text: 41 --> <!-- /react-text -->
                                                                    </span>
                                                                    <span itemprop="postalCode" data-reactid="42">Postal Here</span>
                                                                </span>
                                                                <span itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates" data-reactid="43">
                                                                    <meta itemprop="latitude" content="40.768948" data-reactid="44"/>
                                                                    <meta itemprop="longitude" content="-73.98412" data-reactid="45"/>
                                                                </span>
                                                            </div>
                                                            <div data-reactid="46">
                                                                <a href="<?php echo  $v->DetailUrl;?>" class="tileLink" alt="<?php echo $v->AdTitle;?>" rel="noopener" target="_blank" data-reactid="47">
                                                                    <div class="overlayContainer" data-reactid="48">
                                                                        <div class="cardPhoto backgroundPulse " style="height:160px;width:100%;" data-reactid="49">
                                                                            <picture data-reactid="50">
                                                                                <source srcset="images/ISy7gpv4h55hkz0000000000.jpg" media="(min-resolution: 192dpi)" data-reactid="51"/>
																				<?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
																				<img class="cardPhoto backgroundPulse "  src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=160&w=325&zc=1" alt="">
                                                                            </picture>
                                                                            <div class="tagsListContainer" data-reactid="53">
                                                                                <!-- react-text: 54 --><!-- /react-text --><!-- react-text: 55 --><!-- /react-text -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="backgroundBasic" style="z-index:3;" data-reactid="56">
                                                                        <div class="cardDetails man pts pbn phm h6 typeWeightNormal" data-reactid="57">
                                                                            <div data-reactid="58">
                                                                                <span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59"><?php echo $v->PriceTitle;?></span><!-- react-empty: 60 -->
                                                                            </div>
                                                                            <div data-reactid="61">
                                                                                <ul class="listInline typeTruncate mvn" data-reactid="62">
                                                                                    
                                                                                    <li data-auto-test="beds" data-reactid="">  <i class="iconBed" data-reactid=""></i><?php echo $v->BedroomTitle;?></li>
                                                                                    <li data-auto-test="baths" data-reactid=""><i class="iconBath" data-reactid=""></i><?php echo $v->BathroomTitle;?></li>
                                                                                    <?php
                                                                                    if(!empty($v->builtup_area)){ ?> 
                                                                                    <li data-auto-test="sqft" data-reactid=""><?php echo  $v->BuiltUpAreaTitle;?> </li>
                                                                                    <?php } ?> 
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="<?php echo  $v->DetailUrl;?>" class="tileLink phm" alt="<?php echo $v->AdTitle;?>" rel="noopener" target="_blank" data-reactid="">
                                                                    <div class="addressDetail" data-reactid="72">
                                                                        <div class="h6 typeWeightNormal typeTruncate typeLowlight mvn" data-reactid=""><?php echo $v->AdTitle;?></div>
                                                                        <div class="cardFooter man ptn pbs" data-url="" data-reactid="">
                                                                            <div class="typeTruncate typeLowlight" data-reactid="">
                                                                                <?php echo $v->LocationTitle;?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                    </ul>
                                        </div>
                                        <div class="clearfix" data-reactid="1441"></div>
                                    </div>
                                  
                                    <div class="backgroundBasic" data-reactid="1442">
                                        <div class="paginationContainer pls mtl ptl mbm" data-reactid="1443">
                                            <div class="txtC" data-reactid="1444">
											<?php 	
											$this->widget('frontend.components.web.widgets.SimplaPager', array(
											'pages'=>$pages,
											// 'route' => 'user/AjaxDetails',
											)); ?>
                                          </div>
                                          <?php
                                          if(!empty($adsCount)){
											  ?>
								 
                                            <div class="txtC h6 typeWeightNormal typeLowlight" data-reactid="1465">Showing page <?php echo $pages->currentPage+1;?>   of <?php echo $pages->pageCount;?> Pages </div>  
                                            <?php } ?>
                                        </div>
                                        <div class="mtm plm txtC " data-reactid="1466">
                                            <span data-reactid="1467">
												<?php if(!empty( $country_name)){ ?> 
												<a href="#" data-reactid=""><?php echo $country_name;?></a></span>
												
												<?php } ?> 
												<?php if(!empty( $state_name)){ ?> 
													&nbsp&nbsp<i class="fas fa-angle-right" data-reactid=""></i><span data-reactid="">
												<a href="#" data-reactid="">&nbsp&nbsp<?php echo $state_name;?></a> </span> <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mtl phm backgroundWhite" style="display:flex;" data-reactid="1475">
                                    <div class="box backgroundBasic mbm mts pal" style="position:static;">
                                        <div class="boxHead">
                                            <h2 class="typeEmphasize h4">
                                                Dubai Real Estate Insights
                                            </h2>
                                        </div>
                                        <div class="boxBody">
                                            <!-- <div class="h7">
                                                <p>New York is located in New York.</p>
                                            </div> -->
                                            <div class="h7">
                                                <p>The restaurants in Dubai are some of the best you will ever experience - there are several options such as Chinese, pizza and halal. The nightlife in this city has a lot to offer; there is always a good place to start for a fun night out with friends. The center of all things entertainment, you can satisfy all of your senses with the museums, performing arts spots and music halls here. If you get bored easily and love physical activity, with a selection of activities such as biking, playing at the park and day camps here you will never find yourself wishing there was more to do. Featuring many stores such as luggage stores, pop-up shops and bespoke tailors, shopping in this location won't be an issue for anyone at all. Whether you're a regular commuter or just have the occasional need to get into or around town, the excellent public transport network in Dubai makes it easy. If you don't like having to commute by car, you should keep in mind that many people here avoid that issue by walking to work; it's just one of the things that makes this city appealing.</p>
                                            </div>
                                            <div class="h7">
                                                <p>While many properties in Dubai are owned, most are not inhabited by their owners. If you settle in this location, you will realize that many of your neighbors here have a college diploma. Dubai has plenty of unmarried folks so it is perfect if you'd prefer an area without too many children around.</p>
                                            </div>
                                            <div class="h7">
                                                <p>The average real estate listing price this year is $3,630,328 in Dubai, a noticeable increase of 8.7 percent compared to the year prior. Year-over-year, <a href="/real_estate/New_York-New_York/market-trends/">inventory marginally declined 0.2 percent</a>, from 4,461 listings to 4,453 homes on the market. A handful of homes around New York have stunning views of the East River that are especially wonderful to gaze at during the summer months. Some homes in this city have large closets, enabling you to keep your living space clear and free from clutter. Quite a few residential properties in this city feature rooftop pools so you can sit back and enjoy the views while hosting a pool party for your friends.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- react-empty: 1 -->
                </div>
           
            <?php   
            
		}
               $this->renderPartial('_map_view');?>
            
            <div style="clear:both"></div>
</div>
            <script>
			var timer_ajax; 
			var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index');?>';
			var autoCompleteUrl = '<?php echo Yii::app()->createUrl('listing/autocomplete');?>';
			$(function(){ changeForm() ; })
            </script>
            <style>
				.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; cursor:pointer ;  }
				.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
				.autocomplete-selected { background: #F0F0F0; }
				.autocomplete-suggestions strong { font-weight: normal; color: #000; }
				.autocomplete-group { padding: 2px 5px; }
				.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
				
				.btnTertiary, .btnTertiary:visited, a.btnTertiary, a.btnTertiary:visited {
				border: 1px solid #FF5A5F;
				background: #fff;
				color: #FF5A5F;
				font-weight: 600;
				}
			    .btnTertiary:hover  { background: #FF5A5F;color:#fff; border: 1px solid #FF5A5F; } 
            </style>
			<style>.boxCard{ display:none; }.opened .boxCard{ display:block !important; }</style>
                                                          
