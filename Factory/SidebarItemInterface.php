<?php
/**
 * Interface de la classe de chaque élément composant la sidebar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Factory;


interface SidebarItemInterface extends \ArrayAccess, \Countable, \IteratorAggregate
{

    /**
     * Retourne le nom du menu
     * 
     * @return string
     */
    public function getName();


    /**
     * Retourne le label
     * 
     * @return string
     */
    public function getLabel();


    /**
     * Affecte un label
     * 
     * @param string $label
     * @return \Olix\AdminBundle\Factory\SidebarItemInterface
     */
    public function setLabel($label);


    /**
     * Retourne le nom de la route
     * 
     * @return string
     */
    public function getRoute();


    /**
     * Affecte une route
     * 
     * @param string $route
     * @return \Olix\AdminBundle\Factory\SidebarItemInterface
     */
    public function setRoute($route);


    /**
     * Retourne l'icone
     * 
     * @return string
     */
    public function getIcon();


    /**
     * Affecte une icone
     * 
     * @param string $icon
     * @return \Olix\AdminBundle\Factory\SidebarItemInterface
     */
    public function setIcon($icon);


    /**
     * Si le menu doit être affiché
     * 
     * @return boolean
     */
    public function isDisplayed();


    /**
     * Affecte si le menu doit être affiché
     * 
     * @param boolean $bool
     */
    public function setDisplay($bool);


    /**
     * Ajoute un nouvel enfant au menu
     * 
     * @param string $name    : Nom de l'enfant
     * @param array  $options : Ses options
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function addChild($name, array $options = array());


    /**
     * Retourne l'enfant
     * 
     * @param string $name : Nom de l'enfant
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function getChild($name);


    /**
     * Retire un enfant
     * 
     * @param string $name : Nom de l'enfant
     */
    public function removeChild($name);


    /**
     * Retourne les enfants
     * 
     * @return array
     */
    public function getChildren();


    /**
     * Retourne le parent
     * 
     * @return \Olix\AdminBundle\Factory\SidebarItem
     */
    public function getParent();


    /**
     * Affecte un menu parent
     * 
     * @param SidebarItemInterface $parent
     * @return \Olix\AdminBundle\Factory\SidebarItemInterface
     */
    public function setParent(SidebarItemInterface $parent = null);

}