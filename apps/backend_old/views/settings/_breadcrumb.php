	<ul class="nav nav-tabs" style="border-bottom: 0px;">
		<li class="<?php echo $view == 'common' ? 'active' : 'inactive';?>">
		<a href="<?php echo $this->createUrl('settings/index',array('view'=>'common'))?>">
		<?php echo Yii::t('settings', 'Common');?>
		</a>
		</li>
	 	<li class="<?php echo $this->action->id == 'page_titles' ? 'active' : 'inactive';?>">
		<a href="<?php echo $this->createUrl('settings/page_titles')?>">
		<?php echo Yii::t('settings', 'Static Page Headings');?>
		</a>
		</li>
		<li class="<?php echo $view == 'meta' ? 'active' : 'inactive';?>">
		<a href="<?php echo $this->createUrl('settings/index',array('view'=>'meta'))?>">
		<?php echo Yii::t('settings', 'Meta Titles');?>
		</a>
		</li>
	<li class="<?php echo $view == 'cron' ? 'active' : 'inactive';?>">
		<a href="<?php echo $this->createUrl('settings/index',array('view'=>'cron'))?>">
		<?php echo Yii::t('settings', 'Cron Jobs');?>
		</a>
		</li>
		</ul>