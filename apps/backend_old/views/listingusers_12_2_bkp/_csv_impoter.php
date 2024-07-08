 

    <div class="" id="csv-upload-modal" tabindex="-1" role="dialog" aria-labelledby="csv-upload-modal-label" aria-hidden="true">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

              <h4 class="modal-title"><?php echo Yii::t('list_import', 'Import from CSV file');?></h4>

            </div>

            <div class="modal-body">

                 <div class="callout callout-info">

                    <?php

                    $text = 'Please note, we only accept valid CSV files that contain a header, that is the column names for the data to be imported.<br />

                     We also have a limit on the file size you are allowed to upload, that is {uploadLimit}.<br />

                     The import process might fail with some of the files, mainly because these are not correctly formatted or they contain invalid data.<br />

                     You should first do a test import(in a test list) and see if that goes as planned then do it for your actual list.<br />

                     <strong>Important</strong>: The CSV file column names will be used to create the list TAGS, if a tag does not exist, it will be created.<br />

                    ';

                    echo Yii::t('list_import', StringHelper::normalizeTranslationString($text), array(

                        '{uploadLimit}'         => $maxUploadSize . 'MB',

                        '{exampleArchiveHref}'  => Yii::app()->apps->getAppUrl('backend', 'assets/files/example-csv-import.csv', false, true),

                    ));

                    ?>

                 </div>

                <?php

                $form = $this->beginWidget('CActiveForm', array(

                    'action'        => array('listingusers/csv_import'),

                    'htmlOptions'   => array(

                        'id'        => 'upload-csv-form',

                        'enctype'   => 'multipart/form-data'

                    ),

                ));

                ?>

                <div class="form-group">

                    <?php echo $form->labelEx($importCsv, 'file');?>

                    <?php echo $form->fileField($importCsv, 'file', $importCsv->getHtmlOptions('file')); ?>

                    <?php echo $form->error($importCsv, 'file');?>

                </div>

                <?php $this->endWidget(); ?>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close');?></button>

              <button type="button" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" onclick="$('#upload-csv-form').submit();"><?php echo Yii::t('list_import', 'Upload file')?></button>

            </div>

          </div>

        </div>

    </div>

   
