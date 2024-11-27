<?php defined('MW_PATH') || exit('No direct script access allowed');

// Render content if allowed
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { ?>
    <div class="card card-primary borderless">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, $pageHeading);?>
            </h3>
            <div>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
                <?php echo CHtml::link(Yii::t('app', 'Export'), array('language_tags/export'), array('class' => 'btn btn-info btn-xs', 'title' => Yii::t('app', 'Export')));?>
            </div>
            <style>
                td a::after {
                    content: unset!important;
                }
                td a{
                    color: white !important;
                }
            </style>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Conversion Tag');?></th>
                            <th><?php echo Yii::t('app', 'Translation');?></th>
                            <th><?php echo Yii::t('app', 'Is Verified');?></th>
                            <th><?php echo Yii::t('app', 'Options');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo $data->conversion_tag . "&nbsp;" . $data->getTranslateHtml("conversion_tag", "ar"); ?></td>
                                <td><span dir="rtl"><?php echo $data->translation; ?></span></td>
                                <td><span dir="rtl"><?php echo $data->is_verifiedText; ?></span></td>
                                <td>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->primaryKey)); ?>" class="btn btn-primary btn-xs" title="<?php echo Yii::t('app', 'Update');?>"><span class="fa fa-pencil"></span></a>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->primaryKey)); ?>" class="btn btn-danger btn-xs delete" title="<?php echo Yii::t('app', 'Delete');?>"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="modal fade" id="modal-7"  >
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Translate Content</h4>
            </div>
            <div class="modal-body" style="min-height:300px;">
				<div style="padding: 0px 16px;display:none;" ><p style="font-size:13px;font-weight:bold;">Translate Text</p><p id="text" style="max-height:100px; overflow-y:auto;"></p></div>
                <div id="modelContent"><span style="padding: 0px 16px;">Content is loading...</span></div>
            </div>
			 
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="$('#SubmitClick').click(); " class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> 
<?php 
}

// After content hook
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<script>
$(document).ready(function() {
    
    $('#dataTable').DataTable({
        createdRow: function(row, data, index) {
                $(row).addClass('selected');
            },
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" style="line-height:40px;" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" style="line-height:40px;" aria-hidden="true"></i>'
                }
            }
    });
});
function upddatethis(k){
 
 $.get('<?php echo Yii::app()->createUrl('language_tags/update_status');?>/id/'+$(k).attr('data-id')+'/verify/'+$(k).attr('data-verify'),function(data){
     
     var data =JSON.parse(data);
     if(data.val=='1'){
         $(k).html('<i class="fa  fa-check-square-o  text-green"></i>'); 
         $(k).attr('data-verify','1')
     }
     else{
         $(k).html('<i class="fa fa-square text-red"></i>');
         $(k).attr('data-verify','0');
     }
     
     })
}

function showAjaxModal(k) {
	var myTag = $('head > script[src$="js/elfinder.min.js"],script[src$="js/elfinder.full.js"]:first'),
		baseUrl, hide, fi, cnt;
	var baseUrl = myTag.attr('src').replace(/js\/[^\/]+$/, '');

	if (baseUrl == undefined) { return false; }
	dataId = $(k).attr('data-id');

	var dataWidth = $(k).attr('data-width');
	if (dataWidth !== undefined) {
		$('#modal-7').find('.modal-dialog').css('width', dataWidth);
	}
	else {
		$('#modal-7').find('.modal-dialog').css('width', '800px');
	}

	fieldid = $(k).attr('data-fieldid');
	dataRelation = $(k).attr('data-relation');
	dataRelation_id = $(k).attr('data-relation_id');
	disableEditer = $(k).attr('data-disableediter');
	fieldid = $(k).attr('data-fieldid');
	lan = ($(k).data('lan') == undefined) ? 'ar' : $(k).data('lan');

	$('#text').html($('#' + fieldid).val());

	if (dataId == undefined) return false;
	$('#modal-7').find('#modelContent').html('loading..');
	jQuery('#modal-7').modal('show', { backdrop: 'static' });
	var csrfToken = $("#csrf_token").val();
    var baseUrl = '<?php echo Yii::app()->createAbsoluteUrl("/translate/addTerm"); ?>';

    // JavaScript: Dynamically build the full URL
    var url = baseUrl + '/id/' + dataId + '/relation/' + dataRelation + '/relationID/' + dataRelation_id + '/disableEditer/' + disableEditer + '/lan/' + lan;
	$.ajax({
		url: url,
		type: 'POST',
		data:{
			csrf_token: csrfToken
		},
		success: function (response) {

			jQuery('#modal-7 #modelContent').html(response);
		}
	});
}
</script>
    