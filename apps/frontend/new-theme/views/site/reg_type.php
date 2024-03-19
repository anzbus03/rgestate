<div style="width:400px;height:300px;margin:auto; border: 1px solid #eee;">
    <div style="padding: 15px 10px;font-size: 20px;font-weight: bold;border-bottom: 1px solid #eee;">
        
        Please Select Account Type
    
    </div>
    <div style="padding: 15px 10px;">
        
         <?php
         $model = new ListingUsers();
	$merge_array = array_filter($_GET);
	$query = '';
	if(!empty($merge_array)){
	$query = http_build_query($merge_array);
	}
	$saveUrl = Yii::app()->createUrl('user/signupajax');
	$saveUrl = $saveUrl.'?'.$query ; 
	
	$form = $this->beginWidget('CActiveForm', array(
	'id' => 'werwer',
	'action'=>Yii::app()->createUrl('user/signup'),
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	'validateOnChange'=>false,
	'afterValidate' => 'js:function(form, data, hasError) { 
	if(hasError) {
	return false;
	}
	else
	{
	$("#reg_btn").val("Processing...");
	ajaxSubmitHappenFav2(form, data, hasError,"'.$saveUrl.'"); 
	}
	}',
	),
	'htmlOptions'=>array('class'=>'form   phs','style'=>'margin-top: 5px;' ),
	));
	$model->first_name =$eauth->name;
	$model->email =     $eauth->email;
	$model->email_verified = '1';
	$model->registered_via = @$serviceName;
	?>
<div class="clear"></div>	
<?php 
echo $form->hiddenField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
echo $form->error($model, 'email');?>
<?php 
if(!empty($model->first_name)){
echo $form->hiddenField($model , 'first_name', array_merge($model->getHtmlOptions('first_name')));
echo $form->error($model, 'first_name');
}
echo $form->hiddenField($model , 'email_verified'); 
echo $form->hiddenField($model , 'registered_via'); 
?>
<div class="clearfix"></div>
<?php
if(empty($model->first_name)){ ?>
<div class="form-row  col-sm-12 no-padding-left" hint="">
		<label for="id_first_name">Full Name: <i class="im im-icon-User"></i>
		<?php 
		echo $form->textField($model , 'first_name', array_merge($model->getHtmlOptions('first_name'),array("placeholder"=>"Full Name." ,'class'=>''))); 
		?>
		  </label>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clear"></div>
		</div>		
<?php } ?>
 <div class="form-group">
        <div class="form-row ">
          <label class="form-check-label" for="gridCheck">
           Register Me &nbsp;&nbsp;
          </label>
          <div class="clearfix"></div>
           <?php
           $user_type_array = $model->getUserType();
           foreach( $user_type_array as $k=>$v){
			   $checked =  $k=='A' ? true :false ; 
			   echo '<label style="width:auto;float:left;display: inline-block;">'.$form->radioButton($model, 'user_type',$model->getHtmlOptions('user_type',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>'width:auto;display: inline-block;float-left;height: auto;'))).'&nbsp;'.$v.'&nbsp;&nbsp;</label>';
		   }
		   ?>
			<div class="clearfix"></div>
      <?php echo $form->error($model, 'user_type');?>
		<div class="clearfix"></div>

</div>
</div>
 <div class="clearfix"></div>  
   
<div class="form-row col-sm-6 no-padding-left" style="width:50%;float:left" hint="">
<label for="id_email">Password: <i class="im im-icon-Lock-2"></i>
<?php 
echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=>"Password" ,'class'=>''))); 
?>
</label>
<?php echo $form->error($model, 'password');?>
<div class="clear"></div>
</div>

<div class="form-row  col-sm-6   pull-right no-padding-right" style="width:50%;float:left"  hint="">
<label for="id_email">Confirm Password: <i class="im im-icon-Lock-2"></i>		
<?php 
echo $form->passwordField($model , 'con_password', array_merge($model->getHtmlOptions('con_password'),array("placeholder"=>"Password(confirm)" ,'class'=>''))); 
?>
</label>
<?php echo $form->error($model, 'con_password');?>
<div class="clear"></div>
</div>
<div class="clearfix"></div>
 
	 

	<div class="clearfix"></div>

 <div class="clearfix"></div> 
    <div class="fbregister-button-block"> 
    <input type="submit" class="red awesome fbregister-button frebites_button" id="reg_btn" value="Register" />
    <div class="clear"></div>
    </div>
    <?php $this->endWidget();?>
		 

    
    </div>
    <div style="clear:both"></div>
</div>
<div id="dialog"></div>
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
<style>
.clearfix { clear:both; }
.mmenu-trigger ,#header.sub .header-widget { display:none !important;}
._8dapkt { display:none; !important; }
    .red{  background-color: #FF5A5F;
  
    padding: 9px 20px;
    color: #fff;
    position: relative;
    font-size: 15px;
    font-weight: 600;
    display: inline-block;
    transition: all .2s ease-in-out;
    cursor: pointer;
    margin-right: 6px;
    overflow: hidden;
    border: 0;
    border-radius: 5px;
 
    }
    .errorMessage {color:red;font-size: 11px; }
     #header.sub { display:none !important; }
  select  {
    height: 51px;
    line-height: 51px;
    padding: 0 20px;
    outline: 0;
    font-size: 15px;
    color: gray;
    margin: 0 0 16px;
        margin-left: 0px;
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
    width: 100%;
}
    
</style>
<script type="text/javascript">
 function 	 my_redirect_function(){
		<?php 
			$code = 'if (window.opener) {';
			$code .= 'window.close();';
		    $code .= 'window.opener.location = \''.addslashes($redirect_url).'\';'; 
		    $code .= '}';
			$code .= 'else {';
			$code .= 'window.location = \''.addslashes($redirect_url).'\';';
		    $code .= '}';
			echo $code;
		?>
 }
	</script>
<script>
   function  ajaxSubmitHappenFav2(form, data, hasError,saveUrl)
		{
		if(!hasError)
		{

		$.ajax({

		"type":"POST",
		"url":saveUrl,
		"data":form.serialize(),
		"success":function(data){
		var data = JSON.parse(data);
		if(data.status=='1'){ 
                my_redirect_function();
		}
		else{
		alert('logged in failed ') 
		}

		},

		});
		}
		else
		{ 
		alert('error');
		}
		} 
    
</script>
