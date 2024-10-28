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
                    // Define the path to the image file
                    $imagePath = Yii::getPathOfAlias('webroot') . '/uploads/' . $item->image_name;

                    // Check if the image file exists on the server
                    $imageExists = file_exists($imagePath);

                    // Prepare the row data including the image existence check
                    $response['data'][] = [
                        $imageExists ? CHtml::image(Yii::app()->request->baseUrl . '/uploads/' . $item->image_name, $item->image_name, ['width' => '50']) : 'Image not found',
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
                "<input type='checkbox' class='bulk-item' value='$item->id'>",
                "<img src='{$imageUrl}' alt='{$imageUrl}' style='width: 100px; height: 100px;'>",
                $item->image_name,
                $item->ad->ad_title,
                $item->status,
                // CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/update', ['id' => $item->id]), ['class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Update')]) .
                CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl(Yii::app()->controller->id . '/delete', ['id' => $item->id]), ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Delete'), 'onclick' => 'return confirm("Are you sure you want to delete this item?")']),
            ];
        }

        // Send response as JSON
        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function actionDelete($id)
    {
        $model = AdImage::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested image does not exist.'));
        }

        $model->updateByPk($id, array('isTrash' => Yii::app()->params['onTrash']));

        //144
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }
    public function actionBulk_action()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $action = $_GET['bulk_action'];
        $items  = $_GET['bulk_item'];

        if ($action == PlaceAnAd::BULK_ACTION_TRASH && count($items)) {
            $affected = 0;
            $customerModel = new AdImage();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                $customer->updateByPk($item, array('isTrash' => '1'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        $defaultReturn = $request->getServer('HTTP_REFERER', array('image_library/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
    // public function actionUploadFiles()
    // {
    //     $files = CUploadedFile::getInstancesByName('files');
    //     $floorPlanFiles = CUploadedFile::getInstancesByName('floorPlans'); // Capture floor plan files
    //     $propertyId = isset($_POST['property_id']) ? $_POST['property_id'] : null;
    //     $videoLink = isset($_POST['video_link']) ? $_POST['video_link'] : null;

    //     $img_saved = false;
    //     foreach ($files as $k) {
    //         // Construct the upload path based on the current year and month
    //         $rootPath = dirname(Yii::getPathOfAlias('webroot'));
    //         $year = date('Y');
    //         $month = date('m');
    //         $uploadDir = "{$rootPath}/uploads/files/{$year}/{$month}/";

    //         // Ensure the directory exists
    //         if (!is_dir($uploadDir)) {
    //             if (!mkdir($uploadDir, 0755, true)) {
    //                 // If mkdir fails, return an error message
    //                 $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to create directory: {$uploadDir}"]);
    //                 return;
    //             }
    //         }

    //         // Save the uploaded file
    //         $fileName = $k->name; // Generate a unique file name
    //         $filePath = $uploadDir . $fileName; // Complete path for the file

    //         if ($k->saveAs($filePath)) { // Move the uploaded file to the specified directory
    //             $room_image = new AdImage; // Create a new AdImage instance
    //             $room_image->isNewRecord = true;
    //             $room_image->ad_id = $propertyId;
    //             $room_image->image_name = $year . '/' . $month . '/' . $fileName; // Save the unique file name
    //             $img_saved = $room_image->save(); // Save the image record in the database
    //         } else {
    //             // If saveAs fails, return an error message
    //             $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to save file: {$k->name}"]);
    //             return;
    //         }
    //     }

    //     // Return a success response if at least one image was saved
    //     if ($img_saved) {
    //         echo CJSON::encode(['status' => 'success']);
    //     } else {
    //         echo CJSON::encode(['status' => 'error', 'message' => 'No images were saved.']);
    //     }
    //     Yii::app()->end();
    // }

    public function actionUploadFiles()
    {
        $files = CUploadedFile::getInstancesByName('files');
        $floorPlanFiles = CUploadedFile::getInstancesByName('floorPlans');
        $propertyId = $_POST['property_id'] ?? null;
        $videoLink = $_POST['video_link'] ?? null;
        $imageAlt = $_POST['image_alt'] ?? null;
        $imageTitle = $_POST['image_title'] ?? null;
    
        $img_saved = false;
        $floorPlanSaved = false;
    
        // Define the root directory and ensure it exists
        $rootPath = Yii::getPathOfAlias('root') . '/uploads';
        $year = date('Y');
        $month = date('m');
    
        // Process general files
        foreach ($files as $file) {
            $uploadDir = "{$rootPath}/files/{$year}/{$month}/";
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
                $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to create directory: {$uploadDir}"]);
                return;
            }
    
            $fileName = $file->name;
            $filePath = $uploadDir . $fileName;
            if ($file->saveAs($filePath)) {
                $adImage = new AdImage;
                $adImage->isNewRecord = true;
                $adImage->ad_id = $propertyId;
                $adImage->image_title = $imageTitle;
                $adImage->image_alt = $imageAlt;
                $adImage->image_name = "{$year}/{$month}/{$fileName}";
                $img_saved = $adImage->save();
            } else {
                $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to save file: {$file->name}"]);
                return;
            }
        }
    
        // Process floor plan files
        foreach ($floorPlanFiles as $floorPlan) {
            $floorPlanDir = "{$rootPath}/floor_plan/{$year}/{$month}/";
            if (!is_dir($floorPlanDir) && !mkdir($floorPlanDir, 0755, true)) {
                $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to create directory: {$floorPlanDir}"]);
                return;
            }
    
            $floorPlanName = $floorPlan->name;
            $floorPlanPath = $floorPlanDir . $floorPlanName;
            if ($floorPlan->saveAs($floorPlanPath)) {
                $adFloorPlan = new AdFloorPlan;
                $adFloorPlan->isNewRecord = true;
                $adFloorPlan->ad_id = $propertyId;
                $adFloorPlan->floor_title = $floorPlanName;
                $adFloorPlan->floor_file = "{$year}/{$month}/{$floorPlanName}";
                $floorPlanSaved = $adFloorPlan->save();
            } else {
                $this->sendJsonResponse(['status' => 'error', 'message' => "Failed to save floor plan: {$floorPlan->name}"]);
                return;
            }
        }
    
        // Save video link if provided
        if ($videoLink) {
            $placeAd = PlaceAnAd::model()->findByPk($propertyId);
            if ($placeAd) {
                $placeAd->video = $videoLink;
                if (!$placeAd->save()) {
                    $this->sendJsonResponse(['status' => 'error', 'message' => 'Failed to save video link.']);
                    return;
                }
            }
        }
    
        // Return a success response if files were saved
        if ($img_saved || $floorPlanSaved) {
            echo CJSON::encode(['status' => 'success']);
        } else {
            echo CJSON::encode(['status' => 'error', 'message' => 'No images or floor plans were saved.']);
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
