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
 
class Property_valuationController  extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Property Valuation";
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
         $model = new PropertyValuation('serach');
       
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
         $condition =  PropertyValuation::model()->search(1);
        $total_application =  PropertyValuation::model()->count($condition);
         
        $model2 = new PropertyValuation();$model2->statusm = 'A';
        $totla_acceptedCriteria =  $model2->search(1);
        $total_accepted_application =  PropertyValuation::model()->count($totla_acceptedCriteria);
         
        
        $model2 = new PropertyValuation();$model2->statusm = 'R';
        $total_rejectedCriteria =  $model2->search(1);
        $total_rejected =  PropertyValuation::model()->count($total_rejectedCriteria);
         
         
          
         
         
        $this->render('list', compact('model','total_application','total_accepted_application','total_rejected'));
    }
    
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = PropertyValuation::model()->findByPk((int)$id);
        
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
		 
        $model = PropertyValuation::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
		 
        
       
        
        $this->renderPartial('form', compact('model'));
    }
    public function actionView($id)
    {
		 
        $model = PropertyValuation::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        $note = new ValuationFollowup();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($note->modelName, array()))) {
            $note->attributes = $attributes;
             $note->form_id   = $model->primaryKey;
            if (!$note->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
              

                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
                 $this->redirect($this->refresh());
				 
            }
        }
        
        $note2 = new ValuationFollowup('search');
        $note2->attributes = (array)$request->getQuery($note2->modelName, array());
        $note2->form_id   = (int)$model->primaryKey;
		 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} ID-".$model->primaryKey),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
       
        
        $this->render('view_more', compact('model','note','note2'));
    }
     public function actionViewwer($id)
    {
		 
        $model = PropertyValuation::model()->findByPk((int)$id);

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
       
        
        $this->render('form', compact('model'));
    }
    
   
      public function actionBulk_action()
    {
		
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        
        if ($action == PropertyValuation::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new  PropertyValuation();
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
         
        $defaultReturn = $request->getServer('HTTP_REFERER', array('property_valuation/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
     public function  actionAll_company_application(){
	}
	public function actionDelete_followup($id)
    {
        $note = ValuationFollowup::model()->findByPk((int)$id);

        if (empty($note)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $note->delete();

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('dashboard/index')));
        }
    }
    public function actionExport($datepicker=null,$status_m=null){
		$neModel = new  PropertyValuation();
		if(!empty($status_m)){
			$neModel->statusm = $status_m;
		}
		$criteria=   $neModel->search(1);
		$site_name =  Yii::app()->options->get('system.common.site_name'); 
			
		if(!empty($datepicker)){
			$timeZone =  Yii::App()->user->getModel()->timezone; 
			if(empty($timeZone)) { $timeZone = 'Asia/Dubai' ;}
		$datepicker = $this->converToTzFn(date('Y-m-d 00:00:00',strtotime($datepicker)),$timeZone,'UTC','Y-m-d h:i:s') ;
		$criteria->condition .= ' and date_added >= :dateadded ' ; 
		$criteria->params[':dateadded'] = $datepicker;
		}
		$criteria->order = 't.f_name asc ' ; 
		$total_result = $neModel->findAll($criteria);
		if(empty($total_result)){
		       throw new CHttpException(404, Yii::t('app', 'No result found to export.'));
      
	  }
Yii::import('common.extensions.excel.Classes.PHPExcel');
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator($site_name)
							 ->setLastModifiedBy($site_name)
							 ->setTitle("Office 2007 XLSX Agents Data")
							 ->setSubject("Office 2007 XLSX Agents Data")
							 ->setDescription("Pakistan Agents Data.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Home Insurance Data file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Reference No.");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Date");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Name");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "Email");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "Phone");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "Address");
//$objPHPExcel->getActiveSheet()->setCellValue('G1', "Map");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "Bank");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "Status");
$objPHPExcel->getActiveSheet()->setCellValue('I1', $neModel->getAttributeLabel('o_status'));
$objPHPExcel->getActiveSheet()->setCellValue('J1', $neModel->getAttributeLabel('property_type'));
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Property URL');
$objPHPExcel->getActiveSheet()->setCellValue('L1', "Map");
//$objPHPExcel->getActiveSheet()->setCellValue('D1', "Fax");
//$objPHPExcel->getActiveSheet()->setCellValue('E1', "Is Client ?");

// Miscellaneous glyphs, UTF-8
$i= 2; 
 foreach($total_result as $res){
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $res->reference)
	                              ->setCellValue('B' . $i,  date('d-m-Y',strtotime(@$res->dateAdded)))
	                              ->setCellValue('C' . $i,  $res->f_name)
	                               ->setCellValue('D' . $i,  $res->email) 
	                               ->setCellValue('E' . $i,  $res->phone)
	                               ->setCellValue('F' . $i,  $res->address)
	                               ->setCellValue('G' . $i, $res->bank->bank_name)
	                               ->setCellValue('H' . $i, $res->statusTitle)
	                               ->setCellValue('I' . $i, @$res->o_statusTitle )
	                               ->setCellValue('J' . $i, @$res->propertyTitle )
	                               ->setCellValue('K' . $i, !empty($res->property_id) ? @$res->property->DetailUrlAbsolute : '')
	                               ->setCellValue('L' . $i,  'https://www.google.com/maps/?q='.$res->location_latitude.','.$res->location_longitude);
	                              $i++;
	                              /*
	                              ->setCellValue('C' . $i, "PhoneNo $i")
	                              ->setCellValue('D' . $i, "FaxNo $i")
	                              ->setCellValue('E' . $i, true);
	                              * */
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('data');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="propertyvaluation-data-'.date('Ymdhis').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 
	 }
}
