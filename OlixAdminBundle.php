<?php

namespace Olix\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Olix\AdminBundle\DependencyInjection\Compiler\AdminPass;


class OlixAdminBundle extends Bundle
{

    /**
     * Compilation pour le chargement des paramètres de ressources de Twig
     *
     * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AdminPass());
    }

}
