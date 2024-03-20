<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OrdersController
 *
 * Handles the actions for price plans orders related tasks
 *
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.3
 */

class OrdersController extends Controller
{
    public function init()
    {
        $this->onBeforeAction = array($this, '_registerJuiBs');
        parent::init();
    }
    public $show_ordergraph;

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        $filters = array(
            'postOnly + delete, delete_note',
        );

        return CMap::mergeArray($filters, parent::filters());
    }

    /**
     * List all available orders
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new PricePlanOrder('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View orders'),
            'pageHeading'       => Yii::t('orders', 'View orders'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Orders') => $this->createUrl('orders/index'),
                Yii::t('app', 'View all')
            )
        ));
        
        $this->show_ordergraph = '1'; 
        $itemsArray = array();
        $statistics = PricePlanOrder::model()->orderStatistics();
        $ar_items = array(); 
        if(!empty($statistics)){ 
        foreach( $statistics as $k=>$v){
         $ar_items[date('M y',strtotime($v->date_added))] = array('net'=>(int)$v->total_payment,'total'=>(int)$v->total,'discount'=>(int)$v->discount) ; 
        }
        }
        for ($i = 0; $i <= 11; $i++) {
            $months[] = date("M y", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        
        
        foreach($months as $month){
         if(isset($ar_items[$month])){   $itemsArray[$month] = $ar_items[$month];  }else{  $itemsArray[$month] = array('net'=>0,'total'=>0,'discount'=>0) ; } 
        }
      
        $this->render('list', compact('order','itemsArray'));
    }
    public function actionTrash()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new PricePlanOrder('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
        $order->show_trash = 1 ; 

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View trashed  orders'),
            'pageHeading'       => Yii::t('orders', 'View trashed orders'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Orders') => $this->createUrl('orders/index'),
                Yii::t('app', 'Trash View all')
            )
        ));

        $this->render('list_trash', compact('order'));
    }
    public function actionCreated_by_me()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new PricePlanOrder('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
if(empty($order->created_by)){
   
$order->team_manager = (int) Yii::app()->user->getId() ;
if(Yii::app()->user->getModel()->removable=='no'){
    $order->show_all = 1; 
    }
} 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'My Orders'),
            'pageHeading'       => Yii::t('orders', 'My Orders'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'My Orders') => $this->createUrl('orders/created_by_me'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('list', compact('order'));
    }

    /**
     * Create order
     */
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $order   = new PricePlanOrder();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($order->modelName, array()))) {
            $order->attributes = $attributes;
            if (!$order->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $note = new PricePlanOrderNote();
                $note->attributes = (array)$request->getPost($note->modelName, array());
                $note->order_id   = $order->order_id;
                $note->user_id    = Yii::app()->user->getId();
                $note->save();

                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
                if(AccessHelper::hasRouteAccess ('orders/index')){
                $this->redirect(Yii::App()->createUrl('orders/index'));
				}
				else if(AccessHelper::hasRouteAccess ('orders/created_by_me')){
                $this->redirect(Yii::App()->createUrl('orders/created_by_me'));
				 
				}
            }
        }

        $note = new PricePlanOrderNote('search');
        $note->attributes = (array)$request->getQuery($note->modelName, array());
        $note->order_id   = (int)$order->order_id;
 if(AccessHelper::hasRouteAccess ('listingusers/index')){
						$index ='index';
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
						$index ='created_by_me';
				 
				} 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'Create order'),
            'pageHeading'       => Yii::t('orders', 'Create order'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Orders') => $this->createUrl('orders/'.$index),
                Yii::t('app', 'Create'),
            )
        ));

        $this->render('form', compact('order', 'note','index'));
    }

    /**
     * Update existing order
     */
    public function actionUpdate($id)
    {
        $order = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($order->modelName, array()))) {
            $order->attributes = $attributes;
            if (!$order->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $note = new PricePlanOrderNote();
                $note->attributes = (array)$request->getPost($note->modelName, array());
                $note->order_id   = $order->order_id;
                $note->user_id    = Yii::app()->user->getId();
                $note->save();

                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
                 if(AccessHelper::hasRouteAccess ('orders/index')){
                $this->redirect(Yii::App()->createUrl('orders/index'));
				}
				else if(AccessHelper::hasRouteAccess ('orders/created_by_me')){
                $this->redirect(Yii::App()->createUrl('orders/created_by_me'));
				 
				}
            }
        }

        $note = new PricePlanOrderNote('search');
        $note->attributes = (array)$request->getQuery($note->modelName, array());
        $note->order_id   = (int)$order->order_id;
 if(AccessHelper::hasRouteAccess ('listingusers/index')){
						$index ='index';
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
						$index ='created_by_me';
				 
				} 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'Update order'),
            'pageHeading'       => Yii::t('orders', 'Update order'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Orders') => $this->createUrl('orders/'.$index),
                Yii::t('app', 'Update'),
            )
        ));

        $this->render('form', compact('order', 'note','index'));
    }
 public function actionUpdate_status()
    {
	}
    /**
     * View order
     */
    public function actionView($id)
    {
        $request = Yii::app()->request;
        $order   = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $pricePlan = $order->plan;
        
       
        $customer  = $order->customer;

        $note = new PricePlanOrderNote('search');
        $note->unsetAttributes();
        $note->attributes = (array)$request->getQuery($note->modelName, array());
        $note->order_id   = (int)$order->order_id;

       
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View your order'),
            'pageHeading'       => Yii::t('orders', 'View your order'),
            'pageBreadcrumbs'   => array(
               // Yii::t('price_plans', 'Price plans') => $this->createUrl('price_plans/index'),
                Yii::t('orders', 'Orders') => $this->createUrl('orders/index'),
                Yii::t('app', 'View')
            )
        ));

        $this->render('order_detail', compact('order', 'pricePlan', 'customer', 'note', 'transaction'));
    }
    
    public function actionPromo_usage()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new PricePlanOrder('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View promo codes usage'),
            'pageHeading'       => Yii::t('orders', 'View  promo codes usage'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Promo codes usage') => $this->createUrl('orders/promo_usage'),
                Yii::t('app', 'View all')
            )
        ));
        
        $order->promo_allowed = '1'; 
      
        $this->render('list_promo_used', compact('order','itemsArray'));
    }
    /**
     * View order in PDF format
     */
     public static  function htmlHead($uid){
		return '<html><head><title>Invoice - '.$uid.'</title></head><body>';
	}
	public static function bodyClose(){
		return ' </body></html> ';
	}
	const PAPER_WIDTH = '576';
	const PAPER_HEIGHT = '784';
    public function actionPdf($id)
    {
        $request = Yii::app()->request;
        $model   = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        	//$order_uid = base64_decode($order_uid);   
			//$model = PricePlanOrder::model()->findByPk( $order_uid );
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			Yii::import('common.extensions.dompdf.*');
			require_once(Yii::getPathOfAlias('common.extensions').'/dompdf/dompdf_config.inc.php');
			Yii::registerAutoloader('DOMPDF_autoload');
			 $pdf = new DOMPDF();
			$html = self::htmlHead($model->uid);
			$html .= '<link type="text/css" href="https://www.feeta.pk/assets/css/pdf.css?q=4" rel="stylesheet" />';
			$html .=  Yii::app()->controller->renderPartial('root.invoice-4', compact('model','title','view','org','title_right','title_right_number','date','signature','digital_stamp_logo'), true);;
			$html .= self::bodyClose();
			$pdf->load_html($html);
			$customPaper = array(0,0,self::PAPER_WIDTH,self::PAPER_HEIGHT);
			$pdf->set_paper($customPaper);
		 
			// Render the HTML as PDF
			$pdf->render();

			// Output the generated PDF to Browser
			$pdf->stream('paymentinvoice.pdf', array("Attachment" => false) );
			exit;

        $pricePlan = $order->plan;
        $customer  = $order->customer;
        $invoiceOptions = new OptionMonetizationInvoices();

        Yii::import('common.vendors.Invoicr.*');

        $invoice = new Invoicr("A4", 'Rs', null);

        if (!empty($invoiceOptions->logo)) {
            $logoImage = $_SERVER['DOCUMENT_ROOT'] . $invoiceOptions->getLogoUrl();
            if (is_file($logoImage)) {
                $invoice->setLogo($logoImage);
            }
        } elseif (is_file($logoImage = Yii::getPathOfAlias('common.vendors.Invoicr.images.logo') . '.png')) {
            $invoice->setLogo($logoImage);
        }

        $invoice
            ->setColor("#" . $invoiceOptions->color_code)
            ->setType(Yii::t('orders', "Invoice"))
            ->setReference($invoiceOptions->prefix . ($order->order_id < 10 ? '0' . $order->order_id : $order->order_id))
            ->setDate(preg_replace('/\s.*/', '', $order->dateAdded))
            ->setDue(preg_replace('/\s.*/', '', $order->dateAdded))
            ->setFrom(array_map('trim', explode("\n", $order->getHtmlPaymentFrom(null, "\n"))))
            ->setTo(array_map('trim', explode("\n", $order->getHtmlPaymentTo(null, "\n"))))
            ->addItem('Top Up', StringHelper::truncateLength($pricePlan->description, 50), 1, false, $pricePlan->formattedPrice, false, $order->formattedTotal)
             ->addTotal(Yii::t('orders', "Discount"), $order->formattedDiscount)
             ->addTotal(Yii::t('orders', "Total Order Amount"), $order->formattedTotal)
            ->addTotal(Yii::t('orders', "Total Paid Amount") , $order->formattedTotalPaid);
           
        

        

        $invoice->addTotal(Yii::t('orders', "Total"), $order->formattedTotal, true);

        if ($order->getIsComplete()) {
            $invoice->addBadge(Yii::t('orders', "Paid"));
        }

        if (!empty($invoiceOptions->notes)) {
            $invoice->addTitle(Yii::t('orders', 'Extra notes'))->addParagraph($invoiceOptions->notes);
        }

        $invoice->setFooternote(Yii::app()->options->get('system.urls.frontend_absolute_url'));

        //Render
        $invoice->render($order->order_uid . '.pdf','I');
    }

    /**
     * Email the invoice
     */
    public function actionEmail_invoice($id)
    {
        $request = Yii::app()->request;
        $options = Yii::app()->options;
        $notify  = Yii::app()->notify;
        $order   = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $pricePlan = $order->plan;
        $customer  = $order->customer;
        $dsParams  = array();
        
        if (!($deliveryServer = DeliveryServer::pickServer(0, null, $dsParams))) {
            $notify->addWarning(Yii::t('orders', 'Please try again later!'));
            $this->redirect(array('orders/view', 'id' => $id));
        }

        $invoiceOptions = new OptionMonetizationInvoices();
        $emailTemplate  = $options->get('system.email_templates.common');

        if ($emailBody = $invoiceOptions->email_content) {
            $emailBody = nl2br($emailBody);
        } else {
            $emailBody = $this->renderPartial('email/invoice', compact('order', 'invoiceOptions', 'options'), true);
        }
        if (!($emailSubject = $invoiceOptions->email_subject)) {
            $emailSubject = Yii::t('orders', 'Your requested invoice - {ref}', array(
                '{ref}'   => $invoiceFileName = $invoiceOptions->prefix . ($order->order_id < 10 ? '0' . $order->order_id : $order->order_id),
            ));
        }

        $emailTemplate  = str_replace('[CONTENT]', $emailBody, $emailTemplate);

        $storagePath = Yii::getPathOfAlias('root.frontend.assets.files.invoices');
        if ((!file_exists($storagePath) || !is_dir($storagePath)) && !mkdir($storagePath, 0777, true)) {
            $notify->addWarning(Yii::t('orders', 'Unable to create the invoices storage directory!'));
            $this->redirect(array('orders/view', 'id' => $id));
        }
        $invoicePath = $storagePath . '/' . preg_replace('/(\-){2,}/', '-', preg_replace('/[^a-z0-9\-]+/i', '-', $invoiceFileName)) . '.pdf';

        ob_start();
        ob_implicit_flush(false);
        $this->actionPdf($id);
        $pdf = ob_get_clean();

        if (!file_put_contents($invoicePath, $pdf)) {
            $notify->addWarning(Yii::t('orders', 'Unable to create the invoice!'));
            $this->redirect(array('orders/view', 'id' => $id));
        }

        $params = array(
            'to'          => array($customer->email => $customer->fullName),
            'subject'     => $emailSubject,
            'from_name'   => $options->get('system.common.site_name', 'Marketing website'),
            'body'        => $emailTemplate,
            'attachments' => array($invoicePath),
        );

        if ($deliveryServer->sendEmail($params)) {
            $notify->addSuccess(Yii::t('orders', 'The invoice has been successfully emailed!'));
        } else {
            $notify->addError(Yii::t('orders', 'Unable to email the invoice!'));
        }

        unlink($invoicePath);

        $this->redirect(array('orders/view', 'id' => $id));
    }

    /**
     * Delete existing order
     */
    public function actionDelete($id)
    {
        $order = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
	 
	    $order->updateByPk($id,array('status'=> PricePlanOrder::STATUS_TRASHED ,'deleted_by'=>Yii::app()->user->getId(),'deleted_status'=>$order->status));  	
	    $order->calculateTotalBalance($order->customer_id);						
        //$order->delete();

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $redirect = $request->getPost('returnUrl', array('orders/index'));
        }

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }
    public function actionRestore($id)
    {
		$request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->isAjaxRequest) {
            $this->redirect(Yii::app()->createUrl('dashboard/index'));
        }
        
        
        $order = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
	 
	    $order->updateByPk($id,array('status'=> $order->deleted_status ,'deleted_by'=>Yii::app()->user->getId() ));  	
	    $order->calculateTotalBalance($order->customer_id);						
        //$order->delete();

        

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }
    public function actionDelete_permanent($id)
    {
		$request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->isAjaxRequest) {
            $this->redirect(Yii::app()->createUrl('dashboard/index'));
        }
        
        
        $order = PricePlanOrder::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
	 
	    $order->delete();	
	    $order->calculateTotalBalance($order->customer_id);						
        //$order->delete();

        

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }

    /**
     * Delete existing order note
     */
    public function actionDelete_note($id)
    {
        $note = PricePlanOrderNote::model()->findByPk((int)$id);

        if (empty($note)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $note->delete();

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('orders/index')));
        }
    }
     public function actionSummary()
    {
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View account summary'),
            'pageHeading'       => Yii::t('orders', 'View account summary'),
            'pageBreadcrumbs'   => array(
               // Yii::t('price_plans', 'Price plans') => $this->createUrl('price_plans/index'),
                Yii::t('orders', 'Orders') => $this->createUrl('orders/index'),
                Yii::t('app', 'Summary')
            )
        ));
        $request = Yii::app()->request;  
		$from_date = $request->getQuery('from_date','');
		$to_date = $request->getQuery('to_date','');
        if(empty($from_date) and empty($to_date)){
			$to_date = date('d-m-Y');
			$from_date = date('d-m-Y',strtotime($to_datey. ' - 30 days'));
		}
        $orderStatisticsdatewise = PricePlanOrder::model()->orderStatisticsdatewise($from_date,$to_date);
        
		$this->show_ordergraph = '1'; 
        $itemsArray = array();
        $statistics = PricePlanOrder::model()->orderStatistics();
        $ar_items = array(); 
        if(!empty($statistics)){ 
        foreach( $statistics as $k=>$v){
         $ar_items[date('M y',strtotime($v->date_added))] = array('net'=>(int)$v->total_payment,'total'=>(int)$v->total,'discount'=>(int)$v->discount) ; 
        }
        }
        for ($i = 0; $i <= 11; $i++) {
            $months[] = date("M y", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        
        
        foreach($months as $month){
         if(isset($ar_items[$month])){   $itemsArray[$month] = $ar_items[$month];  }else{  $itemsArray[$month] = array('net'=>0,'total'=>0,'discount'=>0) ; } 
        }
        $this->render('summary', compact('itemsArray','from_date','to_date' ,'orderStatisticsdatewise' ));
    }
    public function actionApprove_property($id=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			// return false;
		}
        $user = PricePlanOrder::model()->findByPk((int)$id);
 
			$user->sendExpirNotification();
		 
        $user::model()->updateByPk($id,array('last_send'=>date('Y-m-d')));
        echo json_encode(array('status'=>'1')); exit;
    }
    /**
     * Callback to register Jquery ui bootstrap only for certain actions
     */
    public function _registerJuiBs($event)
    {
        if (in_array($event->params['action']->id, array('create', 'update','summary','index','promo_usage','created_by_me'))) {
            $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));
        }
    }
    public function actionNotification_orders() 
    {
		 
	 
		$notification_orders = PricePlanOrder::model()->notification_to_send();
	    print_r(sizeOf($notification_orders));exit;
		 if(!empty($notification_orders)){

			foreach($notification_orders as $k=>$v){ 
				 
				$v->sendExpirNotification();
				 $v->updateByPk($v->order_id,array('last_send'=>date('Y-m-d')));
			}

		}
			  
    }
}
