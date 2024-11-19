<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * DashboardController
 * 
 * Handles the actions for dashboard related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class DashboardController extends Controller
{
    public function init()
    {
        $apps = Yii::app()->apps;
        $this->getData('pageScripts')->mergeWith(array(
            array('src' => $apps->getBaseUrl('assets/js/flot/jquery.flot.min.js')),
            array('src' => $apps->getBaseUrl('assets/js/flot/jquery.flot.resize.min.js')),
            array('src' => $apps->getBaseUrl('assets/js/flot/jquery.flot.categories.min.js')),
            array('src' => AssetsUrl::js('dashboard.js?q=2'))
        ));
        parent::init();
    }
    
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        return CMap::mergeArray(array(
            'postOnly + delete_log, delete_logs',
        ), parent::filters());
    }
    
    /**
     * Display dashboard informations
     */
    public function actionIndex()
    {
        if (file_exists(Yii::getPathOfAlias('root.install')) && is_dir($dir = Yii::getPathOfAlias('root.install'))) {
            Yii::app()->notify->addWarning(Yii::t('app', 'Please remove the install directory({dir}) from your application!', array(
                '{dir}' => $dir,
            )));
        }
        
        $group = Yii::app()->user->getModel()->group;
        if (!empty($group) && !empty($group->default_url)) {
            $this->redirect(Yii::app()->createUrl($group->default_url));
        }
        
        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->name . ' | ' . Yii::t('dashboard', 'Dashboard'), 
            'pageHeading'       => Yii::t('dashboard', 'Dashboard'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard', 'Dashboard'),
            ),
        ));

        // Active For Sale
        $criteria = new CDbCriteria();
        $criteria->compare('t.isTrash', '0');
        $criteria->compare('t.status', 'A');
        $criteria->compare('t.section_id', '1');
        if (Yii::app()->user->model->user_id != 2) { // Restrict data for non-admin
            $criteria->condition = 'user_id = :userId';
            $criteria->params = [':userId' => Yii::app()->user->model->user_id];
        }
        $ads = PlaceAnAd::model()->findAll($criteria);

        // Active For Rent
        $criteria->compare('t.section_id', '2');
        $adsRent = PlaceAnAd::model()->findAll($criteria);

        // Active Business Opportunities
        $criteria->compare('t.section_id', '3');
        $adsBusiness = PlaceAnAd::model()->findAll($criteria);

        // Active New Projects (not restricted by user_id)
        $criteria = new CDbCriteria();
        $criteria->compare('t.isTrash', '0');
        $criteria->compare('t.status', 'A');
        $newProjects = Project::model()->findAll($criteria);

        // Pre-Leased Properties (not restricted by user_id)
        $criteria->compare('t.property_status', '1');
        $preLeasedProperties = PlaceAnAd::model()->findAll($criteria);

        // Listing Users (not restricted by user_id)
        $criteria = new CDbCriteria();
        $criteria->compare('t.isTrash', '0');
        $criteria->compare('t.status', 'W');
        $criteria->order = "t.user_id desc";
        $usr = ListingUsers::model()->findAll($criteria);

        // Enquiries, general logic remains unchanged
        $enquiries = SendEnquiry::model()->findAll();

        $limit = 25;
        $criteria = SendEnquiry::model()->findEnquiry(array(), false, 1);
        $criteria->limit = $limit;
        $pro_enquiry = SendEnquiry::model()->findAll($criteria);
        $criteria->compare('is_read', '0');
        $pro_enquiry_unread = SendEnquiry::model()->count($criteria);

        $criteria = ContactUs::model()->findEnquiry(array(), false, 1);
        $criteria->limit = $limit;
        $general_enquiry = ContactUs::model()->findAll($criteria);
        $criteria->compare('is_read', '0');
        $general_enquiry_unread = ContactUs::model()->count($criteria);

        $modelCriteraBlog = Article::model()->findPosts([], $count_future = false, 1, $calculate = false);
        $adsCount = Article::model()->count($modelCriteraBlog);
        $pages = new CPagination($adsCount);
        $pages->pageSize = $limit;
        $pages->applyLimit($modelCriteraBlog);

        $modelCriteraBlog->limit = $limit;
        $articleCategoryFromSlug = Article::model()->findAll($modelCriteraBlog);

        $criteria = ContactAgent::model()->findEnquiry(array(), false, 1);
        $criteria->limit = $limit;
        $agent_enquiry = ContactAgent::model()->findAll($criteria);
        $criteria->compare('is_read', '0');
        $agent_enquiry_unread = ContactUs::model()->count($criteria);

        $modelContactServices = new ContactPopup();
        $modelContactServices->unsetAttributes();

        $this->render('index', compact(
            'modelContactServices',
            'articleCategoryFromSlug',
            'ads',
            'adsBusiness',
            'enquiries',
            'preLeasedProperties',
            'newProjects',
            'adsRent',
            'usr',
            'limit',
            'pro_enquiry',
            'general_enquiry',
            'pro_enquiry_unread',
            'general_enquiry_unread',
            'agent_enquiry',
            'agent_enquiry_unread'
        ));
    }


       public function actionSitemap()
    {
		  
        
       
        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->name . ' | ' . Yii::t('dashboard', 'Sitemap'), 
            'pageHeading'       => Yii::t('dashboard', 'Sitemap'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard', 'Sitemap'),
            ),
        ));
        
        
        $this->render('sitemap');
    }
    public function actionMy_statistics($from_date=null,$to_date=null,$user_id=null)
    {
	 
		 
 
        $options = Yii::app()->options;
        $notify  = Yii::app()->notify;
           $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));  
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('dashboard', 'My Statistics'),
            'pageHeading'       => Yii::t('dashboard', 'Statistics'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard', 'Dashboard'),
            ),
        ));
        
        
        
        if(empty($from_date) and empty($to_date)){
        $to_date =    date('Y-m-d');           
        //$from_date =    date('Y-m-d', strtotime('-30 day', strtotime($to_date)));  
		}    
		
		
		//if(!empty())
		$criteria=new CDbCriteria;
        $criteria->compare('t.group_id', User::SALES_TEAM);
        $sales_team = User::model()->findAll($criteria);
       
		
		if(empty($user_id)){
		    	if(Yii::app()->user->getModel()->removable=='yes'){
		        $user_id = (int) Yii::app()->user->getId();
		    	}
		}
		
		/*customers created*/      
        $criteria=new CDbCriteria;
        $criteria->compare('t.isTrash','0');
        if(!empty($user_id)){   $criteria->compare('t.created_by',$user_id ); }
        else{
         	$criteria->join  .=   ' INNER   JOIN {{user}} gpu on gpu.user_id = t.created_by ';
            	$criteria->condition   .=  ' and gpu.group_id = 8 ';
        }
       // $criteria->condition .= ' and t.created_by is not null and (t.parent_user is not null or t.parent_user="") ' ;
        $criteria->condition .= ' and  t.parent_user is   null    ' ;
        if(!empty($from_date)){
        $criteria->condition .= ' and DATE(t.date_added) >= :fromdate  ' ;
        $criteria->params[':fromdate'] = date('Y-m-d',strtotime($from_date));
		}
		if(!empty($to_date)){
        $criteria->condition .= ' and DATE(t.date_added) <= :to_date  ' ;
        $criteria->params[':to_date'] = date('Y-m-d',strtotime($to_date));
		}
		//	echo $criteria->condition;exit; 
        $customers_created = ListingUsers::model()->count($criteria);
        /*customers created end*/
        
        
        
        
        
		/*orders created*/      
        $criteria=new CDbCriteria;
        $criteria->compare('t.status','complete');
        if(!empty($user_id)){  
            //$criteria->compare('t.created_by',$user_id ); 
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} usr1 on usr1.user_id = t.customer_id ';
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} pusr2 on pusr2.user_id = usr1.parent_user ';
            $criteria->condition .=  ' and (CASE WHEN usr1.parent_user is NOT NULL THEN pusr2.created_by ELSE usr1.created_by END) = :team_manager  ' ;	
            $criteria->params[':team_manager'] = (int) $user_id ;
            
        }
        else{
         
         	$criteria->join  .=   ' INNER   JOIN {{user}} gpu on gpu.user_id = t.created_by ';
            	$criteria->condition   .=  ' and gpu.group_id = 8 ';
        }
        //$criteria->condition .= ' and t.created_by is not null ' ;
        if(!empty($from_date)){
        $criteria->condition .= ' and DATE(t.date_added) >= :fromdate  ' ;
        $criteria->params[':fromdate'] = date('Y-m-d',strtotime($from_date));
		}
		if(!empty($to_date)){
        $criteria->condition .= ' and DATE(t.date_added) <= :to_date  ' ;
        $criteria->params[':to_date'] = date('Y-m-d',strtotime($to_date));
		}
	
        $active_orders_created = PricePlanOrder::model()->count($criteria);
 
        /*customers created end*/
        
        
        
		/*active_packages*/      
      	/*orders created*/      
        $criteria=new CDbCriteria;
        $criteria->compare('t.status','complete');
        if(!empty($user_id)){  
            //$criteria->compare('t.created_by',$user_id ); 
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} usr1 on usr1.user_id = t.customer_id ';
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} pusr2 on pusr2.user_id = usr1.parent_user ';
            $criteria->condition .=  ' and (CASE WHEN usr1.parent_user is NOT NULL THEN pusr2.created_by ELSE usr1.created_by END) = :team_manager  ' ;	
            $criteria->params[':team_manager'] = (int) $user_id ;
            
        }
        else{
         
         	$criteria->join  .=   ' INNER   JOIN {{user}} gpu on gpu.user_id = t.created_by ';
            	$criteria->condition   .=  ' and gpu.group_id = 8 ';
        }
        //$criteria->condition .= ' and t.created_by is not null ' ;
        if(!empty($from_date)){
        $criteria->condition .= ' and DATE(t.date_added) >= :fromdate  ' ;
        $criteria->params[':fromdate'] = date('Y-m-d',strtotime($from_date));
		}
		if(!empty($to_date)){
        $criteria->condition .= ' and DATE(t.date_added) <= :to_date  ' ;
        $criteria->params[':to_date'] = date('Y-m-d',strtotime($to_date));
		}
		    $criteria->condition  .='  and (CASE WHEN t.validity ="0" THEN 1 ELSE  (DATEDIFF(DATE_ADD(DATE(t.date_start), INTERVAL t.validity DAY) , CURDATE())) END ) >= 0  and t.status="complete" ';
		 
        $active_packages = PricePlanOrder::model()->count($criteria);
			 
        /*active_packages end*/
        
        
		/*active_packages*/      
      	/*active_packages*/      
      	/*orders created*/      
        $criteria=new CDbCriteria;
        $criteria->compare('t.status','complete');
        if(!empty($user_id)){  
            //$criteria->compare('t.created_by',$user_id ); 
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} usr1 on usr1.user_id = t.customer_id ';
            $criteria->join  .=   ' LEFT JOIN {{listing_users}} pusr2 on pusr2.user_id = usr1.parent_user ';
            $criteria->condition .=  ' and (CASE WHEN usr1.parent_user is NOT NULL THEN pusr2.created_by ELSE usr1.created_by END) = :team_manager  ' ;	
            $criteria->params[':team_manager'] = (int) $user_id ;
            
        }
        else{
         
         	$criteria->join  .=   ' INNER   JOIN {{user}} gpu on gpu.user_id = t.created_by ';
            	$criteria->condition   .=  ' and gpu.group_id = 8 ';
        }
        //$criteria->condition .= ' and t.created_by is not null ' ;
        if(!empty($from_date)){
        $criteria->condition .= ' and DATE(t.date_added) >= :fromdate  ' ;
        $criteria->params[':fromdate'] = date('Y-m-d',strtotime($from_date));
		}
		if(!empty($to_date)){
        $criteria->condition .= ' and DATE(t.date_added) <= :to_date  ' ;
        $criteria->params[':to_date'] = date('Y-m-d',strtotime($to_date));
		}
		    $criteria->condition  .='  and (CASE WHEN t.validity ="0" THEN 1 ELSE  (DATEDIFF(DATE_ADD(DATE(t.date_start), INTERVAL t.validity DAY) , CURDATE())) END ) <  0  and t.status="complete" ';
		 
          $expired_packages = PricePlanOrder::model()->count($criteria);
		
         
        /*active_packages end*/
        
        
        $categoryPackages = Package::model()->castegoryPackage();
        $catgeoryList =array();
        foreach($categoryPackages as $k=>$v){
			$catgeoryList[$k] = array('name'=>$v, 'active_count'=>UserPackages::model()->activePackageList($user_id,$to_date,$from_date,$k), 'inactive_count'=>empty($from_date) ? UserPackages::model()->inactivePackageList($user_id,$to_date,$from_date,$k) : 0 );
		}
        
        
 
        
        $this->render('my_statistics', compact('ads','usr','catgeoryList','customers_created','from_date','to_date','sales_team','user_id','active_orders_created','active_packages','expired_packages','categoryPackages'));
    }
    
    public function actionLatestAds()
    {
        $model = new PlaceAnAd('search');
        $model->unsetAttributes();
        $model->isTrash = '0';
    
        // Apply user_id restriction
        if (Yii::app()->user->model->user_id != 2) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'user_id = :userId';
            $criteria->params = [':userId' => Yii::app()->user->model->user_id];
            $model->dbCriteria->mergeWith($criteria);
        }
    
        $this->renderPartial('latest_files', compact('model'));
    }
    
    public function actionMonthLatestAds()
    {
        $model = new PlaceAnAd('search');
        $model->unsetAttributes();
        $model->isTrash = '0';
    
        $criteria = new CDbCriteria();
        $criteria->condition = 'DATE_FORMAT(t.date_added, "%Y-%m") = DATE_FORMAT(NOW(), "%Y-%m")';
    
        // Apply user_id restriction
        if (Yii::app()->user->model->user_id != 2) {
            $criteria->addCondition('user_id = :userId');
            $criteria->params[':userId'] = Yii::app()->user->model->user_id;
        }
    
        $model->dbCriteria->mergeWith($criteria);
        $this->renderPartial('latest_files', compact('model'));
    }
    
    public function actionWeekLatestAds()
    {
        $model = new PlaceAnAd('search');
        $model->unsetAttributes();
        $model->isTrash = '0';
    
        $criteria = new CDbCriteria();
        $criteria->condition = 'YEARWEEK(t.date_added, 1) = YEARWEEK(NOW(), 1)';
    
        // Apply user_id restriction
        if (Yii::app()->user->model->user_id != 2) {
            $criteria->addCondition('user_id = :userId');
            $criteria->params[':userId'] = Yii::app()->user->model->user_id;
        }
    
        $model->dbCriteria->mergeWith($criteria);
        $this->renderPartial('latest_files', compact('model'));
    }
    
    public function actionTodayLatestAds()
    {
        $model = new PlaceAnAd('search');
        $model->unsetAttributes();
        $model->isTrash = '0';
    
        $criteria = new CDbCriteria();
        $criteria->condition = 'DATE(t.date_added) = CURDATE()';
    
        // Apply user_id restriction
        if (Yii::app()->user->model->user_id != 2) {
            $criteria->addCondition('user_id = :userId');
            $criteria->params[':userId'] = Yii::app()->user->model->user_id;
        }
    
        $model->dbCriteria->mergeWith($criteria);
        $this->renderPartial('latest_files', compact('model'));
    }
    
    
     public function actionLatestCustomer(){
     
				$model = new ListingUsers('serach');
			$model->unsetAttributes();
			$model->isTrash  =  '0';
			 $model->search_agent = '1'; 
          $this->renderPartial('latest_users',compact('model'));
    }
    public function actionFetch_pro($count_future=true,$calculate=false,$country_id2=false,$state_id2=false,$is_form=false,$hide_featured=false ){
		$request = Yii::app()->request;
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData);
			 
		}
		else{
		$formData = array_filter((array)$_GET);
		}
 
		$works =   SendEnquiry::model()->findEnquiry($formData,$count_future,false,$calculate);
	 
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
							 $msgHTML .= $this->renderPartial('//dashboard/_list_pro_enquiry',compact('works','checkIcon','property_of_featured_developers' ),true); 
							
						 
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
    	 public function actionFetch_agent_enquiry($count_future=true,$calculate=false,$country_id2=false,$state_id2=false,$is_form=false,$hide_featured=false ){
		$request = Yii::app()->request;
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData);
			 
		}
		else{
		$formData = array_filter((array)$_GET);
		}
 
		$works =   ContactAgent::model()->findEnquiry($formData,$count_future,false,$calculate);
	 
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
							 $msgHTML .= $this->renderPartial('//dashboard/_list_agent_enquiry',compact('works','checkIcon','property_of_featured_developers' ),true); 
							
						 
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
	 public function actionFetch_general($count_future=true,$calculate=false,$country_id2=false,$state_id2=false,$is_form=false,$hide_featured=false ){
		$request = Yii::app()->request;
		if($is_form){
			parse_str($request->getQuery('formData',''), $formData);
			 
		}
		else{
		$formData = array_filter((array)$_GET);
		}
 
		$works =   ContactUs::model()->findEnquiry($formData,$count_future,false,$calculate);
	 
		
		$msgHTML = '';
		if(!empty($count_future)){
						$next_result   = !empty($works['future_count']) ?  1 : 0 ; 
						$total         = isset($works['total']) ? $works['total'] : false ;
						$works		   = $works['result'] ;
		}
		
		
		if($works){
							 $msgHTML .= $this->renderPartial('//dashboard/_list_general_enquiry',compact('works','checkIcon','property_of_featured_developers' ),true); 
							
						 
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
   
    /**
     * Ajax only action to get one year subscribers growth
     */
    public function actionGlance()
    {
       if (!Yii::app()->request->isAjaxRequest) {
        //     $this->redirect(array('dashboard/index'));
        }
    
        $customers          = 0;
        $lists              = 0;
        $subscribers        = 0;
        $deliveryServers    = 0;
        $campaigns          = 0;
        $segments           = 0;
         $a_user            = 0;
        
        //$agents              = ListingUsers::model()->count(array("condition"=>"t.isTrash='0' and status='A' and t.parent_user is null and t.user_type != 'U' "));
        $a_user              = ListingUsers::model()->count(array("condition"=>"t.isTrash='0' and status='A' and t.parent_user is not  null  and t.user_type != 'U'"));
        $developers          = ContactUs::model()->count(array("condition"=>"contact_type='CONTACT'"));;
        $advertisers         =  PlaceAnAd::model()->count(array("condition"=>"status='A' and t.section_id = '5' and isTrash='0'"));
        $agencies            =  PlaceAnAd::model()->count(array("condition"=>"status='A' and     property_status='1' and     isTrash='0'"));;
        $adModel = new PlaceAnAdNew();
    	$adModelCriteria =	$adModel->findAds(array() ,false,true);
	    $condition = $adModelCriteria->condition;
    	$new_homesCritieria         	 =	$adModelCriteria;
    	$new_homesCritieria->condition  .= ' and t.section_id = "1" ';
    	$active_for_sale =  $adModel->count($new_homesCritieria);
    	
    	
        $new_homesCritieria         	= $adModelCriteria;  
        $new_homesCritieria->condition  = $condition;
        $new_homesCritieria->condition  .= ' and t.section_id = "2" ';
        $active_for_rent = $adModel->count($new_homesCritieria); 
       
        $businessCritieria         	= $adModelCriteria;  
        $businessCritieria->condition  = $condition;
        $businessCritieria->condition  .= ' and t.section_id = "6" ';
        $business = $adModel->count($businessCritieria); 
       
        $NewDevelopmentCritieria         	= new CDbCriteria;;   
        $NewDevelopmentCritieria->condition   = '   t.status = "A" and t.section_id = "3"';
         
        $NewDevelopment = NewDevelopment::model()->count($NewDevelopmentCritieria); 
     
         
        $customers          = Yii::app()->format->formatNumber($NewDevelopment);
        $campaigns          = Yii::app()->format->formatNumber($developers);
        $lists              = Yii::app()->format->formatNumber($agencies);
        $segments           = Yii::app()->format->formatNumber($advertisers);
        $subscribers        = Yii::app()->format->formatNumber($active_for_sale);
        $deliveryServers    = Yii::app()->format->formatNumber($active_for_rent);
        $a_user    = Yii::app()->format->formatNumber($business);
       
        
        return $this->renderJson(compact(
            'customers',
            'lists',
            'subscribers',
            'deliveryServers',
            'campaigns',
            'segments',
            'a_user'
        ));
    }
    
    /**
     * Ajax only action to get activity messages
     */
    public function actionChatter()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) as date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_SUB(NOW(), INTERVAL 7 DAY)';
        $criteria->group     = 'DATE(t.date_added)';
        $criteria->order     = 't.date_added DESC';
        $criteria->limit     = 7;
        $models = CustomerActionLog::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $_item = array(
                'date'  => $model->dateTimeFormatter->formatLocalizedDate($model->date_added),
                'items' => array(),
            );
            $criteria = new CDbCriteria();
            $criteria->select    = 't.log_id, t.customer_id, t.message, t.date_added';
            $criteria->condition = 'DATE(t.date_added) = :date';
            $criteria->params    = array(':date' => $model->date_added);
            $criteria->limit     = 10;
            $criteria->order     = 't.date_added DESC';
            $criteria->with      = array(
                'customer' => array(
                    'select'   => 'customer.customer_id, customer.first_name, customer.last_name',
                    'together' => true,
                    'joinType' => 'INNER JOIN',
                ),
            );
            $records = CustomerActionLog::model()->findAll($criteria);
            foreach ($records as $record) {
                $customer = $record->customer;
                $time     = $record->dateTimeFormatter->formatLocalizedTime($record->date_added);
                $_item['items'][] = array(
                    'deleteUrl'    => $this->createUrl('dashboard/delete_log', array('id' => $record->log_id)),
                    'time'         => $time,
                    'customerName' => $customer->getFullName(),
                    'customerUrl'  => $this->createUrl('customers/update', array('id' => $customer->customer_id)),
                    'message'      => strip_tags($record->message),
                );
            }
            $items[] = $_item;
        }
        
        return $this->renderJson($items);
    }
    
    /**
     * Ajax only action to get subscribers growth
     */
    public function actionSubscribers_growth()
    {
       // set_time_limit(0);
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $cacheKey = md5(__FILE__ . __METHOD__).'2';
        if ($items = Yii::app()->cache->get($cacheKey)) {
            return $this->renderJson(array(
                'label' => Yii::t('app', '{n} months growth', 3),
                'data'  => $items,
                'color' => '#3c8dbc'
            ));
        }
        
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 6 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added ASC';
        $criteria->limit     = 6;
        
        $models = ListingUsers::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = ListingUsers::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        Yii::app()->cache->set($cacheKey, $items, 600);
        
        return $this->renderJson(array(
            'label' => Yii::t('app', '{n} months growth', 3),
            'data'  => $items,
            'color' => '#3c8dbc'
        ));
    }
    
    /**
     * Ajax only action to get lists growth
     */
    public function actionLists_growth()
    {
        // set_time_limit(0);
        
        if (!Yii::app()->request->isAjaxRequest) {
             $this->redirect(array('dashboard/index'));
        }
        
        $cacheKey = md5(__FILE__ . __METHOD__).'3';
        if ($items = Yii::app()->cache->get($cacheKey)) {
            return $this->renderJson(array(
                'label' => Yii::t('app', '{n} months growth', 3),
                'data'  => $items,
                'color' => '#3c8dbc'
            ));
        }
        
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 6 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added DESC';
        $criteria->limit     = 6;
        $models = PlaceAnAd::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = PlaceAnAd::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        Yii::app()->cache->set($cacheKey, $items, 600);
        
        return $this->renderJson(array(
            'label' => Yii::t('app', '{n} months growth', 3),
            'data'  => $items,
            'color' => '#3c8dbc'
        ));
    }
    
    /**
     * Ajax only action to get campaigns growth
     */
    public function actionCampaigns_growth()
    {
        set_time_limit(0);
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $cacheKey = md5(__FILE__ . __METHOD__);
        if ($items = Yii::app()->cache->get($cacheKey)) {
            return $this->renderJson(array(
                'label' => Yii::t('app', '{n} months growth', 3),
                'data'  => $items,
                'color' => '#3c8dbc'
            ));
        }
        
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 3 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added ASC';
        $criteria->limit     = 3;

        $models = Campaign::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = Campaign::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        Yii::app()->cache->set($cacheKey, $items, 600);
        
        return $this->renderJson(array(
            'label' => Yii::t('app', '{n} months growth', 3),
            'data'  => $items,
            'color' => '#3c8dbc'
        ));
    }
    
    /**
     * Ajax only action to get delivery/bounce growth
     */
    public function actionDelivery_bounce_growth()
    {
        set_time_limit(0);
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $cacheKey = md5(__FILE__ . __METHOD__);
        if ($lines = Yii::app()->cache->get($cacheKey)) {
            return $this->renderJson($lines);
        }
        
        $lines = array();
        
        // Delivery
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 3 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added ASC';
        $criteria->limit     = 3;
        $models = CampaignDeliveryLog::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = CampaignDeliveryLog::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        $lines[] = array(
            'label' => Yii::t('app', 'Delivery, {n} months growth', 3),
            'data'  => $items,
            'color' => '#3c8dbc'
        );
        
        // Bounces
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 3 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added ASC';
        $criteria->limit     = 3;
        $models = CampaignBounceLog::model()->findAll($criteria);

        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = CampaignBounceLog::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        $lines[] = array(
            'label' => Yii::t('app', 'Bounce, {n} months growth', 3),
            'data'  => $items,
            'color' => '#ff0000'
        );
        
        Yii::app()->cache->set($cacheKey, $lines, 600);
        
        return $this->renderJson($lines);
    }
    
    /**
     * Ajax only action to get unsubscribes growth
     */
    public function actionUnsubscribe_growth()
    {
        set_time_limit(0);
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $cacheKey = md5(__FILE__ . __METHOD__);
        if ($items = Yii::app()->cache->get($cacheKey)) {
            return $this->renderJson(array(
                'label' => Yii::t('app', '{n} months growth', 3),
                'data'  => $items,
                'color' => '#3c8dbc'
            ));
        }
        
        $criteria = new CDbCriteria();
        $criteria->select    = 'DISTINCT(DATE(t.date_added)) AS date_added';
        $criteria->condition = 'DATE(t.date_added) >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 3 MONTH)), INTERVAL 1 DAY)';
        $criteria->group     = 'MONTH(t.date_added)';
        $criteria->order     = 't.date_added ASC';
        $criteria->limit     = 3;
        $models = CampaignTrackUnsubscribe::model()->findAll($criteria);
        
        $items = array();
        foreach ($models as $model) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'YEAR(date_added) = YEAR(:year) AND MONTH(date_added) = MONTH(:month)';
            $criteria->params = array(
                ':year'   => $model->date_added,
                ':month'  => $model->date_added,
            );
            $monthName  = date('M', strtotime($model->date_added));
            $count      = CampaignTrackUnsubscribe::model()->count($criteria);
            $items[]    = array(Yii::t('app', $monthName) . ' ' . date('Y', strtotime($model->date_added)), $count);
        }
        
        Yii::app()->cache->set($cacheKey, $items, 600);
        
        return $this->renderJson(array(
            'label' => Yii::t('app', '{n} months growth', 3),
            'data'  => $items,
            'color' => '#3c8dbc'
        ));
    }
    
    /**
     * Delete a single action log
     */
    public function actionDelete_log($id)
    {
        $model = CustomerActionLog::model()->findByAttributes(array(
            'log_id' => $id,
        ));
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $model->delete();
                    
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->isAjaxRequest) {
            $notify->addSuccess(Yii::t('app', 'Your item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('dashboard/index')));
        }
    }
    
    /**
     * Delete all action logs
     */
    public function actionDelete_logs()
    {
        CustomerActionLog::model()->deleteAll();
            
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->isAjaxRequest) {
            $notify->addSuccess(Yii::t('app', 'Your items have been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('dashboard/index')));
        }
    }
    
    public function actionCheck_update()
    {
        ignore_user_abort(true);
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('dashboard/index'));
        }
        
        $options = Yii::app()->options;
        if ($options->get('system.common.enable_version_update_check', 'yes') == 'no') {
            Yii::app()->end();
        }

        $now        = time();
        $lastCheck  = (int)$options->get('system.common.version_update.last_check', 0);
        $interval   = 60 * 60 * 24; // once at 24 hours should be enough

        if ($lastCheck + $interval > $now) {
            Yii::app()->end();
        }
        
        $options->set('system.common.version_update.last_check', $now);
        
        $response = AppInitHelper::simpleCurlGet('http://www.mailwizz.com/api/site/version');
        if (empty($response) || $response['status'] == 'error') {
            Yii::app()->end();
        }
        
        $json = CJSON::decode($response['message']);
        if (empty($json['current_version'])) {
            Yii::app()->end();
        }
        
        $dbVersion = $options->get('system.common.version', '1.0');
        if (version_compare($json['current_version'], $dbVersion, '>')) {
            $options->set('system.common.version_update.current_version', $json['current_version']);
        }
        
        Yii::app()->end();
    }
	
	 public function actionGet_email_receicers($id=null){
		 $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid($id);
		 if(!empty($emailTemplate)){
			 echo json_encode(array('status'=>'1','receiver_list'=>$emailTemplate->receiver_list));
			 exit;
		 }
		 else{
			  echo json_encode(array('status'=>'0'));
			 exit;
		 }
			   
	}
    public function actionSet_email_receicers($id=null){
      
         $val=@$_POST['val']; 
		 $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid($id);
		 if(!empty($emailTemplate)){
			 CustomerEmailTemplate::model()->updateByPk($emailTemplate->primaryKey,array('receiver_list'=>$val));
			 echo json_encode(array('status'=>'1'));
			 exit;
		 }
		 else{
			  echo json_encode(array('status'=>'0'));
			 exit;
		 }
			   
	}
   public function actionChange_status_email($id=null,$status=null)
    {
		
        $user = ListingUsers::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        
        $user::model()->updateByPk($id,array('status'=>$status));
        echo '<script>alert("Updated");window.close();</script>';exit;
	 
    }
       public function actionLatestAdsByManager($user_id=null){
     
			$model = new PlaceAnAd('serach');
			$model->unsetAttributes();
			$model->isTrash  =  '0';
			$model->team_manager = $user_id;
            $this->renderPartial('_latest_uploaded',compact('model'));
    }
     public function actionLatestCustomerByManager($user_id=null){
     
				$model = new ListingUsers('serach');
			$model->unsetAttributes();
			$model->isTrash  =  '0';
			 $model->search_agent = '1'; 
			 $model->created_by = $user_id ;
		 
			  
          $this->renderPartial('_latest_own_customers',compact('model'));
    }
  
}