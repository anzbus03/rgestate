<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticleCategory
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "article_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $categories
 * @property Article[] $articles
 */
class AdvCategory extends ArticleCategory
{
   const ADV_SOLUTION =   '27';
   const ADV_SPEC =   '26';
   const ADV_GUID =   '29';
    
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'AD');

        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'category_id'   => CSort::SORT_ASC,
                ),
            ),
        ));
    }
      public function getRelationalCategoriesArray($parentId = null, $separator = ' -> ')
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'category_id, parent_id, name';
        if (empty($parentId)) {
            $criteria->condition = 'parent_id IS NULL';
        } else {
            $criteria->compare('parent_id', (int)$parentId);
        }
        $criteria->compare('f_type','AD');
        $criteria->addCondition('slug IS NOT NULL');
        $criteria->order = 'slug ASC';
        
        $categories = array();
        $results = self::model()->findAll($criteria);
        foreach ($results as $result) {
            // dont allow selecting a child as a parent
            if (!empty($this->category_id) && $this->category_id == $result->category_id) {
                continue;
            }
            $categories[$result->category_id] = $result->name;
            $children = $this->getRelationalCategoriesArray($result->category_id);
            foreach ($children as $childId => $childName) {
                $categories[$childId] = $result->name . $separator . $childName;
            }
        }
        return $categories;
    }
    
    public function getTitle(){
		return $this->name;
	}
    
   public function beforeSave(){
	   parent::beforeSave();
	   $this->f_type = 'AD'; 
	   return true;
   }
      public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
