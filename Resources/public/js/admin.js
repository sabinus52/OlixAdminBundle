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
    }

};



(function()
{
    olixAdminSideBar.init();
})();