<style>
	.nav-tabs>li.active>a {
		background-color: #fff;
		/* border: 1px solid #ddd; */
		border-radius: 20%;
		border-bottom-color: transparent;
	}

	.nav-tabs>li>a {
		border: 1px solid transparent;
		border-radius: 4px 4px 0 0;
		padding: 10px 15px;
		padding-bottom: 56px;
	}
</style>
<ul class="nav nav-tabs" style="border-bottom: 0px;">
	<li class="<?php echo $view == 'common' ? 'active' : 'inactive'; ?>">
		<a href="<?php echo $this->createUrl('settings/index', array('view' => 'common')) ?>">
			<?php echo Yii::t('settings', 'Common'); ?>
		</a>
	</li>
	<li class="<?php echo $this->action->id == 'page_titles' ? 'active' : 'inactive'; ?>">
		<a href="<?php echo $this->createUrl('settings/page_titles') ?>">
			<?php echo Yii::t('settings', 'Static Page Headings'); ?>
		</a>
	</li>
	<li class="<?php echo $view == 'meta' ? 'active' : 'inactive'; ?>">
		<a href="<?php echo $this->createUrl('settings/index', array('view' => 'meta')) ?>">
			<?php echo Yii::t('settings', 'Meta Titles'); ?>
		</a>
	</li>
	<li class="<?php echo $view == 'cron' ? 'active' : 'inactive'; ?>">
		<a href="<?php echo $this->createUrl('settings/index', array('view' => 'cron')) ?>">
			<?php echo Yii::t('settings', 'Cron Jobs'); ?>
		</a>
	</li>
</ul>