<?php

/**
 * This is the model class for table "{{bank}}".
 *
 * The followings are the available columns in table '{{bank}}':
 * @property integer $bank_id
 * @property string $bank_name
 * @property integer $interest_rate
 * @property integer $down_payment
 * @property string $logo
 * @property string $terms
 * @property string $date_added
 * @property string $last_updated
 */
class ValuationCompany extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{bank}}';
    }
public function getPrimaryField(){
		 return 'bank_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bank_name', 'required'),
            array('interest_rate, down_payment', 'numerical', 'integerOnly'=>true),
            array('bank_name, logo', 'length', 'max'=>250),
            array('terms,status', 'safe'),
                array('listing_countries,f_type,slug,priority','safe'),
            array('show_all','validateCountries'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('bank_id, bank_name, interest_rate, down_payment, logo, terms, date_added, last_updated', 'safe', 'on'=>'search'),
        );
    }
 public $listing_countries;
   public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
	protected function afterConstruct()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
         'listCountries' => array(self::HAS_MANY, 'BankCountries', 'bank_id'),
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		$this->f_type='Vc';
		$this->slug = $this->generateSlug();
		$cacheKey =  Yii::app()->options->get('system.common.hom_insurance_cache','');
		Yii::app()->cache->delete($cacheKey);
		Yii::app()->options->set('system.common.hom_insurance_cache','bank'.date('YmdHis'));
		return true;
	}
public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->bank_name;
        $slug = URLify::filter($string);
        $category_id = (int)$this->bank_id;
        
        $criteria = new CDbCriteria();
        $criteria->addCondition('bank_id != :id AND slug = :slug');
        $criteria->params = array(':id' => $category_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\-\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('bank_id != :id AND slug = :slug');
            $criteria->params = array(':id' => $category_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }
        
        return $slug;
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'bank_id' => 'Bank',
            'bank_name' => 'Valuation Name',
            'interest_rate' => 'Interest Rate',
            'down_payment' => 'Down Payment',
            'logo' => 'Logo',
            'terms' => 'Terms',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
        );
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

        $criteria->compare('bank_id',$this->bank_id);
        $criteria->compare('bank_name',$this->bank_name,true);
        $criteria->compare('interest_rate',$this->interest_rate);
        $criteria->compare('down_payment',$this->down_payment);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('terms',$this->terms,true);
        $criteria->compare('is_trash','0');
        $criteria->compare('f_type','Vc');
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

         return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'bank_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public function afterSave(){
		parent::aftersave();
		if(!$this->isNewRecord){
					BankCountries::model()->deleteAllByAttributes(array('bank_id'=>$this->primaryKey));
		}
		 
		$cn_model = new BankCountries();
				if(!empty($this->listing_countries) and $this->show_all== '1'){
					foreach($this->listing_countries as $country){
						$cn_model_new = clone $cn_model;
						$cn_model_new->bank_id    = $this->primaryKey;
						$cn_model_new->country_id    = $country;
						$cn_model_new->save();
						
					}
				}
		return true; 
	}
public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bank the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function getFilePath($file){
         if (strpos(	$file , '/20') !== false) {
					
					 
					    return Yii::app()->apps->getBaseUrl('uploads/files/'.$file );
					}
		return  ENABLED_AWS_PATH .$file ;
	}
	public function  ListData()
    {	
	 
		    
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.is_trash='0' and status='A'  and f_type= 'Vc' ";
		  		    
		 $criteria->distinct ="t.bank_id";
		 $criteria->select ="t.*";
		 $criteria->order = '-t.priority desc,bank_name asc ';
		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("ValuationCompany_bank_name_",t.bank_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.bank_id = t.bank_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("ValuationCompany_terms_","",t.bank_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.bank_id = t.bank_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.bank_name END	 as  bank_name , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.terms END	 as  terms ';
				$criteria->group = 't.bank_id';
		} 
		 
		 if(defined('COUNTRY_ID')){
		 
			  	$criteria->join  .= ' left join {{bank_countries}} secCoutry on  secCoutry.country_id =  :country  and  secCoutry.bank_id = t.bank_id';
				$criteria->params[':country']   =COUNTRY_ID;
				$criteria->condition .= " and  ( t.show_all = '0' OR secCoutry.country_id is  not    null )";
		  }
		// $criteria->order="category_name";
		$result =  $this->findAll($criteria);
				 
		return $result; 
		  
	}
	public function  findByBankId($id)
    {	
	 
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.is_trash='0' and status='A' and f_type='Vc' ";
		  		    
		 $criteria->distinct ="t.bank_id";
		 $criteria->select ="t.*";
		 $criteria->order = 'bank_name asc ';
		 
		 
		 if(defined('COUNTRY_ID')){
		 
			  	$criteria->join  .= ' left join {{bank_countries}} secCoutry on  secCoutry.country_id =  :country  and  secCoutry.bank_id = t.bank_id';
				$criteria->params[':country']   =COUNTRY_ID;
				$criteria->condition .= " and  ( t.show_all = '0' OR secCoutry.country_id is  not    null )";
		  }
		  $criteria->condition .= ' and t.bank_id = :bank_id '; 
		  $criteria->params[':bank_id'] = $id; 
		// $criteria->order="category_name";
		return $this->find($criteria);
		  
	}
	  public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'terms') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'terms');
            $options['height'] = 100;
            $options['toolbar']= 'Simple';
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
}
