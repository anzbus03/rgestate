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
 
class Contact_usController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Contact Us";
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
         $notify = Yii::app()->notify;
         $model = new ContactUs('serach');
       
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $model->startDate = $_GET['startDate'];
            $model->endDate = $_GET['endDate'];
        }
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
        $this->render('list', compact('model'));
    }
    /*
        * Export to excel functionality
    */
    public function actionExportExcel() {
        try{
            
            $model = new ContactUs('search');
            $model->unsetAttributes();  // clear any default values
        
            if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
                $model->startDate = $_GET['startDate'];
                $model->endDate = $_GET['endDate'];
            }
        
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
            $header = array('Name', 'Email', 'Phone', 'Date', 'Message Text');
            fputcsv($output, $header, "\t");
        
            // Write data rows
            foreach ($data as $item) {
                $row = array(
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->date,
                    $item->meassage
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
        $model = ContactUs::model()->findByPk((int)$id);
        
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
     public function actionUpdate($id)
    {
		 
        $model = ContactUs::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
  $model->updateByPk($model->primaryKey,array('is_read'=>'1'));
       
        
       
        
        $this->renderPartial('form', compact('model'));
    }
    
     public function actionView($id)
    {
		
	 
		$model = ContactUs::model()->findByPk($id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        
      
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} ID-".$model->primaryKey),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
       
        
        $this->render('form', compact('model','note','note2'));
    }
    
      public function actionBulk_action()
    {
		
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        
        if ($action == ContactUs::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new  ContactUs();
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
}
