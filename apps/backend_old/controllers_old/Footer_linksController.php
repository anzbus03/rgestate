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
 
class Footer_linksController   extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Footer links";
     public $focus = "FooterLinks_name";
     public function init()
    {
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex($refresh=null)
    { 
		 
		
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new FooterLinks('serach');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$model->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				
				Yii::import('backend.controllers.TranslateController');
			    $controller = new TranslateController('translate','');
                $sortOrderAll = $_POST['bulk'];
				if(count($sortOrderAll)>0)
				{
					set_time_limit(0);
					$sortOrderAll =  array_filter($sortOrderAll);
					foreach($sortOrderAll as $menuId=>$message)
					{
						 
						$id = 'FooterLinks_title_'.$menuId;
						$relation = 'master_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
				  Yii::app()->options->set('system.common.footer_updation',time());
				  
				$notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				$this->redirect(Yii::app()->request->urlReferrer) ;
        }
       if(!empty($refresh)){  Yii::app()->options->set('system.common.footer_updation',time());$this->redirect(Yii::app()->request->urlReferrer) ; }
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->is_trash = '0';
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
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new FooterLinks();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
           
              if (!$model->save()) {
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 Yii::app()->options->set('system.common.footer_updation',time()); 
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
        ));
        				$apps = Yii::app()->apps;
	 
		 
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = FooterLinks::model()->findByPk((int)$id);

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
				  Yii::app()->options->set('system.common.footer_updation',time());
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
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        				$apps = Yii::app()->apps;
	 
		 
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('model'));
    }
     
    public function actionDelete($id)
    {
        $model = FooterLinks::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('is_trash'=>Yii::app()->params['onTrash']));    
          Yii::app()->options->set('system.common.footer_updation',time());

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    
   
    
}
