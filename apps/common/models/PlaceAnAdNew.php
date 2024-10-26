<?php

/**
 * This is the model class for table "mw_place_an_ad".
 *
 * The followings are the available columns in table 'mw_place_an_ad':a
 * @property integer $id
 * @property integer $section_id
 * @property integer $category_id
 * @property integer $sub_category_id
 * @property string $ad_title
 * @property string $ad_description
 * @property integer $engine_size
 * @property string $killometer
 * @property integer $model
 * @property string $price
 * @property string $year
 * @property integer $city
 * @property integer $neighbourhood
 * @property string $mobile_number
 * @property integer $employment_type
 * @property string $compensation
 * @property integer $education_level
 * @property integer $experience_level
 * @property string $skills
 * @property string $area
 * @property integer $bathrooms
 * @property integer $bedrooms
 * @property integer $user_id
 * @property string $added_date
 * @property string $modified_date
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 * @property string $slug
 */
 
class PlaceAnAdNew extends PlaceAnAd
{ 
	
		 
	 public function getFetauredOrder(){
	    /*and (TIMESTAMPDIFF(HOUR,NOW(), f_e_d ) > 0)*/
		 return '  t.cron_featured = "Y" desc ';
	 }
	 public function getExpityConditionFronEnd(){
	   return  ' and t.cron_expiry ="1" '; 
    }

	 public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	public function findAds($formData=array(),$count_future=false,$returnCriteria=false,$calculate=false,$user_id=false){
	    $criteria = new CDbCriteria;
		$criteria->select = 't.ad_title, t.nested_sub_category, t.sub_category_id, t.RefNo, t.project_status, t.verified, t.featured, t.lease_status, t.income, t.roi, t.hot, t.slug_en, t.slug_ar, t.user_id as user_id, t.property_status, t.id, t.slug, t.section_id, t.category_id, t.state, t.listing_type, t.sub_category_id, t.location_latitude, t.location_longitude, from_price_unit, to_price_unit, area_unit, rent_paid, price, p_o_r, bathrooms, bedrooms, t.builtup_area, t.view_360, t.view_video, t.view_floor, t.cron_featured as featured2';
		$criteria->compare('t.isTrash', "0");
		$criteria->select .= ', t.cron_images as ad_images_g, t.cron_simage as ad_image2';
 	    if(isset($formData['preleased']) and !empty($formData['preleased'])){
			 $criteria->compare('t.property_status','1');
		}else{
		    if(!defined('SHOW_ALL_PROP')){
		     //$criteria->compare('t.property_status!','1');
		    }
		}
       
        if(isset($formData['sta']) and !empty($formData['sta'])){
			$criteria->compare('t.status',$formData['sta']);
		}else{
        	$criteria->compare('t.status','A');
		}
        if(!empty($user_id)){
					$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :thisusr or   t.user_id = :thisusr )   ELSE     t.user_id = :thisusr  END '; 
			$criteria->params[':thisusr'] = (int) $user_id;
	
			 
		}
		// $criteria->condition .= ' t.status = "A" and t.isTrash = "0" '; 
		
        $criteria->distinct =  't.id' ;
        $criteria->select .= ',  (t.builtup_area*(1/au.value))   as converted_unit ,au.master_name as atitle'; 
        
        $lstype_join = false;
        $cat_join = false;
        $states_join = false;
        if((isset($formData['word']) and !empty($formData['word'])) OR (!empty($formData['type_of']) and   @$formData['sec'] != 'new-development') OR (!empty($formData['category']) and   @$formData['sec'] != 'new-development')){
			$lstype_join = true;
			$criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
			$cat_join = true;
			$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
			$states_join = true;
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
			 
		    	$criteria->join  .= ' left join {{main_region}} mreg ON mreg.region_id = st.region_id ';
		}
		else if(isset($formData['state']) and !empty($formData['state'])){
		     
		    	$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		    	$criteria->join  .= ' left join {{main_region}} mreg ON mreg.region_id = st.region_id ';
		    	$criteria->select   .= ',st.slug as state_slug';
		}
		else if(isset($formData['more']) and !empty($formData['more'])){
		    	$states_join = true;
		    	$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		    	$criteria->join  .= ' left join {{main_region}} mreg ON mreg.region_id = st.region_id ';
		}
        else if(isset($formData['reg_id']) and !empty($formData['reg_id'])){
		    	$states_join = true;
		    	$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		    	$criteria->join  .= ' left join {{main_region}} mreg ON mreg.region_id = st.region_id ';
		    	$criteria->condition .= ' and st.region_id  = :region_id ' ; 
		    	$criteria->params[':region_id'] = $formData['reg_id'];
		}
        
		
		 
		$criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr ON usr.user_id = t.user_id';
		$criteria->join .= ' LEFT JOIN {{user}} u ON u.user_id = t.user_id'; // Joining the `user` table
	
		// Select user information conditionally based on which table has the user data
		$criteria->select .= ' , 
			CASE 
				WHEN usr.user_id IS NOT NULL THEN usr.full_number 
				ELSE u.phone_number 
			END as mobile_number, 
			CASE 
				WHEN usr.user_id IS NOT NULL THEN usr.first_name 
				ELSE u.first_name 
			END as first_name, 
			CASE 
				WHEN usr.user_id IS NOT NULL THEN usr.last_name 
				ELSE u.last_name 
			END as last_name, 
			CASE 
				WHEN usr.user_id IS NOT NULL THEN usr.image 
				ELSE u.profile_image 
			END as user_image';
			
		if(!defined('BUSINESS')  and $formData['sec'] != 'new-development'){
		    //	$criteria->condition .= ' and t.listing_type != "181" ' ; 
		}
		
		$criteria->select .= ',t.cron_arabic as ad_title2 ';
		
		if(isset($formData['furnished'])){
		    if (!empty($formData['furnished'])){
		        switch($formData['furnished']){
                    case 'furnished':
                    $criteria->condition .= ' and ( t.furnished="Y" OR t.furnished="") ';
                    break;
                    case 'unfurnished':
    	            $criteria->condition .= ' and  ( t.furnished="N")';
                    break;
    		    }
		    }else {
		        $criteria->condition .= ' and  ( t.furnished="N" OR t.furnished="Y" OR t.furnished="")';
		    }
		}
		      
			 
		
		if(Yii::App()->isAppName('frontend')){
		if(Yii::app()->user->getId() and !isset($formData['logged_in'])  ){
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		}
		else{
		      $cookieName = 'USERFAV'.COUNTRY_ID;
			  if((isset(Yii::app()->request->cookies[$cookieName])   )){
									$cook =  Yii::app()->request->cookies[$cookieName]->value;
									if(!empty($cook) and is_array($cook)){
											
													$userStr = implode("', '", $cook);
													$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav " ;
											 }
			 }
		}
		}
		if(isset($formData['user_fav_only'])){
			if(Yii::app()->user->getId() and !isset($formData['logged_in'])  ){
			 
			$criteria->condition  .= '  and fav.ad_id is NOT NULL ';
			}else{
			  $dataC = array();   
			  $cookieName = 'USERFAV'.COUNTRY_ID;
			  if((isset(Yii::app()->request->cookies[$cookieName])   )){
									$dataC =  Yii::app()->request->cookies[$cookieName]->value;
								
			 }
			 	 
			$dataC	= (array) $dataC ; 							
			$userStr = implode("', '", $dataC);
			$criteria->condition .= " and  CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END   " ;
											  
		}
		}
		if(isset($formData['last_viewed'])){
			$last_viewed = array(); $dataC = array();  
			if((isset(Yii::app()->request->cookies['my_views_n'.COUNTRY_ID])   )){
				 $dataC =  Yii::app()->request->cookies['my_views_n'.COUNTRY_ID]->value;
			}
			$dataC	= (array) $dataC ; 							
			$userStr = implode("', '", $dataC);
			$criteria->condition .= " and  CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END   " ;
		}
		if(isset($formData['lease_status'])){
		          $criteria->condition .= " and t.lease_status = :lease_status  ";  
		          $criteria->params[':lease_status'] = $formData['lease_status']; 
		}
		if(isset($formData['pstatus'])){
		    switch($formData['pstatus']){
		        case 'ready' : 
		         $criteria->condition .= " and t.project_status = '2' "; 
		        break;
		         case 'off-plan' : 
		         $criteria->condition .= " and t.project_status = '1' "; 
		        break;
		    }
		}
		if(defined('COUNTRY_ID')){ 
			$criteria->condition .= ' and t.country=:country1 ';
			$criteria->params[':country1'] = COUNTRY_ID;
		}
		if(isset($formData['user_id']) and !empty($formData['user_id'])){
			  
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :user_id or   t.user_id = :user_id )   ELSE     t.user_id = :user_id  END '; 
			$criteria->params[':user_id'] = (int)  $formData['user_id'];
			if(isset($formData['dealer'])){ unset($formData['dealer']); }
		}
		
		if(isset($formData['dealer']) and !empty($formData['dealer'])){
			
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (p_usr1.slug = :dealer or    usr.slug = :dealer )   ELSE     usr.slug = :dealer  END '; 
			$criteria->params[':dealer'] =  $formData['dealer'];
		}
		if(isset($formData['floor']) and !empty($formData['floor'])){
				$criteria->join  .=   ' LEFT JOIN {{ad_floor_plan}} ad_fp on ad_fp.ad_id = t.id ';
				$criteria->condition .= ' and ad_fp.ad_id is NOT NULL   '; 
		}
		if(isset($formData['video']) and !empty($formData['video'])){
				$criteria->join  .=   ' LEFT JOIN {{video_urs}} ad_vd on ad_vd.ad_id = t.id ';
				$criteria->condition .= ' and ad_vd.ad_id is NOT NULL   '; 
		}
		if(isset($formData['_sec_id']) and !empty($formData['_sec_id'])){
			$criteria->condition .= ' and t.section_id =:new_section_id ';
			$criteria->params[':new_section_id'] = $formData['_sec_id'];
		}
		if(!isset($formData['_sec_id']) and !isset($formData['sec'])){
		   if(!defined('NO_SECTION')){
		    $criteria->condition .= ' and t.section_id != 3 ';
		   }
		}
		if(!isset($formData['lease_status']) and !empty($formData['lease_status'])){
		    $criteria->condition .= ' and t.lease_status  = :lease_status ';$criteria->params[':lease_status'] = $formData['lease_status']; 
		}
		if(isset($formData['project_title']) and !empty($formData['project_title'])){
			$criteria->condition .= ' and t.ad_title =:ad_title2 ';
			$criteria->params[':ad_title2'] = $formData['project_title'];
		}
		if(isset($formData['_state_id']) and !empty($formData['_state_id'])){
			$criteria->condition .= ' and t.state =:_state_id ';
			$criteria->params[':_state_id'] = $formData['_state_id'];
		}
		if(isset($formData['state']) and !empty($formData['state'])){
		    if(isset($formData['area']) and!empty($formData['area'])){
				$list_stat = array_filter((array)explode(':',$formData['area']));
				$list_stat[]= $formData['state']; 
			    $inquery = '(';$inquery2 =''; 
			    foreach( $list_stat as $itm){
			        $inquery2 .= '"'.$itm.'",';
			    }
			    if($inquery2){$inquery2 = rtrim($inquery2);}
			    if($inquery2 != ""){
			        $inquery .=rtrim($inquery2,',');
			        $inquery.= ')';
			        $criteria->condition .= ' and ( st.slug in '.$inquery.' or mreg.slug in '.$inquery.' )';
				
			    } 
				 
			}
		   else if(isset($formData['more']) and!empty($formData['more'])){
		        		$list_stat = (array)explode('|',$formData['more']);
			
			    $inquery = '(';$inquery2 =''; 
			    foreach( $list_stat as $itm){
			        $inquery2 .= '"'.$itm.'",';
			    }
			    if($inquery2){$inquery2 = rtrim($inquery2);}
			    if($inquery2 != ""){
			        $inquery .=rtrim($inquery2,',');
			        $inquery.= ')';
			        $criteria->condition .= ' and ( st.slug in '.$inquery.' or mreg.slug in '.$inquery.' )';
				
			    } 
				 
			}
			else{
			    
		        	$criteria->condition .= '  and (st.slug =:state or mreg.slug =:state )  ';
		        	$criteria->params[':state'] =   $formData['state'];
			}
		}
	
		if(isset($formData['country']) and !empty($formData['country'])){
		    /*
			$criteria->condition .= ' and t.country=:country ';
			$criteria->params[':country'] = $formData['country'];
			*/
		}
		if(isset($formData['por']) and !empty($formData['por'])){
			$criteria->condition .= ' and t.p_o_r=:por ';
			$criteria->params[':por'] = $formData['por'];
		}		 
		else if(isset($formData['country']) and !empty($formData['country'])){
		    /*
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country ';
			$criteria->condition .= ' and cn.slug=:country ';$criteria->params[':country'] = $formData['country'];
			*/
		}
		if(isset($formData['section_id']) and !empty($formData['section_id'])){
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->condition .= ' and sec.slug=:section_id ';$criteria->params[':section_id'] = $formData['section_id'];
		}
		else if(isset($formData['sec']) and !empty($formData['sec'])){
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->condition .= ' and sec.slug=:sec ';$criteria->params[':sec'] = $formData['sec'];
		}
		if(isset($formData['minPrice']) and !empty($formData['minPrice'])){
			 
			$criteria->condition .= ' and t.price>=:minPrice ';$criteria->params[':minPrice'] = $formData['minPrice'];
		}
		if(isset($formData['maxPrice']) and !empty($formData['maxPrice'])){
			 
			$criteria->condition .= ' and t.price<=:maxPrice ';$criteria->params[':maxPrice'] = $formData['maxPrice'];
		}
			if(isset($formData['minRoi']) and !empty($formData['minRoi'])){
			 
			$criteria->condition .= ' and t.roi>=:minRoi ';$criteria->params[':minRoi'] = $formData['minRoi'];
		}
		if(isset($formData['maxRoi']) and !empty($formData['maxRoi'])){
			 
			$criteria->condition .= ' and t.roi<=:maxRoi ';$criteria->params[':maxRoi'] = $formData['maxRoi'];
		}
			if(isset($formData['minIncome']) and !empty($formData['minIncome'])){
			 
			$criteria->condition .= ' and t.income>=:minIncome ';$criteria->params[':minIncome'] = $formData['minIncome'];
		}
		if(isset($formData['maxIncome']) and !empty($formData['maxIncome'])){
			 
			$criteria->condition .= ' and t.income<=:maxIncome ';$criteria->params[':maxIncome'] = $formData['maxIncome'];
		}
		if(isset($formData['locality']) and !empty($formData['locality'])){
			 
	    	$criteria->condition .= ' and   ct.slug = :locality ';
			$criteria->params[':locality'] = $formData['locality'];
		}
			if(isset($formData['loc']) and !empty($formData['loc'])){
			 
			$criteria->condition .= ' and lower(t.area_location) like :area_location1 ';$criteria->params[':area_location1'] = '%'.strtolower($formData['loc']).'%';
		}
		
		if(isset($formData['bedrooms']) and !empty($formData['bedrooms'])){
		    if($formData['bedrooms']=='5'){ 
		        $criteria->condition .= ' and t.bedrooms >=:bedrooms and  t.bedrooms != "15" '; 
		        }
		        else{
		            $criteria->condition .= ' and t.bedrooms =:bedrooms '; 
		        }
		    	$criteria->params[':bedrooms'] = $formData['bedrooms'];
		}
		if(isset($formData['rent_paid']) and !empty($formData['rent_paid'])){
			$criteria->condition .= ' and t.rent_paid =:rent_paid ';$criteria->params[':rent_paid'] = $formData['rent_paid'];
		}
		if(isset($formData['category'])){
						$criteria->condition .= ' and lstype.slug =:category1 ';$criteria->params[':category1'] = $formData['category'] ;
						  
					}
		if(isset($formData['type_of']) and !empty(array_filter((array)$formData['type_of'])) and is_array($formData['type_of'])){
			if(isset($formData['sec']) and $formData['sec']=='new-development'){
							/*New Development Multiple*/
							$criteria->join .= ' LEFT JOIN {{place_an_ad_categories}} ad_cat on ad_cat.ad_id = t.id   '; 
		
							if(sizeOf($formData['type_of'])=='1'){
							$criteria->condition .= ' and ad_cat.category_id =:type_of ';$criteria->params[':type_of'] = @$formData['type_of'][0];
							}else{
							   $cam =  Category::model()->findByAttributes(array('slug'=>$formData['type_of']));
							   if($cam){
						        	$criteria->addInCondition('ad_cat.category_id', $cam->category_id );
							   }
						    	}
			}
			else{
			if(sizeOf($formData['type_of'])=='1'){
			
			$criteria->condition .= ' and t.category_id =:type_of ';$criteria->params[':type_of'] = @$formData['type_of'][0];
			}else{
				$criteria->addInCondition('t.category_id', $formData['type_of'] );
			}
			}
		}
		else if(!empty($formData['type_of']) and   @$formData['sec'] != 'new-development'){
		    
		  
			 if(strpos($formData['type_of'], '_') !== false){
				$str = explode('_',$formData['type_of']);
					if(isset($str['1'])){
						$criteria->condition .= ' and cat.slug =:type_of ';$criteria->params[':type_of'] = $str['1'] ;
						 $criteria->condition .= ' and lstype.slug =:lstype ';$criteria->params[':lstype'] = $str['0'] ;
					}
			 }
			 else{
				 $criteria->condition .= ' and (lstype.slug =:lstype or  cat.slug  =:lstype ) ';$criteria->params[':lstype'] = $formData['type_of'];
				//$criteria->condition .= ' and cat.slug =:type_of ';$criteria->params[':type_of'] = @$formData['type_of'] ;
			 }
		}
		else if(!empty($formData['type_of']) and   @$formData['sec'] =='new-development'){
		    $criteria->join .= ' LEFT JOIN {{place_an_ad_categories}} ad_cat on ad_cat.ad_id = t.id   '; 
			$cam =   Category::model()->findByAttributes(array('slug'=>$formData['type_of']));
							   if($cam){
							       	$criteria->condition .= ' and ad_cat.category_id =:type_of ';
						        	 $criteria->params[':type_of'] = $cam->category_id ;
							   }
		}
		
		if(isset($formData['locations']) and !empty(array_filter((array)$formData['locations'])) and is_array($formData['locations'])){
			if(sizeOf($formData['locations'])=='1'){
			$criteria->condition .= ' and t.city =:locations ';$criteria->params[':locations'] = @$formData['locations'][0];
			}else{
				$criteria->addInCondition('t.city', $formData['locations'] );
			}
		}
		if(isset($formData['keyword']) and !empty($formData['keyword'])){
			$criteria->condition .= ' and ( t.ad_title like :keyword or t.ad_description like :keyword )   ';$criteria->params[':keyword'] = '%'.$formData['keyword'].'%';
		}
		if(isset($formData['mkeyword']) and !empty($formData['mkeyword'])){
			$criteria->condition .= ' and ( t.ad_title like :mkeyword or t.ad_description like :mkeyword or ct.city_name like :mkeyword  or usr.company_name like :mkeyword   )   ';$criteria->params[':mkeyword'] = '%'.$formData['mkeyword'].'%';
		}
		 
		if(isset($formData['lat']) and !empty($formData['lat'])  and isset($formData['lng']) and !empty($formData['lng'])    ){
		 
			
				$criteria->condition .= ' and t.location_latitude is not null  and (111.045 * DEGREES(ACOS(COS(RADIANS(:lat))
				* COS(RADIANS(t.location_latitude))
				* COS(RADIANS(t.location_longitude) - RADIANS(:lng))
				+ SIN(RADIANS(:lat))
				* SIN(RADIANS(t.location_latitude))))) < 15  ';
				 $criteria->params[':lat']  =  $formData['lat'] ;
					$criteria->params[':lng']  =  $formData['lng'] ;
		}
		else if(isset($formData['word']) and !empty($formData['word'])){
			 
					$word = $formData['word'];  
					$criteria->condition .= ' and ( ad_title like :word or ad_description like :word   ';
				
				  if(defined('LANGUAGE') and LANGUAGE != 'en' ){
	 
				 		$criteria->condition .=  '  or (CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name END)  like :word  or  (CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END) like :word  or  (CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END)  like :word  '; 
		 
					}
				else{
					$criteria->condition .=  '  or  state_name like :word  or  cat.category_name like :word  or  lstype.category_name  like :word  '; 
				}
					$criteria->condition .=  ' ) '; 
					$criteria->params[':word'] = '%'.$formData['word'].'%';
					
			 
		}
		
		if(isset($formData['term']) and !empty($formData['term'])){
			$criteria->condition .= ' and ( t.ad_title like :term or t.ad_description like :term and t.section_id in("1","2")  )   ';$criteria->params[':term'] = '%'.$formData['term'].'%';
		}
		if(empty($returnCriteria)  and isset($formData['a']) and !empty($formData['a']) and isset($formData['b']) and !empty($formData['b']) and isset($formData['c']) and !empty($formData['c']) and isset($formData['d']) and !empty($formData['d'])   ){
            $condition1 = $formData['a'] < $formData['c'] ? "t.location_latitude > :a AND t.location_latitude < :c" : "(t.location_latitude > :a OR t.location_latitude < :c)";
            $condition2 = $formData['b'] < $formData['d'] ? "t.location_longitude > :b AND t.location_longitude < :d" : "(t.location_longitude > :d OR t.location_longitude < :b)";
            $q = " and ( $condition1 ) AND ( $condition2 )";$criteria->condition .=  $q ; 
			//$criteria->condition .=  ' and   t.location_latitude > :a AND  t.location_latitude  < :c AND  t.location_longitude > :b AND  t.location_longitude < :d ' ; 
			//$criteria->condition .=  ' and   (CASE WHEN :a < :c         THEN  t.location_latitude BETWEEN :a AND :c         ELSE  t.location_latitude BETWEEN :c AND :a END) AND (CASE WHEN :b < :d         THEN  t.location_longitude BETWEEN :b AND :d         ELSE  t.location_longitude BETWEEN :d AND :b END) ' ; 
			$criteria->params[':a'] =$formData['a'] ;		 $criteria->params[':b'] = $formData['b'] ;	 $criteria->params[':c'] = $formData['c'] ; $criteria->params[':d'] =  $formData['d'] ; 
		 }
		if(isset($formData['listing_type']) and !empty($formData['listing_type']) and $formData['listing_type'] != 'B'){
			$criteria->condition .= ' and t.listing_type =:listing_type ';$criteria->params[':listing_type'] = $formData['listing_type'];
		}
		if(isset($formData['bathrooms']) and !empty($formData['bathrooms'])){
		    if($formData['bathrooms']=='5'){
			    $criteria->condition .= ' and t.bathrooms >=:bathrooms ';
		    }else{
		        $criteria->condition .= ' and t.bathrooms =:bathrooms '; 
		    }
			$criteria->params[':bathrooms'] = $formData['bathrooms'];
		}
		$having = '';
	 
		if(isset($formData['minSqft']) and !empty($formData['minSqft'])){
		    if(defined('AREAVALUE')){ $valUnit = $formData['minSqft'] * ( 1/AREAVALUE ) ;     }else{ $valUnit = $formData['minSqft']  ; }
			//	$having .= ' and  converted_unit   >=:minSqft ';$criteria->params[':minSqft'] = (int) $valUnit;
			$criteria->condition .=  ' and  (t.builtup_area*(1/au.value))   >=:minSqft ';$criteria->params[':minSqft'] = (int) $valUnit;
			 
		}
		if(isset($formData['maxSqft']) and !empty($formData['maxSqft'])){
		      
		    if(defined('AREAVALUE')){ $valUnit = $formData['maxSqft'] * ( 1/AREAVALUE ) ;     }else{ $valUnit = $formData['maxSqft']  ; }
			//	$having .= ' and  converted_unit <=:maxSqft ';$criteria->params[':maxSqft'] =  (int) $valUnit;
			$criteria->condition .=  ' and  (t.builtup_area*(1/au.value)) <=:maxSqft ';$criteria->params[':maxSqft'] =  (int) $valUnit;
		}
		if(!empty($having)) {   $criteria->having = '1 '. $having ;    }
	
		if(isset($formData['community']) and !empty($formData['community'])){
			$criteria->condition .= ' and com.community_id  =:community ';$criteria->params[':community'] = $formData['community'];
		}
		
		
     
		
		
		   if(defined('LANGUAGE')){
			$langaugae = LANGUAGE;
			if(!empty($langaugae) and  $langaugae != 'en'){
				
				if(!empty($states_join)){
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';
				}
                if(!empty($cat_join)){
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';
				}
				if(!empty($lstype_join)){
					$criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
					$criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';
				}
				if(!empty($states_join) or !empty($cat_join) or !empty($lstype_join)){
				$criteria->distinct   = 't.id';
				$criteria->params[':lan'] = $langaugae;
				}
					
			}
			
			 
		}
   
		
		 		
	    /*empiryCondition*/
	    if((isset($formData['sec']) and $formData['sec']=='new-development') or (isset($formData['_sec_id']) and $formData['_sec_id']=='3')){
		}
		else{
		 $criteria->condition .=  $this->getExpityConditionFronEnd();
		}
		 
		
	 
        $order_val = '';
        if(isset($formData['sort'])  and !empty($formData['sort'])){
			 $order_val = $formData['sort'];
		}
 
		switch($order_val){
			
			case 'best-asc' :
			//$order  = $this->getFetauredOrder().' ,t.verified="1" desc,-t.priority desc , t.last_updated desc ';
			 $order  = '(CASE WHEN t.user_updated IS NOT NULL THEN  t.user_updated ELSE t.date_added END)  desc';
			$order  = 't.featured="Y" desc,t.hot="1" desc, t.id desc';
			break;
			case 'date-desc' :
			$order  = 't.id desc';
			break;
			case 'date-asc':
			    $order  = 't.id asc';
			break;
			case 'price-asc' :
			$order  = 't.price  asc';
			break;
			case 'price-desc' :
			$order  = 't.price  desc';
			break;
			case 'baths-desc' :
			$order  = 't.bathrooms  desc';
			break;
			case 'beds-desc' :
			$order  = 't.bedrooms  desc';
			break;
			case 'beds-asc' :
			$order  = 't.bedrooms  asc';
			break;
			case 'sqft-desc' :
			$order  = 't.builtup_area  desc';
			break;
			case 'sqft-asc' :
			$order  = 't.builtup_area  asc';
			break;
			case 'int-desc' :
			$order  = 't.interior_size   desc';
			break;
			case 'featured' :
			$order  = $this->getFetauredOrder().',-t.priority desc , t.last_updated desc ';
			break;
			case 'verified' :
			$order  = 't.verified="1" desc,-t.priority desc , t.last_updated desc ';
			break;
			case 'title-asc' :
			$order  = 't.ad_title asc ';
			break;
			default :
			//$order  = $this->getFetauredOrder().' ,t.verified="1" desc ,-t.priority desc , t.last_updated desc ';
				 $order  = '(CASE WHEN t.user_updated IS NOT NULL THEN  t.user_updated ELSE t.date_added END)  desc';
				  $order  = 't.featured="Y" desc,t.id desc';
			break;
		}

	    $criteria->order  =   $order;
	     if(isset($formData['latitude']) and !empty($formData['latitude'])  and isset($formData['longitude']) and !empty($formData['longitude'])    ){
				$criteria->order  .=  ' , (111.045 * DEGREES(ACOS(COS(RADIANS(:lat))
				* COS(RADIANS(t.location_latitude))
				* COS(RADIANS(t.location_longitude) - RADIANS(:lng))
				+ SIN(RADIANS(:lat))
				* SIN(RADIANS(t.location_latitude))))) asc ';
		}
	    	  
		$total = false ; 
		if($returnCriteria){
			return $criteria;
		}
		
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');
		/* SaFE neighbours */
		if(isset($formData['sort'])  and  $formData['sort'] == 'custom'){
			if( isset($formData['s_limit'])){
				$criteria->limit  =  $formData['s_limit'] ; 
			}else{
			$criteria->limit  =  5 ; 
			}
			$criteria->order  =   $formData['custom_order'] ;
		}
		if($calculate and $criteria->offset==0){
			$total = self::model()->count($criteria);
		}
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			//$criteria->select = 't.id'; 
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count,'total'=>$total);
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
	 
	}
	function generateImageWaterMark($image=null,$width=null,$height=null,$opacity=60,$water_size=10){
		  
 return Yii::app()->apps->getBaseUrl('uploads/files/'.$image);
	
	   if(empty($width) and empty($height)){
		   return Yii::app()->apps->getBaseUrl('uploads/files/'.$image);
		return   Yii::app()->easyImage->thumbSrcOf(
		Yii::getpathOfAlias('root')  .'/uploads/files/'.$image,		 
		array(
	 //	'watermark' => array('watermark' =>'/watermark/'.$marker , 'opacity' => $opacity ), 
		'sharpen' =>  0,  'background' => '#FFF', 'type' => 'jpg',  'quality' => 80
		) 
		);
	   }
	   return Yii::app()->apps->getBaseUrl('uploads/files/'.$image);
		return   Yii::app()->easyImage->thumbSrcOf(
		Yii::getpathOfAlias('root')  .'/uploads/files/'.$image,		 
		array(
                'resize' => array('width' => '378', "master"=>EasyImage::RESIZE_AUTO),
                //'watermark' => array('watermark' =>'/watermark/'.$marker , 'opacity' => $opacity ), 
               // 'scaleAndCrop' => array('width' => $width, 'height' => $height),
               // 'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),															
                
                'sharpen' => 0,  'background' => '#FFF', 'type' => 'jpg',  'quality' => 95
		) 
		);
			
   }
	
	
	public function cronJobs(){
		$criteria			 	 =	new CDbCriteria; 
		$criteria->condition = 't.section_id in ("1","2","3") and t.isTrash="0" and t.status="A" ';
		$criteria->select = 't.id,'.$this->isLiveAd2().','.$this->FetauredQuery.'(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END order by id asc)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and      img.isTrash="0" and   img.status="A"   )   as ad_images_g ,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';
	///	$criteria->condition .= ' and CASE WHEN t.cron_updated IS NULL THEN  "1"  ELSE  TIMESTAMPDIFF(MINUTE,t.cron_updated,NOW()) > 45 END     ';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete" and  ( plan.max_listing_per_day = "0"  or  plan.max_listing_per_day   > 0  ) and ( CASE WHEN plan.validity = "0" THEN 1 ELSE    DATEDIFF( NOW(), plan.date_start  ) <=  plan.validity END) and plan.date_start <= CURDATE()   ';
	    $criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->select .= ',tdataad.message as ad_title2 ';
		$criteria->order='t.cron_updated IS NULL,t.last_updated asc';
		$criteria->group = 't.id'; 
		$criteria->params[':lan2'] = 'ar';
		
	 	$criteria->limit = 1000;
		return  PlaceAnAd::model()->findAll($criteria);
	} 
	
		public function cronJobstest(){
		$criteria			 	 =	new CDbCriteria; 
		$criteria->condition = 't.section_id in ("1","2","3") and t.isTrash="0" and t.status="A" ';
		$criteria->select = 't.id,'.$this->isLiveAd2().','.$this->FetauredQuery.'(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END order by id asc)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and      img.isTrash="0" and   img.status="A"   )   as ad_images_g ,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';
		$criteria->condition .= ' and CASE WHEN t.cron_updated IS NULL THEN  "1"  ELSE  TIMESTAMPDIFF(MINUTE,t.cron_updated,NOW()) > 15 END     ';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete" and  ( plan.max_listing_per_day = "0"  or  plan.max_listing_per_day   > 0  ) and ( CASE WHEN plan.validity = "0" THEN 1 ELSE    DATEDIFF( NOW(), plan.date_start  ) <=  plan.validity END) and plan.date_start <= CURDATE()   ';
	    $criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->select .= ',tdataad.message as ad_title2 ';
		$criteria->order='t.cron_updated IS NULL,t.last_updated asc';
		$criteria->group = 't.id'; 
		$criteria->params[':lan2'] = 'ar';
		
		$criteria->limit = 50;
		return  PlaceAnAd::model()->findAll($criteria);
	} 
	
	 	 public function fetchCounter($sect=null,$country){
		  
            $adModel = new PlaceAnAdNew();
            $adModelCriteria =	$adModel->findAds(array() ,false,true);
            $condition = $adModelCriteria->condition;
            
            $new_homesCritieria         	 =	$adModelCriteria;
            $new_homesCritieria->condition  .= ' and t.section_id = :scte and t.country = :cntt';
            $new_homesCritieria->params[':cntt'] = $country;
            $new_homesCritieria->params[':scte'] = $sect;
            return  $adModel->count($new_homesCritieria);
             
	}
	
		public function cronJobs2(){
		$criteria			 	 =	new CDbCriteria; 
		$criteria->condition = 't.section_id in ("1","2","3") and t.isTrash="0" and t.status="A" and t.id="39730"';
		$criteria->select = 'distinct t.id,'.$this->isLiveAd2().','.$this->FetauredQuery.'(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END order by id asc)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and      img.isTrash="0" and   img.status="A"   )   as ad_images_g ,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';
		//$criteria->condition .= ' and CASE WHEN t.cron_updated IS NULL THEN  "1"  ELSE  TIMESTAMPDIFF(MINUTE,t.cron_updated,NOW()) > 15 END     ';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete" and  ( plan.max_listing_per_day = "0"  or  plan.max_listing_per_day   > 0  ) and ( CASE WHEN plan.validity = "0" THEN 1 ELSE    DATEDIFF( NOW(), plan.date_start  ) <=  plan.validity END) and plan.date_start <= CURDATE()   ';
		$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->select .= ',tdataad.message as ad_title2 ';
		$criteria->order='t.cron_updated IS NULL,t.last_updated asc';
	    $criteria->group = 't.id'; 
		$criteria->params[':lan2'] = 'ar';
	//	echo $criteria->condition;exit;
		$criteria->limit = 50;
		return  PlaceAnAd::model()->findAll($criteria);
	} 
	   public function getCompanyImage2(){
	   if(!empty($this->user_image) ){
		   return $this->getDetailImages($this->user_image,'A',90);
	   } 
   }
      public function getdetailImages($im,$status,$w='960'){
	   	 return $this->generateImageWaterMark($im,$w,$h='450',$opaciti=80,$wateri=20);
					 
   }
   
  public $bayut_properties;
  public $propertyFinder_properties;
  public function getBayutOpenLink(){
      if(empty($this->bayut_properties)){ return'-';}
      return CHtml::link($this->bayut_properties,'javascript:void(0)',array('onclick'=>'openIframe(this)','style'=>'font-size:17px;','data-link'=>Yii::app()->createUrl('place_property/detail_list',array('user'=>$this->user_id,'type'=>'B'))));
  }
   public function getPfLink(){
      if(empty($this->propertyFinder_properties)){ return'-';}
      return CHtml::link($this->propertyFinder_properties,'javascript:void(0)',array('onclick'=>'openIframe(this)','style'=>'font-size:17px;','data-link'=>Yii::app()->createUrl('place_property/detail_list',array('user'=>$this->user_id,'type'=>'P'))));
  }
  public function getPidwithLink(){
      return $this->p_id.' '.$this->ExternalPropertyLinkIframe;
  }
     public function getExternalPropertyLinkIframe(){
       if(!empty($this->p_url)){
           return CHtml::link('<i class="fa fa-link"></i>','javascript:void(0)',array('datalink'=>$this->p_url,'onclick'=>'parent.openLink(this)', 'style'=>'    display: block;    color: orange;    font-weight: bold;    text-align: center;    padding: 2px 5px;    background: #fff;    max-width: 31px;    border-radius: 5px;',));
       }
   }
   
   public function getBayutCount(){
       
       $total_imported_bayut_criteria = PlaceAnAdNew::model()->import_stats_criteria();
       $total_imported_bayut_criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
       $total_imported_bayut_criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = usr.parent_user ';
          $total_imported_bayut_criteria->condition .= ' and t.site = :bayut and (t.user_id = :he or p_usr.user_id = :he) ';
          $total_imported_bayut_criteria->params[':bayut'] = 'B'; $total_imported_bayut_criteria->params[':he'] = $this->user_id;
          $count =   PlaceAnAdNew::model()->count($total_imported_bayut_criteria);
            if(empty($count)){ return'-';}
        return CHtml::link($count,'javascript:void(0)',array('onclick'=>'openIframe(this)','style'=>'font-size:17px;','data-link'=>Yii::app()->createUrl('place_property/detail_list',array('user'=>$this->user_id,'type'=>'B'))));

   }
   public function getPropertyFinderCount(){
        
        $total_imported_bayut_criteria = PlaceAnAdNew::model()->import_stats_criteria();
        $total_imported_bayut_criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
        $total_imported_bayut_criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = usr.parent_user ';
        $total_imported_bayut_criteria->condition .= ' and t.site = :bayut and (t.user_id = :he or p_usr.user_id = :he) ';
        $total_imported_bayut_criteria->params[':bayut'] = 'P'; $total_imported_bayut_criteria->params[':he'] = $this->user_id;
        $count =   PlaceAnAdNew::model()->count($total_imported_bayut_criteria);
        if(empty($count)){ return'-';}
        return CHtml::link($count,'javascript:void(0)',array('onclick'=>'openIframe(this)','style'=>'font-size:17px;','data-link'=>Yii::app()->createUrl('place_property/detail_list',array('user'=>$this->user_id,'type'=>'P'))));

   }
     public function import_stats()
    {
	 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '1'; 
        $criteria->select = '  (CASE WHEN  pusr.user_id is not null THEN pusr.user_id ELSE  usr.user_id END) as user_id, (CASE WHEN  pusr.user_id is not null THEN pusr.company_name ELSE  usr.company_name END) as company_name' ;
        $criteria->condition .= ' and t.site is not null '; 
        if(!empty($this->company_name)){
            $criteria->condition .= ' and  (CASE WHEN  pusr.user_id is not null THEN LOWER(pusr.company_name) ELSE  LOWER(usr.company_name) END) like :company_name ';
            $criteria->params[':company_name'] ='%'.strtolower($this->company_name).'%';
        }
        $criteria->join = ' INNER JOIN {{listing_users}} usr on t.user_id = usr.user_id ';
        $criteria->join .= ' LEFT JOIN {{listing_users}} pusr on usr.parent_user = pusr.user_id ';
        $criteria->group  = ' (CASE WHEN  pusr.user_id is not null THEN pusr.user_id ELSE  usr.user_id END) ';
        $criteria->order="  (CASE WHEN  pusr.user_id is not null THEN pusr.company_name ELSE  usr.company_name END)  asc ";
	 	return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
	   'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
		));
    }
    public function import_stats_criteria()
    { 
        $criteria=new CDbCriteria;
        $criteria->condition = '1'; 
        $criteria->condition .= ' and t.site is not null '; 
        return  $criteria;
    }
     public function import_stats_individual_list()
    {
	 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '1'; 
        $criteria->select = ' t.id,t.p_id,t.p_url,t.ad_title ' ;
        if(!empty($this->site)){
             $criteria->condition .= ' and t.site = :site'; 
             $criteria->params[':site'] =$this->site;
        }
       
        if(!empty($this->user_id)){
            $criteria->condition .= ' and  (CASE WHEN  pusr.user_id is not null THEN pusr.user_id ELSE   usr.user_id  END) like :user ';
            $criteria->params[':user'] = $this->user_id ;
        }
          if(!empty($this->ad_title)){
            $criteria->condition .= ' and  t.ad_title  like :user ';
            $criteria->params[':user'] = '%'.$this->ad_title.'%' ;
        }
         if(!empty($this->p_id)){
            $criteria->condition .= ' and t.p_id = :p_id'; 
            $criteria->params[':p_id'] = $this->p_id ;
        }
        $criteria->join = ' INNER JOIN {{listing_users}} usr on t.user_id = usr.user_id ';
        $criteria->join .= ' LEFT JOIN {{listing_users}} pusr on usr.parent_user = pusr.user_id ';
        
        $criteria->order="t.date_added desc";
	 	return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
	   'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
		));
    }
   
}
