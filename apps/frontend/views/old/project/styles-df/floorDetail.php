 <style>
	 /*----- Tabs -----*/
.tabs {
    width:100%;
    display:inline-block;
}
 
    /*----- Tab Links -----*/
    /* Clearfix */
    .tab-links:after {
        display:block;
        clear:both;
        content:'';
    }
 
    .tab-links li {
        margin:0px 5px;
        float:left;
        list-style:none;
    }
 
        .tab-links a {
            padding:9px 15px;
            display:inline-block;
            border-radius:3px 3px 0px 0px;
            background:#7FB5DA;
            font-size:16px;
            font-weight:600;
            color:#4c4c4c;
            transition:all linear 0.15s;
        }
 
        .tab-links a:hover {
            background:#a7cce5;
            text-decoration:none;
        }
 
    li.active a, li.active a:hover {
        background:#fff;
        color:#4c4c4c;
    }
 
    /*----- Content of Tabs -----*/
    .tab-content {
        padding:15px;
        border-radius:3px;
        box-shadow:-1px 1px 1px rgba(0,0,0,0.15);
        background:#fff;
    }
 
        .tab {
            display:none;
        }
 
        .tab.active {
            display:block;
        }
        .textct img
        {
			width:100% !important;
		}
		.image-row-holder img
		{
			width:180px !important;
		}
       
 </style>
			<script>
			jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
			</script>			  
						  
 
					
  <div class="main-content">

      <div class="properties" style="top:0;">

        <div class="container">

          <div class="grid_full_width">

			<!-- About US -->

            <div class="about_us">

              
              <div class="welcome">
                <div class="row">
                  <div class="span12"><h3 style="text-align:left; padding:20px 0px;">
					  <?php    
					  
					  if(sizeOf($list)==1) { echo $plan->project1->project_name ;  } else { echo  $plan->project1->project_name.'- '.$plan->floor_plan_name; } 
					  
					  ?>
					  </h3></div>
                  <div class="span8">
                  <div class="property_detail">
                  <div class="infotext-detail">
                  
                      <div class="textct">
						  <style>
					 
						  </style>
						  <?php 
								echo $plan->description;
						  ?>
						 
						 
						   
						
				
							<div style="clear:both;"></div>
                      </div>
                     
                  </div>
                  </div>
                  </div>
                  <div class="span4">
          <div class="box-siderbar-container">
            <!-- sidebar-box map-box -->
            <div class="sidebar-box posts_by categorybox">
				<?php
				if(!empty($list))
				{
					?>
              <h6>Floor Palns</h6>
              <ul>
                 <?php 
                 foreach($list as $k=>$v)
                 {
					 ?>
					 <li>
						 <a href="<?php echo Yii::app()->createUrl($v->slug.'/floorPlan');?>">
							<?php
							if(sizeOf($list)==1)
							{ echo  $v->project1->project_name;  } 
							else { echo  $v->project1->project_name.'- '.$v->floor_plan_name; } 
							?>
						  </a></li>
					 <?
				 }
				 ?>
              </ul>
              <?php
		  }
		  ?>
            </div>
             <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>""));?>
              </div>
            </div>
            <!-- End sidebar-box map-box -->
            
            <!-- sidebar-box our-box -->
            
            <!-- End sidebar-box our-box -->
            
            
            <!-- sidebar-box product_list_wg -->
            <div class="sidebar-box">
               <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>array(),'section_id'=>""));?>
         
          
            </div>
            <!-- End sidebar-box product_list_wg -->
            
            <!-- sidebar-box searchbox -->
            
            <!-- End sidebar-box searchbox -->
            
          </div>
        </div>
                </div>
              </div>

              
              

            </div>

			<!-- End About US -->

			

          </div>

        </div>

      </div>

    </div>
    <style>

.image-row ul li {
    display: inline;
    list-style: outside none none;
    text-align: center;
}
.image-row li {
    display: inline;
    float: left;
    margin: 0 0 15px;
    width: 220px;
}

.image-row .image-row-holder {
    display: inline;
    height: auto;
    width: auto;
}

#floorplans a, #amenities a {
    color: #44484b;
    font-size: 13px;
    font-weight: bold;
}
    </style>
