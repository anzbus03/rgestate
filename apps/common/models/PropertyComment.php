<?php

/**
 * This is the model class for table "{{property_comment}}".
 *
 * The followings are the available columns in table '{{property_comment}}':
 * @property string $comment_id
 * @property string $replay_id
 * @property integer $user_id
 * @property string $comment
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property PropertyComment $replay
 * @property PropertyComment[] $propertyComments
 * @property ListingUsers $user
 */
class PropertyComment extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{property_comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id,ad_id, comment', 'required'),
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('replay_id', 'length', 'max'=>20),
            array('comment', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('comment_id, replay_id, user_id, comment, date_added, last_updated', 'safe', 'on'=>'search'),
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
            'replay' => array(self::BELONGS_TO, 'PropertyComment', 'replay_id'),
            'propertyComments' => array(self::HAS_MANY, 'PropertyComment', 'replay_id'),
            'user' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
        );
    }
public $first_name;
public $last_name;
public $image;
public $total_count;
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'comment_id' => 'Comment',
            'replay_id' => 'Comment Id for Replay',
            'user_id' => 'User Id',
            'ad_id' => 'Ad Id',
            'comment' => 'User Comment',
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

        $criteria->compare('comment_id',$this->comment_id,true);
        $criteria->compare('replay_id',$this->replay_id,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PropertyComment the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
