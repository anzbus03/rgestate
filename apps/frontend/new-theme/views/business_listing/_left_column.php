 <style>body{ overflow-y :hidden !important;; }</style>
 <div class="row row sh-mobile restuls-list headertit inside-h">
                <div class=" col-sm-12 desc-row2 padding-left-0">
                  <h3 class="_jmmm34f  margin-bottom-0 for-mb">
                    <?php  
                                        echo  Yii::t('trans', ' {cnt}    {p} ' ,array('{p}'=>  $m_title   ,'{cnt}'=> $adsCount  ));
                                         if(!empty($userM)){
											 echo ' <small class="user-nameing secname_'.$filterModel->section_id.'"><b>['.$userM->fullName.']</b></small>';
										}
					?>
					</h3>
					</div>
				
             <div class="  sh-mobile  padding-right-0 the-head-sorter text-right mcheckboxSorter pull-right">
					   <div  style="display:flex;" class="a_<?php echo $l_view;?>">
					    <?php
					    if($l_view=='map'){ ?> 
							    <a href="javascript:void(0)"    onclick="changeViewN4(this)" data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="list"   class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"  data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="grid" onclick="changeViewN4(this)"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                        
                     
				        <a data-val="map"   class="newheader_dropdown_action_item header_link listh viewersp active" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
                      
						<?php }
						else { ?> 
				        <a href="javascript:void(0)"    onclick="changeViewN2(this)" data-val="list"  class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"   onclick="changeViewN2(this)" data-val="grid"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                        
                     
				        <a data-val="map" onclick="changeViewN2(this)" data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" class="newheader_dropdown_action_item header_link listh viewersp" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
                          <?php } ?> 
                       
                        
				       </div>
				       <script>var list_view_url =  '<?php echo Yii::app()->createUrl('site/setview_list');?>';</script>
				        
			 </div>
            </div>
            
        
        <div class="container   list-container-rx" id="" style="width:100%; ">
			<div class="">
            <div class="">
                <div class="col-sm-12 padding-left-0">
                    <span class="ak_text margin-left-0" id="loader_againn">
                               
                    </span>
                </div>
            </div>
            <div class=" ">
                <div class="col-sm-12 desc-row2 padding-left-0">
                  <h3 class="_jmmm34f  margin-bottom-0   mt-3 mb-3" style=" font-size: 20px !important;font-weight: 600 !important;line-height: 1 !important;margin-bottom: 20px !important;margin-top: 20px !important;">
                    <?php  
                                        echo  Yii::t('trans', ' {cnt}    {p} ' ,array('{p}'=>  $m_title   ,'{cnt}'=> $adsCount  ));
                                         if(!empty($userM)){
											 echo ' <small class="user-nameing secname_'.$filterModel->section_id.'"><b>['.$userM->fullName.']</b></small> <a href="'.$this->app->createUrl('listing/index',array('sec'=>$filterModel->section_id)).'"><img src="'.$this->app->apps->getBaseUrl('assets/img/cancel.png').'" style="width:15px; "/></a>'; 
										}
					?>
					</h3>
					</div>
				 
             
            </div>
            </div>
        </div>
		
                    <div id="scrollContent">
                        <div id="srpHeaderLeftColumn" class="plm">
                            <div data-reactroot="" data-reactid="1" data-react-checksum="-652063423">
                                <div data-reactid="2">
                                    <div data-reactid="3">
                                         
                                    </div>
                                    <!-- react-empty: 6 -->
                                </div>
                                <div class="miniHidden xxsHidden" data-reactid="7">
                                    <div class="form mtn horizontalContainer mrm" data-reactid="8">
                                        <div class="field mtn" style="flex:1;" data-reactid="9">
                                            

                                            


                                            <div class="fieldGroup fieldGroupInline" data-reactid="10">
                                            
 
			<div class="clearfix"></div>
			
			

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
                        <div class="clearfix">
						 <div class="map-fetaured">
                          <div class="clearfix"></div>
                         </div>
                        </div>   
                        
                        <div id="resultsColumn" class="index_list maker_adjust listView ">
							 <div class="resultsColumn container  list" style="overflow:hidden;max-width:100% !important;" id="d_column" data-reactroot="" data-reactid="1" data-react-checksum="1963441139">
													<div class="maker_adjust <?php echo $filterModel->section_id == 'new-development' ? 'projects' : '';?> filterModel_<?php echo $filterModel->section_id;?>" > 

													<?php 
													$latitude  = 0;
													$longitude  = 0; 
													if(!empty($ads)){
													$works = $ads;
													$latitude  = $ads[0]->location_latitude;
													$longitude  = $ads[0]->location_longitude;  
													$this->renderPartial('//business_listing/_list_proprty_business',compact('ads' ,'works' ));

													echo '<div id="suggest_friends_last_id"></div><div class="clearfix"></div>	';
													if(sizeOf($ads) >= $limit){
													echo '<p class="text-center loadingDiv"><a href="javascript:void(0)" onclick="checkScrollMpa();" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"><span>'.$this->tag->getTag('load_more','Load More').'</span> <i class="fa fa-arrow-right"></i></a></a></p>';
													}
													}
													?><div class="clearfix"></div>
													</div>
                                
                                </div>
                        </div>
<script>
var my_logitude1 =    <?php echo isset($_GET['lg']) ? floatval($_GET['lg']) :  floatval($longitude) ;?> ;
var my_latitude2 =     <?php echo isset($_GET['lt']) ? floatval($_GET['lt']) : floatval($latitude) ;?> ;
 
var my_bound =     <?php echo isset($_GET['lt']) ? 0 : 1 ;?> ;

 var zoom = <?php echo isset($_GET['zoom']) ? $_GET['zoom'] : 5 ;?>; 
  

var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('listing/autocomplete');?>';
// $(function(){ changeForm() ;   })
 $(function(){ closeOpendDiv() ; activatelistSearchFixed()  })
</script> 
<?php $str = http_build_query(array_filter(array_replace(array('state_id2'=>$state_id),$_GET))) ; ; ?> 
	<script type="text/javascript">
	var stopPagination;
	var loadingHtml    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div><div class="clearfix"></div><div style="    clear: both;    margin-top: 30px;    font-weight: 600;"><span><?php echo $this->tag->getTag('loading_more_properties,_pleas','Loading more properties, please wait.');?></span><div></div></div>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScrollMpa();"  id="refresh_list" ><span><?php echo $this->tag->getTag('load_more','Load More') ;?></span> <i class="fa fa-arrow-right"></i></a>';  
	var afterFinishHtml = '';   
	var elementId='slideSheet';
	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'frmId';
	var checkFuture = true ;
	var loadingDiv ;
	$(document).ready(function () {
	loadingDiv  =  $('.loadingDiv');
	});
	var currentPage = 1;
	var scroll_Pagination5;
	var slug ='<?php echo Yii::app()->createUrl('listing/fetch_work').'?strl=1&'.$str;?>';


	</script>
  

	<script type="text/javascript">
	$(document).ready(function () {
	     const observer = lozad(); // lazy loads elements with default selector as '.lozad'
 observer.observe();
		   caroselSingle3(); 
		$('#sortingOptions').select2();
	$('#mainColumn').scroll(function() {
	if($('#mainColumn').scrollTop() +  $('#mainColumn').height() > $('#d_column').height() &&  scroll && !stopPagination) {
		scroll = false;
		 checkScrollMpa(); 
	}
	})
	})
	
	</script> 
