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
 * @since 1.0property_import
 */
 
class Property_importController extends Controller
{
 public function actionCsv_import($type=null)
    {
		
		  switch($type){
			case 'zameen':
			$type = 'zameen';
			break;
			case 'olx':
			$type = 'olx';
			break;
			default:
				throw new CHttpException(503, 'Property import type not set. Please contact developer.');
			break;
		}
         $title = strtoupper($type );
        $options  = Yii::app()->options;
        $request  = Yii::app()->request;
        $notify   = Yii::app()->notify;
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('list-import.js')));
		 
        $importLog = array();
        $filePath  = Yii::getPathOfAlias('common.runtime.list-import').'/';

        $importAtOnce = (int)$options->get('system.importer.import_at_once', 50);
        $pause        = (int)$options->get('system.importer.pause', 1);

        set_time_limit(0);
        if ($memoryLimit = $options->get('system.importer.memory_limit')) {
            ini_set('memory_limit', $memoryLimit);
        }
        ini_set('memory_limit', '-1');
        ini_set('auto_detect_line_endings', true);

        $import = new ListCsvImport('upload');
        $import->file_size_limit = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1); // 1 mb
        $import->attributes      = (array)$request->getPost($import->modelName, array());
        $import->file            = CUploadedFile::getInstance($import, 'file');
       
        if (!empty($import->file)) {
            if (!$import->upload()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                $notify->addError($import->shortErrors->getAllAsString());
                $this->redirect(array('place_import/Create_import'));
            }

            $this->setData(array(
                'pageMetaTitle'     => $this->data->pageMetaTitle.' | '.Yii::t('list_import', $title.' - Import Properties'),
                'pageHeading'       => Yii::t('list_import', $title.' - Import Properties'),
                'pageBreadcrumbs'   => array(
                    Yii::t('leads', 'Properties') => $this->createUrl('place_property/index/'),
                    Yii::t('list_import', $title.' - CSV Import')
                )
            ));

             return $this->render('csv', compact('list', 'import', 'importAtOnce', 'pause'));echo 'wer';exit; 
        }

        // only ajax from now on.
        if (!$request->isAjaxRequest) {
           // $this->redirect(array('leads/index'));
        }

       try {

            if (!is_file($filePath.$import->file_name)) {
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'The import file does not exist anymore!')
                ));
            }

 
            $file = new SplFileObject($filePath.$import->file_name);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE | SplFileObject::READ_AHEAD);
            $columns = $file->current(); // the header


 

            if (empty($columns)) {
                unset($file);
                @unlink($filePath.$import->file_name);
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'Your file does not contain the header with the fields title!')
                ));
            }

            if ($import->is_first_batch) {
                $linesCount         = iterator_count($file);
                $totalFileRecords   = $linesCount - 1; // minus the header
                $import->rows_count = $totalFileRecords;
            } else {
                $totalFileRecords = $import->rows_count;
            }

            $file->seek(1);

            
            $totalSubscribersCount = 0;
            $listSubscribersCount  = 0;
            $maxSubscribersPerList = (int)  -1 ;
            $maxSubscribers        = (int)  -1 ;

            /*
            $criteria = new CDbCriteria();
            $criteria->select = 'field_id, label, tag';
            $criteria->compare('list_id', $list->list_id);
            $fields = ListField::model()->findAll($criteria);
            * */
			$fields = array();
            $foundTags = array();
            $searchReplaceTags = array(
                'E_MAIL'        => 'EMAIL',
                'EMAIL_ADDRESS' => 'EMAIL',
                'EMAILADDRESS'  => 'EMAIL',
            );
            
       
            
            foreach ($fields as $field) {
				 
                if ($field->tag == 'FNAME') {
                    $searchReplaceTags['F_NAME']     = 'FNAME';
                    $searchReplaceTags['FIRST_NAME'] = 'FNAME';
                    $searchReplaceTags['FIRSTNAME']  = 'FNAME';
                    continue;
                }
                if ($field->tag == 'LNAME') {
                    $searchReplaceTags['L_NAME']    = 'LNAME';
                    $searchReplaceTags['LAST_NAME'] = 'LNAME';
                    $searchReplaceTags['LASTNAME']  = 'LNAME';
                    continue;
                }
            }
 
            $ioFilter = Yii::app()->ioFilter;
            $columns  = (array)$ioFilter->stripTags($ioFilter->xssClean($columns));
            $columns  = array_map('trim', $columns);

            foreach ($columns as $value) {
                $tagName     = StringHelper::getTagFromString($value);
                $tagName     = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $tagName);
                $foundTags[] = $tagName;
            }
             
            $foundEmailTag = false;
            foreach ($foundTags as $tagName) {
                if ($tagName === 'MOBILENUMBER') {
                    $foundEmailTag = true;
                    break;
                }
            }

            if (!$foundEmailTag) {
                unset($file);
                @unlink($filePath.$import->file_name);
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => Yii::t('list_import', 'Cannot find the "MobileNumber" column in your file!')
                ));
            }

            $foundReservedColumns = array();
            $field_check_array = array(
					'ad_title' => array( 'title') ,
					'ad_description' => array('description'),
					'city_id' => array('location'),
					'price' => array('price'),
					'bedrooms' => array('bedrooms'),
					'bathrooms' => array('baths'),
					'category' => array('category'),
					'purpose' => array('purpose'),
					'area' =>array('area') ,
					'amenities' =>array('amenities') ,
					'agentname' =>array('agentname') ,
					'imageurl' =>array('imageurl') ,
					'phone' => array('mobilenumber'),
					'phonenumbers' => array('phone'),
					'LocationUrl' => array('locationurl'),
					'url' => array('url'),
					
					 
					);
					
					  
					$find_array =array();
					foreach ($columns as $columnName) {
					 
						foreach($field_check_array as $k=>$check_columValue ){
							 
							$found_clmn = array_search(strtolower($columnName) ,(array)$check_columValue);
							 
							if( strlen($found_clmn)>=1){
								$find_array[$k] = strtolower($columnName);
								break;
							}
						}

					}
					
					
            foreach ($columns as $columnName) {
				 
				  
				 
                $columnName     = StringHelper::getTagFromString($columnName);
                $columnName     = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $columnName);
             
            }
           

            if ($import->is_first_batch) {
                /*
                if ($logAction = Yii::app()->customer->getModel()->asa('logAction')) {
                    $logAction->listImportStart($list, $import);
                }
                * */

                $importLog[] = array(
                    'type'    => 'info',
                    'message' => Yii::t('list_import', 'Found the following column names: {columns}', array(
                        '{columns}' => implode(', ', $columns)
                    )),
                    'counter' => false,
                );
            }

            $offset = $importAtOnce * ($import->current_page - 1);
            if ($offset >= $totalFileRecords) {
                return $this->renderJson(array(
                    'result'  => 'success',
                    'message' => Yii::t('list_import', 'The import process has finished!')
                ));
            }
            $file->seek($offset);

            $csvData     = array();
            $columnCount = count($columns);
            $i           = 0;

            while (!$file->eof()) {

                $row = $file->fgetcsv();
                if (empty($row)) {
                    continue;
                }

                $row = (array)$ioFilter->stripTags($ioFilter->xssClean($row));
                $row = array_map('trim', $row);
                $rowCount = count($row);

                if ($rowCount == 0) {
                    continue;
                }

                $isEmpty = true;
                foreach ($row as $value) {
                    if (!empty($value)) {
                        $isEmpty = false;
                        break;
                    }
                }

                if ($isEmpty) {
                    continue;
                }

                if ($columnCount > $rowCount) {
                    $fill = array_fill($rowCount, $columnCount - $rowCount, '');
                    $row  = array_merge($row, $fill);
                } elseif ($rowCount > $columnCount) {
                    $row  = array_slice($row, 0, $columnCount);
                }

                $csvData[] = array_combine($columns, $row);

                ++$i;

                if ($i >= $importAtOnce) {
                    break;
                }
            }
            unset($file);

            $fieldType =  array();

            $data = array();
            foreach ($csvData as $row) {
                $rowData = array();
                foreach ($row as $name => $value) {
                    $tagName = StringHelper::getTagFromString($name);
                    $tagName = str_replace(array_keys($searchReplaceTags), array_values($searchReplaceTags), $tagName);

                    $rowData[] = array(
                        'name'      => ucwords(str_replace('_', ' ', $name)),
                        'tagName'   => trim($tagName),
                        'tagValue'  => trim($value),
                    );
                }
                $data[] = $rowData;
            }
          
            unset($csvData);

            if (empty($data) || count($data) < 1) {
                @unlink($filePath.$import->file_name);

                if ($logAction = Yii::app()->customer->getModel()->asa('logAction')) {
                    $logAction->listImportEnd($list, $import);
                }

                if ($import->is_first_batch) {
                    return $this->renderJson(array(
                        'result'  => 'error',
                        'message' => Yii::t('list_import', 'Your file does not contain enough data to be imported!')
                    ));
                } else {
                    return $this->renderJson(array(
                        'result'  => 'success',
                        'message' => Yii::t('list_import', 'The import process has finished!')
                    ));
                }
            }

            $tagToModel = array();
           
  
            // since 1.3.5.9
            $bulkEmails = array();
            foreach ($data as $index => $fields) {
                foreach ($fields as $detail) {
                    if ($detail['tagName'] == 'MobileNumber' && !empty($detail['tagValue'])) {
                        $email = $detail['tagValue'];
                       
                        break;
                    }
                }
            }
            $failures = (array)Yii::app()->hooks->applyFilters('list_import_data_bulk_check_failures', array(), (array)$bulkEmails);
            /*
            foreach ($failures as $email => $message) {
                EmailBlacklist::addToBlacklist($email, $message);
            }
            * */
            // end 1.3.5.9

            $finished    = false;
            $importCount = 0;

            // since 1.3.5.9
            Yii::app()->hooks->doAction('list_import_before_processing_data', $collection = new CAttributeCollection(array(
                'data'        => $data,
                'list'        => $list,
                'importLog'   => $importLog,
                'finished'    => $finished,
                'importCount' => $importCount,
                'failures'    => $failures,
                'importType'  => 'csv'
            )));

            $data        = $collection->data;
            $importLog   = $collection->importLog;
            $importCount = $collection->importCount;
            $finished    = $collection->finished;
            $failures    = $collection->failures;
            //

            //$transaction = Yii::app()->getDb()->beginTransaction();
            $mustCommitTransaction = true;

            try {
              
                $model = new PlaceAnAd();
                $attribute_array = array();
			 
				$company_grade_value = array();
				$company_type_value = array();
				
				
                foreach ($data as $index => $fields) {
					
					
					  $attribute_array = array();
				 
                    foreach ($fields as $detail) {
						
						$tag_name_small = strtolower($detail['tagName']);
						$tag_name_value = trim($detail['tagValue']);
					 	
					
						if(empty($tag_name_value)){ continue;}
						
						 $attribute_name = array_search($tag_name_small,$find_array);
						 
						 
						 
						 if(strlen($attribute_name)>=1){
							 
							 
							 
							    if($attribute_name=='imageurl') { 
								  $imageList = explode(',',$tag_name_value); 
								  if(!empty($imageList)){
									  $attribute_array['images'] = array();
									  $cmn = 1; 
									foreach($imageList as $k=>$file){  
										if($cmn>='8') { continue; }
										$file = trim($file);
									  	$file_format = 'jpeg';
										$img =date('Y-m-d-h-i-s').'-'.rand(0,9999).'-'.time().".".$file_format;
										$path_file =  Yii::getPathOfAlias('root.uploads.files');
										$year_folder = $path_file .'/'. date("Y");
										$month_folder = $year_folder . '/' . date("m");
										$month_folder2 = date("Y"). '/' . date("m");
										!file_exists($year_folder) && mkdir($year_folder , 0777);
										!file_exists($month_folder) && mkdir($month_folder, 0777);
										$path_file = $month_folder ;

										//file_put_contents( $path_file."/{$img}", file_get_contents($file)); 
										$tag_name_value =   $month_folder2. '/' .$img;   ; 
										$attribute_array['images'][] = $tag_name_value;
										$attribute_array['images_upload'][$tag_name_value] =  array('path'=>$path_file."/{$img}",'file'=>$file);
										$cmn++;
									}
								   
								  }
								   
							    } 
							    if($attribute_name=='city_id') { 
								   
								   $cityModel = $this->findCityFrmName($tag_name_value);
								 
								   if(!empty($cityModel)){
									   $attribute_array['city'] = $cityModel->city_id; 
									   $attribute_array['state'] = $cityModel->state_id; 
									   $attribute_array['country'] = $cityModel->country_id; 
									    
									   unset($attribute_array['city_id']); 
								   }
								   
							    } 
							    if($attribute_name=='price') { 
								   $tag_name_value = $this->findPrice($tag_name_value);
								   
							    } 
							     if($attribute_name=='broker_id') {
							         if(!empty($tag_name_value)){
							            $user_found = ListingUsers::model()->findByAttributes(array('pf_id'=>(int)$tag_name_value));
							            if($user_found){
							                $attribute_array['user_id'] = $user_found->user_id;
							            }
							         }
								    
								   
							    } 
							    if($attribute_name=='bathrooms') { 
								   $tag_name_value =  (int) $tag_name_value;
								   
							    } 
							    if($attribute_name=='purpose') { 
								   $tag_name_value = $this->findPurpose($tag_name_value);
								   if(!empty($tag_name_value)){
									    $attribute_array['section_id'] = $tag_name_value ;
									    if($tag_name_value=='2'){
									       $attribute_array['rent_paid'] =  'monthly';
									    }
								   }
								   
							    } 
							    if($attribute_name=='area') { 
								   $unitModel = $this->findbuiltup_area($tag_name_value);
								    if(!empty($unitModel)){
									   if(isset($unitModel['area_unit'])){
										   $attribute_array['area_unit'] = $unitModel['area_unit']; 
									   }
									   if(isset($unitModel['builtup_area'])){
										   $attribute_array['builtup_area'] = $unitModel['builtup_area']; 
									   }
								   }
								   
							    } 
							    if($attribute_name=='amenities') { 
								   $tag_name_value = $this->findAmenities($tag_name_value);
								    
							    } 
							   
							    if($attribute_name=='category') { 
								   $categoryModel = $this->findCategory($tag_name_value);
								   if(!empty($categoryModel)){
									   if(isset($categoryModel['sub_category_id'])){
										   $attribute_array['sub_category_id'] = $categoryModel['sub_category_id']; 
									   }
									   if(isset($categoryModel['category_id'])){
										   $attribute_array['category_id'] = $categoryModel['category_id']; 
									   }
								   }
								   
							    } 
							    if($attribute_name=='LocationUrl') { 
								   $LocationUrlModel = $this->findLatitude($tag_name_value);
								   if(!empty($LocationUrlModel)){
									   if(isset($LocationUrlModel['location_latitude'])){
										   $attribute_array['location_latitude'] = $LocationUrlModel['location_latitude']; 
									   }
									   if(isset($LocationUrlModel['location_longitude'])){
										   $attribute_array['location_longitude'] = $LocationUrlModel['location_longitude']; 
									   }
								   }
								   
							    } 
							  if($attribute_name=='phone') { 
								    $tag_name_value = Yii::t('app',$tag_name_value,array('-'=>''));
									$attribute_array['full_number'] =  $tag_name_value ; 
									$tag_name_value =  substr($tag_name_value, -10); 
								 
								   
							    }
							  if($attribute_name=='agentname') { 
									$attribute_array['contact_person'] =  $tag_name_value ; 
							  }
							  if($attribute_name=='phone') { 
									$attribute_array['mobile_number'] =  $tag_name_value ; 
							   }
								
							  if($attribute_name=='url') { 
								     $slug = $this->findSlug($tag_name_value);
								     $attribute_array['slug_z'] = $slug; 
								 
							   }
								
								$attribute_array[$attribute_name] = $tag_name_value; 
						 }
                        	
			
                        
                         
                    }
                    
                   
                    
                    
                    //$user_id  = $this->findOrInsertUser($attribute_array);
                    //$attribute_array['user_id'] = $user_id;
                      
                  
                     
                   
					$email = $attribute_array['ad_title'];
                    if (empty($email)) {
                        unset($data[$index]);
                       // continue;
                    }

                    $importLog[] = array(
                        'type'    => 'info',
                        'message' => Yii::t('list_import', 'Checking the list for the title: "{email}"', array(
                            '{email}' => CHtml::encode($email),
                        )),
                        'counter' => false,
                    );

                    if (!empty($failures[$email])) {
                        $importLog[] = array(
                            'type'    => 'error',
                            'message' => Yii::t('list_import', 'Failed to save the title "{email}", reason: {reason}', array(
                                '{email}'  => CHtml::encode($email),
                                '{reason}' => '<br />'.$failures[$email],
                            )),
                            'counter' => true,
                        );
                        continue;
                    }

                    $subscriber = null;
                    if (!empty($email)) {
						$subscriber  = array(); 
						 
                      
                        
                    }

                    if (empty($subscriber)) {

                        $importLog[] = array(
                            'type'    => 'info',
                            'message' => Yii::t('list_import', 'The title "{email}" was not found, we will try to create it...', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => false,
                        );

                         $subscriber = PlaceAnAd::model()->findByAttributes(array(
                            'slug_z'   => $attribute_array['slug_z'] ,
                        ));
                        if(empty($subscriber)){   $subscriber  = new PlaceAnAd(); }
                        $subscriber->scenario = 'new_insert';
                        $subscriber->attributes = $attribute_array;
                        $subscriber->no_image =  '1';
                        $subscriber->site = $this->import_from() =='olx' ?  'O' : 'Z';
                        $subscriber->insert_via =  '1';
                         
						 
                        if ($subscriber->hasErrors() || !$subscriber->save()) {
							
                            $importLog[] = array(
                                'type'    => 'error',
                                'message' => Yii::t('list_import', 'Failed to save the title "{email}", reason: {reason}', array(
                                    '{email}'  => CHtml::encode($email),
                                    '{reason}' => '<br />'.$subscriber->shortErrors->getAllAsString()
                                )),
                                'counter' => true,
                            );
                            continue;
                        }
                        else { 
						  $am = new  AdAmenities();
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$subscriber->id)));
						  if(isset($attribute_array['amenities']))
						  {
							 $ameni =  $attribute_array['amenities'];
							 foreach($ameni as $k)
							 {
								 
									$am->isNewRecord = true;
									$am->ad_id = $subscriber->id;
									$am->amenities_id =  $k;
									$am->save();
							 }
							 
						  }
						   
						if( $import->download_images=='1' ){
						  $AdImage = new  AdImage();
						  $AdImage->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$subscriber->id)));
						  if(isset($attribute_array['images']))
						  {
							 $imageList =  $attribute_array['images'];
							 foreach($imageList as $k9)
							 {
									 $AdImage = new  AdImage();
									$AdImage->isNewRecord = true;
									$AdImage->id = '';
									$AdImage->ad_id = $subscriber->id;
									$AdImage->image_name =  $k9;
									$AdImage->status = 'A';
									$AdImage->save();
									if(isset($attribute_array['images_upload'][ $k9])){
									$filed = $attribute_array['images_upload'][ $k9]; 
									file_put_contents( $filed['path'], file_get_contents($filed['file']));
									}
							 }
							 
						  }
						  }  
						  
						   
						 
						  
						  $cityM = City::model()->findByPk($subscriber->city);
						  
						 
						  if(!empty($cityM)){ 
							  if(empty($cityM->location_latitude)){
								  City::model()->updateByPk($subscriber->city,array('location_latitude'=>$subscriber->location_latitude,'location_longitude'=>$subscriber->location_longitude));
								
							 
							  }
						  }
						  
						}
						 
                        $listSubscribersCount++;
                        $totalSubscribersCount++;

                      

                        $importLog[] = array(
                            'type'    => 'success',
                            'message' => Yii::t('list_import', 'The Property "{email}" has been successfully saved.', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => true,
                        );

                    } else {

                        $importLog[] = array(
                            'type'    => 'info',
                            'message' => Yii::t('list_import', 'The Property "{email}" has been found, we will update it.', array(
                                '{email}' => CHtml::encode($email),
                            )),
                            'counter' => true,
                        );
                    }

                  

                    unset($data[$index]);
                    ++$importCount;

                    if ($finished) {
                        break;
                    }
                }

              //  $transaction->commit();
                $mustCommitTransaction = false;

             } catch(Exception $e) {

                if (isset($file)) {
                    unset($file);
                }

                if (is_file($filePath.$import->file_name)) {
                    @unlink($filePath.$import->file_name);
                }

               // $transaction->rollback();
                $mustCommitTransaction = false;

                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => $e->getMessage(),
                ));
            }
             

            if ($mustCommitTransaction) {
              //  $transaction->commit();
            }

            if ($finished) {
                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => $finished,
                ));
            }

            $import->is_first_batch = 0;
            $import->current_page++;

            return $this->renderJson(array(
                'result'    => 'success',
                'message'   => Yii::t('list_import', 'Imported {count} subscribers starting from row {rowStart} and ending with row {rowEnd}! Going further, please wait...', array(
                    '{count}'    => $importCount,
                    '{rowStart}' => $offset,
                    '{rowEnd}'   => $offset + $importAtOnce,
                )),
                'attributes'   => $import->attributes,
                'import_log'   => $importLog,
                'recordsCount' => $totalFileRecords,
            ));
 
        } catch(Exception $e) {

            if (isset($file)) {
                unset($file);
            }

            if (is_file($filePath.$import->file_name)) {
                @unlink($filePath.$import->file_name);
            }

            return $this->renderJson(array(
                'result'  => 'error',
                'message' => Yii::t('list_import', 'Your file cannot be imported, a general error has been encountered: {message}!', array(
                    '{message}' => $e->getMessage()
                ))
            ));

        }
        
    }
   
   
    public function actionCreate_import($type='zameen')
    {
		  
        switch($type){
			case 'zameen':
			$type = 'zameen';
			break;
			case 'olx':
			$type = 'olx';
			break;
			default:
			$type = 'olx';
			break;
		}
       $title = strtoupper($type );
       
        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->name . ' | ' . Yii::t('dashboard', $title .' - Property Import'), 
            'pageHeading'       => Yii::t('dashboard',  $title .' - Property Import'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard',  $title .' - Property Import'),
            ),
        ));
        $options = Yii::app()->options; 
       $maxUploadSize = '4';
        $importCsv  = new ListCsvImport('upload');
        $webEnabled = $options->get('system.importer.web_enabled', 'yes') == 'yes';
		$maxUploadSize = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1) / 1024 / 1024;
		
        $this->render('_csv_impoter', compact('checkVersionUpdate','ads','usr','maxUploadSize','importCsv','webEnabled','options','type'));
    }    
    
    public function findCityFrmName($name){
		$city =  $name ;
		 
		 $criteria=new CDbCriteria;
		$criteria->select = 't.country_id,t.state_id,t.state_name';
	 $criteria->condition ='1';
	 
			$criteria->params[':lan'] = 'ar';
			$criteria->params[':city'] = '%'.$city.'%';
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->condition  .= ' and (CASE WHEN tdata.message IS NOT NULL THEN    tdata.message like :city or t.state_name like :city ELSE t.state_name like :city END  ) ';
			 
		 $citData = States::model()->find($criteria);
		 
		 
		 return $citData;
		 
	}
    public function findPurpose($name){
		 switch($name){
			 case 'For Sale':
			  return '1'; 
			 break;
			 case 'Property for Sale':
			  return '1'; 
			 break;
			 case 'Property for Rent':
			  return '2'; 
			 break;
			 case 'For Rent':
			  return '2'; 
			 break;
		 }
		
	}
    public function  findCategoryBayut($name){
		$cat_bayut_Array = 
		array(
			"3" => "115", //apartments
			"4" => "114",//villas
			"11" => "155",//rest-houses
			"12" => "175",//chalet
			"6" => "176",//residential-floors
			"13" => "171",//labour-camps
			"7" => "177",//hotel-apartments
			"24" => "177",//hotel-room
			"8" => "157",//residential-buildings
			"25" => "152",//palaces
			"9" => "121",//residential-lands
			"14" =>"127",//offices
			"15" =>"",//shops
			"16" =>"169",//showrooms
			"17" =>"157",//commercial-buildings
			"18" =>"173",//warehouses
			"19" =>"121",//commercial-lands
			"20" =>"121",//industrial-lands
			"21" =>"154",//farms
			"22" =>"158",//commercial-properties
			"23" =>"121",//agriculture-plots
		
		
		);
		 
		return isset($cat_bayut_Array[$name]) ? $cat_bayut_Array[$name]:''; 
	}
    public function findCategory($name){
		 
		 
		 $ategory_array = array(
			"AP"=>"115",
			"BW"=>"152",
			"CD"=>"153",
			"DX"=>"165",
			"FF"=>"115",
			"HF"=>"115",

			"LP"=>"121",
			"PH"=>"114",
			"TH"=>"114",
			"VH"=>"114",
			"WB"=>"157",
			"HA"=>"177",

			"LC"=>"171",
			"BU"=>"172",
			"WH"=>"173",
			"FA"=>"158",
			"OF"=>"127",
			"RE"=>"156",

			"LP"=>"121",
			"SH"=>"169",
			"SR"=>"169",
			"SA"=>"170",
		 
		 );
		 
		 return  $ategory_array[$name];
		 
		 
		  $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'   " ;
		 $criteria->select = "t.category_id,t.category_name "; 
			$criteria->params[':lan'] = 'ar';
			$criteria->params[':category'] ='%'.$name.'%';
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->condition .= ' and (CASE WHEN tdata.message IS NOT NULL THEN  tdata.message like :category or t.category_name like :category    ELSE t.category_name like :category END )   ';
			 
		 $CategoryData = Category::model()->find($criteria);
		 
		 
		 if(!empty($CategoryData)){
			 return array('category_id'=>$CategoryData->category_id);
		 }
		  
		  
		 
		  
	}
    public function findPrice($price){
		$price = Yii::t('app',$price,array('PKR'=>''));
		$price_seperate  = explode(' ',$price);
		if(is_array($price_seperate) and sizeOf($price_seperate)=='2'){
			$unitModel =  PriceUnit::model()->findByUnitValue($price_seperate['1']);
			if($unitModel){
			 $pricefirst  = Yii::t('app',$price_seperate['0'],array(' '=>'',','=>''));
			 $price = $pricefirst*$unitModel->value; 
			}
			  
		}
		 
		return   Yii::t('app',$price,array(' '=>'',','=>'')); 
	}
   public function findbuiltup_area($unit){
		$ar =array(); 
		
		  $ar['builtup_area'] = Yii::t('app',$unit,array(' '=>'',','=>''))  ; 
		return   $ar ; 
	}
   public function findareaunit($unit){
		$ar =array();
		switch($unit){
			
			case 'Sq. Ft.':
			return 1;
			break;
			case 'Sq. M.':
			return 6;
			break;
			case 'sqm':
			return 6;
			break;
			case 'sqft':
			return 1;
			break;
		}  
		$unitModel =  AreaUnit::model()->findByUnitValue($unit);
			if($unitModel){
			 return  $unitModel->master_id; 
			}
		return   6 ; 
	}
    public function findAmenities($amenities){
		$ar =array(); 
		$amenities_array  = explode(',',$amenities);
		$amenitiesList = (array)$amenities_array; 
		$amenitiesListArray = array(); 
		if(!empty($amenitiesList)){
			foreach($amenitiesList as $ameniti){
				$amenitiesListArray[] = trim(strtolower($ameniti));
			}
		}
		if(!empty($amenitiesListArray)){
			$amenitiesModel =  Amenities::model()->findfromArray($amenitiesListArray);
			
			return CHtml::listData($amenitiesModel,'amenities_id','amenities_id') ; 
		} 
		 
	}
    public function findLatitude($url){
		if(!empty($url)){
			
			 
			if (strpos($url,'https://maps.google.com/?q=') !== false) {
			$url =  Yii::t('app',$url,array('https://maps.google.com/?q='=>'')); 
			$url_seperate  = explode(',',$url);
				if(is_array($url_seperate) and sizeOf($url_seperate)=='2'){
				 return array('location_latitude'=>$url_seperate['0'],'location_longitude'=>$url_seperate['1']);
				}
			}
	   }
	}
	public function import_from(){
		 $type =  Yii::app()->request->getQuery('type','');
		 switch($type){
			case 'zameen':
			return  'zameen';
			break;
			case 'olx':
			return 'olx';
			break;
			case 'propertyfinder':
			return 'propertyfinder';
			break;
			case 'bayut':
			return 'bayut';
			break;
			default:
				throw new CHttpException(503, 'Property import type not set. Please contact developer.');
			break;
		}
		
		 }
    public function findSlug($url){
		if(!empty($url)){
			if($this->import_from()=='olx'){
				if (strpos(strtolower($url),'https://www.olx.com.pk/item/') !== false) {
					return   Yii::t('app',strtolower($url),array('https://www.olx.com.pk/item/'=>'','.html'=>'')); 
				}
			}
			else{
			if (strpos(strtolower($url),'https://www.zameen.com/property/') !== false) {
			return   Yii::t('app',strtolower($url),array('https://www.zameen.com/property/'=>'','.html'=>'')); 
			 
			}
			}
			
	   }
	}
    public function findOrInsertUser($details){
		if(!empty($details) and !empty($details['phone'])){
						  
						$phone = $details['phone'];
						$subscriber =   ListingUsers::model()->findByPhoneLast10($phone);
                        if(empty($subscriber)){   $subscriber  = new ListingUsers(); }
                        else{
							return $subscriber->primaryKey; 
						}
                        $subscriber->email = 'propof'.$phone.'@feeta.pk';
                        $subscriber->full_number = $details['full_number'];
                        $subscriber->phone = $phone ;
                        $subscriber->mobile = @$details['phonenumbers']  ;
                        $subscriber->first_name   = $details['agentname'] ;
                        $subscriber->company_name = $details['agentname']  ;
                        $subscriber->email_verified = '0' ;
                        $subscriber->o_verified = '1' ;
                        $subscriber->enable_l_f = '0' ;
                        $subscriber->user_type  = 'A';
                        $subscriber->email_verified  = '0';
                        //$subscriber->first_name  = $subscriber->company_name;
                        $subscriber->password  = 'FEETAPK';
                        $subscriber->con_password  = 'FEETAPK';
                        $subscriber->scenario  = 'frontend_insert';
                        if($subscriber->save()){
							return $subscriber->primaryKey; 
						}
						 
                        
					 
	   }
	}
	public function   is_rtl( $string ) {
		$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
		return preg_match($rtl_chars_pattern, $string);
	}
	 public function getTranslateCurl($meesage){
			$handle = curl_init();

			if (FALSE === $handle)
			throw new Exception('failed to initialize');

			curl_setopt($handle, CURLOPT_URL,'https://www.googleapis.com/language/translate/v2');
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			 if($this->is_rtl($meesage)  ){ $source = 'ar';$target = 'en';  }else{ $source = 'en';$target = 'ar';  }
			curl_setopt($handle, CURLOPT_POSTFIELDS, array('key'=> 'AIzaSyAY0-OgH2OLDs25xXI_Ei8hP4sTje0Wva4', 'format'=>'text','q' => $meesage, 'source' => $source , 'target' => $target));
			curl_setopt($handle,CURLOPT_HTTPHEADER,array('X-HTTP-Method-Override: GET'));
			$response = curl_exec($handle);

			$data = json_decode($response,true); 
			if(isset($data['data']['translations']['0']['translatedText'])){
				return   $data['data']['translations']['0']['translatedText']; 
			}

	 }
	public function saveAmenities($message,$relationID){
		
				$relation = 'am_id';
				$field = 'amenities_name';
				$id    = 'Amenities_'.$field.'_'.$relationID ;
				$lan   = 'ar';
			  
				$model =   Translate::model()->findByAttributes(array('source_tag'=>$id));
				
				if($model){
				$variable =  TranslationData::model()->findByAttributes(array('lang'=>$lan,'translation_id'=>$model->primaryKey));
				if($variable){
					$model->translation = $message; 
				}
				}
				else{
					$model = new Translate();
				}
				 
				$model->lan  = 'ar' ;
				$model->source_tag  =  $id;
				$model->translation = $message;
				if($model->save()){
					 $data = 	TranslationData::model()->findByAttributes(array('lang'=>$lan,'translation_id'=>$model->primaryKey));
				  if($data){ 
						$data->message =  $message  ;
						$data->save();
						
				  }
				  else{
						$data = new TranslationData();
						$data->translation_id =  $model->primaryKey;
						$data->lang 		  =  $lan;
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
				}
				 
	}
	
	public function amenitiesFetcher($list_amenities){
		
		
		$ar  = array(); 
		foreach($list_amenities as $k=>$amenities_name){
		$dynamic_value  = '';
		if (strpos($amenities_name, ':') !== false) {
			$am = explode(':',$amenities_name); 
			if($this->is_rtl($amenities_name)){
					$amenities_name = trim($am['0']);
					$dynamic_value  = trim($am['1']);
			}
			else{
				$amenities_name = trim($am['0']);
				$dynamic_value  = trim($am['1']);
			}
			 
		}		 
		$criteria=new CDbCriteria;
		$criteria->select = 't.amenities_id,t.f_type,t.amenities_name';
		$criteria->condition ='1';
		$criteria->params[':lan'] = 'ar';
		if(!$this->is_rtl($amenities_name)){  $amenities_str = strtolower($amenities_name); }else{ $amenities_str = $amenities_name; }
		$criteria->params[':amenities_name'] = '%'.$amenities_str.'%';
		$criteria->distinct = 't.amenities_id'; 
		$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.am_id = t.amenities_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
		$criteria->condition  .= ' and (CASE WHEN tdata.message IS NOT NULL THEN    LOWER(tdata.message) like :amenities_name or LOWER(t.amenities_name) like :amenities_name ELSE LOWER(t.amenities_name) like :amenities_name END  ) ';
		$found = Amenities::model()->find($criteria);
		if($found){
			if(empty($found->f_type)){
			$ar[$found->amenities_id] = $found->amenities_id;
			}
			else{
				$ar[$found->amenities_id] = !empty($dynamic_value) ? $dynamic_value  : 1;
			}
		}
		else{
			$translated = $this->getTranslateCurl($amenities_name);
			$translated = empty($translated) ? $amenities_name : $translated;
			if($this->is_rtl($amenities_name)){
				$savetext = $translated;
				$ar_text = $amenities_name;
			}
			else{
				$ar_text = $translated;
				$savetext = $amenities_name;
			}
			$Amenities = new Amenities();
			$Amenities->amenities_name = $savetext;
			$Amenities->master_id = 103;
			$Amenities->dy = 1;
			$Amenities->f_type =  !empty($dynamic_value) ? 1 :  0;
			$Amenities->status = 'A';
			if($Amenities->save()){
			$this->saveAmenities($ar_text,$Amenities->amenities_id);
			$ar[$Amenities->amenities_id] = !empty($dynamic_value) ? $dynamic_value : $Amenities->amenities_id;  
			}
			
		}
		}
		return $ar;
		 print_r($ar);exit;
		 
		 return $citData;
		 
		 
		
		$aqr  =  array(
		'BA'=>'341',
'BP'=>'288',
'BB'=>'373',
'AN'=>'295',
'BW'=>'386',//buitlinwardrobes
'CA'=>'387',//Carpets
'AC'=>'290',
'CP'=>'388',//Covered parking
'DR'=>'389',
'FF'=>'300',
'GZ'=>'390',//Gazebo
'PY'=>'374',//Private Gym
'PJ'=>'391',//Jacuzzi
'BK'=>'392',//Kitchen Appliances
'MR'=>'343',//Maids Room
'MB'=>'393',//Marble floors
'HF'=>'394',//On high floor
'LF'=>'395',//On low floor
'MF'=>'396',//On mid floor
'PA'=>'370',
'GA'=>'384',
'PG'=>'309',
'PP'=>'310',
'SA'=>'397',//Sauna
'SP'=>'310',
'WF'=>'398',//Wood flooring
'SR'=>'399',//Steam room
'ST'=>'301',
'UI'=>'400',//Upgraded interior
'GR'=>'401',//Garden view
'VW'=>'402',//Sea/Water view
'SE'=>'330',
'MT'=>'403',//Maintenance
'IC'=>'404',//Within a Compound
'IS'=>'405',//Indoor swimming pool
'SF'=>'406',//Separate entrance for females
'BT'=>'344',
'SG'=>'304',
'CV'=>'407',//Community view
'GV'=>'408',//Golf view
'CW'=>'409',//City view
'NO'=>'410',//North orientation
'SO'=>'411',//South orientation
'EO'=>'412',//East orientation
'WO'=>'413',//West orientation
'NS'=>'325',
'HO'=>'326',
'TR'=>'414',//Terrace
'NM'=>'332',
'SM'=>'415',//Near supermarket
'ML'=>'327',
'PT'=>'416',//Near public transportation
'MO'=>'417',//Near metro
'VT'=>'418',//Near veterinary
'BC'=>'419',//Beach access
'PK'=>'420',//Public parks
'RT'=>'328',
'NG'=>'421',//Near Golf
'AP'=>'422',//Near airport
'CS'=>'423',//Concierge Service
'SS'=>'338',
'SY'=>'374',
'MS'=>'424',//Maid Service
'WC'=>'425',//Walk-in Closet
'HT'=>'426',//Heating
'GF'=>'427',//Ground floor
'SV'=>'428',//Server room
'DN'=>'429',//Pantry
'RA'=>'430',//Reception area
'VP'=>'288',
'OP'=>'431',//Office partitions
'SH'=>'432',//Core and Shell
'CD'=>'433',//Children daycare
'CL'=>'434',//Cleaning services
'NH'=>'435',//Near Hotel
'CR'=>'339',
		);
	 
		$ar =array(); 
		 
		if(!empty($list_amenities)){
			foreach($list_amenities as $ameniti){
				if(isset($aqr[$ameniti]) and !empty($aqr[$ameniti])){
				    $amnid = Amenities::model()->findByPk($aqr[$ameniti]);
				    if(!empty( $amnid)){
    				    if(empty($amnid->f_type)){
    					    $ar[$aqr[$ameniti]]	=$aqr[$ameniti];
    				    }
    				    else{
    				        $ar[$aqr[$ameniti]]	= 1;
    				    }
    				    
				    }
				}
				//$amenitiesListArray[] =strtolower(@$aqr[$ameniti]);
			}
		}  
		 
		return $ar;
		/*
		if(!empty($amenitiesListArray)){
			$amenitiesModel =  Amenities::model()->findfromArray($amenitiesListArray);
			  
			return CHtml::listData($amenitiesModel,'amenities_id','amenities_name') ; 
		} 
		* */
		
		
		
	}
	
 
   public function actionCrawl($domain='olx',$url='')
    {
	//	echo "WER";exit;
        
   // echo 'logedin';exit;
        
        $data = $_POST; 
     
        $purpose = $data['Purpose'];
         if($_GET['type']=='graana'){
             $data['ImageUrl'] = Yii::t('app',$data['ImageUrl'],array('o_40,h'=>'o_0,h'));
         }
        
        if($_GET['type']=='olx'){
         $Category = $data['Category'];
         $data['Purpose'] = $Category;
         $data['Category'] = $purpose;
        }
         
        $columns =array_keys($data); 
         	    $field_check_array = array(
					'ad_title' => array( 'title') ,
					'ad_description' => array('description'),
					'bedrooms' => array('bedrooms'),
					'bathrooms' => array('bathrooms'),
					'area' => array('builtuparea'),
					'areaunitid' => array('size'),
					'price' => array('price'),
					'rental_period' => array('rental_period'),
					'phone' => array('phone_number'),
					'agentname' =>array('agent_name') ,
					'propertyid' => array('listing_id'),
					'location_latitude' => array('latitude'),
					'location_longitude' => array('longitude'),
					'city_id' => array('state'),
					'category' => array('category_id_abr'),
					'offering' => array('offering_type_id'),
					'imageurl' =>array('image_list') ,
					'amenities' =>array('amenities') ,
					'area_location' =>array('address') ,
					'url' =>array('share_url') ,
						'broker_id' => array('broker_id'),
						'price_on_application'=>'price_on_application',
						'purpose'=>'purpose',
					/*
					 
					 	
					'imageurl' =>array('imageurl') ,
					'LocationUrl' => array('locationurl'),
					
					* */
					 
					);
					
					  
					$find_array =array();
					foreach ($columns as $columnName) {
					 
						foreach($field_check_array as $k=>$check_columValue ){
							 
							$found_clmn = array_search(strtolower($columnName) ,(array)$check_columValue);
							 
							if( strlen($found_clmn)>=1){
								$find_array[$k] = strtolower($columnName);
								break;
							}
						}

					}
					
					
	 
					  $attribute_array = array();
				 
                    foreach ($data as $key=>$v) {
						
						$tag_name_small = strtolower($key);
						$tag_name_value = trim($v);
					 	
					
						if(empty($tag_name_value)){ continue;}
						
						 $attribute_name = array_search($tag_name_small,$find_array);
						 
		 
						 
						 if(strlen($attribute_name)>=1){
							 
							 
							 
							    if($attribute_name=='imageurl') { 
								  $imageList = array_filter(explode(',',$tag_name_value)); 
								  
								
								     if('graana'==$this->import_from()){
									    $imageList = array();
										$imageListi =array_filter(explode('GGGG',Yii::t('app',$tag_name_value ,array('.jpg,'=>'GGGG'))));	
										 
										if(!empty($imageListi)){
											foreach($imageListi as $ki=>$vi){
												$imageList[] =  $vi.'.jpg' ;
											}
										}
										 
								   }
								   
								  
								  if(!empty($imageList)){
									  $attribute_array['images'] = array();
									  $cmn = 1; 
									foreach($imageList as $k=>$file){  
										 
										if($cmn>='8') { continue; }
										$file = trim($file);
									  	$file_format = 'jpeg';
										$img =date('Y-m-d-h-i-s').'-'.rand(0,9999).'-'.time().".".$file_format;
										$path_file =  Yii::getPathOfAlias('root.uploads.files');
										$year_folder = $path_file .'/'. date("Y");
										$month_folder = $year_folder . '/' . date("m");
										$month_folder2 = date("Y"). '/' . date("m");
										!file_exists($year_folder) && mkdir($year_folder , 0777);
										!file_exists($month_folder) && mkdir($month_folder, 0777);
										$path_file = $month_folder ;

										file_put_contents( $path_file."/{$img}", file_get_contents($file)); 
									 
										$tag_name_value =   $month_folder2. '/' .$img;   ; 
										$attribute_array['images'][] = $tag_name_value;
										$attribute_array['images_upload'][$tag_name_value] =  array('path'=>$path_file."/{$img}",'file'=>$file);
										$cmn++;
									}
								   
								  }
								    
							    } 
							  
							    if($attribute_name=='city_id') { 
									 if('bayut'==$this->import_from()){
										$tag_name_value  = Yii::t('app',$tag_name_value,array(';'=>''));
									 } 
								   if (strpos($tag_name_value, 'riyadh') !== false or strpos($tag_name_value, 'الرياض') !== false   ) {
									   $tag_name_value = 'Riyadh';
								   }
								   
								  
								   $cityModel = $this->findCityFrmName($tag_name_value);
								  
								   if(!empty($cityModel)){
									  // $attribute_array['city'] = $cityModel->city_id; 
									   $attribute_array['state'] = $cityModel->state_id; 
									   $attribute_array['country'] = $cityModel->country_id; 
									    
									   unset($attribute_array['city_id']); 
								   }
								   else{
									    $attribute_array['country'] = '65949'; 
								   }
								   
							    } 
							    if($attribute_name=='price_on_application') {
							           if($tag_name_value=="true"){
							               $attribute_array['p_o_r'] = '1';
							           } 
							    } 
							    
							    if($attribute_name=='broker_id') {
							         if(!empty($tag_name_value)){
										 if('bayut'==$this->import_from()){
											 $user_found = ListingUsers::model()->findByAttributes(array('by_id'=>(int)$tag_name_value));
										 }else{
											$user_found = ListingUsers::model()->findByAttributes(array('pf_id'=>(int)$tag_name_value));
										}
							            if($user_found){
							                $attribute_array['user_id'] = $user_found->user_id;
							            }
							         }
								    
								   
							    } 
							    if($attribute_name=='price') { 
									if('bayut'==$this->import_from()){
										$attribute_array['p_o_r'] = empty($tag_name_value) ? '1' : '';
									}
								   $tag_name_value = $this->findPrice($tag_name_value);
								   
							    } 
							    if($attribute_name=='bathrooms') { 
								   $tag_name_value =  (int) $tag_name_value;
								   
							    } 
							    if($attribute_name=='area_location') { 
								   if('bayut'==$this->import_from()){
								   $tag_name_value = Yii::t('app',$tag_name_value,array(';'=>''));
									}
								   
							    } 
							    if($attribute_name=='offering') {
									//echo"WER";exit;
									if('bayut'==$this->import_from()){
										switch($tag_name_value){
										case '1':
										$attribute_array['listing_type'] =  '150';
										break;
										case '2':
										$attribute_array['listing_type'] =  '151';
										break;
										}
										
									}else{
									$tag_name_value = strtolower($tag_name_value);
									switch($tag_name_value){
										case '4':
										$attribute_array['listing_type'] =  '151';
										$attribute_array['section_id'] =  '2';
										break;
										case '3':
										$attribute_array['listing_type'] =  '151';
										$attribute_array['section_id'] =  '1';
										break;
										case '1':
										$attribute_array['listing_type'] =  '150';
										$attribute_array['section_id'] =  '1';
										break;
										case '2':
										$attribute_array['listing_type'] =  '150';
										$attribute_array['section_id'] =  '2';
										break;
									} 
								   $tag_name_value =  (int) $tag_name_value;
								 }
								   
							    } 
							    if($attribute_name=='rental_period') { 
							        	if('bayut'==$this->import_from()){
							        	    $tag_name_value = strtolower($tag_name_value);
    							        	switch($tag_name_value){
    										case 'yearly':
    										$attribute_array['rent_paid'] =  'yearly';
    										break;
    										case 'monthly':
    										$attribute_array['rent_paid'] =  'monthly';
    										break;
    										case 'daily':
    										$attribute_array['rent_paid'] =  'Daily';
    										break;
    									 
    									    }
							        	}else{
									switch($tag_name_value){
										case 'sell':
										$attribute_array['section_id'] =  '1';
										$attribute_array['rent_paid'] =  '';
										break;
										case 'yearly':
										$attribute_array['section_id'] =  '2';
										$attribute_array['rent_paid'] =  'yearly';
										break;
										case 'monthly':
										$attribute_array['section_id'] =  '2';
										$attribute_array['rent_paid'] =  'monthly';
										break;
										case 'daily':
										$attribute_array['section_id'] =  '2';
										$attribute_array['rent_paid'] =  'Daily';
										break;
										case 'weekly':
										$attribute_array['section_id'] =  '2';
										 
										break;
									}
									$tag_name_value =  (int) $tag_name_value;
							        	}
									 
								   
								   
							    } 
							    if($attribute_name=='purpose') { 
									switch($tag_name_value){
										case '1':
										$attribute_array['section_id'] =  '1';
										break;
										case '2':
										$attribute_array['section_id'] =  '2';
										break; 
									}
									 
								   
							    } 
							    if($attribute_name=='area') { 
								   $unitModel = $this->findbuiltup_area($tag_name_value);
								    if(!empty($unitModel)){
									    
									   if(isset($unitModel['builtup_area'])){
										   $attribute_array['builtup_area'] = $unitModel['builtup_area']; 
									   }
								   }
								   
							    } 
							    if($attribute_name=='areaunitid') { 
								   $attribute_array['area_unit']= $this->findareaunit($tag_name_value);
								     
								   
							    } 
							    if($attribute_name=='amenities') { 
									 if('graana'==$this->import_from()){
										 $amenities_list =  json_decode($tag_name_value,true);  
										 if(!empty($amenities_list)){
											
											 $tag_name_value = implode(',',array_keys($amenities_list)); 
											  $Ar1 = $this->findAmenities(Yii::t('app',$tag_name_value,array('_'=>' ')));
											  
											 
											   if(isset($data['furnished']) and $data['furnished']=='YES'){
												   $Ar1['293'] = '293';
											    }
											    
											   
											    $tag_name_value = $Ar1;
										 }
									 }
									 if(in_array($this->import_from(),array('propertyfinder','bayut'))){
									 
										 $amenities_list =  array_filter(explode(',',$tag_name_value));  
										 //print_r($tag_name_value );exit;
										 $Ar1 = array();
										 if(!empty($amenities_list)){
											 
											  $Ar1 = $this->amenitiesFetcher($amenities_list);
											   //print_r( $Ar1);exit;
										 }
										  $tag_name_value = $Ar1;
									 }
									 else{
										  $tag_name_value = $this->findAmenities($tag_name_value);
									 }
								  
								    
							    } 
							   
							    if($attribute_name=='category') { 
									if('bayut'==$this->import_from()){
										$attribute_array['category_id'] = $this->findCategoryBayut($tag_name_value);
									}else{
										$attribute_array['category_id'] = $this->findCategory($tag_name_value);
									}
								   
							    } 
							    if($attribute_name=='LocationUrl') { 
								   $LocationUrlModel = $this->findLatitude($tag_name_value);
								   if(!empty($LocationUrlModel)){
									   if(isset($LocationUrlModel['location_latitude'])){
										   $attribute_array['location_latitude'] = $LocationUrlModel['location_latitude']; 
									   }
									   if(isset($LocationUrlModel['location_longitude'])){
										   $attribute_array['location_longitude'] = $LocationUrlModel['location_longitude']; 
									   }
								   }
								   
							    } 
							  if($attribute_name=='phone') { 
								    $tag_name_value = Yii::t('app',$tag_name_value,array('-'=>''));
									$attribute_array['full_number'] =  $tag_name_value ; 
									 
								 
								   
							    }
							  if($attribute_name=='agentname') { 
									$attribute_array['contact_person'] =  $tag_name_value ; 
							  }
							   if($attribute_name=='propertyid') { 
									$attribute_array['p_id'] =  $tag_name_value ; 
							  }
							  if($attribute_name=='phone') { 
									$attribute_array['mobile_number'] =  $tag_name_value ; 
							   }
								
							  if($attribute_name=='url') { 
								     $slug = $this->findSlug($tag_name_value);
								      $attribute_array['p_url'] = $tag_name_value; 
								     $attribute_array['slug_z'] = $slug; 
								 
							   }
								
								$attribute_array[$attribute_name] = $tag_name_value; 
						 }
                        	
			
                        
                         
                    }
                    
                  // print_r($attribute_array);exit;
             
                        //$user_id  = $this->findOrInsertUser($attribute_array);
                    //$attribute_array['user_id'] = $user_id;
            unset(	$attribute_array['rental_period']);        
            unset(	$attribute_array['city_id']);        
            unset(	$attribute_array['category']);        
            unset(	$attribute_array['LocationUrl']);        
             unset(	$attribute_array['area']); unset($attribute_array['city_id']); 
             unset($attribute_array['url']);unset($attribute_array['imageurl']);
             unset($attribute_array['slug_z']);unset($attribute_array['phone']);
             unset($attribute_array['images_upload']); unset($attribute_array['category']);
        
            switch($_GET['type']){
                 case 'olx':
                 $cacheKey = 'olx-cookie' ;	
                 $import_from = 'olx_import';
                 break;
                 case 'graana':
                 $cacheKey = 'graana-cookie' ;
                 $import_from = 'graana_import';
                 break;
                 case 'bayut':
                 $cacheKey = 'bayut-cookie' ;
                 $import_from = 'bayut_import';
                 break;
                 case 'propertyfinder':
                 $cacheKey = 'propertyfinder-cookie' ;
                 $import_from = 'propertyfinder_import';
                 break;
            }
            
            
           
            
            Yii::app()->cache->set($cacheKey, $attribute_array, 60*60*15);
              
            $this->redirect(Yii::app()->createUrl('place_property/create',array('imp'=>$import_from)));
	if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
		echo $items ;  
	}
            exit;        

         exit;
        
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
	 
		$_GET['status'] = $status;
		 
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['select_action'];
               
				  
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
         
		
		$tit = 'Crawl';
         $this->getData('pageScripts')->add(array('src' => Yii::App()->apps->getBaseUrl('assets/js/scrol_main_new.js'), 'priority' => -100));
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Crawl"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('crawl', compact('domain','url'));
    }
}
