<style>
body { font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";}
 
</style> 
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2" style="height:50px;    background-color:#f27f52;    color: #fff;"><?php echo  $this->tag->getTag('inquiry_details', 'Inquiry Details') ;?></th>
</thead>
 
<tbody>
<tr class="odd">
<td style="width:170px;"><?php echo   $this->tag->getTag('contact_person', 'Contact Person')  ;?></td>
<td  ><?php echo @$model->name;?></td>
</tr>
<?php
if(!empty($model->ad_id)){ ?> 
<tr class="odd">
<td style="width:170px;"><?php echo $this->tag->getTag('property','Property') ;?></td>
<td><?php    echo $model->ad_title  ;?></td>
</tr>
<?php }  ?>
 
<tr class="even">
<td style="width:70px;"><?php echo $this->tag->getTag('email','Email')  ;?></td>
<td><?php echo @$model->email;?></td>
</tr>
<tr class="odd">
<td style="width:70px;"><?php echo  $this->tag->getTag('phone','Phone')  ;?></td>
<td><?php echo @$model->phone;?></td>
</tr>
 
<tr class="odd">
<td style="width:70px;"><?php echo   $this->tag->getTag('date','Date')   ;?></td>
<td><?php echo @$model->date_added;?></td>
</tr>
<tr class="even">
<td style="width:70px;"><?php echo  $this->tag->getTag('details','Details')   ;?></td>
<td><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
</tbody>
 
</table> <style>td { padding : 5px; font-size:15px;  }th { padding : 5px; font-size:16px;font-weight:600;  ;}</style>
