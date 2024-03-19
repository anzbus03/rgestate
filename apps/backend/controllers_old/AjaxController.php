<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * AccountController
 * 
 * Handles the actions for account related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class AjaxController extends Controller
{
    /**
     * Default action, allowing to update the account.
     */
    public function actionFindCities($zone_id=null){
		 
		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;
 
  
$status = true;
  
 /*areas Fetching */ 
$criteria=new CDbCriteria;
$criteria->condition  = '1'; 
$criteria->select = 't.city_id,t.state_id,cn.country_id,t.city_name,cn.cords as country_name,st.state_name';
$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ' ;
$criteria->join .= ' INNER JOIN {{countries}}  cn on cn.country_id = st.country_id   ' ;
$criteria->condition .= ' and   cn.show_on_listing ="1"'; 
$criteria->condition  .= ' and ( t.city_name like :query   )'  ;

$criteria->limit = '15'  ; 
$criteria->params[':query'] = '%'.$query.'%' ; 
 
$areas = City::model()->findAll($criteria);
/*areas Fetching */ 		
 
 
$resultUsers = [];
if($areas){
foreach ($areas as $k => $v) {
    
		$resultUsers[] =  array(
		"id"        => $v->city_id,
		"state_id"        => $v->state_id,
		"country_id"        => $v->country_id,
		"username"  => trim($v->city_name),
		"avatar"    => "" ,
		"country" =>  '('. $v->state_name.','.$v->country_name.')',
		);
     
}
}
 
  
 
$resultProjects = []; 
 
// Means no result were found
if (empty($resultUsers) && empty($resultProjects)) {
    $status = false;
}
 
header('Content-type: application/json; charset=utf-8');
 
echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "user"      => $resultUsers,
        
    )
));
	}
	public function actionFindCitiesAd($zone_id=null){
		 
		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;
 
  
$status = true;
  
 /*areas Fetching */ 
$criteria=new CDbCriteria;
$criteria->condition  = '1'; 
$criteria->select = 't.city_id,t.state_id,cn.country_id,t.city_name,cn.cords as country_name,st.state_name';
$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ' ;
$criteria->join .= ' INNER JOIN {{countries}}  cn on cn.country_id = st.country_id   ' ;
$criteria->condition .= ' and   cn.show_on_listing ="1"'; 
$criteria->condition  .= ' and ( t.city_name like :query   )'  ;

$criteria->limit = '15'  ; 
$criteria->params[':query'] = '%'.$query.'%' ; 
 
$areas = City::model()->findAll($criteria);
/*areas Fetching */ 		
 
 
$resultUsers = [];
if($areas){
foreach ($areas as $k => $v) {
    
		$resultUsers[] =  array(
		"id"        => $v->city_id,
		"state_id"        => $v->state_id,
		"country_id"        => $v->country_id,
		"username"  => trim($v->city_name),
		"avatar"    => "" ,
		"country" =>  '('. $v->state_name.','.$v->country_name.')',
			"country_name" =>   $v->country_name ,
		);
     
}
}
 
  
 
$resultProjects = []; 
 
// Means no result were found
if (empty($resultUsers) && empty($resultProjects)) {
    $status = false;
}
 
header('Content-type: application/json; charset=utf-8');
 
echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "user"      => $resultUsers,
        
    )
));
	}
	public function actionSelect_city_new($id=null)
    {
		 
		 $html = '<option value="">Select City</option>';
		 $states = States::model()->AllListingStatesOfCountry((int) $id);
		 
		 
		 if(!empty($states)){
			 foreach($states as $k ){
				 $html .= '<option value="'.$k->state_id.'">'.$k->state_name.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($states))) ; 
	}
	 public function actionSelect_location($id=null)
    {
		 $html = '<option value="">Select Location</option>';
		 $states = City::model()->FindCities((int) $id);
		 
		 
		 if(!empty($states)){
			 foreach($states as $k ){
				 $html .= '<option value="'.$k->city_id.'">'.$k->city_name.'</option>';
			 }
		 }
		echo json_encode(array('data'=>$html,'size'=>sizeOf($states))) ;
	}
	public function actionHidden_ammenities($id=null)
    {
        $location = ''; 
		$criteria=new CDbCriteria;
		 $criteria->select="amenities_id";
		 $criteria->condition="t.category_id=:category_id";
		 $criteria->params[':category_id'] =  (int) $id;
		 $states = AmenitiesCategoryList::model()->findAll($criteria);
		 	$cat_hide['h_p_limits']  =0;
		$cat_hide['h_bd']  =0;
		$cat_hide['h_bth'] = 0;
		$cat_hide['h_in']  = 0;
			$cat_hide['h_is_mor']  = 0;
		$cat_hide['h_r_facade']  = 0;
		$cat_hide['h_rights']  = 0;
		$cat_hide['h_may_affect']  = 0;
		$cat_hide['h_disputes']  = 0;
		$cat_hide['h_expiry_date']  = 0;
		
		$cat_hide['h_l_no']  = 0;
		$cat_hide['h_plan_no']  = 0;
		$cat_hide['h_no_of_u']  = 0;
		$cat_hide['h_floor_no']  = 0;
		$cat_hide['h_unit_no']  = 0;
		$cat_hide['h_selling_price']  = 0;
		 $cat = Category::model()->findByPk((int) $id);
		 if($cat){
			 $cat_hide['h_bd']  = $cat->h_bd;
			 $cat_hide['h_bth'] = $cat->h_bth;
			 $cat_hide['h_in']  = $cat->h_in;
			 $cat_hide['h_is_mor']  = $cat->h_is_mor;
			 $cat_hide['h_r_facade']  = $cat->h_r_facade;
			 $cat_hide['h_rights']  = $cat->h_rights;
			 $cat_hide['h_may_affect']  = $cat->h_may_affect;
			 $cat_hide['h_disputes']  = $cat->h_disputes;
			 $cat_hide['h_expiry_date']  = $cat->h_expiry_date;
			 
			$cat_hide['h_l_no']  = $cat->h_l_no;
			$cat_hide['h_plan_no']  =$cat->h_plan_no;
			$cat_hide['h_no_of_u']  =$cat->h_no_of_u;
			$cat_hide['h_floor_no']  =$cat->h_floor_no;
			$cat_hide['h_unit_no']  =$cat->h_unit_no;
			$cat_hide['h_selling_price']  =$cat->h_selling_price;
				$cat_hide['h_p_limits']  =$cat->h_p_limits;;
			 if(empty($states)){
			 
				echo json_encode(array('status'=>1,'amenities_list'=> array(),'cat_hide'=>$cat_hide)) ; exit;
			}
		 }
		 
		 if(!empty($states)){
			 $amenities_list = CHtml::listData($states,'amenities_id','amenities_id');
			 echo json_encode(array('status'=>1,'amenities_list'=> $amenities_list,'cat_hide'=>$cat_hide)) ; 
		 }
		else{
				  echo json_encode(array('status'=>0)) ; 
		}
		exit;
	}
	
}
