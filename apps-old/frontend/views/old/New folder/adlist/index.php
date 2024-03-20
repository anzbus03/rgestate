<?php defined('MW_PATH') || exit('No direct script access allowed');?>

<div id="page_txt">
<?php if($model)
{
?>
<div id="sort_div" style="width:100%;">
	<div class="sort_div_left" >
		<label>Showing <?php echo ($pages->offset+1);?> 
		to <?php echo ($pages->offset+ count($model));?> out of  
		<?php echo $pages->itemCount;?></label>
	</div>
	<div class="sort_div_left">
		<div class="sort_div_right">
	<form id="sort_price" name="sort" on submit="return false;"><label >Sort By : </label>
	<?php
	echo CHtml::dropDownList('select',$order_val,array("1"=>"Price ASC","2"=>"Price Desc","3"=>"Date ASC","4"=>"Date Desc",),array("id"=>"select_price","onchange"=>"price_change(this)","empty"=>"Default Order","style"=>"width:120px;")); 
	?>
	</form>
	</div>
	
	</div><div class="clear"></div> 
	 
</div>	
<div class="clear"></div> 
<div id="autos">  
	<?php
	 foreach($model as $k=>$v)
	 {
	 
		 ?>
		<div class="auto_child">
		<h1><span><a href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>"><?php echo (strlen($v->ad_title)>34) ? substr($v->ad_title,0,34)."..."  : $v->ad_title   ?></a></span>
		<?php
		if(in_array("price",$fields))
		{
		?>
		<label>AED <?php echo $v->price; ?></label>
		<?php
		}
		?>
		</h1>
		<div class="auto_details">
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
				?>
			
			<a href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>">
				<div class="listing_my" >
				<?php
				if($v->featured=="Y")
				{
				?>
					<div class="futured"></div>
				<?php } ?>
				<?php echo Yii::app()->easyImage->thumbOf(Yii::app()->basePath . '/../../uploads/ads/'.$image,
				array(
				'resize' => array('width' => 138, 'height' =>100,"master"=>EasyImage::RESIZE_AUTO),
				'sharpen' => 20,
				'quality' => 100,)
				) ?>
				</div>
			
			</a><?
		}
		else
		{
			?>
			<a href="<?php echo Yii::app()->createUrl("details/".$v->slug) ;?>">
				<div class="listing_my" style="background:none;">
			     <?php
				if($v->featured=="Y")
				{
				?>
					<div class="futured"></div>
				<?php } ?>
				<?php echo Yii::app()->easyImage->thumbOf(Yii::app()->basePath . '/../../uploads/ads/null.png',
				array(
				'resize' => array('width' => 138, 'height' =>100,"master"=>EasyImage::RESIZE_AUTO),
				'sharpen' => 20,
				'quality' => 100,)
				) ?>
					</div>
			
			</a>
			<?
	    }
	    ?>
		
		<div class="auto_all">
        <?php /*
		<h4 class="inner_title"><?php echo $v->section->section_name; ?>&nbsp;&gt;&nbsp;<?php echo $v->category->category_name; ?>&nbsp;&gt;&nbsp;<?php echo $v->subCategory->sub_category_name; ?></h4>
		 */?>
		<h5 class="inner_date"><?php echo date('D d F Y', strtotime($v->added_date ))  ?></h5>

		<ul class="inner_options">
	 
		
		
		 
		  <?php
		  if(in_array("area",$fields))
		  {
		   ?>
		   <li><label>Area : </label><font><?php echo $v->area;?></font></li>
		   <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("bathrooms",$fields))
		  {
		   ?>
		   <li><label>Bathrooms : </label><font><?php echo $v->bathrooms;?></font></li>
		   <?php 
		   }  
		   ?>       
		 <?php
		  if(in_array("bedrooms",$fields))
		  {
		   ?>
		   <li><label>Bedrooms : </label><font><?php echo $v->bedrooms;?></font></li>
		   <?php 
		  }  
		  ?>       
		  <?php
		  if(in_array("engine_size",$fields))
		  {
		   ?>
		   <li><label>Engine Size : </label><font><?php echo $v->EngineSize->engine_size_name;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("killometer",$fields))
		  {
		   ?>
		   <li><label>Kilometer : </label><font><?php echo $v->killometer;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("model",$fields))
		  {
		   ?>
		   <li><label>Model : </label><font><?php echo $v->Model->model_name;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("year",$fields))
		  {
		   ?>
		   <li><label>Year : </label><font><?php echo $v->year;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("employment_type",$fields))
		  {
		   ?>
		   <li><label>Employment Type : </label><font><?php echo $v->EmploymentType->employment_type_name;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("education_level",$fields))
		  {
		   ?>
		   <li><label>Education Level : </label><font><?php echo $v->EducationLevel->education_name;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("age",$fields))
		  {
		   ?>
		   <li><label>Age : </label><font><?php echo $v->age;?></font></li>
		  <?php 
		  } 
		  ?>       
		  <?php
		  if(in_array("height",$fields))
		  {
		   ?>
		   <li><label>Height : </label><font><?php echo $v->height;?></font></li>
		  <?php 
		  } 
		  ?> 
		    <?php
		  if(in_array("religion_id",$fields))
		  {
		   ?>
		   <li><label>Religion : </label><font><?php echo $v->Religion->religion_name;?></font></li>
		  <?php 
		  } 
		  ?>        
		  <?php
		  if(in_array("marital_status",$fields))
		  {
		   ?>
		   <li><label>Marital status : </label><font><?php echo $v->Marital->marital_name;?></font></li>
		  <?php 
		  } 
		  ?>       
		     
								           
									
						  
							 
									 
								 
								  
		 
		</ul>
		<h5 class="inner_location"><font>located : </font><?php echo $v->country0->country_name; ?>  &nbsp;&gt;&nbsp;<?php echo $v->state0->state_name; ?></h5>

		</div>

		</div>


		</div> 
		<?php
	}
	?>



</div>
 
 <?php if($pages->itemCount>10)
 {
 ?>
				<div id="pager" ><? $this->widget('CLinkPager', array(
				'pages'=>$pages,
				'header'=>'',
				'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css',
				'nextPageLabel' => '&gt',
				'prevPageLabel' => '&lt',
				));?></div>
                     <?php 
				 }
				 ?>
<?php
}
else
{
	?>
	<div>No Ads Found..</div>
	<?
}
?>
</div>
<script>
function price_change(k)
{
	 href = '<?php echo Yii::app()->createUrl("adlist/".$subcategory->slug);?>?order='+$(k).val() ;
	 
	 location.href = href ;

	 
}
</script>
<!--End of page_txt-->
