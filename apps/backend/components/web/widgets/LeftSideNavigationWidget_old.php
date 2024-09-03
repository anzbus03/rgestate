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
        $route      = $controller->route;
        $priority   = 0;
        $request    = Yii::app()->request;

        Yii::import('zii.widgets.CMenu');

        $menuItems = array(
            'dashboard' => array(
                'name'      => Yii::t('app', 'Dashboard'),
                'icon'      => 'glyphicon-dashboard',
                'active'    => 'dashboard',
                'route'     => array('dashboard/index'),
            ),

            'banner' => array(
                'name'      => Yii::t('app', 'Enquiry Forms'),
                'icon'      => 'fa fa-wpforms',
                'active'    => array('contact_us', 'spam_report', 'enquiry', 'agent_enquiry', 'advertise_interest'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('contact_us/index'), 'label' => Yii::t('app', 'General Enquiry'), 'active' => strpos($route, 'contact_us/index') === 0),
                    array('url' => array('enquiry/index'), 'label' => Yii::t('app', 'Property Enquiry'), 'active' => strpos($route, 'enquiry/index') === 0),
                    array('url' => array('agent_enquiry/index'), 'label' => Yii::t('app', 'Realtors Enquiry'), 'active' => strpos($route, 'agent_enquiry/index') === 0),
                    array('url' => array('advertise_interest/index'), 'label' => Yii::t('app', 'Advertisement Interest'), 'active' => strpos($route, 'advertise_interest/index') === 0),

                ),
            ),


            'place_an_ad' => array(
                'name'      => Yii::t('app', 'Properties'),
                'icon'      => 'glyphicon-th-large',
                'active'    =>  array('place_an_ad', 'place_property'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('place_property/index'), 'label' => Yii::t('app', 'List properties'), 'active' => strpos($route, 'place_property') === 0),
                    array('url' => array('place_property/ad_image'), 'label' => Yii::t('app', 'Manage property image'), 'active' => strpos($route, 'place_property') === 0),
                    array('url' => array('place_property/create'), 'label' => Yii::t('app', 'Create new  property'), 'active' => strpos($route, 'place_property') === 0),

                    //    array('url' => array($route), 'label' => Yii::t('app', 'Customer Lookup'), 'active' => strpos($route, 'booking') === 0),
                    //     array('url' => array('#'), 'label' => Yii::t('app', 'Calender View'), 'active' => strpos($route, 'booking') === 0),
                ),
            ),

            'new_projects' => array(
                'name'      => Yii::t('app', 'New Projects'),
                'icon'      => 'glyphicon-picture',
                'active'    =>  array('new_projects'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('new_projects/index'), 'label' => Yii::t('app', 'List New Projects'), 'active' => strpos($route, 'new_projects') === 0),
                    array('url' => array('new_projects/create'), 'label' => Yii::t('app', 'Create New  Projects'), 'active' => strpos($route, 'new_projects') === 0),
                ),
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
                'active'    => 'users',
                'route'     => array('users/index'),
            ),





            'booking_user' => array(
                'name'      => Yii::t('app', 'Customers'),
                'icon'      => 'glyphicon-book',
                'active'    =>  array('agents', 'developers', 'listingusers', 'agencies'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('listingusers/index/type/A'), 'label' => Yii::t('app', 'Agents'), 'active' => strpos($route, 'listingusers') === 0),
                    array('url' => array('listingusers/index/type/C'), 'label' => Yii::t('app', 'Agencies'), 'active' => strpos($route, 'listingusers') === 0),
                    array('url' => array('listingusers/index/type/D'), 'label' => Yii::t('app', 'Developers'), 'active' => strpos($route, 'listingusers') === 0),
                    array('url' => array('listingusers/index/type/U'), 'label' => Yii::t('app', 'Advertisers '), 'active' => strpos($route, 'listingusers') === 0),
                ),
            ),
            'properties' => array(
                'name'      => Yii::t('app', 'Master'),
                'icon'      => 'glyphicon-list-alt',
                'active'    => array('category', 'employment_type', 'master_category', 'master', 'footer_sub_category', 'footer_links', 'amenities', 'engine_size', 'language', 'community', 'sub_community', 'experience_level', 'countries', 'city', 'district', 'region', 'nearby_location', 'city', 'marital_status', 'religion', 'occupation', 'color', 'door', 'bodycondition', 'mechanicalcondition', 'fueltype', 'currencies'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('category/index'), 'label' => Yii::t('app', 'Category'), 'active' => strpos($route, 'category') === 0),
                    array('url' => array('countries/index'), 'label' => Yii::t('app', 'Country'), 'active' => strpos($route, 'countries') === 0),
                    array('url' => array('region/index'), 'label' => Yii::t('app', 'Region'), 'active' => strpos($route, 'region') === 0),
                    array('url' => array('city/index'), 'label' => Yii::t('app', 'Location'), 'active' => strpos($route, 'city') === 0),
                    // array('url' => array('currencies/index'), 'label' => Yii::t('app', 'Currency'), 'active' => strpos($route, 'currencies') === 0),
                    // array('url' => array('community/index'), 'label' => Yii::t('app', 'Community'), 'active' => strpos($route, 'community') === 0),
                    // array('url' => array('language/index'), 'label' => Yii::t('app', 'Manage Languages'), 'active' => strpos($route, 'language') === 0),
                    array('url' => array('amenities/index'), 'label' => Yii::t('app', 'Amenities'), 'active' => strpos($route, 'amenities') === 0),
                    array('url' => array('master_category/index'), 'label' => Yii::t('app', 'Master Category'), 'active' => strpos($route, 'master_category') === 0),
                    array('url' => array('master/index'), 'label' => Yii::t('app', 'Master'), 'active' => strpos($route, 'master') === 0),
                    array('url' => array('footer_sub_category/index'), 'label' => Yii::t('app', 'Footer Subcategory'), 'active' => strpos($route, 'footer_sub_category') === 0),
                    array('url' => array('footer_links/index'), 'label' => Yii::t('app', 'Footer Links'), 'active' => strpos($route, 'footer_links') === 0),

                ),
            ),



            'mail' => array(
                'name'      => Yii::t('app', 'Emails'),
                'icon'      => 'glyphicon glyphicon-envelope',
                'active'    => 'send_email/index',

                'route'     => array('send_email/index'),
            ),
            'articles' => array(
                'name'      => Yii::t('app', 'Articles'),
                'icon'      => 'glyphicon-book',
                'active'    => array('article', 'blog_articles'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('articles/index'), 'label' => Yii::t('app', 'View all articles'), 'active' => strpos($route, 'articles/index') === 0),
                    array('url' => array('blog_articles/index'), 'label' => Yii::t('app', 'View all blogs'), 'active' => strpos($route, 'blog_articles/index') === 0),
                    array('url' => array('article_categories/index'), 'label' => Yii::t('app', 'View all categories'), 'active' => strpos($route, 'article_categories') === 0),
                ),
            ),

            'bannerpos' => array(
                'name'      => Yii::t('app', 'Banner'),
                'icon'      => 'fa fa-flag',
                'active'    => array('banner', 'banner_position', 'home_banner', 'developer_banner', 'agent_banner'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('banner_position/index'), 'label' => Yii::t('app', 'Banner position'), 'active' => strpos($route, 'banner_position/index') === 0),
                    array('url' => array('banner/index'), 'label' => Yii::t('app', 'Banner'), 'active' => strpos($route, 'banner/index') === 0),
                    array('url' => array('home_banner/index'), 'label' => Yii::t('app', 'Home Banner'), 'active' => strpos($route, 'home_banner/index') === 0),
                    array('url' => array('agent_banner/index'), 'label' => Yii::t('app', 'Agents Banner'), 'active' => strpos($route, 'agent_banner/index') === 0),
                    //array('url' => array('developer_banner/index'), 'label' => Yii::t('app', 'Developer Banner'), 'active' => strpos($route, 'developer_banner/index') === 0),
                ),
            ),

            'settings' => array(
                'name'      => Yii::t('app', 'Settings'),
                'icon'      => 'glyphicon-cog',
                'active'    => array('settings', 'templates', 'delivery_servers', 'upload_settings'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('settings/index'), 'label' => Yii::t('app', 'Common'), 'active' => strpos($route, 'settings/index') === 0),
                    array('url' => array('settings/success_messages'), 'label' => Yii::t('app', 'Success Messages'), 'active' => strpos($route, 'settings/success_messages') === 0),
                    array('url' => array('upload_settings/index'), 'label' => Yii::t('app', 'Upload Settings'), 'active' => strpos($route, 'upload_settings/index') === 0),
                    array('url' => array('settings/email_templates'), 'label' => Yii::t('app', 'Common email template'), 'active' => strpos($route, 'settings/email_templates') === 0),
                    array('url' => array('templates/index'), 'label' => Yii::t('app', 'Other email templates'), 'active' => strpos($route, 'template/index') === 0),
                    array('url' => array('delivery_servers/index'), 'label' => Yii::t('app', 'Delivery Servers'), 'active' => strpos($route, 'delivery_servers/index') === 0),
                ),
            ),



        );

        $menuItems = (array)Yii::app()->hooks->applyFilters('backend_left_navigation_menu_items', $menuItems);

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
                'label'     => '<i class="glyphicon ' . $data['icon'] . '"></i> <span>' . $data['name'] . '</span>' . (!empty($data['items']) ? '<i class="fa fa-angle-left pull-right"></i>' : ''),
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
