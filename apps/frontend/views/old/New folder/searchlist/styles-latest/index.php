<?php defined('MW_PATH') || exit('No direct script access allowed');
   function binderCloseforul($rws)
  {
   if($rws%2==0)
   {
	   echo '</ul><ul class="features">';
   }  
  }
  $icon_json_url = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=';
?>
<?php
if(Yii::app()->user->hasFlash('success'))
{
	?>
<div class="confirmation"><?php echo Yii::app()->user->getFlash('success');?></div>
<?php
}
?>
<style>
#browse_in_widget .browse_in_widget_col li {
    color: #004276;
    float: left;
    margin-bottom: 4px;
    padding: 1px 1px 1px 0;
    width: 180px !important;
}

#browse_in_widget .browse_in_widget_col {
    
    width: 100% !important;;
}

</style>
  <div class="group-set " id="listing-results">
        <div class="group-header">
            <h1>
                    <?php echo $pages->itemCount;?> ads <?php if(!empty($subcategory)) { echo " for  "; echo $subcategory->sub_category_name; }else if(!empty($category)) { echo " for "; echo $category->category_name; } ?><?php if(Yii::app()->request->cookies['state']->value) { $state_id =   Yii::app()->request->cookies['state']->value; echo " in ";echo Yii::app()->request->cookies['state_name']->value; }else{ $state_id = ""; } ?>,<?php echo Yii::app()->request->cookies['country_name'];?>
            </h1>
            <div id="email_alerts-top-wrap">
                
                    <div <?php if(!$saved) { ?> style="display:block;" <?php }else { ?> style="display:none;"<?} ?> class="unsaved_search_btn"><a id="email_alerts"  href="<?php echo Yii::app()->createUrl("user/signin");?>" <?php if( Yii::app()->user->getId()!="") { echo  'onclick="return saveEmail(event)"';} ?>   >Save Search</a></div>
              <script>
						function saveEmail(e)
						{
							e.preventDefault();
						 
							  
							
							$.get("<?php echo Yii::app()->createUrl('user/saveAlert');?>?category=<?php echo @$category->category_id;?>&sub_category=<?php echo @$subcategory->sub_category_id;?>&country=<?php echo Yii::app()->request->cookies['country']->value;?>&state=<?php echo Yii::app()->request->cookies['state']->value;?>&url=<?php echo urlencode(Yii::app()->request->url);?>",function(data){
										
										var id = parseInt(data);
										 
										$.fancybox({
											 href:'<?php echo Yii::app()->request->baseUrl;?>/index.php/user/emailalert/id/'+id,
										'type': 'iframe',
										'minHeight': 250,
										'showCloseButton':false,
										'padding' : 0,  
										'margin' : 0,  
										'left' : 0,  
										'top' : 0,  
										'width': 500,
										'height': 240,
										closeClick : false,
										modal: true,
										beforeShow: function() {

										}
										});
								
								})
						}
					
					</script>
                    <div class="ajax_saved_search_btn"  <?php if(!$saved) { ?> style="display:none;" <?php }else { ?> style="display:block;"<?} ?> ><a id="email_alerts" href="/email_alerts/" onClick="return dbzglobal_event_adapter(this,'email_alerts');">Saved</a></div>
                
            </div>
        </div>

        <div class="group-sub-header">
            <div id="view-as-links">
                View as: <a id="list-view-trigger" class='active viewer_list' >List</a> | <a id="map-view-trigger" class="viewer_list" >Map</a>
            </div>

            <div id="sort">
                <form id="sort-form" onsubmit="return price_change(event)">
                    <tr><th><label for="id_sort_by">Sort by:</label></th><td>
					 
					<?php
					echo CHtml::dropDownList('select',$order_val,array("1"=>"Price ASC","2"=>"Price Desc","3"=>"Date ASC","4"=>"Date Desc",),array("id"=>"select_price", "empty"=>"Default Order","style"=>"width:120px;")); 
					?>
					</td></tr>
                    <input id="sort-button" type="submit" value="Sort" />
                </form>
            </div>
        </div>

        <div class="group-content">
          
<div id="browse_in_widget">
        <span id="browse_in_breadcrumb">

        Browse results in:
        
          <?php if(!empty($state)) echo  $state->state_name;?><?php if(!empty($category)) { echo " &gt ";echo $category->category_name; } ?><?php if(!empty($subcategory)) { echo " &gt"; echo $subcategory->sub_category_name; } ?><?php if( $keyword!="" ) { echo " &gt ";echo $keyword; } ?>
            
        </span>

        
            <div id="browse-in-show-hide">
                [ <strong id="show-hide-symbol"> -  </strong> ]
            </div>
        <?php
	if($adscountlist and isset($adscountlist->subcategories))
	{
		 //echo "DSD";exit;
		echo ' <div id="browse-in-category-list"><div class="browse_in_list "><div id="show" ><ul class="browse_in_widget_col">'; 
		foreach($adscountlist->subcategories as $k=>$v)
		{
			if($k=="12")
			{
				echo "</ul></div><div id='hide' style='display: none;'><ul class='browse_in_widget_col'>";
			}
			$newRoute = $attributes ;
			$newRoute["category_id"]=$v->category_id; 
			$newRoute["sub_category_id"]=$v->sub_category_id; 
			 
			?>
			 <li> <a href="<?php  echo  Yii::app()->createUrl("searchlist/index", array_filter($newRoute));?> "> <?php echo $v->sub_category_name?></a><span> &#x202C;&nbsp;&#x202B;(<?php echo $v->adsCount ; ?>)</span></li>
 
			<?
		}
		  echo ' </ul></div></div>';
		 
	}
	else if($categoryadlist)
	{
		 
		echo ' <div id="browse-in-category-list"><div class="browse_in_list "><div id="show" ><ul class="browse_in_widget_col">'; 
		foreach($categoryadlist as $k=>$v)
		{
			if($k=="12")
			{
				echo "</ul></div><div id='hide' style='display: none;'><ul class='browse_in_widget_col'>";
			}
		 
			$newRoute = $attributes ;
			$newRoute["category_id"]=$v->category_id; 
			 
			?>
				<li> <a href="<?php  echo  Yii::app()->createUrl("searchlist/index", array_filter($newRoute));?> "> <?php echo $v->category_name?></a><span>  &#x202C;&nbsp;&#x202B;(<?php echo $v->adsCount ; ?>)</span></li>
 
		
			<?
		}
		  echo ' </ul></div></div>';
	 
	}
        
 
   
   
    ?>
        	
        
  <?php
   if($k>12)
   {
	   ?>
    <div id="show-all-link"><a href="#" id="browse_in_displayall">Show All</a></div>
   <?php
   }
   ?>
        
    
    </div>
    

</div><!-- browse_in_widget ends -->

            

        </div>

        <div class="group-content" xtdztype="CZSE">

            <div id="results-list" class="show-highlighted-ads"  >
                        <!--  start time: 1416510371.19 -->
             <?php 
             if($model)
			 {
				 	 
				foreach($model as $k=>$v)
				{
				  
				  $fields=  ($v->subCategory->change_parent_fields=="N") ? CHtml::listData($v->subCategory->category->relatedFields,'field_name','field_name'):CHtml::listData($v->subCategory->relatedFields,'field_name','field_name');
                   ?>
                     <div class="list-item-wrapper">
						 <?php
				if($v->featured=="Y")
				{
				?>
					<div class="futured"></div> 
				<?php }
				
				
				 ?>
						   <div class="cf item <?php echo  ($v->featured=="Y")?'paid-featured-item':'';?> featured-motors">
								<?php
								 if($v->featured=="Y")
								 {?>
								<div class="paid-featured-item-badge-rl">
								<span class="feature-text back_span">Featured</span>
								</div>
								<?php
							    }
							    ?>
							<div class="listing-item">
								 <div class="block item-title">
									<h3 id="title" >
										 <span class="title" style='direction: ltr'>
										 <a href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>"><?php echo (strlen($v->ad_title)>80) ? substr($v->ad_title,0,80)."..."  : $v->ad_title   ?></a>
										 </span>
									</h3>
									<div class="price">
									<?php
									if(in_array("price",$fields))
									{
									?>
									AED <?php echo $v->price; ?> 
									<?php
									}
									?>
									<br/>
									</div>
								</div>
								 <div class="block has_photo">
											<?php
												if($v->adImagesOnView2)
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
														$image = "wait_approval.png"; 
													}
												 ?>
                    
                        
                            <div class="thumb">
                                <a href="" xtclib="listing_list_16_thumb_link" xtcltype="S">
                                  
											   <div style="background-image:url( <?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/ads/'.$image, array('scaleAndCrop' => array('width' => 200, 'height' => 150))); ;?> );"></div>
										
                                   
                                </a>

                                <span class="image-count">
                                    <?php
                                    if($v->adImagesOnView2)
                                    {
										echo sizeOf($v->adImagesOnView2).' images';
									}
                                    ?>
                                        
                                    
                                </span>
                            </div>
                            
                            
								 <div class="description">
									<div class="block">
										<p class="breadcrumbs"> <?php echo $v->category->category_name; ?>  &#8234;&gt;&#8234;   <?php echo $v->subCategory->sub_category_name; ?> </p>
									</div>
									
									<ul class="feature">
									<li>
										<div  class="listing-agent">
											
											 <?php 
											 if($image = $v->Customer->image)
											 {
												 
													if(ListingUsers::model()->is_image(Yii::app()->basePath . '/../../uploads/avatar/'.$image)=='1')
													{
													$image = Yii::app()->basePath . '/../../uploads/avatar/'.$image;
													}
													else
													{
													$image = Yii::app()->request->baseUrl . '/uploads/avatar/default_avatar.png';
													}
											 }
											 else
										     {
												 
												$image =  Yii::app()->basePath . '/../../uploads/avatar/default_avatar.png';
											  }
											 ?>
											   
											<a href="#">
											  <?php
											  
											echo 	Yii::app()->easyImage->thumbOf($image,
												array(
												'resize' => array('width' =>85, 'height' => 35 ),
												 
												'sharpen' => 50,
											 
												'background' => '#4B4B4B',
												'type' => 'jpg',
												'quality' => 60,
												
												));
											  ?>
											</a>
										 
										 
										</div>
										<p class="date"><?php echo date('D d F Y', strtotime($v->added_date ))  ?></p>
								
									</li>
									<li>
										 <ul class="features">
									      <?php
									      $li='';
									      $rows_count =0;
										  if(in_array("area",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li>Area : <strong><?php echo $v->area;?></strong></li>
										   
										   <?php 
										   $li.='<li>Area : <strong>'.$v->area.'</strong></li>';
										    binderCloseforul($rows_count);
										   
										  } 
										  ?>       
										  <?php
										  if(in_array("bathrooms",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Bathrooms :  <strong><?php echo $v->bathrooms;?></strong></li>
										   <?php 
										   $li.='<li> Bathrooms :  <strong>'. $v->bathrooms.'</strong></li>';
										    binderCloseforul($rows_count);
										   }  
										   ?>       
										 <?php
										  if(in_array("bedrooms",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Bedrooms :  <strong><?php echo $v->bedrooms;?></strong></li>
										   <?php 
										   $li.='<li> Bedrooms :  <strong>'. $v->bedrooms.'</strong></li>';
										    binderCloseforul($rows_count);
										  }  
										  ?>       
										  <?php
										  if(in_array("engine_size",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Engine Size :  <strong><?php echo $v->EngineSize->engine_size_name;?></strong></li>
										  <?php 
										  $li.='<li> Engine Size :  <strong>'.$v->EngineSize->engine_size_name.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("killometer",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Kilometer :  <strong><?php echo $v->killometer;?></strong></li>
										  <?php 
										  $li.='<li> Kilometer :  <strong>'. $v->killometer.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("model",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Model :  <strong><?php echo isset($v->Model)? @$v->Model->model_name:'Others';?></strong></li>
										  <?php
										  $li.='<li> Model :  <strong>'. isset($v->Model)? @$v->Model->model_name:'Others'.'</strong></li>'; 
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("year",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Year :  <strong><?php echo $v->year; ?></strong></li>
										  <?php 
										  $li.='<li> Year :  <strong>'.$v->year.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("employment_type",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Employment Type :  <strong><?php echo $v->EmploymentType->employment_type_name;?></strong></li>
										  <?php 
										  $li.='<li> Employment Type :  <strong>'.$v->EmploymentType->employment_type_name.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("compensation",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Compensation : <strong><?php echo $v->compensation;?></strong></li>
										  <?php 
										  $li.='<li> Compensation : <strong>'. $v->compensation.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("age",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Age :  <strong><?php echo $v->age;?></strong></li>
										  <?php 
										  $li.='<li> Age :  <strong>'. $v->age.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>       
										  <?php
										  if(in_array("height",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Height :  <strong><?php echo $v->height;?></strong></li>
										  <?php 
										  $li.='<li> Height :  <strong>'. $v->height.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?> 
											<?php
										  if(in_array("religion_id",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Religion :  <strong><?php echo $v->Religion->religion_name;?></strong></li>
										  <?php 
										  $li.='<li> Religion :  <strong>'. $v->Religion->religion_name.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>        
										  <?php
										  if(in_array("marital_status",$fields))
										  {
											  $rows_count++;
										   ?>
										   <li> Marital status : <strong><?php echo $v->Marital->marital_name;?></strong></li>
										  <?php 
										  $li.='<li> Marital status : <strong>'. $v->Marital->marital_name.'</strong></li>';
										   binderCloseforul($rows_count);
										  } 
										  ?>      
										</ul>
										 
									</li>
							
									</ul>
								</div> <!-- description ends -->
								<div class="badges-list-v badges-motors">
								<ul class="badges-list"></ul>
								</div>
								<br class="clear" />
							<div class="block">
								<div class="location">
									<i class="span_location"></i>
									Located : <?php echo $v->country0->country_name; ?>  &#8234;&gt;&#8234; <?php echo $v->state0->state_name; ?> 
								</div> <!-- LOCATION ENDS -->
								<div class="item-controls">
								<span class="watchlist">
								<a id="c_id_12558696:c_type_200:watch_this" class="details-watch-this" xtcltype="S" xtclib="listing_list_2_watched_link" title="Click here to Add to Watchlist" href="<?php  echo Yii::app()->createUrl( 'watchlist/index',array('slug'=>$v->slug,'back'=>base64_encode(Yii::app()->request->requestUri)));?>"> </a>
								</span>
								<span id="c_id_12558696:c_type_200:report_this" class="report-this">
								<a xtcltype="S" xtclib="listing_list_2_report_this_link" href="<?php  echo Yii::app()->createUrl( 'report/index',array('slug'=>$v->slug,'back'=>base64_encode(Yii::app()->request->requestUri)));?>" title="Click here to Report this listing"> </a>
								</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  
					<style>
					.pos_hea_googlemap { width:100%; ;width:300px;padding:10px; } 
					.pos_title_googlemap { 
							font-size: 18px !important;
							margin-bottom: 5px !important;
							margin-top: 5px !important;
							text-align:left !important;
							color:#83051F;
						 } 
					.clear_both { clear:both; }
					.pos_hea_googlemap_img{ width:100px;float:left; }
					.pos_hea_googlemap_img img{ margin-top:0px !important; }
					.pos_rigght_map{ width:190px;float:left;padding-left:10px;text-align:left !important;} 
					.pos_right_amount { 
						color: #950b2e !important;
						float: left;
						font-size: 16px !important;
						font-weight: bold;
						margin: 0 !important;
						padding: 0 !important;
						width: 100%;
						}
						.listing_gmap li
						{
							list-style-type:none;
						}
					</style>						
								
                   <?
						$count_list = $k+1;
                        $tit_google =  (strlen($v->ad_title)>84) ? substr($v->ad_title,0,84)."..."  : $v->ad_title;
						$CONTENT ='<div class="pos_hea_googlemap">';
						$CONTENT .='<h1 class="pos_title_googlemap"><span style="color:#8C0429">'.$count_list.'.&nbsp;</span>'.$tit_google.'</h1>';
						$CONTENT .='<div class="clear_both"></div>';
						$CONTENT .='<div style="width:100%;">';
						$CONTENT .='<div class="pos_hea_googlemap_img"><img src="'.  Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/ads/'.$image, array('scaleAndCrop' => array('width' => 100, 'height' => 70)))  .'">';

						$CONTENT .='</div>';
						$CONTENT .='<div class="pos_rigght_map">';
						if(in_array("price",$fields))
						{
						$CONTENT .='<h2 class="pos_right_amount">AED '.$v->price.'</h2>';

						}
						
						$CONTENT .='<div class="listing_gmap">'.$li.'</div>';

						$CONTENT .='<div style="clear:both;"></div></div>';

						$CONTENT .='</div>';
						$CONTENT .='<div style="clear:both;"></div></div>';
                    
                        $location_json[] = array($CONTENT,$v->location_latitude,$v->location_longitude);
                        
                        //$icon_json[]     = array($icon_json_url.$count_list."|FF0000|FFFFFF");
			    }
			?>               
                            
      
         <!--  start time: 1416510371.19, time delta: 0.156203985214 -->
                    
                

                
                
                    
                

            </div> 

   <div id="results-list-gmap" style="width:762px;display:none" >
                 
                    
                         
		<div class="pagingarea">
		<div class="actions">
		<?php 
		//if($pages->itemCount>3){
		$this->widget('frontend.components.web.widgets.SimplaPager', array(
		'pages'=>$pages,
		));  
		//}
		?>
		</div></div>           
                

                
                    
                        
                            
	<script type="text/javascript">
	//<![CDATA[
		
		dbzglobal_attach_cb(function(){
				
					DbzGlobal.setCenter(25.126512532,55.2476034203);
				
					
						DbzGlobal.m_homeZoomLevel = 10;
					
				
			
				

		});
		
	//]]>
	</script>

	

	
		<div id="gmap-wrapper" style="height:420px;width:762px;">
			<div id="gmap-loading" style="height:420px;width:762px;">
				<img style="margin-top:px;" src="http://m.dbzstatic.com/assets/images/elements/loading.gif" alt="loading" />
			</div>
	

	
			<div id="gmap" style="height:420px;width:744px;">
	
			</div>
		</div>
	<div id="gmapTooltips"></div>


                        
                    
                    
                

                <p class="map-hint">Hover over pins on the map to see ad details.</p>

                <ol id="map-results">
                <?php 
                
                if($model)
                {
					 
				 foreach($model as $k=>$v)
				 {
					 ?>
					 <li>
						<h3 id="title">
							<span class="titles-alllang">
								<span class="title" style='direction: ltr'><a href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>"> <?php echo $k+1 .' '.(strlen($v->ad_title)>84) ? substr($v->ad_title,0,84)."..."  : $v->ad_title   ?> </a></span>
							</span>
						</h3>
						<span class="price">
						<?php
								if(in_array("price",$fields))
								{
								?>
								AED <?php echo $v->price; ?> 
								<?php
								}
						 ?>
						</span>
					</li>
					 <?
				 }
				}
                
                ?> 
                    
                </ol>

                
                
                    
                

               
            </div>

        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
 

 <script type="text/javascript">
	  
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = <?php echo json_encode($location_json);?>
    
    // Setup the different icons and shadows
    var iconURLPrefix = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=1|FF0000|FFFFFF';
   
    
    var icons = [
      iconURLPrefix + 'chst=d_map_pin_letter&chld=1|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=2|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=3|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=4|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=5|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=6|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=7|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=8|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=9|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=10|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=11|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=12|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=13|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=14|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=15|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=16|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=17|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=18|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=19|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=20|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=21|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=22|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=23|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=24|FF0000|FFFFFF',
      iconURLPrefix + 'chst=d_map_pin_letter&chld=25|FF0000|FFFFFF',
    
    ]
    var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(15,33),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };

 
  
  </script> 
        <?php
         }
         else
         {
			 echo '</div></div>';
		 }
			
			 ?>  
        <style>
			.paging_back_inactive
			{
			background-color: #eeeeee;
			border-color: #d8d9da;
			color: #989898;
			border-radius: 0.166667em;
			border-style: solid;
			border-width: 1px 1px 3px;
			display: inline-block;
			padding: 0.833333em 1.16667em;
			text-decoration: none;
			}
        </style>

				<div class="pagingarea">
				<div class="actions">
				<?php 
				//if($pages->itemCount>3){
					
				 
				$this->widget('frontend.components.web.widgets.SimplaPager', array(
				'pages'=>$pages,
				));  
				//}
				?>
				</div></div>
				 
                
            

            
                <div id="email_alerts-wrap" class="unsaved_search_btn"><a id="email_alerts_bot" href="/email_alerts/?nonjs" onClick="return dbzglobal_event_adapter(this,'email_alerts');">Save search.</a> We&#39;ll send you an email when new ads match your search.</div>
                <div id="email_alerts-wrap" class="ajax_saved_search_btn" style="display: none;"><a id="email_alerts_bot" href="/email_alerts/?nonjs" onClick="return dbzglobal_event_adapter(this,'email_alerts');">Save search.</a> We&#39;ll send you an email when new ads match your search.</div>
            

            <div id="place-an-ad-bar">
                
                Where cars that go, go! Sell yours here...
                <a id='paa_pagination_201_en' class="paa_pagination_metric_201 paa_pagination_lang_en" href="<?php echo Yii::app()->createUrl("place_an_ad/create");?>"> Place your ad</a>
                
            </div>

        
    </div>

  <script>
  $(function(){
  
  $("#browse_in_displayall").click(function(){    
	  
	   $("#hide").toggle();
	   if($(this).html()=="Show All")
	   {
		  
		   $(this).text("Hide");
		   return false;
	   }
	  
	   if($(this).html()=="Hide")
	   {
		   $(this).text("Show All");
		   return false;
	   }
	  
	  })
  
  });
  function price_change(e)
{
	 
	$("#price").val($("#select_price").val());
	 
	$('#search-widget-form :input[value=""]').attr('disabled', true);
	$("#search-widget-form").removeAttr("onsubmit");
	$("#search-widget-form").submit();
    return false;
}
$("#map-view-trigger").click(function(){
	 
	 $(".viewer_list").toggleClass("active");
	  $( "#results-list" ).fadeOut( "slow", function() {
        showMap()
      });
	 
	function showMap()
	{
	$("#results-list-gmap").fadeIn("slow",function(){  showMap2() });
    }
    function showMap2()
    {
		var map = new google.maps.Map(document.getElementById('gmap-loading'), {
      zoom: 10,
      center: new google.maps.LatLng(-37.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 360,
      minWidth: 360,
    });

    var marker;
    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : icons[iconCounter],
        shadow: shadow
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= icons_length){
      	iconCounter = 0;
      }
    }

    function AutoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      $.each(markers, function (index, marker) {
        bounds.extend(marker.position);
      });
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
     AutoCenter();
	}
	 
		
	
});
$("#list-view-trigger").click(function()
{
	$(".viewer_list").toggleClass("active");
	$("#results-list-gmap").fadeOut("slow",function(){  
		
		  $( "#results-list" ).fadeIn( "slow");
		
	 });
}
)
 
  </script>
