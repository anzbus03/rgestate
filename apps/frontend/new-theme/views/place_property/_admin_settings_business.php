<style>
	#place_an_ad .row {
		margin-left: 0px;
		margin-right: 0px;
	}

	.d-flex {
		display: flex;
	}

	.padding-right-15 {
		padding-right: 15px !important;
	}

	#ck-button input:checked+span {
		background-color: #f27f52;
		color: #fff;
	}
</style>
<!-- <div class="insidecontent">

	<div class="form-group col-lg-6 hide">
		<?php// echo $form->hiddenField($model, 'p_url'); ?>
		<?php// echo $form->hiddenField($model, 'p_id'); ?>
		<?php// echo $form->hiddenField($model, 'section_id'); ?>
		<?php// echo $form->error($model, 'section_id'); ?>
	
		<?php// echo $form->hiddenField($model, 'category_id'); ?>
		<?php// echo $form->error($model, 'category_id'); ?>
	</div>
</div> -->
</div>
<div class="clearfix"><!-- --></div>
</div>
<div class="_2ytqd"></div>


<div class="insidecontent">
	<div class="clearfix"></div>
	<h3 class="subHeadh2">Admin Settings</h3>
	<h2 class="main_head_purpose"></h2>
	<div class="clearfix"></div>
	<div class="row">
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'status'); ?>
			<?php echo $form->dropDownList($model, 'status', $model->statusArray(), $model->getHtmlOptions('community_id', array('class' => 'form-control selectt2'))); ?>
			<?php echo $form->error($model, 'status'); ?>
		</div>
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'featured'); ?>
			<?php echo $form->dropDownList($model, 'featured', array('N' => 'Not Featured', 'Y' => 'Featured'), $model->getHtmlOptions('featured', array('class' => 'form-control selectt2'))); ?>
			<?php echo $form->error($model, 'featured'); ?>
		</div>
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'verified'); ?>
			<?php echo $form->dropDownList($model, 'verified', array('0' => 'Unverified', '1' => 'Verified'), $model->getHtmlOptions('verified', array('class' => 'form-control selectt2'))); ?>
			<?php echo $form->error($model, 'verified'); ?>
		</div>
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'hot'); ?>
			<?php echo $form->dropDownList($model, 'hot', array('0' => '--', '1' => 'Hot'), $model->getHtmlOptions('hot', array('class' => 'form-control selectt2'))); ?>
			<?php echo $form->error($model, 'hot'); ?>
		</div>
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'property_status'); ?><?php $model->property_status = empty($model->property_status) ? '0' : '1';; ?>
			<?php echo $form->dropDownList($model, 'property_status', array('0' => 'Not Sold/Leased', '1' => 'Sold/Leased'), $model->getHtmlOptions('property_status', array('class' => 'form-control selectt2', 'onchange' => 'show_roi(this)'))); ?>
			<?php echo $form->error($model, 'property_status'); ?>
		</div>
		<!-- Add Meta Title Field -->
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'meta_title'); ?>
			<?php echo $form->textField($model, 'meta_title', array('class' => 'form-control', 'placeholder' => 'Meta Title')); ?>
			<?php echo $form->error($model, 'meta_title'); ?>
		</div>

		<!-- Add Meta Description Field -->
		<div class="form-group col-lg-6">
			<?php echo $form->labelEx($model, 'meta_description'); ?>
			<?php echo $form->textField($model, 'meta_description', array('class' => 'form-control', 'placeholder' => 'Meta Description')); ?>
			<?php echo $form->error($model, 'meta_description'); ?>
		</div>
		<div class="clearfix"></div>
		<div class="<?php echo $model->property_status == '1' ?: 'hide'; ?>" id="roi_values">
			<script>
				function show_roi(k) {
					if ($(k).val() == '1') {
						$('#roi_values').removeClass('hide');
					} else {
						$('#roi_values').addClass('hide');
					}
				}
			</script>
			<div class="form-group col-lg-6">
				<?php
				echo $form->labelEx($model, 'income'); ?>
				<?php echo $form->textField($model, 'income', $model->getHtmlOptions('income')); ?>
				<?php echo $form->error($model, 'income'); ?>
			</div>
			<div class="form-group col-lg-6">
				<?php
				echo $form->labelEx($model, 'roi'); ?>
				<?php echo $form->textField($model, 'roi', $model->getHtmlOptions('roi')); ?>
				<?php echo $form->error($model, 'roi'); ?>
			</div>
		</div>
	</div>

</div>
<div class="clearfix"></div>
<script>
	var modelName = '<?php echo $model->modelName; ?>';
	var cityUrl = '<?php echo Yii::App()->createUrl($this->id . '/getCityId'); ?>';
	var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer'); ?>';
</script>