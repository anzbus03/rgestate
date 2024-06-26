/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
jQuery(document).ready(function($){
	
	var ajaxData = {};
	if ($('meta[name=csrf-token-name]').length && $('meta[name=csrf-token-value]').length) {
			var csrfTokenName = $('meta[name=csrf-token-name]').attr('content');
			var csrfTokenValue = $('meta[name=csrf-token-value]').attr('content');
			ajaxData[csrfTokenName] = csrfTokenValue;
	}
	
	$('a.btn-delete-template').on('click', function(){
		var $this = $(this);
		var confirmText = $this.data('confirm-text');
		if (!confirm(confirmText)) {
			return false;
		}
		
		$.post($this.attr('href'), ajaxData, function(){
			$this.closest('.panel-template-box').fadeOut('slow', function(){
				$(this).remove();
			});
		});
		return false;
	});
	
});