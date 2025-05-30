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
 
class EnquiryController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "All Enquiries";
     public $focus = "";
     public function init()
    {
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
		Yii::$classMap = array_merge( Yii::$classMap, array(
		'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
		'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
		));
        parent::init();
       
        
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
    
        // Initialize filters
        $startDate = $request->getQuery('startDate', null);
        $endDate = $request->getQuery('endDate', null);
        $sectionId = $request->getQuery('section_id', null);
    
        // Build SQL query
        $sql = "SELECT t.*, ads.ad_title, ads.slug AS ad_slug 
                FROM {{contact_us}} t
                INNER JOIN {{place_an_ad}} ads ON ads.id = t.ad_id AND ads.isTrash = '0'
                LEFT JOIN {{listing_users}} usr2 ON usr2.user_id = ads.user_id
                WHERE t.contact_type = 'ENQUIRY'";
    
        // Apply filters
        $params = array();
        if ($startDate && $endDate) {
            $sql .= " AND t.date >= :startDate AND t.date <= :endDate";
            $params[':startDate'] = $startDate;
            $params[':endDate'] = $endDate;
        }
        if ($sectionId) {
            $sql .= " AND ads.section_id = :sectionId";
            $params[':sectionId'] = $sectionId;
        }
    
        // Order by ID descending
        $sql .= " ORDER BY t.id DESC";
       
        // Execute query
        $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
    
        $this->setData(array(
            'pageMetaTitle'   => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'     => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs' => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all'),
            ),
        ));
    
        $this->render('list', compact('data'));
    }
    
    // public function actionIndex()
    // {
    //     $criteria = new CDbCriteria();
    //     $criteria->compare('contact_type', 'ENQUIRY');
    //     $criteria->order = 'id DESC';
    //     $criteria->with = array(
    //         'ads' => array('condition' => 'ads.isTrash = "0"'),
    //     );

    //     $data = SendEnquiry::model()->findAll($criteria);

    //     $this->setData(array(
    //         'pageMetaTitle'   => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
    //         'pageHeading'     => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
    //         'pageBreadcrumbs' => array(
    //             Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
    //             Yii::t('app', 'View all'),
    //         ),
    //     ));

    //     $this->render('list', compact('data'));
    // }

    public function actionUpdateTable($section_id) {
        $model = new SendEnquiry('search');
        if (isset($_GET['section_id'])) {
            $model->section_id = $_GET['section_id'];
        }
    
        $dataProvider = $model->search();
        $data = $dataProvider->getData();
    
        $this->renderPartial('_tableRows', array('data' => $data));
    }
    
    public function actionExportExcel() {
        try{
            
            $model = new SendEnquiry('search');
            $model->unsetAttributes();  // clear any default values
        
            $dataProvider = $model->search();
            $dataProvider->pagination = false; // Get all data
        
            // Prepare data for export
            $data = $dataProvider->getData();
        
            // Set headers to force download
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ExportedData_' . date('YmdHis') . '.xls"');
            header('Cache-Control: max-age=0');
        
            // Open output stream
            $output = fopen('php://output', 'w');
        
            // Write column headers
            $header = array('Full Name', 'Email', 'Phone', 'Date', 'AD', 'IP Address');
            fputcsv($output, $header, "\t");
        
            // Write data rows
            foreach ($data as $item) {
                $row = array(
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->date,
                    $item->ad_title,
                    $item->ip_address
                );
                fputcsv($output, $row, "\t");
            }
        
            // Close output stream
            fclose($output);
        
            Yii::app()->end();
        }catch (Exception $e){
            print_r($e->getMessage());
            exit;
        }
    }
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = SendEnquiry::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->deleteByPk($id);    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
       public function actionBulk_action()
    {
		
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        
        if ($action == SendEnquiry::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new  SendEnquiry();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				 
                $customer->delete();;  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
         
        $defaultReturn = $request->getServer('HTTP_REFERER', array('enquiry/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
     public function actionUpdate($id)
    {
		 
        $model = SendEnquiry::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
         	$model->updateByPk($model->primaryKey,array('is_read'=>'1'));
        $this->renderPartial('form', compact('model'));
    }
    
   
    
}
