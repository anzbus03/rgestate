<?php
defined('MW_PATH') || exit('No direct script access allowed');

class ServicesController extends Controller
{

	public function init()
	{
		$this->layout = '//layouts/main_custom';
		parent::Init();
	}

	public function actionBuilding_maintenance(){
        $model = new ContactPopup;
        $this->setData(array(
            'pageTitle'             => "Building Maintenance".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Commercial & Industrial Building Maintenance Services in Dubai".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Trust RGEstate for top-notch Building Maintenance Services in Dubai. Our skilled professionals ensure longevity and safety for your property. contact us today for expert maintenance services.',
            'title'                 => "Building Maintenance" ,
            'description'           => "RGEstate offers top-notch building maintenance services in Dubai. Our expert team ensures your property remains in pristine condition, with a focus on quality and efficiency. Trust us for all your maintenance needs in this dynamic city.",
             
        ));
		$this->render('building-maintenance',compact('model'));
	}
	
	public function actionRetail_investments(){
        $model = new ContactPopup;
        $this->setData(array(
            'pageTitle'             => "Explore Lucrative Retail Investments in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Explore Lucrative Retail Investments in Dubai". ' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Discover lucrative opportunities in Dubai\'s retail sector with expert insights on retail investments at RGEstate.com. Explore the vibrant market, growth potential, and strategies for successful retail investments in Dubai.',
            'title'                 => "Explore Lucrative Retail Investments in Dubai",
            'description'           => 'Discover lucrative opportunities in Dubai\'s retail sector with expert insights on retail investments at RGEstate.com. Explore the vibrant market, growth potential, and strategies for successful retail investments in Dubai.',
             
        ));
		$this->render('retail-investments',compact('model'));
	}

	public function actionBusiness_buying_selling(){
        $model = new ContactPopup;
        $this->setData(array(
            'pageTitle'             => "Buying / Selling Businesses in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Buy & Sell Businesses in Dubai, UAE".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Discover top-notch business buying and selling solutions at RGEstate.com in Dubai. Explore seamless opportunities to acquire or sell businesses and maximize ROI today!',
            'title'                 => "Buying / Selling Businesses in Dubai" ,
            'description'           => "RGEstate is your premium destination for buying and selling businesses in Dubai . Whether you\'re interested in retail, trading, manufacturing, or any other sector, we offer tailored solutions to meet your unique needs.",
             
        ));
		$this->render('business-buying-selling',compact('model'));
	}

	public function actionInterior_fitouts(){
	    $model = new ContactPopup;
	    $this->setData(array(
            'pageTitle'             => "Interior Fitout in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Premium Interior & Fitouts Services in Dubai | Expert Interior Design".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Transform your space with top-notch Interior and fit-out services in Dubai. Elevate aesthetics and functionality with our expert solutions at RGEstate.com',
            'title'                 => "Interior Fitout in Dubai" ,
            'description'           => "At RGEstate, we take immense pride in our specialization in providing exceptional commercial and industrial fit-out services in the dynamic business landscape of Dubai.",
             
        ));
		$this->render('interior-fitouts',compact('model'));
	}

	public function actionProject_contracting(){
	    

	    $model = new ContactPopup;
	     $this->setData(array(
            'pageTitle'             => "Project Contracting in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Professional Project Contracting Services in Dubai".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Explore premium project contracting solutions designed to meet your specific requirements. Our skilled team guarantees flawless project execution in Dubai. Contact us today at RGEstate.com for expert assistance.',
            'title'                 => "Project Contracting in Dubai" ,
            'description'           => "Partner with RGEstate by Riveria Global Group for Tailored Project Contracting Solutions in Dubai and Flawless Project Execution.",
             
        ));
		$this->render('project-contracting',compact('model'));		
	}

	public function actionProject_development(){
	    
	    $model = new ContactPopup;
	    $this->setData(array(
            'pageTitle'             => "Project Developments in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Real Estate Project Developments in Dubai".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Stay informed about Dubai\'s evolving real estate scene with our latest project development updates. Discover innovative designs and investment prospects at RGEstate.com. Explore Dubai\'s Real Estate project developments now!',
            'title'                 => "Project Developments in Dubai" ,
            'description'           => "Transform your vision into reality with RGEstate\'s expert project development in Dubai. Your trusted partner for tailored solutions and successful execution.",
             
        ));
		$this->render('project-development',compact('model'));		
	}

	public function actionProject_funding(){
	    $model = new ContactPopup;
	    $this->setData(array(
            'pageTitle'             => "Project Funding in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Project Funding in Dubai | Financing Solutions for Your Ventures".' - '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Secure the financial foundation for your real estate endeavors in Dubai through our expert Project Funding services. RGEstate by Riveria Global Group is your partner for tailored funding solutions and accelerated project growth.',
            'title'                 => "Project Funding in Dubai" ,
            'description'           => "Are you seeking project funding in Dubai? Explore reliable financing options with RGEstate to support your business ventures in this dynamic market.",
             
        ));
		$this->render('project-funding',compact('model'));		
	}

	public function actionStartup_funding(){
	    $model = new ContactPopup;
	    $this->setData(array(
            'pageTitle'             => "Startup Funding in Dubai".' | '.BRAND_TITLE, 
            'pageMetaTitle'         => "Dubai Startups Funding: Discover Investment Opportunities in the UAE".' | '.BRAND_TITLE, 
            'pageMetaDescription'   => 'Elevate your Dubai startup with expert funding services. Unlock growth opportunities and thrive in the bustling business landscape with RGEstate',
            'title'                 => "Startup Funding in Dubai" ,
            'description'           => "Are you a visionary entrepreneur looking to launch your startup in Dubai? Our specialized Startup Funding service at RGEstate, a division of Riveria Global Group, is your key to accessing the financial resources needed to turn your innovative ideas into reality.",
             
        ));
	    
		$this->render('startup-funding',compact('model'));		
	}
	public function actionContact_popup(){
        
		$model = new ContactPopup;
		$notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		echo $model->name;
		$model->attributes = $attributes;
	    if($model->save())
		{
		    	$options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"az3438eqlm2fc"));;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"px349xcdrw78d"));;
				$emailTemplate_common = $options->get('system.email_templates.common');
			    if($emailTemplate)
			    {
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $model->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
					$emailTemplate = str_replace('{message}', nl2br($model->message), $emailTemplate);
					//$emailTemplate = str_replace('{subject}',  $model->city , $emailTemplate);					 
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($options->get('system.common.admin_email')));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$model->name, $emailTemplate);
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($model->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				  $notify->addSuccess(Yii::t('app','Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$options->get('system.common.site_name'))));
				  $this->refresh() ;
					 
					 
		}
		else
		{
		 
		   $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		}
	    }
		 
 
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     =>'Contact Us', 
            'pageMetaDescription'   => 'Questions or comments? We can help you. Reach us today or email at office@askaan.com', 
            'metaKeywords'   => 'Contact Us', 
        ));

        $this->render("index" , compact('model'));
        
    }
    public function actionSend(){
	    $request    = Yii::app()->request;
		$requestParms = $request->getPost("ContactPopup");
		$model  = new ContactPopup();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
				$model->attributes = $attributes;
		}
	    $createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
    	$customerId = 0;	    
        // Prepare data for the request
        $fullName = $requestParms['name'];
        
        // Split the full name into an array using spaces as the delimiter
        $nameParts = explode(' ', $fullName);
        
        // Extract the first and last names
        $firstName = isset($nameParts[0]) ? $nameParts[0] : null;
        $lastName = isset($nameParts[1]) ? $nameParts[1] : null;

        $crmCustomerData = [
            'fields' => [
                'NAME' => $firstName,
                'SECOND_NAME' => $lastName,
                "TYPE_ID" => "CLIENT",
                "SOURCE_ID" => "SELF",
                "EMAIL" => [[ "VALUE" => $requestParms['email'], "VALUE_TYPE" => "WORK" ]],
                "PHONE" => [[ "VALUE" => $requestParms['phone'], "VALUE_TYPE" => "WORK" ]]
            ],
        ];
        $postCustomerData = http_build_query($crmCustomerData);
        $contextCusotomerOptions = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postCustomerData,
            ],
        ];
        $contextCreateCustomer = stream_context_create($contextCusotomerOptions);
    	try {
            // Send the HTTP request using file_get_contents
            $data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
            $response = json_decode($data, true);
            $customerId = $response['result'];
            // Handle the CRM response as needed

        } catch (Exception $e) {
            // Handle exceptions, e.g., connection errors
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
        }
		
		$crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';
		$services = [
		    'Real Estate' => '2870',
            'Project Funding' => '2872',
            'Startups Funding' => '2874',
            'Retail Investments' => '2876',
            'Project Development' => '2878',
            'Project Contracting' => '2880',
            'Interior Fitouts' => '2882',
            'Building Maintenance' => '2884',
            'Business Buying & Selling' => '2886',    
		];
		// Prepare data for the request
		$crmData = [
			'FIELDS' => [
				'TITLE' => 'RGestate Lead - Service Form',
				'CATEGORY_ID' => 16,
                'CONTACT_ID' => $customerId,
                'ASSIGNED_BY_ID' => 22,
				'COMMENTS' => $requestParms['message'],
				'UF_CRM_6576C6B05945E' => $services[$requestParms['type']],
			],
		];

		// Convert data to a query string
		$postData = http_build_query($crmData);

		// Set up options for the stream context
		$contextOptions = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postData,
			],
		];

		$context = stream_context_create($contextOptions);


		try {
			// Send the HTTP request using file_get_contents
			$response = file_get_contents($crmUrl, false, $context);

			// Handle the CRM response as needed

		} catch (Exception $e) {
			// Handle exceptions, e.g., connection errors
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
		}

		if ($model->hasErrors()) {
			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
		} else {
			if(!$model->save()){
				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
			}else{
				echo json_encode(array('status'=>'1','name'=>$model->name , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
			}
		}

		// End the request to prevent any further output
		Yii::app()->end();
	}
}
