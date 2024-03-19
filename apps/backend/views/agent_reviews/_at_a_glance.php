<style>
.info-box {
    display: block;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
}.info-box-icon {
    border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0,0,0,0.2);
        background-color: rgba(0, 0, 0, 0.2);
}.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}.visible-lg-block, .visible-lg-inline, .visible-lg-inline-block, .visible-md-block, .visible-md-inline, .visible-md-inline-block, .visible-sm-block, .visible-sm-inline, .visible-sm-inline-block, .visible-xs-block, .visible-xs-inline, .visible-xs-inline-block {
    display: none !important;
}.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}.progress-description, .info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<div class=" " style="padding:15px;background-color:#ecf0f5">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-wpforms"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Reviews</span>
              <span class="info-box-number"><?php echo (int)$total_application;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-wpforms"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Accepted</span>
              <span class="info-box-number"><?php echo (int)$total_accepted_application;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
      
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-wpforms"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Rejected</span>
              <span class="info-box-number"><?php echo $total_rejected;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <!-- /.col -->
        <div class="clearfix"></div>
      </div>
