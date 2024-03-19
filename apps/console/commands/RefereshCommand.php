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
 
class RefereshCommand  extends CConsoleCommand 
{
    
    public function actionUpdate() 
    {
		 
	 
		$refresh_Ads = PlaceAnAdNew::model()->cronJobs();
 		if(!empty($refresh_Ads)){

			foreach($refresh_Ads as $k=>$v){ 
				PlaceAnAd::model()->updateByPk($v->id,array('cron_featured'=>$v->featured2, 'cron_expiry'=>$v->expire1,'cron_images'=>$v->ad_images_g,'cron_simage'=>   $v->ad_image2, 'cron_arabic'=> $v->ad_title2, 'cron_updated'=>new CDbExpression('NOW()')));
			}

		}
			  
    }
    public function actionNotification_orders() 
    {
		 
	 
		$notification_orders = PricePlanOrder::model()->notification_to_send();
	 
		 if(!empty($notification_orders)){

			foreach($notification_orders as $k=>$v){ 
				 
				$v->sendExpirNotification();
				 $v->updateByPk($v->order_id,array('last_send'=>date('Y-m-d')));
				 
			}

		}
			  
    }
    public function actionSlug_create(){
		$users = PlaceAnAdSlug::model()->slugMaker();
		if($users){
			 
			foreach($users as $k=>$v){
				 $ar =array();
				if($v->is_rtl($v->ad_title)){
					$ar['slug_ar'] = $v->getSlug2($v->ad_title);
					if(!empty($v->ad_title2)){
						$ar['slug_en'] = $v->getSlug2($v->ad_title2);
					}
				}
				else{
					$ar['slug_en'] = $v->getSlug2($v->ad_title);
					if(!empty($v->ad_title2)){
						$ar['slug_ar'] = $v->getSlug2($v->ad_title2);
					}
				}
				if(!empty($ar)){
						$ar['slug_cron_updated'] = new CDbExpression('NOW()');
						
						if(!empty($ar['slug_ar'])){
							$criteria=new CDbCriteria;
							$criteria->compare('slug_ar',$ar['slug_ar']);
							$criteria->compare('t.id!',$v->id);
							$fount1 = PlaceAnAd::model()->count($criteria);
							if($fount1){
								$ar['slug_ar'] = $ar['slug_ar'].'-'.$v->id;
							}
						}
						 
						if(!empty($ar['slug_en'])){
							$criteria=new CDbCriteria;
							$criteria->compare('slug_en',$ar['slug_en']);
							$criteria->compare('t.id!',$v->id);
							$fount = PlaceAnAd::model()->count($criteria);
							if($fount){
								$ar['slug_en'] = $ar['slug_en'].'-'.$v->id;
							}
						}
						
						  PlaceAnAd::model()->updateByPk($v->id,$ar);
					}
		
				   
			} 
		}
	 
	}
	public function actionUpdate_property_counter(){
		 $country = 65949;
		$ttal_for_sale = PlaceAnAdNew::model()->fetchCounter(1,$country);
		//$ttal_for_sale =  ($ttal_for_sale-($ttal_for_sale%10));
		Yii::app()->options->set('system.common.total_for_sale_'.$country,$ttal_for_sale);
		
		$ttal_for_rent = PlaceAnAdNew::model()->fetchCounter(2,$country);
		//$ttal_for_rent =  ($ttal_for_rent-($ttal_for_rent%10));
		Yii::app()->options->set('system.common.total_for_rent_'.$country,$ttal_for_rent);
	}

}
