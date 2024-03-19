<?php
if (Yii::app()->request->isAjaxRequest) {
	?> 
	<script>$('body').attr("id","user_listing");</script>
	<title><?php  echo  $pageTitle ;  ?></title>
	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
 <?php 
}
?>
<style>#mainContainerClass {  max-width: unset !important; } .p-head1 {font-weight: 600;font-size: 20px; } .p-head2 {font-weight: 500;font-size: 16px; } .p-head1 span{ font-weight:400;}
.compay-details .img-holder { padding:0px;}

.compay-details .img-holder img { text-align:center;}
.tile-agent-ul li span.firt-child{
	font-weight: 700;
min-width: 43%;
min-height: 27px;
}.m-mob-dip2 .mbtn-div a, .m-mob-dip2 .mbtn-div button {
    border-radius: 5px !important;
}
.sh-only-mobile { display:none;}
.cm-title  { text-align:center;font-weight:600; margin-top:7px; }
.cm-int-tit {  font-weight:400; color:#999; }
.tile-agent-ul li{
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.4rem;
    padding: 1rem;
    color: #222;
    margin-bottom: 0;
    min-height: 4.7rem;
}
.tile-agent-ul li div.deti {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
}
#user_listing .maker_adjust {
    margin-left: 0;
    margin-right: 0;
}
.tile-agent-ul  > li:nth-child(2n+1) {
    background-color:#F2F3F5;
}
.container.container-agency { max-width:1100px; }
.cmsCrumbar a {color:var(--secondary-color); }
hr.user_type_A{ display:none; }
.compay-details .img-holder {
    padding-top: 100%;
    position: relative;
}
.compay-details .img-holder img {
    text-align: center;
    object-fit: contain;
    position: absolute;
    top: 0;
    height: 100%;
    width: 100%;
}
.img-holder.user_type_A img { border-radius: 50%; object-fit: cover; }
.contact-details { border-left:1px solid #eee;  border-right:1px solid #eee;  border-bottom:1px solid #eee; }
.contact-details.user_A{ border-left:0px solid #eee;  border-right:0px solid #eee;  border-bottom:0px solid #eee; }
.cctnct-txt.agentss {
    font-size: 15px;
 
    line-height: 30px;
}
	.mul-li	{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    min-height: 340px;
    margin: 0 0 20px;
    padding: 0 20px 0 0;
    background-color: #fff;
    -ms-flex-flow: wrap;
    flex-flow: wrap;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
}
html[dir="rtl"] .mul-li	{ padding: 0  0px 0 20px; }
html[dir="rtl"]  .mul-li li.user-li-list	{ margin: 20px  0px  0px 20px; }
									.mul-li	li.user-li-list {
    border: 1px solid #dedede;
    position: relative;
    background-color: #fff;
    width: calc(32.3% - 13.3px);
    margin: 20px 20px 0 0;
}
	.photose {
    display: inline-block;
    position: relative;
   
    width: 100%;
    height: 150px;
    padding: 10px 10px 0px 10px;
}		.ui-det{
	height: 160px;
display: inline-block;
width: 100%;
position: relative;
 
	} 	
	h1.p-head3{
		font-size: 16px;
line-height: 40px;
text-align: center;
white-space: nowrap;
text-overflow: ellipsis;
overflow: hidden;
padding: 0 25px;
font-weight:600;
}	
.propert-cnt {
	font-size: 13px;
clear: both;
padding:  5px 20px;
max-height: 55px;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
position: relative;
	}.call-btn-div-bot a { width:48%; padding:5px 0px;}
	.call-btn-div-bot {
	 
padding:  5px 20px;
 
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
position: relative;
	}
.propert-cnt span {
    font-weight: 700;
}.photose picture img {
    max-height: 130px;
    max-width: 75%;
}.photose picture {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}.call-btn-div-bot a {
    width: 48%;
    border: 0px !important;
    border-radius: 5px !important;
}.call-btn-div-bot {
 
    padding: 0px 5px !important;
}
.user-li-list-agent{position: absolute;top: 0;width: 100%;height: 100%;left:0;right:0;z-index: 1;}
.user-li-list-agent a{ width: 100%;height: 100%;display: block;}
.a-v-viewmore { display:none; color:var(--secondary-color) !important;margin-top:10px;font-weight:600;}
									.a-v-vieless { display:none;color:var(--secondary-color)  !important;margin-top:10px;font-weight:600;}
									.conjusted.detail-desc .a-v-viewmore { display:block;}
									.conjusted.detail-desc .a-v-vieless { display:none;}
									.conjusted  .a-v-viewmore { display:none;}
									.conjusted  .a-v-vieless { display:block;}
									.propertydescription_texttrim.detail-desc .txtcnt1.nnty {
						max-height: 116px;
						overflow: hidden;
					}
					.only-agent-mobile { display:none;}.only-mobile-ag { display:none;}
			@media only screen and (max-width: 600px) {
			    	h1.p-head3{text-align:initial; } 
			    .only-mobile-ag { display:block; }
		.m-mob-dip2.not-mobo-A{ margin-left:-15px; margin-right:-15px; }
		.only-agent-mobile.only-agent-mobile-A { display:block; margin-left:-15px; margin-right:-15px;margin-bottom: 0px;margin-top: 10px; }
		.margin-bottom-50.prophead{ margin-bottom: 15px !important; }
		#user_listing .for-mobile.myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.bttom-menu{ display:none; }
					.m-mob-dip .call-btn-div.userbtm-A { display:none; }
					.m-mob-dip .call-btn-div.scrolactive.userbtm-A { display:flex; }
			.compay-details .img-holder {
			padding-top: 50%;
			position: relative;
			margin-bottom: 25px;
			margin-top: 25px;
			}
			.userdets { display:none; }
			.mul-li li.user-li-list {
    border: 0px; background:#fafafa;border-radius: 5px !important;
 
    width: 100%;
    margin: 00px  0px 7px 0;
}
.photose {
  float: left;
position: relative;
pointer-events: none;
width: 130px;
height: 130px;padding: 0px;
}.ui-det{
    display: inline-block;
    position: relative;
    width: calc(100% - 130px);
    height: 130px;
    
}

.photose picture img{
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;max-width: unset;max-height: unset;
} 
h1.p-head3{
    font-size: 18px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    padding: 5px  0  3px  10px; margin-top:0px !important; line-height: 1;
}.mul-li{ padding:0px !important;}
.propert-cnt{
    font-size: 13px;
    clear: both;
    padding: 3px  10px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    position: relative;
}
#property_html ul#d_column { padding:0px !important; }
#property_html ul#d_column.container.list .smartad_footer {
 
    background: #fff;
    border: 0px;
}
#property_html .forgrid  { display:none  !important; }
.compay-details .img-holder.user_type_A { margin-top:0px; }
.compay-details .img-holder.user_type_A img { 
}
.not-mobo-A { display:none; } html body  .zero-top-mar{  margin-top:0px !important;  } 
.sh-only-mobile.not-mobo-A{ display:block; }.nt-show-mob { display:none !important;}
.p-head1.sh-only-mobile { text-align:center; }
ul.tile-agent-ul.agen-A > li:nth-child(2n+1){ background-color:#fff; }
ul.tile-agent-ul.agen-A > li  { min-height: unset !important;padding:0px; display:block; }ul.tile-agent-ul.agen-A > li span   { min-width:unset; }
.img-holder.user_type_A { position:relative; padding-top:0px;text-align: center;}
.img-holder.user_type_A img{ width:110px; height:110px; position: relative; }
ul.tile-agent-ul.agen-A > li span { display:inline; }ul.tile-agent-ul.agen-A > li .deti { display:inline !important;  width:auto !important; }
#user_listing .mbtn-div a, #user_listing .mbtn-div button {
    margin: 0!important;
    flex: 1;
    min-width: 31.33333% !important;
}
		}
			@media only screen and (max-width: 728px) {
			    .modal-body .ctin {     display: block; }
			}
</style>
<div class="container container-agency user_type_<?php echo $model->user_type;?>" >
			<div class="bread_crumb margin-top-15 not-mobo-A">
			<span class="cmsCrumbar">
				<span class="pull-left" > <a href="<?php echo $this->app->createUrl('site/index');?>"><?php echo $this->project_name;?></a> 	</span > 
			<span  class="pull-left <?php echo !empty($model->parent_company) ? 'userdets' : '';?>"> <span class="margin-right-5 margin-left-5">&gt;</span><a href="<?php echo $this->app->createUrl('user_listing/index');?>"><?php echo $this->tag->getTag('agencies','Agencies');?></a>  </span>
		    <?php
		    if(!empty($model->parent_company)){
				?>
					<span class="pull-left " ><span class="margin-right-5 margin-left-5">&gt;</span><a href="<?php echo $this->app->createUrl('user_listing/detail',array('slug'=>$model->parent_slug));?>"><?php echo $model->parent_company;?></a> </span>
		 
				<?php
			}
			?>
				<span class="pull-left userdets"><span class="margin-right-5 margin-left-5">&gt;</span><?php echo $model->companyName;?></span>
				
				</span>
				
			 
			</div>
			<div class="clearfix"></div>
			<div class="page-head margin-top-15 margin-bottom-30"><h1 class="p-head1 not-mobo-<?php echo $model->user_type;?>"><?php echo $model->companyName;?></h1></div>
	 
</div>
<hr class="margin-top-0 margin-bottom-0 user_type_<?php echo $model->user_type;?>" />
<div class="container description-container container-agency margin-bottom-50 muser_type_<?php echo $model->user_type;?>">
			<div class="row">
			
				<div class="col-sm-8 compay-details padding-top-15">
									<div class="row">
									 
												<div class="col-sm-4">
												<div class="img-holder user_type_<?php echo $model->user_type;?>">
												<img src="<?php echo $model->generateLogoImage(250,250);?>" >
												</div>
												<div class="page-head margin-top-15 margin-bottom-10  sh-only-mobile  not-mobo-<?php echo $model->user_type;?>"><h1 class="p-head1 sh-only-mobile not-mobo-<?php echo $model->user_type;?>"><?php echo $model->companyName;?></h1></div>
												<?php
												if($model->user_type == 'A' and !empty($model->role_id)){
												    ?><p class="cm-title sh-only-mobile not-mobo-<?php echo $model->user_type;?>"><?php 
												    if(!empty($model->parent_company)){
												    echo Yii::t('app','{p}   {c}',array('{p}'=>$model->role_id,'{c}'=>'<span class="cm-int-tit">('.$model->parent_company.')</span>'));
												    }else{
												        echo $model->role_id; 
												    }
												    ?></p><?
												}
												?>
												</div>
												<div class="col-sm-8">
												    <script>
												    
												        $(function(){
												            var srlDiv = $('#sh-mob-top').offset().top + 60 ; 
												          $(document).scroll(function(){$(document).scrollTop()>=srlDiv?$(".call-btn-div").addClass("scrolactive"):$(".call-btn-div").removeClass("scrolactive")})
												       
												        })
												        
												    </script>
												    	    <div id="sh-mob-top" class="sh-only-mobile m-mob-dip2 not-mobo-<?php echo $model->user_type;?>">
									        
									        <hr />
									        <div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;/*! width:100% !important; */position:relative !important; display: flex;margin: 0px 9px; ">
    
      
  
     <button type="button"  onclick="OpenFormAgentClickNew(this)" data-reactid="<?php echo $model->user_id;?>"  data-testid="lead-form-submit" style="margin-bottom:8px" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('email_2', 'Email') ;?></button>
         <a type="button" style="color:#fff;padding-left: 2px;padding-right: 2px; margin-left:5px !important;  margin-right:5px !important; "  onclick="OpenCallNew(this)" data-phone="<?php echo base64_encode($model->contactPhone);?>" data-testid="lead-form-submit" class="b-l-l-m  Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('call', 'Call') ;?></a>

        <a type="button" target="_blank" style="color:#fff"  onclick="OpenWhatsappNew(this)" data-href="<?php echo Yii::t('app','sms://{number}',array('{number}'=>Yii::t('app',  $model->contactPhone,array('+'=>'',' '=>''))  ));?>" target="_blank"  data-testid="lead-form-submit" class="   Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp"><i class="fa fa-comments" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('sms', 'SMS') ;?></a>
    </div>
 <div class="clearfix"></div>
									        <div class="container container-agency user_type_<?php echo $model->user_type;?>" >
			<div class="bread_crumb margin-top-15  ">
			<span class="cmsCrumbar">
				<span class=" " > <a href="<?php echo $this->app->createUrl('site/index');?>"><?php echo $this->project_name;?></a> 	</span > 
			<span  class="  <?php echo !empty($model->parent_company) ? ' ' : '';?>"> <span class="margin-right-5 margin-left-5">&gt;</span><a href="<?php echo $this->app->createUrl('user_listing/index');?>"><?php echo $this->tag->getTag('agencies','Agencies');?></a>  </span>
		    <?php
		    if(!empty($model->parent_company)){
				?>
					<span class=" " ><span class="margin-right-5 margin-left-5">&gt;</span><a href="<?php echo $this->app->createUrl('user_listing/detail',array('slug'=>$model->parent_slug));?>"><?php echo $model->parent_company;?></a> </span>
		 
				<?php
			}
			?>
				<span class=" "><span class="margin-right-5 margin-left-5">&gt;</span><?php echo $model->companyName;?></span>
				
				</span>
				
			 
			</div>
			<div class="clearfix"></div>
			<div class="page-head margin-top-15 margin-bottom-30  not-mobo-<?php echo $model->user_type;?>"><h1 class="p-head1"><?php echo $model->companyName;?></h1></div>
	 
</div>
									        <hr />
									        
									    </div>
							
												<div class="tile-agent">
												<ul class="tile-agent-ul agen-<?php echo $model->user_type;?>">
													<?php
													if($model->user_type != 'A'){ ?> 
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('agents','Agents');?>:</span> <div class="deti"><?php echo (int)$teamsCount;?></div> </li>
													<?php }
													else if(!empty($model->parent_company)){
														?>
															<li class="tile-agent-ul-li nt-show-mob"> <span class="firt-child"><?php echo $this->tag->getTag('company','Company');?>:</span> <div class="deti"><?php echo  $model->parent_company;?></div> </li>
													
														<?
													}
													 ?>
													<?php
													if($model->user_type == 'A'){
												    	$LanguageKnownDetails = 	$model->LanguageKnownDetails;
														
													    ?> 
													    <li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('languages','Language(s)');?>:</span> <div class="deti"><?php   echo  !empty($LanguageKnownDetails) ? $LanguageKnownDetails : '-' ;?> </div> </li>
														
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('properties','Properties');?>:</span> <div class="deti" style="display:block;"><?php echo Yii::t('app',$this->tag->getTag('for_sale_n','For Sale ({n}) '),array('{n}'=>'<span dir="ltr">'.(int)$model->sale_total.'</span>'));?>,<?php echo Yii::t('app',$this->tag->getTag('for_rent_n','For Rent ({n})'),array('{n}'=>'<span dir="ltr">'.(int)$model->rent_total.'</span>'));?></div> </li>
														
														<?php } else { ?> 
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('properties','Properties');?>:</span> <div class="deti"><?php echo (int)$adsCount;?></div> </li>
														<?php
														}
														$countries_title = '';
														$country_list = $model->ServiceLocationStatesDetails ; 
														if($country_list){
															foreach($country_list as $k=>$v){
																$countries_title .= $v->state_name.',';
															}
														}
														$offering_location =  rtrim($countries_title,',');
														?>
															<?php
														if($model->user_type == 'A'){ ?> 
															<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('specialities','Specialities');?>:</span> <div class="deti"><?php   $offering =  $model->CategoryOfferingDetails; echo  !empty($offering) ? $offering : '-' ;?>   </div> </li>
													
														<?php } else { ?>
															<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('property_types','Property Types');?>:</span> <div class="deti"><?php   $offering =  $model->CategoryOfferingDetails; echo  !empty($offering) ? $offering : '-' ;?>   </div> </li>
													
														<?php
														} ?> 
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('service_areas','Service Areas');?>:</span> <div class="deti"><?php   echo  !empty($offering_location) ? $offering_location : '-' ;?> </div> </li>
													    <?php 
														if($model->user_type != 'A'){ ?> 
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('properties_for','Properties for');?>:</span> <div class="deti"><?php   $offering =  $model->ServiceOfferingDetails; echo  !empty($offering) ? $offering : '-' ;?> </div> </li>
														<?php } ?>
														  <?php 
														if(!empty($model->licence_no)){ ?> 
														<li class="tile-agent-ul-li"> <span class="firt-child"><?php echo $this->tag->getTag('advertiser_license_number','Advertiser License Number');?>:</span> <div class="deti"><?php    echo  $model->licence_no ;?> </div> </li>
														<?php } ?> 
												</ul>
												
												</div>
												
												
												</div>
									</div>
									<hr class="only-agent-mobile only-agent-mobile-<?php echo $model->user_type;?>" />
									
									<div class="row margin-top-40 zero-top-mar">
									    
										<?php
									$descript = $model->DescriptionDetails;
									if(!empty($descript)){ ?> 
									<div class="col-sm-12"><h1 class="p-head1"><?php echo $model->user_type=='A' ? $this->tag->getTag('about','About'): $this->tag->getTag('description','Description');?></h1></div>
									<div class="col-sm-12">
									<style>
									
									</style>
									<div data-qs="text-trimmer"  id="txttrim" class="  propertydescription_texttrim "  >
									<div class="txtcnt1 nnty" dir="auto">
									<?php echo nl2br($descript);?>
									</div>
									<div>
									<a href="javascript:void(0)" class="a-v-viewmore arwdon"  onclick="OpenContenContent()"><?php echo $this->tag->getTag('read_more','Read More');?><span class="margin-left-5"></span></a>
									<a href="javascript:void(0)" class="a-v-vieless arwdon arwdonup"   onclick="CloseContenContent()" ><?php echo $this->tag->getTag('read_more','Read Less');?> <span class="margin-left-5"></span></a>
									</div>
									</div> 
									<script>

									$(function(){ checkscriptHeight2() } )

									</script>
									</div>
									<?php } ?> 
									
									
									</div>
									
										<div class="clearfix"></div>
					<?php
					if($model->user_type=='A'){
					    ?>
					    	<hr class="only-agent-mobile only-agent-mobile-<?php echo $model->user_type;?>" />
								
					    <div class="margin-top-20 margin-bottom-20 only-mobile-ag  " style="border: 1px solid #eee;border-radius: 15px;padding: 20px;">
					        <div class="pull-left" style="width:calc(100% - 80px)">
					            <?php
					            if(!empty($model->total_reviews)){
					            echo '<h1 class="margin-top-0" style="font-size:130%;line-height: 1.2;font-weight: 600;">'; echo Yii::t('app',$this->tag->getTag('{n}_got_a__average_rating_{c}','{n} got a  average rating {c}  from a total of {t} reviews.'),array('{n}'=>'<span style="color:var(--secondary-color)">'.$model->companyName.'</span>','{c}'=>'<span dir="ltr">'.Yii::t('app',$model->avg_r,array('.00'=>'')).'/5</span>','{t}'=>$model->total_reviews));
					            }else{
					           echo '<h1 class="margin-top-0" style="font-size:179%;line-height: 1.2;font-weight: 600;">';  echo $this->tag->getTag('be_the_first_to_review_this_ag','Be the first to review this agent');
					            }
					            ?></h1>
					            <a href="<?php echo $this->app->createUrl('forms/review_agent',array('slug'=>$model->slug));?>" style="border-radius:5px"  class="btn button  btn-primary padding-top-5  padding-bottom-5 margin-top-10"><i class="fa fa-pencil"></i> <?php echo $this->tag->getTag('write_a_review','Write a Review');?></a>
					            
					            
					        </div>
					        <div class="pull-left padding-top-40" style="width:80px; text-align:center;"> <img src="<?php echo $this->app->apps->getBaseUrl('assets/img/rating.png');?>" style="width:80%" /> </div>
					        
					        <div class="clearfix"></div>
					    </div>
					    <?
					
					}
					?>
				
									
									<?php
									if(!empty($teamsCount)){
									?>
									<!--Teams -->
										<div class="row margin-top-40 zero-top-mar">
									
									<div class="col-sm-12"><h1 class="p-head1"><?php echo $this->tag->getTag('agents','Agents');?></h1></div>
									<div class="col-sm-12">
									 
									
										<div id="agent_html">
										<?
											$this->renderPartial('//user_listing/_ajax_agents_list');
										?>
										</div>
									 
									</div>
									
									</div>
								
									<!--Teams End-->
									<?php } ?> 
									
									<?php
									if(!empty($adsCount)){
									?>
									<!--Propertie-->
									<hr class="only-agent-mobile only-agent-mobile-<?php echo $model->user_type;?>" />

										<div class="row margin-top-40 zero-top-mar">

										<div class="col-sm-12"><h1 class="p-head1 margin-bottom-20 prophead"><?php echo $model->user_type=='A' ?  $this->tag->getTag('properties','Properties') :  Yii::t('app',$this->tag->getTag('properties_by_{n}','Properties by {n}'),array('{n}'=>'<span>'.$model->companyName.'</span>'));?></h1></div>
										<div class="col-sm-12" id="listing">
										<div id="property_html" class="maker_adjust  ">
										<? $this->renderPartial('//user_listing/_ajax_properties_list'); ?>
										</div>
										</div>
										</div>
									<!--Propertie End-->
									<?php } ?>
				
				</div>
				<div class="col-sm-4 contact-details ctin user_<?php echo $model->user_type;?>">
				
					<?php 
					
						if (Yii::app()->request->isAjaxRequest) {
	  $cs=Yii::app()->clientScript;
		$cs->scriptMap=array(
		'jquery.js'=>  false , 
		'jquery.min.js'=>    false , 
		'jquery.yiiactiveform.js' => false,
		);
		$this->renderPartial("//user_listing/_contact_agency" , compact('model'),false,true); 
	}
	else{
					$this->renderPartial("//user_listing/_contact_agency" , compact('model') ); 
					}
					?>
					<div class="clearfix"></div>
					<?php
					if($model->user_type=='A'){
					    ?>
					    <div class="margin-top-0  " style="border: 1px solid #eee;border-radius: 15px;padding: 20px;">
					        <div class="pull-left" style="width:calc(100% - 80px)">
					            <?php
					            if(!empty($model->total_reviews)){
					            echo '<h1 class="margin-top-0" style="font-size:130%;line-height: 1.2;font-weight: 600;">'; echo Yii::t('app',$this->tag->getTag('{n}_got_a__average_rating_{c}','{n} got a  average rating {c}  from a total of {t} reviews.'),array('{n}'=>'<span style="color:var(--secondary-color)">'.$model->companyName.'</span>','{c}'=>'<span dir="ltr">'.Yii::t('app',$model->avg_r,array('.00'=>'')).'/5</span>','{t}'=>$model->total_reviews));
					            }else{
					           echo '<h1 class="margin-top-0" style="font-size:179%;line-height: 1.2;font-weight: 600;">';  echo $this->tag->getTag('be_the_first_to_review_this_ag','Be the first to review this agent');
					            }
					            ?></h1>
					            <a href="<?php echo $this->app->createUrl('forms/review_agent',array('slug'=>$model->slug));?>" style="border-radius:5px"  class="btn button  btn-primary padding-top-5  padding-bottom-5 margin-top-10"><i class="fa fa-pencil"></i> <?php echo $this->tag->getTag('write_a_review','Write a Review');?></a>
					            
					            
					        </div>
					        <div class="pull-left padding-top-40" style="width:80px; text-align:center;"> <img src="<?php echo $this->app->apps->getBaseUrl('assets/img/rating.png');?>" style="width:80%" /> </div>
					        
					        <div class="clearfix"></div>
					    </div>
					    <?
					
					}
					?>
				
				</div>
			
			</div>

</div>
<script>
	 $(function(){
		   caroselSingle3();
		 })
		 
											var modid = '<?php echo $model->user_id;?>';
										function clickPginate2(t, a) {
										a.preventDefault();

										n = $(t).attr("href")
										if(n.includes("?")){ n+= '&';
										}else{
											 n+= '?';
										}
										 n = n + 'rend=property_view&user='+modid; 
										$.get(n,function(data){

										var data = JSON.parse(data);
										$('#property_html').html(data.msgHtml);
										 caroselSingle3();

										})

										}
function clickPginate(t, a) {
										a.preventDefault();

										n = $(t).attr("href")
										if(n.includes("?")){ n+= '&';
										}else{
											 n+= '?';
										}
										 n = n + 'rend=agent_view&user='+modid; 
										$.get(n,function(data){

										var data = JSON.parse(data);
										$('#agent_html').html(data.msgHtml);

										})

										}
										</script>
 <Style>
 .actions span a{ background: #eee; border-radius:5px; display:inline-block;padding: 1px 7px;line-height: 2; }
 .actions span a.current{ background: var(--secondary-color); font-weight:600; color:#fff !important; }
 a.fENbfA , .fENbfA{ background-color:var(--secondary-color) !important;}
 .m-mob-dip .mbtn-div a, .m-mob-dip .mbtn-div button {
    border-radius: 5px !important;
    margin-right: 2.5px  !important;
    margin-left: 2.5px !important;
}
 </Style>
<div class="m-mob-dip d-none-sp">
	    <style>
	  
	         
	        .br-black-1-dot { }
	        .b-r-r-m{border-top-right-radius: 3px !important; }
	         .b-l-l-m{border-top-left-radius: 3px !important; }
	    </style>
<div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div userbtm-<?php echo $model->user_type;?>" style="padding:0px;width:100% !important">
    
      
  
     <button type="button"  onclick="OpenFormAgentClickNew(this)" data-reactid="<?php echo $model->user_id;?>"  data-testid="lead-form-submit" style="margin-bottom:8px" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('email_2', 'Email') ;?></button>
         <a type="button" style="color:#fff;padding-left: 2px;padding-right: 2px; margin-left:5px !important;  margin-right:5px !important; "  onclick="OpenCallNew(this)" data-phone="<?php echo base64_encode($model->contactPhone);?>" data-testid="lead-form-submit" class="b-l-l-m  Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('call', 'Call') ;?></a>

        <a type="button" target="_blank" style="color:#fff"  onclick="OpenWhatsappNew(this)" data-href="<?php echo Yii::t('app','sms://{number}',array('{number}'=>Yii::t('app',  $model->contactPhone,array('+'=>'',' '=>''))  ));?>" target="_blank"  data-testid="lead-form-submit" class="   Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp"><i class="fa fa-comments" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $this->tag->getTag('sms', 'SMS') ;?></a>
    </div>
 
</div>
