<?php
$array= array(
            'bedrooms' => $model->BedroomTitle,
            'bathrooms' => $model->BathroomTitle,
            'balconies' => $model->BalconiesTitle,
            'builtup_area' => $model->BuiltUpArea,
            'plot_area' => $model->PloatArea,
            'category_id' =>  $model->category_name,
            'sub_category_id' => $model->sub_category_name,
            'FloorNo' => $model->FloorNoTitle,
            'total_floor' => $model->total_floorTitle,
            'parking' =>  $model->parkingTitle,
            'construction_status' => $model->ConstructionTitle,
            'transaction_type' => $model->TransactionTypeTitle,
            'year_built' => $model->year_built,
            'rera_no' => $model->rera_no,
            'furnished' =>$model->FurnishedTitle,
            'maid_room'=>$model->MaidRooMTitle,
            'community_id'=>$model->community_name,
            'sub_community_id'=>$model->sub_community_name,
            'country'=>$model->country_name,
            'state'=>$model->state_name,
            'section_id' => $model->section_name,
            'listing_type' => $model->ListingType,
            'status'=>$model->StatusTitle,
  
    );

?>
<style>
.p_infoRow {
   
    margin: 0 15px;
    
}
.propInfoBlock .p_infoColumn {
    float: left;
    width: 25%;
    min-width:200px;
    padding:  5px 20px  5px 0px;
    border-bottom: 0px dashed #eaeaea;
}
.propInfoBlock .p_title {
    color: #666;
    font-size: 14px;
    padding-bottom: 3px;
}
.propInfoBlock .p_value {
    color: #000;
    font-size: 16px;
    padding-bottom: 3px;
}
 
</style>
<div class="propInfoBlock">
   
<div class="new-details p_infoRow">
     <?php
    foreach($array as $k=>$fld){
        if(!empty( $fld)) { 
        ?>
                <div class="p_infoColumn">
                <div class="p_title"><?php echo $model->getAttributeLabel($k);?></div>
                <div class="p_value"><?php echo $fld;?></div>
                </div>
        <?
        }
    }
    ?>
        <?php
    if(!empty($model->PrimaryUnitView)){ ?> 
    <div class="clearfix"></div>
     <div class="p_infoColumn" style="width:100%;">
                <div class="p_title"><?php echo $model->getAttributeLabel('PrimaryUnitView');?></div>
                <div class="p_value"><?php echo $model->PrimaryUnitView;?></div>
                </div>
                 
               <?php } ?>
<div class="clearfix"></div>

</div>
</div>
<div class="clearfix"></div>