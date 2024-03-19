<?php defined('MW_PATH') || exit('No direct script access allowed');
/*
?>
 <nav class="breadcrumbs small">
	 <ul>
		<li><a href="<?php echo Yii::app()->createUrl("");?>">Home</a></li>
		<li><a href="<?php echo Yii::app()->createUrl("place_an_ad/create");?>">Place An Ad</a></li>
		<li class="active"><a href="#">Ad Edit</a></li>
 </ul>
 </nav>
<?php
*/ 
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
         <div class="breadcrumbs mar4" >
		<a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>">Place Ad</a>
		</div>
        <div class="clear"></div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h1 id="innerhead"><?php echo $model->ad_title; ?> Edit</h1> 
                </div>
                <div class="pull-right">
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
                	<ul  class="fourStep stepNavigation" style="width:100%;">
					<li class="current"><a title=""><em>Step 1: Edit Type</em><span>Choose Ad Type</span></a></li>
					<li><a title=""><em>Step 2: Details</em><span>Edit Ad details</span></a></li>
					<li><a title=""><em>Step 3: Location</em><span>Edit Location<span></a></li>
					<li class="lastStep"><a title=""><em>Step 4: Done</em><span>Completed</span></a></li>
	           </ul>
	             <div style="clear:both"></div>
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
								<div id="category_sel" class="wid"></div>
								<div class="wid2"></div>
								<div id="sub_category_sel" class="wid"></div>
								<div class="wid2"></div>
								<div id="model_wid" class="wid"></div>
						  <div style="clear:both"></div>
						 </div>
						 <div class="clear"></div>
						    <button type="submit"   class="btn btn-primary btn-submit btn_my" style="float:right;margin-right:50px;"data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
                
						
					 <div class="clear"></div>
				   </div>
					 <?php echo $form->hiddenField($model, 'country'); ?>
					 <?php echo $form->hiddenField($model, 'state'); ?>
					 <?php echo $form->hiddenField($model, 'model'); ?>
					 
					 <?php echo $form->hiddenField($model, 'sub_category_id'); ?>
                <script type="text/javascript">
				
            $(document).ready(function () {
				   $.noConflict();
				var country =  <?= $country ;?>; 
				var state = <?= $state ;?>; 
				 
				 
				var section = <?=CJSON::encode( array('0'=>"Select Category"));?>;   
				var section = <?= $section ;?>;   
				var category = <?= $category ;?>;   
				var subcategory = <?= $sub_category;?>; 
				var subcategory2 = <?=CJSON::encode( array('0'=>"Select Sub Category"));?>;  
				var vehiclemodel = <?= $vehicleModel;?>;  
		        
                //jqx combobox
                
                $("#country").jqxDropDownList({  source: country,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px'  });
                $("#country").jqxDropDownList('selectItem', '<?php echo $model->country;?>' );
                $("#state").jqxDropDownList({  source: state,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
                $("#state").jqxDropDownList('selectItem', '<?php echo $model->state;?>' );
               //jqx list box
               
               $("#section").jqxListBox({    selectedIndex: 0,  source: section, displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#section").jqxListBox('selectItem', '<?php echo $model->section_id;?>' );
               $("#category_sel").jqxListBox({  selectedIndex: 0,displayMember: "name", valueMember: "id", source: category, width: 200, height: 250});
               $("#category_sel").jqxListBox('selectItem', '<?php echo $model->category_id;?>' );
               $("#sub_category_sel").jqxListBox({  selectedIndex: 0, source: subcategory,  displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#sub_category_sel").jqxListBox('selectItem', '<?php echo $model->sub_category_id;?>' );
               $("#section,#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
               $("#country,#state").jqxDropDownList('disableAt', 0 ); 
               
               <?php
               if(!empty($vehicleModel))
               {
				   ?>
               $("#model_wid").jqxListBox({   selectedIndex: 0, source: vehiclemodel,  displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#model_wid").jqxListBox('selectItem', '<?php echo $model->model;?>' );
               $("#model_wid").jqxListBox('disableAt', 0 );
               var model =true;
                   <?php
			   }
			   else
			   {
				   ?>
				    var model =false;
				    <?php
			   }
			   ?>
               
                //country chnge
                $('#country').on('change', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					
					if (args) {
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
               $('#state').on('change', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					if (args && !isNaN(parseInt(args.item.value))) {
						   var value = args.item.value;
						   $("#PlaceAnAd_state").val(value);
						   $("#section").jqxListBox({    source: section2 , width: 200, height: 250});  
					       $("#section").jqxListBox('disableAt', 0 );
					       	$(".wid4_median1").removeClass("wid3_median1");
					  };
				
			   });
			   
			   		
		 
                
           
               
               $('#section').on('change', function (event) {
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				var args = event.args;
				$('#model_wid').jqxListBox('clear');
				$("#PlaceAnAd_model").val("");
				$('#model_wid').hide();
				if (args && !isNaN(parseInt(args.item.value))) {
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_category'); ?>",{"section":value},function(data){  
						   $("#category_sel").jqxListBox({   source: JSON.parse(data) ,displayMember: "name", valueMember: "id"});
						   $("#sub_category_sel").jqxListBox({  selectedIndex: 0, source: subcategory2, width: 200, height: 250});
                           $("#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
						   $(".wid2").removeClass("wid3"); 
						   $(".btn").attr("disabled",true);
					       $("#PlaceAnAd_sub_category_id").val("");
						   } );
				}
				 
			});
               
               
               
               
               
               
               
                // Create a jqxListBox
               
                 
                
			 
		
			 
				$('#category_sel').on('change', function (event) {
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				$('#model_wid').jqxListBox('clear');
				$("#PlaceAnAd_model").val("");
				$('#model_wid').hide();
				var args = event.args;
				if (args && !isNaN(parseInt(args.item.value))) {
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_sub_category'); ?>",{"category":value},function(data){   $("#sub_category_sel").jqxListBox({   source: JSON.parse(data) ,displayMember: "name", valueMember: "id"}); $("#sub_category_sel").jqxListBox('disableAt', 0 ); $(".wid2").removeClass("wid3"); } )
				         $.get("<?php echo Yii::app()->createUrl('place_an_ad/checkModel'); ?>?id="+value ,function(data){ if(parseInt(data)==1){   model = true; }else{ model = false; } } )
				  
				      $(".btn").attr("disabled",true);
					 $("#PlaceAnAd_sub_category_id").val("");
				
				}
				 
			 });
				$('#sub_category_sel').on('change', function (event) {
					if (args && !isNaN(parseInt(args.item.value))) {
					 var value = args.item.value;
					  if(model)
					  {
							 $(".wid2").addClass("wid3"); 
						   $.get("<?php echo Yii::app()->createUrl('place_an_ad/select_model'); ?>?id="+value ,function(data){   
							   
							    if(parseInt(data)==0)
							    {
									$(".btn").removeAttr("disabled");
									$("#PlaceAnAd_sub_category_id").val(value);
									$('#model_wid').jqxListBox('clear');
									$('#model_wid').hide();
									$("#PlaceAnAd_model").val("");
									$(".wid2").removeClass("wid3");
								}
								else
								{
									$("#PlaceAnAd_sub_category_id").val(value);
										$("#model_wid").jqxListBox({    source: JSON.parse(data) ,displayMember: "name", valueMember: "id", width: 200, height: 250 }); $("#model_wid").jqxListBox('disableAt', 0 ); $(".wid2").removeClass("wid3");
						     	
						     	    $("#PlaceAnAd_model").val("");
						     	    $('#model_wid').show();
						     	}
						     	
							    } )
				   
					  }
					  else
					  {
				 
					     $(".btn").removeAttr("disabled");
					    var value = args.item.value;
					    $("#PlaceAnAd_sub_category_id").val(value);
					   
				     }
				 }
				 
			});
			$('#model_wid').on('change', function (event) {
				 
				if (args && !isNaN(parseInt(args.item.value))) {
					 
					     var value = args.item.value;
						$(".wid2").removeClass("wid3");
					    $(".btn").removeAttr("disabled");
					    var value = args.item.value;
					    $("#PlaceAnAd_model").val(value);
				}
				
				});
		      
		       $("#section").hover(function(){ $("#section").jqxListBox('focus'); })
               $("#category_sel").hover(function(){ $("#category_sel").jqxListBox('focus'); })
               $("#sub_category_sel").hover(function(){ $("#sub_category_sel").jqxListBox('focus'); })
               $("#model_wid").hover(function(){ $("#model_wid").jqxListBox('focus'); })
               $("#country").hover(function(){ $("#country").jqxDropDownList('focus'); })
               $("#state").hover(function(){ $("#state").jqxDropDownList('focus'); })
			
			
			
            });
            
            
        </script>
       
            
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
 
</div>

