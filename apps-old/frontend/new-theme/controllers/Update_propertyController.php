<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class Update_propertyController extends Controller
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
    public function init()
    {
		 
		parent::Init();
		 
		
	 
	 
		$apps = $this->app->apps;
		 
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('assets/star/css/shared/style.css?q=1'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('assets/star/css/demo_1/style.css?q=1'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/materoial.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/new_icons.css'), 'priority' => -100));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/boot.min.js'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
		 		$this->getData('pageStyles')->add(array('src' =>  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'));
				 $this->getData('pageScripts')->add(array('src' =>  'https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'));
 
	
		$this->setData(array(
		'hooks'     =>   	  Yii::app()->hooks  , 
		));
    
    
        $this->layout = 'member_area2';
       
        
    }
  
     public function  beforeAction($action)
    {   
		 
				if(in_array($action->id,array('create','success','update','success_edit'))){
				$apps = $this->app->apps;
	 
				$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/styles/jqx.base.css')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/table_common.css')));
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
   
     	public function actionSuccess_posted($option=null,$slug=null)
	{
	    	   
	  $ad = PlaceAnAd::model()->findByAttributes(array('slug'=>$slug ));
	  if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        	 $this->member =  ListingUsers::model()->findByPk((int)$ad->user_id);
		$notify = Yii::app()->notify;
		
	 $this->secure_header = '1';$this->no_header = '1';
 $model = Yii::app()->user->getModel();
	 
	$this->setData(array(
                    'pageMetaTitle'         => Yii::t('app', '{name} | {p}', array('{name}' =>  'Successfully posted'   ,'{p}'=>$this->project_name)), 
                    'pageMetaDescription'   => Yii::app()->params['description'],
                ));		 
               $member = $this->member ; 
                $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/only_update.css?q=2')));
	$this->render("//place_property/success_no_login",compact("model",'view','ad','option','member'));
	}
    
     public function actionDetails($model,$subcategory,$category,$fields,$image_array)
    {
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
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
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
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
     
     public $functionality; 
     
     public function actionUpdate($id=null)
    {  
        
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if(!empty($id)){
            $String = explode('-',base64_decode($id));
            if(isset($String['1'])){
                $id = $String['1'];  
                $this->functionality = $String['0']; 
            }
            $model =   PlaceAnAd::model()->findByAttributes(array('uid'=>$id));
        }
         
        
          if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
            	 $this->member =  ListingUsers::model()->findByPk((int)$model->user_id);
        $model->scenario = 'new_insert'; 
        $model->country =  '66099';
        $image_array = array(); 
        if(isset($model->adImages) )
            {
				
				
				foreach($model->adImages as $k=>$v)
				{
					$image_array[] = $v->image_name;
				}
		    }
	;
		
        $country = Countries::model()->ListDataForJSON();
      
        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
         
	   
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Update your property ' ,'{p}'=> Yii::app()->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
        	$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
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
        	 	 
        	 	 
         $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/only_update.css?q=2')));
		 $this->render('//place_property/form_new', compact('model',"country","section",'list_type','image_array','option'));
		 
        
 
        
    }
     
    /**
     * Delete existing user
     */
    
	public $image_size;
	public $image_name;
   
    
	 public function insertAfterSaveFn($model){
						$room_image = new AdImage;
						$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						$imgArr =  explode(',',$model->image);
						 
						if($imgArr)
						{
							 
							 
							$img_saved =false;
							foreach($imgArr as $k)
							{
								 
									if(!$img_saved and $model->image!="")
									{
										 
									 $model->updateByPk($model->id,array('image'=>$k));  	
									 
									}
									$room_image->isNewRecord = true;
									$room_image->id = "";
									$room_image->ad_id = $model->id;
									$room_image->status =  Yii::app()->options->get('system.common.frontend_default_ad_image_status','I');
									$room_image->image_name =  $k;
									$room_image->save();
									 
								 
								
							}
						 
							
						 }
						  $am = new  AdAmenities();
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						  if($ameni = Yii::app()->request->getPost("amenities"))
						  {
							 
							 foreach($ameni as $k)
							 {
								 
									$am->isNewRecord = true;
									$am->ad_id = $model->id;
									$am->amenities_id =  $k;
									$am->save();
							 }
							 
						  }
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
}