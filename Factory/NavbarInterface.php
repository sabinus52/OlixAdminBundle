<?php
/**
 * Interface de la classe de la barre de navigation
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Factory;


interface NavbarInterface extends \ArrayAccess, \Countable, \IteratorAggregate
{

    /**
     * Ajoute un nouvel élément
     *
     * @param string $name    : Nom de l'élément
     * @param array  $options : Ses options
     * @return \Olix\AdminBundle\Factory\Navbar
     */
    public function addItem($name, array $options = array());


    /**
     * Retourne un élément
     *
     * @param string $name : Nom de l'élément
     * @return array
     */
    public function getItem($name);


    /**
     * Retire un élément
     *
     * @param string $name : Nom de l'enfant
    */
    public function removeItem($name);

}