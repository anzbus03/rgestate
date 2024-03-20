<?php 
$type_is = $model->all_property_types_details();
if($type_is){ ?> 
<style>
.main-heading {
    font-size: 24px;
    font-weight: 700;
    background-color: 
#fafafa;
padding: 13px 20px;
border-bottom: 1px solid
    #E9E9E9;
}
.project_type {
 
}
.project_type .content {
    padding: 20px 0px;overflow:hidden;
}.project_type > ul > li {
    margin-bottom: 20px;
    width: 100%;
}.project_type > ul > li .category {
   
     
    box-sizing: border-box;
    text-transform: uppercase;
    margin-bottom: 10px;
}.project_type > ul > li ul {
    padding: 5px 0;
    width: 100%;
    overflow: hidden;
    background-color: 
    #fbfbfb;
}.project_type > ul > li ul li:nth-child(n), .project_type > ul > li ul li:nth-child(2n) {
    width: 35%;
}
.project_type > ul > li ul li {
    width: 30%;
    box-sizing: border-box;
    padding: 0 10px 0 20px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.project_type .left {
    float: left;
}
.project_type > ul > li ul li {
    white-space: nowrap;
}.project_type > ul > li ul li .value {
    width: auto;
    font-weight: 600;
    padding: 0 5px;
    box-sizing: border-box;
    text-transform: capitalize;
}
</style>
<div id="m_property_types" class="padding-top-40"></div>
<div class="project_type   margin-top-0  np_view_tabs_data" id="prop_type" style="position: relative;">
   <!--Property types start -->
   <h3 class="headline" >Property Types</h3>
    <ul class="content">
        <style>
            
            .new-porp-style li.left.majr { width: 50%;}
             .new-porp-style li.left.majrsb { width: 25%;}
             .project_type > ul  > li .category {
    box-sizing: border-box;
    text-transform: initial;
    margin-bottom: 0px;
    word-break: normal;
    white-space: initial;
}.project_type > ul > li.prtypr {   margin-bottom: 10px; }
        </style>
         <?php
         foreach($type_is as $k2=>$v2){
			 ?>
			 <li class="left prtypr">
   
   <ul class="new-porp-style">
        <li class="left majr"><div class="category"><?php echo $v2->title;?></div></li>
      <li class="left majrsb">
         <div style="display: inline-block;"  >
            <span class="label left">Area:</span>
            <span class="value left"> <?php echo $v2->AreaTile;?></span>
         </div>
      </li>
      <?php $pr = $v2->PriceTile ;
      if(!empty($pr)){ 
      ?> 
      <li class="left majrsb">
         <div style="display: inline-block;" >
            <span class="label left">Price:</span>
            <span class="value left">RS   <?php echo $pr ;?>   </span>
         </div>
      </li>
      <?php } ?> 
   </ul>
</li>
      <?php } ?> 
         
         </ul>
    <!--Property types end -->
</div>
<?php } ?> 
