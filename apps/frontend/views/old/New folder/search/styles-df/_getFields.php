<?php
if($fields)
{
	 
?>
 <div class="fields findSE2">
					<?php
					if(in_array("model",$fields))
					{
						?>
						<div class="widget-dropdown   no-arrow findSEl" id="search-content-rc">
						<div class="search-dropdown">
						<? 
						echo CHtml::dropDownList('model','',array_replace(CHtml::listData(VehicleModel::model()->findByModels($id),'model_id','model_name'),array('0'=>'Others')),array(  "empty"=>"Select Model" )); 
						?>
						</div>
						</div>
						<?
					}
					?>
					<?php
						if(in_array("price",$fields))
						{
						?>
						<div class="range-fields">
						<label class="heading"> Price ( AED ) </label>
						<div class="relative">
						<input id="price__gte:swfield" class="text-field-small" type="text" placeholder="Price from" title="Price from" name="price__from" kl_virtual_keyboard_secure_input="on">
						</div>

						<div class="relative">
						<input id="price__lte:swfield" class="text-field-small alt" type="text" placeholder="Price to" title="Price to" name="price__to" kl_virtual_keyboard_secure_input="on">
						</div>
						</div>
						 
						<?php
						}
					 ?>
					<?php
						if(in_array("killometer",$fields))
						{
						?>
						<div class="range-fields">
						<label class="heading"> Kilometers ( KM ) </label>
						<div class="relative">
						<input id="price__gte:swfield" class="text-field-small" type="text" placeholder="KM from" title="Kilometer from" name="kilometer__from" kl_virtual_keyboard_secure_input="on">
						</div>

						<div class="relative">
						<input id="price__lte:swfield" class="text-field-small alt" type="text" placeholder="KM to" title="Kilometer to" name="kilometer__to" kl_virtual_keyboard_secure_input="on">
						</div>
						</div>
						 
						<?php
						}
					 ?>
					 
					 <?php
					  if(in_array("bedrooms",$fields))
					  {
						  
					   ?>
						<div class="range-fields">
						<label class="heading"> Bed (Min/Max) </label>
						<div class="relative">
						
						<?php
						echo CHtml::dropDownList('bedrooms_min','',PlaceAnAd::model()->bedrooms(),array("empty"=>"Min Bed" )); 
						?>
						</div>
						<div class="relative">
						<?php
						echo CHtml::dropDownList('bedrooms_max','',PlaceAnAd::model()->bedrooms(),array("empty"=>"Max Bed" )); 
						?>
						</div>
						</div>
					   <?php
					   }  
					 ?> 
					 <?php
						  if(in_array("year",$fields))
						  {
						   ?>
							<div class="range-fields">
							<label class="heading"> Year (Min/Max) </label>
							<div class="relative">
							<?php
							echo CHtml::dropDownList('year_min','',PlaceAnAd::model()->year(),array("empty"=>"Min Year" )); 
							?>
							</div>
							<div class="relative">
							<?php
							echo CHtml::dropDownList('year_max','',PlaceAnAd::model()->year(),array("empty"=>"Max Year" )); 
							?>
							</div>
							</div>
						  <?php 
						  } 
						  ?>      

					 <?php
					  if(in_array("bathrooms",$fields))
					  {
						  
					   ?>
						<div class="range-fields">
						<label class="heading"> Bath (Min/Max) </label>
						<div class="relative">
						<?php
							echo CHtml::dropDownList('bathrooms_min','',PlaceAnAd::model()->bathrooms(),array("empty"=>"Min Bath" )); 
						 ?>
						</div>
						<div class="relative">
						<?php
							echo CHtml::dropDownList('bathrooms_max','',PlaceAnAd::model()->bathrooms(),array("empty"=>"Max Bath" )); 
						?>
						</div>
						</div>
					   <?php
					   }  
					 ?> 

				 
				</div>
<?php	 
}
?>
