<?php
// 1) Fetch your data
$cityDats        = States::model()->byIdIterate();
$adModelCriteria = $adModel->findAds($formData, false, true);
$adModelCriteria->select = 't.state AS city_name, COUNT(t.id) AS id';
$adModelCriteria->join  .= ' LEFT JOIN {{states}} city ON t.state = city.state_id';
$adModelCriteria->group  = 't.state';
$adModelCriteria->order  = 'city.state_name ASC';
$new_homes = $adModel->findAll($adModelCriteria);

// 2) Clean up URL params
unset($formData['section_id'], $formData['country'], $formData['reg_id']);
if (isset($formData['investments'])) {
    unset($formData['investments']);
    $formData['sec'] = 'investments';
}
$extra = [];
foreach ($formData as $k => $v) {
    if (!in_array($k, ['sec','type_of','state','reg','category'])) {
        unset($formData[$k]);
        $extra[$k] = $v;
    }
}
$query = $extra ? '?' . http_build_query($extra) : '';

// 3) Render the list
if (!empty($new_homes)) {
    echo '<ul id="ldlist" class="row list-inline-item col-sm-12">';
    $i = 1;
    foreach ($new_homes as $home) {
        if (!isset($cityDats[$home->city_name])) { $i++; continue; }
        $data  = $cityDats[$home->city_name];
        $name  = $data['name'];
        $slug  = $data['slug'];
        $count = $home->id;
        $url   = Yii::app()->createUrl('listing/index',
                    array_merge($formData, ['state'=>$slug])
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
            const more = document.getElementById('v_more'),
                  less = document.getElementById('v_less');
            more.classList.add('d-none');
            more.style.display = 'none';
            less.classList.remove('d-none');
            less.style.display = 'inline-block';
          }
          function hideAlllist(){
            document.querySelectorAll('#ldlist li.hideles')
                    .forEach(el => el.classList.add('d-none'));
            const more = document.getElementById('v_more'),
                  less = document.getElementById('v_less');
            less.classList.add('d-none');
            less.style.display = 'none';
            more.classList.remove('d-none');
            more.style.display = 'inline-block';
          }
        </script>
        <?php
    }
}
?>
