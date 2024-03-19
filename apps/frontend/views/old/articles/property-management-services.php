<section>
  <div id="headerNewplaceNew">
    <div  class="newsearch-main-div-2 cf shrink_control" style="top:48px;">
      <?php    $this->widget('frontend.components.web.widgets.searchHeader.searchHeaderWidget');?>
    </div>
  </div>
</section>
<div class="mainDiv">
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container margin-top-240">
  <div class="container_content">
    <div class="navigate_link"><span class="cmsCrumbar"><a href="<?php echo Yii::app()->apps->getBaseUrl('');?>">Home</a> <span>&gt; <?php echo  Countries::model()->getDefaultCountry();?> </span><span style="width:100%"> &gt;  Property Management Services</span></span></div>
    <div class="bottom_line_2 crmbrimg"> <span></span> <span></span> </div>
    <h1 class="crumbarHeadingCms"> <span class="bluecolor"> Property Management Services </span> </h1>
    <div class="unit_lowerer">
      <div class="overview-control-div">
        <div class="stagc-loc-txt"> <span class="stagc-loc-txt-span2">
          <div class="right_area uae2" id="right_area_div23">
            <div class="mainCrumbarDiv">
              <div class="clear"></div>
              <div class="text_RS">
                <div class="property-control-div">
                  <?php
							   $content = Article::model()->findByAttributes(array('slug'=>'property-management-services')); 
							   if(!empty($content)){  
								   echo $content->content;
							   } 
							  ?>
                  <h4 class="anchor_heading">
                    <p>In addition to our regular range of services, landlords can also benefit from our <a class="margenda-font anchorslide" href="#pms_div">Value Added Services</a> <br>
                      <br>
                      <br>
                    </p>
                  </h4>
                  <div class="pm-services">
                    <div class="pm-services-div"> <span class="pm-services-div-span-1">Services Offered</span>
                      <div class="div-span"><span class="pm-services-div-span-2">Leasing<br>
                        Only</span> </div>
                      <div class="div-span2"><span class="pm-services-div-span-3">Lease<br>
                        Management</span> </div>
                      <div class="div-span3"><span class="pm-services-div-span-4" style="width:100%">Property<br>
                        Management</span> </div>
                    </div>
                    <div class="div-1"><span class="div-1-span-1">Marketing</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Finding a tenant</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Drawing up the tenancy agreement</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Rent collection</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Arranging check-in of the tenant at the start of the tenancy</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Re-marketing and management of vacant property between tenacies</span> <span class="div-1-span-2"> <img width="9" height="9" style="margin: 10px 0px 0px; display: inline-block;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png"></span> <span class="div-1-span-3"> <img width="9" height="9" style="margin: 10px 0px 0px; display: inline-block;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png"></span> <span class="div-1-span-4"> <img width="9" height="9" style="margin: 10px 0px 0px; display: inline-block;" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Financing options with consultation</span> <span class="div-1-span-2"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Tenancy Contact registration with relevant authorities</span> <span class="div-1-span-2"></span><span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Banking post dated cheques</span> <span class="div-1-span-2"></span><span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Managing check-out process</span> <span class="div-1-span-2"></span><span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Dedicated property supervisor</span> <span class="div-1-span-2"></span><span class="div-1-span-3"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> <span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Arranging repairs and maintenance</span> <span class="div-1-span-2"></span><span class="div-1-span-3"></span><span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Managing tenant disputes</span> <span class="div-1-span-2"></span><span class="div-1-span-3"></span><span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-2"><span class="div-2-span-2">Quarterly reports</span> <span class="div-1-span-2"></span><span class="div-1-span-3"></span><span class="div-1-span-4"> <img width="9" height="9" src="<?php echo Yii::app()->theme->baseUrl;?>/images/tickmark.png" style="display: inline-block;"></span> </div>
                    <div class="color-div"></div>
                    <div class="div-1"><span class="div-1-span-1">Fee</span> <span class="div-1-span-2">Free</span> <span class="div-1-span-3">3% of the annual <br>
                      rent <br>
                      </span> <span class="div-1-span-4">5% of the annual <br>
                      rent <br>
                      </span> </div>
                    <div class="color-div"></div>
                  </div>
                </div>
                <!-- ------ this is Pm code----- -->
                <div class="clear"></div>
                <!-- ------ this is start of  Pm code----- -->
                <style>
                              /* pm services page change request (remove this code to check the changes ) LeasingOnly colum display hidden */
                              .pm-services-div .div-span {
                              display: none !important;
                              }
                              .pm-services .div-1-span-2 {
                              display: none !important;
                              }
                              .div-span2,
                              .div-span3 {
                              width: 22.05% !important;
                              background-color: transparent;
                              }
                              .div-span2 {
                              background-color: #677fab;
                              }
                              .div-1-span-3,
                              .div-1-span-4 {
                              width: 22.05% !important;
                              background-color: transparent;
                              }
                              .div-1-span-3 {
                              background-color: #ececf4;
                              }
                              .pm-services-div-span-4,
                              .pm-services-div-span-3 {
                              width: 100%;
                              }
                              /* pm services page change request*/
                              .div-2 .div-2-span-2 {
                              color: rgb(212, 0, 122);
                              }
                              .anchor_heading {
                              margin: 0 0 10px -7px;
                              color: #5D6061;
                              font-size: 12px;
                              padding: 1% 0 0 0;
                              float: left;
                              }
                              .anchor_heading a {
                              color: rgb(212, 0, 122);
                              }
                              hr.pms_hr {
                              width: 100%;
                              /*	*/
                              height: 1px;
                              border: 0;
                              border-top: 1px solid #ccc;
                              float: left;
                              margin: 4% 0 -6px 6px;
                              }
                              #pms_div {
                              margin: 2% 0 0 4px;
                              padding: 2% 0 0 0;
                              float: left;
                              }
                              #pms_div h1 {
                              background-color: #002b74;
                              padding: 2% 0 2% 1%;
                              color: white;
                              font-size: 27px;
                              }
                              #pms_div .color_margenda {
                              color: rgb(212, 0, 122) !important;
                              }
                              #pms_div address {
                              font-size: 13px;
                              font-style: normal;
                              padding-left: 5px;
                              margin-bottom: -3%;
                              padding-top: 3%;
                              padding-right: 2%;
                              }
                              #pms_div address .margenda-font {
                              color: rgb(212, 0, 122);
                              }
                              #pms_div address a {
                              text-decoration: underline;
                              }
                              #pms_div .anchor_heading {
                              margin: 0 0 10px -7px;
                              color: #5D6061;
                              font-size: 12px;
                              padding: 1% 0 3% 0;
                              }
                              #pms_div .anchor_heading a {
                              color: #d7007e;
                              }
                              /*----- acor dian ----*/
                              #pms_div .accordion {
                              margin: 0 auto;
                              font-size: 14px;
                              width: 100%;
                              background: #fff;
                              }
                              #pms_div.accordion ul {
                              list-style: none;
                              margin: 0;
                              padding: 0;
                              }
                              #pms_div.accordion li {
                              margin: 0;
                              padding: 0;
                              }
                              #pms_div .accordion [type=radio],
                              #pms_div .accordion [type=checkbox] {
                              display: none;
                              }
                              #pms_div .accordion label {
                              display: block;
                              font-size: 13px;
                              line-height: 16px;
                              color: 000000;
                              cursor: pointer;
                              border-bottom: 1px solid #f8b1da;
                              /*  background-image: url(http://www.bhomes.com/images/BhV3/icon1.png);    	background-repeat: no-repeat;    	    background-position: 85% 14px;*/
                              }
                              #pms_div .accordion ul li label:hover,
                              #pms_div .accordion [type=radio]:checked ~ label,
                              #pms_div .accordion [type=checkbox]:checked ~ label {
                              /*   background:#C02942;    color:#FFF;    text-shadow:1px 1px 1px rgba(0,0,0,0.5)*/
                              }
                              #pms_div .accordion p {
                              color: black;
                              margin: 0 0 2px;
                              }
                              #pms_div .accordion h3 {
                              color: #542437;
                              padding: 0;
                              margin: 10px 0;
                              }
                              /* Vertical */
                              #pms_div .vertical ul {
                              float: none;
                              }
                              #pms_div .vertical ul li {
                              overflow: hidden;
                              margin: 0 0 1px;
                              }
                              #pms_div .vertical ul li label {
                              padding: 10px;
                              padding-left: 5px;
                              color: #000952;
                              }
                              #pms_div .vertical [type=radio]:checked ~ label,
                              #pms_div .vertical [type=checkbox]:checked ~ label {
                              /*border-bottom:0;*/
                              /*background-image: url(http://www.bhomes.com/images/BhV3/icon2.png);*/
                              /*background-repeat: no-repeat;    	    background-position: 85% 10px;*/
                              -webkit-transition: all .5s ease-out;
                              -moz-transition: all .5s ease-out;
                              }
                              #pms_div .vertical ul li label:hover {} #pms_div .vertical ul li .content {
                              height: auto;
                              /*   border-top:0;*/
                              }
                              #pms_div .accordion .content {
                              padding: 0 4px 0 10px;
                              border-top: 1px solid pink;
                              overflow: hidden;
                              display: none;
                              border: 1px solid #fff;
                              /* Make the border match the background so it fades in nicely */
                              background-color: #ececf4;
                              }
                              /*#pms_div .vertical [type=radio]:checked ~ label ~ .content , #pms_div .vertical [type=checkbox]:checked ~ label ~ .content {    background-color: #ececf4;       border-top:1px solid pink;     padding-bottom:2%;    padding-top:2%;    max-height: 1000px;	-webkit-transition: all all .5s linear;   	 -webkit-transition: all .5s linear;    -moz-transition: all .5s linear;       visibility: visible; 		 opacity: 1;}*/
                              .pm_img {} .pm_img_down {
                              display: block;
                              float: right;
                              padding-bottom: 5px;
                              cursor: pointer;
                              }
                              #pms_div .vertical ul li label.cursor_normal {
                              cursor: auto;
                              }
                              /*media quires*/
                              @media (max-width: 1024px) and (min-width: 900px) {
                              .property-control-div .pm-services-div {
                              width: 99%;
                              }
                              .div-1-span-1 {
                              width: 44.6%;
                              }
                              .div-1-span-3,
                              .div-1-span-4 {
                              width: 27.3% !important;
                              }
                              .color-div {
                              width: 99% !important;
                              }
                              .div-2 {
                              width: 100%;
                              }
                              .div-2-span-2 {
                              width: 44.6%;
                              }
                              .div-1 {
                              width: 100%;
                              }
                              .anchor_heading {
                              margin: 0 2px 10px -7px;
                              }
                              }
                              @media (max-width: 1024px) and (min-width: 768px) {
                              .div-span2,
                              .div-span3 {
                              width: 27.09555% !important;
                              }
                              .anchor_heading {} .div-1-span-3,
                              .div-1-span-4 {
                              height: 37px;
                              }
                              #pms_div {
                              width: 92.5%;
                              }
                              }
                              @media (max-width: 790px) and (min-width: 768px) {
                              .text_RS p {
                              width: 81% !important;
                              }
                              .pm-services {
                              width: 101.4%;
                              }
                              #pms_div {
                              width: 99.5%;
                              }
                              }
                              @media (max-width: 767px) {
                              .div-1-span-4,
                              .div-1-span-3 {
                              width: 33.05% !important;
                              height: 58px;
                              }
                              .div-span3,
                              .div-1-span-4 {
                              float: right;
                              }
                              .div-span3,
                              .div-span2 {
                              width: 33.05555% !important;
                              }
                              #pms_div address {
                              padding-top: 8%;
                              }
                              .pm_img_down {
                              float: none;
                              }
                              #pms_div .accordion p {
                              padding-right: 5%;
                              }
                              .anchor_heading {
                              margin: 0;
                              width: 100%;
                              }
                              .div-1 .div-1-span-3 br,
                              .div-1 .div-1-span-4 br {} .text_RS {
                              width: 98% !important;
                              padding: 0;
                              }
                              .color-div {
                              width: 100%;
                              }
                              #pms_div {
                              margin: 2% 0 0 3px;
                              }
							  .pm-services-div-span-1{
								  font-size:15px;
								  margin:4px 0 0 4px;
								  text-align:center;
							  }
							  .pm-services-div-span-1,.div-1-span-1,.div-2-span-2{
								  width:37% !important;
							  }
							  .div-span2, .div-span3 ,.div-1-span-3,.div-1-span-4{
								  width:30% !important;
							  }
                              }
                              @media(min-width:480px) {
                              .text_RS {
                              }
                              #pms_div {
                              margin: 2% 0 0 6px;
                              }
							  .pm-services-div-span-1{
								  font-size:15px;
								  margin:4px 0 0 4px;
								  text-align:center;
							  }
							  .pm-services-div-span-1,.div-1-span-1,.div-2-span-2{
								  width:37% !important;
							  }
							  .div-span2, .div-span3 ,.div-1-span-3,.div-1-span-4{
								  width:30% !important;
							  }
                              }
                              .div-span2 {
                              background-color: #677fab !important;
                              }
                              .div-1-span-3 {
                              background-color: #ececf4 !important;
                              }
                              .div-1-span-3 {
                              color: #000952;
                              display: block;
                              float: left;
                              font-size: 9px;
                              height: 30px;
                              padding: 11px 0 0;
                              text-align: center;
                              width: 94px;
                              }
                              .pm-services div:nth-child(12) span {
                              height: 40px;
                              }
                              .pm-services div:nth-child(30) span {
                              height: 70px;
                              }
                              .property-control-div .pm-services-div{
                              width:100% !important;
                              }
                              .pm-services,.div-1,.div-2,.color-div{
                              width:100% !important;
                              }
                              .pm-services-div-span-1,.div-1-span-1,.div-2-span-2{
                              width:54% !important;
                              }
                              .div-span2, .div-span3 ,.div-1-span-3,.div-1-span-4{
                              width:20% !important;
                              }
							  @media(max-width:480px){
							  .pm-services-div-span-1{
								  font-size:15px !important;
								  margin:4px 0 0 4px !important;
								  text-align:center;
							  }
							  .pm-services-div-span-1,.div-1-span-1,.div-2-span-2{
								  width:37% !important;
							  }
							  .div-span2, .div-span3 ,.div-1-span-3,.div-1-span-4{
								  width:30% !important;
							  }
							  }
                           </style>
                <!--<hr class="pms_hr">-->
                <div id="pms_div">
                  <h1 alt="Value Added Services bhomes">Value Added Services</h1>
                  <div id="acor_div">
                    <div class="accordion vertical">
                      <ul>
                        <li>
                          <label class="color_margenda" for="checkbox-1">Pre-handover Inspection Report <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: none;"> </label>
                          <div class="content" >
                            <p>Carry out a detailed inspection of your property, identifying all visual defects and faults that need to be rectified by the developer. </p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                        <li>
                          <label for="checkbox-2">Check-in / Check-out Report <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: inline-block;"> </label>
                          <div class="content" style="">
                            <p>Carry out a property inspection when lease starts/ends in order to record the condition of the unit; and handover or collect elements such as keys and access cards between tenant/landlord.</p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                        <li>
                          <label class="color_margenda" for="checkbox-3">Title Deed Registration <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: inline-block;"> </label>
                          <div class="content" style="">
                            <p>Liaise with the developer and Dubai Land Department to obtain your property title deeds. </p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                        <li>
                          <label for="checkbox-4">New property handover and Key Collection <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: inline-block;"> </label>
                          <div class="content" style="">
                            <p>Complete the property handover process with the developer including collection of keys, access cards and documents.</p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                        <li>
                          <label class="color_margenda" for="checkbox-8">Legal Notice (Eviction &amp; Non-Rental Payment) <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: inline-block;"> </label>
                          <div class="content" style="">
                            <p>Arrange for notarized legal notice to be sent to tenants in accordance with the governing law.</p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                        <li>
                          <label for="checkbox-9">Rent Committee Cases <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_up_pm.png" class="pm_img" style="display: inline-block;"> </label>
                          <div class="content" style="">
                            <p>Register your case with the Dubai Rental Dispute Settlement Centre in the event of non-payment by tenant, absconding tenants or other disputes requiring legal attention.</p>
                            <img src="<?php echo Yii::app()->theme->baseUrl;?>/images/arrows_down_pm.png" class="pm_img_down" style=""> </div>
                        </li>
                      </ul>
                      <address>
                      For more information,   please call <span class="margenda-font"><?php echo  Yii::app()->options->get('system.common.contact_phone',' ');?> </span>
                      </address>
                    </div>
                  </div>
                </div>
                <script>
                              $('a.anchorslide').click(function() {
                                  $('html, body').animate({
                                      scrollTop: $($(this).attr('href')).offset().top - 195
                                  }, 1000);
                                  return false;
                              });
                              $("#pms_div .vertical ul li label").click(function() {
                                  if ($(this).next(".content").is(":visible")) {
                                      $(".content").slideUp("slow");
                                      $(this).next(".content").slideUp("slow");
                                      $(this).find("img").show("fast");
                                  } else {
                                      $("img").show("fast");
                                      $(".content").slideUp("slow");
                                      $(this).next(".content").slideDown("slow");
                                      $(this).find("img").hide("fast");
                                  }
                                  $(".pm_img_down").click(function() {
                                      $(this).parent(".content").slideUp("slow");
                                      $("#pms_div img.pm_img").show("fast");
                                  });
                              });
                           </script> 
                <!-- ------ this is pm code----- --> 
              </div>
            </div>
            <div class="clear"></div>
          </div>
          </span> </div>
      </div>
    </div>
    <!-- End Content -->
    <div style="clear:both;"></div>
  </div>
  <br />
  <br />
</div>
<style>
   .stagc-loc-txt-span2   li {
   float: left;
   margin-right: 20px;
   list-style:disc;
   width: 100%;
   margin-left:10px;
   line-height:25px;
   }
   .stagc-loc-txt-span2   li a {
   color:#002d72;
   }
   .cmsCrumbar {
   font-size: 11px;
   width: 640px;
   }
   .navigate_link a {
   color: #002c72;
   text-decoration: none;
   }
   .crmbrimg {
   float: none;
   }
   .bottom_line_2 {
   float: left;
   height: 5px;
   margin-left: 0;
   width: 100%;
   }
   .bottom_line_2 span {
   background-color: #d4117e;
   display: block;
   float: left;
   height: 5px;
   width: 3%;
   }
   .navigate_link {
   font-size: 11px;
   height: auto;
   margin: 0 0 10px;
   width: 100%+;
   }
   .bottom_line_2 span + span {
   background-color: #842a8b;
   display: block;
   float: right;
   height: 5px;
   margin-left: 3px;
   width: 96%;
   }
   .container_content{
   height: auto;
   margin: 10px 10px 10px 14px;
   }
   .crumbarHeadingCms {
   color: #d7007e !important;
   display: block !important;
   float: left !important;
   font-size: 32px !important;
   font-weight: normal !important;
   margin-left: -2px;
   width: 100% !important;
   }
   .crumbarHeadingCms {
   color: #002c72;
   float: left;
   font-size: 12px;
   font-weight: bold;
   margin: 15px 0 0;
   }
   .property-control-div{
   width:100% !important;
   margin-left:0px !important;
   }
   .text_RS{
   width:100% !important;
   }
   .pm-services {
   float: left;
   height: auto;
   margin-left: -7px;
   width: 650px;
   }
   .pm-services-div {
   background-color: #842a8b !important;
   color: #fff;
   height: 47px;
   width: 640px;
   }
   .pm-services-div-span-1 {
   display: block;
   float: left;
   font-size: 22px;
   margin: 13px 0 0 4px;
   width: 353px;
   }
   .pm-services-div .div-span {
   display: none !important;
   }
   .div-span2 {
   background-color: #677fab;
   }
   .div-span2, .div-span3 {
   background-color: transparent;
   width: 20% !important;
   }
   .div-span2 {
   display: block;
   float: left;
   height: 47px;
   width: 94px;
   }
   .pm-services-div-span-4, .pm-services-div-span-3 {
   width: 100%   !important
   }
   .pm-services-div-span-3 {
   color: white;
   display: block;
   float: left;
   font-size: 14px;
   margin: 6px 0 0;
   text-align: center;
   width: 94px;
   }
   .pm-services-div-span-4, .pm-services-div-span-3 {
   width:100% !important
   }
   .pm-services-div-span-3 {
   color: white;
   display: block;
   float: left;
   font-size: 14px;
   margin: 6px 0 0;
   text-align: center;
   width: 94px;
   }
   .pm-services-div-span-4, .pm-services-div-span-3 {
   width:  100% !important
   }
   .pm-services-div-span-4 {
   color: white;
   display: block;
   float: left;
   font-size: 14px;
   margin: 6px 0 0;
   text-align: center;
   width: 100%;
   }
   #pms_div {
   float: left;
   margin:0px !important;
   padding:0px !important;
   width: 100%;
   }
   #pms_div h1 {
   background-color: #842a8b !important;
   color: white;
   font-size: 27px;
   padding: 2% 0 2% 1%;
   }
   #pms_div .accordion {
   background: #fff none repeat scroll 0 0;
   font-size: 14px;
   margin: 0 auto;
   width: 100%;
   }
   #pms_div address {
   font-size: 13px;
   font-style: normal;
   margin-bottom: -3%;
   padding-left: 5px;
   padding-right: 2%;
   padding-top: 3%;
   }
   #pms_div .vertical ul li {
   margin: 0 0 1px;
   overflow: hidden;
   }
   #pms_div .vertical ul li label {
   color: #000952;
   padding: 10px 10px 10px 5px;
   }
   #pms_div li {
   border-bottom: 1px solid #f8b1da;
   cursor: pointer;
   display: block;
   font-size: 13px;
   line-height: 16px;
   }
   #pms_div .color_margenda {
   color: rgb(212, 0, 122) !important;
   }
   #pms_div .vertical ul li .content {
   height: auto;
   }
   #pms_div .accordion .content {
   background-color: #ececf4;
   border: 1px solid #fff;
   display: none;
   overflow: hidden;
   padding: 0 4px 0 10px;
   }
   #pms_div .accordion p {
   color: black;
   margin: 0 0 2px;
   }
   .property-control-div{
   }
  @media(max-width:767px){
  .pm-services-div-span-1{
	  font-size:15px !important;
	  margin:4px 0 0 4px !important;
	  text-align:center;
  }
  .pm-services-div-span-1,.div-1-span-1,.div-2-span-2{
	  width:37% !important;
  }
  .div-span2, .div-span3 ,.div-1-span-3,.div-1-span-4{
	  width:30% !important;
  }
  .pm-services div:nth-child(12) span{
	  height:auto;
  }
  .div-1-span-3{
	  background-color:transparent !important;
  }
  .bottom_line_2 span + span{
	  width:95%;
  }
  }
</style>
<script>		$('a.anchorslide').click(function () { $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top - 195 }, 1000); return false; }); $("#pms_div .vertical ul li label").click(function () { if ($(this).next(".content").is(":visible")) { alert($(this).next(".content").attr());$(".content").slideUp("slow"); $(this).next(".content").slideUp("slow"); $(this).find("img").show("fast"); } else { alert(2); $("img").show("fast"); $(".content").slideUp("slow"); $(this).next(".content").slideDown("slow"); $(this).find("img").hide("fast"); } $(".pm_img_down").click(function () { $(this).parent(".content").slideUp("slow"); $("#pms_div img.pm_img").show("fast"); }); });</script> 
