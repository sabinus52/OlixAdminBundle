<?php

namespace Olix\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{

    /**
     * @Route("/test-dashboard", name="olix_admin_dashboard")
     */
    public function indexAction()
    {
        return $this->render('OlixAdminBundle:Test:index.html.twig', array(
            'sidebar_menu_active' => 'dashboard',
            'page_name' => "Tableau de bord",
        ));
    }


    /**
     * @Route("/test-menu11", name="olix_admin_menu11")
     */
    public function menu11Action()
    {
        return $this->render('OlixAdminBundle:Test:index.html.twig', array(
            'sidebar_menu_active' => 'ssmenu11',
            'page_name' => "Menu 11",
        ));
    }

    /**
     * @Route("/test-menu12", name="olix_admin_menu12")
     */
    public function menu12Action()
    {
        return $this->render('OlixAdminBundle:Test:index.html.twig', array(
            'sidebar_menu_active' => 'ssmenu12',
            'page_name' => "Menu 12",
        ));
    }


    /**
     * @Route("/test-menu21", name="olix_admin_menu21")
     */
    public function menu21Action()
    {
        return $this->render('OlixAdminBundle:Test:index.html.twig', array(
            'page_name' => "Menu 21",
        ));
    }

    /**
     * @Route("/test-menu22", name="olix_admin_menu22")
     */
    public function menu22Action()
    {
        return $this->render('OlixAdminBundle:Test:index.html.twig', array(
            'page_name' => "Menu 22",
        ));
    }

}
