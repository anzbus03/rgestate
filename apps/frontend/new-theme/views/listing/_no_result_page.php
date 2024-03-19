<div class="container">
<div class="row align-items-center mt-5" style="margin-bottom:150px;margin-top:75px;    ">
      <div class="col-lg-3 col-md-3 "></div>
      <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 text-center">
        <div id="notfound">
          <div class="notfound">
            <p class="mt-3 mb-4">
			 	<h2><?php echo  $this->tag->getTag('sorry,_we_couldnt_find_the_pa',"Sorry, we couldn't find the property you're trying to view.");?></h2>
				<h5 class="typeWeightNormal mbm"><?php echo  $this->tag->getTag('adjust_filters_to_find_more_2','Adjust filters to find more properties OR Submit your Requirements') ;?>:</h5>
            </p>
            <button class="btn btnTertiary mrs mbs" onclick="resetFrmbyclick()"><?php echo  $this->tag->getTag('remove_all_filters','Remove all Filters') ;?></button>
            <a href="<?php echo $this->app->createUrl('submited_preq/index');?>" class="btn btnTertiary mrs mbs" style="background-color:var(--secondary-color);border:1px solid var(--secondary-color);color:#fff !important"  ><?php echo  $this->tag->getTag('submit_your_requirements','Submit your Requirements') ;?></a>
            
          </div>
        </div>
      </div>
         <div class="col-lg-3 col-md-3 ">    </div> 
      </div>
   
    </div>
 <style>
     @media only screen and (max-width: 600px) {
  .mrs {
   margin-bottom: 50px;
  }
}
     
 </style>
<script>
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>/';
</script>
