<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Advertisement Interest</th>
</thead>
 
<tbody>
        <tr class="odd">
<td>ID:</td>
<td  style="width:70px;"><?php echo @$model->id;?></td>
</tr>
    <tr class="odd">
<td><?php echo $model->getAttributeLabel('m_id1');?></td>
<td  style="width:70px;"><?php echo @$model->master->master_name;?></td>
</tr>
    <tr class="odd">
<td><?php echo $model->getAttributeLabel('city');?></td>
<td  style="width:70px;"><?php echo @$model->city;?></td>
</tr>
    <tr class="odd">
<td><?php echo $model->getAttributeLabel('region_id');?></td>
<td  style="width:70px;"><?php echo @$model->region->name;?></td>
</tr>
<tr class="odd">
<td>Contact Person</td>
<td  style="width:70px;"><?php echo @$model->name;?></td>
</tr>
<tr class="even">
<td style="width:70px;">Email</td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="odd">
<td style="width:70px;">Phone</td>
<td><?php echo @$model->phone;?></td>
</tr>
    <tr class="odd">
<td><?php echo $model->getAttributeLabel('m_id2');?></td>
<td  style="width:70px;"><?php echo @$model->master2->master_name;?></td>
</tr>
 
<tr class="odd">
<td style="width:70px;">Contact Date</td>
<td><?php echo @$model->SDate;?></td>
</tr>
</tbody>
 
</table> 