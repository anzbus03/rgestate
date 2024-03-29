<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ListControllerCallbacksBehavior
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class ListControllerCallbacksBehavior extends CBehavior
{
    // event handlers.
    public function _orderFields(CEvent $event) 
    {
        $fields = array();
        $sort   = array();
        
        foreach ($event->params['fields'] as $type => $_fields) {
            foreach ($_fields as $index => $field) {
                if (!isset($field['sort_order'], $field['field_html'])) {
                    unset($event->params['fields'][$type][$index]);
                    continue;
                }
                $fields[] = $field;
                $sort[] = (int)$field['sort_order'];    
            }
        }
        
        array_multisort($sort, $fields);
        
        return $event->params['fields'] = $fields;
    }
    
    public function _addUnsubscribeEmailValidationRules($event)
    {
        // get the refrence
        $rules = $event->params['rules'];
        // clear all of them
        $rules->clear();
        // add the email rules
        $rules->add(array('email', 'required'));
        $rules->add(array('email', 'email'));
    }
    
    public function _unsubscribeAfterValidate($event)
    {
        $ownerData  = $this->owner->data;
        $list       = $ownerData->list;
        
        $subscriber = ListSubscriber::model()->findByAttributes(array(
            'list_id'   => $list->list_id,
            'email'     => $event->sender->email,
            'status'    => ListSubscriber::STATUS_CONFIRMED
        ));
        
        if (empty($subscriber)) {
            $event->sender->addError('email', Yii::t('lists', 'The specified email address does not exist in the list!'));
        }
        
        if ($event->sender->hasErrors()) {
            return;
        }
        
        $unsubscribeUrl = $this->owner->createAbsoluteUrl('lists/unsubscribe_confirm', array(
            'list_uid'          => $list->list_uid, 
            'subscriber_uid'    => $subscriber->subscriber_uid
        ));
        
        if (!empty($ownerData->_campaign)) {
            $unsubscribeUrl = $this->owner->createAbsoluteUrl('lists/unsubscribe_confirm', array(
                'list_uid'          => $list->list_uid, 
                'subscriber_uid'    => $subscriber->subscriber_uid,
                'campaign_uid'      => $ownerData->_campaign->campaign_uid
            ));
        }
        
        if ($list->opt_out == Lists::OPT_OUT_SINGLE) {
            $this->owner->redirect($unsubscribeUrl);
        }
        
        if (!($server = DeliveryServer::pickServer(0, $list))) {
            return;
        }

        $pageType = ListPageType::model()->findBySlug('unsubscribe-confirm-email');
        
        if (empty($pageType)) {
            return;
        }
        
        $page = ListPage::model()->findByAttributes(array(
            'list_id' => $list->list_id, 
            'type_id' => $pageType->type_id
        ));
        
        $content = !empty($page->content) ? $page->content : $pageType->content;
        $options = Yii::app()->options;
        
        $searchReplace = array(
            '[LIST_NAME]'       => $list->name,
            '[COMPANY_NAME]'    => !empty($list->company) ? $list->company->name : null,
            '[UNSUBSCRIBE_URL]' => $unsubscribeUrl,
            '[CURRENT_YEAR]'    => date('Y'),
        );
        
        $content = str_replace(array_keys($searchReplace), array_values($searchReplace), $content);

        $params = array(
            'to'        => $subscriber->email,
            'from'      => array($server->getFromEmail() => $list->default->from_name),
            'subject'   => Yii::t('list_subscribers', 'Please confirm your unsubscription'),
            'body'      => $content,
        );
        
        for ($i = 0; $i < 3; ++$i) {
            if ($server->setDeliveryFor(DeliveryServer::DELIVERY_FOR_LIST)->setDeliveryObject($list)->sendEmail($params)) {
                break;
            }
            $server = DeliveryServer::pickServer($server->server_id, $list);    
        }
        
        Yii::app()->notify->addSuccess(Yii::t('list_subscribers', 'Please check your email and click on the provided unsubscribe link.'));
        $this->owner->redirect(array('lists/unsubscribe', 'list_uid' => $list->list_uid));
    }
    
    public function _sendSubscribeConfirmationEmail(CEvent $event)
    {
        if (!($server = DeliveryServer::pickServer(0, $event->params['list']))) {
            throw new Exception(Yii::t('app', 'Email delivery is disabled at the moment, please try again later!'));
        }
        
        $subscriber = $event->params['subscriber'];
        $list = $event->params['list'];
        $pageType = ListPageType::model()->findBySlug('subscribe-confirm-email');
        
        if (empty($pageType)) {
            throw new Exception(Yii::t('app', 'Temporary error, please try again later!'));
        }
        
        $page = ListPage::model()->findByAttributes(array(
            'list_id' => $list->list_id, 
            'type_id' => $pageType->type_id
        ));
        
        $content = !empty($page->content) ? $page->content : $pageType->content;
        $options = Yii::app()->options;
        
        $searchReplace = array(
            '[LIST_NAME]'       => $list->name,
            '[COMPANY_NAME]'    => !empty($list->company) ? $list->company->name : null,
            '[SUBSCRIBE_URL]'   => $this->owner->createAbsoluteUrl('lists/subscribe_confirm', array('list_uid' => $list->list_uid, 'subscriber_uid' => $subscriber->subscriber_uid)),
            '[CURRENT_YEAR]'    => date('Y'),
        );
        
        $content = str_replace(array_keys($searchReplace), array_values($searchReplace), $content);

        $params = array(
            'to'        => $subscriber->email,
            'from'      => array($server->getFromEmail() => $list->default->from_name),
            'subject'   => Yii::t('list_subscribers', 'Please confirm your subscription'),
            'body'      => $content,
        );
        
        $sent = false;
        for ($i = 0; $i < 3; ++$i) {
            if ($sent = $server->setDeliveryFor(DeliveryServer::DELIVERY_FOR_LIST)->setDeliveryObject($list)->sendEmail($params)) {
                break;
            }
            $server = DeliveryServer::pickServer($server->server_id, $list);    
        }
        
        if (!$sent) {
            throw new Exception(Yii::t('app', 'Email delivery is disabled at the moment, please try again later!'));
        }
    }
    
    public function _profileUpdatedSuccessfully(CEvent $event)
    {
        // mark action log
        if (Yii::app()->options->get('system.customer.action_logging_enabled', true)) {
            $list = $event->params['list'];
            $subscriber = $event->params['subscriber'];
            
            $customer = $list->customer;
            $customer->attachBehavior('logAction', array(
                'class' => 'customer.components.behaviors.CustomerActionLogBehavior'
            ));
            $customer->logAction->subscriberUpdated($subscriber);
        }
        
        Yii::app()->notify->addSuccess(Yii::t('app', 'Your profile has been successfully updated!'));
    }
    
    public function _collectAndShowErrorMessages(CEvent $event)
    {
        $instances = isset($event->params['instances']) ? (array)$event->params['instances'] : array();
        
        // collect and show visible errors.
        foreach ($instances as $instance) {
            if (empty($instance->errors)) {
                continue;
            }
            foreach ($instance->errors as $error) {
                if (empty($error['show']) || empty($error['message'])) {
                    continue;
                }
                Yii::app()->notify->addError($error['message']);
            }
        }
    }
    
    // events
    public function onSubscriberFieldsSorting(CEvent $event)
    {
        $this->raiseEvent('onSubscriberFieldsSorting', $event);
    }
    
    public function onSubscriberSave(CEvent $event)
    {
        $this->raiseEvent('onSubscriberSave', $event);
    }
    
    public function onSubscriberFieldsDisplay(CEvent $event)
    {
        $this->raiseEvent('onSubscriberFieldsDisplay', $event);
    }

    public function onSubscriberSaveSuccess(CEvent $event)
    {
        $this->raiseEvent('onSubscriberSaveSuccess', $event);
    }
    
    public function onSubscriberSaveError(CEvent $event)
    {
        $this->raiseEvent('onSubscriberSaveError', $event);
    }
}