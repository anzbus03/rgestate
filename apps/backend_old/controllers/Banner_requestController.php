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
 
class Banner_requestController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Banner Request";
     public $focus = "banner_name";
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
         $model = new BannerRequest('serach');
        
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
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
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
        
          $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
            $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
 
        $this->render('list', compact('model'));
    }
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new FrontBannerREquest();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if( $uploadedFile){
            $fileName = rand(100,1000).$uploadedFile;
            $model->image = $fileName;
			}
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if($uploadedFile)
				{
				$path =  Yii::app()->basePath . '/../../uploads';
				$uploadedFile->saveAs($path.'/banner/'. $fileName);
				}
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
    public function actionUpdate($id=0)
    {
		 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->select = 't.*,cu.email,cu.name,cu.phone,bp.position_name';
        //$criteria->join = " LEFT JOIN {{countries}} cn on cn.country_id = t.country_id " ;
        $criteria->compare('banner_id',$id);
          $criteria->compare('t.isTrash',0);
        
        $criteria->join .= ' INNER JOIN {{contact_us}} cu ON cu.id = t.contact_id ' ;
        $criteria->join  .= ' INNER JOIN {{banner_position}} bp on bp.position_id = t.position_id and bp.status = "A" and bp.isTrash = "0" ' ;
		
        $criteria->compare('f_type','R');
          $model = FrontBannerREquest::model()->find($criteria);
		//$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
       
               $oldfilename =$model->image;
             $model->attributes = $attributes;
            // $model->script =     Yii::app()->params['POST']['script'] ; 
             
              
           
             $file = CUploadedFile::getInstance($model, 'image');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {
				          
				
				$fileName = rand(100,1000).$file;
				$model->image = $fileName;
			 } else {
				$model->image = $oldfilename;
			 }
			  
        
			 
            if (!$model->save()) {
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if (is_object($file) && get_class($file)==='CUploadedFile') {
				 
				$path =  Yii::app()->basePath . '/../../uploads';
				$file->saveAs($path.'/banner/'. $fileName);
				if ($oldfilename != $fileName) {
				@unlink(Yii::app()->basePath . '/../../uploads/banner/'. $oldfilename);
				}
				}
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
        $model =  BannerRequest::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->delete();      
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
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
  
  
    public function actionView($id=0)
    {
		 
		 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->select = 't.*,cu.email,cu.name,cu.phone,bp.position_name';
        //$criteria->join = " LEFT JOIN {{countries}} cn on cn.country_id = t.country_id " ;
        $criteria->compare('banner_id',$id);
          $criteria->compare('t.isTrash',0);
        
        $criteria->join .= ' INNER JOIN {{contact_us}} cu ON cu.id = t.contact_id ' ;
        $criteria->join  .= ' INNER JOIN {{banner_position}} bp on bp.position_id = t.position_id and bp.status = "A" and bp.isTrash = "0" ' ;
		
        $criteria->compare('f_type','R');
         
		 
        $model = FrontBannerREquest::model()->find($criteria);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
  
        
       
        
        $this->renderPartial('view', compact('model'));
    }
    
}
