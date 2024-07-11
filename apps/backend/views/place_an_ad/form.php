<?php defined('MW_PATH') || exit('No direct script access allowed'); 
   
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
        <style>.jqx-combobox-content{ text-indent:4px;}</style>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="card-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                
                ?>
          
               
                <div class="clearfix"><!-- --></div>
                <ol class="progtrckr" data-progtrckr-steps="4">
					<li class="progtrckr-done">Choose Ad Type</li> 
					<li class="progtrckr-todo">Enter Details</li> 
					<li class="progtrckr-todo">Choose Location</li>
					<li class="progtrckr-todo">Done</li> 
				</ol>
                <div class="content_place_an_ad">
					   <div class="content_head">Step 1 : Choose Ad Type</div> 
					   <div style="clear:both"></div>
				       <div class="content_content">
						 <div style="clear:both"></div>
					    <?php /* <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Location</u></div>*/ ?>
						 <div style="clear:both"></div>
						 <div>
						  <div class='wid4_head1 disabled' id="country"></div><div class="wid4_median1"></div>
						  <div class='wid4_head1 disabled' id="state"></div> 
						 </div>
						  <div style="clear:both"></div>
						  <?php /*  <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Ad Type</u></div>*/ ?>
						 <div style="clear:both"></div>
						  <div>
								<div id="section" class="wid"></div>
								<div class="wid2"></div>
								<div id="listing_type" class="wid"></div>
								<div class="wid2"></div>
								<div id="category_sel" class="wid"></div>
								<div class="wid2"></div>
								<div id="sub_category_sel" class="wid"></div>
								 
						  <div style="clear:both"></div>
						 </div>
					 </div>
						
					 
				 </div>
				<?php echo $form->hiddenField($model, 'country'); ?>
				<?php echo $form->hiddenField($model, 'state'); ?>
				<?php echo $form->hiddenField($model, 'section_id'); ?>
				<?php echo $form->hiddenField($model, 'listing_type'); ?>
				<?php echo $form->hiddenField($model, 'category_id'); ?>
				<?php echo $form->hiddenField($model, 'sub_category_id'); ?>
			 
                <script type="text/javascript">
            $(document).ready(function () {
				var model = false;
                var country =  <?= $country ;?>; 
		        var state = <?=CJSON::encode( array('0'=>"&nbsp;Select Region"));?>; 
		        var section = <?=CJSON::encode( array('0'=>"&nbsp;Select section"));?>; 
		        var section2 = <?= $section ;?>; 
		        var list_type = <?=CJSON::encode( array('0'=>"&nbsp;Listing Type"));?>; 
		        var list_type2 = <?= $list_type ;?>; 
		        var category = <?=CJSON::encode( array('0'=>"Select Category"));?>;   
		        var subcategory = <?=CJSON::encode( array('0'=>"Select Sub Category"));?>;   
                //jqx combobox
                $("#country").jqxDropDownList({ source: country,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px'  });
                $("#state").jqxDropDownList({ source: state,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
               //jqx list box
               $("#section").jqxListBox({    selectedIndex: 0,  source: section, displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#listing_type").jqxListBox({  selectedIndex: 0,displayMember: "name", valueMember: "id", source: list_type, width: 200, height: 250});
               $("#category_sel").jqxListBox({  selectedIndex: 0,displayMember: "name", valueMember: "id", source: category, width: 200, height: 250});
               $("#sub_category_sel").jqxListBox({  selectedIndex: 0, source: subcategory, width: 200, height: 250});
               $("#section,#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
               $("#country,#state").jqxDropDownList('disableAt', 0 ); 
               
               
               
                //country chnge
                $('#country').on('select', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					
					if (args) {
						   var value = args.item.value;
						   $("#PlaceAnAd_country").val(value);
						   $.post("select_state",{"country":value},function(data){ 
								  $("#state").jqxDropDownList({  source:JSON.parse(data)  , selectedIndex:0,displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
								  $("#state").jqxDropDownList('disableAt', 0 ); 
								  $("#PlaceAnAd_state").val(""); 
								   $(".wid4_median1").removeClass("wid3_median1");
								  } )
					  };
				
			   });
			   //state
               $('#state').on('select', function (event) {
				var args = event.args;
				$(".wid2").addClass("wid3");
			 
				if (args && !isNaN(parseInt(args.item.value))) {
					   var value = args.item.value;
					    $("#PlaceAnAd_state").val(value);
					   $("#section").jqxListBox({    source: section2 , width: 200, height: 250});  
					   $("#section").jqxListBox('disableAt', 0 );
					   $("#listing_type").jqxListBox({    source: list_type2 , width: 200, height: 250});  
					   $("#listing_type").jqxListBox('disableAt', 0 );
				}
				else if ( args.item.value== "All Cities") {
					   var value = args.item.value;
					    $("#PlaceAnAd_state").val(value);
					   $("#section").jqxListBox({    source: section2 , width: 200, height: 250});  
					   $("#section").jqxListBox('disableAt', 0 );
					   $("#listing_type").jqxListBox({    source: list_type2 , width: 200, height: 250});  
					   $("#listing_type").jqxListBox('disableAt', 0 );
				}
				$(".wid2").removeClass("wid3");
				
			   });
			   
			   		
		 
                
           
               
               $('#section').on('change', function (event) {   
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				var args = event.args;
				if (args && !isNaN(parseInt(args.item.value))) {
					 var value = args.item.value;
					 $("#PlaceAnAd_section_id").val(value); 
				}
				 
			});
               
               $('#listing_type').on('change', function (event) {
				
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				var args = event.args;   
				if (args &&  args.item.value !== undefined) {
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("select_category",{"section":value},function(data){  
						  
						   $("#category_sel").jqxListBox({   source: JSON.parse(data) ,displayMember: "name", valueMember: "id"});
						   $("#sub_category_sel").jqxListBox({  selectedIndex: 0, source: subcategory, width: 200, height: 250});
                           $("#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
						   $(".wid2").removeClass("wid3"); 
						   $(".btn").attr("disabled",true);
					       $("#PlaceAnAd_listing_type").val(value);
					       $("#PlaceAnAd_sub_category_id").val("");
						   } );
				}
				 
			});
               
               
               
               
               
               
               
                // Create a jqxListBox
               
                 
                
			 
		
			 
				$('#category_sel').on('change', function (event) {
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				var args = event.args;
				if (args && !isNaN(parseInt(args.item.value))) {
					$('#sub_category_sel').hide();
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("select_sub_category",{"category":value},function(data){   
								 if(data=='["Select Subcategory"]'){
									 
										$('#sub_category_sel').jqxListBox('clear');
										$('#sub_category_sel').hide();
										$('#PlaceAnAd_sub_category_id').val('');
										$('.wid2').removeClass('wid3');
										$('.btn').removeAttr('disabled');
								 }else {
									 
									    $('#sub_category_sel').show();
										$("#sub_category_sel").jqxListBox({    source: JSON.parse(data) ,displayMember: "name", valueMember: "id"}); $("#sub_category_sel").jqxListBox('disableAt', 0 ); $(".wid2").removeClass("wid3");
								}
						   });
						   
						 
					  $("#PlaceAnAd_category_id").val(value);
				      $(".btn").attr("disabled",true);
					  $("#PlaceAnAd_sub_category_id").val("");
				
				}
				 
			 });
			 $('#sub_category_sel').on('change', function (event) {
				 $(".wid2").addClass("wid3");
				   
				if (args && !isNaN(parseInt(args.item.value))) {
					    
					 $(".btn").prop("disabled",true);
						var value = args.item.value;
						$(".wid2").removeClass("wid3");
						$(".btn").removeAttr("disabled");
						var value = args.item.value;
						$("#PlaceAnAd_model").val("");
						$("#PlaceAnAd_sub_category_id").val(value);
				}
				 
			});
			
		 
			
			   $("#section").hover(function(){ $("#section").jqxListBox('focus'); })
               $("#category_sel").hover(function(){ $("#category_sel").jqxListBox('focus'); })
               $("#sub_category_sel").hover(function(){ $("#sub_category_sel").jqxListBox('focus'); })
               $("#country").hover(function(){ $("#country").jqxDropDownList('focus'); })
               $("#state").hover(function(){ $("#state").jqxDropDownList('focus'); })
			
            });
            
            
            
        </script>
        <div id='jqxWidget'>
</div>
            
        <div id='jqxWidget2'>
</div>
               <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" disabled="true" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    
     
 
?>
              
 
