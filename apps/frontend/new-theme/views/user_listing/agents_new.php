<div id="map_locator">
	<?php   echo $this->renderPartial('_index_agent_ajax');	 ?> 
 
</div>
 
<Style>

html[dir="rtl"] .mul-li	{ padding: 0  0px 0 20px; }
html[dir="rtl"]  .mul-li li.user-li-list	{ margin: 20px  0px  0px 20px; }
									.mul-li	li.user-li-list {
    border: 1px solid #dedede;
    position: relative;
    background-color: #fff;
    width: calc(25% - 15.3px);float:left;
    margin: 20px 20px 0 0;
}
html[dir="rtl"] 	.mul-li	li.user-li-list {
     margin: 20px  0px  0px 20px;float:right;
}

html[dir="ltr"]  .mul-li	li.user-li-list:first-child {  margin-right:20px !important;; }
html[dir="rtl"]  .mul-li	li.user-li-list:first-child {  margin-left:20px !important;; }
html[dir="ltr"] .mul-li	li.user-li-list:nth-child(4n) { clear:right; margin-right:0px; }
html[dir="rtl"] .mul-li	li.user-li-list:nth-child(4n) { clear:left; margin-left:0px; }
@media only screen and (max-width: 720px){
	.mul-li	li.user-li-list{  width:100%; }
	.mul-li	li.user-li-list{  margin: 20px  0px 0 0 !important;; }
}
	.photose {
    display: inline-block;
    position: relative;
   
    width: 100%;
    height: 150px;
    padding: 10px 10px 0px 10px;
}		.ui-det{
	height: 160px;
display: inline-block;
width: 100%;
position: relative;
 
	} 	
	h1.p-head3{
		font-size: 16px;
line-height: 40px;
text-align: center;
white-space: nowrap;
text-overflow: ellipsis;
overflow: hidden;
padding: 0 25px;
font-weight:600;
}	
.propert-cnt {
	font-size: 13px;
clear: both;
padding:  5px 20px;
max-height: 55px;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
position: relative;
	}.call-btn-div-bot a { width:48%; padding:5px 0px;}
	.call-btn-div-bot {
	 
padding:  5px 20px;
 
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
position: relative;
	}
.propert-cnt span {
    font-weight: 700;
}.photose picture img {
    max-height: 130px;
    max-width: 75%;
}.photose picture {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}.call-btn-div-bot a {
    width: 48%;
    border: 0px !important;
    border-radius: 5px !important;
}.call-btn-div-bot {
 
    padding: 0px 5px !important;
}
.user-li-list-agent{position: absolute;top: 0;width: 100%;height: 100%;left:0;right:0;z-index: 1;}
.user-li-list-agent a{ width: 100%;height: 100%;display: block;}
.a-v-viewmore { display:none; color:var(--secondary-color) !important;margin-top:10px;font-weight:600;}
									.a-v-vieless { display:none;color:var(--secondary-color)  !important;margin-top:10px;font-weight:600;}
									.conjusted.detail-desc .a-v-viewmore { display:block;}
									.conjusted.detail-desc .a-v-vieless { display:none;}
									.conjusted  .a-v-viewmore { display:none;}
									.conjusted  .a-v-vieless { display:block;}
									.propertydescription_texttrim.detail-desc .txtcnt1.nnty {
						max-height: 116px;
						overflow: hidden;
					}
</Style>
