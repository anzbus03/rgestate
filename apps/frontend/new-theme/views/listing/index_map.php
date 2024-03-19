<div id="details-page-container" class="detail-page details-page-container react "></div>
	<style>
	#defaultFilterBar button, #map_locator .backgroundBasic, #map_locator .h5, #map_locator h2 {
 
    font-size: 18px;    margin-bottom: 7px;
}
	#mainContainerClass { max-width:100%;}
	.xsCol12Landscape     { padding-left:10px; padding-right:10px;}
	#listing .kkNHOn {
    position: relative;
    background: #fff !important;
    z-index: 113;
}#listing .mul_sliderh {
    padding-right: 8px;
    padding-left: 8px;
    margin-bottom: 16px;
    position: relative;
    margin-bottom: 10px;
}#listing .columns {
    flex: 1;
    display: flex;
    margin-top: 0;
    width: 100% !important;
}#listing .columns #leftColumn {
    width: 50% !important;
}#listing .columns #leftColumn {
    width: 50% !important;
    padding-right: 15px;
    padding-left: 25px;
}
html[dir='rtl'] #listing .columns #leftColumn {
    width: 50% !important;
    padding-right: 25px;
    padding-left: 15px;
}
#listing .columns #leftColumn{
	height: calc(100vh - 174px);
overflow-y: scroll;
}
.cardDetails  ul { display:flex; } .gm-style .gm-style-iw-d{ overflow:hidden;}
.list-items { padding:0px !important; }
html #sechbr {
    padding: 0px 0px;
}
#site .list-prop {
  
    box-shadow: unset !important;
}
	</style>
<?php
if (Yii::app()->request->isAjaxRequest) {
	?><script> $('body').attr("id","listing");   </script>
	<?php } ?> 
<?php
if (!Yii::app()->request->isAjaxRequest) {
	?>	
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script type="text/javascript" src="<?php echo  'https://maps.googleapis.com/maps/api/js?libraries=places&key='.$this->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>&language=<?php echo LANGUAGE;?>"></script>   

<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/draw/gmap3.min.js');?>?ver=5.6.8' id='cspm-gmap3-js'></script>

<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/draw/gmaps-simplify-line.min.js');?>?ver=1.9.1' id='gmaps-simplify-line-js'></script>
 <?php } ?>
<script>/*$(window).on('popstate', function(event) {     if($('#its_detail_page').length=='1'){    $('#details-page-container').html('');  closePopupGetail();     }    });*/</script>
<div id="map_locator">
<?php echo $this->renderPartial('index_map_ajax');?>
</div>
 
