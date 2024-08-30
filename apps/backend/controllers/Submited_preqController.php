<?php defined('MW_PATH') || exit('No direct script access allowed');

class Submited_preqController extends Controller
{

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public $Controlloler_title = "Requirements";
    public $focus = "";
    public function init()
    {
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
        Yii::$classMap = array_merge(Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'
        ));
        parent::init();
    }

    /**
     * List all available users
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PostRequirements('serach');
        //  if ( isset( $_GET[ 'startDate' ] ) && isset( $_GET[ 'endDate' ] ) ) {
        //     $model->startDate = $_GET[ 'startDate' ];
        //     $model->endDate = $_GET[ 'endDate' ];
        // }
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Requirements Enquires"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('list', compact('model'));
    }
    public function actionExportExcel()
    {
        try {

            $model = new PostRequirements('search');
            $model->unsetAttributes();

            // clear any default values

            if (isset($_GET['type']) && $_GET['type'] == 'trash') {
                $model->isTrash = '1';
            }
            if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
                $model->startDate = $_GET['startDate'];
                $model->endDate = $_GET['endDate'];
            }
            $model->section_id =  3;

            $dataProvider = $model->search();
            $dataProvider->pagination = false;
            // Get all data

            // Prepare data for export
            $data = $dataProvider->getData();

            // Set headers to force download
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ExportedData_' . date('YmdHis') . '.xls"');
            header('Cache-Control: max-age=0');
            // Open output stream
            $output = fopen('php://output', 'w');

            // Write column headers
            $header = array('RefNo', 'Permit No', 'Title', 'Description', 'Section', 'Country', 'City', 'Date Created', 'Type', 'Price', 'Rent', 'Status', 'Category', 'Featured');
            fputcsv($output, $header, '>>>');

            // Write data rows
            foreach ($data as $item) {
                $row = array(
                    $item->RefNo,
                    $item->PropertyID,
                    $item->ad_title,
                    $item->ad_description,
                    Section::model()->findByPk($item->section_id)->section_name,
                    $item->country_name,
                    States::model()->findByPk($item->state)->state_name,
                    $item->date_added,
                    Category::model()->findByPk($item->listing_type)->category_name,
                    $item->price,
                    $item->Rent,
                    $item->status,
                    Category::model()->findByPk($item->category_id)->category_name,
                    $item->featured,
                );
                fputcsv($output, $row, '\t');
            }

            // Close output stream
            fclose($output);

            Yii::app()->end();
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }
    }
    public function actionView($id)
    {

        $model = PostRequirements::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;



        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} ID-" . $model->primaryKey),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));


        $this->render('form', compact('model', 'note', 'note2'));
    }

    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = PostRequirements::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }


        $model->deleteByPk($id);


        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }
    public function actionUpdate($id)
    {

        $model = PostRequirements::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;





        $this->renderPartial('//submited_preq/form', compact('model'));
    }
}
