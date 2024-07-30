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
 
class Image_managementController extends Controller
{
	 
	public function init()
    {
	 
    
        parent::init();
    }
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
 
    
    /**
     * List all available users
     */
    public function actionIndex($id)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $ad = PlaceAnAd::model()->findByPk((int)$id);
        if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $model = new AdImage('search');
        if ($request->isPostRequest) {
			 
               $sortOrderAll = $_POST['priority'];
               
				if(count($sortOrderAll)>0)
				{
					
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						 
						  
						$user->isNewRecord =true; 
						 $user->updateByPk($menuId,array('priority'=>$sortOrder));
						 
						
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
         
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Imagae Management'), 
            'pageHeading'       => Yii::t('users', 'Image_mangement'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'AD') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'List Image')
            )
        ));
      
        $this->render('list', compact('user'));
    }
    
    
}
