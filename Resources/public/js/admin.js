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



(function()
{
    olixAdminSideBar.init();
})();