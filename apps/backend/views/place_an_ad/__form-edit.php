 
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
					     <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Location</u></div>
						 <div style="clear:both"></div>
						 <div>
						  <div class='wid4_head1 disabled' id="country"></div><div class="wid4_median1"></div>
						  <div class='wid4_head1 disabled' id="state"></div><div class="wid4_median1"></div>
						  <div class='wid4_head1 disabled' id="city"></div> 
						 </div>
						  <div style="clear:both"></div>
						   <div style="font-size:14px;font-weight:bold;margin-bottom:5px;" class="wid4_head1"><u>Choose Ad Type</u></div>
						 <div style="clear:both"></div>
						  <div>
								<div id="section" class="wid"></div>
								<div class="wid2"></div>
								<div id="category_sel" class="wid"></div>
								<div class="wid2"></div>
								<div id="sub_category_sel" class="wid"></div>
						  <div style="clear:both"></div>
						 </div>
						 
						
					 
				   </div>
					 <?php echo $form->hiddenField($model, 'country'); ?>
					 <?php echo $form->hiddenField($model, 'state'); ?>
					 <?php echo $form->hiddenField($model, 'city'); ?>
					 <?php echo $form->hiddenField($model, 'sub_category_id'); ?>
                <script type="text/javascript">
            $(document).ready(function () {
				var country =  <?= $country ;?>; 
				var state = <?= $state ;?>; 
				 
				var city = <?= $city ;?>; 
				var city2 = <?=CJSON::encode( array('0'=>"Select City"));?>; 
				var section = <?=CJSON::encode( array('0'=>"Select Category"));?>;   
				var section = <?= $section ;?>;   
				var category = <?= $category ;?>;   
				var subcategory = <?= $sub_category;?>; 
				var subcategory2 = <?=CJSON::encode( array('0'=>"Select Sub Category"));?>;   
		        
                //jqx combobox
                
                $("#country").jqxComboBox({ theme: 'energyblue',source: country,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px'  });
                $("#country").jqxComboBox('selectItem', '<?php echo $model->country;?>' );
                $("#state").jqxComboBox({ theme: 'energyblue',source: state,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
                $("#state").jqxComboBox('selectItem', '<?php echo $model->state;?>' );
                $("#city").jqxComboBox({ theme: 'energyblue',source: city,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
                $("#city").jqxComboBox('selectItem', '<?php echo $model->city;?>' );
               //jqx list box
               
               $("#section").jqxListBox({  theme: 'energyblue', selectedIndex: 0,  source: section, displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#section").jqxListBox('selectItem', '<?php echo $model->section_id;?>' );
               $("#category_sel").jqxListBox({ theme: 'energyblue',selectedIndex: 0,displayMember: "name", valueMember: "id", source: category, width: 200, height: 250});
               $("#category_sel").jqxListBox('selectItem', '<?php echo $model->category_id;?>' );
               $("#sub_category_sel").jqxListBox({theme: 'energyblue', selectedIndex: 0, source: subcategory,  displayMember: "name", valueMember: "id", width: 200, height: 250});
               $("#sub_category_sel").jqxListBox('selectItem', '<?php echo $model->sub_category_id;?>' );
               $("#section,#category_sel,#sub_category_sel").jqxListBox('disableAt', 0 ); 
               $("#country,#state,#city").jqxComboBox('disableAt', 0 ); 
               
               
               
                //country chnge
                $('#country').on('change', function (event) {
					$(".wid4_median1").addClass("wid3_median1");
					var args = event.args;
					
					if (args) {
						   var value = args.item.value;
						   $("#PlaceAnAd_country").val(value);
						   $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_state'); ?>",{"country":value},function(data){ 
								     $("#state").jqxComboBox({  source:JSON.parse(data)  , selectedIndex:0,displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
								     $("#city").jqxComboBox({ source: city2,selectedIndex:0,  displayMember: "name", valueMember: "id", width: '200px', height: '25px' ,});
								     $("#state").jqxComboBox('disableAt', 0 ); 
								      $("#PlaceAnAd_state,#PlaceAnAd_city").val(""); 
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
						   $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_city'); ?>",{"state":value},function(data){ 
								  $("#city").jqxComboBox({  source:JSON.parse(data) ,selectedIndex:0,    displayMember: "name", valueMember: "id", width: '200px', height: '25px' });
								  $("#city").jqxComboBox('disableAt', 0 );
								   $("#PlaceAnAd_city").val("");
								  $(".wid4_median1").removeClass("wid3_median1");
								  } )
					  };
				
			   });
			   
			   		
			$('#city').on('change', function (event) {
				var args = event.args;
				$(".wid2").addClass("wid3");
				if (args && !isNaN(parseInt(args.item.value))) {
					   var value = args.item.value;
					   $("#PlaceAnAd_city").val(value);
					   $("#section").jqxListBox({ theme: 'energyblue',  source: section2 , width: 200, height: 250});  
					   $("#section").jqxListBox('disableAt', 0 );
				}
				$(".wid2").removeClass("wid3");
			});
                
           
               
               $('#section').on('change', function (event) {
				// the event is raised when the selection is changed.
				$(".wid2").addClass("wid3");
				var args = event.args;
				if (args && !isNaN(parseInt(args.item.value))) {
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_category'); ?>",{"section":value},function(data){  
						   $("#category_sel").jqxListBox({ theme: 'energyblue',  source: JSON.parse(data) ,displayMember: "name", valueMember: "id"});
						   $("#sub_category_sel").jqxListBox({theme: 'energyblue', selectedIndex: 0, source: subcategory2, width: 200, height: 250});
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
				var args = event.args;
				if (args && !isNaN(parseInt(args.item.value))) {
					  $(".btn").attr("disabled");
					  var value = args.item.value;
					  $.post("<?php echo Yii::app()->createUrl('place_an_ad/select_sub_category'); ?>",{"category":value},function(data){   $("#sub_category_sel").jqxListBox({ theme: 'energyblue',  source: JSON.parse(data) ,displayMember: "name", valueMember: "id"}); $("#sub_category_sel").jqxListBox('disableAt', 0 ); $(".wid2").removeClass("wid3"); } )
				      $(".btn").attr("disabled",true);
					 $("#PlaceAnAd_sub_category_id").val("");
				
				}
				 
			 });
				$('#sub_category_sel').on('change', function (event) {
				if (args && !isNaN(parseInt(args.item.value))) {
					     $(".btn").removeAttr("disabled");
					    var value = args.item.value;
					    $("#PlaceAnAd_sub_category_id").val(value);
					   
				}
				 
			});
			
			
			
            });
            
            
        </script>
       
            
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
 
