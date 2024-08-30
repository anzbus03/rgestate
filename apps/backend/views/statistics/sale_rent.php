     <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
             <?php 
              if(!empty($property)){
                  ?>
                    <div class="box-header with-border">
				<h3 class="card-title">Sale - Rent</h3>
				</div>
                  <?
  }
  ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                     
               

                     
							<?php
$date    =  strtotime(date('Y-m-d'));
		$enddate = strtotime("-9 months", $date);
		
		$s_date = Statistics::model()->saleRent($date,$enddate,'1');
	    $r_date = Statistics::model()->saleRent($date,$enddate,'1');
//	 print_r($e_date);exit; 
		
		$categoryarray  = array();
		$seriesarray   = array();
		$date1 = '';$date1_Call =''; 
		for ($date; $date > $enddate; $date = strtotime("-1 day", $date)) {
		 
				 
				$onDate			 =	date('Y-m-d',$date);
				$categoryarray[] =   date('M d',$date) ;
					$val = isset($e_date[$onDate]) ? $e_date[$onDate] : '0';
					$val_c = isset($c_date[$onDate]) ? $c_date[$onDate]  :'0';
					$val_w = isset($w_date[$onDate]) ? $w_date[$onDate]  :'0';
					$val_t = isset($t_date[$onDate]) ? $t_date[$onDate]  :'0';
					$val_p = isset($p_views[$onDate]) ? $p_views[$onDate]  :'0';
					
					$val1 =  (strtotime($onDate.' 00:00:00')*1000);
					$date1 .= '['.(int)$val1.'  , '.$val.'] ,';
					$date1_Call .= '['.(int)$val1.'  , '.$val_c.'] ,';
					$date1_W .= '['.(int)$val1.'  , '.$val_w.'] ,';
					$date1_T .= '['.(int)$val1.'  , '.$val_t.'] ,';
					$date1_P .= '['.(int)$val1.'  , '.$val_p.'] ,';
					
					$seriesarray1[][ strtotime($onDate.' 00:00:00')*1000] =  isset($calll_date[$onDate]) ? $calll_date[$onDate] : 5;
					//$seriesarray["page_visit"][] = (int) isset($calll_date[$onDate]) ? $calll_date[$onDate] :5;
					//$seriesarray["visitors"][]   = (int) 0;
				 
				
		 }
 $title =	'All Time Statistics';	 
 if(!empty($property)){
 $title = 'Statistics - Property ID '.$property->ReferenceNumberTitle.'<a href="https://www.arabavenue.com/detail/short_link/section/'.$property->section_id.'/id/'.$property->id.'" style="display:block;color:blue" target="_blank">View</a>';
 }
	  
						 
							?>
                 <figure class="highcharts-figure">
    <div id="container"></div>
 
</figure>


<script>
$(function(){
 
    Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    credits:{
enabled:false
},
   rangeSelector:{
                enabled:true,
                selected: 0,
            },
    title: {
        text: '<?php echo $title;?>'
    },
  
    xAxis: {
		 type: 'datetime',
		 reversed: true,
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Number'
        }
    },
    
   
        plotOptions: {
            series: {
                events: {
                    show: function () {
                        var chart = this.chart,
                            series = chart.series,
                            i = series.length,
                            otherSeries;
                        while (i--) {
                            otherSeries = series[i];
                            if (otherSeries != this && otherSeries.visible) {
                                otherSeries.hide();
                            }
                        }
                    },
                    legendItemClick: function() {
                        if(this.visible){
                             return false;   
                        }
                    }
                }
            },
              line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: true
        }
        },
    series: [
         {
        name: 'Sale',
        data: [<?php echo $date1_P;?>]
    },
        {
        name: 'Rent',
        data: [<?php echo $date1;?>],
        color: Highcharts.getOptions().colors[11],
        visible: false
    }, 
    ]
});
     }
);

</script>     
                     
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                    
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
         
