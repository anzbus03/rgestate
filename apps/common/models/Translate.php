<?php

/**
 * This is the model class for table "{{translate}}".
 *
 * The followings are the available columns in table '{{translate}}':
 * @property integer $translate_id
 * @property string $source_tag
 */
class Translate extends  ActiveRecord
{
    /**
     * @return string the associated database table namet
     */
    public $lan; 
    public $translation; 
    public $email_check; 
 
    public function tableName()
    {
        return '{{translate}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('source_tag,lan', 'required'),
            array('translation', 'required','on'=>'insert'),
            array('translate_id', 'numerical', 'integerOnly'=>true),
            array('source_tag', 'length', 'max'=>250),
            array('lan', 'safe' ),
            array('translation,email_check,group_id', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('translate_id, source_tag', 'safe', 'on'=>'search'),
        );
    }
    
     protected function afterFind()
    {  		  
		      if(Yii::app()->request->getQuery('disableEditer','0') !='1'){
				$this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
			  }
			  parent::afterFind();
	}
    
     protected function beforeSave()
    {  		  parent::beforeSave();
		      if(defined('DEPT')){
				 $this->group_id = DEPT; 
			  }
			  return true; 
			  
	}
    
    
    public function relationalModule(){
		return 
		 
			array('areaguide_id','group_id', 'package_id','linkid',  'region_id','master_id','user_id','bank_id','lang_id', 'm_c_id','a_c_id','am_id', 'a_unt', 'tag_id','advertisemen_id','external_id','article_category_id', 'common_id','city_id','sub_community_id', 'section_id','template_id' ,'article_id','category_id','sub_category_id','country_id','state_id','community_id','amenities_id','language_id' ,'ad_id' ,'popular_id' );
		 }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'translateRelations' => array(self::HAS_MANY, 'TranslateRelation', 'translate_id'),
            'translationDatas' => array(self::HAS_ONE, 'TranslationData', 'translation_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'translate_id' => 'Translate',
            'source_tag' => 'Source Tag',
        );
    }
     protected function afterConstruct()
    {
		if(Yii::app()->request->getQuery('disableEditer','0') !='1'){
			$this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
		}
        parent::afterConstruct();
    }
    
      public function _setDefaultEditorForContent(CEvent $event)
    {
        if (in_array($event->params['attribute'],array('translation' ))) {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, $event->params['attribute']);
            //$options['height'] = 600;
           // $options['toolbar']= 'Simple';
            
            $lan				 = Yii::app()->request->getQuery('lan','ar');
            $options['language'] = $lan;
            // $options['toolbar'] ='Full';
            if(in_array(Yii::app()->request->getQuery('relation'),array('article_id'))){
				$options['toolbar'] ='Full';
			}
            if(in_array(Yii::app()->request->getQuery('relation'),array('template_id','article_id','common_id'))){
            $options['fullPage'] = false;
            $options['allowedContent'] = true;
            $options['contentsCss'] = array();
			}
            if(in_array(Yii::app()->request->getQuery('lan','ar'),OptionCommon::rtlLanguages())){
				
			 	$options['contentsLangDirection']= 'rtl';
			}
			$options['fullPage'] = false;
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    public $no_parse;
    public function aftersave(){
		 
		 
		if(!empty($this->lan) and !empty($this->translation)){
		   $data = 	TranslationData::model()->findByAttributes(array('lang'=>$this->lan,'translation_id'=>$this->primaryKey));
		   if($data){
			    if($this->email_check== true ) {
					 $data->message =  Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$this->modelName]['translation']) ;
 
				}
				else if($this->no_parse== true ) {
					$data->message =   Yii::app()->params['POST'][$this->modelName]['translation']  ;
				}
				else{
			    $data->message =  Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$this->modelName]['translation']) ;
				}
			    $data->save();
		   }
		   else{
			   $data = new TranslationData();
			    $data->translation_id =  $this->primaryKey;
			    $data->lang 		  =  $this->lan;
			   //  $data->message 		  =   $this->translation;/*Yii::app()->params['POST'][$this->modelName]['translation'] ;*/
			    if($this->email_check== true ) {
					$parser = new EmailTemplateParser();
					$data->message = $parser->setContent(Yii::app()->params['POST'][$this->modelName]['translation'])->getContent();
 
				}
				else{
			    $data->message 		  =   Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$this->modelName]['translation']) ; 
				}
			    $data->save();
		   }
		}
		return true;
	}
	
	
    

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('translate_id',$this->translate_id);
        $criteria->compare('source_tag',$this->source_tag,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Translate the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
