<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Image_watermarkController
 * 
 * Handles the actions for themes related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
*/

class Image_watermarkController extends Controller
{
    public function actionIndex()
    {
        $model = ImageWatermark::model()->findByPk(1);
        if (!$model) {
            $model = new ImageWatermark;
            $model->id = 1;
        }
        
        if (isset($_POST['ImageWatermark'])) {
            $model->attributes = $_POST['ImageWatermark'];
    
            // Handle watermark image upload
            $image = CUploadedFile::getInstance($model, 'watermark_image');

            if ($image) {
                $uploadDir = Yii::getPathOfAlias('root.uploads.files.' . date("Y") . "." . date("m"));
            
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileExtension = $image->getExtensionName();
                $fileName = time() . '_.' . $fileExtension;
                $filePath = $uploadDir . '/' . $fileName;
            
                if ($image->saveAs($filePath)) {
                    $model->watermark_image = date("Y") . "/" . date("m") . '/' . $fileName;
                } else {
                    Yii::app()->user->setFlash('error', 'Failed to save the uploaded watermark image.');
                }
            }
            
    
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Watermark settings updated.');
            }
        }
    
        $this->render('index', ['model' => $model]);
    }
   
}
