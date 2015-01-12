<?php
/**
 * Gestionnaire de rendu des différents bloc (navbar, sidebar, ...) de l'admin
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Olix\AdminBundle\Factory\AdminFactory;


class AdminRenderer
{

    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * @var Olix\AdminBundle\Factory\AdminFactory
     */
    private $factory;

    /**
     * Classe de configuration de l'admin
     * @var unknown
     */
    private $config;


    /**
     * Constructeur
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        
        // Création de la configuration de l'admin
        $this->config = new \Olix\AdminBundle\Config\AdminConfig();
        $this->factory = new AdminFactory();
        $this->config->create($this->factory);
    }


    /**
     * Rendu de la navbar
     * 
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderNavbar(array $options = array())
    {
        return $this->container->get('templating')->render(
            'OlixAdminBundle:Navbar:navbar.html.twig',
            $this->factory->fetch());
    }

}