<?php $this->renderPartial("//listing/_filter_html_top" , compact('model','user'),false,true); ?> 
<script>
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('listing/autocomplete');?>';
// $(function(){ changeForm() ;   })
 $(function(){ closeOpendDiv() ; activatelistSearchFixed()  })
 function search_byAjax(){ return false; }
</script> 
