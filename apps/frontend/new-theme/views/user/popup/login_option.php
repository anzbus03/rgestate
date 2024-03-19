<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<div class="container">
	<div class="row" id="login_opt">
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
             <h4 class="subheading_font row bold-style">Log in to <?php echo $this->project_name;?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
            <!-- Login -->
			<div  style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
            <!-- Login --> <script>
            function popitup(k) {
                parent.OpenWindow(k); 
     }
      
            </script>
							<div class=" padding-top-0" style="border-top:0px;">
							 <?php
							 if($this->app->options->get('system.common.disable_login_otp','yes')=='no'){ ?> 
							 <a href="<?php echo Yii::app()->createUrl('user/signin_phone_popup');?>" onclick="easyload(this,event,'pajax')" class="kbyheJ">Continue with Mobile Number</a>
						    <?php } ?> 
							<a href="<?php echo Yii::app()->createUrl('user/signin_popup');?>" onclick="easyload(this,event,'pajax')" class="jilpeK">Continue with Email</a>
							<a  data-href="<?php echo Yii::app()->createUrl('site/login',array('service'=>'google_oauth'));?>" onclick="popitup('1')" href="javascript:void(0)"  class="jilpeK gggle">Login with Google</a>
		                    <a  href="javascript:void(0)" onclick="popitup('2')"  class="jilpeK fbku">Login with Facebook</a>
		                     
			</div>

			<!-- Register -->
	       </div>
         	</div>

			<!-- Register -->
		 
            </div>
          </div>
		</div>
	 </div>
</div>
<?php $this->renderPartial('popup/_benefits');?>
