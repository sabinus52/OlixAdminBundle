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
use Olix\AdminBundle\Factory\BreadcrumbItem;


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
        $classConfig = $this->container->getParameter('olix_admin.config_class');
        if (!class_exists($classConfig))
            throw new \InvalidArgumentException(sprintf('The class "%s" defined in the config.yml "olix_admin.config_class" is not exists', $classConfig));
        $this->config = new $classConfig();
        $this->factory = new AdminFactory();
        $this->config->create($this->container, $this->factory);
    }


    /**
     * Ajoute un nouvel élément au fil d'ariane
     * 
     * @param array $item
     * @return \Olix\AdminBundle\Renderer\AdminRenderer
     */
    public function addItemInBreadcrumb(array $item)
    {
        $item = new BreadcrumbItem('bc'.rand(), $item);
        $this->factory->addItemBreadcrumb($item);
        return $this;
    }


    /**
     * Rendu de l'admin en fonction de la vue
     *
     * @param string   $view       Nom de la vue
     * @param string   $menuActive Nom de l'item du menu actif
     * @param array    $parameters Tableau de paremètres à passer dans la vue
     * @param Response $response   Instance de l'objet Response
     *
     * @return Response
     */
    public function render($view, $menuActive, array $parameters = array(), Response $response = null)
    {
        $this->factory->build($this->container, $menuActive);
        $parameters['olix'] = $this->factory->fetch();
        
        return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }

}