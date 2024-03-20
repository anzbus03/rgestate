<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class PlaceAdController extends Controller
{
     public function  Init()
     {  	 
			parent::Init();
	 }
	 public function  generateOutPut($status='',$code='1',$error_message=array(),$data=array()){
		 return json_encode(array("status"=>$status,"statusCode"=>$code,"errorMessage"=>$error_message,"data"=>$data))  ;		
	 }
	 public function html_encode($input){
		 return htmlspecialchars($input);
	 }
	 
	 public function actionGetListingState($country_id=null){
	 
	     $state_list =    States::model()->AllListingStatesOfCountry($country_id) ; 
	     if(empty($state_list)){
		    	 echo $this->generateOutPut('FAILED','0',array(),array());
		 }
		 else{
				$ar = array() ; 
				foreach($state_list as $k=>$v)
				{
						$ar[]= array("id"=>$v->state_id , "name" => $v->state_name );
				}
				echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		 }
		exit; 
	 }
	 public function actionGetCategoryListFromType($listing_type=null){
	 
	     $state_list =    Category::model()->ListDataForJSON_ID_BySEction2($listing_type) ; 
	     if(empty($state_list)){
		    	 echo $this->generateOutPut('FAILED','0',array(),array());
		 }
		 else{
				$ar = array() ; 
				foreach($state_list as $k=>$v)
				{
					 
						$ar[]= array("id"=>$k, "name" => $v  );
				}
				echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		 }
		exit; 
	 }
	 public function actionGetSubCategoryListFromCategory($category_id=null){
	 
	     $state_list =    Subcategory::model()->ListDataForJSON_ID2($category_id) ; 
	     if(empty($state_list)){
		    	 echo $this->generateOutPut('FAILED','0',array(),array());
		 }
		 else{
				$ar = array() ; 
				foreach($state_list as $k=>$v)
				{
						$ar[]= array("id"=>$k, "name" => $v  );
				}
				echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		 }
		exit; 
	 }
	   public function actionCommunity($state_id=null,$country_id=null,$text=null){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria= Community::model()->search(1);
		$region_id = $state_id;
		$country_id =$country_id;
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
		
		$criteria->compare('community_name',$text,true);
		$count = Community::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = Community::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->community_id,'name'=>$v->community_name.'('.$v->location.')');
			}
			echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		}
		else{
			 echo $this->generateOutPut('FAILED','0',array(),array());
		}
		exit; 
         
	}
	 public function actionSubCoummunity($community_id=null,$text=null){
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->condition =   't.community_id=:community_id';
		$criteria->params = array(':community_id'=>$community_id); 
		$criteria->compare('sub_community_name',$text,true);
		$Result = SubCommunity::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->sub_community_id,'name'=>$v->sub_community_name);
			}
			echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		}
		else{
			 echo $this->generateOutPut('FAILED','0',array(),array());
		}
         exit; 
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
	 public $fields_to_hide ; 
	 public function checkHideFeild($model,$field){
		  if(!$model->checkFieldsShow($field)){ 
			  $this->fields_to_hide[] = $field;  
			 
		  }
	 }
	 public function actionCreateAd($user_id=null,$ad_id=null){
		 
		 if(!empty($ad_id)){
			 
			  $model = PlaceAnAd::model()->findByPk((int)$ad_id);
			  if(!empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No User Found',array());exit;
			  }
		}
		else{
			$model = new PlaceAnAd(); 
		}
	
		$request = Yii::app()->request;
	  
		 
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
			$model->attributes = (array)$_GET ; 
			
			$not_mandatory_fields = array();
			$this->fields_to_hide       = array();
			if(!empty($model->category_id)){
				$category= Category::model()->findByPk($model->category_id);
				if(empty($category)){
					echo $this->generateOutPut('FAILED','0','No Category found',array());exit;
				}
				$subcategory= Subcategory::model()->FindSubategory($model->sub_category_id);            
				$fields=array();         

				$fields=  CHtml::listData($category->relatedFields,'field_name','field_name');
				$not_mandatory_fields=  array_merge($model->common_not_mandatory_field(),CHtml::listData($category->relatedFieldsMandatory,'field_name','field_name'));
				$model->dynamic  =  true; 
				$model->dynamicArray =  $model->getExcludeArray((array)$fields) ;;
				$model->_notMadatory =  $not_mandatory_fields;
			}
		
			
			$input_data[] = array( 'field_name' => 'country' , 'label'=> $model->getAttributeLabel('country') , 'values' => Countries::model()->ListDataForJSON2() ,'field_value'=>$model->country,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'state' , 'label'=> $model->getAttributeLabel('state') , 'values' =>States::model()->ListDataForJSON2($model->country),'field_value'=>$model->state,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'section_id' , 'label'=> $model->getAttributeLabel('section_id') , 'values' =>Section::model()->ListDataForJSON_ID2(),'field_value'=>$model->section_id,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'listing_type' , 'label'=> $model->getAttributeLabel('listing_type') , 'values' =>Category::model()->ListDataTypeForJSON_ID2(),'field_value'=>$model->listing_type,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'category_id' , 'label'=> $model->getAttributeLabel('category_id') , 'values' => Category::model()->ListDataForJSON_ID_BySEction2($model->listing_type),'field_value'=>$model->category_id,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'sub_category_id' , 'label'=> $model->getAttributeLabel('sub_category_id') , 'values' =>Subcategory::model()->ListDataForJSON_ID2($model->category_id),'field_value'=>$model->sub_category_id,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'ad_title' , 'label'=> $model->getAttributeLabel('ad_title') , 'values' =>array(),'field_value'=>$model->ad_title,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'ad_description' , 'label'=> $model->getAttributeLabel('ad_description') , 'values' =>array(),'field_value'=>$model->ad_description,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'builtup_area' , 'label'=> $model->getAttributeLabel('builtup_area') , 'values' =>array(),'field_value'=>$model->builtup_area,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'plot_area' , 'label'=> $model->getAttributeLabel('plot_area') , 'values' =>array(),'field_value'=>$model->plot_area,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'bathrooms' , 'label'=> $model->getAttributeLabel('bathrooms') , 'values' =>$this->generateKeyArray($model->bathrooms()),'field_value'=>$model->bathrooms,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'bedrooms' , 'label'=> $model->getAttributeLabel('bedrooms') , 'values' =>$this->generateKeyArray($model->bedrooms()),'field_value'=>$model->bedrooms,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'balconies' , 'label'=> $model->getAttributeLabel('balconies') , 'values' =>$this->generateKeyArray($model->balconiesArray()),'field_value'=>$model->balconies,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'FloorNo' , 'label'=> $model->getAttributeLabel('FloorNo') , 'values' =>array(),'field_value'=>$model->FloorNo,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'total_floor' , 'label'=> $model->getAttributeLabel('total_floor') , 'values' =>array(),'field_value'=>$model->total_floor,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'parking' , 'label'=> $model->getAttributeLabel('parking') , 'values' =>$this->generateKeyArray($model->parkingArray()),'field_value'=>$model->parking,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'construction_status' , 'label'=> $model->getAttributeLabel('construction_status') , 'values' =>$this->generateKeyArray($model->constructionArray()),'field_value'=>$model->construction_status,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'transaction_type' , 'label'=> $model->getAttributeLabel('transaction_type') , 'values' =>$this->generateKeyArray($model->TransactionType()),'field_value'=>$model->transaction_type,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'year_built' , 'label'=> $model->getAttributeLabel('year_built') , 'values' =>$this->generateKeyArray($model->year()),'field_value'=>$model->year_built,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'rera_no' , 'label'=> $model->getAttributeLabel('rera_no') , 'values' =>array(),'field_value'=>$model->rera_no,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'furnished' , 'label'=> $model->getAttributeLabel('furnished') , 'values' =>$this->generateKeyArray($model->YesNoArray2()),'field_value'=>$model->furnished,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'maid_room' , 'label'=> $model->getAttributeLabel('maid_room') , 'values' =>$this->generateKeyArray($model->YesNoArray2()),'field_value'=>$model->maid_room,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'PrimaryUnitView' , 'label'=> $model->getAttributeLabel('PrimaryUnitView') , 'values' =>array(),'field_value'=>$model->PrimaryUnitView,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'community_id' , 'label'=> $model->getAttributeLabel('community_id') , 'values' =>$this->generateKeyArray( CHtml::listData( Community::model()->findAllByAttributes(array('community_id'=>$model->community_id)),'community_id','community_name')),'field_value'=>$model->community_id,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'sub_community_id' , 'label'=> $model->getAttributeLabel('sub_community_id') , 'values' =>$this->generateKeyArray( CHtml::listData(  SubCommunity::model()->findAllByAttributes(array('sub_community_id'=>$model->sub_community_id)),'sub_community_id','sub_community_name')),'field_value'=>$model->sub_community_id,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'nearest_metro' , 'label'=> $model->getAttributeLabel('nearest_metro') , 'values' => array(),'field_value'=>$model->nearest_metro,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'nearest_railway' , 'label'=> $model->getAttributeLabel('nearest_railway') , 'values' => array(),'field_value'=>$model->nearest_railway,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'amenities' , 'label'=> $model->getAttributeLabel('amenities') , 'values' =>$this->generateKeyArray( CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name') ) ,'field_value'=>$model->amenities,'is_multiple_select'=>'1');
			$input_data[] = array( 'field_name' => 'mobile_number' , 'label'=> $model->getAttributeLabel('mobile_number') , 'values' => array(),'field_value'=>$model->mobile_number,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'price' , 'label'=> $model->getAttributeLabel('price').'['.$model->currencyTitle.']' , 'values' => array(),'field_value'=>$model->mobile_number,'is_multiple_select'=>'');
			$input_data[] = array( 'field_name' => 'rent_paid' , 'label'=> $model->getAttributeLabel('rent_paid')  , 'values' =>   array(array('id'=>"monthly",'name'=>"Monthly"),array('id'=>"yearly",'name'=>"Yearly")),'field_value'=>$model->rent_paid,'is_multiple_select'=>'');
			
			$image_logo_detail = array('file_name'=>'file','format'=>'gif , jpg , jpeg , png','upload_url'=>Yii::App()->apps->getBaseUrl('user/upload',true));
			
			
			$input_data[] = array( 'field_name' => 'image' , 'label'=> $model->getAttributeLabel('image')  , 'values' =>  array() ,'field_value'=>$model->image,'is_multiple_select'=>'','upload_details'=>$image_logo_detail);
			
			$image_logo_detail = array('file_name'=>'file','format'=>$model->generateFormat(),'upload_url'=>Yii::App()->apps->getBaseUrl('user/upload/upload_path/floor_plan',true));
			
			$input_data[] = array( 'field_name' => 'floor_plan' , 'label'=> $model->getAttributeLabel('floor_plan')  , 'values' =>  array() ,'field_value'=>$model->floor_plan,'is_multiple_select'=>'','upload_details'=>$image_logo_detail);
			$input_data[] = array( 'field_name' => 'location_latitude' , 'label'=> $model->getAttributeLabel('location_latitude'), 'values' =>array(),'field_value'=>$model->location_latitude,'is_multiple_select'=>'' );
			$input_data[] = array( 'field_name' => 'location_longitude' , 'label'=> $model->getAttributeLabel('location_longitude'), 'values' =>array(),'field_value'=>$model->location_longitude,'is_multiple_select'=>'');
			
			if(!empty($model->dynamicArray )){
				 
				$Ar = array('builtup_area','plot_area','bathrooms','bedrooms','balconies','FloorNo','total_floor','parking','construction_status','transaction_type','year_built','rera_no','furnished','maid_room','PrimaryUnitView');
				foreach($Ar as $t){
					$this->checkHideFeild($model,$t);
					 
				}
				if($model->section_id==$model::RENT_ID){
					$this->fields_to_hide[] = 'rent_paid';
				}
				 
			}
			
			echo $this->generateOutPut('SUCCESS','1',array(),array('field_data'=>$input_data,'not_mandatory_fields'=>$not_mandatory_fields,'hidden_fields'=>$this->fields_to_hide));
		}
		exit; 
	 }
   public function actionContact_Property_detail($property_id=null)
     {
		 
		$property =  PlaceAnAd::model()->findByPk($property_id);
		if(empty($property)){
			echo $this->generateOutPut('FAILED','0','No property found',array());exit;
		}
		 
        $model = new SendEnquiry(); 
        $model->ad_id = $property->id ;    
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
				$country = Countries::model()->ListDataN();
				$input_data[] = array( 'field_name' => 'name' , 'label'=> $model->getAttributeLabel('name') , 'values' => $model->name ,'field_value'=>array());
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => $model->email ,'field_value'=>array());
				$input_data[] = array( 'field_name' => 'mobile_code_id' , 'label'=> $model->getAttributeLabel('mobile_code_id') , 'values' => $model->mobile_code_id,'field_value'=>$country );
				$input_data[] = array( 'field_name' => 'phone' , 'label'=> $model->getAttributeLabel('phone') , 'values' => $model->phone,'field_value'=>array() );
				$input_data[] = array( 'field_name' => 'city' , 'label'=> $model->getAttributeLabel('city') , 'values' => $model->city ,'field_value'=>array());
				$input_data[] = array( 'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' => $model->country_id,'field_value'=>$country );
				$input_data[] = array( 'field_name' => 'meassage' , 'label'=> $model->getAttributeLabel('meassage') , 'values' => $model->meassage,'field_value'=>array() );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    } 
}
