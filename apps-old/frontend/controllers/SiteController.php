<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class SiteController extends Controller
{
 
	public function init(){
	  
	$json = '{"Afghanistan":"AF","Albania":"AL","Algeria":"DZ","American Samoa":"AS","Andorra":"AD","Angola":"AO","Anguilla":"AI","Antarctica":"AQ","Antigua and Barbuda":"AG","Argentina":"AR","Armenia":"AM","Aruba":"AW","Australia":"AU","Austria":"AT","Azerbaijan":"AZ","Bahamas":"BS","Bahrain":"BH","Bangladesh":"BD","Barbados":"BB","Belarus":"BY","Belgium":"BE","Belize":"BZ","Benin":"BJ","Bermuda":"BM","Bhutan":"BT","Bolivia":"BO","Bosnia and Herzegowina":"BA","Botswana":"BW","Bouvet Island":"BV","Brazil":"BR","British Indian Ocean Territory":"IO","Brunei Darussalam":"BN","Bulgaria":"BG","Burkina Faso":"BF","Burundi":"BI","Cambodia":"KH","Cameroon":"CM","Canada":"CA","Cape Verde":"CV","Cayman Islands":"KY","Central African Republic":"CF","Chad":"TD","Chile":"CL","China":"CN","Christmas Island":"CX","Cocos (Keeling) Islands":"CC","Colombia":"CO","Comoros":"KM","Congo":"CG","Cook Islands":"CK","Costa Rica":"CR","Cote D\'Ivoire":"CI","Croatia":"HR","Cuba":"CU","Cyprus":"CY","Czech Republic":"CZ","Denmark":"DK","Djibouti":"DJ","Dominica":"DM","Dominican Republic":"DO","East Timor":"TP","Ecuador":"EC","Egypt":"EG","El Salvador":"SV","Equatorial Guinea":"GQ","Eritrea":"ER","Estonia":"EE","Ethiopia":"ET","Falkland Islands (Malvinas)":"FK","Faroe Islands":"FO","Fiji":"FJ","Finland":"FI","France":"FR","France, Metropolitan":"FX","French Guiana":"GF","French Polynesia":"PF","French Southern Territories":"TF","Gabon":"GA","Gambia":"GM","Georgia":"GE","Germany":"DE","Ghana":"GH","Gibraltar":"GI","Greece":"GR","Greenland":"GL","Grenada":"GD","Guadeloupe":"GP","Guam":"GU","Guatemala":"GT","Guinea":"GN","Guinea-bissau":"GW","Guyana":"GY","Haiti":"HT","Heard and Mc Donald Islands":"HM","Honduras":"HN","Hong Kong":"HK","Hungary":"HU","Iceland":"IS","India":"IN","Indonesia":"ID","Iran (Islamic Republic of)":"IR","Iraq":"IQ","Ireland":"IE","Israel":"IL","Italy":"IT","Jamaica":"JM","Japan":"JP","Jordan":"JO","Kazakhstan":"KZ","Kenya":"KE","Kiribati":"KI","North Korea":"KP","Korea, Republic of":"KR","Kuwait":"KW","Kyrgyzstan":"KG","Lao People\'s Democratic Republic":"LA","Latvia":"LV","Lebanon":"LB","Lesotho":"LS","Liberia":"LR","Libyan Arab Jamahiriya":"LY","Liechtenstein":"LI","Lithuania":"LT","Luxembourg":"LU","Macau":"MO","FYROM":"MK","Madagascar":"MG","Malawi":"MW","Malaysia":"MY","Maldives":"MV","Mali":"ML","Malta":"MT","Marshall Islands":"MH","Martinique":"MQ","Mauritania":"MR","Mauritius":"MU","Mayotte":"YT","Mexico":"MX","Micronesia, Federated States of":"FM","Moldova, Republic of":"MD","Monaco":"MC","Mongolia":"MN","Montserrat":"MS","Morocco":"MA","Mozambique":"MZ","Myanmar":"MM","Namibia":"NA","Nauru":"NR","Nepal":"NP","Netherlands":"NL","Netherlands Antilles":"AN","New Caledonia":"NC","New Zealand":"NZ","Nicaragua":"NI","Niger":"NE","Nigeria":"NG","Niue":"NU","Norfolk Island":"NF","Northern Mariana Islands":"MP","Norway":"NO","Oman":"OM","Pakistan":"PK","Palau":"PW","Panama":"PA","Papua New Guinea":"PG","Paraguay":"PY","Peru":"PE","Philippines":"PH","Pitcairn":"PN","Poland":"PL","Portugal":"PT","Puerto Rico":"PR","Qatar":"QA","Reunion":"RE","Romania":"RO","Russian Federation":"RU","Rwanda":"RW","Saint Kitts and Nevis":"KN","Saint Lucia":"LC","Saint Vincent and the Grenadines":"VC","Samoa":"WS","San Marino":"SM","Sao Tome and Principe":"ST","Saudi Arabia":"SA","Senegal":"SN","Seychelles":"SC","Sierra Leone":"SL","Singapore":"SG","Slovak Republic":"SK","Slovenia":"SI","Solomon Islands":"SB","Somalia":"SO","South Africa":"ZA","South Georgia & South Sandwich Islands":"GS","Spain":"ES","Sri Lanka":"LK","St. Helena":"SH","St. Pierre and Miquelon":"PM","Sudan":"SD","Suriname":"SR","Svalbard and Jan Mayen Islands":"SJ","Swaziland":"SZ","Sweden":"SE","Switzerland":"CH","Syrian Arab Republic":"SY","Taiwan":"TW","Tajikistan":"TJ","Tanzania, United Republic of":"TZ","Thailand":"TH","Togo":"TG","Tokelau":"TK","Tonga":"TO","Trinidad and Tobago":"TT","Tunisia":"TN","Turkey":"TR","Turkmenistan":"TM","Turks and Caicos Islands":"TC","Tuvalu":"TV","Uganda":"UG","Ukraine":"UA","United Arab Emirates":"AE","United Kingdom":"GB","United States":"US","United States Minor Outlying Islands":"UM","Uruguay":"UY","Uzbekistan":"UZ","Vanuatu":"VU","Vatican City State (Holy See)":"VA","Venezuela":"VE","Viet Nam":"VN","Virgin Islands (British)":"VG","Virgin Islands (U.S.)":"VI","Wallis and Futuna Islands":"WF","Western Sahara":"EH","Yemen":"YE","Yugoslavia":"YU","Democratic Republic of Congo":"CD","Zambia":"ZM","Zimbabwe":"ZW"}';
	$ar = json_decode($json );
	$model= new Countries();
	foreach($ar as $k=>$v){
		$criteria=new CDbCriteria;
		$criteria->condition = ' 1 and LOWER(t.country_name) = :cn ';
		$criteria->params[':cn'] = strtolower($k);
		
		$found = Countries::model()->find($criteria);
		 if($found){
			 Countries::model()->updateByPk($found->primaryKey,array('cords'=>$v)); 
			 
		 }
		  
	}
	exit;
	  parent::Init();
        // register class paths for extension captcha extended
        Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
    }
    
     
	public $default_country_id;
	public $default_country_slug;
	public $system_defaultt_country_id;
	public $banners;
	
	
    public function actionIndex()
    {  
		echo "Herere"; exit;

    	$this->header_class ='headers';
    	$listContries  = Countries::model()->list_array_country();
    	if(!isset($listContries[$this->default_country])){
    			$this->default_country = $this->options->get('system.common.default_listing_country');
    	} 	
    	$this->default_country_id = @$listContries[$this->default_country]['country_id']; 
    	$this->default_country_slug = @$listContries[$this->default_country]['slug']; 
    	$default_country_name = @$listContries[$this->default_country]['country_name']; 
    	 
    	$this->system_defaultt_country_id = @$listContries[$this->options->get('system.common.default_listing_country')]; 
     	$this->banners = HomeBanner::model()->fetchBanners($this->default_country_id,$this->system_defaultt_country_id);
      
         
        print_r($fav_communities);exit; 
        $featued_banners = AdvertisementItems::model()->home_featured_banner();
        if(!empty($featued_banners)){
        $featured_text = AdvertisementLayout::model()->featured_text();
    	}
        
        $advertisement_layout = AdvertisementLayout::model()->findHomeAdvertisementLayout();
    
    	$this->setData(array(
    	'pageTitle'         =>  '' , 
    	)); 
    	$this->getData('pageStyles')->mergeWith(array(array('src' =>    $this->appAssetUrl('css/colors/main.css'), 'priority' => -999)));
    	$countries_list =  Countries::model()->cacheListingCountries();
    	$this->render( 'index',compact('countries_list','default_country_name','featued_banners','featured_text','advertisement_layout'));
    }
    
    
    public function actionLoad_data($country_id=null,$state_id=null)
    {
		 
			if(empty($state_id)){
				$country = Countries::model()->findByPk($country_id);
			 
			}
			else{
				$state = States::model()->findByPk($state_id);
			}
			
			$new_developments  = PlaceAnAd::model()->newDevelopments($country_id,$state_id,8);
			$featured_developments = PlaceAnAd::model()->faturedProjects($country_id,$state_id,3,PlaceAnAd::NEW_ID);
			$new_homes         = PlaceAnAd::model()->new_homes($country_id,$state_id,4,PlaceAnAd::SALE_ID);
			$new_properties_forrent         = PlaceAnAd::model()->new_homes($country_id,$state_id,4,PlaceAnAd::RENT_ID);
			/* $property_of_featured_developers         = Developer::model()->featured_developers($country_id,$state_id,2,0,true); */
			$not_in =array();
			if(!empty($property_of_featured_developers)){
				foreach($property_of_featured_developers as $k=>$v){
					$not_in[] = $v->user_id ;
				}
			}
			
			$featured_developers         = Developer::model()->featured_developers($country_id,$state_id,8,$not_in);
			 
			if(empty($new_developments) and  empty($featured_projects) and  empty($new_homes) and  empty($new_properties_forrent) and  empty($property_of_featured_developers) and  empty($featured_developers) ){ 
				echo 1; Yii::app()->end();
			}
			$this->renderPartial( '_ajax_render_items',compact('featured_developments','country','state','new_developments','featured_projects','new_homes','new_properties_forrent','featured_developers','property_of_featured_developers'));
		 
		 
    }
    public function actionLoad_data_ads($layout_id=null)
    {
		 
		    $model = AdvertisementLayout::model()->findByPk($layout_id);
			if(empty($model) ){ 
				echo 1; Yii::app()->end();
			}
			$criteria=new CDbCriteria;
			$criteria->select = 't.*, ad.section_id,ad.slug as ad_slug,ban.link_url as banner_slug , art.slug as blog_slug  , ad.ad_description as ad_description, ad.ad_title as ad_title,ban.title as banner_title , art.title as blog_title  , ad.ad_description as ad_description,ban.description as banner_description , art.content as blog_description  ,  (CASE WHEN  t.section = "A" THEN  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.ad_id and  img.status="A" and  img.isTrash="0"  limit 1  )  WHEN t.section = "B" THEN ban.image  ELSE 0 END ) as      ad_image ';
			$criteria->join  .= ' left join {{place_an_ad}} ad ON ad.id = t.ad_id  ';
			$criteria->join  .= ' left join {{banner}} ban ON ban.banner_id = t.banner_id ';
			$criteria->join  .= ' left join {{article}} art ON art.article_id = t.article_id ';
			$criteria->condition  .= ' 1  and  t.layout_id = :layout_id ';
			$criteria->order   = 't.row_id asc';
			$criteria->params[':layout_id']   = $model->primaryKey ;
			$data = AdvertisementItems::model()->findAll($criteria);
			if(empty($data)){
				echo 1; Yii::app()->end();
			}
			$this->renderPartial( 'ad/add_values',compact('model','data'));
			Yii::App()->end();
		 
		 
    }
    
    public function actionOffline()
    {
        if (Yii::app()->options->get('system.common.site_status') !== 'offline') {
            $this->redirect(array('site/index'));
        }
        
        throw new CHttpException(503, Yii::app()->options->get('system.common.site_offline_message'));
    }
    
    public function actionError()
    {
		//$this->layout =   Yii::app()->LayoutClass->layoutpath("sub"); 
		//$this->headerImage  =  Yii::app()->theme->baseUrl.'/images/404.jpg';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo CHtml::encode($error['message']);
            } else {
                $this->setData(array(
                    'pageTitle'         => Yii::t('app', 'Error {code}!', array('{code}' => $error['code'])), 
                    'pageMetaDescription'   => $error['message'],
                ));
                $this->render( "error" ,  compact('error')) ;
            }    
        }
    }
    public function actionSocial()
    {
		$this->render("social");
	}
  public function actionDistrict(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
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
  public function actionLocation(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
	 	$json = file_get_contents('php://input');
	 
		$obj = json_decode($json );
		 
		$string = str_replace('\\','',@$obj->textKeyword); 
		 
		  if(Yii::app()->request->cookies['country_id']->value!=0)
		  {
			 
			 $criteria->with['city'] =array('with'=>array('state'=>array('with'=>'con','condition'=>'con.country_id=:countryID','params'=>array(':countryID'=>Yii::app()->request->cookies['country_id']->value)),"together"=>true));
		  }
		   
		$criteria->compare('LOWER(district_name)',strtolower($string) ,true);
		$count = District::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = District::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('LocationName'=>$v->district_name);
			}
		}
        $record =  $ar  ;
         
		echo  json_encode( $record ); Yii::app()->end();
	}
  public function actionChangeCountry($id=null){
		$country = Countries::model()->findByAttributes(array('country_id'=>$id,'show_on_listing'=>'1','isTrash'=>'0'));
		if(!empty($country)){
					$cookie = new CHttpCookie('country_name', $country->country_name);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_name'] = $cookie;
					
					$cookie = new CHttpCookie('country_id', $country->country_id);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['country_id'] = $cookie;
					$cookie = new CHttpCookie('flag', $country->flag);
					$cookie->expire = time()+60*60*24*180; 
					Yii::app()->request->cookies['flag'] = $cookie;
		 }
         
         $this->redirect(Yii::app()->apps->getBaseUrl(''));
         Yii::app()->end();
		 
	}
	public function actionSendEnquiry(){
		$request    = Yii::app()->request;
		$model  = new SendEnquiry();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  print_r($model->getErrors());Yii::app()->end();
			  }
			  else{
				  echo "1";Yii::app()->end();
			  }
		 
		}
	}
	public function actionValidateEnquiry(){
		$model = new SendEnquiry;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	}
	   public function actionLoadStates()
	{
	   $id=null;
	   if(isset($_REQUEST['country_id'])){ $id =$_REQUEST['country_id'];  }
	 
	   $data=States::model()->getStateWithCountry_2($id);
	   $data=CHtml::listData($data,'state_id','state_name');
	   echo "<option value=''>Select Region</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
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
		echo  json_encode( $record ); Yii::app()->end();
		 
	 
	}
	public function actionImpersonate($id)
	{
		
			 
		if(!strpos(Yii::app()->request->urlReferrer,'backend'))
		{
		   throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		 
		$user = ListingUsers::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
     
	    $identity = new UserIdentity($user->email, null);
        $identity->impersonate = true;
		
		
        if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
            $notify->addError(Yii::t('app', 'Unable to impersonate the customer!'));
            $this->redirect(array('user/signin'));    
        }
        $this->redirect(array('member/dashboard'));
	}
	 public function actionImage_crop(){
		
 
		 			
		 			$newArray = (object) array(
		 			'x'=> $_GET['imgX5'],
		 			'y'=> $_GET['imgY5'],
		 			'height'=>$_GET['widthY'] ,
		 			'width'=> $_GET['widthX'],
		 			'cropW'=> $_GET['cropW'],
		 			'cropH'=> $_GET['cropH'],
		 			'rotate'=> $_GET['rotate'] ,
		 			);
		 			
		 		 
		 			
					$ext  = pathinfo($_GET['imgUrl'], PATHINFO_EXTENSION);
					$file = pathinfo($_GET['imgUrl'] , PATHINFO_FILENAME);
					$src   =  $file.'.'.$ext;  
					$tempPath = Yii::getPathOfAlias('root.uploads.images');  
					$tempPath2 = Yii::getPathOfAlias('root.uploads.resized');  
					$src =  $tempPath .'/'.$src ;
					$output_filename = $tempPath2."/".$file.'.'.$ext;  
					$response = $this->crop($src, $output_filename,$newArray) ; 
					echo json_encode($response);exit;
					 
	}
	public $src;
	public $type;
	public $extension;

	 public function crop( $src,  $dst, $data) {
	  
	 
	if (!empty($src)) {
	$type = exif_imagetype($src);

	if ($type) {
	$this -> src = $src;
	$this -> type = $type;
	$this -> extension = image_type_to_extension($type);

	}
	}  	
			 
	  
	  
    if (!empty($src) && !empty($dst) && !empty($data)) {
      switch ($this -> type) {
        case IMAGETYPE_GIF:
     
          $src_img = imagecreatefromgif($src);
          break;

        case IMAGETYPE_JPEG:
      
          $src_img = imagecreatefromjpeg($src);
          break;

        case IMAGETYPE_PNG:
          $src_img = imagecreatefrompng($src);
          break;
      }

      if (!$src_img) {
        $this -> msg =  array('status'=>'failed','message'=>"Failed to read the image file")  ;  ;
        return;
      }

      $size = getimagesize($src);
      $size_w = $size[0]; // natural width
      $size_h = $size[1]; // natural height
      
      

      $src_img_w = $size_w;
      $src_img_h = $size_h;

      $degrees = $data -> rotate;

      // Rotate the source image
      if (is_numeric($degrees) && $degrees != 0) {
        // PHP's degrees is opposite to CSS's degrees
        $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

        imagedestroy($src_img);
        $src_img = $new_img;

        $deg = abs($degrees) % 180;
        $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

        $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
        $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

        // Fix rotated image miss 1px issue when degrees < 0
        $src_img_w -= 1;
        $src_img_h -= 1;
      }

      $tmp_img_w = $data -> width;
      $tmp_img_h = $data -> height;
      $dst_img_w =  $data -> cropW;
      $dst_img_h =  $data -> cropH;

      $src_x = $data -> x;
      $src_y = $data -> y;

      if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
        $src_x = $src_w = $dst_x = $dst_w = 0;
      } else if ($src_x <= 0) {
        $dst_x = -$src_x;
        $src_x = 0;
        $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
      } else if ($src_x <= $src_img_w) {
        $dst_x = 0;
        $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
      }

      if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
        $src_y = $src_h = $dst_y = $dst_h = 0;
      } else if ($src_y <= 0) {
        $dst_y = -$src_y;
        $src_y = 0;
        $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
      } else if ($src_y <= $src_img_h) {
        $dst_y = 0;
        $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
      }

      // Scale to destination position and size
      $ratio = $tmp_img_w / $dst_img_w;
      $dst_x /= $ratio;
      $dst_y /= $ratio;
      $dst_w /= $ratio;
      $dst_h /= $ratio;

      $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

      // Add transparent background to destination image
      if($this->type ==  IMAGETYPE_PNG ){
		imageAlphaBlending($dst_img, false);
		imageSaveAlpha($dst_img, true);
		imagefilledrectangle($dst_img, 0, 0, $dst_img_w, $dst_img_h, imagecolorallocate($dst_img, 255, 255, 255));
	  }

      $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
 
		 
      if ($result) {
        if (!imagejpeg($dst_img, $dst,'100'  )) {
		   return     array('status'=>'failed','message'=>'unable to save')  ; 
        }
        else{
			$ext  = pathinfo($dst, PATHINFO_EXTENSION);
			$file = pathinfo($dst , PATHINFO_FILENAME);
			$image = $file.'.'.$ext;
			$thumbUrl =   Yii::app()->apps->getBaseUrl('timthumb.php').'?src='.Yii::app()->apps->getBaseUrl('uploads/posts/'.$image).'&w=83&h=60&zc=1';
            return array('status'=>'success','url'=>$image , 'thumbUrl' => $thumbUrl ) ; 
		}
      } else {
			return     array('status'=>'failed','message'=>'unable to save')  ; 
      }

      imagedestroy($src_img);
      imagedestroy($dst_img);
    }
  }
   public function actionLogin() {
		$serviceName = Yii::app()->request->getQuery('service');
		
		if (isset($serviceName)) {
			/** @var $eauth EAuthServiceBase */
			switch($serviceName){
				case 'google_oauth' : 
				$componentArray = array(
						'client_id'		=>		 Yii::app()->options->get('system.common.google_app_id',''),
						'client_secret'	=>		Yii::app()->options->get('system.common.google_client_secret',''),
					//	'scope' => 'https://www.googleapis.com/auth/userinfo.profile',
				
				);
				break;
				case 'facebook' : 
				$componentArray = array( 
						'client_id'		=>		 Yii::app()->options->get('system.common.facebook_app_id',''),
						'client_secret'	=>		Yii::app()->options->get('system.common.facebook_seceret_key','')
				
				);
				break;
			}
			/** @var $eauth EAuthServiceBase */
			$eauth = Yii::app()->eauth->getIdentity($serviceName, $componentArray );
			$eauth->redirectUrl = $this->createAbsoluteUrl('site/login').'?service=$serviceName';
			$eauth->cancelUrl = $this->createAbsoluteUrl('user/signin');

			try {
				if ($eauth->authenticate()) {
					 $eauth->redirectUrl =   Yii::app()->createAbsoluteUrl('member/dashboard')  ;  
					 if(isset($eauth->email)){
					     $model = new ListingUsers();
					     $registered = $model->findByEmail($eauth->email);
					     
					    
					     if($registered)
						{
								$identity = new UserIdentity($registered ->email, null);
								$identity->impersonate = true;
								if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
								 	echo '<script>alert("Unable to login.")</script>';
									$eauth->cancel();
								}
								else{
								
								 
								        $eauth->redirect();
								
									
								}

						}
						else{
						    
                            $this->setData(array(
                            'pageTitle'         => 'Register' , 
                            'pageMetaDescription'   =>  'Register' ,
                            ));
                            $redirect_url =    Yii::app()->createAbsoluteUrl('member/dashboard')  ;
						    $this->render('reg_type',compact('eauth','redirect_url','serviceName'));
						    exit;
					       
						}
					 }
					 else{
					 
					  		echo '<script>alert("Not Receiving Registered Email Address From your account.")</script>';
							 $eauth->cancel();
					 }
					  
					
					 
					 
				}

				// Something went wrong, redirect to login page
				$this->redirect(array('site/login'));
			}
			catch (EAuthException $e) {
				// save authentication error to session
				Yii::app()->user->setFlash('error', 'EAuthException: '.$e->getMessage());

				// close popup window and redirect to cancelUrl
				$eauth->redirect($eauth->getCancelUrl());
			}
		}

		// default authorization code through login/password ..
	}
	 public function actionLoadCityByCountry($country_id=null){
        $data = States::model()->findListingCountries($country_id);
        $html = '<option value="">Select Region</option>';
        if($data){
			foreach($data as $k=>$v){
				 $html .= '<option value="'.$v->slug.'">'.$v->state_name .'</option>';
			}
		} 
		echo $html; Yii::app()->end();	
	 
	}
	public function actionPopulating_data(){
       echo "WER";exit; 
        $formData = (array)$_GET; $formData =array_filter($formData);
       	$datae = Category::model()->listing_page_count();
	// print_r($formData);exit; 
	//	 print_r(CHtml::listData($datae,'category_id','category_name'));exit;
	
	
 
	
	
		    $adModel = new PlaceAnAd();
		    
		    
		    $htm = '';
		   
		    if(!isset($formData['state'])){
		        $htm = $this->renderPartial('_list_cities',compact('formData','adModel'),true,false);
		    }else if(isset($formData['state']) and !isset($formData['l'])){
		        $htm = $this->renderPartial('_list_location',compact('formData','adModel'),true,false);
		    }else if(isset($formData['l']) and !isset($formData['type'])){
		        $htm = $this->renderPartial('_list_categories',compact('formData','adModel'),true,false);
		    }
			
			//$htm = $this->renderPartial('_list_categories',compact('new_homes','formData'),true,false);
			
		 
			//Yii::app()->cache->set($cacheKey, $htm,60 * 15  );
			//print_r(CHtml::listData($new_homes,'category_name','id'));exit;
			
			
			if(!empty($htm)){
				
				  echo json_encode(array('status'=>'1','html'=>$htm));
				  exit;
				
				}
				else{
					
					echo   json_encode(array('status'=>'0','html'=>''));exit;
				}
			
		  
		echo json_encode($data);exit;
		
	}
}
