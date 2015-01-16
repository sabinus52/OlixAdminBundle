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
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $sidebar = null;



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
            'sidebar' => $this->sidebar,
        );
    }

}