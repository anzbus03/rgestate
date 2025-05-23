<?php
$cityDats = MainRegion::model()->byIdIterate();
 
$adModelCriteria =	$adModel->findAds($formData ,false,true); 
$adModelCriteria->select= 'rgn.region_id as city_name,count(t.id) as id ';
$adModelCriteria->join.= ' LEFT JOIN {{states}} city ON t.state = city.state_id  ';
$adModelCriteria->join.= ' LEFT JOIN {{main_region}} rgn ON rgn.region_id = city.region_id  ';
$adModelCriteria->group = 'city.region_id'; 
$adModelCriteria->order  ='rgn.name asc '; 
$new_homes =  $adModel->findAll($adModelCriteria);

unset($formData['section_id']); unset($formData['country']);unset($formData['reg_id']);
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
 
    echo '<ul id="ldlist" class="list-inline-item row col-sm-12 ">';
    $count ='1';
    foreach($new_homes as $k=>$v){

        $formData1 = $formData;
        if(isset($cityDats[$v->city_name])){
            $data1  = $cityDats[$v->city_name]; 
            $name   = $data1['name'];
            $slug   = $data1['slug'];
        } else {
            continue; 
        }
        $formData1['state'] = $slug;
        $dClass = ($count>='41') ? 'd-none hideles' : ''; 
    	echo '<li class="'.$dClass.' col-sm-3"><p><a href="'.Yii::app()->createUrl('listing/index', $formData1 ).$query.'">'.$name.'<span> ('.$v->id.')</span></a></p></li>';
    	$count++;
	}
    echo '</ul>';
    if($count>41){
        // echo '<a href="javascript:void(0)" id="v_moer" class=" btn-more-view" onclick="showAlllist()" >View All</a>';
        // echo '<a href="javascript:void(0)" class="d-none btn-more-view" id="v_less" onclick="hideAlllist()" >View Less</a>';
        ?>
        <script>
            function showAlllist(){
                $('#ldlist').find('li.hideles').removeClass('d-none');
                $('#v_less').removeClass('d-none');
                $('#v_moer').addClass('d-none');
            }
            function hideAlllist(){
                $('#ldlist').find('.hideles').addClass('d-none');
                $('#v_less').addClass('d-none');
                $('#v_moer').removeClass('d-none');
            }
        </script>
        <?php
    }
    
}
