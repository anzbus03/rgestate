<div id="sectionToggleDiv"  style="display:none;padding:10px;top:10px;position:absolute;width:330px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation pam">
<div class="zIndexNavigation filterContainer">
<div class="field man">
<div class="btnGroup secCls"
>
<?php
$sections =  Section::model()->listData();
 echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->section_id == '' ) ?'btnSecondary':'' ; echo '" onclick="setThisSEctionVal(this)" data-value="">All</button>';
	
foreach($sections  as $k=>$v){
	echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->section_id == $v->slug ) ?'btnSecondary':'' ; echo '" onclick="setThisSEctionVal(this)" data-value="'.$v->slug.'">'.$v->section_name.'</button>';
 
}
?>
</div>
</div>
</div>
</div>
