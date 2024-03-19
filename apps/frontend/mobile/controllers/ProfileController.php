<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class ProfileController extends Controller
{
     public function  Init()
     {  	 
			parent::Init();
	 }
	  
	  function upload_file($type='ad',$encoded,$name) {	
		switch($type){
				case 'ad':
				$pathi = 'ad';
				break;
				default:
				$pathi = 'ad';
				break;
		}
		 	  
		$location ="../../uploads/".$pathi."/".$name;
    	$handle = fopen($location,"w+");
		$current =  file_get_contents($location); ;   
		$current = base64_decode($encoded);                          // Now decode the content which was sent by the client     
        file_put_contents($location, $current);   
    
			if(!empty($name))
			{
				$path =  pathinfo($name,PATHINFO_FILENAME);
				$ext  =  pathinfo($name,PATHINFO_EXTENSION);
			}
			  
			if(!empty($path) && !empty($ext) and is_file(Yii::getPathOfAlias('root.uploads.'.$pathi.'.'.$path).".{$ext}") )
			{
				 return   json_encode(array("status"=>"SUCCESS","statusCode"=>"1", "data"=>array("FileName"=>$name))) ; 
			}
			else
			{
				 return   json_encode(array("status"=>"FAILED","statusCode"=>"0","errorMessage"=>"Failed to upload","data"=>array())) ; 
			}
 
    }
    	 public function  generateOutPut($status='',$code='1',$error_message=array(),$data=array()){
		 return json_encode(array("status"=>$status,"statusCode"=>$code,"errorMessage"=>$error_message,"data"=>$data))  ;		
	 }
	 public function html_encode($input){
		 return htmlspecialchars($input);
	 }
     function actionUpdate_user($user_id)
	 {
		 
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
        if ($request->isPostRequest  ) {
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if (!$model->save()) {
					echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
			}
			else
			{ 
					echo $this->generateOutPut('SUCCESS','1',array(),array(),Yii::app()->options->get('system.messages.successfully_saved_personal_information','Succesfully saved personal information.'), array()));
			}
		 
	    }
        else
        {
				$input_data[] = array( 'field_name' => 'first_name' , 'label'=> $model->getAttributeLabel('first_name') , 'values' => '','field_value'=>$model->first_name,'is_multiple_select'=>'' );
				$input_data[] = array( 'field_name' => 'last_name' , 'label'=> $model->getAttributeLabel('last_name') , 'values' => '','field_value'=>$model->last_name,'is_multiple_select'=>'' );
				$input_data[] = array( 'field_name' => 'designation_id' , 'label'=> $model->getAttributeLabel('designation_id') , 'values' =>CHtml::listData(AgentRole::model()->listData(),'service_id','service_name'),'field_value'=>$model->designation_id,'is_multiple_select'=>''   );
				$input_data[] = array( 'field_name' => 'company_name' , 'label'=> $model->getAttributeLabel('company_name') , 'values' => '','field_value'=>$model->company_name,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' =>CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"),'field_value'=>$model->country_id,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'state_id' , 'label'=> $model->getAttributeLabel('state_id') , 'values' =>CHtml::listData(States::model()->getStateWithCountry_2($model->country_id),"state_id" ,"state_name"),'field_value'=>$model->state_id,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'address' , 'label'=> $model->getAttributeLabel('address') , 'values' =>'','field_value'=>$model->address,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'phone' , 'label'=> $model->getAttributeLabel('phone') , 'values' => '','field_value'=>$model->phone,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'website' , 'label'=> $model->getAttributeLabel('website') , 'values' => '','field_value'=>$model->website,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'contact_person' , 'label'=> $model->getAttributeLabel('contact_person') , 'values' => '','field_value'=>$model->contact_person,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'contact_email' , 'label'=> $model->getAttributeLabel('contact_email') , 'values' => '','field_value'=>$model->contact_email,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'facebook' , 'label'=> $model->getAttributeLabel('facebook') , 'values' => '','field_value'=>$model->facebook,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'twiter' , 'label'=> $model->getAttributeLabel('twiter') , 'values' => '','field_value'=>$model->twiter,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'google' , 'label'=> $model->getAttributeLabel('google') , 'values' => '','field_value'=>$model->google,'is_multiple_select'=>'');
				
				
				$datas = CHtml::listData(Section::model()->listData(),'section_id','section_name') ;
				unset($datas['3']);
				
				$input_data[] = array( 'field_name' => 'service_offerng[]' , 'label'=> $model->getAttributeLabel('service_offerng') , 'values' => $datas ,'field_value'=> CHtml::listData($model->moreSection,'section_id','section_id'),'is_multiple_select'=>'1');
				$datas = CHtml::listData(Category::model()->listData(),'category_id','category_name') ;
				$input_data[] = array( 'field_name' => 'service_offerng_detail[]' , 'label'=> $model->getAttributeLabel('service_offerng_detail') , 'values' => $datas ,'field_value'=> CHtml::listData($model->moreCategory,'category_id','category_id'),'is_multiple_select'=>'1');
				$input_data[] = array( 'field_name' => 'languages_known[]' , 'label'=> $model->getAttributeLabel('languages_known') , 'values' => Language::getLanguagesArray(),'field_value'=> CHtml::listData($model->moreLanguages,'language_id','language_id') ,'is_multiple_select'=>'1' );
				
				$input_data[] = array( 'field_name' => 'mul_country_id[]' , 'label'=> $model->getAttributeLabel('mul_country_id') , 'values' => CHtml::listData(Countries::model()->Countrylist2(),'country_id','country_name')  ,'field_value'=> CHtml::listData($model->moreCountry,'country_id','country_id'),'is_multiple_select'=>'1' );
				$input_data[] = array( 'field_name' => 'mul_state_id[]' , 'label'=> $model->getAttributeLabel('mul_state_id') , 'values' =>  CHtml::listData(States::model()->findAllByAttributes(array('state_id'=>$model->mul_state_id)),'state_id','state_name'), 'field_value'=>CHtml::listData($model->moreState,'state_id','state_id') ,'is_multiple_select'=>'1');
				
				$input_data[] = array( 'field_name' => 'description' , 'label'=> $model->getAttributeLabel('description') , 'values' => '' ,'field_value'=>$model->description,'is_multiple_select'=>'');
				$input_data[] = array( 'field_name' => 'licence_no' , 'label'=> $model->getAttributeLabel('licence_no') , 'values' => '' ,'field_value'=>$model->licence_no,'is_multiple_select'=>'' );
				
				if($model->user_type=='D'){
				 $resize_width  = $options->get('system.upload.developer_avatar_resize_width','');
				 $resize_height = $options->get('system.upload.developer_avatar_resize_height','');
			    }else{
					$resize_width  = '400';
					$resize_height = '400';
				}
				$image_logo_detail = array('format'=>'gif , jpg , jpeg , png','width'=>$resize_width,'height'=>$resize_height,'upload_url'=>Yii::App()->apps->getBaseUrl('user/upload?width='.$resize_width.'&height='.$resize_height,true));
				
				$input_data[] = array( 'field_name' => 'image' , 'label'=> $model->getAttributeLabel('image') , 'values' => '' ,'field_value'=>!empty($model->image) ? $model->UserAvatarUrlAbsolute : '' ,'is_multiple_select'=>'','upload_details'=>$image_logo_detail );
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
}
