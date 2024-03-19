<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class TagsManager extends CApplicationComponent 
{
	 protected $_tags = array();
   
   public static function commonLan(){
	   static $_lang;
	   if( $_lang) {  return  $_lang; }
	   else{
		  $_lang =  OptionCommon::getLanguage();
	   }
	   return $_lang;
   }
   
   public static function commonKeyWords($reset=false){
		
		$language = self::commonLan();
		
		if(defined('DEPT')){
			$cacheKey = Yii::app()->options->get('cache_time','default').'w35r'.DEPT.$language;
			 
		}
		else{

		$cacheKey = Yii::app()->options->get('cache_time','default').$language;
		}
		
	
        if ($items = Yii::app()->cache->get($cacheKey)) {
			   return $items;
		}
		else{
 
        $array  = array() ; 
		$command = Yii::app()->db->createCommand(' SELECT `t`.`conversion_tag` AS tag , translationDatas.message As message  FROM `{{common_tags}}` `t` INNER JOIN `mw_translate_relation` `translateRelations` ON (`translateRelations`.`tag_id`=`t`.`id`)  INNER JOIN `mw_translation_data` `translationDatas` ON (`translationDatas`.`translation_id`=`translateRelations`.`translate_id`)  AND (`translationDatas`.`lang` =:lan)');
        $rows = $command->queryAll(true, array(':lan' => $language ));
        
        
        
        foreach ($rows as $row) {
            $items[$row['tag']] = $row['message'];
        }
        /* Common settings */ 
        $query = 'SELECT  tdata.message,translate.source_tag FROM `mw_translate_relation` `translationRelation` INNER  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan)  INNER JOIN mw_translate translate ON (`translationRelation`.translate_id=translate.translate_id) WHERE (`translationRelation`.`common_id`=:common_id) ';
 
		$command = Yii::app()->db->createCommand($query );
		
		
		 
             $rows = $command->queryAll(true, array(':lan' => OptionCommon::getLanguage(),':common_id' => '1') );
	
        foreach ($rows as $row) {
			    $t =  preg_match('/\_(.*)/',$row['source_tag']  , $matches);
			    if(isset($matches[1])){
				$items[$matches[1]] = $row['message']; 
				}
				 
        }
  
   
     
         Yii::app()->cache->set($cacheKey, $items,  60 * 60 * 24 * 30 * 100 );
		 return $items;
		}
        
         
	} 
	public function assignTags(){
		 
		if(empty($this->_tags)){
			$this->_tags = self::commonKeyWords(false);
		}
		 
	}
	public function getTag($key, $defaultValue = null)
    {
		
		$language = self::commonLan();  
		 
		if($language== 'en' || Yii::app()->isAppName('backend')){
			return $defaultValue;
		}
		
		
	 
        // simple keys are set with default category, we need to retrieve them the same.
        $this->assignTags();
        return isset($this->_tags[$key]) ? trim($this->_tags[$key]) : $defaultValue;
    }
}
