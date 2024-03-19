<div class="main-content">
	 
  
  <div class="properties" style=" top:0;">
    <div class="container">
      <!-- grid_full_width 4column -->
      <div class="grid_full_width " id="4column" style="  padding-top: 50px;">
        <!--<div class="all-text">
          <h3>Floor Plans</h3>
          
        </div>-->
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
          
              <div class="ordering">
              <strong style="color:#000; font-size:20px; font-weight:400;">Site Map</strong></div>
            
          </div>
        </div>
        <div class="row">
			<style>
			table
			{
			border:0px !important;
			}
			table tr th {
			background: #967930 none repeat scroll 0 0;
			color: #fff;
			padding: 10px 0;
			font-size: 16px;
			font-weight: 400;




			}
			td:nth-child(2) {  text-align:center;  }
			td 
			{
			padding: 10px 0;
			border:0px;
			}
			tr
			{
			background: #fff none repeat scroll 0 0;
			border-bottom: 1px solid #dddddd;

			text-indent: 20px;
			font-size: 14px;

			}
			tr:nth-child(even) {
			background: #fff5db none repeat scroll 0 0;
			margin: 0;
			}
			.sitemap-cont h3 {
			background-color: #fff;
			color: #555555 !important;
			font-family: Arial,Helvetica,sans-serif !important;
			font-size: 13px !important;
			margin-bottom: 5px !important;
			padding: 7px !important;
			text-align:left !important;
			font-weight:bold !important;
			}
		 
			.span8 ul {
			list-style: none;
			padding:10px 0px;
			margin:0;
			}

			.span8 li { 
			padding-left: 1em; 
			text-indent: -.7em;
			line-height:25px;
			}

			.span8 li:before {
			content: "• ";
			color: #5D5D5D; /* or whatever color you prefer */
			}
			.span8 .fltLeft
			{
				float:left;width:49%;
			}
			 
			.span8 .fltRight
			{
				float:right;width:49%;
			}
			.class{
				clear:both;
			}
			.sitemap-cont{
				clear:both;
				margin-bottom:10px;
			}
			</style>
        <div class="span8">
               <?php echo $article->content;?>
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
        <!-- Page-ination -->
        
        <!-- End Page-ination -->
      </div>
    </div>
  </div>
</div>
