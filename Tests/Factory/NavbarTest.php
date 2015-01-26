<?php
/**
 * Tests unitaires pour la navbar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Tests\Factory;

use Olix\AdminBundle\Factory\Navbar;


class NavbarTest extends NavbarTestCase
{

    public function testGetItem()
    {
        $this->assertSame(array('name' => Navbar::ITEM_USER_PROFILE), $this->navbar->getItem(Navbar::ITEM_USER_PROFILE));
    }


    public function testCountable()
    {
        $this->assertCount(2, $this->navbar);
    }


    public function testArrayAccess()
    {
        $this->assertNull($this->navbar['fake']);
        $this->assertEquals(Navbar::ITEM_USER_PROFILE, $this->navbar[Navbar::ITEM_USER_PROFILE]['name']);
        
        $this->navbar->addItem('new');
        $this->assertEquals(array('name' => 'new'), $this->navbar['new']);
        unset($this->navbar['new']);
        $this->assertNull($this->navbar['new']);
    }

}