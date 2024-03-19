<?php 
  $regions = 	MainRegion::model()->getStateWithCountry_2datas(COUNTRY_ID);

$adModelCriteria =	$adModel->findAds($formData ,false,true);
// print_r($adModelCriteria);
$adModelCriteria->join  .= ' left join {{states}} st1 ON st1.state_id = t.state '; 
$adModelCriteria->select= 'st1.region_id as city_name , count(t.id) as id   '; 
$adModelCriteria->group = 'st1.region_id'; 
$adModelCriteria->order  ='count(t.id) desc ';
$new_homes =  $adModel->findAll($adModelCriteria);
 
 unset($formData['section_id']);
  unset($formData['country']);
  $formData1['state'] = 'all';$formData1['type_of'] = 'property';
if(!empty($new_homes)){
   
    echo '<ul class="list-inline-item row  col-sm-12 ">';
    foreach($new_homes as $k=>$v){
         if(isset($regions[$v->city_name])){
             $data1 = $regions[$v->city_name]; 
             $name = $data1['name'];
             $slug = $data1['slug'];
         }else{
             continue; 
         }
		 $formData1 = $formData; 
		 $formData1['reg'] = $slug;
    	echo '<li class="col-sm-3"><p><a href="'.Yii::app()->createUrl('listing/index', $formData1 ).'">'.$name.'<span> ('.$v->id.')</span></a></p></li>';
	}
    echo '</ul>';
     
}