<!-- Listing Item -->
<?php

foreach($works as $k=>$v){ 
?>
<li class="review_list_new_item_block">
						<div class="c-review-block" itemprop="review" itemscope="" itemtype="http://schema.org/Review">
							 
							<div class="c-review-block__row">
								<div class="c-guest-with-score">
									<div class="c-guest-with-score__guest">
										<div class="c-guest bui-avatar-block">
											<div class="bui-avatar ">
												<img class="bui-avatar__image" src="<?php echo $v->ProfileImage;?>" aria-hidden="true">
											</div>
											<div class="bui-avatar-block__text"> <span class="bui-avatar-block__title"><?php echo   $v->name  ;?></span>
											 
                            
											</div>
										</div>
									</div>
									<div class="c-guest-with-score__score">
										<div class="bui-review-score c-score">
											<div class="bui-review-score__badge" aria-label="Scored 10 "><?php echo  $v->rating;?></div>
										</div>
									</div>
								</div>
							</div>
							<div class="c-review-block__row">
 
 
								<span class="c-review-block__date">Reviewed: <?php echo  date('M d , Y',strtotime($v->dateAdded));?></span>
							</div>
							<div class="c-review-block__row">
								<div class="c-review">
									<div class="c-review__row">
										<p class="c-review__inner ">
										<span class="c-review__body" dir="auto"><?php echo  nl2br($v->review);?></span>
										</p>
									</div>
								</div>
							</div>
							 
					 </div>
					</li>

<?

}  

                 

