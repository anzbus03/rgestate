<style>
.select2-container .select2-selection--single {  height: 38px; }
.select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 38px; text-align: left;}
.select2-container--default .select2-selection--single .select2-selection__arrow { height:36px; }
.select2-container--default .select2-results__option--highlighted[aria-selected] {   background-color: #F15B61; }
.banner-row { background : #fff  !important; }
.banner-row .banner-box .banner-box-content span.data { width:100% !important; }
</style>
 
 
	<?php $this->renderPartial('_search_home_container');?>   
      
 <div class="clearfix"></div>
      <div class="container row-data" style="margin-top:50px;">
          <div class="row">
              <h1>Get the essential info you need to zero in on the right agent</h1>

              <div class="col-sm-4 content-box">
                  <i class="fa fa-thumbs-up"></i>
                  <h1>Recommendations</h1>
                  <p>Get the essential info you need to zero in on the right agent</p>
              </div>

              <div class="col-sm-4 content-box">
                  <i class="fa fa-address-card"></i>
                  <h1>Recommendations</h1>
                  <p>Get the essential info you need to zero in on the right agent</p>
              </div>

              <div class="col-sm-4 content-box">
                  <i class="fa fa-envelope"></i>
                  <h1>Recommendations</h1>
                  <p>Get the essential info you need to zero in on the right agent</p>
              </div>

          </div>
      </div>
 <script>
      $(function(){ $('select').select2(); })
      </script>
