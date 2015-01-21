<?php
/**
 * Extension pour l'affichage des différents bloc (navbar, sidebar, ...) de l'admin
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Twig\Extension;


class AdminExtension extends \Twig_Extension
{

    /**
     * Déclaration des fonctions
     * 
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('olix_admin_navbar', array($this, 'renderNavbar'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('olix_admin_sidebar', array($this, 'renderSidebar'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('olix_admin_breadcrumb', array($this, 'renderBreadcrumb'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }


    /**
     * Fonction de rendu de la barre de navigation
     * 
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderNavbar(\Twig_Environment $environment, array $options = array())
    {
        return $environment->render(
            'OlixAdminBundle:Navbar:navbar.html.twig',
            $options
        );
    }


    /**
     * Fonction de rendu du menu
     * 
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderSidebar(\Twig_Environment $environment, array $options = array())
    {
        return $environment->render(
            'OlixAdminBundle:Sidebar:sidebar.html.twig',
            $options
        );
    }


    /**
     * Fonction de rendu du fil d'ariane
     *
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderBreadcrumb(\Twig_Environment $environment, array $options = array())
    {
        return $environment->render(
            'OlixAdminBundle:Breadcrumb:breadcrumb.html.twig',
            $options
        );
    }


    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'olix.admin.twig.extension.admin';
    }

}