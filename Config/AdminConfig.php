<?php

namespace Olix\AdminBundle\Config;

use Olix\AdminBundle\Factory\AdminFactory;


class AdminConfig implements ConfigInterface
{

    public function create(AdminFactory $admin)
    {
        $admin->setBrand('OlixAdminTest')
              ->setLogo('bundles/olixadmin/images/avatar.png')
              ->setDescription('Admin Template');
    }

}