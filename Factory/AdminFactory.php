<?php
/**
 * Fabrique de la configuration de l'admin
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;


class AdminFactory
{

    /**
     * Marque ou titre de l'admin
     * @var string
     */
    protected $brand = null;

    /**
     * URI de l'image du logo
     * @var string
     */
    protected $logo = null;

    /**
     * Petite description
     * @var string
     */
    protected $description = null;

    /**
     * Thème de l'interface : chemin du css
     * @var string
     */
    protected $theme = null;

    /**
     * @var \Olix\AdminBundle\Factory\Navbar
     */
    protected $navbar = null;

    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $sidebar = null;

    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $menuActiv = null;

    /**
     * Fil d'araine additionnel
     * @var array
     */
    protected $breadcrumb = array();



    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->navbar = new Navbar();
    }


    /**
     * Affecte la marque de l'admin
     * 
     * @param string $brand
     * @return \Olix\AdminBundle\Factory\AdminFactory
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }


    /**
     * Affecte le logo de l'admin
     * 
     * @param string $logo
     * @return \Olix\AdminBundle\Factory\AdminFactory
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }


    /**
     * Affecte la description
     * 
     * @param string $desc
     * @return \Olix\AdminBundle\Factory\AdminFactory
     */
    public function setDescription($desc)
    {
        $this->description = $desc;
        return $this;
    }

    
    public function addItemBreadcrumb($item)
    {
        $this->breadcrumb[] = $item;
    }


    /**
     * Ajout d'un élément dans la barre de navigation
     * 
     * @param string $include : Fichier twig d'inclusion du template
     * @return \Olix\AdminBundle\Factory\AdminFactory
     */
    public function addNavbarItem($name, $include, $options = array())
    {
        $this->navbar->addItem($name, $include, $options);
        return $this;
    }


    /**
     * Créer la sidebar
     * 
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function createSidebar()
    {
        $this->sidebar = new SidebarItem('root', array());
        return $this->sidebar;
    }


    /**
     * Retourne la configuration
     * 
     * @return array
     */
    public function fetch()
    {
        return array(
            'brand' => $this->brand,
            'logo' => $this->logo,
            'description' => $this->description,
            'theme' => $this->theme,
            'navbar' => $this->navbar,
            'sidebar' => $this->sidebar,
            'menuactive' => $this->menuActiv,
            'breadcrumb' => $this->buildBreadcrumb($this->menuActiv)
        );
    }


    /**
     * Construit l'admin en fonction du menu activé
     * 
     * @param Container $container
     * @param string $menuActive
     */
    public function build(ContainerInterface $container, $menuActive = null)
    {
        // Ajout d'un thème
        $this->theme = $container->getParameter('olix_admin.theme');
        
        // Menus supplémentaires
        if ($container->has('olix_security.sidebar')) {
            $container->get('olix_security.sidebar')->build($this->sidebar);
        }
        if ($container->has('olix_server.sidebar')) {
            $container->get('olix_server.sidebar')->build($this->sidebar);
        }
        
        // Récupère l'item du menu actif
        if ($menuActive !== null) {
            $this->menuActiv = $this->sidebar->getItem($menuActive);
        }
        if ($this->menuActiv === null) {
            $this->menuActiv = new SidebarItem('null', array());
        }
        
        // Création de la Navbar avec l'ajout auto du menu de l'utilisateur
        if (class_exists('\Olix\SecurityBundle\OlixSecurityBundle')) {
            $this->navbar->addItem(Navbar::ITEM_USER_PROFILE, null);
        }
    }


    /**
     * Construit et retourne le fil d'ariane sous forme de tableau
     * 
     * @param SidebarItem $item Menu actif
     * @return array of SidebarItem
     */
    protected function buildBreadcrumb(SidebarItem $item)
    {
        $breadcrumb = array();
        foreach (array_reverse($this->breadcrumb) as $bc) {
            $breadcrumb[] = $bc;
        }
        do {
            $breadcrumb[] = $item;
        } while ($item = $item->getParent());
        return array_reverse($breadcrumb);
    }

}