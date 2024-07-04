<style>
.n-gen-c1 {
    margin-top: 0px;
}

.user_details {
    padding: 7px;
    border-radius: 4px;
}

.sale_link {
    color: var(--color-sale) !important;
    text-decoration: underline;
}

.rent_link {
    color: var(--color-rent) !important;
    text-decoration: underline;
}

.propertypage_factsamenities.n-gen-c2 .facts_listitem {
    width: 33.3333333%;
}

@media only screen and (max-width: 600px) {
    .n-gen-c1.pull-right {
        float: left;
        width: 100%;
        padding: 0px;
        margin-bottom: 25px;
    }

    .n-gen-c2 {
        width: 100%;
        padding-right: 0px !important;
    }

    .user_details.margin-top-15 {
        margin-top: 0px !important;
    }

}

.facts_heading svg {
    color: var(--secondary-color);
}

#detail .margin-top-20.sec-head1 {
    margin-top: 30px !important;
}
</style>
<div class=" col-sm-12 no-padding-left pull-left spl-no-padding-mob">
    <div class="user_details only-mob margin-top-5 no-padding text-center">
        <?php
							if(!empty($model->puser_id)){ 
							echo '<div style="width:100%;">';
							$this->renderPartial('_agentDetais');
							echo '</div>';
							?>
        <?php }else { ?>

        <div class="img_dev mobe  "
            style="width:100%;  text-align: center;    display: block;margin: auto;    width:55px!important;    height:55px!important;    ">
            <?php 

							$image = $model->companyImage; 
						

							$lnk = $model->DetLink  ; 
							if(!empty($image)){
							echo '<a href="'.$lnk.'"  style="    line-height: 1 !important;    display: inline-block !important;    height: 100%;    width: 100%;" ><img src="'.$image.'" style="box-shadow: 0 1px 6px 0 rgba(32,33,36,.28);    border-radius: 50%;object-fit:contain;width:100%;height:100%;padding:5px; " ></a>';
							} ?>
        </div>

        <div class="img_dev_details pull-right margin-top-15 margin-left-15" style=" margin-top:5px !important;  ">
            <div class="_1p3joamp no-padding" style="margin-bottom: 2px !important;padding:0px!important"><a
                    href="<?php echo $lnk;?>"
                    class="<?php echo $model->enable_l_f=='1' ? 'link_color ' : '';?>"><?php echo $model->companyName;?></a>

            </div>
            <?php
							if(empty($model->companyName)){ ?>
            <p class="margin-bottom-2" style="margin-bottom:2px;white-space: nowrap;"><i class="fa fa-user"></i>
                <?php echo $model->first_name;?> </p>
            <?php } ?>
            <?php
							 
							if(!empty($model->advertiser_character)){  
							?>

            <span
                class="smllgry nowrap margin-top-5 hide"><i><?php echo $this->tag->getTag('advertiser-character','Advertiser Character');?></i>
                : <?php echo $model->ArabicCharacter;?> </span>
            <?php } ?>
            <div class="clearfix"></div>
            <?php
							 
							if(!empty($model->licence_no)){  
							?>

            <span
                class="smllgry nowrap hide"><i><?php echo $this->tag->getTag('advertiser_license_number','Advertiser License Number');?></i>
                : <?php echo $model->licence_no;?> </span>
            <?php } ?>
            <div class="clearfix"></div>
            <?php
							if(!empty($model->cr_number)){  
							?>

            <span
                class="smllgry nowrap hide"><i><?php echo $this->tag->getTag('commercial_registration_no.','Commercial Registration No.');?></i>
                : <?php echo $model->cr_number;?> </span>
            <?php } ?>
            <p class="margin-bottom-0 margin-top-5">
                <?php echo CHtml::link($this->tag->getTag('sale','Sale').'('.(int)$total_rest['sale_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale')).'?dealer='.$model->user_slug,array('class'=>'sale_link'));?>
                ,
                <?php echo CHtml::link($this->tag->getTag('rent','Rent').'('.(int)$total_rest['rent_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-rent' )).'?dealer='.$model->user_slug,array('class'=>'rent_link'));?>
            </p>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>


    <div style="position:relative;background:#fff !important" class="detail_page_gn d-none-sp">
        <div onclick="$('#myModal-nearbyLocation').modal('show');$('#thisschools').click();   "
            style="height:300px;width:100%; background-position:center;background-image:url('https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $model->location_latitude;?>,<?php echo  $model->location_longitude;?>&zoom=10&size=440x440&scale=16&key=<?php echo $this->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>');"
            id="map_canvas3" class="margin-bottom-30">

            <span
                style="position:absolute;left:0px;right:0px;top:0px;bottom:0px;width: 100px;height: 100px;background: rgba(0,0,0,0.5);background-position:center;background-image:url('<?php echo $this->app->apps->getBaseUrl('assets/img/pin.png');?>');background-repeat:no-repeat;cursor:pointer;margin: auto;text-align: center;border-radius: 50%;"></span>
        </div>

    </div>

    <div class="propertypage_factsamenities n-gen-c2  onscrol" id="facts">
        <div class="facts">
            <div class="facts_container">
                <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1"
                        width="512" height="512" x="0" y="0" viewBox="0 0 24 24"
                        style="enable-background:new 0 0 512 512" xml:space="preserve">
                        <g>
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="m1.75 15h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z"
                                fill="currentColor" data-original="#000000" style="" />
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="m1.75 24h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z"
                                fill="currentColor" data-original="#000000" style="" />
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="m22.25 8h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z"
                                fill="currentColor" data-original="#000000" style="" />
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="m22.25 17h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z"
                                fill="currentColor" data-original="#000000" style="" />
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="m22.25 0h-12.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h12.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z"
                                fill="currentColor" data-original="#000000" style="" />
                            <circle xmlns="http://www.w3.org/2000/svg" cx="3" cy="3" r="3" fill="currentColor"
                                data-original="#000000" style="" />
                        </g>
                    </svg> <?php echo  $this->tag->getTag('facts','Facts') ;?> </h2>
                <div class="facts_list ">
                    <div class="facts_listitem m-n-displ-h price lefticons hide" style="border-bottom:0px;">
                        <div class="facts_label   " style="width:100%">
                            <?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2' and empty($model->p_o_r)){ ?>/<span
                                class="dura"><?php echo $model->getRentPaidL(1); ?> </span> <?php } ?>
                        </div>
                        <div class="facts_content">
                        </div>
                    </div>
                    <style>
                    .facts_listitem.category_id.cat<?php echo $model->category_id;

                    ?> {
                        background-image: url('<?php $cat_img =  empty($model->category_img) ? 'subfolder.png':$model->category_img; echo '/uploads/category/'.$cat_img;?>');
                    }

                    html .facts_listitem.interior_size {
                        background-image: url('/uploads/category/triangular-ruler.png');
                    }

                    .furnished.lefticons {
                        background-image: url(../../assets/img/amen_293.svg);
                    }
                    </style>
                    <?php
			
			if($model->isPreleased){
			    ?>
                    <span class="frch-btn">
                        <?php echo $model->ListingTypeCategory;?>
                    </span>
                    <?php 
                    echo '<ul class="spl-leased row margin-top-15 margin-bottom-0" style="">';
                     echo '<li  class="col-sm-4 margin-bottom-15" ><label>'.$model->getAttributeLabel('reference').'</label><span>'.$model->ReferenceNumberTitle.'</span></li>';
                   
                    echo '<li  class="col-sm-4 margin-bottom-15" ><label>'.$model->getAttributeLabel('sale_price').'</label><span>'.$model->listRowPriceNew().'</span></li>';
                    echo '<li  class="col-sm-4 margin-bottom-15" ><label>'.$model->getAttributeLabel('lease_status').'</label><span>'.$model->SoldStatus.'</span></li>';
                    echo '<li  class="col-sm-4 margin-bottom-15" ><label>'.  $model->genLabelRoi2() .'</label><span>'. $model->roi . '% P.A</span></li>';
                    echo '<li  class="col-sm-4 margin-bottom-15" ><label>Permit No</label><span>'. $model->PropertyID . '</span></li>';
                    echo '<li  class="col-sm-4 margin-bottom-15" ><label>'.$model->genLabelIncome().'</label><span>'. $model->IncomePrice.' P.A.</span></li>';
                    
                    echo '</ul>';

			    
			}else{
    			$listing_type = 'lst'.$model->listing_type;; 
    			$category_ids  = 'cat'.$model->category_id; 
    			$sect_ids  = 'sect'.$model->section_id; 
    			foreach($array as $k=>$fld){
                    if(!empty( $fld)) { 
                    ?>
                        <div class="facts_listitem <?php echo $k.' '.$listing_type.' '.$category_ids.' '.$sect_ids;?> <?php echo in_array($k,array('permit_no', 'bedrooms','bathrooms','builtup_area','listing_type','category_id','section_id','reference','client_ref','interior_size','l_no','plan_no','no_of_u','floor_no','unit_no','c_date','selling_price','furnished')) ? 'lefticons': '';?>"
                            style="border-bottom:0px;">
                            <div class="facts_label " style="width:100% !important;">
                                <?php echo !in_array($k,array()) ?  $model->getAttributeLabel($k).' <span style="font-weight:500;" dir="auto">'.$fld.'</span>': $fld;?>
                            </div>

                        </div>
                        <?php
                    }
    			}
			
			}
			?>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php 
if($hasedit and !empty($model->slug_z)){
?>
    <a class="btn-block headfont btn-sm-s" href="<?php echo $model->RefereceWebUrl;?>"
        style="color:red !important;text-decoration:underline;" target="_blank">Reference URL</a>
    <?php } ?>
    <div class="clearfix"></div>
    <div class="text-trimmer-wrapper   margin-top-60 sec-head1 onscrol" id="description">
        <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0"
                viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve">
                <g>
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m22.25 0h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z"
                        fill="currentColor" data-original="#000000" style="" />
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m22.25 18h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z"
                        fill="currentColor" data-original="#000000" style="" />
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m.75 11.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z"
                        fill="currentColor" data-original="#000000" style="" />
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="m.75 14.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z"
                        fill="currentColor" data-original="#000000" style="" />
                    <circle xmlns="http://www.w3.org/2000/svg" cx="21" cy="12" r="3" fill="currentColor"
                        data-original="#000000" style="" />
                </g>
            </svg> <?php echo  $this->tag->getTag('description', 'Description') ;?> <?php if($hasedit){ ?> <a
                href="javascript:void(0)" style="color:red !important;text-decoration:underline;"
                onclick="UpdatePropertyDetais(this)" data-href="<?php echo $model->BackendUpdateURl;?>"
                class="pull-right"><i class="fa fa-edit"></i></a>
            <a href="#showUpdateEdit" onclick="showUpdateEdit()"
                style="margin-right:10px;font-size:13px;color:red !important;text-decoration:underline;"
                class="pull-right">Modify Description</a>
            <?php } ?>
        </h2>
        <input type="text" id="asss" style="position:absolute;left:-999999px;height:1px;visinility:hidden;" />
        <input type="text" id="asss2" style="position:absolute;left:-999999px;height:1px;visinility:hidden;" />
        <style>
        .a-v-viewmore {
            display: none;
            color: var(--secondary-color) !important;
            margin-top: 10px;
            font-weight: 600;
        }

        .a-v-vieless {
            display: none;
            color: var(--secondary-color) !important;
            margin-top: 10px;
            font-weight: 600;
        }

        .conjusted.detail-desc .a-v-viewmore {
            display: block;
        }

        .conjusted.detail-desc .a-v-vieless {
            display: none;
        }

        .conjusted .a-v-viewmore {
            display: none;
        }

        .conjusted .a-v-vieless {
            display: block;
        }
        </style>
        <div data-qs="text-trimmer" id="txttrim" class="  propertydescription_texttrim ">
            <div class="txtcnt1" dir="auto">
                <?php echo nl2br($model->AdDescription2);?>
            </div>
            <div>
                <a href="javascript:void(0)" class="a-v-viewmore arwdon"
                    onclick="OpenContenContent()"><?php echo $this->tag->getTag('read_more','Read More');?><span
                        class="margin-left-5"></span></a>
                <a href="javascript:void(0)" class="a-v-vieless arwdon arwdonup"
                    onclick="CloseContenContent()"><?php echo $this->tag->getTag('read_less','Read Less');?> <span
                        class="margin-left-5"></span></a>
            </div>
        </div>
    </div>

    <?php
	if(!empty($model->is_mor) or !empty($model->r_facade) or !empty($model->rights) or !empty($model->may_affect) or !empty($model->disputes) or !empty($model->p_limits)){
		?>
    <style>
    .sacr .accordion {
        background-color: #fafbfc;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: initial;
        border: none;
        outline: none;
        transition: 0.4s;
        margin-bottom: 10px;
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .sacr .active,
    .sacr .accordion:hover {
        background-color: var(--secondary-color);
        color: #fff;
    }

    .sacr button.accordion:hover:after,
    .sacr button.active.accordion:after {
        color: #fff !important;
    }

    /* Style the accordion panel. Note: hidden by default */
    .sacr .panel {
        padding: 0 18px;
        background-color: white;
        display: none;
        overflow: hidden;
    }

    .sacr button.accordion:after {
        content: '\002B';
        color: #777;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }
    </style>
    <div class="sacr margin-top-15">
        <?php
				if(!empty($model->is_mor)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('is_mor');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->is_mor;?></p>
        </div>
        <?php } ?>
        <?php
				if(!empty($model->rights)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('rights');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->rights;?></p>
        </div>
        <?php } ?>
        <?php
				if(!empty($model->may_affect)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('may_affect');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->may_affect;?></p>
        </div>
        <?php } ?>
        <?php
				if(!empty($model->r_facade)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('r_facade');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->r_facade;?></p>
        </div>
        <?php } ?>
        <?php
				if(!empty($model->disputes)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('disputes');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->disputes;?></p>
        </div>
        <?php } ?>
        <?php
				if(!empty($model->p_limits)){?>
        <button class="accordion"><?php echo $model->getAttributeLabel('p_limits');?></button>
        <div class="panel" dir="auto">
            <p><?php echo $model->p_limits;?></p>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    </script>
    <?php
		
		
	}
	?>

    <script>
    $(function() {
        checkscriptHeight()
    })
    </script>
    <?php
	if($hasedit){
	$this->renderPartial('_update_content');
	}
	?>
    <?php  if($b_1){ echo ' <div class="ad_section"><div class="margin-top-60 margin-bottom-0" >'. $b_1.'<div class="clearfix"></div></div></div>';; } ?>


    <div class="clearfix"></div>
    <?php
	if(!empty($model->video)){
	$this->renderPartial('_youtube_video'); 
	}			 	 
	if(Yii::app()->options->get('system.common.enable_featured','0') == '11' and Yii::app()->user->getId() and $model->user_id== Yii::app()->user->getId()){
	   	?>

    <div class="video_container_ad">
        <div class="video_container_image">

            <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/multimedia.png');?>">
        </div>
        <div class="video_container_button"><span>Give more description via Youtube video</span>
            <div class="clearfix"></div>
            <a href="javascript:void(0)" onclick="processvideo(this)"
                data-href="<?php echo Yii::app()->createUrl('member/add_video',array('id'=>$model->id));?>">Add Youtube
                Link</a>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <?php } ?>

    <?php
  $amentites = $model->all_amentitie();
 
if(!empty( $amentites)){ 
    ?>
    <style>
    .openimagediv2 {
        display: none;
    }

    .openimagediv2 {
        height: 100vh !important;
        overflow-y: scroll;
        width: 100%;
        position: fixed;
        z-index: 99999;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: #fff;
    }

    .openamenity .openimagediv2 {
        display: block;
    }

    .amn-cntai .orange-item {
        display: none !important;
    }

    .openimagediv2 .amenities_listitem.listiu {
        display: none;
    }

    .amn-cntai {
        margin-top: 80px;
        max-width: 1100px;
        margin-left: auto;
    }

    .popupdisplay {
        display: none;
    }

    .openimagediv2 .popupdisplay {
        display: block;
    }

    .sml-titl {
        width: 100%;
        display: block;
    }

    .popupdisplay {
        width: 100%;
    }
    </style>
    <script>
    function openAmentiesPopup() {
        $('body').addClass('openamenity');
        $('#header-amenities').html($('#main-header-top').html());
        $('#amn-cntai').html($('#nnea').html());
    }
    </script>

    <div class="propertypage_factsamenities margin-top-60 sec-head1  onscrol" id="amenities">
        <div class="amenities  margin-top-0">
            <div class="amenities_container col-sm-12 no-padding">
                <h2 class="facts_heading hide"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1"
                        width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
                        style="enable-background:new 0 0 512 512" xml:space="preserve">
                        <g>
                            <g xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m497 512h-301c-8.291 0-15-6.709-15-15v-301c0-8.291 6.709-15 15-15h301c8.291 0 15 6.709 15 15v301c0 8.291-6.709 15-15 15z"
                                        fill="currentColor" data-original="#000000" style="" />
                                </g>
                                <path
                                    d="m151 196c0-24.814 20.186-45 45-45h135v-136c0-8.291-6.709-15-15-15h-301c-8.291 0-15 6.709-15 15v301c0 8.291 6.709 15 15 15h136z"
                                    fill="currentColor" data-original="#000000" style="" />
                            </g>
                        </g>
                    </svg> <?php echo  $this->tag->getTag('amenities','Amenities') ;?></h2>
                <div class="amenities_list nnea margin-top-0" id="nnea">
                    <?php
		 
                    echo '<div class="clearfix"></div><h2 class="facts_heading margin-top-20" style="width:100%"><span class="am_svg" id="am_svg_99" ></span> '.$this->tag->getTag('amenities','Amenities').'</h2>';
                    foreach($amentites as $k=>$v){
                    if($v->inp_val=='8'){ $v->inp_val ='8+';};
						$mn = ': '.$v->inp_val; 
						$vals = !empty($v->inp_val) ?  $mn : ''; 
						echo '<div class="amenities_listitem listiu " style="border-bottom:0px;"><i class="amen_dis  amenities_icon amen_'.$v->primaryKey.'"></i><div class="amenities_content amenc_'.$v->primaryKey.'">'.$v->amenities_name.$vals.'</div></div>' ;
                    }
                 
              
             
            
            ?>
                </div>
            </div>
        </div>
    </div>


    <div class="openimagediv2">
        <div class="container">

            <div id="header-amenities"
                style="position:fixed;top:0px;/* width:100%; */left: 0px;right: 0px;width: 90%;margin: auto;padding:0px;;z-index:11;background:#fff;">
            </div>

            <div class="clearfix"></div>
            <div class="amn-cntai">
                <div class="amenities_list nnea" id="amn-cntai"></div>
            </div>

        </div>

    </div>


    <?php } ?>

    <div class="clearfix"></div>
    <?php
 
	if(!empty($floor)){
	?>
    <div id="m_floor_plan" class="padding-top-40"></div>
    <div class="margin-top-0" id="to_florr" style="position: relative;">

        <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0"
                viewBox="0 0 330.004 330.004" style="enable-background:new 0 0 512 512" xml:space="preserve">
                <g>
                    <path xmlns="http://www.w3.org/2000/svg"
                        d="M315.002,0h-300c-8.284,0-15,6.716-15,15v300.004c0,8.284,6.716,15,15,15h170c8.284,0,15-6.716,15-15 c0-8.284-6.716-15-15-15h-155v-130h70V225c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-8.284-6.716-15-15-15s-15,6.716-15,15v55.004 h-70V30h150v75.004c0,8.284,6.716,15,15,15h70c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-55V30h90v180.004h-105 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h105v60h-25c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h40 c8.284,0,15-6.716,15-15V15C330.002,6.716,323.286,0,315.002,0z"
                        fill="currentColor" data-original="#000000" style="" />
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                    <g xmlns="http://www.w3.org/2000/svg"> </g>
                </g>
            </svg> <?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?> <span
                style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d"
                class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch"> <input
                        type="checkbox" onchange="Setthisinput(this)"> <span class="slider round"></span></label></span>
        </h2>

        <?php    $this->renderPartial('_floor_plan');?>
    </div>
    <?php }
	else if(in_array($model->section_id,array('1','2'))){
	?>
    <div class="hide">
        <div id="m_floor_plan" class="padding-top-40"></div>
        <div class="margin-top-0" id="to_florr" style="position: relative;">

            <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0"
                    viewBox="0 0 330.004 330.004" style="enable-background:new 0 0 512 512" xml:space="preserve">
                    <g>
                        <path xmlns="http://www.w3.org/2000/svg"
                            d="M315.002,0h-300c-8.284,0-15,6.716-15,15v300.004c0,8.284,6.716,15,15,15h170c8.284,0,15-6.716,15-15 c0-8.284-6.716-15-15-15h-155v-130h70V225c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-8.284-6.716-15-15-15s-15,6.716-15,15v55.004 h-70V30h150v75.004c0,8.284,6.716,15,15,15h70c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-55V30h90v180.004h-105 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h105v60h-25c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h40 c8.284,0,15-6.716,15-15V15C330.002,6.716,323.286,0,315.002,0z"
                            fill="currentColor" data-original="#000000" style="" />
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                        <g xmlns="http://www.w3.org/2000/svg"> </g>
                    </g>
                </svg> <?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?> <span
                    style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d"
                    class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch"> <input
                            type="checkbox" onchange="Setthisinput(this)"> <span
                            class="slider round"></span></label></span></h2>

            <div class="cotact-row">
                <div class="textraa1">
                    <?php echo $this->tag->getTag('contact_the_agent_to_get_the_r', 'Contact the agent to get the relevant floor plan for this listing') ;?>
                </div>
                <div class="textraa2"><a href="javascript:void(0)" style="width:auto;padding:0px 40px; "
                        onclick="OpenFormClickNewFloorplan(this)"
                        data-reactid="<?php echo $model->id;?>"><?php echo $this->tag->getTag('request_floorplan', 'Request Floorplan') ;?></a>
                </div>
            </div>
        </div>
    </div>
    <?
	
}
?>
</div>




<div class="clearfix"></div>