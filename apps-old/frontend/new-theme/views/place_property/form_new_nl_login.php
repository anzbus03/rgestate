<style>
 .myaccount-menu.is-ended {
    display: none;
}.content-wrapper {
    background: #fff;
}
</style>
<div id="place_an_ad" class=" margin-top-50  margin-bottom-50">
<?php  $this->renderPartial('//place_property/form_new', compact('model',"country","section",'list_type','image_array','member')); ?> 
</div>
