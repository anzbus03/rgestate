 $('#city-dropdown,#country-dropdown,#account-actions').click(function(e) { //button click class name is myDiv
  e.stopPropagation();
   
 })

 $(function(){
		$('#city-dropdown').click(function() {
		$(this).addClass('expand');
		$("#country-dropdown").removeClass('expand');
		$('ul.country').hide();
		 
		$('#account-action-wrapper-dropdown').hide();
		$('ul.city').show(); 
  });
  $('#country-dropdown').click(function() {
		$(this).addClass('expand');
		$("#city-dropdown").removeClass('expand');
		
		$('ul.city').hide(); 
		$('#account-action-wrapper-dropdown').hide(); 
		$('ul.country').show(); 
		
  });
  $('#account-actions').click(function() {
	    $("#country-dropdown,#city-dropdown").removeClass('expand');
		$('ul.city').hide(); 
		$('ul.country').hide();
		$('#account-action-wrapper-dropdown').show(); 
  });
  $(document).click(function(){  
			$("#country-dropdown,#city-dropdown").removeClass('expand');
			$('ul.city').hide(); //hide the button
			$('ul.country').hide(); 
			$('#account-action-wrapper-dropdown').hide();
  });
 
});
