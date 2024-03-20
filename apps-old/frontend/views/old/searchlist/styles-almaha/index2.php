<div class="main-content">
  <div class="properties" style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
        <div class="row">
         
         <!-- Main content -->
         <div class="span8">
           <!-- Property detail -->
           <div class="property_detail">
            
            <div class="infotext-detail">
              <div class="grid_full_width" id="fullwidth2">
      <div class="all-text" style="padding-bottom:0px;">
        <h3 style="padding-top:0px; font-size:18px; font-weight:500; width:50%; float:left;">
			<?php   if(!empty($propertytitle)) { echo $propertytitle;  } else { echo 'Property Listing'; } ?></h3>
        <div class="span4 pull-right" >
            <div class="ordering pull-right span_sec_bk">
			<form method="get" id="order_by_form" action="<?php echo Yii::app()->createUrl(Yii::app()->request->getQuery('slug'));?>">
              <input type="hidden" name="keyword" value="<?php echo Yii::app()->request->getQuery("keyword");?>">
              <input type="hidden" name="property-type" value="<?php echo Yii::app()->request->getQuery("property-type");?>">
              <input type="hidden" name="min-price" value="<?php echo Yii::app()->request->getQuery("min-price");?>">
              <input type="hidden" name="max-price" value="<?php echo Yii::app()->request->getQuery("max-price");?>">
              <input type="hidden" name="bedrooms" value="<?php echo Yii::app()->request->getQuery("bedrooms");?>">
              <input type="hidden" name="bathrooms" value="<?php echo Yii::app()->request->getQuery("bathrooms");?>">
              <select class="orderby custom-select" name="order">
                <option <?php echo  (Yii::app()->request->getQuery("order")=="recent" )? "selected=true" : ""; ?>  value="recent">Most Recent</option>
                <option <?php echo  (Yii::app()->request->getQuery("order")=="featured" )? "selected=true" : ""; ?> value="featured">Featured</option>
                <option <?php echo  (Yii::app()->request->getQuery("order")=="low-to-high" )? "selected=true" : ""; ?>  value="low-to-high">Price, Low to High</option>
                <option <?php echo  (Yii::app()->request->getQuery("order")=="high-to-low" )? "selected=true" : ""; ?> value="high-to-low">Price, High to low</option>
              </select>
              
              <input type="hidden" name="page" value="<?php echo Yii::app()->request->getQuery("page");?>">
              </form>
              <script>
              $('.orderby ').change(function(){  $("#order_by_form").submit();  })
              </script>
            </div>
          </div>
      </div>
      
      <div class="row">
        <div class="grid_list_product st2">
			<style>
			.span500
			{
				width:500px !important;
			}
			</style>
          <ul class="products" id="able-list">
			  <?php
			  $propertyId = array(); /*define for not include on related properties */
			  if($models) :
			  
			  foreach($models as $k=>$v) :
					$image =  $v->renderImage(@$v->adImages[0]->xml_image,$v->xml_type,@$v->adImages[0]->image_name);
					$propertyId[] = $v->id;
					 
				 
				   ?>
				   
					 <li style="display: block;box-shadow:none !important;" class="span10 first house offices Residential" >
					  <div class="product-item" style="padding-bottom:0px;">
						<div class="row">
						  <div class="span4" style="width:280px">
							<div class="imagewrapper" style="height:175px;width:260px;overflow:hidden;" >
							 <a href="<?php echo Yii::app()->createUrl($v->slug.'/detailView');?>"> 
							 <img alt="" width="" height="" src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  urlencode($image)  ;?>&h=174&w=260&zc=1"></a>
							</div>
						  </div>
						  <div class="span6 span500" style="margin-left:0px;">
							<div class="list-right-info" style="padding-top:0px;">
							  <h3 style="max-height:36px;;overflow:hidden;"><a  style="font-size:18px !important; color:#967930;line-height:22px;" href="<?php echo Yii::app()->createUrl($v->slug.'/detailView');?>"   title="<?php echo $v->ad_title;?>">  <?php echo (strlen($v->ad_title)>100)? substr($v->ad_title,0,100).'...':$v->ad_title ;?> </a></h3>
							
							  <div class="row">
								  
								  
								  
								  <div class="span6 span500">
								  <ul class="title-info">
									<li>
										 <span style="font-size:18px;font-weight:bold;float:left;color:#000;"><small><?php echo  $v->currencyAbreviation($v->currency_abr);  ?>   </small><?php echo  $v->FomatMoney( ( $v->section_id == $v::SALE_ID ) ?  $v->price : $v->Rent )  ;?><?php echo  ( $v->section_id == $v::RENT_ID ) ? ' / Yr' : '';  ?></span>
										<span style=" color:#000;">
										<?php
										if($v->bathrooms!="0" and $v->bedrooms !="0" )
										{
											?>
												 <img src="<?php echo AssetsUrl::img('bedroom.png');?>" style="height:20px;padding-bottom:7px;" alt="not">&nbsp;<?php echo   $v->bedrooms;?>  <img src="<?php echo AssetsUrl::img('bathroom.png');?>" style="height:20px;padding-bottom:7px;" alt="not">&nbsp;<?php echo   $v->bathrooms ;?> 
											<?
										}
										elseif ($v->bathrooms!="0")
										{
											?>
											 <img src="<?php echo AssetsUrl::img('bathroom.png');?>" style="height:20px;padding-bottom:7px;" alt="not">&nbsp;<?php echo   $v->bathrooms ;?>
											<?
										}
										elseif($v->bedrooms!="0")
										{
											?>
											 <img src="<?php echo AssetsUrl::img('bedroom.png');?>" style="height:20px;padding-bottom:7px;" alt="not">&nbsp;<?php echo   $v->bedrooms;?> 
											<?
										}
										else
										{
											?>
											Location   <span style=" color:#000;"><?php echo   $v->state0->state_name ;?>  
											<?
										}
										?>
										</span>
										</li>
								  </ul>
								</div>
								<div class="span6 span500">
								  <ul class="title-info">
									<li>Type : <span style=" color:#000;"> <?php echo $v->category->category_name;?><?php echo (!empty($v->subCategory->sub_category_name)) ? '/'.$v->subCategory->sub_category_name : '' ;?></span> </li>
									<li>Property : <span style=" color:#000;"><?php echo $v->property_name ;?></span></li>
								  </ul>
								</div>
								<div class="span6 span500">
								  <ul class="title-info">
									<li> Size :<span style=" color:#000;"><?php echo number_format($v->builtup_area,0,'','');?> <?php echo ($v->area_measurement=="")?'Sq.Ft.':$v->area_measurement ;?></span></li>
									
								  </ul>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					</li>
				   <?
				   
				   endforeach;
			  
			  else : 
			 
				  echo"<p style=\"text-align:center\"><b>No Listing Found.</b></p>";
			  
			  endif;
			 
			  ?>
           
          </ul>
        </div>
      </div>
      <!-- Page-ination -->
		 
      <div class="page-ination">
        <div class="page-in">
          <ul class="clearfix">
             <?php 
		//if($pages->itemCount>3){
		$this->widget('frontend.components.web.widgets.SimplaPager', array(
		'pages'=>$pages,'maxButtonCount'=>7,
		));  
		//}
		?>
          </ul>
        </div>
      </div>
      <!-- Page-ination -->
      
    </div>
            </div>
          </div>
          <!-- End Property -->
        </div>
        <!-- End Main content -->  
        
        
        <!-- Sidebar left  -->
         <div class="span4">
          <div class="box-siderbar-container">
        <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>$mode));?>
        </div>
        </div>
            <!-- End sidebar-box map-box -->
            
            <!-- sidebar-box our-box -->
            
            <!-- End sidebar-box our-box -->
            
            
            <!-- sidebar-box product_list_wg -->
             <div class="sidebar-box">
                 <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>$propertyId,'section_id'=>$sectionId));?>
         
            </div>
            <!-- End sidebar-box product_list_wg -->
            
            <!-- sidebar-box searchbox -->
            
            <!-- End sidebar-box searchbox -->
            
          </div>
        </div>
        <!-- End Sidebar left  -->
        
      </div>
    </div>
  </div>
</div>
</div>
