

 <div class="row">

                        <!-- Area Chart -->
                        <div class="col-sm-12">
                            <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
             

              <p class="box-title"><?php echo $title;?></p>
              <!-- tools box -->
             
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div class=" ">
                                    <?php
                                    $price  = array();$format  = array();
                                    
                                   
                                    foreach( $itemsArray as $k=>$v){
                                        $price[$k] = $v['price']  ;
                                        $format[$k] = $v['formated']  ; 
                                         
                                    }
                                    
                                     ?>
                                    <script>
                                    var laber = '<?php echo  trim(($city_name))  ;?>';
                                    var   xaxis =  <?php echo  json_encode(array_keys($itemsArray));?>          
                                    var   yaxis1 =  <?php echo  json_encode(array_values($price)); ?> 
                                    var   yaxisformated =  <?php echo  json_encode(array_values($format)); ?> 
                         
                                    </script>
                                    <canvas id="myChart"   height="140"></canvas>
<script>
 
if(typeof Chart != "undefined"){
	$(function(){
var ctx = document.getElementById('myChart').getContext('2d');
var data = {
  labels:xaxis,
  datasets: [{
    data: yaxis1,
    data_formated: yaxisformated,
    label: laber,
    backgroundColor: "#f27f52",
     fill:false
  }, 
  ]
}
var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
		  legend: {
            display: false,
            
        },
        scales: {
          yAxes: [{
			  scaleLabel: {
        display: true,
        labelString: '<?php echo urldecode($ytitle);?>'
      },
          ticks: {
            beginAtZero: true,
       
              // Return an empty string to draw the tick line but hide the tick label
              // Return `null` or `undefined` to hide the tick line entirely
              userCallback: function(value, index, values) {
				  
			 
                // Convert the number to a string and splite the string every 3 charaters from the end
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                // Convert the array to a string and format the output
                value = value.join(',');
             //  value =   value.replace(/\.000([^\d])/g,'$1');
                return  value;
               }
          }
        }]
        },
       tooltips: { 
          callbacks: {
                        label: function(tti, data) {
                               return  data.datasets[tti.datasetIndex].label+'  '+data.datasets[tti.datasetIndex].data_formated[tti.index] +'  <?php echo urldecode($ytitle2);?>'  ;
               
                        },
                    }
            }
    },
    
});

})
}
 
</script>
                                </div>
            </div>
          
          </div>
                        </div>

                  </div>
 
