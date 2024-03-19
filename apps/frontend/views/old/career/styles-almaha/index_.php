<div class="main-content">
  <div class="properties"  style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
        <div class="row">
			<div class="span12">
			<h3 style="text-align:left; padding:20px 0px;">Careers</h3>
			</div>
         <!-- Main content -->
         <div class="span8">
			 <?php
			if(Yii::app()->user->hasFlash('success'))
			{
			?>
			<div class="alert-box Bsuccess"><span>success: </span><?php echo Yii::app()->user->getFlash('success');?> </div>
			<?php
			}
			?>
			<?php
			if(Yii::app()->user->hasFlash('error'))
			{
			?>
			<div class="alert-box Berror"><span>error: </span><?php echo Yii::app()->user->getFlash('error');?></div>
			<?php
			}
			?>
          <!-- Contact -->
          <style>
          
			.main-content .properties h3 {
				color: #967930;
				font-family: "Ubuntu";
				font-size: 20px;
				font-weight: 400;
				padding: 0px 0;
				text-align: left;
				
			}
	 
.main-content .properties .contact-bor ul {
    font-family: Arial,Helvetica,sans-serif;
    list-style: outside url("../images/floorplan-list.png") disc;
    margin: 10px 0 0 50px;
}

.main-content .properties .contact-bor ul li {
    float: left;
    width: 100%;
}
          </style>
          <div class="contact">
            
            <div class="contact-bor">
              <?php echo $article->content;?>
              
              
            </div>
              
            <div class="contact-form" id="contact-form">
				<br />
				<?php
				$form = $this->beginWidget('CActiveForm', array(
				 
				'enableAjaxValidation'=>true,
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),

				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
				));
				?>
				<div class="row">
				<?php
				if(Yii::app()->user->hasFlash('success'))
				{
					echo '<div><p style="color:green;text-indent:20px"><b>'.Yii::app()->user->getFlash('success').'</b></p></div>';
				}
				?>
				</div>
                <div class="row">
                  <div class="span280px">
                    <?php echo $form->labelEx($model, 'name');?>
                    <?php echo $form->textField($model, 'name'); ?>
					<?php echo $form->error($model, 'name');?>
                   
                  </div>
                  <div class="span280px  pull-right">
                   
                    <?php echo $form->labelEx($model, 'email');?>
                   <?php echo $form->textField($model, 'email'); ?>
						<?php echo $form->error($model, 'email');?>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="span280px">
                    <?php echo $form->labelEx($model, 'phone');?>
                    <?php echo $form->textField($model, 'phone'); ?>
					<?php echo $form->error($model, 'phone');?>
                   
                  </div>
                  <div class="span280px  pull-right">
                   
                    <?php echo $form->labelEx($model, 'position');?>
                   <?php echo $form->textField($model, 'position'); ?>
						<?php echo $form->error($model, 'position');?>
                  </div>
                  
                </div>
               	
                <?php echo $form->labelEx($model, 'message');?>
                <?php echo $form->textArea($model, 'message'); ?>
				<?php echo $form->error($model, 'message');?>
				
                <?php echo $form->labelEx($model, 'image_field');?>
                <?php echo $form->fileField($model, 'image'); ?>
				<?php echo $form->error($model, 'image');?>
                <button class="button-send" type="submit">Submit</button>
             <?php $this->endWidget(); ?>
            </div>
          </div>
          <!-- End contact -->
        </div>
        
        
        
         <div class="span4">
          <div class="box-siderbar-container">
            <!-- sidebar-box map-box -->
             
                  <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>""));?>
            
             
              </div>
              
              
               
            </div>
        
           <div class="sidebar-box">
                                       <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>array(),'section_id'=>""));?>
 
            </div>
            <!-- End sidebar-box product_list_wg -->
            
            <!-- sidebar-box searchbox -->
            
            <!-- End sidebar-box searchbox -->
            
          </div>
        </div>
                </div>
              </div>
        
        
        
        
        
        
        
        <!-- End Main content -->
        
        <!-- Sidebar left  -->
        
      <!-- End Sidebar left  -->
    </div>
  </div>
</div>
</div>
</div>
     
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
