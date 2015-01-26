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
            'navbar' => $this->navbar,
            'sidebar' => $this->sidebar,
            'menuactive' => $this->menuActiv,
            'breadcrumb' => $this->buildBreadcrumb($this->menuActiv)
        );
    }


    /**
     * Construit l'admin en fonction du menu activé
     * 
     * @param string $menuActive
     */
    public function build($menuActive = null)
    {
        // Récupère l'item du menu actif
        if ($menuActive !== null) {
            $this->menuActiv = $this->sidebar->getItem($menuActive);
        }
        if ($this->menuActiv === null) {
            $this->menuActiv = new SidebarItem('null', array());
        }
        
        // Création de la Navbar avec l'ajout auto du menu de l'utilisateur
        $this->navbar = new Navbar();
        if (class_exists('\Olix\SecurityBundle\OlixSecurityBundle')) {
            $this->navbar->addItem(Navbar::ITEM_USER_PROFILE);
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
        do {
            $breadcrumb[] = $item;
        } while ($item = $item->getParent());
        return array_reverse($breadcrumb);
    }

}