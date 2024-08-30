<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UsersController
 * 
 * Handles the actions for users related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class Submited_jvproposalController extends Controller
{

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public $Controlloler_title = "Jv Proposal";
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
        $model = new JvproposalEnquiry('search');

        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());

        // Retrieve the start and end dates from the request
        $startDate = $request->getQuery('startDate', null);
        $endDate = $request->getQuery('endDate', null);

        // Add date range filtering to the model's criteria
        if ($startDate && $endDate) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('date_added >= :startDate');
            $criteria->addCondition('date_added <= :endDate');
            $criteria->params = array(
                ':startDate' => $startDate,
                ':endDate' => $endDate
            );
            $model->setDbCriteria($criteria);
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "JV Proposals"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('//submited_jvproposal/list', compact('model'));
    }


    public function actionView($id)
    {


        $model = JvproposalEnquiry::model()->findByPk($id);

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


        $this->render('view', compact('model', 'note', 'note2'));
    }

    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = JvproposalEnquiry::model()->findByPk((int)$id);

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
    public function actionUpdate($jv_id)
    {

        $model = JvproposalEnquiry::model()->findByPk($jv_id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;





        $this->renderPartial('//submited_jvproposal/view', compact('model'));
    }
}
