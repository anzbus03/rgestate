<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * SendCampaignsCommand
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class UpdateCacheCommand  extends CConsoleCommand 
{
    
    public function actionListUpdater() 
    {
		
				$time = Yii::app()->options->get('system.common.set_list_cache','1234567' );
				$cacheKey = 'menu_list'.md5('links_link').$time.Yii::app()->options->get('system.common.general_cache','1' ) ;  
				if ($itemsList = Yii::app()->cache->get($cacheKey)) {
				Yii::app()->cache->delete($cacheKey);
				}
				Section::model()->cacheMenuListAll(1);
				
				
				$time = Yii::app()->options->get('system.common.set_list_cache','1234567' );
				$cacheKey = 'links_list'.md5('links_link').$time.Yii::app()->options->get('system.common.general_cache','1' ) ;  
				if ($itemsList = Yii::app()->cache->get($cacheKey)) {
					Yii::app()->cache->delete($cacheKey);
				}
				Section::model()->cacheListAll(1);

        
    }
    public function actionCountUpdater() 
    {
			$time = Yii::app()->options->get('system.common.set_list_cache','1234567' );
			$cacheKey = 'count_list'.md5('links_link').$time.Yii::app()->options->get('system.common.general_cache','1' ) ;  
			if ($itemsList = Yii::app()->cache->get($cacheKey)) {
				Yii::app()->cache->delete($cacheKey);
			}
			CategoryCount::model()->countListAll(1);

			$time = Yii::app()->options->get('system.common.set_list_cache','1234567' );
			$cacheKey = 'count_list_country_'.md5('links_link').$time.Yii::app()->options->get('system.common.general_cache','1' ) ;  
			if ($itemsList = Yii::app()->cache->get($cacheKey) and empty($refresh)) {
				Yii::app()->cache->delete($cacheKey);
			}
			CategoryCount::model()->countListCountryAll(1);

        
    }
 

}
