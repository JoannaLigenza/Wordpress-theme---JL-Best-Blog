// jQuery( document ).ready( function( $ ) {
//     console.log("bbbg");
//     // change first value (value) to second value (to)
//     wp.customize( 'menu_font_color', function( value ) {
// 		value.bind( function( to ) {
//             console.log("2");
//             $( '#navigation .menu-item' ).html( to );
//             const items = $( '#navigation .menu-item' );
//             $.each((items), function(index, value) {
//                 $(value).css('color', to);
//                 console.log($(value));
//             });
//             // console.log(items);
//             // items.forEach(item => {
//             //     items.css('color', to);
//             // });
//             // for (let i=0; i< items.length; i++) {
//             //     items[i].css('color', to);
//             // }
// 		} );
// 	} );
// } );

document.addEventListener('DOMContentLoaded', (event) => {
    console.log('preview');
    function myfirsttheme_change_menu_text_color() {
        wp.customize( 'menu_font_color', function( value ) {
            console.log('value ', value);
        value.bind( function( to ) {
            const mainMenu = document.getElementById( 'navigation' );
            const menuItems = mainMenu.getElementsByClassName( 'menu-item' );
            const menuItemsArr = Object.values(menuItems);
            console.log(menuItemsArr);
            menuItemsArr.forEach(menuItem => {
                const menuItemLink = menuItem.getElementsByTagName( 'a' );
                menuItemLink[0].style.color = to;
            });
            } );
        });
    }
    myfirsttheme_change_menu_text_color();

});
