                        <!-- Listing Item -->
                       <?php
                        $links_open_in  = $this->options->get('system.common.link_open_in','S');	
                        $apps = $this->app->apps;
                        $s_class_n = 'col-sm-4';$bg = true;
                        foreach($works as $k=>$v){ 
                            $img_link = $v->getAd_image_singlenew("293");
							$s_id ="sale_item".$v->id ;
							$company_image = $v->CompanyImage2;
							?>
							<div class="col-md-12 col-lg-12 lst-prop list-items prop-status-<?php echo $v->property_status;?>" id="<?php echo $s_id;?>"  data-price="<?php echo $v->price;?>">
              <a href="<?php echo $v->detailUrl;?>" style="position:absolute;left:0;top:0;bottom:0px;right:0px;z-index:1"></a>
            <div class="feat_property home7 style4 list">
              <div class="thumb">
                  <?php
                  if(!empty($img_link)){ ?> 
                <img class="img-whp" src="<?php echo $img_link;?>"  alt="<?php echo $v->ad_title;?>"  title="<?php echo $v->ad_title;?>"  >
                <?php } ?>
                <div class="thmb_cntnt">
                    	<?php echo $v->getTagList('F');?>
                  <ul class="icon mb0">
                            <li class="list-inline-item"><?php echo '<a type="button" id="fav_button_'.$v->id.'"  class="';echo  !empty($v->fav) ?  'active' : ''; echo '  false  favbtn lastref" onclick="OpenFavouriteNew(this)" data-function="save_favourite" data-id="'.$v->id.'" data-after="saved_fave"    ><i class="fa fa-heart-o"  ></i>  <span class="text-not-mob">Save</span></a>';?></li>
            
                  </ul>
                  <?php
										if($v->IsPreleased){  echo '<span class="p_staus">'.$v->SoldStatus.'</span>';} ?>
                </div>
              </div>
              <div class="details">
                <div class="tc_content">   
                   <h2 class="prce"> <?php echo  $v->AdTitle2;?></h2>
                   <p class="add"><span class="flaticon-placeholder"></span><?php echo $v->listRowLocation();?></p>
                
                  <?php
									    
										echo '<ul class="spl-leased row margin-top-15 margin-bottom-0" style="">'; 
										if($v->category_id=='194'){
										     $f_fee = $v->getPriceTitleSpanLNee('category_id',$v->f_fee,'');
										    if(!empty($f_fee)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('f_fee').'</label><span>'.$f_fee.'</span></li>';
										    }
										     $asking_price = $v->getPriceTitleSpanLNee('p_o_r',$v->price,$v->price_to);
										    if(!empty($asking_price)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('investment').'</label><span>'.$asking_price.'</span></li>';
										    }
										    
										}else{
										    $asking_price = $v->getPriceTitleSpanLNee('p_o_r',$v->price,$v->price_to);
										    if(!empty($asking_price)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('price').'</label><span>'.$asking_price.'</span></li>';
										    }
										    $revenue = $v->getPriceTitleSpanLNee('request_r',$v->price_false,$v->price_to_false);
										    if(!empty($revenue)){
									         echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('price_false').'</label><span>'.$revenue.'</span></li>';
										    }
										    $b1= $v->getPriceTitleSpanLNee('p_b_r',$v->price_b,$v->price_b_to);
										    if(!empty($b1)){
									         echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('price_b').'</label><span>'.$b1.'</span></li>';
										    }
										    $valuation = $v->getPriceTitleSpanLNee('p_v_r',$v->price_v,$v->price_v_to);
										    if(!empty($valuation)){
									             echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$v->getAttributeLabel('price_v').'</label><span>'.$valuation.'</span></li>';
										    }
										}
										
											echo '</ul>';
										
									  ?>
										<div class="ftr-cls">
										    <div class="margin-top-5 shobile-only-show"></div>
										    <span class="frch-btn margin-right-5"><?php echo $v->category_name;?></span>
										    <div class="margin-bottom-5 shobile-only-show"></div>
                 <?php echo $v->footerLinkNew2();?>
                 </div>
                </div>
              </div>
            </div>
          </div>
				 
                         
							<?
						 
						 }
