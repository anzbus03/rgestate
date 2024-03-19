<?php defined('MW_PATH') || exit('No direct script access allowed');?>

		<div id="" class="innnerpage margin_60_35">
			<div class="wrapper">
				<div class="container">
					<div class="row  ">
						<div class="col-xl-12 col-lg-12">
						<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
	 <style>
	 .confirm-page {
    
    margin: 25px 0 60px;
   
    position: relative;
 
 
}
.text-left00 { text-align:left; }
	 </style>
	
<div class="panel-wrapper"  >
<div class="clearfix"></div>
			<div class="onlyforpoupuplog">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
<div class="clearfix"></div>
	
<div class="  content-container    ">
    <?php
    if($view=='verify'){ ?>
    <h4 class="subheading_font row bold-style"><?php echo $this->tag->gettag('change_your_email_address.','Change your email address.');?></h4>
	 <div class="confirm-page1">
	     
	     
	     
	           <div class="false" style="padding: 10px;position:relative;">
							      
					<style>
					    .r-1upvrn0 {
    box-shadow: rgba(101, 119, 134, 0.2) 0px 0px 15px, rgba(101, 119, 134, 0.15) 0px 0px 3px 1px;
}
.r-1ekmkwe {
    max-width: calc(295px);
}
.resedV {
    position: absolute !important;
z-index: 1!important;
right: 0!important;
}
.r-u8s1d {
    position: absolute;
}
.r-ipm5af {
    top: 0px;
}
		.css-1dbjc4n {
    -moz-box-align: stretch;
    -moz-box-direction: normal;
    -moz-box-orient: vertical;
    align-items: stretch;
    border: 0px solid black;
    box-sizing: border-box;
    display: flex;
    flex-basis: auto;
    flex-direction: column;
    flex-shrink: 0;
    margin: 0px;
    min-height: 0px;
    min-width: 0px;
    padding: 0px;
    position: relative;
    z-index: 0;
}			    .r-my5ep6 {
    border-bottom-color: rgb(230, 236, 240);
}.r-16dba41 {
    font-weight: 400;
}
.r-1re7ezh {
    color: rgb(101, 119, 134);
}.r-d9fdf6 {
    padding-left: 20px;
    padding-right: 20px;
}
.r-9qu9m4 {
    padding-bottom: 15px;
    padding-top: 15px;
}.r-my5ep6 {
    border-bottom-color: rgb(230, 236, 240);
}
.r-qklmqi {
    border-bottom-width: 1px;
}
.r-rull8r {
    border-bottom-style: solid;
}
.r-14lw9ot {
    background-color: rgb(255, 255, 255);
}
.r-6416eg {
    transition-property: background-color, box-shadow;
}
.r-1loqt21 {
    cursor: pointer;
}
.r-18u37iz {
    -moz-box-direction: normal;
    -moz-box-orient: horizontal;
    flex-direction: row;
}
.r-o7ynqc {
    transition-duration: 0.2s;
}
.r-13qz1uu {
    width: 100%;
}
.r-9qu9m4 {
      padding-bottom: 7px;
    padding-top: 7px;
}
.r-1j3t67a {
    padding-left: 15px;
    padding-right: 15px;
}
.mhvrme:hover{ background:#F5F8FA ; }
span.lnk , span.lnk a { color: var(--linkcolor);}
					</style>		      

 
							      
							      
						   <?php // ajaxSubmitHappenlist2(form, data, hasError,"'.Yii::app()->createUrl('member/submitDetails').'");
						   $mainTex = $this->tag->getTag('change_email_address', 'Change Email Address') ; 
						   
					 	   
						   $Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
	
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt',
						    
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb3").html("'. $Validating.'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb3").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb3").val("'. $please_wait .'"); 
				           return true;
							  
							}
							}',
							),
							'htmlOptions'=>array('class'=>'sign-in-form','style'=>'margin-top: 5px;max-width:95%;width:340px;margin:auto;' ),
							));
							if(!Yii::App()->request->isPostRequest){
							    $model->email = ''; 
							}
							?>
                           	<div class="form-group  ">

						    <div class="row">
                          
                          
                          </div>
                           </div>
                           <div class="cols24">
                      
								 </div>
                           	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'email' ,  $model->getHtmlOptions('email',array('style'=>'border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
    line-height: 36px;
    min-height: 48px;
    width: 100%;
    text-indent: 18px;
    font-size: 16px !important;','class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('email_*','Email *')   )));  ?>

							<?php echo $form->error($model, 'email');?>
		                 
							</div>

							</div>
		</div> 
   		 
		
		       <div id="msg_alert"></div>
  	<div class="clearfix"></div> 
				<div class="form-group  ">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">
		<input type="hidden" name="next" value=""/>
				 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s" data-html="<?php echo $mainTex;?>"  data-auto-test-id="submitButton" id="bb3" style=" clear: both;border: 0 none;
    height: 40px;
    display: inline-block;
    border-radius: 20px;
    padding: 0 18px;
    font-size: 15px;
    font-weight: 700;
    outline: currentcolor none medium;
    box-shadow: none;
    cursor: pointer;
    margin-top: 10px;
    vertical-align: middle;
    text-align: center;
    background-color: var(--secondary-color);
    color: #fff;
    width: 100%;max-width: unset !important;"    /><?php echo $mainTex;?></button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  
					<div class="clearfix"></div>
				</div>
		 
                           <?php $this->endWidget(); ?>
                        </div>
                        <?php /* 
                 	<div class="m_head_title_button" style="text-align: left;margin-bottom: 10px;"><a href="javascript:void(0)" onclick="resendEmail(this)" style="color: var(--link-color);font-weight: 700;text-decoration: underline;" class="">Not received? Click here to resend <span id="total_send">(2)</span></a></div>
                    */
                    ?>
 		</div>
	 <?php 
	}else{
		?>
	
		  	<div class="row  signup-container margin-top-50">
	
		<div class="col-md-8" style="margin:auto;float:none;max-width:448px;">
		<div class="module-head" id="yui_3_18_1_1_1536724890525_310"><h2 id="yui_3_18_1_1_1536724890525_309"><?php echo $heading;?></h2></div>
        <div class="sign-in-form style-1">
        
          <div class="tabs-container alt"> 
			<p class="special"><?php echo $this->tag->getTag('enter_your_new_email_address_a','Enter your new email address and we\'ll send you a link to verify your account.');?></p>
       
            <!-- Login -->
			<div class="tab-content padding-top-0" id="tab1" style="border-top:0px;">
		 	<div class="tab_container no-margin no-padding">

<div id="tab1" class="tab_content active_content" id="fbsignin-form">
	 <div class="form">
							 
							 	<div id="right-col">
		 
			 <style>
			 #fbsignin-form #right-col .error { width:auto !important; }
			 </style> 
			<div id="signin-form">
				
				<div class="form-row nomargin"  >
					<?php  
					$form = $this->beginWidget('CActiveForm',array( 
					'enableAjaxValidation'=>true,
					'htmlOptions' =>array('id'=>'form-account-loginasd','data-abide'=>'','style'=>''),
					'clientOptions' => array(
					'validateOnSubmit'=>true,
					),
					)); 
					;?>
					<?php 
					if(!Yii::app()->request->isPostRequest){
						$model->email ='';
					}
						echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array( "class"=>"user-email"   ))); 
					?>
					<?php echo $form->error($model, 'email');?>
					<div class="clear"></div>
				</div>
				 
				<div class="fbsignin-button-block" style="width:100%;">
					<button type="submit" class="btn awesome fbsignin-button frebites_button" value=""  style="width:100%;" ><i class="fa fa-envelope"></i> <?php echo $this->tag->getTag('change-email','Change Email');?></button>
									<span class="forgotpassword pull-left margin-left-0 nomarginwe"><?php echo Yii::t('app',$this->tag->getTag('dont_receivie_verification_ema','Dont receive verification email? {l}'),array('{l}'=>'<a href="'.$this->app->createUrl('user/emailVerification',array('email'=>$model->email)).'"   class="redbold">'.$this->tag->getTag('send-it-again','Send it again').'</a>'));?></span>

					<div class="clearfix"></div>
				</div>
				<?php $this->endWidget();?>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
		
	 <div class="clearfix"></div>
</div><!-- end #tab1 -->

		 
		</div><!-- end .tab_container -->
	
			</div>

			<!-- Register -->
		 
            </div>
          </div>
       

		

		</div>
		
 	</div>

</div>
	
		<?
	}
	?>
 </div>

<div class="clearfix"></div>
 </div>
	 
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /wrapper -->
		</div>
		<!-- /error_page -->


