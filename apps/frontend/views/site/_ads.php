<div class="item_ko">
			<a href="#" class="listing-item-container">
			<div class="listing-item">
				<?php 
				$image2 = $v->AdImage ; 
				?>
				<img src="<?php echo  $apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image2   ;?>&h=190&w=385&zc=1" alt="">
			<!--<span class="like-icon"></span>--> 
			</div>
			<div class="listing-item-content spanfont">
			<h3><?php echo $v->adTitle; ?></h3>

			<div style="margin-bottom: 8px;"><div class="_wbsbxz"><div class="_12n1ibqr"><span class="_1jj7gf6"><?php echo $v->ShortDescription;?></span></div></div></div>
			</div>
			</a>
			<div class="overlay" style="" onclick="event.preventDefault();">
			
			<button class="btn btn-primary"  data-id="<?php echo $v->row_id;?>" data-number="<?php echo $v->row_number;?>"  onclick="openPopup(this)" >Update</button>
			<button class="btn btn-danger"   data-id="<?php echo $v->row_id;?>"  onclick="removeThisItem(this)"  >Remove</button>
			</div>
			</div>
