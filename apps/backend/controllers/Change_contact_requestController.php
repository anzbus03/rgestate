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
 
class Change_contact_requestController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex($type=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new UserDetailsChange('search');
       
        $user->unsetAttributes();
         $user->status ='W';
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Request List'), 
            'pageHeading'       => Yii::t('agent',  'Request List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity',  'Request List') => $this->createUrl('change_contact_request/index'),
                Yii::t('app', 'View all')
            )
        ));
     
        $this->render('list', compact('user','type','tags','tags_short'));
    }
      public function actionView($id)
    {
		 
        $request  = UserDetailsChange::model()->findByPk((int)$id);
          if (empty($request)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user =  $request->user ;

      
       
         
        $this->renderPartial('_view', compact('user','model','request'));
    }
   public function actionStatus_change($id=null,$val=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			return false;
		}
        $request = UserDetailsChange::model()->findByPk((int)$id);
		if (empty($request)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $request::model()->updateByPk($id,array('status'=>$val));
        ListingUsers::model()->updateByPk( $request->user_id,array('first_name'=>$request->contact_name,'phone'=>$request->phone,'mobile'=>$request->landline));
        echo 1; 
    }
}
