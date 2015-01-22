/**
 * Gestion de la SideBar (longue et courte)
 *
 * @namespace olixAdminSideBar
 */
var olixAdminSideBar = {


    /**
     * Initialise la SideBar
     */
    init: function()
    {
        // Active la sidebar en mode accordéon
        $('#olixSidebar').metisMenu({
            toggle: true // disable the auto collapse. Default: true.
        });

        // En fonction de la taille de la fenêtre, ajoute le style CSS pour la sidebar
        $( window ).resize( this.initializeByDisplay );
        this.initializeByDisplay();

        // Click sur la bouton d'affichage ou pas de la sidebar mini
        $("#olixSidebarToggle span").click(function(e) {
            e.preventDefault();
            olixAdminSideBar.toggleMenu();
        });

        // Au survol de la souris affiche la sidebar en grand
        $("#olixSidebar").hover(function(e) {
            e.preventDefault();
            if (! $("body").hasClass('olix-sidebar-short-active')) return;
            $("body").toggleClass('olix-sidebar-short').toggleClass('olix-sidebar-long');
        }, function(e) {
            e.preventDefault();
            if (! $("body").hasClass('olix-sidebar-short-active')) return;
            $("body").toggleClass('olix-sidebar-short').toggleClass('olix-sidebar-long');
        });

    },


    /**
     * En fonction de la taille de la fenêtre, ajoute le style CSS pour la sidebar
     */
    initializeByDisplay: function()
    {
        if ( $("#olixSidebarToggle").is(':visible') ) {
            // Ecran MD et LG
            if ( $.cookie('olix-sidebar') == 'short' )
                olixAdminSideBar.setMenuShort();
            else
                olixAdminSideBar.setMenuLong();
        } else if ( $("#olixSidebar").is(':visible') ) {
            // Ecran SM
            olixAdminSideBar.setMenuShort();
        }
    },

    
    /**
     * Active la Sidebar en mode mini
     */
    setMenuShort: function()
    {
        $("body").addClass('olix-sidebar-short')
                 .addClass('olix-sidebar-short-active')
                 .removeClass('olix-sidebar-long');
        $("#olixSidebarToggle span").toggleClass('fa-chevron-circle-left').toggleClass('fa-chevron-circle-right');
    },

    
    /**
     * Active la Sidebar par défaut
     */
    setMenuLong: function()
    {
        $("body").addClass('olix-sidebar-long')
                 .removeClass('olix-sidebar-short-active')
                 .removeClass('olix-sidebar-short');
    },


    /**
     * Permute les 2 modes de la Sidebar
     */
    toggleMenu: function()
    {
        $("body").toggleClass('olix-sidebar-short').toggleClass('olix-sidebar-long').toggleClass('olix-sidebar-short-active');
        $("#olixSidebarToggle span").toggleClass('fa-chevron-circle-left').toggleClass('fa-chevron-circle-right');
        if ( $("body").hasClass('olix-sidebar-short-active') )
            $.cookie('olix-sidebar', 'short');
        else
            $.cookie('olix-sidebar', 'long');
    }
};



/**
 * Gestion des Widgets
 *
 * @namespace olixAdminWidgets
 */
var olixAdminWidgets = {


    /**
     * Initialise le déplacement pour trier les widgets dans la page
     */
    initSortable: function() {
        $( ".olix-sortable" ).sortable({
            connectWith: ".olix-sortable",
            handle: ".olix-portlet-header",
            placeholder: "olix-portlet-sortable-highlight",
            forcePlaceholderSize: true
        }).disableSelection();
        $(".olix-sortable .olix-portlet-header").css("cursor", "move");
    }

};



/**
 * Gestion des notifications Growl
 *
 * @namespace olixAdminGrow
 */
var olixAdminGrow = {


   /**
    * Template de la notification
    */
   template: '<div data-growl="container" class="alert growl" role="alert">'
               +'<button type="button" class="close" data-growl="dismiss">'
               +'  <span aria-hidden="true">×</span>'
               +'  <span class="sr-only">Close</span>'
               +'</button>'
               +'<span data-growl="icon" class="icon"></span>'
               +'<div class="body">'
               +'  <span data-growl="title" class="title"></span>'
               +'  <span data-growl="message" class="message"></span>'
               +'  <a href="#" data-growl="url"></a>'
               +'</div>'
               +'</div>',

   
   /**
    * Fonction d'initialisation du Growl
    */
   init: function() {
       $.growl(false, {
           offset: {
               x: 15,
               y: 70
           },
           mouse_over: 'pause',
           animate: {
               enter: 'animated zoomInDown',
               exit: 'animated zoomOutUp'
           },
           onShown: function() {
               $(".growl").addClass('growl-animate-exit');
           },
           template: this.template
       });
    },


   /**
    * Affichage générique de la notification
    * 
    * @param icon    : Classe Font Awesone pour l'icone
    * @param title   : Titre de la notification
    * @param message : Message de la la notification
    * @param url     : Url de redirection
    * @param type    : Type de la notification
    */
   alertGeneric: function(icon, title, message, url, type) {
       $.growl({
           icon: icon,
           title: title,
           message: message,
           url: url
       }, {
           type: type
       });
   },


    /**
     * Raccourci pour l'affichage de la notification
     *
     * @see alertGeneric
     */
    alertInfo: function(title, message, url) {
        this.alertGeneric ('fa fa-info-circle', title, message, url, 'info');
    },

    alertSuccess: function(title, message, url) {
        this.alertGeneric ('fa fa-check', title, message, url, 'success');
    },

    alertWarning: function(title, message, url) {
        this.alertGeneric ('fa fa-warning', title, message, url, 'warning');
    },

    alertDanger: function(title, message, url) {
        this.alertGeneric ('fa fa-minus-circle', title, message, url, 'danger');
    },

    alertGrowl: function(icon, title, message, url) {
        this.alertGeneric (icon, title, message, url, 'growl');
    }

};



(function()
{
    olixAdminSideBar.init();
    olixAdminGrow.init();
})();