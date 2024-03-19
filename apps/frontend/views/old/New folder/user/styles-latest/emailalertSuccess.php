<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<div id="save-success-modal" style="overflow:hidden">
<div class="modal-head ss-modal">
<span class="ea-heart-icon"></span>
<h2>Search saved, thank you for making this search feel loved :)</h2>
</div>
<div class="hide-modal-close"> </div>
<div class="marginated"></div>
<img src="http://m.dbzstatic.com/assets/images/email_alerts/searchloved-img.gif">
<form id="eam-save-search" method="post" onsubmit="return submitForm()">

<label for="email-search-checkbox">
<p>
	<input id="email-search-checkbox" class="checkbox" type="checkbox" checked="" name="email-check">
 
<strong>Email</strong>
me when ads match this search
</p>
<span class="light">We may contact you for feedback on this new feature.</span>
</label>
<div class="clear"></div>
<br />
<input id="eam-save-search-button" class="eam-button" type="button" onclick="unsubscribe()" value="Update"  style="display:none;">
<input id="eam-save-search-button-close"  class="eam-button" onclick="subscribe()" type="button" value="Save">
</form>
</div>
</div>
<script>
	$("#email-search-checkbox").click(function()
	{
		if($(this).is(":checked"))
		{
			$("#eam-save-search-button").hide();
			$("#eam-save-search-button-close").show();
			
			
		}
		else
		{
			$("#eam-save-search-button-close").hide();
			$("#eam-save-search-button").show();
		}
	}
	
	)
function unsubscribe()
{
	$.get("<?php echo Yii::app()->createUrl("user/email_unsubscribe",array("id"=>$id));?>",function(data){ 
		parent.jQuery.fancybox.close();
		
		  })
			return false;
}
function subscribe()
{
	$.get("<?php echo Yii::app()->createUrl("user/email_subscribe",array("id"=>$id));?>",function(data){  
	  parent.jQuery.fancybox.close();
		
		 });
		 
     return false;
}
</script>
<style>
 
	
#eam-save-search .checkbox {
    float: left;
    margin: 3px 10px 30px;
}
#fancybox-outer div {
    transition: all 0.1s ease-in-out 0s;
}
.modal-head {
    background-color: #333;
    padding: 2px 15px;
}

.modal-head h2 {
    color: #fff !important;
    font-size: 14px;
    text-align: left;
}
.marginated {
    margin-top: 5px;
}

#save-success-modal .eam-button {
    float: right;
    
}

#save-success-modal img {
    float: right;
    margin-bottom: 15px;
    margin-right: 15px;
}
#save-success-modal p {
   font-size:13px;
   margin:10px;
   font-family:proxima-nova,​helvetica,​arial,​sans-serif;
   font-weight:400 ;
   font-style:normal;
   width:100%;
}
 

#eam-save-search .light {
    color: #666;
    display: block;
    margin-top: 15px;
    padding-left: 35px;
}
#save-success-modal .marginated {
    margin-top: 5px;
}

#eam-save-search {
    float: left;
    margin-left: 5px;
    margin-top: 20px;
    width: 50%;
}
#save-success-modal {
    background: none repeat scroll 0 0 #f2f2f2;
    float: left;
    overflow: hidden;
 
}
</style>
