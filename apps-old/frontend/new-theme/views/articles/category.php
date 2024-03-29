<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
?>

<div  id="pageContainer" class="container margin-top-240">
    <h1 class="page-heading">
        <?php echo $category->name;?>  
    </h1>
    <hr />

    <?php if (!empty($articles)) { foreach ($articles as $article) { ?>
    <div class="article">
        <div class="title"><?php echo CHtml::link($article->title, Yii::app()->createUrl('articles/view', array('slug' => $article->slug)), array('title' => $article->title)); ?></div>
        <div class="excerpt"><?php echo $article->getExcerpt(500); ?></div>
   
        <div class="clearfix"><!-- --></div>
    </div>
    <?php } ?>
    <hr />
    <div class="pull-right">
    <?php $this->widget('CLinkPager', array(
        'pages'         => $pages,
        'htmlOptions'   => array('class' => 'pagination'),
        'header'        => false,
        'cssFile'       => false                
    )); ?>
    </div>
    <div class="clearfix"><!-- --></div>
    
    <?php } else { ?>
    <h4><?php echo Yii::t('articles', 'We\'re sorry, but this category doesn\'t have any published article yet!');?></h4>
    <?php } ?>
    
</div>
<style>
.article .title a { color:#1483D5; font-weight:600; }
</style>
