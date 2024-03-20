<div class="main-content">
  <div class="properties" style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
		        <div class="shop-nav clearfix">
          <div class="row">
            <!--<div class="span6">
              <div class="list-grid inleft">
                <ul>
                  <li><a class="active" href="sale.html"><i class="grid4col"></i></a></li>
                
                  <li><a href="listings.html"><i class="grid2list"></i></a></li>
                </ul>
              </div>
            </div>-->
          <?php if(!empty($models))
          {
			  ?>
              <div class="ordering   ">
              <strong style="color:#000; font-size:20px; font-weight:400;margin-left:20px;">Developers  </strong>  
        <?php
        }
        ?>      </div>
            
          </div>
        </div>
        <div class="row">
      
         <!-- Main content -->
         <div class="span8">
           <!-- Property detail -->
           <div class="property_detail">
            
            <div class="infotext-detail">
				
              <div class="" id="">
      <div class="all-text" style="padding-bottom:0px;border-bottom:0px;">
 
      
      <div class="row">
        <div class="grid_list_product st2">
          <ul class="products" id="able-list">
			  <?php
			   
			  if($models) :
			  
			  foreach($models as $k=>$v) :
					$image =  $v->renderImage(@$v->logo);
				 
				   ?>
				   
					 <li style="display: block;box-shadow:none !important;" class="span10 first house offices Residential" >
					  <div class="product-item" style="padding-bottom:0px;">
						<div class="row">
							  <h3><a  style="font-size:20px !important; color:#967930;"  target="_blank"  href="<?php echo  $v->link_url ;?>"   title="<?php echo $v->developer_name;?>">  <?php echo (strlen($v->developer_name)>40)? substr($v->developer_name,0,40).'...':$v->developer_name ;?> </a></h3>
							
						  <div class="span8" style="width:95%;text-align:justify;">
							<div class="" style="height:120px;"  >
							 <a href="<?php echo  $v->link_url ;?>" target="_blank"> 
							 <img alt=""  align="left" style="width:auto  !important; height:auto !important; padding-right:10px; padding-bottom:10px;"alt="<?php echo $v->developer_name;?>" src="<?php   echo  Yii::app()->apps->getBaseUrl('uploads/developer/'.$image)   ;?>"></a>
							  <span style=""><?php echo  nl2br($v->description) ;?> </span>
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
		 
  
		<?php 
		if($pages->itemCount>10){
		?>
		<div class="page-ination">
		<div class="page-in">
		<ul class="clearfix">
		<?
		$this->widget('frontend.components.web.widgets.SimplaPager', array(
		'pages'=>$pages,'maxButtonCount'=>7,
		));  
		?>
		</ul>
		</div>
		</div>
		<?
		}

		?>
          
      <!-- Page-ination -->
      
    </div>
            </div>
          </div>
          <!-- End Property --> <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        </div>
        <!-- End Main content -->  
        
        
        <!-- Sidebar left  -->
         <div class="span4">
          <div class="box-siderbar-container">
        <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>""));?>
        </div>
        </div>
            <!-- End sidebar-box map-box -->
            
            <!-- sidebar-box our-box -->
            
            <!-- End sidebar-box our-box -->
            
            
            <!-- sidebar-box product_list_wg -->
             <div class="sidebar-box">
                 <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>array(),'section_id'=>''));?>
         
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
