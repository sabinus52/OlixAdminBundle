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
        return $this->render('OlixAdminBundle:Test:index.html.twig');
    }
}
