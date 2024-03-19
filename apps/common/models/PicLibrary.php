<?php

/**
 * This is the model class for table "{{pic_library}}".
 *
 * The followings are the available columns in table '{{pic_library}}':
 * @property integer $id
 * @property string $lib_typc
 * @property string $alphabet
 * @property string $cover_image
 * @property string $profile_image
 * @property string $date_added
 * @property string $last_updated
 */
class PicLibrary extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{pic_library}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('alphabet', 'required'),
            array('alphabet', 'unique'),
            array('lib_typc, alphabet', 'length', 'max'=>1),
            array('cover_image, profile_image', 'length', 'max'=>150),
              array('cover_image,profile_image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true,'on'=>array('update')),
          
            array('date_added, last_updated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, lib_typc, alphabet, cover_image, profile_image, date_added, last_updated', 'safe', 'on'=>'search'),
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		 $this->lib_typc = 'D';
		 return true;
	}
    public function alphabetArray(){
		return array(
		'1'=>'1',
		'2'=>'2',
		'3'=>'3',
		'4'=>'4',
		'5'=>'5',
		'6'=>'6',
		'7'=>'7',
		'8'=>'8',
		'9'=>'9',
		'0'=>'0',
		'A'=>'A',
		'B'=>'B',
		'C'=>'C',
		'D'=>'D',
		'E'=>'E',
		'F'=>'F',
		'G'=>'G',
		'H'=>'H',
		'I'=>'I',
		'J'=>'J',
		'K'=>'K',
		'L'=>'L',
		'M'=>'M',
		'N'=>'N',
		'O'=>'O',
		'P'=>'P',
		'Q'=>'Q',
		'R'=>'R',
		'S'=>'S',
		'T'=>'T',
		'U'=>'U',
		'V'=>'V',
		'W'=>'W',
		'X'=>'X',
		'Y'=>'Y',
		'Z'=>'Z',
		
		);
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'lib_typc' => 'Lib Typc',
            'alphabet' => 'Letter',
            'cover_image' => 'Cover Image',
            'profile_image' => 'Profile Image',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('lib_typc',$this->lib_typc,true);
        $criteria->compare('alphabet',$this->alphabet,true);
        $criteria->compare('cover_image',$this->cover_image,true);
        $criteria->compare('profile_image',$this->profile_image,true);
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
                    'alphabet' => CSort::SORT_ASC,
                ),
            ),
        ));
    }
    public function getProfileImage(){
      return '<img src="'.Yii::App()->apps->getBaseUrl('uploads/avatar/'.$this->profile_image.'?q=3').'" style="width:100px" />'; 
    }
 public function getCoverImage(){
      return '<img src="'.Yii::App()->apps->getBaseUrl('uploads/avatar/'.$this->cover_image.'?q=3').'" style="width:100px" />'; 
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PicLibrary the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
