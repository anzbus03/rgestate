 
        <?php
        if($this->member->email_verified != '1'){ ?>
        <div class="row purchace-popup">
        <div class="col-12">
        <div class="alert alert-warning">
        <strong>Info!</strong> Please verify your email . <a href="<?php echo Yii::app()->createUrl('user/emailverification');?>" style="color:red !important" class="text-waring">Click here to resend or change email. </a>
        </div> </div>
        </div>
        <?php }?>
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
          <div class="row purchace-popup">
           <?php
             
           if($this->member->status=='R'){ ?>
                    <div class="col-lg-12 error-page-divider text-lg-left pl-lg-12" style="margin-top:100px;">
                    <h2  class=" text-center"><?php echo  'Sorry' ;?>!</h2>
                    <h3 class="font-weight-light text-center"><?php echo 'Admin rejected your profile' ;?> . <a href="#">@<?php echo $this->member->slug;?></a>.</h3>
                    </div>
                    </div>
          <?php }
          else     if($this->member->status=='W'){ ?>
                    <div class="col-lg-12 error-page-divider text-lg-left pl-lg-12" style="margin-top:100px;">
                    <h2 class=" text-center">Wait!</h2>
                    <h3 class="font-weight-light  text-center">Waiting for admin approval <a href="#">@<?php echo $this->member->slug;?></a>.</h3>
                    </div>
                    </div>
          <?php }else{
			  ?>
                        <div class="col-lg-12 error-page-divider text-lg-left pl-lg-12" style="margin-top:100px;">
                        <h2 class=" text-center">Access Denied!</h2>
                        <h3 class="font-weight-light  text-center">Disabled your account <a href="#">@<?php echo $this->member->slug;?></a>.</h3>
                        </div>
                        </div>
			  <?
		  }
		  ?> </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
           
