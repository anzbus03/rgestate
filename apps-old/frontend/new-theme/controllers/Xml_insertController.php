<?php defined('MW_PATH') || exit('No direct script access allowed');
 
class Xml_insertController  extends Controller
{
	 
	 

	public  $default_user; 
	public  $categoryList; 
		
    public function actionIndex($url=null)
    {
				 
				 define('PROSPACE','1');
		 $url = 'http://xml.propspace.com/feed/xml.php?cl=3460&pid=8245&acc=8807 ';
		ini_set("memory_limit", "-1");
		set_time_limit(0);
		$this->layout ='' ;
		$this->default_user = '31988';
		$multiple_row = array('agent','photo','images','facilities');
		$xmlfile = file_get_contents($url);

		$obj=  simplexml_load_string($xmlfile);
	 
		$response_array = $this->xmlObjToArr($obj);
		
	  
 
		if(!empty($response_array)){
			if(isset($response_array['children']['listing'])){
			   
				$properties_data  = $response_array['children']['listing'];
			//	$properties_data[] = $properties_data1[0];
		 
				foreach($properties_data as  $property){
				     
					 $prperty_attributes = $property['children'];
					 $attribute_array = array(); 
				 
					 
					 
					 foreach($prperty_attributes as $key=>$attributes){
					 
						 if(in_array($key,$multiple_row)){
							   foreach($attributes[0]['children'] as $key2=>$val2){
								   if(sizeOf($val2)=='1'){
									   $attribute_array[$key][$key2] = $val2[0]['text'];
								   }
								   else{
									   foreach($val2 as $multipleDimension){
									   $attribute_array[$key][$key2][] = $multipleDimension['text'];
									   }
								   }
							   } 
						 }
						 else{
						 $attribute_array[$key] = $attributes[0]['text'];
						 }
					 }
					 $this->insertXml($attribute_array);  
					
					  
					  
				} 
			}else {
			    
			    echo 'no';exit; 
			}
		}
		$total_added = $this->total_added;
		$total_updated = $this->total_updated;
		$total_no_action = $this->total_no_action;
		 $this->setData(array(
            'pageMetaTitle'     => 'Prospace CRM Import', 
            'pageHeading'       => 'Prospace CRM Import', 
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "Prospace CRM Import}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list',compact('total_added','total_no_action','total_updated')); 
		  
    }
    
    
     public function insertBrokerXml($attribute_array){
		
		  
		$this->total_run++;
		
 
		$this->model = PlaceAnAd::model()->findByAttributes(array('RefNo'=>$attribute_array['property_ref_no'],'xml_inserted'=>'1'));
	 
		if(empty($this->model)){
	    	$this->model = new PlaceAnAd();
			$this->total_added++;
		}
		 
		else if($this->model->xml_update_date==date('Y-m-d H:i:s',strtotime($attribute_array['last_updated']))){
		 
			    $this->total_no_action++ ; 
				 return ; 
		}
		 
		else{
			$this->total_updated++;
		}
		foreach($attribute_array as $k=>$v){
		    
			switch($k){
				case 'property_purpose':
				    $this->findSection(strtolower($v));
				    if($v=='Rent'){
				            if(isset($attribute_array['rent_frequency']) and !empty($attribute_array['rent_frequency']) and !in_array($attribute_array['rent_frequency'],array('yearly','monthly'))){
				                throw new CHttpException(503, 'Please Contact developer : Rental Frequesny not defined -  '.$attribute_array['rent_frequency']);
				            }
				        	    $this->model->rent_paid = $attribute_array['rent_frequency'];
				             
				    }
				break;
				case 'property_type':
				     $this->findCategorynew($v); 
				break;
				case 'property_size':
				$this->model->builtup_area = Yii::t('app',$v,array('.00'=>''));
				$this->model->area_unit = '1';
				break;
				
				case 'furnished':
				   
				$this->model->furnished =  (strtolower($v)=='yes') ? 'Y' : 'N';; 
				break;
				case 'bathroom':
				$this->model->bathrooms =  $v ; 
				break;
				case 'property_title':
				$this->model->ad_title =  $v ; 
				break;
				case 'property_description':
				$this->model->ad_description =  Yii::t('app',$v,array('<br />'=>"\r\n")) ; 
				break;
				
				case 'locality':
				        $mainr= $attribute_array['city'];
				    	$this->findCityNew($v,$mainr) ;
			 	break;
				case 'plot_area':
                    $this->model->interior_size = Yii::t('app',$v,array('.00'=>''));
                    $this->model->area_unit_1 = '1';
			 	break;
				case 'tower_name':
                    $this->model->area_location = $v; 
			 	break;
			 	case 'property_ref_no':
                    $this->model->RefNo = $v; 
			 	break;
			 	case 'bedrooms':
			 	    if($v=='ST'){
			 	        $this->model->bedrooms = 15; 
			 	    }else{
                    $this->model->bedrooms = $v; 
			 	    }
			 	break;
			 case 'price':
                    $this->model->price = Yii::t('app',$v,array('.00'=>''));; 
			 	break;
			 	 
                case 'geopoints':
                 $ar =    explode(',',$v);
                  $this->model->location_latitude =  $ar['1'] ; 
                $this->model->location_longitude = $ar['0'] ; 
                break;
                case 'featured': 
                 $this->model->featured = ($v=='1') ? 'Y' : 'N'; 
                break;
                 case 'unit_measure': 
                 if($v!='Sq.Ft.'){
                     throw new CHttpException(503, 'Please Contact developer : Undefined Unit '.$v);
                 } 
                break;
                
                case 'images':  
                    $this->model->image = explode(',',$v); 
                break;
                case 'features':
                
                       $this->setAmenitites(explode(',',$v));
                
                break; 
                	case 'last_updated':
				$this->model->xml_update_date = date('Y-m-d H:i:s',strtotime($v));
		 
				break;
				default:	
				    if(!empty($v)){
				$this->non_attribute[] = array($k=>$v); 
				    }
				break;
			}
			
		}
	 
			if(empty($this->model->user_id)){
				$this->model->user_id = $this->default_user ; 
				
			} 
		  
			$this->model->xml_inserted = '1' ; $this->model->broker_pad = '1'; 
  
		    if(!empty($this->non_attribute)){
				$this->model->unsubmited =  serialize($this->non_attribute);
				//echo "WER";exit; 
				 //print_r($this->model->unsubmited);exit;
			}
		    
		    if(!$this->model->save()){
				print_r($this->model->getErrors());exit;
			}
			else{
						
						$room_image = new AdImage;
						if(!$this->model->isNewRecord){						
							$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$this->model->id)));		
						}				  
						if(!empty($this->model->image))
						{
							$img_saved =false;
							$counti= 0; 
							foreach($this->model->image as $k=>$file)
							{
							    
							    
							     
										$file = trim($file);
									  	$file_format = 'jpeg';
										$img =date('Y-m-d-h-i-s').'-'.rand(0,9999).'-'.time().".".$file_format;
										$path_file =  Yii::getPathOfAlias('root.uploads.files');
										$year_folder = $path_file .'/'. date("Y");
										$month_folder = $year_folder . '/' . date("m");
										$month_folder2 = date("Y"). '/' . date("m");
										!file_exists($year_folder) && mkdir($year_folder , 0777);
										!file_exists($month_folder) && mkdir($month_folder, 0777);
										$path_file = $month_folder ;
                                        file_put_contents( $path_file."/{$img}", file_get_contents($file)); 
									 	$tag_name_value =   $month_folder2. '/' .$img;   ; 
									
							    
								$counti++; 
							  
									$room_image->isNewRecord = true;
									$room_image->id = "";
									$room_image->ad_id = $this->model->id; 
									$room_image->image_name =  $tag_name_value ; 
									$room_image->image_type =  '';
									$room_image->save();
							}
						 }
						  $am = new  AdAmenities();
						  if(!$this->model->isNewRecord){	
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$this->model->id)));
						  }
						  if(!empty($this->model->amenities_fields))
						  {
							 $ameni = $this->model->amenities_fields;
							 foreach($ameni as $k)
							 {
								 
									$am->isNewRecord = true;
									$am->ad_id = $this->model->id;
									$am->amenities_id =  $k;
									$am->save();
							 }
							 
						  }
			}
	 
	 return true; 
	}
 
      public function actionbrokerpad($url=null)
    {
				 echo "WER"; exit; 
				 define('PROSPACE','1');
		 $url = 'https://bcrm_org.s3.amazonaws.com/xml/2829/1643720341_5_2829_36464.xml';
		ini_set("memory_limit", "-1");
		set_time_limit(0);
		$this->layout ='' ;
		$this->default_user = '31988';
		$multiple_row = array('agent','photo','images','facilities');
		$xmlfile = file_get_contents($url);

		$obj=  simplexml_load_string($xmlfile);
	 
		$response_array = $this->xmlObjToArr($obj);
		
	 $found_feature = false; 
		if(!empty($response_array)){
	 		if(isset($response_array['children'])){
			   
			  
				$properties_data  = $response_array['children']['property'];
			
			//	$properties_data[] = $properties_data1[0];
		        $count = '1'; 
				foreach($properties_data as  $property){
				   if(isset($_GET['limit']) and $this->total_added > $_GET['limit'] ){
				       continue;
				   }
					     
				     
				    //  echo '<br />---------------------NEW PROPERTY----------------------------<br />'; 
				     $prperty_attributes = $property['children'] ; 
				     
				     foreach($prperty_attributes as $key=>$vall){
				        // echo $key; echo '-';
				         $val_get = !empty($vall[0]['children']) ? $vall[0]['children'] : $vall[0]['text']; 
				         if($key=='images'){
				             $img = ''; 
				             foreach($val_get['image'] as $imgList){
				                  $img .= $imgList['text'].','; 
				             } 
				             $val_get = $img; 
				         }
				         if($key=='features'){
				             $img = ''; 
				          //   print_r($vall[0]['children']); echo '<br />'; 
				              $val_get = !empty($vall[0]['children']) ? $vall[0]['children'] : $vall[0]['text']; 
				            if(!empty($val_get)){  $found_feature = true;  }
				             
				            
				             foreach($val_get['feature'] as $imgList){
				                  $img .= $imgList['text'].','; 
				             } 
				             $val_get = $img; 
				             
				         }
				         $attribute_array[$key] = $val_get ; 
				         //$attribute_array1[$attribute_array['property_type']] = $attribute_array['property_type']  ; 
				     }
				    // print_r($attribute_array);exit; 
				     
				     $this->insertBrokerXml($attribute_array); 
				     
				     
					  
				} 
			 
			
			}else {
			    
			    echo 'no';exit; 
			}
		}	 
		$total_added = $this->total_added;
		$total_updated = $this->total_updated;
		$total_no_action = $this->total_no_action;
		 $this->setData(array(
            'pageMetaTitle'     => 'BrokerPad CRM Import', 
            'pageHeading'       => 'BrokerPad CRM Import', 
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "BrokerPad CRM Import}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list',compact('total_added','total_no_action','total_updated')); 
		  
    }
    public function ArraykeyRepalce(){
		array(
		'reference_number' => 'RefNo', 
		'community' =>  'community_id',
		'sub_community' => 'sub_community_id',
		'title_en'  => 'ad_title', 
		'description_en' => 'ad_description',
		'amenities' => 'private_amenities,commercial_amenities',
		'view'=> 'PrimaryUnitView',
		'size' => 'builtup_area',
		'build_year' => 'year' , 
		'floors_number' => 'FloorNo',
 
		'geopoints' => 'location_latitude,location_longitude',
		);
	}
    
    public $non_attribute ; 
    public $model ; 
    public $total_added = 0; 
    public $total_updated  = 0; 
    public $total_no_action = 0 ; 
    public $total_run  = 0; 
    public function imgDefault()
    {
        static $_defaultImgModel;
        if ($_defaultImgModel !== null) {
            return $_defaultImgModel;
        }
		$_defaultImgModel =  $ref=new imageResize;;
		 
		 
        return $_defaultImgModel;
    }
    public $image_size;
    public function insertXml($attribute_array){
		
		 
		
		$this->total_run++;
		
 
		$this->model = PlaceAnAd::model()->findByAttributes(array('RefNo'=>$attribute_array['property_ref_no'],'xml_inserted'=>'1'));
	 
		if(empty($this->model)){
		$this->model = new PlaceAnAd();
			$this->total_added++;
		}
		 
		else if($this->model->xml_update_date==date('Y-m-d H:i:s',strtotime($attribute_array['last_updated']))){
			    $this->total_no_action++ ; 
				 return ; 
		}
		 
		else{
			$this->total_updated++;
		}
		foreach($attribute_array as $k=>$v){
		    
			switch($k){
				case 'ad_type':
				    $this->findSection(strtolower($v));
				    if($v=='Rent'){
				            if(isset($attribute_array['Frequency']) and !empty($attribute_array['Frequency']) and $attribute_array['Frequency']!='per year'){
				                throw new CHttpException(503, 'Please Contact developer : Rental Frequesny not defined -  '.$attribute_array['Frequency']);
				            }
				        	    $this->model->rent_paid = 'yearly';
				             
				    }
				break;
				case 'unit_type':
				     $this->findCategorynew($v); 
				break;
				case 'unit_builtup_area':
				$this->model->builtup_area = Yii::t('app',$v,array('.00'=>''));
				$this->model->area_unit = '1';
				break;
				case 'no_of_bathroom':
				$this->model->bathrooms =  $v ; 
				break;
				case 'property_title':
				$this->model->ad_title =  $v ; 
				break;
				case 'web_remarks':
				$this->model->ad_description =  Yii::t('app',$v,array('<br />'=>"\r\n")) ; 
				break;
				
				case 'community':
				        $mainr= $attribute_array['emirate'];
				    	$this->findCityNew($v,$mainr) ;
			 	break;
				case 'plot_area':
                    $this->model->interior_size = Yii::t('app',$v,array('.00'=>''));
                    $this->model->area_unit_1 = '1';
			 	break;
				case 'property_name':
                    $this->model->area_location = $v; 
			 	break;
			 	case 'property_ref_no':
                    $this->model->RefNo = $v; 
			 	break;
			 	case 'bedrooms':
			 	    if($v=='ST'){
			 	        $this->model->bedrooms = 15; 
			 	    }else{
                    $this->model->bedrooms = $v; 
			 	    }
			 	break;
			 case 'price':
                    $this->model->price = Yii::t('app',$v,array('.00'=>''));; 
			 	break;
			 	 case 'latitude':
                    $this->model->location_latitude =  $v ; 
			 	break;
                case 'longitude':
                $this->model->location_longitude =  $v ; 
                break;
                case 'featured': 
                 $this->model->featured = ($v=='1') ? 'Y' : 'N'; 
                break;
                 case 'unit_measure': 
                 if($v!='Sq.Ft.'){
                     throw new CHttpException(503, 'Please Contact developer : Undefined Unit '.$v);
                 } 
                break;
                case 'images': 
                    $this->model->image = $v['image']; 
                break;
                break;
                case 'images': 
                    $this->model->image = $v['image']; 
                break;
                case 'facilities':
                   if(isset($v['facility'])){
                       $this->setAmenitites($v['facility']);
               
                   }
                break; 
                	case 'last_updated':
				$this->model->xml_update_date = date('Y-m-d H:i:s',strtotime($v));
		 
				break;
				default:	
				    if(!empty($v)){
				$this->non_attribute[] = array($k=>$v); 
				    }
				break;
			}
			
		}
		 	
		
		
			if(empty($this->model->user_id)){
				$this->model->user_id = $this->default_user ; 
				
			} 
		  
			$this->model->xml_inserted = '1' ; 
  
		    if(!empty($this->non_attribute)){
				$this->model->unsubmited =  serialize($this->non_attribute);
				//echo "WER";exit; 
				 //print_r($this->model->unsubmited);exit;
			}
		    
		    if(!$this->model->save()){
				print_r($this->model->getErrors());exit;
			}
			else{
						
						$room_image = new AdImage;
						if(!$this->model->isNewRecord){						
							$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$this->model->id)));		
						}				  
						if(!empty($this->model->image))
						{
							$img_saved =false;
							$counti= 0; 
							foreach($this->model->image as $k=>$file)
							{
							    
							    
							     
										$file = trim($file);
									  	$file_format = 'jpeg';
										$img =date('Y-m-d-h-i-s').'-'.rand(0,9999).'-'.time().".".$file_format;
										$path_file =  Yii::getPathOfAlias('root.uploads.files');
										$year_folder = $path_file .'/'. date("Y");
										$month_folder = $year_folder . '/' . date("m");
										$month_folder2 = date("Y"). '/' . date("m");
										!file_exists($year_folder) && mkdir($year_folder , 0777);
										!file_exists($month_folder) && mkdir($month_folder, 0777);
										$path_file = $month_folder ;
                                        file_put_contents( $path_file."/{$img}", file_get_contents($file)); 
									 	$tag_name_value =   $month_folder2. '/' .$img;   ; 
									
							    
								$counti++; 
							  
									$room_image->isNewRecord = true;
									$room_image->id = "";
									$room_image->ad_id = $this->model->id; 
									$room_image->image_name =  $tag_name_value ; 
									$room_image->image_type =  '';
									$room_image->save();
							}
						 }
						  $am = new  AdAmenities();
						  if(!$this->model->isNewRecord){	
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$this->model->id)));
						  }
						  if(!empty($this->model->amenities_fields))
						  {
							 $ameni = $this->model->amenities_fields;
							 foreach($ameni as $k)
							 {
								 
									$am->isNewRecord = true;
									$am->ad_id = $this->model->id;
									$am->amenities_id =  $k;
									$am->save();
							 }
							 
						  }
			}
	 
	 return true; 
	}
 
	public function findCategorynew($category=null){
	            $found = ProspaceCategory::model()->findByAttributes(array('category'=>$category));
	            if($found){
	                $this->model->listing_type = $found->category_id;
	                $this->model->category_id = $found->type_id;
	            }else{
	                $link = CHtml::link('Add Category',Yii::App()->createUrl('prospace_categories/create',array('category'=>$category)),array('target'=>'_blank'));
	            throw new CHttpException(503, 'Category  not defined .'.$category.'Click here to add category. and continue '.$link);
	            }
	           
	}
	
	public function findCityNew($value=null,$main_region=null){
		$criteria = new CDbCriteria;
		$criteria->select = 't.state_id,t.country_id';
		$criteria->condition = " REPLACE(REPLACE(LOWER(t.state_name), '\r', ''), '\n', '') = :q or LOWER(t.p_name) = :q " ; 
			$criteria->condition .= " and LOWER(st.name) = :q2 ";
		$criteria->join   = " INNER JOIN {{main_region}} st on st.region_id = t.region_id    "; 
		$criteria->params[':q'] = strtolower($value) ;	$criteria->params[':q2'] = strtolower($main_region) ;
	 	$codeModel = States::model()->find($criteria);
		if(!empty($codeModel)){
			 
			   $this->model->state   = $codeModel->state_id ; 
			   $this->model->country = $codeModel->country_id ; 
			   
		}
		else{
	 
                $link = CHtml::link('Add Area',Yii::App()->createUrl('region/create',array('name'=>$value,'reg'=>$main_region)),array('target'=>'_blank'));
                  throw new CHttpException(503, '<b>'.$value.'</b> Area  not defined .Click here to add area. and continue '.$link);

			 
		}
	}
	 
	public function findSection($section=null){
	    switch($section){
	        case 'sale':
	        $this->model->section_id = '1';
	        break;
	         case 'buy':
	        $this->model->section_id = '1';
	        break;
	        case 'rent':
	        $this->model->section_id = '2';
	        break;
	        default:
	            throw new CHttpException(503, 'Section not defined '.$section);
	          break;   
	    }
	}
	
	public function offering_type($type=null){
		switch($type){
		case 'CS':
		$this->model->section_id = '1';
		$this->model->listing_type = 'C';
		break; 
		case 'CR' :
		$this->model->section_id = '2';
		$this->model->listing_type = 'C';
		break; 
		case 'RS' :
		$this->model->section_id = '1';
		$this->model->listing_type = 'R';
		break; 
		case 'RR' :
		$this->model->section_id = '2';
		$this->model->listing_type = 'R';
		break; 
		default:
		$this->model->section_id = '1';
		$this->model->listing_type = 'C';
		break;
		}
	}
	public function setAgent($details){
		if(!empty($details) and is_array($details)){
			if(isset($details['name'])){
				$this->model->agent_name = $details['name'];
			}
			if(isset($details['email'])){
				$this->model->agent_email = $details['email'];
			}
			if(isset($details['phone'])){
				$this->model->agent_phone = $details['phone'];
			}
			if(isset($details['license_no'])){
				$this->model->agent_licence_number = $details['license_no'];
			}
		}
	 
	}
	public function setLocation($details){
		
		 
				$ar = explode(',',$details); 
		 		$this->model->location_latitude  = $ar[0];
		 		$this->model->location_longitude = $ar[1];
			 
	}
	public $amenitites_array ;
	public function findAmenity($value=null){
	    $text_value = '';
        if (strpos($value, ':') !== false) {
            return false; 
        $ari = explode(':',$value);
        $value = $ari['0'];$text_value = $ari['1'];
        }
	  	$criteria = new CDbCriteria;
		$criteria->select = 't.amenities_id';
		$criteria->compare("REPLACE(REPLACE(LOWER(t.amenities_name), '\r', ''), '\n', '')",strtolower($value)); 
		$codeModel = Amenities::model()->find($criteria);
		if(!empty($codeModel)){
			 
			  $this->amenitites_array[] = $codeModel->amenities_id ; 
			 
		}
		else{
			 
			$categoryModel = new Amenities(); 
			$categoryModel->amenities_name = $value;
			$categoryModel->f_type = 0;
			$categoryModel->master_id = 99;
			if($categoryModel->save()){
				$this->amenitites_array[] = $categoryModel->amenities_id ; 
			}
			
		}
		 
	} 
	public function setAmenitites($ar){	
				 
				if(!empty($ar)){
					foreach($ar as $amenit){
						$this->findAmenity($amenit);
					}
				}
			 
				if(!empty($this->amenitites_array)){
					$this->model->amenities_fields = $this->amenitites_array;
				}
			 
	}
	public function setPhoto($details){
		$ar = array(); 
		if(!empty($details) and isset($details['url']) and is_array($details['url'])){ 
			foreach($details['url'] as $image_link){
				$ar[] = $image_link; 
			}
		}
		$this->model->image = $ar ; 
	 
	}
	public function findCategory($code=null){
	 
		$codeModel = Category::model()->findByAttributes(array('short_name'=>$code));
		if(!empty($codeModel)){
			 
			  $this->model->category_id = $codeModel->category_id ; 
		}
		else{
			 
			$categoryModel = new Category();
			$categoryModel->category_name = $code;
			$categoryModel->short_name    = $code;
			if($categoryModel->save()){
				$this->model->category_id = $categoryModel->category_id ; 
			}
			else{
				throw new CHttpException(503, 'Unable to save category'.$code);
			}
		}
	}
	public function findCommunity($value=null){
 
	  	$criteria = new CDbCriteria;
		$criteria->select = 't.community_id';
		$criteria->compare('LOWER(community_name)',strtolower($value)); 
		$criteria->join   = " LEFT  JOIN {{district}} dt on dt.district_id = t.district_id and dt.city_id = :city_id   "; 
		$criteria->params[':city_id'] =  $this->model->city ; 
		$criteria->condition    .= ' and CASE WHEN t.city_id IS NOT NULL THEN t.city_id = :city_id ELSE dt.district_id IS NOT NULL END '; 
		
		$codeModel = Community::model()->find($criteria);
		if(!empty($codeModel)){
			 
			  $this->model->community_id = $codeModel->community_id ; 
			 
		}
		else{
			 
			$categoryModel = new Community('city_insert');
			$categoryModel->setscenario('city_insert');
			$categoryModel->community_name = $value;
			$categoryModel->city_id    =  $this->model->city;
			if($categoryModel->save()){
				$this->model->community_id = $categoryModel->community_id ; 
			}
			else{
				 
				throw new CHttpException(503, 'Unable to save community'.$value);
			}
		}
		 
	}
	public function findSubCommunity($value=null){
  
	  	$criteria = new CDbCriteria;
		$criteria->select = 't.sub_community_id';
		$criteria->compare('LOWER(sub_community_name)',strtolower($value)); 
		$criteria->params[':community_id'] =  $this->model->community_id  ; 
		$criteria->condition    .= ' and  t.community_id = :community_id '; 
		
		$codeModel = SubCommunity::model()->find($criteria);
		if(!empty($codeModel)){
			 
			  $this->model->sub_community_id = $codeModel->sub_community_id ; 
			 
		}
		else{
			 
			$categoryModel = new SubCommunity();
			$categoryModel->sub_community_name = $value;
			$categoryModel->community_id    =  $this->model->community_id ;
			if($categoryModel->save()){
				$this->model->sub_community_id = $categoryModel->sub_community_id ; 
				 
			}
			else{
				 
				throw new CHttpException(503, 'Unable to save sub community'.$value);
			}
		}
		 
	}
	 
	public function findCity($value=null){
		$criteria = new CDbCriteria;
		$criteria->select = 't.city_id,t.state_id,st.country_id';
		$criteria->compare('LOWER(city_name)',strtolower($value)); 
		$criteria->join   = " INNER JOIN {{states}} st on st.state_id = t.state_id "; 
		$codeModel = City::model()->find($criteria);
		if(!empty($codeModel)){
			 
			   $this->model->city   = $codeModel->city_id ; 
			   $this->model->state   = $codeModel->state_id ; 
			   $this->model->country = $codeModel->country_id ; 
			   
		}
		else{
			 
				throw new CHttpException(503, 'No States Found on Database '.$code);
			 
		}
	}
    
	public function xmlObjToArr($obj) {
        $namespace = $obj->getDocNamespaces(true);
        $namespace[NULL] = NULL;
       
        $children = array();
        $attributes = array();
        $name = strtolower((string)$obj->getName());
       
        $text = trim((string)$obj);
        if( strlen($text) <= 0 ) {
            $text = NULL;
        }
       
        // get info for all namespaces
        if(is_object($obj)) {
            foreach( $namespace as $ns=>$nsUrl ) {
                // atributes
                $objAttributes = $obj->attributes($ns, true);
                foreach( $objAttributes as $attributeName => $attributeValue ) {
                    $attribName = strtolower(trim((string)$attributeName));
                    $attribVal = trim((string)$attributeValue);
                    if (!empty($ns)) {
                        $attribName = $ns . ':' . $attribName;
                    }
                    $attributes[$attribName] = $attribVal;
                }
               
                // children
                $objChildren = $obj->children($ns, true);
                foreach( $objChildren as $childName=>$child ) {
                    $childName = strtolower((string)$childName);
                    if( !empty($ns) ) {
                        $childName = $ns.':'.$childName;
                    }
                    
                   
                    $children[$childName][] = $this->xmlObjToArr($child);
                }
            }
        }
       
        return array(
            'name'=>$name,
            'text'=>$text,
            'attributes'=>$attributes,
            'children'=>$children
        );
    } 
    
 }
