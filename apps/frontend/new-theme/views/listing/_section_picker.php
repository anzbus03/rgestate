<div id="sectionToggleDiv"  style="display:none;padding:10px;top:10px;position:absolute;width:405px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation pam">
<div class="zIndexNavigation filterContainer">
<div class="field man">
<div class="btnGroup secCls"
>
<?php
$sections =  Section::model()->listDatalangMain();
 echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->section_id == '' ) ?'btnSecondary':'' ; echo '" onclick="setThisSEctionVal(this)" data-value="">'. 'All' .'</button>';
	
foreach($sections  as $k=>$v){
	$title_h = !empty($v->section_other) ? $v->section_other : $v->section_name;
	echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->section_id == $v->slug ) ?'btnSecondary':'' ; echo '" onclick="setThisSEctionVal(this)" data-value="'.$v->slug.'">'.$title_h.'</button>';
 
}
?>
</div>
</div>
</div>
</div>
