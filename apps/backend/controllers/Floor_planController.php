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
 
class Floor_planController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Floor Plan";
     public $focus = "floor_plan_name";
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
         $model = new FloorPlan('serach');
  
       
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
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new FloorPlan();
        // $model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        //$model->ad_type = "adImage";
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
            $model->slug = $model->getUniqueSlug();
            if (isset(Yii::app()->params['POST'][$model->modelName]['description'])) {
                $model->description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['description']);
            }
            
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
                $this->redirect(array(Yii::app()->controller->id.'/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = FloorPlan::model()->findByPk((int)$id); 
		//$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
       if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
            if (isset(Yii::app()->params['POST'][$model->modelName]['description'])) {
                $model->description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['description']);
            }
            
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
                $this->redirect(array(Yii::app()->controller->id.'/index'));
            }
        }
        
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
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = FloorPlan::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('isTrash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionStatus($id,$status)
    {
		 
		 
        $model = FloorPlan::model()->findByPk((int)$id);
        $status=(string)$status;
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
          if($status==""){ $status= str_replace(" ","",$status) ; }
          else
          {
			  $status = ($status=='A') ? 'I ': 'A'; 
		  }
      
    
            $model->updateByPk($id,array('status'=>$status ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function _setupEditorOptions(CEvent $event)
    {
        if (!in_array($event->params['attribute'], array('script'))) {
            return;
        }
        
        $options = array();
        if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
            $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
        }
        $options['id'] = CHtml::activeId($event->sender->owner, $event->params['attribute']);
        
        if ($event->params['attribute'] == 'script') {
            $options['fullPage'] = true;
            $options['allowedContent'] = true;
            $options['height'] = 500;
        } 

        $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
    }
  
    
     public function actionFloorlist()
	{
		Yii::app()->request->enableCsrfValidation = true;
	   $id=null;
	   if(isset($_POST['section_id'])){ $id =$_POST['section_id'];  }
	   $data=FloorPlan::model()->ListDataWithproject($id);
	   $data=CHtml::listData($data,'floor_plan_id','floor_plan_name');
	   echo "<option value=''>Select Floor Plan</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
	
     public function actionLoadCategories()
	{
		Yii::app()->request->enableCsrfValidation = true;
	   $id=null;
	   if(isset($_POST['section_id'])){ $id =$_POST['section_id'];  }
	   $data=Project::model()->ListDataWithProperty($id);
	   $data=CHtml::listData($data,'project_id','project_name');
	   echo "<option value=''>Select Project</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
    
}
