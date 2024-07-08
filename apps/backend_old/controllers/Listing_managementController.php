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
 
class Listing_managementController extends Controller
{
 
     public $Controlloler_title= "Listing Management";
     public $focus = "amenitites_name";
     
     public function actionIndex()
     {
		 
		  
            $request = Yii::app()->request;
            $notify = Yii::app()->notify;
			$criteria = new CDbCriteria();
			$criteria->select= 't.country_name,t.country_id,priority,enable_all_cities,show_region';
			$criteria->compare('t.show_on_listing','1');
			$criteria->compare('t.isTrash','0');
			$criteria->order = '-t.priority desc , country_name asc';
			 
			$countriesCount = Countries::model()->count($criteria);
			$pages = new CPagination($countriesCount);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$countries = Countries::model()->findAll($criteria);
					
					
		 $model = new Countries();			
		 $states = new States();			
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
                $prioritysortOrderAll = $_POST['priority_state'];
                $show_regionAll = @$_POST['show_state'];
                //$enable_all_citiesAll = @$_POST['enable_all_cities'];
                //$disableAll = @$_POST['disable_country'];
                $enableState = @$_POST['enable_state'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$show_on_listing = isset($_POST['disable_country'][$menuId]) ? '0' : '1';
						$enable_all_cities = isset($_POST['enable_all_cities'][$menuId]) ? '1' : '0';					 
						$model->updateByPk($menuId,array('priority'=>$sortOrder,'show_on_listing'=>$show_on_listing,'enable_all_cities'=>$enable_all_cities)); 
					}
				}
				if(count($show_regionAll)>0)
				{
					foreach($show_regionAll as $menuId=>$sortOrder)
					{  
						if(!empty($sortOrder)){
						$model->isNewRecord =true; 
					 	$model->updateByPk($menuId,array('show_region'=>$sortOrder)); 
						}
						else{
							$model->isNewRecord =true; 
					    	$model->updateByPk($menuId,array('show_region'=>'')); 
						}
					}
				}
				$false_enable_all_citis =array();
				if(count($prioritysortOrderAll)>0)
				{
					foreach($prioritysortOrderAll as $menuId=>$sortOrder)
					{
						$states->isNewRecord =true; 
						 $enable_listing = isset($_POST['enable_listing'][$menuId]) ? '1' : '0';
						//$enable_all_cities = isset($_POST['enable_all_cities'][$menuId]) ? '1' : '0';	
						$country_id = @$_POST['enable_listing_country'][$menuId]; 
						if($enable_listing=='0' and !empty($country_id) and !in_array($country_id,$false_enable_all_citis)){
						 
								Countries::model()->updateByPk($country_id,array('enable_all_cities'=>'0'));
								$false_enable_all_citis[$country_id] = $country_id;
							 
						}				 
						$states->updateByPk($menuId,array('priority'=>$sortOrder,'enable_listing'=>$enable_listing)); 
					}
				}
			 
				if(count($enableState)>0)
				{
					foreach($enableState as $menuId=>$sortOrder)
					{
						$states->isNewRecord =true; 
						$states->updateByPk($menuId,array('enable_listing'=>'1')); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list', compact('countries','pages','countriesCount'));
    }
}
