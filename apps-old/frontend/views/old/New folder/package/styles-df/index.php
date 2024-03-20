<div class="packageHandFirst1">
 		<link rel="stylesheet" type="text/css" href="css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
		<section>
				<div class="tabs tabs-style-underline">
					<nav>
						<?php
						 $menuARR = array('0'=>'icon-gift','1'=>'icon-box','2'=>'icon-display');
						if($model)
						{
							?>
						<ul>
							<?php 
							foreach($model as $k=>$v)
							{
								$log= (isset($menuARR[$k]))?$menuARR[$k]:'icon-box';
								echo '<li><a href="#section-underline-'.$k.'" class="icon '.$log.'"><span>'.$v->package_name.'</span></a></li>';
							}
							?>
						</ul>
						<?
						}
						?>
					</nav>
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
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
 
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
					</style>
					<div class="content-wrap">
						<?php 
							foreach($model as $k=>$v)
							{
								 ?>
								  <section id="section-underline-<?php echo $k;?>" class="section-underline-" style="padding:10px 2px 10px 0px ">
								  
								 <table cellspacing='0' style="width:100%;"> <!-- cellspacing='0' is important, must stay -->

	<!-- Table Header -->
	<thead>
		<tr>
			<th colspan="2"> <b><?php echo $v->package_name;?></b></th>
			 
		</tr>
	</thead>
	<!-- Table Header -->

	<!-- Table Body -->
	<tbody>

		<tr>
			<td>Validity In Days</td>
			<td><?php echo $v->validity_in_days;?></td>
			 
		</tr><!-- Table Row -->

		<tr class="even">
			<td>Price Per Month</td>
			<td><?php echo $v->price_per_month ;?></td>
		</tr><!-- Darker Table Row -->

		<tr>
			<td>Logo</td>
			<td><?php echo $v->logo ;?></td>
		</tr>

		<tr class="even">
			<td>Featured Listing</td>
			<td><?php echo $v->featured;?></td>
		 
		</tr>
 

	</tbody>
	<!-- Table Body -->

</table>
<br />
<script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=vineethnjalil@gmail.com" 
    data-button="buynow" 
    data-name="any" 
    data-callback="http://dubizzlefree.com" 
    data-env="sandbox"
></script>
<a class="awesome red" href="<?php echo Yii::app()->createUrl('secure_payment/index',array('id'=>$v->package_id,"ref"=>$refenece_number,"hash"=>$hash));?>"> Upgrade to <?php echo $v->package_name;?> </a>
								  
								  </section>
								 <?
							}
					    ?>
						
						 
					</div><!-- /content -->
				</div><!-- /tabs -->
			</section>
   </div>      
<script>
(function() {

[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
new CBPFWTabs( el );
});

})();
</script>
