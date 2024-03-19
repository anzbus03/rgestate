<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * PaypalPaymentHandler
 * 
 * @package MailWizz EMA
 * @subpackage Payment Gateway Paypal
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class PaypalPaymentHandler extends PaymentHandlerAbstract
{
    // render the payment form
    public function renderPaymentView()
    {
        $order = $this->controller->getData('order');
        $currency = $this->controller->getData('currency');
       
        $model = $this->extension->getExtModel();
      
		if($this->extension->isAppName('frontend'))
		{
			$cancelUrl = Yii::app()->createAbsoluteUrl('package/index');
			$returnUrl = Yii::app()->createAbsoluteUrl('package/index');
			$dataUrl = 'payment/order';
			
		}
		else
		{
			$cancelUrl = Yii::app()->createAbsoluteUrl('price_plans_test/index');
			$returnUrl = Yii::app()->createAbsoluteUrl('price_plans_test/index');
			$dataUrl = 'price_plans_test/order';
		}
        
        $notifyUrl = Yii::app()->getRequest()->getHostInfo().'/index.php/payment_gateway_ext_paypal_customer/ipn';
        
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->extension->getPathAlias()) . '/assets/customer', false, -1, MW_DEBUG);
        Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/payment-form.js');
        
        $customVars = sha1(StringHelper::uniqid());
        $view       = $this->extension->getPathAlias() . '.customer.views.payment-form';
        
        $this->controller->renderPartial($view, compact('model', 'currency', 'order', 'cancelUrl', 'returnUrl', 'notifyUrl', 'customVars','dataUrl'));
    }
    
    // mark the order as pending retry
    public function processOrder()
    {
        $request = Yii::app()->request;
        
        if (strlen($request->getPost('custom')) != 40) {
            return false;
        }
        
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        
        $order->status = PricePlanOrder::STATUS_PENDING;
        $order->save(false);
        
        $transaction->payment_gateway_name = 'Paypal - www.paypal.com';
        $transaction->payment_gateway_transaction_id = $request->getPost('custom');
        $transaction->status = PricePlanOrderTransaction::STATUS_PENDING_RETRY;
        $transaction->save(false);
  
        $message = Yii::t('payment_gateway_ext_paypal', 'Your order is in "{status}" status, it usually takes a few minutes to be processed and if everything is fine, your pricing plan will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
        
        if ($request->isAjaxRequest) {
            return $this->controller->renderJson(array(
                'result'  => 'success', 
                'message' => $message,
            ));
        }
        
        Yii::app()->notify->addInfo($message);
        $this->controller->redirect(array('price_plans/index'));
    }
    public function renderFeaturePaymentView()
    {
        $order = $this->controller->getData('order');
        $currency = $this->controller->getData('currency');
        $ad_model = $this->controller->getData('ad_model');
       
        $model = $this->extension->getExtModel();
      
	 
		$cancelUrl = Yii::app()->createAbsoluteUrl('member/promote',array('slug'=>$ad_model->slug));
		$returnUrl = Yii::app()->createAbsoluteUrl('price_plans/orders');
		$dataUrl = 'payment_feature/order';
			
		 
        $notifyUrl = Yii::app()->getRequest()->getHostInfo().'/index.php/payment_gateway_ext_paypal_customer/ipnnew';
        
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->extension->getPathAlias()) . '/assets/customer', false, -1, MW_DEBUG);
        Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/payment-form.js');
        
        $customVars = sha1(StringHelper::uniqid());
        $view       = $this->extension->getPathAlias() . '.customer.views.payment-form';
        
        $this->controller->renderPartial($view, compact('model', 'currency', 'order', 'cancelUrl', 'returnUrl', 'notifyUrl', 'customVars','dataUrl'));
    }
     public function featureprocessOrder()
    {
        $request = Yii::app()->request;
        
        if (strlen($request->getPost('custom')) != 40) {
            return false;
        }
        
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        
        $order->status = FeaturePlanOrder::STATUS_PENDING;
        $order->save(false);
        
        $transaction->payment_gateway_name = 'Paypal - www.paypal.com';
        $transaction->payment_gateway_transaction_id = $request->getPost('custom');
        $transaction->status = FeaturePlanOrderTransaction::STATUS_PENDING_RETRY;
        $transaction->save(false);
  
        $message = Yii::t('payment_gateway_ext_paypal', 'Your order is in "{status}" status, it usually takes a few minutes to be processed and if everything is fine, your feature plan will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
        
        if ($request->isAjaxRequest) {
            return $this->controller->renderJson(array(
                'result'  => 'success', 
                'message' => $message,
            ));
        }
        
        Yii::app()->notify->addInfo($message);
        $this->controller->redirect(array('user/my_ads'));
    }
    
    
    public function renderDesignPaymentView()
    {
        $order = $this->controller->getData('order');
        $currency = $this->controller->getData('currency');
        $ad = $this->controller->getData('ad');
        
        
        $model = $this->extension->getExtModel();
		$cancelUrl =	$ad->PaymentReturnUrl;
		$returnUrl = 	$ad->PaymentReturnUrl;
		$dataUrl   = 	$ad->PaymentDataUrl2;
			
		 
        $notifyUrl = Yii::app()->getRequest()->getHostInfo().'/index.php/payment_gateway_ext_paypal_customer/ipnnew';
        
        $assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias($this->extension->getPathAlias()) . '/assets/customer', false, -1, MW_DEBUG);
        Yii::app()->clientScript->registerScriptFile($assetsUrl . '/js/payment-form.js');
        
        $customVars = sha1(StringHelper::uniqid());
        $view       = $this->extension->getPathAlias() . '.customer.views.payment-form';
        
        $this->controller->renderPartial($view, compact('model', 'currency', 'order', 'cancelUrl', 'returnUrl', 'notifyUrl', 'customVars','dataUrl'));
    }
    
    
    public function designprocessOrder()
    {
        $request = Yii::app()->request;
        
        if (strlen($request->getPost('custom')) != 40) {
            return false;
        }
        
        $transaction = $this->controller->getData('transaction');
        $order       = $this->controller->getData('order');
        
        $order->status = FeaturePlanOrder::STATUS_PENDING;
        $order->save(false);
        
        $transaction->payment_gateway_name = 'Paypal - www.paypal.com';
        $transaction->payment_gateway_transaction_id = $request->getPost('custom');
        $transaction->status = FeaturePlanOrderTransaction::STATUS_PENDING_RETRY;
        $transaction->save(false);
  
        $message = Yii::t('payment_gateway_ext_paypal', 'Your order is in "{status}" status, it usually takes a few minutes to be processed and if everything is fine, your feature plan will become active!', array(
            '{status}' => Yii::t('orders', $order->status),
        ));
        
        if ($request->isAjaxRequest) {
            return $this->controller->renderJson(array(
                'result'  => 'success', 
                'message' => $message,
            ));
        }
        
        Yii::app()->notify->addInfo($message);
       $this->controller->redirect( $ad->DetailDesignUrl );
    }
    
}
