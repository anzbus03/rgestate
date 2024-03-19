jQuery(document).ready(function($){
 /*$("#RoomManager_hotel_id").change(function(){
	 var k =$(this).val();
	 $("#ld").show();
	 var url = $("#ld").attr("data-attr");
	 $.get( url + "/gettype/" + k  ,function(data){if(data){ $("#RoomManager_room_type_id").html(data) ; } })
	 $.get( url + "/getcapacity/" + k  ,function(data){if(data){ $("#RoomManager_capacity_id").html(data) ; $("#ld").hide();  } });
	  $("#ajax").html("") ;
	});
	* */
	 $("#PricePlan_hotel_id").change(function(){   
		  var k =$(this).val();
		  $("#ld").show();
		   var url = $("#ld").attr("data-attr");
		   $.get( url + "/gettype/" + k  ,function(data){if(data){ $("#PricePlan_room_type_id").html(data) ; $("#ld").hide(); } })
		 });
	 $("#PricePlan_room_type_id").change(function(){   
		  var type =$(this).val();
		  var hotel =$("#PricePlan_hotel_id").val();
		  $("#ld2").show();
		   var url = $("#ld2").attr("data-attr");
		   $.get( url + "/getcapacity/" + hotel  + "/" + type,function(data){if(data){ $("#ajax").html(data) ; $("#ld2").hide(); } })
		 });
	 $("#hotel_change").change(function(){ 
		 $(".rmoveRow").remove();
		  var k =$(this).val();
		  $("#ld").show();
		   var url = $("#ld").attr("data-attr");
		   $.get( url + "/gettype/" + k  ,function(data){if(data){ $("#type_change").html(data) ; $("#ld").hide(); } })
		 });
	 $("#type_change").change(function(){ 
		  $(".rmoveRow").remove();  
		  var type =$(this).val();
		  var hotel =$("#hotel_change").val();
		  $("#ld2").show();
		   var url = $("#ld2").attr("data-attr");
		   $.get( url + "/getrangelist/" + hotel  + "/" + type,function(data){if(data){ $("#last").remove(); ;$("#first").after(data) ; $("#ld2").hide(); } })
		 });
	
	 $("#Hotel_country").change(function(){
		 var k =$(this).val();
		 $("#cont_change_").show();
		 var url = $("#cont_change_").attr("data-attr");
		 $.get( url + "/getSatate/id/" + k  ,function(data){if(data){ $("#Hotel_state").html(data) ; $("#cont_change_").hide(); } })
	});
    
});
