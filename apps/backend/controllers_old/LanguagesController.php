<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * LanguagesController
 * 
 * Handles the actions for languages related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.1
 */
 
class LanguagesController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        $filters = array(
            'postOnly + delete', // we only allow deletion via POST request
        );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    
    /**
     * List all available languages
     */
    public function actionIndex()
    {
		/*
		$lan = array('Afrikaans',
'Albanian',
'Amharic',
'Azerbaijani',
'Bahasa Melayu',
'Baluchi',
'Belarusian',
'Bengali',
'Berber',
'Bulgarian',
'Cantonese',
'Catalan',
'Croatian',
'Czech',
'Danish',
'Dutch',
'Finnish',
'French',
'German',
'Greek',
'Gujarati',
'Hungarian',
'Italian',
'Japanese',
'Javanese',
'Kannada',
'Kazakh',
'Korean',
'Kurdi',
'Kyrgyz',
'Latvian',
'Malay',
'Malayalam',
'Mandarin',
'Memon',
'Norwegian',
'Pashto',
'Persian/Farsi',
'Polish',
'Portuguese',
'Punjabi',
'Romanian',
'Russian',
'Serbian',
'Shona',
'Sinhalese',
'Slovak',
'Slovene',
'Somali',
'Spanish',
'Sudanese',
'Swahili',
'Swedish',
'Tagalog',
'Tamil',
'Telugu',
'Thai',
'Turkish',
'Ukranian',
'Urdu',
'Uzbek');


foreach($lan as  $v){
	$language = new Language();
	$language->name = $v;
	$language->is_default = 'no';
	$language->save(); 
}

exit; */


        $request = Yii::app()->request;
        $language = new Language('search');
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
						 
						$id = 'Language_name_'.$menuId;
						$relation = 'lang_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
				   $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
       
        $language->unsetAttributes();
       // $languageUpload = new LanguageUploadForm();
        
        // for filters.
        $language->attributes = (array)$request->getQuery($language->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('languages', 'View available languages'), 
            'pageHeading'       => Yii::t('languages', 'View available languages'),
            'pageBreadcrumbs'   => array(
                Yii::t('languages', 'Languages') => $this->createUrl('languages/index'),
                Yii::t('app', 'View all')
            )
        ));
        
        $this->render('list', compact('language', 'languageUpload'));
    }
    
    /**
     * Create a new language
     */
    public function actionCreate()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $language   = new Language();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($language->modelName, array()))) {
            $language->attributes = $attributes;
            if (!$language->validate()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                try {
                    $locale = Yii::app()->getLocale($language->getLanguageAndLocaleCode());
                    $language->save(false);
                    $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                } catch (Exception $e) {
                    $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                    $notify->addError($e->getMessage());
                }
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'language'  => $language,
            )));
            
            if ($collection->success) {
                $this->redirect(array('languages/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('languages', 'Create new language'), 
            'pageHeading'       => Yii::t('languages', 'Create new language'),
            'pageBreadcrumbs'   => array(
                Yii::t('languages', 'Languages') => $this->createUrl('languages/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('language'));
    }
    
    /**
     * Update existing language
     */
    public function actionUpdate($id)
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $language   = Language::model()->findByPk((int)$id);
        
        if (empty($language)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($language->modelName, array()))) {
            $language->attributes = $attributes;
            if (!$language->validate()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                try {
                    $locale = Yii::app()->getLocale($language->getLanguageAndLocaleCode());
                    $language->save(false);
                    $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                } catch (Exception $e) {
                    $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                    $notify->addError($e->getMessage());
                }  
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'language'  => $language,
            )));
            
            if ($collection->success) {
            
            } 
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('languages', 'Update language'), 
            'pageHeading'       => Yii::t('languages', 'Update language'),
            'pageBreadcrumbs'   => array(
                Yii::t('languages', 'Languages') => $this->createUrl('languages/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('language'));
    }
    
    /**
     * Upload language pack
     */
    public function actionUpload()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new LanguageUploadForm();
        
        if ($request->isPostRequest && $request->getPost($model->modelName)) {
            $model->archive = CUploadedFile::getInstance($model, 'archive');
               if (!$model->upload()) {
                   $notify->addError($model->shortErrors->getAllAsString());
               } else {
                   $notify->addSuccess(Yii::t('languages', 'Your language pack has been successfully uploaded!'));
               }
               $this->redirect(array('languages/index'));
          }
          
          $notify->addError(Yii::t('languages', 'Please select a language pack archive for upload!'));
          $this->redirect(array('languages/index'));
    }
    
    /**
     * Delete existing language
     */
    public function actionDelete($id)
    {
        $language = Language::model()->findByPk((int)$id);
        
        if (empty($language)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        if ($language->is_default != Language::TEXT_YES) {
            $language->delete();
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('languages/index')));
        }
    }
   
}
