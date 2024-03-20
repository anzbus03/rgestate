<?php

/**
 * This is the model class for table "{{lonsdale}}".
 *
 * The followings are the available columns in table '{{lonsdale}}':
 * @property integer $id
 * @property string $f_name
 * @property string $address
 * @property string $cr_no
 * @property string $s_date
 * @property string $e_date
 * @property string $t_o_b
 * @property string $fax
 * @property string $tel
 * @property string $location
 * @property string $d_of_p
 * @property string $s_i
 * @property string $plant
 * @property string $stock_material
 * @property string $rent_pay_month
 * @property string $rent_value
 * @property string $other_property
 * @property string $other_property_valu
 * @property string $total_sr
 * @property string $insured_represent
 * @property string $n_rplaced
 * @property string $d_v
 * @property string $i_w
 * @property string $e_w
 * @property string $storeys
 * @property string $roof
 * @property string $basement
 * @property string $floors
 * @property string $p_e_b
 * @property string $b_if
 * @property string $fighting
 * @property string $distance_fire
 * @property string $unoccupied
 * @property string $sole_occupation
 * @property string $any_loss
 * @property string $policies
 * @property string $proposal
 */
class Lonsdale extends  InsuranceForm1
{
    /**
     * @return string the associated database table f_name
     */
    public function tablef_name()
    {
        return '{{insurance_form}}';
    }
    public $_recaptcha;
    public $agree;
    public $fax_false;
    public $phone_false;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('f_name, address,agree, cr_no, , t_o_b,  location, d_of_p, s_i, plant, stock_material,phone_false, rent_pay_month, rent_value, other_property,  total_sr, insured_represent, n_rplaced, d_v, i_w, e_w, storeys, roof, basement, floors, p_e_b, b_if, fighting, distance_fire, unoccupied, sole_occupation, any_loss, policies, proposal', 'required',   'message'=>$this->mTag()->getTag('required','Required')),
            array('s_date', 'validatePeriod' ),
            array('f_name, t_o_b, location, d_of_p, sole_occupation, any_loss', 'length', 'max'=>150),
            array('address, fighting, distance_fire, policies, proposal', 'length', 'max'=>250),
            array('cr_no, stock_material, p_e_b', 'length', 'max'=>50),
            array('fax', 'length', 'max'=>20),
            array('phone', 'length', 'max'=>15),
            array('s_i, plant, rent_value,  total_sr, n_rplaced, d_v, b_if', 'length', 'max'=>10),
            array('rent_pay_month, insured_represent', 'length', 'max'=>1),
            array('other_property', 'length', 'max'=>100), array('e_date,bank_id', 'safe' ),
            array('i_w, e_w, storeys, roof, basement, floors, unoccupied', 'length', 'max'=>5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, f_name, address, cr_no, s_date, e_date, t_o_b, fax, phone, location, d_of_p, s_i, plant, stock_material, rent_pay_month, rent_value, other_property,  total_sr, insured_represent, n_rplaced, d_v, i_w, e_w, storeys, roof, basement, floors, p_e_b, b_if, fighting, distance_fire, unoccupied, sole_occupation, any_loss, policies, proposal', 'safe', 'on'=>'search'),
        );
    }
    public function validatePeriod($attribute,$params){
      
			if(empty($this->s_date) or empty($this->e_date)) {  
				$this->addError('s_date',  'Please select from and to date'.$this->s_date.$this->e_date);
		 
			}
			 
		 
	}
	
	
public function beforeSave(){
		
	   if(parent::beforeSave()) 
	   {
             
             if($this->isNewRecord){
				$this->user_id = (int) Yii::app()->user->getId();
				if(empty($this->user_id)){ $this->user_id= null; }
			}
              if($this->isNewRecord){
              if(defined('COUNTRY_ID')){
				$this->country_id      =  COUNTRY_ID;
			  }
            }
			if(!empty($this->s_date)) {
				$this->s_date = date('Y-m-d',strtotime($this->s_date));
			 }
			if(!empty($this->e_date)) {
				$this->e_date = date('Y-m-d',strtotime($this->e_date));
			 }
			  $this->phone = (!empty($this->phone)) ? $this->phone : $this->phone_false;
			 $this->fax = (!empty($this->fax)) ? $this->fax : $this->fax_false;
			
			 if(empty($this->reference)) {
				$this->reference = $this->generateUid();
			 }
			 return true;
	   }
 return true;
	 
	}
    /**
     * @return array relational rules.
     */
    
    /**
     * @return array customized attribute labels (f_name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'f_name' => $this->mTag()->getTag('full_name_of_proposer(s)','Full name of Proposer(s)'),
            'address' => $this->mTag()->getTag('address1','Address'),
            'cr_no' => $this->mTag()->getTag('c.r._no.','C.R. No.'),
            's_date' => $this->mTag()->getTag('from','From'),
            'e_date' => $this->mTag()->getTag('to','To'),
            't_o_b' => $this->mTag()->getTag('trade_or_business','Trade or Business'),
            'fax_false' => $this->mTag()->getTag('fax','Fax No.'),
            'fax' => $this->mTag()->getTag('fax','Fax No.'),
            'phone' => $this->mTag()->getTag('tel._no','Tel. No'),
            'phone_false' => $this->mTag()->getTag('tel._no','Tel. No'),
            'location' => $this->mTag()->getTag('location_of_property','Location of Property'),
            'd_of_p' => $this->mTag()->getTag('description_of_premises_(shop,','Description of Premises (Shop, Factory, Office ... etc'),
            's_i' => $this->mTag()->getTag('sum(s)__to_be_insured__:__(sr)','Sum(s)  to Be Insured  :  (SR) <br />Buildings including Landlords Fixtures & Fittings'),
            'plant' => Yii::t('app',$this->mTag()->getTag('plant,_machinery,_plant,_ma&_f','Plant, Machinery, Fixtures & Fittings (not Landlords)  and other contents  {s}(excluding  stock){e}'),array('{s}'=>'<small>','{e}'=>'</small>')),
            'stock_material' => $this->mTag()->getTag('stock_and_material_in_trade','Stock and Material in Trade'),
            'rent_pay_month' => $this->mTag()->getTag('no._of_months','No. of Months'),
            'rent_value' => $this->mTag()->getTag('payable/receivable/rental_valu','Payable/Receivable/Rental Value'),
            'other_property' => $this->mTag()->getTag('other_property','Other Property <small>(as follows)</small>'),
            
            'total_sr' => $this->mTag()->getTag('total_(sr)','Total (SR)'),
            'insured_represent' => $this->mTag()->getTag('does_the_sum_insured_represent','Does the Sum Insured Represent the Full'),
            'n_rplaced' => $this->mTag()->getTag('new_replacement_value','New Replacement Value'),
            'd_v' => $this->mTag()->getTag('depreciated_value','Depreciated Value'),
            'i_w' => $this->mTag()->getTag('internal_walls','Internal Walls'),
            'e_w' => $this->mTag()->getTag('external_walls','External Walls'),
            'storeys' => $this->mTag()->getTag('no._of_storeys','No. of Storeys'),
            'roof' => $this->mTag()->getTag('roof','Roof'),
            'basement' =>$this->mTag()->getTag('is_there_a_basement?','Is there a Basement?'),
            'floors' =>$this->mTag()->getTag('floors','Floors'),
            'p_e_b' => $this->mTag()->getTag('premises_excluding_basement','Premises Excluding Basement'),
            'b_if' => $this->mTag()->getTag('basement_(if_any)_and_of_what','Basement (If any) and of what Value'),
            'fighting' => $this->mTag()->getTag('give_the_number,_type_and_capa','Give the number, type and capacity of the fire fighting appliances on your premises'),
            'distance_fire' => $this->mTag()->getTag('what_is_the_distance_between_t','What is the distance between the premises and the nearest Fire Department or Civil Defence Unit?'),
            'unoccupied' =>$this->mTag()->getTag('will_your_premises_be_unocc','Will your premises be unoccupied for more than 30 consecutive days in any one year ?'),
            'sole_occupation' => $this->mTag()->getTag('if_the_premises_are_not_in_you','If the premises are not in your sole occupation state how  otherwise occupied ?'),
            'any_loss' =>$this->mTag()->getTag('have_you_ever_sustained_any_lo','Have you ever sustained any loss by Fire or any of the above f_named perils ? If so, give details.'),
            'policies' => $this->mTag()->getTag('give_particulars_of_any_polici','Give particulars of any policies in force with any other company covering any of the Property to be insured.'),
            'proposal' => $this->mTag()->getTag('have_you_ever_had_a_proposal_f','Have you ever had a proposal for insurance of any kind or       renewal of policy declined, or policy cancelled ? If so, give particulars'),
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
        $criteria->compare('f_name',$this->f_name,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('cr_no',$this->cr_no,true);
        $criteria->compare('s_date',$this->s_date,true);
        $criteria->compare('e_date',$this->e_date,true);
        $criteria->compare('t_o_b',$this->t_o_b,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('location',$this->location,true);
        $criteria->compare('d_of_p',$this->d_of_p,true);
        $criteria->compare('s_i',$this->s_i,true);
        $criteria->compare('plant',$this->plant,true);
        $criteria->compare('stock_material',$this->stock_material,true);
        $criteria->compare('rent_pay_month',$this->rent_pay_month,true);
        $criteria->compare('rent_value',$this->rent_value,true);
        $criteria->compare('other_property',$this->other_property,true);
        //$criteria->compare('other_property_valu',$this->other_property_valu,true);
        $criteria->compare('total_sr',$this->total_sr,true);
        $criteria->compare('insured_represent',$this->insured_represent,true);
        $criteria->compare('n_rplaced',$this->n_rplaced,true);
        $criteria->compare('d_v',$this->d_v,true);
        $criteria->compare('i_w',$this->i_w,true);
        $criteria->compare('e_w',$this->e_w,true);
        $criteria->compare('storeys',$this->storeys,true);
        $criteria->compare('roof',$this->roof,true);
        $criteria->compare('basement',$this->basement,true);
        $criteria->compare('floors',$this->floors,true);
        $criteria->compare('p_e_b',$this->p_e_b,true);
        $criteria->compare('b_if',$this->b_if,true);
        $criteria->compare('fighting',$this->fighting,true);
        $criteria->compare('distance_fire',$this->distance_fire,true);
        $criteria->compare('unoccupied',$this->unoccupied,true);
        $criteria->compare('sole_occupation',$this->sole_occupation,true);
        $criteria->compare('any_loss',$this->any_loss,true);
        $criteria->compare('policies',$this->policies,true);
        $criteria->compare('proposal',$this->proposal,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $classf_name active record class f_name.
     * @return Lonsdale the static model class
     */
    public static function model($classf_name=__CLASS__)
    {
        return parent::model($classf_name);
    }
    public function afterSave(){
		  $options = Yii::app()->options ; 
		  $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("zj207n1pom83b");
		  $emailTemplate_common = $this->commonTemplate()   ;
	      $emailTemplate_admin =  CustomerEmailTemplate::model()->getTemplateByUid("aq0842w0c7416");
		  
		  if($emailTemplate_customer){
		      /*
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->f_name, $emailTemplate);
					$emailTemplate =   Yii::t('app',$emailTemplate_common, array( '[CONTENT]'=>$emailTemplate)); 
					    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($this->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->getSend(false);;
					*/
				}
		  if($emailTemplate_admin){
					$subject		= $emailTemplate_admin->subject;
					$emailTemplate = $emailTemplate_admin->content;	
					 if($this->scenario=='ask_insurance'){
						 
							$emailTemplate =  Yii::t('app', $emailTemplate,
								array(
								 '{reference}' => $this->reference,
								 '{property}' => $this->PropertyDetails,
								 '{company_name}' => $this->bank->bank_name,
								'{name}' => $this->f_name,
								'{email}' => '',
								'{phone}' => $this->phone,
								'{backendurl}' => $this->BackendUrl,
								)
								);
								
						}else{
							$emailTemplate =  Yii::t('app', $emailTemplate,
								array(
								'{reference}' => $this->reference,
								'{address}' => $this->AddressDetails,
								'{o_status}' => '',
								'{property_type}' =>'',
								'{c_required}' => '',
								'{c_content}' =>'',
								'{v_p_belongings}' => '',
								'{company_name}' =>$this->bank->bank_name,
								'{name}' => $this->f_name,
								'{email}' => '',
								'{phone}' => $this->phone,
								'{backendurl}' => $this->BackendUrl,
								)
							);
						}
					    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($options->get('system.common.admin_email')));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->getSend(false);;
				}
			 
	 return true;
       
     
	}
}
