<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for articles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class Submited_preqController extends Controller
{
    public function init()
    {
        parent::init();
    }

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */


    /**
     * List all available
     */

    public function actionIndex()
    {

        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $model    = new PostRequirements();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            $phone_false = @$_POST[$model->modelName]['phone_false'];
            if (!empty($phone_false)) {
                $model->phone = $phone_false;
            }
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {

                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::app()->createUrl('submited_preq/success'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'   => $notify->hasSuccess,
                'model'   => $model,
            )));

            if ($collection->success) {
            }
        }
        $banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'SB');
        $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
        $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
        if (!empty($banners)) {
            $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
            $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
        }

        $this->getData('pageStyles')->add(array('src' =>   Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.min.css'), 'priority' => -1000));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js'), 'priority' => -1000));

        $this->setData(array(
            'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => $this->tag->getTag('submit_your_property1', 'Submit Your Requirements'), '{p}' => $this->project_name)),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

        ));
        $this->render('req_form', compact('model', 'img', 'img_mobile'));
    }

    public function actionSuccess()
    {

        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->options->get('system.common.site_name') . ' | ' . Yii::t('articles', 'Contact Us'),
            'pageBreadcrumbs'   => array()
        ));
        $this->setData(array(
            'pageTitle'     => 'Submit Your Requirements',
            'pageMetaDescription'   => 'Submit Your Requirements',
            'metaKeywords'   => 'Submit Your Requirements',
        ));

        $this->render("success");
    }


    public function actionLoadCities()
    {
        $id = null;
        if (isset($_REQUEST['area'])) {
            $id = $_REQUEST['area'];
        }
        $data = CHtml::listData(States::model()->getStateWithCountry_3(66124, $id), "state_id", "state_name");
        echo "<option value=''>Select City</option>";
        foreach ($data as $k => $v)
            echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
    }


    /**
     * generate the slug for an article based on the article title
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;

        if (!$request->isAjaxRequest) {
            $this->redirect(array('areaguides/index'));
        }

        $areaguides = new Areaguides();
        $areaguides->areaguides_id = (int)$request->getPost('areaguides_id');
        $areaguides->slug = $request->getPost('string');

        $areaguides->slug = $areaguides->generateSlug();

        return $this->renderJson(array('result' => 'success', 'slug' => $areaguides->slug));
    }
}
