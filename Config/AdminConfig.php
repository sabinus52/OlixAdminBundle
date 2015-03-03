<?php

namespace Olix\AdminBundle\Config;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Olix\AdminBundle\Factory\AdminFactory;


class AdminConfig implements ConfigInterface
{

    public function create(ContainerInterface $container, AdminFactory $admin)
    {
        $admin->setBrand('OlixAdminTest')
              ->setLogo('bundles/olixadmin/images/avatar.png')
              ->setDescription('Admin Template');
        
        $sidebar = $admin->createSidebar();
        $sidebar->setIcon("fa fa-home fa-fw")
                ->setLabel("Accueil")
                ->setRoute('olix_admin_dashboard');
        $sidebar->addChild('dashboard', array(
            'label' => 'Tableau de bord',
            'icon'  => 'fa fa-dashboard fa-fw',
            'route' => 'olix_admin_dashboard',
        ));
        
        $menu1 = $sidebar->addChild('menu1', array(
            'label' => 'Menu 1',
            'icon'  => 'fa fa-desktop fa-fw',
        ));
        $menu1->addChild('ssmenu11', array(
            'label' => 'Sous menu 11',
            'icon'  => 'fa fa-font fa-fw',
            'route' => 'olix_admin_menu11',
        ));
        $menu1->addChild('ssmenu12', array(
            'label' => 'Sous menu 12',
            'icon'  => 'fa fa-cubes fa-fw',
            'route' => 'olix_admin_menu12',
        ));
        
        $menu2 = $sidebar->addChild('menu2', array(
            'label' => 'Menu 2',
            'icon'  => 'fa fa-th-large fa-fw',
        ));
        $menu2->addChild('ssmenu21', array(
            'label' => 'Sous menu 21',
            'icon'  => 'fa fa-edit fa-fw',
            'route' => 'olix_admin_menu2',
            'routeParams' => array('page' => 1),
        ));
        $menu2->addChild('ssmenu22', array(
            'label' => 'Sous menu 22',
            'icon'  => 'fa fa-table fa-fw',
            'route' => 'olix_admin_menu2',
            'routeParams' => array('page' => 2),
        ));
    }

}