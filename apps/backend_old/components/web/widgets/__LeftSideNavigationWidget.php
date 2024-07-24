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
            
            'users' => array(
                'name'      => Yii::t('app', 'Users'),
                'icon'      => 'glyphicon-user',
                'active'    => 'users',
                'route'     => array('users/index'),
            ),
            'hotel' => array(
                'name'      => Yii::t('app', 'Hotel Manager'),
                'icon'      => 'glyphicon-pushpin',
                'active'    => array('hotel', 'room','roomtype','capacity','type_room'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('hotel/index'), 'label' => Yii::t('app', 'Hotel Manager'), 'active' => strpos($route, 'hotel') === 0),
                    array('url' => array('room_manage/index'), 'label' => Yii::t('app', 'Room Manager'), 'active' => strpos($route, 'room_manage') === 0),
                    array('url' => array("type_room/index"), 'label' => Yii::t('app', 'Room Type Manager'), 'active' =>  strpos($route, 'type_room') === 0),
                    array('url' => array('roomtype/index'), 'label' => Yii::t('app', 'Room Type Manager'), 'active' => strpos($route, 'roomtype') === 0),
                    array('url' => array('capacity/index'), 'label' => Yii::t('app', 'Capacity Manager'), 'active' => strpos($route, 'capacity') === 0),
                ),
            ),
            'providings' => array(
                'name'      => Yii::t('app', 'Hotel Providings'),
                'icon'      => 'glyphicon-pushpin',
                'active'    => array('activity', 'food','general','service'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('activity/index'), 'label' => Yii::t('app', 'Activity Manager'), 'active' => strpos($route, 'activity') === 0),
                    array('url' => array('food/index'), 'label' => Yii::t('app', 'Food & Drink Manager'), 'active' => strpos($route, 'food') === 0),
                    array('url' => array('general/index'), 'label' => Yii::t('app', 'General Manager'), 'active' => strpos($route, 'general') === 0),
                    array('url' => array('service/index'), 'label' => Yii::t('app', 'Service Manager'), 'active' => strpos($route, 'service') === 0),
                ),
            ),
             'agent' => array(
                'name'      => Yii::t('app', 'Agent Manager'),
                'icon'      => 'glyphicon-record',
                'active'    => 'agent',
                'route'     => null,
                  'items'     => array(
                    array('url' => array('agent/index'), 'label' => Yii::t('app', 'Agent Manager'), 'active' => strpos($route, 'agent') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Commission'), 'active' => strpos($route, 'agent_commission') === 0),
                ),
            ),
             'price' => array(
                'name'      => Yii::t('app', 'Price Manager'),
                'icon'      => 'glyphicon-usd',
                'active'    => 'price',
                'route'     => null,
                  'items'     => array(
                    array('url' => array('price/index'), 'label' => Yii::t('app', 'Price Manager'), 'active' => strpos($route, 'price') === 0),
                   // array('url' => array('#'), 'label' => Yii::t('app', 'Special Offer'), 'active' => strpos($route, 'price') === 0),
                   // array('url' => array('#'), 'label' => Yii::t('app', 'Advance Payment'), 'active' => strpos($route, 'price') === 0),
                ),
            ),
             'booking' => array(
                'name'      => Yii::t('app', 'Booking Manager'),
                'icon'      => 'glyphicon-sort',
                'active'    => 'booking',
                'route'     => null,
                 'items'     => array(
                    array('url' => array('#'), 'label' => Yii::t('app', 'View Booking List'), 'active' => strpos($route, 'booking') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Customer Lookup'), 'active' => strpos($route, 'booking') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Calender View'), 'active' => strpos($route, 'booking') === 0),
                ),
            ),
             'language' => array(
                'name'      => Yii::t('app', 'Language Manager'),
                'icon'      => 'glyphicon-record',
                'active'    => 'language',
                'route'     => null,
                 'items'     => array(
                    array('url' => array('#'), 'label' => Yii::t('app', 'Manage Languages'), 'active' => strpos($route, 'language') === 0),
                ),
            ),
             'currency' => array(
                'name'      => Yii::t('app', 'Currency Manager'),
                'icon'      => 'glyphicon-credit-card',
                'active'    => 'language',
                'route'     => null,
                'items'     => array(
                    array('url' => array('#'), 'label' => Yii::t('app', 'Manage Currency'), 'active' => strpos($route, 'currency') === 0),
                ),
            ),
             'settings' => array(
                'name'      => Yii::t('app', 'Settings'),
                'icon'      => 'glyphicon-cog',
                'active'    => 'language',
                'route'     => null,
                'items'     => array(
                    array('url' => array('#'), 'label' => Yii::t('app', 'Global Setting'), 'active' => strpos($route, 'settings') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Payment Gateway'), 'active' => strpos($route, 'settings') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Email Contents'), 'active' => strpos($route, 'settings') === 0),
                    array('url' => array('#'), 'label' => Yii::t('app', 'Email Contents'), 'active' => strpos($route, 'settings') === 0),
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
