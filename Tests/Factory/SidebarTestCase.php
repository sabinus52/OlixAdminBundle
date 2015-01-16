<?php
/**
 * Préparation des tests unitaires pour la sidebar
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Tests\Factory;

use Olix\AdminBundle\Factory\AdminFactory;
use Olix\AdminBundle\Factory\SidebarItem;


abstract class SidebarTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $sidebar;

    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $child1;
    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $child2;
    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $child3;

    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $c21;
    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $c31;
    /**
     * @var \Olix\AdminBundle\Factory\SidebarItem
     */
    protected $c32;



    /**
     *           root
     *     /      |       \
     * child1  child2    child3
     *            |      /    \
     *           c21   c31   c32
     */
    protected function setUp()
    {
        $factory = new AdminFactory();
        // Création de l'arbre de la sidebar
        $this->sidebar = $factory->createSidebar();
        $this->child1 = $this->sidebar->addChild('child 1', array(
            'label'     => 'Child one',
            'route'     => 'olix_admin_route_test',
            'icon'      => 'test.png',
            'display'   => false,
        ));
        $this->child2 = $this->sidebar->addChild('child 2');
        $this->c21 = $this->child2->addChild('C 21');
        $this->child3 = $this->sidebar->addChild('child 3');
        $this->c31 = $this->child3->addChild('C 31');
        $this->c32 = $this->child3->addChild('C 32');
    }


    protected function tearDown()
    {
        $this->sidebar = null;
        $this->child1 = null;
        $this->child2 = null;
        $this->c21 = null;
        $this->child3 = null;
        $this->c31 = null;
        $this->c31 = null;
    }

}