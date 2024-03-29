<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ListCsvImport
 *
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2016 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class ListCsvImport extends ListImportAbstract
{
     public $download_images;
    public function rules()
    {
        $mimes   = null;
        $options = Yii::app()->options;
        if ($options->get('system.importer.check_mime_type', 'yes') == 'yes' && CommonHelper::functionExists('finfo_open')) {
            $mimes = Yii::app()->extensionMimes->get('csv')->toArray();
        }

        $rules = array(
            array('file', 'required', 'on' => 'upload'),
            array('file', 'file', 'types' => array('csv'), 'mimeTypes' => $mimes,   'allowEmpty' => true),
            array('file_name', 'length', 'is' => 44),
            array('download_images', 'safe' ),
        );

        return CMap::mergeArray($rules, parent::rules());
    }
}
