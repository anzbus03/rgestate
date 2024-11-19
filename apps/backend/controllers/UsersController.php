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

class UsersController extends Controller
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
     * List all available users
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $user = new User('search');
        $user->unsetAttributes();
    
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
    
        // Get the logged-in user's model
        $loggedInUser = Yii::app()->user->model;
    
        // If the logged-in user's rules is 2, filter users by the same agency
        if ($loggedInUser->rules == 2) {
            $userIds = explode(',', $loggedInUser->agents);  // Assuming 'agents' contains user IDs of users under this agency
            // Add condition to filter users by the agency's user IDs
            $user->getDbCriteria()->addCondition('user_id IN (' . implode(',', array_map('intval', $userIds)) . ')');
        }
    
        // Set data for the page
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'View users'),
            'pageHeading'       => Yii::t('users', 'View users'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'View all')
            )
        ));
    
        // Render the view
        $this->render('list', compact('user'));
    }
    

    /**
     * Create a new user
     */

    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new User();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if (isset($attributes['agents'])) {
                // Convert the array of agent IDs to a comma-separated string
                $user->agents = implode(',', $attributes['agents']);
            } else {
                // If no agents selected, save it as an empty string or null
                $user->agents = null;
            }

            // Handle profile image upload
            $uploadedFile = CUploadedFile::getInstance($user, 'profile_image');
            if ($uploadedFile !== null) {
                $uploadDir = Yii::app()->basePath . '/../../uploads/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate a unique file name
                $fileName = 'user_' . $user->user_id . '_' . time() . '.' . $uploadedFile->getExtensionName();
                $filePath = $uploadDir . $fileName;

                // Save the file to the server
                if ($uploadedFile->saveAs($filePath)) {
                    // If there's already a profile image, remove the old file
                    if (!empty($user->profile_image) && file_exists($uploadDir . $user->profile_image)) {
                        unlink($uploadDir . $user->profile_image);
                    }

                    // Save the new file name in the database
                    $user->profile_image = $fileName;
                } else {
                    $notify->addError(Yii::t('app', 'Error while uploading the profile image.'));
                }
            }

            //    print_r($user->attributes);exit;
            if (!$user->save()) {
                $errors = CHtml::errorSummary($user);
                $notify->addError(Yii::t('app', 'There were errors: ' . $errors));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));

            if ($collection->success) {
                $this->redirect(array('users/index'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'Create new user'),
            'pageHeading'       => Yii::t('users', 'Create new user'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $apps = Yii::app()->apps;
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user'));
    }

    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
        $user = User::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        if ($user->removable === User::TEXT_NO && $user->user_id != Yii::app()->user->getId()) {
            Yii::app()->notify->addWarning(Yii::t('users', 'You are not allowed to update the master administrator!'));
            $this->redirect(array('users/index'));
        }

        $user->confirm_email = $user->email;
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;

            if (isset($attributes['agents'])) {
                $user->agents = implode(',', $attributes['agents']);
            } else {
                $user->agents = null;
            }

            // Handle profile image upload
            $uploadedFile = CUploadedFile::getInstance($user, 'profile_image');
            if ($uploadedFile !== null) {
                $uploadDir = Yii::app()->basePath . '/../../uploads/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate a unique file name
                $fileName = 'user_' . $user->user_id . '_' . time() . '.' . $uploadedFile->getExtensionName();
                $filePath = $uploadDir . $fileName;

                // Save the file to the server
                if ($uploadedFile->saveAs($filePath)) {
                    // If there's already a profile image, remove the old file
                    if (!empty($user->profile_image) && file_exists($uploadDir . $user->profile_image)) {
                        unlink($uploadDir . $user->profile_image);
                    }

                    // Save the new file name in the database
                    $user->profile_image = $fileName;
                } else {
                    $notify->addError(Yii::t('app', 'Error while uploading the profile image.'));
                }
            }

            if (!$user->save()) {
                $errors = $user->getErrors();
                $errorMessage = "Your form has a few errors, please fix them and try again!";

                if (!empty($errors)) {
                    $errorMessage .= "<ul>";
                    foreach ($errors as $attribute => $errorMessages) {
                        foreach ($errorMessages as $error) {
                            $errorMessage .= "<li>{$error}</li>";
                        }
                    }
                    $errorMessage .= "</ul>";
                }

                $notify->addError(Yii::t('app', $errorMessage));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully updated!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));

            if ($collection->success) {
                $this->redirect(array('users/index'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'Update user'),
            'pageHeading'       => Yii::t('users', 'Update user'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'Update'),
            )
        ));

        $apps = Yii::app()->apps;
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user'));
    }


    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {

        if (!Yii::app()->request->isPostRequest) {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }

        $user = User::model()->findByPk((int)$id);
        if ($user === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        if ($user->removable == User::TEXT_YES) {
            $user->delete();
        }

        if (!Yii::app()->request->isAjaxRequest) {
            Yii::app()->notify->addSuccess('The user has been successfully deleted!');
            $this->redirect(array('users/index'));
        }
    }


    public function actionImpersonate($id)
    {
        $customer = User::model()->findByPk((int)$id);

        if (empty($customer)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        Yii::import('backend.components.web.auth.*');
        $identity = new UserIdentity($customer->email, null);
        $identity->impersonate = true;

        if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
            $notify->addError(Yii::t('app', 'Unable to impersonate the customer!'));
            $this->redirect(array('customers/index'));
        }

        Yii::app()->user->setState('__customer_impersonate', true);
        $notify->clearAll()->addSuccess(Yii::t('app', 'You are using the customer account for {customerName}!', array(
            '{customerName}' => $customer->fullName ? $customer->fullName : $customer->email,
        )));

        $this->redirect(Yii::app()->apps->getAppUrl('backend', 'dashboard/index', true));
    }
}
