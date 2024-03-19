<?php 
$hader_text = unserialize($model->header_text) ; 
$field_array = array();
if($data){ 
	foreach($data as $k=>$v){
		$field_array[$v->row_number][] = $v;
	}
}  
 if($model->layout=='R1'){
	 ?>
				 <div class="ad_row_1">
				 <?php
						if(isset($field_array[1])){
						 $field = $field_array[1];
						 $header = isset($hader_text['row1']) ? $hader_text['row1'] : '' ;
						 $sub_header = isset($hader_text['sub_row1']) ? $hader_text['sub_row1'] : '' ;
						 $rw_ids = 'row_ids_1_'.$model->primaryKey;
						 $this->renderPartial('ad/_ad_row1',compact('v','field','header','sub_header','rw_ids'));
					     }
					 
				 ?>	 
				 </div> 
				 
	 <?php
 }
 if($model->layout=='R2'){
	 ?>
				 <div class="ad_row_1">
				 <?php
						if(isset($field_array[1])){
						 $field = $field_array[1];
						 $header = isset($hader_text['row1']) ? $hader_text['row1'] : '' ;
						 $sub_header = isset($hader_text['sub_row1']) ? $hader_text['sub_row1'] : '' ;
						 $rw_ids = 'row_ids_1_'.$model->primaryKey;
						 $this->renderPartial('ad/_ad_row1',compact('v','field','header','sub_header','rw_ids'));
					     }
					 
				 ?>	 
				 </div> 
				 <div class="ad_row_2">
				  <?php
						if(isset($field_array[2])){
						 $field = $field_array[2];
						  $header = isset($hader_text['row2']) ? $hader_text['row2'] : '' ;
						  $sub_header = isset($hader_text['sub_row2']) ? $hader_text['sub_row2'] : '' ;
						  $rw_ids = 'row_ids_2_'.$model->primaryKey;
						 $this->renderPartial('ad/_ad_row1',compact('v','field','header','sub_header','rw_ids'));
					    }
					 
				 ?>	 
				 </div> 
	 <?php
 }

 if($model->layout=='R2M1'){
	 ?>
				 <div class="ad_row_1">
				 <?php
						if(isset($field_array[1])){
						 $field = $field_array[1];
						  $header = isset($hader_text['row1']) ? $hader_text['row1'] : '' ;
						  $sub_header = isset($hader_text['sub_row1']) ? $hader_text['sub_row1'] : '' ;
						  $rw_ids = 'row_ids_1_'.$model->primaryKey;
						 $this->renderPartial('ad/_ad_row1',compact('v','field','header','sub_header','rw_ids'));
						}
					 
				 ?>	 
				 </div> 
				 <div class="ad_row_3">
				  <?php
						if(isset($field_array[2])){
						 $v = $field_array[2][0];
						 $header = 'Block2';
						 $this->renderPartial('ad/_ad_row_middle1',compact('v','field','header'));
					    }
					 
				 ?>	 
				 </div> 
				 <div class="ad_row_3">
				  <?php
						 if(isset($field_array[3])){
						 $field = $field_array[3];
						   $header = isset($hader_text['row2']) ? $hader_text['row2'] : '' ;
						  $sub_header = isset($hader_text['sub_row2']) ? $hader_text['sub_row2'] : '' ;
						   $rw_ids = 'row_ids_3_'.$model->primaryKey;
						 $this->renderPartial('ad/_ad_row1',compact('v','field','header','sub_header','rw_ids'));
					     }
					 
				 ?>	 
				 </div> 
	 <?php
 }
 ;
?>
 
 
