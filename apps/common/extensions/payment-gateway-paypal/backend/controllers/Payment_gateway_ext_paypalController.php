<?php defined('MW_PATH') || exit('No direct script access allowed');

/** 
 * Controller file for gateway settings.
 * 
 * @package MailWizz EMA
 * @subpackage Payment Gateway Paypal
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class Payment_gateway_ext_paypalController extends Controller
{
    // the extension instance
    public $extension;

    // move the view path
    public function getViewPath()
    {
        return Yii::getPathOfAlias('ext-payment-gateway-paypal.backend.views');
    }
    
    /**
     * Default action.
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $model   = $this->extension->getExtModel();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if ($model->validate()) {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $model->save();
            } else {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('ext_payment_gateway_paypal', 'Paypal payment gateway'),
            'pageHeading'       => Yii::t('ext_payment_gateway_paypal', 'Paypal payment gateway'),
            'pageBreadcrumbs'   => array(
                Yii::t('payment_gateways', 'Payment gateways') => $this->createUrl('payment_gateways/index'),
                Yii::t('ext_payment_gateway_paypal', 'Paypal payment gateway'),
            )
        ));

        $this->render('settings', compact('model'));
    }
}