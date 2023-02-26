document.addEventListener('DOMContentLoaded', (event) => {
    
    // Set new color for menu links - displayd in customizer preview with refreshing only menu area
    function jlbestblog_change_menu_text_color() {
        wp.customize( 'menu_font_color', function( value ) {
        value.bind( function( to ) {        // 'to' is new value read form menu_font_color setting
            const mainMenu = document.getElementById( 'navigation' );
            const menuItems = mainMenu.getElementsByClassName( 'menu-item' );
            const menuItemsArr = Object.values(menuItems);
            menuItemsArr.forEach(menuItem => {
                const menuItemLink = menuItem.getElementsByTagName( 'a' );
                menuItemLink[0].style.color = to;
            });
            } );
        });
    }
    jlbestblog_change_menu_text_color();

});
