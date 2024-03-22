<div id="<?php echo $this->id;?>">
    <style>
    #mainContainerClass { 
    max-width: unset !important;
}.hnSTQE:hover:not(:disabled) {
    background-color: #D2E0E8; 
}
.popular-regin li:hover, .popular-regin li.active {
    background-color: #D2E0E8 !important;
    
} .sectionFilter.button_open .hnSTQE {
     border-color:#D2E0E8!important;
     
}
.projects .hidden-info .btn-details { 
    display: flex;
    align-items: center;
}
 
@media only screen and (max-width: 600px) {
#d_column.container  .litsect {
  
    padding: 0px;
    margin-top: 15px !important;
}#business_listing .feat_property .details .tc_content h2 {
    font-size: 15px !important;
    line-height: 2;
}
.mcheckboxSorter { position:unset !important; }
}
</style>
 
<?php
if (Yii::app()->request->isAjaxRequest) {
	?> 
	<script>$('body').attr("id","business_listing");$('#hmmenu').find('li').removeClass('active');
	switch('<?php echo $this->sec_id  ;?>') {
		case '<?php echo SALE_SLUG ;?>':
		$('#hl_buy').addClass('active');
		break;
		case '<?php echo RENT_SLUG ;?>':
		$('#hl_rent').addClass('active');
		break;
		case '<?php echo BUSINESS_SLUG ;?>':
		$('#hl_business').addClass('active');
		break;
		case 'new-development':
		$('#hl_development').addClass('active');
		break;
	 } 
	 </script>
	<title><?php  echo  $pageTitle ;  ?></title>
	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
	<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">

	<?php 
}
 
       $this->renderPartial('_arab_avenue_filter_business');
 
?>
 <style>.style2 h1 { font-size:28px;margin-bottom: 0 !important; }
              .feat_property .details .tc_content h2{color:#555;font-weight:600}.feat_property .details .tc_content h2{font-size:14px;font-family:var(--main-font);color:#333;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:7px}
                @media only screen and (max-width: 600px) { .style2 h1 { font-size:20px; } }
            </style>
<div class="container margin-top-40 list-container-rx style2" id="">

<h1><?php 
	echo $m_title;
		if(!empty($userM)){
			echo ' <small class="user-nameing secname_'.$filterModel->section_id.'"><b>['.$userM->fullName.']</b></small> <a href="'.$this->app->createUrl('listing/index',array('sec'=>$filterModel->section_id)).'"><img src="'.$this->app->apps->getBaseUrl('assets/img/cancel.png').'" style="width:15px; "/></a>';
	}
	?>
	</h1>
<?php 

if(empty($adsCount)){
	$this->renderPartial('_no_result_page',array('full_width'=>true)); 
	 
}
else{ ?>
			<div class="">
            <div class="">
                <div class="col-sm-12 padding-left-0">
                    <span class="ak_text margin-left-0" id="loader_againn">
                               
                    </span>
                </div>
            </div>
            
            
            <div class="row">
				<div class="col-md-8 col-lg-8 margin-top-0" style="margin-bottom: 20px;">
					<div class="breadcrumb_content ">
					  
						
						<div class="left_area tac-xsd">
									<p><?php echo Yii::t('app',$this->tag->getTag('{n}_results_found.','{n} results found.'),array('{n}'=>$adsCount)) ;?></p>
								</div>
					</div>
			
				</div>
				  
				
			</div>
			<style>
			    .spnhjbodr .row {
    margin-left: -15px;
    margin-right: -15px;
}  .left_area p {
    margin-bottom: 0;
    margin-top: 20px;
    color: #fc7d00;
}.spnhjbodr {
    border-bottom: 1px solid rgb(235, 235, 235);
    margin-bottom: 15px;
}.prop_detailss{ line-height:1;    font-size: 15px; }
 .grid .list-items 
 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
} .grid .list-items .feat_property {
  
    flex-direction: column;
} .grid .list-items .feat_property.list .thumb ,.grid .list-items .feat_property.list .details {
    width: 100%; 
}.litsect .maker_adjust {
    margin-left: -15px;
    margin-right: -15px;
}
			</style>
			  <style>
                #populating_data img {
 
    text-align: center;
    margin: auto;
}
                      #populating_data { display:none;  }
                      
  #populating_data.ld{ padding:5px;min-height:70px;background:#fff; display:block;  text-align: center;line-height: 70px;    vertical-align: middle; }
  #populating_data.ld img { max-width:50px; }
  #populating_data.loaded img { display:none; }
  #populating_data.loaded   { display:block;      ;} 
                </style> 
                <div class="clearfix"></div>
		 	  <div class="  sh-mobile  padding-right-0 the-head-sorter text-right mcheckboxSorter pull-right">
					   <div  style="display:flex;" class="a_<?php echo $l_view;?>">
					    <?php
					    if($l_view=='map'){ ?> 
							    <a href="javascript:void(0)"    onclick="changeViewN4(this)" data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="list"   class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"  data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="grid" onclick="changeViewN4(this)"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                            <a data-val="map"   class="newheader_dropdown_action_item header_link listh viewersp active" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
                    
                     
				      
						<?php }
						else { ?> 
				        <a href="javascript:void(0)"    onclick="changeViewN2(this)" data-val="list"  class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"   onclick="changeViewN2(this)" data-val="grid"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                        
                     	        <a data-val="map" onclick="changeViewN2(this)" data-href="<?php echo   Yii::app()->createUrl('business_listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" class="newheader_dropdown_action_item header_link listh viewersp" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
           
				        <?php } ?> 
                       
                        
				       </div>
				       <script>var list_view_url =  '<?php echo Yii::app()->createUrl('site/setview_list');?>';</script>
				        
			 </div>
           <div class="clearfix"></div>
		
			<?php
if($formData['sec'] != 'new-development'){ ?>
            <div class="row">
                  <div class="">
                <div class="col-lg-12">
                <div class="additional_details spnhjbodr">
								<div class="row"  id="populating_data">
                                        <img src="<?php echo $this->app->apps->getBaseUrl('assets/img/rolling2.gif');?>">
                                        <div id="content-populate"></div>
                                        <div class="clearfix"></div>
								</div>
							</div>
                </div>
                </div>
                
                
                
            </div>
            
            <?php } ?> 
            
            
            
            <div class="row">
             		
            </div>
            </div>
        </div>
		<div class="clearfix"></div>
		<div class="clearfix container grdV">
		    	<style>
				.list-group.dvp .col-sm-3 { width:33.333333333333333%;   }
				.list-group.dvp .col-sm-3 .listing-item {   height:241px; }
				.list-group.dvp .col-sm-3 .dots {    top: 190px; } 
				</style>
			 
			<?php 
		$title1 = '';
		if(!empty($categoryModelm)){
			$title1 =  $categoryModelm->category_name;
		}
		else{
			$title1 = 'Properties';
		}
		switch($filterModel->section_id){
		    /*
			
			case 'property-for-sale':
			$title1.= ' for sale';
			$this->renderPartial('_featured_listing',array('total_slide_show'=>$filterModel->section_id=='development' ? '2':'3','w'=>'363','_sec_id'=>$filterModel->section_id,'title1'=>$title1)); 		
			break;
			case 'property-for-rent':
			$title1.= ' for rent';			
			$this->renderPartial('_featured_listing',array('total_slide_show'=>$filterModel->section_id=='development' ? '2':'3','w'=>'363','_sec_id'=>$filterModel->section_id,'title1'=>$title1)); 
			break;
			case 'development':
			$title1 = 'New Developments';
			$this->renderPartial('_featured_listing',array('total_slide_show'=>$filterModel->section_id=='development' ? '2':'3','w'=>'363','_sec_id'=>$filterModel->section_id,'title1'=>$title1)); 
			break;
			default:
			 $title2  = $title1.' for sale';
			 $title3  = $title1.' for rent';
			 $title1  = $title2;
			 $this->renderPartial('_featured_listing',array('total_slide_show'=>'3','w'=>'363','_sec_id'=>'property-for-sale','title1'=>$title1)); 
			 $title1  = $title3;
			 $this->renderPartial('_featured_listing_2',array('total_slide_show'=>'3','w'=>'363','_sec_id'=>'property-for-rent','title1'=>$title1)); 		
			break;
			*/
		}
		 ?>	
	 
		</div>
		<style>
	.g-view-banner  { display: none; }
	.grid .g-view-banner { display: block;}
#listing .maker_adjust.projects.filterModel_new-development {
    margin-left: 6px;
    margin-right: -8px;
}
		</style>
		<div class="clearfix"></div>
                
		       <div class="container   <?php echo  $l_view  ;?>" id="d_column" style="margin-bottom: 40px !important;">
		           <?php  if(!empty($b_1)){ echo '<div class="margin-top-10 margin-bottom-10 g-view-banner" >'. $b_1.'<div class="clearfix"></div></div>';; } ?>
		       <div class="row not-for-development">
				   <div class="col-sm-9  margin-top-10 margin-bottom-0 litsect wqeq_<?php echo $filterModel->section_id;?>">
				       
				 <div class="maker_adjust <?php echo $filterModel->section_id == 'new-development' ? 'projects' : '';?> filterModel_<?php echo $filterModel->section_id;?>" > 
					 <?php 
				if(!empty($ads)){
$works = $ads;
			 
					$this->renderPartial('_list_proprty_business',compact('ads' ,'works' ));
				 
				echo '<div id="suggest_friends_last_id"></div><div class="clearfix"></div>	';
				if(sizeOf($ads) >= $limit){
				// echo '<p class="text-center loadingDiv"><a href="javascript:void(0)" onclick="checkScroll();" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right">'.  'Load More' .'</a></p>';
				}
				?>
				  <div class=" ">
              <div class="" style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                  	<nav class="navigation pagination d-flex justify-content-end margin-top-0 margin-bottom-0" role="navigation">
							<ul class="actions li-css-n m-0 margin-top-0 margin-bottom-0">
                            <?php
                            $this->widget('frontend.components.web.widgets.SimplaPager4', array(
                            'pages'=>$pages,	 'maxButtonCount'=>3,));  
                            ?>
		</ul>
	
                 </nav>
                 <div>
                <ul class="pagination   <?php echo $pages->pageCount>1 ? 'd-block' : 'hide';?>  " data-pagination-param="page" data-current-page="<?php echo $pages->currentPage+1;?>" data-total-pages="<?php echo $pages->pageCount;?>">
                <li class="d-block text-center">Viewing Page <?php echo $pages->currentPage+1;?> of <strong><?php echo $pages->pageCount;?></strong></li>
                </ul>
                 
                 </div>
               </div>
            </div>
          
				<?php
				}
				else{
				echo $this->renderPartial('empty_results');
				}
			?><div class="clearfix"></div>
				</div>
	<div class="clearfix"></div>
 </div> 
 					<div class="onlylist margin-top-10 "> 
 					<div class=" ">
				 
 					 <?php  if(!empty($b_2)){ echo '<div class="margin-bottom-15" >'. $b_2.'<div class="clearfix"></div></div>';; } ?>
                    <?php  if(!empty($b_3)){ echo '<div class="margin-bottom-15" >'. $b_3.'<div class="clearfix"></div></div>';; } ?>
 					</div>
 
 </div>
  
<div class="clearfix"></div>
        <style>
    
    a.current.pvl.phm{background:var(--logo-color);color:#fff;border:1px solid var(--logo-color)}.actions.li-css-n{width:100%;clear:both;margin:20px 0;text-align:center}#business_listing .pagination .actions.li-css-n li{display:inline-block;width:auto;margin-right:10px;margin-bottom:10px;min-width:42px}#business_listing .pagination .actions.li-css-n a{width:100%;height:100%;margin:0!important}#business_listing .pagination .actions.li-css-n a{font-size:14px;line-height:14px}#business_listing .pagination .actions.li-css-n a.current{background:var(--logo-color);color:#fff}#business_listing .pagination .actions.li-css-n a{border-radius:5px!important;border:1px solid #eee;padding:10px;display:inline-block;margin-bottom:15px!important}#business_listing .pagination .actions.li-css-n a:hover:not(:disabled){background-color:#cdebd5;color:var(--logo-color)}#business_listing .actions.li-css-n span.spl-inrt{margin-right:2px;margin-left:2px}#business_listing .actions.li-css-n span{display:inline-block}.pagination a,.pagination span{align-items:center;display:inline-flex}
        @media only screen and (max-width:600px){html #listing #d_column.container.list .smartad_footer{bottom:8px!important;width:60%!important;position:unset!important}html #listing #d_column.container.list .company_image_li{right:0;bottom:5px;left:unset!important}html #listing .footerbtns.smallnomarl .mbtn-div a.button_call-property{background:var(--secondary-color)!important;color:#fff!important}html #listing .footerbtns.smallnomarl .mbtn-div a.tooltipm{background:var(--secondary-color)!important;color:#fff!important}html #listing .footerbtns.smallnomarl .mbtn-div a.tooltipm .text-not-mob,html .footerbtns.smallnomarl .mbtn-div a.button_call-property .text-not-mob{font-size:13px;display:initial}html #listing .list .footerbtns.smallnomarl .mbtn-div a.tooltipm i,html .list .footerbtns.smallnomarl .mbtn-div a.button_call-property i,html .list .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap i{color:#fff!important}html #listing .list .footerbtns.smallnomarl .mbtn-div a{padding:4px 6px!important}html #listing .list .footerbtns.smallnomarl .mbtn-div a.favbtn{position:absolute;right:0;top:-75px;z-index:111111111}html #listing .list .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap{display:initial!important;color:#fff;background:#29d247!important;color:#fff!important;display:block!important}html #listing .list .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap,html .footerbtns.smallnomarl .mbtn-div a.button_call-property,html .footerbtns.smallnomarl .mbtn-div a.tooltipm{min-width:25%!important}html #listing #d_column.container.grid .smartad_footer{bottom:8px!important;width:60%!important;position:unset!important}html #listing #d_column.container.grid .company_image_li{right:15px;position:absolute;bottom:5px;left:unset!important}html #listing .footerbtns.smallnomarl .mbtn-div a.button_call-property{background:var(--secondary-color)!important;color:#fff!important}html #listing .footerbtns.smallnomarl .mbtn-div a.tooltipm{background:var(--secondary-color)!important;color:#fff!important}html #listing .footerbtns.smallnomarl .mbtn-div a.tooltipm .text-not-mob,html .footerbtns.smallnomarl .mbtn-div a.button_call-property .text-not-mob{font-size:13px;display:initial}html #listing .grid .footerbtns.smallnomarl .mbtn-div a.tooltipm i,html .grid .footerbtns.smallnomarl .mbtn-div a.button_call-property i,html .grid .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap i{color:#fff!important}html #listing .grid .footerbtns.smallnomarl .mbtn-div a{padding:8px 6px!important}html #listing .grid .footerbtns.smallnomarl .mbtn-div a.favbtn{position:absolute;right:0;top:-84px;z-index:111111111}html #listing .grid .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap{display:initial!important;color:#fff;background:#29d247!important;color:#fff!important;display:block!important}html #listing .grid .footerbtns.smallnomarl .mbtn-div a.fshare-whatsap,html .footerbtns.smallnomarl .mbtn-div a.button_call-property,html .footerbtns.smallnomarl .mbtn-div a.tooltipm{min-width:31.333%!important}html #listing #d_column.container.grid .smartad_footer{bottom:8px!important;width:60%!important;position:unset!important;left:unset!important;right:unset!important;top:unset!important;bottom:unset!important;min-width:100%;padding:10px;background:#fafafa;display:flex;align-items:center;justify-content:center}html[dir=rtl] #listing .grid .footerbtns.smallnomarl .mbtn-div a.favbtn{left:0;right:unset}html[dir=rtl] #listing #d_column.container.grid .company_image_li{right:unset;left:15px!important}html[dir=rtl] #listing .list .footerbtns.smallnomarl .mbtn-div a.favbtn{left:0;right:unset}html[dir=rtl] #listing #d_column.container.list .company_image_li{right:unset;left:0!important}}
        #listing .pagination .actions.li-css-n a {  margin-bottom: 0px!important; }
         @media only screen and (min-width: 992px) {
             body.scrol-acive .topbar{visibility:hidden;   margin-bottom:139px; }
        body .header,body  #frmId   { }
        body  .header{  background: #fff; }
        body.scrol-acive .header{  background: #fff; }
        body.scrol-acive .header {
        position: fixed;
        top:0px;
        width: 100%;
        background: #fff;
        z-index:1111111 !important;
        } body.scrol-acive #frmId {
        position: fixed !important;top:75px;  width: 100%; z-index:1111111 !important;} 
        }
        </style>

<script>
var timer_ajax; 
var mainListUrl = '<?php echo Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>/';
var autoCompleteUrl = '<?php echo Yii::app()->createUrl('listing/autocomplete');?>';
// $(function(){ changeForm() ;   })
function activatelistSearchFixed2(){
    $(document).scroll(function(){
        $(document).scrollTop()>35?$("body").addClass("scrol-acive"):$("body").removeClass("scrol-acive");
        
    })
    
}
 $(function(){ closeOpendDiv() ; activatelistSearchFixed2()  })
</script> 
<?php $str = http_build_query(array_filter(array_replace(array('state_id2'=>$state_id),$_GET))) ; ; ?> 
	<script type="text/javascript">
	var stopPagination;
	var loadingHtml    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div><div class="clearfix"></div><div style="    clear: both;    margin-top: 30px;    font-weight: 600;"><?php echo $this->tag->getTag('loading_more_properties,_pleas','Loading more properties, please wait.');?>    <div></div></div>';
	var	loadMoreHtml 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScroll();"  id="refresh_list" ><?php echo $this->tag->getTag('load_more','Load More') ;?></a>';  
	var afterFinishHtml = '';   
	var elementId='slideSheet';
	var appendId='suggest_friends_last_id';
	var scroll=true;
	var limit='<?php echo $limit;?>';
	var offest='0';
	var formID  = 'frmId';
	var checkFuture = true ;
	var loadingDiv ;
	$(document).ready(function () {
	loadingDiv  =  $('.loadingDiv');
	});
	var currentPage = 1;
	var scroll_Pagination5;
	var slug ='<?php echo Yii::app()->createUrl('business_listing/fetch_work').'?strl=1&'.$str;?>';


	</script>
  

	<script type="text/javascript">
 
 
 
	$(document).ready(function () {
	     const observer = lozad(); // lazy loads elements with default selector as '.lozad'
 observer.observe();
 /*
		   caroselSingle3();
		$('#sortingOptions').select2();
	$(window).scroll(function() {
	if($(window).scrollTop() + $(window).height() > $('#d_column').height() &&  scroll && !stopPagination) {
		scroll = false;
		 checkScroll();
	}
	})
	*/
	})
	
	</script> 

<?php } ?> 
</div>
<div class="clearfix"></div>
</div>
<?php
if($formData['sec'] != 'new-development'){ ?>
<script>      
	$(function(){

		$('#populating_data').addClass('ld'); 
		$.get('<?php echo $this->app->createUrl('site/populating_data2',(array)@$formData);?>',function(data){
			$('#populating_data').removeClass('ld');
			var data = JSON.parse(data);
			if(data.status=='1'){
				$('#populating_data').addClass('loaded');
				if(data.html=='<ul>\r\n<\/ul>\r\n\r\n'){
				   $('#populating_data').remove(); 
				}else{
				$('#content-populate').html(data.html)
				}
			} 
			
			})
		})
	 
	 	</script> 
	 	<?php } ?>
	 	
	 		<div id="listing-cnt" class="container">
		<?php
		if (!empty($pageContent)) { ?>
			<style>
				html #listing-cnt.container {
					padding: 25px 0px 50px !important;
				}

				#listing-cnt h2 {
					font-weight: 700;
					margin-bottom: 15px;
					font-size: 28px;
				}

				#listing-cnt h3 {
					font-weight: 600;
					margin-bottom: 15px;
					font-size: 22px;
				}

				#listing-cnt a {
					color: var(--blue);
				}
			</style>
			<?php echo $pageContent->highlights; ?>
		<?php } ?>
	</div>
