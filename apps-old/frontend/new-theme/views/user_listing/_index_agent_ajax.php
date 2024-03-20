<?php
if (Yii::app()->request->isAjaxRequest) {
	?><script>$('body').attr("id","user_listing");</script>
		<script>$('body').attr("id","user_listing");$('#hl_agents').addClass('active');</script>
		<title><?php  echo  $pageTitle ;  ?></title>
		<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
		<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">

	<?php 
}
$this->renderPartial('_filter_html_top_agents');?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page',array('full_width'=>true)); 
}
else{   
	?>
<div class="container margin-top-40" id="">
           
            <div class="row hFrwo margin-0">
                <div class="col-md-6 padding-0 the-head-sorter">
                  <h3 class="headline  margin-bottom-0 margin-left-0"><?php echo $title ;?> <?php echo $this->tag->getTag('real_estate_agents','Real Estate Agents');?></h3>
                            <div class=" row col-sm-12 padding-0 margin-0">
                    <span class="  margin-0" id="loader_againn">
                      
                               <?php 
                                if(!empty($title)){
    									    	echo Yii::t('trans', $this->tag->getTag('{c}_agents_available_in_{t}','{c} agents available in {t}') ,array('{c}'=>$adsCount ,'{t}'=> $title ))  ;
    										}else{
    										    echo Yii::t('trans', $this->tag->getTag('{c}_agents_available','{c} agents available') ,array('{c}'=>$adsCount ))  ;
    							}
                                ?> 
                                  
                    </span>
                </div>
         
                </div>
           
             <div class="col-md-6 padding-0 the-head-sorter text-right mcheckboxSorter">
                 <input class="checkbox-tools" type="radio" name="order" id="tool-5" <?php if(!isset($formData['order']) or ( isset($formData['order']) and  $formData['order']=='')){ echo 'checked'; } ?>  onchange="changeOrder(this)" value="" >
						<label class="for-checkbox-tools" for="tool-5">
							<?php echo $this->tag->getTag('default','Default');?>
						</label>
					 <input class="checkbox-tools" type="radio" name="order" id="tool-1" <?php if(isset($formData['order']) and $formData['order']=='verified'){ echo 'checked'; } ?>  onchange="changeOrder(this)" value="verified" >
						<label class="for-checkbox-tools" for="tool-1">
							<?php echo $this->tag->getTag('verified','Verified');?>
						</label><!--
						--><input class="checkbox-tools" type="radio" name="order" id="tool-2" <?php if(isset($formData['order']) and $formData['order']=='featured'){ echo 'checked'; } ?> onchange="changeOrder(this)"   value="featured" >
					
						<label class="for-checkbox-tools" for="tool-2">
							<?php echo $this->tag->getTag('featured','Featured');?>
						</label><!--
						--> 
					   </div>
					   <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
             <div class="row hFrwo margin-0  " >
             </div>
          
        </div>
        	 
    
<div class="container margin-top-20" id="d_column">
		<div id="slideSheet" class="mrsNN mb-5" >
		<ul class="list-group  no-margin no-padding listing_pageStyleN mul-li" id="suggestionList">
		<?php
		$works = $ads ; 
		 $this->renderPartial('_list_agent_new',compact('works','checkIcon','property_of_featured_developers' )); 

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
<?php } ?> 
<div class="clearfix"></div>
<?php $Str = array_filter ((array)$formData);
$Stri =''; 
if(!empty($Str)){
	foreach($Str as $k=>$v){
		$Stri .= '/'.$k.'/'.$v; 

	}
}
?> 
<style>
#user_listing .listing-item{width:180px;float:left;background:#fff;border-radius:0}html[dir="rtl"] #user_listing .listing-item {float:right; }#user_listing .listing-item-content{width:calc(100% - 190px);float:right}#user_listing .ajaxLoaded2{margin-bottom:16px;box-shadow:0 1px 6px 0 rgba(32,33,36,.28)}._czm8crp{margin:0!important;overflow-wrap:break-word!important}._6joo1h{color:#008489!important}._6joo1hb{color:#ff5a5f!important}._18ilrswp{margin:0!important;overflow-wrap:break-word!important;line-height:1}

 </style>
<script>
var mainListUrl2 =  '<?php echo Yii::App()->createUrl('user_listing/agents');?>';
	var loading_results = '<?php echo $this->tag->getTag('loading_results._please_wait..','loading results. Please wait...');?>';
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('user_listing/Fetch_user');?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('user_listing/autocomplete');?>';
 
</script> 
	<script type="text/javascript">
	var stopPagination;
	var loadingHtml    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div><div class="clearfix"></div><div style="    clear: both;    margin-top: 30px;    font-weight: 600;"><?php echo $this->tag->getTag('loading','Loading...');?><div></div></div>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScrollUser();"  id="refresh_list" ><?php echo $this->tag->getTag('load_more','Load More') ;?></a>';  
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
	var slug ='<?php echo Yii::app()->createUrl('user_listing/Fetch_agent').$Stri;?>';


	</script>
  

	<script type="text/javascript">

	$(document).ready(function () {
	         const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();
 
	$(window).scroll(function() {
	if($(window).scrollTop() + $(window).height() > $('#d_column').height() &&  scroll && !stopPagination) {
		scroll = false;
		 checkScrollUser();
	}
	})
	})
	
	</script> 
 

