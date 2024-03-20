<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class MemberController extends Controller
{
	public $member;
	public function Init(){
		parent::Init();
	    $this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
	    if(empty($this->member)){
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
	  
		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/boot_css.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/materoial.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/new_icons.css'), 'priority' => -100));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/boot.min.js'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
		 
		 
			 
		$this->layout = 'member_area2';  
			 if(!Yii::app()->request->isAjaxRequest){
			 if($this->options->get('system.common.email_verification_required','yes')=='yes' && Yii::app()->user->getModel()->email_verified=='0'){
					$notify = Yii::app()->notify;
				   $notify->addInfo(Yii::t('app','Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.',array('{p}'=>$this->options->get('system.common.site_name',''))));
				   $this->redirect(Yii::app()->createUrl('user/EmailVerification'));
	       	}
	 
			if( !in_array($this->member->status,array('W','A'))){
		    
		    
				 $this->setData(array(
				'pageMetaTitle'     =>  Yii::t('app', 'Waiting for Approval :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
				'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
				'pageMetaDescription'   => Yii::app()->params['description'],
			));
			$this->render("wait_approval",compact("user","pricePlan"));exit;
		}
			 }
	}
	 public function  beforeAction($action)
    {   
		if($this->member->filled_info == '0' and  $this->member->FillPersonalInformation and  $action->id !== 'profile_settings' ){ 
			 $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
		}
			if( $action->id !=  'profile_settings'){
			   
			if( !empty( $this->member->filled_info) and $this->member->status == 'W'  ){
					$notify = Yii::app()->notify;
					$notify->addInfo(Yii::t('app','Your account is currently pending approval by the {p} administrator. In the meantime,you can\'t upload your properties.thanks for your patience.',array('{p}'=>Yii::app()->options->get('system.common.site_name'))));
			}
		}
		return parent::beforeAction($action);
	}
    public function actionDashboard($show=null)
    { 
        
	   $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Dashboard :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
		$notify = Yii::app()->notify;
		$user =  $this->member;
	 
		$premium_downloads = 0;
		$TotalDownloadCount =  0 ; 
		$TotalInvoices  = (int) 0 ; 
        $this->render("dashboard",compact("user","pricePlan","premium_downloads",'TotalDownloadCount','TotalInvoices'));
	}
     public function actionMy_avatar($slug=null)
    { 
        $user =   $this->member;
        $notify = Yii::app()->notify;
	 	$model = ListingUsers::model()->findByPk(Yii::app()->user->getId());
		$scenario = 'update_logo'; 
	    if(empty($model)){
          throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$model->scenario = $scenario;
		 
        $request = Yii::app()->request;
        
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
       
        if ($request->isPostRequest  ) {
				
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
		 
			if ($model->save()) {
			              $notify->addSuccess(Yii::t('app',Yii::app()->options->get('system.messages.successfully_changed_avatar','Succesfully updated your profile picture') ));
			
						$this->redirect(Yii::app()->createUrl('member/dashboard',array('slug'=>$user->slug)));
           } 
            
	    }
	    $apps = $this->app->apps;
              $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
        			 
        $this->getData('pageScripts')->add(array('src' =>$apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Change Profile  Image  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
          $this->render("change_avatar" , compact('model','user','return' ));
	}
	public function actionProfile_settings($return=null,$slug=null)
    {
	   $notify = Yii::app()->notify;
	    $user =   $this->member;
	    if(!$user->FillPersonalInformation){
			$this->redirect($this->app()->createUrl('member/dashboard',array('slug'=>$user->slug)));
			Yii::app()->end();
		}
	    
	    if(Yii::app()->user->user_type=='A'){
			$model = Agents::model()->findByPk(Yii::app()->user->getId());
			$scenario = 'agent_update1'; 
		}
		else if(Yii::app()->user->user_type=='D'){
			$model = Developer::model()->findByPk(Yii::app()->user->getId());
			$scenario = 'developer_update1'; 
			 
		}
	 
	    if(empty($model)){
          throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$model->scenario = $scenario;
		 
        $request = Yii::app()->request;
        
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
       
        if ($request->isPostRequest  ) {
				
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
		 
			if ($model->save()) {
			    	    $notify->addSuccess(Yii::t('app',Yii::app()->options->get('system.messages.successfully_saved_personal_information','Succesfully saved personal information.') ));
			
						$this->redirect(Yii::app()->createUrl('member/dashboard',array('slug'=>$user->slug)));
           } 
            
	    }
	    $apps = $this->app->apps;
       $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js') ));
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Profile Settings  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
        
         
       
	   $this->render("personal_information" , compact('model','user','return' ));
    }
   public function actionBilling_settings($return=null,$slug=null)
    {
	    $user =   $this->member;   
	    $model =  FreebitesInformation::model()->findByAttributes(array('user_id'=>Yii::app()->user->getId(),'f_type'=>'B'));
	    if(empty($model)){
        $model = new FreebitesInformation();
		}
		$model->user_id = Yii::app()->user->getId();
		$model->f_type  = 'B';
        $request = Yii::app()->request;
        
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
       
        if ($request->isPostRequest  ) {
				
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
		 
			if ($model->save()) {
						$this->redirect(Yii::app()->createUrl('member/dashboard'));
           } 
	    }
        
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Billing Settings  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
        $this->render("billing_information" , compact('model','user','return' ));
		 
    }
    public function actionPremium_downloads()
    {
 
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new FreebitesOrder('search');
        $order->unsetAttributes();
       
        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
        
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Premium Downloads  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
        $this->render('premium_downloads', compact('order'));
    }
  public function actionInvoices()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
         
		$order   =  new  FreebitesPayment('search');
		$order->unsetAttributes();
		$order->user_id = Yii::App()->user->getId();
		$order->status = 'A'; 
		 
        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
		 
		 $this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', 'Invoices  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
			'pageHeading'       => Yii::t('hotel_booking', 'Invoices'),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
       
        $this->render('invoices', compact('order'));
    }
    
     
    
    public function actionPayment_view($id)
    {
        $request = Yii::app()->request;
        $order   = FreebitesPayment::model()->findByAttributes(array('id'=>(int)$id,'user_id'=>Yii::app()->user->getId()));
        
        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
     
        $customer  = $order->user;
         $this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', 'Invoice Details  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
			'pageHeading'       => Yii::t('hotel_booking', 'Invoice Details'),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
  
        
        $this->render('order_detail', compact('order', 'pricePlan', 'customer', 'note', 'transaction'));
    }
    
    public function actionPdf($id)
    {
        $request = Yii::app()->request;
        $order   = FreebitesPayment::model()->findByPk((int)$id);
        
        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $pricePlan = $order->plan;
        $customer  = $order->customer;
        
        Yii::import('common.vendors.Invoicr.*');
        
        $invoice = new Invoicr("A4", $order->currency->code, null);
        
        if (is_file($logoImage = Yii::getPathOfAlias('common.vendors.Invoicr.images.logo') . '.png')) {
            $invoice->setLogo($logoImage);
        }

        $invoice
            ->setColor("#3c8dbc")
            ->setType(Yii::t('orders', "Invoice"))
            ->setReference($order->order_uid)
            ->setDate(preg_replace('/\s.*/', '', $order->dateAdded))
            ->setDue(preg_replace('/\s.*/', '', $order->dateAdded))
            ->setFrom(array_map('trim', explode("\n", $order->getHtmlPaymentFrom(null, "\n"))))
            ->setTo(array_map('trim', explode("\n", $order->getHtmlPaymentTo(null, "\n"))))
            ->addItem($pricePlan->name, StringHelper::truncateLength($pricePlan->description, 50), 1, false, $pricePlan->formattedPrice, false, $order->formattedTotal)
            ->addTotal(Yii::t('orders', "Subtotal"), $order->formattedSubtotal)
            ->addTotal(Yii::t('orders', "Tax"). ' '. $order->formattedTaxPercent, $order->formattedTaxValue)
            ->addTotal(Yii::t('orders', "Discount"), $order->formattedDiscount)
            ->addTotal(Yii::t('orders', "Total"), $order->formattedTotal);
        
        if ($order->getIsComplete()) {
            $order->total = 0.00;
        }
        
        $invoice->addTotal(Yii::t('orders', "Total due"), $order->formattedTotal, true);
        
        if ($order->getIsComplete()) {
            $invoice->addBadge(Yii::t('orders', "Paid"));
        }

        $invoice
            ->addTitle(Yii::t('orders', 'Thank you for your business.'))
            ->setFooternote(Yii::app()->options->get('system.urls.frontend_absolute_url'));
        
        //Render
        $invoice->render($order->order_uid . '.pdf','I');
    }
    public function actionDownloads()
    {
		 //$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/profile-css.css')));
	       $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Downloads', array('{name}' => Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Downloads'),
            'pageMetaDescription'   => Yii::app()->params['description'],
             
        ));
        $request = Yii::app()->request; 
     
		$this->render("my_booking",compact("user","model","pages","categories"));
	}
	 public function actionAccount_settings($secion="")
    {
		
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('ui.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('ui.css')));
		$notify = Yii::app()->notify;
		$this->setData(array(
		'pageMetaTitle'     =>  Yii::t('app', '{name} :: Account Settings', array('{name}' => Yii::app()->options->get('system.common.site_name') )), 
		'pageHeading'       => Yii::t('hotel_booking', 'Account Settings'),
		'pageMetaDescription'   => Yii::app()->params['description'],

		));
		 $notify = Yii::app()->notify;
        $user =  new ListingUsers();
        
         
        $user =  $user->findByPk((int)Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
         }
      
        if(Yii::app()->request->isPostRequest)
        {
			 
		
			$attributes = Yii::app()->request->getPost("ListingUsers"); 
			$user->attributes = $attributes;
			
				
			if(Yii::app()->request->getPost("sitesearch")=="Change Password")
			{
				
				 
					$user->scenario="updatepassword";
					$user->password= $attributes['password'];
					$user->old_password= $attributes['old_password'];
					if (Yii::app()->request->isAjaxRequest) {
						echo CActiveForm::validate($user);
						Yii::app()->end();
					}
					if($user->save())
					{   
						 
						$notify->addSuccess(Yii::t('app', 'Succesfully updated your password.'));
						$this->redirect(Yii::app()->createUrl('member/account_settings'));
					}
					else
					{
						$notify->addError(Yii::t('app', 'Error !! Failed to update password.'));
						//Yii::app()->user->setFlash("failure",'1');
					}
				 
		    }
		    
		    if(Yii::app()->request->getPost("sitesearch")=="Change Name")
			{
				$user->scenario="chnage_name";
				if (Yii::app()->request->isAjaxRequest) {
					echo CActiveForm::validate($user);
					Yii::app()->end();
				}
				if($user->save())
				{
					//Yii::app()->user->setFlash('success','Succesfully changed your profile');
					$notify->addSuccess(Yii::t('app', 'Succesfully changed your profile name .'));
					$this->redirect(Yii::app()->createUrl('member/account_settings'));
				}
				else
				{
				    $user->addError(Yii::t('app', 'Error !! Failed to  changed your profile name .'));
					 
				}
			}
		    if(Yii::app()->request->getPost("sitesearch")=="Change Email")
			{
				$user->scenario="updateEmail";
				if (Yii::app()->request->isAjaxRequest) {
					echo CActiveForm::validate($user);
					Yii::app()->end();
				}
				$user->verification_code = md5(uniqid(rand(), true));
				$user->email_verified    =  '0';
				if($user->save())
				{
					//Yii::app()->user->setFlash('success','Succesfully changed your profile');
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				}
				else
				{
				 
					$user->addError(Yii::t('app', 'Error !! Failed  to update  your email address .'));
				}
			}
			 
		}
       
       
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
         }
         
                   
			$user->password="";	    
          $this->getData('pageStyles')->mergeWith(array(
				   //  array('src' => 'https://www.247zoom.com/frontend/themes/styles-yellow/css/en/legacy_5572020.css', 'priority' => 1),
				  
				));
	 
         $this->render("account_settings_main",compact("user",'login'));
	}
    public function actionFavourite()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new AdFavourite('serach');
          
        $model->unsetAttributes();
       
        $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  Yii::app()->user->getId();
         $title = ' My Favourite  List';
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'My Favourite  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            
        ));
        $hooks = Yii::app()->hooks;
        $this->render('fav_list', compact('model','title','s','hooks'));
    }
    public function actionDelete_fave($id=null)
    {
        $model = AdFavourite::model()->findByAttributes(array('ad_id'=>$id,'user_id'=>$this->app->user->getId()));
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->delete();    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
     public function actionSearches()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new UserSearches('serach');
          
        $model->unsetAttributes();
       
        $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  Yii::app()->user->getId();
         $title = ' My Saved Searches   List';
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'My Searches  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            
        ));
        $hooks = Yii::app()->hooks;
        $this->render('save_list', compact('model','title','s','hooks'));
    }
    public function actionDelete_save($id=null)
    {
        $model = UserSearches::model()->findByAttributes(array('date_added'=>$id,'user_id'=>$this->app->user->getId()));
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->delete();    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
}
