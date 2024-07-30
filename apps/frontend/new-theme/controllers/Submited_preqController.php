<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for articles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class Submited_preqController extends Controller
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
     * List all available
     */

    public function actionIndex()
    {

        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $model    = new PostRequirements();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
    		$requestParams = $request->getPost("PostRequirements"); 
    
            $model->attributes = $attributes;
            $phone_false = @$_POST[$model->modelName]['phone_false'];
            if (!empty($phone_false)) {
                $model->phone = $phone_false;
            }
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                // Start CRM
                $createCompanyUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.company.add.json';
    		    
                
                $crmCompanyData = [
                    'fields' => [
                        'TITLE' => $requestParams['name'],
                    ],
                ];
                $postCompanyData = http_build_query($crmCompanyData);
                $contextCompanyOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postCompanyData,
                    ],
                ];
                $companyId = 0;
                $contextCreateCompany = stream_context_create($contextCompanyOptions);
            	try {
                    // Send the HTTP request using file_get_contents
                    $dataCompany = file_get_contents($createCompanyUrl, false, $contextCreateCompany);
                    $responseCompany = json_decode($dataCompany, true);
                    $companyId = $responseCompany['result'];

                } catch (Exception $e) {
                    // Handle exceptions, e.g., connection errors
        			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
                }
                
              
                $createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
    		    
                // Prepare data for the request
                $fullName = $requestParams['name'];
                
                // Split the full name into an array using spaces as the delimiter
                $nameParts = explode(' ', $fullName);
                
                // Extract the first and last names
                $firstName = isset($nameParts[0]) ? $nameParts[0] : null;
                $lastName = isset($nameParts[1]) ? $nameParts[1] : null;
        
                $crmCustomerData = [
                    'fields' => [
                        'NAME' => $firstName,
                        'SECOND_NAME' => $lastName,
                        "TYPE_ID" => $requestParams['owner_type'] == 1 ? "OWNER" : "AGENT",
                        "SOURCE_ID" => "SELF",
                        "COMPANY_ID" => $companyId,
                        "EMAIL" => [[ "VALUE" => $requestParams['email'], "VALUE_TYPE" => "WORK" ]],
                        "PHONE" => [[ "VALUE" => $requestParams['phone'], "VALUE_TYPE" => "WORK" ]]
                    ],
                ];
                $postCustomerData = http_build_query($crmCustomerData);
                $contextCusotomerOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postCustomerData,
                    ],
                ];
                $contextCreateCustomer = stream_context_create($contextCusotomerOptions);
            	try {
                    // Send the HTTP request using file_get_contents
                    $data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
                    $response = json_decode($data, true);
                    $customerId = $response['result'];
                    // Handle the CRM response as needed
        
                } catch (Exception $e) {
                    // Handle exceptions, e.g., connection errors
        			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
                }

                // Send the form crm function 
                $crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';
                $unitValues = [
                    1 => 622,
                    6 => 624,
                    4 => 626,
                    3 => 628,
                    5 => 630
                ];
                
                $crmData = [
                    'FIELDS' => [
                        'TITLE' => 'Complete CRM form "Post Requirement Form"', 
                        'CONTACT_ID' => $customerId,
                        'ASSIGNED_BY_ID' => 22,
                        "EMAIL" => [[ "VALUE" => $requestParams['email'], "VALUE_TYPE" => "WORK" ]],
                        "PHONE" => [[ "VALUE" => $requestParams['phone'], "VALUE_TYPE" => "WORK" ]],
                        'COMMENTS' => 
                            ($requestParams['owner_type'] == 1 ? "Client Type: OWNER" : "Client Type: AGENT").
                            ($requestParams['p_for'] == 1 ? "<br/> Property For: Buy" : "<br/> Property For: Rent").
                            '<br/> Property Type: '.Category::model()->findByPk($requestParams['property_type'])->category_name.
                            '<br/> City: '.City::model()->find($requestParams['city_id'])->city_name
                            ,
                        'UF_CRM_1701080368178' => $unitValues[$requestParams['unit']],
                        'UF_CRM_1701080222003' => $requestParams['budget_min'],
                        'UF_CRM_1701080248594' => $requestParams['budget_max'],
                        'UF_CRM_1701080399829' => $requestParams['area_min'],
                        'UF_CRM_1701145616978' => $requestParams['area_max'],
                    ],
                ];
        
                // Convert data to a query string
                $postData = http_build_query($crmData);
        
                // Set up options for the stream context
                $contextOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postData,
                    ],
                ];
        
                $context = stream_context_create($contextOptions);
        
        
        		try {
                    // Send the HTTP request using file_get_contents
                    $response = file_get_contents($crmUrl, false, $context);
        
                    // Handle the CRM response as needed
        
                } catch (Exception $e) {
                    // Handle exceptions, e.g., connection errors
        				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
                }
                
                
                
                // End CRM
                $this->setData(array(
                    'pageMetaTitle'     => Yii::app()->options->get('system.common.site_name') . ' | ' . Yii::t('articles', 'Contact Us'),
                    'pageBreadcrumbs'   => array()
                ));
                $this->setData(array(
                    'pageTitle'     => 'Submit Your Requirements',
                    'pageMetaDescription'   => 'Submit Your Requirements',
                    'metaKeywords'   => 'Submit Your Requirements',
                ));
        
                $this->render("success", compact('model'));
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                // $this->redirect(Yii::app()->createUrl('submited_preq/success'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'   => $notify->hasSuccess,
                'model'   => $model,
            )));

            if ($collection->success) {
            }
        }
        $banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'SB');
        $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
        $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
        if (!empty($banners)) {
            $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
            $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
        }

        $this->getData('pageStyles')->add(array('src' =>   Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.min.css'), 'priority' => -1000));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js'), 'priority' => -1000));

        $this->setData(array(
            'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => $this->tag->getTag('submit_your_property1', 'Submit Your Requirements'), '{p}' => $this->project_name)),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

        ));
        $this->render('req_form', compact('model', 'img', 'img_mobile'));
    }

    public function actionSuccess()
    {

        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->options->get('system.common.site_name') . ' | ' . Yii::t('articles', 'Contact Us'),
            'pageBreadcrumbs'   => array()
        ));
        $this->setData(array(
            'pageTitle'     => 'Submit Your Requirements',
            'pageMetaDescription'   => 'Submit Your Requirements',
            'metaKeywords'   => 'Submit Your Requirements',
        ));

        $this->render("success");
    }


    public function actionLoadCities()
    {
        $id = null;
        if (isset($_REQUEST['area'])) {
            $id = $_REQUEST['area'];
        }
        $data = CHtml::listData(States::model()->getStateWithCountry_3(66124, $id), "state_id", "state_name");
        echo "<option value=''>Select City</option>";
        foreach ($data as $k => $v)
            echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
    }


    /**
     * generate the slug for an article based on the article title
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;

        if (!$request->isAjaxRequest) {
            $this->redirect(array('areaguides/index'));
        }

        $areaguides = new Areaguides();
        $areaguides->areaguides_id = (int)$request->getPost('areaguides_id');
        $areaguides->slug = $request->getPost('string');

        $areaguides->slug = $areaguides->generateSlug();

        return $this->renderJson(array('result' => 'success', 'slug' => $areaguides->slug));
    }
}
