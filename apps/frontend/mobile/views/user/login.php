<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Sign In / Register</h2>
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
            <li class="active"><a href="#tab1">Sign In</a></li>
            <li id="acc_li"><a href="#tab2">Create an account</a></li>
          </ul>
          <div class="tabs-container alt"> 

            <!-- Login -->
			<div class="tab-content" id="tab1" style="">
			<?php $this->renderPartial('_login_partial');?>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">
			<?php   $this->renderPartial('_register_partial');?>
			</div>
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
 	<style>
 	._o2jk4c {
  
    list-style: none;
}
		.fam {
    font: normal normal normal 14px/1 FontAwesome;
        font-style: normal;
        font-variant-caps: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 1;
        font-family: FontAwesome;
        font-variant-alternates: normal;
        font-variant-east-asian: normal;
        font-variant-ligatures: normal;
        font-variant-numeric: normal;
        font-variant-position: normal;
    font-size: inherit;
    text-rendering: auto;
}
							.services .auth-services {float:left;}
.auth-icon.google, .auth-icon.google_oauth {
background: unset; 
 background: #dd4b39 none repeat scroll 0 0;
    color: #fff;
    font-size: 15px;
    line-height: 28px;
    width: 140px;
}
.auth-icon.facebook {
background: unset; 
 background: #3b5998 none repeat scroll 0 0;
    color: #fff;
    font-size: 15px;
    line-height: 32px;
    width: 140px;
}
li.auth-service { width: 140px; } 
ul.auth-services {
 
 display:inline-block;
 margin:auto;
}
  .auth-icon i {
	  display: inline-block;
    float: left;
    height: 32px;
    line-height:32px;
    width: 32px;
	 
}
  .auth-icon span {
	  display: inline-block;
    
    width: calc( 100% - 32px);
    text-align:left;
    padding-left:10px; line-height: 36px;
	 
}

.google_oauth i::before {
    content: "\f1a0";
    
}
.auth-icon.facebook i::before {
       content: "\f09a" !important
}
.auth-icon.facebook::before{  content: "" !important;	 }
 .facebook::before {
    visibility: hidden;
}
.auth-icon.facebook i { margin:0px !important; }


 .auth-icon:hover  i,.auth-icon:focus  i{ background:#000 !important;  }  
.google_oauth i{ background:#e46f61 !important;}
.facebook i{ background:#627aad !important;}
				
				
				.separator {
    border-bottom: 1px solid rgba(0,0,0,0.1);
    position: relative;
    margin-top: 45px;
    margin-bottom: 45px;
    text-align: center;
}
.separator span {
    position: absolute;
    left: 50%;
    margin-left: -23px;
    top: -17px;
    background: #fff;
    padding: 5px 0;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 50%;
    -webkit-border-radius: 50%;
    width: 35px;
    text-align: center;
}		
span._social{ font-weigh:800px; display:inline-block;
	
	font-family: 'Circular', sans-serif !important;
     color: rgb(72, 72, 72) !important;
    font-size: 1em !important; float:left;
    font-weight: 800 !important; }	.services { float:left;}
							</style> 
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
}.no-padding-left{padding-left:0px;}.no-padding-right{padding-right:0px;}.pull-right{ float:right;}.forgotpassword a{color:#82addc !important;}

</style>
