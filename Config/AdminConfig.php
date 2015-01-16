<?php

namespace Olix\AdminBundle\Config;

use Olix\AdminBundle\Factory\AdminFactory;


class AdminConfig implements ConfigInterface
{

    public function create(AdminFactory $admin)
    {
        $admin->setBrand('OlixAdminTest')
              ->setLogo('bundles/olixadmin/images/avatar.png')
              ->setDescription('Admin Template');
        
        $sidebar = $admin->createSidebar();
        $sidebar->addChild('dashboard', array(
            'label' => 'Tableau de bord',
            'route' => 'olix_admin_dashboard'
        ));
        
        $menu1 = $sidebar->addChild('menu1', array(
            'label' => 'Menu 1',
        ));
        $menu1->addChild('ssmenu11', array(
            'label' => 'Sous menu 11',
        ));
        $menu1->addChild('ssmenu12', array(
            'label' => 'Sous menu 12',
        ));
        
        $menu2 = $sidebar->addChild('menu2', array(
            'label' => 'Menu 2',
        ));
        $menu2->addChild('ssmenu21', array(
            'label' => 'Sous menu 21',
        ));
        $menu2->addChild('ssmenu22', array(
            'label' => 'Sous menu 22',
        ));
    }

}