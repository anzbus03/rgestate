<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * LeftSideNavigationWidget
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class LeftSideNavigationWidget extends CWidget
{
    public function run()
    {
        $sections   = array();
        $hooks      = Yii::app()->hooks;
        $controller = $this->controller;
        
        $action_id = $controller->action->id ;  
        if( $action_id=='created_by_me' or  $action_id=='assigned_to_me'  ){
           
           $team_management =  array('listingusers','subscribe_package','orders','agencies','change_contact_request','create_import','login_history','developer_gallery','created_by_me','promo_codes');
           $main_customer   = array();
        }
        else{
             $team_management =    array();
           $main_customer   = array('agent_reviews','agents','developers','listingusers','agencies','change_contact_request','create_import','login_history','developer_gallery' ,'promo_codes' );
        }
        
        $route      = $controller->route;
         $user       = Yii::app()->user->getModel();
        $priority   = 0;
        $request    = Yii::app()->request;
        $arSale = array('place_an_ad','place_property','property_import','price_trends_import','import_stats');
        if(in_array($action_id,array('create','business','update'))) {
             $arSale = array(); 
        }
        Yii::import('zii.widgets.CMenu');
        
        
        
         $menuItems = array(
            'dashboard' => array(
                'name'      => Yii::t('app', 'Dashboard'),
                'icon'      => 'glyphicon-dashboard',
                'active'    => 'dashboard',
                'route'     => array('dashboard/index'),
            ),
       
             'enquiries' => array(
                'name'      => Yii::t('app', 'Enquiries'),
                'icon'      => 'fa fa-envelope',
                'active'    =>  array('contact_us','agent_enquiry' ,'enquiry','adv_interest'   ), 
                'route'     => null,
                 'items'     => array(
                    array('url' => array('contact_us/index'), 'label' => Yii::t('app', 'Contact Us'), 'active' => strpos($route, 'contact_us') === 0), 
                    array('url' => array('contact_services/index'), 'label' => Yii::t('app', 'Contact Service'), 'active' => strpos($route, 'contact_services') === 0), 
                    //array('url' => array('agent_enquiry/index'), 'label' => Yii::t('app', 'Agent Enquiry'), 'active' => strpos($route, 'agent_enquiry') === 0),
                    array('url' => array('enquiry/index'), 'label' => Yii::t('app', 'ALL Enquiries'), 'active' => strpos($route, 'enquiry') === 0),
                    array('url' => array('adv_interest/index'), 'label' => Yii::t('app', 'Advertisement Enquiry'), 'active' => strpos($route, 'adv_interest') === 0),
					
					// array('url' => array('submited_preq/index'), 'label' => Yii::t('app', 'Submited Requirements'), 'active' => strpos($route, 'submited_preq') === 0),
				//	 array('url' => array('submited_jvproposal/index'), 'label' => Yii::t('app', 'Submited JV Proposal'), 'active' => strpos($route, 'submited_jvproposal') === 0),
            
                ),
            ),
            /*
             'loan_application' => array(
                'name'      => Yii::t('app', 'Mortgage Application'),
                'icon'      => 'fa fa-wpforms',
                'active'    =>  array('loan_application','bank' ), 
                'route'     => null,
                 'items'     => array(
                    array('url' => array('loan_application/index'), 'label' => Yii::t('app', 'Applications'), 'active' => strpos($route, 'loan_application') === 0), 
                    array('url' => array('bank/index'), 'label' => Yii::t('app', 'Bank'), 'active' => strpos($route, 'bank') === 0),
                ),
            ),
            
             'home_insurance' => array(
                'name'      => Yii::t('app', 'Home Insurance'),
                'icon'      => 'fa fa-home',
                'active'    =>  array('home_insurance','home_insurance_company' ), 
                'route'     => null,
                 'items'     => array(
                    array('url' => array('home_insurance/index'), 'label' => Yii::t('app', 'Applications'), 'active' => strpos($route, 'home_insurance') === 0), 
                    array('url' => array('home_insurance_company/index'), 'label' => Yii::t('app', 'Insurance Company'), 'active' => strpos($route, 'home_insurance_company') === 0),
                ),
            ),
             'property_valuation' => array(
                'name'      => Yii::t('app', 'Property Valuation'),
                'icon'      => 'fa fa-money',
                'active'    =>  array('property_valuation','valuation_company'), 
                'route'     => null,
                 'items'     => array(
                    array('url' => array('property_valuation/index'), 'label' => Yii::t('app', 'Property Valuation'), 'active' => strpos($route, 'property_valuation') === 0), 
					array('url' => array('valuation_company/index'), 'label' => Yii::t('app', 'Valuation Company'), 'active' => strpos($route, 'valuation_company') === 0),
           
                ),
            ),
            */
              'career' => array(
                'name'      => Yii::t('app', 'Careers'),
                'icon'      => 'fa fa-briefcase',
                'active'    => 'spam_report',
                'route'     => array('career/index'),
            ),
      
            'spam_report1' => array(
                'name'      => Yii::t('app', 'Report AD'),
                'icon'      => 'fa fa-bug',
                'active'    => 'spam_report',
                'route'     => array('spam_report/index'),
            ),
      
                'place_an_ad' => array(
                'name'      => Yii::t('app', 'Properties'),
                'icon'      => 'glyphicon-list',
                'active'    =>   $arSale, 
                'route'     => null,
                 'items'     => array(
                    array('url' => array('place_property/index'), 'label' => Yii::t('app', 'List properties'), 'active' => strpos($route, 'place_property') === 0), 
                    array('url' => array('place_property/unpublished'), 'label' => Yii::t('app', 'Unpublished properties '), 'active' => strpos($route, 'place_property') === 0), 
                    array('url' => array('place_property/trash'), 'label' => Yii::t('app', 'Trash properties'), 'active' => strpos($route, 'place_property') === 0),
                    //array('url' => array('place_property/ad_image'), 'label' => Yii::t('app', 'Manage property image'), 'active' => strpos($route, 'place_property') === 0), 
                     array('url' => array('place_property/image_management2'), 'label' => Yii::t('app', 'Manage property image'), 'active' => strpos($route, 'image_management2') === 0), 
                     array('url' => array('place_property/create'), 'label' => Yii::t('app', 'Create new  property'), 'active' => strpos($route, 'place_property') === 0), 
                    // array('url' => array('place_property/import_stats'), 'label' => Yii::t('app', 'Import Stats'), 'active' => strpos($route, 'import_stats') === 0), 
                    //  array('url' => array('price_trends_import/create_import'), 'label' => Yii::t('app', 'Import Price Trends'), 'active' => strpos($route, 'price_trends_import') === 0), 
                  
                    // array('url' => array('property_import/create_import?type=olx'), 'label' => Yii::t('app', 'OLX-Import Property'), 'active' => strpos($route, 'property_import') === 0), 
                    // array('url' => array('property_import/create_import?type=zameen'), 'label' => Yii::t('app', 'Zameen-Import Property'), 'active' => strpos($route, 'property_import') === 0), 
       
                //    array('url' => array($route), 'label' => Yii::t('app', 'Customer Lookup'), 'active' => strpos($route, 'booking') === 0),
               //     array('url' => array('#'), 'label' => Yii::t('app', 'Calender View'), 'active' => strpos($route, 'booking') === 0),
                ),
            ),
              'business' => array(
                'name'      => Yii::t('app', 'Business Opportiunities'),
                'icon'      => 'glyphicon-list',
                'active'    => 'place_property',
                'route'     => array('place_property/business'),
            ),
             'new_projects' => array(
                'name'      => Yii::t('app', 'New Projects'),
                'icon'      => 'glyphicon-list',
                'active'    =>  array('new_projects'), 
                'route'     => null,
                 'items'     => array(
                     array('url' => array('new_projects/index'), 'label' => Yii::t('app', 'List New Projects'), 'active' => strpos($route, 'new_projects') === 0), 
                     array('url' => array('new_projects/trash'), 'label' => Yii::t('app', 'Trash Projects'), 'active' => strpos($route, 'new_projects') === 0),
                     array('url' => array('new_projects/create'), 'label' => Yii::t('app', 'Create New  Projects'), 'active' => strpos($route, 'new_projects') === 0), 
                   ),
            ),
               'requirement' => array(
                'name'      => Yii::t('app', 'Submited Requirements'),
                'icon'      => 'glyphicon-list',
                'active'    => 'submited_preq',
                'route'     => array('submited_preq/index'),
            ),
                'jv' => array(
                'name'      => Yii::t('app', 'Submited JV Proposal'),
                'icon'      => 'glyphicon-list',
                'active'    => 'submited_jvproposal',
                'route'     => array('submited_jvproposal/index'),
            ),
            /*
               'bannerposs' => array(
                'name'      => Yii::t('app', 'Advertisement Manager'),
                'icon'      => 'glyphicon-picture',
                'active'    => array('advertisement','advertisement_listing'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('advertisement/index'), 'label' => Yii::t('app', 'Advertisement Section'), 'active' => strpos($route, 'advertisement/index') === 0),
                    array('url' => array('advertisement_listing/index'), 'label' => Yii::t('app', 'Listing Section'), 'active' => strpos($route, 'advertisement_listing/index') === 0),
                ),
            ),
            * */
              'users' => array(
                'name'      => Yii::t('app', 'Admins'),
                'icon'      => 'glyphicon-user',
                'active'    =>  array('users','user_groups'), 
                'route'     => null,
                 'items'     => array(
                     array('url' => array('users/index'), 'label' => Yii::t('app', 'Admins'), 'active' => strpos($route, 'users') === 0), 
                    // array('url' => array('user_groups/index'), 'label' => Yii::t('app', 'User Group'), 'active' => strpos($route, 'user_groups') === 0),
                   ),
            ),
           
           
            
       
          
           /*  
               'booking_user' => array(
                'name'      => Yii::t('app', 'Customers'),
                'icon'      => 'glyphicon-book',
                'active'    =>   $main_customer,
                'route'     => null,
                  'items'     => array(
                    //array('url' => array('listingusers/index/type/A'), 'label' => Yii::t('app', 'Agents'), 'active' => strpos($route, 'listingusers') === 0),
                    //array('url' => array('listingusers/index/type/C'), 'label' => Yii::t('app', 'Agencies'), 'active' => strpos($route, 'listingusers') === 0),
                    // array('url' => array('listingusers/index/type/D'), 'label' => Yii::t('app', 'Developers'), 'active' => strpos($route, 'listingusers') === 0),
                    array('url' => array('listingusers/index'), 'label' => Yii::t('app', 'Customers '), 'active' => strpos($route, 'listingusers') === 0),
                     array('url' => array('agent_reviews/index'), 'label' => Yii::t('app', 'Agent Reviews '), 'active' => strpos($route, 'agent_reviews') === 0),
                  
                   // array('url' => array('listingusers/created_by_me'), 'label' => Yii::t('app', 'Customers created by me '), 'active' => strpos($route, 'created_by_me') === 0),
                    array('url' => array('listingusers/visitors'), 'label' => Yii::t('app', 'Visitors (Guest Member)'), 'active' => strpos($route, 'listingusers') === 0),
                    array('url' => array('listingusers/trash'), 'label' => Yii::t('app', 'Trash Customers'), 'active' => strpos($route, 'listingusers') === 0),
                    //array('url' => array('change_contact_request/index'), 'label' => Yii::t('app', 'Request Change Contact '), 'active' => strpos($route, 'change_contact_request') === 0),
                    //array('url' => array('listingusers/create_import'), 'label' => Yii::t('app', 'Agent Import'), 'active' => strpos($route, 'create_import') === 0),
                    //array('url' => array('developer_gallery/index'), 'label' => Yii::t('app', 'Developers Gallery '), 'active' => strpos($route, 'developer_gallery') === 0),
                    array('url' => array('login_history/index'), 'label' => Yii::t('app', 'Login History'), 'active' => strpos($route, 'login_history') === 0),
                    ),
            ),
            
               'team' => array(
                'name'      => Yii::t('app', 'Team Management'),
                'icon'      => 'glyphicon-book',
                'active'    =>  $team_management,
                'route'     => null,
                  'items'     => array( 
                              array('url' => array('listingusers/created_by_me'), 'label' => Yii::t('app', 'My Customers'), 'active' => strpos($route, 'created_by_me') === 0),
                              array('url' => array('orders/created_by_me'), 'label' => Yii::t('app', 'My Orders'), 'active' => strpos($route, 'orders') === 0),
                              //array('url' => array('subscribe_package/created_by_me'), 'label' => Yii::t('app', 'My Packages'), 'active' => strpos($route, 'subscribe_package') === 0),
                              //array('url' => array('subscribe_package/create'), 'label' => Yii::t('app', 'Packages List'), 'active' => strpos($route, 'subscribe_package') === 0),
                              array('url' => array('dashboard/my_statistics'), 'label' => Yii::t('app', 'My Statistics'), 'active' => strpos($route, 'dashboard') === 0),
                                  array('url' => array('promo_codes/assigned_to_me'), 'label' => Yii::t('app', 'Promo codes'), 'active' => strpos($route, 'promo_codes') === 0),
                  
                     ),
            ),
            
               'monetization' => array(
                'name'      => Yii::t('app', 'Monetization'),
                'icon'      => 'glyphicon-credit-card',
                'active'    => array('package', 'price_plans', 'orders', 'promo_codes', 'currencies', 'taxes','subscribe_package','book_an_appointment'),
                'route'     => null,
                'items'     => array(
                      array('url' => array('package/index'), 'label' => Yii::t('app', 'Packages'), 'active' => strpos($route, 'package') === 0),
                    array('url' => array('orders/index'), 'label' => Yii::t('app', 'Orders'), 'active' => strpos($route, 'orders') === 0),
                     array('url' => array('book_an_appointment/index'), 'label' => Yii::t('app', 'Book an Appointments'), 'active' => strpos($route, 'book_an_appointment') === 0),
                   
                   // array('url' => array('subscribe_package/index'), 'label' => Yii::t('app', 'Subscribe Packages'), 'active' => strpos($route, 'subscribe_package') === 0),
                    array('url' => array('promo_codes/index'), 'label' => Yii::t('app', 'Promo codes'), 'active' => strpos($route, 'promo_codes') === 0),
                     array('url' => array('orders/promo_usage'), 'label' => Yii::t('app', 'Promo codes usage'), 'active' => strpos($route, 'promo_usage') === 0),
                  array('url' => array('taxes/index'), 'label' => Yii::t('app', 'Taxes'), 'active' => strpos($route, 'taxes') === 0),
                ),
            ),
           'stats' => array(
                'name'      => Yii::t('app', 'Statistics'),
                'icon'      => 'fa fa-bar-chart',
                'active'    => array('statistics'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('statistics/dashboard'), 'label' => Yii::t('app', 'Dashboard'), 'active' => strpos($route, 'statistics/dashboard') === 0),
                    array('url' => array('statistics/page_view'), 'label' => Yii::t('app', 'Page views'), 'active' => strpos($route, 'statistics/page_view') === 0),
                    array('url' => array('statistics/call'), 'label' => Yii::t('app', 'Call button  clicked'), 'active' => strpos($route, 'statistics/call') === 0),
                    array('url' => array('statistics/email'), 'label' => Yii::t('app', 'Email button  clicked'), 'active' => strpos($route, 'statistics/email') === 0),
                     ),
            ),
            */
      
        	'partners' => array(
                'name'      => Yii::t('app', 'Partners'),
                'icon'      => 'fa fa-handshake-o',
                'active'    => 'partners/index',
                'route'     => array('partners/index'),
            ), 
                    'spam_report' => array(
                'name'      => Yii::t('app', 'Prospace CRM Import'),
                'icon'      => 'fa fa-plus',
                'active'    => 'xml_insert',
                'route'     => array('xml_insert/index'),
            ),
                'BrokerPAD' => array(
                'name'      => Yii::t('app', 'BrokerPAD CRM Import'),
                'icon'      => 'fa fa-plus',
                'active'    => 'xml_insert',
                'route'     => array('xml_insert/brokerpad'),
            ),
                'Mastersd' => array(
                'name'      => Yii::t('app', 'Master'),
                'icon'      => 'glyphicon-list-alt',
                'active'    => array('category','main_category','links' ,'main_region','area_unit','currencies','Prospace_categories','employment_type','languages','master_category','master','footer_sub_category','footer_links','amenities','engine_size','language','community','sub_community','experience_level','countries','city','district','region','nearby_location','city','marital_status','religion','occupation','color','door','bodycondition','mechanicalcondition','fueltype','currencies'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('main_category/index'), 'label' => Yii::t('app', 'Category'), 'active' => strpos($route, 'main_category') === 0),
                    array('url' => array('subcategory/index'), 'label' => Yii::t('app', 'Sub Category'), 'active' => strpos($route, 'subcategory') === 0),
                    array('url' => array('category/index'), 'label' => Yii::t('app', 'Property Type'), 'active' => strpos($route, 'category') === 0),
                  
                         array('url' => array('countries/index'), 'label' => Yii::t('app', 'Country'), 'active' => strpos($route, 'countries') === 0),
                    array('url' => array('main_region/index'), 'label' => Yii::t('app', 'Region'), 'active' => strpos($route, 'main_region') === 0),
                    array('url' => array('region/index'), 'label' => Yii::t('app', 'City'), 'active' => strpos($route, 'region') === 0),
					
					
					
					
                    // array('url' => array('bank/index'), 'label' => Yii::t('app', 'Bank'), 'active' => strpos($route, 'bank') === 0),
                  //  array('url' => array('home_insurance_company/index'), 'label' => Yii::t('app', 'Home Insurance Company'), 'active' => strpos($route, 'home_insurance_company') === 0),
                array('url' => array('currencies/index'), 'label' => Yii::t('app', 'Currency'), 'active' => strpos($route, 'currencies') === 0),
                   // array('url' => array('community/index'), 'label' => Yii::t('app', 'Community'), 'active' => strpos($route, 'community') === 0),
				    //array('url' => array('languages/index'), 'label' => Yii::t('app', 'Languages'), 'active' => strpos($route, 'languages') === 0),
                    array('url' => array('amenities/index'), 'label' => Yii::t('app', 'Amenities'), 'active' => strpos($route, 'amenities') === 0),
                    array('url' => array('master_category/index'), 'label' => Yii::t('app', 'Master Category'), 'active' => strpos($route, 'master_category') === 0),
                    array('url' => array('master/index'), 'label' => Yii::t('app', 'Master'), 'active' => strpos($route, 'master') === 0),
                    array('url' => array('area_unit/index'), 'label' => Yii::t('app', 'Area Unit'), 'active' => strpos($route, 'area_unit') === 0),
                    array('url' => array('price_unit/index'), 'label' => Yii::t('app', 'Price Unit'), 'active' => strpos($route, 'price_unit') === 0),
                  //  array('url' => array('footer_sub_category/index'), 'label' => Yii::t('app', 'Footer Subcategory'), 'active' => strpos($route, 'footer_sub_category') === 0),
                   //   array('url' => array('currencies/index'), 'label' => Yii::t('app', 'Currencies'), 'active' => strpos($route, 'currencies') === 0),
                 
                    array('url' => array('links/index'), 'label' => Yii::t('app', 'Footer Links'), 'active' => strpos($route, 'links') === 0),
                   array('url' => array('Prospace_categories/index'), 'label' => Yii::t('app', 'Prospace Categories'), 'active' => strpos($route, 'Prospace_categories') === 0),
                  
                ),
            ),
             'mail' => array(
                'name'      => Yii::t('app', 'Emails'),
                'icon'      => 'glyphicon glyphicon-envelope',
                'active'    => 'send_email/index',
                  
                'route'     => array('send_email/index'),
            ),  
			 'guides' => array(
                'name'      => Yii::t('app', 'Area Guides'),
                'icon'      => 'glyphicon glyphicon-map-marker',
                'active'    => 'areaguides/index',
                  
                'route'     => array('areaguides/index'),
            ), 
             'sitemap' => array(
                'name'      => Yii::t('app', 'Update Sitemap'),
                'icon'      => 'glyphicon glyphicon-map-marker',
                'active'    => 'dashboard/sitemap',
                  
                'route'     => array('dashboard/sitemap'),
            ), 
			/* Prtner Menu Start */
		
			/* Prtner Menu End */
			
            'articles' => array(
                'name'      => Yii::t('app', 'Articles'),
                'icon'      => 'glyphicon-book',
                'active'    => array('article','blog_articles','blog_links','advertisement_articles','content_pages','listing_contents'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('articles/index'), 'label' => Yii::t('app', 'View all articles'), 'active' => strpos($route, 'articles/index') === 0),
                    array('url' => array('blog_articles/index'), 'label' => Yii::t('app', 'View all blogs'), 'active' => strpos($route, 'blog_articles/index') === 0),
                    array('url' => array('blog_articles/index_authors'), 'label' => Yii::t('app', 'View Authors'), 'active' => strpos($route, 'blog_articles/index_authors') === 0),
                      array('url' => array('advertisement_articles/index'), 'label' => Yii::t('app', 'View all adv articles'), 'active' => strpos($route, 'advertisement_articles/index') === 0),
                    array('url' => array('content_pages/index'), 'label' => Yii::t('app', 'Content Pages'), 'active' => strpos($route, 'content_pages/index') === 0),
                    array('url' => array('listing_contents/index'), 'label' => Yii::t('app', 'Listing Contents'), 'active' => strpos($route, 'listing_contents/index') === 0),
                    //array('url' => array('blog_links/index'), 'label' => Yii::t('app', 'Blog Links'), 'active' => strpos($route, 'blog_links/index') === 0),
                    array('url' => array('article_categories/index'), 'label' => Yii::t('app', 'View all categories'), 'active' => strpos($route, 'article_categories') === 0),
                ),
            ),
           
               'bannerpos' => array(
                'name'      => Yii::t('app', 'Banner'),
                'icon'      => 'fa fa-flag',
                'active'    => array('banner','banner_position','home_banner','developer_banner','agent_banner'),
                'route'     => null,
                'items'     => array(
                    //array('url' => array('banner_position/index'), 'label' => Yii::t('app', 'Banner position'), 'active' => strpos($route, 'banner_position/index') === 0),
                    array('url' => array('banner/index'), 'label' => Yii::t('app', 'Adv. Banner'), 'active' => strpos($route, 'banner/index') === 0),
                    array('url' => array('home_banner/index'), 'label' => Yii::t('app', 'Page Banner'), 'active' => strpos($route, 'home_banner/index') === 0),
                   // array('url' => array('agent_banner/index'), 'label' => Yii::t('app', 'Agents Banner'), 'active' => strpos($route, 'agent_banner/index') === 0),
                    //array('url' => array('developer_banner/index'), 'label' => Yii::t('app', 'Developer Banner'), 'active' => strpos($route, 'developer_banner/index') === 0),
                ),
            ),
            /*
              'library' => array(
                'name'      => Yii::t('app', 'Library'),
                'icon'      => 'fa fa-image',
                'active'    => array('default_image'),
                'route'     => null,
                'items'     => array(
					array('url' => array('default_image/index'), 'label' => Yii::t('app', 'Profile/Cover Images'), 'active' => strpos($route, 'default_image/index') === 0),
             
                ),
            ),
            */
               'language' => array(
                'name'      => Yii::t('app', 'Language'),
                'icon'      => 'glyphicon fa fa-keyboard-o',
                'active'    => array('language_tags'  ),
                'route'     => null,
                  'items'     => array(
                    array('url' => array('language_tags/index'), 'label' => Yii::t('app', 'Tags and Translation') , 'active' =>  ( $route == 'language_tags/index' ) ? 1 : 0  ),
                ),
            ),
           'settings' => array(
                'name'      => Yii::t('app', 'Settings'),
                'icon'      => 'glyphicon-cog',
                'active'    => array('settings','templates','delivery_servers','upload_settings'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('settings/index'), 'label' => Yii::t('app', 'Common'), 'active' => strpos($route, 'settings/index') === 0),
                    array('url' => array('settings/page_titles'), 'label' => Yii::t('app', 'Static Page titles'), 'active' => strpos($route, 'settings/page_titles') === 0),
                    array('url' => array('settings/menu_management'), 'label' => Yii::t('app', 'Menu Management'), 'active' => strpos($route, 'settings/menu_management') === 0),
                    //array('url' => array('settings/success_messages'), 'label' => Yii::t('app', 'Success Messages'), 'active' => strpos($route, 'settings/success_messages') === 0),
                    // array('url' => array('upload_settings/index'), 'label' => Yii::t('app', 'Upload Settings'), 'active' => strpos($route, 'upload_settings/index') === 0),
                    array('url' => array('settings/email_templates'), 'label' => Yii::t('app', 'Common email template'), 'active' => strpos($route, 'settings/email_templates') === 0),
                    array('url' => array('templates/index'), 'label' => Yii::t('app', 'Other email templates'), 'active' => strpos($route, 'template/index') === 0),
                    array('url' => array('delivery_servers/index'), 'label' => Yii::t('app', 'Delivery Servers'), 'active' => strpos($route, 'delivery_servers/index') === 0),
                ),
            ),
        
           
            
        );
        
        
        $menuItems = (array)Yii::app()->hooks->applyFilters('backend_left_navigation_menu_items', $menuItems);
        foreach ($menuItems as $key => $data) {
			
			
		
			
            if (!empty($data['route']) && !$user->hasRouteAccess($data['route'])) {
				
			
                unset($menuItems[$key]);
                continue;
            }
            if (isset($data['items']) && is_array($data['items'])) {
				
				
                foreach ($data['items'] as $index => $item) { 
					if(strpos($item['url'][0],  'property_import') !== false){
						 $uri = 'property_import/create_import';
					}else {
						$uri = $item['url'];
					}
                    if (isset($item['url']) && !$user->hasRouteAccess($uri)) {
						
							
                        unset($menuItems[$key]['items'][$index], $data['items'][$index]);
                    }
                }
            }
            if (empty($data['route']) && empty($data['items'])) {	 
                unset($menuItems[$key]);
            }
        }
        $menu = new CMenu();
        $menu->htmlOptions          = array('class' => 'sidebar-menu');
        $menu->submenuHtmlOptions   = array('class' => 'treeview-menu');
        
        foreach ($menuItems as $key => $data) {
            $_route  = !empty($data['route']) ? $data['route'] : 'javascript:;';
            $active  = false;
            
            if (is_string($data['active']) && strpos($route, $data['active']) === 0) {
                $active = true;
            } elseif (is_array($data['active'])) {
                foreach ($data['active'] as $in) {
                    if (strpos($route, $in) === 0) {
                        $active = true;
                        break;
                    }
                }
            }
            
            $item = array(
                'url'       => $_route, 
                'label'     => '<i class="glyphicon '.$data['icon'].'"></i> <span>'.$data['name'].'</span>' . (!empty($data['items']) ? '<i class="fa fa-angle-left pull-right"></i>' : ''), 
                'active'    => $active
            );
            
            if (!empty($data['items'])) {
                foreach ($data['items'] as $index => $i) {
                    if (isset($i['label'])) {
                        $data['items'][$index]['label'] = '<i class="fa fa-angle-double-right"></i>' . $i['label'];
                    }
                }
                $item['items']       = $data['items'];
                $item['itemOptions'] = array('class' => 'treeview');
            }
            
            $menu->items[] = $item;
        }

        $menu->run();
    }
}
