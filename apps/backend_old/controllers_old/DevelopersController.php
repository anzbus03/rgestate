<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UsersController
 * 
 * Handles the actions for users related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class DevelopersController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new Developer('search');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Developers List'), 
            'pageHeading'       => Yii::t('agent', 'Developers List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'Developers') => $this->createUrl('developers/index'),
                Yii::t('app', 'View all')
            )
        ));
      
         $criteria=new CDbCriteria;
        $criteria->compare('tag_type','C');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short = CHtml::listData($tagModel,'tag_id','tagCodeWithColor');
        $this->render('list', compact('user','tags','tags_short'));
    }
    
    /**
     * Create a new user
     */
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new Developer();
        $user->scenario = 'developer_insert';
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
			$uploadedFile=CUploadedFile::getInstance($user,'transparent');
            if( $uploadedFile){
            $fileName = rand(100,1000).$uploadedFile;
            $user->transparent = $fileName;
			}
           
            if (!$user->save()) {
				
				if($uploadedFile)
				{
				$path =  Yii::app()->basePath . '/../../uploads';
				$uploadedFile->saveAs($path.'/resized/'. $fileName);
				}
				
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('developers/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Create Developer'), 
            'pageHeading'       => Yii::t('agent', 'Create Developer'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Developer') => $this->createUrl('developers/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
		
		       $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
       $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $user = Developer::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        $user->scenario = 'developer_update';
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if($user->password=="")
            {
				 unset($user->password);
				 $user->con_password = '';
			}
			 $oldfilename =$user->transparent;
             $file = CUploadedFile::getInstance($user, 'transparent');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {
				$fileName = rand(100,1000).$file;
				$user->transparent = $fileName;
			 } else {
				$user->transparent = $oldfilename;
			 }
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if (is_object($file) && get_class($file)==='CUploadedFile') {
				 
					$path =  Yii::app()->basePath . '/../../uploads';
					$file->saveAs($path.'/resized/'. $fileName);
					if ($oldfilename != $fileName) {
						@unlink(Yii::app()->basePath . '/../../uploads/resized/'. $oldfilename);
					}
				} 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('developers/index'));
            }
        }
       
     //  echo  $user->password;echo "SDSD";exit;
            $user->password="";
            $user->con_password="";
            
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('capacity', 'Update Developer'),
            'pageHeading'       => Yii::t('agent', 'Update Developer'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Developer') => $this->createUrl('developers/index'),
                Yii::t('app', 'Update'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
        			 
        $this->getData('pageScripts')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.js')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/_imageCrop.js?q=1')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/cropper/dist/cropper.min.css')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/select2.min.css')));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/select2.min.js')));
       
        $this->render('form', compact('user'));
    }
    
    public function actionFeatured($id)
    {
		 
        $user = Developer::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        $user->scenario = 'featured';
        	$criteria = new CDbCriteria();
			$criteria->select= 't.country_name,t.country_id,priority,enable_all_cities,featured_country.country_id as  show_region ';
			$criteria->compare('t.show_on_listing','1');
			$criteria->join  = ' INNER JOIN {{listing_user_more_country}} cnn on cnn.country_id = t.country_id and cnn.user_id = :thisUser ';
			$criteria->join  .= ' LEFT JOIN {{listing_users_featured}} featured_country on featured_country.country_id = t.country_id and featured_country.user_id = :thisUser ';
			$criteria->compare('t.isTrash','0');
			$criteria->params[':thisUser'] = $user->user_id;
			$criteria->distinct  = 't.country_id ';
			$criteria->order = '-t.priority desc , country_name asc';
			 
			$countriesCount = Countries::model()->count($criteria);
			$pages = new CPagination($countriesCount);
			$pages->pageSize = 500;
			$pages->applyLimit($criteria);
			$countries = Countries::model()->findAll($criteria);
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest ) { 
			     $model2 = new ListingUsersFeatured();
			     $model3 = new ListingUsersStateFeatured();
			     $enable_all_citiesAll = @$_POST['enable_all_cities'];
			     $enable_listing = @$_POST['enable_listing'];
			   
                 //$disableAll = @$_POST['disable_country'];
                 //$enableState = @$_POST['enable_state'];
                 $model2->deleteAllByAttributes(array('user_id'=>$user->user_id));
                 $model3->deleteAllByAttributes(array('user_id'=>$user->user_id));
              
				 if(count($enable_all_citiesAll)>0)
				 { 
					foreach($enable_all_citiesAll as $country=>$val)
					{
						if(isset($enable_listing[$country])){ 
							unset($enable_listing[$country]);
									 
						 }
						$model2->isNewRecord =true; 
						$model2->user_id = $user->user_id;
						$model2->country_id = $country;
						if(!$model2->save()){
							print_r($model2->getErrors());exit;
						}
					}
				 }
			 
				 if(count($enable_listing)>0)
				 {  
					 foreach($enable_listing as $key=>$states)
					{
					    foreach($states as $knb=>$cnb){
						$model3->isNewRecord =true; 
						$model3->user_id = $user->user_id;
						$model3->state_id = $cnb ;
						if(!$model3->save()){
							print_r($model3->getErrors());exit;
						}
						}
					}
				 }
            
                 $notify->addSuccess(Yii::t('app', 'Featured Successfully updated!'));
                $this->refresh() ;
           
        }
       
     //  echo  $user->password;echo "SDSD";exit;
            $user->password="";
            $user->con_password="";
            
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('capacity', 'Update Featured'),
            'pageHeading'       => Yii::t('agent', 'Update Featured'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Developer') => $this->createUrl('developers/index'),
                Yii::t('app', 'Update'),
            )
        ));
    
        $this->render('featured', compact('user','countries','pages','countriesCount'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = Developer::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->updateBypk($id,array('isTrash'=>'1'));    
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('develpers/index')));
        }
    }
    
   public function actionImage_crop(){
		
 
		 			
		 			$newArray = (object) array(
		 			'x'=> $_GET['imgX5'],
		 			'y'=> $_GET['imgY5'],
		 			'height'=>$_GET['widthY'] ,
		 			'width'=> $_GET['widthX'],
		 			'cropW'=> $_GET['cropW'],
		 			'cropH'=> $_GET['cropH'],
		 			'rotate'=> $_GET['rotate'] ,
		 			);
		 			
		 		 
		 			
					$ext  = pathinfo($_GET['imgUrl'], PATHINFO_EXTENSION);
					$file = pathinfo($_GET['imgUrl'] , PATHINFO_FILENAME);
					$src   =  $file.'.'.$ext;  
					$src =  '../uploads/images' .'/'.$src ;
					$output_filename = "../uploads/resized/".$file.'.'.$ext;  
					$response = $this->crop($src, $output_filename,$newArray) ; 
					echo json_encode($response);exit;
					 
	}
	public $src;
	public $type;
	public $extension;

	 public function crop( $src,  $dst, $data) {
	  
	 
	if (!empty($src)) {
	$type = exif_imagetype($src);

	if ($type) {
	$this -> src = $src;
	$this -> type = $type;
	$this -> extension = image_type_to_extension($type);

	}
	}  	
			 
	  
	  
    if (!empty($src) && !empty($dst) && !empty($data)) {
      switch ($this -> type) {
        case IMAGETYPE_GIF:
     
          $src_img = imagecreatefromgif($src);
          break;

        case IMAGETYPE_JPEG:
      
          $src_img = imagecreatefromjpeg($src);
          break;

        case IMAGETYPE_PNG:
          $src_img = imagecreatefrompng($src);
          break;
      }

      if (!$src_img) {
        $this -> msg =  array('status'=>'failed','message'=>"Failed to read the image file")  ;  ;
        return;
      }

      $size = getimagesize($src);
      $size_w = $size[0]; // natural width
      $size_h = $size[1]; // natural height
      
      

      $src_img_w = $size_w;
      $src_img_h = $size_h;

      $degrees = $data -> rotate;

      // Rotate the source image
      if (is_numeric($degrees) && $degrees != 0) {
        // PHP's degrees is opposite to CSS's degrees
        $new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

        imagedestroy($src_img);
        $src_img = $new_img;

        $deg = abs($degrees) % 180;
        $arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

        $src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
        $src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

        // Fix rotated image miss 1px issue when degrees < 0
        $src_img_w -= 1;
        $src_img_h -= 1;
      }

      $tmp_img_w = $data -> width;
      $tmp_img_h = $data -> height;
      $dst_img_w =  $data -> cropW;
      $dst_img_h =  $data -> cropH;

      $src_x = $data -> x;
      $src_y = $data -> y;

      if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
        $src_x = $src_w = $dst_x = $dst_w = 0;
      } else if ($src_x <= 0) {
        $dst_x = -$src_x;
        $src_x = 0;
        $src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
      } else if ($src_x <= $src_img_w) {
        $dst_x = 0;
        $src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
      }

      if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
        $src_y = $src_h = $dst_y = $dst_h = 0;
      } else if ($src_y <= 0) {
        $dst_y = -$src_y;
        $src_y = 0;
        $src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
      } else if ($src_y <= $src_img_h) {
        $dst_y = 0;
        $src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
      }

      // Scale to destination position and size
      $ratio = $tmp_img_w / $dst_img_w;
      $dst_x /= $ratio;
      $dst_y /= $ratio;
      $dst_w /= $ratio;
      $dst_h /= $ratio;

      $dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

      // Add transparent background to destination image
      if($this->type ==  IMAGETYPE_PNG ){
		imageAlphaBlending($dst_img, false);
		imageSaveAlpha($dst_img, true);
		imagefilledrectangle($dst_img, 0, 0, $dst_img_w, $dst_img_h, imagecolorallocate($dst_img, 255, 255, 255));
	  }

      $result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
 
		 
      if ($result) {
        if (!imagejpeg($dst_img, $dst,'100'  )) {
		   return     array('status'=>'failed','message'=>'unable to save')  ; 
        }
        else{
			$ext  = pathinfo($dst, PATHINFO_EXTENSION);
			$file = pathinfo($dst , PATHINFO_FILENAME);
			$image = $file.'.'.$ext;
			$thumbUrl =   Yii::app()->apps->getBaseUrl('timthumb.php').'?src='.Yii::app()->apps->getBaseUrl('uploads/posts/'.$image).'&w=83&h=60&zc=1';
            return array('status'=>'success','url'=>$image , 'thumbUrl' => $thumbUrl ) ; 
		}
      } else {
			return     array('status'=>'failed','message'=>'unable to save')  ; 
      }

      imagedestroy($src_img);
      imagedestroy($dst_img);
    }
  }
    
}
