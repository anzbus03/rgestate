<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for artciles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class BlogController extends Controller
{
    /**
     * List available published articles 
     */
     public function init()
     {
       if(!Yii::app()->extensionsManager->isExtensionEnabled('blog')):
        throw new CHttpException(404, Yii::t('app', 'Blog is not activated.'));
       endif;
	 }
 
    public function actionIndex($slug='blog')
    {
		 
		$articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug));
		 
		if(empty($articleCategoryFromSlug))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	 
	 
		 
        $this->layout =   Yii::app()->LayoutClass->layoutpath("blog");
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
       
        $articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug));
        if($articleCategoryFromSlug->slug=='blog')
        {
			$category = ArticleCategory::model()->getBlogCategories($articleCategoryFromSlug->category_id);
		}
		else
		{
			$parentCategory = ArticleCategory::model()->findByAttributes(array('slug'=>'blog'));
			if($parentCategory)
			{
			$category = ArticleCategory::model()->getBlogCategories($parentCategory->category_id);
			}
			else
			{
				//No Category
			 $category = array();	
			}
		}
		
	 
		
        $criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
		if($articleCategoryFromSlug->parent_id=="")
		{
			 
        $criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
       
		}
		else
		{
		 
		$criteria->condition = 't.status=:pub and  categories.category_id=:parent';
		
		}
		$criteria->params[':parent']   = $articleCategoryFromSlug->category_id  ;
		$criteria->params[':pub']   = 'published'  ;
		
		$criteria->together =true;
        $count=Article::model()->count($criteria);
        $pages=new CPagination($count);
		//$pages->pageSize= (Yii::app()->options->get('system.common.customer_page_size'))?Yii::app()->options->get('system.common.customer_page_size'):'20' ;
		$pages->pageSize= 10;
		$pages->applyLimit($criteria);
        $model=Article::model()->findAll($criteria);
        
        

        $this->render(Yii::app()->LayoutClass->viewpath("index"),compact('model','pages','category','slug','articleCategoryFromSlug'));
    }
    
    public function actionDetails($slug)
    {
		
		$model  = Article::model()->findByAttributes(array('slug'=>$slug));
		$this->layout =   Yii::app()->LayoutClass->layoutpath("blog");
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
       
		$parentCategory = ArticleCategory::model()->findByAttributes(array('slug'=>'blog'));
		if($parentCategory)
		{
		$category = ArticleCategory::model()->getBlogCategories($parentCategory->category_id);
		}
		else
		{
			//No Category
		 $category = array();	
		}
		 
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		
		$this->render(Yii::app()->LayoutClass->viewpath("details"),compact('model','category'));
		
	}
    
	public function actionSubmit() {

		print_r(55);
		exit;
		$request = Yii::app()->request;
		$requestParams = $request->getPost('ContactUs'); 
		$model = new ContactUs();
	
		// Check if it's a POST request
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
		}
	
		// CRM URL to get customer details
		$createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
	
		// Prepare customer data
		$fullName = $requestParams['name'];
		$nameParts = explode(' ', $fullName);
		$firstName = $nameParts[0] ?? null;
		$lastName = $nameParts[1] ?? null;
	
		$crmCustomerData = [
			'fields' => [
				'NAME' => $firstName,
				'SECOND_NAME' => $lastName,
				'TYPE_ID' => 'CLIENT',
				'SOURCE_ID' => 'SELF',
				'EMAIL' => [['VALUE' => $requestParams['email'], 'VALUE_TYPE' => 'WORK']],
				'PHONE' => [['VALUE' => $requestParams['phone'], 'VALUE_TYPE' => 'WORK']],
			]
		];
	
		// Send customer creation request
		$postCustomerData = http_build_query($crmCustomerData);
		$contextCustomerOptions = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postCustomerData,
			]
		];
		$contextCreateCustomer = stream_context_create($contextCustomerOptions);
	
		try {
			$data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
			$response = json_decode($data, true);
			$customerId = $response['result'];
		} catch (Exception $e) {
			echo json_encode(['status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> Unable to create customer. </div>']);
			Yii::app()->end();
		}
	
		// CRM URL to create a new lead
		$crmUrl = 'https://crm.rgestate.com/rest/88/x0g9p2hpse2h48si/crm.lead.add.json';
	
		// Prepare lead data
		$crmData = [
			'FIELDS' => [
				'TITLE' => 'RGestate Lead - Contact Form',
				'CATEGORY_ID' => 16,
				'LEAD_PHONE' => $requestParams['phone'],
				'LEAD_LAST_NAME' => $lastName,
				'LEAD_NAME' => $firstName,
				'LEAD_EMAIL' => $requestParams['email'],
				'CONTACT_ID' => $customerId,
				'COMMENTS' => $requestParams['message'],
				'ASSIGNED_BY_ID' => 22,
			]
		];
	
		// Send lead creation request
		$postData = http_build_query($crmData);
		$contextOptions = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postData,
			]
		];
		$context = stream_context_create($contextOptions);
	
		try {
			file_get_contents($crmUrl, false, $context);
		} catch (Exception $e) {
			echo json_encode(['status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> Unable to create lead. </div>']);
			Yii::app()->end();
		}
	
		// Save the model and return the success or error message
		if ($model->save()) {
			echo json_encode(['status' => '1', 'name' => $model->name, 'msg' => '<div class="alert alert-success"><strong>Success!</strong> Successfully submitted.</div>']);
		} else {
			echo json_encode(['status' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> ' . CHtml::errorSummary($model) . ' </div>']);
		}
	
		Yii::app()->end();
	}
    
    
}
