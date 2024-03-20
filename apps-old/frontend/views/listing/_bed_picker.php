<div id="bedroomsToggleDiv"  style="display:none;padding:10px;top:10px;position:absolute;left:0px;width:350px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation pam">
<div class="zIndexNavigation filterContainer">
<div class="field man">
<div class="btnGroup bdtCls"
>
<?php
$rooms = $filterModel->bedroomSearchIndex();
 
foreach($rooms  as $k=>$v){
	echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->bedrooms== $k ) ?'btnSecondary':'' ; echo '" onclick="setThisBedrromVal(this)" data-value="'.$k.'">'.$v.'</button>';
 
}
?>
</div>
</div>
</div>
</div>
