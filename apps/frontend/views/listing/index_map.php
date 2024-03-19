<div id="map_locator">
<?php $this->renderPartial('_filter_html_top_map');?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page'); 
}
else{ ?> 
          <div class="columns" style="width:100%;">
                <div id="leftColumn" class="leftColumn">
                    <div id="scrollContent">
                        <div id="srpHeaderLeftColumn" class="plm">
                            <div data-reactroot="" data-reactid="1" data-react-checksum="-652063423">
                                <div data-reactid="2">
                                    <div data-reactid="3">
                                        <h2 class="h3" data-reactid="4"><?php 
                                        switch($filterModel->section_id){
                                        case  'new-development':
                                        $tt =   'New Developments' ;
                                        break;
                                        case '':
                                        $tt =  Yii::t('trans','Explore {p}' ,array('{p}'=>$this->options->get('system.common.site_name')))  ;
                                        break;
                                        default:
                                        $tt = Yii::t('trans',  'Property for {c}' ,array('{c}'=> $filterModel->SectionViewTitle ));
                                        break; 
                                        }
                                        if(!empty($title)){ 
                                        echo Yii::t('trans', '{s} in {l}' ,array('{l}'=>$title, '{s}'=>$tt));
                                        }else{
                                        echo $tt;
                                        }
                                         
                                         
                                         ?></h2>
                                        <h2 class="h6 typeLowlight pbs" data-reactid="5" id="loader_againn">
                                            
                                            <?php 
                                            if(!empty($title)){
                                             echo Yii::t('trans', '{c} properties  available on {t} ' ,array('{c}'=>$adsCount ,'{t}'=> $title ))  ;
                                            }else{
                                              echo Yii::t('trans', '{c} properties  available' ,array('{c}'=>$adsCount ))  ;
                                            }
                                            ?> 
                                        </h2>
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
												$apps = Yii::app()->apps; $bg = true ;
												foreach($ads as $k=>$v){
												
												 $s_id ="feat_item1".$v->id ; 
												?> 
                                                <li class="xsCol12Landscape smlCol12 lrgCol8   ajaxLoaded2 mul_sliderh"   id="<?php echo $s_id;?>"  data-reactid="<?php echo $v->id;?>">
                                                  <div class="arws"></div><div class="dots"></div>
                                                    <div class="ptm cardContainer positionRelative clickable" data-reactid="<?php echo $v->id;?>">
                                                        <div class="card backgroundBasic" data-reactid="<?php echo $v->id;?>">
                                                            <button data-test-id="CardSaveButton" class="saveHome <?php echo !empty($v->fav) ?  'active' : '';?> pam   typeReversed" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'savetofavourite(this)'; }else{ echo 'OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                                            <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                                            <i class="descsss"><?php echo !empty($v->fav) ?  'Saved' : 'Save';?></i>
                                                            </button>
                                                             
                                                            <div itemscope="" itemtype="http://schema.org/SingleFamilyResidence" data-reactid="32">
                                                                <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress" class="hideVisually" data-reactid="33">
                                                                    <span itemprop="streetAddress" data-reactid="34"><?php echo $v->AdTitle;?></span>
                                                                    <span itemprop="addressLocality" data-reactid="35">
                                                                        <?php echo $v->state_name;?>
                                                                    </span>
                                                                
                                                                    <span itemprop="postalCode" data-reactid="42">Postal Here</span>
                                                                </span>
                                                                 
                                                            </div>
                                                            <div data-reactid="46">
                                                                 
																	<nav class="navbar navbar-fixed-left navbar-minimal  " role="navigation"  >
																	<div class="navbar-toggler " onclick="openShareButtons(this,event)">
																	<span class="menu-icon"></span>
																	</div>
																	<ul class="navbar-menu    " style="padding:0px;margin:0px;" >
																	<li>
																	<a href="http://www.facebook.com/sharer.php?u=<?php echo $v->DetailUrlAbsolute;?>&p[title]=<?php echo $v->ad_title;?>;?>" onclick="windowOpenNew(this,event)" class="animate">
																	<span class="desc animate"> Facebbok </span>
																	<span class="fa fa-facebook"></span>
																	</a>
																	</li>
																	<li>
																	<a href="http://twitter.com/share?text=<?php echo $v->ad_title;?>&url=<?php echo $v->DetailUrlAbsolute;?>" class="animate"   onclick="windowOpenNew(this,event)"   >
																	<span class="desc animate"> Twitter</span>
																	<span class="fa fa-twitter"></span>
																	</a>
																	</li>
																	<li>
																	<a href="https://plus.google.com/share?url=<?php echo $v->DetailUrlAbsolute;?>" class="animate"  onclick="windowOpenNew(this,event)"  >
																	<span class="desc animate"> Google+ </span>
																	<span class="fa fa-google-plus"></span>
																	</a>
																	</li>
																	</ul>
																	</nav>
                                                                <a href="<?php echo  $v->DetailUrl;?>" class="tileLink" alt="<?php echo $v->AdTitle;?>" rel="noopener" target="_blank" data-reactid="47">
                                                                    <div class="overlayContainer" data-reactid="48">
                                                                        <div class="cardPhoto backgroundPulse " style="height:160px;width:100%;" data-reactid="49">
                                                                             
                                                                               <div class="single-item-hover"></div>
																			<div class='single-item' >
																			<?php echo $v->generateImage($apps,$h=160,$w=325,$s_id,$bg);?> 
																			</div> 
                                                                           <?php echo $v->SectionBanner;?>
                                                                            <div class="tagsListContainer" data-reactid="53">
                                                                                <!-- react-text: 54 --><!-- /react-text --><!-- react-text: 55 --><!-- /react-text -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="backgroundBasic" style="z-index:3;" data-reactid="56">
                                                                        <div class="cardDetails man pts pbn phm h6 typeWeightNormal" data-reactid="57">
                                                                            <div data-reactid="58">
                                                                                <span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate _doc79r" data-reactid="59"><?php echo $v->PriceTitleSpan;?></span><!-- react-empty: 60 -->
                                                                            </div>
                                                                            <div data-reactid="61">
                                                                                <ul class="listInline typeTruncate mvn" data-reactid="62">
                                                                                    <?php
																					if(!empty($v->bedrooms)){ ?>
                                                                                    <li data-auto-test="beds" data-reactid="">  <i class="fas fa-bed" data-reactid=""></i> <?php echo $v->BedroomTitle;?></li>
                                                                                    <?php } ?>
                                                                                    <?php
																					if(!empty($v->bathrooms)){ ?> 
                                                                                    <li data-auto-test="baths" data-reactid=""><i class="fas fa-bath" data-reactid=""></i> <?php echo $v->BathroomTitle;?></li>
                                                                                    <?php
																					}
                                                                                    if(!empty($v->builtup_area)){ ?> 
                                                                                    <li data-auto-test="sqft" data-reactid=""><?php echo  $v->BuiltUpAreaTitle;?> </li>
                                                                                    <?php } ?> 
                                                                                    <li></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href="<?php echo  $v->DetailUrl;?>" class="tileLink phm" alt="<?php echo $v->AdTitle;?>" rel="noopener" target="_blank" data-reactid="">
                                                                    <div class="addressDetail" data-reactid="72">
                                                                        <div class="h6 typeWeightNormal typeTruncate typeLowlight mvn txt" data-reactid=""><?php echo $v->AdTitle;?></div>
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
                                
                                <?php // $this->renderPartial('_bottom_of listing');?>
                                </div>
                        </div>
                    </div>
                    <!-- react-empty: 1 -->
                </div>
           
            <?php   
            
		
               $this->renderPartial('_map_view');?>
            
            <div style="clear:both"></div>
            </div>
            
            <?php } ?>
</div>
            <script>
			var timer_ajax; 
			var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index');?>/';
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
 	   <script > $(function(){  caroselSingleAfter(); })</script>

                                                  
		
  

