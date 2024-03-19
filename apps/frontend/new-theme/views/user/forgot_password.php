<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<style>.isOnFram .container.card-1 { margin-top:  0px; }</style>
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           <div class="clearfix"></div>
			<div class="onlyforpoupuplog">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
<div class="clearfix"></div>
	
           <h4 class="subheading_font row bold-style"><a href="<?php echo $this->app->createUrl('user/signin');?>" style="display:inline-block;;margin-right:5px;" onclick="easyload(this,event,'pajax')" class="bld-link2"><span data-aut-id="enteruser-click-back" class="_2uUJF"><svg width="14px" height="14px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-22SD7" d="M196.267 469.333l315.733-320-59.733-59.733-422.4 422.4 422.4 422.4 59.733-59.733-320-320h759.467l42.667-42.667-42.667-42.667h-755.2z"></path></svg></span></a><?php echo $this->tag->getTag('forgot_password','Forgot Password');?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0; margin:auto;  max-width:280px;    margin: auto;    width: 100%;display:block;">
			<?php $this->renderPartial('_forgot_password');?>
		<div class="clearfix"></div>
					<div  class="lastrow" style="white-space: nowrap; ">
					     <span ><?php echo Yii::t('app',$this->tag->getTag('dont_have_an_account?_{link}','Don\'t have an account? {link}'),array('{link}'=>'<a href="'.Yii::App()->createUrl('user/signup').'" onclick="easyload(this,event,\'pajax\')" class="link_color" style="font-weight:400">'.$this->tag->getTag('click_here_to_register','Click here to register').'</a>'));?></span><div class="clearfix"></div></p>
		
			</div>

			<!-- Register -->
		 
            </div>
          </div>
       

		

		</div>
		 
		
	 </div>

</div>
   
