<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * BaseActiveRecord
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class BaseActiveRecord extends CActiveRecord
{
    const STATUS_ACTIVE = 'active';
    
    const STATUS_INACTIVE = 'inactive';
    
    const STATUS_DELETED = 'deleted';
    
    const TEXT_YES = 'yes';
    
    const TEXT_NO = 'no';
    
    private $_modelName;

    protected $validationHasBeenMade = false;

    public function rules()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        $rules  = $hooks->applyFilters($filter, new CList());
        
        $this->onRules(new CModelEvent($this, array(
            'rules' => $rules,
        )));
        
        return $rules->toArray();
    }
    
    public function onRules(CModelEvent $event)
    {
        $this->raiseEvent('onRules', $event);
    }
    
    public function behaviors()
    {
        $behaviors = CMap::mergeArray(parent::behaviors(), array(
            'shortErrors' => array(
                'class' => 'common.components.behaviors.AttributesShortErrorsBehavior'
            ),
            'fieldDecorator' => array(
                'class' => 'common.components.behaviors.AttributeFieldDecoratorBehavior'
            ),
            'modelMetaData' => array(
                'class' => 'common.components.db.behaviors.ModelMetaDataBehavior'
            ),
            'paginationOptions' => array(
                'class' => 'common.components.behaviors.PaginationOptionsBehavior'
            ),
        ));
        
        if ($this->hasAttribute('date_added') || $this->hasAttribute('last_updated')) {
            $behaviors['CTimestampBehavior'] = array(
                'class'           => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => null,
                'updateAttribute' => null,
            );
            
            if ($this->hasAttribute('date_added')) {
                $behaviors['CTimestampBehavior']['createAttribute'] = 'date_added';
            }
            
            if ($this->hasAttribute('last_updated')) {
                $behaviors['CTimestampBehavior']['updateAttribute'] = 'last_updated';
                $behaviors['CTimestampBehavior']['setUpdateOnCreate'] = true;
            }
        }
        
        $behaviors['dateTimeFormatter'] = array(
                'class' => 'common.components.db.behaviors.DateTimeFormatterBehavior',
                'dateAddedAttribute'    => 'date_added',
                'lastUpdatedAttribute'  => 'last_updated',
                'timeZone'              => null,
        );
        
        $behaviors = new CMap($behaviors);
        
        $hooks      = Yii::app()->hooks;
        $apps       = Yii::app()->apps;
        $filter     = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        $behaviors  = $hooks->applyFilters($filter, $behaviors);
        
        $this->onBehaviors(new CModelEvent($this, array(
            'behaviors' => $behaviors,
        )));
        
        return $behaviors->toArray();
    }

    public function onBehaviors(CModelEvent $event)
    {
        $this->raiseEvent('onBehaviors', $event);
    }
    
    public function attributeLabels()
    {
        $labels = new CMap(array(
            'status'        => Yii::t('app', 'Status'),
            'date_added'    => Yii::t('app', 'Date added'),
            'last_updated'  => Yii::t('app', 'Last updated'),
        ));
        
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        $labels = $hooks->applyFilters($filter, $labels);
        
        $this->onAttributeLabels(new CModelEvent($this, array(
            'labels' => $labels,
        )));
        
        return $labels->toArray();
    }
    
    public function onAttributeLabels(CModelEvent $event)
    {
        $this->raiseEvent('onAttributeLabels', $event);
    }
    
    protected function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        
        $this->validationHasBeenMade = true;
        
        return true;
    }

    public function relations()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        
        $relations = $hooks->applyFilters($filter, new CMap());
        
        $this->onRelations(new CModelEvent($this, array(
            'relations' => $relations,
        )));
        
        return $relations->toArray();
    }

    public function onRelations(CModelEvent $event)
    {
        $this->raiseEvent('onRelations', $event);
    }
    
    public function scopes()
    {
        $scopes = new CMap(array(
            'active' => array(
                'condition' => $this->getTableAlias(false, false).'`status` = :st',
                'params' => array(':st' => self::STATUS_ACTIVE),
            ),
            'inactive' => array(
                'condition' => $this->getTableAlias(false, false).'`status` = :st',
                'params' => array(':st' => self::STATUS_INACTIVE),
            ),
            'deleted' => array(
                'condition' => $this->getTableAlias(false, false).'`status` = :st',
                'params' => array(':st' => self::STATUS_DELETED),
            ),
        ));
        
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        $scopes = $hooks->applyFilters($filter, $scopes);
        
        $this->onScopes(new CModelEvent($this, array(
            'scopes' => $scopes,
        )));
        
        return $scopes->toArray();
    }
    
    public function onScopes(CModelEvent $event)
    {
        $this->raiseEvent('onScopes', $event);
    }
    
    public function attributeHelpTexts()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        $texts  = $hooks->applyFilters($filter, new CMap());
        
        $this->onAttributeHelpTexts(new CModelEvent($this, array(
            'texts' => $texts,
        )));
        
        return $texts->toArray();
    }

    public function onAttributeHelpTexts(CModelEvent $event)
    {
        $this->raiseEvent('onAttributeHelpTexts', $event);
    }
    
    public function attributePlaceholders()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
        
        $placeholders = $hooks->applyFilters($filter, new CMap());
        
        $this->onAttributePlaceholders(new CModelEvent($this, array(
            'placeholders' => $placeholders,
        )));
        
        return $placeholders->toArray();
    }

    public function onAttributePlaceholders(CModelEvent $event)
    {
        $this->raiseEvent('onAttributePlaceholders', $event);
    }
    
    public function getModelName()
    {
        if ($this->_modelName === null) {
            $this->_modelName = get_class($this);
        }
        return $this->_modelName;
    }
    
    public function statusIs($status = self::STATUS_ACTIVE)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => $this->getTableAlias(false, false).'`status` = :st',
            'params'    => array(':st' => $status)
        ));
        return $this;
    }
    
    public function getStatusesList()
    {
        return array(
            self::STATUS_ACTIVE     => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE   => Yii::t('app', 'Inactive'),
            // self::STATUS_DELETED    => Yii::t('app', 'Deleted'),
        );
    }
    
    public function getStatusName($status = null)
    {
        if (!$status && $this->hasAttribute('status')) {
            $status = $this->status;
        }
        if (!$status) {
            return;
        }
        $list = $this->getStatusesList();
        return isset($list[$status]) ? $list[$status] : Yii::t('app', ucfirst(preg_replace('/[^a-z]/', ' ', strtolower($status))));
    }
    
    public function getYesNoOptions()
    {
        return array(
            self::TEXT_YES  => ucfirst(Yii::t('app', self::TEXT_YES)),
            self::TEXT_NO   => ucfirst(Yii::t('app', self::TEXT_NO)),
        );
    }
    
    public function getComparisonSignsList()
    {
        return array(
            '='  => '=',
            '>'  => '>',
            '>=' => '>=',
            '<'  => '<',
            '<=' => '<=',
            '<>' => '<>',
        );
    }
    public function validatePhone($attribute,$params)
	{
		if(!empty($this->$attribute)){
			$string = $this->$attribute;
			$strlen = strlen(Yii::t('app',$string,array(' '=>'')));
			if (strpos($this->$attribute, '+') !== false) {
				$string = substr($this->$attribute,1,strlen($this->$attribute));
			}
			$errorn = $this->mTag()->getTag('please_enter_a_valid__mobile_n','Please enter a valid  Mobile No.');
			if($strlen<9){
					 $this->addError($attribute,  Yii::t('app',$errorn.$this->$attribute));	
			}
			if($strlen>14){
					 $this->addError($attribute,  Yii::t('app',$errorn.$this->$attribute));	
			}
			if (substr_count($string, ' ') > 3 ) {
				 $this->addError($attribute,  Yii::t('app',$errorn.$this->$attribute));				 
			}
			 
			$rtl_chars_pattern = '/^[\s\d]+$/';
			 
			if(preg_match($rtl_chars_pattern, $string)  ) {
			  
			}
			else {
			   $this->addError($attribute,  Yii::t('app','Please enter a valid  Mobile No.'.$this->$attribute));
			}
			 
		}
	}
	
	 
	public function validateDescription($attribute,$params)
	{
		  if($this->no_image=='1') { return true; }
		  /*
		if(!empty($this->$attribute)){
		    	$string = $this->$attribute;
		     $regex = '/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/'; 
            if (preg_match($regex, $string , $email_is)) {
              $this->addError($attribute,  Yii::t('app','String contains email.Please remove '));
            }  
			  
		   $regex = '/[0-9]{3}[\-][0-9]{6}|[0-9]{3}[\s][0-9]{6}|[0-9]{3}[\s][0-9]{3}[\s][0-9]{4}|[0-9]{9}|[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}/' ;
            if (preg_match($regex, $string , $email_is)) {
              $this->addError($attribute,  Yii::t('app','String contains phone.Please remove '));
            } 

			 
		}*/
	}
	
	
    	public function validateLandline($attribute,$params)
	{
		if(!empty($this->$attribute)){
			$string = $this->$attribute;
			$strlen = strlen(Yii::t('app',$string,array(' '=>'')));
			if (strpos($this->$attribute, '+') !== false) {
				$string = substr($this->$attribute,1,strlen($this->$attribute));
			}
			if($strlen<10){
					 $this->addError($attribute,  Yii::t('app','Please enter a valid   Landline No.'));	
			}
			if($strlen>14){
					 $this->addError($attribute,  Yii::t('app','Please enter a valid  Landline No.'));	
			}
			if (substr_count($string, ' ') > 3 ) {
				 $this->addError($attribute,  Yii::t('app','Please enter a valid  Landline No.'));				 
			}
			 
			$rtl_chars_pattern = '/^[\s\d]+$/';
			 
			if(preg_match($rtl_chars_pattern, $string)  ) {
			  
			}
			else {
			   $this->addError($attribute,  Yii::t('app','Please enter a valid  Landline No.'));
			}
			 
		}
	}
	public function getBulkActionPermission(){
		  
		return AccessHelper::hasRouteAccess(Yii::app()->controller->id."/bulk_action");
	}
	public function getBulkActionPriorityPermission(){
		  
		return AccessHelper::hasRouteAccess(Yii::app()->controller->id."/priority");
	}
	
	public function getDateAdded2(){
		  
		return date('d/m/Y', strtotime($this->dateAdded));
	}
	public function getDateAddedShort(){
		  
		return date('d/m/Y', strtotime($this->dateAdded));
	}
	public function getDateAddedLong(){
		  
		return date('d/m/y h:i A', strtotime($this->dateAdded));
	}
	public $random;
    
         public function  getFieldName($lan=null){
		$id = $this->primaryField;
		if($lan==null){
		 $lan = OptionCommon::getLanguage(); 
		}
		if($lan=='en'){ return $this->fullName;  }
		$query = 'SELECT  tdata.message  FROM `mw_translate_relation` `translationRelation` INNER  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan)    WHERE (`translationRelation`.`'.$id.'`=:'.$id.') LIMIT 1 ';
		$command = Yii::app()->db->createCommand($query );
		$rows = $command->queryAll(true, array(':lan' =>$lan,':'.$id => $this->primaryKey) );
		return isset($rows[0]['message'])   ? $rows[0]['message']  : $this->fullName;
	}
     public function  getFieldNameBackend($lan=null){
		$id = $this->primaryField;
		if($lan=='en') return $this->fullName; 
		$query = 'SELECT  tdata.message  FROM `mw_translate_relation` `translationRelation` INNER  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan)    WHERE (`translationRelation`.`'.$id.'`=:'.$id.') LIMIT 1 ';
		$command = Yii::app()->db->createCommand($query );
		$rows = $command->queryAll(true, array(':lan' =>$lan,':'.$id => $this->primaryKey) );
		return isset($rows[0]['message'])   ? $rows[0]['message']  : '' ;
	}
    public function getTranslateHtml($field,$lan='ar', $disableEditer=1){
		$fiedId = $this->modelName.'_'.$field;
		$show_translation = Yii::app()->options->get('system.common.show_translation','no');
		$fiedId .= ($this->isNewRecord) ? '_[CREATE]_'.$this->random :'_'.$this->primaryKey;
		$relation_id = $this->primaryField;
	    $style = 	($show_translation=='no') ?  '' : '' ; 
		return '<div class="pull-right"><a href="javascript:void(0)" style="'.$style.'"  data-id="'.$fiedId.'" data-lan="'.$lan.'" data-fieldid="'.$this->modelName.'_'.$field.'" data-relation_id="'.$this->primaryKey.'" data-relation="'.$relation_id.'" data-disableEditer="'.$disableEditer.'"  onclick="showAjaxModal(this)"><small class="label pull-right bg-blue">'.$lan.'</small></a></div>';
	} 
	public function listDataLang($tableName='master',$primaryKey='id',$relationKey='master_id',$fieldName='name',$condition='t.isTrash="0" and t.status=:status and f_type=:f_type',$params=array(':status'=>'A',':f_type'=>'"GroupType"' )){
		static $items;
        if (!empty($items)) {
            return $items;
        }
		$items = array();
		$command = Yii::app()->db->createCommand(' SELECT `t`.`'.$primaryKey.'` AS primaryKey ,`t`.`'.$fieldName.'` AS primayName , translationDatas.message As message  FROM `{{'.$tableName.'}}` `t` LEFT JOIN `mw_translate_relation` `translateRelations` ON (`translateRelations`.`'.$relationKey.'`=`t`.`'.$primaryKey.'`)  LEFT  JOIN `mw_translation_data` `translationDatas` ON (`translationDatas`.`translation_id`=`translateRelations`.`translate_id`)  AND (`translationDatas`.`lang` =:lan)  WHERE  '.$condition.' ORDER BY t.priority,t.religion_name' );
        $rows = $command->queryAll(true, array_replace(array(':lan' => OptionCommon::getLanguage()),$params ));
        foreach ($rows as $row) {
            $items[$row['primaryKey']] = !empty($row['message']) ? $row['message'] : $row['primayName']; ;
        }
        return $items; 
	}
	public function mTag()
    {
        static $_tag;
        if ($_tag !== null) {
            return $_tag;
        }
		$_tag =  Yii::app()->tags;
        return $_tag;
    }
	public function createTransLinkEditor($filed){
		return $this->getTranslateHtml($filed,'ar',false,'1200px').'<span class="pull-right">&nbsp;</span>'.$this->getTranslateHtml($filed,'ar',false,'1200px');
	}
	public function createTransLink($filed){
		return $this->getTranslateHtml($filed,'ar').'<span class="pull-right">&nbsp;</span>'.$this->getTranslateHtml($filed,'ar');
	}
	public function getBulkUpdateText(){   if(Yii::app()->request->getQuery('bulk_update','0')=='1'){ return '<input type="checkbox" class="chk"  style="width:auto;" checked="true" name="bulk_checkbox['.$this->primaryKey.']" > '.CHtml::textField("bulk[$this->primaryKey]",$this->getFieldNameBackend("ar"),array("style"=>"width:90%; ","class"=>"form-controll inps" ));  }   else{   return 1 ;    }  }
	
	public function getBulkcanVisibleBulk(){   if(Yii::app()->request->getQuery('bulk_update','0')=='1'){  return true ;    }  else{ return false ;    }  }
	public function commonTemplate(){
		return $this->mTag()->getTag('common',Yii::app()->options->get('system.email_templates.common'));
	}
	public function arabic_characters_array(){
	return array(
	    '1'=>$this->mtag()->getTag('authorized','Authorized'),
	     '2'=>$this->mtag()->getTag('owner','Owner'),
	     '3'=>$this->mtag()->getTag('owner_representative','Owner representative'),
	    );
	}
}
