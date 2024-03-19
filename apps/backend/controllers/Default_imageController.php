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
 
class Default_imageController  extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Profile image / Cover Image Library";
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
         $model = new PicLibrary('serach');
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
        $this->render('list', compact('model'));
    }
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PicLibrary();
      
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
            
            $uploadedFile=CUploadedFile::getInstance($model,'cover_image');
            if($uploadedFile){
			$ext = 	pathinfo($uploadedFile, PATHINFO_EXTENSION);
            $fileName = strtolower($model->alphabet).'_c.jpg' ;
            $model->cover_image = $fileName;
            }
             
            $uploadedFile2=CUploadedFile::getInstance($model,'profile_image');
            if($uploadedFile2){
            $ext = 	pathinfo($uploadedFile2, PATHINFO_EXTENSION);
            $fileName2 =strtolower($model->alphabet).'_p.jpg' ;
            $model->profile_image = $fileName2;
            }
             
             if (!$model->save()) {
				
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
					if($uploadedFile)
					{
					$path =  Yii::app()->basePath . '/../../uploads';
					$uploadedFile->saveAs($path.'/avatar/'. $fileName);
					}
					if($uploadedFile2)
					{
					$path =  Yii::app()->basePath . '/../../uploads';
					$uploadedFile2->saveAs($path.'/avatar/'. $fileName2);
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
    public function actionUpdate($id)
    {
	
        $model = PicLibrary::model()->findByPk((int)$id); 
		//$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
      
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
       
			 $oldfilename =$model->cover_image;
			 $oldfilename2 =$model->profile_image;
             $model->attributes = $attributes;  	 
             $file = CUploadedFile::getInstance($model, 'cover_image');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {
			     
				$ext = 	pathinfo($file, PATHINFO_EXTENSION);
				$fileName = strtolower($model->alphabet).'_c.jpg' ;
				$model->cover_image = $fileName;
			 } else {
				$model->cover_image = $oldfilename;
			 }
			  
             $file2 = CUploadedFile::getInstance($model, 'profile_image');
			 if (is_object($file2) && get_class($file2)==='CUploadedFile') {
				$ext = 	pathinfo($file2, PATHINFO_EXTENSION);
				$fileName2 = strtolower($model->alphabet).'_p.jpg' ;
				$model->profile_image = $fileName2;
			 } else {
				$model->profile_image = $oldfilename2;
			 }
			    
			 
            if (!$model->save()) {
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if (is_object($file) && get_class($file)==='CUploadedFile') {
					$path =  Yii::app()->basePath . '/../../uploads';
					@unlink(Yii::app()->basePath . '/../../uploads/avatar/'. $fileName);
					$file->saveAs($path.'/avatar/'. $fileName);
				}
				if (is_object($file2) && get_class($file2)==='CUploadedFile') {
					$path =  Yii::app()->basePath . '/../../uploads';
					@unlink(Yii::app()->basePath . '/../../uploads/avatar/'. $fileName2);
					$file2->saveAs($path.'/avatar/'. $fileName2);
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
        $model = PicLibrary::model()->findByPk((int)$id);
        
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
    
    
}
