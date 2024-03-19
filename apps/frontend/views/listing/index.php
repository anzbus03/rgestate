<style> .padding-0{ padding:0px !important;}.margin-0{ margin:0px !important;}

.nxtNew{ margin-left:-15px;  margin-right:-15px; }
._ba2wq3.nssNxt {

    margin-left: -15px !important;
    margin-right: 0px !important;
    

}
#slideSheet.mrsNN {

    margin-left: -15px !important;
    margin-right: 0px !important;
    

}
.listing_pageStyleN  .col-sm-3 { padding-right:0px }
</style>
<div id="map_locator">
<?php $this->renderPartial('_filter_html_top_map');?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page',array('full_width'=>true)); 
}
else{ ?>
        <div class="container margin-top-40" id="">
            <div class="row hFrwo margin-0">
                <div class="col-sm-4 padding-0 margin-0">
                    <span class="ak_text margin-0" id="loader_againn">
                      
                               <?php 
                                if(!empty($title)){
    									    	echo Yii::t('trans', '{c} properties  available on {t} ' ,array('{c}'=>$adsCount ,'{t}'=> $title ))  ;
    										}else{
    										    echo Yii::t('trans', '{c} properties  available' ,array('{c}'=>$adsCount ))  ;
    							}
                                ?> 
                                  
                    </span>
                </div>
            </div>
            <div class="row hFrwo margin-0">
                <div class="col-md-6 padding-0">
                  <h3 class="headline  margin-bottom-10 margin-left-0"><?php 
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
                                        
                                        ?>
                                        
                                        </h3>
                </div>
                  <div class="col-sm-3 pull-right padding-right-0" style="max-width:135px;">
                    <div class="map_btns text-right miniHidden xxsHidden">
						<?php $get =$_GET ; $get['view'] = 'map' ;?> 
                        <a href="<?php echo  Yii::app()->createUrl('listing/index', array_filter($get) );?>" title="Map View" class="map_icon disabled gridIcon">
                            <i class="fa fa-map"></i>
                        </a> 
                        <a href="javascript:void(0)" title="Grid View" class="th_icon gridIcon">
                            <i class="fa fa-th"></i>
                        </a> 
                    </div>
                </div>
               
                <div class="col-sm-3  pull-right">
                    <div class="ak_search">
                        <div class="form mvn">
                            <div class="horizontalContainer">
                                <div style="flex: 4 1 0%;">
                                    <div class="field mtn pln">
                                        <span id="sortFieldItem" class="fieldItem fieldItemFullWidth select">
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
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            
        </div>
		
		
		<div class="container margin-top-20">
			<?php echo $this->renderPartial('_ad_section_listing');?>
		</div>
		
		<div class="container margin-top-20">
		<div id="slideSheet" class="mrsNN" >
		<ul class="list-group  no-margin no-padding listing_pageStyleN" id="suggestionList">
		<?php
		$works = $ads ; 
		$this->renderPartial('//listing/_list_proprty_only',compact('works','checkIcon','property_of_featured_developers' )); 

		?>		
		<li id="suggest_friends_last_id" style="display:none;"></li>
		</ul>
	

		<div style="clear:both"></div>
		<div class="bar-results bottom">
		<div class="paging-holder">
		<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
		</div>
		</div>
		
		
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		</div>
<div class="clearfix"></div>
</div>
      <?php $limit =  '8' ; ?> 
  		<script type="text/javascript">
									var total_pages =  '<?php  echo (int)$pages->pageSize ;?>'
								var loadingHtml    	= '<a href="javascript:void(0)" class="btn  btn-primary   btn-more btn-lg btn-shadow btn-rounded btn-icon-right disabled"><i class="fa fa-spinner fa-pulse margin-right-10"></i></a>';
								var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   id="refresh_list" ><?php echo  'Load More' ;?></a>';  
								var afterFinishHtml = '';   
								var elementId='slideSheet';
								var appendId='suggest_friends_last_id';
								var scroll=true;
								var limit='<?php echo $limit;?>';
								var offest='<?php echo  $limit;?>';
								var formID  = 'frmId';
								var checkFuture = true ;
								var scroll_Pagination5;
								var busy = false;
								var slug ='<?php echo Yii::app()->createUrl('listing/fetch_work');?>';
								var loadingDiv ; 
								$(document).ready(function () {
										loadingDiv  =  $('.loadingDiv');
										caroselSingleAfter();
									});
 
					var currentPage = 1;
					var intervalID = -1000;				 
					var scroll = true;
					var stopPagination = false;
					$(document).ready(function () {
						  $(window).scroll(function() {
						 
					
						  if($(window).scrollTop() + $(window).height() > $('#slideSheet').height() &&  scroll && !stopPagination) {
							   
							  scroll = false;
							  
							  checkScroll();
						}
						})
					 })
				 
					
	 
                     </script>
                     
                     
<?php } ?>                        
<script>
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index');?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('listing/autocomplete');?>';
  $(function(){ changeForm() ;   })
</script>
 <style>
	 #suggestionList .col-sm-3:nth-child(4n+1){ clear:both; }
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
  
  
