<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
     .col-sm-5 label { text-align:left;float: left; } .nolabel label { display:none; }
     .collapse:not(.in) {
    display: none;
}
.main-panel { margin-left:0px; }.myaccount-menu.is-ended{ display: none; }
#ListingUsers_password input { max-width:100%;}
 </style>
 	 <style>.pwdstrength { position:absolute; } #ListingUsers_password{position:relative; } .pwdstrengthstr{position: absolute;top: -19px;right: 3px;} </style>
						
						 
<style>
    .card-1 .subheading_font { display:block; }
    
</style>
<div class="container">

	<div class=" ">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div>
           
             <h4 class="subheading_font row bold-style">Top Up Account Balance</h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=""> 
			<div class="col-sm-12">
			    <p style="font-size:12px;" >
			 To view your previous top-up transactions, click here: <a href="<?php echo Yii::app()->createUrl('member/orders');?>">Transaction History</a><br ></p>
		 	</div>
		 	<div class="clearfix"></div>
			<Style>
			.headbd { font-weight:600;}
			</Style>
			<div class="row margin-bottom-25">
				<div class="col-sm-12">
					<div class="col-sm-4 headbd">Current Balance</div>
					<div class="col-sm-8"><?php echo $this->member->AccountBalance;?></div>
				</div>
			</div>
			<form method="GET" action ="<?php echo Yii::app()->createUrl('member/topup');?>"> 
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-4 headbd">Payment Method</div>
					<div class="col-sm-8">
					<ul class="no-padding  margin-bottom-0">
					<li><input type="radio" style="vertical-align: middle;" checked="true" value="e" name="payment" id="easychechout"> <label for="easychechout"><img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/easypng.png');?>" alt="Easy Paisa">Easy Paisa</label> </li>
					<li><input type="radio" style="vertical-align: middle;" value="b" name="payment" id="banktransfer" > <label  for="banktransfer"><img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;margin-bottom: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/bankt.png');?>" alt="Bank Transfer">Bank transfer/cash </label> </li>
					<li><input type="radio" style="vertical-align: middle;" value="t" disabled="true" name="payment" id="2checkout" > <label for="2checkout"><img style="height: 18px; vertical-align:middle;margin-left: 5px; margin-right: 5px;  " src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/2checkout.png');?>" alt="2Checkout">2Checkout</label> </li>
					
					</ul>
					
					</div>
				</div>
			</div>
					 			<div class="form-group col-sm-12  margin-bottom-10 ">

						    <div class="row">

							<div class="col-sm-4"></div>

							<div class="col-sm-8">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"  style="display:inline;min-width: 100px !important;width: 150px !important;margin-right: 20px;"    />Next</button>
							<a href="<?php echo Yii::app()->createUrl('member/dashboard');?>">Cancel</a>
							</div>
		</div> 
						 <!-- end #signin-form -->
					 </div>
			</form>
            <!-- Login -->		 
		
					 
					 
				</div>
				</div>
				</div>

			 
			  
     	 
			<!-- Register -->
		 
           
            
              <h4 class="subheading_font row bold-style">How To Pay</h4>
                  <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab2" class="col-sm-12" style="border-top: 0px solid #e0e0e0;">
	<p>Paying is easy. You can directly from any of the above options.</p>
				<hr />
				<p class="text-center">For any asistance call us at</p>
				<p class="numdet text-center"><a href="tel:<?php echo Yii::app()->options->get('system.common.assistance_nmber','+92 300 7322294');?>" style="font-size: 23px;line-height: 25px;" target="_blank"><?php echo Yii::app()->options->get('system.common.assistance_nmber','+92 300 7322294');?>  (FEETA)</a></p>
              <div class="clearfix"></div>
              </div>
              </div>
              
         	</div>

			<!-- Register -->
		 
            </div>
         
  
        
          </div>
       
		

		</div>
		 
		
	 </div>

</div> 
