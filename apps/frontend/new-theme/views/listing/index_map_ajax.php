
<div id="map_locatorww">
<?php 
$links_open_in  = $this->options->get('system.common.link_open_in','S');	
  $this->renderPartial('_arab_avenue_filter');;?>
<?php 
if(empty($adsCount)){
 
	$this->renderPartial('_no_result_page'); 
}
else{ ?> 
<style>
	.maker_adjust {
    margin-left: -0px;
    margin-right: -0px;
}
.searrchli { border-bottom:0px !important;}#sechbr {  padding: 0px 10px; }
		 html body#listing  #d_column.list .slick-next, html body#listing  #d_column.list .slick-prev{ transform: none;-webkit-transform: none;-ms-transform:none;  }
 html[dir="ltr"]  body#listing  #d_column.list .lst-prop .arws .slick-next {    right: 6px !important; }
 html[dir="ltr"]  body#listing  #d_column.list .lst-prop .arws .slick-prev {    left: 6px !important; }
  html[dir="rtl"]  body#listing  #d_column.list .lst-prop .arws .slick-next {    left: 6px !important; }
 html[dir="rtl"]  body#listing  #d_column.list .lst-prop .arws .slick-prev {    right: 6px !important; }
 .cluster img {    display: block;}#map-load .gm-style {    height: 100% !important;}
  @media only screen and (min-width: 768px) {
     .
		#resultsColumn .maker_adjust { margin-left:0px ; margin-right:0px; }
		#resultsColumn  #d-column { margin-left:-15px ; margin-right:-15px; }


#listing .columns {
    flex: 1;
    display: flex;
    margin-top: 0;
    width: 99% !important;
 overflow-y: scroll;
    height: calc(100vh - 165px);
    padding: 0px  ;
    margin: 15px;
        margin-top: 15px;
}.new-multiple { 
    position: relative;
}
#listing .columns #leftColumn {
    height: 100%;
    overflow-y: initial;
    width: 50% !important;
padding-right: 20px!important;
padding-left: 0px!important;
}html .gm-style-iw-d {
    height: auto;
    width: 100% !important;
    padding: 0px !important;
    min-width: 100% !important;
}
.listInline>li { 
    min-width: 40px;white-space:nowrap; 
}.gm-style .gm-style-iw-d {
    overflow: hidden !important;
}
html .gm-style-iw {
    width: 100%!important; 
}
html .gm-style-iw {
    width: 200px!important;
    max-width: 100% !important;
    padding: 10px !important;
}
#map-load{
	width: calc(50% - 16px);
position: fixed !important;
right: 0px;
bottom: 0px;
top: 176px;
 
margin: 0px 16px 16px 0px;
border-radius: 8px;
touch-action: manipulation;
transform: translate3d(0px, 0px, 0px);
mask-image: -webkit-radial-gradient(white, black);
margin: 0 16px 16px 0px !important;
overflow: hidden;
	}button.gm-fullscreen-control {
  display: none;
}
html[dir="rtl"] #map-load{left: 0px;right: unset; margin: 00px 16px 16px !important; } 
html[dir="rtl"] #listing .columns #leftColumn {
    
    padding-left: 20px !important;
    padding-right: 0px !important;

}
	</style>
		<style>
	  @media only screen and (max-width: 768px) {.list-36view { display:none; }
	      #leftColumn { padding-bottom:  0px !important; } 
	   #listing .headertit.inside-h{ margin-top:0px !important; }
  .columns #map-load { order : 1;flex: unset !important;  }
   .columns #leftColumn { order : 2; flex: unset !important; }
   #listing .columns { flex-direction: column; }footer{ display:none; }
  .columns #map-load { height : calc(100vh - 330px  ) !important; }
 .columns #leftColumn #d_column{ 
    display: flex;
    flex-direction: row;overflow-y: scroll;
}#map-load .gm-style { 
    height: 100% !important;
}
#listing .columns #leftColumn .company_image_li { display:none;}
#listing .columns #leftColumn {
    width: 100% !important;
    
    min-width: 100% !important;
    padding-bottom: 0px !important;
    margin: 0px !important;
    padding-left: 0px !important;
    padding-right: 0px !important;padding-top: 10px;
}html #resultsColumn #d_column.container.list .arws { position:absolute;}
html #resultsColumn #d_column.container.list .arws, html #resultsColumn #d_column.container.list .listing-item {
    width: 40% !important;
  
    float: left;
}#resultsColumn .list .wrapper { display:initial;}#d_column.container.list .col-sm-4.lst-prop{ display:flex; margin-right: 10px;max-width:80%; width:80%; }
html #resultsColumn #d_column.container.list .smartad_footer {
  position: absolute !important;
bottom: 0px !important;
right: 0px !important;
width: 98px;
padding: 0px !important;
}
 
#resultsColumn.maker_adjust {
    margin-left: 0px;
    margin-right: 0px;
}  
html #listing .columns #leftColumn {

    width: 100% !important;

}html #d_column.container.list .wrapper {
    width: calc(100% - 120px) !important;
    padding-bottom: 0px !important;
    padding-top: 0px !important;
}#d_column.container.list .col-sm-4.lst-prop { 
    max-width: 80%;
    width: 300px !important;
}#d_column  {
    overflow-x: scroll !important;
   
}#d_column.container.list .arws .slick-next, #d_column.container.list .arws .slick-prev {
    top: 33px !important;
}
 .maker_adjust { display:flex; margin:0px !important; }
 html #listing .columns #leftColumn .loadingDiv{min-width: 50px;line-height: 50px;background: #fafafa;height: 50px;top: 26px;position: relative;}

  html #listing .columns #leftColumn .loadingDiv span { display:none; }
 html #listing .columns #leftColumn ._jmmm34f.for-mb {
    display: block;
}
html[dir="rtl"] #resultsColumn #d_column.container.list .smartad_footer { left:0px; right:unset !important;}
html[dir="rtl"] .fa-arrow-right:before {
    content: "\f060" !important;
}
body{ overflow:hidden;}
#mainColumn { height:calc(100vh - 150px) !important;overflow:hidden;margin-bottom: 60px;;}
html body#listing #mainColumn.columns #map-load {
    height: calc(100% - 230px) !important;
}
}
 footer {display:none; } #post-detal { display:none;}
@media only screen and (max-width: 768px){
.maker_adjust {
    display: none;
}#mainColumn {
    height: calc(100vh - 150px) !important;
    overflow: hidden;
    margin-bottom: 60px !important;
}html #listing .columns #leftColumn{ order:1 !important;     height: auto !important;}html #listing .columns .mapColumn{ order:2!important; }
html body#listing #mainColumn.columns #map-load {
    height: 100% !important;
}
  footer {display:block;  }     #post-detal { display:flex;}
  #post-detal{ position:fixed;bottom:0px;width:100%;z-index:11111;background: #fff;display: flex;max-width:100%;cursor:pointer;    left: 0;
    right: 0;}
   #post-detal .cardDetails.typeWeightNormal{ padding:0px 10px; }
 #post-detal .cardPhoto { min-width:80px;max-width:80px;}
 .active-view  #post-detal { display:none;}
  #post-detal .list-inline-item svg{ width:20px;height:20px;}
   #post-detal .cardDetails a  .cardPrice {color:var(--secondary-color);}
}

	</style>
  <div class="columns restuls-list  margin-top-5"  id="mainColumn" >
                <div id="leftColumn" class="leftColumn"  >
					 <?php $this->renderPartial('_left_column');  ?> 
                    </div>
                    <!-- react-empty: 1 -->
              
           
            <?php  
            
            $this->renderPartial('_map_view');
		}
               ?>
            
            <div style="clear:both"></div>
              </div>
</div>
<style>

#mainColumn {
 
    margin-bottom: 0px;
}
#mainContainerClass { min-height:300px; }
</style>
<script>
    var scHeight;var scWidth;
    $(function(){
        
        scHeight = screen.height;var heights = scHeight-61;heights = 'height:'+ heights+'px !important';
        scWidth = screen.width;
        if(scWidth<720){
   $('#mainColumn').attr("style", heights);  $('#mainColumn').attr("height", heights);  
        
        }
         
        
        
    })
    
    
</script>
       	<script type="text/javascript">
 
 
 
	$(document).ready(function () {
	    
	     const observer = lozad(); // lazy loads elements with default selector as '.lozad'
 observer.observe(); 
	})
	
	</script> 
 