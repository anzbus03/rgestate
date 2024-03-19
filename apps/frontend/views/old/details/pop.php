<div id="enquiry-form-main-wrapper">
    <div id="enquiry-form-black-background" style="display: none;"></div>
    <div id="send-enquiry-form-wrapper" style="position: fixed; top: 16.5px; left: 224.5px; display: none;z-index:33333333">
        <div class="overflow">
            <div id="send-enquiry-left-block">
        
    <div id="send-enquiry-left-block-img-wrapper">
		<?php
		if(!empty($model->singleAdImage)){
			?>
			 <img src="<?php echo  $model->renderImageNew(@$model->singleAdImage->image_name);;?>">
			<?
		}
		?>
       
    </div>
    <div id="send-enquiry-left-block-content-wrapper">
        <h3 class="title"></h3>
        <p class="location"><?php echo $model->ad_title;?>    - <?php echo $model->locationString;?></p>
        <div id="send-enquiry-popup-amenities">
			<?php
			if(!empty($model->bedrooms)){
			?>
            <div><span class="icon-bed"></span> <?php echo $model->bedrooms;?></div>
            <?php }
            ?>
            <?php
			if(!empty($model->bathrooms)){
			?>
            <div><span class="icon-bath"></span><?php echo $model->bathrooms;?></div>
            <?php
			}
			?>
			<?php
			if(!empty($model->builtup_area_sqft)){
			?>
			<div><span class="icon-area_3"></span> <?php echo $model->builtup_area_sqft ;?> sq ft</div>
			<?php
			}
			?>
        </div>
        <div class="price"><?php echo $model->detailsPriceHtml;?></div>
        <div>
            <p class="logo-title">This property is brought to you by:</p>
            <div class="logo-container">
               <a href="#"><?php echo $model->Customer->fullName;?></a>
            </div>
            <button data-enq_tip_no="" onclick="$(this).html('<?php echo $model->mobile_number;?>')" class="button button-secondary button-block" data-phone="0563625407" data-role="call" data-stats="{&quot;listing_id&quot;: &quot;707410&quot;, &quot;src&quot;: &quot;1&quot;}">
            <span class="icon-phone"></span> Call Agent </button>
        </div>
    </div>

        </div>
            <div id="send-enquiry-right-block">
                






 
	<?php
	$contact = new SendEnquiry();
	$contact->ad_id = $model->id ;
	$contact->meassage = 'Hello 
I found your property on  '.Yii::app()->options->get('system.common.site_name').'. Please send me more information about this property
Thank you';
				$form = $this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl('site/validateEnquiry'),
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				'afterValidate' => 'js:function(form, data, hasError) { 
				if(hasError) {
				return false;
				}
				else
				{
				 
						ajaxSubmitHappen(form, data, hasError); 
				}
				}',
				),
				'htmlOptions'=>array('class'=>'pure-form pure-form-aligned main-enquiry-form' ),
				));
				?>
    <legend><i class="icon icon-email"></i>Send Enquiry</legend>
    <fieldset>
        <div class="division">
            <div class="pure-control-group form-icon form-icon-person">
				<?php echo $form->textField($contact, 'name',$model->getHtmlOptions('name',array('class'=>'pure-input-1'))); ?>
				<?php echo $form->hiddenField($contact, 'ad_id'); ?>
				<?php echo $form->error($contact, 'name');?>
				<?php echo $form->error($contact, 'ad_id');?>
                
            </div>
            <div class="pure-control-group form-icon form-icon-mail">
				<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'pure-input-1'))); ?>
				<?php echo $form->error($contact, 'email');?>
            </div>
            <div class="pure-control-group form-icon form-icon-mobile">
				<?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'pure-input-1'))); ?>
				<?php echo $form->error($contact, 'phone');?>
            </div>
        </div>
        <div class="division">
            <div class="pure-control-group">
                
                <?php echo $form->textArea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'pure-input-1'))); ?>
                <?php echo $form->error($contact, 'meassage');?>
            </div>
            <div class="pure-control-group">
                <div style="width: 270px;">
                    <div data-sitekey="6Ld4-_8SAAAAAHpnkLeO07DUb1_4OXBFi7Fm91wb" class="g-recaptcha"><div>  </div>
                </div>
            </div>
            <div class="pure-control-group">
                <button class="button button-primary" id="submit" name="submit" type="submit" role="trigger-sending">
                    <span class="icon-mail-3"></span> Send Enquiry
                </button>
            </div>
        </div>
    </fieldset>
<input type="hidden" name="data_src" value="4"><input type="hidden" name="listing_ids[]" value="707410"> 

<?php $this->endWidget(); ?>

            </div>
            <div id="send-enquiry-success-outer" style="display: none;">
            <div id="send-enquiry-success">
                <div id="send-enquiry-success-top row">
                    <h3><span class="icon-ok-1"></span>Enquiry successfully sent</h3>
                </div>
                <div class="row" id="send-enquiry-success-bottom"></div>
            </div>
            </div>
        </div>
        <div class="icon-cancel" id="send-enquiry-popup-close" onClick="return hidePopup()">
        </div>
    </div>
</div>
<style>
</style>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
<script>
 function  ajaxSubmitHappen(form, data, hasError)
{
    if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":"<?php echo Yii::app()->createUrl('site/SendEnquiry');?>",
                                    "data":form.serialize(),
                                    "success":function(data){
										if(data=='1'){
											$('#send-enquiry-left-block,#send-enquiry-right-block').hide();
											$('#send-enquiry-success-outer').show();
										}
										else{
											alert(data);
										}
                                     },

                                  });
     }
      else
    { 
       alert('error');
     }
 }
</script>
