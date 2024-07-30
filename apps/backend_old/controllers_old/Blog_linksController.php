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
 
class Blog_linksController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Home Blog";
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
         if($request->getQuery('update_cache','0')=='1'){
                  $cacheKey =  'blog_banners'.Yii::app()->options->get('system.common.blog_banner_cache','123s421');
                 Yii::app()->cache->delete($cacheKey);
                 Yii::app()->options->set('system.common.blog_banner_cache',time());
                 $notify->addSuccess(Yii::t('app', 'Cache successfully updated!'));
				  $this->redirect(Yii::app()->createUrl(Yii::app()->controller->id.'/index')) ;
         }
        
         $model = new BlogBanner('serach');
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
        $model = new BlogBanner();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
           
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if( $uploadedFile){
				$model->image = $this->fileUploadDropzoneBanner();
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
		 
        $model = BlogBanner::model()->findByPk((int)$id); 
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
				          
				$model->image = $this->fileUploadDropzoneBanner();
			 } else {
				$model->image = $oldfilename;
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
        $model = BlogBanner::model()->findByPk((int)$id);
        
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
  
       public function fileUploadDropzoneBanner(){
		
			$path_file =  Yii::getPathOfAlias('root.uploads.files');
	 		$ref=new imageResize;
	 		
	 		 
			$file =  $_FILES['BlogBanner']['name']['image'];
			//$file =  $_FILES['Banner']['name']['image'];
			$file_orginal = $_FILES['BlogBanner']['tmp_name']['image'];
			//$file_orginal = $_FILES['Banner']['tmp_name']['image'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$file_format='jpeg';
			if(Yii::App()->isAppName('backend')){
				$path = '../uploads/tmp'; 
			}else{
			$path = 'uploads/tmp'; 
			} 
			$out = $ref->resize($file_orginal,$path,400,100,$file_format,TRUE);
			$img = date('Y-m-d').'-'.rand(0,9999).".".$file_format;
					 
					$year_folder = $path_file .'/'. date("Y");
					$month_folder = $year_folder . '/' . date("m");
					$month_folder2 = date("Y"). '/' . date("m");
					!file_exists($year_folder) && mkdir($year_folder , 0777);
					!file_exists($month_folder) && mkdir($month_folder, 0777);
					 $path_file = $month_folder ;
					 
					$storagePath = Yii::getPathOfAlias('root.uploads.tmp');
					$customerFiles = $storagePath.'/'.$out;
					  
					 rename( $customerFiles , $path_file."/{$img}");
					 
			  
			 		
			if(isset($_POST['rand'])){
				echo json_encode(array('img'=> $month_folder2. '/' .$img,'rand'=>$_POST['rand']));exit;
			} 
			return  $month_folder2. '/' .$img;  
		 
	}
   
    
}
