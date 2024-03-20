<?php

/**
 * This is the model class for table "{{email}}".
 *
 * The followings are the available columns in table '{{email}}':
 * @property string $id
 * @property string $subject
 * @property string $message
 * @property string $receipeints
 * @property string $cc
 * @property string $bcc
 * @property string $attachments
 * @property integer $created_by
 * @property string $date_added
 * @property string $last_update
 *
 * The followings are the available model relations:
 * @property User $createdBy
 */
class Email extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $members;
	public $image;
	public $email_template;
	public $receipeints;
	public $to;
	public $datepicker;
	public $timepicker;
	public $folder;
	public $sendAt;
	public $attach_crm_files;
	public $sent_on_utc;
	public  $modelRelatedValArray = array();
	const BULK_ACTION_DELETE='delete';
	const BULK_ACTION_RESTORE='restore';
	public function tableName()
	{
		return '{{email}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, message, receipeints,  sent_on ', 'required'),
			array('created_by', 'numerical', 'integerOnly'=>true),
			array('subject, cc, bcc, attachments', 'length', 'max'=>250),
			array('image', 'safe' ),
			array('status,attach_crm_files,sent_on,datepicker,timepicker,sendAt,sent_on_utc,type', 'safe' ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject,attach_crm_files, message, receipeints, cc, bcc, attachments, created_by, date_added, last_updated', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'ListingUsers', 'created_by'),
			'createdByAdmin' => array(self::BELONGS_TO, 'User', 'created_by_admin'),
		  
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'message' => 'Message',
			'receipeints' => 'Recipeints',
			'cc' => 'Cc',
			'bcc' => 'Bcc',
			'attachments' => 'Attachments',
			'created_by' => 'Created By',
			'date_added' => 'Date Added',
			'last_update' => 'Last Update',
			'image' => 'Attachments',
			'status' => 'Mail Status',
			'sent_on' => 'Send   At',
			'attach_crm_files' => 'Attach From Media Library',
		);
	}
	
	public function getCheckVisible(){
		 
		 
		if(Yii::app()->request->getQuery('draft','0')=='1'){
			return 0; 
		}
		return 1; 
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
	public function beforeSave(){
		 
		 
		 
	//	 $this->receipeints = serialize($this->receipeints);
			if(parent::beforeSave()) 
			{

				$this->attachments =  $this->image;
				$this->sent_on =   date('Y-m-d H:i:s',strtotime($this->sent_on)) ;
				if(!Yii::App()->isAppName('console')){
				if(Yii::app()->user->getId() and !empty(Yii::app()->user->getModel()->timezone)){
				$src_tz = new DateTimeZone(Yii::app()->user->getModel()->timezone);
				$dest_tz = new DateTimeZone('UTC');
				$dt = new DateTime($this->sent_on, $src_tz);
				$dt->setTimeZone($dest_tz);
				$this->sent_on = $dt->format('Y-m-d H:i:s'); 
				}
				 
				}
				if(!empty($this->sent_on_utc)){
					$this->sent_on = $this->sent_on_utc;
				}
				$options = Yii::app()->options ; 
				if(!Yii::App()->isAppName('console')){
				$site_name      = $this->mTag()->getTag('site_name',$options->get('system.common.site_name'));
				}else{
				    $site_name      =  $options->get('system.common.site_name') ;
				}
				$this->subject  =   Yii::t('trans',$this->subject,array('[SITE_NAME]' => $site_name));
              
                $this->message  = Yii::t('trans',$this->message,array(
                    '[SITE_NAME]' => $site_name,
                    '[PROJECT_NAME]' => $site_name,
                    '[SUBJECT]' =>  $this->subject ,
                    '[TAG_LINE]' => $options->get('system.common.site_tagline'),
                    '[REPORT_LINK]' => ASKAAN_PATH_BASE.'/contact/index',  
                    '[CALL_NUMBER]'=> $options->get('system.common.contact_phone'),
                    '[FAX_NUMBER]'=>$options->get('system.common.contact_fax'),
                    '[SUPPORT_MAIL]'=>$options->get('system.common.support_email'),
                     'HSITE_URLH' =>   ASKAAN_PATH_BASE.'/site/index',  
                    'HSUPPORT_MAILH' => $options->get('system.common.support_email'), 
                    'HREPORT_LINKH' => ASKAAN_PATH_BASE.'/contact/index',  
                ));
				return true;
			}
		 
	 }
	 public function getSend($body=true){
				 $attachments = array();
				 $subject = $this->subject;
				 $message = $this->message;
				 $options = Yii::app()->options;
                 $site_name    =  $options->get('system.common.site_name');
                 $site_tagline =  $options->get('system.common.site_tagline');
                 if($body){
                    $email_body ='<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>'.$site_name.' | '.$site_tagline.'</title><meta name="format-detection" content="telephone=no"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet"></head><body style="font-family: \'Open Sans\',sans-serif !important;color:#2b2d2e;font-weight:400;font-size:14px;background:#fff;">[REPLACER]</body></html>';
     
                    $message = Yii::t('trans', $email_body,array('[REPLACER]'=>$message));
                 }
				 $usersList = unserialize($this->receipeints) ; 
				 $server = DeliveryServer::pickServer(); 
				 $affected = 0 ;
				 if(!empty($usersList) and !empty($server)){
							
						foreach($usersList as $k2=>$v2){
									
									 if(isset($v2)){
										$params = array(
														'to'            =>  $v2,
														'from'          =>  Yii::app()->options->get('system.common.support_email'),
														'fromName'      =>  Yii::app()->options->get('system.common.site_name'),
														'subject'       =>	$subject   ,
														'body'          =>  $message  ,
										);
									 
										if($server->sendEmail($params)){
											
									  
									 		$affected++;
										
										}
										 
									}
									
							
						}
					 }
				  
					if ($affected) {
					Email::model()->updateByPk($this->primaryKey,array('status'=>'S'));
									
					}
				 //return true;
		 
	 }
	 
	   public  function getTitleLink(){
					$url = 'email/view' ;
			 	     //return    '<i class="fa fa-envelope-o"></i> ' ;
			 	     return CHtml::link(@$this->subject ,Yii::app()->createUrl($url ,array('id'=>$this->primaryKey)),array(   ) );
	 }
	 public  function getPreviewLink(){
					 $url = 'guest/email_preview' ;
					 $preview_link  = Leads::generateUrl(sprintf('guest/email_preview/id/%s',base64_encode($this->primaryKey.'_'.$this->subject)));
			 	     //return    '<i class="fa fa-envelope-o"></i> ' ;
			 	     return CHtml::link(@$this->subject ,$preview_link,array() );
	 }
	 public function cronEmails(){
	 
			$criteria = new CDbCriteria();
			$criteria->condition = ' t.sent_on  <= NOW() and t.isTrash="0"  and  t.status="Q"       ';
			$criteria->limit = 10;
			return self::model()->findAll($criteria);
	}
	 public function afterSave(){
	 
		     
		 $controller = Yii::app()->controller;
		 if($controller and $controller->id=='send_email' and !Yii::app()->request->isAjaxRequest){
		 
				if(in_array($this->status,array('S','Q'))){
					$controller->redirect(Yii::app()->createUrl('send_email/index'));
				}
				 
		 }
		 
	 }
	 
	 public function getFiolderName(){
		
		 if($this->status=='D'){
			 return 'My Draft';
		 }
		 else{
			 return 'My Mail Queue';
		 }
	 }
	 public function getStatusTitle(){
		
		 switch($this->status){
			  case 'S':
			  return '<span class="label label-success " >Sent</span>';
			  break;
			  case 'Q':
			  return '<span class="label label-danger " >On Queue</span>';
			  break;
			  case 'D':
			  return '<span class="label label-warning " >On Draft</span>';
			  break;
	  	 }
	 }
    public function UnlinkAttachmentImage($image){
		
		 $storagePath = Yii::getPathOfAlias('root.uploads.attachment');
		 $customerFiles = $storagePath.'/'.$image;
		 if (file_exists($customerFiles) && is_file($customerFiles)) {
			@unlink($customerFiles);
		 } 
	}
	 public function getGridId(){
		  $request = Yii::app()->request; 
		  if( $request->getQuery('type','0') != '0'){
					 return 'Email-'.$request->getQuery('type') ;
		  }
		  else  if( $request->getQuery('relatedField','') != ''){
					 return 'Email-'.$request->getQuery('relatedField') ;
		  }
		  else {
					return   self::model()->modelName.'-grid';
		 }
	 }
	public function search($returnCriteria = false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$request =  Yii::app()->request;
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		//$criteria->compare('receipeints',$this->receipeints,true);
		$criteria->compare('cc',$this->cc,true);
		$criteria->compare('bcc',$this->bcc,true);
		$criteria->compare('t.status',$this->status );
		$criteria->compare('attachments',$this->attachments,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		if(Yii::app()->controller->route == 'send_email/trash' ){
				$criteria->compare('isTrash',1);
		}
		else{
			if(Yii::app()->request->getQuery('draft','0')=='1'){
				$criteria->compare('t.status','D');
			}
			else{
				$criteria->addInCondition('t.status', array('S','Q'));
			}
			$criteria->compare('isTrash',0);
		}
		 
		 if($request->getQuery('counterVar')){ return    self::model()->count($criteria);    }
		  if($returnCriteria) { return $criteria; }
        $criteria->order ="t.id desc";
        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ) 
      
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Email the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	 
    protected function afterFind()
    {
		if(!Yii::app()->request->isAjaxRequest){
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
		}
        //$this->receipeints = unserialize($this->receipeints);
        $controller =Yii::app()->controller ;
		if($controller ){
		 $this->sent_on 		=   self::model()->dateTimeFormatter->formatLocalizedDateTime($this->sent_on)  ;
		}
				 
				
        parent::afterFind();
    }
    
     
      public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'message') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'message');
            
            $options['toolbar']= 'Simple';
             $options['fullPage'] = true;
            $options['allowedContent'] = true;
            $options['contentsCss'] = array();
            $options['height'] = 400;
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
      public function getBulkActionsList()
    {
				if(Yii::app()->controller->route=='send_email/trash'){
				return   array( self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete'),self::BULK_ACTION_RESTORE         => Yii::t('app', 'Restore'));
				}
				else{
				return   array( self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete'));
				}
    }  
	public function getNullUrl(){
		return 'javascript:void(0)';
	}
	  public function getReceipeintsTilte(){
	   return implode(',',unserialize($this->receipeints));
	 }
}
