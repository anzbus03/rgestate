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
 
class Agent_bannerController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Agent Banner";
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
         $model = new AgentBanner('serach');
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
        $model = new AgentBanner();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
           
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if( $uploadedFile){
				$file = $_FILES['AgentBanner']['name']['image'];
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$fileName = rand(0,9999).'_'.time().".".$ext;;
				$model->image = $fileName;
			}
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				
				
				if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER=='1' && $uploadedFile){
					 
					$file_orginal = $_FILES['AgentBanner']['tmp_name']['image'];
					$img = $model->image;
					$awsAccessKey = ENABLED_AWS_ACCESS;
					$awsSecretKey = ENABLED_AWS_SECRET;
					$bucketName = ENABLED_BUCKET_NAME;
					Yii::import('common.extensions.amazon.S3');
					$s3 = new S3($awsAccessKey, $awsSecretKey);
					$uploadName = $_FILES['AgentBanner']['name']['image'];;
					$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
				 
				}
				else{
						if($uploadedFile)
						{
						$path =  Yii::app()->basePath . '/../../uploads';
						$uploadedFile->saveAs($path.'/banner/'. $fileName);
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
		 
        $model = AgentBanner::model()->findByPk((int)$id); 
		//$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
       
             
             $model->attributes = $attributes;
            // $model->script =     Yii::app()->params['POST']['script'] ; 
             
              
             $oldfilename =$model->image;
             $file = CUploadedFile::getInstance($model, 'image');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {
				          
				$fileMain = $_FILES['AgentBanner']['name']['image'];
				$ext = pathinfo($fileMain, PATHINFO_EXTENSION);
				$fileName = rand(0,9999).'_'.time().".".$ext;;
				$model->image = $fileName;
			 } else {
				$model->image = $oldfilename;
			 }
			  
        
			 
            if (!$model->save()) {
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if (is_object($file) && get_class($file)==='CUploadedFile') {
				 
				 
				 	if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER=='1' ){
					 
					$file_orginal = $_FILES['AgentBanner']['tmp_name']['image'];
					$img = $model->image;
					$awsAccessKey = ENABLED_AWS_ACCESS;
					$awsSecretKey = ENABLED_AWS_SECRET;
					$bucketName = ENABLED_BUCKET_NAME;
					Yii::import('common.extensions.amazon.S3');
					$s3 = new S3($awsAccessKey, $awsSecretKey);
					$uploadName = $_FILES['AgentBanner']['name']['image'];;
					$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
				 
				}
				else{
				 
				 
							$path =  Yii::app()->basePath . '/../../uploads';
							$file->saveAs($path.'/banner/'. $fileName);
							if ($oldfilename != $fileName) {
							@unlink(Yii::app()->basePath . '/../../uploads/banner/'. $oldfilename);
							}
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
        $model = AgentBanner::model()->findByPk((int)$id);
        
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
  
    
   
    
}
