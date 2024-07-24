<div class="subhead font_s ros subhead_img">Add Property Types</div>
<div class=" col-lg-12">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Area</th>
        <th>Price (AED)</th>
        <th style="width:50px;">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $unit_options = CHtml::listData(AreaUnit::model()->listData(),'master_id','master_name');$htm = '[UNIT]';
      $htm_option = '<option value="" >-Select Unit-</option>';  
      $htm_option1 = '<option value="" >-Select Unit-</option>';  
      foreach($unit_options as $k=>$v){
		  $htm_option .= '<option value="'.$k.'">'.$v.'</option>';
	  }
      $price_options = CHtml::listData(PriceUnit::model()->listData(),'master_id','master_name');$htm1 = '[PUNIT]'; 
      foreach($price_options as $k=>$v){
		  $htm_option1 .= '<option value="'.$k.'">'.$v.'</option>';
	  }
      $unitArea = '<select name="add_property_types[a_unit][]" class="form-control"  style="width:33%;">[UNIT]</select>';
      $unitPrice = '<select name="add_property_types[p_unit][]" class="form-control"  style="width:33%;">[PUNIT]</select>';
      $thnl = '<tr class="textFields {i_class}"  >';
      $thnl .= '<td><input type="text" class="form-control" placeholder="Residential Plots (Plot) "  name="add_property_types[title][]" value="{value_title}" maxlength="150" /></td>';
      $thnl .= '<td><input type="text" class="form-control col-sm-6 nemeric"  placeholder="From*" pattern="[0-9.,]+" name="add_property_types[size][]" value="{value_size}" maxlength="10"  style="width: 33% !important;max-width: 90px;" /><input type="text" class="form-control  col-sm-6 nemeric"  placeholder="To" name="add_property_types[size_to][]" value="{value_size_to}" pattern="[0-9.,]+"   maxlength="10" style="width: 33% !important;max-width: 90px;" />'.$unitArea.'</td>';
      $thnl .= '<td><input type="text" class="form-control col-sm-6 nemeric"  placeholder="From" pattern="[0-9.,]+" style="width: 33% !important;max-width: 90px;"   name="add_property_types[from_price][]"   value="{value_from_price}"   maxlength="10" /><input type="text" class="form-control  col-sm-6 nemeric"  placeholder="To"  name="add_property_types[to_price][]"   value="{value_to_price}"  pattern="[0-9.,]+" style="width: 33% !important;max-width: 90px;"   maxlength="10" />'.$unitPrice.'</td>';
      $thnl .= '<td><a href="javascript:void(0)"  onclick="removeAppendRow(this)"><i class="glyphicon glyphicon-remove-circle"></i></a></td></tr>';
     $post = array();
      if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
				 
					$pTypes =  $model->pTypes ;
					if(!empty($pTypes )){
					foreach($pTypes as $pos){
						$post['title'][] =  $pos->title;
						$post['size'][] =  $pos->size;
						$post['size_to'][] =   $pos->size_to=='0.00' ? '' :  $pos->size_to;  
						$post['from_price'][] =  $pos->from_price=='0.00' ? '' :  $pos->from_price;  
						$post['to_price'][] =  $pos->to_price=='0.00' ? '' :  $pos->to_price;
						$post['a_unit'][] =  $pos->a_unit;
						$post['p_unit'][] =  $pos->p_unit;
					}
					}
					
					
					}else{
					$post =  Yii::App()->request->getPost('add_property_types',array());
		}
      if(!empty($post)){ 
		 
		for($i= 0 ; $i< sizeOf($post['title']);$i++){
			$i_class = '';
				if(empty( $post['title'][$i]) ||  empty($post['size'][$i])  ||  empty($post['a_unit'][$i]) )
						{
							$i_class = 'error';
						
					}
			$html_option_price1 = '<option value="" >-Select Unit-</option>';
			$html_option_area1  = '<option value="" >-Select Unit-</option>';
			if($price_options ){ foreach($price_options as $k2=>$v2){ if($k2==$post['p_unit'][$i]){ $selected='selected="true"'; }else{$selected='';  }  $html_option_price1 .= '<option value="'.$k2.'"  '.$selected.' >'.$v2.'</option>'; 	} }
			if($unit_options ){ foreach($unit_options as $k2=>$v2){ if($k2==$post['a_unit'][$i]){ $selected='selected="true"'; }else{$selected='';  }  $html_option_area1 .= '<option value="'.$k2.'"  '.$selected.' >'.$v2.'</option>'; 	} }
			echo  Yii::t('app',$thnl,array('{i_class}'=>$i_class, '[PUNIT]' => $html_option_price1, '[UNIT]' => $html_option_area1 ,'{value_title}'=> $post['title'][$i],'{value_size}'=> $post['size'][$i],'{value_size_to}'=> $post['size_to'][$i],'{value_from_price}'=> $post['from_price'][$i],'{value_to_price}'=> $post['to_price'][$i]));
		};  
	  }
	  ?>
      <tr id="append_row"><th colspan="100%"><a href="javascript:void(0)" onclick="appendRowr(this)" class="btn"><i class="fa fa-plus"></i> Add rows</a></th></tr>
	    
    </tbody>
  </table>
        <?php echo $form->hiddenField($model, 'add_property_types'); ?>
        <?php echo $form->error($model, 'add_property_types');?>
        </div>
              
<script>
	var appendRowObj =  '<?php echo  Yii::t('app',$thnl,array('[PUNIT]'=>$htm_option1,'[UNIT]'=>$htm_option,'{value_title}'=>'' ,'{value_size}'=>'' ,'{value_size_to}'=> '' ,'{value_from_price}'=>'' ,'{value_to_price}'=> '','\n'=>'','\s'=>''  ));;?>';
function appendRowr(k){
	$('#append_row').before(  appendRowObj );
	inputValidate()
}
function removeAppendRow(k){
 
	$(k).parent().parent().remove();
}
 
	function inputValidate(){
$('input.nemeric').on('change, keyup', function validateInpu() {
    var currentInput = $(this).val();
    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
    $(this).val(fixedInput);
    console.log(fixedInput);
});
}
 
</script>
<style>.form-control.col-sm-6{ width:50% !important; } .textFields.error{ background: #F9E0EF; } </style>
