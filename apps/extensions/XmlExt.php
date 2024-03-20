<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Ip location - Freegeoip.net
 * 
 * Creates the connection to freegeoip.net website to retrieve ip location data.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class XmlExt extends ExtensionInit 
{
    // name of the extension as shown in the backend panel
    public $name = 'Xml Activate';
    
    // description of the extension as shown in backend panel
    public $description = 'Xml';
    
    // current version of this extension
    public $version = '';
    
    // the author name
    public $author = 'redspider.ae';
    
    // author website
    public $website = 'redspider.ae';
    
    // contact email address
    public $email = 'ahmad@redspider.ae';
    
    // in which apps this extension is allowed to run
    public $allowedApps = array('frontend', 'backend');

    // can this extension be deleted? this only applies to core extensions.
    protected $_canBeDeleted = false;
    
    // can this extension be disabled? this only applies to core extensions.
    protected $_canBeDisabled = true;

    // run the extension
    public function run()
    {
        $hooks = Yii::app()->hooks;
        
         
    }
    public function beforeDisable()
    {
		 PlaceAnAd::model()->updateXmlAds('I');
         return true;
    }
    public function beforeEnable()
    {
		$count = PlaceAnAd::model()->countByAttributes(array('xml_inserted'=>'1' ));
		if($count==0)
		{
			$this-> beforeEnable2();
		}
		else
		{
			PlaceAnAd::model()->updateXmlAds('A');
		}
         
        return true;
    }
    public function beforeDelete()
    {
		 
		 
		 $xmlads = PlaceAnAd::model()->findAllByAttributes(array('xml_inserted'=>'1'));
		 if($xmlads)
		 {
			 
			 foreach($xmlads 	as $k  => $v)
			 {
				  
				 if($v->adImagesAll)
				 {
					 foreach($v->adImagesAll as $k2=>$v2)
					 {
						 
						unlink(Yii::app()->basePath.'/../../uploads/ads/'.$v2->image_name); 
						 
						  
					 
					 
					 }
					 
				 }
				 PlaceAnAd::model()->deleteByPk($v->id);
				 
			 }
			 
		 }
		 
        return true;
    }
    public function beforeEnable2()
    {
		
	 //Propertyforsale
		    $SectionID = 10;
		    $con  = CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name');
		    $stat = CHtml::listData(States::model()->StateList(),'state_id','state_name');
		    $category = CHtml::listData(Category::model()->ListDataWithSection($SectionID),'category_id','category_name');
		   
		   
		  
		    
			$xmlString = $this->post_request();
			$xml   = simplexml_load_string($xmlString);
			$array = json_decode(json_encode((array) $xml), 1);
			$array = array($xml->getName() => $array);
            
 
			 if($array)
			 {
				 foreach($array['SalesListings']['SalesListing'] as $k=>$v)
				 {
					  
					  
					 $ad_title 			=	"No title";  
					 $ad_description 	=	"No Description";  
					 $category_id 		=	"";  
					 $sub_category_id 	=	"";
					 $country_id		=	"";  
					 $state_id			=	""; 
					 $price				=	""; 
					 $area				=	"UNKNOWN";
					 $bathroom			=	"0"; 
					 $bedroom			=	"0"; 
					 $latitude			=	"0";
					 $longitude			=	"1";
					 $user_email		=	"";
					 $user_id 			=	"";
					 $user_phone		=	"";
					 $user_name			=	"";
					 $user_image		=	"";
					 $image_array		=	array(); 
					 foreach($v as $k1=>$v1)
					 {
						if(is_string($v1))
						{
						 if($k1=='Property_Type' )
						 {
							 //Category Insertin Step
							 if(!$this->in_arrayi($v1,$category))
							 {
								 
								 $category_id 			 =  $this->category_isert($category_model,$SectionID,$v1); 
								 $category[$category_id] =  $v1;
								 $this->fieldInsertion($category_id);
								  
							 }
							 else
							 {
								  $category_id =  array_search($v1, $category);
							 }
							 
							 
							 //SubcategoryInsertion
							 $sub_category_id =    $this->subcategory_insert($category_id,$unitType,$SectionID);
							  
							  
						 }
					
						 if($k1=="Listing_Agent_Email")
						 {
							$user = ListingUsers::model()->findByEmail($v1);
							if($user) 
							{
								$user_id = $user->user_id;
							}
							 
							$user_email =  $v1;
							 
						 }
						 
						 
						 if($k1=="Marketing_Title")
						 {
							 
							$ad_title = $v1;;
							 
						 }
						 if($k1=="Property_Name")
						 {
							if($ad_title != "")
							{
								$ad_title = $v1; 
							}
							 
						 }
						 if($k1=="Web_Remarks")
						 {
							 
							$ad_description = $v1;;
							 
						 }
						 if($k1=="Listing_Agent_Phone")
						 {
							 
							$user_phone = $v1;;
							 
						 }
						 if($k1=="Listing_Agent")
						 {
							 
							$user_name = $v1;;
							 
						 }
						 if($k1=="company_logo")
						 {
							 
							$user_image = $v1;;
							 
						 }
						 if($k1=="Country")
						 {
							 
							$country_id =  $this->country_insert($con,$v1);
							 
						 }
						 if($k1=="State")
						 {
							 
							$state_id =  $this->state_insert($stat,$v1,$country_id);
							 
						 }
						 if($k1=="Selling_Price")
						 {
							 
							$price = $v1;
							 
						 }
						 if($k1=="Unit_Plot_Area")
						 {
							 
							$area = $v1;
							 
						 }
						 
						 if($k1=="No_of_Bathroom")
						 {
							 
							$bathroom = $v1;
							 
						 }
						 if($k1=="Map_Coordinates")
						 {
							 
							$loc =  explode(',',$v1);
							$latitude			=	@$loc["0"];
							$longitude			=	@$loc["1"]; 
							
							 
						 }
						 if($k1=="Bedroom_Details")
						 {
							if($v1=="Studio")
							{
								$v1 ="13";
							}
							$bedroom = $v1;
							 
						 }
						 
						
						//Necessary STEP NOT REOVE
						 if($k1=='Unit_Type' )
						 {
							 $unitType = $v1;
							  
						 }
						}
						else
						{
							 if($k1=="Images")
							 {
								  
								 
								 if(isset($v1['ImageUrl']) and !empty($v1['ImageUrl']) and is_array($v1['ImageUrl']))
								 {
									   $image_array = $v1['ImageUrl']; 
							         
								 }
								 
							 }
						}
					 }
					 
					 if($user_id=="")
					 {
						$user_id = $this->insertUser($user_email, $user_phone,$user_name,$user_image);
					 }
					 
					 $place_ad = new PlaceAnAd;
					 $place_ad->id 			 			 = "";
					 $place_ad->ad_title 			 	 = $ad_title;
					 $place_ad->ad_description 		     = $ad_description;
					 $place_ad->section_id  	 		 = $SectionID;
					 $place_ad->category_id  	 		 = $category_id;
					 $place_ad->sub_category_id 		 = $sub_category_id;
					 $place_ad->country 				 = $country_id;
					 $place_ad->state 					 = $state_id;
					 $place_ad->user_id					 = $user_id;
					 $place_ad->price			 		 = $price;	
					 $place_ad->area			 	     = $area;	
					 $place_ad->bathrooms		 		 = $bathroom;	
					 $place_ad->bedrooms				 = $bedroom;	
					 $place_ad->location_latitude		 = $latitude;	
					 $place_ad->location_longitude		 = $longitude;	
					 $place_ad->mobile_number		     = $user_phone;	
					 $place_ad->xml_inserted			 = "1";	
				  	 if($place_ad->save())
					 {
						 $ad_id = Yii::app()->db->getLastInsertId();
					     $this->imageinsert($image_array,$ad_id);
						
					 }
					 
					 
					 
				 }
			 
				 
			 }
		
	}
	
    function insertUser($user_email, $user_phone,$user_name,$user_image)
    {
		   $model = new ListingUsers();
			$img_user="";
			if (@GetImageSize($user_image)) {
										    
										    
										    
										     $path =  Yii::app()->basePath . '/../../uploads' ;
										     $img_user = rand(0,9999).'_'.time().".jpg";
										     $content = file_get_contents($path);
											 file_put_contents($path."/avatar/{$img_user}", $content);
										 }
			$model->email = $user_email;
			$model->phone = $user_phone;
			$serexplode = explode(' ',$user_name);
            $model->first_name = @$serexplode['0'];
            $model->last_name =@$serexplode['1'];
            $password = '123456' ;
            $model->image= $img_user ; 
            $model->con_password=  $password  ;
            $model->password= $password ;
            $model->status='A';
            $model->xml_inserted='1';
            $model->save() ;
            return  Yii::app()->db->getLastInsertId();
	}
    function country_insert($con,$v1)
    {
		$country = new Countries;
		                    if(!$this->in_arrayi($v1, $con))
		                    {
								$country->country_name =$v1;
								$country->country_code ='XXX';
								$country->location_longitude ='1';
								$country->location_latitude ='1';
								$country->save();
								return  Yii::app()->db->getLastInsertId();

							}
							 else
							 {
								  return  array_search($v1, $con);
							 }
	}
    function state_insert($con,$v1,$country_id)
    {  
							$state = new States;
		                    if(!$this->in_arrayi($v1, $con))
		                    {
								$state->state_name =$v1;
								$state->country_id =$v1;
								$state->location_longitude ='1';
								$state->location_latitude ='1';
								$state->save();
								return  Yii::app()->db->getLastInsertId();

							}
							 else
							 {
								  return  array_search($v1, $con);
							 }
	}
    function category_isert($category_model,$SectionID,$v1)
    {
							$category_model = new Category;
							$category_model->isNewRecord =true;  
							$category_model->category_id     = "";
							$category_model->section_id     = $SectionID;
							$category_model->category_name  = $v1;
							$category_model->amenities_required  = 'Y';
							$category_model->xml_inserted  = '1';
							$category_model->slug = $category_model->getUniqueSlug();
							$category_model->save();
							return  Yii::app()->db->getLastInsertId();
	}
	function subcategory_insert($category_id,$unitType,$SectionID)
	{
							 $sub_category_model = new Subcategory;
							 $subcategory = CHtml::listData(Subcategory::model()->ListDataForCategory($category_id),'sub_category_id','sub_category_name');
							 if(!$this->in_arrayi($unitType, $subcategory))
							 {
								 $sub_category_model->isNewRecord    = true;
								 $sub_category_model->section_id     = $SectionID;
								 $sub_category_model->sub_category_id     ="";
								 $sub_category_model->category_id     = $category_id;
								 $sub_category_model->sub_category_name  = $unitType;
								 $sub_category_model->amenities_required  = 'Y';
								 $sub_category_model->xml_inserted  = '1';
								 $sub_category_model->slug = $sub_category_model->getUniqueSlug();
								 $sub_category_model->save();
								 return  Yii::app()->db->getLastInsertId();
								  
								  
							 }
							 else
							 {
								  return  array_search($unitType, $subcategory);
							 }
	}
	function fieldInsertion($category_id)
	{
		
								   $Fileds =  new   CategoryFieldList;
			                       $attributes2=array('price','area','bathrooms','bedrooms');
								   foreach($attributes2 as $field)
								   {
										$Fileds->isNewRecord =true;
										$Fileds->field_name = $field ;
										$Fileds->category_id = $category_id;
										$Fileds->save();
								   }  
	}
	function imageinsert($imagearray,$ad_id)
	{
		 
				 $room_image = new AdImage;
				 if(!empty($imagearray))
				 {
				 foreach($imagearray as  $photo)
									 {
										 
										  
										if (@GetImageSize($photo)) {
										    
										    
										    
										     $path =  Yii::app()->basePath . '/../../uploads' ;
										     $img = rand(0,9999).'_'.time().".jpg";
										     $content = file_get_contents($photo);
											try {
											file_put_contents($path."/ads/{$img}", $content);
											} catch (Exception $e) {

											}
											
											 
											 
											    $room_image->isNewRecord = true;
												$room_image->id = "";
												$room_image->ad_id = $ad_id;
												$room_image->image_name = $img ;
												$room_image->status = "A";
												$room_image->save();
											 
											 
										}                                      
										 
										   
											  
									 }
								 }
	}
	function in_arrayi($needle, $haystack) {
	
		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}
	 function post_request() {

		$ch = curl_init("http://webservice.gomasterkey.com/v1.1/portal.asmx/SalesListings?AccessCode=70726C52-0&groupcode=1015&Bedrooms=&StartPriceRange=&EndPriceRange=&category_id=&State_pk=&Community_pk=&unit_pk=&Property_pk=");
	   // curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));      
	   // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
     
    
  
}
