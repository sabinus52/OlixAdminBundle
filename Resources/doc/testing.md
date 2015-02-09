Tester son installation
=======================

Pour tester si l'installation a réussi, il faut apporter 2 changements

### Changement 1

Dans le fichier *app/config/config.yml*, modifier le paramètre avec la valeur
`\Olix\AdminBundle\Config\AdminConfig` comme suit :

``` yaml
# app/config/config.yml
olix_admin:
    config_class: \Olix\AdminBundle\Config\AdminConfig
```


### Changement 2

Dans le fichier de routage *app/config/routing.yml*, ajouter :

``` yaml
# app/config/routing.yml
olix_admin_test:
    resource: "@OlixAdminBundle/Resources/config/routing/test.yml"
```


### Tester

Vous pouvez maintenant vous connecter à `http://app.com/app_dev.php/test-dashboard` !
