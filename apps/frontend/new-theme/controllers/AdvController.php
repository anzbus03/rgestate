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
 
class AdvController extends Controller
{
    /**
     * List available published articles 
     */
  public $headerImage;
  public function init(){
	 
	  parent::Init();
      
    }
  
    public function actionView($slug)
    {
		
		 
		 $article = $this->loadArticleModel($slug);
        if(empty($article))
		{
		  
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		 }
		 
    
     
        $this->setData(array(
            'pageTitle'     =>    $article->title, 
            'pageMetaDescription'   => 	$article->meta_description,
            'metaKeywords'   => 	$article->	title,
        ));
         if($this->app->request->isAjaxRequest){
		 	 unset($formData['_pjax']);
	 unset($formData['_']);
		// echo $file_view;exit;
			$this->renderPartial(  $layot_sidebar , compact('article','latest'));
			$this->app->end();
	 }
        $this->render(  'view_both' , compact('article','latest'));
    } 
    
    /**
     * Helper method to load the article AR model
     */
    public function loadArticleModel($slug)
    {
         $model = AdvertisementArticle::model()->findBySlugPublished( $slug );
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
    
    public function actionValidateEnquiry2(){
		 
		$model = new AdvertisementContact;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendEnquiry2(){
		$request    = Yii::app()->request;
		$model  = new AdvertisementContact();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
	
}
