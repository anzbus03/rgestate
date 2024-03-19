<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<?php defined('MW_PATH') || exit('No direct script access allowed');?>
  <div class="main-content">

      <div class="properties" style="top:0;">

        <div class="container">

          <div class="grid_full_width">

			<!-- About US -->

            <div class="about_us">

              
              <div class="welcome">
                <div class="row">
                  <div class="span12"><h3 style="text-align:left; padding:20px 0px;"><?php echo $article->title;?></h3></div>
                  <div class="span8">
                  <div class="property_detail">
                  <div class="infotext-detail">
                  <style>
                  .textct p { text-align:justify; }
                  </style>
                      <div class="textct">
                       <?php echo $article->content;?>
                      </div>
                  </div>
                  </div>
                  </div>
                  <div class="span4">
          <div class="box-siderbar-container">
            <!-- sidebar-box map-box -->
             
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
