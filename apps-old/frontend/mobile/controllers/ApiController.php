<?php defined('MW_PATH') || exit('No direct script access allowed');
 
 
class ApiController  extends Controller
{
     public function  Init()
     {  	 
			parent::Init();
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
     public function actionCountry_list()
     {
		$listContries  = Countries::model()->list_array_country2();
		echo $this->generateOutPut('SUCCESS','1', '' ,$listContries);
	    Yii::app()->end();
    } 
     public function actionCountry_list_new($offset=0,$limit=5)
     {
		$listContries  = Countries::model()->listingCountriesNew($offset,$limit);
		echo $this->generateOutPut('SUCCESS','1', '' ,$listContries);
	    Yii::app()->end();
    } 
    public function actionState_list($country_id=null,$limit=0)
     {
		$listStates  = States::model()->AllListingStatesOfCountry($country_id,$limit);
		$state = array();
		if($listStates){
			foreach($listStates as $k=>$v){
			    $icon  = !empty($v->icon) ?  $v->icon : 'default_state.jpeg';
			    $icon  = Yii::app()->apps->getBaseUrl('uploads/default/'.$icon,true) ;
				$state[] =  array('state_id'=>$v->state_id,'state_name'=>$v->state_name,'slug'=>$v->slug,'logo'=>$icon);
			}
		}
		echo $this->generateOutPut('SUCCESS','1', '' ,$state);
	    Yii::app()->end();
    } 
    
    
    public function actionFeaturedAgentsList($country_id=null,$state_id=null,$limit=10,$offset=0,$logged_in=null,$show_all=null,$keyword=null)
     {
                $agentData = array();
                if(!empty($state_id)){
                $agentData['agent_regi'] = $state_id ;
                }
                if(!empty($country_id)){
                $agentData['country_id'] = $country_id ;
                }
                if(!empty($keyword)){
                $agentData['property'] = $keyword ;
                }
                $criteria = ListingUsers::model()->findAgents( $agentData ,$count_future=false,$user_type='A',$return=1);
                
                if(empty($show_all)){
                $criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
                $criteria->params[':tgid'] = ListingUsers::FEATURED_AGENT;
                }
                if(!empty($logged_in)){
                    $criteria->select .= ' ,uf.follow as follow ';
                    $criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
                    $criteria->params[':user_me'] = $logged_in;
                } 
                
                $criteria->limit =  $limit; 
                $criteria->offset = $offset; 
                      
                $order = '';
                if(!empty($country_id)){
                $order .= ' t.country_id = "'.(int) $country_id.'" desc , ';
                }
                $field = Agents::model()->findAll($criteria);
                
                
                
				if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
				       $agent_list[] = array( 'user_id'=>$v->user_id,'designation'=>$this->checkEmpty($v->designation),'nationality'=>$this->checkEmpty($v->country_name),'full_name'=>$v->fullName , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) , 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  ))  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list);
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Agents Found' ,array(),'','Featured Agents');
                }
	             Yii::app()->end();
    } 
    public function actionList_customers($user_type='A',$country_id=null,$state_id=null,$limit=10,$offset=0,$logged_in=null)
     {
                $agentData = array_filter((array)$_GET); 
                if(!empty($state_id)){
                $agentData['agent_regi'] = $state_id ;
                }
                if(!empty($country_id)){
                $agentData['country_id'] = $country_id ;
                }
                $criteria = ListingUsers::model()->findAgents( $agentData ,$count_future=false,$user_type,$return=1);
                
                if(!empty($logged_in)){
				$criteria->select .= ' ,uf.follow as follow ';
				$criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
				$criteria->params[':user_me'] = $logged_in;
				}
                $criteria->limit =  $limit; 
                $criteria->offset = $offset; 
                
                $title = ''; 
                switch($user_type) {
                  case 'C':
                  $field = Agencies::model()->findAll($criteria);
                  $title = 'Agencies'; 
                  break;
                  case 'D':
                  $field = Developer::model()->findAll($criteria);
                  $title = 'Developers'; 
                  break;
                  default:
                  $field = Agents::model()->findAll($criteria);
                   $title = 'Agents'; 
                  break;
                }    
                
				if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
				       switch($user_type) {
                        case 'C':
                        $agent_list[] = array( 'user_id'=>$v->user_id,'full_name'=>$v->fullName,'nationality'=>$this->checkEmpty($v->country_name) , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) , 'short_description'=>$v->ShortDescription, 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  ) )  ;
                        break;
                        case 'D':
                        $agent_list[] = array( 'user_id'=>$v->user_id,'full_name'=>$v->fullName , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true), 'short_description'=>$v->ShortDescription , 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  ))  ;
                        break;
				        default:
                        $agent_list[] = array( 'user_id'=>$v->user_id,'designation'=>$this->checkEmpty($v->designation),'nationality'=>$this->checkEmpty($v->country_name),'full_name'=>$v->fullName , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) , 'short_description'=>$v->ShortDescription, 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  )  )  ;
                        break;  
				           
				       }
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'', $title);
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Results Found' ,array(),'', $title);
                }
	             Yii::app()->end();
    } 
     public function actionFeaturedDevelopersList($country_id=null,$state_id=null,$limit=10,$offset=0,$logged_in=null,$show_all=null)
     {
                $agentData = array();
                if(!empty($state_id)){
                $agentData['agent_regi'] = $state_id ;
                }
                if(!empty($country_id)){
                $agentData['country_id'] = $country_id ;
                }
                $criteria = ListingUsers::model()->findAgents( $agentData ,$count_future=false,$user_type='D',$return=1);
                if(empty($show_all)){
                $criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
                $criteria->params[':tgid'] = ListingUsers::FEATURED_DEVELOPER;
                 }
                if(!empty($logged_in)){
                    $criteria->select .= ' ,uf.follow as follow ';
                    $criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
                    $criteria->params[':user_me'] = $logged_in;
                } 
                $criteria->limit =  $limit; 
                $criteria->offset = $offset; 
                
                $order = '';
                if(!empty($country_id)){
                $order .= ' t.country_id = "'.(int) $country_id.'" desc , ';
                }
                $criteria->order = $order.'-t.priority  desc , t.user_id desc'; 
                $field = Developer::model()->findAll($criteria);
                
                
                
				if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
				       $agent_list[] = array( 'user_id'=>$v->user_id,'full_name'=>$v->fullName , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) , 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  ))  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list);
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Developers Found' ,array(),'','Featured Devlopers');
                }
	             Yii::app()->end();
    }
    public function actionFeaturedAgenciesList($country_id=null,$state_id=null,$limit=10,$offset=0,$logged_in=null,$show_all=null)
     {
                $agentData = array();
                if(!empty($state_id)){
                $agentData['agent_regi'] = $state_id ;
                }
                if(!empty($country_id)){
                $agentData['country_id'] = $country_id ;
                }
                $criteria = ListingUsers::model()->findAgents( $agentData ,$count_future=false,$user_type='C',$return=1);
                if(empty($show_all)){
                $criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
                $criteria->params[':tgid'] = ListingUsers::FEATURED_AGENCIES;
                }
                if(!empty($logged_in)){
                    $criteria->select .= ' ,uf.follow as follow ';
                    $criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
                    $criteria->params[':user_me'] = $logged_in;
                } 
                 
                $criteria->limit =  $limit; 
                $criteria->offset = $offset; 
               
                $order = '';
                if(!empty($country_id)){
                $order .= ' t.country_id = "'.(int) $country_id.'" desc , ';
                }
                $criteria->order = $order.'-t.priority  desc , t.user_id desc'; 
                $field = Agencies::model()->findAll($criteria);
                
                
                
				if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
				       $agent_list[] = array( 'user_id'=>$v->user_id,'full_name'=>$v->fullName,'nationality'=>$this->checkEmpty($v->country_name) , 'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$v->image,true) , 'is_user_follow' => array('label'=> empty($v->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($v->follow) ? 0 : 1  ))  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','Featured Agencies');
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Agencies Found' ,array());
                }
	             Yii::app()->end();
    }
     
   public function actionAdsList($sec=null,$limit=10,$offset=0)
     {
         
                $formData = array_filter((array)$_GET); 
                if(!empty($sec)){
                       $formData['_sec_id']  = $sec ;  
                        unset($formData['sec']) ;
                }
                 
                $criteria =  PlaceAnAd::model()->findAds($formData,false,1);
                $criteria->select .= ',usr.phone as user_number,usr.user_type,usr.company_name,usr.company_name as company_name,usr.website as user_website,usr.address as user_address';
                if(isset($_GET['logged_in']) and !empty($_GET['logged_in'])  ){
					    if(isset($_GET['my_favourite']) and !empty($_GET['my_favourite'])){
							 $criteria->select .= ' ,fav.ad_id as fav ';
							 $criteria->join  .= ' inner  join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
						}
						else{
							$criteria->select .= ' ,fav.ad_id as fav ';
							$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
						}
                        if(isset($_GET['my_saved']) and !empty($_GET['my_saved'])){
							$criteria->select .= ' ,sav.ad_id as is_saved ';
							$criteria->join  .= ' inner join {{ad_save}} sav ON sav.ad_id = t.id and sav.user_id =:user_me';
						}
						else{
							$criteria->select .= ' ,sav.ad_id as is_saved ';
							$criteria->join  .= ' left join {{ad_save}} sav ON sav.ad_id = t.id and sav.user_id =:user_me';
						}
                        
                        $criteria->params[':user_me'] =  (int) $_GET['logged_in'] ;
                }
                if(isset($formData['state_id']) and !empty($formData['state_id'])){
                   $criteria->condition .= ' and t.state=:state_ids ';
                   $criteria->params[':state_ids'] = $formData['state_id'];
                }
        		else if(isset($formData['country_id']) and !empty($formData['country_id'])){
        			$criteria->condition .= ' and t.country=:country_id ';$criteria->params[':country_id'] = $formData['country_id'];
        		}
                $criteria->limit = $limit ;
                $criteria->offset = $offset ; 
                $field = PlaceAnAd::model()->findAll($criteria);
				if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
                	   $image = array();
                	   if(!empty($v->ad_images_g)){
                			$itemsI = explode(',',$v->ad_images_g);
                			if(!empty($itemsI)){
                				foreach($itemsI as $k=>$ad_img){									 
                			 	   $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$ad_img,true); 
                				} 
                			}
                		}
                		else{
                		      $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$v->ad_image,true);
                		}
				       $agent_list[] = array(
				           'id'=>$v->id,
				           'title'=>$v->ad_title,
				           'short_description'=>$v->ShortDescription,
				           'section_name'=> $this->checkEmpty($v->SectionName)  ,
				           'category_name'=> $this->checkEmpty($v->category_name) , 
				           
				           'state_name'=>$this->checkEmpty($v->state_name) ,
				           'community_name' => $this->checkEmpty($v->community_name) ,
				           
				           'price_array'=>$v->PriceTitleArray  ,
				           'bedrooms'=>!empty($v->bedrooms) ? $v->BedroomTitle : '' ,
				           'bathrooms'=>!empty($v->bathrooms) ? $v->BathroomTitle : '',
				           'builtup_area'=>!empty($v->builtup_area) ? $v->BuiltUpAreaTitle : '',
				           
				           'image_array' => $image ,
				           'is_user_fav'=> empty($v->fav) ? 0 : 1 ,
				            'is_user_saved'=> empty($v->is_saved) ? 0 : 1 ,
				           'state_name'=>$this->checkEmpty($v->state_name) ,
				           'community_name' => $this->checkEmpty($v->community_name) ,
				           'absoluteUrl' => $v->DetailUrlAbsoluteMobile,
				           'contact_number'=>$this->checkEmpty($v->user_number),
				           'date_added' =>  $v->date_added ,
				            
				            'user_details'  => array( 'title'=>$v->userName, 'user_id'=>$v->user_id, 'user_type'=>$v->user_type, 'user_number'=>$this->checkEmpty($v->user_number), 'user_address'=>$this->checkEmpty($v->user_address),'image' => $this->app->apps->getBaseUrl('uploads/images/'.$v->user_image,true) ),
				           )  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','List Of Ads');
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Ads Found' ,array());
                }
	             Yii::app()->end();
    }
     public function actionSearch_parameters()
     {
        $filterModel = new PlaceAnAd();
        $rooms =  $filterModel->bedroomSearchIndex();
        $bath_rooms = $filterModel->bathroomSearchIndex();
        $categories = CHtml::listData(Category::model()->ListData(),'category_id','category_name');
        $listing_type = Category::model()->listingTypeArray();$listing_type["B"] = 'All';
        $price_array =  $filterModel->getPriceArray();
        $sortArray = $filterModel->sortArray();																								
        							
        $array[] =array('title'=>'bedrooms','field_name'=>'bedrooms','val_array'=>$this->generateKeyArray($rooms) );
        $array[] =array('title'=>'bathrooms','field_name'=>'bathrooms','val_array'=>$this->generateKeyArray($bath_rooms) );
        $array[] =array('title'=>'Category','field_name'=>'type_of','val_array'=> $this->generateKeyArray($categories));
        $array[] =array('title'=>'Listing Type','field_name'=>'listing_type','val_array'=>$this->generateKeyArray($listing_type));
        
        $array[] =array('title'=>'Price (Min)','field_name'=>'minPrice','val_array'=>$this->generateKeyArray($price_array));	 
        $array[] =array('title'=>'Price (Max)','field_name'=>'maxPrice','val_array'=>$this->generateKeyArray($price_array));
        $array[] =array('title'=>'Rental Terms','field_name'=>'rent_paid','val_array'=>$this->generateKeyArray(array("monthly"=>"Monthly","yearly"=>"Yearly") ));
        
        $array[] =array('title'=>'Square Feet (Min)','field_name'=>'minSqft','val_array'=>array());
        $array[] =array('title'=>'Square Feet (Max)','field_name'=>'maxSqft','val_array'=>array());
        
        $array[] =array('title'=>'Keyword','field_name'=>'keyword','val_array'=>array());
        
        $array[] =array('title'=>'Sort By','field_name'=>'sort','val_array'=> $this->generateKeyArray($sortArray));
        

		echo $this->generateOutPut('SUCCESS','1', '' , $array);
	    Yii::app()->end();
    } 
    public function actionAgentDetails($agent_id=null,$logged_in=null){
            $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
		    if(!empty($logged_in)){
				$criteria->select .= ' ,uf.follow as follow ';
				$criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
				$criteria->params[':user_me'] = $logged_in;
			}
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','A');
			$criteria->condition .= ' and t.user_id=:user_id ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
            $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':user_id'] = $agent_id;
			$model = Agents::model()->find($criteria);
			if(empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No Agents Found' ,array(),'','Agent Details');
			}
			else{
                $service_location_country = $model->ServiceLocationDetails;
                $service_location_state = $model->ServiceLocationStatesDetails;
                $service_offering = $model->ServiceOfferingDetails;
                $service_offering_category = $model->CategoryOfferingDetails;
                $serv_a =   $service_location_country;
                if(!empty($service_location_state)){  $serv_a .= '('.$service_location_state.')';  }  
                $agent_list  =
                array( 
                    'user_id'=>$model->user_id,
                    'full_name'=>$model->fullName,
                    'phone'=>$model->phone,
                    'email'=>$model->email,
                    'nationality'=>$this->checkEmpty($model->country_name) ,
                    'address' => $model->address,
                    'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$model->image,true) ,
                    'description'=>$model->description,
                    'joined_on'  =>  $model->date_added ,
                     'website' =>  $this->checkEmpty($model->website) ,
                     'facebook' =>  $this->checkEmpty($model->facebook) ,
                     'twiter' =>  $this->checkEmpty($model->twiter) ,
                     'google' =>  $this->checkEmpty($model->google) ,
                     'licence_no' => $this->checkEmpty($model->licence_no) ,
                     'languages_known' =>  $this->checkEmpty($model->Userall_languages),
                     'service_areas'  => $this->checkEmpty( $serv_a ) ,
                     'service_offering'  => $this->checkEmpty($service_offering) ,
                     'service_category'  => $this->checkEmpty($service_offering_category) ,
                     'for_sale'  => $model->sale_total,
                     'for_rent'  => $model->rent_total,
                       'is_user_follow' => array('label'=> empty($model->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($model->follow) ? 0 : 1  ) 
                    )  ;
                       
                echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','Agent Details');
			}
    
    }
    
    
    public function actionUserDetails($user_id=null){
            $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
			$criteria->compare('t.isTrash','0');
		//	$criteria->compare('t.status','A');
		//	$criteria->compare('t.user_type','A');
			$criteria->condition .= ' and t.user_id=:user_id ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
            $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':user_id'] = $user_id;
			$model = ListingUsers::model()->find($criteria);
			if(empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No User Found' ,array(),'','User Details');
			}
			else{
               // $service_location_country = $model->ServiceLocationDetails;
                //$service_location_state = $model->ServiceLocationStatesDetails;
               // $service_offering = $model->ServiceOfferingDetails;
                //$service_offering_category = $model->CategoryOfferingDetails;
               // $serv_a =   $service_location_country;
               // if(!empty($service_location_state)){  $serv_a .= '('.$service_location_state.')';  }  
                $agent_list  =
                array( 
                    'user_id'=>$model->user_id,
                    'user_type'=>$model->TypeTile,
                    'full_name'=>$model->fullName,
                    'phone'=>$this->checkEmpty($model->phone),
                    'email'=>$model->email,
                    'status' => $model->StatusTitle,
                    //'nationality'=>$this->checkEmpty($model->country_name) ,
                    //'address' => $model->address,
                    'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$model->image,true) ,
                    'description'=>$this->checkEmpty($model->description),
                     'for_sale'  => $model->sale_total,
                     'for_rent'  => $model->rent_total,
                    )  ;
                       
                echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','User Details');
			}
    
    }
        public function actionAgenciesDetails($agency_id=null,$logged_in=null){
            $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
			 if(!empty($logged_in)){
				$criteria->select .= ' ,uf.follow as follow ';
				$criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
				$criteria->params[':user_me'] = $logged_in;
			}
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','C');
			$criteria->condition .= ' and t.user_id=:user_id ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
            $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':user_id'] = $agency_id;
			$model = Agencies::model()->find($criteria);
			if(empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No Agency Found' ,array(),'','Agency Details');
			}
			else{
                $service_location_country = $model->ServiceLocationDetails;
                $service_location_state = $model->ServiceLocationStatesDetails;
                 $serv_a =   $service_location_country;
                if(!empty($service_location_state)){  $serv_a .= '('.$service_location_state.')';  }  
              
                   $agent_list  =
                array( 
                    'user_id'=>$model->user_id,
                    'company_name'=>$model->fullName,
                    'phone'=>$model->phone,
                    'email'=>$model->email,
                    'nationality'=>$this->checkEmpty($model->country_name) ,
                    'address' => $model->address,
                    'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$model->image,true) ,
                    'description'=>$model->description,
                    'joined_on'  =>  $model->date_added ,
                     'website' =>  $this->checkEmpty($model->website) ,
                     'facebook' =>  $this->checkEmpty($model->facebook) ,
                     'twiter' =>  $this->checkEmpty($model->twiter) ,
                     'google' =>  $this->checkEmpty($model->google) ,
                     'licence_no' => $this->checkEmpty($model->licence_no) ,
                     'languages_known' =>  $this->checkEmpty($model->Userall_languages),
                     'service_areas'  => $this->checkEmpty( $serv_a ) ,
                     'for_sale'  => $model->sale_total,
                     'for_rent'  => $model->rent_total,
                      'is_user_follow' => array('label'=> empty($model->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($model->follow) ? 0 : 1  ) 
                    )  ;
                       
                echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','Agency Details');
			}
    
    }
        public function actionDeveloperDetails($id=null,$logged_in=null){
            $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
			 if(!empty($logged_in)){
				$criteria->select .= ' ,uf.follow as follow ';
				$criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
				$criteria->params[':user_me'] = $logged_in;
			}
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','D');
			$criteria->condition .= ' and t.user_id=:user_id ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
            $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':user_id'] = $id;
			$model = Developer::model()->find($criteria);
			if(empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No Developer Found' ,array(),'','Developer Details');
			}
			else{
                $service_location_country = $model->ServiceLocationDetails;
                $service_location_state = $model->ServiceLocationStatesDetails;
                 $serv_a =   $service_location_country;
                if(!empty($service_location_state)){  $serv_a .= '('.$service_location_state.')';  }  
              
                   $agent_list  =
                array( 
                    'user_id'=>$model->user_id,
                    'company_name'=>$model->fullName,
                    'phone'=>$model->phone,
                    'email'=>$model->email,
                    'nationality'=>$this->checkEmpty($model->country_name) ,
                    'address' => $model->address,
                    'image' => Yii::app()->apps->getBaseUrl('uploads/images/'.$model->image,true) ,
                     'transparent_image' => !empty($model->transparent) ?  Yii::app()->apps->getBaseUrl('uploads/resized/'.$model->transparent,true) : '' ,
                    'description'=>$model->description,
                    'joined_on'  =>  $model->date_added ,
                     'website' =>  $this->checkEmpty($model->website) ,
                     'facebook' =>  $this->checkEmpty($model->facebook) ,
                     'twiter' =>  $this->checkEmpty($model->twiter) ,
                     'google' =>  $this->checkEmpty($model->google) ,
                     'licence_no' => $this->checkEmpty($model->licence_no) ,
                     
                     'service_areas'  => $this->checkEmpty( $serv_a ) ,
                     'for_sale'  => $model->sale_total,
                     'for_rent'  => $model->rent_total,
                      'is_user_follow' => array('label'=> empty($model->follow) ? 'Follow' : 'Following'  ,'value'=>  empty($model->follow) ? 0 : 1  ) 
                    )  ;
                       
                echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','Developer Details');
			}
    
    }
     public function actionPropertyDetails($id=null,$logged_in=null){
            
			$criteria=new CDbCriteria;
			$criteria->select = 't.*,sec.slug as sec_slug,con.country_name as country_name,sub_com.sub_community_name as sub_community_name,st.slug as state_slug,cat.category_name as  category_name,sub.sub_category_name as sub_category_name,usr.description as user_description,usr.image as user_image,usr.first_name,usr.last_name,usr.phone as user_number,usr.address as user_address,usr.user_type as user_type,sec.section_name,st.state_name as state_name,com.community_name,(SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0" limit 1 )   as ad_image';
			$criteria->condition = '1';
		   	$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
			$criteria->join  .= ' left join {{subcategory}} sub ON sub.sub_category_id = t.sub_category_id ';
			$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
			$criteria->join  .= ' left join {{sub_community}} sub_com ON sub_com.sub_community_id = t.sub_community_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
			$criteria->join  .= ' left join {{countries}} con ON con.country_id = t.country ';
			$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			if(!empty($logged_in)){
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			
            $criteria->select .= ' ,sav.ad_id as is_saved ';
            $criteria->join  .= ' left join {{ad_save}} sav ON sav.ad_id = t.id and sav.user_id =:user_me';
                        
			$criteria->params[':user_me'] = $logged_in;
			}
			$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"' ;
			$criteria->condition .= ' and t.id=:id ' ;
			$criteria->params[':id'] = $id;
			$model = PlaceAnAd::model()->find($criteria);
			if(empty($model)){
			  echo $this->generateOutPut('FAILED','0', 'No Property Found' ,array(),'','Agent Details');
			}
			else{
			    	   $image = array();
                	   if(!empty($model->ad_images_g)){
                			$itemsI = explode(',',$model->ad_images_g);
                			if(!empty($itemsI)){
                				foreach($itemsI as $k=>$ad_img){									 
                			 	   $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$ad_img,true); 
                				} 
                			}
                		}
                		else{
                		      $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$model->ad_image,true);
                		}
                $property_detail   = 
                            array(
                            'id' => array('label'=>$model->getAttributeLabel('id'),'value'=>$model->id),
                            'ad_title' => array('label'=>$model->getAttributeLabel('ad_title'),'value'=>$model->ad_title),
                            'ad_description' => array('label'=>$model->getAttributeLabel('ad_description'),'value'=>$model->ad_description),
                            'section_name' => array('label'=>$model->getAttributeLabel('section_name'),'value'=>$this->checkEmpty($model->section_name)),
                            'category_name' => array('label'=>$model->getAttributeLabel('category_name'),'value'=>$this->checkEmpty($model->category_name)),
                            'sub_category_id' => array('label'=>$model->getAttributeLabel('sub_category_id'),'value'=> $this->checkEmpty($model->sub_category_name) ),
                            'location' => array('label'=>$model->getAttributeLabel('location'),'value'=> $this->checkEmpty($model->LocationTitle) ),
                            'community_name' => array('label'=>$model->getAttributeLabel('community_name'),'value'=> $this->checkEmpty($model->community_name) ),
                            'price' => array('label'=>$model->getAttributeLabel('price'),'value'=>  $model->PriceTitleArray ),
				            'image_array' => array('label'=>$model->getAttributeLabel('image_array'),'value'=>  $image ), 
				            'is_user_fav' => array('label'=>$model->getAttributeLabel('is_user_fav'),'value'=>  empty($model->fav) ? 0 : 1  ),
				            'is_user_saved'=> array('label'=>$model->getAttributeLabel('is_user_saved'),'value'=>  empty($model->is_saved) ? 0 : 1  ), 
				           
                );
                
                    $array= array(
                    'bedrooms' => $model->BedroomTitle,
                    'bathrooms' => $model->BathroomTitle,
                    'balconies' => $model->BalconiesTitle,
                    'builtup_area' => $model->BuiltUpArea,
                    'plot_area' => $model->PloatArea,
                    'category_id' =>  $model->category_name,
                    'sub_category_id' => $model->sub_category_name,
                    'FloorNo' => $model->FloorNoTitle,
                    'total_floor' => $model->total_floorTitle,
                    'parking' =>  $model->parkingTitle,
                    'construction_status' => $model->ConstructionTitle,
                    'transaction_type' => $model->TransactionTypeTitle,
                    'year_built' => $model->year_built,
                    'rera_no' => $model->rera_no,
                    'furnished' =>$model->FurnishedTitle,
                    'maid_room'=>$model->MaidRooMTitle,
                    'community_id'=>$model->community_name,
                    'sub_community_id'=>$model->sub_community_name,
                    'country'=>$model->country_name,
                    'state'=>$model->state_name,
                    'section_id' => $model->section_id,
                    'listing_type' => $model->ListingType,
                    'status'=>$model->StatusTitle,
                    'absoluteUrl' => $model->DetailUrlAbsoluteMobile,
                    'contact_number'=>$this->checkEmpty($model->user_number),
                    
                    );
                     $amentites = $model->all_amentitie();
                    foreach( $array as $k=>$v){
                      $property_detail[$k] = array('label'=>$model->getAttributeLabel($k),'value'=>$this->checkEmpty($v) );
                            
                    }
                   $property_detail['map'] = array('label'=>$model->getAttributeLabel('geo_location'),'value'=>array('latitude'=>$model->location_latitude,'longitude'=>$model->location_longitude) );
                   $floor = $model->adFloorPlans;
                   $florr_array = array();
                   if(!empty($floor)){
                      foreach($floor as $k=>$v){  
                        $florr_array[] = array('image'=> $this->app->apps->getBaseUrl('uploads/floor_plan/'.$v->floor_file,true) ,'floor_title' =>$v->floor_title ) ;
                      } 
                   }
                    $property_detail['floor_plan'] = array('label'=>$model->getAttributeLabel('floor_plan'),'value'=> $florr_array );
                   
                   
                    $property_detail['amentites'] = array('label'=>$model->getAttributeLabel('amentites'),'value'=>$amentites);
                     $property_detail['user_details'] = array('label'=>$model->getAttributeLabel('user_details'),'value'=>array('title'=>$model->userName, 'user_id'=>$model->user_id, 'user_type'=>$model->user_type, 'user_number'=>$this->checkEmpty($model->user_number), 'user_address'=>$this->checkEmpty($model->user_address),'image' => $this->app->apps->getBaseUrl('uploads/images/'.$model->user_image,true) ));
                  
                    
                echo $this->generateOutPut('SUCCESS','1', '' ,$property_detail,'','Property Details');
			}
    
    }
    public function actionGetBlogCategories(){
	 
	     $category = ArticleCategory::model()->getBlogCategories('20');
	     if(empty($category)){
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
             
                if (strpos(@$imges['1'], 'frontend') !== false) {
                    $im = Yii::app()->apps->getBaseUrl(@$imges['1'],true);
                }
                else{
                    $im =@$imges['1'];
                }
              
				$list[] = array('id'=> $v->article_id, 'title' => $v->title, 'image' =>$im, 'short_description' =>$string , 'post_date' => $date ) ; 
			}
			echo $this->generateOutPut('SUCCESS','1', '' ,$list,'','List Of Blog');
		}
		else{
			echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());
		}
		exit; 
	 }
	 public function actionBlogDetail($id=null){
		 
	 
	    $model  = Article::model()->findByAttributes(array('article_id'=>$id));
		 
		if(empty($model))
		{
			  echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());exit; 
		}
		if(!empty($model)){
			 
				preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $model->content, $imges);			 
				$date = date('M d , Y h:i A',strtotime($model->date_added)) ; 
				$list = array('id'=> $model->article_id,'title' => $model->title, 'image' =>@$imges['1'], 'description' =>htmlspecialchars(strip_tags($model->content))  , 'post_date' => $date ) ; 
			 
				echo $this->generateOutPut('SUCCESS','1', '' ,$list,'','List Of Ads');
		}
		else{
			echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());
		}
		exit; 
	 }
	 public function actionMyAds($user_id=null,$status=null,$limit=10,$offset=0){
		$user_model =  ListingUsers::model()->findByPk($user_id);
		if(empty($user_model)){
			 echo $this->generateOutPut('FAILED','0','No User Found',array());exit; 
		}
		$formData = array('user_id'=>$user_id,'sta'=>$status); 
		$criteria =  PlaceAnAd::model()->findAds($formData,false,1);
		$criteria->limit = $limit ;
                $criteria->offset = $offset ; 
	    $field  = PlaceAnAd::model()->findAll($criteria);		 
		if(!empty($field)){	
				    $agent_list = array();
				    foreach($field as $k=>$v){
                	   $image = array();
                	   if(!empty($v->ad_images_g)){
                			$itemsI = explode(',',$v->ad_images_g);
                			if(!empty($itemsI)){
                				foreach($itemsI as $k=>$ad_img){									 
                			 	   $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$ad_img,true); 
                				} 
                			}
                		}
                		else{
                		      $image[] = Yii::app()->apps->getBaseUrl('uploads/images/'.$v->ad_image,true);
                		}
				       $agent_list[] = array(
				           'id'=>$v->id,
				           'title'=>$v->ad_title,
				           'short_description'=>$v->ShortDescription,
				           'section_name'=> $this->checkEmpty($v->SectionName)  ,
				           'category_name'=> $this->checkEmpty($v->category_name) , 
				           
				           'state_name'=>$this->checkEmpty($v->state_name) ,
				           'community_name' => $this->checkEmpty($v->community_name) ,
				           
				           'price_array'=>$v->PriceTitleArray  ,
				           'bedrooms'=>!empty($v->bedrooms) ? $v->BedroomTitle : '' ,
				           'bathrooms'=>!empty($v->bathrooms) ? $v->BathroomTitle : '',
				           'builtup_area'=>!empty($v->builtup_area) ? $v->BuiltUpAreaTitle : '',
				           
				           'image_array' => $image ,
				           'state_name'=>$this->checkEmpty($v->state_name) ,
				           'community_name' => $this->checkEmpty($v->community_name) ,
				           'date_added' =>  $v->date_added ,
				            )  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$agent_list,'','List Of Ads');
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Ads Found' ,array());
                }
		exit; 
	 }
	 
    public function actionLocations($query=null)
    {
        $request = Yii::app()->request;
      
        $criteria=new CDbCriteria;
        if(!empty($query)){
		$criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name,cn.slug as country_slug,t.slug,cm.community_id,cm.community_name';
		$criteria->join = 'INNER JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
		$criteria->join .= 'LEFT JOIN {{community}} cm ON cm.region_id  = t.state_id  ';
		$criteria->condition = 'cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
		$criteria->condition .= ' and  ( CASE WHEN community_name IS NOT NULL THEN  ( CONCAT(state_name, " ", country_name," ",community_name) like  :term  ) ELSE ( CONCAT(state_name, " ", country_name) like  :term  ) END  )  ' ;
		$criteria->order  = 'cm.community_name asc , t.state_name asc , cn.country_name asc ' ;
        $criteria->params[':term'] = '%'.$query.'%' ;
	    }
	    else{
                $criteria->select = 't.country_id,t.state_id,t.state_name,cn.country_name,cn.slug as country_slug,t.slug ';
                $criteria->join = 'INNER JOIN {{countries}} cn ON t.country_id  = cn.country_id  ';
                $criteria->condition = 'cn.show_on_listing="1" and case WHEN cn.enable_all_cities="1" THEN 1  WHEN t.enable_listing="1" THEN 1 ELSE 0 END   ';
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
					'master'      	 => $model->state_name  ,
					'sub'        	 => @$model->country_name  ,
					 
					);
					$loaded_state[$model->state_id] = $model->state_id;
				}
				
				$master = !empty($model->community_name) ? $model->community_name :  $model->state_name ;
				$sub    = !empty($model->community_name) ?  $model->state_name .','.$model->country_name :  $model->country_name ;
				
				$results['suggestions'][] = array(
					'country_id'    => $this->checkEmpty($model->country_id),
					'state_id'  	=> $this->checkEmpty($model->state_id),
					'community_id'  => $this->checkEmpty($model->community_id),
					'master'        => $master,
					'sub'           => $sub,
					 
				);
			}
		}
		else{
			$results['suggestions'] = array();
		}
        echo $this->generateOutPut('SUCCESS','1', '' ,$results,'','Location Api');
        exit; 
    }
    public function actionLoadArticle($slug=null)
    {
        $model = Article::model()->findByAttributes(array(
            'slug'      => $slug,
            'status'    => Article::STATUS_PUBLISHED
        ));
        
        if (empty($model)) {
          echo $this->generateOutPut('FAILED','0', 'No blogs  Found' ,array());exit; 
        }
        $list = array('id'=> $model->article_id,'title' => $model->title , 'description' =>htmlspecialchars(strip_tags($model->content))   ) ; 
		echo $this->generateOutPut('SUCCESS','1', '' ,$list,'','Content Detail');	
		exit; 
    }
      public function actionVideo_category_list()
     {
		$listCategory  = VideoCategory::model()->listData();
		$category = array();
		if($listCategory){
			foreach($listCategory as $k=>$v){
			    if(!empty($v->image)){
			    $icon  = Yii::app()->apps->getBaseUrl('uploads/default/'.$v->image,true) ;
				}else{
					 $icon  = ''; 
				}
				$category[] =  array('category_id'=>$v->category_id,'category_name'=>$v->name,'background_image'=>$icon);
			}
		}
		echo $this->generateOutPut('SUCCESS','1', '' ,$category);
	    Yii::app()->end();
    } 
    public function generate_id($link=null){
				$video_id = explode("?v=", $link); 
				if (empty($video_id[1]))
				$video_id = explode("/v/", $link); 
				$video_id = explode("&", $video_id[1]); 
				$video_id = $video_id[0];
				return $video_id ; 
	}
     public function actionLoad_video($category_id=null,$search_term=null,$offset=0,$limit='10')
     {
		$category = VideoCategory::model()->findByPk($category_id);
		if (empty($category)) {
			  		echo $this->generateOutPut('FAILED','0','The category  not exist.',array());exit;
		}
		$criteria=new CDbCriteria;

        $criteria->compare('title', $search_term , true);
        $criteria->compare('status', 'Published');
        if(!empty($category_id)){
			$criteria->distinct = 't.category_id' ;
			$criteria->join = ' INNER JOIN {{video_to_category}} vc  on  vc.article_id = t.article_id and vc.category_id = :category_id ' ;
			$criteria->params[':category_id'] = $category_id ; 
		}
		$criteria->order = ' t.article_id desc ';
		$criteria->limit =  $limit; 
        $criteria->offset = $offset; 
		$video_list = Video::model()->findAll($criteria);
		if(!empty($video_list)){	
				    $detail = array();
				    foreach($video_list as $k=>$v){
						$y_id = $this->generate_id($v->content);
				       $detail[] = array( 'video_id'=>$v->article_id,'title'=>$v->title,'yotube_link'=>$v->content ,'thumb_image'=>'https://img.youtube.com/vi/'.$y_id.'/0.jpg' )  ;
				    }
				   
		            echo $this->generateOutPut('SUCCESS','1', '' ,$detail ,array(), $category->name);
                }
                else{
                    echo $this->generateOutPut('FAILED','0', 'No Result Found' ,array(), $category->name);
                }
	             Yii::app()->end();
	    Yii::app()->end();
    } 
    public function actionVideo_detail($category_id=null,$video_id=null)
     {
		$category = VideoCategory::model()->findByPk($category_id);
		if (empty($category)) {
			  		echo $this->generateOutPut('FAILED','0','The category  not exist.',array());exit;
		}
		
		if (empty($video_id)) {
			  		echo $this->generateOutPut('FAILED','0','The video id cannot be blank.',array());exit;
		}
		$criteria=new CDbCriteria;
        $criteria->compare('t.article_id', $video_id);
        $criteria->compare('status', 'Published');
        if(!empty($category_id)){
			$criteria->distinct = 't.category_id' ;
			$criteria->join = ' INNER JOIN {{video_to_category}} vc  on  vc.article_id = t.article_id and vc.category_id = :category_id ' ;
			$criteria->params[':category_id'] = $category_id ; 
		}
		$criteria->order = ' t.article_id desc ';
 
 
 
 
		$video_list = Video::model()->find($criteria);
		if(!empty($video_list)){	
			
						$criteria2=new CDbCriteria;
						$criteria2->select= 'min(t.article_id) as article_id';
						$criteria2->compare('status', 'Published');
						$criteria2->condition .= ' and t.article_id > :selected  ' ;
						$criteria2->params[':selected'] = $video_list->article_id; 
						if(!empty($category_id)){
						$criteria2->distinct = 't.category_id' ;
						$criteria2->join = ' INNER JOIN {{video_to_category}} vc  on  vc.article_id = t.article_id and vc.category_id = :category_id ' ;
						$criteria2->params[':category_id'] = $category_id ; 
						}
						$criteria2->order = ' t.article_id desc ';
						$next = Video::model()->find($criteria2);
						$next_id = !empty($next) ? $this->checkEmpty($next->article_id) : ''; 
						 
		
						$criteria3=new CDbCriteria;
						$criteria3->select= 'max(t.article_id) as article_id';
						$criteria3->compare('status', 'Published');
						$criteria3->condition .= ' and t.article_id < :selected  ' ;
						$criteria3->params[':selected'] = $video_list->article_id; 
						if(!empty($category_id)){
						$criteria3->distinct = 't.category_id' ;
						$criteria3->join = ' INNER JOIN {{video_to_category}} vc  on  vc.article_id = t.article_id and vc.category_id = :category_id ' ;
						$criteria3->params[':category_id'] = $category_id ; 
						}
						$criteria3->order = ' t.article_id desc ';
						$prev = Video::model()->find($criteria3);
						$previous_id = !empty($prev) ? $this->checkEmpty($prev->article_id) : ''; 
						 
				     	$y_id = $this->generate_id($video_list->content);
				        $detail  = array( 'video_id'=>$video_list->article_id,'title'=>$video_list->title,'yotube_link'=>$video_list->content ,'thumb_image'=>'https://img.youtube.com/vi/'.$y_id.'/0.jpg' ,'previous_id'=>$previous_id,'next_id'=>$next_id)  ;
						echo $this->generateOutPut('SUCCESS','1', '' ,$detail ,array(),'',$category->name);
		}
		else{
			echo $this->generateOutPut('FAILED','0', 'No Video  Found' ,array(),'',$category->name);
		}
	    Yii::app()->end();
    } 
}
