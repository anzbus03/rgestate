     <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
             <?php 
              if(!empty($property)){
                  ?>
                    <div class="box-header with-border">
				<h3 class="card-title">Statistics - <?php echo $property->ad_title;?></h3>
				</div>
                  <?
  }
  ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <a href="javascript:void(0)" onclick="togglaChart1(this)" style="    position: absolute;    right:15px;    top: 0px;    z-index: 1;" class="btn btn-primary btn-xs">Line Chart</a>
      
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                     
                     <script src="https://code.highcharts.com/highcharts.js"></script> 
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

                     
							<?php
$date    =  strtotime(date('Y-m-d'));
		$enddate = strtotime("-12 months", $date);
	$enddate_start = 	strtotime("23 February 2021");
	if(	$enddate_start > $enddate){ $enddate = $enddate_start; }
	  
		$e_date = Statistics::model()->allsupCount($date,$enddate,'E');
		$c_date = Statistics::model()->allsupCount($date,$enddate,'C');
    	$w_date = Statistics::model()->allsupCount($date,$enddate,'W');
    	$t_date = Statistics::model()->allsupCount($date,$enddate,'T');
    	$p_views = StatisticsPage::model()->pageCountall($date,$enddate);
    	
    	 if(empty($property)){
    	     define('sale_rent','1');
    		$s_date = Statistics::model()->saleRent($date,$enddate,'1');
			$r_date = Statistics::model()->saleRent($date,$enddate,'2');
			$user_date = Statistics::model()->userGrowth($date,$enddate );
			$ads_date = Statistics::model()->saleRent($date,$enddate,'');
    	 }
	    
//	 print_r($e_date);exit; 
		
		$categoryarray  = array();
		$seriesarray   = array();
		
		$date1 = '';$date1_Call ='';$date1_W='';$date1_T='';$date1_P='';$date1_S = ''; $date1_R = ''; $date1_USer=''; $date1_add=''; 
		for ($enddate; $enddate <= $date; $enddate = strtotime("+1 day", $enddate)) {
		 
				 
				$onDate			 =	date('Y-m-d',$enddate);
				$categoryarray[] =   date('M d',$enddate) ;
					$val = isset($e_date[$onDate]) ? $e_date[$onDate] : '0';
					$val_c = isset($c_date[$onDate]) ? $c_date[$onDate]  :'0';
					$val_w = isset($w_date[$onDate]) ? $w_date[$onDate]  :'0';
					$val_t = isset($t_date[$onDate]) ? $t_date[$onDate]  :'0';
					$val_p = isset($p_views[$onDate]) ? $p_views[$onDate]  :'0';
					
					if(defined('sale_rent')){
					$val_sale = isset($s_date[$onDate]) ? $s_date[$onDate]  :'0';
					$val_rent = isset($r_date[$onDate]) ? $r_date[$onDate]  :'0';
					$val_user = isset($user_date[$onDate]) ? $user_date[$onDate]  :'0';
					$val_add = isset($ads_date[$onDate]) ? $ads_date[$onDate]  :'0';
					}
					$val1 =  (strtotime($onDate.' 00:00:00')*1000);
					$date1 .= '['.(int)$val1.'  , '.$val.'] ,';
					$date1_Call .= '['.(int)$val1.'  , '.$val_c.'] ,';
					$date1_W .= '['.(int)$val1.','.$val_w.'],';
					$date1_T .= '['.(int)$val1.'  , '.$val_t.'] ,';
					$date1_P .= '['.(int)$val1.', '.$val_p.'],';
					
					if(defined('sale_rent')){
					$date1_S .= '['.(int)$val1.'  , '.$val_sale.'] ,';
					$date1_R .= '['.(int)$val1.'  , '.$val_rent.'] ,';
					$date1_USer .= '['.(int)$val1.'  , '.$val_user.'] ,';
					$date1_add .= '['.(int)$val1.'  , '.$val_add.'] ,';
					}
					
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


     
                     
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                    
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
         
<?php 
if(defined('sale_rent')){
    ?>
    <div class="row"  style="margin-top:25px;margin-bottom:25px; position:relative">
    <div class="col-md-12"><a href="javascript:void(0)" onclick="togglaChart(this)" style="    position: absolute;    right: 19px;    top: 5px;    z-index: 1;" class="btn btn-primary btn-xs">Line Chart</a>
      
                    <figure class="highcharts-figure box box-solid">
    <div id="container_sale"></div>
 
</figure>
    </div>
    </div>
	
    <div class="row  " style="margin-top:25px;margin-bottom:25px; position:relative">
    <div class="col-md-6"><a href="javascript:void(0)" onclick="togglaChart4(this)" style="    position: absolute;    right: 19px;    top: 5px;    z-index: 1;" class="btn btn-primary btn-xs">Line Chart</a>
      
                    <figure class="highcharts-figure box box-solid">
    <div id="container_user"></div>
 
</figure>
    </div>
    <div class="col-md-6"><a href="javascript:void(0)" onclick="togglaChart5(this)" style="    position: absolute;    right: 19px;    top: 5px;    z-index: 1;" class="btn btn-primary btn-xs">Line Chart</a>
      
                    <figure class="highcharts-figure box box-solid">
    <div id="container_ads"></div>
 
</figure>
    </div>
    </div>
	
	
	
	<script>
	function saleConvert(type){
    Highcharts.chart('container_sale', {
    chart: {
        type: type
    },
    credits:{
enabled:false
},
   rangeSelector:{
                enabled:true,
                selected: 5,
                 buttons: [
                     {
                     
        type: 'week',
        count: 1,
        text: '1w',
      
    },
              {
                     
        type: 'week',
        count: 2,
        text: '2w',
      
    },
    {
     type: 'week',
        count: 3,
        text: '3w',
      
    },
    
                     {
                     
        type: 'month',
        count: 1,
        text: '1m',
      
    },
    {
                     
        type: 'month',
        count: 2,
        text: '2m',
      
    },
    {
        type: 'month',
        count: 3,
        text: '3m'
    }, {
        type: 'month',
        count: 6,
        text: '6m'
    }, {
        type: 'ytd',
        text: 'YTD'
    }, {
        type: 'year',
        count: 1,
        text: '1y'
    }, {
        type: 'all',
        text: 'All'
    }]
            },
    title: {
        text: 'Sale - Rent '
    },
  
    xAxis: {
		 type: 'datetime',
		 
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Number'
        }
    },
    
   
        plotOptions: {
    column: {
            dataLabels: {
                enabled: false
            }
        },
              
        },
    series: [
         {
        name: 'for Sale',
        data: [<?php echo $date1_S;?>]
    },
        {
        name: 'for Rent',
        data: [<?php echo $date1_R;?>],
         
        color: 'pink'
    }, 
    ]
});
     }
     function userConvert(type){
    Highcharts.chart('container_user', {
    chart: {
        type: type
    },
    credits:{
enabled:false
},
   rangeSelector:{
                enabled:true,
                selected: 5,
                 buttons: [
                     {
                     
        type: 'week',
        count: 1,
        text: '1w',
      
    },
              {
                     
        type: 'week',
        count: 2,
        text: '2w',
      
    },
    {
     type: 'week',
        count: 3,
        text: '3w',
      
    },
    
                     {
                     
        type: 'month',
        count: 1,
        text: '1m',
      
    },
    {
                     
        type: 'month',
        count: 2,
        text: '2m',
      
    },
    {
        type: 'month',
        count: 3,
        text: '3m'
    }, {
        type: 'month',
        count: 6,
        text: '6m'
    }, {
        type: 'ytd',
        text: 'YTD'
    }, {
        type: 'year',
        count: 1,
        text: '1y'
    }, {
        type: 'all',
        text: 'All'
    }]
            },
    title: {
        text: 'Visitors - Growth'
    },
  
    xAxis: {
		 type: 'datetime',
		 
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Visitors'
        }
    },
    
   
        plotOptions: {
    column: {
            dataLabels: {
                enabled: false
            }
        },
              
        },
    series: [
         {
        name: 'Visitors Growth',
        data: [<?php echo $date1_USer;?>]
    },
      
    ]
});
     }
      	function adsConvert(type){
    Highcharts.chart('container_ads', {
    chart: {
        type: type
    },
    credits:{
enabled:false
},
   rangeSelector:{
                enabled:true,
                selected: 5,
                 buttons: [
                     {
                     
        type: 'week',
        count: 1,
        text: '1w',
      
    },
              {
                     
        type: 'week',
        count: 2,
        text: '2w',
      
    },
    {
     type: 'week',
        count: 3,
        text: '3w',
      
    },
    
                     {
                     
        type: 'month',
        count: 1,
        text: '1m',
      
    },
    {
                     
        type: 'month',
        count: 2,
        text: '2m',
      
    },
    {
        type: 'month',
        count: 3,
        text: '3m'
    }, {
        type: 'month',
        count: 6,
        text: '6m'
    }, {
        type: 'ytd',
        text: 'YTD'
    }, {
        type: 'year',
        count: 1,
        text: '1y'
    }, {
        type: 'all',
        text: 'All'
    }]
            },
    title: {
        text: 'Ads - Growth'
    },
  
    xAxis: {
		 type: 'datetime',
		 
        //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Growth'
        }
    },
    
   
        plotOptions: {
    column: {
            dataLabels: {
                enabled: false
            }
        },
              
        },
    series: [
         {
        name: 'Ads - Growth',
        data: [<?php echo $date1_add;?>]
    },
      
    ]
});
     }
  
     $(function(){
		  saleConvert('column');
		  userConvert('column')
		  adsConvert('column')
		 
		 })
	</script>
  
  
  
   <?php
    
}
?>
 <script>
      
function statistics(type){
    
    Highcharts.chart('container', {
    chart: {
        type: type
    },
    credits:{
enabled:false
},
   rangeSelector:{
                enabled:true,
                selected: 1,
                   buttons: [
                     {
                     
        type: 'week',
        count: 1,
        text: '1w',
      
    },
              {
                     
        type: 'week',
        count: 2,
        text: '2w',
      
    },
    {
     type: 'week',
        count: 3,
        text: '3w',
      
    },
    
                     {
                     
        type: 'month',
        count: 1,
        text: '1m',
      
    },
    {
                     
        type: 'month',
        count: 2,
        text: '2m',
      
    },
    {
        type: 'month',
        count: 3,
        text: '3m'
    }, {
        type: 'month',
        count: 6,
        text: '6m'
    }, {
        type: 'ytd',
        text: 'YTD'
    }, {
        type: 'year',
        count: 1,
        text: '1y'
    }, {
        type: 'all',
        text: 'All'
    }]
            },
    title: {
        text: '<?php echo $title;?>'
    },
  
    xAxis: {
		 type: 'datetime',
		// reversed: true,
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
              column: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: true
        }
        },
    series: [
         {
        name: 'Page Views',
        data: [<?php echo $date1_P;?>]
    },
        {
        name: 'Email',
        data: [<?php echo $date1;?>],
        visible: false,
        color:'#EF6C00'
    },
    {
        name: 'Call',
        data: [<?php echo $date1_Call;?>],
         visible: false,
         color:'#4285F4'
    },
     {
        name: 'WhatsApp',
        data: [<?php echo $date1_W;?>],
         visible: false,
         color:'#38C739'
    },
     {
        name: 'Text',
        data: [<?php echo $date1_C;?>],
         visible: false,
         color:'#1891BE'
    },
       
    ]
});
     }
 
$(function(){
    statistics('column')
   
    
}
);
var tog_chart1 = 'column';
var tog_chart = 'column';
function togglaChart(k){
    if(tog_chart=='column'){
        tog_chart = 'line';
        saleConvert('line');
        $(k).html('Bar Chart')
    }
    else{
        tog_chart = 'column';
        saleConvert('column');
        $(k).html('Line Chart')
    }
}
function togglaChart1(k){
    if(tog_chart1=='column'){
        tog_chart1 = 'line';
        statistics('line');
        $(k).html('Bar Chart')
    }
    else{
        tog_chart1 = 'column';
        statistics('column');
        $(k).html('Line Chart')
    }
}
var tog_chart4 = 'column'; 
function togglaChart4(k){
    if(tog_chart4=='column'){
        tog_chart4 = 'line';
        userConvert('line');
        $(k).html('Bar Chart')
    }
    else{
        tog_chart4 = 'column';
        userConvert('column');
        $(k).html('Line Chart')
    }
}
var tog_chart5 = 'column'; 
function togglaChart5(k){
    if(tog_chart5=='column'){
        tog_chart5 = 'line';
        adsConvert('line');
        $(k).html('Bar Chart')
    }
    else{
        tog_chart5 = 'column';
        adsConvert('column');
        $(k).html('Line Chart')
    }
}
</script>
    
