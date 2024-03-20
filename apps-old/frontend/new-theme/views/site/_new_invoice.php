<?php		
			$customer = $model->customer; 
			$invoice = $this->tag->getTag('invoice','Invoice');
			$payment_details = $this->tag->getTag('payment_details','Payment Details');
			$contact_address_t = $this->tag->getTag('contact_address1','Contact Address');
			$contact_address_d = '';
			$address1 = $this->generateCommon('contact_address','') ;
			$count='1';
			foreach(explode("\n", $address1) as $line) {
		    $dir = 	    $count=='6' ? 'dir="ltr"' : '';
			$contact_address_d .= '<li   style="font-weight:normal;line-height:1.5;font-size:12px;" '.$dir.'>'.$line.'</li>';
				$count++;
			}
			$stamp = '*  '.$this->tag->getTag('this_is_a_system_generated_pur','This is a system generated purchase order and does not require any signature / stamp.');
			$invoice_Details = $this->tag->getTag('date','Date').'#: <span class="bold">'.date('d-m-Y',strtotime($model->dateAdded)).'</span><br>';
            $invoice_Details .= $this->tag->getTag('order_id','Order Id').': <span class="bold">'.$model->primaryKey.'</span><br>';
            $invoice_Details .= $this->generateCommon('tax_title','VAT Certificate #').': <span class="bold">'.Yii::app()->options->get('system.common.tax_number','123456789').'</span><br>';
			$invoice_to_Details = '';
			if(!empty($customer->company_name)){
			$invoice_to_Details .= '<strong>'.$this->tag->getTag('company_name','Company Name').' : </strong> '.$customer->company_name.'<br />';
			}
			if(!empty($customer->first_name)){
			$invoice_to_Details .= '<strong>'.$this->tag->getTag('person_name','Person Name').' : </strong> '.$customer->first_name.'<br />';
			}
			if(!empty($customer->email)){
			$invoice_to_Details .= '<strong>'.$this->tag->getTag('email','Email').' : </strong> '.$customer->email.'<br />';
			}
			if(!empty($customer->full_number)){
			$invoice_to_Details .= '<strong>'.$this->tag->getTag('phone','Phone').' : </strong> '.$customer->full_number.'<br />';
			}
			if(!empty($model->created_by)){
			$sates_person = $model->sales_person;
			$invoice_to_Details .= '<strong>'.$this->tag->getTag('sales_person','Sales Person').' : </strong> '.$sates_person->first_name.' '.$sates_person->last_name.'('.$sates_person->email.')'.'<br />';
			}
	  
                                 
			
			$lg = Array();$left = 'left';$right = 'right';
			if(LANGUAGE=='ar'){
				$left = 'right';$right = 'left';
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
 
 

// set some language-dependent strings (optional)

				$logo ='https://www.arabavenue.com/assets/img/ArabAvenueLogoAr11.png';
			}
			else{
				$logo ='https://www.arabavenue.com/assets/img/aae.png';
			}

	$html = '
	<style>
	table, tr, td {
	padding: 15px;
	}
	 
	</style>
	<table style="background-color: #fafafa; color: #222222;" >
	<tbody>
	<tr>	
	<td   align="left" style="padding-right:50px;"> <img src="'.$logo.'"   width="90"  /> </td>
	
	<td align="center"><h1 style="color:#f27f52">'.$invoice.'</h1></td>
	<td align="'.$right.'" >
	'.$invoice_Details.'
	</td>
		
	</tr>
	</tbody>
	</table>
 
	<table>
	<tbody>
	<tr>
	<td>
	'.$invoice_to_Details.'
	</td>
	<td align="'.$right.'">
	<strong>'.$this->tag->getTag('status','Status').':  '. $model->statusName.'</strong><br/></td>
	</tr>
	</tbody>
	</table>
	';
	$html .= '
	<table>
	<tbody>
	<tr>
	<td align="center" style="background-color:#f27f52;color:#fff;" ><strong>'.$payment_details.'</strong></td> 
	</tr>
	</tbody>
	</table>
	';
	$html .= '
	<table>
	 <tbody>
		<tr>
		<td style="border-bottom: 1px solid #222"><strong>'.Yii::t('orders', $model->getAttributeLabel('details')).'</strong>: 
		 
	  ';
	    if(empty($model->validity)){ $html .=  'Unlimited'; }
		else{
			$html .=  ' <p>'.$this->tag->getTag('start_date','Start Date').' : '.date('d-m-Y',strtotime($model->date_start)).'</p>'; 
			$html .=  '<p>'.$this->tag->getTag('end_date','End Date').' : '.date('d-m-Y', strtotime($model->date_start. ' '.$model->validity.'  days')).'</p>';
		}
	  
	  
	 $html .= $model->PackageDetails.' 
	  </td>

		</tr> 
		</tbody>
	</table>
	<table>
	<thead>
	
                    
	<tr style="font-weight:bold;">
	<th>'.Yii::t('orders', $model->getAttributeLabel('subtotal')).'</th>
	<th>'.Yii::t('orders', $model->getAttributeLabel('tax_value')).'</th>
	<th>'.Yii::t('orders',$model->getAttributeLabel('discount')).'</th>
	<th>'.Yii::t('orders', $model->getAttributeLabel('total')).'</th>
	</tr>
	</thead>
	<tbody>';
	 
		$html .= '
		<tr>
		<td style="border-bottom: 1px solid #222">'.$model->formattedSubtotal.'</td>
		<td style="border-bottom: 1px solid #222">'.$model->formattedTaxValue.'</td>
		<td style="border-bottom: 1px solid #222">'.$model->formattedDiscount.'</td>
		<td style="border-bottom: 1px solid #222">'.$model->formattedTotal.'</td>
		</tr>
		';
	 
	$html .='
	<tr align="'.$left.'">
	<td colspan="4" style="font-size:10px;"> '.$stamp.' </td>
	</tr>
	<tr>
	<td colspan="4">
	<h2>'.$this->tag->getTag('thank_you_for_your','Thank you for your business').'</h2><br/>
	<strong style="color:#f27f52" >'.$contact_address_t.':</strong>
	'.$contact_address_d.'
	</td>
	</tr>
	</tbody>
	</table>
	'; 
	echo  $html;
