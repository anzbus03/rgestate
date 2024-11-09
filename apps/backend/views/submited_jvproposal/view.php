 <table class="table table-bordered table-hover table-striped">
     <thead>
         <tr>
             <th colspan="2">JV Proposal Details</th>
     </thead>

     <tbody>
         <td colspan="2">Contact Details</td>
         </tr>
         <tr class="even">

             <td colspan="2"><?php echo  $model->name; ?><br /><?php echo  '<a href="tel:' . $model->mobile . '">' . $model->mobile . '</a>'; ?><br /><?php echo  '<a href="mailto:' . $model->email . '">' . $model->email . '</a>';; ?><br /></td>
         </tr>
         <td colspan="2">Details</td>
         </tr>

         <tr class="even">
             <td style="width:170px;"><?php echo $model->getAttributeLabel('jv_business_cat'); ?></td>
             <td><?php echo @$model->PropertyTitle; ?></td>
         </tr>
         <tr class="odd">
             <td style="width:70px;">Investment Amount Involved</td>
             <td><?php echo @$model->BuitTitle; ?></td>
         </tr>
         <tr class="odd">
             <td style="width:70px;">JV Proposal Description</td>
             <td><?php echo nl2br($model->description); ?> </td>
         </tr>
         <tr class="odd">
             <td style="width:70px;">Attachment</td>
             <td><?php echo !empty($model->attachment1) ?  CHtml::link('View', Yii::app()->apps->getBaseUrl('uploads/files/' . $model->attachment1), array('target' => '_blank')) : ''; ?> </td>
         </tr>
     </tbody>

 </table>