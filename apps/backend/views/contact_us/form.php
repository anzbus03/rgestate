 
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Contact Us</th>
</thead>
 
<tbody>
<tr class="odd">
<td>Contact Person</td>
<td  style="width:70px;"><?php echo @$model->name;?></td>
</tr>
<tr class="even">
<td style="width:70px;">Email</td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="even">
<td style="width:70px;">Mobile No.</td>
<td><?php echo @$model->phone;?></td>
</tr>
<tr class="odd">
<td style="width:70px;"><?php echo $model->getAttributeLabel('city');?></td>
<td><?php echo @$model->city;?></td>
</tr>
<tr class="odd">
<td style="width:70px;">Contact Date</td>
<td><?php echo @$model->date;?></td>
</tr>
<tr class="even">
<td style="width:70px;">Contact Description</td>
<td><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
</tbody>
 
</table> 
