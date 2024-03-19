<div id="details-page-container" class="detail-page details-page-container react "></div>
<script>$(window).on('popstate', function(event) {     if($('#its_detail_page').length=='1'){    $('#details-page-container').html('');  closePopupGetail();     }    });</script>
<div id="map_locator">
<?php echo $this->renderPartial('_index_ajax');?>
</div> 
