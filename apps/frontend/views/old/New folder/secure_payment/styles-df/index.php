<section id="billing-form-section" class="page-sections">
<div id="header-box" class="product-price-box">
	<span class="top-border"></span>
	<div class="product-price-box-content">
		<div class="row"><h1>Payment Summary</h1></div>
		<div class="products-row" id="products">
			<div class="product-list products-row__cell">
				
					<span class="product-info"> <?php echo $package->package_name;?>/<?php echo $package->validity_in_days;?> days validity  / <?php echo $package->max_listing_per_day;?> Ad listing </span>
				
				<span class="product-ref">ref: <?php echo $ref;?></span>
			</div>
			<span class="price products-row__cell"><?php echo $package->price_per_month;?> AED  </span>
		</div>
		<div class="row" id="charged-msg">
			<div class="charged-msg-wrapper">
				<span class="charged-msg-text">You will be charged:</span>
				<span class="charged-msg-price"><?php echo $package->price_per_month;?> AED</span>
			</div>
		</div>
	</div>
</div>
                
<div class="wrapper">
    <div class="billing-info-box">
        <div class="billing-info-header">
            <h2>Billing Information</h2>
        </div>
        <div class="form-container">
            <?php  

					$form = $this->beginWidget('CActiveForm',array( 'action'=>Yii::app()->createUrl('secure_payment/expresscheckout') ,
					'enableAjaxValidation'=>true,
					'clientOptions' => array(
					'validateOnSubmit'=>true,
					),
					)); 
					;?>
                <div class="paypal-container">
                    <div class="paypal-content">
                        <div class="paypal-button">
							<form action='expresscheckout.php' METHOD='POST'>
								
								
					
								
								
								
								
							<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
						
                            <p><small>* All payments via PayPal are in USD($).</small></p>
                        </div>
                        <div class="cf credit-card-wrapper">
                            <div class="or-container"><span class="or">OR</span><span class="or-line"></span></div>
                            <p class="enter-card-details-below">Enter your card details below <img src="/media/dist/img/visa.png" alt=""><img src="/media/dist/img/mastercard.png" alt=""></p>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget();?>
            

            
             
        </div>


    </div>
</div>
<div class="help-dialog"></div>

 </section>
