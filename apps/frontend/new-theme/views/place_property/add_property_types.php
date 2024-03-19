<h4 class="subheading_font row "><?php echo $this->tag->getTag('videos','Videos'); $normal = $this->tag->getTag('normal','Normal');$vide = $this->tag->getTag('video_title','Video Title'); $yt = $this->tag->getTag('youtube_url','Youtube URL'); ?></h4>
<table class="table table-bordered m-responsivw">
    <thead>
      <tr>
          <?php $title =  $this->tag->getTag('title','Title') ;  $url =   'URL'  ; $options = ""  ; ?>
        <th><?php  echo $this->tag->getTag('video_title','Video Title');?></th>
        <th><?php echo $this->tag->getTag('youtube_url','Youtube URL');?></th>
        <th style="width:30px;"></th>
      </tr>
    </thead>
    <tbody>
      <?php
 
      $thnl = '<tr class="textFields {i_class}"  >';
      $thnl .= '<td data-label="'.$title.'"><div class="insinert"><input type="text" dir="auto" class="form-control pull-left margin-right-5" placeholder="'.$vide.'" dir="auto"  name="video_urls[title][]" required value="{value_title}" style="width: calc(100% - 105px);"  /><select  class="form-control pull-left" style="max-width: 100px; ;"  name="video_urls[video_type][]">[VIDEO_TYPE]</select><div></td>';
      $thnl .= '<td data-label="'.$url.'"><div class="insinert"><input type="text" class="form-control" placeholder="'. $yt.'" required  name="video_urls[video][]" value="{value_video}" maxlength="150" /></div></td>'; 
      $thnl .= '<td data-label="'.$options .'"  class="del-ro"><div class="insinert text-center"><a href="javascript:void(0)"  onclick="removeAppendRow(this)"><i class="fa fa-trash"></i></a></div></td></tr>';
     $post = array();
      if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
				 
					$pTypes =  $model->aVideos ;
					if(!empty($pTypes )){
					foreach($pTypes as $pos){
						$post['title'][] =  $pos->title;
						$post['video'][] =  $pos->video; 
						$post['video_type'][] =  $pos->video_type; 
					}
					}
					
					
					}else{
					$post =  Yii::App()->request->getPost('video_urls',array());
		}
      if(!empty($post)){ 
		 
		for($i= 0 ; $i< sizeOf($post['title']);$i++){
			$i_class = '';
				if(empty( $post['title'][$i]) ||  empty($post['video'][$i])  )
						{
							$i_class = 'error';
						
					}
					if(isset($post['video_type'][$i])  and $post['video_type'][$i]=='1') {
						 $ht_vitype = '<option value="0">'.$normal.'</option><option value="1" selected  >360</option>' ;
					}
					else{
						 $ht_vitype = '<option value="0" selected>Normal</option><option value="1"   >360</option>' ;
					}
		 	echo  Yii::t('app',$thnl,array('{i_class}'=>$i_class, '[VIDEO_TYPE]'=> $ht_vitype , '{value_title}'=> $post['title'][$i],'{value_video}'=> $post['video'][$i]   ));
		};  
	  }
	  ?>
      <tr id="append_row"><td colspan="100%"><a href="javascript:void(0)" onclick="appendRowr(this)" class="btn btn-default"><i class="fa fa-plus"></i> <?php echo $this->tag->getTag('add_videos','Add Videos');?></a></td></tr>
	    
    </tbody>
  </table>
        <?php echo $form->hiddenField($model, 'video_urls'); ?>
        <?php echo $form->error($model, 'video_urls');?>
              
<script>
	var appendRowObj =  '<?php echo  Yii::t('app',$thnl,array( '{value_title}'=>'', '[VIDEO_TYPE]' => '<option value="">Normal</option><option value="1"  >360</option>' ,'{value_video}'=>''   ,'\n'=>'','\s'=>''  ));;?>';
function appendRowr(k){
	$('#append_row').before(  appendRowObj );$('select').not( "select.select2-hidden-accessible" ).select2({  minimumResultsForSearch: -1 });
	inputValidate()
}
function removeAppendRow(k){
 
	$(k).closest('tr').remove();
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
