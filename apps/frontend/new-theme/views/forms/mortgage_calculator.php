<script> $(function(){calculate();	}) </script>

<style>
 .input-group-prepend{margin-right:-1px}.input-group-append,.input-group-prepend{display:-ms-flexbox;display:flex}.mb-4,.my-4{margin-bottom:1.5rem!important}.input-group{position:relative;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-align:stretch;align-items:stretch;width:100%}.input-group-text{display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;padding:.375rem .75rem;margin-bottom:0;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;text-align:center;white-space:nowrap;background-color:#e9ecef;border:1px solid #ced4da;border-radius:.25rem;border-top-right-radius:.25rem;border-bottom-right-radius:.25rem}.input-group>.custom-select:not(:first-child),.input-group>.form-control:not(:first-child){border-top-left-radius:0;border-bottom-left-radius:0}.input-group>.custom-file,.input-group>.custom-select,.input-group>.form-control,.input-group>.form-control-plaintext{position:relative;position:relative;-ms-flex:1 1 0%;flex:1 1 0%;min-width:0;margin-bottom:0}.form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;border-top-left-radius:.25rem;border-bottom-left-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}._25ff1ae0.active{background-color:#fff;border-color:var(--secondary-color);}
 .calc-form{width:100%;background-color:#fbfbfb;border-radius:5px;padding:2rem;border:.1rem solid #e9e9e9;min-height:39rem;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;display:flex}.desc-home-loa1{flex:1}.desc-home-loa2{flex:1;max-width:33.3333%}.banktitle{font-size:1.596rem;margin-bottom:2rem}._7037ac23{-webkit-box-align:center;-ms-flex-align:center;align-items:center}._25ff1ae0:nth-child(4n+1){margin-left:0}._25ff1ae0{cursor:pointer;height:100px;display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-align:end;-ms-flex-align:end;align-items:flex-end;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;border:1px solid #ededed;width:100px;margin-left:1rem;background-color:#fff}._37c79aee{padding:1px;width:100%;height:100%;-o-object-fit:contain;object-fit:contain}.f8e07919{margin-bottom:1rem}._8fd21c44{font-size:1.596rem}.b80c8da3,.e2f653d1{display:-webkit-box;display:-ms-flexbox;display:flex}.b80c8da3{-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.e2f653d1{position:relative;width:48%}.f9791146{width:48%}._429e92a0{position:absolute;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);top:54%;right:.8rem;text-align:center;font-size:1.092rem}._4af25e7c{width:100%;font-size:1.596rem;border:.1rem solid #ededed;border-radius:.5rem;padding-left:0;padding-right:3.6rem;text-align:right;height:3.8rem;margin-bottom:0;background-color:#fff;-webkit-appearance:none}._7ee0988b{position:absolute;top:30%;right:.8rem;text-align:center;width:1rem;font-size:1.19rem}.bacaa057{position:relative;width:30%}._456543e2{border-radius:0 .5rem .5rem 0;width:70%}._7134f994{background-color:#fafafa;font-weight:700;font-size:1.596rem;text-align:right;width:100%;height:3.8rem;padding:0 2rem 0 .8rem;margin-bottom:0;border-radius:.5rem 0 0 .5rem;border:.1rem solid #ededed;border-right-color:#ededed;border-right-style:solid;border-right-width:.1rem;border-right:none}._9d8a67fa{padding:1.8rem 2.5rem;text-align:center;border-bottom:.1rem solid #ededed;border-top:.1rem solid #ededed}._45d93c7a,._4a5199e2,.e8bd05eb{font-size:18px;color:#333;display:block}._4a5199e2{font-size:1.19rem;margin-bottom:2rem}.e8bd05eb{font-size:2.898rem}._45d93c7a,._4a5199e2,.e8bd05eb{display:block;font-size:20px;font-weight:600}.modal#myModal6{position:fixed}.modal#myModal6{background:rgba(0,0,0,.7)!important}.modal#myModal6{margin:auto!important;width:unset;left:0;right:0!important}.modal#myModal6 .modal-dialog{margin:auto!important;width:90%;max-width:600px}
._45d93c7a, ._4a5199e2, .e8bd05eb {
    display: block;
  font-size: 1.596rem;
font-weight: normal;
    white-space: nowrap;
}

</style>
<script>
$(function(){
	$('input#total_prce').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#total_prce_v').val( value ).change();;
      
    }
});
	$('input#loan_period').rangeslider({
    polyfill : false,
    onInit : function() {
    },
    onSlide : function( position, value ) {
       
        $('#loan_period_v').val( value ).change();
       
    }
});

initializeDownPAyment();
inititalizeInterestSlider();
	
	})
	
	
</script>

 
    <div class=" margin-bottom-40 " style="max-width:800px;">
       
      <div class="  ">
		  <div class="col-sm-12 calc-form  margin-bottom-40 " style="padding:0px;padding-top:10px;">
        <div class="col-sm-8 desc-home-loa1" style="padding:30px;">
			  <div class="b80c8da3 margin-top-0 margin-bottom-0 mb-ddf" style="flex-direction: column;">
	 
			<div class="_7037ac23" style="width:100%;margin-bottom:0px;order:2">
				
				<?php
				$bnk_name = ''; 
				foreach($banks as $k=>$v){ 
					if($k==0){
						$intersst_rate   = $v->interest_rate ;
						$down_payment_percentage   = $v->down_payment ;
						$bank_id = $v->bank_id;
							$bnk_name = $v->bank_name; 
					}
					
					?> 
					<a href="javascript:void(0)" onclick="setPackage(this)" data-bank_id="<?php echo $v->bank_id;?>"  data-bank-name="<?php echo $v->bank_name;?>"  data-price="10000" data-interest="<?php echo $v->interest_rate;?>" data-down="<?php echo $v->down_payment;?>" >
				<span class="_25ff1ae0 _77166936 <?php echo $k=='0' ? 'active':'';?>"><img src="<?php echo $v->getFilePath($v->logo);?>" alt="<?php echo $v->bank_name;?>" class="_37c79aee"></span>
				</a>
				 <?php } ?> 
				</div>
					<div class="e2f653d1" style="width:100%;margin-bottom: 10px;order:1"><div class="_8fd21c44"><?php echo $this->tag->getTag('bank','Bank');?> : <span id="bnk_name" style="color: var(--secondary-color);"><?php echo $bnk_name;?></span></div></div>
			</div>
        <input type="hidden" id="bank_id" name="bank" value="<?php echo $bank_id;?>" >
        <div class="f8e07919"><div class="_8fd21c44"><?php echo $this->tag->gettag('property_price','Property Price');?></div><div class="b80c8da3">
		 
			<div class="  f9791146 " style="position: relative;">
				<?php 
				$max_value = 1000000; 
				$total_price = 10000; 
				$loan_period  = 1 ; 
				 
				$down_payment_v =   $total_price*($down_payment_percentage/100) ;
				$loan_amount =   $total_price-$down_payment_v;
				
				?> 
				<input    type="range" class="range"  id="total_prce"   min="0"   data-id="lf_price"    max="<?php echo $max_value;?>"  value="<?php echo  $total_price;?>"   data-orientation="horizontal"  >
			</div><div class="e2f653d1"><span class="_429e92a0"><?php echo CURRENCY_CODE;?></span><input class="_112578cb _4af25e7c" id="total_prce_v" onchange="  calculate();" value="<?php echo $total_price;?>"></div></div></div>
        <div class="f8e07919"><div class="_8fd21c44"><?php echo $this->tag->gettag('loan_period','Loan Period');?></div><div class="b80c8da3"><div class="  f9791146 " style="position: relative;">
        	<?php 
				$max_value = 20; $value_now = $loan_period; ?> 
				<input    type="range" class="range" id="loan_period"   min="1"   data-id="lf_price"    max="<?php echo $max_value;?>"  value="<?php echo $value_now;?>"   data-orientation="horizontal"  >
		
        </div><div class="e2f653d1"><span class="_429e92a0 _3efbbd8c">Years</span><input class="_112578cb _4af25e7c _4146adcd" id="loan_period_v" value="<?php echo $value_now;?>" onchange="calculate();"></div></div></div>
        <div class="f8e07919"><div class="_8fd21c44"><?php echo $this->tag->gettag('down_payment','Down Payment');?></div><div class="b80c8da3 dn-pyment"><div class=" f9791146 " style="position: relative;">
			
			
        	<?php 
				$max_value = 75;$min_value = 25; $value_now = $down_payment_percentage; ?> 
				<input    type="range" class="range" id="down_payment"   min="<?php echo $min_value;?>"   data-id="lf_price"    max="<?php echo $max_value;?>"  value="<?php echo $value_now;?>"   data-orientation="horizontal"  >
		
			
			 </div><div class="e2f653d1"><div class="bacaa057"><span class="_7ee0988b">%</span><input class="_7134f994" disabled="" id="down_payment_v" onchange="calculate()" value="<?php echo $value_now;?>"></div><span class="_429e92a0"><?php echo CURRENCY_CODE;?></span><input class="_112578cb _4af25e7c _456543e2" id="down_payment_v_t" disabled value="<?php echo $down_payment_v;?>"></div></div></div>
        <div class="f8e07919"><div class="_8fd21c44"><?php echo $this->tag->gettag('interest_rate','Interest Rate');?></div><div class="b80c8da3"><div class=" f9791146 _5ebb2780" style="position: relative;">
        <?php 
				$max_value = 100;$min_value = 1; $value_now = $intersst_rate; ?> 
				<input    type="range" class="range" id="interest_rate" disabled   min="<?php echo $min_value;?>"   data-id="lf_price"    max="<?php echo $max_value;?>"  value="<?php echo $value_now;?>"   data-orientation="horizontal"  >
		
        </div><div class="e2f653d1"><span class="_429e92a0">%</span><input class="_112578cb _4af25e7c" disabled="" id="interest_rate_v" onchange="calculate()" value="<?php echo $value_now;?>"></div></div></div>
          
         </div>
        <div class="col-sm-4 bg-white pull-right desc-home-loa2">
			
			<div class="_9d8a67fa" style="border-top:0px;"><span class="_4a5199e2"><?php echo $this->tag->gettag('monthly_payment','Monthly Payment');?></span><span class="_45d93c7a"><?php echo CURRENCY_CODE;?></span><span class="e8bd05eb" id="monthly_pay">353</span></div>
			
			<div class="_9d8a67fa c4bbf5b9"><span class="_4a5199e2"><?php echo $this->tag->gettag('bank_loan_amount','Bank Loan Amount');?></span><span class="_45d93c7a"><?php echo CURRENCY_CODE;?></span><span class="e8bd05eb _01ff48b8" id="total_html"><?php echo $loan_amount;?></span></div>
        
            <div class="_9d8a67fa"><button class="_13ffc6c2 headerModalOpener " style="width:100%;background-color:var(--secondary-color);border:1px solid var(--secondary-color);margin: 0px; border-radius:5px; font-size:17px;padding: 13px 8px;height: auto;" aria-label="Apply loan" onclick="OpenSignupRequiredNew2(this)" data-nextclick="2" ><?php echo $this->tag->gettag('apply_for_loan','APPLY FOR LOAN');?></button><div></div></div>
            <script>
			var application_form_url = '<?php echo Yii::App()->CreateUrl('detail/applyloan');?>'
       		function OpenSignupRequiredNew2(e) {
     
    var t = $(e).attr("data-nextclick");
    void 0 !== $("#post-property") && $("#post-property").submit(), void 0 === t ? $("#signin-form").submit() : ("1" == t && setTimeout(function() {
        OpenApplication2(e)
    }, 500), "2" == t && setTimeout(function() {
        OpenApplication(e)
    }, 500))
}
		
        </script>
    
        
          </div>
      
      </div>
      </div>
   
   <div class="clearfix"></div>
    </div>
  
