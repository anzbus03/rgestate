<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Image_libraryController
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
 
class Image_libraryController extends Controller
{
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $model = new AdImage('search');
        $model->isTrash = '0';
    
        // Find only 50 properties ordered by `id` in descending order
        $criteria = new CDbCriteria();
        $criteria->limit = 50; // Limit to 50 records
        $criteria->order = 'id DESC'; // Order by `id` in descending order
        
        // Get only 50 records with the defined criteria
        $properties = PlaceAnAd::model()->findAll($criteria);
    
        if ($request->isAjaxRequest) {
            $dataProvider = $model->search(); // This should return a CActiveDataProvider instance
            $data = $dataProvider->getData();
    
            // Ensure $dataProvider is not null
            if ($dataProvider instanceof CActiveDataProvider) {
                $response = [
                    'draw' => intval($request->getParam('draw')),
                    'recordsTotal' => $dataProvider->totalItemCount,
                    'recordsFiltered' => $dataProvider->totalItemCount,
                    'data' => [],
                ];
    
                foreach ($data as $item) {
                    $response['data'][] = [
                        $item->image_name,
                        $item->ad->ad_title,
                        $item->status,
                        CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/update', ['id' => $item->id]), ['class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Update')]) .
                        CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/delete', ['id' => $item->id]), ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Delete'), 'onclick' => 'return confirm("Are you sure you want to delete this item?")']),
                    ];
                }
    
                echo CJSON::encode($response);
                Yii::app()->end();
            } else {
                // Handle the error if $dataProvider is not an instance of CActiveDataProvider
                throw new CHttpException(500, 'Internal Server Error: Invalid data provider.');
            }
        }
    
        $this->setData([
            'pageMetaTitle' => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "Image Library List"),
            'pageHeading' => Yii::t(Yii::app()->controller->id, "Image Library List"),
            'pageBreadcrumbs' => [
                Yii::t(Yii::app()->controller->id, "Image Library") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all'),
            ],
        ]);
    
        $this->render('index', compact('model', 'properties'));
    }
    
    public function actionAjaxData()
    {
        $model = new AdImage('search');
        $model->isTrash = '0';
    
        // Get the parameters from the DataTables request
        $requestData = $_GET;
    
        // Set pagination parameters from DataTables
        $pageSize = isset($requestData['length']) ? intval($requestData['length']) : 10; // Default to 10
        $offset = isset($requestData['start']) ? intval($requestData['start']) : 0;
    
        // Set criteria for search and pagination
        $criteria = new CDbCriteria;
        $criteria->compare('isTrash', '0');
    
        // Add search functionality here (if needed)
    
        // Fetch data with pagination
        $dataProvider = new CActiveDataProvider($model, [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $pageSize,
                'currentPage' => $offset / $pageSize,
            ],
        ]);
    
        // Create response structure
        $response = [
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $dataProvider->totalItemCount,
            'recordsFiltered' => $dataProvider->totalItemCount, // You can adjust this based on filtering
            'data' => [],
        ];
    
        // Loop through data and build response array
        foreach ($dataProvider->getData() as $item) {
            $imagePath = Yii::getPathOfAlias('webroot') . '/' . $item->image_name;
            $imageUrl = Yii::getPathOfAlias('') . '/uploads/files/' . $item->image_name; // URL for the image
    
            $response['data'][] = [
                "<img src='{$imageUrl}' alt='{$imageUrl}' style='width: 100px; height: 100px;'>",
                $item->image_name,
                $item->ad->ad_title,
                $item->status
                // CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/update', ['id' => $item->id]), ['class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Update')]) .
                // CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/delete', ['id' => $item->id]), ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Delete'), 'onclick' => 'return confirm("Are you sure you want to delete this item?")']),
            ];
        }
    
        // Send response as JSON
        echo CJSON::encode($response);
        Yii::app()->end();
    }
    

    public function actionUploadFiles()
    {
        $files = CUploadedFile::getInstancesByName('files');
        $propertyId = isset($_POST['property_id']) ? $_POST['property_id'] : null;
        
        $img_saved = false;
        foreach ($files as $k) {
            // Construct the upload path based on the current year and month
            $rootPath = dirname(Yii::getPathOfAlias('webroot'));
            $year = date('Y');
            $month = date('m');
            $uploadDir = "{$rootPath}/uploads/files/{$year}/{$month}/";
    
            // Ensure the directory exists
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    // If mkdir fails, return an error message
                    $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to create directory: {$uploadDir}"]);
                    return;
                }
            }
    
            // Save the uploaded file
            $fileName = $k->name; // Generate a unique file name
            $filePath = $uploadDir . $fileName; // Complete path for the file
    
            if ($k->saveAs($filePath)) { // Move the uploaded file to the specified directory
                $room_image = new AdImage; // Create a new AdImage instance
                $room_image->isNewRecord = true;
                $room_image->ad_id = $propertyId;
                $room_image->image_name = $year.'/'.$month.'/'.$fileName; // Save the unique file name
                $img_saved = $room_image->save(); // Save the image record in the database
            } else {
                // If saveAs fails, return an error message
                $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to save file: {$k->name}"]);
                return;
            }
        }
    
        // Return a success response if at least one image was saved
        if ($img_saved) {
            echo CJSON::encode(['status' => 'success']);
        } else {
            echo CJSON::encode(['status' => 'error', 'message' => 'No images were saved.']);
        }
        Yii::app()->end();
    }
       
    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        Yii::app()->end();
    }
}
