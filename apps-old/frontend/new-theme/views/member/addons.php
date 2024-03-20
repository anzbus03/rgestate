<div class="top-head text-center">
      <h1><?php echo Yii::t('app',$this->tag->getTag('{p}_packages','{p} Packages'),array('{p}'=>'<b>'.$this->project_name.'</b>'));?></h1>
         <div class="company-details">
               
                
                  <div >
                  <p class="mb-1 mt-0 font-weight-semibold"><?php echo $member->TypeTile;?></p>
                   
                  </div>
               
           </div>
             <div class="clearfix"></div>
</div> 
<style>
.alert.alert-warning li{ color:red; }
.top_cls { display:inline-block; }
    .top-head {background: #fafafa;
margin-left: -1000px;
margin-right: -1000px;
padding: 15px 0px;
margin-top: -20px;}
.subscription-row {
  
    padding: 15px;
    text-align: center;
  
    margin-bottom: 15px ;
}
#pack_1 {
    border-color: #eee;
    border-top-left-radius: 80px;
    border-top-right-radius: 80px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    border-width: 2px;
    border-style: solid;
    padding-bottom: 39px;
}
.m-b-b-nstyle { color:  var(--secondary-color); display:inline-block;padding-bottom:7px; margin-bottom:5px; font-weight:600; }
#pack_2 .price-option__cost { display:none ; }
.btm-di { background-color:#fff !important;}
.subscription-row-1 .top_cls { margin-top:0px !important ; margin-bottom:0px!important; }
.pricing.row {
    text-align: center;
    max-width: 1068px;
    margin: auto;
}
@media only screen and (max-width: 600px) {
.top_cls li {
    min-width: 100px;
margin: 0px !important;
text-align: center !important;
}.top_cls { max-width:300px;}
.price-option--low.pack_type_0.pack_type_tag_2 .top-arch, .price-option--low.pack_type_0.pack_type_tag_ .top-arch ,.price-option--low.pack_type_0.pack_type_tag_3 .top-arch{
 
    margin-top: 15px;
     
}
.main-panel {
     
    margin-left: auto !important;
    margin-right: auto !important;
}
.top-head {
   
    margin-top: -23px;
}
.top-head h1 { font-size:180%; }
}
</style>
     <script>
     function showPackage(monthly,id,k){
		  $('#pack_'+id).find('.mnly-optins').removeClass('active');
		  $('#pricing-row').attr('data-id',monthly);
		 $(k).addClass('active');
		 $('#pack_'+id).find('a.p-list').addClass('hide');
		 $('#pack_'+id).find('a.months_'+monthly).removeClass('hide');
	 }
     </script>
     	 <style>
				 .plan-details li { color:var(--black-color); line-height:16px; margin:12.5px 0px;}
				 .top_cls li { float:left; width:auto; margin-right:15px; text-align:left; cursor:pointer;}
				 html[dir='rtl'] .top_cls li { float:right; width:auto; margin-right:0px;margin-left:15px; text-align:right; }
				 .top_cls li.active,.top_cls li:hover{ color:var(--secondary-color); }
				 .top_cls   {  overflow:hidden;  margin:0; padding:0; margin-bottom:15px;}
				 .price-option__detail { padding:15px !important;}
				 .desc-det {padding-left:5px; }
				 </style>
				 <style>.offer-subs .price-option__purchase::before { content:unset !important; }</style>
<style> 
.offer-subs .price-option__detail { border: 1px solid var(--secondary-color); } 
.offer-subs .price-option__purchase {

    background: #fff !important;
    color: var(--secondary-color) !important;
    border: 0px solid var(--secondary-color);
    border-radius: 0px !important;

}</style>
<?php
 $globalTax = Tax::model()->findByAttributes(array('is_global' => Tax::TEXT_YES));
 
 
 $listPackage_ids = Package::model()->type_user_categories($this->member->user_type);
 
 
 $listing_packages = Package::model()->findFromCategoryID('L',$listPackage_ids);
 $offer_packages = Package::model()->findFromCategoryID('0',$listPackage_ids);
 $idd = '1';
 $sb_title = $this->tag->getTag('subscription_packages','Subscription Packages');
 $this->renderPartial('_subscribe_pack',compact('idd','listing_packages','sb_title','offer_packages'));
 
 $listing_packages = Package::model()->findFromCategoryID('A',$listPackage_ids);
 $idd = '2';$offer_packages =array();
 $sb_title = $this->tag->getTag('add-on_features','Add-On Features');
 $this->renderPartial('_subscribe_pack',compact('idd','listing_packages','sb_title','offer_packages'));
?>     

  
<div id="myModal11" class="modal fade" data-backdrop="static"  role="dialog" aria-labelledby="myModal3Label" aria-hidden="true">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
           <div class="modal-body" id="cn_propertys">
       <div class=" " id="raw_ht_ml11" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    
    </div>
  </div>
  <style>
 #myModal11 .mframe {
    min-height: 450px;
}
  </style>
  <script>
  function closePopupCode(){
	  $('#myModal11').modal('hide'); 
  }
  function applycouponCode1(){
	 $('#myModal11').modal('hide'); 
   
  }
  function applycouponCode2(){
	window.location.href='<?php echo Yii::app()->createUrl('member/dashboard');?>';
  }
  </script>
  	 <script>
						 var apply_promocode = '<?php echo $this->app->createUrl('member/applycode_offer');?>';
					 function OpenPromo(e){$("#myModal11").modal("show"),$("#raw_ht_ml11").html('<iframe id="ifrm11"   class="mframe" ></iframe>'),document.getElementById("ifrm11").src=apply_promocode}
					 
					 </script>
