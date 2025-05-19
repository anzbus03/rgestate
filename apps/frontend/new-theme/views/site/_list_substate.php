<?php
// 1) Fetch your data
//    - first, resolve the parent state slug into its ID:
$parentStateModel = States::model()->findByAttributes(['slug'=> $formData['state']]);
$parentStateId    = $parentStateModel ? $parentStateModel->state_id : null;
//    - now get all sub-states for that parent:

$subStateData = $parentStateId
    ? States::model()->findAll(['condition'=>'parent_id=:pid AND isTrash="0"','params'=>[':pid'=>$parentStateId],'order'=>'state_name'])
    : [];
//    normalize into [id=>['name'=>…, 'slug'=>…]]
$subStateDats = [];
foreach($subStateData as $s){
    $subStateDats[$s->state_id] = [
        'name' => $s->state_name,
        'slug' => $s->slug,
    ];
}
//    ads grouped by sub_state
$adModelCriteria = $adModel->findAds($formData, false, true);
$adModelCriteria->select  = 't.sub_state, COUNT(t.id) AS id';
$adModelCriteria->join   .= ' LEFT JOIN {{states}} sub ON t.sub_state = sub.state_id';
$adModelCriteria->group    = 't.sub_state';
$adModelCriteria->order    = 'sub.state_name ASC';
$new_homes = $adModel->findAll($adModelCriteria);

// 2) Clean up URL params
unset($formData['section_id'], $formData['country'], $formData['reg_id']);
if (isset($formData['preleased'])) {
    unset($formData['preleased']);
    $formData['sec'] = 'preleased';
}
$extra = [];
foreach ($formData as $k => $v) {
    if (!in_array($k, ['sec','type_of','state','reg','category','sub_state'])) {
        unset($formData[$k]);
        $extra[$k] = $v;
    }
}
$query = $extra ? '?' . http_build_query($extra) : '';
// 3) Render the list of sub-st
if (!empty($new_homes)) {
    echo '<ul id="ldlist" class="row list-inline-item col-sm-12">';
    $i = 1;
    foreach ($new_homes as $home) {
        $sid = $home->sub_state;
        if (!isset($subStateDats[$sid])) { 
          $i++; continue; 
        }
        $data  = $subStateDats[$sid];
        $name  = $data['name'];
        $slug  = $data['slug'];
        $count = $home->id;
        $url   = Yii::app()->createUrl('listing/index',
                    array_merge($formData, ['sub_state'=>$slug])
                 ) . $query;

        // hide items past #20
        $hiddenClass = $i > 20 ? 'd-none hideles' : '';
        echo "<li class=\"col-sm-3 {$hiddenClass}\">
                <p><a href=\"{$url}\">{$name} <span>({$count})</span></a></p>
              </li>";
        $i++;
    }
    echo '</ul>';

    // 4) View All / View Less buttons
    if ($i > 20) {
        echo '<a href="javascript:void(0)" id="v_more" class="btn-more-view" onclick="showAlllist()">View All</a>';
        echo '<a href="javascript:void(0)" id="v_less" class="btn-more-view d-none" onclick="hideAlllist()">View Less</a>';
        ?>
        <style>
          .btn-more-view {
            display: inline-block;
            margin: 10px auto;
            text-align: center;
            border: 1px solid var(--logo-color);
            padding: 5px 10px;
            border-radius: 10px;
            font-weight: bold;
            position: relative;
            left: 45%;
            background: #fff;
          }
          .d-none { display: none !important; }
          @media (max-width: 575.98px) {
            #v_more,
            #v_less {
              display: none !important;
            }
          }
        </style>
        <script>
          function showAlllist(){
            document.querySelectorAll('#ldlist li.hideles')
                    .forEach(el => el.classList.remove('d-none'));
            document.getElementById('v_more').classList.add('d-none');
            document.getElementById('v_less').classList.remove('d-none');
          }
          function hideAlllist(){
            document.querySelectorAll('#ldlist li.hideles')
                    .forEach(el => el.classList.add('d-none'));
            document.getElementById('v_less').classList.add('d-none');
            document.getElementById('v_more').classList.remove('d-none');
          }
        </script>
        <?php
    }
}
?>
