<?php 
if(Yii::app()->user->hasFlash('success'))
{
	?>
	<div class="confirmation"><?php echo Yii::app()->user->getFlash('success');?> </div>
	<?php
}
?>
<?php  
$form = $this->beginWidget('CActiveForm',array('focus'=>array($model,'email') ,'id'=>'sendEmail',
'enableAjaxValidation'=>true,
'clientOptions' => array(
'validateOnSubmit'=>true,
),
)); 
?>
<table style="width:350px;height:auto;">
<tr><th colspan="2"><b>Email To Friend</b>

<?php echo	$form->hiddenField($model,'url') ?>
</th></tr>
<tr><td>Your Name:</td><td><?php echo	$form->textField($model,'name',array('class'=>'textbox','placeholder'=>'Name')) ?>  <?php echo $form->error($model, 'name');?></td></tr>
<tr><td>Fried Email:</td><td><?php echo	$form->textField($model,'email',array('class'=>'textbox','placeholder'=>'Your Friends email')) ?><?php echo $form->error($model, 'email');?></td></tr>
<tr><td>Message:</td><td><?php echo	$form->textArea($model,'message',array('class'=>'textbox','placeholder'=>'Message')) ?><?php echo $form->error($model, 'message');?></td></tr>
 
<tr><td colspan="2"><button class="large blue awesome" type="button" value="Send Email" onclick=" send()">Send Email</button></td></tr>
</table>
<?php   $this->endWidget(); ?>
<style>
table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	border:none !important;
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td {
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}
 awesome {
    margin-top: 10px;
    width: 240px;
}
.blue.awesome, .blue.awesome:visited {
    background-color: #0974c8;
    border: medium none;
}
button.awesome {
    font-weight: normal !important;
    line-height: 37px !important;
}
.awesome, .awesome:visited, .medium.awesome, .medium.awesome:visited {
    border: medium none;
    border-radius: 3px;
    box-sizing: border-box;
    color: white !important;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: normal;
    letter-spacing: normal;
    line-height: 35px;
    margin: 0 auto;
    overflow: hidden;
    padding: 0 15px;
    text-align: center;
    text-decoration: none !important;
    transition: all 0.5s ease 0s;
    vertical-align: middle;
    width: auto;
}
</style>
<script type="text/javascript">
 
function send()
 {
 
   var data=$("#sendEmail").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: $("#sendEmail").attr("action"),
   data:data,
success:function(data){
               $('#fancybox-inner').html(data);
            
             
              },
   error: function(data) { // if error occured
       $('#fancybox-inner').html(data)
       //  alert(data);
    },
 
  dataType:'html'
  });
 
}
 
</script>
