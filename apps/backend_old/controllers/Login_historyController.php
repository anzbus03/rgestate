<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class Login_historyController  extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public $Controlloler_title= "Login History";
    public $focus = "title";
   /*
    public function filters()
    {
        $filters = array(
            'postOnly + delete', // we only allow deletion via POST request
        );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    */
    
    public function init()
    {
		 
		  parent::init();

	}
    /**
     * List all available users
     */
    public function actionIndex($type=null )
    {
		
		$roleName  =  'Login History' ; 
		$this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'List '.$roleName  ), 
            'pageHeading'       => Yii::t('users',  'List '.$roleName  ),
            'role'       => Yii::t('users',  $roleName),
            'pageBreadcrumbs'   => array(
                Yii::t('users', $roleName ) => $this->createUrl('login_history/index',array('type'=>$type)),
                Yii::t('app', 'View all')
            )
        ));
        
         
		 
        $request = Yii::app()->request;
        $hideActivity = true; 
        $model = new UserLoginLog('search');
        $model->unsetAttributes();
        // for filters.
        $model->attributes = (array)$request->getQuery($model->modelName, array());
         
		 
		$role  = 'Login History';
		 
        
       
		 
		 $no_create =true ; 
        $this->render('_list', compact('model','type' ,'hideActivity','no_create'));
    }
    
}
