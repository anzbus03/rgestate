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
 
class SharereportWidget extends CWidget
{
    public function run()
    {
        $sections   = array();
        $hooks      = Yii::app()->hooks;
        $controller = $this->controller;
        $route      = $controller->route;
        $priority   = 0;
        $request    = Yii::app()->request;
        $customer   = Yii::app()->customer->getModel();
        
        Yii::import('zii.widgets.CMenu');
        
        $menuItems = array(
            'dashboard' => array(
                'name'      => Yii::t('app', 'Dashboard'),
                'icon'      => 'glyphicon-dashboard',
                'active'    => 'dashboard',
                'route'     => array('dashboard/index'),
            ),
            'price_plans' => array(
                'name'      => Yii::t('app', 'Price plans'),
                'icon'      => 'glyphicon-credit-card',
                'active'    => 'price_plans',
                'route'     => null,
                'items'     => array(
                    array('url' => array('price_plans/index'), 'label' => Yii::t('app', 'Price plans'), 'active' => strpos($route, 'price_plans/index') === 0 || strpos($route, 'price_plans/payment') === 0),
                    array('url' => array('price_plans/orders'), 'label' => Yii::t('app', 'Orders history'), 'active' => strpos($route, 'price_plans/order') === 0),
                ),
            ),
            'lists' => array(
                'name'      => Yii::t('app', 'Lists'),
                'icon'      => 'glyphicon-list-alt',
                'active'    => 'list',
                'route'     => array('lists/index'),
            ),
            'campaigns' => array(
                'name'      => Yii::t('app', 'Campaigns'),
                'icon'      => 'glyphicon-envelope',
                'active'    => 'campaign',
                'route'     => null,
                'items'     => array(
                    array('url' => array('campaigns/index'), 'label' => Yii::t('app', 'Campaigns'), 'active' => strpos($route, 'campaigns') === 0),
                    array('url' => array('campaign_groups/index'), 'label' => Yii::t('app', 'Groups'), 'active' => strpos($route, 'campaign_groups') === 0),
                ),
            ),
            'templates' => array(
                'name'      => Yii::t('app', 'Templates'),
                'icon'      => 'glyphicon-text-width',
                'active'    => 'templates',
                'route'     => array('templates/index'),
            ),
            'servers'       => array(
                'name'      => Yii::t('app', 'Servers'),
                'icon'      => 'glyphicon-transfer',
                'active'    => array('delivery_servers', 'bounce_servers', 'feedback_loop_servers'),
                'route'     => null,
                'items'     => array(
                    array('url' => array('delivery_servers/index'), 'label' => Yii::t('app', 'Delivery servers'), 'active' => strpos($route, 'delivery_servers') === 0),
                    array('url' => array('bounce_servers/index'), 'label' => Yii::t('app', 'Bounce servers'), 'active' => strpos($route, 'bounce_servers') === 0),
                    array('url' => array('feedback_loop_servers/index'), 'label' => Yii::t('app', 'Feedback loop servers'), 'active' => strpos($route, 'feedback_loop_servers') === 0),
                ),
            ),
            'api-keys' => array(
                'name'      => Yii::t('app', 'Api keys'),
                'icon'      => 'glyphicon-star',
                'active'    => 'api_keys',
                'route'     => array('api_keys/index'),
            ),
        );

        if (!Yii::app()->options->get('system.customer.action_logging_enabled', true)) {
            unset($menuItems['dashboard']);
        }
        
        $maxDeliveryServers = $customer->getGroupOption('servers.max_delivery_servers', 0);
        $maxBounceServers   = $customer->getGroupOption('servers.max_bounce_servers', 0);
        $maxFblServers      = $customer->getGroupOption('servers.max_fbl_servers', 0);
        
        if (!$maxDeliveryServers && !$maxBounceServers && !$maxFblServers) {
            unset($menuItems['servers']);
        } else {
            foreach (array($maxDeliveryServers, $maxBounceServers, $maxFblServers) as $index => $value) {
                if (!$value && isset($menuItems['servers']['items'][$index])) {
                    unset($menuItems['servers']['items'][$index]);
                }
            }
        }
        
        if (Yii::app()->options->get('system.monetization.monetization.enabled', 'no') == 'no') {
            unset($menuItems['price_plans']);
        }

        $menuItems = (array)Yii::app()->hooks->applyFilters('customer_left_navigation_menu_items', $menuItems);

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
