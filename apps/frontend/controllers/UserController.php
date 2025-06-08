<?php defined('MW_PATH') || exit('No direct script access allowed');


class UserController extends Controller
{

	// public $layout = 'sub_account';
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xC4DBFF,
				'foreColor' => 0xffffff,
				'height' => 32,
				'width' => 130,
				'testLimit' => 1,
				'offset' => 3
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}
	public function  Init()
	{
		parent::Init();
	}
	public function  beforeAction($action)
	{
		if (Yii::app()->user->getId() and !in_array($action->id, array('logout', 'signin', 'emailverify', 'impersonate', 'removeaccount'))) {
			$user = Yii::app()->user->getModel();
			if (!empty($user->f_type)) {
				$this->redirect(Yii::app()->createUrl('member/dashboard', array('slug' => $user->slug)));
			}
		}
		return parent::beforeAction($action);
	}
	/**
	 * Display the login form so that a guest can login and become an administrator
	 */
	public function actionSignupajax($return = null, $short_signup = false)
	{
		if ($this->app->user->getId() and !$this->app->request->isAjaxRequest) {
			$this->redirect(Yii::App()->createUrl('user/my_profile'));
		}
		$model = new ListingUsers();
		$user = new UserLogin();
		$request = Yii::app()->request;
		$model->scenario = 'frontend_insert';
		if ($request->isPostRequest) {

			$attributes =  (array)$request->getPost($model->modelName, array());
			$model->attributes = $attributes;
			$model->status = 'A';
			$model->verification_code = md5(uniqid(rand(), true));
			if ($model->save()) {
				$user->password = $model->con_password;
				$user->email    = $model->email;
				$message = '';
				$class = '';
				if ($user->validate()) {
					if (isset($_GET['fun']) and $_GET['fun'] == 'save_favourite' and !empty($_GET['id'])) {
						$found = AdFavourite::model()->findByAttributes(array('ad_id' => $_GET['id'], 'user_id' => Yii::app()->user->getId()));
						if ($found) {
							$found->delete();
							$message = 'Successfully removed from favourite property';
						} else {
							$model = new AdFavourite();
							$model->user_id = Yii::app()->user->getId();
							$model->ad_id = $_GET['id'];
							if ($model->save()) {
								$message = 'Successfully added to favourite property';
								$class = 'active';
							} else {
								$message = 'failed   to  save favourite property';
							}
						}
					}

					echo json_encode(array('status' => '1', 'after' => @$_GET['after'], 'message' => $message, 'class' => $class, 'id' => @$_GET['id']));
					Yii::app()->end();
				} else {
					echo json_encode(array('status' => '0'));
					Yii::app()->end();
				}
			}
		}
		echo json_encode(array('status' => '0'));
		Yii::app()->end();
	}
	public function actionAdd_to_fav()
	{
		if (!Yii::app()->user->getId()) {
			echo json_encode(array('status' => '0', 'message' => 'Your Session Timed Out .Please login.'));
			Yii::app()->end();
		}
		$message = '';
		$class = '';
		if (isset($_GET['fun']) and $_GET['fun'] == 'save_favourite' and !empty($_GET['id'])) {
			$found = AdFavourite::model()->findByAttributes(array('ad_id' => $_GET['id'], 'user_id' => Yii::app()->user->getId()));
			if ($found) {
				$found->delete();
				$message = 'Successfully removed from favourite property';
			} else {
				$model = new AdFavourite();
				$model->user_id = Yii::app()->user->getId();
				$model->ad_id = $_GET['id'];
				if ($model->save()) {
					$message = 'Successfully added to favourite property';
					$class = 'active';
				} else {
					$message = 'failed   to  save favourite property';
				}
			}
			echo json_encode(array('status' => '1', 'after' => @$_GET['after'], 'message' => $message, 'class' => $class, 'id' => @$_GET['id']));
			Yii::app()->end();
		}

		if (isset($_GET['fun']) and $_GET['fun'] == 'save_search' and !empty($_GET['id'])) {

			$url =  base64_decode($_GET['id']);
			$found = UserSearches::model()->findByAttributes(array('url' => $url, 'user_id' => Yii::app()->user->getId()));
			if ($found) {


				$found->delete();
				$message = 'Successfully removed from saved urls';
			} else {
				$model = new UserSearches();
				$model->user_id = Yii::app()->user->getId();
				$model->url = $url;
				if ($model->save()) {
					$message = 'Successfully added to saved urls';
					$class = 'active';
				} else {
					$message = 'failed   to  save searches';
				}
			}
			echo json_encode(array('status' => '1', 'after' => @$_GET['after'], 'message' => $message, 'class' => $class, 'id' => @$_GET['id']));
			Yii::app()->end();
		}
	}
	public function actionSigninajax()
	{
		$user = new UserLogin();

		$request = Yii::app()->request;
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {

			$message = '';
			$class = '';
			$user->attributes = $attributes;
			if ($user->validate()) {

				if (isset($_GET['fun']) and $_GET['fun'] == 'save_favourite' and !empty($_GET['id'])) {
					$found = AdFavourite::model()->findByAttributes(array('ad_id' => $_GET['id'], 'user_id' => Yii::app()->user->getId()));
					if ($found) {
						$found->delete();
						$message = 'Successfully removed from favourite property';
					} else {
						$model = new AdFavourite();
						$model->user_id = Yii::app()->user->getId();
						$model->ad_id = $_GET['id'];
						if ($model->save()) {
							$message = 'Successfully added to favourite property';
							$class = 'active';
						} else {
							$message = 'failed   to  save favourite property';
						}
					}
				}
				if (isset($_GET['fun']) and $_GET['fun'] == 'save_search' and !empty($_GET['id'])) {
					$url =  base64_decode($_GET['id']);
					$found = UserSearches::model()->findByAttributes(array('url' => $url, 'user_id' => Yii::app()->user->getId()));
					if ($found) {
						$found->delete();
						$message = 'Successfully removed from saved urls';
					} else {
						$model = new UserSearches();
						$model->user_id = Yii::app()->user->getId();
						$model->url = $url;
						if ($model->save()) {
							$message = 'Successfully added to saved urls';
							$class = 'active';
						} else {
							$message = 'failed   to  save searches';
						}
					}
				}

				echo json_encode(array('status' => '1', 'after' => @$_GET['after'], 'message' => $message, 'class' => $class, 'id' => @$_GET['id']));
				Yii::app()->end();
			} else {
				echo json_encode(array('status' => '0'));
				Yii::app()->end();
			}
		}
		echo json_encode(array('status' => '0'));
		Yii::app()->end();
	}
	public function actionSignin($return = null)
	{


		$user = new UserLogin();
		$model = new ListingUsers();
		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if (Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		//  print_r($_POST);
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {
				if (!empty($return)) {
					$this->redirect(base64_decode($return));
				}
				if ($this->options->get('system.common.email_verification_required', 'yes') == 'yes' && Yii::app()->user->getModel()->email_verified == '0') {
					$notify->addInfo(Yii::t('app', 'Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.', array('{p}' => $this->project_name)));
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				} else {
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				}
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Askaan Sign In')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market. Askaan Sign in Help you to maintain your listings and ads.',
		));

		$this->render("login", compact('model', 'user', 'return'));
	}
	public function actionLoad_signin_form($return = null)
	{


		$user = new UserLogin();
		$model = new ListingUsers();
		$cs = Yii::app()->clientScript;
		$cs->scriptMap = array(
			'jquery.js' =>  false,
			'jquery.min.js' =>    false,
		);
		$this->renderPartial("load_signin_form", compact('model', 'user', 'return'), false, true);
	}

	public function actionSignup($return = null, $short_signup = false)
	{

		$model = new ListingUsers();
		$user = new UserLogin();
		$request = Yii::app()->request;
		if (empty($short_signup)) {
			$model->scenario = 'frontend_insert';
		} else {
			$model->scenario = 'short_signup';
		}
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		if ($request->isPostRequest) {

			$attributes =  (array)$request->getPost($model->modelName, array());
			$model->attributes = $attributes;
			$model->status = 'A';
			$model->verification_code = md5(uniqid(rand(), true));
			if ($model->save()) {

				$user->password = $model->con_password;
				$user->email    = $model->email;
				if ($user->validate()) {
					if (!empty($return)) {
						$this->redirect(base64_decode($return));
					}
					// $this->sendRegisteredEmail($model); 
					if ($this->options->get('system.common.email_verification_required', 'yes') == 'yes') {
						$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
					} else {
						$this->redirect(Yii::app()->createUrl('member/profile_settings'));
					}
				} else {
					Yii::app()->user->setFlash('error', "Unexpected error on login");
					$this->redirect(Yii::app()->createUrl('user/signin'));
				}

				$this->redirect(Yii::app()->createUrl('user/signup'));
			} else {
				Yii::app()->user->setFlash('registerfail', 1);
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign Up', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("register", compact('model', 'user', 'return'));
	}
	public function actionSignup_ajax($return = null)
	{
		$model = new ListingUsers();
		$this->renderPartial("register1", compact('model', 'user', 'return'), false, true);
	}
	public function actionSignin_ajax($return = null)
	{
		$model = new UserLogin();
		$this->renderPartial("_login_section1", compact('model', 'user', 'return'), false, true);
	}
	public function actionRegister()
	{


		$model = new ListingUsers();
		$request = Yii::app()->request;

		if ($request->isPostRequest && ($attributes = (array)$_POST)) {

			// print_r($_POST);exit;
			$model->attributes = $attributes;
			$model->con_password = $_POST['password2'];
			$model->password = $_POST['password1'];

			if (isset($_POST['dob_year'])) {
				$model->dob = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];
			}
			//  print_r($model->attributes);exit;
			$model->status = 'I';
			$model->verification_code = md5(uniqid(rand(), true));
			if ($model->save()) {

				$emailTemplate =  CustomerEmailTemplate::model()->findByName("registration");
				if ($emailTemplate) {
					$emailTemplate = $emailTemplate->content;
				} else {
					$emailTemplate = $options->get('system.email_templates.common');
				}

				$emailBody = $this->renderPartial('_registration_verification', compact('model'), true);
				$emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);
				$mail = new YiiMailer();
				$mail->setFrom(Yii::app()->params['admin_email'], Yii::app()->options->get('system.common.site_name'));
				$mail->setTo($model->email);
				$mail->setView('email');
				$mail->setSubject(Yii::app()->options->get('system.common.site_name') . ' Account created . Explore your new account ');
				$mail->setData(array('emailTemplate' => $emailTemplate));
				$mail->send();
				Yii::app()->user->setFlash('registered', '1');

				$this->redirect(Yii::app()->createUrl('user/signup'));
			} else {

				Yii::app()->user->setFlash('registerfail', CHtml::errorSummary($model));

				$this->redirect(Yii::app()->createUrl('user/signup'));
			}
			//	exit;

		}
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();

		$this->redirect(Yii::app()->user->loginUrl);
	}
	public function actionRemoveAccount()
	{
		$user =   ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
		if ($user) {
			$user->status = 'I';
			$user->save();
			Yii::app()->user->logout();
			echo 1;
			Yii::app()->end();
		} else {
			echo '0';
		}
	}

	/**
	 * Display the form to retrieve a forgotten password.
	 */
	public function actionForgot_password()
	{

		if (Yii::app()->user->getId()) {
			$this->redirect('user/my_profile');
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new ListingUserPasswordReset();
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;

			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				$options = Yii::app()->options;
				$user = ListingUsers::model()->findByAttributes(array('email' => $model->email));
				$model->user_id = $user->user_id;
				$model->save(false);

				$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('km9820y438415');
				$options     =   Yii::app()->options;
				$support_phone  =  $options->get('system.common.support_phone');
				$support_email  =  $options->get('system.common.support_email');
				$notify     = Yii::app()->notify;
				if (empty($emailTemplate)) {
					return true;
				} else {
					$subject =  $emailTemplate->subject;
					$emailTemplate = $emailTemplate->content;
					$url = Yii::app()->createAbsoluteUrl('user/reset_password', array('reset_key' => $model->reset_key));
					$emailTemplate = str_replace('[USER_NAME]', $user->fullName, $emailTemplate);
					$emailTemplate = Yii::t('app', $emailTemplate, array('HRESET_LINKH' => $url));
					$emailTemplate_common = $options->get('system.email_templates.common');
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S';
					$adminEmail = new Email();
					$adminEmail->subject = $subject;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($user->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'S';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false);
					$adminEmail->send;
				}
				$notify->addSuccess(Yii::t('app', Yii::app()->options->get('system.messages._meesage_after_forgot_password', 'Successfully Send Reset password link')));

				$this->redirect(Yii::app()->createUrl('user/forgot_password'));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Forgot Password', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("forgot_password", compact('model'));
	}
	public function actionForgot_password_new()
	{

		/*	Yii::import('webroot.apps.extensions.YiiMailer.YiiMailer');*/

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new ListingUserPasswordReset();

		if ($request->isPostRequest && ($attributes = (array)$_POST)) {


			$model->attributes = $attributes;
			$model->email = @$attributes['username'];


			if (!$model->validate()) {


				//print_r($model->getErrors());exit;
				Yii::app()->user->setFlash('forgotfail', CHtml::errorSummary($model));
				$this->redirect(Yii::app()->createUrl('user/forgot_password'));
			} else {

				// echo "WWE";exit;
				$options = Yii::app()->options;
				$user = ListingUsers::model()->findByAttributes(array('email' => $model->email));

				$model->user_id = $user->user_id;
				$model->save(false);
				// echo "SDSD";exit;
				$emailTemplate = $options->get('system.email_templates.common');
				$emailBody = $this->renderPartial('_email-reset-key', compact('model', 'user'), true);


				$logo =  '<a href="' . Yii::app()->createAbsoluteUrl("site/index") . '" alt=""><img src="' .  OptionCommon::logoUrl() . '" style="width:134px; "></a> ';

				$emailTemplate = str_replace('{logo}', $logo, $emailTemplate);
				$emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);

				//echo $user->email; exit;
				/*
                $mail = new YiiMailer();
				$mail->setFrom(Yii::app()->options->get('system.common.admin_email'));
				$mail->setTo($user->email);
   
				$mail->setView('forgotpassword');
				$mail->setSubject('Reset Password Link '.Yii::app()->name);
				$mail->setData(array('emailTemplate' => $emailTemplate));
				*/
				$params = array(
					'to'            => $user->email,
					'fromName'      =>   Yii::app()->options->get('system.common.site_name'),
					'subject'       =>	'Reset Password Link ',
					'body'          =>   $emailTemplate,


				);
				//echo  $emailTemplate;exit;
				$server = DeliveryServer::pickServer();

				if (!$server->sendEmail($params)) {

					Yii::app()->user->setFlash('forgotfail', 'Temporary error while sending your email, please try again later or contact us!');
				} else {

					Yii::app()->user->setFlash('forgotsuccess', 'Please check your email address for password reset link.');
					$model->unsetAttributes();
					$model->email = null;
				}
				$this->redirect(Yii::app()->createUrl('user/forgot_password_new'));
			}
		}



		$this->render("sub/forgot_password", compact('model'));
	}

	/**
	 * Reached from email, will reset the password for given user and send a new one via email.
	 */
	public function actionReset_password($reset_key = null)
	{
		$options = Yii::app()->options;
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		$reset_model = ListingUserPasswordReset::model()->findByAttributes(array(
			'reset_key' => $reset_key,
			'status'    => UserPasswordReset::STATUS_ACTIVE,
		));

		if (empty($reset_model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$model = new   ListingUsers();
		$model->scenario   = 'update-new-password';
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;

			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {
				$randPassword = $model->password;
				$hashedPassword = Yii::app()->passwordHasher->hash($randPassword);
				ListingUsers::model()->updateByPk((int)$reset_model->user_id, array('password' => $hashedPassword));
				$reset_model->status = ListingUserPasswordReset::STATUS_USED;
				$reset_model->save();

				$criteria = new CDbCriteria;
				$criteria->condition = "t.status in ('A','W') and t.user_id = :user_id and t.isTrash='0' ";
				$criteria->params[':user_id'] = $reset_model->user_id;
				$user = ListingUsers::model()->find($criteria);
				if (!empty($user)) {
					$identity = new UserIdentity($user->email, null);
					$identity->impersonate = true;
					if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
						$notify->addError(Yii::t('app', 'Failed to login. Please try  login Manually'));
						$this->redirect($this->app->createUrl('user/signin'));
					} else {
						$this->redirect($this->app->createUrl('member/dashboard', array('slug' => $user->slug)));
					}
				} else {
					$notify->addError(Yii::t('app', 'Failed to login . Please try  login Manually!'));
					$this->redirect($this->app->createUrl('user/signin'));
				}
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Update Password', '{app}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("update_password", compact('model'));
	}


	public function actionMy_profile($show = null)
	{
		if ($show == '1') {
			$this->redirect('https://freebites.xyz/user/my_profile');
			Yii::app()->end();
		}
		if (!Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createAbsoluteUrl('user/signin'));
		}
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Profile', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));


		$notify = Yii::app()->notify;
		$user =  new ListingUsers();
		$user =  $user->findByPk((int)Yii::app()->user->getId());


		if (Yii::app()->request->isPostRequest) {

			$attributes = (array)Yii::app()->request->getPost('ListingUsers', array());
			$user->attributes =  $attributes;
			if ($user->save()) {
				$notify->addSuccess(Yii::t('app', 'Success!! Successfully updated your profile.'));
				$this->redirect(Yii::app()->createUrl('user/my_profile'));
			} else {
				$notify->addError(Yii::t('app', 'Sorry!! Failed to Update.'));
			}
		}

		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$planId = PricePlanOrder::DEFAULT_PLAN;
		$currentplan = PricePlanOrder::model()->getLastPaymentPlan((int)Yii::app()->user->getId());
		if ($currentplan) {
			$planId =  $currentplan->plan_id;
		}
		$pricePlan = PricePlan::model()->findByPk($planId);
		$this->render("sub/my_profile", compact("user", "pricePlan"));
	}
	/*
     public function actionMy_ads()
    {
		 $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/profile-css.css')));
	       $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Booking', array('{name}' => Yii::app()->options->get('system.common.site_name') )), 
            'pageHeading'       => Yii::t('hotel_booking', 'My Booking'),
            'pageMetaDescription'   => Yii::app()->params['description'],
             
        ));
        $user =  new ListingUsers();
        $user =  $user->findByPk((int)Yii::app()->user->getId());
        $notify = Yii::app()->notify;
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
         }
		if(Yii::app()->request->isPostRequest)
		{
		$search = new PlaceAnAd();
       
		if($id = Yii::app()->request->getPost("delete"))
		{
			$search=   $search->findByPk($id);
			$search->delete();
			$notify->addSuccess(Yii::t('app', 'Success!! Successfully deleted.'));
			 $this->redirect(Yii::app()->createUrl('user/my_ads'));
		}
		if($ids = Yii::app()->request->getPost("delete_selected"))
		{
		$search = new PlaceAnAd();
		$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$ids);
		$search->deleteAll();
		$notify->addSuccess(Yii::t('app', 'Success!! Successfully deleted.'));
		$this->redirect(Yii::app()->createUrl('user/my_ads'));
		}
		}
                    $criteria= new CDbCriteria;
				    $criteria->condition= "t.user_id=:uid";
				    $criteria->order="t.id desc";
				    $criteria->params[":uid"] = (int)Yii::app()->user->getId();
				    $count=PlaceAnAd::model()->count($criteria);
				    
				    $pages=new CPagination($count);
				    $pages->pageSize=10;
					$pages->applyLimit($criteria);
				    $model = PlaceAnAd::model()->findAll($criteria);
				    $categories =  Category::model()->FindCategoryies(array("condition"=>"t.user_id=:uid","params"=>array(":uid"=>Yii::app()->user->getId())));
                    
                    $this->render("sub/my_booking"),compact("user","model","pages","categories"));
	}
	* */
	public function actionMy_downloads()
	{
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/profile-css.css')));
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Downloads', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My Downloads'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$request = Yii::app()->request;

		$this->render("sub/my_booking", compact("user", "model", "pages", "categories"));
	}
	public function actionMy_application()
	{
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/profile-css.css')));
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Application', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My Application'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$request = Yii::app()->request;
		$user =  new ListingUsers();
		$user =  $user->findByPk((int)Yii::app()->user->getId());
		$notify = Yii::app()->notify;
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$criteria					=	new CDbCriteria;
		$criteria->condition		=	"t.user_id=:uid";
		$criteria->order			=	"t.date_added DESC";
		$criteria->params[":uid"]   =	(int)Yii::app()->user->getId();
		$count						=	ApplyJob::model()->count($criteria);

		$pages						=	new CPagination($count);
		$pages->pageSize			=	10;
		$pages->applyLimit($criteria);
		$model						= 	ApplyJob::model()->findAll($criteria);
		$this->render("my_job_applications", compact("model"));
	}
	public function actionMy_avatar()
	{


		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My avtar', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My avtar'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$notify = Yii::app()->notify;
		$user =  new ListingUsers();
		$user =  $user->findByPk((int)Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (Yii::app()->request->getPost("photo")) {
			$user->image = Yii::app()->request->getPost("photo");
			if ($user->save()) {

				$notify->addSuccess(Yii::t('app', 'Success!! Successfully updated your profile.'));
				$this->redirect(Yii::app()->createUrl("user/my_profile"));
			}
		}
		if (Yii::app()->request->isPostRequest) {

			//Yii::import('backend.extensions.ResizeImage');
			if (isset($_FILES['photo']['tmp_name'])) {

				$path =  Yii::getPathOfAlias('root.uploads');
				$img = rand(0, 9999) . '_' . time() . ".jpg";
				move_uploaded_file($_FILES['photo']['tmp_name'], $path . "/avatar/{$img}");
				$user->image = $img;
				if ($user->save()) {
					$notify->addSuccess(Yii::t('app', 'Success!! Successfully updated your profile.'));
					$this->redirect(Yii::app()->createUrl("user/my_profile"));
				}
			}
		}
		$avatar = Avatar::model()->allAvatars();
		$this->render("sub/my_avatar", compact("user", "avatar"));
	}

	public function actionAccount_settings($secion = "")
	{
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('ui.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('ui.css')));
		$notify = Yii::app()->notify;
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: Account Settings', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'Account Settings'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$user =  new ListingUsers();


		$user =  $user->findByPk((int)Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		if (Yii::app()->request->isPostRequest) {


			$attributes = Yii::app()->request->getPost("ListingUsers");
			$user->attributes = $attributes;


			if (Yii::app()->request->getPost("sitesearch") == "Change Password") {


				$user->scenario = "updatepassword";
				$user->password = $attributes['password'];
				$user->old_password = $attributes['old_password'];
				if (Yii::app()->request->isAjaxRequest) {
					echo CActiveForm::validate($user);
					Yii::app()->end();
				}
				if ($user->save()) {

					$notify->addSuccess(Yii::t('app', 'Success !! Succesfully updated your password.'));
					$this->redirect(Yii::app()->createUrl('user/account_settings'));
				} else {
					$notify->addError(Yii::t('app', 'Error !! Failed to update password.'));
					//Yii::app()->user->setFlash("failure",'1');
				}
			}

			if (Yii::app()->request->getPost("sitesearch") == "Change Name") {
				$user->scenario = "chnage_name";
				if (Yii::app()->request->isAjaxRequest) {
					echo CActiveForm::validate($user);
					Yii::app()->end();
				}
				if ($user->save()) {
					//Yii::app()->user->setFlash('success','Succesfully changed your profile');
					$notify->addSuccess(Yii::t('app', 'Success !! Succesfully changed your profile name .'));
					$this->redirect(Yii::app()->createUrl('user/account_settings'));
				} else {
					$user->addError(Yii::t('app', 'Error !! Failed to  changed your profile name .'));
				}
			}
			if (Yii::app()->request->getPost("sitesearch") == "Change Email") {
				$user->scenario = "updateEmail";
				if (Yii::app()->request->isAjaxRequest) {
					echo CActiveForm::validate($user);
					Yii::app()->end();
				}
				$user->verification_code = md5(uniqid(rand(), true));
				$user->email_verified    =  '0';
				if ($user->save()) {
					//Yii::app()->user->setFlash('success','Succesfully changed your profile');
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				} else {

					$user->addError(Yii::t('app', 'Error !! Failed  to update  your email address .'));
				}
			}
		}


		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}


		$user->password = "";



		$this->render("sub/account_settings", compact("user", 'login'));
	}

	public function actionKeyword_settings()
	{
		$notify = Yii::app()->notify;
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: Default Keyword for your Ad.  Settings', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'Keyword Settings'),
			'pageMetaDescription'   => 'Default Keyword for your Ad.',

		));
		$user =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$user->scenario = 'default_keyword';
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if (Yii::app()->request->isPostRequest) {
			$attributes = Yii::app()->request->getPost("ListingUsers");
			$user->attributes = $attributes;
			if ($user->save()) {
				$notify->addSuccess(Yii::t('app', 'Success !! Succesfully updated your default keyword.'));
				$this->redirect(Yii::app()->createUrl('user/keyword_settings'));
			} else {
				$notify->addError(Yii::t('app', 'Error !! Failed to update default keyword.'));
			}
		}

		$this->render("sub/keyword_settings", compact("user", 'login'));
	}

	/**
	 * The error handler
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo CHtml::encode($error['message']);
			} else {
				$this->setData(array(
					'pageMetaTitle' => Yii::t('app', 'Error {code}!', array('{code}' => $error['code'])),
				));
				$this->render("sub/error", $error);
			}
		}
	}
	public function actionEmailVerify($verify)
	{
		$options     =   Yii::app()->options;
		$notify = Yii::app()->notify;
		$model = ListingUsers::model()->find(array("condition" => 't.verification_code=:verify', 'params' => array(':verify' => $verify),));
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The verification code    not exist.'));
		}
		ListingUsers::model()->updateByPk($model->user_id, array("email_verified" => "1", "verification_code" =>  md5(uniqid(rand(), true))));
		$model->WelcomeEmail;
		$notify->addSuccess(Yii::t('app', Yii::app()->options->get('system.messages.successfully_verified_email_msg', 'Succesfully verified  your email address.')));


		if (Yii::app()->user->getId() == "") {
			$identity = new UserIdentity($model->email, null);
			$identity->impersonate = true;
			if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
				$notify->addError(Yii::t('app', 'Failed to login. Please try  login Manually'));
			} else {
				if ($model->filled_info == '0' and  $model->FillPersonalInformation) {
					$this->redirect($this->app->createUrl('member/profile_settings', array('slug' => $model->slug)));
				} else {
					$this->redirect($this->app->createUrl('member/dashboard', array('slug' => $model->slug)));
				}
			}
		}
		if ($model->filled_info == '0' and  $model->FillPersonalInformation) {
			$this->redirect($this->app->createUrl('member/profile_settings', array('slug' => $model->slug)));
		} else {
			$this->redirect($this->app->createUrl('member/dashboard', array('slug' => $model->slug)));
		}
		$this->redirect($this->app->createUrl('member/dashboard', array('slug' => $model->slug)));
		Yii::app()->end();

		if ($model->validate()) {
			Yii::app()->user->setFlash('verifySuccess', '1');
			$this->redirect($this->app->createUrl('user/signin'));
		}
		throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
	}
	public function actionMy_searches()
	{
		$notify = Yii::app()->notify;
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/profile-css.css')));
		$request = Yii::app()->request;
		if ($request->isAjaxRequest) {
			$v = Section::model()->findByPk($request->getQuery('section_id', '0'));
			if ($v) {
				$criteria = new CDbCriteria();
				$criteria->compare('t.user_id', Yii::app()->user->getId());
				$criteria->compare('t.section_id', $v->section_id);
				$criteria->order = 'date_added desc';
				$adsCount = Searchlist::model()->count($criteria);
				$pages = new CPagination($adsCount);
				$pages->pageSize = 1;
				$pages->applyLimit($criteria);
				$ads = Searchlist::model()->findAll($criteria);
				$this->renderPartial('_list_search', compact('ads', 'pages', 'adsCount', 'v'));
			}
			Yii::app()->end();
		}

		if (Yii::app()->request->isPostRequest) {
			$search = new Searchlist();

			if ($id = Yii::app()->request->getPost("delete")) {
				$search =   $search->findByPk($id);
				if ($search->delete()) {
					$notify->addSuccess(Yii::t('app', 'Success!!! Successfully removed from your searches.'));
				} else {
					$notify->addError(Yii::t('app', 'Error!!!  Failed to  remove  from your searches. '));
				}
			}




			if ($ids = Yii::app()->request->getPost("delete_selected")) {


				$search = new Searchlist();
				$criteria = new CDbCriteria;
				$criteria->addInCondition('id', $ids);
				if ($search->deleteAll($criteria)) {
					$notify->addSuccess(Yii::t('app', 'Success!!! Successfully removed from your searches.'));
				} else {
					$notify->addError(Yii::t('app', 'Error!!!  Failed to  remove  from your searches. '));
				}
				$this->redirect(Yii::app()->createUrl('user/my_searches'));
			}
		}
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Searches', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My Searches'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$user =  new ListingUsers();
		$user =  $user->findByPk((int)Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$section =  Section::model()->listData();


		$this->render("sub/searches", compact('section'));
	}
	public function actionMy_watchlist()
	{
		$notify = Yii::app()->notify;
		if (Yii::app()->request->isPostRequest) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', Yii::app()->request->getPost("wl-select"));
			if (Watchlist::model()->deleteAll($criteria)) {

				$notify->addSuccess(Yii::t('app', 'Success!!! Successfully removed from your watchlist.'));
			} else {
				$notify->addError(Yii::t('app', 'Error!!!  Failed to  remove  from your watchlist '));
			}
		}
		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t('app', '{name} :: My Watches', array('{name}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t('hotel_booking', 'My Watches'),
			'pageMetaDescription'   => Yii::app()->params['description'],

		));
		$user =  new ListingUsers();
		$user =  $user->findByPk((int)Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		// $model=Watchlist::model()->getWtachlist(Yii::app()->user->getId());
		$categories =  Category::model()->FindCategoryies(array("condition" => "t.user_id=:uid", "params" => array(":uid" => Yii::app()->user->getId())));

		$this->render("sub/watches", compact('categories'));
	}

	public function sendRegisteredEmail($model)
	{

		$notify = Yii::app()->notify;
		$emailTemplate =  CustomerEmailTemplate::model()->findByName("Registration");
		if ($emailTemplate) {
			$emailTemplate = $emailTemplate->content;
		} else {
			$emailTemplate = $options->get('system.email_templates.common');
		}

		$emailBody = $this->renderPartial(Yii::app()->LayoutClass->viewpath("_registration_verification"), compact('model'), true);
		$emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);
		$logo =  '<a href="' . Yii::app()->createAbsoluteUrl("site/index") . '" alt="noimage"><img src="' . OptionCommon::logoUrl() . '" style="width:134px; "></a> ';
		$login_path = Yii::app()->createAbsoluteUrl('user/signin');
		$account_path = Yii::app()->createAbsoluteUrl('user/my_profile');
		$emailTemplate = str_replace('{logo}', $logo, $emailTemplate);
		$emailTemplate = str_replace('{name}', $model->first_name . '  ' . $model->last_name, $emailTemplate);
		$emailTemplate = str_replace('{phone}', Yii::app()->options->get('system.common.support_phone'), $emailTemplate);
		$emailTemplate = str_replace('{support}', Yii::app()->options->get('system.common.support_email'), $emailTemplate);
		$emailTemplate = str_replace('{login-path}', '<a href="' . $login_path . '" style="color:#1e7ec8;" target="_blank">Login</a>', $emailTemplate);
		$emailTemplate = str_replace('{my-account}', '<a href="' . $account_path . '" style="color:#1e7ec8;" target="_blank">My Account</a>', $emailTemplate);


		$params = array(
			'to'            =>  $model->email,
			'fromName'      =>   Yii::app()->options->get('system.common.site_name'),
			'subject'       =>	'Successfully registered with ' . Yii::app()->options->get('system.common.site_name') . ', please follow the link to  verify your email address ',
			'body'          =>   $emailTemplate,
			'mailerPlugins' => array(
				'logger'    => true,
			),

		);

		$server = DeliveryServer::pickServer();
		if (!empty($server)) {
			if (!$server->sendEmail($params)) {

				$notify->addError(Yii::t('app', 'Temporary error while sending your email, please try again later or contact us!'));
			} else {
				$notify->addSuccess(Yii::t('app', 'Success!!! Verification  Email is Send to your account.Don\'t forget to check your Spam/Junk folder.Please verify your email account. '));
			}
		} else {
			$notify->addError(Yii::t('app', 'Error!! Inactive Delivery server . Please contact admin  '));
		}
	}
	public function actionEmailVerification()
	{
		$notify = Yii::app()->notify;

		$model =  new ListingUsers();
		//print_r(Yii::app()->user->getId());exit;
		$model =  $model->findByPk((int)Yii::app()->user->getId());


		if (empty($model)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
			//$this->redirect('signin');
		}
		if ($model->email_verified == 1) {
			$this->redirect(Yii::app()->createUrl('user/my_profile'));
			//$this->redirect('signin');
		}
		$model->scenario = "updateEmail";
		if (Yii::app()->request->isAjaxRequest) {

			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (Yii::app()->request->isPostRequest) {


			$attributes = Yii::app()->request->getPost("ListingUsers");
			$model->attributes = $attributes;
			if (Yii::app()->request->getPost("resent") == "resent") {


				$model->verification_code = md5(uniqid(rand(), true));
				if (ListingUsers::model()->updateByPk((int)$model->user_id, array('verification_code' => $model->verification_code))) {
					$model->sendVerificationEmail();
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				}
			} else {

				$model->scenario = "updateEmail";
				$model->verification_code = md5(uniqid(rand(), true));
				if ($model->save()) {

					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				} else {
					$notify->addError(Yii::t('app', 'Failed to update email.'));
				}

				$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
			}
		}
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name}', array('{name}' => 'Verify your email address ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("verify_email", compact("model"));
	}
	public function actionImpersonate($id)
	{


		if (!strpos(Yii::app()->request->urlReferrer, 'backend')) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$user = ListingUsers::model()->findByPk((int)$id);

		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$identity = new UserIdentity($user->email, null);
		$identity->impersonate = true;


		if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
			$notify->addError(Yii::t('app', 'Unable to impersonate the customer!'));
			$this->redirect(array('listingusers/index'));
		}
		$this->redirect(array('user/my_profile'));
	}
}
