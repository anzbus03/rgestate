<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
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
 <style>
 .kbyheJ {
    width: 100%;
    height: 48px;
    border-radius: 6px;
    box-sizing: border-box;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    -moz-box-align: center;
    align-items: center;
    transition: all 0.2s ease 0s;
     
    background-color: rgb(255, 255, 255);
    background-repeat: no-repeat;
    background-size: 24px;
    background-position: 16px center;
    margin: 12px 0px;
    -moz-box-pack: start;
    justify-content: flex-start;
    border: 1px solid #eee;
    padding-left: 60px;
    color: rgb(98, 100, 101);
    background-image: url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDgxLjc1MSA4MS43NTEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDgxLjc1MSA4MS43NTE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48Zz4KCTxwYXRoIGQ9Ik02Ni4zMSwyMS4wNzZoLTguNjU5VjUuNTIyQzU3LjY1MSwyLjQ4Myw1NS4xNjcsMCw1Mi4xMywwSDE1LjY4M2MtMy4wMzksMC01LjUyMSwyLjQ4My01LjUyMSw1LjUyMnY3MC43MDcgICBjMCwzLjAzOCwyLjQ4Myw1LjUyMiw1LjUyMSw1LjUyMkg1Mi4xM2MzLjAzNiwwLDUuNTIxLTIuNDg0LDUuNTIxLTUuNTIyVjU4LjQ3NWg4LjY1OWMyLjkxMiwwLDUuMjgtMi4zNTIsNS4yOC01LjI0NFYyNi4zMiAgIEM3MS41OSwyMy40MzEsNjkuMjIyLDIxLjA3Niw2Ni4zMSwyMS4wNzZ6IE0yOC4wNzUsMy45OGgxMS42NjFjMC4zNjgsMCwwLjY3LDAuMjk5LDAuNjcsMC42NjhjMCwwLjM2Ni0wLjMwMiwwLjY2Ny0wLjY3LDAuNjY3ICAgSDI4LjA3NWMtMC4zNjksMC0wLjY2Ny0wLjMwMS0wLjY2Ny0wLjY2N0MyNy40MDgsNC4yNzksMjcuNzA2LDMuOTgsMjguMDc1LDMuOTh6IE0zMy45MDUsNzguOTk0Yy0xLjUyMiwwLTIuNzYxLTEuMjM2LTIuNzYxLTIuNzY1ICAgYzAtMS41MjQsMS4yMzYtMi43NjEsMi43NjEtMi43NjFzMi43NjQsMS4yMzYsMi43NjQsMi43NjFDMzYuNjY4LDc3Ljc1NywzNS40Myw3OC45OTQsMzMuOTA1LDc4Ljk5NHogTTUzLjgwNyw3MS41MzVIMTQuMDAxVjguNzU3ICAgaDM5LjgwNnYxMi4zMTlIMzEuMDUyYy0yLjkwOSwwLTUuMjc2LDIuMzU1LTUuMjc2LDUuMjQ3djI2LjkxMWMwLDIuODkxLDIuMzY3LDUuMjQ0LDUuMjc2LDUuMjQ0aDMuMTg5djkuMDE1bDkuMDE2LTkuMDE1aDEwLjU1ICAgVjcxLjUzNXogTTY5LjI1NCw1My4yMzNjMCwxLjYwNC0xLjMxOCwyLjkwOC0yLjk0NCwyLjkwOEg0Mi4yOTJsLTUuNzEzLDUuNzEydi01LjcxMmgtNS41MjdjLTEuNjIxLDAtMi45NC0xLjMwNS0yLjk0LTIuOTA4ICAgVjI2LjMyMmMwLTEuNjA1LDEuMzE3LTIuOTExLDIuOTQtMi45MTFINjYuMzFjMS42MjEsMCwyLjk0NCwxLjMwNiwyLjk0NCwyLjkxMVY1My4yMzN6IE02My40MTMsMzEuNzUgICBjMCwwLjc5OS0wLjYwNiwxLjQ0NC0xLjM1MywxLjQ0NEgzNS4zNzRjLTAuNzQ1LDAtMS4zNTMtMC42NDUtMS4zNTMtMS40NDRjMC0wLjc5NCwwLjYwOC0xLjQ0MywxLjM1My0xLjQ0M0g2Mi4wNiAgIEM2Mi44MDYsMzAuMzA3LDYzLjQxMywzMC45NTYsNjMuNDEzLDMxLjc1eiBNNjMuNDEzLDM5LjU4YzAsMC44LTAuNjA2LDEuNDQ3LTEuMzUzLDEuNDQ3SDM1LjM3NGMtMC43NDUsMC0xLjM1My0wLjY0Ny0xLjM1My0xLjQ0NyAgIGMwLTAuNzkzLDAuNjA4LTEuNDQsMS4zNTMtMS40NEg2Mi4wNkM2Mi44MDYsMzguMTM5LDYzLjQxMywzOC43ODYsNjMuNDEzLDM5LjU4eiBNNjMuNDEzLDQ3LjQxYzAsMC43OTgtMC42MDYsMS40NDYtMS4zNTMsMS40NDYgICBIMzUuMzc0Yy0wLjc0NSwwLTEuMzUzLTAuNjQ4LTEuMzUzLTEuNDQ2YzAtMC43OTYsMC42MDgtMS40NDEsMS4zNTMtMS40NDFINjIuMDZDNjIuODA2LDQ1Ljk2OCw2My40MTMsNDYuNjE2LDYzLjQxMyw0Ny40MXoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0ZCNTI1MiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+");
}
.jilpeK {
    width: 100%;
    height: 48px;
    border-radius: 6px;
    box-sizing: border-box;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    -moz-box-align: center;
    align-items: center;
    transition: all 0.2s ease 0s;
    
    background-color: rgb(255, 255, 255);
    background-repeat: no-repeat;
    background-size: 24px;
    background-position: 16px center;
    margin: 12px 0px;
    -moz-box-pack: start;
    justify-content: flex-start;
    border: 1px solid #eee;;
    padding-left: 60px;
    color: rgb(98, 100, 101);
    background-image: url("data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkNDMzM7IiBkPSJNMjMuNzg3LDQ0Mi4yMTNjLTMuODM5LDAtNy42NzgtMS40NjQtMTAuNjA2LTQuMzk0Yy01Ljg1OC01Ljg1OC01Ljg1OC0xNS4zNTUsMC0yMS4yMTMgICBsMTcxLjIxMy0xNzEuMjEzYzUuODU3LTUuODU4LDE1LjM1NS01Ljg1OCwyMS4yMTMsMGM1Ljg1OCw1Ljg1Nyw1Ljg1OCwxNS4zNTUsMCwyMS4yMTNMMzQuMzk0LDQzNy44MiAgIEMzMS40NjUsNDQwLjc0OSwyNy42MjYsNDQyLjIxMywyMy43ODcsNDQyLjIxM3oiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkNDMzM7IiBkPSJNNDg4LjIxMyw0NDIuMjEzYy0zLjgzOSwwLTcuNjc4LTEuNDY0LTEwLjYwNi00LjM5NEwzMDYuMzk0LDI2Ni42MDYgICBjLTUuODU4LTUuODU4LTUuODU4LTE1LjM1NSwwLTIxLjIxM2M1Ljg1Ny01Ljg1NywxNS4zNTUtNS44NTgsMjEuMjEzLDBMNDk4LjgyLDQxNi42MDZjNS44NTgsNS44NTgsNS44NTgsMTUuMzU1LDAsMjEuMjEzICAgQzQ5NS44OTEsNDQwLjc0OSw0OTIuMDUyLDQ0Mi4yMTMsNDg4LjIxMyw0NDIuMjEzeiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRURCNDE7IiBkPSJNMjU3LDMzMWMtMy44MTgsMC03LjYzNy0xLjQ0OS0xMC41NjEtNC4zNDhMMTMuMjI3LDk1LjQzOWMtNS44ODQtNS44MzMtNS45MjQtMTUuMzMtMC4wOTItMjEuMjEzICBjNS44MzMtNS44ODMsMTUuMzMtNS45MjQsMjEuMjEzLTAuMDkxbDIyMi42MDYsMjIwLjY5OEw0NzcuNjA2LDc0LjE4YzUuODU3LTUuODU4LDE1LjM1NS01Ljg1OCwyMS4yMTMsMHM1Ljg1OCwxNS4zNTUsMCwyMS4yMTMgIEwyNjcuNjA2LDMyNi42MDZDMjY0LjY3OSwzMjkuNTM1LDI2MC44MzksMzMxLDI1NywzMzF6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRUE4MzI7IiBkPSJNNDY3LDQ1MUg0NWMtMjQuODEzLDAtNDUtMjAuMTg3LTQ1LTQ1VjEwNmMwLTI0LjgxMywyMC4xODctNDUsNDUtNDVoNDIyYzI0LjgxMywwLDQ1LDIwLjE4Nyw0NSw0NSAgdjMwMEM1MTIsNDMwLjgxMyw0OTEuODEzLDQ1MSw0NjcsNDUxeiBNNDUsOTFjLTguMjcxLDAtMTUsNi43MjktMTUsMTV2MzAwYzAsOC4yNzEsNi43MjksMTUsMTUsMTVoNDIyYzguMjcxLDAsMTUtNi43MjksMTUtMTVWMTA2ICBjMC04LjI3MS02LjcyOS0xNS0xNS0xNUg0NXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==");
}
.jilpeK.fbku.apple {
    background-image: url('https://www.feeta.pk/assets/img/apple.png')!important;
}
 .sign-in-form a.jilpeK, .sign-in-form a.kbyheJ {
    text-decoration: initial !important;border: 1px solid rgb(98, 100, 101);
    color:#000 !important;
}
 .sign-in-form a.jilpeK:hover{
    
    border: 1px solid rgb(182, 184, 185) !important; color:#000 !important;
}
 </style>
            <!-- Login -->
							<div class=" padding-top-0" style="border-top:0px;">
							  <?php
							 if($this->app->options->get('system.common.disable_login_otp','yes')=='no'){ ?> 
							 <a href="<?php echo Yii::app()->createUrl('user/signin_phone');?>" onclick="easyload(this,event,'pajax')" class="kbyheJ">Login with Mobile Number</a>
							 <?php } ?> 
							<a href="<?php echo Yii::app()->createUrl('user/signin');?>" onclick="easyload(this,event,'pajax')" class="jilpeK">Login with Email</a>
							<a href="<?php echo Yii::app()->createUrl('site/login',array('service'=>'google_oauth'));?>"  class="jilpeK gggle">Login with Google</a>
							<a href="<?php echo Yii::app()->createUrl('site/login',array('service'=>'facebook'));?>"  class="jilpeK fbku">Login with Facebook</a>
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
