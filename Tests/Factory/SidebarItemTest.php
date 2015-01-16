<?php
/**
 * Tests unitaires pour la sidebar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Tests\Factory;


class SidebarItemTest extends SidebarTestCase
{

    public function testCreateItem()
    {
        $this->assertEquals('child 1', $this->child1->getName());
        $this->assertEquals('Child one', $this->child1->getLabel());
        $this->assertEquals('olix_admin_route_test', $this->child1->getRoute());
        $this->assertEquals(array('param1' => 1, 'param2' => 'toto'), $this->child1->getRouteParams());
        $this->assertEquals('test.png', $this->child1->getIcon());
        $this->assertFalse($this->child1->isDisplayed());
    }


    public function testGetParent()
    {
        $this->assertNull($this->sidebar->getParent());
        $this->assertSame($this->sidebar, $this->child1->getParent());
        $this->assertSame($this->child3, $this->c32->getParent());
    }


    public function testGetChild()
    {
        $this->assertSame($this->child2, $this->sidebar->getChild('child 2'));
        $this->assertSame($this->c31, $this->child3->getChild('C 31'));
        $this->assertSame($this->c32, $this->child3->getChild('C 32'));
    }


    public function testCountable()
    {
        $this->assertCount(3, $this->sidebar);
        $this->assertCount(2, $this->child3);
        $this->sidebar->addChild('new');
        $this->assertCount(4, $this->sidebar);
        $this->sidebar->removeChild('new');
        $this->assertCount(3, $this->sidebar);
    }


    public function testArrayAccess()
    {
        $this->assertCount(1, $this->sidebar['child 2']);
        $this->assertNull($this->sidebar['fake']);
        $this->assertCount(0, $this->sidebar['child 2']['C 21']);
        
        $this->sidebar->addChild('new');
        $this->assertEquals('new', $this->sidebar['new']->getName());
        
        $this->sidebar['new child'] = 'My label';
        $this->assertEquals('new child', $this->sidebar['new child']->getName());
        $this->assertEquals('My label', $this->sidebar['new child']->getLabel());
        unset($this->sidebar['new child']);
        $this->assertNull($this->sidebar['new child']);
    }


    public function testIterator()
    {
        foreach ($this->sidebar as $child) {
            $this->assertEquals('child 1', $child->getName());
            break;
        }
    }
}