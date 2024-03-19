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
           
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('success','Success');?> - <?php echo $this->tag->getTag('book_an_appointment','Book an appointment');?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
			   
			   <div class="row justify-content-center text-center">
						<div class="col-xl-12 col-lg-12">
					 
	 <style>
	 .confirm-page {
    text-align: center;
    margin: 25px 0 60px;
   
    position: relative;
 
 
}

	 </style>
	
<div class="panel-wrapper" id="contact">

<div class="container content-container    ">
    
	 <div class="confirm-page margin-bottom-0">
			<div class="row">
				<div class="col-sm-12">
					<div><img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDE1Ljg2OSA0MTUuODY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MTUuODY5IDQxNS44Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzRBODUzIiBkPSJNMTI1LjkxLDE3MC44NDFjLTUuNzQ3LTYuMjY5LTE1LjY3My02Ljc5Mi0yMS45NDMtMS4wNDVjLTYuMjY5LDUuNzQ3LTYuNzkyLDE1LjY3My0xLjA0NSwyMS45NDMgICBsNzguODksODUuNjgyYzMuMTM1LDMuMTM1LDYuNzkyLDUuMjI0LDEwLjk3MSw1LjIyNGMwLDAsMCwwLDAuNTIyLDBjNC4xOCwwLDguMzU5LTEuNTY3LDEwLjk3MS00LjcwMkw0MDMuODUzLDc4Ljg5ICAgYzYuMjY5LTYuMjY5LDYuMjY5LTE2LjE5NiwwLTIxLjk0M2MtNi4yNjktNi4yNjktMTYuMTk2LTYuMjY5LTIxLjk0MywwTDE5My44MjksMjQ0LjUwNkwxMjUuOTEsMTcwLjg0MXoiIGRhdGEtb3JpZ2luYWw9IiM0RENGRTAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiM0RENGRTAiPjwvcGF0aD4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzNEE4NTMiIGQ9Ik00MDAuMTk2LDE5Mi4yNjFjLTguODgyLDAtMTUuNjczLDYuNzkyLTE1LjY3MywxNS42NzNjMCw5Ny4xNzUtNzkuNDEyLDE3Ni41ODgtMTc2LjU4OCwxNzYuNTg4ICAgUzMxLjM0NywzMDUuMTEsMzEuMzQ3LDIwNy45MzVTMTEwLjc1OSwzMS4zNDcsMjA3LjkzNSwzMS4zNDdjOC44ODIsMCwxNS42NzMtNi43OTIsMTUuNjczLTE1LjY3M1MyMTYuODE2LDAsMjA3LjkzNSwwICAgQzkzLjUxOCwwLDAsOTMuNTE4LDAsMjA3LjkzNXM5My41MTgsMjA3LjkzNSwyMDcuOTM1LDIwNy45MzVzMjA3LjkzNS05My41MTgsMjA3LjkzNS0yMDcuOTM1ICAgQzQxNS44NjksMTk5LjA1Myw0MDkuMDc4LDE5Mi4yNjEsNDAwLjE5NiwxOTIuMjYxeiIgZGF0YS1vcmlnaW5hbD0iIzREQ0ZFMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzREQ0ZFMCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" style=" width:80px;  margin: 0 auto 50px;"></div>
					<h3 class="text-center"><?php echo $this->tag->getTag('thank_you_for_your_interest','Thank you for your Interest.');?></h3>
					<p class="text-center"><?php echo Yii::t('app', $this->tag->getTag('{p}_support_team_will_contact_','{p} Support Team will contact you soon.'),array('{p}'=>$this->project_name));?>  </p>
					<p> <a href="<?php echo Yii::app()->createUrl('member/dashboard');?>" class="btn btn-primary btn-block headfont" style="font-size: 14px;"><?php echo $this->tag->getTag('go_to_dashboard','Go to Dashboard');?></a> </p>
					</div>
			</div>
		</div>
	 
 </div>

<div class="clearfix"></div>
 </div>
	 
						</div>
					</div>
					<div class="col-sm-12">
			<p style="font-size:12px;">
				 <?php echo Yii::t('app',$this->tag->getTag('to_view_your_previous_appointm','To view your previous appointments, click here: {link}'),array('{link}'=>'<a href="'.Yii::app()->createUrl('member/bookings').'">'.$this->tag->getTag('booking_history','Booking History').'</a>'));?> 
		 <br >
		 	</p>
		 	</div>
			<Style>
			.headbd { font-weight:600;}
			</Style>
			 
            <!-- Login -->		 
		
					 
					 
				</div>
				</div>
				</div>

			 
			  
     	 
			<!-- Register -->
		 
           
            
          
         	</div>

			<!-- Register -->
		 
            </div>
         
  
        
          </div>
       
		

		</div>
		 
		
	 </div>

</div> 
