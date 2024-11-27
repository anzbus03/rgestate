<?php defined('MW_PATH') || exit('No direct script access allowed');

class TranslateController extends  Controller
{
    
	public function init()
    {
        parent::Init();
    }
	public function actionAddTerm($id=null,$relation=null,$relationID=null,$lan='ar')
	{
		 $request = Yii::app()->request;
		 $model =   Translate::model()->findByAttributes(array('source_tag'=>$id));
		 $lan   =   Yii::app()->request->getQuery('lan','ar');
		 if($model){
			$variable =  TranslationData::model()->findByAttributes(array('lang'=>$lan,'translation_id'=>$model->primaryKey));
			if($variable){
				$model->translation = $variable->message; 
			}
		 }
		 
		 
		 if(!$model){
			 $model = new Translate();
		 }
		 $model->lan  = $lan ; 
		 if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			 
		  
			$model->attributes = $attributes;
			if($relation=='template_id') {
					if (strpos($id, 'CustomerEmailTemplate_content') !== false) {
					//$model->email_check  = true ; 
					 
					}
			}
			if($relation=='article_id') {
					if (strpos($id, 'AdvArticle_content') !== false) {
					$model->no_parse  = true ; 
					 
					}
			}
				if($relation=='country_id') {
					if (strpos($id, 'Countries_footer_links') !== false) {
					$model->no_parse  = true ; 
					 
					}
			}
            if (!$model->save()) {
				 echo CHtml::errorSummary($model); Yii::app()->end();
                
            } else {
			
			  if(!empty($relation) and !empty($relationID) and in_array($relation,$model->relationalModule())){
				  
				  if(in_array($relation,array('tag_id','common_id'))){
						$time = Yii::app()->options->get('cache_time','');
						if($time){
						$Cache = $time.$lan; 
						Yii::app()->cache->delete($Cache); 
						}
						Yii::app()->options->set('cache_time',time()); 
				 
				  }
		
				  $foundRelation = TranslateRelation::model()->findByAttributes(array('translate_id'=>$model->primaryKey ,$relation=>$relationID));
				  if(!$foundRelation){
						$saveRelation = new TranslateRelation();
						$saveRelation->$relation		= $relationID;
						$saveRelation->translate_id 	= $model->primaryKey;
						$saveRelation->rec				= 1;
						$saveRelation->save(false);
				  }
				   
			  }
			  $this->redirect(Yii::app()->request->urlReferrer);

			//   echo $model->primaryKey;
            }
            Yii::app()->end();
        }
        else{
				$cs=Yii::app()->clientScript;
				$cs->scriptMap=array(
				'jquery.js'=>false,
				'jquery.min.js'=>false,
				'ckeditor.js'=>false,
				'ckeditor.js'=>false,
				'en.js'=>false,
				);
		}
         $model->source_tag = $id; 
      
       
		 $this->renderPartial('_create_form',compact('model','id'),false,true);
		 
	} 
	public   function actionSaveNormal($id=null,$relation=null,$relationID=null,$lan='ar', $message=null)
	{
	 
		  $model =   Translate::model()->findByAttributes(array('source_tag'=>$id));
		  if(!$model){  $model = new Translate();  }
			$model->lan  = $lan ; 
			$model->source_tag  = $id ; 
			$model->translation = $message;
            if (!$model->save()) {  return  CHtml::errorSummary($model);  }
            else if(!empty($relation) and !empty($relationID) and in_array($relation,$model->relationalModule())){
				  $data = 	TranslationData::model()->findByAttributes(array('lang'=>$model->lan,'translation_id'=>$model->primaryKey));
				  if($data){ 
						$data->message =  $message  ;
						$data->save();
						
				  }
				  else{
						$data = new TranslationData();
						$data->translation_id =  $model->primaryKey;
						$data->lang 		  =  $model->lan;
						$data->message 		  =   $message ; 
						$data->save();
				  }
				  $foundRelation = TranslateRelation::model()->findByAttributes(array('translate_id'=>$model->primaryKey ,$relation=>$relationID));
				  if(!$foundRelation){
						$saveRelation = new TranslateRelation();
						$saveRelation->$relation		= $relationID;
						$saveRelation->translate_id 	= $model->primaryKey;
						$saveRelation->rec				= 1;
						$saveRelation->save(false);
				  }
				   return $model->primaryKey;
				     
			  }
			  
        
        
		 
	} 
	
  
}
