<?php
/**
 * _personal_information.php
 * Professional-styled Personal Information form partial
 * @var User $model
 */
?>
<style>
/* Personal Info Card */
.pi-card {
  margin: 2rem auto;
  padding: 2rem;
  background: var(--surface-color);
  box-shadow: var(--shadow-md);
  border-radius: 12px;
}
.pi-card h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 1rem;
}

/* Form grid */
.pi-row {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}
.pi-col-6 {
  width: 100%;
  padding-right: 1rem;
  margin-bottom: 1rem;
}
@media (min-width: 768px) {
  .pi-col-6 { width: 50%; }
}
.pi-col-12 {
  width: 100%;
  margin-bottom: 1rem;
}

/* Form controls */
.pi-form-group { margin-bottom: 0.5rem; }
.pi-label {
  display: block;
  font-size: 1.1rem;
  font-weight: 500;
  color: var(--text-primary);
  margin-bottom: 0.25rem;
}
.pi-input, .pi-select {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid var(--border-color);
  border-radius: 6px;
  font-size: 0.875rem;
  color: var(--text-primary);
  background: var(--surface-color);
  transition: var(--transition);
}
.pi-input:focus, .pi-select:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 2px rgba(37,99,235,0.1);
}

/* Error text */
.pi-error { color: var(--error-color); font-size: 0.75rem; margin-top: 0.25rem; }

/* Actions */
.pi-actions {
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  padding-top: 1rem;
  border-top: 1px solid var(--border-color);
}
.pi-btn {
  padding: 0.5rem 1rem;
  border-radius: 6px;
  font-weight: 500;
  font-size: 0.875rem;
  cursor: pointer;
}
.pi-btn-cancel {
  background: var(--background-color);
  color: var(--text-secondary);
  border: 1px solid var(--border-color);
}
.pi-btn-save {
  background: var(--primary-color);
  color: white;
  border: none;
}
.pi-btn-cancel:hover { background: var(--surface-color); }
.pi-btn-save:hover   { background: #1d4ed8; }
label span{
	font-size: 10px;
}
</style>

<section class="pi-card">
  <h2>Personal Information</h2>

  <?php $form = $this->beginWidget('CActiveForm', [
      'id'=>'personal-info-form',
    //   'enableAjaxValidation'=>true,
    //   'clientOptions'=>[
    //     'validateOnSubmit'=>true,
    //     'validateOnChange'=>false,
    //   ],
  ]); ?>

  <div class="pi-row">
    <div class="pi-col-6 pi-form-group">
      <?php echo $form->labelEx($model,'first_name', ['class'=>'pi-label']); ?>
      <?php echo $form->textField($model,'first_name',['class'=>'pi-input']); ?>
      <?php echo $form->error($model,'first_name',['class'=>'pi-error']); ?>
    </div>

    <div class="pi-col-6 pi-form-group">
      <?php echo $form->labelEx($model,'last_name', ['class'=>'pi-label']); ?>
      <?php echo $form->textField($model,'last_name',['class'=>'pi-input']); ?>
      <?php echo $form->error($model,'last_name',['class'=>'pi-error']); ?>
    </div>

    <div class="pi-col-6 pi-form-group">
      <?php echo $form->labelEx($model,'email', ['class'=>'pi-label']); ?>
      <?php echo $form->textField($model,'email',['class'=>'pi-input']); ?>
      <?php echo $form->error($model,'email',['class'=>'pi-error']); ?>
    </div>

    <div class="pi-col-6 pi-form-group">
      <?php echo $form->labelEx($model,'country_id', ['class'=>'pi-label']); ?>
      <?php echo $form->dropDownList(
        $model,'country_id',
        CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name'),
        [
          'class'=>'pi-select',
          'prompt'=>'Select Country',
          'ajax'=>[
            'type'=>'POST',
            'url'=>Yii::app()->createUrl('site/loadStates'),
            'update'=>'#'.CHtml::activeId($model,'state_id'),
            'data'=>'js:{country_id:this.value}',
          ],
        ]
      ); ?>
      <?php echo $form->error($model,'country_id',['class'=>'pi-error']); ?>
    </div>

    <div class="pi-col-12 pi-form-group">
      <?php echo $form->labelEx($model,'address', ['class'=>'pi-label']); ?>
      <?php echo $form->textField($model,'address',['class'=>'pi-input']); ?>
      <?php echo $form->error($model,'address',['class'=>'pi-error']); ?>
    </div>
  </div>

  <div class="pi-actions">
    <!-- <button type="button" onclick="loadSection('dashboard')" class="pi-btn pi-btn-cancel">
      Cancel
    </button> -->
    <button type="submit" class="pi-btn pi-btn-save">
      Save Changes
    </button>
  </div>

  <?php $this->endWidget(); ?>
</section>
<script>
(function($){
  $('#personal-info-form').on('submit', function(e) {
    e.preventDefault();                // stop normal submit
    const $form = $(this);

    // clear previous errors
    $form.find('.pi-error').text('');

    // serialize and send
    $.ajax({
      url: $form.attr('action'),
      type: 'POST',
      dataType: 'json',
      data: $form.serialize(),
      beforeSend: function() {
        $form.find('button[type=submit]')
             .prop('disabled', true)
             .text('Saving...');
      },
      success: function(response) {
       if (response.status === 'success') {
			// create a small toast div
			const $toast = $('<div>')
				.text(response.message)
				.css({
				position: 'fixed',
				top: '1rem',
				right: '1rem',
				background: 'var(--success-color)',
				color: 'white',
				padding: '0.75rem 1.25rem',
				borderRadius: '6px',
				boxShadow: 'var(--shadow-md)',
				zIndex: 10000
				})
				.appendTo('body');

			// auto‐dismiss after 2s
			setTimeout(() => {
				$toast.fadeOut(300, () => $toast.remove());
			}, 2000);
			} else if (response.status === 'error' && response.errors) {
          // field-level errors come back as { fieldName: [ msg1, msg2 ], … }
          $.each(response.errors, function(attr, messages){
            // find the error <div> for that attribute and inject first message
            const $error = $form.find('#' + $form.attr('id') + '_' + attr + '_em_');
            if ($error.length) {
              $error.text(messages[0]).show();
            }
          });
        } else if (response.message) {
          // generic error
          alert(response.message);
        }
      },
      error: function(){
        alert('Unexpected error. Please try again.');
      },
      complete: function(){
        $form.find('button[type=submit]')
             .prop('disabled', false)
             .text('Save Changes');
      }
    });
  });
})(jQuery);
</script>