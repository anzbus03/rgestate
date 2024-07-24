<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                )));
                ?>
              
               <?php
				//	$this->renderPartial('_r15',array('row'=>'1'));
				//	$this->renderPartial('_r13',array('row'=>'2'));
				//	$this->renderPartial('_r15',array('row'=>'3'));
				//	$this->renderPartial('_r13',array('row'=>'4'));
					$this->renderPartial('_r11',array('row'=>'1'));
			   ?>
               <div style="width:100%;"></div>
                <div class="clearfix"><!-- --></div>        
                
                                
                <div class="clearfix"><!-- --></div>     
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                )));
                ?> 
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
      
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<style>
 .col-xs-5th-1, .col-xs-5th-2, .col-xs-5th-3, .col-xs-5th-4 {
  float: left;
}

.col-xs-5th-5 {
  float: left;
  width: 100%;
}

.col-xs-5th-4 {
  width: 80%;
}

.col-xs-5th-3 {
  width: 60%;
}

.col-xs-5th-2 {
  width: 40%;
}

.col-xs-5th-1 {
  width: 20%;
}

.col-xs-5th-pull-5 {
  right: 100%;
}

.col-xs-5th-pull-4 {
  right: 80%;
}

.col-xs-5th-pull-3 {
  right: 60%;
}

.col-xs-5th-pull-2 {
  right: 40%;
}

.col-xs-5th-pull-1 {
  right: 20%;
}

.col-xs-5th-pull-0 {
  right: auto;
}

.col-xs-5th-push-5 {
  left: 100%;
}

.col-xs-5th-push-4 {
  left: 80%;
}

.col-xs-5th-push-3 {
  left: 60%;
}

.col-xs-5th-push-2 {
  left: 40%;
}

.col-xs-5th-push-1 {
  left: 20%;
}

.col-xs-5th-push-0 {
  left: auto;
}

.col-xs-5th-offset-5 {
  margin-left: 100%;
}

.col-xs-5th-offset-4 {
  margin-left: 80%;
}

.col-xs-5th-offset-3 {
  margin-left: 60%;
}

.col-xs-5th-offset-2 {
  margin-left: 40%;
}

.col-xs-5th-offset-1 {
  margin-left: 20%;
}

.col-xs-5th-offset-0 {
  margin-left: 0%;
}

@media (min-width: 768px) {
  .col-sm-5th-1, .col-sm-5th-2, .col-sm-5th-3, .col-sm-5th-4 {
    float: left;
  }

  .col-sm-5th-5 {
    float: left;
    width: 100%;
  }

  .col-sm-5th-4 {
    width: 80%;
  }

  .col-sm-5th-3 {
    width: 60%;
  }

  .col-sm-5th-2 {
    width: 40%;
  }

  .col-sm-5th-1 {
    width: 20%;
  }

  .col-sm-5th-pull-5 {
    right: 100%;
  }

  .col-sm-5th-pull-4 {
    right: 80%;
  }

  .col-sm-5th-pull-3 {
    right: 60%;
  }

  .col-sm-5th-pull-2 {
    right: 40%;
  }

  .col-sm-5th-pull-1 {
    right: 20%;
  }

  .col-sm-5th-pull-0 {
    right: auto;
  }

  .col-sm-5th-push-5 {
    left: 100%;
  }

  .col-sm-5th-push-4 {
    left: 80%;
  }

  .col-sm-5th-push-3 {
    left: 60%;
  }

  .col-sm-5th-push-2 {
    left: 40%;
  }

  .col-sm-5th-push-1 {
    left: 20%;
  }

  .col-sm-5th-push-0 {
    left: auto;
  }

  .col-sm-5th-offset-5 {
    margin-left: 100%;
  }

  .col-sm-5th-offset-4 {
    margin-left: 80%;
  }

  .col-sm-5th-offset-3 {
    margin-left: 60%;
  }

  .col-sm-5th-offset-2 {
    margin-left: 40%;
  }

  .col-sm-5th-offset-1 {
    margin-left: 20%;
  }

  .col-sm-5th-offset-0 {
    margin-left: 0%;
  }
}
@media (min-width: 992px) {
  .col-md-5th-1, .col-md-5th-2, .col-md-5th-3, .col-md-5th-4 {
    float: left;
  }

  .col-md-5th-5 {
    float: left;
    width: 100%;
  }

  .col-md-5th-4 {
    width: 80%;
  }

  .col-md-5th-3 {
    width: 60%;
  }

  .col-md-5th-2 {
    width: 40%;
  }

  .col-md-5th-1 {
    width: 20%;
  }

  .col-md-5th-pull-5 {
    right: 100%;
  }

  .col-md-5th-pull-4 {
    right: 80%;
  }

  .col-md-5th-pull-3 {
    right: 60%;
  }

  .col-md-5th-pull-2 {
    right: 40%;
  }

  .col-md-5th-pull-1 {
    right: 20%;
  }

  .col-md-5th-pull-0 {
    right: auto;
  }

  .col-md-5th-push-5 {
    left: 100%;
  }

  .col-md-5th-push-4 {
    left: 80%;
  }

  .col-md-5th-push-3 {
    left: 60%;
  }

  .col-md-5th-push-2 {
    left: 40%;
  }

  .col-md-5th-push-1 {
    left: 20%;
  }

  .col-md-5th-push-0 {
    left: auto;
  }

  .col-md-5th-offset-5 {
    margin-left: 100%;
  }

  .col-md-5th-offset-4 {
    margin-left: 80%;
  }

  .col-md-5th-offset-3 {
    margin-left: 60%;
  }

  .col-md-5th-offset-2 {
    margin-left: 40%;
  }

  .col-md-5th-offset-1 {
    margin-left: 20%;
  }

  .col-md-5th-offset-0 {
    margin-left: 0%;
  }
}
@media (min-width: 1200px) {
  .col-lg-5th-1, .col-lg-5th-2, .col-lg-5th-3, .col-lg-5th-4 {
    float: left;
  }

  .col-lg-5th-5 {
    float: left;
    width: 100%;
  }

  .col-lg-5th-4 {
    width: 80%;
  }

  .col-lg-5th-3 {
    width: 60%;
  }

  .col-lg-5th-2 {
    width: 40%;
  }

  .col-lg-5th-1 {
    width: 20%;
  }

  .col-lg-5th-pull-5 {
    right: 100%;
  }

  .col-lg-5th-pull-4 {
    right: 80%;
  }

  .col-lg-5th-pull-3 {
    right: 60%;
  }

  .col-lg-5th-pull-2 {
    right: 40%;
  }

  .col-lg-5th-pull-1 {
    right: 20%;
  }

  .col-lg-5th-pull-0 {
    right: auto;
  }

  .col-lg-5th-push-5 {
    left: 100%;
  }

  .col-lg-5th-push-4 {
    left: 80%;
  }

  .col-lg-5th-push-3 {
    left: 60%;
  }

  .col-lg-5th-push-2 {
    left: 40%;
  }

  .col-lg-5th-push-1 {
    left: 20%;
  }

  .col-lg-5th-push-0 {
    left: auto;
  }

  .col-lg-5th-offset-5 {
    margin-left: 100%;
  }

  .col-lg-5th-offset-4 {
    margin-left: 80%;
  }

  .col-lg-5th-offset-3 {
    margin-left: 60%;
  }

  .col-lg-5th-offset-2 {
    margin-left: 40%;
  }

  .col-lg-5th-offset-1 {
    margin-left: 20%;
  }

  .col-lg-5th-offset-0 {
    margin-left: 0%;
  }
}
.rw_ab .col-md-5th-1.empty {
    vertical-align: middle;
    line-height: 284px;
    text-align: center;
    cursor: pointer;
    
}
.rw_ab .col-md-5th-1{
    min-height: 342px;
    margin: auto;
    text-algin: center;
    border: 1px solid #eee;position:relative;
}
.overlay { z-index:111111;}
</style>
