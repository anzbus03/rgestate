  <div class="main-content">

      <div class="properties" style="top:0;">

        <div class="container">

          <div class="grid_full_width">

			<!-- About US -->

            <div class="about_us">

              
              <div class="welcome">
                <div class="row">
                  <div class="span12"><h3 style="text-align:left; padding:20px 0px;"><?php echo  $article->name;?></h3></div>
                  <div class="span8">
                  <div class="property_detail">
                  <div class="infotext-detail">
                  
                      <div class="textct">
						  <style>
						.textct img { width:100% !important;height:auto !important;padding:20px 0px  !important; }
						.textct h3 {  padding-top:10px !important; }
						.textct ul {
						font-family: Arial,Helvetica,sans-serif;
						list-style: outside url("../images/floorplan-list.png") disc;
						margin: 10px 0 0 50px;
						}
						.textct ul li a {
						color: #555555;
						display: block;
						font-weight: bold;
						margin: 5px   0px 0px 0px;
						text-align: justify;
						font-size:12px;
						}
						.textct ul li 
						{
							float:left;
							width:46%;
							margin-right: 20px;
						}
						.textct h3  
						{
						 clear:both; 
						}
						  </style>
						  <?php 
								echo $article->description;
						  ?>
						
							
							<div style=" height: auto">
							<?php
							if($relatedProject)
							{
							  ?>
							  <ul>
								  <h3>List of projects in  <?php echo  $article->name;?></h3>
							  <?php
							  foreach($relatedProject as $k=>$v)
							  {
								  ?>
								  <li><a target="_blank" href="<?php echo Yii::app()->createUrl($v->slug.'/floorPlan');?>"><?php echo $v->project_name;?></a></li>
							
								  <?
							  }
							  ?>
							  </ul>
							  <?
							}
							?>
			 
							</div>
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
              <h6>New Developments List</h6>
              <ul>
                 <?php 
                 foreach($list as $k=>$v)
                 {
					 ?>
					 <li>
						 <a href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>"><?php echo (strlen($v->name)>20) ? substr($v->name,0,20).'...' : $v->name;?></a></li>
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
