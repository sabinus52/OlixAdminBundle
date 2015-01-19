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
     * @param string $menuActive : nom du menu à activer
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderSidebar(\Twig_Environment $environment, $menuActive = null, array $options = array())
    {
        return $environment->render(
            'OlixAdminBundle:Sidebar:sidebar.html.twig',
            array_merge(array('sidebar_menu_active' => $menuActive), $options)
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