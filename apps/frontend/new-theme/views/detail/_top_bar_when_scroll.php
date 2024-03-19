<script>
	var content_start;function onscrolOpen(){$(window).scroll(function(){$(this).scrollTop()>=content_start?$("#top_scroller").addClass("activityBar-enter-done"):$("#top_scroller").removeClass("activityBar-enter-done")})}$(function(){content_start=$("#sec_content").offset().top,setTimeout(function(){onscrolOpen()},1e3)});
</script>
<div data-testid="property-page-action-bar" class="HomeDetailsSummary__ActionBar-yyzvbv-0 jWXHXI topBar " id="top_scroller">
	<div class="HomeDetailsSummary__ActionBarContents-yyzvbv-1 ecgRxv">
		<div data-testid="FloatingActionBar" class="Grid__GridContainer-sc-144isrp-1 lputZN" style="display: flex; border: none;">
			<div width="320" order="1" class="Grid__CellBox-sc-144isrp-0 bDTSWt"><span data-testid="home-details-action-bar-address" class="Text__TextBase-sc-1cait9d-0 bfxqef"><?php echo $model->LocationTitle;?></span>
				<br> <ul class="List__ListContainer-sc-8uj508-0 dcERdf margin-top-0">
						<?php
					if($model->category_id=='33'){
					     
        					if(!empty($model->car_parking !='')){ ?>
        					<li>
        						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
        							<div width="16" height="16" class="<?php echo $model->CarClass;?>">
        							 
        							</div>
        							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->CarparkingTitle;?></div>
        						</div>
        					</li>
        					<?php } 
        					if(!empty($model->pantry !='')){ ?>
        					<li>
        						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
        							<div width="16" height="16" class="iconCoffee">
        							 
        							</div>
        							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->PantryTitle;?></div>
        						</div>
        					</li>
        					<?php }  
                            if(!empty($model->bathrooms)){ ?>
                            <li>
                                    <div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
                                    <div width="16" height="16" class="<?php echo $model->bathClass;?>">
                                    
                                    </div>
                                    <div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->BathroomTitle;?></div>
                                    </div>
                            </li>
                            <?php }  
					}
					else 
					{
					if($model->no_of_units !=''){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="iconBlock">
							 
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->no_of_units.' Units ';?></div>
						</div>
					</li>
					<?php } ?> 
						<?php
					if($model->no_of_stories !=''){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="iconNoteBeamed">
							 
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->no_of_stories.' Stories ';?></div>
						</div>
					</li>
					<?php } ?> 
					<?php
					if(!empty($model->bedrooms)){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="<?php echo $model->bedClass;?>">
								  
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->BedroomTitle;?></div>
						</div>
					</li>
					<?php } ?> 
					<?php
					if(!empty($model->bathrooms)){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="<?php echo $model->bathClass;?>">
							 
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->BathroomTitle;?></div>
						</div>
					</li>
					<?php } ?> 
					<?php
					if(!empty($model->car_parking !='')){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="<?php echo $model->CarClass;?>">
							 
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->CarparkingTitle;?></div>
						</div>
					</li>
					<?php } 
					
							if(!empty($model->kitchen !='')){ ?>
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="iconFood">
							 
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE"><?php echo $model->KithenTitle;?></div>
						</div>
					</li>
					<?php }
					?> 
			 
					<?php
				}
				if(!empty($model->builtup_area)){ ?> 
					<li>
						<div class="MediaBlock__MediaContainer-skmvlj-0 bOGJGe">
							<div width="16" height="16" class="">
								 &nbsp;
							</div>
							<div class="MediaBlock__MediaContent-skmvlj-1 dCsAgE ltrClass"><?php echo $model->BuiltUpAreaTitle;?></div>
						</div>
					</li>
					<?php }?> 
				</ul>
				
			 </div>
			<div width="244" order="2" class="Grid__CellBox-sc-144isrp-0 YzAaU">
				<div data-testid="on-market-price-details" class="Text__TextBase-sc-1cait9d-0-div Text__TextContainerBase-sc-1cait9d-1 gpkXTH"><?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2'){ ?>/<span class="dura"><?php echo $model->getRentPaidL(1); ?> </span> <?php } ?></div>
				<div class="Text__TextBase-sc-1cait9d-0-div Text__TextContainerBase-sc-1cait9d-1 dZkZCW">		<?php
		if(empty($model->category_id)){?>
 <?php echo $model->SectionListingFullTitle;?> 
		<?php } else { ?> 
 <?php echo $model->SectionCategoryFullTitle;?> 
		<?php } ?> </div>
			</div>
			<div order="3" class="Grid__CellBox-sc-144isrp-0 kImBgL" style=" align-items: center;">
					 
            <span data-role="coShoppingContainer" class="coShoppingContainer">
               <span data-reactroot="">
                  <span class="mrxs">
                     <div style="display: inherit;"><button data-test-id="PDPSaveButton" id="fav_button_<?php echo $model->id;?>"  class="phl btn btnSml btnDefault phmXxsVisible <?php echo !empty($model->fav) ?  'active' : '';?> "  onclick="<?php if($this->app->user->getId()){ echo 'savetofavourite(this)'; }else{ echo 'OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $model->primaryKey;?>"  data-after="saved_fave"  ><?php if(!empty($model->fav) ){ echo '<i class="iconHeart" ></i>'; } else{ echo '<i class="iconHeartEmpty" ></i>';} ?><span class=""><?php echo  'Save' ;?></span>   </button>
                     </div>
                  </span>
                  <span><button id="PDPShareButton2" class="iconMail phl btn btnSml btnDefault phmXxsVisible" onclick="$('#share_widget2').toggle();" ><span class=""><?php echo 'Share' ;?></span>
                  </button>
                  <div style="position:relative;">
                  <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style"  id="share_widget2" style="right: 0px; top: 0px; line-height: 32px; position: absolute; background: #fff; text-align: center; margin: auto; box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16),0 0 0 1px rgba(0,0,0,0.08);;display:none;">
    <a class="a2a_button_google_plus"></a>
    <a class="a2a_button_facebook"></a>
    <a class="a2a_button_twitter"></a>
    <a class="a2a_button_pinterest"></a>
</div>
</div>
 
 
                  </span>
               </span>
            </span>
          
			
			</div>
			<div width="160" order="5" class="Grid__CellBox-sc-144isrp-0 dwyatr" style=" align-items: center;">
					 <button type="button" onclick="$('#myModal').modal('show')" data-testid="lead-form-submit" style="margin-bottom:8px" class="Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope"></i> <?php echo  'Email' ;?></button>
					
			</div>
		</div>
	</div>
</div><style>.topBar.jWXHXI{position:fixed;top:60px;left:0;right:0;z-index:100001;width:100%;box-shadow:rgba(0,0,0,.2) 0 2px 2px 0;transform:translateY(-100%);opacity:0;background:#fff;transition:transform 250ms cubic-bezier(.445,.05,.55,.95) 0s;padding:10px 0}.jWXHXI.activityBar-enter-done{transform:translateY(0);opacity:1}.topBar .ecgRxv{max-height:97px;max-width:960px;margin:auto}.topBar .lputZN{display:flex;margin-left:-8px;margin-right:-8px;margin-top:-16px;flex-wrap:wrap;border:none}.topBar .lputZN>.Grid__CellBox-sc-144isrp-0{border-style:solid;border-color:transparent;border-width:16px 8px 0}.topBar .bDTSWt{width:320px;order:1;-webkit-box-flex:0;flex-grow:0;flex-shrink:0;flex-basis:auto}.topBar .YzAaU{width:244px;order:2;-webkit-box-flex:0;flex-grow:0;flex-shrink:0;flex-basis:auto}.topBar .kImBgL{order:3;-webkit-box-flex:0;flex-grow:0;flex-shrink:0;flex-basis:auto}.topBar .dwyatr{width:160px;order:5;-webkit-box-flex:0;flex-grow:0;flex-shrink:0;flex-basis:auto}.topBar .bfxqef{font-weight:700;font-size:20px;line-height:1.2}.topBar .fyHNRA{display:inline;margin-right:8px;font-weight:400!important}.topBar .gpkXTH{font-weight:700;font-size:20px;line-height:1.2}</style>
