<?php $country = $model->country;$bank = $model->bank; ?> 
<table class="table table-bordered table-hover table-striped" style="font-size:18px;line-height:25px;">
<thead>
<tr>
<th  colspan="2">Property Valuation -  <?php echo $model->reference;?>  </th>
</tr>
<thead>
<tr>
<th  colspan="2">Company -  <?php echo $bank->bank_name;?>  </th>
</tr>
</thead>

<tbody>
<tr class="odd">
<td colspan="2">Applicant Details</td>
</tr>
<tr class="odd">
<td  colspan="2"><?php echo @$model->f_name;?><br /><?php echo @$model->email;?><br /><?php echo @$model->phone;?><br /><hr  style="margin: 5px 0px;"/><b>Details</b><hr style="margin: 5px 0px;"/></td>
</tr>
 
 <tr class="odd">
<td style="width:170px;">Request Date</td>
<td><?php echo date('d-m-Y',strtotime(@$model->dateAdded));?></td>
</tr>
 
  <?php
 if(empty($model->property_id)){ ?> 
 <tr class="odd">
<td  colspan="2"><?php echo $model->getAttributeLabel('property_type');?> : <?php echo @$model->propertyTitle;?><br />

<i class="fa fa-map-marker"></i>  <?php echo @$model->AddressDetails;?><br />
<br />Description<br /> <?php echo nl2br($model->description);?>

 <br /><br /> <br />   </td>
</tr>
 <?php } else{
	 $ad = $model->property;
	?>
	 <tr class="odd">
<td  colspan="2"><?php if(!empty($ad)){ ?>  <b>Property Details</b><br /><?php echo $ad->referenceNumberTitle;?><br /><?php echo $ad->ad_title;?><br /> <?php echo $ad->PriceTitle;?><br />  <?php echo $ad->JavascriptPreview;?><?php } ?>  </td>
</tr>
	 
	<?
 }
 ?>
</tbody>
 
</table> 
