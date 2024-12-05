<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * LeftSideNavigationWidget
 *
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA ( http://www.mailwizz.com )
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class LeftSideNavigationWidget extends CWidget
{
    public function getMenuItems()
    {
        $sections   = array();
        $hooks      = Yii::app()->hooks;
        $controller = $this->controller;

        $action_id = $controller->action->id;

        if ($action_id == 'created_by_me' or  $action_id == 'assigned_to_me') {

            $team_management =  array('listingusers', 'subscribe_package', 'orders', 'agencies', 'change_contact_request', 'create_import', 'login_history', 'developer_gallery', 'created_by_me', 'promo_codes');
            $main_customer   = array();
        } else {
            $team_management =    array();
            $main_customer   = array('agent_reviews', 'agents', 'developers', 'listingusers', 'agencies', 'change_contact_request', 'create_import', 'login_history', 'developer_gallery', 'promo_codes');
        }

        $route      = $controller->route;
        $user       = Yii::app()->user->getModel();
        $priority   = 0;
        $request    = Yii::app()->request;
        $rules      = $user->rules; 
        $arSale = array('place_an_ad', 'place_property', 'property_import', 'price_trends_import', 'import_stats');
        if (in_array($action_id, array('create', 'business', 'update'))) {
            $arSale = array();
        }
        Yii::import('zii.widgets.CMenu');
        if ($rules == 1) {
            $menuItems = array(
                'dashboard' => array(
                    'name'      => Yii::t('app', 'Dashboard'),
                    'icon'      => 'flaticon-025-dashboard',
                    'active'    => 'dashboard',
                    'route'     => array('dashboard/index'),
                ),
                'agent_management' => array(
                    'name'      => Yii::t('app', 'Agent Management'), 
                    'icon'      => 'flaticon-041-graph',
                    'active'    =>  array('agents', 'agent_groups'),
                    'route'     => array('agents/index'),
                    'items'     => array(
                        array('url' => array('agents/index'), 'label' => Yii::t('app', 'Agent Dashboard'), 'active' => strpos($route, 'agents/index') === 0),
                        array('url' => array('agents/list'), 'label' => Yii::t('app', 'Agents List'), 'active' => strpos($route, 'agents/list') === 0),
                        // array('url' => array('agents/create'), 'label' => Yii::t('app', 'Create Agent'), 'active' => strpos($route, 'agents/create') === 0),
                    ),
                ),
                'image_library' => array(
                    'name'      => Yii::t('app', 'Image Library'),
                    'icon'      => 'flaticon-043-menu',
                    'active'    => 'image_library',
                    'route'     => array('image_library/index'),
                ),
                'floor_plan' => array(
                    'name'      => Yii::t('app', 'Floor Plan'),
                    'icon'      => 'flaticon-043-menu',
                    'active'    => 'floor_plan',
                    'route'     => array('image_library/floor_plan'),
                ),
                'enquiries' => array(
                    'name'      => Yii::t('app', 'Enquiries'),
                    'icon'      => 'fa fa-envelope',
                    'active'    =>  array('contact_us', 'agent_enquiry', 'enquiry', 'adv_interest'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('contact_us/index'), 'label' => Yii::t('app', 'Contact Us'), 'active' => strpos($route, 'contact_us') === 0),
                        array('url' => array('contact_services/index'), 'label' => Yii::t('app', 'Contact Service'), 'active' => strpos($route, 'contact_services') === 0),
                        array('url' => array('enquiry/index'), 'label' => Yii::t('app', 'ALL Enquiries'), 'active' => strpos($route, 'enquiry') === 0),
                        array('url' => array('adv_interest/index'), 'label' => Yii::t('app', 'Advertisement Enquiry'), 'active' => strpos($route, 'adv_interest') === 0),
                        array('url' => array('contact_us/ai_bot'), 'label' => Yii::t('app', 'BOT Enquiries'), 'active' => strpos($route, 'contact_us') === 0),
                    ),
                ),
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
                    'name'      => Yii::t('app', 'Listings Management'),
                    'icon'      => 'flaticon-043-menu',
                    'active'    => $arSale,
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('place_property/index'), 'label' => Yii::t('app', 'List properties'), 'active' => strpos($route, 'place_property/index') === 0),
                        array('url' => array('place_property/business'), 'label' => Yii::t('app', 'Business Opportiunities'), 'active' => strpos($route, 'place_property/business') === 0),
                        array('url' => array('new_projects/index'), 'label' => Yii::t('app', 'List New Projects'), 'active' => strpos($route, 'new_projects') === 0),
                        // array( 'url' => array( 'place_property/unpublished' ), 'label' => Yii::t( 'app', 'Unpublished properties ' ), 'active' => strpos( $route, 'place_property' ) === 0 ),
                        // array( 'url' => array( 'place_property/trash' ), 'label' => Yii::t( 'app', 'Trash properties' ), 'active' => strpos( $route, 'place_property' ) === 0 ),
                        // array( 'url' => array( 'place_property/image_management2' ), 'label' => Yii::t( 'app', 'Manage property image' ), 'active' => strpos( $route, 'image_management2' ) === 0 ),
                        // array( 'url' => array( 'place_property/create' ), 'label' => Yii::t( 'app', 'Create new  property' ), 'active' => strpos( $route, 'place_property' ) === 0 ),
                    ),
                ),
                // 'business' => array(
                //     'name'      => Yii::t( 'app', 'Business Opportiunities' ),
                //     'icon'      => 'flaticon-013-checkmark',
                //     'active'    => 'place_property',
                //     'route'     => array( 'place_property/business' ),
                // ),
                // 'new_projects' => array(
                //     'name'      => Yii::t( 'app', 'New Projects' ),
                //     'icon'      => 'flaticon-053-lifebuoy',
                //     'active'    =>  array( 'new_projects' ),
                //     'route'     => null,
                //     'items'     => array(
                //         array( 'url' => array( 'new_projects/index' ), 'label' => Yii::t( 'app', 'List New Projects' ), 'active' => strpos( $route, 'new_projects' ) === 0 ),
                //         array( 'url' => array( 'new_projects/trash' ), 'label' => Yii::t( 'app', 'Trash Projects' ), 'active' => strpos( $route, 'new_projects' ) === 0 ),
                //         array( 'url' => array( 'new_projects/create' ), 'label' => Yii::t( 'app', 'Create New  Projects' ), 'active' => strpos( $route, 'new_projects' ) === 0 ),
                //     ),
                // ),
                'requirement' => array(
                    'name'      => Yii::t('app', 'Submissions'),
                    'icon'      => 'flaticon-039-goal',
                    'active'    => 'submited_preq',
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('submited_preq/index'), 'label' => Yii::t('app', 'Submitted Requirements'), 'active' => strpos($route, 'submited_preq') === 0),
                        array('url' => array('submited_jvproposal/index'), 'label' => Yii::t('app', 'Submited JV Proposal'), 'active' => strpos($route, 'submited_jvproposal') === 0),
                    ),
                ),
                // 'jv' => array(
                //     'name'      => Yii::t( 'app', 'Submited JV Proposal' ),
                //     'icon'      => 'flaticon-039-goal',
                //     'active'    => 'submited_jvproposal',
                //     'route'     => array( 'submited_jvproposal/index' ),
                // ),
                'users' => array(
                    'name'      => Yii::t('app', 'Users'),
                    'icon'      => 'flaticon-047-home',
                    'active'    =>  array('users', 'user_groups'),
                    'route'     => array('users/index'),
                    'items'     => array(
                        array( 'url' => array( 'users/index' ), 'label' => Yii::t( 'app', 'Users List' ), 'active' => strpos( $route, 'users' ) === 0 ),
                        // array('url' => array('user_groups/index'), 'label' => Yii::t('app', 'User Group'), 'active' => strpos($route, 'user_groups') === 0),
                    ),
                ),


                'partners' => array(
                    'name'      => Yii::t('app', 'Partners'),
                    'icon'      => 'flaticon-085-signal',
                    'active'    => 'partners/index',
                    'route'     => array('partners/index'),
                ),
                // 'spam_report' => array(
                //     'name'      => Yii::t( 'app', 'Prospace CRM Import' ),
                //     'icon'      => 'flaticon-068-plus',
                //     'active'    => 'xml_insert',
                //     'route'     => array( 'xml_insert/index' ),
                // ),
                // 'BrokerPAD' => array(
                //     'name'      => Yii::t( 'app', 'BrokerPAD CRM Import' ),
                //     'icon'      => 'flaticon-068-plus',
                //     'active'    => 'xml_insert',
                //     'route'     => array( 'xml_insert/brokerpad' ),
                // ),
                'Mastersd' => array(
                    'name'      => Yii::t('app', 'Master'),
                    'icon'      => 'flaticon-044-menu',
                    'active'    => array('category', 'main_category', 'links', 'main_region', 'area_unit', 'currencies', 'Prospace_categories', 'employment_type', 'languages', 'master_category', 'master', 'footer_sub_category', 'footer_links', 'amenities', 'engine_size', 'language', 'community', 'sub_community', 'experience_level', 'countries', 'city', 'district', 'region', 'nearby_location', 'city', 'marital_status', 'religion', 'occupation', 'color', 'door', 'bodycondition', 'mechanicalcondition', 'fueltype', 'currencies'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('main_category/index'), 'label' => Yii::t('app', 'Category'), 'active' => strpos($route, 'main_category') === 0),
                        array('url' => array('subcategory/index'), 'label' => Yii::t('app', 'Sub Category'), 'active' => strpos($route, 'subcategory') === 0),
                        array('url' => array('category/index'), 'label' => Yii::t('app', 'Property Type'), 'active' => strpos($route, 'category') === 0),

                        array('url' => array('countries/index'), 'label' => Yii::t('app', 'Country'), 'active' => strpos($route, 'countries') === 0),
                        array('url' => array('main_region/index'), 'label' => Yii::t('app', 'Region'), 'active' => strpos($route, 'main_region') === 0),
                        array('url' => array('region/index'), 'label' => Yii::t('app', 'City'), 'active' => strpos($route, 'region') === 0),
                        array('url' => array('currencies/index'), 'label' => Yii::t('app', 'Currency'), 'active' => strpos($route, 'currencies') === 0),
                        array('url' => array('amenities/index'), 'label' => Yii::t('app', 'Amenities'), 'active' => strpos($route, 'amenities') === 0),
                        array('url' => array('master_category/index'), 'label' => Yii::t('app', 'Master Category'), 'active' => strpos($route, 'master_category') === 0),
                        array('url' => array('master/index'), 'label' => Yii::t('app', 'Master'), 'active' => strpos($route, 'master') === 0),
                        array('url' => array('area_unit/index'), 'label' => Yii::t('app', 'Area Unit'), 'active' => strpos($route, 'area_unit') === 0),
                        array('url' => array('price_unit/index'), 'label' => Yii::t('app', 'Price Unit'), 'active' => strpos($route, 'price_unit') === 0),
                        array('url' => array('links/index'), 'label' => Yii::t('app', 'Footer Links'), 'active' => strpos($route, 'links') === 0),
                        array('url' => array('Prospace_categories/index'), 'label' => Yii::t('app', 'Prospace Categories'), 'active' => strpos($route, 'Prospace_categories') === 0),

                    ),
                ),
                'mail' => array(
                    'name'      => Yii::t('app', 'Emails'),
                    'icon'      => 'flaticon-071-print',
                    'active'    => 'send_email/index',

                    'route'     => array('send_email/index'),
                ),
                'guides' => array(
                    'name'      => Yii::t('app', 'Area Guides'),
                    'icon'      => 'flaticon-085-signal',
                    'active'    => 'areaguides/index',

                    'route'     => array('areaguides/index'),
                ),
            
                'guides' => array(
                    'name'      => Yii::t('app', 'Area Guides'),
                    'icon'      => 'flaticon-085-signal',
                    'active'    => 'areaguides/index',

                    'route'     => array('areaguides/index'),
                ),
                // 'sitemap' => array(
                //     'name'      => Yii::t( 'app', 'Update Sitemap' ),
                //     'icon'      => 'flaticon-085-signal',
                //     'active'    => 'dashboard/sitemap',

                //     'route'     => array( 'dashboard/sitemap' ),
                // ),

                'articles' => array(
                    'name'      => Yii::t('app', 'CMS'),
                    'icon'      => 'flaticon-093-waving',
                    'active'    => array('article', 'blog_articles', 'blog_links', 'advertisement_articles', 'content_pages', 'listing_contents'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('articles/index'), 'label' => Yii::t('app', 'View all articles'), 'active' => strpos($route, 'articles/index') === 0),
                        array('url' => array('blog_articles/index'), 'label' => Yii::t('app', 'View all blogs'), 'active' => strpos($route, 'blog_articles/index') === 0),
                        array('url' => array('blog_articles/index_authors'), 'label' => Yii::t('app', 'View Authors'), 'active' => strpos($route, 'blog_articles/index_authors') === 0),
                        array('url' => array('advertisement_articles/index'), 'label' => Yii::t('app', 'View all adv articles'), 'active' => strpos($route, 'advertisement_articles/index') === 0),
                        array('url' => array('content_pages/index'), 'label' => Yii::t('app', 'Content Pages'), 'active' => strpos($route, 'content_pages/index') === 0),
                        array('url' => array('listing_contents/index'), 'label' => Yii::t('app', 'Listing Contents'), 'active' => strpos($route, 'listing_contents/index') === 0),
                        array('url' => array('article_categories/index'), 'label' => Yii::t('app', 'View all categories'), 'active' => strpos($route, 'article_categories') === 0),
                    ),
                ),

                'bannerpos' => array(
                    'name'      => Yii::t('app', 'Banner'),
                    'icon'      => 'flaticon-035-flag',
                    'active'    => array('banner', 'banner_position', 'home_banner', 'developer_banner', 'agent_banner'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('banner/index'), 'label' => Yii::t('app', 'Adv. Banner'), 'active' => strpos($route, 'banner/index') === 0),
                        array('url' => array('home_banner/index'), 'label' => Yii::t('app', 'Page Banner'), 'active' => strpos($route, 'home_banner/index') === 0),
                    ),
                ),
                'language' => array(
                    'name'      => Yii::t('app', 'Language'),
                    'icon'      => 'flaticon-091-warning',
                    'active'    => array('language_tags'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('language_tags/index'), 'label' => Yii::t('app', 'Tags and Translation'), 'active' => ($route == 'language_tags/index') ? 1 : 0),
                    ),
                ),
                'settings' => array(
                    'name'      => Yii::t('app', 'Settings'),
                    'icon'      => 'flaticon-007-bulleye',
                    'active'    => array('settings', 'templates', 'delivery_servers', 'upload_settings'),
                    'route'     => null,
                    'items'     => array(
                        array('url' => array('settings/index'), 'label' => Yii::t('app', 'Common'), 'active' => strpos($route, 'settings/index') === 0),
                        array('url' => array('settings/page_titles'), 'label' => Yii::t('app', 'Static Page titles'), 'active' => strpos($route, 'settings/page_titles') === 0),
                        array('url' => array('settings/menu_management'), 'label' => Yii::t('app', 'Menu Management'), 'active' => strpos($route, 'settings/menu_management') === 0),
                        //array( 'url' => array( 'settings/success_messages' ), 'label' => Yii::t( 'app', 'Success Messages' ), 'active' => strpos( $route, 'settings/success_messages' ) === 0 ),
                        // array( 'url' => array( 'upload_settings/index' ), 'label' => Yii::t( 'app', 'Upload Settings' ), 'active' => strpos( $route, 'upload_settings/index' ) === 0 ),
                        array('url' => array('settings/email_templates'), 'label' => Yii::t('app', 'Common email template'), 'active' => strpos($route, 'settings/email_templates') === 0),
                        array('url' => array('templates/index'), 'label' => Yii::t('app', 'Other email templates'), 'active' => strpos($route, 'template/index') === 0),
                        array('url' => array('delivery_servers/index'), 'label' => Yii::t('app', 'Delivery Servers'), 'active' => strpos($route, 'delivery_servers/index') === 0),
                    ),
                ),

            );
        }
        if ($rules == 2) {
            $menuItems = array(
                'agent_management' => array(
                    'name'      => Yii::t('app', 'Agent Management'),
                    'icon'      => 'flaticon-041-graph',
                    'active'    => array('agents', 'agent_groups'),
                    'route'     => array('agents/index'),
                    'items'     => array(
                        array('url' => array('agents/index'), 'label' => Yii::t('app', 'Agent Dashboard'), 'active' => strpos($route, 'agents/index') === 0),
                        array('url' => array('agents/list'), 'label' => Yii::t('app', 'Agents List'), 'active' => strpos($route, 'agents/list') === 0),
                        array('url' => array('agents/create'), 'label' => Yii::t('app', 'Create Agent'), 'active' => strpos($route, 'agents/create') === 0),
                    ),
                )
            );
            $menuItems['dashboard'] = array(
                'name'      => Yii::t('app', 'Dashboard'),
                'icon'      => 'flaticon-025-dashboard',
                'active'    => array('dashboard'),
                'route'     => array('dashboard/index'),
            );
            $menuItems['image_library'] = array(
                'name'      => Yii::t('app', 'Image Library'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('image_library'),
                'route'     => array('image_library/index'),
            );
            $menuItems['users'] = array(
                'name'      => Yii::t('app', 'Users'),
                'icon'      => 'flaticon-047-home',
                'active'    =>  array('users', 'user_groups'),
                'route'     => array('users/index'),
            );
            $menuItems['floor_plan'] = array(
                'name'      => Yii::t('app', 'Floor Plan'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('floor_plan'),
                'route'     => array('image_library/floor_plan'),
            );
            $menuItems['place_an_ad'] = array(
                'name'      => Yii::t('app', 'Listings Management'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('place_property', 'property_import'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('place_property/index'), 'label' => Yii::t('app', 'List Properties'), 'active' => strpos($route, 'place_property/index') === 0),
                    array('url' => array('place_property/business'), 'label' => Yii::t('app', 'Business Opportunities'), 'active' => strpos($route, 'place_property/business') === 0),
                    array('url' => array('new_projects/index'), 'label' => Yii::t('app', 'List New Projects'), 'active' => strpos($route, 'new_projects') === 0),
                ),
            );
        }
        if ($rules == 3) {
            $menuItems = array(
                'agent_management' => array(
                    'name'      => Yii::t('app', 'Agent Dashboard'),
                    'icon'      => 'flaticon-041-graph',
                    'active'    => array('agents', 'agent_groups'),
                    'route'     => array('agents/index')
                )
            );
            $menuItems['dashboard'] = array(
                'name'      => Yii::t('app', 'Dashboard'),
                'icon'      => 'flaticon-025-dashboard',
                'active'    => array('dashboard'),
                'route'     => array('dashboard/index'),
            );
            $menuItems['image_library'] = array(
                'name'      => Yii::t('app', 'Image Library'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('image_library'),
                'route'     => array('image_library/index'),
            );
            $menuItems['floor_plan'] = array(
                'name'      => Yii::t('app', 'Floor Plan'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('floor_plan'),
                'route'     => array('image_library/floor_plan'),
            );
            $menuItems['place_an_ad'] = array(
                'name'      => Yii::t('app', 'Listings Management'),
                'icon'      => 'flaticon-043-menu',
                'active'    => array('place_property', 'property_import'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('place_property/index'), 'label' => Yii::t('app', 'List Properties'), 'active' => strpos($route, 'place_property/index') === 0),
                    array('url' => array('place_property/business'), 'label' => Yii::t('app', 'Business Opportunities'), 'active' => strpos($route, 'place_property/business') === 0),
                    array('url' => array('new_projects/index'), 'label' => Yii::t('app', 'List New Projects'), 'active' => strpos($route, 'new_projects') === 0),
                ),
            );
        }

        return $menuItems;
    }
    public function run()
    {
        // Get the menu items
        $menuItems = $this->getMenuItems();
        return $menuItems;
    }
}