<div class="main-content">
  <div class="properties" style=" top:0;">
    <div class="container">
      <!-- grid_full_width 4column -->
      <div class="grid_full_width " id="4column" style="  padding-top: 50px;">
        <!--<div class="all-text">
          <h3>All New Projects</h3>
          
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
          <?php if(!empty($articles))
          {
			  ?>
              <div class="ordering pull-right ">
              <strong style="color:#000; font-size:20px; font-weight:400;">New Developments |</strong> <?php echo $pages->currentPage*$pages->pageSize+1 ;?> -  <?php echo $pages->currentPage*$pages->pageSize+sizeOf($articles) ;?>  Of  <?php echo $pages->itemCount;?> Results 
        <?php
        }
        ?>      </div>
            
          </div>
        </div>
        <div class="row">
          <div class="grid_4_col_product">
			  
          
          <ul class="products" id="able-list">
			   <?php
			  if(!empty($articles))
			  {
				  
				  foreach($articles as $k=>$v)
				  {
					preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->description, $Images); 
					$image = PlaceAnAd::model()->renderImage(@$Images['1']);
					?>
					<a   href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>" title="">
					<li class="span7 house offices apartment Residential">
					<div class="product-item">
					<div class="imagewrapper"> <img alt="" width="620" height="370" style="height:370px;"  src="<?php echo Yii::app()->apps->getBaseUrl('').  @$Images['1'];?>"> </div>
					<h3 style="text-align:center;padding: 14px 0 10px;"><a style="font-size:20px;color:#967930;"  href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>" title=""><?php echo (strlen($v->name)>25) ? substr($v->name,0,25).'...' :$v->name ; ?> <br>
					</a></h3>
					<span class="price" style="font-size:14px; text-align:center; width:100%;padding: 0 0 20px; "><a   href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>" title=""> View Details</a></span> </div>
					</li>
					</a>
					<?php
				}
		}
		else
		{
			?>
			<p style="text-align:center"><b>No Listing Found</b></p>
			<?
		}
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
        <!-- End Page-ination -->
      </div>
    </div>
  </div>
</div>
