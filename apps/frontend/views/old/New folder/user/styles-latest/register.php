 <?php defined('MW_PATH') || exit('No direct script access allowed'); 
 ?>
 
<style>
label.validation-text{ color:#CE1137 !important; }
#signin-content form label{ font-weight:bold !important;color:#fff !important; }
#signin-content #email, #signin-content #password{ color:#000 !important; }
</style>
<?php if(Yii::app()->user->hasFlash("registered"))
{
	?>
<fieldset id="registeration-complete" class="span12">
<legend>Register</legend>
<div class="fieldset-content">
<?php 
if(Yii::app()->user->hasFlash("sendFail"))
{
	echo '<h3> '.Yii::app()->user->getFlash("sendFail"). '</h3>';
}
else
{
	?>
<h3>You're almost done!</h3>
<p>We've just sent you a verification email. Click on the verification link inside to finish registering your account.</p>
<p>
Once you've finished your account registration,
<a href="<?php echo Yii::app()->createUrl("user/signin");?>">click here to log in</a>
.
</p>
<?php
}
?>
</div>
</fieldset>
<?php 
}
else
{
	?>
<fieldset id="fbsignin-form" class="span12">
	<legend>Sign In / Register</legend>

	<div id="content-col">
		
		

		


		<h4 class="headline">Already have a <span><?php echo Yii::app()->name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		<h4 class="headline1" style="display:none">Don't have a <span><?php echo Yii::app()->name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl('user/signup');?>' onclick='return false;' id='register-link'>register</a>. (It's FREE!)</h4>
		<h4 class="headline2" style="display:none">Already have a <span><?php echo Yii::app()->name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		
		<div class="clear"></div>
		
		<ul class="tabs">
			<li id="logintab" >
				<span class="lefttab"></span>
				<a href="<?php echo Yii::app()->createUrl("user/signin");?>" onclick='return false;'>Sign In</a>
				<span class="righttab"></span>
			</li>
			<li id="registertab"  class="active">
				<span class="lefttab"></span>
				<a href="<?php echo Yii::app()->createUrl('user/signup');?>" onclick='return false;'>Register</a>
				<span class="righttab"></span>
			</li>
		</ul>

		<div class="tab_container">
			



<div id="tab1" class="tab_content">
	<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'method'=>'post',
							'focus'=>"first_name",
						  'action'=>Yii::app()->createUrl("user/signin")
							)); ?>
		<div id="register-head">
			<h4>Sign in with Facebook</h4>
			<p class="note2">Use Facebook to sign in to <?php echo Yii::app()->name;?></p>
			<a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>"  ></a>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="http://m.dbzstatic.com/assets/images/fbconnect/or.jpg" /></span>
			</div>
			 
			<div id="signin-form">
				<h4>Sign in with <?php echo Yii::app()->name;?></h4>
				<?php
				if(Yii::app()->user->hasFlash('loginfail'))
				{
					?>   
				 <div class="error1">Please enter a valid email address and password.</div>
				 <?php
			 }
			 ?>
				<div class="form-row " hint="username@provider.com">
					<label for="id_username">Email address</label>
					<input id="id_username" type="text" class="textbox required email" name="username" tabindex="1" value="" />
					<div class="clear"></div>
				</div>
				<div class="form-row " >
					<label for="id_password">Password
					<span class="forgotpassword"><a href="<?php echo Yii::app()->createUrl("user/forgot_password") ;?>">Forgot Password?</a></span>
					</label>
					<input id="id_password_hint"  type="text" minlength="5" class="textbox required" name="password" style="display:none" value="Password" tabindex="2" />
					<input id="id_password" type="password" minlength="5" class="textbox required" name="password" tabindex="2" />
					<div class="clear"></div>
				</div>
				<div class="fbsignin-button-block">
					<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
					<input type="submit" class="red awesome fbsignin-button" value="Sign In" tabindex="3" />
					<p>Don't have an account? <a href="<?php echo Yii::app()->createUrl("user/signup");?>" onclick="return false;" id="register-link">Register</a></p>
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
</div><!-- end #tab1 -->

			
				<div id="tab2" class="tab_content active_content">
					 
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'signup-form',
							'method'=>'post',
							'focus'=>"first_name",
							   
							)); ?>
						<div class="form-row no-bot-border">
							<div id="register-head">
								<h4>Create a FREE account</h4>
								<br />
								<a class="fbbtn-register-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>" ></a>
							</div>

							
							<div class="clear"></div>
						</div>

						<div id="signin-hsep">
							<span><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/or.jpg" /></span>
						</div>
						<?php
						if(Yii::app()->user->hasFlash("registerfail"))
						{
							?>
							 
							<div class="error1"> 
							<?php  echo  CHtml::errorSummary($model) ;?>
							</div>
						<?php
						}
						?>
						<?php
						if(Yii::app()->user->hasFlash("registerfail2"))
						{
							?>
							 
							<div class="error1"> 
							<?php  echo Yii::app()->user->getFlash("registerfail2") ;?>
							</div>
						<?php
						}
						?>
						<div class="form-row no-bot-border">
							<h4>Register normally</h4>
							<p class="note">Note: All fields are mandatory</p>
						</div>
						
						<div class="clear"></div>
						
						
						
						<div class="form-row" hint="username@provider.com">
							<label for="id_email">Email Address  
								
							</label>
							<input id="id_email" type="text" class="textbox" value="<?php  echo $model->email ;?>" <?php echo $model->first_name;?> name="email" maxlength="75" />
							<div class="clear"></div>
						</div>
										
						<div class="form-row" hint="username@provider.com (confirm)">
							<label for="id_email">Confirm Email
								
							</label>
							<input id="id_email2" type="text" class="textbox" name="email2" value="<?php  echo $model->email ;?>"  maxlength="75" />
							<div class="clear"></div>
						</div>

						<div class="form-row">
							<label for="id_password1">Password
								
							</label>
							<div class="multiple">
								<div class="multiple_password1">
									<input id="id_password1_hint" type="password" value="" value="Password" style="display:none" /><input id="id_password1" type="password" class="textbox" name="password1" />
								</div>
								<div class="multiple_password2">
									<input id="id_password2_hint" type="password" value="Confirm password" value="" style="display:none" /><input id="id_password2" type="password" class="textbox" name="password2" />
								</div>
							</div>
							<div class="clear"></div>
						</div>
						
						

						<div class="form-row" hint="Please enter your real name.">
							<label for="id_first_name">First Name   
								
							</label>
							<input id="id_first_name" type="text" class="textbox" value="<?php echo $model->first_name;?>" name="first_name" />
							<div class="clear"></div>
						</div>

						<div class="form-row" hint="Your last name will be kept private.">
							<label for="id_last_name">Last Name
								
							</label>
							<input id="id_last_name" type="text" class="textbox" name="last_name"  value="<?php  echo $model->last_name ;?>" />
							<div class="clear"></div>
						</div>
						
						<div class="form-row">
						<label for="id_gender">My Mother Calls Me

						</label>
						<script>
						$(function()
						{
							$("#id_gender").val('<?php echo $model->calls_me;?>')
							$("#id_dob_day").val('<?php echo @$_POST['dob_day'];?>')
							$("#id_dob_month").val('<?php echo @$_POST['dob_month'];?>')
							$("#id_dob_year").val('<?php echo @$_POST['dob_year'];?>')
							$("#id_role").val('<?php echo $model->position_level;?>')
							$("#id_education").val('<?php echo $model->education_level;?>')
						}
						
						)
						</script>
						<select name="calls_me" id="id_gender">
						<option value="" selected="selected">- Select One -  </option>
						<option value="M">Habibi (M)</option>
						<option value="F">Habibti (F)</option>
						</select>
						<div class="clear"></div>
						</div>

						<div class="form-row">
						<label for="id_dob">The world became a better place on (d.o.b)
						</label>
						<div id="bday-form">
						<span><select name="dob_day" id="id_dob_day">
						<option value="" selected="selected">Day</option>
						<option value="1">01</option>
						<option value="2">02</option>
						<option value="3">03</option>
						<option value="4">04</option>
						<option value="5">05</option>
						<option value="6">06</option>
						<option value="7">07</option>
						<option value="8">08</option>
						<option value="9">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						</select></span><span><select name="dob_month" id="id_dob_month">
						<option value="" selected="selected">Month</option>
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
						</select></span><span><select name="dob_year" id="id_dob_year">
						<option value="" selected="selected">Year</option>
						<option value="2014">2014</option>
						<option value="2013">2013</option>
						<option value="2012">2012</option>
						<option value="2011">2011</option>
						<option value="2010">2010</option>
						<option value="2009">2009</option>
						<option value="2008">2008</option>
						<option value="2007">2007</option>
						<option value="2006">2006</option>
						<option value="2005">2005</option>
						<option value="2004">2004</option>
						<option value="2003">2003</option>
						<option value="2002">2002</option>
						<option value="2001">2001</option>
						<option value="2000">2000</option>
						<option value="1999">1999</option>
						<option value="1998">1998</option>
						<option value="1997">1997</option>
						<option value="1996">1996</option>
						<option value="1995">1995</option>
						<option value="1994">1994</option>
						<option value="1993">1993</option>
						<option value="1992">1992</option>
						<option value="1991">1991</option>
						<option value="1990">1990</option>
						<option value="1989">1989</option>
						<option value="1988">1988</option>
						<option value="1987">1987</option>
						<option value="1986">1986</option>
						<option value="1985">1985</option>
						<option value="1984">1984</option>
						<option value="1983">1983</option>
						<option value="1982">1982</option>
						<option value="1981">1981</option>
						<option value="1980">1980</option>
						<option value="1979">1979</option>
						<option value="1978">1978</option>
						<option value="1977">1977</option>
						<option value="1976">1976</option>
						<option value="1975">1975</option>
						<option value="1974">1974</option>
						<option value="1973">1973</option>
						<option value="1972">1972</option>
						<option value="1971">1971</option>
						<option value="1970">1970</option>
						<option value="1969">1969</option>
						<option value="1968">1968</option>
						<option value="1967">1967</option>
						<option value="1966">1966</option>
						<option value="1965">1965</option>
						<option value="1964">1964</option>
						<option value="1963">1963</option>
						<option value="1962">1962</option>
						<option value="1961">1961</option>
						<option value="1960">1960</option>
						<option value="1959">1959</option>
						<option value="1958">1958</option>
						<option value="1957">1957</option>
						<option value="1956">1956</option>
						<option value="1955">1955</option>
						<option value="1954">1954</option>
						<option value="1953">1953</option>
						<option value="1952">1952</option>
						<option value="1951">1951</option>
						<option value="1950">1950</option>
						<option value="1949">1949</option>
						<option value="1948">1948</option>
						<option value="1947">1947</option>
						<option value="1946">1946</option>
						<option value="1945">1945</option>
						<option value="1944">1944</option>
						<option value="1943">1943</option>
						<option value="1942">1942</option>
						<option value="1941">1941</option>
						<option value="1940">1940</option>
						<option value="1939">1939</option>
						<option value="1938">1938</option>
						<option value="1937">1937</option>
						<option value="1936">1936</option>
						<option value="1935">1935</option>
						<option value="1934">1934</option>
						<option value="1933">1933</option>
						<option value="1932">1932</option>
						<option value="1931">1931</option>
						<option value="1930">1930</option>
						<option value="1929">1929</option>
						<option value="1928">1928</option>
						<option value="1927">1927</option>
						<option value="1926">1926</option>
						<option value="1925">1925</option>
						<option value="1924">1924</option>
						<option value="1923">1923</option>
						<option value="1922">1922</option>
						<option value="1921">1921</option>
						</select></span>
						</div>
						<div class="clear"></div>
						</div>
						
						<div class="form-row">
						<label for="id_nationality">My Passport tells me I am from

						</label> 
						<?php
					    echo CHtml::dropDownList('country',$model->country,CHtml::listData(Countrieslist::model()->listData(),'id','name'),array("id"=>"id_nationality", "empty"=>"- Select One -","style"=>"width:207px;")); 
					    ?>
						<div class="clear"></div>
						</div>

					<div class="form-row">
					<label for="id_role">My friends call me often, but my company calls me

					</label>
					<?php
					echo CHtml::dropDownList('position_level',$model->position_level,CHtml::listData(Occupation::model()->listData(),'occupation_id','occupation_name'),array("id"=>"id_role", "empty"=>"- Select One -","style"=>"width:207px;")); 
					?>
					<div class="clear"></div>
					</div>

						
						<div class="form-row">
						<label for="id_education">My highest academic achievement is

						</label>
						<?php
						echo CHtml::dropDownList('education_level',$model->education_level,CHtml::listData(EducationLevel::model()->listData(),'education_id','education_name'),array("id"=>"id_education", "empty"=>"- Select One -","style"=>"width:207px;")); 
						?>
						<div class="clear"></div>
						</div>
						
						<div class="cb-form-row">
							<label for="id_third_party_emails"><input checked="checked" type="checkbox" name="updates" id="id_third_party_emails" />&nbsp;Send me occasional updates about this site.</label>
							<br />
							<label for="id_dubizzle_email_updates"><input checked="checked" type="checkbox" name="advertisement" id="id_dubizzle_email_updates" />&nbsp;Send me amazing offers and bargains from our advertising partners.</label>
							<div class="clear"></div>
						</div>

						<input type="hidden" name="form_type" value="signup" id="id_form_type" />
					
						<div class="fbregister-button-block">
							<p>By clicking on Register, you agree to the <a href="<?php echo Yii::app()->createUrl('article/terms');?>" target="_blank" class="redbold">  Terms and Conditions</a> and the <a href="<?php echo Yii::app()->createUrl('article/condition');?>" target="_blank" class="redbold">  Privacy Policy</a>.</p>
							<input type="submit" class="red awesome fbregister-button" value="Register" />
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
				</div><!-- end #tab2.tab_content -->
			
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
<?php
}
?>
<div style="display:none;">

	<!-- Google Code for Place an Ad Conversion Page -->
	<script type="text/javascript">
		/* <![CDATA[ */
			
				var google_conversion_id = 975003292;
				var google_conversion_language = "en";
				var google_conversion_label = "DBqwCJz__QIQnL310AM";
			
			
			
			var google_conversion_format = "2";
			var google_conversion_color = "ffffff";
			var google_conversion_value = 0;
		/* ]]> */
	</script>
	<script type="text/javascript" src="#"></script>
	
	<noscript>
		<div style="display:inline;">
			
				<img height="1" width="1" style="border-style:none;" alt="" src="#"/>
			
			
			
		</div>
	</noscript>
</div>

                    
                </div>
