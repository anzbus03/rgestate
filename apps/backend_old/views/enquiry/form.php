<table class="table table-bordered table-hover table-striped">
 
 
<tbody>
	<tr class="even">
<td style="width:100px;" >Property Details</td>
<td><?php echo   @$model->PropertyDetail;?></td>
</tr>
<tr class="odd">
<td  style="width:100px;">Contact Person</td>
<td ><?php echo @$model->NameWithCountry;?></td>
</tr>

<tr class="even">
<td style="width:100px;" >Email</td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="odd">
<td style="width:100px;">Phone</td>
<td><?php echo @$model->PhoneWithCountry;?></td>
</tr>
 
<tr class="odd">
<td style="width:100px;" >Contact Date</td>
<td><?php echo @$model->dateAdded;?></td>
</tr>
<tr class="even">
<td style="width:100px;" >Message</td>
<td><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
</tbody>
 
</table> 
