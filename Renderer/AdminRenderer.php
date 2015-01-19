<?php
/**
 * Gestionnaire de rendu de l'admin
 * 
 * @service olixadmin
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Renderer;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Olix\AdminBundle\Factory\AdminFactory;


class AdminRenderer extends ContainerAware
{

    /**
     * @var \Olix\AdminBundle\Factory\AdminFactory
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
        $this->setContainer($container);
        $this->build();
    }


    /**
     * Construit la config de l'admin (config + menu)
     */
    protected function build()
    {
        $this->config = new \Olix\AdminBundle\Config\AdminConfig();
        $this->factory = new AdminFactory();
        $this->config->create($this->factory);
    }


    /**
     * Rendu de l'admin en fonction de la lvue
     *
     * @param string   $view       Nom de la vue
     * @param array    $parameters Tableau de paremètres à passer dans la vue
     * @param Response $response   Instance de l'objet Response
     *
     * @return Response
     */
    public function render($view, array $parameters = array(), Response $response = null)
    {
        $parameters['olix'] = $this->factory->fetch();
        return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }

}