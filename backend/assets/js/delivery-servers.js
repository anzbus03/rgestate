jQuery(document).ready(function($){

    var $headersTemplate    = $('#headers-template'), 
        headersCounter      = $headersTemplate.data('count');
    
    $('a.btn-add-header').on('click', function(){
        var $html = $($headersTemplate.html().replace(/__#__/g, headersCounter));
        $('#headers-list').append($html);
        $html.find('input').removeAttr('disabled');
        headersCounter++;
        return false;
    });
    
    $(document).on('click', 'a.remove-header', function(){
        $(this).closest('.form-group').remove();
        return false;
    });
    
    $('.custom-from-header select').on('change', function(){
        if ($(this).val() == 'yes') {
            $('.custom-from-header-test-email').show();
        } else {
            $('.custom-from-header-test-email').hide();
        }
    }).trigger('change');

});