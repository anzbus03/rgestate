<ul class="payment-plans np_box_list slider-zoom flex-container flex-wrap flex-center">
 
                                        
           
<?php

     
    foreach($payment_plan as $k=>$v){
             $ext = ''; 
    		if (strpos(	$v->file  ,'/') !== false) { 
												$file = Yii::app()->apps->getBaseUrl('uploads/files/'.	$v->file );
                                                    $ext = pathinfo($v->file,PATHINFO_EXTENSION);
                                                    if (strtolower($ext) == 'pdf') {
                                                         $file2 = $file; 
                                                    $file = $this->app->apps->getBaseUrl('assets/img/pdfi1.png');
                                                    }
												
												}
    
    ?> 
    <li class="" data-src="<?php echo $file;?>" >
          <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo $ext=='pdf' ? $file2 : $file;?>" style="display: block;    height: 100%;width:100%;">
                        <div class="pro-img img-container-adj" style="position: static; overflow: hidden; background-color: rgba(0, 0, 0, 0);text-align: center;">
                            <img class="fullscreen-img defaultSize" src="<?php echo $file;?>" style="width: 100%; height: 100%; position: relative; top: 0px;object-fit: contain;object-position: top;  ">
                        </div>
                        <div class="pro-content">
                            <p class="text-capitalize"><?php echo $v->title;?></p>
                        </div>
                        <div class="clearfix"></div>
                        </a>
                    </li>
                    <?php
    }
    ?>
     </ul>
 <?php 
	/*				if(!empty($payment_plan )){ ?>
					    
						
						<?php
						$category = array();
						
									$dropdown_array = '<div class="newheader_dropdown_action  pull-right" data-tr-event-name="header_user_account" style="width:115px;float:left">
			<a href="javascript:void(0)" class="newheader_dropdown_action_item header_link" data-ui-id="user-account">
			<span class="newheader_useravatar_name">{active}</span>
			</a>
			<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" class="newheader_dropdown_arrow">
			<path fill="currentColor" d="M6 5.869l1.634-1.635a.8.8 0 1 1 1.132 1.132l-2.2 2.2a.8.8 0 0 1-1.132 0l-2.2-2.2a.8.8 0 1 1 1.132-1.132L6 5.87z"></path>
			</svg>
			<div class="newheader_dropdown_container newheader_dropdown" style="display:none;">
			<ul class="newheader_dropdown_items">
			{items}

			</ul>
			</div>
			</div>
			';	$dropdown_array ='';

									foreach($payment_plan as $k=>$v){  
										$category_title = $v->title;
										$category[Yii::t('app',$category_title)][] = array('floor_file'=>$v->file,'title'=>$category_title);
										
										  }
										  $ct_html = '';$content = '';
										  $c_ount = 0;
										  foreach($category as $floor_categoy =>$floor_detail  ){
										  $c_class	=  $c_ount==0 ? 'active':'';
										  $ct_html .='<button class="tablinks '.$c_class.'" onclick=openCity2(event,this,"paymentabc_'.$c_ount.'","payment_plan")   >'.Yii::t('app',$floor_categoy).'</button>';
									 
										  
										  $indi_active_count = 0; 
										  $activetitle ='';
										  $category_list = ''; 
										  foreach($floor_detail as $indivK  ){
											  												if (strpos($indivK['floor_file'] ,'/') !== false) { 
												$file = Yii::app()->apps->getBaseUrl('uploads/files/'.	$indivK['floor_file']);
												}
												else{
												$file = ENABLED_AWS_PATH.$indivK['floor_file'];
												}

											
											  if($indi_active_count=='0'){
												  
											  $activetitle = Yii::t('app',$indivK['title']);
											  $content .= '<div id="paymentabc_'.$c_ount.'" class="tabcontent '.$c_class.'"><h3><span class="head_t">'.Yii::t('app',$indivK['title']).'</span>' ;
											  $content .= '{items}</h3><p><img src="'.$file.'" style="width: auto !important;max-height: 238px;display:block;text-align: center;margin: auto;"></p><a href="'.$file.'" target="_blank" class="view_html">View</a></div>';
											  $category_list .= '<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link" data-id="paymentabc_'.$c_ount.'" onclick="activateThisImage(this)" data-title="'.Yii::t('app',$indivK['title']).'" data-file="'.$file.'" href="javascript:void(0)">'.Yii::t('app',$indivK['title']).'</a></li>';
											  
											  $indi_active_count++;
											  }
											  else{
												    $category_list .= '<li class="newheader_dropdown_item"><a class="newheader_dropdown_item_link header_link"  data-id="paymentabc_'.$c_ount.'" onclick="activateThisImage(this)" data-title="'.Yii::t('app',$indivK['title']).'" data-file="'.$file.'" href="javascript:void(0)">'.Yii::t('app',$indivK['title']).'</a></li>';
											
											  }
										  }
										  
										  $content = Yii::t('app',$content,array('{items}'=>$dropdown_array));
										  $content = Yii::t('app',$content,array('{active}'=>$activetitle,'{items}'=>$category_list));
										  
										  
										  
										  
										  $c_ount++;
										  
										  };
										  
										   ?>
						
						<div class="clearfix"></div>
						
						<div>
						
						
						<div class="tab">
						<?php echo $ct_html;?>
						</div>
						<?php echo $content;?> 
						<script>
						function activateThisImage(t){var e=$(t).attr("data-id"),a=$(t).attr("data-file"),n=$(t).attr("data-title");$("#"+e).find("img").attr("src",a),$("#"+e).find(".view_html").attr("href",a),$("#"+e).find("span.head_t").html(n),$("#"+e).find(".newheader_useravatar_name").html(n)}function openCity(t,e){var a,n,l;for(n=document.getElementsByClassName("tabcontent"),a=0;a<n.length;a++)n[a].style.display="none";for(l=document.getElementsByClassName("tablinks"),a=0;a<l.length;a++)l[a].className=l[a].className.replace(" active","");document.getElementById(e).style.display="block",t.currentTarget.className+=" active"}
						</script>	
						</div>
						<div class="clearfix"></div>
						 
						 
						<?php } 
						*/
						?> 
						
					
