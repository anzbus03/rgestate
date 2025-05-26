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
    private function calculatePercentageDifference($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }
    public function actionIndex()
    {
        ini_set('memory_limit', '-1');
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
    
        // Check if a custom date range was provided in GET
        $dateRange = $request->getQuery('date_range');
        
        if (!empty($dateRange)) {
            // Expected format: "DD-MMM-YYYY - DD-MMM-YYYY"
            list($customStart, $customEnd) = explode(' - ', $dateRange);
            // Convert to Y-m-d format; add one day to $customEnd to include the selected end date
            $customStart = date('Y-m-d', strtotime($customStart));
            $customEnd   = date('Y-m-d', strtotime($customEnd . ' +1 day'));
         
        }
    
        // Example: For properties sold this year,
        // If custom date range exists use it; otherwise use default start of the year and tomorrow’s date
        $totalPropertiesSoldYear = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-01-01'),
            isset($customEnd)   ? $customEnd   : date('Y-m-d', strtotime('+1 day'))
        );
    
        // Similarly, for properties sold this month:
        $totalPropertiesSoldMonth = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-m-01'),
            isset($customEnd)   ? $customEnd   : date('Y-m-t', strtotime('+1 day'))
        );
    
        // And for properties sold this week:
        $totalPropertiesSoldWeek = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-m-d', strtotime('monday this week')),
            isset($customEnd)   ? $customEnd   : date('Y-m-d', strtotime('sunday this week' . ' +1 day'))
        );
    
        // For daily sales data, we use the same week range:
        $dailySalesData = SoldProperty::model()->getDailySalesData(
            isset($customStart) ? $customStart : date('Y-m-d', strtotime('monday this week')),
            isset($customEnd)   ? $customEnd   : date('Y-m-d', strtotime('sunday this week' . ' +1 day'))
        );
    
        // For monthly and weekly sales data, if you want to override the default year/month filtering,
        // you may do the same; otherwise keep the current defaults.
        // (Below we keep the defaults; change as needed.)
        $monthlySalesData = SoldProperty::model()->getMonthlySalesData(date('Y'));
        $weeklySalesData  = SoldProperty::model()->getWeeklySalesData(date('Y'), date('m'));
    
        // Similarly for properties sold last year:
        $totalPropertiesSoldLastYear = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-01-01', strtotime('-1 year')),
            isset($customEnd)   ? $customEnd   : date('Y-12-31', strtotime('-1 year'))
        );
    
        // And last month:
        $totalPropertiesSoldLastMonth = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-m-01', strtotime('-1 month')),
            isset($customEnd)   ? $customEnd   : date('Y-m-t', strtotime('-1 month'))
        );
    
        // Calculate percentage changes using existing helper method
        $percentageChangeYear  = $this->calculatePercentageDifference($totalPropertiesSoldYear, $totalPropertiesSoldLastYear);
        $percentageChangeMonth = $this->calculatePercentageDifference($totalPropertiesSoldMonth, $totalPropertiesSoldLastMonth);
    
        // For last week:
        $totalPropertiesSoldLastWeek = SoldProperty::model()->getRevenueForAll(
            isset($customStart) ? $customStart : date('Y-m-d', strtotime('monday last week')),
            isset($customEnd)   ? $customEnd   : date('Y-m-d', strtotime('sunday last week' . ' +1 day'))
        );
        $percentageChangeWeek = $this->calculatePercentageDifference($totalPropertiesSoldWeek, $totalPropertiesSoldLastWeek);
    
        // Other queries that do not use dates remain unchanged:
        $salesThisMonth = SoldProperty::model()->getSalesThisMonth();
        $salesTotal     = SoldProperty::model()->getSalesTotal();
    
        // Get number of agents and related agent data
        $numberOfAgents        = User::model()->getNumberOfAgents();
        $agents                = User::model()->getAllAgents();
        $agentProperties       = User::model()->getAllAgentsProperties(1, $customStart, $customEnd);
        $agentPropertiesRent   = User::model()->getAllAgentsProperties(2, $customStart, $customEnd);
        $agentPropertiesProjects = User::model()->getAllAgentsProperties(3, $customStart, $customEnd);
        $agentPropertiesBusiness = User::model()->getAllAgentsProperties(6, $customStart, $customEnd);
        $topAgents = SoldProperty::model()->getTop5ActiveAgents($customStart, $customEnd);
            
        // Set page metadata
        $this->setData(array(
            'pageMetaTitle'   => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'Agents List'),
            'pageHeading'     => Yii::t('agent', 'Agent Dashboard'),
            'pageBreadcrumbs' => array(
                Yii::t('capacity', 'Agents') => $this->createUrl('agents/index'),
                Yii::t('app', 'View all')
            )
        ));
    
        // Get tags
        $criteria = new CDbCriteria;
        $criteria->compare('tag_type', 'C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short = CHtml::listData($tagModel, 'tag_id', 'tagCodeWithColor');
    
        // Render the view, passing all variables including the custom date range revenue if set.
        $this->render('index', compact(
            'agentProperties',
            'agents',
            'salesThisMonth',
            'salesTotal',
            'totalPropertiesSoldYear',
            'totalPropertiesSoldLastYear',
            'percentageChangeYear',
            'totalPropertiesSoldMonth',
            'totalPropertiesSoldLastMonth',
            'percentageChangeMonth',
            'totalPropertiesSoldWeek',
            'totalPropertiesSoldLastWeek',
            'percentageChangeWeek',
            'monthlySalesData',
            'weeklySalesData',
            'dailySalesData',
            'numberOfAgents',
            'topAgents',
            'tags',
            'tags_short',
            'agentPropertiesRent',
            'agentPropertiesProjects',
            'agentPropertiesBusiness',
            'totalPropertiesSoldRange' // available if a date range was provided
        ));
    }
    

    /**
     * List of  users
     */
    public function actionList()
    {
        $request = Yii::app()->request;
        $model = new User('search');
        $model->unsetAttributes(); // Clear any default values

        if ($request->getQuery('User')) {
            $model->attributes = $request->getQuery('User');
        }

        // Get the logged-in user model
        $loggedInUser = Yii::app()->user->model;

        // Set up the criteria for the user search
        $criteria = $model->search()->getCriteria();

        if ($loggedInUser->rules == 2) {
            // If rules equal to 2, get the assigned agent IDs from the 'agents' column
            $userAgents = explode(",", $loggedInUser->agents);
            $userAgents = array_map('trim', $userAgents); // Trim whitespace

            // Filter users to include only those with IDs in the userAgents array
            $criteria->addInCondition('user_id', $userAgents);
        } elseif ($loggedInUser->rules == 3) {
            // If rules equal to 3, check user_id in users with rules = 2
            $agencyUsers = User::model()->findAll(array(
                'condition' => 'rules = 2',
            ));
            $agencyUserIds = [];
            foreach ($agencyUsers as $agency) {
                $agentsIds = explode(",", $agency->agents);
                if (in_array($loggedInUser->user_id, $agentsIds)) {
                    $agencyUserIds = $agentsIds;
                }
            }
            // Filter users to include only those with IDs in the agencyUserIds array
            $criteria->addInCondition('user_id', $agencyUserIds);
        } else {
            // Default case: only show users where `is_agent = 1`
            $model->is_agent = 1;
            $criteria->addCondition('is_agent = 1');
        }

        // Set the pagination for 12 items per page
        $users = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
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
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
        $dateRange = Yii::app()->request->getParam('date_range');
        // print_r($dateRange);
        // exit;
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

        $criteria = new CDbCriteria();
        $criteria->compare('user_id', $user->user_id);

        // Apply location filter if present
        if (!empty($locationId)) {
            $criteria->compare('state', (int)$locationId);
        }

        // Apply property type filter if present
        if (!empty($propertyTypeId)) {
            $criteria->compare('section_id', (int)$propertyTypeId);
        }

        // Apply property category filter if present
        if (!empty($propertyCategoryId)) {
            $criteria->compare('category_id', (int)$propertyCategoryId);
        }

        // Apply status filter if present
        if (!empty($status)) {
            $criteria->compare('status', $status);
        }

        // Fetch filtered user properties
        $userProperties = PlaceAnAd::model()->findAll($criteria);
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
            $loggedInUser = Yii::app()->user->model;

            // Handle the file upload
            $uploadedFile = CUploadedFile::getInstance($user, 'profile_image');
            if ($uploadedFile !== null) {
                $fileName = uniqid() . '_' . $uploadedFile->getName();
                $user->profile_image = $fileName;
            }

            if ($user->save()) {
                if ($loggedInUser->rules == 2) {
                    // If rules equal to 2, get the assigned agent IDs from the 'agents' column
                    $userAgents = explode(",", $loggedInUser->agents);

                    if (!in_array($user->user_id, $userAgents)) {
                        $userAgents[] = $user->user_id;
                    }
                    $imploded = implode(",", $userAgents);

                    $userModel = User::model()->findByPk($loggedInUser->user_id);

                    if ($userModel) {
                        $userModel->agents = $imploded;
                        $userModel->confirm_email = $userModel->email;
                        $userModel->save();

                        if (!$userModel->save()) {
                            $errors = $userModel->getErrors();
                            Yii::app()->notify->addError(Yii::t('app', 'Failed to update agent list: ' . print_r($errors, true)));
                        }
                    }
                }
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
