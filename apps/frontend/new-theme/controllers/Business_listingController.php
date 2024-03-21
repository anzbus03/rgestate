<?php defined('MW_PATH') || exit('No direct script access allowed');



class Business_listingController extends Controller
{

	public function actionIndex($country = null, $state = null, $city = null, $sub_category = null, $type = null, $community = null, $sec = null, $category = null, $dealer = null, $loc = null)
	{
	   //// exit;
		// print_r($_GET);
	    define('ITS_LIST_PAGE', '1');
		$criteriaState=new CDbCriteria;
		$criteriaState->select = 't.state_id,t.country_id';
		$criteriaState->condition = ' t.slug = :term ';
		$criteriaState->params[':term']  = $_GET['state'];
		$states = States::model()->find($criteriaState);
	    if (isset($_GET['state']) && !isset($states['state_id'])){
	        $criteriaTypeOf=new CDbCriteria;
    		$criteriaTypeOf->select = 't.category_id';
    		$criteriaTypeOf->condition = ' t.slug = :term ';
    		$criteriaTypeOf->params[':term']  = $_GET['state'];
    		$categoryClass = Category::model()->find($criteriaTypeOf);
    	   if ($categoryClass['category_id']){
	            $_GET['type_of'] = $_GET['state'];
    	        unset($_GET['state']);
    	   }
	    }
        if (isset($_GET["sub_category_old"])) {
            if (!Subcategory::model()->findByAttributes(['slug' => $_GET['sub_category']])){
                $subCategoryOld = $_GET["sub_category_old"];
                $state = $_GET['sub_category'];
                $_GET['state'] = $state;
                $_GET['sub_category'] = $subCategoryOld;
                unset($_GET["sub_category_old"]);
            }
           
        }
        
        if (isset($_GET["nested_sub_category_old"])) {
            $nestedSubCategoryOld = $_GET["nested_sub_category_old"];
            $_GET['nested_sub_category'] = $nestedSubCategoryOld;
            unset($_GET['nested_sub_category_old']);
           
        }
        
        if (isset($_GET['type_of'])) {
            $subCategory = $_GET['type_of'];
            $subCategoryModel = Subcategory::model()->findByAttributes(['slug' => $subCategory]);
        
            if (!$subCategoryModel) {
                $mainRegion = MainRegion::model()->findByAttributes(['slug' => $subCategory]);
        
                if ($mainRegion) {
                    $_GET['state'] = $mainRegion->slug;
                    unset($_GET['type_of']);
                }
            }
        }
        if (isset($_GET['sub_category'])) {
            $subCategory = $_GET['sub_category'];
            $subCategoryModel = Subcategory::model()->findByAttributes(['slug' => $subCategory]);
        
            if (!$subCategoryModel) {
                $mainRegion = MainRegion::model()->findByAttributes(['slug' => $subCategory]);
        
                if ($mainRegion) {
                    $_GET['state'] = $mainRegion->slug;
                    unset($_GET['sub_category']);
                }
            }
        }
        
        if (isset($_GET['nested_sub_category'])) {
            $nestedSubCategory = $_GET['nested_sub_category'];
            $nestedSubCategoryModel = Subcategory::model()->findByAttributes(['slug' => $nestedSubCategory]);
        
            if (!$nestedSubCategoryModel) {
                $mainRegion = MainRegion::model()->findByAttributes(['slug' => $nestedSubCategory]);
        
                if ($mainRegion) {
                    $_GET['state'] = $mainRegion->slug;
                    unset($_GET['nested_sub_category']);
                }
            }
        }

    	if (isset($_GET['reg'])) {
			if (!isset($_GET['state'])) {
				$_GET['state'] = $_GET['reg'];
			}
			unset($_GET['reg']);
		}
		$country_id = COUNTRY_ID;
		$l_view = 'list';
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
		//$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css'), 'priority' => -100));
		//	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.js'), 'priority' => -100));

		$state = 'ajman';
		$file_view = 'index';
		if ((isset($this->app->request->cookies['list_view']))) {
			$l_view  =  $this->app->request->cookies['list_view']->value;
			if ($l_view == 'map') {
				$file_view = 'index_map';
			}
		}


		if ($l_view == 'map' and $this->app->request->isAjaxRequest and !isset($_GET['pja'])) {
			echo '<script>location.reload();</script>';
			exit;
		}
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
// 		echo "<pre>";
// 		print_r($formData);
		
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

		/*keyword end*/
		$sub = '';
		$main = '';
// 		echo "<pre>";
// 		print_r($formData);
// 		exit;
		if (!empty($category)) {

			$categoryModelm =   Category::model()->categoryIdLan($category);
			if (!empty($categoryModelm)) {
				$formData['type_of'][] = $category;
			}
		} else if (isset($formData['type_of']) and sizeOf($formData['type_of']) == '1') {

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
		} else if (isset($formData['cat']) and sizeOf($formData['cat']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['cat'][0]);
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



		$limit = 24;


		$placead = new BusinessForSale();
	   
		$criteria =  $placead->findAds($formData, false, 1);
    //  print_r($formData);
	   // exit;
		if ($l_view  == 'map') {


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
			$criteria->limit = '-1';
			if (!isset($_GET['pja']) or  !$this->app->request->isAjaxRequest) {

				$locationas = $placead->findAll($criteria);
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
					$locations[] = array('', $v->location_latitude, $v->location_longitude, $k + 1, $color, $v->detailUrl, $v->getAd_image_singlenew("293"), '', '', $v->AdTitle2);
				}
			}
		}

		$adsCount =   $placead->count($criteria);
		$pages = new CPagination($adsCount);
		$pages->pageSize = $limit;
		$pages->applyLimit($criteria);
		$criteria->limit =  $limit;

		$ads = $placead->findAll($criteria);

		$filterModel = new BusinessForSale();
		$filterModel->attributes = $formData;
		$filterModel->section_id = @$formData['sec'];


		if ($country_id) {
			$filterModel->country = $country_id;
		}
		$this->sec_id = $filterModel->section_id;

		$m_title = '';
		$s_suffix = LANGUAGE == 'en' ? 's' : '';
		$cat_i = isset($formData['type_of']) ? $formData['type_of'] : $formData['category'];
		if (!empty($categoryModelm)) {
		    if(isset($_GET['sub_category']) && !isset($_GET['nested_sub_category'])){
	            $m_title .= Subcategory::model()->findByAttributes(array('slug'=>$_GET['sub_category']))->sub_category_name . " ";
		    }else if (isset($_GET['sub_category']) && isset($_GET['nested_sub_category'])){
	            $m_title .= Subcategory::model()->findByAttributes(array('slug'=>$_GET['nested_sub_category']))->sub_category_name . " ";
		    }
	        $m_title  .= $categoryModelm->PluralName;
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
			$m_title .= $this->tag->getTag('business_for_sale', 'Businesses Opportunities');
		} else {
            
// 			switch ($filterModel->section_id) {
// 				case 'business-opportunities':
// 					$m_title .= ' ' . $this->tag->getTag('business_for_sale', 'Businesses Opportunities');
// 					break;
// 			}
		}



		if (!empty($location_title) ) {
		    $m_title .=  ' ' . Yii::t('app', $this->tag->getTag('in_loc', 'in {loc}'), array('{loc}' => $location_title));
		} else if (isset($formData['reg'])) {

			$m_title .= ' -' . @$region_with_slug[$formData['reg']]['name'];
		} else {
			$m_title .= '  ' . $this->tag->getTag('in__uae', 'in UAE');
		}


		$newMetaTitle = Yii::t('app',  'Business Opportunities' . ' | {project} ', array('{project}' => $this->project_name));
		$newMetaKeywords = $this->app->options->get('system.common.wanted_page_meta_description');;
		$newMetaDescription = $this->app->options->get('system.common.wanted_page_meta_keywords');;
		$ptype = !empty($categoryModelm) ?  $categoryModelm->category_name : '';
		$location_title_only  = !empty($location_title) ? $location_title : '';
		$location_title_uae  = !empty($location_title) ? $location_title : 'UAE';
		$newMetaDescription = Yii::t('app', $newMetaDescription, array('[META_TITLE]' => $m_title, '[Ptype]' => $ptype, '[Location]' => $location_title_only));
		$newMetaKeywords = Yii::t('app', $newMetaKeywords, array('[Mtype]' => 'businesses', '[Btype]' => $ptype, '[Location]' => $location_title_uae, '[BrandName]' => BRAND_TITLE));

		define('sell_title', $this->tag->getTag('sell_your_business', 'Sell Your Business'));
		define('sell_url', $this->app->createUrl('place_an_ad_no_login/create', array('type' => 'business')));
			$cat_i = isset($formData['type_of']) ? $formData['type_of'] : $formData['category'];
		$pageContentsListing =  ListingContents::model()->getListingContent($formData['sec'], $cat_i, $formData['state'], $formData['sub_category'], $formData['nested_sub_category']);
// 		print_r($pageContentsListing);
// 		exit;
		$this->setData(array(
            'pageMetaTitle'         =>  !empty($pageContentsListing->meta_title) ? $pageContentsListing->meta_title :  Yii::t('app',  'Properties Listing' . '  | {project} ', array('{project}' => $this->project_name)),
			'noFooter'     =>  $file_view == 'index_map' ? '1' : false,
			'newMetaTitle' => $m_title,
            'pageTitle'             =>  !empty($pageContentsListing->meta_title) ? $pageContentsListing->meta_title : $m_title,
			'meta_keyword' => $newMetaKeywords,
            'pageMetaDescription'   => StringHelper::truncateLength(!empty($pageContentsListing->meta_description) ? $pageContentsListing->meta_description : $newMetaDescription, 150),
		));

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
		$cat_i = isset($formData['type_of']) ? $formData['type_of'] : $formData['category'];
		
		$pageContent = ListingContents::model()->getListingContent($formData['sec'], $cat_i, $formData['state'],  $formData['sub_category'], $formData['nested_sub_category']);

		if ($this->app->request->isAjaxRequest) {
		 	unset($formData['_pjax']);
			unset($formData['_']);
			// echo $file_view;exit;
			if (isset($_GET['pja']) and $this->app->request->isAjaxRequest) {
				$this->renderPartial('_left_column', compact('pageContent', 'locations', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'b_1', 'b_2', 'b_3', 'l_view', 'stateModel', 'search_url', 'found_search', 'load_location', 'active_state', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'state_name', 'country_name', 'country', 'pages', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'ads', 'limit'));
				exit;
			}
			//echo $file_view;exit;
			$this->renderPartial($file_view, compact('pageContent', 'locations', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'b_1', 'b_2', 'b_3', 'l_view', 'stateModel', 'search_url', 'found_search', 'load_location', 'active_state', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'state_name', 'country_name', 'country', 'pages', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'ads', 'limit'));
			$this->app->end();
		}
		
		$this->render($file_view, compact('pageContent', 'locations', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'l_view', 'stateModel', 'b_1', 'b_2', 'b_3', 'search_url', 'found_search', 'load_location', 'active_state', 'currency_code', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'pages', 'state_name', 'country_name', 'country', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'limit'));
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
		$works =   BusinessForSale::model()->findAds($formData, $count_future, false, $calculate);
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

			$msgHTML .= $this->renderPartial('_list_proprty_business', compact('works', 'checkIcon', 'property_of_featured_developers'), true);

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


		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css'), 'priority' => -100));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.js'), 'priority' => -100));

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

		/*keyword end*/
		$sub = '';
		$main = '';
		if (!empty($category)) {

			$categoryModelm =   Category::model()->categoryIdLan($category);
			if (!empty($categoryModelm)) {
				$formData['type_of'][] = $category;
			}
		} else if (isset($formData['type_of']) and sizeOf($formData['type_of']) == '1') {

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
		} else if (isset($formData['cat']) and sizeOf($formData['cat']) == '1') {
			$categoryModelm =   Category::model()->categoryIdLan($formData['cat'][0]);
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





		$filterModel = new BusinessForSale();
		$filterModel->attributes = $formData;
		$filterModel->section_id = @$formData['sec'];


		if ($country_id) {
			$filterModel->country = $country_id;
		}
		$this->sec_id = $filterModel->section_id;

		$m_title = '';
		$s_suffix = LANGUAGE == 'en' ? 's' : '';
		$msgHTML  = $this->renderPartial('_arab_avenue_filter_business', compact('locations', 'areaData', 'regions', 'cityDats', 'region_list', 'm_title', 'locationas', 'l_view', 'stateModel', 'b_1', 'b_2', 'b_3', 'search_url', 'found_search', 'load_location', 'active_state', 'currency_code', 'section_title', 'country_id', 'state_id', 'ads', 'adsCount', 'pages', 'state_name', 'country_name', 'country', 'state', 'title', 'community', 'filterModel', 'formData', 'city', 'active_city', 'categoryModelm', 'userM', 'limit'), true, true);
		echo  json_encode(array('html' => $msgHTML));
		exit;
	}
}
