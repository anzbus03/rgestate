<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class PartnersController extends Controller
{
    /**
     * List available published 
     */
  public $headerImage;
  public function init(){
	 
	  parent::Init();
      
    }
    public function actionIndex()
    {
        //echo"enter";exit;   
         $criteria = new CDbCriteria();
         $criteria->compare('status', Partners::STATUS_PUBLISHED);
         $criteria->order = 'partners_id DESC';
        
         $count = Partners::model()->count($criteria);
        
         $pages = new CPagination($count);
         $pages->pageSize = 100;
         $pages->applyLimit($criteria);

        $partners = Partners::model()->findAll($criteria);
        $this->setData(array(
            'pageTitle'     => 'Our Partners - Collaborations that Elevate RGEstate\'s Real Estate Excellence', 
            'pageMetaDescription'   => 'Discover the strategic partnerships and collaborations that empower RGEstate\'s commitment to delivering exceptional real estate services. ', 
            'metaKeywords'   => 'Our Partners - Collaborations that Elevate RGEstate\'s Real Estate Excellence', 
        ));
        $this->render('index', compact('partners', 'pages'));
    }
    
    /**
     * Helper method to load the article AR model
     */
    public function loadPartnersModel($slug)
    {
         $model = Partners::model()->findBySlugPublished( $slug );
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
	
}
