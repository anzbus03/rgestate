<?php 
$hader_text = unserialize($model->header_text) ; 
$field_array = array();
if($data){ 
	foreach($data as $k=>$v){
		$field_array[$v->row_number][] = $v;
	}
}  

 
	 ?>
	 <style>
	 .col-xs-5th-1,.col-xs-5th-2,.col-xs-5th-3,.col-xs-5th-4{float:left}.col-xs-5th-5{float:left;width:100%}.col-xs-5th-4{width:80%}.col-xs-5th-3{width:60%}.col-xs-5th-2{width:40%}.col-xs-5th-1{width:20%}.col-xs-5th-pull-5{right:100%}.col-xs-5th-pull-4{right:80%}.col-xs-5th-pull-3{right:60%}.col-xs-5th-pull-2{right:40%}.col-xs-5th-pull-1{right:20%}.col-xs-5th-pull-0{right:auto}.col-xs-5th-push-5{left:100%}.col-xs-5th-push-4{left:80%}.col-xs-5th-push-3{left:60%}.col-xs-5th-push-2{left:40%}.col-xs-5th-push-1{left:20%}.col-xs-5th-push-0{left:auto}.col-xs-5th-offset-5{margin-left:100%}.col-xs-5th-offset-4{margin-left:80%}.col-xs-5th-offset-3{margin-left:60%}.col-xs-5th-offset-2{margin-left:40%}.col-xs-5th-offset-1{margin-left:20%}.col-xs-5th-offset-0{margin-left:0}@media (min-width:768px){.col-sm-5th-1,.col-sm-5th-2,.col-sm-5th-3,.col-sm-5th-4{float:left}.col-sm-5th-5{float:left;width:100%}.col-sm-5th-4{width:80%}.col-sm-5th-3{width:60%}.col-sm-5th-2{width:40%}.col-sm-5th-1{width:20%}.col-sm-5th-pull-5{right:100%}.col-sm-5th-pull-4{right:80%}.col-sm-5th-pull-3{right:60%}.col-sm-5th-pull-2{right:40%}.col-sm-5th-pull-1{right:20%}.col-sm-5th-pull-0{right:auto}.col-sm-5th-push-5{left:100%}.col-sm-5th-push-4{left:80%}.col-sm-5th-push-3{left:60%}.col-sm-5th-push-2{left:40%}.col-sm-5th-push-1{left:20%}.col-sm-5th-push-0{left:auto}.col-sm-5th-offset-5{margin-left:100%}.col-sm-5th-offset-4{margin-left:80%}.col-sm-5th-offset-3{margin-left:60%}.col-sm-5th-offset-2{margin-left:40%}.col-sm-5th-offset-1{margin-left:20%}.col-sm-5th-offset-0{margin-left:0}}@media (min-width:992px){.col-md-5th-1,.col-md-5th-2,.col-md-5th-3,.col-md-5th-4{float:left}.col-md-5th-5{float:left;width:100%}.col-md-5th-4{width:80%}.col-md-5th-3{width:60%}.col-md-5th-2{width:40%}.col-md-5th-1{width:20%}.col-md-5th-pull-5{right:100%}.col-md-5th-pull-4{right:80%}.col-md-5th-pull-3{right:60%}.col-md-5th-pull-2{right:40%}.col-md-5th-pull-1{right:20%}.col-md-5th-pull-0{right:auto}.col-md-5th-push-5{left:100%}.col-md-5th-push-4{left:80%}.col-md-5th-push-3{left:60%}.col-md-5th-push-2{left:40%}.col-md-5th-push-1{left:20%}.col-md-5th-push-0{left:auto}.col-md-5th-offset-5{margin-left:100%}.col-md-5th-offset-4{margin-left:80%}.col-md-5th-offset-3{margin-left:60%}.col-md-5th-offset-2{margin-left:40%}.col-md-5th-offset-1{margin-left:20%}.col-md-5th-offset-0{margin-left:0}}@media (min-width:1200px){.col-lg-5th-1,.col-lg-5th-2,.col-lg-5th-3,.col-lg-5th-4{float:left}.col-lg-5th-5{float:left;width:100%}.col-lg-5th-4{width:80%}.col-lg-5th-3{width:60%}.col-lg-5th-2{width:40%}.col-lg-5th-1{width:20%}.col-lg-5th-pull-5{right:100%}.col-lg-5th-pull-4{right:80%}.col-lg-5th-pull-3{right:60%}.col-lg-5th-pull-2{right:40%}.col-lg-5th-pull-1{right:20%}.col-lg-5th-pull-0{right:auto}.col-lg-5th-push-5{left:100%}.col-lg-5th-push-4{left:80%}.col-lg-5th-push-3{left:60%}.col-lg-5th-push-2{left:40%}.col-lg-5th-push-1{left:20%}.col-lg-5th-push-0{left:auto}.col-lg-5th-offset-5{margin-left:100%}.col-lg-5th-offset-4{margin-left:80%}.col-lg-5th-offset-3{margin-left:60%}.col-lg-5th-offset-2{margin-left:40%}.col-lg-5th-offset-1{margin-left:20%}.col-lg-5th-offset-0{margin-left:0}}
	.listing-item-content.absC { position:absolute;z-index:11111;}
	html .listing-item-container .listing-item-content.absC h3.white {  color:#fff !important; text-shadow: 2px 2px 3px #666;}
	 </style>
				 
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
				 
				 <div class="clearfix"></div>
	 
 
 
