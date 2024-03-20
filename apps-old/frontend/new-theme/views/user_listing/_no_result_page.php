<div class="row align-items-center mt-5" style="margin-bottom:50px;margin-top:50px;">
     
      <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 text-center">
        <div id="notfound">
          <div class="notfound">
            <p class="mt-3 mb-4">
				<h6 class="typeLowlight" style="font-size:25px;font-weight:600;color:var(--logo-color)"><?php echo $this->tag->getTag('no_results_found!', 'No Results Found!');?>.</h6>
				<h2><?php echo  $this->tag->gettag('your_search_does_not_match_any','Your search does not match any results.') ;?>.</h2>
				<h5 class="typeWeightNormal mbm"><?php echo  $this->tag->getTag('adjust_filters_to_find_more_ag','Adjust filters to find more agents') ;?>:</h5>
            </p>
          </div>
        </div>
      </div>
    <div class="col-lg-6 col-md-6 mb-lg-0 mb-5" style="height: 300px;background-size: contain;background-repeat: no-repeat;background-position: center;background-image:url('<?php echo Yii::app()->apps->getBaseUrl($this->logo_path);?>')">
          
      </div>
   
    </div>
 
