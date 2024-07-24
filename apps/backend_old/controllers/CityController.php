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
 
class CityController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Location";
     public $focus = "city_name";
     public function init()
    {
    
        parent::init();
       
        
    }
 
    /**
     * List all available users
     */
    public function actionIndex($update_cache=null)
    {
        
        
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new City('serach');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
                $location_latitude = $_POST['location_latitude'];
                $location_longitude = $_POST['location_longitude'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$model->updateByPk($menuId,array('priority'=>$sortOrder,'location_latitude'=>@$location_latitude[$menuId] ,'location_longitude'=>@$location_longitude[$menuId])); 
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
						 
						$id = 'City_city_name_'.$menuId;
						$relation = 'city_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
				
				
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
              if(!empty($update_cache)){
				Yii::app()->options->set('system.common.city_m_cache',date('Ymdhis'));
				/*
					$criteria=new CDbCriteria;
					$criteria->condition = 't.country_id=:country_id and t.isTrash="0" and t.status="A"';
					$criteria->join      = ' INNER JOIN {{states}}  st ON st.state_id = t.state_id  ';
					$criteria->params[":country_id"] = '66099'  ; $criteria->select = 'city_id,city_name,st.state_name';
					$criteria->order  = "st.state_name asc , city_name asc " ; $model = City::model()->findAll($criteria);
					$items2 = array(); 
					if( $model){
					foreach( $model as $k=>$v){
					$items2[] =  array('value'=>urlencode(trim($v->city_name)),'name'=>$v->city_name,'state'=>$v->state_name) ;
					}
					}
					$root = Yii::getPathOfAlias('root');
					$fp = fopen($root.'/json/pakcities.json', 'w');
					fwrite($fp, json_encode($items2)); 
					  $notify->addSuccess(Yii::t('app', 'Pak city cache successfully updated!'));
					  * */
				  $this->redirect(Yii::app()->createUrl('city/index')) ;
		}
       
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        //$model->country_n = '66099'; 
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
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new City();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
          
            
					if(!empty($model->mul_city)){
					$text = trim($model->mul_city); // remove the last \n or whitespace character
					$text = explode("\n", $text);
					 
					if(!empty($text)){ 
						 $model->scenario = 'mul_city';
						foreach($text as $k=>$city){
							if(empty($city)){ continue; }
							
								$model2 = new City();
								$model2->city_id = '';
								$model2->state_id = $model->state_id ;
								$model2->country_id = $model->country_id;
								$model2->location_latitude = '';
								$model2->location_longitude = '';
								$model2->city_name = $city;
								$model2->save();

						}
						 $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
						 $this->redirect(Yii::App()->CreateUrl('city/index'));
					}
 
					}
             if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 
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
        //echo"<pre>";print_r($model);
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = City::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
             $model->attributes = $attributes;
            // $model->slug = $model->getUniqueSlug();
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				 
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
    public function actionGenerate_image($id)
    {
		 
        $model = City::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
         if (empty($model->location_latitude) and empty($model->location_longitude)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page Co-ordinat not set.'));
        }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        $src  = 'https://maps.googleapis.com/maps/api/staticmap?center='.$model->location_latitude.'%2C'.$model->location_longitude.'&language=en&size=640x256&zoom=15&scale=1&key=AIzaSyCE4LF1fuKkM5b0ffhY7dEoZ4ULkG2Uazk';
        $time = date('Ymdhis').'_'.time();
        $desFolder =   Yii::getPathOfAlias('root.uploads.map').'/';;
        $imageName = 'google-map_'.$time.'.png';
        $imagePath = $desFolder.$imageName;
        file_put_contents($imagePath,file_get_contents($src));
        $model->updateByPk($model->city_id,array('image'=>$imageName));
         
        $this->redirect(array(Yii::app()->controller->id.'/index'));
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
        $model = City::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->delete();    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
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
    public function get_lat_long($address,$region,$city_id=null){

    $address = str_replace(" ", "+", $address);
    $region = str_replace(" ", "+", $region);
	//AIzaSyA-nChuW96vWeFcu7ZRT6nU3jRv2pf-xIU
	$key = Yii::app()->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ1');
	 
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=".$key);
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    
    return array('lat'=>$lat,'lng'=>$long);
}
   public function actionBulk_action()
    {
		set_time_limit(0);
		 
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        if ($action == City::BULK_ACTION_DOWNLOAD && count($items)) {
            $affected = 0;
            $customerModel = new  City();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				$result =  $this->get_lat_long($customer->city_name,$customer->state->state_name);
				if(isset($result['lat'])){
								$customer->updateByPk($customer->primaryKey,array( 'location_latitude'=>$result['lat'],'location_longitude'=>$result['lng'])); 
			
				}

				//echo $customer->id;echo "<br />";
				 
                //$customer->updateByPk($item,array('isTrash'=>'1'));  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
	}
	public function actionTrans(){
 
$text = 'Hello'; $from_lan = 'en'; $to_lan = 'ar'; 
$json = json_decode(file_get_contents('https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan));
print_r($json);exit; 
$translated_text = $json->responseData->translatedText;
echo $translated_text;echo "WQERWER"; exit; 
 
	}
    
}
