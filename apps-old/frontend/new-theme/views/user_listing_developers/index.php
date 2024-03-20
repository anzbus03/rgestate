<?php $apps = $this->app->apps; ?>
<link href="<?php echo $apps->getBaseUrl('assets/new/css/developer_listing_style.css');?>" rel="stylesheet" />
<style>
   .top_dev2 .t-Cards {
   border-bottom: #d8d8d8 solid 1px;
   margin: 0 11px;
   padding: 0 !important;
   padding-bottom: 0px;
   padding-bottom: 45px !important;
   }
   child(5n+1), .t-Cards--cols .t-Cards-item:nth-child(2n+1) {
   clear: both;
   }
   .t-Cards--4cols .t-Cards-item {
   width: 25%;
   }
   .t-Cards--3cols .t-Cards-item, .t-Cards--4cols .t-Cards-item, .t-Cards--5cols .t-Cards-item, .t-Cards--cols .t-Cards-item {
   float: left;
   }
   .top_developer li {
   margin: 0;
   padding: 0;
   }
   .t-Cards-item {
   display: block;
   }
   .t-Cards-item {
   position: relative;
   }
   .top_developer .t-Cards .t-Cards-item .t-Card {
   margin: 0;
   width: 100%;
   }
   .top_developer .t-Card, .top_developer .t-Card-wrap {
   border-radius: 0;
   position: relative;
   width:100% !important; 
   }
   .t-Cards--featured .t-Card {
   overflow: hidden;
   }
   .t-Card {
   display: flex;
   transition: all .1s ease-out;
   box-shadow: 0 2px 4px -2px rgba(0,0,0,.075);
   }
   Cards-item:nth-child(3) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(7) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(8) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(10) .t-Card-wrap {
   background-color: #f1f1f1;
   }
   .top_developer .t-Card-wrap {
   border: 1px solid #d8d8d8;
   }
   element {
   }
   .t-Cards--featured .t-Card .t-Card-body, .t-Card--featured .t-Card-body {
   background-color: transparent;
   }
   .t-Cards--featured .t-Card .t-Card-body {
   border-top: 1px solid rgba(0,0,0,.05);
   padding: 24px 16px;
   }
   .top_developer .t-Card-body {
   display: none;
   }
   element {
   }
   .top_developer .t-Cards-item:nth-child(3) .t-Card-wrap {
   border-left: 1px solid #f1f1f1;
   border-right: 1px solid #f1f1f1;
   }
   .top_developer .t-Cards-item:nth-child(1) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(3) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(7) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(8) .t-Card-wrap, .top_developer .t-Cards-item:nth-child(10) .t-Card-wrap {
   background-color: #f1f1f1;
   }
   .new_dev_list .t-Card-titleWrap{
   max-height: 135px !imprtant;
   overflow: hidden;
   background-color: #fafafa;
   padding: 0 !important;
   }
   .container-max {
    max-width: 1170px;
    width: 100%;
    margin-left: auto !important;
    margin-right: auto !important;
    padding: auto;
}
 .t-Body-title {
    background-color: #fafafa !important;
}
.t-BreadcrumbRegion-body {
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    line-height: 1.6rem;
}
.t-BreadcrumbRegion-body, .t-BreadcrumbRegion-title {
    overflow: hidden;
}
.t-BreadcrumbRegion--showBreadcrumb .t-BreadcrumbRegion-breadcrumb {
    display: block;
}
.t-Breadcrumb {
    list-style: none;
    padding: 0;
    margin: 0;
    vertical-align: top;
}
.t-Breadcrumb-item::after {
    color: rgba(0,0,0,0.75);
}
 
.gallery-container a:link, .gallery-container a:visited, .master-ds_v8 .tagsCloud17 a, a:link, a:visited {
    color: #1f4f82;
    text-decoration: none;
    display: inline-block;
}
.t-BreadcrumbRegion--useBreadcrumbTitle .custom-breadcrumb-v1 .t-Breadcrumb-item:last-child {
    color: #61757c !important;
}
.t-BreadcrumbRegion--useBreadcrumbTitle .t-Breadcrumb-item:last-child, .t-BreadcrumbRegion-titleText {
    margin: 0;
    display: block;
    font-size: 3.2rem;
    line-height: 4.8rem;
    text-overflow: ellipsis;
    overflow: hidden;
}
.t-BreadcrumbRegion--useBreadcrumbTitle .t-Breadcrumb-item:last-child, .t-Button {
    position: relative;
}
.t-BreadcrumbRegion--useBreadcrumbTitle .t-Breadcrumb-item:last-child .t-Breadcrumb-label {
    overflow: hidden;
    display: block;
}
.t-BreadcrumbRegion--useBreadcrumbTitle .t-BreadcrumbRegion-title {
    display: none !important;
}
.t-BreadcrumbRegion {
    padding: 16px;
}
a.btn-primary { color:#fff ; } 
</style>
<form id="myForm_agents">
  <div class="main-search-container dark-overlay ak_listing_banner" style="height:200px; ">
          <div class="main-search-inner">
            <div class="container">
              <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                <h2 style="margin-bottom: 0px; font-weight: 600;">Find Nearby Real Estate</h2>
                <h4 style="margin-top: 0px; color: #fff;">Explore top-rated    developers   </h4>
                <div class="main-search-input">
                  <div class="main-search-input-item ak_language_field">
				   <?php $languages = States::model()->AllListingStatesOfCountry($countryModel->country_id);?>
                    <select data-placeholder="Agents/Developers" class="chosen-select" name="agent_regi" >
                      <option value=''>All Region (<?php echo $countryModel->country_name;?>)</option>
                      <?php
                      foreach($languages as $k=>$v){
						  $selected = $v->state_id==$agent_regi ? 'selected=true' : '';
						  echo '<option value="'.$v->state_id.'" '.$selected .'>'.$v->state_name.'</option>';
					  } 
					  ?>
                    </select>
                  </div>
                  <div class="main-search-input-item ak_search_field">
                    <input type="text" name="property" placeholder="Search developers ,  property .." value="<?php echo $this->app->request->getQuery('property','');?>"/>
                    <input type="hidden" name="country_id"   value="<?php echo $countryModel->country_id;?>"/>
                  </div>
                  <button class="button" onclick="search_byAjax2();return false;">Search</button>
                </div>
              </div>
              <div class="col-md-1"></div>
            </div>
          </div>
        </div>
        
        <!-- Video -->
        <div class="video-container">
          <video poster="<?php echo $this->appAssetUrl('images/main-search-video-poster.jpg');?>" loop autoplay muted>
            <!-- <source src="images/dubai-city.mp4" type="video/mp4"> -->
          </video>
        </div>
      </div>
 </form>
 <script>
	 var mainListUrl = '<?php echo Yii::app()->createUrl('user_listing_developers/index',array('country'=>$countryModel->slug))?>';
 function search_byAjax2(){
			var containerID =  document.getElementById('map_locator');
			formData = $('#myForm_agents :input').serialize();
			$('#lodr').html('loading resiluts.Please wait...')
			$.pjax({url: mainListUrl , container:containerID,  timeout: 110000 ,cache:false ,data: formData  }).complete(function(){		});
			 
			
			
			}
 </script>
<?php $limit =  '12' ; ?> 
<style>.ak_lisitng_agents .item_ko .listing-item-content .ak_agent_content p{ text-overflow:ellipsis;overflow: hidden; }.chosen-container .chosen-results li.highlighted {color:#8898 !important; } </style>
<script type="text/javascript">  
	var loadingHtml    	= '<a href="javascript:void(0)" class="btn   button   btn-primary btn-more btn-lg btn-shadow btn-rounded btn-icon-right disabled"><i class="fa fa-spinner fa-pulse margin-right-10"></i></a>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn button   btn-primary  btn-shadow btn-rounded btn-icon-right"   id="refresh_list" >Load More</a>';  
	var afterFinishHtml = '';   
	var elementId='slideSheet';
	 var emptyResult = '<div class="txtC ajaxLoaded" style="padding: 20px 0px;width:100%"><div class="text-center"><div class="h1">No Developers Found</div><img alt="No homes found" src="//static.trulia-cdn.com/images/search-web/no_results.svg" style="width: 100%; max-width: 300px; min-width: 240px;"> </div></div>';

	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'myForm_agents';
	var checkFuture = true ;
	var scroll_Pagination5    ;
	var slug ='<?php echo Yii::app()->createUrl('user_listing_developers/fetch_user',array('user_type'=>$user_type));?>';
	//scrollPaginationMain(limit='3',offest='0',elementId='slideSheet',appendId='suggest_friends_last_id',slug='<?php echo Yii::app()->createUrl('list/fetch_work');?>',scroll=false,loadingHtml,loadMoreHtml,afterFinishHtml);
 
 
</script>  
