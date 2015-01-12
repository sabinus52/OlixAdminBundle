<?php
/**
 * Interface pour la configuration de l'admin
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package Olix
 * @subpackage AdminBundle
 */

namespace Olix\AdminBundle\Config;

use Olix\AdminBundle\Factory\AdminFactory;


interface ConfigInterface
{

    /**
     * Creation de la configuration de base
     * 
     * @param AdminFactory $factory
     */
    public function create(AdminFactory $factory);

}