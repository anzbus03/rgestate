<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class Place_an_adController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public $Controlloler_title= "Ad";
    public $focus = "country";
    public $member;
    public $show_overlay;
    public $can_upload_property;
    public $tag;
     public function init()
    {
		 
		parent::Init();
		  if(!Yii::app()->request->isAjaxRequest){ 
		 
		 $this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
	    if(empty($this->member)){
	        if (strpos(Yii::app()->request->url, 'post-my-property') !== false) {
				if(isset($_GET['type'])){ 
					$this->redirect(Yii::app()->createUrl('place_an_ad_no_login/create',array('type'=>$_GET['type'])));
				}else{
				$this->redirect(Yii::app()->createUrl('place_an_ad_no_login/create'));
				}
			}
	      
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
		 		$this->getData('pageStyles')->add(array('src' =>  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'));
				 $this->getData('pageScripts')->add(array('src' =>  'https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'));
	/*
	 if(!Yii::app()->request->isAjaxRequest){
	     if( !empty( $this->member->filled_info) and $this->member->status == 'W'  ){
					$notify = Yii::app()->notify;
					$notify->addInfo(Yii::t('app','Your account is currently pending approval by the {p} administrator. In the meantime,you can\'t upload your properties.thanks for your patience.',array('{p}'=>Yii::app()->options->get('system.common.site_name'))));
			}
    	if($this->member->filled_info == '0' and  $this->member->FillPersonalInformation   ){ 
		$hideeeeeeeee= true;
			// $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
			}
		 if( !in_array($this->member->status,array('W','A'))){
			 	$hideeeeeeeee= true;
		     // $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
		 }
	    
		if(in_array(Yii::app()->user->user_type,array('C','A'))){
			if(Yii::app()->user->user_type=='C'){
				$filled_info = $this->member;
				$scenario = 'agent_update1'; 
			}
			else{
		    	$filled_info = $this->member;
		    	$scenario = 'agent_update1'; 
			}
		}
		else if(Yii::app()->user->user_type=='D'){
			$filled_info = $this->member;
			$scenario = 'developer_update1'; 
			 
		} 
		$filled_info->scenario = $scenario; 
			$filled_info->mul_country_id ='1';$filled_info->languages_known ='1';
		$filled_info->validate();
		if(!empty($filled_info->getErrors())){
			$this->show_overlay = '1';
		 
			 $notify->addError(Yii::t('app','Your profile info still not complete.Without 100% profile completeness you cannot upload property <a href="'.Yii::app()->createUrl('member/profile_settings').'">Click here to update profile</a>'));
	
		}; 
		if( !empty( $this->member->filled_info) and $this->member->status == 'W'){
			 $this->show_overlay = '1';
		}
			if( !empty( $this->member->filled_info) and $this->member->status == 'W'  && $this->can_upload_property){
			    $this->show_overlay = '1';
				$notify->addError(Yii::t('app',$this->tag->getTag('need-verify-email',$this->options->get('system.messages.info_waiting_for_admin_approval')),array('{p}'=>$this->project_name)));
		  
		}
		}
		* */
	
		$this->setData(array(
		'hooks'     =>   	  Yii::app()->hooks  , 
		));
    
    
        $this->layout = 'member_area2';
       
		  }
    }
  public function actionIndex($status=null,$s=null)
     {
        
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new PlaceAnAd('serach');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$model->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
        $model->unsetAttributes();
       
        $model->attributes = (array)$request->getQuery($model->modelName, array());
         $model->user_id  = (int) Yii::app()->user->getId();
         $title = $this->tag->getTag('my_properties','My Properties').' '. '{status}';
         if(!empty($status) and in_array($status,array_keys($model->StatusArray()))){
			 $model->status = $status;
			$title = Yii::t('app' , $title , array('{status}'=>' : '.$model->StatusTitle)); 
		 }
		 else{ 	$title = Yii::t('app' , $title , array('{status}'=>''));  }
         $this->setData(array(
            'hooks'     =>    Yii::app()->hooks, 
            'pageMetaTitle'     =>  Yii::t('app',$title . '  |  {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.free_bites.site_name') )), 
            'pageBreadcrumbs'   => array(
                Yii::t('local_hire', 'Free Bites') => $this->createUrl('free_bites/index'),
                Yii::t('app', 'create')
            )
        ));
         $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/jquery.dynameter.css')));
        	 $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/jquery.dynameter.js')));
           
        $this->render('list', compact('model','title','s'));
    }
     public function  beforeAction($action)
    {   
		 
				if(in_array($action->id,array('create','success','update','success_edit'))){
				$apps = $this->app->apps;
	 
				$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/styles/jqx.base.css')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/table_common.css?q=1')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/styles/jqx.energyblue.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcore.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/custom.js?q=2')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxbuttons.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxscrollbar.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxlistbox.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcombobox.js')));
				$this->getData('pageScripts')->add(array('src' =>$apps->getBaseUrl('backend/assets/js/jqwidgets/jqxdropdownlist.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2script.js')));
				}
				return parent::beforeAction($action);
	}
	public $secure;
   public function actionPreview($storage=null)
    {  
			$request = Yii::app()->request;
		$model = new PlaceAnAd();
		  $image_array = array(); 
        $model->scenario = 'new_insert'; 
         
		   if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	   
 	   
 if (!$request->isPostRequest) { 
   
		if(!empty($storage)){
		     ///	 print_r($_POST) ; exit; 
		    $LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$storage)); 	}
		else if((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '' )){
		    	    
			$preview_id =  $request->cookies['preview1']->value; 
			$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
		}
		if(empty($LocalStorage)){
		      
			$this->redirect($this->app->createUrl('place_an_ad/create'));
		}
		$LocalStorage->user_id = Yii::app()->user->getId();
		$LocalStorage->save() ; 
    }
		  
 	 
		  if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) { 
		     //   echo $storage;exit; 
			 $model->attributes = $attributes;
			$this->getValidationSubscription();
		
           if (!$model->save()) {
				
				$model->amenities = Yii::app()->request->getPost("amenities");
				$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }		
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
                	$LocalStorage = LocalStorage::model()->deleteAllByAttributes(array('user_id'=>(int)Yii::app()->user->getId() ));
					
				if(!empty($storage)){
						$preview_id =  $storage; 
						if(!empty($preview_id)){
						$LocalStorage = LocalStorage::model()->deleteAllByAttributes(array('cookie_name'=>$preview_id));
						unset(Yii::app()->request->cookies[$preview_id]);
						}
		
				}
				$this->insertAfterSaveFn($model);
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::App()->createUrl($this->id.'/success_posted',array('slug'=>$model->slug)));
            }
           
        }
        
				 
						
						$post = unserialize($LocalStorage->file); 
						$model = new PlaceAnAd();
						$model->attributes = $post['PlaceAnAd'];
							$model->amenities = $post['amenities']; 
			  if(!empty($model->image)){
		 		$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }
		 	    }
		 	    
		 	    if(isset($post['floor_plan'])){
					$_POST['floor_plan'] = $post['floor_plan'];
					} 
		 	    if(isset($post['video_urls'])){
					$_POST['video_urls'] = $post['video_urls'];
					} 
		 	    
						  $this->no_header = '1'; $this->secure_header='1';
							$member = $this->member ; 
							  $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css?q=1')));
		
		
						$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));
 
				$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => $this->tag->getTag('preview','Preview') ,'{p}'=> $this->project_name)),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
						$this->render('//place_property/preview', compact('model',"country","section",'list_type','image_array','member','LocalStorage'));
		
				
        
	}
	public function getValidationSubscription(){
		 $notify = Yii::app()->notify;
		 if(!Yii::app()->request->isAjaxRequest){
			if(!empty($this->parent_user)){
			$result =	$this->parent_member->getvalidateUserListingPackage();
			}else{
			$result = $this->member->getvalidateUserListingPackage();
		}
		
		
		$error_submit = false;
	    if(empty($result)){
			$error_submit[] = true ; 
			 $notify->addWarning(Yii::t('app', $this->tag->getTag('no_active_listing_packages._pl','No active listing packages. Please subscribe/renew your package')));
			 $this->redirect(Yii::app()->createUrl('member/addons'));
		}
		if($this->member->user_type == 'P' and (empty($this->member->property_t) or empty($this->member->property_a)) ){
			$error_submit[] = true ; 
		}
		if(in_array($this->member->user_type,array('A','C','D','M')) and (empty($this->member->cr_number) or empty($this->member->u_crdoc)) ){
		    if(empty($this->member->parent_user)){
			$error_submit[] = true ; 
		    }
		}
		if(!empty($this->member->parent_user) ){
			if(empty($this->parent_member->is_verified)){
			$error_submit[] = true ;
			}
		}
		else if(empty($this->member->is_verified)){
			$error_submit[] = true ;
		}
		if(!empty($error_submit)){
			
					 $this->redirect(Yii::app()->createUrl('member/show_pendings'));
		}
		
		
		}
	}
    public function actionCreate($preview=null,$type=null)
    {  
      
        if(empty($preview)){
        $LocalStorage = LocalStorage::model()->findByAttributes(array('user_id'=>(int) Yii::app()->user->getId()));
						if(!empty($LocalStorage)){ 
							$this->redirect($this->app->createUrl('place_an_ad/preview',array('storage'=>$LocalStorage->cookie_name)));
						}
					}
       
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        $image_array = array(); 
        $model->scenario = 'new_insert'; 
         
         if($this->member->email_verified=='0'   ){
	           $notify->addError(Yii::t('app', 'Submit Property allowed only after   Emaill Adresss verification'));
	
	         $this->redirect(Yii::app()->createUrl('member/dashboard'));
			
	    }
	   
		
		if(!Yii::app()->request->isPostRequest and !empty($preview)){
		  
			$preview_id = $preview; // $request->cookies['preview1']->value; 
						$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
					 
						if(empty($LocalStorage)){
							$this->redirect($this->app->createUrl('place_an_ad/create'));
						}
						$post = unserialize($LocalStorage->file); 
						$model = new PlaceAnAd();
						$model->attributes = $post['PlaceAnAd'];
							$model->amenities = $post['amenities']; 
			  if(!empty($model->image)){
				 
		 		$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }
		 	    }
		 	    
		 	    if(isset($post['floor_plan'])){
					$_POST['floor_plan'] = $post['floor_plan'];
					} 
		 	    if(isset($post['video_urls'])){
					$_POST['video_urls'] = $post['video_urls'];
					} 
		}
       else  if((isset(Yii::app()->request->cookies['USER_DRAFT'])   )){
			$v_cokie =  Yii::app()->request->cookies['USER_DRAFT']->value;
	        
		 	if(!empty(	$v_cokie)) { $model->attributes = $v_cokie; }
		 	    if(!empty($model->image)){
		 		$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }
		 	    }
		 	    if(isset($v_cokie['amn']) and !empty($v_cokie['amn'])){
		 	        $model->amenities =  explode("-",$v_cokie['amn']);
		 	    }
			
		}  
		if(!empty($type)){
			switch($type){
				case 'rent':
				if($model->section_id != '2'){
					$model = new PlaceAnAd();
					$image_array = array();
					$model->scenario = 'new_insert'; 
				}
				$model->section_id ='2'; 
				break;
				case 'sell':
				if($model->section_id != '1'){
					$model = new PlaceAnAd();
					$image_array = array();
					$model->scenario = 'new_insert'; 
				}
				$model->section_id ='1'; 
				break;
			}
		}
        $model->country = COUNTRY_ID;
        
        
        $country = Countries::model()->ListDataForJSON();
      
        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
         
	     
	    $this->setData(array(
			'pageMetaTitle'     =>  'Sell Your Business in UAE with RGEstate',   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css?q=1')));
		
		
						$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));
 
				$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
      //  print_r($_POST);exit;
       if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) { 
			 $model->attributes = $attributes;
			 
           if (!$model->validate()) {
				  
				$model->amenities = Yii::app()->request->getPost("amenities");
				$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }		
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				
				if((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '' )){
						$preview_id =  $request->cookies['preview1']->value; 
						$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
				}else{
						$preview_id = date('Ymdhis'.rand(1000,1000000));
						$cookie = new CHttpCookie('preview1', $preview_id );
						$cookie->expire = time()+60*60*24*180; 
						Yii::app()->request->cookies['preview1'] = $cookie;
				}
				if(empty($LocalStorage)){
					$LocalStorage = new LocalStorage();
				}
				$LocalStorage->cookie_name = $preview_id; 
				
				 
				$LocalStorage->file = serialize($_POST); 
				if(!$LocalStorage->save()){
					 
				}
				$this->redirect(Yii::app()->createUrl($this->id.'/preview')); 
			   // $this->redirect(Yii::app()->createUrl($this->id.'/preview'));
				$this->insertAfterSaveFn($model);
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::App()->createUrl($this->id.'/success_posted',array('slug'=>$model->slug)));
            }
           
        }
        $this->no_header = '1'; $this->secure_header='1';
         $member = $this->member ; 
		 $this->render('//place_property/form_new', compact('model',"country","section",'list_type','image_array','member'));
		 
        
 
        
    }
     	
	/*
    public function actionCreate($preview=null)
    {   
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        $image_array = array(); 
        $model->scenario = 'new_insert'; 
         
         if($this->member->email_verified=='0'   ){
	           $notify->addError(Yii::t('app', 'Submit Property allowed only after   Emaill Adresss verification'));
	
	         $this->redirect(Yii::app()->createUrl('member/dashboard'));
			
	    }
	    if(!Yii::app()->request->isAjaxRequest){
			if(!empty($this->parent_user)){
			$result =	$this->parent_member->getvalidateUserListingPackage();
			}else{
			$result = $this->member->getvalidateUserListingPackage();
		}
		
		
		$error_submit = false;
	    if(empty($result)){
			$error_submit[] = true ; 
			 $notify->addWarning(Yii::t('app', 'No active listing packages. Please subscribe suitable package'));
			 $this->redirect(Yii::app()->createUrl('member/addons'));
		}
		if($this->member->user_type == 'P' and (empty($this->member->property_t) or empty($this->member->property_a)) ){
			$error_submit[] = true ; 
		}
		if(in_array($this->member->user_type,array('A','C','D','M')) and (empty($this->member->cr_number) or empty($this->member->u_crdoc)) ){
			$error_submit[] = true ; 
		}
		if(!empty($this->member->parent_user) ){
			if(empty($this->parent_member->is_verified)){
			$error_submit[] = true ;
			}
		}
		else if(empty($this->member->is_verified)){
			$error_submit[] = true ;
		}
		if(!empty($error_submit)){
			
					 $this->redirect(Yii::app()->createUrl('member/show_pendings'));
		}
		
		
		}
		
		if(!Yii::app()->request->isPostRequest and !empty($preview)){
			$preview_id =  $request->cookies['preview1']->value; 
						$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
						if(empty($LocalStorage)){
							$this->redirect($this->app->createUrl('place_an_ad/create'));
						}
						$post = unserialize($LocalStorage->file); 
						$model = new PlaceAnAd();
						$model->attributes = $post['PlaceAnAd'];
							$model->amenities = $post['amenities']; 
			  if(!empty($model->image)){
		 		$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }
		 	    }
		 	    
		 	    if(isset($post['floor_plan'])){
					$_POST['floor_plan'] = $post['floor_plan'];
					} 
		 	    if(isset($post['video_urls'])){
					$_POST['video_urls'] = $post['video_urls'];
					} 
		}
        if((isset(Yii::app()->request->cookies['USER_DRAFT'])   )){
			$v_cokie =  Yii::app()->request->cookies['USER_DRAFT']->value;
	        
		 	if(!empty(	$v_cokie)) { $model->attributes = $v_cokie; }
		 	    if(!empty($model->image)){
		 		$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }
		 	    }
		 	    if(isset($v_cokie['amn']) and !empty($v_cokie['amn'])){
		 	        $model->amenities =  explode("-",$v_cokie['amn']);
		 	    }
			
		}  
	 
        $model->country = COUNTRY_ID;
        
        
        $country = Countries::model()->ListDataForJSON();
      
        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
         
	     
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => $this->tag->getTag('submit_your_property','Submit your property') ,'{p}'=> $this->project_name)),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));
		
		
						$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));
 
				$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
      //  print_r($_POST);exit;
       if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) { 
			 $model->attributes = $attributes;
			 
           if (!$model->validate()) {
				  
				$model->amenities = Yii::app()->request->getPost("amenities");
				$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }		
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				
				if((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '' )){
						$preview_id =  $request->cookies['preview1']->value; 
						$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
				}else{
						$preview_id = date('Ymdhis'.rand(1000,1000000));
						$cookie = new CHttpCookie('preview1', $preview_id );
						$cookie->expire = time()+60*60*24*180; 
						Yii::app()->request->cookies['preview1'] = $cookie;
				}
				if(empty($LocalStorage)){
					$LocalStorage = new LocalStorage();
				}
				$LocalStorage->cookie_name = $preview_id; 
				
				 
				$LocalStorage->file = serialize($_POST); 
				if(!$LocalStorage->save()){
					 
				}
				$this->redirect(Yii::app()->createUrl($this->id.'/preview')); 
			   // $this->redirect(Yii::app()->createUrl($this->id.'/preview'));
				$this->insertAfterSaveFn($model);
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::App()->createUrl($this->id.'/success_posted',array('slug'=>$model->slug)));
            }
           
        }
        $this->no_header = '1'; $this->secure_header='1';
         $member = $this->member ; 
		 $this->render('//place_property/form_new', compact('model',"country","section",'list_type','image_array','member'));
		 
        
 
        
    }
    */
     	public function actionSuccess_posted($option=null,$slug=null)
	{
	    	   
	  $criteria=new CDbCriteria;$criteria->condition  = '1';
			$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->condition .=  ' and t.slug = :slug and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
			$criteria->params[':slug']  =  $slug;
			$criteria->params[':owner']  = (int) Yii::App()->user->getId();
			$ad =   PlaceAnAd::model()->find($criteria);
	  if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
		$notify = Yii::app()->notify;
		
	 $this->secure_header = '1';$this->no_header = '1';
 $model = Yii::app()->user->getModel();
	 
	$this->setData(array(
                    'pageMetaTitle'         => Yii::t('app', '{name} | {p}', array('{name}' =>  $this->tag->getTag('successfully_submitted','Successfully submitted' )  ,'{p}'=>$this->project_name)), 
                    'pageMetaDescription'   => Yii::app()->params['description'],
                ));		 
               $member = $this->member ; 
	$this->render("//place_property/success",compact("model",'view','ad','option','member'));
	}
    
     public function actionDetails($model,$subcategory,$category,$fields,$image_array)
    {
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details', compact('model','subcategory','category',"fields","image_array",'hooks'));
    }
     public function actionDetails_2($model,$subcategory,$category,$fields,$image_array,$jsonData)
    {
		 
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('myAjax.js')));
        $this->render('location_view', compact('model','subcategory','category',"fields","image_array","jsonData"));exit;
    }
     public function actionDetails_edit($model,$subcategory,$category,$fields,$image_array)
    {
		$apps = $this->app->apps; 
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details_edit', compact('model','subcategory',"category","fields","image_array"));
    }
     public function actionFindOnMap()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
      //  $subcategory= SubCategory::model()->FindSubategory("12");
         
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->render('details', compact('model'));
    }
    
    
    /**
     * Update existing user
     */
     public function actionUpdate($id=null,$slug=null)
    {  
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if(!empty($slug)){
		$criteria=new CDbCriteria;$criteria->condition  = '1';
			$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->condition .=  ' and t.slug = :slug and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
			$criteria->params[':slug']  =  $slug;
			$criteria->params[':owner']  = (int) Yii::App()->user->getId();
			$model =   PlaceAnAd::model()->find($criteria);
        }
        else  if(!empty($id)){
			$criteria=new CDbCriteria;
			$criteria->condition =  '1';
			$criteria->join  .=   ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->condition .=  ' and t.id = :id and CASE WHEN  usr.parent_user is not null THEN  usr.parent_user =:owner or t.user_id =:owner else  t.user_id =:owner END  ';
			$criteria->params[':id']  = (int) $id;
			$criteria->params[':owner']  = (int) Yii::App()->user->getId();
			$model =   PlaceAnAd::model()->find($criteria);
        }
          if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
            
        $model->scenario = 'new_insert'; 
        $model->country = COUNTRY_ID;
        $image_array = array(); 
        if(isset($model->adImages) )
            {
				
				
				foreach($model->adImages as $k=>$v)
				{
					$image_array[] = $v->image_name;
				}
		    }
	;
	  	 $model->amenities =  CHtml::listData($model->adAmenities,'amenities_id','inp_val2');     
    // print_r($model->amenities);exit; 
        $country = Countries::model()->ListDataForJSON();
      
        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
         
	   
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' =>$this->tag->getTag('', 'Update your property') ,'{p}'=> $this->project_name)),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css?q=1')));
		
		
						$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));
 
				$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
      //  print_r($_POST);exit;
       if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) { 
			 $model->attributes = $attributes;
			 
           if (!$model->save()) {
				  
				$model->amenities = Yii::app()->request->getPost("amenities");
				$exp =  explode(",",$model->image);
				if($exp){ foreach($exp as $k=>$v) { 	if($v!="") 	{ 	$image_array[] = $v; 		} 		} }		
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				$this->insertAfterSaveFn($model);
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::App()->createUrl($this->id.'/success_posted',array('slug'=>$model->slug,'option'=>'update')));
            }
           
        }
        	 	 $this->secure_header = '1'; $this->no_header = '1';
        	 	 $model->price = number_format($model->price,0,'.','');
		 $this->render('//place_property/form_new', compact('model',"country","section",'list_type','image_array','option'));
		 
        
 
        
    }
     
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('isTrash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionFeatured($id,$featured)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
            $featured = ($featured=="N") ? "Y" : "N";
            $model->updateByPk($id,array('featured'=>$featured ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionStatus($id,$status)
    {
		 
		 
        $model = PlaceAnAd::model()->findByAttributes(array('id' => (int)$id , 'user_id'=>Yii::app()->user->getId()));
        $status=(string)$status;
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
          
           if($model->status == 'A'){
		    	$status =  'I'; 
           }
           else if($model->status == 'I'){
                $status =  'A';
           }
           else{
            $model->status = $model->status;
           }
		   
      
    
            $model->updateByPk($id,array('status'=>$status ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionSelect_state()
    {
	  echo   States::model()->ListDataForJSON(Yii::app()->request->getPost("country")) ;exit;
	}
    public function actionSelect_city()
    {
	  echo   City::model()->ListDataForJSON(Yii::app()->request->getPost("state")) ;exit;
	}
    public function actionSelect_category()
    {
	  echo   Category::model()->ListDataForJSON_ID_BySEction(Yii::app()->request->getPost("section")) ;exit;
	}
    public function actionSelect_sub_category()
    {
	  echo   Subcategory::model()->ListDataForJSON_ID(Yii::app()->request->getPost("category")) ;exit;
	}
	public function actionSelect_model($id)
    {
	    $subcategory =  Subcategory::model()->findByPk($id);
		
		$fields=array();
		$fields=  ($subcategory->change_parent_fields=="N") ? CHtml::listData($subcategory->category->relatedFields,'field_name','field_name'):CHtml::listData($subcategory->relatedFields,'field_name','field_name');
 
			if(in_array('model',$fields))
			{
				echo   VehicleModel::model()->ListDataForJSON_ID_ByModel($id) ;exit;
			}
			else
			{
				echo 0;
			}
		 
	 
	  
	}
	public $image_size;
	public $image_name;
   
      public function actionUpload($width=null,$height=null)
    {
		
		
	 // sleep(15);
	 
	  ini_set('memory_limit', '-1');    $this->fileUploadDropzone();exit;  
    	 if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER=='1'){
			$file = $_FILES['file']['name'];
			$file_orginal = $_FILES['file']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$File = pathinfo($file, PATHINFO_FILENAME);
			//$img = $File.'_'.uniqid(rand(0, time())).".".$ext;
		 
				$img = rand(0,9999).'_'.time().".".$ext;
			 
			$awsAccessKey = ENABLED_AWS_ACCESS;
			$awsSecretKey = ENABLED_AWS_SECRET;
			 
			$bucketName = ENABLED_BUCKET_NAME;
			 
			Yii::import('common.extensions.amazon.S3');
			$s3 = new S3($awsAccessKey, $awsSecretKey);
			$uploadName = $_FILES['file']['name'];
			
		
			
				$fileSize = (int)$_FILES['file']['size']/1000000 ; 
							if($fileSize > 5) { $fileSize = 5; }
							switch($fileSize){
								case '5':
								$quality  = 15; 
								$quality_p  =4; 
								break;
								case '4':
								$quality  = 50; 
								$quality_p  = 4; 
								break;
								case '3':
								$quality  = 60; 
								$quality_p  = 8; 
								break;
								case '2':
								$quality  = 70; 
								$quality_p  = 8; 
								break;
								case '1':
								$quality  = 80; 
								$quality_p  = 8; 
								break;
								default:
								$quality  = 80; 
								$quality_p  = 7;
								break;
							}
							$tempPath = Yii::getPathOfAlias('root.uploads.images');
							$filename = $tempPath.'/'.$img ; 
							$detSize = getimagesize($_FILES['file']['tmp_name']);
							 	$this->image_size = $detSize ; 
							$this->image_name = $img ; 
							$width   = $detSize['0'];
							$newHeight   = $detSize['1'];
							$resized = 0; 
						 /*
							switch($detSize['mime'])
							{
								case 'image/png': 
								$resized = 1;
								$this->resize_crop_image($width,$newHeight,$url=$_FILES['file']['tmp_name'],$filename,$quality_p);
								break;
								case 'image/jpeg':
							 
								$resized = 1;
							 	$this->resize_crop_image($width,$newHeight,$url=$_FILES['file']['tmp_name'],$filename,$quality);
								break;
							}
							*/
			
			if($resized == '1') { 
				$fileURL = Yii::App()->apps->getBaseUrl('uploads/images/'.$img,true);
				$fileContents = file_get_contents($fileURL);
			
				$ar = $s3->putObject($fileContents, $bucketName, $img, S3::ACL_PUBLIC_READ);
			//		@unlink(Yii::app()->basePath . '/../../uploads/images/'. $img);
			}
			else{
				$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
			}
			if(isset($_POST['rand'])){
				echo json_encode(array('img'=>$img,'rand'=>$_POST['rand']));exit;
			}
			echo $img;
		}
		else{
	   $path =  Yii::getPathOfAlias('root.uploads.images');    
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
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
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
		echo $str; 
		 
    
   }
   public function actionSuccess($id)
   {
	    $model = PlaceAnAd::model()->findByPk($id);
	    if(empty($model))
	    {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	     $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> $this->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Create new'),
			)
        ));
        $this->render('success', compact('model'));
   } 
   public function actionSuccess_edit($id)
   {
	    $model = PlaceAnAd::model()->findByPk($id);
	    if(empty($model))
	    {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		 
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> $this->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Update Listing"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Create new'),
			)
        ));
        $this->render('success-edit', compact('model'));
   } 
   
   public function actionView($id)
    {
		$model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
     //   $request = Yii::app()->request;
        
        
        // for filters.
        //$user->attributes = (array)$request->getQuery($user->modelName, array());
      
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('hotel_booking', 'Place An Ad'), 
            'pageHeading'       => Yii::t('hotel_booking', 'Place An Ad'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'Hotel') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'Booking Details')
            )
        ));
      
        $this->render('view', compact('model'));
    }
     public function actionLoadCities()
	{
	   $id=null;
	   if(isset($_POST['state'])){ $id =$_POST['state'];  }
	   $data=City::model()->FindCities($id);
	   $data=CHtml::listData($data,'city_id','city_name');
	   echo "<option value=''>All Cities</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
	 public function actionImage_management($id)
	{
		 
		$ad = PlaceAnAd::model()->findByPk((int)$id);
        if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user =  new AdImage;
         
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				$up = $user->HighestPriorityImage($id);
				if($up)
				{
					$ad->updateByPk($id,array('image'=>$up->image_name)); 
				}
				 
				$notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
             
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
           /* if ($collection->success) {
                $this->redirect(array('room_manage/index'));
            }
            * */
        }
        
      
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('room_manage', 'Image Management'),
            'pageHeading'       => Yii::t('room_manage', 'Image Management'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'Ad') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('image_manage', compact('ad','id','user'));
	}
	public function actionDelete_image_db($id)
	{
	 
        $ad = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $ad->find(array("condition"=>"t.id=:id","params"=>array(":id"=>$id)));
        if($rm)
        {
			
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					$up = $ad->HighestPriorityImage($rm->ad_id);
					if($up)
					{
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					$ad->deleteByPk($id);
			    }
		}
          
       
	}
   public function actionApprove($id)
    {
       
        $user = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
         
       
			 
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					 
					$rm->status = ($rm->status==="A") ? "I" : "A" ;
					$rm->save() ;  
					 
					$up = $user->HighestPriorityImage($rm->ad_id);
					if($up)
					{ 
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						 
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					
			    }
		 
		 
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect(Yii::app()->createUrl("place_an_ad/image_management",array("id"=>$rm->ad_id)));
        }
    }
   public function actionDisapprove($id)
   {
	  $user =  new AdImage;
	   $request = Yii::app()->request;
        $notify = Yii::app()->notify;
	  if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['id'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('status'=>"I")); 
					}
				}
				 
				 
				 
				$notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
    }
    $this->redirect($request->urlReferrer);
 
}
   public function actionApprove_selected($id)
   {
		$user =  new AdImage;
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
	  if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['id'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('status'=>"A")); 
					}
				}
				 
				 
				 
				$notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
    }
    $this->redirect($request->urlReferrer);
 
  }
    public function actionApprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        $user =  new AdImage;
        $user->updateAll(array('status'=>'A'),array("condition"=>"ad_id=:id","params"=>array(":id"=>$id)));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
        $this->redirect($request->urlReferrer);
    }
    public function actionDispprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        $user =  new AdImage;
        $user->updateAll(array('status'=>'I'),array("condition"=>"ad_id=:id","params"=>array(":id"=>$id)));
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
         $this->redirect($request->urlReferrer);
    }
    public function actionAd_image()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model =  new PlaceAnAd();
         $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
         
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Image Management"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('ad_image', compact('model'));
    }
    public function actionImage_approve_manage()
    {
		$id=$_POST["id"];
		$user = new AdImage();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {
 					      throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
         
       
			     $manager = new PlaceAnAd();
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					 
					$rm->status = ($rm->status==="A") ? "I" : "A" ;
					$rm->save() ;  
					 
					$up = $user->HighestPriorityImage($rm->ad_id);
					if($up)
					{ 
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						 
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					
			    }
		 
		 
	}
		function Get_LatLng_From_Google_Maps($address) {

		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

		// Make the HTTP request
		$data = @file_get_contents($url);
		// Parse the json response
		$jsondata = json_decode($data,true);

		// If the json data is invalid, return empty array
		if (!$this->check_status($jsondata))   return array();

		$LatLng = array(
			'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
			'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
		);

		return $LatLng;
	}

	function check_status($jsondata) {
		if ($jsondata["status"] == "OK") return true;
		return false;
	}
	public function actionCheckModel($id=null)
	{
		$category =  Category::model()->findByPk($id);
		if($category)
		{
			if(in_array('model',CHtml::listData($category->relatedFields,'field_name','field_name')))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
		 exit;
	}
   public function actionCommunity(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria= Community::model()->search(1);
		//$criteria->with = array('district'=>array('with'=>array('city'=>array('with'=>'state'))));
		
		//$criteria->together = true; 
		$region_id = $request->getQuery('state_id');
		$country_id = $request->getQuery('country_id');
		$condition = '';
		if($region_id){
		$criteria->params = array(':state'=>$request->getQuery('state_id')); 
				$condition    .= ' and t.region_id=:state ';
				$criteria->params[':state'] =  $region_id;
		}
		else if(!empty($country_id)){
			$criteria->join  .= ' LEFT JOIN {{countries}} c_st on c_st.country_id = st.country_id  ';
			$condition .= ' and t.country_id=:con or c_st.country_id = :con ';
				$criteria->params[':con'] =  $country_id;
		}
		if($condition){
			if($criteria->condition){
				$criteria->condition .= $condition;
			}
			else{
				$criteria->condition .= '1 and '.$condition;
			
			}
		}
		
		$criteria->compare('community_name',$request->getQuery('q'),true);
		$count = Community::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = Community::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->community_id,'text'=>$v->community_name.'('.$v->location.')');
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
    public function actionDistrict(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->with = array('city'=>array('with'=>array('state')));
		$criteria->condition = 'state.state_id=:state';
		$criteria->together = true; 
		$criteria->params = array(':state'=>$request->getQuery('state_id')); 
		$criteria->compare('district_name',$request->getQuery('q'),true);
		$count = District::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = District::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->district_id,'text'=>$v->district_name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
    public function actionCustomer(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'), $request->getQuery('q') , true);
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		$count = ListingUsers::model()->count($criteria);
		$criteria->order = 't.first_name'; 
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		
		$Result = ListingUsers::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->user_id,'text'=>$v->fullNAme);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
    public function actionSubCoummunity(){
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->condition =   't.community_id=:community_id';
		$criteria->params = array(':community_id'=>$request->getQuery('id')); 
		$criteria->compare('sub_community_name',$request->getQuery('q'),true);
		$count = SubCommunity::model()->count($criteria);
		$Result = SubCommunity::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->sub_community_id,'text'=>$v->sub_community_name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
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
				$quality = $quality;
				break;

			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = $quality;
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
  
     public function actionUpload_floor_plan($width=null,$height=null)
    {
	 
	  
	    $path =  Yii::getPathOfAlias('root.uploads.floor_plan');    
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
					$img = $new_name.'_'.time().".".$ext;
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/{$img}");
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
	}
   function actionDelete_floor_plan()
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
		echo $str; 
		 
    
   }
   
    public function actionSelect_city_new($id=null)
    {
		 $html = '<option value="">Select City</option>';
		 $states = States::model()->AllListingStatesOfCountry((int) $id);
		 
		 
		 if(!empty($states)){
			 foreach($states as $k ){
				 $html .= '<option value="'.$k->state_id.'">'.$k->state_name.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($states))) ; 
	}
	 public function actionSelect_location($id=null)
    {
		 $html = '<option value="">Select Location</option>';
		 $states = City::model()->FindCities((int) $id);
		 
		 
		 if(!empty($states)){
			 foreach($states as $k ){
				 $html .= '<option value="'.$k->city_id.'">'.$k->city_name.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($states))) ;
	}
	 public function actionSelect_category2($id=null)
    {
	  $category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id) ;
	  $html = '<option value="">Select Category</option>';
		  
		 
		 if(!empty($category)){
			 foreach($category as $k =>$v){
				 $html .= '<option value="'.$k.'">'.$v.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($category))) ;
	  
	  exit;
	}
	public function actionSelect_category3($id=null)
    {
	  $category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id) ;
	 
		 $html =  CHtml::radioButtonList('listing_type','' ,$category,array( 'onchange'=>'load_via_ajax_main_category(this)','data-url'=>Yii::App()->createUrl($this->id.'/select_category4'),'separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup">{input}   {label} <span class="img"></span> <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg></div>'));
		echo json_encode(array('data'=>$html,'size'=>sizeOf($category))) ;
	  
	  exit;
	}
	 public function actionSelect_category4($id=null)
    {
	  $category =    Category::model()->ListDataForJSON_ID_ByListingType($id) ;
	 
		 $html =  CHtml::radioButtonList('category_id','' ,$category,array( 'onchange'=>'validateInputSector()','separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup">{input}   {label} <span class="img"></span><svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg></div>'));
		echo json_encode(array('data'=>$html,'size'=>sizeOf($category))) ;
	  
	  exit;
	}
	  public function actionSelect_sub_category2($id=null)
    {
	  $category =    Subcategory::model()->ListDataForJSON_IDNew($id) ;
	   $html = '<option value="">Select Category</option>';
		  
		 
		 if(!empty($category)){
			 foreach($category as $k =>$v){
				 $html .= '<option value="'.$k.'">'.$v.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($category))) ;
	  
	  exit;
	  exit;
	}
	 public function insertAfterSaveFn($model){
						$room_image = new AdImage;
						//$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						 if(!$model->isNewRecord){
							$room_image->updateAll(array('isTrash'=>'1'), "ad_id=:ad_id", array(":ad_id"=>(int)$model->id));
						 }
						$imgArr =  explode(',',$model->image);
						 
						if($imgArr)
						{
							 
							 
							$img_saved =false;$img_saved =false;$status1 = Yii::app()->options->get('system.common.frontend_default_ad_image_status','I');
							foreach($imgArr as $k)
							{
									$status = $status1;
									$found =  AdImage::model()->findByAttributes(array('ad_id'=>$model->id,'image_name'=>$k,'status'=>'A'));
									if($found){ $status = 'A'; } 
									$room_image->isNewRecord = true;
									$room_image->id = "";
									$room_image->ad_id = $model->id;
									$room_image->status =  $status;
									$room_image->image_name =  $k;
									$room_image->save();
								 
								 
								
							}
							if(!$model->isNewRecord){
							AdImage::model()->deleteAll(array("condition"=>"ad_id=:ad_id and isTrash='1'","params"=>array(":ad_id"=>(int)$model->id)));
							}
						 
							
						 }
						  $am = new  AdAmenities();
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						  if($ameni = Yii::app()->request->getPost("amenities"))
						  {
							 
							 foreach($ameni as  $k=>$v)
							 {
								    if(isset($v['inp_val']) and  empty($v['inp_val'])){
										continue;
									}
									$am->isNewRecord = true;
									$am->ad_id = $model->id;
									$am->amenities_id =  $k;
									if(isset($v['inp_val']) and  !empty($v['inp_val'])){
										$am->inp_val =  $v['inp_val'];
									}else{
										$am->inp_val = NULL;
									}
									$am->save();
							 }
							 
						  }
	}
   public function actionGetCityId($city=null)
    {
		$criteria=new CDbCriteria;
		 $criteria->select="state_id,state_name";
		 $criteria->condition="lower(state_name)=:state";
		 $criteria->params[':state'] = strtolower($city);
		 $states = States::model()->find($criteria);
		 
		 
		 if(!empty($states)){
			 echo json_encode(array('status'=>1,'state_id'=>$states->state_id)) ; 
		 }
		else{
				 echo json_encode(array('status'=>0)) ; 
		}
		exit;
	}
	 public function actionCity_details($id=null)
    {
        $location = ''; 
		$criteria=new CDbCriteria;
		 $criteria->select="city_name,st.state_name";
		  $criteria->join ='INNER JOIN {{states}} st on st.state_id = t.state_id';
		 $criteria->condition="t.city_id=:city_id";
		 $criteria->params[':city_id'] =  (int) $id;
		 $states = City::model()->find($criteria);
		 
		 
		 if(!empty($states)){
			 echo json_encode(array('status'=>1,'city'=>rtrim($states->city_name) , 'city_name'=>rtrim($states->city_name).' , '.rtrim($states->state_name))) ; 
		 }
		else{
				  echo json_encode(array('status'=>1,'city_name'=>'')) ; 
		}
		exit;
	}
	
	public function actionSavecookies(){
	 
	 $data = array_filter($_POST['PlaceAnAd']) ; 
	
	 if(isset($data['contact_person'])){ unset($data['contact_person']); } 
	 if(isset($data['mobile_number'])){ unset($data['mobile_number']);} 
	if(isset($data['user_id'])){  unset($data['user_id']);} 
	if(isset($_POST['amn'])){    $data['amn']  = $_POST['amn'];} 
	$cookieName = 'USER_DRAFT';
	if(!empty($data)){
	         
			$cookie = new CHttpCookie($cookieName, $data);
			$cookie->expire = time()+60*60*24*180; 
			Yii::app()->request->cookies[$cookieName] = $cookie;
	    
	}else{
	    unset(Yii::app()->request->cookies[$cookieName]);
	}
	 
	}
	public function actionHidden_ammenities($id=null)
    {
        $location = ''; 
		$criteria=new CDbCriteria;
		 $criteria->select="amenities_id";
		 $criteria->condition="t.category_id=:category_id";
		 $criteria->params[':category_id'] =  (int) $id;
		 $states = AmenitiesCategoryList::model()->findAll($criteria);
		 
		 
		 if(!empty($states)){
			 $amenities_list = CHtml::listData($states,'amenities_id','amenities_id');
			 echo json_encode(array('status'=>1,'amenities_list'=> $amenities_list)) ; 
		 }
		else{
				  echo json_encode(array('status'=>0)) ; 
		}
		exit;
	}
	public function actionFindCities($zone_id=null){
		 
		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;
 
  
$status = true;
  
 /*areas Fetching */ 
$criteria=new CDbCriteria;
$criteria->condition  = '1'; 
$criteria->select = 't.city_id,t.state_id,cn.country_id,t.city_name,cn.cords as country_name,st.state_name';
$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ' ;
$criteria->join .= ' INNER JOIN {{countries}}  cn on cn.country_id = st.country_id   ' ;
$criteria->condition .= ' and   cn.show_on_listing ="1"'; 
$criteria->condition  .= ' and ( t.city_name like :query   )'  ;

$criteria->limit = '15'  ; 
$criteria->params[':query'] = '%'.$query.'%' ; 
 
$areas = City::model()->findAll($criteria);
/*areas Fetching */ 		
 
 
$resultUsers = [];
if($areas){
foreach ($areas as $k => $v) {
    
		$resultUsers[] =  array(
		"id"        => $v->city_id,
		"state_id"        => $v->state_id,
		"country_id"        => $v->country_id,
		"username"  => trim($v->city_name),
		"avatar"    => "" ,
		"country" =>  '('. $v->state_name.','.$v->country_name.')',
		);
     
}
}
 
  
 
$resultProjects = []; 
 
// Means no result were found
if (empty($resultUsers) && empty($resultProjects)) {
    $status = false;
}
 
header('Content-type: application/json; charset=utf-8');
 
echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "user"      => $resultUsers,
        
    )
));
	}
}
