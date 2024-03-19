<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class UserController extends Controller
{
     public function  Init()
     {  	 
			parent::Init();
	 }
 
     public function actionSignup()
     {
		 
        $model = new ListingUsers();    
        $request = Yii::app()->request;
		$model->scenario = 'frontend_insert' ;  
	 
        if ($request->isPostRequest  ) {
		 
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			$model->status='A';
			$model->verification_code = md5(uniqid(rand(), true));
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
			    $notify     = Yii::app()->notify;
			    $data = array('user_id'=> $model->user_id,'email_verified'=>  $model->email_verified ,'status'=>  $model->status , 'email'=> $model->email , 'full_name'=> $model->fullName, 'slug'=> $model->slug, 'user_type'=> $model->user_type );
				$succes_data = array("Id"=>$model->user_id,"Name"=>$this->html_encode($model->first_name),"Email"=>$this->html_encode($model->email));
				$message1 = 'A verification link has been sent to your email account. \n Please click on the link that has just been sent to your email account to verify your email and continue the registration process.';
				echo $this->generateOutPut('SUCCESS','1',array(),$data,$message1);
			}
	    }
	    else{
	        
	        
                 	$input_data[] = array( 'field_name' => 'first_name' , 'label'=> $model->getAttributeLabel('first_name') , 'values' => array());
				$input_data[] = array( 'field_name' => 'last_name' , 'label'=> $model->getAttributeLabel('last_name') , 'values' => array());
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => array());
				$input_data[] = array( 'field_name' => 'password' , 'label'=> $model->getAttributeLabel('password') , 'values' => array());
				$country_value = CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name");
				$Ar = array();
				foreach($country_value as $kl=>$vl){
				 $Ar[] = array('id'=>$kl, 'name'=>$vl);
				}
				$input_data[] = array( 'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' => $Ar);
				$type_value = $model->getUserType();
				$Ar2 = array();
				foreach($type_value as $kl=>$vl){
				 $Ar2[] = array('id'=>$kl, 'name'=>$vl);
				}
				$input_data[] = array( 'field_name' => 'user_type' , 'label'=> $model->getAttributeLabel('user_type') , 'values' => $Ar2);
				echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data));
		} 
	    Yii::app()->end();
    } 
    public function actionSignin()
     {
		 
        $model = new   UserLogin();    
        $request = Yii::app()->request;
	  
	 
        if ($request->isPostRequest  ) {
		 
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
            if (!$model->validate()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
			   $message = '';
			   $userModel = ListingUsers::model()->findByAttributes(array('email'=>$model->email)); 
			   if($this->options->get('system.common.email_verification_required','yes')=='yes' &&  $userModel->email_verified=='0'){
				   $message = Yii::t('app','Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.',array('{p}'=>$this->options->get('system.common.site_name','Askaan.com'))) ;
				    
			   }
				echo $this->generateOutPut('SUCCESS','1',array(),array('user_id'=> $userModel->user_id,'email_verified'=>  $userModel->email_verified ,'status'=>  $userModel->status , 'email'=> $userModel->email , 'full_name'=> $userModel->fullName, 'slug'=> $userModel->slug, 'user_type'=> $userModel->user_type ),$message);
			}
	    }
	    else{
	        
	        
               	$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => array());
				$input_data[] = array( 'field_name' => 'password' , 'label'=> $model->getAttributeLabel('password') , 'values' => array());
			 	echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data));
		} 
	    Yii::app()->end();
    } 
    public function actionForgot_password()
     {
		 
        $model = new   ListingUserPasswordReset();    
        $request = Yii::app()->request;
	  
	 
        if ($request->isPostRequest  ) {
		 
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
            if (!$model->validate()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
			            $options = Yii::app()->options;
				    	$user = ListingUsers::model()->findByAttributes(array('email' => $model->email));
				    	$model->user_id = $user->user_id;
					    $model->save(false);
          
                        $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('km9820y438415');
                        $options     =   Yii::app()->options;
                        $support_phone  =  $options->get('system.common.support_phone');
                        $support_email  =  $options->get('system.common.support_email');
                        $notify     = Yii::app()->notify;
                        if(empty($emailTemplate)) { return true ; }
                        else{
                        $subject =  $emailTemplate->subject ;
                        $emailTemplate = $emailTemplate->content; 
                        $url = Yii::app()->createAbsoluteUrl('user/reset_password', array('reset_key' => $model->reset_key));
                        $emailTemplate = str_replace('[USER_NAME]' , $user->fullName, $emailTemplate);
                        $emailTemplate = Yii::t('app', $emailTemplate,array('HRESET_LINKH'=>$url));
                        $emailTemplate_common = $options->get('system.email_templates.common');
                        $emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
                        $status = 'S';
                        $adminEmail = new Email();			 
                        $adminEmail->subject = $subject ;
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
                        $message = Yii::t('app', Yii::app()->options->get('system.messages._meesage_after_forgot_password','Successfully Send Reset password link'));
		
			   
				echo $this->generateOutPut('SUCCESS','1',array(),array(),$message);
			}
	    }
	    else{
	        
	        
               	$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => array());
			 	echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data));
		} 
	    Yii::app()->end();
    } 
      public function actionEmail_Verify()
     {
		 
        $model = new   ListingUsers();    
        $request = Yii::app()->request;
	  
	 
        if ($request->isPostRequest  ) {
		 
		 
		      	$model = ListingUsers::model()->find(array(  "condition"=> 't.verification_code=:verify and t.user_id = :user_id' ,'params' => array(':verify'=>@$_POST['verification_code'],':user_id'=>@$_POST['user_id'])   ));
				if (empty($model)) {
			  		echo $this->generateOutPut('FAILED','0','The verification code not exist.',array());exit;
				}
				else{
			    ListingUsers::model()->updateByPk($model->user_id,array("email_verified"=>"1","verification_code" =>   $model->generatePIN(6) ));
			    $model->WelcomeEmail;
		    	echo $this->generateOutPut('SUCCESS','1',array(),array('user_status'=>$model->status),Yii::app()->options->get('system.messages.successfully_verified_email_msg','Succesfully verified  your email address.'));
				}
	    }
	    else{
	        
	        
               	$input_data[] = array( 'field_name' => 'verification_code' , 'label'=> $model->getAttributeLabel('verification_code') , 'values' =>array());
               	$input_data[] = array( 'field_name' => 'user_id' , 'label'=> $model->getAttributeLabel('user') , 'values' => array());
			 	echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data));
		} 
	    Yii::app()->end();
    } 
    public $image_size;
	public $image_name;
	  public function actionUpload2($width=null,$height=null,$upload_path='images')
    {
	 
    	    $request = Yii::app()->request;
			if($upload_path=='floor_plan'){
				$format1  = PlaceAnAd::model()->generateFormat();
				$format = explode(',',Yii::t('a',$format1,array('.'=>'')));
			}
			else{
				$format1 ='.gif,.jpg,.jpeg,.png';
				$format = explode(',',Yii::t('a',$format1,array('.'=>'')));
			}
 
	 
        if ($request->isPostRequest  ) {
	    
	    $path =  Yii::getPathOfAlias('root.uploads.'.$upload_path);
	    if(!isset($_FILES['file'])){
	         echo $this->generateOutPut('FAILED','0','File cannot be empty',array()); exit;
	    }
        $total = count($_FILES['file']['name']);
        
		$file_title = ''; $error_array = array(); 
		//Yii::import('backend.extensions.ResizeImage');
		 
				if($total>0)
				{
					ini_set('memory_limit', '-1');
					for( $i=0 ; $i < $total ; $i++ ) {
								$file = $_FILES['file']['name'][$i];
								$file_orginal = $_FILES['file']['tmp_name'][$i];
								$ext = pathinfo($file, PATHINFO_EXTENSION);
								$File = pathinfo($file, PATHINFO_FILENAME);
								if(!in_array(strtolower($ext),$format)){
									$error_array[] = array('image_name'=>$_FILES['file']['name'][$i],'error'=>'Invalid file type. Only  '.$format1.' types are accepted.');
									continue;
								}
								$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"),0,220);
								$new_name = empty($new_name) ? 'Untitled' : $new_name;
								$img = date('my').'_'.time().$new_name.'_'.".".$ext;
								if(!empty($width)){
								 
									$detSize = getimagesize($_FILES['file']['tmp_name'][$i]);
									if($detSize){
										if(empty($height)){
											$aspectRatio = $detSize[1] / $detSize[0];
											$newHeight = (int)($aspectRatio * $width)  ;
										}
										else{
											$newHeight = $height ; 
										}
										$this->image_size = $detSize ; 
										$this->image_name = $img ; 
										
										$tempPath = Yii::getPathOfAlias('root.uploads.resized');  
										$resized = $this->makeTumbnail($_FILES['file']['tmp_name'][$i],$width,$newHeight,$tempPath);
										
									}
								}
								if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $path."/{$img}")){ 
											$file_title  .= $img.',';
								}
								else{
											$error_array[] =  array('image_name'=>$_FILES['file']['name'][$i],'error'=>'Unable to upload');
							
								}
					}
					if(empty($file_title )){
						echo $this->generateOutPut('FAILED','0',$error_array,array('No Files uploaded'));
					}
					else{
						echo $this->generateOutPut('SUCCESS','1',$error_array,array('image_title'=>rtrim($file_title,',')));
					} 
			    }
			    else
			    {
			        echo $this->generateOutPut('FAILED','0','Unable to upload',array()); 
				 
				}
        }
        else{
            $input_data = array('field_name'=>'file','input_type'=>'file');
         	echo $this->generateOutPut('SUCCESS','1',array(),array('field_data'=>$input_data));
        }
				exit;
	}
    public function actionUpload($width=null,$height=null,$upload_path='images')
    {
	 
    	  $request = Yii::app()->request;
	  
	 
        if ($request->isPostRequest  ) {
	    
	    $path =  Yii::getPathOfAlias('root.uploads.'.$upload_path);
	    if(!isset($_FILES['file'])){
	         echo $this->generateOutPut('FAILED','0','File cannot be empty',array()); exit;
	    }
        
		//Yii::import('backend.extensions.ResizeImage');
		if($_FILES['file']['tmp_name'])
				{
					ini_set('memory_limit', '-1');
					$file = $_FILES['file']['name'];
					$file_orginal = $_FILES['file']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$File = pathinfo($file, PATHINFO_FILENAME);
					$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"),0,220);
					$new_name = empty($new_name) ? 'Untitled' : $new_name;
					$img = date('my').'_'.time().$new_name.'_'.".".$ext;
					if(!empty($width)){
					 
						$detSize = getimagesize($_FILES['file']['tmp_name']);
						if($detSize){
							if(empty($height)){
								$aspectRatio = $detSize[1] / $detSize[0];
								$newHeight = (int)($aspectRatio * $width)  ;
							}
							else{
								$newHeight = $height ; 
							}
							$this->image_size = $detSize ; 
							$this->image_name = $img ; 
							
							$tempPath = Yii::getPathOfAlias('root.uploads.resized');  
							$resized = $this->makeTumbnail($_FILES['file']['tmp_name'],$width,$newHeight,$tempPath);
							
						}
					}
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/{$img}");
					echo $this->generateOutPut('SUCCESS','1',array(),array('image_title'=> $img)); 
			    }
			    else
			    {
			        echo $this->generateOutPut('FAILED','0','Unable to upload',array()); 
				 
				}
        }
        else{
            $input_data = array('field_name'=>'file','input_type'=>'file');
         	echo $this->generateOutPut('SUCCESS','1',array(),array('field_data'=>$input_data));
        }
				exit;
	}
   public function makeTumbnail($filename, $width = 150, $height = true,$tempPath) {
			$url      = $filename ;
			$new_file_name =  $this->image_name;
			$filename = $tempPath.'/'.$new_file_name ; 			
			return $this->resize_crop_image($width,$height,$url,$filename,80);
			  
		}        
	 function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
			 
		$imgsize = $this->image_size;
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];

		switch($mime){
			case 'image/gif':
				$image_create = "imagecreatefromgif";
				$image = "imagegif";
				break;

			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;

			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 100;
				break;

			default:
				return false;
				break;
		}
		 
		$dst_img = imagecreatetruecolor($max_width, $max_height);
		if($mime=='image/png'){
			imageAlphaBlending($dst_img, false);
			imageSaveAlpha($dst_img, true);
			imagefilledrectangle($dst_img, 0, 0, $max_width, $max_height, imagecolorallocate($dst_img, 255, 255, 255));
		}
		$src_img = $image_create($source_file);
		 
		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}
		 
		$image($dst_img, $dst_dir, $quality);

		if($dst_img){ imagedestroy($dst_img); return true ; }
		if($src_img) { imagedestroy($src_img); return true ; }
		}
	public function generateKeyArray($araay){
	    $ar =array();
	    if(!empty($araay)){
	        foreach($araay as $k=>$v){
	        $ar[] =  array('id'=>$k,'name'=>$v);
	        }
	    }
	    return $ar;
	    
	}
	 function actionUpdate_user($user_id=null)
	 {
		$options = Yii::app()->options;  
		$user =  new ListingUsers();
        $user =  $user->findByPk((int)$user_id);
        $request = Yii::app()->request;
	  
        if(empty($user)){ echo $this->generateOutPut('FAILED','0', 'No User Found',array());exit; }
		if(in_array($user->user_type,array('C','A'))){
				if($user->user_type=='C'){
				$model = Agencies::model()->findByPk($user_id);
				$scenario = 'agent_update1'; 
				}
				else{
				$model = Agents::model()->findByPk($user_id);			 
				$scenario = 'agent_update1'; 
				}
		}
		else if($user->user_type=='D'){
				$model = Developer::model()->findByPk($user_id);
				$scenario = 'developer_update1'; 			 
		}

		if(empty($model)){
			echo $this->generateOutPut('FAILED','0', 'No User Found',array());exit;
		}
		$model->scenario = $scenario;
        if ($request->isPostRequest  ) {
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if (!$model->save()) {
					echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
					echo $this->generateOutPut('SUCCESS','1',array(),array(),Yii::app()->options->get('system.messages.successfully_saved_personal_information','Succesfully saved personal information.'));
			}
		 
	    }
        else
        {
				$input_data[] = array( 'field_name' => 'first_name' , 'label'=> $model->getAttributeLabel('first_name') , 'values' =>array(),'field_value'=>$this->checkEmpty($model->first_name),'is_multiple_select'=>'' );
				$input_data[] = array( 'field_name' => 'last_name' , 'label'=> $model->getAttributeLabel('last_name') , 'values' => array(),'field_value'=>$this->checkEmpty($model->last_name),'is_multiple_select'=>'' );
				
				$input_data[] = array( 'field_name' => 'designation_id' , 'label'=> $model->getAttributeLabel('designation_id') , 'values' =>$this->generateKeyArray(CHtml::listData(AgentRole::model()->listData(),'service_id','service_name')),'field_value'=>$this->checkEmpty($model->designation_id),'is_multiple_select'=>''   );
				
				$input_data[] = array( 'field_name' => 'company_name' , 'label'=> $model->getAttributeLabel('company_name') , 'values' => array(),'field_value'=>$this->checkEmpty($model->company_name),'is_multiple_select'=>'');
			
				$input_data[] = array( 'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' =>$this->generateKeyArray(CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name")),'field_value'=>$this->checkEmpty($model->country_id),'is_multiple_select'=>'');
				
				$input_data[] = array( 'field_name' => 'state_id' , 'label'=> $model->getAttributeLabel('state_id') , 'values' =>$this->generateKeyArray(CHtml::listData(States::model()->getStateWithCountry_2($model->country_id),"state_id" ,"state_name")),'field_value'=>$this->checkEmpty($model->state_id),'is_multiple_select'=>'');
				
				$input_data[] = array( 'field_name' => 'address' , 'label'=> $model->getAttributeLabel('address') , 'values' =>array(),'field_value'=>$this->checkEmpty($model->address),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'phone' , 'label'=> $model->getAttributeLabel('phone') , 'values' => array(),'field_value'=>$this->checkEmpty($model->phone),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'website' , 'label'=> $model->getAttributeLabel('website') , 'values' => array(),'field_value'=>$this->checkEmpty($model->website),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'contact_person' , 'label'=> $model->getAttributeLabel('contact_person') , 'values' => array(),'field_value'=>$this->checkEmpty($model->contact_person),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'contact_email' , 'label'=> $model->getAttributeLabel('contact_email') , 'values' => array(),'field_value'=>$this->checkEmpty($model->contact_email),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'facebook' , 'label'=> $model->getAttributeLabel('facebook') , 'values' => array(),'field_value'=>$this->checkEmpty($model->facebook),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'twiter' , 'label'=> $model->getAttributeLabel('twiter') , 'values' => array(),'field_value'=>$this->checkEmpty($model->twiter),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'google' , 'label'=> $model->getAttributeLabel('google') , 'values' => array(),'field_value'=>$this->checkEmpty($model->google),'is_multiple_select'=>'');
				
				
				$datas = CHtml::listData(Section::model()->listData(),'section_id','section_name') ;
				unset($datas['3']);
				$datas =$this->generateKeyArray($datas);
				$input_data[] = array( 'field_name' => 'service_offerng[]' , 'label'=> $model->getAttributeLabel('service_offerng') , 'values' => $datas ,'field_value'=>array_values((array) CHtml::listData($model->moreSection,'section_id','section_id')),'is_multiple_select'=>'1');
				$datas = $this->generateKeyArray(CHtml::listData(Category::model()->listData(),'category_id','category_name')) ;
				$input_data[] = array( 'field_name' => 'service_offerng_detail[]' , 'label'=> $model->getAttributeLabel('service_offerng_detail') , 'values' => $datas ,'field_value'=> array_values((array) CHtml::listData($model->moreCategory,'category_id','category_id')),'is_multiple_select'=>'1');
				$input_data[] = array( 'field_name' => 'languages_known[]' , 'label'=> $model->getAttributeLabel('languages_known') , 'values' => $this->generateKeyArray(Language::getLanguagesArray()),'field_value'=> array_values((array) CHtml::listData($model->moreLanguages,'language_id','language_id')),'is_multiple_select'=>'1' );
				
				$input_data[] = array( 'field_name' => 'mul_country_id[]' , 'label'=> $model->getAttributeLabel('mul_country_id') , 'values' => $this->generateKeyArray(CHtml::listData(Countries::model()->Countrylist2(),'country_id','country_name'))  ,'field_value'=> array_values((array) CHtml::listData($model->moreCountry,'country_id','country_id')),'is_multiple_select'=>'1' );
				$input_data[] = array( 'field_name' => 'mul_state_id[]' , 'label'=> $model->getAttributeLabel('mul_state_id') , 'values' => $this->generateKeyArray( CHtml::listData(States::model()->findAllByAttributes(array('state_id'=>$model->mul_state_id)),'state_id','state_name')), 'field_value'=>array_values((array) CHtml::listData($model->moreState,'state_id','state_id')),'is_multiple_select'=>'1');
				
				$input_data[] = array( 'field_name' => 'description' , 'label'=> $model->getAttributeLabel('description') , 'values' =>array() ,'field_value'=>$this->checkEmpty($model->description),'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'licence_no' , 'label'=> $model->getAttributeLabel('licence_no') , 'values' => array() ,'field_value'=>$this->checkEmpty($model->licence_no),'is_multiple_select'=>'' );
				
				if($model->user_type=='D'){
				 $resize_width  = $options->get('system.upload.developer_avatar_resize_width','');
				 $resize_height = $options->get('system.upload.developer_avatar_resize_height','');
			    }else{
					$resize_width  = '400';
					$resize_height = '400';
				}
				$image_logo_detail = array('file_name'=>'file','format'=>'gif , jpg , jpeg , png','width'=>$resize_width,'height'=>$resize_height,'upload_url'=>Yii::App()->apps->getBaseUrl('user/upload?width='.$resize_width.'&height='.$resize_height,true));
				
				$input_data[] = array( 'field_name' => 'image' , 'label'=> $model->getAttributeLabel('image') , 'values' =>array() ,'field_value'=>!empty($model->image) ? $model->UserAvatarUrlAbsolute : array() ,'is_multiple_select'=>'','upload_details'=>$image_logo_detail );
				  $fields_hidden = array();
				if($model->user_type!='A'){   $fields_hidden[] = 'designation_id'; }
				if(!in_array($model->user_type,array('C','D'))){ 
				$fields_hidden[] = 'company_name';
				}				
				if(!in_array($model->user_type,array('A'))){ 
				$fields_hidden[] = 'languages_known';
				$fields_hidden[] = 'service_offerng';
				$fields_hidden[] = 'service_offerng_detail';
				}	
				$mandatory_fields = array();
				$mandatory_fields[] = 'first_name'	;		
				$mandatory_fields[] = 'country_id'	;		
				$mandatory_fields[] = 'address'	;		
				$mandatory_fields[] = 'phone'	;		
				$mandatory_fields[] = 'mul_country_id'	;		
				$mandatory_fields[] = 'description'	;
				if(in_array($model->user_type,array('A'))){
					$mandatory_fields[] = 'designation_id'	;
					$mandatory_fields[] = 'languages_known'	;
				}		
				 
				echo $this->generateOutPut('SUCCESS','1',array(),array('field_data'=>$input_data,'mandatory_fields'=>$mandatory_fields,'hidden_fields'=>$fields_hidden));
			 
  
		}
		 
	 }
	  public function actionLoadCity(){
		 
		$limit = 30;
		$request = Yii::app()->request;
		$criteria=new CDbCriteria;
        $criteria->compare('state_name',$request->getQuery('q'), true);
        $criteria->compare('t.isTrash','0');
        $country_array = explode(',',$request->getQuery('country_id')); 
        $criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = cn.country_id  ' ;
         $criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END ';
        $criteria->addInCondition('t.country_id',$country_array);
        
        $criteria->select = 't.state_id,state_name';
        $count = States::model()->count($criteria);
        $criteria->order = 'state_name ASC';
        $criteria->group = 'state_name';
        $criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
        
        $data = States::model()->findAll($criteria);
        $ar = array(); 
         
        if($data){
			foreach($data as $k=>$v){
				  
				 $ar[]= array('id'=> $v->state_id,'text'=> $v->state_name  );
			}
		}
		if($request->getQuery('city_id') != 'null'){
		$city_array = explode(',',$request->getQuery('city_id')); 
		if(!empty($city_array) ){
			$criteria=new CDbCriteria;
			$criteria->addInCondition('t.state_id',$city_array);
			$criteria->addInCondition('t.country_id',$country_array);
			$data2 = States::model()->findAll($criteria);
			if($data2){
			foreach($data2 as $k=>$v){
				  
				 $ar[]= array('id'=> $v->state_id,'text'=> $v->state_name  );
			}
		}
		}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo $this->generateOutPut('SUCCESS','1',array(),$record);	
		 
	 
	}
	 public function actionContact()
     {
		 
        $model = new ContactUs();    
        $options = Yii::app()->options;
        $request = Yii::app()->request;
        if ($request->isPostRequest  ) {
				
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),$model->getErrors());
			}
			else
			{ 
				$succes_data = array( "Name"=>$this->html_encode($model->name),"Email"=>$this->html_encode($model->email));
				$emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"az3438eqlm2fc"));;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"px349xcdrw78d"));;
				$emailTemplate_common = $options->get('system.email_templates.common');
			    if($emailTemplate)
			    {
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $model->city, $emailTemplate);
					$emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
					$emailTemplate = str_replace('{message}', nl2br($model->meassage), $emailTemplate);
					$emailTemplate = str_replace('{subject}',  $model->city , $emailTemplate);					 
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
				$message = Yii::t('app','Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$options->get('system.common.site_name')));
				echo $this->generateOutPut('SUCCESS','1',array(),$succes_data,$message);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'name' , 'label'=> $model->getAttributeLabel('name') , 'values' => $this->checkEmpty($model->name) );
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' =>  $this->checkEmpty($model->email) );
				$input_data[] = array( 'field_name' => 'city' , 'label'=> $model->getAttributeLabel('city') , 'values' => $this->checkEmpty( $model->city) );
				$input_data[] = array( 'field_name' => 'meassage' , 'label'=> $model->getAttributeLabel('meassage') , 'values' =>  $this->checkEmpty($model->meassage) );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    }
    
    public function actionResent_code($email=null){
		 
		 $model =  ListingUsers::model()->findByAttributes(array('email'=>$email));
		 if(empty($model)){
			 echo $this->generateOutPut('FAILED','0', 'No user found' ,array());exit;
		 }
		 if($model->email_verified=='1'){
			 echo $this->generateOutPut('FAILED','0', 'User already verified ' ,array());exit;
		 }
		 $model->verification_code =  $model->generatePIN(6);;
		 if (ListingUsers::model()->updateByPk((int)$model->user_id, array('verification_code' => $model->verification_code))) { 
			$model->sendVerificationEmail();
			echo $this->generateOutPut('SUCCESS','1', '' ,array(),Yii::t('app', 'Check your inbox for email confirmation! Please note that sometimes the email might land in spam\/junk!'),'Verification');
		}
		exit;
	 }
	 public function actionContact_Agent_detail($agent_id=null)
     {
		 
		$agent =  ListingUsers::model()->findByPk($agent_id);
		if(empty($agent)){
			echo $this->generateOutPut('FAILED','0','No agent found',array());exit;
		}
		 
        $model = new ContactAgent(); 
        $model->user_id = $agent->user_id ;    
        $request = Yii::app()->request; 
        if ($request->isPostRequest  ) {
				
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
			//	$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($user->name),"Email"=>$this->html_encode($user->email));
				echo $this->generateOutPut('SUCCESS','1',array(),array(),'Succesfully submited');
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'name' , 'label'=> $model->getAttributeLabel('name') , 'value' => $model->name ,'values'=>array());
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'value' => $model->email ,'values'=>array() );
				$input_data[] = array( 'field_name' => 'phone' , 'label'=> $model->getAttributeLabel('phone') , 'value' => $model->phone  ,'values'=>array());
				$input_data[] = array( 'field_name' => 'considering' , 'label'=> 'I am considering' , 'value' => $model->city ,'values'=>array('S'=>'Sale','B'=>'Buy') );
				$input_data[] = array( 'field_name' => 'meassage' , 'label'=> $model->getAttributeLabel('meassage') , 'value' => $model->meassage ,'values'=>array() );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    }
    public function actionGet_dashboard_stat($user_id=null){
		 $user = ListingUsers::model()->findByPk($user_id);
		 if(empty($user)){
			 echo $this->generateOutPut('FAILED','0','No user found',array());exit;
		 }
		 $counter = PlaceAnAd::model()->getCounter($user_id);
		 echo $this->generateOutPut('SUCCESS','1', '' ,$counter,'','At a glance');
		 exit;
	 }
	public function actionChangePassword($user_id=null)
     {
		$model =  ListingUsers::model()->findByPk($user_id);
		if(empty($model)){
			 echo $this->generateOutPut('FAILED','0','No User Found',array());exit; 
		} 
        $request = Yii::app()->request;
		 
        if ($request->isPostRequest  ) {
				
			$attributes =  (array)$_POST ;
			$model->attributes = $attributes;
			$model->password= $attributes['password'];
			$model->old_password= $attributes['old_password'];
			$model->scenario = 'updatepassword' ; 
		 
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
			 
				echo $this->generateOutPut('SUCCESS','1',array(),array(),'Successfully updated password');
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'old_password' , 'label'=> $model->getAttributeLabel('old_password') , 'values' => '');
				$input_data[] = array( 'field_name' => 'password' , 'label'=> $model->getAttributeLabel('password') , 'values' => '');
				$input_data[] = array( 'field_name' => 'con_password' , 'label'=> $model->getAttributeLabel('con_password') , 'values' => '');
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    } 
    public function actionError()
    {
		//$this->layout =   Yii::app()->LayoutClass->layoutpath("sub"); 
		//$this->headerImage  =  Yii::app()->theme->baseUrl.'/images/404.jpg';
        if ($error = Yii::app()->errorHandler->error) {
           
            	echo $this->generateOutPut('FAILED','0', Yii::t('app',@$error['message']) ,array());exit;
        }
    }
    public function actionFavourite_api(){
       
		  $request = Yii::app()->request;
		  if ($request->isPostRequest  ) {
					$loged_in_user = @$_POST['user_id'];
					$ad_id 		   = @$_POST['ad_id'];
					$fun 		   = @$_POST['fun'];
					 
					if(!in_array($fun,array('add_favourite','remove_favourite'))){
						echo $this->generateOutPut('FAILED','0','No Function Found',array());exit; 
					}
					$user_model =  ListingUsers::model()->findByPk($loged_in_user);
					$ad_model =  PlaceAnAd::model()->findByPk($ad_id);
					if(empty($user_model)){
						 echo $this->generateOutPut('FAILED','0','No User Found',array());exit; 
					}
					if(empty($ad_model)){
						 echo $this->generateOutPut('FAILED','0','No AD Found',array());exit; 
					}
					$message = ''; 
					$class = ''; 
					if($fun =='add_favourite'){
							$found = AdFavourite::model()->findByAttributes(array('ad_id'=>$ad_id,'user_id'=>$loged_in_user));
							if(empty($found)){
								$model = new AdFavourite();
								$model->user_id =  $loged_in_user;
								$model->ad_id   =  $ad_id;
								if($model->save()){
									echo $this->generateOutPut('SUCCESS','1',array(),array('is_user_fav'=>'1'), 'Successfully added to favourite property' );
								}
								else{
									echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
								}
							}
							else{
								 echo $this->generateOutPut('SUCCESS','1',array(), array('is_user_fav'=>'1'), 'Successfully added to favourite property' );
							}
							exit; 
					 
					}
					if($fun =='remove_favourite'){
							$found = AdFavourite::model()->findByAttributes(array('ad_id'=>$ad_id,'user_id'=>$loged_in_user));
							if($found){
								$found->delete();
							}
							$message = 'Successfully removed from favourite property';
							echo $this->generateOutPut('SUCCESS','1',array(),array('is_user_fav'=>'0') , $message );
								exit; 
					}
				}
				else{
				$input_data[] = array( 'field_name' => 'user_id' , 'label'=>'Logged in user'  , 'values' => array());
				$input_data[] = array( 'field_name' => 'ad_id' , 'label'=> 'Ad ID' , 'values' => array() );
				$input_data[] = array( 'field_name' => 'fun' , 'label'=> 'Function' , 'values' => array('add_favourite','remove_favourite') );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
					exit; 
		} 
				
						exit; 
					
				 
	}
	 public function actionFollow_api(){
       
		  $request = Yii::app()->request;
		  if ($request->isPostRequest  ) {
					$follow 		= @$_POST['follow'];
					$followed_by    = @$_POST['followed_by'];
					$fun 		   = @$_POST['fun'];
					 
					if(!in_array($fun,array('add_follow','remove_follow'))){
						echo $this->generateOutPut('FAILED','0','No Function Found',array());exit; 
					}
					$follow_model =  ListingUsers::model()->findByPk($follow);
					if(empty($follow_model)){
						 echo $this->generateOutPut('FAILED','0','No Follow User Found',array());exit; 
					}
					
					$followed_by_model =  ListingUsers::model()->findByPk($followed_by);
				
					if(empty($followed_by_model)){
						 echo $this->generateOutPut('FAILED','0','No Followed By User Found',array());exit; 
					}
					$message = ''; 
					$class = ''; 
					if($fun =='add_follow'){
							$found = UserFollow::model()->findByAttributes(array('follow'=>$follow,'followed_by'=>$followed_by));
							if(empty($found)){
								$model = new UserFollow();
								$model->follow 		  =  $follow;
								$model->followed_by   =  $followed_by;
								if($model->save()){
									echo $this->generateOutPut('SUCCESS','1',array(),array('is_user_follow'=>'1'), 'Successfully added to following list' );
								}
								else{
									echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
								}
							}
							else{
								 echo $this->generateOutPut('SUCCESS','1',array(), array('is_user_follow'=>'1'), 'Successfully added to following list' );
							}
							exit; 
					 
					}
					if($fun =='remove_follow'){
							$found = UserFollow::model()->findByAttributes(array('follow'=>$follow,'followed_by'=>$followed_by));
							if($found){
								$found->delete();
							}
							$message = 'Successfully removed  from  following list';
							echo $this->generateOutPut('SUCCESS','1',array(),array('is_user_follow'=>'0') , $message );
								exit; 
					}
				}
				else{
				$input_data[] = array( 'field_name' => 'follow' , 'label'=>'follow user'  , 'values' => array());
				$input_data[] = array( 'field_name' => 'followed_by' , 'label'=> 'followed by user ' , 'values' => array() );
				$input_data[] = array( 'field_name' => 'fun' , 'label'=> 'Function' , 'values' => array('add_follow','remove_follow') );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
					exit; 
		} 
				
						exit; 
					
				 
	}
	 public function actionAddProperty_comment()
     {
		 
        $model = new PropertyComment();    
        $request = Yii::app()->request;
        if ($request->isPostRequest  ) {
				
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if(isset($attributes['replay_id']) and !empty($attributes['replay_id'])){
	 
				$comment = PropertyComment::model()->findByPk( $attributes['replay_id']);
				 
				if(empty($comment)){
					echo $this->generateOutPut('FAILED','0','Comment id not exit',array()); exit; 
				}
			}
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
				$val  = array_filter($model->attributes);
				unset($val['date_added']);
				unset($val['last_updated']);
				echo $this->generateOutPut('SUCCESS','1',array(),$val);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'user_id' , 'label'=> $model->getAttributeLabel('user_id') , 'values' => array());
				$input_data[] = array( 'field_name' => 'ad_id' , 'label'=> $model->getAttributeLabel('ad_id') , 'values' => array());
				$input_data[] = array( 'field_name' => 'comment' , 'label'=> $model->getAttributeLabel('comment') , 'values' => array());
				$input_data[] = array( 'field_name' => 'replay_id' , 'label'=> $model->getAttributeLabel('replay_id') , 'values' =>array());
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    } 
    public function actionUpdateProperty_comment($comment_id=null,$logged_user_id=null)
     {
		 
        $model =  PropertyComment::model()->findByPk($comment_id); 
        if(empty($model)){
				echo $this->generateOutPut('FAILED','0', 'Comment cannot be blank ' ,array(),''); exit; 
		}
		if($model->user_id != $logged_user_id){
				echo $this->generateOutPut('FAILED','0', 'Sorry you dont have permission to update' ,array(),''); exit; 
		}
        $request = Yii::app()->request;
        if ($request->isPostRequest  ) {
			$model->comment = $_POST['comment'];
			$model->user_id    = $logged_user_id;
		 
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
				$val  = array_filter($model->attributes);
				unset($val['date_added']);
				unset($val['last_updated']);
				echo $this->generateOutPut('SUCCESS','1',array(),$val);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'comment' , 'label'=> $model->getAttributeLabel('comment') , 'values' => array());
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    } 
    public function actionList_property_comment($ad_id=null,$limit=10,$offset=0)
     {
		$ad = PlaceAnAd::model()->findByPk($ad_id); 
		if(empty($ad)){
			echo $this->generateOutPut('FAILED','0', 'Ad cannot be blank ' ,array(),''); exit; 
		}
        $model = new PropertyComment();
        $criteria=new CDbCriteria;   
        $criteria->order  ="t.comment_id asc";
        $criteria->select = 't.*,usr.first_name,usr.last_name,usr.image, ( select count(*) from {{property_comment}} rep  where rep.replay_id = t.comment_id )  as total_count ';
        $criteria->condition .= ' 1 and t.replay_id IS NULL and t.ad_id=:adid ';
        $criteria->params[':adid'] = $ad_id ; 
        $criteria->join      .= ' INNER JOIN {{listing_users}} usr on  usr.user_id = t.user_id  and usr.isTrash="0" ';
		$criteria->offset = $offset ;
		$criteria->limit = $limit ;	 
        $model= PropertyComment::model()->findAll($criteria);
        $comment_array = array(); 
        if(!empty($model)){
			foreach($model as $k=>$v){
			       $comment_array[] = array( 'total_replay' => $v->total_count, 'comment_id'=>$v->comment_id,'comment'=>$v->comment ,'user_id'=>$v->user_id ,   'user_name'=> $v->first_name.' '.$v->last_name,   'user_image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) )  ;
			}
			 echo $this->generateOutPut('SUCCESS','1', '' ,$comment_array,'');
		}
		else{
			   echo $this->generateOutPut('FAILED','0', 'No Comments Found' ,array(),'');
		}
	
	    Yii::app()->end();
    } 
    public function actionList_replay__property_comment($comment_id=null,$limit=10,$offset=0)
     {
		$ad = PropertyComment::model()->findByPk($comment_id); 
		if(empty($ad)){
			echo $this->generateOutPut('FAILED','0', 'Comment cannot be blank ' ,array(),''); exit; 
		}
        $model = new PropertyComment();
        $criteria=new CDbCriteria;   
        $criteria->order  ="t.comment_id asc";
        $criteria->select = 't.*,usr.first_name,usr.last_name,usr.image, ( select count(*) from {{property_comment}} rep  where rep.replay_id = t.comment_id )  as total_count ';
        $criteria->condition .= ' 1 and t.replay_id=:comment_id ';
        $criteria->params[':comment_id'] = $comment_id ; 
        $criteria->join      .= ' INNER JOIN {{listing_users}} usr on  usr.user_id = t.user_id  and usr.isTrash="0" ';
		$criteria->offset = $offset ;
		$criteria->limit = $limit ;	 
        $model= PropertyComment::model()->findAll($criteria);
        $comment_array = array(); 
        if(!empty($model)){
			foreach($model as $k=>$v){
			       $comment_array[] = array( 'comment_id'=>$v->comment_id,'comment'=>$v->comment ,'user_id'=>$v->user_id ,   'user_name'=> $v->first_name.' '.$v->last_name,   'user_image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true), 'replay_for_comment_id'=>$v->replay_id,'total_replay' => $v->total_count )  ;
			}
			 echo $this->generateOutPut('SUCCESS','1', '' ,$comment_array,'');
		}
		else{
			   echo $this->generateOutPut('FAILED','0', 'No Comments Found' ,array(),'');
		}
	
	    Yii::app()->end();
    } 
     public function actionList_replay_comment($comment_id=null,$limit=10,$offset=0)
     {
		$ad = PropertyComment::model()->findByPk($comment_id); 
		if(empty($ad)){
			echo $this->generateOutPut('FAILED','0', 'Comment cannot be blank ' ,array(),''); exit; 
		}
        $model = new PropertyComment();
        $criteria=new CDbCriteria;   
        $criteria->order  ="t.comment_id asc";
        $criteria->select = 't.*,usr.first_name,usr.last_name,usr.image, ( select count(*) from {{property_comment}} rep  where rep.replay_id = t.comment_id )  as total_count ';
        $criteria->condition .= ' 1 and t.replay_id=:comment_id ';
        $criteria->params[':comment_id'] = $comment_id ; 
        $criteria->join      .= ' INNER JOIN {{listing_users}} usr on  usr.user_id = t.user_id  and usr.isTrash="0" ';
		$criteria->offset = $offset ;
		$criteria->limit = $limit ;	 
        $model= PropertyComment::model()->findAll($criteria);
        $comment_array = array(); 
        if(!empty($model)){
			foreach($model as $k=>$v){
			       $comment_array[] = array( 'comment_id'=>$v->comment_id,'comment'=>$v->comment ,'user_id'=>$v->user_id ,   'user_name'=> $v->first_name.' '.$v->last_name,   'user_image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true), 'replay_for_comment_id'=>$v->replay_id,'total_replay' => $v->total_count )  ;
			}
			 echo $this->generateOutPut('SUCCESS','1', '' ,$comment_array,'');
		}
		else{
			   echo $this->generateOutPut('FAILED','0', 'No Comments Found' ,array(),'');
		}
	
	    Yii::app()->end();
    } 
    
    public function actionDelete_property_comment($comment_id=null,$logged_user_id=null){
			$ad = PropertyComment::model()->findByPk($comment_id); 
			if(empty($ad)){
				echo $this->generateOutPut('FAILED','0', 'Comment cannot be blank ' ,array(),''); exit; 
			}
			if($ad->user_id != $logged_user_id){
				echo $this->generateOutPut('FAILED','0', 'Sorry you dont have permission to delete' ,array(),''); exit; 
			}
			$ad->delete();
			 echo $this->generateOutPut('SUCCESS','1', '' ,'Succesfully deleted comment','');
	}
	  public function actionFb_login_register($email=null,$first_name=null,$last_name=null)
     {
		
					    if(!empty($email)){
					     $model = new ListingUsers();
					     $registered = $model->findByEmail($email);
					     if($registered)
						 {
								$identity = new UserIdentity($registered ->email, null);
								$identity->impersonate = true;
								if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
								 	 echo $this->generateOutPut('FAILED','0','Unable to login',array());exit; 
								}
								else{
                                    $message = '';
                                        $userModel =  $registered ;
                                       if($this->options->get('system.common.email_verification_required','yes')=='yes' &&  $userModel->email_verified=='0'){
                                            $message = Yii::t('app','Before you can continue, you need to check your inbox for a message from the {p} account team. Follow the instructions in the mail to finish setting up your account.',array('{p}'=>$this->options->get('system.common.site_name','Askaan.com'))) ;
                                    
                                        }
                                    echo $this->generateOutPut('SUCCESS','1',array(),array('user_id'=> $userModel->user_id,'email_verified'=>  $userModel->email_verified ,'status'=>  $userModel->status , 'email'=> $userModel->email , 'full_name'=> $userModel->fullName, 'slug'=> $userModel->slug, 'user_type'=> $userModel->user_type ),$message);

								}
						}
						else{
						    
								    $model->email_verified = '1';
								    $model->registered_via = 'facebook';
								    $model->email = $email;
								    $model->first_name = $first_name;
								    $model->last_name  = $last_name;
									$input_data[] = array( 'field_type' => 'hidden' , 'field_name' => 'registered_via' , 'label'=> $model->getAttributeLabel('registered_via') , 'values' => 'facebook' );
									$input_data[] = array(  'field_type' => 'hidden' ,  'field_name' => 'email_verified' , 'label'=> $model->getAttributeLabel('email_verified') , 'values' => '1' );
									$input_data[] = array( 'field_type' => 'hidden' ,  'field_name' => 'first_name' , 'label'=> $model->getAttributeLabel('first_name') , 'values' => $model->first_name);
									$input_data[] = array( 'field_type' => 'hidden' ,  'field_name' => 'last_name' , 'label'=> $model->getAttributeLabel('last_name') , 'values' => $model->last_name);
									$input_data[] = array(  'field_type' => 'hidden' , 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => $model->email);
									$input_data[] = array(  'field_type' => 'visible' , 'field_name' => 'password' , 'label'=> $model->getAttributeLabel('password') , 'values' => array());
									$country_value = CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name");
									$Ar = array();
									foreach($country_value as $kl=>$vl){
									$Ar[] = array('id'=>$kl, 'name'=>$vl);
									}
									$input_data[] = array( 'field_type' => 'visible' ,  'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' => $Ar);
									$type_value = $model->getUserType();
									$Ar2 = array();
									foreach($type_value as $kl=>$vl){
									$Ar2[] = array('id'=>$kl, 'name'=>$vl);
									}
									$input_data[] = array(  'field_type' => 'visible' , 'field_name' => 'user_type' , 'label'=> $model->getAttributeLabel('user_type') , 'values' => $Ar2);
									echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data)); 
					       
						}
					 }
					 else{
						 echo $this->generateOutPut('FAILED','0','Email Cannot be blank',array());
					 }
		
		
	    Yii::app()->end();
    }
     public function actionSave_api(){
       
		  $request = Yii::app()->request;
		  if ($request->isPostRequest  ) {
					$loged_in_user = @$_POST['user_id'];
					$ad_id 		   = @$_POST['ad_id'];
					$fun 		   = @$_POST['fun'];
					 
					if(!in_array($fun,array('save_property','remove_save_property'))){
						echo $this->generateOutPut('FAILED','0','No Function Found',array());exit; 
					}
					$user_model =  ListingUsers::model()->findByPk($loged_in_user);
					$ad_model   =  PlaceAnAd::model()->findByPk($ad_id);
					if(empty($user_model)){
						 echo $this->generateOutPut('FAILED','0','No User Found',array());exit; 
					}
					if(empty($ad_model)){
						 echo $this->generateOutPut('FAILED','0','No AD Found',array());exit; 
					}
					$message = ''; 
					$class = ''; 
					if($fun =='save_property'){
							$found = AdSave::model()->findByAttributes(array('ad_id'=>$ad_id,'user_id'=>$loged_in_user));
							if(empty($found)){
								$model = new AdSave();
								$model->user_id =  $loged_in_user;
								$model->ad_id   =  $ad_id;
								if($model->save()){
									echo $this->generateOutPut('SUCCESS','1',array(),array('is_ad_save'=>'1'), 'Successfully added to saved property list' );
								}
								else{
									echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
								}
							}
							else{
								 echo $this->generateOutPut('SUCCESS','1',array(), array('is_ad_save'=>'1'), 'Successfully added to saved property list' );
							}
							exit; 
					 
					}
					if($fun =='remove_save_property'){
							$found = AdSave::model()->findByAttributes(array('ad_id'=>$ad_id,'user_id'=>$loged_in_user));
							if($found){
								$found->delete();
							}
							$message = 'Successfully removed     from saved property list';
							echo $this->generateOutPut('SUCCESS','1',array(),array('is_ad_save'=>'0') , $message );
								exit; 
					}
				}
				else{
				$input_data[] = array( 'field_name' => 'user_id' , 'label'=>'Logged in user'  , 'values' => array());
				$input_data[] = array( 'field_name' => 'ad_id' , 'label'=> 'Ad ID' , 'values' => array() );
				$input_data[] = array( 'field_name' => 'fun' , 'label'=> 'Function' , 'values' => array('save_property','remove_save_property') );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
					exit; 
		} 
	 }
}
