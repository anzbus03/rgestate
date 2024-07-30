<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class Send_emailController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Mail Box";
     public $focus= "subject";
     public function init()
     {
		 $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css')));
	    $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/datetimepicker/js/bootstrap-datetimepicker.min.js')));
	    
        //$this->onBeforeAction = array($this, '_registerJuiBs');
        parent::init();
     }
   
    public function actionIndex()
    {
		 
		$options    = Yii::app()->options;
        $request    = Yii::app()->request;
		$notify = Yii::app()->notify;
		 
		$model = new Email('search');
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
		 
 
	 
		$viewPath ='sub/_right_list';
 
        $this->render('mainView', compact('model','viewPath'));
     
    }
     public function actionPreview($id)
    {
		 $template = Email::model()->findByAttributes(array(
            'id'  => $id,
           
        ));
        
        if($template === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        $request    = Yii::app()->request;
        
       // $cs = Yii::app()->clientScript;
       // $cs->reset();
       // $cs->registerCoreScript('jquery');
        
    
        
       // $cs->registerScriptFile(AssetsUrl::js('template-preview.js'));
        
        $this->renderPartial('preview', compact('template'), false, true);
    }

    /**
     * List all available users
     */
      public function actionCreate()
    {
		$this->actionMail();
		Yii::app()->end();
	}
    public function actionMail()
    {
		set_time_limit(0);
		$options    = Yii::app()->options;
        $request    = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new Email();
	      
	    
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
		 
		 
	 
            $model->attributes = $attributes;
           	$parser = new EmailTemplateParser();
			$parser->inlineCss = true;
			$model->message  = $parser->setContent(Yii::app()->params['POST'][$model->modelName]['message'])->getContent();
      
            
        
            $model->attachments =  $model->image;
           
       
            if(!$model->save()) {
				
				 
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
        
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect( Yii::app()->createUrl('send_email/mail')  );
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'article'   => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array('send_email/index'));
            }
        }
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $viewPath ='sub/_right';
        $this->render('mainView', compact('model','viewPath'));
       
    }
      public function actionUpdateS($id)
    {
		set_time_limit(0);
        $model = Email::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        if($model){
			$model->send;
			echo "Send";exit;
		}
	}
     public function actionUpdate($id)
    {
		set_time_limit(0);
        $model = Email::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
             $model->attributes  =  $attributes;
             if (isset(Yii::app()->params['POST'][$model->modelName]['message'])) {
                $model->message = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['message']);
             }
            $model->attachments =  $model->image;
             if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
             } else {
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
             }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array(Yii::app()->controller->id.'/mail'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        
        $viewPath ='sub/_right';
        $this->render('mainView', compact('model','viewPath'));
    }
     public function action_list()
    {
			$request = Yii::app()->request;
			$common  = new OptionCommon();
			if($var= $common::isCounterRequest('Email')){
				 return true;
			};
			$model = new Email('serach');
			$model->unsetAttributes();
			$model->attributes = (array)$request->getQuery($model->modelName, array());
			$common::SCRIptLoader();
			$grid   			 =  $model->getGridId();
			$load= $common::indexScriptloadCheck($grid);
			echo  $this->renderPartial('//common/_dashlet_common', compact('model'),false,$load);
    }
    public function action_create($id=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if(!empty($id)){
			$model = Email::model()->findByPk((int)$id);
			$request = Yii::app()->request;
			$notify = Yii::app()->notify;
			if (empty($model)) {
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
		}
		else{
			$model = new Email();
			 
		}
	 
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
		 
			 
			$model->attributes = $attributes;
		 
            if (!$model->save()) {
				 echo CHtml::errorSummary($model); Yii::app()->end();
                
            } else {
			  if( $request->getQuery('returnId','0') != '0'){
			 
				    echo  CJSON::encode(array('reponse'=>$model->attributes,'callFunction'=>'OPPortunitySelect'));
				    Yii::app()->end();
			  }
			  echo 1;
            }
            Yii::app()->end();
        }
         
		OptionCommon::SCRIptLoader();
        $this->renderPartial('//common/_create_form', compact('model'),false,true);
    }
     public function _registerJuiBs($event)
    {
        if (in_array($event->params['action']->id, array('mail','update'  ))) {
            $this->getData('pageStyles')->mergeWith(array(
                array('src' =>AssetsUrl::css('dropzone.css'), 'priority' => -1001),
            ));
            $this->getData('pageScripts')->mergeWith(array(
                array('src' =>  AssetsUrl::js('dropzone.min.js'), 'priority' => -1001),
            ));
           
		
            
        }
    }
      public function actionView_status($id)
    {
		set_time_limit(0);
		$request = Yii::app()->request; 
        $model = Email::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $model = new EmailMembers('search');
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->email_id = $id ;
      //  if($request->isAjaxRequest){
			    OptionCommon::SCRIptLoader();
			    $load= OptionCommon::indexScriptloadCheck();
				$this->renderPartial('sub/list_members', compact('model','showFilter'),false,$load);	
				Yii::app()->end();
	   // }
	}
    public function actionTemplate($template_id='')
    {
		
		$emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('template_id'=>$template_id));
		if($emailTemplate){
			
			 
		$parser = new EmailTemplateParser();
		$parser->inlineCss = $emailTemplate->inline_css === CustomerEmailTemplate::TEXT_YES;
		$parser->minify    = $emailTemplate->minify === CustomerEmailTemplate::TEXT_YES;
		$emailTemplate =  $emailTemplate->content ;
		$logo = OptionCommon::getEmailLogoImage();
		$logo =  '<a href="'.Yii::app()->createAbsoluteUrl('dashboard/index').'" alt=""><img src="'.  $logo  .'" style="width:134px; "></a> ';
		$emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
		$emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'),$emailTemplate);
		$emailTemplate = str_replace('#eaeaea',Yii::app()->options->get('system.common.email_bg_color') , $emailTemplate);
		echo $emailTemplate;
	   }
	   else{
			$emailTemplate = Yii::app()->options->get('system.email_templates.common');
			$logo = OptionCommon::getEmailLogoImage();
			$logo =  '<a href="'.Yii::app()->createAbsoluteUrl('dashboard/index').'" alt=""><img src="'.  $logo  .'" style="width:134px; "></a> ';
			$emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'),$emailTemplate);
			$emailTemplate = str_replace('#eaeaea',Yii::app()->options->get('system.common.email_bg_color') , $emailTemplate);
			$emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
			echo $emailTemplate;
	   }
	   Yii::app()->end();
	  
	   
	}
    public function actionUpload()
    {
	  
	    $path =   Yii::getPathOfAlias('root.uploads'); 
		if($_FILES['file']['tmp_name'])
				{
					$ext = $_FILES['file']['name'];
					$ext = pathinfo($ext, PATHINFO_EXTENSION);
					$img = uniqid(rand(0, time())).".".$ext;
					//echo $img;
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/attachment/{$img}");
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
	  }
	  function actionDelete_image()
	  {
			
		$str="";
		if(isset($_POST['inp']))
		{
			$ar = explode(',',$_POST['inp']);
			if($ar)
			{
				foreach($ar as $k=>$val)
				{
					 
					if($val!=$_POST['file'] and $val!="")
					{
						 
						$str .= ",".$val;
						 
					}
				}
			}
			 
		} 
		Email::model()->UnlinkAttachmentImage(@$_POST['file']);	
 		echo $str; 
		 
    
        }
        
    public function actionDelete($id)
    {
        $model = Email::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        
         
		$model->updateAll(array('isTrash'=>'1'),"id=:emailID",array(':emailID'=>$id ));
									
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
        $leadsModel = new  Email();
        if ($action == Email::BULK_ACTION_DELETE && count($items)) {
			 
            $affected = 0;
            foreach ($items as $item) {
              
                $leads = $leadsModel->findByPk($item);
               
                if(!$leads){
					continue;
				}
				$leads->updateByPk($item,array('isTrash'=>1));
             
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }  
         
     
      
        $defaultReturn = $request->getServer('HTTP_REFERER', array('dashboard/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
    public function actionTrash()
    {
	 
		$options    = Yii::app()->options;
        $request    = Yii::app()->request;
		$notify = Yii::app()->notify;
		 
		$model = new Email('search');
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        
      	$viewPath ='sub/_right_list_trash';
 
        $this->render('mainView', compact('model','viewPath'));
    }
    public function actionEmail_template()
    {
	  $request = Yii::app()->request;

        $model = new CustomerEmailTemplate('serach');
		$model->unsetAttributes();
		$model->attributes = (array)$request->getQuery($model->modelName, array());
 
      $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        
        $templateUp = new CustomerEmailTemplate('upload');
        $viewPath = 'sub/_template_list';
        $this->render('mainView', compact('model','viewPath'));
         
    }
    
    public function actionEmail_template_create()
    {
	 $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $customer   = 1 ;
        
        $template = new CustomerEmailTemplate();
        $template->customer_id =1 ;
        
        if ($request->isPostRequest && ($attributes = $request->getPost($template->modelName, array()))) {
            $template->attributes = $attributes;

            $parser = new EmailTemplateParser();
            $parser->inlineCss = $template->inline_css === CustomerEmailTemplate::TEXT_YES;
            $parser->minify    = $template->minify === CustomerEmailTemplate::TEXT_YES;
            $template->content = $parser->setContent(Yii::app()->params['POST'][$template->modelName]['content'])->getContent();
            
            if ($template->save()) {
                $notify->addSuccess(Yii::t('email_templates',  'You successfully created a new email template!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'template'      => $template,
            )));
            
            if ($collection->success) {
                $this->redirect(array('send_email/templateUpdate', 'template_uid' => $template->template_uid));
            }
        }
        
        $template->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $viewPath = 'sub/template_from';
        $this->render('mainView', compact('template','viewPath'));
      
    }
     public function loadModel($template_uid)
    {
        $model = CustomerEmailTemplate::model()->findByAttributes(array(
            'template_uid'  => $template_uid,
           
        ));
        
        if($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
    
     public function actionTemplateUpdate($template_uid)
    {
        $template   = $this->loadModel($template_uid);
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;

        if ($request->isPostRequest && $attributes = $request->getPost($template->modelName, array())) {
            $template->attributes = $attributes;
            
            $parser = new EmailTemplateParser();
            $parser->inlineCss = $template->inline_css === CustomerEmailTemplate::TEXT_YES;
            $parser->minify    = $template->minify === CustomerEmailTemplate::TEXT_YES;
            $template->content = $parser->setContent(Yii::app()->params['POST'][$template->modelName]['content'])->getContent();
            
            if ($template->save()) {
                $notify->addSuccess(Yii::t('email_templates',  'You successfully updated your email template!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'template'      => $template,
            )));
            
            if ($collection->success) {
                $this->redirect(array('send_email/templateUpdate', 'template_uid' => $template->template_uid));
            }
        }
        //$template->content = str_replace('{calendar}','<div class="aU5" style="height:80px;width:70px; background: rgba(0, 0, 0, 0) url(\'//ssl.gstatic.com/ui/v1/icons/mail/smart_mail_conv_icons.png\') no-repeat scroll 0 0;  position: relative; "><span class="aRh" style="font-weight:bold;text-align:center;width:70px;color: #fff;font-size: 11px;top: 1px;position:absolute">Mar</span><span class="aRg" style="font-weight:bold;text-align:center;width:70px;color:#222222;font-size:200%;  color: #222222;position:absolute; top: 30px;">15</span><span class="aRj" style="font-weight:bold;text-align:center;width:70px;color:#222222;font-size:11px; position:absolute;  top: 57px;">Tue</span></div>',$template->content);
      
        $template->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        $this->data->previewUrl = $this->createUrl('templates/preview', array('template_uid' => $template_uid));
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}  "),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
 
        $viewPath = 'sub/template_from';
        $this->render('mainView', compact('template','viewPath'));
    }
      public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'content') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            
            $options['id'] = CHtml::activeId($event->sender->owner, 'content');
            $options['fullPage'] = true;
            $options['allowedContent'] = true;
            $options['contentsCss'] = array();
            $options['height'] = 500;
            
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    
    public function actionBulk_action_trash()
    {
		
	 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $action = $request->getPost('bulk_action');
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        $leadsModel = new  Email();
        if ($action == Email::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            foreach ($items as $item) {
               
                $leads = $leadsModel->findByPk($item);
                if(!$leads){
					continue;
				}
				$leads->delete();
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }  
        if ($action == Email::BULK_ACTION_RESTORE && count($items)) {
			
            $affected = 0;
            foreach ($items as $item) {
               
                $leads = $leadsModel->findByPk($item);
                if(!$leads){
					continue;
				}
				$leads->updateByPk($item,array('isTrash'=>0));
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }  
     
      
        $defaultReturn = $request->getServer('HTTP_REFERER', array('dashboard/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
    public function actionSync_datetime($date){
		if(Yii::app()->request->isAjaxRequest and !empty($date)){
			echo json_encode(array('localeDateTime'=>date('Y-m-d h:i A',strtotime($date))));
			Yii::app()->end();
		}
	}
	public function actionSend(){
		
 
	    
	    
		
        $options  = Yii::app()->options;
        $logo = Yii::app()->options->get('system.common.system_absolute_url').Yii::app()->options->get('system.common.email_logo') ;
		$logo =  '<a href="'. Yii::app()->options->get('system.common.system_absolute_url').'/backend' .'" alt=""><img src="'.  $logo  .'" style="width:134px; "></a> ';
		
        $mailQueue = Email::model()->cronEmails() ;
        
        if($mailQueue){
			 
			foreach($mailQueue as $k=>$v){
				echo $v->send; 
			}
		}
		
		echo "No";
      
        exit;
       
		$adminusers    =    Leads::model()->processAdminUser();
        if($task){
			foreach($task as $k=>$v){
		 
		    $staff         =   $v->userListArray;
			$usersList = array_replace((array)$adminusers,(array)$staff );
			
			$emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('name'=>"task-reminder"));
			if($emailTemplate) { $emailTemplate = $emailTemplate->content; }
			else {  return false; }
			 
			$emailTemplate = str_replace('{leadlink}','', $emailTemplate);
			$emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
			$emailTemplate = str_replace('{project}',Yii::app()->options->get('system.common.site_name'), $emailTemplate);
			$emailTemplate = str_replace('{title}',$v->task, $emailTemplate);
			$emailTemplate = str_replace('{taskdate}',@$v->date , $emailTemplate);
			$emailTemplate = str_replace('{type}',$v->taskType->type, $emailTemplate);
			$emailTemplate = str_replace('{priority}',@$v->priorityString, $emailTemplate);
			$emailTemplate = str_replace('{related}',@$v->contactNamesAbsolute_cron, $emailTemplate);
			$emailTemplate = str_replace('{name}',$v->relatedNamesAbsolute_cron, $emailTemplate);
			$emailTemplate = str_replace('{members}',@$v->userList, $emailTemplate);
			$emailTemplate = str_replace('#eaeaea',Yii::app()->options->get('system.common.email_bg_color') , $emailTemplate);
			$taskUrl       = Yii::app()->options->get('system.common.system_absolute_url').'/backend/index.php/task/view/id/'.$v->task_id ; 
			$emailTemplate = str_replace('{url}',CHtml::link($taskUrl,$taskUrl),$emailTemplate);
			$emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'),$emailTemplate);
			
			$emailTemplate = str_replace('{date}',  date('D M d, Y',strtotime($v->date)) , $emailTemplate);
			$emailTemplate = str_replace('{time}',  date('h:i A',strtotime($v->date)) , $emailTemplate);
			$emailTemplate = str_replace('{timezone}',Yii::app()->options->get('system.common.default_time_zone_for_email'), $emailTemplate);
			$emailTemplate = str_replace('{calendar}','<div class="aU5" style="height:80px;width:70px; background: rgba(0, 0, 0, 0) url(\''.Yii::app()->options->get('system.common.system_absolute_url').'/uploads/logo/smart_mail_conv_icons.png\') no-repeat scroll 0 0;  position: relative; "><table style="width:100%"> <tbody><tr><td style="text-align: center; color: rgb(255, 255, 255); padding: 0px 6px 5px; vertical-align: top ! important; font-size: 11px; font-weight: bold; line-height: 16px;">'.date('M',strtotime($v->date)).'</td></tr><tr><td style="text-align: center; font-size: 22px; padding: 6px;"> '.date('d',strtotime($v->date)).'</td></tr><tr><td style="text-align: center; font-size: 11px; padding: 1px;">'.date('D',strtotime($v->date)).'</td></tr></tbody></table></div>',$emailTemplate);
			$are_u_going_url = Yii::app()->options->get('system.common.system_absolute_url').'/backend/index.php/guest/are_u_going/type/task/user/{user}/id/'.$v->task_id.'/option';
			$usersList = array_replace((array)$adminusers,(array)$staff ); 
			$server = DeliveryServer::pickServer(); 
			if(!empty($usersList) and !empty($server)){
				foreach($usersList as $k2 => $v2){
							if(!empty($staff) and array_key_exists($k2,$staff)){
									$message = str_replace('{going-for}','<div class="aRm"><a href="'.$are_u_going_url.'/yes"><div style="background-color: rgb(245, 245, 245); color: rgb(68, 68, 68); min-width: 56px; display: inline-block; text-align: center; line-height: 27px; font-weight: bold; font-size: 11px; background-image: -moz-linear-gradient(center top , rgb(245, 245, 245), rgb(241, 241, 241)); border: 1px solid rgb(192, 192, 192);" class="T-I J-J5-Ji aQ9 T-I-ax7 T-I-Js-IF L3">Yes</div></a><a href="'.$are_u_going_url.'/may"><div style="background-color: rgb(245, 245, 245); background-image: -moz-linear-gradient(center top , rgb(245, 245, 245), rgb(241, 241, 241)); color: rgb(68, 68, 68); min-width: 56px; display: inline-block; text-align: center; line-height: 27px; font-weight: bold; font-size: 11px; border: 1px solid rgb(192, 192, 192); border-left: 0px;" class="T-I J-J5-Ji aQ7 T-I-ax7 T-I-Js-Gs T-I-Js-IF L3">Maybe</div></a><a href="'.$are_u_going_url.'/no"><div style="background-color: rgb(245, 245, 245); background-image: -moz-linear-gradient(center top , rgb(245, 245, 245), rgb(241, 241, 241)); color: rgb(68, 68, 68); min-width: 56px; display: inline-block; text-align: center; line-height: 27px; font-weight: bold; font-size: 11px; border: 1px solid rgb(192, 192, 192);border-left: 0px;" class="T-I J-J5-Ji aQ9 T-I-ax7 T-I-Js-Gs L3">No</div></a></div>',$emailTemplate);
							}
							else{
									$message = str_replace('{going-for}','',$emailTemplate);
						
							}
							$params = array(
							'to'            =>   $k2,
							'fromName'      =>   Yii::app()->options->get('system.common.site_name'),
							'subject'       =>	'Task Notification :   '. Yii::app()->options->get('system.common.site_name'),
							'body'          =>  str_replace('{user}',$k2,$message),
							);
							$server->sendEmail($params) ; 
					
				}
			 }
			  
			Task::model()->updateByPk($v->task_id,array('reminder_status'=>'0','cron_last_send'=>date('Y-m-d')));
			}
		}
	}
}
