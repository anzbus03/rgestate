<?php defined('MW_PATH') || exit('No direct script access allowed');

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

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
         <style> .jqx-combobox-content{ text-indent:4px;}</style>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary ', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
          
               
                <div class="clearfix"><!-- --></div>
                <ol class="progtrckr" data-progtrckr-steps="4">
					<li class="progtrckr-done">Edit Ad Type</li> 
					<li class="progtrckr-todo">Edit Details</li>
					<li class="progtrckr-todo">Edit Location</li> 
					<li class="progtrckr-todo">Done</li> 
				</ol>
               <div class="content_place_an_ad">
					
				   <div class="content_head">Step 1 : Edit Ad Type</div>
					   <div style="clear:both"></div>
				       <div class="content_content">
						
						 <div style="clear:both"></div>
					    <?php /*   <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Location</u></div> */ ?>
						 <div style="clear:both"></div>
						 <div>
						  <div class='wid4_head1 disabled' id="country"></div><div class="wid4_median1"></div>
						  <div class='wid4_head1 disabled' id="state"></div> 
						   
						 </div>
						  <div style="clear:both"></div>
						  <?php /*   <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Ad Type</u></div> */ ?>
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
					 <?php echo $form->hiddenField($model, 'country'); ?>
					 <?php echo $form->hiddenField($model, 'state'); ?>
					 <?php echo $form->hiddenField($model, 'section_id'); ?>
					 <?php echo $form->hiddenField($model, 'listing_type'); ?>
					 <?php echo $form->hiddenField($model, 'category_id'); ?>
					 <?php echo $form->hiddenField($model, 'sub_category_id'); ?>
                <script type="text/javascript">
            $(document).ready(function () {
				var country =  <?= $country ;?>; 
				var state = <?= $state ;?>; 
				 
			
				 
				var section = <?=CJSON::encode( array('0'=>"Select Category"));?>;   
				var section = <?= $section ;?>;   
				var category = <?= $category ;?>;   
				var subcategory = <?= $sub_category;?>; 
		        var list_type = <?= $list_type ;?>; 
				 
				var subcategory2 = <?=CJSON::encode( array('0'=>"Select Sub Category"));?>;   
		        
                //jqx combobox
                
                $("#country").jqxDropDownList({  source: country,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px'  });
                $("#country").jqxDropDownList('selectItem', '<?php echo $model->country;?>' );
                $("#state").jqxDropDownList({  source: state,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
                $("#state").jqxDropDownList('selectItem', '<?php echo $model->state;?>' );
               //jqx list box
               
               $("#section").jqxListBox({    selectedIndex: 0,  source: section, displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#section").jqxListBox('selectItem', '<?php echo $model->section_id;?>' );
               
               
               $("#listing_type").jqxListBox({    selectedIndex: 0,  source: list_type, displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#listing_type").jqxListBox('selectItem', '<?php echo $model->listing_type;?>' );
               
               
               $("#category_sel").jqxListBox({  selectedIndex: 0,displayMember: "name", valueMember: "id", source: category, width: 200, height: 250});
               $("#category_sel").jqxListBox('selectItem', '<?php echo $model->category_id;?>' );
               <?php
               if($model->sub_category_id != "")
               {
				   ?>
               $("#sub_category_sel").jqxListBox({  selectedIndex: 0, source: subcategory,  displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#sub_category_sel").jqxListBox('selectItem', '<?php echo $model->sub_category_id;?>' );
				<?php
				}
				?>
           
         
               $("#section,#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
               $("#country,#state").jqxDropDownList('disableAt', 0 ); 
               
               
               
                //country chnge
                $('#country').on('select', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					
					if (args && !isNaN(parseInt(args.item.value))) {
						   var value = args.item.value;
						   $("#PlaceAnAd_country").val(value);
						   $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_state'); ?>",{"country":value},function(data){ 
								     $("#state").jqxDropDownList({  source:JSON.parse(data)  , selectedIndex:0,displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
								     $("#state").jqxDropDownList('disableAt', 0 ); 
								      $("#PlaceAnAd_state").val(""); 
   								    $(".wid4_median1").removeClass("wid3_median1");
								  } )
					  };
				
			   });
			   //state
               $('#state').on('select', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					if (args && !isNaN(parseInt(args.item.value))) {
						   var value = args.item.value;
						   $("#PlaceAnAd_state").val(value);
						   $("#section").jqxListBox({    source: section2 , width: 200, height: 250});  
					       $("#section").jqxListBox('disableAt', 0 );
					       	$(".wid4_median1").removeClass("wid3_median1");
					  }
					else if( args.item.value=='All Cities') {
						   var value = args.item.value;
						   $("#PlaceAnAd_state").val(value);
						   $("#section").jqxListBox({    source: section2 , width: 200, height: 250});  
					       $("#section").jqxListBox('disableAt', 0 );
					       	$(".wid4_median1").removeClass("wid3_median1");
					  }
				
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
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_category'); ?>",{"section":value},function(data){  
						  
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
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_sub_category'); ?>",{"category":value},function(data){  
					  if(data=='["Select Subcategory"]'){
							$('#sub_category_sel').jqxListBox('clear');
							$('#sub_category_sel').hide();
							$('#PlaceAnAd_sub_category_id').val('');
							$('.wid2').removeClass('wid3');
							$('.btn').removeAttr('disabled');
					  }
					  else{
						    $('#sub_category_sel').show();
							$("#sub_category_sel").jqxListBox({    source: JSON.parse(data) ,displayMember: "name", valueMember: "id"}); $("#sub_category_sel").jqxListBox('disableAt', 0 ); $(".wid2").removeClass("wid3"); }
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
       
            
            </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit"   class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
 
