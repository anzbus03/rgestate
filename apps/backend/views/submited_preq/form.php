 
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Requirement Details</th>
</thead>
 
<tbody>
 
<tr class="even">
<td style="width:100px;"><?php echo $model->getAttributeLabel('p_for');?></td>
<td><?php echo @$model->PforTitle;?></td>
</tr>
<tr class="even">
<td style="width:70px;"><?php echo $model->getAttributeLabel('property_type');?></td>
<td><?php echo @$model->PropertyTitle;?></td>
</tr>
<tr class="odd">
<td style="width:70px;">Budget</td>
<td><?php echo @$model->BudgetTitle;?></td>
</tr>
<tr class="odd">
<td style="width:70px;">Built Up Area</td>
<td><?php echo @$model->BuitTitle;?> </td>
</tr>
<tr class="odd">
<td style="width:70px;">City/Community</td>
<td><?php echo @$model->CityTitle;?> </td>
</tr>
<td colspan="2">Contact Details</td></tr>
<tr class="even">
 
<td colspan="2"><?php echo  $model->name;?>(<?php echo  $model->OtypeTitle;?>)<br /><?php echo  '<a href="tel:'.$model->phone.'">'.$model->phone.'</a>';?><br /><?php echo  '<a href="mailto:'.$model->email.'">'.$model->email.'</a>';;?><br /></td>
</tr>
 
</tbody>
 
</table> 
