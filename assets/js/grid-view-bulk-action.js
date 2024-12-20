jQuery(document).ready(function($){
	
	ajaxData = {};
	if ($('meta[name=csrf-token-name]').length && $('meta[name=csrf-token-value]').length) {
			var csrfTokenName = $('meta[name=csrf-token-name]').attr('content');
			var csrfTokenValue = $('meta[name=csrf-token-value]').attr('content');
			ajaxData[csrfTokenName] = csrfTokenValue;
	}
	
    $(document).on('change', '.checkbox-column input[type=checkbox]', function(){
        var $this = $(this);
        setTimeout(function(){
            if ($('.checkbox-column input[type=checkbox]:checked').length) {
                $('#bulk-actions-wrapper').slideDown();
            } else {
                $('#bulk-actions-wrapper').slideUp();
                $('#bulk_action').val('');
                $('#btn-run-bulk-action').hide();
            }
        }, 50);
    }).on('change', '#bulk_action', function(){
        var $this = $(this);
        if ($this.val()) {
			if( $this.val() == 'change_status') {
				 $("#change_status").show();
				 $('#btn-run-bulk-action').hide();
				return false;
			}
			$("#change_status").hide();
            $('#btn-run-bulk-action').show();
        } else {
            $('#btn-run-bulk-action').hide();
        }
    }).on('change', '#bulk_action_status', function(){
        var $this = $(this);
        if ($this.val()) {
            $('#btn-run-bulk-action').show();
        } else {
            $('#btn-run-bulk-action').hide();
        }
    }).on('click', '#btn-run-bulk-action', function(){
	 
        if ($('#bulk_action').val() == 'delete' && !confirm($('#bulk_action').data('delete-msg'))) {
            $('#bulk_action').val('');
          
            return false;
        }
        
        $('#bulk-action-form')
            .append($('<input/>').attr({name: 'bulk_action'}).val($('#bulk_action').val()))
            .append($('<input/>').attr({name: 'status'}).val($('#bulk_action_status').val()))
            .append($('.checkbox-column input[type=checkbox]:checked').clone())
            .submit();
        
        return false;
    });
});
