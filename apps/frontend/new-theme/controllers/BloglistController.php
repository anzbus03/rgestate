<?php defined('MW_PATH') || exit('No direct script access allowed');



class BloglistController extends Controller
{
	/**
	 * List available published articles 
	 */
	public function init()
	{
		parent::init();
		// if(!Yii::app()->extensionsManager->isExtensionEnabled('blog')):
		//  throw new CHttpException(404, Yii::t('app', 'Blog is not activated.'));
		// endif;
	}


	public function actionIndex($category = 'blog', $page = "1")
	{
		$slug = $category;

		$limit = "24";
		if ($slug == 'index' || $slug == 'index/page') {
			$slug = 'blog';
		}

		$articleCategoryFromSlug = ArticleCategory::model()->findBySlg($slug);

		if (empty($articleCategoryFromSlug)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$parentCategory = ArticleCategory::model()->findByAttributes(array('slug' => 'blog'));

		if ($parentCategory) {
			$category = ArticleCategory::model()->getBlogCategories($parentCategory->category_id);
		} else {
			//No Category
			$category = array();
		}


		$formData = array_filter((array)$_GET);

		$formData['parent_id'] =  $articleCategoryFromSlug->category_id;



		$modelCritera = Article::model()->findPosts($formData, $count_future = false, 1, $calculate = false);
		$adsCount = Article::model()->count($modelCritera);

		$pages = new CPagination($adsCount);
		$pages->pageSize = $limit;
		$pages->applyLimit($modelCritera);


		$modelCritera->limit = $limit;
		$ads = Article::model()->findAll($modelCritera);

		$articleCategoryFromSlug->name =  !empty($articleCategoryFromSlug->name_other) ? $articleCategoryFromSlug->name_other : $articleCategoryFromSlug->name;


		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{title} | {name}', array('{name}' => $this->project_name, '{title}' => ucfirst($articleCategoryFromSlug->name))),
			'pageMetaDescription'   => Yii::app()->params['description'],
			'sticky_head'   => $articleCategoryFromSlug->name
		));
		$category = ArticleCategory::model()->getBlogCategories(20);
		// $this->getData('pageStyles')->add(array('src' =>  Yii::app()->apps->getBaseUrl('assets/css/new_blog.css?q=8')));

		$this->render("index_new", compact('articleCategoryFromSlug', 'ads', 'limit', 'formData', 'latest', 'category', 'slug', 'adsCount', 'pages'));
	}
	public function actionFetch_ad($count_future = true, $calculate = true)
	{
		$request = Yii::app()->request;

		parse_str($request->getQuery('formData', ''), $formDataN);
		$formData = array();
		if (!empty($formDataN)) {
			foreach ($formDataN as $k => $v) {
				$formData[Yii::t('t', $k, array(';' => ''))] = $v;
			}
		}



		$works =   Article::model()->findPosts($formData, $count_future, false, $calculate);


		$msgHTML = '';
		if (!empty($count_future)) {
			$next_result   = !empty($works['future_count']) ?  1 : 0;
			$total         = isset($works['total']) ? $works['total'] : false;
			$ads		   = $works['result'];
		}


		if ($ads) {
			$msgHTML .= $this->renderPartial('_blog_li', compact('ads'), true);



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
	
	public function actionDetails($slug, $page = "1")
	{
		
		$model  = BlogArticle::model()->blogBySlug($slug);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$ads = BlogArticle::model()->findAll(array(
			'order' => 'article_id DESC',
		));
		

		$ip = Yii::app()->request->getUserHostAddress();
		$articleView = new ArticleView;
		$ipfound =  $articleView->findIPwithId($model->article_id, $ip);

		if (!$ipfound) {
			$articleView = new ArticleView;
			$articleView->ip_address = $ip;
			$articleView->article_id =  $model->article_id;
			$articleView->save();
		}


		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (!empty($model->main_image)) {
			@$imges['1'] = Yii::App()->apps->getBaseUrl('uploads/banner/' . $model->main_image);
			$imageUrl = @$imges['1'];
		} else {
			preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $model->content, $imges);
		}
		// Detect if HTTPS or HTTP
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

		// Build the base URL using the server name
		$baseUrl = $protocol . $_SERVER['HTTP_HOST'] . Yii::app()->baseUrl;
	 
		// Check if the featured image exists and set the URL
		if (!empty($model->featured_image) && !is_null($model->featured_image)) {
			$featuredImageUrl = $baseUrl . '/uploads/images/' . $model->featured_image;
		} else {
			// If no featured image, check for an image inside the content
			preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $model->content, $imageMatch);
			if (isset($imageMatch[1])) {
				$featuredImageUrl = $imageMatch[1]; // Image found in the content
			} else {
				$featuredImageUrl = ''; // Fallback if no image is found
			}
		}
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{title} | {name}', array('{name}' =>      $this->project_name, '{title}' => !empty($model->meta_title) ? $model->meta_title :  ucfirst($model->title))),
			'pageMetaDescription'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name'), '{title}' => !empty($model->meta_description) ? $model->meta_description :  ucfirst($model->title))),
			'pageMetaKeywords'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name'), '{title}' => !empty($model->meta_keywords) ? $model->meta_keywords :  ucfirst($model->title))),
			'title' => $model->title,
			'image' => $featuredImageUrl,
			'description' => $model->ShortDescription,
			'shareUrl' => Yii::app()->createAbsoluteUrl($model->slug . '/blog'),
		));
		$category = ArticleCategory::model()->getBlogCategories(20);
		// $this->getData('pageStyles')->add(array('src' =>  Yii::app()->apps->getBaseUrl('assets/css/new_blog.css?q=9')));

		$this->render("details", compact('model', 'featuredImageUrl', 'ads', 'category', 'cat', 'latest', 'popular', 'imageUrl'));
	}

	public function actionRuntimeloader()
	{

		$slug = (!empty($_GET['slug'])) ? $_GET['slug'] :  'blog';
		$articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug' => $slug));
		$criteria = new CDbCriteria;
		$criteria->with = array('categories');
		if ($articleCategoryFromSlug->parent_id == "") {
			$criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
		} else {
			$criteria->condition = 't.status=:pub and  categories.category_id=:parent';
		}
		$criteria->params[':parent']   = $articleCategoryFromSlug->category_id;
		$criteria->params[':pub']   = 'published';

		$criteria->together = true;
		$criteria->limit = $_GET['number'];
		$criteria->offset = (int) $_GET['offset'];
		$criteria->order  = "t.article_id desc";
		$criteria->group  = "t.article_id";

		$model = Article::model()->findAll($criteria);
		if (empty($model)) {
			echo 1;
			exit;
		}
		$this->renderPartial('runtime', compact('model'));
	}

	public function beforeAction($action)
	{
		if ($action->id == 'contact') {
			Yii::app()->request->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}


	public function actionContact()
	{
		// Enable error reporting
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		$response = ['status' => 'error', 'message' => ''];

		if (Yii::app()->request->isGetRequest) {
			$model = new Contact();

			$model->name = Yii::app()->request->getParam('name');
			$model->email = Yii::app()->request->getParam('email');
			$model->contact = Yii::app()->request->getParam('contact');
			$model->message = Yii::app()->request->getParam('message');

			if ($model->validate()) {
				if ($model->save()) {
					$response['status'] = 'success';
					$response['message'] = 'Form submitted successfully!';
				} else {
					$response['status'] = 'error';
					$response['message'] = 'Failed to save the data.';
				}
			} else {
				$response['status'] = 'error';
				$response['message'] = CHtml::errorSummary($model);
			}
		} else {
			$response['status'] = 'error';
			$response['message'] = 'Invalid request method. Only GET requests are allowed.';
		}

		// Return a JSON response, even if there's an error
		header('Content-Type: application/json');
		echo CJSON::encode($response);
		Yii::app()->end();
	}
}
