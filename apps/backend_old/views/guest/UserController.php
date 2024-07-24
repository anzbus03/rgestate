<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * GuestController
 * 
 * Handles the actions for guest related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class UserController extends Controller
{
    public $layout = 'sub';
    
    /**
     * Display the login form so that a guest can login and become an administrator
     */
    public function actionSignin()
    {
		
        $model = new UserLogin();
        $request = Yii::app()->request;
      //  print_r($_POST);
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
			//print_r($_POST);exit;
            $model->attributes = $attributes;
            if ($model->validate()) {
			
				   
                $this->redirect(Yii::app()->createUrl('user/my_profile'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle' => Yii::app()->name . ' | '. Yii::t('users', 'Please login'), 
            'pageHeading'   => Yii::t('users', 'Please login'),
        ));
        
        $this->render('login', compact('model'));
    }
    public function actionSignup()
    {
        $model = new BookingUsers();
        $request = Yii::app()->request;
      //  print_r($_POST);
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
			//print_r($_POST);exit;
            $model->attributes = $attributes;
            if ($model->save()) {
				 
				 Yii::app()->user->setFlash('success','1');
                $this->redirect(Yii::app()->createUrl('user/signup'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle' => Yii::app()->name . ' | '. Yii::t('users', 'Please login'), 
            'pageHeading'   => Yii::t('users', 'Please login'),
        ));
        
        $this->render('signup', compact('model'));
    }
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->loginUrl);    
    }
    
    /**
     * Display the form to retrieve a forgotten password.
     */
    public function actionForgot_password()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new UserPasswordReset();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if (!$model->validate()) {
                $notify->addError(Yii::t('app', 'Please fix your form errors!'));
            } else {
                $options = Yii::app()->options;
                $user = User::model()->findByAttributes(array('email' => $model->email));
                $model->user_id = $user->user_id;
                $model->save(false);
                
                $emailTemplate = $options->get('system.email_templates.common');
                $emailBody = $this->renderPartial('_email-reset-key', compact('model', 'user'), true);
                $emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);

                $params = array(
                    'to'        => array($user->email => ($user->getFullName() ? $user->getFullName() : $user->email)),
                    'subject'   => Yii::t('users', 'Password reset request!'),
                    'body'      => $emailTemplate, 
                );

                if ($model->sendEmail($params) !== true) {
                    $notify->addError(Yii::t('app', 'Temporary error while sending your email, please try again later or contact us!'));
                } else {
                    $notify->addSuccess(Yii::t('app', 'Please check your email address.'));
                    $model->unsetAttributes();
                    $model->email = null;
                }
            }
        }
     
        $this->setData(array(
            'pageMetaTitle' => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Retrieve a new password for your account.'), 
        ));

        $this->render('forgot_password', compact('model'));
    }
    
    /**
     * Reached from email, will reset the password for given user and send a new one via email.
     */
    public function actionReset_password($reset_key)
    {
        $model = UserPasswordReset::model()->findByAttributes(array(
            'reset_key' => $reset_key,
            'status'    => UserPasswordReset::STATUS_ACTIVE,
        ));
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $randPassword = StringHelper::random();
        $hashedPassword = Yii::app()->passwordHasher->hash($randPassword);
        
        User::model()->updateByPk((int)$model->user_id, array('password' => $hashedPassword));
        $model->status = UserPasswordReset::STATUS_USED;
        $model->save();
        
        $options = Yii::app()->options;
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = User::model()->findByPk($model->user_id);
        $currentPassword = $user->password;
        
        $emailTemplate = $options->get('system.email_templates.common');
        $emailBody = $this->renderPartial('_email-new-login', compact('model', 'user', 'randPassword'), true);
        $emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);
                
        $params = array(
            'to'        => array($user->email => ($user->getFullName() ? $user->getFullName() : $user->email)),
            'subject'   => Yii::t('app', 'Your new login info!'),
            'body'      => $emailTemplate, 
        );
        
        if ($model->sendEmail($params) !== true) {
            User::model()->updateByPk((int)$model->user_id, array('password' => $currentPassword));
            $notify->addError(Yii::t('app', 'Temporary error while sending your email containing your new login, please try again later or contact us!'));
        } else {
            $notify->addSuccess(Yii::t('app', 'Your new login has been successfully sent to your email address.'));
        }
        
        $this->redirect(array('guest/index'));
    }
    public function actionMy_profile()
    {
		 
	       $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Profile', array('{name}' => Yii::app()->name )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
             
        ));
        $user =  new BookingUsers();
         $user =  $user->findByPk((int)Yii::app()->user->getId());
        if(Yii::app()->request->isPostRequest)
			{
				 
				  $attributes = (array)Yii::app()->request->getPost('BookingUsers', array());
				  $user->attributes =  $attributes;
				  if($user->save())
				  {
					  Yii::app()->user->setFlash('success','1');
				  }
				  else
				  {
					  print_r($user->getErrors());
				  }
				 
			}
		
		 if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
         }
         $this->render("my_profile",compact("user"));
	}
    public function actionMy_Booking()
    {
		 
	       $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Booking', array('{name}' => Yii::app()->name )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Booking'),
            'pageMetaDescription'   => Yii::app()->params['description'],
             
        ));
        $user =  new BookingUsers();
        $user =  $user->findByPk((int)Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
         }
         
                    $criteria= new CDbCriteria;
				    $criteria->condition= "t.user=:uid";
				    $criteria->order="t.booking_id desc";
				    $criteria->params[":uid"] = (int)Yii::app()->user->getId();
				    $count=Booking::model()->count($criteria);
				    
				    $pages=new CPagination($count);
				    $pages->pageSize=10;
					$pages->applyLimit($criteria);
				    $model = Booking::model()->findAll($criteria);
				    
          
		
		
                     $this->render("my_booking",compact("user","model","pages"));
	}
    
    /**
     * The error handler
     */
    public function actionError()
    {    
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo CHtml::encode($error['message']);
            } else {
                $this->setData(array(
                    'pageMetaTitle' => Yii::t('app', 'Error {code}!', array('{code}' => $error['code'])), 
                ));
                $this->render('error', $error) ;
            }    
        }
    }
}
