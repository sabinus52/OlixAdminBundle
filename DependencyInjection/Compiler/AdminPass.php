<?php
/**
 * Chargement dans la configuration de la ressources Twig Bootstrap pour les formulaires
 * 
 * @author Olivier <sabinus52@gmail.com>
 * 
 * @package Olix
 * @subpackage FormsExtBootstrapBundle
 */

namespace Olix\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class AdminPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $container->setParameter('twig.form.resources', array('OlixAdminBundle:Form:bootstrap3_horizontal_layout.html.twig'));
    }

}