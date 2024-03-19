<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class ListingController extends Controller
{
   
	public function init(){
	 
	  parent::Init();
       
    }
	 
	 
    public function actionIndex($country=null,$state=null,$type=null,$community=null,$sec=null)
    {  
	 if(!empty($_GET['view'])){
		 switch ($_GET['view']){
			 case 'list' :
			 $cookie = new CHttpCookie('view', 'index');
			 $cookie->expire = time()+60*60*24*180; 
			 Yii::app()->request->cookies['view'] = $cookie;
			 $file_view = 'index';
			 break;
			 default:
			 $cookie = new CHttpCookie('view', 'index_map');
			 $cookie->expire = time()+60*60*24*180; 
			 Yii::app()->request->cookies['view'] = $cookie;
			 $file_view = 'index_map';
			 break;
		 }
		 unset($_GET['view']);
		  $this->redirect(Yii::app()->createUrl('listing/index', array_filter($_GET)));exit;
	 }
	 else{
		 $file_view = isset(Yii::app()->request->cookies['view']) ? Yii::app()->request->cookies['view']->value : 'index_map';
	 }
	 print_r($_GET);exit; 
 $url_request =  Yii::app()->request->url;
	//preg_match('/'.BREAK_PATH.'(.*)/',$url_request, $str);  
	//$search_url = !empty($str[1]) ? $str[1] : ''; 
	$search_url = $url_request; 
	if(Yii::app()->user->getId()){
	$found_search = UserSearches::model()->findByAttributes(array('url'=>$search_url,'user_id'=>Yii::app()->user->getId()));
	}
	 
	 $this->layout =  'listing';
	 $load_location = array();
	 $active_state  = false; 
	 $country_id=null;
	 $state_id=null;
	 if($type=='new-development'){
		 $section_title = 'New Development';
	 }
	 else if($type=='new-homes'){
		  $section_title = 'New Homes';
	 }
	 else{
		 $section_title = 'New Properties';
	 }
	 $formData = array_filter((array)$_GET);
	 
	 $country_name = '';
	 $state_name = '';
	 if(!empty($state)){
		$stateModel =  States::model()->checkEnableForlisting($state);
		if(empty($stateModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$section_title .= ' in '.$stateModel->state_name;
		$country_name = $stateModel->country_name ;
		$state_name =    $stateModel->state_name;
		$active_state = $stateModel->state_id ;
		$state_id= $active_state;
		$country_id = $stateModel->country_id ;
		$load_location =  States::model()->AllListingStatesOfCountry($stateModel->country_id,7);
	 }
	 else if(!empty($country)){
		 $countryModel =   Countries::model()->checkEnableForlisting($country);
		 if(empty($countryModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$country_id=$countryModel->country_id;
		$section_title .= ' in '.$countryModel->country_name;
		$country_name = $countryModel->country_name ;
		$load_location =  States::model()->AllListingStatesOfCountry($countryModel->country_id,7);
	 }
	 
	 $title = '';
	 if(!empty($community)){
		 $communityModel = Community::model()->findByPk($community);
		 if($communityModel){
			 $community_name = $communityModel->community_name ; 
		 }
	 }
 
	if(empty($community_name)){   $title = $state_name .','.$country_name; }else{ $title =  $community_name. ',' .$state_name ; }
	$title = ltrim($title,',');
	$criteria =  PlaceAnAd::model()->findAds($formData,false,1);
	$adsCount = PlaceAnAd::model()->count($criteria);
 
		$pages = new CPagination($adsCount);
		$pages->pageSize = $this->app->options->get('system.common.poperties_for_one_page','8');
		$pages->applyLimit($criteria);
		
	 
		$ads = PlaceAnAd::model()->findAll($criteria);
	 
	$filterModel = new PlaceAnAd();
	$filterModel->attributes = $formData; 
	$filterModel->section_id = @$formData['sec'];
	if($country_id){
	$filterModel->country = $country_id; 
	}
	 if($this->app->request->isAjaxRequest){
		   
			$this->renderPartial($file_view,compact('search_url','found_search','load_location','active_state','section_title','country_id','state_id','ads','adsCount','pages','state_name','country_name','country','state','title','community','filterModel','formData')); 
			$this->app->end();
	 }
	switch($filterModel->section_id){
	        case 'property-for-sale':
	            $pageMetaTitle       = 'Property for Sale | Find Flats & Houses for Sale';
	            $pageMetaDescription = 'Askaan has variety of properties for sale throughout the world you can search according to your country. We are listing largest collection of new and resale houses.';
	        break;
	        case 'property-for-rent':
	            $pageMetaTitle       = 'Property for Rent |  Find Flats & Houses for Rent';
	            $pageMetaDescription = 'Askaan has variety of properties for rent throughout the world, you can search according to your country as well. We are listing largest collection of new, rent houses & apartments.';
	        break;
	        case 'new-development':
	            $pageMetaTitle       = 'New Property Developments';
	            $pageMetaDescription = 'Buy your own Home now with our property new development listings.Buy off plan properties and find many new real estate projects';
	        break;
	        default:
	            $pageMetaTitle       = 'Property for Sale | Property for rent | New Property Developments';
	            $pageMetaDescription = '';
	        break;
	}
	 $this->setData(array(
            'pageMetaTitle'           => $pageMetaTitle, 
            'pageMetaDescription'     => $pageMetaDescription, 
            'noFooter'     => '1', 
         
            ));
	$apps = $this->app->apps;
	$currency_code =  $filterModel->currencyTitle ; 
	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/pajax.js'), 'priority' => -100));
	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/autocomplete.min.js'), 'priority' => -100));     
	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/askaan_list_common.js?q=2'), 'priority' => -100));
	//$this->getData('pageScripts')->add(array('src' =>  $apps->getBaseUrl('assets/js/googlele_marker.min.js'), 'priority' => -1000));
	if($file_view=='index'){
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js'), 'priority' => -100));
	}
	else{
		$this->getData('pageScripts')->add(array('src' => 'https://maps.googleapis.com/maps/api/js?libraries=places&key='.$this->options->get('system.common.google_map_api_keys','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ'), 'priority' => -1000));
	
	}
		 
		 
	 $this->render( $file_view,compact('search_url','found_search','load_location','active_state','currency_code','section_title','country_id','state_id','ads','adsCount','pages','state_name','country_name','country','state','title','community','filterModel','formData')); 
 
    } 
    public function actionFetch_work($count_future=true,$calculate=false,$country_id2=false,$state_id2=false,$is_form=false,$hide_featured=false ){
		$request = Yii::app()->request;
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData);
			 
		}
		else{
		$formData = array_filter((array)$_GET);
		}
		$works =   PlaceAnAd::model()->findAds($formData,$count_future,false,$calculate);
		if(!$hide_featured){
		if(!empty($country_id2) or !empty($state_id2))  {
		$offset_n = Yii::app()->request->getQuery('offset','0');
			$limit_n  = Yii::app()->request->getQuery('limit','10');
			if($offset_n=='0'){ 
				$new_offset = 0; 
			}
			else{
			$new_offset = 2*($offset_n/$limit_n)+1;
			}
			 
		//	$property_of_featured_developers         = Developer::model()->featured_developers($country_id2,$state_id2,2,0,true,$offset_n );
		 }
		 }
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
							if(!$hide_featured){
							$msgHTML .= $this->renderPartial('//listing/_list_proprty_only',compact('works','checkIcon','property_of_featured_developers' ),true); 
							}else{
								$msgHTML .= $this->renderPartial('//listing/_list_proprty_only',compact('works','checkIcon','property_of_featured_developers' ),true); 
							
							}
							if(!empty($count_future)){
							    if($total!=false){
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result,'total'=>$total));
								}
								else{
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result ));
								}
							}
							else{
								echo   $msgHTML; 
							}
		}
		else{
			echo '1'; 
		}
		Yii::app()->end();
	}
	public function actionAutocomplete($query)
    {
        $request = Yii::app()->request;
        if (!$request->isAjaxRequest) {
             // $this->redirect(Yii::app()->createUrl('site/index'));
        }
        $criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name,cn.slug as country_slug,t.slug,cm.community_id,cm.community_name';
		$criteria->join = 'INNER JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->join .= 'LEFT JOIN {{community}} cm ON cm.region_id  = t.state_id  ';
		$criteria->condition = 'cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
		$criteria->condition .= ' and  ( CASE WHEN community_name IS NOT NULL THEN  ( CONCAT(state_name, " ", country_name," ",community_name) like  :term  ) ELSE ( CONCAT(state_name, " ", country_name) like  :term  ) END  )  ' ;
		$criteria->order  = 'cm.community_name asc , t.state_name asc , cn.country_name asc ' ;
        $criteria->params[':term'] = '%'.$query.'%' ;
        $criteria->limit = 10;
        $models = States::model()->findAll($criteria);
        $results = array();
        $loaded_state =array();
        if($models){
			foreach ($models as $model) {
				
			   
				if(empty($model->community_name)){   $title = $model->state_name .','.$model->country_name; }else{ $title =  $model->community_name. ',' .$model->state_name; }
				if(!in_array($model->state_id,$loaded_state) and !empty($model->community_name) ){
					$results['suggestions'][] = array(
					'country_id' => $model->country_slug,
					'state_id'  => $model->slug,
					'community_id'  => '',
					'value'       =>   $model->state_name .','.@$model->country_name  ,
					'data'       =>  $model->country_slug,
					);
					 $loaded_state[$model->state_id] = $model->state_id;
				}
				 
			 
				$results['suggestions'][] = array(
					'country_id' => $model->country_slug,
					'state_id'  => $model->slug,
					'community_id'  => $model->community_id,
					'value'       =>  $title,
					'data'       =>  $model->country_slug,
				);
				 
			}
		}
		else{
			$results['suggestions'] = array();
		}
       
        return $this->renderJson($results);               
    }
    
     public function actionFetch_work2($count_future=true,$calculate=false,$country_id2=false,$state_id2=false,$is_form=false,$hide_featured=false ){
		$request = Yii::app()->request;
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData);
			 
		}
		else{
		$formData = array_filter((array)$_GET);
		}
		$works =   PlaceAnAd::model()->findAds($formData,$count_future,false,$calculate);
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
						 
						    $msgHTML .= $this->renderPartial('//listing/_list_projects',compact('works','checkIcon','property_of_featured_developers' ),true); 
							if(!empty($count_future)){
							    
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result ));
								 
							}
							else{
								echo   $msgHTML; 
							}
		}
		else{
			echo '1'; 
		}
		Yii::app()->end();
	}

}
