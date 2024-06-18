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
 
class Adv_interestController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Advertisement interest";
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
         $model = new AdvInterest('serach');
       
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
    
     public function actionView($id)
    {
		
		$criteria=new CDbCriteria;
		$criteria->select = 't.*,bp.position_name';
		$criteria->compare('id',(int) $id);

		$criteria->compare('contact_type','AD');
		$criteria->join = ' LEFT JOIN {{banner_position}}  bp on bp.position_id = t.position_id ' ;


		$model = AdvertisementContact::model()->find($criteria);

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
    public function actionExportExcel() {
        try{
            
            $model = new AdvertisementContact('search');
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
            $header = array('How can we help?', 'Name', 'Email', 'Phone', 'Date');
            fputcsv($output, $header, "\t");
        
            // Write data rows
            foreach ($data as $item) {
                $row = array(
                    "Submit your listings on RGEstate for free",
                    $item->name,
                    $item->email,
                    $item->phone,
                    $item->date,
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
		 
        $model = AdvertisementContact::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
  
        
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        
        $this->renderPartial('form', compact('model'));
    }
    
   
    
}
