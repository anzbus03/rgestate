<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OfflinePaymentHandler
 * 
 * @package MailWizz EMA
 * @subpackage Payment Gateway Stripe
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class OfflinePaymentHandler extends PaymentHandlerAbstract
{
    // render the payment form
    public function renderPaymentView()
    {
        $model = $this->extension->getExtModel();
        $view  = $this->extension->getPathAlias() . '.customer.views.payment-form';
        
        if($this->extension->isAppName('frontend'))
		{
			 
			$dataUrl = 'payment/order';
			
		}
		else
		{
			 
			$dataUrl = 'price_plans_test/order';
		}
		$this->controller->renderPartial($view, compact('model','dataUrl'));
    }
    public function renderDesignPaymentView()
    {
        $model = $this->extension->getExtModel();
        $view  = $this->extension->getPathAlias() . '.customer.views.payment-form2';
        $ad = $this->controller->getData('ad');
        $dataUrl   = 	$ad->PaymentDataUrl;
		$this->controller->renderPartial($view, compact('model','dataUrl'));
    }
     public function designprocessOrder()
    {
        $request     = Yii::app()->request;
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        $ad          = $this->controller->getData('ad');
        $notify      = Yii::app()->notify;
        $order->status = FeaturePlanOrder ::STATUS_DUE;
        $order->save(false);
        $transaction->payment_gateway_name = Yii::t('payment_gateway_ext_offline', 'Offline payment');
        $transaction->payment_gateway_transaction_id = StringHelper::random(40);
        $transaction->status = FeaturePlanOrderTransaction::STATUS_SUCCESS;
        $transaction->save(false);

        $message = Yii::t('payment_gateway_ext_offline', 'Your order is in "{status}" status, once it gets approved, your contest will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
       
        Yii::app()->notify->addInfo($message);
		$this->controller->redirect( $ad->DetailDesignUrl );
    }
    public function renderFeaturePaymentView()
    {
        $model = $this->extension->getExtModel();
        $view  = $this->extension->getPathAlias() . '.customer.views.payment-form';
        $dataUrl = 'payment_feature/order';
		$this->controller->renderPartial($view, compact('model','dataUrl'));
    }
    
    // validate the data and process the order
    public function processOrder()
    {
        $request     = Yii::app()->request;
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        $notify      = Yii::app()->notify;
        
        $order->status = PricePlanOrder::STATUS_DUE;
        $order->save(false);
        
        $transaction->payment_gateway_name = Yii::t('payment_gateway_ext_offline', 'Offline payment');
        $transaction->payment_gateway_transaction_id = StringHelper::random(40);
        $transaction->status = PricePlanOrderTransaction::STATUS_SUCCESS;
        $transaction->save(false);

        $message = Yii::t('payment_gateway_ext_offline', 'Your order is in "{status}" status, once it gets approved, your pricing plan will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
       
        if($this->extension->isAppName('frontend'))
		{
			  Yii::app()->notify->addInfo($message);
			  //Yii::app()->user->setFlash('success',$message);
			  $this->controller->redirect(Yii::app()->createUrl('package'));
			
		}
		else
		{
			   Yii::app()->notify->addInfo($message);
			   $this->controller->redirect(Yii::app()->createUrl('price_plans_test/index'));
			  // $this->controller->redirect(array($redirectUrl));
			 
		}
        
        // the order is not complete, so return false
      
    }
    public function featureprocessOrder()
    {
        $request     = Yii::app()->request;
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        $notify      = Yii::app()->notify;
        
        $order->status = FeaturePlanOrder ::STATUS_DUE;
        $order->save(false);
        
        $transaction->payment_gateway_name = Yii::t('payment_gateway_ext_offline', 'Offline payment');
        $transaction->payment_gateway_transaction_id = StringHelper::random(40);
        $transaction->status = FeaturePlanOrderTransaction::STATUS_SUCCESS;
        $transaction->save(false);

        $message = Yii::t('payment_gateway_ext_offline', 'Your order is in "{status}" status, once it gets approved, your feature plan will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
       
        Yii::app()->notify->addInfo($message);
		$this->controller->redirect(Yii::app()->createUrl('member/dashboard'));
			
		 
		 
        
        // the order is not complete, so return false
      
    }
}
