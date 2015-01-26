<?php
/**
 * Préparation des tests unitaires pour la navbar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Tests\Factory;

use Olix\AdminBundle\Factory\Navbar;


abstract class NavbarTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Olix\AdminBundle\Factory\Navbar
     */
    protected $navbar;



    protected function setUp()
    {
        $this->navbar = new Navbar();
        $this->navbar->addItem(Navbar::ITEM_USER_PROFILE);
        $this->navbar->addItem('other');
    }


    protected function tearDown()
    {
        $this->navbar = null;
    }

}