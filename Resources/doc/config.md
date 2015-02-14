Configuration du BackOffice
===========================

Créer la classe avec le nom désiré correspondant 
à la valeur déclarer dans le fichier *config.yml* :

``` yaml
# app/config/config.yml

olix_admin:
    config_class: \My\AdminBundle\Config\MyClassConfig
    theme: bundles/myadmin/css/theme.css
```

### Paramètres :

- `config_class` : Classe contenant la configuration de l'Admin (voir l'exemple ci-dssous)
- `theme` : Emplacement du fichier CSS contenant thème personnalisable de l'admin


## Exemple

``` php
<?php

namespace My\AdminBundle\Config;

use Olix\AdminBundle\Config\ConfigInterface;
use Olix\AdminBundle\Factory\AdminFactory;


class MyClassConfig implements ConfigInterface
{

    public function create(AdminFactory $admin)
    {
        $admin->setBrand('DemoAdmin')
              ->setLogo('bundles/myadmin/images/logo.png')
              ->setDescription('Démo d\'un back office');
        
        $sidebar = $admin->createSidebar();
        $sidebar->setIcon("fa fa-home fa-fw")
                ->setLabel("Accueil")
                ->setRoute('my_admin_dashboard');
        $sidebar->addChild('dashboard', array(
            'label' => 'Tableau de bord',
            'icon'  => 'fa fa-dashboard fa-fw',
            'route' => 'my_admin_dashboard',
        ));
        
        $menu1 = $sidebar->addChild('menu1', array(
            'label' => 'Menu 1',
            'icon'  => 'fa fa-desktop fa-fw',
        ));
        $menu1->addChild('menu1_ssmenu1', array(
            'label' => 'Sous Menu 1 1',
            'icon'  => 'fa fa-font fa-fw',
            'route' => 'my_admin_ssmenu11',
        ));
        $menu1->addChild('menu1_ssmenu2', array(
            'label'   => 'Sous Menu 1 2',
            'icon'    => 'fa fa-hand-o-up fa-fw',
            'route'   => 'my_admin_ssmenu12',
            'display' => false,
        ));
        
        $menu2 = $sidebar->addChild('menu2', array(
            'label' => 'Menu 2',
            'icon'  => 'fa fa-tables fa-fw',
        ));
        $menu2->addChild('menu2_ssmenu1', array(
            'label' => 'Sous Menu 2 1',
            'icon'  => 'fa fa-cube fa-fw',
            'route' => 'my_admin_ssmenu21',
        ));
        $menu2->addChild('menu2_ssmenu2', array(
            'label'   => 'Sous Menu 2 2',
            'icon'    => 'fa fa-edit fa-fw',
            'route'   => 'my_admin_ssmenu22',
            'routeParams' => array('id' => 123),
        ));
    }

}
```

## Réference AdminFactory

`setBrand(string)` : Nom de votre application

`setLogo(string)` : Chemin de votre logo

`setDescription(string)` : Description de votre application

`createSidebar()` : Retourne l'objet de la Sidebar


## Réference SidebarItem

`addChild(string $identifiant, array $options)` : Ajouter un noeud à son menu

Liste des options disponibles :
- `label` *(string)* : Label du menu
- `icon` *(string)* : Icone du menu (class=) avec les icones bootstrap ou fontAwesome
- `route` *(string)* : Identifiant de la route
- `routeParams` *(array)* : Tableau de paramètre pour la route
- `display` *(boolean)* : Si affichage ou pas
