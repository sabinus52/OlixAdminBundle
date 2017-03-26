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
        $resTwig = array();
        foreach ($container->getParameter('twig.form.resources') as $res) {
            if ($res == 'form_div_layout.html.twig') continue;
            $resTwig[] = $res;
        }
        $resTwig[] = 'OlixAdminBundle:Form:bootstrap3_horizontal_layout.html.twig';
        $container->setParameter('twig.form.resources', $resTwig);
    }

}