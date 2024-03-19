                        <!-- Listing Item -->
                        <?php
                   
                        foreach($works as $k=>$v){ 
								$class='fa fa-envelope-o';
					if($v->is_read=='1'){
						$class='fa fa-envelope-open-o';
					}
							echo '<li>  <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>'.date('d M Y',strtotime($v->date_added)).' <a href="'.Yii::app()->createUrl('agent_enquiry/update', array("id" => $v->id)).'" onclick="loadthis6(this,event)" ><i class="fa fa-eye"></i></a></span>

                <h3 class="timeline-header no-border"><i class="'.$class.'"></i> <a href="'.Yii::app()->createUrl('agent_enquiry/update', array("id" => $v->id)).'"  onclick="loadthis6(this,event)" class="ro-main1"><span>'.$v->linkTitle.' -  '.$v->TypeTitleTitle.' Enquiry - '.$v->cords.'</span> </a> <span class="">'.$v->phone.'</span>  </h3>
              </div>
            </li>';
						} 
                        ?> 
