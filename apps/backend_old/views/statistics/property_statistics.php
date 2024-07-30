       
<?php 

switch(@$_GET['limit']){
	case '50':
	$height_p ='750';
	break;
	case '100':
	$height_p ='1500';
	break;
	default:
	$height_p ='300';
	break;
}

 ?>
      <div class="">
      <style>
		  .d-flex { display:flex; }
		  .flex1 { flex:1; }
		  .topSectount-main {
    margin-bottom: 30px;
    background: #fafafa;
    padding: 30px;
    border-radius: 5px;
    margin-right: 10px;
 
}
.element-box {
    border-radius: 6px;
    background-color: #fff;
    box-shadow:0 1px 6px 0 rgba(32,33,36,.28);
    padding: 1.5rem 2rem;
    margin-left:0px;
    margin-right:0px;
    float: left;
display:block; min-width: 100%;
width: auto;
}
.stat_content{
float: left;
width: 100%;
}.margin-top-30 {
    margin-top: 30px!important;
}
.b-l{border-left:1px solid rgba(0,0,0,0.1)}.b-r{border-right:1px solid rgba(0,0,0,0.1)}.b-t{border-top:1px solid rgba(0,0,0,0.1)}.b-b{border-bottom:1px solid rgba(0,0,0,0.1)}
.el-tablo .value {
    font-size: 38.88px;
    font-weight: 500;
    letter-spacing: 1px;
    line-height: 1.2;
    display: inline-block;
    vertical-align: middle;
    position:relative;
}.el-tablo .label {
    display: block;
    font-size: 10.08px;
    text-transform: uppercase;
    color: #666;
    letter-spacing: 1px;
}.el-tablo.centered.padded {
	padding: 0px 0px 30px;
    padding-left: 10px;
    padding-right: 10px;
}
.el-tablo.centered.padded.top-p .both_count{ left: -23px; } 
.el-tablo.centered.padded.top-p img{ width: 15px; } 
	padding: 30px 0px 0px;
}
.padded {
    padding: 1rem 2rem;
}.b-l {
    border-left: 1px solid rgba(0,0,0,0.1);
} .element-info-with-icon {
    display: -webkit-box;
    display: block;
    -webkit-box-align: center;
    align-items: center;
    margin-top: 30px;
    margin-bottom: 30px;
}  .element-info-with-icon.smaller .element-info-icon {
    -webkit-box-flex: 0;
    flex: 0 0 50px;
    font-size: 20px;color: #047bf8;
}
  .element-info-with-icon.smaller .element-info-text .element-inner-header {
    margin-bottom: 0px;
}
  .element-inner-header {
    margin-bottom: 0.5rem;
    margin-top: 0px;
    display: block;
}
.stat_content h5,.stat_content .h5 {
    font-size: 1.25rem;
} .element-inner-desc {
    color: #999;
    font-weight: 300;
    font-size: .81rem;
    display: block;
}.os-progress-bar {
    margin-bottom: .5rem;
}.os-progress-bar .bar-labels {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
    margin-bottom: 5px;
}.os-progress-bar .bar-label-left span {
    margin-right: 5px;
}
.os-progress-bar .bar-labels span {
    font-size: .72rem;
}.os-progress-bar .bar-label-left span.positive {
    color: #619B2E;
}.os-progress-bar .bar-label-right span.info {
   font-weight: 500 !important;
    letter-spacing: 1px;
    line-height:1;
     
    font-size: .75rem;
    text-transform: uppercase
}.os-progress-bar .bar-label-right span {
    margin-left: 5px;
}
.os-progress-bar .bar-labels span {
    font-size: .72rem;
}
.os-progress-bar.blue .bar-level-1, .os-progress-bar.primary .bar-level-1 {
    background-color: #F2F2F2;
}
.os-progress-bar .bar-level-1, .os-progress-bar .bar-level-2, .os-progress-bar .bar-level-3 {
    border-radius: 12px;
    height: 6px;
}.os-progress-bar.blue .bar-level-2, .os-progress-bar.primary .bar-level-2 {
    background-color: #65affd;
}.b-r-xl {
    border-right: 1px solid rgba(0,0,0,0.1);
}
.b-l {
    border-left: 1px solid rgba(0,0,0,0.1);
}
#container , #bodyconstraint {
 
    background-color: #edf0f5;
}
.both_count img { display:inline;width:25px;}
.both_count {position: absolute;top:0px;
    
   
    text-align: center; 
    position: absolute;
top: -11px;
text-align: center;
left: -31px;
    }
    .sec1-im2 { margin-left:-10px;}
    .sp50 { float:left;width:50%;    line-height: 1.3; }
    .sp33 { float:left;width:33%;    line-height: 1.6; }
    .mlclass { color: #00A1CE; text-align:right;}
    .fmclass { color: #D22247;text-align:left; }
    .fm-ma img{ width: 50px;}
    span.blv { font-weight:600; font-size:18px;}
     img.fmbk2{     margin-left: 0px;
    float: right; }
    .dispflx { 
display: block; }
  .dispflx img {
    width: auto;
    height: 30px;
    float: left;
    text-align: right;
    max-width: 50%;
}
    .seprated .el-tablo.centered.padded { padding:0px;;}
    .row.seprated{ padding-top:10px;}
    
    .profile-tile-box {
    width: 24%;
    text-align: center;
    border-radius: 6px;
    padding: 1.2rem 0.5rem 0.5rem;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(126,142,177,0.12);
    text-decoration: none;
    color: #3E4B5B;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    display: block;
    float:left;
        margin-bottom: 5px;
    margin-right: 1%;
}
.profile-tile-box:hover {
    -webkit-transform: translateY(-5px) scale(1.02);
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0px 5px 12px rgba(126,142,177,0.2);
}.pt-avatar-w {
    display: inline-block;
     
    overflow: hidden;
}.pt-avatar-w img {
    height: 40px;
    vertical-align: middle;
border-style: none;
}
 .pt-user-name {
    border-top: 1px solid rgba(0,0,0,0.1);
      font-weight: 500 !important;
    letter-spacing: 1px;
    line-height: 1.2;
   padding-top: 0.5rem;
    font-size: 1.23rem;
    text-transform: uppercase;
}
.el-tablo.centered {
    text-align: center;
    padding-left: 10px;
    padding-right: 10px;
}
.el-tablo.trend-in-corner {
    position: relative;
}
.el-tablo.smaller .label {
    font-size: .63rem;
    letter-spacing: 2px;
}a.el-tablo {
    text-decoration: none;
    display: block;
    color: #3E4B5B;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
} 
.trend-in-corner {
    border-radius: 6px;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(126,142,177,0.12);
}
.el-tablo .trending-down-basic {
    color: #e65252;
    padding: 0px;
}
.el-tablo .trending {
    padding: 3px 10px;
    border-radius: 30px;
    display: inline-block;
    font-size: .81rem;
    vertical-align: middle;
    margin-left: 10px;
}
.pt-2 .col-sm-2{ min-width:20%; }

.chart-legend li span {
    float: left;
    color: red !important;
    display: block;
    width: 12px;
    height: 12px;
    margin-right: 5px;    margin-top: 3px;
    list-style-type: none !important;
}#js-legend ul li, #js-legend2 ul li {
       width: auto !important;
    line-height: 1.5;
    margin-right:5px !important;
    float: left;
}
.n-p-t { padding-top:0px !important; }

.cnspnnn { display:block; text-align:center;   margin-top: 0.5rem;  
    letter-spacing: 1px;font-size:11px;
    line-height: 1.2;}
    .cls.green .value  , .cls.green .label{ color: green; }
    .cls.orange .value , .cls.orange .label{ color: orange; }
    .cls.blue .value, .cls.blue .label{ color: blue; }
    .cls.red .value , .cls.red .label{ color: red; }
    #chartwer2 { width:90% !important; }
   .chart-legend ul {
    margin-top: 20px !important;
    overflow: hidden;
}
@media only screen and (max-width: 600px) {
  .row.topSectount .col-sm-6 { width:50%; }
  .info_detaiscount { margin-right:-4%;}
  .row.seprated .col-sm-6 { width:50%; }
  .Profession .b-l { border:0px; }
  .religion,.graphs-r,.Caste .padded{ border:0px; }
  .religion-details .element-box { margin-left:0px;  margin-right:0px; }
  .religion-details .col-6  { padding-left:0px;  padding-right:0px;  margin-right:1%; 
	      -ms-flex: 0 0 49%;
    flex: 0 0 49%;
    max-width: 49%;
	  }
	    
.ads6	  {
    width: 100%;
    max-width: 100% !important;
    flex: inherit !important;
}
 .religion-details {
    margin-left: -12px;
    margin-right: -20px;
}
  .religion,.col-md-6 ,.Countries , .religion .col-sm-12 { padding:0px; }
  .topSectount-main { margin-bottom :30px; }
  img.fmbk2 {
    margin-left: 0px;
    float: right;
}
.el-tablo.trend-in-corner { margin-bottom:5px;}
.padded { padding-left:0px;  padding-right:0px; }
.profile-tile-box{ width:48%; }
}
.tot-c{
	display:inline-block;border:1px solid #eee;text-align:center;font-weight:bold;background:#fff;padding: 5px 10px;border-radius: 5px;left: 0;right: 0;position: absolute;width: 150px;margin: auto;top: -20px;
}
 
.tot-a .el-tablo .value{ color:var(--logo-color); }
.tot-today .el-tablo .value{ color:var(--secondary-color); }
.tot-thismonth .el-tablo .value{ color:#FC6645 ; }
.tot-a .tot-c{ border-color:tranasprent;color:var(--logo-color);}
.tot-today .tot-c{ border-color:tranasprent;color:var(--secondary-color);}
.tot-thismonth .tot-c{ border-color:tranasprent;color:#FC6645 ;}
.m-s-block { max-width:230px;margin:auto;}
.element-info-text h5{
    text-align: center;
    line-height: 30px;
    font-size: 20px;
    color: var(--logo-color);
}.element-info-text img { width:20px !important; margin-right:7px;vertical-align: text-bottom; }
.margin-bottom-50 {margin-bottom: 50px; }
</style>
<div class="containerb no-paddingb margin-bottom-50">
<div class="element-box">
   <div class="element-info hide">
      <div class="row align-items-center">
         <div class="col-sm-8">
            <div class="element-info-with-icon">
               <div class="element-info-icon">
                  <div class="os-icon os-icon-wallet-loaded"></div>
               </div>
               <div class="element-info-text">
                  <h5 class="element-inner-header hide">Sales Statistics</h5>
               </div>
            </div>
         </div>
        
      </div>
   </div>
   <?php $this->renderPartial('all_time_chart');?>
     <div class="row">
            <div class="col-sm-12 margin-bottom-30 margin-top-0">
             	
           
            </div>
            </div>   
   		 
	  <div  class="row">
       
		 <div class="clearfix"></div><hr />
			
      
      </div>

		
   <div class="row d-flex">
      <div class="col-sm-4 topSectount-main tot-a  flex1">
		  <div class="m-s-block">
         <div class="row topSectount">
            <div class="col-sm-12   b-b">
               <div class="el-tablo centered padded">
				 
                  <div class="value">
					    <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/eye.png');?>"> 
					   </div>
					  <?php echo (int) $total_page_count;?></div>
                  <div class="label"><?php echo $this->tag->getTag('page_views','Page Views');?></div>
               </div>
            </div>
         </div>
          
         <div class="clearfix"></div>
         <div style="position:relative"><span class="tot-c  "><?php echo $this->tag->getTag('all_time','All Time');?></span></div>
         <div class="clearfix"></div>
          <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value">
					   <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/phone.png');?>"> 
					   </div>
					  <?php echo (int) $total_call_count;?></div>
                  <div class="label"><?php echo $this->tag->getTag('calls','Calls');?></div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value">
					   <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/mail.png');?>"> 
					   </div>
					  <?php echo (int) $total_mail_count;?></div>
                  <div class="label"><?php echo $this->tag->getTag('mail','Mail');?></div>
               </div>
            </div>
       
                   
                 
                </div>
   
             <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value">
					   <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/whatsapp2.png');?>"> 
					   </div>
					  <?php echo (int) $total_whatsapp_count;?></div>
                  <div class="label">Whatsapp</div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value">
					   <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/bubble-chat_g.png');?>"> 
					   </div>
					  <?php echo (int) $total_text_count;?></div>
                  <div class="label">Text</div>
               </div>
            </div>
       
                   
                 
                </div>
 
    <div class="clearfix"></div>
     </div>
      </div>
 
	 <div class="col-sm-4 topSectount-main  tot-today  flex1">
         <div class="m-s-block">
         <div class="row topSectount">
            <div class="col-sm-12   b-b">
               <div class="el-tablo centered padded">
				 
                  <div class="value">
					    <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/eye-b.png');?>"> 
					   </div>
					  <?php echo (int) $total_page_count_today;?></div>
                  <div class="label"><?php echo $this->tag->getTag('page_views','Page Views');?></div>
               </div>
            </div>
         </div>
          
         <div class="clearfix"></div>
         <div style="position:relative"><span class="tot-c"><?php echo $this->tag->getTag('today','Today');?></span></div>
         <div class="clearfix"></div>
          <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				 
                  <div class="value">
					    <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/phone-b.png');?>"> 
					   </div>
					  <?php echo (int) $total_call_count_today;?></div>
                  <div class="label"><?php echo $this->tag->getTag('calls','Calls');?></div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				   
                  <div class="value">
					  <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/mail-b.png');?>"> 
					   </div>
					  <?php echo (int) $total_mail_count_today;?></div>
                  <div class="label"><?php echo $this->tag->getTag('mail','Mail');?></div>
               </div>
            </div>
       
                   
                 
                </div>
	
	    <div class="clearfix"></div>
          <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				 
                  <div class="value">
					    <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/whatsapp2.png');?>"> 
					   </div>
					  <?php echo (int) $total_whatsaoo_count_today;?></div>
                  <div class="label">Whatsapp</div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				   
                  <div class="value">
					  <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/bubble-chat_b.png');?>"> 
					   </div>
					  <?php echo (int) $total_text_count_today;?></div>
                  <div class="label">Text</div>
               </div>
            </div>
       
                   
                 
                </div>
	
		<div class="clearfix"></div>
		</div>
      </div>
 
  <div class="col-sm-4 col-xl-4 topSectount-main tot-thismonth flex1">
           <div class="m-s-block">
         <div class="row topSectount">
            <div class="col-sm-12   b-b">
               <div class="el-tablo centered padded">
				  
                  <div class="value">
					   <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/eye-o.png');?>"> 
					   </div>
					  <?php echo (int) $total_page_count_thirty;?></div>
                  <div class="label"><?php echo $this->tag->getTag('page_views','Page Views');?></div>
               </div>
            </div>
         </div>
          
         <div class="clearfix"></div>
         <div style="position:relative"><span class="tot-c"><?php echo $this->tag->getTag('last_30_days','Last 30 days');?></span></div>
         <div class="clearfix"></div>
          <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				   
                  <div class="value"><div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/phone-o.png');?>"> 
					   </div><?php echo (int) $thirty_call_count_today;?></div>
                  <div class="label"><?php echo $this->tag->getTag('calls','Calls');?></div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value"> <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/mail-o.png');?>"> 
					   </div><?php echo (int) $total_mail_count_thirty;?></div>
                  <div class="label"><?php echo $this->tag->getTag('mail','Mail');?></div>
               </div>
            </div>
       
                   
                 
                </div>
          <div class="clearfix"></div>
          <div class="row margin-top-30">
                         <div class="col-sm-6  ">
               <div class="el-tablo centered padded top-p">
				   
                  <div class="value"><div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/whatsapp2.png');?>"> 
					   </div><?php echo (int) $thirty_whatsap_count_today;?></div>
                  <div class="label">Whatsapp</div>
               </div>
            </div>
       
            <div class="col-sm-6">
               <div class="el-tablo centered padded top-p">
				  
                  <div class="value"> <div class="both_count">
					   <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/bubble-chat_r.png');?>"> 
					   </div><?php echo (int) $thirty_text_count_today;?></div>
                  <div class="label">Text</div>
               </div>
            </div>
       
                   
                 
                </div>
   
     <div class="clearfix"></div>
		</div>
      </div>
 
  </div>





 <style> 
.qwer .col-sm-2 , .qwer .col-sm-1 { padding-right:0px;}
</style>


 <div class="clearfix"></div>
 <style>
 .page-head-1 { font-weight:bold;font-size:16px;}
 .page-head-views { font-weight:bold;font-size:14px;}
 .page-head-views span{ color:blue;}
 .sml-popul {     padding: 10px;
  padding: 10px;
    width: auto;
    max-width: 300px;
    background: #fff;
    border: 1px solid #000;
    border-radius: 4px;
    position: absolute;
    z-index: 1;
    left: 22px;
    display: none;
    top: 35px;
    }
    .prece { position:absolute;right:5px;font-weight:600;}
    .opnebsl:hover  .sml-popul { display: block; }
 </style>
 

 
	  <div class="clearfix"></div>

</div> <div class="clearfix"></div>
</div>
 <div class="clearfix"></div>
       </div>
       
 