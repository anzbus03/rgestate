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
 
class ListingusersController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex($type=null,$f_type=null)
    {
         
        
         echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
     
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers('search');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        } 
        $user->unsetAttributes();
        $user->user_type = $type ; 
        if(!empty($f_type)){
             $user->f_type = $f_type; 
        }
        else{
             $user->f_type = 'C'; 
        }
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
        $user->search_agent = '1'; 
$user->isTrash = '0' ;

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Customers List'), 
            'pageHeading'       => Yii::t('agent',  'Customers List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/index/type/'.$type),
                Yii::t('app', 'View all')
            )
        ));
        if($user->f_type=='U'){
             $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Users List'), 
            'pageHeading'       => Yii::t('agent',  'Users List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/index/f_type/U'),
                Yii::t('app', 'View all')
            )
        ));
        }
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','type','tags','tags_short'));
    }
    public function actionCreated_by_me($type=null)
    {
        
         echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
     
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers('search');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        } 
        $user->unsetAttributes();
        $user->user_type = $type ; 
         $user->f_type = 'C'; 
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
        
       
         
        $user->search_agent = '1'; 
$user->isTrash = '0' ;
if(empty($user->created_by)){
   
$user->created_by = (int) Yii::app()->user->getId() ;
if(Yii::app()->user->getModel()->removable=='no'){
    $user->show_all = 1; 
    }
}
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'My Customers List'), 
            'pageHeading'       => Yii::t('agent',  'My Customers List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/created_by_me/type/'.$type),
                Yii::t('app', 'View all')
            )
        ));
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','type','tags','tags_short'));
    }
    public function actionSettings_panel(){
	}
    public function actionImpersonate(){
	}
    public function actionPriority(){
	}
      public function actionDuplicate($type=null)
    {
        
         echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
     
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers('duplicate');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        } 
        $user->unsetAttributes();
        $user->user_type = $type ; 
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
        $user->search_agent = '1'; 
$user->isTrash = '0' ;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users',  'Agents / Developers List'), 
            'pageHeading'       => Yii::t('agent',  'Agents / Developers List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/index/type/'.$type),
                Yii::t('app', 'View all')
            )
        ));
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('dupliacte', compact('user','type','tags','tags_short'));
    }
    
      function converToTzFn($time="",$toTz='',$fromTz='',$format='Y-m-d H:i:s')
	{	
		// timezone by php friendly values
		$date = new DateTime($time, new DateTimeZone($fromTz));
		$date->setTimezone(new DateTimeZone($toTz));
		$time= $date->format($format);
		return $time;
	} 
     public function actionExport_user($datepicker=null,$u_type=null){
		 
		$criteria=new CDbCriteria;
		$criteria->select = 't.user_type,first_name,full_number,email';
		$criteria->condition = '1';
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		if(!empty($u_type)){
		$criteria->condition .= ' and user_type = :utype ' ; 
		$criteria->params[':utype'] = $u_type;
		}
		if(!empty($datepicker)){
		$datepicker = $this->converToTzFn(date('Y-m-d 00:00:00',strtotime($datepicker)),'Asia/Karachi','UTC','Y-m-d h:i:s') ;
		$criteria->condition .= ' and date_added >= :dateadded ' ; 
		$criteria->params[':dateadded'] = $datepicker;
		}
			$criteria->condition .= ' and full_number is not null  ' ;  
			$criteria->order = 't.first_name asc ' ; 
		$total_result = ListingUsers::model()->findAll($criteria);
	  if(empty($total_result)){
		       throw new CHttpException(404, Yii::t('app', 'No result found to export.'));
      
	  }
Yii::import('common.extensions.excel.Classes.PHPExcel');
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Redspider")
							 ->setLastModifiedBy("Redspider")
							 ->setTitle("Office 2007 XLSX Agents Data")
							 ->setSubject("Office 2007 XLSX Agents Data")
							 ->setDescription("Pakistan Agents Data.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Agents Data file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "Name");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "Email");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "Phone");
//$objPHPExcel->getActiveSheet()->setCellValue('D1', "Fax");
//$objPHPExcel->getActiveSheet()->setCellValue('E1', "Is Client ?");

// Miscellaneous glyphs, UTF-8
$i= 2; 
 foreach($total_result as $res){
	$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $res->fullName)
	                              ->setCellValue('B' . $i,  $res->email)
	                               ->setCellValue('C' . $i,  $res->full_number);
	                              $i++;
	                              /*
	                              ->setCellValue('C' . $i, "PhoneNo $i")
	                              ->setCellValue('D' . $i, "FaxNo $i")
	                              ->setCellValue('E' . $i, true);
	                              * */
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('data');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="customer-data-'.date('Ymdhis').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 
	 }
     public function actionAutocomplete($term,$onlybroker=false)
    {
        $request = Yii::app()->request;
        if (!$request->isAjaxRequest) {
           // $this->redirect(array('listingusers/index'));
        }
       

        $criteria = new CDbCriteria();$criteria->condition .= '1';
        $criteria->select = 'user_id, first_name, last_name, email, full_number,t.company_name';
	
       
        if(!empty($term)){
         $criteria->condition .= ' and  ( CONCAT(first_name, " ", last_name) like :term or t.email like :term or t.full_number like :term or t.company_name like :term )  ';
         $criteria->params[':term']  = '%'.$term.'%';
        }
        
         if(AccessHelper::hasRouteAccess ('listingusers/index')){
		}
		else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
		 $criteria->condition .= ' and  t.created_by  = :usr   ';
		 $criteria->params[':usr']  =(int) Yii::app()->user->getId() ;
		}
        if(!empty($onlybroker)){
		    $criteria->condition .= ' and  t.user_type in  ("A","C","D")   ';
	   }
        $criteria->limit = 10;

        $models = ListingUsers::model()->findAll($criteria);
        $results = array();

        foreach ($models as $model) {
			$company_name = !empty($model->company_name) ? '('.$model->company_name.')' : '';
			$full_name =  $model->first_name.' '.$model->last_name.' '.$company_name ; 
            $results[] = array(
                'customer_id' => $model->user_id,
                'value'       => $full_name,
            );
        }

        return $this->renderJson($results);
    }
    public function actionVisitors($type='U')
    {
        
         echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
     
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers('search');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        } 
        $user->unsetAttributes();
        $user->user_type = $type ; 
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
        $user->search_visitor = '1'; 
$user->isTrash = '0' ;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', $user->typeTile.' List'), 
            'pageHeading'       => Yii::t('agent', $user->typeTile.' List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/index/type/'.$type),
                Yii::t('app', 'View all')
            )
        ));
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','type','tags','tags_short'));
    }
     
      public function actionUpdate_cache( )
    {
        Yii::App()->options->set('system.common.featured_key',time());
         
          $request = Yii::app()->request; $notify = Yii::app()->notify; 
          $notify->addSuccess(Yii::t('app', 'Successfully updated cache key!'));
         $this->redirect($request->getPost('returnUrl', array($this->id.'/index')));
    }
     public function actionTrash($type=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers('search');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        } 
        $user->unsetAttributes();
        $user->user_type = $type ; 
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
 $user->isTrash = '1' ;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', $user->typeTile.' List'), 
            'pageHeading'       => Yii::t('agent', 'Trash '.$user->typeTile.' List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', $user->typeTile) => $this->createUrl('listingusers/index/type/'.$type),
                Yii::t('app', 'View all')
            )
        ));
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','type','tags','tags_short'));
    }
    /**
     * Create a new user
     */
    public function actionCreate($type=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new ListingUsers();
        $user->scenario = 'new_front_insert';
         $user->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        $user->user_type = $type;
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
         if (isset(Yii::app()->params['POST'][$user->modelName]['cover_letter'])) {
                $user->cover_letter =  Yii::app()->params['POST'][$user->modelName]['cover_letter'] ;
            }
           
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
			
				if(AccessHelper::hasRouteAccess ('listingusers/index')){
                $this->redirect(Yii::App()->createUrl('listingusers/index/type/'.$user->user_type));
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
                $this->redirect(Yii::App()->createUrl('listingusers/created_by_me/type/'.$user->user_type));
				 
				}
            }
        }
          if(AccessHelper::hasRouteAccess ('listingusers/index')){
						$index ='index';
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
						$index ='created_by_me';
				 
				} 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Create '.$user->typeTile), 
            'pageHeading'       => Yii::t('agent', 'Create '.$user->typeTile),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', $user->typeTile) => $this->createUrl('listingusers/'.$index.'/type'.$type),
                Yii::t('app', 'Create new'),
            )
        ));
        
             $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		
		
		$this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js') ));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
		
		       $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
       $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user','type','index'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $user = ListingUsers::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not existd.'));
        }
        
          $user->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        $user->scenario = 'new_update';
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
             if (isset(Yii::app()->params['POST'][$user->modelName]['cover_letter'])) {
                $user->cover_letter =  Yii::app()->params['POST'][$user->modelName]['cover_letter'] ;
            }
            if($user->password=="")
            {
				unset($user->password);
		  	    $user->con_password ='';
			}
		//	$user->user_type = 'U';
			 
            if (!$user->save()) {
              
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
              if ($collection->success) {
				if(AccessHelper::hasRouteAccess ('listingusers/index')){
                $this->redirect(Yii::App()->createUrl('listingusers/index/type/'.$user->user_type));
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
                $this->redirect(Yii::App()->createUrl('listingusers/created_by_me/type/'.$user->user_type));
				 
				}
            }
        }
       
     //  echo  $user->password;echo "SDSD";exit;
            $user->password="";
            $user->con_password="";
           if(AccessHelper::hasRouteAccess ('listingusers/index')){
						$index ='index';
				}
				else if(AccessHelper::hasRouteAccess ('listingusers/created_by_me')){
						$index ='created_by_me';
				 
				} 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('capacity', 'Update '.$user->typeTile),
            'pageHeading'       => Yii::t('agent', 'Update '.$user->typeTile),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', $user->typeTile) => $this->createUrl('listingusers/'.$index .'/type/'.$user->user_type),
                Yii::t('app', 'Update'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js') ));
        			 
        $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
       
        $this->render('form', compact('user','index'));
    }
    
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = ListingUsers::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->updateBypk($id,array('isTrash'=>'1'));    
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('develpers/index')));
        }
    }
    
   public function actionImage_crop(){
		
 
		 			
		 			$newArray = (object) array(
		 			'x'=> $_GET['imgX5'],
		 			'y'=> $_GET['imgY5'],
		 			'height'=>$_GET['widthY'] ,
		 			'width'=> $_GET['widthX'],
		 			'cropW'=> $_GET['cropW'],
		 			'cropH'=> $_GET['cropH'],
		 			'rotate'=> $_GET['rotation'] ,
		 			);
		 			
		 		 
		 			
					$ext  = pathinfo($_GET['imgUrl'], PATHINFO_EXTENSION);
					$file = pathinfo($_GET['imgUrl'] , PATHINFO_FILENAME);
					$src   =  $file.'.'.$ext;  
					$src =  '../uploads/images' .'/'.$src ;
					$output_filename = "../uploads/resized/".$file.'.'.$ext;  
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
       $colorTransparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
      imagefill($dst_img, 0, 0, $colorTransparent);
      imagesavealpha($dst_img, true);


 

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
      public function actionResentEmail($id=null){
		$model = ListingUsers::model()->findByPk($id);
		if(!empty($model)){
			$model->resentverification();
			echo json_encode(array('status'=>'success'));
		}
		else{
			echo json_encode(array('status'=>'failed','message'=>'No User found under this ID'));
		}
		Yii::app()->end();
		
	}
    public function actionView($id)
    {
		 
        $user = ListingUsers::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
       
        $personal =  PersonalInformation::model()->findByAttributes(array('user_id'=>$user->user_id,'f_type'=>'P'));
        $this->renderPartial('_view', compact('user','model','personal'));
    }
     public function actionStatus_change($id=null,$val=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			return false;
		}
        $user = ListingUsers::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        $user::model()->updateByPk($id,array('status'=>$val));
        echo 1; 
    }
    public function actionStatus_change2($id=null,$val=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			return false;
		}
        $user = ListingUsers::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        $user->updateByPk($id,array('status'=>$val));$user->status = $val;
         echo json_encode(array('status'=>1,'html'=>$user->MemebrApproved)); 
    }
     public function actionFeatured($id,$featured)
    {
        $model = ListingUsers::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
            $featured = ($featured=="N") ? "Y" : "N";
            $model->updateByPk($id,array('featured'=>$featured ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('type'=>$model->user_type))));
        }
    }
    
      public function actionBulk_action()
    {
		
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        if ($action == ListingUsers::BULK_ACTION_TRASH && count($items)) {
            $affected = 0;
            $customerModel = new  ListingUsers();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				//echo $customer->id;echo "<br />";
				 
                $customer->updateByPk($item,array('isTrash'=>'1'));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
        if ($action == ListingUsers::BULK_ACTION_RESTORE && count($items)) {
            $affected = 0;
            $customerModel = new  ListingUsers();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				//echo $customer->id;echo "<br />";
				 
                $customer->updateByPk($item,array('isTrash'=>'0'));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
        if ($action == ListingUsers::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new  ListingUsers();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				 
                $customer->delete();;  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
        if ($action == ListingUsers::BULK_ACTION_FEATURED && count($items)) {
            $affected = 0;
            $customerModel = new  ListingUsers();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				//echo $customer->id;echo "<br />";
				 
                $customer->updateByPk($item,array('featured'=>'Y'));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }
        if ($action == ListingUsers::BULK_ACTION_UNFEATURED && count($items)) {
            $affected = 0;
            $customerModel = new  ListingUsers();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				//echo $customer->id;echo "<br />";
				 
                $customer->updateByPk($item,array('featured'=>'N'));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        } 
        $defaultReturn = $request->getServer('HTTP_REFERER', array('listingusers/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
     public function actionCsv_import()
    {
        $list     = array();
        $options  = Yii::app()->options;
        $request  = Yii::app()->request;
        $notify   = Yii::app()->notify;
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('list-import.js')));
		 
        $importLog = array();
        $filePath  = Yii::getPathOfAlias('common.runtime.list-import').'/';

        $importAtOnce = (int)$options->get('system.importer.import_at_once', 50);
        $pause        = (int)$options->get('system.importer.pause', 1);

        set_time_limit(0);
        if ($memoryLimit = $options->get('system.importer.memory_limit')) {
            ini_set('memory_limit', $memoryLimit);
        }
        ini_set('auto_detect_line_endings', true);

        $import = new ListCsvImport('upload');
        $import->file_size_limit = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1); // 1 mb
        $import->attributes      = (array)$request->getPost($import->modelName, array());
        $import->file            = CUploadedFile::getInstance($import, 'file');

        if (!empty($import->file)) {
            if (!$import->upload()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                $notify->addError($import->shortErrors->getAllAsString());
                $this->redirect(array('dashboard/Create_import'));
            }

            $this->setData(array(
                'pageMetaTitle'     => $this->data->pageMetaTitle.' | '.Yii::t('list_import', 'Import Companies'),
                'pageHeading'       => Yii::t('list_import', 'Import Companies'),
                'pageBreadcrumbs'   => array(
                    Yii::t('leads', 'Companies') => $this->createUrl('listingusers/index/type/L'),
                    Yii::t('list_import', 'CSV Import')
                )
            ));

             return $this->render('csv', compact('list', 'import', 'importAtOnce', 'pause'));echo 'wer';exit; 
        }

        // only ajax from now on.
        if (!$request->isAjaxRequest) {
           // $this->redirect(array('leads/index'));
        }

       try {

            if (!is_file($filePath.$import->file_name)) {
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'The import file does not exist anymore!')
                ));
            }

 
            $file = new SplFileObject($filePath.$import->file_name);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE | SplFileObject::READ_AHEAD);
            $columns = $file->current(); // the header


 

            if (empty($columns)) {
                unset($file);
                @unlink($filePath.$import->file_name);
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'Your file does not contain the header with the fields title!')
                ));
            }

            if ($import->is_first_batch) {
                $linesCount         = iterator_count($file);
                $totalFileRecords   = $linesCount - 1; // minus the header
                $import->rows_count = $totalFileRecords;
            } else {
                $totalFileRecords = $import->rows_count;
            }

            $file->seek(1);

            
            $totalSubscribersCount = 0;
            $listSubscribersCount  = 0;
            $maxSubscribersPerList = (int)  -1 ;
            $maxSubscribers        = (int)  -1 ;

            /*
            $criteria = new CDbCriteria();
            $criteria->select = 'field_id, label, tag';
            $criteria->compare('list_id', $list->list_id);
            $fields = ListField::model()->findAll($criteria);
            * */
			$fields = array();
            $foundTags = array();
            $searchReplaceTags = array(
                'E_MAIL'        => 'EMAIL',
                'EMAIL_ADDRESS' => 'EMAIL',
                'EMAILADDRESS'  => 'EMAIL',
            );
            foreach ($fields as $field) {
				 
                if ($field->tag == 'FNAME') {
                    $searchReplaceTags['F_NAME']     = 'FNAME';
                    $searchReplaceTags['FIRST_NAME'] = 'FNAME';
                    $searchReplaceTags['FIRSTNAME']  = 'FNAME';
                    continue;
                }
                if ($field->tag == 'LNAME') {
                    $searchReplaceTags['L_NAME']    = 'LNAME';
                    $searchReplaceTags['LAST_NAME'] = 'LNAME';
                    $searchReplaceTags['LASTNAME']  = 'LNAME';
                    continue;
                }
            }
 
            $ioFilter = Yii::app()->ioFilter;
            $columns  = (array)$ioFilter->stripTags($ioFilter->xssClean($columns));
            $columns  = array_map('trim', $columns);

            foreach ($columns as $value) {
                $tagName     = StringHelper::getTagFromString($value);
                $tagName     = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $tagName);
                $foundTags[] = $tagName;
            }
            
      
            $foundEmailTag = false;
            foreach ($foundTags as $tagName) {
                if ($tagName === 'EMAIL') {
                    $foundEmailTag = true;
                    break;
                }
            }

            if (!$foundEmailTag) {
                unset($file);
                @unlink($filePath.$import->file_name);
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'Cannot find the "email" column in your file!')
                ));
            }

            $foundReservedColumns = array();
            $field_check_array = array(
					'email' => array('Email','email') ,
					'state_id' => array('city'),
					'first_name' => array('name'),
					'company_name' => array('company'),
					'phone' => array('mobile'),
					'mobile' => array('phone'),
					'sa' => array('servicearea'),
					'lu' =>array('logourl') ,
					'ptypes' =>array('propertytypes') ,
					'for' => array('propertiesfor'),
					'description' => array('description'),
					 
					);
					$find_array =array();
					foreach ($columns as $columnName) {
					 
						foreach($field_check_array as $k=>$check_columValue ){
							 
							$found_clmn = array_search(strtolower($columnName) ,(array)$check_columValue);
							 
							if( strlen($found_clmn)>=1){
								$find_array[$k] = strtolower($columnName);
								break;
							}
						}

					}
					
					 
            foreach ($columns as $columnName) {
				 
				  
				 
                $columnName     = StringHelper::getTagFromString($columnName);
                $columnName     = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $columnName);
             
            }
           

            if ($import->is_first_batch) {
                /*
                if ($logAction = Yii::app()->customer->getModel()->asa('logAction')) {
                    $logAction->listImportStart($list, $import);
                }
                * */

                $importLog[] = array(
                    'type'    => 'info',
                    'message' => Yii::t('list_import', 'Found the following column names: {columns}', array(
                        '{columns}' => implode(', ', $columns)
                    )),
                    'counter' => false,
                );
            }

            $offset = $importAtOnce * ($import->current_page - 1);
            if ($offset >= $totalFileRecords) {
                return $this->renderJson(array(
                    'result'  => 'success',
                    'message' => Yii::t('list_import', 'The import process has finished!')
                ));
            }
            $file->seek($offset);

            $csvData     = array();
            $columnCount = count($columns);
            $i           = 0;

            while (!$file->eof()) {

                $row = $file->fgetcsv();
                if (empty($row)) {
                    continue;
                }

                $row = (array)$ioFilter->stripTags($ioFilter->xssClean($row));
                $row = array_map('trim', $row);
                $rowCount = count($row);

                if ($rowCount == 0) {
                    continue;
                }

                $isEmpty = true;
                foreach ($row as $value) {
                    if (!empty($value)) {
                        $isEmpty = false;
                        break;
                    }
                }

                if ($isEmpty) {
                    continue;
                }

                if ($columnCount > $rowCount) {
                    $fill = array_fill($rowCount, $columnCount - $rowCount, '');
                    $row  = array_merge($row, $fill);
                } elseif ($rowCount > $columnCount) {
                    $row  = array_slice($row, 0, $columnCount);
                }

                $csvData[] = array_combine($columns, $row);

                ++$i;

                if ($i >= $importAtOnce) {
                    break;
                }
            }
            unset($file);

            $fieldType =  array();

            $data = array();
            foreach ($csvData as $row) {
                $rowData = array();
                foreach ($row as $name => $value) {
                    $tagName = StringHelper::getTagFromString($name);
                    $tagName = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $tagName);

                    $rowData[] = array(
                        'name'      => ucwords(str_replace('_', ' ', $name)),
                        'tagName'   => trim($tagName),
                        'tagValue'  => trim($value),
                    );
                }
                $data[] = $rowData;
            }
          
            unset($csvData);

            if (empty($data) || count($data) < 1) {
                @unlink($filePath.$import->file_name);

                if ($logAction = Yii::app()->customer->getModel()->asa('logAction')) {
                    $logAction->listImportEnd($list, $import);
                }

                if ($import->is_first_batch) {
                    return $this->renderJson(array(
                        'result'  => 'error',
                        'message' => Yii::t('list_import', 'Your file does not contain enough data to be imported!')
                    ));
                } else {
                    return $this->renderJson(array(
                        'result'  => 'success',
                        'message' => Yii::t('list_import', 'The import process has finished!')
                    ));
                }
            }

            $tagToModel = array();
           

            // since 1.3.5.9
            $bulkEmails = array();
            foreach ($data as $index => $fields) {
                foreach ($fields as $detail) {
                    if ($detail['tagName'] == 'EMAIL' && !empty($detail['tagValue'])) {
                        $email = $detail['tagValue'];
                       
                        break;
                    }
                }
            }
            $failures = (array)Yii::app()->hooks->applyFilters('list_import_data_bulk_check_failures', array(), (array)$bulkEmails);
            foreach ($failures as $email => $message) {
                EmailBlacklist::addToBlacklist($email, $message);
            }
            // end 1.3.5.9

            $finished    = false;
            $importCount = 0;

            // since 1.3.5.9
            Yii::app()->hooks->doAction('list_import_before_processing_data', $collection = new CAttributeCollection(array(
                'data'        => $data,
                'list'        => $list,
                'importLog'   => $importLog,
                'finished'    => $finished,
                'importCount' => $importCount,
                'failures'    => $failures,
                'importType'  => 'csv'
            )));

            $data        = $collection->data;
            $importLog   = $collection->importLog;
            $importCount = $collection->importCount;
            $finished    = $collection->finished;
            $failures    = $collection->failures;
            //

            $transaction = Yii::app()->getDb()->beginTransaction();
            $mustCommitTransaction = true;

            try {
                 
                $model = new ListingUsers();
                $attribute_array = array();
			 
				$company_grade_value = array();
				$company_type_value = array();
				
				
                foreach ($data as $index => $fields) {
					
					
					  $attribute_array = array();
				  
                    foreach ($fields as $detail) {
						
						$tag_name_small = strtolower($detail['tagName']);
						$tag_name_value = trim($detail['tagValue']);
						
					 
						if(empty($tag_name_value)){ continue;}
						
						 $attribute_name = array_search($tag_name_small,$find_array);
						 
						 
						  
						 if(strlen($attribute_name)>=1){
							 
							  if($attribute_name=='state_id') { 
								 $found_grade = States::model()->findByPk($tag_name_value);
							 
								 if( $found_grade){
									$tag_name_value = $found_grade->state_id;
									$attribute_array['country_id'] = $found_grade->country_id; 
								 }
								 else{ 
								 }
								   
							    }
							    /*service_area*/
							  if($attribute_name=='sa') { 
								 $service_areas =  explode(',',$tag_name_value);
								 if(!empty( $service_areas)){
									 $s_area = array(); 
									 foreach( $service_areas as $k=>$service_area){
									    //$s_area[] = $service_area;
									     
										$found_grade = States::model()->search_by_term(trim(strtolower($service_area)));
										if( $found_grade){
											$s_area[] = $found_grade->state_id;
											 
										}
										 
									 }
									 $attribute_array['mul_state_id'] =  $s_area ; 
								 }
								   
							    }
							  if($attribute_name=='for') { 
								 $service_areas =  explode(',',$tag_name_value);
								 if(!empty( $service_areas)){
									 
									 $attribute_array['service_offerng'] =  $service_areas ; 
								 }
								   
							    }
							  if($attribute_name=='ptypes') { 
								 $service_areas =  explode(',',$tag_name_value);
								 $s_areas =array(); 
								 
								 if(!empty( $service_areas)){
									 foreach( $service_areas as $k=>$service_area){
										 if (strpos( $service_area ,'S-') !== false) {
										  
										}
										else{
											 
											$s_areas[] =   $service_area  ; 
										}
								 }
								  if(!empty( $s_areas)){
									 
									 $attribute_array['service_offerng_detail'] =  $s_areas ; 
								 }
									}
							    }
							  if($attribute_name=='phone') { 
								    $tag_name_value = Yii::t('app',$tag_name_value,array('-'=>''));
									$attribute_array['full_number'] =  $tag_name_value ; 
									$tag_name_value =  substr($tag_name_value, -10); 
								 
								   
							    }
							    /*logo Url*/
							  if($attribute_name=='lu') { 
							        if(strpos($tag_name_value, '.jpg') !== false){
									$file_format = 'jpeg';
									$img =date('Y-m-d-h-i-s').'-'.rand(0,9999).'-'.time().".".$file_format;
									$path_file =  Yii::getPathOfAlias('root.uploads.files');
									$year_folder = $path_file .'/'. date("Y");
									$month_folder = $year_folder . '/' . date("m");
									$month_folder2 = date("Y"). '/' . date("m");
									!file_exists($year_folder) && mkdir($year_folder , 0777);
									!file_exists($month_folder) && mkdir($month_folder, 0777);
									$path_file = $month_folder ;

									file_put_contents( $path_file."/{$img}", file_get_contents($tag_name_value)); 
									$tag_name_value =   $month_folder2. '/' .$img;   ; 
								   $attribute_array['image'] = $tag_name_value; 
							        }
							        else{
							             $attribute_array['image'] = '' ; 
							        }
							    }
							  
								
								$attribute_array[$attribute_name] = $tag_name_value; 
						 }
                        	
			
                        
                         
                    }
                     unset($attribute_array['sa']);
                     unset($attribute_array['ptypes']);
                     unset($attribute_array['lu']);
                     unset($attribute_array['for']);
                    // print_r($attribute_array);exit; 
                   
					$email = $attribute_array['email'];
                    if (empty($email)) {
                        unset($data[$index]);
                       // continue;
                    }

                    $importLog[] = array(
                        'type'    => 'info',
                        'message' => Yii::t('list_import', 'Checking the list for the email: "{email}"', array(
                            '{email}' => CHtml::encode($email),
                        )),
                        'counter' => false,
                    );

                    if (!empty($failures[$email])) {
                        $importLog[] = array(
                            'type'    => 'error',
                            'message' => Yii::t('list_import', 'Failed to save the email "{email}", reason: {reason}', array(
                                '{email}'  => CHtml::encode($email),
                                '{reason}' => '<br />'.$failures[$email],
                            )),
                            'counter' => true,
                        );
                        continue;
                    }

                    $subscriber = null;
                    if (!empty($email)) {
                        $subscriber = ListingUsers::model()->findByAttributes(array(
                            'email'   => $email,
                        ));
                    }

                    if (empty($subscriber)) {

                        $importLog[] = array(
                            'type'    => 'info',
                            'message' => Yii::t('list_import', 'The email "{email}" was not found, we will try to create it...', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => false,
                        );

                        $subscriber =   ListingUsers::model()->findByAttributes(array('email'=>$attribute_array['email']));
                        if(empty($subscriber)){   $subscriber =  ListingUsers::model()->findByPhoneLast10(Yii::t('app',$attribute_array['full_number'],array(' '=>''))); }
                        if(empty($subscriber)){   $subscriber  = new ListingUsers(); }
                        $subscriber->attributes = $attribute_array;
                        $subscriber->service_offerng = $attribute_array['service_offerng'];
                        $subscriber->mul_state_id = $attribute_array['mul_state_id'];
                        $subscriber->service_offerng_detail = $attribute_array['service_offerng_detail'];
                        $subscriber->full_number = $attribute_array['full_number'];
                        $subscriber->email_verified = '0' ;
                        $subscriber->o_verified = '1' ;
                        $subscriber->enable_l_f = '1' ;
                        
                        
                        
                        $subscriber->user_type  = 'A';
                       // $subscriber->email_verified  = '1';
                        //$subscriber->first_name  = $subscriber->company_name;
                        $subscriber->password  = 'FEETAPK';
                        $subscriber->con_password  = 'FEETAPK';
                        $subscriber->scenario  = 'new_update1';
                       
                        $validator = new CEmailValidator();
                        $validator->allowEmpty  = false;
                        $validator->validateIDN = true;
                         
						 $emailArray = array_map('trim', explode(' ', $email));
                         
                         $email_block =  array();
                         $emailArray   = array_map('trim', explode(',', $email));
                         if(!empty($emailArray)){
							 foreach($emailArray as $eM){
								 if($validator->validateValue($eM)){
									 $email_block[] = $eM;
								 }
							 }
						 }
						 $validEmail = !empty($email) && $validator->validateValue($email);

                         if (!$validEmail) {
                            $subscriber->addError('email', Yii::t('list_import', 'Invalid email address!'));
                         } 
                   
						
                        if ($subscriber->hasErrors() || !$subscriber->save()) {
							
                            $importLog[] = array(
                                'type'    => 'error',
                                'message' => Yii::t('list_import', 'Failed to save the email "{email}", reason: {reason}', array(
                                    '{email}'  => CHtml::encode($email),
                                    '{reason}' => '<br />'.$subscriber->shortErrors->getAllAsString()
                                )),
                                'counter' => true,
                            );
                            continue;
                        }
                        else { 
							
						}

                        $listSubscribersCount++;
                        $totalSubscribersCount++;

                      

                        $importLog[] = array(
                            'type'    => 'success',
                            'message' => Yii::t('list_import', 'The email "{email}" has been successfully saved.', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => true,
                        );

                    } else {

                        $importLog[] = array(
                            'type'    => 'info',
                            'message' => Yii::t('list_import', 'The email "{email}" has been found, we will update it.', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => true,
                        );
                    }

                  

                    unset($data[$index]);
                    ++$importCount;

                    if ($finished) {
                        break;
                    }
                }

                $transaction->commit();
                $mustCommitTransaction = false;

            } catch(Exception $e) {

                if (isset($file)) {
                    unset($file);
                }

                if (is_file($filePath.$import->file_name)) {
                    @unlink($filePath.$import->file_name);
                }

                $transaction->rollback();
                $mustCommitTransaction = false;

                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => $e->getMessage(),
                ));
            }

            if ($mustCommitTransaction) {
                $transaction->commit();
            }

            if ($finished) {
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => $finished,
                ));
            }

            $import->is_first_batch = 0;
            $import->current_page++;

            return $this->renderJson(array(
                'result'    => 'success',
                'message'   => Yii::t('list_import', 'Imported {count} subscribers starting from row {rowStart} and ending with row {rowEnd}! Going further, please wait...', array(
                    '{count}'    => $importCount,
                    '{rowStart}' => $offset,
                    '{rowEnd}'   => $offset + $importAtOnce,
                )),
                'attributes'   => $import->attributes,
                'import_log'   => $importLog,
                'recordsCount' => $totalFileRecords,
            ));
 
        } catch(Exception $e) {

            if (isset($file)) {
                unset($file);
            }

            if (is_file($filePath.$import->file_name)) {
                @unlink($filePath.$import->file_name);
            }

            return $this->renderJson(array(
                'result'  => 'error',
                'message' => Yii::t('list_import', 'Your file cannot be imported, a general error has been encountered: {message}!', array(
                    '{message}' => $e->getMessage()
                ))
            ));

        }
        
    }
   
   
    public function actionCreate_import()
    {
		  
        
      
       
        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->name . ' | ' . Yii::t('dashboard', 'Agent Import'), 
            'pageHeading'       => Yii::t('dashboard', 'Agent Import'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard', 'Agent Import'),
            ),
        ));
        $options = Yii::app()->options; 
       $maxUploadSize = '4';
        $importCsv  = new ListCsvImport('upload');
        $webEnabled = $options->get('system.importer.web_enabled', 'yes') == 'yes';
		$maxUploadSize = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1) / 1024 / 1024;
		
        $this->render('_csv_impoter', compact('checkVersionUpdate','ads','usr','maxUploadSize','importCsv','webEnabled','options'));
    }   
    public function _setupEditorOptions(CEvent $event)
    {
        if (!in_array($event->params['attribute'], array('cover_letter'))) {
            return;
        }
        
        $options = array();
        if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
            $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
        }
        $options['id'] = CHtml::activeId($event->sender->owner, $event->params['attribute']);
        
        if ($event->params['attribute'] == 'cover_letter') {
            $options['toolbar']= 'Simple';
            $options['fullPage'] = false;
            $options['allowedContent'] = true;
            $options['height'] = 200;
        } 

        $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
    }

}
