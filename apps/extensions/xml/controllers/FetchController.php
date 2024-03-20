<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * SiteController
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class FetchController extends Controller
{
   public $_access_code;
   public $_group_code;
   public $_get_country_url;
   public $_get_state_url;
   public $_get_city_url;
   public $_get_district_url;
   public $_get_community_url;
   public $_get_sub_community_url;
   public $_get_agent_url;
   public $_sale_xml_url;
   public $_rent_xml_url;
   public $_sale_category_array;
   public $_rent_category_array;
   public $_sales_listing_id;
   public $_rent_listing_id;
   
   public function init() {
		 $extension  = Yii::app()->extensionsManager->getExtensionInstance('xml');
		 if(!$extension)
		 {
			  
			  throw new CHttpException(404, Yii::t('app', 'Extension not exit.'));
		   
		 }
		 ini_set('memory_limit', '-1');
		 ini_set('max_execution_time', 6000); 
	 
		 $this->_access_code 					= 	$extension->getOption('access_code');
		 $this->_group_code 					= 	$extension->getOption('group_code');
		 $this->_get_country_url 				= 	$extension->getOption('get_country_url');
		 $this->_get_state_url 					= 	$extension->getOption('get_state_url');
		 $this->_get_city_url 					= 	$extension->getOption('get_city_url');
		 $this->_get_district_url 				= 	$extension->getOption('get_district_url');
		 $this->_get_community_url 				= 	$extension->getOption('get_community_url');
		 $this->_get_sub_community_url 			= 	$extension->getOption('get_sub_community_url');
		 $this->_get_agent_url 					= 	$extension->getOption('get_agent_url');
		 $this->_sale_xml_url 					= 	$extension->getOption('sale_xml_url');
		 $this->_rent_xml_url 					= 	$extension->getOption('rent_xml_url');
		 $this->_sales_listing_id 				= 	PlaceAnAd::SALE_ID;
		 $this->_rent_listing_id 				= 	PlaceAnAd::RENT_ID;
		 Yii::import('webroot.apps.extensions.xml.simpleXml2Array');
		 
		 
    }
    function actionGetCountries()
    {
		 
		$systemUrl = $this->_get_country_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&CountryID=&CountryName=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	    
	    $country = new Countries;
	     
		if($array and isset($array['GetCountryData']))
		{ 
					  
					 if(isset($array['GetCountryData']))
					 {
					     foreach($array['GetCountryData'] as $k)
					     {
							 
							 $country->isNewRecord   = true ; 
							 $country->country_id	 = $k['CountryID'][0] ; 
							 $country->country_name  = $k['CountryName'][0] ; 
							 $country->country_code  = $k['CountryCode'][0] ; 
							 $model  =  Countries::model()->findByPk($country->country_id);
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 $country->updateByPk( $country->country_id , $country->attributes );
							 }
							 else
							 {
								 $country->save();
							 }
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
    function actionGetStateData()
    {
		 
		$systemUrl = $this->_get_state_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&CountryID=&StateID=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	   
	    $state = new States;
	     
		if($array and isset($array['GetStateData']))
		{ 
					  
					 if(isset($array['GetStateData']))
					 {
					     foreach($array['GetStateData'] as $k)
					     {
							 
							  
							 $state->isNewRecord   = true ; 
							 $state->country_id	 = $k['CountryID'][0] ; 
							 $state->state_name    = $k['StateName'][0] ; 
							 $state->state_id    = $k['StateID'][0] ; 
							 $model  =  States::model()->findByPk($state->state_id);
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 $state->updateByPk( $state->state_id , $state->attributes );
							 }
							 else
							 {
								 $state->save();
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
	
	function actionGetCityData()
    {
		 
		$systemUrl = $this->_get_city_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&StateID=&cityID=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	    $city = new City;
	     
		if($array and isset($array['GetCityData']))
		{ 
					  
					 if(isset($array['GetCityData']))
					 {
					     foreach($array['GetCityData'] as $k)
					     {
							 
							  
							 $city->isNewRecord   = true ; 
							 $city->city_id		  = $k['CityID'][0] ; 
							 $city->city_name     = $k['CityName'][0] ; 
							 $city->state_id     = $k['StateID'][0] ; 
							 $model  =  City::model()->findByPk($city->city_id);
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 $city->updateByPk( $city->city_id , $city->attributes );
							 }
							 else
							 {
								 $city->save();
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
	
	function actionGetDistrictData()
    {
		 
		$systemUrl = $this->_get_district_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&CityID=&DistrictID=&StateID=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	    $district = new District;
	     
		if($array and isset($array['GetDistrictData']))
		{ 
					  
					 if(isset($array['GetDistrictData']))
					 {
					     foreach($array['GetDistrictData'] as $k)
					     {
							 
							 
							 $district->isNewRecord   = true ; 
							 $district->district_id		  = $k['DistrictID'][0] ; 
							 $district->district_name     = $k['DistrictName'][0] ; 
							 $district->city_id     = $k['CityID'][0] ; 
							 $model  =  District::model()->findByPk($district->district_id); 
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 $district->updateByPk( $district->district_id , $district->attributes );
							 }
							 else
							 {
								 $district->save();
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
	function actionGetCommunityData()
    {
		ini_set('max_execution_time', 600); 
		$systemUrl = $this->_get_community_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&DistrictID=&CommunityID=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	   // echo sizeof($array['GetCommunityData']);exit;
	    $community = new Community;
	   
		if($array and isset($array['GetCommunityData']))
		{ 
					  
					 if(isset($array['GetCommunityData']))
					 {
					     foreach($array['GetCommunityData'] as $k)
					     {
							 
							 
							 $community->isNewRecord   = true ; 
							 $community->community_id		  = $k['CommunityID'][0] ; 
							 $community->community_name       = $k['CommunityName'][0] ; 
							 $community->district_id          = $k['DistrictID'][0] ; 
							 $model  =  Community::model()->findByAttributes(array('community_id'=>$community->community_id)); 
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 $community->updateByPk( $community->community_id , $community->attributes );
							 }
							 else
							 {
								 $community->save();
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
	function actionGetSubCommunityData()
    {
		ini_set('max_execution_time', 600); 
		$systemUrl = $this->_get_sub_community_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&CommunityID=&SubCommunityID=';
	 
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	   // echo sizeof($array['GetCommunityData']);exit;
	    $community = new SubCommunity;
	   
		if($array and isset($array['GetSubCommunityData']))
		{ 
					  
					 if(isset($array['GetSubCommunityData']))
					 {
					     foreach($array['GetSubCommunityData'] as $k)
					     {
							 
							 
							 $community->isNewRecord   = true ; 
							 $community->sub_community_id		  = $k['SubCommunityID'][0] ; 
							 $community->sub_community_name       = $k['SubCommunityName'][0] ; 
							 $community->community_id          = $k['CommunityID'][0] ; 
							 $model  =  SubCommunity::model()->findByPk($community->sub_community_id); 
							 
							 //if model Insert otherwise update
							 if($model)
							 {
								 if($model->sub_community_name != $community->sub_community_name and $model->community_id !=  $community->community_id )
								 {
								 $community->updateByPk( $community->sub_community_id , $community->attributes );
								 }
							 }
							 else
							 {
								 $community->save(false);
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	function actionGetAgentData()
    {
		 
		$systemUrl = $this->_get_agent_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&AgentID=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	   // echo sizeof($array['GetCommunityData']);exit;
	    $user = new ListingUsers();
	   
		if($array and isset($array['GetAgentData']))
		{ 
					  
					 if(isset($array['GetAgentData']))
					 {
					     foreach($array['GetAgentData'] as $k)
					     {
							 
							 
							 $user->isNewRecord   = true ; 
							 $user->user_id		  =	$k['AgentID'][0];
							 $user->first_name	  =	$k['AgentName'][0];
							 $user->email		  = $k['AgentEmail'][0] ; 
							 $user->phone      	  = $k['AgentPhone'][0] ; 
							 $user->mobile        = $k['AgentMobile'][0] ; 
							 $password 			  = '123456' ;
							 $user->con_password  = $password  ;
							 $user->password	  = $password ;
							 $user->status		  = 'A';
							  
							 
							 
							 $model  =  ListingUsers::model()->findByPk($user->user_id); 
							 //if model Insert otherwise update
							 if($model)
							 {
								 if($model->first_name != $user->first_name and $model->email !=  $user->email )
								 {
									$user->updateByPk( $user->user_id , $user->attributes );
								 }
							 }
							 else
							 {
								 $user->save(false);
							 }
							  
							  
							 
							  
						 }
					 }
		 }
		 
	}
	
	
	function actionGetSaleData()
    {
	 
		
		$Ads_array =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_sales_listing_id),'code','code');
		$this->_sale_category_array = CHtml::listData(Category::model()->ListDataWithSection($this->_sales_listing_id),'category_id','category_name');
	   	$systemUrl = $this->_sale_xml_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&Bedrooms=&StartPriceRange=&EndPriceRange=&CategoryID=&SpecialProjects=&CountryID=&StateID=&CommunityID=&DistrictID=&FloorAreaMin=&FloorAreaMax=&UnitCategory=&UnitID=&BedroomsMax=&PropertyID=&ReadyNow=&PageIndex=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	   
	 
	   // echo sizeof($array['GetCommunityData']);exit;
	    $model = new PlaceAnAd();
 
		if($array and isset($array['UnitDTO']))
		{ 
					  
					 if(isset($array['UnitDTO']))
					 {
						 $count=0;
					     foreach($array['UnitDTO'] as $v=>$k)
					     {
							 
							 //if($count==8) break;
						     if(!in_array($k['code'][0],$Ads_array))
						     {
							 
							    $model->isNewRecord  				 = 		true ; 
								//Check  Category is alredy insetred other wise insert category
								if(!$this->in_arrayi($k['Category'][0],$this->_sale_category_array))
								{
						            

									$model->category_id 			 =  PlaceAnAd::model()->category_isert($this->_sales_listing_id,$k['Category'][0]); 
									$this->_sale_category_array[$model->category_id] =  $k['Category'][0];
						 

								}
								else
								{

									 
									 $model->category_id = 		array_search(strtolower($k['Category'][0]), array_map('strtolower',$this->_sale_category_array));

								}
								//End Category Checks
								
								
								//Check For Sub CategorySubType
								if(is_string( $k['SubType'][0] ) and $k['SubType'][0] !="")
								{

								$model->sub_category_id =    PlaceAnAd::model()->subcategory_insert($model->category_id,$k['SubType'][0],$this->_sales_listing_id);

								}
								else
								{

								$model->sub_category_id = "";
								}
								
								
			                   
			                
			                   $model->section_id = $this->_sales_listing_id;
			                   $model->code = $k['code'][0];
			                   $model->status = 'A';
			                   $model->occupant_status = $k['Status'][0];
			                   $model->RefNo = $k['RefNo'][0];
			                   $model->property_name = $k['PropertyName'][0];
			                   $model->builtup_area = $k['BuiltupArea'][0];
			                   $model->bedrooms = ($k['Bedrooms'][0] == "studio" || $k['Bedrooms'][0] == "Studio") ? '13' : $k['Bedrooms'][0];
			                   $model->mobile_number = $k['ContactNumber'][0];
			                   $model->PrimaryUnitView = $k['PrimaryUnitView'][0];
			                   $model->SecondaryUnitView = $k['SecondaryUnitView'][0];
			                   $model->UnitModel = $k['UnitModel'][0];
			                   $model->HandoverDate = ($k['HandoverDate'][0] !="") ? date('Y-m-d',strtotime($k['HandoverDate'][0])) : "" ;
							   $model->ad_description = $k['Remarks'][0];
							   $model->parking = $k['Parking'][0];
							   $model->price = number_format($k['SellPrice'][0],2,'.','');
							   $model->property_overview = $k['PropertyOverview'][0];
							   $model->LocalAreaAmenitiesDesc = $k['LocalAreaAmenitiesDesc'][0];
							   $model->DocumentWeb = $k['DocumentWeb'][0];
							   $model->bathrooms = $k['NoOfBathrooms'][0];
							   $model->RetUnitCategory = $k['RetUnitCategory'][0];
							   $model->PDFBrochureLink = $k['PDFBrochureLink'][0];
							   $model->user_id = $k['AgentID'][0];
							   $model->country = $k['CountryID'][0];
							   $model->state = $k['StateID'][0];
							   $model->city = $k['CityID'][0];
							   $model->district = $k['DistrictID'][0];
							   $model->community_id = $k['CommunityID'][0];
							   $model->sub_community_id = $k['SubCommunityID'][0];
							   $model->bdm_pkg = $k['BdmPkg'][0];
							   $model->salesman_email = $k['SalesmanEmail'][0];
							   $model->expiry_date = ($k['ExpiryDate'][0] !="") ? date('Y-m-d',strtotime($k['ExpiryDate'][0])) : "" ;;
							   $model->RecommendedProperties = $k['RecommendedProperties'][0];
							   $model->ad_title = $k['MarketingTitle'][0];
							   $model->marketing_option = $k['MarketingOptions'][0];
							   $model->arabic_title = $k['ArabicTitle'][0];
							   $model->arabic_description = $k['ArabicDescription'][0];
							   $model->mandate = $k['Mandate'][0];
							   $model->ReraStrNo = $k['ReraStrNo'][0];
							   $model->currency_abr = $k['CurrencyAbr'][0];
							   $model->area_measurement = $k['AreaMeasurement'][0];
							   $mapcords = explode(',',$k['ProGooglecoordinates'][0]);
							   $model->location_longitude = @$mapcords[0];
							   $model->location_latitude = @$mapcords[1];;
							   $model->id = "";
							   $model->PropertyID = $k['PropertyID'][0];
							   $model->xml_type = 'P';
							   $model->added_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['ListingDate'][0])));
							   $model->modified_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['LastUpdated'][0])));
							  
							   
							   if( $model->save() )
							   {
								    $ad_id = Yii::app()->db->getLastInsertId();
								    //Insert Images
									if(isset( $k['Images'][0]['Image']) and !empty($k['Images'][0]['Image']))
									 {
									 
									 $room_image = new AdImage;
									 $imagearray = $k['Images'][0]['Image'];
								 
									 foreach($imagearray as  $photo)
														 {
															 
																
																$img="";
																if (@GetImageSize($photo['ImageURL']['0'])) {
																	
																	
																	

																		$path =  Yii::app()->basePath . '/../../uploads' ;
																		$img = rand(0,9999).'_'.time().".jpg";
																		$content = file_get_contents($photo['ImageURL']['0']);
																		file_put_contents($path."/ads/{$img}", $content);

																}
																
																
																
																 
															 
																$room_image->isNewRecord = true;
																$room_image->id = "";
																$room_image->ad_id = $ad_id;
																$room_image->image_name = $img ;
																$room_image->image_type = $photo['ImageType']['0'] ;
																$room_image->Title = $photo['Title']['0'] ;
																$room_image->IsMarketingImage = $photo['IsMarketingImage']['0'] ;
																$room_image->ImageRemarks = $photo['ImageRemarks']['0'] ;
																$room_image->xml_image = $photo['ImageURL']['0'] ;
																$room_image->status = "A";
																$room_image->save() ;
															 
															   
																  
														 }
									  }
									  //Insert Amenities
									  
									  if(!empty($k['FittingFixtures'][0]['FittingFixture']))
									 {
										 $amenities = new Amenities;
										 $Adamenities = new AdAmenities;
										 $amenitiesList = CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_id');
										 $amenitiearray = array();
										 foreach($k['FittingFixtures'][0]['FittingFixture'] as $fitting) 
										 {
											 if(!$this->in_arrayi($fitting['ID'][0], $amenitiesList))
											 {
												 $amenities->isNewRecord =true; 
												 $amenities->amenities_id = $fitting['ID'][0]; 
												 $amenities->amenities_name = $fitting['Name'][0]; 
												 $amenities->Title = $fitting['Title'][0]; 
												 $amenities->save();
												 $amenities_id =  Yii::app()->db->getLastInsertId();
												 
											 }
											 else
											 {
												  $amenities_id = $fitting['ID'][0];
												 
											 }
											 $Adamenities->isNewRecord =true; 
											 $Adamenities->ad_id = $ad_id; 
											 $Adamenities->amenities_id = $amenities_id;
											 $Adamenities->save(); 
											 
										 }
									 }
							   }
							  
							  
							   
							    
						 $count++;
							 
						 }
					 }
					 echo $count."inserted";
					 }
		 }
		 
	}
	
	/* FOR UPDATION OF SALE  LISTING DATA */
	
	function actionUpdateSaleData()
    {
		
		$Ads_array =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_sales_listing_id),'code','code');
		$modifiedArray =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_sales_listing_id),'code','modified_date');
		$IDArray =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_sales_listing_id),'code','id');
		 
		 
		$this->_sale_category_array = CHtml::listData(Category::model()->ListDataWithSection($this->_sales_listing_id),'category_id','category_name');
	   	$systemUrl = $this->_sale_xml_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&Bedrooms=&StartPriceRange=&EndPriceRange=&CategoryID=&SpecialProjects=&CountryID=&StateID=&CommunityID=&DistrictID=&FloorAreaMin=&FloorAreaMax=&UnitCategory=&UnitID=&BedroomsMax=&PropertyID=&ReadyNow=&PageIndex=';
		$xmlString      = $this->post_request($systemUrl);
		
	 
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	     
	  
	   // echo sizeof($array['GetCommunityData']);exit;
	    $model = new PlaceAnAd();
 
		if($array and isset($array['UnitDTO']))
		{ 
					  
					 if(isset($array['UnitDTO']))
					 {
						 $count=0;
					     foreach($array['UnitDTO'] as $v=>$k)
					     {
							 
						 
						     if(in_array($k['code'][0],$Ads_array) and (strtotime($modifiedArray[$k['code'][0]]) != strtotime($k['LastUpdated'][0])))
						     {
								//  echo $IDArray[$k['code'][0]];echo "<br />";
							    $model->isNewRecord  				 = 		true ; 
								//Check  Category is alredy insetred other wise insert category
								if(!$this->in_arrayi($k['Category'][0],$this->_sale_category_array))
								{
						            

									$model->category_id 			 =  PlaceAnAd::model()->category_isert($this->_sales_listing_id,$k['Category'][0]); 
									$this->_sale_category_array[$model->category_id] =  $k['Category'][0];
						 

								}
								else
								{

									 
									 $model->category_id = 		array_search(strtolower($k['Category'][0]), array_map('strtolower',$this->_sale_category_array));

								}
								//End Category Checks
								
								
								//Check For Sub CategorySubType
								if(is_string( $k['SubType'][0] ) and $k['SubType'][0] !="")
								{

								$model->sub_category_id =    PlaceAnAd::model()->subcategory_insert($model->category_id,$k['SubType'][0],$this->_sales_listing_id);

								}
								else
								{

								$model->sub_category_id = "";
								}
								
								
			                   
			                
			                   $model->section_id = $this->_sales_listing_id;
			                   $model->code = $k['code'][0];
			                   $model->status = 'A';
			                   $model->occupant_status = $k['Status'][0];
			                   $model->RefNo = $k['RefNo'][0];
			                   $model->property_name = $k['PropertyName'][0];
			                   $model->builtup_area = $k['BuiltupArea'][0];
			                   $model->bedrooms =  ($k['Bedrooms'][0] == "studio" || $k['Bedrooms'][0] == "Studio") ? '13' : $k['Bedrooms'][0];
			                   $model->mobile_number = $k['ContactNumber'][0];
			                   $model->PrimaryUnitView = $k['PrimaryUnitView'][0];
			                   $model->SecondaryUnitView = $k['SecondaryUnitView'][0];
			                   $model->UnitModel = $k['UnitModel'][0];
			                   $model->HandoverDate = ($k['HandoverDate'][0] !="") ? date('Y-m-d',strtotime($k['HandoverDate'][0])) : "" ;
							   $model->ad_description = $k['Remarks'][0];
							   $model->parking = $k['Parking'][0];
							   $model->price = number_format($k['SellPrice'][0],2,'.','');
							   $model->property_overview = $k['PropertyOverview'][0];
							   $model->LocalAreaAmenitiesDesc = $k['LocalAreaAmenitiesDesc'][0];
							   $model->DocumentWeb = $k['DocumentWeb'][0];
							   $model->bathrooms = $k['NoOfBathrooms'][0];
							   $model->RetUnitCategory = $k['RetUnitCategory'][0];
							   $model->PDFBrochureLink = $k['PDFBrochureLink'][0];
							   $model->user_id = $k['AgentID'][0];
							   $model->country = $k['CountryID'][0];
							   $model->state = $k['StateID'][0];
							   $model->city = $k['CityID'][0];
							   $model->district = $k['DistrictID'][0];
							   $model->community_id = $k['CommunityID'][0];
							   $model->sub_community_id = $k['SubCommunityID'][0];
							   $model->bdm_pkg = $k['BdmPkg'][0];
							   $model->salesman_email = $k['SalesmanEmail'][0];
							   $model->expiry_date = ($k['ExpiryDate'][0] !="") ? date('Y-m-d',strtotime($k['ExpiryDate'][0])) : "" ;;
							   $model->RecommendedProperties = $k['RecommendedProperties'][0];
							   $model->ad_title = $k['MarketingTitle'][0];
							   $model->marketing_option = $k['MarketingOptions'][0];
							   $model->arabic_title = $k['ArabicTitle'][0];
							   $model->arabic_description = $k['ArabicDescription'][0];
							   $model->mandate = $k['Mandate'][0];
							   $model->ReraStrNo = $k['ReraStrNo'][0];
							   $model->currency_abr = $k['CurrencyAbr'][0];
							   $model->area_measurement = $k['AreaMeasurement'][0];
							   $mapcords = explode(',',$k['ProGooglecoordinates'][0]);
							   $model->location_longitude = @$mapcords[0];
							   $model->location_latitude = @$mapcords[1];;
							   $model->id = $IDArray[$k['code'][0]];
							   $model->PropertyID = $k['PropertyID'][0];
							   $model->xml_type = 'P';
							   $model->added_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['ListingDate'][0])));
							   $model->modified_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['LastUpdated'][0])));
							   if( $model->updateByPk($model->id,$model->attributes ) )
							   {
								     $ad_id = $model->id ;
								     $room_image = new AdImage;
									 $Adamenities = new AdAmenities;
								    //Insert Images
									if(isset( $k['Images'][0]['Image']) and !empty($k['Images'][0]['Image']))
									 {
									 
									
									 $room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$ad_id)));
									 $Adamenities->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$ad_id)));
									 $imagearray = $k['Images'][0]['Image'];
								 
									 foreach($imagearray as  $photo)
														 {
															 
																$img = rand(0,9999).'_'.time().".jpg";
																 
														 
																 
															 
																$room_image->isNewRecord = true;
																$room_image->id = "";
																$room_image->ad_id = $ad_id;
																$room_image->image_name = $img ;
																$room_image->image_type = $photo['ImageType']['0'] ;
																$room_image->Title = $photo['Title']['0'] ;
																$room_image->IsMarketingImage = $photo['IsMarketingImage']['0'] ;
																$room_image->ImageRemarks = $photo['ImageRemarks']['0'] ;
																$room_image->xml_image = $photo['ImageURL']['0'] ;
																$room_image->status = "A";
																$room_image->save(); 
															 
															   
																  
														 }
									  }
									  //Insert Amenities
									  
									  if(!empty($k['FittingFixtures'][0]['FittingFixture']))
									 {
										 $amenities = new Amenities;
										 
										 $amenitiesList = CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_id');
										 $amenitiearray = array();
										 foreach($k['FittingFixtures'][0]['FittingFixture'] as $fitting) 
										 {
											 if(!$this->in_arrayi($fitting['ID'][0], $amenitiesList))
											 {
												 $amenities->isNewRecord =true; 
												 $amenities->amenities_id = $fitting['ID'][0]; 
												 $amenities->amenities_name = $fitting['Name'][0]; 
												 $amenities->Title = $fitting['Title'][0]; 
												 $amenities->save();
												 $amenities_id =  Yii::app()->db->getLastInsertId();
												 
											 }
											 else
											 {
												  $amenities_id = $fitting['ID'][0];
												 
											 }
											 $Adamenities->isNewRecord =true; 
											 $Adamenities->ad_id = $ad_id; 
											 $Adamenities->amenities_id = $amenities_id;
											 $Adamenities->save(); 
											 
										 }
									 }
							   }
							  
							  
							   
							    
						 $count++;
							 
						 }
					 }
					 echo $count." updated";
					 }
		 }
		 
	}
	
	/* For Insertion OF RENT DATA */
	function actionGetRentData()
    {
		
		
	 
		$Ads_array =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_rent_listing_id),'code','code');
	    $this->_rent_category_array = CHtml::listData(Category::model()->ListDataWithSection($this->_rent_listing_id),'category_id','category_name');
	   	$systemUrl = $this->_rent_xml_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&PropertyType=&Bedrooms=&StartPriceRange=&EndPriceRange=&categoryID=&CountryID=&StateID=&CommunityID=&FloorAreaMin=&FloorAreaMax=&UnitCategory=&UnitID=&BedroomsMax=&PropertyID=&ReadyNow=&PageIndex=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	    
	  
 
	   // echo sizeof($array['GetCommunityData']);exit;
	    $model = new PlaceAnAd();
 
		if($array and isset($array['UnitDTO']))
		{ 
					  
					 if(isset($array['UnitDTO']))
					 {
						 $count=0;
					     foreach($array['UnitDTO'] as $v=>$k)
					     {
							 
							 
						     if(!in_array($k['code'][0],$Ads_array))
						     {
							 
							    $model->isNewRecord  				 = 		true ; 
								//Check  Category is alredy insetred other wise insert category
								if(!$this->in_arrayi($k['Category'][0],$this->_rent_category_array))
								{
						            

									$model->category_id 			 =  PlaceAnAd::model()->category_isert($this->_rent_listing_id,$k['Category'][0]); 
									$this->_rent_category_array[$model->category_id] =  $k['Category'][0];
						 

								}
								else
								{

									 
									 $model->category_id = 		array_search(strtolower($k['Category'][0]), array_map('strtolower',$this->_rent_category_array));

								}
								//End Category Checks
								
								
								//Check For Sub CategorySubType
								if(is_string( $k['SubType'][0] ) and $k['SubType'][0] !="")
								{

								$model->sub_category_id =    PlaceAnAd::model()->subcategory_insert($model->category_id,$k['SubType'][0],$this->_rent_listing_id);

								}
								else
								{

								$model->sub_category_id = "";
								}
								
								
			                   
			                
			                   $model->section_id = $this->_rent_listing_id;
			                   $model->code = $k['code'][0];
			                   $model->status = 'A';
			                   $model->occupant_status = $k['Status'][0];
			                   $model->RefNo = $k['RefNo'][0];
			                   $model->property_name = $k['PropertyName'][0];
			                   $model->builtup_area = $k['BuiltupArea'][0];
			                   $model->bedrooms =  ($k['Bedrooms'][0] == "studio" || $k['Bedrooms'][0] == "Studio") ? '13' : $k['Bedrooms'][0];
			                   $model->mobile_number = $k['ContactNumber'][0];
			                   $model->PrimaryUnitView = $k['PrimaryUnitView'][0];
			                   $model->SecondaryUnitView = $k['SecondaryUnitView'][0];
			                   $model->UnitModel = $k['UnitModel'][0];
			                   $model->HandoverDate = ($k['HandoverDate'][0] !="") ? date('Y-m-d',strtotime($k['HandoverDate'][0])) : "" ;
							   $model->ad_description = $k['Remarks'][0];
							   $model->parking = $k['Parking'][0];
							   $model->price = number_format($k['Rent'][0],2,'.','');
							   $model->Rent = number_format($k['Rent'][0],2,'.','');
							   $model->RentPerMonth = number_format($k['RentPerMonth'][0],2,'.','');
							   $model->property_overview = $k['PropertyOverview'][0];
							   $model->LocalAreaAmenitiesDesc = $k['LocalAreaAmenitiesDesc'][0];
							   //$model->DocumentWeb = $k['DocumentWeb'][0];
							   $model->bathrooms = $k['NoOfBathrooms'][0];
							   $model->RetUnitCategory = $k['RetUnitCategory'][0];
							   $model->PDFBrochureLink = $k['PDFBrochureLink'][0];
							   $model->user_id = $k['AgentID'][0];
							   $model->country = $k['CountryID'][0];
							   $model->state = $k['StateID'][0];
							   $model->city = $k['CityID'][0];
							   $model->district = $k['DistrictID'][0];
							   $model->community_id = $k['CommunityID'][0];
							   $model->sub_community_id = $k['SubCommunityID'][0];
							   $model->bdm_pkg = $k['BdmPkg'][0];
							   $model->salesman_email = $k['SalesmanEmail'][0];
							   $model->expiry_date = ($k['ExpiryDate'][0] !="") ? date('Y-m-d',strtotime($k['ExpiryDate'][0])) : "" ;;
							   $model->RecommendedProperties = $k['RecommendedProperties'][0];
							   $model->ad_title = $k['MarketingTitle'][0];
							   $model->marketing_option = $k['MarketingOptions'][0];
							   $model->arabic_title = $k['ArabicTitle'][0];
							   $model->arabic_description = $k['ArabicDescription'][0];
							   $model->mandate = $k['Mandate'][0];
							   $model->ReraStrNo = $k['ReraStrNo'][0];
							   $model->currency_abr = $k['CurrencyAbr'][0];
							   $model->area_measurement = $k['AreaMeasurement'][0];
							   $mapcords = explode(',',$k['ProGooglecoordinates'][0]);
							   $model->location_longitude = @$mapcords[0];
							   $model->location_latitude = @$mapcords[1];;
							   $model->id = "";
							   $model->PropertyID = $k['PropertyID'][0];
							   $model->xml_type = 'P';
							   $model->added_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['ListingDate'][0])));
							   $model->modified_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['LastUpdated'][0])));
							   if( $model->save() )
							   {
								    $ad_id = Yii::app()->db->getLastInsertId();
								    //Insert Images
									if(isset( $k['Images'][0]['Image']) and !empty($k['Images'][0]['Image']))
									 {
									 
									 $room_image = new AdImage;
									 $imagearray = $k['Images'][0]['Image'];
								 
									 foreach($imagearray as  $photo)
														 {
															 
																//$img = rand(0,9999).'_'.time().".jpg";
																 
														 	    $img="";
																if (@GetImageSize($photo['ImageURL']['0'])) {
																	
																	
																	

																		$path =  Yii::app()->basePath . '/../../uploads' ;
																		$img = rand(0,9999).'_'.time().".jpg";
																		$content = file_get_contents($photo['ImageURL']['0']);
																		file_put_contents($path."/ads/{$img}", $content);

																}
																
																
																
																 
															 
																$room_image->isNewRecord = true;
																$room_image->id = "";
																$room_image->ad_id = $ad_id;
																$room_image->image_name = $img ;
																$room_image->image_type = $photo['ImageType']['0'] ;
																$room_image->Title = $photo['Title']['0'] ;
																$room_image->IsMarketingImage = $photo['IsMarketingImage']['0'] ;
																$room_image->ImageRemarks = $photo['ImageRemarks']['0'] ;
																$room_image->xml_image = $photo['ImageURL']['0'] ;
																$room_image->status = "A";
																$room_image->save(); 
															 
															   
																  
														 }
									  }
									  //Insert Amenities
									  
									  if(!empty($k['FittingFixtures'][0]['FittingFixture']))
									 {
										 $amenities = new Amenities;
										 $Adamenities = new AdAmenities;
										 $amenitiesList = CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_id');
										 $amenitiearray = array();
										 foreach($k['FittingFixtures'][0]['FittingFixture'] as $fitting) 
										 {
											 if(!$this->in_arrayi($fitting['ID'][0], $amenitiesList))
											 {
												 $amenities->isNewRecord =true; 
												 $amenities->amenities_id = $fitting['ID'][0]; 
												 $amenities->amenities_name = $fitting['Name'][0]; 
												 $amenities->Title = $fitting['Title'][0]; 
												 $amenities->save();
												 $amenities_id =  Yii::app()->db->getLastInsertId();
												 
											 }
											 else
											 {
												  $amenities_id = $fitting['ID'][0];
												 
											 }
											 $Adamenities->isNewRecord =true; 
											 $Adamenities->ad_id = $ad_id; 
											 $Adamenities->amenities_id = $amenities_id;
											 $Adamenities->save(); 
											 
										 }
									 }
							   }
							  
							  
							   
							    
						 $count++;
							 
						 }
					 }
					 echo $count." inserted";
					 }
		 }
		 
	}
	
	
	function actionUpdateRentData()
    {
		
		$Ads_array =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_rent_listing_id),'code','code');
		$modifiedArray =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_rent_listing_id),'code','modified_date');
		$IDArray =  (array) CHtml::listData(PlaceAnAd::model()->getAllxml($this->_rent_listing_id),'code','id');
		$this->_rent_category_array = CHtml::listData(Category::model()->ListDataWithSection($this->_rent_listing_id),'category_id','category_name');
	    
	   
	   
	   	$systemUrl = $this->_rent_xml_url.'AccessCode='.$this->_access_code.'&GroupCode='.$this->_group_code.'&PropertyType=&Bedrooms=&StartPriceRange=&EndPriceRange=&categoryID=&CountryID=&StateID=&CommunityID=&FloorAreaMin=&FloorAreaMax=&UnitCategory=&UnitID=&BedroomsMax=&PropertyID=&ReadyNow=&PageIndex=';
		$xmlString      = $this->post_request($systemUrl);
		$xml = new simpleXml2Array( $xmlString, null );
	    $array =  $xml->arr  ;
	    
	   
	   // echo sizeof($array['GetCommunityData']);exit;
	    $model = new PlaceAnAd();
 
		if($array and isset($array['UnitDTO']))
		{ 
					  
					 if(isset($array['UnitDTO']))
					 {
						 $count=0;
					     foreach($array['UnitDTO'] as $v=>$k)
					     {
							 
						 
						     if(in_array($k['code'][0],$Ads_array) and (strtotime($modifiedArray[$k['code'][0]]) != strtotime($k['LastUpdated'][0])))
						     {
							
							    $model->isNewRecord  				 = 		true ; 
								//Check  Category is alredy insetred other wise insert category
								if($this->in_arrayi($k['Category'][0],$this->_rent_category_array))
								{
						            

									$model->category_id 			 =  PlaceAnAd::model()->category_isert($this->_rent_listing_id,$k['Category'][0]); 
									$this->_rent_category_array[$model->category_id] =  $k['Category'][0];
						 

								}
								else
								{

									 
									 $model->category_id = 		array_search(strtolower($k['Category'][0]), array_map('strtolower',$this->_rent_category_array));

								}
								//End Category Checks
								
								
								//Check For Sub CategorySubType
								if(is_string( $k['SubType'][0] ) and $k['SubType'][0] !="")
								{

								$model->sub_category_id =    PlaceAnAd::model()->subcategory_insert($model->category_id,$k['SubType'][0],$this->_rent_listing_id);

								}
								else
								{

								$model->sub_category_id = "";
								}
								
							   $model->section_id = $this->_rent_listing_id;
			                   $model->code = $k['code'][0];
			                   $model->status = 'A';
			                   $model->occupant_status = $k['Status'][0];
			                   $model->RefNo = $k['RefNo'][0];
			                   $model->property_name = $k['PropertyName'][0];
			                   $model->builtup_area = $k['BuiltupArea'][0];
			                   $model->bedrooms =  ($k['Bedrooms'][0] == "studio" || $k['Bedrooms'][0] == "Studio") ? '13' : $k['Bedrooms'][0];
			                   $model->mobile_number = $k['ContactNumber'][0];
			                   $model->PrimaryUnitView = $k['PrimaryUnitView'][0];
			                   $model->SecondaryUnitView = $k['SecondaryUnitView'][0];
			                   $model->UnitModel = $k['UnitModel'][0];
			                   $model->HandoverDate = ($k['HandoverDate'][0] !="") ? date('Y-m-d',strtotime($k['HandoverDate'][0])) : "" ;
							   $model->ad_description = $k['Remarks'][0];
							   $model->parking = $k['Parking'][0];
							   $model->price = number_format($k['Rent'][0],2,'.','');
							   $model->Rent = number_format($k['Rent'][0],2,'.','');
							   $model->RentPerMonth = number_format($k['RentPerMonth'][0],2,'.','');
							   $model->property_overview = $k['PropertyOverview'][0];
							   $model->LocalAreaAmenitiesDesc = $k['LocalAreaAmenitiesDesc'][0];
							   //$model->DocumentWeb = $k['DocumentWeb'][0];
							   $model->bathrooms = $k['NoOfBathrooms'][0];
							   $model->RetUnitCategory = $k['RetUnitCategory'][0];
							   $model->PDFBrochureLink = $k['PDFBrochureLink'][0];
							   $model->user_id = $k['AgentID'][0];
							   $model->country = $k['CountryID'][0];
							   $model->state = $k['StateID'][0];
							   $model->city = $k['CityID'][0];
							   $model->district = $k['DistrictID'][0];
							   $model->community_id = $k['CommunityID'][0];
							   $model->sub_community_id = $k['SubCommunityID'][0];
							   $model->bdm_pkg = $k['BdmPkg'][0];
							   $model->salesman_email = $k['SalesmanEmail'][0];
							   $model->expiry_date = ($k['ExpiryDate'][0] !="") ? date('Y-m-d',strtotime($k['ExpiryDate'][0])) : "" ;;
							   $model->RecommendedProperties = $k['RecommendedProperties'][0];
							   $model->ad_title = $k['MarketingTitle'][0];
							   $model->marketing_option = $k['MarketingOptions'][0];
							   $model->arabic_title = $k['ArabicTitle'][0];
							   $model->arabic_description = $k['ArabicDescription'][0];
							   $model->mandate = $k['Mandate'][0];
							   $model->ReraStrNo = $k['ReraStrNo'][0];
							   $model->currency_abr = $k['CurrencyAbr'][0];
							   $model->area_measurement = $k['AreaMeasurement'][0];
							   $mapcords = explode(',',$k['ProGooglecoordinates'][0]);
							   $model->location_longitude = @$mapcords[0];
							   $model->location_latitude = @$mapcords[1];;
							  // $model->id = $k['code'][0];
							   $model->id = $IDArray[$k['code'][0]];
							   $model->PropertyID = $k['PropertyID'][0];
							   $model->xml_type = 'P';
							   $model->added_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['ListingDate'][0])));
							   $model->modified_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $k['LastUpdated'][0])));
				
			                   
			                
			                   if( $model->updateByPk($model->id,$model->attributes ) )
							   {
								    $ad_id = $model->id ;
								     $room_image = new AdImage;
									 $Adamenities = new AdAmenities;
								    //Insert Images
									if(isset( $k['Images'][0]['Image']) and !empty($k['Images'][0]['Image']))
									 {
									 
									
									 $room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$ad_id)));
									 $Adamenities->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$ad_id)));
									 $imagearray = $k['Images'][0]['Image'];
								 
									 foreach($imagearray as  $photo)
														 {
															 
																$img = rand(0,9999).'_'.time().".jpg";
																$room_image->isNewRecord = true;
																$room_image->id = "";
																$room_image->ad_id = $ad_id;
																$room_image->image_name = $img ;
																$room_image->image_type = $photo['ImageType']['0'] ;
																$room_image->Title = $photo['Title']['0'] ;
																$room_image->IsMarketingImage = $photo['IsMarketingImage']['0'] ;
																$room_image->ImageRemarks = $photo['ImageRemarks']['0'] ;
																$room_image->xml_image = $photo['ImageURL']['0'] ;
																$room_image->status = "A";
																$room_image->save(); 
															   
																  
														 }
									  }
									  //Insert Amenities
									  
									  if(!empty($k['FittingFixtures'][0]['FittingFixture']))
									 {
										 $amenities = new Amenities;
										 
										 $amenitiesList = CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_id');
										 $amenitiearray = array();
										 foreach($k['FittingFixtures'][0]['FittingFixture'] as $fitting) 
										 {
											 if(!$this->in_arrayi($fitting['ID'][0], $amenitiesList))
											 {
												 $amenities->isNewRecord =true; 
												 $amenities->amenities_id = $fitting['ID'][0]; 
												 $amenities->amenities_name = $fitting['Name'][0]; 
												 $amenities->Title = $fitting['Title'][0]; 
												 $amenities->save();
												 $amenities_id =  Yii::app()->db->getLastInsertId();
												 
											 }
											 else
											 {
												  $amenities_id = $fitting['ID'][0];
												 
											 }
											 $Adamenities->isNewRecord =true; 
											 $Adamenities->ad_id = $ad_id; 
											 $Adamenities->amenities_id = $amenities_id;
											 $Adamenities->save(); 
											 
										 }
									 }
							   }
							  
							  
							   
							    
						 $count++;
							 
						 }
					 }
					 echo $count." updated";
					 }
		 }
		 
	}
	
	function in_arrayi($needle, $haystack) {
	
		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}
	 
	 
	
	 
	
	
	
    function  post_request($systemUrl) {


    	$ch = curl_init($systemUrl);
		 
	   // curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));      
	   // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

}
