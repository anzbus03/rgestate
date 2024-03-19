<style>
	.nmc-footer-1 a { color:#222}
.disp-home{ display:none; }	 #site .disp-home{ display:block; }	.nmc-footer-1{max-width:1200px;margin-left:auto;margin-right:auto;-webkit-transition:max-width .25s ease-in;transition:max-width .25s ease-in}.nmc-footer-2{overflow:hidden;display:block;text-align:left;margin-bottom:70px;max-width:120rem}.nmc-footer-3{text-align:center;margin:0 8px 10px;line-height:30px!important;letter-spacing:normal!important;font-family:var(--main-font)!important;color:var(--head-color)!important;font-size:26px!important;font-weight:600!important}.nmc-footer-4{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:reverse;-ms-flex-direction:column-reverse;flex-direction:column-reverse}.nmc-footer-5{padding-top:1rem}.nmc-footer-5{display:block}.nmc-footer-6.active{display:block;width:100%;height:auto;position:initial}.nmc-footer-7{display:block;color:#222}.nmc-footer-7{display:inline-block;font-size:2.03rem;margin-top:2.4rem;margin-bottom:1.6rem;font-weight:700;color:#222}.nmc-footer-8{color:#515151}.nmc-footer-9{margin-top:0;margin-bottom:0}.nmc-footer-10{margin:0}.nmc-footer-11{-ms-flex-wrap:nowrap;flex-wrap:nowrap}.nmc-footer-11{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;width:100%;-ms-flex-wrap:wrap;flex-wrap:wrap}.nmc-footer-12{margin-top:.3rem;width:calc(25% - 1rem)}html[dir=rtl] .nmc-footer-12{text-align:right}.nmc-footer-12{float:left;letter-spacing:normal;margin-top:.3rem}.nmc-footer-13{margin:0 0 10px;line-height:30px!important;letter-spacing:normal!important;font-family:var(--main-font)!important;color:var(--head-color)!important;font-size:17px!important;font-weight:600!important}.nmc-footer-14{display:inline-block;width:1rem;height:1rem;margin-left:1rem;fill:#222}.nmc-footer-15{-webkit-box-flex:1;-ms-flex:1 0 33%;flex:1 0 33%;margin-bottom:0;font-size:1.106rem}.nmc-footer-16{font-size:1.4rem}.nmc-footer-17.nmc-footer-22{margin-bottom:30px;color:#000;font-weight:600;margin:5px  30px 5px 0px;border-bottom:.3rem solid var(--secondary-color)}.nmc-footer-17{margin-right:30px!important;display:inline-block;color:#767676;cursor:pointer;margin-bottom:30px;color:var(--secondary-color);font-size:19px;font-weight:600;line-height:1.8;margin:5px 0}.nmc-footer-6{position:absolute;overflow:hidden;clip:rect(0 0 0 0);height:1px;width:1px;margin:-1px;padding:0;border:0}.nmc-footer-19{overflow:hidden}.nmc-footer-20{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center}div.nmc-footer-21{color:#222;display:block;font-size:1.61rem;margin:20px 0 20px 0;font-weight:400;-webkit-tap-highlight-color:transparent}.nmc-footer-16{text-align:left}.nmc-footer-15.af2d23c9 a:hover{color:var(--secondary-color)text-decoration:underline}.nmc-footer-15.af2d23c9 a{font-size:16px;line-height:24px}.view-less{display:none!important}.lesconter{max-height:unset}.lesconterall .lesconter{max-height:unset!important}.lesconterall .view-less{display:block!important}.lesconterall .view-less svg{transform:rotate(180deg)}.lesconterall .view-al{display:none!important}
.view-al,.view-less {
    color: #222;
    display: block;
    font-size: 16px !important;
    cursor:pointer;
    margin: 20px 0 20px 0;
    font-weight: 400;
    -webkit-tap-highlight-color: transparent;
}.nmc-footer-15.af2d23c9 a {
    font-size: 15px;
    line-height: 1.5;
       font-weight: 300;
}
a.btn-more-view { color:var(--secondary-color)}
.nmc-footer-10 { display:none; }.d-none {
  display: none !important;
}a.btn-more-view {
    color: orange;
    font-weight: 600;
}  .nmc-footer-15.af2d23c9 a {
    
    font-weight: 400;
}.nmc-footer-15 {
 
    line-height: 1.3;
}
html[dir="rtl"] .nmc-footer-2{ text-align:right; }
html[dir="rtl"]  .nmc-footer-17{ margin-right:0px !important; margin-left:30px !important;}
</style>
     <script>
        function showAlllist(k){
            var ull = $(k).closest('ul');
            ull.find('li.hideles').removeClass('d-none');
            ull.find('#v_less').removeClass('d-none');
            ull.find('#v_moer').addClass('d-none');
        }
         function hideAlllist(k){
              var ull = $(k).closest('ul');
            ull.find('.hideles').addClass('d-none');
             ull.find('#v_less').addClass('d-none');
            ull.find('#v_moer').removeClass('d-none');
        }
    </script>
<script>
function setTabn(k){
	$('.nmc-footer-17').removeClass('nmc-footer-22')
	$(k).addClass('nmc-footer-22');
	$('.nmc-footer-6').removeClass('active');
	if($(k).hasClass('fon-rent-tab')){
		$('.fo-rent-inc').addClass('active');
	}
	else{
		$('.fo-sale-inc').addClass('active');
	}
}
function togleViecnt(k){
	$(k).parent().toggleClass('lesconterall');
}
</script>


<div class="">
    <div class="container mob-no-pad">
<div aria-label="Popular properties" class="nmc-footer-1 nmc-footer-2 mt-5 ">
 
<div class="main_title_3 browse no-left-border  mb-0"><h2 class="featured-title-new"><?php echo $widget['112'];?></h2></div>
<div class="nmc-footer-4">
<div class="nmc-footer-5">
<?php $this->renderPartial('_sale_links');?>
<div class="nmc-footer-6 fo-rent-inc">
<?php $this->renderPArtial('_rent_link');?>
</div>
</div>

<div>
<div class="nmc-footer-16 mt-3">
<div>
<div class="nmc-footer-17 nmc-footer-22" onclick="setTabn(this)"><?php echo $this->tag->getTag('for_sale','For Sale');?></div>

<div class="nmc-footer-17 fon-rent-tab" onclick="setTabn(this)"><?php echo $this->tag->getTag('to_rent','To Rent');?></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
