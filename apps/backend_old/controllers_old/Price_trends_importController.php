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
 
class Price_trends_importController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 
    public function actionCsv_import()
    {
        $list     = array();
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
        ini_set('auto_detect_line_endings', true);

        $import = new ListCsvImport('upload');
        $import->file_size_limit = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1); // 1 mb
        $import->attributes      = (array)$request->getPost($import->modelName, array());
        $import->file            = CUploadedFile::getInstance($import, 'file');

        if (!empty($import->file)) {
            if (!$import->upload()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                $notify->addError($import->shortErrors->getAllAsString());
                $this->redirect(array('dashboard/Create_import'));
            }

            $this->setData(array(
                'pageMetaTitle'     => $this->data->pageMetaTitle.' | '.Yii::t('list_import', 'Price Trends Import'),
                'pageHeading'       => Yii::t('list_import', 'Price Trends Import'),
             
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
         

            $foundReservedColumns = array();
            $field_check_array = array(
					'email' => array('Email','email') ,
					'state_id' => array('city'),
					'first_name' => array('name'),
					'company_name' => array('company'),
					'phone' => array('mobile'),
					'mobile' => array('phone'),
					'sa' => array('servicearea'),
					'lu' =>array('logourl') ,
					'ptypes' =>array('propertytypes') ,
					'for' => array('propertiesfor'),
					'description' => array('description'),
					 
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
            /*
            foreach ($data as $index => $fields) {
                foreach ($fields as $detail) {
                    if ($detail['tagName'] == 'EMAIL' && !empty($detail['tagValue'])) {
                        $email = $detail['tagValue'];
                       
                        break;
                    }
                }
            }
            $failures = (array)Yii::app()->hooks->applyFilters('list_import_data_bulk_check_failures', array(), (array)$bulkEmails);
            foreach ($failures as $email => $message) {
                EmailBlacklist::addToBlacklist($email, $message);
            }
            // end 1.3.5.9
			*/
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
 
 
            $transaction = Yii::app()->getDb()->beginTransaction();
            $mustCommitTransaction = true;

            try {
                 
                $model = new PriceTrends();
                $attribute_array = array();
			 
				$company_grade_value = array();
				$company_type_value = array();
				
				
                foreach ($data as $index => $fields) {
					
					
					  $attribute_array = array();
				  
                    foreach ($fields as $detail) {
						
						$tag_name_small = strtolower($detail['tagName']);
						$tag_name_value = strtolower(trim($detail['tagValue']));
						if(empty($tag_name_value)){ continue;}
						
						if($tag_name_small=='city'){
						  $stateModel = 	States::model()->findByAttributes(array('state_name'=>$tag_name_value));
						  if(!empty($stateModel)){ $model->state_id = $stateModel->primaryKey; }
						}
					
						if($tag_name_small=='sector'){
						      switch($tag_name_value){
							  case 'sale':
							   $model->sect_id = 1;
							  break;
							  case 'rent':
							   $model->sect_id = 2;
							  break;
						      }
						  
						}
						
						if($tag_name_small=='category'){
									switch($tag_name_value){
									case 'residential':
									$model->cat_id = 150;
									break;
									case 'commercial':
									$model->cat_id = 151;
									break;
									}
						}
						if($tag_name_small=='type'){
						  $typeModel = 	Category::model()->findByAttributes(array('category_name'=>$tag_name_value,'isTrash'=>'0','status'=>'A'));
						  if(!empty($typeModel)){ $model->type_id = $typeModel->primaryKey; }
						}
						if($tag_name_small=='price'){
						    $model->price = $tag_name_value;  
						}
						if($tag_name_small=='beds'){
						    $model->bed  = $tag_name_value;  
						}
						if($tag_name_small=='month'){
						    $model->month  = $tag_name_value;  
						}
						if($tag_name_small=='year'){
						    $model->year  = $tag_name_value;   
						}
						if($tag_name_small=='rowid'){
						    $model->rowid  = $tag_name_value;   
						}
						 
						
						 $attribute_name = array_search($tag_name_small,$find_array);
						 
						  
			
                        
                         
                    }
                    if(!empty($model->month) and !empty($model->year)){
						$model->g_date =  date('Y-m-1',strtotime("$model->year-$model->month-1")); 
					}
                   
					$reason = ''; 
					if(empty($model->state_id)){ $reason .= 'City not found, '; }
					if(empty($model->sect_id)){ $reason .= 'Sector not found, '; }
					if(empty($model->cat_id)){ $reason .= 'category not found, '; }
					if(empty($model->type_id)){ $reason .= 'Type not found, '; }
					if(empty($model->g_date)){ $reason .= 'Date not found, '; }
					if(empty($model->price)){ $reason .= 'Price not found, '; }
                    if (!empty($reason) ) {
                        $importLog[] = array(
                            'type'    => 'error',
                            'message' => Yii::t('list_import', 'Failed to save rowid  "{price}" , {reason}', array(
                                '{price}'  => CHtml::encode($model->rowid),
                                '{reason}'  => CHtml::encode($reason),
                                 
                            )),
                            'counter' => true,
                        );
                        continue;
                    }

                    $subscriber = null;
                    $subscriber = PriceTrends::model()->findByAttributes(array('state_id'   => $model->state_id ,'sect_id'=>$model->sect_id ,'cat_id'=>$model->cat_id  , 'type_id'=> $model->type_id ,'g_date'=>$model->g_date ,'bed'=>$model->bed ));
					if (empty($subscriber)) {
						$subscriber = PriceTrends::model()->findByAttributes(array('state_id'   => $model->state_id ,'sect_id'=>$model->sect_id ,'cat_id'=>$model->cat_id , 'type_id'=> $model->type_id ,'g_date'=>$model->g_date ));
					}

                    if (empty($subscriber)) {

                        $importLog[] = array(
                            'type'    => 'info',
                            'message' => Yii::t('list_import', 'The rowid "{rowid}" was not found, we will try to create it...', array(
                                '{rowid}' => CHtml::encode($model->rowid),
                            )),
                            'counter' => false,
                        );

                        $subscriber  = new PriceTrends();
                       }
                       
                        $subscriber->attributes = $model->attributes; 
						
                        if ($subscriber->hasErrors() || !$subscriber->save()) {
							
                            $importLog[] = array(
                                'type'    => 'error',
                                'message' => Yii::t('list_import', 'Failed to save the rowid "{rowid}", reason: {reason}', array(
                                    '{rowid}'  => CHtml::encode($model->rowid),
                                    '{reason}' => '<br />'.$subscriber->shortErrors->getAllAsString()
                                )),
                                'counter' => true,
                            );
                            continue;
                        }
                        else { 
							
						}

                        $listSubscribersCount++;
                        $totalSubscribersCount++;

                      

                        $importLog[] = array(
                            'type'    => 'success',
                            'message' => Yii::t('list_import', 'The rowid "{rowid}" has been successfully saved.', array(
                                '{rowid}' => CHtml::encode($model->rowid),
                            )),
                            'counter' => true,
                        );

                    

                  

                    unset($data[$index]);
                    ++$importCount;

                    if ($finished) {
                        break;
                    }
                }

                $transaction->commit();
                $mustCommitTransaction = false;

            } catch(Exception $e) {

                if (isset($file)) {
                    unset($file);
                }

                if (is_file($filePath.$import->file_name)) {
                    @unlink($filePath.$import->file_name);
                }

                $transaction->rollback();
                $mustCommitTransaction = false;

                return $this->renderJson(array(
                    'result'  => 'error',
                    'message' => $e->getMessage(),
                ));
            }

            if ($mustCommitTransaction) {
                $transaction->commit();
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
   
   
    public function actionCreate_import()
    {
		  
        
      
       
        $this->setData(array(
            'pageMetaTitle'     => Yii::app()->name . ' | ' . Yii::t('dashboard', 'Price Trends Import'), 
            'pageHeading'       => Yii::t('dashboard', 'Price Trends Import'),
            'pageBreadcrumbs'   => array(
                Yii::t('dashboard', 'Price Trends Import'),
            ),
        ));
        $options = Yii::app()->options; 
       $maxUploadSize = '4';
        $importCsv  = new ListCsvImport('upload');
        $webEnabled = $options->get('system.importer.web_enabled', 'yes') == 'yes';
		$maxUploadSize = (int)$options->get('system.importer.file_size_limit', 1024 * 1024 * 1) / 1024 / 1024;
		
        $this->render('_csv_impoter', compact('checkVersionUpdate','ads','usr','maxUploadSize','importCsv','webEnabled','options'));
    }   
   

}
