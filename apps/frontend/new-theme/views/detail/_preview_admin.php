<?php
	
		    ?>
		    <style>
		    #pageHeader {display:none; }.absolutehtml .container_class {
    margin-top:  0px;
		    }
		    .closepopu {display:none !important; }
		   .image-container {    background: #eee;    padding: 10px;    overflow-y: auto;      max-height: 200px;}
		        .preview-img { width: calc(25% - 5px);min-width:200px; float:left;border:1px solid #eee;overflow: hidden;height: 150px;margin-right:5px; background:#fff; }
		        .img-thumbnail-b { width: 100%;max-height:100px;height: 100%;}
		        .img-thumbnail-b img { object-fit : contain; width:100%;height: 100%; }
		    </style>
		    <script>
		         var updateUrl = '<?php echo $model->StatusUrlBack;?>'
		          var deleteUrl = '<?php echo $model->StatusUrlDeleteBack;?>'
		        function UpdateStatus(k){
		            var updateUrl2 = updateUrl+'/id/'+$(k).attr('data-id')+'/status/'+$(k).val();
		             
		            $.get(updateUrl2,function(data){ if(data=='1'){ alert('Successfully changed status') ; } });
		            //$.get(updateUrl,{st});
		        }
		         function deleteImage(k){
		             var conf  = confirm('Are you sure to remove image ?');
		             if(conf){
		            var deleteUrl2 = deleteUrl+'/id/'+$(k).attr('data-id') ;
		             var thiiddel = $(k);
		            $.get(deleteUrl2,function(data){ if(data=='1'){ alert('Successfully deleted') ; thiiddel.closest('.preview-img').remove();  } });
		             }
		        }
		         function updateStatus(k){
		             
		            var updateUrl =  $(k).attr('data-url') ;
		             
		            $.get(updateUrl,function(data){ if(data=='1'){ $('.buttons-list').find('.btn').removeClass('btn-secondary');  alert('Successfully updated AD status') ; $(k).addClass('btn-secondary')  } });
		              
		        }
		    </script>
		    <?
		 echo '<div class="image-container  ">
		 <h1  class="HomeSummaryShared__AddressH1-vqaylf-1 cmjCIx" style="display: block;"><span data-testid="home-details-summary-headline" class="Text__TextBase-sc-1cait9d-0 dhOdUy" style="font-size:20px;">Image Management</span></h1>
		 ';
		 foreach( $images as $k2=>$v2){
		     	$image_url1 =   $model->getdetailImages($v2->image_name, 'A' )  ;
			  
		      echo '<div class="preview-img margin-top-10">
		      <div class="img-thumbnail-b margin-top-10"><img src="'.$image_url1 .'"></div>
		      <div class="img-actions   margin-top-10">
		        <div class="col-sm-12   " style="white-space: nowrap;"><input type="radio" name="change_status_'.$v2->id.'" id="change_status1_'.$v2->id.'" onchange="UpdateStatus(this)" value="1"  data-id="'.$v2->id.'" ';echo $v2->status == 'A' ? 'checked="true"' : ""  ;   echo' /><label for="change_status1_'.$v2->id.'" style="display: inline-block;">Active</label> <input type="radio"  name="change_status_'.$v2->id.'"  id="change_status2_'.$v2->id.'" onchange="UpdateStatus(this)" value="0"  data-id="'.$v2->id.'" ';echo $v2->status == 'I' ? 'checked="true"' : ""  ;  echo'  /><label for="change_status2_'.$v2->id.'"  style="display: inline-block;">Inactive</label> <a href="javascript:void(0)" style="margin-left:10px;"  data-id="'.$v2->id.'"  onclick="deleteImage(this)" ><i class="fa fa-trash"></i></a></div>
		       </div>
		       
		       </div>';
			  
		       
		   
		 }
		 echo '<div class="clearfix"></div></div><div class="clearfix"></div>';
		 ?>
		 <div class="clearfix"></div>
		  <div class="clearfix margin-top-10"></div>
		  <div class="buttons-list">
		 <button type="button" class="btn <?php echo  $model->status=='W' ? 'btn-secondary' : 'btn-default';?>" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/status_change/val/W/id/'.$model->id, true);?>" >Wait for Approval</button>
<button type="button" class="btn  <?php echo $model->status=='R' ? 'btn-secondary' : 'btn-default';?>" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/status_change/val/R/id/'.$model->id, true);?>" >Reject</button>
<button type="button" class="btn  <?php echo $model->status=='I' ? 'btn-secondary' : 'btn-default';?>" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/status_change/val/I/id/'.$model->id, true);?>" >Inactive</button>
<button type="button" class="btn <?php echo $model->status=='A' ? 'btn-secondary' : 'btn-default';?>" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/status_change/val/A/id/'.$model->id, true);?>">Approve</button>
</div>