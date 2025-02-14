<?php defined('MW_PATH') || exit('No direct script access allowed');

class Place_propertyController  extends Controller
{

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public $Controlloler_title = 'Properties';
    public $focus = 'country';
    public $member;
    public $tag;
    public $project_name;

    public function init()
    {
        $this->tag = Yii::app()->tags;
        $this->project_name = Yii::app()->options->get('system.common.site_name');

        parent::Init();
    }

    public function actionExport_properties($datepicker = null, $todatepicker = null, $type = null)
    {

        Yii::app()->db->createCommand('SET SQL_BIG_SELECTS = 1')->execute();
        $criteria = new CDbCriteria;
        $criteria->select = 't.*,mr.name as district_name,(CASE WHEN t.user_updated IS NOT NULL THEN  t.user_updated ELSE t.last_updated END) as last_updated, usr.company_name,lstype.category_name as listing_category ,  usr.full_number as mobile_number ,  cat.category_name as  category_name , st.state_name as state_name,  usr.image as user_image,usr.first_name,usr.first_name_ar,usr.last_name,usr.email as user_email';

        $criteria->compare('t.status', 'A');
        if (!empty($datepicker)) {
            $criteria->condition .= ' and     DATE(t.date_added) >= :custom_date ';
            $criteria->params[':custom_date'] = date('Y-m-d', strtotime($datepicker));
        }
        if (!empty($todatepicker)) {
            $criteria->condition .= ' and     DATE(t.date_added) <= :custom_date1 ';
            $criteria->params[':custom_date1'] = date('Y-m-d', strtotime($todatepicker));
        }
        $criteria->distinct =  't.id';
        $criteria->select .= ',  (t.builtup_area*(1/au.value))   as converted_unit ,au.master_name as atitle';

        $criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
        $criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
        $criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
        $criteria->join  .= ' left join {{main_region}} mr ON st.region_id = mr.region_id ';
        $criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
        $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
        $criteria->join  .=   ' LEFT JOIN {{listing_users}} pusr on pusr.user_id = usr.parent_user ';

        $criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';

        $criteria->select .=  ' ,  (CASE WHEN usr.licence_no  is NOT NULL  then  usr.licence_no ELSE pusr.licence_no END ) as licence_no , usr.user_type  ';
        $criteria->select .=  ' ,  (CASE WHEN usr.a_number  is NOT NULL  then  usr.a_number ELSE pusr.a_number END ) as a_number  ';
        $criteria->select .=  ' ,  (CASE WHEN usr.cr_number  is NOT NULL  then  usr.cr_number ELSE pusr.cr_number END ) as cr_number ';
        $criteria->select .=  ' ,  (CASE WHEN usr.a_chara_ar is NOT NULL  then  usr.a_chara_ar ELSE pusr.a_chara_ar END ) as advertiser_character ';
        $criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete"  ';

        $criteria->condition .= PlaceAnAd::model()->getExpityConditionFronEnd();
        $criteria->order = 't.id asc';

        $langaugae = 'ar';
        if (!empty($langaugae) and  $langaugae != 'en') {
            //	$criteria->condition  .= ' and  use SET SQL_BIG_SELECTS=1 ';

            $criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
            $criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';

            /*
            $criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = ct.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
            $criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE ct.city_name  END as  city_name  ';
            */
            $criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
            $criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';

            $criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
            $criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';

            $criteria->distinct   = 't.id';
            $criteria->params[':lan'] = $langaugae;
        }

        // $criteria->condition  .= ' and  use SET SQL_BIG_SELECTS=1 ';
        $ad = PlaceAnAd::model()->findAll($criteria);
        if (empty($ad)) {
            //  throw new CHttpException( 404, Yii::t( 'app', 'No records found to export.' ) );
        }
        $file_name_new  = 'aavenue_' . date('Ymd_His');

        $fields = array(

            'A' => 'Ad_Id',
            'B' => 'Advertiser_character',
            'C' => 'Advertiser_name',
            'D' => 'Number from General',
            'E' => 'The_main_type_of_ad',
            'F' => 'Ad_description',
            'G' => 'Ad_subtype',
            'H' => 'Advertisement_publication_date',
            'I' => 'Ad_update_date',
            'J' => 'Ad_expiration',
            'K' => 'Ad_status',
            'L' => 'Ad_Views',
            'M' => 'District_Name',
            'N' => 'City_Name',
            'O' => 'Neighbourhood_Name',
            'P' => 'Street_Name',
            'Q' => 'Longitude',
            'R' => 'Lattitude',
            'S' => 'Furnished',
            'T' => 'Kitchen',
            'U' => 'Air_Condition',
            'V' => 'facilities',
            'W' => 'Using_For',
            'X' => 'Property_Type',
            'Y' => 'The_Space',
            'Z' => 'Land_Number',
            'AA' => 'Plan_Number',
            'AB' => 'Number_Of_Units',
            'AC' => 'Floor_Number',
            'AD' => 'Unit_Number',
            'AE' => 'Rooms_Number',
            'AF' => 'Rooms_Type',
            'AG' => 'Real_Estate_Facade',
            'AH' => 'Street_Width',
            'AI' => 'Construction_Date',
            'AJ' => 'Rental_Price',
            'AK' => 'Selling_Price',
            'AL' => 'Selling_Meter_Price',
            'AM' => 'Property_limits_and_lenghts',
            'AN' => 'Mortgage_Or_Restriction',
            'AO' => 'Rights_and_obligations_not_documented',
            'AP' => 'Info_affecting_on_the_Property',
            'AQ' => 'Property disputes',
            'AR' => 'Availability of elevators',
            'AS' => 'Number of elevators',
            'AT' => 'Availability of Parking',
            'AU' => 'Number of parking',
            'AV' => 'Advertiser category',
            'AW' => 'Advertiser license number',
            'AX' => "Advertiser's email",
            'AY' => 'Advertiser_registration_number',
            'AZ' => 'Authorization_number',

        );

        if ($type == 'xl') {

            Yii::import('common.extensions.excel.Classes.PHPExcel');
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator('Redspider')
                ->setLastModifiedBy('Redspider')
                ->setTitle('Office 2007 XLSX Agents Data')
                ->setSubject('Office 2007 XLSX Agents Data')
                ->setDescription('Pakistan Agents Data.')
                ->setKeywords('office 2007 openxml php')
                ->setCategory('Agents Data file');

            // Add some data
            $objPHPExcel->setActiveSheetIndex(0);
            $i = 1;
            foreach ($fields as $key => $v) {
                $objPHPExcel->getActiveSheet()->setCellValue($key . $i, $v);
            }

            //$objPHPExcel->getActiveSheet()->setCellValue( 'D1', 'Fax' );
            //$objPHPExcel->getActiveSheet()->setCellValue( 'E1', 'Is Client ?' );

            // Miscellaneous glyphs, UTF-8
            $i = 2;

            if (!defined('LANGUAGE')) {
                define('LANGUAGE', 'ar');
            }
            if (!empty($ad)) {
                foreach ($ad as $k => $v) {

                    //	print_r( array_filter( $v->attributes ) );
                    exit;
                    //	echo $v->id;
                    echo '<br />';
                    $statistcs = StatisticsPage::model()->pageCount('', $v->id);

                    $facilities = '';

                    $ameniesData = $v->all_amentitie();
                    $amenieArray = array();
                    if (!empty($ameniesData)) {
                        foreach ($ameniesData as $k2 => $v2) {
                            if ($v2->inp_val == '8') {
                                $v2->inp_val = '8+';
                            }
                            $vals = !empty($v2->inp_val) ? $v2->inp_val : '';

                            $amenieArray[$v2->amenities_id] = $vals;
                            $facilities .= $v2->amenities_name . ',';
                        }
                    }
                    $cdat = $v->CdateTitle;

                    $adv_char = $v->ArabicCharacter;
                    $fields = array(
                        'A' => $v->id, //Ad_Id
                        'B' => !empty($adv_char) ? $adv_char : '0', //Advertiser_character
                        'C' => $v->OwnerName, //'Advertiser_name'
                        'D' => $v->mobile_number, //Advertiser_mobile_number
                        'E' => $v->SecNewTitleNew, //The_main_type_of_ad
                        'F' => $v->AdDescription2, //'Ad_description'
                        'G' => $v->listing_category . ' , ' . $v->category_name, //Ad_subtype
                        'H' => $v->adDateAdded(), //Advertisement_publication_date
                        'I' => $v->adDateUpdated(), //'Ad_update_date'
                        'J' => $v->adExpiryDate(), //Ad_expiration
                        'K' => $v->status == 'A' ? '1' : '0', //'Ad_status'
                        'L' => $statistcs->s_count, //Ad_Views
                        'M' => $v->district_name, //District_Name
                        'N' => $v->state_name, //'City_Name'
                        'O' => $v->state_name, //Neighbourhood_Name
                        'P' => $v->AreaLocation, //'Street_Name'
                        'Q' => $v->location_latitude, //Longitude
                        'R' => $v->location_longitude, //'Lattitude'
                        'S' => isset($amenieArray['293']) ? 'Yes' : '0', //Furnished
                        'T' => isset($amenieArray['300']) ? 'Yes' : '0', //Kitchen
                        'U' => isset($amenieArray['290']) ? 'Yes' : '0', //Air_Condition
                        'V' => $facilities, //facilities
                        'W' => $v->SecNewTitleNew2, //Using_For
                        'X' => $v->category_name, //Property_Type
                        'Y' => $v->BuiltUpArea, //The_Space
                        'Z' => !empty($v->l_no) ? $v->l_no : '0', //Land_Number
                        'AA' => !empty($v->plan_no) ? $v->plan_no : '0', //Plan_Number
                        'AB' => !empty($v->no_of_u) ? $v->no_of_u : '0', //Number_Of_Units
                        'AC' => !empty($v->floor_no) ? $v->floor_no : '0', //Floor_Number
                        'AD' => !empty($v->unit_no) ? $v->unit_no : '0', //Unit_Number
                        'AE' => '0', //Rooms_Number
                        'AF' => 'No', //Rooms_Type
                        'AG' => !empty($v->r_facade) ? $v->r_facade : '0', //Real_Estate_Facade
                        'AH' => '0', //Street_Width
                        'AI' => !empty($cdat) ? $cdat : '0', //Construction_Date
                        'AJ' => $v->section_id == '2' ? $v->PriceTitleSimpleRent : '', //Rental_Price
                        'AK' => $v->section_id == '1' ? $v->PriceTitleSimple : '', //'Selling_Price'
                        'AL' => !empty($v->selling_price) ? $v->selling_price_total : '0', //Selling_Meter_Price
                        'AM' => !empty($v->p_limits) ? $v->p_limits : '0', //Property limits and lenghtsp_limits
                        'AN' => !empty($v->is_mor) ? $v->is_mor : '0', //Is there a mortgage or restriction that prevents or limits the use of the property
                        'AO' => !empty($v->rights) ? $v->rights : '0', //Rights and obligations over real estate that are not documented in the real estate document
                        'AP' => !empty($v->may_affect) ? $v->may_affect : '0', //Information that may affect the property
                        'AQ' => !empty($v->disputes) ? $v->disputes : '0', //Property disputes
                        'AR' => isset($amenieArray['345']) ? 'Yes' : '0', //Availability of elevators
                        'AS' => isset($amenieArray['345']) ? $amenieArray['345'] : '0', //Number of elevators
                        'AT' => isset($amenieArray['475']) ? 'Yes' : '0', //Availability of Parking
                        'AU' => isset($amenieArray['475']) ? $amenieArray['475'] : '0', //Number of parking
                        'AV' => $v->TypeTileNew, //Advertiser category
                        'AW' => !empty($v->licence_no) ? $v->licence_no : '0', //Advertiser license number
                        'AX' => $v->user_email, //Advertiser's emailr
                        'AY' => !empty($v->cr_number) ? $v->cr_number : '0', //Advertiser registration number
                        'AZ' => !empty($v->a_number) ? $v->a_number : '0', //Authorization number

                    );

                    foreach ($fields as $k2 => $v2) {

                        $objPHPExcel->getActiveSheet()->setCellValue($k2 . $i, $v2);
                    }

                    $i++;
                }
            }
            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('data');


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;
                        filename = "' . $file_name_new . '.xlsx"');
            header('Cache-Control: max-age = 0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        }/*else{
	
 
	$delimiter = ",";
	$filename = $file_name_new. ".csv";
  	
	$f = fopen('php://memory', 'w' );
    
    //set column headers
 
     fputcsv($f, $fields, $delimiter);
  
    //output each row of the data, format line as csv and write to file pointer
		foreach($ad as $k=>$v){
			
		//	echo $v->id; echo '<br />';
		
		$statistcs = StatisticsPage::model()->pageCount('',$v->id);
		   $lineData = 
		   $fields = array(
		
		'A'=>$v->id,//Ad_Id
		'B'=>'-',//Advertiser_character
		'C'=>$v->OwnerName ,//'Advertiser_name'
		'D'=>$v->mobile_number,//Advertiser_mobile_number
		'E'=>$v->SecNewTitle,//The_main_type_of_ad
		'F'=>$v->AdDescription2,//'Ad_description'
		'G'=>$v->listing_category.', '.$v->category_name,//Ad_subtype
		'H'=>$v->dateAdded,//Advertisement_publication_date
		'I'=>$v->lastUpdated,//'Ad_update_date'
		'J'=>'-',//Ad_expiration
		'K'=>$v->status=='A' ? '1' :'0',//'Ad_status'
		'L'=>	$statistcs->s_count,//Ad_Views
		'M'=>'-',//District_Name
		'N'=>$v->state_name,//'City_Name'
		'O'=>'-',//Neighbourhood_Name
		'P'=>$v->AreaLocation,//'Street_Name'
		'Q'=>$v->location_latitude,//Longitude
		'R'=>$v->location_longitude,//'Lattitude'
		'S'=>isset($amenieArray['293']) ? 'Yes' : '-',//Furnished
		'T'=>isset($amenieArray['300']) ? 'Yes' : '-',//Kitchen
		'U'=>isset($amenieArray['290']) ? 'Yes' : '-',//Air_Condition
		'V'=>$facilities,//facilities
		'W'=>'',//Using_For
		'X'=>$v->category_name,//Property_Type
		'Y'=>'',//The_Space
		'Z'=>'',//Land_Number
		'AA'=>'',//Plan_Number
		'AB'=>'',//Number_Of_Units
		'AC'=>'',//Floor_Number
		'AD'=>'',//Unit_Number
		'AE'=>'',//Rooms_Number
		'AF'=>'',//Rooms_Type
		'AG'=>'',//Real_Estate_Facade
		'AH'=>'',//Street_Width
		'AI'=>'',//Construction_Date
		'AJ'=>$v->section_id=='2' ? $v->PriceTitleSimpleRent: '' ,//Rental_Price
		'AK'=> $v->section_id=='1' ?$v->PriceTitleSimple:'',//'Selling_Price'
		'AL'=>$v->selling_price,//Selling_Meter_Price
		'AM'=>'',//Property limits and lenghts
		'AN'=>'',//Is there a mortgage or restriction that prevents or limits the use of the property
		'AO'=>'',//Rights and obligations over real estate that are not documented in the real estate document
		'AP'=>'',//Information that may affect the property
		'AQ'=>'',//Property disputes
		'AR'=>isset($amenieArray['345']) ? 'Yes' : '-',//Availability of elevators
		'AS'=>isset($amenieArray['345']) ? $amenieArray['345'] : '-',//Number of elevators
		'AT'=>isset($amenieArray['475']) ? 'Yes' : '-',//Availability of Parking
		'AU'=>isset($amenieArray['475']) ? $amenieArray['475'] : '-',//Number of parking
		'AV'=>'',//Advertiser category
		'AW'=>$v->cr_number,//Advertiser license number
		'AX'=>$v->user_email,//Advertiser's emailr
                        'AY'=>'', //Advertiser registration number
                        'AZ'=>'', //Authorization number

                    );

                    //fprintf( $f, chr( 0xEF ).chr( 0xBB ).chr( 0xBF ) );
                    fputcsv( $f, $lineData, $delimiter );

                }

                //move back to beginning of file
                fseek( $f, 0 );

                //set headers to download file rather than displayed
                mb_internal_encoding( 'UTF-8' );
                header( 'Content-type: text/html; charset=UTF-8' );

                header( 'Content-Disposition: attachment; filename="' . $filename . '";' );

                //output all remaining data on a file pointer
                fpassthru( $f );
            }
            */
        exit;
    }
    public function actionDynamicPropertyTypes()
    {
        if (isset($_POST['section_id'])) {
            $sectionId = (int) $_POST['section_id'];
            $db = Yii::app()->db;
    
            // Fetch category IDs related to the section_id
            $sql = "SELECT DISTINCT category_id FROM mw_place_an_ad WHERE section_id = :section_id";
            $command = $db->createCommand($sql);
            $command->bindParam(':section_id', $sectionId, PDO::PARAM_INT);
            $ads = $command->queryAll();
    
            // Extract category IDs
            $categoryIds = array_unique(array_filter(array_column($ads, 'category_id')));
    
            // Fetch categories based on category IDs
            $categories = Category::model()->findAllByAttributes(['category_id' => $categoryIds]);
    
            // Prepare the response options
            echo CHtml::tag('option', array('value' => ''), CHtml::encode('Select Category'), true);
            foreach ($categories as $category) {
                echo CHtml::tag('option', array('value' => $category->category_id), CHtml::encode($category->category_name), true);
            }
        }
        Yii::app()->end();
    }


    public function actionDynamicSubCategories()
    {
        if (isset($_POST['category_id'])) {
            $categoryId = (int) $_POST['category_id'];
    
            // Fetch subcategories where category_id matches p_type
            $subCategories = Subcategory::model()->findAllByAttributes(['category_id' => $categoryId, 'isTrash' => '0']);
    
            // Prepare the response options
            echo CHtml::tag('option', array('value' => ''), CHtml::encode('Select Sub Category'), true);
            foreach ($subCategories as $subCategory) {
                echo CHtml::tag('option', array('value' => $subCategory->sub_category_id), CHtml::encode($subCategory->sub_category_name), true);
            }
        }
        Yii::app()->end();
    }
    
    public function actionDynamicNestedSubcategories()
    {
        if (isset($_POST['sub_category_id'])) {
            $subCategoryId = (int) $_POST['sub_category_id'];

            // Fetch nested subcategories where sub_category_id matches
            $nestedSubCategories = Subcategory::model()->findAllByAttributes(['parent_id' => $subCategoryId, 'isTrash' => '0']);

            // Prepare the response options
            echo CHtml::tag('option', array('value' => ''), CHtml::encode('Select Nested Sub Category'), true);
            foreach ($nestedSubCategories as $nestedSubCategory) {
                echo CHtml::tag('option', array('value' => $nestedSubCategory->sub_category_id), CHtml::encode($nestedSubCategory->sub_category_name), true);
            }
        }
        Yii::app()->end();
    }


    
    
    // public function actionDynamicNestedSubcategories()
    // {

    //     if (isset($_GET['parentId'])) {
    //         $parentId = $_GET['parentId'];
    //         $nestedSubcategories = Subcategory::model()->findAllByAttributes(array('parent_id' => $parentId));
    //         $options = array();
    //         foreach ($nestedSubcategories as $subcategory) {
    //             $options[$subcategory->sub_category_id] = $subcategory->sub_category_name;
    //         }
    //         echo CHtml::tag('option', array('value' => ''), CHtml::encode('Select Nested Sub Category'), true);
    //         foreach ($options as $value => $name) {
    //             $selected = ($_GET['nestedSubcategoryId'] == $value) ? 'selected' : '';
    //             echo CHtml::tag('option', array('value' => $value, 'selected' => $selected), CHtml::encode($name), true);
    //         }
    //     }
    //     Yii::app()->end();
    // }

    public function actionIndex()
    {
        $adsToUpdate = PlaceAnAd::model()->findAll([
            'condition' => 'city IS NULL OR city = "" AND state IS NOT NULL'
        ]);
    
        foreach ($adsToUpdate as $ad) {
            $state = States::model()->findByPk($ad->state);
            if ($state !== null) {
                PlaceAnAd::model()->updateByPk($ad->id, ['city' => $state->region_id]);
            }
        }
        
        echo '<script>function iniFrame() { if(window.self !== window.top) { parent.closeBackendIFrame(); } } iniFrame(); </script>';
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd('search');
    
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['priority'];
            if (!empty($sortOrderAll)) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $model->isNewRecord = true;
                    $model->updateByPk($menuId, ['priority' => $sortOrder]);
                }
            }
            $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    
        $model->unsetAttributes();
        $model->hide_new_development = '1';
        $model->attributes = (array)$request->getQuery($model->modelName, []);
        $model->isTrash = '0';
    
        $criteria = new CDbCriteria();
    
      
    
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $criteria->addCondition("DATE(date_added) >= :startDate AND DATE(date_added) <= :endDate");
            $criteria->params[':startDate'] = $_GET['startDate'];
            $criteria->params[':endDate'] = $_GET['endDate'];
        }
    
        // Add conditions for logged-in user roles
        $loggedInUser = Yii::app()->user->model;
        if ($loggedInUser->is_agent == 1) {
            $criteria->addCondition('t.user_id = :userId');
            $criteria->params[':userId'] = $loggedInUser->user_id;
        } elseif ($loggedInUser->rules == 2) {
            $userAgents = explode(",", $loggedInUser->agents);
            $criteria->addInCondition('t.user_id', $userAgents);
        }
    
        $criteria->order = "t.id DESC";
    
        $filteredData = PlaceAnAd::model()->findAll($criteria);
    
        define('NO_BUSINESS', '1');
    
        $this->setData([
            'pageMetaTitle' => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading' => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs' => [
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all'),
            ],
        ]);
    
        $soldProperties = SoldProperty::model()->findAll();
        $soldPropertyIds = array_map(fn($soldProperty) => $soldProperty->property_id, $soldProperties);
    
        $tagCriteria = new CDbCriteria;
        $tagCriteria->addCondition('tag_type = :tagType');
        $tagCriteria->params[':tagType'] = 'L';
        $tagModel = Tag::model()->findAll($tagCriteria);
    
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short = $model->place_ad_tag_code();
    
        $this->render('list', compact('model', 'filteredData', 'soldPropertyIds', 'tags', 'tags_short'));
    }
    

    public function actionServerProcessing()
    {
        $request = Yii::app()->request;
        $criteria = new CDbCriteria();
    
        // Capture search value
        $searchValue = $request->getPost('search')['value'];
        if (!empty($searchValue)) {
            // Use addCondition to construct search conditions manually
            $searchCondition = [
                "t.RefNo LIKE :searchValue",
                "t.ad_title LIKE :searchValue",
                // Add more columns as needed
            ];
            // Combine conditions with OR
            $criteria->addCondition(implode(' OR ', $searchCondition));
            // Bind the search parameter
            $criteria->params[':searchValue'] = '%' . $searchValue . '%';
            // Add more conditions for other columns as needed
        }
        // Yii::log(CVarDumper::dumpAsString($criteria), 'info', 'search.criteria');
        $startDate = $request->getPost('startDate');
        $endDate = $request->getPost('endDate');
        
        if ($startDate && $endDate) {
            $validStartDate = DateTime::createFromFormat('Y-m-d', $startDate) !== false;
            $validEndDate = DateTime::createFromFormat('Y-m-d', $endDate) !== false;
            if ($validStartDate && $validEndDate) {
                $startDate .= ' 00:00:00';
                $endDate .= ' 23:59:59';
                $criteria->addCondition("t.date_added >= :startDate AND t.date_added <= :endDate");
                $criteria->params[':startDate'] = $startDate;
                $criteria->params[':endDate'] = $endDate;
            }
        }
        
        $criteria->addCondition("t.section_id = 1 OR t.section_id = 2");
        $criteria->params[':startDate'] = $startDate;
        $criteria->params[':endDate'] = $endDate;
        // Add conditions dynamically
        if (!empty($_POST['featured'])) {
            $criteria->addCondition('featured = :featured');
            $criteria->params[':featured'] = $_POST['featured'];
        }

        if (!empty($_POST['hot'])) {
            $criteria->addCondition('hot = :hot');
            $criteria->params[':hot'] = $_POST['hot'];
        }
        if (!empty($_POST['status'])) {
            $criteria->addCondition('status = :status');
            $criteria->params[':status'] = $_POST['status'];
            $criteria->addCondition('isTrash LIKE :isTrash');
            $criteria->params[':isTrash'] = 0;
        }

        if (!empty($_POST['section_id'])) {
            $criteria->addCondition('section_id = :section_id');
            $criteria->params[':section_id'] = $_POST['section_id'];
        }

        if (!empty($_POST['preleasedR'])) {
            $criteria->addCondition('property_status = :preleasedR');
            $criteria->params[':preleasedR'] = $_POST['preleasedR'];
        }
    
        if (!empty($_POST['verified'])) {
            $criteria->addCondition('verified = :verified');
            $criteria->params[':verified'] = $_POST['verified'];
        }
    
        if (!empty($_POST['preleased'])) {
            $criteria->addCondition('property_status = :lease_status');
            $criteria->params[':lease_status'] = $_POST['lease_status'];
        }
    
        if (!empty($_POST['submited_by'])) {
            $criteria->addCondition('submited_by = :submited_by');
            $criteria->params[':submited_by'] = $_POST['submited_by'];
        }
    
        if (!empty($_POST['property_category'])) {
            $criteria->addCondition('category_id = :category_id');
            $criteria->params[':category_id'] = $_POST['property_category'];
        }
    
        if (!empty($_POST['location'])) {
            $criteria->addCondition('state = :state');
            $criteria->params[':state'] = $_POST['location'];
        }
        // User-specific conditions
        $loggedInUser = Yii::app()->user->model; // Assuming you have a method to get the logged-in user model
        
        if ($loggedInUser->rules == 3) {
            // Single user ID
            $criteria->addCondition('t.user_id = :userId');
            $criteria->params[':userId'] = $loggedInUser->user_id;
        } elseif ($loggedInUser->rules == 2) {
            // Multiple user IDs
            $userAgents = explode(',', $loggedInUser->agents);

            // Create placeholders for named parameters
            $placeholders = [];
            foreach ($userAgents as $index => $agentId) {
                $placeholders[] = ':userId' . $index; // Named placeholders
                $criteria->params[':userId' . $index] = $agentId; // Assign parameter values
            }

            $criteria->addCondition('t.user_id IN (' . implode(',', $placeholders) . ')');

        }
        
        // Sorting
        $orderColumnIndex = $request->getPost('order')[0]['column'];
        $orderDirection = $request->getPost('order')[0]['dir']; // 'asc' or 'desc'
        $orderColumnName = $request->getPost('columns')[$orderColumnIndex]['data'];
        if ($orderColumnName) {
            $criteria->order = "$orderColumnName $orderDirection";
        }
        
        // Pagination
        $start = $request->getPost('start', 0);
        $length = $request->getPost('length', 10);
        $criteria->offset = $start;
        $criteria->limit = $length;
        // Fetch data
        $totalRecords = PlaceAnAd::model()->count($criteria);
        $filteredRecords = PlaceAnAd::model()->count($criteria);
        $placeAds = PlaceAnAd::model()->findAll($criteria);
        // Prepare data in a format for DataTables
        $data = [];
        foreach ($placeAds as $ad) {
            $stateName = States::model()->findByPk($ad->state);
            $PreviewURL = $ad->PreviewUrlTrash;
            $data[] = [
                'id' => '<input type="checkbox" class="bulk-item" value="'.$ad->id.'">',
                'RefNo' => CHtml::encode($ad->ReferenceNumberTitleP),
                'ad_title' => CHtml::encode($ad->AdTitle),
                'section' => CHtml::encode($ad->section->section_name),
                'price' => CHtml::encode($ad->price),
                'category' => $ad->getCategoryName($ad->category_id),
                'status' => $ad->statusLink,
                'priority' => $stateName ? $stateName->state_name : '',
                'date_added' => '<span class="date-display" style="margin-right: 3px;" id="date-display-' . $ad->id . '">' .
                                    CHtml::encode(date('d-M-Y', strtotime($ad->date_added))) .
                                '</span>
                                <a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/refresh_date', array('id' => $ad->id)) . '" 
                                class="refresh-date" 
                                data-id="' . $ad->id . '" 
                                style="text-decoration: none; color: blue; cursor: pointer;">
                                    <i class="fa fa-refresh"></i>
                                </a>',

                'options' =>
                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/update', ['id' => $ad->id]) . '" title="' . Yii::t('app', 'Update') . '" class="edit-icon"><i class="fa fa-pencil"></i></a>&nbsp;' : '') .

                    '<a href="' . $PreviewURL . '" title="' . Yii::t('app', 'View') . '" target="_blank" class="view-icon"><i class="fa fa-eye"></i></a>&nbsp;' .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete') ? '<a href="javascript:void(0);" title="' . Yii::t('app', 'Delete') . '" class="delete delete-icon" onclick="confirmDelete(\'' . Yii::app()->createUrl(Yii::app()->controller->id . '/delete', ['id' => $ad->id]) . '\')"><i class="fa fa-times-circle"></i></a>&nbsp;' : '') .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/featured') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/featured', ['id' => $ad->id, 'featured' => $ad->featured]) . '" title="' . Yii::t('app', 'Featured') . '" class="' . ($ad->featured === 'Y' ? 'featured-property' : '') . '"><i class="fa fa-star"></i></a>&nbsp;' : '') .

                    '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/verified', ['id' => $ad->id, 'verified' => $ad->verified]) . '" title="' . Yii::t('app', 'Verified') . '" class="' . ($ad->verified === '1' ? 'verified-property' : '') . '"><i class="fa fa-check-circle"></i></a>&nbsp;' .

                    ($ad->status === "A" ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', ['id' => $ad->id, 'val' => "I"]) . '" title="' . Yii::t('app', 'Inactive AD') . '" class="Block"><i class="fa fa-ban"></i></a>&nbsp;' : '') .

                    ($ad->status === "I" ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', ['id' => $ad->id, 'val' => "A"]) . '" title="' . Yii::t('app', 'Activate AD') . '" class="Enable active-property"><i class="fa fa-check-circle"></i></a>&nbsp;' : '') .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/hot') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/hot', ['id' => $ad->id, 'hot' => $ad->hot]) . '" title="' . Yii::t('app', 'Hot') . '" class="' . ($ad->hot === '1' ? 'hot-property' : '') . '"><i class="fas fa-sun"></i></a>&nbsp;' : '') .

                    ($isSold ? '<a href="#" class="sold-property"><i class="fas fa-check" title="This property is already sold"></i></a>' : ($ad->status === "A" ? '<a href="javascript:void(0);" title="' . Yii::t('app', 'Sold property') . '" onclick="openUp2(' . $ad->id . ')"><i class="far fa-handshake"></i></a>&nbsp;' : ''))
            ];
        }
        // $command = PlaceAnAd::model()->getCommandBuilder()->createFindCommand(PlaceAnAd::model()->tableName(), $criteria);
        // $sql = $command->getText();
        // $params = $criteria->params;

        // // Log to the Yii application log
        // print_r("SQL Query: " . $sql);
        // print_r("Parameters: " . CVarDumper::dumpAsString($params));
        // exit;
        // Alternatively, write to a custom log file
        $logFile = Yii::app()->basePath . '/runtime/serverProcessing.log';
        file_put_contents($logFile, "SQL Query: " . $sql . PHP_EOL, FILE_APPEND);
        file_put_contents($logFile, "Parameters: " . print_r($params, true) . PHP_EOL, FILE_APPEND);

        // Return JSON response
        echo CJSON::encode([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    
        Yii::app()->end();
    }
    public function actionServerProcessingBusiness()
    {
        $request = Yii::app()->request;
        $criteria = new CDbCriteria();
    
        // Capture search value
        $searchValue = $request->getPost('search')['value'];
        if (!empty($searchValue)) {
            // Use addCondition to construct search conditions manually
            $searchCondition = [
                "t.RefNo LIKE :searchValue",
                "t.ad_title LIKE :searchValue",
                // Add more columns as needed
            ];
            // Combine conditions with OR
            $criteria->addCondition(implode(' OR ', $searchCondition));
            // Bind the search parameter
            $criteria->params[':searchValue'] = '%' . $searchValue . '%';
            // Add more conditions for other columns as needed
        }
        // Yii::log(CVarDumper::dumpAsString($criteria), 'info', 'search.criteria');
        $startDate = $request->getPost('startDate');
        $endDate = $request->getPost('endDate');
        
        if ($startDate && $endDate) {
            $validStartDate = DateTime::createFromFormat('Y-m-d', $startDate) !== false;
            $validEndDate = DateTime::createFromFormat('Y-m-d', $endDate) !== false;
            if ($validStartDate && $validEndDate) {
                $startDate .= ' 00:00:00';
                $endDate .= ' 23:59:59';
                $criteria->addCondition("t.date_added >= :startDate AND t.date_added <= :endDate");
                $criteria->params[':startDate'] = $startDate;
                $criteria->params[':endDate'] = $endDate;
            }
        }
        if (!empty($_POST['status'])) {
            $criteria->addCondition('status = :status');
            $criteria->params[':status'] = $_POST['status'];
            $criteria->addCondition('isTrash LIKE :isTrash');
            $criteria->params[':isTrash'] = 0;
        }
        if (!empty($_POST['featured'])) {
            $criteria->addCondition('featured = :featured');
            $criteria->params[':featured'] = $_POST['featured'];
        }
        if (!empty($_POST['hot'])) {
            $criteria->addCondition('hot = :hot');
            $criteria->params[':hot'] = $_POST['hot'];
        }
    
        if (!empty($_POST['verified'])) {
            $criteria->addCondition('verified = :verified');
            $criteria->params[':verified'] = $_POST['verified'];
        }
    
        if (!empty($_POST['property_category'])) {
            $criteria->addCondition('category_id = :category_id');
            $criteria->params[':category_id'] = $_POST['property_category'];
        }
    
        if (!empty($_POST['location'])) {
            $criteria->addCondition('state = :state');
            $criteria->params[':state'] = $_POST['location'];
        }
        $criteria->addCondition("t.section_id = 6");
        $criteria->params[':startDate'] = $startDate;
        $criteria->params[':endDate'] = $endDate;
        // User-specific conditions
        $loggedInUser = Yii::app()->user->model; // Assuming you have a method to get the logged-in user model
        
        if ($loggedInUser->rules == 3) {
            // Single user ID
            $criteria->addCondition('t.user_id = :userId');
            $criteria->params[':userId'] = $loggedInUser->user_id;
        } elseif ($loggedInUser->rules == 2) {
            // Multiple user IDs
            $userAgents = explode(',', $loggedInUser->agents);

            // Create placeholders for named parameters
            $placeholders = [];
            foreach ($userAgents as $index => $agentId) {
                $placeholders[] = ':userId' . $index; // Named placeholders
                $criteria->params[':userId' . $index] = $agentId; // Assign parameter values
            }

            $criteria->addCondition('t.user_id IN (' . implode(',', $placeholders) . ')');

        }
        
        // Sorting
        $orderColumnIndex = $request->getPost('order')[0]['column'];
        $orderDirection = $request->getPost('order')[0]['dir']; // 'asc' or 'desc'
        $orderColumnName = $request->getPost('columns')[$orderColumnIndex]['data'];
        if ($orderColumnName) {
            $criteria->order = "$orderColumnName $orderDirection";
        }
        
        // Pagination
        $start = $request->getPost('start', 0);
        $length = $request->getPost('length', 10);
        $criteria->offset = $start;
        $criteria->limit = $length;
        // Fetch data
        $totalRecords = PlaceAnAd::model()->count($criteria);
        $filteredRecords = PlaceAnAd::model()->count($criteria);
        $placeAds = PlaceAnAd::model()->findAll($criteria);
        // Prepare data in a format for DataTables
        $data = [];
        foreach ($placeAds as $ad) {
            $stateName = States::model()->findByPk($ad->state);
            $PreviewURL = $ad->PreviewUrlTrash;
            $data[] = [
                'id' => '<input type="checkbox" class="bulk-item" value="'.$ad->id.'">',
                'RefNo' => CHtml::encode($ad->ReferenceNumberTitleP),
                'ad_title' => CHtml::encode($ad->AdTitle),
                'location' => $stateName ? $stateName->state_name : '',
                'price' => CHtml::encode($ad->price),
                'status' => $ad->statusLink,
                'date_added' => '<span class="date-display" style="margin-right: 3px;" id="date-display-' . $ad->id . '">' .
                                    CHtml::encode(date('d-M-Y', strtotime($ad->date_added))) .
                                '</span>',

                'options' =>
                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/update', ['id' => $ad->id]) . '" title="' . Yii::t('app', 'Update') . '" class="edit-icon"><i class="fa fa-pencil"></i></a>&nbsp;' : '') .

                    '<a href="' . $PreviewURL . '" title="' . Yii::t('app', 'View') . '" target="_blank" class="view-icon"><i class="fa fa-eye"></i></a>&nbsp;' .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete') ? '<a href="javascript:void(0);" title="' . Yii::t('app', 'Delete') . '" class="delete delete-icon" onclick="confirmDelete(\'' . Yii::app()->createUrl(Yii::app()->controller->id . '/delete', ['id' => $ad->id]) . '\')"><i class="fa fa-times-circle"></i></a>&nbsp;' : '') .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/featured') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/featured', ['id' => $ad->id, 'featured' => $ad->featured]) . '" title="' . Yii::t('app', 'Featured') . '" class="' . ($ad->featured === 'Y' ? 'featured-property' : '') . '"><i class="fa fa-star"></i></a>&nbsp;' : '') .

                    '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/verified', ['id' => $ad->id, 'verified' => $ad->verified]) . '" title="' . Yii::t('app', 'Verified') . '" class="' . ($ad->verified === '1' ? 'verified-property' : '') . '"><i class="fa fa-check-circle"></i></a>&nbsp;' .

                    ($ad->status === "A" ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', ['id' => $ad->id, 'val' => "I"]) . '" title="' . Yii::t('app', 'Inactive AD') . '" class="Block"><i class="fa fa-ban"></i></a>&nbsp;' : '') .

                    ($ad->status === "I" ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', ['id' => $ad->id, 'val' => "A"]) . '" title="' . Yii::t('app', 'Activate AD') . '" class="Enable active-property"><i class="fa fa-check-circle"></i></a>&nbsp;' : '') .

                    (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/hot') ? '<a href="' . Yii::app()->createUrl(Yii::app()->controller->id . '/hot', ['id' => $ad->id, 'hot' => $ad->hot]) . '" title="' . Yii::t('app', 'Hot') . '" class="' . ($ad->hot === '1' ? 'hot-property' : '') . '"><i class="fas fa-sun"></i></a>&nbsp;' : '') .

                    ($isSold ? '<a href="#" class="sold-property"><i class="fas fa-check" title="This property is already sold"></i></a>' : ($ad->status === "A" ? '<a href="javascript:void(0);" title="' . Yii::t('app', 'Sold property') . '" onclick="openUp2(' . $ad->id . ')"><i class="far fa-handshake"></i></a>&nbsp;' : '')) .
                
                    ($loggedInUser->rules != 3 ? '<a href="javascript:void(0);" title="' . Yii::t('app', 'Assign Agent') . '" onclick="openUp3(' . $ad->id . ')"><i class="fa fa-hand-pointer-o"></i></a>&nbsp;' : '')
            ];
        }
        // $command = PlaceAnAd::model()->getCommandBuilder()->createFindCommand(PlaceAnAd::model()->tableName(), $criteria);
        // $sql = $command->getText();
        // $params = $criteria->params;

        // // Log to the Yii application log
        // print_r("SQL Query: " . $sql);
        // print_r("Parameters: " . CVarDumper::dumpAsString($params));
        // exit;
        // Alternatively, write to a custom log file
        $logFile = Yii::app()->basePath . '/runtime/serverProcessing.log';
        file_put_contents($logFile, "SQL Query: " . $sql . PHP_EOL, FILE_APPEND);
        file_put_contents($logFile, "Parameters: " . print_r($params, true) . PHP_EOL, FILE_APPEND);

        // Return JSON response
        echo CJSON::encode([
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    
        Yii::app()->end();
    }

    public function actiongetAgents(){
        $agents = User::model()->findAll('rules = :role', [':role' => '3']); // Adjust based on your role system
        $data = [];

        foreach ($agents as $agent) {
            $data[] = [
                'id' => $agent->user_id,
                'name' => $agent->first_name . " " . $agent->last_name
            ];
        }

        echo CJSON::encode($data);
        Yii::app()->end();
    }
    public function actionAssignAgent() {

        $request = Yii::app()->request;
        $propertyId = $request->getPost('property_id');
        $userId = $request->getPost('user_id');

        if ($propertyId && $userId) {
            $ad = PlaceAnAd::model()->findByPk($propertyId);
            if ($ad) {
                $ad->user_id = $userId;
                if ($ad->save()) {
                    echo CJSON::encode(['success' => true]);
                    Yii::app()->end();
                }
            }
        }
        echo CJSON::encode(['success' => false]);
        Yii::app()->end();
    }


    public function actionExportData()
    {
        try {
            ini_set('display_errors', 1); error_reporting(E_ALL);
            ini_set('memory_limit', '-1');
            $criteria = new CDbCriteria();
          
            // Set filters based on request parameters
            if (isset($_GET['type'])) {
                if ($_GET['type'] == 'unpublished') {
                    $criteria->compare('unpublished', '1');
                } elseif ($_GET['type'] == 'business') {
                    define('ONLY_BUSINESS', '1');
                } elseif ($_GET['type'] == 'trash') {
                    $criteria->compare('isTrash', '1');
                }
            }
            // if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            //     $criteria->addCondition("DATE(date_added) >= :startDate AND DATE(date_added) <= :endDate");
            //     $criteria->params[':startDate'] = $_GET['startDate'];
            //     $criteria->params[':endDate'] = $_GET['endDate'];
            // }
            $criteria->addInCondition('section_id', [1, 2]);
            // Retrieve data using CActiveRecord's findAll method
            // if (Yii::app()->user->model->user_id == 2){
            
            //     $data = PlaceAnAd::model()->findAll($criteria);
                
            // }else {
                  
            //     $criteria->condition = 'user_id = :userId'; // Use a placeholder for security
            //     $criteria->params = [':userId' => Yii::app()->user->model->user_id]; // Bind the parameter

            //     // Execute the query
            //     $data = PlaceAnAd::model()->findAll($criteria);
            // }
            $loggedInUser = Yii::app()->user->model;
            if ($loggedInUser->rules == 3) {
                // Single user ID
                $criteria->addCondition('t.user_id = :userId');
                $criteria->params[':userId'] = $loggedInUser->user_id;
            } else if ($loggedInUser->rules == 2) {
                // Multiple user IDs
                $userAgents = explode(',', $loggedInUser->agents);
    
                // Create placeholders for named parameters
                $placeholders = [];
                foreach ($userAgents as $index => $agentId) {
                    $placeholders[] = ':userId' . $index; // Named placeholders
                    $criteria->params[':userId' . $index] = $agentId; // Assign parameter values
                }
    
                $criteria->addCondition('t.user_id IN (' . implode(',', $placeholders) . ')');
    
            }
            $data = PlaceAnAd::model()->findAll($criteria);

            // Prepare data for JSON response
            // Step 1: Pre-fetch related data for all items in `$data`
            $itemIds = array_map(fn($item) => $item->id, $data);
            $userIds = array_map(fn($item) => $item->user_id, $data);
            $stateIds = array_unique(array_filter(array_map(function($item) {
                return $item->state ?? null; // Return state or null
            }, $data)));
            // print_r($state)            
            // Fetch images for all items
            $allImages = AdImage::model()->findAllByAttributes(['ad_id' => $itemIds]);
            $imageMap = [];
            foreach ($allImages as $image) {
                $imageMap[$image->ad_id][] = $image;
            }

            // Fetch floor plans for all items
            $allFloorPlans = AdFloorPlan::model()->findAllByAttributes(['ad_id' => $itemIds]);
            $floorPlanMap = [];
            foreach ($allFloorPlans as $floorPlan) {
                $floorPlanMap[$floorPlan->ad_id][] = $floorPlan;
            }

            // Fetch all users in one query
            $users = User::model()->findAllByPk($userIds);
            $userMap = [];
            foreach ($users as $user) {
                $userMap[$user->user_id] = $user;
            }

            // Fetch all states based on collected state IDs
            $states = States::model()->findAllByPk($stateIds);
            $stateMap = [];

            // Populate the stateMap array with state names and their corresponding region names
            foreach ($states as $state) {
                $region = MainRegion::model()->findByPk($state->region_id);
                $stateMap[$state->state_id] = [
                    'state_name' => $state->state_name,
                    'region_name' => $region ? $region->name : 'Unknown Region'
                ];
            }

            // Step 2: Iterate over $data and build the response
            $domain = Yii::app()->request->hostInfo;
            $responseData = [];

            foreach ($data as $item) {
                // Prepare image list
                $imageList = isset($imageMap[$item->id]) ? implode(',', array_map(fn($image) => $domain . '/uploads/files/' . $image->image_name, $imageMap[$item->id])) : '';

                // Prepare floor plan list
                $floorPlanList = isset($floorPlanMap[$item->id]) ? implode(',', array_map(fn($floorPlan) => $domain . '/uploads/floor_plan/' . $floorPlan->floor_title, $floorPlanMap[$item->id])) : '';

                // Get user information
                $userId = $item->user_id;
                $user = $userMap[$userId] ?? null;
                $agencyName = '';
                if ($user && strpos($user->agents, (string)$userId) !== false) {
                    $agencyName = $user->first_name;
                }

                // Get emirate name from state
                $emirateName = $stateMap[$item->state]['region_name'] ?? 'Unknown Emirate';
                $formattedCreationDate = (new DateTime($item->date_added))->format('j-M-Y');
                $formattedRefreshDate = (new DateTime($item->date_added))->format('j-M-Y');            
                $responseData[] = [
                    'UID'                              => $item->uid,
                    'Sr. No'                           => $item->id,
                    'Creation Date'                    => $item->date_added,
                    'Refresh Date'                     => $item->date_added,
                    'Reference ID'                     => $item->RefNo,
                    'Permit Number'                    => $item->PropertyID,
                    'Offer Type'                       => $item->section_id == 1 ? "Sale" : "Rent",
                    'Property Type Category'           => Category::model()->findByPk($item->listing_type)->category_name ?? '',
                    'Property Type'                    => Category::model()->findByPk($item->category_id)->category_name ?? '',
                    'COUNTRY'                          => $item->country_name ?? "UAE",
                    'EMIRATE'                          => $emirateName,
                    'LOCATION'                         => ($stateMap[$item->state]['state_name'] ?? ''),
                    'Google Map Property Ads Location' => $item->location_latitude . ', ' . $item->location_longitude,
                    'Ad Title'                         => $item->ad_title,
                    'Ad Description'                   => $item->ad_description,
                    'Amenities'                        => $item->amenities,
                    'FURNISHED'                        => $item->furnished == "Y" ? "Yes" : "No",
                    'Resi. Bedrooms'                   => $item->bedrooms,
                    'Resi. Bathrooms'                  => $item->bathrooms,
                    'Number Of Units'                  => $item->no_of_u,
                    'Floor Number'                     => $item->FloorNo,
                    'Plot Area (sqft)'                 => $item->plot_area,
                    'BUA Size (sqft)'                  => $item->builtup_area,
                    'Sale/Rent Price (AED)'            => $item->price,
                    'Rent Paid Frequency'              => $item->rent_paid,
                    'PRELEASED STATUS'                 => $item->property_status == 0 ? "No" : "Yes",
                    'LEASE STATUS'                     => $item->lease_status == 0 ? "Vacant" : "Leased",
                    'CURRENT/EXPECTED RENTAL INCOME'   => $item->income,
                    'CURRENT/EXPECTED ROI PA %'        => $item->roi,
                    'Photos (JPG/PNG)'                 => $imageList,
                    'Floor Plans'                      => $floorPlanList,
                    'Video (YouTube URL)'              => $item->video,
                    'FEATURED'                         => $item->featured == "Y" ? "Yes" : "No",
                    'HOT'                              => $item->hot == 1 ? "Yes" : "No",
                    'VARIFIED'                         => $item->verified == 1 ? "Yes" : "No",
                    'Availability'                     => $item->availability == "sold_out" ? "Sold Out" : $item->availability == "not_available" ? "Not Available" : "Available",
                    'Publish_Status'                   => $item->status == "A" ? "Active" : "Inacive",
                    'AGENCY NAME'                      => $agencyName,
                    'AGENT NAME'                       => $user->first_name ?? '',
                    'AGENT EMAIL'                      => $user->email ?? '',
                    'AGENT CONTACT'                    => $user->phone_number ?? '',
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($responseData);

            // Send JSON response
            Yii::app()->end();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            Yii::app()->end();
        }
    }
    public function actionExportDataBusiness()
    {
        try {
            ini_set('display_errors', 1); error_reporting(E_ALL);
            ini_set('memory_limit', '-1');
            $criteria = new CDbCriteria();
          
            // Set filters based on request parameters
            if (isset($_GET['type'])) {
                if ($_GET['type'] == 'unpublished') {
                    $criteria->compare('unpublished', '1');
                } elseif ($_GET['type'] == 'business') {
                    define('ONLY_BUSINESS', '1');
                    $criteria->compare('isTrash', '1');
                } elseif ($_GET['type'] == 'trash') {
                    $criteria->compare('isTrash', '1');
                }
            }
            $criteria->addInCondition('section_id', [6]);
            
            $loggedInUser = Yii::app()->user->model;
            if ($loggedInUser->rules == 3) {
                // Single user ID
                $criteria->addCondition('t.user_id = :userId');
                $criteria->params[':userId'] = $loggedInUser->user_id;
            } else if ($loggedInUser->rules == 2) {
                // Multiple user IDs
                $userAgents = explode(',', $loggedInUser->agents);
    
                // Create placeholders for named parameters
                $placeholders = [];
                foreach ($userAgents as $index => $agentId) {
                    $placeholders[] = ':userId' . $index; // Named placeholders
                    $criteria->params[':userId' . $index] = $agentId; // Assign parameter values
                }
    
                $criteria->addCondition('t.user_id IN (' . implode(',', $placeholders) . ')');
    
            }
            $data = PlaceAnAd::model()->findAll($criteria);

            // Prepare data for JSON response
            // Step 1: Pre-fetch related data for all items in `$data`
            $itemIds = array_map(fn($item) => $item->id, $data);
            $userIds = array_map(fn($item) => $item->user_id, $data);
            $stateIds = array_unique(array_filter(array_map(function($item) {
                return $item->state ?? null; // Return state or null
            }, $data)));
            // print_r($state)            
            // Fetch images for all items
            $allImages = AdImage::model()->findAllByAttributes(['ad_id' => $itemIds]);
            $imageMap = [];
            foreach ($allImages as $image) {
                $imageMap[$image->ad_id][] = $image;
            }

            // Fetch floor plans for all items
            $allFloorPlans = AdFloorPlan::model()->findAllByAttributes(['ad_id' => $itemIds]);
            $floorPlanMap = [];
            foreach ($allFloorPlans as $floorPlan) {
                $floorPlanMap[$floorPlan->ad_id][] = $floorPlan;
            }

            // Fetch all users in one query
            $users = User::model()->findAllByPk($userIds);
            $userMap = [];
            foreach ($users as $user) {
                $userMap[$user->user_id] = $user;
            }

            // Fetch all states based on collected state IDs
            $states = States::model()->findAllByPk($stateIds);
            $stateMap = [];

            // Populate the stateMap array with state names and their corresponding region names
            foreach ($states as $state) {
                $region = MainRegion::model()->findByPk($state->region_id);
                $stateMap[$state->state_id] = [
                    'state_name' => $state->state_name,
                    'region_name' => $region ? $region->name : 'Unknown Region'
                ];
            }

            // Step 2: Iterate over $data and build the response
            $domain = Yii::app()->request->hostInfo;
            $responseData = [];

            foreach ($data as $item) {
                // Prepare image list
                $imageList = isset($imageMap[$item->id]) ? implode(',', array_map(fn($image) => $domain . '/uploads/files/' . $image->image_name, $imageMap[$item->id])) : '';

                // Prepare floor plan list
                $floorPlanList = isset($floorPlanMap[$item->id]) ? implode(',', array_map(fn($floorPlan) => $domain . '/uploads/floor_plan/' . $floorPlan->floor_title, $floorPlanMap[$item->id])) : '';

                // Get user information
                $userId = $item->user_id;
                $user = $userMap[$userId] ?? null;
                $agencyName = '';
                if ($user && strpos($user->agents, (string)$userId) !== false) {
                    $agencyName = $user->first_name;
                }

                // Get emirate name from state
                $emirateName = $stateMap[$item->state]['region_name'] ?? 'Unknown Emirate';
                $formattedCreationDate = (new DateTime($item->date_added))->format('j-M-Y');
                $formattedRefreshDate = (new DateTime($item->date_added))->format('j-M-Y');            
                $responseData[] = [
                    'UID'                              => $item->uid,
                    'Sr. No'                           => $item->id,
                    'Creation Date'                    => $item->date_added,
                    'Refresh Date'                     => $item->date_added,
                    'Reference ID'                     => $item->RefNo,
                    'Permit Number'                    => $item->PropertyID,
                    'Business Category'                => Category::model()->findByPk($item->category_id)->category_name ?? '',
                    'Business Sub Category'            => Subcategory::model()->findByPk($item->sub_category_id)->sub_category_name ?? '',
                    'Business Nested Sub Category'     => Subcategory::model()->findByPk($item->nested_sub_category)->sub_category_name ?? '',
                    'COUNTRY'                          => $item->country_name ?? "UAE",
                    'EMIRATE'                          => $emirateName,
                    'LOCATION'                         => ($stateMap[$item->state]['state_name'] ?? ''),
                    'Google Map Property Ads Location' => $item->location_latitude . ', ' . $item->location_longitude,
                    'Ad Title'                         => $item->ad_title,
                    'Ad Description'                   => $item->ad_description,

                    // Different
                    
                    'Asking Price (AED)'               => $item->price,
                    'Revenue (AED)'                    => $item->price_false,
                    'Business Cash Flow (AED)'         => $item->price_false,
                    'Business Valuation (AED)'         => $item->price,
                    'Property Type'                    => Category::model()->findByPk($item->listing_type)->category_name ?? '',
                    'Ownership Type'                   => $this->getMasterVal($item->ow_type),
                    'Leasehold Rent Per Annum (AED)'   => $item->Rent,
                    'Premises Details'                 => $item->mandate,

                    'Expansion Potential'              => '',
                    'Competition / Market'             => '',
                    'Reasons for Selling'              => "",
                    'Trading hours'                    => "",
                    'Employees'                        => '',
                    'Established Year'                 => '',
                    'Support & training'               => '',
                    'Furniture / Fixtures value (AED) Included in the asking price'
                                                       => '',
                    'Inventory / Stock value (AED) Included in the asking price'
                                                       => '',
                    'Relocatable'
                                                       => '',

                    // Same
                    'Photos (JPG/PNG)'                 => $imageList,
                    'Floor Plans'                      => $floorPlanList,
                    'Video (YouTube URL)'              => $item->video,
                    'FEATURED'                         => $item->featured == "Y" ? "Yes" : "No",
                    'HOT'                              => $item->hot == 1 ? "Yes" : "No",
                    'VARIFIED'                         => $item->verified == 1 ? "Yes" : "No",
                    'Availability'                     => $item->availability == "sold_out" ? "Sold Out" : $item->availability == "not_available" ? "Not Available" : "Available",
                    'Publish_Status'                   => $item->status == "A" ? "Active" : "Inacive",
                    'AGENCY NAME'                      => $agencyName,
                    'AGENT NAME'                       => $user->first_name ?? '',
                    'AGENT EMAIL'                      => $user->email ?? '',
                    'AGENT CONTACT'                    => $user->phone_number ?? '',
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($responseData);

            // Send JSON response
            Yii::app()->end();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            Yii::app()->end();
        }
    }
    
    public function getMasterVal($id = null)
	{
		$data =  Master::model()->findName($id);
		if (!empty($data)) {
			return $data->master_name;
		}
	}
    public function actionBusiness()
    {
        
        echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $this->Controlloler_title = 'Business Opportiunities';
        $model = new PlaceAnAd('serach');
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $model->startDate = $_GET['startDate'];
            $model->endDate = $_GET['endDate'];
        }
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['priority'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $model->isNewRecord = true;

                    $model->updateByPk($menuId, array('priority' => $sortOrder));
                }
            }
            $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        $model->unsetAttributes();
        $model->hide_new_development = '1';
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        // $model->isTrash = '0';
        define('ONLY_BUSINESS', '1');
        // $model->listing_type = 'C';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $criteria = new CDbCriteria;
        $criteria->compare('tag_type', 'L');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short =  $model->place_ad_tag_code();
        $this->render('list_business', compact('model', 'tags', 'tags_short'));
    }

    public function actionUnpublished()
    {
        $this->Controlloler_title = 'Unpublished Properties';
        echo '<script>function iniFrame() {   if(window.self !== window.top) {   parent.closeBackendIFrame();  }  }  iniFrame();  </script> ';
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd('serach');
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $model->startDate = $_GET['startDate'];
            $model->endDate = $_GET['endDate'];
        }
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['priority'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $model->isNewRecord = true;

                    $model->updateByPk($menuId, array('priority' => $sortOrder));
                }
            }
            $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $model->unsetAttributes();
        $model->hide_new_development = '1';

        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->isTrash = '0';
        $model->unpublished = '1';
        // $model->listing_type = 'C';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $criteria = new CDbCriteria;
        $criteria->compare('tag_type', 'L');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short =  $model->place_ad_tag_code();;
        $this->render('list_unpublished', compact('model', 'tags', 'tags_short'));
    }

    public function actionTrash()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd('serach');
        if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
            $model->startDate = $_GET['startDate'];
            $model->endDate = $_GET['endDate'];
        }
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['priority'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $model->isNewRecord = true;

                    $model->updateByPk($menuId, array('priority' => $sortOrder));
                }
            }
            $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $model->unsetAttributes();
        $model->hide_new_development = '1';

        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->isTrash = '1';
        // $model->listing_type = 'C';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Trash {$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $criteria = new CDbCriteria;
        $criteria->compare('tag_type', 'L');
        $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel, 'tag_id', 'tag_name');
        $tags_short =  $model->place_ad_tag_code();;
        $this->render('list', compact('model', 'tags', 'tags_short'));
    }

    public function  beforeAction($action)
    {

        if (in_array($action->id, array('create', 'success', 'update', 'success_edit', 'create_business'))) {
            $apps = Yii::app()->apps;

            // $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
            // $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
            // $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2script.js')));
            // $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'backend/assets/js/dropzone.min.js' ) ) );
            // $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
            $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/place_ad_css.css')));
            $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
            $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));

            // $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=1')));
            $apps = Yii::app()->apps;
            // $this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
            // $this->getData('pageStyles')->add(array('src' =>  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'));
            // $this->getData('pageScripts')->add(array('src' =>  'https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'));
        }
        return parent::beforeAction($action);
    }
    /*

        public function actionCreate() {

            $request = Yii::app()->request;
            $notify = Yii::app()->notify;
            $model = new PlaceAnAd();
            $model->scenario = 'new_insert';

            $image_array = array();

            $country = Countries::model()->ListDataForJSON();

            $section = Section::model()->ListDataForJSON_New();
            $list_type = Category::model()->listingTypeArrayMainData();

            $image_array = array();
            $this->setData( array(
                'pageMetaTitle'     =>   Yii::t( 'app', '{name}   :: {p}', array( '{name}' => 'List your property ', '{p}'=> Yii::app()->options->get( 'system.common.site_name' ) ) ),
                'pageHeading'       => Yii::t( Yii::app()->controller->id, 'List your property' ),

            ) );

            if ( Yii::app()->request->isAjaxRequest ) {
                echo CActiveForm::validate( $model );
                Yii::app()->end();
            }
            $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'backend/assets/js/dropzone.min.js' ) ) );
            $this->getData( 'pageStyles' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'assets/css/place_ad_css.css' ) ) );
            $this->getData( 'pageStyles' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'backend/assets/css/dropzone.css' ) ) );
            $this->getData( 'pageStyles' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'assets/css/table_common.css' ) ) );

            $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'assets/js/custom.js?q=1' ) ) );

            $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'backend/assets/js/jquery.autocomplete.js' ) ) );
            //  print_r( $_POST );
            exit;

            if ( $request->isPostRequest && ( $attributes = ( array )$request->getPost( $model->modelName, array() ) ) ) {

                $model->attributes = $attributes;

                if ( !$model->save() ) {

                    $model->amenities = Yii::app()->request->getPost( 'amenities' );
                    $exp =  explode( ',', $model->image );
                    if ( $exp ) {
                        foreach ( $exp as $k=>$v ) {
                            if ( $v != '' ) 	 {
                                $image_array[] = $v;
                            }
                        }
                    }

                    $notify->addError( Yii::t( 'app', 'Your form has a few errors, please fix them and try again!' ) );

                } else {
                    $this->insertAfterSaveFn( $model );
                    $notify->addSuccess( Yii::t( 'app', 'Your form has been successfully saved!' ) );
                    $this->redirect( Yii::App()->createUrl( $this->id.'/index' ) );
                }

            }

            $this->render( 'form_new', compact( 'model', 'country', 'section', 'list_type', 'image_array' ) );

        }
        *
        */

    public function actionCreate($imp = null)
    {

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        $model->scenario = 'new_insert';

        // $model->country =  '66099';

        $image_array = array();

        $country = Countries::model()->ListDataForJSON();

        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
        $this->setData(array(
            'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Post your AD ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, 'List your property'),

        ));

        // $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
        // $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
        // $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));

        // $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=1')));

        // $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
        // exit;
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (!empty($imp)) {
            switch ($imp) {
                case 'olx_import':
                    $cacheKey = 'olx-cookie';

                    if ($items = Yii::app()->cache->get($cacheKey)) {

                        $model->attributes = $items;
                        $model->site = 'O';
                        if (isset($items['amenities'])) {
                            $model->amenities = $items['amenities'];
                        }
                        $found =  PlaceAnAd::model()->findByAttributes(array('p_id' => (int)$model->p_id));
                        //print_r( $model->attributes );
                        exit;
                        if ($found) {

                            $this->render('_already_inserted', compact('found'));
                            exit;
                        }
                        $image_array = isset($items['images']) ? $items['images'] : '';
                    }
                    break;
                case 'graana_import':
                    $cacheKey = 'graana-cookie';

                    if ($items = Yii::app()->cache->get($cacheKey)) {

                        $model->attributes = $items;
                        $model->site = 'G';
                        if (isset($items['amenities'])) {
                            $model->amenities = $items['amenities'];
                        }

                        $found =  PlaceAnAd::model()->findByAttributes(array('p_id' => (int)$model->p_id, 'site' => 'G'));
                        //print_r( $model->attributes );
                        exit;
                        if ($found) {

                            $this->render('_already_inserted', compact('found'));
                            exit;
                        }
                        $image_array = isset($items['images']) ? $items['images'] : '';
                    }
                    break;
                case 'propertyfinder_import':
                    $cacheKey = 'propertyfinder-cookie';

                    if ($items = Yii::app()->cache->get($cacheKey)) {

                        $model->attributes = $items;
                        $model->site = 'P';
                        if (isset($items['amenities'])) {
                            $model->amenities = $items['amenities'];
                        }

                        $found =  PlaceAnAd::model()->findByAttributes(array('p_id' => (int)$model->p_id, 'site' => 'P'));
                        //print_r( $model->attributes );
                        exit;
                        if ($found) {

                            $this->render('_already_inserted', compact('found'));
                            exit;
                        }
                        $image_array = isset($items['images']) ? $items['images'] : '';
                    }
                    break;
                case 'bayut_import':
                    $cacheKey = 'bayut-cookie';

                    if ($items = Yii::app()->cache->get($cacheKey)) {

                        $model->attributes = $items;
                        $model->site = 'B';
                        if (isset($items['amenities'])) {
                            $model->amenities = $items['amenities'];
                        }

                        $found =  PlaceAnAd::model()->findByAttributes(array('p_id' => (int)$model->p_id, 'site' => 'B'));
                        //print_r( $model->attributes );
                        exit;
                        if ($found) {

                            $this->render('_already_inserted', compact('found'));
                            exit;
                        }
                        $image_array = isset($items['images']) ? $items['images'] : '';
                    }
                    break;
            }
            $model->user_id = empty($model->user_id) ? '31988' : $model->user_id;

            $model->status = 'I';
        }

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {

            $model->attributes = $attributes;

            if (!$model->save()) {

                // $model->amenities = Yii::app()->request->getPost('amenities');
                $exp =  explode(',', $model->image);
                if ($exp) {
                    foreach ($exp as $k => $v) {
                        if ($v != '') {
                            $image_array[] = $v;
                        }
                    }
                }

                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $this->insertAfterSaveFn($model);
                //$notify->addSuccess( Yii::t( 'app', 'Your form has been successfully saved!' ) );
                if ($model->section_id == '6') {
                    $this->redirect(Yii::App()->createUrl($this->id . '/business'));
                }
                $this->redirect(Yii::App()->createUrl($this->id . '/index'));
            }
        }

        $this->render('root.apps.backend.views.place_property.form_new', compact('model', 'country', 'section', 'list_type', 'image_array'));
    }

    public function actionUpdate($id = null, $slug = null)
    {

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        $model =   PlaceAnAd::model()->findByAttributes(array('id' => $id));

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        if ($model->section_id == '6') {
            $this->redirect(Yii::app()->createUrl($this->id . '/create_business', array('id' => $model->id)));
        }

        $model->scenario = 'new_insert';

        //$model->country =  '66099';
        $image_array = array();

        if (isset($model->adImages)) {

            foreach ($model->adImages as $k => $v) {
                $image_array[] = $v->image_name;
            }
        };
        // $model->amenities =  CHtml::listData($model->adAmenities, 'amenities_id', 'inp_val2');

        $country = Countries::model()->ListDataForJSON();

        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();

        $this->setData(array(
            'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Update your property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, 'List your property'),

        ));
        //  print_r( $_POST );
        // exit;
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            
            $model->attributes = $attributes;
            if (!$model->save()) {
                // Capture validation errors and display them
                $errors = $model->getErrors();
                $errorMessage = Yii::t('app', 'Your form has a few errors, please fix them and try again!');
                
                if (!empty($errors)) {
                    foreach ($errors as $attribute => $errorList) {
                        $errorMessage .= "\n" . Yii::t('app', ucfirst($attribute)) . ': ' . implode(', ', $errorList);
                    }
                }
                
                $notify->addError($errorMessage);
            
                // Handle image processing
                $image_array = [];
                $exp = explode(',', $model->image);
                if (!empty($exp)) {
                    foreach ($exp as $v) {
                        if (!empty($v)) {
                            $image_array[] = $v;
                        }
                    }
                }
            } else {
                $this->insertAfterSaveFn($model);
            
                // Display success message
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            
                // Redirect based on section ID
                if ($model->section_id == '6') {
                    $this->redirect(Yii::App()->createUrl($this->id . '/business'));
                } else {
                    $this->redirect(Yii::App()->createUrl($this->id . '/index'));
                }
            }
            
        }

        $model->price = number_format($model->price, 0, '.', '');
        $this->render('root.apps.backend.views.place_property.form_new', compact('model', 'country', 'section', 'list_type', 'image_array', 'option'));
    }

    public function insertAfterSaveFn($model)
    {
        $room_image = new AdImage;
        $room_image->deleteAll(array('condition' => 'ad_id=:ad_id', 'params' => array(':ad_id' => $model->id)));
        $imgArr =  explode(',', $model->image);

        if ($imgArr) {

            $img_saved = false;
            foreach ($imgArr as $k) {

                if (!$img_saved and $model->image != '') {

                    $model->updateByPk($model->id, array('image' => $k));
                }
                $room_image->isNewRecord = true;
                $room_image->id = '';
                $room_image->ad_id = $model->id;
                $room_image->image_name =  $k;
                $room_image->save();
            }
        }
        // $am = new  AdAmenities();
        // $am->deleteAll(array('condition' => 'ad_id=:ad_id', 'params' => array(':ad_id' => $model->id)));
        // if ($ameni = Yii::app()->request->getPost('amenities')) {

        //     foreach ($ameni as  $k => $v) {

        //         if (isset($v['inp_val']) and  empty($v['inp_val'])) {
        //             continue;
        //         }
        //         $am->isNewRecord = true;
        //         $am->ad_id = $model->id;
        //         $am->amenities_id =  $k;
        //         if (isset($v['inp_val']) and  !empty($v['inp_val'])) {
        //             $am->inp_val =  $v['inp_val'];
        //         } else {
        //             $am->inp_val = NULL;
        //         }
        //         $am->save();
        //     }
        // }
    }

    public function actionDetails($model, $subcategory, $category, $fields, $image_array)
    {
        $apps = Yii::app()->apps;
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
        // $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'assets/js/dropzone.min.js' ) ) );
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details', compact('model', 'subcategory', 'category', 'fields', 'image_array', 'hooks'));
    }

    public function actionDetails_2($model, $subcategory, $category, $fields, $image_array, $jsonData)
    {

        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('myAjax.js')));
        $this->render('location_view', compact('model', 'subcategory', 'category', 'fields', 'image_array', 'jsonData'));
        exit;
    }

    public function actionDetails_edit($model, $subcategory, $category, $fields, $image_array)
    {
        $apps = Yii::app()->apps;
        $this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
        // $this->getData( 'pageScripts' )->add( array( 'src' => Yii::app()->apps->getBaseUrl( 'assets/js/dropzone.min.js' ) ) );
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details_edit', compact('model', 'subcategory', 'category', 'fields', 'image_array'));
    }

    public function actionFindOnMap()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        //  $subcategory = SubCategory::model()->FindSubategory( '12' );

        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->render('details', compact('model'));
    }

    /**
     * Update existing user
     */
    /*

        public function actionUpdate( $id ) {

            $model = PlaceAnAd::model()->findByPk( ( int )$id );

            if ( empty( $model ) ) {
                throw new CHttpException( 404, Yii::t( 'app', 'The requested page does not exist.' ) );
            }
            $request = Yii::app()->request;
            $notify = Yii::app()->notify;
            $country = Countries::model()->ListDataForJSON();
            $state   = States::model()->ListDataForJSON( $model->country ) ;
            $city   = City::model()->ListDataForJSON( $model->state ) ;
            $list_type = Category::model()->ListDataTypeForJSON_ID();
            $model->state = ( $model->state == 0 )? 'All Cities' : $model->state;
            $section = Section::model()->ListDataForJSON_ID();
            $category = Category::model()->ListDataForJSON_ID_BySEction( $model->listing_type );
            $sub_category =   Subcategory::model()->ListDataForJSON_ID( $model->category_id ) ;
            $subcategory = Subcategory::model()->findByPk( $model->sub_category_id );
            $fields = array();
            $vehicleModel = array();

            $this->setData( array(
                'pageMetaTitle'     =>   Yii::t( Yii::app()->controller->id, "Create new {$this->Controlloler_title}" ),
                'pageHeading'       => Yii::t( Yii::app()->controller->id, 'Update Listing ' ),
                'pageBreadcrumbs'   => array(
                    Yii::t( Yii::app()->controller->id, "{$this->Controlloler_title}" ) => $this->createUrl( Yii::app()->controller->id.'/index' ),
                    Yii::t( 'app', 'Edit' ),
                )
            ) );

            if ( $request->isPostRequest && ( $attributes = ( array )$request->getPost( $model->modelName, array() ) ) ) {

                $subcategory = Subcategory::model()->FindSubategory( @$attributes[ 'sub_category_id' ] );
                $category = Category::model()->findByPk( @$attributes[ 'category_id' ] );
                if ( empty( $category ) )
                {
                    throw new CHttpException( 404, Yii::t( 'app', 'The requested page does not exist.' ) );
                }

                $fields =  CHtml::listData( $category->relatedFields, 'field_name', 'field_name' );
                $not_mandatory_fields =  array_merge( $model->common_not_mandatory_field(), CHtml::listData( $category->relatedFieldsMandatory, 'field_name', 'field_name' ) );
                $model->dynamic  =  true;

                //$model->dynamicArray = array_merge( array_diff( ( array )$fields, $model->dynamicFields() ) );
                $model->dynamicArray =  $model->getExcludeArray( ( array )$fields ) ;
                ;
                $model->_notMadatory =  $not_mandatory_fields;

                $model->country = $attributes[ 'country' ];
                $model->state = $attributes[ 'state' ];
                $model->listing_type = $attributes[ 'listing_type' ];
                //$model->city = $attributes[ 'city' ];
                $model->section_id = $attributes[ 'section_id' ];
                $model->sub_category_id = $attributes[ 'sub_category_id' ];
                if ( isset( $attributes[ 'model' ] ) )
                {
                    $model->model = ( $attributes[ 'model' ] == 0 )? 'Others': $attributes[ 'model' ] ;
                }

                $image_array  = array() ;

                if ( isset( $model->adImages ) ) {
                    foreach ( $model->adImages as $k=>$v )
                    {
                        $image_array[] = $v->image_name;
                    }
                }

                if ( isset( $attributes[ 'ad_title' ] ) )
                {

                    $model->attributes = $attributes;
                    if ( isset( Yii::app()->params[ 'POST' ][ $model->modelName ][ 'ad_description' ] ) ) {
                        $model->ad_description = Yii::app()->ioFilter->purify( Yii::app()->params[ 'POST' ][ $model->modelName ][ 'ad_description' ] );
                    }

                    if ( isset( $attributes[ 'model' ] ) )
                    {
                        $model->model = ( $attributes[ 'model' ] == 0 )? 'Others': $attributes[ 'model' ] ;
                    }
                    $model->category_id = $category->category_id;
                    //  $model->added_date = date( 'Y-m-d h:i:s' );
                    if ( $model->validate() )
                    {
                        $jsonData = json_encode( array() );

                        if ( isset( $attributes[ 'location_latitude' ] ) and $model->save() )
                        {

                            $room_image = new AdImage;
                            $room_image->deleteAll( array( 'condition'=>'ad_id=:ad_id', 'params'=>array( ':ad_id'=>$model->id ) ) );
                            $imgArr =  explode( ',', $model->image );

                            if ( $imgArr )
                            {

                                $img_saved = false;
                                foreach ( $imgArr as $k )
                                {

                                    if ( !$img_saved and $model->image != '' )
                                    {

                                        $model->updateByPk( $id, array( 'image'=>$k ) );

                                    }
                                    $room_image->isNewRecord = true;
                                    $room_image->id = '';
                                    $room_image->ad_id = $model->id;
                                    $room_image->image_name =  $k;
                                    $room_image->save();

                                }

                            }
                            $am = new  AdAmenities();
                            $am->deleteAll( array( 'condition'=>'ad_id=:ad_id', 'params'=>array( ':ad_id'=>$model->id ) ) );
                            if ( $ameni = Yii::app()->request->getPost( 'amenities' ) )
                            {

                                foreach ( $ameni as $k )
                                {

                                    $am->isNewRecord = true;
                                    $am->ad_id = $model->id;
                                    $am->amenities_id =  $k;
                                    $am->save();
                                }

                            }
                            $notify->addSuccess( Yii::t( 'app', 'Your form has been successfully saved!' ) );
                            $this->redirect( Yii::app()->createUrl( 'place_an_ad/success_edit', array( 'id'=>$model->id ) ) );
                        } else {
                            $image_array = array();
                            $model->amenities = Yii::app()->request->getPost( 'amenities' );
                            $exp =  explode( ',', $model->image );

                            if ( $exp )
                            {
                                foreach ( $exp as $k=>$v )
                                {
                                    if ( $v != '' )
                                    {
                                        $image_array[] = $v;
                                    }
                                }
                            }

                            $this->actionDetails_2( $model, $subcategory, $category, $fields, $image_array, $jsonData );
                        }

                    } else {

                        $model->amenities = Yii::app()->request->getPost( 'amenities' );
                        $image_array = array();
                        $exp =  explode( ',', $model->image );
                        if ( $exp )
                        {
                            foreach ( $exp as $k=>$v )
                            {
                                if ( $v != '' )
                                {
                                    $image_array[] = $v;
                                }
                            }
                        }

                    }

                }
                $model->sub_category_id = $attributes[ 'sub_category_id' ];
                $this->actionDetails_edit( $model, $subcategory, $category, $fields, $image_array );

            } else {
                $this->render( 'form-edit', compact( 'model', 'country', 'category', 'state', 'sub_category', 'city', 'section', 'vehicleModel', 'list_type' ) );

            }
        }
        * */

    /**
     * Delete existing user
     */

    public function actionDelete($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $model->updateByPk($id, array('isTrash' => Yii::app()->params['onTrash']));

        //144
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }

    public function actionVerified($id, $verified)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $featured = ($verified == '1') ? '0' : '1';
        $model->updateByPk($id, array('verified' => $featured, 'last_updated' => date('Y-m-d h:i:s')));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }

    public function actionFeatured($id, $featured)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $featured = ($featured == 'N') ? 'Y' : 'N';
        $model->updateByPk($id, array('featured' => $featured, 'last_updated' => date('Y-m-d h:i:s')));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }

    public function actionHot($id, $hot)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $hot = (is_null($hot) || $hot == '0') ? '1' : '0';
        $model->updateByPk($id, array('hot' => $hot, 'last_updated' => date('Y-m-d h:i:s')));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        }
    }

    public function actionStatus($id, $status)
    {

        $model = PlaceAnAd::model()->findByPk((int)$id);
        $status = (string)$status;
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
 
        $model->updateByPk($id, array('status' => $status));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSelect_state()
    {
        echo   States::model()->ListDataForJSON(Yii::app()->request->getPost('country'));
        exit;
    }

    public function actionSelect_city()
    {
        echo   City::model()->ListDataForJSON(Yii::app()->request->getPost('state'));
        exit;
    }

    public function actionSelect_category()
    {

        echo   Category::model()->ListDataForJSON_ID_BySEction(Yii::app()->request->getPost('section'));
        exit;
    }

    public function actionSelect_sub_category()
    {
        echo   Subcategory::model()->ListDataForJSON_ID(Yii::app()->request->getPost('category'));
        exit;
    }

    public function actionSelect_model($id)
    {
        $subcategory =  Subcategory::model()->findByPk($id);

        $fields = array();
        $fields =  ($subcategory->change_parent_fields == 'N') ? CHtml::listData($subcategory->category->relatedFields, 'field_name', 'field_name') : CHtml::listData($subcategory->relatedFields, 'field_name', 'field_name');

        if (in_array('model', $fields)) {
            echo   VehicleModel::model()->ListDataForJSON_ID_ByModel($id);
            exit;
        } else {
            echo 0;
        }
    }
    public $image_size;
    public $image_name;

    public function actionUpload($width = null, $height = null)
    {

        ini_set('memory_limit', '-1');
        $this->fileUploadDropzone();
        exit;

        ini_set('memory_limit', '-1');

        if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER == '1') {
            $file = $_FILES['file']['name'];
            $file_orginal = $_FILES['file']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $File = pathinfo($file, PATHINFO_FILENAME);
            //$img = $File.'_'.uniqid( rand( 0, time() ) ).'.'.$ext;

            $img = rand(0, 9999) . '_' . time() . '.' . $ext;

            $awsAccessKey = ENABLED_AWS_ACCESS;
            $awsSecretKey = ENABLED_AWS_SECRET;

            $bucketName = ENABLED_BUCKET_NAME;

            Yii::import('common.extensions.amazon.S3');
            $s3 = new S3($awsAccessKey, $awsSecretKey);
            $uploadName = $_FILES['file']['name'];
            $ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
            echo $img;
        } else {
            $path =  Yii::getPathOfAlias('root.uploads.images');

            //Yii::import( 'backend.extensions.ResizeImage' );
            if ($_FILES['file']['tmp_name']) {
                ini_set('memory_limit', '-1');
                $file = $_FILES['file']['name'];
                $file_orginal = $_FILES['file']['tmp_name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $File = pathinfo($file, PATHINFO_FILENAME);
                $new_name =  substr(preg_replace('/[^a-zA-Z0-9._-]/', '_', "{$File}"), 0, 220);
                $new_name = empty($new_name) ? 'Untitled' : $new_name;
                $img = date('my') . '_' . time() . $new_name . '_' . '.' . $ext;
                if (!empty($width)) {

                    $detSize = getimagesize($_FILES['file']['tmp_name']);
                    if ($detSize) {
                        if (empty($height)) {
                            $aspectRatio = $detSize[1] / $detSize[0];
                            $newHeight = (int)($aspectRatio * $width);
                        } else {
                            $newHeight = $height;
                        }
                        $this->image_size = $detSize;

                        $this->image_name = $img;

                        $tempPath = Yii::getPathOfAlias('root.uploads.resized');

                        $resized = $this->makeTumbnail($_FILES['file']['tmp_name'], $width, $newHeight, $tempPath);
                    }
                }
                move_uploaded_file($_FILES['file']['tmp_name'], $path . "/{$img}");
                echo $img;
            } else {
                echo '0';
            }
        }
    }

    function actionDelete_image()
    {

        $str = '';
        if (isset($_POST['inp'])) {

            $ar = explode(',', $_POST['inp']);

            if ($ar) {
                foreach ($ar as $k => $val) {

                    if ($val != $_POST['file'] and $val != '') {

                        $str .= ',' . $val;
                    }
                }
            }
        }
        echo $str;
    }

    public function actionSuccess($id)
    {
        $model = PlaceAnAd::model()->findByPk($id);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->setData(array(
            'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, 'List your property'),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->render('success', compact('model'));
    }

    public function actionSuccess_edit($id)
    {
        $model = PlaceAnAd::model()->findByPk($id);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $this->setData(array(
            'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, 'Update Listing'),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->render('success-edit', compact('model'));
    }

    public function actionLoadCities()
    {
        $id = null;
        if (isset($_POST['state'])) {
            $id = $_POST['state'];
        }
        $data = City::model()->FindCities($id);
        $data = CHtml::listData($data, 'city_id', 'city_name');
        echo "<option value=''>All Cities</option>";
        foreach ($data as $k => $v)
            echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
    }

    public function actionImage_management($id)
    {

        $ad = PlaceAnAd::model()->findByPk((int)$id);
        if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user =  new AdImage;

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['priority'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $user->isNewRecord = true;

                    $user->updateByPk($menuId, array('priority' => $sortOrder));
                }
            }
            $up = $user->HighestPriorityImage($id);
            if ($up) {
                $ad->updateByPk($id, array('image' => $up->image_name));
            }

            $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));

            /* if ( $collection->success ) {
                $this->redirect( array( 'room_manage/index' ) );
            }
            * */
        }

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('room_manage', 'Image Management'),
            'pageHeading'       => Yii::t('room_manage', 'Image Management'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'Ad') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'Update'),
            )
        ));

        $this->render('image_manage', compact('ad', 'id', 'user'));
    }

    public function actionDelete_image_db($id)
    {

        $ad = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $ad->find(array('condition' => 't.id=:id', 'params' => array(':id' => $id)));
        if ($rm) {

            $man = $manager->findByPk((int)$rm->ad_id);
            if (empty($man)) {
                throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
            } else {
                $up = $ad->HighestPriorityImage($rm->ad_id);
                if ($up) {
                    $manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
                } else {
                    $manager->updateByPk($rm->ad_id, array('image' => ''));
                }
                $ad->deleteByPk($id);
            }
        }
    }

    public function actionApprove($id)
    {

        $user = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {

            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $man = $manager->findByPk((int)$rm->ad_id);
        if (empty($man)) {

            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } else {

            $rm->status = ($rm->status === 'A') ? 'I' : 'A';
            $rm->save();

            $up = $user->HighestPriorityImage($rm->ad_id);
            if ($up) {

                $manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
            } else {

                $manager->updateByPk($rm->ad_id, array('image' => ''));
            }
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect(Yii::app()->createUrl('place_an_ad/image_management', array('id' => $rm->ad_id)));
        }
    }

    public function actionDisapprove($id)
    {
        $user =  new AdImage;
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['id'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $user->isNewRecord = true;

                    $user->updateByPk($menuId, array('status' => 'I'));
                }
            }

            $notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
        }
        $this->redirect($request->urlReferrer);
    }

    public function actionApprove_selected($id)
    {
        $user =  new AdImage;
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['id'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $menuId => $sortOrder) {
                    $user->isNewRecord = true;

                    $user->updateByPk($menuId, array('status' => 'A'));
                }
            }

            $notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
        }
        $this->redirect($request->urlReferrer);
    }

    public function actionApprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $user =  new AdImage;
        $user->updateAll(array('status' => 'A'), array('condition' => 'ad_id=:id', 'params' => array(':id' => $id)));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
        $this->redirect($request->urlReferrer);
    }

    public function actionDispprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $user =  new AdImage;
        $user->updateAll(array('status' => 'I'), array('condition' => 'ad_id=:id', 'params' => array(':id' => $id)));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
        $this->redirect($request->urlReferrer);
    }

    public function actionAd_image()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model =  new PlaceAnAd();
        $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
        $model->unsetAttributes();
        $model->hide_new_development = '1';

        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->isTrash = '0';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, 'Image Management'),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('ad_image', compact('model'));
    }

    public function actionImage_approve_manage()
    {
        $id = $_POST['id'];
        $user = new AdImage();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $manager = new PlaceAnAd();
        $man = $manager->findByPk((int)$rm->ad_id);
        if (empty($man)) {

            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } else {

            $rm->status = ($rm->status === 'A') ? 'I' : 'A';
            $rm->save();

            $up = $user->HighestPriorityImage($rm->ad_id);
            if ($up) {

                $manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
            } else {

                $manager->updateByPk($rm->ad_id, array('image' => ''));
            }
        }
    }

    function Get_LatLng_From_Google_Maps($address)
    {

        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

        // Make the HTTP request
        $data = @file_get_contents($url);
        // Parse the json response
        $jsondata = json_decode($data, true);

        // If the json data is invalid, return empty array
        if (!$this->check_status($jsondata))   return array();

        $LatLng = array(
            'lat' => $jsondata['results'][0]['geometry']['location']['lat'],
            'lng' => $jsondata['results'][0]['geometry']['location']['lng'],
        );

        return $LatLng;
    }

    function check_status($jsondata)
    {
        if ($jsondata['status'] == 'OK') return true;
        return false;
    }

    public function actionCheckModel($id = null)
    {
        $category =  Category::model()->findByPk($id);
        if ($category) {
            if (in_array('model', CHtml::listData($category->relatedFields, 'field_name', 'field_name'))) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        exit;
    }

    public function actionCommunity()
    {
        $limit = 30;
        $request = Yii::app()->request;
        $criteria = Community::model()->search(1);
        //$criteria->with = array( 'district'=>array( 'with'=>array( 'city'=>array( 'with'=>'state' ) ) ) );

        //$criteria->together = true;

        $region_id = $request->getQuery('state_id');
        $country_id = $request->getQuery('country_id');
        $condition = '';
        if ($region_id) {
            $criteria->params = array(':state' => $request->getQuery('state_id'));

            $condition    .= ' and t.region_id=:state ';
            $criteria->params[':state'] =  $region_id;
        } else if (!empty($country_id)) {
            $criteria->join  .= ' LEFT JOIN {{countries}} c_st on c_st.country_id = st.country_id  ';
            $condition .= ' and t.country_id=:con or c_st.country_id = :con ';
            $criteria->params[':con'] =  $country_id;
        }
        if ($condition) {
            if ($criteria->condition) {
                $criteyria->condition .= $condition;
            } else {
                $criteria->condition .= '1 and ' . $condition;
            }
        }

        $criteria->compare('community_name', $request->getQuery('q'), true);
        $count = Community::model()->count($criteria);
        $criteria->limit   =  $limit;

        $page = Yii::app()->request->getQuery('page', 1);
        $offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
        $criteria->offset =  $offset;
        $Result = Community::model()->findAll($criteria);
        $ar = array();

        if ($Result) {
            foreach ($Result as $k => $v) {
                $ar[] = array('id' => $v->community_id, 'text' => $v->community_name . '(' . $v->location . ')');
            }
        }
        $record = array('total_count' => $count, 'incomplete_results' => false, 'items' => $ar);

        echo  json_encode($record);
        Yii::app()->end();
    }

    public function actionDistrict()
    {
        $limit = 30;
        $request = Yii::app()->request;
        $criteria = new CDbCriteria;
        $criteria->with = array('city' => array('with' => array('state')));
        $criteria->condition = 'state.state_id=:state';
        $criteria->together = true;

        $criteria->params = array(':state' => $request->getQuery('state_id'));

        $criteria->compare('district_name', $request->getQuery('q'), true);
        $count = District::model()->count($criteria);
        $criteria->limit   =  $limit;

        $page = Yii::app()->request->getQuery('page', 1);
        $offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
        $criteria->offset =  $offset;
        $Result = District::model()->findAll($criteria);
        $ar = array();

        if ($Result) {
            foreach ($Result as $k => $v) {
                $ar[] = array('id' => $v->district_id, 'text' => $v->district_name);
            }
        }
        $record = array('total_count' => $count, 'incomplete_results' => false, 'items' => $ar);

        echo  json_encode($record);
        Yii::app()->end();
    }

    public function actionCustomer()
    {
        $limit = 30;
        $request = Yii::app()->request;
        $criteria = new CDbCriteria;
        $criteria->select = 't.first_name,t.last_name,t.user_type,t.user_id,cn.country_name';
        $criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'), $request->getQuery('q'), true);
        $criteria->join .= 'LEFT JOIN {{countries}} cn ON cn.country_id = t.country_id  ';
        $criteria->compare('t.isTrash', '0');
        $criteria->compare('t.status', 'A');
        $count = ListingUsers::model()->count($criteria);
        $criteria->order = 't.first_name';

        $criteria->limit   =  $limit;

        $page = Yii::app()->request->getQuery('page', 1);
        $offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
        $criteria->offset =  $offset;

        $Result = ListingUsers::model()->findAll($criteria);
        $ar = array();

        if ($Result) {
            foreach ($Result as $k => $v) {
                $ar[] = array('id' => $v->user_id, 'text' => $v->fullName . '(' . $v->user_type . '::' . $v->country_name . ')');
            }
        }
        $record = array('total_count' => $count, 'incomplete_results' => false, 'items' => $ar);

        echo  json_encode($record);
        Yii::app()->end();
    }

    public function actionSubCoummunity()
    {
        $request = Yii::app()->request;
        $criteria = new CDbCriteria;
        $criteria->condition =   't.community_id=:community_id';
        $criteria->params = array(':community_id' => $request->getQuery('id'));

        $criteria->compare('sub_community_name', $request->getQuery('q'), true);
        $count = SubCommunity::model()->count($criteria);
        $Result = SubCommunity::model()->findAll($criteria);
        $ar = array();

        if ($Result) {
            foreach ($Result as $k => $v) {
                $ar[] = array('id' => $v->sub_community_id, 'text' => $v->sub_community_name);
            }
        }
        $record = array('total_count' => $count, 'incomplete_results' => false, 'items' => $ar);

        echo  json_encode($record);
        Yii::app()->end();
    }

    public function makeTumbnail($filename, $width = 150, $height = true, $tempPath)
    {
        $url      = $filename;
        $new_file_name =  $this->image_name;
        $filename = $tempPath . '/' . $new_file_name;

        return $this->resize_crop_image($width, $height, $url, $filename, 80);
    }

    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
    {

        $imgsize = $this->image_size;
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = 'imagecreatefromgif';
                $image = 'imagegif';
                break;

            case 'image/png':
                $image_create = 'imagecreatefrompng';
                $image = 'imagepng';
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = 'imagecreatefromjpeg';
                $image = 'imagejpeg';
                $quality = 100;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        if ($mime == 'image/png') {
            imageAlphaBlending($dst_img, false);
            imageSaveAlpha($dst_img, true);
            imagefilledrectangle($dst_img, 0, 0, $max_width, $max_height, imagecolorallocate($dst_img, 255, 255, 255));
        }
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img) {
            imagedestroy($dst_img);
            return true;
        }
        if ($src_img) {
            imagedestroy($src_img);
            return true;
        }
    }

    public function actionView($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->renderPartial('_view', compact('user', 'model', 'personal'));
    }

    public function actionStatus_change($id = null, $val = null)
    {
        // if (!Yii::app()->request->isAjaxRequest) {
            //     return false;
            // }
        $user = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $user::model()->updateByPk($id, array('status' => $val));
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionRefresh_date($id = null)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, Yii::t('app', 'Invalid request.'));
        }
    
        $ad = PlaceAnAd::model()->findByPk((int)$id);
    
        if (empty($ad)) {
            echo CJSON::encode(['success' => false, 'message' => 'The requested ad does not exist.']);
            Yii::app()->end();
        }
    
        // Update the date_added field
        $ad->date_added = date('Y-m-d H:i:s');
        if ($ad->save()) {
            echo CJSON::encode([
                'success' => true,
                'newDate' => date('d-M-Y', strtotime($ad->date_added)),
            ]);
        } else {
            echo CJSON::encode([
                'success' => false,
                'message' => 'Failed to update the date.',
            ]);
        }
    
        Yii::app()->end();
    }
    

    public function actionUpload_floor_plan($width = null, $height = null)
    {
        if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER == '1') {
            $file = $_FILES['file']['name'];
            $file_orginal = $_FILES['file']['tmp_name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $File = pathinfo($file, PATHINFO_FILENAME);
            //$img = $File.'_'.uniqid( rand( 0, time() ) ).'.'.$ext;

            $img = rand(0, 9999) . '_' . time() . '.' . $ext;

            $awsAccessKey = ENABLED_AWS_ACCESS;
            $awsSecretKey = ENABLED_AWS_SECRET;

            $bucketName = ENABLED_BUCKET_NAME;

            Yii::import('common.extensions.amazon.S3');
            $s3 = new S3($awsAccessKey, $awsSecretKey);
            $uploadName = $_FILES['file']['name'];
            $ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
            echo $img;
        } else {

            $path =  Yii::getPathOfAlias('root.uploads.floor_plan');

            //Yii::import( 'backend.extensions.ResizeImage' );
            if ($_FILES['file']['tmp_name']) {
                ini_set('memory_limit', '-1');
                $file = $_FILES['file']['name'];
                $file_orginal = $_FILES['file']['tmp_name'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                $File = pathinfo($file, PATHINFO_FILENAME);
                $new_name =  substr(preg_replace('/[^a-zA-Z0-9._-]/', '_', "{$File}"), 0, 220);
                $new_name = empty($new_name) ? 'Untitled' : $new_name;
                $img = $new_name . '_' . time() . '.' . $ext;
                move_uploaded_file($_FILES['file']['tmp_name'], $path . "/{$img}");
                echo $img;
            } else {
                echo '0';
            }
        }
    }

    function actionDelete_floor_plan()
    {

        $str = '';
        if (isset($_POST['inp'])) {

            $ar = explode(',', $_POST['inp']);

            if ($ar) {
                foreach ($ar as $k => $val) {

                    if ($val != $_POST['file'] and $val != '') {

                        $str .= ',' . $val;
                    }
                }
            }
        }
        echo $str;
    }

    public function actionUpdatemetatag()
    {
        $request = Yii::app()->request;
        $model = PlaceAnAd::model()->findByPk((int)$_POST['PlaceAnAd']['id']);
        if ($model) {
            $model->updateByPk((int)@$_POST['PlaceAnAd']['id'], array('meta_title' => @$_POST['PlaceAnAd']['meta_title'], 'meta_description' => @$_POST['PlaceAnAd']['meta_description']));
            echo (int)$_POST['PlaceAnAd']['id'];
        } else {
            echo 0;
        }
    }

    public function actionSavetaglist()
    {

        $ad_id = (int)$_POST['PlaceAnAd']['id2'];
        $request = Yii::app()->request;
        PlaceAdTags::model()->deleteAllByAttributes(array('ad_id' => $ad_id));;
        $items = @$_POST['PlaceAnAd']['tags_list'];
        if ($items) {
            foreach ($items as $tags) {
                $model = new PlaceAdTags();
                $model->ad_id = $ad_id;
                $model->tag_id = $tags;
                $model->save();
            }
        }
        echo 1;
    }

    public function actionGet_tag_list($id = null, $sect_id = null, $category_id = null, $listing_type = null)
    {
        $section_id = $sect_id;
        $section_active =  array();
        if (!empty($section_id)) {
            $inactive_category_active = CHtml::listData(TagCategory::model()->findAllByAttributes(array('category_id' => $category_id)), 'tag_id', 'tag_id');
            $section_active2 = CHtml::listData(TagType::model()->findAllByAttributes(array('type_id' => $listing_type)), 'tag_id', 'tag_id');
            $section_active = CHtml::listData(TagSection::model()->findAllByAttributes(array('section_id' => $section_id)), 'tag_id', 'tag_id');
            $section_active_a = CHtml::listData(Tag::model()->findAllByAttributes(array('enable_all' => '1')), 'tag_id', 'tag_id');
            $section_active = array_replace($section_active, $section_active_a, $section_active2);
            if (!empty($inactive_category_active)) {
                foreach ($inactive_category_active as $tg) {
                    if (isset($section_active[$tg])) {
                        unset($section_active[$tg]);
                    }
                }
            }
        }
        echo json_encode(array('items' => CHtml::listData(PlaceAdTags::model()->findAllByAttributes(array('ad_id' => $id)), 'tag_id', 'tag_id'), 'enabled' => $section_active));;
        Yii::app()->end();
    }

    public function actionGet_tag_list2($id = null, $listing_type = null)
    {
        $section_active =  array();
        if (!empty($listing_type)) {

            $section_active = CHtml::listData(TagTypeCustomer::model()->findAllByAttributes(array('type_id' => $listing_type)), 'tag_id', 'tag_id');
        }
        echo json_encode(array('items' => CHtml::listData(ListingUsersTag::model()->findAllByAttributes(array('user_id' => $id)), 'tag_id', 'tag_id'), 'enabled' => $section_active));;
        Yii::app()->end();
    }

    public function actionSavetaglist2($model = null)
    {

        $ad_id = (int)$_POST[$model]['id2'];
        $request = Yii::app()->request;
        ListingUsersTag::model()->deleteAllByAttributes(array('user_id' => $ad_id));;
        $items = @$_POST[$model]['tags_list'];
        if ($items) {
            foreach ($items as $tags) {
                $model = new ListingUsersTag();
                $model->user_id = $ad_id;
                $model->tag_id = $tags;
                $model->save();
            }
        }
        echo 1;
    }

    //CHtml::listData( States::model()->AllListingStatesOfCountry( ( int ) $model->country ), 'state_id', 'state_name' ), $model->getHtmlOptions( 'state', array( 'empty'=>'Select City', 'class'=>'form-control select2', 'data-url'=>Yii::App()->createUrl( $this->id.'/select_city' ), 'onchange'=>'load_via_ajax(this,"city")
    public function actionSelect_city_new($id = null)
    {
        $html = '<option value = "">Select City</option>';
        $states = States::model()->AllListingStatesOfCountry((int) $id);


        if (!empty($states)) {
            foreach ($states as $k) {
                $html .= '<option value = "' . $k->state_id . '">' . $k->state_name . '</option>';
            }
        }
        echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
    }
    public function actionSelect_location($id = null)
    {
        $html = '<option value = "">Select Location</option>';
        $states = City::model()->FindCities((int) $id);


        if (!empty($states)) {
            foreach ($states as $k) {
                $html .= '<option value = "' . $k->city_id . '">' . $k->city_name . '</option>';
            }
        }
        echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
    }
    public function actionSelect_category2($id = null)
    {
        $category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id);
        $html = '<option value = "">Select Category</option>';


        if (!empty($category)) {
            foreach ($category as $k => $v) {
                $html .= '<option value = "' . $k . '">' . $v . '</option>';
            }
        }
        echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

        exit;
    }
    public function actionSelect_sub_category2($id = null)
    {
        $category =    Subcategory::model()->ListDataForJSON_IDNew($id);
        $html = '<option value = "">Select Category</option>';


        if (!empty($category)) {
            foreach ($category as $k => $v) {
                $html .= '<option value = "' . $k . '">' . $v . '</option>';
            }
        }
        echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

        exit;
        exit;
    }
    public function actionSelect_category3($id = null)
    {
        $category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id);

        $html =  CHtml::radioButtonList('listing_type', '', $category, array(
            'onchange' => 'load_via_ajax_main_category(this)',
            'data-url' => Yii::App()->createUrl($this->id . '/select_category4'),
            'separator' => '',
            'labelOptions' => array('class' => ''),
            'template' => '<div class="inputGroup">{input}   {label}</div>'
        ));
        echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

        exit;
    }
    public function actionSelect_category4($id = null)
    {
        $category =    Category::model()->ListDataForJSON_ID_ByListingType($id);

        $html =  CHtml::radioButtonList('category_id', '', $category, array(
            'onchange' => 'validateInputSector()',
            'separator' => '',
            'labelOptions' => array('class' => ''),
            'template' => '<div class="inputGroup">{input}   {label}</div>'
        ));
        echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

        exit;
    }
    public function actionGetCityId($city = null)
    {
        $criteria = new CDbCriteria;
        $criteria->select = "state_id,state_name";
        $criteria->condition = "lower(state_name)=:state";
        $criteria->params[':state'] = strtolower($city);
        $states = States::model()->find($criteria);


        if (!empty($states)) {
            echo json_encode(array('status' => 1, 'state_id' => $states->state_id));
        } else {
            echo json_encode(array('status' => 0));
        }
        exit;
    }
    public function actionBulk_action()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $action = $_GET['bulk_action'];
        $items  = $_GET['bulk_item'];

        if ($action == PlaceAnAd::BULK_ACTION_TRASH && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('isTrash' => '1'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_RESTORE && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('isTrash' => '0'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_TRASLATE && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->getUpdateTag();
                $customer->getUpdateImages();
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_UNPUBLISH && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('status' => 'I'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_UNLEASE && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('property_status' => '0'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        if ($action == PlaceAnAd::BULK_ACTION_PUBLISH && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                //echo $customer->id;echo "<br />";

                $customer->updateByPk($item, array('status' => 'A'));
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }


        if ($action == PlaceAnAd::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new PlaceAnAd();
            foreach ($items as $item) {
            
                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                $customer->delete();;
                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_EXPIRED && count($items)) {


            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                $customer->updateByPk($customer->id, array('extended_on' => date('Y-m-d h:i:s'), 'n_send_at' => NULL));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_SENDNOTIFICATIOB && count($items)) {


            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }
                $send =      $customer->SendNotificationExpire;
                PlaceAnAd::model()->updateByPk($customer->id, array('n_send_at' => date('Y-m-d h:i:s')));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }

        if ($action == PlaceAnAd::BULK_ACTION_REFRESH && count($items)) {


            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                PlaceAnAd::model()->updateByPk($customer->id, array('last_updated' => date('Y-m-d H:i:s')));


                $affected++;
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }



        if ($action == PlaceAnAd::BULK_ACTION_DOWNLOAD && count($items)) {
            $affected = 0;
            $customerModel = new  PlaceAnAd();
            foreach ($items as $item) {

                $customer = $customerModel->findByPk($item);
                if (!$customer) {
                    continue;
                }

                $ids =   $customer->city;
                if (!empty($ids)) {
                    $citymodel = City::model()->findByPk((int)$ids);
                    if (!empty($citymodel) and !empty($citymodel->location_latitude) and !empty($citymodel->location_longitude)) {

                        $src  = 'https://maps.googleapis.com/maps/api/staticmap?center = ' . $citymodel->location_latitude . '%2C' . $citymodel->location_longitude . '&language = en&size = 640x256&zoom = 15&scale = 1&key = AIzaSyCE4LF1fuKkM5b0ffhY7dEoZ4ULkG2Uazk';
                        $time = date('Ymdhis') . '_' . time();
                        $desFolder =   Yii::getPathOfAlias('root.uploads.map') . '/';;
                        $imageName = 'google-map_' . $time . '.png';
                        $imagePath = $desFolder . $imageName;
                        file_put_contents($imagePath, file_get_contents($src));
                        $citymodel->updateByPk($citymodel->city_id, array('image' => $imageName));
                        $affected++;
                    }
                }
            }

            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
        }
        $defaultReturn = $request->getServer('HTTP_REFERER', array('place_property/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
    public function actionImage_management2($status = 'I')
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new AdImage();
        $_GET['status'] = $status;

        if ($request->isPostRequest) {
            $sortOrderAll = $_POST['select_action'];

            if (count($sortOrderAll) > 0 and isset($_POST['module']) and in_array($_POST['module'], array('1', '2', '3'))) {
                $module = $_POST['module'];
                $customerModel = new  AdImage();
                foreach ($sortOrderAll as $menuId) {
                    $customer = $customerModel->findByPk($menuId);
                    if (!$customer) {
                        continue;
                    }
                    switch ($module) {
                        case '1':
                            $customer->updateByPk($menuId, array('status' => 'A'));
                            break;
                        case '2':
                            $customer->updateByPk($menuId, array('status' => 'I'));
                            break;
                        case '3':
                            $customer->delete();
                            break;
                    }
                }
            }
            switch ($module) {
                case '1':
                    $notify->addSuccess(Yii::t('app', 'Status successfully updated!'));
                    break;
                case '2':
                    $notify->addSuccess(Yii::t('app', 'Status successfully updated!'));
                    break;
                case '3':
                    $notify->addSuccess(Yii::t('app', 'Status successfully deleted!'));
                    break;
            }

            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->layout = 'image_mamnage';

        $attributes = (array) $_GET;
        $attributes = (array) array_filter($attributes);
        $limit = '10';
        $criteria        =  AdImage::model()->list_profile(false, $attributes, '', 1);
        $profileCount    =  AdImage::model()->count($criteria);
        $criteria->limit =  $limit;
        $profileList = AdImage::model()->findAll($criteria);

        $tit = 'Image Managemnt';
        $this->getData('pageScripts')->add(array('src' => Yii::App()->apps->getBaseUrl('assets/js/scrol_main_new.js'), 'priority' => -100));
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Image Management"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('image_list', compact('profileList', 'attributes', 'profileCount', 'tit', 'limit'));
    }
    public function action_list_image()
    {

        parse_str(Yii::app()->request->getQuery('formData', ''), $formData);
        $formData = (array) $_GET;
        $count_future = 1;

        $type = null;
        $works =  AdImage::model()->list_profile($count_future, $formData, $type);


        $msgHTML = '';
        if (!empty($count_future)) {
            $next_result   = !empty($works['future_count']) ?  1 : 0;
            $total         = isset($works['total']) ? $works['total'] : false;
            $profileList           = $works['result'];
        }


        if ($profileList) {

            $msgHTML .= $this->renderPartial('_list_image', compact('profileList'), true);


            if (!empty($count_future)) {
                if ($total != false) {
                    echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result, 'total' => $total));
                } else {
                    echo  json_encode(array('dataHtml' => $msgHTML, 'future' => $next_result));
                }
            } else {
                echo   $msgHTML;
            }
        } else {
            echo '1';
        }
        Yii::app()->end();
    }

    public function actionNotification($id = null)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }



        $send =      $model->SendNotificationExpire;
        PlaceAnAd::model()->updateByPk($model->id, array('n_send_at' => date('Y-m-d h:i:s')));

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        echo 1;
        exit;
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully send notification!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
        } else {
        }
    }
    public function actionFindCitiesAd($zone_id = null)
    {

        $query = (!empty($_GET['q'])) ?   $_GET['q']   : null;


        $status = true;

        /*areas Fetching */
        $criteria = new CDbCriteria;
        $criteria->condition  = '1';
        $criteria->select = 't.city_id, t.state_id, cn.country_id, t.city_name, cn.cords as country_name, st.state_name';
        $criteria->join = ' INNER JOIN {
                    {
                        states}
                    }  st on st.state_id = t.state_id   ';
        $criteria->join .= ' INNER JOIN {
                        {
                            countries}
                        }  cn on cn.country_id = st.country_id   ';
        $criteria->condition .= ' and   cn.show_on_listing = "1"';
        $criteria->condition  .= ' and ( t.city_name like :query )';

        $criteria->limit = '15';
        $criteria->params[':query'] = '%' . $query . '%';

        $areas = City::model()->findAll($criteria);
        /*areas Fetching */


        $resultUsers = [];
        if ($areas) {
            foreach ($areas as $k => $v) {

                $resultUsers[] =  array(
                    "id"        => $v->city_id,
                    "state_id"        => $v->state_id,
                    "country_id"        => $v->country_id,
                    "username"  => trim($v->city_name),
                    "avatar"    => "",
                    "country" =>  '( ' . $v->state_name . ', ' . $v->country_name . ' )',
                );
            }
        }



        $resultProjects = [];

        // Means no result were found
        if (empty($resultUsers) && empty($resultProjects)) {
            $status = false;
        }

        header('Content-type: application/json;
                        charset = utf-8');

        echo json_encode(array(
            "status" => $status,
            "error"  => null,
            "data"   => array(
                "user"      => $resultUsers,

            )
        ));
    }
    public function actionImport_stats()
    {

        $import_criteria = PlaceAnAdNew::model()->import_stats_criteria();

        $total_imported_criteria = $import_criteria;
        $total_imported = PlaceAnAdNew::model()->count($total_imported_criteria);

        $total_imported_today_criteria = $import_criteria;
        $total_imported_today_criteria->condition .= ' and DATE( t.date_added ) = :today';
        $total_imported_today_criteria->params[':today'] = date('Y-m-d');
        $total_imported_today = PlaceAnAdNew::model()->count($total_imported_today_criteria);

        $total_imported_bayut_criteria = PlaceAnAdNew::model()->import_stats_criteria();
        $total_imported_bayut_criteria->condition .= ' and t.site = :bayut';
        $total_imported_bayut_criteria->params[':bayut'] = 'B';
        $total_imported_bayut = PlaceAnAdNew::model()->count($total_imported_bayut_criteria);

        $total_imported_finder_criteria = PlaceAnAdNew::model()->import_stats_criteria();
        $total_imported_finder_criteria->condition .= ' and t.site = :finder';
        $total_imported_finder_criteria->params[':finder'] = 'P';
        $total_imported_finder = PlaceAnAdNew::model()->count($total_imported_finder_criteria);


        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAdNew('import_stats');
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "Import Stats"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Import Stats"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "Import Stats") => $this->createUrl(Yii::app()->controller->id . '/import_stats'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('import_stats', compact('model', 'tags', 'total_imported', 'total_imported_today', 'total_imported_bayut', 'total_imported_bayut', 'total_imported_finder'));
    }
    public function actionDetail_list($user = null, $type = null)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 't.company_name, t.first_name';
        $criteria->condition = ' 1 and t.user_id = :user ';
        $criteria->params[':user'] = (int) $user;
        $userModel = ListingUsers::model()->find($criteria);
        if (empty($userModel)) {
            throw new CHttpException(404, Yii::t('app', 'No user record found!.'));
        }

        switch ($type) {
            case 'B':
                $tie = 'Bayut List';
                break;
            case 'P':
                $tie = 'PropertyFinder List';
                break;
            default:
                throw new CHttpException(404, Yii::t('app', 'import variable not defined!.'));
                break;
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAdNew('import_stats_individual_list');
        $model->unsetAttributes();
        $model->attributes = (array)$request->getQuery($model->modelName, array());
        $model->user_id =  (int) $user;
        $model->site = $type;
        $nameTitle = !empty($userModel->company_name) ? $userModel->company_name : $userModel->first_name;
        $nameTitle .= '-' . $tie;
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, $nameTitle),
            'pageHeading'       => Yii::t(Yii::app()->controller->id,  $nameTitle),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "Import Stats") => $this->createUrl(Yii::app()->controller->id . '/import_stats'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('import_stats_list', compact('model', 'user', 'type'));
    }


    public function actionCreate_business($cat = null, $id = null)
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $image_array = array();
        // echo "<pre>";
        // print_r($request->getPost($model->modelName, array()));
        // exit;
        if ($id) {
            $model =  BusinessForSale::model()->findByPk($id);
            if (isset($model->adImages)) {
                foreach ($model->adImages as $k => $v) {
                    $image_array[] = $v->image_name;
                }
            }
        }
        if (empty($model)) {
            $model = new BusinessForSale();
        }
        $model->scenario = 'new_insert';
        $model->country =  '66124';
        $model->section_id =  '6';
        if (!empty($cat)) {
            $model->category_id = $cat;
        }

        $country = Countries::model()->ListDataForJSON();

        $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();

        $this->setData(array(
            'pageMetaTitle'     =>   Yii::t('app', ' {
                            name}
                            :: {
                                p}
                                ', array(' {
                                    name}
                                    ' => 'Post your AD ', ' {
                                        p}
                                        ' => Yii::app()->options->get('system.common.site_name'))),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
        ));
        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));


        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q = 1')));

        $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
        if (Yii::app()->request->isAjaxRequest) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if (isset($attributes['hidden_category_id'])) {
                $model->category_id = $attributes['hidden_category_id'];
            }
            if (isset($attributes['nested_sub_category'])) {
                $model->nested_sub_category = $attributes['nested_sub_category'];
            }
            if (isset(Yii::app()->params['POST'][$model->modelName]['ad_description'])) {
                $model->ad_description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['ad_description']);
            }
            if (!$model->save()) {
                // $model->amenities = Yii::app()->request->getPost("amenities");
                $exp =  explode(",", $model->image);
                if ($exp) {
                    foreach ($exp as $k => $v) {
                        if ($v != "") {
                            $image_array[] = $v;
                        }
                    }
                }
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $this->insertAfterSaveFn($model);
                //$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $this->redirect(Yii::App()->createUrl($this->id . '/business'));
            }
        }
        $model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
        $this->render('form_new_business', compact('model', "country", "section", 'list_type', 'image_array'));
    }

    
    public function actionUploadExcel()
    {
        ini_set('post_max_size', '300M');
        ini_set('upload_max_filesize', '300M');
        ini_set('memory_limit', '-1');

        $rawData =  Yii::app()->request->getRawBody();
        $data = CJSON::decode($rawData, true);
        $excelData = ($data['excelData']);
        
        $newCount = 0;
        $updatedCount = 0;
        $imageInsertData = [];
        $floorPlanInsertData = [];
      
        if (is_array($excelData)) {
            // Extract unique values for batch fetching
            $refNos = array_unique(array_filter(array_column($excelData, 4), fn($value) => !empty($value)));
            $categoryNames = array_unique(array_filter(array_column($excelData, 8), fn($value) => !empty($value)));
            $categoryTypes = array_unique(array_filter(array_column($excelData, 7), fn($value) => !empty($value)));
            $stateNames = array_unique(array_filter(array_column($excelData, 11), fn($value) => !empty($value)));
            $stateSlugs = array_unique(array_map(
                fn($stateName) => $this->generateSlug($stateName), 
                array_filter(array_column($excelData, 11), fn($value) => !empty($value))
            ));
            $userEmails = array_map('strtolower', array_unique(array_filter(array_column($excelData, 39), fn($value) => !empty($value))));
          
            // Fetch data in bulk
            $ads = PlaceAnAd::model()->findAllByAttributes(['RefNo' => $refNos]);
            $categories = Category::model()->findAllByAttributes(['category_name' => $categoryNames, 'isTrash' => '0', 'status' => 'A', 'f_type' => 'P']);
            $types = Category::model()->findAllByAttributes(['category_name' => $categoryTypes, 'isTrash' => '0', 'status' => 'A', 'f_type' => 'C']);
            $states = States::model()->findAllByAttributes(['slug' => $stateSlugs, 'isTrash' => '0']);
            $users = User::model()->findAllByAttributes(['email' => $userEmails]);
    
            // Map data for quick lookup
            $adsMap = array_column($ads, null, 'RefNo');
            $categoriesMap = array_column($categories, null, 'category_name');
            $typesMap = array_column($types, null, 'category_name');
            $statesMap = array_column($states, null, 'slug');
            $usersMap = array_column($users, null, 'email');
    
            // Prepare data for batch processing
            $insertData = [];
            $updateData = [];
            $updateConditions = [];
            $updateParams = [];
    
            foreach (array_slice($excelData, 1) as $data) {
                if (empty($data) || empty($data[4])) continue; // Skip if data is empty or refNo is null
                
                if (is_numeric($data[3])) {
                    $excelDate = $data[3];
                    $unixTimestamp = ($excelDate - 25569) * 86400;
                    $dateAdded = date('Y-m-d H:i:s', $unixTimestamp);
                } elseif (strtotime($data[3]) !== false) {
                    $dateAdded = date('Y-m-d H:i:s', strtotime($data[3]));
                } else {
                    $dateAdded = null;
                }
                
                $existingAd = $adsMap[$data[4]] ?? null;
                if (empty($data[0])){
                    $data[0]    = 'PID_' . rand(100000, 999999);
                }
                if (!$existingAd){
                    $cleaned_text = mb_substr(preg_replace('/[^\w\s]/', '', $data[13]), 0, 80);
                    $baseSlug = strtolower(trim(str_replace(' ', '-', $cleaned_text), '-'));
                    $slug = $baseSlug;
                    while (PlaceAnAd::model()->exists('slug=:slug', [':slug' => $slug])) {
                        $slug = $baseSlug . '-' . rand(100, 999);
                    }
                }else {
                    $slug = $existingAd->slug;
                }
                $stateName = $data[11];
                $stateSlug = $this->generateSlug($stateName);
                if (!isset($statesMap[$stateSlug])) {
                    // Insert new state
                    $region = MainRegion::model()->findByAttributes(['slug' => $stateSlug]);
                    $regionId = $region ? $region->region_id : null;
                
                    $newState = new States();
                    $newState->state_name = $stateName;
                    $newState->country_id = 66124;
                    $newState->isTrash = 0;
                    $newState->slug = $stateSlug;
                    $newState->region_id = $regionId;
                    $newState->save();
                
                    // Update `statesMap` with the new state
                    $statesMap[$stateSlug] = $newState;
                }
                $record = [
                    'uid' => $data[0],
                    'section_id' => ($data[6] == "Sale") ? 1 : 2,
                    'listing_type' => $typesMap[$data[7]]->category_id ?? null,
                    'category_id' => $categoriesMap[$data[8]]->category_id ?? null,
                    'RefNo' => $data[4],
                    'lease_status' => empty($data[26]) ? 0 : ($data[26] == "Leased" ? 1 : 0),
                    'ad_title' => $data[13],
                    'slug' => $slug,
                    'PropertyID' => $data[5],
                    'ad_description' => $data[14],
                    'date_added' => $dateAdded,
                    'state' => $statesMap[$stateSlug]->state_id ?? 0,
                    'user_id' => $usersMap[$data[39]]->user_id ?? 31988,
                    'status' => ($data[36] == "Active") ? "A" : "I",
                    'availability' => ($data[35] == "Sold Out" ? "sold_out" : ($data[35] == "Leased Out" ? "lease_out" : null)),
                    'price' => $this->calculatePrice($data[23], $data[24]),
                    'bedrooms' => $data[17],
                    'bathrooms' => $data[18],
                    'mobile_number' => $data[40],
                    'country' => 66124,
                    'property_status' => $data[25] == "Yes" ? "1" : '0',
                    'income' => $data[27],
                    'roi' => $data[28] ?? 0,
                    'no_of_u' => $data[19],
                    'FloorNo' => $data[20],
                    'plot_area' => $data[21],
                    'builtup_area' => $data[22] ?? 0,
                    'furnished' => $data[16] == "Yes" ? "Y" : "N",
                    'featured' => $data[32] == "Yes" ? "Y" : "N",
                    'hot' => $data[33] == "Yes" ? 1 : 0,
                    'verified' => $data[34] == "Yes" ? 1 : 0,
                    'mandate' => $data[2],
                    'contact_person' => $data[38],
                    'salesman_email' => $data[39],
                    'amenities' => $data[15],
                    'area_location' => $data[11],
                    'interior_size' => $data[22],
                    'rent_paid' => strtolower($data[24]),
                ];
    
                if ($existingAd) {
                    $record['id'] = $existingAd->id; // Include ID for updates
                    $updateData[] = $record;
                    $updatedCount++;
                } else {
                    $insertData[] = $record;
                    $newCount++;
                }
    
            }
    
            // Begin transaction
            $transaction = Yii::app()->db->beginTransaction();
          
            try {
                if (!empty($insertData)) {
                    $this->batchInsert('mw_place_an_ad', array_keys($insertData[0]), $insertData);
                }
    
                // Update existing records
                foreach ($updateData as $update) {
                    $id = $update['id'];
                    unset($update['id']); // Remove 'id' from update fields
                    Yii::app()->db->createCommand()
                        ->update('mw_place_an_ad', $update, 'id=:id', [':id' => $id]);
                }
    
                // Insert images
                if (!empty($imageInsertData)) {
                    $this->batchInsert('mw_ad_images', ['ad_id', 'image_name'], $imageInsertData);
                }
    
                // Insert floor plans
                if (!empty($floorPlanInsertData)) {
                    $this->batchInsert('mw_ad_floor_plans', ['ad_id', 'floor_plan_name'], $floorPlanInsertData);
                }
    
                $transaction->commit();
                return $this->sendJsonResponse([
                    'status' => 'success',
                    'newCount' => $newCount,
                    'updatedCount' => $updatedCount,
                ]);
            } catch (Exception $e) {
                $transaction->rollback();
                return $this->sendJsonResponse(['status' => 'error', 'message' => $e->getMessage()]);
           }
        }else {
            echo "<pre>";
            print_r(var_dump($excelData));
            echo "<br/>";
            print_r(var_dump($rawData));
            echo "<br/>";
            print_r($rawData);
            echo "<br/>";
            echo json_last_error_msg();
            exit;
        }
    }
    public function actionUploadExcelBusiness()
    {
        ini_set('post_max_size', '300M');
        ini_set('upload_max_filesize', '300M');
        ini_set('memory_limit', '-1');

        $rawData =  Yii::app()->request->getRawBody();
        $data = CJSON::decode($rawData, true);
        $excelData = ($data['excelData']);
        // exit;
        $newCount = 0;
        $updatedCount = 0;
        $imageInsertData = [];
        $floorPlanInsertData = [];
        
        if (is_array($excelData)) {
            // Extract unique values for batch fetching
            $refNos             = array_unique(array_filter(array_column($excelData, 4), fn($value) => !empty($value)));
            $categoryNames      = array_unique(array_filter(array_column($excelData, 6), fn($value) => !empty($value)));
            $subCategoryNames   = array_unique(array_filter(array_column($excelData, 7), fn($value) => !empty($value)));
            $nestedSubCategoryNames = array_unique(array_filter(array_column($excelData, 8), fn($value) => !empty($value)));
            $categoryTypes          = array_unique(array_filter(array_column($excelData, 19), fn($value) => !empty($value)));
            $stateNames             = array_unique(array_filter(array_column($excelData, 11), fn($value) => !empty($value)));
            $stateSlugs             = array_unique(array_map(
                fn($stateName) => $this->generateSlug($stateName), 
                array_filter(array_column($excelData, 11), fn($value) => !empty($value))
            ));
            $userEmails = array_map('strtolower', array_unique(array_filter(array_column($excelData, 42), fn($value) => !empty($value))));
        
            // Fetch data in bulk
            $ads = PlaceAnAd::model()->findAllByAttributes(['RefNo' => $refNos]);
            $categories = Category::model()->findAllByAttributes(['category_name' => $categoryNames, 'isTrash' => '0', 'status' => 'A']);
            $subCategories = Subcategory::model()->findAllByAttributes(['sub_category_name' => $subCategoryNames, 'isTrash' => '0', 'status' => 'A']);
            $nestedSubCategories = Subcategory::model()->findAllByAttributes(['sub_category_name' => $nestedSubCategoryNames, 'isTrash' => '0', 'status' => 'A']);
            $types = Category::model()->findAllByAttributes(['category_name' => $categoryTypes, 'isTrash' => '0', 'status' => 'A', 'f_type' => 'C']);
            $states = States::model()->findAllByAttributes(['slug' => $stateSlugs, 'isTrash' => '0']);
            $users = User::model()->findAllByAttributes(['email' => $userEmails]);
        
            // Map data for quick lookup
            $adsMap = array_column($ads, null, 'RefNo');
            $categoriesMap = array_column($categories, null, 'category_name');
            $subCategoriesMap = array_column($subCategories, null, 'sub_category_name');
            $nestedSubMap = array_column($nestedSubCategories, null, 'sub_category_name');
            $typesMap = array_column($types, null, 'category_name');
            $statesMap = array_column($states, null, 'slug');
            $usersMap = array_column($users, null, 'email');
            // echo "<pre>";
            // print_r($usersMap);
            // exit;
            // Prepare data for batch processing
            $insertData = [];
            $updateData = [];
            $updateConditions = [];
            $updateParams = [];
    
            foreach (array_slice($excelData, 1) as $data) {
                if (empty($data) || empty($data[4])) continue; // Skip if data is empty or refNo is null
                
                if (is_numeric($data[3])) {
                    $excelDate = $data[3];
                    $unixTimestamp = ($excelDate - 25569) * 86400;
                    $dateAdded = date('Y-m-d H:i:s', $unixTimestamp);
                } elseif (strtotime($data[3]) !== false) {
                    $dateAdded = date('Y-m-d H:i:s', strtotime($data[3]));
                } else {
                    $dateAdded = null;
                }
                
                $existingAd = $adsMap[$data[4]] ?? null;
                if (empty($data[0])){
                    $data[0]    = 'PID_' . rand(100000, 999999);
                }
                if (!$existingAd){
                    $cleaned_text = mb_substr(preg_replace('/[^\w\s]/', '', $data[13]), 0, 80);
                    $baseSlug = strtolower(trim(str_replace(' ', '-', $cleaned_text), '-'));
                    $slug = $baseSlug;
                    while (PlaceAnAd::model()->exists('slug=:slug', [':slug' => $slug])) {
                        $slug = $baseSlug . '-' . rand(100, 999);
                    }
                }else {
                    $slug = $existingAd->slug;
                }
                // echo "<pre>";
                // print_r($data[4]);
                // print_r($existingAd);
                // exit;
                // return;
                $stateName = $data[11];
                $stateSlug = $this->generateSlug($stateName);
                if (!isset($statesMap[$stateSlug])) {
                    // Insert new state
                    $region = MainRegion::model()->findByAttributes(['slug' => $stateSlug]);
                    $regionId = $region ? $region->region_id : null;
                
                    $newState = new States();
                    $newState->state_name = $stateName;
                    $newState->country_id = 66124;
                    $newState->isTrash = 0;
                    $newState->slug = $stateSlug;
                    $newState->region_id = $regionId;
                    $newState->save();
                
                    // Update `statesMap` with the new state
                    $statesMap[$stateSlug] = $newState;
                }
                $record = [
                    'uid' => $data[0],
                    'section_id' => 6,
                    'listing_type' => $typesMap[rtrim($data[19])]->category_id ?? null,
                    'category_id' => $categoriesMap[rtrim($data[6])]->category_id ?? null,
                    'sub_category_id' => $subCategoriesMap[rtrim($data[7])]->sub_category_id ?? null,
                    'nested_sub_category' => $nestedSubMap[rtrim($data[8])]->sub_category_id ?? null,
                    'RefNo' => $data[4],
                    'ad_title' => $data[13],
                    'slug' => $slug,
                    'PropertyID' => $data[5],
                    'ad_description' => $data[14],
                    'date_added' => $dateAdded,
                    'state' => $statesMap[$stateSlug]->state_id ?? 0,
                    'user_id' => $usersMap[$data[42]]->user_id ?? 31988,
                    'status' => ($data[39] == "Active") ? "A" : "I",
                    'availability' => ($data[38] == "Sold Out" ? "sold_out" : ($data[35] == "Leased Out" ? "lease_out" : null)),
                    'price' => $data[15],
                    'price_false' => $data[16],
                    'ow_type' => $data[20] == "Leasehold" ? 188 : 187,
                    'Rent' => $data[21],
                    'mobile_number' => $data[43],
                    'country' => 66124,
                    'property_status' => $data[39] == "Active" ? "1" : '0',
                    'featured' => $data[35] == "Yes" ? "Y" : "N",
                    'hot' => $data[36] == "Yes" ? 1 : 0,
                    'verified' => $data[37] == "Yes" ? 1 : 0,
                    'mandate' => $data[21],
                    'contact_person' => $data[43],
                    'salesman_email' => $data[42],
                    'area_location' => $data[11],
                ];
    
                // echo "<pre>";
                // print_r($record);
                // exit;
                // print_r($data[39]);
                // print_r($nestedSubMap[rtrim($data[8])]->sub_category_id);
                // print_r($nestedSubMap);
                // exit;
                if ($existingAd) {
                    $record['id'] = $existingAd->id; // Include ID for updates
                    $updateData[] = $record;
                    $updatedCount++;
                } else {
                    $insertData[] = $record;
                    $newCount++;
                }
    
            }
            // echo "<pre>";
            // print_r(array_keys($insertData[0]));
            // print_r($insertData);
            // exit;
    
            // Begin transaction
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if (!empty($insertData)) {
                    $this->batchInsert('mw_place_an_ad', array_keys($insertData[0]), $insertData);
                }
    
                // Update existing records
                foreach ($updateData as $update) {
                    $id = $update['id'];
                    unset($update['id']); // Remove 'id' from update fields
                    Yii::app()->db->createCommand()
                        ->update('mw_place_an_ad', $update, 'id=:id', [':id' => $id]);
                }
    
                // Insert images
                if (!empty($imageInsertData)) {
                    $this->batchInsert('mw_ad_images', ['ad_id', 'image_name'], $imageInsertData);
                }
    
                // Insert floor plans
                if (!empty($floorPlanInsertData)) {
                    $this->batchInsert('mw_ad_floor_plans', ['ad_id', 'floor_plan_name'], $floorPlanInsertData);
                }
    
                $transaction->commit();
                return $this->sendJsonResponse([
                    'status' => 'success',
                    'newCount' => $newCount,
                    'updatedCount' => $updatedCount,
                ]);
            } catch (Exception $e) {
                $transaction->rollback();
                return $this->sendJsonResponse(['status' => 'error', 'message' => $e->getMessage()]);
           }
        }else {
            echo "<pre>";
            print_r(var_dump($excelData));
            echo "<br/>";
            print_r(var_dump($rawData));
            echo "<br/>";
            print_r($rawData);
            echo "<br/>";
            echo json_last_error_msg();
            exit;
        }
    }

    public function generateSlug($text) {
        $cleanedText = preg_replace('/[^\w\s]/', '', $text); // Remove special characters
        $slug = strtolower(trim(str_replace(' ', '-', $cleanedText), '-')); // Convert to kebab-case
        return $slug;
    }
    
    private function batchInsert($table, $columns, $rows){
        if (empty($rows)) {
            return;
        }

        $values = [];
        foreach ($rows as $row) {
            $rowValues = [];
            foreach ($columns as $column) {
                $rowValues[] = Yii::app()->db->quoteValue($row[$column] ?? null);
            }
            $values[] = '(' . implode(',', $rowValues) . ')';
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES %s",
            Yii::app()->db->quoteTableName($table),
            implode(', ', array_map([Yii::app()->db, 'quoteColumnName'], $columns)),
            implode(', ', $values)
        );

        Yii::app()->db->createCommand($sql)->execute();
    }
    
    private function calculatePrice($price = 0, $frequency)
    {

        switch (strtolower($frequency)) {
            case 'yearly':
                return $price;
            case 'monthly':
                return $price * 12;
            case 'quarterly':
                return $price * 4;
            case 'half-yearly':
                return $price * 2;
            case 'weekly':
            default:
                return $price;
        }
    }
    
    public function handleImageSaving($model, $imageName)
    {
        // Find the existing image record by image name
        $existingImage = AdImage::model()->findByAttributes(['image_name' => $imageName]);
    
        if ($existingImage) {
            $existingImage->ad_id = (int)$model->id; // Assign ad_id from model
            if ($existingImage->save()) {
                // Check if the model image field is empty, then update it
                if (empty($model->image)) {
                    $model->updateByPk($model->id, ['image' => $existingImage->image_name]);
                }
            } else {
                // Log or debug the errors if save() fails
                throw new Exception('Failed to update the image property_id: ' . json_encode($existingImage->getErrors()));
            }
        } else {
            // Log if no image was found with the provided image name
            throw new Exception("No AdImage found with image_name: $imageName");
        }
    }
    public function handleFloorPlanSaving($model, $floorPlan)
    {
        // Find the existing image record by image name
        $existingFloorPlan = AdFloorPlan::model()->findByAttributes(['floor_title' => $floorPlan]);
    
        if ($existingFloorPlan) {
            $existingFloorPlan->ad_id = (int)$model->id; // Assign ad_id from model
            if (!$existingFloorPlan->save()) {
                throw new Exception('Failed to update the floor plan property_id: ' . json_encode($existingFloorPlan->getErrors()));
            }
        } else {
            throw new Exception("No Ad Floor Plan found with title: $floorPlan");
        }
    }
    
    


    public function _setupEditorOptions(CEvent $event)
    {
        if (!in_array($event->params['attribute'], array('ad_description'))) {
            return;
        }

        $options = array();
        if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
            $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
        }
        $options['id'] = CHtml::activeId($event->sender->owner, $event->params['attribute']);

        if ($event->params['attribute'] == 'ad_description') {
            $options['fullPage'] = false;
            $options['allowedContent'] = true;
            $options['toolbar'] = 'Simple';
            $options['height'] = 300;
        }

        $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
    }
    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        Yii::app()->end();
    }
    public function actionUpdateAvailability()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        if ($request->isPostRequest && isset($_POST['Property'])) {
            $propertyId = $_POST['Property']['place_an_ad_id'];
            $availability = $_POST['Property']['availability'];
            $reason = $_POST['Property']['reason'] ?? null;
            $soldPrice = $_POST['Property']['sold_price'] ?? null;

            $placeAd = PlaceAnAd::model()->findByPk($propertyId);
            if ($placeAd === null) {
                $notify->addError(Yii::t('app', 'Property not found.'));
                return;
            }

            // Update status based on availability
            if ($availability == 'available') {
                $placeAd->status = 'A'; // Active
                $placeAd->availability = null; // Clear availability reason
            } else {
                $placeAd->status = 'I'; // Inactive (not available)
                $placeAd->availability = $reason;

                // If the property is sold out, save the sold price and call sold out logic
                if ($reason == 'sold_out' && $soldPrice) {
                    $model = new SoldProperty();
                    $model->user_id = $placeAd->user_id; // Assign the current logged-in user's ID
                    $model->isTrash = 0; // Default value for non-deleted records
                    $model->sold_price = $soldPrice;
                    $model->property_id = $propertyId;
                    $model->save();
                    
                    $placeAd->status = 'S'; // Mark as sold
                    // You can also call additional logic here for sold-out properties
                }
            }

            if ($placeAd->save()) {
                $notify->addSuccess(Yii::t('app', 'Property availability updated successfully!'));
            } else {
                $notify->addError(Yii::t('app', 'Failed to update property availability.'));
            }

            // Redirect back to the page
            $this->redirect(Yii::app()->request->urlReferrer);
        } else {
            throw new CHttpException(400, Yii::t('app', 'Invalid request.'));
        }
    }

    public function actionMarkAsSold()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new SoldProperty();

        if ($request->isPostRequest && isset($_POST['SoldProperty'])) {
            $model->attributes = $_POST['SoldProperty']; // Set the attributes from the POST data

            // Ensure the property_id is set before searching for the related record
            $placeAd = PlaceAnAd::model()->findByPk($model->property_id);
            var_dump($placeAd);
            exit;
            if ($placeAd !== null) {
                $model->user_id = $placeAd->user_id; // Assign the current logged-in user's ID
                $model->isTrash = 0; // Default value for non-deleted records

                $placeAd->status = 'S'; // Update the status to 'S' (sold)
                if ($placeAd->save()) {
                    $notify->addSuccess(Yii::t('app', 'Property marked as sold and status updated successfully!'));
                } else {
                    $notify->addError(Yii::t('app', 'Failed to update the property status.'));
                }

                // Save the new SoldProperty record
                if ($model->save()) {
                    $notify->addSuccess(Yii::t('app', 'Property marked as sold successfully!'));
                    $this->redirect($this->createUrl('index')); // Redirect to the index page
                } else {
                    $errors = $model->getErrors(); // Log validation errors
                    foreach ($errors as $error) {
                        $notify->addError(Yii::t('app', implode(', ', $error)));
                    }
                }
            } else {
                $notify->addError(Yii::t('app', 'Property not found.'));
            }
        }

        // If validation fails, render the create form again with errors
        $this->render('create', array('model' => $model));
    }
}