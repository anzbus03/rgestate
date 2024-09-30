<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * AccountController
 * 
 * Handles the actions for account related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class AccountController extends Controller
{
    /**
     * Default action, allowing to update the account.
     */
    public function actionIndex()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $user       = Yii::app()->user->getModel();
        $user->confirm_email = $user->email;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
    
            // Check if a profile image is uploaded
            $uploadedFile = CUploadedFile::getInstance($user, 'profile_image');
            if ($uploadedFile !== null) {
                // Define the target directory and generate a unique file name
                $targetDir = Yii::app()->basePath . '/../../uploads/images/';
                $fileName = 'user_' . $user->user_id . '_' . time() . '.' . $uploadedFile->getExtensionName();
                
                // Create directory if it doesn't exist
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
    
                // Move the uploaded file to the target directory
                if ($uploadedFile->saveAs($targetDir . $fileName)) {
                    // Update the user's profile image field in the database
                    $user->profile_image = $fileName;
                } else {
                    $notify->addError(Yii::t('app', 'Error uploading the profile image.'));
                }
            }
    
            // Save the user and handle errors
            if (!$user->save()) {
                // Loop through the errors and add them to the notification
                foreach ($user->getErrors() as $errors) {
                    foreach ($errors as $error) {
                        $notify->addError($error);
                    }
                }
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
    
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'user'      => $user,
            )));
    
            if ($collection->success) {
                $this->redirect(array('account/index'));
            }
        }
    
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Update account'),
            'pageHeading'       => Yii::t('users', 'Update account'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('users', 'Update account'),
            )
        ));
    
        $this->render('index', compact('user'));
    }
    
    
    
    /**
     * Log the user out from the application
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->loginUrl);    
    }
}