<?php
$layout_id = '5';
$model = AdvertisementLayout::model()->findByPk($layout_id);
			if(empty($model) ){ 
				echo 1; Yii::app()->end();
			}
			$criteria=new CDbCriteria;
			$criteria->select = 't.*, ad.section_id,ad.slug as ad_slug,ban.link_url as banner_slug , art.slug as blog_slug  , ad.ad_description as ad_description, ad.ad_title as ad_title,ban.title as banner_title , art.title as blog_title  , ad.ad_description as ad_description,ban.description as banner_description , art.content as blog_description  ,  (CASE WHEN  t.section = "A" THEN  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.ad_id and  img.status="A" and  img.isTrash="0"  limit 1  )  WHEN t.section = "B" THEN ban.image  ELSE 0 END ) as      ad_image ';
			$criteria->join  .= ' left join {{place_an_ad}} ad ON ad.id = t.ad_id  ';
			$criteria->join  .= ' left join {{banner}} ban ON ban.banner_id = t.banner_id ';
			$criteria->join  .= ' left join {{article}} art ON art.article_id = t.article_id ';
			$criteria->condition  .= ' 1  and  t.layout_id = :layout_id';
			$criteria->order   = 't.row_id asc';
			$criteria->params[':layout_id']   = $model->primaryKey ;
			$data = AdvertisementItems::model()->findAll($criteria);
			$this->renderPartial( '//listing/ad/add_values',compact('model','data'));
