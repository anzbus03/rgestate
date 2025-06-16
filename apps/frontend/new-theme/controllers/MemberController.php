<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class MemberController extends Controller
{
	public $member;
	public function Init(){
		parent::Init();
	
		/*
		if(in_array(Yii::app()->user->user_type,array('C','A'))){
			if(Yii::app()->user->user_type=='C'){
				$this->member =  Agencies::model()->findByPk(Yii::app()->user->getId());
			}
			else{
		    	$this->member =  Agents::model()->findByPk(Yii::app()->user->getId());
			}
		}
		else if(Yii::app()->user->user_type=='D'){
		        $this->member =  Developer::model()->findByPk(Yii::app()->user->getId());
		}
		else{
		        $this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
		}
		*/
	      $this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
	     
	    if(empty($this->member)){
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
		$this->member->verification_process();
	  
		$apps = $this->app->apps;
				$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('assets/star/css/shared/style.css?q=3'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('assets/star/css/demo_1/style.css?q=1'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/materoial.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/new_icons.css'), 'priority' => -100));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/boot.min.js'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
		 
		 
		if(Yii::app()->user->getState('user_type','U')=='U'){
			$this->layout = 'member_area_guest'; 
		}
		else{	 
		$this->layout = 'member_area2'; 
		}
		
		 
			 /*
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
		
			 }*/
	}
	 public function  beforeAction($action)
    {   
		if($this->member->filled_info == '0' and  $this->member->FillPersonalInformation and  $action->id !== 'profile_settings' ){ 
		 
		//	 $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
		}
    	 $notify = Yii::app()->notify;
		if( $action->id !=  'profile_settings'){
			   
			if( !empty( $this->member->filled_info) and $this->member->status == 'W'  ){
					$notify = Yii::app()->notify;
					$notify->addInfo(Yii::t('app','Your account is currently pending approval by the {p} administrator. In the meantime,you can\'t upload your properties.thanks for your patience.',array('{p}'=>Yii::app()->options->get('system.common.site_name'))));
			}
		}
		 
		return parent::beforeAction($action);
	}
	public $secure;
    public function actionDashboard($show = null)
    {
        $this->setData(array(
            'pageMetaTitle' => Yii::t('app', '{dashboard} | {name} ', array(
                '{dashboard}' => $this->tag->getTag('dashboard', 'Dashboard'),
                '{name}' => $this->member->fullName
            )),
            'pageHeading' => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription' => Yii::app()->params['description'],
            'hooks' => Yii::app()->hooks,
        ));

        $notify = Yii::app()->notify;
        $user = $this->member;

        // Email verification check
        if ($user->email_verified == '0') {
            $notify->addWarning(Yii::t('app', 'Email not verified. ' . CHtml::link('Click here to verify your email address', Yii::App()->createUrl('user/emailverification'))));
        }

        // Mobile verification check
        if ($user->o_verified == '0') {
            // $notify->addWarning(Yii::t('app', 'Mobile Number not verified. '.CHtml::link('Click here to verify your phone number ',Yii::App()->createUrl('user/otp_verify')) ));
        }

        // Guest user redirect
        if (Yii::app()->user->getState('user_type', 'U') == 'U') {
            $this->render("dashboard_guest");
            exit;
        }

        // Initialize variables
        $premium_downloads = 0;
        $TotalDownloadCount = 0;
        $TotalInvoices = (int) 0;

        // Get statistics data
        $last_30_Days_pageviews = StatisticsPage::model()->pageCount('30day');
        $last_30_Days_callCount = Statistics::model()->callCount('30day');
        $last_30_Days_mailCount = Statistics::model()->mailCount('30day');

        // Get email enquiries
        $searchequiryModel = new SendEnquiry2();
        $searchequiryModel->user_id = (int) Yii::app()->user->getId();
        $searchequiryModelCriteria = $searchequiryModel->search(1);
        $enqTotal = SendEnquiry2::model()->count($searchequiryModelCriteria);

        // Get graph data
        $impressions_graph = StatisticsPage::model()->pageCountDatewise();

        // Get active properties count
        $active_properties = PlaceAnAd::model()->countByAttributes([
            'user_id' => Yii::app()->user->id,
            'isTrash' => "0",
            "status" => "A"
        ]);

        // Handle parent user
        if (!empty($this->member->parent_user)) {
            $user_id = $this->member->parent_user;
        } else {
            $user_id = $this->member->user_id;
        }

        // Get user plans
        $plans = PricePlanOrder::model()->userActiveListingPackageAll($user_id);

        // *** UPDATED: Get top 5 properties with proper method call ***
        $topViews = StatisticsPage::model()->topPropertyViews(5, '30day');

        // Add CSS and JS assets
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/jquery.dynameter.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/jquery.dynameter.js')));

        // Render the view
        $this->render("dashboard", compact(
            'topViews',
            'user_id',
            'active_properties',
            'impressions_graph',
            "user",
            "pricePlan",
            "premium_downloads",
            'TotalDownloadCount',
            'TotalInvoices',
            'last_30_Days_pageviews',
            'last_30_Days_callCount',
            'last_30_Days_mailCount',
            'enqTotal',
            'plans'
        ));
    }

    public function actionShow_pendings($show=null)
    { 
        
	   $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'Notitification :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
		$notify = Yii::app()->notify;
		if(!empty($this->member->parent_user)){
			$user_id = $this->member->parent_user;
		}else{
			$user_id = $this->member->user_id;
		}
		$user =  $this->member;
	    $plans = PricePlanOrder::model()->userActiveListingPackageAll($user_id);
								
        $this->render("show_notification",compact('plans'));
	}
	   public function actionAddons($show=null,$option=null)
    { 
		
		 
       
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        if (!empty($user->parent_user)) {
            throw new CHttpException(404, Yii::t('app', $this->tag->getTag('you_have_no_permission_to_add_','You have no permission to add Package. Please contact your agency admin')));
        } 
        $this->getData('pageStyles')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/css/addons_package.css'), 'priority' => -100));
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>$this->tag->getTag('subscription_packages','Subscription Packages'),'{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', $this->tag->getTag('subscription_packages','Subscription Packages')),
            'pageMetaTitle' =>  Yii::t('trans','{title} | {app}',array('{title}'=>$this->tag->getTag('subscription_packages','Subscription Packages'),'{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
	 
        $this->render("addons", compact('user','member','option'));
    }
     public function actionadd_video($id=null){
		 
		$model = PlaceAnAd::model()->findByPk($id);
		$success = false;
		if(!Yii::app()->user->getId()){
			$message = 'Session Timed Out!';
		}
		else if(empty($model)){
			$message = 'Property Not Exist!';
		}
		else{
			 $featuredModel = $this->member->getvalidateUserCurrentPackage(2);
			 if(!empty($featuredModel) and isset($featuredModel['redirect'])){
				$message = $featuredModel['message'];
			 }
			 else if(!empty($featuredModel)){
				 
				$videoModel = new PlaceAnAd();
				$videoModel->id = $model->id ;
				$videoModel->scenario  = 'add_youtube' ;
				if (isset($_POST['ajax'])) {
				$videoModel->scenario ='add_youtube'; 
				echo CActiveForm::validate($videoModel);
				Yii::app()->end();
				}
				
				$request    = Yii::app()->request;
		 
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($videoModel->modelName, array()))) {
			  $videoModel->attributes = $attributes;
			  $videoModel->scenario  = 'add_youtube' ;
			 	  
				 $success = true;
				 $id = $featuredModel['id'];
				 try{
						
						$values =  "('{$id}','1')";
						$sql = "insert into  {{user_packages}} (id,used_ad) values {$values} ON DUPLICATE KEY UPDATE used_ad=used_ad+1";
						Yii::app()->db->createCommand($sql)->execute();
						 
						$message =   'Success'; $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('video'=>$videoModel->video));
				}
				catch(Exception $e){
					 $success = false;
					$message =   'Message: ' .$e->getMessage();
				}
				 
				$this->renderPartial('_add_video',compact('message','success')); 
				Yii::app()->end();
			 
			   
			 
		 
		}
				 if($_POST['video']){
				
				}
				else{
						$cs=Yii::app()->clientScript;
						$cs->scriptMap=array(
						'jquery.js'=>  false , 
						'jquery.min.js'=>    false , 
						);

						$this->renderPartial("_ad_video_form" , compact('model','videoModel'),false,true);  
						exit; 
				}
				
			 }
			 
		}
		 
		$this->renderPartial('_add_video',compact('message','success'));
		 
	}
   
        public function actionadd_featured($id=null){
		
		$model = PlaceAnAd::model()->findByPk($id);
		$success = false;
		if(!Yii::app()->user->getId()){
			$message = 'Session Timed Out!';
		}
		else if(empty($model)){
			$message = 'Property Not Exist!';
		}
		else{
		     $user = ListingUsers::model()->findByPk($model->user_id);
		     if(!empty($user->parent_user)){
		         $userid = $user->parent_user;
		         
		     }
		     else{
		          $userid = $user->user_id;
		     }
			 $featuredModel = PricePlanOrder::model()->getvalidateUserFeatured($userid );
		 
			 if(!empty($featuredModel)){
				 $success = true;
				 $id = $featuredModel->order_id;
				 $validity = 30;
				 try{
						
						$values =  "('{$id}','1')";
						$sql = "insert into  {{price_plan_order}} (order_id,featured_used) values {$values} ON DUPLICATE KEY UPDATE featured_used=featured_used+1";
						Yii::app()->db->createCommand($sql)->execute();
						if(!empty($validity)){
						$date = date('Y-m-d h:i:s',strtotime('+'.(int)$validity.' days',strtotime(date('Y-m-d h:i:s'))));
						}
						else{
						$date = null;
						}
						$message =   $this->tag->getTag('success','Success'); $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('featured_e'=>'1','f_status'=>'A','f_status'=>'A','f_e_d'=>$date));
						$oder = new FeaturedDate();
						$oder->ad_id = $model->id;
						$oder->order_id = $id;
						$oder->save(); 
				}
				catch(Exception $e){
					 $success = false;
					$message =   'Message: ' .$e->getMessage();
				}
				
			 }
			 else{
				 $message = $this->tag->getTag('subscribe_package','Subscribe Package');;
			 }
			 
		}
		 
		$this->renderPartial('_add_featured',compact('message','success'));
		 
	}
	public function actionMake_unfeature($id=null){
		
		$model = PlaceAnAd::model()->findByPk($id);
		$success = false;
		if(!Yii::app()->user->getId()){
			$message = 'Session Timed Out!';
		}
		else if(empty($model)){
			$message = 'Property Not Exist!';
		}
		else{
			 $user = ListingUsers::model()->findByPk($model->user_id);
			  if(!empty($user->parent_user)){
		         $userid = $user->parent_user;
		         
		     }
		     else{
		          $userid = $user->user_id;
		     }
			 $featuredModel = PricePlanOrder::model()->getvalidateUserFeatured($userid );
		 
			 if(!empty($featuredModel)){
				 $success = true;
				 $id = $featuredModel->order_id;
				 $validity = 30;
				 try{
						
						$values =  "('{$id}','0')";
						$sql = "insert into  {{price_plan_order}} (order_id,featured_used) values {$values} ON DUPLICATE KEY UPDATE featured_used=featured_used-1";
						Yii::app()->db->createCommand($sql)->execute();
						if(!empty($validity)){
						$date = date('Y-m-d h:i:s',strtotime('+'.(int)$validity.' days',strtotime(date('Y-m-d h:i:s'))));
						}
						else{
						$date = null;
						}
						$message =   $this->tag->getTag('success','Success'); $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('featured_e'=>'0','f_status'=>'I' ,'f_e_d'=>$date));
						$oder = new FeaturedDate();
						$oder->ad_id = $model->id;
						$oder->order_id = $id;
						$oder->f_type = 'U';
						$oder->save(); 
				}
				catch(Exception $e){
					 $success = false;
					$message =   'Message: ' .$e->getMessage();
				}
				
			 }
			 else{
						$message =   $this->tag->getTag('success','Success'); $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('featured_e'=>'0','f_status'=>'I'));
						
			 }
			 
		}
		 
		$this->renderPartial('_un_featured',compact('message','success'));
		 
	}
    public function actionadd_reset($id=null){
		
		$model = PlaceAnAd::model()->findByPk($id);
		$success = false;
		if(!Yii::app()->user->getId()){
			$message = 'Session Timed Out!';
		}
		else if(empty($model)){
			$message = 'Property Not Exist!';
		}
		else{
			 $featuredModel = $this->member->getvalidateUserCurrentPackage(4);
			 if(!empty($featuredModel) and isset($featuredModel['redirect'])){
				$message = $featuredModel['message'];
			 }
			 else if(!empty($featuredModel)){
				 $success = true;
				 $id = $featuredModel['id'];
				 $validity = $featuredModel['validity'];
				 try{
						
						$values =  "('{$id}','1')";
						$sql = "insert into  {{user_packages}} (id,used_ad) values {$values} ON DUPLICATE KEY UPDATE used_ad=used_ad+1";
						Yii::app()->db->createCommand($sql)->execute();
						$message =   'Success'; $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('last_updated'=>date('Y-m-d H:i:s')));
				}
				catch(Exception $e){
					 $success = false;
					$message =   'Message: ' .$e->getMessage();
				}
				
			 }
			 
		}
		 
		$this->renderPartial('_add_refresh',compact('message','success'));
		 
	}
 
    public function actionadd_package($id=null){
		
		$model = Package::model()->fetchPackage($id);
		$success = false;
		if(!Yii::app()->user->getId()){
			$message = 'Session Timed Out!';
		}
		else if(empty($model)){
			$message = 'Package Not Exist!';
		}
		else{
			$price_for_package =  $model->price_per_month; 
			$price_in_user_account =  $this->member->amount; 
			if(empty($price_in_user_account)){$price_in_user_account = 0; }
			if($price_in_user_account<$price_for_package){
				$message = 'Insufficient Balance!<br />Please Recharge';
			}
			else{
				$usageModel = new UserPackages();
				$usageModel->user_id = Yii::app()->user->getId();
				$usageModel->package_id = $model->primaryKey;
				$usageModel->ads_allowed = $model->max_listing_per_day;
				$usageModel->validity = $model->validity_in_days;
				$usageModel->amount = $model->price_per_month;
				$usageModel->category_id = $model->category;
				$usageModel->latest = 1;
				if($usageModel->save()){
					$this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
					
					$message = 'Package Activated!';$success = true;
				}
				else{
					$message = CHtml::errorSummary($usageModel);
				}
			}
		}
		 
		$this->renderPartial('_pakckage_response_ajax',compact('message','success'));
		//$this->renderPartial('_pakckage_activated');
		//$this->renderPartial('_no_sufficiet_balance');
	}
    
    public function actionOrders()
     {
         
         
         $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new PricePlanOrder('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
		$order->customer_id = Yii::app()->user->getId();
		$this->setData(array(
		'hooks'     =>   	  Yii::app()->hooks  , 
		));
		$title = 'Top Up Orders';
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app' ,$this->tag->getTag('my_orders','My Orders').'  |  {name} ', array('{name}' => $this->project_name )), 
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'create')
            )
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('orders', compact('order','title'));
         
    
        
    }
  
    public function actionTopup_options($show=null)
    { 
		
		 
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        if (!empty($user->parent_user)) {
            throw new CHttpException(404, Yii::t('app', 'You have no permission to add Top Up.'));
        } 
     
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Top-up','{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Top-up'),
            'pageMetaTitle' =>  Yii::t('trans','{title}',array('{title}'=>'Top-up','{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
        $this->render("top_up_options", compact('user','member'));
    }
    public function actionSubscribe_package($package_uid=null)
    { 
		
		 $session  = Yii::app()->session;
	//	$session->remove('promo_code');	
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        
        $packageModel     = Package::model()->findByUidFrontend($package_uid);
        
        if (empty($packageModel)) {
            throw new CHttpException(404, Yii::t('app', 'The requested package does not exist.'));
        } 
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        if (!empty($user->parent_user)) {
            throw new CHttpException(404, Yii::t('app', 'You have no permission to add Top Up.'));
        } 
     
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Place Order','{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Place Order'),
            'pageMetaTitle' =>  Yii::t('trans','{title}',array('{title}'=>$this->tag->getTag('subscribe','Subscribe'),'{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
		$session  = Yii::app()->session;
		$promoCode = $session->itemAt('promo_code');
        if (!empty($promoCode)) {
            $promoCodeModel = PricePlanPromoCode::model()->findByAttributes(array('code' => $promoCode));
        }
		$order   = new PricePlanOrder();
		$order->promo_code_id   = !empty($promoCodeModel) ? $promoCodeModel->promo_code_id : null;
		$order->customer_id   = $this->member->user_id;
		$order->plan_id         = $packageModel->primaryKey;
		$order->date_start         = date('d-m-Y');
		$order->calculate();
		
      $note = new PricePlanOrderNote();
      		$this->getData('pageScripts')->add(array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js'));
		$this->getData('pageScripts')->add(array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'));
		$this->getData('pageStyles')->add(array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css'));
        $this->render("place_order", compact('user','member','packageModel','order','note','package_uid'));
    }
    
    public function actionProcess_payment($payment=null,$package_uid)
    { 
		$session  = Yii::app()->session;
		
		 $packageModel     = Package::model()->findByUidFrontend($package_uid);
        
        if (empty($packageModel)) {
            throw new CHttpException(404, Yii::t('app', 'The requested package does not exist.'));
        } 
        if(isset($_POST['payment'])){$payment = $_POST['payment'];  }  
     
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
         $promoCode = $session->itemAt('promo_code');
        if (!empty($promoCode)) {
            $promoCodeModel = PricePlanPromoCode::model()->findByAttributes(array('code' => $promoCode));
        }
        $method = '';
        $account_details = '';
        if(empty($payment)) { $payment = 'b';}
        switch($payment){
			case 'e':
			$method = 'Easy Paisa';
			$account_details = Yii::app()->options->get('system.common.easy_paisa_account','');
			break;
			case 'b':
			$method = $this->tag->getTag('bank_transfer/cash','Bank transfer/Cash');
			$account_details = Yii::app()->options->get('system.common.bank_transfer_account','');
			break;
			case 'm':
			$method = $this->tag->getTag('master_card','Master Card');
			$account_details = '';
			break;
			default:
			throw new CHttpException(404, Yii::t('app', 'No Payment Method Selected.'));
			break;
		}
     
     
     
     
     $order   = new PricePlanOrder();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($order->modelName, array()))) {
            $itmSes = $session->itemAt('date_start',date('Y-m-d'));
            $order->attributes = $attributes;
            $session->add('date_start',$order->date_start);
            if(empty($order->date_start)){$order->date_start = $itmSes;  }
            $order->customer_id =  Yii::app()->user->getId();
             	 $order->promo_code_id   = !empty($promoCodeModel) ? $promoCodeModel->promo_code_id : null;
	
            $order->status =  'pending';
            if($payment=='m'){  $order->status =  'due'; }
            $order->payment_type = $payment;
            if (!$order->save()) {
             } else {
                $note = new PricePlanOrderNote();
                $note->attributes = (array)$request->getPost($note->modelName, array());
                $note->order_id   = $order->order_id;
                $note->customer_id    = Yii::app()->user->getId();
                $note->save();
                if($payment=='m'){ echo '<style>body{ display:none; }</style>';  $this->redirect(Yii::app()->createUrl('member/paymentgateway',array('order_uid'=>$order->order_uid))); }
                   $this->redirect(Yii::app()->createUrl('member/topup_success'));
              //  $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
                $this->redirect(array('member/topup_success'));
            }
        }

     
     	 $order->promo_code_id   = !empty($promoCodeModel) ? $promoCodeModel->promo_code_id : null;
		 $order->customer_id   = $this->member->user_id;
		$order->plan_id         = $packageModel->primaryKey;
		$order->calculate();
         $note = new PricePlanOrderNote('search');
   
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title} - {app}',array('{title}'=>'Payment','{app}'=>$this->project_name )), 
            'pageHeading'   => Yii::t('users', 'Top-up'),
            'pageMetaTitle' =>  Yii::t('trans','{title} - {app}',array('{title}'=>$this->tag->getTag('payment','Payment'),'{app}'=>$this->project_name )),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
        $this->render("payment", compact('user','member','account_details','method','payment','order', 'note','packageModel'));
    }
    public  $username;
    public  $password;
    public function actionpaymentgateway($order_uid=null)
    { 
        
         
	     $request = Yii::app()->request;
        $notify = Yii::app()->notify; 
		 $order   = PricePlanOrder::model()->findByAttributes(array(
            'order_uid'   => $order_uid,
            'customer_id' => (int)Yii::app()->user->getId(),
        ));
        
        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
         
        
        $SessionIndicatorModel = new SessionIndicator();
        if(isset($_GET['resultIndicator'])){
           $result =  SessionIndicator::model()->findByAttributes(array( 'order_uid'=>$order_uid , 'successIndicator'=>$_GET['resultIndicator']));
          if(!empty( $result)){
                        $order->status = PricePlanOrder::STATUS_COMPLETE;
                        $order->save();
                        $notify->addSuccess(Yii::t('app',$this->tag->getTag('succesfully_completed_your_pay', 'Succesfully completed your payment' ) ));
						$this->redirect(Yii::app()->createUrl('member/order_detail/order_uid/'.$order->order_uid));
           }
            
        }
      
	$note = new PricePlanOrderNote('search');
        $note->unsetAttributes();
        $note->attributes = (array)$request->getQuery($note->modelName, array());
        $note->order_id   = (int)$order->order_id;

        $transaction =  array();
        
        $this->setData(array(
            'hooks' => Yii::app()->hooks,
             'pageTitle' =>    Yii::t('trans','{title} - {app}',array('{title}'=>'Payment Gateway - Transaction','{app}'=>$this->project_name )), 
            'pageHeading'   => Yii::t('users', 'Payment Gateway - Transaction'),
            'pageMetaTitle' =>  Yii::t('trans','{title} - {app}',array('{title}'=>'Payment Gateway - Transaction','{app}'=>$this->project_name )),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
               
        
         
		$merchantId      = '550200021492'; 
		$this->username        = 'merchant.'.$merchantId ;
		$this->password        = '2ed0aaca7315c23ce813401404c74751';
		$orderId         = $order->primaryKey;
		$currency        = $order->currency->code;
		$checkoutJSUrl   =   'https://bsf.gateway.mastercard.com/checkout/version/57/checkout.js';
        $checkoutSessionUrl  = 'https://bsf.gateway.mastercard.com/api/rest/version/57/merchant/';
		$base_url_i          = 'https://nobrokerpropertyfinder.com/testpayment/';
		$gatewayUrl          =  $checkoutSessionUrl.$merchantId.'/session';
		$amount = $order->total;
	 
        $requestData = ['apiOperation' => 'CREATE_CHECKOUT_SESSION',
                        'interaction' => ['operation'=>'PURCHASE','returnUrl'=>Yii::app()->createAbsoluteUrl('member/paymentgateway',array('order_uid'=>$order->order_uid)) , 'locale' => 'en-US'],
                        'order' => [
                        "id"        => 'OrdID_'.$order->order_uid,
                        "reference" => 'OrdRef_'.$order->order_uid,
                        'amount'    =>  $amount,
                        "currency"  => $currency,
                        "description" =>"Order ID ".$order->order_uid
                        ],
                        "transaction"    => [  "reference"  => "TrxRef_".$order->order_uid    ] 
                        
                        ];
        $jsonRequest =  json_encode($requestData);
        $jsonResponse = $this->sendTransaction($jsonRequest, $gatewayUrl, 'POST', 'REST');
	    $jsonResponseArray = json_decode($jsonResponse, true)   ; 
	     
	   
	    if(isset($jsonResponseArray['result']) and $jsonResponseArray['result']=='SUCCESS'){
	                $session = $jsonResponseArray['session'];
	                $sessionId = $session['id'];
	                $sessionVersion = $session['version'];
	                $successIndicator = $jsonResponseArray['successIndicator'];
	                
	                $SessionIndicatorModel->order_uid =$order->order_uid; 
	                $SessionIndicatorModel->sessionVersion =$sessionVersion;
	                $SessionIndicatorModel->successIndicator = $successIndicator;
	                $SessionIndicatorModel->save();
	     }
        else{
            
				throw new Exception("Unable to set session identifier.Please try again");
        }
        $cancelUrl = Yii::app()->createAbsoluteUrl('member/order_detail/order_uid/'.$order->order_uid);
       echo '<style>body{ display:none; }</style>';
        $this->render("transaction", compact('order','note','member','checkoutJSUrl','checkoutSessionUrl','session','sessionId','sessionVersion','successIndicator','merchantId','orderId','currency','amount','cancelUrl'));
    }
    function initCurlObj($gatewayUrl)
    {
        $curlObj = curl_init();

       
         return $curlObj;
    }
    function sendTransaction($requestData, $gatewayUrl, $transactionType, $protocol = 'REST')
     {
        
        $username = $this->username;
        $password = $this->password;
        $curlObj =  $this->initCurlObj($gatewayUrl);
        curl_setopt($curlObj, CURLOPT_URL, $gatewayUrl);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, TRUE);
      
        $http_response_header = ($protocol === 'NVP') ? array("Content-Type: application/x-www-form-urlencoded;charset=UTF-8") : array("Content-Type: Application/json;charset=UTF-8");
        curl_setopt($curlObj, CURLOPT_CUSTOMREQUEST, $transactionType);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $requestData);
         
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array("Content-Length: " . strlen($requestData)));
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, $http_response_header);
       
      
        curl_setopt($curlObj, CURLOPT_USERPWD, $username . ":" . $password);  
 
        $jsonResponse = curl_exec($curlObj);
 
        if (curl_error($curlObj))
        {
            $jsonResponse = "CURL Error: " . curl_errno($curlObj) . " - " . curl_error($curlObj) . "-" . curl_getinfo($curlObj);
		}

        curl_close($curlObj);
		return $jsonResponse;
         
    } 
    public function actionTopup_success($show=null)
    { 
		
		 
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
     
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Success','{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Top-up'),
            'pageMetaTitle' =>  Yii::t('trans','{title} | {app}',array('{title}'=>$this->tag->getTag('success','Success'),'{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
        $this->render("top_up_success", compact('user','member'));
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
              $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/dropzone.min.js')));
        			 
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
        $this->redirect(Yii::App()->CreateUrl('user/update_profile')); 
	   $notify = Yii::app()->notify;
	    $user =   $this->member;
	   /*
	    if(!$user->FillPersonalInformation){
			$this->redirect($this->app->createUrl('member/dashboard',array('slug'=>$user->slug)));
			Yii::app()->end();
		}
	     
	    if(in_array(Yii::app()->user->user_type,array('C','A'))){
			if(Yii::app()->user->user_type=='C'){
				$model = Agencies::model()->findByPk(Yii::app()->user->getId());
				$scenario = 'agent_update1'; 
			}
			else{
			$model = Agents::model()->findByPk(Yii::app()->user->getId());
			
		 
			$scenario = 'agent_update1'; 
			}
		}
		else if(Yii::app()->user->user_type=='D'){
			$model = Developer::model()->findByPk(Yii::app()->user->getId());
			$scenario = 'developer_update1'; 
			 
		}*/
		$scenario = 'new_update';
		$model = ListingUsers::model()->findByPk(Yii::app()->user->getId());
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
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/dropzone.min.js') ));
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
         $model->user_id  =  (int) Yii::app()->user->getId();
         $title = $this->tag->getTag('my_favourite__list','My Favorite List');
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'My Favorites', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            
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
    
         public function actionEnquiry_user()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new SendEnquiry2('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->requested_by  =  Yii::app()->user->getId();
         $title = $this->tag->getTag('enquiries', 'Enquiries') ; 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
	
        $hooks = Yii::app()->hooks;
        $this->render('enq_list_user', compact('model','title','s','hooks'));
    }
         public function actionValuation()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new PropertyValuation('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  (int)Yii::app()->user->getId();
         $title =  $this->tag->getTag('property_valuation','Property Valuation'); 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        
        $hooks = Yii::app()->hooks;
        $this->render('valuation', compact('model','title','s','hooks'));
    }
         public function actionMortgage()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new ApplyLoan('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  (int)Yii::app()->user->getId();
         $title = $this->tag->gettag('mortgage', 'Mortgage') ; 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        
        $hooks = Yii::app()->hooks;
        $this->render('mortgage', compact('model','title','s','hooks'));
    }
         public function actionInsurance()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new InsuranceForm1('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  (int)Yii::app()->user->getId();
         $title = $this->tag->getTag('home_insurance', 'Home Insurance'); 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        
        $hooks = Yii::app()->hooks;
        $this->render('insurance', compact('model','title','s','hooks'));
    }
         public function actionEnquiry()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new SendEnquiry2('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  Yii::app()->user->getId();
         $title = $this->tag->getTag('inquiries', 'Inquiries') ; 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
	
        $hooks = Yii::app()->hooks;
        $this->render('enq_list', compact('model','title','s','hooks'));
    }
  
    public function actionAgent_enquiry()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new ContactAgent('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  = (int) Yii::app()->user->getId();
         $title =  $this->tag->getTag('inquiries','Inquiries' ); 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s}  :: {name} ', array('{name}' => $this->member->company_name .'@'.$this->project_name,'{s}'=> $title  )), 
            
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
	
        $hooks = Yii::app()->hooks;
        $this->render('enq_list_agent', compact('model','title','s','hooks'));
    }
      public function actionEnq_view($id=null)
    {
		 
        $criteria = SendEnquiry2::model()->search(1);
        
   
        $criteria->compare('t.id',$id);
        //$criteria->compare('t.user_id',$this->app->user->getId());
        	$criteria->condition .= ' and CASE WHEN t.ad_id IS NOT NULL THEN  (usr2.user_id =:user_id  ) ELSE t.user_id =:user_id END  ';
			$criteria->params[':user_id'] = $this->app->user->getId() ; 
        $model = SendEnquiry2::model()->find( $criteria);
      
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
        $this->renderPartial('enq_view', compact('model'));
    }
     public function actionEnq_agent_view($id=null)
    {
		 
		 
        $criteria = ContactAgent::model()->search(1);
        $criteria->compare('t.id',$id);
        	$criteria->condition .= ' and  ( usr.user_id = :me  )   ';
			 $criteria->params[':me'] = $this->app->user->getId() ;; 
        $model = ContactAgent::model()->find( $criteria);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
         
        $this->renderPartial('enq_view_agent', compact('model'));
    }
    
     public function actionDelete_agent_enq($id=null)
    {
           $criteria = ContactAgent::model()->search(1);
        $criteria->compare('t.id',$id);
        	$criteria->condition .= ' and  ( usr.user_id = :me   )   ';
			 $criteria->params[':me'] = $this->app->user->getId() ;; 
        $model = ContactAgent::model()->find( $criteria);
        
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $model->delete();    

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', Yii::App()->createUrl('member/enquiry')));
        }
    }
     public function actionDelete_enq($id=null)
    {
        $m = new SendEnquiry2();
        $m->user_id   = $this->app->user->getId();
        $criteria = $m->search(1);
        $criteria->compare('t.id',$id);
        // $criteria->compare('t.user_id',$this->app->user->getId());
        
                	$criteria->condition .= ' and CASE WHEN t.ad_id IS NOT NULL THEN  (usr2.user_id =:user_id  ) ELSE t.user_id =:user_id END  ';
			$criteria->params[':user_id'] = $this->app->user->getId() ; 
			
        $model = SendEnquiry2::model()->find( $criteria);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $model->delete();    

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', Yii::App()->createUrl('member/enquiry')));
        }
    }
   public function actionChange_details()
    {
		$userModel = Yii::app()->user->getModel();
        $notify   = Yii::app()->notify ; 
        $request  = Yii::app()->request ;  
		if(empty($userModel)){
			 throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		
			 
		}
		
		 
		$contact =   new UserDetailsChange();  ;
		$images  = array();  
		$contact->user_id = $userModel->user_id; 
			if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($contact);
		Yii::app()->end();
		}
			if ($request->isPostRequest && ($attributes = (array)$request->getPost($contact->modelName, array()))) {
		    
			  $contact->attributes = $attributes;
			  $contact->user_id = Yii::App()->user->getId();
			  
			  
			   
			  
			  if(!$contact->save()){
			      $notify->addError(Yii::t('app', 'Error !! Failed to update  contact details.'));
				  //echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				 // Yii::app()->end();
			  }
			  else{
			       $notify->addError(Yii::t('app', 'Success !! Successfully  updated  contact details.'));
			       $this->redirect('member/dshboard');
				  //echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				 // Yii::app()->end();
			  }
		 
		}
		/*
		  $cs=Yii::app()->clientScript;
		$cs->scriptMap=array(
		'jquery.js'=>  false , 
		'jquery.min.js'=>    false , 
		);
	    */
	    $this->no_header = '1'; $this->secure_header='1';
	    	$this->setData(array(
                    'pageMetaTitle'         => Yii::t('app', '{name} | {p}', array('{name}' =>  'Change Contact Details'   ,'{p}'=>$this->project_name)), 
                    'pageMetaDescription'   => Yii::app()->params['description'],
                ));	
        $this->render("//member/_Change_details" , compact('userModel','contact'),false,true);  
       
    }
    public function actionValidatechange(){
		$model = new UserDetailsChange;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSubmitDetails(){
		$request    = Yii::app()->request;
		$model  = new UserDetailsChange();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
		    print_r($_POST);exit; 
			  $model->attributes = $attributes;
			  $model->user_id = Yii::App()->user->getId();
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
	 public function actionUpgrade_account(){
		 $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
       if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $notify = Yii::app()->notify;
        $user->updateByPk($user->user_id,array('user_type'=>'P'));
        Yii::app()->user->setState('user_type','P');
        $notify->addSuccess(Yii::t('app','Your account successfully upgraded as Seller Account'));
        $this->redirect(Yii::app()->createUrl('member/dashboard'));
	 }
    
	 public function actionUpdate_profile()
    {
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
       if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        if  ( $user->o_verified !='1' ) {
           //  $this->redirect(Yii::app()->createUrl('user/otp_verify'));
         }
        $user->scenario ='update_profile';
        if(!empty($user->parent_user)){
            //echo'3';exit;
			$user->scenario ='update_profile_agent';
        }
		 
        
        $text = $this->tag->getTag('successfully_updated_profile!','Successfully updated Profile!');
        if(isset($_POST['module']) and $_POST['module']=='change_password'){
                 $user->scenario ='updatepassword';
                 $text =  $this->tag->getTag('successfully_updated_password','Successfully updated password');
        }
         if(isset($_POST['module']) and $_POST['module']=='change_phone'){
                 $user->scenario ='change_phone';
                 $text =  'Successfully updated phone';
        }
        if(isset($_POST['module']) and $_POST['module']=='change_email'){
                 $user->scenario ='change_email';
                 $text =  'Successfully updated email';
        }
        if(isset($_POST['module']) and $_POST['module']=='change_name'){
                 $user->scenario ='change_name';
                 $text =  $this->tag->getTag('successfully_updated_name','Successfully updated name');
        }
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
          
            if (!$user->save()) {
                
                $notify->addError(Yii::t('app', 'Please fix your form errors!'));
            } else {
                      
                     $notify->addSuccess(Yii::t('app',$text));
                      if( $user->scenario=='update_profile'){
                              $user->updateByPk($user->user_id,array('u_p'=>'1'));
                              $this->redirect(Yii::app()->createUrl('member/dashboard'));
                        }
                        else if( $user->scenario=='change_phone'){
                                    $user->updateByPk($user->user_id,array('full_number'=>$user->full_number,'phone'=>Yii::t('app',$user->phone,array(' '=>''))  ,'o_verified'=>'0' ));
                                     $this->redirect(Yii::app()->createUrl('member/dashboard'));
                        }
                         else if( $user->scenario=='change_email'){
                                    $user->verification_code = $user->generatePIN(6);
                                    
                                     $user->updateByPk($user->user_id,array( 'email_verified'=>'0','verification_code'=>$user->verification_code , 'v_send_at'=>date('Y-m-d H:i:s') ));
                                    	 
                                     $user->sendVerificationEmail();
                                     $this->redirect(Yii::app()->createUrl('member/dashboard'));
                        }
                        else{
                            $this->refresh();
                            
                        }
			        
			      
            }
        }
     
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>$this->tag->gettag('update_profile','Update Profile'),'{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Please login'),
            'pageMetaTitle' =>  Yii::t('trans','{title}',array('{title}'=>$this->tag->gettag('update_profile','Update Profile'),'{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/dropzone.min.js') ));
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/dropzone.css')));
		
	 
		$member = $this->member ; 
        $this->render("//user/update_profile", compact('user','member'));
    }
      public function actionStatistics($show=null)
    { 
        
	   $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{st} -  {name} ', array('{st}'=>$this->tag->getTag('statistics','Statistics'),'{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'Statistics'),
            'pageMetaDescription'   => Yii::app()->params['description'],
        ));
		$notify = Yii::app()->notify;
		$user =  $this->member;
	 
	    $total_call_count = Statistics::model()->callCount();
	    if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }
	    
	    $total_page_count = StatisticsPage::model()->pageCount();
	    if(!empty($total_page_count)){ $total_page_count  = $total_page_count->s_count; }else{ $total_page_count  = 0; }
	    
	    $total_mail_count = Statistics::model()->mailCount();
	    if(!empty($total_mail_count)){ $total_mail_count  = $total_mail_count->s_count; }else{ $total_mail_count  = 0; }
	    
	    
	    $total_call_count_today = Statistics::model()->callCount($duration='today');
	    if(!empty($total_call_count_today)){ $total_call_count_today  = $total_call_count_today->s_count; }else{ $total_call_count_today  = 0; }
	    $t_date = $this->converToTz(date('Y-m-d h:i:s'),'Asia/Karachi','UTC','Y-m-d');
			
		 
	    $thirty_call_count_today = Statistics::model()->callCount($duration='30day');
	    if(!empty($thirty_call_count_today)){ $thirty_call_count_today  = $thirty_call_count_today->s_count; }else{ $thirty_call_count_today  = 0; }
	  
	    
	     $total_mail_count_today = Statistics::model()->mailCount($duration='today');
	    if(!empty($total_mail_count_today)){ $total_mail_count_today  = $total_mail_count_today->s_count; }else{ $total_mail_count_today  = 0; }
	   
	     $total_mail_count_thirty = Statistics::model()->mailCount($duration='30day');
	    if(!empty($total_mail_count_thirty)){ $total_mail_count_thirty  = $total_mail_count_thirty->s_count; }else{ $total_mail_count_thirty  = 0; }
	   
	     $total_page_count_today = StatisticsPage::model()->pageCount('today');
	    if(!empty($total_page_count_today)){ $total_page_count_today  = $total_page_count_today->s_count; }else{ $total_page_count_today  = 0; }
	 
	     $total_page_count_thirty = StatisticsPage::model()->pageCount('30day');
	    if(!empty($total_page_count_thirty)){ $total_page_count_thirty  = $total_page_count_thirty->s_count; }else{ $total_page_count_thirty  = 0; }
	 
	    $pageCountByProperty = StatisticsPage::model()->pageCountByProperty();
	    $emailCountByProperty = Statistics::model()->clickCountByProperty('E');
	    $callCountByProperty = Statistics::model()->clickCountByProperty('C');
	     
	     
	    
		$premium_downloads = 0;
		$TotalDownloadCount =  0 ; 
		$TotalInvoices  = (int) 0 ; 
        $this->render("statistics",compact("user",'total_call_count' ,'total_page_count','total_mail_count','total_call_count_today','thirty_call_count_today','total_mail_count_today','total_mail_count_thirty','total_page_count_today','total_page_count_thirty','pageCountByProperty','emailCountByProperty','callCountByProperty'));
	}
     public function actionActivate_ad($id=null)
    {
        $model = PlaceAnAd::model()->findByAttributes(array('id'=>base64_decode($id),'user_id'=>$this->app->user->getId()));
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($model->id,array('extended_on'=>date('Y-m-d h:i:s'),'n_send_at'=>NULL));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
          $notify->addSuccess(Yii::t('app', 'Successfully reactivated your property!'));
        $this->redirect(Yii::app()->createUrl('member/dashboard'));
    }
    public function actionlist_agents($status=null,$s=null)
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new ListingUserAgent('serach');
		 $this->member->ListAgentPermission;/* checking Permission*/
        $model->attributes = (array)$request->getQuery($model->modelName, array());
           $model->parent_user = (int)  Yii::app()->user->getId();
            $model->show_full ='1'; 
         $title = $this->tag->getTag('list_users','List Users') ;
      
         $this->setData(array(
         'hooks'     =>   	  Yii::app()->hooks  , 
            'pageMetaTitle'     => $this->tag->gettag('list_users','List Users') , 
            'pageBreadcrumbs'   => array(
                Yii::t('local_hire', 'Free Bites') => $this->createUrl('free_bites/index'),
                Yii::t('app', 'create')
            )
        ));
      
        $this->render('list_agents', compact('model','title','s'));
    }
    public function actionAdd_agent($id=null)
    {
		
	 
        ini_set('memory_limit', '-1');
		 $this->member->ListAgentPermission;/* checking Permission*/
      
        if($id){
			 $model = ListingUserAgent::model()->findByAttributes(array('user_id'=>(int) $id ,'parent_user' => (int) Yii::app()->user->getId() ));
			if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			 $model->scenario = 'new_update';
			  // $model->scenario = 'multiple_agent_u' ;  
			  if(!$request->isPostRequest) { $model->password = ''; }
		}
		else{
			 $model = new ListingUserAgent();
			   $model->scenario = 'new_front_insert';
			    $this->member->ValidateAgentsCreated;  /* validating listing quota */
		}
        $model->user_type = 'A';
        $notify = Yii::app()->notify;
        $request = Yii::app()->request;
        
      $model->validatorList->add(
		CValidator::createValidator('required', $model, 'role_id', array( 'message'=>$this->tag->gettag('required','Required')))
	);
     $model->validatorList->add(
		CValidator::createValidator('required', $model, 'user_status', array( 'message'=>$this->tag->gettag('required','Required')))
	);
		 
	   if(empty($model->image)){
		$model->image = $this->member->image;
	}
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
          
        if ($request->isPostRequest  ) {
			 
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
			if($model->image == $this->member->image){
			    $model->image = '';
			}
	 
			 	//$model->email_verified = '1';
				$model->filled_info = '1';
				$model->status = 'A';
				//$model->full_number = $model->phone;
				$model->parent_user = (int) Yii::app()->user->getId();
			 
			//$model->status='N';
            //$model->verification_code = md5(uniqid(rand(), true));
            if ($model->save()) {
				
							$notify->addSuccess(Yii::t('app', $this->tag->gettag('agent_details_has_been_success','Agent Details has been successfully saved!')));
							$this->redirect(Yii::app()->createUrl('member/list_agents'));
						 
           }
           else
           {
			  
			   	$notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
		   }
           
	    }
	    $apps = Yii::app()->apps; 
		$this->getData('pageStyles')->add(array('src' =>  $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' =>  $apps->getBaseUrl('assets/js/select2.min.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/reg_typ.js?q=19')));
        $this->setData(array(
            'pageMetaTitle'     => $this->tag->gettag('add_agent','Add Agent') , 
            'pageTitle' =>    Yii::t('trans','{title} | {app}',array('{title}'=>'Add Agent','{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Please login'),
              
        ));
  
      
        $this->render( 'add_agent' , compact('model','user','id'));
	}
	
	public function actionUser_deativate($id=null)
    {
       	 $model = ListingUserAgent::model()->findByAttributes(array('user_id'=>(int) $id ,'parent_user' => (int) Yii::app()->user->getId() ));
		
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
         $model->updateByPk($model->user_id ,array('user_status'=>'I'));    
         echo json_encode(array('status'=>'1','message'=>'Successfully Deactivated','href'=>Yii::app()->createUrl('member/list_agents')));exit;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
	public function actionUser_ativate($id=null)
    {
       	 $model = ListingUserAgent::model()->findByAttributes(array('user_id'=>(int) $id ,'parent_user' => (int) Yii::app()->user->getId() ));
		
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
         $model->updateByPk($model->user_id ,array('user_status'=>'A'));    
         echo json_encode(array('status'=>'1','message'=>'Successfully Activated','href'=>Yii::app()->createUrl('member/list_agents')));exit;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionUser_reset_password($id=null)
    {
	 
			 $model = ListingUserAgent::model()->findByAttributes(array('user_id'=>(int) $id ,'parent_user' => (int) Yii::app()->user->getId() ));
			if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$model->scenario = 'updatepasswordu'; 
		 
        $notify = Yii::app()->notify;
        $request = Yii::app()->request;
        if(!$request->isPostRequest) { $model->password = ''; }
   
	 
        if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
          
        if ($request->isPostRequest  ) {
			 
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
			
	  
            if ($model->save()) {
				
							$notify->addSuccess(Yii::t('app', 'Password Reseted!'));
							$this->redirect(Yii::app()->createUrl('member/list_agents'));
						 
           }
           else
           {
			    
			  
			   	$notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
		   }
           
	    }
	    $apps = Yii::app()->apps; 
        $this->setData(array(
            'pageTitle' =>    Yii::t('trans','{title} | {app}',array('{title}'=>'User Reset Passord','{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', 'Please login'),
              
        ));
  
      
        $this->render( 'reset_password_agent' , compact('model','user','id'));
	}
	public function actionTerminate($order_uid=null)
    {
        $model = PricePlanOrder::model()->findByAttributes(array('order_uid'=>$order_uid,'customer_id'=>$this->app->user->getId()));
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
         $model->updateByPk($model->order_id ,array('status'=>PricePlanOrder::STATUS_TERMINATE));    
         echo json_encode(array('status'=>'1','message'=>'Successfully Terminated Your Package','href'=>Yii::app()->createUrl('member/order_detail',array('order_uid'=>$model->order_uid))));exit;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
	public function actionUnpublish($id=null)
    {
		$criteria=new CDbCriteria;
		$criteria->condition =  '1';
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->condition .=  ' and t.id = :id and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
		$criteria->params[':id']  = (int) $id;
		$criteria->params[':owner']  = (int) Yii::App()->user->getId();
		$model =   PlaceAnAd::model()->find($criteria);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
         $model->updateByPk($model->id ,array('status'=>'I','HandoverDate'=>date('Y-m-d')));    
         echo json_encode(array('status'=>'1','message'=>'Successfully Unpublished Your Property','href'=>Yii::app()->createUrl('place_an_ad/index')));exit;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
	public function actionRemove_property($id=null)
    {
		$criteria=new CDbCriteria;
		$criteria->condition =  '1';
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->condition .=  ' and t.id = :id and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
		$criteria->params[':id']  = (int) $id;
		$criteria->params[':owner']  = (int) Yii::App()->user->getId();
		$model =   PlaceAnAd::model()->find($criteria);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
         $model->updateByPk($model->id ,array('isTrash'=>'1'));    
         echo json_encode(array('status'=>'1','message'=>'Successfully Deleted Your Property','href'=>Yii::app()->createUrl('place_an_ad/index')));exit;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
	public function actionOrder_detail($order_uid)
    {
        $request = Yii::app()->request;
        $order   = PricePlanOrder::model()->findByAttributes(array(
            'order_uid'   => $order_uid,
            'customer_id' => (int)Yii::app()->user->getId(),
        ));
        
        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $note = new PricePlanOrderNote('search');
        $note->unsetAttributes();
        $note->attributes = (array)$request->getQuery($note->modelName, array());
        $note->order_id   = (int)$order->order_id;

        $transaction =  array();
        
        $this->setData(array(
			'hooks'     =>   	  Yii::app()->hooks  ,
            'pageMetaTitle'     => Yii::t('orders', $this->tag->getTag('view_your_order','View your order').' | '.$this->project_name),
            'pageHeading'       => Yii::t('orders', 'View your order'),
            'pageBreadcrumbs'   => array(
                Yii::t('price_plans', 'Price plans') => $this->createUrl('price_plans/index'),
                Yii::t('orders', 'Orders') => $this->createUrl('price_plans/orders'),
                Yii::t('app', 'View')
            )
        ));
        
        $this->render('order_detail', compact('order', 'note', 'transaction'));
    }
    public function actionMark_as_sold($id=null)
    {
		 $request = Yii::app()->request;
       $notify = Yii::app()->notify;
        
        if ($request->isAjaxRequest) {
		$criteria=new CDbCriteria;
		$criteria->condition =  '1';
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$q   = PlaceAnAd::model()->getFetauredQuery();  $q = rtrim($q,',');
		$criteria->select = 't.*,'.$q;  
		$criteria->condition .=  ' and t.id = :id and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
		$criteria->params[':id']  = (int) $id;
		$criteria->params[':owner']  = (int) Yii::App()->user->getId();
		$model =   PlaceAnAd::model()->find($criteria);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
       if($model->featured2=='Y' and $model->featured != 'Y'){
             $user = ListingUsers::model()->findByPk($model->user_id);
			  if(!empty($user->parent_user)){
		         $userid = $user->parent_user;
		         
		     }
		     else{
		          $userid = $user->user_id;
		     }
			 $featuredModel = PricePlanOrder::model()->getvalidateUserFeatured($userid );
			 if(!empty($featuredModel)){
				 $success = true;
				 $id = $featuredModel->order_id;
				 $validity = 30;
				 try{
						
						$values =  "('{$id}','0')";
						$sql = "insert into  {{price_plan_order}} (order_id,featured_used) values {$values} ON DUPLICATE KEY UPDATE featured_used=featured_used-1";
						Yii::app()->db->createCommand($sql)->execute();
						if(!empty($validity)){
						$date = date('Y-m-d h:i:s',strtotime('+'.(int)$validity.' days',strtotime(date('Y-m-d h:i:s'))));
						}
						else{
						$date = null;
						}
						$message =   $this->tag->getTag('success','Success'); $success = true;
						PlaceAnAd::model()->updateByPk($model->id,array('featured_e'=>'0','f_status'=>'I' ,'f_e_d'=>$date));
						$oder = new FeaturedDate();
						$oder->ad_id = $model->id;
						$oder->order_id = $id;
						$oder->f_type = 'U';
						$oder->save(); 
				}
				catch(Exception $e){
					 
				}
				
			 }
       }
        
        
         $model->updateByPk($model->id ,array('property_status'=>'1'));
         if($model->section_id=='1'){ $msg = 'Successfully marked as Sold'; }else{ $msg = 'Successfully marked as Leased';  }    
         echo json_encode(array('status'=>'1','message'=>$msg,'href'=>Yii::app()->createUrl('place_an_ad/index')));exit;

        
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
         }
    }
    
     public function actionApplycode($return=null)
    {
	    ini_set('memory_limit', '-1');
		$this->no_header = '1'; 
        $model = new PricePlanPromoCode();
        $model->scenario ='applycode';
          
        $request = Yii::app()->request;
        if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		 
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
			 
            $model->attributes = $attributes;
            if ($model->validate()) { 
            }
        }
          
        $this->setData(array(
            'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Sign In')), 
            'pageHeading'   => Yii::t('users', 'Please login'),
            'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
        ));
       
        $this->render("applycode" , compact('model','user','return'));  
       
    }
     public function actionApplycode_offer($return=null)
    {
	    ini_set('memory_limit', '-1');
		$this->no_header = '1'; 
        $model = new PricePlanPromoCode();
        $model->scenario ='applycodeoffer';
          $notify = Yii::app()->notify;
        $request = Yii::app()->request;
        if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		 
       if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
			 
            $model->attributes = $attributes;
            if ($model->validate()) { 
				
				$criteria = new CDbCriteria();
				$criteria->compare('code', $model->code);
				$criteria->compare('status', PricePlanPromoCode::STATUS_ACTIVE);
				$criteria->addCondition('date_start <= NOW() AND date_end >= NOW()');
				$criteria->condition .= ' and t.plan_id is not null ';
				$promoCodeModel = PricePlanPromoCode::model()->find($criteria);
         
				if($promoCodeModel){
					$PricePlanOrder = new PricePlanOrder();
					$PricePlanOrder->customer_id =  (int) Yii::App()->user->getId();
					$PricePlanOrder->status =  PricePlanOrder::STATUS_COMPLETE;
					$PricePlanOrder->plan_id = $promoCodeModel->plan_id;
					$PricePlanOrder->promo_code_id = $promoCodeModel->primaryKey;
					$PricePlanOrder->payment_type =  'o';
					$PricePlanOrder->is_offer =  '1';
					if ( !$PricePlanOrder->save() ){
					   	 $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		
					}
					else{
						$this->redirect(Yii::app()->createUrl('member/promocde_applied',array('success'=>base64_encode($promoCodeModel->promo_code_id)))) ;
					
					}
				}
            }
        }
      
        $this->setData(array(
            'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Enter Promotion Code')), 
            'pageHeading'   => Yii::t('users', 'Please login'),
            'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
        ));
       
        $this->render("applycode2" , compact('model','user','return'));  
       
    }
     public function actionPromocde_applied($success=null)
    {
	    ini_set('memory_limit', '-1');
		$this->no_header = '1'; 
        $criteria = new CDbCriteria();
				$criteria->compare('promo_code_id', base64_decode($success));
				$criteria->compare('status', PricePlanPromoCode::STATUS_ACTIVE);
				$criteria->addCondition('date_start <= NOW() AND date_end >= NOW()');
				$criteria->condition .= ' and t.plan_id is not null ';
				$promoCodeModel = PricePlanPromoCode::model()->find($criteria);
         $message = $promoCodeModel->OfferTitle ; 
        $this->setData(array(
            'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>'Promotion Code Applied')), 
            'pageHeading'   => Yii::t('users', 'Please login'),
            'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
        ));
       
        $this->render("promocode_applied" , compact('model','user','return','message'));  
       
    }
    public function actionApplycode_offernew(){
		$request    = Yii::app()->request; 
		$model  = new PricePlanPromoCode();
		$model->scenario = 'applycodeoffer';echo "WREWER";exit; 
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  
            if ($model->validate()) { 
				
				$criteria = new CDbCriteria();
				$criteria->compare('code', $model->code);
				$criteria->compare('status', PricePlanPromoCode::STATUS_ACTIVE);
				$criteria->addCondition('date_start <= NOW() AND date_end >= NOW()');
				$criteria->condition .= ' and t.plan_id is not null ';
				$promoCodeModel = PricePlanPromoCode::model()->find($criteria);
  
				if($promoCodeModel){
					$PricePlanOrder = new PricePlanOrder();
					$PricePlanOrder->customer_id =  (int) Yii::App()->user->getId();
					$PricePlanOrder->status =  PricePlanOrder::STATUS_COMPLETE;
					$PricePlanOrder->plan_id = $promoCodeModel->plan_id;
					$PricePlanOrder->promo_code_id = $promoCodeModel->primaryKey;
					$PricePlanOrder->payment_type =  'b';
					if ( !$PricePlanOrder->save() ){
					   		  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
		
					}
					else{
						 echo json_encode(array('status'=>'1','id'=>    $PricePlanOrder->promo_code_id , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
					
					}
				}
            }
		 
		}
	}
    public function actionBook_an_appointment($package_uid=null)
    { 
		  $model = new Book_an_appointment();
   if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		 $packageModel     = Package::model()->findByUidFrontend($package_uid);
        
        if (empty($packageModel)) {
            throw new CHttpException(404, Yii::t('app', 'The requested package does not exist.'));
        } 
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        $model->name = $user->first_name.' '.$user->last_name;
        $model->email = $user->email ;
        $model->phone_false =  $user->full_number ;
        
         if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		
		$model->attributes = $attributes;
		if($model->save())
		{
		    	
				   $this->redirect(Yii::app()->CreateUrl('member/book_appointment_success')) ;
					 
					 
		}
		else
		{
		 print_r($model->getErrors());exit;
		   $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		}
	    }
         
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title} - {app}',array('{title}'=>'Book an appointment','{app}'=>$this->project_name )), 
            'pageHeading'   => Yii::t('users', 'Top-up'),
            'pageMetaTitle' =>  Yii::t('trans','{title} - {app}',array('{title}'=>$this->tag->getTag('book_an_appointment','Book an appointment'),'{app}'=>$this->project_name )),
        )); $apps = Yii::app()->apps; 
	 	 
	 $this->no_header = '1'; $this->secure_header = '1';$this->layout = 'main';
        $this->render('book_appointment', compact('user','member','account_details','method','payment','order', 'note','packageModel','model','package_uid'));
    }
    public function actionbook_appointment_success($show=null)
    { 
		
		 
      
		$this->no_header = '1'; $this->secure_header = '1';
	    if(!Yii::app()->user->getId()){  $this->redirect(Yii::app()->createUrl('user/signin'));    }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
     
        $this->setData(array(
             'pageTitle' =>    Yii::t('trans','{title}',array('{title}'=>$this->tag->getTag('book_an_appointment','Book an appointment'),'{app}'=>$this->project_name)), 
            'pageHeading'   => Yii::t('users', $this->tag->getTag('book_an_appointment','Book an appointment')),
            'pageMetaTitle' =>  Yii::t('trans','{title} | {app}',array('{title}'=>$this->tag->getTag('book_an_appointment','Book an appointment'),'{app}'=>$this->project_name)),
        )); $apps = Yii::app()->apps; 
	 	 
		$member = $this->member ; 
        $this->render("book_appointment_success", compact('user','member'));
    }
         public function actionBookings()
     {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new Book_an_appointment('serach');
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  =  Yii::app()->user->getId();
         $title = $this->tag->getTag('book_an_appointments', 'Book an appointments') ; 
         
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{s} | {name} ', array('{name}' => $this->project_name,'{s}'=> $title  )), 
            
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
	
        $hooks = Yii::app()->hooks;
        $this->render('book_list', compact('model','title','s','hooks'));
    }
    public function actionUpdate_pdf($uid=0,$u_contract){
		$user = PricePlanOrder::model()->findByAttributes(array('order_uid'=>$uid));
        if (empty($user)) {
            echo json_encode(array('status'=>'0'));exit;
        }
        $notify = Yii::app()->notify;
        $user->updateByPk($user->order_id,array('u_contract'=>$u_contract));
         echo json_encode(array('status'=>'1'));exit;
         
	 }
	 public function actionremove_pdf($uid=0){
		$user = PricePlanOrder::model()->findByAttributes(array('order_uid'=>$uid));
        if (empty($user)) {
            echo json_encode(array('status'=>'0'));exit;
        }
        $notify = Yii::app()->notify;
        $user->updateByPk($user->order_id,array('u_contract'=>''));
         echo json_encode(array('status'=>'1'));exit;
         
	 }
     public function actionBulk_action_exchange()
    {
		
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        $user_id = $request->getPost('status');
       
        $user_model = ListingUserAgent::model()->findByAttributes(array('user_id'=>(int) $user_id ,'parent_user' => (int) Yii::app()->user->getId() ));
		if (empty($user_model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        if ($action == '' && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk((int)$item);
                if(!$customer){
					continue;
				}
				//echo $customer->id;echo "<br />";
				 
                $customer->updateByPk($item,array('user_id'=>$user_id));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }   
        $defaultReturn = $request->getServer('HTTP_REFERER', array('place_an_ad/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
}
