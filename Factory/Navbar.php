<?php
/**
 * Classe des éléments composant la navbar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Factory;


class Navbar implements NavbarInterface
{


    /**
     * Elements prédéfinis
     */
    const ITEM_USER_PROFILE = 'security';


    /**
     * Liste des éléments de la navbar
     * @var array
     */
    protected $items = array();



    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->items = array();
    }


    /**
     * @param string $name
     * @param array $options
     * @return \Olix\AdminBundle\Factory\Navbar
     */
    public function addItem($name, array $options = array())
    {
        $this->items[$name] = array_merge(
            array('name' => $name),
            $options
        );
        return $this;
    }


    /**
     * @param string $name
     * @return array
     */
    public function getItem($name)
    {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }


    /**
     * @param string $name
     */
    public function removeItem($name)
    {
        if (isset($this->items[$name])) {
            unset($this->items[$name]);
        }
    }


    /**
     * @see Countable::count()
     */
    public function count()
    {
        return count($this->items);
    }


    /**
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }


    /**
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }


    /**
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->getItem($offset);
    }


    /**
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        return $this->addItem($offset);
    }


    /**
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $this->removeItem($offset);
    }

}