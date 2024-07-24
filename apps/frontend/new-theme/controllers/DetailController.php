<?php defined('MW_PATH') || exit('No direct script access allowed');

class DetailController extends Controller
{

	public function init()
	{

		parent::Init();
	}
	public function actionShort_link($id = null)
	{
		$model =  PlaceAnAd::model()->findByPk((int) $id);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (!empty($model)) {
			$this->actionIndex($model->slug);
		}
	}

	public function actionIndex($slug = null, $id = null)
	{
		ini_set("memory_limit", "-1");
		$mod = new PlaceAnAd();
		$criteria = new CDbCriteria;
		//$criteria->select = 't.*,'.$mod->FetauredQuery.'usr.enable_l_f,usr.slug as user_slug,usr.premium as premium_u,ct.image as location_image,ct.location_latitude as city_location_latitude,ct.location_longitude as city_location_longitude,usr.whatsapp as whatsapp,usr.full_number as mobile_number,sec.slug as sec_slug,con.country_name as country_name,ct.city_name as city_name ,cat.slug as category_slug ,   sub_com.sub_community_name as sub_community_name,st.state_name as state_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.company_name as company_name,usr.first_name,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';
		$criteria->select = 't.*,p_usr.user_id as puser_id,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.cr_number ELSE usr.cr_number END as cr_number,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.licence_no ELSE usr.licence_no END as licence_no,CASE WHEN p_usr.a_chara_ar  is NOT NULL THEN p_usr.a_chara_ar ELSE usr.a_chara_ar END as advertiser_character,usr.slug as agent_slug ,usr.email as user_email,usr.image as image ,usr.total_reviews as total_reviews ,usr.avg_r as avg_r , ' . $mod->FetauredQuery . 'CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.enable_l_f ELSE usr.enable_l_f END as enable_l_f,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.slug ELSE  usr.slug END   as user_slug,usr.premium as premium_u,ct.image as location_image,ct.location_latitude as city_location_latitude,ct.location_longitude as city_location_longitude,usr.whatsapp as whatsapp,usr.full_number as mobile_number,sec.slug as sec_slug,con.country_name as country_name,ct.city_name as city_name ,cat.slug as category_slug ,cat.image as category_img,   sub_com.sub_community_name as sub_community_name,st.state_name as state_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,CASE WHEN p_usr.image is NOT NULL THEN p_usr.image ELSE  usr.image END  as user_image,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.company_name ELSE usr.company_name END as company_name,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.company_name_ar ELSE usr.company_name_ar END as company_name_ar,usr.first_name,usr.first_name_ar,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';

		$criteria->condition = '1';
		if (Yii::app()->request->getQuery('showTrash', '0') == '0') {
			$criteria->compare('t.isTrash', '0');
			$criteria->compare('t.status', 'A');
		}
		$criteria->select .= ',lstype.category_name as listing_category ,lstype.slug as l_slug,  (t.builtup_area*(1/au.value))   as converted_unit,au.master_name as atitle,au.master_name as atitle,au2.master_name as atitle2 ';

		$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
		$criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
		$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
		$criteria->join  .= ' left join {{area_unit}} au2 ON au2.master_id = t.area_unit_1 ';
		$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
		$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
		$criteria->join  .= ' LEFT JOIN {{city}} ct on ct.city_id = t.city';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = usr.parent_user ';
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		} else {
			$cookieName = 'USERFAV' . COUNTRY_ID;
			if ((isset(Yii::app()->request->cookies[$cookieName]))) {
				$cook =  Yii::app()->request->cookies[$cookieName]->value;
				//print_r($cook);exit; 
				if (!empty($cook) and is_array($cook)) {

					$userStr = implode("', '", $cook);
					$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav ";
				}
			}
		}
		$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->join  .= ' left join `mw_translate` `translateadesc` on (  translateadesc.source_tag = concat("PlaceAnAd_ad_description_",t.id) )          left join `mw_translate_relation` `translationRelationaddesc` on translationRelationaddesc.ad_id = t.id  and  translationRelationaddesc.translate_id = translateadesc.translate_id  LEFT  JOIN mw_translation_data tdataaddesc ON (`translationRelationaddesc`.translate_id=tdataaddesc.translation_id and tdataaddesc.lang=:lan2  ) ';
		$criteria->join  .= ' left join `mw_translate` `translateadarea` on (  translateadarea.source_tag = concat("PlaceAnAd_area_location_",t.id) )          left join `mw_translate_relation` `translationRelationadarea` on translationRelationadarea.ad_id = t.id  and  translationRelationadarea.translate_id = translateadarea.translate_id  LEFT  JOIN mw_translation_data tdataadarea ON (`translationRelationadarea`.translate_id=tdataadarea.translation_id and tdataadarea.lang=:lan2  ) ';

		$criteria->select .= ',tdataad.message as ad_title2,tdataaddesc.message as ad_description2,tdataadarea.message as area_location2';
		$criteria->params[':lan2'] = 'ar';
		$criteria->distinct   = 't.id';
		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';

				/*
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = ct.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE ct.city_name  END as  city_name  ';
				*/

				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';

				//$criteria->join  .= ' left join `mw_translate`  translate2user  on ( translate2user.source_tag = concat("ListingUsers_company_name_","",p_usr.user_id) )   left join `mw_translate_relation` `translationRelation2usr` on translationRelation2usr.user_id = p_usr.user_id  and  translationRelation2usr.translate_id = translate2user.translate_id  LEFT  JOIN mw_translation_data tdata2usr ON (`translationRelation2usr`.translate_id=tdata2usr.translation_id and tdata2usr.lang=:lan  ) ';
				//$criteria->join  .= ' left join `mw_translate`  translate1usr  on ( translate1usr.source_tag = concat("ListingUsers_company_name_","",t.user_id) )   left join `mw_translate_relation` `translationRelation1usr` on translationRelation1usr.user_id = t.user_id  and  translationRelation1usr.translate_id = translate1usr.translate_id  LEFT  JOIN mw_translation_data tdata1usr ON (`translationRelation1usr`.translate_id=tdata1usr.translation_id and tdata1usr.lang=:lan  ) ';
				//$criteria->select   .= ' , ( CASE WHEN p_usr.user_id IS NOT NULL THEN ( CASE WHEN tdata2usr.message IS NOT NULL AND translate2user.source_tag IS NOT NULL    THEN  tdata2usr.message ELSE p_usr.company_name END ) ELSE ( CASE  WHEN tdata1usr.message IS NOT NULL AND translate1usr.source_tag IS NOT NULL    THEN  tdata1usr.message ELSE usr.company_name END)  END ) 	 as  company_name   ';

				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.id';
			}
		}
		$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';
		if (empty($id)) {
			if (defined('LANGUAGE') and LANGUAGE == 'ar'  and isset($_GET['slug_ar'])) {
				$criteria->condition .= ' and t.slug_ar=:slug ';
				$criteria->params[':slug'] = isset($_GET['slug_ar']) ? $_GET['slug_ar'] : $slug;
			} else if (defined('LANGUAGE') and LANGUAGE == 'en' and isset($_GET['slug_en'])) {
				$criteria->condition .= ' and t.slug_en=:slug ';
				$criteria->params[':slug'] = isset($_GET['slug_en']) ? $_GET['slug_en'] : $slug;
			} else {
				$criteria->condition .= ' and t.slug=:slug ';
				$criteria->params[':slug'] = $slug;
			}
		} else {
			$criteria->condition .= ' and t.id=:id ';
			$criteria->params[':id'] = $id;
		}
		$model = $mod->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		//echo $model->mobile_number;exit;
		define('RETURN_URL',  $model->id);
		if (isset($_POST['ajax'])) {
			$model->scenario = 'update_content';
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		$request = Yii::app()->request;
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->scenario = 'update_content';
			$model->attributes = $attributes;
			if ($model->validate()) {
				$model->updateByPk($model->id, array('ad_description' => $model->ad_description));
				$this->refresh();
			} else {
				$notify = Yii::app()->notify;
				$notify->addError(Yii::t('app', CHtml::errorSummary($model)));
			}
		} else {

			$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
			$u_id = Yii::app()->user->getId();
			$u_id = empty($u_id) ? 'NULL' : $u_id;
			$ip = inet_pton($this->get_client_ip());
			//cal inet_ntop to reverse from mysql  
			$values =  "('{$model->id}'," . $u_id . "  ,'{$u_date}','{$ip}','1')";

			try {
				$sql = "insert into  {{statistics_page}} (pid,user_id,date,ip,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
				Yii::app()->db->createCommand($sql)->execute();
			} catch (Exception $e) {
			}
		}
		define('sell_title', $this->tag->getTag('post_property', 'Post Property'));
		define('sell_url', $this->app->createUrl('place_an_ad_no_login/create', array('type' => 'property')));


		$this->getData('pageStyles')->mergeWith(array(
			//  array('src' => $this->appAssetUrl('css/property-web.css') , 'priority' => '1'),
			// array('src' => $this->appAssetUrl('css/icons.css') , 'priority' => '9' ),
			// array('src' => $this->appAssetUrl('css/search-web.css') , 'priority' =>'2' ),
			// array('src' => $this->appAssetUrl('css/inner-style.css') , 'priority' =>'3' ),
			//array('src' => $this->appAssetUrl('css/main11.css') , 'priority' =>'4' ),
			// array('src' => $this->app->apps->getBaseUrl('assets/css/property_detail.css?q=1') , 'priority' =>'4' ),
		));
		// $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/bootstrap.min.js'), 'priority' => -1000));   

		//  $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/_right_detail1.js'), 'priority' => -100));   
		//   $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/owl.carousel.min.js'), 'priority' => -100));   
		$titl = LANGUAGE == 'ar' ? $model->MetaTitleArabic : $model->MetaTitleEnglish;

		$description = LANGUAGE == 'ar' ? $model->MetaDescriptionArabic : $model->MetaDescriptionEnglish;
		$this->setData(array(
			'pageTitle'         =>  $titl . '  | ' . BRAND_TITLE,
			'pageMetaDescription'   => $description,

			'image'   =>    ASKAAN_PATH_CONTSTANT . '/uploads/files/' . $model->ad_image,
			'title'   =>    $titl,
			'shareUrl' => $model->DetailUrlAbs,
			'description'   => $description,
		));
		$floor = array(); //$model->adFloorPlans;
		if (!empty($model->view_floor)) {
			$floor =   $model->adFloorPlans;
		}
		$video_list =  array();
		if (!empty($model->view_360) or !empty($model->view_video)) {
			$video_list = $model->aVideos;
		}

		$array =  $model->detailList();
		$total_rest = $model->activePropertys;
		$banner = new Banner();
		$b_1 = array(); //$banner->newBannerFn(9);
		$b_2 =  array(); //$banner->newBannerFn(22);

		$b_1 = $banner->findPosition($model->section_id, '', 1);
		$b_2 = $banner->findPosition($model->section_id, '', 2);
		$b_3 = $banner->findPosition($model->section_id, '', 3);


		$hasedit = false;
		if (Yii::app()->user->getId() and Yii::app()->user->getState("super_user", '0') == '1') {
			$hasedit = true;
		}
		/*seraching */
		$my_views_n  =	array();
		$total_items_incookie = 6;

		if ((isset(Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]))) {
			$my_views_n  =   Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]->value;
		}


		$uniquer = $model->slug;
		$pos = array_search($model->id, $my_views_n);
		if ($pos) {
			unset($my_views_n[$pos]);
		}

		array_unshift($my_views_n, $model->id);
		//$my_views_n[$uniquer] = $model->id ;

		$my_views_n = array_slice($my_views_n, 0, $total_items_incookie);
		//$my_views_n = array_reverse($my_views_n);
		// print_r($my_views_n);exit;
		$cookie = new CHttpCookie('my_views_n' . COUNTRY_ID, $my_views_n);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['my_views_n' . COUNTRY_ID] = $cookie;
		/*seraching */

		define('LIST_URL_TITLE', $model->section_id == '1' ? 'for Sale' : 'to Rent');
		define('LIST_URL', $this->app->createAbsoluteUrl('listing/index', array('sec' => $model->sec_slug)));
		define('CITY_NAME', $model->state_name);
		define('CITY_URL', Yii::App()->createAbsoluteUrl('listing/index', array('sec' => $model->sec_slug, 'state' => $model->state_slug)));
		define('CATEGORY_NAME', $model->category_name);
		define('CATEGORY_URL', Yii::App()->createAbsoluteUrl('listing/index', array('sec' => $model->sec_slug, 'type_of' => $model->category_slug)));
		define('AD_TITLE', $model->ad_title);
		define('AD_URL', CURRENT_URL);
		

		if ($this->app->request->isAjaxRequest) {

			// echo $file_view;exit;
			$this->renderPartial('index', compact('hasedit', 'model', 'floor', 'array', 'b_1', 'b_2', 'b_3', 'total_rest', 'video_list'));
			$this->app->end();
		}
		$this->render('index', compact('hasedit', 'model', 'floor', 'array', 'b_1', 'b_2', 'b_3', 'total_rest', 'video_list'));
	}

	public function actionProject($slug = null)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.*,usr.enable_l_f,usr.premium as premium_u,usr.whatsapp as whatsapp,cat.slug as category_slug,usr.full_number as mobile_number,sec.slug as sec_slug,con.country_name as country_name,usr.company_name as company_name,sub_com.sub_community_name as sub_community_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.first_name,usr.last_name,usr.description as user_description,usr.phone as user_number,usr.email as user_email,usr.company_name as company_name2,usr.website as user_website,usr.address as user_address,usr.user_type as user_type,usr.slug as user_slug,sec.section_name,st.state_name as state_name,com.community_name,(SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0" limit 1 )   as ad_image';
		$criteria->condition = '1';
		if (Yii::app()->request->getQuery('showTrash', '0') == '0') {
			$criteria->compare('t.isTrash', '0');
			$criteria->compare('t.status', 'A');
		}
		$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
		$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
		$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';
		$criteria->condition .= ' and t.slug=:slug ';
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		}
		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';


				$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translateadesc` on (  translateadesc.source_tag = concat("PlaceAnAd_ad_description_",t.id) )          left join `mw_translate_relation` `translationRelationaddesc` on translationRelationaddesc.ad_id = t.id  and  translationRelationaddesc.translate_id = translateadesc.translate_id  LEFT  JOIN mw_translation_data tdataaddesc ON (`translationRelationaddesc`.translate_id=tdataaddesc.translation_id and tdataaddesc.lang=:lan  ) ';
				$criteria->select .= ',tdataad.message as ad_title2,tdataaddesc.message as ad_description2';


				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.id';
			}
		}
		$criteria->params[':slug'] = $slug;
		$model = PlaceAnAd::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (!Yii::app()->request->isPostRequest) {
			$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
			$u_id = Yii::app()->user->getId();
			$u_id = empty($u_id) ? 'NULL' : $u_id;
			$ip = inet_pton($this->get_client_ip());
			//cal inet_ntop to reverse from mysql  
			$values =  "('{$model->id}'," . $u_id . "  ,'{$u_date}','{$ip}','1')";

			try {
				$sql = "insert into  {{statistics_page}} (pid,user_id,date,ip,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
				Yii::app()->db->createCommand($sql)->execute();
			} catch (Exception $e) {
			}
		}
		/*	
			$apps = Yii::app()->apps;
				$this->getData('pageStyles')->mergeWith(array(
                array('src' => $this->appAssetUrl('css/property-web.css') , 'priority' => '1'),
                array('src' => $this->appAssetUrl('css/icons.css') , 'priority' => '9' ),
                array('src' =>  $apps->getBaseUrl('assets/css/fancybox/style.css?q=2') , 'priority' => '9' ),
                array('src' =>  $apps->getBaseUrl('assets/css/fancybox/jquery.fancybox-1.3.4.css') , 'priority' => '9' ),
                array('src' =>  $this->appAssetUrl('css/zerogrid.css') , 'priority' => '9' ),
                array('src' =>  $apps->getBaseUrl('assets/css/detail_project.css?q=1') , 'priority' => '9' ),
               ));
			     $this->getData('pageScripts')->add(array('src' =>  Yii::app()->apps->getBaseUrl('assets/js/autocomplete.min.js'), 'priority' => -100));     
	
          $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/bootstrap.min.js'), 'priority' => -1000));   
          $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/_right_detail1.js?q=2'), 'priority' => -100));   
          $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/owl.carousel.min.js'), 'priority' => -100));  
          * 
          */

		$floor = $model->adFloorPlans;

		define('sell_title', $this->tag->getTag('post_project', 'Post Project '));
		define('sell_url', $this->app->createUrl('new_projects/create'));

		$tit =  Yii::t('app', '{name}', array('{name}' => !empty($model->meta_title) ? $model->meta_title : $model->ad_title, '{p}' => $this->options->get('system.common.site_name')));

		$this->setData(array(
			'pageTitle'         => $tit . ' | ' . BRAND_TITLE,
			'pageMetaDescription'   => !empty($model->meta_description) ? $model->meta_description : StringHelper::truncateLength($model->ad_description, 160),

			'image'   =>    ASKAAN_PATH_CONTSTANT . '/uploads/files/' . $model->ad_image,
			'title'   =>   $model->ad_title,
			'shareUrl' => $model->detailUrlAbsolute,
			'description'   =>   $model->ShortDescription,

		));
		$payment_plan = $model->paymentTypes;
		if ($this->app->request->isAjaxRequest) {

			// echo $file_view;exit;
			$this->renderPartial('index_project', compact('model', 'floor', 'payment_plan'));
			$this->app->end();
		}

		$this->render('index_project', compact('model', 'floor', 'payment_plan'));
		//$this->render( 'index',compact('model'));
	}
	public function actionIndex_business($slug = null, $id = null)
	{

		$mod = new BusinessForSale();
		$criteria = new CDbCriteria;
		//$criteria->select = 't.*,'.$mod->FetauredQuery.'usr.enable_l_f,usr.slug as user_slug,usr.premium as premium_u,ct.image as location_image,ct.location_latitude as city_location_latitude,ct.location_longitude as city_location_longitude,usr.whatsapp as whatsapp,usr.full_number as mobile_number,sec.slug as sec_slug,con.country_name as country_name,ct.city_name as city_name ,cat.slug as category_slug ,   sub_com.sub_community_name as sub_community_name,st.state_name as state_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.company_name as company_name,usr.first_name,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';
		$criteria->select = 't.*,p_usr.user_id as puser_id,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.cr_number ELSE usr.cr_number END as cr_number,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.licence_no ELSE usr.licence_no END as licence_no,CASE WHEN p_usr.a_chara_ar  is NOT NULL THEN p_usr.a_chara_ar ELSE usr.a_chara_ar END as advertiser_character,usr.slug as agent_slug ,usr.email as user_email,usr.image as image ,usr.total_reviews as total_reviews ,usr.avg_r as avg_r , ' . $mod->FetauredQuery . 'CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.enable_l_f ELSE usr.enable_l_f END as enable_l_f,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.slug ELSE  usr.slug END   as user_slug,usr.premium as premium_u,ct.image as location_image,ct.location_latitude as city_location_latitude,ct.location_longitude as city_location_longitude,usr.whatsapp as whatsapp,usr.full_number as mobile_number,sec.slug as sec_slug,con.country_name as country_name,ct.city_name as city_name ,cat.slug as category_slug ,   sub_com.sub_community_name as sub_community_name,st.state_name as state_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,CASE WHEN p_usr.image is NOT NULL THEN p_usr.image ELSE  usr.image END  as user_image,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.company_name ELSE usr.company_name END as company_name,CASE WHEN p_usr.user_id  is NOT NULL THEN p_usr.company_name_ar ELSE usr.company_name_ar END as company_name_ar,usr.first_name,usr.first_name_ar,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';

		$criteria->condition = '1';
		if (Yii::app()->request->getQuery('showTrash', '0') == '0') {
			$criteria->compare('t.isTrash', '0');
			$criteria->compare('t.status', 'A');
		}
		$criteria->select .= ',lstype.category_name as listing_category ,lstype.slug as l_slug,  (t.builtup_area*(1/au.value))   as converted_unit,au.master_name as atitle,au.master_name as atitle,au2.master_name as atitle2 ';

		$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
		$criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
		$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
		$criteria->join  .= ' left join {{area_unit}} au2 ON au2.master_id = t.area_unit_1 ';
		$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
		$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
		$criteria->join  .= ' LEFT JOIN {{city}} ct on ct.city_id = t.city';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = usr.parent_user ';
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		} else {
			$cookieName = 'USERFAV' . COUNTRY_ID;
			if ((isset(Yii::app()->request->cookies[$cookieName]))) {
				$cook =  Yii::app()->request->cookies[$cookieName]->value;
				//print_r($cook);exit; 
				if (!empty($cook) and is_array($cook)) {

					$userStr = implode("', '", $cook);
					$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav ";
				}
			}
		}
		$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->join  .= ' left join `mw_translate` `translateadesc` on (  translateadesc.source_tag = concat("PlaceAnAd_ad_description_",t.id) )          left join `mw_translate_relation` `translationRelationaddesc` on translationRelationaddesc.ad_id = t.id  and  translationRelationaddesc.translate_id = translateadesc.translate_id  LEFT  JOIN mw_translation_data tdataaddesc ON (`translationRelationaddesc`.translate_id=tdataaddesc.translation_id and tdataaddesc.lang=:lan2  ) ';
		$criteria->join  .= ' left join `mw_translate` `translateadarea` on (  translateadarea.source_tag = concat("PlaceAnAd_area_location_",t.id) )          left join `mw_translate_relation` `translationRelationadarea` on translationRelationadarea.ad_id = t.id  and  translationRelationadarea.translate_id = translateadarea.translate_id  LEFT  JOIN mw_translation_data tdataadarea ON (`translationRelationadarea`.translate_id=tdataadarea.translation_id and tdataadarea.lang=:lan2  ) ';

		$criteria->select .= ',tdataad.message as ad_title2,tdataaddesc.message as ad_description2,tdataadarea.message as area_location2';
		$criteria->params[':lan2'] = 'ar';
		$criteria->distinct   = 't.id';
		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';

				/*
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = ct.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE ct.city_name  END as  city_name  ';
				*/

				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';

				//$criteria->join  .= ' left join `mw_translate`  translate2user  on ( translate2user.source_tag = concat("ListingUsers_company_name_","",p_usr.user_id) )   left join `mw_translate_relation` `translationRelation2usr` on translationRelation2usr.user_id = p_usr.user_id  and  translationRelation2usr.translate_id = translate2user.translate_id  LEFT  JOIN mw_translation_data tdata2usr ON (`translationRelation2usr`.translate_id=tdata2usr.translation_id and tdata2usr.lang=:lan  ) ';
				//$criteria->join  .= ' left join `mw_translate`  translate1usr  on ( translate1usr.source_tag = concat("ListingUsers_company_name_","",t.user_id) )   left join `mw_translate_relation` `translationRelation1usr` on translationRelation1usr.user_id = t.user_id  and  translationRelation1usr.translate_id = translate1usr.translate_id  LEFT  JOIN mw_translation_data tdata1usr ON (`translationRelation1usr`.translate_id=tdata1usr.translation_id and tdata1usr.lang=:lan  ) ';
				//$criteria->select   .= ' , ( CASE WHEN p_usr.user_id IS NOT NULL THEN ( CASE WHEN tdata2usr.message IS NOT NULL AND translate2user.source_tag IS NOT NULL    THEN  tdata2usr.message ELSE p_usr.company_name END ) ELSE ( CASE  WHEN tdata1usr.message IS NOT NULL AND translate1usr.source_tag IS NOT NULL    THEN  tdata1usr.message ELSE usr.company_name END)  END ) 	 as  company_name   ';

				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.id';
			}
		}
		$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';
		if (empty($id)) {
			if (defined('LANGUAGE') and LANGUAGE == 'ar'  and isset($_GET['slug_ar'])) {
				$criteria->condition .= ' and t.slug_ar=:slug ';
				$criteria->params[':slug'] = isset($_GET['slug_ar']) ? $_GET['slug_ar'] : $slug;
			} else if (defined('LANGUAGE') and LANGUAGE == 'en' and isset($_GET['slug_en'])) {
				$criteria->condition .= ' and t.slug_en=:slug ';
				$criteria->params[':slug'] = isset($_GET['slug_en']) ? $_GET['slug_en'] : $slug;
			} else {
				$criteria->condition .= ' and t.slug=:slug ';
				$criteria->params[':slug'] = $slug;
			}
		} else {
			$criteria->condition .= ' and t.id=:id ';
			$criteria->params[':id'] = $id;
		}
		$model = $mod->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		//echo $model->mobile_number;exit;
		define('RETURN_URL',  $model->id);
		if (isset($_POST['ajax'])) {
			$model->scenario = 'update_content';
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		$request = Yii::app()->request;
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->scenario = 'update_content';
			$model->attributes = $attributes;
			if ($model->validate()) {
				$model->updateByPk($model->id, array('ad_description' => $model->ad_description));
				$this->refresh();
			} else {
				$notify = Yii::app()->notify;
				$notify->addError(Yii::t('app', CHtml::errorSummary($model)));
			}
		} else {

			$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
			$u_id = Yii::app()->user->getId();
			$u_id = empty($u_id) ? 'NULL' : $u_id;
			$ip = inet_pton($this->get_client_ip());
			//cal inet_ntop to reverse from mysql  
			$values =  "('{$model->id}'," . $u_id . "  ,'{$u_date}','{$ip}','1')";

			try {
				$sql = "insert into  {{statistics_page}} (pid,user_id,date,ip,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
				Yii::app()->db->createCommand($sql)->execute();
			} catch (Exception $e) {
			}
		}
		define('sell_title', $this->tag->getTag('sell_your_business', 'Sell Your Business'));
		define('sell_url', $this->app->createUrl('place_an_ad_no_login/create', array('type' => 'business')));

		$this->getData('pageStyles')->mergeWith(array(
			//  array('src' => $this->appAssetUrl('css/property-web.css') , 'priority' => '1'),
			// array('src' => $this->appAssetUrl('css/icons.css') , 'priority' => '9' ),
			// array('src' => $this->appAssetUrl('css/search-web.css') , 'priority' =>'2' ),
			// array('src' => $this->appAssetUrl('css/inner-style.css') , 'priority' =>'3' ),
			//array('src' => $this->appAssetUrl('css/main11.css') , 'priority' =>'4' ),
			// array('src' => $this->app->apps->getBaseUrl('assets/css/property_detail.css?q=1') , 'priority' =>'4' ),
		));
		// $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/bootstrap.min.js'), 'priority' => -1000));   

		//  $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/_right_detail1.js'), 'priority' => -100));   
		//   $this->getData('pageScripts')->add(array('src' => $this->appAssetUrl('scripts/owl.carousel.min.js'), 'priority' => -100));   
		$titl = LANGUAGE == 'ar' ? $model->MetaTitleArabic : $model->MetaTitleEnglish;

		$description = LANGUAGE == 'ar' ? $model->MetaDescriptionArabic : $model->MetaDescriptionEnglish;
		$this->setData(array(
			'pageTitle'         =>  $titl . '  | ' . BRAND_TITLE,
			'pageMetaDescription'   => $description,

			'image'   =>    ASKAAN_PATH_CONTSTANT . '/uploads/files/' . $model->ad_image,
			'title'   =>    $titl,
			'shareUrl' => $model->DetailUrlAbs,
			'description'   => $description,
		));
		$floor = array(); //$model->adFloorPlans;
		if (!empty($model->view_floor)) {
			$floor =   $model->adFloorPlans;
		}
		$video_list =  array();
		if (!empty($model->view_360) or !empty($model->view_video)) {
			$video_list = $model->aVideos;
		}

		$array =  $model->detailList();
		$total_rest = $model->activePropertys;
		$banner = new Banner();
		$b_1 = array(); //$banner->newBannerFn(9);
		$b_2 =  array(); //$banner->newBannerFn(22);

		$b_1 = $banner->findPosition($model->section_id, '', 1);
		$b_2 = $banner->findPosition($model->section_id, '', 2);
		$b_3 = $banner->findPosition($model->section_id, '', 3);


		$hasedit = false;
		if (Yii::app()->user->getId() and Yii::app()->user->getState("super_user", '0') == '1') {
			$hasedit = true;
		}
		/*seraching */
		$my_views_n  =	array();
		$total_items_incookie = 6;

		if ((isset(Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]))) {
			$my_views_n  =   Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]->value;
		}


		$uniquer = $model->slug;
		$pos = array_search($model->id, $my_views_n);
		if ($pos) {
			unset($my_views_n[$pos]);
		}

		array_unshift($my_views_n, $model->id);
		//$my_views_n[$uniquer] = $model->id ;

		$my_views_n = array_slice($my_views_n, 0, $total_items_incookie);
		//$my_views_n = array_reverse($my_views_n);
		// print_r($my_views_n);exit;
		$cookie = new CHttpCookie('my_views_n' . COUNTRY_ID, $my_views_n);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['my_views_n' . COUNTRY_ID] = $cookie;
		/*seraching */
		define('LIST_URL_TITLE',   'for Sale');
		define('LIST_URL', $this->app->createAbsoluteUrl('business_listing/index', array('sec' => $model->sec_slug)));
		define('CITY_NAME', $model->state_name);
		define('CITY_URL', Yii::App()->createAbsoluteUrl('business_listing/index', array('sec' => $model->sec_slug, 'state' => $model->state_slug)));
		define('CATEGORY_NAME', $model->category_name);
		define('CATEGORY_URL', Yii::App()->createAbsoluteUrl('business_listing/index', array('sec' => $model->sec_slug, 'type_of' => $model->category_slug)));
		define('AD_TITLE', $model->ad_title);
		define('AD_URL', CURRENT_URL);

		if ($this->app->request->isAjaxRequest) {

			// echo $file_view;exit;
			$this->renderPartial('index', compact('hasedit', 'model', 'floor', 'array', 'b_1', 'b_2', 'b_3', 'total_rest', 'video_list'));
			$this->app->end();
		}
		$this->render('index_business', compact('hasedit', 'model', 'floor', 'array', 'b_1', 'b_2', 'b_3', 'total_rest', 'video_list'));
	}

	public function actionValidateEnquiry()
	{
		$model = new SendEnquiry;
		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			$id = $model->ad_id;
			$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
			$u_id = Yii::app()->user->getId();
			$u_id = empty($u_id) ? '31845' : $u_id;
			if (!empty($u_id) and !empty($id)) {
				$values =  "('{$id}','{$u_id}' ,'E','{$u_date}','1')";
				try {
					$sql = "insert into  {{statistics}} (id,user_id,type,date,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
					Yii::app()->db->createCommand($sql)->execute();
				} catch (Exception $e) {
				}
			}
			Yii::app()->end();
		}
	}
	public function actionSendEnquiry()
	{
		$request    = Yii::app()->request;
		$model  = new SendEnquiry();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> ' . CHtml::errorSummary($model) . '. </div>'));
				Yii::app()->end();
			} else {
				echo json_encode(array('status' => '1', 'msg' => '<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				Yii::app()->end();
			}
		}
	}
	public function actionValidateEnquiry2()
	{
		$model = new SendEnquiry2;
		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			$id = $model->ad_id;
			$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
			$u_id = Yii::app()->user->getId();
			$u_id = empty($u_id) ? '31988' : $u_id;
			if (!empty($u_id) and !empty($id)) {
				$values =  "('{$id}','{$u_id}' ,'E','{$u_date}','1')";
				try {
					$sql = "insert into  {{statistics}} (id,user_id,type,date,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
					Yii::app()->db->createCommand($sql)->execute();
				} catch (Exception $e) {
					print_r($e->getMessage());
					exit;
				}
			}
			Yii::app()->end();
		}
	}
	public function actionSendEnquiry2()
	{
		$request    = Yii::app()->request;
		$model  = new SendEnquiry2();
		$requestParms = $request->getPost("SendEnquiry2");

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> ' . CHtml::errorSummary($model) . '. </div>'));
				Yii::app()->end();
			} else {
				// Start Crm
				$customerId = 0;
				$createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';

				// Prepare data for the request
				$fullName = $requestParms['name'];

				// Split the full name into an array using spaces as the delimiter
				$nameParts = explode(' ', $fullName);

				// Extract the first and last names
				$firstName = isset($nameParts[0]) ? $nameParts[0] : null;
				$lastName = isset($nameParts[1]) ? $nameParts[1] : null;

				$crmCustomerData = [
					'fields' => [
						'NAME' => $firstName,
						'SECOND_NAME' => $lastName,
						"TYPE_ID" => "CLIENT",
						"SOURCE_ID" => "SELF",
						"EMAIL" => [["VALUE" => $requestParms['email'], "VALUE_TYPE" => "WORK"]],
						"PHONE" => [["VALUE" => $requestParms['phone'], "VALUE_TYPE" => "WORK"]]
					],
				];
				$postCustomerData = http_build_query($crmCustomerData);
				$contextCusotomerOptions = [
					'http' => [
						'method' => 'POST',
						'header' => 'Content-Type: application/x-www-form-urlencoded',
						'content' => $postCustomerData,
					],
				];
				$contextCreateCustomer = stream_context_create($contextCusotomerOptions);
				try {
					// Send the HTTP request using file_get_contents
					$data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
					$response = json_decode($data, true);
					$customerId = $response['result'];
					// Handle the CRM response as needed

				} catch (Exception $e) {
					// Handle exceptions, e.g., connection errors
					echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger1"><strong>Error!</strong> ' . CHtml::errorSummary($e->getMessage()) . '. </div>'));
				}

				$crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';

				// Prepare data for the request
				$crmData = [
					'FIELDS' => [
						'TITLE' => 'RGestate Lead - Property Listing Form',
						'CONTACT_ID' => $customerId,
						'COMMENTS' => $requestParms['meassage'],
						'ASSIGNED_BY_ID' => 22
					],
				];

				// Convert data to a query string
				$postData = http_build_query($crmData);

				// Set up options for the stream context
				$contextOptions = [
					'http' => [
						'method' => 'POST',
						'header' => 'Content-Type: application/x-www-form-urlencoded',
						'content' => $postData,
					],
				];

				$context = stream_context_create($contextOptions);


				try {
					// Send the HTTP request using file_get_contents
					$response = file_get_contents($crmUrl, false, $context);

					// Handle the CRM response as needed

				} catch (Exception $e) {
					// Handle exceptions, e.g., connection errors
					echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger1"><strong>Error!</strong> ' . CHtml::errorSummary($e->getMessage()) . '. </div>'));
				}

				if ($model->hasErrors()) {
					echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger1"><strong>Error!</strong> ' . CHtml::errorSummary($model) . '. </div>'));
				} else {
					if (!$model->save()) {
						echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger1"><strong>Error!</strong> ' . CHtml::errorSummary($model) . '. </div>'));
					} else {
						echo json_encode(array('status' => '1', 'name' => $model->email, 'msg' => '<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
					}
				}


				// End Crm

				//   echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				Yii::app()->end();
			}
		}
	}

	public function actionContact_property($id = null, $user_id = null)
	{


		$modelCriteria  = PlaceAnAd::model()->findAds($formData = array(), $count_future = false, $returnCriteria = 1, $calculate = false, false);
		$modelCriteria->condition = Yii::t('app', $modelCriteria->condition, array('and t.section_id != 3' => ''));
		$modelCriteria->condition .= '   and t.id = :thisadid ';
		$modelCriteria->params[':thisadid']  = $id;
		$model =  PlaceAnAd::model()->find($modelCriteria);
		$images  = array();
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$u_date = $this->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d H:i:s');
		$u_id = Yii::app()->user->getId();
		if (!empty($u_id) and !empty($id)) {
			$values =  "('{$id}','{$u_id}' ,'E','{$u_date}','1')";
			try {
				$sql = "insert into  {{statistics}} (id,user_id,type,date,count) values {$values} ON DUPLICATE KEY UPDATE count=count+1";
				Yii::app()->db->createCommand($sql)->execute();
			} catch (Exception $e) {
			}
		}

		$cs = Yii::app()->clientScript;
		$cs->scriptMap = array(
			'jquery.js' =>  false,
			'jquery.min.js' =>    false,
			'jquery.yiiactiveform.js' =>    false,
		);

		$this->renderPartial("//detail/_contact_property", compact('model'), false, true);
	}
	function divider($number_of_digits)
	{
		$tens = "1";

		if ($number_of_digits > 8)
			return 10000000;

		while (($number_of_digits - 1) > 0) {
			$tens .= "0";
			$number_of_digits--;
		}
		return $tens;
	}
	public function getNewFormat($price)
	{
		$num = number_format($price, 0, '.', '');;

		$ext = ""; //thousand,lac, crore
		$number_of_digits = strlen($num); //this is call :)

		if ($number_of_digits <= 5) {

			return number_format($num, 0, '.', ',');
		}
		if ($number_of_digits > 3) {
			if ($number_of_digits % 2 != 0)
				$divider = $this->divider($number_of_digits - 1);
			else
				$divider = $this->divider($number_of_digits);
		} else
			$divider = 1;

		$fraction = $num / $divider;
		$fraction = number_format($fraction, 2);

		if ($number_of_digits == 6 || $number_of_digits == 7)
			$ext = "Lac";
		if ($number_of_digits == 8 || $number_of_digits == 9)
			$ext = "Cr";
		if ($number_of_digits > 9)
			$ext = "Cr";


		return $fraction . " " . $ext;
	}
	public function actionPrice_Trends($ytitle = null, $ytitle2 = null)
	{


		$title = urldecode($_POST['title']);
		$city_name = urldecode($_POST['city_name']);
		$ytitle2 = $_POST['ytitle2'];
		$ytitle = $_POST['ytitle'];
		$itemsArray = array();

		$price_trends_table = $this->app->options->get('system.common.price_trends_table1', '1');
		if ($price_trends_table == '2' or $price_trends_table == '3') {
			$statistics = PriceTrends::model()->pricetrends1($_GET);
			if (empty($statistics) and $price_trends_table == '3') {
				$statistics = PlaceAnAd::model()->pricetrends($_GET);
			}
			//print_r($statistics);exit; 
		} else {
			$statistics = PlaceAnAd::model()->pricetrends($_GET);
		}

		if (empty($statistics)) {
			echo json_encode(array('status' => '0'));
			exit;
		}
		$ar_items = array();
		if (!empty($statistics)) {
			foreach ($statistics as $k => $v) {

				$average_price =  (int)($v->price /  (int)$v->total_items);
				$ar_items[date('M Y', strtotime($v->date_added))] = array('price' => $average_price, 'formated' =>  number_format($average_price, 0, '.', ','));
			}
		}

		for ($i = 0; $i <= 18; $i++) {
			$months[] = date("M Y", strtotime(date('Y-m-01') . " -$i months"));
		}

		$previous_month = '';

		$reverse_array = array_reverse($months);

		foreach ($reverse_array as $month) {



			if (isset($ar_items[$month])) {
				$itemsArray[$month] = $ar_items[$month];
			} else if (isset($ar_items[$previous_month])) {
				$itemsArray[$month] = $ar_items[$previous_month];
				$ar_items[$month] = $ar_items[$previous_month];
			}
			$previous_month =  $month;
		}
		//  $itemsArray = array_reverse($itemsArray);


		//  $this->layout = 'price_trends'; 
		$this->setData(array(
			'pageTitle'         =>  'Prices & Trends',
			'pageMetaDescription'   =>  'Prices & Trends',
			'title'   =>  'Prices & Trends',
			'description'   => 'Prices & Trends',
		));



		echo json_encode(array('status' => '1', 'msg' => $this->renderPartial('_price_trends', compact('itemsArray', 'city_name', 'title', 'ytitle', 'ytitle2'), true, true)));
	}
	public function actionApplyloan($id = null, $bank_id = null)
	{


		$modelCriteria  = PlaceAnAd::model()->findAds($formData = array(), $count_future = false, $returnCriteria = 1, $calculate = false, false);
		$modelCriteria->condition .= '   and t.id = :thisadid ';
		$modelCriteria->params[':thisadid']  = $id;
		$model =  PlaceAnAd::model()->find($modelCriteria);
		$images  = array();
		if (empty($model)) {
			// throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));


		}
		$bankModel = Bank::model()->findByBankId($bank_id);
		if (empty($bankModel)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$cs = Yii::app()->clientScript;
		$cs->scriptMap = array(
			'jquery.js' =>  false,
			'jquery.min.js' =>    false,
		);

		$this->renderPartial("//detail/_applyloan_property", compact('model', 'bankModel'), false, true);
	}
	public function actionValidateAppication()
	{
		$model = new ApplyLoan;
		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionSendAppication()
	{
		$request    = Yii::app()->request;
		$model  = new ApplyLoan();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo json_encode(array('status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> ' . CHtml::errorSummary($model) . '. </div>'));
				Yii::app()->end();
			} else {
				echo json_encode(array('status' => '1', 'msg' => '<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				Yii::app()->end();
			}
		}
	}
	public function actionPreview($preview_id = null)
	{
		$request = Yii::app()->request;

		$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name' => $preview_id));
		if (empty($LocalStorage)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$post = unserialize($LocalStorage->file);
		$model = new PlaceAnAd();

		$model->attributes = $post['PlaceAnAd'];
		$model->amenities = $post['amenities'];
		$floor = array(); //$model->adFloorPlans;
		if (!empty($model->view_floor)) {
			$floor =   $model->adFloorPlans;
		}
		$video_list =  array();
		if (!empty($model->view_360)) {
			$video_list = $model->aVideos;
		}

		$image_array = array();
		if (!empty($model->image)) {
			$exp =  explode(",", $model->image);
			if ($exp) {
				foreach ($exp as $k => $v) {
					if ($v != "") {
						$image_array[] = $v;
					}
				}
			}
		}

		if (isset($post['floor_plan'])) {

			$postfloor =    $post['floor_plan'];
			$floor = array();
			if (!empty($postfloor)) {


				for ($i = 0; $i < sizeOf($postfloor['title']); $i++) {
					if (empty($postfloor['title'][$i])) {
					} else {


						$floor[$i]['floor_title'] = $postfloor['title'][$i];
						$floor[$i]['floor_file']  = $postfloor['file'][$i];
						if (isset($post['sqft'][$i])) {
							$floor[$i]['sqft']  = $postfloor['sqft'][$i];
						}
						$floor[$i]['file_type']  = $postfloor['file_type'][$i];
					}
				};
			}

			$floor =  json_decode(json_encode($floor), FALSE);;
		}
		$city  = City::model()->getById2((int)$model->city);

		if (!empty($city)) {
			$model->city_name = $city->city_name;
			$model->state_name = $city->state_name;
		}
		$array =  $model->detailList();
		$this->no_header = '1';
		$this->secure_header = '1';

		$this->render('index_preview', compact('hasedit', 'model', 'floor', 'array', 'b_1', 'b_2', 'total_rest', 'video_list', 'image_array'));
	}
	public function actionReview_agents($count_future = true, $calculate = false, $country_id2 = false, $state_id2 = false, $is_form = false, $hide_featured = false)
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
		$works =   AgentReview::model()->findReviews($formData, $count_future, false, $calculate);

		$msgHTML = '';
		if (!empty($count_future)) {

			$next_result   = !empty($works['future_count']) ?  1 : 0;
			$total         = isset($works['total']) ? $works['total'] : false;
			$works		   = $works['result'];
		}


		if ($works) {
			$msgHTML .= $this->renderPartial('//user_listing/_review_list', compact('works', 'checkIcon', 'property_of_featured_developers'), true);

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
	public function actionCheckapprove($id = null)
	{

		$model =  PlaceAnAd::model()->findByAttributes(array('uid' => $id));
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if ($model->status == 'A') {
			$this->redirect($model->DetailUrl);
		}
		define('CHECK_APPROVE', '1');
		if (!empty($model)) {
			$this->actionIndex($model->slug);
		}
	}
	public function actionApprove_property($id = null)
	{
		if (!Yii::app()->request->isAjaxRequest) {
			return false;
		}
		$model =  PlaceAnAd::model()->findByAttributes(array('uid' => $id));
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		PlaceAnAd::model()->updateByPk($model->id, array('status' => 'A'));
		echo json_encode(array('status' => '1', 'url' => $model->DetailUrl));
		exit;
	}
}
