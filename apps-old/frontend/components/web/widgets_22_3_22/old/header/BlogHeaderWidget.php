<?php defined('MW_PATH') || exit('No direct script access allowed');
class BlogHeaderWidget extends CWidget
{
    public function run()
    {
		$conntroller = $this->controller;
		$solutions = AdvArticle::model()->getArticles(AdvCategory::ADV_SOLUTION);
		$spec = AdvArticle::model()->getArticles(AdvCategory::ADV_SPEC);
		$guide = AdvArticle::model()->getArticles(AdvCategory::ADV_GUID);
	 
		$this->render('blog',compact('conntroller','solutions','spec','guide'));
    }
}
