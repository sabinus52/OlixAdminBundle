Paramétrer son controller et sa vue
===================================

A la place de la fonction `render()`, utiliser le service **olix.admin**


### Exemple pour le controller

``` php
# src/My/Admin/Controller/DefaultController.php

namespace My\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{

    /**
     * @Route("/dashboard", name="my_admin_dashboard")
     */
    public function indexAction()
    {
        // ...
        
        return $this->container->get('olix.admin')->render(
            'OtopDemoBundle:Default:index.html.twig',
            'dashboard',
            array('result' => $result));
    }

}
```


### Exemple pour la vue

``` html
<!-- src/My/Admin/Resources/view/Default.idex.html.twig -->

{% extends 'OlixAdminBundle::layout.html.twig' %}

{% block title %}Surcharger le titre de la page (optionnel){% endblock %}
{% block header1 %}Surcharger le titre (optionnel){% endblock %}
{% block header2 %}Surcharger le chapo (optionnel){% endblock %}

{% block content %}

    <div class="row">

        <div class="col-sm-12">
            Hello World
        </div>

    </div>

{% endblock %}

{% block stylesheet %}
parent()
<!-- Surcharger des ressources CSS -->
{% endblock %}

{% block javascript %}
{{ parent() }}
<script type="text/javascript">
(function(){
    // ...
})();
</script>
{% endblock %}
```


### Reference

Fonction `render` du service **olix.admin**

`render(template twig, highlight menu, parameters)`

similaire à la fonction render de Twig mais ajout du paramètre
*highlight menu* qui correspond à l'identifiant du menu de la sidebar pour le surlignage.