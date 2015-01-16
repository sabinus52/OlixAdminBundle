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

use Olix\AdminBundle\Twig\AdminRenderer;


class AdminExtension extends \Twig_Extension
{

    /**
     * @var Olix\AdminBundle\Twig\AdminRenderer
     */
    public $renderer;


    /**
     * Constructeur avec le gestionnaire de rendu AdminRenderer
     * 
     * @param AdminRenderer $renderer
     */
    public function __construct(AdminRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    /**
     * Déclaration des fonctions
     * 
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('olix_admin_navbar', array($this, 'renderNavbar'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('olix_admin_sidebar', array($this, 'renderSidebar'), array('is_safe' => array('html'))),
        );
    }


    /**
     * Fonction de rendu de la barre de navigation
     * 
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderNavbar(array $options = array())
    {
        return $this->renderer->renderNavbar($options);
    }


    /**
     * Fonction de rendu du menu
     *
     * @param array $options : Options dans le contexte du rendu de la vue
     */
    public function renderSidebar(array $options = array())
    {
        return $this->renderer->renderSidebar($options);
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