<?php defined('MW_PATH') || exit('No direct script access allowed');



class AjaxController extends Controller
{
	public function actionGtranslate()
	{
		$handle = curl_init();

		if (FALSE === $handle)
			throw new Exception('failed to initialize');

		curl_setopt($handle, CURLOPT_URL, 'https://www.googleapis.com/language/translate/v2');
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_POSTFIELDS, array('key' => 'AIzaSyAY0-OgH2OLDs25xXI_Ei8hP4sTje0Wva4', 'q' => 'Testing message', 'source' => 'en', 'target' => 'ar'));
		curl_setopt($handle, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: GET'));
		$response = curl_exec($handle);

		print_r($response);
		exit;
	}

	public function actionFindCities($country_id = null, $state = null)
	{

		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;


		$status = true;

		/*areas Fetching */
		$criteria = new CDbCriteria;
		$criteria->condition  = '1';
		$criteria->select = 't.city_id,t.slug as city_slug,t.state_id,t.city_name,st.state_name,st.slug as state_slug';
		$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ';
		$criteria->condition .= ' and   st.country_id = :country_id';
		if (defined('LANGUAGE')) {

			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE  st.state_name  END as  state_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = t.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE t.city_name  END as  city_name  ';
				$criteria->condition  .= ' and ( CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE t.city_name  END like :query   )';


				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.city_id';
			} else {
				$criteria->condition  .= ' and ( t.city_name like :query   )';
			}
		}

		if (!empty($state)) {
			$criteria->condition .= ' and   st.slug = :state';
			$criteria->params[':state'] = $state;
		}

		$criteria->limit = '15';
		$criteria->params[':query'] = '%' . $query . '%';
		$criteria->params[':country_id'] = $country_id;

		$areas = City::model()->findAll($criteria);
		/*areas Fetching */


		$resultUsers = [];
		if ($areas) {
			foreach ($areas as $k => $v) {

				$resultUsers[] =  array(
					"id"        => $v->city_id,
					"city_id"        => $v->city_slug,
					"state_id"        => $v->state_slug,
					"username"  => trim($v->city_name),
					"avatar"    => "",
					"country" =>   $v->state_name,
				);
			}
		}



		$resultProjects = [];

		// Means no result were found
		if (empty($resultUsers) && empty($resultProjects)) {
			$status = false;
		}

		header('Content-type: application/json; charset=utf-8');

		echo json_encode(array(
			"status" => $status,
			"error"  => null,
			"data"   => array(
				"user"      => $resultUsers,

			)
		));
	}

	public function actionFindCitiesAd($country_id = null)
	{

		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;


		$status = true;

		/*areas Fetching */
		$criteria = new CDbCriteria;
		$criteria->condition  = '1';
		$criteria->select = 't.city_id,t.state_id,cn.country_id,t.city_name,cn.cords as country_name,st.state_name';
		$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ';
		$criteria->join .= ' INNER JOIN {{countries}}  cn on cn.country_id = st.country_id   ';
		$criteria->condition .= ' and   cn.show_on_listing ="1"';

		if (!empty($country_id)) {
			$criteria->condition  .= ' and   t.country_id =  :country   ';
			$criteria->params[':country'] = $country_id;
		}
		$criteria->limit = '15';
		$criteria->params[':query'] = '%' . $query . '%';
		if (defined('LANGUAGE')) {

			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE  st.state_name  END as  state_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = t.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE t.city_name  END as  city_name  ';
				$criteria->condition  .= ' and ( CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE t.city_name  END like :query   )';


				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.city_id';
			} else {
				$criteria->condition  .= ' and ( t.city_name like :query   )';
			}
		}

		$areas = City::model()->findAll($criteria);
		/*areas Fetching */


		$resultUsers = [];
		if ($areas) {
			foreach ($areas as $k => $v) {

				$resultUsers[] =  array(
					"id"        => $v->city_id,
					"state_id"        => $v->state_id,
					"country_id"        => $v->country_id,
					"username"  => trim($v->city_name),
					"avatar"    => "",
					"country" =>  '(' . $v->state_name . ',' . $v->country_name . ')',
				);
			}
		}



		$resultProjects = [];

		// Means no result were found
		if (empty($resultUsers) && empty($resultProjects)) {
			$status = false;
		}

		header('Content-type: application/json; charset=utf-8');

		echo json_encode(array(
			"status" => $status,
			"error"  => null,
			"data"   => array(
				"user"      => $resultUsers,

			)
		));
	}
	public function actionSelect_city_new($id = null)
	{

		$html = '<option value="">' . $this->tag->getTag('select_city', 'Select City') . '</option>';
		$states = States::model()->AllListingStatesOfCountry((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->state_id . '">' . $k->state_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionSelect_location($id = null)
	{
		$html = '<option value="">' . $this->tag->getTag('select_location', 'Select Location') . '</option>';
		$states = City::model()->FindCities((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->city_id . '">' . $k->city_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionHidden_ammenities($id = null)
	{
		$location = '';
		$criteria = new CDbCriteria;
		$criteria->select = "amenities_id";
		$criteria->condition = "t.category_id=:category_id";
		$criteria->params[':category_id'] =  (int) $id;
		$states = AmenitiesCategoryList::model()->findAll($criteria);
		$cat_hide['h_p_limits']  = 0;
		$cat_hide['h_bd']  = 0;
		$cat_hide['h_bth'] = 0;
		$cat_hide['h_in']  = 0;
		$cat_hide['h_is_mor']  = 0;
		$cat_hide['h_r_facade']  = 0;
		$cat_hide['h_rights']  = 0;
		$cat_hide['h_may_affect']  = 0;
		$cat_hide['h_disputes']  = 0;
		$cat_hide['h_expiry_date']  = 0;

		$cat_hide['h_l_no']  = 0;
		$cat_hide['h_plan_no']  = 0;
		$cat_hide['h_no_of_u']  = 0;
		$cat_hide['h_floor_no']  = 0;
		$cat_hide['h_unit_no']  = 0;
		$cat_hide['h_selling_price']  = 0;
		$cat = Category::model()->findByPk((int) $id);
		if ($cat) {
			$cat_hide['h_bd']  = $cat->h_bd;
			$cat_hide['h_bth'] = $cat->h_bth;
			$cat_hide['h_in']  = $cat->h_in;
			$cat_hide['h_is_mor']  = $cat->h_is_mor;
			$cat_hide['h_r_facade']  = $cat->h_r_facade;
			$cat_hide['h_rights']  = $cat->h_rights;
			$cat_hide['h_may_affect']  = $cat->h_may_affect;
			$cat_hide['h_disputes']  = $cat->h_disputes;
			$cat_hide['h_expiry_date']  = $cat->h_expiry_date;

			$cat_hide['h_l_no']  = $cat->h_l_no;
			$cat_hide['h_plan_no']  = $cat->h_plan_no;
			$cat_hide['h_no_of_u']  = $cat->h_no_of_u;
			$cat_hide['h_floor_no']  = $cat->h_floor_no;
			$cat_hide['h_unit_no']  = $cat->h_unit_no;
			$cat_hide['h_selling_price']  = $cat->h_selling_price;
			$cat_hide['h_p_limits']  = $cat->h_p_limits;;
			if (empty($states)) {

				echo json_encode(array('status' => 1, 'amenities_list' => array(), 'cat_hide' => $cat_hide));
				exit;
			}
		}

		if (!empty($states)) {
			$amenities_list = CHtml::listData($states, 'amenities_id', 'amenities_id');
			echo json_encode(array('status' => 1, 'amenities_list' => $amenities_list, 'cat_hide' => $cat_hide));
		} else {
			echo json_encode(array('status' => 0));
		}
		exit;
	}
	public function actionView_detail($type = null)
	{
		$this->layout = 'm';
		$request    = Yii::app()->request;
		$category   = new Statistics('search_count');
		$category->unsetAttributes();
		switch ($type) {

			case 'call':
				$category->type = 'C';
				switch ($_GET['duration']) {
					case 'today':
						$titl = $this->tag->getTag('call', 'Call') . ' - ' . $this->tag->getTag('today', 'Today');
						break;
					case '30day':
						$titl = $this->tag->getTag('call', 'Call') . ' - ' . $this->tag->getTag('last_30_days', 'Last 30 days');
						break;
					default:
						$titl =     $this->tag->getTag('call', 'Call') . ' - ' . $this->tag->getTag('all_time', 'All Time');
						break;
				}
				break;
			case 'mail':
				$category->type = 'E';
				switch ($_GET['duration']) {
					case 'today':
						$titl = $this->tag->getTag('mail', 'Mail') . ' - ' . $this->tag->getTag('today', 'Today');
						break;
					case '30day':
						$titl =  $this->tag->getTag('mail', 'Mail') . ' - ' . $this->tag->getTag('last_30_days', 'Last 30 days');
						break;
					default:
						$titl =   $this->tag->getTag('mail', 'Mail') . ' - ' . $this->tag->getTag('all_time', 'All Time');
						break;
				}
				break;
			case 'whatsapp':
				$category->type = 'W';
				switch ($_GET['duration']) {
					case 'today':
						$titl = $this->tag->getTag('whatsapp', 'WhatsApp') . ' - ' . $this->tag->getTag('today', 'Today');
						break;
					case '30day':
						$titl = $this->tag->getTag('whatsapp', 'WhatsApp') . ' - ' . $this->tag->getTag('last_30_days', 'Last 30 days');
						break;
					default:
						$titl =   $this->tag->getTag('whatsapp', 'WhatsApp') . ' - ' . $this->tag->getTag('all_time', 'All Time');
						break;
				}
				break;
			case 'text':
				$category->type = 'T';
				switch ($_GET['duration']) {
					case 'today':
						$titl = $this->tag->getTag('text', 'Text') . ' - ' . $this->tag->getTag('today', 'Today');
						break;
					case '30day':
						$titl = $this->tag->getTag('text', 'Text') . ' - ' . $this->tag->getTag('last_30_days', 'Last 30 days');
						break;
					default:
						$titl =  $this->tag->getTag('text', 'Text') . ' - ' . $this->tag->getTag('all_time', 'All Time');
						break;
				}
				break;
		}

		$this->setData(array('pageMetaTitle'       => $titl, 'pageHeading'       => $titl, 'hooks' => Yii::app()->hooks));

		$category->attributes = (array)$request->getQuery($category->modelName, array());
		$this->render('//articles/_list_call', compact('category'));



		$this->setData(array(
			'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users',  'Statistics  Dashboard'),
			//'pageHeading'       => Yii::t('agent',  'Statistics  Dashboard'),
			'pageBreadcrumbs'   => array(

				Yii::t('app', 'View all')
			)
		));
		//     $total_call_count = Statistics::model()->callCount();
		// if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }



	}


	public function actionPage_View_detail()
	{
		$this->layout = 'm';
		$request    = Yii::app()->request;
		$category   = new StatisticsPage('page_count');
		$category->unsetAttributes();

		switch ($_GET['duration']) {
			case 'today':
				$titl = $this->tag->getTag('page_view', 'Page View') . ' - ' . $this->tag->getTag('today', 'Today');
				break;
			case '30day':
				$titl = $this->tag->getTag('page_view', 'Page View') . ' - ' . $this->tag->getTag('last_30_days', 'Last 30 days');
				break;
			default:
				$titl =   $this->tag->getTag('page_view', 'Page View') . ' - ' . $this->tag->getTag('all_time', 'All Time');
				break;
		}

		$this->setData(array('pageMetaTitle'       => $titl, 'pageHeading'       => $titl, 'hooks' => Yii::app()->hooks));
		$category->attributes = (array)$request->getQuery($category->modelName, array());
		$this->render('//articles/_list_view', compact('category'));



		$this->setData(array(
			'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users',  'Statistics  Dashboard'),
			'pageBreadcrumbs'   => array(

				Yii::t('app', 'View all')
			)
		));
		//     $total_call_count = Statistics::model()->callCount();
		// if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }



	}
	function actionDelete_image()
	{


		$str = "";
		if (isset($_POST['inp'])) {


			$ar = explode(',', $_POST['inp']);


			if ($ar) {
				foreach ($ar as $k => $val) {

					if ($val != $_POST['file'] and $val != "") {

						$str .= "," . $val;
					}
				}
			}
		}
		echo $str;
	}

	public function actionUpload($width = null, $height = null)
	{
		ini_set('memory_limit', '-1');
		$this->fileUploadDropzone();
		exit;
	}
	public function fileUploadDropzone()
	{

		$path_file =  Yii::getPathOfAlias('root.uploads.files');
		$file_format = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$file_title = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
		$img = date('Y-m-d-h-i-s') . '-' . rand(0, 9999) . '-' . time() . "." . $file_format;
		$year_folder = $path_file . '/' . date("Y");
		$month_folder = $year_folder . '/' . date("m");
		$month_folder2 = date("Y") . '/' . date("m");
		!file_exists($year_folder) && mkdir($year_folder, 0777);
		!file_exists($month_folder) && mkdir($month_folder, 0777);
		$path_file = $month_folder;
		move_uploaded_file($_FILES['file']['tmp_name'], $path_file . "/{$img}");
		if (isset($_POST['rand'])) {
			echo json_encode(array('img' => $month_folder2 . '/' . $img, 'rand' => $_POST['rand'], 'file_title' => Yii::t('app', $file_title, array('_' => '', '-' => ''))));
			exit;
		}
		echo  $month_folder2 . '/' . $img;
		exit;
	}
	public function actionSelect_Sublocations($id)
	{
		// print_r($id);exit;
		$subs = States::model()->findAll('parent_id=:p AND isTrash="0"', [':p'=>$id]);
		$options = '';
		foreach ($subs as $s) {
			// print_r($subs);exit;
			$options .= CHtml::tag('option', ['value'=>$s->state_id], CHtml::encode($s->state_name));
		}
		echo CJSON::encode(['data' => $options]);
    	Yii::app()->end();
	}
}
