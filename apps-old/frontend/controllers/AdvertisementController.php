<?php defined('MW_PATH') || exit('No direct script access allowed');
class AdvertisementController extends Controller
{
     
     public function Init(){
		 parent::Init();
		 $this->layout = 'blog';
		 $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
		 $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/ad_blog.css?q=2')));
		 
	 }
    public function actionDetails($slug)
    {
	 
		
		$model  = Article::model()->findByAttributes(array('slug'=>$slug));
		 
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	 
		    
		 
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		 
		   $this->setData(array(
                    'pageTitle'         => Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_title) ? $model->meta_title :  ucfirst($model->title) )), 
                    'pageMetaDescription'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_description) ? $model->meta_description :  ucfirst($model->title) )),
                    'pageMetaKeywords'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_keywords) ? $model->meta_keywords :  ucfirst($model->title) )),
                    
                ));
		$this->render( "details" ,compact('model','category','cat','latest','popular'));
		
	} 
    public function actionList($category=null)
    {
	 
		$model  = AdvCategory::model()->findByPk(array('category_id'=>$category));
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	    $this->setData(array(
                    'pageTitle'         => Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=>   ucfirst($model->title) )), 
                    'pageMetaDescription'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=>   ucfirst($model->title) )),
                    'pageMetaKeywords'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=>   ucfirst($model->title) )),
                    
                ));
		$this->render( "list_items" ,compact('model','category','cat','latest','popular'));
		
	} 
    public function actionContact()
    {
		
			$this->layout = 'blog';
		 $model = new AdvertisementContact;
		   $notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		
		$model->attributes = $attributes;
		if($model->save())
		{
			
			
			$emailTemplate =  CustomerEmailTemplate::model()->findByName("contact us");
			    if($emailTemplate)
			    {
					 $emailTemplate = $emailTemplate->content;
				}
				else
				{
					    $emailTemplate = $options->get('system.email_templates.common');
				}
				 
                
         
                $logo =  '<a href=""><img src="'.OptionCommon::logoUrl().'" style="width:70px"  alt=""></a>';
                $emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
                $emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
                $emailTemplate = str_replace('{phone}', $model->phone, $emailTemplate);
                $emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
                $emailTemplate = str_replace('{message}', nl2br($model->meassage), $emailTemplate);
                $emailTemplate = str_replace('{subject}',  $model->getType($model->type) , $emailTemplate);
                $emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'), $emailTemplate);
                
     
			   
			    $params = array(
				'to'            =>   Yii::app()->options->get('system.common.admin_email'),
				//'to'            =>  'vineethnjalil@gmail.com',
				'fromName'      =>   Yii::app()->options->get('system.common.site_name'),
				'subject'       =>	'addvertising Contact form submitted  '.Yii::app()->options->get('system.common.site_name') . '  ',
				'body'          =>   $emailTemplate,
				 'mailerPlugins' => array(
                'logger'    => true,
            ),
				       
				 );
				  $server = DeliveryServer::pickServer();  
				    if( $server){
						 if($server->sendEmail($params) ){;
							$notify->addSuccess(Yii::t('app', "Your message was successfully sent to the ". Yii::app()->options->get('system.common.site_name')." Support Team. One of our representative will contact you soon. "));
						 }
						 else{
							  $notify->addError(Yii::t('app', 'Error!! Temperay error while sending email . Please try again later.  '));
						 }
						$this->refresh() ;
					}
					else{
						  $notify->addError(Yii::t('app', 'Error!! Temperay error while sending email . Please try again later.  '));
						}
		}
		else
		{
		 
		   $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		}
	    }
	 
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     =>'Contact Us', 
            'pageMetaDescription'   => 'Contact Us', 
            'metaKeywords'   => 'Contact Us', 
        ));

        $this->render("contact_us" , compact('model'));
    }
    
}
