  <section>
		<div id="headerNewplaceNew">
		<div  class="newsearch-main-div-2 cf shrink_control" style="top:48px;">
			<?php   $this->widget('frontend.components.web.widgets.searchHeader.searchHeaderWidget');?>

		</div>
		</div>
  </section> 
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container margin-top-240">
<div class="container_content">
<div class="navigate_link"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Home</a>  <span> &gt; Career</span></span></div>
<div class="bottom_line_2 crmbrimg">
<span></span>
<span></span>
</div>
<h1 class="crumbarHeadingCms"> <span class="bluecolor"> Careers </span>  </h1>
		 
 
            
           <div class="agent-unit-pro-details-div">
     
        <div class="">
			 
			<div class="overview-control-div" style="margin-top:20px;"> 
				<div class="row">
				<?php
				if(Yii::app()->user->hasFlash('success'))
				{
					echo '<div><p class="sucessClass"><b>'.Yii::app()->user->getFlash('success').'</b></p></div>';
				}
				?>
				</div>
			<div class="stagc-loc-txt"> 
			<span class="stagc-loc-txt-span2"><?php echo $article->content;?></span>
			</div>
			</div>
 
		<div style="clear:both"></div>
		<div class="div-hr4-unit"></div>
		<div class="overview-control-div">
		<h1 class="crumbarHeadingCms">
		<span class="bluecolor" style="font-size:16px;">Submit Resume</span>
		</h1>
		</div>	
		 
		<div style="height:10px;clear:both;"></div>
		  <div class="contact-form" id="contact-form">
				 
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
                 <div style="clear:both" class="height10"></div>
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
               	 <div style="clear:both" class="height10"></div>
                <?php echo $form->labelEx($model, 'message');?>
                <?php echo $form->textArea($model, 'message'); ?>
				<?php echo $form->error($model, 'message');?>
				 <div style="clear:both" class="height10"></div>
                <?php echo $form->labelEx($model, 'image_field');?><br />
                <?php echo $form->fileField($model, 'image',array('style'=>'width:auto;border:0px;')); ?>
				<?php echo $form->error($model, 'image');?>
				 <div style="clear:both" class="height10"></div>
               <div style="height:20px"  ></div>
                <button class="button-send back-searchbutton" type="submit"  >Submit</button>
                <div style="height:20px;clear:both;"></div>
             <?php $this->endWidget(); ?>
            </div> 
		<div style="clear:both"></div>	 
</div>
</div>
<div style="clear:both;"></div>
</div>
</div>
</div>
 <style>
 

.stagc-loc-txt-span2   li {
    float: left;
    margin-right: 20px;
     list-style:disc;
    width: 100%;
    margin-left:10px;
    line-height:25px;
    
}
.stagc-loc-txt-span2   li a {
    
    color:#002d72;
}
 .map {
    border  : 1px solid  #eee ;
    margin-bottom: 40px;
    padding: 10px ;
}
.height10{
	height:10px;
}
 
 
.pull-left {
    float: left !important;
}
.pull-right {
     float:right !important;
} 
.addressForm{  
color : #6a6c6b ; 
font-size:13px;
}
p.sucessClass{
	color:green;text-indent:0px;font-size:13px
}
 </style>
      <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
