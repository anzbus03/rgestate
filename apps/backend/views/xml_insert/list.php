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
if ($viewCollection->renderContent) { ?>
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-book"></span> <?php echo $pageHeading;?>
                </h3>
            </div>
           
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
            
             <div class="row">
                 <div class="col-sm-12">
                            <div class="col-lg-2 col-xs-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 data-bind="text: glance.subscribersCount"><?php echo $total_added;?></h3>
                                    <p>Total Imported</p>
                                </div>
                               
                                
                            </div>
                        </div>
                        
                                 <div class="col-lg-2 col-xs-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 data-bind="text: glance.subscribersCount"><?php echo $total_updated;?></h3>
                                    <p>Total Updated</p>
                                </div>
                                
                                
                            </div>
                        </div>
                        
                        
                                 <div class="col-lg-2 col-xs-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 data-bind="text: glance.subscribersCount"><?php echo $total_no_action;?></h3>
                                    <p>No Updation</p>
                                </div>
                              
                                
                            </div>
                        </div>
                        
                        </div>
           </div> 
            <!------>
        </div>
    </div>
<?php 
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
