<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UsersController
 * 
 * Handles the actions for users related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class Prospace_categoriesController   extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Prospace Category";
     public $focus = "master_name";
     public function init()
    {
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new ProspaceCategory('serach');
        
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
       
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list', compact('model'));
    }
    
    public function actionCreate($category=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new ProspaceCategory();
       if(!empty($category)){
           $model->category = $category;
       }
         
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
		     if (!$model->save()) {
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
           
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect($this->createUrl(Yii::app()->controller->id.'/index' ));
            }
        }
               $apps = Yii::app()->apps;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));$apps = Yii::app()->apps;
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = ProspaceCategory::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
		 
             $model->attributes = $attributes;
            
            // $model->slug = $model->getUniqueSlug();
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
			 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
				 $this->redirect($this->createUrl(Yii::app()->controller->id.'/index' ));
                 //$this->redirect($this->createUrl(Yii::app()->controller->id.'/fields',array("id"=>$model->category_id)));
            }
        }
		$apps = Yii::app()->apps;
		$apps = Yii::app()->apps;
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
     
    public function actionDelete($id)
    {
        $model = ProspaceCategory::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('is_trash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
  public function actionGetCity($id=null){
		$datae = CHtml::listData(MainRegion::model()->findAllByAttributes(array('country_id'=>(int) $id)),'region_id','name');
		 
		$data_html = ''; 
		if($datae){
			foreach($datae as $k=>$v){
				$data_html .= '<option value="'.$k.'">'.$v.'</option>'; 
			}
		}
		echo $data_html; exit;
	}
	 public function actiongetLocation($id=null){
		$datae = CHtml::listData(States::model()->findAllByAttributes(array('region_id'=>(int) $id)),'state_id','state_name');
		 
		$data_html = ''; 
		if($datae){
			foreach($datae as $k=>$v){
				$data_html .= '<option value="'.$k.'">'.$v.'</option>'; 
			}
		}
		echo $data_html; exit;
	}
   public function actionGetCategory($id=null,$country_id=null){
		$datae = MainCategory::model()->ListDataForJSON_ID_BySEction($id,$json=false,$country_id);
		 
		$data_html = ''; 
		if($datae){
			foreach($datae as $k=>$v){
				$data_html .= '<option value="'.$v->category_id.'">'.$v->category_name.'</option>'; 
			}
		}
		echo $data_html; exit;
	}
public function actiongetSubCategory($id=null,$country_id=null){
		$datae =  Category::model()->ListDataForJSON_ID_ByListingType($id,$json=false,$country_id);
	 
		$data_html = ''; 
		if($datae){
			foreach($datae as $k=>$v){
				$data_html .= '<option value="'.$k.'">'.$v.'</option>'; 
			}
		}
		echo $data_html; exit;
	}
    public function actionGetCategory2($id=null){
		$datae = MainCategory::model()->ListDataForJSON_ID_BySEctionAll($id,$json=false);
		 
		$data_html = '<option value="">Select Category</option>'; 
		if($datae){
			foreach($datae as $k=>$v){
				$data_html .= '<option value="'.$v->category_id.'">'.$v->CategoryTitle.'</option>'; 
			}
		}
		echo $data_html; exit;
	}
}
