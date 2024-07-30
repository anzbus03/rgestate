<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * SettingsController
 * 
 * Handles the settings for the application
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class SettingsController extends Controller
{
    public function init()
    {
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('settings.js')));
        parent::init();
    }
    
    /**
     * Handle the common settings page
     */
    public function actionIndex($view='common')
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $commonModel = new OptionCommon();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($commonModel->modelName, array()))) {
            $commonModel->attributes = $attributes;
            
            $uploadedFile = CUploadedFile::getInstance($commonModel, 'fav_ico');
            $uploadedLogo = CUploadedFile::getInstance($commonModel, 'logo');
            $customer_support_image = CUploadedFile::getInstance($commonModel, 'customer_support_image');
            $upload_property_image = CUploadedFile::getInstance($commonModel, 'upload_property_image');
            
            if(!empty($customer_support_image))
            {
            $fileName3 =   $customer_support_image ;
            $commonModel->customer_support_image = $fileName3;     
            $path =  Yii::app()->basePath . '/../../uploads/';
			$customer_support_image->saveAs($path.'/'.$fileName3);    
			}
			if(!empty( $upload_property_image))
            {
               
            $fileName4 =   $upload_property_image ;
            $commonModel->upload_property_image = $fileName4;     
            $path =  Yii::app()->basePath . '/../../uploads/';
			$upload_property_image->saveAs($path.'/'.$fileName4);    
			}
			
			
            if( $uploadedFile)
            {
            $fileName =   $uploadedFile ;
            $commonModel->fav_ico = $fileName;     
            $path =  Yii::app()->basePath . '/../../uploads/';
			$uploadedFile->saveAs($path.'/'.$fileName);    
			}
            if($uploadedLogo)
            {
            $fileName =   $uploadedLogo ;
            $commonModel->logo = $fileName;  
            $path =  Yii::app()->basePath . '/../../uploads/logo/';
			$uploadedLogo->saveAs($path.'/'.$fileName);    
			}
             
			$commonModel->commercial_categories =  $request->getPost('commercial_categories') ; 
			$commonModel->residential_categories =  $request->getPost('residential_categories') ; 
				  
            //$commonModel->document_file_mime_type = $request->getPost('document_file_mime_type');
           
            if (!$commonModel->save()) {//	print_r($commonModel->getErrors());exit;
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
			
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
          
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'commonModel'   => $commonModel,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Common settings')
            )
        ));
        
        $this->render('index', compact('commonModel','view'));
    }
        public function actionPage_titles()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $commonModel = new OptionPageTitles();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($commonModel->modelName, array()))) {
            $commonModel->attributes = $attributes;
            if (!$commonModel->save()) {//	print_r($commonModel->getErrors());exit;
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
			
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
          
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'commonModel'   => $commonModel,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/page_titles'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Message Settings'), 
            'pageHeading'       => Yii::t('settings', 'Message  Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Page  Heading')
            )
        ));
        
        $this->render('page_titles', compact('commonModel'));
    }
    public function actionMenu_management()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
            // Handle Save Request
            $postData = $request->getPost('menus', array());
            
            // First, delete all existing menu items
            Menu::model()->deleteAll();

            // Array to track menu IDs that were found in the request
            $existingMenuIds = [];

            foreach ($postData as $menuData) {
                // Create a new menu item
                $menu = new Menu();
                $menu->name = $menuData['name'];
                $menu->url = $menuData['url'];
                $menu->parent_id = null; // Root menu items have no parent
                
                if (!$menu->save()) {
                    throw new CHttpException(400, Yii::t('app', 'Failed to save menu item.'));
                }
                
                // Store the newly created menu ID
                $menuMap[$menuData['name']] = $menu->id;
                
                // Handle submenus
                foreach ($menuData['submenus'] as $submenuData) {
                    $submenu = new Menu();
                    $submenu->name = $submenuData['name'];
                    $submenu->url = $submenuData['url'];
                    $submenu->parent_id = $menu->id; // Set parent_id to the current menu item ID

                    if (!$submenu->save()) {
                        throw new CHttpException(400, Yii::t('app', 'Failed to save submenu item.'));
                    }
                }
            }

            $notify->addSuccess(Yii::t('app', 'Menu items have been successfully saved!'));

        } else {
            // Handle List Request
            $menuItems = Menu::model()->findAll();
    
            // Render the view with menu items
            $this->render('menu_management', array('commonModel' => new Menu, 'menuItems' => $menuItems));
        }
    }

    /**
     * Handle the settings for importer/exporter
     */
     /*
    public function actionImport_export()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        $importModel = new OptionImporter();
        $exportModel = new OptionExporter();
        
        if ($request->isPostRequest) {
            $importModel->attributes = (array)$request->getPost($importModel->modelName, array());
            $exportModel->attributes = (array)$request->getPost($exportModel->modelName, array());
            
            if (!$importModel->save() || !$exportModel->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'   => $this,
                'success'      => $notify->hasSuccess,
                'importModel'  => $importModel,
                'exportModel'  => $exportModel
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/import_export'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Import/Export settings')
            )
        ));
        
        $this->render('import-export', compact('importModel', 'exportModel'));
    }
    
    /**
     * Handle the settings for console commands
     *//*
    public function actionCron()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $cronDeliveryModel      = new OptionCronDelivery();
        $cronLogsModel          = new OptionCronProcessDeliveryBounce();
        $cronSubscribersModel   = new OptionCronProcessSubscribers();
        $cronBouncesModel       = new OptionCronProcessBounceServers();
        $cronFeedbackModel      = new OptionCronProcessFeedbackLoopServers();
        
        if ($request->isPostRequest) {
            
            $cronDeliveryModel->attributes      = (array)$request->getPost($cronDeliveryModel->modelName, array());
            $cronLogsModel->attributes          = (array)$request->getPost($cronLogsModel->modelName, array());
            $cronSubscribersModel->attributes   = (array)$request->getPost($cronSubscribersModel->modelName, array());
            $cronBouncesModel->attributes       = (array)$request->getPost($cronBouncesModel->modelName, array());
            $cronFeedbackModel->attributes      = (array)$request->getPost($cronFeedbackModel->modelName, array());
            
            if (!$cronDeliveryModel->save() || !$cronLogsModel->save() || !$cronSubscribersModel->save() || !$cronBouncesModel->save() || !$cronFeedbackModel->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'            => $this,
                'success'               => $notify->hasSuccess,
                'cronDeliveryModel'     => $cronDeliveryModel,
                'cronLogsModel'         => $cronLogsModel,
                'cronSubscribersModel'  => $cronSubscribersModel,
                'cronBouncesModel'      => $cronBouncesModel,
                'cronFeedbackModel'     => $cronFeedbackModel
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/cron'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Cron jobs settings')
            )
        ));
        
        $this->render('cron', compact('cronDeliveryModel', 'cronLogsModel', 'cronSubscribersModel', 'cronBouncesModel', 'cronFeedbackModel'));
    }
    
    /**
     * Handle the settings for email templates
     */
      public function actionSuccess_messages()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $commonModel = new OptionCommonMessages();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($commonModel->modelName, array()))) {
            $commonModel->attributes = $attributes;
            if (!$commonModel->save()) {//	print_r($commonModel->getErrors());exit;
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
			
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
          
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'commonModel'   => $commonModel,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/success_messages'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Message Settings'), 
            'pageHeading'       => Yii::t('settings', 'Message  Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Message  settings')
            )
        ));
        
        $this->render('success_messages', compact('commonModel'));
    }
    public function actionEmail_templates($type = 'common')
    {
		 
        $types = array('common');
        if (!in_array($type, $types)) {
            $type = $types[0];
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        $model = new OptionEmailTemplate($type);
        
      $model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        
        if ($request->isPostRequest) {
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            
            if (isset(Yii::app()->params['POST'][$model->modelName][$type])) {
                $model->$type= Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName][$type]); 
            }
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/email_templates'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Email templates')
            )
        ));
        
        $this->render('email-templates', compact('model', 'types', 'type'));
    }
    
    /**
     * Handle the settings for email blacklist checks
     *//*
    public function actionEmail_blacklist()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $blacklistModel = new OptionEmailBlacklist();

        if ($request->isPostRequest) {
            
            $blacklistModel->unsetAttributes();
            $blacklistModel->attributes = (array)$request->getPost($blacklistModel->modelName, array());

            if (!$blacklistModel->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'        => $this,
                'success'           => $notify->hasSuccess,
                'blacklistModel'    => $blacklistModel,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/email_blacklist'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Email blacklist settings')
            )
        ));
        
        $this->render('email-blacklist', compact('blacklistModel'));
    }
    
    /**
     * Handle the settings for customer server options
     *//*
    public function actionCustomer_servers()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerServers();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_servers'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Servers')
            )
        ));
        
        $this->render('customer-servers', compact('model'));
    }
    
    /**
     * Handle the settings for customer lists options
     *//*
    public function actionCustomer_lists()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerLists();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_lists'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Lists')
            )
        ));
        
        $this->render('customer-lists', compact('model'));
    }
    
    /**
     * Handle the settings for customer registration options
     *//*
    public function actionCustomer_registration()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerRegistration();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_registration'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Registration')
            )
        ));
        
        $this->render('customer-registration', compact('model'));
    }
    
    /**
     * Handle the settings for customer registration options
     *//*
    public function actionCustomer_sending()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerSending();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_sending'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Sending')
            )
        ));
        
        $this->render('customer-sending', compact('model'));
    }
    
    /**
     * Handle the settings for customer quota counters options
     *//*
    public function actionCustomer_quota_counters()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerQuotaCounters();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_quota_counters'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Quota counters')
            )
        ));
        
        $this->render('customer-quota-counters', compact('model'));
    }
    
    /**
     * Handle the settings for customer campaigns options
     *//*
    public function actionCustomer_campaigns()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCustomerCampaigns();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/customer_campaigns'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Customers') => $this->createUrl('settings/customer_servers'),
                Yii::t('settings', 'Campaigns')
            )
        ));
        
        $this->render('customer-campaigns', compact('model'));
    }
    
    /**
     * Handle the settings for campaign attachments
     *//*
    public function actionCampaign_attachments()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCampaignAttachment();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());

            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/campaign_attachments'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Campaigns') => $this->createUrl('settings/campaign_attachments'),
                Yii::t('settings', 'Attachments')
            )
        ));
        
        $this->render('campaign-attachments', compact('model'));
    }
    
    /**
     * Handle the settings for campaign available tags
     *//*
    public function actionCampaign_template_tags()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCampaignTemplateTag();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/campaign_template_tags'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'),
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Campaigns') => $this->createUrl('settings/campaign_attachments'),
                Yii::t('settings', 'Template tags')
            )
        ));
        
        $this->render('campaign-template-tags', compact('model'));
    }
    
    /**
     * Handle the settings for campaign options
     *//*
    public function actionCampaign_options()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new OptionCampaignOptions();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/campaign_options'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('settings/index'),
                Yii::t('settings', 'Campaign options')
            )
        ));
        
        $this->render('campaign-options', compact('model'));
    }
    
    /**
     * Handle the settings for monetization options
     *//*
    public function actionMonetization()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $model   = new OptionMonetizationMonetization();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/monetization'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Monetization') => $this->createUrl('settings/monetization'),
            )
        ));
        
        $this->render('monetization', compact('model'));
    }
    
    /**
     * Handle the settings for monetization options
     *//*
    public function actionMonetization_orders()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $model   = new OptionMonetizationOrders();

        if ($request->isPostRequest) {
            
            $model->unsetAttributes();
            $model->attributes = (array)$request->getPost($model->modelName, array());
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'      => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('settings/monetization_orders'));
            }
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Settings'), 
            'pageHeading'       => Yii::t('settings', 'Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings')  => $this->createUrl('settings/index'),
                Yii::t('settings', 'Monetization') => $this->createUrl('settings/monetization_orders'),
                Yii::t('settings', 'Orders')
            )
        ));
        
        $this->render('monetization-orders', compact('model'));
    }

    /**
     * Display the modal window with for htaccess
     * Access allowed only via ajax.
     *//*
    public function actionHtaccess_modal()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('settings/index'));
        }
        $this->renderPartial('_htaccess_modal');
    }
    
    /**
     * Tries to write the contents of the htaccess file
     * Access allowed only via ajax.
     *//*
    public function actionWrite_htaccess()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('settings/index'));
        }
        
        if (!AppInitHelper::isModRewriteEnabled()) {
            return $this->renderJson(array('result' => 'error', 'message' => Yii::t('settings', 'Mod rewrite is not enabled on this host. Please enable it in order to use clean urls!')));
        }
        
        if (!is_file($file = Yii::getPathOfAlias('root') . '/.htaccess')) {
            if (!@touch($file)) {
                return $this->renderJson(array('result' => 'error', 'message' => Yii::t('settings', 'Unable to create the file: {file}. Please create the file manually and paste the htaccess contents into it.', array('{file}' => $file))));
            }
        }
        
        if (!@file_put_contents($file, $this->getHtaccessContent())) {
            return $this->renderJson(array('result' => 'error', 'message' => Yii::t('settings', 'Unable to write htaccess contents into the file: {file}. Please create the file manually and paste the htaccess contents into it.', array('{file}' => $file))));
        }
        
        return $this->renderJson(array('result' => 'success', 'message' => Yii::t('settings', 'The htaccess file has been successfully created. Do not forget to save the changes!')));
    }
    
    /**
     * Will generate the contents of the htaccess file which later 
     * should be written in the document root of the application
     */
    protected function getHtaccessContent()
    {
        $apps       = Yii::app()->apps;
        $webApps    = $apps->getWebApps();
        $baseUrl    = '/' . trim($apps->getAppUrl('frontend', null, false, true), '/') . '/';
        $baseUrl    = str_replace('//', '/', $baseUrl);
        
        if (($index = array_search('frontend', $webApps)) !== false) {
            unset($webApps[$index]);
        }
        
        return $this->renderPartial('_htaccess', compact('webApps', 'baseUrl'), true);
    }
    
    /**
     * Callback method to set the editor options for email settings
     */
    public function _setupEditorOptions(CEvent $event)
    {
        if (!in_array($event->params['attribute'], array('common'))) {
            return;
        }
        
        $options = array();
        if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
            $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
        }
        $options['id'] = CHtml::activeId($event->sender->owner, $event->params['attribute']);
        
        if ($event->params['attribute'] == 'common') {
            $options['fullPage'] = false;
            $options['allowedContent'] = true;
            $options['height'] = 500;
        } 

        $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
    }
}
