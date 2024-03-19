<?php
$subCategories = SubCategory::model()->findAll(); // Fetch all sub-categories
$adModelCriteria = $adModel->findAds($formData, false, true);
$adModelCriteria->select = 't.sub_category_id, COUNT(t.id) AS id';
$adModelCriteria->group = 't.sub_category_id';
$new_homes = $adModel->findAll($adModelCriteria);

// Process form data
unset($formData['section_id']);
unset($formData['country']);
unset($formData['reg_id']);

// Check if preleased is set
if (isset($formData['preleased'])) {
    unset($formData['preleased']);
    $formData['sec'] = 'preleased';
}

$query = '?';
$create_array = [];
foreach ($formData as $k1 => $v1) {
    if (!in_array($k1, ['sec', 'type_of', 'state', 'reg', 'category','sub_category','nested_sub_category'])) {
        unset($formData[$k1]);
        $create_array[$k1] = $v1;
    }
}

if (!empty($create_array)) {
    $query .= http_build_query($create_array);
}

if ($query == '?') {
    $query = '';
}

// Display sub-categories
if (!empty($new_homes)) {
    echo '<ul id="ldlist" class="list-inline-item row col-sm-12">';
    $count = 1;
    foreach ($new_homes as $k => $v) {
        $subcategory = Subcategory::model()->findByPk($v->sub_category_id); // Fetch sub-category details
        if (!$subcategory) {
            continue;
        }

        $name = $subcategory->sub_category_name;
        $slug = $subcategory->slug;
        unset($formData['state']);
        $formData['sub_category'] = $slug;
        $formData1 = $formData;
        $dClass = ($count >= 41) ? 'd-none hideles' : '';
        echo '<li class="' . $dClass . ' col-sm-3"><p><a href="' . Yii::app()->createUrl('business_listing/index', $formData1) . $query . '">' . $name . '<span> (' . $v->id . ')</span></a></p></li>';
        $count++;
    }
    echo '</ul>';

    // Display View All and View Less links
    if ($count > 41) {
        echo '<a href="javascript:void(0)" id="v_moer" class=" btn-more-view" onclick="showAlllist()" >View All</a>';
        echo '<a href="javascript:void(0)" class="d-none btn-more-view" id="v_less" onclick="hideAlllist()" >View Less</a>';
    ?>
        <style>
            .btn-more-view {
                display: inline-block;
                margin: auto;
                text-align: center;
                border: 1px solid var(--logo-color);
                padding: 5px 10px;
                border-radius: 10px;
                line-height: 1;
                font-weight: bold;
                position: absolute;
                left: 0;
                right: 0;
                width: auto;
                max-width: 100px;
                background: #fff;
            }
        </style>
        <script>
            function showAlllist() {
                $('#ldlist').find('li.hideles').removeClass('d-none');
                $('#v_less').removeClass('d-none');
                $('#v_moer').addClass('d-none');
            }

            function hideAlllist() {
                $('#ldlist').find('.hideles').addClass('d-none');
                $('#v_less').addClass('d-none');
                $('#v_moer').removeClass('d-none');
            }
        </script>
<?php
    }
}
?>
