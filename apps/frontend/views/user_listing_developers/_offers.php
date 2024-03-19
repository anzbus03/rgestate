	
					<div class="row margin-top-90">
						<div class="col-xs-12 col-sm-9">
							<h5 class="subtitle-margin">TOP</h5>
							<h1>Projects<span class="special-color">.</span></h1>
						</div>
						  
					</div>

<div class="col-xs-12" style="padding-left:0px">
							<div class="title-separator-primary"></div>
						</div>
						<div class="clearfix"></div>
 <div class="row">
      <div class="col col-12 ">
         <div class="t-Region t-Region--hideShow container-max comman_collapse projects_list43 projects_new shadow_cards_boxs_in dev_projects_list  proj_list_new_color  is-expanded t-Region--scrollBody a-Collapsible" id="project" aria-live="polite">
         
            <div class="t-Region-bodyWrap">
               <div class="t-Region-buttons t-Region-buttons--top">
                  <div class="t-Region-buttons-left"></div>
                  <div class="t-Region-buttons-right"></div>
               </div>
               <div class="t-Region-body a-Collapsible-content" id="a_Collapsible2_project_content"  style="padding-top:0px; " aria-hidden="false">
                  <div id="slideSheet" style="padding:0px;margin:0px;">
                     <ul class="t-Cards t-Cards--featured t-Cards--cols t-Cards--animRaiseCard" style="padding:0px;margin:0px; " id="suggestionList">
                      <li id="suggest_friends_last_id" style="display:none;"></li>
                     </ul>
                     <table class="t-Report-pagination" role="presentation"></table>
					<div style="clear:both;margin-top:20px;"></div>
					<div class="bar-results bottom">
					<div class="paging-holder">
					<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
					</div>
					</div>
					<div class="clearfix"></div>

                  </div>
               </div>
              
               <div class="t-Region-buttons t-Region-buttons--bottom">
                  <div class="t-Region-buttons-left"></div>
                  <div class="t-Region-buttons-right"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
  
 <form id="myForm_agents">
	<input type="hidden" name="user_id" value="<?php echo $model->user_id;?>" />
	</form>
<style>
	a.btn-primary { color:#fff; }
	.ak_lisitng_agents .item_ko .listing-item-content .ak_agent_content p{ text-overflow:ellipsis;overflow: hidden; }.chosen-container .chosen-results li.highlighted {color:#8898 !important; } </style>
 <?php $limit =  '8' ; ?> 
<script type="text/javascript">
	var loadingHtml    	= '<a href="javascript:void(0)" class="btn button  btn-primary    disabled new_load" style="padding:15px 40px; "></a>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn button  btn-primary  btn-shadow btn-rounded btn-icon-right"   id="refresh_list" >Load More</a>';  
	var afterFinishHtml = '';   
	 var emptyResult = '<div class="txtC ajaxLoaded" style="padding: 20px 0px;margin:auto;"><div class="text-center"><div class="h1">No Result Found</div><img alt="No homes found" src="//static.trulia-cdn.com/images/search-web/no_results.svg" style="width: 100%; max-width: 300px; min-width: 240px;"> </div></div>';

	var elementId='slideSheet';
	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'myForm_agents';
	var checkFuture = true ;
	var scroll_Pagination5    ;
	var slug ='<?php echo Yii::app()->createUrl('listing/fetch_work2',array('count_future'=>1,'is_form'=>'1','hide_featured'=>'1'));?>';
	//scrollPaginationMain(limit='3',offest='0',elementId='slideSheet',appendId='suggest_friends_last_id',slug='<?php echo Yii::app()->createUrl('list/fetch_work');?>',scroll=false,loadingHtml,loadMoreHtml,afterFinishHtml);
	$(document).ready(function () {
		scrollPagination2(); 
	});
 
</script> 

