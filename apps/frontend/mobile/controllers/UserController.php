<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class UserController extends Controller
{
     public function  Init()
     {  	 
			parent::Init();
	 }
	 
	 public function html_encode($input){
		 return htmlspecialchars($input);
	 }
     public function actionSignup()
     {
		 
        $model = new ListingUsers();    
        $request = Yii::app()->request;
		$model->scenario = 'frontend_insert' ; 
		
		
		$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
			$model->status='A';
			$model->verification_code = md5(uniqid(rand(), true));
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$model->getErrors(),$model->getErrors());
			}
			else
			{ 
				$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($model->first_name),"Email"=>$this->html_encode($model->email));
				echo $this->generateOutPut('SUCCESS','1',array(),$succes_data);
			}
			
			exit; 
        if ($request->isPostRequest  ) {
				
			$attributes =  (array)$request->getPost($model->modelName, array()) ;
			$model->attributes = $attributes;
			$model->status='A';
			$model->verification_code = md5(uniqid(rand(), true));
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$user->getErrors(),$user->getErrors());
			}
			else
			{ 
				$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($user->first_name),"Email"=>$this->html_encode($user->email));
				echo $this->generateOutPut('SUCCESS','1',array(),$succes_data);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'ListingUsers[first_name]' , 'label'=> $model->getAttributeLabel('first_name') , 'values' => '');
				$input_data[] = array( 'field_name' => 'ListingUsers[last_name]' , 'label'=> $model->getAttributeLabel('last_name') , 'values' => '');
				$input_data[] = array( 'field_name' => 'ListingUsers[email]' , 'label'=> $model->getAttributeLabel('email') , 'values' => '');
				$input_data[] = array( 'field_name' => 'ListingUsers[password]' , 'label'=> $model->getAttributeLabel('password') , 'values' => '');
				$input_data[] = array( 'field_name' => 'ListingUsers[country_id]' , 'label'=> $model->getAttributeLabel('country_id') , 'values' =>CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"));
				$input_data[] = array( 'field_name' => 'address' , 'label'=> $model->getAttributeLabel('address') , 'values' =>'');
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
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
								    echo $this->generateOutPut('SUCCESS','1',array(),array('Logged in'));exit; 
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
									$input_data[] = array(  'field_type' => 'vissible' , 'field_name' => 'password' , 'label'=> $model->getAttributeLabel('password') , 'values' => array());
									$country_value = CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name");
									$Ar = array();
									foreach($country_value as $kl=>$vl){
									$Ar[] = array('id'=>$kl, 'name'=>$vl);
									}
									$input_data[] = array( 'field_type' => 'vissible' ,  'field_name' => 'country_id' , 'label'=> $model->getAttributeLabel('country_id') , 'values' => $Ar);
									$type_value = $model->getUserType();
									$Ar2 = array();
									foreach($type_value as $kl=>$vl){
									$Ar2[] = array('id'=>$kl, 'name'=>$vl);
									}
									$input_data[] = array(  'field_type' => 'vissible' , 'field_name' => 'user_type' , 'label'=> $model->getAttributeLabel('user_type') , 'values' => $Ar2);
									echo $this->generateOutPut('SUCCESS','1',array(),array('FIELDS_ARRAY'=>$input_data)); 
					       
						}
					 }
					 else{
						 echo $this->generateOutPut('FAILED','0','Email Cannot be blank',array());
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
    public function actionContact()
     {
		 
        $model = new ContactUs();    
        $request = Yii::app()->request;
		 
	 
			
			 
        if ($request->isPostRequest  ) {
				
			$attributes =  (array) $_POST ;
			$model->attributes = $attributes;
			if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$user->getErrors(),$user->getErrors());
			}
			else
			{ 
				$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($user->first_name),"Email"=>$this->html_encode($user->email));
				echo $this->generateOutPut('SUCCESS','1',array(),$succes_data);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'name' , 'label'=> $model->getAttributeLabel('name') , 'values' => $model->name );
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => $model->email );
				$input_data[] = array( 'field_name' => 'city' , 'label'=> $model->getAttributeLabel('city') , 'values' => $model->city );
				$input_data[] = array( 'field_name' => 'meassage' , 'label'=> $model->getAttributeLabel('meassage') , 'values' => $model->meassage );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
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
				echo $this->generateOutPut('FAILED','0',$user->getErrors(),$user->getErrors());
			}
			else
			{ 
				$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($user->name),"Email"=>$this->html_encode($user->email));
				echo $this->generateOutPut('SUCCESS','1',array(),$succes_data);
			}
	    }
	    else{
				$input_data[] = array( 'field_name' => 'name' , 'label'=> $model->getAttributeLabel('name') , 'values' => $model->name );
				$input_data[] = array( 'field_name' => 'email' , 'label'=> $model->getAttributeLabel('email') , 'values' => $model->email );
				$input_data[] = array( 'field_name' => 'phone' , 'label'=> $model->getAttributeLabel('phone') , 'values' => $model->phone );
				$input_data[] = array( 'field_name' => 'city' , 'label'=> $model->getAttributeLabel('city') , 'values' => $model->city );
				$input_data[] = array( 'field_name' => 'meassage' , 'label'=> $model->getAttributeLabel('meassage') , 'values' => $model->meassage );
				echo $this->generateOutPut('SUCCESS','1',array(),$input_data);
		} 
	    Yii::app()->end();
    } 
    
   
     public function actionGetBlogCategories(){
	 
	     $category = ArticleCategory::model()->getBlogCategories('20');
	     if(empty($state_list)){
		    	 echo $this->generateOutPut('FAILED','0',array(),array());
		 }
		 else{
				$ar = array() ; 
				foreach($category as $k=>$v)
				{
						$ar[]= array("id"=>$v->primaryKey , "name" => $v->name );
				}
				echo $this->generateOutPut('SUCCESS','1',array(),$ar);
		 }
		exit; 
	 }
     public function actionBloglist($offset=0, $limit=10 , $id = 20 ){
		 
	 
	    $articleCategoryFromSlug = ArticleCategory::model()->findByPk( $id );
	     if(empty($articleCategoryFromSlug)){
		    	 echo $this->generateOutPut('FAILED','0','No Blog Category Found',array());exit; 
		 }
	    $criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
		if($articleCategoryFromSlug->parent_id=="")
		{
			$criteria->condition = 't.status=:pub and  categories.parent_id=:parent';       
		}
		else
		{
			$criteria->condition = 't.status=:pub and  categories.category_id=:parent';		
		}
		$criteria->order  ="t.article_id desc";
		$criteria->group  ="t.article_id";
		$criteria->params[':parent']   = $articleCategoryFromSlug->category_id  ;
		$criteria->params[':pub']   = 'published'  ;		
		$criteria->together =true;
		$criteria->offset = $offset ;
		$criteria->limit = $limit ;	 
        $model=Article::model()->findAll($criteria);
		if(!empty($model)){
			$list =array();
			foreach($model as $k=>$v){
				preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);
				$string = strip_tags($v->content);
				$string =  (strlen($string)>150) ? substr($string,0,150).'...':$string;
				$date = date('M d , Y h:i A',strtotime($v->date_added)) ; 

				$list[] = array('title' => $v->title, 'image' =>@$imges['1'], 'short_description' =>$string , 'post_date' => $date ) ; 
			}
			echo $this->generateOutPut('SUCCESS','1', '' ,$list,'','List Of Ads');
		}
		else{
			echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());
		}
		exit; 
	 }
     public function actionBlogDetail($id=null){
		 
	 
	    $model  = Article::model()->findByAttributes(array('slug'=>$id));
		 
		if(empty($model))
		{
			  echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());exit; 
		}
		if(!empty($model)){
			 
				preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $model->content, $imges);			 
				$date = date('M d , Y h:i A',strtotime($model->date_added)) ; 
				$list = array('title' => $v->title, 'image' =>@$imges['1'], 'description' =>htmlspecialchars(strip_tags($v->content))  , 'post_date' => $date ) ; 
			 
				echo $this->generateOutPut('SUCCESS','1', '' ,$list,'','List Of Ads');
		}
		else{
			echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());
		}
		exit; 
	 }
	 
	 public function get_dashboard_stat($user_id=null){
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
			$model->scenario = 'updatepassword' ; 
		 
            if (!$model->save()) {
				echo $this->generateOutPut('FAILED','0',$user->getErrors(),$user->getErrors());
			}
			else
			{ 
				$succes_data = array("Id"=>$user->user_id,"Name"=>$this->html_encode($user->first_name),"Email"=>$this->html_encode($user->email));
				echo $this->generateOutPut('SUCCESS','1',array(),array(),'Successfully update password');
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
 
    public function actionLocations($query=null)
    {
        $request = Yii::app()->request;
       
        $criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name,cn.slug as country_slug,t.slug,cm.community_id,cm.community_name';
		$criteria->join = 'INNER JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->join .= 'LEFT JOIN {{community}} cm ON cm.region_id  = t.state_id  ';
		$criteria->condition = 'cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
		if(!empty($query)){
		$criteria->condition .= ' and  ( CASE WHEN community_name IS NOT NULL THEN  ( CONCAT(state_name, " ", country_name," ",community_name) like  :term  ) ELSE ( CONCAT(state_name, " ", country_name) like  :term  ) END  )  ' ;
		$criteria->order  = 'cm.community_name asc , t.state_name asc , cn.country_name asc ' ;
        $criteria->params[':term'] = '%'.$query.'%' ;
	    }
	    else{
			$criteria->group  = 't.country_id';
			$criteria->order = '-t.priority desc ';
		}
        $criteria->limit = 10;
        $models = States::model()->findAll($criteria);
        $results = array();
        $loaded_state =array();
        if($models){
			foreach ($models as $model) {
				if(empty($model->community_name)){   $title = $model->state_name .','.$model->country_name; }else{ $title =  $model->community_name. ',' .$model->state_name; }
				if(!in_array($model->state_id,$loaded_state) and !empty($model->community_name) ){
					$results['suggestions'][] = array(
					'country_id'	 => $this->checkEmpty($model->country_id),
					'state_id' 		 => $this->checkEmpty($model->state_id),
					'community_id' 	 => array(),
					'value'      	 => $model->state_name .','.@$model->country_name  ,
					 
					);
					$loaded_state[$model->state_id] = $model->state_id;
				}
				$results['suggestions'][] = array(
					'country_id'    => $this->checkEmpty($model->country_id),
					'state_id'  	=> $this->checkEmpty($model->state_id),
					'community_id'  => $this->checkEmpty($model->community_id),
					'value'         => $title,
					 
				);
			}
		}
		else{
			$results['suggestions'] = array();
		}
        echo $this->generateOutPut('SUCCESS','1', '' ,$results,'','Location Api');
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
									echo $this->generateOutPut('SUCCESS','1',array(),array('is_ad_save'=>'1'), 'Successfully saved this  property' );
								}
								else{
									echo $this->generateOutPut('FAILED','0',$model->getErrors(),array());
								}
							}
							else{
								 echo $this->generateOutPut('SUCCESS','1',array(), array('is_ad_save'=>'1'), 'Successfully saved this  property' );
							}
							exit; 
					 
					}
					if($fun =='remove_save_property'){
							$found = AdSave::model()->findByAttributes(array('ad_id'=>$ad_id,'user_id'=>$loged_in_user));
							if($found){
								$found->delete();
							}
							$message = 'Successfully removed this  property from saved list';
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
