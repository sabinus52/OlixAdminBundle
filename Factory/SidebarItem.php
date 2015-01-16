<?php
/**
 * Classe de chaque élément composant la sidebar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Factory;


class SidebarItem implements SidebarItemInterface
{

    /**
     * Nom de l'élément du menu (utilisé pour le menu parent)
     * @var string
     */
    protected $name = null;

    /**
     * Label à afficher, name est utilisé par défaut
     * @var string
     */
    protected $label = null;

    /**
     * Nom de la troute
     * @var string
    */
    protected $route = null;

    /**
     * Paramètres de la route
     * @var array
     */
    protected $routeParams = array();

    /**
     * Icone du menu
     * @var string
     */
    protected $icon = null;

    /**
     * Si l'item doit être affiché
     * @var boolean
     */
    protected $display = true;

    /**
     * Les éléments enfants
     * @var \Olix\AdminBundle\Factory\SidebarItem[]
     */
    protected $children = array();

    /**
     * L'élement parent
     * @var \Olix\AdminBundle\Factory\SidebarItem|null
    */
    protected $parent = null;



    /**
     * Constructeur
     * 
     * @param string $name   : Nom du menu
     * @param array $options : Options du menu
     */
    public function __construct($name, array $options)
    {
        $this->name = $name;
        $this->buildOptions($options);
    }


    /**
     * Construit et affecte les options au menu
     * 
     * @param array $options : Options du menu
     */
    public function buildOptions($options)
    {
        $options = array_merge(
            array(
                'label'         => null,
                'route'         => null,
                'routeParams'   => array(),
                'icon'          => null,
                'display'       => true,
            ), $options);
        $this
            ->setLabel($options['label'])
            ->setRoute($options['route'])
            ->setRouteParams($options['routeParams'])
            ->setIcon($options['icon'])
            ->setDisplay($options['display'])
        ;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getLabel()
    {
        return ($this->label !== null) ? $this->label : $this->name;
    }


    /**
     * @param string $label
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }


    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }


    /**
     * @param string $route
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }


    /**
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }


    /**
     * @param array $route
     * @return \Olix\AdminBundle\Factory\SidebarItem
    */
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }


    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }


    /**
     * @param string $icon
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }


    /**
     * @return boolean
     */
    public function isDisplayed()
    {
        return $this->display;
    }


    /**
     * @param boolean $bool
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function setDisplay($bool)
    {
        $this->display = boolval($bool);
        return $this;
    }


    /**
     * @param string $name
     * @param array $options
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function addChild($name, array $options = array())
    {
        $child = new SidebarItem($name, $options);
        $child->setParent($this);
        $this->children[$child->getName()] = $child;
        return $child;
    }


    /**
     * @param string $name
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function getChild($name)
    {
        return isset($this->children[$name]) ? $this->children[$name] : null;
    }


    /**
     * @param string $name
     */
    public function removeChild($name)
    {
        if (isset($this->children[$name])) {
            $this->children[$name]->setParent(null);
            unset($this->children[$name]);
        }
    }


    /**
     * @return multitype:\Olix\AdminBundle\Factory\SidebarItem
     */
    public function getChildren()
    {
        return $this->children;
    }


    /**
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * @param SidebarItemInterface $parent
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function setParent(SidebarItemInterface $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }


    /**
     * @see Countable::count()
     */
    public function count()
    {
        return count($this->children);
    }


    /**
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }


    /**
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return isset($this->children[$offset]);
    }


    /**
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->getChild($offset);
    }


    /**
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        return $this->addChild($offset)->setLabel($value);
    }


    /**
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $this->removeChild($offset);
    }

}