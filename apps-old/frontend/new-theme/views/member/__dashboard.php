  <?php $counter = PlaceAnAd::model()->getCounter(Yii::app()->user->getId());?>
  
        
			 
   
          <div class="row">
			  <div class="clearfix"></div>
			  <div class="col-sm-12"><h3 class="pageHeading" style="width:100%;">My Stats</h3></div>
			  <div class="clearfix"></div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-arrange-bring-to-front text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-right">Waiting</p>
                      <div class="fluid-container">
                        <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $counter['waiting']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> <a href="<?php echo Yii::app()->createUrl('place_an_ad/index',array('status'=>'W'));?>" class="text-muted ">More Info </a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-approval text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-right">Published</p>
                      <div class="fluid-container">
                        <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $counter['approved']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> <a href="<?php echo Yii::app()->createUrl('place_an_ad/index',array('status'=>'A'));?>"  class="text-muted " >More Info </a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-briefcase-download  text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-right">Rejected</p>
                      <div class="fluid-container">
                        <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $counter['rejected']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> <a href="<?php echo Yii::app()->createUrl('place_an_ad/index',array('status'=>'R'));?>"  class="text-muted " >More Info </a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-archive text-teal icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="card-text text-right">Inactive</p>
                      <div class="fluid-container">
                        <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $counter['inactive']?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3">
                   <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> <a href="<?php echo Yii::app()->createUrl('place_an_ad/index',array('status'=>'I'));?>"  class="text-muted " >More Info </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
         <div class="">
           <?php 
			$model = new PlaceAnAd('serach');
			$model->unsetAttributes();
			$model->user_id  =  Yii::app()->user->getId();
          $this->renderPartial('latest_files',compact('model'));?>
       </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       
        <!-- partial -->
   
