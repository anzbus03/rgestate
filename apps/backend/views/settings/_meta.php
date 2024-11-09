<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo Yii::t('settings', 'Meta Title')?></h3>
    </div>
    <div class="card-body">
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
       
        <h4><?php echo Yii::t('settings', 'Meta Tags')?></h4>
        <hr />
         <h3>Home</h3>
          <div class="clearfix"><!-- --></div>
               <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_meta_title');?><?php echo $commonModel->createTransLink('home_meta_title');?>
            <?php echo $form->textField($commonModel, 'home_meta_title', $commonModel->getHtmlOptions('home_meta_title')); ?>
            <?php echo $form->error($commonModel, 'home_meta_title');?>
        </div>  
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'home_meta_keywords', $commonModel->getHtmlOptions('home_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'home_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'home_meta_description');?>
            <?php echo $form->textArea($commonModel, 'home_meta_description', $commonModel->getHtmlOptions('home_meta_description')); ?>
            <?php echo $form->error($commonModel, 'home_meta_description');?>
        </div>  
         <div class="clearfix"><!-- --></div>
        <hr />
        <!-- Buy Page -->
         <div class="clearfix"><!-- --></div>
         <h3>Buy</h3>
          <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'buypage_meta_title');?> 
            <?php echo $form->textField($commonModel, 'buypage_meta_title', $commonModel->getHtmlOptions('buypage_meta_title')); ?>
            <?php echo $form->error($commonModel, 'buypage_meta_title');?>
        </div>    
        <div class="form-group col-lg-12">            
            <?php echo $form->labelEx($commonModel, 'buypage_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'buypage_meta_keywords', $commonModel->getHtmlOptions('buypage_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'buypage_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'buypage_meta_description');?>
            <?php echo $form->textArea($commonModel, 'buypage_meta_description', $commonModel->getHtmlOptions('buypage_meta_description')); ?>
            <?php echo $form->error($commonModel, 'buypage_meta_description');?>
        </div>    
        <hr />
        <!-- Rent Page -->     <div class="clearfix"><!-- --></div>
         <h3>Rent</h3>
            <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'rentpage_meta_title');?>
            <?php echo $form->textField($commonModel, 'rentpage_meta_title', $commonModel->getHtmlOptions('rentpage_meta_title')); ?>
            <?php echo $form->error($commonModel, 'rentpage_meta_title');?>
        </div>    
        <div class="form-group col-lg-12">            
            <?php echo $form->labelEx($commonModel, 'rentpage_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'rentpage_meta_keywords', $commonModel->getHtmlOptions('rentpage_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'rentpage_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'rentpage_meta_description');?>
            <?php echo $form->textArea($commonModel, 'rentpage_meta_description', $commonModel->getHtmlOptions('rentpage_meta_description')); ?>
            <?php echo $form->error($commonModel, 'rentpage_meta_description');?>
        </div>    
        <hr />
          <h3>Business for sale</h3>
            <div class="clearfix"><!-- --></div>
        <!-- New Development Page -->
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'wanted_page_meta_title');?>
            <?php echo $form->textField($commonModel, 'wanted_page_meta_title', $commonModel->getHtmlOptions('wanted_page_meta_title')); ?>
            <?php echo $form->error($commonModel, 'wanted_page_meta_title');?>
        </div>    
        <div class="form-group col-lg-12">            
            <?php echo $form->labelEx($commonModel, 'wanted_page_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'wanted_page_meta_keywords', $commonModel->getHtmlOptions('wanted_page_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'wanted_page_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'wanted_page_meta_description');?>
            <?php echo $form->textArea($commonModel, 'wanted_page_meta_description', $commonModel->getHtmlOptions('wanted_page_meta_description')); ?>
            <?php echo $form->error($commonModel, 'wanted_page_meta_description');?>
        </div>    
        <hr />
        <div class="clearfix"><!-- --></div>
         <h3>New Projects</h3>
          <div class="clearfix"><!-- --></div>
        <!-- New Development Page -->
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'devpage_meta_title');?>
            <?php echo $form->textField($commonModel, 'devpage_meta_title', $commonModel->getHtmlOptions('devpage_meta_title')); ?>
            <?php echo $form->error($commonModel, 'devpage_meta_title');?>
        </div>    
        <div class="form-group col-lg-12">            
            <?php echo $form->labelEx($commonModel, 'devpage_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'devpage_meta_keywords', $commonModel->getHtmlOptions('devpage_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'devpage_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'devpage_meta_description');?>
            <?php echo $form->textArea($commonModel, 'devpage_meta_description', $commonModel->getHtmlOptions('devpage_meta_description')); ?>
            <?php echo $form->error($commonModel, 'devpage_meta_description');?>
        </div>  
         <div class="clearfix"><!-- --></div>
         <h3>Area Guides</h3>
          <div class="clearfix"><!-- --></div>
        <!-- New Development Page -->
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'areaguide_title');?>
            <?php echo $form->textField($commonModel, 'areaguide_title', $commonModel->getHtmlOptions('areaguide_title')); ?>
            <?php echo $form->error($commonModel, 'areaguide_title');?>
        </div>    
        <div class="form-group col-lg-12">            
            <?php echo $form->labelEx($commonModel, 'areaguide_description');?>
            <?php echo $form->textField($commonModel, 'areaguide_description', $commonModel->getHtmlOptions('areaguide_description')); ?>
            <?php echo $form->error($commonModel, 'areaguide_description');?>
        </div>    
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'areaguide_keywords');?>
            <?php echo $form->textArea($commonModel, 'areaguide_keywords', $commonModel->getHtmlOptions('areaguide_keywords')); ?>
            <?php echo $form->error($commonModel, 'areaguide_keywords');?>
        </div>    
        <hr />
        
        <!-- Agent Page -->        
        <div class="form-group col-lg-6 hide">
            <?php echo $form->labelEx($commonModel, 'agentpage_meta_title');?>
            <?php echo $form->textField($commonModel, 'agentpage_meta_title', $commonModel->getHtmlOptions('agentpage_meta_title')); ?>
            <?php echo $form->error($commonModel, 'agentpage_meta_title');?>
        </div>    
        <div class="form-group col-lg-6 hide">            
            <?php echo $form->labelEx($commonModel, 'agentpage_meta_keywords');?>
            <?php echo $form->textField($commonModel, 'agentpage_meta_keywords', $commonModel->getHtmlOptions('agentpage_meta_keywords')); ?>
            <?php echo $form->error($commonModel, 'agentpage_meta_keywords');?>
        </div>    
        <div class="form-group col-lg-12 hide">
            <?php echo $form->labelEx($commonModel, 'agentpage_meta_description');?>
            <?php echo $form->textArea($commonModel, 'agentpage_meta_description', $commonModel->getHtmlOptions('agentpage_meta_description')); ?>
            <?php echo $form->error($commonModel, 'agentpage_meta_description');?>
        </div>    
        <hr /> 
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
