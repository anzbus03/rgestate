    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
 <div class="row">

                        <!-- Area Chart -->
                        <div class="col-sm-12">
                            <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Last 12 months active order report</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div class=" ">
                                    <?php
                                    $net  = array();$total  = array();$discount = array();$profit = array();
                                    $count = array();
                                    foreach( $itemsArray as $k=>$v){
                                        $net[$k] = $v['net']  ;
                                        $total[$k] = $v['total']  ; 
                                        $discount[$k] = $v['discount']  ; 
                                        $profit[$k] = $v['net'] - $v['discount'] - $v['total']  ;
                                    };
                                 
                                    
                                    ?>
                                    <script>
                                    var   xaxis =  <?php echo  json_encode(array_keys($itemsArray));?>          
                                    var   yaxis1 =  <?php echo  json_encode(array_values($net)); ?> 
                                     var   yaxis2 =  <?php echo  json_encode(array_values($total)); ?> 
                                      var   yaxis3 =  <?php echo  json_encode(array_values($discount)); ?> 
                                       var   yaxis4 =  <?php echo  json_encode(array_values($profit)); ?> 
                                    </script>
                                    <canvas id="myChart" width="400" height="100"></canvas>
<script> 
var ctx = document.getElementById('myChart').getContext('2d');
var data = {
  labels:xaxis,
  datasets: [{
    data: yaxis1,
    label: 'Total Amount',
    backgroundColor: "#00c0ef"
  },

  {
    data: yaxis3,
    label: 'Total   Discount',
    backgroundColor: "#00a65a"
  },
    {
    data: yaxis2,
    label: 'Total Tax',
    backgroundColor: "#f39c12 "
  }
  ,
    {
    data: yaxis4,
    label: 'Total Income',
    backgroundColor: "#f56954"
  }
  ]
}
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
                                </div>
            </div>
          
          </div>
                        </div>

                  </div>
 
