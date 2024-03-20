<?php defined('MW_PATH') || exit('No direct script access allowed');



class ListingController extends Controller
{

	public function init()
	{

		parent::Init();
	}

	public function actionIndex($country = null, $state = null, $city = null, $type = null, $community = null, $sec = null, $category = null, $dealer = null, $loc = null)
	{
		
		define('ITS_LIST_PAGE', '1');
		if (isset($_GET['reg'])) {
			if (!isset($_GET['state'])) {
				$_GET['state'] = $_GET['reg'];
			}
			unset($_GET['reg']);
		}

		$country_id = COUNTRY_ID;

		$l_view = 'list';


		if ($sec == 'Property') {
			$sec = '';
			$_GET['sec'] = '';
		};
		if (isset($_GET['reg'])) {
			if ($_GET['reg'] == '-') {
				$_GET['reg'] = '';
			};
		}
		if (isset($_GET['state'])) {
			if ($_GET['state'] == 'property' or $_GET['state'] == 'all') {
				$state = '';
				$_GET['state'] = '';
				$_GET['state'] = '';
			};
		}
		if (isset($_GET['type_of']) and $_GET['type_of'] == 'property') {
			unset($_GET['type_of']);
			//if($_GET['state']=='property' or $_GET['state']=='all'){  $state='' ;$_GET['state']= '';$_GET['state']='';  };  
		}
		if (isset($_GET['sec']) and $_GET['sec'] == 'for-sale-and-rent') {
			unset($_GET['sec']);
		}
		if (isset($_GET['type_of']) and $_GET['type_of'] == 'all') {
			unset($_GET['type_of']);
		}

		switch ($sec) {
			case 'preleased':
				$_GET['sec'] = '';
				$sec = '';
				$_GET['preleased'] = '1';
				define('PRELE', '1');

				if (!isset($_GET['category'])) {
					$_GET['category'] = 'commercial';
				}

				break;
			case 'for-sale':
				$_GET['sec'] = 'property-for-sale';
				$sec = 'property-for-sale';
				if (!isset($_GET['catgory'])) {
					$_GET['catgory'] = 'commerical';
				}
				break;
			case 'to-rent':
				$_GET['sec'] = 'property-for-rent';
				$sec = 'property-for-rent';
				if (!isset($_GET['catgory'])) {
					$_GET['catgory'] = 'commerical';
				}
				break;
			case 'for-rent':
				$_GET['sec'] = 'property-for-rent';
				$sec = 'property-for-rent';

				break;
		}

		if (!isset($_GET['category']) and  in_array($sec, array('preleased', 'for-sale', 'to-rent', 'to-rent', 'property-for-sale', 'property-for-rent'))) {
			$_GET['category'] = 'commercial';
		}
		$location_title = '';
		$areaData = States::model()->all_cities_list(); // print_r($areaData);exit; 
		if (isset($_GET['state']) and !empty($_GET['state'])) {
			if (isset($areaData[$_GET['state']])) {
				$selectedArea = $areaData[$_GET['state']];
				$location_title .= $selectedArea['name'] . ',';
				$areaData[$_GET['state']]  =  array_merge($selectedArea, array('selected' => true));
			}
		}
		if (isset($_GET['area']) and !empty($_GET['area'])) {
			$areas = array_filter(explode(':', $_GET['area']));
			if (!empty($areas)) {
				$sizeOfarea = sizeOf($areas);
				$sizeOfarea1 = $sizeOfarea - 1;
				$counto = '1';
				foreach ($areas as $kv) {
					$selectedArea = $areaData[$kv];
					if ($sizeOfarea == '1') {
						$location_title .= ' and ' . $selectedArea['name'];
					} else {
						if ($sizeOfarea1 == $counto) {
							$location_title .= $selectedArea['name'] . ' and ';
						} else {
							$location_title .= $selectedArea['name'] . ', ';
						}
					}
					$areaData[$kv]  =  array_merge($selectedArea, array('selected' => true));
					$counto++;
				}
			}
		}

		$areaData = array_values($areaData);
		if ($location_title != '') {
			$location_title = rtrim($location_title, ', ');
		}
		/*
		$regions = 	MainRegion::model()->getStateWithCountry_2datas(COUNTRY_ID);
		$region_with_slug = 	MainRegion::model()->getStateWithCountry_2dataslug(COUNTRY_ID);
		$statesData = States::model()->AllListingStatesOfCountry(COUNTRY_ID); 
		$cityDats = CHtml::listData($statesData,'slug' , 'state_name'); 
		$region_list = CHtml::listData($statesData,'slug' , 'region_id');
		*/

		$apps = $this->app->apps;
		//$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css?q=1'), 'priority' => -100));
		//$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.js?q=1'), 'priority' => -100));

		$state = 'ajman';
		$file_view = 'index';

		if (isset($_GET['view'])) {
			switch ($_GET['view']) {
				case 'map':
					$file_view = 'index_map';
					$l_view = 'map';
					break;
				case 'grid':
					$file_view = 'index';
					$l_view = 'grid';
					break;
			}
		}
		//if((isset($this->app->request->cookies['list_view'])   )){ $l_view  =  $this->app->request->cookies['list_view']->value; if($l_view =='map'){ $file_view = 'index_map';  } 				}
		if ($l_view == 'map' and $this->app->request->isAjaxRequest and !isset($_GET['pja'])) {
			echo '<script>location.reload();</script>';
			exit;
		}
		if (isset($_GET['sec']) and $_GET['sec'] == 'new-development') {
			$file_view = 'index';
		};
		$url_request =  Yii::app()->request->url;

		$search_url = $url_request;
		/*
		if(Yii::app()->user->getId()){
			$found_search = UserSearches::model()->findByAttributes(array('url'=>$search_url,'user_id'=>Yii::app()->user->getId()));
		}
		* */
		$load_location = array();
		$active_state  = false;
		$active_city  = false;
		$country_id = null;
		$state_id = null;


		if (strpos($url_request, 'new-development') !== false) {
			$newMetaTitle =  $this->app->options->get('system.common.devpage_meta_title', 'New Projects');
			$newMetaKeywords = $this->app->options->get('system.common.devpage_meta_keywords', 'New Projects');
			$newMetaDescription = $this->app->options->get('system.common.devpage_meta_description', 'New Projects');
		} else if (strpos($url_request, 'property-for-sale') !== false || strpos($url_request, 'for-sale') !== false || strpos($url_request, 'preleased') !== false) {
			$newMetaTitle =  $this->app->options->get('system.common.buypage_meta_title', 'Properties for sale');
			$newMetaKeywords = $this->app->options->get('system.common.buypage_meta_keywords');
			$newMetaDescription = $this->app->options->get('system.common.buypage_meta_description');
		} else if (strpos($url_request, 'property-for-rent') !== false  || strpos($url_request, 'to-sale') !== false) {
			$newMetaTitle = $this->app->options->get('system.common.rentpage_meta_title', 'Properties for rent');
			$newMetaKeywords = $this->app->options->get('system.common.rentpage_meta_keywords');
			$newMetaDescription = $this->app->options->get('system.common.rentpage_meta_description');
		} else if (strpos($url_request, 'wanted') !== false) {
			$newMetaTitle = $this->app->options->get('system.common.wanted_page_meta_title', 'Properties Wanted');
			$newMetaKeywords = $this->app->options->get('system.common.wanted_page_meta_keywords');
			$newMetaDescription = $this->app->options->get('system.common.wanted_page_meta_description');
		} else if ($url_request == '/real-estate-agents') {
			$newMetaTitle = $this->app->options->get('system.common.agentpage_meta_title', 'Agents');
			$newMetaKeywords = $this->app->options->get('system.common.agentpage_meta_keywords');
			$newMetaDescription = $this->app->options->get('system.common.agentpage_meta_description');
		} else {
			$newMetaTitle = Yii::t('app',  'Properties Listing' . ' | {project} ', array('{project}' => $this->project_name));
			$newMetaKeywords = $this->app->options->get('system.common.home_meta_keywords');;
			$newMetaDescription = $this->app->options->get('system.common.home_meta_description');;
		}
		$formData = array_filter((array)$_GET);
		if (isset($formData['reg']) and !isset($formData['state'])) {
			$formData['reg_id'] =  @$region_with_slug[$formData['reg']]['id'];
		}
		/*keyword*/
		$word_text = '';
		$formData['city_ids'] = '';
		$formData['category_ids'] = '';
		if (isset($formData['word']) and !empty($formData['word'])) {
			$word_text = strtolower($formData['word']);
		}
		$formData['country'] = COUNTRY_ID;
		if (!empty($word_text)) {
			//$city_ids = City::model()->searchLocation($word_text);
			// if(!empty($city_ids )){  $formData['city_ids'] = $city_ids; }

			//	 $category_ids = Category::model()->searchCategory($word_text);
			// if(!empty($category_ids )){  $formData['category_ids'] = $category_ids; }
		}
		/*keyword end*/
		$sub = '';
		$main = '';

		if (isset($formData['type_of']) and sizeOf($formData['type_of']) == '1') {

			$category_id = $formData['type_of'];
			if (strpos($category_id, '_') !== false) {
				$str = explode('_', $category_id);
				$main =  $str['0'];
				$sub =  $str['1'];
			}
			if (!empty($sub)) {
				$categoryModelm =   Category::model()->categorySlugLan($sub);
			} else {
				$main = $_GET['type_of'];
				$categoryModelm =   Category::model()->categorySlugLan($_GET['type_of']);
			}
		} else if (isset($formData['category']) and !empty($formData['category'])) {

			$categoryModelm =   Category::model()->categorySlugLan($formData['category']);
		} else if (isset($formData['cat']) and sizeOf($formData['cat']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['cat'][0]);
		} else if (isset($formData['category']) and sizeOf($formData['category']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['category']);
		}

		if ($categoryModelm and $categoryModelm->category_id == '181') {
			define('BUSINESS', '1');
		}
		$connection =  Yii::app()->getDb();
		$res = $connection->createCommand("SET SQL_BIG_SELECTS = 1")->execute();


		if (!empty($dealer)) {
			$criteriaU = new CDbCriteria;
			$criteriaU->select = 't.company_name,t.company_name_ar, t.last_name , t.slug, t.user_id'; // select fields which you want in output
			$criteriaU->condition = 't.slug = :slug';
			$criteriaU->params[':slug'] = $dealer;
			$userM = ListingUsers::model()->find($criteriaU);
			if (!empty($userM)) {
				$formData['user_id'] =  $userM->user_id;
			}
		}
		$country_name = '';
		$state_name = '';
		$city_name = '';
		$title = '';

		if (!empty($city_name)) {
			$title = $city_name;
		} else if (!empty($state_name)) {
			$title =  $state_name;
		} else if (!empty($loc)) {
			$title = $loc;
		}
		$title = ltrim($title, ',');

		if (isset($formData['poplar_area'])) {
			$PopularCities =   PopularCities::model()->findByPk($formData['poplar_area']);
			if ($PopularCities) {
				$title = $PopularCities->title;
			}
		}

		$limit = 21;

		$placead = new PlaceAnAdNew();

		$criteria =  $placead->findAds($formData, false, 1);

		if ($l_view  == 'map') {

			$criteria->limit = '-1';

			if (isset($formData['a']) and !empty($formData['a']) and isset($formData['b']) and !empty($formData['b']) and isset($formData['c']) and !empty($formData['c']) and isset($formData['d']) and !empty($formData['d'])) {

				$condition1 = $formData['a'] < $formData['c'] ? "t.location_latitude > :a AND t.location_latitude < :c" : "(t.location_latitude > :a OR t.location_latitude < :c)";
				$condition2 = $formData['b'] < $formData['d'] ? "t.location_longitude > :b AND t.location_longitude < :d" : "(t.location_longitude > :d OR t.location_longitude < :b)";
				$q = " and ( $condition1 ) AND ( $condition2 )";

				$criteria->condition .=  ' and   t.location_latitude > :a AND  t.location_latitude  < :c AND  t.location_longitude > :b AND  t.location_longitude < :d ';
				$criteria->condition .=  $q;
				//$criteria->condition .=  ' and   (CASE WHEN :a < :c         THEN  t.location_latitude BETWEEN :a AND :c         ELSE  t.location_latitude BETWEEN :c AND :a END) AND (CASE WHEN :b < :d         THEN  t.location_longitude BETWEEN :b AND :d         ELSE  t.location_longitude BETWEEN :d AND :b END) ' ; 
				$criteria->params[':a'] = $formData['a'];
				$criteria->params[':b'] = $formData['b'];
				$criteria->params[':c'] = $formData['c'];
				$criteria->params[':d'] =  $formData['d'];
			}
			if (!isset($_GET['pja']) or  !$this->app->request->isAjaxRequest) {
				$locationas = $placead->findAll($criteria);
			}

			$locations = array();
			$avg_latitude = '';
			$avg_longitude = '';
			$count = 0;
			$defined_loc = false;
			foreach ($locationas  as $k => $v) {
				if (empty($v->location_latitude)) {
					continue;
				}
				if (!$defined_loc) {
					$defined_loc = true;
					$latitude =   $v->location_latitude;
					$longitude = $v->location_longitude;
				}

				if ($v->section_id == '1') {
					$color =  '#F15A60';
				} else if ($v->section_id == '2') {
					$color =  '#008489';
				} else {
					$color =  '#1FBF61';
				}
				//$locations[] = array($v->MapHtml,empty($v->location_latitude) ? $v->c_cation_latitude : $v->location_latitude,empty($v->location_longitude) ? $v->c_location_longitude : $v->location_longitude,$k+1,$color,$v->detailUrl);	 
				//$locations[] = array('lat' => floatval($v->location_latitude), 'lng' => floatval($v->location_longitude) );
				$locations[] = array('', $v->location_latitude, $v->location_longitude, $k + 1, $color, $v->detailUrl, $v->getAd_image_singlenew("293"), $v->listRowPriceNew(), $v->listRowFeaturesNew(), $v->AdTitle2);
			}
		}


		$adsCount =   $placead->count($criteria);


		if ($file_view != 'map') {

			$pages = new CPagination($adsCount);
			$pages->pageSize = $limit;
			$pages->applyLimit($criteria);
		}
		$criteria->limit = $limit;
		$ads = $placead->findAll($criteria);



		$filterModel = new PlaceAnAd();
		$filterModel->attributes = $formData;
		$filterModel->section_id = @$formData['sec'];

		if (isset($formData['preleased']) and sizeOf($formData['preleased']) == '1') {
			$filterModel->property_status = '1';
			$filterModel->section_id = 'preleased';
		}
		if ($country_id) {
			$filterModel->country = $country_id;
		}
		$this->sec_id = $filterModel->section_id;
		if ($this->sec_id == 'property-for-sale' and isset($formData['listing_type'])) {
			switch ($formData['listing_type']) {
				case 'H':
					$this->sec_id = 'homes';
					break;
				case 'P':
					$this->sec_id = 'plots';
					break;
				case 'C':
					$this->sec_id = 'commercial';
					break;
			}
		}
		$m_title = '';
		if ($filterModel->section_id == 'preleased') {
			if (empty($categoryModelm)) {
				$m_title = $this->tag->getTag('preleased_Properties', 'Preleased Properties') . ' ';
			} else {
				$m_title = $this->tag->getTag('preleased', 'Preleased') . ' ';
			}
		}
		$s_suffix = LANGUAGE == 'en' ? 's' : '';
		if (!empty($categoryModelm)) {
			//   if($categoryModelm->category_id=='150' and  LANGUAGE =='en'){$s_suffix='';}
			//    if($categoryModelm->category_id=='181' and  LANGUAGE =='en'){$s_suffix='';}
			if ($filterModel->section_id != 'new-development') {
				$m_title  .=  $categoryModelm->PluralName;
				if (!isset($formData['type_of'])) {
					$m_title  .=  '  ' . $this->tag->getTag('properties', 'Properties');
				}
			} else {
				$m_title  .=  $categoryModelm->category_name;
			}
		}
		if ($categoryModelm->category_id == '181') {
			$m_title = 'Business';
		}
		if (!empty($main)) {
			switch ($main) {
				case 'residential':
					if (!empty($sub)) {
						if ($categoryModelm->category_id == '114') {
							$m_title  =   Yii::t('app', $this->tag->getTag('residential_{c}', 'Residential {c}'), array('{c}' => $m_title));
						}
					}
					if (empty($filterModel->section_id)) {
						$this->sec_id = 'residential';
					}
					break;
				case 'commercial':
					if (!empty($sub)) {
						if ($categoryModelm->category_id == '114') {
							$m_title  =  Yii::t('app', $this->tag->getTag('commercial_{c}', 'Commercial {c}'), array('{c}' => $m_title));
						}
					}
					if (empty($filterModel->section_id)) {
						$this->sec_id = 'commercial';
					}
					break;
			}
		}
		if (empty($m_title)) {
			$m_title = $filterModel->SectionViewTitle;
		} else {
			
			switch ($filterModel->section_id) {
				case 'property-for-sale':
					$m_title .= ' ' . $this->tag->getTag('for_sale', 'for sale');
					break;
				case 'property-for-rent':
					$m_title .=  ' ' . $this->tag->getTag('for_rent', 'for rent');
					break;
				case 'new-development':
					$m_title .=  ' ' . $this->tag->getTag('new_projects', 'New Projects');
					break;
				case 'preleased':
					$m_title .= ' ' . $this->tag->getTag('for_sale', 'for sale');
					break;
			}
		}

		if (isset($formData['term']) and $formData['term'] == 'furnish') {
			$this->sec_id = 'furnished';
			$m_title =   'Furnished Properties';
		}
		if (isset($formData['term']) and $formData['term'] == 'installment') {
			$this->sec_id = 'installment';
			$m_title =   'Installment Properties';
		}


		if (!empty($location_title)) {

			$m_title .=  ' ' . Yii::t('app', $this->tag->getTag('in_loc', 'in {loc}'), array('{loc}' => $location_title));
		} else if (isset($formData['reg'])) {

			$m_title .= ' -' . @$region_with_slug[$formData['reg']]['name'];
		} else {
			$m_title .=  ' ' . Yii::t('app', $this->tag->getTag('in_uae', 'in  UAE'));
		}


		switch ($filterModel->section_id) {
			case 'property-for-sale':
				$sec_t = 'sale';
				break;
			case 'property-for-rent':
				$sec_t = 'rent';
				break;
			case 'new-development':
				$sec_t = 'sale/rent';
				break;
			case 'preleased':
				$sec_t = 'sale';
				break;
			default:
				$sec_t = 'sale/rent';
				break;
		}

		$ptype = !empty($categoryModelm) ?  $categoryModelm->category_name : 'Properties';
		$ptype_plural = !empty($categoryModelm) ?  $categoryModelm->PluralName : 'Properties';
		if (isset($formData['preleased']) and sizeOf($formData['preleased']) == '1') {
			$ptype = 'Preleased ' . $ptype;
			$ptype_plural  = 'Preleased ' . $ptype_plural;
		}
		$location_title1  = !empty($location_title) ? ' in ' . $location_title : '';
		$location_title_only  = !empty($location_title) ? $location_title : 'UAE';
		$location_ptpe = $ptype . '' . $location_title1;
		$newMetaDescription = Yii::t('app', $newMetaDescription, array('[META_TITLE]' => $m_title, '[LOC_PTYPE]' => $location_ptpe));
		$newMetaKeywords = Yii::t('app', $newMetaKeywords, array('[Ptype_plural]' => $ptype_plural, '[Mtype]' => $sec_t, '[Location]' => $location_title_only, '[Ptype]' => $ptype, '[BrandName]' => BRAND_TITLE));
		$cat_i = isset($formData['type_of']) ? $formData['type_of'] : $formData['category'];

		$pageContent = ListingContents::model()->getListingContent($formData['sec'], $cat_i, $formData['state']);


		if ($filterModel->section_id != 'new-development') {
			define('sell_title', $this->tag->getTag('post_property', 'Post Property'));
			define('sell_url', $this->app->createUrl('place_an_ad_no_login/create', array('type' => 'property')));
		} else {
			define('sell_title', $this->tag->getTag('post_project', 'Post Project '));
			define('sell_url', $this->app->createUrl('new_projects/create'));
		}


		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app',  'Properties Listing' . '  | {project} ', array('{project}' => $this->project_name)),
			'noFooter'     =>  $file_view == 'index_map' ? '1' : false,
			'newMetaTitle' => $m_title,
			'pageTitle' => $m_title . '  | ' . BRAND_TITLE,
			'meta_keyword' => $newMetaKeywords,
			'pageMetaDescription' => $newMetaDescription,
			'schema'            =>  !empty($pageContent->neighborhood) ? $pageContent->neighborhood : ''
		));
		if ($pageContent) {
			$p_title = $pageContent->meta_title;
			$p_description = $pageContent->meta_description;
// 			if ($p_title) {
// 				$this->setData(array('pageTitle' => $p_title . '  | ' . BRAND_TITLE));
// 			}
// 			if ($p_description) {
// 				$this->setData(array('pageMetaDescription' => $p_description));
// 			}
		}
		$apps = $this->app->apps;
		$currency_code =  $filterModel->currencyTitle;
		$b_1 = array();
		$b_2 = array();
		if (Yii::app()->options->get('system.common.banner', 'no') == 'yes') {
			$banner = new Banner();

			$b_1 = $banner->findPosition($this->sec_id, '', 1);
			$b_2 = $banner->findPosition($this->sec_id, '', 2);
			$b_3 = $banner->findPosition($this->sec_id, '', 3);
		}
		if (!isset($found_search)) {
			$found_search = false;
		}
		if (!isset($categoryModelm)) {
			$categoryModelm = false;
		}
		if (!isset($userM)) {
			$userM = false;
		}
		/*seraching */
		$my_searches  =	array();
		$total_items_incookie = 6;
		$price_title = $filterModel->price_title($formData);
		$sub = '';
		if ($price_title != 'Any Price') {
			if (defined('SYSTEM_CURRENCY') and SYSTEM_CURRENCY == 'usd') {
				$sub = $price_title . ' $';
			} else {
				$sub = $price_title . ' $';
			}
		}
		if (!empty($filterModel->bathrooms)) {
			$sub .= ' baths ' . $filterModel->bathrooms . '+ ';
		}

		if (!empty($filterModel->minSqft) or !empty($filterModel->maxSqft)) {
			$unt = defined('AREANAME') ? AREANAME :  'Square Feet';
			if (!empty($filterModel->minSqft) and !empty($filterModel->maxSqft)) {
				$sub .= ' ' . $filterModel->minSqft . ' - ' . $filterModel->maxSqft . ' ' . $unt;
			} else if (!empty($filterModel->minSqft)) {
				$sub .= $filterModel->minSqft . ' ' . $unt . '(min)';
			} else {
				$sub .= $filterModel->maxSqft  . ' ' . $unt . '(max)';
			}
		}

		if ((isset(Yii::app()->request->cookies['my_searchesn' . COUNTRY_ID]))) {
			$my_searches  =  Yii::app()->request->cookies['my_searchesn' . COUNTRY_ID]->value;
		}
		if (empty($sub)) {
			$sub = 'All Searches';
		}
		$uniquer = $filterModel->slugify($m_title);
		if (isset($my_searches[$uniquer])) {
			unset($my_searches[$uniquer]);
		}

		$my_searches = array_reverse($my_searches);
		$my_searches[$uniquer] = array('title' => (array)@$_GET, 'url' => Yii::app()->request->url);
		$my_searches = array_slice($my_searches, 0, $total_items_incookie);
		$my_searches = array_reverse($my_searches);
		$this->l_view = $l_view;
		$cookie = new CHttpCookie('my_searchesn' . COUNTRY_ID, $my_searches);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['my_searchesn' . COUNTRY_ID] = $cookie;
		/*seraching */


		if ($this->app->request->isAjaxRequest) {
			unset($formData['_pjax']);
			unset($formData['_']);

			if (isset($_GET['pja']) and $this->app->request->isAjaxRequest) {
				$this->renderPartial('_left_column', compact('locations', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'b_1', 'b_2', 'b_3', 'l_view', 'stateModel', 'search_url', 'found_search', 'load_location', 'active_state', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'state_name', 'country_name', 'country', 'pages', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'ads', 'limit'));
				exit;
			}

			$this->renderPartial($file_view, compact('locations', 'pageContent', 'pages', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'b_1', 'b_2', 'b_3', 'l_view', 'stateModel', 'search_url', 'found_search', 'load_location', 'active_state', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'state_name', 'country_name', 'country', 'pages', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'ads', 'limit'));
			$this->app->end();
		}


		$this->render($file_view, compact('locations','featured', 'pageContent', 'pages', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'l_view', 'stateModel', 'b_1', 'b_2', 'b_3', 'search_url', 'found_search', 'load_location', 'active_state', 'currency_code', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'pages', 'state_name', 'country_name', 'country', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'limit'));
	}


	public function actionFetch_work($count_future = true, $calculate = false, $country_id2 = false, $state_id2 = false, $is_form = false, $hide_featured = false)
	{
		unset($_GET['formData']);

		$request = Yii::app()->request;
		/*
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData1);
			 
		}
		else{
		$formData1 = array_filter((array)$_GET);
		}
		$formData = array();
		foreach($formData1 as $k=>$v){
			$formData[Yii::t('app',$k,array(';'=>''))] =  $v; 
		}
		* */

		$formData = (array)$_GET;


		//	 print_r($formData['poplar_area']);exit;
		$works =   PlaceAnAdNew::model()->findAds($formData, $count_future, false, $calculate);
		if (!$hide_featured) {
			if (!empty($country_id2) or !empty($state_id2)) {
				$offset_n = Yii::app()->request->getQuery('offset', '0');
				$limit_n  = Yii::app()->request->getQuery('limit', '10');
				if ($offset_n == '0') {
					$new_offset = 0;
				} else {
					$new_offset = 2 * ($offset_n / $limit_n) + 1;
				}

				//$property_of_featured_developers         = Developer::model()->featured_developers($country_id2,$state_id2,2,0,true,$offset_n );
			}
		}

		$msgHTML = '<meta name="robots" content="noindex">';
		if (!empty($count_future)) {
			$next_result   = !empty($works['future_count']) ?  1 : 0;
			$total         = isset($works['total']) ? $works['total'] : false;
			$works		   = $works['result'];
		}


		if ($works) {
			if (isset($formData['sec']) and $formData['sec'] == 'new-development') {
				$msgHTML .= $this->renderPartial('//listing/_list_proprty_property', compact('works', 'checkIcon', 'property_of_featured_developers'), true);
			} else {
				$msgHTML .= $this->renderPartial('//listing/_list_proprty', compact('works', 'checkIcon', 'property_of_featured_developers'), true);
			}
			if (!empty($count_future)) {
				if ($total != false) {
					echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result, 'total' => $total));
				} else {
					echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result));
				}
			} else {
				echo   $msgHTML;
			}
		} else {
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
		$langaugae = OptionCommon::getLanguage();
		$criteria = new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name,cn.slug as country_slug,t.slug,cm.slug as city_id,cm.city_name';
		$criteria->join = 'INNER JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->join .= 'LEFT JOIN {{city}} cm ON cm.state_id  = t.state_id  ';
		$criteria->condition = 'cn.show_on_listing="1" ';
		$criteria->condition .= ' and  ( CASE WHEN city_name IS NOT NULL THEN  ( CONCAT(state_name, " ", country_name," ",city_name) like  :term  ) ELSE ( CONCAT(state_name, " ", country_name) like  :term  ) END  )  ';

		if (!empty($langaugae) and  $langaugae != 'en') {
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  state_other  ';
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation1` on translationRelation1.city_id = cm.city_id   LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan) ';
			$criteria->select .= ' ,tdata1.message as  city_other  ';
			$criteria->order  = 'tdata1.message asc, tdata.message asc , cm.city_name asc , t.state_name asc , cn.country_name asc ';
		} else {
			$criteria->order  = 'cm.city_name asc , t.state_name asc , cn.country_name asc ';
		}


		$criteria->params[':term'] = '%' . $query . '%';
		$criteria->limit = 10;
		$models = States::model()->findAll($criteria);


		$results = array();
		$loaded_state = array();
		if ($models) {
			foreach ($models as $model) {


				if (empty($model->city_name)) {
					$title = !empty($model->state_other) ? $model->state_other :  $model->state_name;
				} else {
					$title_state = !empty($model->state_other) ? $model->state_other :  $model->state_name;
					$title =  !empty($model->city_other) ? $model->city_other : $model->city_name;
					$title =  $title_state . '->' . $title;
				}
				if (!in_array($model->state_id, $loaded_state) and !empty($model->city_name)) {
					$results['suggestions'][] = array(
						'country_id' => $model->country_slug,
						'state_id'  => $model->slug,
						'community_id'  => '',
						'city_id'  => '',
						'value'       =>   $model->state_name,
						'data'       =>  $model->country_slug,
					);
					$loaded_state[$model->state_id] = $model->state_id;
				}


				$results['suggestions'][] = array(
					'country_id' => $model->country_slug,
					'state_id'  => $model->slug,
					'community_id'  => '',
					'city_id'  => $model->city_id,
					'value'       =>  $title,
					'data'       =>  $model->country_slug,
				);
			}
		} else {
			$results['suggestions'] = array();
		}



		return $this->renderJson($results);
	}

	public function actionFetch_work2($count_future = true, $calculate = false, $country_id2 = false, $state_id2 = false, $is_form = false, $hide_featured = false)
	{
		$request = Yii::app()->request;
		if ($is_form) {
			parse_str($request->getQuery('formData', ''), $formData);
		} else {
			$formData = array_filter((array)$_GET);
		}
		$works =   PlaceAnAd::model()->findAds($formData, $count_future, false, $calculate);
		$msgHTML = '';
		if (!empty($count_future)) {
			$next_result   = !empty($works['future_count']) ?  1 : 0;
			$total         = isset($works['total']) ? $works['total'] : false;
			$works		   = $works['result'];
		}


		if ($works) {

			$msgHTML .= $this->renderPartial('//listing/_list_projects', compact('works', 'checkIcon', 'property_of_featured_developers'), true);
			if (!empty($count_future)) {

				echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result));
			} else {
				echo   $msgHTML;
			}
		} else {
			echo '1';
		}
		Yii::app()->end();
	}
	public function actionFav_properties($count_future = true, $calculate = false, $country_id2 = false, $state_id2 = false, $is_form = false, $hide_featured = false)
	{

		$request = Yii::app()->request;
		if ($is_form) {
			parse_str($request->getQuery('formData', ''), $formData1);
		} else {
			$formData1 = array_filter((array)$_GET);
		}
		$formData = array();
		foreach ($formData1 as $k => $v) {
			$formData[Yii::t('app', $k, array(';' => ''))] =  $v;
		}

		//	 print_r($formData['poplar_area']);exit;
		$formData['user_fav_only'] = 1;
		$works =   PlaceAnAd::model()->findAds($formData, $count_future, false, $calculate);
		if (!$hide_featured) {
			if (!empty($country_id2) or !empty($state_id2)) {
				$offset_n = Yii::app()->request->getQuery('offset', '0');
				$limit_n  = Yii::app()->request->getQuery('limit', '10');
				if ($offset_n == '0') {
					$new_offset = 0;
				} else {
					$new_offset = 2 * ($offset_n / $limit_n) + 1;
				}

				//$property_of_featured_developers         = Developer::model()->featured_developers($country_id2,$state_id2,2,0,true,$offset_n );
			}
		}

		$msgHTML = '';
		if (!empty($count_future)) {

			$next_result   = !empty($works['future_count']) ?  1 : 0;
			$total         = isset($works['total']) ? $works['total'] : false;
			$works		   = $works['result'];
		}


		if ($works) {
			$msgHTML .= $this->renderPartial('//listing/_fav_list', compact('works', 'checkIcon', 'property_of_featured_developers'), true);

			if (!empty($count_future)) {
				if ($total != false) {
					echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result, 'total' => $total));
				} else {
					if (isset($_GET['offset']) and $_GET['offset'] == '0') {
						if (!Yii::app()->user->getId()) {
							$data = array();
							$cookieName = 'USERFAV' . COUNTRY_ID;
							if ((isset(Yii::app()->request->cookies[$cookieName]))) {
								$data =  Yii::app()->request->cookies[$cookieName]->value;
							}
							$placead = new PlaceAnAd();
							$criteria =  $placead->findAds(array(), false, 1);
							$criteria->addInCondition('t.id', (array)$data);
							$total_favourite = $placead->count($criteria);
							$cookieName2 = 'C_USERFAV' . COUNTRY_ID;
							$cookie = new CHttpCookie($cookieName2, $total_favourite);
							$cookie->expire = time() + 60 * 60 * 24 * 180;
							Yii::app()->request->cookies[$cookieName2] = $cookie;
							echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result, 'total_favourite' => $total_favourite));
							exit;
						} else {

							$placead = new PlaceAnAd();
							$criteria =  $placead->findAds(array(), false, 1);
							$criteria->join .= ' INNER JOIN {{ad_favourite}} af  on af.ad_id = t.id and af.user_id = :user_idn ';
							$criteria->params[':user_idn'] = (int) Yii::app()->user->getId();
							$total_favourite = $placead->count($criteria);
							$cookieName2 = 'C_USERFAV' . COUNTRY_ID . Yii::app()->user->getId();
							$cookie = new CHttpCookie($cookieName2, $total_favourite);
							$cookie->expire = time() + 60 * 60 * 24 * 180;
							Yii::app()->request->cookies[$cookieName2] = $cookie;
							echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result, 'total_favourite' => $total_favourite));
							exit;
						}
					}

					echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result));
				}
			} else {
				echo   $msgHTML;
			}
		} else {
			echo '1';
		}
		Yii::app()->end();
	}
	public function actionAutocompleteNew($query)
	{
		$request = Yii::app()->request;
		if (!$request->isAjaxRequest) {
			// $this->redirect(Yii::app()->createUrl('site/index'));
		}

		$criteria = new CDbCriteria;
		$criteria->select = 't.slug,.t.state_name';

		$criteria->condition .= '1 and    t.country_id="66099"  and t.state_name like :term ';
		$criteria->params[':term'] = '%' . $query . '%';
		$criteria->limit = 10;
		$models = States::model()->findAll($criteria);


		$results = array();
		$results['suggestions'][] = array(

			'value'       =>  'Select City',
			'label'       => '',
		);;
		if ($models) {
			foreach ($models as $model) {

				$results['suggestions'][] = array(

					'value'       =>   $model->state_name,
					'label'       =>  $model->slug,
				);
			}
		} else {
			$results['suggestions'] = array();
		}



		return $this->renderJson($results);
	}
	public function actionAutocompleteLocation($query)
	{
		$request = Yii::app()->request;
		if (!$request->isAjaxRequest) {
			// $this->redirect(Yii::app()->createUrl('site/index'));
		}

		$criteria = new CDbCriteria;

		$criteria->condition = 't.country_id=:country_id and t.isTrash="0" and t.status="A"';
		$criteria->join      = ' INNER JOIN {{states}}  st ON st.state_id = t.state_id  ';
		$criteria->params[":country_id"] = "66099";
		$criteria->select = 'city_id,city_name,st.state_name';
		$criteria->order  = "st.state_name asc , city_name asc ";

		$criteria->condition .= '  and    t.city_name like :term ';
		$criteria->params[':term'] = '%' . $query . '%';
		$criteria->limit = 10;
		$models = City::model()->findAll($criteria);


		$results = array();

		if ($models) {
			foreach ($models as $model) {

				$results['suggestions'][] = array(

					'value2'       =>   urlencode($model->city_name),
					'value'       =>    $model->city_name,
					'label'       =>  $model->state_name,
				);
			}
		} else {
			$results['suggestions'] = array();
		}



		return $this->renderJson($results);
	}
	public function actionopenFilter()
	{


		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$filterModel = new PlaceAnAd();

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Filter', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'openFilter'   => '1',
		));
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("//listing/searching_top", compact('model', 'user'), false, true);
			exit;
		}

		$this->render("//listing/searching_top", compact('model', 'user', 'filterModel'));
	}
	public function actionFilter($country = null, $state = null, $city = null, $type = null, $community = null, $sec = null, $category = null, $dealer = null, $loc = null)
	{


		if (isset($_GET['reg'])) {
			if (!isset($_GET['state'])) {
				$_GET['state'] = $_GET['reg'];
			}
			unset($_GET['reg']);
		}

		$country_id = COUNTRY_ID;

		$l_view = 'list';


		if ($sec == 'Property') {
			$sec = '';
			$_GET['sec'] = '';
		};
		if (isset($_GET['reg'])) {
			if ($_GET['reg'] == '-') {
				$_GET['reg'] = '';
			};
		}
		if (isset($_GET['state'])) {
			if ($_GET['state'] == 'property' or $_GET['state'] == 'all') {
				$state = '';
				$_GET['state'] = '';
				$_GET['state'] = '';
			};
		}
		if (isset($_GET['type_of']) and $_GET['type_of'] == 'property') {
			unset($_GET['type_of']);
			//if($_GET['state']=='property' or $_GET['state']=='all'){  $state='' ;$_GET['state']= '';$_GET['state']='';  };  
		}
		if (isset($_GET['sec']) and $_GET['sec'] == 'for-sale-and-rent') {
			unset($_GET['sec']);
		}
		if (isset($_GET['type_of']) and $_GET['type_of'] == 'all') {
			unset($_GET['type_of']);
		}

		switch ($sec) {
			case 'preleased':
				$_GET['sec'] = '';
				$sec = '';
				$_GET['preleased'] = '1';
				define('PRELE', '1');

				if (!isset($_GET['category'])) {
					$_GET['category'] = 'commercial';
				}

				break;
			case 'for-sale':
				$_GET['sec'] = 'property-for-sale';
				$sec = 'property-for-sale';
				if (!isset($_GET['catgory'])) {
					$_GET['catgory'] = 'commerical';
				}
				break;
			case 'to-rent':
				$_GET['sec'] = 'property-for-rent';
				$sec = 'property-for-rent';
				if (!isset($_GET['catgory'])) {
					$_GET['catgory'] = 'commerical';
				}
				break;
			case 'for-rent':
				$_GET['sec'] = 'property-for-rent';
				$sec = 'property-for-rent';

				break;
		}

		if (!isset($_GET['category']) and  in_array($sec, array('preleased', 'for-sale', 'to-rent', 'to-rent', 'property-for-sale', 'property-for-rent'))) {
			$_GET['category'] = 'commercial';
		}
		$location_title = '';
		$areaData = States::model()->all_cities_list(); // print_r($areaData);exit; 
		if (isset($_GET['state']) and !empty($_GET['state'])) {
			if (isset($areaData[$_GET['state']])) {
				$selectedArea = $areaData[$_GET['state']];
				$location_title .= $selectedArea['name'] . ',';
				$areaData[$_GET['state']]  =  array_merge($selectedArea, array('selected' => true));
			}
		}
		if (isset($_GET['area']) and !empty($_GET['area'])) {
			$areas = array_filter(explode(':', $_GET['area']));
			if (!empty($areas)) {
				$sizeOfarea = sizeOf($areas);
				$sizeOfarea1 = $sizeOfarea - 1;
				$counto = '1';
				foreach ($areas as $kv) {
					$selectedArea = $areaData[$kv];
					if ($sizeOfarea == '1') {
						$location_title .= ' and ' . $selectedArea['name'];
					} else {
						if ($sizeOfarea1 == $counto) {
							$location_title .= $selectedArea['name'] . ' and ';
						} else {
							$location_title .= $selectedArea['name'] . ', ';
						}
					}
					$areaData[$kv]  =  array_merge($selectedArea, array('selected' => true));
					$counto++;
				}
			}
		}

		$areaData = array_values($areaData);
		if ($location_title != '') {
			$location_title = rtrim($location_title, ', ');
		}
		/*
    $regions = 	MainRegion::model()->getStateWithCountry_2datas(COUNTRY_ID);
    $region_with_slug = 	MainRegion::model()->getStateWithCountry_2dataslug(COUNTRY_ID);
    $statesData = States::model()->AllListingStatesOfCountry(COUNTRY_ID); 
    $cityDats = CHtml::listData($statesData,'slug' , 'state_name'); 
    $region_list = CHtml::listData($statesData,'slug' , 'region_id');
    */

		$apps = $this->app->apps;

		$state = 'ajman';
		$file_view = 'index';
		$url_request =  Yii::app()->request->url;

		$search_url = $url_request;
		/*
	 if(Yii::app()->user->getId()){
		$found_search = UserSearches::model()->findByAttributes(array('url'=>$search_url,'user_id'=>Yii::app()->user->getId()));
	 }
	 * */
		$load_location = array();
		$active_state  = false;
		$active_city  = false;
		$country_id = null;
		$state_id = null;


		$formData = array_filter((array)$_GET);
		if (isset($formData['reg']) and !isset($formData['state'])) {
			$formData['reg_id'] =  @$region_with_slug[$formData['reg']]['id'];
		}
		/*keyword*/
		$word_text = '';
		$formData['city_ids'] = '';
		$formData['category_ids'] = '';
		if (isset($formData['word']) and !empty($formData['word'])) {
			$word_text = strtolower($formData['word']);
		}
		$formData['country'] = COUNTRY_ID;
		if (!empty($word_text)) {
			//$city_ids = City::model()->searchLocation($word_text);
			// if(!empty($city_ids )){  $formData['city_ids'] = $city_ids; }

			//	 $category_ids = Category::model()->searchCategory($word_text);
			// if(!empty($category_ids )){  $formData['category_ids'] = $category_ids; }
		}
		/*keyword end*/
		$sub = '';
		$main = '';

		if (isset($formData['type_of']) and sizeOf($formData['type_of']) == '1') {

			$category_id = $formData['type_of'];
			if (strpos($category_id, '_') !== false) {
				$str = explode('_', $category_id);
				$main =  $str['0'];
				$sub =  $str['1'];
			}
			if (!empty($sub)) {
				$categoryModelm =   Category::model()->categorySlugLan($sub);
			} else {
				$main = $_GET['type_of'];
				$categoryModelm =   Category::model()->categorySlugLan($_GET['type_of']);
			}
		} else if (isset($formData['category']) and !empty($formData['category'])) {

			$categoryModelm =   Category::model()->categorySlugLan($formData['category']);
		} else if (isset($formData['cat']) and sizeOf($formData['cat']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['cat'][0]);
		} else if (isset($formData['category']) and sizeOf($formData['category']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['category']);
		}

		if ($categoryModelm and $categoryModelm->category_id == '181') {
			define('BUSINESS', '1');
		}
		$filterModel = new PlaceAnAd();
		$filterModel->attributes = $formData;
		$filterModel->section_id = @$formData['sec'];

		if (isset($formData['preleased']) and sizeOf($formData['preleased']) == '1') {
			$filterModel->property_status = '1';
			$filterModel->section_id = 'preleased';
		}
		if ($country_id) {
			$filterModel->country = $country_id;
		}
		$view = '_arab_avenue_filter';
		if ($formData['sec'] == 'new-development') {
			$view = '_new_project_filter';
		}
		if (defined('PRELE')) {
			$view = '_preleased_filter';
		}
		$msgHTML  = $this->renderPartial($view, compact('locations', 'pageContent', 'pages', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'l_view', 'stateModel', 'b_1', 'b_2', 'b_3', 'search_url', 'found_search', 'load_location', 'active_state', 'currency_code', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'pages', 'state_name', 'country_name', 'country', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'limit'), true);
		echo  json_encode(array('html' => $msgHTML));
		exit;
	}
}
