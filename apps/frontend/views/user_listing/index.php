<style>
.ak_rent_sec , .listing-item-container { box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16),0 0 0 1px rgba(0,0,0,0.08);  }
.ak_lisitng_agents { background:#fff;}
</style>
<form id="myForm_agents">
  <div class="main-search-container dark-overlay ak_listing_banner">
          <div class="main-search-inner">
            <div class="container">
              <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                <h2 style="margin-bottom: 0px; font-weight: 600;">Find Nearby Real Estate</h2>
                <h4 style="margin-top: 0px; color: #fff;">Explore top-rated   agents </h4>
                <div class="main-search-input">
					<div class="main-search-input-item ak_language_field">
				   <?php $states = States::model()->AllListingStatesOfCountry($countryModel->country_id);?>
                    <select data-placeholder="Agents/Developers" class="chosen-select" name="agent_regi" >
                      <option value=''>All Region (<?php echo $countryModel->country_name;?>)</option>
                      <?php
                      foreach($states as $k=>$v){
						  $selected = $v->state_id==$agent_regi ? 'selected=true' : '';
						  echo '<option value="'.$v->state_id.'" '.$selected .'>'.$v->state_name.'</option>';
					  } 
					  ?>
                    </select>
                  </div>
                
                  <div class="main-search-input-item ak_search_field">
                    <input type="text" name="property" placeholder="Search agents ,  property .. " value="<?php echo $this->app->request->getQuery('property','');?>"/>
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
	 var mainListUrl = '<?php echo Yii::app()->createUrl('user_listing/index',array('country'=>$countryModel->slug))?>';
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
	 var emptyResult = '<div class="txtC ajaxLoaded" style="padding: 20px 0px;"><div class="text-center"><div class="h1">No Agents Found</div><img alt="No homes found" src="//static.trulia-cdn.com/images/search-web/no_results.svg" style="width: 100%; max-width: 300px; min-width: 240px;"> </div></div>';

	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'myForm_agents';
	var checkFuture = true ;
	var scroll_Pagination5    ;
	var slug ='<?php echo Yii::app()->createUrl('user_listing/fetch_user',array('user_type'=>$user_type));?>';
	//scrollPaginationMain(limit='3',offest='0',elementId='slideSheet',appendId='suggest_friends_last_id',slug='<?php echo Yii::app()->createUrl('list/fetch_work');?>',scroll=false,loadingHtml,loadMoreHtml,afterFinishHtml);
	 
 
</script>  
