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

class AgentsController extends Controller
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
    private function calculatePercentageDifference($current, $previous) {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
        $salesThisMonth = SoldProperty::model()->getSalesThisMonth();
        $salesTotal = SoldProperty::model()->getSalesTotal();

        // Get total properties sold this year
        $startDateYear = date('Y-01-01');
        $endDateYear = date('Y-m-d', strtotime('+1 day'));
        $totalPropertiesSoldYear = SoldProperty::model()->getRevenueForAll($startDateYear, $endDateYear);

        // Get total properties sold last year
        $startDateLastYear = date('Y-01-01', strtotime('-1 year'));
        $endDateLastYear = date('Y-12-31', strtotime('-1 year'));
        $totalPropertiesSoldLastYear = SoldProperty::model()->getRevenueForAll($startDateLastYear, $endDateLastYear);

        // Calculate percentage change between this year and last year
        $percentageChangeYear = $this->calculatePercentageDifference($totalPropertiesSoldYear, $totalPropertiesSoldLastYear);

        // Get total properties sold this month
        $startDateMonth = date('Y-m-01');
        $endDateMonth = date('Y-m-t', strtotime('+1 day'));
        $totalPropertiesSoldMonth = SoldProperty::model()->getRevenueForAll($startDateMonth, $endDateMonth);

        // Get total properties sold last month
        $startDateLastMonth = date('Y-m-01', strtotime('-1 month'));
        $endDateLastMonth = date('Y-m-t', strtotime('-1 month'));
        $totalPropertiesSoldLastMonth = SoldProperty::model()->getRevenueForAll($startDateLastMonth, $endDateLastMonth);

        // Calculate percentage change between this month and last month
        $percentageChangeMonth = $this->calculatePercentageDifference($totalPropertiesSoldMonth, $totalPropertiesSoldLastMonth);

        // Get total properties sold this week
        $startDateWeek = date('Y-m-d', strtotime('monday this week'));
        $endDateWeek = date('Y-m-d', strtotime('sunday this week'. ' +1 day'));
        
        $totalPropertiesSoldWeek = SoldProperty::model()->getRevenueForAll($startDateWeek, $endDateWeek);
        $dailySalesData = SoldProperty::model()->getDailySalesData($startDateWeek, $endDateWeek);
        $monthlySalesData = SoldProperty::model()->getMonthlySalesData(date('Y'));
        $weeklySalesData = SoldProperty::model()->getWeeklySalesData(date('Y'), date('m'));
        // Get total properties sold last week
        $startDateLastWeek = date('Y-m-d', strtotime('monday last week'));
        $endDateLastWeek = date('Y-m-d', strtotime('sunday last week'. ' +1 day'));
        $totalPropertiesSoldLastWeek = SoldProperty::model()->getRevenueForAll($startDateLastWeek, $endDateLastWeek);

        // Calculate percentage change between this week and last week
        $percentageChangeWeek = $this->calculatePercentageDifference($totalPropertiesSoldWeek, $totalPropertiesSoldLastWeek);


        // Get number of agents
        $numberOfAgents = User::model()->getNumberOfAgents();

        // Get top 5 active agents
        $topAgents = SoldProperty::model()->getTop5ActiveAgents();
        // print_r($topAgents);
        // exit;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'Agents List'),
            'pageHeading'       => Yii::t('agent', 'Agent Dashboard'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'Agents') => $this->createUrl('agents/index'),
                Yii::t('app', 'View all')
            )
        ));
        // echo "<pre>";
        // print_r($dailySalesData);
        // exit;
        $criteria = new CDbCriteria;
        $criteria->compare('tag_type', 'C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short = CHtml::listData($tagModel, 'tag_id', 'tagCodeWithColor');

        $this->render('index', compact('user',  'revenue',  'salesThisMonth','salesTotal', 'totalPropertiesSoldYear', 'totalPropertiesSoldLastYear', 'percentageChangeYear',
            'totalPropertiesSoldMonth', 'totalPropertiesSoldLastMonth', 'percentageChangeMonth',
            'totalPropertiesSoldWeek', 'totalPropertiesSoldLastWeek', 'percentageChangeWeek'
        , 'salesThisMonth', 'monthlySalesData', 'weeklySalesData', 'dailySalesData', 'numberOfAgents', 'topAgents', 'tags', 'tags_short'));
    }

    /**
     * List of  users
     */
    public function actionList()
    {
        $request = Yii::app()->request;

        $model = new User('search');
        $model->unsetAttributes(); // clear any default values

        if ($request->getQuery('User')) {
            $model->attributes = $request->getQuery('User');
        }

        // Only show users where `is_agent = 1`
        $model->is_agent = 1;

        // Set the pagination for 12 items per page
        $users = new CActiveDataProvider('User', array(
            'criteria' => $model->search()->getCriteria(),
            'pagination' => array(
                'pageSize' => 12, // Set the number of items per page
            ),
        ));

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'View users'),
            'pageHeading'       => Yii::t('users', 'Agents List'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'View all')
            )
        ));

        // Render the list view
        $this->render('list', compact('users'));
    }



    /**
     * view details of a user
     */
    public function actionView($id)
    {
        // Fetch the user by primary key (user ID)
        $user = User::model()->findByPk((int)$id);

        // Check if the user exists, if not throw a 404 error
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $startDate = '';
        $endDate = date('Y-m-d', strtotime('+1 day'));
    
        switch ($user->target_period) {
            case 'yearly':
                $startDate = date('Y-01-01'); // Start from the beginning of the current year
                break;
            case 'monthly':
                $startDate = date('Y-m-01'); // Start from the beginning of the current month
                break;
            case 'weekly':
                $startDate = date('Y-m-d', strtotime('monday this week')); // Start from the beginning of the current week
                break;
            default:
                $startDate = date('Y-01-01'); // Default to the beginning of the year
                break;
        }
    
        // Fetch the total revenue for the user within the calculated date range
        $revenueForSale = SoldProperty::model()->getRevenueForUser($user->user_id, $startDate, $endDate, 1);   
        $revenueForRent = SoldProperty::model()->getRevenueForUser($user->user_id, $startDate, $endDate, 2);   
        

        // Calculate percentage for "For Sale" target
        if ($user->target_for_sale > 0) {
            $completionPercentage = ($revenueForSale / $user->target_for_sale) * 100;
        } else {
            $completionPercentage = 0;
        }
        if ($user->target_for_rent > 0) {
            $completionPercentageRent = ($revenueForRent / $user->target_for_rent) * 100;
        } else {
            $completionPercentageRent = 0;
        }
        $userProperties = PlaceAnAd::model()->findAllByAttributes(array(
            'user_id' => $user->user_id,
        ));
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'View users'),
            'pageHeading'       => Yii::t('users', 'Agent Details'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'View all')
            )
        ));

        // Render the 'details' view, passing 'user', 'completionPercentage', and 'completionPercentageForRent'
        $this->render('details', compact('user', 'userProperties', 'revenue', 'numberOfAgents', 'revenueForSale', 'revenueForRent', 'completionPercentage', 'completionPercentageRent'));
    }




    /**
     * Create a new user
     */
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new User();
        // $user->scenario = 'agent_insert'; // Uncomment if you need to apply specific validation rules for this scenario.

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;    
            $user->rules = 3;
            // Handle the file upload
            $uploadedFile = CUploadedFile::getInstance($user, 'profile_image');
            if ($uploadedFile !== null) {
                $fileName = uniqid() . '_' . $uploadedFile->getName();
                $user->profile_image = $fileName;
            }
            if ($user->save()) {
                if ($uploadedFile !== null) {
                    $uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/profile_images/' . $fileName);
                }
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(array('agents/list'));
            } else {
                $errors = CHtml::errorSummary($user);
                $notify->addError(Yii::t('app', 'There were errors: ' . $errors));
            }
        }

        // Set up page metadata, scripts, and styles for the view
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'Create Agent'),
            'pageHeading'       => Yii::t('agent', 'Create Agent'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Agent') => $this->createUrl('agents/index'),
                Yii::t('app', 'Create new'),
            )
        ));

        // Add necessary scripts and styles for the page
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));

        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
        $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));

        // Render the form
        $this->render('form', compact('user'));
    }


    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {

        $user = Agents::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $user->scenario = 'agent_update';


        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if ($user->password == "") {
                unset($user->password);
                $user->con_password = '';
            }
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {

                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));

            if ($collection->success) {
                $this->redirect(array('agents/index'));
            }
        }

        //  echo  $user->password;echo "SDSD";exit;
        $user->password = "";
        $user->con_password = "";
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('capacity', 'Update Agent'),
            'pageHeading'       => Yii::t('agent', 'Update Agent'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Agent') => $this->createUrl('agents/index'),
                Yii::t('app', 'Update'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
        $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
        $this->render('form', compact('user'));
    }

    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = User::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->updateBypk($id, array('isTrash' => '1'));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('agents/index')));
        }
    }
    public function actionLoadCity_latest($state_id = null)
    {
        $data = States::model()->findAllByAttributes(array('state_id' => $state_id));
        $data = CHtml::listData($data, 'id', 'name');
        echo "<option value=''>Select City</option>";
        foreach ($data as $k => $v)
            echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
    }
    public function actionLoadCity()
    {
        $limit = 30;
        $request = Yii::app()->request;
        $criteria = new CDbCriteria;
        $criteria->compare('state_name', $request->getQuery('q'), true);
        $criteria->compare('t.isTrash', '0');
        $country_array = explode(',', $request->getQuery('country_id'));
        $criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = cn.country_id  ';
        $criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END ';
        $criteria->addInCondition('t.country_id', $country_array);

        $criteria->select = 't.state_id,state_name';
        $count = States::model()->count($criteria);
        $criteria->order = 'state_name ASC';
        $criteria->group = 'state_name';
        $criteria->limit   =  $limit;
        $page = Yii::app()->request->getQuery('page', 1);

        $offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
        $criteria->offset =  $offset;

        $data = States::model()->findAll($criteria);
        $ar = array();

        if ($data) {
            foreach ($data as $k => $v) {

                $ar[] = array('id' => $v->state_id, 'text' => $v->state_name);
            }
        }
        if ($request->getQuery('city_id') != 'null') {
            $city_array = explode(',', $request->getQuery('city_id'));
            if (!empty($city_array)) {
                $criteria = new CDbCriteria;
                $criteria->addInCondition('t.state_id', $city_array);
                $criteria->addInCondition('t.country_id', $country_array);
                $data2 = States::model()->findAll($criteria);
                if ($data2) {
                    foreach ($data2 as $k => $v) {

                        $ar[] = array('id' => $v->state_id, 'text' => $v->state_name);
                    }
                }
            }
        }
        $record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
        echo  json_encode($record);
        Yii::app()->end();
    }
    public function actionloadArea($country_id = null)
    {
        $limit = 30;
        $request = Yii::app()->request;
        $criteria = new CDbCriteria;
        $criteria->compare('state_name', $request->getQuery('q'), true);
        $criteria->compare('t.isTrash', '0');

        $criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = t.country_id  ';
        //$criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END ';
        $criteria->compare('t.country_id', (int)$country_id);

        $criteria->select = 't.state_id,state_name';
        $count = States::model()->count($criteria);
        $criteria->order = 'state_name ASC';
        $criteria->group = 'state_name';
        $criteria->limit   =  $limit;
        $page = Yii::app()->request->getQuery('page', 1);

        $offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
        $criteria->offset =  $offset;

        $data = States::model()->findAll($criteria);
        $ar = array();

        if ($data) {
            foreach ($data as $k => $v) {

                $ar[] = array('id' => $v->state_id, 'text' => $v->state_name);
            }
        }
        $record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
        echo  json_encode($record);
        Yii::app()->end();
    }
    public function actionFeatured($id, $featured)
    {
        $model = Agents::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $featured = ($featured == "N") ? "Y" : "N";
        $model->updateByPk($id, array('featured' => $featured));


        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }
}
