<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class User_listing_developersController extends Controller
{
   
	public function init(){
	 
	  parent::Init();
       
    }
	 public function actionIndex($user_type='D',$country=null,$type=null,$agent_regi=null,$reg=null,$agent_language=null)
    {   
		
	  
		if(empty($user_type)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if(!in_array($user_type,array('A','D','C'))){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$agent_validate_model = new Agents();
		$agent_validate_model->scenario = 'find_step_1';
		$agent_validate_model->country_slug = $country;
		$agent_validate_model->property_type = $type;
		if(!$agent_validate_model->validate()){
			$this->redirect(Yii::app()->createUrl('user_listing/find'));
			Yii::app()->end();
		}
		$countryModel = Countries::model()->findByAttributes(array('slug'=>$country));
		if(empty($countryModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$formData['country_id'] =$countryModel->primaryKey;
		$title  =$countryModel->country_name;
		 if(!empty($agent_regi) or !empty($reg)){
		if(!empty($reg)){
				$stateModel =  States::model()->findByAttributes(array('slug'=>$reg));
				 
			}
			else{
				$stateModel =  States::model()->findByPk($agent_regi);
			}
		if(empty($stateModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$agent_regi = $stateModel->state_id;
		$title  =  $stateModel->state_name; 
		}
		 $this->layout =  'listing';
		 
		 $tags = CustomerTag::model()->listData( $user_type);
		 
		 
		 
		 
		$criteria =  Agents::model()->findAgents($formData,false, $user_type,1);
		$adsCount  = Agents::model()->count($criteria);
		$pages = new CPagination($adsCount);
		$pages->pageSize = 8;  
		$pages->applyLimit($criteria);
		$ads = Agents::model()->findAll($criteria);
		
		
		 
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js') ));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/pajax.js'), 'priority' => -100));
		$this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Developers Listing  :: {project} ', array('{project}' =>$this->options->get('system.common.site_name') )), 
		'_show_agent'     =>   '1', 
		));
		
		if($user_type=='D'){
			$this->render( 'index_new_developers',compact('user_type','countryModel','ads','tags', 'formData', 'adsCount' ,'title','agent_regi','agent_language'));
		}
		else if($user_type=='C'){
			$this->render( 'index_new_agencies',compact('user_type','countryModel','ads','tags', 'formData', 'adsCount' ,'title','agent_regi','agent_language'));
		}
		else{		
			$this->render( 'index_new',compact('user_type','countryModel','ads','tags', 'formData', 'adsCount' ,'title','agent_regi','agent_language'));
		}
    }
    
    /*
    public function actionIndex($user_type='D',$country=null,$agent_regi=null,$type=null)
    {   
		
	 
		
		if(empty($user_type)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if(!in_array($user_type,array('A','D'))){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$agent_validate_model = new Agents();
		$agent_validate_model->scenario = 'find_step_1';
		$agent_validate_model->country_slug = $country;
		$agent_validate_model->property_type = $type;
		if(!$agent_validate_model->validate()){
			$this->redirect(Yii::app()->createUrl('user_listing_developers/find'));
			Yii::app()->end();
		}
		$countryModel = Countries::model()->findByAttributes(array('slug'=>$country));
		if(empty($countryModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$title  =$countryModel->country_name;
		 if(!empty($agent_regi)){
		$stateModel =  States::model()->findByPk($agent_regi);
		if(empty($stateModel)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$title  =  $stateModel->state_name; 
		}
		
		$country_id=$countryModel->country_id;
		$state_id  = null ; 
		$featured_developers         = Developer::model()->featured_developers($country_id,$agent_regi,10 );
		
	  if($this->app->request->isAjaxRequest){
		
			$this->renderPartial('top_agents' ,compact('user_type','countryModel','featured_developers','title','agent_regi'));    
			$this->app->end();
	 }
		
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js') ));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/pajax.js'), 'priority' => -100));
		$this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Developers Listing  :: {project} ', array('{project}' =>$this->options->get('system.common.site_name') )), 
		'_show_developer'     =>   '1', 
		));
		 
		$this->render( 'index',compact('user_type','countryModel','featured_developers','title','agent_regi'));
    }  
    public function actionFind($user_type='D')
    {   
		
		if(empty($user_type)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if(!in_array($user_type,array('A','D'))){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$model = new Developer();
		$model->scenario = 'find_step_1';
		 $this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Find Developers    :: {project} ', array('{project}' =>$this->options->get('system.common.site_name') )), 
		));
		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/new/css/developer_listing_style.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));

		$this->render( 'find_agent',compact('user_type','model'));
    }  
    public function actionDetail($slug=null)
    {  		
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*';
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','D');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->params[':slug'] = $slug;
			$model = Developer::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$apps = $this->app->apps;
	       $this->getData('pageStyles')->add(array('src' => $this->appAssetUrl('css/icons.css'), 'priority' => -100));   
         	 $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js') ));
         	 $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/new/css/li_style_developer_detail.css')));
         	 
		$this->setData(array(
		'pageTitle'         => Yii::t('app', 'Developer {name}   :: {p}', array('{name}' =>'  '.$model->fullName   ,'{p}'=> $this->options->get('system.common.site_name'))), 
		'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render( 'detail_agent',compact('model'));
    }
    */
    public $default_country_id;
	public $default_country_slug;
	public $system_defaultt_country_id;
	public $banners; 
    public function actionFind($user_type='D')
    {   
		 
		if(empty($user_type)){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		if(!in_array($user_type,array('A','D'))){
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		
		//$this->header_class ='headers';
		$listContries  = Countries::model()->list_array_country();
		if(!isset($listContries[$this->default_country])){
		$this->default_country = $this->options->get('system.common.default_listing_country');
		} 	
		$this->default_country_id = @$listContries[$this->default_country]['country_id']; 
		$this->default_country_slug = @$listContries[$this->default_country]['slug']; 
		$default_country_name = @$listContries[$this->default_country]['country_name']; 

		$this->system_defaultt_country_id = @$listContries[$this->options->get('system.common.default_listing_country')]; 
		$this->banners = DeveloperBanner::model()->fetchBanners($this->default_country_id,$this->system_defaultt_country_id);
 
		$model = new Developer();
		$model->scenario = 'find_step_1';
		 $this->setData(array(
		'pageTitle'     =>  Yii::t('app', 'Real Estate Developers Askaan', array('{project}' =>$this->options->get('system.common.site_name') )), 
		 'pageMetaDescription'               => 'We have provided you a portal so you can easily find real estate developers in your country. Our listed Developers have clean track record.'
		));
		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/_developer.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/new/css/developer_listing_style.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));

		$this->render( 'find_agent',compact('user_type','model'));
    }  
    public function actionDetail($slug=null)
    {  		
		    $criteria=new CDbCriteria;
			$criteria->select = 't.*,cn.country_name';
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
			$criteria->compare('t.isTrash','0');
			$criteria->compare('t.status','A');
			$criteria->compare('t.user_type','D');
			$criteria->condition .= ' and t.slug=:slug ' ;
			$criteria->params[':slug'] = $slug;
			$model = Developer::model()->find($criteria);
			if(empty($model)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
			$apps = $this->app->apps;
	       $this->getData('pageStyles')->add(array('src' => $this->appAssetUrl('css/icons.css'), 'priority' => -100));   
         	 $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/scrol_main_new.js') ));
         	 $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/new/css/li_style_developer_detail.css')));
         	 $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/developer_detail.css')));
		$this->setData(array(
		'pageTitle'         => Yii::t('app', '{name}   :: {p}', array('{name}' =>'  '.$model->companyName   ,'{p}'=> $this->options->get('system.common.site_name'))), 
		'pageMetaDescription'   => Yii::app()->params['description'],
		));
		$this->render( 'detail_agent',compact('model'));
    }
    public function actionFetch_user($count_future=true){
		$request = Yii::app()->request;
		parse_str($request->getQuery('formData',''), $formData);
		$works =   Developer::model()->findAgents($formData,$count_future,$user_type='D');
	
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
 
		if($works){
					 
							$msgHTML .= $this->renderPartial('//user_listing_developers/_list_agent',compact('works'),true); 
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
		$model = new ContactDeveloper;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
	  public function actionFind_agent_validate(){
		$model = new Developer();
		$model->scenario = 'find_step_1' ;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
	} 
		public function actionSendEnquiry(){
		$request    = Yii::app()->request;
		$model  = new ContactDeveloper();
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
}
