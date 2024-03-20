<?php
	$apps = Yii::app()->apps;$bg =false; 
	$call = $this->tag->getTag('call','Call');
	$WhatsApp = $this->tag->getTag('whatsapp','WhatsApp');
	$email = $this->tag->getTag('email','Email');
	$sale = $this->tag->getTag('sale','Sale');
	$rent = $this->tag->getTag('rent','Rent');
	foreach($works as $k=>$v){
						$s_id ="list_items_s".$v->user_id ;
						$rent_total =  $v->rent_total;
						$sale_total =    $v->sale_total; ?>
                        <div class="col-sm-12 ajaxLoaded2  no-padding mul_sliderh " data-s="<?php echo $sale_total;?>"  data-r="<?php echo $rent_total;?>"  id="<?php echo $s_id;?>"> 
								<div  class="listing-item-container  ">
									<div class="listing-item" style="padding:5px;"> 
								      <a href="<?php echo $v->agentDetailUrl;?>" onclick="easyload(this,event,'mainContainerClass')"  ><?php echo $v->generateImageNew($apps,$h=164,$w=246,$s_id,$bg);?></a>
									</div>
                            
									<div class="listing-item-content spanfont  no-padding">
										<div class="">
											<div class="col-sm-12"> 
												<h3 class="_18ilrswp" style="margin-top:8px !important;margin-bottom:8px !important;"><a href="<?php echo $v->agentDetailUrl;?>"  onclick="easyload(this,event,'mainContainerClass')" ><?php echo $v->fullName;?>  <?php echo $v->VerifiedTitles;?></a></h3>
												<h5  ><?php echo $v->state_name ;?></h5>
												<div class="_czm8crp" ><?php echo $v->getShortDescription(250) ;?></div>
												<div>
													<div class="buttons smallnomarl">
														<div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;width:100% !important">
																	<a type="button"     style="color:#fff;padding-left: 2px;padding-right: 2px;" onclick="OpenCallNew(this)" data-phone="<?php echo base64_encode($v->contactPhone);?>" data-testid="lead-form-submit" style="margin-bottom:8px" class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA hide"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $call ;?></a>
																	<a type="button"   onclick="OpenWhatsappNew(this)" data-href="<?php echo  Yii::t('app','https://wa.me/{number}',array('{number}'=>Yii::t('app',  $v->contactPhone,array('+'=>'',' '=>''))  )) ;?>" target="_blank" style="color:#fff"    data-testid="lead-form-submit" style="margin-bottom:8px" class=" br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp hide"><i class="fa fa-whatsapp" style="font-size: 20px;margin-right: 3px;"></i> <span class="hidemob normalfnt"><?php echo $WhatsApp;?></span></a>
																	<a type="button" onclick="OpenFormAgentClickNew(this)" data-reactid="<?php echo $v->user_id;?>" data-testid="lead-form-submit" style="margin-bottom:8px" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA hide"><i class="fa fa-envelope"  style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $email ;?></a>
																	<?php
																	if(!empty($sale_total)){ ?>
																	<a href="<?php echo $v->SaleUrl;?>" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA rsalebrder" >  <?php echo $sale;?>   (<?php echo $sale_total;?>) <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;"><path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path></svg>  </a> 
																   	<?php } ?>
																   	<?php
																	if(!empty($rent_total)){ ?>
																   	<a href="<?php echo $v->RentalUrl;?>" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA rentbrder"  >  <?php echo $rent;?>   (<?php echo $rent_total;?>)  <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;"><path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path></svg> </a>
																	<?php } ?> 
																	<div class="clearfix"></div>
														 </div>
													</div>  
												 </div>
											</div>
										 </div>
									 </div>
									 <!--listing-item-content end-->
								</div>
								 <!--listing-item-content end-->
								<div class="clearfix"></div>
						  </div>
						  
                        <?php
                        } 
                        ?> 
 
