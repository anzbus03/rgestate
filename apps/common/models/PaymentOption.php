<?php

/**
 * This is the model class for table "mw_payment_option".
 *
 * The followings are the available columns in table 'mw_payment_option':
 * @property integer $id
 * @property string $name
 * @property string $isTrash
 * @property string $status
 * @property string $added_date
 * @property string $show_on_order_form
 * @property string $display_name
 * @property string $force_one_time_payments
 * @property string $paypal_email
 * @property string $force_subscriptions
 * @property string $require_shipping_address
 * @property string $client_addres_matching
 * @property string $api_username
 * @property string $api_password
 * @property string $api_signature
 * @property string $bank_transfer_instructions
 */
class PaymentOption extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_payment_option';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
			//    array('name, isTrash, status, added_date, show_on_order_form, display_name, force_one_time_payments, paypal_email, force_subscriptions, require_shipping_address, client_addres_matching, api_username, api_password, api_signature, bank_transfer_instructions', 'required'),
			array('name', 'required'),
            array('name,   paypal_email, api_username, api_password, api_signature', 'length', 'max'=>250),
            array('isTrash, status, show_on_order_form, force_one_time_payments, force_subscriptions, require_shipping_address, client_addres_matching', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('bank_transfer_instructions','safe'),
            array('id, name, isTrash, status, added_date, show_on_order_form,   force_one_time_payments, paypal_email, force_subscriptions, require_shipping_address, client_addres_matching, api_username, api_password, api_signature, bank_transfer_instructions', 'safe', 'on'=>'search'),
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
            'name' => 'Display Name',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'show_on_order_form' => 'Show On Order Form',
          
            'force_one_time_payments' => 'Force One Time Payments',
            'paypal_email' => 'Paypal Email',
            'force_subscriptions' => 'Force Subscriptions',
            'require_shipping_address' => 'Require Shipping Address',
            'client_addres_matching' => 'Client Addres Matching',
            'api_username' => 'Api Username',
            'api_password' => 'Api Password',
            'api_signature' => 'Api Signature',
            'bank_transfer_instructions' => 'Bank Transfer Instructions',
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('isTrash','0',true);
        $criteria->compare('status','A',true);
        $criteria->compare('added_date',$this->added_date,true);
        $criteria->compare('show_on_order_form',$this->show_on_order_form,true);
        
        $criteria->compare('force_one_time_payments',$this->force_one_time_payments,true);
        $criteria->compare('paypal_email',$this->paypal_email,true);
        $criteria->compare('force_subscriptions',$this->force_subscriptions,true);
        $criteria->compare('require_shipping_address',$this->require_shipping_address,true);
        $criteria->compare('client_addres_matching',$this->client_addres_matching,true);
        $criteria->compare('api_username',$this->api_username,true);
        $criteria->compare('api_password',$this->api_password,true);
        $criteria->compare('api_signature',$this->api_signature,true);
        $criteria->compare('bank_transfer_instructions',$this->bank_transfer_instructions,true);

          return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymentOption the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
