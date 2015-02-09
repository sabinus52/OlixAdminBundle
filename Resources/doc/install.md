Installation du bundle OlixAdminBundle
======================================


### Pre-requis

Ajouter le paramètre `component-dir` dans la section `config` de votre fichier *composer.json* 
avec la valeur **web/public** pour que les composants (assets) soit disponibles

``` json
"config": {
    "component-dir": "web/public"
}
```

Puis ajouter le paramètre suivant pour autoriser les packages *@dev*

``` json
"minimum-stability" : "dev"
```


Installation
------------


### Etape 1 : Génération de votre bundle

En ligne de commande, faire la génération du bundle _MyAdminBundle_ qui acceuillera le BackOffice
``` shell
app/console generate:bundle
```


### Etape 2 : Télécharger OlixAdminBundle avec composer

Ajouter OlixAdminBundle en executant la commande :

``` bash
$ php composer.phar require olix/admin-bundle "dev-master"
```


### Etape 3 : Activer les bundles

Activer les bundles dans le kernel :

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Olix\AdminBundle\OlixAdminBundle(),
        new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
        new Sg\DatatablesBundle\SgDatatablesBundle(),
        new Olix\DatatablesBootstrapBundle\OlixDatatablesBootstrapBundle(),
        new Olix\FormsExtBootstrapBundle\OlixFormsExtBootstrapBundle(),
        new FOS\UserBundle\FOSUserBundle(),
        new Olix\SecurityBundle\OlixSecurityBundle(),
    );
}
```

**Note** : Olix\AdminBundle\OlixAdminBundle doit être déclaré en premier


### Etape 4 : Configurer security.yml de votre application

Le fichier `app/config/security.yml` contient la configuration de securité de votre application.

Exemple de configuration à adopter

``` yaml
# app/config/security.yml
security:

    encoders:
        FOS\UserBundle\Model\UserInterface: sha512

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: [ROLE_USER, ROLE_ADMIN]

    providers:
        fos_userbundle:
            id: fos_user.user_provider.username

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            pattern: ^/
            form_login:
                provider: fos_userbundle
                csrf_provider: form.csrf_provider
            logout:       true
            anonymous:    true
            remember_me:
                key: "%secret%"

    access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/, role: ROLE_USER }
```

Pour plus d'information sur la configurion du fichier `security.yml`, lire la 
[documentation](http://symfony.com/doc/current/book/security.html) du composant sécurité de Symfony2.


### Etape 5 : Configurer OlixAdminBundle

Ajouter le configuration suivante à votre fichier de configuration `app/config/config.yml` :

``` yaml
# app/config/config.yml
fos_user:
    db_driver: orm
    firewall_name: main
    user_class: Olix\SecurityBundle\Entity\User
    group:
        group_class: Olix\SecurityBundle\Entity\Group

olix_admin:
    config_class: \My\AdminBundle\Config\MyClassConfig
```

`\My\AdminBundle\Config\MyClassConfig` doit être remplacé par la classe où sera definie
la configuration et la menu du votre BackOffice.
Plus de détails, sur comment construire la configuration. TODO

**Note** : Il faut activer le `translator` dans votre configuration.

``` yaml
# app/config/config.yml

framework:
    translator: ~
```


### Etape 6 : Importer les fichiers de routage

Importer le routage suivant pour inclure toutes les routes

``` yaml
# app/config/routing.yml
olix_admin:
    resource: "@OlixAdminBundle/Resources/config/routing/all.yml"
```


### Etape 7 : Mettre à jour le schema de votre base de données

Exécuter la commande suivante :

``` bash
$ php app/console doctrine:schema:update --force
```


### Etape 8 : Publier les assets

Exécuter la commande suivante :

``` bash
$ php app/console assets:install --symlink
```


### Etape 7 : Essayer

Créer un super administrateur avec la commande :

``` bash
$ php app/console fos:user:create admin --super-admin
```

Vous pouvez maintenant vous connecter à `http://app.com/app_dev.php/` !

