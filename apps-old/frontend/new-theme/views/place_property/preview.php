<style>
#section_picker , #moredetails { display:none; }
body{     
    max-height: 100vh; } .myaccount-menu.is-ended{ display:none; }
</style>
<script type="text/javascript">
  function iframeLoaded() {
      var iFrameID = document.getElementById('idIframe');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + 50 + "px";
      }   
  }
</script>
<style>
    #detail .facts_heading {
    font-size: 23px;margin: 0 0 20px;color: var(--head-color) !important;
}.facts_heading svg {
    color: var(--secondary-color);
}.facts_heading svg { 
    width: 20px !important;
    height: 20px !important;
}
</style>
<div class="col-sm-12">
  <h4 class="subheading_font row  full-content" style="display:block;"><?php echo $this->tag->getTag('preview','Preview');?> <?php if(Yii::app()->isAppName('frontend')){ ?> <a href="<?php $refref = Yii::app()->request->urlReferrer;echo  !empty($refref) ? $refref : Yii::app()->createUrl('site/index')  ;?>" class="pull-right margin-right-10"><?php echo $this->tag->getTag('back','Back');?></a> <?php } ?></h4>
    </div>
                 <iframe id="idIframe" src="<?php echo Yii::App()->createUrl('detail/preview',array('preview_id'=>$LocalStorage->cookie_name));?>" onload="iframeLoaded()" style="min-height:70vh;width:100%;border:0px;border-bottom: 1px solid #eee;"></iframe>
<?php
	$this->renderPartial('//place_property/form_new', compact('model',"country","section",'list_type','image_array','member'));
		?>
  <script>
	user_login_url = '<?php echo $this->app->createUrl('user/load_signin_form');?>';
	var login_option = '<?php echo $this->app->createUrl('user/signin');?>';
	var statistics  = '<?php echo Yii::app()->createUrl('articles/statistics');?>';
	var user_details_info_url = '<?php echo $this->app->createUrl('user/partialInfo');?>';
  $(function(){  $('#post-property').attr('action','<?php echo Yii::app()->createUrl('place_an_ad/preview');?>');  })
	 
   </script>
   <div class="loadCnter"><div class="nspinerr"></div></div>
   <div id="myModal3" class="modal fade" data-backdrop="static"  role="dialog" aria-labelledby="myModal3Label" aria-hidden="true">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
           <div class="modal-body" id="cn_propertys">
       <div class=" " id="raw_ht_ml" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    
    </div>
  </div>
</div>  
  
