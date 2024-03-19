<header id="pageHeader" class="headerAbsolute <?php echo  empty($conntroller->white_header) ? 'blackheader' : '';?> <?php echo  !empty($conntroller->boxshdw) ? 'boxshdw' : '';?>">
					<!-- headerAbsoluteHolder -->
					<div class="headerAbsoluteHolder clearfix">
						<!-- logo -->
						<div class="logo" style="text-align: center;margin: auto;float: none;"><a href="<?php echo Yii::app()->createUrl('site/index');?>">
					 
						<img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/logo.svg');?>" style="height:45px" class="black_logo" alt="<?php echo $conntroller->project_name;?>">
						
						</a></div>
						<!-- pageNav -->
				 	</div>
				</header>
			 
