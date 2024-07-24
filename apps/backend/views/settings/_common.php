<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('settings', 'Common settings')?></h3>
    </div>
    <div class="box-body">
        <?php 
        /**
         * This hook gives a chance to prepend content before the active form fields.
         * Please note that from inside the action callback you can access all the controller view variables 
         * via {@CAttributeCollection $collection->controller->data}
         * @since 1.3.3.1
         */
        $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'site_name');?><?php echo $commonModel->createTransLink('site_name');?>
            <?php echo $form->textField($commonModel, 'site_name', $commonModel->getHtmlOptions('site_name')); ?>
            <?php echo $form->error($commonModel, 'site_name');?>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'copywrite_name');?><?php echo $commonModel->createTransLink('copywrite_name');?>
            <?php echo $form->textField($commonModel, 'copywrite_name', $commonModel->getHtmlOptions('copywrite_name')); ?>
            <?php echo $form->error($commonModel, 'copywrite_name');?>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'site_tagline');?>
            <?php echo $form->textField($commonModel, 'site_tagline', $commonModel->getHtmlOptions('site_tagline')); ?>
            <?php echo $form->error($commonModel, 'site_tagline');?>
        </div>    
        <?php /*
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'site_description');?>
            <?php echo $form->textField($commonModel, 'site_description', $commonModel->getHtmlOptions('site_description')); ?>
            <?php echo $form->error($commonModel, 'site_description');?>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'site_keywords');?>
            <?php echo $form->textField($commonModel, 'site_keywords', $commonModel->getHtmlOptions('site_keywords')); ?>
            <?php echo $form->error($commonModel, 'site_keywords');?>
        </div>  
        * */
        ?>
         <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'defalut_currency');?>
            <?php echo $form->textField($commonModel, 'defalut_currency', $commonModel->getHtmlOptions('defalut_currency')); ?>
            <?php echo $form->error($commonModel, 'defalut_currency');?>
        </div>   
         <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'usd_val');?>
            <?php echo $form->textField($commonModel, 'usd_val', $commonModel->getHtmlOptions('usd_val')); ?>
            <?php echo $form->error($commonModel, 'usd_val');?>
        </div>   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'support_phone');?>
            <?php echo $form->textField($commonModel, 'support_phone', $commonModel->getHtmlOptions('support_phone')); ?>
            <?php echo $form->error($commonModel, 'support_phone');?>
        </div>   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'support_email');?>
            <?php echo $form->textField($commonModel, 'support_email', $commonModel->getHtmlOptions('support_email')); ?>
            <?php echo $form->error($commonModel, 'support_email');?>
        </div>   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'admin_email');?>
            <?php echo $form->textField($commonModel, 'admin_email', $commonModel->getHtmlOptions('admin_email')); ?>
            <?php echo $form->error($commonModel, 'admin_email');?>
        </div>   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'contact_phone');?>
            <?php echo $form->textField($commonModel, 'contact_phone', $commonModel->getHtmlOptions('contact_phone')); ?>
            <?php echo $form->error($commonModel, 'contact_phone');?>
        </div>   
        
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'contact_email');?>
            <?php echo $form->textField($commonModel, 'contact_email', $commonModel->getHtmlOptions('contact_email')); ?>
            <?php echo $form->error($commonModel, 'contact_email');?>
        </div>   
        
         <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'contact_fax');?>
            <?php echo $form->textField($commonModel, 'contact_fax', $commonModel->getHtmlOptions('contact_fax')); ?>
            <?php echo $form->error($commonModel, 'contact_fax');?>
        </div>   
          <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'contact_phone_hide_with');?>
            <?php echo $form->textField($commonModel, 'contact_phone_hide_with', $commonModel->getHtmlOptions('contact_phone_hide_with')); ?>
            <?php echo $form->error($commonModel, 'contact_phone_hide_with');?>
        </div>   
         <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'contact_address');?><?php echo $commonModel->createTransLink('contact_address');?> 
            <?php echo $form->textArea($commonModel, 'contact_address', $commonModel->getHtmlOptions('contact_address')); ?>
            <?php echo $form->error($commonModel, 'contact_address');?>
        </div>   
         <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'office_timing');?><?php echo $commonModel->createTransLink('office_timing');?> 
            <?php echo $form->textArea($commonModel, 'office_timing', $commonModel->getHtmlOptions('office_timing')); ?>
            <?php echo $form->error($commonModel, 'office_timing');?>
        </div>  
         <div class="clearfix"><!-- --></div>
         <?php /* 
        <hr />
        <h4><?php echo Yii::t('settings', 'Payment Settings')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'assistance_nmber');?>
            <?php echo $form->textField($commonModel, 'assistance_nmber', $commonModel->getHtmlOptions('assistance_nmber')); ?>
            <?php echo $form->error($commonModel, 'assistance_nmber');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'easy_paisa_account');?>
            <?php echo $form->textArea($commonModel, 'easy_paisa_account', $commonModel->getHtmlOptions('easy_paisa_account')); ?>
            <?php echo $form->error($commonModel, 'easy_paisa_account');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'bank_transfer_account');?>
            <?php echo $form->textArea($commonModel, 'bank_transfer_account', $commonModel->getHtmlOptions('bank_transfer_account')); ?>
            <?php echo $form->error($commonModel, 'bank_transfer_account');?>
        </div>    
          <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'payment_policy');?>
            <?php echo $form->textArea($commonModel, 'payment_policy', $commonModel->getHtmlOptions('payment_policy')); ?>
            <?php echo $form->error($commonModel, 'payment_policy');?>
        </div>   
       <div class="clearfix"><!-- --></div>
       */
       ?>
        <hr />
        <h4><?php echo Yii::t('settings', 'Cookie Settings')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'cookie_text');?>
            <?php echo $form->textField($commonModel, 'cookie_text', $commonModel->getHtmlOptions('cookie_text')); ?>
            <?php echo $form->error($commonModel, 'cookie_text');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'cookie_url_more');?>
            <?php echo $form->textField($commonModel, 'cookie_url_more', $commonModel->getHtmlOptions('cookie_url_more')); ?>
            <?php echo $form->error($commonModel, 'cookie_url_more');?>
        </div>    
          
         <?php /* 
       <div class="clearfix"><!-- --></div>
        <hr />
        <h4><?php echo Yii::t('settings', 'Listing Settings')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'poperties_for_one_page');?>
            <?php echo $form->textField($commonModel, 'poperties_for_one_page', $commonModel->getHtmlOptions('poperties_for_one_page')); ?>
            <?php echo $form->error($commonModel, 'poperties_for_one_page');?>
        </div>    
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'default_listing_country');?>
            <?php echo $form->dropDownList($commonModel, 'default_listing_country',CHtml::listData(Countries::model()->listingCountries(),'cords','country_name'), $commonModel->getHtmlOptions('default_listing_country',array('empty'=>'Select'))); ?>
            <?php echo $form->error($commonModel, 'default_listing_country');?>
        </div>   
			<div class="clearfix"><!-- --></div> 
			<hr />
			<h4><?php echo Yii::t('settings', 'Cache Settings')?></h4>
			<hr />
			<div class="clearfix"><!-- --></div> 
			<div class="form-group col-lg-4">
			<?php echo $form->labelEx($commonModel, 'enable_db_cache');?>
			<?php echo $form->dropDownList($commonModel, 'enable_db_cache' , $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('enable_db_cache')); ?>
			<?php echo $form->error($commonModel, 'enable_db_cache');?>
			</div>    
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'cache_id');?>
            <?php echo $form->textField($commonModel, 'cache_id'  , $commonModel->getHtmlOptions('cache_id')); ?>
            <?php echo $form->error($commonModel, 'cache_id');?>
        </div>    
        <div class="clearfix"><!-- --></div>
          *
          */ ?>
             <div class="clearfix"><!-- --></div>
        <hr />
        <h4><?php echo Yii::t('settings', 'Blog Settings')?></h4>
        <hr />
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'blog_link');?>
            <?php echo $form->textField($commonModel, 'blog_link', $commonModel->getHtmlOptions('blog_link')); ?>
            <?php echo $form->error($commonModel, 'blog_link');?>
        </div>    
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'home_blob_title');?>
            <?php echo $form->textField($commonModel, 'home_blob_title', $commonModel->getHtmlOptions('home_blob_title')); ?>
            <?php echo $form->error($commonModel, 'home_blob_title');?>
        </div>    
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'enable_blog_home');?>
             <?php echo $form->dropDownList($commonModel, 'enable_blog_home', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('enable_blog_home')); ?>
            <?php echo $form->error($commonModel, 'enable_blog_home');?>
        </div>    
        <div class="clearfix"><!-- --></div>
        <hr />
        <h4><?php echo Yii::t('settings', 'Social Pages')?></h4>
        <hr />
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'facebook_url');?>
            <?php echo $form->textField($commonModel, 'facebook_url', $commonModel->getHtmlOptions('facebook_url')); ?>
            <?php echo $form->error($commonModel, 'facebook_url');?>
        </div>    
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'twitter_url');?>
            <?php echo $form->textField($commonModel, 'twitter_url', $commonModel->getHtmlOptions('twitter_url')); ?>
            <?php echo $form->error($commonModel, 'twitter_url');?>
        </div>    
        <div class="form-group col-lg-4  ">
            <?php echo $form->labelEx($commonModel, 'pinterest_url');?>
            <?php echo $form->textField($commonModel, 'pinterest_url', $commonModel->getHtmlOptions('pinterest_url')); ?>
            <?php echo $form->error($commonModel, 'pinterest_url');?>
        </div>    
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'google_plus_url');?>
            <?php echo $form->textField($commonModel, 'google_plus_url', $commonModel->getHtmlOptions('google_plus_url')); ?>
            <?php echo $form->error($commonModel, 'google_plus_url');?>
        </div>    
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'linked_in');?>
            <?php echo $form->textField($commonModel, 'linked_in', $commonModel->getHtmlOptions('linked_in')); ?>
            <?php echo $form->error($commonModel, 'linked_in');?>
        </div>    
          
       <div class="clearfix"><!-- --></div>
          <div class="clearfix"><!-- --></div>
          <?php /*
        <hr />
        <h4><?php echo Yii::t('settings', 'OTP API  Settings')?></h4>
        <hr />
          <h4><?php echo Yii::t('settings', 'Twillio')?></h4>
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'twilio_sid');?>
            <?php echo $form->textField($commonModel, 'twilio_sid', $commonModel->getHtmlOptions('twilio_sid')); ?>
            <?php echo $form->error($commonModel, 'twilio_sid');?>
        </div>  
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'twilio_token');?>
            <?php echo $form->textField($commonModel, 'twilio_token', $commonModel->getHtmlOptions('twilio_token')); ?>
            <?php echo $form->error($commonModel, 'twilio_token');?>
        </div>  
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'twilio_phone');?>
            <?php echo $form->textField($commonModel, 'twilio_phone', $commonModel->getHtmlOptions('twilio_phone')); ?>
            <?php echo $form->error($commonModel, 'twilio_phone');?>
        </div> 
         <h4><?php echo Yii::t('settings', 'Sendpk.com')?></h4>
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'sendpk_username');?>
            <?php echo $form->textField($commonModel, 'sendpk_username', $commonModel->getHtmlOptions('sendpk_username')); ?>
            <?php echo $form->error($commonModel, 'sendpk_username');?>
        </div>  
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'sendpk_password');?>
            <?php echo $form->textField($commonModel, 'sendpk_password', $commonModel->getHtmlOptions('sendpk_password')); ?>
            <?php echo $form->error($commonModel, 'sendpk_password');?>
        </div>  
          <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'sendpk_sender');?>
            <?php echo $form->textField($commonModel, 'sendpk_sender', $commonModel->getHtmlOptions('sendpk_sender')); ?>
            <?php echo $form->error($commonModel, 'sendpk_sender');?>
        </div>  
       <div class="clearfix"><!-- --></div> 
           <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'disable_login_otp');?>
            <?php echo $form->dropDownList($commonModel, 'disable_login_otp', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('disable_login_otp')); ?>
            <?php echo $form->error($commonModel, 'disable_login_otp');?>
        </div>
      
         <div class="clearfix"><!-- --></div>
       
      <label for="OptionCommon_try" class="pull-left" style="line-height: 30px;margin-right: 10px;font-weight: 600;"> Maximum  </label><?php echo $form->textField($commonModel, 'try', $commonModel->getHtmlOptions('try',array('style'=>'max-width:50px;float:left;','placeholder'=>''))); ?>  <label for="OptionCommon_last_hours" class="pull-left" style="line-height: 30px;margin-right: 10px;margin-left: 10px;font-weight: 600;"> resend OTP  try  for  last  </label> <?php echo $form->textField($commonModel, 'last_hours', $commonModel->getHtmlOptions('last_hours',array('style'=>'max-width:50px;float:left;','placeholder'=>''))); ?> <label for="OptionCommon_last_hours" class="pull-left" style="line-height: 30px;margin-left: 10px;font-weight: 600;"> hours per customer </label>
       
                 <div class="clearfix"><!-- --></div>
                     <div class="clearfix"><!-- --></div>
                      */ ?> 
                     <?php /* 
        <hr />
        <h4><?php echo Yii::t('settings', 'Package Settings')?></h4>
        <hr />
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'default_ad_package');?>
            <?php echo $form->dropDownList($commonModel, 'default_ad_package', CHtml::listData(Package::model()->findFromCategoryID(1),'package_id','package_name'), $commonModel->getHtmlOptions('default_ad_package')); ?>
            <?php echo $form->error($commonModel, 'default_ad_package');?>
        </div> 
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'show_pack_link');?>
            <?php echo $form->dropDownList($commonModel, 'show_pack_link', array('1'=>'Yes','0'=>'No'), $commonModel->getHtmlOptions('show_pack_link')); ?>
            <?php echo $form->error($commonModel, 'show_pack_link');?>
        </div> 
         <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'enable_featured');?>
            <?php echo $form->dropDownList($commonModel, 'enable_featured', array('1'=>'Yes','0'=>'No'), $commonModel->getHtmlOptions('enable_featured')); ?>
            <?php echo $form->error($commonModel, 'enable_featured');?>
        </div> 
        */ 
        
        /*
        ?> 
        <hr />
        <h4><?php echo Yii::t('settings', 'Ad Listing Expiry Settings')?></h4>
        <hr />
          
          <div class="form-group col-lg-6">
			  <div class="row">
				  <div class="col-sm-8">
            <?php echo $form->labelEx($commonModel, 'ad_expiry');?>
            </div>
            <div class="col-sm-4 text-right">
            No Expiry for listings <?php echo $form->checkbox($commonModel, 'no_expiry', $commonModel->getHtmlOptions('no_expiry',array('style'=>'width:auto;float: left;padding: 0;vertical-align: middle;height: auto;margin-left: 5px;float:right'))); ?> 
            </div>
           </div>
            <?php echo $form->textField($commonModel, 'ad_expiry', $commonModel->getHtmlOptions('ad_expiry')); ?>
            <?php echo $form->error($commonModel, 'ad_expiry');?>
        </div>  
        
          <div class="form-group col-lg-6">
			  <div class="row">
				  <div class="col-sm-8">
            <?php echo $form->labelEx($commonModel, 'ad_expiry_notification');?>
            </div>
          </div>
                   <?php echo $form->dropDownList($commonModel, 'ad_expiry_notification', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('ad_expiry_notification')); ?>
   
            <?php echo $form->error($commonModel, 'ad_expiry_notification');?>
        </div>  
          <div class="form-group col-lg-12">
			  <div class="row">
				  <div class="col-sm-8">
            <?php echo $form->labelEx($commonModel, 'ad_expiry_notification_message');?>
            </div>
          </div>
                   <?php echo $form->textField($commonModel, 'ad_expiry_notification_message', $commonModel->getHtmlOptions('ad_expiry_notification_message')); ?>
   
            <?php echo $form->error($commonModel, 'ad_expiry_notification_message');?>
        </div>  
        */
        /*
        ?>
         
       <div class="clearfix"><!-- --></div>
       <div class="clearfix"><!-- --></div>
        <hr />
        <h4><?php echo Yii::t('settings', 'ContactUs Settings')?></h4>
        <hr />
              <div class="form-group col-lg-6">
			  <div class="row">
				  <div class="col-sm-8">
            <?php echo $form->labelEx($commonModel, 'upload_property_title');?>
            </div>
            <div class="col-sm-4 text-right">
            Hide <?php echo $form->checkbox($commonModel, 'upload_property_hide', $commonModel->getHtmlOptions('upload_property_hide',array('style'=>'width:auto;float: left;padding: 0;vertical-align: middle;height: auto;margin-left: 5px;float:right'))); ?> 
            </div>
           </div>
            <?php echo $form->textField($commonModel, 'upload_property_title', $commonModel->getHtmlOptions('upload_property_title')); ?>
            <?php echo $form->error($commonModel, 'upload_property_title');?>
        </div>  
        <div class="form-group col-lg-6">
			  <div class="row">
				  <div class="col-sm-8">
            <?php echo $form->labelEx($commonModel, 'customer_support_title');?>
            </div>
            <div class="col-sm-4 text-right">
            Hide <?php echo $form->checkbox($commonModel, 'customer_support_hide', $commonModel->getHtmlOptions('customer_support_hide',array('style'=>'width:auto;float: left;padding: 0;vertical-align: middle;height: auto;margin-left: 5px;float:right'))); ?> 
            </div>
           </div>
            
            <?php echo $form->textField($commonModel, 'customer_support_title', $commonModel->getHtmlOptions('customer_support_title')); ?>
            <?php echo $form->error($commonModel, 'customer_support_title');?>
        </div>   
       
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'upload_property_contact_name');?>
            <?php echo $form->textField($commonModel, 'upload_property_contact_name', $commonModel->getHtmlOptions('upload_property_contact_name')); ?>
            <?php echo $form->error($commonModel, 'upload_property_contact_name');?>
        </div>   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'customer_support_contact_name');?>
            <?php echo $form->textField($commonModel, 'customer_support_contact_name', $commonModel->getHtmlOptions('customer_support_contact_name')); ?>
            <?php echo $form->error($commonModel, 'customer_support_contact_name');?>
        </div> 
        <div class="clearfix"></div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'upload_property_whatsapplink');?>
            <?php echo $form->textField($commonModel, 'upload_property_whatsapplink', $commonModel->getHtmlOptions('upload_property_whatsapplink')); ?>
            <?php echo $form->error($commonModel, 'upload_property_whatsapplink');?>
        </div>   
          <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'customer_support_whatsapplink');?>
            <?php echo $form->textField($commonModel, 'customer_support_whatsapplink', $commonModel->getHtmlOptions('customer_support_whatsapplink')); ?>
            <?php echo $form->error($commonModel, 'customer_support_whatsapplink');?>
        </div>   
        <div class="clearfix"></div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'upload_property_image');?>
            <img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/'.$commonModel->upload_property_image);?>" id="blah" style="width:50px;height:50px;border:2px solid #eee;<?php if($commonModel->upload_property_image==""){echo "display:none;"; };?>" alt="Preview">
            <?php echo $form->fileField($commonModel, 'upload_property_image', $commonModel->getHtmlOptions('upload_property_image')); ?>
            <?php echo $form->error($commonModel, 'upload_property_image');?>
        </div>   
         
      
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'customer_support_image');?>
                <img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/'.$commonModel->customer_support_image);?>" id="blah" style="width:50px;height:50px;border:2px solid #eee;<?php if($commonModel->customer_support_image==""){echo "display:none;"; };?>" alt="Preview">
        
            <?php echo $form->fileField($commonModel, 'customer_support_image', $commonModel->getHtmlOptions('customer_support_image')); ?>
            <?php echo $form->error($commonModel, 'customer_support_image');?>
        </div>   
        <div class="clearfix"><!-- --></div>
        */
        ?>
       <?php
       /*
        <hr />
        <h4><?php echo Yii::t('settings', 'SMTP Settings')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'smtp_host');?>
            <?php echo $form->textField($commonModel, 'smtp_host', $commonModel->getHtmlOptions('smtp_host')); ?>
            <?php echo $form->error($commonModel, 'smtp_host');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'smtp_port');?>
            <?php echo $form->textField($commonModel, 'smtp_port', $commonModel->getHtmlOptions('smtp_port')); ?>
            <?php echo $form->error($commonModel, 'smtp_port');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'smtp_username');?>
            <?php echo $form->textField($commonModel, 'smtp_username', $commonModel->getHtmlOptions('smtp_username')); ?>
            <?php echo $form->error($commonModel, 'smtp_username');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'smtp_password');?>
            <?php echo $form->textField($commonModel, 'smtp_password', $commonModel->getHtmlOptions('smtp_password')); ?>
            <?php echo $form->error($commonModel, 'smtp_password');?>
        </div>    
        * */
        ?>
       
        <hr />
        <h4><?php echo Yii::t('settings', 'Ad Settings')?></h4>
        <hr />
         <?php
        /*
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'agent_default_status');?>
            <?php echo $form->dropDownList($commonModel, 'agent_default_status',ListingUsers::model()->getStatusArray(), $commonModel->getHtmlOptions('agent_default_status')); ?>
            <?php echo $form->error($commonModel, 'agent_default_status');?>
        </div>    
          
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'customer_default_status');?>
            <?php echo $form->dropDownList($commonModel, 'customer_default_status',ListingUsers::model()->getStatusArray(), $commonModel->getHtmlOptions('customer_default_status')); ?>
            <?php echo $form->error($commonModel, 'customer_default_status');?>
        </div> 
        */
        ?>
        <div class="clearfix"><!-- --></div>   
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'frontend_default_ad_status');?>
            <?php echo $form->dropDownList($commonModel, 'frontend_default_ad_status',PlaceAnAd::model()->statusArray(), $commonModel->getHtmlOptions('frontend_default_ad_status')); ?>
            <?php echo $form->error($commonModel, 'frontend_default_ad_status');?>
        </div>
         <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'frontend_default_ad_image_status');?>
            <?php echo $form->dropDownList($commonModel, 'frontend_default_ad_image_status',array('A'=>'Active','I'=>'Inactive'), $commonModel->getHtmlOptions('frontend_default_ad_image_status')); ?>
            <?php echo $form->error($commonModel, 'frontend_default_ad_image_status');?>
        </div>
       <div class="clearfix"><!-- --></div>
      
        <hr />
        <h4><?php echo Yii::t('settings', 'SEO Friendly')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'home_meta_title');?><?php echo $commonModel->createTransLink('home_meta_title');?>
            <?php echo $form->textField($commonModel, 'home_meta_title', $commonModel->getHtmlOptions('home_meta_title')); ?>
            <?php echo $form->error($commonModel, 'home_meta_title');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'home_meta_keywords');?><?php echo $commonModel->createTransLink('home_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'home_meta_keywords', $commonModel->getHtmlOptions('home_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'home_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_meta_description');?><?php echo $commonModel->createTransLink('home_meta_description');?>
            <?php echo $form->textArea($commonModel, 'home_meta_description', $commonModel->getHtmlOptions('home_meta_description')); ?>
            <?php echo $form->error($commonModel, 'home_meta_description');?>
        </div>    
        
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'facebook_app_id');?>
            <?php echo $form->textField($commonModel, 'facebook_app_id', $commonModel->getHtmlOptions('facebook_app_id')); ?>
            <?php echo $form->error($commonModel, 'facebook_app_id');?>
        </div>    
       
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'facebook_seceret_key');?>
            <?php echo $form->textField($commonModel, 'facebook_seceret_key', $commonModel->getHtmlOptions('facebook_seceret_key')); ?>
            <?php echo $form->error($commonModel, 'facebook_seceret_key');?>
        </div>    
          <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'google_app_id');?>
            <?php echo $form->textField($commonModel, 'google_app_id', $commonModel->getHtmlOptions('google_app_id')); ?>
            <?php echo $form->error($commonModel, 'google_app_id');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'google_client_secret');?>
            <?php echo $form->textField($commonModel, 'google_client_secret', $commonModel->getHtmlOptions('google_client_secret')); ?>
            <?php echo $form->error($commonModel, 'google_client_secret');?>
        </div>    
        
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'google_map_api_key');?>
            <?php echo $form->textField($commonModel, 'google_map_api_key', $commonModel->getHtmlOptions('google_map_api_key')); ?>
            <?php echo $form->error($commonModel, 'google_map_api_key');?>
        </div>       
          <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'google_analytics_code');?>
            <?php echo $form->textArea($commonModel, 'google_analytics_code', $commonModel->getHtmlOptions('google_analytics_code')); ?>
            <?php echo $form->error($commonModel, 'google_analytics_code');?>
        </div> 
        <div class="clearfix"></div>
          <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 're_captcha_key');?>
            <?php echo $form->textField($commonModel, 're_captcha_key', $commonModel->getHtmlOptions('re_captcha_key')); ?>
            <?php echo $form->error($commonModel, 're_captcha_key');?>
        </div>       
          <div class="form-group col-lg-6  ">
            <?php echo $form->labelEx($commonModel, 're_captcha_secret');?>
            <?php echo $form->textField($commonModel, 're_captcha_secret', $commonModel->getHtmlOptions('re_captcha_secret')); ?>
            <?php echo $form->error($commonModel, 're_captcha_secret');?>
        </div> 
        
        <?php
        /*
        <div class="col-lg-6">
            <div class="form-group<?php if ($commonModel->clean_urls == 1){?> col-lg-8<?php }?>">
                <?php echo $form->labelEx($commonModel, 'clean_urls');?>
                <?php echo $form->dropDownList($commonModel, 'clean_urls', array(0 => Yii::t('app', 'No, do not use clean urls'), 1 => Yii::t('app', 'Yes, use clean urls')), $commonModel->getHtmlOptions('clean_urls')); ?>
                <?php echo $form->error($commonModel, 'clean_urls');?>
            </div>    
            <div class="form-group col-lg-2" style="<?php if ($commonModel->clean_urls != 1){?>display:none<?php }?>">
                <label><?php echo Yii::t('app', 'Action');?></label>
                <a data-toggle="modal" data-remote="<?php echo $this->createUrl('settings/htaccess_modal');?>" href="#writeHtaccessModal" class="btn btn-default"><?php echo Yii::t('settings', 'Generate htaccess')?></a>
            </div>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'default_mailer');?>
            <?php echo $form->dropDownList($commonModel, 'default_mailer', $commonModel->getSystemMailers(), $commonModel->getHtmlOptions('default_mailer')); ?>
            <?php echo $form->error($commonModel, 'default_mailer');?>
        </div>
        <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'api_status');?>
            <?php echo $form->dropDownList($commonModel, 'api_status', $commonModel->getSiteStatusOptions(), $commonModel->getHtmlOptions('api_status')); ?>
            <?php echo $form->error($commonModel, 'api_status');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'site_status');?>
            <?php echo $form->dropDownList($commonModel, 'site_status', $commonModel->getSiteStatusOptions(), $commonModel->getHtmlOptions('site_status')); ?>
            <?php echo $form->error($commonModel, 'site_status');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'check_version_update');?>
            <?php echo $form->dropDownList($commonModel, 'check_version_update', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('check_version_update')); ?>
            <?php echo $form->error($commonModel, 'check_version_update');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($commonModel, 'site_offline_message');?>
            <?php echo $form->textField($commonModel, 'site_offline_message', $commonModel->getHtmlOptions('site_offline_message')); ?>
            <?php echo $form->error($commonModel, 'site_offline_message');?>
        </div>
        <div class="clearfix"><!-- --></div>
        <hr />
        <h4><?php echo Yii::t('settings', 'Company info')?></h4>
        <hr />
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'company_info');?>
            <?php echo $form->textArea($commonModel, 'company_info', $commonModel->getHtmlOptions('company_info', array('rows' => 5))); ?>
            <?php echo $form->error($commonModel, 'company_info');?>
        </div>
        *  * */
        ?>
        <?php /*
        <div class="clearfix"><!-- --></div>
       
        <hr />
        <h4><?php echo Yii::t('settings', 'Miscellaneous settings')?></h4>
        <hr />
           <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'approval');?>
            <?php echo $form->dropDownList($commonModel, 'approval', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('approval')); ?>
            <?php echo $form->error($commonModel, 'approval');?>
        </div>
        <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'enable_home_featured_agents');?>
            <?php echo $form->dropDownList($commonModel, 'enable_home_featured_agents', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('enable_home_featured_agents')); ?>
            <?php echo $form->error($commonModel, 'enable_home_featured_agents');?>
        </div>
           <div class="form-group col-lg-4">
            <?php echo $form->labelEx($commonModel, 'price_trends_table');?>
            <?php echo $form->dropDownList($commonModel, 'price_trends_table', $commonModel->price_trends_table(), $commonModel->getHtmlOptions('price_trends_table')); ?>
            <?php echo $form->error($commonModel, 'price_trends_table');?>
        </div>
         <div class="form-group col-lg-4 hide">
            <?php echo $form->labelEx($commonModel, 'max_no_users');?>
            <?php echo $form->textField($commonModel, 'max_no_users',  $commonModel->getHtmlOptions('max_no_users')); ?>
            <?php echo $form->error($commonModel, 'max_no_users');?>
        </div>
        <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-3 hide">
            <?php echo $form->labelEx($commonModel, 'hide_projects_from_top_menu');?>
            <?php echo $form->dropDownList($commonModel, 'hide_projects_from_top_menu', $commonModel->getYesNoOptions(), $commonModel->getHtmlOptions('hide_projects_from_top_menu')); ?>
            <?php echo $form->error($commonModel, 'hide_projects_from_top_menu');?>
        </div>
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_page_banner_title');?><?php echo $commonModel->createTransLink('home_page_banner_title');?> 
            <?php echo $form->textField($commonModel, 'home_page_banner_title',   $commonModel->getHtmlOptions('home_page_banner_title')); ?>
            <?php echo $form->error($commonModel, 'home_page_banner_title');?>
        </div>
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_page_banner_title_r');?><?php echo $commonModel->createTransLink('home_page_banner_title_r');?> 
            <?php echo $form->textField($commonModel, 'home_page_banner_title_r',   $commonModel->getHtmlOptions('home_page_banner_title_r')); ?>
            <?php echo $form->error($commonModel, 'home_page_banner_title_r');?>
        </div>
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'home_page_banner_title_w');?> 
            <?php echo $form->textField($commonModel, 'home_page_banner_title_w',   $commonModel->getHtmlOptions('home_page_banner_title_w')); ?>
            <?php echo $form->error($commonModel, 'home_page_banner_title_w');?>
        </div>
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'home_page_banner_title_n');?> 
            <?php echo $form->textField($commonModel, 'home_page_banner_title_n',   $commonModel->getHtmlOptions('home_page_banner_title_n')); ?>
            <?php echo $form->error($commonModel, 'home_page_banner_title_n');?>
        </div>
            
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'home_page_about_us');?> 
            <?php echo $form->textArea($commonModel, 'home_page_about_us',   $commonModel->getHtmlOptions('home_page_about_us')); ?>
            <?php echo $form->error($commonModel, 'home_page_about_us');?>
        </div>
                <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'agent_banner_title');?> 
            <?php echo $form->textField($commonModel, 'agent_banner_title',   $commonModel->getHtmlOptions('agent_banner_title')); ?>
            <?php echo $form->error($commonModel, 'agent_banner_title');?>
        </div>
               <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'agent_meta_title');?> 
            <?php echo $form->textField($commonModel, 'agent_meta_title',   $commonModel->getHtmlOptions('agent_meta_title')); ?>
            <?php echo $form->error($commonModel, 'agent_meta_title');?>
        </div>
                <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'tax_title');?> <?php echo $commonModel->createTransLink('tax_title');?> 
            <?php echo $form->textField($commonModel, 'tax_title',   $commonModel->getHtmlOptions('tax_title')); ?>
            <?php echo $form->error($commonModel, 'tax_title');?>
             </div>
             <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'tax_number');?>
            <?php echo $form->textField($commonModel, 'tax_number',   $commonModel->getHtmlOptions('tax_number')); ?>
            <?php echo $form->error($commonModel, 'tax_number');?>
             </div>
             <div class="clearfix"><!-- --></div>
             */
             ?>
        <?php 
        /*
          <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($commonModel, 'fav_ico');?><b style="color: #5E1A3F"> To be Replaced to (140*140)</b>
                    <?php echo $form->fileField($commonModel, 'fav_ico',$commonModel->getHtmlOptions('commonModel')); ?>
                    <?php echo $form->error($commonModel, 'fav_ico');?>
                </div>  
                <img src="<?php echo Yii::app()->params['uploadDir'];?>/<?php echo $commonModel->fav_ico;?>" id="blah" style="width:50px;height:50px;border:2px solid #eee;<?php if($commonModel->fav_ico==""){echo "display:none;"; };?>" alt="Preview">
           8/
           */ ?>
        <div class="clearfix"><!-- --></div>
        <?php 
        /*
          <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($commonModel, 'logo');?><b style="color: #5E1A3F"> To be Replaced to (134*56)</b>
                    <?php echo $form->fileField($commonModel, 'logo',$commonModel->getHtmlOptions('logo')); ?>
                    <?php echo $form->error($commonModel, 'logo');?>
                </div>  
                <img src="<?php echo Yii::app()->params['uploadDir'];?>/logo/<?php echo $commonModel->logo;?>" id="logo" style="width:134px;height:56px;border:2px solid #eee;<?php if($commonModel->logo==""){echo "display:none;"; };?>" alt="Preview">
           8/
           */ ?> 
                   <div class="clearfix"><!-- --></div>
             <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'benefites_of_register');?>
            <?php echo $form->textArea($commonModel, 'benefites_of_register', $commonModel->getHtmlOptions('benefites_of_register')); ?>
            <?php echo $form->error($commonModel, 'benefites_of_register');?>
        </div>  
        <div class="clearfix"><!-- --></div>
        <div class="clearfix"><!-- --></div>
       
        <hr />
        <h4><?php echo Yii::t('settings', 'Pagination / Time info')?></h4>
        <hr />
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'backend_page_size');?>
            <?php echo $form->dropDownList($commonModel, 'backend_page_size', $commonModel->paginationOptions->getOptionsList(), $commonModel->getHtmlOptions('backend_page_size')); ?>
            <?php echo $form->error($commonModel, 'backend_page_size');?>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'customer_page_size');?>
            <?php echo $form->dropDownList($commonModel, 'customer_page_size', $commonModel->paginationOptions->getOptionsList(), $commonModel->getHtmlOptions('customer_page_size')); ?>
            <?php echo $form->error($commonModel, 'customer_page_size');?>
        </div>  
        <div class="clearfix"><!-- --></div>
   
        <div class="clearfix"><!-- --></div>
        <?php 
        /**
         * This hook gives a chance to append content after the active form fields.
         * Please note that from inside the action callback you can access all the controller view variables 
         * via {@CAttributeCollection $collection->controller->data}
         * @since 1.3.3.1
         */
        $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
    </div>
</div>
<script type="text/javascript">
	function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function readURL2(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#logo').attr('src', e.target.result);
            
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#OptionCommon_fav_ico").change(function(){
    readURL(this);
    $('#blah').show();
});
$("#OptionCommon_logo").change(function(){
    readURL2(this);
    $('#logo').show();
});
   
</script>
<link rel="stylesheet" href="<?php echo  AssetsUrl::css('table.css');?>" />
