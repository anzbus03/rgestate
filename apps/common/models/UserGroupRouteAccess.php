<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UserGroupRouteAccess
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.5
 */
 
/**
 * This is the model class for table "user_group_route_access".
 *
 * The followings are the available columns in table 'user_group_route_access':
 * @property integer $route_id
 * @property integer $group_id
 * @property string $route
 * @property string $access
 * @property string $date_added
 *
 * The followings are the available model relations:
 * @property UserGroup $group
 */
class UserGroupRouteAccess extends ActiveRecord
{
    const ALLOW = 'allow';
    
    const DENY = 'deny';
    
    public $name;
    
    public $description;
    
    public $controller;
    
    public $action;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_group_route_access}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
			array('group_id, route', 'required'),
			array('group_id', 'numerical', 'integerOnly'=>true),
            array('group_id', 'exist', 'className' => 'UserGroup'),
			array('route', 'length', 'max'=>255),
			array('access', 'length', 'max'=>5),
            array('access', 'in', 'range' => array_keys($this->getAccessOptions())),
			
            // The following rule is used by search().
			array('group_id', 'safe', 'on'=>'search'),
		);
        
        return CMap::mergeArray($rules, parent::rules());
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = array(
			'group' => array(self::BELONGS_TO, 'UserGroup', 'group_id'),
		);
        
        return CMap::mergeArray($relations, parent::relations());
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$labels = array(
			'route_id'       => Yii::t('user_groups', 'Route'),
			'group_id'       => Yii::t('user_groups', 'Group'),
            'route'          => Yii::t('user_groups', 'Route'),
			'access'         => Yii::t('user_groups', 'Access'),
            'name'           => Yii::t('user_groups', 'Name'),
            'description'    => Yii::t('user_groups', 'Description'),
            'controller'     => Yii::t('user_groups', 'Controller'),
            'action'         => Yii::t('user_groups', 'Action'),
		);
        
        return CMap::mergeArray($labels, parent::attributeLabels());
	}
    
    /**
	 * @return array customized attribute help texts (name=>text)
	 */
	public function attributeHelpTexts()
	{
		$texts = array(
			'route_id'       => Yii::t('user_groups', 'Route'),
			'group_id'       => Yii::t('user_groups', 'Group'),
            'route'          => Yii::t('user_groups', 'Route'),
			'access'         => Yii::t('user_groups', 'Access'),
            'name'           => Yii::t('user_groups', 'Name'),
            'description'    => Yii::t('user_groups', 'Description'),
            'controller'     => Yii::t('user_groups', 'Controller'),
            'action'         => Yii::t('user_groups', 'Action'),
		);
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'controller'   => CSort::SORT_ASC,
                    'action'       => CSort::SORT_ASC,
                ),
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserGroupRouteAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getAccessOptions()
    {
        return array(
            self::ALLOW => Yii::t('user_groups', ucfirst(self::ALLOW)),
            self::DENY  => Yii::t('user_groups', ucfirst(self::DENY)),
        );
    }
    
    public function getIsAllowed()
    {
        return $this->access == self::ALLOW;
    }
    
    public function getIsDenied()
    {
        return !$this->getIsAllowed();
    }

    public static function findAllByGroupId($groupId)
    {
        $items = self::getRoutesFromFiles();
        $routes = array();
        foreach ($items as $index => $item) {
            $routes[$index] = array('controller' => $item['controller'], 'routes' => array());
            foreach ($item['routes'] as $action) {
                $model = self::model()->findByAttributes(array(
                    'group_id' => $groupId,
                    'route'    => $action['route'],
                ));
                if (empty($model)) {
                    $model = new self();
                    $model->group_id = $groupId;
                    $model->route    = $action['route'];
                    $model->access   = self::ALLOW;
                }
                $model->name        = Yii::t('user_groups', $action['name']);
                $model->description = Yii::t('user_groups', $action['description']);
                $routes[$index]['routes'][] = $model;
            }
        }
        return $routes;
    }
    
    public static function groupHasRouteAccess($groupId, $route)
    {
        if (empty($groupId) || empty($route)) {
            return true;
        }
        
        if (is_array($route)) {
            $hasAccess = true;
            foreach ($route as $r) {
                if (!self::groupHasRouteAccess($groupId, $r)) {
                    $hasAccess = false;
                    break;
                }
            }
            return $hasAccess;
        }
        
        static $hashes = array();
        $hashKey = sha1(serialize(func_get_args()));
        if (isset($hashes[$hashKey]) || array_key_exists($hashKey, $hashes)) {
            return (bool)$hashes[$hashKey];
        } 
        
        static $groupRoutes = array();
        if (!isset($groupRoutes[$groupId]) || !array_key_exists($groupId, $groupRoutes)) {
            $criteria = new CDbCriteria();
            $criteria->select = 'route, access';
            $criteria->compare('group_id', (int)$groupId);
            $models = self::model()->findAll($criteria); 
            $groupRoutes[$groupId] = array();
            foreach ($models as $model) {
                $groupRoutes[$groupId][$model->route] = $model->getIsAllowed();
            }
            unset($models);
        }

        return $hashes[$hashKey] = isset($groupRoutes[$groupId][$route]) && $groupRoutes[$groupId][$route] === false ? false : true;
    }
    protected static function getRoutesFromFiles()
    {
        $files = array();
        foreach (Yii::app()->controllerMap as $name => $info) {
            $files[] = Yii::getPathOfAlias($info['class']) . '.php';
        }
        $files   = array_merge($files, FileSystemHelper::readDirectoryContents(Yii::app()->controllerPath, true));
        $exclude = array(
            Yii::app()->controllerPath . '/GuestController.php', 
            // Yii::app()->controllerPath . '/DashboardController.php',
            Yii::app()->controllerPath . '/AccountController.php',
        );
        $files = array_diff($files, $exclude);
        sort($files);
         
        $rootPath = Yii::getPathOfAlias('root.apps');
        $info     = array();
        foreach ($files as $file) { 
            
            if (substr($file, -4) != '.php') {
                continue;
            }
            if(strlen($file)=='4'){ continue; }  
            // echo  Yii::app()->controllerPath . '/AccountController.php';exit;
            // ini_set('display_errors', true);
            // error_reporting(E_ALL);

            $fileNameNoExt = basename($file, '.php');
            $controllerId  = strtolower(substr($fileNameNoExt, 0, -10));
            
            if (class_exists($fileNameNoExt, false) && file_exists($file)) {
                require_once Yii::getPathOfAlias('root.apps.backend.controllers') . '/' . $file;
            }
            require_once(Yii::getPathOfAlias('common.framework') . '/YiiBase.php');
            $refl    = new ReflectionClass(new $fileNameNoExt($controllerId));
            if(in_array($refl->name, array(
                'Ext_translateController',
                'Ext_ckeditorController',
                'Video_categoriesController',
                'VideosController',
                'Upload_settingsController',
                'ServiceController',
                'ReligionController',
                'OccupationController',
                'Nearby_locationController',
                'MechanicalconditionController',
                'Marital_statusController',
                'Listing_managementController',
                'Ip_location_servicesController',
                'FueltypeController',
                'FueltypeController',
                'Floor_plan_uploadController',
                'Floor_plan_uploadController',
                'AgenciesController',
                'AccountController',
                'Agent_roleController',
                'AgentsController',
                // 'Blog_articlesController',
                'DevelopersController',
                'GuestController',
                'ProjectController',
                'PropertyController',
                'Sub_communityController',
                'SubcategoryController',
                // 'DashboardController',
                'StatesController',
                'DistrictController',
                // 'CurrenciesController',
                'CommunityController',
                'Floor_planController',
                'Experience_levelController',
                'Engine_sizeController',
                'Employment_typeController',
                'Email_blacklistController',
                'Banner_requestController',
                'Agent_bannerController',
                'Education_levelController',
                'DoorController',
                'DeveloperController', 
                'Developer_bannerController', 
                'Customer_tagController',
                'ColorController',
                'Bounce_serversController',
                'BodyconditionController',
                'Banner_positionController',
                'AvatarController',
                'Advertisement_listingController',
                'Adv_articleController',
                'Adv_categoriesController',
                'AdvertisementController',
                'Place_an_adController',
                'Place_an_adController',
                'TagController',
                'ExtensionsController',
                'ThemeController',
                'Customers_mass_emailsController',
                'AjaxController'
            ))){
                continue;
            }
            $methods = $refl->getMethods(ReflectionMethod::IS_PUBLIC);
            $routes  = array();
            
            foreach ($methods as $method) {
				
				if($refl->name== 'Place_propertyController' ){  
					if(in_array(strtolower($method->name),array('actiondetails_2','actiondetails','actiondetails_edit','actionfindonmap' ,
                        'actionselect_state',
                        'actionselect_city',
                        'actionselect_category',
                        'actionselect_sub_category',
                        'actionselect_model',
                        'actionupload',
                        'actiondelete_image',
                        'actionsuccess',
                        'actionsuccess_edit',
                        'actionloadcities',
                        'actiondelete_image_db',
                        'actionapprove',
                        'actiondisapprove',
                        'actionupload',
                        'actionapprove_selected',
                        'actionapprove_all',
                        'actiondispprove_all',
                        'actioncheckmodel',
                        'actioncommunity',
                        'actiondistrict',
                        'actioncustomer',
                        'actioncheckmodel',
                        'actionimage_approve_manage',
                        'actionad_image',
                        'actionupload',
                        'actionupload',
                        'actionsubcoummunity',
                        'actionview',
                        'actionstatus_change',
                        'actionupload_floor_plan',
                        'actiondelete_floor_plan',
                        'actionupdatemetatag',
                        'actionsavetaglist',
                        'actionget_tag_list',
                        'actionget_tag_list2',
                        'actionsavetaglist2',
                        'actionselect_city_new',
                        'actionselect_location',
                        'actionselect_category2',
                        'actionselect_sub_category2',
                        'actionselect_category3',
                        'actiongetcityid',
                        'actionlist_image',
                        'actionnotification',

					))){
					 
						continue;
					} 
				}
				if($refl->name== 'DashboardController' ){
					if(!in_array(strtolower($method->name),array( 'actionindex', 'actionmy_statistics'  ))){
						continue;
					} 
				}
				if($refl->name== 'Promo_codesController' ){
					if(in_array(strtolower($method->name),array( 'actionautocomplete' ))){
						continue;
					} 
				}
				if($refl->name== 'Send_emailController' ){
					if(!in_array(strtolower($method->name),array('actionindex'))){
						continue;
					} 
				}
				if($refl->name== 'PackageController' ){
					if(in_array(strtolower($method->name),array('actionautocomplete'))){
						continue;
					} 
				}
				if($refl->name== 'ListingusersController' ){
					if(in_array(strtolower($method->name),array( 
                        'actionduplicate',
                        'actionautocomplete',
                        'actionimage_crop',
                        'actionresentemail',
                        'actioncsv_import',
                    ))){
						continue;
					} 
				}
				if($refl->name== 'New_projectsController' ){
					if(in_array(strtolower($method->name),array( 
                        
                        'actiondetails',
                        'actiondetails_2',
                        'actiondetails_edit',
                        'actionfindonmap',
                        'actionselect_state',
                        'actionselect_city',
                        'actionselect_category',
                        'actionselect_sub_category',
                        'actionselect_model',
                        'actionupload',
                        'actiondelete_image',
                        'actionsuccess',
                        'actionsuccess_edit',
                        'actionloadcities',
                        'actiondelete_image_db',
                        'actionapprove',
                        'actiondisapprove',
                        'actionapprove_selected',
                        'actionapprove_all',
                        'actiondispprove_all',
                        'actionad_image',
                        'actionimage_approve_manage',
                        'actioncheckmodel',
                        'actioncommunity',
                        'actiondistrict',
                        'actioncustomer',
                        'actionsubcoummunity',
                        'actionstatus_change',
                        'actionupload_floor_plan',
                        'actiondelete_floor_plan',
                        'actionupdatemetatag',
                        'actionsavetaglist',
                        'actionget_tag_list',
                        'actionget_tag_list2',
                        'actionsavetaglist2',
                        'actionselect_city_new',
                        'actionselect_location',
                        'actionselect_category2',
                        'actionselect_sub_category2',

                    ))){
						continue;
					} 
				}
			 
				if(in_array($refl->name,array( 'CategoryController','Delivery_serversController','CountriesController','TemplatesController','RegionController','CityController','SettingsController' ))){
					if(!in_array(strtolower($method->name),array( 
					
                        'actionindex',
                        'actioncreate',
                        'actionupdate',
                        'actiondelete', 
                        'actionemail_templates', 
                    ))){
						continue;
					} 
				}
			 
				if(in_array(strtolower($method->name),array('actionslug'))){
					continue;
				}
                if (strpos($method->name, 'action') !== 0 || strpos($method->name, 'actions') === 0) {
                    continue;
                }
                $actionId = strtolower(substr($method->name, 6));
                $routes[] = array_merge(array('route' => $controllerId . '/' . $actionId), self::extractObjectInfo($method));
            }
            
            $data = array(
                'controller' => self::extractObjectInfo($refl),
                'routes'     => $routes,
            );
            $info[] = $data;
        }
        return $info;
    }
    protected static function extractNamespaceFromFile($file)
    {
        $lines = file($file);
        foreach ($lines as $line) {
            if (preg_match('/^namespace\s+(.+?);$/', $line, $matches)) {
                return $matches[1];  // Return the namespace
            }
        }
        return null;  // No namespace found
    }

    protected static function extractObjectInfo($reflObj)
    {
        $comment = $reflObj->getDocComment();
        $info    = array('name' => '', 'description' => '');
        if (preg_match_all('#@(.*?)\n#s', $comment, $matches)) {
            $annotations = $matches[1];
            foreach ($annotations as $annotation) {
                $annotation = trim($annotation);
                if (strpos($annotation, 'routeName') === 0) {
                    $info['name'] = substr($annotation, strlen('routeName'));
                }
                if (strpos($annotation, 'routeDescription') === 0) {
                    $info['description'] = substr($annotation, strlen('routeDescription'));
                }
            }
        }
        if (empty($info['name'])) {
            if ($reflObj instanceof ReflectionMethod) {
                $info['name'] = ucfirst(str_replace('_', ' ', substr(strtolower($reflObj->name), 6)));
            } elseif ($reflObj instanceof ReflectionClass) {
                $info['name'] = ucfirst(str_replace('_', ' ', substr(strtolower($reflObj->name), 0, -10)));
            }
        }
        $info['name'] = str_replace('Ext ', 'Extension ', $info['name']);
        $info['name'] = Yii::t('user_groups', $info['name']);
        
        if (empty($info['description'])) {
            $comment = preg_replace('#@(.*?)\n#s', '', $comment);
            $comment = str_replace(array('*', '/', $reflObj->name), '', $comment);
            $comment = trim($comment);
            $comment = str_replace(array("\n", "\t"), "", $comment);
            $comment = preg_replace('/\s{2,}/', ' ', $comment);
            $info['description'] = trim($comment);
        }
        $info['description'] = ucfirst($info['description']);
        $info['description'] = Yii::t('user_groups', $info['description']);
        return $info;
    }
    
}
