<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class AreaguidesController extends Controller
{
    /**
     * List available published 
     */
  public $headerImage;
  public function init(){
	 
	  parent::Init();
      
    }
    public function actionIndex()
    {
        //echo"enter";exit;   
        //  $criteria = new CDbCriteria();
        //   $criteria->select ='t.image';
        //  $criteria->compare('status', Areaguides::STATUS_PUBLISHED);
        //   //$criteria->join =' inner join {{states}} st on st.state_id = t.city ';
        //  $criteria->order = 'areaguides_id DESC';
        
        //  $count = Areaguides::model()->count($criteria);
        
        //  $pages = new CPagination($count);
        //  $pages->pageSize = 10;
        //  $pages->applyLimit($criteria);
        
        $sql = 'SELECT mw_areaguides.image as image,mw_areaguides.area as area,mw_states.state_name,mw_states.slug as state_slug FROM mw_areaguides INNER JOIN mw_states ON mw_areaguides.city = mw_states.state_id WHERE mw_areaguides.status=:status limit 21';
        if (isset($_GET['search'])) {
            $sql = 'SELECT mw_areaguides.image as image,
                           mw_areaguides.area as area,
                           mw_states.state_name,
                           mw_states.slug as state_slug 
                    FROM mw_areaguides 
                    INNER JOIN mw_states ON mw_areaguides.city = mw_states.state_id 
                    WHERE mw_areaguides.status=:status 
                      AND mw_states.state_name LIKE :search 
                    LIMIT 21';
            $areaguides = Areaguides::model()->findAllBySql($sql, [
                ':status' => Areaguides::STATUS_PUBLISHED,
                ':search' => '%' . $_GET['search'] . '%'
            ]);
        } else {
            // If no search term, fetch all area guides without the search filter
            $areaguides = Areaguides::model()->findAllBySql($sql, [
                ':status' => Areaguides::STATUS_PUBLISHED
            ]);
        }
        
        
        //print_r($areaguides);
        $this->setData(array(
            'pageTitle'     =>  Yii::t('articles', 'Area Guides'),
            'pageBreadcrumbs'   => array()
       ));

        $this->render('index', compact('areaguides', 'pages'));
    }
    public function actionSearch()
    {

        $criteria = new CDbCriteria();
        $criteria->select = 'mw_areaguides.image as image,
                            mw_areaguides.area as area,
                            mw_states.state_name,
                            mw_states.slug as state_slug';
        $criteria->join = 'INNER JOIN mw_states ON mw_areaguides.city = mw_states.state_id';
        $criteria->condition = 'mw_areaguides.status = :status';
        $criteria->params = [':status' => Areaguides::STATUS_PUBLISHED];

        // Handle search parameters
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $criteria->addCondition('mw_areaguides.area LIKE :searchTerm');
            $criteria->params[':searchTerm'] = '%' . $searchTerm . '%';
        }

        // Execute query with criteria
        $areaguides = Areaguides::model()->findAll($criteria);

        // Pass data to view
        $this->render('index', compact('areaguides'));
    }
    public function actionSuggest() {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $term = $_GET['term'];
            // $criteria = new CDbCriteria;
            // $criteria->compare('state_name', $term, true);
            // $criteria->limit = 10;
            
            // $areas = Areaguides::model()->findAll($criteria);
            $sql = 'SELECT mw_areaguides.image as image,
                        mw_areaguides.area as area,
                        mw_states.state_name,
                        mw_states.slug as state_slug 
                FROM mw_areaguides 
                INNER JOIN mw_states ON mw_areaguides.city = mw_states.state_id 
                WHERE mw_areaguides.status=:status 
                AND mw_states.state_name LIKE :search 
                LIMIT 21';
            $areaguides = Areaguides::model()->findAllBySql($sql, [
                ':status' => Areaguides::STATUS_PUBLISHED,
                ':search' => '%' . $term . '%'
            ]);
            $results = [];
            foreach ($areas as $area) {
                $results[] = [
                    'label' => $area->state_name,
                    'value' => $area->state_name,
                    'link' => $this->createUrl('areaguides/view', ['area' => $area->state_slug]),
                ];
            }
            
            echo CJSON::encode($results);
            Yii::app()->end();
        }
    }
	public function actionView($area=null)
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $term = $_GET['term'];
            $sql = 'SELECT mw_areaguides.image as image,
                        mw_areaguides.area as area,
                        mw_states.state_name,
                        mw_states.slug as state_slug 
                FROM mw_areaguides 
                INNER JOIN mw_states ON mw_areaguides.city = mw_states.state_id 
                WHERE mw_areaguides.status=:status 
                AND mw_states.state_name LIKE :search 
                LIMIT 21';
            $areaguides = Areaguides::model()->findAllBySql($sql, [
                ':status' => Areaguides::STATUS_PUBLISHED,
                ':search' => '%' . $term . '%'
            ]);
            $results = [];
            $check = [];
            foreach ($areaguides as $area) {
                if (!in_array($area->state_slug, $check)){
                    $results[] = [
                        'label' => $area->state_name,
                        'value' => $area->state_name,
                        'link' => $this->createUrl('areaguides/view', ['area' => $area->state_slug]),
                    ];
                    $check[] = $area->state_slug;
                }

            }
            
            echo CJSON::encode($results);
            Yii::app()->end();
        }
        $criteria = new CDbCriteria();
        $criteria->select ='t.*,st.state_name as state_name,st.slug as state_slug';
        $criteria->compare('status', Areaguides::STATUS_PUBLISHED);
        $criteria->join =' inner join {{states}} st on st.state_id = t.city ';
        $criteria->condition .= ' and st.slug = :slug '; $criteria->params[':slug'] = $area; 
		$areaguides = Areaguides::model()->find($criteria);
		  if (empty($areaguides)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $title =    Yii::t('app','[H1] Area Guide and Locality Overview | [BrandName]',array('[H1]'=> $areaguides->state_name,'[BrandName]'=>BRAND_TITLE));
	
		//echo"<pre>";print_r($areaguide_detail);exit; 
        $this->setData(array(
            'pageTitle'     =>  $title,
            'meta_keyword' => Yii::t('app',Yii::app()->options->get('system.common.areaguide_keywords',''),array('[H1]'=> $areaguides->state_name,'[BrandName]'=>BRAND_TITLE)),         
		 	'pageMetaDescription' =>  Yii::t('app',Yii::app()->options->get('system.common.areaguide_description',''),array('[H1]'=> $areaguides->state_name,'[BrandName]'=>BRAND_TITLE)) 
        ));
        $this->render('view', compact('areaguides', 'pages'));
    }
	
	public function getCityText($id=null){

        $city = Yii::app()->db->createCommand()
            ->select('state_name')
            ->from('mw_states')
            ->where('state_id=:id', array(':id'=>$id))
            ->queryRow();

        return isset($city['state_name']) ? $city['state_name'] : '-';
    }

    public function getAreaText($areaId=null){
		//print($areaId);exit;
        $area = Yii::app()->db->createCommand()
            ->select('name')
            ->from('mw_main_region')
            ->where('region_id=:id', array(':id'=>$areaId))
            ->queryRow();

        return isset($area['name']) ? $area['name']: '-';
    }
	
    /**
     * Helper method to load the article AR model
     */
    public function loadAreaguidesModel($slug)
    {
         $model = Areaguides::model()->findBySlugPublished( $slug );
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
	
}
