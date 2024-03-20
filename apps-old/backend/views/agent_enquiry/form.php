<table class="table table-bordered table-hover table-striped">
<thead>
 
<tbody>
<tr class="odd">
<td  style="width:120px;">Contact Person</td>
<td ><?php echo @$model->name;?></td>
</tr>
<tr class="even">
<td style="width:120px;" >Agent Name</td>
<td><?php echo CHtml::link(@$model->agent->fullName, @$model->agent->AgentDetailUrl2);?></td>
</tr>
<tr class="even">
<td style="width:120px;" >Email</td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="odd">
<td style="width:120px;" >Phone</td>
<td><?php echo @$model->phone;?></td>
</tr>
 
<tr class="odd">
<td style="width:120px;" >Contact Date</td>
<td><?php echo @$model->date_added;?></td>
</tr>
<tr class="even">
<td style="width:120px;" >Message</td>
<td><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
</tbody>
 
</table> 
