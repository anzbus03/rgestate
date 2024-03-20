 <?php
		 if($model){
				foreach($model as $k=>$v){
				?>	
					<li  class="nsdd <?php if((int)($k+1)%3 ==0  and $k!=0){ echo 'last'; }; ?>" >
					<div class="mainnewscol radius3">
					<div class="newscontnt"> 
					<div>
					<a title="<?php echo $v->title;?>" href="<?php echo Yii::app()->createUrl($v->slug.'/blog');?>" rel="nofollow">
					<?php
					preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);

					?>
									 
					 			
					
					<img   alt="<?php echo $v->title;?>" data-original="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  @$imges['1'] ;?>&h=202&w=317&zc=1" src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  @$imges['1'] ;?>&h=202&w=317&zc=1" class="PaddingTwo jqlazy" style="display: block;"></a>
					</div>
					<div class="titlebox titlelength">          
					<h3><a title="<?php echo $v->title;?>" href="<?php echo Yii::app()->createUrl($v->slug.'/blog');?>" class="LHight16" style="float: none; position: static;"><?php echo (strlen($v->title)>100) ? substr($v->title,0,100).'...' : $v->title  ; ?></a></h3>
					<div class="newsdatetime"><?php echo date('M d , Y h:i A',strtotime($v->date_added));?></div>
					<p>
							<?php 
							$string = strip_tags($v->content);
							echo  (strlen($string)>150) ? substr($string,0,150).'...':$string;
							?>
					</p>
					</div>
					</div> 
					<div class="newsdetailbg clearfix">
					<ul>
					<li class="first">
					<div class="newsview"> <span class="viewico2 sprite"></span> <?php echo $v->viewCount; ?> <span class="text12">Views</span></div>
					</li>
					<li class="last">
					<div class="newsview"> <a href="<?php echo Yii::app()->createUrl($v->slug.'/blog');?>" title="Read More"><span class="redmorico2 sprite"></span>Read More</a></div>
					</li>
					</ul>
					</div>
					</div>
					<div class="clear"></div> 
					</li>
				<?php
			}
		}
		?>
        
