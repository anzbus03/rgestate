<?php defined('MW_PATH') || exit('No direct script access allowed');?>

<div id="classified-detail-include-p" itemscope itemtype="#">
     <?php
if(Yii::app()->user->hasFlash('success'))
{
	?>
<div class="confirmation"><?php echo Yii::app()->user->getFlash('success');?></div>
<?php
}
if(Yii::app()->user->hasFlash('error'))
{
?>
<div class="error1"><?php echo Yii::app()->user->getFlash('error');?></div>
<?php
}
?>
        <div id="listing-title">
            <div >
                    <h1 id="title" >
                        <span id="listing-title-wrap" class="title" itemprop="name">
                         <?php echo $model->ad_title;?>
                         </span>
						 <?php if(in_array("price",$fields)){ ?><span id="price"  itemscope itemtype="#" itemprop="offers"> &nbsp;-&nbsp;  AED <span id="actualprice" itemprop="price"><?php echo $model->price; ?></span> </span><?php } ?>
                    </h1>
            </div>
        </div>
       <div id="listing-content-wrapper">
  
            <div id="browse_in_widget">
			   <span id="browse_in_breadcrumb">

				<a href="<?php echo Yii::app()->createUrl("searchlist/index?category_id={$model->category_id}");?>"><?php echo $model->category->category_name;?></a> &gt;
				<?php
				if($model->sub_category_id != "")
				{
					?>
				<a href="<?php echo Yii::app()->createUrl("searchlist/index?category_id={$model->category_id}&sub_category_id={$model->sub_category_id}");?>"><?php echo $model->subCategory->sub_category_name;?></a>   &gt;
                    <?php
				}
				?>
				<strong>Details</strong>
				
				</span>
 
			</div><!-- browse_in_widget ends -->

        <div id="listing-col-wrapper">
            <div id="listing-main-col">
				  <?php   if($model->adImagesOnView2) 
  { ?>
                <div id="listing-media-tabs" class="photos-active" onmouseover="$('#thumbs-list').show('slow')" onmouseleave="$('#thumbs-list').hide('slow')">
                            <div id="photos" class="tab rel-photos multiple-photos" >
                                <span id="thumb1" class=" image">
								  
												<?php 
												if($model->adImagesOnView2[0]->status=="A")
												{
													$image  = $model->adImagesOnView2[0]->image_name;
												}
												else
												{
													$image = "wait_approval.png"; 
												}
												 
											 
											 
								 ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl;?>/uploads/ads/<?php echo $image;?>" class="fancybox" id="a-photo-modal-view:18707229" rel="photos-modal" target="_new"  >
																				
									
										 
										<div style="background-image:url( <?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/ads/'.$image, array('scaleAndCrop' => array('width' => '400', 'height' => 298))); ;?>);">
										
										</div>
									
									</a>
                                </span>
                              
                                <ul id="thumbs-list">
                                    <?php
                                        
											if($model->adImagesOnView2)
											{
										       foreach($model->adImagesOnView2 as $k1=>$v1)
										       {
													if($v1->status=="A")
													{
														$image_thumb  = $v1->image_name;
													}
													else
													{
														$image_thumb = "wait_approval.png"; 
													}
												   ?>
															<li>
															<span id="thumb2" class=" image2">
															<a href="<?php echo Yii::app()->request->baseUrl;?>/uploads/ads/<?php echo $image_thumb;?>" id="a-photo-modal-view:18332128" rel="photos-modal" target="_new"  class="fancybox" >

															<div style="background-image:url(<?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/ads/'.$image_thumb, array('scaleAndCrop' => array('width' => '400', 'height' => 298))); ;?>);margin-right:1px;"></div>

															</a>
															</span>
															</li>
												   <?
												   
											   }
												 
												 
											}
											 
											 
											?>
                                             
                                        
                                    

                                    
                                </ul>
                                

                                
                                    <div id="photo-count">
                                        <?php echo  sizeOf($model->adImagesOnView2) ; ?> Photos - Click to enlarge
                                    </div>
                                
                            </div>
                        
                    

                    <div style="clear:both"></div>
                </div>
                
<?php } ?>
                <div id="listing-details">
                    
                        <div id="listing-details-list">
                            <h3 class="listing-details-header">
                                Details: <span>Posted on: <?php echo date('D d F Y', strtotime($model->added_date ))  ?></span>
                            </h3>
                            <ul class="important-fields">
								 
								<?php
								if(in_array("area",$fields)) 
								{
									?>
									<li><span>Area : </span><strong><?php echo $model->area;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("bathrooms",$fields)) 
								{
									?>
									<li><span>Bath Rooms : </span><strong><?php echo $model->bathrooms;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("bedrooms",$fields))
								{
									?>
									<li><span>Bed Rooms : </span><strong><?php echo $model->bedrooms;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("engine_size",$fields))
								{
									?>
									<li><span>Engine Size : </span><strong><?php echo $model->EngineSize->engine_size_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("killometer",$fields))
								{
									?>
									<li><span>Killometer : </span><strong><?php echo $model->killometer;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("model",$fields))
								{
									?>
									<li><span>Model : </span><strong><?php echo isset($model->Model)? @$model->Model->model_name:'Others' ;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("year",$fields))
								{
									?>
									<li><span>Year : </span><strong><?php echo @$model->year;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("color",$fields))
								{
									?>
									<li><span>Color : </span><strong><?php echo @$model->Colors->color_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("door",$fields))
								{
									?>
									<li><span>Door : </span><strong><?php echo @$model->Doors->door_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("bodycondition",$fields))
								{
									?>
									<li><span>Body Condition : </span><strong><?php echo @$model->Bodyconditions->bodycondition_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("mechanicalcondition",$fields))
								{
									?>
									<li><span>Mechanical Condition : </span><strong><?php echo @$model->Mechanicalconditions->mechanicalcondition_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("body_type",$fields))
								{
									?>
									<li><span>Body Type : </span><strong><?php echo @$model->BodyTypes->body_type_name ;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("cylinders",$fields))
								{
									?>
									<li><span>No Of Cylinders : </span><strong><?php echo @$model->getCylinders($model->cylinders ) ;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("warranty",$fields))
								{
									?>
									<li><span>Warranty: </span><strong><?php echo @$model->getWarranty($model->warranty ) ;?></strong></li>
									<?
								}
								?>

								<?php
								if(in_array("employment_type",$fields))
								{
									?>
									<li><span>Employment Type : </span><strong><?php echo $model->EmploymentType->employment_type_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("compensation",$fields))
								{
									?>
									<li><span>Compensation : </span><strong><?php echo $model->compensation;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("age",$fields))
								{
									?>
									<li><span>Age : </span><strong><?php echo $model->age;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("height",$fields))
								{
									?>
									<li><span>Height : </span><strong><?php echo $model->height;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("marital_status",$fields))
								{
									?>
									<li><span>Marital Status : </span><strong><?php echo $model->Marital->marital_name;?></strong></li>
									<?
								}
								?>
								 
								<?php
								if(in_array("religion_id",$fields)) 
								{
									?>
									<li><span>Religion : </span><strong><?php echo $model->Religion->religion_name;?></strong></li>
									<?
								}
								?>
								 
								<?php
								if(in_array("mother_tongue",$fields)) 
								{
									?>
									<li><span>Mother Tongue : </span><strong><?php echo $model->mother_tongue;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("education_level",$fields))
								{
									?>
									<li><span>Education Level : </span><strong><?php echo $model->EducationLevel->education_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("current_occupation",$fields)) 
								{
									?>
									<li><span>Current Occupation : </span><strong><?php echo $model->Occupation->occupation_name;?></strong></li>
									<?
								}
								?>
								<?php
								if(in_array("experience_level",$fields)) 
								{
									?>
									<li><span>Experience Level : </span><strong><?php echo $model->Experience->experience_name;?></strong></li>
									<?
								}
								?>
                                </ul>
                                
                            
                            
                        </div>
						<?php
						if($model->adAmenities)
						{
							?>
							  <div id="listing-details-list">
                            <h3 class="listing-details-header">
                               Amenities
                            </h3>
							<div id="dont_gtrans"></div>
                            

                            <div class="trans_toggle_box">
                              
                                   
							<ul class="important-fields">
							<?php
							foreach($model->adAmenities as $k=>$v)
							{
							echo "<li><span>".$v->amenities->amenities_name."</span></li>";
							}
							?>

						   </ul>
						      
                                 
                            </div>
                        
                    </div>
						<?


						}
						?>  

                   

                        
                            
                                
                                        
                                        
                                
                    <div id="description-text" class="" itemprop="description">
                        <h3 class="listing-details-header">
                            Description: 
                        </h3>

                        
                            
                                <div id="dont_gtrans"></div>
                            

                            <div class="trans_toggle_box">
                                <div id="trans_toggle_text" class="trans_toggle_text">
                                    <span class="title" style="direction: ltr">
                                        <?php echo nl2br($model->ad_description); ?>
                                    </span>
                                </div>
                            </div>
                        
                    </div>

                    
                    
                        
                    

                    
                    
                </div>
                

                
                    <div id="listing-controls">
                        <h3 class="listing-details-header">
                            Share with friends
                        </h3>
                        <div id="listing-social">
                            <?php   $this->widget('frontend.components.web.widgets.SocialShareButton.SocialShareButton');?> 

                            <br />

                            <span class="classified-detail-buttons">
                                <a class="awesome white small" id="email-my-ad-image" href="<?php echo Yii::app()->createUrl("user/send_email",array('url'=>$model->id));?>" >
                                    <i class="u-icon u-icon--email"></i> Email
                                </a>
                            </span>

                            <span id="watch-this" class="classified-detail-buttons">
                                
                                    <span id="c_id_12431979:c_type_200:watch_this"><a title="Click here to Add to Watchlist" href="<?php  echo Yii::app()->createUrl( 'watchlist/index',array('slug'=>$model->slug,'back'=>base64_encode(Yii::app()->request->requestUri)));?>" class="awesome small white"><i class="u-icon u-icon--eye"></i> Watch this</a></span>
                                
                            </span>
                            
                                <span id="report" class="classified-detail-buttons">
                                    
                                        <span id="c_id_12431979:c_type_200:report_this">
                                            <a class="awesome small white" href="<?php  echo Yii::app()->createUrl( 'report/index',array('slug'=>$model->slug,'back'=>base64_encode(Yii::app()->request->requestUri)));?>" title="Click here to Report this listing">
                                                <i class="u-icon u-icon--report"></i> Report Ad
                                            </a>
                                        </span>
                                    
                                </span>
                            
                        </div>
                    </div>

                    

                    <div id="email-my-ad-modal" style="display:none">
                        <div id="email-my-ad-modal-inner">
                            <form method="post">
                                <strong>Email to a friend</strong>
                                <input type="hidden" value="friend" name="form_type">
                                <div><label for="your-name">Your Name:</label><input type="text" name="name" id="your-name" value=></div>
                                <div><label for="friends-email">Friend's Email Address:</label><input type="text" name="friend_email" id="friends-email"></div>
                                <div><label for="message">Message for Friend:</label><textarea name="message" cols="40" rows="5"></textarea><br><input type="submit" value="Send" class="awesome small black"></div>
                            </form>
                        </div>
                    </div>

                    <div id="watchlist-modal-wrapper" style="display:none">
                        <div id="watchlist-modal-content">
                            
                            <div id="watchlist-modal-text">
                                You can save your favorite ads to your Watchlist for easy access.
                                
                                
                                
                                    <ol>
                                        <li>Sign in.</li>
                                        <li>Click on <a href="/profile/">Account</a> link on the top right of dubizzle.</li>
                                        <li>Select <a href="/watchlist/">My Watchlist.</a></li>
                                    </ol>
                                
                            </div>
                            
                        </div>
                    </div>
                

                
                    
                        <a href="#" id="reply-to-this-ad">&nbsp;</a>
                        
                            
                                





















<div id="listing-reply">
    <div id="respond">
        <h3 class="listing-details-header">
            
                Reply to this Ad:
            
        </h3>
        <div class="fieldset-content">
            
                
            

            
                <div class="warning">
                    <strong>Scam Warning:</strong>
                    <div style="clear:both"></div>
                    
                    <p>
                        Never wire money or financial info to a seller on the internet. For your security, all transactions should be done in person.
                    </p>
                    <p>
                        
                        
                        
                            Please <a href="<?php  echo Yii::app()->createUrl( 'report/index',array('slug'=>$model->slug,'back'=>base64_encode(Yii::app()->request->requestUri)));?>" target="_blank">report scams.</a>
                        
                    </p>
                </div>
            

            

            
                <span class="listing-reply-phone">
                    <a href="javascript:"
                       class="awesome medium lite-blue callseller-btn"
                       
                        onclick="$(this).html('<?php echo $model->mobile_number; ?>')">
                        <span>
                            <i class="u-icon u-icon--phone"></i> Show Phone Number
                        </span>
                    </a>
                    <div class="phone-content" >
                        
                            &#8234;0509433525&#8234;
                        
                    </div>
                    <div class="clear"></div>
                </span>
                <span class="or">
                    <span>
                        or
                    </span>
                </span>
            
 
 
            
				<?php  
				
				$form = $this->beginWidget('CActiveForm',array('focus'=>array($model,'email') ,
				'enableAjaxValidation'=>true,
				'clientOptions' => array(
				'validateOnSubmit'=>true,
				),
				)); 
				;?>
                <input type="hidden" name="form_type" value="contact" />
                <div id="ad-respond-form">
                    
                        <div class="cell">
                            <label for="id_email"
                                   id="label_email">Your Email
                                
                            </label>
                           
                            <?php  echo $form->textField($model2, 'email', array_merge($model2->getHtmlOptions('email'),array( "class"=>"textbox" ,"placeholder"=>"" )));  ?>
                        
                        </div>
                        <div class="clear"> </div>
                         <?php echo $form->error($model2, 'email');?>
                         <div class="clear"> </div>
                        <div id="name_phone">
                            <div id="first">
                                <div class="cell">
                                    <label for="id_name">
                                        Your Name
                                        
                                    </label>
                                    
                                    <?php 
                                    	 echo $form->textField($model2, 'name', array_merge($model2->getHtmlOptions('name'),array( "class"=>"textbox" ,"placeholder"=>"" ))); 
                                    ?>
                                </div>
                                  <div class="clear"> </div>
                         <?php echo $form->error($model2, 'name');?>
                          <div class="clear"> </div>
                            </div>
                            <div class="cell">
                                <label for="id_telephone">Phone
                                    
                                </label>
                                  <?php 
                                    	 echo $form->textField($model2, 'phone', array_merge($model2->getHtmlOptions('phone'),array( "class"=>"textbox" ,"placeholder"=>"" ))); 
                                    ?>
                            </div>
                               <div class="clear"> </div>
                         <?php echo $form->error($model2, 'phone');?>
                         <div class="clear"> </div>
                        </div>
                    

                    

                    <div class="block">
                        <label for="id_message">
                            Message
                            
                        </label>
                          
                        <?php echo $form->textArea($model2, 'message',array("rows"=>"10", "cols"=>"40" ,"id"=>"id_message"));  ;?>
                   
                    </div>
                      <div class="clear"> </div>
                         <?php echo $form->error($model2, 'message');?>
                          <div class="clear"> </div>

                    
                        <div id="captcha">
                            <span class="captcha-box">
                                 
							<?php if(CCaptcha::checkRequirements()): ?>
							<?php $this->widget('CCaptcha',
							array('captchaAction'=>'site/captcha','showRefreshButton'=>false,
							'buttonType'=>'button',
							'buttonOptions'=>
							array('type'=>'image',
							'src'=> AssetsUrl::img('refresh.png')  ,
							'style'=>"width:18px;height:18px;",
							),                                                            
							'buttonLabel'=>'Refrescar imagen'),
							false); ?> 
							<?php   echo $form->textField($model2, 'verifyCode', array_merge($model2->getHtmlOptions('verifyCode'),array("placeholder"=>"" ,"class"=>"captcha-input", )));  
		?>
							<?php endif; ?>
							
                            </span>
                            <span class="captcha-hint">
                                Please enter the 5 letters as they appear in the image on the left.
                                
                            </span>
                               <div class="clear"> </div>
                         <?php echo $form->error($model2, 'verifyCode');?>
                         <div class="clear"> </div>
                        </div>
                    

                    
                    <div style="clear:both"></div>
                </div>
                
        </div>

        
                 <div class="terms">
                        <span class="text">
                            
                            
                            
                                <label for="terms">
                                    By clicking on 'Send Reply', I agree to the <?php echo Yii::app()->name;?>
                                    <a href="/terms/">Terms & Conditions</a>
                                    and
                                    <a href="/privacy/">Privacy Policy</a>
                                </label>
                            
                        </span>
                
                    <button type="submit" class="large blue awesome">
                        <i class="u-icon u-icon--email"></i> Send reply
                    </button>
                    </div>
               <?php  $this->endWidget(); ?>
            </div>
        </div>

                            
                        
                    
                
            </div></div>

            <div id="listing-sidebar-col">
                
                    
                        <div id="listing-reply-controls">
                            <a id="email-btn" href="#reply-to-this-ad"   class="awesome medium lite-blue">
                                <i class="u-icon u-icon--email"></i>
                                <span>
                                    Send reply
                                </span>
                            </a>
                            
                                <span class="listing-reply-phone">
                                    <input type="hidden" id="category_id" value="1193" />
                                    <input type="hidden" id="classified_id" value="12431979" />
                                    <!--[[full_url]]?shownumber-->
                                    <a href="javascript:" class="awesome medium lite-blue callseller-btn" onClick="$(this).html('<?php echo $model->mobile_number; ?>')">
                                        <i class="u-icon u-icon--phone"></i>
                                        <span>Show Phone Number</span>
                                    </a>
                                    <div class="phone-content">
                                        
                                    </div>
                                </span>
                            
                        </div>
                    
                

                
                

                <div id="map-wrapper">
                    <div>
                          <div style="height:300px;width:300px;"   id="map_canvas"></div>   
               <?php  
              
				 
				
				if ($model->location_latitude!="" and $model->location_longitude!="") {
					 $lat = $model->location_latitude;
					 $long = $model->location_longitude;				 
				
				} else {
					 if($model->country0->location_latitude!="" and $model->country0->location_longitude!="")
					 {
						  $lat = $model->country0->location_latitude;
						  $long = $model->country0->location_longitude;
					 }
					 else
					 {
					 $lat = 25.18;
					 $long = 55.20;
					 }
					
				}
				
				 
               ?> 
                        
                    </div>

                    <div class="location">
                     
						<?php echo $model->country0->country_name; ?>&nbsp;&gt;&nbsp;<?php echo @$model->state0->state_name; ?> 

                    </div>
                </div>

                
<?php 
	if($relatedAds)
	{
	 
		?>
                
                    <div id="agent_related_ads" class="related_ads"></div>
                     
					<div class="clear"></div>


					<div class="related-listings">
		
						<h4>Related Ads</h4>
         <?php foreach($relatedAds as $k=>$v)
		{
		?>
		<div class="listings">
		<a   class="listing  " href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>">
		<div class="listing_my2" >
		<?php if($v->adImagesOnView2)
		{
			 
		 
			?>
			   <?php 
				if($v->adImagesOnView2[0]->status=="A")
				{
					$image  = $v->adImagesOnView2[0]->image_name;
				}
				else
				{
					$image = "wait_approval.png"; 
				}
				 
	    } 
	    else
	    {
			 $image = "null.png"; 
			 
		}
	    
	    
	    ?>
			
			
            <div class="thumbnail">
                <div style="background-image:url(<?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/ads/'.$image, array('scaleAndCrop' => array('width' => '150', 'height' => 100))); ;?>);"></div>
            </div>
        
			
			<div class="details">
            <h6><?php echo (strlen($v->ad_title)>15) ? substr($v->ad_title,0,15)."..." : $v->ad_title ; ?></h6>

            <p class="location">
                <i class="u-icon u-icon--location"></i> <?php echo @$v->state0->state_name; ?>
            </p>

            <p class="foot">
                
                
                    <span class="price">
                        <small>AED</small>
                        
                            <?php echo $v->price ; ?>
                        
                    </span>
                
            </p>
        </div>

</div>
    </a>
</div> 
			
			
			
			
			
			
			 
            
        
            
<?php
	}
}
	?>        


  


    


                    
                
                
                
                    
                    
                
            </div>
        </div>
    </div>
</div>
<script>
function showMyNumber(k)
{
	$(k).preventDefault();
	$(k).html("<?php echo $model->mobile_number; ?>")
}
</script>

<script type="text/javascript">
	var jQuery = $.noConflict();
		 
			/*
			 *  Simple image gallery. Uses default settings
			 */
 jQuery("#email-my-ad-image").fancybox({
    'width'         : '700px',
    'height'         : '450px',
     
     
      'scrolling'        : 'no'
     
});
			jQuery('.fancybox').fancybox({arrows:true,});
			
		 
</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   
<script type="text/javascript">
var jQuery = $.noConflict();

initMap2(<?php echo $lat; ?>,<?php echo $long; ?>);
var latlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
placeMarker(latlng);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>

 
