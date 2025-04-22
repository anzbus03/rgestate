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
 
class RegionController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Region";
     public $focus = "state_name";
     public function init()
    {
    
        parent::init();
       
        
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
         
      
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new States('serach');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$model->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				Yii::import('backend.controllers.TranslateController');
			    $controller = new TranslateController('translate','');
                $sortOrderAll = $_POST['bulk'];
				if(count($sortOrderAll)>0)
				{
					set_time_limit(0);
					$sortOrderAll =  array_filter($sortOrderAll);
					foreach($sortOrderAll as $menuId=>$message)
					{
						 
						$id = 'States_state_name_'.$menuId;
						$relation = 'state_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
				
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				 Yii::app()->options->set('system.common.city_cache',date('Ymdhis').time());
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list', compact('model'));
    }
    
    public function actionCreate($name=null,$reg=null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new States();
        if(!empty($name)){
            
            if(!empty($reg)){
            $reg_found =  MainRegion::model()->findByAttributes(array('name'=>$reg));
            if($reg_found){
                $model->country_id = $reg_found->country_id;
                $model->region_id = $reg_found->region_id;
            }
           
            }
            $model->state_name = $name;$model->p_name = $name;
        }
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            $uploadedFile=CUploadedFile::getInstance($model,'icon');
            if($uploadedFile){			 
				$fileName = 'i'.rand(100,1000).$uploadedFile;
				$model->icon = $fileName;
		    }
           if($model->location_longitude!="" and $model->location_longitude!="")
            {
				$model->location="1";
			}
			 if(!empty($model->mul_city)){
					$text = trim($model->mul_city); // remove the last \n or whitespace character
					$text = explode("\n", $text);
				 
					if(!empty($text)){ 
						 $model->scenario = 'mul_city';
						foreach($text as $k=>$city){
								if(empty($city)){ continue; }
								$model2 = new states();
							 	$model2->country_id = $model->country_id;
							 	$model2->region_id = $model->region_id;
								$model2->state_name = $city;
								if(!$model2->save()){ print_r($model2->getErrors()); exit;  };

						}
						 $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
						 $this->redirect(Yii::App()->CreateUrl('region/index'));
					}
 
					}
             if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				if($uploadedFile)
				{
					$path =  Yii::app()->basePath . '/../../uploads';
					$uploadedFile->saveAs($path.'/default/'. $fileName);
				}
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array(Yii::app()->controller->id.'/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = States::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
             $model->attributes = $attributes;
            // $model->slug = $model->getUniqueSlug();
             $oldfilename =$model->icon;
             $file = CUploadedFile::getInstance($model, 'icon');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {	          
				
				$fileName = 'i'.rand(100,1000).$file;
				$model->icon = $fileName;
			 }  
            if($model->location_longitude!="" and $model->location_longitude!="")
            {
				$model->location="1";
			}
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if (is_object($file) && get_class($file)==='CUploadedFile') {				 
					$path =  Yii::app()->basePath . '/../../uploads';
					$file->saveAs($path.'/default/'. $fileName);
					if ($oldfilename != $fileName) {
					@unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename);
					}
				} 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array(Yii::app()->controller->id.'/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = States::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('isTrash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    
   
    public function actionBulk_action()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $action = $_GET['bulk_action'];
        $items  = $_GET['bulk_item'];

        if ($action == PlaceAnAd::BULK_ACTION_TRASH && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('isTrash' => '1'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_RESTORE && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('isTrash' => '0'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_TRASLATE && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->getUpdateTag();
                $customer->getUpdateImages();
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_UNPUBLISH && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('status' => 'I'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_UNLEASE && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('property_status' => '0'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_PUBLISH && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('status' => 'A'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }


        if ($action == PlaceAnAd::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new States();
            foreach ($items as $item) {
            
                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                $customer->delete();;
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_EXPIRED && count($items)) {


            $affected = 0;
            $customerModel = new States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                $customer->updateByPk($customer->id, array('extended_on' => date('Y-m-d h:i:s'), 'n_send_at' => NULL));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_SENDNOTIFICATIOB && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                $send =      $customer->SendNotificationExpire;
                PlaceAnAd::model()->updateByPk($customer->id, array('n_send_at' => date('Y-m-d h:i:s')));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_REFRESH && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                PlaceAnAd::model()->updateByPk($customer->id, array('last_updated' => date('Y-m-d H:i:s')));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }



        if ($action == PlaceAnAd::BULK_ACTION_DOWNLOAD && count($items)) {
            $affected = 0;
            $customerModel = new  States();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                $ids =   $customer->city;
                if (!empty($ids)) {
                    $citymodel = City::model()->findByPk((int)$ids);
                    if (!empty($citymodel) and !empty($citymodel->location_latitude) and !empty($citymodel->location_longitude)) {

                        $src  = 'https://maps.googleapis.com/maps/api/staticmap?center = ' . $citymodel->location_latitude . '%2C' . $citymodel->location_longitude . '&language = en&size = 640x256&zoom = 15&scale = 1&key = AIzaSyCE4LF1fuKkM5b0ffhY7dEoZ4ULkG2Uazk';
                        $time = date('Ymdhis') . '_' . time();
                        $desFolder =   Yii::getPathOfAlias('root.uploads.map') . '/';;
                        $imageName = 'google-map_' . $time . '.png';
                        $imagePath = $desFolder . $imageName;
                        file_put_contents($imagePath, file_get_contents($src));
                        $citymodel->updateByPk($citymodel->city_id, array('image' => $imageName));
                        $affected++;
                    }
                }
            }

            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        $defaultReturn = $request->getServer('HTTP_REFERER', array('place_property/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
}
