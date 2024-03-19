<?php defined('MW_PATH') || exit('No direct script access allowed');?>
	<div class="clearfix"></div>
			<div class="onlyforpoupuplog">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
<div class="clearfix"></div>
	
<h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('create_a_free_account','Create a free account');?></h4>
	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1"  >
           <div class="tabs-container alt"> 

            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
				<div class="clearfix"></div>
				<div class="clearfix"></div>
			<?php   $this->renderPartial('_register_partial');?>
				<div class="clearfix"></div>
					<div  class="lastrow   margin-bottom-0 text-center"><span class=""><?php echo Yii::t('app',$this->tag->getTag('already_a_member?_{link}','Already a member? {link}'),array('{link}'=>'<a href="'.Yii::app()->createUrl('user/signin').'" onclick="easyload(this,event,\'pajax\')" style="font-weight:400" class="link_color">'.$this->tag->getTag('click_here_to_login.','Click here to login.').'</a>'));?> </span><div class="clearfix"></div></div>
 
		
			</div>

			<!-- Register -->
			 
            </div>
          </div>
       

		

		</div>
		
		
 </div>


 
