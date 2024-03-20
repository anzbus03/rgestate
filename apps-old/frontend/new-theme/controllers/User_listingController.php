<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class User_listingController extends Controller
{
   
	public function init(){
	 
	  parent::Init();
       
    }
      public function actionHome()
    {  
 
 	$this->banners = AgentBanner::model()->fetchBanners($this->default_country_id,$this->system_defaultt_country_id);
   
    $apps = Yii::App()->apps;
    			$this->getData('pageStyles')->add(array('src' =>  $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' =>  $apps->getBaseUrl('assets/js/select2.min.js')));

	$this->setData(array(
	'pageTitle'         =>  $this->options->get('system.common.agent_meta_title','') , 
	)); 
	 
	  $this->boxshdw = '1';
	   $this->sec_id ='agents';
	   		$criteria =  ListingUsers::model()->findAgents(array(),false, '' ,1);
		$criteria->addInCondition('t.user_type', array ('C','D','A'));
		$criteria->compare('t.featured', 'Y');
		$criteria->limit = '16';
		$criteria->order = ' -t.priority desc , t.first_name asc  ';
		$featred_agencies  = ListingUsers::model()->findAll($criteria);
	$this->render( 'home',compact('countries_list','default_country_name','featued_banners','featured_text','advertisement_layout','featred_agencies'));
	
	
    }
	 
     public function actionIndex($user_type='',$country=null,$type=null,$agent_regi=null,$reg=null,$agent_language=null)
    {   
		
		 
	    $this->sec_id ='agents'; 
		$formData = (array) $_GET;
		$title  = COUNTRY_NAME;
		if(!empty($formData['region'])){
			$stateModel =  States::model()->findByAttributes(array('slug'=>$formData['region']));
			if(empty($stateModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
	 
			$title  =  $stateModel->state_name; 
		 }
		 
		$limit = 10 ; 
		$formData['enable_li'] = '1'; 
		$criteria =  ListingUsers::model()->findAgents($formData,false, $user_type,1);
		$criteria->compare('t.enable_l_f','');
		$adsCount  = ListingUsers::model()->count($criteria);
		$pages = new CPagination($adsCount);
		$pages->pageSize = $limit ;  
		$pages->applyLimit($criteria);
		$ads = Listingusers::model()->findAll($criteria);

		 
		 		 
		$apps = $this->app->apps;
	 	$this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Agents Listing  :: {project} ', array('{project}' =>$this->options->get('system.common.site_name') )), 
		'_show_agent'     =>   '1', 
		));
		 $newMetaTitle = $this->app->options->get('system.common.agentpage_meta_title','Agents');
		 $newMetaKeywords = $this->app->options->get('system.common.agentpage_meta_keywords');
		 $newMetaDescription = $this->app->options->get('system.common.agentpage_meta_description');
		$this->setData(array(
		'pageMetaTitle'     =>  Yii::t('app',  'Agents' .'  | {project} ', array('{project}' =>$this->project_name )), 
		'pageTitle'     =>  Yii::t('app',  'Agents' .'  | {project} ', array('{project}' =>$this->project_name )), 
		'newMetaTitle' => $newMetaTitle,         
		'pageMetaTitle' => $newMetaTitle,         
		'newMetaKeywords' => $newMetaKeywords,         
		'pageMetaKeywords' => $newMetaKeywords,         
		'newMetaDescription' => $newMetaDescription,         
		'pageMetaDescription' => $newMetaDescription,         
		));
		 $apps = Yii::App()->apps;
    			 
		if($this->app->request->isAjaxRequest){
		 
			unset($formData['_pjax']);
			unset($formData['_']);
			$this->renderPartial( 'index_new',compact('user_type','countryModel','ads','tags', 'formData','limit', 'adsCount' ,'title','agent_regi','agent_language'));
			$this->app->end();
		}
		
		 
		$this->render( 'index_new',compact('user_type','countryModel','ads','tags', 'formData', 'adsCount' ,'limit','title','agent_regi','agent_language'));
		 
    }
    
	public $default_country_id;
	public $default_country_slug;
	public $system_defaultt_country_id;
	public $banners; 

    public function actionFind($user_type='A')
    {   
		
		if(empty($user_type)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if(!in_array($user_type,array('A','D'))){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		
		$listContries  = Countries::model()->list_array_country();
		if(!isset($listContries[$this->default_country])){
		$this->default_country = $this->options->get('system.common.default_listing_country');
		} 	
		$this->default_country_id = @$listContries[$this->default_country]['country_id']; 
		$this->default_country_slug = @$listContries[$this->default_country]['slug']; 
		$default_country_name = @$listContries[$this->default_country]['country_name']; 

		$this->system_defaultt_country_id = @$listContries[$this->options->get('system.common.default_listing_country')]; 
		$this->banners = AgentBanner::model()->fetchBanners($this->default_country_id,$this->system_defaultt_country_id);
		$model = new Agents();
		$model->scenario = 'find_step_1';
		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/_developer.css')));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
		 $this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Real Estate Agent Askaan'), 
		'pageMetaDescription' =>'We have listed real Estate agents for you according to your country that can help you in finding a dream home for you in your budget.',
	
		));
		$this->render( 'find_agent',compact('user_type','model'));
    }  
    public function actionDetail($slug=null)
    {  		
       
       $connection =  Yii::app()->getDb();
        $res = $connection->createCommand("SET SQL_BIG_SELECTS = 1")->execute();
		  $limit = 12; 
		  $limit_ad = 30;
		  $request = $this->app->request;
		  if($request->isAjaxRequest and isset($_GET['rend']) and $_GET['rend']=='agent_view' and isset($_GET['user']) ){
				$criteria=new CDbCriteria;
				$criteria->select = 't.*';
				$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id in ("1","2") ) as sale_total';
				$criteria->select .= ',des.master_name as role_id';
				$criteria->join   .= ' INNER JOIN {{master}} des on des.master_id = t.role_id    ';
				 $criteria->join  .=   ' LEFT   JOIN {{listing_users}} puser1 on puser1.user_id = t.parent_user ';
		    	$criteria->select  .= ',CASE WHEN puser1.user_id IS NOT NULL THEN puser1.image ELSE t.image END as company_image ';
				$criteria->compare('t.parent_user',(int) $_GET['user']);
				$criteria->compare('t.status','A');
				$teamsCount = ListingUserAgent::model()->count($criteria);
				
				$criteria->limit = $limit  ; 
				$pages = new CPagination($teamsCount);
				$pages->pageSize = $limit;
				$pages->applyLimit($criteria);
				$teams = ListingUserAgent::model()->findAll($criteria);
				echo json_encode(array('msgHtml'=>$this->renderPartial('//user_listing/_ajax_agents_list',compact('teams','pages'),true,false)));exit;

		  }
		  if($request->isAjaxRequest and isset($_GET['rend']) and $_GET['rend']=='property_view' and isset($_GET['user']) ){
				$criteria =  PlaceAnAd::model()->findAds(array('user_id'=>(int) $_GET['user']),false,1);
				$adsCount = PlaceAnAd::model()->count($criteria);
				$criteria->limit = $limit_ad  ; 
				$pagesad = new CPagination($adsCount);
				$pagesad->pageSize = $limit_ad;
				$pagesad->applyLimit($criteria);
				$ads = PlaceAnAd::model()->findAll($criteria);

				echo json_encode(array('msgHtml'=>$this->renderPartial('//user_listing/_ajax_properties_list',compact('ads','pagesad'),true,false)));exit;

		  }
	 
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name,st.state_name,st.slug as state_slug , p_usr.company_name as parent_company , p_usr.slug as parent_slug  ';
			$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id = "1" ) as sale_total';
				$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id =  "2" ) as rent_total';
			 	$criteria->select  .= ',CASE WHEN p_usr.user_id IS NOT NULL THEN p_usr.image ELSE t.image END as company_image ';
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type!','U');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state_id ';
			$criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = t.parent_user ';
			$criteria->join   .= ' LEFT JOIN {{master}} des on des.master_id = t.role_id    ';
        	$criteria->select .= ',des.master_name as role_id';
			$criteria->params[':slug'] = $slug;
			if(defined('LANGUAGE')){
			$langaugae = LANGUAGE;
			if(!empty($langaugae) and  $langaugae != 'en'){
				 
 	        $criteria->join  .= ' left join `mw_translate_relation` `translationRelation9` on translationRelation9.master_id = t.role_id   LEFT  JOIN mw_translation_data tdata9 ON (`translationRelation9`.translate_id=tdata9.translation_id and tdata9.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata9.message IS NOT NULL THEN tdata9.message ELSE des.master_name END as  role_id  ';
		    $criteria->select .= ' ,CASE WHEN p_usr.company_name_ar IS NOT NULL THEN  p_usr.company_name_ar ELSE  p_usr.company_name END as parent_company  ';
		
				$criteria->distinct   = 't.id';
				$criteria->params[':lan'] = $langaugae;
				
			}
			
			 
		}
		 
			$model = Agents::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$apps = $this->app->apps;
	         $hasedit = false; 
			if(Yii::app()->user->getId() and Yii::app()->user->getState("super_user",'0')=='1'){
			$hasedit = true; 
			}
		$this->setData(array(
		'pageTitle'         => Yii::t('app', '{name}', array('{name}' =>$model->fullName   ,'{p}'=> $this->options->get('system.common.site_name'))), 
		'pageMetaDescription'   => $model->ShortDescription,
		));
		
		$criteria=new CDbCriteria;
		$criteria->select = 't.*';
		$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id in ("1","2") ) as sale_total';
		$criteria->select .= ',des.master_name as role_id';
		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
		  if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.master_id = t.role_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN tdata.message ELSE des.master_name END as  role_id  ';
		 }
		$criteria->join   .= ' INNER JOIN {{master}} des on des.master_id = t.role_id    ';
		 $criteria->join  .=   ' LEFT   JOIN {{listing_users}} puser1 on puser1.user_id = t.parent_user ';
			$criteria->select  .= ',CASE WHEN puser1.user_id IS NOT NULL THEN puser1.image ELSE t.image END as company_image ';
		$criteria->compare('t.parent_user',(int) $model->user_id);
		$criteria->compare('t.status','A');
		$teamsCount = ListingUserAgent::model()->count($criteria);
		$criteria->limit = $limit  ; 
		$pages = new CPagination($teamsCount);
		$pages->pageSize = $limit;
		$pages->applyLimit($criteria);
		$teams = ListingUserAgent::model()->findAll($criteria);
	
		
		
		
		
	 
	$criteria =  PlaceAnAd::model()->findAds(array('user_id'=>(int) $model->user_id),false,1);
	$adsCount = PlaceAnAd::model()->count($criteria);
	$criteria->limit = $limit_ad  ; 
	$pagesad = new CPagination($adsCount);
	$pagesad->pageSize = $limit_ad;
	$pagesad->applyLimit($criteria);
	$ads = PlaceAnAd::model()->findAll($criteria);
	
		
		
		 if($this->app->request->isAjaxRequest){
		 	 unset($formData['_pjax']);
	 unset($formData['_']);
		// echo $file_view;exit;
			$this->renderPartial( 'detail_agency_new',compact('model','hasedit','teams','pages','teamsCount','adsCount','pagesad','ads'));
			$this->app->end();
	 }
	 
		$this->render( 'detail_agency_new',compact('model','hasedit','teams','pages','teamsCount','adsCount','pagesad','ads'));
    }
     public function actionDetail2($slug=null)
    {  		
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','C');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
        $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':slug'] = $slug;
			$model = Agents::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$apps = $this->app->apps;
	       $this->getData('pageStyles')->add(array('src' => $this->appAssetUrl('css/bootstrap.min.css'), 'priority' => -100));   
         	 $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js') ));
		$this->setData(array(
		'pageTitle'         => Yii::t('app', '{name}   :: {p}', array('{name}' =>'Agency '.$model->fullName   ,'{p}'=> $this->options->get('system.common.site_name'))), 
		'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render( 'detail_agencies',compact('model'));
    }
    public function actionFetch_user($count_future=true){
		$request = Yii::app()->request;
		 
		$formData = (array)$_GET ; 
	 	 $formData['enable_li'] = '1'; 
		$works =   ListingUsers::model()->findAgents($formData,$count_future,$user_type='');
		
		 
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
					 
							$msgHTML .= $this->renderPartial('//user_listing/_list_proprty',compact('works'),true); 
							if(!empty($count_future)){
							    if($total!=false){
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result,'total'=>$total));
								}
								else{
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result ));
								}
							}
							else{
								echo   $msgHTML; 
							}
		}
		else{
			echo '1'; 
		}
		Yii::app()->end();
	}
	  public function actionValidateEnquiry(){
		$model = new ContactAgent2;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	  public function actionValidateEnquiry2(){
		$model = new ContactAgent;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	  public function actionFind_agent_validate(){
		$model = new Agents();
		$model->scenario = 'find_step_1' ;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendEnquiry(){
		$request    = Yii::app()->request;
		$model  = new ContactAgent2();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
		public function actionSendEnquiry2(){
		$request    = Yii::app()->request;
		$model  = new ContactAgent();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
	
	  public function actionContact_agent($id=null,$user_id=null)
    {
 
  		$criteria=new CDbCriteria;
		$criteria->compare('user_id',(int)$id);
		$criteria->select = 't.*,st.state_name';
		$criteria->join = ' LEFT  JOIN {{states}} st ON  st.state_id = t.state_id ';
		$model  = ListingUsers::model()->find($criteria);
		$images  = array();  
		if( empty($model)){
			 throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		
			 
		}
		$cs=Yii::app()->clientScript;
		$cs->scriptMap=array(
		'jquery.js'=>  false , 
		'jquery.min.js'=>    false , 
		);
	  
        $this->renderPartial("//user_listing/_contact_agent" , compact('model'),false,true);  
       
    }
     public function actionDetail_developer($slug=null)
    {  		
		$this->layout = 'developer_layout';

	 
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name,st.state_name,st.slug as state_slug
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
			,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
			';
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
				$criteria->compare('t.premium','1');
			//$criteria->compare('t.user_type','D');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
			$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state_id ';
        $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			$criteria->params[':slug'] = $slug;
			$model = Agents::model()->find($criteria);
			
		 
			if(empty($model)){
				$this->redirect(Yii::app()->createUrl('site/index'));
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$apps = $this->app->apps;
	         $hasedit = false; 
			if(Yii::app()->user->getId() and Yii::app()->user->getState("super_user",'0')=='1'){
			$hasedit = true; 
			}
		$this->setData(array(
		'pageTitle'         => Yii::t('app', '{name}', array('{name}' =>$model->fullName   ,'{p}'=> $this->options->get('system.common.site_name'))), 
		'pageMetaDescription'   => $model->ShortDescription,
		
		));
		 if($this->app->request->isAjaxRequest){
		 	 unset($formData['_pjax']);
	 unset($formData['_']);
		// echo $file_view;exit;
			$this->renderPartial( 'detail_agent',compact('model','hasedit'));
			$this->app->end();
	 }
	 
		$this->render( 'detail_developer',compact('model','hasedit'));
    }
    public function actionReport_ad($id=null,$user_id=null)
    {
 
  		$criteria=new CDbCriteria;
		$criteria->compare('t.id',(int)$id);
		$model  = PlaceAnAd::model()->find($criteria);
		$images  = array();  
		if( empty($model)){
			 throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		
			 
		}
		$cs=Yii::app()->clientScript;
		$cs->scriptMap=array(
		'jquery.js'=>  false , 
		'jquery.min.js'=>    false , 
		);
	  
        $this->renderPartial("//user_listing/_report_ad" , compact('model'),false,true);  
       
    }
  public function actionValidateReport(){
		$model = new ReportAd;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	
	public function actionreportAd(){
		$request    = Yii::app()->request;
		$model  = new ReportAd();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			  $model->attributes = $attributes;
			  if(!$model->save()){
				  echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
				  Yii::app()->end();
			  }
			  else{
				  echo json_encode(array('status'=>'1','msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
				  Yii::app()->end();
			  }
		 
		}
	}
	  public function actionAgents($user_type='A',$country=null,$type=null,$agent_regi=null,$reg=null,$agent_language=null)
    {   
		
		 
	    $this->sec_id ='agents2'; 
		$formData = (array) $_GET;
		$title  = COUNTRY_NAME;
		if(!empty($formData['region'])){
			$stateModel =  States::model()->findByAttributes(array('slug'=>$formData['region']));
			if(empty($stateModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
	 
			$title  =  $stateModel->state_name; 
		 }
		 
		$limit = 10 ; 
		$formData['enable_li'] = '1'; 
		$criteria =  ListingUsers::model()->findAgents($formData,false, $user_type,1);
		$criteria->compare('t.enable_l_f','');
		$adsCount  = ListingUsers::model()->count($criteria);
		$pages = new CPagination($adsCount);
		$pages->pageSize = $limit ;  
		$pages->applyLimit($criteria);
		$ads = Listingusers::model()->findAll($criteria);

		 
		 		 
		$apps = $this->app->apps;
	 	$this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Agents Listing  :: {project} ', array('{project}' =>$this->options->get('system.common.site_name') )), 
		'_show_agent'     =>   '1', 
		));
		 $newMetaTitle = $this->app->options->get('system.common.agentpage_meta_title','Agents');
		 $newMetaKeywords = $this->app->options->get('system.common.agentpage_meta_keywords');
		 $newMetaDescription = $this->app->options->get('system.common.agentpage_meta_description');
		$this->setData(array(
		'pageMetaTitle'     =>  Yii::t('app',  'Agents' .'  | {project} ', array('{project}' =>$this->project_name )), 
		'pageTitle'     =>  Yii::t('app',  'Agents' .'  | {project} ', array('{project}' =>$this->project_name )), 
		'newMetaTitle' => $newMetaTitle,         
		'pageMetaTitle' => $newMetaTitle,         
		'newMetaKeywords' => $newMetaKeywords,         
		'pageMetaKeywords' => $newMetaKeywords,         
		'newMetaDescription' => $newMetaDescription,         
		'pageMetaDescription' => $newMetaDescription,         
		));
		 $apps = Yii::App()->apps;
    			 
		if($this->app->request->isAjaxRequest){
		 
			unset($formData['_pjax']);
			unset($formData['_']);
			$this->renderPartial( 'agents_new',compact('user_type','countryModel','ads','tags', 'formData','limit', 'adsCount' ,'title','agent_regi','agent_language'));
			$this->app->end();
		}
		
		 
		$this->render( 'agents_new',compact('user_type','countryModel','ads','tags', 'formData', 'adsCount' ,'limit','title','agent_regi','agent_language'));
		 
    }
      public function actionFetch_agent($count_future=true){
		$request = Yii::app()->request;
		 
		$formData = (array)$_GET ; 
	 	 $formData['enable_li'] = '1'; 
		$works =   ListingUsers::model()->findAgents($formData,$count_future,$user_type='A');
		
		 
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
					 
							$msgHTML .= $this->renderPartial('//user_listing/_list_agent_new',compact('works'),true); 
							if(!empty($count_future)){
							    if($total!=false){
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result,'total'=>$total));
								}
								else{
									echo  json_encode(array('dataHtml'=>$msgHTML,'future'=>$next_result ));
								}
							}
							else{
								echo   $msgHTML; 
							}
		}
		else{
			echo '1'; 
		}
		Yii::app()->end();
	}
	
}
