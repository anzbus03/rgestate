<?php
if($subcategory)
{
?>
<div class="widget-dropdown   no-arrow findSEl" id="search-content-rc">
	<div class="search-dropdown">
		<? 
		echo CHtml::dropDownList('sub_category_id','',CHtml::listData($subcategory,'sub_category_id','sub_category_name'),array("onchange"=>"return getOther(this)", "empty"=>"Select all","id"=>"subs_cat" )); 
		?>
	 </div>
	</div>
  <?php	 
}
?>
