<?php 
if($hasedit){
?>	
<div id="myModalAdmin" class="modal bd-example-modal-lg fade" data-backdrop="static"  role="dialog" aria-labelledby="myModalAdminLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body" id="myModalAdmin_prop">
       <div class=" " id="myModalAdmin_prop_html" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>  
<?php } ?> 
<?php
if (Yii::app()->request->isAjaxRequest) {
	?> 
	<script>$('body').attr("id","user_listing");</script>
	<title><?php  echo  $pageTitle ;  ?></title>
	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
 <?php 
}
?>
<style>
.nav>li>a{position:relative;display:inline;padding:inittial}.b_search{background:#000;color:#fff;padding:5px 10px;border-radius:10px;font-size:12px!important}.links.left{float:right;width:calc(100% - 150px)}._1gw6tte::before{display:flex!important;content:""!important}._cyy0tbl{margin-top:0!important;margin-bottom:0!important}._zdxht7{width:100%!important}._1y2fdh0{position:relative!important;background:#ec1b3b;border-top-left-radius:8px;border-top-right-radius:8px}._1hh7t3k{padding-top:32px!important;padding-bottom:32px!important}._g0mn5u4{width:100%!important;padding:0 16px!important;margin:0 auto!important;max-width:1300px!important}._g0mn5u4{padding:0 50px!important}._1dp6jee0::after{content:" "!important;display:table!important;clear:both!important}._1dp6jee0::before{content:" "!important;display:table!important}._3mg4b62{width:120px!important;float:right!important}._3mg4b62{min-height:1px!important;position:relative!important;padding-left:12px!important;padding-right:12px!important}._9grdxv{margin:0!important;overflow-wrap:break-word!important;font-size:12px!important;font-weight:600!important;line-height:1.5!important;text-transform:unset!important}._17cp9sd{letter-spacing:.5px!important}._14i3z6h{color:inherit!important;font-size:1em!important;font-weight:inherit!important;line-height:inherit!important;margin:0!important;padding:0!important}._yr6mxop{margin:0!important;overflow-wrap:break-word!important;font-size:16px!important;font-weight:400!important;line-height:1.375em!important;color:#fff!important}._12qaq5ub{font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;font-style:inherit!important;font-variant:inherit!important;line-height:inherit!important;color:#fff!important;text-decoration:none!important}._17p554h{margin-top:16px!important;display:flex!important;flex-wrap:wrap!important}._12qaq5ub{font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;font-style:inherit!important;font-variant:inherit!important;line-height:inherit!important;color:#fff!important;text-decoration:none!important}._1t4mc7d{padding:8px!important;background-color:#262626!important;border-radius:4px!important;margin-right:8px!important;margin-bottom:8px!important;letter-spacing:.5px!important;white-space:nowrap!important}._9grdxv{margin:0!important;overflow-wrap:break-word!important;font-size:12px!important;font-weight:600!important;line-height:1.33333em!important}._1gkyi0an{min-height:1px!important;position:relative!important;padding-left:12px!important;padding-right:12px!important}._b1aaqf{margin-top:24px!important}._5jxf3i2{margin:0!important;overflow-wrap:break-word!important;font-size:18px!important;font-weight:400!important;line-height:1.44444em!important}._1joc06t{display:flex!important;flex-wrap:wrap!important}._z63bg5{width:25%!important}._z63bg5._z63bg52{width:75%!important}._z63bg5{margin-top:0!important;padding-right:24px!important}._17j792vp{margin:0!important;overflow-wrap:break-word!important;font-size:16px!important;font-weight:400!important;line-height:1.375em!important;color:inherit!important}._rk98a2{margin:0!important;overflow-wrap:break-word!important;font-size:14px!important;font-weight:400!important;line-height:1.28571em!important;color:inherit!important}._17zvmwh2{margin:0!important;overflow-wrap:break-word!important;font-size:14px!important;font-weight:400!important;line-height:1.28571em!important}._1r93ihzp{margin:0!important;overflow-wrap:break-word!important;font-size:32px!important;font-weight:400!important;line-height:1.125em!important;color:#fff!important}.marketing-wrp ul li{width:100%;box-sizing:border-box;margin-bottom:15px}.marketing-wrp ul li .th{font-weight:700;width:70%;display:inline-block;font-weight:700;text-align:left}.marketing-wrp ul li .th:last-of-type{width:30%}.marketing-wrp ul{width:100%;box-sizing:border-box;padding:0 20px;margin-bottom:10px;list-style:none}.marketing-wrp ul li span{font-size:16px;display:inline-block;font-size:16px}.marketing-wrp ul li .th{font-weight:700;width:70%;display:inline-block;font-weight:700;text-align:left}.marketing-wrp{width:50%;box-sizing:border-box}.left{float:left}.marketing-wrp .viewall{color:#33a137;font-size:16px;font-weight:700;display:block;padding-left:20px}.marketing .content{padding:15px}.overview{margin-top:20px;background-color:#fff;border:1px solid #e9e9e9}._10ash0x{margin-bottom:40px!important}._cyy0tbl{margin-top:0!important;margin-bottom:0!important}._193yge5{-moz-box-direction:normal!important;-moz-box-orient:vertical!important;flex-direction:column!important;position:relative!important;flex:0 0 auto!important;padding-right:64px!important}._eu67bo{margin:0!important;font-size:32px!important;line-height:1.3}._1rac2mq{min-width:0!important;width:100%!important;margin-left:0!important}._11aj5fj2{margin:0!important;overflow-wrap:break-word!important}._g0mn5u4{padding:0 50px!important}._g0mn5u4{width:100%!important;padding:0 16px!important;margin:0 auto!important;max-width:1300px!important}._nbd2j8{display:flex!important;flex-wrap:wrap!important;width:100%;margin:-8px -16px -8px 0!important}._1912t2j{padding:8px 16px 8px 0!important;display:flex!important}._1a4cmhi{-moz-box-direction:normal!important;-moz-box-orient:vertical!important;display:flex!important;flex-direction:column!important;border:1px solid rgba(0,0,0,.1)!important;border-radius:4px!important;padding:5px 8px!important;width:100%!important}._i6s3ei{width:36px!important}._1p3joamp{margin:0!important;overflow-wrap:break-word!important;font-size:13px!important;font-weight:400!important;line-height:1.375em!important;color:#484848!important}._1jlnvra2{margin:0!important;overflow-wrap:break-word!important;font-size:13px!important;font-weight:300!important;line-height:1.28571em!important;color:#484848!important}._eu67bo{margin:0!important;font-size:32px!important}._17zvmwh2 li{list-style-type:none;float:left;padding:2px 5px;border:1px solid #707070;font-size:13px;font-weight:400;margin-right:5px;margin-bottom:5px}._18ilrswp{margin:0!important;overflow-wrap:break-word!important;font-size:14px!important;font-weight:600!important;color:#484848!important;line-height:1;margin-bottom:5px!important}._1hh7t3k{background-size:cover;background-position:center center;border-top-left-radius:8px;border-top-right-radius:8px}._eu67bo{margin:0!important;margin-bottom:0;font-size:26px!important;line-height:1.43;color:#484848;margin-bottom:15px!important}.left svg{float:left;vertical-align:bottom;width:20px;margin-top:8px}.profile-tabs{position:relative;z-index:499;-webkit-box-shadow:0 2px 3px 0 rgba(0,0,0,.25);-moz-box-shadow:0 2px 3px 0 rgba(0,0,0,.25);box-shadow:0 2px 3px 0 rgba(0,0,0,.25)}.profile-tabs ul{background-color:#fafafa}.profile-tabs ul{margin:0;padding:0}.profile-tabs ul li{display:table-cell;border-right:1px solid #eee;background:0 0;margin:0;text-transform:uppercase}.profile-tabs ul{background-color:#fafafa}.profile-tabs ul li a{color:#000;cursor:auto!important}.profile-tabs ul li a{display:block;color:#235d94;padding:20px 32px;font-size:15px;line-height:1;font-weight:400;background:#fff;background-color:#fff;text-transform:capitalize;text-decoration:none!important}.profile-tabs ul li{border-right:1px solid #ddd}.profile-tabs ul li a small{font-size:16px;padding-bottom:10px;color:#333;float:left;text-align:center;width:100%}.breadcrumb{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;padding:.75rem 1rem;padding-left:1rem;margin-bottom:1rem;list-style:none;background-color:#e9ecef;border-radius:.25rem}._1hh7t3k::before{content:'';position:absolute;left:0;right:0;top:0;bottom:0;border-top-left-radius:8px;border-top-right-radius:8px}._eu67bo{margin:0!important;margin-bottom:0;margin-bottom:0;font-size:40px!important;line-height:1.43;color:#fff;margin-bottom:15px!important;font-weight:600}.profile_detail_sec{margin-bottom:15px}.grey_drd{background:#fff;padding:15px;box-shadow:0 1px 6px 0 rgba(32,33,36,.28);border-radius:5px}.short_description{width:100%;display:block;margin-bottom:10px}.short_description_icon{width:45px;float:left;text-align:center;position:relative}.short_description_icon_details{width:calc(100% - 45px);float:right}.icon_hd_a{width:33px;display:inline;margin-right:8px;border-radius:5px}._1y2fdh0{background:var(--logo-color)}@media only screen and (max-width:600px){.mob-hide{display:none!important}.profile-tabs ul{display:block}.profile-tabs ul li{width:100%!important;display:block;border:0;border-bottom:1px solid #eee;text-align:center}.profile-tabs ul li.mob-50{width:50%!important;float:left}.profile-tabs ul li a small{padding-bottom:5px;padding-top:5px}.fdetail.margin-top-20{margin:0!important}.profile-tabs ul li a{padding:12px 8px}}span.blkstrip{padding:2px 8px;background:rgba(0,0,0,.5)}.hero-avatar--middle{margin-bottom:-67px}.hero-avatar__inner{justify-content:flex-start}.standard-agent__hero-avatar{margin-left:16px;transform:translateY(-50%)}.avatarii{border-radius:50%;height:2.5em;width:2.5em;border:2px solid #f7f8f9;background-color:#fff;background-position:top;background-size:cover}.avatar--lg-static{height:114px;width:114px}.hero-avatar{position:relative;pointer-events:none;z-index:1}.hero-avatar--left .hero-avatar__inner{justify-content:flex-start}.hero-avatar__inner{margin-left:auto;margin-right:auto;max-width:1110px;min-height:104px;display:flex}._1hh7t3k{min-height:160px}.nav-tabs>li>a{background:#ff3855!important;color:#fff!important}.nav-tabs>li.active>a{background:#fff!important;color:#888!important}@media only screen and (max-width:600px){ol.breadcrumb{display:none!important;margin:0}.check-mb .b_search{display:none}.profile_detail_sec{margin-bottom:0!important}.check-mb .links.left{width:100%!important}a.viewAllrent{max-width:calc(50% - 5px);padding:5px 10px;padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;line-height:1.5;text-align:center;margin-bottom:20px;margin-top:0}.buttons .button-secondary{box-shadow:unset!important}.buttons.desktop{display:none}.myaccount-menu.is-ended{display:none}html .col-sm-6.spl-cls,html .col-sm-6.spl-cls2{width:calc(50% - 3px);text-align:center;padding:5px 10px;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;border:0!important}.buttons.for-mobile{position:fixed;bottom:-4px;width:100%;left:0;right:10px;z-index:1111;background:#fff;padding:5px 0;box-shadow:0 1px 6px 0 rgba(32,33,36,.28)}html h3.headline{font-size:18px!important;line-height:26px!important}._eu67bo{font-size:25px!important}ol.breadcrumb{white-space:nowrap;display:inline-block;overflow:hidden}}.short_description{width:100%;display:block;margin-bottom:10px}.short_description_50{width:50%;float:left;min-width:100px}.short_description_icon{width:45px;float:left;text-align:left;position:relative;text-align:center}.short_description_icon img{width:23px!important;vertical-align:top}.short_description_icon_details{width:calc(100% - 45px);float:right}.short_description_icon_details_text{font-size:14px;color:#4d4d4d;font-weight:400;line-height:1}.v{font-size:18px;color:#ccc}.col-sm-6.spl-cls,.col-sm-6.spl-cls2{width:calc(50% - 5px)}.col-sm-6.spl-cls{margin-right:5px!important}.col-sm-6.spl-cls2{margin-left:5px!important}
html[dir='rtl'] .b_search { float: right; }

html[dir='rtl'] .left ,html[dir='rtl'] .left svg{
    float: right;
}html[dir='rtl'] .links.left{ float: left;}
html[dir='rtl']  .short_description_icon{float: right;}
html[dir='rtl'] .icon_hd_a {
     
    margin-right:0px;
    margin-left: 8px;
  
}
</style>
<div class="profile_detail_sec margin-bottom-0">
 <?php
	   $referer = $this->app->request->urlReferrer ;
	   
	   $return_title = $this->tag->getTag('back_to_search','Back to Search');
			$return_url = $referer; 
		 
	  ?>
	    
    <div class="row ad-bg" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px;background:#fff;">
		<div class="container check-mb">
			
			<span><a href="<?php echo $return_url;?>" onclick="easyload(this,event,'mainContainerClass')" class="b_search" > &lt; <?php echo $return_title;?></a></span>
		
		
				<div class="links left">
				<a class="left" href="<?php echo  Yii::App()->createUrl('user_listing/index');?>" onclick="easyload(this,event,'mainContainerClass')" title="<?php echo $model->typeTile;?>"><?php echo $model->typeTile;?></a>
				<?php
				if(!empty($model->state_name)){ ?> 
				<svg width="8" height="8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path fill="#474E52" d="M4.7 2.4a.5.5 0 0 1 .6-.8l8 6a.5.5 0 0 1 0 .8l-8 6a.5.5 0 0 1-.6-.8L12.167 8 4.7 2.4z"></path>
						</svg>
				<a class="left" href="<?php echo  Yii::App()->createUrl('user_listing/index',array('regn'=>$model->state_slug));?>" onclick="easyload(this,event,'mainContainerClass')"  title="<?php echo $model->state_name;?>"><?php echo $model->state_name;?></a>
				<?php } ?> 
				<svg width="8" height="8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path fill="#474E52" d="M4.7 2.4a.5.5 0 0 1 .6-.8l8 6a.5.5 0 0 1 0 .8l-8 6a.5.5 0 0 1-.6-.8L12.167 8 4.7 2.4z"></path>
						</svg>
				<span class="left"><?php echo $model->companyName;?></span>
				</div>
		
		
		</div>
		</div>
  <?php $image = '';?> 
  </div>
  <div class="container">
  
   <div class="_1gw6tte">
   <section id="Section5" class="_156oly8" data-reactroot="">
      <div class="_cyy0tbl" style="margin-top:0;margin-bottom:0">
         <div>
            <div>
               <div class="_zdxht7">
                  <section>
					  <?php 	  $coverimage =   $model->CoverImageFile ;?> 
                     <div class="_1y2fdh0" >
                        <div class="_1hh7t3k"  style="background-image:url('<?php echo $coverimage;?>');">
                           <div class="rter" >
                              <div>
                                 <div class="_1dp6jee0 container">
                                    <div class="_3mg4b62">
                                       <div style="margin-right:15px">
                                          <div>
                                             <div style="margin-top:8px;margin-bottom:8px">
                                                <div itemprop="name">
												
                                                </div>
                                             </div>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php
	$image_list = $model->generateLogoImage();
	if(!empty($image_list)){

	?>
	<section class="hero-avatar hero-avatar--left hero-avatar--middle"><div class="hero-avatar__inner"><div class="standard-agent__hero-avatar"><div class="avatarii avatar--lg-static" style="background-image:url('<?php echo $image_list;?>')"></div></div></div></section>
	<?php 
	}
	?>
  
   
   <div class="_1i55nil">
      <div></div>
   </div>
   <div></div>
</div>
   
   </div>
   
<div class="container margin-top-30">
<div class="row" style="margin-right: 0px;">
<div class="col-sm-8">
<div class="_1gw6tte">
   <div class="_10ash0x" style="margin-top:0x;margin-bottom:32px" data-reactroot="">
      <section id="Section6" class="_156oly8">
         <div class="_cyy0tbl" style="margin-top:0;margin-bottom:0">
            <div>
               <div>
                  <section>
                     <div class="_1t0h0lo">
                       
                     
                         <div class="_193yge5 padding-right-0" style="padding-right:0px !important;  ">
                           <div>
                              <h3 class="headline" style="margin-left:0px;"><?php echo $model->comPanyName;?> <?php echo $model->VerifiedTitles;?> <?php if($hasedit){ ?> <a href="javascript:void(0)"  onclick="UpdatePropertyDetais(this)" data-href="<?php echo $model->BackendUpdateURl;?>" class="pull-right" ><i class="fa fa-edit"></i></a> <?php } ?>  <br><small><?php echo $model->typeTile;?></small></h3>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="_1rac2mq">
                           <section>
                              <div class="_11oyobo"><div class="_11aj5fj2"><?php echo nl2br($model->description);?></div></div>
                           </section>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>

 <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','dealer'=>$model->slug));?>" class="_5923kg viewAllrent salep rnded" style="border-color: rgb(224, 224, 224); text-decoration-color: rgb(70, 4, 121);"><span class="_l3bsjs sle"><?php echo $this->tag->getTag('view_all_properties_for_sale','View all properties for sale');?></span><span class="_8kak1d sle"><svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;"><path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path></svg></span></a>
             
  	 <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-rent','dealer'=>$model->slug));?>" class="_5923kg viewAllrent rentp rnded" style="border-color: rgb(224, 224, 224); text-decoration-color: rgb(70, 4, 121);"><span class="_l3bsjs sle"><?php echo $this->tag->getTag('view_all_properties_for_rent','View all properties for rent');?></span><span class="_8kak1d sle"><svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;"><path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path></svg></span></a>
              

</div>

<div class="col-sm-4"  >
	
	  <div class="relative spanseaddress grey_drd">
                  <h4 style="margin-bottom:15px;"><img class="icon_hd_a" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzMwMHB4JyB3aWR0aD0nMzAwcHgnICBmaWxsPSIjZWMxYjNiIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTAwIDEwMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHBhdGggZD0iTTExLjIsNzcuNGg0Ljh2MTEuMmMwLDMuNCwyLjgsNi4yLDYuMiw2LjJoNjQuOWMzLjQsMCw2LjItMi44LDYuMi02LjJWMTEuNGMwLTMuNC0yLjgtNi4yLTYuMi02LjJIMjIuMiAgYy0zLjQsMC02LjIsMi44LTYuMiw2LjJ2MTEuMmgtNC44Yy0yLjUsMC00LjUsMi00LjUsNC41djIuMmMwLDIuNSwyLDQuNSw0LjUsNC41aDQuOHYxMC43aC00LjhjLTIuNSwwLTQuNSwyLTQuNSw0LjV2Mi4yICBjMCwyLjUsMiw0LjUsNC41LDQuNWg0Ljh2MTAuN2gtNC44Yy0yLjUsMC00LjUsMi00LjUsNC41djIuMkM2LjcsNzUuNCw4LjcsNzcuNCwxMS4yLDc3LjR6IE0zMSw3MS42YzAtMy43LDEuOC03LjMsNC44LTkuNSAgYzUtMy42LDkuNy02LDEwLjgtNi41YzAuMS0wLjEsMC4yLTAuMiwwLjItMC40di0zLjVjLTAuOS0xLjUtMS40LTMuMi0xLjYtNC43Yy0wLjUsMC0xLjItMC44LTItMy40Yy0xLTMuNiwwLjEtNC4yLDEtNC4xICBjLTAuNy0xLjktMC43LTMuOC0wLjItNS41YzAuNS0yLDEuNi0zLjcsMi44LTQuOWMwLjgtMC44LDEuNy0xLjYsMi42LTIuMmMwLjgtMC41LDEuNi0xLDIuNS0xLjNsMCwwYzAuNy0wLjIsMS41LTAuNCwyLjMtMC40ICBjMi41LTAuMiw0LjQsMC40LDUuOCwxLjJjMiwxLjEsMi44LDIuNiwyLjgsMi42czUuMSwwLjQsMi45LDExLjFjMC43LDAuMiwxLjIsMS4yLDAuNCw0Yy0xLDMuNS0xLjksMy43LTIuNCwzLjMgIGMtMC4yLDEuMi0wLjYsMi41LTEuMiwzLjhjMCwxLjcsMCwzLjQsMCw0YzAsMC4yLDAuMSwwLjMsMC4yLDAuNGMxLjEsMC41LDUuOCwyLjksMTAuOCw2LjVjMywyLjIsNC44LDUuNyw0LjgsOS41djAuOSAgYzAsMS4zLTEsMi4zLTIuMywyLjNIMzMuM2MtMS4zLDAtMi4zLTEtMi4zLTIuM1Y3MS42eiI+PC9wYXRoPjwvc3ZnPg=="><?php echo $this->tag->getTag('contact_information','Contact Information');?></h4>
                  
                  <div class="short_description ">
                  <div class="short_description_icon">
					  <img src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMiIgdmlld0JveD0iLTEgMCA1MTIgNTEyLjAwMSIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Zz48cGF0aCBkPSJtMTE5Ljc2NTYyNSAyMDQuNjAxNTYyYzAgNDYuNzc3MzQ0IDM4LjA1NDY4NyA4NC44MzIwMzIgODQuODMyMDMxIDg0LjgzMjAzMiAxMS4wMjczNDQgMCAxOS45NjA5MzggOC45Mzc1IDE5Ljk2MDkzOCAxOS45NjA5MzcgMCAxMS4wMjczNDQtOC45MzM1OTQgMTkuOTYwOTM4LTE5Ljk2MDkzOCAxOS45NjA5MzgtNjguNzg5MDYyIDAtMTI0Ljc1MzkwNi01NS45NjQ4NDQtMTI0Ljc1MzkwNi0xMjQuNzUzOTA3IDAtNjguNzkyOTY4IDU1Ljk2NDg0NC0xMjQuNzU3ODEyIDEyNC43NTM5MDYtMTI0Ljc1NzgxMiA2OC43OTI5NjkgMCAxMjQuNzU3ODEzIDU1Ljk2NDg0NCAxMjQuNzU3ODEzIDEyNC43NTc4MTIgMCAxMS4wMjM0MzgtOC45Mzc1IDE5Ljk2MDkzOC0xOS45NjA5MzggMTkuOTYwOTM4LTExLjAyMzQzNyAwLTE5Ljk2MDkzNy04LjkzNzUtMTkuOTYwOTM3LTE5Ljk2MDkzOCAwLTQ2Ljc3NzM0My0zOC4wNTg1OTQtODQuODM1OTM3LTg0LjgzNTkzOC04NC44MzU5MzdzLTg0LjgzMjAzMSAzOC4wNTg1OTQtODQuODMyMDMxIDg0LjgzNTkzN3ptMTUuNjgzNTk0IDE3Ni41NTA3ODJjLTUxLjIyMjY1Ny01Ni4wODk4NDQtOTUuNDU3MDMxLTEwNC41MzUxNTYtOTUuNTI3MzQ0LTE3Ni43NDYwOTQuMTA1NDY5LTkwLjY5NTMxMiA3My45ODA0NjktMTY0LjQ4NDM3NSAxNjQuNjc1NzgxLTE2NC40ODQzNzUgOTAuNjk5MjE5IDAgMTY0LjU3MDMxMyA3My43ODkwNjMgMTY0LjY3NTc4MiAxNjQuNDg0Mzc1LjAxNTYyNCAxMS4wMTk1MzEgOC45NDkyMTggMTkuOTQxNDA2IDE5Ljk2MDkzNyAxOS45Mzc1aC4wMjM0MzdjMTEuMDIzNDM4LS4wMTE3MTkgMTkuOTUzMTI2LTguOTYwOTM4IDE5LjkzNzUtMTkuOTg0Mzc1LS4wNjI1LTU0LjYwMTU2My0yMS4zNzEwOTMtMTA1LjkyMTg3NS02MC4wMDM5MDYtMTQ0LjUxMTcxOS0zOC42MzI4MTItMzguNTkzNzUtODkuOTg0Mzc1LTU5Ljg0NzY1Ni0xNDQuNTkzNzUtNTkuODQ3NjU2LTU0LjYwNTQ2OCAwLTEwNS45NTcwMzEgMjEuMjUzOTA2LTE0NC41OTM3NSA1OS44NDc2NTYtMzguNjI4OTA2IDM4LjU4OTg0NC01OS45NDE0MDYgODkuOTEwMTU2LTYwLjAwMzkwNiAxNDQuNTU0Njg4LjAzOTA2MjUgMzkuNzc3MzQ0IDExLjA4NTkzOCA3Ny4wOTc2NTYgMzMuNzc3MzQ0IDExNC4wOTM3NSAxOS42NDQ1MzEgMzIuMDM1MTU2IDQ1LjE2Nzk2OCA1OS45ODQzNzUgNzIuMTkxNDA2IDg5LjU3ODEyNSAyNi40OTIxODggMjkuMDE1NjI1IDUzLjg5MDYyNSA1OS4wMTU2MjUgNzUuNzY5NTMxIDkzLjYzMjgxMiAzLjc5Njg3NSA2LjAwNzgxMyAxMC4yNjk1MzEgOS4yOTY4NzUgMTYuODkwNjI1IDkuMjk2ODc1IDMuNjQ4NDM4IDAgNy4zMzU5MzgtLjk5NjA5NCAxMC42NDg0MzgtMy4wODk4NDQgOS4zMTY0MDYtNS44OTA2MjQgMTIuMDk3NjU2LTE4LjIxODc1IDYuMjA3MDMxLTI3LjUzOTA2Mi0yMy43NjU2MjUtMzcuNTk3NjU2LTUyLjM3MTA5NC02OC45MjU3ODEtODAuMDM1MTU2LTk5LjIyMjY1NnptMzcwLjMyMDMxMiA5LjU3ODEyNWMtMy45Mzc1IDQuMzA4NTkzLTkuMzI4MTI1IDYuNDkyMTg3LTE0LjczNDM3NSA2LjQ5MjE4Ny00LjgxMjUgMC05LjYzNjcxOC0xLjcyNjU2Mi0xMy40NjQ4NDQtNS4yMjY1NjJsLTIuNS0yLjI4NTE1NnY2Ni4wNTA3ODFjMCAzMS4wMTE3MTktMjUuMjEwOTM3IDU2LjIzODI4MS01Ni4xOTUzMTIgNTYuMjM4MjgxaC0xMTIuMTcxODc1Yy0zMC45ODQzNzUgMC01Ni4xOTUzMTMtMjUuMjI2NTYyLTU2LjE5NTMxMy01Ni4yMzgyODF2LTY1LjEzNjcxOWwtMS41IDEuMzcxMDk0Yy04LjEzNjcxOCA3LjQ0MTQwNi0yMC43NjE3MTggNi44NzUtMjguMjAzMTI0LTEuMjYxNzE5LTcuNDM3NS04LjEzNjcxOS02Ljg3MTA5NC0yMC43NjU2MjUgMS4yNjU2MjQtMjguMjAzMTI1bDEwMy4wMjczNDQtOTQuMTk1MzEyYzIxLjc3MzQzOC0xOS45MDIzNDQgNTQuNjA5Mzc1LTE5LjkwMjM0NCA3Ni4zNzg5MDYgMGw2Ni4wMTE3MTkgNjAuMzU1NDY4Yy43MzA0NjkuNTc4MTI1IDEuNDE3OTY5IDEuMjA3MDMyIDIuMDU4NTk0IDEuODc4OTA2bDM0Ljk2MDkzNyAzMS45NjA5MzhjOC4xMzY3MTkgNy40Mzc1IDguNzAzMTI2IDIwLjA2NjQwNiAxLjI2MTcxOSAyOC4xOTkyMTl6bS03MC42MjEwOTMtMzcuNTE5NTMxLTYwLjYwOTM3Ni01NS40MTAxNTdjLTYuNDE0MDYyLTUuODYzMjgxLTE2LjA4NTkzNy01Ljg2MzI4MS0yMi41IDBsLTYxLjYwOTM3NCA1Ni4zMjAzMTN2MTAxLjY0MDYyNWMwIDguOTk2MDkzIDcuMzAwNzgxIDE2LjMxNjQwNiAxNi4yNzczNDMgMTYuMzE2NDA2aDExMi4xNjc5NjljOC45NzI2NTYgMCAxNi4yNzM0MzgtNy4zMjAzMTMgMTYuMjczNDM4LTE2LjMxNjQwNnptMCAwIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiM1NkNDRjIiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+PC9nPiA8L3N2Zz4=" />
                  </div>
                  <div class="short_description_icon_details">
                   
                  <div class="short_description_icon_details_value"><?php echo !empty($model->address) ? $model->address : $model->state_name  ;?></div>
                  </div>
                  <div class="clearfix"></div>
                  </div>
                 	<?php
					if(!empty($model->website) ){ ?> 
                 	<div class="short_description ">
					<div class="short_description_icon">
<img src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDQ4MCA0ODAiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGc+PHBhdGggZD0ibTI0MCAwYy0xMzIuNTQ2ODc1IDAtMjQwIDEwNy40NTMxMjUtMjQwIDI0MHMxMDcuNDUzMTI1IDI0MCAyNDAgMjQwIDI0MC0xMDcuNDUzMTI1IDI0MC0yNDBjLS4xNDg0MzgtMTMyLjQ4NDM3NS0xMDcuNTE1NjI1LTIzOS44NTE1NjItMjQwLTI0MHptMjA3LjU2NjQwNiAzMjQuMDc4MTI1LTY4LjI1MzkwNiAxMS43NzczNDRjNy44MTI1LTI4LjY1MjM0NCAxMi4wMzEyNS01OC4xNjQwNjMgMTIuNTU4NTk0LTg3Ljg1NTQ2OWg3MS45Mjk2ODdjLS45MDIzNDMgMjYuMTE3MTg4LTYuMzk4NDM3IDUxLjg3MTA5NC0xNi4yMzQzNzUgNzYuMDc4MTI1em0tNDMxLjM2NzE4Ny03Ni4wNzgxMjVoNzEuOTI5Njg3Yy41MjczNDQgMjkuNjkxNDA2IDQuNzQ2MDk0IDU5LjIwMzEyNSAxMi41NTg1OTQgODcuODU1NDY5bC02OC4yNTM5MDYtMTEuNzc3MzQ0Yy05LjgzNTkzOC0yNC4yMDcwMzEtMTUuMzMyMDMyLTQ5Ljk2MDkzNy0xNi4yMzQzNzUtNzYuMDc4MTI1em0xNi4yMzQzNzUtOTIuMDc4MTI1IDY4LjI1MzkwNi0xMS43NzczNDRjLTcuODEyNSAyOC42NTIzNDQtMTIuMDMxMjUgNTguMTY0MDYzLTEyLjU1ODU5NCA4Ny44NTU0NjloLTcxLjkyOTY4N2MuOTAyMzQzLTI2LjExNzE4OCA2LjM5ODQzNy01MS44NzEwOTQgMTYuMjM0Mzc1LTc2LjA3ODEyNXptMjE1LjU2NjQwNi0yNy40NzI2NTZjMjguNzQ2MDk0LjM2NzE4NyA1Ny40MjE4NzUgMi45ODQzNzUgODUuNzYxNzE5IDcuODMyMDMxbDI4LjIzODI4MSA0Ljg3MTA5NGM4LjY3NTc4MSAyOS41MjM0MzcgMTMuMzQzNzUgNjAuMDc4MTI1IDEzLjg3ODkwNiA5MC44NDc2NTZoLTEyNy44Nzg5MDZ6bTg4LjQ4ODI4MS03LjkzNzVjLTI5LjIzODI4MS00Ljk5NjA5NC01OC44MjgxMjUtNy42OTUzMTMtODguNDg4MjgxLTguMDYyNXYtOTZjNDUuODYzMjgxIDQuNDA2MjUgODUuNzAzMTI1IDQ2LjM5ODQzNyAxMDguMjgxMjUgMTA3LjUxMTcxOXptLTEwNC40ODgyODEtOC4wNjI1Yy0yOS42NjAxNTYuMzY3MTg3LTU5LjI0MjE4OCAzLjA2NjQwNi04OC40ODA0NjkgOC4wNjI1bC0xOS44MDA3ODEgMy40MjU3ODFjMjIuNTc4MTI1LTYxLjEyODkwNiA2Mi40MTc5NjktMTAzLjEzNjcxOSAxMDguMjgxMjUtMTA3LjUyMzQzOHptLTg1Ljc1MzkwNiAyMy44MzIwMzFjMjguMzM1OTM3LTQuODQ3NjU2IDU3LjAwNzgxMi03LjQ2NDg0NCA4NS43NTM5MDYtNy44MzIwMzF2MTAzLjU1MDc4MWgtMTI3Ljg3ODkwNmMuNTM1MTU2LTMwLjc2OTUzMSA1LjIwMzEyNS02MS4zMjQyMTkgMTMuODc4OTA2LTkwLjg0NzY1NnptLTQyLjEyNSAxMTEuNzE4NzVoMTI3Ljg3ODkwNnYxMDMuNTUwNzgxYy0yOC43NDYwOTQtLjM2NzE4Ny01Ny40MjE4NzUtMi45ODQzNzUtODUuNzYxNzE5LTcuODMyMDMxbC0yOC4yMzgyODEtNC44NzEwOTRjLTguNjc1NzgxLTI5LjUyMzQzNy0xMy4zNDM3NS02MC4wNzgxMjUtMTMuODc4OTA2LTkwLjg0NzY1NnptMzkuMzkwNjI1IDExMS40ODgyODFjMjkuMjM4MjgxIDUuMDAzOTA3IDU4LjgyNDIxOSA3LjcxNDg0NCA4OC40ODgyODEgOC4xMDU0Njl2OTZjLTQ1Ljg2MzI4MS00LjQxMDE1Ni04NS43MDMxMjUtNDYuNDAyMzQ0LTEwOC4yODEyNS0xMDcuNTE1NjI1em0xMDQuNDg4MjgxIDguMTA1NDY5YzI5LjY2MDE1Ni0uMzkwNjI1IDU5LjI0MjE4OC0zLjEwMTU2MiA4OC40ODA0NjktOC4xMDU0NjlsMTkuODAwNzgxLTMuNDI1NzgxYy0yMi41NzgxMjUgNjEuMTI4OTA2LTYyLjQxNzk2OSAxMDMuMTM2NzE5LTEwOC4yODEyNSAxMDcuNTIzNDM4em04NS43NTM5MDYtMjMuODc1Yy0yOC4zMzU5MzcgNC44NDc2NTYtNTcuMDA3ODEyIDcuNDY0ODQ0LTg1Ljc1MzkwNiA3LjgzMjAzMXYtMTAzLjU1MDc4MWgxMjcuODc4OTA2Yy0uNTM1MTU2IDMwLjc2OTUzMS01LjIwMzEyNSA2MS4zMjQyMTktMTMuODc4OTA2IDkwLjg0NzY1NnptNTguMTE3MTg4LTExMS43MTg3NWMtLjUyNzM0NC0yOS42OTE0MDYtNC43NDYwOTQtNTkuMjAzMTI1LTEyLjU1ODU5NC04Ny44NTU0NjlsNjguMjUzOTA2IDExLjc3NzM0NGM5LjgzNTkzOCAyNC4yMDcwMzEgMTUuMzMyMDMyIDQ5Ljk2MDkzNyAxNi4yMzQzNzUgNzYuMDc4MTI1em00Ny42MDE1NjItOTMuNzEwOTM4LTY1LjQyNTc4MS0xMS4yODkwNjJjLTExLjc2MTcxOS0zOC4zNzEwOTQtMzMuNzY1NjI1LTcyLjgwODU5NC02My42NDg0MzctOTkuNjAxNTYyIDU1Ljg3ODkwNiAxOC42NDg0MzcgMTAyLjIxODc1IDU4LjQ1NzAzMSAxMjkuMDc0MjE4IDExMC44OTA2MjR6bS0yNjkuODcxMDk0LTExMC44OTA2MjRjLTI5Ljg4MjgxMiAyNi43OTI5NjgtNTEuODg2NzE4IDYxLjIzMDQ2OC02My42NDg0MzcgOTkuNjAxNTYybC02NS40MjU3ODEgMTEuMjg5MDYyYzI2Ljg1NTQ2OC01Mi40MzM1OTMgNzMuMTk1MzEyLTkyLjI0MjE4NyAxMjkuMDc0MjE4LTExMC44OTA2MjR6bS0xMjkuMDc0MjE4IDMxNC4zMTI1IDY1LjQyNTc4MSAxMS4yODkwNjJjMTEuNzYxNzE5IDM4LjM3MTA5NCAzMy43NjU2MjUgNzIuODA4NTk0IDYzLjY0ODQzNyA5OS42MDE1NjItNTUuODc4OTA2LTE4LjY0ODQzNy0xMDIuMjE4NzUtNTguNDU3MDMxLTEyOS4wNzQyMTgtMTEwLjg5MDYyNHptMjY5Ljg3MTA5NCAxMTAuODkwNjI0YzI5Ljg4MjgxMi0yNi43OTI5NjggNTEuODg2NzE4LTYxLjIzMDQ2OCA2My42NDg0MzctOTkuNjAxNTYybDY1LjQyNTc4MS0xMS4yODkwNjJjLTI2Ljg1NTQ2OCA1Mi40MzM1OTMtNzMuMTk1MzEyIDkyLjI0MjE4Ny0xMjkuMDc0MjE4IDExMC44OTA2MjR6bTAgMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojNTZDQ0YyIiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPjwvZz4gPC9zdmc+" />
					</div>
				
					<div class="short_description_icon_details">
				 
					<div class="short_description_icon_details_value" style="margin-bottom: 10px;direction: ltr;unicode-bidi: embed;"><?php echo !empty($model->website) ? $model->website : '--' ;?></div>
					</div>
				
					<div class="clearfix"></div>
					</div>
                   	<?php } ?> 
                     <div class="clearfix"></div>
                 
					  
					
					 
				 
					 	<div class="clearfix"></div>
				 
					<div class="short_description">
					<div class="short_description_icon">
						<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yOTguNjY3LDI1LjZoLTg1LjMzM2MtNC43MSwwLTguNTMzLDMuODIzLTguNTMzLDguNTMzYzAsNC43MSwzLjgyMyw4LjUzMyw4LjUzMyw4LjUzM2g4NS4zMzMgICAgYzQuNzEsMCw4LjUzMy0zLjgyMyw4LjUzMy04LjUzM0MzMDcuMiwyOS40MjMsMzAzLjM3NywyNS42LDI5OC42NjcsMjUuNnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6IzU2Q0NGMiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM1OC40LDI1LjZoLTguNTMzYy00LjcxLDAtOC41MzMsMy44MjMtOC41MzMsOC41MzNjMCw0LjcxLDMuODIzLDguNTMzLDguNTMzLDguNTMzaDguNTMzICAgIGM0LjcxLDAsOC41MzMtMy44MjMsOC41MzMtOC41MzNDMzY2LjkzMywyOS40MjMsMzYzLjExLDI1LjYsMzU4LjQsMjUuNnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6IzU2Q0NGMiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHBhdGggZD0iTTI2Ni41OTgsNDM1LjJIMjQ1LjQxYy0xMi45NzksMC0yMy41NDMsMTAuNTY0LTIzLjU0MywyMy41NDN2NC4xMjJjMCwxMi45NzksMTAuNTY0LDIzLjUzNSwyMy41MzUsMjMuNTM1aDIxLjE4OCAgICBjMTIuOTc5LDAsMjMuNTQzLTEwLjU1NiwyMy41NDMtMjMuNTM1di00LjEyMkMyOTAuMTMzLDQ0NS43NjQsMjc5LjU2OSw0MzUuMiwyNjYuNTk4LDQzNS4yeiBNMjczLjA2Nyw0NjIuODY1ICAgIGMwLDMuNTY3LTIuOTAxLDYuNDY4LTYuNDY4LDYuNDY4SDI0NS40MWMtMy41NzUsMC02LjQ3Ny0yLjkwMS02LjQ3Ny02LjQ2OHYtNC4xMjJjMC0zLjU3NSwyLjkwMS02LjQ3Nyw2LjQ3Ny02LjQ3N2gyMS4xOCAgICBjMy41NzYsMCw2LjQ3NywyLjkwMSw2LjQ3Nyw2LjQ3N1Y0NjIuODY1eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojNTZDQ0YyIiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMzcwLjIyNywwSDE0MS43ODFjLTE3LjAwNywwLTMwLjg0OCwxMy44NDEtMzAuODQ4LDMwLjg0OHY0NTAuMzA0YzAsMTcuMDA3LDEzLjg0MSwzMC44NDgsMzAuODQ4LDMwLjg0OGgyMjguNDM3ICAgIGMxNy4wMDcsMCwzMC44NDgtMTMuODQxLDMwLjg0OC0zMC44MzlWMzAuODQ4QzQwMS4wNjcsMTMuODQxLDM4Ny4yMjYsMCwzNzAuMjI3LDB6IE0zODQsNDgxLjE1MiAgICBjMCw3LjU5NS02LjE3OCwxMy43ODEtMTMuNzczLDEzLjc4MUgxNDEuNzgxYy03LjYwMywwLTEzLjc4MS02LjE4Ny0xMy43ODEtMTMuNzczVjMwLjg0OGMwLTcuNTk1LDYuMTc4LTEzLjc4MSwxMy43ODEtMTMuNzgxICAgIGgyMjguNDM3YzcuNjAzLDAsMTMuNzgxLDYuMTg3LDEzLjc4MSwxMy43ODFWNDgxLjE1MnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6IzU2Q0NGMiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHBhdGggZD0iTTM5Mi41MzMsNTEuMkgxMTkuNDY3Yy00LjcxLDAtOC41MzMsMy44MjMtOC41MzMsOC41MzN2MzU4LjRjMCw0LjcxLDMuODIzLDguNTMzLDguNTMzLDguNTMzaDI3My4wNjcgICAgYzQuNzEsMCw4LjUzMy0zLjgyMyw4LjUzMy04LjUzM3YtMzU4LjRDNDAxLjA2Nyw1NS4wMjMsMzk3LjI0NCw1MS4yLDM5Mi41MzMsNTEuMnogTTM4NCw0MDkuNkgxMjhWNjguMjY3aDI1NlY0MDkuNnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6IzU2Q0NGMiIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+" />
					</div>
					<div class="short_description_icon_details">
				 		<?php $phone =  !empty($model->full_number) ? $model->full_number : $model->phone;?>
				 		
				 	<?php
				 	$strlength = strlen($phone);$startStr = $strlength- 5; 
				 	$phone_n = substr($phone,0,$startStr).'XXXXXX';
				 	?>
				 		
					<div class="short_description_icon_details_value"><a href="tel:<?php echo $phone;?>" dir="ltr" onclick="$(this).html($(this).attr('data-phone'))" data-phone="<?php echo $phone;?>" ><?php echo $phone_n;?></a></div>
					</div>
					<div class="clearfix"></div>
					</div>
					 
					  
		 		 	 	<div class="clearfix"></div>
				 <?php
				 if(!empty( $model->mobile)){ ?> 
					<div class="short_description">
					<div class="short_description_icon">
						<img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDgyLjYgNDgyLjYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ4Mi42IDQ4Mi42OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiPjxnPjxnPgoJPHBhdGggZD0iTTk4LjMzOSwzMjAuOGM0Ny42LDU2LjksMTA0LjksMTAxLjcsMTcwLjMsMTMzLjRjMjQuOSwxMS44LDU4LjIsMjUuOCw5NS4zLDI4LjJjMi4zLDAuMSw0LjUsMC4yLDYuOCwwLjIgICBjMjQuOSwwLDQ0LjktOC42LDYxLjItMjYuM2MwLjEtMC4xLDAuMy0wLjMsMC40LTAuNWM1LjgtNywxMi40LTEzLjMsMTkuMy0yMGM0LjctNC41LDkuNS05LjIsMTQuMS0xNCAgIGMyMS4zLTIyLjIsMjEuMy01MC40LTAuMi03MS45bC02MC4xLTYwLjFjLTEwLjItMTAuNi0yMi40LTE2LjItMzUuMi0xNi4yYy0xMi44LDAtMjUuMSw1LjYtMzUuNiwxNi4xbC0zNS44LDM1LjggICBjLTMuMy0xLjktNi43LTMuNi05LjktNS4yYy00LTItNy43LTMuOS0xMS02Yy0zMi42LTIwLjctNjIuMi00Ny43LTkwLjUtODIuNGMtMTQuMy0xOC4xLTIzLjktMzMuMy0zMC42LTQ4LjggICBjOS40LTguNSwxOC4yLTE3LjQsMjYuNy0yNi4xYzMtMy4xLDYuMS02LjIsOS4yLTkuM2MxMC44LTEwLjgsMTYuNi0yMy4zLDE2LjYtMzZzLTUuNy0yNS4yLTE2LjYtMzZsLTI5LjgtMjkuOCAgIGMtMy41LTMuNS02LjgtNi45LTEwLjItMTAuNGMtNi42LTYuOC0xMy41LTEzLjgtMjAuMy0yMC4xYy0xMC4zLTEwLjEtMjIuNC0xNS40LTM1LjItMTUuNGMtMTIuNywwLTI0LjksNS4zLTM1LjYsMTUuNWwtMzcuNCwzNy40ICAgYy0xMy42LDEzLjYtMjEuMywzMC4xLTIyLjksNDkuMmMtMS45LDIzLjksMi41LDQ5LjMsMTMuOSw4MEMzMi43MzksMjI5LjYsNTkuMTM5LDI3My43LDk4LjMzOSwzMjAuOHogTTI1LjczOSwxMDQuMiAgIGMxLjItMTMuMyw2LjMtMjQuNCwxNS45LTM0bDM3LjItMzcuMmM1LjgtNS42LDEyLjItOC41LDE4LjQtOC41YzYuMSwwLDEyLjMsMi45LDE4LDguN2M2LjcsNi4yLDEzLDEyLjcsMTkuOCwxOS42ICAgYzMuNCwzLjUsNi45LDcsMTAuNCwxMC42bDI5LjgsMjkuOGM2LjIsNi4yLDkuNCwxMi41LDkuNCwxOC43cy0zLjIsMTIuNS05LjQsMTguN2MtMy4xLDMuMS02LjIsNi4zLTkuMyw5LjQgICBjLTkuMyw5LjQtMTgsMTguMy0yNy42LDI2LjhjLTAuMiwwLjItMC4zLDAuMy0wLjUsMC41Yy04LjMsOC4zLTcsMTYuMi01LDIyLjJjMC4xLDAuMywwLjIsMC41LDAuMywwLjggICBjNy43LDE4LjUsMTguNCwzNi4xLDM1LjEsNTcuMWMzMCwzNyw2MS42LDY1LjcsOTYuNCw4Ny44YzQuMywyLjgsOC45LDUsMTMuMiw3LjJjNCwyLDcuNywzLjksMTEsNmMwLjQsMC4yLDAuNywwLjQsMS4xLDAuNiAgIGMzLjMsMS43LDYuNSwyLjUsOS43LDIuNWM4LDAsMTMuMi01LjEsMTQuOS02LjhsMzcuNC0zNy40YzUuOC01LjgsMTIuMS04LjksMTguMy04LjljNy42LDAsMTMuOCw0LjcsMTcuNyw4LjlsNjAuMyw2MC4yICAgYzEyLDEyLDExLjksMjUtMC4zLDM3LjdjLTQuMiw0LjUtOC42LDguOC0xMy4zLDEzLjNjLTcsNi44LTE0LjMsMTMuOC0yMC45LDIxLjdjLTExLjUsMTIuNC0yNS4yLDE4LjItNDIuOSwxOC4yICAgYy0xLjcsMC0zLjUtMC4xLTUuMi0wLjJjLTMyLjgtMi4xLTYzLjMtMTQuOS04Ni4yLTI1LjhjLTYyLjItMzAuMS0xMTYuOC03Mi44LTE2Mi4xLTEyN2MtMzcuMy00NC45LTYyLjQtODYuNy03OS0xMzEuNSAgIEMyOC4wMzksMTQ2LjQsMjQuMTM5LDEyNC4zLDI1LjczOSwxMDQuMnoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiIHN0eWxlPSJmaWxsOiM1NkNDRjIiPjwvcGF0aD4KPC9nPjwvZz4gPC9zdmc+" />
					</div>
					<div class="short_description_icon_details">
			 		<?php $phone =   $model->mobile;?>
					<div class="short_description_icon_details_value"><?php
				     $data1  = 	explode(',' ,$phone ) ; 
				     if(!empty($data1)){
				          $count = 0 ;
				        foreach($data1 as $ph){
				                 $count++; 
				            	$strlength = strlen($ph);$startStr = $strlength- 5; 
				            	$phone_n = substr($ph,0,$startStr).'XXXXXX';
				            ?> 
				            <a href="tel:<?php echo $ph;?>" onclick="$(this).html($(this).attr('data-phone'))" data-phone="<?php echo $ph;?>" ><?php echo $phone_n;?></a>
				            <?php
				            if( $count < sizeOf($data1) ){ echo ' , ' ;  }
				           
				        }
				     }
					
					 ?></div>
					</div>
					<div class="clearfix"></div>
					</div>
				<?php } ?> 
					
                 
                  <div class="clearfix"></div>
               </div>
        
	<div class="clearfix"></div>
	
	<div class="  margin-top-20">
 		<div class="m-mob-dip">
 		 <div class="buttons">
			 <div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;width:100% !important">
    <a type="button"     style="color:#fff;padding-left: 2px;padding-right: 2px;" onclick="OpenCallNew(this)" data-phone="<?php echo base64_encode($model->contactPhone);?>" data-testid="lead-form-submit" style="margin-bottom:8px" class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('call', 'Call') ;?></a>
    <a type="button"   onclick="OpenWhatsappNew(this)" data-href="<?php echo Yii::t('app','https://wa.me/{number}',array('{number}'=>Yii::t('app',  $model->contactPhone,array('+'=>'',' '=>''))  ));?>" target="_blank" style="color:#fff" onclick="$(this).html($(this).attr('data-phone') "   data-testid="lead-form-submit" style="margin-bottom:8px" class=" br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp"><i class="fa fa-whatsapp" style="font-size: 20px;margin-right: 3px;"></i> </a>
    <a type="button" onclick="OpenFormAgentClickNew(this)" data-reactid="<?php echo $model->user_id;?>" data-testid="lead-form-submit" style="margin-bottom:8px" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope"  style="font-size: 20px;margin-right: 3px;"></i><?php echo $this->tag->getTag('email', 'Email') ;?></a>
    
    </div>
    
     </div>   
	</div>
					
 	<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
	 
	<div class="clearfix"></div>
	
 
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php $this->renderPartial('_recent_listing');?>
<div class="clearfix"></div>


</div> 
 
