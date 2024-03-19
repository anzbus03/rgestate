<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Forgot Password</h2>
			</div>
		</div>
	</div>
</div>
<div class="container">

	<div class="row">
	
		<div class="col-md-8">
        <!--Tabs -->
        <div class="sign-in-form style-1">
          <ul class="tabs-nav" style="width: 100%;">
            <li class="active"><a href="#tab1">Forgot Password</a></li>
          </ul>
          <div class="tabs-container alt"> 

            <!-- Login -->
			<div class="tab-content" id="tab1" style="">
			<?php $this->renderPartial('_forgot_password');?>
			</div>

			<!-- Register -->
		 
            </div>
          </div>
       

		

		</div>
		
		
		<div class="col-md-4"> 
		<div class="description-item"><i class="description-star-icon description-icon"></i> <h3 class="description-title">Don’t miss a thing</h3> <p class="description-content">Save your dream homes and stay updated on your favourite searches, across any device.</p></div>
		
		<div class="description-item"><i class="description-open-icon description-icon"></i> <h3 class="description-title">Get organised</h3> <p class="description-content">Receive open for inspection planners and our comprehensive weekly auction results.</p></div>
		
		
		<div class="description-item"><i class="description-home-icon description-icon"></i> <h3 class="description-title">Make the most of your home</h3> <p class="description-content">Claim your home and access insights and tools to help you understand the market.</p></div>
		</div>
	</div>

</div>
  
<style>input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {
    	height: 51px;
            line-height: 51px;
            padding: 0 20px;
            outline: 0;
            font-size: 15px;
            color: gray;
            margin: 0 0 16px;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);
            font-weight: 500;
            opacity: 1;
            border-radius: 3px;
    margin-left: 0 !important;
    width:100%;
}.no-padding-left{padding-left:0px;}.no-padding-right{padding-right:0px;}.pull-right{ float:right;}.forgotpassword a{color:#82addc !important;}</style>
