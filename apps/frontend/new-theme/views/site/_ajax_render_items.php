<?php $section_name = empty($state) ? $country->country_name : $state->state_name ; ?>
<?php 
$href_url = '';
if(!empty($state)){
	$location['state']  =  $state->slug ;
	$href_url = '/state/'.$state->slug;
} 
else{
	$location['country']  =  $country->slug ;
	$href_url = '/country/'.$country->slug;
}

$apps = Yii::app()->apps;  $bg = true ; 
  ?>
        <style>
    ._ttoj70 {
    display: inline-block !important;
    text-align: left !important;
    width: 100% !important;
    margin-top: 8px !important;
        margin-left:0px !important;
}
    ._5923kg {
    box-shadow: none !important;
    text-align: left !important;
    width: auto !important;
    border-width: initial !important;
    border-style: none !important;
    border-color: initial !important;
    border-image: initial !important;
    padding: 4px 0px !important;
}
    ._l3bsjs {
    font-weight: 600 !important;
    font-size: 17px !important;
    line-height: 22px !important;
    display: inline !important;
    margin-right: 6px !important;
}
._l3bsjs.sle , ._8kak1d.sle{
  color: #737A84;
}
._l3bsjs.rnt , ._8kak1d.rnt{
  color: #737A84; ;
}
._5923kg:hover {
    text-decoration-line: underline !important;
}
#site ._ba2wq3 .sluck-arrow { display:none !important ; }
#site ._ba2wq3:hover .sluck-arrow { display:block !important ; }
    </style>
<script>
 	
</script>
 <script> $(function(){ $('.new_styl').removeClass('loader-initiated'); })</script>
  
    <div class="item homer new_styl loader-initiated">
                <?php
               if(!empty($new_homes) or !empty($new_properties_forrent)){ ?> 
               <div class="container margin-top-0" id=""  >
			    
			     <?php
			     
				  if(!empty($new_homes)){
					 $class_n = ''; $s_class_n = 'col-sm-12';
					 
					 $this->renderPartial('home_items/_property_for_sale',compact('href_url','show_all','general_head','section_name','s_class_n','apps'));
				  echo '<div class="clearfix"></div>';
                  }  
                  
				  if(!empty($new_properties_forrent)){
					 $class_n = ''; $s_class_n = 'col-sm-12';
					 	 $this->renderPartial('home_items/_property_for_rent',compact('href_url','show_all','general_head','section_name','class_n','apps'));
				
				   echo '<div class="clearfix"></div>';
                }  
                	 if(!empty($featured_developers)  ){  
               
               
               echo '<div class="clearfix"></div>';
						 	 $this->renderPartial('home_items/_recomanded_for_sale',compact('href_url','show_all','general_head','section_name','class_n','apps'));
							echo '<div class="clearfix"></div>';
						}
                /*
                  if(!empty($wanted)){
					 $class_n = ''; $s_class_n = 'col-sm-12';
					 
					 $this->renderPartial('home_items/_wanted',compact('href_url','show_all','general_head','section_name','s_class_n','apps'));
				  echo '<div class="clearfix"></div>';
                  }  */
                  
                
                
                
                ?>
			    
			    
			    
			    </div>
               <?php } ?> 
               
                
            </div>
      <?php
     if($this->options->get('system.common.enable_blog_home','no')=='yes'){
      $this->renderPartial('home_items/_home_blog_section');
	  }
      ?>
