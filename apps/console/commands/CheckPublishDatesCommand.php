<?php defined('MW_PATH') || exit('No direct script access allowed');

class CheckPublishDatesCommand extends CConsoleCommand
{
    public function run()
    {
        // Get the current datetime
        $now = new DateTime();
        // Query for articles that are not published yet but their publish date has passed
        $articles = BlogArticle::model()->findAll(array(
            'condition' => 'status = :status AND publish_date <= :now AND publish_time <= :time',
            'params'    => array(':status' => 'unpublished', ':now' => $now->format('Y-m-d')), ':time' => $now->format('H:i:s'),
        ));

        // Update the status of these articles to 'published'
        foreach ($articles as $article) {
            $article->status = 'published';
            $article->save(false); // Set to true if you want to trigger validation
        }

        return "Checked and updated articles.\n";
    }
}
