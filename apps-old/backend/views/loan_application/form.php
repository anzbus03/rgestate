 <?php $country = $model->country;   ?> 
 <?php $currency = $country->currency; ?> 
 <?php $bank = $model->bank; ?>  
 <?php $ad = $model->ad; ?>  
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th  colspan="2">Mortgage Application -  <?php echo $model->reference;?></th>
</tr>
<tr>
<th  colspan="2">Company -  <?php echo $bank->bank_name;?>  </th>
</tr>
</thead>

<tbody>
<tr class="odd">
<td colspan="2">Applicant Details</td>
</tr>
<tr class="odd">
<td  colspan="2"><?php echo @$model->name;?><br /><?php echo @$model->email;?><br /><?php echo @$model->phone;?><br /><hr  style="margin: 5px 0px;"/><b>Details</b><hr style="margin: 5px 0px;"/><?php echo nl2br(@$model->meassage);?></td>
</tr>
 
 <tr class="odd">
<td style="width:170px;">Applied Date</td>
<td><?php echo date('d-m-Y',strtotime(@$model->dateAdded));?></td>
</tr>
<tr class="odd">
<td colspan="2">Other Details</td>
</tr>
 
 <tr class="odd">
<td  colspan="2">Monthly income : <?php echo @$model->monthly_income; echo  ' '.$currency->code;?><br />Requested Loan Amount : <?php echo @$model->total_loan;echo  ' '.$currency->code;?><br />Loan period : <?php echo @$model->loan_period;?> yrs <br />Interest rate : <?php echo @$model->interest_rate;?>%<br /><br /><?php if(!empty($ad)){ ?>  <b>Property Details</b><br /> <?php echo $ad->ad_title;?> <?php echo $ad->JavascriptPreview;?><?php } ?></td>
</tr>
 
</tbody>
 
</table> 
