<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UsersController
 * 
 * Handles the actions for users related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class StatisticsController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 public function actionDashboard($show=null)
    { 
		if(!isset($_GET['to_date']) and !isset($_GET['from_date'])){
			$_GET['to_date'] = date('Y-m-d');
			$_GET['from_date'] = date('Y-m-d',strtotime(date('Y-m-d') .' -30 days'));
		}
        
		$this->tag= Yii::app()->tags; 
		$notify = Yii::app()->notify;
		 
	    $total_call_count = Statistics::model()->callCount();
	    if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }
	    
        
        $total_whatsapp_count = Statistics::model()->whatsupCount('','','W');
        if(!empty($total_whatsapp_count)){ $total_whatsapp_count  = $total_whatsapp_count->s_count; }else{ $total_call_count  = 0; }

	      $total_text_count = Statistics::model()->whatsupCount('','','T');
        if(!empty($total_text_count)){ $total_text_count  = $total_text_count->s_count; }else{ $total_text_count  = 0; }



	    $total_page_count = StatisticsPage::model()->pageCount();
	    if(!empty($total_page_count)){ $total_page_count  = $total_page_count->s_count; }else{ $total_page_count  = 0; }
	    
	    $total_mail_count = Statistics::model()->mailCount();
	    if(!empty($total_mail_count)){ $total_mail_count  = $total_mail_count->s_count; }else{ $total_mail_count  = 0; }
	    
	    
	    	
		$total_whatsaoo_count_today = Statistics::model()->whatsupCount($duration='today','','W');
	    if(!empty($total_whatsaoo_count_today)){ $total_whatsaoo_count_today  = $total_whatsaoo_count_today->s_count; }else{ $total_whatsaoo_count_today  = 0; }
 
 	
		$total_text_count_today = Statistics::model()->whatsupCount($duration='today','','T');
	    if(!empty($total_text_count_today)){ $total_text_count_today  = $total_text_count_today->s_count; }else{ $total_text_count_today  = 0; }
 
	    
	    $total_call_count_today = Statistics::model()->callCount($duration='today');
	    if(!empty($total_call_count_today)){ $total_call_count_today  = $total_call_count_today->s_count; }else{ $total_call_count_today  = 0; }
	    $t_date = $this->converToTz(date('Y-m-d h:i:s'),'Asia/Karachi','UTC','Y-m-d');
		
	
		  $thirty_whatsap_count_today = Statistics::model()->whatsupCount($duration='30day','','W');
	    if(!empty($thirty_whatsap_count_today)){ $thirty_whatsap_count_today  = $thirty_whatsap_count_today->s_count; }else{ $thirty_whatsap_count_today  = 0; }
	  
	    $thirty_text_count_today = Statistics::model()->whatsupCount($duration='30day','','T');
	    if(!empty($thirty_text_count_today)){ $thirty_text_count_today  = $thirty_text_count_today->s_count; }else{ $thirty_text_count_today  = 0; }
	  
	  
	  
	 
		 
	    $thirty_call_count_today = Statistics::model()->callCount($duration='30day');
	    if(!empty($thirty_call_count_today)){ $thirty_call_count_today  = $thirty_call_count_today->s_count; }else{ $thirty_call_count_today  = 0; }
	  
	    
	     $total_mail_count_today = Statistics::model()->mailCount($duration='today');
	    if(!empty($total_mail_count_today)){ $total_mail_count_today  = $total_mail_count_today->s_count; }else{ $total_mail_count_today  = 0; }
	   
	     $total_mail_count_thirty = Statistics::model()->mailCount($duration='30day');
	    if(!empty($total_mail_count_thirty)){ $total_mail_count_thirty  = $total_mail_count_thirty->s_count; }else{ $total_mail_count_thirty  = 0; }
	   
	     $total_page_count_today = StatisticsPage::model()->pageCount('today');
	    if(!empty($total_page_count_today)){ $total_page_count_today  = $total_page_count_today->s_count; }else{ $total_page_count_today  = 0; }
	 
	     $total_page_count_thirty = StatisticsPage::model()->pageCount('30day');
	    if(!empty($total_page_count_thirty)){ $total_page_count_thirty  = $total_page_count_thirty->s_count; }else{ $total_page_count_thirty  = 0; }
	 
	    $pageCountByProperty = StatisticsPage::model()->pageCountByProperty();
	    $emailCountByProperty = Statistics::model()->clickCountByProperty('E');
	   
	 
	    $callCountByProperty = Statistics::model()->clickCountByProperty('C');
	     
	       
	    
		$premium_downloads = 0;
		$TotalDownloadCount =  0 ; 
		$TotalInvoices  = (int) 0 ; 
		
		
		 $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Statistics  Dashboard'), 
            'pageHeading'       => Yii::t('agent',  'Statistics  Dashboard'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
 $apps= Yii::app()->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/jAlert-v3.css')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/jAlert-v3.min.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/jAlert-functions.min.js')));
		
        $this->render("statistics",compact('total_whatsapp_count',	'thirty_whatsap_count_today','thirty_text_count_today','total_whatsaoo_count_today','total_text_count_today','total_text_count',"user",'total_call_count' ,'total_page_count','total_mail_count','total_call_count_today','thirty_call_count_today','total_mail_count_today','total_mail_count_thirty','total_page_count_today','total_page_count_thirty','pageCountByProperty','emailCountByProperty','callCountByProperty'));
	}
	public function actionProperty_statistics($property_id=null)
    { 
		if(!isset($_GET['to_date']) and !isset($_GET['from_date'])){
			$_GET['to_date'] = date('Y-m-d');
			$_GET['from_date'] = date('Y-m-d',strtotime(date('Y-m-d') .' -30 days'));
		}
	    $property = 	PlaceAnAd::model()->findByPk($property_id);
	    if(empty($property)){
	        throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
	    }
        
		$this->tag= Yii::app()->tags; 
		$notify = Yii::app()->notify;
		 
	    $total_call_count = Statistics::model()->callCount();
	    if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }
	    
        
        $total_whatsapp_count = Statistics::model()->whatsupCount('','','W');
        if(!empty($total_whatsapp_count)){ $total_whatsapp_count  = $total_whatsapp_count->s_count; }else{ $total_call_count  = 0; }

	      $total_text_count = Statistics::model()->whatsupCount('','','T');
        if(!empty($total_text_count)){ $total_text_count  = $total_text_count->s_count; }else{ $total_text_count  = 0; }



	    $total_page_count = StatisticsPage::model()->pageCount();
	    if(!empty($total_page_count)){ $total_page_count  = $total_page_count->s_count; }else{ $total_page_count  = 0; }
	    
	    $total_mail_count = Statistics::model()->mailCount();
	    if(!empty($total_mail_count)){ $total_mail_count  = $total_mail_count->s_count; }else{ $total_mail_count  = 0; }
	    
	    
	    	
		$total_whatsaoo_count_today = Statistics::model()->whatsupCount($duration='today','','W');
	    if(!empty($total_whatsaoo_count_today)){ $total_whatsaoo_count_today  = $total_whatsaoo_count_today->s_count; }else{ $total_whatsaoo_count_today  = 0; }
 
 	
		$total_text_count_today = Statistics::model()->whatsupCount($duration='today','','T');
	    if(!empty($total_text_count_today)){ $total_text_count_today  = $total_text_count_today->s_count; }else{ $total_text_count_today  = 0; }
 
	    
	    $total_call_count_today = Statistics::model()->callCount($duration='today');
	    if(!empty($total_call_count_today)){ $total_call_count_today  = $total_call_count_today->s_count; }else{ $total_call_count_today  = 0; }
	    $t_date = $this->converToTz(date('Y-m-d h:i:s'),'Asia/Karachi','UTC','Y-m-d');
		
	
		  $thirty_whatsap_count_today = Statistics::model()->whatsupCount($duration='30day','','W');
	    if(!empty($thirty_whatsap_count_today)){ $thirty_whatsap_count_today  = $thirty_whatsap_count_today->s_count; }else{ $thirty_whatsap_count_today  = 0; }
	  
	    $thirty_text_count_today = Statistics::model()->whatsupCount($duration='30day','','T');
	    if(!empty($thirty_text_count_today)){ $thirty_text_count_today  = $thirty_text_count_today->s_count; }else{ $thirty_text_count_today  = 0; }
	  
	  
	  
	 
		 
	    $thirty_call_count_today = Statistics::model()->callCount($duration='30day');
	    if(!empty($thirty_call_count_today)){ $thirty_call_count_today  = $thirty_call_count_today->s_count; }else{ $thirty_call_count_today  = 0; }
	  
	    
	     $total_mail_count_today = Statistics::model()->mailCount($duration='today');
	    if(!empty($total_mail_count_today)){ $total_mail_count_today  = $total_mail_count_today->s_count; }else{ $total_mail_count_today  = 0; }
	   
	     $total_mail_count_thirty = Statistics::model()->mailCount($duration='30day');
	    if(!empty($total_mail_count_thirty)){ $total_mail_count_thirty  = $total_mail_count_thirty->s_count; }else{ $total_mail_count_thirty  = 0; }
	   
	     $total_page_count_today = StatisticsPage::model()->pageCount('today');
	    if(!empty($total_page_count_today)){ $total_page_count_today  = $total_page_count_today->s_count; }else{ $total_page_count_today  = 0; }
	 
	     $total_page_count_thirty = StatisticsPage::model()->pageCount('30day');
	    if(!empty($total_page_count_thirty)){ $total_page_count_thirty  = $total_page_count_thirty->s_count; }else{ $total_page_count_thirty  = 0; }
	 
	    
	    
		$premium_downloads = 0;
		$TotalDownloadCount =  0 ; 
		$TotalInvoices  = (int) 0 ; 
		
		
		 $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Property - Statistics  Dashboard','property'), 
            'pageHeading'       => Yii::t('agent',  'Property Statistics'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
 $apps= Yii::app()->apps;
 
		
        $this->render("property_statistics",compact('property','total_whatsapp_count',	'thirty_whatsap_count_today','thirty_text_count_today','total_whatsaoo_count_today','total_text_count_today','total_text_count',"user",'total_call_count' ,'total_page_count','total_mail_count','total_call_count_today','thirty_call_count_today','total_mail_count_today','total_mail_count_thirty','total_page_count_today','total_page_count_thirty','pageCountByProperty','emailCountByProperty','callCountByProperty'));
	}
    /**
     * List all available users
     */
    public function actionPage_view($type=null)
    {
         
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new StatisticsPage('search');
         $user->unsetAttributes();
         // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Page views List'), 
            'pageHeading'       => Yii::t('agent',  'Page views List'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
 
        $this->render('page_view', compact('user','type','tags','tags_short'));
    }
    public function actionCall()
    {
         
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new Statistics('search');
         $user->unsetAttributes();
         $user->type  = 'C';
         // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Call button clicked List'), 
            'pageHeading'       => Yii::t('agent',  'Call button clicked List'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
 
        $this->render('call', compact('user','type','tags','tags_short'));
    }
    public function actionEmail()
    {
         
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new Statistics('search');
         $user->unsetAttributes();
         $user->type  = 'E';
         // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Email button clicked List'), 
            'pageHeading'       => Yii::t('agent',  'Email button clicked List'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
 
        $this->render('call', compact('user','type','tags','tags_short'));
    }
     function converToTz($time="",$toTz='',$fromTz='',$format='Y-m-d H:i:s')
	{	
		// timezone by php friendly values
		$date = new DateTime($time, new DateTimeZone($fromTz));
		$date->setTimezone(new DateTimeZone($toTz));
		$time= $date->format($format);
		return $time;
	}  
    public function actionDelete_page_view($opt='')
    { 
		if(Yii::app()->request->isAjaxRequest){
				switch($opt){
					case 'all':
					$criteria=new CDbCriteria;
					$criteria->condition  =  1 ; 
					StatisticsPage::model()->deleteAll($criteria);
					 echo 1; exit; 
					break;
					case '30':
					 $criteria=new CDbCriteria;
					 $criteria->condition  =  1 ; 
					 $criteria->condition .= ' and   date < :fromdate ';
					 $t_date = $this->converToTz(date('Y-m-d h:i:s'),'Asia/Karachi','UTC','Y-m-d');
					 $from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
					 $criteria->params[':fromdate']    =  $from_date;
					 StatisticsPage::model()->deleteAll($criteria);
					 echo 1; exit; 
					 break;
				}
				 
			 
			 
		}
    }
    public function actionDelete_call($opt='',$type='')
    { 
		if(Yii::app()->request->isAjaxRequest){
			
				if(!in_array($type,array('E','C'))){
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
			
				switch($opt){
					case 'all':
					$criteria=new CDbCriteria;
					$criteria->condition  =  1 ; 
					 $criteria->condition .= '   and type = :type ';
					 $criteria->params[':type']    =  $type;
					Statistics::model()->deleteAll($criteria);
					 echo 1; exit; 
					break;
					case '30':
					 $criteria=new CDbCriteria;
					 $criteria->condition  =  1 ; 
					 $criteria->condition .= ' and   date < :fromdate and type = :type ';
					 $t_date = $this->converToTz(date('Y-m-d h:i:s'),'Asia/Karachi','UTC','Y-m-d');
					 $from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
					 $criteria->params[':fromdate']    =  $from_date;
					 $criteria->params[':type']    =  $type;
					 Statistics::model()->deleteAll($criteria);
					 echo 1; exit; 
					 break;
				}
				 
			 
			 
		}
    }public $tag;
     public function actionCustomer(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria= ListingUsers::model()->search(1);
		$criteria->compare(new CDbExpression('CONCAT(t.company_name, " ",t.first_name)'), $request->getQuery('q') , true);
		//$criteria->compare('t.company_name', $request->getQuery('q') , true,'OR');
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		$criteria->condition .= ' and t.parent_user is null  and t.company_name !="" ' ;
		//$criteria->compare('t.f_type','C');
		 $criteria->select = 't.user_id,t.company_name';
		$count = ListingUsers::model()->count($criteria);
		$criteria->order = 't.company_name'; 
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		
		$Result = ListingUsers::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->user_id,'text'=>$v->company_name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	} 
	 public function actionView_detail($type=null){
		 $this->layout ='m';
		 $request    = Yii::app()->request;
		 $category   = new Statistics('search_count');
			$category->unsetAttributes();
		 switch($type){
			 
			 case 'call':
			 $category->type ='C';
			 switch($_GET['duration']){
				 case 'today':
				 $titl = 'Call - Today';
				 break;
				 case '30day':
				 $titl = 'Call - Last 30 day';
				 break;
				 default:
				 $titl =   'Call - All Time';
				 break;
			 }
			 break;
			 case 'mail':
			 $category->type ='E';
			 switch($_GET['duration']){
				 case 'today':
				 $titl = 'Mail - Today';
				 break;
				 case '30day':
				 $titl = 'Mail - Last 30 day';
				 break;
				 default:
				 $titl =   'Mail - All Time';
				 break;
			 }
			  break;
			 case 'whatsapp':
			 $category->type ='W';
			 switch($_GET['duration']){
				 case 'today':
				 $titl = 'WhatsApp - Today';
				 break;
				 case '30day':
				 $titl = 'WhatsApp - Last 30 day';
				 break;
				 default:
				 $titl =   'WhatsApp - All Time';
				 break;
			 }
			  break;
			 case 'text':
			 $category->type ='T';
			 switch($_GET['duration']){
				 case 'today':
				 $titl = 'Text - Today';
				 break;
				 case '30day':
				 $titl = 'Text - Last 30 day';
				 break;
				 default:
				 $titl =   'Text - All Time';
				 break;
			 }
			  break;
			 
			
			
		 }
		 
		   $this->setData(array(  'pageHeading'       =>$titl ));
			
			$category->attributes = (array)$request->getQuery($category->modelName, array());
			$this->render('_list_call', compact('category'));
		 
		 
		 
		  $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Statistics  Dashboard'), 
            'pageHeading'       => Yii::t('agent',  'Statistics  Dashboard'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
		//     $total_call_count = Statistics::model()->callCount();
	   // if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }
	 
	 
        
	} 


     public function actionPage_View_detail(){
		 $this->layout ='m';
		 $request    = Yii::app()->request;
		 $category   = new StatisticsPage('page_count');
			$category->unsetAttributes();
		 
			 switch($_GET['duration']){
				 case 'today':
				 $titl = 'Page View - Today';
				 break;
				 case '30day':
				 $titl = 'Page View - Last 30 day';
				 break;
				 default:
				 $titl =   'Page View - All Time';
				 break;
			 } 
		 
		   $this->setData(array(  'pageHeading'       =>$titl ));
			
			$category->attributes = (array)$request->getQuery($category->modelName, array());
			$this->render('_list_view', compact('category'));
		 
		 
		 
		  $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Statistics  Dashboard'), 
            'pageHeading'       => Yii::t('agent',  'Statistics  Dashboard'),
            'pageBreadcrumbs'   => array(
                
                Yii::t('app', 'View all')
            )
        ));
		//     $total_call_count = Statistics::model()->callCount();
	   // if(!empty($total_call_count)){ $total_call_count  = $total_call_count->s_count; }else{ $total_call_count  = 0; }
	 
	 
        
	}
}
