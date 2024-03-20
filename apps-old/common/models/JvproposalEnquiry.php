<?php defined('MW_PATH') || exit('No direct script access allowed');

class JvproposalEnquiry extends ActiveRecord
{
    const STATUS_PUBLISHED = 'published';
    
    const STATUS_UNPUBLISHED = 'unpublished';
   public $_recaptcha ;
     public $agree;public $is_phone_validated ;
    public $slug;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{jvproposal_enquiry}}';
    }
  public function getPrimaryField(){
		 return 'jv_id';
	 }
    /**
     * @return array valjv_idation rules for model attributes.
     */
    public function rules()
    {
        $required = $this->mTag()->gettag('required','Required');
        $rules = array(
            array(['email', 'name', 'mobile', 'jv_business_cat','investment_amount_min','description','attachment1'], 'required',  'message'=>$required),
               array('agree', 'required',  'message'=>$this->mTag()->getTag('please_select','Please select.') ),
                 array('_recaptcha', 'validateRecaptcha' ,"on"=>'insert' ),
           array('email', 'email' ),
            array('is_phone_validated', 'validateHiddenInput' ),
            array(['investment_amount_min', 'investment_amount_max', 'description'], 'safe'),
           
            array(['blan'], 'safe'),
            array('status', 'in', 'range' => array(self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED)),
            array('page_title,meta_title,meta_keywords,meta_description',  'safe'),
            // The following rule is used by search().
            array('name, status,', 'safe', 'on' => 'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }
public function validateHiddenInput($attribute,$params)
	{
		
			if($this->is_phone_validated!='1'){
				$this->addError('phone',  'Please enter valid phone number');
		    }
			 
	}
   public function validateRecaptcha($attribute,$params){
		
		  if(!Yii::app()->request->isAjaxRequest){
 
	 
			$captcha= '';
			if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			}

			if(!$captcha){
				$this->addError($attribute, Yii::app()->tags->getTag('captcha_check','Please check the   captcha form.'));
			}
		 
				 
			$data = array(
			'secret' => Yii::app()->options->get('system.common.re_captcha_secret','6Ldsl2IaAAAAAO_jFA_V7ldxyoDUnZLeIvNZ8owG'),
			'response' => $captcha,
			'remoteip' => $_SERVER['REMOTE_ADDR']
			);

			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$res = curl_exec($verify);

			$captcha = json_decode($res);
			
		 
				if ($captcha->success) {
						 
				 }
				 else{
					  $this->addError($attribute,  'Spam suspect. Please try again.' );
				 }
				
 
		 
		  }
		   
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $mTag = $this->mTag();
        $labels = array(
            'jv_id'    => Yii::t('jvproposal_enquiry', 'Jvproposal'),
            'email'         => $mTag->getTag('email', 'Email'),
            'name'         => $mTag->getTag('full_name', 'Name'),
            'mobile'         => $mTag->getTag('phone', 'Phone'),
            'jv_business_cat'         => $mTag->getTag('jv_business_category', 'JV Business Category'),
            'description'         => $mTag->getTag('description', 'Description'),
            'blan'          => $mTag->getTag('language', 'Language'),
            'show_all'      => $mTag->getTag('countries', 'Countries'),
            'image'      => $mTag->getTag('image', 'Image'),
            'attachment1' =>$mTag->getTag('attachment','Attachment')
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
    }
    public function blanArray(){
        return array(
        '0' => 'All Language',
        'A' => 'Arabic Only',
        'E' => 'English Only',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvjv_ider instance which will filter
     * models according to data in model fields.
     * - Pass data provjv_ider to CGrjv_idView, CListView or any similar wjv_idget.
     *
     * @return CActiveDataProvjv_ider the data provjv_ider that can return the models
     * based on the search/filter conditions.
     */
     public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'A');

        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'jv_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Article the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function afterConstruct()
    {
		
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
		//$this->content = Yii::app()->ioFilter->purify($this->content);
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    
    
    public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->title;
        $slug = URLify::filter($string);
        $jv_id = (int)$this->jv_id;

        $criteria = new CDbCriteria();
        $criteria->addCondition('jv_id != :jv_id AND slug = :slug');
        $criteria->params = array(':jv_id' => $jv_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('jv_id != :jv_id AND slug = :slug');
            $criteria->params = array(':jv_id' => $jv_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }

        return $slug;
    }
    
	
	
     public function _setDefaultEditorForContent(CEvent $event)
    {

	    if ($event->params['attribute'] == 'specify') {

            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
			//echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'specify');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);

        }
    }
    
    public function getPermalink($absolute = false)
    {
        // return Yii::app()->apps->getAppUrl('frontend', 'partners/' . $this->slug, $absolute);
    }
    
    public function getStatusesArray()
    {
        return array(
            ''                          => Yii::t('app', 'Choose'),
            self::STATUS_PUBLISHED      => Yii::t('jvproposal_enquiry', 'Published'),
            self::STATUS_UNPUBLISHED    => Yii::t('jvproposal_enquiry', 'Unpublished'),
        );
    }
    
    public function getStatusText()
    {
        $statuses = $this->getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : $this->status;
    }
    
    public function attributeHelpTexts()
    {
        $texts = array();
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            'title' => Yii::t('jvproposal_enquiry', 'Name'),
            'slug'  => Yii::t('jvproposal_enquiry', 'name'),
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function getExcerpt($length = 200) 
    {
        return StringHelper::truncateLength($this->location, $length);
    }
    
   
	public function getShortDescription($length = 400)
    {
        return StringHelper::truncateLength($this->content, (int)$length);
    }
       public function findBySlugPublished($slug)
    {
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
		$criteria=new CDbCriteria;
		$criteria->condition = 't.slug=:slug and status=:status';
		$criteria->params[':slug']   = $slug  ;
		$criteria->params[':status']   =  Article::STATUS_PUBLISHED  ;
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Article_title_",t.jv_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.jv_id = t.jv_id  and  translationRelation.translate_jv_id = translate.translate_jv_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_jv_id=tdata.translation_jv_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Article_content_","",t.jv_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.jv_id = t.jv_id  and  translationRelation1.translate_jv_id = translate1.translate_jv_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_jv_id=tdata1.translation_jv_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'jv_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.jv_id';
		} 
		return $this->find($criteria);
	}
	public $listing_countries;
   public function valjv_idateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
	    public function getemailDetails(){
        $html ='<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">JV Proposal Details</th>
</thead>
 
<tbody> 
<td colspan="2">Contact Details</td></tr>
<tr class="even">
 
<td colspan="2">'. $this->name.'<br /><a href="tel:'.$this->mobile.'">'.$this->mobile.'</a><br /><a href="mailto:'.$this->email.'">'.$this->email.'</a><br /></td>
</tr>
<td colspan="2">Details</td></tr>
 
<tr class="even">
<td style="width:170px;">'.$this->getAttributeLabel('jv_business_cat').'</td>
<td>'.@$this->PropertyTitle.'</td>
</tr>
<tr class="odd">
<td style="width:70px;">Investment Amount Involved</td>
<td>'.@$this->BuitTitle.'</td>
</tr>
<tr class="odd">
<td style="width:70px;">JV Proposal Description</td>
<td>'.nl2br($this->description).' </td>
</tr>
 
</tbody>
 
</table> ';
return $html; 
    }
  public function afterSave(){
        parent::afterSave();
        
		    	$options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("ho626dkbszdd9");;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("pm540ya079112");;
			     $emailTemplate_common = $this->commonTemplate()   ;
			     if($emailTemplate)
			    {
					if(!empty($emailTemplate->receiver_list)){
						$list_receivers = array_filter(explode(',',$emailTemplate->receiver_list));
					}
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('[DETAILS]',$this->emailDetails, $emailTemplate); 		 
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					if(!empty($list_receivers)){
						$receipeints = serialize($list_receivers);
					}
					else{
						$receipeints = serialize(array($options->get('system.common.admin_email')));
					}
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
					//$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message =   Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate));  
					$receipeints = serialize(array($this->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
    }
    
    public function getPartnerImages(){
        $html='';
        if(!empty($this->image)){
            $html .='<img src="'.Yii::App()->apps->getBaseUrl('uploads/partners/'.$this->image).'" style="wjv_idth:150px;background:#eee" />';
        }
        return $html;
    }
    public function getPropertyTitle(){
        $type = Category::model()->findbyPk($this->jv_business_cat);
        if($type){ return $type->category_name; }
    }
        public function getBuitTitle(){
            $html = ''; 
        if((!empty($this->investment_amount_min) and $this->investment_amount_min!='0.00') or (!empty($this->investment_amount_max) and $this->investment_amount_max!='0.00') ){
            if((!empty($this->investment_amount_min) and $this->investment_amount_min!='0.00')){
                $html = Yii::t('app',$this->investment_amount_min,array('.00'=>'')).' '. ' (min) '; 
            }
            if((!empty(investment_amount_max) and $this->investment_amount_max!='0.00')){
                if(!empty($html)){ $html .= ' and '; }
                $html .= Yii::t('app',$this->investment_amount_max,array('.00'=>'')).' '.' (max) '; 
            }
        }
        return $html ; 
    }
}
