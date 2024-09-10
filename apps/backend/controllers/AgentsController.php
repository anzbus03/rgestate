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
 
class AgentsController extends Controller
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
    public function actionIndex()
    {
	 
		
 
        $request = Yii::app()->request; $notify = Yii::app()->notify;
        $user = new user('search');
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
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Agents List'), 
            'pageHeading'       => Yii::t('agent', 'Agents List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'Agents') => $this->createUrl('agents/index'),
                Yii::t('app', 'View all')
            )
        ));
      
        $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','tags','tags_short'));
    }

      /**
     * List of  users
     */
    public function actionList(){
        $request = Yii::app()->request; 
        $notify = Yii::app()->notify;
        $users = new user();

        $users->unsetAttributes();

        // for filters.
        $users->attributes = (array)$request->getQuery($users->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('users', 'View users'),
            'pageHeading'       => Yii::t('users', 'View users'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('list', compact('users'));
    }
    
    /**
     * Create a new user
     */
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new User();
        // $user->scenario = 'agent_insert';
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
        
            if (!$user->save()) {
                $errors = CHtml::errorSummary($user);
                $notify->addError(Yii::t('app', 'There were errors: ' . $errors));
            }else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('agents/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Create Agent'), 
            'pageHeading'       => Yii::t('agent', 'Create Agent'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Agent') => $this->createUrl('agents/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));

        $this->render('form', compact('user'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $user = Agents::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
           $user->scenario = 'agent_update';
        
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if($user->password=="")
            {
				unset($user->password);
				 $user->con_password = '';
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
                $this->redirect(array('agents/index'));
            }
        }
       
     //  echo  $user->password;echo "SDSD";exit;
            $user->password="";
            $user->con_password="";
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('capacity', 'Update Agent'),
            'pageHeading'       => Yii::t('agent', 'Update Agent'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Agent') => $this->createUrl('agents/index'),
                Yii::t('app', 'Update'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = Agents::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->updateBypk($id,array('isTrash'=>'1'));    
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('agents/index')));
        }
    }
      public function actionLoadCity_latest($state_id=null)
	{
	   $data=States::model()->findAllByAttributes(array('state_id'=>$state_id));
	   $data=CHtml::listData($data,'id','name');
	   echo "<option value=''>Select City</option>";
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
	public function actionloadArea($country_id=null){
		 
		
		 
		$limit = 30;
		$request = Yii::app()->request;
		$criteria=new CDbCriteria;
        $criteria->compare('state_name',$request->getQuery('q'), true);
        $criteria->compare('t.isTrash','0');
         
        $criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = t.country_id  ' ;
         //$criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END ';
        $criteria->compare('t.country_id',(int)$country_id);
        
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
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
		 
	 
	}
	public function actionFeatured($id,$featured)
    {
        $model = Agents::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
            $featured = ($featured=="N") ? "Y" : "N";
            $model->updateByPk($id,array('featured'=>$featured ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    
}
