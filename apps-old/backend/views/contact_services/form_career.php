 
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Career</th>
</thead>
 
<tbody>
<tr class="odd">
<td>ID</td>
<td  style="width:70px;"><?php echo @$model->primaryKey;?></td>
</tr>
<tr class="even">
<td style="width:70px;">Name</td>
<td><?php echo @$model->name;?></td>
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
<td style="width:70px;"><?php echo $model->getAttributeLabel('type');?></td>
<td><?php echo @$model->type;?></td>
</tr>
<tr class="odd">
<td style="width:70px;"><?php echo $model->getAttributeLabel('image');?></td>
<td><a href="<?php echo $model->BackendUrl;?>" target="_blank">View</a></td>
</tr>
<tr class="odd">
<td style="width:70px;"> Date</td>
<td><?php echo @$model->dateAdded;?></td>
</tr> 
 
</tbody>
 
</table> 
