<?php defined('MW_PATH') || exit('No direct script access allowed');


class UserController extends Controller
{

	// public $layout = 'sub_account';
	public $member;
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
		if (Yii::app()->user->getId()) {
			$this->member  = Yii::app()->user->getModel();
		}
	}
	public function  beforeAction($action)
	{


		/*
        
		if(Yii::app()->user->getId() and !in_array($action->id,array('logout','signin','emailverify','impersonate','removeaccount'))){
		$user = Yii::app()->user->getModel();
		if(!empty($user->f_type)){
			$this->redirect(Yii::app()->createUrl('member/dashboard',array('slug'=> $user->slug )));
		}
		}
		*/

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
		ini_set('memory_limit', '-1');
		$model = new ListingUsers();
		$user = new UserLogin();
		$request = Yii::app()->request;
		$model->scenario = 'frontend_insert';
		if ($request->isPostRequest) {

			$attributes =  (array)$request->getPost($model->modelName, array());
			$model->attributes = $attributes;
			$model->status = 'A';
			$model->verification_code = $model->generatePIN(6);
			if ($model->save()) {
				$user->password = $model->con_password;
				$user->email    = $model->email;
				$user->need_ajaxlogin    = '1';
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
	public function actionRemove_properties($id = null)
	{

		if (Yii::app()->user->getId()) {
			Yii::app()->user->setState("user_session", time());
			$found = AdFavourite::model()->findByAttributes(array('ad_id' => $id, 'user_id' => Yii::app()->user->getId()));
			if ($found) {
				$found->delete();
			}

			$placead = new PlaceAnAd();
			$criteria =  $placead->findAds(array(), false, 1);
			$criteria->join .= ' INNER JOIN {{ad_favourite}} af  on af.ad_id = t.id and af.user_id = :user_idn ';
			$criteria->params[':user_idn'] = (int) Yii::app()->user->getId();
			$total_favourite = $placead->count($criteria);

			$cookieName2 = 'C_USERFAV' . COUNTRY_ID . Yii::app()->user->getId();
			$cookie = new CHttpCookie($cookieName2, $total_favourite);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies[$cookieName2] = $cookie;
		} else {

			$data = array();
			$cookieName = 'USERFAV' . COUNTRY_ID;

			if ((isset(Yii::app()->request->cookies[$cookieName]))) {
				$data =  Yii::app()->request->cookies[$cookieName]->value;
				if (isset($data[$id])) {
					unset($data[$id]);
				}
			}

			$data = (array) $data;
			$cookie = new CHttpCookie($cookieName, $data);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies[$cookieName] = $cookie;

			$placead = new PlaceAnAd();
			$criteria =  $placead->findAds(array(), false, 1);
			$criteria->addInCondition('t.id', (array)$data);
			$total_favourite = $placead->count($criteria);
			$cookieName2 = 'C_USERFAV' . COUNTRY_ID;
			$cookie = new CHttpCookie($cookieName2, $total_favourite);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies[$cookieName2] = $cookie;
		}
		echo json_encode(array('total_favourite' => $total_favourite));
		exit;
	}
	public function actionAdd_to_fav()
	{
		if (!Yii::app()->user->getId()) {
			if (isset($_GET['fun']) and $_GET['fun'] == 'save_favourite' and !empty($_GET['id'])) {
				$message = '';
				$class = '';
				$data = array();
				$cookieName = 'USERFAV' . COUNTRY_ID;
				if ((isset(Yii::app()->request->cookies[$cookieName]))) {
					$data =  Yii::app()->request->cookies[$cookieName]->value;
				}
				if (isset($data[$_GET['id']])) {
					unset($data[$_GET['id']]);
					$message = 'Successfully removed from favourite property';
				} else {
					$data[$_GET['id']] = $_GET['id'];
					$message = 'Successfully added to favourite property';
					$class = 'active';
				}

				$placead = new PlaceAnAd();
				$criteria =  $placead->findAds(array(), false, 1);
				$criteria->addInCondition('t.id', (array)$data);
				$total_favourite = $placead->count($criteria);
				$cookieName2 = 'C_USERFAV' . COUNTRY_ID;
				$cookie = new CHttpCookie($cookieName2, $total_favourite);
				$cookie->expire = time() + 60 * 60 * 24 * 180;
				Yii::app()->request->cookies[$cookieName2] = $cookie;


				$cookie = new CHttpCookie($cookieName, $data);
				$cookie->expire = time() + 60 * 60 * 24 * 180;
				Yii::app()->request->cookies[$cookieName] = $cookie;
				echo json_encode(array('status' => '1', 'after' => @$_GET['after'], 'message' => $message, 'class' => $class, 'id' => @$_GET['id']));
				Yii::app()->end();
			}
			echo json_encode(array('status' => '0', 'message' => 'Your Session Timed Out .Please login.'));
			Yii::app()->end();
		}
		$message = '';
		$class = '';
		if (isset($_GET['fun']) and $_GET['fun'] == 'save_favourite' and !empty($_GET['id'])) {
			Yii::app()->user->setState("user_session", time());
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
			$placead = new PlaceAnAd();
			$criteria =  $placead->findAds(array(), false, 1);
			$criteria->join .= ' INNER JOIN {{ad_favourite}} af  on af.ad_id = t.id and af.user_id = :user_idn ';
			$criteria->params[':user_idn'] = (int) Yii::app()->user->getId();
			$total_favourite = $placead->count($criteria);

			$cookieName2 = 'C_USERFAV' . COUNTRY_ID . Yii::app()->user->getId();
			$cookie = new CHttpCookie($cookieName2, $total_favourite);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies[$cookieName2] = $cookie;


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
		ini_set('memory_limit', '-1');
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
		ini_set('memory_limit', '-1');
		$user = new UserLogin();
		$user->email		=	isset(Yii::app()->request->cookies['email_login']) ? Yii::app()->request->cookies['email_login']->value : '';
		$user->password	=	isset(Yii::app()->request->cookies['email_password']) ? Yii::app()->request->cookies['email_password']->value : '';
		if (Yii::app()->request->getQuery('a', '') == 't') {
			$user->need_ajaxlogin = '1';
		}
		$model = new ListingUsers();
		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		// if (Yii::app()->request->getQuery('t', '') == 'c') {
		// 	$user->need_captcha_validation = '1';
		// }
		if (Yii::app()->user->getId() and !Yii::app()->request->isPostRequest) {
			$this->redirect(Yii::app()->createUrl('site/index'));
			// $this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		//  print_r($_POST);
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {
				if (!empty($return)) {
					$this->redirect(base64_decode($return));
				}
				$this->redirect(Yii::app()->createUrl('site/index'));
				if ($this->options->get('system.common.email_verification_required', 'yes') == 'yes' && Yii::app()->user->getModel()->email_verified == '0') {
					$notify->addInfo(Yii::t('app', 'Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.', array('{p}' => $this->project_name)));
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				} else {
					$this->redirect(Yii::app()->createUrl('site/index'));
				}
			}
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("login", compact('model', 'user', 'return'), false, true);
			exit;
		}
		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign In')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
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
		ini_set('memory_limit', '-1');
		$model = new ListingUsers();
		$user = new UserLogin();
		$request = Yii::app()->request;
		if (empty($short_signup)) {
			$model->scenario = 'new_front_insert';
		} else {
			$model->scenario = 'short_signup';
		}
		if (Yii::app()->request->getQuery('t', '') == 'c') {
			$model->need_captcha_validation = '1';
		}
		// $this->no_header = '1';
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		if ($request->isPostRequest) {

			$attributes =  (array)$request->getPost($model->modelName, array());
			$model->attributes = $attributes;
			//$model->status='A';
			$model->verification_code = $model->generatePIN(6);
			$model->email_verified = 1;
			$model->admin_approved = 1;
			if ($model->save()) {
				$model->sendVerificationEmail();
				// $emailTemplateModel = CustomerEmailTemplate::model()->findByName("registration");
				// $emailTemplate = $emailTemplateModel ? $emailTemplateModel->content : Yii::app()->options->get('system.email_templates.common');

				// $emailBody = '';//$this->renderPartial('_registration_verification', compact('model'), true);
				// $emailContent = str_replace('[CONTENT]', $emailBody, $emailTemplate);
			
				// $to      = $model->email;
				// $subject = Yii::app()->options->get('system.common.site_name') . ' Account created - Explore your new account';
				// $headers = "MIME-Version: 1.0" . "\r\n";
				// $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
				// $headers .= 'From: ' . Yii::app()->params['admin_email'] . "\r\n";
				
				// if (mail($to, $subject, $emailContent, $headers)) {
				// 	print_r('Email sent successfully');
				// 	exit;
				// } else {
				// 	$error = error_get_last();
    			// 	echo 'Email sending failed. Reason: ' . ($error['message'] ?? 'Unknown error');
				// 	exit;
				// }
				$this->redirect(Yii::app()->createUrl('user/EmailVerification', array('email' => base64_encode($model->email))));
				if ($model->status == 'W') {

					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));

					if ($model->status == 'W') {
						$this->redirect(Yii::app()->createUrl('user/waiting_approval', array('email' => base64_encode($model->email))));
					} else {
						$this->redirect(Yii::app()->createUrl('site/index'));
					}

					// $this->redirect(Yii::app()->createUrl('user/waiting_approval',array('email'=>base64_encode($model->email))));exit;
				}
				$user->password = $model->con_password;
				$user->email    = $model->email;
				if ($user->validate()) {
					if (!empty($return)) {
						$this->redirect(base64_decode($return));
					}
					// $this->sendRegisteredEmail($model); 

					/*
			            
			             if($this->options->get('system.common.email_verification_required','yes')=='yes'){
							$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
						}
						else{
							$this->redirect(Yii::app()->createUrl('member/profile_settings'));
						}
						* */

					$this->redirect(Yii::app()->createUrl('user/successfully_regisered'));
				} else {
					Yii::app()->user->setFlash('error', "Unexpected error on login");
					$this->redirect(Yii::app()->createUrl('user/signin'));
				}

				$this->redirect(Yii::app()->createUrl('user/signup'));
			} else {
				Yii::app()->user->setFlash('registerfail', CHtml::errorSummary($model));
			}
		}
		$apps = Yii::App()->apps;

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign Up', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));
		if ($this->app->request->isAjaxRequest) {

			$this->unloader();
			$this->renderPartial("register", compact('model', 'user', 'return'), false, true);
			$this->app->end();
		}
		$this->render("register", compact('model', 'user', 'return'));
	}

	public function actionWaiting_approval($email = null)
	{

		$request = Yii::app()->request;
		$model = ListingUsers::model()->findByAttributes(array('status' => 'W', 'email' => base64_decode($email)));


		$this->secure_header = '1';
		if (empty($model)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
			//$this->redirect('signin');
		}

		if ($model->status == 'A') {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		$notify = Yii::app()->notify;




		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' =>  'Waiting approval', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("waiting_approval", compact("model", 'view'));
	}

	public function actionSuccessfully_regisered($email = null)
	{

		if (!Yii::App()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('user/signup'));
		}

		$notify = Yii::app()->notify;

		$this->secure_header = '1';
		$model = Yii::app()->user->getModel();

		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' =>  'Successfully regisered', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("successfully_registered", compact("model", 'view'));
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
		ini_set('memory_limit', '-1');
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
			$model->verification_code = $model->generatePIN(6);
			if ($model->save()) {

				$emailTemplateModel = CustomerEmailTemplate::model()->findByName("registration");
				$emailTemplate = $emailTemplateModel ? $emailTemplateModel->content : Yii::app()->options->get('system.email_templates.common');

				$emailBody = $this->renderPartial('_registration_verification', compact('model'), true);
				$emailContent = str_replace('[CONTENT]', $emailBody, $emailTemplate);
				// Set headers for mail()
				$to      = $model->email;
				$subject = Yii::app()->options->get('system.common.site_name') . ' Account created - Explore your new account';
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
				$headers .= 'From: ' . Yii::app()->params['admin_email'] . "\r\n";
				
				if (mail($to, $subject, $emailContent, $headers)) {
					Yii::app()->user->setFlash('registered', '1');
				} else {
					Yii::app()->user->setFlash('registerfail', 'Unable to send verification email. Please try again later.');
				}

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
		if (isset(Yii::app()->request->cookies['l_type'])) {
			unset(Yii::app()->request->cookies['l_type']);
			unset(Yii::app()->request->cookies['u_user']);
			unset(Yii::app()->request->cookies['u_password']);
		}
		Yii::app()->user->logout();

		$this->redirect(Yii::app()->createUrl('site/index'));
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
		ini_set('memory_limit', '-1');
		if (Yii::app()->user->getId()) {
			$this->redirect('user/my_profile');
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new ListingUserPasswordReset();
		if (Yii::app()->request->isAjaxRequest  and !isset($_GET['_pjax'])) {
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
					$emailTemplate_common = $model->commonTemplate();
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
				$notify->addSuccess(Yii::t('app', $this->generateCommonMessage('_meesage_after_forgot_password', 'Successfully Send Reset password link')));

				$this->redirect(Yii::app()->createUrl('user/forgot_password'));
			}
		}
		if ($this->app->request->isAjaxRequest) {

			$this->unloader();
			$this->renderPartial("forgot_password", compact('model'), false, true);
			$this->app->end();
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
		$this->no_header = '1';
		ini_set('memory_limit', '-1');
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
				$user->verification_code = $user->generatePIN(6);
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
		$model->status = Yii::app()->options->get('system.common.approval', 'yes') == 'yes' ? 'W' : 'A';
		ListingUsers::model()->updateByPk($model->user_id, array("email_verified" => "1", 'status' => $model->status, "verification_code" =>   $model->generatePIN(6)));
		//$notify->addSuccess(Yii::t('app',Yii::app()->options->get('system.messages.successfully_verified_email_msg','Succesfully verified  your email address.') ));


		if ($model->status == 'W') {
			$this->redirect(Yii::app()->createUrl('user/waiting_approval', array('email' => base64_encode($model->email))));
			exit;
		}
		$model->WelcomeEmail;
		$this->redirect($this->app->createUrl('user/activated'));
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
	public function actionEmailVerification($view = 'verify', $email = null)
	{

		ini_set('memory_limit', '-1');
		if (!Yii::app()->user->getId() and empty($email)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
		if (Yii::app()->user->getId() and empty($email)) {
			$email = base64_encode(Yii::app()->user->getModel()->email);
		}

		$notify = Yii::app()->notify;
		$request = Yii::app()->request;
		$model =  new ListingUsers();
		//print_r(Yii::app()->user->getId());exit;

		if (Yii::app()->user->getId()) {
			$model =  $model->findByPk((int)Yii::app()->user->getId());
			if (!empty($model) and strpos($model->email, 'feeta.pk') !== false) {
				$this->redirect(Yii::app()->createUrl('user/change_email'));
			}
		} else if (!empty($email)) {
			$email1 = base64_decode($email);

			$model =  $model->findByAttributes(array('email' => $email1));
		}

		if (empty($model)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
			//$this->redirect('signin');
		}
		if ($model->email_verified == 1) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
			//$this->redirect('signin');
		}
		$model->scenario = "verificationCode";

		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		/*
			if(Yii::app()->request->isPostRequest)
			{
				 
			 
				$attributes = Yii::app()->request->getPost("ListingUsers");
				$model->attributes = $attributes;
				if(Yii::app()->request->getPost("resent")=="resent")
				{
			 
									 
								  $model->verification_code = md5(uniqid(rand(), true));
								  if (ListingUsers::model()->updateByPk((int)$model->user_id, array('verification_code' => $model->verification_code))) { 
									 $model->sendVerificationEmail();
									 $this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				 }
				 
				}
				else
				{
				
					$model->scenario="updateEmail";
					$model->verification_code = md5(uniqid(rand(), true));
					if($model->save())
					{    
								  	  
									 $this->redirect(Yii::app()->createUrl('user/EmailVerification'));
					}
					else{
						 $notify->addError(Yii::t('app', 'Failed to update email.'));
					}
					
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
					 
				}
				
				
			  }
			  */

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {

			$model->attributes = $attributes;




			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Error !! Failed to validate code.'));
			} else {
				$model->status = Yii::app()->options->get('system.common.approval', 'yes') == 'yes' ? 'W' : 'A';

				ListingUsers::model()->updateByPk($model->user_id, array("email_verified" => "1", 'status' => $model->status, "verification_code" =>   $model->generatePIN(6)));
				//$notify->addSuccess(Yii::t('app',Yii::app()->options->get('system.messages.successfully_verified_email_msg','Succesfully verified  your email address.') ));
				// $notify->addError(Yii::t('app', 'Success !! Successfully  updated  contact details.'));


				if (Yii::app()->user->getId()) {
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				} else {
					$model->WelcomeEmail;
					$this->redirect($this->app->createUrl('user/activated'));
				}
				//echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				// Yii::app()->end();
			}
		}
		// $this->no_header = '1';
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' => 'Verify your email address', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("verify_email", compact("model", 'view', 'email'));
	}
	public function actionChange_email($view = 'verify', $email = null)
	{

		if (!Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
		if (Yii::app()->user->getId() and empty($email)) {
			$email = Yii::app()->user->getModel()->email;
		}

		$notify = Yii::app()->notify;
		$request = Yii::app()->request;
		$model =  new ListingUsers();
		//print_r(Yii::app()->user->getId());exit;

		if (Yii::app()->user->getId()) {
			$model =  $model->findByPk((int)Yii::app()->user->getId());
		} else if (!empty($email)) {
			$email1 = base64_decode($email);

			$model =  $model->findByAttributes(array('email' => $email1));
		}

		if (empty($model)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
			//$this->redirect('signin');
		}
		if ($model->email_verified == 1) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
			//$this->redirect('signin');
		}
		$model->scenario = "change_email";

		if (Yii::app()->request->isAjaxRequest) {

			echo CActiveForm::validate($model);
			Yii::app()->end();
		}



		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {

			$model->attributes = $attributes;




			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Error !! Failed to validate code.'));
			} else {
				$model->verification_code = $model->generatePIN(6);

				$model->updateByPk($model->user_id, array('email' => $model->email, 'email_verified' => '0', 'verification_code' => $model->verification_code, 'v_send_at' => date('Y-m-d H:i:s')));

				$model->sendVerificationEmail();
				$this->redirect(Yii::app()->createUrl('user/emailverification'));
			}
		}
		$this->no_header = '1';
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' => 'Change your email address', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("change_email", compact("model", 'view', 'email'));
	}
	public function actionActivated($view = 'verify')
	{


		// $this->no_header = '1';
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' => 'Verify your email address', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("activated", compact("model", 'view'));
	}
	public function actionActivated_phone($view = 'verify')
	{


		$this->no_header = '1';
		$this->setData(array(
			'pageTitle'         => Yii::t('app', '{name} | {p}', array('{name}' => 'Phone verified', '{p}' => $this->project_name)),
			'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render("activated_phone", compact("model", 'view'));
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
	public function actionOtp_verify($email = null)
	{

		$this->no_header = '1';
		if (!Yii::app()->user->getId() and empty($email)) {
			$this->redirect(Yii::App()->createUrl('user/signin'));
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;




		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		if (Yii::app()->user->getId()) {
			$criteria->condition = " t.user_id= :params ";
			$criteria->params[":params"] =  Yii::app()->user->getId();
		} else if (!empty($email)) {
			$criteria->condition = " t.email= :params ";
			$criteria->params[":params"] =  base64_decode($email);
		}
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);



		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if ($model->email_verified == '0' and empty($email)) {
			$this->redirect(Yii::app()->createUrl('user/emailVerification'));
		}
		if ($model->o_verified == '1') {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		$model->scenario = 'send_otp';

		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;

			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				/*for one hour delay*/
				if ($model->hours_different < 10 and !empty($model->otp)) {
					$otp = $model->otp;
				} else {
					$otp = rand(1000, 9999);
				}


				$model->otp = $otp;
				$out =  $model->getSendOtp();
				$skiped =  empty($email) ?   '0' : '1';
				$model->updateByPk($model->user_id, array('e_skipped' => $skiped, 'otp' => $otp, 'o_send_at' => date('Y-m-d H:i:s'), 'phone' => Yii::t('app', $model->phone, array(' ' => '')), 'full_number' => Yii::t('app', $model->full_number, array(' ' => ''))));
				if (strpos($out, 'OK') !== false or empty($out)) {
					$notify->addSuccess(Yii::t('app', 'Successfully send verification code to your Phone Number!'));
					$this->redirect(Yii::app()->createUrl('user/otp_input', array('email' => base64_encode($model->email))));
				} else {
					$notify->addError(Yii::t('app', $out));
				}
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Phone Number Verification', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("send_otp", compact('model', 'email'));
	}
	public function actionOtp_input($email = null)
	{

		$this->no_header = '1';
		if (!Yii::app()->user->getId() and empty($email)) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;

		if (Yii::app()->user->getId()) {
			$criteria->condition = " t.user_id= :params ";
			$criteria->params[":params"] =  Yii::app()->user->getId();
		} else if (!empty($email)) {
			$criteria->condition = " t.email= :params ";
			$criteria->params[":params"] =  base64_decode($email);
		}
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (empty($model->otp)) {
			$this->redirect(Yii::app()->createUrl('user/otp_verify'));
		}
		if ($model->o_verified == '1') {

			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		$model->scenario = 'input_otp';

		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;

			if (!$model->validate()) {
				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				$model->updateByPk($model->user_id, array('o_verified' => '1'));
				$notify->addSuccess(Yii::t('app', 'Successfully verified  your Phone Number!'));
				if (!Yii::app()->user->getId()) {
					$this->redirect($this->app->createUrl('user/activated_phone'));
				}
				$this->redirect(Yii::app()->createUrl('member/dashboard'));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Phone Number Verification', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("otp_input", compact('model'));
	}
	public function actionUpdate_profile()
	{
		$this->redirect(Yii::app()->createUrl('member/Update_profile'));
		$this->no_header = '1';
		ini_set('memory_limit', '-1');
		if (!Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$user = ListingUsers::model()->findByPk(Yii::app()->user->getId());
		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if ($user->o_verified != '1') {
			$this->redirect(Yii::app()->createUrl('user/otp_verify'));
		}

		$user->scenario = 'update_profile';
		$text = 'Successfully updated Profile!';
		if (isset($_POST['module']) and $_POST['module'] == 'change_password') {
			$user->scenario = 'updatepassword';
			$text =  'Successfully updated password';
		}
		if (isset($_POST['module']) and $_POST['module'] == 'change_phone') {
			$user->scenario = 'change_phone';
			$text =  'Successfully updated phone';
		}
		if (isset($_POST['module']) and $_POST['module'] == 'change_email') {
			$user->scenario = 'change_email';
			$text =  'Successfully updated email';
		}
		if (isset($_POST['module']) and $_POST['module'] == 'change_name') {
			$user->scenario = 'change_name';
			$text =  'Successfully updated name';
		}
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
			$user->attributes = $attributes;

			if (!$user->save()) {
				print_r($user->getErrors());
				exit;
				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				$notify->addSuccess(Yii::t('app', $text));
				if ($user->scenario == 'update_profile') {
					$user->updateByPk($user->user_id, array('u_p' => '1'));
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				} else if ($user->scenario == 'change_phone') {
					$user->updateByPk($user->user_id, array('full_number' => $user->full_number, 'phone' => Yii::t('app', $user->phone, array(' ' => '')), 'o_verified' => '0'));
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				} else if ($user->scenario == 'change_email') {
					$user->verification_code = $user->generatePIN(6);

					$user->updateByPk($user->user_id, array('email_verified' => '0', 'verification_code' => $user->verification_code, 'v_send_at' => date('Y-m-d H:i:s')));

					$user->sendVerificationEmail();
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				} else {
					$this->refresh();
				}
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Update Profile', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));
		$apps = Yii::app()->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));


		$member = $this->member;
		$this->render("update_profile", compact('user', 'member'));
	}
	public function actionResendEmail($email = null)
	{
		$email = base64_decode($email);

		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.v_send_at IS NULL THEN t.date_added ELSE t.v_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.email= :params ";
		$criteria->params[":params"] = $email;
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);




		if (empty($model)) {
			$message =  Yii::t('app', 'Sorry , not found any registered email <b>{email}<b>.', array('{email}' => $email));
			echo json_encode(array('status' => '0', 'message' => $message));
			exit;
		}
		if ($model->email_verified == 1) {
			$message =  Yii::t('app', 'Email address <b>{email}<b> already verified.', array('{email}' => $email));
			echo json_encode(array('status' => '0', 'message' => $message));
			exit;
		}
		if ($model->hours_different < 120 and !empty($model->verification_code)) {
		} else {

			$model->verification_code = $model->generatePIN(6);
		}
		ListingUsers::model()->updateByPk((int)$model->user_id, array('verification_code' => $model->verification_code, 'v_send_at' => date('Y-m-d H:i:s')));
		$model->sendVerificationEmail();
		echo json_encode(array('status' => '1'));
		exit;
	}

	public function actionSignin_phone($return = null)
	{
		ini_set('memory_limit', '-1');
		$this->no_header = '1';
		$user = new UserLoginPhone();
		$user->phone		=	isset(Yii::app()->request->cookies['phone']) ? Yii::app()->request->cookies['phone']->value : '';
		$user->scenario = 'enterPhone';
		$model = new ListingUsers();
		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}

		if (Yii::app()->user->getId() and !Yii::app()->request->isPostRequest) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {


				$criteria = new CDbCriteria;
				$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
				$criteria->condition = " t.phone= :params ";
				$criteria->params[":params"] = Yii::t('app', $user->phone, array(' ' => ''));
				// $criteria->select="country_id,country_name";
				$model =  ListingUsers::model()->find($criteria);
				if (empty($model)) {
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				if ($model->hours_different < 10 and !empty($model->otp)) {
					$otp = $model->otp;
				} else {
					$otp = rand(1000, 9999);
				}

				$model->otp = $otp;
				ListingUsers::model()->updateByPk((int)$model->user_id, array('otp' => $otp, 'otp_login' => $otp, 'o_send_at' => date('Y-m-d H:i:s')));

				$out =  $model->getSendOtpLogin();
				$this->redirect(Yii::app()->createUrl('user/signin_phone_otp', array('phone' => base64_encode(Yii::t('app', $model->phone, array(' ' => ''))))));
			}
		}

		if ($this->app->request->isAjaxRequest) {

			$this->unloader();
			$this->renderPartial("login_phone", compact('model', 'user', 'return'), false, true);
			$this->app->end();
		}
		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign In via Phone')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
		));

		$this->render("login_phone", compact('model', 'user', 'return'));
	}

	public function unloader()
	{
		$cs = Yii::app()->clientScript;
		$cs->scriptMap = array(
			'jquery.js' =>  false,
			'jquery.min.js' =>    false,
			'jquery.yiiactiveform.js' =>    false,
		);
	}
	public function actionSignin_phone_otp($phone = null)
	{

		$this->no_header = '1';
		ini_set('memory_limit', '-1');
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.phone= :params ";
		$criteria->params[":params"] = base64_decode($phone);
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (empty($model->otp)) {
			$this->redirect(Yii::app()->createUrl('user/Signin_phone'));
		}

		$user = new UserLoginPhone();
		$user->phone		=  $model->phone;
		$user->scenario = 'enterOtp';



		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {



			$user->attributes = $attributes;

			if (!$user->validate()) {


				// $notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {


				// $model->updateByPk($model->user_id,array('otp_login'=>rand ( 1000 , 9999 ) ));
				$this->redirect(Yii::app()->createUrl('member/dashboard'));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Phone Number Verification', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("login_phone_otp", compact('model', 'user'));
	}
	public function actionLogin_option()
	{

		$this->no_header = '1';
		if (Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Login', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("login_option", compact('model', 'user'), false, true);
			exit;
		}

		$this->render("login_option", compact('model', 'user'));
	}
	public function actionPartialInfo()
	{

		if (Yii::app()->user->getId()) {
			$this->renderPartial("_user_login_fetch");
		} else {
			echo '1';
			exit;
		}
	}
	public function actionLogin_option_pop()
	{

		$this->no_header = '1';
		if (Yii::app()->user->getId()) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Login', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("popup/login_option", compact('model', 'user'), false, true);
			exit;
		}

		$this->render("popup/login_option", compact('model', 'user'));
	}

	public function actionSignin_popup($step = 'step1')
	{
		ini_set('memory_limit', '-1');

		$return = null;
		$this->no_header = '1';
		$user = new UserLoginPopup();
		$user->scenario = $step;
		$user->email		=	isset(Yii::app()->request->cookies['email_login']) ? Yii::app()->request->cookies['email_login']->value : '';
		if (Yii::app()->request->getQuery('a', '') == 't') {
			$user->need_ajaxlogin = '1';
		}

		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if (Yii::app()->request->getQuery('t', '') == 'c') {
			$user->need_captcha_validation = '1';
		}
		if (Yii::app()->user->getId() and !Yii::app()->request->isPostRequest) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {
				$user->insertUser();
			}
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("popup/login", compact('model', 'user', 'return'), false, true);
			exit;
		}
		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign In')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
		));

		$this->render("popup/login", compact('model', 'user', 'return'));
	}

	public function actionEmail_otp($email = null)
	{
		ini_set('memory_limit', '-1');
		$this->no_header = '1';

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.email= :params ";
		$criteria->params[":params"] = base64_decode($email);
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (empty($model->verification_code)) {
			$this->redirect(Yii::app()->createUrl('user/Signin_phone'));
		}

		$user = new UserLoginPopup();
		$user->email		=  $model->email;
		$user->scenario = 'enterOtp';



		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
			$user->attributes = $attributes;

			if (!$user->validate()) {

				//  $notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				ListingUsers::model()->updateByPk((int)$model->user_id, array('email_verified' => '1'));

				$this->redirect(Yii::app()->createUrl('user/update_password', array('email' => base64_encode($model->email))));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Email Verification', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("popup/login_email_otp", compact('model', 'user', 'email'));
	}
	public function actionUpdate_password($email = null)
	{

		$this->no_header = '1';
		ini_set('memory_limit', '-1');
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;
		$criteria->condition = " t.email= :params ";
		$criteria->params[":params"] = base64_decode($email);
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (empty($model->otp_login)) {
			$this->redirect(Yii::app()->createUrl('user/Signin_phone'));
		}

		$model->scenario = 'updatepassword1';
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (!$model->save()) {

				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {


				$this->redirect(Yii::app()->createUrl('member/dashboard'));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Update Password', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));
		$model->password = '';
		$this->render("popup/login_updatepassword", compact('model', 'user'));
	}
	public function actionResend_otop_email($email = null)
	{

		$this->no_header = '1';

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.v_send_at IS NULL THEN t.date_added ELSE t.v_send_at  END , NOW()) AS hours_different ';

		$criteria->condition = " t.email= :params ";
		$criteria->params[":params"] =  base64_decode($email);

		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);



		if (empty($model)) {
			echo '0';
			exit;
		}

		if ($model->hours_different < 120 and !empty($model->verification_code)) {
			$otp = $model->verification_code;
		} else {
			$otp = rand(1000, 9999);
		}


		$model->verification_code = $otp;
		$out =  $model->sendOtpEmail();

		$model->updateByPk($model->user_id, array('verification_code' => $otp, 'v_send_at' => date('Y-m-d H:i:s')));
		echo '1';
	}
	public function actionSignin_password($email = null)
	{
		ini_set('memory_limit', '-1');
		$this->no_header = '1';
		$user = new UserLogin();
		$user->email		= base64_decode($email);
		if (Yii::app()->request->getQuery('a', '') == 't') {
			$user->need_ajaxlogin = '1';
		}
		$model = new ListingUsers();
		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}
		if (Yii::app()->request->getQuery('t', '') == 'c') {
			$user->need_captcha_validation = '1';
		}
		if (Yii::app()->user->getId() and !Yii::app()->request->isPostRequest) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}
		//  print_r($_POST);
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {
				if (!empty($return)) {
					$this->redirect(base64_decode($return));
				}
				$this->redirect(Yii::app()->createUrl('member/dashboard'));
				if ($this->options->get('system.common.email_verification_required', 'yes') == 'yes' && Yii::app()->user->getModel()->email_verified == '0') {
					$notify->addInfo(Yii::t('app', 'Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.', array('{p}' => $this->project_name)));
					$this->redirect(Yii::app()->createUrl('user/EmailVerification'));
				} else {
					$this->redirect(Yii::app()->createUrl('member/dashboard'));
				}
			}
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->unloader();
			$this->renderPartial("popup/login_password", compact('model', 'user', 'return'), false, true);
			exit;
		}
		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign In')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
		));

		$this->render("popup/login_password", compact('model', 'user', 'return'));
	}
	public function actionSignin_phone_popup($return = null)
	{
		ini_set('memory_limit', '-1');
		$this->no_header = '1';
		$user = new UserLoginPhone();
		$user->phone		=	isset(Yii::app()->request->cookies['phone']) ? Yii::app()->request->cookies['phone']->value : '';
		$user->scenario = 'enterPhonePopup';
		$model = new ListingUsers();
		$request = Yii::app()->request;
		if (Yii::app()->request->isAjaxRequest and !isset($_GET['_pjax'])) {
			echo CActiveForm::validate($user);
			Yii::app()->end();
		}

		if (Yii::app()->user->getId() and !Yii::app()->request->isPostRequest) {
			$this->redirect(Yii::app()->createUrl('member/dashboard'));
		}

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {


			$user->attributes = $attributes;
			if ($user->validate()) {


				$criteria = new CDbCriteria;
				$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
				$criteria->condition = " t.phone= :params ";
				$criteria->params[":params"] = Yii::t('app', $user->phone, array(' ' => ''));
				// $criteria->select="country_id,country_name";
				$model =  ListingUsers::model()->find($criteria);
				if (empty($model)) {

					$model  = new ListingUsers();
					$model->first_name  = 'Visitor';
					$model->email  = rand(0, 9999) . '_' . time() . '@feeta.pk';
					$model->phone  =  $attributes['phone'];
					$model->full_number  =  $attributes['full_number'];
					$model->email_verified = '0';
					$model->e_skipped = '1';
					$model->o_verified = '0';
					$model->enable_l_f = '0';
					$model->user_type  = 'U';
					$password = $this->randomPassword();
					$model->password  = $password;
					$model->con_password  = $password;
					$model->scenario  = 'new_update2';
					$model->otp =  rand(1000, 9999);
					if (!$model->save()) {
						throw new CHttpException(404, Yii::t('app', CHtml::errorSummary($model)));
					}
				}
				if ($model->hours_different < 10 and !empty($model->otp)) {
					$otp = $model->otp;
				} else {
					$otp = rand(1000, 9999);
				}

				$model->otp = $otp;
				ListingUsers::model()->updateByPk((int)$model->user_id, array('otp' => $otp, 'otp_login' => $otp, 'o_send_at' => date('Y-m-d H:i:s')));

				$out =  $model->getSendOtpLogin();

				$this->redirect(Yii::app()->createUrl('user/signin_phone_otp_pop', array('phone' => base64_encode(Yii::t('app', $model->phone, array(' ' => ''))))));
			}
		}

		if ($this->app->request->isAjaxRequest) {

			$this->unloader();
			$this->renderPartial("popup/login_phone", compact('model', 'user', 'return'), false, true);
			$this->app->end();
		}
		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Sign In via Phone')),
			'pageHeading'   => Yii::t('users', 'Please login'),
			'pageMetaDescription' => 'Claim your home and access insights and tools to help you understand the market.   Sign in Help you to maintain your listings and ads.',
		));

		$this->render("popup/login_phone", compact('model', 'user', 'return'));
	}
	public function actionSignin_phone_otp_pop($phone = null)
	{

		$this->no_header = '1';

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.phone= :params ";
		$criteria->params[":params"] = base64_decode($phone);
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if (empty($model->otp)) {
			$this->redirect(Yii::app()->createUrl('user/Signin_phone'));
		}

		$user = new UserLoginPhone();
		$user->phone		=  $model->phone;
		$user->scenario = 'enterOtp';



		if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
			$user->attributes = $attributes;

			if (!$user->validate()) {

				$notify->addError(Yii::t('app', 'Please fix your form errors!'));
			} else {

				ListingUsers::model()->updateByPk((int)$model->user_id, array('o_verified' => '1', 'otp' => rand(1000, 9999), 'o_send_at' => date('Y-m-d H:i:s')));

				// $model->updateByPk($model->user_id,array('otp_login'=>rand ( 1000 , 9999 ) ));
				$this->redirect(Yii::app()->createUrl('member/dashboard'));
			}
		}

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Phone Number Verification', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));

		$this->render("popup/login_phone_otp", compact('model', 'user'));
	}
	function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	public function actionDetectlocation()
	{

		$this->no_header = '1';

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		$this->setData(array(
			'pageTitle' =>    Yii::t('trans', '{title}', array('{title}' => 'Login', '{app}' => $this->options->get('system.common.site_name'))),
			'pageHeading'   => Yii::t('users', 'Please login'),
		));


		$this->render("_detect_location", compact('model', 'user'));
	}
	public function actionUpdate_location()
	{
		if (!Yii::app()->user->getId()) {
			echo json_encode(array('status' => '0', 'message' => 'Your login session timed out. Please Refresh and try again.'));
			exit;
		} else {
			if (!empty($_GET['address'])) {
				$ar = array('latitude' => @$_GET['lat'], 'longitude' => @$_GET['lng'], 'address' => @$_GET['address']);
			} else {
				$ar = array('latitude' => @$_GET['lat'], 'longitude' => @$_GET['lng']);
			}
			ListingUsers::model()->updateByPk((int)Yii::app()->user->getId(), $ar);
			echo json_encode(array('status' => '1', 'message' => 'Your location updated successfully.'));
			exit;
		}
	}
	public function actionResendOtp($phone = null)
	{

		$phone = base64_decode($phone);

		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.phone= :params ";
		$criteria->params[":params"] = Yii::t('app', $phone, array(' ' => ''));
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {


			echo json_encode(array('status' => '0', 'msg' => Yii::t('app', 'no user found')));
			exit;
		}

		$attemt = Yii::app()->options->get('system.common.try', '2');
		$attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours', '24');
		$attemt_last_hrs = $attemt_last_hrs1 * 60;
		if (((int)$model->hours_different <  $attemt_last_hrs)  and ((int) $model->otp_attempt >= (int)$attemt)) {
			$resetminutes =  ($attemt_last_hrs  - $model->hours_different);
			$reset = intdiv($resetminutes, 60) . ':' . ($resetminutes % 60);
			echo json_encode(array('status' => '0', 'msg' => Yii::t('app', '<span style="line-height:24px;font-size: 14px;">You have reached the limit to resend the code. Please use another method or try again later.    </span>')));
			exit;
		}

		if ($model->hours_different < 10 and !empty($model->otp)) {
			$otp = $model->otp;
		} else {
			$otp = rand(1000, 9999);
		}

		$model->otp_login = $otp;
		ListingUsers::model()->updateByPk((int)$model->user_id, array('otp' => $otp, 'otp_login' => $otp, 'o_send_at' => date('Y-m-d H:i:s'), 'otp_login_send' => date('Y-m-d H:i:s')));

		$out =  $model->getSendOtp();
		echo json_encode(array('status' => '1', 'msg' => Yii::t('app', 'Verification Code Sent')));
		exit;
	}
	public function actionResendOtp2($phone = null)
	{

		$phone = base64_decode($phone);

		$criteria = new CDbCriteria;
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ';
		$criteria->condition = " t.phone= :params ";
		$criteria->params[":params"] = Yii::t('app', $phone, array(' ' => ''));
		// $criteria->select="country_id,country_name";
		$model =  ListingUsers::model()->find($criteria);
		if (empty($model)) {


			echo json_encode(array('status' => '0', 'msg' => Yii::t('app', 'no user found')));
			exit;
		}

		$attemt = Yii::app()->options->get('system.common.try', '2');
		$attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours', '24');
		$attemt_last_hrs = $attemt_last_hrs1 * 60;
		if (((int)$model->hours_different <  $attemt_last_hrs)  and ((int) $model->login_attempt >= (int)$attemt)) {
			$resetminutes =  ($attemt_last_hrs  - $model->hours_different);
			$reset = intdiv($resetminutes, 60) . ':' . ($resetminutes % 60);
			echo json_encode(array('status' => '0', 'msg' => Yii::t('app', '<span style="line-height:24px;font-size: 14px;">You have reached the limit to resend the code. Please use another method or try again later.  {login} </span>', array('{login}' => '<a href="' . Yii::app()->createUrl('user/signin_popup') . '" style="display:block;color:blue;"    class="jilpeK">Click here to Login through Email </a>'))));
			exit;
		}

		if ($model->hours_different < 10 and !empty($model->otp)) {
			$otp = $model->otp;
		} else {
			$otp = rand(1000, 9999);
		}

		$model->otp_login = $otp;
		ListingUsers::model()->updateByPk((int)$model->user_id, array('otp' => $otp, 'otp_login' => $otp, 'o_send_at' => date('Y-m-d H:i:s'), 'otp_login_send' => date('Y-m-d H:i:s')));

		$out =  $model->getSendOtpLogin();
		echo json_encode(array('status' => '1', 'msg' => Yii::t('app', 'Successfully Resend Code.')));
		exit;
	}
}
