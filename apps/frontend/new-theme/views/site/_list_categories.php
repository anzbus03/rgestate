<?php 
 
$cityDats = Category::model()->ListDataForJSON_ID_BySEctionNewSlugNtCacheWithId(''); 
 
$adModelCriteria =	$adModel->findAds($formData ,false,true); 

$adModelCriteria->select = 't.category_id as category_name,count(t.id) as id  ';
 
$adModelCriteria->group = 't.category_id'; 
$adModelCriteria->order  ='count(t.id) desc ';
$new_homes =  $adModel->findAll($adModelCriteria);

// echo "<pre>";
// print_r($new_homes);
 unset($formData['section_id']);unset($formData['country']);
  if(isset($formData['preleased'])){
          unset($formData['preleased']);
          $formData['sec'] = 'preleased'; 
      }
 $create_array = array();
 foreach($formData as $k1=>$v1){
     if(!in_array($k1,array('sec','type_of','state','reg','category'))){
         unset($formData[$k1]);
         $create_array[$k1] = $v1; 
     }
 }
 $query = '?';
 if(!empty($create_array)){
      
     $query .= http_build_query($create_array);
 }
 if($query=='?'){ $query =''; }
 
if(!empty($new_homes)){
   
    echo '<ul class="list-inline-item   col-sm-12 ">';
    foreach($new_homes as $k=>$v){
        
         if(isset($cityDats[$v->category_name])){
             $data1 = $cityDats[$v->category_name]; 
             
             $name = $data1['name'];
             $slug = $data1['slug'];
         }else{
             echo $v->category_name;  
             continue; 
         }
         
		 $formData1 = $formData; 
		 $formData1['type_of'] = $slug;
    	echo '<li class="col-sm-3"><p><a href="'.Yii::app()->createUrl('listing/index', $formData1 ).$query.'">'.$name.'<span> ('.$v->id.')</span></a></p></li>';
	}
    echo '</ul>';
    
}
